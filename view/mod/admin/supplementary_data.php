<?php
	include("view/database/pdo_data.php");
	include("view/database/class_pdo.php");
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ข้อมูลนักเรียน</span> เรียนเสริมเย็น</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ข้อมูลนักเรียน เรียนเสริมเย็น</span></a>
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
												<option value="11">ประถมศึกษาปีที่ 1</option>
												<option value="12">ประถมศึกษาปีที่ 2</option>
												<option value="13">ประถมศึกษาปีที่ 3</option>
												<option value="21">ประถมศึกษาปีที่ 4</option>
												<option value="22">ประถมศึกษาปีที่ 5</option>
												<option value="23">ประถมศึกษาปีที่ 6</option>
											</optgroup>
											<optgroup label="มัธยมศึกษาตอนต้น">
												<option value="31">มัธยมศึกษาปีที่ 1</option>
												<option value="32">มัธยมศึกษาปีที่ 2</option>
												<option value="33">มัธยมศึกษาปีที่ 3</option>
											</optgroup>											
											<optgroup label="มัธยมศึกษาปลาย">
												<option value="41">มัธยมศึกษาปีที่ 4</option>
												<option value="42">มัธยมศึกษาปีที่ 5</option>
												<option value="43">มัธยมศึกษาปีที่ 6</option>
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