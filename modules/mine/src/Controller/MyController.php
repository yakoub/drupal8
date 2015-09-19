<?php
namespace Drupal\mine\Controller;

use Symfony\Component\HttpFoundation\Request;

class MyController {

  public function typeTitle($type) {
    $title = \Drupal::config('mine.demo')->get('titles.' . $type);
    return $title ? $title : 'Not found';
  }
  
  public function typeData($type, Request $request) {
    if ($request->query->has('filter')) {
      $type .= '.' . $request->query->get('filter');
    }
    $data = \Drupal::config('mine.demo')->get($type);
    foreach ($data as $key => &$item) {
      if (is_array($item)) {
        $table = array(
          '#theme' => 'table',
          '#rows' => array(
            array_keys($item),
            array_values($item),
          ),
        );
        $item = array(
          '#markup' => $key,
          'children' => $table,
        );
      }
    }
    return array(
      '#theme' => 'item_list',
      '#items' => $data,
      '#prefix' => \Drupal::linkGenerator()->generate(t('Back'), 'mine.main'),
    );
  }
}
