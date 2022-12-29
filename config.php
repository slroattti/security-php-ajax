<?php
   require_once 'aes_encryp.php';
   require_once 'chk_sum.php';
   session_start();

   define("BASE_URL", "http://localhost/security-php-ajax/");
   define("API_URL", "https://b130-49-237-7-180.ap.ngrok.io/security-php-ajax");
   define("CAPTCHA_URL", "https://b130-49-237-7-180.ap.ngrok.io/security-php-ajax/phptextcaptcha/phptextcaptcha/captcha.php?rand=");
   $key = "oattiz!";
   $appId = "2001";
   $passportId = "welcome'tomayworld";

   require_once 'db.php';
   
   $conn = connect_db();

   function json_response($data) {
      header('Content-Type: application/json; charset=UTF-8');
      echo json_encode($data, JSON_UNESCAPED_UNICODE);
      die();
   }

   function curl_post($url, $data) {

      $cURLConnection = curl_init($url);
      curl_setopt($cURLConnection, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, json_encode($data));
      curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
  
      $apiResponse = curl_exec($cURLConnection);
      curl_close($cURLConnection);
  
      // $apiResponse - available data from the API request
      $jsonArrayResponse = json_decode($apiResponse, true);
      return $jsonArrayResponse;
   }

   function curl_get($url) {
      $cURLConnection = curl_init();
  
      curl_setopt($cURLConnection, CURLOPT_URL, $url);
      curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
  
      $phoneList = curl_exec($cURLConnection);
      curl_close($cURLConnection);
  
      $jsonArrayResponse = json_decode($phoneList, true);
      return $jsonArrayResponse;
     }


   function post($url, $data) {

      $cURLConnection = curl_init($url);
      curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $data);
      curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
      
      $apiResponse = curl_exec($cURLConnection);
      curl_close($cURLConnection);

      return $apiResponse;
   }
?>