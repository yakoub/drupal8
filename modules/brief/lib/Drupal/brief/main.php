<?php
namespace Drupal\brief;

use Drupal\brief\Brief;

function main() {
  $briefs = Brief::range(0, 10);
  $lg = \Drupal::linkGenerator();
  $args = array();
  foreach ($briefs as &$brief) {
    $args['brief'] = $brief->bid;
    $brief->link = $lg->generate($brief->name, 'brief.view', $args);
  }
  return array(
    '#theme' => 'brief_list',
    '#briefs' => $briefs,
    '#prefix' => $lg->generate(t('Add brief'), 'brief.add'),
  );
}

