<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->output->delete_cache();
    $this->load->model('api_model');
    $this->output->set_header("Content-type: application/json");
  }

  public function index() {
    die(json_encode(array(
      "status"    => FALSE,
      "message"   => "No direct access admitted"
    )));
  }

  public function rfidcode($rfid) {
    die(json_encode(array(
      "status"  => TRUE,
      "result"  => $this->api_model->getInfoByRfidCode($rfid))
    ));
  }

  public function rfidtime($rfid) {
    $res = $this->api_model->rfid_timestamp($rfid);
    die(json_encode(array(
      "status"  => $res,
      "result"  => $res ? "Success" : "Internal Server Error"
    )));
  }
}
