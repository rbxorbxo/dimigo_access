<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Serial extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->output->delete_cache();
  }

  public function index() {
    redirect(site_url('serial/search'));
  }

  public function search() {
    $this->load->library('form_validation');
    $this->load->model('serial_model');

    $this->form_validation->set_rules('serialNo', 'Serial Number', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('core/head', array('title'=>SITE_NAME." - Serial"));
      $this->load->view('core/navbar');
      $this->load->view('serial/main', array('data'=>""));
      $this->load->view('core/footer', array("active"=>"serial"));
    } else {
      $serial = $this->input->post('serialNo');
      $result = $this->serial_model->search($serial);
      print_r($result);
    }
  }
}
