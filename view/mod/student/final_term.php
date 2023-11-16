<?php

	$data_yaer=2562;
	$data_term=2;
	
	$user_login;
	include("view/database/database_pay.php");
	include("view/database/class_db.php");
?>

<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4><span class="text-semibold">ตรวจสอบผลการเรียนออนไลน์</span></h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=final_term" class="btn btn-link  text-size-small"><span>ตรวจสอบผลการเรียนออนไลน์</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
<?php
	$off_sys=1;
	//กำหนดให้เข้าได้เฉราะ ป1-ม6
	$data_stu=new stu_level($user_login,$data_yaer,$data_term);
	if($data_stu->IDLevel>=11 and $data_stu->IDLevel<=13){
		$txt_type=1;
		$txt_term=0;
	}elseif($data_stu->IDLevel>=21 and $data_stu->IDLevel<=23){
		$txt_type=1;
		$txt_term=0;
	}elseif($data_stu->IDLevel>=31 and $data_stu->IDLevel<=33){
		if($data_term==1){
			$txt_type=2;
			$txt_term=1;			
		}else{
			$txt_type=2;
			$txt_term=2;			
		}
	}elseif($data_stu->IDLevel>=41 and $data_stu->IDLevel<=43){
		if($data_term==1){
			$txt_type=2;
			$txt_term=1;			
		}else{
			$txt_type=2;
			$txt_term=2;			
		}
	}else{
		$system_error2="error";
	}
	
	if($off_sys==0){
		$system_error3="error";
	}else{
		
	}
