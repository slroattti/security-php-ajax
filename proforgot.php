<?php 
require_once 'config.php';

if(isset($_POST['reset-password'])) {
    $email = isset($_POST['email']) ? $_POST['email'] : "";

    if($email == "") {
        $_SESSION['error'] = 'Input email address is empty';
        goto here;
    }

    $url = API_URL . '/forgotapi.php';
    // echo $url; die;
    $data = [
        'email' => aes_encrypt($email, $key),
    ];
    // var_dump($data); die;
    $response = post($url, $data);
    // var_dump($response); die;
    $res = json_decode($response, true);
    // print_r($res); die;

    if($res['code'] == 200){
        $_SESSION['success'] = "Send success";
        header('location: forgot.php');
        goto here;
    } else {
        $_SESSION['error'] = "Send failed";
        goto here;
    }
}
here: header('location: forgot.php');

?>