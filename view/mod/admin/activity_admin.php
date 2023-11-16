
<?php
	include("view/database/pdo_data.php");
	include("view/database/class_pdo.php");	
	
	include("view/database/database_paynew.php");
	include("view/database/class_pay.php");
	
	include("view/database/pdo_activity.php");
	include("view/database/class_activity.php");
	
	$data_yaer=filter_input(INPUT_POST,'ra_year');  
	$data_term=filter_input(INPUT_POST,'ra_term');  

	$SudRc=filter_input(INPUT_POST,'ra_sudkey'); 
	


	$data_stu=new stu_levelpdo($SudRc,$data_yaer,$data_term);		
		if(($data_stu->IDLevel>=3 and $data_stu->IDLevel<=3)){ ?>
<!--*******************************************************************************************-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong> ระดับชั้น อนุบาล การใช้งานในส่วนนี้ยังไม่เปิดใช้บริการ 
			</div>			
		</div>
	</div><hr>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>				
				<button type="button" id="GoTo" class="btn btn-success btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button>												
					<button type="button" id="GoToHome" class="btn btn-info btn-lg">หน้าสู่เมนูหลัก</button>
			</center>						
		</div>
	</div>	
<!--*******************************************************************************************-->			
<?php	}elseif(($data_stu->IDLevel>=11 and $data_stu->IDLevel<=13)){ ?>
<!--*******************************************************************************************-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong> ระดับชั้น ประถมศึกษาปีที่ 1-3 การใช้งานในส่วนนี้ยังไม่เปิดใช้บริการ 
			</div>			
		</div>
	</div><hr>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>				
				<button type="button" id="GoTo" class="btn btn-success btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button>												
					<button type="button" id="GoToHome" class="btn btn-info btn-lg">หน้าสู่เมนูหลัก</button>
			</center>						
		</div>
	</div>	
<!--*******************************************************************************************-->		
<?php	}elseif(($data_stu->IDLevel>=21 and $data_stu->IDLevel<=42)){ ?>
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->		
<!--*******************************************************************************************-->	
<?php
	//time run------------------------------------------------------------------------------------  
		/*$datetime="2022-05-21 00:00:00";//สิ้นสุดการลงทะเบียน
		$datetime_cr=date("Y-m-d H:i:s");
		$datetime_cr=date("Y-m-d H:i:s");
		$datatime_notrun=strtotime($datetime);
		$datatime_run=strtotime($datetime_cr);
			if($datatime_run>=$datatime_notrun){
				$print_runtime="OFF";
			}else{
				$print_runtime="ON";
			}*/	
	//time run End--------------------------------------------------------------------------------
		$print_runtime="ON";
		$data_stu=new stu_levelpdo($SudRc,$data_yaer,$data_term);
?>
<!--*******************************************************************************************-->	
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">กิจกรรมชุมนุม&nbsp;>&nbsp;</span>ลงทะเบียนกิจกรรมชุมนุม&nbsp;ภาคเรียน&nbsp;<?php echo $data_term."&nbsp;/&nbsp;".$data_yaer;?>&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=#" class="btn btn-link  text-size-small"><span>ลงทะเบียนกิจกรรมชุมนุม&nbsp;ภาคเรียน&nbsp;<?php echo $data_term."&nbsp;/&nbsp;".$data_yaer;?></span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>	
<!--*******************************************************************************************-->		
<?php
	switch($print_runtime){
		case "ON": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
					<?php
						/*$datetimeON="2022-05-19 18:00:00";	
						$datetime_crON=date("Y-m-d H:i:s");
						//$datetime_crON=$datetimeON;
						
						
						$datatime_notrunON=strtotime($datetimeON);
						$datatime_runON=strtotime($datetime_crON);	
						
							if($datatime_runON>=$datatime_notrunON){
								//$print_runtime="ON";
								$print_runtimeON="ON";
							}else{
								//$print_runtime="OFF";
								$print_runtimeON="OFF";
							}
						*/
						$print_runtimeON="ON";
					?>
<!--/////////////////////////////////////////////////////////////////////-->	
				<?php
						if(($print_runtimeON=="OFF")){ ?>
<!--/////////////////////////////////////////////////////////////////////-->	
	<!--<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>&nbsp;เริ่มลงทะเบียนวันที่&nbsp;19&nbsp;พฤษภาคม&nbsp;2565&nbsp;เวลา&nbsp;18.00 น.&nbsp;ถึงวันที่&nbsp;20&nbsp;พฤษภาคม&nbsp;2565&nbsp;เวลา&nbsp;23.59 น.
				<!--<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>-->
			</div>			
		</div>
	</div><br>-->							
<!--/////////////////////////////////////////////////////////////////////-->							
				<?php	}else{ ?>
<!--/////////////////////////////////////////////////////////////////////-->	
<!--*******************************************************************************************-->
					<!--<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-success">
								<div class="panel-heading"><center><h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมชุมนุม<div id="demoA"></div></h5></center></div>
							</div>
						</div>
					</div><hr>-->			
<!--*******************************************************************************************-->		
																						<?php 
																							$count_SturcActivity=new sturc_activity($SudRc,$data_term,$data_yaer);
																							$count_SA=0;
																							foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
																								$count_SA=$count_SA+1;
																							}
																								if(($count_SA>=1)){ ?>
<!--*************************************************************************************************************************************************************************************-->
																					
																							        <div class="row">
																										<div class="col-<?php echo $grid;?>-12">
																											<div class="panel panel-default">
																												<div class="panel-heading" style="color: #0642FA"><h4><center>กิจกรรมชุมนุมลงทะเบียนสำเร็จแล้ว</center></h4> </div>
																												<div class="panel-body">
																												
																													<div class="row">
																														<div class="col-<?php echo $grid;?>-12">
																															<div class="table-responsive">
																																<table class="table table-hover">
																																	<thead>
																																		<tr>
																																			<th>ลำดับ</th>
																																			<th>ชื่อกิจกรรมส่งเสริม</th>
																																		</tr>
																																	</thead>
																																	<tbody>
																																	
																																		<?php 
																																			$call_print_activity=new sturc_activity($SudRc,$data_term,$data_yaer);
																																			$cpa=0;
																																			foreach($call_print_activity->print_sturcto() as $rc_key=>$call_print_activityRow){ 
																																				$cpa++;
																																			?>
																																			
																																				<tr>
																																					<td><?php echo $cpa;?></td>
																																					<td><?php echo $call_print_activityRow["activity_txt"];?></td>
																																				</tr>																																				
																																				
																																		<?php	} ?>

																			
																																	</tbody>
																																</table>
																															</div>																														
																														</div>
																													</div><hr>
																									<?php
																										    if(($call_print_activityRow["activity_showstudent"]=="ON")){ ?>
																													<div class="row">
																														<div class="col-<?php echo $grid;?>-12">
																															<form name="delete_activity" method="post"  accept-charset="UTF-8" >
																																<center>
																																	<input type="hidden" name="activity_key" value="<?php echo $call_print_activityRow['activity_key'];?>" id="activity_key">
																																	<button type="button" class="btn btn-success btn-lg" name="code_key" id="code_key"  value="notkey_system">ยกเลิกลงทะเบียน</button>
																																	
																																</center>
																															</form>
																														</div>
																													</div><hr>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<script>
		$(document).ready(function(){
			$('#code_key').on('click', function() {
				var ra_year="<?php echo $data_yaer;?>";
				var ra_term="<?php echo $data_term;?>";
				var ra_sudkey="<?php echo $SudRc;?>";
				swal({
					title: "ต้องการยกเลิกกิจกรรมชุมนุมใช้หรือไม่",
					text: "ยืนยันการยกเลิกกิจกรรมชุมนุม ถ้าแน่ใจว่าจะยกเลิกให้กด OK ถ้าไม่แน่ใจให้กด Cancel",
					type: "info",
					showCancelButton: true,
					closeOnConfirm: false,
					confirmButtonColor: "#2196F3",
					showLoaderOnConfirm: true
				},
				function() {
					setTimeout(function() {
						swal({
							title: "ยกเลิกกิจกรรมชุมนุมสำเร็จ",
							confirmButtonColor: "#2196F3"
						},function(){
							var ActivityKey=$("#activity_key").val();
							var CodeKey=$("#code_key").val();
								if(ActivityKey!="" && CodeKey!=""){
									$.post("./?evaluation_mod=activity_show_admin",{
										activity_key:ActivityKey,
										code_key:CodeKey,
										ra_year:ra_year,
										ra_term:ra_term,
										ra_sudkey:ra_sudkey
									},function(rc){
										if(rc!=""){
											document.location="./?evaluation_mod=register_activity";
										}else{}
									})
								}else{}
						});
					}, 2000);
				});
			});			
		})
	</script>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
																									<?php	}elseif($call_print_activityRow["activity_showstudent"]=="OFF"){ ?>
																													<div class="row">
																														<div class="col-<?php echo $grid;?>-12">
																															<div class="alert alert-danger">
																																<strong>ไม่มีสิทธิ์ ! ยกเลิกลงทะเบียนกิจกรรมชุมนุม</strong> 
																															</div>			
																														</div>
																													</div><br>																										
																									<?php	}else{ ?>
																											
																									<?php	}      ?>	
																												</div>
																											</div>
																										</div>
																									</div>
																									
																							
																							
<!--*************************************************************************************************************************************************************************************-->																							
																						<?php	}else{ ?>
<!--*************************************************************************************************************************************************************************************-->		
																									<div class="row">
																										<div class="col-<?php echo $grid;?>-12">	
																											<div class="panel panel-default">
																												<div class="panel-heading" style="color: #0642FA"><h4><center>รายชื่อกิจกรรมชุมนุม</center></h4></div>
																												<div class="panel-body">
																													
																																												<div class="row">
																										<?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
																																									<?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>
																																									
																																									<?php
																																										$show_count_all=new activity_count_all($call_activityRow["activity_key"],$data_term,$data_yaer,"Count_Activity_join");
																																										$activity_quota=$show_count_all->print_activity_ae_quota();
																																										$activity_ae_id=$show_count_all->print_activity_ae_id();

																																										//echo $activity_quota."***".$activity_ae_id."<br>";

																																										$test_count_all=new check_activity_all($activity_ae_id,$data_term,$data_yaer,$activity_quota);
																																									?>						
						
									
																													                                                 <?php
																																											if(($hr_arc%4==0)){ ?>
																																												</div><br>
																																												<div class="row">
																																													<div class="col-<?php echo $grid;?>-3">
																																														<a id="Btn_activity<?php echo $hr_arc;?>" data-toggle="tooltip" title="<?php echo $call_activityRow["activity_txt"];?>"><div class="panel panel-body" style="background-color: #02FAF0">
																																															<div class="media">
																																																<div class="media-left">
																																																	<i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
																																																</div>

																																															<div class="media-body">
																																																<font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
																																																	<div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
																																																	<div><?php //echo $show_num_activity->ak_count;?><?php // echo $show_num_activity->ak_keep;?><?php echo $test_count_all->test_sum_activity_print();?>/<?php echo $activity_quota;?></div>
																																																</font>
																																															</div>
																																															</div>
																																														</div></a>	
																																													</div>
		
																																									 <?php	}else{ ?>
																																												
																																													<div class="col-<?php echo $grid;?>-3">
																																														<a id="Btn_activity<?php echo $hr_arc;?>" data-toggle="tooltip" title="<?php echo $call_activityRow["activity_txt"];?>"><div class="panel panel-body" style="background-color: #02FAF0">
																																															<div class="media">
																																																<div class="media-left">
																																																	<i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
																																																</div>

																																															<div class="media-body">
																																																<font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
																																																	<div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
																																																	<div><?php //echo $show_num_activity->ak_count;?><?php //echo $show_num_activity->ak_keep;?><?php echo $test_count_all->test_sum_activity_print();?>/<?php echo $activity_quota;?></div>
																																																</font>
																																															</div>
																																															</div>
																																														</div></a>	
																																													</div>
																																												
																																									 <?php	}?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																																										 
	<!-- Modal -->
		<div class="modal fade" id="Modal_activity<?php echo $hr_arc;?>" role="dialog">
			<div class="modal-dialog">
		
<!--activity_taacher ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php 
			if(($data_stu->IDLevel>=11 and $data_stu->IDLevel<=23)){
				$teacher_activity=new activity_taacher($call_activityRow["activity_key"],$data_term,$data_yaer);
				$activity_adviser=new print_teacher_rc($teacher_activity->taacher_keyrc());
					$img_t=$activity_adviser->teacherRC_key().".jpg";
						if((isset($img_t))){
							if(file_exists("view/t/$img_t")){
								$adviser_img="view/t/$img_t";
							}else{
								$adviser_img="view/t/uesr.jpg";
							}								
						}else{
							//--------------------------------------
						}
			}elseif(($data_stu->IDLevel>=31 and $data_stu->IDLevel<=43)){
				$teacher_activity=new activity_taacher($call_activityRow["activity_key"],$data_term,$data_yaer);
				$activity_adviser=new regina_stu_data($teacher_activity->taacher_keyrc());
					if((file_exists("view/all/$activity_adviser->rsd_studentid.jpg"))){
						$adviser_img="view/all/$activity_adviser->rsd_studentid.jpg";
					}else{
						$adviser_img="view/all/newimg_rc.jpg";
					}				
			}else{
				
			}
		?>		
<!--activity_taacher End ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">กิจกรรมชุมนุม : <?php echo $call_activityRow["activity_txt"];?></h4>
				
	<?php
			if(($data_stu->IDLevel>=11 and $data_stu->IDLevel<=23)){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<h4 class="modal-title">ครูชุมนุม : <?php echo $activity_adviser->teacherRC_nameTh();?></h4>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
		<?php
				if(isset($img_t)){ ?> 
							<center><img src="<?php echo $adviser_img;?>" align="center" width="40%" class="img-thumbnail" alt=""></center>
		<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}      ?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}elseif(($data_stu->IDLevel>=31 and $data_stu->IDLevel<=43)){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
						<h4 class="modal-title">ประธานชุมนุม : <?php echo "นางสาว ".$activity_adviser->rsd_name." ".$activity_adviser->rsd_surname;?></h4>
						<center><img src="<?php echo $adviser_img;?>" align="center" width="40%" class="img-thumbnail" alt=""></center>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}	   ?>				
						
				
						
					</div>
					<div class="modal-body">


					</div>
					<div class="modal-footer">
						<form name="activityA" action="./?evaluation_mod=activity_show_admin" method="post" accept-charset="UTF-8">
							<input type="hidden" name="activity_key" value="<?php echo $call_activityRow["activity_key"];?>">
							<button type="submit" class="btn btn-success" name="code_key" value="key_system">ลงทะเบียน</button>
							<button type="button" class="btn btn-warning" data-dismiss="modal">ปิด</button>	
								
								<input type="hidden" name="ra_year" value="<?php echo $data_yaer;?>">
								<input type="hidden" name="ra_term" value="<?php echo $data_term;?>">
								<input type="hidden" name="ra_sudkey" value="<?php echo $SudRc;?>">
								
						</form>
					</div>
				</div>
		  
			</div>
		</div>																																									 
	<!-- Modal -->	
	<script>
		$(document).ready(function(){
			$("#Btn_activity<?php echo $hr_arc;?>").click(function(){
				$("#Modal_activity<?php echo $hr_arc;?>").modal({backdrop: false});
			});
		})
	</script>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																														
																										<?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>
																															
																												</div>
																											</div>
																										</div>
																									</div>	
																								</div>	
<!--*************************************************************************************************************************************************************************************-->		
<!--*************************************************************************************************************************************************************************************-->	
							<?php
									if($hr_arc>=1){
//------------------------------------------------------------------------------------------------
									}else{ ?>
<!--*******************************************************************************************-->	
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-danger">
													<strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ ! </strong> 
												</div>			
											</div>
										</div><br>								
<!--*******************************************************************************************-->									
							<?php	}  ?>																																														
<!--*************************************************************************************************************************************************************************************-->																																													
<!--*************************************************************************************************************************************************************************************-->																																															
																						<?php	}      ?>
<!--*******************************************************************************************-->																						
																				
<!--*******************************************************************************************-->							
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->		
				<?php }       ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->				
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->				
	<?php break;
		  case "OFF": ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
	<!--<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>หมดเวลา ลงทะเบียนกิจกรรมชุมนุม พบข้อสงสัยกรุณาติดต่อ ห้องกิจการนักเรียน...</strong> 
			</div>			
		</div>
	</div><br>-->		 
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->		 
	<?php break;
		  default: ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->		 
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->		  
<?php	}   ?>					
<!--*******************************************************************************************-->	
<!--*******************************************************************************************-->		
<!--*******************************************************************************************-->	
<?php   }elseif(($data_stu->IDLevel==43)){ ?>
<!--*******************************************************************************************-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong> ระดับชั้น มัธยมศึกษาปีที่ 6 การใช้งานในส่วนนี้ยังไม่เปิดใช้บริการ 
			</div>			
		</div>
	</div><hr>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>				
				<button type="button" id="GoTo" class="btn btn-success btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button>												
					<button type="button" id="GoToHome" class="btn btn-info btn-lg">หน้าสู่เมนูหลัก</button>
			</center>						
		</div>
	</div>	
<!--*******************************************************************************************-->	
<?php   }else{ ?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>พบข้อผิดพลาด </strong> ไม่สามารถใช้งานได้ มีข้อสังสัยกรุณาติดต่อสอบถามได้ที่ งาน ฝ่าย ICT 053-282395 ต่อ 123 
			</div>			
		</div>
	</div><hr>		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>				
				<button type="button" id="GoTo" class="btn btn-success btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button>												
					<button type="button" id="GoToHome" class="btn btn-info btn-lg">หน้าสู่เมนูหลัก</button>
			</center>						
		</div>
	</div>	
<?php	}

























