<?php

namespace Drupal\slider_pro\Form;

use Drupal\Core\Entity\EntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Class SliderProDeleteForm
 * @package Drupal\slider_pro\Form
 */
class SliderProDeleteForm extends EntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete %name?', ['%name' => $this->entity->label()]);
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('entity.slider_pro.collection');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->entity->delete();

    drupal_set_message(
      $this->t('Deleted the %label Slider pro optionset.',
        [
          '%label' => $this->entity->label(),
        ]
      )
    );

    $form_state->setRedirectUrl($this->getCancelUrl());
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);

    if ($this->entity->id() == 'default') {
      $form['#title'] = $this->t('The default optionset cannot be deleted.');
      $form['description'] = ['#markup' => t('Please click Cancel to go back to the list of optionsets.')];
      $form['actions']['submit']['#access'] = FALSE;
    }

    return $form;
  }

}
