<?php 
require_once 'config.php';

// var_dump($_POST); die;
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    if($email == '') {  
        $arr_data = array("code"=>"109","msg"=> "username is empty.");
        echo json_encode($arr_data);
        exit;
    }

    $sql = "SELECT * FROM security WHERE email = '$email' limit 1";
    // echo $sql; die;
    $result = db_all($conn, $sql);
    if(count($result) > 0) {
        $response = [
            'code' => 200,
            'message' => 'User has been data!',
            'result' => $result[0],
        ];
        json_response($response);
        // exit;
    } else {
        $response = [
            'code' => 400,
            'message' => 'User is not data!',
        ];
        json_response($response);
    }
}
?>