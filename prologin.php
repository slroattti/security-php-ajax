<?php
require_once 'config.php';

if(isset($_POST['send'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $captcha_code = isset($_POST['captcha_code']) ? $_POST['captcha_code'] : '';

    if(empty($username) || empty($password)) {
        $_SESSION['error'] = "Username or password is empty.";
        goto here;
    }

    if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $captcha_code) != 0){  
		$_SESSION['error'] = "<span style='color:red'>The Validation code does not match!</span>";// Captcha verification is incorrect.		
        goto here;
	}

    $url = BASE_URL_LINK . "security/login-api.php";
    // echo $url; die;
    $data = [
        'username' => aes_encrypt($username, $key),
        'password' => aes_encrypt($password, $key),
    ];
    // echo '<pre>';
    // print_r($data); die;
    $response = post($url, $data);
    $res = json_decode($response, true);
    // var_dump($res); die;

    if ($res["code"] == 200) {
        $_SESSION['success'] = 'Success.';
        header('location: getform.php');
    } else {
        $_SESSION['error'] = 'Failed.';
        header('location: login.php');
    }
}

here: header('location: login.php');

?>