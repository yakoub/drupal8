<?php
namespace Drupal\brief\Forms;

use Drupal\Core\Form\FormBase;
use Drupal\brief\Brief;

class BriefAdd extends FormBase {
  public function getFormId() {
    return 'brief_add';
  }

  public function buildForm(array $form, array &$form_state) {
    $form['name'] = array(
      '#title' => 'Company name',
      '#type' => 'textfield',
    );

    $form['save'] = array(
      '#value' => t('Save'),
      '#type' => 'submit',
    );

    return $form;
  }

  public function submitForm(array &$form, array &$form_state) {
    $brief = new Brief();
    $brief->create($form_state['values']);
  }
}

