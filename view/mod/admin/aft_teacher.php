<?php

	$txt_term=post_data($_POST["txt_term"]);
	$txt_year=post_data($_POST["txt_year"]);

		if($txt_term=="" and $txt_year==""){
			exit("<script>window.location='./?evaluation_mod=aft_data_teacher';</script>");
		}elseif($txt_term=="" or $txt_year==""){
			exit("<script>window.location='./?evaluation_mod=aft_data_teacher';</script>");
		}else{
			$data_term=$txt_term;
?>
<!--***********************************************-->	
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ข้อมูลครูผู้สอน </span>  ประเมินความพึงพอใจการจัดการเรียนการสอน </h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>การจัดการ ประเมินความพึงพอใจการจัดการเรียนการสอน</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=aft_teacher" class="btn btn-link  text-size-small"><span>ข้อมูลครูผู้สอน ประเมินความพึงพอใจการจัดการเรียนการสอน</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
<form name="aft_data_teacher" method="post" action="./?evaluation_mod=aft_teacher">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-body">
						<div class="row">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="form-group">
									<label>ลำดับ</label>
										<select name="txt_term"  data-placeholder="ภาคเรียน..." class="select" required>
											<option></option>
											<optgroup>
											
									<?php
											if($txt_term==1){ ?>
												<option value="1" selected>ภาคเรียน 1</option>
												<option value="2">ภาคเรียน 2</option>											
									<?php	}elseif($txt_term==2){ ?>
												<option value="1">ภาคเรียน 1</option>
												<option value="2" selected>ภาคเรียน 2</option>											
									<?php	}else{ ?>
												<option value="1">ภาคเรียน 1</option>
												<option value="2">ภาคเรียน 2</option>											
									<?php	}      ?>		

											</optgroup>
									</select>
								</div>							
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="form-group">
									<label>ปีการศึกษา</label>
										<select name="txt_year"  data-placeholder="ปีการศึกษา..." class="select" required>
											<option></option>
									<!--		<optgroup label="ปีการศึกษา ล่วงหน้า 5 ปี">
									<?php
									/*	$yaer01=date("Y");
										$yaer01=$yaer01+543;
										$count01=1;
											while($count01<=5){  ?>
												<option value="<?php echo $yaer01;?>">ปีการศึกษา <?php echo $yaer01;?></option>
									<?php		$yaer01=$yaer01+1; 
												$count01=$count01+1; } */?>	
											</optgroup> -->
											<optgroup>
									<?php
										$yaer02=date("Y");
										$yaer02=$yaer02+543;
										$count02=1;
											while($count02<=5){ 
												if($txt_year==$yaer02){
													$selected="selected";
												}else{
													$selected="";
												}
											?>
												<option value="<?php echo $yaer02;?>" <?php echo $selected;?>>ปีการศึกษา <?php echo $yaer02;?></option>
									<?php		
												$yaer02=$yaer02-1;
												$count02=$count02+1; } ?>
											</optgroup>
									</select>
								</div>
							</div>							
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12">
							<button type="submit" class="btn btn-success">Enter...</button>
							</div>
						</div>
					</div>
                </div>		
		</div>
	</div><br>
</form>
	<div class="row">
		<?php
			$data_teacher="select DISTINCT `rc_person`.`IDTeacher`,`rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName` 
						   from `course_teacher` join `rc_person` on(`course_teacher`.`ct_coursekey`=`rc_person`.`IDTeacher`) 
						   join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`) 
						   where `course_teacher`.`ct_courseyear`='{$txt_year}' 
						   and `course_teacher`.`ct_courseterm`='{$txt_term}' 
						   ORDER BY `rc_person`.`IDTeacher` ASC";
			$data_teacherRs=$rcdata_connect->query($data_teacher) or die($rcdata_connect->error());
			if($data_teacherRs->num_rows>0){
				$count_teacher=1;
				while($data_teacherRow=$data_teacherRs->fetch_assoc()){ 
					$teacher_name=$data_teacherRow["prefixname"]." ".$data_teacherRow["FName"]." ".$data_teacherRow["SName"];
					$teacher_id=$data_teacherRow["IDTeacher"];
					
				?>
				
<form name="aft_teacher<?php echo $count_teacher;?>" method="post" action="./?evaluation_mod=aft_person">				
		<div class="col-sm-3 col-md-3 col-lg-3">
			<div class="thumbnail">
				<div class="thumb">
					<img src="view/t/<?php echo $data_teacherRow["IDTeacher"];?>.jpg" style="width: 224px; height: 294px" alt="">
					<div class="caption-overflow">
						<span>
							 <button type="submit" name="copy_spensor" value="<?php echo $teacher_id;?>"  class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-download4"></i></button>
						</span>
					</div>
				</div>
				<div class="caption">
					<h6 class="text-semibold no-margin-top"><center><?php echo $teacher_name;?></center></h6>
				</div>
			</div>
		</div>
		<input type="hidden" name="copy_class" value="<?php echo $data_term;?>">
		<input type="hidden" name="copy_year" value="<?php echo $txt_year;?>">
</form>					
		<?php	$count_teacher=$count_teacher+1;} ?>
	</div>			
	<?php	}else{?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>พบข้อมูลผิดพลาด</strong> ไม่พบข้อมูล....
			</div>
		</div>
	</div>		
	<?php	}?>
<!--***********************************************-->	
<?php 	}
