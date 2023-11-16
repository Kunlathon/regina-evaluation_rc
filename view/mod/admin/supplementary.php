<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ข้อมูลการเงิน</span> ค่าเสริมเย็นสร้าง QRCode</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ข้อมูลการเงิน ค่าเสริมเย็นสร้าง QRCode</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
<!-- /page header -->	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-body">
						<div class="row">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="form-group">
									<label>ภาคเรียน/เทอม</label>
									<select name="txt_term" id="txt_term" data-placeholder="ภาคเรียน/เทอม..." class="select">
											<option></option>
											<option value="1">ภาคเรียน/เทอม 1</option>
											<option value="2">ภาคเรียน/เทอม 2</option>
									</select>
								</div>							
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="form-group">
									<label>ปีการศึกษา</label>
										<select name="txt_year" id="txt_year" data-placeholder="ปีการศึกษา..." class="select">
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
					</div>
                </div>		
		</div>
	</div>
	<div id="print_class"></div>