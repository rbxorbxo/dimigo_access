<?php
class R_outaccess extends CI_Model {
  function __construct(){
    parent::__construct();
  }

  function index($data){
    if($data){

      $this->session->

      $data = array(
         'id' => '$this->session->userdata('userid')' ,
         'name' => '$this->session->userdata('username')' ,
      );

      $data_check = array(
         'id' => '$this->session->userdata('userid')' ,
         'name' => '$this->session->userdata('username')' ,
      );
      $this->db->insert('outaccess', $data);
    }else{
      echo"<script>alert('잘못된 접근 입니다.');</script>";
    }
  }
}
