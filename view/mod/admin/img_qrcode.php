
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ค่าธรรมเนียมการศึกษา </span>รายการ QR Code ชำระค่าบำรุงการศึกษา</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>รายการ QR Code ชำระค่าบำรุงการศึกษา</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

	
	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-success">
				<div class="panel-heading">QR Code ชำระค่าบำรุงการศึกษา</div>
				<div class="panel-body">

					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6">
							<label>ภาคเรียนที่</label>
								<select name="pd_term" id="pd_term" class="select-matched-customize" required="required">
									<option value="">เลือกภาคเรียน</option>
									<option value="1">ภาคเรียนที่ 1</option>
									<option value="2">ภาคเรียนที่ 2</option>
								</select>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6">
							<label>ปีการศึกษา</label>
								<select name="pd_year" id="pd_year" class="select-matched-customize" required="required">
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
					</div><hr>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<center><button type="button" id="stcqrcode" class="btn btn-info">ค้นหา QR Code ชำระค่าบำรุงการศึกษา</button></center>
						</div>
					</div>
			
				</div>
			</div>
			<div id="print_qrcode"></div>
		</div>	
	</div>


						