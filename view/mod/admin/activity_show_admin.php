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
			 if($data_stu->IDLevel>=3 and $data_stu->IDLevel<=3){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success">
				<strong>ข้อผิดพลาด ! </strong> ระดับชั้น อนุบาล การใช้งานในส่วนนี้ยังไม่เปิดใช้บริการ 
			</div>			
		</div>
	</div><br>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	  <?php }elseif($data_stu->IDLevel>=11 and $data_stu->IDLevel<=13){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success">
				<strong>ข้อผิดพลาด ! </strong> ระดับชั้น อนุบาล การใช้งานในส่วนนี้ยังไม่เปิดใช้บริการ 
			</div>			
		</div>
	</div><br>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	  <?php }elseif($data_stu->IDLevel>=21 and $data_stu->IDLevel<=42){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--============================================================================================-->
<!--********************************************************************************************-->	
<?php
	//time run------------------------------------------------------------------------------------  
		/*$datetime="2022-05-21 00:00:00";
		$datetime_cr=date("Y-m-d H:i:s");
		$datatime_notrun=strtotime($datetime);
		$datatime_run=strtotime($datetime_cr);
			if($datatime_run>=$datatime_notrun){
				$print_runtime="OFF";
			}else{
				$print_runtime="ON";
			}	
		*/
	//time run End--------------------------------------------------------------------------------
		$print_runtime="ON";
		$data_stu=new stu_levelpdo($SudRc,$data_yaer,$data_term);
?>
<!--********************************************************************************************-->		
<?php
	switch($print_runtime){
		case "ON":  ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--********************************************************************************************-->
					<?php
						/*$datetimeON="2022-05-19 18:00:00";	
						$datetime_crON=date("Y-m-d H:i:s");
						//$datetime_crON=$datetimeON;
						$datatime_notrunON=strtotime($datetimeON);
						$datatime_runON=strtotime($datetime_crON);	
						
							if($datatime_runON>=$datatime_notrunON){
								
								$print_runtimeON="ON";
							}else{
								
								$print_runtimeON="OFF";
							}
						*/	
						$print_runtimeON="ON";	
					?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--********************************************************************************************-->
				<?php
						if($print_runtimeON=="OFF"){ ?>
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
								$code_key=filter_input(INPUT_POST,'code_key');
								if($code_key=="key_system"){ ?>
<!--*******************************************************************************************-->		

							<?php
									$activity_key=filter_input(INPUT_POST,'activity_key');
									if($activity_key==""){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-info">
													<strong>พบข้อผิดพลาด</strong> ไม่สามารถลงทะเบียนกิจกรรมชุมนุมได้ 
												</div>
											</div>
										</div>							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
							<?php	}else{
										$count_SturcActivity=new sturc_activity($SudRc,$data_term,$data_yaer);
										$count_SA=0;
										foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
											$count_SA=$count_SA+1;
										}
											if($count_SA>=1){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-info">
													<strong>พบข้อผิดพลาด</strong> ไม่สามารถลงทะเบียนซ้ำได้
												</div>
											</div>
										</div>							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
							<?php			}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
										  <tr>
											<th>ลำดับ</th>
											<th>เลขประจำตัวนักเรียน</th>
											<th>ชื่อ-สกุล</th>
											<th>ชั้น</th>
										  </tr>
										</thead>
										<tbody>
										  
											<?php 
										  
												$activity_sturc=new print_stu_activity($data_term,$data_yaer,$activity_key);
												$sturc_num=0;
												foreach($activity_sturc->print_activitydata() as $rc_key=>$activity_sturcRow){
												$sturc_num=$sturc_num+1;	
												$copy_sturc=new stu_levelpdo($activity_sturcRow["ac_key"],$data_yaer,$data_term);

												$stu_data=new regina_stu_data($activity_sturcRow["ac_key"]);

												?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
												  <tr>
													<td><?php echo $sturc_num;?></td>
													<td><?php echo $activity_sturcRow["ac_key"];?></td>
													<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
													
	<?php
		$stu_data2=new regina_stu_data2($activity_sturcRow["ac_key"],$data_yaer,$data_term,$copy_sturc->IDLevel);
	?>													
													<td><?php echo $stu_data2->Sort_name."/".$stu_data2->rsc_room;?></td>
												  </tr>													
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->														
										<?php	} ?>

										</tbody>
									</table>
								</div>											
							</div>
						</div>
					</div>
				</div>						
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
							<?php			}
									}   ?>
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<form name="button_activity" method="post" action="./?evaluation_mod=activity_rc_admin" accept-charset="UTF-8">
									<center>
										<button type="submit" class="btn btn-success btn-lg" name="activity_key" value="<?php echo $activity_key;?>">ยืนยันลงทะเบียนกิจกรรมชุมนุม</button>
										<button type="button" id="GoTo" class="btn btn-primary btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button>
									</center>		
									<input type="hidden" name="ra_year" value="<?php echo $data_yaer;?>">
									<input type="hidden" name="ra_term" value="<?php echo $data_term;?>">
									<input type="hidden" name="ra_sudkey" value="<?php echo $SudRc;?>">									
								</form>
							</div>
						</div>
					</div>
				</div>		
				
<!--*******************************************************************************************-->									
						<?php	}elseif($code_key=="notkey_system"){ ?>
<!--*******************************************************************************************-->					
							<?php
									$activity_key=filter_input(INPUT_POST,'activity_key');
									if($activity_key==""){ ?>
<!--*******************************************************************************************-->	
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-info">
													<strong>พบข้อผิดพลาด</strong> ไม่สามารถยกเลิกลงทะเบียนกิจกรรมชุมนุมได้ 
												</div>
											</div>
										</div>										
<!--*******************************************************************************************-->										
							<?php	}else{ ?>
<!--*******************************************************************************************-->			
								<?php 
									$delete_activity=new delete_activity_student($SudRc,$data_term,$data_yaer,$activity_key);
										if($delete_activity->delete_activity_rc()=="yes"){	
											$call_check=new check_activityA($activity_key,$data_term,$data_yaer);
											$updata_activity=new updata_activity_keep($activity_key,$data_term,$data_yaer,$call_check->count_ac);
											if($updata_activity->updatato_activiry_keep()=="yes"){ ?>
<!--*******************************************************************************************-->	
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-info">
													<strong>สำเร็จ </strong>ยกเลิกกิจกรรมชุมนุมเรียบร้อยแล้ว
												</div>
											</div>
										</div>	
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												
												<center>				
													<button type="button" id="GoTo" class="btn btn-success btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button>												
													<button type="button" id="GoToHome" class="btn btn-info btn-lg">หน้าสู่เมนูหลัก</button>
												</center>
												
											</div>
										</div>
<!--*******************************************************************************************-->		
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ยกเลิกกิจกรรมชุมนุมเรียบร้อยแล้ว รหัสกิจกรรม ".$activity_key." ".$data_term." / ".$data_yaer." IP:".$db_evaluationID;

				
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
<!--*******************************************************************************************-->												
								<?php		}else{
												
											}
										}else{
											//***********************************************************
										}
								?>								
<!--*******************************************************************************************-->										
							<?php	}      ?>
<!--*******************************************************************************************-->									
						<?php	}else{ ?>
<!--*******************************************************************************************-->								
<!--*******************************************************************************************-->								
						<?php	}      ?>
<!--*******************************************************************************************-->						
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->		
				<?php }       ?>
<!--/////////////////////////////////////////////////////////////////////-->					
<!--********************************************************************************************-->
<!--********************************************************************************************-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	break;
		case "OFF": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--/////////////////////////////////////////////////////////////////////-->	
<!--/////////////////////////////////////////////////////////////////////-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>หมดเวลาลงทะเบียน</strong> ลงทะเบียนกิจกรรมชุมนุม ตั้งแต่วันนี้เป็นต้นไป  
			</div>			
		</div>
	</div><br>							
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	break;      
		default:	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}           ?>
<!--============================================================================================-->			  
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			  
	<?php }elseif($data_stu->IDLevel==43){ ?>
<!--*******************************************************************************************-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong> ระดับชั้น มัธยมศึกษาปีที่ 6 การใช้งานในส่วนนี้ยังไม่เปิดใช้บริการ 
			</div>			
		</div>
	</div><br>	
<!--*******************************************************************************************-->		  
	<?php }else{  ?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>พบข้อผิดพลาด </strong> ไม่สามารถใช้งานได้ มีข้อสังสัยกรุณาติดต่อสอบถามได้ที่ งาน ฝ่าย ICT 053-282395 ต่อ 108 
			</div>			
		</div>
	</div><br>			
	  <?php	}	?>