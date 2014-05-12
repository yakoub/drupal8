<?php
namespace Drupal\brief;

use Drupal\Core\ParamConverter\ParamConverterInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Drupal\brief\BriefInterface;

class Brief implements BriefInterface {

  public function __construct($id = NULL) {
    if (!$id) {
      return;
    }
    $query = db_select('brief', 'b');
    $this->$brief = $query
      ->condition('bid', $id)
      ->execute()
      ->fetchObject();
  }
 
  public function company() {
    if ($this->$company) {
      return $this->$company;
    }
    $query = db_select('company', 'c');
    $company = $query
      ->condition('cid', $this->$brief->$company)
      ->execute()
      ->fetchObject();
    $this->$company = $company ? $company : array();
    $this->$company += array(
      'name' => '',
    );
    $this->$company = (object) $this->$company;
    return $this->$company;
  }
  
  public function finance() {
    if ($this->$finance) {
      return $this->$finance;
    }
    $query = db_select('finance', 'c');
    $finance = $query
      ->condition('fid', $this->$brief->$finance)
      ->execute()
      ->fetchAssoc();
      
    $this->$finance = $finance ? $finance : array();
    $this->$finance += array(
      'bank' => '',
      'loan' => '',
      'assets' => '',
    );
    $this->$finance = (object) $this->$finance;
    return $this->$finance;
  }
 
  public function create($values) {
    $insert = db_insert('company');
    $cid = $insert
      ->fields(array('name' => $values['name']))
      ->execute();
    
    $insert = db_insert('brief');
    $bid = $insert
      ->fields(array('cid' => $cid))
      ->execute();

    $this->$brief = (object) array(
      'company' => $cid,
      'bid' => $bid,
      'finance' => NULL,
    );
  }

  public function update($values) {
    db_update('company')
      ->condition('cid', $this->$brief->company)
      ->fields(array('name' => $values['name']))
      ->execute();
  }
  
  public static function range($start, $length) {
    $query = db_select('brief', 'b');
    $query->join('company', 'c', 'b.company = c.cid');
    $query->fields('b', array('bid'));
    $query->fields('c', array('name'));
    $query->range($start, $length);

    return $query->execute()->fetchAll();
  }

  private $brief = NULL;
  private $company = NULL;
  private $finance = NULL;
}

class BriefParamConverter implements ParamConverterInterface {

  public function applies($definition, $name, Route $route) {
    error_log(print_r($definition, TRUE));
    return FALSE;
  }

  public function convert($value, $definition, $name, array $defaults, Request $request) {

  }
}
