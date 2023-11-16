<?php
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
	//include("view/database/class_pdo.php");	
	error_reporting(error_reporting() & ~E_NOTICE);
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

<?php
	$stu_year=filter_input(INPUT_POST,'stu_year');
	//$stu_class=filter_input(INPUT_POST,'stu_class');
	
	//$call_class=new print_level($stu_class);
	
		if($stu_year==""){ ?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////-->		
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger">
			<strong>ข้อผิดพลาด ! </strong>ข้อมูลไม่ถูกต้อง  
		</div>		
	</div>
</div><br>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////-->		
<?php	}else{
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
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
	/** PHPExcel End***********************///-------------------------------------------------------------------------		
//---------------------------------------------------------------------------------------------------------------------		
	$count_up=0;//-----------------------------------------------------------------------------------------------------
	$count_eAyes=0;//--------------------------------------------------------------------------------------------------
	$count_eAno=0;//---------------------------------------------------------------------------------------------------
	$count_eByes=0;//--------------------------------------------------------------------------------------------------
	$count_eBno=0;//---------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------	
	foreach($namedDataArray as $data_overdue){//-----------------------------------------------------------------------
		$rsn_id=$data_overdue["rsn_id"];//-----------------------------------------------------------------------------
		$rsn_year=$data_overdue["rsn_year"];//-------------------------------------------------------------------------
		$rsn_stu=$data_overdue["rsn_stu"];		
		$rsn_level=$data_overdue["rsn_level"];//-----------------------------------------------------------------------
		$id_level=new print_leveltxt($rsn_level);//--------------------------------------------------------------------

		
		
		
		$datetime=date("Y-m-d H:i:s");//-------------------------------------------------------------------------------
//regina_stu_class****into---------------------------------------------------------------------------------------------

		$count_regina_stu_newSql="SELECT count(`rsn_id`) as `count_stu` 
								  FROM `regina_stu_new` WHERE `rsn_id`='{$rsn_id}' and `rsn_year`='{$rsn_year}'";
		$count_regina_stu_new=new pdo_notarray($count_regina_stu_newSql);
		foreach($count_regina_stu_new->print_pdonotarray as $rc_key=>$count_regina_stu_newRow){
			$count_stu=$count_regina_stu_newRow["count_stu"];
				if($count_stu>=1){
					$count_eAno=$count_eAno+1;
				}else{
			//---------------------------------------------------------------------------------------------------------------------
					$into_regina_stu_newSql="INSERT INTO `regina_stu_new` (`rsn_id`, `rsn_year`, `rsn_stu`,`rsn_level`,`rsn_datatime`) 
											 VALUES ('{$rsn_id}', '{$rsn_year}', '{$rsn_stu}','{$id_level->level_IDLevel}','{$datetime}');";//--
					$into_regina_stu_new=new insert_datastupdo($into_regina_stu_newSql);//-----------------------------------------
						if($into_regina_stu_new->system_insert=="yes"){//----------------------------------------------------------
							$count_eByes=$count_eByes+1;//-------------------------------------------------------------------------
						}else{//---------------------------------------------------------------------------------------------------
							$count_eBno=$count_eBno+1;//---------------------------------------------------------------------------
						}//--------------------------------------------------------------------------------------------------------
			//regina_stu_class****into---------------------------------------------------------------------------------------------						
				}
		}
		$count_up=$count_up+1;//---------------------------------------------------------------------------------------
	}//---------------------------------------------------------------------------------------------------------------- 

	
	    }//------------------------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
?>

<div class="row">
	<div class="col-<?php echo $grid;?>-3">
		<div class="panel panel-body">
			<div class="media no-margin">
				<div class="media-body">
					<h3 class="no-margin text-semibold"><?php echo $count_up;?></h3>
					<span class="text-uppercase text-size-mini text-muted">จำนวนข้อมูลอัพโหลดทั่งหมด</span>
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
					<span class="text-uppercase text-size-mini text-muted">จำนวนข้อมูลซ้ำ</span>
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
			<a href="./?evaluation_mod=show_stunew"><button type="button" class="btn btn-success">ย้อนกลับ</button></a>
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
				$sMessage ="รหัส: ".$user_login." ชื่อผู้ใช้งานระบบ: ".$myname." กลุ่ม: ".$group." ข้อมูล นักเรียนใหม่  อัพโหลดข้อมูลนักเรียนใหม่ ปีการศึกษา: ".$stu_year." บันทึกข้อมูลนักเรียนสำเร็จ ".$count_eAyes." บันทึกข้อมูลนักเรียนไม่สำเร็จ ".$count_eAno." บันทึกข้อมูลห้องเรียนสำเร็จ ".$count_eByes." บันทึกข้อมูลห้องเรียนไม่สำเร็จ ".$count_eBno." IP ".$db_evaluationID;

				
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

	