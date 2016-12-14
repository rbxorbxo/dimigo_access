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
    $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));

    $serial = "dimi";
    $serial .= base_convert(round(fmod(microtime(true), 1000000) * 1000), 10, 14);
    $serial = strrev($serial);

    if (!empty($request_data)) {
      $data = array(
        'user_idx' => $this->session->userdata('idx') ,
        'name' => $this->session->userdata('username'),
        'grade' => $this->session->userdata('usergrade'),
        'class' => $this->session->userdata('userclass'),
        'rfid' => $this->session->userdata('rfidcode')
      );

      $this->db->insert('outaccess', $data);
      $insert_id = $this->db->insert_id();

      $data_detail = array(
        "idx" => $insert_id,
        "form" => $request_data['reason'],
        "start_time" =>$request_data['start'],
        "end_time" =>$request_data['end'],
        'submit_time' => $date->format('Y-m-d H:i:s'),
        "comment" => $request_data['comment'],
        "serial" => $serial
      );
      $this->db->insert('outaccess_detail', $data_detail);

      $this->session->set_flashdata('message', '외출 신청이 완료되었습니다.\\n일련번호는 '.$serial.' 입니다.');
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

  function delete($idx) {
    $original = $this->request_model->get($idx)[0];
    if ($original->status > 0) {
      $this->session->set_flashdata('message', '삭제할 수 없습니다');
    } else {
      $this->db->delete('outaccess', array('idx'=>$idx));
      $this->db->delete('outaccess_detail', array('idx'=>$idx));

      $this->session->set_flashdata('message', '삭제되었습니다');
    }
    redirect(site_url('request/show'));
  }

  function getReason(){
    return $this->db->from('outaccess_form')->order_by('form_idx', 'ASC')->get()->result();
  }

  public function get($idx="") {
    $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));
    if (empty($idx)) {
      return $this->db->
      from('r_outaccess')->
      join('outaccess_form', 'r_outaccess.form = outaccess_form.form_idx', 'left')->
      like('r_outaccess.submit_time', $date->format('Y-m-d'), 'after')->
      where(array('r_outaccess.user_idx'=>$this->session->userdata('idx')))->
      order_by('start_time', 'ASC')->
      order_by('end_time', 'ASC')->
      order_by('r_outaccess.idx', 'ASC')->
      get()->
      result();
    } else {
      return $this->db->
      from('r_outaccess')->
      join('outaccess_form', 'r_outaccess.form = outaccess_form.form_idx', 'left')->
      like('r_outaccess.submit_time', $date->format('Y-m-d'), 'after')->
      where(array('r_outaccess.user_idx'=>$this->session->userdata('idx'), 'r_outaccess.idx'=>$idx))->
      get()->
      result();
    }
  }

  public function get_num() {
    $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));
    return $this->db->
    from('r_outaccess')->
    like('submit_time', $date->format('Y-m-d'), 'after')->
    where(array('user_idx'=>$this->session->userdata('idx')))->
    count_all_results();
  }
}
