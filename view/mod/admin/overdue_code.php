<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">เพิ่มข้อมูล</span> นักเรียนค้างจ่าย</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>เพิ่มข้อมูลนักเรียนค้างจ่าย</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
<?php
	include("view/database/class_admin.php");
	$datatime=date("Y-m-d H:i:s");
	$sub_system=post_data($_POST["sub_system"]);
		if($sub_system=="sub_key"){ ?>
<!--*******************************************************************-->		
	<?php
		$od_student=post_data($_POST["od_student"]) ;
		$stu_name=post_data($_POST["stu_name"]) ;
		$od_term=post_data($_POST["od_term"]);
		$od_year=post_data($_POST["od_year"]);
		$os_id=post_data($_POST["os_id"]);
		$oc_id=post_data($_POST["oc_id"]);
		if($od_student=="" and $stu_name=="" and $od_term=="" and $od_year=="" and $os_id=="" and $oc_id==""){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger">
			<strong>ข้อผิดพลาด ! </strong>ข้อมูลไม่ถูกต้อง  
		</div>		
	</div>
</div><br>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<center>
			<a href="./?evaluation_mod=overdue_add"><button type="button" class="btn btn-success">ย้อนกลับ</button></a>
			&nbsp;
			<a href="./?evaluation_mod=home"><button type="button" class="btn btn-info">กลับสู่หน้าแรก</button></a>
		</center>
	</div>
</div><br>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
  <?php }elseif($od_student=="" or $stu_name=="" or $od_term=="" or $od_year=="" or $os_id=="" or $oc_id==""){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger">
			<strong>ข้อผิดพลาด ! </strong>ข้อมูลไม่ถูกต้อง  
		</div>		
	</div>
</div><br>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<center>
			<a href="./?evaluation_mod=overdue_add"><button type="button" class="btn btn-success">ย้อนกลับ</button></a>
			&nbsp;
			<a href="./?evaluation_mod=home"><button type="button" class="btn btn-info">กลับสู่หน้าแรก</button></a>
		</center>
	</div>
</div><br>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
  <?php }else{ ?>
		<?php
			$class_stuA=new class_stuA($od_student,$od_term,$od_year);			
			if($class_stuA->txt_system=="yes"){
				$stu_overdueSql="INSERT INTO `overdue_data` (`od_student`, `od_term`, `od_year`, `od_class`, `od_timesave`, `od_timemodify`, `od_save`, `os_id`, `oc_id`) 
						         VALUES ('{$class_stuA->rsd_studentid}', '{$class_stuA->rsc_term}', '{$class_stuA->rsc_year}', '{$class_stuA->rsc_class}', '{$datatime}', '{$datatime}', '{$user_login}', '{$os_id}', '{$oc_id}');";
				$stu_overdueInto=add_rc($stu_overdueSql);
				if($stu_overdueInto=="yes"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-success">
			<strong>สำเร็จ ! </strong>บันทึกข้อมูลสำเร็จ
		</div>		
	</div>
</div><br>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<center>
			<a href="./?evaluation_mod=overdue_add"><button type="button" class="btn btn-success">ย้อนกลับ</button></a>
			&nbsp;
			<a href="./?evaluation_mod=home"><button type="button" class="btn btn-info">กลับสู่หน้าแรก</button></a>
		</center>
	</div>
</div><br>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger">
			<strong>ข้อผิดพลาด ! </strong>บันทึกข้อมูลไม่สำเร็จ
		</div>		
	</div>
</div><br>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<center>
			<a href="./?evaluation_mod=overdue_add"><button type="button" class="btn btn-success">ย้อนกลับ</button></a>
			&nbsp;
			<a href="./?evaluation_mod=home"><button type="button" class="btn btn-info">กลับสู่หน้าแรก</button></a>
		</center>
	</div>
</div><br>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}
			}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger">
			<strong>ข้อผิดพลาด ! </strong>ข้อมูลเกิดข้อผิดพลาด
		</div>		
	</div>
</div><br>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<center>
			<a href="./?evaluation_mod=overdue_add"><button type="button" class="btn btn-success">ย้อนกลับ</button></a>
			&nbsp;
			<a href="./?evaluation_mod=home"><button type="button" class="btn btn-info">กลับสู่หน้าแรก</button></a>
		</center>
	</div>
</div><br>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}?>	
  <?php } ?>	
