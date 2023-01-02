<?php 
require_once 'config.php';

if(count($_POST) > 0) {
    $token = $_POST['token'];
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $c_password = isset($_POST['comfirm_password']) ? $_POST['comfirm_password'] : "";

    if($token == "" || $password == "" || $c_password == ""){
        $_SESSION['error'] = "password and confirm password is empty.";
        goto here;
    }


    if ($password != $c_password) {
        $_SESSION['error'] = "password and confirm password do not match";
        goto here;
    }
    
    $url = API_URL . "/apiupdate.php";
    $data = [
        'token' => $token,
        'password' => aes_encrypt($password, $key),
        'comfirm_password' => aes_encrypt($c_password, $key),
    ];
    // print_r($data); die;
    $response = post($url, $data);
    // print_r($response); die;
    $res = json_decode($response, true);
    // print_r($res); die;

    if ($res["code"] == 200) {
        $_SESSION['success'] = $res['message'];
        header('location: getform.php');
        exit;
    } else {
        $_SESSION['error'] = $res['message'];
        header('location: forgot.php');
    }

}
here:


?>