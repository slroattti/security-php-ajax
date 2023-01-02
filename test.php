<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
    
function getMail($username, $link) {
    
    //Load Composer's autoloader
    require 'download/vendor/autoload.php';
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'aod03112544@gmail.com';                     //SMTP username
        $mail->Password   = 'vxhplpecmopkdipt';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('aod03112544@gmail.com', 'Mailer');
        $mail->addAddress('aod03112544@gmail.com', 'Joe User');     //Add a recipient
        $mail->addAddress('aod03112544@gmail.com');               //Name is optional
        $mail->addReplyTo('aod03112544@gmail.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        // $url = $_SERVER['HTTP_ORIGIN']."/security-php-ajax/forget.php?token=";
        // $params = array('username' => $username, 'code' => $code, 'chk_sum', md5($username.$appId.$passportId));
        // $token = aes_decrypt(json_decode($params), $key);
        $msg = 'The username account' .$username . ' <br> ' . 'If you need reset password ' .  $link;
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Code new password for your account';
        $mail->Body    = $msg;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>