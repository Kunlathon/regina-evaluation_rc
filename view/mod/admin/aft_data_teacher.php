<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ข้อมูลครูผู้สอน </span>  ประเมินความพึงพอใจการจัดการเรียนการสอน </h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>การจัดการ ประเมินความพึงพอใจการจัดการเรียนการสอน</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=aft_data_teacher" class="btn btn-link  text-size-small"><span>ข้อมูลครูผู้สอน ประเมินความพึงพอใจการจัดการเรียนการสอน</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
<form name="aft_data_teacher" method="post" action="./?evaluation_mod=aft_teacher">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-body">
						<div class="row">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="form-group">
									<label>ลำดับ</label>
										<select name="txt_term"  data-placeholder="ภาคเรียน..." class="select" required>
											<option></option>
											<optgroup>
												<option value="1">ภาคเรียน 1</option>
												<option value="2">ภาคเรียน 2</option>
											</optgroup>
									</select>
								</div>							
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="form-group">
									<label>ปีการศึกษา</label>
										<select name="txt_year"  data-placeholder="ปีการศึกษา..." class="select" required>
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
											while($count02<=5){  ?>
												<option value="<?php echo $yaer02;?>">ปีการศึกษา <?php echo $yaer02;?></option>
									<?php		
												$yaer02=$yaer02-1;
												$count02=$count02+1; } ?>
											</optgroup>
									</select>
								</div>
							</div>							
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12">
							<button type="submit" class="btn btn-success">Enter...</button>
							</div>
						</div>
					</div>
                </div>		
		</div>
	</div>
</form>
