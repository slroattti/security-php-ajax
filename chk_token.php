<?php require_once "config.php";?>
<?php 

$token = "";

if(isset($_GET['token'])){
    $token = $_GET['token'];
    echo $token; die;
    $sql = "SELECT code, unix_timestamp(time) as update_time FROM forgot_password WHERE code='$token'";
    $result = db_all($conn, $sql);
    if(count($result) > 0){
    $date_now = date('Y-m-d H:i:s');
    $str_timestmap = strtotime($date_now);
    $update_time = $result[0]['update_time'];
    $diff_time = ($str_timestmap - $update_time)/60 ;
    if($diff_time > 15){
        $response = [
            'code' => 204,
            'message' => "expired token 1",
    
        ];
        json_response($response);

    }
        $response = [
            'code' => 200,
            'message' => "has been token",
        
        ];
        json_response($response);
    }else {
        $response = [
            'code' => 400,
            'message' => "Not has been token",
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