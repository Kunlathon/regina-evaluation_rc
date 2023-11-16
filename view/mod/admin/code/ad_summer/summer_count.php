<?php
//-----------------------------------------------------------------
	include("../../../../../view/database/pdo_data.php");
	
	include("../../../../../view/database/pdo_conndatastu.php");

	include("../../../../../view/database/pdo_admission.php");
	
	include("../../../../../view/database/regina_student.php");
//-----------------------------------------------------------------
	include("../../../../../view/database/pdo_summer.php");	
	include("../../../../../view/database/class_summer.php");
	
	$URSC_Year=filter_input(INPUT_POST,'URSC_Year');
	$URSC_Key=filter_input(INPUT_POST,'URSC_Key');
	$URSC_Txtth=filter_input(INPUT_POST,'URSC_Txtth');
	$URSC_Name=filter_input(INPUT_POST,'URSC_Name');
	$User_Admin=filter_input(INPUT_POST,'User_Admin');
	/*$URSC_Year="2565";
	$URSC_Key="18024";*/
		if(isset($URSC_Year,$URSC_Key,$URSC_Txtth,$URSC_Name)){
//-------------------------------------------------------------------------
			$user_login=$User_Admin;
			/*$ReginaStuData=new PrintReginaStuData($URSC_Key);
			$PRS_NameTH=$ReginaStuData->PRS_nameTH;*/
//-------------------------------------------------------------------------			
			$PaySummer=new StatusPaySummer($URSC_Key,$URSC_Year); 
			$RMT_No=$PaySummer->SPS_RMT_no;
			$RMT_Year=$PaySummer->SPS_RMT_year;
			$RS_Key=$PaySummer->SPS_rs_key;
//-------------------------------------------------------------------------
			$DeleteSummer=new Delete_Summer($RS_Key,$RMT_Year);
				if($DeleteSummer->RunDelete_Summer()=="yes"){
//-------------------------------------------------------------------------
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัสนักเรียน ".$URSC_Key."ชื่อ-สกุล ".$URSC_Name."ยกเลิกลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน วิชา /กิจกรรม ".$URSC_Txtth."สำเร็จ โดยผ่าน Admin:".$user_login.$_SERVER['REMOTE_ADDR'];

					
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
//-------------------------------------------------------------------------					
				}elseif($DeleteSummer->RunDelete_Summer()=="no"){
//-------------------------------------------------------------------------
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัสนักเรียน ".$URSC_Key."ชื่อ-สกุล ".$URSC_Name."ยกเลิกลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน วิชา /กิจกรรม ".$URSC_Txtth."ไม่สำเร็จ โดยผ่าน Admin:".$user_login.$_SERVER['REMOTE_ADDR'];

					
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
//-------------------------------------------------------------------------					
				}else{
//-------------------------------------------------------------------------
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัสนักเรียน ".$URSC_Key."ชื่อ-สกุล ".$URSC_Name."ยกเลิกลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน วิชา /กิจกรรม ".$URSC_Txtth."ไม่สำเร็จ โดยผ่าน Admin:".$user_login.$_SERVER['REMOTE_ADDR'];

					
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
//-------------------------------------------------------------------------					
				}
//-------------------------------------------------------------------------			
		}else{
//-------------------------------------------------------------------------
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
		    date_default_timezone_set("Asia/Bangkok");

			$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
			$sMessage ="รหัสนักเรียน ".$URSC_Key."ชื่อ-สกุล ".$URSC_Name."พบข้อผิดพลาดไมาสามารถยกเลิกการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน กรุณาดำเนินการใหม่อีกครั้ง โดยผ่าน Admin:".$user_login.$_SERVER['REMOTE_ADDR'];

					
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
			if(curl_error($chOne)) { 
				echo 'error:' . curl_error($chOne); 
			}else{ 
				$result_ = json_decode($result, true); 
//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
			} 
			curl_close($chOne); 
//-------------------------------------------------------------------------
		}
?>