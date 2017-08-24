<?php

if( ! function_exists('old') ){
  
  function old($field_name){
    return isset($_REQUEST[$field_name]) ? $_REQUEST[$field_name] : '';
  }
  
}

if( ! function_exists('csrf_token') ){
  
  function csrf_token(){
    $token = sha1( rand(1, 1000) . date('Y.m.d.H.i.s') . 'fakebook');
    $_SESSION['token'] = $token;
    return $token;
  }
  
}

function verify_user(){
  
  $is_user = false;
  
  if( isset($_SESSION['user_ip']) &&  $_SESSION['user_ip'] == $_SERVER['REMOTE_ADDR']){

    if( isset($_SESSION['user_agent']) && $_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT'] ){

      if( isset($_SESSION['user_id']) ){
        
        $is_user = true;

      }

    }

  }
  
  return $is_user;
  
}

function email_exist($link, $email){
  
  $exist = false;
  $email = mysqli_real_escape_string($link, $email);
  $sql = "SELECT email FROM users WHERE email = '$email'";
  $result = mysqli_query($link, $sql);
  if( $result && mysqli_num_rows($result) == 1 ){
    $exist = true;
  }
  return $exist;
}