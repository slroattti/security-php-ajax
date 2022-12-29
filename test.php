<?php
    require_once "config.php";

    $data = aes_encrypt("Yong", "oattiz!");

    // echo aes_decrypt("58eb7dd5272f82c4a4e3d838e666a517", "oattiz!"); die;

    // $passwordHash = md5("123456".$appId.$passportId);
    // print_r($passwordHash); die;
?>