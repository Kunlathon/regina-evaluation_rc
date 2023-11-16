<?php
	include("view/database/pdo_data.php");
	include("view/database/class_pdo.php");	
	
	include("view/database/database_paynew.php");
	include("view/database/class_pay.php");
    
    include("view/function/pay_scb.php");
	//error_reporting(error_reporting() & ~E_NOTICE);
	$data_yaer=2566;
	$data_term=2;

	$user_login;
	
	$stu_cilk=filter_input(INPUT_POST,'stu_cilk');	
	
	$datetime="2024-01-01 00:00:00";
	$datetime_cr=date("Y-m-d H:i:s");
	$datatime_notrun=strtotime($datetime);
	$datatime_run=strtotime($datetime_cr);
		
	$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
		
		if($datatime_run>=$datatime_notrun){
			$print_runtime="OFF";
		}else{
			$print_runtime="ON";
		}

?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4><span class="text-semibold">เรียนเสริมเย็น ภาคเรียน ที่ <?php echo $data_term." / ".$data_yaer;?></span></h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=stu_supplementary" class="btn btn-link  text-size-small"><span>เรียนเสริมเย็น</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>


<?php
		if($data_stu->IDLevel>=3 and $data_stu->IDLevel<=3){ ?>
<!--######################################################################################################-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<?php

							if($stu_cilk=="cilk_no"){ ?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<?php
									//sr_academic -> วิชาการ
									//sr_activity -> กิจกรรม
                                    $sud_grouppay=new print_stu_grouppay($user_login,$data_yaer,$data_stu->rc_plan,$data_stu->IDLevel);
									$call_registration=new supplementary_registration($data_stu->IDLevel,$data_stu->rc_plan);
									if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){ //รวมทั้งหมด?>
					<!--***************************************************************************************************-->	
									
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<?php
							$supplementary_stursSql="SELECT count(`sup_stuid`) as `count_use` 
													 FROM `supplementary_sturs` 
													 WHERE `sup_t`='{$data_term}' 
													 and `sup_l`='{$data_stu->IDLevel}' 
													 and `sup_year`='{$data_yaer}'
													 and `sup_stuid`='{$user_login}';";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$count_use=$supplementary_stursRow["count_use"];
								if($count_use>=1){ 
									exit("<script>window.location='../?evaluation_mod=stu_supplementary';</script>");
								}else{
									//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
								}
							}
						?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

									<?php
											/*$count_stuSql="SELECT count(`sup_stuid`) as `count_stu` 
														   FROM `supplementary_sturs` 
														   WHERE `sup_t`='{$data_term}' and `sup_l`='{$data_stu->IDLevel}' and `sup_year`='{$data_yaer}';";
											$count_stuRs=new notrow_evaluation($count_stuSql);
											foreach($count_stuRs->evaluation_array as $rc_key=>$count_stuRow){
												$count_stu=$count_stuRow["count_stu"];
												$count_stu=$count_stu+1;
											}*/
										?>
										
										
										
										
										
										<?php
											$call_subjectSql="SELECT `ss_id`,`ss_txtth` 
															  FROM `supplementary_subject` 
															  WHERE `ss_t`='{$data_term}' 
															  and `ss_l`='{$data_stu->IDLevel}'
															  and `ss_plan`='{$data_stu->rc_plan}' 
															  and `ss_year`='{$data_yaer}'";
											$call_subjectRs=new row_evaluation($call_subjectSql);
											
											foreach($call_subjectRs->evaluation_array as $rc_key=>$call_subjectRow){
												
												$ss_id=$call_subjectRow["ss_id"];
												
												if($ss_id==null){
													//*************************************************************************
												}else{
													/*$supplementary_subjectSql="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$count_stu}',`subject_TuesKeep`='{$count_stu}',`subject_WednesKeep`='{$count_stu}',`subject_ThursKeep`='{$count_stu}'
																			 ,`subject_FriKeep`='{$count_stu}' WHERE `ss_id`='{$ss_id}' and `ss_t`='{$data_term}' and `ss_l`='{$data_stu->IDLevel}' and `ss_year`='{$data_yaer}' and `ss_plan`='{$data_stu->rc_plan}'";
													$supplementary_subject=new insert_evaluation($supplementary_subjectSql);*/
													
													$supplementary_stursSql="INSERT INTO `supplementary_sturs` (`sup_stuid`, `sup_t`, `sup_l`, `sup_year`, `ss_id`, `ss_mon`, `ss_tues`, `ss_wedne`, `ss_thurs`, `ss_fri`, `ss_satur`, `ss_sun`, `sup_datetime`) 
																			 VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$ss_id}', '1', '1', '1', '1', '1', '1', '1', '{$datetime_cr}');";
													$supplementary_sturs=new insert_evaluation($supplementary_stursSql);								
												}
											}
										
										?>
										
<!--******************************************************************************************************-->		
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<?php
												$print_subject_stu=new supplementary_sturs($user_login,$data_term,$data_stu->IDLevel,$data_yaer);
												
												foreach($print_subject_stu->array_sturs as $rc_key=>$print_subject_stuRow){
													$print_subject=$print_subject_stuRow["ss_txtth"];
													$print_subjectId=$print_subject_stuRow["ss_id"]; ?>
<!--******************************************************************************************************-->
													<div class="panel panel-success">
														<div class="alert alert-danger">
															<p><strong>รายวิชา / กิจกรรม ที่ลงทะเบียน </strong><?php echo $print_subject;?></p>		
														</div>
													</div>
<!--******************************************************************************************************-->													
											<?php	} ?>
										</div>
									</div>
<!--******************************************************************************************************-->										
										
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
											    <div class="panel panel-warning">
                                                    <div class="panel-body">
												<?php
													$pay_supplementarySql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` FROM `supplementary_school` WHERE  `ss_pay`='ALLPAY' AND `ss_id`='{$print_subjectId}'";
													$pay_supplementaryRs=new notrow_evaluation($pay_supplementarySql);
													foreach($pay_supplementaryRs->evaluation_array as $rc_key=>$pay_supplementaryPrint){
														$supplementary_id=$pay_supplementaryPrint["supplementary_id"];
                                                        $supplementary_pay=$pay_supplementaryPrint["supplementary_pay"];
														if($supplementary_id==Null){ ?>
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->			
															<div class="row">
																<div class="col-<?php echo $grid;?>-12">
																	<div class="alert alert-danger">
																		<p><strong>ไม่พบ QRcode</strong>กรุณาติดต่อที่ห้องการเงิน</p>		
																	</div>	
																</div>
															</div>		
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->												
												<?php	}else{
                                                            $class=$data_stu->IDLevel;
                                                            $class_ex=$data_stu->Sort_name_E2;
                                                            $txt_billerId="099400043439110";
                                                            $txt_ref1=strtoupper($user_login."L".$class_ex."Y".$supplementary_id);
                                                            $txt_ref2=strtoupper("TUTOR0T".$data_term."0Y".$data_yaer);
                                                            
                                                                if($sud_grouppay->ps_id==11){
                                                                    $txt_amount=0;
                                                                }elseif($sud_grouppay->ps_id==12){
                                                                    $txt_amount=0;
                                                                }else{
                                                                    $txt_amount=$supplementary_pay; 
                                                                }
                                                            
                                                            $txt_width="204";
                                                            $payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
                                                    ?>
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->			
															<div class="row">
                                                                <div class="col-<?php echo $grid;?>-3">
                                                                    <div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="204" height="136"></div>
                                                                    <div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
                                                                    <div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
                                                                    <div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
                                                                    <div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($txt_amount, 2, '.', ',');?></div>
                                                                </div>
                                                                <div class="col-<?php echo $grid;?>-9">
                                                                    <div><b>วิธีการชำระ</b></div>
                                                                    <div>1&nbsp;.&nbsp;ทำการสแกน QR Code ที่ปรากฏในเพจนี้ ด้วยแอปพลิเคชัน Mobile Banking ของท่าน</div>
                                                                    <div>2&nbsp;.&nbsp;ตรวจสอบข้อมูลที่ปรากฏใน Mobile Banking ให้ถูกต้องก่อนชำระเงิน</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบเลขประจำตัวนักเรียนให้ถูกต้อง</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ref1&nbsp;:&nbsp;เลขประจำตัวนักเรียน&nbsp;5&nbsp;หลัก &nbsp;L&nbsp;คือชั้น</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ref2&nbsp;:&nbsp;ตัวอักษรคำว่า&nbsp;"TUTOR"&nbsp;0T&nbsp;คือ&nbsp;ภาคเรียน&nbsp;0Y&nbsp;คือ&nbsp;ปีการศึกษา</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบจำนวนเงินให้ถูกต้อง</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบชื่อผู้รับเงินต้องเป็น โรงเรียนเรยีนาเชลีวิทยาลัย หรือ REGINA COELI COLLEGE SCHOOL เท่านั้น</div>
                                                                    <div>3&nbsp;.&nbsp;สำหรับหลักฐานการชำระเงินให้ท่านเก็บไว้เป็นหลักฐาน</div>
                                                                    <div>4&nbsp;.&nbsp;ทางโรงเรียนจะทำการตรวจสอบรายการและยืนยันการชำระเงินของท่าน </div>
                                                                    <div>5&nbsp;.&nbsp;การชำระเงินจะเสร็จสมบูรณ์ เมื่อทางโรงเรียนได้ตรวจสอบการชำระเงินของท่านเรียบร้อยแล้ว</div>
                                                                    <div>6&nbsp;.&nbsp;หากต้องการใบเสร็จรับเงิน ติดต่อขอรับได้ที่ห้องการเงินของโรงเรียน</div>
                                                                    <div>7&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการชำระเงิน กรณาติดต่อ ห้องการเงิน 053-282395 ต่อ 105</div>                                                                
                                                                    <div>8&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการเรียนเสริมนอกตารางเรียนกรณาติดต่อ ห้องวิชาการ 053-282395 ต่อ 121</div>                                                                
                                                                </div>
                                                            </div>
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->																								
												<?php	}
													}
												?>                                                    
                                                    </div>
                                                </div>
											</div>
										</div><hr>
										
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="col-<?php echo $grid;?>-12">
													<div class="alert alert-info">
														<strong>ลงทะเบียนเสริมเย็นสำเร็จ</strong>
													</div>
												</div>						
											</div>
										</div>	
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
											</div>
										</div>		

<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->
	<!--**************************************************************-->
	<?php
		if($db_evaluationID=="127.0.0.1"){
			//****************************
		}else{
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ลงทะเบียน เสริมเรียนนอกตารางเรียน สำเร็จ".$data_term." / ".$data_yaer." IP:".$db_evaluationID;

					
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

<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->
										
					<!--***************************************************************************************************-->						
							<?php   }elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="N"){//เรียนเฉราะวิชาการ ?>
										
							<?php	}elseif($call_registration->sr_academic=="N" and $call_registration->sr_activity=="Y"){//เรียนเฉราะกิจกรรม ?>
										
							<?php	}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="Y"){//เรียนทั้ง วิชาการ และ กิจกรรม ?>
										
							<?php	}else{ ?>
					<!--***************************************************************************************************-->	
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="alert alert-warning">
									<strong>พบข้อผิดพลาด</strong>ไม่สามารถลงทะเบียนเรียนเสริมนอกตารางเรียนได้
								</div>
							</div>
						</div>	
					<!--***************************************************************************************************-->					
							<?php	}      ?>		
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
					<?php	}elseif($stu_cilk=="cilk_yes"){ ?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<?php
									//sr_academic -> วิชาการ
									//sr_activity -> กิจกรรม
									$call_registration=new supplementary_registration($data_stu->IDLevel,$data_stu->rc_plan);
									if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){ //รวมทั้งหมด?>
					<!--***************************************************************************************************-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<?php
											$supplementary_stursSql="SELECT count(`sup_stuid`) as `count_use` 
																	 FROM `supplementary_sturs` 
																	 WHERE `sup_t`='{$data_term}' 
																	 and `sup_l`='{$data_stu->IDLevel}' 
																	 and `sup_year`='{$data_yaer}'
																	 and `sup_stuid`='{$user_login}';";
											$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
											foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
												$count_use=$supplementary_stursRow["count_use"];
												if($count_use>=1){ 
													//------------------------------------------------------------------------------
												}else{
													exit("<script>window.location='../?evaluation_mod=stu_supplementary';</script>");
												}
											}
										?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
					<!--***************************************************************************************************-->	
										<?php
											/*$count_stuSql="SELECT count(`sup_stuid`) as `count_stu` 
														   FROM `supplementary_sturs` 
														   WHERE `sup_t`='{$data_term}' and `sup_l`='{$data_stu->IDLevel}' and `sup_year`='{$data_yaer}';";
											$count_stuRs=new notrow_evaluation($count_stuSql);
											foreach($count_stuRs->evaluation_array as $rc_key=>$count_stuRow){
												$count_stu=$count_stuRow["count_stu"];
												if($count_stu==0){
													$count_stu;
												}else{
													$count_stu=$count_stu-1;
												}
												
											}*/
										?>
										
										
										
										
										
										<?php
											$call_subjectSql="SELECT `ss_id`,`ss_txtth` 
															  FROM `supplementary_subject` 
															  WHERE `ss_t`='{$data_term}' 
															  and `ss_l`='{$data_stu->IDLevel}'
															  and `ss_plan`='{$data_stu->rc_plan}' 
															  and `ss_year`='{$data_yaer}'";
											$call_subjectRs=new row_evaluation($call_subjectSql);
											
											foreach($call_subjectRs->evaluation_array as $rc_key=>$call_subjectRow){
												
												$ss_id=$call_subjectRow["ss_id"];
												
												if($ss_id==""){
													//*************************************************************************
												}else{
													/*$supplementary_subjectSql="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$count_stu}',`subject_TuesKeep`='{$count_stu}',`subject_WednesKeep`='{$count_stu}',`subject_ThursKeep`='{$count_stu}'
																			 ,`subject_FriKeep`='{$count_stu}' WHERE `ss_id`='{$ss_id}' and `ss_t`='{$data_term}' and `ss_l`='{$data_stu->IDLevel}' and `ss_year`='{$data_yaer}' and `ss_plan`='{$data_stu->rc_plan}'";
													$supplementary_subject=new insert_evaluation($supplementary_subjectSql);*/
													
													$supplementary_stursSql="DELETE FROM `supplementary_sturs` WHERE `sup_stuid`='{$user_login}' AND `sup_t` = '{$data_term}' AND `sup_l` ='{$data_stu->IDLevel}' AND `sup_year` = '{$data_yaer}'";
													$supplementary_sturs=new insert_evaluation($supplementary_stursSql);								
												}
											}
										
										?>
										
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-info">
													<strong>ยกเลิกลงทะเบียนเสริมเย็นสำเร็จ</strong>
												</div>
											</div>						
										</div>	
										
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
											</div>
										</div>
										
<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->
	<!--**************************************************************-->
	<?php
		if($db_evaluationID=="127.0.0.1"){
			//****************************
		}else{
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ยกเลิกลงทะเบียน เสริมเรียนนอกตารางเรียน สำเร็จ".$data_yaer." / ".$data_term." IP:".$db_evaluationID;

					
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

<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->										
										
					<!--***************************************************************************************************-->						
							<?php   }elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="N"){//เรียนเฉราะวิชาการ ?>
										
							<?php	}elseif($call_registration->sr_academic=="N" and $call_registration->sr_activity=="Y"){//เรียนเฉราะกิจกรรม ?>
										
							<?php	}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="Y"){//เรียนทั้ง วิชาการ และ กิจกรรม ?>
										
							<?php	}else{ ?>
					<!--***************************************************************************************************-->	
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="alert alert-warning">
									<strong>พบข้อผิดพลาด</strong>ไม่สามารถลงทะเบียนเรียนเสริมนอกตารางเรียนได้
								</div>
							</div>
						</div>	
					<!--***************************************************************************************************-->					
							<?php	}      ?>		
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			

					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
					<?php	}else{ ?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<?php exit("<script>window.location='../?evaluation_mod=stu_supplementary';</script>");?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
					<?php	} ?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	
<!--######################################################################################################-->		
<?php	}elseif($data_stu->IDLevel>=11 and $data_stu->IDLevel<=23){ ?>
<!--######################################################################################################-->	
	
	
		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

					<?php

							if($stu_cilk=="cilk_no"){ ?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<?php
									//sr_academic -> วิชาการ
									//sr_activity -> กิจกรรม
                                    $sud_grouppay=new print_stu_grouppay($user_login,$data_yaer,$data_stu->rc_plan,$data_stu->IDLevel);
									$call_registration=new supplementary_registration($data_stu->IDLevel,$data_stu->rc_plan);
									if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){ //รวมทั้งหมด?>
					<!--***************************************************************************************************-->	
										
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<?php
											$supplementary_stursSql="SELECT count(`sup_stuid`) as `count_use` 
																	 FROM `supplementary_sturs` 
																	 WHERE `sup_t`='{$data_term}' 
																	 and `sup_l`='{$data_stu->IDLevel}' 
																	 and `sup_year`='{$data_yaer}'
																	 and `sup_stuid`='{$user_login}';";
											$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
											foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
												$count_use=$supplementary_stursRow["count_use"];
												if($count_use>=1){ 
													exit("<script>window.location='../?evaluation_mod=stu_supplementary';</script>");
												}else{
													//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
												}
											}
										?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
										
										
										<?php
											/*$count_stuSql="SELECT count(`sup_stuid`) as `count_stu` 
														   FROM `supplementary_sturs` 
														   WHERE `sup_t`='{$data_term}' and `sup_l`='{$data_stu->IDLevel}' and `sup_year`='{$data_yaer}';";
											$count_stuRs=new notrow_evaluation($count_stuSql);
											foreach($count_stuRs->evaluation_array as $rc_key=>$count_stuRow){
												$count_stu=$count_stuRow["count_stu"];
												$count_stu=$count_stu+1;
											}*/
										?>
										
										
										
										
										
										<?php
											$call_subjectSql="SELECT `ss_id`,`ss_txtth` 
															  FROM `supplementary_subject` 
															  WHERE `ss_t`='{$data_term}' 
															  and `ss_l`='{$data_stu->IDLevel}'
															  and `ss_plan`='{$data_stu->rc_plan}' 
															  and `ss_year`='{$data_yaer}'";
											$call_subjectRs=new row_evaluation($call_subjectSql);
											
											foreach($call_subjectRs->evaluation_array as $rc_key=>$call_subjectRow){
												
												$ss_id=$call_subjectRow["ss_id"];
												
												if($ss_id==""){
													//*************************************************************************
												}else{
													/*$supplementary_subjectSql="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$count_stu}',`subject_TuesKeep`='{$count_stu}',`subject_WednesKeep`='{$count_stu}',`subject_ThursKeep`='{$count_stu}'
																			 ,`subject_FriKeep`='{$count_stu}' WHERE `ss_id`='{$ss_id}' and `ss_t`='{$data_term}' and `ss_l`='{$data_stu->IDLevel}' and `ss_year`='{$data_yaer}' and `ss_plan`='{$data_stu->rc_plan}'";
													$supplementary_subject=new insert_evaluation($supplementary_subjectSql);*/
													
													$supplementary_stursSql="INSERT INTO `supplementary_sturs` (`sup_stuid`, `sup_t`, `sup_l`, `sup_year`, `ss_id`, `ss_mon`, `ss_tues`, `ss_wedne`, `ss_thurs`, `ss_fri`, `ss_satur`, `ss_sun`, `sup_datetime`) 
																			 VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$ss_id}', '1', '1', '1', '1', '1', '1', '1', '{$datetime_cr}');";
													$supplementary_sturs=new insert_evaluation($supplementary_stursSql);								
												}
											}
										
										?>
<!--******************************************************************************************************-->		
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<?php
												$print_subject_stu=new supplementary_sturs($user_login,$data_term,$data_stu->IDLevel,$data_yaer);
												
												foreach($print_subject_stu->array_sturs as $rc_key=>$print_subject_stuRow){
													$print_subject=$print_subject_stuRow["ss_txtth"];
													$print_subjectId=$print_subject_stuRow["ss_id"]; ?>
<!--******************************************************************************************************-->
													<div class="panel panel-success">
														<div class="alert alert-danger">
															<p><strong>รายวิชา / กิจกรรม ที่ลงทะเบียน </strong><?php echo $print_subject;?></p>		
														</div>
													</div>
<!--******************************************************************************************************-->													
											<?php	} ?>
										</div>
									</div>
<!--******************************************************************************************************-->										
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
											    <div class="panel panel-warning">
                                                    <div class="panel-body">
												<?php
													$pay_supplementarySql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` FROM `supplementary_school` WHERE   `ss_pay`='ALLPAY' AND `ss_id`='{$print_subjectId}'";
													$pay_supplementaryRs=new notrow_evaluation($pay_supplementarySql);
													foreach($pay_supplementaryRs->evaluation_array as $rc_key=>$pay_supplementaryPrint){
														$supplementary_id=$pay_supplementaryPrint["supplementary_id"];
                                                        $supplementary_pay=$pay_supplementaryPrint["supplementary_pay"];
														if($supplementary_id==Null){ ?>
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->			
															<div class="row">
																<div class="col-<?php echo $grid;?>-12">
																	<div class="alert alert-danger">
																		<p><strong>ไม่พบ QRcode</strong>กรุณาติดต่อที่ห้องการเงิน</p>		
																	</div>	
																</div>
															</div>		
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->												
												<?php	}else{
                                                            $class=$data_stu->IDLevel;
                                                            $class_ex=$data_stu->Sort_name_E2;
                                                            $txt_billerId="099400043439110";
                                                            $txt_ref1=strtoupper($user_login."L".$class_ex."Y".$supplementary_id);
                                                            $txt_ref2=strtoupper("TUTOR0T".$data_term."0Y".$data_yaer);
                                                            
                                                                if($sud_grouppay->ps_id==11){
                                                                    $txt_amount=1500;
                                                                }elseif($sud_grouppay->ps_id==12){
                                                                   $txt_amount=1500;
                                                                }else{
                                                                   $txt_amount=$supplementary_pay; 
                                                                }
                                                            
                                                            $txt_width="204";
                                                            $payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
                                                    ?>
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->			
															<div class="row">
                                                                <div class="col-<?php echo $grid;?>-3">
                                                                    <div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="204" height="136"></div>
                                                                    <div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
                                                                    <div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
                                                                    <div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
                                                                    <div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($txt_amount, 2, '.', ',');?></div>
                                                                </div>
                                                                <div class="col-<?php echo $grid;?>-9">
                                                                    <div><b>วิธีการชำระ</b></div>
                                                                    <div>1&nbsp;.&nbsp;ทำการสแกน QR Code ที่ปรากฏในเพจนี้ ด้วยแอปพลิเคชัน Mobile Banking ของท่าน</div>
                                                                    <div>2&nbsp;.&nbsp;ตรวจสอบข้อมูลที่ปรากฏใน Mobile Banking ให้ถูกต้องก่อนชำระเงิน</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบเลขประจำตัวนักเรียนให้ถูกต้อง</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ref1&nbsp;:&nbsp;เลขประจำตัวนักเรียน&nbsp;5&nbsp;หลัก &nbsp;L&nbsp;คือชั้น</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ref2&nbsp;:&nbsp;ตัวอักษรคำว่า&nbsp;"TUTOR"&nbsp;0T&nbsp;คือ&nbsp;ภาคเรียน&nbsp;0Y&nbsp;คือ&nbsp;ปีการศึกษา</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบจำนวนเงินให้ถูกต้อง</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบชื่อผู้รับเงินต้องเป็น โรงเรียนเรยีนาเชลีวิทยาลัย หรือ REGINA COELI COLLEGE SCHOOL เท่านั้น</div>
                                                                    <div>3&nbsp;.&nbsp;สำหรับหลักฐานการชำระเงินให้ท่านเก็บไว้เป็นหลักฐาน</div>
                                                                    <div>4&nbsp;.&nbsp;ทางโรงเรียนจะทำการตรวจสอบรายการและยืนยันการชำระเงินของท่าน </div>
                                                                    <div>5&nbsp;.&nbsp;การชำระเงินจะเสร็จสมบูรณ์ เมื่อทางโรงเรียนได้ตรวจสอบการชำระเงินของท่านเรียบร้อยแล้ว</div>
                                                                    <div>6&nbsp;.&nbsp;หากต้องการใบเสร็จรับเงิน ติดต่อขอรับได้ที่ห้องการเงินของโรงเรียน</div>
                                                                    <div>7&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการชำระเงิน กรณาติดต่อ ห้องการเงิน 053-282395 ต่อ 105</div>                                                                
                                                                    <div>8&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการเรียนเสริมนอกตารางเรียนกรณาติดต่อ ห้องวิชาการ 053-282395 ต่อ 121</div>                                                                
                                                                </div>
                                                            </div>
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->																								
												<?php	}
													}
												?>                                                    
                                                    </div>
                                                </div>
											</div>
										</div><hr>
										
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="col-<?php echo $grid;?>-12">
													<div class="alert alert-info">
														<strong>ลงทะเบียนเสริมเย็นสำเร็จ</strong>
													</div>
												</div>						
											</div>
										</div>		
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
											</div>
										</div>
