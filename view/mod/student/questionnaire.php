<?php
	$data_yaer=2564;
	$data_term=1;

	$user_login;

?>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4><span class="text-semibold">ประเมินความพึงพอใจ การใช้งานระบบประเมินของนักเรียน โรงเรียนเรยีนาเชลีวิทยาลัย </span></h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="#" class="btn btn-link  text-size-small"><span>ประเมินความพึงพอใจ การใช้งานระบบประเมินของนักเรียน โรงเรียนเรยีนาเชลีวิทยาลัย</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<?php
	//ตรวจสอบสถานะการเข้าใช้งาน 
	$regina_stu_class="SELECT `rsc_roomid`,`rsc_year`,`rsc_term`,`rsc_plan`,`rsc_class`,`rsc_room`,`rsc_num` 
					   FROM `regina_stu_class` 
					   WHERE `rsc_year`='{$data_yaer}' and 
					         `rsc_term`='{$data_term}' and 
							 `rsd_studentid`='{$user_login}';";
	$regina_stu_classRs=$evaluation_sql->query($regina_stu_class) or die($evaluation_sql->error);
	
	if($regina_stu_classRs->num_rows > 0){
		$regina_stu_classRow=$regina_stu_classRs->fetch_assoc();
		$rsc_plan=$regina_stu_classRow["rsc_plan"];
		$rsc_class=$regina_stu_classRow["rsc_class"];
		$rsc_room=$regina_stu_classRow["rsc_room"];
		$rsc_num=$regina_stu_classRow["rsc_num"];
	}else{ 
		$system_error1="error";
	}  ?>

<?php
	//กำหนดให้เข้าได้เฉราะ ป4-ม6
	if($rsc_class>=11 and $rsc_class<=13){
		$txt_class=0;
	}elseif($rsc_class>=21 and $rsc_class<=23){
		$txt_class=0;
	}elseif($rsc_class>=31 and $rsc_class<=33){
		$txt_class=0;
	}elseif($rsc_class>=41 and $rsc_class<=43){
		$txt_class=0;
	}else{
		$system_error2="error";
	}?>
