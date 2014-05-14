<?php

namespace Drupal\brief\Forms;

use Drupal\Core\Form\FormBase;
use Drupal\brief\Forms\BriefInterface;

class BriefDelete extends FormBase {

  public function getFormId() {
    return 'brief_edit';
  }
  
  public function buildForm(array $form, array &$form_state, BriefInterface $brief) {
    $form = parent::buildForm($form, $form_state);
    $form['name']['#default_value'] = $brief->name;
    $form['brief'] = array(
      '#type' => 'value',
      '#value' => $brief,
    );
    return $form;
  }

  public function submitForm(array &$form, array &$form_state) {
    $brief = $form_state['values']['brief'];
    $brief->delete();
  }
}
