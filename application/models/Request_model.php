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
      $data = array(
        'id' => $this->session->userdata('idx') ,
        'name' => $this->session->userdata('username'),
        'grade' => $this->session->userdata('usergrade'),
        'class' => $this->session->userdata('userclass')
      );

      $this->db->insert('outaccess', $data);
      $insert_id = $this->db->insert_id();

      $data_detail = array(
        "idx" => $insert_id,
        "form" => $request_data['reason'],
        "start_time" =>$request_data['start'],
        "end_time" =>$request_data['end'],
        "comment" => $request_data['comment']
      );
      $this->db->insert('outaccess_detail', $data_detail);

      $this->session->set_flashdata('message', '외출 신청이 완료 되었습니다.');
      redirect(site_url('request/show'));
    } else {
      $this->session->set_flashdata('message', '잘못된 접근입니다');
      redirect(site_url('/'));
    }
  }

  function update($idx, $request_data) {
    if (!empty($request_data)) {
      $data_detail = array(
        "form" => $request_data['reason'],
        "start_time" =>$request_data['start'],
        "end_time" =>$request_data['end'],
        "comment" => $request_data['comment']
      );
      $this->db->update('outaccess_detail', $data_detail, array('idx'=>$idx));

      $this->session->set_flashdata('message', '외출 정보 수정이 완료 되었습니다.');
      redirect(site_url('request/show'));
    } else {
      $this->session->set_flashdata('message', '잘못된 접근입니다');
      redirect(site_url('/'));
    }
  }

  function getReason(){
    return $this->db->from('outaccess_form')->order_by('id', 'ASC')->get()->result();
  }

  public function get($idx="") {
    $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));
    if (empty($idx)) {
      return $this->db->
      from('r_outaccess')->
      join('outaccess_form', 'r_outaccess.form = outaccess_form.id', 'left')->
      like('r_outaccess.submit_time', $date->format('Y-m-d'), 'after')->
      where(array('r_outaccess.id'=>$this->session->userdata('idx')))->
      order_by('start_time', 'ASC')->
      order_by('end_time', 'ASC')->
      order_by('idx', 'ASC')->
      get()->
      result();
    } else {
      return $this->db->
      from('r_outaccess')->
      join('outaccess_form', 'r_outaccess.form = outaccess_form.id', 'left')->
      like('r_outaccess.submit_time', $date->format('Y-m-d'), 'after')->
      where(array('r_outaccess.id'=>$this->session->userdata('idx'), 'idx'=>$idx))->
      get()->
      result();
    }
  }

  public function get_num() {
    $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));
    return $this->db->
    from('r_outaccess')->
    like('submit_time', $date->format('Y-m-d'), 'after')->
    where(array('id'=>$this->session->userdata('idx')))->
    count_all_results();
  }
}