<?php   error_reporting(error_reporting() & ~E_NOTICE);
		if($system_error1=="error" and $system_error2=="error"){ ?>
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
				<!--<strong>ข้อผิดพลาด ! </strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ เข้าใช้งานได้เฉราะ ป4-ม6 เท่านั้น-->
				<strong>ข้อผิดพลาด ! </strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ 
			</div>			
		</div>
	</div><br>		
<?php	}else{?>
<form name="questionnaire" method="post" action="./?evaluation_mod=questionnaire_code">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-info">
				<div class="panel-heading"><h4>ความพึงพอใจ</h4></div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<th rowspan="2"><center><b>รายการประเมิน</b></center></th>
									<th colspan="5"><center><b>ระดับความพึงพอใจ</b></center></th>
								</tr>
								<tr>
									<td align="center"><b>5</b></td>
									<td align="center"><b>4</b></td>
									<td align="center"><b>3</b></td>
									<td align="center"><b>2</b></td>
									<td align="center"><b>1</b></td>
								</tr>
					<?php
						$questionnaire_caption="SELECT `qc_key`,`qc_txt` FROM `questionnaire_caption` ";
						$questionnaire_captionRs=rc_array($questionnaire_caption);
						$qc_count=1;
						foreach($questionnaire_captionRs as $rc_key=>$questionnaire_captionRow){ ?>
							
					<?php
							if ($questionnaire_captionRow["qc_key"]==6){
							
							}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<tr>
									<td><?php echo $qc_count.".".$questionnaire_captionRow["qc_txt"];?></td>
									<td align="center">
									    <div class="radio icheck-belizehole">
											<input type="radio" name="qsc<?php echo $qc_count;?>" id="belizehole<?php echo $qc_count;?>" value="5">
											<label for="belizehole<?php echo $qc_count;?>"></label>
										</div>
									</td>
									<td align="center">
										<div class="radio icheck-greensea">
											<input type="radio" name="qsc<?php echo $qc_count;?>" id="greensea<?php echo $qc_count;?>" value="4">
											<label for="greensea<?php echo $qc_count;?>"></label>
										</div>									
									</td>
									<td align="center">
										<div class="radio icheck-clouds">
											<input type="radio" name="qsc<?php echo $qc_count;?>" id="clouds<?php echo $qc_count;?>" value="3">
											<label for="clouds<?php echo $qc_count;?>"></label>
										</div>									
									</td>
									<td align="center">
										<div class="radio icheck-pumpkin">
											<input type="radio" name="qsc<?php echo $qc_count;?>" id="pumpkin<?php echo $qc_count;?>" value="2">
											<label for="pumpkin<?php echo $qc_count;?>"></label>
										</div>									
									</td>
									<td align="center">
										<div class="radio icheck-default">
											<input type="radio" name="qsc<?php echo $qc_count;?>" id="default<?php echo $qc_count;?>" value="1">
											<label for="default<?php echo $qc_count;?>"></label>
										</div>									
									</td>
								</tr>						
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
					<?php	} ?>
							
							
							
					<?php	$qc_count=$qc_count+1;} ?>			
								
							</tbody>
						</table>					
					</div>
				</div>
			</div>
		</div>
	</div><br>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading"><h4>ระบบงานอื่นๆ ที่ต้องการให้เพิ่มเติม</h4></div>
				<div class="panel-body"><b>ระบบงานนักเรียน</b></div>
				<div class="panel-body">
					<div class="row">
						<div class="checkbox icheck-silver">
							<input type="checkbox" id="silverA" name="qs1" value="เลือกกิจกรรมชุมนุม">
							<label for="silverA">เลือกกิจกรรมชุมนุม</label>
						</div>
					</div>
					<div class="row">
						<div class="checkbox icheck-silver">
							<input type="checkbox" id="silverB" name="qs2" value="จองสิทธิ์โควต้า นักเรียนชั้น มัธยมศึกษาปีที่ 1 และ มัธยมศึกษาปีที่ 4">
							<label for="silverB">จองสิทธิ์โควต้า นักเรียนชั้น มัธยมศึกษาปีที่ 1 และ มัธยมศึกษาปีที่ 4</label>
						</div>
					</div>					
					<div class="row">
						<div class="checkbox icheck-silver">
							<input type="checkbox" id="silverC" name="qs3" value="ประเมิน">
							<label for="silverC">ประเมิน</label>
						</div>
					</div>
					<div class="row">
						<div class="checkbox icheck-silver">
							<input type="checkbox" id="silverD" name="qs4" value="เปลี่ยนรหัสผ่านเข้าสู่ระบบ">
							<label for="silverD">เปลี่ยนรหัสผ่านเข้าสู่ระบบ</label>
						</div>
					</div>					
					<div class="row">
						<div class="form-group">
							<label>อื่น : </label>
							<textarea name="qs5" rows="5" class="form-control" maxlength="100"></textarea>
						</div>			
					</div>
	
					
				</div>
				<div class="panel-body"><b>ข้อมูลสารสนเทศที่ต้องการให้แสดงผล</b></div>
				<div class="panel-body">
					<div class="row">
						<div class="checkbox icheck-midnightblue">
							<input type="checkbox" id="midnightblueA" name="qsys1" value="ข้อมูลทะเบียนประวัติ">
							<label for="midnightblueA">ข้อมูลทะเบียนประวัติ</label>
						</div>				
					</div>					
					<div class="row">
						<div class="checkbox icheck-midnightblue">
							<input type="checkbox" id="midnightblueB" name="qsys2" value="ข้อมูลเงินออมทรัพย์">
							<label for="midnightblueB">ข้อมูลเงินออมทรัพย์</label>
						</div>				
					</div>					
					<div class="row">
						<div class="checkbox icheck-midnightblue">
							<input type="checkbox" id="midnightblueC" name="qsys3" value="ข้อมูลการการมาเรียน">
							<label for="midnightblueC">ข้อมูลการการมาเรียน</label>
						</div>				
					</div>					
					<div class="row">
						<div class="checkbox icheck-midnightblue">
							<input type="checkbox" id="midnightblueD" name="qsys4" value="ข้อมูลผลการเรียน">
							<label for="midnightblueD">ข้อมูลผลการเรียน</label>
						</div>				
					</div>
					<div class="row">
						<div class="form-group">
							<label>อื่น : </label>
							<textarea name="qsys5" rows="5" class="form-control" maxlength="100"></textarea>
						</div>			
					</div>
				</div>
				<div class="panel-body"><b>ข้อเสนอแนะ อื่น ๆ</b></div>
				<div class="panel-body">
					<div class="form-group">
						<textarea name="ques_txt" rows="5" class="form-control" maxlength="1000"></textarea>
					</div>
				</div>
			</div>
		</div>
	</div><br>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<center>
				<button type="submit" class="btn btn-success">ส่งแบบประเมิน</button>
				<button type="reset" class="btn btn-info">ล้างข้อมูล</button>
			</center>
		</div>
	</div>
</form>	
<?php   }  ?>
