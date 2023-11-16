<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">เพิ่มข้อมูล</span> นักเรียนค้างจ่าย</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>เพิ่มข้อมูลนักเรียนค้างจ่าย</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<center>
			<button type="button" data-toggle="tab" href="#overdue1" class="btn btn-default">เพิ่มข้อมูล ทีละรายการ</button>
			<button type="button" data-toggle="tab" href="#overdue2" class="btn btn-default">เพิ่มข้อมูล หลายรายการ</button>
		</center>
	</div>
</div><br>
<div class="tab-content">
	<div id="overdue1" class="tab-pane fade in active">
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
			    <div class="panel panel-info">
					<div class="panel-heading">เพิ่มข้อมูลนักเรียนค้างจ่าย (ทีละรายการ)</div>
					<div class="panel-body">
						<div class="container">
							<form class="form-horizontal" name="overdue_key" method="post" action="?evaluation_mod=overdue_code">
								<div class="row">
								<fieldset class="content-group">
									<div class="col-<?php echo $grid;?>-6">
										<div class="form-group">
											<label class="control-label col-sm-3 col-md-3 col-lg-3">รหัสนักเรียน</label>
											<div class="col-sm-9 col-md-9 col-lg-9">
												<input type="number" max="90000" min="999"  name="od_student" id="od_student" class="form-control" required placeholder="รหัสนักเรียน">
											</div>
										</div>									
									</div>
									<div class="col-<?php echo $grid;?>-6">
										<div class="form-group">
											<div id="print_string">
											<div class="form-group has-feedback">
												<label class="control-label col-sm-3 col-md-3 col-lg-3">ชื่อ - สกุล</label>
												<div class="col-sm-9 col-md-9 col-lg-9">
													<input type="text" name="stu_name" class="form-control" placeholder="ชื่อ - สกุล" readonly required class="form-control">
												</div>										
											</div>
											</div>
										</div>
									</div>
									</fieldset>	
								</div>
								<div class="row">
									<fieldset class="content-group">
										<div class="col-<?php echo $grid;?>-6">
											<div class="form-group">
												<label class="control-label col-sm-3 col-md-3 col-lg-3">เทอม/ภาคเรียน</label>
												<div class="col-sm-9 col-md-9 col-lg-9">
													<select name="od_term" class="form-control" required>
														<option value="">เลือก เทอม/ภาคเรียน</option>
														<option value="1">เทอม/ภาคเรียน 1</option>
														<option value="2">เทอม/ภาคเรียน 2</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-<?php echo $grid;?>-6">
											<div class="form-group">
												<label class="control-label col-sm-3 col-md-3 col-lg-3">ภาคเรียน/ปีการศึกษา</label>
												<div class="col-sm-9 col-md-9 col-lg-9">
													<select name="od_year" class="form-control" required>
														<option value="">เลือก ภาคเรียน/ปีการศึกษา</option>
									<?php
										$yaer02=date("Y");
										$yaer02=$yaer02+543;
										$count02=1;
											while($count02<=5){  ?>
														<option value="<?php echo $yaer02;?>">ภาคเรียน/ปีการศึกษา <?php echo $yaer02;?></option>
									<?php		
												$yaer02=$yaer02-1;
												$count02=$count02+1; } ?>
													</select>												
												</div>
											</div>										
										</div>
									</fieldset>
								</div>
								<div class="row">
									<fieldset class="content-group">
										<div class="col-<?php echo $grid;?>-6">
											<div class="form-group">
												<label class="control-label col-sm-3 col-md-3 col-lg-3">สถานะการชำระ</label>
												<div class="col-sm-9 col-md-9 col-lg-9">
													<select name="os_id" class="form-control" required>
														<option value="">เลือก สถานะการชำระ</option>
												<?php
													$print_os="SELECT `os_id`,`os_text` FROM `overdue_status`";
													$print_osRs=rc_array($print_os);
													
													foreach($print_osRs as $key_rc=>$print_osRow){
														$os_id=$print_osRow["os_id"];
														$os_text=$print_osRow["os_text"]; ?>
														<option value="<?php echo $os_id;?>"><?php echo $os_text;?></option>
												<?php	}?>		
														
														
													</select>												
												</div>
											</div>
										</div>
										<div class="col-<?php echo $grid;?>-6">
											<div class="form-group">
												<label class="control-label col-sm-3 col-md-3 col-lg-3">ประเภทการชำระ</label>
												<div class="col-sm-9 col-md-9 col-lg-9">
													<select name="oc_id" class="form-control" required>
														<option value="">เลือก ประเภทการชำระ</option>
												<?php
													$print_oc="SELECT `oc_id`,`oc_text` FROM `overdue_category`";
													$print_ocRs=rc_array($print_oc);
													
													foreach($print_ocRs as $key_rc=>$print_ocRow){
														$oc_id=$print_ocRow["oc_id"];
														$oc_text=$print_ocRow["oc_text"]; ?>
														<option value="<?php echo $oc_id;?>"><?php echo $oc_text;?></option>
												<?php	} ?>
													</select>												
												</div>
											</div>										
										</div>
									</fieldset>
								</div>	
								<div class="row">
									<fieldset class="content-group">
										<div class="col-<?php echo $grid;?>-12">
											<center>
												<button type="submit" name="sub_system" value="sub_key" class="btn btn-success">บันทึก</button>
												<button type="reset" class="btn btn-warning">ล้างรายการ</button>
											</center>
										</div>
									</fieldset>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="overdue2" class="tab-pane fade">
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-success">
					<div class="panel-heading">เพิ่มข้อมูลนักเรียนค้างจ่าย (หลายรายการ)</div>
					<div class="panel-body">
<form class="form-horizontal" name="overdue_up" method="post" enctype="multipart/form-data" action="./?evaluation_mod=overdue_code">
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">
								<div class="panel panel-body">
									<div class="media no-margin">
										<div class="media-body">
											<h3 class="no-margin text-semibold">ดาวโหลด Excel เพื่มอัพโหลดเข้าสู่ระบบ</h3>
										</div>

										<div class="media-right media-middle">
											<i class="icon-file-presentation icon-3x text-blue-400"></i>
										</div>		
									</div>
								</div>
							</div>
							<div class="col-<?php echo $grid;?>-6">
								<div class="panel panel-body">
									<ul class="list-feed">
										<li>คลิกที่ icon <div class="icon-file-presentation"></div> เพื่อโหลดไฟส์สำหรับอัพโหลด</li>
										<li>จากนั้นนำไฟสที่ดาวน์โหลด มาแก้ไขเพิ่มรายการข้อมูลที่ต้องการอัพโหลด</li>
										<li>นำไฟสที่แก้ไขแล้ว มานำเข้าที่ปุ่มอัพโหลด</li>
										<li>ระบบอ่านข้อมูลที่อัพโหลดแล้ว กดปุ่ม Upload</li>
									</ul>
								</div>
							</div>
						</div><br>
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="form-group">
									<label class="col-<?php echo $grid;?>-2 control-label text-semibold">นำข้อมูลเข้าที่นี้ : </label>
									<div class="col-<?php echo $grid;?>-10">
										<input type="file" name="file_updata" class="file-input-extensions">
										<span class="help-block">อนุญาตเฉพาะนามสกุลไฟล์ที่เฉพาะเจาะจง ในตัวอย่างนี้เท่านั้น <code>xls</code>, <code>xlsx</code> อนุญาตให้ส่วนขยาย.</span>
									</div>
								</div>
								<input type="hidden" name="sub_system" value="up_excel">
							</div>
						</div>
</form>					
					</div>
				</div>
			</div>
		</div>
	</div>	
</div><br>

	

