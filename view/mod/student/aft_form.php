<?php
	$data_yaer=2562;
	$data_term=2;

	$user_login;
	
	$datetime="2020-03-06 24:59:00";
	$datetime_cr=date("Y-m-d H:i:s");
	$datatime_notrun=strtotime($datetime);
	$datatime_run=strtotime($datetime_cr);
		
		if($datatime_run>=$datatime_notrun){
			$print_runtime="OFF";
		}else{
			$print_runtime="ON";
		}
?>

<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4><span class="text-semibold">ประเมินความพึงพอใจการจัดการเรียนการสอน <?php echo $data_term."/".$data_yaer;?></span></h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=aft_course" class="btn btn-link  text-size-small"><span>ประเมินความพึงพอใจการจัดการเรียนการสอน</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=aft_form" class="btn btn-link  text-size-small"><span>แบบประเมินความพึงพอใจ</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<?php
		if($print_runtime=="ON"){ ?>
<!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
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
	if($rsc_class>=21 and $rsc_class<=23){
		$txt_type=1;
		$txt_term=0;
		$button_code="btn bg-purple-300 btn-block btn-float btn-float-lg";
	}elseif($rsc_class>=31 and $rsc_class<=33){
		if($data_term==1){
			$txt_type=2;
			$txt_term=1;			
		}else{
			$txt_type=2;
			$txt_term=2;			
		}
		$button_code="btn bg-warning-400 btn-block btn-float btn-float-lg";
	}elseif($rsc_class>=41 and $rsc_class<=43){
		if($data_term==1){
			$txt_type=2;
			$txt_term=1;			
		}else{
			$txt_type=2;
			$txt_term=2;			
		}
		$button_code="btn bg-warning-400 btn-block btn-float btn-float-lg";
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
				<strong>ข้อผิดพลาด ! </strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ เข้าใช้งานได้เฉราะ ป4-ม6 เท่านั้น
			</div>			
		</div>
	</div><br>		
<?php	}elseif($system_error2=="error"){ ?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ เข้าใช้งานได้เฉราะ ป4-ม6 เท่านั้น
			</div>			
		</div>
	</div><br>		
<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<?php
	$data_subject=post_data($_POST["data_subject"]);
	$data_teacher=post_data($_POST["data_teacher"]);
	
	if($data_subject=="" and $data_teacher==""){ ?>
<!--*****************************************************************************-->	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong>ข้อมูลไม่ถูกต้อง
			</div>			
		</div>
	</div><br>	
<!--*****************************************************************************-->		
<?php	}elseif($data_subject=="" or $data_teacher==""){ ?>
<!--*****************************************************************************-->	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong>ข้อมูลไม่ถูกต้อง
			</div>			
		</div>
	</div><br>	
<!--*****************************************************************************-->		
<?php	}else{ 
			$subject="select `rc_subject_$data_yaer`.`IDSubject`,`rc_subject_$data_yaer`.`Name` as subjectname ,`rc_subject_$data_yaer`.`EName` as `subjectEname` ,`rc_saragroup`.`Name` as `saragroupname` from `rc_subject_$data_yaer` join `rc_saragroup` on (`rc_subject_$data_yaer`.`IDsaraGroup`=`rc_saragroup`.`IDsaraGroup`)
					  WHERE `rc_subject_$data_yaer`.`IDSubject`='{$data_subject}'";
			$subject_rs=rc_data($subject);

			foreach($subject_rs as $rc_key=>$subject_row){
				$subjectname=$subject_row["subjectname"];
				$subjectEname=$subject_row["subjectEname"];
				if($subjectEname==""){
					$subjectEname="";
				}else{
					$subjectEname=' ('.$subjectEname.')';
				}
				$saragroupname=$subject_row["saragroupname"];
			}
?>
<!--*****************************************************************************-->	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading"><center><h5><div id="demo"></div></h5></center></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-success">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-3 col-md-3 col-lg-3">	
							<div class="imgBox"><img src="view/t/<?php echo $data_teacher; ?>.jpg" class="img-thumbnail" alt="Cinque Terre" style="width: 210px; height: 267px;" data-origin="view/t/<?php echo $data_teacher; ?>.jpg"></div>			
						</div>
						<div class="col-sm-8 col-md-8 col-lg-8">
						
					<?php
							$name_te="select `rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName` from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`)
									  where `rc_person`.`IDTeacher`='{$data_teacher}'";
							$name_teRs=rc_data($name_te);
							foreach($name_teRs as $rc_key=>$name_teRow){
								$myname_te=$name_teRow["prefixname"]." ".$name_teRow["FName"]." ".$name_teRow["SName"];
							}
								if($myname_te==""){
									$myname_te="ไม่พบข้อมูล";
								}else{
									$myname_te;
								}  
					?>						
					
							<p><h5><?php echo "ชื่อ-สกุล : ".$myname_te; ?></h5></p>
							<p><h5>สอนวิชา : <?php echo $subjectname.$subjectEname;?></h5></p>
							<p><h5>กลุ่ม : <?php echo $saragroupname;?></h5></p>
						</div>					
					</div>
				</div>
				<div class="panel-body">
	<form name="aft_form" method="post" action="./?evaluation_mod=aft_form_code" >			
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th rowspan="2"><center>ประเมินความพึงพอใจ</center></th>
									<th colspan="5"><center>คะแนน</center></th>
								</tr>
								<tr>
									<th>5</th>
									<th>4</th>
									<th>3</th>
									<th>2</th>
									<th>1</th>
								</tr>
							</thead>
							<tbody>
							
				<?php
					$evaluation_content="SELECT `ec_id`,`ec_txt` FROM `evaluation_content` WHERE `ec_status`='1'  
										 ORDER BY `evaluation_content`.`ec_sort`  ASC";
					$evaluation_contentRs=rc_array($evaluation_content);
						$ec_count=1;
					foreach($evaluation_contentRs as $rc_key=>$evaluation_contentRow){ ?>
								<tr>
									<td colspan="6"><b><?php echo $evaluation_contentRow["ec_txt"];?></b></td>
								</tr>
					<?php
					$evaluation_subject="SELECT `es_id`,`es_txt` FROM `evaluation_subject` WHERE `ec_id`='{$evaluation_contentRow["ec_id"]}'";
							$evaluation_subjectRs=rc_array($evaluation_subject);
									$es_count=1;
							foreach($evaluation_subjectRs as $rc_key=>$evaluation_subjectRow){ ?>
								<tr>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $evaluation_subjectRow["es_txt"];?></td>
									<td>
										<div class="radio icheck-info">
											<input type="radio" id="info<?php echo $es_count.$ec_count."a";?>" name="<?php echo $evaluation_subjectRow["es_id"];?>" value="5" required />
											<label for="info<?php echo $es_count.$ec_count."a";?>">5</label>
										</div>
									</td>
									<td>
										<div class="radio icheck-emerland">
											<input type="radio" id="emerland<?php echo $es_count.$ec_count."b";?>" name="<?php echo $evaluation_subjectRow["es_id"];?>" value="4" required />
											<label for="emerland<?php echo $es_count.$ec_count."b";?>">4</label>
										</div>									
									</td>
									<td>
										<div class="radio icheck-default">
											<input type="radio" id="default<?php echo $es_count.$ec_count."c";?>" name="<?php echo $evaluation_subjectRow["es_id"];?>" value="3" required />
											<label for="default<?php echo $es_count.$ec_count."c";?>">3</label>
										</div>									
									</td>
									<td>
										<div class="radio icheck-primary">
											<input type="radio" id="primary<?php echo $es_count.$ec_count."d";?>" name="<?php echo $evaluation_subjectRow["es_id"];?>" value="2" required />
											<label for="primary<?php echo $es_count.$ec_count."d";?>">2</label>
										</div>									
									</td>
									<td>
										<div class="radio icheck-turquoise">
											<input type="radio" id="turquoise<?php echo $es_count.$ec_count."e";?>" name="<?php echo $evaluation_subjectRow["es_id"];?>" value="1" required />
											<label for="turquoise<?php echo $es_count.$ec_count."e";?>">1</label>
										</div>									
									</td>
								</tr>							
					<?php	$es_count++;} ?>		
			<?php	$ec_count++;}   ?>			
							</tbody>
						</table>
					</div>
				</div>				
				<div class="panel-body">		
	<?php
			$evaluation_oeq="SELECT `evaluation_oeqid`,`evaluation_oeqtxt` FROM `evaluation_oeq`";
			$evaluation_oeqRs=rc_array($evaluation_oeq);
			
			foreach($evaluation_oeqRs as $rc_key=>$evaluation_oeqRow){ ?>
					<div class="form-group">
						<label class="control-label col-sm-4 col-md-4 col-lg-4"><?php echo $evaluation_oeqRow["evaluation_oeqtxt"];?></label>
						<div class="col-sm-8 col-md-8 col-lg-8">
							<textarea name="<?php echo $evaluation_oeqRow["evaluation_oeqid"];?>" id="<?php echo $evaluation_oeqRow["evaluation_oeqid"];?>" rows="5" cols="5" maxlength="1000" minlength="4" required class="form-control" placeholder="<?php echo $evaluation_oeqRow["evaluation_oeqtxt"];?>"></textarea>
							<span id="print_<?php echo $evaluation_oeqRow["evaluation_oeqid"];?>"></span>
						</div>
					</div>		




					
	<?php		} ?>	
	
				</div>
			<br>	
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<center><button type="submit" class="btn btn-warning">ส่งผลการประเมินความพึงพอใจ</button></center>
				</div>
			</div>
			<br>
			<input type="hidden" name="data_subject" value="<?php echo $data_subject;?>">
			<input type="hidden" name="data_teacher" value="<?php echo $data_teacher;?>">
	</form>			
				
			</div>	
		</div>
	</div>
		
<!--*****************************************************************************-->		
<?php	}      ?>
	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	} ?>
		
<!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->		
<?php	}else{ ?>
<!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>แจ้งเตือนจากระบบ ! </strong>ประเมินครูผู้สอน สำหรับนักเรียน ครบระยะเวลาที่กำหนดไว้แล้ว  สิ้นสุดวันที่ 6 มีนาคม 2563 เป็นต้นไป
			</div>			
		</div>
	</div><br>			
<!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->		
<?php	}      ?>




