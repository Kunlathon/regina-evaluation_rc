<?php
	include("../../../../database/pdo_data.php");
	//include("../../../../database/class_admin.php");
	
	include("../../../../database/pdo_conndatastu.php");
	//include("../../../../database/class_admin.php");
	
	include("../../../../database/pdo_admission.php");
	
	include("../../../../database/regina_student.php");
	
	include("../../../../database/pdo_summer.php");
	include("../../../../database/class_summer.php");		
?>

	<?php
		$data_year=filter_input(INPUT_POST,'txtyear');
		$data_class=filter_input(INPUT_POST,'txtclass');
			if(isset($data_year,$data_class)){ 
				$class_name=new PrintLavaL($data_class);
			
			?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<script>
		$(document).ready(function () {
			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-violet-400'
			});	
			$('.select-menu-color').select2({
				containerCssClass: 'bg-violet-400',
				dropdownCssClass: 'bg-violet-400'
			});				
		})
	</script>
	
	
	
	
			<select class="select-menu-color" name="ad_sudkey" id="ad_sudkey" data-placeholder="รายชื่อนักเรียน..." required="required">
					<option></option>
				<optgroup label="รายชื่อนักเรียนระดับชั้น&nbsp;<?php echo $class_name->RunPrintLavaL();?>&nbsp;ปีการศึกษา<?php echo $data_year;?>">
				<optgroup label="โรงเรียนเรยีนาเชลีวิทยาลัย">
		<?php
				$CallSudRc=new PrintReginaYearClass($data_year,'1',$data_class);
				foreach($CallSudRc->RunReginaStuClass() as $rc_rs=>$CallSudRcRow){
					$Data_SudRc=new PrintReginaStuData($CallSudRcRow["rsd_studentid"]);
				?>

					<option value="<?php echo $Data_SudRc->PRS_studentid;?>">&nbsp;รหัสนักเรียน&nbsp;<?php echo $Data_SudRc->PRS_studentid;?>&nbsp;<?php echo $Data_SudRc->PRS_nameTH;?>&nbsp;(<?php echo $Data_SudRc->PRS_nickTh;?>)</option>
				
		<?php	}?>	
				</optgroup>
				<optgroup label="โรงเรียนอื่น ">
		<?php
				$CallSud=new DataRsStudentRow($data_year,$data_class);
				foreach($CallSud->RunDataRsStudentRow() as $rc_rs=>$CallSudRow){ 
					if($CallSudRow["RSD_PrefixTh"]==2){
						$mynameTh="เด็กหญิง ".$CallSudRow["RSD_NameTh"]."&nbsp;".$CallSudRow["RSD_SurnameTh"];
					}elseif($CallSudRow["RSD_PrefixTh"]==4){
						$mynameTh="นางสาว ".$CallSudRow["RSD_NameTh"]."&nbsp;".$CallSudRow["RSD_SurnameTh"];
					}else{
						$mynameTh=$CallSudRow["RSD_NameTh"]." ".$CallSudRow["RSD_SurnameTh"];
					}
				?>
					
					<option value="<?php echo $CallSudRow["RSD_key"];?>">&nbsp;รหัสนักเรียน&nbsp;<?php echo $CallSudRow["RSD_key"];?>&nbsp;<?php echo $mynameTh;?>&nbsp;(<?php echo $CallSudRow["RSD_nicknameTh"];?>)</option>
					
		<?php	}?>
				</optgroup>
				</optgroup>			
			</select>
			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php   } ?>