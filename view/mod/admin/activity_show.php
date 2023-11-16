<?php
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
	//include("view/database/class_pdo.php");	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">กิจกรรมชุมนุม&nbsp;>&nbsp;</span>รายชื่อกิจกรรม&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>รายชื่อกิจกรรม</span></a>
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
								<select class="select-search" name="stu_year" id="stu_year" data-placeholder="เลือก เทอม/ปีการศึกษา" > 
									<option value=""></option>
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
								<select class="select-search" name="stu_class" id="stu_class" data-placeholder="เลือก เทอม/ปีการศึกษา">
									<option></option>
								<optgroup label="ประถมศึกษาตอนปลาย">
									<option value="21">ประถมศึกษาปีที่ 4</option>
									<option value="22">ประถมศึกษาปีที่ 5</option>
									<option value="23">ประถมศึกษาปีที่ 6</option>
								</optgroup>
								<optgroup label="มัธยมศึกษาตอนต้น">
									<option value="31">มัธยมศึกษาปีที่ 1</option>
									<option value="32">มัธยมศึกษาปีที่ 2</option>
									<option value="33">มัธยมศึกษาปีที่ 3</option>
									<option value="93">มัธยมศึกษาปีที่ 1-3</option>
								</optgroup>
								<optgroup label="มัธยมศึกษาตอนปลาย">
									<option value="41">มัธยมศึกษาปีที่ 4</option>
									<option value="42">มัธยมศึกษาปีที่ 5</option>
									<option value="43">มัธยมศึกษาปีที่ 6</option>
									<option value="94">มัธยมศึกษาปีที่ 4-6</option>
								</optgroup>			
			

								</select>
							</div>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="stu_room"></div>

