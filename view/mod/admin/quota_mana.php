<?php
	include("view/database/pdo_quota.php");
	include("view/database/pdo_data.php");
	include("view/database/class_quota.php");
?>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">นักเรียนโควต้าภายใน&nbsp;>&nbsp;</span>แก้ไข&nbsp;โควตานักเรียน</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>แก้ไข&nbsp;โควตานักเรียน</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-info">	
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div class="form-group">	
							<select class="select" name="txt_year" id="txt_year"  data-placeholder="ปีการศึกษา..." class="select" required>
												<option></option>
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
				<div class="col-<?php echo $grid;?>-6">
					<div class="form-group">	
						<select class="select" name="txt_level" id="txt_level"  data-placeholder="ระดับชั้น..." class="select" required>
							<option></option>
							<optgroup label="ปฐมวัย">
								<option value="3">อนุบาลศึกษาปีที่ 3</option>
							</optgroup>
							<optgroup label="ประถมศึกษา">
								<option value="23">ประถมศึกษาปีที่ 6</option>
							</optgroup>
							<optgroup label="มัธยมศึกษาตอนต้น">
								<option value="33">มัธยมศึกษาปีที่ 3</option>
							</optgroup>											
						</select>
					</div>				
				</div>
			</div>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div id="show_stu">
						<select class="select-search" name="data_stu" id="data_stu" data-placeholder="ค้นหารายชื่อ...">
							<option></option>
							<optgroup label="รายชื่อนักเรียน"></optgroup>
						</select>		
					</div>
				</div>
			</div>
			<input type="hidden"  name="myname" value="<?php echo $myname;?>">
			<input type="hidden"  name="group" value="<?php echo $group;?>">			
		</div>
	</div>
</div><br>

<div id="show_qsq"></div>

