<?php
	$username = "user1";
	$appId = "1005";
	$passportId = "Sfjvmirm'akfvmr";
	$chksum = md5($username.$appId.$passportId."myAppWhatTheHell");
	//md5(username+appId+passportId+"myAppWhatTheHell")

	// echo $chksum;
	// echo md5('abc');
	// echo $chksum;
	
?>