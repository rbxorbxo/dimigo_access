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
    $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));
    return $this->db->from('r_outaccess')
    ->join('outaccess_form', 'r_outaccess.form = outaccess_form.form_idx', 'left')
    ->like('r_outaccess.submit_time', $date->format('Y-m-d'), 'after')
    ->where(array('serial'=>$serial))
    ->get()->row();
  }

  function get_name($name){
    $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));
    return $this->db->from('r_outaccess')
    ->join('outaccess_form', 'r_outaccess.form = outaccess_form.form_idx', 'left')
    ->like('r_outaccess.submit_time', $date->format('Y-m-d'), 'after')
    ->like('name', $name, 'both')
    ->get()->result();
  }
}
