<?php
	//Develop By Kunlathon Saowakhon
	//พัฒนาเว็บไซต์โดย นายกุลธร เสาวคนธ์
	//Tel 0932670639
	//โทร 0932670639
	//Email: mpamese.pc2001@gmail.com , missing_yrc2014@hotmail.com
	//ห้ามใช้ /**/ จะส่งผลให้ค่า return js ทำงานผิดปกติ !!
?>
<?php
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");
	
	$PrintSystem=new SystemSummer("read","-","-","-","-","-","-","-","-","-","-","-");
		if(($PrintSystem->RunSS_Error()=="No")){
			foreach($PrintSystem->RunSS_Array() as $rc=>$PrintSystemRow){
				$summer_t=$PrintSystemRow["data_term"];
				$summer_year=$PrintSystemRow["data_summer"];
			}
		}else{
			$summer_t="-";
			$summer_year="-";			
		}
	
?>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">กิจกรรมเรียนเสริมภาคฤดูร้อน&nbsp;>&nbsp;</span>อัพโหลดคะแนน&nbsp;/&nbsp;กิจกรรมสำหรับวัดและประเมินผล&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>&nbsp;อัพโหลดคะแนน&nbsp;/&nbsp;กิจกรรมสำหรับวัดและประเมินผล&nbsp;</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>


<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-orange">
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div><h6 class="no-margin text-semibold">ดาวน์โหลด&nbsp;/&nbsp;ไฟส์&nbsp;Excel&nbsp;เพื่มอัพโหลดเข้าสู่ระบบ</h6></div>
				</div>
			</div><hr>
			
<form name="load_score">
			<div class="row">
				<div class="col-<?php echo $grid;?>-4">
					<select class="select"  name="load_year" id="load_year" data-placeholder="ปีการศึกษา...">
								<option></option>
							<optgroup label="ปีการศึกษา">
		<?php
				$CallYear=new SystemYear("read","-","-");
				foreach($CallYear->RunST_Array() as $rc=>$PrintYear){ ?>
								<option value="<?php echo $PrintYear["sy_year"];?>"><?php echo $PrintYear["sy_year"];?></option>				
		<?php	} ?>
							</optgroup>
					</select>			
				</div>
				<div class="col-<?php echo $grid;?>-4">
					<select class="select" name="load_class" id="load_class" data-placeholder="ระดับชั้น...">
							<option></option>
						<optgroup label="ระดับอนุบาล">
							<option value="3">อนุบาล 3</option>
						</optgroup>
						<optgroup label="ระดับประถม">
							<option value="11">ประถมศึกษาปีที่ 1</option>
							<option value="12">ประถมศึกษาปีที่ 2</option>
							<option value="13">ประถมศึกษาปีที่ 3</option>
							<option value="21">ประถมศึกษาปีที่ 4</option>
							<option value="22">ประถมศึกษาปีที่ 5</option>
							<option value="23">ประถมศึกษาปีที่ 6</option>
						</optgroup>	
						<optgroup label="ระดับมัธยม">
							<option value="31">มัธยมศึกษาปีที่ 1</option>
							<option value="32">มัธยมศึกษาปีที่ 2</option>
							<option value="33">มัธยมศึกษาปีที่ 3</option>
							<option value="41">มัธยมศึกษาปีที่ 4</option>
							<option value="42">มัธยมศึกษาปีที่ 5</option>
							<option value="43">มัธยมศึกษาปีที่ 6</option>
						</optgroup>				
					</select>			
				</div>
				<div class="col-<?php echo $grid;?>-4">
					<select class="select" name="load_subject" id="load_subject" data-placeholder="วิชา...">
							<option></option>
						<optgroup label="วิชาวัดและประเมินผล">
							<option value=""></option>
						</optgroup>			
					</select>			
				</div>
			</div>
</form>
			
<hr>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div id="RunFileExcel"></div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<br>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-orange">	
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div><h6 class="no-margin text-semibold">อัพโหลดคะแนน&nbsp;/&nbsp; กิจกรรมสำหรับวัดและประเมินผล &nbsp;(หลายรายการ)</h6></div>
					<div><span class="text-orange">ข้อมูลอาจจะมีการรวบรวมข้อมูลจากนักเรียนนอกสถาบันการศึกษา</span></div>
				</div>
			</div>
			<hr>
