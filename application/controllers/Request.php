<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->output->delete_cache();
    $this->load->library('form_validation');
    $this->load->model('request_model');

    if (empty($this->session->userdata('userid'))) {
      $this->session->set_flashdata('message', '로그인이 필요합니다');
      redirect(site_url("auth/login"));
    } else if ($this->session->userdata('usertype') != "S") {
      $this->session->set_flashdata('message', '학생 전용 페이지입니다');
      redirect(site_url("/"));
    }
  }

  public function index() {
    $this->load->view('core/head', array('title'=>SITE_NAME." - Request"));
    $this->load->view('core/navbar');
    $this->load->view('request/main', array('reasons'=>$this->request_model->getReason(), 'num'=>$this->request_model->get_num()));
    $this->load->view('core/footer', array("active"=>"request"));
  }

  public function add() {
    $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));
    if (!(8 <= (int)$date->format('G') && (int)$date->format('G') < 18)) {
      $this->session->set_flashdata('message', '신청 시간이 아닙니다.\\n(08:00 ~ 18:00)');
      //redirect(site_url('request'));
    }

    $this->form_validation->set_rules('reason', '외출 사유', 'trim|required');
    $this->form_validation->set_rules('start', '시작 시간', 'trim|required');
    $this->form_validation->set_rules('end', '종료 시간', 'trim|required');
    if ($this->input->post('reason') == 1) $this->form_validation->set_rules('comment', '코멘트', 'trim|required');
    else $this->form_validation->set_rules('comment', '코멘트', 'trim');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('core/head', array('title'=>SITE_NAME." - Request"));
      $this->load->view('core/navbar');
      $this->load->view('request/main', array('reasons'=>$this->request_model->getReason(), 'num'=>$this->request_model->get_num()));
      $this->load->view('core/footer', array("active"=>"request"));
    }	else {
      $reason = $this->input->post('reason');
      $start = $this->input->post('start');
      $end = $this->input->post('end');
      $comment = nl2br($this->input->post('comment'), FALSE);

      $request_data = array(
        "reason" => $reason,
        "start" => $start,
        "end" => $end,
        "comment" => $comment
      );

      $this->request_model->input($request_data);
    }
  }

  public function show() {
    $requests = $this->request_model->get();

    $this->load->view('core/head', array('title'=>SITE_NAME." - Request"));
    $this->load->view('core/navbar');
    $this->load->view('request/show', array('requests'=>$requests));
    $this->load->view('core/footer', array('active'=>'request'));
  }

  public function edit($idx) {
    $original = $this->request_model->get($idx)[0];
    if ($original->status != 0) {
      $this->session->set_flashdata('message', '수정할 수 없습니다');
      redirect(site_url('request/show'));
    }

    $this->form_validation->set_rules('reason', '외출 사유', 'trim|required');
    $this->form_validation->set_rules('start', '시작 시간', 'trim|required');
    $this->form_validation->set_rules('end', '종료 시간', 'trim|required');
    if ($this->input->post('reason') == 1) $this->form_validation->set_rules('comment', '코멘트', 'trim|required');
    else $this->form_validation->set_rules('comment', '코멘트', 'trim');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('core/head', array('title'=>SITE_NAME." - Request"));
      $this->load->view('core/navbar');
      $this->load->view('request/edit', array('reasons'=>$this->request_model->getReason(), 'original'=>$original));
      $this->load->view('core/footer', array("active"=>"request"));
    }	else {
      $reason = $this->input->post('reason');
      $start = $this->input->post('start');
      $end = $this->input->post('end');
      $comment = nl2br($this->input->post('comment'), FALSE);

      $request_data = array(
        "reason" => $reason,
        "start" => $start,
        "end" => $end,
        "comment" => $comment
      );

      $this->request_model->update($idx, $request_data);
    }
  }

  public function delete($idx) {
    $this->request_model->delete($idx);
  }
}
