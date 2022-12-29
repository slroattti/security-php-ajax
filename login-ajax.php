<?php 
require_once 'config.php';

if(isset($_POST['input_user'])) {
    $input_user = strtolower($_POST['input_user']);
    $input_pass = strtolower(md5($_POST['input_pass']));
    $captcha_code = $_POST['captcha_code'];

    if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $captcha_code) != 0){  
		$arr_data = array("code"=>"108","msg"=> "invalid img code");
        echo json_encode($arr_data);
        exit;
	}
    if($input_user == ""){  
		$arr_data = array("code"=>"109","msg"=> "username is empty.");
        echo json_encode($arr_data);
        exit;
	}
    if($input_pass == ""){  
		$arr_data = array("code"=>"110","msg"=> "password is empty.");
        echo json_encode($arr_data);
        exit;
	}

    $sql = "SELECT lower(username) as username, lower(password) as password FROM security WHERE lower(username) = '".$input_user."' AND lower(password) = '".$input_pass."' limit 1;";
    $result = db_all($conn, $sql);
    $sql2 = "SELECT lower(username) as username FROM security WHERE lower(username) = '".$input_user."' limit 1;";
    $result2 = db_all($conn, $sql2);


    if(count($result2) == 0) {
        $arr_data = array("code"=>"500","msg"=> "* Username is not exists!");
        echo json_encode($arr_data);
        exit;
    }else if(count($result) > 0 && $result[0]['username'] == $input_user && $result[0]['password'] == $input_pass) {
        $arr_data = array("code"=>"200","msg"=> "* Has been data!");
        echo json_encode($arr_data);
        exit;
    } else {
        $arr_data = array("code"=>"400","msg"=> " * Password is incorrect!");
        echo json_encode($arr_data);
        exit;
    }
}
?>