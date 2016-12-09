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

  public function getRequest($type="") {
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
}
