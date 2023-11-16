<?php
	include("../../../../database/pdo_quota.php");
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_quota.php");
		
	//$copy_year=filter_input(INPUT_POST,'copy_year');
	//$copy_level=filter_input(INPUT_POST,'copy_level');
	
	$txt_year=filter_input(INPUT_POST,'txt_year');
	$txt_level=filter_input(INPUT_POST,'txt_level');
//*****************line*****************************	
	$myname=filter_input(INPUT_POST,'myname');
	$group=filter_input(INPUT_POST,'group');
	$db_evaluationID=$_SERVER['REMOTE_ADDR'];
//*****************line*****************************	
	if($txt_year=="" and $txt_level==""){
		$txt_call="qac01";
	}elseif($txt_year=="" or $txt_level==""){
		$txt_call="qac01";
	}else{
		
		switch($txt_level){
			case "23":
				$call_level="ประถมศึกษาปีที่ 6";
			break;
			
			case "31":
				$call_level="มัธยมศึกษาปีที่ 3";
			break;
			
			default:
				$call_level="";
		}		
		
//Delete
		$delete_quota_academicSql="DELETE FROM `quota_academic` WHERE `qc_year`='{$txt_year}' and `qc_level`='{$txt_level}'";
		$delete_quota_academic=new insert_quota($delete_quota_academicSql);
		if($delete_quota_academic->print_insertQuota()=="yes"){
			if(is_array($_POST['data_stu']) && count($_POST['data_stu'])){
				$keey_count=count($_POST["data_stu"]);
				$run_count=0;
				while($run_count<$keey_count){
					$data_stu=$_POST["data_stu"][$run_count];
//---------------------------------------------------------------------------------					
				$plan_sql="SELECT  `rsc_plan` FROM `regina_stu_class` 
						   WHERE `rsc_year`='{$txt_year}' 
						   and `rsc_class`='{$txt_level}'
						   and `rsc_term`='1' 
						   and `rsd_studentid`='{$data_stu}'";
				$plan_rs=new print_evaluation($plan_sql);
				foreach($plan_rs->print_evaluation_notarray() as $rc_key=>$plan_row){
					$rsc_plan=$plan_row["rsc_plan"];
				}	
//quota_academic
					$into_quota_academicSql="INSERT INTO `quota_academic` (`qc_stuid`, `qc_year`, `qc_level`, `qc_plan`, `qc_status`) VALUES ('{$data_stu}', '{$txt_year}', '{$txt_level}', '{$rsc_plan}', '1');";
					$into_quota_academic=new insert_quota($into_quota_academicSql);
					if($into_quota_academic->print_insertQuota()=="yes"){
						//*********************************************************
					}else{
						//*********************************************************
					}					
//---------------------------------------------------------------------------------					
					$run_count=$run_count+1;
				}					
				$txt_call="qac02";
			}else{
				$txt_call="qac03";	
			}
		}else{
			if(is_array($_POST['data_stu']) && count($_POST['data_stu'])){
				$keey_count=count($_POST["data_stu"]);
				$run_count=0;
				while($run_count<$keey_count){
					$data_stu=$_POST["data_stu"][$run_count];
//---------------------------------------------------------------------------------					
				$plan_sql="SELECT  `rsc_plan` FROM `regina_stu_class` 
						   WHERE `rsc_year`='{$txt_year}' 
						   and `rsc_class`='{$txt_level}'
						   and `rsc_term`='1' 
						   and `rsd_studentid`='{$data_stu}'";
				$plan_rs=new print_evaluation($plan_sql);
				foreach($plan_rs->print_evaluation_notarray() as $rc_key=>$plan_row){
					$rsc_plan=$plan_row["rsc_plan"];
				}	
//quota_academic
					$into_quota_academicSql="INSERT INTO `quota_academic` (`qc_stuid`, `qc_year`, `qc_level`, `qc_plan`, `qc_status`) VALUES ('{$data_stu}', '{$txt_year}', '{$txt_level}', '{$rsc_plan}', '1');";
					$into_quota_academic=new insert_quota($into_quota_academicSql);
					if($into_quota_academic->print_insertQuota()=="yes"){
						//*********************************************************
					}else{
						//*********************************************************
					}					
//---------------------------------------------------------------------------------
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");
				
				$RCToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage = "นักเรียนติดปัญหาวิชาการ เลขประจำตัวนักเรียน ".$data_stu." ระดับชั้น".$call_level." ปีการศึกษา ".$txt_year." ผู้บันทึก ".$myname." กลุ่ม ".$group." IP ".$db_evaluationID;
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
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set("Asia/Bangkok");

	$sToken = "0ITJ5aGtc5iVj9h4sCi1xJPOaBAAHwOQ95EZlnTFkZW";
	$sMessage = "นักเรียนติดปัญหาวิชาการ เลขประจำตัวนักเรียน ".$data_stu." ระดับชั้น".$call_level." ปีการศึกษา ".$txt_year." ผู้บันทึก ".$myname." กลุ่ม ".$group." IP ".$db_evaluationID;

	
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
		//echo 'error:' . curl_error($chOne); 
	} 
	else { 
		$result_ = json_decode($result, true); 
		//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
	} 
	curl_close( $chOne ); 

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//---------------------------------------------------------------------------------
					$run_count=$run_count+1;
				}					
				$txt_call="qac02";			
			}else{
				$txt_call="qac03";
			}				
		}		
	}