<form class="form-horizontal" name="summer_score_upload" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>?evaluation_mod=summer_up_score" >

			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="panel panel-body">
						<ul class="list-feed">
							<li>หน้า ดาวน์โหลด / ไฟส์ Excel เพื่ออัพโหลดเข้าสู่ระบบ ให้เลือกรายการ ปีการศึกษา ระดับชั้น และ วิชาที่วัดและประเมินผล</li>
							<li>จากนั้น ระบบจะโหลดตารางข้อมูลสำหรับ ใช้ในการอัพโหลดคะแนน จากนั้นกดปุ่ม Excel เพื่อดาวน์โหลดไฟส์</li>
							<li>นำไฟสที่ดาวน์โหลด มาแก้ไขเพิ่มรายการข้อมูลที่ต้องการอัพโหลด</li>
							<li>ก่อนจะนำไฟส์ที่แก้ไขแล้ว มานำเข้าที่ปุ่มอัพโหลด ให้ลบหัวตารางออก</li>
							<li>จากนั้นนำไฟสที่แก้ไขแล้ว มานำเข้าที่ปุ่มอัพโหลดด้านลงนี้</li>
							<li>ระบบอ่านข้อมูลที่อัพโหลดแล้ว กดปุ่ม Upload</li>
						</ul>
					</div>					
				</div>
			</div>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="panel panel-body">
						<input type="file" name="SummerScoreFileUp" class="file-input-advanced">
						<span class="help-block">ไฟส์โปรแกรม&nbsp;Microsoft&nbsp;Excel&nbsp;รองรับนามสกุลไฟส์&nbsp;<code>xlsx</code>&nbsp;<code>xls</code></span>					
					</div>
				</div>
			</div>

</form>			
		</div>
	</div>
</div>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-orange">
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div><h6 class="no-margin text-semibold">ข้อมูลคะแนนวัดและประเมินผล</h6></div>
					<div><span class="text-orange">ข้อมูลอาจจะมีการรวบรวมข้อมูลจากนักเรียนนอกสถาบันการศึกษา</span></div>
				</div>
			</div>
			<hr>		
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-body border-top-violet">
						<select class="select"  name="scu_year" id="scu_year" data-placeholder="ปีการศึกษา...">
								<option></option>
							<optgroup label="ปีการศึกษา">
		<?php
				$CallYear=new SystemYear("read","-","-");
				foreach($CallYear->RunST_Array() as $rc=>$PrintYear){ ?>
								<option value="<?php echo $PrintYear["sy_year"];?>"><?php echo $PrintYear["sy_year"];?></option>				
		<?php	} ?>
							</optgroup>
						</select>
					</div>				
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-body border-top-violet">
						<select class="select" name="scu_class" id="scu_class" data-placeholder="ระดับชั้น...">
								<option></option>
							<optgroup label="ระดับอนุบาล">
								<option value="3">อนุบาล 3</option>
							</optgroup>
							<optgroup label="ระดับประถม">
								<option value="11">ประถมศึกษาปีที่ 1</option>
								<option value="12">ประถมศึกษาปีที่ 2</option>
								<option value="13">ประถมศึกษาปีที่ 3</option>
								<option value="21">ประถมศึกษาปีที่ 4</option>
								<option value="22">ประถมศึกษาปีที่ 5</option>
								<option value="23">ประถมศึกษาปีที่ 6</option>
							</optgroup>	
							<optgroup label="ระดับมัธยม">
								<option value="31">มัธยมศึกษาปีที่ 1</option>
								<option value="32">มัธยมศึกษาปีที่ 2</option>
								<option value="33">มัธยมศึกษาปีที่ 3</option>
								<option value="41">มัธยมศึกษาปีที่ 4</option>
								<option value="42">มัธยมศึกษาปีที่ 5</option>
								<option value="43">มัธยมศึกษาปีที่ 6</option>
							</optgroup>				
						</select>
					</div>				
				</div>
			</div>
			
			<div id="RunSummerScore"></div>
			
		</div>
	</div>
</div>