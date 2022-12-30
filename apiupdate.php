<?php 
require_once 'config.php';

if(count($_POST) > 0)
$token = isset($_POST['code']) ? $_POST['code'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$c_password = isset($_POST['comfirm_password']) ? $_POST['comfirm_password'] : "";

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
    if (count($result) > 0) {
        $username = $result[0]['username'];
        $spassword = md5($password.$appId.$passportId);
        $sql = "UPDATE security SET password = '$spassword', time = now() WHERE username = '$username'";
        $result1 = $conn->exec($sql);
        $sqld = "DELETE FROM forgot_password WHERE username = '$username'";
        $conn->exec($sqld);
        $response = [
            'code' => 200,
            'message' => "Success delete.",
        ];
        json_response($response);
    } else {
        $response = [
            'code' => 402,
            'message' => "Failed delete.",

        ];
        json_response($response);
    }
}



?>