<?php
namespace Drupal\brief;

interface BriefInterface {
  public function company();
  public function finance();
  public function create($values);
  public function update($values);
  public function delete();
  public static function range($start, $length);
}
