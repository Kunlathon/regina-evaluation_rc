<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="stats-in-th" content="b062" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="shortcut icon" type="image/png">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="72x72">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="114x114">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="144x144">
		<link rel="shortcut icon" href="<?php echo base_url();?>/Template/global_assets/images/logo_rc_wbe.ico"/>
		
		<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/bootstrap.min.js"></script>	
<!--****************************************************************************-->			

<!-- Theme JS files colors_pink.html-->
		<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery_ui/core.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/selectboxit.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/pnotify.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/noty.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/jgrowl.min.js"></script>

		<script>
			$(document).ready(function () {
				$(".styled").uniform({
					wrapperClass: "border-pink text-pink-600"
				});	
			})
		</script>

		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/ripple.min.js"></script>
<!-- /theme JS files -->

<!-- Theme JS files -->
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
<!-- /theme JS files -->

		<script type="text/javascript">
			function setScreenHWCookie() {
				$.cookie('sw',screen.width);
					//$.cookie('sh',screen.height);
				return true;
			}
				setScreenHWCookie();
		</script>

		<?php
			$width_system=filter_input(INPUT_COOKIE,'sw');
			if($width_system>=1200){
				$grid="lg";
			}elseif($width_system<=992){
				$grid="md";
			}elseif($width_system<=768){
				$grid="sm";
			}else{
				$grid="xs";
			}
		?>
<!--****************************************************************************-->		
	</head>

	<body class="col-<?php echo $grid;?>-12">
		<?php
			$this->load->library('session');						
//-------------------------------------------------------------------------------    
			include("view/img_user/document/gotolink.php");//--------------------
			$goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//-------------
			$golink=$goingtolink->Rungotolink();//-------------------------------
//-------------------------------------------------------------------------------
			include("view/database/pdo_data.php");
			include("view/database/pdo_quota.php");
			include("view/database/class_quota.php");
//-------------------------------------------------------------------------------			
				if($this->session->userdata("rc_user")==null){
					$this->session->unset_userdata("rc_user");
					exit("<script>window.location='$golink';</script>");
				}else{ 
					$txt_year=filter_input(INPUT_POST,'txt_year');
					$txt_level=filter_input(INPUT_POST,'txt_level');
					$data_stu=filter_input(INPUT_POST,'data_stu');
					$next_yaer=$txt_year+1;
					
						if($txt_level==23){
							$class_new=31;
							$class_new_txt="มัธยมศึกษาปีที่ 1";
						}elseif($txt_level==33){
							$class_new=41;
							$class_new_txt="มัธยมศึกษาปีที่ 4";
						}else{
							$class_new='-';
							$class_new_txt='-';
						}					
					
				?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div>รหัสนักเรียน&nbsp;<?php echo $data_stu;?></div>
					<div>สิทธิ์โควตาที่ได้...</div>
				</div>
				<div class="panel-body">
				
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<fieldset class="content-group">
								<div class="form-group">
									<div class="row">
										
					<?php
						$rc_quotas=new internal_quota_rights($data_stu,$next_yaer,$class_new);
						$countA=0;
						foreach($rc_quotas->print_internal_quota_rights() as $rc=>$rc_quotasRow){ 
							$countA=$countA+1
							?>
							
					<?php
						$TestQuotaRight=new RowQuotaRight($data_stu,$next_yaer,$class_new);
							if(!isset($TestQuotaRight->qr_plan)){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<div class="col-<?php echo $grid;?>-12">
											<label class="radio-inline">
												<input type="radio" id="Plan<?php echo $countA;?>" name="Plan" class="styled" name="pink-radio"  value="<?php echo $rc_quotasRow["quota_plan"];?>">
												<?php echo $rc_quotasRow["Name"]." (".$rc_quotasRow["LName"].")";?>
											</label>									
										</div>								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
					<?php	}elseif($TestQuotaRight->qr_plan==$rc_quotasRow["quota_plan"]){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<div class="col-<?php echo $grid;?>-12">
											<label class="radio-inline">
												<input type="radio" id="Plan<?php echo $countA;?>" name="Plan" class="styled" name="pink-radio" checked="checked" value="<?php echo $rc_quotasRow["quota_plan"];?>">
												<?php echo $rc_quotasRow["Name"]." (".$rc_quotasRow["LName"].")";?>
											</label>									
										</div>							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
					<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<div class="col-<?php echo $grid;?>-12">
											<label class="radio-inline">
												<input type="radio" id="Plan<?php echo $countA;?>" name="Plan" class="styled" name="pink-radio"  value="<?php echo $rc_quotasRow["quota_plan"];?>">
												<?php echo $rc_quotasRow["Name"]." (".$rc_quotasRow["LName"].")";?>
											</label>									
										</div>								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
					<?php	}?>
			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<script>
			$(document).ready(function () {	
			
				$('#Plan<?php echo $countA;?>').on('click', function() {
					var PlanTxtL="<?php echo $rc_quotasRow["LName"];?>"
					var PlanTxt="<?php echo $rc_quotasRow["Name"];?>"
					var PlanId=$("#Plan<?php echo $countA;?>").val();
					var SudId="<?php echo $data_stu;?>"
					var YearNext="<?php echo $next_yaer;?>"
					var Year="<?php echo $txt_year;?>"
					var ClassNew="<?php echo $class_new;?>"
					var Class="<?php echo $txt_level;?>"					
					swal({
						title: "แผนการเรียน "+PlanTxt+" ("+PlanTxtL+")",
						text: "ดำเนินการลงทะเบียนแผนการเรียนนี้",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#EF5350",
						confirmButtonText: "ใช้ ต้องการเลือก!",
						cancelButtonText: "ไม่, ต้องการเลือก!",
						closeOnConfirm: false,
						closeOnCancel: false
					},function(isConfirm){
						if(isConfirm){
							swal({
								title: "ต้องการเลือก",
								text: "แผนการเรียน "+PlanTxt+" ("+PlanTxtL+")",
								confirmButtonColor: "#66BB6A",
								type: "success"
							},function(qsq){
								if(SudId!="" && PlanId!="" && YearNext!="" && Year!="" && ClassNew!="" && Class!=""){
									$.post("<?php echo base_url();?>/Quota_print/qm_upin_quota",{
										SudId:SudId,
										PlanId:PlanId,
										YearNext:YearNext,
										Year:Year,
										ClassNew:ClassNew,
										Class:Class										
									},function(run_qsq){
										if(run_qsq!=""){
											$("#Goto_qsq").html(run_qsq)
										}else{}										
									})
								}else{}
							});
						}else{
							swal({
								title: "ไม่ต้องการเลือก",
								text: "แผนการเรียน "+PlanTxt+" ("+PlanTxtL+")",
								confirmButtonColor: "#2196F3",
								type: "error"
							});
						}
					});
				});			
			})
		</script>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										
						<?php 
							$countA=$countA+1;
						} ?>										
										
									</div>
									

									
								</div>
							</fieldset>
						</div>
					</div>
				
				
				
				</div>
			</div>		
		</div>	
	</div>
<div id="Goto_qsq"></div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	} ?>
	</body>
</html>