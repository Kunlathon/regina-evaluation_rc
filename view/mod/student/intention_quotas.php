<style>
	.solid{
		border-style: solid;
		border-width: 5px;
		border-color: #0000FF;
	}
	#RuningLoadTalent{
		display:none;
	}
</style>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<div id="RunLoadTalent">
					<img class="img-thumbnail" src="Template/global_assets/images/Cube-1s-200px.gif" />
				</div>	
			</center>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	$OFFONDateTime=date("2023-07-19 08:00:00");//Time Open
	//$OFFONDateTime=date("2021-07-24 08:00:00");
	$OFFONDateTime_Cr=date("Y-m-d H:i:s");
	$OFFONDateTime_notrun=strtotime($OFFONDateTime);
	$OFFONDateTime_run=strtotime($OFFONDateTime_Cr);
//+++++++++++++++23End	
		if($OFFONDateTime_run>=$OFFONDateTime_notrun){
			$OFFONPrint_runtime="ON";
		}else{
			$OFFONPrint_runtime="OFF"; 
		}
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
		if($OFFONPrint_runtime=="OFF"){ ?>
<!--##########################################################-->
<div id="RuningLoadTalent">
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alpha-teal border-teal alert-styled-left">
					ประกาศรายชื่อผู้มีสิทธิ์ได้รับโควตา ปีการศึกษา 2567 เปิดระบบในวันที่ 19 ก.ค. 2565 เวลา 08.00 เป็นต้นไป
				</div>
			</div>
		</div>
	</div>		
</div>		
<!--##########################################################-->		
<?php	}elseif($OFFONPrint_runtime=="ON"){ ?>
<!--##########################################################-->
	<div id="RuningLoadTalent">
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$test_system="ON";
		switch($test_system){
			case "OFF": ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alpha-teal border-teal alert-styled-left">
					ขออภัยในความสะดวก เจ้าหน้าที่ ICT กำลังทดสอบระบบ... 
				</div>
			</div>
		</div>
	</div>		
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	break;
			default:
	//---------------------------------------------------------------		
		}
	?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		include("view/database/pdo_quota.php");
		include("view/database/pdo_data.php");
		include("view/database/class_quota.php");
	//+++++++++++++++++++++++++++++++++++++++++++*****************
		$data_yaer=2566;
		$user_login;
		//********************************************************
		$next_yaer=2567;
		//********************************************************
	//ข้อมูลนักเรียน 
		$call_sturc=new regina_stu_data($user_login);
	//ระดับชั้น
		$call_stu=new stu_levelpdo($user_login,$data_yaer,"1");
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
		if($call_stu->IDLevel==23){
			$class_new=31;
			$class_new_txt="มัธยมศึกษาปีที่ 1";
		}elseif($call_stu->IDLevel==33){
			$class_new=41;
			$class_new_txt="มัธยมศึกษาปีที่ 4";
		}else{
			$class_new=null;
			$class_new_txt=null;
		}
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	?>
		<script>
			$(document).ready(function(){
				$("#rc_quotasA").click(function (){
					var button_quota="bqA";
					var copy_user_login="<?php echo $user_login;?>";
					var copy_data_yaer="<?php echo $data_yaer;?>";
					var copy_next_yaer="<?php echo $next_yaer;?>";
					var copy_class="<?php echo $call_stu->IDLevel;?>";
					var copy_class_new="<?php echo $class_new;?>";
					var copy_class_new_txt="<?php echo $class_new_txt;?>";
					
						if(button_quota !="" && copy_user_login!="" && copy_data_yaer!="" && copy_next_yaer!="" && copy_class!="" && copy_class_new!="" && copy_class_new_txt!=""){
							$.post("view/mod/student/code/intention_quotas/run_quota.php",{
								quota_txt:button_quota,
								quota_user_login:copy_user_login,
								quota_data_yaer:copy_data_yaer,
								quota_next_yaer:copy_next_yaer,
								quota_class:copy_class,
								quota_class_new:copy_class_new,
								quota_class_new_txt:copy_class_new_txt
							},function(quota){
								if(quota!=""){
									$("#run_quota").html(quota);
								}else{}
							})
						}else{}
				})
				
			})
		</script>
		<script>
			$(document).ready(function(){
				$("#rc_quotasB").click(function (){
					var button_quota="bqB";
					var copy_user_login="<?php echo $user_login;?>";
					var copy_data_yaer="<?php echo $data_yaer;?>";
					var copy_next_yaer="<?php echo $next_yaer;?>";
					var copy_class="<?php echo $call_stu->IDLevel;?>";
					var copy_class_new="<?php echo $class_new;?>";
					var copy_class_new_txt="<?php echo $class_new_txt;?>";				
						if(button_quota !="" && copy_user_login!="" && copy_data_yaer!="" && copy_next_yaer!="" && copy_class!="" && copy_class_new!="" && copy_class_new_txt!=""){
							$.post("view/mod/student/code/intention_quotas/run_quota.php",{
								quota_txt:button_quota,
								quota_user_login:copy_user_login,
								quota_data_yaer:copy_data_yaer,
								quota_next_yaer:copy_next_yaer,
								quota_class:copy_class,
								quota_class_new:copy_class_new,
								quota_class_new_txt:copy_class_new_txt
							},function(quota){
								if(quota!=""){
									$("#run_quota").html(quota);
								}else{}
							})
						}else{}
				})
				
			})
		</script>
	<?php
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	//+++++++++++++++23
		//$End23DateTime=date("2021-08-06 17:00:00");
		$End23DateTime=date("2023-12-01 00:00:00");//time End----------------------------------
		$End23DateTime_Cr=date("Y-m-d H:i:s");
		$End23DateTime_notrun=strtotime($End23DateTime);
		$End23DateTime_run=strtotime($End23DateTime_Cr);
	//+++++++++++++++23End	
			if($End23DateTime_run>=$End23DateTime_notrun){
				$End23Print_runtime="OFF";
			}else{
				$End23Print_runtime="ON";
			}
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//+++++++++++++++33
		//$End33DateTime=date("2021-08-06 17:00:00");
		$End33DateTime=date("2023-12-01 00:00:00");//Time End***********************************
		$End33DateTime_Cr=date("Y-m-d H:i:s");
		$End33DateTime_notrun=strtotime($End33DateTime);
		$End33DateTime_run=strtotime($End33DateTime_Cr);
	//+++++++++++++++33End	
			if($End33DateTime_run>=$End33DateTime_notrun){
				$End33Print_runtime="OFF";
			}else{
				$End33Print_runtime="ON";
			}
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
			if($call_stu->IDLevel==23){ ?>
	<!--***********************************************************-->	
	<!--***********************************************************-->	
			<?php
				switch($End23Print_runtime){
					case "OFF": ?>
	<!--------------------------------------------------------------->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					สิ้นสุดระยะเวลาดำเนินการ ประกาศรายชื่อผู้มีสิทธิ์ได้รับโควตา ปีการศึกษา <?php echo $next_yaer;?> ติดต่อฝ่ายวิชาการ โทรศัพท์ 053-282395 ต่อ 121 หรือ 122
				</div>
			</div>
		</div>
	</div>		
	<!--------------------------------------------------------------->		
			<?php	break;
					case "ON":  ?>
	<!--------------------------------------------------------------->
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-success">
					<div class="panel-heading"><center><h5>เหลือเวลาประกาศรายชื่อผู้มีสิทธิ์ได้รับโควตา ปีการศึกษา <?php echo $next_yaer;?><div id="demoA"></div></h5></center></div>
				</div>
			</div>
		</div><hr>			
	<!--------------------------------------------------------------->		
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-teal">
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<h6 class="content-group text-semibold">
								ประกาศรายชื่อผู้มีสิทธิ์ได้รับโควตาเข้าศึกษาต่อในระดับชั้น<?php echo $class_new_txt;?> ปีการศึกษา <?php echo $next_yaer;?>
								<small class="display-block">โรงเรียนเรยีนาเชลีวิทยาลัย</small>
							</h6>
						</div>
					</div>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->		
		<?php
				$InternalSaveRightsTest=new InternalSaveRightsTest($user_login,$data_yaer);
					if($InternalSaveRightsTest->RunInternalSaveRightsTest()>=1){ ?>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-teal">
					<div class="row" style="font-size: 17px">
						<div class="col-<?php echo $grid;?>-12">
							<div class="content-group text-semibold solid" align="center">
								
								<div class="row">
									<div class="col-<?php echo $grid;?>-12" >
									<?php echo $myname;?>				
									</div>
								</div>
								<div class="row">
									<div class="col-<?php echo $grid;?>-12">
									ได้รับสิทธิ์โควตาเข้าศึกษาต่อในระดับชั้น<?php echo $class_new_txt;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $next_yaer;?>
									</div>
								</div>
								<div class="row">
									<div class="col-<?php echo $grid;?>-12">
									โรงเรียนเรยีนาเชลีวิทยาลัย
									</div>
								</div><hr>	

								<?php
									$Run_quota_capital=new Run_quota_capital($user_login,$next_yaer,$class_new);
										if($Run_quota_capital->Print_quota_capital()!="-"){ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<div class="row">
									<div class="col-<?php echo $grid;?>-12">
										<div class="content-group-<?php echo $grid;?>">
											<div class="alert alpha-green-600 border-green ">
												<div class="row">
													<div class="col-<?php echo $grid;?>-12" style="color:#006400;font-size: 20px;">
													ขอแสดงความยินดีที่นักเรียนเป็นผู้มีสิทธิ์ได้รับทุนการศึกษา : <?php echo $Run_quota_capital->Print_quota_capital();?>
													</div>
												</div>
												<div class="row">								
													<div class="col-<?php echo $grid;?>-12">
													<!--ให้นักเรียนยื่นเอกสารขอรับทุนที่งานแนะแนว ตั้งแต่ วันที่ 9-13 สิงหาคม 2564 และทางโรงเรียนจะประกาศรายชื่อผู้รับทุนการศึกษา ในวันที่ 17 สิงหาคม 2564-->
													</div>								
												</div>
											</div>
										</div>
									</div>				
								</div>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}else{
				//------------------------------------------------------------------------------------------							
										}
								?>
								
								<div class="row">
									<div class="col-<?php echo $grid;?>-4" align="center">
									หลักสูตรที่ได้รับสิทธิ์โควตา
									</div>
									<div class="col-<?php echo $grid;?>-8" align="left">
								 <?php
										$rc_quotas=new internal_quota_rights($user_login,$next_yaer,$class_new);
										$countA=0;
										foreach($rc_quotas->print_internal_quota_rights() as $rc=>$rc_quotasRow){ 
										$countA=$countA+1
										?>
											<div><?php echo $countA;?>&nbsp;.&nbsp;หลักสูตรห้องเรียน<?php echo $rc_quotasRow["LName"];?></div>
								  <?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>				
				</div>
			</div>
		</div>
	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="content-group-<?php echo $grid;?>">
					<div class="alert alert-primary alert-styled-left">
						ดำเนินการเรียบร้อยแล้ว
					</div>
				</div>		
			</div>
		</div>
	<form name="print_quota" action="quota_print/print_intention/<?php echo $next_yaer;?>/<?php echo $user_login; ?>" method="post" target="_blank"> 
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<center>
					<!--<button type="submit" name="rc_quotasA" class="btn btn-success">พิมพ์แบบแจ้งความจำนง</button>-->
					<!--<button type="button" id="DeleteQuotas" class="btn btn-warning">ยกเลิกแบบแจ้งความจำนง</button>-->
				</center>
			</div>
		</div>		
		<input type="hidden" name="print_key" value="<?php echo $user_login; ?>">
		<input type="hidden" name="print_year" value="<?php echo $data_yaer; ?>">
		<input type="hidden" name="print_yearnew" value="<?php echo $next_yaer;?>">
	</form>	
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
	<script>
		$(document).ready(function(){
		
			$('#DeleteQuotas').on('click', function() {
				var txt_sud="<?php echo $user_login; ?>";
				var txt_year="<?php echo $data_yaer; ?>";
				var txt_yearnew="<?php echo $next_yaer;?>";				
				swal({
					title:"ต้องการยกเลิกแบบแจ้งความจำนงใช้หรือไม่",
					text: "ถ้าต้องการยกเลิก ให้กด OK ถ้าไม่ให้กด Cancel",
					type: "info",
					showCancelButton: true,
					closeOnConfirm: false,
					confirmButtonColor: "#2196F3",
					showLoaderOnConfirm: true
				},
				function() {
					setTimeout(function() {
						swal({
							title: "ดำเนินการยกเลิกแบบแจ้งความจำนง!",
							confirmButtonColor: "#2196F3"
						},function(){
							if(txt_sud !="" && txt_year!="" && txt_yearnew!=""){
								$.post("<?php echo $golink;?>/quota_print/delete_form",{
									txt_sud:txt_sud,
									txt_year:txt_year,
									txt_yearnew:txt_yearnew
								},function(quotas){
									if(quotas !=""){
										document.location="<?php echo $golink;?>/?evaluation_mod=intention_quotas"
									}else{}
								})
							}else{}							
						});
					}, 1000);
				});
			});
						
		})
	</script>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
		<?php		}else{ ?>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->				
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
					<?php	
						$rc_quotas=new internal_quota_rights($user_login,$next_yaer,$class_new);
							if(is_array($rc_quotas->print_internal_quota_rights()) && count($rc_quotas->print_internal_quota_rights())){ ?>

		<div class="row" style="font-size: 17px">
			<div class="col-<?php echo $grid;?>-12">
				<div class="content-group text-semibold solid" align="center">
					
					<div class="row">
						<div class="col-<?php echo $grid;?>-12" >
						<?php echo $myname;?>				
						</div>
					</div>
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
						ได้รับสิทธิ์โควตาเข้าศึกษาต่อในระดับชั้น<?php echo $class_new_txt;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $next_yaer;?>
						</div>
					</div>
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
						โรงเรียนเรยีนาเชลีวิทยาลัย
						</div>
					</div><hr>	

					<?php
						$Run_quota_capital=new Run_quota_capital($user_login,$next_yaer,$class_new);
							if($Run_quota_capital->Print_quota_capital()!="-"){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="content-group-<?php echo $grid;?>">
								<div class="alert alpha-green-600 border-green ">
									<div class="row">
										<div class="col-<?php echo $grid;?>-12" style="color:#006400;font-size: 20px;">
										ขอแสดงความยินดีที่นักเรียนเป็นผู้มีสิทธิ์ได้รับทุนการศึกษา : <?php echo $Run_quota_capital->Print_quota_capital();?>
										</div>
									</div>
									<div class="row">								
										<div class="col-<?php echo $grid;?>-12">
										<!--ให้นักเรียนยื่นเอกสารขอรับทุนที่งานแนะแนว ตั้งแต่ วันที่ 9-13 สิงหาคม 2564 และทางโรงเรียนจะประกาศรายชื่อผู้รับทุนการศึกษา ในวันที่ 17 สิงหาคม 2564-->
										</div>								
									</div>
								</div>
							</div>
						</div>				
					</div>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
					<?php	}else{
	//------------------------------------------------------------------------------------------							
							}
					?>
					
					<div class="row">
						<div class="col-<?php echo $grid;?>-4" align="center">
						หลักสูตรที่ได้รับสิทธิ์โควตา
						</div>
						<div class="col-<?php echo $grid;?>-8" align="left">
					 <?php
							$countA=0;
							foreach($rc_quotas->print_internal_quota_rights() as $rc=>$rc_quotasRow){ 
							$countA=$countA+1
							?>
								<div><?php echo $countA;?>&nbsp;.&nbsp;หลักสูตรห้องเรียน<?php echo $rc_quotasRow["LName"];?></div>
					  <?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<fieldset class="content-group">
					<div class="form-group">
						<div class="col-<?php echo $grid;?>-12" align="center">
							<!--<button type="button" name="rc_quotasA" id="rc_quotasA" class="btn btn-success">รักษาสิทธิ์</button>-->
							<!--<button type="button" name="rc_quotasB" id="rc_quotasB" class="btn btn-info">สละสิทธิ์</button>-->
						</div>
					</div>
				<fieldset>
			</div>
		</div>	
		<hr>
		<div class="row">
			<div class="col-<?php echo $grid;?>-3">
				<a href=".?evaluation_mod=rc_quota"><img src="Template/global_assets/images/QuotaBotton-02.png" width="300" height="100" class="img-thumbnail" alt="การมอบตัวโควตาภายใน" style="background-image: url('Template/global_assets/images/new-menu.gif'); background-repeat: no-repeat;  background-position: left top; background-size: 15%;"></a>
			</div>
			<div class="col-<?php echo $grid;?>-9"></div>
		</div>
		
		<form name="intention_quota" class="form-horizontal form-validate-jquery" action="./?evaluation_mod=intention_quotas_code" method="post">
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<div id="run_quota"></div>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		</form>		
					<?php	}else{ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					ติดต่อฝ่ายวิชาการ (ในวันและเวลาราชการ) โทรศัพท์ 053-282395 ต่อ 121 หรือ 122
				</div>
			</div>
		</div>
	</div>
	<!--<div class="row">
		<div class="col-<?php //echo $grid;?>-12">
			<div class="content-group-<?php //echo $grid;?>">
				<h6 class="content-group text-semibold">
				 
				</h6>
			</div>
		</div>
	</div>-->							
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
					<?php	}  ?>			
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php		} ?>
				</div>
			</div>
		</div>
	<!--------------------------------------------------------------->		
			<?php	break;
					default:    ?>
	<!--------------------------------------------------------------->		
	<!--------------------------------------------------------------->		
			<?php	}?>	
	<!--***********************************************************-->	
	<!--***********************************************************-->		
	<?php	}elseif($call_stu->IDLevel==33){ ?>
	<!--***********************************************************-->	
	<!--***********************************************************-->	
			<?php
				switch($End33Print_runtime){
					case "OFF": ?>
	<!--------------------------------------------------------------->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					สิ้นสุดระยะเวลาดำเนินการ ประกาศรายชื่อผู้มีสิทธิ์ได้รับโควตา ปีการศึกษา <?php echo $next_yaer;?> ติดต่อฝ่ายวิชาการ โทรศัพท์ 053-282395 ต่อ 121 หรือ 122
				</div>
			</div>
		</div>
	</div>		
	<!--------------------------------------------------------------->		
			<?php	break;
					case "ON":  ?>
	<!--------------------------------------------------------------->
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-success">
					<div class="panel-heading"><center><h5>เหลือเวลาประกาศรายชื่อผู้มีสิทธิ์ได้รับโควตา ปีการศึกษา <?php echo $next_yaer;?><div id="demoB"></div></h5></center></div>
				</div>
			</div>
		</div><hr>		
	<!--------------------------------------------------------------->		
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-teal">
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<h6 class="content-group text-semibold">
								ประกาศรายชื่อผู้มีสิทธิ์ได้รับโควตาเข้าศึกษาต่อในระดับชั้น<?php echo $class_new_txt;?> ปีการศึกษา <?php echo $next_yaer;?>
								<small class="display-block">โรงเรียนเรยีนาเชลีวิทยาลัย</small>
							</h6>
						</div>
					</div>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->		
		<?php
				$InternalSaveRightsTest=new InternalSaveRightsTest($user_login,$data_yaer);
					if($InternalSaveRightsTest->RunInternalSaveRightsTest()>=1){ ?>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="row" style="font-size: 17px">
					<div class="col-<?php echo $grid;?>-12">
						<div class="content-group text-semibold solid" align="center">
							
							<div class="row">
								<div class="col-<?php echo $grid;?>-12" >
								<?php echo $myname;?>				
								</div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">
								ได้รับสิทธิ์โควตาเข้าศึกษาต่อในระดับชั้น<?php echo $class_new_txt;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $next_yaer;?>
								</div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">
								โรงเรียนเรยีนาเชลีวิทยาลัย
								</div>
							</div><hr>	

							<?php
								$Run_quota_capital=new Run_quota_capital($user_login,$next_yaer,$class_new);
									if($Run_quota_capital->Print_quota_capital()!="-"){ ?>
			<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">
									<div class="content-group-<?php echo $grid;?>">
										<div class="alert alpha-green-600 border-green ">
											<div class="row">
												<div class="col-<?php echo $grid;?>-12" style="color:#006400;font-size: 20px;">
												ขอแสดงความยินดีที่นักเรียนเป็นผู้มีสิทธิ์ได้รับทุนการศึกษา : <?php echo $Run_quota_capital->Print_quota_capital();?>
												</div>
											</div>
											<div class="row">								
												<div class="col-<?php echo $grid;?>-12">
												<!--ให้นักเรียนยื่นเอกสารขอรับทุนที่งานแนะแนว ตั้งแต่ วันที่ 9-13 สิงหาคม 2564 และทางโรงเรียนจะประกาศรายชื่อผู้รับทุนการศึกษา ในวันที่ 17 สิงหาคม 2564-->
												</div>								
											</div>
										</div>
									</div>
								</div>				
							</div>
			<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
							<?php	}else{
			//------------------------------------------------------------------------------------------							
									}
							?>
							
							<div class="row">
								<div class="col-<?php echo $grid;?>-4" align="center">
								แผนการเรียนที่ได้รับสิทธิ์โควตา
								</div>
								<div class="col-<?php echo $grid;?>-8" align="left">
							 <?php
									$countA=0;
									$rc_quotas=new internal_quota_rights($user_login,$next_yaer,$class_new);
									foreach($rc_quotas->print_internal_quota_rights() as $rc=>$rc_quotasRow){ 
									$countA=$countA+1
									?>
										<div><?php echo $countA;?>&nbsp;.&nbsp;แผนการเรียน <?php echo $rc_quotasRow["LName"];?></div>
							  <?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>			
			</div>
		</div>
	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="content-group-<?php echo $grid;?>">
					<div class="alert alert-primary alert-styled-left">
						ดำเนินการเรียบร้อยแล้ว
					</div>
				</div>		
			</div>
		</div>
	<form name="print_quota" action="quota_print/print_intention/<?php echo $next_yaer;?>/<?php echo $user_login; ?>" method="post" target="_blank"> 	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<!--<center><button type="submit" name="rc_quotasA" class="btn btn-success">พิมพ์แบบแจ้งความจำนง</button></center>-->
				<!--<button type="button" id="DeleteQuotas" class="btn btn-warning">ยกเลิกแบบแจ้งความจำนง</button>-->
			</div>
		</div>		
		<input type="hidden" name="print_key" value="<?php echo $user_login; ?>">
		<input type="hidden" name="print_year" value="<?php echo $data_yaer; ?>">
		<input type="hidden" name="print_yearnew" value="<?php echo $next_yaer;?>">
	</form>		
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
	<script>
		$(document).ready(function(){
		
			$('#DeleteQuotas').on('click', function() {
				var txt_sud="<?php echo $user_login; ?>";
				var txt_year="<?php echo $data_yaer; ?>";
				var txt_yearnew="<?php echo $next_yaer;?>";				
				swal({
					title:"ต้องการยกเลิกแบบแจ้งความจำนงใช้หรือไม่",
					text: "ถ้าต้องการยกเลิก ให้กด OK ถ้าไม่ให้กด Cancel",
					type: "info",
					showCancelButton: true,
					closeOnConfirm: false,
					confirmButtonColor: "#2196F3",
					showLoaderOnConfirm: true
				},
				function() {
					setTimeout(function() {
						swal({
							title: "ดำเนินการยกเลิกแบบแจ้งความจำนง!",
							confirmButtonColor: "#2196F3"
						},function(){
							if(txt_sud !="" && txt_year!="" && txt_yearnew!=""){
								$.post("<?php echo $golink;?>/quota_print/delete_form",{
									txt_sud:txt_sud,
									txt_year:txt_year,
									txt_yearnew:txt_yearnew
								},function(quotas){
									if(quotas !=""){
										document.location="<?php echo $golink;?>/?evaluation_mod=intention_quotas"
									}else{}
								})
							}else{}							
						});
					}, 1000);
				});
			});
						
		})
	</script>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->					
		<?php		}else{ ?>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->				
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
					<?php	
						$rc_quotas=new internal_quota_rights($user_login,$next_yaer,$class_new);
							if(is_array($rc_quotas->print_internal_quota_rights()) && count($rc_quotas->print_internal_quota_rights())){ ?>

		<div class="row" style="font-size: 17px">
			<div class="col-<?php echo $grid;?>-12">
				<div class="content-group text-semibold solid" align="center">
					
					<div class="row">
						<div class="col-<?php echo $grid;?>-12" >
						<?php echo $myname;?>				
						</div>
					</div>
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
						ได้รับสิทธิ์โควตาเข้าศึกษาต่อในระดับชั้น<?php echo $class_new_txt;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $next_yaer;?>
						</div>
					</div>
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
						โรงเรียนเรยีนาเชลีวิทยาลัย
						</div>
					</div><hr>	

					<?php
						$Run_quota_capital=new Run_quota_capital($user_login,$next_yaer,$class_new);
							if($Run_quota_capital->Print_quota_capital()!="-"){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="content-group-<?php echo $grid;?>">
								<div class="alert alpha-green-600 border-green ">
									<div class="row">
										<div class="col-<?php echo $grid;?>-12" style="color:#006400;font-size: 20px;">
										ขอแสดงความยินดีที่นักเรียนเป็นผู้มีสิทธิ์ได้รับทุนการศึกษา : <?php echo $Run_quota_capital->Print_quota_capital();?>
										</div>
									</div>
									<div class="row">								
										<div class="col-<?php echo $grid;?>-12">
										<!--ให้นักเรียนยื่นเอกสารขอรับทุนที่งานแนะแนว ตั้งแต่ วันที่ 9-13 สิงหาคม 2564 และทางโรงเรียนจะประกาศรายชื่อผู้รับทุนการศึกษา ในวันที่ 17 สิงหาคม 2564-->
										</div>								
									</div>
								</div>
							</div>
						</div>				
					</div>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
					<?php	}else{
	//------------------------------------------------------------------------------------------							
							}
					?>
					
					<div class="row">
						<div class="col-<?php echo $grid;?>-4" align="center">
						แผนการเรียนที่ได้รับสิทธิ์โควตา
						</div>
						<div class="col-<?php echo $grid;?>-8" align="left">
					 <?php
							$countA=0;
							foreach($rc_quotas->print_internal_quota_rights() as $rc=>$rc_quotasRow){ 
							$countA=$countA+1
							?>
								<div><?php echo $countA;?>&nbsp;.&nbsp;แผนการเรียน <?php echo $rc_quotasRow["LName"];?></div>
					  <?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<fieldset class="content-group">
					<div class="form-group">
						<div class="col-<?php echo $grid;?>-12" align="center">
							<!--<button type="button" name="rc_quotasA" id="rc_quotasA" class="btn btn-success">รักษาสิทธิ์</button>-->
							<!--<button type="button" name="rc_quotasB" id="rc_quotasB" class="btn btn-info">สละสิทธิ์</button>-->
						</div>
					</div>
				<fieldset>
			</div>
		</div>	
		<hr>
		<div class="row">
			<div class="col-<?php echo $grid;?>-3">
				<a href=".?evaluation_mod=rc_quota"><img src="Template/global_assets/images/QuotaBotton-02.png" width="300" height="100" class="img-thumbnail" alt="การมอบตัวโควตาภายใน" style="background-image: url('Template/global_assets/images/new-menu.gif'); background-repeat: no-repeat;  background-position: left top; background-size: 15%;"></a>
			</div>
			<div class="col-<?php echo $grid;?>-9">
				<div><b>หมายเหตุ</b></div>
				<ul>
					<li>นักเรียนส่งใบแจ้งความจำนงเข้าศึกษาต่อ ที่ครูประจำชั้น ภายในวันที่ 19 - 20 กรกฎาคม พ.ศ. 2565</li>
					<li>เมื่อส่งใบแจ้งความจำนงแล้ว จึงจะสามารถดำเนินการมอบตัว ได้ตั้งแต่วันที่ 19 กรกฎาคม พ.ศ. 2565 เป็นต้นไป</li>
				</ul>
			</div>
		</div>		
		
		<form name="intention_quota" class="form-horizontal form-validate-jquery" action="./?evaluation_mod=intention_quotas_code" method="post">
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<div id="run_quota"></div>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		</form>		
					<?php	}else{ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					ติดต่อฝ่ายวิชาการ  (ในวันและเวลาราชการ) โทรศัพท์ 053-282395 ต่อ 121 หรือ 122
				</div>
			</div>
		</div>
	</div>
	<!--<div class="row">
		<div class="col-<?php //echo $grid;?>-12">
			<div class="content-group-<?php //echo $grid;?>">
				<h6 class="content-group text-semibold">
				 
				</h6>
			</div>
		</div>
	</div>-->							
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
					<?php	}  ?>			
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php		} ?>
				</div>
			</div>
		</div>
	<!--------------------------------------------------------------->		
			<?php	break;
					default:    ?>
	<!--------------------------------------------------------------->		
	<!--------------------------------------------------------------->		
			<?php	}?>	
	<!--***********************************************************-->	
	<!--***********************************************************-->			
	<?php	}else{ ?>
	<!--***********************************************************-->		
	<!--***********************************************************-->		
	<?php	}      ?>
	</div>		
<!--##########################################################-->		
<?php	}else{} ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
