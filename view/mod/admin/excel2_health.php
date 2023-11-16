<?php
//database:
	include("view/database/pdo_data.php");//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	include("view/database/class_admin.php");//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//-------------------------------------------------------------------------------------------------------------------
	include("view/database/pdo_health.php");//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	include("view/database/class_health.php");//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
//	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ข้อมูลการตรวจสุขภาพนักเรียน</span> อัพโหลด ระบบ SWIS Plus ข้อมูลชุดที่ 2</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ข้อมูลการตรวจสุขภาพนักเรียน อัพโหลด ระบบ SWIS Plus ข้อมูลชุดที่ 2</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-default">
			<div class="panel-heading">ข้อมูลการตรวจสุขภาพนักเรียน อัพโหลด ระบบ SWIS Plus ข้อมูลชุดที่ 2</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<div class="form-group">
							<label class="control-label col-<?php echo $grid;?>-2">ภาคเรียน</label>
							<div class="col-<?php echo $grid;?>-10">
								<select name="ex2_term" id="ex2_term" class="select" required="required">
									<option value="">เลือกภาคเรียน</option>
									<option value="1">ภาคเรียนที่ 1</option>
									<option value="2">ภาคเรียนที่ 2</option>
								</select>									
							</div>
						</div>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<div class="form-group">
							<label class="control-label col-<?php echo $grid;?>-2">ปีการศึกษา</label>
							<div class="col-<?php echo $grid;?>-10">
								<select name="ex2_year" id="ex2_year" class="select" required="required">
							<option value="">เลือกปีการศึกษา</option>
						<?php
							$txt_y=date("Y");
							$txt_y=$txt_y+543;
							$count_txt=1;
							while($count_txt<=5){
							?>
							<option value="<?=$txt_y;?>">ปีการศึกษา <?=$txt_y;?></option>
			<?php $count_txt=$count_txt+1;	
				  $txt_y=$txt_y-1;	
											}	?>	
								</select>							
							</div>
						</div>					
					</div>
				</div><hr>			
			</div>
		</div>
	</div>
</div>
<div id="run_excel2"></div>