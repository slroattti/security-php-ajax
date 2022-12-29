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
    if (preg_match("/^[0-9\s]+$/", $firstname)) {
        $log_filename = "C:/xampp/htdocs/security-php-ajax/logs";
        $log_time = date('Y-m-d H:i:s');

        $_SESSION['error'] = "Only firstname letters and white space allowed";
        
        wh_log('##################################', $log_filename);
        wh_log("###### " . $log_time . " ###########", $log_filename);
        $msg_start = " ******** " . $_SESSION['error'] . " ********";
        $msg_end = " ******** " . preg_match($petr1, $firstname) . " ********";
        wh_log($msg_start, $log_filename);
        wh_log($msg_end, $log_filename);
        goto here;
    }
    if (preg_match("/^[0-9\s]+$/", $lastname)) {
        $_SESSION['error'] = "Only lastname letters and white space allowed";
        goto here;
    }
    if (!preg_match("/^([a-zA-Z0-9_-]+)$/", $username)) {
        wh_log('##################################', $log_filename);
        wh_log("###### " . $log_time . " ###########", $log_filename);

        $_SESSION['error'] = "Only username letters and white space allowed";

        $msg_start = " ******** " . $_SESSION['error'] . " ********";
        $msg_end = " ******** " . !preg_match("/^([a-zA-Z0-9_-]+)$/", $username) . " ********";
        wh_log($msg_start, $log_filename);
        wh_log($msg_end, $log_filename);
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
    
    $url = API_URL . "/api.php";
    // echo $url; die;
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
    // echo '<pre>';
    // print_r($data); die;
    $response = post($url, $data);
    // print_r($response); die;
    $res = json_decode($response, true);
    // print_r($res); die;

    if ($res["code"] == 200) {
        $_SESSION['success'] = 'Success.';
        header('location: form.php');
    } else {
        $_SESSION['error'] = 'Failed.';
        header('location: form.php');
    }
}
here: header('location: form.php');
