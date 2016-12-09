<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->output->delete_cache();
  }

  public function index() {
    $this->session->set_flashdata('message', 'No direct access admitted');
    redirect("/");
  }

  public function login(){
    $this->load->library('form_validation');
    $this->load->model('auth_model');

    $this->form_validation->set_rules('USER_ID', 'ID', 'trim|required');
    $this->form_validation->set_rules('USER_PW', 'Password', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('core/head', array('title'=>SITE_NAME." - Login"));
      $this->load->view('core/navbar');
      $this->load->view('auth/login');
      $this->load->view('core/footer', array("active"=>"login"));
    }	else {
      $USERID = $this->input->post('USER_ID');
      $USERPW = $this->input->post('USER_PW');

      $apiURL = "/v1/users/verify";
      $apiData = "?username=$USERID&password=".urlencode($USERPW);
      $api_URL = $apiURL.$apiData;
      $getUserData = $this->auth_model->GETAPI($api_URL);

      if ($getUserData["HTTP_CODE"] == 200) {
        $this->session->set_flashdata('message', "로그인 성공");

        $result = $getUserData["HTTP_RESULT"][0];

        $data = array(
          "idx" => $result->id,
          "userid" => $result->username,
          "username" => $result->name,
          "usertype" => $result->user_type
        );

        $this->session->set_userdata($data);

        redirect('/');
      } else if ($getUserData['HTTP_CODE'] == 404) {
        $this->session->set_flashdata('message', "아이디 또는 비밀번호가 틀렸습니다.");
        $this->load->view('core/head', array('title'=>SITE_NAME." - Login"));
        $this->load->view('core/navbar');
        $this->load->view('auth/login');
        $this->load->view('core/footer', array("active"=>"login"));
      } else {
        $this->session->set_flashdata('message', "기타 에러 발생");
        $this->load->view('core/head', array('title'=>SITE_NAME." - Login"));
        $this->load->view('core/navbar');
        $this->load->view('auth/login');
        $this->load->view('core/footer', array("active"=>"login"));
      }
    }
  }

  public function logout() {
    $this->session->sess_destroy();
    redirect("/");
  }
}
