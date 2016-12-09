<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager_model extends CI_Model {
  function __construct(){
    parent::__construct();
  }

  public function index() {
    $this->session->set_flashdata('message', 'No direct access admitted');
    redirect("/");
  }

  function get_request(){
    $query = $this->db->query("SELECT * FROM r_outaccess WHERE status='0'");
    return $query;

  }

}
