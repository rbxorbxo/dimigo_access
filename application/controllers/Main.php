<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->output->delete_cache();
  }

  public function index() {
    $this->load->view('core/head', array('title'=>SITE_NAME));
    $this->load->view('core/navbar');
    //print_r($this->session->userdata());
    $this->load->view('main/main');
    $this->load->view('core/footer', array("active"=>"main"));
  }
}
