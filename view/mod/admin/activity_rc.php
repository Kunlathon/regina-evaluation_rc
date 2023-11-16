<?php
	include("view/database/pdo_data.php");
	include("view/database/class_pdo.php");	
	
	include("view/database/database_paynew.php");
	include("view/database/class_pay.php");
	
	include("view/database/pdo_activity.php");
	include("view/database/class_activity.php");
	
	@$data_yaer=2566;
	@$data_term=1;

	@$user_login;
	$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);		
			 if(($data_stu->IDLevel>=3 and $data_stu->IDLevel<=3)){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success">
				<strong>ข้อผิดพลาด ! </strong> ระดับชั้น อนุบาล การใช้งานในส่วนนี้ยังไม่เปิดใช้บริการ 
			</div>			
		</div>
	</div><br>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	  <?php }elseif(($data_stu->IDLevel>=11 and $data_stu->IDLevel<=13)){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success">
				<strong>ข้อผิดพลาด ! </strong> ระดับชั้น อนุบาล การใช้งานในส่วนนี้ยังไม่เปิดใช้บริการ 
			</div>			
		</div>
	</div><br>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	  <?php }elseif(($data_stu->IDLevel>=31 and $data_stu->IDLevel<=33)){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--********************************************************************************************-->	
                    <?php
						//time run------------------------------------------------------------------------------------  
							$datetime="2023-05-21 00:00:00";
							$datetime_cr=date("Y-m-d H:i:s");
							$datatime_notrun=strtotime($datetime);
							$datatime_run=strtotime($datetime_cr);
								if($datatime_run>=$datatime_notrun){
									$print_runtime="OFF";
								}else{
									$print_runtime="ON";
								}	
						//time run End--------------------------------------------------------------------------------
					?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--********************************************************************************************-->  
	  <?php
			switch($print_runtime){
				case "ON": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
<!--********************************************************************************************-->
					<?php
						$datetimeON="2023-05-19 08:00:00";	
						$datetime_crON=date("Y-m-d H:i:s");
						//$datetime_crON=$datetimeON;
						$datatime_notrunON=strtotime($datetimeON);
						$datatime_runON=strtotime($datetime_crON);	
						
							if($datatime_runON>=$datatime_notrunON){
								
								$print_runtimeON="ON";
							}else{
								
								$print_runtimeON="OFF";
							}
					?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
<!--********************************************************************************************-->	
				<?php
						if($print_runtimeON=="OFF"){ ?>
<!--/////////////////////////////////////////////////////////////////////-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>&nbsp;เริ่มลงทะเบียนวันที่&nbsp;19&nbsp;พฤษภาคม&nbsp;2566&nbsp;เวลา&nbsp;08.00 น.&nbsp;ถึงวันที่&nbsp;20&nbsp;พฤษภาคม&nbsp;2566&nbsp;เวลา&nbsp;23.59 น.
				<!--<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>-->
			</div>			
		</div>
	</div><br>							
<!--/////////////////////////////////////////////////////////////////////-->							
				<?php	}else{ ?>
<!--/////////////////////////////////////////////////////////////////////-->	
<!--/////////////////////////////////////////////////////////////////////-->	
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-success">
								<div class="panel-heading"><center><h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมกิจกรรมชุมนุม<div id="demoB"></div></h5></center></div>
							</div>
						</div>
					</div><hr>
<!--*******************************************************************************************-->	

							<?php
									$activity_key=filter_input(INPUT_POST,'activity_key');
									if(($activity_key=="")){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-warning">
													<strong>พบข้อผิดพลาด</strong> ไม่สามารถลงทะเบียนกิจกรรมชุมนุมได้ 
												</div>
											</div>
										</div>							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
							<?php	}else{
										$count_SturcActivity=new sturc_activity($user_login,$data_term,$data_yaer);
										$count_SA=0;
										foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
											$count_SA=$count_SA+1;
										}
											if($count_SA>=1){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-warning">
													<strong>พบข้อผิดพลาด</strong> ไม่สามารถลงทะเบียนซ้ำได้
												</div>
											</div>
										</div>							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
							<?php			}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										
												   <?php
														$count_activity=new check_activity($activity_key,$data_term,$data_yaer);
														if($count_activity->ak_txt=="yes"){
															$call_into_activity=new insert_activity_student($user_login,$data_term,$data_yaer,$activity_key);
															if($call_into_activity->insert_activity_rc()=="yes"){
																$call_updata_keep=new updata_activity_keep($activity_key,$data_term,$data_yaer,$count_activity->count_ac);
																if($call_updata_keep->updatato_activiry_keep()=="yes"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			<div class="alert alert-info">
																				<strong>สำเร็จ </strong> ลงทะเบียนกิจกรรมกิจกรรมชุมนุมเรียบร้อยแล้ว
																			</div>
																		</div>
																	</div>	
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			
																			<center>
																				<a href="./?evaluation_mod=activity"><button type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button></a>																		
																				<a href="./?evaluation_mod=home"><button type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button></a>
																			</center>
																			
																		</div>
																	</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ลงทะเบียนกิจกรรมชุมนุมเรียบร้อยแล้ว รหัสกิจกรรม ".$activity_key." ".$data_term." / ".$data_yaer." IP:".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
	}
?>		
<!--**************************************************************-->																	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																		
													<?php		}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			<div class="alert alert-info">
																				<strong>ไม่สำเร็จ </strong> เกิดข้อผิดพลาดการลงทะเบียนกิจกรรมชุมนุม
																			</div>
																		</div>
																	</div>	
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			
																			<center>
																				<a href="./?evaluation_mod=activity"><button type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button></a>																		
																				<a href="./?evaluation_mod=home"><button type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button></a>
																			</center>
																			
																		</div>
																	</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																	
													<?php		}
															}else{
																//************************************************************
															}
														}else{ ?>
															<div class="row">
																<div class="col-<?php echo $grid;?>-12">																																			
																	<div class="alert alert-warning">
																		<strong>กิจกรรมนี้มีนักเรียนลงทะเบียนครบตามจำนวนแล้ว </strong>  ไม่สามารถลงทะเบียนเพิ่มได้
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-<?php echo $grid;?>-12">	
																	<center>
																		<a href="./?evaluation_mod=activity"><button type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button></a>																		
																		<a href="./?evaluation_mod=home"><button type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button></a>
																	</center>
																</div>
															</div>
												<?php	}      ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
							<?php			}
									}   ?>						
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->		
				<?php }       ?>
