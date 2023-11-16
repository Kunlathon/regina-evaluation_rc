<?php
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
	//include("view/database/class_pdo.php");	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">อัพโหลดข้อมูล </span> นักเรียนใหม่</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>อัพโหลดข้อมูล นักเรียนใหม่</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-success">
					<div class="panel-heading">ตรวจสอบสถานะนักเรียน</div>
					<div class="panel-body">
<form class="form-horizontal" name="regina_stu_new" method="post" enctype="multipart/form-data" action="./?evaluation_mod=show_stunewcode">
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">
								<div class="panel panel-body">
									<a href="view/excel/regina_stu_new.xlsx"><div class="media no-margin">
										<div class="media-body">
											<h3 class="no-margin text-semibold">ดาวโหลด Excel เพื่มอัพโหลดเข้าสู่ระบบ</h3>
										</div>

										<div class="media-right media-middle">
											<i class="icon-file-presentation icon-3x text-blue-400"></i>
										</div>		
									</div></a>
								</div>
							</div>
							<div class="col-<?php echo $grid;?>-6">
								<div class="panel panel-body">
									<ul class="list-feed">
										<li>คลิกที่ icon <div class="icon-file-presentation"></div> เพื่อโหลดไฟส์สำหรับอัพโหลด</li>
										<li>จากนั้นนำไฟสที่ดาวน์โหลด มาแก้ไขเพิ่มรายการข้อมูลที่ต้องการอัพโหลด</li>
										<li>นำไฟสที่แก้ไขแล้ว มานำเข้าที่ปุ่มอัพโหลด</li>
										<li>ระบบอ่านข้อมูลที่อัพโหลดแล้ว กดปุ่ม Upload</li>
									</ul>
								</div>							
							</div>
						</div><br>
						<div class="row">
							<div class="col-<?php echo $grid;?>-7">
								<div class="form-group">
									<label class="col-sm-2 col-md-2 col-lg-2 control-label text-semibold">นำข้อมูลเข้าที่นี้ : </label>
									<div class="col-sm-10 col-md-10 col-lg-10">
										<input type="file" name="file_updata" class="file-input-extensions" required="required">
										<span class="help-block">อนุญาตเฉพาะนามสกุลไฟล์ที่เฉพาะเจาะจง ในตัวอย่างนี้เท่านั้น <code>xls</code>, <code>xlsx</code> อนุญาตให้ส่วนขยาย.</span>
									</div>
								</div>

							</div>						
							<div class="col-<?php echo $grid;?>-5">
								<div class="form-group">
									<select class="select-search" name="stu_year" id="stu_year" required="required"> 
										<option value="">เลือก ปีการศึกษา</option>
								<?php
										$count=0;
										while($count<=50){ 
											$data_y=(date("Y")+543)-$count; ?>
										<option value="<?php echo $data_y;?>"><?php echo $data_y;?></option>
											
								<?php		$count=$count+1;
										} ?>
									</select>
								</div>
							</div>						
						</div>
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<input type="hidden" name="sub_system" value="up_excel">
							</div>
						</div>
</form>					
					</div>
				</div>
			</div>
		</div>