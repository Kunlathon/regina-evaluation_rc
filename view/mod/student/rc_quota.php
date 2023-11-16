<?php
	include("view/database/pdo_quota.php");
	include("view/database/pdo_data.php");
	include("view/database/class_quota.php");
	error_reporting(error_reporting() & ~E_NOTICE); 
?>
       
	   
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	$OFFONDateTime=date("2023-01-19 08:00:00");//Time Open***************
	//$OFFONDateTime=date("2021-07-24 08:00:00");
	$OFFONDateTime_Cr=date("Y-m-d H:i:s");
	$OFFONDateTime_notrun=strtotime($OFFONDateTime);
	$OFFONDateTime_run=strtotime($OFFONDateTime_Cr);
//+++++++++++++++23End	
		if($OFFONDateTime_run>=$OFFONDateTime_notrun){
			$OFFONPrint_runtime="ON";
		}else{
			$OFFONPrint_runtime="OFF"; 
		}		
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->  
<?php
		if($OFFONPrint_runtime=="OFF"){     ?>
<!--##########################################################-->
<div id="RuningLoadTalent">
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alpha-teal border-teal alert-styled-left">
					ประกาศรายชื่อผู้มีสิทธิ์มอบตัวโควตา ปีการศึกษา 2566 เปิดระบบในวันที่ 20 กรกฎาคม 2564 เวลา 08.00 เป็นต้นไป
				</div>
			</div>
		</div>
	</div>		
</div>		
<!--##########################################################-->		
<?php	}elseif($OFFONPrint_runtime=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--##########################################################-->	
		<?php
		//+++++++++++++++++++++++++++++++++++++++++++*****************
			$data_yaer=2566;
			$user_login;
			//********************************************************
			$next_yaer=2567;
			//********************************************************
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
		//ข้อมูลนักเรียน 
			$call_sturc=new regina_stu_data($user_login);
		//ระดับชั้น
			$call_stu=new stu_levelpdo($user_login,$data_yaer,"1");
		//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
			
				//include("view/function/strlen.php"); 
			
				$datetime="2023-12-01 24:00:00";//Time End
				$datetime_cr=date("Y-m-d H:i:s");
				$datatime_notrun=strtotime($datetime);
				$datatime_run=strtotime($datetime_cr);
				
				if($datatime_run>=$datatime_notrun){
					$print_runtime="OFF";
				}else{
					$print_runtime="ON";
				}
		?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
				$test_system="ON";
				switch($test_system){
					case "OFF": ?>
			<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="content-group-<?php echo $grid;?>">
						<div class="alert alpha-teal border-teal alert-styled-left">
							<div>ขออภัยในความสะดวก เจ้าหน้าที่ ICT กำลังทดสอบระบบ... </div>
							<div>หากผู้ปกครองดำเนินการกรอกข้อมูล จะถือว่าดำเนินการไม่สำเร็จ</div>
						</div>
					</div>
				</div>
			</div>			
			<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
			<?php	break;
					default:
			//---------------------------------------------------------------		
				}
			?>
		<?php
			switch ($call_stu->IDLevel){
				case "23": ?>		
		<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="breadcrumb-line breadcrumb-line-component">
					<ul class="breadcrumb">
						<h4><span class="text-semibold">ประกาศรายชื่อผู้มีสิทธิ์มอบตัวเข้าศึกษาต่อในระดับชั้นมัธยมศึกษาปีที่ 1 ปีการศึกษา <?php echo $next_yaer;?></span></h4>
						<h5><span class="text-semibold">โรงเรียนเรยีนาเชลีวิทยาลัย</span></h5>
					</ul>
					<ul class="breadcrumb-elements">
						<div class="heading-btn-group">
							<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
							<a class="btn btn-link  text-size-small"><span>/</span></a>
							<a href="./?evaluation_mod=rc_quota" class="btn btn-link  text-size-small"><span>นักเรียนได้รับสิทธิ์โควตาภายใน</span></a>
						</div>
					</ul>
				</div>
			</div>
		</div><br>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->	
		<?php
			switch($print_runtime){
				case "OFF": ?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-danger">
					ระบบโควตาภายใน สิ้นสุดระยะเวลาดำเนินการแล้วในขณะนี้ ท่านผู้ปกครองหรือนักเรียนต้องการ ดำเนินการมอบตัวโควตาภายใน  กรุณาติตต่อห้องการวิชาการ 
				</div>		
			</div>
		</div>	
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<?php		break; 
				default :  ?>  
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<!--วิชาการ---->
		<?php
			$quota_academicSql="SELECT count(`qc_stuid`) as `count_academic` 
								FROM `quota_academic` 
								WHERE `qc_stuid`='{$user_login}' 
								and `qc_year`='{$data_yaer}' 
								and `qc_level`='{$call_stu->IDLevel}'";
			$quota_academic=new row_quotanotarray($quota_academicSql);
			foreach($quota_academic->print_quotanotarray() as $rc_quota=>$quota_academicRow){
				$count_academic=$quota_academicRow["count_academic"];
			}
		?>
		<!--วิชาการ จบ---->
		<!---->
		<?php
				if($count_academic>=1){ ?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-warning">
					<strong>ท่านไม่สามารถทำรายการได้ในขณะนี้ </strong> กรุณาติดต่อฝ่ายวิชาการ  โทรศัพท์ 053-282395 ต่อ 121 หรือ 122 (ในวันและเวลาราชการ)
				</div>	
			</div>
		</div>	
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<?php	}else{
				$quota_rightSql="SELECT `qr_stuid`, `qr_year`, `qr_level`, `qr_plan` 
								 FROM `quota_right` 
								 WHERE `qr_stuid`='{$user_login}' 
								 and `qr_year`='{$next_yaer}' 
								 and `qr_level`='31'";
				$quota_right=new row_quotanotarray($quota_rightSql);
				foreach($quota_right->print_quotanotarray() as $rc_quota=>$quota_rightRow){
					$qr_stuid=$quota_rightRow["qr_stuid"];
					$qr_year=$quota_rightRow["qr_year"];
					$qr_level=$quota_rightRow["qr_level"];
					$qr_plan=$quota_rightRow["qr_plan"];
					if($qr_stuid!=""){?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php
	$quota_request=new DoQuotaRequest($user_login,$next_yaer,31);
		if($quota_request->PQR_system=="yes"){ 
//------------------------------------------------------------------------------------------
			$pq_planA=new print_plan2($quota_request->Request_qr_stuid);
			$Request_planA1=$pq_planA->plan_LName;
			$Request_planA2=$pq_planA->plan_Name;	
			$Request_planA=$Request_planA2."&nbsp; (".$Request_planA1.")";
//------------------------------------------------------------------------------------------
			if($quota_request->Request_qce_key==null){
				$Request_planB="-";
			}elseif($quota_request->Request_qce_key=="-" or $quota_request->Request_qce_key=="null"){
				$Request_planB="-";
			}else{
				$pq_planB=new print_plan2($quota_request->Request_qce_key);	
				$Request_planB1=$pq_planB->plan_LName;
				$Request_planB2=$pq_planB->plan_Name;
				$Request_planB=$Request_planB2."&nbsp;(".$Request_planB1.")";				
			}
//------------------------------------------------------------------------------------------		
		?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-info">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th><div>แผนกการเรียน โควตา</div></th>
									<th><div>แผนกการเรียน ประสงค์ขอสอบย้าย</div></th>
								</tr>
							</thead>
						<tbody>
							<tr class="warning">
								<td><div><?php echo $Request_planA;?></div></td>
								<td><div><?php echo $Request_planB;?></div></td>								
							</tr>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}else{
			//-------------------------------------------------------------------------------------------
		}
?>		
		
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-warning">
				  <strong><center><a href="?evaluation_mod=profile_modify">คลิกที่นี่</a></strong> ตรวจสอบ และเพิ่มเติมข้อมูลของนักเรียน</center>
				</div>
			</div>
		</div>
		
		
		
		
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-success">
				<?php
					$call_quota=new print_plan($qr_plan);
				?>
					<strong> ขอแสดงความยินดี </strong> ได้รับสิทธิ์โควตา ห้องเรียน <?php echo $call_quota->plan_LName;?>
				</div>
			</div>
		</div>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="row">
			<div class="col-<?php echo $grid;?>-12"> 
				<center><button type="button"  class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_theme_warning">ดำเนินการต่อ <i class="icon-cog4 spinner position-right"></i></button></center>
			</div>
		</div><br>
		<!-- Warning modal -->
			<div class="modal fade" id="modal_theme_warning" role="dialog">
			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$code31Error="OFF";
			if($code31Error=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
					<div class="modal-header bg-warning">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">เอกสารประกอบการมอบตัว</h4>
					</div>
					<div class="modal-body">
					<form name="rc_quota" method="post" action="./?evaluation_mod=quota">	
		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
				$quota_InternalSaveRights=new PrintSendDocuments($user_login,$next_yaer);
				if($quota_InternalSaveRights->RowArraySendDocuments() && (gettype($quota_InternalSaveRights->RowArraySendDocuments())=='array' || gettype($quota_InternalSaveRights->RowArraySendDocuments())=='object')){
					foreach($quota_InternalSaveRights->RowArraySendDocuments() as $rc=>$InternalSaveRightsRow){ 
						$sd_send_documents=$InternalSaveRightsRow["sd_send_documents"];
						$SdStudentIDCard=$InternalSaveRightsRow["SdStudentIDCard"];
						$SdParentIDCard=$InternalSaveRightsRow["SdParentIDCard"];
						$sd_surrender=$InternalSaveRightsRow["sd_surrender"];
						$sd_financial_documents=$InternalSaveRightsRow["sd_financial_documents"];						
					}			
				}else{
					$sd_send_documents="-";
					$SdStudentIDCard="-";
					$SdParentIDCard="-";
					$sd_surrender="-";
					$sd_financial_documents="-";
				}
			?>		
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<div class="modal-body">
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5">
									<b style="color: #00008B"> 
										<div>วิธีการนำส่งการเอกสาร</div>
										<div>ประกอบการมอบตัว (กรุณาเลือก 1 วิธี)</div>
									</b>
								</label>	
				<?php
						if($sd_send_documents=="mail"){ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
								<div class="col-<?php echo $grid;?>-7">
									<div>
										<label class="radio-inline">
											<input type="radio" class="styled" name="sd_send_documents" value="mail" checked="checked" required="required">
											<div>ส่งทาง E-mail</div>
											<div>academic@regina.ac.th</div>
										</label>							
									</div>
									<div>
										<label class="radio-inline">
											<input type="radio" class="file-styled" name="sd_send_documents" value="zip" required="required">
											<div>ส่งทางไปรษณีย์</div>
											<div>(ชื่อและที่อยู่ผู้รับ)</div>
											<div>ฝ่ายวิชาการ โรงเรียนเรยีนาเชลีวิทยาลัย</div>
											<div>เลขที่ 166 ถ.เจริญประเทศ ต.ช้างคลาน อ.เมือง จ.เชียงใหม่ 50100</div>								
										</label>							
									</div>
								</div>					
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->					
				<?php	}elseif($sd_send_documents=="zip"){ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
								<div class="col-<?php echo $grid;?>-7">
									<div>
										<label class="radio-inline">
											<input type="radio" class="styled" name="sd_send_documents" value="mail" required="required">
											<div>ส่งทาง E-mail</div>
											<div>academic@regina.ac.th</div>
										</label>							
									</div>
									<div>
										<label class="radio-inline">
											<input type="radio" class="file-styled" name="sd_send_documents" value="zip" checked="checked" required="required">
											<div>ส่งทางไปรษณีย์ </div>
											<div>(ชื่อและที่อยู่ผู้รับ)</div>
											<div>ฝ่ายวิชาการ โรงเรียนเรยีนาเชลีวิทยาลัย</div>
											<div>เลขที่ 166 ถ.เจริญประเทศ ต.ช้างคลาน อ.เมือง จ.เชียงใหม่ 50100</div>								
										</label>							
									</div>
								</div>					
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->					
				<?php	}else{ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
								<div class="col-<?php echo $grid;?>-7">
									<div>
										<label class="radio-inline">
											<input type="radio" class="styled" name="sd_send_documents" value="mail" required="required">
											<div>ส่งทาง E-mail</div>
											<div>academic@regina.ac.th</div>
										</label>							
									</div>
									<div>
										<label class="radio-inline">
											<input type="radio" class="file-styled" name="sd_send_documents" value="zip" required="required">
											<div>ส่งทางไปรษณีย์</div>
											<div>(ชื่อและที่อยู่ผู้รับ)</div>
											<div>ฝ่ายวิชาการ โรงเรียนเรยีนาเชลีวิทยาลัย</div>
											<div>เลขที่ 166 ถ.เจริญประเทศ ต.ช้างคลาน อ.เมือง จ.เชียงใหม่ 50100</div>								
										</label>							
									</div>
								</div>					
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->					
				<?php	}      ?>	

							</div>
						</fieldset>
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5">
									<b style="color: #00008B"> 
										<div>เอกสารประกอบการมอบตัว</div>
										<div>สแกนการมอบตัวเป็นไฟส์ภาพ (JPG)</div>
									</b>
								</label>					
								<div class="col-<?php echo $grid;?>-7">

		<?php
				if($sd_surrender=="yes"){ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
									<div>
										<label class="checkbox-inline">
											<input type="checkbox" class="file-styled" name="sd_surrender" value="yes" checked="checked">
											<div>ใบมอบตัวนักเรียน</div>
										</label>							
									</div>		
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->					
	    <?php   }else{ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
									<div>
										<label class="checkbox-inline">
											<input type="checkbox" class="file-styled" name="sd_surrender" value="yes">
											<div>ใบมอบตัวนักเรียน</div>
										</label>							
									</div>		
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->					
		<?php	}      ?>
		
		<?php
				if($SdStudentIDCard=="yes"){ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
									<div>
										<label class="checkbox-inline">
											<input type="checkbox" class="file-styled" name="SdStudentIDCard" value="yes" checked="checked">
											<div>สำเนาบัตรประชาชนนักเรียน จำนวน 1 ฉบับ</div>
										</label>							
									</div>		
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->		
		<?php	}else{ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
									<div>
										<label class="checkbox-inline">
											<input type="checkbox" class="file-styled" name="SdStudentIDCard" value="yes">
											<div>สำเนาบัตรประชาชนนักเรียน จำนวน 1 ฉบับ</div>
										</label>							
									</div>		
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->		
		<?php	}      ?>						
								

		<?php
				if($SdParentIDCard=="yes"){ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
									<div>
										<label class="checkbox-inline">
											<input type="checkbox" class="styled" name="SdParentIDCard" value="yes" checked="checked">
											<div>สำเนาบัตรประชาชนบิดา หรือ มารดา หรือ ผู้ปกครอง จำนวน 1 ฉบับ</div>
										</label>							
									</div>		
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->		
		<?php	}else{ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
									<div>
										<label class="checkbox-inline">
											<input type="checkbox" class="styled" name="SdParentIDCard" value="yes">
											<div>สำเนาบัตรประชาชนบิดา หรือ มารดา หรือ ผู้ปกครอง จำนวน 1 ฉบับ</div>
										</label>							
									</div>	
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->		
		<?php	}      ?>		

		<?php
				if($sd_financial_documents=="yes"){ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
									<div>
										<label class="checkbox-inline">
											<input type="checkbox" class="styled" name="sd_financial_documents" value="yes" checked="checked">
											<div>หลักฐานการชำระเงิน (สลิปโอนเงิน หรือสำเนาใบเสร็จรับเงิน)</div>
										</label>							
									</div>			
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->					
	    <?php   }else{ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
									<div>
										<label class="checkbox-inline">
											<input type="checkbox" class="styled" name="sd_financial_documents" value="yes">
											<div>หลักฐานการชำระเงิน (สลิปโอนเงิน หรือสำเนาใบเสร็จรับเงิน)</div>
										</label>							
									</div>			
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->					
		<?php	}      ?>		
																
								</div>						
							</div>
						</fieldset>			
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<center><button type="submit" class="btn btn-info" name="qr_plan" value="<?php echo $qr_plan;?>">ดำเนินการมอบตัว</button></center>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<center><a href="<?php echo $golink;?>/view/img_user/document/pdf/ระเบียบและปฏิทินการรับสมัครนักเรียน_ม.1.pdf" target="_blank"><button type="button" class="btn btn-default">ระเบียบและปฏิทินการรับสมัครนักเรียน ม.1</button></a></center>						
					</div>
				</div>
			</div>			
		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					</form>			
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
					</div>
				</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
					<div class="modal-header bg-warning">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">มอบตัวนักเรียนโควตาภายใน</h4>
					</div>
					<div class="modal-body">
<form name="rc_quota" method="post" action="./?evaluation_mod=quota">	

						<div class="modal-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">
									<center><button type="submit" class="btn btn-info" name="qr_plan" value="<?php echo $qr_plan;?>">ดำเนินการมอบตัว</button></center>
								</div>
								<div class="col-<?php echo $grid;?>-6">
									<center><a href="<?php echo $golink;?>/view/img_user/document/pdf/q2567_31.pdf" target="_blank"><button type="button" class="btn btn-default">ระเบียบและปฏิทินการรับสมัครนักเรียน ม.1</button></a></center>						
								</div>
							</div>
						</div>	
					
</form>			
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
					</div>
				</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			
			

			
			</div>
		<!-- /warning modal -->
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<!--<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						<center><div>กำหนดการมอบตัว</div>
						<div>ระดับชั้นมัธยมศึกษาปีที่ 1 และ 4 ปีการศึกษา 2565</div>
						<div>(รอบโควตาภายใน) โรงเรียนเรยีนาเชลีวิทยาลัย</div>
						<div>ระหว่างวันที่ 20 สิงหาคม - 3 กันยายน 2564</div></center>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							  <table class="table table-bordered">
								<tbody>
								  <tr>
									<td><center><strong>ขั้นตอนการมอบตัว</strong></center></td>
									<td><center><strong>สถานที่</strong></center></td>
								  </tr>
								  <tr>
									<td>
										<div>1. กรอกใบมอบตัวในระบบออนไลน์</div>  
									</td>
									<td rowspan="4"><center><div>www.regina.ac.th</div></center></td>
								  </tr>
								  <tr>
									<td>
										<div>2. สมัครสอบห้องเรียน  วิทยาศาสตร์ - คณิตศาสตร์ (สสวท.)</div>  
										<div>(เฉพาะนักเรียน ชั้น ม.1  และ ม.4 (แผนการเรียนวิทย์ - คณิต) ที่มีความประสงค์สมัครสอบ)</div>  
									</td>
								  </tr>
								  <tr>
									<td>
										<div>3. สมัครสอบย้ายแผนการเรียน</div>  
										<div>(เฉพาะนักเรียน ชั้น ม.4 ที่มีความประสงค์สมัครสอบ)</div>  
									</td>
								  </tr>
								  <tr>
									<td>
										<div>4. พิมพ์ใบมอบตัว / ใบสมัครสอบห้องเรียน วิทยาศาสตร์ - คณิตศาสตร์ (สสวท.)</div>  
									</td>
								  </tr>
								  <tr>
									<td>
										<div>5. ชำระเงินค่าธรรมเนียมการเรียน สามารถทำได้ 2 ช่องทาง คือ</div>
									</td>
									<td>&nbsp;</td>
								  </tr>
								  <tr>
									<td><div>&nbsp;&nbsp;ช่องทางที่ 1  ใช้วิธีสแกนคิวอาร์โค้ด (QR Code) ในใบมอบตัวเพื่อชำระเงิน</div></td>
									<td><center><div>Mobile Banking</div></center></td>
								  </tr>
								  <tr>
									<td><div>&nbsp;&nbsp;ช่องทางที่ 2  ชำระเงินสด หรือบัตรเครดิต (ค่าธรรมเนียม 1.7%)</div></td>
									<td><center><div>ห้องการเงิน โรงเรียนเรยีนาเชลีวิทยาลัย</div></center></td>
								  </tr>
								  <tr>
									<td><div>6. นำส่งเอกสารประกอบการมอบตัว (ตามวิธีที่เลือกไว้ในระบบ) มีดังนี้ </div></td>
									<td rowspan="5">
										<div>-&nbsp;ส่งทาง E-mail</div>
										<div>&nbsp;&nbsp;academic@regina.ac.th</div>
										<hr>
										<div>-&nbsp;ส่งทางไปรษณีย์ </div>
										<div>&nbsp;&nbsp;(ชื่อและที่อยู่ผู้รับ)</div>
										<div>&nbsp;&nbsp;ฝ่ายวิชาการ โรงเรียนเรยีนาเชลีวิทยาลัย</div>
										<div>&nbsp;&nbsp;เลขที่ 166 ถ.เจริญประเทศ ต.ช้างคลาน อ.เมือง จ.เชียงใหม่ 50100</div>									
									</td>
								  </tr>
								  <tr>
									<td><div>- ใบมอบตัวนักเรียน</div></td>
								  </tr>
								  <tr>
									<td><div>- สำเนาบัตรประชาชนของนักเรียน                             จำนวน 1 ฉบับ</div></td>
								  </tr>
								  <tr>
									<td><div>- สำเนาบัตรประชาชนของบิดา หรือมารดา หรือผู้ปกครอง            จำนวน 1 ฉบับ</div></td>
								  </tr>
								  <tr>
									<td><div>- หลักฐานการชำระเงิน (สลิปโอนเงิน หรือสำเนาใบเสร็จรับเงิน)</div></td>
								  </tr>
								</tbody>
							  </table>
						</div>			
					</div>
				</div>	
			</div>
		</div>-->					
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php		}else{ ?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-warning">
					<strong>ไม่พบข้อมูล </strong> กรุณาติดต่อฝ่ายวิชาการ  โทรศัพท์ 053-282395 ต่อ 121 หรือ 122 (ในวันและเวลาราชการ)
				</div>	
			</div>
		</div>					
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php		}
				}
			}?>



		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	} ?>
		<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->				
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	


		<!---->
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<?php		

				break;
				case "33": ?>
		<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<div class="breadcrumb-line breadcrumb-line-component">
					<ul class="breadcrumb">
						<h4><span class="text-semibold">ประกาศรายชื่อผู้มีสิทธิ์มอบตัวเข้าศึกษาต่อในระดับชั้นมัธยมศึกษาปีที่ 4 ปีการศึกษา <?php echo $next_yaer;?></span></h4>
						<h5><span class="text-semibold">โรงเรียนเรยีนาเชลีวิทยาลัย</span></h5>
					</ul>
					<ul class="breadcrumb-elements">
						<div class="heading-btn-group">
							<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
							<a class="btn btn-link  text-size-small"><span>/</span></a>
							<a href="./?evaluation_mod=rc_quota" class="btn btn-link  text-size-small"><span>นักเรียนได้รับสิทธิ์โควตาภายใน</span></a>
						</div>
					</ul>
				</div>
			</div>
		</div><br>
		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->	
		<?php
			switch($print_runtime){
				case "OFF": ?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-danger">
					ระบบโควตาภายใน สิ้นสุดระยะเวลาดำเนินการแล้วในขณะนี้ ท่านผู้ปกครองหรือนักเรียนต้องการ ดำเนินการมอบตัวโควตาภายใน  กรุณาติตต่อฝ่ายวิชาการ  โทรศัพท์ 053-282395 ต่อ 121 หรือ 122 (ในวันและเวลาราชการ)
				</div>		
			</div>
		</div>	
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<?php		break; 
				default :  ?>  
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<!--วิชาการ---->
		<?php
			$quota_academicSql="SELECT count(`qc_stuid`) as `count_academic` 
								FROM `quota_academic` 
								WHERE `qc_stuid`='{$user_login}' 
								and `qc_year`='{$data_yaer}' 
								and `qc_level`='{$call_stu->IDLevel}'";
			$quota_academic=new row_quotanotarray($quota_academicSql);
			foreach($quota_academic->print_quotanotarray() as $rc_quota=>$quota_academicRow){
				$count_academic=$quota_academicRow["count_academic"];
			}
		?>
		<!--วิชาการ จบ---->
		<!---->
		<?php
				if($count_academic>=1){ ?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-warning">
					<strong>ท่านไม่สามารถทำรายการได้ในขณะนี้ </strong> กรุณาติดต่อฝ่ายวิชาการ  โทรศัพท์ 053-282395 ต่อ 121 หรือ 122 (ในวันและเวลาราชการ) 
				</div>	
			</div>
		</div>	
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<?php	}else{
				$quota_rightSql="SELECT `qr_stuid`, `qr_year`, `qr_level`, `qr_plan` 
								 FROM `quota_right` 
								 WHERE `qr_stuid`='{$user_login}' 
								 and `qr_year`='{$next_yaer}' 
								 and `qr_level`='41'";
				$quota_right=new row_quotanotarray($quota_rightSql);
				foreach($quota_right->print_quotanotarray() as $rc_quota=>$quota_rightRow){
					
					if(is_array($quota_rightRow) && count($quota_rightRow)){
						$qr_stuid=$quota_rightRow["qr_stuid"];
						$qr_year=$quota_rightRow["qr_year"];
						$qr_level=$quota_rightRow["qr_level"];
						$qr_plan=$quota_rightRow["qr_plan"];						
					}else{
						$qr_stuid="-";
						$qr_year="-";
						$qr_level="-";
						$qr_plan="-";						
					}
					
					if($qr_stuid!="-"){?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-warning">
				  <strong><center><a href="?evaluation_mod=profile_modify">คลิกที่นี่</a></strong> ตรวจสอบ และเพิ่มเติมข้อมูลของนักเรียน</center>
				</div>
			</div>
		</div>
<?php
	$quota_request=new DoQuotaRequest($user_login,$next_yaer,41);
		if($quota_request->PQR_system=="yes"){ 
//------------------------------------------------------------------------------------------
			$pq_planA=new print_plan2($quota_request->Request_qr_stuid);
			$Request_planA1=$pq_planA->plan_LName;
			$Request_planA2=$pq_planA->plan_Name;	
			$Request_planA=$Request_planA2."&nbsp; (".$Request_planA1.")";
//------------------------------------------------------------------------------------------
			$pq_planA=new print_plan2($quota_request->Request_qr_stuid);
			$Request_planA1=$pq_planA->plan_LName;
			$Request_planA2=$pq_planA->plan_Name;	
			$Request_planA=$Request_planA2."&nbsp; (".$Request_planA1.")";
//------------------------------------------------------------------------------------------
			if($quota_request->Request_qce_key==null){
				$Request_planB="-";
			}elseif($quota_request->Request_qce_key=="-" or $quota_request->Request_qce_key=="null"){
				$Request_planB="-";
			}else{
				$pq_planB=new print_plan2($quota_request->Request_qce_key);	
				$Request_planB1=$pq_planB->plan_LName;
				$Request_planB2=$pq_planB->plan_Name;
				$Request_planB=$Request_planB2."&nbsp;(".$Request_planB1.")";				
			}
//------------------------------------------------------------------------------------------		
		?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-info">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th><div>แผนกการเรียน โควตา</div></th>
									<th><div>แผนกการเรียน ประสงค์ขอสอบย้าย</div></th>
									<th><div>เวลา ทำรายการมอบตัว</div></th>
								</tr>
							</thead>
						<tbody>
							<tr class="warning">
								<td><div><?php echo $Request_planA;?></div></td>
								<td><div><?php echo $Request_planB;?></div></td>								
								<td><div><?php echo date_timeThailand($quota_request->Request_datetime);?></div></td>
							</tr>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}else{
			//-------------------------------------------------------------------------------------------
		}
?>			
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-success">
				<?php
					$call_quota=new print_plan($qr_plan);
				?>
					<strong> ขอแสดงความยินดี </strong> ได้รับสิทธิ์โควตา แผนการเรียน <?php echo $call_quota->plan_LName;?>
				</div>
			</div>
		</div>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<center><button type="button"  class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_theme_warning">ดำเนินการต่อ <i class="icon-cog4 spinner position-right"></i></button></center>
			</div>
		</div><br>
		<!-- Warning modal -->
			<div class="modal fade" id="modal_theme_warning" role="dialog">
			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$Code41Error="OFF";
			if($Code41Error=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
					<div class="modal-header bg-warning">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">เอกสารประกอบการมอบตัว</h4>
					</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
					<div class="modal-body">
					<form name="rc_quota" method="post" action="./?evaluation_mod=quota">	
		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
				$quota_InternalSaveRights=new PrintSendDocuments($user_login,$next_yaer);
				if($quota_InternalSaveRights->RowArraySendDocuments() && (gettype($quota_InternalSaveRights->RowArraySendDocuments())=='array' || gettype($quota_InternalSaveRights->RowArraySendDocuments())=='object')){
					foreach($quota_InternalSaveRights->RowArraySendDocuments() as $rc=>$InternalSaveRightsRow){ 
						$sd_send_documents=$InternalSaveRightsRow["sd_send_documents"];
						$SdStudentIDCard=$InternalSaveRightsRow["SdStudentIDCard"];
						$SdParentIDCard=$InternalSaveRightsRow["SdParentIDCard"];
						$sd_surrender=$InternalSaveRightsRow["sd_surrender"];
						$sd_financial_documents=$InternalSaveRightsRow["sd_financial_documents"];
					}			
				}else{
					$sd_send_documents="-";
					$SdStudentIDCard="-";
					$SdParentIDCard="-";
					$sd_surrender="-";
					$sd_financial_documents="-";
				}
			?>		
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<div class="modal-body">
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5">
									<b style="color: #00008B"> 
										<div>วิธีการนำส่งการเอกสาร</div>
										<div>ประกอบการมอบตัว (กรุณาเลือก 1 วิธี)</div>
									</b>
								</label>	
				<?php
						if($sd_send_documents=="mail"){ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
								<div class="col-<?php echo $grid;?>-7">
									<div>
										<label class="radio-inline">
											<input type="radio" class="styled" name="sd_send_documents" value="mail" checked="checked" required="required">
											<div>ส่งทาง E-mail</div>
											<div>academic@regina.ac.th</div>
										</label>							
									</div>
									<div>
										<label class="radio-inline">
											<input type="radio" class="file-styled" name="sd_send_documents" value="zip" required="required">
											<div>ส่งทางไปรษณีย์</div>
											<div>(ชื่อและที่อยู่ผู้รับ)</div>
											<div>ฝ่ายวิชาการ โรงเรียนเรยีนาเชลีวิทยาลัย</div>
											<div>เลขที่ 166 ถ.เจริญประเทศ ต.ช้างคลาน อ.เมือง จ.เชียงใหม่ 50100</div>								
										</label>							
									</div>
								</div>					
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->					
				<?php	}elseif($sd_send_documents=="zip"){ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
								<div class="col-<?php echo $grid;?>-7">
									<div>
										<label class="radio-inline">
											<input type="radio" class="styled" name="sd_send_documents" value="mail" required="required">
											<div>ส่งทาง E-mail</div>
											<div>academic@regina.ac.th</div>
										</label>							
									</div>
									<div>
										<label class="radio-inline">
											<input type="radio" class="file-styled" name="sd_send_documents" value="zip" checked="checked" required="required">
											<div>ส่งทางไปรษณีย์ </div>
											<div>(ชื่อและที่อยู่ผู้รับ)</div>
											<div>ฝ่ายวิชาการ โรงเรียนเรยีนาเชลีวิทยาลัย</div>
											<div>เลขที่ 166 ถ.เจริญประเทศ ต.ช้างคลาน อ.เมือง จ.เชียงใหม่ 50100</div>								
										</label>							
									</div>
								</div>					
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->					
				<?php	}else{ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
								<div class="col-<?php echo $grid;?>-7">
									<div>
										<label class="radio-inline">
											<input type="radio" class="styled" name="sd_send_documents" value="mail" required="required">
											<div>ส่งทาง E-mail</div>
											<div>academic@regina.ac.th</div>
										</label>							
									</div>
									<div>
										<label class="radio-inline">
											<input type="radio" class="file-styled" name="sd_send_documents" value="zip" required="required">
											<div>ส่งทางไปรษณีย์</div>
											<div>(ชื่อและที่อยู่ผู้รับ)</div>
											<div>ฝ่ายวิชาการ โรงเรียนเรยีนาเชลีวิทยาลัย</div>
											<div>เลขที่ 166 ถ.เจริญประเทศ ต.ช้างคลาน อ.เมือง จ.เชียงใหม่ 50100</div>								
										</label>							
									</div>
								</div>					
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->					
				<?php	}      ?>	

							</div>
						</fieldset>
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5">
									<b style="color: #00008B"> 
										<div>เอกสารประกอบการมอบตัว</div>
										<div>สแกนการมอบตัวเป็นไฟส์ภาพ (JPG)</div>
									</b>
								</label>					
								<div class="col-<?php echo $grid;?>-7">

		<?php
				if($sd_surrender=="yes"){ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
									<div>
										<label class="checkbox-inline">
											<input type="checkbox" class="file-styled" name="sd_surrender" value="yes" checked="checked">
											<div>ใบมอบตัวนักเรียน</div>
										</label>							
									</div>		
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->					
	    <?php   }else{ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
									<div>
										<label class="checkbox-inline">
											<input type="checkbox" class="file-styled" name="sd_surrender" value="yes">
											<div>ใบมอบตัวนักเรียน</div>
										</label>							
									</div>		
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->					
		<?php	}      ?>

		<?php
				if($SdStudentIDCard=="yes"){ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
									<div>
										<label class="checkbox-inline">
											<input type="checkbox" class="file-styled" name="SdStudentIDCard" value="yes" checked="checked">
											<div>สำเนาบัตรประชาชนนักเรียน จำนวน 1 ฉบับ</div>
										</label>							
									</div>		
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->		
		<?php	}else{ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
									<div>
										<label class="checkbox-inline">
											<input type="checkbox" class="file-styled" name="SdStudentIDCard" value="yes">
											<div>สำเนาบัตรประชาชนนักเรียน จำนวน 1 ฉบับ</div>
										</label>							
									</div>		
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->		
		<?php	}      ?>						
								

		<?php
				if($SdParentIDCard=="yes"){ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
									<div>
										<label class="checkbox-inline">
											<input type="checkbox" class="styled" name="SdParentIDCard" value="yes" checked="checked">
											<div>สำเนาบัตรประชาชนบิดา หรือ มารดา หรือ ผู้ปกครอง จำนวน 1 ฉบับ</div>
										</label>							
									</div>		
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->		
		<?php	}else{ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
									<div>
										<label class="checkbox-inline">
											<input type="checkbox" class="styled" name="SdParentIDCard" value="yes">
											<div>สำเนาบัตรประชาชนบิดา หรือ มารดา หรือ ผู้ปกครอง จำนวน 1 ฉบับ</div>
										</label>							
									</div>	
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->		
		<?php	}      ?>	

		<?php
				if($sd_financial_documents=="yes"){ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
									<div>
										<label class="checkbox-inline">
											<input type="checkbox" class="styled" name="sd_financial_documents" value="yes" checked="checked">
											<div>หลักฐานการชำระเงิน (สลิปโอนเงิน หรือสำเนาใบเสร็จรับเงิน)</div>
										</label>							
									</div>			
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->					
	    <?php   }else{ ?>
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
									<div>
										<label class="checkbox-inline">
											<input type="checkbox" class="styled" name="sd_financial_documents" value="yes">
											<div>หลักฐานการชำระเงิน (สลิปโอนเงิน หรือสำเนาใบเสร็จรับเงิน)</div>
										</label>							
									</div>			
		<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->					
		<?php	}      ?>		
																
								</div>						
							</div>
						</fieldset>			
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<center><button type="submit" class="btn btn-info" name="qr_plan" value="<?php echo $qr_plan;?>">ดำเนินการมอบตัว</button></center>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<center><a href="<?php echo $golink;?>/view/img_user/document/pdf/q2567_41.pdf" target="_blank"><button type="button" class="btn btn-default">ระเบียบและปฏิทินการรับสมัครนักเรียน ม.4</button></a></center>
					</div>
				</div>
			</div>			
		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					</form>			
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
					</div>
				</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
					<div class="modal-header bg-warning">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">มอบตัวนักเรียนโค้วตาภายใน</h4>
					</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
					<div class="modal-body">
<form name="rc_quota" method="post" action="./?evaluation_mod=quota">	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div class="modal-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">
									<center><button type="submit" class="btn btn-info" name="qr_plan" value="<?php echo $qr_plan;?>">ดำเนินการมอบตัว</button></center>
								</div>
							</div>
						</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
</form>			
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
					</div>
				</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
				

			
			</div>
		<!-- /warning modal -->
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<!--<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						<center><div>กำหนดการมอบตัว</div>
						<div>ระดับชั้นมัธยมศึกษาปีที่ 1 และ 4 ปีการศึกษา 2565</div>
						<div>(รอบโควตาภายใน) โรงเรียนเรยีนาเชลีวิทยาลัย</div>
						<div>ระหว่างวันที่ 20 สิงหาคม - 3 กันยายน 2564</div></center>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							  <table class="table table-bordered">
								<tbody>
								  <tr>
									<td><center><strong>ขั้นตอนการมอบตัว</strong></center></td>
									<td><center><strong>สถานที่</strong></center></td>
								  </tr>
								  <tr>
									<td>
										<div>1. กรอกใบมอบตัวในระบบออนไลน์</div>  
									</td>
									<td rowspan="4"><center><div>www.regina.ac.th</div></center></td>
								  </tr>
								  <tr>
									<td>
										<div>2. สมัครสอบห้องเรียน  วิทยาศาสตร์ - คณิตศาสตร์ (สสวท.)</div>  
										<div>(เฉพาะนักเรียน ชั้น ม.1  และ ม.4 (แผนการเรียนวิทย์ - คณิต) ที่มีความประสงค์สมัครสอบ)</div>  
									</td>
								  </tr>
								  <tr>
									<td>
										<div>3. สมัครสอบย้ายแผนการเรียน</div>  
										<div>(เฉพาะนักเรียน ชั้น ม.4 ที่มีความประสงค์สมัครสอบ)</div>  
									</td>
								  </tr>
								  <tr>
									<td>
										<div>4. พิมพ์ใบมอบตัว / ใบสมัครสอบห้องเรียน วิทยาศาสตร์ - คณิตศาสตร์ (สสวท.)</div>  
									</td>
								  </tr>
								  <tr>
									<td>
										<div>5. ชำระเงินค่าธรรมเนียมการเรียน สามารถทำได้ 2 ช่องทาง คือ</div>
									</td>
									<td>&nbsp;</td>
								  </tr>
								  <tr>
									<td><div>&nbsp;&nbsp;ช่องทางที่ 1  ใช้วิธีสแกนคิวอาร์โค้ด (QR Code) ในใบมอบตัวเพื่อชำระเงิน</div></td>
									<td><center><div>Mobile Banking</div></center></td>
								  </tr>
								  <tr>
									<td><div>&nbsp;&nbsp;ช่องทางที่ 2  ชำระเงินสด หรือบัตรเครดิต (ค่าธรรมเนียม 1.7%)</div></td>
									<td><center><div>ห้องการเงิน โรงเรียนเรยีนาเชลีวิทยาลัย</div></center></td>
								  </tr>
								  <tr>
									<td><div>6. นำส่งเอกสารประกอบการมอบตัว (ตามวิธีที่เลือกไว้ในระบบ) มีดังนี้ </div></td>
									<td rowspan="5">
										<div>-&nbsp;ส่งทาง E-mail</div>
										<div>&nbsp;&nbsp;academic@regina.ac.th</div>
										<hr>
										<div>-&nbsp;ส่งทางไปรษณีย์ </div>
										<div>&nbsp;&nbsp;(ชื่อและที่อยู่ผู้รับ)</div>
										<div>&nbsp;&nbsp;ฝ่ายวิชาการ โรงเรียนเรยีนาเชลีวิทยาลัย</div>
										<div>&nbsp;&nbsp;เลขที่ 166 ถ.เจริญประเทศ ต.ช้างคลาน อ.เมือง จ.เชียงใหม่ 50100</div>									
									</td>
								  </tr>
								  <tr>
									<td><div>- ใบมอบตัวนักเรียน</div></td>
								  </tr>
								  <tr>
									<td><div>- สำเนาบัตรประชาชนของนักเรียน                             จำนวน 1 ฉบับ</div></td>
								  </tr>
								  <tr>
									<td><div>- สำเนาบัตรประชาชนของบิดา หรือมารดา หรือผู้ปกครอง            จำนวน 1 ฉบับ</div></td>
								  </tr>
								  <tr>
									<td><div>- หลักฐานการชำระเงิน (สลิปโอนเงิน หรือสำเนาใบเสร็จรับเงิน)</div></td>
								  </tr>
								</tbody>
							  </table>
						</div>			
					</div>
				</div>	
			</div>
		</div>-->					
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php		}else{ ?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-warning">
					<strong>ไม่พบข้อมูล </strong> กรุณาติดต่อฝ่ายวิชาการ  โทรศัพท์ 053-282395 ต่อ 121 หรือ 122 (ในวันและเวลาราชการ) 
				</div>	
			</div>
		</div>					
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php		}
				}
			}?>
			
		<!---->
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	} ?>
				
		<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<?php			
				break;
				default: ?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-danger">
					ไม่มีสิทธิ์เข้าถึงหน้านี้ 
				</div>		
			</div>
		</div>	
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php } ?>
<!--##########################################################-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	}      ?> 
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->   	   


