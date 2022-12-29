<?php

require_once 'config.php';
if (count($_POST) > 0) {
    $chk_sum = $_POST['chk_sum'];
    $user_id = $_POST['user_id'];

    if ($chk_sum === md5($user_id . $appId . $passportId)) {
        if ($user_id == "") {
            $response = [
                'code' => 400,
                'message' => 'Input is empty!'
            ];
            json_response($response);
        }

        $sql = 'SELECT username, firstname, lastname FROM security WHERE user_id = ' . $user;
        $result = db_all($conn, $sql);

        if (count($result) > 0) {
            $response = [
                'code' => 200,
                'message' => 'The User is logged in!',
                'result' => $result[0],
            ];
            json_response($response);
        } else {
            $response = [
                'code' => 500,
                'message' => 'The User is not logged in!',
            ];
            json_response($response);
        }
    } else {
        echo 'checksum validation failed';
        exit();
    }
}
