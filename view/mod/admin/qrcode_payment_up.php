<!--<div class="content col-sm-12 col-md-12 col-lg-12">-->




<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ค่าธรรมเนียมการศึกษา </span>สร้าง Execl นำเข้าสู่ระบบ SCB</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>อัพโหลด QR Code ชำระค่าบำรุงการศึกษา</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>


<div class="row">
	<div class="col-<?php echo $grid;?>-12">

			<div class="panel panel-success">
				<div class="panel-heading">นำไฟสรูป QR Code ที่ได้มาจากระบบ SCB มานำเข้า ที่นี้</div>
				<div class="panel-body">
				<p class="content-group-sm">กรุณานำเข้ารูป ไม่เกิน 20 รูป ต่อ 1 ครั้ง และ อัพโหลด </p>
	<form method="post" enctype="multipart/form-data" action="./?evaluation_mod=qrcode_payment_up_code" name="qrcode_payment_up">
					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6">
							<label>ภาคเรียนที่</label>
								<select name="pd_term" class="select-matched-customize" required="required">
									<option value="">เลือกภาคเรียน</option>
									<option value="1">ภาคเรียนที่ 1</option>
									<option value="2">ภาคเรียนที่ 2</option>
								</select>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6">
							<label>ปีการศึกษา</label>
								<select name="pd_year" class="select-matched-customize" required="required">
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
							<div class="form-group">
								<label class="col-lg-2 control-label text-semibold">นำเข้าไฟสรูป QR Code</label>
								<div class="col-lg-10">
								
									<input type="file" class="file-input-ajax" multiple="multiple" name="imgqrcode[]" data-browse-class="btn btn-primary" data-remove-class="btn btn-default">
									<span class="help-block">รองรับไฟส รูป jpg และ png</span>
								
					
								</div>
							</div>
							
							
							<!--<div class="form-group">
								<label class="control-label text-semibold">นำเข้าไฟสรูป QR Code</label>
									<input type="file" multiple="multiple" name="imgqrcode[]" class="file-input2"data-browse-class="btn btn-primary" data-remove-class="btn btn-default" required="required">
									<span class="help-block">รองรับไฟส รูป jpg และ png</span>
							</div>-->
						</div>
					</div>
	</form>			
				</div>
			</div>

	</div>
</div><br>
			


					
