<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->output->delete_cache();
    $this->output->set_header("content-type: application/json");
  }

  public function index() {
    die(json_encode(array(
      "status"    =>  FALSE,
      "message"   =>  "No direct access admitted"
    )));
  }

  public function rfidcode($rfid) {
    $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));
    die(json_encode($this->db->
    from('r_outaccess')->
    join('outaccess_form', 'r_outaccess.form = outaccess_form.id', 'left')->
    like('r_outaccess.submit_time', $date->format('Y-m-d'), 'after')->
    where(array('rfid'=>$rfid))->
    order_by('start_time', 'ASC')->
    order_by('end_time', 'ASC')->
    order_by('idx', 'ASC')->
    get()->
    result()));
  }
}
