<?php

	$data_yaer=2562;
	$data_term=2;
	
	$user_login;
	include("view/function/strlen.php"); 
	
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
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=aft_course" class="btn btn-link  text-size-small"><span>ประเมินความพึงพอใจการจัดการเรียนการสอน</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=aft_course" class="btn btn-link  text-size-small"><span>รายวิชาประเมินความพึงพอใจ</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<?php
		if($print_runtime=="ON"){ ?>
<!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->

<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading"><center><h5><div id="demo"></div></h5></center></div>
		</div>
	</div>
</div>

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
<?php	}else{?>
<!--*****************************************************-->	
	<div class="row">
		<div class="col-sm-5 col-md-5 col-lg-5">

	<?php
		$data_subjectP="select `rc_subject_$data_yaer`.`IDSubject` from `rc_subject_$data_yaer` join `rc_register_$data_yaer` on(`rc_subject_$data_yaer`.`IDSubject`=`rc_register_$data_yaer`.`IDSubject`)
                       where `rc_subject_$data_yaer`.`IDLevel`='{$rsc_class}' 
					   and `rc_subject_$data_yaer`.`Type`='{$txt_type}' 
					   and `rc_subject_$data_yaer`.`Term`='{$txt_term}'
                       and `rc_register_$data_yaer`.`IDStudent`='{$user_login}'";
		$data_subjectPRs=$evaluation_sql->query($data_subjectP) or die($evaluation_sql->error);
		if($data_subjectPRs->num_rows>0){
			while($data_subjectPRow=$data_subjectPRs->fetch_assoc()){
				$numP_IDSubject=utf8_strlen($data_subjectPRow["IDSubject"]);
				if($numP_IDSubject==6){
					$dataP_IDSubject=$data_subjectPRow["IDSubject"];
				}else{
					$dataP_IDSubject=mb_substr($data_subjectPRow["IDSubject"],0,6,'UTF-8');
				}	
					$course_teacherP="SELECT DISTINCT `course_teacher`.`ct_courseid` 
								     FROM `course_teacher` WHERE `ct_courseid`='{$dataP_IDSubject}' 
									 and `ct_courseyear`='{$data_yaer}' 
									 and `rc_course_level`='{$rsc_class}' 
									 and `ct_courseterm`='{$data_term}';";
					$course_teacherPRs=$evaluation_sql->query($course_teacherP) or die($evaluation_sql->error);
					if($course_teacherPRs->num_rows>0){
						while($course_teacherPRow=$course_teacherPRs->fetch_assoc()){
							
							$have_group="SELECT * FROM `course_teacher` 
									     WHERE `rc_course_level`='{$rsc_class}' 
										 and `ct_courseyear`='{$data_yaer}'
										 and `ct_courseid`='{$dataP_IDSubject}'
										 and `ct_group` !='0';";
							$have_groupRs=rc_data($have_group);
							foreach($have_groupRs as $rc_key=>$have_groupRow){
								$num_groupA=$num_groupA+1;
								
								$group_course_teacher="SELECT `evaluation_id` FROM `evaluation` 
													   WHERE  `evaluation_id`='{$user_login}'
									                   and `evaluation_year`='{$data_yaer}' 
									                   and `evaluation_term`='{$data_term}' 
									                   and `evaluation_subjects`='{$dataP_IDSubject}'
									                   and `evaluation_s`='1' 
									                   and `evaluation_st`='1'";
								$group_course_teacherRs=rc_array($group_course_teacher);
								
								foreach($group_course_teacherRs as $rc_key=>$group_course_teacherRow){
									$num_groupB=$num_groupB+1;
								}
							}
							
							$course_teacher_informationP="SELECT * FROM `course_teacher` 
													     WHERE `rc_course_level`='{$rsc_class}' 
													     and `ct_courseyear`='{$data_yaer}'
													     and `ct_courseid`='{$dataP_IDSubject}';";
							$course_teacher_informationPRs=rc_array($course_teacher_informationP);
							foreach($course_teacher_informationPRs as $rc_key=>$course_teacher_informationPRow){
							$ct_Pcourseroom=$course_teacher_informationPRow["ct_courseroom"];
							$ct_Pgroup=$course_teacher_informationPRow["ct_group"];
							$ct_Pcoursekey=$course_teacher_informationPRow["ct_coursekey"];
								if($ct_Pcourseroom==0){
									if($ct_Pgroup==0){
										$num_allroomA=$num_allroomA+1;
										
										$info_course_teacher="SELECT `evaluation_id` FROM `evaluation` 
														      WHERE `evaluation_teacher`='{$ct_Pcoursekey}' 
									                          and `evaluation_id`='{$user_login}'
									                          and `evaluation_year`='{$data_yaer}' 
									                          and `evaluation_term`='{$data_term}' 
									                          and `evaluation_subjects`='{$dataP_IDSubject}'
									                          and `evaluation_s`='1' 
									                          and `evaluation_st`='1'";
										$info_course_teacherRs=rc_array($info_course_teacher);
										foreach($info_course_teacherRs as $rc_key=>$info_course_teacherRow){
											$num_allroomB=$num_allroomB+1;
										}
									}else{
										//$b=$b+1;
									}
								}elseif($ct_Pcourseroom==$rsc_room){
									if($ct_Pgroup==0){
										$num_roomA=$num_roomA+1;
										
										$info_course_teacher="SELECT `evaluation_id` FROM `evaluation` 
														      WHERE `evaluation_teacher`='{$ct_Pcoursekey}' 
									                          and `evaluation_id`='{$user_login}'
									                          and `evaluation_year`='{$data_yaer}' 
									                          and `evaluation_term`='{$data_term}' 
									                          and `evaluation_subjects`='{$dataP_IDSubject}'
									                          and `evaluation_s`='1' 
									                          and `evaluation_st`='1'";
										$info_course_teacherRs=rc_array($info_course_teacher);
										foreach($info_course_teacherRs as $rc_key=>$info_course_teacherRow){
											$num_roomB=$num_roomB+1;
										}
										
									}else{
										//$b=$b+1;
									}								
								}else{
									//*****
								}
							}
						}
					}else{
						//******
					}
			}
		}else{
			//*******
		}
		
		$all_num=$num_groupA+$num_allroomA+$num_roomA;
		$all_numkey=$num_groupB+$num_allroomB+$num_roomB;
		$all_numnot=$all_num-$all_numkey;
	
		
	?>	
		
<script>
	$(document).ready(function (){
	
    // Donut chart
    // ------------------------------

    // Generate chart
    var donut_chart = c3.generate({
        bindto: '#c3-donut-chart',
        size: { width: 350 },
        color: {
            pattern: ['#0066FF', '#FF3300']
        },
        data: {
            columns: [
                ['ประเมินแล้ว', <?php echo $all_numkey;?>],
                ['ยังไม่ได้ประเมิน', <?php echo $all_numnot;?>],
            ],
            type : 'donut'
        },
        donut: {
           // title: "ประเมินความพึงพอใจการจัดการเรียนการสอน"
        }
    });

   



	});	
</script>		
		
		
				<div class="panel panel-flat">
			<div class="panel-body">
									<div class="chart-container text-center">
										<div class="display-inline-block" id="c3-donut-chart"></div>
									</div>
			</div>
		</div>
		
		
		</div>
		<div class="col-sm-7 col-md-7 col-lg-7">
<!--////////////////////////////////////////////////////-->	

	<?php
		$data_subject="select `rc_subject_$data_yaer`.`IDSubject`,`rc_subject_$data_yaer`.`Name`,`rc_subject_$data_yaer`.`EName` from `rc_subject_$data_yaer` join `rc_register_$data_yaer` on(`rc_subject_$data_yaer`.`IDSubject`=`rc_register_$data_yaer`.`IDSubject`)
                       where `rc_subject_$data_yaer`.`IDLevel`='{$rsc_class}' 
					   and `rc_subject_$data_yaer`.`Type`='{$txt_type}' 
					   and `rc_subject_$data_yaer`.`Term`='{$txt_term}'
                       and `rc_register_$data_yaer`.`IDStudent`='{$user_login}' 
					   ORDER BY `rc_subject_$data_yaer`.`order_4` ASC";
		$data_subjectRs=$evaluation_sql->query($data_subject) or die($evaluation_sql->error);
		if($data_subjectRs->num_rows>0){
			while($data_subjectRow=$data_subjectRs->fetch_assoc()){
				$num_IDSubject=utf8_strlen($data_subjectRow["IDSubject"]);
				if($num_IDSubject==6){
					$data_IDSubject=$data_subjectRow["IDSubject"];
				}else{
					$data_IDSubject=mb_substr($data_subjectRow["IDSubject"],0,6,'UTF-8');
				}
					if($data_subjectRow["EName"]==""){
						$subjectEn="";
					}else{
						$subjectEn=' ('.$data_subjectRow["EName"].')';
					}
				
					$course_teacher="SELECT DISTINCT `course_teacher`.`ct_courseid` 
								     FROM `course_teacher` WHERE `ct_courseid`='{$data_IDSubject}' 
									 and `ct_courseyear`='{$data_yaer}' 
									 and `rc_course_level`='{$rsc_class}' 
									 and `ct_courseterm`='{$data_term}';";
					$course_teacherRs=$evaluation_sql->query($course_teacher) or die($evaluation_sql->error);
					if($course_teacherRs->num_rows>0){	
						while($course_teacherRow=$course_teacherRs->fetch_assoc()){
							$count_txt=$count_txt+1;
							?>
						
						<div class="col-sm-3 col-md-3 col-lg-3">
							<button type="button" id="myBtn<?php echo $count_txt;?>" class="btn bg-teal-500 btn-block btn-float btn-float-lg" title="<?php echo $data_IDSubject."/".$data_subjectRow["Name"];?>">							
								<i class="icon-file-plus"></i>
								<span><?php echo $data_IDSubject."/".$data_subjectRow["Name"];?></span>
							</button>	
							<!--<span class="badge bg-danger-400 media-badge">2</span>-->								
						</div>

<!-- Modal -->
	<div class="modal fade" id="myModal<?php echo $count_txt;?>" role="dialog">
		<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">วิชา : <?php echo $data_subjectRow["Name"]." รหัสวิชา : ".$data_IDSubject;?></h4>
			</div>
			<div class="modal-body">
				
					<?php
						$course_teacher_information="SELECT * FROM `course_teacher` 
													 WHERE `rc_course_level`='{$rsc_class}' 
													 and `ct_courseyear`='{$data_yaer}'
													 and `ct_courseid`='{$data_IDSubject}';";
						$course_teacher_informationRs=rc_array($course_teacher_information);
						$count_te=2020;
						foreach($course_teacher_informationRs as $rc_key=>$course_teacher_informationRow){
							$ct_courseroom=$course_teacher_informationRow["ct_courseroom"];
							$ct_group=$course_teacher_informationRow["ct_group"];
							$ct_coursekey=$course_teacher_informationRow["ct_coursekey"];
							
							$name_te="select `rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName` from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`)
									  where `rc_person`.`IDTeacher`='{$ct_coursekey}'";
							$name_teRs=rc_data($name_te);
							foreach($name_teRs as $rc_key=>$name_teRow){
								$myname_te=$name_teRow["prefixname"]." ".$name_teRow["FName"]." ".$name_teRow["SName"];
								if($myname_te==""){
									$myname_te="ไม่พบข้อมูล";
								}else{
									$myname_te;
								}								
							}

							
							if($ct_courseroom==0){
								if($ct_group==0){?>
<!-------------------------------------------------------------------------------------->	
<form name="aft_form<?php echo $count_te;?>" method="post" action="./?evaluation_mod=aft_form">
	<div class="row">
		<div class="panel panel-warning">
			<div class="panel-body">
				<div class="col-sm-3 col-md-3 col-lg-3">	
					<img src="view/t/<?php echo $ct_coursekey; ?>.jpg" class="img-thumbnail" alt="Cinque Terre" style="width: 163px; height: 187px;">				
				</div>
				<div class="col-sm-8 col-md-8 col-lg-8">
					<p><h5>ชื่อ-สกุล : <?php echo $myname_te;?></h5></p>
					<p><h5>สอนวิชา : <?php echo $data_subjectRow["Name"].$subjectEn;?></h5></p>
					
		<?php
				$tea_course_teacher="SELECT `evaluation_id` FROM `evaluation` 
									 WHERE `evaluation_teacher`='{$ct_coursekey}' 
									 and `evaluation_id`='{$user_login}'
									 and `evaluation_year`='{$data_yaer}' 
									 and `evaluation_term`='{$data_term}' 
									 and `evaluation_subjects`='{$data_IDSubject}'
									 and `evaluation_s`='1' 
									 and `evaluation_st`='1'";			
				$tea_course_teacherRs=$evaluation_sql->query($tea_course_teacher) or die($evaluation_sql->error);
				if($tea_course_teacherRs->num_rows>0){ ?>
					<p><center><h4><font color="#F20509">ประเมินความพึงพอใจแล้ว</font></h4></center></p>
		<?php	}else{ ?>
					<p><center><button type="submit" class="btn btn-success">ส่งประเมินความพึงพอใจ</button></center></p>
		<?php	} ?>			
					
					<input type="hidden" name="data_subject" value="<?php echo $data_IDSubject;?>">
					<input type="hidden" name="data_teacher" value="<?php echo $course_teacher_informationRow["ct_coursekey"];?>">
				</div>
			</div>		
		</div>
	</div>
</form>	
<!-------------------------------------------------------------------------------------->										
					<?php		}else{ ?>
<!-------------------------------------------------------------------------------------->	
<form name="aft_form<?php echo $count_te;?>" method="post" action="./?evaluation_mod=aft_form">
	<div class="row">
		<div class="panel panel-warning">
			<div class="panel-body">
				<div class="col-sm-3 col-md-3 col-lg-3">	
					<img src="view/t/<?php echo $ct_coursekey; ?>.jpg" class="img-thumbnail" alt="Cinque Terre" style="width: 163px; height: 187px;">				
				</div>
				<div class="col-sm-8 col-md-8 col-lg-8">
					<p><h5>ชื่อ-สกุล : <?php echo $myname_te?></h5></p>
					<p><h5><?php echo $data_subjectRow["Name"].$subjectEn;?></h5></p>
					<p><h5>กลุ่ม : <?php echo $ct_group;?></h5></p>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-12">
		<?php
				$tea_course_teacher="SELECT `evaluation_id` FROM `evaluation` 
									 WHERE  `evaluation_id`='{$user_login}'
									 and `evaluation_year`='{$data_yaer}' 
									 and `evaluation_term`='{$data_term}' 
									 and `evaluation_subjects`='{$data_IDSubject}'
									 and `evaluation_s`='1' 
									 and `evaluation_st`='1'";			
				$tea_course_teacherRs=$evaluation_sql->query($tea_course_teacher) or die($evaluation_sql->error);
				if($tea_course_teacherRs->num_rows>0){ ?>
					<p><center><h4><font color="#F20509">ประเมินความพึงพอใจแล้ว</font></h4></center></p>
		<?php	}else{ ?>
					<p><center><button type="submit" class="btn btn-success">ส่งประเมินความพึงพอใจ</button></center></p>
		<?php	} ?>				
					<input type="hidden" name="data_subject" value="<?php echo $data_IDSubject;?>">
					<input type="hidden" name="data_teacher" value="<?php echo $course_teacher_informationRow["ct_coursekey"];?>">
				</div>
			</div>		
		</div>
	</div>
</form>	
<!-------------------------------------------------------------------------------------->									
					<?php			 }
							}elseif($ct_courseroom==$rsc_room){ 
								if($ct_group==0){ ?>
<!-------------------------------------------------------------------------------------->	
<form name="aft_form<?php echo $count_te;?>" method="post" action="./?evaluation_mod=aft_form">
	<div class="row">
		<div class="panel panel-warning">
			<div class="panel-body">
				<div class="col-sm-3 col-md-3 col-lg-3">	
					<img src="view/t/<?php echo $ct_coursekey; ?>.jpg" class="img-thumbnail" alt="Cinque Terre" style="width: 163px; height: 187px;">				
				</div>
				<div class="col-sm-8 col-md-8 col-lg-8">
					<p><h5>ชื่อ-สกุล : <?php echo $myname_te?></h5></p>
					<p><h5>สอนวิชา :  <?php echo $data_subjectRow["Name"].$subjectEn;?></h5></p>
					
		<?php
				$tea_course_teacher="SELECT `evaluation_id` FROM `evaluation` 
									 WHERE `evaluation_teacher`='{$ct_coursekey}' 
									 and `evaluation_id`='{$user_login}'
									 and `evaluation_year`='{$data_yaer}' 
									 and `evaluation_term`='{$data_term}' 
									 and `evaluation_subjects`='{$data_IDSubject}'
									 and `evaluation_s`='1' 
									 and `evaluation_st`='1'";			
				$tea_course_teacherRs=$evaluation_sql->query($tea_course_teacher) or die($evaluation_sql->error);
				if($tea_course_teacherRs->num_rows>0){ ?>
					<p><center><h4><font color="#F20509">ประเมินความพึงพอใจแล้ว</font></h4></center></p>
		<?php	}else{ ?>
					<p><center><button type="submit" class="btn btn-success">ส่งประเมินความพึงพอใจ</button></center></p>
		<?php	} ?>			
					
					<input type="hidden" name="data_subject" value="<?php echo $data_IDSubject;?>">
					<input type="hidden" name="data_teacher" value="<?php echo $course_teacher_informationRow["ct_coursekey"];?>">
				</div>
			</div>		
		</div>
	</div>
</form>	
<!-------------------------------------------------------------------------------------->										
					<?php		}else{ ?>
<!-------------------------------------------------------------------------------------->	
<form name="aft_form<?php echo $count_te;?>" method="post" action="./?evaluation_mod=aft_form">
	<div class="row">
		<div class="panel panel-warning">
			<div class="panel-body">
				<div class="col-sm-3 col-md-3 col-lg-3">	
					<img src="view/t/<?php echo $ct_coursekey; ?>.jpg" class="img-thumbnail" alt="Cinque Terre" style="width: 163px; height: 187px;">				
				</div>
				<div class="col-sm-8 col-md-8 col-lg-8">
					<p><h5>ชื่อ-สกุล : <?php echo $myname_te?></h5></p>
					<p><h5>สอนวิชา : <?php echo $data_subjectRow["Name"].$subjectEn;?></h5></p>
					<p><h5>กลุ่ม : <?php echo $ct_group;?></h5></p>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-12">
		<?php
				$tea_course_teacher="SELECT `evaluation_id` FROM `evaluation` 
									 WHERE  `evaluation_id`='{$user_login}'
									 and `evaluation_year`='{$data_yaer}' 
									 and `evaluation_term`='{$data_term}' 
									 and `evaluation_subjects`='{$data_IDSubject}'
									 and `evaluation_s`='1' 
									 and `evaluation_st`='1'";			
				$tea_course_teacherRs=$evaluation_sql->query($tea_course_teacher) or die($evaluation_sql->error);
				if($tea_course_teacherRs->num_rows>0){ ?>
					<p><center><h4><font color="#F20509">ประเมินความพึงพอใจแล้ว</font></h4></center></p>
		<?php	}else{ ?>
					<p><center><button type="submit" class="btn btn-success">ส่งประเมินความพึงพอใจ</button></center></p>
		<?php	} ?>				
					<input type="hidden" name="data_subject" value="<?php echo $data_IDSubject;?>">
					<input type="hidden" name="data_teacher" value="<?php echo $course_teacher_informationRow["ct_coursekey"];?>">
				</div>
			</div>		
		</div>
	</div>
</form>	
<!-------------------------------------------------------------------------------------->									
					<?php			 }
							}else{
								//**********************
							}
$count_te=$count_te+1;   } ?>
				
			</div>
        <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
        </div>
		</div>
		</div>
	</div>				
	<!-- Modal -->			
	<script>
		$(document).ready(function(){
			$("#myBtn<?php echo $count_txt;?>").click(function(){
			$("#myModal<?php echo $count_txt;?>").modal({backdrop: false});
			});
		});
	</script>				
				
				
			<?php		}
				}else{
						
				}
			}
		}else{
			//*********
		} 
	?>	
	
<!--////////////////////////////////////////////////////-->			
		</div>
	</div>
	

<!--*****************************************************-->
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















				
					
	
				
					
