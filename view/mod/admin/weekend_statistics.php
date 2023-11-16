
<?php
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">RC&nbsp;Happy&nbsp;Weekend&nbsp;>&nbsp;</span>ยอดลงทะเบียน&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>&nbsp;ยอดลงทะเบียน&nbsp;</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-brown">
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<select class="select" name="ws_ty" id="ws_ty" data-placeholder="ภาคเรียน / ปีการศึกษา...">
						<option></option>
						<option value="1/2566">ภาคเรียนที่ 1 ปีการศึกษา 2566</option>
						<option value="1/2565">ภาคเรียนที่ 1 ปีการศึกษา 2565</option>
						<option value="2/2565">ภาคเรียนที่ 2 ปีการศึกษา 2565</option>
					</select>				
				</div>
			</div>
		</div>
	</div>
</div>


<div id="RunStatistics"></div>