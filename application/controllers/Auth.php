<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->output->delete_cache();
  }

  public function index() {
    $this->load->helper(array('form'));

    $this->load->library('form_validation');

    $this->form_validation->set_rules('USER_ID', 'Username', 'required');
    $this->form_validation->set_rules('USER_PW', 'Password', 'required');


    /*if ($this->form_validation->run() == FALSE)
    {
    $this->load->view('account');
  }	else {
  $this->load->view('main/main');
}*/


$this->load->view('core/head');
$this->load->view('core/navbar');
$this->load->view('auth/login');
$this->load->view('core/footer', array("active"=>"login"));
}

function login(){

    $USERID = $this->input->post('USER_ID');
    $USERPW = $this->input->post('USER_PW');
}

}
