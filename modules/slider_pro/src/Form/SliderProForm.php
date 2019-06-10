<?php

namespace Drupal\slider_pro\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\slider_pro\SliderProDefaults;

/**
 * Class SliderProForm
 * @package Drupal\slider_pro\Form
 */
class SliderProForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    /** @var \Drupal\slider_pro\Entity\SliderProInterface $slider_pro */
    $slider_pro = $this->entity;
    $options = array_merge(SliderProDefaults::defaultOptions(), $slider_pro->getOptions());

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $slider_pro->label(),
      '#description' => $this->t('A human-readable title for this option set.'),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $slider_pro->id(),
      '#machine_name' => [
        'exists' => '\Drupal\slider_pro\Entity\SliderPro::load',
      ],
      '#disabled' => !$slider_pro->isNew(),
    ];

    // Options Vertical Tab Group table.
    $form['tabs'] = [
      '#type' => 'vertical_tabs',
    ];

    // General Settings.
    $form['general'] = [
      '#type' => 'details',
      '#title' => $this->t('General Settings'),
      '#group' => 'tabs',
      '#open' => TRUE,
    ];

    $form['general']['width'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Width'),
      '#description' => 'The width of the slider. Eg 200px or 50%',
      '#default_value' => $options['width'],
      '#required' => TRUE,
    ];

    $form['general']['visible_size'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Visible size'),
      '#description' => 'Sets the size (for example 100%) of the visible area, allowing for more slides to become visible near the selected slide. Be sure that the width of your slider is less than 100%. Example',
      '#default_value' => $options['visible_size'],
      '#required' => TRUE,
    ];

    $form['general']['force_size'] = [
      '#type' => 'select',
      '#title' => $this->t('Force size'),
      '#options' => [
        'none' => $this->t('None'),
        'fullWidth' => $this->t('Full width'),
        'fullWindow' => $this->t('Full window'),
      ],
      '#default_value' => $options['force_size'],
      '#description' => $this->t('Indicates if the size of the slider will be forced to full width or full window.'),
      '#required' => TRUE,
    ];

    $form['general']['height'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Height'),
      '#default_value' => $options['height'],
      '#description' => 'The height of the slider. Eg 200px or 50%',
    ];

    $form['general']['orientation'] = [
      '#type' => 'select',
      '#title' => $this->t('Orientation'),
      '#options' => [
        'horizontal' => $this->t('Horizontal'),
        'vertical' => $this->t('Vertical'),
      ],
      '#default_value' => $options['orientation'],
      '#description' => $this->t('Indicates whether the slides will be arranged horizontally or vertically.'),
      '#required' => TRUE,
    ];

    $form['general']['buttons'] = [
      '#type' => 'select',
      '#title' => $this->t('Buttons'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['buttons'],
      '#description' => $this->t('Indicates whether the buttons will be created.'),
      '#required' => TRUE,
    ];

    $form['general']['transition'] = [
      '#type' => 'select',
      '#title' => $this->t('Transition'),
      '#options' => [
        0 => $this->t('Slide'),
        1 => $this->t('Fade'),
      ],
      '#default_value' => $options['transition'],
      '#description' => $this->t('Indicates which transition will be used.'),
      '#required' => TRUE,
    ];

    $form['general']['arrows'] = [
      '#type' => 'select',
      '#title' => $this->t('Arrows'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['arrows'],
      '#description' => $this->t('Indicates whether the arrow buttons will be created.'),
      '#required' => TRUE,
    ];

    // Thumbnail Settings.
    $form['thumbnails'] = [
      '#type' => 'details',
      '#title' => $this->t('Thumbnail Settings'),
      '#group' => 'tabs',
      '#open' => FALSE,
    ];

    $form['thumbnails']['thumbnail_position'] = [
      '#type' => 'select',
      '#title' => $this->t('Position'),
      '#options' => [
        0 => $this->t('No thumbs'),
        'left' => $this->t('Left'),
        'right' => $this->t('Right'),
        'top' => $this->t('Top'),
        'bottom' => $this->t('Bottom'),
      ],
      '#default_value' => $options['thumbnail_position'],
      '#required' => TRUE,
      '#description' => $this->t('Sets the position of the thumbnail scroller.'),
    ];

    $form['thumbnails']['thumbnail_width'] = [
      '#type' => 'number',
      '#title' => $this->t('Width'),
      '#description' => $this->t('The width of each thumbnail. Eg 200px.'),
      '#default_value' => $options['thumbnail_width'],
      '#required' => TRUE,
      '#states' => [
        'invisible' => [
          'select[name="thumbnail_position"]' => ['value' => '0'],
        ],
      ],
    ];

    $form['thumbnails']['thumbnail_height'] = [
      '#type' => 'number',
      '#title' => $this->t('height'),
      '#description' => $this->t('The height of each thumbnail. Eg 200px.'),
      '#default_value' => $options['thumbnail_height'],
      '#required' => TRUE,
      '#states' => [
        'invisible' => [
          'select[name="thumbnail_position"]' => ['value' => '0'],
        ],
      ],
    ];

    $form['thumbnails']['thumbnail_pointer'] = [
      '#type' => 'select',
      '#title' => $this->t('Pointer'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['thumbnail_pointer'],
      '#required' => TRUE,
      '#description' => $this->t('Indicates if a pointer will be displayed for the selected thumbnail.'),
      '#states' => [
        'invisible' => [
          'select[name="thumbnail_position"]' => ['value' => '0'],
        ],
      ],
    ];

    $form['thumbnails']['thumbnail_arrows'] = [
      '#type' => 'select',
      '#title' => $this->t('Arrows'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['thumbnail_arrows'],
      '#required' => TRUE,
      '#description' => $this->t('Indicates whether the thumbnail arrows will be enabled.'),
      '#states' => [
        'invisible' => [
          'select[name="thumbnail_position"]' => ['value' => '0'],
        ],
      ],
    ];

    $form['thumbnails']['fade_thumbnail_arrows'] = [
      '#type' => 'select',
      '#title' => $this->t('Fade arrows'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['fade_thumbnail_arrows'],
      '#required' => TRUE,
      '#description' => $this->t('Indicates whether the thumbnail arrows will be faded.'),
      '#states' => [
        'invisible' => [
          [
            'select[name="thumbnail_position"]' => ['value' => '0'],
          ],
          [
            'select[name="thumbnail_arrows"]' => ['value' => '0'],
          ],
        ],
      ],
    ];

    // Layer Settings.
    $form['layers'] = [
      '#type' => 'details',
      '#title' => $this->t('Layer Settings'),
      '#group' => 'tabs',
      '#open' => FALSE,
    ];

    $form['layers']['wait_for_layers'] = [
      '#type' => 'select',
      '#title' => $this->t('Wait for layers'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['wait_for_layers'],
      '#description' => $this->t('Indicates whether the slider will wait for the layers to disappear before going to a new slide.'),
    ];

    $form['layers']['auto_scale_layers'] = [
      '#type' => 'select',
      '#title' => $this->t('Auto scale layers'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['auto_scale_layers'],
      '#description' => $this->t('Indicates whether the layers will be scaled automatically.'),
    ];

    // Advanced Settings.
    $form['advanced'] = [
      '#type' => 'details',
      '#title' => $this->t('Advanced Settings'),
      '#group' => 'tabs',
      '#open' => FALSE,
    ];

    $form['advanced']['center_image'] = [
      '#type' => 'select',
      '#title' => $this->t('Center image'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['center_image'],
      '#description' => $this->t('Indicates if the image will be centered.'),
      '#required' => TRUE,
    ];

    $form['advanced']['allow_scale_up'] = [
      '#type' => 'select',
      '#title' => $this->t('Allow scale up'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['allow_scale_up'],
      '#description' => $this->t('Indicates if the image can be scaled up more than its original size.'),
      '#required' => TRUE,
    ];

    $form['advanced']['auto_height'] = [
      '#type' => 'select',
      '#title' => $this->t('Auto height'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['auto_height'],
      '#description' => $this->t('Indicates if height of the slider will be adjusted to the height of the selected slide.'),
      '#required' => TRUE,
    ];

    $form['advanced']['slide_distance'] = [
      '#type' => 'number',
      '#title' => $this->t('Slide distance'),
      '#default_value' => $options['slide_distance'],
      '#description' => $this->t('Sets the distance between the slides.'),
      '#required' => TRUE,
    ];

    $form['advanced']['start_slide'] = [
      '#type' => 'number',
      '#title' => $this->t('Start slide'),
      '#default_value' => $options['start_slide'],
      '#description' => $this->t('Sets the slide that will be selected when the slider loads.'),
      '#required' => TRUE,
    ];

    $form['advanced']['shuffle'] = [
      '#type' => 'select',
      '#title' => $this->t('Shuffle'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['shuffle'],
      '#description' => $this->t('Indicates if the slides will be shuffled.'),
      '#required' => TRUE,
    ];

    $form['advanced']['loop'] = [
      '#type' => 'select',
      '#title' => $this->t('Loop'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['loop'],
      '#description' => $this->t('Indicates if the slider will be loopable (infinite scrolling).'),
      '#required' => TRUE,
    ];

    $form['advanced']['autoplay'] = [
      '#type' => 'select',
      '#title' => $this->t('Autoplay'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['autoplay'],
      '#description' => $this->t('Indicates whether or not autoplay will be enabled.'),
      '#required' => TRUE,
    ];

    $form['advanced']['autoplay_delay'] = [
      '#type' => 'number',
      '#title' => $this->t('Autoplay delay'),
      '#default_value' => $options['autoplay_delay'],
      '#description' => $this->t('Sets the delay/interval (in milliseconds) at which the autoplay will run.'),
      '#required' => TRUE,
      '#states' => [
        'visible' => [
          'select[name="autoplay"]' => ['value' => '1'],
        ],
      ],
    ];

    $form['advanced']['autoplay_direction'] = [
      '#type' => 'select',
      '#title' => $this->t('Autoplay direction'),
      '#options' => [
        'normal' => $this->t('Normal'),
        'backwards' => $this->t('Backwards'),
      ],
      '#default_value' => $options['autoplay_direction'],
      '#description' => $this->t('Indicates whether autoplay will navigate to the next slide or previous slide.'),
      '#required' => TRUE,
      '#states' => [
        'visible' => [
          'select[name="autoplay"]' => ['value' => '1'],
        ],
      ],
    ];

    $form['advanced']['autoplay_on_hover'] = [
      '#type' => 'select',
      '#title' => $this->t('Autoplay on hover'),
      '#options' => [
        'pause' => $this->t('Pause'),
        'stop' => $this->t('Stop'),
        'none' => $this->t('None'),
      ],
      '#default_value' => $options['autoplay_on_hover'],
      '#description' => $this->t('Indicates if the autoplay will be paused or stopped when the slider is hovered.'),
      '#required' => TRUE,
      '#states' => [
        'visible' => [
          'select[name="autoplay"]' => ['value' => '1'],
        ],
      ],
    ];

    $form['advanced']['keyboard'] = [
      '#type' => 'select',
      '#title' => $this->t('Keyboard'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['keyboard'],
      '#description' => $this->t('Indicates whether keyboard navigation will be enabled.'),
      '#required' => TRUE,
    ];

    $form['advanced']['full_screen'] = [
      '#type' => 'select',
      '#title' => $this->t('Full screen'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['full_screen'],
      '#description' => $this->t('Indicates whether the full-screen button is enabled.'),
      '#required' => TRUE,
    ];

    $form['advanced']['fade_full_screen'] = [
      '#type' => 'select',
      '#title' => $this->t('Fade full screen'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['fade_full_screen'],
      '#description' => $this->t('Indicates whether the button will fade in only on hover.'),
      '#required' => TRUE,
      '#states' => [
        'visible' => [
          'select[name="full_screen"]' => ['value' => '1'],
        ],
      ],
    ];

    $form['advanced']['update_hash'] = [
      '#type' => 'select',
      '#title' => $this->t('Update hash'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes'),
      ],
      '#default_value' => $options['update_hash'],
      '#description' => $this->t('Indicates whether the hash will be updated when a new slide is selected.'),
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    /** @var \Drupal\slider_pro\SliderProInterface $slider_pro */
    $slider_pro = $this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Slider Pro optionset.', [
          '%label' => $slider_pro->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Slider Pro optionset.', [
          '%label' => $slider_pro->label(),
        ]));
    }
    $form_state->setRedirectUrl($slider_pro->toUrl('collection'));
  }

  /**
   * {@inheritdoc}
   */
  protected function copyFormValuesToEntity(EntityInterface $entity, array $form, FormStateInterface $form_state) {
    $options = [];
    $values = $form_state->getValues();

    foreach ($values as $key => $value) {
      if (in_array($key, ['id', 'label'])) {
        $entity->set($key, $value);
      }
      else {
        $options[$key] = $value;
      }
    }
    $entity->set('options', $options);
  }

  /**
   * {@inheritdoc}
   */
  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);
    // Prevent access to delete button when editing default configuration.
    if ($this->entity->id() == 'default' && isset($actions['delete'])) {
      $actions['delete']['#access'] = FALSE;
    }
    return $actions;
  }

}
