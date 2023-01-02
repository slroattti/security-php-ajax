<?php
require_once 'config.php';
require_once 'test.php';

if (count($_POST) > 0) {
    $email = isset($_POST['email']) ? aes_decrypt($_POST['email'], $key) : "";
    // echo $email; die;
    $sql = "SELECT * FROM security WHERE email = '$email' limit 1";
    $result = db_all($conn, $sql);
    // var_dump($result); die;
    if(count($result) > 0) {
        $username = $result[0]['username'];
        // var_dump($username); die;
        $rand = rand(10, 100);
        $token = md5($email.$rand);
        // echo $token; die;
        $link = "<a href='". API_URL . "/resetpass.php?token=" . $token . ">Click to Reset Password</a>'";
        // echo $link; die;
        $insdata = "INSERT INTO forgot_password (username, code, time) VALUES ('$username', '$token', now())";
        $resultind = $conn->exec($insdata);
        // print_r($resultind); die;
        $mail = getMail($username, $link);
        if ($resultind) {
            $response = [
                'code' => 200,
                'message' => 'Success',
                'token' => $token,
                'link' => $link,
            ];
            json_response($response);
            // print_r($response);
        } else {
            $response = [
                'code' => 500,
                'message' => 'Failed',
            ];
            json_response($response);
        }
    } else {
        $response = [
            'code' => 400,
            'message' => 'Not has been user in database!',
        ];
        json_response($response);
    }
}

// $insert = "INSERT INTO forgot_password (username, code, time) VALUES ('$username', '$token', '$expDate')";
        // $result = $conn->exec($insert);
        // $expFormat = mktime(
        //     date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
        // );
        // $expDate = date("Y-m-d H:i:s",$expFormat);
        // if($result > 0) {
        //     $chekd = "SELECT b.username, a.code, a.time FROM forget_password a LEFT JOIN security b ON a.username = b.username WHERE a.code = ".$token;
        //     $
        //     $update = 'UPDATE security SET password=' . $password . ' code=' . $code . ' WHERE email=' . $email;
        //     $result = $conn->exec($update);
        //     if($result > 0) {
        //         $response = [
        //             'code' => 200,
        //             'message' => 'success',
        //             'result' => result[0]
        //         ];
        //         json_response($response);
        //     } else {
        //         $response = [
        //             'code' => 502,
        //             'message' => 'Failed',
        //         ];
        //         json_response($response);
        //     }
        // }
?>