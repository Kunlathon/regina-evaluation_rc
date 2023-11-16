<!--*******************************************************************************************-->	
<?php
	//time run------------------------------------------------------------------------------------  
		$datetime="2021-06-30 12:00:00";
		$datetime_cr=date("Y-m-d H:i:s");
		$datatime_notrun=strtotime($datetime);
		$datatime_run=strtotime($datetime_cr);
			if($datatime_run>=$datatime_notrun){
				$print_runtime="OFF";
			}else{
				$print_runtime="ON";
			}	
	//time run End--------------------------------------------------------------------------------
		$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
?>
<!--*******************************************************************************************-->	
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4><span class="text-semibold">ลงทะเบียนกิจกรรมชุมรม ภาคเรียน <?php echo $data_term." / ".$data_yaer;?></span></h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=#" class="btn btn-link  text-size-small"><span>ลงทะเบียนกิจกรรมชุมรม</span></a>
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
						$datetimeON="2021-06-21 12:00:00";	
						$datetime_crON=date("Y-m-d H:i:s");
						$datatime_notrunON=strtotime($datetimeON);
						$datatime_runON=strtotime($datetime_crON);	
						
							if($datatime_runON>=$datatime_notrunON){
								//$print_runtime="ON";
								$print_runtimeON="ON";
							}else{
								//$print_runtime="OFF";
								$print_runtimeON="OFF";
							}
					?>
<!--/////////////////////////////////////////////////////////////////////-->	
				<?php
						if($print_runtimeON=="OFF"){ ?>
<!--/////////////////////////////////////////////////////////////////////-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>ยังไม่เปิดให้ลงทะเบียน ! </strong> เริ่มลงทะเบียนวันที่ 29 พฤศจิกายน พ.ศ. 2563 เวลา 12.00 น. เป็นต้นไป 
			</div>			
		</div>
	</div><br>							
<!--/////////////////////////////////////////////////////////////////////-->							
				<?php	}else{ ?>
<!--/////////////////////////////////////////////////////////////////////-->	
<!--*******************************************************************************************-->
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-success">
								<div class="panel-heading"><center><h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมชุมรม<div id="demo"></div></h5></center></div>
							</div>
						</div>
					</div><hr>			
<!--*******************************************************************************************-->		
																						<?php 
																							$count_SturcActivity=new sturc_activity($user_login,$data_term,$data_yaer);
																							$count_SA=0;
																							foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
																								$count_SA=$count_SA+1;
																							}
																								if($count_SA>=1){ ?>
<!--*************************************************************************************************************************************************************************************-->
																					
																							        <div class="row">
																										<div class="col-<?php echo $grid;?>-12">
																											<div class="panel panel-default">
																												<div class="panel-heading" style="color: #0642FA"><h4><center>กิจกรรมชุมรมลงทะเบียนสำเร็จแล้ว</center></h4> </div>
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
																																			$call_print_activity=new sturc_activity($user_login,$data_term,$data_yaer);
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
																										    if($call_print_activityRow["activity_showstudent"]=="ON"){ ?>
																													<div class="row">
																														<div class="col-<?php echo $grid;?>-12">
																															<form name="delete_activity" method="post" action="./?evaluation_mod=activity_show" accept-charset="UTF-8" >
																																<center>
																																	<input type="hidden" name="activity_key" value="<?php echo $call_print_activityRow["activity_key"];?>">
																																	<button type="submit" class="btn btn-success btn-lg" name="code_key" value="notkey_system">ยกเลิกลงทะเบียน</button>
																																</center>
																															</form>
																														</div>
																													</div><hr>												
																									<?php	}elseif($call_print_activityRow["activity_showstudent"]=="OFF"){ ?>
																													<div class="row">
																														<div class="col-<?php echo $grid;?>-12">
																															<div class="alert alert-danger">
																																<strong>ไม่มีสิทธิ์ ! ยกเลิกลงทะเบียนกิจกรรมส่งเสริมศักย</strong> 
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
																												<div class="panel-heading" style="color: #0642FA"><h4><center>รายชื่อกิจกรรมชุมรม</center></h4></div>
																												<div class="panel-body">
																													
																																												<div class="row">
																										<?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
																																									<?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>
																																									
																																															
						
									
																													                                                 <?php
																																											if($hr_arc%4==0){ ?>
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
																																																	<div><?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?></div>
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
																																																	<div><?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?></div>
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
		
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">×</button>
						<h4 class="modal-title">กิจกรรมชุมรม : <?php echo $call_activityRow["activity_txt"];?></h4>
					</div>
					<div class="modal-body">


					</div>
					<div class="modal-footer">
						<form name="activityA" action="./?evaluation_mod=activity_show" method="post" accept-charset="UTF-8">
							<input type="hidden" name="activity_key" value="<?php echo $call_activityRow["activity_key"];?>">
							<button type="submit" class="btn btn-success" name="code_key" value="key_system">ลงทะเบียน</button>
							<button type="button" class="btn btn-warning" data-dismiss="modal">ปิด</button>							
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
	<?php }       ?>
<!--/////////////////////////////////////////////////////////////////////-->					
<!--*******************************************************************************************--> 