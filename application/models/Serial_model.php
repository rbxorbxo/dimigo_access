<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Serial_model extends CI_Model {
  function __construct(){
    parent::__construct();
  }

  public function index() {
    $this->session->set_flashdata('message', 'No direct access admitted');
    redirect("/");
  }

  function search($serial){
    $data = $this->db->get_where('r_outaccess', array('serial'=>$serial))->row();

    $this->load->view('core/head', array('title'=>SITE_NAME." - Serial"));
    $this->load->view('core/navbar');
    if (empty($data)) {
      $this->load->view('serial/main', array('data'=>null));
    } else {
      $this->load->view('serial/main', array('data'=>$data));
    }
    $this->load->view('core/footer', array("active"=>"serial"));
  }
}
