<?php
//--------------------------------------------------------------------    
    include("../../../../../view/img_user/document/gotolink.php");//--
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
	?>
	<script src="<?php echo $golink;?>/Template/global_assets/js/core/libraries/jquery.min.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/core/libraries/bootstrap.min.js"></script>
<?php
	include("../../../../../view/database/pdo_summer.php");	
	include("../../../../../view/database/class_summer.php");
	
	$URSC_Year=filter_input(INPUT_POST,'URSC_Year');
	$URSC_Key=filter_input(INPUT_POST,'URSC_Key');
	$URSC_Txtth=filter_input(INPUT_POST,'URSC_Txtth');
	$URSC_Name=filter_input(INPUT_POST,'URSC_Name');
	
	
		$PrintSystem=new SystemSummer("read","-","-","-","-","-","-","-","-","-");
		if(($PrintSystem->RunSS_Error()=="No")){
			foreach($PrintSystem->RunSS_Array() as $rc=>$PrintSystemRow){
				$data_yaer=$PrintSystemRow["data_yaer"];
				$data_term=$PrintSystemRow["data_term"];
				$data_summer=$PrintSystemRow["data_summer"];
				$OFFONDateTime=date("Y-m-d H:i:s",strtotime($PrintSystemRow["OFFONDateTime"]));
				$EndDateTime=date("Y-m-d H:i:s",strtotime($PrintSystemRow["EndDateTime"]));
				$test_system=$PrintSystemRow["test_system"];
				$time_add=date("Y-m-d H:i:s",strtotime( $PrintSystemRow["time_add"]));
			}
		}else{
			$data_yaer="-";
			$data_term="-";
			$data_summer="-";
			$time_start="-";
			$time_end="-";
			$test_ict="-";			
		}
	
	//time_add
	$TimeAddTime_Cr=date("Y-m-d H:i:s");
	$TimeAddTime_notrun=strtotime($time_add);
	$TimeAddTime_run=strtotime($TimeAddTime_Cr);
		if(($TimeAddTime_run>=$TimeAddTime_notrun)){
	//OFF
//------------------------------------------------------------------------- ?>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
//-------------------------------------------------------------------------
						ini_set('display_errors', 1);
						ini_set('display_startup_errors', 1);
						error_reporting(E_ALL);
						date_default_timezone_set("Asia/Bangkok");

						$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
						$sMessage ="รหัสนักเรียน ".$URSC_Key."ชื่อ-สกุล ".$URSC_Name."ไม่สามารถยกเลิกลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน วิชา /กิจกรรม ".$URSC_Txtth."ได้ เนื่องจากสิ้นสุดระยะเวลาที่กำหนดไว้ในประกาศ".$_SERVER['REMOTE_ADDR'];

						
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
						//exit("<script>window.location='$golink/?evaluation_mod=rc_summer';</script>");			
//-------------------------------------------------------------------------			
	//OFF End		
		}else{
	//ON		
//----------------------------------------------------------------			
		/*$URSC_Year="2565";
		$URSC_Key="18024";*/
		
			if(isset($URSC_Year,$URSC_Key,$URSC_Txtth,$URSC_Name)){
//-------------------------------------------------------------------------			
				$PaySummer=new StatusPaySummer($URSC_Key,$URSC_Year); 
				$RMT_No=$PaySummer->SPS_RMT_no;
				$RMT_Year=$PaySummer->SPS_RMT_year;
				$RS_Key=$PaySummer->SPS_rs_key;
//-------------------------------------------------------------------------
				$DeleteSummer=new Delete_Summer($RS_Key,$RMT_Year);
					if(($DeleteSummer->RunDelete_Summer()=="yes")){
//-------------------------------------------------------------------------
	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php	
						ini_set('display_errors', 1);
						ini_set('display_startup_errors', 1);
						error_reporting(E_ALL);
						date_default_timezone_set("Asia/Bangkok");

						$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
						$sMessage ="รหัสนักเรียน ".$URSC_Key."ชื่อ-สกุล ".$URSC_Name."ยกเลิกลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน วิชา /กิจกรรม ".$URSC_Txtth."สำเร็จ".$_SERVER['REMOTE_ADDR'];

						
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
						//exit("<script>window.location='$golink/?evaluation_mod=rc_summer';</script>");	
	//-------------------------------------------------------------------------					
					}elseif(($DeleteSummer->RunDelete_Summer()=="no")){
	//-------------------------------------------------------------------------
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php	
						ini_set('display_errors', 1);
						ini_set('display_startup_errors', 1);
						error_reporting(E_ALL);
						date_default_timezone_set("Asia/Bangkok");

						$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
						$sMessage ="รหัสนักเรียน ".$URSC_Key."ชื่อ-สกุล ".$URSC_Name."ยกเลิกลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน วิชา /กิจกรรม ".$URSC_Txtth."ไม่สำเร็จ".$_SERVER['REMOTE_ADDR'];

						
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
						//exit("<script>window.location='$golink/?evaluation_mod=rc_summer';</script>");	
	//-------------------------------------------------------------------------					
					}else{
	//-------------------------------------------------------------------------
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
						ini_set('display_errors', 1);
						ini_set('display_startup_errors', 1);
						error_reporting(E_ALL);
						date_default_timezone_set("Asia/Bangkok");

						$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
						$sMessage ="รหัสนักเรียน ".$URSC_Key."ชื่อ-สกุล ".$URSC_Name."ยกเลิกลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน วิชา /กิจกรรม ".$URSC_Txtth."ไม่สำเร็จ".$_SERVER['REMOTE_ADDR'];

						
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
					    //exit("<script>window.location='$golink/?evaluation_mod=rc_summer';</script>");	
	//-------------------------------------------------------------------------					
					}
	//-------------------------------------------------------------------------			
			}else{
	//-------------------------------------------------------------------------
	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php	
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัสนักเรียน ".$URSC_Key."ชื่อ-สกุล ".$URSC_Name."พบข้อผิดพลาดไมาสามารถยกเลิกการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน กรุณาดำเนินการใหม่อีกครั้ง".$_SERVER['REMOTE_ADDR'];

						
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
				//exit("<script>window.location='$golink/?evaluation_mod=rc_summer';</script>");
//-------------------------------------------------------------------------
			}			
//----------------------------------------------------------------
	//ON End				
		}
	//time_add End		
?>