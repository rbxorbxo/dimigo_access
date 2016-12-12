<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_model {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    die(json_encode(array(
      "status"    => FALSE,
      "message"   => "No direct access admitted"
    )));
  }

  function getInfoByRfidCode($rfid) {
    $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));
    return $this->db
    ->from('r_outaccess')
    ->join('outaccess_form', 'r_outaccess.form = outaccess_form.form_idx', 'left')
    ->like('r_outaccess.submit_time', $date->format('Y-m-d'), 'after')
    ->where(array('rfid'=>$rfid))
    ->order_by('start_time', 'ASC')
    ->order_by('end_time', 'ASC')
    ->order_by('idx', 'ASC')
    ->get()
    ->result();
  }
}
