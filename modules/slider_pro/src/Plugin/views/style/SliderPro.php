<?php

namespace Drupal\slider_pro\Plugin\views\style;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Form\FormStateInterface;
use Drupal\slider_pro\Manager\SliderProManager;
use Drupal\views\Plugin\views\style\StylePluginBase;
use Drupal\views\ResultRow;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "slider_pro",
 *   title = @Translation("Slider Pro"),
 *   help = @Translation("Displays a view as a Slider Pro, using the Slider Pro jQuery plugin."),
 *   theme = "slider_pro_views_style",
 *   theme_file = "slider_pro_views.theme.inc",
 *   display_types = {"normal"}
 * )
 */
class SliderPro extends StylePluginBase {
  /**
   * {@inheritdoc}
   */
  protected $usesRowPlugin = FALSE;

  /**
   * {@inheritdoc}
   */
  protected $usesFields = TRUE;

  /**
   * {@inheritdoc}
   */
  protected $usesOptions = TRUE;

  /**
   * {@inheritdoc}
   */
  protected $usesGrouping = FALSE;

  /**
   * {@inheritdoc}
   */
  protected $usesRowClass = FALSE;

  protected $sliderProManager;

  /**
   * SliderPro constructor.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, SliderProManager $slider_pro_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->sliderProManager = $slider_pro_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('slider_pro.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function evenEmpty() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['optionset'] = ['default' => 'default'];
    $options['fields'] = [];
    $options['thumbnail_fields'] = [];
    $options['number_of_layers'] = 0;
    $options['layers'] = [];
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $fields = $this->getAvailableFields();
    if (empty($fields)) {
      drupal_set_message($this->t('To configure Slider Pro you have to add at least one field'), 'error');
      return $form;
    }


    $form['general'] = [
      '#type' => 'details',
      '#title' => $this->t('General settings'),
      '#open' => TRUE,
    ];

    $form['general']['optionset'] = [
      '#title' => t('Option set'),
      '#type' => 'select',
      '#options' => $this->sliderProManager->getOptionList(),
      '#default_value' => $this->options['optionset'],
      '#required' => TRUE,
    ];

    $form['general']['fields'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Fields on slide'),
      '#options' => $this->getAvailableFields(),
      '#description' => $this->t('Select which fields you want to use on each slide.'),
      '#default_value' => $this->options['fields'],
      '#required' => TRUE,
    ];

    $form['thumbnails'] = [
      '#type' => 'details',
      '#title' => $this->t('Thumbnail settings'),
      '#open' => FALSE,
    ];

    $form['thumbnails']['thumbnail_fields'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Fields'),
      '#options' => $this->getAvailableFields(),
      '#description' => $this->t('Select which fields you want to display on the thumbs. This setting will only be applied if the selected optionset defines a thumbnail position'),
      '#default_value' => $this->options['thumbnail_fields'],
    ];

    $form['layers_wrapper'] = [
      '#type' => 'details',
      '#title' => $this->t('Layer settings'),
      '#open' => !empty($this->options['number_of_layers']) ? TRUE : FALSE,
    ];

    $form['layers_wrapper']['number_of_layers'] = [
      '#type' => 'select',
      '#title' => $this->t('Number of layers'),
      '#options' => array_combine(
        [0, 1, 2, 3, 4, 5],
        [$this->t('None'), 1, 2, 3, 4, 5]
      ),
      '#default_value' => $this->options['number_of_layers'],
      '#description' => $this->t('Provide the number of layers you want to use. Afterwards save the options and re-open them to start configuring your layers.'),
    ];

    $form['layers_wrapper']['layers'] = [
      '#type' => 'table',
      '#header' => [
        $this->t('Fields'),
        $this->t('Background'),
        $this->t('Position'),
        $this->t('Show transition'),
        $this->t('Hide transition'),
        $this->t('Delay'),
        $this->t('Duration'),
        $this->t('Weight'),
      ],
      '#attributes' => [
        'id' => 'slider-pro-layers',
      ],
      '#tabledrag' => [
        [
          'action' => 'order',
          'relationship' => 'sibling',
          'group' => 'weight',
        ],
      ],
      '#empty' => $this->t('No layers configured yet...'),
    ];

    for ($key = 0; $key < $this->options['number_of_layers']; $key++) {
      $layer = isset($this->options['layers'][$key]) ? $this->options['layers'][$key] : [
        'fields' => [],
        'background' => '',
        'position' => 'topLeft',
        'show_transition' => 'left',
        'hide_transition' => 'right',
        'show_delay' => 0,
        'stay_duration' => 0,
        'weight' => 0,
      ];

      $form['layers_wrapper']['layers'][$key]['#attributes']['class'][] = 'draggable';
      $form['layers_wrapper']['layers'][$key]['#weight'] = $layer['weight'];
      $form['layers_wrapper']['layers'][$key]['fields'] = [
        '#type' => 'checkboxes',
        '#title' => $this->t('Fields'),
        '#title_display' => 'invisible',
        '#options' => $this->getAvailableFields(),
        '#default_value' => $layer['fields'],
        '#description' => $this->t('Select which fields you want to display on this layer.'),
        '#required' => TRUE,
      ];

      $form['layers_wrapper']['layers'][$key]['background'] = [
        '#type' => 'select',
        '#title' => $this->t('Background'),
        '#title_display' => 'invisible',
        '#options' => [
          '' => $this->t('None'),
          'sp-white' => $this->t('White transparant'),
          'sp-black' => $this->t('Black transparant'),
        ],
        '#default_value' => $layer['background'],
      ];

      $form['layers_wrapper']['layers'][$key]['position'] = [
        '#type' => 'select',
        '#title' => $this->t('Position'),
        '#title_display' => 'invisible',
        '#options' => [
          'topLeft' => $this->t('Top left'),
          'topCenter' => $this->t('Top center'),
          'topRight' => $this->t('Top right'),
          'bottomLeft' => $this->t('Bottom left'),
          'bottomCenter' => $this->t('Bottom center'),
          'bottomRight' => $this->t('Bottom right'),
          'centerLeft' => $this->t('Center left'),
          'centerRight' => $this->t('Center right'),
          'centerCenter' => $this->t('Center center'),
        ],
        '#default_value' => $layer['position'],
        '#required' => TRUE,
      ];

      $form['layers_wrapper']['layers'][$key]['show_transition'] = [
        '#type' => 'select',
        '#title' => $this->t('Show transition'),
        '#title_display' => 'invisible',
        '#options' => [
          'left' => $this->t('Left'),
          'right' => $this->t('Right'),
          'up' => $this->t('Up'),
          'down' => $this->t('Down'),
        ],
        '#default_value' => $layer['show_transition'],
        '#required' => TRUE,
      ];

      $form['layers_wrapper']['layers'][$key]['hide_transition'] = [
        '#type' => 'select',
        '#title' => $this->t('Show transition'),
        '#title_display' => 'invisible',
        '#options' => [
          'left' => $this->t('Left'),
          'right' => $this->t('Right'),
          'up' => $this->t('Up'),
          'down' => $this->t('Down'),
        ],
        '#default_value' => $layer['hide_transition'],
        '#required' => TRUE,
      ];

      $form['layers_wrapper']['layers'][$key]['show_delay'] = [
        '#type' => 'number',
        '#title' => $this->t('Show delay'),
        '#title_display' => 'invisible',
        '#size' => 5,
        '#required' => TRUE,
        '#default_value' => $layer['show_delay'],
        '#description' => $this->t('Sets a delay for the show transition. This delay starts from the moment when the transition to the new slide starts.'),
      ];

      $form['layers_wrapper']['layers'][$key]['stay_duration'] = [
        '#type' => 'number',
        '#title' => $this->t('Stay duration'),
        '#title_display' => 'invisible',
        '#size' => 5,
        '#required' => TRUE,
        '#default_value' => $layer['stay_duration'],
        '#description' => $this->t('Sets how much time a layer will stay visible before being hidden automatically.'),
      ];

      // @todo: use this button if figured out how ajax calls in this form work.
      /*$form['layers_wrapper']['layers'][$key]['remove'] = [
        '#type' => 'submit',
        '#value' => $this->t('Remove'),
        '#submit' => [[$this, 'removeLayerSubmit']],
        '#ajax' => [
          'callback' => [
            'Drupal\slider_pro\Plugin\views\style\SliderPro',
            'ajaxRefreshLayers'
          ],
        ],
        '#limit_validation_errors' => [],
      ];*/

