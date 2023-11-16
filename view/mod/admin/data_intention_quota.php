<?php
	include("view/database/pdo_quota.php");
	include("view/database/pdo_data.php");
	include("view/database/class_quota.php");
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">นักเรียนโควต้าภายใน </span>ข้อมูลนักเรียนแสดงความจำนงสิทธิ์โควตาภายใน</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ข้อมูลนักเรียนแสดงความจำนงสิทธิ์โควตาภายใน</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><hr>

<div class="row">
	<div class="col-<?php echo $grid?>-12">
		<div class="alert alpha-green-600 border-green alert-styled">
			<div class="row">
				<div class="col-<?php echo $grid;?>-4">
					<div class="form-group">	
							<select name="txt_year" id="txt_year"  data-placeholder="ปีการศึกษา..." class="select" required>
								<option></option>
									<!--		<optgroup label="ปีการศึกษา ล่วงหน้า 5 ปี">
									<?php
									/*	$yaer01=date("Y");
										$yaer01=$yaer01+543;
										$count01=1;
											while($count01<=5){  ?>
												<option value="<?php echo $yaer01;?>">ปีการศึกษา <?php echo $yaer01;?></option>
									<?php		$yaer01=$yaer01+1; 
												$count01=$count01+1; } */?>	
											</optgroup> -->
											<optgroup>
									<?php
										$yaer02=date("Y");
										$yaer02=$yaer02+543;
										$count02=1;
											while($count02<=5){ 
												if($txt_year==$yaer02){
													$selected="selected";
												}else{
													$selected="";
												}
											?>
												<option value="<?php echo $yaer02;?>" <?php echo $selected;?>>ปีการศึกษา <?php echo $yaer02;?></option>
									<?php		
												$yaer02=$yaer02-1;
												$count02=$count02+1; } ?>
								</optgroup>
							</select>
					</div>
				</div>
				<div class="col-<?php echo $grid;?>-4">
					<div class="form-group">	
						<select name="txt_level" id="txt_level"  data-placeholder="ระดับชั้น..." class="select" required>
								<option></option>
							<optgroup label="ประถมศึกษา">
								<option value="23">ประถมศึกษาปีที่ 6</option>
							</optgroup>
							<optgroup label="มัธยมศึกษาตอนต้น">
								<option value="33">มัธยมศึกษาปีที่ 3</option>
							</optgroup>											
						</select>
					</div>				
				</div>	
				<div class="col-<?php echo $grid;?>-4">
					<div class="form-group">	
						<select name="txt_MaintainRights" id="txt_MaintainRights"  data-placeholder="ยืนสิทธิ์จำนงโควตา..." class="select" required>
							<option></option>
							<option value="รักษาสิทธิ์">รักษาสิทธิ์</option>
							<option value="สละสิทธิ์">สละสิทธิ์</option>										
						</select>
					</div>				
				</div>				
			</div>
		</div>
	</div>
</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div id="data_intention"></div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
