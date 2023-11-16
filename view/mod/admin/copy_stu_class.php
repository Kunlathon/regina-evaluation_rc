<?php
	include("view/database/pdo_data.php");
	include("view/database/pdo_conndatastu.php");	
	include("view/database/pdo_admission.php");	
	include("view/database/regina_student.php");	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">การจัดการและการบริหารระบบ</span> คัดลอกนักเรียนเลือนภาคเรียน</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>คัดลอกนักเรียนเลือนภาคเรียน</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><hr>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel">
			<div class="panel-heading bg-primary">
				<h6 class="panel-title">คัดลอกนักเรียนเลือนภาคเรียน</h6>
			</div>
			
			<div class="panel-body">
				<div class="row">
					<fieldset class="content-group">
						<div class="col-<?php echo $grid;?>-6">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5">ปีการศึกษา (Academic Year)</label>
								<div class="col-<?php echo $grid;?>-7">									
									<select name="stu_year" id="stu_year" class="select" data-placeholder="เลือกรายการ (Select a State)...">
										    <option></option>
										<optgroup label="ปีการศึกษา (Academic Year)">
											<option value="2566">2566</option>
											<option value="2565">2565</option>
											<option value="2564">2564</option>
											<option value="2563">2563</option>
										</optgroup>
									</select>			
								</div>							
							</div>
						</div>
						<div class="col-<?php echo $grid;?>-6">
							<div class="form-group">
								<button type="button" name="button_run" id="button_run" class="btn bg-success-400 btn-ladda btn-ladda-progress" data-style="slide-left"><span class="ladda-label">โหลดข้อมูล (Load Data)</span></button>
								<button type="button" id="cp_csc" class="btn bg-info-400 btn-ladda btn-ladda-progress" data-style="slide-right"><span class="ladda-label">ล้างรายการ (Clear The List)</span></button>								
							</div>				
						</div>					
					</fieldset>
				</div>
			</div>
			
		</div>	
	</div>
</div><hr>
<div id="stu_class"></div>