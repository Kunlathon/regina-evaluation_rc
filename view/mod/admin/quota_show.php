<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">นักเรียนโควต้าภายใน </span>ข้อมูลนักเรียนได้รับสิทธิ์โควต้า</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ข้อมูลนักเรียนได้รับสิทธิ์โควต้า</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-info">

			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div class="form-group">	
							<select name="txt_year" id="txt_year"  data-placeholder="ปีการศึกษา..." class="select" required>
												<option></option>
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
				<div class="col-<?php echo $grid;?>-6">
					<div class="form-group">	
						<select name="txt_level" id="txt_level"  data-placeholder="ระดับชั้น..." class="select" required>
							<option></option>
							<optgroup label="อนุบาล">
								<option value="2">อนุบาล ฝากเรียน</option>								
								<option value="3">อนุบาล 3</option>
							</optgroup>
							<optgroup label="ประถมศึกษา">
								<option value="23">ประถมศึกษาปีที่ 6</option>
							</optgroup>
							<optgroup label="มัธยมศึกษาตอนต้น">
								<option value="33">มัธยมศึกษาปีที่ 3</option>
							</optgroup>											
						</select>
					</div>				
				</div>
			</div>
	
		</div>
	</div>
</div>
<div id="data_stu"></div>