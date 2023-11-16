<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">การจัดการและการบริหารระบบ </span>อัพโหลดข้อมูลนักเรียนจากระบบ รับสมัครนักเรียนใหม่</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>อัพโหลดข้อมูลนักเรียนจากระบบ รับสมัครนักเรียนใหม่</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
<form name="studentnew_runing" accept-charset="UTF-8" method="post">
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-primary">
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="text-primary text-uppercase text-semibold">
							ระบบจากทำการโหลดข้อมูลจากฐานข้อมูลรับสมัครนักเรียนเข้าสู่ฐานข้อมูลสารสนเทศนักเรียน
						</div>				
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<select data-placeholder="เลือกปีการศึกษา..." name="runing_year" id="runing_year" class="select text-primary text-uppercase text-semibold text-size-small">
								<option></option>
							<optgroup label="ปีการศึกษา">
								<option value="2565">ปีการศึกษา 2565</option>
								<option value="2564">ปีการศึกษา 2564</option>
								<option value="2563">ปีการศึกษา 2563</option>
							</optgroup>
						</select>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<center>
							<button type="button" id="go_button" name="go_button" class="btn btn-primary">อัพโหลดข้อมูลนักเรียน</button>
							<button type="reset" class="btn btn-success">Reset</button>
						</center>
					</div>
				</div>				
			</div>
		</div>
	</div>
</form>

<div id="show_gorun"></div>	
