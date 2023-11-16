<?php
	include("view/database/pdo_quota.php");
	include("view/database/pdo_data.php");
	include("view/database/class_quota.php");
	error_reporting(error_reporting() & ~E_NOTICE); 
	
	$qr_plan=filter_input(INPUT_POST,'qr_plan');
	if($qr_plan==""){
		exit("<script>window.location='./?evaluation_mod=rc_quota';</script>");
	}else{?>
<!------------------------------------------------------------>	
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
	
		//$datetime="2021-10-06 24:00:00";
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
					<div>หากผู้ปกครองดำเนินการกรอกข้อมูล จะถือว่าดำเนินการไม่สำเร็จ (สามารถตรวจสอบได้ในวันที่ 17 สิงหาคม 2564 เวลา 8.00 น.)</div>
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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<?php
	switch ($call_stu->IDLevel){
		case "23": ?>
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
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
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->	
<?php
	switch($print_runtime){
		case "OFF": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger">
			ระบบโควตาภายใน สิ้นสุดระยะเวลาดำเนินการแล้วในขณะนี้ ท่านผู้ปกครองหรือนักเรียนต้องการ ดำเนินการมอบตัวโควตาภายใน  กรุณาติตต่อฝ่ายวิชาการ  โทรศัพท์ 053-282395 ต่อ 121 หรือ 122 (ในวันและเวลาราชการ) 
		</div>		
	</div>
</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	break;	
		default: ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php 
//-----------------------------------------------------------------------------------------------
	$sd_send_documents=filter_input(INPUT_POST,'sd_send_documents');
	$SdStudentIDCard=filter_input(INPUT_POST,'SdStudentIDCard');
		if(isset($SdStudentIDCard)){
			$SdStudentIDCard;
		}else{
			$SdStudentIDCard="no";
		}
//-----------------------------------------------------------------------------------------------		
	$SdParentIDCard=filter_input(INPUT_POST,'SdParentIDCard');
		if(isset($SdParentIDCard)){
			$SdParentIDCard;
		}else{
			$SdParentIDCard="no";
		}
//-----------------------------------------------------------------------------------------------
	$sd_surrender=filter_input(INPUT_POST,'sd_surrender');
		if(isset($sd_surrender)){
			$sd_surrender;
		}else{
			$sd_surrender="no";
		}
//-----------------------------------------------------------------------------------------------
	$sd_financial_documents=filter_input(INPUT_POST,'sd_financial_documents');
		if(isset($sd_financial_documents)){
			$sd_financial_documents;
		}else{
			$sd_financial_documents="no";
		}		
//-----------------------------------------------------------------------------------------------		
	$InUpSendDocuments=new InUpSendDocuments($user_login,$next_yaer,$sd_send_documents,$SdStudentIDCard,$SdParentIDCard,$sd_surrender,$sd_financial_documents);
//-----------------------------------------------------------------------------------------------
	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php 
		$quota_transfer_testSql="SELECT count(`qtt_key`) as `count_qtt` FROM `quota_transfer_test` WHERE`qtt_key`='{$qr_plan}'";
		$quota_transfer_test=new row_quotanotarray($quota_transfer_testSql);
		foreach($quota_transfer_test->print_quotanotarray() as $quota=>$quota_transfer_testRow){
			$count_qtt=$quota_transfer_testRow["count_qtt"];
			if($count_qtt>=1){ 
			
				$keep_quota_requestSql="SELECT `qce_key` FROM `quota_request`
								        WHERE `request_stuid`='{$user_login}' 
										and `request_year`='{$next_yaer}' 
										and `request_level`='31'";
				$keep_quota_request=new row_quotanotarray($keep_quota_requestSql);
				
					if(isset($keep_quota_request)){
						foreach($keep_quota_request->print_quotanotarray() as $quota=>$keep_quota_requestRow){
							$keep_qce_key=$keep_quota_requestRow["qce_key"];
						}						
					}else{
						$keep_qce_key="-";
					}
			?>
<!--////////////////////////////////////////////////////////-->	
<form name="quota" method="post" action="<?php echo $golink;?>/quota_print/print_quota/<?php echo $data_yaer;?>/<?php echo $user_login;?>" target="_blank">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-success">
			<div class="row">
				<div class="col-<?php echo $grid;?>-4"><h5>นักเรียนมีความประสงค์สมัครสอบย้ายห้องเรียน</h5></div>
				<div class="col-<?php echo $grid;?>-8">
					<div class="form-group">
						<select data-placeholder="เลือกห้องเรียน..." class="select" name="qce_key">
							<option></option>
							
					<?php
						if($keep_qce_key==null or $keep_qce_key=="-"){ ?>
<!--*******************************************************************************************************************************-->						
								<option value="NO">ไม่ประสงค์สมัครสอบย้ายห้องเรียน</option>
					<?php
						$quota_choose_examSql="SELECT `qce_key`, `qtt_key` FROM `quota_choose_exam` WHERE `qtt_key`='{$qr_plan}';";
						$quota_choose_exam=new row_quotaarray($quota_choose_examSql);
						foreach($quota_choose_exam->print_quotaarray() as $quota_key=>$quota_choose_examRow){
							$qce_key=$quota_choose_examRow["qce_key"];
							$call_plan=new print_plan($qce_key); ?>

							    <option value="<?php echo $qce_key;?>"><?php echo $call_plan->plan_LName;?></option>
				<?php	}  ?>						
<!--*******************************************************************************************************************************-->								
				<?php	}else{ ?>
<!--*******************************************************************************************************************************-->						
								<option value="NO">ไม่ประสงค์สมัครสอบย้ายห้องเรียน</option>
					<?php
						$quota_choose_examSql="SELECT `qce_key`, `qtt_key` FROM `quota_choose_exam` WHERE `qtt_key`='{$qr_plan}';";
						$quota_choose_exam=new row_quotaarray($quota_choose_examSql);
						foreach($quota_choose_exam->print_quotaarray() as $quota_key=>$quota_choose_examRow){
							$qce_key=$quota_choose_examRow["qce_key"];
							$call_plan=new print_plan($qce_key); 
							if($keep_qce_key==$quota_choose_examRow["qce_key"]){
								$selected_plan="selected";
							}else{
								$selected_plan=null;
							}

							?>

							    <option value="<?php echo $qce_key;?>" <?php echo $selected_plan;?>><?php echo $call_plan->plan_LName;?></option>
				<?php	}  ?>						
<!--*******************************************************************************************************************************-->						
				<?php	}?>		
						</select>
					</div>				
				
				</div>
			</div>


			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<button type="submit" class="btn btn-success" name="request_stuid" value="<?php echo $user_login;?>" >บันทึกและพิมพ์ใบมอบตัว</button>
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<button type="button" class="btn btn-danger" id="goto">ประกาศผล / มอบตัว นักเรียน ได้รับสิทธิ์โควตาภายใน</button>				
				</div>
			</div>
					<input type="hidden" name="qr_plan" value="<?php echo $qr_plan;?>">

		</div>
	</div>
</div><br>		


</form>	
<!--////////////////////////////////////////////////////////-->	
<?php		}else{ ?>
<!--////////////////////////////////////////////////////////-->	
<form name="quota" method="post" action="<?php echo $golink;?>/quota_print/print_quota/<?php echo $data_yaer;?>/<?php echo $user_login;?>" target="_blank">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-success">

			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<center><button type="submit" class="btn btn-success" name="request_stuid" value="<?php echo $user_login;?>" >บันทึกและพิมพ์ใบมอบตัว</button></center>
				</div>
			</div>
					<input type="hidden" name="qr_plan" value="<?php echo $qr_plan;?>">
					<input type="hidden" name="qce_key" value="NO">
		</div>
	</div>
</div><br>		
</form>	
<!--////////////////////////////////////////////////////////-->					
	<?php	}
		}
	?>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php	} ?>	
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->		
		
		
		
		
<?php		
		break;
		case "33": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\//-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->	
<?php
	switch($print_runtime){
		case "OFF": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger">
			ระบบโควตาภายใน สิ้นสุดระยะเวลาดำเนินการแล้วในขณะนี้ ท่านผู้ปกครองหรือนักเรียนต้องการ ดำเนินการมอบตัวโควตาภายใน  กรุณาติตต่อฝ่ายวิชาการ  โทรศัพท์ 053-282395 ต่อ 121 หรือ 122 (ในวันและเวลาราชการ)  
		</div>		
	</div>
</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	break;	
		default: ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php 
//-----------------------------------------------------------------------------------------------
	$sd_send_documents=filter_input(INPUT_POST,'sd_send_documents');
	$SdStudentIDCard=filter_input(INPUT_POST,'SdStudentIDCard');
		if(isset($SdStudentIDCard)){
			$SdStudentIDCard;
		}else{
			$SdStudentIDCard="no";
		}
//-----------------------------------------------------------------------------------------------		
	$SdParentIDCard=filter_input(INPUT_POST,'SdParentIDCard');
		if(isset($SdParentIDCard)){
			$SdParentIDCard;
		}else{
			$SdParentIDCard="no";
		}
//-----------------------------------------------------------------------------------------------
	$sd_surrender=filter_input(INPUT_POST,'sd_surrender');
		if(isset($sd_surrender)){
			$sd_surrender;
		}else{
			$sd_surrender="no";
		}
//-----------------------------------------------------------------------------------------------
	$sd_financial_documents=filter_input(INPUT_POST,'sd_financial_documents');
		if(isset($sd_financial_documents)){
			$sd_financial_documents;
		}else{
			$sd_financial_documents="no";
		}		
//-----------------------------------------------------------------------------------------------		
		
		
	$InUpSendDocuments=new InUpSendDocuments($user_login,$next_yaer,$sd_send_documents,$SdStudentIDCard,$SdParentIDCard,$sd_surrender,$sd_financial_documents);
//-----------------------------------------------------------------------------------------------
	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php 
		$quota_transfer_testSql="SELECT count(`qtt_key`) as `count_qtt` FROM `quota_transfer_test` WHERE`qtt_key`='{$qr_plan}'";
		$quota_transfer_test=new row_quotanotarray($quota_transfer_testSql);
		foreach($quota_transfer_test->print_quotanotarray() as $quota=>$quota_transfer_testRow){
			$count_qtt=$quota_transfer_testRow["count_qtt"];
			if($count_qtt>=1){ 
			
				$keep_quota_requestSql="SELECT `qce_key` FROM `quota_request`
								        WHERE `request_stuid`='{$user_login}' 
										and `request_year`='{$next_yaer}' 
										and `request_level`='41'";
				$keep_quota_request=new row_quotanotarray($keep_quota_requestSql);
					if(isset($keep_quota_request)){
						foreach($keep_quota_request->print_quotanotarray() as $quota=>$keep_quota_requestRow){
							$keep_qce_key=$keep_quota_requestRow["qce_key"];
						}						
					}else{
						$keep_qce_key="-";
					}
			?>
<!--////////////////////////////////////////////////////////-->	
<form name="quota" method="post" action="<?php echo $golink;?>/quota_print/print_quota/<?php echo $data_yaer;?>/<?php echo $user_login;?>" target="_blank">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-success">
			<div class="row">
				<div class="col-<?php echo $grid;?>-4"><h5>นักเรียนมีความประสงค์สมัครสอบย้ายแผนการเรียน</h5></div>
				<div class="col-<?php echo $grid;?>-8">
					<div class="form-group">
						<select data-placeholder="เลือกแผนการเรียน..." class="select" name="qce_key">
							<option></option>
							
					<?php
						if($keep_qce_key==null or $keep_qce_key=="-"){ ?>
<!--*******************************************************************************************************************************-->						
								<option value="NO">ไม่ประสงค์สมัครสอบย้ายแผนการเรียน</option>
					<?php
						$quota_choose_examSql="SELECT `qce_key`, `qtt_key` FROM `quota_choose_exam` WHERE `qtt_key`='{$qr_plan}';";
						$quota_choose_exam=new row_quotaarray($quota_choose_examSql);
						foreach($quota_choose_exam->print_quotaarray() as $quota_key=>$quota_choose_examRow){
							$qce_key=$quota_choose_examRow["qce_key"];
							$call_plan=new print_plan($qce_key); ?>

							    <option value="<?php echo $qce_key;?>"><?php echo $call_plan->plan_LName;?></option>
				<?php	}  ?>						
<!--*******************************************************************************************************************************-->								
				<?php	}else{ ?>
<!--*******************************************************************************************************************************-->						
								<option value="NO">ไม่ประสงค์สมัครสอบย้ายแผนการเรียน</option>
					<?php
						$quota_choose_examSql="SELECT `qce_key`, `qtt_key` FROM `quota_choose_exam` WHERE `qtt_key`='{$qr_plan}';";
						$quota_choose_exam=new row_quotaarray($quota_choose_examSql);
						foreach($quota_choose_exam->print_quotaarray() as $quota_key=>$quota_choose_examRow){
							$qce_key=$quota_choose_examRow["qce_key"];
							$call_plan=new print_plan($qce_key); 
							if($keep_qce_key==$quota_choose_examRow["qce_key"]){
								$selected_plan="selected";
							}else{
								$selected_plan=null;
							}

							?>

							    <option value="<?php echo $qce_key;?>" <?php echo $selected_plan;?>><?php echo $call_plan->plan_LName;?></option>
				<?php	}  ?>						
<!--*******************************************************************************************************************************-->						
				<?php	}?>		
		
								
						</select>
					</div>				
				
				</div>
			</div>


			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<center><button type="submit" class="btn btn-success" name="request_stuid" value="<?php echo $user_login;?>" >บันทึกและพิมพ์ใบมอบตัว</button></center>
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<button type="button" class="btn btn-danger" id="goto">ประกาศผล / มอบตัว นักเรียน ได้รับสิทธิ์โควตาภายใน</button>				
				</div>
			</div>
					<input type="hidden" name="qr_plan" value="<?php echo $qr_plan;?>">

		</div>
	</div>
</div><br>		
</form>	
<!--////////////////////////////////////////////////////////-->	
<?php		}else{ ?>
<!--////////////////////////////////////////////////////////-->	
<form name="quota" method="post" action="<?php echo $golink;?>/quota_print/print_quota/<?php echo $data_yaer;?>/<?php echo $user_login;?>" target="_blank">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-success">

			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<button type="submit" class="btn btn-success" name="request_stuid" value="<?php echo $user_login;?>" >บันทึกและพิมพ์ใบมอบตัว</button>
				</div>
			</div>
					<input type="hidden" name="qr_plan" value="<?php echo $qr_plan;?>">
					<input type="hidden" name="qce_key" value="NO">
		</div>
	</div>
</div><br>		
</form>	
<!--////////////////////////////////////////////////////////-->					
	<?php	}
		}
	?>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php	}?>	
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\//-->	
	
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
<!---------------------------------------------------------------------------------------------->		
<?php	} ?>


