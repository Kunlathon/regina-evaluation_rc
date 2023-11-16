<?php
	include("view/database/pdo_data.php");
	include("view/database/class_pdo.php");
?>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ข้อมูลทางสถิติ</span> เรียนเสริมเย็น</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ข้อมูลทางสถิติ เรียนเสริมเย็น</span></a>
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
					<div class="col-<?php echo $grid;?>-4">
									<div class="form-group">
										<label>เทอม/ภาคเรียน</label>
										<select class="select" name="set_term" id="set_term">
												<option value="">เทอม/ภาคเรียน</option>
											<optgroup label="ภาคเรียน / เทอม">
												<option value="1">ภาคเรียน / เทอม 1</option>
												<option value="2">ภาคเรียน / เทอม 2</option>
											</optgroup>	
										</select>
									</div>
					</div>
					<div class="col-<?php echo $grid;?>-4">
									<div class="form-group">
										<label>ปีการศึกษา</label>
										<select class="select" name="set_year" id="set_year">
												<option value="">ปีการศึกษา</option>
											<optgroup label="ปีการศึกษา...">
									<?php
										$yaer02=date("Y");
										$yaer02=$yaer02+543;
										$count02=1;
											while($count02<=5){  ?>
												<option value="<?php echo $yaer02;?>">ปีการศึกษา <?php echo $yaer02;?></option>
									<?php		
												$yaer02=$yaer02-1;
												$count02=$count02+1; } ?>
											</optgroup>
										</select>
									</div>
					</div>
					<div class="col-<?php echo $grid;?>-4">
								<div class="form-group">
										<label>ระดับชั้น</label>
										<select class="select" name="set_class" id="set_class">
												<option value="">ระดับชั้น</option>
											<optgroup label="อนุบาล">
												<option value="3">อนุบาล</option>
											</optgroup>
											<optgroup label="ประถมศึกษา">
												<option value="11">ประถม</option>
											</optgroup>
											<optgroup label="มัธยมศึกษา">
												<option value="31">มัธยมตอนต้น</option>
												<option value="41">มัธยมตอนปลาย</option>
											</optgroup>
										</select>
								</div>
					</div>
				</div>
			
			</div>
		</div>
	</div>
</div>

<div id="print_supplementary"></div>