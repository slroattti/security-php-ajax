<?php
require_once 'config.php';

if (isset($_POST['password-reset'])) {
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $comfirm_pass = isset($_POST['comfrim_password']) ? $_POST['comfrim_password'] : "";

    if($password == "" || $comfirm_pass == "") {
        $_SESSION['error'] = "Please enter a password and confirm password";
        goto here;
    }

    if($password != $comfirm_pass) {
        $_SESSION['error'] = "Password and confirm password is not match";
        goto here;
    }

    $url = API_URL . 'forgetapi.php';
    $data = [
        'email' => $email,
        'password' => $password,
    ];

    $response = post($url, $data);
    $res = json_decode($response, true);

    if ($res["code"] == 200) {
        $_SESSION['success'] = 'Delete success.';
        header('location: getform.php');
        exit;
    } else {
        $_SESSION['error'] = 'Delete Failed.';
        header('location: forget.php');
    }
}

here:

?>