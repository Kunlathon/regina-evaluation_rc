<?php

	$data_yaer=2562;
	$data_yaernew=2563;
	$data_term=2;
	$data_termnew=1;
	
	$user_login;
	include("view/database/class_db.php"); 
	
		/*$datetime="2020-03-06 24:59:00";
		$datetime_cr=date("Y-m-d H:i:s");
		$datatime_notrun=strtotime($datetime);
		$datatime_run=strtotime($datetime_cr);
		
		if($datatime_run>=$datatime_notrun){
			$print_runtime="OFF";
		}else{
			$print_runtime="ON";
		}*/
?>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4><span class="text-semibold">ค่าหนังสือเรียน ปีการศึกษา  <?php echo $data_yaernew;?></span></h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=stu_book" class="btn btn-link  text-size-small"><span>ค่าหนังสือเรียน</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<?php
$off="yes";

//dataStu		
	$dataStu_room=new stu_level($user_login,$data_yaernew,$data_termnew);
	//echo $dataStu_room->rsd_studentid."<br>".$dataStu_room->IDLevel."<br>".$dataStu_room->rc_plan."<br>".$dataStu_room->rsc_room."<br>";
//dataStu***End	


//Check tuition fees
		$check_payCTF=new overdue_rc($user_login,$data_term,$data_yaer,"oc01");
		if($check_payCTF->overdue_os=="os01" or $check_payCTF->overdue_os=="os02"){ ?>
<!--**************************************************************************-->	
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="alert alert-danger">
			<strong>แจ้งเตือนจากระบบ </strong>  กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. 
		</div>	
	</div>
</div>
<!--**************************************************************************-->	
<?php	}elseif($off=="yes"){ ?>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="alert alert-danger">
			<strong>แจ้งเตือนจากระบบ </strong> ปิดการรับชำระค่าหนังสือผ่าน QRCode ตั้งแต่วันที่ 1 มิถุนายน 2563 เป็นต้นไป  ท่านผู้ปกครองที่ยังไม่ได้ชำระ/รับหนังสือเรียน กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น.
		</div>	
	</div>
</div>	
<?php   }elseif($dataStu_room->rsd_studentid==Null){ ?>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="alert alert-danger">
			<strong>แจ้งเตือนจากระบบ </strong> ไม่สามารถตรวจสอบค่าหนังสือเรียนได้ เนื่องจาก ไม่พบห้องเรียน 
		</div>	
	</div>
</div>
<?php   }else{ 
	
//dataStu		
	//$dataStu_room=new stu_level($user_login,$data_yaernew,$data_termnew);
	//echo $dataStu_room->rsd_studentid."<br>".$dataStu_room->IDLevel."<br>".$dataStu_room->rc_plan."<br>".$dataStu_room->rsc_room."<br>";
//dataStu***End	



//price_of_books
	$pob_sql="SELECT `pob_price` FROM `price_of_books` WHERE `pob_levelnew`='{$dataStu_room->IDLevel}' and `pob_plan`='{$dataStu_room->rc_plan}'";
	$price_of_books=new print_notarray($pob_sql);
	if($price_of_books->txt_notarray=="have"){
		foreach($price_of_books->print_array as $rc_key=>$pob_row){
		$pob_price=$pob_row["pob_price"];
		}
	}else{
		$pob_price=0;
	}
//price_of_books***End

//price_of_stu--
//ถ้าข้อมูลผ่าน เงื่อน have แต่ ยอดคือ 0 ***  ใช้ในกรณี ต้องจ่ายยอดเต็ม แต่ ลิม อิอิ 
	$pos_sql="SELECT `pos_stu`, `pos_year`, `pos_sumbook` FROM `price_of_stu` WHERE `pos_stu`='{$user_login}' and `pos_year`='{$data_yaernew}'";
	$price_of_stu=new print_notarray($pos_sql);
	if($price_of_stu->txt_notarray=="have"){
		foreach($price_of_stu->print_array as $rc_key=>$pos_row){
			$pos_sumbook=$pos_row["pos_sumbook"];
			if($pos_sumbook==0.00){
				$pos_sumbook=$pob_price;
			}else{
				$pos_sumbook;
			}
		}		
	}else{
		$pos_sumbook=0;
	}
//price_of_stu***End	

		if($pos_sumbook==0){//ไม่มีอยู่ในบัญชีจ่ายค่าหนังสือ
			if($dataStu_room->IDLevel==3){ ?>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="alert alert-danger">
			<strong>แจ้งเตือนจากระบบ </strong> ค่าหนังสือเรียน ท่านได้ชำระแล้ว (รวมอยู่ในรายการค่าธรรมเนียมทางการศึกษา) รับหนังสือเรียนตามวันและเวลาที่กำหนด
		</div>	
	</div>
	<hr><div class="col-sm-12 col-md-12 col-lg-12">
		<div class="row">
			<center>
				<p><img src="Template/global_assets/images/กำหนดการรับหนังสือ.jpg" class="img-thumbnail" alt="กำหนดการรับหนังสือ" width="100%"></p>
			</center>	
		</div>
	</div>	
</div>				
<?php		}elseif($dataStu_room->IDLevel>=11 and $dataStu_room->IDLevel <=33){ ?>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="alert alert-danger">
			<strong>แจ้งเตือนจากระบบ </strong> ค่าหนังสือเรียน ถูกจ่ายโดย บัญชีออมทรัพย์ นักเรียน รับหนังสือเรียนตามวันและเวลาที่กำหนด
		</div>	
	</div>
	<hr><div class="col-sm-12 col-md-12 col-lg-12">
		<div class="row">
			<center>
				<p><img src="Template/global_assets/images/กำหนดการรับหนังสือ.jpg" class="img-thumbnail" alt="กำหนดการรับหนังสือ" width="100%"></p>
			</center>		
		</div>
	</div>
</div>				
<?php		}else{  ?>
<!--*********************************************************-->
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="alert alert-danger">
			<strong>แจ้งเตือนจากระบบ </strong> ชำระเงินเรียบร้อยแล้ว รับหนังสือเรียนตามวันและเวลาที่กำหนด
		</div>	
	</div>
	<hr><div class="col-sm-12 col-md-12 col-lg-12">
		<div class="row">
			<center>
				<p><img src="Template/global_assets/images/กำหนดการรับหนังสือ.jpg" class="img-thumbnail" alt="กำหนดการรับหนังสือ" width="100%"></p>
			</center>		
		</div>
	</div>
</div>
<!--*********************************************************-->				
<?php		}
		}elseif($pos_sumbook>$pob_price){?><!--ยอดเเงินที่จ่ายไม่เท่ากัน-->
<!--*********************************************************-->
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="alert alert-danger">
			<strong>แจ้งเตือนจากระบบ </strong> กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. 
		</div>	
	</div>
</div>
<!--*********************************************************-->
<?php	}elseif($pob_price!=""){ ?>



<!--/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/-->
<?php
		$pay_to=new overdue_rc($user_login,$data_termnew,$data_yaernew,'oc02');
		if($pay_to->overdue_os=="os03"){ ?>
		
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="alert alert-danger">
			<strong>แจ้งเตือนจากระบบ </strong> ชำระเงินเรียบร้อยแล้ว รับหนังสือเรียนตามวันและเวลาที่กำหนด
		</div>	
	</div>
	<hr><div class="col-sm-12 col-md-12 col-lg-12">
		<div class="row">
			<center>
				<p><img src="Template/global_assets/images/กำหนดการรับหนังสือ.jpg" class="img-thumbnail" alt="กำหนดการรับหนังสือ" width="100%"></p>
			</center>		
		</div>
	</div>
</div>			
			
<?php	}else{ ?>

<!--*********************************************************-->	
<?php
		$qrcodeSql="SELECT `bookqr_img` FROM `price_of_bookqr` WHERE `bookqr_stuid`='{$user_login}' and `bookqr_year`='{$data_yaernew}'";
		$qrcode=new print_notarray($qrcodeSql);
		if($qrcode->txt_notarray=="have"){
			foreach($qrcode->print_array as $rc_key=>$qrcodeRow){ ?>
<!--*********************************************************-->			
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-warning">
				<div class="panel-heading">ชำระค่าหนังสือเรียน</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6">
							<center>
								<p><div class="imgBox"><img src="Template/global_assets/images/กำหนดการรับหนังสือ.jpg" class="img-thumbnail" alt="กำหนดการรับหนังสือ" width="100%" data-origin="Template/global_assets/images/กำหนดการรับหนังสือ.jpg"></div></p>
							</center>
						</div>				
						<div class="col-sm-6 col-md-6 col-lg-6">
							<center>
								<p><img src="view/qr_codebook/2563/<?php echo $qrcodeRow['bookqr_img'];?>" class="img-thumbnail" alt="ชำระค่าหนังสือเรียน <?php echo $user_login;?>" width="304" height="236"></p>
								<p>หากชำระด้วย QR Code กรุณาบันทึกภาพเป็นหลักฐาน และสามารถมารับหนังสือเรียนได้ตามวันและเวลาที่กำหนด รับหนังสือเรียนตามวันและเวลาที่กำหนด</P>
							</center>
						</div>
					</div>
				</div>
			</div>		
		</div>
	</div>
<!--*********************************************************-->			
<?php			}
		}else{ ?>
<!--*********************************************************-->			
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-warning">
				<div class="alert alert-danger">
					<strong>แจ้งเตือนจากระบบ </strong> ไม่พบ Qrcode ชำระค่าหนังสือเรียน  กรุณาติดต่อห้องการเงิน โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. 
				</div>	
			</div>		
		</div>
	</div>
<!--*********************************************************-->			
			
<?php	}  ?>
<!--/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/-->

			
<?php		}      ?>		
<!--*********************************************************-->
	
<?php	}else{ ?>
<!--*********************************************************-->	
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="alert alert-danger">
			<strong>แจ้งเตือนจากระบบ </strong> ไม่พบข้อมูล
		</div>	
	</div>
</div>		
<!--*********************************************************-->		
<?php	} ?>

<?php	}
//Check tuition fees***End ?>