<?php
namespace Drupal\Brief\Routing;

use Drupal\Core\ParamConverter\ParamConverterInterface;
use Symfony\Component\Routing\Route;

class BriefConverter implements ParamConverterInterface {

  public function applies($definition, $name, Route $route) {
    error_log(print_r($definition, TRUE));
    return FALSE;
  }

  public function convert($value, $definition, $name, array $defaults, Request $request) {

  }
}
