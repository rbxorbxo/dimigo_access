<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->output->delete_cache();
    $this->load->library('form_validation');
    //$this->load->model('auth_model');
  }

  public function index() {
    $this->load->view('core/head', array('title'=>'Dimigo Access - Request'));
    $this->load->view('core/navbar');
    $this->load->view('request/main');
    $this->load->view('core/footer', array("active"=>"request"));
  }

  public function add() {
    $this->form_validation->set_rules('reason', '외출 사유', 'trim|required');
    $this->form_validation->set_rules('start', '시작 시간', 'trim|required');
    $this->form_validation->set_rules('end', '종료 시간', 'trim|required');
    if ($this->input->post('reason') == "기타") $this->form_validation->set_rules('comment', '코멘트', 'trim|required');
    else $this->form_validation->set_rules('comment', '코멘트', 'trim');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('core/head', array('title'=>'Dimigo Access - Request'));
      $this->load->view('core/navbar');
      $this->load->view('request/main');
      $this->load->view('core/footer', array("active"=>"request"));
    }	else {
      $reason = $this->input->post('reason');
      if ($reason == "기타")
      $reason = $this->input->post('reason-else');
      $start = $this->input->post('start');
      $end = $this->input->post('end');
      $comment = nl2br($this->input->post('comment'), FALSE);

      echo $reason."<br>";
      echo $start."<br>";
      echo $end."<br>";
      echo $comment."<br>";
    }
  }
}
