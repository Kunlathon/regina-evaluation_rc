<?php
	//include("view/database/pdo_data.php");
	//include("view/database/class_admin.php");
	//include("view/database/class_pdo.php");	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">กิจกรรมชุมนุม&nbsp;>&nbsp;</span>ลงทะเบียน&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=register_activity" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ลงทะเบียน&nbsp;</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<h5 class="content-group text-semibold">
			ลงทะเบียนนักเรียนเข้ากิจกรรมสำหรับนักเรียน
			<small class="display-block">ดำเนินการลงทะเบียนเรียนกิจกรรม&nbsp;By&nbsp;Admin</small>
		</h5>
	</div>
</div>
<form action="./?evaluation_mod=activity_admin" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<div class="row">
	<div class="col-<?php echo $grid;?>-2">
		<div class="panel panel-body border-top-pink">
			<select class="select"  name="ra_term" id="ra_term" data-placeholder="ภาคเรียน..." required="required">
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
			<select class="select"  name="ra_year" id="ra_year" data-placeholder="ปีการศึกษา..." required="required">
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
		<div class="panel panel-body border-top-pink">
				
			<select class="select-menu-color" name="ra_sudkey" id="ra_sudkey" data-placeholder="รายชื่อนักเรียน..." required="required">
					<option></option>
				<optgroup label="รายชื่อนักเรียน...">
							
				</optgroup>			
			</select>
				
		</div>
	</div>
	
</div>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<button type="submit" class="btn btn-default">ดำเนินการลงทะเบียน</button>
		<button type="button" id="GoTo" class="btn btn-default">ล้างรายการ</button>
	</div>
</div>

</form>