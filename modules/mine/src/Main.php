<?php
namespace Drupal\mine;

use Drupal\Core\Url;

class Main {

  public function nav() {
    $build = array(
      '#markup' => t('Welcome to mine'),
    );

    $lg = \Drupal::linkGenerator();
    $items = array();
    $args = array('type' => 'staff');
    $items[] = $lg->generate(t('Staff'), Url::fromRoute('mine.data', $args));

    $args['type'] = 'departments';
    $items[] = $lg->generate(t('Departments'), Url::fromRoute('mine.data', $args));

    $args['type'] = 'assignment';
    $items[] = $lg->generate(t('Assignments'), Url::fromRoute('mine.data', $args));
    
    $args['type'] = 'assignment';
    $options['query'] = array('filter' => 'George');
    $items[] = $lg->generate(t('George assignment'), Url::fromRoute('mine.data', $args, $options));

    $build['list'] = array(
      '#theme' => 'item_list',
      '#items' => $items, 
    );

    return $build;
  }
}
