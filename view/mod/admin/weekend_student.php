<?php
	include("view/database/pdo_weekend.php");
	include("view/database/class_weekend.php");
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">RC&nbsp;Happy&nbsp;Weekend&nbsp;>&nbsp;</span>ข้อมูลการลงทะเบียน&nbsp;รายบุคคล&nbsp;&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=weekend_use" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>&nbsp;ข้อมูลการลงทะเบียน&nbsp;รายบุคคล&nbsp;&nbsp;</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel">
			<div class="panel-heading bg-blue">
				<h6 class="panel-title">รายชื่อผู้ลงทะเบียนทั้งหมด</h6>
			</div>

			<div class="panel-body">
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<select class="select" data-placeholder="เลือกภาคเรียน / ปีการศึกษา" name="ws_yt" id="ws_yt">
							<option></option>
							<option value="1/2566">ภาคเรียนที่ 1 ปีการศึกษา 2566</option>
							<option value="1/2565">ภาคเรียนที่ 1 ปีการศึกษา 2565</option>
							<option value="2/2565">ภาคเรียนที่ 2 ปีการศึกษา 2565</option>

						</select>					
					</div>
					<div class="col-<?php echo $grid;?>-9">
					
						
							<select class="select-results-color" data-placeholder="ค้นหารายชื่อผู้ลงทะเบียน" name="ws_stu" id="ws_stu">
								<option></option>
					
								<option value=""></option>

							</select>						
					

					
					</div>
				</div>					
			</div>
		</div>
	</div>
</div>


<div id="RunTxws"></div>