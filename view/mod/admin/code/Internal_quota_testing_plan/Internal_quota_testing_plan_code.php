<?php
	include("../../../../database/pdo_quota.php");	
	include("../../../../database/pdo_data.php");	
	
	include("../../../../database/class_quota.php");

	error_reporting(error_reporting() & ~E_NOTICE);
	
	
	
	$stu_Plan=filter_input(INPUT_POST,'stu_Plan');
	//************************************************
	$user_login=filter_input(INPUT_POST,'user_login');
	$myname=filter_input(INPUT_POST,'myname');
	$group=filter_input(INPUT_POST,'group');
	$db_evaluationID=$_SERVER['REMOTE_ADDR'];
	//************************************************

	if($stu_Plan==""){
		$print_iqtpc="iqtpcA";
	}else{
		
	//quota_transfer_test
	
		$quota_transfer_testSlelct="SELECT count(`qtt_key`) as `count_qtt` 
						            FROM `quota_transfer_test` 
									WHERE `qtt_key`='{$stu_Plan}';";
		$quota_transfer_testRow=new row_quotanotarray($quota_transfer_testSlelct);
		foreach($quota_transfer_testRow->print_quotanotarray() as $stu_quota=>$quota_transfer_testPrint){
			$count_qtt=$quota_transfer_testPrint["count_qtt"];
			if($count_qtt>=1){
				$txt_qtt="save";
			}else{
				$quota_transfer_testSql="INSERT INTO `quota_transfer_test` (`qtt_key`) VALUES ('{$stu_Plan}');";
				$quota_transfer_test=new insert_quota($quota_transfer_testSql);
				if($quota_transfer_test->print_insertQuota()=="yes"){
					$txt_qtt="save";
				}else{
					$txt_qtt="not_save";
				}				
			}
		}
		
		if($txt_qtt=="save"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php
	
			$delete_choose_examSql="DELETE FROM `quota_choose_exam` WHERE`qtt_key`='{$stu_Plan}';";
			$delete_choose_exam=new insert_quota($delete_choose_examSql);
			if($delete_choose_exam->print_insertQuota()=="yes"){
				//**********************
			}else{
				//**********************
			}	
	
	
		if(is_array($_POST['qce_plan']) && count($_POST['qce_plan'])){
			$countall_print=count($_POST['qce_plan']);
		}else{
			$countall_print="";
		}
		
		
		
		if($countall_print==0 or $countall_print==Null){
//------------------------------------------------------
		$print_iqtpc="iqtpcD";
		}else{
//------------------------------------------------------
		$count_print=0;
		while($count_print<$countall_print){
			$qce_plan=$_POST["qce_plan"][$count_print];
	//quota_choose_exam			
				$quota_choose_examSql="INSERT INTO `quota_choose_exam` (`qce_key`, `qtt_key`) VALUES ('{$qce_plan}', '{$stu_Plan}');";
				$quota_choose_exam=new insert_quota($quota_choose_examSql);
				if($quota_choose_exam->print_insertQuota()=="yes"){
					//$print_iqtpc="iqtpcC";
				}else{
					//$print_iqtpc="iqtpcD";
				}
	//quota_choose_exam				

	$palnA=new print_plan($qce_plan);
	
	$palnB=new print_plan($stu_Plan);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set("Asia/Bangkok");

	$sToken = "0ITJ5aGtc5iVj9h4sCi1xJPOaBAAHwOQ95EZlnTFkZW";
	$sMessage = " แผนการเรียน ".$palnB->plan_Name." มีสิทธิ์สอบย้ายสาย ".$palnA->plan_Name." ผู้บันทึก ".$myname." กลุ่ม ".$group." IP ".$db_evaluationID;

	
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

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

			$count_print=$count_print+1;
			
		}	
		$print_iqtpc="iqtpcC";
//------------------------------------------------------			
		}
	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}else{
			$print_iqtpc="iqtpcA";
		}
	}
//******************************************************************
	if($print_iqtpc=="iqtpcA"){
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage =" รหัส: ".$user_login." ชื่อผู้ใช้งานระบบ: ".$myname." กลุ่ม: ".$group." ทำรายการบันทึกข้อมูลไม่สำเร็จ หรือทำรายการไม่ถูกต้อง IP ".$db_evaluationID;

				
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
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++				
	}elseif($print_iqtpc=="iqtpcC"){
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage =" รหัส: ".$user_login." ชื่อผู้ใช้งานระบบ: ".$myname." กลุ่ม: ".$group." ทำรายการบันทึกข้อมูลสำเร็จ IP ".$db_evaluationID;

				
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
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
	}elseif($print_iqtpc=="iqtpcD"){
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage =" รหัส: ".$user_login." ชื่อผู้ใช้งานระบบ: ".$myname." กลุ่ม: ".$group." ทำรายการล้างข้อมูลเรียบร้อยแล้ว สามารถดำเนินการบันทึกข้อมูลใหม่ได้ทันที IP ".$db_evaluationID;

				
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
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$palnB=new print_plan($stu_Plan);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set("Asia/Bangkok");

	$sToken = "0ITJ5aGtc5iVj9h4sCi1xJPOaBAAHwOQ95EZlnTFkZW";
	$sMessage = " ทำรายการล้างข้อมูล แผนการเรียน ".$palnB->plan_Name." เรียบร้อยแล้ว สามารถดำเนินการบันทึกข้อมูลใหม่ได้ทันที  ผู้บันทึก ".$myname." กลุ่ม ".$group." IP ".$db_evaluationID;

	
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

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	}else{
		//**********************************************************
	}
//******************************************************************	
	$print_iqtpc=base64_encode($print_iqtpc);
	
	exit("<script>window.location='../../../../../?evaluation_mod=Internal_quota_testing_plan&print_iqtpc=$print_iqtpc';</script>");
?>


