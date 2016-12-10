<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->output->delete_cache();
    $this->load->model('manage_model');

    if ($this->session->userdata('usertype') != "T") {
      $this->session->set_flashdata('message', '교사 전용 페이지입니다');
      redirect("/");
    }
  }

  public function index() {
    $num = $this->manage_model->get_num();

    $this->load->view('core/head', array('title'=>SITE_NAME." - Manage"));
    $this->load->view('core/navbar');
    $this->load->view('manage/main', array('num'=>$num));
    $this->load->view('core/footer', array("active"=>"manage"));
  }

  public function all() {
    $data = $this->manage_model->getRequest('0');

    $this->load->view('core/head', array('title'=>SITE_NAME." - Manage"));
    $this->load->view('core/navbar');
    $this->load->view('manage/all', array('data'=>$data));
    $this->load->view('core/footer', array("active"=>"manage"));
  }

  public function fresh() {
    $data = $this->manage_model->getRequest('1');

    print_r($data);

    $this->load->view('core/head', array('title'=>SITE_NAME." - Manage"));
    $this->load->view('core/navbar');
    $this->load->view('manage/fresh', array('data'=>$data));
    $this->load->view('core/footer', array("active"=>"manage"));
  }

  public function admit() {
    $data = $this->manage_model->getRequest('2');

    $this->load->view('core/head', array('title'=>SITE_NAME." - Manage"));
    $this->load->view('core/navbar');
    $this->load->view('manage/admit', array('data'=>$data));
    $this->load->view('core/footer', array("active"=>"manage"));
  }

  public function reject() {
    $data = $this->manage_model->getRequest('3');

    $this->load->view('core/head', array('title'=>SITE_NAME." - Manage"));
    $this->load->view('core/navbar');
    $this->load->view('manage/reject', array('data'=>$data));
    $this->load->view('core/footer', array("active"=>"manage"));
  }

  function Insert_admit($idx) {
    $this->manage_model->Insert_data($idx, "admit", "");
  }

  function Insert_reject($idx) {
    $comment = $_POST['comment'];
    $this->manage_model->Insert_data($idx, "reject", $comment);
  }

  function Modify_admit($idx){
    $this->manage_model->Modify_data($idx, "reject", "admit");
  }
}
