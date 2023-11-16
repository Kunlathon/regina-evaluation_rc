<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">นักเรียนโควต้าภายใน&nbsp;>&nbsp;</span>ข้อมูลนักเรียนประสงค์มอบตัวเพื่อศึกษาต่อ</h4>
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
				<div class="col-<?php echo $grid;?>-12">
					<p class="text-semibold">นักเรียนประสงค์มอบตัวเพื่อศึกษาต่อ</p>
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<div class="form-group">	
							<select name="txt_year" id="txt_year"  data-placeholder="ปีการศึกษา..." class="select" required>
												<option></option>
								<optgroup>
									<?php
										$yaer01=date("Y");
										$yaer01=$yaer01+543;
										$yaer01=$yaer01+1;
									?>
												<option value="<?php echo $yaer01;?>">ปีการศึกษา <?php echo $yaer01;?></option>
									<?php
										$yaer02=date("Y");
										$yaer02=$yaer02+543;
										$count02=1;
											while($count02<=5){ 
												/*if($txt_year==$yaer02){
													$selected="selected";
												}else{
													$selected="";
												}*/
											?>
												<option value="<?php echo $yaer02;?>">ปีการศึกษา <?php echo $yaer02;?></option>
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
								<option value="3">อนุบาล 3 (กรณีนักเรียนฝากเรียน)</option>
								<option value="11">ประถมศึกษาปีที่ 1</option>
								<option value="31">มัธยมศึกษาปีที่ 1</option>
								<option value="41">มัธยมศึกษาปีที่ 4</option>										
						</select>
					</div>				
				</div>
			</div>
		</div>
	</div>
</div><br>

<div id="show_quota_dataall"></div>
