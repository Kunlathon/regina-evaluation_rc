<?php

	date_default_timezone_set('Asia/Bangkok');
	$db_pay_mentID=$_SERVER['REMOTE_ADDR'];
	if(isset($db_pay_mentID)){
		if($db_pay_mentID=="127.0.0.1" or $db_pay_mentID=="::1"){
		//db_pay_ment
			$hostname_pay_ment = "127.0.0.1";
			$username_pay_ment = "root";
			$password_pay_ment = "053282395";
			$database_pay_ment = "regina_student";
			$post_pay_ment="3399";
		// Create connection
			$pay_ment_sql = new mysqli($hostname_pay_ment,$username_pay_ment,$password_pay_ment,$database_pay_ment,$post_pay_ment);
		// Check connection
			if($pay_ment_sql->connect_error){
				die("Connection failed: " . $pay_ment_sql->connect_error);
			}else{
				date_default_timezone_set('Asia/Bangkok');
				$pay_ment_sql->set_charset("utf8");
			}	
		}else{
		//db_pay_ment	
			$hostname_pay_ment = "localhost";
			$username_pay_ment = "Regina@ict2022";
			$password_pay_ment = "Regina@ict2022";
			$database_pay_ment = "regina_payment";
		// Create connection
			$pay_ment_sql = new mysqli($hostname_pay_ment,$username_pay_ment,$password_pay_ment,$database_pay_ment);
		// Check connection
			if($pay_ment_sql->connect_error){
				die("Connection failed: " . $pay_ment_sql->connect_error);
			}else{
				date_default_timezone_set('Asia/Bangkok');
				$pay_ment_sql->set_charset("utf8");
			}	
		//data from mis 
		

		/*$mis_hostname="119.46.246.171";
		$mis_username="regina";
		$mis_password="regina2019";
		$mis_database="regina_db";
		
		$mis_sql = new mysqli($mis_hostname,$mis_username,$mis_password,$mis_database);
		if($mis_sql->connect_error){
			die("Connection failed: ". $mis_sql->connect_error);
		}else{
			data_default_timezone_set('Asia/Bangkok');
			$mis_sql->set_charset("utf8");
		}

		*/

		}
	}else{
		echo"Error";
	}

?>