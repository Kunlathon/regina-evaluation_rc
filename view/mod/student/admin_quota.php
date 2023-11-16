<?php
	include("view/database/pdo_quota.php");
	include("view/database/pdo_data.php");
	include("view/database/class_quota.php");
	error_reporting(error_reporting() & ~E_NOTICE); 
	
	$qr_plan=filter_input(INPUT_GET,'qr_plan');
	$studentid=filter_input(INPUT_GET,'studentid');
	$qr_plan=base64_decode($qr_plan);
	$studentid=base64_decode($studentid);

	if($qr_plan=="" and $studentid==""){
		exit("<script>window.location='./?evaluation_mod=quota_show';</script>");
	}elseif($qr_plan=="" or $studentid==""){
		exit("<script>window.location='./?evaluation_mod=quota_show';</script>");
	}else{?>
<!------------------------------------------------------------>	
<?php
//+++++++++++++++++++++++++++++++++++++++++++*****************
	$data_yaer=2563;
	//$studentid;
	//********************************************************
	$next_yaer=2564;
	//********************************************************
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
//ข้อมูลนักเรียน 
	$call_sturc=new regina_stu_data($studentid);
//ระดับชั้น
	$call_stu=new stu_levelpdo($studentid,$data_yaer,"1");	
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	
		/*include("view/function/strlen.php"); 
	
		$datetime="2020-03-06 24:59:00";
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
				<h4><span class="text-semibold">นักเรียนได้รับสิทธิ์โควตาภายใน ปีการศึกษา <?php echo $next_yaer;?></span></h4>
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

<?php
	switch ($call_stu->IDLevel){
		case "23": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php 
		$quota_transfer_testSql="SELECT count(`qtt_key`) as `count_qtt` FROM `quota_transfer_test` WHERE`qtt_key`='{$qr_plan}'";
		$quota_transfer_test=new row_quotanotarray($quota_transfer_testSql);
		foreach($quota_transfer_test->print_quotanotarray() as $quota=>$quota_transfer_testRow){
			$count_qtt=$quota_transfer_testRow["count_qtt"];
			if($count_qtt>=1){ 
			
				$keep_quota_requestSql="SELECT `qce_key` FROM `quota_request`
								        WHERE `request_stuid`='{$studentid}' 
										and `request_year`='{$next_yaer}' 
										and `request_level`='31'";
				$keep_quota_request=new row_quotanotarray($keep_quota_requestSql);
				foreach($keep_quota_request->print_quotanotarray() as $quota=>$keep_quota_requestRow){
					$keep_qce_key=$keep_quota_requestRow["qce_key"];
				}
			
			?>
<!--////////////////////////////////////////////////////////-->	
<form name="quota" method="post" action="view/mod/student/code/rc_quota/print_quota.php" target="_blank">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-success">
			<div class="row">
				<div class="col-<?php echo $grid;?>-4"><h5>นักเรียนที่ประสงค์สมัครสอบย้ายห้องเรียน</h5></div>
				<div class="col-<?php echo $grid;?>-8">
					<div class="form-group">
						<select data-placeholder="เลือกแผนห้องเรียน..." class="select" name="qce_key">
							<option></option>
							
					<?php
						if($keep_qce_key==""){ ?>
<!--*******************************************************************************************************************************-->						
								<option value="NO">ไม่ประสงค์สมัครสอบย้ายห้องเรียน</option>
					<?php
						$quota_choose_examSql="SELECT `qce_key`, `qtt_key` FROM `quota_choose_exam` WHERE `qtt_key`='{$qr_plan}';";
						$quota_choose_exam=new row_quotaarray($quota_choose_examSql);
						foreach($quota_choose_exam->print_quotaarray() as $quota_key=>$quota_choose_examRow){
							$qce_key=$quota_choose_examRow["qce_key"];
							$call_plan=new print_plan($qce_key); ?>

							    <option value="<?php echo $qce_key;?>"><?php echo $call_plan->plan_Name;?></option>
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
								$selected_plan="";
							}

							?>

							    <option value="<?php echo $qce_key;?>" <?php echo $selected_plan;?>><?php echo $call_plan->plan_Name;?></option>
				<?php	}  ?>						
<!--*******************************************************************************************************************************-->						
				<?php	}?>		
		
								
						</select>
					</div>				
				
				</div>
			</div>


			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<button type="submit" class="btn btn-success" name="request_stuid" value="<?php echo $studentid;?>" >บันทึกและพิมพ์ใบมอบตัว</button>
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
<form name="quota" method="post" action="view/mod/student/code/rc_quota/print_quota.php" target="_blank">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-success">

			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<center><button type="submit" class="btn btn-success" name="request_stuid" value="<?php echo $studentid;?>" >บันทึกและพิมพ์ใบมอบตัว</button></center>
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
</form>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php		
		break;
		case "33": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php 
		$quota_transfer_testSql="SELECT count(`qtt_key`) as `count_qtt` FROM `quota_transfer_test` WHERE`qtt_key`='{$qr_plan}'";
		$quota_transfer_test=new row_quotanotarray($quota_transfer_testSql);
		foreach($quota_transfer_test->print_quotanotarray() as $quota=>$quota_transfer_testRow){
			$count_qtt=$quota_transfer_testRow["count_qtt"];
			if($count_qtt>=1){ 
			
				$keep_quota_requestSql="SELECT `qce_key` FROM `quota_request`
								        WHERE `request_stuid`='{$studentid}' 
										and `request_year`='{$next_yaer}' 
										and `request_level`='41'";
				$keep_quota_request=new row_quotanotarray($keep_quota_requestSql);
				foreach($keep_quota_request->print_quotanotarray() as $quota=>$keep_quota_requestRow){
					$keep_qce_key=$keep_quota_requestRow["qce_key"];
				}
			
			?>
<!--////////////////////////////////////////////////////////-->	
<form name="quota" method="post" action="view/mod/student/code/rc_quota/print_quota.php" target="_blank">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-success">
			<div class="row">
				<div class="col-<?php echo $grid;?>-4"><h5>นักเรียนที่ประสงค์สมัครสอบย้ายแผนการเรียน</h5></div>
				<div class="col-<?php echo $grid;?>-8">
					<div class="form-group">
						<select data-placeholder="เลือกแผนการเรียน..." class="select" name="qce_key">
							<option></option>
							
					<?php
						if($keep_qce_key==""){ ?>
<!--*******************************************************************************************************************************-->						
								<option value="NO">ไม่ประสงค์สมัครสอบย้ายแผนการเรียน</option>
					<?php
						$quota_choose_examSql="SELECT `qce_key`, `qtt_key` FROM `quota_choose_exam` WHERE `qtt_key`='{$qr_plan}';";
						$quota_choose_exam=new row_quotaarray($quota_choose_examSql);
						foreach($quota_choose_exam->print_quotaarray() as $quota_key=>$quota_choose_examRow){
							$qce_key=$quota_choose_examRow["qce_key"];
							$call_plan=new print_plan($qce_key); ?>

							    <option value="<?php echo $qce_key;?>"><?php echo $call_plan->plan_Name." (".$call_plan->plan_LName.")";?></option>
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
								$selected_plan="";
							}

							?>

							    <option value="<?php echo $qce_key;?>" <?php echo $selected_plan;?>><?php echo $call_plan->plan_Name." (".$call_plan->plan_LName.")";?></option>
				<?php	}  ?>						
<!--*******************************************************************************************************************************-->						
				<?php	}?>		
		
								
						</select>
					</div>				
				
				</div>
			</div>


			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<center><button type="submit" class="btn btn-success" name="request_stuid" value="<?php echo $studentid;?>" >บันทึกและพิมพ์ใบมอบตัว</button></center>
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
<form name="quota" method="post" action="view/mod/student/code/rc_quota/print_quota.php" target="_blank">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-success">

			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<button type="submit" class="btn btn-success" name="request_stuid" value="<?php echo $studentid;?>" >บันทึกและพิมพ์ใบมอบตัว</button>
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
</form>
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
<!------------------------------------------------------------>		
<?php	} ?>