<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->
	<!--**************************************************************-->
	<?php
		if($db_evaluationID=="127.0.0.1"){
			//****************************
		}else{
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ลงทะเบียน เสริมเรียนนอกตารางเรียน สำเร็จ".$data_term." / ".$data_yaer." IP:".$db_evaluationID;

					
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

<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->										
					<!--***************************************************************************************************-->						
							<?php   }elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="N"){//เรียนเฉราะวิชาการ ?>
										
							<?php	}elseif($call_registration->sr_academic=="N" and $call_registration->sr_activity=="Y"){//เรียนเฉราะกิจกรรม ?>
					<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<?php
											$supplementary_stursSql="SELECT count(`sup_stuid`) as `count_use` 
																	 FROM `supplementary_sturs` 
																	 WHERE `sup_t`='{$data_term}' 
																	 and `sup_l`='{$data_stu->IDLevel}' 
																	 and `sup_year`='{$data_yaer}'
																	 and `sup_stuid`='{$user_login}';";
											$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
											foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
												$count_use=$supplementary_stursRow["count_use"];
												if($count_use>=1){ 
													exit("<script>window.location='../?evaluation_mod=stu_supplementary';</script>");
												}else{
													//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
												}
											}
										?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

										<?php
											$copy_ss_id=filter_input(INPUT_POST,'copy_ss_id');
										
											/*$count_stuSql="SELECT count(`sup_stuid`) as `count_stu` 
														   FROM `supplementary_sturs` 
														   WHERE `sup_t`='{$data_term}' and `sup_l`='{$data_stu->IDLevel}' and `sup_year`='{$data_yaer}' and `ss_id`='{$copy_ss_id}'";
											$count_stuRs=new notrow_evaluation($count_stuSql);
											foreach($count_stuRs->evaluation_array as $rc_key=>$count_stuRow){
												$count_stu=$count_stuRow["count_stu"];
												$count_stu=$count_stu+1;
											}*/
											
											
													/*$supplementary_subjectSql="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$count_stu}',`subject_TuesKeep`='{$count_stu}',`subject_WednesKeep`='{$count_stu}',`subject_ThursKeep`='{$count_stu}'
																			 ,`subject_FriKeep`='{$count_stu}' WHERE `ss_id`='{$copy_ss_id}' and `ss_t`='{$data_term}' and `ss_l`='{$data_stu->IDLevel}' and `ss_year`='{$data_yaer}' and `ss_plan`='{$data_stu->rc_plan}'";
													$supplementary_subject=new insert_evaluation($supplementary_subjectSql);*/
													
														//if($supplementary_subject->system_insert=="yes"){
															$supplementary_stursSql="INSERT INTO `supplementary_sturs` (`sup_stuid`, `sup_t`, `sup_l`, `sup_year`, `ss_id`, `ss_mon`, `ss_tues`, `ss_wedne`, `ss_thurs`, `ss_fri`, `ss_satur`, `ss_sun`,`ss_activity`, `sup_datetime`) 
																					 VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$copy_ss_id}', '1', '1', '1', '1', '1', '1', '1','cilk_true', '{$datetime_cr}');";
															$supplementary_sturs=new insert_evaluation($supplementary_stursSql);			
															if($supplementary_sturs->system_insert=="yes"){ ?>
					<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--******************************************************************************************************-->		
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<?php
												$print_subject_stu=new supplementary_sturs($user_login,$data_term,$data_stu->IDLevel,$data_yaer);
												
												foreach($print_subject_stu->array_sturs as $rc_key=>$print_subject_stuRow){
													$print_subject=$print_subject_stuRow["ss_txtth"];
													$print_subjectId=$print_subject_stuRow["ss_id"]; ?>
<!--******************************************************************************************************-->
													<div class="panel panel-success">
														<div class="alert alert-danger">
															<p><strong>รายวิชา / กิจกรรม ที่ลงทะเบียน </strong><?php echo $print_subject;?></p>		
														</div>
													</div>
<!--******************************************************************************************************-->													
											<?php	} ?>
										</div>
									</div>
<!--******************************************************************************************************-->
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
											    <div class="panel panel-warning">
                                                    <div class="panel-body">
												<?php
													$pay_supplementarySql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` FROM `supplementary_school` WHERE   `ss_pay`='PAYMENT' AND `ss_id`='{$print_subjectId}'";
													$pay_supplementaryRs=new notrow_evaluation($pay_supplementarySql);
													foreach($pay_supplementaryRs->evaluation_array as $rc_key=>$pay_supplementaryPrint){
														$supplementary_id=$pay_supplementaryPrint["supplementary_id"];
                                                        $supplementary_pay=$pay_supplementaryPrint["supplementary_pay"];
														if($supplementary_id==Null){ ?>
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->			
															<div class="row">
																<div class="col-<?php echo $grid;?>-12">
																	<div class="alert alert-danger">
																		<p><strong>ไม่พบ QRcode</strong>กรุณาติดต่อที่ห้องการเงิน</p>		
																	</div>	
																</div>
															</div>		
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->												
												<?php	}else{
                                                            $class=$data_stu->IDLevel;
                                                            $class_ex=$data_stu->Sort_name_E2;
                                                            $txt_billerId="099400043439110";
                                                            $txt_ref1=strtoupper($user_login."L".$class_ex."Y".$supplementary_id);
                                                            $txt_ref2=strtoupper("TUTOR0T".$data_term."0Y".$data_yaer);
                                                           
                                                                if($sud_grouppay->ps_id==11){
                                                                    $txt_amount=1500;
                                                                }elseif($sud_grouppay->ps_id==12){
                                                                   $txt_amount=1500;
                                                                }else{
                                                                   $txt_amount=$supplementary_pay; 
                                                                }
                                                           
                                                            $txt_width="204";
                                                            $payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
                                                    ?>
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->			
															<div class="row">
                                                                <div class="col-<?php echo $grid;?>-3">
                                                                    <div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="204" height="136"></div>
                                                                    <div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
                                                                    <div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
                                                                    <div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
                                                                    <div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($txt_amount, 2, '.', ',');?></div>
                                                                </div>
                                                                <div class="col-<?php echo $grid;?>-9">
                                                                    <div><b>วิธีการชำระ</b></div>
                                                                    <div>1&nbsp;.&nbsp;ทำการสแกน QR Code ที่ปรากฏในเพจนี้ ด้วยแอปพลิเคชัน Mobile Banking ของท่าน</div>
                                                                    <div>2&nbsp;.&nbsp;ตรวจสอบข้อมูลที่ปรากฏใน Mobile Banking ให้ถูกต้องก่อนชำระเงิน</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบเลขประจำตัวนักเรียนให้ถูกต้อง</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ref1&nbsp;:&nbsp;เลขประจำตัวนักเรียน&nbsp;5&nbsp;หลัก &nbsp;L&nbsp;คือชั้น</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ref2&nbsp;:&nbsp;ตัวอักษรคำว่า&nbsp;"TUTOR"&nbsp;0T&nbsp;คือ&nbsp;ภาคเรียน&nbsp;0Y&nbsp;คือ&nbsp;ปีการศึกษา</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบจำนวนเงินให้ถูกต้อง</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบชื่อผู้รับเงินต้องเป็น โรงเรียนเรยีนาเชลีวิทยาลัย หรือ REGINA COELI COLLEGE SCHOOL เท่านั้น</div>
                                                                    <div>3&nbsp;.&nbsp;สำหรับหลักฐานการชำระเงินให้ท่านเก็บไว้เป็นหลักฐาน</div>
                                                                    <div>4&nbsp;.&nbsp;ทางโรงเรียนจะทำการตรวจสอบรายการและยืนยันการชำระเงินของท่าน </div>
                                                                    <div>5&nbsp;.&nbsp;การชำระเงินจะเสร็จสมบูรณ์ เมื่อทางโรงเรียนได้ตรวจสอบการชำระเงินของท่านเรียบร้อยแล้ว</div>
                                                                    <div>6&nbsp;.&nbsp;หากต้องการใบเสร็จรับเงิน ติดต่อขอรับได้ที่ห้องการเงินของโรงเรียน</div>
                                                                    <div>7&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการชำระเงิน กรณาติดต่อ ห้องการเงิน 053-282395 ต่อ 105</div>                                                                
                                                                    <div>8&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการเรียนเสริมนอกตารางเรียนกรณาติดต่อ ห้องวิชาการ 053-282395 ต่อ 121</div>                                                                
                                                                </div>
                                                            </div>
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->																								
												<?php	}
													}
												?>                                                    
                                                    </div>
                                                </div>
											</div>
										</div><hr>

										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="col-<?php echo $grid;?>-12">
													<div class="alert alert-info">
														<strong>ลงทะเบียนเสริมเย็นสำเร็จ</strong>
													</div>
												</div>						
											</div>
										</div>		
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
											</div>
										</div>	
<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->
	<!--**************************************************************-->
	<?php
		if($db_evaluationID=="127.0.0.1"){
			//****************************
		}else{
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ลงทะเบียน เสริมเรียนนอกตารางเรียน สำเร็จ".$data_term." / ".$data_yaer." IP:".$db_evaluationID;

					
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

<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->										
					<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
										<?php				}else{ ?>
					<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-warning">
													<strong>พบข้อผิดพลาด</strong>ไม่สามารถลงทะเบียนเรียนเสริมนอกตารางเรียนได้
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
											</div>
										</div>						
					<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
										<?php				}
														//}else{ ?>
					<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<!--<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-warning">
													<strong>พบข้อผิดพลาด </strong>ไม่สามารถลงทะเบียนเรียนเสริมนอกตารางเรียนได้ 1113
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
											</div>
										</div>-->						
					<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->														
										<?php			//}?>
																				
					<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
							<?php	}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="Y"){//เรียนทั้ง วิชาการ และ กิจกรรม ?>
										
							<?php	}else{ ?>
					<!--***************************************************************************************************-->	
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="alert alert-warning">
									<strong>พบข้อผิดพลาด</strong>ไม่สามารถลงทะเบียนเรียนเสริมนอกตารางเรียนได้ 111
								</div>
							</div>
						</div>	
					<!--***************************************************************************************************-->					
							<?php	}      ?>		
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
					<?php	}elseif($stu_cilk=="cilk_yes"){ ?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<?php
									//sr_academic -> วิชาการ
									//sr_activity -> กิจกรรม
									$call_registration=new supplementary_registration($data_stu->IDLevel,$data_stu->rc_plan);
									if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){ //รวมทั้งหมด?>
					<!--***************************************************************************************************-->					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<?php
											$supplementary_stursSql="SELECT count(`sup_stuid`) as `count_use` 
																	 FROM `supplementary_sturs` 
																	 WHERE `sup_t`='{$data_term}' 
																	 and `sup_l`='{$data_stu->IDLevel}' 
																	 and `sup_year`='{$data_yaer}'
																	 and `sup_stuid`='{$user_login}';";
											$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
											foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
												$count_use=$supplementary_stursRow["count_use"];
												if($count_use>=1){ 
													//------------------------------------------------------------------------------
												}else{
													exit("<script>window.location='../?evaluation_mod=stu_supplementary';</script>");
												}
											}
										?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
					<!--***************************************************************************************************-->	

										<?php
											$call_subjectSql="SELECT `ss_id`,`ss_txtth` 
															  FROM `supplementary_subject` 
															  WHERE `ss_t`='{$data_term}' 
															  and `ss_l`='{$data_stu->IDLevel}'
															  and `ss_plan`='{$data_stu->rc_plan}' 
															  and `ss_year`='{$data_yaer}'";
											$call_subjectRs=new row_evaluation($call_subjectSql);
											
											foreach($call_subjectRs->evaluation_array as $rc_key=>$call_subjectRow){
												
												$ss_id=$call_subjectRow["ss_id"];
													//*************************************************************************												
												
													/*$count_stuSql="SELECT count(`sup_stuid`) as `count_stu` 
																   FROM `supplementary_sturs` 
																   WHERE `sup_t`='{$data_term}' and `sup_l`='{$data_stu->IDLevel}' and `sup_year`='{$data_yaer}' and `ss_id`='{$ss_id}' ;";
													$count_stuRs=new notrow_evaluation($count_stuSql);
													foreach($count_stuRs->evaluation_array as $rc_key=>$count_stuRow){
														$count_stu=$count_stuRow["count_stu"];
														if($count_stu==0){
															$count_stu;
														}else{
															$count_stu=$count_stu-1;
														}
														
													}*/												
												
												
													//*************************************************************************												
												if($ss_id==null){
													//*************************************************************************
												}else{
													/*$supplementary_subjectSql="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$count_stu}',`subject_TuesKeep`='{$count_stu}',`subject_WednesKeep`='{$count_stu}',`subject_ThursKeep`='{$count_stu}'
																			 ,`subject_FriKeep`='{$count_stu}' WHERE `ss_id`='{$ss_id}' and `ss_t`='{$data_term}' and `ss_l`='{$data_stu->IDLevel}' and `ss_year`='{$data_yaer}' and `ss_plan`='{$data_stu->rc_plan}'";
													$supplementary_subject=new insert_evaluation($supplementary_subjectSql);*/
													
													$supplementary_stursSql="DELETE FROM `supplementary_sturs` WHERE `sup_stuid`='{$user_login}' AND `sup_t` = '{$data_term}' AND `sup_l` ='{$data_stu->IDLevel}' AND `sup_year` = '{$data_yaer}'";
													$supplementary_sturs=new insert_evaluation($supplementary_stursSql);								
												}
											}
										
										?>
										
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="col-<?php echo $grid;?>-12">
													<div class="alert alert-info">
														<strong>ยกเลิกลงทะเบียนเสริมเย็นสำเร็จ</strong>
													</div>
												</div>						
											</div>
										</div>			
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
											</div>
										</div>	
<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->
	<!--**************************************************************-->
	<?php
		if($db_evaluationID=="127.0.0.1"){
			//****************************
		}else{
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ยกเลิกลงทะเบียน เสริมเรียนนอกตารางเรียน สำเร็จ".$data_yaer." / ".$data_term." IP:".$db_evaluationID;

					
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

<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->										
					<!--***************************************************************************************************-->						
							<?php   }elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="N"){//เรียนเฉราะวิชาการ ?>
										
							<?php	}elseif($call_registration->sr_academic=="N" and $call_registration->sr_activity=="Y"){//เรียนเฉราะกิจกรรม ?>
							
					<!--***************************************************************************************************-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<?php
											$supplementary_stursSql="SELECT count(`sup_stuid`) as `count_use` 
																	 FROM `supplementary_sturs` 
																	 WHERE `sup_t`='{$data_term}' 
																	 and `sup_l`='{$data_stu->IDLevel}' 
																	 and `sup_year`='{$data_yaer}'
																	 and `sup_stuid`='{$user_login}';";
											$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
											foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
												$count_use=$supplementary_stursRow["count_use"];
												if($count_use>=1){ 
													//------------------------------------------------------------------------------
												}else{
													exit("<script>window.location='../?evaluation_mod=stu_supplementary';</script>");
												}
											}
										?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																				
					<!--***************************************************************************************************-->											
										<?php
											/*$count_stuSql="SELECT count(`sup_stuid`) as `count_stu` 
														   FROM `supplementary_sturs` 
														   WHERE `sup_t`='{$data_term}' and `sup_l`='{$data_stu->IDLevel}' and `sup_year`='{$data_yaer}';";
											$count_stuRs=new notrow_evaluation($count_stuSql);
											foreach($count_stuRs->evaluation_array as $rc_key=>$count_stuRow){
												$count_stu=$count_stuRow["count_stu"];
												if($count_stu==0){
													$count_stu;
												}else{
													$count_stu=$count_stu-1;
												}
												
											}*/
											
											
											$call_stursSql="SELECT `ss_id` FROM `supplementary_sturs` 
															WHERE `sup_stuid`='{$user_login}' 
															and `sup_t`='{$data_term}'
															and `sup_l`='{$data_stu->IDLevel}'
															and `sup_year`='{$data_yaer}'";
											$call_stursRs=new row_evaluation($call_stursSql);
											
											foreach($call_stursRs->evaluation_array as $rc_key=>$call_stursRow){ ?>
					<!--///////////////////////////////////////////////////////////////////////////////////////////-->
										<?php
					//------------------------------------------------------------------------------------------------

											/*$count_stuSql="SELECT count(`sup_stuid`) as `count_stu` 
														   FROM `supplementary_sturs` 
														   WHERE `sup_t`='{$data_term}' and `sup_l`='{$data_stu->IDLevel}' and `sup_year`='{$data_yaer}' and `ss_id`='{$call_stursRow["ss_id"]}' ;";
											$count_stuRs=new notrow_evaluation($count_stuSql);
											foreach($count_stuRs->evaluation_array as $rc_key=>$count_stuRow){
												$count_stu=$count_stuRow["count_stu"];
												if($count_stu==0){
													$count_stu;
												}else{
													$count_stu=$count_stu-1;
												}
												
											}*/

					//------------------------------------------------------------------------------------------------
													/*$supplementary_subjectSql="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$count_stu}',`subject_TuesKeep`='{$count_stu}',`subject_WednesKeep`='{$count_stu}',`subject_ThursKeep`='{$count_stu}'
																			 ,`subject_FriKeep`='{$count_stu}' WHERE `ss_id`='{$call_stursRow["ss_id"]}' and `ss_t`='{$data_term}' and `ss_l`='{$data_stu->IDLevel}' and `ss_year`='{$data_yaer}' and `ss_plan`='{$data_stu->rc_plan}'";
													$supplementary_subject=new insert_evaluation($supplementary_subjectSql); */
													
													//if($supplementary_subject->system_insert=="yes"){
														$supplementary_stursSql="DELETE FROM `supplementary_sturs` WHERE `sup_stuid`='{$user_login}' AND `sup_t` = '{$data_term}' AND `sup_l` ='{$data_stu->IDLevel}' AND `sup_year` = '{$data_yaer}'";
														$supplementary_sturs=new insert_evaluation($supplementary_stursSql);										
														if($supplementary_sturs->system_insert=="yes"){ ?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="col-<?php echo $grid;?>-12">
													<div class="alert alert-info">
														<strong>ยกเลิกลงทะเบียนเสริมเย็นสำเร็จ</strong>
													</div>
												</div>						
											</div>
										</div>		
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
											</div>
										</div>	
<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->
	<!--**************************************************************-->
	<?php
		if($db_evaluationID=="127.0.0.1"){
			//****************************
		}else{
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ยกเลิกลงทะเบียน เสริมเรียนนอกตารางเรียน สำเร็จ".$data_yaer." / ".$data_term." IP:".$db_evaluationID;

					
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

<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->										
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
										<?php			}else{ ?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-warning">
													<strong>พบข้อผิดพลาด</strong>ไม่สามารถยกเลิกลงทะเบียนเรียนเสริมนอกตารางเรียนได้ 789
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
											</div>
										</div>	
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
										<?php		   }
													//}else{ ?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<!--<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-warning">
													<strong>พบข้อผิดพลาด</strong>ไม่สามารถลงทะเบียนเรียนเสริมนอกตารางเรียนได้
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
											</div>
										</div>-->	
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
										<?php	//}?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										
					<!--///////////////////////////////////////////////////////////////////////////////////////////-->							
									<?php	}  ?>

					<!--***************************************************************************************************-->		
						
										
							<?php	}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="Y"){//เรียนทั้ง วิชาการ และ กิจกรรม ?>
										
							<?php	}else{ ?>
<!--***************************************************************************************************-->	
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="alert alert-warning">
									<strong>พบข้อผิดพลาด</strong>ไม่สามารถลงทะเบียนเรียนเสริมนอกตารางเรียนได้
								</div>
							</div>
						</div>	
						
<!--***************************************************************************************************-->					
							<?php	}      ?>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
					<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
					<?php	} ?>	

				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	
<!--######################################################################################################-->		
<?php	}else{ ?>
<!--######################################################################################################-->		

				<?php
					//$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
					switch($print_runtime){
							case "ON": ?>
				<!--///////////////////////////////////////////////////////////////////////////////////////////////////////-->
							<?php
									if($data_stu->IDLevel>=31 and $data_stu->IDLevel<=33){ ?>
							
				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="panel panel-success">
													<div class="panel-heading"><center><h5>เหลือเวลาลงทะเบียนเรียน เรียนเสริมเย็น<div id="demo"></div></h5></center></div>
												</div>
											</div>
										</div><hr>				
				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<?php
											//sr_academic -> วิชาการ
											//sr_activity -> กิจกรรม
											$call_registration=new supplementary_registration($data_stu->IDLevel,$data_stu->rc_plan);
											if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){//รวมทั้งหมด ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--######################################################################################################-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<?php

							if($stu_cilk=="cilk_no"){ ?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<?php
									//sr_academic -> วิชาการ
									//sr_activity -> กิจกรรม
									$call_registration=new supplementary_registration($data_stu->IDLevel,$data_stu->rc_plan);
									if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){ //รวมทั้งหมด?>
					<!--***************************************************************************************************-->	
									
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<?php
							$supplementary_stursSql="SELECT count(`sup_stuid`) as `count_use` 
													 FROM `supplementary_sturs` 
													 WHERE `sup_t`='{$data_term}' 
													 and `sup_l`='{$data_stu->IDLevel}' 
													 and `sup_year`='{$data_yaer}'
													 and `sup_stuid`='{$user_login}';";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$count_use=$supplementary_stursRow["count_use"];
								if($count_use>=1){ 
									exit("<script>window.location='../?evaluation_mod=stu_supplementary';</script>");
								}else{
									//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
								}
							}
						?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

									<?php
											/*$count_stuSql="SELECT count(`sup_stuid`) as `count_stu` 
														   FROM `supplementary_sturs` 
														   WHERE `sup_t`='{$data_term}' and `sup_l`='{$data_stu->IDLevel}' and `sup_year`='{$data_yaer}';";
											$count_stuRs=new notrow_evaluation($count_stuSql);
											foreach($count_stuRs->evaluation_array as $rc_key=>$count_stuRow){
												$count_stu=$count_stuRow["count_stu"];
												$count_stu=$count_stu+1;
											}*/
										?>
										
										
										
										
										
										<?php
											$call_subjectSql="SELECT `ss_id`,`ss_txtth` 
															  FROM `supplementary_subject` 
															  WHERE `ss_t`='{$data_term}' 
															  and `ss_l`='{$data_stu->IDLevel}'
															  and `ss_plan`='{$data_stu->rc_plan}' 
															  and `ss_year`='{$data_yaer}'";
											$call_subjectRs=new row_evaluation($call_subjectSql);
											
											foreach($call_subjectRs->evaluation_array as $rc_key=>$call_subjectRow){
												
												$ss_id=$call_subjectRow["ss_id"];
												
												if($ss_id==null){
													//*************************************************************************
												}else{
													/*$supplementary_subjectSql="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$count_stu}',`subject_TuesKeep`='{$count_stu}',`subject_WednesKeep`='{$count_stu}',`subject_ThursKeep`='{$count_stu}'
																			 ,`subject_FriKeep`='{$count_stu}' WHERE `ss_id`='{$ss_id}' and `ss_t`='{$data_term}' and `ss_l`='{$data_stu->IDLevel}' and `ss_year`='{$data_yaer}' and `ss_plan`='{$data_stu->rc_plan}'";
													$supplementary_subject=new insert_evaluation($supplementary_subjectSql);*/
													
													$supplementary_stursSql="INSERT INTO `supplementary_sturs` (`sup_stuid`, `sup_t`, `sup_l`, `sup_year`, `ss_id`, `ss_mon`, `ss_tues`, `ss_wedne`, `ss_thurs`, `ss_fri`, `ss_satur`, `ss_sun`, `sup_datetime`) 
																			 VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$ss_id}', '1', '1', '1', '1', '1', '1', '1', '{$datetime_cr}');";
													$supplementary_sturs=new insert_evaluation($supplementary_stursSql);								
												}
											}
										
										?>
										
<!--******************************************************************************************************-->		
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<?php
												$print_subject_stu=new supplementary_sturs($user_login,$data_term,$data_stu->IDLevel,$data_yaer);
												
												foreach($print_subject_stu->array_sturs as $rc_key=>$print_subject_stuRow){
													$print_subject=$print_subject_stuRow["ss_txtth"];
													$print_subjectId=$print_subject_stuRow["ss_id"]; ?>
<!--******************************************************************************************************-->
													<div class="panel panel-success">
														<div class="alert alert-danger">
															<p><strong>รายวิชา / กิจกรรม ที่ลงทะเบียน </strong><?php echo $print_subject;?></p>		
														</div>
													</div>
<!--******************************************************************************************************-->													
											<?php	} ?>
										</div>
									</div>
<!--******************************************************************************************************-->										
										
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
											
												<?php
													$pay_supplementarySql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` FROM `supplementary_school` WHERE  `ss_id`='{$print_subjectId}' AND `ss_pay`='ALLPAY';";
													$pay_supplementaryRs=new notrow_evaluation($pay_supplementarySql);
													foreach($pay_supplementaryRs->evaluation_array as $rc_key=>$pay_supplementaryPrint){
														$supplementary_id=$pay_supplementaryPrint["supplementary_id"];
                                                        $supplementary_pay=$pay_supplementaryPrint["supplementary_pay"];
														if($supplementary_id==Null){ ?>
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->			
															<div class="row">
																<div class="col-<?php echo $grid;?>-12">
																	<div class="alert alert-danger">
																		<p><strong>ไม่พบ QRcode</strong>กรุณาติดต่อที่ห้องการเงิน</p>		
																	</div>	
																</div>
															</div>		
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->												
												<?php	}else{
                                                            $class=$data_stu->IDLevel;
                                                            $class_ex=$data_stu->Sort_name_E2;
                                                            $txt_billerId="099400043439110";
                                                            $txt_ref1=strtoupper($user_login."L".$class_ex."Y".$supplementary_id);
                                                            $txt_ref2=strtoupper("TUTOR0T".$data_term."0Y".$data_yaer);
                                                            $txt_amount=$supplementary_pay;
                                                            $txt_width="204";
                                                            $payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
                                                    ?>
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->			
															<div class="row">
                                                                <div class="col-<?php echo $grid;?>-3">
                                                                    <div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="204" height="136"></div>
                                                                    <div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
                                                                    <div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
                                                                    <div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
                                                                    <div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($supplementary_pay, 2, '.', ',');?></div>
                                                                </div>
                                                                <div class="col-<?php echo $grid;?>-9">
                                                                    <div><b>วิธีการชำระ</b></div>
                                                                    <div>1&nbsp;.&nbsp;ทำการสแกน QR Code ที่ปรากฏในเพจนี้ ด้วยแอปพลิเคชัน Mobile Banking ของท่าน</div>
                                                                    <div>2&nbsp;.&nbsp;ตรวจสอบข้อมูลที่ปรากฏใน Mobile Banking ให้ถูกต้องก่อนชำระเงิน</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบเลขประจำตัวนักเรียนให้ถูกต้อง</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ref1&nbsp;:&nbsp;เลขประจำตัวนักเรียน&nbsp;5&nbsp;หลัก &nbsp;L&nbsp;คือชั้น</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ref2&nbsp;:&nbsp;ตัวอักษรคำว่า&nbsp;"TUTOR"&nbsp;0T&nbsp;คือ&nbsp;ภาคเรียน&nbsp;0Y&nbsp;คือ&nbsp;ปีการศึกษา</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบจำนวนเงินให้ถูกต้อง</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบชื่อผู้รับเงินต้องเป็น โรงเรียนเรยีนาเชลีวิทยาลัย หรือ REGINA COELI COLLEGE SCHOOL เท่านั้น</div>
                                                                    <div>3&nbsp;.&nbsp;สำหรับหลักฐานการชำระเงินให้ท่านเก็บไว้เป็นหลักฐาน</div>
                                                                    <div>4&nbsp;.&nbsp;ทางโรงเรียนจะทำการตรวจสอบรายการและยืนยันการชำระเงินของท่าน </div>
                                                                    <div>5&nbsp;.&nbsp;การชำระเงินจะเสร็จสมบูรณ์ เมื่อทางโรงเรียนได้ตรวจสอบการชำระเงินของท่านเรียบร้อยแล้ว</div>
                                                                    <div>6&nbsp;.&nbsp;หากต้องการใบเสร็จรับเงิน ติดต่อขอรับได้ที่ห้องการเงินของโรงเรียน</div>
                                                                    <div>7&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการชำระเงิน กรณาติดต่อ ห้องการเงิน 053-282395 ต่อ 105</div>                                                                
                                                                    <div>8&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการเรียนเสริมนอกตารางเรียนกรณาติดต่อ ห้องวิชาการ 053-282395 ต่อ 121</div>                                                                
                                                                </div>
                                                            </div>
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->																								
												<?php	}
													}
												?>
                                                
                                                
											</div>
										</div><hr>
										
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="col-<?php echo $grid;?>-12">
													<div class="alert alert-info">
														<strong>ลงทะเบียนเสริมเย็นสำเร็จ</strong>
													</div>
												</div>						
											</div>
										</div>	
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
											</div>
										</div>		

<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->
	<!--**************************************************************-->
	<?php
		if($db_evaluationID=="127.0.0.1"){
			//****************************
		}else{
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ลงทะเบียน เสริมเรียนนอกตารางเรียน สำเร็จ".$data_term." / ".$data_yaer." IP:".$db_evaluationID;

					
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

<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->
										
					<!--***************************************************************************************************-->						
							<?php   }elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="N"){//เรียนเฉราะวิชาการ ?>
										
							<?php	}elseif($call_registration->sr_academic=="N" and $call_registration->sr_activity=="Y"){//เรียนเฉราะกิจกรรม ?>
										
							<?php	}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="Y"){//เรียนทั้ง วิชาการ และ กิจกรรม ?>
										
							<?php	}else{ ?>
					<!--***************************************************************************************************-->	
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="alert alert-warning">
									<strong>พบข้อผิดพลาด</strong>ไม่สามารถลงทะเบียนเรียนเสริมนอกตารางเรียนได้
								</div>
							</div>
						</div>	
					<!--***************************************************************************************************-->					
							<?php	}      ?>		
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
					<?php	}elseif($stu_cilk=="cilk_yes"){ ?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<?php
									//sr_academic -> วิชาการ
									//sr_activity -> กิจกรรม
									$call_registration=new supplementary_registration($data_stu->IDLevel,$data_stu->rc_plan);
									if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){ //รวมทั้งหมด?>
					<!--***************************************************************************************************-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<?php
											$supplementary_stursSql="SELECT count(`sup_stuid`) as `count_use` 
																	 FROM `supplementary_sturs` 
																	 WHERE `sup_t`='{$data_term}' 
																	 and `sup_l`='{$data_stu->IDLevel}' 
																	 and `sup_year`='{$data_yaer}'
																	 and `sup_stuid`='{$user_login}';";
											$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
											foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
												$count_use=$supplementary_stursRow["count_use"];
												if($count_use>=1){ 
													//------------------------------------------------------------------------------
												}else{
													exit("<script>window.location='../?evaluation_mod=stu_supplementary';</script>");
												}
											}
										?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
					<!--***************************************************************************************************-->	
										<?php
											/*$count_stuSql="SELECT count(`sup_stuid`) as `count_stu` 
														   FROM `supplementary_sturs` 
														   WHERE `sup_t`='{$data_term}' and `sup_l`='{$data_stu->IDLevel}' and `sup_year`='{$data_yaer}';";
											$count_stuRs=new notrow_evaluation($count_stuSql);
											foreach($count_stuRs->evaluation_array as $rc_key=>$count_stuRow){
												$count_stu=$count_stuRow["count_stu"];
												if($count_stu==0){
													$count_stu;
												}else{
													$count_stu=$count_stu-1;
												}
												
											}*/
										?>
										
										
										
										
										
										<?php
											$call_subjectSql="SELECT `ss_id`,`ss_txtth` 
															  FROM `supplementary_subject` 
															  WHERE `ss_t`='{$data_term}' 
															  and `ss_l`='{$data_stu->IDLevel}'
															  and `ss_plan`='{$data_stu->rc_plan}' 
															  and `ss_year`='{$data_yaer}'";
											$call_subjectRs=new row_evaluation($call_subjectSql);
											
											foreach($call_subjectRs->evaluation_array as $rc_key=>$call_subjectRow){
												
												$ss_id=$call_subjectRow["ss_id"];
												
												if($ss_id==""){
													//*************************************************************************
												}else{
													/*$supplementary_subjectSql="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$count_stu}',`subject_TuesKeep`='{$count_stu}',`subject_WednesKeep`='{$count_stu}',`subject_ThursKeep`='{$count_stu}'
																			 ,`subject_FriKeep`='{$count_stu}' WHERE `ss_id`='{$ss_id}' and `ss_t`='{$data_term}' and `ss_l`='{$data_stu->IDLevel}' and `ss_year`='{$data_yaer}' and `ss_plan`='{$data_stu->rc_plan}'";
													$supplementary_subject=new insert_evaluation($supplementary_subjectSql);*/
													
													$supplementary_stursSql="DELETE FROM `supplementary_sturs` WHERE `sup_stuid`='{$user_login}' AND `sup_t` = '{$data_term}' AND `sup_l` ='{$data_stu->IDLevel}' AND `sup_year` = '{$data_yaer}'";
													$supplementary_sturs=new insert_evaluation($supplementary_stursSql);								
												}
											}
										
										?>
										
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-info">
													<strong>ยกเลิกลงทะเบียนเสริมเย็นสำเร็จ</strong>
												</div>
											</div>						
										</div>	
										
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
											</div>
										</div>
										