      $form['layers_wrapper']['layers'][$key]['weight'] = [
        '#type' => 'weight',
        '#title' => $this->t('Weight'),
        '#title_display' => 'invisible',
        '#default_value' => $layer['weight'],
        '#attributes' => [
          'class' => ['weight'],
        ],
      ];
    }

    //Sort by weight.
    uasort($form['layers_wrapper']['layers'], [
      '\Drupal\Component\Utility\SortArray',
      'sortByWeightProperty'
    ]);


    // @todo: use this button if figured out how ajax calls in this form work.
    /*$form['layers_wrapper']['add_layer'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add layer'),
      '#submit' => [[$this, 'addNewLayerSubmit']],
      '#ajax' => [
        'callback' => [
          'Drupal\slider_pro\Plugin\views\style\SliderPro',
          'ajaxRefreshLayers'
        ],
      ],
      '#limit_validation_errors' => [],
    ];*/

  }

  /**
   * {@inheritdoc}
   */
  public function validateOptionsForm(&$form, FormStateInterface $form_state) {
    parent::validateOptionsForm($form, $form_state);
    $style_options = $form_state->getValue('style_options');

    // Flatten style options array.
    $nested_options = [
      'layers' => !empty($style_options['layers_wrapper']['layers']) ? $style_options['layers_wrapper']['layers'] : [],
      'fields' => $style_options['general']['fields'],
      'thumbnail_fields' => $style_options['thumbnails']['thumbnail_fields'],
    ];
    unset($style_options['layers_wrapper']['layers']);
    unset($style_options['general']['fields']);
    unset($style_options['thumbnails']['thumbnail_fields']);

    $form_state->setValue(array(
      'style_options'
    ), array_merge($nested_options, SliderProManager::flattenArray($style_options)));

    // Unset nested values.
    $form_state->unsetValue(array('style_options', 'general'));
    $form_state->unsetValue(array('style_options', 'thumbnails'));
    $form_state->unsetValue(array('style_options', 'layers_wrapper'));

    // Validation.
    $optionset = \Drupal\slider_pro\Entity\SliderPro::load($form_state->getValue([
      'style_options',
      'optionset'
    ]));
    $thumbnail_fields = $form_state->getValue([
      'style_options',
      'thumbnail_fields'
    ]);
    if ($optionset->hasThumbnails() && empty(array_filter($thumbnail_fields))) {
      $form_state->setErrorByName('thumbnails][thumbnail_fields][title', $this->t('The "Thumbnails fields" field is required as the optionset has a position for thumbnails configured.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    $rows = [];
    $fields = array_keys($this->getAvailableFields());


    for ($i = 0; $i < count($this->view->result); $i++) {
      $rows[$i]['layers'] = [];
      for ($j = 0; $j < count($fields); $j++) {
        $field = $fields[$j];
        $rendered_field = $this->view->style_plugin->getField($i, $field);
        if (in_array($field, array_filter($this->options['fields']))) {
          $rows[$i]['slide'][$fields[$j]] = $rendered_field;
        }
        if (in_array($field, array_filter($this->options['thumbnail_fields']))) {
          $rows[$i]['thumb'][$fields[$j]] = $rendered_field;
        }

        $layers = array_slice($this->options['layers'], 0, $this->options['number_of_layers']);
        foreach ($layers as $key => $layer) {
          if (!isset($rows[$i]['layers'][$key])) {
            $rows[$i]['layers'][$key] = $layer;
          }
          if (in_array($field, array_filter($layer['fields']))) {
            $rows[$i]['layers'][$key]['content'][$fields[$j]] = $rendered_field;
          }
        }
      }
    }

    // Unset fields from all layers. Don't need it while rendering.
    foreach ($rows as &$row) {
      foreach ($row['layers'] as &$layer) {
        unset($layer['fields']);
        unset($layer['weight']);
        unset($layer['remove']);
      }
    }

    $build = array(
      '#theme' => $this->themeFunctions(),
      '#view' => $this->view,
      '#options' => $this->options,
      '#rows' => $rows,
    );

    return $build;
  }

  /**
   * Ajax callback to refresh layers.
   * @param $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   * @return \Drupal\Core\Ajax\AjaxResponse
   */
  public static function ajaxRefreshLayers($form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $response->addCommand(new ReplaceCommand('#slider-pro-layers', $form['options']['style_options']['layers_wrapper']['layers']));
    return $response;
  }

  /**
   * Submit callback to add new layer.
   * @param $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public function addNewLayerSubmit($form, FormStateInterface $form_state) {
    $form_state->setRebuild(TRUE);
  }

  /**
   * Submit callback to remove a layer.
   * @param $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public function removeLayerSubmit($form, FormStateInterface $form_state) {
    $form_state->setRebuild(TRUE);
  }

  /**
   * Returns option list of fields available on view.
   */
  protected function getAvailableFields() {
    $view = $this->view;
    return $view->display_handler->getFieldLabels();
  }

}
