<?php
require_once 'config.php';

if (isset($_POST['send'])) {
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
    $nickname = isset($_POST['nickname']) ? $_POST['nickname'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $comfirm_password = isset($_POST['comfirm_password']) ? $_POST['comfirm_password'] : '';
    $id_card = isset($_POST['id_card']) ? $_POST['id_card'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $captcha_code = isset($_POST['captcha_code']) ? $_POST['captcha_code'] : '';

    if (
        $firstname == "" ||
        $lastname == "" ||
        $nickname == "" ||
        $phone == "" ||
        $username == "" ||
        $password == "" ||
        $comfirm_password == "" ||
        $id_card == "" ||
        $address == ""
    ) {
        $_SESSION['error'] = 'Invalid input is empty.';
        goto here;
    }
    if ($email == "") {
        $_SESSION['error'] = 'Invalid email is empty.';
        goto here;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format";
        goto here;
    }
    $petr1 = "/^[a-zA-Z-' ]*$/";
    if (!preg_match($petr1, $firstname)) {
        $_SESSION['error'] = "Only letters and white space allowed";
        goto here;
    }
    if (!preg_match($petr1, $lastname)) {
        $_SESSION['error'] = "Only letters and white space allowed";
        goto here;
    }
    $petr2 = "/^([a-zA-Z0-9_-]+)$/";
    if (!preg_match($petr2, $username)) {
        $_SESSION['error'] = "Only letters and white space allowed";
        goto here;
    }

    if ($password != $comfirm_password) {
        $_SESSION['error'] = 'Invalid password and confirm password exists Please try again.';
        goto here;
    }

    if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $captcha_code) != 0){  
		$_SESSION['error'] = "<span style='color:red'>The Validation code does not match!</span>";// Captcha verification is incorrect.		
        goto here;
	}
    
    $url = BASE_URL_LINK . "security/api.php";
    $data = [
        'chk_sum' => md5($username . $appId . $passportId),
        'firstname' => aes_encrypt($firstname, $key),
        'lastname' => aes_encrypt($lastname, $key),
        'nickname' => aes_encrypt($nickname, $key),
        'phone' => aes_encrypt($phone, $key),
        'email' => aes_encrypt($email, $key),
        'username' => aes_encrypt($username, $key),
        'password' => aes_encrypt($password, $key),
        'comfirm_password' => aes_encrypt($comfirm_password, $key),
        'id_card' => aes_encrypt($id_card, $key),
        'address' => aes_encrypt($address, $key),
    ];
    // print_r($data); die;
    $response = post($url, $data);
    $res = json_decode($response, true);
    print_r($res);  

    if ($res["code"] == 200) {
        $_SESSION['success'] = 'Success.';
        header('location: form.php');
    } else {
        $_SESSION['error'] = 'Failed.';
        header('location: form.php');
    }
}
here: header('location: form.php');
