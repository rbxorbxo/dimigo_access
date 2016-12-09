<?php
class Auth_model extends CI_Model {
  function __construct(){
    parent::__construct();
  }

  function GETAPI($url, $isSSL = true){
    $_DIMIGO_API_HOST = "api.dimigo.org";
    $_DIMIGO_API_PW = "asd456";
    $_DIMIGO_API_ID = "rbxorbxo";

    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL,"http://".$_DIMIGO_API_HOST.$url);
    curl_setopt($ch, CURLOPT_USERPWD, $_DIMIGO_API_ID.":".$_DIMIGO_API_PW);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, $isSSL == true ? 1 : 0);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);

    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    $returnInfo = curl_getinfo($ch);

    return array('HTTP_CODE' => $statusCode , 'HTTP_RESULT'=> json_decode($result));
  }
}