<!--/////////////////////////////////////////////////////////////////////-->					
<!--*******************************************************************************************-->	

<!--*******************************************************************************************-->
<!--*******************************************************************************************-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		break;
				case "OFF": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--/////////////////////////////////////////////////////////////////////-->	
<!--/////////////////////////////////////////////////////////////////////-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>หมดเวลาลงทะเบียน </strong> ลงทะเบียนกิจกรรมชุมนุม ตั้งแต่วันนี้เป็นต้นไป  
			</div>			
		</div>
	</div><br>							
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		break;   
				default: ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		}        ?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->  
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		  
	  <?php }elseif(($data_stu->IDLevel==41)){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--********************************************************************************************-->	
                    <?php
						//time run------------------------------------------------------------------------------------  
							$datetime="2023-05-23 00:00:00"; 
							$datetime_cr=date("Y-m-d H:i:s");
							$datatime_notrun=strtotime($datetime);
							$datatime_run=strtotime($datetime_cr);
								if($datatime_run>=$datatime_notrun){
									$print_runtime="OFF";
								}else{
									$print_runtime="ON";
								}	
						//time run End--------------------------------------------------------------------------------
					?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--********************************************************************************************-->  
	  <?php
			switch($print_runtime){
				case "ON": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
<!--********************************************************************************************-->
					<?php
						$datetimeON="2023-05-21 08:00:00";	
						$datetime_crON=date("Y-m-d H:i:s");
						//$datetime_crON=$datetimeON;
						$datatime_notrunON=strtotime($datetimeON);
						$datatime_runON=strtotime($datetime_crON);	
						
							if($datatime_runON>=$datatime_notrunON){
								
								$print_runtimeON="ON";
							}else{
								
								$print_runtimeON="OFF";
							}
					?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
<!--********************************************************************************************-->	
				<?php
						if(($print_runtimeON=="OFF")){ ?>
<!--/////////////////////////////////////////////////////////////////////-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>&nbsp;เริ่มลงทะเบียนวันที่&nbsp;21&nbsp;พฤษภาคม&nbsp;2566&nbsp;เวลา&nbsp;08.00 น.&nbsp;ถึงวันที่&nbsp;22&nbsp;พฤษภาคม&nbsp;2566&nbsp;เวลา&nbsp;23.59 น.
				<!--<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>-->
			</div>			
		</div>
	</div><br>							
<!--/////////////////////////////////////////////////////////////////////-->							
				<?php	}else{ ?>
<!--/////////////////////////////////////////////////////////////////////-->	
<!--/////////////////////////////////////////////////////////////////////-->	
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-success">
								<div class="panel-heading"><center><h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมกิจกรรมชุมนุม<div id="time_m5"></div></h5></center></div>
							</div>
						</div>
					</div><hr>
<!--*******************************************************************************************-->	

							<?php
									$activity_key=filter_input(INPUT_POST,'activity_key');
									if(($activity_key==null)){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-warning">
													<strong>พบข้อผิดพลาด</strong> ไม่สามารถลงทะเบียนกิจกรรมชุมนุมได้ 
												</div>
											</div>
										</div>							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
							<?php	}else{
										$count_SturcActivity=new sturc_activity($user_login,$data_term,$data_yaer);
										$count_SA=0;
										foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
											$count_SA=$count_SA+1;
										}
											if($count_SA>=1){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-warning">
													<strong>พบข้อผิดพลาด</strong> ไม่สามารถลงทะเบียนซ้ำได้
												</div>
											</div>
										</div>							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
							<?php			}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										
												   <?php
														$count_activity=new check_activity($activity_key,$data_term,$data_yaer);
														if($count_activity->ak_txt=="yes"){
															$call_into_activity=new insert_activity_student($user_login,$data_term,$data_yaer,$activity_key);
															if($call_into_activity->insert_activity_rc()=="yes"){
																$call_updata_keep=new updata_activity_keep($activity_key,$data_term,$data_yaer,$count_activity->count_ac);
																if($call_updata_keep->updatato_activiry_keep()=="yes"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			<div class="alert alert-info">
																				<strong>สำเร็จ </strong> ลงทะเบียนกิจกรรมกิจกรรมชุมนุมเรียบร้อยแล้ว
																			</div>
																		</div>
																	</div>	
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			
																			<center>
																				<a href="./?evaluation_mod=activity"><button type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button></a>																		
																				<a href="./?evaluation_mod=home"><button type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button></a>
																			</center>
																			
																		</div>
																	</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ลงทะเบียนกิจกรรมชุมนุมเรียบร้อยแล้ว รหัสกิจกรรม ".$activity_key." ".$data_term." / ".$data_yaer." IP:".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
	}
?>		
<!--**************************************************************-->																	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																		
													<?php		}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			<div class="alert alert-info">
																				<strong>ไม่สำเร็จ </strong> เกิดข้อผิดพลาดการลงทะเบียนกิจกรรมชุมนุม
																			</div>
																		</div>
																	</div>	
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			
																			<center>
																				<a href="./?evaluation_mod=activity"><button type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button></a>																		
																				<a href="./?evaluation_mod=home"><button type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button></a>
																			</center>
																			
																		</div>
																	</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																	
													<?php		}
															}else{
																//************************************************************
															}
														}else{ ?>
															<div class="row">
																<div class="col-<?php echo $grid;?>-12">																																			
																	<div class="alert alert-warning">
																		<strong>กิจกรรมนี้มีนักเรียนลงทะเบียนครบตามจำนวนแล้ว </strong>  ไม่สามารถลงทะเบียนเพิ่มได้
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-<?php echo $grid;?>-12">	
																	<center>
																		<a href="./?evaluation_mod=activity"><button type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button></a>																		
																		<a href="./?evaluation_mod=home"><button type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button></a>
																	</center>
																</div>
															</div>
												<?php	}      ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
							<?php			}
									}   ?>						
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->		
				<?php }       ?>
