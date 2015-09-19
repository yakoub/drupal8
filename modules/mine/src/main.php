<?php
namespace Drupal\mine;

function main() {
  $build = array(
    '#markup' => t('Welcome to mine'),
  );

  $lg = \Drupal::linkGenerator();
  $items = array();
  $args = array('type' => 'staff');
  $items[] = $lg->generate(t('Staff'), 'mine.data', $args);

  $args['type'] = 'departments';
  $items[] = $lg->generate(t('Departments'), 'mine.data', $args);

  $args['type'] = 'assignment';
  $items[] = $lg->generate(t('Assignments'), 'mine.data', $args);
  
  $args['type'] = 'assignment';
  $options['query'] = array('filter' => 'George');
  $items[] = $lg->generate(t('George assignment'), 'mine.data', $args, $options);

  $build['list'] = array(
    '#theme' => 'item_list',
    '#items' => $items, 
  );

  return $build;
}
