<?php

namespace Drupal\slider_pro;

/**
 * Class SliderProDefaults
 * @package Drupal\slider_pro
 */
class SliderProDefaults {

  /**
   * Returns default slider pro library options.
   * @return array
   */
  public static function defaultOptions() {
    return [
      'width' => '100%',
      'visible_size' => 'auto',
      'force_size' => 'none',
      'height' => '200px',
      'orientation' => 'horizontal',
      'buttons' => 0,
      'transition' => 0,
      'arrows' => 0,
      'thumbnail_position' => 0,
      'thumbnail_width' => '100',
      'thumbnail_height' => '80',
      'thumbnail_pointer' => 0,
      'thumbnail_arrows' => 0,
      'fade_thumbnail_arrows' => 1,
      'wait_for_layers' => 0,
      'auto_scale_layers' => 1,
      'center_image' => 1,
      'allow_scale_up' => 1,
      'auto_height' => 0,
      'start_slide' => 0,
      'shuffle' => 0,
      'loop' => 1,
      'autoplay' => 1,
      'autoplay_delay' => 5000,
      'autoplay_direction' => 'normal',
      'autoplay_on_hover' => 'pause',
      'slide_distance' => 10,
      'keyboard' => 1,
      'full_screen' => 0,
      'fade_full_screen' => 1,
      'update_hash' => 0,
    ];
  }

}
