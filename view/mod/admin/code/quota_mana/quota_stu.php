<?php
//--------------------------------------------------------------------
	include("../../../../database/pdo_quota.php");
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_quota.php");
//--------------------------------------------------------------------    
    include("../../../../img_user/document/gotolink.php");//----------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------	
	
	$copy_year=filter_input(INPUT_POST,'copy_year');
	$copy_level=filter_input(INPUT_POST,'copy_level');
?>

	<script>
		$(document).ready(function () {
			$('.select-search').select2({
				containerCssClass: 'select-lg'
			});	
		})
	</script>
	
	<script>
		$(document).ready(function(){
			$("#data_stu").change(function(){
				var txt_year=$("#txt_year").val();
				var txt_level=$("#txt_level").val();
				var data_stu=$("#data_stu").val();
					if(txt_year!="" && txt_level!=""){
						$.post("<?php echo $golink;?>/quota_print/qm_show_quota",{
							txt_year:txt_year,
							txt_level:txt_level,
							data_stu:data_stu
						},function(qsq){
							if(qsq!=""){
								$("#show_qsq").html(qsq)
							}else{}
						})
					}else{}
			})
		})
	</script>	

	
	

<?php
	if($copy_level==23){ ?>
<!--======================================================-->	
		<select class="select-search" name="data_stu" id="data_stu" data-placeholder="ค้นหารายชื่อ...">
				<option></option>
			<optgroup label="รายชื่อนักเรียนชั้น ป6 ปีการศึกษา <?php echo $copy_year;?>">
				
<!--******************************************************************************************************-->	
	<?php
		$call_datastuSql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_prefix`,`regina_stu_data`.`rsd_name` ,`regina_stu_data`.`rsd_surname`  
						  from `regina_stu_data` join `regina_stu_class` on(`regina_stu_data`.`rsd_studentid`=`regina_stu_class`.`rsd_studentid`)
						  where `regina_stu_data`.`rse_student_status`='1'
						  and `regina_stu_class`.`rsc_year`='{$copy_year}' 
						  and `regina_stu_class`.`rsc_term`='1' 
						  and `regina_stu_class`.`rsc_class`='{$copy_level}'";
		$call_datastuRs=new row_evaluation ($call_datastuSql);
		foreach($call_datastuRs->print_evaluation_array() as $rc_quota=>$call_datastuRow){ ?>
	
				<option value="<?php echo $call_datastuRow["rsd_studentid"];?>"><?php echo $call_datastuRow["rsd_studentid"]." - เด็กหญิง ".$call_datastuRow["rsd_name"]." ".$call_datastuRow["rsd_surname"];?></option>	
<?php	}   ?>	
<!--******************************************************************************************************-->		
			</optgroup>
		</select>	
<!--======================================================-->		
<?php	}elseif($copy_level==33){ ?>
<!--======================================================-->	
		<select class="select-search" name="data_stu" id="data_stu" data-placeholder="ค้นหารายชื่อ...">
				<option></option>
			<optgroup label="รายชื่อนักเรียนชั้น ม3 ปีการศึกษา <?php echo $copy_year;?>">
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
	
				<option value="<?php echo $call_datastuRow["rsd_studentid"];?>"><?php echo $call_datastuRow["rsd_studentid"]." - เด็กหญิง ".$call_datastuRow["rsd_name"]." ".$call_datastuRow["rsd_surname"];?></option>	
<?php	}   ?>	
		</select>	
<!--======================================================-->			
<?php	}else{ ?>
<!--======================================================-->	
			<select class="select-search" name="data_stu" id="data_stu" data-placeholder="ค้นหารายชื่อ...">
					<option></option>
				<optgroup label="รายชื่อนักเรียน"></optgroup>
			</select>		
<!--======================================================-->			
<?php	}      ?>

