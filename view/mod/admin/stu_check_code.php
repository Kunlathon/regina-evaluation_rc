<style>
.RuningLoad {
	display:none;
}
</style>   

<script>
	$(function() {
		$(".RunLoad").fadeOut(5000, function() {
			$(".RuningLoad").fadeIn(4000);
		});
	});
</script>
<?php
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
	//include("view/database/class_pdo.php");	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">Administrator</span> ตรวจสอบสถานะนักเรียน ใช้ในกรณีฉุกเฉิง</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ตรวจสอบสถานะนักเรียน ใช้ในกรณีฉุกเฉิง</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="col-<?php echo $grid;?>-12">
	<center>
		<div class="RunLoad">
			<img class="img-thumbnail" src="Template/global_assets/images/Cube-1s-200px.gif" />
		</div>	
	</center>
</div>

<div class="RuningLoad">
	<?php
		$stu_year=filter_input(INPUT_POST,'stu_year');
		$stu_class=filter_input(INPUT_POST,'stu_class');
		
		$call_class=new print_level($stu_class);
		
			if($stu_year=="" and $stu_class==""){ ?>
	<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////-->		
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
				<a href="./?evaluation_mod=stu_check_up"><button type="button" class="btn btn-success">ย้อนกลับ</button></a>
				&nbsp;
				<a href="./?evaluation_mod=home"><button type="button" class="btn btn-info">กลับสู่หน้าแรก</button></a>
			</center>
		</div>
	</div><br>
	<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////-->		
	<?php	}elseif($stu_year=="" or $stu_class==""){ ?>
	<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////-->		
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
				<a href="./?evaluation_mod=stu_check_up"><button type="button" class="btn btn-success">ย้อนกลับ</button></a>
				&nbsp;
				<a href="./?evaluation_mod=home"><button type="button" class="btn btn-info">กลับสู่หน้าแรก</button></a>
			</center>
		</div>
	</div><br>
	<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////-->		
	<?php	}else{
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//regina_stu_class****delete
			$txt_t=substr($stu_year,0,1);
			$txt_y=substr($stu_year,2,4);

			$delete_regina_stu_classSql="DELETE FROM `regina_stu_class` 
										 WHERE `rsc_year`='{$txt_y}' 
										 and `rsc_term`='{$txt_t}' 
										 and `rsc_class`='{$stu_class}'";
			$delete_regina_stu_class=new insert_datastupdo($delete_regina_stu_classSql);
			if($delete_regina_stu_class->system_insert=="yes"){
				//********************************************
			}else{
				//********************************************
			}
	//regina_stu_class****delete	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
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
		/** PHPExcel End***********************/		
			
			
		$count_up=0;	
		$count_eAyes=0;
		$count_eAno=0;
		$count_eByes=0;
		$count_eBno=0;
		
		foreach($namedDataArray as $data_overdue){
			$copy_id=$data_overdue["ID"];
			$copy_home=$data_overdue["HOME"];
			
				if($copy_home=="ฟ"){
					$copy_home=1;
				}elseif($copy_home=="ด"){
					$copy_home=2;
				}elseif($copy_home=="ล"){
					$copy_home=3;
				}elseif($copy_home=="ข"){
					$copy_home=4;
				}else{
					$copy_home=0;
				}
			$copy_name_th=$data_overdue["name_th"];
			$copy_surname_th=$data_overdue["surname_th"];
			$copy_name_en=$data_overdue["name_en"];
			$copy_surname_en=$data_overdue["surname_en"];
			$copy_order=$data_overdue["order"];
			$copy_plan=$data_overdue["plan"];
			$copy_room=$data_overdue["room"];
			$copy_rsc_txt=$data_overdue["rsc_txt"];
	//-------------------------------------------------------------		
			$copy_rsc_status=$data_overdue["rsc_status"];
			$copy_rsc_status=new sturc_statustxt($copy_rsc_status);
	//-------------------------------------------------------------		
			$datetime=date("Y-m-d H:i:s");
		
	//updata regina_stu_data	   
			$updata_regina_stu_dataSql="UPDATE `regina_stu_data` 
										SET `rsd_name`='{$copy_name_th}',`rsd_surname`='{$copy_surname_th}',`rsd_nameEn`='{$copy_name_en}',`rsd_surnameEn`='{$copy_surname_en}',`rse_home`='{$copy_home}' 
										WHERE `rsd_studentid`='{$copy_id}';";
			$updata_regina_stu_data=new insert_datastupdo($updata_regina_stu_dataSql);
			if($updata_regina_stu_data->system_insert=="yes"){
				$count_eAyes=$count_eAyes+1;
			}else{
				$count_eAno=$count_eAno+1;
			}
	//updata regina_stu_data 		


	//regina_stu_class****into
			$call_planID=new print_plantxt($copy_plan);
			$rsc_roomid=$copy_id."0".$txt_t.$stu_class;
			$into_regina_stu_classSql="INSERT INTO `regina_stu_class` (`rsc_roomid`, `rsc_year`, `rsc_term`, `rsc_plan`, `rsc_class`, `rsc_room`, `rsc_num`, `rsc_update`, `rsd_studentid`, `rsc_status`,`rsc_txt`) 
									   VALUES ('{$rsc_roomid}', '{$txt_y}', '{$txt_t}', '{$call_planID->plan_id}', '{$stu_class}', '{$copy_room}', '{$copy_order}', '{$datetime}', '{$copy_id}', '{$copy_rsc_status->print_statustxt()}','{$copy_rsc_txt}');";
			$into_regina_stu_class=new insert_datastupdo($into_regina_stu_classSql);
			if($into_regina_stu_class->system_insert=="yes"){
				$count_eByes=$count_eByes+1;
			}else{
				$count_eBno=$count_eBno+1;
			}
	//regina_stu_class****into		
			$count_up=$count_up+1;
		}  
			}
	?>

	<div class="row">
		<div class="col-<?php echo $grid;?>-3">
			<div class="panel panel-body">
				<div class="media no-margin">
					<div class="media-body">
						<h3 class="no-margin text-semibold"><?php echo $count_eAyes;?></h3>
						<span class="text-uppercase text-size-mini text-muted">บันทึกข้อมูลนักเรียนสำเร็จ</span>
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
						<h3 class="no-margin text-semibold"><?php echo $count_eAno;?></h3>
						<span class="text-uppercase text-size-mini text-muted">บันทึกข้อมูลนักเรียนไม่สำเร็จ</span>
					</div>

					<div class="media-right media-middle">
						<i class="icon-database-remove icon-3x text-danger-400"></i>
					</div>
				</div>
			</div>	
		</div>
		<div class="col-<?php echo $grid;?>-3">
			<div class="panel panel-body">
				<div class="media no-margin">
					<div class="media-body">
						<h3 class="no-margin text-semibold"><?php echo $count_eByes;?></h3>
						<span class="text-uppercase text-size-mini text-muted">บันทึกข้อมูลห้องเรียนสำเร็จ</span>
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
						<h3 class="no-margin text-semibold"><?php echo $count_eBno;?></h3>
						<span class="text-uppercase text-size-mini text-muted">บันทึกข้อมูลห้องเรียนไม่สำเร็จ</span>
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
				<a href="./?evaluation_mod=stu_check_up"><button type="button" class="btn btn-success">ย้อนกลับ</button></a>
				&nbsp;
				<a href="./?evaluation_mod=home"><button type="button" class="btn btn-info">กลับสู่หน้าแรก</button></a>
			</center>
		</div>
	</div><br>
	<!--แจ้งเตื่อนผ่าน line-->
	<?php
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัส: ".$user_login." ชื่อผู้ใช้งานระบบ: ".$myname." กลุ่ม: ".$group." ตรวจสอบสถานะนักเรียน ใช้ในกรณีฉุกเฉิง ปีการศึกษา: ".$stu_year." ระดับชั้น ".$call_class->level_Sort_name." บันทึกข้อมูลนักเรียนสำเร็จ ".$count_eAyes." บันทึกข้อมูลนักเรียนไม่สำเร็จ ".$count_eAno." บันทึกข้อมูลห้องเรียนสำเร็จ ".$count_eByes." บันทึกข้อมูลห้องเรียนไม่สำเร็จ ".$count_eBno." IP ".$db_evaluationID;

					
					$chOne = curl_init(); 
					curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
					curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
					curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
					curl_setopt( $chOne, CURLOPT_POST, 1); 
					curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
					$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
					curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
					curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
					$result = curl_exec( $chOne ); 

					//Result error 
					if(curl_error($chOne)) 
					{ 
						echo 'error:' . curl_error($chOne); 
					} 
					else { 
						$result_ = json_decode($result, true); 
						//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
					} 
					curl_close( $chOne ); 	
	?>
</div>



	