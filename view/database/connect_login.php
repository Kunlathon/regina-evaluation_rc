<?php
	$db_loginID=$_SERVER['REMOTE_ADDR'];
	if(isset($db_loginID)){
		date_default_timezone_set('Asia/Bangkok');
		ini_set('display_errors',1);
		error_reporting(~0);		
		if($db_loginID=="127.0.0.1" or $db_loginID=="::1"){
			$login_serverName="127.0.0.1";
			$login_userName="root";
			$login_Password="053282395";
			$login_db="regina_student";
			$login_post="3399";
			$login_connect= mysqli_connect($login_serverName,$login_userName,$login_Password,$login_db,$login_post);
	
			if(mysqli_connect_errno()){
				echo"Database connect Failed :" .mysqli_connect_error();
				exit();
				}else{
					$login_connect->set_charset("utf8");
				}
	
			$intRejectTime = 10;
			$sql="UPDATE `regina_stu_login` SET  `rsl_login`=0,`rsl_update`=Null WHERE 1 AND DATE_ADD(rsl_update, INTERVAL $intRejectTime MINUTE) <= NOW()";
			$query = mysqli_query($login_connect,$sql) or die ($login_connect->error);			
		}else{
			$login_serverName="localhost";
			$login_userName="Regina@ict2022";
			$login_Password="Regina@ict2022";
			$login_db="regina_student";

			$login_connect= mysqli_connect($login_serverName,$login_userName,$login_Password,$login_db);
	
			if(mysqli_connect_errno()){
				echo"Database connect Failed :" .mysqli_connect_error();
				exit();
				}else{
					$login_connect->set_charset("utf8");
				}
			$intRejectTime = 10;
			$sql="UPDATE `regina_stu_login` SET  `rsl_login`=0,`rsl_update`=Null WHERE 1 AND DATE_ADD(rsl_update, INTERVAL $intRejectTime MINUTE) <= NOW()";
			$query = mysqli_query($login_connect,$sql) or die ($login_connect->error);			
		}
	}else{
		echo"Error";
	}
	
?>