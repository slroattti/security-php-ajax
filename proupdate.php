<?php 
require_once 'config.php';

if(isset($_POST['reset-password'])) {
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $c_password = isset($_POST['comfirm_password']) ? $_POST['comfirm_password'] : "";

    if($password == "" || $c_password == ""){
        $_SESSION['error'] = "password and confirm password is empty.";
        goto here;
    }


    if ($password != $c_password) {
        $_SESSION['error'] = "password and confirm password do not match";
        goto here;
    }
    
    $url = API_URL . "/apiupdate.php";
    $data = [
        'password' => $password,
        'c_password' => $c_password,
    ];
    $response = post($url, $data);
    $res = json_decode($response, true);
    print_r($res); die;

    if ($res["code"] == 200) {
        $_SESSION['success'] = 'Delete success.';
        header('location: from.php');
        exit;
    } else {
        $_SESSION['error'] = 'Delete Failed.';
        header('location: forgot.php');
    }

}
here:


?>