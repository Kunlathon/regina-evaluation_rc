<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">กิจกรรมชุมนุม&nbsp;>&nbsp;</span>คัดลอกข้อมูลภาคเรียนถัดไป&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>&nbsp;คัดลอกข้อมูลภาคเรียนถัดไป&nbsp;</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>


<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-success no-border">
			<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
			<span class="text-semibold">คำแนะนำ&nbsp;:&nbsp;</span>คัดลอกข้อมูล&nbsp;กิจกรรมชุมนุมจากภาคเรียนที่&nbsp;1&nbsp;ไปเป็นข้อมูลสำหรับภาคเรียนที่&nbsp;2&nbsp;ของปีการศึกษา&nbsp;นั้นๆ&nbsp;ถ้ามีการเปลี่ยนเปลียนข้อมูลกิจกรรม&nbsp;ในภาคเรียนต่อไป&nbsp;ให้คำเนินการคัดลอกให้เสร็จก่อน&nbsp;จากนั้นค่อยทำการแก้ไขข้อมูลเป็นลำดับต่อไป
		</div>
	</div>
</div>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger no-border">
			<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
			<span class="text-semibold">คำเตือน&nbsp;!&nbsp;</span>ข้อมูลที่คัดลอกไปยังภาคเรียนที่&nbsp;2&nbsp;ถ้าข้อมูลภาคเรียนที่&nbsp;2&nbsp;มีการเปลียนแปลงข้อมูลจะถูกย้อนกลับไปเป็นข้อมูลเดิมในภาคเรียนที่&nbsp;1 
		</div>	
	</div>
</div>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-danger">
			<div class="row" style="text-align: center;">
				<div class="col-<?php echo $grid;?>-4">
					<div>คัดลอกข้อมูล&nbsp;กิจกรรมชุมนุม&nbsp;ภาคเรียน&nbsp;ที่&nbsp;1&nbsp;</div>
				</div>
				<div class="col-<?php echo $grid;?>-4">
					<select class="select-menu-color" name="ACDT_Y" id="ACDT_Y" placeholder="ปีการศึกษา..." data-placeholder="ปีการศึกษา...">
							<option></option>
						<optgroup label="ปีการศึกษา">
							<option value="2565">ปีการศึกษา 2565</option>
							<option value="2564">ปีการศึกษา 2564</option>
						</optgroup>
					</select>
				</div>
				<div class="col-<?php echo $grid;?>-4">
					<button type="button" name="ACDT_But" id="ACDT_But" class="btn border-slate text-slate-800 btn-flat">คัดลอกข้อมูล</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="ACDT_Run"></div>
