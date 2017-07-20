<?php

namespace Drupal\webform_admin\Plugin\WebformHandler;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\webform\Plugin\WebformHandler\EmailWebformHandler;

/**
 * Emails a webform submission by admin.
 *
 * @WebformHandler(
 *   id = "email_admin",
 *   label = @Translation("Email admin"),
 *   category = @Translation("Notification"),
 *   description = @Translation("Sends a webform submission via an email."),
 *   cardinality = \Drupal\webform\Plugin\WebformHandlerInterface::CARDINALITY_UNLIMITED,
 *   results = \Drupal\webform\Plugin\WebformHandlerInterface::RESULTS_PROCESSED,
 *   submission = \Drupal\webform\Plugin\WebformHandlerInterface::SUBMISSION_OPTIONAL,
 * )
 */
class WebformAdminEmailWebformHandler extends EmailWebformHandler {

  /**
   * Get configuration default values.
   *
   * @return array
   *   Configuration default values.
   */
  protected function getDefaultConfigurationValues() {
    if (isset($this->defaultValues)) {
      return $this->defaultValues;
    }

    parent::getDefaultConfigurationValues();

    $webform = $this->getWebform();
    $default_to_mail = $webform->getSetting('webform_admin_to');

    $this->defaultValues['to_mail'] = $default_to_mail;

    return $this->defaultValues;
  }


  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);
    unset($form['to']);
    
    return $form;
  }

  public function getSummary() {
    $summary = parent::getSummary();
    $summary['#theme'] = 'webform_handler_email_summary';
    return $summary;
  }

}
