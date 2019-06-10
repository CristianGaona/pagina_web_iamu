<?php

namespace Drupal\slider_pro\Manager;

use Drupal\slider_pro\Entity\SliderPro;

/**
 * Class SliderProManager
 * @package Drupal\slider_pro\Manager
 */
class SliderProManager {

  /**
   * returns array of option sets suitable for using as select list options.
   * @return array
   */
  public function getOptionList() {
    $optionsets = SliderPro::loadMultiple();
    $options = [];
    foreach ($optionsets as $name => $optionset) {
      /** @var \Drupal\slider_pro\Entity\SliderProInterface $optionset */
      $options[$name] = $optionset->label();
    }

    if (empty($options)) {
      $options[''] = t('No defined option sets');
    }
    return $options;
  }

  /**
   * Flatten array and preserve keys.
   * @param array $array
   * @return array
   */
  public static function flattenArray(array $array) {
    $flattened_array = array();
    array_walk_recursive($array,
      function ($a, $key) use (&$flattened_array) {
        $flattened_array[$key] = $a;
      });
    return $flattened_array;
  }
}