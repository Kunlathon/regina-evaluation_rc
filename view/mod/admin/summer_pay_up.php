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
	
	require_once("view/js_css_code/PHPExcel-1.8/Classes/PHPExcel.php");
	include("view/js_css_code/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php"); 	
	
?>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ชำระค่าธรรมเนียม</span>&nbsp;กิจกรรมเรียนเสริมภาคฤดูร้อน</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ชำระค่าธรรมเนียม&nbsp;กิจกรรมเรียนเสริมภาคฤดูร้อน&nbsp;รายระดับชั้น</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<?php
	$UpdateFileName=$_FILES["SummerPayFileUp"]["name"];
		if(isset($UpdateFileName)){
			/** PHPExcel **************************/
			$UpdateFileUpdate=$_FILES["SummerPayFileUp"]["tmp_name"];
		
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
			$count_up_pay=0;
			$count_up_payY=0;
			$count_up_payN=0;
			foreach($namedDataArray as $SummerPayRow){
				$SP_Key=$SummerPayRow["SP_Key"];	
				//$SP_Year=$SummerPayRow["SP_Year"];	


				$data_sutdent=new stu_levelpdo($sp_key,$summer_year,$summer_t);
				
					if((isset($data_sutdent->IDLevel))){
						$sp_class=$data_sutdent->IDLevel;
					}else{

					}
				
				





				//$SP_Class=$SummerPayRow["SP_Class"];

				$SP_ClassTxt=new print_leveltxt($SP_Class);
				$RunUpdate=new UpdatePaySummer($SP_Key,$SP_ClassTxt->level_IDLevel,$SP_Year);
				
					if($RunUpdate->RunUpdatePaySummer()=="Y"){
						$count_up_payY=$count_up_payY+1;
					}elseif($RunUpdate->RunUpdatePaySummer()=="N"){
						$count_up_payN=$count_up_payN+1;
					}else{
						$count_up_payN=$count_up_payN+1;
					}
				
				$count_up_pay=$count_up_pay+1;
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
						<div style="font-size: 20px; font-weight: bold; color:#800080;"><center><?php echo $count_up_pay;?></center></div>
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
						<div style="font-size: 20px; font-weight: bold; color:#800080;"><center><?php echo $count_up_payY;?></center></div>
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
						<div style="font-size: 20px; font-weight: bold; color:#800080;"><center><?php echo $count_up_payN;?></center></div>
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
