<?php
namespace Drupal\brief\Controller;
use Drupal\brief\BriefInterface;

class BriefController {

  public static function title(BriefInterface $brief) {
    return $brief->company()->$name;
  }

  public static function view(BriefInterface $brief) {
    return array(
      '#theme' => 'brief',
      '#company' => $brief->company(),
      '#finance' => $brief->finance(),
    );
  }
}
