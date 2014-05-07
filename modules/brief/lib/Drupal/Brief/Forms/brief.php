<?php
namespace \Drupal\Brief\Forms;

use \Drupal\Brief\BriefInterface;

class BriefAdd extends FormBase {
  public function getFormId() {
    return 'brief_add';
  }

  public function buildForm(array $form, array &$form_state) {
    $form['name'] = array(
      '#title' => 'Company name',
      '#type' => 'textfield',
    );

    return $form;
  }

  public function submitForm(array &$form, array &$form_state) {
    $brief = new Brief();
    $brief->create($form_state['values']);
  }
}

class BriefEdit extends BriefAdd {

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
    $brief->update($form_state['values']);
  }
}
