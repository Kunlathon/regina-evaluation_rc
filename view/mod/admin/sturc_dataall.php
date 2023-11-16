<?php
	include("view/database/class_admin.php");
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ข้อมูลนักเรียน </span>ทั้งหมด</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=#" class="btn btn-link  text-size-small"><span>ข้อมูลนักเรียน</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>




<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-default">
			<div class="panel-body">
						<div class="row">
								<div class="col-<?php echo $grid;?>-6">
									
									<label class="control-label col-<?php echo $grid;?>-3">เทอม/ปีการศึกษา</label>
									<div class="col-<?php echo $grid;?>-9">
										<div class="form-group">
											<select class="select-search" name="stu_year" data-placeholder="เลือก เทอม/ปีการศึกษา" id="stu_year"> 
												<option value="">เลือก เทอม/ปีการศึกษา</option>
										<?php
												$count=0;
												while($count<=50){ 
													$data_y=(date("Y")+543)-$count; ?>
													
												<option value="2/<?php echo $data_y;?>">2/<?php echo $data_y;?></option>
												<option value="1/<?php echo $data_y;?>">1/<?php echo $data_y;?></option>	
													
										<?php		$count=$count+1;
												} ?>
											</select>
										</div>									
									</div>
									

								</div>
								<div class="col-<?php echo $grid;?>-6">
									<div class="form-group">
										<label class="control-label col-<?php echo $grid;?>-3">สถานะนักเรียน</label>
										<div class="col-<?php echo $grid;?>-9">
											<select name="txt_status" id="txt_status" data-placeholder="สถานะนักเรียน" class="select-search">
													<option value="">สถานะนักเรียน</option>
													<?php
														$student_status="SELECT `IDStatus`,`Name` FROM `rc_student_status`";
														$student_statusRs=rc_array($student_status);
														
														foreach($student_statusRs as $rc_key=>$student_statusRow){
															$data_IDStatus=$student_statusRow["IDStatus"];
															$data_Name=$student_statusRow["Name"]; ?>
															
													<option value="<?php echo $data_IDStatus;?>"><?php echo $data_Name;?></option>		
															
													<?php	} ?>
											</select>										
										
										</div>

										
									</div>	
								</div>
						</div>	
						<input type="hidden" id="myname" value="<?php echo $myname;?>" >
			</div>
		</div>
	</div>
</div>
<div id="print_data"></div>
