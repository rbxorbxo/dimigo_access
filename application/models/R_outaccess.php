<?php
class R_outaccess extends CI_Model {
  function __construct(){
    parent::__construct();
  }

  function input($request_data){
    //print_r($request_data);
    if($request_data){

      $reason = $this->set_reason($request_data['reason']);

      $data_form = array(
        "id" => $reason,
        "form" => $request_data['reason']
      );

      $this->db->insert('outaccess_form', $data_form);

      $data = array(
        'id' => $this->session->userdata('idx') ,
        'name' => $this->session->userdata('username')
      );

      $this->db->insert('outaccess', $data);

      $insert_id = $this->db->insert_id();

      $data_check = array(
        'idx' => $insert_id,
        'Main_teacher' => 0,
        'Head_teacher' => 0
      );

      $data_detail = array(
        "idx" => $insert_id,
        "form" => $reason,
        "start_time" =>$request_data['start'],
        "end_time" =>$request_data['end'],
        "comment" => $request_data['comment']
      );

      $this->db->insert('outaccess_check', $data_check);
      $this->db->insert('outaccess_detail', $data_detail);

      $this->session->set_flashdata('message', '외출 신청이 완료 되었습니다.');
      redirect('/');

    }else{
      $this->session->set_flashdata('message', '잘못된 접근입니다');
      redirect('/');
    }
  }

  function set_reason($reason){
    switch ($reason) {
      case '병원':
        $result = 1;
        break;

      case '생필품':
        $result = 2;
        break;

      case '치킨':
        $result = 3;
        break;

      case '학원':
        $result = 4;
        break;

      case '기타':
        $result = 5;
        break;

      default:
        $result = 0;
        break;
    }

    return $result;
  }
}
