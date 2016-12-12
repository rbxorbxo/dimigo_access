<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->output->delete_cache();
    $this->load->model('search_model');
    $this->load->library('form_validation');
  }

  public function index() {
    $this->session->set_flashdata('message', 'No direct access accepted');
    redirect(site_url('/'));
  }

  public function serial() {
    $this->form_validation->set_rules('serialNo', '일련번호', 'trim|required');

    $this->load->view('core/head', array('title'=>SITE_NAME." - Search"));
    $this->load->view('core/navbar');

    if ($this->form_validation->run() == FALSE) {
      $data = FALSE;
    } else {
      $serial = $this->input->post('serialNo');
      $data = $this->search_model->get_serial($serial);
    }
    $this->load->view('search/serial', array('data'=>$data));
    $this->load->view('core/footer', array("active"=>"search_serial"));
  }

  public function name() {
    $this->form_validation->set_rules('name', '이름', 'trim|required');

    $this->load->view('core/head', array('title'=>SITE_NAME." - Search"));
    $this->load->view('core/navbar');

    if ($this->form_validation->run() == FALSE) {
      $data = FALSE;
    } else {
      $name = $this->input->post('name');
      $data = $this->search_model->get_name($name);
    }
    $this->load->view('search/name', array('data'=>$data));
    $this->load->view('core/footer', array("active"=>"search_name"));
  }
}
