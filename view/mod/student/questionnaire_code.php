<?php
	$data_yaer=2564;
	$data_term=1;

	$user_login;
	$datetime=date("Y-m-d H:i:s");
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
<!--*******************************************************************-->	
<?php
	$ques_txt=post_data($_POST["ques_txt"]);
	$ques_key=$user_login.$data_term.$data_yaer;
	$add_questionnaire="INSERT INTO `questionnaire` (`ques_key`, `ques_term`, `ques_year`, `ques_student`, `ques_class`, `ques_add`, `ques_datetime`,`ques_txt`) 
						VALUES ('{$ques_key}', '{$data_term}', '{$data_yaer}', '{$user_login}', '{$rsc_class}', '1', '{$datetime}','{$ques_txt}');";
	$add_questionnaireTo=add_rc($add_questionnaire);
	if($add_questionnaireTo=="yes"){?>
<!--*******************************************************************-->		
<?php
		$questionnaire_caption="SELECT `qc_key`,`qc_txt` FROM `questionnaire_caption`";
		$questionnaire_captionRs=rc_array($questionnaire_caption);
		$qc_count=1;
		foreach($questionnaire_captionRs as $rc_key=>$questionnaire_captionRow){ 
			$score_qsc=post_data($_POST["qsc$qc_count"]);
			$qc_key=$questionnaire_captionRow["qc_key"];
			if($score_qsc=="" or $score_qsc==0){
				$delete_questionnaire_score="DELETE FROM `questionnaire_score` WHERE `questionnaire_ques_student`='{$user_login}' 
											 and `questionnaire_ques_term`='{$data_term}' 
											 and `questionnaire_ques_year`='{$data_yaer}'";
				$delete_questionnaire_scoreto=add_rc($delete_questionnaire_score);
				
				$delete_questionnaire="DELETE FROM `questionnaire` WHERE `ques_student`='{$user_login}' and `ques_term`='{$data_term}' and `ques_year`='{$data_yaer}'";
				$delete_questionnaire_To=add_rc($delete_questionnaire);
				
				$print_error="01";
				break;
			}else{
				$qs_key=$user_login.$qc_count;
				$into_questionnaire_score="INSERT INTO `questionnaire_score` (`qs_key`, `qs_class`, `qs_score`, `qs_datetime`, `questionnaire_caption_qc_key`, `questionnaire_ques_key`, `questionnaire_ques_term`, `questionnaire_ques_year`, `questionnaire_ques_student`) 
				                           VALUES ('{$qs_key}', '{$rsc_class}', '{$score_qsc}', '{$datetime}', '$qc_key', '{$ques_key}', '{$data_term}', '{$data_yaer}', '{$user_login}');";
				$into_questionnaire_scoreto=add_rc($into_questionnaire_score);
				if($into_questionnaire_scoreto=="yes"){
					//------
				}else{
					$delete_questionnaire_score="DELETE FROM `questionnaire_score` WHERE `questionnaire_ques_student`='{$user_login}' 
											     and `questionnaire_ques_term`='{$data_term}' 
											     and `questionnaire_ques_year`='{$data_yaer}'";
					$delete_questionnaire_scoreto=add_rc($delete_questionnaire_score);
					
					$delete_questionnaire="DELETE FROM `questionnaire` WHERE `ques_student`='{$user_login}' and `ques_term`='{$data_term}' and `ques_year`='{$data_yaer}'";
					$delete_questionnaire_To=add_rc($delete_questionnaire);
					
					$print_error="01";	
					break;					
				}
			}
		$qc_count=$qc_count+1;} ?>
<!--*******************************************************************-->		
<?php
	//questionnaire_system
		$count_qs=1;
		while($count_qs<=5){
			$txt_qs=post_data($_POST["qs$count_qs"]);
			if($txt_qs==""){
				//-----------------------------------
			}else{
				$qsh_key=$count_qs.$user_login;
				$add_questionnaire_system="INSERT INTO `questionnaire_show` (`qsh_key`, `qsh_class`, `qsh_txt`, `qsh_datetime`, `questionnaire_ques_key`, `questionnaire_ques_term`, `questionnaire_ques_year`, `questionnaire_ques_student`) 
									       VALUES ('{$qsh_key}', '{$rsc_class}', '{$txt_qs}', '{$datetime}', '{$ques_key}', '{$data_term}', '{$data_yaer}', '{$user_login}');";
				$add_questionnaire_systemTo=add_rc($add_questionnaire_system);
				if($add_questionnaire_systemTo=="yes"){
					//-------------------------------------
				}else{
					$delete_questionnaire_score="DELETE FROM `questionnaire_score` WHERE `questionnaire_ques_student`='{$user_login}'  and `questionnaire_ques_term`='{$data_term}' and `questionnaire_ques_year`='{$data_yaer}';";
					$delete_questionnaire_scoreTo=add_rc($delete_questionnaire_score);
					
					$delete_questionnaire_system="DELETE FROM `questionnaire_show` WHERE `questionnaire_ques_student`='{$user_login}' and `questionnaire_ques_term`='{$data_term}' and `questionnaire_ques_year`='{$data_yaer}'";
					$delete_questionnaire_systemTo=add_rc($delete_questionnaire_system);
					
					$delete_questionnaire="DELETE FROM `questionnaire` WHERE `ques_student`='{$user_login}' and `ques_term`='{$data_term}' and `ques_year`='{$data_yaer}'";
					$delete_questionnaire_To=add_rc($delete_questionnaire);
					$print_error="01";
					break;
				}
			}
			$count_qs=$count_qs+1;
		}
	//questionnaire_show
		$count_qshow=1;
		while($count_qshow<=5){
			$txt_qshow=post_data($_POST["qsys$count_qshow"]);
			if($txt_qshow==""){
				//-------------------------------------
			}else{
				$qsy_key=$count_qshow.$user_login;
				$questionnaire_show="INSERT INTO `questionnaire_system` (`qsy_class`, `qsy_key`, `qsy_txt`, `qsy_datetime`, `questionnaire_ques_key`, `questionnaire_ques_term`, `questionnaire_ques_year`, `questionnaire_ques_student`) 
									 VALUES ('{$rsc_class}', '{$qsy_key}', '{$txt_qshow}', '{$datetime}', '{$ques_key}', '{$data_term}', '{$data_yaer}', '{$user_login}');";
				$questionnaire_showTo=add_rc($questionnaire_show);
				if($questionnaire_showTo=="yes"){
					//-------------------------------------
				}else{
					$delete_questionnaire_score="DELETE FROM `questionnaire_score` WHERE `questionnaire_ques_student`='{$user_login}'  and `questionnaire_ques_term`='{$data_term}' and `questionnaire_ques_year`='{$data_yaer}';";
					$delete_questionnaire_scoreTo=add_rc($delete_questionnaire_score);
					
					$delete_questionnaire_system="DELETE FROM `questionnaire_show` WHERE `questionnaire_ques_student`='{$user_login}' and `questionnaire_ques_term`='{$data_term}' and `questionnaire_ques_year`='{$data_yaer}'";
					$delete_questionnaire_systemTo=add_rc($delete_questionnaire_system);
					
					$delete_questionnaire_show="DELETE FROM `questionnaire_show` WHERE `questionnaire_ques_student`='{$user_login}' and `questionnaire_ques_term`='{$data_term}' and `questionnaire_ques_year`='{$data_yaer}'";
					$delete_questionnaire_showTo=add_rc($delete_questionnaire_show);
					
					$delete_questionnaire="DELETE FROM `questionnaire` WHERE `ques_student`='{$user_login}' and `ques_term`='{$data_term}' and `ques_year`='{$data_yaer}'";
					$delete_questionnaire_To=add_rc($delete_questionnaire);
					$print_error="01";
					break;
					
				}
			}
			$count_qshow=$count_qshow+1;
		}
		if($print_error=="01"){ ?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong>ข้อมูลไม่สมบูรณ์...
			</div>	
			<div class="row">
				<center>
					<a href="./?evaluation_mod=home"><button type="button" class="btn btn-success">หน้าแรก</button></a>

				</center>	
			</div>			
		</div>
	</div><br>			
<?php	}else{ ?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>สำเร็จ </strong>ส่งแบบประเมินเรียบร้อยแล้ว
			</div>
			<div class="row">
				<center>
					<a href="./?evaluation_mod=home"><button type="button" class="btn btn-success">หน้าแรก</button></a>	
				</center>	
			</div>
		</div>
	</div><br>			
<?php	}?>		
<!--*******************************************************************-->						
<?php	}else{ ?>
<!--*******************************************************************-->	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong>ข้อมูลไม่ถูกต้อง...
			</div>	
			<div class="row">
				<center>
					<a href="./?evaluation_mod=home"><button type="button" class="btn btn-success">หน้าแรก</button></a>
				</center>	
			</div>			
		</div>
	</div><br>	
<!--*******************************************************************-->		
<?php   }?>




	
		
<?php   }     ?>