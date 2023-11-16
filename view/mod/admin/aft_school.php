<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">สรุปภาพรวมทั้งโรงเรียน </span>  ประเมินความพึงพอใจการจัดการเรียนการสอน </h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>การจัดการ ประเมินความพึงพอใจการจัดการเรียนการสอน</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=favorite_data" class="btn btn-link  text-size-small"><span>สรุปภาพรวมทั้งโรงเรียน ประเมินความพึงพอใจการจัดการเรียนการสอน</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
						<div class="row">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="form-group">
									<label>ปีการศึกษา</label>
										<select name="txt_year" id="txt_year" data-placeholder="ปีการศึกษา..." class="select">
											<option></option>
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
							<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="form-group">
								<label>เทอม/ภาคเรียน</label>
								<select name="txt_class" id="txt_class" data-placeholder="เทอม/ภาคเรียน..." class="select">
									<option></option>
									<optgroup>
										<option value="1">ภาคเรียนที่ 1</option>
										<option value="2">ภาคเรียนที่ 2</option>
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