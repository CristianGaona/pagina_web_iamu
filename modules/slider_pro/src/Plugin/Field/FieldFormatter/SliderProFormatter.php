<?php

namespace Drupal\slider_pro\Plugin\Field\FieldFormatter;

use Drupal\Core\Cache\Cache;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Url;
use Drupal\image\Plugin\Field\FieldFormatter\ImageFormatter;
use Drupal\slider_pro\Entity\SliderPro;
use Drupal\slider_pro\Manager\SliderProManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @FieldFormatter(
 *   id = "slider_pro",
 *   label = @Translation("Slider Pro"),
 *   field_types = {
 *     "image"
 *   }
 * )
 */
class SliderProFormatter extends ImageFormatter {

  protected $sliderProManager;

  /**
   * SliderProFormatter constructor.
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, AccountInterface $current_user, EntityStorageInterface $image_style_storage, SliderProManager $slider_pro_manager) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings, $current_user, $image_style_storage);
    $this->sliderProManager = $slider_pro_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('current_user'),
      $container->get('entity.manager')->getStorage('image_style'),
      $container->get('slider_pro.manager')
    );
  }


  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
        'optionset' => 'default',
        'image_style' => '',
        'image_style_thumb' => '',
      ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $image_styles = image_style_options(FALSE);
    $description_link = Link::fromTextAndUrl(
      $this->t('Configure Image Styles'),
      Url::fromRoute('entity.image_style.collection')
    );

    $element['optionset'] = [
      '#title' => t('Option set'),
      '#type' => 'select',
      '#options' => $this->sliderProManager->getOptionList(),
      '#default_value' => $this->getSetting('optionset'),
      '#required' => TRUE,
    ];

    $element['image_style'] = [
      '#title' => t('Image style'),
      '#type' => 'select',
      '#default_value' => $this->getSetting('image_style'),
      '#empty_option' => t('None (original image)'),
      '#options' => $image_styles,
      '#description' => $description_link->toRenderable() + [
          '#access' => $this->currentUser->hasPermission('administer image styles')
        ],
    ];

    $element['image_style_thumb'] = [
      '#title' => t('Image style thumbnail'),
      '#type' => 'select',
      '#default_value' => $this->getSetting('image_style_thumb'),
      '#empty_option' => t('None (original image)'),
      '#options' => $image_styles,
      '#description' => $description_link->toRenderable() + [
          '#access' => $this->currentUser->hasPermission('administer image styles')
        ],
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $image_styles = image_style_options(FALSE);

    $optionset = SliderPro::load($this->getSetting('optionset'));
    $summary[] = $this->t('Optionset: @optionset', ['@optionset' => $optionset->label()]);

    // Unset possible 'No defined styles' option.
    unset($image_styles['']);
    // Styles could be lost because of enabled/disabled modules that defines
    // their styles in code.
    $image_style_setting = $this->getSetting('image_style');
    if (isset($image_styles[$image_style_setting])) {
      $summary[] = $this->t('Image style: @style', ['@style' => $image_styles[$image_style_setting]]);
    }
    else {
      $summary[] = $this->t('Image style: Original image');
    }

    $image_style_thumb_setting = $this->getSetting('image_style_thumb');
    if (isset($image_styles[$image_style_thumb_setting])) {
      $summary[] = $this->t('Image style thumbnail: @style', ['@style' => $image_styles[$image_style_thumb_setting]]);
    }
    else {
      $summary[] = $this->t('Image style thumbnail: Original image');
    }


    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $rows = [];
    $files = $this->getEntitiesToView($items, $langcode);

    // Early opt-out if the field is empty.
    if (empty($files)) {
      return [];
    }

    if (!$optionset = SliderPro::load($this->getSetting('optionset'))) {
      // For some reason, no optionset could be loaded.
      return [];
    }

    $image_style_setting = $this->getSetting('image_style');
    $image_style_thumb_setting = $this->getSetting('image_style_thumb');

    // Collect cache tags to be added for each item in the field.
    $base_cache_tags = ['image_style' => [], 'image_style_thumb' => []];
    if (!empty($image_style_setting)) {
      $image_style = $this->imageStyleStorage->load($image_style_setting);
      $base_cache_tags['image_style'] = $image_style->getCacheTags();
    }
    if (!empty($image_style_thumb_setting)) {
      $image_style = $this->imageStyleStorage->load($image_style_thumb_setting);
      $base_cache_tags['image_style_thumb'] = $image_style->getCacheTags();
    }

    foreach ($files as $delta => $file) {
      /** @var \Drupal\file\FileInterface $file */
      $cache_contexts = [];
      $image_style_cache_tags = Cache::mergeTags($base_cache_tags['image_style'], $file->getCacheTags());
      $image_style_thumb_cache_tags = Cache::mergeTags($base_cache_tags['image_style_thumb'], $file->getCacheTags());

      // Extract field item attributes for the theme function, and unset them
      // from the $item so that the field template does not re-render them.
      $item = $file->_referringItem;
      $item_attributes = $item->_attributes;
      unset($item->_attributes);


      $rows[$delta]['slide']['image'] = [
        '#theme' => 'image_formatter',
        '#item' => $item,
        '#item_attributes' => $item_attributes,
        '#image_style' => $image_style_setting,
        '#cache' => [
          'tags' => $image_style_cache_tags,
          'contexts' => $cache_contexts,
        ],
      ];
      $rows[$delta]['thumb']['image'] = [
        '#theme' => 'image_formatter',
        '#item' => $item,
        '#item_attributes' => $item_attributes,
        '#image_style' => $image_style_thumb_setting,
        '#cache' => [
          'tags' => $image_style_thumb_cache_tags,
          'contexts' => $cache_contexts,
        ],
      ];
    }

    // Build render array.
    $id = 'slider-pro-' . uniqid();
    $content = array(
      '#theme' => 'slider_pro',
      '#rows' => $rows,
      '#uses_thumbnails' => $optionset->hasThumbnails(),
      '#id' => $id,
    );

    $attached = [];

    // JavaScript settings
    $js_settings = array(
      'instances' => array(
        $id => $optionset->toOptionSet(),
      ),
    );
    // Add JS.
    $attached['library'][] = 'slider_pro/slider.pro.load';
    $content['#attached'] = [
      'library' => [
        'slider_pro/slider.pro.load'
      ],
      'drupalSettings' => [
        'sliderPro' => $js_settings,
      ],
    ];

    return $content;
  }

}
