<?php
	$data_yaer=2562;
	$data_term=2;

	$user_login;
	$date_time=date("Y-m-d H:i:s");
	
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
					<a href="index.php?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ประเมินความพึงพอใจการจัดการเรียนการสอน</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="index.php?evaluation_mod=aft_course" class="btn btn-link  text-size-small"><span>รายงานผลการประเมินความพึงพอใจ</span></a>
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
	}
?>

<?php	error_reporting(error_reporting() & ~E_NOTICE);
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
				<strong>ข้อผิดพลาด ! </strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ เข้าใช้งานได้เฉราะ ป4-ม6 เท่านั้น
			</div>			
		</div>
	</div><br>		
<?php	}else{ ?>
<!--////////////////////////////////////////////////////////////////////-->

	<?php
		$data_subject=post_data($_POST["data_subject"]);
		$data_teacher=post_data($_POST["data_teacher"]);
		
	//ตรวจสอบสถานะการประเมิน
	$system_evaluation_subjects="SELECT `evaluation_id` 
								 FROM `evaluation` 
								 WHERE `evaluation_id`='{$user_login}' 
								 and `evaluation_teacher`='{$data_teacher}' 
								 and `evaluation_year`='{$data_yaer}' 
								 and `evaluation_term`='{$data_term}' 
								 and `evaluation_subjects`='{$data_subject}'
								 and `evaluation_s`='1' 
								 and `evaluation_st`='1'";
	$system_esRs=$evaluation_sql->query($system_evaluation_subjects) or die($evaluation_sql->error);
	if($system_esRs->num_rows > 0){
		$system_ses="notkey";
	}else{
		//*************************
	}	
	
	//ตรวจสอบสถานะการประเมิน	
		if($data_subject=="" and $data_teacher==""){ ?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong>ไม่พบข้อมูล  
			</div>		
		</div>
	</div><br>		
<?php	}elseif($data_subject=="" or $data_teacher==""){ ?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong>ไม่พบข้อมูล  
			</div>		
		</div>
	</div><br>		
<?php	}elseif($system_ses=="notkey"){
			exit("<script>window.location='./?evaluation_mod=aft_course';</script>");
		}else{ ?>
<!--////////////////////////////////////////////////////////////////////-->			
	<?php
		$input_subject="select `evaluation_content`.`ec_id`,`evaluation_subject`.`es_id` from `evaluation_content` join `evaluation_subject` on(`evaluation_content`.`ec_id`=`evaluation_subject`.`ec_id`) where `evaluation_content`.`ec_status`=1";
		$input_subjectRs=rc_array($input_subject);
		
		foreach($input_subjectRs as $rc_key=>$input_subjectRow){
			$code_inputsubject=$input_subjectRow["es_id"];
			$ec_id=$input_subjectRow["ec_id"];
			$input_es=post_data($_POST["$code_inputsubject"]);	
			
			if($input_es==""){
				$sql_error01="error";
				$delete_es="DELETE FROM `evaluation_score` WHERE `es_term`='{$data_term}' and `es_year`='{$data_yaer}' and `es_student`='{$user_login}' and `es_subjects`='{$data_subject}';";
				$delete_esdata=add_rc($delete_es);
				break;
			}else{
				$into_evaluation_score="INSERT INTO `evaluation_score` (`es_term`, `es_year`, `es_ec`, `es_es`, `es_teacher`, `es_student`, `es_subjects`, `es_score`, `es_datatime`, `es_status`) 
										VALUES ('{$data_term}', '{$data_yaer}', '{$ec_id}', '{$code_inputsubject}', '{$data_teacher}', '{$user_login}', '{$data_subject}', '{$input_es}', '{$date_time}', '1');";
				$into_es=add_rc($into_evaluation_score);
				if($into_es=="yes"){
					//*******************	
				}else{
					$sql_error01="error";
					$delete_es="DELETE FROM `evaluation_score` WHERE `es_term`='{$data_term}' and `es_year`='{$data_yaer}' and `es_student`='{$user_login}' and `es_subjects`='{$data_subject}';";
					$delete_esdata=add_rc($delete_es);
					break;
				}
			}
		}
		
		
		$input_oeq="SELECT `evaluation_oeqid`,`evaluation_oeqtxt` FROM `evaluation_oeq`";
		$input_oeqRs=rc_array($input_oeq);
		
		foreach($input_oeqRs as $rc_key=>$input_oeqRow){
			$code_inputoeq=$input_oeqRow["evaluation_oeqid"];
			$input_oeq=post_data($_POST["$code_inputoeq"]);
			
			if($input_oeq==""){
				$sql_error02="error";
				$eod_detele="DELETE FROM `evaluation_oeq_data` WHERE `evaluation_odterm`='{$data_term}' and `evaluation_odyear`='{$data_yaer}' and `evaluation_odstudent`='{$user_login}' and `evaluation_odsubjects`='{$data_subject}';";
				$eod_deteleout=add_rc($eod_detele);
				break;
			}else{
				$into_evaluation_oeq_data="INSERT INTO `evaluation_oeq_data` (`evaluation_odid`, `evaluation_odterm`, `evaluation_odyear`, `evaluation_odteacher`, `evaluation_odstudent`, `evaluation_odsubjects`, `evaluation_odtxt`, `evaluation_odtime`) 
										   VALUES ('{$code_inputoeq}', '{$data_term}', '{$data_yaer}', '{$data_teacher}', '{$user_login}', '{$data_subject}', '{$input_oeq}', '{$date_time}');";
				$into_eod=add_rc($into_evaluation_oeq_data);
				if($into_eod=="yes"){
					//****************************
				}else{
					$sql_error02="error";
					$eod_detele="DELETE FROM `evaluation_oeq_data` WHERE `evaluation_odterm`='{$data_term}' and `evaluation_odyear`='{$data_yaer}' and `evaluation_odstudent`='{$user_login}' and `evaluation_odsubjects`='{$data_subject}';";
					$eod_deteleout=add_rc($eod_detele);
					break;
				}
			}
			
			
		}
		
	?>					
<!--////////////////////////////////////////////////////////////////////-->	
	<?php
		if($sql_error01=="error" and $sql_error02=="error"){
			$updata_evaluation="UPDATE `evaluation` SET `evaluation_s`='0',`evaluation_st`='0',`evaluation_datetime`='{$date_time}' 
								WHERE `evaluation`.`evaluation_id`='{$user_login}'
							    and  `evaluation`.`evaluation_teacher`='{$data_teacher}'
                                and `evaluation`.`evaluation_year`='{$data_yaer}'
                                and `evaluation`.`evaluation_term`='{$data_term}'
                                and `evaluation`.`evaluation_subjects`='{$data_subject}'";
			$updata_evaluationCr=add_rc($updata_evaluation);
			if($updata_evaluationCr=="yes"){
				//**************************
			}else{
				$detele_evaluation="DELETE FROM `evaluation` 
									WHERE `evaluation_id`='{$user_login}' 
									and `evaluation_teacher`='{$data_teacher}' 
									and `evaluation_year`='{$data_yaer}' 
									and `evaluation_term`='{$data_term}' 
									and `evaluation_subjects`='{$data_subject}'";
				$detele_evaluationCr=add_rc($detele_evaluation);				
			}?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong>ข้อมูลไม่ถูกต้อง
			</div>		
		</div>
	</div><br>			
<?php			
		}elseif($sql_error01=="error"){
			$updata_evaluation="UPDATE `evaluation` SET `evaluation_s`='0',`evaluation_st`='0',`evaluation_datetime`='{$date_time}' 
								WHERE `evaluation`.`evaluation_id`='{$user_login}'
							    and  `evaluation`.`evaluation_teacher`='{$data_teacher}'
                                and `evaluation`.`evaluation_year`='{$data_yaer}'
                                and `evaluation`.`evaluation_term`='{$data_term}'
                                and `evaluation`.`evaluation_subjects`='{$data_subject}'";
			$updata_evaluationCr=add_rc($updata_evaluation);
			if($updata_evaluationCr=="yes"){
				//**************************
			}else{
				$detele_evaluation="DELETE FROM `evaluation` 
									WHERE `evaluation_id`='{$user_login}' 
									and `evaluation_teacher`='{$data_teacher}' 
									and `evaluation_year`='{$data_yaer}' 
									and `evaluation_term`='{$data_term}' 
									and `evaluation_subjects`='{$data_subject}'";
				$detele_evaluationCr=add_rc($detele_evaluation);				
			}	?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong>ข้อมูลไม่ถูกต้อง
			</div>		
		</div>
	</div><br>			
<?php			
		}elseif($sql_error02=="error"){
			$updata_evaluation="UPDATE `evaluation` SET `evaluation_s`='0',`evaluation_st`='0',`evaluation_datetime`='{$date_time}' 
								WHERE `evaluation`.`evaluation_id`='{$user_login}'
							    and  `evaluation`.`evaluation_teacher`='{$data_teacher}'
                                and `evaluation`.`evaluation_year`='{$data_yaer}'
                                and `evaluation`.`evaluation_term`='{$data_term}'
                                and `evaluation`.`evaluation_subjects`='{$data_subject}'";
			$updata_evaluationCr=add_rc($updata_evaluation);
			if($updata_evaluationCr=="yes"){
				//**************************
			}else{
				$detele_evaluation="DELETE FROM `evaluation` 
									WHERE `evaluation_id`='{$user_login}' 
									and `evaluation_teacher`='{$data_teacher}' 
									and `evaluation_year`='{$data_yaer}' 
									and `evaluation_term`='{$data_term}' 
									and `evaluation_subjects`='{$data_subject}'";
				$detele_evaluationCr=add_rc($detele_evaluation);				
			}	?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong>ข้อมูลไม่ถูกต้อง
			</div>		
		</div>
	</div><br>			
<?php			
		}else{
			$add_evaluation="INSERT INTO `evaluation` (`evaluation_id`, `evaluation_teacher`, `evaluation_year`, `evaluation_term`, `evaluation_subjects`, `evaluation_s`, `evaluation_st`, `evaluation_datetime`) 
					         VALUES ('{$user_login}', '{$data_teacher}', '{$data_yaer}', '{$data_term}', '{$data_subject}', '1', '1', '{$date_time}');";
			$add_evaluationCr=add_rc($add_evaluation);
			
			if($add_evaluationCr=="yes"){
				?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>สำเร็จ ! </strong>ประเมินความพึงพอใจการจัดการเรียนการสอนเรียบร้อยแล้ว
			</div>		
		</div>
	</div><br>	

	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">	
			<center>
				<a href="./?evaluation_mod=home"><button type="button" class="btn btn-success">หน้าแรก</button></a>
				<a href="./?evaluation_mod=aft_course"><button type="button" class="btn btn-info">หน้ารายวิชาประเมินความพึงพอใจ</button></a>
			</center>
		</div>	
	</div><br>
	
<?php		}else{
			$updata_evaluation="UPDATE `evaluation` SET `evaluation_s`='1',`evaluation_st`='1',`evaluation_datetime`='{$date_time}' 
								WHERE `evaluation`.`evaluation_id`='{$user_login}'
							    and  `evaluation`.`evaluation_teacher`='{$data_teacher}'
                                and `evaluation`.`evaluation_year`='{$data_yaer}'
                                and `evaluation`.`evaluation_term`='{$data_term}'
                                and `evaluation`.`evaluation_subjects`='{$data_subject}'";
			$updata_evaluationCr=add_rc($updata_evaluation); 
			?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>สำเร็จ ! </strong>ประเมินความพึงพอใจการจัดการเรียนการสอนเรียบร้อยแล้ว
			</div>		
		</div>
	</div><br>

	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">	
			<center>
				<a href="./?evaluation_mod=home"><button type="button" class="btn btn-success">หน้าแรก</button></a>
				<a href="./?evaluation_mod=aft_course"><button type="button" class="btn btn-info">หน้ารายวิชาประเมินความพึงพอใจ</button></a>
			</center>
		</div>	
	</div><br>
	
<?php			
			}
		}
	?>
<!--////////////////////////////////////////////////////////////////////-->	
<?php	}      ?>
<!--////////////////////////////////////////////////////////////////////-->		
<?php   }?>		
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

