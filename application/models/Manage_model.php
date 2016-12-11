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

    $num['all'] = $this->db->
    from('r_outaccess')->
    like('submit_time', $date->format('Y-m-d'), 'after')->
    count_all_results();

    $num['fresh'] = $this->db->
    from('r_outaccess')->
    like('submit_time', $date->format('Y-m-d'), 'after')->
    where(array('status'=>0))->
    count_all_results();

    $num['reject'] = $this->db->
    from('r_outaccess')->
    like('submit_time', $date->format('Y-m-d'), 'after')->
    where(array('status'=>-1))->
    count_all_results();

    $num['admit'] = $this->db->
    from('r_outaccess')->
    like('submit_time', $date->format('Y-m-d'), 'after')->
    where(array('status'=>1))->
    count_all_results();

    return $num;
  }

  public function getRequest($type) {
    $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));

    $this->db
    ->from('r_outaccess')
    ->join('outaccess_form', 'r_outaccess.form = outaccess_form.form_idx', 'left')
    ->like('submit_time', $date->format('Y-m-d'), 'after');

    if ($type == '1') {
      $this->db->where(array('status' => 0));
    } else if ($type == '2') {
      $this->db->where(array('status' => 1));
    } else if ($type == '3') {
      $this->db->where(array('status' => -1));
    }

    return $this->db->order_by('start_time', 'ASC')
    ->order_by('end_time', 'ASC')
    ->order_by('idx', 'ASC')
    ->get()
    ->result();
  }

  function Insert_data($idx, $type, $comment) {
    $teacher_per = $this->session->userdata('userclass') ? 0 : 1;     // 1: 부장, 0: 담임

    //같은 선생님께서 두 번 승인하시는 경우 예외 처리
    $teacher_name = $this->db->get_where('outaccess_checked', array('idx' => $idx))->row();

    if (!empty($teacher_name) && $this->session->userdata("idx") == $teacher_name->teacher_idx) {
      $this->session->set_flashdata("message","이미 승인하셨습니다.");
      redirect($this->input->get("prev"));
    }

    if ($type == "admit") {
      $data = array(
        'teacher_idx' => $this->session->userdata('idx'),
        'name' => $this->session->userdata('username'),
        'per' => $teacher_per,
        'idx' => $idx,
        'status' => "1"
      );

      $this->db->insert('outaccess_checked', $data);

      $count = $this->db->get_where('outaccess_checked', array("idx" =>$idx))->num_rows();

      if ($count == '2')
      $this->db->where('idx', $idx)->update('outaccess', array('status' => 1));

      $this->session->set_flashdata("message", "인증되었습니다.");
      redirect($this->input->get("prev"));
    } else if ($type == "reject") {
      $data = array(
        'teacher_idx' => $this->session->userdata('idx'),
        'name' => $this->session->userdata('username'),
        'per' =>$teacher_per,
        'idx' => $idx,
        'status' => "0",
        't_comment' => $comment
      );

      $this->db->insert('outaccess_checked', $data);
      $this->db->where('idx', $idx)->update('outaccess', array('status' => -1));

      $this->session->set_flashdata("message", "거부되었습니다.");

      redirect($this->input->get("prev"));
    }
  }

  function Modify_data($idx , $go , $end){
    if($go == "reject" && $end =="admit") {
      $this->db->where('idx', $idx)->update('outaccess', array('status' => 1));
    }

    else if ($go == "admit" && $end =="reject")
    $this->db->where('idx', $idx)->update('outaccess', array('status' => -1));

    $this->session->set_flashdata("message","변경되었습니다!");
    redirect($this->input->get("prev"));
  }
}
