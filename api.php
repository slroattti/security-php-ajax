<?php
require_once 'config.php';
// echo json_encode($_POST); die;

$chk_sum = "";

if (count($_POST) > 0) {
    $chk_sum = $_POST['chk_sum'];
    $firstname = isset($_POST['firstname']) ? aes_decrypt($_POST['firstname'], $key) : '';
    $lastname = isset($_POST['lastname']) ? aes_decrypt($_POST['lastname'], $key) : '';
    $nickname = isset($_POST['nickname']) ? aes_decrypt($_POST['nickname'], $key) : '';
    $phone = isset($_POST['phone']) ? aes_decrypt($_POST['phone'], $key) : '';
    $email = isset($_POST['email']) ? aes_decrypt($_POST['email'], $key) : '';
    $username = isset($_POST['username']) ? aes_decrypt($_POST['username'], $key) : '';
    $password = isset($_POST['password']) ? aes_decrypt($_POST['password'], $key) : '';
    $comfirm_password = isset($_POST['comfirm_password']) ? aes_decrypt($_POST['comfirm_password'], $key) : '';
    $id_card = isset($_POST['id_card']) ? aes_decrypt($_POST['id_card'], $key) : '';
    $address = isset($_POST['address']) ? aes_decrypt($_POST['address'], $key) : '';

    if ($chk_sum === md5($username.$appId.$passportId))
    {
        if ($firstname == "" ||
            $lastname == "" ||
            $nickname == "" ||
            $phone == "" ||
            $email == "" ||
            $username == "" ||
            $password == "" ||
            $comfirm_password == "" ||
            $id_card == "" ||
            $address == ""
        )
        {
            $response = [
                'code' => 400,
                'message' => 'Invalid input is empty'
            ];
            json_response($response);
        }
    
        if ($password != $comfirm_password) {
            $response = [
                'code' => 401,
                'message' => 'Invalid password and confirm password exists Please try again'
            ];
            json_response($response);
        }
        $sql = "SELECT username, email, id_card
            FROM security
            WHERE username ='$username'
            AND email = '$email'
            AND id_card = '$id_card'
            limit 1";
            $result = db_all($conn, $sql);
            // var_dump($result); die;
        if (count($result) > 0) {
            $response = [
                'code' => 402,
                'message' => 'Invalid username or password exists',
            ];
            json_response($response);
        } else {
            $passwordHash = md5($password.$appId.$passportId);
            $sql = "INSERT INTO security (firstname, lastname, nickname, phone, email, username, password, id_card, address)
                    VALUES ('$firstname', '$lastname', '$nickname', '$phone', '$email', '$username', '$passwordHash', '$id_card', '$address')";
            $result = $conn->exec($sql);
        
            if ($result > 0) {
                $response = [
                    'code' => 200,
                    'message' => 'Success',
                ];
                json_response($response);
            } else {
                $response = [
                    'code' => 405,
                    'message' => 'Failed',
                ];
                json_response($response);
            }
        }
    } else {
        echo 'checksum validation failed';
        exit();
    }


}



?>