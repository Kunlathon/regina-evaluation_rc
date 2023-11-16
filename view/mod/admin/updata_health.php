<?php
//database:
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
//	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ข้อมูลการตรวจสุขภาพนักเรียน</span> อัพโหลดข้อมูลการตรวจ</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ข้อมูลการตรวจสุขภาพนักเรียน อัพโหลดข้อมูลการตรวจ</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
<form  name="up_form_health" id="up_form_health" method="post" enctype="multipart/form-data" action="./?evaluation_mod=updata_health_code" name="updata_health">
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-default">
			<div class="panel-heading">อัพโหลดข้อมูลการตรวจ ผ่านโปรแกรม Microsoft Excel</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<div class="form-group">
							<label class="control-label col-<?php echo $grid;?>-2">ภาคเรียน</label>
							<div class="col-<?php echo $grid;?>-10">
								<select name="uh_term" id="uh_term" class="select-matched-customize" required="required">
									<option value="">เลือกภาคเรียน</option>
									<option value="1">ภาคเรียนที่ 1</option>
									<option value="2">ภาคเรียนที่ 2</option>
								</select>	
								<div id="uh_term-null"></div>								
							</div>
						</div>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<div class="form-group">
							<label class="control-label col-<?php echo $grid;?>-2">ปีการศึกษา</label>
							<div class="col-<?php echo $grid;?>-10">
								<select name="uh_year" id="uh_year" class="select-matched-customize" required="required">
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
								<div id="uh_year-null"></div>							
							</div>
						</div>					
					</div>
				</div><hr>
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<div class="form-group">
							<label class="col-<?php echo $grid;?>-2 control-label text-semibold">นำเข้า Excel</label>
							<div class="col-<?php echo $grid;?>-10">
								<input type="file" class="file-input-ajax" name="uh_health" id="uh_health"  required="required" data-browse-class="btn btn-primary" data-remove-class="btn btn-default" data-show-upload="false">
								<span class="help-block">รองรับไฟส รูป xlsx และ xls</span>
								<div id="uh_health-null"></div>
							</div>  
						</div>					
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<div class="panel panel-body">
							<a href="view/excel/data_health.xlsx">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin text-semibold">ดาวโหลด Excel เพื่มอัพโหลดเข้าสู่ระบบ</h3>
									</div>

									<div class="media-right media-middle">
										<i class="icon-file-presentation icon-3x text-blue-400"></i>
									</div>		
								</div>
							</a>
						</div>					
					</div>
				</div>	
				
				<br>
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<button type="button" name="submit_upload" id="submit_upload" class="btn btn-success">อัพโหลด</button> 	
						<button type="button" name="but_delete" id="but_delete"  class="btn btn-danger">ล้างรายการ</button>				
					</div>
				</div>


			</div>
		</div>
	</div>
</div>



<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
</form>

