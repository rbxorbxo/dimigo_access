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

  function rfid_timestamp($rfid) {
    $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));
    $data = $this->db
    ->from('r_outaccess')
    ->join('outaccess_form', 'r_outaccess.form = outaccess_form.form_idx', 'left')
    ->like('r_outaccess.submit_time', $date->format('Y-m-d'), 'after')
    ->where(array('rfid'=>$rfid, 'status'=>2))
    ->order_by('start_time', 'ASC')
    ->order_by('end_time', 'ASC')
    ->order_by('idx', 'ASC')
    ->get()
    ->result();

    if (!count($data)) die(json_encode(array(
      "status"  => FALSE,
      "result"  => "외출 대상자가 아닙니다"
    )));

    foreach ($data as $req) {
      if (empty($req->out_time)) {
        return $this->db
        ->where(array('idx'=>$req->idx))
        ->update('outaccess_detail', array('out_time'=>$date->format('H:i')));
      } else if (empty($req->back_time)) {
        return $this->db
        ->where(array('idx'=>$req->idx))
        ->update('outaccess_detail', array('back_time'=>$date->format('H:i')));
      }
    }
    die(json_encode(array(
      "status"  => FALSE,
      "result"  => "이미 외출이 완료되었습니다"
    )));
  }
}
