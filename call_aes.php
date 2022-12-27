<?php
include_once('aes_encryp.php');
	
	$encrypt_key = "oattiz!"; // The encryption key
	$original_string = "Hello";

	$decrypt_key = "oattiz!"; // The encryption key
	$encrypted_string = aes_encrypt($original_string,$encrypt_key);

	$decrypted_string = aes_decrypt($encrypted_string,$decrypt_key);


//Display Strings
echo "The Original String is: <br>" . $original_string. "<br><br>" ;
echo "The Encrypted String is: <br>" . $encrypted_string . "<br><br>";
echo "The Decrypted String is: <br>" . $decrypted_string;
?>