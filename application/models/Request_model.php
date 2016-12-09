<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_model extends CI_Model {
  function __construct(){
    parent::__construct();
  }

  public function index() {
    $this->session->set_flashdata('message', 'No direct access admitted');
    redirect("/");
  }

  function input($request_data){
    if (!empty($request_data)) {
      $reason = $this->set_reason($request_data['reason']);

      $data = array(
        'id' => $this->session->userdata('idx') ,
        'name' => $this->session->userdata('username'),
        'grade' => $this->session->userdata('usergrade'),
        'class' => $this->session->userdata('userclass'),
        'status' => "0"
      );

      $this->db->insert('outaccess', $data);
      $insert_id = $this->db->insert_id();

      $data_detail = array(
        "idx" => $insert_id,
        "form" => $reason,
        "start_time" =>$request_data['start'],
        "end_time" =>$request_data['end'],
        "comment" => $request_data['comment']
      );
      $this->db->insert('outaccess_detail', $data_detail);

      $this->session->set_flashdata('message', '외출 신청이 완료 되었습니다.');
      redirect(site_url('request'));
    } else {
      $this->session->set_flashdata('message', '잘못된 접근입니다');
      redirect(site_url('request'));
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

  function getReason(){
    return $this->db->from('outaccess_form')->get()->result();
  }

  public function get() {
    $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));
    echo $date->format('Y-m-d');
    return $this->db->
    from('r_outaccess')->
    join('outaccess_form', 'r_outaccess.form = outaccess_form.id', 'left')->
    like('r_outaccess.submit_time', $date->format('Y-m-d'), 'after')->
    where(array('r_outaccess.id'=>$this->session->userdata('idx')))->
    get()->
    result();
  }
}