<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->
	<!--**************************************************************-->
	<?php
		if($db_evaluationID=="127.0.0.1"){
			//****************************
		}else{
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ยกเลิกลงทะเบียน เสริมเรียนนอกตารางเรียน สำเร็จ".$data_yaer." / ".$data_term." IP:".$db_evaluationID;

					
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

<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->										
										
					<!--***************************************************************************************************-->						
							<?php   }elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="N"){//เรียนเฉราะวิชาการ ?>
										
							<?php	}elseif($call_registration->sr_academic=="N" and $call_registration->sr_activity=="Y"){//เรียนเฉราะกิจกรรม ?>
										
							<?php	}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="Y"){//เรียนทั้ง วิชาการ และ กิจกรรม ?>
										
							<?php	}else{ ?>
					<!--***************************************************************************************************-->	
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="alert alert-warning">
									<strong>พบข้อผิดพลาด</strong>ไม่สามารถลงทะเบียนเรียนเสริมนอกตารางเรียนได้
								</div>
							</div>
						</div>	
					<!--***************************************************************************************************-->					
							<?php	}      ?>		
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			

					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
					<?php	}else{ ?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<?php exit("<script>window.location='../?evaluation_mod=stu_supplementary';</script>");?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
					<?php	} ?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	
<!--######################################################################################################-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->												
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->												
												
									<?php	}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="N"){//เรียนเฉราะวิชาการ  ?>
				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

												<div class="row">
													<div class="col-<?php echo $grid;?>-12">
														<div class="panel panel-info">
															<div class="panel-heading">ทะเบียนเรียน เรียนเสริมเย็น</div>
															<div class="panel-body">
															
															<?php
																$not_study=filter_input(INPUT_GET,'notstudy');
																if($not_study=="notstudy"){ ?>
												<!--********************************************************************-->	
														<?php
														
													$print_notstudySql="SELECT `notstudy_stu` FROM `supplementary_notstudy`
																		WHERE `notstudy_stu`='{$user_login}' 
																		and `notstudy_t`='{$data_term}' 
																		and `notstudy_l`='{$data_stu->IDLevel}' 
																		and `notstudy_y`='{$data_yaer}' 
																		and `notstudy_p`='{$data_stu->rc_plan}'";
													$print_notstudyRs=new notrow_evaluation($print_notstudySql);
													foreach($print_notstudyRs->evaluation_array as $rc_key=>$print_notstudyRow){
														$notstudy_stu=$print_notstudyRow["notstudy_stu"];
														if($notstudy_stu==""){
														
															$supplementary_schoolSql="SELECT `supplementary_id` FROM `supplementary_school` 
																					  WHERE `supplementary_planA`='{$data_stu->rc_plan}' 
																					  and `supplementary_not`='n';";
															$supplementary_schoolRs=new notrow_evaluation($supplementary_schoolSql);
															foreach($supplementary_schoolRs->evaluation_array as $rc_key=>$supplementary_schoolRow){
																$txt_suppid=$supplementary_schoolRow["supplementary_id"];
															}
														
														
															$uts_notinto="INSERT INTO `supplementary_notstudy` (`notstudy_stu`, `notstudy_t`, `notstudy_l`, `notstudy_y`, `notstudy_p`, `notstudy_suppleid`) 
																		  VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$data_stu->rc_plan}', '{$txt_suppid}');";
															$uts_not=new insert_evaluation($uts_notinto);
															if($uts_not->system_insert=="yes"){ ?>
												<!--********************************************************************-->				
												<div class="alert alert-info">
												  <p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ระหว่างวันที่ 1 พฤศจิกายน 2563 ถึง 25 พฤศจิกายน 2563</p>
													<form name="print_supp" action="<?php echo $golink;?>print_supplementary/special/<?php echo $user_login;?>" method="post">
													
														<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
														<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
														<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
														
														<input type="hidden" value="stu_not" name="stu_not">
														
														<center><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button>
														<a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-success">กลับไปหน้าลงทะเบียน</button></a></center>
													
													</form>
												</div>				
												<!--********************************************************************-->				
												<?php		}else{ ?>				
												<!--********************************************************************-->		
												<div class="alert alert-info">
													<form name="print_supp" action="<?php echo $golink;?>print_supplementary/special/<?php echo $user_login;?>" method="post">
													
														<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
														<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
														<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
														
														<input type="hidden" value="stu_not" name="stu_not">
														
														<center><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button>
												<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน</p>		
														<!--<button type="submit" class="btn btn-success">ยืนยันการลงทะเบียน</button>-->
															<a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-success">กลับไปหน้าลงทะเบียน</button></a></center>
													
													</form>
												</div>			
												<!--********************************************************************-->				
												<?php		}	   ?>	
												<?php	}else{     ?>
												<!--********************************************************************-->		
												<div class="alert alert-info">
													<form name="print_supp" action="<?php echo $golink;?>print_supplementary/special/<?php echo $user_login;?>" method="post">
													
														<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
														<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
														<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
														
														<input type="hidden" value="stu_not" name="stu_not">
													
													<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน </p>
													
														<center><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button>
														<!--<center><button type="submit" class="btn btn-success">ยืนยันการลงทะเบียน</button></center>-->
														<a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-success">กลับไปหน้าลงทะเบียน</button></a></center>
													
													</form>
												</div>		
												<!--********************************************************************-->			
												<?php	}
														
													}	?>			
												<!--********************************************************************-->					
														<?php	}else{ ?>					
												<!--********************************************************************-->	
																<form name="supplementaryB" action="view/mod/student/code/stu_supplementary/supplementary_code.php" method="post" >
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
															<?php
																$subjectid=filter_input(INPUT_GET,'subjectid');
																$day=filter_input(INPUT_GET,'day');
																$call_clik=filter_input(INPUT_GET,'call_clik');
																$system=filter_input(INPUT_GET,'system');
																
																if($system=="system"){
																	//******************************************************************************
																}elseif($subjectid==null and $day==null){
																	exit("<script>window.location='./?evaluation_mod=stu_supplementary';</script>");
																}elseif($subjectid==null or $day==null){
																	exit("<script>window.location='./?evaluation_mod=stu_supplementary';</script>");
																}else{ ?>
																	<input type="hidden" name="subjectid" value="<?php echo $subjectid;?>">
																	<input type="hidden" name="day" value="<?php echo $day;?>">
																	<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
																	<input type="hidden" name="data_term" value="<?php echo $data_term;?>">	
																	<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
																	<input type="hidden" name="datetime" value="<?php echo $datetime;?>">
																	<input type="hidden" name="call_clik" value="cilk_flas">
																
												<!--<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถพิมพ์ ใบยืนยันการลงทะเบียน ได้ในวันจันทร์ ที่ 6 ก.ค 2563 ถึง วันพุธที่ 8 ก.ค 2563 และนำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ระหว่างวันที่ 8 ถึง 31 ก.ค 2563</p>-->					
																	
																	
																	<p><center><button type="submit" class="btn btn-default">สมัครเรียน</button></center></p>
														<?php	}      ?>		
																	</div>
																</div>
																</form>		

																<hr>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
													<?php
															if($system=="system"){ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
												<?php
													$printrc_subjectSql="SELECT `ss_mon`, `ss_tues`, `ss_wedne`, `ss_thurs`, `ss_fri`, `ss_satur`, `ss_sun` 
																		 FROM `supplementary_sturs` 
																		 WHERE `sup_stuid`='{$user_login}' 
																		 and `sup_t`='{$data_term}' 
																		 and `sup_l`='{$data_stu->IDLevel}' 
																		 and `sup_year`='{$data_yaer}'
																		 and `ss_id`='{$subjectid}'";
													$printrc_subjectRs=new row_evaluation($printrc_subjectSql);
													
													foreach($printrc_subjectRs->evaluation_array as $rc_key=>$printrc_subjectRow){
														
														$countss_mon=$printrc_subjectRow["ss_mon"];
														$countss_tues=$printrc_subjectRow["ss_tues"];
														$countss_wedne=$printrc_subjectRow["ss_wedne"];
														$countss_thurs=$printrc_subjectRow["ss_thurs"];
														$countss_fri=$printrc_subjectRow["ss_fri"];
														$countss_satur=$printrc_subjectRow["ss_satur"];
														$countss_sun=$printrc_subjectRow["ss_sun"];
														
														if($countss_mon==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_MonKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_MonKeep=$printrc_subjectkeepRow["subject_MonKeep"];
																if($subject_MonKeep==null or $subject_MonKeep==0){
																	$subject_MonKeep=0;
																}else{
																	$subject_MonKeep=$subject_MonKeep-1;												
																}
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$subject_MonKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************
														}elseif($countss_tues==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_TuesKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_TuesKeep=$printrc_subjectkeepRow["subject_TuesKeep"];
																if($subject_TuesKeep=="" or $subject_TuesKeep==0){
																	$subject_TuesKeep=0;
																}else{
																	$subject_TuesKeep=$subject_TuesKeep-1;
																}
																
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_TuesKeep`='{$subject_TuesKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************											
														}elseif($countss_wedne==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_WednesKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_WednesKeep=$printrc_subjectkeepRow["subject_WednesKeep"];
																if($subject_wedneskeep=="" or $subject_wedneskeep==0){
																	$subject_wedneskeep=0;
																}else{
																	$subject_WednesKeep=$subject_WednesKeep-1;
																}
																
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_WednesKeep`='{$subject_WednesKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************											
														}elseif($countss_thurs==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_ThursKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_ThursKeep=$printrc_subjectkeepRow["subject_ThursKeep"];
																if($subject_ThursKeep=="" or $subject_ThursKeep==0){
																	$subject_ThursKeep=0;
																}else{
																	$subject_ThursKeep=$subject_ThursKeep-1;
																}
																
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_ThursKeep`='{$subject_ThursKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************												
														}elseif($countss_fri==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_FriKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_FriKeep=$printrc_subjectkeepRow["subject_FriKeep"];
																if($subject_FriKeep=="" or $subject_FriKeep==0){
																	$subject_FriKeep=0;
																}else{
																	$subject_FriKeep=$subject_FriKeep-1;
																}
																
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_FriKeep`='{$subject_FriKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************											
														}elseif($countss_satur==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_SaturKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_SaturKeep=$printrc_subjectkeepRow["subject_SaturKeep"];
																if($subject_SaturKeep=="" or $subject_SaturKeep==0){
																	$subject_SaturKeep=0;
																}else{
																	$subject_SaturKeep=$subject_SaturKeep-1;
																}
																
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_SaturKeep`='{$subject_SaturKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************											
														}elseif($countss_sun==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_SunKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_SunKeep=$printrc_subjectkeepRow["subject_SunKeep"];
																if($subject_Sunkeep=="" or $subject_SunKeep==0){
																	$subject_Sunkeep=0;
																}else{
																	$subject_SunKeep=$subject_SunKeep-1;
																}
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_SunKeep`='{$subject_SunKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************												
														}else{
															$error=1;
														}
															if($error>=1){ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<div class="alert alert-danger">
																			<p><strong>พบข้อผิดพลาด..</strong>กรุณาทำรายการใหม่อีกครั้ง</p>		
																		</div>	
																	</div>
																</div>
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
																	</div>
																</div>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
												<?php		}else{
																$delete_stursSql="DELETE FROM `supplementary_sturs` 
																			  WHERE `sup_stuid`='{$user_login}' 
																			  and `sup_t`='{$data_term}' 
																			  and `sup_l`='{$data_stu->IDLevel}' 
																			  and `sup_year`='{$data_yaer}' 
																			  and `ss_id`='{$subjectid}'";
																$delete_sturs=new insert_evaluation($delete_stursSql);
															
																if($delete_sturs->system_insert=="yes"){ ?>  
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<div class="alert alert-danger">
																			<p><strong>ยกเลิกสำเร็จ..</strong>ยกเลิกรายวิชา สำเร็จ</p>		
																		</div>	
																	</div>
																</div>	
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
																	</div>
																</div>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
												<?php			}else{ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<div class="alert alert-danger">
																			<p><strong>ยกเลิกไม่สำเร็จ..</strong>ยกเลิกรายวิชา ไม่สำเร็จ</p>		
																		</div>	
																	</div>
																</div>
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
																	</div>
																</div>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
												<?php			}  
															}		
													}
												?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
													<?php	}else{ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
																
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<div class="table-responsive">
																			  <table class="table table-hover">
																				<thead>
																				  <tr>
																					<th>ลำดับ</th>
																					<th>เลขประจำตัวนักเรียน</th>
																					<th>ชื่อ-สกุล</th>
																				  </tr>
																				</thead>
																				<tbody>
																				  
														<?php
															if($day=="Mon"){ ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_mon`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Tues"){ ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_tues`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Wednes"){ ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_wedne`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Thurs"){  ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_thurs`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="fri"){    ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_fri`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Satur"){  ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_satur`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Sun"){    ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_sun`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}else{
																	//--------------------------------------------------------------
														} ?>						  
																				  
																				  

																				  
																				  
																				  
																				</tbody>
																			  </table>
																		</div>				
																	</div>
																</div>

								
														<?php	}      ?>
															
													
															</div>
														</div>	
													</div>
												</div>	
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
													<?php	}      ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												

												
												
												
												
												
												
												
												
												
												

				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
									<?php	}elseif($call_registration->sr_academic=="N" and $call_registration->sr_activity=="Y"){//เรียนเฉราะกิจกรรม
												
											}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="Y"){//เรียนทั้ง วิชาการ และ กิจกรรม ?>
				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

												<div class="row">
													<div class="col-<?php echo $grid;?>-12">
														<div class="panel panel-info">
															<div class="panel-heading">ทะเบียนเรียน เรียนเสริมเย็น</div>
															<div class="panel-body">
															
															<?php
																$not_study=filter_input(INPUT_GET,'notstudy');
																if($not_study=="notstudy"){ ?>
												<!--********************************************************************-->	
														<?php
														
													$print_notstudySql="SELECT `notstudy_stu` FROM `supplementary_notstudy`
																		WHERE `notstudy_stu`='{$user_login}' 
																		and `notstudy_t`='{$data_term}' 
																		and `notstudy_l`='{$data_stu->IDLevel}' 
																		and `notstudy_y`='{$data_yaer}' 
																		and `notstudy_p`='{$data_stu->rc_plan}'";
													$print_notstudyRs=new notrow_evaluation($print_notstudySql);
													foreach($print_notstudyRs->evaluation_array as $rc_key=>$print_notstudyRow){
														$notstudy_stu=$print_notstudyRow["notstudy_stu"];
														if($notstudy_stu==""){
														
															$supplementary_schoolSql="SELECT `supplementary_id` FROM `supplementary_school` 
																					  WHERE `supplementary_planA`='{$data_stu->rc_plan}' 
																					  and `supplementary_not`='n';";
															$supplementary_schoolRs=new notrow_evaluation($supplementary_schoolSql);
															foreach($supplementary_schoolRs->evaluation_array as $rc_key=>$supplementary_schoolRow){
																$txt_suppid=$supplementary_schoolRow["supplementary_id"];
															}
														
														
															$uts_notinto="INSERT INTO `supplementary_notstudy` (`notstudy_stu`, `notstudy_t`, `notstudy_l`, `notstudy_y`, `notstudy_p`, `notstudy_suppleid`) 
																		  VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$data_stu->rc_plan}', '{$txt_suppid}');";
															$uts_not=new insert_evaluation($uts_notinto);
															if($uts_not->system_insert=="yes"){ ?>
												<!--********************************************************************-->				
												<div class="alert alert-info">
												  <p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน</p>
													<form name="print_supp" action="<?php echo $golink;?>print_supplementary/special/<?php echo $user_login;?>" method="post">
													
														<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
														<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
														<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
														
														<input type="hidden" value="stu_not" name="stu_not">
														
														<center><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button>
														<a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-success">กลับไปหน้าลงทะเบียน</button></a></center>
													
													</form>
												</div>				
												<!--********************************************************************-->				
												<?php		}else{ ?>				
												<!--********************************************************************-->		
												<div class="alert alert-info">
													<form name="print_supp" action="<?php echo $golink;?>print_supplementary/special/<?php echo $user_login;?>" method="post">
													
														<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
														<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
														<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
														
														<input type="hidden" value="stu_not" name="stu_not">
														
														<center><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button>
												<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน</p>		
														<!--<button type="submit" class="btn btn-success">ยืนยันการลงทะเบียน</button>-->
															<a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-success">กลับไปหน้าลงทะเบียน</button></a></center>
													
													</form>
												</div>			
												<!--********************************************************************-->				
												<?php		}	   ?>	
												<?php	}else{     ?>
												<!--********************************************************************-->		
												<div class="alert alert-info">
													<form name="print_supp" action="<?php echo $golink;?>print_supplementary/special/<?php echo $user_login;?>" method="post">
													
														<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
														<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
														<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
														
														<input type="hidden" value="stu_not" name="stu_not">
													
													<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน </p>
													
														<center><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button>
														<!--<center><button type="submit" class="btn btn-success">ยืนยันการลงทะเบียน</button></center>-->
														<a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-success">กลับไปหน้าลงทะเบียน</button></a></center>
													
													</form>
												</div>		
												<!--********************************************************************-->			
												<?php	}
														
													}	?>			
												<!--********************************************************************-->					
														<?php	}else{ ?>					
												<!--********************************************************************-->	
																<form name="supplementaryB" action="view/mod/student/code/stu_supplementary/supplementary_code.php" method="post" >
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
															<?php
																$subjectid=filter_input(INPUT_GET,'subjectid');
																$day=filter_input(INPUT_GET,'day');
																$call_clik=filter_input(INPUT_GET,'call_clik');
																$system=filter_input(INPUT_GET,'system');
																
																if($system=="system"){
																	//******************************************************************************
																}elseif($subjectid=="" and $day==""){
																	exit("<script>window.location='./?evaluation_mod=stu_supplementary';</script>");
																}elseif($subjectid=="" or $day==""){
																	exit("<script>window.location='./?evaluation_mod=stu_supplementary';</script>");
																}else{ ?>
																	<input type="hidden" name="subjectid" value="<?php echo $subjectid;?>">
																	<input type="hidden" name="day" value="<?php echo $day;?>">
																	<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
																	<input type="hidden" name="data_term" value="<?php echo $data_term;?>">	
																	<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
																	<input type="hidden" name="datetime" value="<?php echo $datetime;?>">
																	<input type="hidden" name="call_clik" value="<?php echo $call_clik;?>">
																
												<!--<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถพิมพ์ ใบยืนยันการลงทะเบียน ได้ในวันจันทร์ ที่ 6 ก.ค 2563 ถึง วันพุธที่ 8 ก.ค 2563 และนำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ระหว่างวันที่ 8 ถึง 31 ก.ค 2563</p>-->					
																	
														<?php
																if($subjectid=="activity" and $day=="All"){ ?>
																
														<?php	}else{ ?>
																	<p><center><button type="submit" class="btn btn-default">สมัครเรียน</button></center></p>
														<?php	}?>			
																	
																	
																	
																	
														<?php	}      ?>		
																	</div>
																</div>
																</form>		

																<hr>
												<?php
														if($system=="system"){ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
												<?php
													$printrc_subjectSql="SELECT `ss_mon`, `ss_tues`, `ss_wedne`, `ss_thurs`, `ss_fri`, `ss_satur`, `ss_sun` 
																		 FROM `supplementary_sturs` 
																		 WHERE `sup_stuid`='{$user_login}' 
																		 and `sup_t`='{$data_term}' 
																		 and `sup_l`='{$data_stu->IDLevel}' 
																		 and `sup_year`='{$data_yaer}'
																		 and `ss_id`='{$subjectid}'";
													$printrc_subjectRs=new row_evaluation($printrc_subjectSql);
													
													foreach($printrc_subjectRs->evaluation_array as $rc_key=>$printrc_subjectRow){
														
														$countss_mon=$printrc_subjectRow["ss_mon"];
														$countss_tues=$printrc_subjectRow["ss_tues"];
														$countss_wedne=$printrc_subjectRow["ss_wedne"];
														$countss_thurs=$printrc_subjectRow["ss_thurs"];
														$countss_fri=$printrc_subjectRow["ss_fri"];
														$countss_satur=$printrc_subjectRow["ss_satur"];
														$countss_sun=$printrc_subjectRow["ss_sun"];
														
														if($countss_mon==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_MonKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_MonKeep=$printrc_subjectkeepRow["subject_MonKeep"];
																if($subject_MonKeep=="" or $subject_MonKeep==0){
																	$subject_MonKeep=0;
																}else{
																	$subject_MonKeep=$subject_MonKeep-1;
																}
																
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$subject_MonKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************
														}if($countss_tues==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_TuesKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_TuesKeep=$printrc_subjectkeepRow["subject_TuesKeep"];
																
																
																if($subject_TuesKeep==null or $subject_TuesKeep==0){
																	$subject_TuesKeep=0;
																}else{
																	$subject_TuesKeep=$subject_TuesKeep-1;
																}
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_TuesKeep`='{$subject_TuesKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************											
														}if($countss_wedne==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_WednesKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_WednesKeep=$printrc_subjectkeepRow["subject_WednesKeep"];
																
																if($subject_WednesKeep==null or $subject_WednesKeep==0){
																	$subject_WednesKeep=0;
																}else{
																	$subject_WednesKeep=$subject_WednesKeep-1;
																}
																
																
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_WednesKeep`='{$subject_WednesKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************											
														}if($countss_thurs==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_ThursKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_ThursKeep=$printrc_subjectkeepRow["subject_ThursKeep"];
																
																if($subject_ThursKeep==null or $subject_ThursKeep==0){
																	$subject_ThursKeep=0;
																}else{
																	$subject_ThursKeep=$subject_ThursKeep-1;
																}
																
																
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_ThursKeep`='{$subject_ThursKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************												
														}if($countss_fri==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_FriKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_FriKeep=$printrc_subjectkeepRow["subject_FriKeep"];
																
																if($subject_FriKeep==null or $subject_FriKeep==0){
																	$subject_FriKeep=0;
																}else{
																	$subject_FriKeep=$subject_FriKeep-1;
																}
																
																
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_FriKeep`='{$subject_FriKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************											
														}if($countss_satur==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_SaturKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_SaturKeep=$printrc_subjectkeepRow["subject_SaturKeep"];
																
																if($subject_SaturKeep==null or $subject_SaturKeep==0){
																	$subject_SaturKeep=0;
																}else{
																	$subject_SaturKeep=$subject_SaturKeep-1;
																}												
																
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_SaturKeep`='{$subject_SaturKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************											
														}if($countss_sun==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_SunKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_SunKeep=$printrc_subjectkeepRow["subject_SunKeep"];
																
																if($subject_SunKeep==null or $subject_SunKeep==0){
																	$subject_SunKeep=0;
																}else{
																	$subject_SunKeep=$subject_SunKeep-1;
																}													
																
																
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_SunKeep`='{$subject_SunKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************
														}
														
//------------------------------------------------------------------------------------------------------------------------------------------------------
																$error=0;
//------------------------------------------------------------------------------------------------------------------------------------------------------
	
															if($error>=1){ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<div class="alert alert-danger">
																			<p><strong>พบข้อผิดพลาด..</strong>กรุณาทำรายการใหม่อีกครั้ง</p>		
																		</div>	
																	</div>
																</div>
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
																	</div>
																</div>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
												<?php		}else{
																$delete_stursSql="DELETE FROM `supplementary_sturs` 
																			  WHERE `sup_stuid`='{$user_login}' 
																			  and `sup_t`='{$data_term}' 
																			  and `sup_l`='{$data_stu->IDLevel}' 
																			  and `sup_year`='{$data_yaer}' 
																			  and `ss_id`='{$subjectid}'";
																$delete_sturs=new insert_evaluation($delete_stursSql);
															
																if($delete_sturs->system_insert=="yes"){ ?>  
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<div class="alert alert-danger">
																			<p><strong>ยกเลิกสำเร็จ..</strong>ยกเลิกรายวิชา สำเร็จ</p>		
																		</div>	
																	</div>
																</div>	
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
																	</div>
																</div>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
												<?php			}else{ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<div class="alert alert-danger">
																			<p><strong>ยกเลิกไม่สำเร็จ..</strong>ยกเลิกรายวิชา ไม่สำเร็จ</p>		
																		</div>	
																	</div>
																</div>
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
																	</div>
																</div>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
												<?php			}  
															}		
													}
												?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
												<?php	}elseif($subjectid!="activity" and $day!="All"){ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->


				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
																
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<div class="table-responsive">
																			  <table class="table table-hover">
																				<thead>
																				  <tr>
																					<th>ลำดับ</th>
																					<th>เลขประจำตัวนักเรียน</th>
																					<th>ชื่อ-สกุล</th>
																				  </tr>
																				</thead>
																				<tbody>
																				  
														<?php
															if($day=="Mon"){ ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_mon`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Tues"){ ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_tues`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Wednes"){ ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_wedne`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Thurs"){  ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_thurs`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="fri"){    ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_fri`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Satur"){  ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_satur`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Sun"){    ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_sun`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}else{
																	//--------------------------------------------------------------
														} ?>						  
																				  
																				  

																				  
																				  
																				  
																				</tbody>
																			  </table>
																		</div>				
																	</div>
																</div>

																
												<!--********************************************************************-->	
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
												<?php	}elseif($subjectid=="activity" and $day=="All"){?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
													
													
													
													
													
													<form name="activity_rc" action="view/mod/student/code/stu_supplementary/supplementary_code.php" method="post" >
													
													
														<div class="row">
															<div class="col-<?php echo $grid;?>-6">
															
																<fieldset class="content-group">
																	<div class="form-group">
																		<label class="control-label col-<?php echo $grid;?>-5">เลือกกิจกรรมตามความถนัดและสนใจ</label>
																		<div class="col-<?php echo $grid;?>-7">
																			<select  name="copy_ss_id" id="copy_ss_id" required="required" class="select-size-<?php echo $grid;?>" data-placeholder="เลือกกิจกรรมตามความถนัดและสนใจ...">
																				<option></option>
																				<optgroup label="กิจกรรมตามความถนัดและสนใจ พร้อมกับ เสริมทักษะด้านวิชาการ">
																				
																	<?php
																		$supplementary_subjectSql="SELECT `ss_id`,`ss_txtth` 
																								   FROM `supplementary_subject` 
																								   WHERE `ss_t`='{$data_term}' 
																								   and `ss_l`='{$data_stu->IDLevel}' 
																								   and `ss_year`='{$data_yaer}' 
																								   and `ss_plan`='2'
																								   and `ss_academic`='0';";
																		$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
																		
																		foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){ ?>										
																					<option value="<?php echo $supplementary_subjectRow["ss_id"];?>"><?php echo $supplementary_subjectRow["ss_txtth"];?></option>
																<?php	} ?>

																				</optgroup>
																			</select>
																		</div>
																	</div>
																</fieldset>											
															
															</div>
															<div class="col-<?php echo $grid;?>-6">
																<center><button type="submit" name="stu_cilk" value="cilk_no" class="btn btn-success">ลงทะเบียน</button></center>
															</div>
														
																	<input type="hidden" name="subjectid" value="activity">
																	<input type="hidden" name="day" value="All">
																	<input type="hidden" id="data_yaer" name="data_yaer" value="<?php echo $data_yaer;?>">
																	<input type="hidden" id="data_term" name="data_term" value="<?php echo $data_term;?>">	
																	<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
																	<input type="hidden" name="datetime" value="<?php echo $datetime;?>">
																	<input type="hidden" name="call_clik" value="<?php echo $call_clik;?>">
														</div>			
													</form>
													
														<div id="show_data"></div>
													
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
												<?php	}else{ 
															
														} ?>				
														<?php	}      ?>
															
													
															</div>
														</div>	
													</div>
												</div>	

				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
									<?php	}else{ ?>
							<!--***************************************************************************************************-->	
								<div class="row">
									<div class="col-<?php echo $grid;?>-12">
									
									
									</div>
								</div>				
							<!--***************************************************************************************************-->					
									<?php	}      ?>
				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
							<?php	}elseif($data_stu->IDLevel>=41 and $data_stu->IDLevel<=43){
								
								
									if($data_stu->rc_plan==13){
										$copy_plan=$data_stu->rc_plan;
									}else{
										$copy_plan=14;
									}

							?>
				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	




				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	


										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="panel panel-success">
													<div class="panel-heading"><center><h5>เหลือเวลาลงทะเบียนเรียน เรียนเสริมเย็น<div id="demo"></div></h5></center></div>
												</div>
											</div>
										</div><hr>				
				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<?php
											//sr_academic -> วิชาการ
											//sr_activity -> กิจกรรม
											$call_registration=new supplementary_registration($data_stu->IDLevel,$copy_plan);
											if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){//รวมทั้งหมด ?>
												
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--######################################################################################################-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<?php

							if($stu_cilk=="cilk_no"){ ?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<?php
									//sr_academic -> วิชาการ
									//sr_activity -> กิจกรรม
									$call_registration=new supplementary_registration($data_stu->IDLevel,$data_stu->rc_plan);
									if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){ //รวมทั้งหมด?>
					<!--***************************************************************************************************-->	
									
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<?php
							$supplementary_stursSql="SELECT count(`sup_stuid`) as `count_use` 
													 FROM `supplementary_sturs` 
													 WHERE `sup_t`='{$data_term}' 
													 and `sup_l`='{$data_stu->IDLevel}' 
													 and `sup_year`='{$data_yaer}'
													 and `sup_stuid`='{$user_login}';";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$count_use=$supplementary_stursRow["count_use"];
								if($count_use>=1){ 
									exit("<script>window.location='../?evaluation_mod=stu_supplementary';</script>");
								}else{
									//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
								}
							}
						?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

									<?php
											/*$count_stuSql="SELECT count(`sup_stuid`) as `count_stu` 
														   FROM `supplementary_sturs` 
														   WHERE `sup_t`='{$data_term}' and `sup_l`='{$data_stu->IDLevel}' and `sup_year`='{$data_yaer}';";
											$count_stuRs=new notrow_evaluation($count_stuSql);
											foreach($count_stuRs->evaluation_array as $rc_key=>$count_stuRow){
												$count_stu=$count_stuRow["count_stu"];
												$count_stu=$count_stu+1;
											}*/
										?>
										
										
										
										
										
										<?php
											$call_subjectSql="SELECT `ss_id`,`ss_txtth` 
															  FROM `supplementary_subject` 
															  WHERE `ss_t`='{$data_term}' 
															  and `ss_l`='{$data_stu->IDLevel}'
															  and `ss_plan`='{$data_stu->rc_plan}' 
															  and `ss_year`='{$data_yaer}'";
											$call_subjectRs=new row_evaluation($call_subjectSql);
											
											foreach($call_subjectRs->evaluation_array as $rc_key=>$call_subjectRow){
												
												$ss_id=$call_subjectRow["ss_id"];
												
												if($ss_id==null){
													//*************************************************************************
												}else{
													/*$supplementary_subjectSql="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$count_stu}',`subject_TuesKeep`='{$count_stu}',`subject_WednesKeep`='{$count_stu}',`subject_ThursKeep`='{$count_stu}'
																			 ,`subject_FriKeep`='{$count_stu}' WHERE `ss_id`='{$ss_id}' and `ss_t`='{$data_term}' and `ss_l`='{$data_stu->IDLevel}' and `ss_year`='{$data_yaer}' and `ss_plan`='{$data_stu->rc_plan}'";
													$supplementary_subject=new insert_evaluation($supplementary_subjectSql);*/
													
													$supplementary_stursSql="INSERT INTO `supplementary_sturs` (`sup_stuid`, `sup_t`, `sup_l`, `sup_year`, `ss_id`, `ss_mon`, `ss_tues`, `ss_wedne`, `ss_thurs`, `ss_fri`, `ss_satur`, `ss_sun`, `sup_datetime`) 
																			 VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$ss_id}', '1', '1', '1', '1', '1', '1', '1', '{$datetime_cr}');";
													$supplementary_sturs=new insert_evaluation($supplementary_stursSql);								
												}
											}
										
										?>
										