<!--/////////////////////////////////////////////////////////////////////-->					
<!--*******************************************************************************************-->	

<!--*******************************************************************************************-->
<!--*******************************************************************************************-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		break;
				case "OFF": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--/////////////////////////////////////////////////////////////////////-->	
<!--/////////////////////////////////////////////////////////////////////-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>หมดเวลาลงทะเบียน </strong> ลงทะเบียนกิจกรรมชุมนุม ตั้งแต่วันนี้เป็นต้นไป  
			</div>			
		</div>
	</div><br>							
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		break;   
				default: ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		}        ?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	  
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				  
	  <?php }elseif((($data_stu->IDLevel==42))){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--********************************************************************************************-->	
                    <?php
						//time run------------------------------------------------------------------------------------  
							$datetime="2023-05-23 00:00:00"; //สิ้นสุดการลงทะเบียน
							$datetime_cr=date("Y-m-d H:i:s");
							$datatime_notrun=strtotime($datetime);
							$datatime_run=strtotime($datetime_cr);
								if($datatime_run>=$datatime_notrun){
									$print_runtime="OFF";
								}else{
									$print_runtime="ON";
								}	
						//time run End--------------------------------------------------------------------------------
					?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--********************************************************************************************-->  
	  <?php
			switch($print_runtime){
				case "ON": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
<!--********************************************************************************************-->
					<?php
						$datetimeON="2023-05-21 08:00:00";	//เริ่มลงทะเบียน
						$datetime_crON=date("Y-m-d H:i:s");
						//$datetime_crON=$datetimeON;
						$datatime_notrunON=strtotime($datetimeON);
						$datatime_runON=strtotime($datetime_crON);	
						
							if($datatime_runON>=$datatime_notrunON){
								
								$print_runtimeON="ON";
							}else{
								
								$print_runtimeON="OFF";
							}
					?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
<!--********************************************************************************************-->	
				<?php
						if($print_runtimeON=="OFF"){ ?>
<!--/////////////////////////////////////////////////////////////////////-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>&nbsp;เริ่มลงทะเบียนวันที่&nbsp;21&nbsp;พฤษภาคม&nbsp;2566&nbsp;เวลา&nbsp;08.00 น.&nbsp;ถึงวันที่&nbsp;22&nbsp;พฤษภาคม&nbsp;2566&nbsp;เวลา&nbsp;23.59 น.
				<!--<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>-->
			</div>			
		</div>
	</div><br>							
<!--/////////////////////////////////////////////////////////////////////-->							
				<?php	}else{ ?>
<!--/////////////////////////////////////////////////////////////////////-->	
<!--/////////////////////////////////////////////////////////////////////-->	
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-success">
								<div class="panel-heading"><center><h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมกิจกรรมชุมนุม<div id="time_m5"></div></h5></center></div>
							</div>
						</div>
					</div><hr>
<!--*******************************************************************************************-->	

							<?php
									$activity_key=filter_input(INPUT_POST,'activity_key');
									if($activity_key==""){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-warning">
													<strong>พบข้อผิดพลาด</strong> ไม่สามารถลงทะเบียนกิจกรรมชุมนุมได้ 
												</div>
											</div>
										</div>							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
							<?php	}else{
										$count_SturcActivity=new sturc_activity($user_login,$data_term,$data_yaer);
										$count_SA=0;
										foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
											$count_SA=$count_SA+1;
										}
											if($count_SA>=1){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-warning">
													<strong>พบข้อผิดพลาด</strong> ไม่สามารถลงทะเบียนซ้ำได้
												</div>
											</div>
										</div>							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
							<?php			}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										
												   <?php
														$count_activity=new check_activity($activity_key,$data_term,$data_yaer);
														if($count_activity->ak_txt=="yes"){
															$call_into_activity=new insert_activity_student($user_login,$data_term,$data_yaer,$activity_key);
															if($call_into_activity->insert_activity_rc()=="yes"){
																$call_updata_keep=new updata_activity_keep($activity_key,$data_term,$data_yaer,$count_activity->count_ac);
																if($call_updata_keep->updatato_activiry_keep()=="yes"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			<div class="alert alert-info">
																				<strong>สำเร็จ </strong> ลงทะเบียนกิจกรรมกิจกรรมชุมนุมเรียบร้อยแล้ว
																			</div>
																		</div>
																	</div>	
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			
																			<center>
																				<a href="./?evaluation_mod=activity"><button type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button></a>																		
																				<a href="./?evaluation_mod=home"><button type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button></a>
																			</center>
																			
																		</div>
																	</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ลงทะเบียนกิจกรรมชุมนุมเรียบร้อยแล้ว รหัสกิจกรรม ".$activity_key." ".$data_term." / ".$data_yaer." IP:".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
	}
?>		
<!--**************************************************************-->																	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																		
													<?php		}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			<div class="alert alert-info">
																				<strong>ไม่สำเร็จ </strong> เกิดข้อผิดพลาดการลงทะเบียนกิจกรรมชุมนุม
																			</div>
																		</div>
																	</div>	
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			
																			<center>
																				<a href="./?evaluation_mod=activity"><button type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button></a>																		
																				<a href="./?evaluation_mod=home"><button type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button></a>
																			</center>
																			
																		</div>
																	</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																	
													<?php		}
															}else{
																//************************************************************
															}
														}else{ ?>
															<div class="row">
																<div class="col-<?php echo $grid;?>-12">																																			
																	<div class="alert alert-warning">
																		<strong>กิจกรรมนี้มีนักเรียนลงทะเบียนครบตามจำนวนแล้ว </strong>  ไม่สามารถลงทะเบียนเพิ่มได้
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-<?php echo $grid;?>-12">	
																	<center>
																		<a href="./?evaluation_mod=activity"><button type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button></a>																		
																		<a href="./?evaluation_mod=home"><button type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button></a>
																	</center>
																</div>
															</div>
												<?php	}      ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
							<?php			}
									}   ?>						
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->		
				<?php }       ?>
