<?php
	include("view/database/class_admin.php")
?>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
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
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
						<div class="row">
								<div class="col-sm-6 col-md-6 col-lg-6">
									<div class="form-group">
										<label>เทอม/ภาคเรียน</label>
										<select name="txt_term" id="txt_term" data-placeholder="สถานะนักเรียน" class="select">
												<option value="">เทอม/ภาคเรียน</option>
												<option value="1">ภาคเรียนที่ 1</option>
												<option value="2">ภาคเรียนที่ 2</option>
										</select>
									</div>	
								</div>
								<div class="col-sm-6 col-md-6 col-lg-6">
									<div class="form-group">
										<label>สถานะนักเรียน</label>
										<select name="txt_status" id="txt_status" data-placeholder="สถานะนักเรียน" class="select">
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
		</div>
	</div>
</div>
<div id="print_data"></div>
