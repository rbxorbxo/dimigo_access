<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->output->delete_cache();
    $this->load->model('Manager_model');
  }

  public function index() {

    $total = $this->Manager_model->get_request();
    $data = $total->result();

    $this->load->view('core/head', array('title'=>SITE_NAME." - Manage"));
    $this->load->view('core/navbar');
    $this->load->view('manage/main',array('data'=>$data, 'abc' =>"123") );
    $this->load->view('core/footer', array("active"=>"manage"));
  }
}
