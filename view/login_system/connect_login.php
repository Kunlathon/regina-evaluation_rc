<?php
/* set the cache limiter to 'private' */
	session_cache_limiter("regina");
	$cache_limiter = session_cache_limiter();

/* set the cache expire to 30 minutes */
	session_cache_expire(20);
	$cache_expire = session_cache_expire();

/* start the session */

	session_start();
	ob_start();
	header("Cache-control: private");	
	
	require_once("../database/connect_admin.php");
	require_once("../database/connect_login.php");
	include("../database/database_evaluation.php");
	$rcdata_connect= connect();
	$datetime=date("Y-m-d H:i:s");
	
?>
<meta charset="utf-8">
<?php
	$student_id=post_data($_POST["student_id"]);
	$student_Identification=post_data($_POST["student_Identification"]);
	
	if($student_id=="" and $student_Identification==""){
		$txt_error="null";
		exit("<script>window.location='../../login.php?not_null=$not_null';</script>");
	}elseif($student_id=="" or $student_Identification==""){
		$txt_error="null";
		exit("<script>window.location='../../login.php?not_null=$not_null';</script>");
	}else{
//user_student
	$user_studentsql="SELECT `rsd_studentid`,`rsd_Identification` 
					  FROM `regina_stu_data` 
					  WHERE `rsd_studentid`='{$student_id}' 
					  and `rsd_Identification`='{$student_Identification}' 
					  and`rse_student_status`='1'";
	/*$user_studentsql="SELECT `rsd_studentid`,`rsd_Identification` 
					  FROM `regina_stu_data` 
					  WHERE `rsd_studentid`='{$student_id}'  
					  and`rse_student_status`='1'";*/					  
	$user_studentRs=$rcdata_connect->query($user_studentsql) or die($rcdata_connect->error);
	if($user_studentRs->num_rows>0){
		/*$into_student="UPDATE `regina_stu_data` SET `rsd_Identification`='{$student_Identification}' WHERE `rsd_studentid`='{$student_id}'";
		$into_studentRs=add_rc($into_student);*/
		
//data...
		$key_user="SELECT `rsl_user`,`rsl_login` FROM `regina_stu_login` WHERE `rsd_studentid`='{$student_id}'";
		$key_userRs=rc_data($key_user);
		
		foreach($key_userRs as $rc_key=>$key_userRow){
			$data_user=$key_userRow["rsl_user"];
			$data_status=$key_userRow["rsl_login"];
		}
//data...	
		if($data_status==1){
			$txt_error="key";
			exit("<script>window.location='../../login.php?txt_error=$txt_error';</script>");
		}else{
			$update_login="UPDATE `regina_stu_login` SET `rsl_login`='1',`rsl_update`='{$datetime}' WHERE `rsl_user`='{$data_user}'";
			$update_loginCr=add_rc($update_login);
			if($update_loginCr=="yes"){
				$_SESSION["rc_user"]= $data_user;
				session_write_close();
//-----------------------------------------------------------------------------------------------------------------------------------				
	$regina_stu_data="select `rc_prefix`.`prefixname`,`regina_stu_data`.`rsd_name`,`regina_stu_data`.`rsd_surname` 
				      from `regina_stu_data` 
					  join `rc_prefix` 
					  on (`regina_stu_data`.`rsd_prefix`=`rc_prefix`.`IDPrefix`) 
					  where `regina_stu_data`.`rsd_studentid`='{$student_id}'
					  and `regina_stu_data`.`rsd_Identification` ='{$student_Identification}'";
	$regina_stu_dataRs=rc_data($regina_stu_data);
	foreach($regina_stu_dataRs as $rc_key=>$regina_stu_dataRow){
		$db_evaluationID=$_SERVER['REMOTE_ADDR'];
		$myname=$regina_stu_dataRow["prefixname"]." ".$regina_stu_dataRow["rsd_name"]." ".$regina_stu_dataRow["rsd_surname"];
		$group="S";
	}

				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส: ".$student_id." ชื่อผู้ใช้งานระบบ: ".$myname." กลุ่ม: ".$group." เข้าสู่ระบบ IP ".$db_evaluationID;

				
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

//-----------------------------------------------------------------------------------------------------------------------------------				
				header("location:../../index.php");
				exit();
			}else{
				$txt_error="notlogin";
				exit("<script>window.location='../../login.php?txt_error=$txt_error';</script>");
			}
		}
	}else{
	$user_adminsql="SELECT `login_id` 
			        FROM `login` 
					WHERE `login_user`='{$student_id}' 
					and `login_password`='{$student_Identification}'
					and `use_status`='1';";
	$user_adminRs=$rcdata_connect->query($user_adminsql) or die($rcdata_connect->error);		
		if($user_adminRs->num_rows>0){
//data...
		$key_user="SELECT `login_id`,`login_status`,`group`
             	   FROM `login` WHERE `login_user`='{$student_id}' and `login_password`='{$student_Identification}'";
		$key_userRs=rc_data($key_user);
		
		foreach($key_userRs as $rc_key=>$key_userRow){
			$data_user=$key_userRow["login_id"];
			$data_status=$key_userRow["login_status"];
			$data_group=$key_userRow["group"];
		}
//data...			
			if($data_status==1){
				$txt_error="key";
				exit("<script>window.location='../../login.php?txt_error=$txt_error';</script>");
			}else{
				$update_login="UPDATE `login` SET`login_status`='1',`login_update`='{$datetime}' WHERE `login_id`='{$data_user}';";
				$update_loginCr=add_rc($update_login);
				if($update_loginCr=="yes"){
					$_SESSION["rc_user"]= $data_user;
					session_write_close();
//-----------------------------------------------------------------------------------------------------------------------------------				
		$data_teacherSql="SELECT`dt_rc`,`dt_name`,`dt_last_names` FROM `data_teacher` WHERE `dt_rc`='{$student_id}'";
		$data_teacherRs=rc_data($data_teacherSql);
		foreach($data_teacherRs as $rc_key=>$data_teacherRow){
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$myname=$data_teacherRow["dt_name"]." ".$data_teacherRow["dt_last_names"];
		}
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$RCToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$RCMessage ="รหัส: ".$student_id." ชื่อผู้ใช้งานระบบ: ".$myname." กลุ่ม: ".$data_group." เข้าสู่ระบบ IP ".$db_evaluationID;
				//$RCImages="https://img10.jd.co.th/n0/jfs/t10/53/551092846/452886/732bfdbc/5c9850d2N62e785bd.jpg!q70.jpg";
				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$RCMessage); 
				//curl_setopt( $chOne, CURLOPT_POSTFIELDS, "imageFile=".$RCImages); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$RCToken.'', );
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
//-----------------------------------------------------------------------------------------------------------------------------------										
					header("location:../../index.php");
					exit();
				}else{
					$txt_error="notlogin";
					exit("<script>window.location='../../login.php?txt_error=$txt_error';</script>");
				}				
			}
		}else{
			$txt_error="notdata";
			exit("<script>window.location='../../login.php?txt_error=$txt_error';</script>");
		}
	}
//user_student End			
	}
?>
