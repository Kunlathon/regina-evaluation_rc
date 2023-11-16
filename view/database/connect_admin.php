<?php
	$db_adminID=$_SERVER['REMOTE_ADDR'];
	if(isset($db_adminID)){
		date_default_timezone_set('Asia/Bangkok');
		ini_set('display_errors',1);
		error_reporting(~0);		
		if($db_adminID=="127.0.0.1" or $db_adminID=="::1" or $db_adminID=="localhost"){
			$admin_serverName="127.0.0.1";
			$admin_userName="root";
			$admin_Password="053282395";
			$admin_db="regina_student";
			$admin_post="3399";
			$admin_connect= mysqli_connect($admin_serverName,$admin_userName,$admin_Password,$admin_db,$admin_post);
	
			if(mysqli_connect_errno()){
				echo"Database connect Failed :" .mysqli_connect_error();
				exit();
				}else{
					$admin_connect->set_charset("utf8");
				}
	
			$intRejectTime = 20;
			$sql="UPDATE `login` SET login_status = 0 , login_update = NULL  WHERE 1 AND DATE_ADD(login_update, INTERVAL $intRejectTime MINUTE) <= NOW()";
			$query = mysqli_query($admin_connect,$sql) or die ($admin_connect->error);			
		}else{
			$admin_serverName="localhost";
			$admin_userName="Regina@ict2022";
			$admin_Password="Regina@ict2022";
			$admin_db="regina_student";

			$admin_connect= mysqli_connect($admin_serverName,$admin_userName,$admin_Password,$admin_db);
	
			if(mysqli_connect_errno()){
				echo"Database connect Failed :" .mysqli_connect_error();
				exit();
				}else{
					$admin_connect->set_charset("utf8");
				}
	
			$intRejectTime = 20;
			$sql="UPDATE `login` SET login_status = 0 , login_update = NULL  WHERE 1 AND DATE_ADD(login_update, INTERVAL $intRejectTime MINUTE) <= NOW()";
			$query = mysqli_query($admin_connect,$sql) or die ($admin_connect->error);
		}
	}else{
		echo"Error";
	}
	
?>