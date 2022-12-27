<?php
require_once 'config.php';

$sql = "SELECT firstname, lastname, nickname, phone, email, address FROM security";
$result = $conn->exec($sql);
if(count($result) > 0) {
    $res = {
        'code' => 200,
        'message' => "success",
        'result' => result[0],
    }
    json_response($res);
} else {
    $res = {
        'code' => 400,
        'message' => 'failed',
    }
}
?>