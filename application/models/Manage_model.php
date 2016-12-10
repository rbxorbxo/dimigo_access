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

    if ($type == '0') {
      $data = $this->db->
      from('r_outaccess')->
      join('outaccess_form', 'r_outaccess.form = outaccess_form.id', 'left')->
      like('submit_time', $date->format('Y-m-d'), 'after')->
      order_by('start_time', 'ASC')->
      order_by('end_time', 'ASC')->
      order_by('idx', 'ASC')->
      get()->
      result();
    } else if ($type == '1') {
      $data = $this->db->
      from('r_outaccess')->
      join('outaccess_form', 'r_outaccess.form = outaccess_form.id', 'left')->
      like('submit_time', $date->format('Y-m-d'), 'after')->
      where(array('status'=>0))->
      order_by('start_time', 'ASC')->
      order_by('end_time', 'ASC')->
      order_by('idx', 'ASC')->
      get()->
      result();
    } else if ($type == '2') {
      $data = $this->db->
      from('r_outaccess')->
      join('outaccess_form', 'r_outaccess.form = outaccess_form.id', 'left')->
      like('submit_time', $date->format('Y-m-d'), 'after')->
      where(array('status'=>1))->
      order_by('start_time', 'ASC')->
      order_by('end_time', 'ASC')->
      order_by('idx', 'ASC')->
      get()->
      result();
    } else if ($type == '3') {
      $data = $this->db->
      from('r_outaccess')->
      join('outaccess_form', 'r_outaccess.form = outaccess_form.id', 'left')->
      like('submit_time', $date->format('Y-m-d'), 'after')->
      where(array('status'=>-1))->
      order_by('start_time', 'ASC')->
      order_by('end_time', 'ASC')->
      order_by('idx', 'ASC')->
      get()->
      result();
    }
    return $data;
  }

  function Insert_data($idx, $type, $comment) {
    if ($this->session->userdata('userclass') == 0) {
      $teacher_per = 1; // 부장쌤
    } else {
      $teacher_per = 0; // 담임쌤
    }

    //같은 선생님께서 두 번 승인하시는 경우 예외 처리
    $teacher_name = $this->db->get_where('outaccess_checked', array('checked' => $idx))->row();

    if (!empty($teacher_name) && $this->session->userdata("username") == $teacher_name) {
      $this->session->set_flashdata("message","이미 승인하셨습니다.");
      redirect(site_url('manage'));
    }

    if ($type == "admit") {
      $data = array(
        'id' => $this->session->userdata('userid') ,
        'name' => $this->session->userdata('username'),
        'per' => $teacher_per,
        'checked' => $idx,
        'status' => "1"
      );

      $this->db->insert('outaccess_checked', $data);

      $count = $this->db->get_where('outaccess_checked', array('checked' => '1', "checked" =>$idx))->num_rows();

      if ($count == '2')
      $this->db->where('idx', $idx)->update('outaccess', array('status' => 1));

      $this->session->set_flashdata("message", "인증되었습니다.");

      redirect(site_url('manage'));

    } else if ($type == "reject") {

      $data = array(
        'id' => $this->session->userdata('userid') ,
        'name' => $this->session->userdata('username'),
        'per' =>$teacher_per,
        'checked' => $idx,
        'status' => "0",
        'comment' => $comment
      );

      $this->db->insert('outaccess_checked', $data);

      $this->db->where('idx', $idx);
      $this->db->update('outaccess', array('status' => -1));

      $this->session->set_flashdata("message", "거부되었습니다.");

      redirect(site_url('manage'));
    }
  }

  function Modify_data($idx , $go , $end){
    if($go == "reject" && $end =="admit")
    $this->db->where('idx', $idx)->update('outaccess', array('status' => 1));

    else if ($go == "admit" && $end =="reject")
    $this->db->where('idx', $idx)->update('outaccess', array('status' => -1));

    $this->session->set_flashdata("message","변경되었습니다!");
    redirect(site_url('manage'));
  }
}