<!--/////////////////////////////////////////////////////////////////////-->					
<!--*******************************************************************************************-->	

<!--*******************************************************************************************-->
<!--*******************************************************************************************-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		break;
				case "OFF": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--/////////////////////////////////////////////////////////////////////-->	
<!--/////////////////////////////////////////////////////////////////////-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>หมดเวลาลงทะเบียน </strong> ลงทะเบียนกิจกรรมชุมนุม ตั้งแต่วันนี้เป็นต้นไป  
			</div>			
		</div>
	</div><br>							
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		break;   
				default: ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		}        ?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	  
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		  
	  <?php }elseif(($data_stu->IDLevel==21)){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--********************************************************************************************-->	
                    <?php
						//time run------------------------------------------------------------------------------------  
							$datetime="2023-05-22 00:00:00"; //สิ้นสุด
							$datetime_cr=date("Y-m-d H:i:s");
							$datatime_notrun=strtotime($datetime);
							$datatime_run=strtotime($datetime_cr);
								if($datatime_run>=$datatime_notrun){
									$print_runtime="OFF";
								}else{
									$print_runtime="ON";
								}	
						//time run End--------------------------------------------------------------------------------
					?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--********************************************************************************************-->  
	  <?php
			switch($print_runtime){
				case "ON": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
<!--********************************************************************************************-->
					<?php
						$datetimeON="2023-05-20 08:00:00";	//เริ่ม
						$datetime_crON=date("Y-m-d H:i:s");
						//$datetime_crON=$datetimeON;
						$datatime_notrunON=strtotime($datetimeON);
						$datatime_runON=strtotime($datetime_crON);	
						
							if($datatime_runON>=$datatime_notrunON){
								
								$print_runtimeON="ON";
							}else{
								
								$print_runtimeON="OFF";
							}
					?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
<!--********************************************************************************************-->	
				<?php
						if(($print_runtimeON=="OFF")){ ?>
<!--/////////////////////////////////////////////////////////////////////-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>&nbsp;เริ่มลงทะเบียนวันที่&nbsp;20&nbsp;พฤษภาคม&nbsp;2566&nbsp;เวลา&nbsp;08.00 น.&nbsp;ถึงวันที่&nbsp;22&nbsp;พฤษภาคม&nbsp;2566&nbsp;เวลา&nbsp;23.59 น.
				<!--<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>-->
			</div>			
		</div>
	</div><br>							
<!--/////////////////////////////////////////////////////////////////////-->							
				<?php	}else{ ?>
<!--/////////////////////////////////////////////////////////////////////-->	
<!--/////////////////////////////////////////////////////////////////////-->	
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-success">
								<div class="panel-heading"><center><h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมกิจกรรมชุมนุม<div id="demoC"></div></h5></center></div>
							</div>
						</div>
					</div><hr>
<!--*******************************************************************************************-->	

							<?php
									$activity_key=filter_input(INPUT_POST,'activity_key');
									if(($activity_key==null)){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-warning">
													<strong>พบข้อผิดพลาด</strong> ไม่สามารถลงทะเบียนกิจกรรมชุมนุมได้ 
												</div>
											</div>
										</div>							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
							<?php	}else{
										$count_SturcActivity=new sturc_activity($user_login,$data_term,$data_yaer);
										$count_SA=0;
										foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
											$count_SA=$count_SA+1;
										}
											if($count_SA>=1){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-warning">
													<strong>พบข้อผิดพลาด</strong> ไม่สามารถลงทะเบียนซ้ำได้
												</div>
											</div>
										</div>							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
							<?php			}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										
												   <?php
														$count_activity=new check_activity($activity_key,$data_term,$data_yaer);
														if($count_activity->ak_txt=="yes"){
															$call_into_activity=new insert_activity_student($user_login,$data_term,$data_yaer,$activity_key);
															if($call_into_activity->insert_activity_rc()=="yes"){
																$call_updata_keep=new updata_activity_keep($activity_key,$data_term,$data_yaer,$count_activity->count_ac);
																if($call_updata_keep->updatato_activiry_keep()=="yes"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			<div class="alert alert-info">
																				<strong>สำเร็จ </strong> ลงทะเบียนกิจกรรมกิจกรรมชุมนุมเรียบร้อยแล้ว
																			</div>
																		</div>
																	</div>	
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			
																			<center>
																				<a href="./?evaluation_mod=activity"><button type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button></a>																		
																				<a href="./?evaluation_mod=home"><button type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button></a>
																			</center>
																			
																		</div>
																	</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php
	if(($db_evaluationID=="127.0.0.1")){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ลงทะเบียนกิจกรรมชุมนุมเรียบร้อยแล้ว รหัสกิจกรรม ".$activity_key." ".$data_term." / ".$data_yaer." IP:".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
	}
?>		
<!--**************************************************************-->																	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																		
													<?php		}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			<div class="alert alert-info">
																				<strong>ไม่สำเร็จ </strong> เกิดข้อผิดพลาดการลงทะเบียนกิจกรรมชุมนุม
																			</div>
																		</div>
																	</div>	
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			
																			<center>
																				<a href="./?evaluation_mod=activity"><button type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button></a>																		
																				<a href="./?evaluation_mod=home"><button type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button></a>
																			</center>
																			
																		</div>
																	</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																	
													<?php		}
															}else{
																//************************************************************
															}
														}else{ ?>
															<div class="row">
																<div class="col-<?php echo $grid;?>-12">																																			
																	<div class="alert alert-warning">
																		<strong>กิจกรรมนี้มีนักเรียนลงทะเบียนครบตามจำนวนแล้ว </strong>  ไม่สามารถลงทะเบียนเพิ่มได้
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-<?php echo $grid;?>-12">	
																	<center>
																		<a href="./?evaluation_mod=activity"><button type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button></a>																		
																		<a href="./?evaluation_mod=home"><button type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button></a>
																	</center>
																</div>
															</div>
												<?php	}      ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
							<?php			}
									}   ?>						
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->		
				<?php }       ?>
