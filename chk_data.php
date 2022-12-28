<?php 
require_once 'config.php';

if(isset($_POST['input_name'])) {
    $input_name = $_POST['input_name'];
    $input_value = $_POST['input_value'];


    if($input_name == 'username') {
        $sql_sub = " username ='".$input_value."'";
    } else if($input_name == 'phone') {
        $sql_sub = " phone ='".$input_value."'";
    } else if($input_name == 'email') {
        $sql_sub = " email ='".$input_value."'";
    } else if($input_name == 'id_card') {
        $sql_sub = " id_card ='".$input_value."'";
    } else {
        $arr_data = array("code"=>"108","msg"=> "invalid data");
        echo json_encode($arr_data);
        exit;
    }

    $sql = "SELECT username FROM security WHERE ".$sql_sub." limit 1;";

    $result = db_all($conn, $sql);

    if(count($result) > 0) {
        $arr_data = array("code"=>"400","msg"=> "Has been data!");
        echo json_encode($arr_data);
        exit;
    } else {
        $arr_data = array("code"=>"200","msg"=> "No has been data!");
        echo json_encode($arr_data);
        exit;
    }
}



?>