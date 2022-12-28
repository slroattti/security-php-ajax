<?php 
require_once 'config.php';

if (count($_POST) > 0) {
    $username = isset($_POST['username']) ? aes_decrypt($_POST['username']) : '';
    $password = isset($_POST['password']) ? aes_decrypt($_POST['password']) : '';

    if(empty($username) || empty($password)) {
        $response = [
            'code' => 400,
            'message' => "Username and password are required",
        ];
        json_response($response);
    }
    $passwordHash = md5($password.$appId.$passportId);
    $sql = "SELECT username, password FROM security WHERE username = '" . $username . "' AND password = '". $passwordHash."'";
    $result = db_all($conn, $sql);

    if(count($result) > 0 && $result[0]['username'] == $username && $result[0]['password'] == $passwordHash) {
        $response = [
            'code' => 200,
            'message' => "Success Logged",
            'result' => $result[0],
        ];
        json_response($response);
    } else {
        $response = [
            'code' => 402,
            'message' => "Failed Logged",
        ];
        json_response($response);
    }
}

?>