<?php
namespace Drupal\brief;

use Drupal\brief\Brief;

function main() {
  $briefs = Brief::range(0, 10);
  $lg = \Drupal::linkGenerator();
  return array(
    '#theme' => 'brief_list',
    '#briefs' => $briefs,
    '#prefix' => $lg->generate(t('Add brief'), 'brief.add'),
  );
}

