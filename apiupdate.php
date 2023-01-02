<?php 
require_once 'config.php';

if(count($_POST) > 0)
$token = isset($_POST['token']) ? $_POST['token'] : "";
$password = isset($_POST['password']) ? aes_decrypt($_POST['password'], $key) : "";
$c_password = isset($_POST['comfirm_password']) ? aes_decrypt($_POST['comfirm_password'], $key) : "";

if ($token == "" || $password == "" || $c_password == "" ) {
    $response = [
        'code' => 400,
        'message' => "Input is empty.",
    ];
    json_response($response);
}

if($password == $c_password) {
    $sql = "SELECT a.username, a.code FROM forgot_password a  LEFT JOIN security b ON a.username = b.username WHERE a.code = '$token'";
    $result = db_all($conn, $sql);
    // print_r($result);
    if (count($result) > 0) {
        $username = $result[0]['username'];
        $spassword = md5($password.$appId.$passportId);
        $sql = "UPDATE security SET password = '$spassword', time = now() WHERE username = '$username'";
        $result1 = $conn->exec($sql);
        $sqld = "DELETE FROM forgot_password WHERE username = '$username'";
        $conn->exec($sqld);
        $response = [
            'code' => 200,
            'message' => "Success updated!",
        ];
        json_response($response);
    } else {
        $response = [
            'code' => 402,
            'message' => "Update failed, try again.",

        ];
        json_response($response);
    }
}



?>