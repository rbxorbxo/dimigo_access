<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {
  function __construct(){
    parent::__construct();
  }

  public function index() {
    $this->session->set_flashdata('message', 'No direct access admitted');
    redirect("/");
  }

  function get_serial($serial){
    $data = $this->db->get_where('r_outaccess', array('serial'=>$serial))->row();

    $this->load->view('core/head', array('title'=>SITE_NAME." - Search"));
    $this->load->view('core/navbar');
    $this->load->view('search/serial', array('data'=>$data));
    $this->load->view('core/footer', array("active"=>"search"));
  }

  function get_name($name){
    $data = $this->db->from('r_outaccess')->like('name', $name, 'both')->get()->result();

    $this->load->view('core/head', array('title'=>SITE_NAME." - Search"));
    $this->load->view('core/navbar');
    $this->load->view('search/name', array('data'=>$data));
    $this->load->view('core/footer', array("active"=>"search"));
  }
}
