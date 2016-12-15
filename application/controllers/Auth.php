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
    } else {
      $USERID = $this->input->post('USER_ID');
      $USERPW = $this->input->post('USER_PW');

      $apiURL = "/v1/users/verify";
      $apiData = "?username=$USERID&password=".urlencode($USERPW);
      $api_URL = $apiURL.$apiData;
      $getUserData = $this->auth_model->GETAPI($api_URL);

      if ($getUserData["HTTP_CODE"] == 200) {
        $result = $getUserData["HTTP_RESULT"][0];

        if ($result->user_type == "S") {
          $apiURL = "/v1/user-students/";
          $getUserBasicData = $this->auth_model->GETAPI($apiURL.$USERID);

          $result1 = $getUserBasicData['HTTP_RESULT'];

          $data = array(
            "idx" => $result->id,               // user 인덱스
            "userid" => $result->username,      // user id
            "username" => $result->name,        // user 이름
            "usertype" => $result->user_type,   // user 타입

            "usergrade" => $result1->grade,     // user 학년
            "userclass" => $result1->class,     // user 반
            "rfidcode" => $result1->rfcard_uid, // user rfid 코드
            "userphoto" => $result1->photofile1 // user 이미지
          );
        } else if ($result->user_type == "T") {
          // http://api.dimigo.org/v1/user-teachers/[username]
          $apiURL = "/v1/user-teachers/";
          $getUserBasicData = $this->auth_model->GETAPI($apiURL.$result->username);

          $result1 = $getUserBasicData['HTTP_RESULT'];

          $data = array(
            "idx" => $result->id,               // user 인덱스
            "userid" => $result->username,      // user id
            "username" => $result->name,        // user 이름
            "usertype" => $result->user_type,   // user 타입

            "usergrade" => $result1->grade,     // user 학년
            "userclass" => empty($result1->class) ? 0 : $result1->class,    // user 반
            "userlevel" => preg_match("/\d학년부장/", $result1->role_name)    // 학년부장 여부
          );
        }

        if (!($data['userclass'] > 0 || $data['userlevel'])) {
          $this->session->set_flashdata('message', '담임교사 또는 학년부장이 아닙니다');
        } else {
          $this->session->set_userdata($data);
        }

        redirect(site_url('/'));

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
    redirect(site_url('/'));
  }
}
