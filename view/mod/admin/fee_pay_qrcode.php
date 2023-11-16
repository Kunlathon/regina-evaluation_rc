<?php
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
	//include("view/database/class_pdo.php");	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ค่าธรรมเนียมการศึกษา </span>สร้าง Execl นำเข้าสู่ระบบ SCB</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ค่าธรรมเนียมการศึกษา สร้าง Execl นำเข้าสู่ระบบ SCB</span></a>
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
						<div class="col-<?php echo $grid;?>-4">
							<div class="form-group">
								<select class="select-search" name="stu_year" id="stu_year"> 
									<option value="">เลือก เทอม/ปีการศึกษา</option>
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
						<div class="col-<?php echo $grid;?>-4">
							<div class="form-group">
								<select class="select" name="stu_class" id="stu_class">
									<option value="">เลือระดับชั้น</option>
										<optgroup label="อนุบาล">
				<?php
					$data_leve3=new level("3","3");
					foreach($data_leve3->print_level as $rc_key=>$data_leveRo3){ ?>
											<option value="<?php echo $data_leveRo3["IDLevel"];?>"><?php echo $data_leveRo3["Lname"];?></option>			
				<?php	} ?>
										</optgroup>
										<optgroup label="ประถมศึกษา">
				<?php
					$data_leve1123=new level("11","23");
					foreach($data_leve1123->print_level as $rc_key=>$data_leveRo1123){ ?>
											<option value="<?php echo $data_leveRo1123["IDLevel"];?>"><?php echo $data_leveRo1123["Lname"];?></option>			
				<?php	} ?>											
										</optgroup>
										<optgroup label="มัธยมศึกษา">
				<?php
					$data_leve3143=new level("31","43");
					foreach($data_leve3143->print_level as $rc_key=>$data_leveRo3143){ ?>
											<option value="<?php echo $data_leveRo3143["IDLevel"];?>"><?php echo $data_leveRo3143["Lname"];?></option>			
				<?php	} ?>										
										</optgroup>
								</select>
							</div>
						</div>
						<div class="col-<?php echo $grid;?>-4">
							<div class="form-group">
								<select class="select" name="stu_room" id="stu_room">
									<option value="">เลือกห้องเรียน</option>
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

