<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->output->delete_cache();
    $this->load->model('manage_model');
  }

  public function index() {
    $num = $this->manage_model->get_num();

    $this->load->view('core/head', array('title'=>SITE_NAME." - Manage"));
    $this->load->view('core/navbar');
    $this->load->view('manage/main', array('num'=>$num));
    $this->load->view('core/footer', array("active"=>"manage"));
  }

  public function all() {
    $data = $this->manage_model->getRequest();

    $this->load->view('core/head', array('title'=>SITE_NAME." - Manage"));
    $this->load->view('core/navbar');
    $this->load->view('manage/all', array('data'=>$data));
    $this->load->view('core/footer', array("active"=>"manage"));
  }

  public function new() {
    $data = $this->manage_model->getRequest(0);

    $this->load->view('core/head', array('title'=>SITE_NAME." - Manage"));
    $this->load->view('core/navbar');
    $this->load->view('manage/new', array('data'=>$data));
    $this->load->view('core/footer', array("active"=>"manage"));
  }

  public function admit() {
    $data = $this->manage_model->getRequest(1);

    $this->load->view('core/head', array('title'=>SITE_NAME." - Manage"));
    $this->load->view('core/navbar');
    $this->load->view('manage/admit', array('data'=>$data));
    $this->load->view('core/footer', array("active"=>"manage"));
  }

  public function reject() {
    $data = $this->manage_model->getRequest(-1);

    $this->load->view('core/head', array('title'=>SITE_NAME." - Manage"));
    $this->load->view('core/navbar');
    $this->load->view('manage/reject', array('data'=>$data));
    $this->load->view('core/footer', array("active"=>"manage"));
  }
}
