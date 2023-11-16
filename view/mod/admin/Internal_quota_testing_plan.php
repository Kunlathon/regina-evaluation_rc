<?php	
	include("view/database/pdo_quota.php");	
	include("view/database/pdo_data.php");	
	
	include("view/database/class_quota.php");

?>
<?php
	$print_iqtpc=filter_input(INPUT_GET,'print_iqtpc');
	$print_iqtpc=base64_decode($print_iqtpc);
	if($print_iqtpc=="iqtpcA"){ ?>
	<script>
	$(document).ready(function () {		
		show_stack_bottom_right('error').show();
	})
	</script>		
<?php	}elseif($print_iqtpc=="iqtpcC"){ ?>
	<script>
	$(document).ready(function () {		
		show_stack_bottom_right('danger').show();
	})
	</script>		
<?php	}elseif($print_iqtpc=="iqtpcD"){ ?>
	<script>
	$(document).ready(function () {		
		show_stack_bottom_right('info').show();
	})
	</script>		
<?php	}else{
		//**************************
	}
?>	
	
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">นักเรียนโควต้าภายใน </span>รายการสอบย้ายแผนการเรียน</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>รายการสอบย้ายแผนการเรียน</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-info alert-styled-left alert-bordered">
			<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
			<span class="text-semibold">ตั้งค่าแผนการเรียนนักเรียนได้รับสิทธิ์โควต้า กำหนดแผนการเรียนเพื่อกำหนดสิทธิ์แผนการเรียนที่นักเรียนสามารถแจ้งความจำนงขอสอบย้ายแผนการเรียน</span>
		</div>	
	</div>
</div>

<div class="row">
	
			<div class="col-<?php echo $grid;?>-12"><p class="text-semibold">แผนการเรียนโควต้า ภายใน</p></div>
	<?php
		$print_quota=new plan_quota();
		$btn_count=1;	
		foreach($print_quota->print_PlanQuota() as $rc_quota=>$print_quotaRow){ ?>
			
			<div class="col-<?php echo $grid;?>-6">
				<a id="myBtn_iqtp<?php echo $btn_count;?>"><div class="panel panel-body bg-success has-bg-image" >
					<div class="media no-margin">
						<div class="media-left media-middle">
							<i class="icon-graduation2 icon-2x opacity-70"></i>
						</div>

						<div class="media-body text-right">
							<h4 class="no-margin"><?php echo $print_quotaRow["Name"]." (".$print_quotaRow["LName"].")";?></h4>
						</div>
					</div>
				</div></a>				
			</div>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!-- Modal -->
		<div class="modal fade" id="myModa_iqtp<?php echo $btn_count;?>" role="dialog">
			<div class="modal-dialog modal-lg">
		
		  <!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4 class="modal-title"><?php echo $print_quotaRow["Name"]." (".$print_quotaRow["LName"].")";?></h4>
				</div>
				<div class="modal-body">
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<form name="internal_quota_testing_plan" method="post" action="view/mod/admin/code/Internal_quota_testing_plan/Internal_quota_testing_plan_code.php">				
					<div class="row">
						<div class="col-<?php echo $grid;?>-12 text-semibold">แผนการเรียนสอบย้ายแผน</div>
						<div class="col-<?php echo $grid;?>-12">
							<select class="multiselect-full-featured" multiple="multiple" name="qce_plan[]">
								<optgroup label="แผนการเรียนมัธยมตอนต้น">
								
				<?php
						$plan_ASql="SELECT * FROM `rc_plan` WHERE `IDPlan`='2' or `IDPlan`='12'";
						$plan_A=new row_evaluation($plan_ASql);
						foreach($plan_A->print_evaluation_array() as $rc_quota=>$plan_Arow){
			
							$rc_planSql="SELECT `qce_key`, `qtt_key` FROM `quota_choose_exam` WHERE `qtt_key`='{$print_quotaRow["IDPlan"]}' and `qce_key`='{$plan_Arow["IDPlan"]}'";
							$rc_plan=new row_quotanotarray($rc_planSql);
							
								foreach($rc_plan->print_quotanotarray()as $quota_key=>$rc_planRow){
									if($rc_planRow["qce_key"]==$plan_Arow["IDPlan"]){
										$selected_plan="selected";
									}else{
										$selected_plan="";
									}  
								}
								if($selected_plan=="selected"){ ?>
									<option value="<?php echo $plan_Arow["IDPlan"];?>" selected="selected"><?php echo $plan_Arow["Name"]." (".$plan_Arow["LName"].")";?></option>
					<?php		}else{ ?>
									<option value="<?php echo $plan_Arow["IDPlan"];?>"><?php echo $plan_Arow["Name"]." (".$plan_Arow["LName"].")";?></option>
					<?php		}									
							
						} ?>			
				<!--selected="selected"-->					
								</optgroup>
								<optgroup label="แผนการเรียนมัธยมตอนปลาย">
								
					<?php
						$plan_BSql="SELECT * FROM `rc_plan` WHERE `IDPlan`='3' or `IDPlan`='4' or `IDPlan`='5' or `IDPlan`='6' or `IDPlan`='7' or `IDPlan`='11' or `IDPlan`='13' or `IDPlan`='15' or `IDPlan`='16'";
						$plan_B=new row_evaluation($plan_BSql);
						foreach($plan_B->print_evaluation_array() as $rc_quota=>$plan_Brow){ 
						
							$rc_planSql="SELECT `qce_key`, `qtt_key` FROM `quota_choose_exam` WHERE `qtt_key`='{$print_quotaRow["IDPlan"]}' and `qce_key`='{$plan_Brow["IDPlan"]}'";
							$rc_plan=new row_quotanotarray($rc_planSql);
							
								foreach($rc_plan->print_quotanotarray()as $quota_key=>$rc_planRow){
									if($rc_planRow["qce_key"]==$plan_Brow["IDPlan"]){
										$selected_plan="selected";
									}else{
										$selected_plan="";
									}  
								}
								
								if($selected_plan=="selected"){ ?>
									<option value="<?php echo $plan_Brow["IDPlan"];?>" selected="selected"><?php echo $plan_Brow["Name"]." (".$plan_Brow["LName"].")";?></option>
					<?php		}else{ ?>
									<option value="<?php echo $plan_Brow["IDPlan"];?>"><?php echo $plan_Brow["Name"]." (".$plan_Brow["LName"].")";?></option>
					<?php		}			
							} ?>				
								</optgroup>
							</select>
						</div>
						<div class="col-<?php echo $grid;?>-12">
							<p><center><button type="submit" name="stu_Plan" value="<?php echo $print_quotaRow["IDPlan"];?>" class="btn btn-default">บันทึก</button></center></p>
						</div>
					</div>
<input type="hidden" name="user_login" value="<?php echo $user_login;?>">					
<input type="hidden" name="myname" value="<?php echo $myname;?>">					
<input type="hidden" name="group" value="<?php echo $group;?>">					
	</form>						
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				</div>
	
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
				</div>
			</div>
		  
			</div>
		</div>	
<!-- Modal -->		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--#######################################################################-->
	<script>
	$(document).ready(function(){
		$("#myBtn_iqtp<?php echo $btn_count;?>").click(function(){
		$("#myModa_iqtp<?php echo $btn_count;?>").modal({backdrop: false});
		});
	});
	</script>



<!--#######################################################################-->
	<?php	$btn_count=$btn_count+1;} ?>	
</div>


	