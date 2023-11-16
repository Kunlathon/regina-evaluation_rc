<?php
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
	//include("view/database/class_pdo.php");	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ข้อมูล </span>นักเรียนใหม่ รายงานส่งห้องวัดผล</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ข้อมูล นักเรียนใหม่ รายงานส่งห้องวัดผล</span></a>
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
								<select class="select-search" name="stu_year" id="stu_year"> 
									<option value="">เลือก เทอม/ปีการศึกษา</option>
							<?php
									$count=0;
									while($count<=50){ 
										$data_y=(date("Y")+543)-$count; ?>
										
									<option value="<?php echo $data_y;?>"><?php echo $data_y;?></option>
									
										
							<?php		$count=$count+1;
									} ?>
								</select>
							</div>
						</div>
						<div class="col-<?php echo $grid;?>-6">
							<div class="form-group">
								<select class="select-search" name="stu_class" id="stu_class">
									<option value="">เลือกระดับชั้น</option>				
									<option value="3">อนุบาล 3</option>				
									<option value="11">ประถมศึกษาปีที่ 1</option>				
									<option value="12">ประถมศึกษาปีที่ 2</option>				
									<option value="13">ประถมศึกษาปีที่ 3</option>				
									<option value="21">ประถมศึกษาปีที่ 4</option>				
									<option value="22">ประถมศึกษาปีที่ 5</option>				
									<option value="23">ประถมศึกษาปีที่ 6</option>				
									<option value="31">มัธยมศึกษาปีที่ 1</option>					
									<option value="32">มัธยมศึกษาปีที่ 2</option>					
									<option value="33">มัธยมศึกษาปีที่ 3</option>					
									<option value="41">มัธยมศึกษาปีที่ 4</option>					
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