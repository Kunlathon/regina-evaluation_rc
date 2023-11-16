<?php
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");
	
	
	$PrintSystem=new SystemSummer("read","-","-","-","-","-","-","-","-","-","-");
		if(($PrintSystem->RunSS_Error()=="No")){
			foreach($PrintSystem->RunSS_Array() as $rc=>$PrintSystemRow){
				$summer_t=$PrintSystemRow["data_term"];
				$summer_year=$PrintSystemRow["data_summer"];
			}
		}else{
			$summer_t="-";
			$summer_year="-";			
		}	
	
	//$summer_year=2566;
	//$summer_t=1;
	
	require_once("view/js_css_code/PHPExcel-1.8/Classes/PHPExcel.php");
	include("view/js_css_code/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php"); 	
	
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

<?php
	$UpdateFileName=$_FILES["SummerScoreFileUp"]["name"];
		if(isset($UpdateFileName)){
			/** PHPExcel **************************/
			$UpdateFileUpdate=$_FILES["SummerScoreFileUp"]["tmp_name"];
		
			$inputFileName = $UpdateFileUpdate;  
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
					}else{}
				}			
			/** PHPExcel End***********************/ ?>
			
		<?php
			$count_up_score=0;
			$count_up_scoreY=0;
			$count_up_scoreN=0;
			foreach($namedDataArray as $SummerScoreRow){
				
				$SUS_SudKey=$SummerScoreRow["รหัสนักเรียน"];
				$SUS_SubjectKey=$SummerScoreRow["รหัสรายวิชาSummer"];
				$SUS_Year=$SummerScoreRow["ปีการศึกษา"];
				$SUS_Save=$SummerScoreRow["รหัสผู้บันทึก"];
				$SUS_Term=$SummerScoreRow["ภาคเรียน"];
				$SUS_Score=$SummerScoreRow["คะแนน"];
				$SUS_Type=$SummerScoreRow["ประเภทของคะแนน"];
				
				$IntoScoreSudSummer=new IntoDataScore($SUS_SudKey,$SUS_SubjectKey,$SUS_Year,$SUS_Save,$SUS_Term,$SUS_Score,$SUS_Type);
				
					if($IntoScoreSudSummer->RunIntoDataScore()=="No"){
						$count_up_scoreY=$count_up_scoreY+1;
					}elseif($IntoScoreSudSummer->RunIntoDataScore()=="Yes"){
						$count_up_scoreN=$count_up_scoreN+1;
					}else{
						$count_up_scoreN=$count_up_scoreN+1;
					}
				
				
				
				$count_up_score=$count_up_score+1;
			}
		
		?>	
			
		<div class="row">
			<div class="col-<?php echo $grid;?>-4">
				<div class="panel panel-body border-top-orange">
					<h6 class="content-group text-semibold">
						<div>ข้อมูลอัพโหลดทั้งหมด</div>
						<div></div>
					</h6>		
					<div class="panel panel-body border-top-orange">
						<div style="font-size: 20px; font-weight: bold; color:#800080;"><center><?php echo $count_up_score;?></center></div>
					</div>				
				</div>
			</div>
			<div class="col-<?php echo $grid;?>-4">
				<div class="panel panel-body border-top-orange">
					<h6 class="content-group text-semibold">
						<div>ข้อมูลอัพโหลดสำเร็จ</div>
						<div></div>
					</h6>		
					<div class="panel panel-body border-top-orange">
						<div style="font-size: 20px; font-weight: bold; color:#800080;"><center><?php echo $count_up_scoreY;?></center></div>
					</div>					
				</div>			
			</div>
			<div class="col-<?php echo $grid;?>-4">
				<div class="panel panel-body border-top-orange">
					<h6 class="content-group text-semibold">
						<div>ข้อมูลอัพโหลดไม่สำเร็จ</div>
						<div></div>
					</h6>		
					<div class="panel panel-body border-top-orange">
						<div style="font-size: 20px; font-weight: bold; color:#800080;"><center><?php echo $count_up_scoreN;?></center></div>
					</div>					
				</div>			
			</div>
		</div>
			
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<button type="button" id="asj_go" class="btn btn-success">ชำระค่าธรรมเนียม&nbsp;กิจกรรมเรียนเสริมภาคฤดูร้อน</button>
			</div>
		</div>	
			
			
			
<?php	}else{} ?>