//---------------------------------------------------------------------------------
		switch($txt_call){
			case "qac01":
//---------------------------------------------------------------------------------
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$RCToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage = "นักเรียนติดปัญหาวิชาการ ทำรายการบันทึกข้อมูลไม่สำเร็จ หรือทำรายการไม่ถูกต้อง ผู้บันทึก ".$myname." กลุ่ม ".$group." IP ".$db_evaluationID;
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
//---------------------------------------------------------------------------------
                ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "0ITJ5aGtc5iVj9h4sCi1xJPOaBAAHwOQ95EZlnTFkZW";
				$sMessage = "นักเรียนติดปัญหาวิชาการ ทำรายการบันทึกข้อมูลไม่สำเร็จ หรือทำรายการไม่ถูกต้อง ผู้บันทึก ".$myname." กลุ่ม ".$group." IP ".$db_evaluationID;

				
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
					//echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 
//---------------------------------------------------------------------------------					
			break;
			
			case "qac02":
//---------------------------------------------------------------------------------
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$RCToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage = "นักเรียนติดปัญหาวิชาการ ทำรายการบันทึกข้อมูลสำเร็จ ผู้บันทึก ".$myname." กลุ่ม ".$group." IP ".$db_evaluationID;
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
//---------------------------------------------------------------------------------
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "0ITJ5aGtc5iVj9h4sCi1xJPOaBAAHwOQ95EZlnTFkZW";
				$sMessage = "นักเรียนติดปัญหาวิชาการ ทำรายการบันทึกข้อมูลสำเร็จ ผู้บันทึก ".$myname." กลุ่ม ".$group." IP ".$db_evaluationID;

				
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
					//echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 
//---------------------------------------------------------------------------------						
			break;			
			
			case "qac03":
//---------------------------------------------------------------------------------
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$RCToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage = "นักเรียนติดปัญหาวิชาการ ทำรายการล้างข้อมูลเรียบร้อยแล้ว สามารถดำเนินการบันทึกข้อมูลใหม่ได้ทันที ผู้บันทึก ".$myname." กลุ่ม ".$group." IP ".$db_evaluationID;
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
//---------------------------------------------------------------------------------		
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "0ITJ5aGtc5iVj9h4sCi1xJPOaBAAHwOQ95EZlnTFkZW";
				$sMessage = "นักเรียนติดปัญหาวิชาการ ทำรายการล้างข้อมูลเรียบร้อยแล้ว สามารถดำเนินการบันทึกข้อมูลใหม่ได้ทันที ผู้บันทึก ".$myname." กลุ่ม ".$group." IP ".$db_evaluationID;

				
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
					//echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 

//---------------------------------------------------------------------------------			
			break;
			
			default:
				//----------------------------------------------------------------
		}	

//---------------------------------------------------------------------------------	
	$txt_call=base64_encode($txt_call);
	
	exit("<script>window.location='../../../../../?evaluation_mod=quota_academic&txt_call=$txt_call';</script>");
?>