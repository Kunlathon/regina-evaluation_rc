<?php
	//database: pdo_data+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	include("view/database/pdo_data.php");//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	include("view/database/class_admin.php");//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//database:	pdo_data End+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//database: pdo_health+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	include("view/database/pdo_health.php");//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	include("view/database/class_health.php");//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//database:	pdo_health End//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	include("view/database/pdo_conndatastu.php");
	include("view/database/pdo_admission.php");

	include("view/database/regina_student.php");
?>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ข้อมูลการตรวจสุขภาพนักเรียน</span> อัพโหลดข้อมูลการตรวจ</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ข้อมูลการตรวจสุขภาพนักเรียน อัพโหลดข้อมูลการตรวจ</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><hr>
<?php
	$uh_term=filter_input(INPUT_POST,'uh_term');
	$uh_year=filter_input(INPUT_POST,'uh_year');
		if(($uh_term!=null and $uh_year!=null)){	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
/** PHPExcel */
		require_once 'view/js_css_code/PHPExcel-1.8/Classes/PHPExcel.php';
/** PHPExcel_IOFactory - Reader */
		include 'view/js_css_code/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';  
		
		$uh_health=$_FILES["uh_health"]["tmp_name"];
		
		$inputFileName = "$uh_health";  
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
//set 0
		$data_count=0;
		$data_rcT=0;//รหัสนักเรียนถูกต้อง อยู่ในฐานข้อมูล
		$data_rcF=0;//รหัสนักเรียนไม่ถูกต้อง ไม่อยู่ในฐานข้อมูล
		$count_into=0;
		$count_into_error=0;
//set 0 end
	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		foreach($namedDataArray as $data_health){

			$data_idkey=$data_health["รหัสนักเรียน"];
			$CopyStuRc=new PrintReginaStuDataClass($data_idkey);	
			$print_rcclass=new PrintReginaYear4($uh_year,$uh_term,$data_idkey);
			foreach($print_rcclass->RunReginaStuClass() as $key_rc=>$print_rcclassRow){
				if((is_array($print_rcclassRow) and count($print_rcclassRow))){
					if((isset($print_rcclassRow["rsd_studentid"]))){
						$stu_student_key=$print_rcclassRow["rsd_studentid"];						
					}else{
						$stu_student_key=null;
					}
					if((isset($print_rcclassRow["rsc_class"]))){
						$stu_class=$print_rcclassRow["rsc_class"];
					}else{
						$stu_class=null;
					}
				}else{
					$stu_class=null;
					$stu_student_key=null;
				}
			}

				if(($stu_student_key!=null)){
					$data_rcT=$data_rcT+1;
					$run_idkey=$stu_student_key;
					//$class=$data_health["ชั้น"];
					$class=$stu_class;
					//$age=$data_health["อายุ"];
					$age=$CopyStuRc->age;
					$Weight=$data_health["น้ำหนัก"];
					$Height=$data_health["ส่วนสูง"];
					$BMI=$data_health["ค่าดัชนีมวลกาย"];
					$Weight_versus_age=$data_health["น้ำหนักเทียบกับอายุ"];
					$Height_versus_age=$data_health["ส่วนสูงเทียบกับอายุ"];
					$Nutritional_status=$data_health["ภาวะโภชนาการ"];
					$Right_eye=$data_health["สายตาข้างขวา"];
					$Slow_vision=$data_health["สายตาข้างช้าย"];
					$color_blindness=$data_health["ตาบอดสี"];
					$Hearing_by_the_white_side=$data_health["การได้ยินข้างขาว"];
					$Slow_hearing=$data_health["การได้ยินข้างช้าย"];
					$Skin=$data_health["ผิวหนัง"];
					$Mouth_tongue=$data_health["ปากลิ้น"];
					$teeth=$data_health["ฟัน"];
					$gum=$data_health["เหงือก"];
					$neck=$data_health["คอ"];
					$Tonsils=$data_health["ต่อมทอนซิล"];
					$Thyroid=$data_health["ต่อมไทรอยด์"];
					$Lymph_nodes=$data_health["ต่อมน้ำเหลือง"];
					$Record_other_examination_results=$data_health["บันทึกผลการตรวจอื่นๆ"];

//-------------------------------------------------------------------------------------------------------------------
//Table : Delect health_sud++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
					$Delect_Health_SudSql="DELETE FROM `health_sud` 
					WHERE `hs_key`='{$run_idkey}'
					AND `hs_t`='{$uh_term}' 
					AND `hs_year`='{$uh_year}' 
					AND `hs_class`='{$stu_class}'";
					$Delect_Health_Sud=new insert_healthpdo($Delect_Health_SudSql);
//Table : Delect health_sud End++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Table : Delect health_list_has_health_sud++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
					$Delect_HIHHSSql="DELETE FROM `health_list_has_health_sud` 
					WHERE `health_sud_hs_key`='{$run_idkey}'
					AND `health_sud_hs_t`='{$uh_term}' 
					AND `health_sud_hs_year`='{$uh_year}' 
					AND `health_sud_hs_class`='{$stu_class}'";
					$Delect_HIHHS=new insert_healthpdo($Delect_HIHHSSql);
					//Table : Delect health_list_has_health_sud End++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Table:health_sud+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$into_healthSql="INSERT INTO `health_sud` (`hs_key`, `hs_t`, `hs_year`, `hs_class`) 
					VALUES ('{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}');";
					$into_health=new insert_healthpdo($into_healthSql);
						if($into_health->into_health()=="yes"){
							$count_into=$count_into+1;
						}else{
							$count_into_error=$count_into_error+1;
						}
//Table:health_sud End+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
//Table:health_list_has_health_sud
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
					$age_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('1', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$age}')";
					$age_into=new insert_healthpdo($age_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$Weight_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('2', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$Weight}')";
					$Weight_into=new insert_healthpdo($Weight_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$Height_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('3', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$Height}')";
					$Height_into=new insert_healthpdo($Height_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$BMI_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('4', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$BMI}')";
					$BMI_into=new insert_healthpdo($BMI_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$Weight_versus_age_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
						VALUES ('5', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$Weight_versus_age}')";
					$Weight_versus_age_into=new insert_healthpdo($Weight_versus_age_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$Height_versus_age_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
						VALUES ('6', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$Height_versus_age}')";
					$Height_versus_age_into=new insert_healthpdo($Height_versus_age_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$Nutritional_status_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
						VALUES ('7', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$Nutritional_status}')";
					$Nutritional_status_into=new insert_healthpdo($Nutritional_status_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$Right_eye_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('8', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$Right_eye}')";
					$Right_eye_into=new insert_healthpdo($Right_eye_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$Slow_vision_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('9', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$Slow_vision}')";
					$Slow_vision_into=new insert_healthpdo($Slow_vision_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$color_blindness_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('10', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$color_blindness}')";
					$color_blindness_into=new insert_healthpdo($color_blindness_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$Hearing_by_the_white_side_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
								VALUES ('11', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$Hearing_by_the_white_side}')";
					$Hearing_by_the_white_side_into=new insert_healthpdo($Hearing_by_the_white_side_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$Slow_hearing_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('12', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$Slow_hearing}')";
					$Slow_hearing_into=new insert_healthpdo($Slow_hearing_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$Skin_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('13', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$Skin}')";
					$Skin_into=new insert_healthpdo($Skin_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$Mouth_tongue_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('14', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$Mouth_tongue}')";
					$Mouth_tongue_into=new insert_healthpdo($Mouth_tongue_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$teeth_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('15', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$teeth}')";
					$teeth_into=new insert_healthpdo($teeth_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$gum_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('16', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$gum}')";
					$gum_into=new insert_healthpdo($gum_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$neck_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('17', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$neck}')";
					$neck_into=new insert_healthpdo($neck_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$Tonsils_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('18', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$Tonsils}')";
					$Tonsils_into=new insert_healthpdo($Tonsils_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$Thyroid_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('19', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$Thyroid}')";
					$Thyroid_into=new insert_healthpdo($Thyroid_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$Lymph_nodes_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('20', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$Lymph_nodes}')";
					$Lymph_nodes_into=new insert_healthpdo($Lymph_nodes_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
					$Record_other_examination_results_sql="INSERT INTO `health_list_has_health_sud` (`health_list_hl_id`, `health_sud_hs_key`, `health_sud_hs_t`, `health_sud_hs_year`, `health_sud_hs_class`, `hlhhs_txt`) 
					VALUES ('21', '{$run_idkey}', '{$uh_term}', '{$uh_year}', '{$stu_class}', '{$Record_other_examination_results}')";
					$Record_other_examination_results_into=new insert_healthpdo($Record_other_examination_results_sql);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Table:health_list_has_health_sud	


				}else{
					$data_rcF=$data_rcF+1;
					$count_into_error=$count_into_error+1;

				}


			$data_count=$data_count+1;	
		}
	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php	}else{} ?>

		<div class="row">
			<div class="col-<?php echo $grid;?>-6">
				<div class="panel panel-body">
					<div class="media no-margin">
						<div class="media-body">
							<h3 class="no-margin text-semibold"><?php echo $data_count;?></h3>
							<span class="text-uppercase text-size-mini text-muted">ข้อมูลอัพโหลด</span>
						</div>

						<div class="media-right media-middle">
							<i class="icon-database-check icon-3x text-blue-400"></i>
						</div>
					</div>
				</div>		
			</div>
			<div class="col-<?php echo $grid;?>-6">
				<div class="panel panel-body">
					<div class="media no-margin">
						<div class="media-body">
							<h3 class="no-margin text-semibold"><?php echo $data_rcT;?></h3>
							<span class="text-uppercase text-size-mini text-muted">ข้อมูลที่ถูกต้อง</span>
						</div>

						<div class="media-right media-middle">
							<i class="icon-database-check icon-3x text-blue-400"></i>
						</div>
					</div>
				</div>			
			</div>
		</div>
		<div class="row">
			<div class="col-<?php echo $grid;?>-6">
				<div class="panel panel-body">
					<div class="media no-margin">
						<div class="media-body">
							<h3 class="no-margin text-semibold"><?php echo $count_into;?></h3>
							<span class="text-uppercase text-size-mini text-muted">บันทึกข้อมูลสำเร็จ</span>
						</div>

						<div class="media-right media-middle">
							<i class="icon-database-check icon-3x text-blue-400"></i>
						</div>
					</div>
				</div>					
			</div>
			<div class="col-<?php echo $grid;?>-6">
				<div class="panel panel-body">
					<div class="media no-margin">
						<div class="media-body">
							<h3 class="no-margin text-semibold"><?php echo $count_into_error;?></h3>
							<span class="text-uppercase text-size-mini text-muted">ข้อมูลไม่ถูกต้อง</span>
						</div>

						<div class="media-right media-middle">
							<i class="icon-database-remove icon-3x text-danger-400"></i>
						</div>
					</div>
				</div>		
			</div>
		</div>