<!--******************************************************************************************************-->		
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<?php
												$print_subject_stu=new supplementary_sturs($user_login,$data_term,$data_stu->IDLevel,$data_yaer);
												
												foreach($print_subject_stu->array_sturs as $rc_key=>$print_subject_stuRow){
													$print_subject=$print_subject_stuRow["ss_txtth"];
													$print_subjectId=$print_subject_stuRow["ss_id"]; ?>
<!--******************************************************************************************************-->
													<div class="panel panel-success">
														<div class="alert alert-danger">
															<p><strong>รายวิชา / กิจกรรม ที่ลงทะเบียน </strong><?php echo $print_subject;?></p>		
														</div>
													</div>
<!--******************************************************************************************************-->													
											<?php	} ?>
										</div>
									</div>
<!--******************************************************************************************************-->										
										
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
											
												<?php
													$pay_supplementarySql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` FROM `supplementary_school` WHERE  `ss_id`='{$print_subjectId}' AND `ss_pay`='ALLPAY';";
													$pay_supplementaryRs=new notrow_evaluation($pay_supplementarySql);
													foreach($pay_supplementaryRs->evaluation_array as $rc_key=>$pay_supplementaryPrint){
														$supplementary_id=$pay_supplementaryPrint["supplementary_id"];
                                                        $supplementary_pay=$pay_supplementaryPrint["supplementary_pay"];
														if($supplementary_id==Null){ ?>
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->			
															<div class="row">
																<div class="col-<?php echo $grid;?>-12">
																	<div class="alert alert-danger">
																		<p><strong>ไม่พบ QRcode</strong>กรุณาติดต่อที่ห้องการเงิน</p>		
																	</div>	
																</div>
															</div>		
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->												
												<?php	}else{
                                                            $class=$data_stu->IDLevel;
                                                            $class_ex=$data_stu->Sort_name_E2;
                                                            $txt_billerId="099400043439110";
                                                            $txt_ref1=strtoupper($user_login."L".$class_ex."Y".$supplementary_id);
                                                            $txt_ref2=strtoupper("TUTOR0T".$data_term."0Y".$data_yaer);
                                                            $txt_amount=$supplementary_pay;
                                                            $txt_width="204";
                                                            $payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
                                                    ?>
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->			
															<div class="row">
                                                                <div class="col-<?php echo $grid;?>-3">
                                                                    <div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="204" height="136"></div>
                                                                    <div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
                                                                    <div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
                                                                    <div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
                                                                    <div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($supplementary_pay, 2, '.', ',');?></div>
                                                                </div>
                                                                <div class="col-<?php echo $grid;?>-9">
                                                                    <div><b>วิธีการชำระ</b></div>
                                                                    <div>1&nbsp;.&nbsp;ทำการสแกน QR Code ที่ปรากฏในเพจนี้ ด้วยแอปพลิเคชัน Mobile Banking ของท่าน</div>
                                                                    <div>2&nbsp;.&nbsp;ตรวจสอบข้อมูลที่ปรากฏใน Mobile Banking ให้ถูกต้องก่อนชำระเงิน</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบเลขประจำตัวนักเรียนให้ถูกต้อง</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ref1&nbsp;:&nbsp;เลขประจำตัวนักเรียน&nbsp;5&nbsp;หลัก &nbsp;L&nbsp;คือชั้น</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ref2&nbsp;:&nbsp;ตัวอักษรคำว่า&nbsp;"TUTOR"&nbsp;0T&nbsp;คือ&nbsp;ภาคเรียน&nbsp;0Y&nbsp;คือ&nbsp;ปีการศึกษา</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบจำนวนเงินให้ถูกต้อง</div>
                                                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบชื่อผู้รับเงินต้องเป็น โรงเรียนเรยีนาเชลีวิทยาลัย หรือ REGINA COELI COLLEGE SCHOOL เท่านั้น</div>
                                                                    <div>3&nbsp;.&nbsp;สำหรับหลักฐานการชำระเงินให้ท่านเก็บไว้เป็นหลักฐาน</div>
                                                                    <div>4&nbsp;.&nbsp;ทางโรงเรียนจะทำการตรวจสอบรายการและยืนยันการชำระเงินของท่าน </div>
                                                                    <div>5&nbsp;.&nbsp;การชำระเงินจะเสร็จสมบูรณ์ เมื่อทางโรงเรียนได้ตรวจสอบการชำระเงินของท่านเรียบร้อยแล้ว</div>
                                                                    <div>6&nbsp;.&nbsp;หากต้องการใบเสร็จรับเงิน ติดต่อขอรับได้ที่ห้องการเงินของโรงเรียน</div>
                                                                    <div>7&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการชำระเงิน กรณาติดต่อ ห้องการเงิน 053-282395 ต่อ 105</div>                                                                
                                                                    <div>8&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการเรียนเสริมนอกตารางเรียนกรณาติดต่อ ห้องวิชาการ 053-282395 ต่อ 121</div>                                                                
                                                                </div>
                                                            </div>
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->																								
												<?php	}
													}
												?>
                                                
                                                
											</div>
										</div><hr>
										
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="col-<?php echo $grid;?>-12">
													<div class="alert alert-info">
														<strong>ลงทะเบียนเสริมเย็นสำเร็จ</strong>
													</div>
												</div>						
											</div>
										</div>	
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
											</div>
										</div>		

<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->
	<!--**************************************************************-->
	<?php
		if($db_evaluationID=="127.0.0.1"){
			//****************************
		}else{
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ลงทะเบียน เสริมเรียนนอกตารางเรียน สำเร็จ".$data_term." / ".$data_yaer." IP:".$db_evaluationID;

					
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

<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->
										
					<!--***************************************************************************************************-->						
							<?php   }elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="N"){//เรียนเฉราะวิชาการ ?>
										
							<?php	}elseif($call_registration->sr_academic=="N" and $call_registration->sr_activity=="Y"){//เรียนเฉราะกิจกรรม ?>
										
							<?php	}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="Y"){//เรียนทั้ง วิชาการ และ กิจกรรม ?>
										
							<?php	}else{ ?>
					<!--***************************************************************************************************-->	
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="alert alert-warning">
									<strong>พบข้อผิดพลาด</strong>ไม่สามารถลงทะเบียนเรียนเสริมนอกตารางเรียนได้
								</div>
							</div>
						</div>	
					<!--***************************************************************************************************-->					
							<?php	}      ?>		
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
					<?php	}elseif($stu_cilk=="cilk_yes"){ ?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<?php
									//sr_academic -> วิชาการ
									//sr_activity -> กิจกรรม
									$call_registration=new supplementary_registration($data_stu->IDLevel,$data_stu->rc_plan);
									if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){ //รวมทั้งหมด?>
					<!--***************************************************************************************************-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<?php
											$supplementary_stursSql="SELECT count(`sup_stuid`) as `count_use` 
																	 FROM `supplementary_sturs` 
																	 WHERE `sup_t`='{$data_term}' 
																	 and `sup_l`='{$data_stu->IDLevel}' 
																	 and `sup_year`='{$data_yaer}'
																	 and `sup_stuid`='{$user_login}';";
											$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
											foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
												$count_use=$supplementary_stursRow["count_use"];
												if($count_use>=1){ 
													//------------------------------------------------------------------------------
												}else{
													exit("<script>window.location='../?evaluation_mod=stu_supplementary';</script>");
												}
											}
										?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++Go home++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
					<!--***************************************************************************************************-->	
										<?php
											/*$count_stuSql="SELECT count(`sup_stuid`) as `count_stu` 
														   FROM `supplementary_sturs` 
														   WHERE `sup_t`='{$data_term}' and `sup_l`='{$data_stu->IDLevel}' and `sup_year`='{$data_yaer}';";
											$count_stuRs=new notrow_evaluation($count_stuSql);
											foreach($count_stuRs->evaluation_array as $rc_key=>$count_stuRow){
												$count_stu=$count_stuRow["count_stu"];
												if($count_stu==0){
													$count_stu;
												}else{
													$count_stu=$count_stu-1;
												}
												
											}*/
										?>
										
										
										
										
										
										<?php
											$call_subjectSql="SELECT `ss_id`,`ss_txtth` 
															  FROM `supplementary_subject` 
															  WHERE `ss_t`='{$data_term}' 
															  and `ss_l`='{$data_stu->IDLevel}'
															  and `ss_plan`='{$data_stu->rc_plan}' 
															  and `ss_year`='{$data_yaer}'";
											$call_subjectRs=new row_evaluation($call_subjectSql);
											
											foreach($call_subjectRs->evaluation_array as $rc_key=>$call_subjectRow){
												
												$ss_id=$call_subjectRow["ss_id"];
												
												if($ss_id==""){
													//*************************************************************************
												}else{
													/*$supplementary_subjectSql="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$count_stu}',`subject_TuesKeep`='{$count_stu}',`subject_WednesKeep`='{$count_stu}',`subject_ThursKeep`='{$count_stu}'
																			 ,`subject_FriKeep`='{$count_stu}' WHERE `ss_id`='{$ss_id}' and `ss_t`='{$data_term}' and `ss_l`='{$data_stu->IDLevel}' and `ss_year`='{$data_yaer}' and `ss_plan`='{$data_stu->rc_plan}'";
													$supplementary_subject=new insert_evaluation($supplementary_subjectSql);*/
													
													$supplementary_stursSql="DELETE FROM `supplementary_sturs` WHERE `sup_stuid`='{$user_login}' AND `sup_t` = '{$data_term}' AND `sup_l` ='{$data_stu->IDLevel}' AND `sup_year` = '{$data_yaer}'";
													$supplementary_sturs=new insert_evaluation($supplementary_stursSql);								
												}
											}
										
										?>
										
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-info">
													<strong>ยกเลิกลงทะเบียนเสริมเย็นสำเร็จ</strong>
												</div>
											</div>						
										</div>	
										
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
											</div>
										</div>
										
<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->
	<!--**************************************************************-->
	<?php
		if($db_evaluationID=="127.0.0.1"){
			//****************************
		}else{
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ยกเลิกลงทะเบียน เสริมเรียนนอกตารางเรียน สำเร็จ".$data_yaer." / ".$data_term." IP:".$db_evaluationID;

					
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

<!--*********----------***********----------*********----------***********----------*********----------***********----------*********-->										
										
					<!--***************************************************************************************************-->						
							<?php   }elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="N"){//เรียนเฉราะวิชาการ ?>
										
							<?php	}elseif($call_registration->sr_academic=="N" and $call_registration->sr_activity=="Y"){//เรียนเฉราะกิจกรรม ?>
										
							<?php	}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="Y"){//เรียนทั้ง วิชาการ และ กิจกรรม ?>
										
							<?php	}else{ ?>
					<!--***************************************************************************************************-->	
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="alert alert-warning">
									<strong>พบข้อผิดพลาด</strong>ไม่สามารถลงทะเบียนเรียนเสริมนอกตารางเรียนได้
								</div>
							</div>
						</div>	
					<!--***************************************************************************************************-->					
							<?php	}      ?>		
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			

					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
					<?php	}else{ ?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<?php exit("<script>window.location='../?evaluation_mod=stu_supplementary';</script>");?>
					<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
					<?php	} ?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	
<!--######################################################################################################-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->												
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->											
												
									 <?php }elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="N"){//เรียนเฉราะวิชาการ  ?>
				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

												<div class="row">
													<div class="col-<?php echo $grid;?>-12">
														<div class="panel panel-info">
															<div class="panel-heading">ทะเบียนเรียน เรียนเสริมเย็น</div>
															<div class="panel-body">
															
															<?php
																$not_study=filter_input(INPUT_GET,'notstudy');
																if($not_study=="notstudy"){ ?>
												<!--********************************************************************-->	
														<?php
														
													$print_notstudySql="SELECT `notstudy_stu` FROM `supplementary_notstudy`
																		WHERE `notstudy_stu`='{$user_login}' 
																		and `notstudy_t`='{$data_term}' 
																		and `notstudy_l`='{$data_stu->IDLevel}' 
																		and `notstudy_y`='{$data_yaer}' 
																		and `notstudy_p`='{$data_stu->rc_plan}'";
													$print_notstudyRs=new notrow_evaluation($print_notstudySql);
													foreach($print_notstudyRs->evaluation_array as $rc_key=>$print_notstudyRow){
														$notstudy_stu=$print_notstudyRow["notstudy_stu"];
														if($notstudy_stu==null){
														
															$supplementary_schoolSql="SELECT `supplementary_id` FROM `supplementary_school` 
																					  WHERE `supplementary_planA`='{$data_stu->rc_plan}' 
																					  and `supplementary_not`='n';";
															$supplementary_schoolRs=new notrow_evaluation($supplementary_schoolSql);
															foreach($supplementary_schoolRs->evaluation_array as $rc_key=>$supplementary_schoolRow){
																$txt_suppid=$supplementary_schoolRow["supplementary_id"];
															}
														
														
															$uts_notinto="INSERT INTO `supplementary_notstudy` (`notstudy_stu`, `notstudy_t`, `notstudy_l`, `notstudy_y`, `notstudy_p`, `notstudy_suppleid`) 
																		  VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$data_stu->rc_plan}', '{$txt_suppid}');";
															$uts_not=new insert_evaluation($uts_notinto);
															if($uts_not->system_insert=="yes"){ ?>
												<!--********************************************************************-->				
												<div class="alert alert-info">
												  <p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน</p>
													<form name="print_supp" action="<?php echo $golink;?>print_supplementary/special/<?php echo $user_login;?>" method="post">
													
														<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
														<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
														<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
														
														<input type="hidden" value="stu_not" name="stu_not">
														
														<center><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button>
														<a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-success">กลับไปหน้าลงทะเบียน</button></a></center>
													
													</form>
												</div>				
												<!--********************************************************************-->				
												<?php		}else{ ?>				
												<!--********************************************************************-->		
												<div class="alert alert-info">
													<form name="print_supp" action="<?php echo $golink;?>print_supplementary/special/<?php echo $user_login;?>" method="post">
													
														<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
														<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
														<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
														
														<input type="hidden" value="stu_not" name="stu_not">
														
														<center><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button>
												<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน </p>		
														<!--<button type="submit" class="btn btn-success">ยืนยันการลงทะเบียน</button>-->
															<a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-success">กลับไปหน้าลงทะเบียน</button></a></center>
													
													</form>
												</div>			
												<!--********************************************************************-->				
												<?php		}	   ?>	
												<?php	}else{     ?>
												<!--********************************************************************-->		
												<div class="alert alert-info">
													<form name="print_supp" action="<?php echo $golink;?>print_supplementary/special/<?php echo $user_login;?>" method="post">
													
														<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
														<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
														<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
														
														<input type="hidden" value="stu_not" name="stu_not">
													
													<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน</p>
													
														<center><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button>
														<!--<center><button type="submit" class="btn btn-success">ยืนยันการลงทะเบียน</button></center>-->
														<a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-success">กลับไปหน้าลงทะเบียน</button></a></center>
													
													</form>
												</div>		
												<!--********************************************************************-->			
												<?php	}
														
													}	?>			
												<!--********************************************************************-->					
														<?php	}else{ ?>					
												<!--********************************************************************-->	
																<form name="supplementaryB" action="view/mod/student/code/stu_supplementary/supplementary_code.php" method="post" >
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
															<?php
																$subjectid=filter_input(INPUT_GET,'subjectid');
																$day=filter_input(INPUT_GET,'day');
																$call_clik=filter_input(INPUT_GET,'call_clik');
																
																$system=filter_input(INPUT_GET,'system');
																
																if($system=="system"){
																	//*****************************************************************************
																}elseif($subjectid=="" and $day==""){
																	exit("<script>window.location='./?evaluation_mod=stu_supplementary';</script>");
																}elseif($subjectid=="" or $day==""){
																	exit("<script>window.location='./?evaluation_mod=stu_supplementary';</script>");
																}else{ ?>
																	<input type="hidden" name="subjectid" value="<?php echo $subjectid;?>">
																	<input type="hidden" name="day" value="<?php echo $day;?>">
																	<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
																	<input type="hidden" name="data_term" value="<?php echo $data_term;?>">	
																	<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
																	<input type="hidden" name="datetime" value="<?php echo $datetime;?>">
																	<input type="hidden" name="call_clik" value="cilk_flas">
																
												<!--<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถพิมพ์ ใบยืนยันการลงทะเบียน ได้ในวันจันทร์ ที่ 6 ก.ค 2563 ถึง วันพุธที่ 8 ก.ค 2563 และนำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ระหว่างวันที่ 8 ถึง 31 ก.ค 2563</p>-->					
																	
																	
																	<p><center><button type="submit" class="btn btn-default">สมัครเรียน</button></center></p>
														<?php	}      ?>		
																	</div>
																</div>
																</form>		

																<hr>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
													<?php   if($system=="system"){ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
												<?php
													$printrc_subjectSql="SELECT `ss_mon`, `ss_tues`, `ss_wedne`, `ss_thurs`, `ss_fri`, `ss_satur`, `ss_sun` 
																		 FROM `supplementary_sturs` 
																		 WHERE `sup_stuid`='{$user_login}' 
																		 and `sup_t`='{$data_term}' 
																		 and `sup_l`='{$data_stu->IDLevel}' 
																		 and `sup_year`='{$data_yaer}'
																		 and `ss_id`='{$subjectid}'";
													$printrc_subjectRs=new row_evaluation($printrc_subjectSql);
													
													foreach($printrc_subjectRs->evaluation_array as $rc_key=>$printrc_subjectRow){
														
														$countss_mon=$printrc_subjectRow["ss_mon"];
														$countss_tues=$printrc_subjectRow["ss_tues"];
														$countss_wedne=$printrc_subjectRow["ss_wedne"];
														$countss_thurs=$printrc_subjectRow["ss_thurs"];
														$countss_fri=$printrc_subjectRow["ss_fri"];
														$countss_satur=$printrc_subjectRow["ss_satur"];
														$countss_sun=$printrc_subjectRow["ss_sun"];
														
														if($countss_mon==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_MonKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_MonKeep=$printrc_subjectkeepRow["subject_MonKeep"];
																
																if($subject_MonKeep=="" or $subject_MonKeep==0){
																	$subject_MonKeep=0;
																}else{
																	$subject_MonKeep=$subject_MonKeep-1;
																}
																
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$subject_MonKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************
														}elseif($countss_tues==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_TuesKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_TuesKeep=$printrc_subjectkeepRow["subject_TuesKeep"];
																
																if($subject_TuesKeep==null or $subject_TuesKeep==0){
																	$subject_TuesKeep=0;
																}else{
																	$subject_TuesKeep=$subject_TuesKeep-1;
																}
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_TuesKeep`='{$subject_TuesKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************											
														}elseif($countss_wedne==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_WednesKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_WednesKeep=$printrc_subjectkeepRow["subject_WednesKeep"];
																
																if($subject_WednesKeep=="" or $subject_WednesKeep==0){
																	$subject_WednesKeep=0;
																}else{
																	$subject_WednesKeep=$subject_WednesKeep-1;
																}
																
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_WednesKeep`='{$subject_WednesKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************											
														}elseif($countss_thurs==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_ThursKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_ThursKeep=$printrc_subjectkeepRow["subject_ThursKeep"];
																
																if($subject_ThursKeep=="" or $subject_ThursKeep==0){
																	$subject_ThursKeep=0;
																}else{
																	$subject_ThursKeep=$subject_ThursKeep-1;
																}

															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_ThursKeep`='{$subject_ThursKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************												
														}elseif($countss_fri==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_FriKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_FriKeep=$printrc_subjectkeepRow["subject_FriKeep"];
																
																if($subject_FriKeep=="" or $subject_FriKeep==0){
																	$subject_FriKeep=0;
																}else{
																	$subject_FriKeep=$subject_FriKeep-1;
																}
																
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_FriKeep`='{$subject_FriKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************											
														}elseif($countss_satur==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_SaturKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_SaturKeep=$printrc_subjectkeepRow["subject_SaturKeep"];
																
																if($subject_SaturKeep=="" or $subject_SaturKeep==0){
																	$subject_SaturKeep=0;
																}else{
																	$subject_SaturKeep=$subject_SaturKeep-1;
																}
															
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_SaturKeep`='{$subject_SaturKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************											
														}elseif($countss_sun==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_SunKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_SunKeep=$printrc_subjectkeepRow["subject_SunKeep"];
																
																if($subject_SunKeep=="" or $subject_SunKeep==0){
																	$subject_SunKeep=0;
																}else{
																	$subject_SunKeep=$subject_SunKeep-1;
																}

															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_SunKeep`='{$subject_SunKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************												
														}else{
															$error=1;
														}
//-------------------------------------------------------------------------------------------		
																if(isset($error)){
																	//-----------------------
																}else{
																	$error=0;
																}
//-------------------------------------------------------------------------------------------														
															if($error>=1){ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<div class="alert alert-danger">
																			<p><strong>พบข้อผิดพลาด..</strong>กรุณาทำรายการใหม่อีกครั้ง</p>		
																		</div>	
																	</div>
																</div>
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
																	</div>
																</div>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
												<?php		}else{
																$delete_stursSql="DELETE FROM `supplementary_sturs` 
																			  WHERE `sup_stuid`='{$user_login}' 
																			  and `sup_t`='{$data_term}' 
																			  and `sup_l`='{$data_stu->IDLevel}' 
																			  and `sup_year`='{$data_yaer}' 
																			  and `ss_id`='{$subjectid}'";
																$delete_sturs=new insert_evaluation($delete_stursSql);
															
																if($delete_sturs->system_insert=="yes"){ ?>  
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<div class="alert alert-danger">
																			<p><strong>ยกเลิกสำเร็จ..</strong>ยกเลิกรายวิชา สำเร็จ</p>		
																		</div>	
																	</div>
																</div>	
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
																	</div>
																</div>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
												<?php			}else{ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<div class="alert alert-danger">
																			<p><strong>ยกเลิกไม่สำเร็จ..</strong>ยกเลิกรายวิชา ไม่สำเร็จ</p>		
																		</div>	
																	</div>
																</div>
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
																	</div>
																</div>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
												<?php			}  
															}		
													}
												?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
													<?php   }else{ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<div class="table-responsive">
																			  <table class="table table-hover">
																				<thead>
																				  <tr>
																					<th>ลำดับ</th>
																					<th>เลขประจำตัวนักเรียน</th>
																					<th>ชื่อ-สกุล</th>
																				  </tr>
																				</thead>
																				<tbody>
																				  
														<?php
															if($day=="Mon"){ ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_mon`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Tues"){ ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_tues`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Wednes"){ ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_wedne`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Thurs"){  ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_thurs`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="fri"){    ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_fri`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Satur"){  ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_satur`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Sun"){    ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_sun`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}else{
																	//--------------------------------------------------------------
														} ?>						  
																				  
																				  

																				  
																				  
																				  
																				</tbody>
																			  </table>
																		</div>				
																	</div>
																</div>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
													<?php   }?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
																


								
														<?php	}      ?>
															
													
															</div>
														</div>	
													</div>
												</div>	
												
												
												
												
												
												
												
												
												
												

				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
									<?php	}elseif($call_registration->sr_academic=="N" and $call_registration->sr_activity=="Y"){//เรียนเฉราะกิจกรรม
												
											}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="Y"){//เรียนทั้ง วิชาการ และ กิจกรรม ?>
				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

												<div class="row">
													<div class="col-<?php echo $grid;?>-12">
														<div class="panel panel-info">
															<div class="panel-heading">ทะเบียนเรียน เรียนเสริมเย็น</div>
															<div class="panel-body">
															
															<?php
																$not_study=filter_input(INPUT_GET,'notstudy');
																if($not_study=="notstudy"){ ?>
												<!--********************************************************************-->	
														<?php
														
													$print_notstudySql="SELECT `notstudy_stu` FROM `supplementary_notstudy`
																		WHERE `notstudy_stu`='{$user_login}' 
																		and `notstudy_t`='{$data_term}' 
																		and `notstudy_l`='{$data_stu->IDLevel}' 
																		and `notstudy_y`='{$data_yaer}' 
																		and `notstudy_p`='{$data_stu->rc_plan}'";
													$print_notstudyRs=new notrow_evaluation($print_notstudySql);
													foreach($print_notstudyRs->evaluation_array as $rc_key=>$print_notstudyRow){
														$notstudy_stu=$print_notstudyRow["notstudy_stu"];
														if($notstudy_stu==null){
														
															$supplementary_schoolSql="SELECT `supplementary_id` FROM `supplementary_school` 
																					  WHERE `supplementary_planA`='{$data_stu->rc_plan}' 
																					  and `supplementary_not`='n';";
															$supplementary_schoolRs=new notrow_evaluation($supplementary_schoolSql);
															foreach($supplementary_schoolRs->evaluation_array as $rc_key=>$supplementary_schoolRow){
																$txt_suppid=$supplementary_schoolRow["supplementary_id"];
															}
														
														
															$uts_notinto="INSERT INTO `supplementary_notstudy` (`notstudy_stu`, `notstudy_t`, `notstudy_l`, `notstudy_y`, `notstudy_p`, `notstudy_suppleid`) 
																		  VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$data_stu->rc_plan}', '{$txt_suppid}');";
															$uts_not=new insert_evaluation($uts_notinto);
															if($uts_not->system_insert=="yes"){ ?>
												<!--********************************************************************-->				
												<div class="alert alert-info">
												  <p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน </p>
													<form name="print_supp" action="<?php echo $golink;?>print_supplementary/special/<?php echo $user_login;?>" method="post">
													
														<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
														<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
														<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
														
														<input type="hidden" value="stu_not" name="stu_not">
														
														<center><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button>
														<a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-success">กลับไปหน้าลงทะเบียน</button></a></center>
													
													</form>
												</div>				
												<!--********************************************************************-->				
												<?php		}else{ ?>				
												<!--********************************************************************-->		
												<div class="alert alert-info">
													<form name="print_supp" action="<?php echo $golink;?>print_supplementary/special/<?php echo $user_login;?>" method="post">
													
														<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
														<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
														<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
														
														<input type="hidden" value="stu_not" name="stu_not">
														
														<center><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button>
												<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน</p>		
														<!--<button type="submit" class="btn btn-success">ยืนยันการลงทะเบียน</button>-->
															<a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-success">กลับไปหน้าลงทะเบียน</button></a></center>
													
													</form>
												</div>			
												<!--********************************************************************-->				
												<?php		}	   ?>	
												<?php	}else{     ?>
												<!--********************************************************************-->		
												<div class="alert alert-info">
													<form name="print_supp" action="<?php echo $golink;?>print_supplementary/special/<?php echo $user_login;?>" method="post">
													
														<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
														<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
														<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
														
														<input type="hidden" value="stu_not" name="stu_not">
													
													<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน</p>
													
														<center><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button>
														<!--<center><button type="submit" class="btn btn-success">ยืนยันการลงทะเบียน</button></center>-->
														<a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-success">กลับไปหน้าลงทะเบียน</button></a></center>
													
													</form>
												</div>		
												<!--********************************************************************-->			
												<?php	}
														
													}	?>			
												<!--********************************************************************-->					
														<?php	}else{ ?>					
												<!--********************************************************************-->	
																<form name="supplementaryB" action="view/mod/student/code/stu_supplementary/supplementary_code.php" method="post" >
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
															<?php
																$subjectid=filter_input(INPUT_GET,'subjectid');
																$day=filter_input(INPUT_GET,'day');
																$call_clik=filter_input(INPUT_GET,'call_clik');
																
																$system=filter_input(INPUT_GET,'system');
																
																if($system=="system"){
																	//echo "55";
																}elseif($subjectid=="" and $day==""){
																	exit("<script>window.location='./?evaluation_mod=stu_supplementary';</script>");
																}elseif($subjectid=="" or $day==""){
																	exit("<script>window.location='./?evaluation_mod=stu_supplementary';</script>");
																}else{ ?>
																	<input type="hidden" name="subjectid" value="<?php echo $subjectid;?>">
																	<input type="hidden" name="day" value="<?php echo $day;?>">
																	<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
																	<input type="hidden" name="data_term" value="<?php echo $data_term;?>">	
																	<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
																	<input type="hidden" name="datetime" value="<?php echo $datetime;?>">
																	<input type="hidden" name="call_clik" value="<?php echo $call_clik;?>">
																
												<!--<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถพิมพ์ ใบยืนยันการลงทะเบียน ได้ในวันจันทร์ ที่ 6 ก.ค 2563 ถึง วันพุธที่ 8 ก.ค 2563 และนำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ระหว่างวันที่ 8 ถึง 31 ก.ค 2563</p>-->					
																	
														<?php
																if($subjectid=="activity" and $day=="All"){ ?>
																
														<?php	}else{ ?>
																	<p><center><button type="submit" class="btn btn-default">สมัครเรียน</button></center></p>
														<?php	}?>			
																	
																	
																	
																	
														<?php	}      ?>		
																	</div>
																</div>
																</form>		

																<hr>
												<?php
														if($system=="system"){ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
												<?php
													$printrc_subjectSql="SELECT `ss_mon`, `ss_tues`, `ss_wedne`, `ss_thurs`, `ss_fri`, `ss_satur`, `ss_sun` 
																		 FROM `supplementary_sturs` 
																		 WHERE `sup_stuid`='{$user_login}' 
																		 and `sup_t`='{$data_term}' 
																		 and `sup_l`='{$data_stu->IDLevel}' 
																		 and `sup_year`='{$data_yaer}'
																		 and `ss_id`='{$subjectid}'";
													$printrc_subjectRs=new row_evaluation($printrc_subjectSql);
													
													foreach($printrc_subjectRs->evaluation_array as $rc_key=>$printrc_subjectRow){
														
														$countss_mon=$printrc_subjectRow["ss_mon"];
														$countss_tues=$printrc_subjectRow["ss_tues"];
														$countss_wedne=$printrc_subjectRow["ss_wedne"];
														$countss_thurs=$printrc_subjectRow["ss_thurs"];
														$countss_fri=$printrc_subjectRow["ss_fri"];
														$countss_satur=$printrc_subjectRow["ss_satur"];
														$countss_sun=$printrc_subjectRow["ss_sun"];
														
														if($countss_mon==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_MonKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_MonKeep=$printrc_subjectkeepRow["subject_MonKeep"];
																$subject_MonKeep=$subject_MonKeep-1;
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$subject_MonKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************
														}if($countss_tues==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_TuesKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_TuesKeep=$printrc_subjectkeepRow["subject_TuesKeep"];
																$subject_TuesKeep=$subject_TuesKeep-1;
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_TuesKeep`='{$subject_TuesKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************											
														}if($countss_wedne==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_WednesKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_WednesKeep=$printrc_subjectkeepRow["subject_WednesKeep"];
																$subject_WednesKeep=$subject_WednesKeep-1;
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_WednesKeep`='{$subject_WednesKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************											
														}if($countss_thurs==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_ThursKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_ThursKeep=$printrc_subjectkeepRow["subject_ThursKeep"];
																$subject_ThursKeep=$subject_ThursKeep-1;
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_ThursKeep`='{$subject_ThursKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************												
														}if($countss_fri==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_FriKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_FriKeep=$printrc_subjectkeepRow["subject_FriKeep"];
																$subject_FriKeep=$subject_FriKeep-1;
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_FriKeep`='{$subject_FriKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************											
														}if($countss_satur==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_SaturKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_SaturKeep=$printrc_subjectkeepRow["subject_SaturKeep"];
																$subject_SaturKeep=$subject_SaturKeep-1;
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_SaturKeep`='{$subject_SaturKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************											
														}
														if($countss_sun==1){
														//********************************************************************
															$printrc_subjectkeep="SELECT `subject_SunKeep`  
																				  FROM `supplementary_subject`
																				  WHERE `ss_t` ='{$data_term}' 
																				  AND `ss_l` ='{$data_stu->IDLevel}' 
																				  AND `ss_year` ='{$data_yaer}'
																				  AND `ss_id`='{$subjectid}'";
															$printrc_subjectkeepRs=new row_evaluation($printrc_subjectkeep);
															foreach($printrc_subjectkeepRs->evaluation_array as $rc_key=>$printrc_subjectkeepRow){
																$subject_SunKeep=$printrc_subjectkeepRow["subject_SunKeep"];
																$subject_SunKeep=$subject_SunKeep-1;
															}
														//********************************************************************											
															$printrc_subjectUp="UPDATE `supplementary_subject` SET `subject_SunKeep`='{$subject_SunKeep}'  
																				WHERE `ss_t` ='{$data_term}' 
																				AND `ss_l` ='{$data_stu->IDLevel}' 
																				AND `ss_year` ='{$data_yaer}'
																				AND `ss_id`='{$subjectid}'";
															$printrc_subjectUpdata=new insert_evaluation($printrc_subjectUp);
														//********************************************************************	
														}
//------------------------------------------------------------------------------------------------------------------------------------------------------
																$error=0;
//------------------------------------------------------------------------------------------------------------------------------------------------------														
															if($error>=1){ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<div class="alert alert-danger">
																			<p><strong>พบข้อผิดพลาด..</strong>กรุณาทำรายการใหม่อีกครั้ง</p>		
																		</div>	
																	</div>
																</div>
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
																	</div>
																</div>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
												<?php		}else{
																$delete_stursSql="DELETE FROM `supplementary_sturs` 
																			  WHERE `sup_stuid`='{$user_login}' 
																			  and `sup_t`='{$data_term}' 
																			  and `sup_l`='{$data_stu->IDLevel}' 
																			  and `sup_year`='{$data_yaer}' 
																			  and `ss_id`='{$subjectid}'";
																$delete_sturs=new insert_evaluation($delete_stursSql);
															
																if($delete_sturs->system_insert=="yes"){ ?>  
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<div class="alert alert-danger">
																			<p><strong>ยกเลิกสำเร็จ..</strong>ยกเลิกรายวิชา สำเร็จ</p>		
																		</div>	
																	</div>
																</div>	
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
																	</div>
																</div>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
												<?php			}else{ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<div class="alert alert-danger">
																			<p><strong>ยกเลิกไม่สำเร็จ..</strong>ยกเลิกรายวิชา ไม่สำเร็จ</p>		
																		</div>	
																	</div>
																</div>
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<center><a href="./?evaluation_mod=stu_supplementary"><button type="button" class="btn btn-danger">ย้อนกลับไป ที่หน้าลงทะเบียน</button></a></center>
																	</div>
																</div>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
												<?php			}  
															}		
													}
												?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
												<?php	}elseif($subjectid!="activity" and $day!="All"){ ?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
																<div class="row">
																	<div class="col-<?php echo $grid;?>-12">
																		<div class="table-responsive">
																			  <table class="table table-hover">
																				<thead>
																				  <tr>
																					<th>ลำดับ</th>
																					<th>เลขประจำตัวนักเรียน</th>
																					<th>ชื่อ-สกุล</th>
																				  </tr>
																				</thead>
																				<tbody>
																				  
														<?php
															if($day=="Mon"){ ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_mon`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Tues"){ ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_tues`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Wednes"){ ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_wedne`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Thurs"){  ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_thurs`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="fri"){    ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_fri`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Satur"){  ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_satur`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}elseif($day=="Sun"){    ?>
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
													<?php
														$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																				 WHERE `ss_id`='{$subjectid}' 
																				 and `ss_sun`='1' 
																				 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
														$print_supplementaryRs=new row_evaluation($print_supplementarySql);
														$count_stu=1;
														foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
													

																				  <tr>
																					<td><?php echo $count_stu;?></td>
																					<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>
													<?php
														$stu_data=new regina_stu_data($print_supplementaryRow["sup_stuid"]);
													?>								
																					<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
																				  </tr>	
													<?php	$count_stu=$count_stu+1;}
													
													
													?>		
												<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
														<?php	}else{
																	//--------------------------------------------------------------
														} ?>						  
																				  
																				  

																				  
																				  
																				  
																				</tbody>
																			  </table>
																		</div>				
																	</div>
																</div>

																
												<!--********************************************************************-->	
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
												<?php	}elseif($subjectid=="activity" and $day=="All"){?>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
													
													
													
													
													
													<form name="activity_rc" action="view/mod/student/code/stu_supplementary/supplementary_code.php" method="post" >
													
													
														<div class="row">
															<div class="col-<?php echo $grid;?>-6">
															
																<fieldset class="content-group">
																	<div class="form-group">
																		<label class="control-label col-<?php echo $grid;?>-5">เลือกกิจกรรมตามความถนัดและสนใจ</label>
																		<div class="col-<?php echo $grid;?>-7">
																			<select  name="copy_ss_id" id="copy_ss_id" required="required" class="select-size-<?php echo $grid;?>" data-placeholder="เลือกกิจกรรมตามความถนัดและสนใจ...">
																				<option></option>
																				<optgroup label="กิจกรรมตามความถนัดและสนใจ พร้อมกับ เสริมทักษะด้านวิชาการ">
																				
																	<?php
																		$supplementary_subjectSql="SELECT `ss_id`,`ss_txtth` 
																								   FROM `supplementary_subject` 
																								   WHERE `ss_t`='{$data_term}' 
																								   and `ss_l`='{$data_stu->IDLevel}' 
																								   and `ss_year`='{$data_yaer}' 
																								   and `ss_plan`='14'
																								   and `ss_academic`='0';";
																		$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
																		
																		foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){ ?>										
																					<option value="<?php echo $supplementary_subjectRow["ss_id"];?>"><?php echo $supplementary_subjectRow["ss_txtth"];?></option>
																<?php	} ?>

																				</optgroup>
																			</select>
																		</div>
																	</div>
																</fieldset>											
															
															</div>
															<div class="col-<?php echo $grid;?>-6">
																<center><button type="submit" name="stu_cilk" value="cilk_no" class="btn btn-success">ลงทะเบียน</button></center>
															</div>
														
																	<input type="hidden" name="subjectid" value="activity">
																	<input type="hidden" name="day" value="All">
																	<input type="hidden" id="data_yaer" name="data_yaer" value="<?php echo $data_yaer;?>">
																	<input type="hidden" id="data_term" name="data_term" value="<?php echo $data_term;?>">	
																	<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
																	<input type="hidden" name="datetime" value="<?php echo $datetime;?>">
																	<input type="hidden" name="call_clik" value="<?php echo $call_clik;?>">
														</div>			
													</form>
														<div id="show_data"></div>
				<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
												<?php	}else{ 
															
														} ?>				
														<?php	}      ?>
															
													
															</div>
														</div>	
													</div>
												</div>	

				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
									<?php	}else{ ?>
							<!--***************************************************************************************************-->	
								<div class="row">
									<div class="col-<?php echo $grid;?>-12">
									
									
									</div>
								</div>				
							<!--***************************************************************************************************-->	
									<?php } ?>
				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
							<?php	}else{
										//************************************************************************************	
									}
								?>
				<!--///////////////////////////////////////////////////////////////////////////////////////////////////////-->		
					<?php	break;
							case "OFF": ?>
				<!--///////////////////////////////////////////////////////////////////////////////////////////////////////-->
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">
									<div class="alert alert-danger">
										<p><strong>ปิดระบบ...</strong>สิ้นสุดระยะเวลาลงทะเบียนเรียนเสริมนอกตารางแล้ว ในขณะนี้ พบข้อสงสัย ติดต่อสอบถาม ได้ที่ห้องวิชาการ</p>		
									</div>	
								</div>
							</div>
				<!--///////////////////////////////////////////////////////////////////////////////////////////////////////-->			
					<?php	break;
					}
				?>

<!--######################################################################################################-->		
<?php	}      ?>







	
