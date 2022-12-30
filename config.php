<?php
   require_once 'aes_encryp.php';
   require_once 'chk_sum.php';
   session_start();

   function wh_log($log_msg, $log_filename)
   {
      if (!file_exists($log_filename)) 
      {
         // create directory/folder uploads.
         mkdir($log_filename, 0777, true);
      }
      $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
      file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
   }

   define("BASE_URL", "http://localhost/security-php-ajax/");
   define("API_URL", "https://fc1b-180-183-250-244.ap.ngrok.io/security-php-ajax");
   define("CAPTCHA_URL", "https://fc1b-180-183-250-244.ap.ngrok.io/security-php-ajax/phptextcaptcha/phptextcaptcha/captcha.php?rand=");
   $key = "oattiz!";
   $appId = "2001";
   $passportId = "welcome'tomayworld";

   require_once 'db.php';
   
   $conn = connect_db();

   function is_login() {
      // no login
      $status_login = false;
      // if have session with status ok
      if(isset($_SESSION['is_login']) && $_SESSION['is_login']  == 'yes') {
          $status_login = true;
      }
      return $status_login;
  }

   function json_response($data) {
      header('Content-Type: application/json; charset=UTF-8');
      echo json_encode($data, JSON_UNESCAPED_UNICODE);
      die();
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