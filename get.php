<?php
require_once 'config.php';

$sql = "SELECT * FROM security ORDER BY id DESC LIMIT 5";
$result = db_all($conn, $sql);
if(count($result) > 0) {
    $response = [
        'code' => 200,
        'message' => "success",
        'result' => $result,
    ];
    json_response($response);
} else {
    $response = [
        'code' => 400,
        'message' => 'failed',
    ];
    json_response($response);
}

?>