<!--/////////////////////////////////////////////////////////////////////-->					
<!--*******************************************************************************************-->	

<!--*******************************************************************************************-->
<!--*******************************************************************************************-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		break;
				case "OFF": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--/////////////////////////////////////////////////////////////////////-->	
<!--/////////////////////////////////////////////////////////////////////-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>หมดเวลาลงทะเบียน </strong> ลงทะเบียนกิจกรรมชุมนุม ตั้งแต่วันนี้เป็นต้นไป  
			</div>			
		</div>
	</div><br>							
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		break;   
				default: ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		}        ?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	  
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				  
<?php }elseif(($data_stu->IDLevel==22 or $data_stu->IDLevel==23)){ //Open class : M4 and M5 Not M6 ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--********************************************************************************************-->	
                    <?php
						//time run------------------------------------------------------------------------------------  
							$datetime="2023-05-22 00:00:00"; //สิ้นสุด
							$datetime_cr=date("Y-m-d H:i:s");
							$datatime_notrun=strtotime($datetime);
							$datatime_run=strtotime($datetime_cr);
								if(($datatime_run>=$datatime_notrun)){
									$print_runtime="OFF";
								}else{
									$print_runtime="ON";
								}	
						//time run End--------------------------------------------------------------------------------
					?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--********************************************************************************************-->  
	  <?php
			switch($print_runtime){
				case "ON": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->	
                    <?php
						$datetimeON="2023-05-20 08:00:00";	//เริ่ม
						$datetime_crON=date("Y-m-d H:i:s");
						//$datetime_crON=$datetimeON;
						$datatime_notrunON=strtotime($datetimeON);
						$datatime_runON=strtotime($datetime_crON);	
						
							if(($datatime_runON>=$datatime_notrunON)){
								//$print_runtime="ON";
								$print_runtimeON="ON";
							}else{
								//$print_runtime="OFF";
								$print_runtimeON="OFF";
							}
					
					?>
<!--/////////////////////////////////////////////////////////////////////-->	
				<?php
						if(($print_runtimeON=="OFF")){ ?>
<!--/////////////////////////////////////////////////////////////////////-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>&nbsp;เริ่มลงทะเบียนวันที่&nbsp;20&nbsp;พฤษภาคม&nbsp;2566&nbsp;เวลา&nbsp;08.00 น.&nbsp;ถึงวันที่&nbsp;21&nbsp;พฤษภาคม&nbsp;2566&nbsp;เวลา&nbsp;23.59 น.
				<!--<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>-->
			</div>			
		</div>
	</div><br>							
<!--/////////////////////////////////////////////////////////////////////-->							
				<?php	}else{ ?>
<!--/////////////////////////////////////////////////////////////////////-->	
<!--/////////////////////////////////////////////////////////////////////-->	
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-success">
								<div class="panel-heading"><center><h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมกิจกรรมชุมนุม<div id="demoC"></div></h5></center></div>
							</div>
						</div>
					</div><hr>
<!--*******************************************************************************************-->	

							<?php
									$activity_key=filter_input(INPUT_POST,'activity_key');
									if(($activity_key==null)){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-warning">
													<strong>พบข้อผิดพลาด</strong> ไม่สามารถลงทะเบียนกิจกรรมชุมนุมได้ 
												</div>
											</div>
										</div>							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
							<?php	}else{
										$count_SturcActivity=new sturc_activity($user_login,$data_term,$data_yaer);
										$count_SA=0;
										foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
											$count_SA=$count_SA+1;
										}
											if($count_SA>=1){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-warning">
													<strong>พบข้อผิดพลาด</strong> ไม่สามารถลงทะเบียนซ้ำได้
												</div>
											</div>
										</div>							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
							<?php			}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										
												   <?php
														$count_activity=new check_activity($activity_key,$data_term,$data_yaer);
														if(($count_activity->ak_txt=="yes")){
															$call_into_activity=new insert_activity_student($user_login,$data_term,$data_yaer,$activity_key);
															if(($call_into_activity->insert_activity_rc()=="yes")){
																$call_updata_keep=new updata_activity_keep($activity_key,$data_term,$data_yaer,$count_activity->count_ac);
																if(($call_updata_keep->updatato_activiry_keep()=="yes")){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			<div class="alert alert-info">
																				<strong>สำเร็จ </strong> ลงทะเบียนกิจกรรมกิจกรรมชุมนุมเรียบร้อยแล้ว
																			</div>
																		</div>
																	</div>	
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			
																			<center>
																				<a href="./?evaluation_mod=activity"><button type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button></a>																		
																				<a href="./?evaluation_mod=home"><button type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button></a>
																			</center>
																			
																		</div>
																	</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php
	if(($db_evaluationID=="127.0.0.1")){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ลงทะเบียนกิจกรรมชุมนุมเรียบร้อยแล้ว รหัสกิจกรรม ".$activity_key." ".$data_term." / ".$data_yaer." IP:".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
	}
?>		
<!--**************************************************************-->																	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																		
													<?php		}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			<div class="alert alert-info">
																				<strong>ไม่สำเร็จ </strong> เกิดข้อผิดพลาดการลงทะเบียนกิจกรรมชุมนุม
																			</div>
																		</div>
																	</div>	
																	<div class="row">
																		<div class="col-<?php echo $grid;?>-12">
																			
																			<center>
																				<a href="./?evaluation_mod=activity"><button type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button></a>																		
																				<a href="./?evaluation_mod=home"><button type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button></a>
																			</center>
																			
																		</div>
																	</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																	
													<?php		}
															}else{
																//************************************************************
															}
														}else{ ?>
															<div class="row">
																<div class="col-<?php echo $grid;?>-12">																																			
																	<div class="alert alert-warning">
																		<strong>กิจกรรมนี้มีนักเรียนลงทะเบียนครบตามจำนวนแล้ว </strong>  ไม่สามารถลงทะเบียนเพิ่มได้
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-<?php echo $grid;?>-12">	
																	<center>
																		<a href="./?evaluation_mod=activity"><button type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button></a>																		
																		<a href="./?evaluation_mod=home"><button type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button></a>
																	</center>
																</div>
															</div>
												<?php	}      ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
							<?php			}
									}   ?>						
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->		
				<?php }       ?>
<!--/////////////////////////////////////////////////////////////////////-->					
<!--*******************************************************************************************-->	

<!--*******************************************************************************************-->
<!--*******************************************************************************************-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		break;
				case "OFF": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--/////////////////////////////////////////////////////////////////////-->	
<!--/////////////////////////////////////////////////////////////////////-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>หมดเวลาลงทะเบียน </strong> ลงทะเบียนกิจกรรมชุมนุม ตั้งแต่วันนี้เป็นต้นไป  
			</div>			
		</div>
	</div><br>							
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		break;   
				default: ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		}        ?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	  <?php }else{ ?>
<!--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+-+-+->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>พบข้อผิดพลาด </strong> ไม่สามารถใช้งานได้ มีข้อสังสัยกรุณาติดต่อสอบถามได้ที่ งาน ฝ่าย ICT 053-282395 ต่อ 123 
			</div>			
		</div>
	</div><br>	
<!--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+-+-+->
<?php		}	   ?>






	










