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

    $url = API_URL . "/login-api.php";
    // echo $url; die;
    $data = [
        'username' => aes_encrypt($username, $key),
        'password' => aes_encrypt($password, $key),
    ];
    // echo '<pre>';
    // print_r($data); die;
    $response = post($url, $data);
    // var_dump($response); die;
    $res = json_decode($response, true);
    // var_dump($res); die;

    if ($res["code"] == 200) {
        $_SESSION['success'] = 'Success.';
        $_SESSION['username'] = $res['result']['username'];
        $_SESSION['firstname'] = $res['result']['firstname'];
        $_SESSION['lastname'] = $res['result']['lastname'];
        $_SESSION['nickname'] = $res['result']['nickname'];
        $_SESSION['is_login'] = 'yes';
        // print_r($_SESSION); die();
        header('location: getform.php');
        exit;
    } else {
        $_SESSION['error'] = 'Failed.';
        header('location: login.php');
    }
}

here: header('location: login.php');

?>