namespace \Drupal\Brief;

function main() {
  $query = db_select('brief', 'b');
  $query->join('company', 'c', 'b.company = c.cid');
  $query->fields('b', array('bid');
  $query->fields('c', array('name');
  $query->range(0, 10);

  $briefs = $query->execute()->fetchAll();

  return array(
    '#theme' => 'brief_list',
    '#briefs' => $briefs,
  );
}

class BriefInterface {
  public function create();
  public function update();
}

class Brief implements BriefIntreface {
  
  public function create() {

  }

  public function save() {

  }
}
