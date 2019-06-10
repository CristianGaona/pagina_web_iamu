<?php

namespace Drupal\slider_pro\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining slider pro optionset entities.
 */
interface SliderProInterface extends ConfigEntityInterface {

  /**
   * Returns the array of slider pro library options.
   *
   * @return array
   *   The array of options.
   */
  public function getOptions();

  /**
   * Returns the value of a slider pro library option.
   *
   * @param string $name
   *   The option name.
   *
   * @return mixed
   *   The option value.
   */
  public function getOption($name);

  /**
   * Sets the slider pro library options array.
   *
   * @param array $options
   *   New/updated array of options.
   */
  public function setOptions(array $options);

  /**
   * Checks if option set requires thumbnails.
   *
   * @return bool
   */
  public function hasThumbnails();

  /**
   * Checks if option set has autoplay.
   *
   * @return bool
   */
  public function hasAutoPlay();

  /**
   * Checks if option set has full screen mode.
   *
   * @return bool
   */
  public function allowFullScreen();

  /**
   * Returns an array formatted to use as JS option set.
   *
   * @return array
   */
  public function toOptionSet();

}
