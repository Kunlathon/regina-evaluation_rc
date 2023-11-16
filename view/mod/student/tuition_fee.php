<?php

	include("view/database/database_pay.php");
	include("view/database/class_db.php");	
	include("view/database/database_paynew.php");
	include("view/database/class_pay.php");

	$payset=new print_payset();
	
	
	$rc_term=$payset->pet_t;
	$rc_year=$payset->pset_y;

	$stu_id=$user_login;

	/*$rc_term=1;
	$rc_year=2563;*/

	$data_student=new stu_level($user_login,$rc_year,$rc_term);	  
		
	/*$data_advisor=new rc_advisor($rc_year,$data_student->IDLevel,$data_student->rsc_room);		
	foreach($data_advisor->advisor_array as $rc_key=>$data_advisorRow){}*/
		
?>

<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4><span class="text-semibold">ชำระค่าธรรมเนียมทางการศึกษา <?php echo $rc_term."/".$rc_year;?></span></h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=tuition_fee" class="btn btn-link  text-size-small"><span>ชำระค่าธรรมเนียมทางการศึกษา</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<?php
	$paying_system="ON";
	if($paying_system=="OFF"){ ?>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="alert alert-danger">
			<strong>ปิดระบบ...</strong> ปิดการรับชำระค่าหนังสือผ่าน QRCode ตั้งแต่วันที่ 1 มิถุนายน 2563 เป็นต้นไป  ท่านผู้ปกครองที่ยังไม่ได้ชำระ/รับหนังสือเรียน กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น.
		</div>	
	</div>
</div>		
<?php	}else{ ?>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">

	<?php
		if($rc_term==1){
			if($data_student->IDLevel==3){ ?>
<!--***************************************************-->		
						<?php
							$pay_to= new overdue_rc($user_login,$rc_term,$rc_year,"oc01");
							
							if($pay_to->overdue_os=="os01"){ ?>
<!--***************************************************-->								
		<?php
			$payment_qrcode="SELECT Name as qrcode_img FROM  `payment_qrcode` WHERE  `IDStudent` ='{$user_login}' 
							 AND  `pd_term` ='{$rc_term}' 
							 AND  `pd_ year` ='{$rc_year}'";
			$payment_qrcodeRs=$pay_ment_sql->query($payment_qrcode);
			if($payment_qrcodeRs->num_rows>0){
				$payment_qrcodeRow=$payment_qrcodeRs->fetch_assoc();
				$qrcode_img=$payment_qrcodeRow["qrcode_img"]; ?>
				<center>
					<p>ค่าธรรมเนียมทางการศึกษา เทอม <?php echo $rc_term;?> ปีการศึกษา <?php echo $rc_year;?></p>
					<p><img src="view/QR/<?php echo $rc_term; ?>_<?php echo $rc_year;?>/<?php echo $qrcode_img;?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"></p>
				</center>
	<?php	}else{
				echo '<center><h3>ไม่พบข้อมูล Mobile Banking กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. </h3></center>';
			}
		?>										
<!--***************************************************-->								
					<?php	}elseif($pay_to->overdue_os=="os02"){?>
<!--***************************************************-->
					  <center><h3>กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. </h3></center>
<!--***************************************************-->					
					<?php	}elseif($pay_to->overdue_os=="os03"){?>
<!--***************************************************-->
<!--***************************************************-->																	
					<?php	}elseif($pay_to->overdue_os=="os04"){?>
<!--***************************************************-->
<!--***************************************************-->									
					<?php	}else{ ?>
<!--***************************************************-->									
							<div class="alert alert-danger">
								<strong>ค่าธรรมเนียมทางการศึกษา อ้างอิงมาจากค่ามอบตัวนักเรียนใหม่ ปีการศึกษา <?php echo $rc_year;?></strong> 
							</div>										
<?php							} ?>		
<!--***************************************************-->			
			
			



				
<?php		}elseif($data_student->IDLevel==11){ ?>

<!--***************************************************-->		
						<?php
							$pay_to= new overdue_rc($user_login,$rc_term,$rc_year,"oc01");
							
							if($pay_to->overdue_os=="os01"){ ?>
<!--***************************************************-->								
		<?php
			$payment_qrcode="SELECT Name as qrcode_img FROM  `payment_qrcode` WHERE  `IDStudent` ='{$user_login}' 
							 AND  `pd_term` ='{$rc_term}' 
							 AND  `pd_ year` ='{$rc_year}'";
			$payment_qrcodeRs=$pay_ment_sql->query($payment_qrcode);
			if($payment_qrcodeRs->num_rows>0){
				$payment_qrcodeRow=$payment_qrcodeRs->fetch_assoc();
				$qrcode_img=$payment_qrcodeRow["qrcode_img"]; ?>
				<center>
					<p>ค่าธรรมเนียมทางการศึกษา เทอม <?php echo $rc_term;?> ปีการศึกษา <?php echo $rc_year;?></p>
					<p><img src="view/QR/<?php echo $rc_term; ?>_<?php echo $rc_year;?>/<?php echo $qrcode_img;?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"></p>
				</center>
	<?php	}else{
				echo '<center><h3>ไม่พบข้อมูล Mobile Banking กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. </h3></center>';
			}
		?>										
<!--***************************************************-->								
					<?php	}elseif($pay_to->overdue_os=="os02"){?>
<!--***************************************************-->
					  <center><h3>กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. </h3></center>
<!--***************************************************-->					
					<?php	}elseif($pay_to->overdue_os=="os03"){?>
<!--***************************************************-->
<!--***************************************************-->																	
					<?php	}elseif($pay_to->overdue_os=="os04"){?>
<!--***************************************************-->
<!--***************************************************-->									
					<?php	}else{ ?>
<!--***************************************************-->									
								<div class="alert alert-danger">
									<strong>ค่าธรรมเนียมทางการศึกษา อ้างอิงมาจากค่ามอบตัวนักเรียนใหม่ ปีการศึกษา <?php echo $rc_year;?></strong> 
								</div>
										
<?php							} ?>		
<!--***************************************************-->


				
<?php		}elseif($data_student->IDLevel==31){ ?>

<!--***************************************************-->		
						<?php
							$pay_to= new overdue_rc($user_login,$rc_term,$rc_year,"oc01");
							
							if($pay_to->overdue_os=="os01"){ ?>
<!--***************************************************-->								
		<?php
			$payment_qrcode="SELECT Name as qrcode_img FROM  `payment_qrcode` WHERE  `IDStudent` ='{$user_login}' 
							 AND  `pd_term` ='{$rc_term}' 
							 AND  `pd_ year` ='{$rc_year}'";
			$payment_qrcodeRs=$pay_ment_sql->query($payment_qrcode);
			if($payment_qrcodeRs->num_rows>0){
				$payment_qrcodeRow=$payment_qrcodeRs->fetch_assoc();
				$qrcode_img=$payment_qrcodeRow["qrcode_img"]; ?>
				<center>
					<p>ค่าธรรมเนียมทางการศึกษา เทอม <?php echo $rc_term;?> ปีการศึกษา <?php echo $rc_year;?></p>
					<p><img src="view/QR/<?php echo $rc_term; ?>_<?php echo $rc_year;?>/<?php echo $qrcode_img;?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"></p>
				</center>
	<?php	}else{
				echo '<center><h3>ไม่พบข้อมูล Mobile Banking กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. </h3></center>';
			}
		?>										
<!--***************************************************-->								
					<?php	}elseif($pay_to->overdue_os=="os02"){?>
<!--***************************************************-->
					  <center><h3>กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. </h3></center>
<!--***************************************************-->					
					<?php	}elseif($pay_to->overdue_os=="os03"){?>
<!--***************************************************-->
<!--***************************************************-->																	
					<?php	}elseif($pay_to->overdue_os=="os04"){?>
<!--***************************************************-->
<!--***************************************************-->									
					<?php	}else{ ?>
<!--***************************************************-->									
							<div class="alert alert-danger">
								<strong>ค่าธรรมเนียมทางการศึกษา อ้างอิงมาจากค่ามอบตัวนักเรียนใหม่ ปีการศึกษา <?php echo $rc_year;?></strong> 
							</div>											
<?php							} ?>		
<!--***************************************************-->



				
<?php		}elseif($data_student->IDLevel==41){ ?>

<!--***************************************************-->		
						<?php
							$pay_to= new overdue_rc($user_login,$rc_term,$rc_year,"oc01");
							
							if($pay_to->overdue_os=="os01"){ ?>
<!--***************************************************-->								
		<?php
			$payment_qrcode="SELECT Name as qrcode_img FROM  `payment_qrcode` WHERE  `IDStudent` ='{$user_login}' 
							 AND  `pd_term` ='{$rc_term}' 
							 AND  `pd_ year` ='{$rc_year}'";
			$payment_qrcodeRs=$pay_ment_sql->query($payment_qrcode);
			if($payment_qrcodeRs->num_rows>0){
				$payment_qrcodeRow=$payment_qrcodeRs->fetch_assoc();
				$qrcode_img=$payment_qrcodeRow["qrcode_img"]; ?>
				<center>
					<p>ค่าธรรมเนียมทางการศึกษา เทอม <?php echo $rc_term;?> ปีการศึกษา <?php echo $rc_year;?></p>
					<p><img src="view/QR/<?php echo $rc_term; ?>_<?php echo $rc_year;?>/<?php echo $qrcode_img;?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"></p>
				</center>
	<?php	}else{
				echo '<center><h3>ไม่พบข้อมูล Mobile Banking กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. </h3></center>';
			}
		?>										
<!--***************************************************-->								
					<?php	}elseif($pay_to->overdue_os=="os02"){?>
<!--***************************************************-->
					  <center><h3>กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. </h3></center>
<!--***************************************************-->					
					<?php	}elseif($pay_to->overdue_os=="os03"){?>
<!--***************************************************-->
<!--***************************************************-->																	
					<?php	}elseif($pay_to->overdue_os=="os04"){?>
<!--***************************************************-->
<!--***************************************************-->									
					<?php	}else{ ?>
<!--***************************************************-->	
								
					<div class="alert alert-danger">
						<strong>ค่าธรรมเนียมทางการศึกษา อ้างอิงมาจากค่ามอบตัวนักเรียนใหม่ ปีการศึกษา <?php echo $rc_year;?></strong> 
					</div>			
					  
<?php							} ?>		
<!--***************************************************-->			
<?php		}elseif($data_student->rsc_txt=='n'){ ?>
	
<!--***************************************************-->		
						<?php
							$pay_to= new overdue_rc($user_login,$rc_term,$rc_year,"oc01");
							
							if($pay_to->overdue_os=="os01"){ ?>
<!--***************************************************-->								
		<?php
			$payment_qrcode="SELECT Name as qrcode_img FROM  `payment_qrcode` WHERE  `IDStudent` ='{$user_login}' 
							 AND  `pd_term` ='{$rc_term}' 
							 AND  `pd_ year` ='{$rc_year}'";
			$payment_qrcodeRs=$pay_ment_sql->query($payment_qrcode);
			if($payment_qrcodeRs->num_rows>0){
				$payment_qrcodeRow=$payment_qrcodeRs->fetch_assoc();
				$qrcode_img=$payment_qrcodeRow["qrcode_img"]; ?>
				<center>
					<p>ค่าธรรมเนียมทางการศึกษา เทอม <?php echo $rc_term;?> ปีการศึกษา <?php echo $rc_year;?></p>
					<p><img src="view/QR/<?php echo $rc_term; ?>_<?php echo $rc_year;?>/<?php echo $qrcode_img;?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"></p>
				</center>
	<?php	}else{
				echo '<center><h3>ไม่พบข้อมูล Mobile Banking กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. </h3></center>';
			}
		?>										
<!--***************************************************-->								
					<?php	}elseif($pay_to->overdue_os=="os02"){?>
<!--***************************************************-->
					  <center><h3>กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. </h3></center>
<!--***************************************************-->					
					<?php	}elseif($pay_to->overdue_os=="os03"){?>
<!--***************************************************-->
<!--***************************************************-->																	
					<?php	}elseif($pay_to->overdue_os=="os04"){?>
<!--***************************************************-->
<!--***************************************************-->									
					<?php	}else{ ?>
<!--***************************************************-->	
								
					<div class="alert alert-danger">
						<strong>ค่าธรรมเนียมทางการศึกษา อ้างอิงมาจากค่ามอบตัวนักเรียนใหม่ รอบแทรกชั้น ปีการศึกษา <?php echo $rc_year;?></strong> 
					</div>			
					  
<?php							} ?>		
<!--***************************************************-->	
	
<?php       }else{ ?>
<!--***************************************************-->		
						<?php
							$pay_to= new overdue_rc($user_login,$rc_term,$rc_year,"oc01");
							
							if($pay_to->overdue_os=="os01"){ ?>
<!--***************************************************-->								
		<?php
			$payment_qrcode="SELECT Name as qrcode_img FROM  `payment_qrcode` WHERE  `IDStudent` ='{$user_login}' 
							 AND  `pd_term` ='{$rc_term}' 
							 AND  `pd_ year` ='{$rc_year}'";
			$payment_qrcodeRs=$pay_ment_sql->query($payment_qrcode);
			if($payment_qrcodeRs->num_rows>0){
				$payment_qrcodeRow=$payment_qrcodeRs->fetch_assoc();
				$qrcode_img=$payment_qrcodeRow["qrcode_img"]; ?>
				<center>
					<p>ค่าธรรมเนียมทางการศึกษา เทอม <?php echo $rc_term;?> ปีการศึกษา <?php echo $rc_year;?></p>
					<p><img src="view/QR/<?php echo $rc_term; ?>_<?php echo $rc_year;?>/<?php echo $qrcode_img;?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"></p>
				</center>
	<?php	}else{
				echo '<center><h3>ไม่พบข้อมูล Mobile Banking กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. </h3></center>';
			}
		?>										
<!--***************************************************-->								
					<?php	}elseif($pay_to->overdue_os=="os02"){?>
<!--***************************************************-->
					  <center><h3>กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. </h3></center>
<!--***************************************************-->					
					<?php	}elseif($pay_to->overdue_os=="os03"){?>
<!--***************************************************-->
<!--***************************************************-->																	
					<?php	}elseif($pay_to->overdue_os=="os04"){?>
<!--***************************************************-->
<!--***************************************************-->									
					<?php	}else{ ?>
<!--***************************************************-->									
					  <center><h3>ค่าธรรมเนียมทางการศึกษา  ภาคเรียนที่ <?php echo $rc_term;?> ปีการศึกษา <?php echo $rc_year;?> ชำระแล้ว</h3></center>											
<?php							} ?>		
<!--***************************************************-->				
<?php		}
		}else{ ?>
<!--***************************************************-->		
<?php
		if($data_student->rsc_txt=='n'){ ?>
<!--***************************************************-->		
<!--***************************************************-->		
						<?php
							$pay_to= new overdue_rc($user_login,$rc_term,$rc_year,"oc01");
							
							if($pay_to->overdue_os=="os01"){ ?>
<!--***************************************************-->								
		<?php
			$payment_qrcode="SELECT Name as qrcode_img FROM  `payment_qrcode` WHERE  `IDStudent` ='{$user_login}' 
							 AND  `pd_term` ='{$rc_term}' 
							 AND  `pd_ year` ='{$rc_year}'";
			$payment_qrcodeRs=$pay_ment_sql->query($payment_qrcode);
			if($payment_qrcodeRs->num_rows>0){
				$payment_qrcodeRow=$payment_qrcodeRs->fetch_assoc();
				$qrcode_img=$payment_qrcodeRow["qrcode_img"]; ?>
				<center>
					<p>ค่าธรรมเนียมทางการศึกษา เทอม <?php echo $rc_term;?> ปีการศึกษา <?php echo $rc_year;?></p>
					<p><img src="view/QR/<?php echo $rc_term; ?>_<?php echo $rc_year;?>/<?php echo $qrcode_img;?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"></p>
				</center>
	<?php	}else{
				echo '<center><h3>ไม่พบข้อมูล Mobile Banking กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. </h3></center>';
			}
		?>										
<!--***************************************************-->								
					<?php	}elseif($pay_to->overdue_os=="os02"){?>
<!--***************************************************-->
					  <center><h3>กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. </h3></center>
<!--***************************************************-->					
					<?php	}elseif($pay_to->overdue_os=="os03"){?>
<!--***************************************************-->
<!--***************************************************-->																	
					<?php	}elseif($pay_to->overdue_os=="os04"){?>
<!--***************************************************-->
<!--***************************************************-->									
					<?php	}else{ ?>
<!--***************************************************-->	
								
					<div class="alert alert-danger">
						<strong>ค่าธรรมเนียมทางการศึกษา อ้างอิงมาจากค่ามอบตัวนักเรียนใหม่ รอบแทรกชั้น ปีการศึกษา <?php echo $rc_year;?></strong> 
					</div>			
					  
<?php							} ?>		
<!--***************************************************-->
<!--***************************************************-->			
<?php	}else{ ?>
<!--***************************************************-->		
<!--***************************************************-->		
						<?php
							$pay_to= new overdue_rc($user_login,$rc_term,$rc_year,"oc01");
							
							if($pay_to->overdue_os=="os01"){ ?>
<!--***************************************************-->									
		<?php
			$payment_qrcode="SELECT Name as qrcode_img FROM  `payment_qrcode` WHERE  `IDStudent` ='{$user_login}' 
							 AND  `pd_term` ='{$rc_term}' 
							 AND  `pd_ year` ='{$rc_year}'";
			$payment_qrcodeRs=$pay_ment_sql->query($payment_qrcode);
			if($payment_qrcodeRs->num_rows>0){
				$payment_qrcodeRow=$payment_qrcodeRs->fetch_assoc();
				$qrcode_img=$payment_qrcodeRow["qrcode_img"]; ?>
				<center>
					<p>ค่าธรรมเนียมทางการศึกษา เทอม <?php echo $rc_term;?> ปีการศึกษา <?php echo $rc_year;?></p>
					<p><img src="view/QR/<?php echo $rc_term; ?>_<?php echo $rc_year;?>/<?php echo $qrcode_img;?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"></p>
				</center>
	<?php	}else{
				echo '<center><h3>ไม่พบข้อมูล Mobile Banking กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. </h3></center>';
			}
		?>													
<!--***************************************************-->								
						<?php	}elseif($pay_to->overdue_os=="os02"){ ?>
					  <center><h3>กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. </h3></center>								
						<?php	}elseif($pay_to->overdue_os=="os03"){ ?>
<!--***************************************************-->
<!--***************************************************-->								
						<?php	}elseif($pay_to->overdue_os=="os04"){ ?>
<!--***************************************************-->
<!--***************************************************-->								
						<?php	}else{ ?>
					  <center><h3>ไม่พบข้อมูลค่าธรรมเนียมทางการศึกษา  ภาคเรียนที่ <?php echo $rc_term;?> ปีการศึกษา <?php echo $rc_year;?> กรุณาติดต่อห้องการเงิน โทร 053-282-395 ต่อ 105</h3></center>									
<?php							}  ?>		
<!--***************************************************-->			
<?php	}      ?>		
<!--***************************************************-->		
<!--***************************************************-->		
		


<?php		} ?>			
			
			</div>
		</div>
	</div>
</div><br>		
<?php	}  ?>
<!--**************************************************************-->
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$stu_id."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ตรวจสอบ ชำระค่าธรรมเนียมทางการศึกษา ".$rc_term." / ".$rc_year." IP:".$db_evaluationID;

				
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
	}
?>		
<!--**************************************************************-->


							<div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12">
									<font color="#FD0808">* ข้อมูล ภาคเรียนที่ <?php echo $rc_term;?> ปีการศึกษา <?php echo $rc_year;?></font>
								</div>
							</div>