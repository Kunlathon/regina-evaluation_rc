<?php
	include("view/database/pdo_data.php");
	include("view/database/class_pdo.php");	
	
	include("view/database/database_paynew.php");
	include("view/database/class_pay.php");
	
	include("view/database/pdo_activity.php");
	include("view/database/class_activity.php");
	
	$data_yaer=2563;
	$data_term=2;
	
	
	$data_newyaer=2564;
	$data_newterm=1;

	$user_login;
	

	
	//$stu_cilk=filter_input(INPUT_POST,'stu_cilk');	
	
	$datetime="2021-02-05 06:00:00";
	$datetime_cr=date("Y-m-d H:i:s");
	$datatime_notrun=strtotime($datetime);
	$datatime_run=strtotime($datetime_cr);
		
		if($datatime_run>=$datatime_notrun){
			$print_runtime="OFF";
		}else{
			$print_runtime="ON";
		}
	$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4><span class="text-semibold">ชำระค่าธรรมเนียมการเรียน โควตาภายในนักเรียนชั้น ประถมศึกษาปีที่ 1 ภาคเรียน <?php echo $data_newterm." / ".$data_newyaer;?></span></h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=quotak" class="btn btn-link  text-size-small"><span>ชำระค่าธรรมเนียมการเรียน เพื่อมอบตัวเข้าศึกษาต่อชั้นประถมศึกษาปีที่ 1 ปีการศึกษา <?php echo $data_newyaer;?></span></a>
				</div> 
			</ul>
		</div>
	</div>
</div><br>

<?php
		if($print_runtime=="OFF"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++-->	

<?php
	if($data_stu->IDLevel==3){
		$quotak_stuSql="SELECT * FROM `quotak_stu` WHERE `Kstu_id`='{$user_login}' and `Kstu_y`='{$data_newyaer}'";
		$quotak_stu=new notrow_evaluation($quotak_stuSql);
		foreach($quotak_stu->evaluation_array as $rc_key=>$quotak_stuRow){
			$Kstu_id=$quotak_stuRow["Kstu_id"];
			if(isset($Kstu_id)){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++-->

<?php
	$qrcodeSql="SELECT * FROM `quotak_qrcode` WHERE `qrcode_id`='{$user_login}' and `qrcode_y`='{$data_newyaer}'";
	$qrcode=new notrow_evaluation($qrcodeSql);
	foreach($qrcode->evaluation_array as $rc_key=>$qrcodeRow){
		$qrcode_id=$qrcodeRow["qrcode_id"];
		$qrcode_img=$qrcodeRow["qrcode_img"];
		$qrcode_pay=$qrcodeRow["qrcode_pay"];
			if(isset($qrcode_id)){ ?>
<div class="row">
	<div class="col-<?php echo $grid;?>-6">
		<center><img src="view/qr_quotak/2564/<?php echo $qrcode_img;?>" class="img-thumbnail"  width="304" height="236" alt="<?php echo $qrcode_id;?>"></center>
	</div>
	<div class="col-<?php echo $grid;?>-6">
		<div class="row">
			<center><div class="col-<?php echo $grid;?>-12">ขอแสดงความยินดี นักเรียนมีสิทธิ์มอบตัวเข้าศึกษาต่อในระดับ ประถมศึกษาปีที่ 1</div>
			<div class="col-<?php echo $grid;?>-12">ค่าธรรมเนียมทางการศึกษา เพื่อมอบตัว เข้าในระดับชั้น ประถมศึกษาปีที่ 1 จำนวน <?php echo $qrcode_pay;?> บาท</div></center>
		</div>
	</div>
</div>			
<?php		}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++-->			
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger">
			ไม่พบข้อมูล กรุณาติดต่อ ห้องวิชาการ 
		</div>		
	</div>
</div>
<!--++++++++++++++++++++++++++++++++++++++++++++-->			
<?php		}
	}
?>	
<!--++++++++++++++++++++++++++++++++++++++++++++-->
	<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger">
			ไม่ได้รับสิทธิ์โควตาภายใน ระดับชั้น ประถมศึกษาปีที่ 1 ปีการศึกษา <?php echo $data_newyaer;?>
		</div>		
	</div>
</div>
<!--++++++++++++++++++++++++++++++++++++++++++++-->
<?php		}
		}
	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger">
			ไม่มีสิทธิ์เข้าถึงหน้านี้
		</div>		
	</div>
</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++-->
<?php	 } ?>

<!--++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++-->	

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger">
			เปิดให้ตรวจสอบค่าธรรมเนียมทางการเรียนโควตาภายใน ระดับชั้น ประถมศึกษาปีที่ 1 ตั้งแต่ วันที่ 5 กุมภาพันธ์ 2564 เวลา 06.00 น. เป็นต้นไป
		</div>		
	</div>
</div>	

<!--++++++++++++++++++++++++++++++++++++++++++++-->				
<?php	} ?>



<?php
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ตรวจสอบค่าธรรมเนียมการเรียน โควตาภายในนักเรียนชั้น ประถมศึกษาปีที่ 1 ภาคเรียน ".$data_newterm." / ".$data_newyaer." IP:".$db_evaluationID;

				
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
?>



