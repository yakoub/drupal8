<?php
namespace \Drupal\Brief\Controller;
use \Drupal\Brief\BriefInterface;

class Brief {

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
