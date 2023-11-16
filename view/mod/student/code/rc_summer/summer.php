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
	
	$RSD_no=filter_input(INPUT_POST,'RSD_no');
	$RSD_noName=filter_input(INPUT_POST,'RSD_noName');
	$RS_Year=filter_input(INPUT_POST,'RS_Year');
	$RS_Key=filter_input(INPUT_POST,'RS_Key');
	$RS_Class=filter_input(INPUT_POST,'RS_Class');
	$RS_Est=filter_input(INPUT_POST,'RS_Est');
	$Student_ID=filter_input(INPUT_POST,'Student_ID');
	$Student_Name=filter_input(INPUT_POST,'Student_Name');
		if(isset($RSD_no,$RSD_noName,$RS_Year,$RS_Key,$RS_Class,$RS_Est)){
//-------------------------------------------------------------------------------------			
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
//-------------------------------------------------------------------------------------			
			$AddSudSummer=new AddSudSummer($RS_Key,$RS_Year,$RSD_no,$RS_Est,$RS_Class);
				if($AddSudSummer->RunAddSudSummer()=="yes"){
//-------------------------------------------------------------------------------------
	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<script>
	$(document).ready(function (){
        new PNotify({
            title: 'ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน ',
            text: 'วิชา/กิจกรรม <?php echo $RSD_noName;?> สำเร็จ',
            icon: 'icon-checkmark-circle2',
            type: 'success'
        });				
	})	
</script>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php	
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัสนักเรียน ".$Student_ID."ชื่อ-สกุล ".$Student_Name."ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน วิชา /กิจกรรม ".$RSD_noName."สำเร็จ".$db_evaluationID;

					
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
//-------------------------------------------------------------------------------------					
				}elseif($AddSudSummer->RunAddSudSummer()=="no"){			
	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<script>
	$(document).ready(function (){
        new PNotify({
            title: 'ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน ',
            text: 'วิชา/กิจกรรม <?php echo $RSD_noName;?> ไม่สำเร็จ',
            icon: 'icon-close2',
            type: 'error'
        });				
	})	
</script>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php	
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัสนักเรียน ".$Student_ID."ชื่อ-สกุล ".$Student_Name."ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน วิชา /กิจกรรม ".$RSD_noName."ไม่สำเร็จ".$db_evaluationID;

					
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
//-------------------------------------------------------------------------------------					
				}else{
	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<script>
	$(document).ready(function (){
        new PNotify({
            title: 'พบข้อผิดพลาดไม่สามารถดำเนินการได้ ',
            //text: 'วิชา/กิจกรรม <?php echo $RSD_noName;?> ไม่สำเร็จ',
            icon: 'icon-close2',
            type: 'error'
        });				
	})	
</script>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php					
				}
		}else{
			
		}

	?>

