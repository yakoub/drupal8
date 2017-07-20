<?php
namespace Drupal\webform_admin;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\webform\WebformInterface;
use Drupal\Core\Routing\RouteMatch;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

class Admin extends FormBase {
  
  public function getFormId() {
    return 'webform_admin_admin';
  }
  
  public function buildForm(
    array $form, 
    FormStateInterface $form_state
  ) {

    $route = \Drupal::service('current_route_match');
    $webform = $route->getParameters()->get('webform');

    $form_state->set('webform', $webform);

    $form['to'] = array(
      '#type' => 'webform_email_multiple',
      '#title' => $this->t('To'),
      '#default_value' => $webform->getSetting('webform_admin_to'),
    );

    $form['save'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    );

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $to = $form_state->getValue('to');
    $webform = $form_state->get('webform');
    $webform->setSetting('webform_admin_to', $to);
    $webform->save();
  }

  public function access(AccountInterface $account, RouteMatch $route_match) {
    $webform = $route_match->getParameter('webform');
    $has_handler = $webform->getHandlers('email_admin')->count() > 0;
    return AccessResult::allowedIf($has_handler and $account->hasPermission('administer webform emails'));
  }
}