?>
<?php	error_reporting(error_reporting() & ~E_NOTICE);
		if($system_error3=="error"){ ?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ระบบตรวจสอบผลการเรียนออนไลน  </strong>เปิดระบบในวันที่ 25 มีนาคม 2563  
			</div>		
		</div>
	</div><br>			
<?php	}elseif($system_error1=="error" and $system_error2=="error"){ ?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong>ไม่พบข้อมูล  
			</div>		
		</div>
	</div><br>		
<?php	}elseif($system_error1=="error"){ ?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong>ไม่พบข้อมูล  
			</div>		
		</div>
	</div><br>		
<?php	}elseif($system_error2=="error"){ ?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ เข้าใช้งานได้เฉราะ ป1- ม6 เท่านั้น
			</div>			
		</div>
	</div><br>		
<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php 
	$pay_stu = new overdue_rc($user_login,$data_term,$data_yaer,"oc01");
		
		if($pay_stu->overdue_os=="os02"){ ?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ไม่พบข้อมูล ! </strong>กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น.  ภายในวันที่ 30 เมษายน 2563	
			</div>
		</div> 
	</div>
<?php	}elseif($pay_stu->overdue_echo=="notpay"){ ?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ไม่พบข้อมูล ! </strong>กรุณาติดต่อห้องการเงิน  โทร. 053 282395 วันจันทร์ ถึง วันศุกร์ เวลา 08.30 - 16.00 น. หรือ คลิกปุ่มด้านล่างนี้เพื่อชำระ ผ่าน Mobile Banking ภายในวันที่ 30 เมษายน 2563	
			</div>	
			<center><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Mobile Banking</button></center>
<!--///////////////////////////////////////////////////////////////////////////////////////////////-->			
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
    
<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<center><h4 class="modal-title">ค่าธรรมเนียมการศึกษาปีการศึกษา 2562 ภาคเรียนที่ 2</h4></center>
			</div>
        <div class="modal-body">
			
			
		<?php
			$payment_qrcode="SELECT Name as qrcode_img FROM  `payment_qrcode` WHERE  `IDStudent` ='{$user_login}' 
							 AND  `pd_term` ='{$data_term}' 
							 AND  `pd_ year` ='{$data_yaer}'";
			$payment_qrcodeRs=$pay_ment_sql->query($payment_qrcode);
			if($payment_qrcodeRs->num_rows>0){
				$payment_qrcodeRow=$payment_qrcodeRs->fetch_assoc();
				$qrcode_img=$payment_qrcodeRow["qrcode_img"]; ?>
				<center><img src="http://www.regina.ac.th/programming/payment/QR/<?php echo $data_term; ?>_<?php echo $data_yaer;?>/<?php echo $qrcode_img;?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"></center>
	<?php	}else{
				echo '<center>ไม่พบข้อมูล Mobile Banking</center>';
			}
		?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
        </div>
		</div>
		
		</div>
	</div>			
<!--///////////////////////////////////////////////////////////////////////////////////////////////-->			
			
		</div>
	</div><br>				
<?php   }else{ ?>
		
<!--////////////////////////////////////////////////////////////////////-->
<?php
			if($data_stu->IDLevel>=11 and $data_stu->IDLevel<=23){ ?>
<!--********************************************************************-->	
<?php
	if($data_term==1){
		//***********
	}else { ?>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
<!-- Invoice template -->
		<div class="panel panel-white">
			<div class="panel-heading">
				<div class="row">
					<center>
						<h6 class="panel-title">รายงานการวัดและประเมินผลการเรียนรู้       <?php echo $data_stu->Lname;?></h6>
						<h6 class="panel-title">ปลายภาคเรียนที่ <?php echo $data_term;?>  ปีการศึกษา <?php echo $data_yaer;?></h6>
					</center>
				</div>	
			</div>
			<div class="panel-heading">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<td><center>รหัสวิชา</center></td>
								<td><center>สาระการเรียนรู้</center></td>
								<td><center>หน่วยน้ำหนัก</center></td>
								<td colspan="3"><center>ตลอดปีการศึกษา</center></td>
								<td colspan="2"><center>ผลการเรียน</center></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><center>เต็ม</center></td>
								<td><center>ได้</center></td>
								<td><center>แก้ตัว</center></td>
								<td><center>ปกติ</center></td>
								<td><center>แก้ตัว</center></td>
							</tr>
						</thead>	
						<tbody>	
<!--สาระการเรียนรู้พื้นฐาน-->						
						    <tr class="success">
								<td colspan="8"><u><b>สาระการเรียนรู้พื้นฐาน</b></u></td>
							</tr>
	<?php
		$rc_master_scoreA="SELECT `IDSubject`,`NameSubject`,`Credit`,`IDSubType`,`IDsaraGroup`,`Type`,`Total`,`ReTotal`,`Grade`,`ReGrade` 
						  FROM `rc_master_score` WHERE `IDStudent`='{$data_stu->rsd_studentid}' 
						  and `Term`='{$txt_term}' 
						  and `YearEdu`='{$data_yaer}'
						  and `IDSubType`='11' 
						  ORDER BY`rc_master_score`.`IDsaraGroup`,`rc_master_score`.`Order` ASC ";
		$rc_master_scoreARs=$rcdata_connect->query($rc_master_scoreA) or die($rcdata_connect->error);
		if($rc_master_scoreARs->num_rows>0){
			while($rc_master_scoreARow=$rc_master_scoreARs->fetch_assoc()){ 

				$IDSubject=mb_substr($rc_master_scoreARow["IDSubject"],0,6,'UTF-8');
				$NameSubject=$rc_master_scoreARow["NameSubject"];
				$Credit=$rc_master_scoreARow["Credit"];
				$IDSubType=$rc_master_scoreARow["IDSubType"];
				$Grade=$rc_master_scoreARow["Grade"];
				$ReGrade=$rc_master_scoreARow["ReGrade"];
				$Total=$rc_master_scoreARow["Total"];
				$ReTotal=$rc_master_scoreARow["ReTotal"];
				
				
				$stu_intGrade=new stu_grade($Grade);
				$stu_intReGrade=new stu_grade($ReGrade);
				if($stu_intReGrade->txt_gradeint==0){
					$ReGrade="";
				}else{
					$ReGrade=$stu_intReGrade->txt_gradeint;
				}
//keep_Afoundation
		$keep_Afoundation=$keep_Afoundation+$Credit;
//keep_Amore				
		if($Grade==0.00){
			if($ReGrade==0.00){
				//**********
			}else{
				$keep_Amore=$keep_Amore+$Credit;
				$int_scoreA=$Credit*$ReGrade;
				$sum_scoreA1=$sum_scoreA1+$int_scoreA;
			}
		}else{
			$keep_Amore=$keep_Amore+$Credit;
			$int_scoreA=$Credit*$stu_intGrade->txt_gradeint;
			$sum_scoreA2=$sum_scoreA2+$int_scoreA;
		}
				
			$rc_subject="SELECT `Name`,`EName` FROM `rc_subject_$data_yaer` WHERE `IDSubject`='{$IDSubject}'";
			$rc_subjectRs=rc_data($rc_subject);
				
			foreach($rc_subjectRs as $rc_key=>$rc_subjectRow){
				$subject_Name=$rc_subjectRow["Name"];
				$subject_EName=$rc_subjectRow["EName"];
				if($subject_EName==""){
					$subjectEName="";
				}else{
					$subjectEName="(".$subject_EName.")";
				}
			}
				
				
				
     ?>
	 
																						
							<tr>
								<td><center><?php echo $IDSubject;?></center></td>
								<td><?php echo $NameSubject." ".$subjectEName;?></td>
								<td><center><?php echo $Credit;?></center></td>
								<td><center>100</center></td>
								<td><center><?php echo $Total;?></center></td>
								<td><center><?php echo $ReTotal;?></center></td>
								<td><center><?php echo $stu_intGrade->txt_gradeint;?></center></td>
								<td><center><?php echo $ReGrade;?></center></td>
							</tr>				
				
	<?php	}
		}else{ ?>
							<tr>
								<td colspan="8">ไม่พบข้อมูล</td>
							</tr>			
<?php	}  ?>					
<!--สาระการเรียนรู้เพิ่มเติม-->	
						    <tr class="info">
								<td colspan="8"><u><b>สาระการเรียนรู้เพิ่มเติม</b></u></td>
							</tr>
	<?php
		$rc_master_scoreB="SELECT `IDSubject`,`NameSubject`,`Credit`,`IDSubType`,`IDsaraGroup`,`Type`,`Total`,`ReTotal`,`Grade`,`ReGrade` 
						  FROM `rc_master_score` WHERE `IDStudent`='{$data_stu->rsd_studentid}' 
						  and `Term`='{$txt_term}' 
						  and `YearEdu`='{$data_yaer}'
						  and `IDSubType`='12'
						  ORDER BY `rc_master_score`.`IDsaraGroup`,`rc_master_score`.`Order` ASC";
		$rc_master_scoreBRs=$rcdata_connect->query($rc_master_scoreB) or die($rcdata_connect->error);
		if($rc_master_scoreBRs->num_rows>0){
			while($rc_master_scoreBRow=$rc_master_scoreBRs->fetch_assoc()){ 
				$IDSubject=mb_substr($rc_master_scoreBRow["IDSubject"],0,6,'UTF-8');
				$NameSubject=$rc_master_scoreBRow["NameSubject"];
				$Credit=$rc_master_scoreBRow["Credit"];
				$IDSubType=$rc_master_scoreBRow["IDSubType"];
				
				$Grade=$rc_master_scoreBRow["Grade"];
				$ReGrade=$rc_master_scoreBRow["ReGrade"];
				
				$Total=$rc_master_scoreBRow["Total"];
				$ReTotal=$rc_master_scoreBRow["ReTotal"];
				
				$stu_intGrade=new stu_grade($Grade);
				$stu_intReGrade=new stu_grade($ReGrade);
				if($stu_intReGrade->txt_gradeint==0){
					$ReGrade="";
				}else{
					$ReGrade=$stu_intReGrade->txt_gradeint;
				}				
//keep_Bfoundation
		$keep_Bfoundation=$keep_Bfoundation+$Credit;
//keep_Bmore				
		if($Grade==0.00){
			if($ReGrade==0.00){
				//**********
			}else{
				$keep_Bmore=$keep_Bmore+$Credit;
				$int_scoreB=$Credit*$ReGrade;
				$sum_scoreB1=$sum_scoreB1+$int_scoreB;
			}
		}else{
			$keep_Bmore=$keep_Bmore+$Credit;
			$int_scoreB=$Credit*$stu_intGrade->txt_gradeint;
			$sum_scoreB2=$sum_scoreB2+$int_scoreB;
		} 			

			$rc_subject="SELECT `Name`,`EName` FROM `rc_subject_$data_yaer` WHERE `IDSubject`='{$IDSubject}'";
			$rc_subjectRs=rc_data($rc_subject);
				
			foreach($rc_subjectRs as $rc_key=>$rc_subjectRow){
				$subject_Name=$rc_subjectRow["Name"];
				$subject_EName=$rc_subjectRow["EName"];
				if($subject_EName==""){
					$subjectEName="";
				}else{
					$subjectEName="(".$subject_EName.")";
				}
			}

		
     ?>
							<tr>
								<td><center><?php echo $IDSubject;?></center></td>
								<td><?php echo $NameSubject." ".$subjectEName;?></td>
								<td><center><?php echo $Credit;?></center></td>
								<td><center>100</center></td>
								<td><center><?php echo $Total;?></center></td>
								<td><center><?php echo $ReTotal;?></center></td>
								<td><center><?php echo $stu_intGrade->txt_gradeint;?></center></td>
								<td><center><?php echo $ReGrade;?></center></td>
							</tr>				
				
	<?php	}
		}else{ ?>
							<tr>
								<td colspan="8">ไม่พบข้อมูล</td>
							</tr>			
<?php	}  ?>
<!--กิจกรรมพิเศษ-->	
						    <tr class="warning">
								<td colspan="8"><u><b>กิจกรรมพิเศษ</b></u></td>
							</tr>
	<?php
		$rc_master_scoreC="SELECT `IDSubject`,`NameSubject`,`Credit`,`IDSubType`,`IDsaraGroup`,`Type`,`Total`,`ReTotal`,`Grade`,`ReGrade` 
						  FROM `rc_master_score` WHERE `IDStudent`='{$data_stu->rsd_studentid}' 
						  and `Term`='{$txt_term}' 
						  and `YearEdu`='{$data_yaer}'
						  and `IDSubType`='14'
						  ORDER BY `rc_master_score`.`IDsaraGroup`,`rc_master_score`.`Order` ASC";
		$rc_master_scoreCRs=$rcdata_connect->query($rc_master_scoreC) or die($rcdata_connect->error);
		if($rc_master_scoreCRs->num_rows>0){
			while($rc_master_scoreCRow=$rc_master_scoreCRs->fetch_assoc()){ 
				$IDSubject=mb_substr($rc_master_scoreCRow["IDSubject"],0,6,'UTF-8');
				$NameSubject=$rc_master_scoreCRow["NameSubject"];
				$Credit=$rc_master_scoreCRow["Credit"];
				$IDSubType=$rc_master_scoreCRow["IDSubType"];
				$Grade=$rc_master_scoreCRow["Grade"];
				
				$Total=$rc_master_scoreCRow["Total"];
				$ReTotal=$rc_master_scoreCRow["ReTotal"];
				
			$rc_subject="SELECT `Name`,`EName` FROM `rc_subject_$data_yaer` WHERE `IDSubject`='{$IDSubject}'";
			$rc_subjectRs=rc_data($rc_subject);
				
			foreach($rc_subjectRs as $rc_key=>$rc_subjectRow){
				$subject_Name=$rc_subjectRow["Name"];
				$subject_EName=$rc_subjectRow["EName"];
				if($subject_EName==""){
					$subjectEName="";
				}else{
					$subjectEName="(".$subject_EName.")";
				}
			}
				
     ?>
							<tr>
								<td><center><?php echo $IDSubject;?></center></td>
								<td><?php echo $NameSubject." ".$subjectEName;?></td>
		<?php	if($IDSubject=="ศ11801"){ ?>
								<td>&nbsp;</td>
								<td><center>100<center></td>
								<td><center><?php echo $Total;?></center></td>
								<td><center><?php echo $ReTotal;?></center></td>
		<?php
			if($ReTotal!=""){
				if($Total>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}
			}elseif($ReTotal!=0){
				if($Total>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}				
			}else{
				if($ReTotal>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}
			}
		?>						
								
								
								<td><center><?php echo $txt_tuer;?></center></td>
								<td>&nbsp;</td>								
		<?php	}elseif($IDSubject=="ศ12801"){ ?>
								<td>&nbsp;</td>
								<td><center>100</center></td>
								<td><center><?php echo $Total;?></center></td>
								<td><center><?php echo $ReTotal;?></center></td>
		<?php
			if($ReTotal!=""){
				if($Total>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}
			}elseif($ReTotal!=0){
				if($Total>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}				
			}else{
				if($ReTotal>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}
			}
			
			
		?>									
								<td><center><?php echo $txt_tuer;?></center></td>
								<td>&nbsp;</td>								
		<?php	}elseif($IDSubject=="ศ13801"){ ?>
								<td>&nbsp;</td>
								<td><center>100</center></td>
								<td><center><?php echo $Total;?></center></td>
								<td><center><?php echo $ReTotal;?></center></td>
		<?php
			if($ReTotal!=""){
				if($Total>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}
			}elseif($ReTotal!=0){
				if($Total>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}				
			}else{
				if($ReTotal>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}
			}
		?>									
								<td><center><?php echo $txt_tuer;?></center></td>
								<td>&nbsp;</td>								
		<?php	}elseif($IDSubject=="ศ14801"){ ?>
								<td>&nbsp;</td>
								<td><center>100</center></td>
								<td><center><?php echo $Total;?></center></td>
								<td><center><?php echo $ReTotal;?></center></td>
		<?php
			if($ReTotal!=""){
				if($Total>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}
			}elseif($ReTotal!=0){
				if($Total>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}				
			}else{
				if($ReTotal>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}
			}
		?>									
								<td><center><?php echo $txt_tuer;?></center></td>
								<td>&nbsp;</td>								
		<?php	}elseif($IDSubject=="ศ15801"){ ?>
								<td>&nbsp;</td>
								<td><center>100</center></td>
								<td><center><?php echo $Total;?></center></td>
								<td><center><?php echo $ReTotal;?></center></td>
		<?php
			if($ReTotal!=""){
				if($Total>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}
			}elseif($ReTotal!=0){
				if($Total>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}				
			}else{
				if($ReTotal>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}
			}
		?>									
								<td><center><?php echo $txt_tuer;?></center></td>
								<td>&nbsp;</td>								
		<?php	}elseif($IDSubject=="ศ16801"){ ?>
								<td>&nbsp;</td>
								<td><center>100</center></td>
								<td><center><?php echo $Total;?></center></td>
								<td><center><?php echo $ReTotal;?></center></td>
		<?php
			if($ReTotal!=""){
				if($Total>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}
			}elseif($ReTotal!=0){
				if($Total>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}				
			}else{
				if($ReTotal>=50){
					$txt_tuer="ผ่าน";
				}else{
					$txt_tuer="ไม่ผ่าน";
				}
			}
		?>									
								<td><center><?php echo $txt_tuer;?></center></td>
								<td>&nbsp;</td>								
		<?php	}else{
					if($Grade==0.00){
						$txt_Grade="ผ่าน";
					}else{
						$txt_Grade="ไม่ผ่าน";
					} ?>	
								<td>&nbsp;</td>
								<td><center><?php echo $txt_Grade;?></center></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
		<?php		} ?>								


							
							</tr>				
				
	<?php	}
		}else{ ?>
							<tr>
								<td colspan="8">ไม่พบข้อมูล</td>
							</tr>			
<?php	}  ?>							
							
							
						</tbody>
					</table>					
				</div>
			</div>
			<div class="panel-heading">			
				<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-6">
						<div class="table-responsive">
							<table class="table table-hover">
								<tbody>
									<tr class="success">
										<td><center>สรุปผลการเรียน</center></td>
										<td><center>ที่เรียน</center></td>
										<td><center>ที่ได้</center></td>
									</tr>
									<tr>
										<td class="success">จำนวนหน่วยกิตรายวิชาพื้นฐาน</td>
										<td><center><?php echo $keep_Afoundation;?></center></td>
										<td><center><?php echo $keep_Amore;?></center></td>
									</tr>									
									<tr>
										<td class="success">จำนวนหน่วยกิตรายวิชาเพิ่มเติม</td>
										<td><center><?php echo $keep_Bfoundation;?></center></td>
										<td><center><?php echo $keep_Bmore;?></center></td>
									</tr>									
									<tr>
										<td class="success">จำนวนหน่วยกิตรายวิชาทั้งหมด</td>
										<td><center><?php echo $keep_Afoundation+$keep_Bfoundation;?></center></td>
										<td><center><?php echo $keep_Amore+$keep_Bmore;?></center></td>
									</tr>									
									<tr>
										<td rowspan="2" class="success">ระดับผลการเรียนเฉลี่ย</td>
										<td class="success"><center>ปกติ</center></td>
										<td class="success"><center>แก้ตัว</center></td>
									</tr>								
									<tr>
	<?php
	//ปกติ
		$sumscoreA=$sum_scoreA2+$sum_scoreB2;//เกรด*หน่วยกิต
		$ansscoreA=$sumscoreA/($keep_Afoundation+$keep_Bfoundation);
		
		
		$ansscoreAex = explode('.',$ansscoreA);
		$ansscoreAs = substr($ansscoreAex[1],0,2);
		$PrintansscoreAs=$ansscoreAex[0].".".$ansscoreAs;
	//แก้ตัว
		$sumscoreB=$sum_scoreA1+$sum_scoreA2+$sum_scoreB1+$sum_scoreB2;//เกรด*หน่วยกิต
		$ansscoreB=$sumscoreB/($keep_Afoundation+$keep_Bfoundation);

		if($ansscoreA==$ansscoreB){
			$RsansscoreBs="";
		}else{
			$ansscoreBex = explode('.',$ansscoreB);
			$ansscoreBs = substr($ansscoreBex[1],0,2);
			$RsansscoreBs=number_format($ansscoreBex[0].".".$ansscoreBs,2);
		}
	?>								
								
										<td><center><?php echo number_format($PrintansscoreAs,2);?></center></td>
										<td><center><?php echo $RsansscoreBs;?></center></td>
									</tr>
								</tbody>
							</table>
						</div>					
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6"></div>
				</div>
			</div>			
		</div>
		
		
	</div>	
</div>		
<?php	  } ?>
<!--********************************************************************-->		
<?php		}elseif($data_stu->IDLevel>=31 and $data_stu->IDLevel<=43){ ?>
<!--********************************************************************-->	
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
<!-- Invoice template -->
		<div class="panel panel-white">
			<div class="panel-heading">
				<div class="row">
					<center>
						<h6 class="panel-title">รายงานการวัดและประเมินผลการเรียนรู้       <?php echo $data_stu->Lname;?></h6>
						<h6 class="panel-title">ปลายภาคเรียนที่ <?php echo $data_term;?>  ปีการศึกษา <?php echo $data_yaer;?></h6>
					</center>
				</div>	
			</div>
			<div class="panel-heading">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th rowspan="2"><center>รหัสวิชา</center></th>
								<th rowspan="2"><center>ชื่อวิชา</center></th>
								<th rowspan="2"><center>หน่วยกิต</center></th>
								<th colspan="2"><center>ผลการเรียน</center></th>
							</tr>
							<tr>
								<th><center>ปกติ</center></th>
								<th><center>แก้ตัว</center></th>
							</tr>
						</thead>	
						<tbody>	
<!--สาระการเรียนรู้พื้นฐาน-->						
						    <tr class="danger">
								<td colspan="5"><u><b>สาระการเรียนรู้พื้นฐาน</b></u></td>
							</tr>
	<?php
		$rc_master_scoreA="SELECT `IDSubject`,`NameSubject`,`Credit`,`IDSubType`,`IDsaraGroup`,`Type`,`Total`,`ReTotal`,`Grade`,`ReGrade` 
						  FROM `rc_master_score` WHERE `IDStudent`='{$data_stu->rsd_studentid}' 
						  and `Term`='{$txt_term}' 
						  and `YearEdu`='{$data_yaer}'
						  and `IDSubType`='11'
						  ORDER BY `rc_master_score`.`IDsaraGroup`,`rc_master_score`.`Order` ASC ";
		$rc_master_scoreARs=$rcdata_connect->query($rc_master_scoreA) or die($rcdata_connect->error);
		if($rc_master_scoreARs->num_rows>0){
			while($rc_master_scoreARow=$rc_master_scoreARs->fetch_assoc()){ 

				$IDSubject=mb_substr($rc_master_scoreARow["IDSubject"],0,6,'UTF-8');
				$NameSubject=$rc_master_scoreARow["NameSubject"];
				$Credit=$rc_master_scoreARow["Credit"];
				$IDSubType=$rc_master_scoreARow["IDSubType"];
				$Grade=$rc_master_scoreARow["Grade"];
				$ReGrade=$rc_master_scoreARow["ReGrade"];
				
				$stu_intGrade=new stu_grade($Grade);
				$stu_intReGrade=new stu_grade($ReGrade);
				if($stu_intReGrade->txt_gradeint==0){
					$ReGrade="";
				}else{
					$ReGrade=$stu_intReGrade->txt_gradeint;
				}
//keep_Afoundation
		$keep_Afoundation=$keep_Afoundation+$Credit;
//keep_Amore				
		if($Grade==0.00){
			if($ReGrade==0.00){
				//**********
			}else{
				$keep_Amore=$keep_Amore+$Credit;
				$int_scoreA=$Credit*$ReGrade;
				$sum_scoreA1=$sum_scoreA1+$int_scoreA;
			}
		}else{
			$keep_Amore=$keep_Amore+$Credit;
			$int_scoreA=$Credit*$stu_intGrade->txt_gradeint;
			$sum_scoreA2=$sum_scoreA2+$int_scoreA;
		}	

			$rc_subject="SELECT `Name`,`EName` FROM `rc_subject_$data_yaer` WHERE `IDSubject`='{$IDSubject}'";
			$rc_subjectRs=rc_data($rc_subject);
				
			foreach($rc_subjectRs as $rc_key=>$rc_subjectRow){
				$subject_Name=$rc_subjectRow["Name"];
				$subject_EName=$rc_subjectRow["EName"];
				if($subject_EName==""){
					$subjectEName="";
				}else{
					$subjectEName="(".$subject_EName.")";
				}
			}


     ?>
	 
																						
							<tr>
								<td><center><?php echo $IDSubject;?></center></td>
								<td><?php echo $NameSubject." ".$subjectEName;?></td>
								<td><center><?php echo $Credit;?></center></td>
								<td><center><?php echo $stu_intGrade->txt_gradeint;?></center></td>
								<td><center><?php echo $ReGrade;?></center></td>
							</tr>				
				
	<?php	}
		}else{ ?>
							<tr>
								<td colspan="5">ไม่พบข้อมูล</td>
							</tr>			
<?php	}  ?>					
<!--สาระการเรียนรู้เพิ่มเติม-->	
						    <tr class="info">
								<td colspan="5"><u><b>สาระการเรียนรู้เพิ่มเติม</b></u></td>
							</tr>
	<?php
		$rc_master_scoreB="SELECT `IDSubject`,`NameSubject`,`Credit`,`IDSubType`,`IDsaraGroup`,`Type`,`Total`,`ReTotal`,`Grade`,`ReGrade` 
						  FROM `rc_master_score` WHERE `IDStudent`='{$data_stu->rsd_studentid}' 
						  and `Term`='{$txt_term}' 
						  and `YearEdu`='{$data_yaer}'
						  and `IDSubType`='12'
						  ORDER BY `rc_master_score`.`IDsaraGroup`,`rc_master_score`.`Order` ASC";
		$rc_master_scoreBRs=$rcdata_connect->query($rc_master_scoreB) or die($rcdata_connect->error);
		if($rc_master_scoreBRs->num_rows>0){
			while($rc_master_scoreBRow=$rc_master_scoreBRs->fetch_assoc()){ 
				$IDSubject=mb_substr($rc_master_scoreBRow["IDSubject"],0,6,'UTF-8');
				$NameSubject=$rc_master_scoreBRow["NameSubject"];
				$Credit=$rc_master_scoreBRow["Credit"];
				$IDSubType=$rc_master_scoreBRow["IDSubType"];
				
				$Grade=$rc_master_scoreBRow["Grade"];
				$ReGrade=$rc_master_scoreBRow["ReGrade"];
				
				$stu_intGrade=new stu_grade($Grade);
				$stu_intReGrade=new stu_grade($ReGrade);
				if($stu_intReGrade->txt_gradeint==0){
					$ReGrade="";
				}else{
					$ReGrade=$stu_intReGrade->txt_gradeint;
				}				
//keep_Bfoundation
		$keep_Bfoundation=$keep_Bfoundation+$Credit;
//keep_Bmore				
		if($Grade==0.00){
			if($ReGrade==0.00){
				//**********
			}else{
				$keep_Bmore=$keep_Bmore+$Credit;
				$int_scoreB=$Credit*$ReGrade;
				$sum_scoreB1=$sum_scoreB1+$int_scoreB;
			}
		}else{
			$keep_Bmore=$keep_Bmore+$Credit;
			$int_scoreB=$Credit*$stu_intGrade->txt_gradeint;
			$sum_scoreB2=$sum_scoreB2+$int_scoreB;
		}	

			$rc_subject="SELECT `Name`,`EName` FROM `rc_subject_$data_yaer` WHERE `IDSubject`='{$IDSubject}'";
			$rc_subjectRs=rc_data($rc_subject);
				
			foreach($rc_subjectRs as $rc_key=>$rc_subjectRow){
				$subject_Name=$rc_subjectRow["Name"];
				$subject_EName=$rc_subjectRow["EName"];
				if($subject_EName==""){
					$subjectEName="";
				}else{
					$subjectEName="(".$subject_EName.")";
				}
			}
		
     ?>
							<tr>
								<td><center><?php echo $IDSubject;?></center></td>
								<td><?php echo $NameSubject." ".$subjectEName;?></td>
								<td><center><?php echo $Credit;?></center></td>
								<td><center><?php echo $stu_intGrade->txt_gradeint;?></center></td>
								<td><center><?php echo $ReGrade;?></center></td>
							</tr>				
				
	<?php	}
		}else{ ?>
							<tr>
								<td colspan="5">ไม่พบข้อมูล</td>
							</tr>			
<?php	}  ?>
<!--กิจกรรมพิเศษ-->	
						    <tr class="warning">
								<td colspan="5"><u><b>กิจกรรมพิเศษ</b></u></td>
							</tr>
	<?php
		$rc_master_scoreC="SELECT `IDSubject`,`NameSubject`,`Credit`,`IDSubType`,`IDsaraGroup`,`Type`,`Total`,`ReTotal`,`Grade`,`ReGrade` 
						  FROM `rc_master_score` WHERE `IDStudent`='{$data_stu->rsd_studentid}' 
						  and `Term`='{$txt_term}' 
						  and `YearEdu`='{$data_yaer}'
						  and `IDSubType`='14'
						  ORDER BY `rc_master_score`.`IDsaraGroup`,`rc_master_score`.`Order` ASC";
		$rc_master_scoreCRs=$rcdata_connect->query($rc_master_scoreC) or die($rcdata_connect->error);
		if($rc_master_scoreCRs->num_rows>0){
			while($rc_master_scoreCRow=$rc_master_scoreCRs->fetch_assoc()){ 
				$IDSubject=mb_substr($rc_master_scoreCRow["IDSubject"],0,6,'UTF-8');
				$NameSubject=$rc_master_scoreCRow["NameSubject"];
				$Credit=$rc_master_scoreCRow["Credit"];
				$IDSubType=$rc_master_scoreCRow["IDSubType"];
				$Grade=$rc_master_scoreCRow["Grade"];
				if($Grade==0.00){
					$txt_Grade="ผ่าน";
				}else{
					$txt_Grade="ไม่ผ่าน";
				}

			$rc_subject="SELECT `Name`,`EName` FROM `rc_subject_$data_yaer` WHERE `IDSubject`='{$IDSubject}'";
			$rc_subjectRs=rc_data($rc_subject);
				
			foreach($rc_subjectRs as $rc_key=>$rc_subjectRow){
				$subject_Name=$rc_subjectRow["Name"];
				$subject_EName=$rc_subjectRow["EName"];
				if($subject_EName==""){
					$subjectEName="";
				}else{
					$subjectEName="(".$subject_EName.")";
				}
			}
				
     ?>
							<tr>
								<td><center><?php echo $IDSubject;?></center></td>
								<td><?php echo $NameSubject." ".$subjectEName;?></td>
								<td>&nbsp;</td>
								<td><center><?php echo $txt_Grade;?></center></td>
								<td>&nbsp;</td>
							</tr>				
				
	<?php	}
		}else{ ?>
							<tr>
								<td colspan="5">ไม่พบข้อมูล</td>
							</tr>			
<?php	}  ?>							
							
							
						</tbody>
					</table>					
				</div>
			</div>
			<div class="panel-heading">			
				<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-6">
						<div class="table-responsive">
							<table class="table table-hover">
								<tbody>
									<tr class="success">
										<td><center>สรุปผลการเรียน</center></td>
										<td><center>ที่เรียน</center></td>
										<td><center>ที่ได้</center></td>
									</tr>
									<tr>
										<td class="success">จำนวนหน่วยกิตรายวิชาพื้นฐาน</td>
										<td><center><?php echo $keep_Afoundation;?></center></td>
										<td><center><?php echo $keep_Amore;?></center></td>
									</tr>									
									<tr>
										<td class="success">จำนวนหน่วยกิตรายวิชาเพิ่มเติม</td>
										<td><center><?php echo $keep_Bfoundation;?></center></td>
										<td><center><?php echo $keep_Bmore;?></center></td>
									</tr>									
									<tr>
										<td class="success">จำนวนหน่วยกิตรายวิชาทั้งหมด</td>
										<td><center><?php echo $keep_Afoundation+$keep_Bfoundation;?></center></td>
										<td><center><?php echo $keep_Amore+$keep_Bmore;?></center></td>
									</tr>									
									<tr>
										<td rowspan="2" class="success">ระดับผลการเรียนเฉลี่ย</td>
										<td class="success"><center>ปกติ</center></td>
										<td class="success"><center>แก้ตัว</center></td>
									</tr>								
									<tr>
	<?php
	//ปกติ
		$sumscoreA=$sum_scoreA2+$sum_scoreB2;//เกรด*หน่วยกิต
		$ansscoreA=$sumscoreA/($keep_Afoundation+$keep_Bfoundation);
		
		
		$ansscoreAex = explode('.',$ansscoreA);
		$ansscoreAs = substr($ansscoreAex[1],0,2);
		$PrintansscoreAs=$ansscoreAex[0].".".$ansscoreAs;
	//แก้ตัว
		$sumscoreB=$sum_scoreA1+$sum_scoreA2+$sum_scoreB1+$sum_scoreB2;//เกรด*หน่วยกิต
		$ansscoreB=$sumscoreB/($keep_Afoundation+$keep_Bfoundation);

		if($ansscoreA==$ansscoreB){
			$RsansscoreBs="";
		}else{
			$ansscoreBex = explode('.',$ansscoreB);
			$ansscoreBs = substr($ansscoreBex[1],0,2);
			$RsansscoreBs=number_format($ansscoreBex[0].".".$ansscoreBs,2);
		}
	?>								
								
										<td><center><?php echo number_format($PrintansscoreAs,2);?></center></td>
										<td><center><?php echo $RsansscoreBs;?></center></td>
									</tr>
								</tbody>
							</table>
						</div>					
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6"></div>
				</div>
			</div>
		</div>
	</div>
</div>	
<!--********************************************************************-->		
<?php		}else{ ?>
<!--********************************************************************-->	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ไม่พบข้อมูล</strong>... 
			</div>			
		</div>
	</div><br>
<!--********************************************************************-->					
<?php		}
		
	} ?>
<!--////////////////////////////////////////////////////////////////////-->		

<?php	}      ?>

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

