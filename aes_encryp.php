<?php


function aes_encrypt($original_string,$encrypt_key){
	//Encryption

	$cipher_algo = "AES-128-CTR"; //The cipher method, in our case, AES 
	$iv_length = openssl_cipher_iv_length($cipher_algo); //The length of the initialization vector
	$option = 0; //Bitwise disjunction of flags
	$encrypt_iv = '8746376827619797'; //Initialization vector, non-null
	// Use openssl_encrypt() encrypt the given string
	$encrypted_string = openssl_encrypt($original_string, $cipher_algo,
				$encrypt_key, $option, $encrypt_iv);
	return $encrypted_string;

}

function aes_decrypt($encrypted_string,$decrypt_key){
	//Decryption
	$cipher_algo = "AES-128-CTR"; //The cipher method, in our case, AES 
	$decrypt_iv = '8746376827619797'; //Initialization vector, non-null
	$option = 0; //Bitwise disjunction of flags
	// Use openssl_decrypt() to decrypt the string
	$decrypted_string=openssl_decrypt ($encrypted_string, $cipher_algo,
			$decrypt_key, $option, $decrypt_iv);
	return $decrypted_string;
}

?>