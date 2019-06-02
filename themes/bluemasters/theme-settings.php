<?php

/**
 * @file
 * Implementation of hook_form_system_theme_settings_alter()
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 *
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */

use Drupal\file\Entity\File;
use Drupal\Core\Form\FormStateInterface;

/**
 *
 */
function bluemasters_form_system_theme_settings_alter(&$form, FormStateInterface $form_state) {
  $form['bluemasters_settings'] = [
    '#type' => 'fieldset',
    '#title' => t('bluemasters Settings'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  ];
  $form['bluemasters_settings']['slideshow']['slide1'] = [
    '#type' => 'fieldset',
    '#title' => t('Slide 1'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['bluemasters_settings']['slideshow']['slide1']['slide1_image'] = [
    '#type' => 'managed_file',
    '#title' => t('Image 1'),
    '#default_value' => theme_get_setting('slide1_image', 'bluemasters'),
    '#upload_location' => 'public://',
  ];

  $form['bluemasters_settings']['slideshow']['slide2'] = [
    '#type' => 'fieldset',
    '#title' => t('Slide 2'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['bluemasters_settings']['slideshow']['slide2']['slide2_image'] = [
    '#type' => 'managed_file',
    '#title' => t('Image 2'),
    '#default_value' => theme_get_setting('slide2_image', 'bluemasters'),
    '#upload_location' => 'public://',
  ];
  $form['bluemasters_settings']['slideshow']['slide3'] = [
    '#type' => 'fieldset',
    '#title' => t('Slide 3'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['bluemasters_settings']['slideshow']['slide3']['slide3_image'] = [
    '#type' => 'managed_file',
    '#title' => t('Image 3'),
    '#default_value' => theme_get_setting('slide3_image', 'bluemasters'),
    '#upload_location' => 'public://',
  ];
  $form['bluemasters_settings']['slideshow']['slide4'] = [
    '#type' => 'fieldset',
    '#title' => t('Slide 4'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    
  ];
  $form['bluemasters_settings']['slideshow']['slide4']['slide4_image'] = [
    '#type' => 'managed_file',
    '#title' => t('Image 4'),
    '#class' => 'foto4',
    '#default_value' => theme_get_setting('slide4_image', 'bluemasters'),
    '#upload_location' => 'public://',
  ];
  $form['bluemasters_settings']['slideshow']['slideimage'] = [
    '#markup' => t('To change the default Slide Images, Replace the slide-image-1.jpg, slide-image-2.jpg and slide-image-3.jpg in the images folder of the theme folder.'),
  ];
  $form['#submit'][] = 'bluemasters_settings_form_submit';
  $theme = \Drupal::theme()->getActiveTheme()->getName();
  $theme_file = drupal_get_path('theme', $theme) . '/theme-settings.php';
  $build_info = $form_state->getBuildInfo();
  if (!in_array($theme_file, $build_info['files'])) {
    $build_info['files'][] = $theme_file;
  }
  $form_state->setBuildInfo($build_info);
}

/**
 *
 */
function bluemasters_settings_form_submit(&$form, FormStateInterface $form_state) {
  $account = \Drupal::currentUser();
  $values = $form_state->getValues();
  for ($i = 1; $i <= 3; $i++) {
    if (isset($values["slide{$i}_image"]) && !empty($values["slide{$i}_image"])) {
      // Load the file via file.fid.
      if ($file = File::load($values["slide{$i}_image"][0])) {
        // Change status to permanent.
        $file->setPermanent();
        $file->save();
        $file_usage = \Drupal::service('file.usage');
        $file_usage->add($file, 'user', 'user', $account->id());
      }
    }
  }
}