<!--*******************************************************************-->		
<?php	}elseif($sub_system=="up_excel"){
//------------------------------------------------------------------------	
	/** PHPExcel */
	require_once 'view/js_css_code/PHPExcel-1.8/Classes/PHPExcel.php';
	/** PHPExcel_IOFactory - Reader */
	include 'view/js_css_code/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';  
	
	$file_updata=$_FILES["file_updata"]["tmp_name"];
	
	$inputFileName = "$file_updata";  
	$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
	$objReader->setReadDataOnly(true);  
	$objPHPExcel = $objReader->load($inputFileName); 																		 

	$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
	$highestRow = $objWorksheet->getHighestRow();
	$highestColumn = $objWorksheet->getHighestColumn();

	$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
	$headingsArray = $headingsArray[1];

	$r = -1;
	$namedDataArray = array();
	for ($row = 2; $row <= $highestRow; ++$row) {
		$dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
		if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
			++$r;
			foreach($headingsArray as $columnKey => $columnHeading) {
				$namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
			}
		}
	}																		 
		$data_t=0;
		$data_f=0;
		foreach($namedDataArray as $data_overdueA){
	
			$class_stuAA=new class_stuA($data_overdueA["รหัสนักเรียน"],$data_overdueA["ภาคเรียน/เทอม"],$data_overdueA["ปีการศึกษา"]);
			
			if($class_stuAA->txt_system=="yes"){
				$data_t=$data_t+1;
			}else{
				$data_f=$data_f+1;
			}
		}  
	
		$num_save=0;
		$num_notsave=0;
		
		if($data_f>=1){
			
		}else{
			foreach($namedDataArray as $data_overdueB){
				$od_student=$data_overdueB["รหัสนักเรียน"];
				$od_term=$data_overdueB["ภาคเรียน/เทอม"];
				$od_year=$data_overdueB["ปีการศึกษา"];
				$os_id=$data_overdueB["สถานะการชำระ"];
				$oc_id=$data_overdueB["ประเภทการชำระ"];				

//---------------------------------------------------------------------
//os_id
				$data_os="SELECT `os_id`,`os_text` FROM `overdue_status` WHERE `os_text`='{$os_id}'";
				$data_osRs=rc_data($data_os);
				
				foreach($data_osRs as $key_rs=>$data_osRow){
					$txtos_id=$data_osRow["os_id"];
					$txtos_text=$data_osRow["os_text"];
				}

//oc_id
				$data_oc="SELECT `oc_id`,`oc_text` FROM `overdue_category` WHERE `oc_text`='{$oc_id}'";
				$data_ocRs=rc_data($data_oc);
				
				foreach($data_ocRs as $key_rs=>$data_ocRow){
					$txtoc_id=$data_ocRow["oc_id"];
					$txtoc_text=$data_ocRow["oc_text"];
				}
//---------------------------------------------------------------------
				$class_stuAB=new class_stuA($od_student,$od_term,$od_year);
				$stu_overdueSql="INSERT INTO `overdue_data` (`od_student`, `od_term`, `od_year`, `od_class`, `od_timesave`, `od_timemodify`, `od_save`, `os_id`, `oc_id`) 
						         VALUES ('{$class_stuAB->rsd_studentid}', '{$class_stuAB->rsc_term}', '{$class_stuAB->rsc_year}', '{$class_stuAB->rsc_class}', '{$datatime}', '{$datatime}', '{$user_login}', '{$txtos_id}', '{$txtoc_id}');";
				$stu_overdueInto=add_rc($stu_overdueSql);
				
				if($stu_overdueInto=="yes"){
					$num_save=$num_save+1;
				}else{
					$num_notsave=$num_notsave+1;
				}
			}
			
			if($num_notsave>=1){
				foreach($namedDataArray as $data_overdueC){
					$odc_student=$data_overdueC["รหัสนักเรียน"];
					$odc_term=$data_overdueC["ภาคเรียน/เทอม"];
					$odc_year=$data_overdueC["ปีการศึกษา"];
					$class_stuAC=new class_stuA($odc_student,$odc_term,$odc_year);
					$stu_delete="DELETE FROM `overdue_data` WHERE `od_student`='{$class_stuAC->rsd_studentid}' and `od_term`='{$class_stuAC->rsc_term}' and `od_year`='{$class_stuAC->rsc_year}' and `od_class`='{$class_stuAC->rsc_class}'";
					$stu_deleteData=add_rc($stu_delete);
				}
			}else{
				//--------------
			}
		} ?>		
<div class="row">
	<div class="col-<?php echo $grid;?>-3">
		<div class="panel panel-body">
			<div class="media no-margin">
				<div class="media-body">
					<h3 class="no-margin text-semibold"><?php echo $data_t;?></h3>
					<span class="text-uppercase text-size-mini text-muted">ข้อมูลถูกต้อง</span>
				</div>

				<div class="media-right media-middle">
					<i class="icon-file-check2 icon-3x text-blue-400"></i>
				</div>
			</div>
		</div>	
	</div>
	<div class="col-<?php echo $grid;?>-3">
		<div class="panel panel-body">
			<div class="media no-margin">
				<div class="media-body">
					<h3 class="no-margin text-semibold"><?php echo $data_f;?></h3>
					<span class="text-uppercase text-size-mini text-muted">ข้อมูลไม่ถูกต้อง</span>
				</div>

				<div class="media-right media-middle">
					<i class="icon-file-minus2 icon-3x text-danger-400"></i>
				</div>
			</div>
		</div>	
	</div>
	<div class="col-<?php echo $grid;?>-3">
		<div class="panel panel-body">
			<div class="media no-margin">
				<div class="media-body">
					<h3 class="no-margin text-semibold"><?php echo $num_save;?></h3>
					<span class="text-uppercase text-size-mini text-muted">บันทึกสำเร็จ</span>
				</div>

				<div class="media-right media-middle">
					<i class="icon-database-check icon-3x text-blue-400"></i>
				</div>
			</div>
		</div>	
	</div>
	<div class="col-<?php echo $grid;?>-3">
		<div class="panel panel-body">
			<div class="media no-margin">
				<div class="media-body">
					<h3 class="no-margin text-semibold"><?php echo $num_notsave;?></h3>
					<span class="text-uppercase text-size-mini text-muted">บันทึกไม่สำเร็จ</span>
				</div>

				<div class="media-right media-middle">
					<i class="icon-database-remove icon-3x text-danger-400"></i>
				</div>
			</div>
		</div>	
	</div>
</div><br>		
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<center>
			<a href="./?evaluation_mod=overdue_add"><button type="button" class="btn btn-success">ย้อนกลับ</button></a>
			&nbsp;
			<a href="./?evaluation_mod=home"><button type="button" class="btn btn-info">กลับสู่หน้าแรก</button></a>
		</center>
	</div>
</div><br>		
<?php
//------------------------------------------------------------------------		
		}else{
			exit("<script>window.location='./?evaluation_mod=overdue_add';</script>");
		}
?>