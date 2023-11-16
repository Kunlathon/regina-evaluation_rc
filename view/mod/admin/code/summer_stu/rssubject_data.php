<?php
	//include("../../../../database/pdo_data.php");
	//include("../../../../database/class_admin.php");
	include("../../../../database/pdo_summer.php");
	include("../../../../database/class_summer.php");		
?>

	<?php
		$data_year=filter_input(INPUT_POST,'txtyear');
		$data_class=filter_input(INPUT_POST,'txtclass');
			if(isset($data_year,$data_class)){ ?>
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
	
	<script>
		$(document).ready(function (){
			$("#sc_rssubject").change(function (){
				var ScYear=$("#sc_year").val();
				var ScClass=$("#sc_class").val();
				var scRssubject=$("#sc_rssubject").val();
					if(ScYear!="" && ScClass!=""){
						$.post("view/mod/admin/code/summer_stu/summer_print.php",{
							txtyear:ScYear,
							txtclass:ScClass,
							txtssubject:scRssubject
						},function(sc){
							if(sc!=""){
								$("#print_rssubject").html(sc)
							}else{}
						})
					}else{}
			})
		})
	</script>	
	
	
			<select class="select-menu-color" name="sc_rssubject" id="sc_rssubject" data-placeholder="รายการกิจกรรม / วิชา...">
					<option></option>
				<optgroup label="รายการกิจกรรม / วิชา">
				
	<?php
		$ShowRsSubjectData=new ShowRsSubjectData($data_year,$data_class);
		foreach($ShowRsSubjectData->RunShowRsSubjectData() as $rc=>$ShowRsSubjectDataRow){?>
					
					<option value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>"><?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?></option>
					
	<?php	    } ?>				
				
				</optgroup>			
			</select>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php   } ?>



