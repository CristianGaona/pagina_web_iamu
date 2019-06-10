<?php

namespace Drupal\slider_pro\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\slider_pro\Entity\SliderProInterface;

/**
 * Defines the SliderPro entity.
 *
 * @ConfigEntityType(
 *   id = "slider_pro",
 *   label = @Translation("Slider pro optionset"),
 *   handlers = {
 *     "list_builder" = "Drupal\slider_pro\Controller\SliderProListBuilder",
 *     "form" = {
 *       "add" = "Drupal\slider_pro\Form\SliderProForm",
 *       "edit" = "Drupal\slider_pro\Form\SliderProForm",
 *       "delete" = "Drupal\slider_pro\Form\SliderProDeleteForm"
 *     }
 *   },
 *   config_prefix = "optionset",
 *   admin_permission = "administer slider pro",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "status" = "status"
 *   },
 *   links = {
 *     "canonical" = "/admin/config/media/slider-pro/{slider_pro}",
 *     "edit-form" = "/admin/config/media/slider-pro/{slider_pro}/edit",
 *     "delete-form" = "/admin/config/media/slider-pro/{slider_pro}/delete",
 *     "collection" = "/admin/config/media/slider-pro"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "options",
 *   }
 * )
 */
class SliderPro extends ConfigEntityBase implements SliderProInterface {
  /**
   * The Fslider pro optionset ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The slider pro optionset label.
   *
   * @var string
   */
  protected $label;

  /**
   * The slider pro optionset options.
   *
   * @var array
   */
  protected $options = [];

  /**
   * {@inheritdoc}
   */
  public function getOptions() {
    return $this->options;

  }

  /**
   * {@inheritdoc}
   */
  public function setOptions(array $options) {
    $this->options = $options;
  }

  /**
   * {@inheritdoc}
   */
  public function getOption($name) {
    return isset($this->options[$name]) ? $this->options[$name] : NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function hasThumbnails() {
    return !empty($this->getOption('thumbnail_position'));
  }

  /**
   * {@inheritdoc}
   */
  public function hasAutoPlay() {
    return !empty($this->getOption('autoplay'));
  }

  /**
   * {@inheritdoc}
   */
  public function allowFullScreen() {
    return !empty($this->options['advanced']['full_screen']);
  }

  /**
   * {@inheritdoc}
   */
  public function toOptionSet() {

    $optionset = [
      'width' => $this->getOption('width'),
      'visibleSize' => $this->getOption('visible_size'),
      'forceSize' => $this->getOption('force_size'),
      'height' => $this->getOption('height'),
      'orientation' => $this->getOption('orientation'),
      'buttons' => $this->getOption('buttons') ? TRUE : FALSE,
      'fade' => $this->getOption('transition') ? TRUE : FALSE,
      'arrows' => $this->getOption('arrows') ? TRUE : FALSE,
      'centerImage' => $this->getOption('center_image') ? TRUE : FALSE,
      'allowScaleUp' => $this->getOption('allow_scale_up') ? TRUE : FALSE,
      'autoHeight' => $this->getOption('auto_height') ? TRUE : FALSE,
      'startSlide' => (int) $this->getOption('start_slide'),
      'shuffle' => $this->getOption('shuffle') ? TRUE : FALSE,
      'loop' => $this->getOption('loop') ? TRUE : FALSE,
      'autoplay' => $this->hasAutoPlay() ? TRUE : FALSE,
      'slideDistance' => (int) $this->getOption('slide_distance'),
      'keyboard' => $this->getOption('keyboard') ? TRUE : FALSE,
      'fullScreen' => $this->allowFullScreen() ? TRUE : FALSE,
      'updateHash' => $this->getOption('update_hash') ? TRUE : FALSE,
      'waitForLayers' => $this->getOption('wait_for_layers') ? TRUE : FALSE,
      'autoScaleLayers' => $this->getOption('auto_scale_layers') ? TRUE : FALSE,
    ];


    if ($this->hasAutoPlay()) {
      $optionset['autoplayDelay'] = (int) $this->getOption('autoplay_delay');
      $optionset['autoplayDirection'] = $this->getOption('autoplay_direction');
      $optionset['autoplayOnHover'] = $this->getOption('autoplay_on_hover');
    }

    if ($this->allowFullScreen()) {
      $optionset['fadeFullScreen'] = $this->getOption('fade_full_screen') ? TRUE : FALSE;
    }

    if ($this->hasThumbnails()) {
      $optionset['thumbnailWidth'] = (int) $this->getOption('thumbnail_width');
      $optionset['thumbnailHeight'] = (int) $this->getOption('thumbnail_height');
      $optionset['thumbnailsPosition'] = $this->getOption('thumbnail_position');
      $optionset['thumbnailPointer'] = $this->getOption('thumbnail_pointer') ? TRUE : FALSE;
      $optionset['thumbnailArrows'] = $this->getOption('thumbnail_arrows') ? TRUE : FALSE;
      if ($optionset['thumbnailArrows']) {
        $optionset['fadeThumbnailArrows'] = $this->getOption('fade_thumbnail_arrows') ? TRUE : FALSE;
      }
    }

    return $optionset;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(array $values = []) {
    return parent::create($values);
  }

}
