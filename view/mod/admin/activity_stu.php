<?php
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
	//include("view/database/class_pdo.php");	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">กิจกรรมชุมนุม&nbsp;>&nbsp;</span>รายชื่อนักเรียนไม่ลงกิจกรรม</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>รายชื่อนักเรียนไม่ลงกิจกรรม</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<form class="">
					<div class="row">
						<div class="col-<?php echo $grid;?>-6">
							<div class="form-group">
								<select class="select-search" name="stu_year" id="stu_year" data-placeholder="เลือก เทอม/ปีการศึกษา"> 
									<option></option>
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
						<div class="col-<?php echo $grid;?>-6">
							<div class="form-group">
								<select class="select" name="stu_class" id="stu_class" data-placeholder="เลือระดับชั้น">
									<option></option>
										<option value="2123">ประถมศึกษาตอนปลาย</option>
										<option value="3133">มัธยมศึกษาตอนต้น</option>
										<option value="4143">มัธยมศึกษาตอนปลาย</option>
										<option value="3142">มัธยมศึกษาปีที่ 1-5</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="studata_room"></div>

