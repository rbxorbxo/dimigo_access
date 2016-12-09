<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->output->delete_cache();
  }

  public function index() {
    $this->load->helper(array('form'));

    $this->load->library('form_validation');

    $this->form_validation->set_rules('USER_ID', 'Username', 'required');
    $this->form_validation->set_rules('USER_PW', 'Password', 'required');


    /*if ($this->form_validation->run() == FALSE)
    {
    $this->load->view('account');
  }	else {
  $this->load->view('main/main');
}*/


$this->load->view('core/head');
$this->load->view('core/navbar');
$this->load->view('auth/login');
$this->load->view('core/footer', array("active"=>"login"));
}

function login(){

    $USERID = $this->input->post('USER_ID');
    $USERPW = $this->input->post('USER_PW');


    $apiURL = "/v1/users/verify";
    $apiData = "?username=$USERID&password=".urlencode($USERPW);
    $api_URL = $apiURL.$apiData;
    $getUserData = $this->GETAPI($api_URL);

    //var_dump($getUserData);
    if($getUserData["HTTP_CODE"] == 200){
      echo "데이터 있음";
    }else if ($getUserData['HTTP_CODE'] == 404){
      echo "데이터 없음";
    } else {
      echo "어 시발 뭐가 이상해";
    }

}

function GETAPI($url, $isSSL = true){
       $_DIMIGO_API_HOST = "api.dimigo.org";
       $_DIMIGO_API_PW = "rbxorbxo";
       $_DIMIGO_API_ID = "asd456";


       $ch = curl_init();
       //echo "success<br>";
       curl_setopt($ch,CURLOPT_URL,"http://".$_DIMIGO_API_HOST.$url);
       echo $_DIMIGO_API_HOST.$url;

       curl_setopt($ch, CURLOPT_USERPWD, "rbxorbxo:asd456");
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, $isSSL == true ? 1 : 0);
       curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
       $result = curl_exec($ch);
       //echo "success<br>";

       // echo $_DIMIGO_API_HOST.$url;
       // exit();
       // var_dump($_DO)
       $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
       $error = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
       $returnInfo = curl_getinfo($ch);
       // var_dump(array('HTTP_CODE' => $statusCode , 'HTTP_RESULT'=> json_decode($result)));
       // exit();
       // var_dump($returnInfo);
       // var_dump($returnInfo);
       // exit();

       echo "<br>";
       return array('HTTP_CODE' => $statusCode , 'HTTP_RESULT'=> json_decode($result));

   }

}
