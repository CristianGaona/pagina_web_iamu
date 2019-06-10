<?php

use Drupal\slider_pro\Entity\SliderPro;

/**
 * Prepares variables for slider pro view templates.
 *
 * Default template: slider-pro-views-style.html.twig.
 */
function template_preprocess_slider_pro_views_style(array &$variables) {
  if (empty($variables['view'])) {
    return;
  }

  if (!$optionset = SliderPro::load($variables['options']['optionset'])) {
    // For some reason, no optionset could be loaded.
    return;
  }

  // Build render array.
  $id = 'slider-pro-' . uniqid();
  $content = array(
    '#theme' => 'slider_pro',
    '#rows' => $variables['rows'],
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

  // Add the slide items to the variables.
  $variables['content'] = $content;
}
