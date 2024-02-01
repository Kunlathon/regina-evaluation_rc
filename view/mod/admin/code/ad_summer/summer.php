<?php
//-----------------------------------------------------------------
	include("../../../../../view/database/pdo_data.php");
	
	include("../../../../../view/database/pdo_conndatastu.php");

	include("../../../../../view/database/pdo_admission.php");
	
	include("../../../../../view/database/regina_student.php");
//-----------------------------------------------------------------
	include("../../../../../view/database/pdo_summer.php");	
	include("../../../../../view/database/class_summer.php");
//-----------------------------------------------------------------	
//--------------------------------------------------------------------    
    include("../../../../../view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<script src="<?php echo $golink;?>/Template/global_assets/js/core/libraries/jquery.min.js"></script>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php	
//--------------------------------------------------------------------   
//-----------------------------------------------------------------	
	$RSD_no=filter_input(INPUT_POST,'RSD_no');
	$RSD_noName=filter_input(INPUT_POST,'RSD_noName');
	$RS_Year=filter_input(INPUT_POST,'RS_Year');
	$RS_Key=filter_input(INPUT_POST,'RS_Key');
	$RS_Class=filter_input(INPUT_POST,'RS_Class');
	$RS_Est=filter_input(INPUT_POST,'RS_Est');
	$Student_ID=filter_input(INPUT_POST,'Student_ID');
	$Student_Name=filter_input(INPUT_POST,'Student_Name');
	$User_Admin=filter_input(INPUT_POST,'User_Admin');
		if(isset($RSD_no,$RSD_noName,$RS_Year,$RS_Key,$RS_Class,$RS_Est)){
//-------------------------------------------------------------------------------------	
			$user_login=$User_Admin;
			/*$ReginaStuData=new PrintReginaStuData($Student_ID);	
			$PRS_nameTH=$ReginaStuData->PRS_nameTH;*/
//-------------------------------------------------------------------------------------			
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
//-------------------------------------------------------------------------------------			
			$AddSudSummer=new AddSudSummer($RS_Key,$RS_Year,$RSD_no,$RS_Est,$RS_Class);
				if($AddSudSummer->RunAddSudSummer()=="yes"){
//-------------------------------------------------------------------------------------
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัสนักเรียน ".$Student_ID."ชื่อ-สกุล ".$Student_Name."ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน วิชา /กิจกรรม ".$RSD_noName."สำเร็จ โดยผ่าน Admin:".$user_login.$db_evaluationID;

					
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
//------------------------------------------------------------------------------------- ?>
		<script>
				var RSDnoName="<?php echo $RSD_noName;?>";
				swal({
					title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน สำเร็จ",
					text:  "วิชา /กิจกรรม : "+RSDnoName,
					confirmButtonColor: "#66BB6A",
					type: "success"
				},function(){
					location.reload();
				});
		</script>
<?php
//-------------------------------------------------------------------------------------
				}elseif($AddSudSummer->RunAddSudSummer()=="no"){
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัสนักเรียน ".$Student_ID."ชื่อ-สกุล ".$Student_Name."ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน วิชา /กิจกรรม ".$RSD_noName."ไม่สำเร็จ โดยผ่าน Admin:".$user_login.$db_evaluationID;

					
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
//------------------------------------------------------------------------------------- ?>
		<script>
				var RSDnoName="<?php echo $RSD_noName;?>";
				swal({
					title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน ไม่สำเร็จ",
					text:  "วิชา /กิจกรรม : "+RSDnoName,
					confirmButtonColor: "#66BB6A",
					type: "error"
				});
		</script>				
<?php 
//-------------------------------------------------------------------------------------
				}else{
//------------------------------------------------------------------------------------- ?>
		<script>
				var RSDnoName="<?php echo $RSD_noName;?>";
				swal({
					title: "ดำเนินการไม่ถูกต้องไม่สามารถดำเนินการได้",
					confirmButtonColor: "#66BB6A",
					type: "error"
				});
		</script>	
<?php
//-------------------------------------------------------------------------------------					
				}
		}else{
//------------------------------------------------------------------------------------- ?>
		<script>
				var RSDnoName="<?php echo $RSD_noName;?>";
				swal({
					title: "พบข้อผิดพลาดไม่สามารถลงทะเบียนได้",
					confirmButtonColor: "#66BB6A",
					type: "error"
				});
		</script>
<?php
//-------------------------------------------------------------------------------------			
		}
?>

