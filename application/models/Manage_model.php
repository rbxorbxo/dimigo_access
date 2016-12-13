<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_model extends CI_Model {
  function __construct(){
    parent::__construct();
  }

  public function index() {
    $this->session->set_flashdata('message', 'No direct access admitted');
    redirect("/");
  }

  public function get_num(){
    $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));

    $num['all'] = $this->db
    ->from('r_outaccess')
    ->like('submit_time', $date->format('Y-m-d'), 'after')
    ->count_all_results();

    $this->db->from('r_outaccess')
    ->like('submit_time', $date->format('Y-m-d'), 'after');

    if ($this->session->userdata('userclass') == 0) {
      $this->db->where(array('status' => 1));
    } else {
      $this->db->where(array('status' => 0));
    }

    $num['fresh'] = $this->db->count_all_results();

    $num['admit'] = $this->db
    ->from('r_outaccess')
    ->like('submit_time', $date->format('Y-m-d'), 'after')
    ->where(array('status' => 2))
    ->count_all_results();

    $num['reject'] = $this->db
    ->from('r_outaccess')
    ->like('submit_time', $date->format('Y-m-d'), 'after')
    ->where(array('status <' => 0))
    ->count_all_results();

    return $num;
  }

  public function getRequest($type) {
    $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));

    $this->db
    ->from('r_outaccess')
    ->join('outaccess_form', 'r_outaccess.form = outaccess_form.form_idx', 'left')
    ->like('submit_time', $date->format('Y-m-d'), 'after');

    if ($type == '1') {
      if ($this->session->userdata('userclass') == 0) {
        $this->db->where(array('status' => 1));
      } else {
        $this->db->where(array('status' => 0));
      }
    } else if ($type == '2') {
      $this->db->where(array('status' => 2));
    } else if ($type == '3') {
      $this->db->where(array('status <' => 0));
    }

    return $this->db->order_by('start_time', 'ASC')
    ->order_by('end_time', 'ASC')
    ->order_by('idx', 'ASC')
    ->get()
    ->result();
  }

  function Insert_data($idx, $type, $comment="") {
    //같은 선생님께서 두 번 승인하시는 경우 예외 처리
    $admitted = $this->db->get_where('outaccess_detail', array('idx' => $idx))->row();

    if (!empty($teacher_name)) {
      if ($this->session->userdata('userclass') == 0 && $admitted->admit2) {
        $this->session->set_flashdata("message","이미 승인하셨습니다.");
        redirect($this->input->get("prev"));
      } else if ($admitted->admit1) {
        $this->session->set_flashdata("message","이미 승인하셨습니다.");
        redirect($this->input->get("prev"));
      }
    }

    if ($type == "admit") {
      $this->db->where(array('idx'=>$idx));

      if ($this->session->userdata('userclass') == 0) {
        $this->db->update('outaccess_detail', array('admit2' => 1));
      } else {
        $this->db->update('outaccess_detail', array('admit1' => 1));
      }

      $this->session->set_flashdata("message", "인증되었습니다.");
      redirect($this->input->get("prev"));

    } else if ($type == "reject") {
      $this->db->where(array('idx'=>$idx));

      if ($this->session->userdata('userclass') == 0) {
        $this->db->update('outaccess_detail', array('admit2' => -2, 'reject_comment' => $comment));
      } else {
        $this->db->update('outaccess_detail', array('admit1' => -2, 'reject_comment' => $comment));
      }

      $this->session->set_flashdata("message", "거부되었습니다.");
      redirect($this->input->get("prev"));
    }
  }

  function reset($idx){
    $original = $this->db->get_where('outaccess_detail', array('idx' => $idx))->row();

    if (($this->session->userdata('userclass') == 0 ? $original->admit2 : $original->admit1) == 1) {
      $this->session->set_flashdata('message', '이미 승인하신 요청은 취소할 수 없습니다');
    } else if ($this->session->userdata('userclass') == 0 && $original->admit1 -2) {
      $this->session->set_flashdata('message', '담임선생님께서 이미 거부하셨습니다');
    } else {
      $this->db->where(array('idx'=>$idx));
      if ($this->session->userdata('userclass') == 0) {
        $this->db->update('outaccess_detail', array('admit2' => 0));
      } else {
        $this->db->update('outaccess_detail', array('admit1' => 0));
      }
      $this->session->set_flashdata("message", "취소되었습니다");
    }
    redirect($this->input->get("prev"));
  }
}
