<?php require_once "config.php";?>
<?php 

$token = "";

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $sql = "SELECT code FROM forgot_password WHERE code='$token'";
    $result = db_all($conn, $sql);
    if(count($result) > 0){
        $response = [
            'code' => 200,
            'message' => "Has been Token",
        ];
        json_response($response);
    }else {
        $response = [
            'code' => 400,
            'message' => "No has been Token",
        ];
        json_response($response);

    }


}else {
    $response = [
        'code' => 404,
        'message' => "invalid parameter",
    ];
    json_response($response);
}



?>