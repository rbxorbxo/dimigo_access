<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->output->delete_cache();
  }

  public function index() {
    $this->load->view('core/head', array('title'=>'Dimigo Access'));
    $this->load->view('core/navbar');
    $this->load->view('main/main');
    $this->load->view('core/footer', array("active"=>"main"));
  }
}
