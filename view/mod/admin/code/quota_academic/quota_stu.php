	<script>
		$(document).ready(function () {
			
    $('.multiselect-full-featured').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        templates: {
            filter: '<li class="multiselect-item multiselect-filter"><i class="icon-search4"></i> <input class="form-control" type="text"></li>'
        }
    });			
			
		})
	</script>
<?php
	include("../../../../database/pdo_quota.php");
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_quota.php");
	
	
	$copy_year=filter_input(INPUT_POST,'copy_year');
	$copy_level=filter_input(INPUT_POST,'copy_level');
?>

<?php
	if($copy_level==23){ ?>
<!--======================================================-->	
		<select class="multiselect-full-featured" name="data_stu[]"  multiple="multiple">
			<optgroup label="รายชื่อนักเรียนชั้น ป6 ปีการศึกษา <?php echo $copy_year;?>">
			
		<?php
			$count_quota_academicSql="SELECT count(`qc_stuid`) as `count_stuid` FROM `quota_academic` WHERE`qc_year`='{$copy_year}' and `qc_level`='{$copy_level}'";
			$count_quota_academic=new row_quotanotarray($count_quota_academicSql);
			foreach($count_quota_academic->print_quotanotarray()as $rc_quota=>$count_quota_academicRow){
				$count_stuid=$count_quota_academicRow["count_stuid"];
			}
			if($count_stuid>=1){ 
				$call_datastuSql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_prefix`,`regina_stu_data`.`rsd_name` ,`regina_stu_data`.`rsd_surname`  
								  from `regina_stu_data` join `regina_stu_class` on(`regina_stu_data`.`rsd_studentid`=`regina_stu_class`.`rsd_studentid`)
								  where `regina_stu_data`.`rse_student_status`='1'
								  and `regina_stu_class`.`rsc_year`='{$copy_year}' 
								  and `regina_stu_class`.`rsc_term`='1' 
								  and `regina_stu_class`.`rsc_class`='{$copy_level}'";
				$call_datastuRs=new row_evaluation ($call_datastuSql);
				foreach($call_datastuRs->print_evaluation_array() as $rc_quota=>$call_datastuRow){ 
					
				$call_npSql="SELECT `IDPrefix`, `prefixname`, `prefix_SName`, `prefix_EName`, `status` FROM `rc_prefix` WHERE `IDPrefix`='{$call_datastuRow["rsd_prefix"]}'";
					$call_np=new print_evaluation($call_npSql);
					foreach($call_np->print_evaluation_notarray() as $rc_quota=>$call_npRow){
						$call_np=$call_npRow["prefixname"];	
					}
				//quota_academic
					$print_quota_academicSql="SELECT `qc_stuid` FROM `quota_academic` WHERE`qc_year`='{$copy_year}' and `qc_level`='{$copy_level}' and `qc_stuid`='{$call_datastuRow["rsd_studentid"]}'";
					$print_quota_academic=new row_quotanotarray($print_quota_academicSql);
					foreach($print_quota_academic->print_quotanotarray() as $rc_quota=>$print_quota_academicRow){
						$qc_stuid=$print_quota_academicRow["qc_stuid"];
						if($qc_stuid==$call_datastuRow["rsd_studentid"]){
							$selected_quota="selected";
						}else{
							$selected_quota="";
						} 
					}
						if($selected_quota=="selected"){ ?>
<!--*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*	*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*-->
				<option value="<?php  echo $call_datastuRow["rsd_studentid"];?>" selected="selected"><?php echo $call_datastuRow["rsd_studentid"]." - ".$call_np." ".$call_datastuRow["rsd_name"]." ".$call_datastuRow["rsd_surname"];?></option>
<!--*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*	*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*-->							
			<?php		}else{ ?>
<!--*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*	*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*-->
				<option value="<?php  echo $call_datastuRow["rsd_studentid"];?>"><?php echo $call_datastuRow["rsd_studentid"]." - ".$call_np." ".$call_datastuRow["rsd_name"]." ".$call_datastuRow["rsd_surname"];?></option>
<!--*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*	*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*-->							
			<?php		}
				}	
			}else{ ?>
<!--******************************************************************************************************-->	
	<?php
		$call_datastuSql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_prefix`,`regina_stu_data`.`rsd_name` ,`regina_stu_data`.`rsd_surname`  
						  from `regina_stu_data` join `regina_stu_class` on(`regina_stu_data`.`rsd_studentid`=`regina_stu_class`.`rsd_studentid`)
						  where `regina_stu_data`.`rse_student_status`='1'
						  and `regina_stu_class`.`rsc_year`='{$copy_year}' 
						  and `regina_stu_class`.`rsc_term`='1' 
						  and `regina_stu_class`.`rsc_class`='{$copy_level}'";
		$call_datastuRs=new row_evaluation ($call_datastuSql);
		foreach($call_datastuRs->print_evaluation_array() as $rc_quota=>$call_datastuRow){ 
			
		$call_npSql="SELECT `IDPrefix`, `prefixname`, `prefix_SName`, `prefix_EName`, `status` FROM `rc_prefix` WHERE `IDPrefix`='{$call_datastuRow["rsd_prefix"]}'";
			$call_np=new print_evaluation($call_npSql);
			foreach($call_np->print_evaluation_notarray() as $rc_quota=>$call_npRow){
				$call_np=$call_npRow["prefixname"];	
			}
		?>
	
				<option value="<?php echo $call_datastuRow["rsd_studentid"];?>"><?php echo $call_datastuRow["rsd_studentid"]." - ".$call_np." ".$call_datastuRow["rsd_name"]." ".$call_datastuRow["rsd_surname"];?></option>	
<?php	}   ?>	
<!--******************************************************************************************************-->				
<?php		}      ?>			
			</optgroup>
		</select>	
<!--======================================================-->		
<?php	}elseif($copy_level==33){ ?>
<!--======================================================-->	
		<select class="multiselect-full-featured" name="data_stu[]"  multiple="multiple">
			<optgroup label="รายชื่อนักเรียนชั้น ม3 ปีการศึกษา <?php echo $copy_year;?>">
			
		<?php
			$count_quota_academicSql="SELECT count(`qc_stuid`) as `count_stuid` FROM `quota_academic` WHERE`qc_year`='{$copy_year}' and `qc_level`='{$copy_level}'";
			$count_quota_academic=new row_quotanotarray($count_quota_academicSql);
			foreach($count_quota_academic->print_quotanotarray()as $rc_quota=>$count_quota_academicRow){
				$count_stuid=$count_quota_academicRow["count_stuid"];
			}
			if($count_stuid>=1){ 
				$call_datastuSql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_prefix`,`regina_stu_data`.`rsd_name` ,`regina_stu_data`.`rsd_surname`  
								  from `regina_stu_data` join `regina_stu_class` on(`regina_stu_data`.`rsd_studentid`=`regina_stu_class`.`rsd_studentid`)
								  where `regina_stu_data`.`rse_student_status`='1'
								  and `regina_stu_class`.`rsc_year`='{$copy_year}' 
								  and `regina_stu_class`.`rsc_term`='1' 
								  and `regina_stu_class`.`rsc_class`='{$copy_level}'";
				$call_datastuRs=new row_evaluation ($call_datastuSql);
				foreach($call_datastuRs->print_evaluation_array() as $rc_quota=>$call_datastuRow){ 
					
				$call_npSql="SELECT `IDPrefix`, `prefixname`, `prefix_SName`, `prefix_EName`, `status` FROM `rc_prefix` WHERE `IDPrefix`='{$call_datastuRow["rsd_prefix"]}'";
					$call_np=new print_evaluation($call_npSql);
					foreach($call_np->print_evaluation_notarray() as $rc_quota=>$call_npRow){
						$call_np=$call_npRow["prefixname"];	
					}
				//quota_academic
					$print_quota_academicSql="SELECT `qc_stuid` FROM `quota_academic` WHERE`qc_year`='{$copy_year}' and `qc_level`='{$copy_level}' and `qc_stuid`='{$call_datastuRow["rsd_studentid"]}'";
					$print_quota_academic=new row_quotanotarray($print_quota_academicSql);
					foreach($print_quota_academic->print_quotanotarray() as $rc_quota=>$print_quota_academicRow){
						$qc_stuid=$print_quota_academicRow["qc_stuid"];
						if($qc_stuid==$call_datastuRow["rsd_studentid"]){
							$selected_quota="selected";
						}else{
							$selected_quota="";
						} 
					}
						if($selected_quota=="selected"){ ?>
<!--*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*	*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*-->
				<option value="<?php  echo $call_datastuRow["rsd_studentid"];?>" selected="selected"><?php echo $call_datastuRow["rsd_studentid"]." - ".$call_np." ".$call_datastuRow["rsd_name"]." ".$call_datastuRow["rsd_surname"];?></option>
<!--*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*	*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*-->							
			<?php		}else{ ?>
<!--*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*	*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*-->
				<option value="<?php  echo $call_datastuRow["rsd_studentid"];?>"><?php echo $call_datastuRow["rsd_studentid"]." - ".$call_np." ".$call_datastuRow["rsd_name"]." ".$call_datastuRow["rsd_surname"];?></option>
<!--*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*	*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*-->							
			<?php		}
				}	
			}else{ ?>
<!--******************************************************************************************************-->	
	<?php
		$call_datastuSql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_prefix`,`regina_stu_data`.`rsd_name` ,`regina_stu_data`.`rsd_surname`  
						  from `regina_stu_data` join `regina_stu_class` on(`regina_stu_data`.`rsd_studentid`=`regina_stu_class`.`rsd_studentid`)
						  where `regina_stu_data`.`rse_student_status`='1'
						  and `regina_stu_class`.`rsc_year`='{$copy_year}' 
						  and `regina_stu_class`.`rsc_term`='1' 
						  and `regina_stu_class`.`rsc_class`='{$copy_level}'";
		$call_datastuRs=new row_evaluation ($call_datastuSql);
		foreach($call_datastuRs->print_evaluation_array() as $rc_quota=>$call_datastuRow){ 
			
		$call_npSql="SELECT `IDPrefix`, `prefixname`, `prefix_SName`, `prefix_EName`, `status` FROM `rc_prefix` WHERE `IDPrefix`='{$call_datastuRow["rsd_prefix"]}'";
			$call_np=new print_evaluation($call_npSql);
			foreach($call_np->print_evaluation_notarray() as $rc_quota=>$call_npRow){
				$call_np=$call_npRow["prefixname"];	
			}
		?>
	
				<option value="<?php echo $call_datastuRow["rsd_studentid"];?>"><?php echo $call_datastuRow["rsd_studentid"]." - ".$call_np." ".$call_datastuRow["rsd_name"]." ".$call_datastuRow["rsd_surname"];?></option>	
<?php	}   ?>	
<!--******************************************************************************************************-->				
<?php		}      ?>	
		</select>	
<!--======================================================-->			
<?php	}else{ ?>
<!--======================================================-->	
			<select class="multiselect-full-featured" name="data_stu[]"  multiple="multiple">
				<optgroup label="รายชื่อนักเรียน"></optgroup>
			</select>		
<!--======================================================-->			
<?php	}      ?>

