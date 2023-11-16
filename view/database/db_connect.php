<?php
	$db_paymentID=$_SERVER['REMOTE_ADDR'];
	date_default_timezone_set('Asia/Bangkok');
	if(isset($db_paymentID)){
		if($db_paymentID=="127.0.0.1" or $db_paymentID=="::1"){
	$hostname = "127.0.0.1";
	$username = "root";
	$password = "053282395";
	$database = "regina_payment";
	$post     = "3399";

	$objCon = mysqli_connect($hostname, $username, $password, $database,$post);
	if (!$objCon)
	{
  		die("Connection error: " . mysqli_connect_errno());
  	}
	mysqli_set_charset($objCon,"utf8");				
		}else{
	$hostname = "localhost";
	$username = "Regina@ict2022";
	$password = "Regina@ict2022";
	$database = "regina_payment";

	$objCon = mysqli_connect($hostname, $username, $password, $database);
	if (!$objCon)
	{
  		die("Connection error: " . mysqli_connect_errno());
  	}
	mysqli_set_charset($objCon,"utf8");					
		}
	}else{
		echo"Error";
	}
	date_default_timezone_set('Asia/Bangkok');
?>