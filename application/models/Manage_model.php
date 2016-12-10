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

    if (empty($type)) {
      $data = $this->db->
      from('r_outaccess')->
      join('outaccess_form', 'r_outaccess.form = outaccess_form.id', 'left')->
      like('submit_time', $date->format('Y-m-d'), 'after')->
      order_by('start_time', 'ASC')->
      order_by('end_time', 'ASC')->
      order_by('idx', 'ASC')->
      get()->
      result();

    }else if($type == '1'){

      echo "type이 1";
      $query = $this->db->get_where('r_outaccess', array('status' => '0') );
      $result =  $query->result();
      $data = $result;


    } else {
      $data = $this->db->
      from('r_outaccess')->
      join('outaccess_form', 'r_outaccess.form = outaccess_form.id', 'left')->
      like('submit_time', $date->format('Y-m-d'), 'after')->
      where(array('status'=>$type))->
      order_by('start_time', 'ASC')->
      order_by('end_time', 'ASC')->
      order_by('idx', 'ASC')->
      get()->
      result();
    }

    return $data;
  }

  function Insert_data($idx, $type,$comment) {
    if ($this->session->userdata('userclass') == 0) {
      $teacher_per = 1; // 부장쌤
    } else {
      /*
      $query = $this->db->get_where('r_outaccess', array('idx' => $idx) );
      $result =  $query->result();
      $student_class = $result[0]->class;

      if($this->session->userdata('userclass') != $student_class){
      $this->seession->set_flashdata("message","해당학생의 담임 선생님 께서만 허락가능합니다.");
      */

      $teacher_per = 0; // 담임쌤
    }

    //같은 선생님께서 두번 인증하시는 경우 예외 처리
    $query = $this->db->get_where('outaccess_checked', array('checked' => $idx) );
    $result =  $query->result();
    $tearcher_name = $result[0]->name;

    if($this->session->userdata("username") == $tearcher_name){
      $this->session->set_flashdata("message","두 번 인증 하실수는 없습니다.");
      redirect(site_url('manage'));
    }

    if ($type == "admit") {
      $data = array(
        'id' => $this->session->userdata('userid') ,
        'name' => $this->session->userdata('username'),
        'per' =>$teacher_per,
        'checked' => $idx,
        'status' => "1",
        'comment' => "조심히 다녀 오길."
      );

      $this->db->insert('outaccess_checked', $data);

      $query = $this->db->get_where('outaccess_checked', array('checked' => '1', "checked" =>$idx));

      $count = $query->num_rows();

      if ($count == '2') {
        $data = array(
          'status' => 1
        );
        $this->db->where('idx', $idx);
        $this->db->update('outaccess', $data);
      }

        $this->session->set_flashdata("message","외출 인증이 완료 되었습니다!");

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

      $data = array(
        'status' => -1
      );
      $this->db->where('idx', $idx);
      $this->db->update('outaccess', $data);

      $this->session->set_flashdata("message","외출 거부가 완료 되었습니다!");

      redirect(site_url('manage'));


    }

  }

  function Modify_data($idx , $go , $end){
    if($go == "reject" && $end =="admit"){

      $data = array(
        'status' => 1
      );
      $this->db->where('idx', $idx);
      $this->db->update('outaccess', $data);

      $this->session->set_flashdata("message","외출 신청이 변경되었습니다!");

      redirect(site_url('manage'));

    }else if($go == "admit" && $end =="reject"){
      $data = array(
        'status' => -1
      );
      $this->db->where('idx', $idx);
      $this->db->update('outaccess', $data);

      $this->session->set_flashdata("message","외출 신청이 변경되었습니다!");

      redirect(site_url('manage'));
    }

  }
}
