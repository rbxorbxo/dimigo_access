<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->output->delete_cache();
    $this->load->model('search_model');
  }

  public function index() {
    $this->session->set_flashdata('message', 'No direct access accepted');
    redirect(site_url('/'));
  }

  public function serial() {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('serialNo', '일련번호', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('core/head', array('title'=>SITE_NAME." - Search"));
      $this->load->view('core/navbar');
      $this->load->view('search/serial', array('data'=>FALSE));
      $this->load->view('core/footer', array("active"=>"search"));
    } else {
      $serial = $this->input->post('serialNo');
      $result = $this->search_model->get_serial($serial);
      print_r($result);
    }
  }

  public function name() {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('name', '이름', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('core/head', array('title'=>SITE_NAME." - Search"));
      $this->load->view('core/navbar');
      $this->load->view('search/name', array('data'=>FALSE));
      $this->load->view('core/footer', array("active"=>"search"));
    } else {
      $name = $this->input->post('name');
      $result = $this->search_model->get_name($name);
      print_r($result);
    }
  }
}
