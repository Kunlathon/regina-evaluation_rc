<?php
	//include("view/database/pdo_data.php");
	//include("view/database/class_admin.php");
	//include("view/database/class_pdo.php");	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">กิจกรรมชุมนุม&nbsp;>&nbsp;</span>รายชื่อนักเรียนลงกิจกรรม&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>&nbsp;รายชื่อนักเรียนลงกิจกรรม&nbsp;</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-2">
		<div class="panel panel-body border-top-pink">
			<select class="select"  name="ra_term" id="ra_term" data-placeholder="ภาคเรียน...">
					<option></option>
				<optgroup label="เทอม / ภาคเรียน">
					<option value="1" selected="selected">1</option>
					<option value="2">2</option>
				</optgroup>
			</select>
		</div>
	</div>

	<div class="col-<?php echo $grid;?>-2">
		<div class="panel panel-body border-top-pink">
			<select class="select"  name="ra_year" id="ra_year" data-placeholder="ปีการศึกษา...">
					<option></option>
				<optgroup label="ปีการศึกษา">
					<option value="2566">2566</option>
					<option value="2565">2565</option>
					<option value="2564">2564</option>
					<option value="2563">2563</option>
				</optgroup>
			</select>
		</div>
	</div>

	<div class="col-<?php echo $grid;?>-8">
		<div class="panel panel-body border-top-pink" style="text-align: center;">
			<select class="select"  name="ra_class" id="ra_class" data-placeholder="ระดับชั้น...">
					<option></option>
				<optgroup label="ระดับชั้น">
					<option value="2123">ประถมศึกษาตอนปลาย</option>
					<option value="3133">มัธยมศึกษาตอนต้น</option>
					<option value="4143">มัธยมศึกษาตอนปลาย</option>
					<option value="3142">มัธยมศึกษาปีที่ 1-5</option>
				</optgroup>
			</select>
		</div>
	</div>
	
</div>

<div id="ra_report">
	
</div>
