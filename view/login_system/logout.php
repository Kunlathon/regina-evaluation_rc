
	<?php
/* set the cache limiter to 'private' */
	//session_cache_limiter("regina");
	//$cache_limiter = session_cache_limiter();

/* set the cache expire to 30 minutes */
	//session_cache_expire(30);
	//$cache_expire = session_cache_expire();

/* start the session */



	session_start();
	ob_start();
	header("Cache-control: private");
	require_once("../database/connect_login.php");
	include("../database/database_evaluation.php");
	$rcdata_connect= connect();

		$log_user_student="select `rc_prefix`.`prefixname`,`regina_stu_data`.`rsd_name`,`regina_stu_data`.`rsd_surname`
		                 ,`regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`regina_stu_login`.`model1`
						 ,`regina_stu_login`.`model2`,`regina_stu_login`.`rsl_login`
						   from `regina_stu_data` join `regina_stu_login` on(`regina_stu_data`.`rsd_studentid`=`regina_stu_login`.`rsd_studentid`)
						   join `rc_prefix` on(`regina_stu_data`.`rsd_prefix`=`rc_prefix`.`IDPrefix`)
						   WHERE `regina_stu_login`.`rsl_user`='{$_SESSION["rc_user"]}';";
		$log_user_studentRs=$rcdata_connect->query($log_user_student) or die($log_user_studentRs->error);
		if($log_user_studentRs->num_rows){
			$log_user_studentRow=$log_user_studentRs->fetch_assoc();
			$user_login=$log_user_studentRow["rsd_studentid"];
			$myname=$log_user_studentRow["prefixname"]." ".$log_user_studentRow["rsd_name"]." ".$log_user_studentRow["rsd_surname"];
			//$model1=$log_user_studentRow["model1"];
			//$model2=$log_user_studentRow["model2"];
			//$login=$log_user_studentRow["rsl_login"];
			//$Identification=$log_user_studentRow["rsd_Identification"];
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$group="S";
		}else{
			//*********************************************************
		}
	//*** Update Status

				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส: ".$user_login." ชื่อผู้ใช้งานระบบ: ".$myname." กลุ่ม: ".$group." ออกจากระบบ IP ".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 


	$logout_sql="UPDATE regina_stu_login SET rsl_login = 0 , rsl_update = NULL WHERE rsl_user = '".$_SESSION["rc_user"]."' ";
	if($login_connect->query($logout_sql)===TRUE){

		session_destroy();
		header("location:../../index.php");

	}else{
		$sql = "UPDATE `login` SET login_status = 0 , login_update = NULL WHERE login_id = '".$_SESSION["student_id"]."' ";
		$query = mysqli_query($admin_connect,$sql);

		session_destroy();
		header("location:../../index.php");
	}

?>


