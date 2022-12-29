<?php
require_once 'config.php';

if (isset($_POST['password-reset']) > 0) {
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $username = isset($_POST['username']) ? $_POST['username'] : "";

    $sql = "SELECT * FROM security WHERE email = '$email'";
    $result = db_all($conn, $sql);
    if($result) {
        $token = md5($email.$appId.$passportId);
        $expFormat = mktime(
            date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
        );
        $expDate = date("Y-m-d H:i:s",$expFormat);
        $insert = "INSERT INTO forgot_password (username, code, time) VALUES ('$username', '$token', '$expDate')";
        $result = $conn->exec($insert);

        if($result > 0) {
            $chekd = "SELECT b.username, a.code, a.time FROM forget_password a LEFT JOIN security b ON a.username = b.username WHERE a.code = ".$token;
            $
            $update = 'UPDATE security SET password=' . $password . ' code=' . $code . ' WHERE email=' . $email;
            $result = $conn->exec($update);
            if($result > 0) {
                $response = [
                    'code' => 200,
                    'message' => 'success',
                    'result' => result[0]
                ];
                json_response($response);
            } else {
                $response = [
                    'code' => 502,
                    'message' => 'Failed',
                ];
                json_response($response);
            }
        }
        // $link = '<a href="'. API_URL . '"resetpass.php?key=' . $email. 'token=' . $token '>Click to Reset Password</a>';
        // require_once('download/vendor/phpmailer/autoload.php');
    }
}
?>