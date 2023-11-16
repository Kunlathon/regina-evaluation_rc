<?php
	include("view/database/pdo_data.php");
	include("view/database/class_pdo.php");	
	
	include("view/database/database_paynew.php");
	include("view/database/class_pay.php");
	
    include("view/function/pay_scb.php");
	
	$data_yaer=2566;
	$data_term=2;

	$user_login;
	
	

	
	//$stu_cilk=filter_input(INPUT_POST,'stu_cilk');	
	
	//$datetime="2021-11-30 17:00:00";
	$datetime="2024-01-01 00:00:00";
	$datetime_cr=date("Y-m-d H:i:s");
	$datatime_notrun=strtotime($datetime);
	$datatime_run=strtotime($datetime_cr);
		
		if($datatime_run>=$datatime_notrun){
			$print_runtime="OFF";
		}else{
			$print_runtime="ON";
		}
			$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
			
			
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4><span class="text-semibold">ลงทะเบียนเรียนเสริมนอกเวลาเรียน&nbsp;ภาคเรียน&nbsp;<?php echo $data_term."&nbsp;/&nbsp;".$data_yaer;?></span></h4>
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
	$off_timeA=date("2023-09-08 00:00:00");
	$off_timeB=date("Y-m-d H:i:s");
	$off_timeintA=strtotime($off_timeA);
	$off_timeintB=strtotime($off_timeB);
		if(($off_timeintB>=$off_timeintA)){
			$off_system="ON";
		}else{
			$off_system="OFF";
		}

    
        if(($off_system=="OFF")){ ?>
            
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">
									<div class="alert alert-danger">
										<p><strong>ปิดระบบ...</strong></p>		
									</div>	
								</div>
							</div>	            
            
<?php   }else{ ?><!--OFF-->
            


<?php
		if(($data_stu->IDLevel>=3 and $data_stu->IDLevel<=3)){ ?>
<!--#######################################################################################################-->	

<!--///////////////////////////////////////////////////////////////////////////////////////////////////////-->

<!----------------------------------------------------------------------------------------------------------->		
				<?php
					//sr_academic -> วิชาการ
					//sr_activity -> กิจกรรม
                    $sud_grouppay=new print_stu_grouppay($user_login,$data_yaer,$data_stu->rc_plan,$data_stu->IDLevel);
					$call_registration=new supplementary_registration($data_stu->IDLevel,$data_stu->rc_plan);
					if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){ //รวมทั้งหมด?>
	<!------------------------------------------------------------------------------------------------------->					
		
	<form name="stu_supplementary" accept-charset="UTF-8" method="post" action="./?evaluation_mod=supplementary">

		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
				<div class="panel-heading">ลงทะเบียน โครงการสอนเสริมนอกเวลาเรียน ภาคเรียนที่&nbsp;<?php echo $data_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_yaer;?>&nbsp;</div>
					<div class="panel-body">
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
								if($count_use>=1){ ?>
		<!--******************************************************************************************************-->	
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
													$pay_supplementarySql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` FROM `supplementary_school` WHERE `ss_pay`='ALLPAY' AND `ss_id`='{$print_subjectId}'";
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
                                                                    <div>1&nbsp;.&nbsp;ทำการสแกน&nbsp;QR&nbsp;Code&nbsp;ที่ปรากฏในเพจนี้&nbsp;ด้วยแอปพลิเคชัน&nbsp;Mobile&nbsp;Banking&nbsp;ของท่าน</div>
                                                                    <div>2&nbsp;.&nbsp;ตรวจสอบข้อมูลที่ปรากฏใน&nbsp;Mobile&nbsp;Banking&nbsp;ให้ถูกต้องก่อนชำระเงิน</div>
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
									<center><button type="submit" name="stu_cilk" value="cilk_yes" class="btn btn-danger">ยกเลิกลงทะเบียน</button></center>						
								</div>
							</div>
		<!--******************************************************************************************************-->										
						<?php		}else{ ?>
		<!--******************************************************************************************************-->	
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">
									<center><button type="submit" name="stu_cilk" value="cilk_no" class="btn btn-success">ลงทะเบียน</button></center>						
								</div>
							</div>					
		<!--******************************************************************************************************-->													
						<?php		}							
							} ?>				
					</div>
				</div>		
			</div>
		</div>	

		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">ค่าลงทะเบียน โครงการสอนเสริมนอกเวลาเรียน ภาคเรียนที่&nbsp;<?php echo $data_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_yaer;?>&nbsp;</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr>
												<th><div><center>รายการ</center></div></th>
												<th><div><center>ค่าลงทะเบียน</center></div></th>
												<th><div><center>หมายเหตุ</center></div></th>
											</tr>
										</thead>
										<tbody> 
									<?php 
										$call_schoolSql="SELECT `supplementary_txt`,`supplementary_pay`,`supplementary_levelA`,`supplementary_levelB`,`supplementary_note` 
														 FROM `supplementary_school` 
														 WHERE `supplementary_t`='{$data_term}' 
														 and `supplementary_planA`>='{$data_stu->rc_plan}' 
														 and `supplementary_planB`<='{$data_stu->rc_plan}'
														 and `supplementary_levelA`>='{$data_stu->IDLevel}'
														 and `supplementary_levelB`<='{$data_stu->IDLevel}'
														 and `supplementary_not`='N'
														 and `supplementary_off`='0'
														 and `ss_pay`='ALLPAY';";
										$call_schoolRs=new row_evaluation($call_schoolSql);
										foreach($call_schoolRs->evaluation_array as $rc_key=>$call_schoolRow){ 
										
											if($data_stu->IDLevel>=$call_schoolRow["supplementary_levelA"] and $data_stu->IDLevel<=$call_schoolRow["supplementary_levelB"]){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
											<tr>
												<td><?php echo $call_schoolRow["supplementary_txt"];?></td>
												
									<?php
										$sud_grouppay=new print_stu_grouppay($user_login,$data_yaer,$data_stu->rc_plan,$data_stu->IDLevel);
										
											if($sud_grouppay->ps_id=="11"){ ?>
												<td>เรียนพรี</td>
									<?php	}elseif($sud_grouppay->ps_id=="12"){ ?>
												<td>เรียนพรี</td>
									<?php	}else{ ?>
												<td><?php echo $call_schoolRow["supplementary_pay"]." บาท";?></td>
									<?php	}?>			
												
												<td><?php echo $call_schoolRow["supplementary_note"];?></td>
											</tr>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
									<?php	}else{
												//********************************************************************************************************************************
											}
										} ?>	
										
										</tbody>
								  </table>
								</div>						
							</div>
						</div>				
					</div>
				</div>
			</div>
		</div>
	</form>
		
	<!------------------------------------------------------------------------------------------------------->						
			<?php	}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="N"){//เรียนเฉราะวิชาการ
						
					}elseif($call_registration->sr_academic=="N" and $call_registration->sr_activity=="Y"){//เรียนเฉราะกิจกรรม
						
					}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="Y"){//เรียนทั้ง วิชาการ และ กิจกรรม
						
					}else{ ?>
	<!--***************************************************************************************************-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
			
			
			</div>
		</div>				
	<!--***************************************************************************************************-->					
			<?php	}      ?>
		
<!----------------------------------------------------------------------------------------------------------->
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////-->	
	
<!--#######################################################################################################-->		
<?php	}elseif($data_stu->IDLevel>=11 and $data_stu->IDLevel<=23){ ?>
<!--#######################################################################################################-->	

<!--///////////////////////////////////////////////////////////////////////////////////////////////////////-->

<!------------------------------------------------------------------------------------------------------->		
				<?php
					//sr_academic -> วิชาการ
					//sr_activity -> กิจกรรม
                    $sud_grouppay=new print_stu_grouppay($user_login,$data_yaer,$data_stu->rc_plan,$data_stu->IDLevel);
					$call_registration=new supplementary_registration($data_stu->IDLevel,$data_stu->rc_plan);
					if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){ //รวมทั้งหมด?>
<!------------------------------------------------------------------------------------------------------->					
		



	<form name="stu_supplementary" accept-charset="UTF-8" method="post" action="./?evaluation_mod=supplementary">

		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
				<div class="panel-heading">ลงทะเบียน โครงการสอนเสริมนอกเวลาเรียน ภาคเรียนที่&nbsp;<?php echo $data_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_yaer;?>&nbsp;</div>
					<div class="panel-body">                  
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
								if($count_use>=1){ ?>
<!--******************************************************************************************************-->	
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
															<p><strong>รายวิชา&nbsp;/&nbsp;กิจกรรม&nbsp;ที่ลงทะเบียน&nbsp;</strong><?php echo $print_subject;?></p>		
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
													$pay_supplementarySql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` FROM `supplementary_school` WHERE  `ss_id`='{$print_subjectId}'";
													$pay_supplementaryRs=new notrow_evaluation($pay_supplementarySql);
													foreach($pay_supplementaryRs->evaluation_array as $rc_key=>$pay_supplementaryPrint){
														$supplementary_id=$pay_supplementaryPrint["supplementary_id"];
                                                        $supplementary_pay=$pay_supplementaryPrint["supplementary_pay"];
														if($supplementary_id==Null){ ?>
			<!---+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--+-+-+-+-+--->			
															<div class="row">
																<div class="col-<?php echo $grid;?>-12">
																	<div class="alert alert-danger">
																		<p><strong>ไม่พบ&nbsp;QRcode</strong>กรุณาติดต่อที่ห้องการเงิน</p>		
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
										</div><hr>
	
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<center><button type="submit" name="stu_cilk" value="cilk_yes" class="btn btn-danger">ยกเลิกลงทะเบียน</button></center>						
										</div>
									</div>
		<!--******************************************************************************************************-->										
						<?php		}else{ ?>
		<!--******************************************************************************************************-->	
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">
									<center><button type="submit" name="stu_cilk" value="cilk_no" class="btn btn-success">ลงทะเบียน</button></center>						
								</div>
							</div>					
		<!--******************************************************************************************************-->													
						<?php		}							
							} ?>				
					</div>
				</div>		
			</div>
		</div>

		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">ค่าลงทะเบียน โครงการสอนเสริมนอกเวลาเรียน ภาคเรียนที่&nbsp;<?php echo $data_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_yaer;?>&nbsp;</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr>
												<th><div><center>รายการ</center></div></th>
												<th><div><center>ค่าลงทะเบียน</center></div></th>
												<th><div><center>หมายเหตุ</center></div></th>
											</tr>
										</thead>
										<tbody> 
									<?php 
										$call_schoolSql="SELECT `supplementary_txt`,`supplementary_pay`,`supplementary_levelA`,`supplementary_levelB`,`supplementary_note` 
														 FROM `supplementary_school` 
														 WHERE `supplementary_t`='{$data_term}' 
														 and `supplementary_planA`>='{$data_stu->rc_plan}' 
														 and `supplementary_planB`<='{$data_stu->rc_plan}'
														 and `supplementary_levelA`>='{$data_stu->IDLevel}'
														 and `supplementary_levelB`<='{$data_stu->IDLevel}'
														 and `supplementary_not`='N'
														 and `supplementary_off`='0'
														 and `ss_pay`='ALLPAY';";
										$call_schoolRs=new row_evaluation($call_schoolSql);
										foreach($call_schoolRs->evaluation_array as $rc_key=>$call_schoolRow){ 
										
											if($data_stu->IDLevel>=$call_schoolRow["supplementary_levelA"] and $data_stu->IDLevel<=$call_schoolRow["supplementary_levelB"]){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
											<tr>
												<td><?php echo $call_schoolRow["supplementary_txt"];?></td>
												
									<?php
										$sud_grouppay=new print_stu_grouppay($user_login,$data_yaer,$data_stu->rc_plan,$data_stu->IDLevel);
										
											if($sud_grouppay->ps_id=="11"){ ?>
												<td>1500 บาท</td>
									<?php	}elseif($sud_grouppay->ps_id=="12"){ ?>
												<td>1500 บาท</td>
									<?php	}else{ ?>
												<td><?php echo $call_schoolRow["supplementary_pay"]." บาท";?></td>
									<?php	}?>			
												
												<td><?php echo $call_schoolRow["supplementary_note"];?></td>
											</tr>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
									<?php	}else{
												//********************************************************************************************************************************
											}
										} ?>	
										
										</tbody>
								  </table>
								</div>						
							</div>
						</div>				
					</div>
				</div>
			</div>
		</div>
	
	</form>
		
	<!------------------------------------------------------------------------------------------------------->						
			<?php	}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="N"){//เรียนเฉราะวิชาการ
						
					}elseif($call_registration->sr_academic=="N" and $call_registration->sr_activity=="Y"){//เรียนเฉราะกิจกรรม ?>
	<!------------------------------------------------------------------------------------------------------->			
	<form name="stu_supplementary" accept-charset="UTF-8" method="post" action="./?evaluation_mod=supplementary">
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">ลงทะเบียน โครงการสอนเสริมนอกเวลาเรียน ภาคเรียนที่&nbsp;<?php echo $data_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_yaer;?>&nbsp;</div>
					<div class="panel-body">
					
					
						
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
								if($count_use>=1){ ?>
		<!--******************************************************************************************************-->	
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
													$pay_supplementarySql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
																		   FROM `supplementary_school` 
																		   WHERE `ss_pay`='PAYMENT' 
																		   AND `ss_id`='{$print_subjectId}'";
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
										</div><hr>

									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<center><button type="submit" name="stu_cilk" value="cilk_yes" class="btn btn-danger">ยกเลิกลงทะเบียน</button></center>						
										</div>
									</div>
		<!--******************************************************************************************************-->										
						<?php		}else{ ?>
		<!--******************************************************************************************************-->	
				
							<div class="row">
								<div class="col-<?php echo $grid;?>-8">
									<fieldset class="content-group">
										<div class="form-group">
											<label class="control-label col-<?php echo $grid;?>-5">เลือกกิจกรรมตามความถนัดและสนใจ</label>
											<div class="col-<?php echo $grid;?>-7">
												<select  name="copy_ss_id" class="select-size-<?php echo $grid;?>" data-placeholder="เลือกกิจกรรมตามความถนัดและสนใจ...">
													<option></option>
													<optgroup label="กิจกรรมตามความถนัดและสนใจ พร้อมกับ เสริมทักษะด้านวิชาการ">
													
										<?php
											$supplementary_subjectSql="SELECT `ss_id`,`ss_txtth` 
																	   FROM `supplementary_subject` 
																	   WHERE `ss_t`='{$data_term}' 
																	   and `ss_l`='{$data_stu->IDLevel}' 
																	   and `ss_year`='{$data_yaer}' 
																	   and `ss_plan`='{$data_stu->rc_plan}'
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
								<div class="col-<?php echo $grid;?>-4">
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<center><button type="submit" name="stu_cilk" value="cilk_no" class="btn btn-success">ลงทะเบียน</button></center>						
										</div>
									</div>	
								</div>
							</div>


						<?php
								$supplementary_subjectSql="SELECT `ss_id`,`ss_txtth` FROM `supplementary_subject` 
														   WHERE  `ss_t` ='{$data_term}' and `ss_l` = '{$data_stu->IDLevel}' and `ss_year` = '{$data_yaer}' and `ss_plan` = '{$data_stu->rc_plan}' and `ss_academic`='1'";
								$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
								foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
									$call_ssid=$supplementary_subjectRow["ss_id"];
									$call_txtth=$supplementary_subjectRow["ss_txtth"];
				
								}
						?>

		<!--******************************************************************************************************-->													
						<?php		}							
							} ?>
					</div>
				</div>		
			</div>
		</div>
	</form>
		
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">ค่าลงทะเบียน โครงการสอนเสริมนอกเวลาเรียน ภาคเรียนที่&nbsp;<?php echo $data_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_yaer;?>&nbsp;</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>รายการ</th>
												<th>ค่าลงทะเบียน</th>
												<th>หมายเหตุ</th>
											</tr>
										</thead>
										<tbody> 
									<?php 
										$call_schoolSql="SELECT `supplementary_txt`,`supplementary_pay`,`supplementary_levelA`,`supplementary_levelB`,`supplementary_note` 
														 FROM `supplementary_school` 
														 WHERE `supplementary_t`='{$data_term}' 
														 and `supplementary_planA`>='{$data_stu->rc_plan}' 
														 and `supplementary_planB`<='{$data_stu->rc_plan}'; ";
										$call_schoolRs=new row_evaluation($call_schoolSql);
										foreach($call_schoolRs->evaluation_array as $rc_key=>$call_schoolRow){ 
										
											if($data_stu->IDLevel>=$call_schoolRow["supplementary_levelA"] and $data_stu->IDLevel<=$call_schoolRow["supplementary_levelB"]){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
											<tr>
												<td><?php echo $call_schoolRow["supplementary_txt"];?></td>
														
									<?php
										//$sud_grouppay=new print_stu_grouppay($user_login,$data_yaer,$data_stu->rc_plan,$data_stu->IDLevel);
										
											if($sud_grouppay->ps_id=="11"){ ?>
												<td>1,500.00 บาท</td>
									<?php	}elseif($sud_grouppay->ps_id=="12"){ ?>
												<td>1,500.00 บาท</td>
									<?php	}else{ ?>
												<td><?php echo number_format($call_schoolRow["supplementary_pay"], 2, '.', ',')." บาท";?></td>
									<?php	}?>			
																							
												<td><?php echo $call_schoolRow["supplementary_note"];?></td>
											</tr>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
									<?php	}else{
												//********************************************************************************************************************************
											}
										} ?>	
										
										</tbody>
								  </table>
								</div>						
							</div>
						</div>				
					</div>
				</div>
			</div>
		</div>

	<!------------------------------------------------------------------------------------------------------->				
			<?php	}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="Y"){//เรียนทั้ง วิชาการ และ กิจกรรม
						
					}else{ ?>
	<!--***************************************************************************************************-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
			
			<?php echo $call_registration->sr_academic.$call_registration->sr_activity;?>
			
			</div>
		</div>				
	<!--***************************************************************************************************-->					
			<?php	}      ?>
			
	<!------------------------------------------------------------------------------------------------------->


<!--///////////////////////////////////////////////////////////////////////////////////////////////////////-->	
	
<!--#######################################################################################################-->			
<?php	}else{ ?>
<!--#######################################################################################################-->		

							<!--<div class="row">
								<div class="col-<?php echo $grid;?>-12">
									<div class="alert alert-danger">
										<p>ในขณะนี้ เจ้าหน้าที่ ICT และ คุณครู ผ่ายวิชาการ กำลังทดสอบ ระบบ ถ้านักเรียนทำการลงระบบในระหว่างที่ติดประกาศนี้ ถือว่า การลงทะเบียนในระบบ ไม่สำเร็จ  </p>		
										<p><strong>นักเรียน</strong>ระดับชั้นมัธยม เริ่มลงทะเบียน  ในวันที่ 17 พฤษภาคม 2565 เป็นต้นไป</p>		
									</div>	
								</div>
							</div>-->

			<?php
			
				$System_Test=$off_system;
					if($System_Test=="OFF"){ ?>
							
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">
									<div class="alert alert-danger">
										<p><strong>ปิดระบบ...</strong></p>		
									</div>	
								</div>
							</div>							
							
			<?php	}else{ ?>
							


						<?php
							switch($print_runtime){
								case "ON": ?>
						<!--///////////////////////////////////////////////////////////////////////////////////////////////////////-->
								<?php
										if($data_stu->IDLevel>=31 and $data_stu->IDLevel<=33){ ?>
										

						<?php
								$off_system="ON";
								if($off_system=="ON"){ ?>
						<!--*******************************************************************************************************-->

							
						<!--///////////////////////////////////////////////////////////////////////////////////////////////////////-->
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">
									<div class="panel panel-success">
										<div class="panel-heading"><center><h5>เหลือเวลาลงทะเบียนเรียน เรียนเสริมเย็น<div id="demo"></div></h5></center></div>
									</div>
								</div>
							</div><hr>
						<!------------------------------------------------------------------------------------------------------->

						<!------------------------------------------------------------------------------------------------------->
									<?php
											//sr_academic -> วิชาการ
											//sr_activity -> กิจกรรม
											$call_registration=new supplementary_registration($data_stu->IDLevel,$data_stu->rc_plan);
											if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){//รวมทั้งหมด ?>
		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																																
		<!------------------------------------------------------------------------------------------------------->					
			<form name="stu_supplementary" accept-charset="UTF-8" method="post" action="./?evaluation_mod=supplementary">

				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="panel panel-info">
						<div class="panel-heading">ลงทะเบียน โครงการสอนเสริมนอกเวลาเรียน ภาคเรียนที่&nbsp;<?php echo $data_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_yaer;?>&nbsp;</div>
							<div class="panel-body">
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
										if($count_use>=1){ ?>
		<!--******************************************************************************************************-->	
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
															$pay_supplementarySql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` FROM `supplementary_school` WHERE  `ss_id`='{$print_subjectId}'";
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
											<center><button type="submit" name="stu_cilk" value="cilk_yes" class="btn btn-danger">ยกเลิกลงทะเบียน</button></center>						
										</div>
									</div>
				<!--******************************************************************************************************-->										
								<?php		}else{ ?>
				<!--******************************************************************************************************-->	
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<center><button type="submit" name="stu_cilk" value="cilk_no" class="btn btn-success">ลงทะเบียน</button></center>						
										</div>
									</div>					
				<!--******************************************************************************************************-->													
								<?php		}							
									} ?>				
							</div>
						</div>		
					</div>
				</div>	

				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="panel panel-info">
							<div class="panel-heading">ค่าลงทะเบียน โครงการสอนเสริมนอกเวลาเรียน ภาคเรียนที่&nbsp;<?php echo $data_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_yaer;?>&nbsp;</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-<?php echo $grid;?>-12">
										<div class="table-responsive">
											<table class="table table-hover">
												<thead>
													<tr>
														<th><center>รายการ</center></th>
														<th><center>ค่าลงทะเบียน</center></th>
														<th><center>หมายเหตุ</center></th>
													</tr>
												</thead>
												<tbody> 
											<?php 
												$call_schoolSql="SELECT `supplementary_txt`,`supplementary_pay`,`supplementary_levelA`,`supplementary_levelB`,`supplementary_note` 
																 FROM `supplementary_school` 
																 WHERE `supplementary_t`='{$data_term}' 
																 and `supplementary_planA`>='{$data_stu->rc_plan}' 
																 and `supplementary_planB`<='{$data_stu->rc_plan}'
																 and `supplementary_levelA`>='{$data_stu->IDLevel}'
																 and `supplementary_levelB`<='{$data_stu->IDLevel}'
																 and `supplementary_not`='N'
																 and `supplementary_off`='0'
																 and `ss_pay`='ALLPAY';";
												$call_schoolRs=new row_evaluation($call_schoolSql);
												foreach($call_schoolRs->evaluation_array as $rc_key=>$call_schoolRow){ 
												
													if($data_stu->IDLevel>=$call_schoolRow["supplementary_levelA"] and $data_stu->IDLevel<=$call_schoolRow["supplementary_levelB"]){ ?>
			<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
													<tr>
														<td><?php echo $call_schoolRow["supplementary_txt"];?></td>
														
											<?php
												$sud_grouppay=new print_stu_grouppay($user_login,$data_yaer,$data_stu->rc_plan,$data_stu->IDLevel);
												
													if($sud_grouppay->ps_id=="11"){ ?>
														<td>เรียนพรี</td>
											<?php	}elseif($sud_grouppay->ps_id=="12"){ ?>
														<td>เรียนพรี</td>
											<?php	}else{ ?>
														<td><?php echo number_format($call_schoolRow["supplementary_pay"], 2, '.', ',')." บาท";?></td>
											<?php	}?>			
														
														<td><?php echo $call_schoolRow["supplementary_note"];?></td>
													</tr>
			<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
											<?php	}else{
														//********************************************************************************************************************************
													}
												} ?>	
												
												</tbody>
										  </table>
										</div>						
									</div>
								</div>				
							</div>
						</div>
					</div>
				</div>
			</form>
			<!------------------------------------------------------------------------------------------------------->															
																		
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->													
									<?php	}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="N"){//เรียนเฉราะวิชาการ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
						<!--supplementary_notstudy-->
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
								if($notstudy_stu==""){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="panel panel-info">
									<div class="panel-heading">ทะเบียนเรียน เรียนเสริมเย็น</div>
									<div class="panel-body">

										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="table-responsive">
												
												   <table class="table table-hover">
													<thead>
													  <tr>	
															<th>วิชา</th>
										<?php
											$print_supp_day=new supplementary_day();
											if($print_supp_day->sd_mon=="ON"){ ?>
															<th>วันจันทร์</th>
										<?php	}elseif($print_supp_day->sd_mon=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}      ?>
											
										<?php	if($print_supp_day->sd_tue=="ON"){ ?>
															<th>วันอังคาร</th>
										<?php	}elseif($print_supp_day->sd_tue=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}	   ?>				
											
										<?php	if($print_supp_day->sd_wed=="ON"){ ?>
															<th>วันพุธ</th>
										<?php	}elseif($print_supp_day->sd_wed=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}	   ?>					
											
										<?php	if($print_supp_day->sd_thu=="ON"){?>
															<th>วันพฤหัสบดี</th>
										<?php	}elseif($print_supp_day->sd_thu=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>					
											
										<?php	if($print_supp_day->sd_frl=="ON"){?>
															<th>วันศุกร์</th>
										<?php	}elseif($print_supp_day->sd_frl=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>					
											
										<?php	if($print_supp_day->sd_sat=="ON"){?>
															<th>วันเสาร์</th>
										<?php	}elseif($print_supp_day->sd_sat=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>

										<?php	if($print_supp_day->sd_sun=="ON"){?>
															<th>วันอาทิตย์</th>
										<?php	}elseif($print_supp_day->sd_sun=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>				
													  </tr>
													  
													</thead>
													<tbody>
										<?php
											$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
																	   FROM `supplementary_subject` 
																	   WHERE `ss_t`='{$data_term}' 
																	   and `ss_l`='{$data_stu->IDLevel}' 
																	   and `ss_year`='{$data_yaer}' 
																	   and `ss_academic`='1'";
											$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){  ?>
												
									
												<tr>
														<td><?php echo $supplementary_subjectRow["ss_txtth"];?></td>
														
										
										
										<?php
											$print_daysubject=new supplementary_daysubject($supplementary_subjectRow["ss_id"]);	
										?>
										
										
										
										
										<?php
											$supplementary_dayplanSql="SELECT `sdp_key`,`sd_plan`, `sd_group`,`sd_numA`,`sd_numB`
																	   FROM `supplementary_dayplan` 
																	   WHERE `sd_plan`='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
											$supplementary_dayplanRs=new notrow_evaluation($supplementary_dayplanSql);
											foreach($supplementary_dayplanRs->evaluation_array as $rc_key=>$supplementary_dayplanRow){
												$sdp_key=$supplementary_dayplanRow["sdp_key"];
												$sdp_group=$supplementary_dayplanRow["sd_group"];
												$sdp_plan=$supplementary_dayplanRow["sd_plan"];
												$sdp_numA=$supplementary_dayplanRow["sd_numA"];
												$sdp_numB=$supplementary_dayplanRow["sd_numB"];
												if($sdp_group==0 or $sdp_group==Null){

										
															$data_dayplanSql="SELECT `sdp_key` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$data_stu->rc_plan}' 
																			  and `sd_group`='0' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
													
												}else{
													$num_dayplanSql="SELECT `sdp_key`,`sd_numA`,`sd_numB`,`sd_group`  
																	 FROM `supplementary_dayplan` 
																	 WHERE `sd_plan` ='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
													$num_dayplanRs=new row_evaluation($num_dayplanSql);							
													foreach($num_dayplanRs->evaluation_array as $rc_key=>$num_dayplanRow){
														if($data_stu->rsc_num>=$num_dayplanRow["sd_numA"] and $data_stu->rsc_num<=$num_dayplanRow["sd_numB"]){
															$data_dayplanSql="SELECT `sdp_key`,`sd_plan`,`sd_group` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$data_stu->rc_plan}' 
																			  and `sd_group`='{$num_dayplanRow["sd_group"]}' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
														break;	
														}else{
															
														}
													}
													
												}
											}
										?>					
										
										
							<?php
								$print_dayplanSql="SELECT `sdp_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` 
												   FROM `supplementary_dayplan` 
												   WHERE `sdp_key`='{$datasdp_key}'";
								$print_dayplanRs=new notrow_evaluation($print_dayplanSql);
								foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
									$print_sdp_key=$print_dayplanRow["sdp_key"];
									$print_sd_mon=$print_dayplanRow["sd_mon"];
									$print_sd_tue=$print_dayplanRow["sd_tue"];
									$print_sd_wed=$print_dayplanRow["sd_wed"];
									$print_sd_thu=$print_dayplanRow["sd_thu"];
									$print_sd_frl=$print_dayplanRow["sd_frl"];
									$print_sd_sat=$print_dayplanRow["sd_sat"];
									$print_sd_sun=$print_dayplanRow["sd_sun"];
								}
							?>	



										
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_mon=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_mon=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_year`='{$data_yaer}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_mon`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_MonCount`,`subject_MonKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_MonCount=$supplementary_subjectRow["subject_MonCount"];
												$subject_MonKeep=$supplementary_subjectRow["subject_MonKeep"];
												if($subject_MonKeep>=$subject_MonCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Mon"><b style="color:#0623FB"><?php echo $subject_MonKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_mon=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
								
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_mon=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->				
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_tue=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_tue=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_tues`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_TuesCount`,`subject_TuesKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}' 
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_TuesCount=$supplementary_subjectRow["subject_TuesCount"];
												$subject_TuesKeep=$supplementary_subjectRow["subject_TuesKeep"];
												if($subject_TuesKeep>=$subject_TuesCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Tues"><b style="color:#0623FB"><?php echo $subject_TuesKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_tue=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_tue=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->									
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_wed=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_wed=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_wedne`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_WednesCount`,`subject_WednesKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_WednesCount=$supplementary_subjectRow["subject_WednesCount"];
												$subject_WednesKeep=$supplementary_subjectRow["subject_WednesKeep"];
												if($subject_WednesKeep>=$subject_WednesCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Wednes"><b style="color:#0623FB"><?php echo $subject_WednesKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_wed=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_wed=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->									
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_thu=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_thu=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_thurs`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_ThursCount`,`subject_ThursKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_ThursCount=$supplementary_subjectRow["subject_ThursCount"];
												$subject_ThursKeep=$supplementary_subjectRow["subject_ThursKeep"];
												if($subject_ThursKeep>=$subject_ThursCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Thurs"><b style="color:#0623FB"><?php echo $subject_ThursKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_thu=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_thu=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->	
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_frl=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_frl=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_fri`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_FriCount`,`subject_FriKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}' 
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_FriCount=$supplementary_subjectRow["subject_FriCount"];
												$subject_FriKeep=$supplementary_subjectRow["subject_FriKeep"];
												if($subject_FriKeep>=$subject_FriCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=fri"><b style="color:#0623FB"><?php echo $subject_FriKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_frl=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_frl=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_sat=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_sat=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_sat`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_SaturCount`,`subject_SaturKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_SaturCount=$supplementary_subjectRow["subject_SaturCount"];
												$subject_SaturKeep=$supplementary_subjectRow["subject_SaturKeep"];
												if($subject_SaturKeep>=$subject_SaturCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Satur"><b style="color:#0623FB"><?php echo $subject_SaturKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_sat=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_sat=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->	
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_sun=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_sun=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_sun`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_SunCount`,`subject_SunKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_SunCount=$supplementary_subjectRow["subject_SunCount"];
												$subject_SunKeep=$supplementary_subjectRow["subject_SunKeep"];
												if($subject_SunKeep>=$subject_SunCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun"><b style="color:#0623FB"><?php echo $subject_SunKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_sun=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_sun=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->										
												</tr>	
											
											
										<?php	}  ?>
												
												
												

									
													</tbody>
												  </table>
												
												
												
												
												
												</div>
											</div>
										</div>

									</div>
								</div>	
							</div>
							
						</div>


						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
						<?php	}else{ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
						<?php	} ?>
						<?php	} ?>
						<!--supplementary_notstudy-->

							

						<div class="row">	
								
							<div class="col-<?php echo $grid;?>-12">
							
												<center>
												
												
										<?php
											$supplementary_dayplanSql="SELECT `sdp_key`,`sd_plan`, `sd_group`,`sd_numA`,`sd_numB`,`sd_class`
																	   FROM `supplementary_dayplan` 
																	   WHERE `sd_plan`='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
											$supplementary_dayplanRs=new notrow_evaluation($supplementary_dayplanSql);
											foreach($supplementary_dayplanRs->evaluation_array as $rc_key=>$supplementary_dayplanRow){
												$sdp_key=$supplementary_dayplanRow["sdp_key"];
												$sdp_group=$supplementary_dayplanRow["sd_group"];
												$sdp_plan=$supplementary_dayplanRow["sd_plan"];
												$sdp_numA=$supplementary_dayplanRow["sd_numA"];
												$sdp_numB=$supplementary_dayplanRow["sd_numB"];
												if($sdp_group==0 or $sdp_group==Null){

										
															$data_dayplanSql="SELECT `sdp_key` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'
																			  and `sd_group`='0'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
													
												}else{
													$num_dayplanSql="SELECT `sdp_key`,`sd_numA`,`sd_numB`,`sd_group`  
																	 FROM `supplementary_dayplan` 
																	 WHERE `sd_plan` ='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
													$num_dayplanRs=new row_evaluation($num_dayplanSql);							
													foreach($num_dayplanRs->evaluation_array as $rc_key=>$num_dayplanRow){
														if($data_stu->rsc_num>=$num_dayplanRow["sd_numA"] and $data_stu->rsc_num<=$num_dayplanRow["sd_numB"]){
															$data_dayplanSql="SELECT `sdp_key`,`sd_plan`,`sd_group` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$data_stu->rc_plan}' 
																			  and `sd_group`='{$num_dayplanRow["sd_group"]}' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
														break;	
														}else{
															
														}
													}
													
												}
											}
										?>


							<?php
								$print_dayplanSql="SELECT `sdp_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` 
												   FROM `supplementary_dayplan` 
												   WHERE `sdp_key`='{$datasdp_key}'";
								$print_dayplanRs=new notrow_evaluation($print_dayplanSql);
								$count_study=0;
								foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
									$print_sdp_key=$print_dayplanRow["sdp_key"];
									$print_sd_mon=$print_dayplanRow["sd_mon"];
									$print_sd_tue=$print_dayplanRow["sd_tue"];
									$print_sd_wed=$print_dayplanRow["sd_wed"];
									$print_sd_thu=$print_dayplanRow["sd_thu"];
									$print_sd_frl=$print_dayplanRow["sd_frl"];
									$print_sd_sat=$print_dayplanRow["sd_sat"];
									$print_sd_sun=$print_dayplanRow["sd_sun"];
									
									
									if($print_sd_mon=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_tue=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_wed=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_thu=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_frl=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_sat=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_sun=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}
								
								}
							?>	

							<?php
								$study_rcSql="SELECT count(`sup_stuid`) as num_stu FROM `supplementary_sturs` 
											  WHERE `sup_stuid`='{$user_login}'  
											  and `sup_t`='{$data_term}'  
											  and `sup_l`='{$data_stu->IDLevel}' 
											  and `sup_year`='{$data_yaer}'";
								$study_rc=new row_evaluation($study_rcSql);
								foreach($study_rc->evaluation_array as $rc_key=>$study_print){
									$num_stu=$study_print["num_stu"];
									
									if($num_stu>=$count_study){ ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==12){ ?>
						<!--***********************************************************************-->
								
								
								
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>		
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>			
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>			
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>	
										
										

						<!--***********************************************************************-->			
							<?php	}    ?>



											
						<!--***********************************************************************-->				
							<?php	}else{  ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==12){ ?>
						<!--***********************************************************************-->
								
								
								<?php
								$supplementary_notstudySql="SELECT count(`notstudy_stu`) as num_noty FROM `supplementary_notstudy` 
															WHERE `notstudy_stu`='{$user_login}' 
															and `notstudy_t`='{$data_term}' 
															and `notstudy_l`='{$data_stu->IDLevel}'
															and `notstudy_y`='{$data_yaer}'";
								$supplementary_notstudy=new notrow_evaluation($supplementary_notstudySql);
								foreach($supplementary_notstudy->evaluation_array as $rc_key=>$supplementary_notstudyRow){
									$num_noty=$supplementary_notstudyRow["num_noty"];
									if($num_noty>=1){ ?>
										
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<input type="hidden" value="stu_not" name="stu_not">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form><br>				
										
							<?php   }else{ ?>
							
										<?php
										$set_supplementarySql="SELECT count(`supplementary_id`) as `set_count` 
															   from `supplementary_school` 
															   where `supplementary_t`='{$data_term}' 
															   and `supplementary_levelA`='{$data_stu->IDLevel}' 
															   and `supplementary_planA`='{$data_stu->rc_plan}' 
															   and `supplementary_not`='N' 
															   and `supplementary_off`='1'";
										$set_supplementary=new notrow_evaluation ($set_supplementarySql);
										foreach($set_supplementary->evaluation_array as $rc_key=>$set_supplementaryRow){
											$set_count=$set_supplementaryRow["set_count"];
											if($set_count>=1){ ?>
												<p><a href="./?evaluation_mod=supplementary&notstudy=notstudy"><button type="button" class="btn btn-success">ไม่ลงเรียนเพิ่ม</button></a></p>						
									<?php	}else{ ?> 

									<?php	}
										}
									
									?>	
							
										
							<?php	}
									
								}?>
								
								
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->

						<!--***********************************************************************-->			
							<?php	}    ?>				
						<!--***********************************************************************-->								
							<?php	}  ?>
								
						<?php	}      ?>						
												
												
											</center>
							
							</div>
						</div>	
										
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
									<?php	}elseif($call_registration->sr_academic=="N" and $call_registration->sr_activity=="Y"){//เรียนเฉราะกิจกรรม
																	
											}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="Y"){//เรียนทั้ง วิชาการ และ กิจกรรม ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

						<!--++++++++++++++++++++++++1+++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++--->
							<?php 
								$show_supp_stursSql="SELECT `sup_stuid`,`ss_activity`
													 FROM `supplementary_sturs`
													 WHERE `sup_t` = '{$data_term}'
													 AND `sup_l` = '{$data_stu->IDLevel}'
													 AND `sup_stuid`='{$user_login}';";
								$show_supp_stursRs=new notrow_evaluation($show_supp_stursSql);
								
								foreach($show_supp_stursRs->evaluation_array as $rc_key=>$show_supp_stursRow){
								
									
									
									if(isset($show_supp_stursRow["ss_activity"])){
										$ss_activity=$show_supp_stursRow["ss_activity"];
									}else{
										$ss_activity=Null;
									}
											
									switch ($ss_activity){
										case "cilk_true": ?>
						<!--+++++++++++++++++++++++++++++++++++++++--->

						<!--+++++++++++++++++++++++++++++++++++++++--->				
							<?php			break;
										case "cilk_flas": ?>
						<!--+++++++++++++++++++++++++++++++++++++++--->

						<!--+++++++++++++++++++++++++++++++++++++++--->				
							<?php			break;
										default: ?>
						<!--+++++++++++++++++++++++++++++++++++++++--->
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
									<input type="hidden" name="copy_yaer"  id="copy_yaer"  value="<?php echo $data_yaer;?>">
									<input type="hidden" name="copy_term"  id="copy_term"  value="<?php echo $data_term;?>">
									<input type="hidden" name="copy_login" id="copy_login" value="<?php echo $user_login;?>">
								<center>
									<input  type="image"  src="Template/global_assets/images/ac02.jpg" value="cilk_true" id="cilk_true3133">    
									<input  type="image"  src="Template/global_assets/images/ac01.jpg" value="cilk_flas"  id="cilk_flas3133">     
								</center>
							</div>
						</div><hr>
						<!--+++++++++++++++++++++++++++++++++++++++--->				
							<?php	}
								}
							?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++--->	


						<!--++++++++++++++++++++++++1+++++++++++++++-->
							<div id="show_cilk3133"></div>
						<!--++++++++++++++++++++++++1+++++++++++++++-->

						<!--+++++++++++++++++++++++++++++++++++++++--->
							<?php 
								$show_supp_stursSql="SELECT `sup_stuid`,`ss_activity`
													 FROM `supplementary_sturs`
													 WHERE `sup_t` = '{$data_term}'
													 AND `sup_l` = '{$data_stu->IDLevel}'
													 AND `sup_stuid`='{$user_login}'";
								$show_supp_stursRs=new notrow_evaluation($show_supp_stursSql);
								
								foreach($show_supp_stursRs->evaluation_array as $rc_key=>$show_supp_stursRow){
								
									
									
									if(isset($show_supp_stursRow["ss_activity"])){
										$ss_activity=$show_supp_stursRow["ss_activity"];
									}else{
										$ss_activity=null;
									}
									
									if(isset($show_supp_stursRow["ss_activity"])){
										$call_clik=$show_supp_stursRow["ss_activity"];
									}else{
										$call_clik=null;
									}
									
									switch ($ss_activity){
										case "cilk_true": ?>
						<!--+++++++++++++++++++++++++++++++++++++++--->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--supplementary_notstudy-->
						<?php
							$print_notstudySql="SELECT `notstudy_stu` FROM `supplementary_notstudy`
												WHERE `notstudy_stu`='{$user_login}' 
												and `notstudy_t`='{$data_term}' 
												and `notstudy_l`='{$data_stu->IDLevel}' 
												and `notstudy_y`='{$data_yaer}' 
												and `notstudy_p`='{$data_stu->rc_plan}'";
							$print_notstudyRs=new notrow_evaluation($print_notstudySql);
							foreach($print_notstudyRs->evaluation_array as $rc_key=>$print_notstudyRow){
								
								if(isset($print_notstudyRow["notstudy_stu"])){
									$notstudy_stu=$print_notstudyRow["notstudy_stu"];
								}else{
									$notstudy_stu=null;
								}
								
								if($notstudy_stu=="" or $notstudy_stu==null){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="panel panel-info">
									<div class="panel-heading">ทะเบียนเรียน เรียนเสริมเย็น</div>
									<div class="panel-body">

										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="table-responsive">
												
												   <table class="table table-hover">
													<thead>
													  <tr>	
															<th>วิชา</th>
										<?php
											$print_supp_day=new supplementary_day();
											if($print_supp_day->sd_mon=="ON"){ ?>
															<th>วันจันทร์</th>
										<?php	}elseif($print_supp_day->sd_mon=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}      ?>
											
										<?php	if($print_supp_day->sd_tue=="ON"){ ?>
															<th>วันอังคาร</th>
										<?php	}elseif($print_supp_day->sd_tue=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}	   ?>				
											
										<?php	if($print_supp_day->sd_wed=="ON"){ ?>
															<th>วันพุธ</th>
										<?php	}elseif($print_supp_day->sd_wed=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}	   ?>					
											
										<?php	if($print_supp_day->sd_thu=="ON"){?>
															<th>วันพฤหัสบดี</th>
										<?php	}elseif($print_supp_day->sd_thu=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>					
											
										<?php	if($print_supp_day->sd_frl=="ON"){?>
															<th>วันศุกร์</th>
										<?php	}elseif($print_supp_day->sd_frl=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>					
											
										<?php	if($print_supp_day->sd_sat=="ON"){?>
															<th>วันเสาร์</th>
										<?php	}elseif($print_supp_day->sd_sat=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>

										<?php	if($print_supp_day->sd_sun=="ON"){?>
															<th>วันอาทิตย์</th>
										<?php	}elseif($print_supp_day->sd_sun=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>				
													  </tr>
													  
													</thead>
													<tbody>
										<?php
											$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
																	   FROM `supplementary_subject` 
																	   WHERE `ss_t`='{$data_term}' 
																	   and `ss_l`='{$data_stu->IDLevel}' 
																	   and `ss_year`='{$data_yaer}'
																	   and `ss_academic`='1'";
											$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){  ?>
												
									
												<tr>
														<td><?php echo $supplementary_subjectRow["ss_txtth"];?></td>
														
										
										
										<?php
											$print_daysubject=new supplementary_daysubject($supplementary_subjectRow["ss_id"]);	
										?>
										
										
										
										
										<?php
											$supplementary_dayplanSql="SELECT `sdp_key`,`sd_plan`, `sd_group`,`sd_numA`,`sd_numB`
																	   FROM `supplementary_dayplan` 
																	   WHERE `sd_plan`='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
											$supplementary_dayplanRs=new notrow_evaluation($supplementary_dayplanSql);
											foreach($supplementary_dayplanRs->evaluation_array as $rc_key=>$supplementary_dayplanRow){
												$sdp_key=$supplementary_dayplanRow["sdp_key"];
												$sdp_group=$supplementary_dayplanRow["sd_group"];
												$sdp_plan=$supplementary_dayplanRow["sd_plan"];
												$sdp_numA=$supplementary_dayplanRow["sd_numA"];
												$sdp_numB=$supplementary_dayplanRow["sd_numB"];
												if($sdp_group==0 or $sdp_group==Null){

										
															$data_dayplanSql="SELECT `sdp_key` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$data_stu->rc_plan}' 
																			  and `sd_group`='0' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
													
												}else{
													$num_dayplanSql="SELECT `sdp_key`,`sd_numA`,`sd_numB`,`sd_group`  
																	 FROM `supplementary_dayplan` 
																	 WHERE `sd_plan` ='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
													$num_dayplanRs=new row_evaluation($num_dayplanSql);							
													foreach($num_dayplanRs->evaluation_array as $rc_key=>$num_dayplanRow){
														if($data_stu->rsc_num>=$num_dayplanRow["sd_numA"] and $data_stu->rsc_num<=$num_dayplanRow["sd_numB"]){
															$data_dayplanSql="SELECT `sdp_key`,`sd_plan`,`sd_group` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$data_stu->rc_plan}' 
																			  and `sd_group`='{$num_dayplanRow["sd_group"]}' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
														break;	
														}else{
															
														}
													}
													
												} 
											}
										?>					
										
										
							<?php
								$print_dayplanSql="SELECT `sdp_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` 
												   FROM `supplementary_dayplan` 
												   WHERE `sdp_key`='{$datasdp_key}'";
								$print_dayplanRs=new notrow_evaluation($print_dayplanSql);
								foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
									$print_sdp_key=$print_dayplanRow["sdp_key"];
									$print_sd_mon=$print_dayplanRow["sd_mon"];
									$print_sd_tue=$print_dayplanRow["sd_tue"];
									$print_sd_wed=$print_dayplanRow["sd_wed"];
									$print_sd_thu=$print_dayplanRow["sd_thu"];
									$print_sd_frl=$print_dayplanRow["sd_frl"];
									$print_sd_sat=$print_dayplanRow["sd_sat"];
									$print_sd_sun=$print_dayplanRow["sd_sun"];
								}
							?>	


						<?php
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
							$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

								if($call_dateactivity->day_activity_mon=="ON"){ ?>
								
														<td></td>		
														
						<?php	}elseif($call_dateactivity->day_activity_mon=="OFF"){ ?>
								
						<!----------------------------------------------------------------------->				
								<?php
												if($print_daysubject->sds_mon=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_mon=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_year`='{$data_yaer}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_mon`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_MonCount`,`subject_MonKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_MonCount=$supplementary_subjectRow["subject_MonCount"];
												$subject_MonKeep=$supplementary_subjectRow["subject_MonKeep"];
												if($subject_MonKeep>=$subject_MonCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Mon&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_MonKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>		
						<!--................................................................................-->



						<!--................................................................................-->



								
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_mon=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
								
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_mon=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->		

						<?php	}else{
								//***********************************************
							}
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
						?>


						<?php
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
							$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);
								if($call_dateactivity->day_activity_tue=="ON"){ ?>
								
														<td></td>		
														
						<?php	}elseif($call_dateactivity->day_activity_tue=="OFF"){ ?>
							
						<!----------------------------------------------------------------------->				
								<?php
												if($print_daysubject->sds_tue=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_tue=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_tuene`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_tuenesCount`,`subject_tuenesKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_tuenesCount=$supplementary_subjectRow["subject_tuenesCount"];
												$subject_tuenesKeep=$supplementary_subjectRow["subject_tuenesKeep"];
												if($subject_tuenesKeep>=$subject_tuenesCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=tuenes&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_tuenesKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_tue=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_tue=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->	
								
						<?php	}else{
								//***********************************************
							}
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
						?>




						<?php
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
							$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

								if($call_dateactivity->day_activity_wed=="ON"){ ?>
								
														<td></td>		
														
						<?php	}elseif($call_dateactivity->day_activity_wed=="OFF"){ ?>
						<!----------------------------------------------------------------------->		
						<!----------------------------------------------------------------------->				
								<?php
												if($print_daysubject->sds_wed=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_wed=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_wedne`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_WednesCount`,`subject_WednesKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_WednesCount=$supplementary_subjectRow["subject_WednesCount"];
												$subject_WednesKeep=$supplementary_subjectRow["subject_WednesKeep"];
												if($subject_WednesKeep>=$subject_WednesCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Wednes&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_WednesKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_wed=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_wed=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->


						<!----------------------------------------------------------------------->		
						<?php	}else{
								//***********************************************
							}
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
						?>

										
							
						<?php
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
							$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

								if($call_dateactivity->day_activity_thu=="ON"){ ?>
								
														<td></td>		
														
						<?php	}elseif($call_dateactivity->day_activity_thu=="OFF"){ ?>
						<!----------------------------------------------------------------------->		

						<!----------------------------------------------------------------------->				
								<?php
												if($print_daysubject->sds_thu=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_thu=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_thurs`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_ThursCount`,`subject_ThursKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_ThursCount=$supplementary_subjectRow["subject_ThursCount"];
												$subject_ThursKeep=$supplementary_subjectRow["subject_ThursKeep"];
												if($subject_ThursKeep>=$subject_ThursCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Thurs&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_ThursKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_thu=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_thu=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->
						<!----------------------------------------------------------------------->		
						<?php	}else{
								//***********************************************
							}
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
						?>
									
							
						<?php
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
							$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

								if($call_dateactivity->day_activity_frl=="ON"){ ?>
								
														<td></td>		
														
						<?php	}elseif($call_dateactivity->day_activity_frl=="OFF"){ ?>
						<!----------------------------------------------------------------------->		

						<!----------------------------------------------------------------------->				
								<?php
												if($print_daysubject->sds_frl=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_frl=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_fri`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_FriCount`,`subject_FriKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_FriCount=$supplementary_subjectRow["subject_FriCount"];
												$subject_FriKeep=$supplementary_subjectRow["subject_FriKeep"];
												if($subject_FriKeep>=$subject_FriCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=fri&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_FriKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_frl=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_frl=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->
						<!----------------------------------------------------------------------->		
						<?php	}else{
								//***********************************************
							}
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
						?>	
															
							
						<?php
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
							$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

								if($call_dateactivity->day_activity_sat=="ON"){ ?>
								
														<td></td>		
														
						<?php	}elseif($call_dateactivity->day_activity_sat=="OFF"){ ?>
						<!----------------------------------------------------------------------->		
						<!----------------------------------------------------------------------->				
								<?php
												if($print_daysubject->sds_sat=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_sat=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_sat`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_SaturCount`,`subject_SaturKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}' 
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_SaturCount=$supplementary_subjectRow["subject_SaturCount"];
												$subject_SaturKeep=$supplementary_subjectRow["subject_SaturKeep"];
												if($subject_SaturKeep>=$subject_SaturCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Satur&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_SaturKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_sat=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_sat=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->
						<!----------------------------------------------------------------------->		
						<?php	}else{
								//***********************************************
							}
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
						?>	
							
						<?php
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
							$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

								if($call_dateactivity->day_activity_sun=="ON"){ ?>
								
														<td></td>		
														
						<?php	}elseif($call_dateactivity->day_activity_sun=="OFF"){ ?>
						<!----------------------------------------------------------------------->		
						<!----------------------------------------------------------------------->				
								<?php
												if($print_daysubject->sds_sun=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_sun=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_sun`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_SunCount`,`subject_SunKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}' 
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_SunCount=$supplementary_subjectRow["subject_SunCount"];
												$subject_SunKeep=$supplementary_subjectRow["subject_SunKeep"];
												if($subject_SunKeep>=$subject_SunCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_SunKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_sun=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_sun=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->	
						<!----------------------------------------------------------------------->		
						<?php	}else{
								//***********************************************
							}
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
						?>
							
															
												</tr>	
											
											
										<?php	}  ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
												<tr>		
													<td>กิจกรรมตามความถนัดและสนใจ</td>
													
													
							<?php
								$print_activitySql="select `supplementary_subject`.`ss_txtth` 
													from `supplementary_subject` join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													where `supplementary_sturs`.`sup_t`='{$data_term}' 
													and   `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													and   `supplementary_sturs`.`sup_year`='{$data_yaer}'
													and   `supplementary_sturs`.`sup_stuid`='{$user_login}'
													and   `supplementary_subject`.`ss_academic`='0';";		
								$print_activityRs=new notrow_evaluation($print_activitySql);
								
								foreach($print_activityRs->evaluation_array as $rc_key=>$print_activityRow){
									
									@$print_dataTxtth=$print_activityRow["ss_txtth"];
									
									if($print_dataTxtth==null){ ?>
						<!----------------------------------------------------------------------->
													
														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

																if($call_dateactivity->day_activity_mon=="ON"){ ?>
																
																						<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_mon=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>
														
														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

																if($call_dateactivity->day_activity_tue=="ON"){ ?>
																
																						<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_tue=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>			

														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

																if($call_dateactivity->day_activity_wed=="ON"){ ?>
																
																						<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_wed=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>	
														
														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

																if($call_dateactivity->day_activity_wed=="ON"){ ?>
																
																						<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_wed=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>	

														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

																if($call_dateactivity->day_activity_thu=="ON"){ ?>
																
																						<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_thu=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>		

														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

																if($call_dateactivity->day_activity_frl=="ON"){ ?>
																
																						<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_frl=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>									
														
														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

																if($call_dateactivity->day_activity_sat=="ON"){ ?>
																
																						<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_sat=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>		

														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

																if($call_dateactivity->day_activity_sun=="ON"){ ?>
																
																						<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_sun=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>	
						<!----------------------------------------------------------------------->				
							<?php	}else{ ?>
						<!----------------------------------------------------------------------->
													
														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

																if($call_dateactivity->day_activity_mon=="ON"){ ?>
																
																						<td><?php echo $print_dataTxtth;?></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_mon=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>
														
														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

																if($call_dateactivity->day_activity_tue=="ON"){ ?>
																
																						<td><?php echo $print_dataTxtth;?></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_tue=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>			

														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

																if($call_dateactivity->day_activity_wed=="ON"){ ?>
																
																						<td><?php echo $print_dataTxtth;?></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_wed=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>	
														
														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

																if($call_dateactivity->day_activity_wed=="ON"){ ?>
																
																						<td><?php echo $print_dataTxtth;?></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_wed=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>	

														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

																if($call_dateactivity->day_activity_thu=="ON"){ ?>
																
																						<td><?php echo $print_dataTxtth;?></td>	
																						
														<?php	}elseif($call_dateactivity->day_activity_thu=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>		

														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

																if($call_dateactivity->day_activity_frl=="ON"){ ?>
																
																						<td><?php echo $print_dataTxtth;?></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_frl=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>									
														
														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

																if($call_dateactivity->day_activity_sat=="ON"){ ?>
																
																						<td><?php echo $print_dataTxtth;?></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_sat=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>		

														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

																if($call_dateactivity->day_activity_sun=="ON"){ ?>
																
																						<td><?php echo $print_dataTxtth;?></td>	
																						
														<?php	}elseif($call_dateactivity->day_activity_sun=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>	
						<!----------------------------------------------------------------------->				
							<?php	}
								}
							?>						
													
														
														
												</tr>	
												

									
													</tbody>
												  </table>
												
												
												
												
												
												</div>
											</div>
										</div>

									</div>
								</div>	
							</div>
							
						</div>


						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
						<?php	}else{ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
						<?php	} ?>
						<?php	} ?>
						<!--supplementary_notstudy-->

							

						<div class="row">	
								
							<div class="col-<?php echo $grid;?>-12">
							
												<center>
												
												
										<?php
											$supplementary_dayplanSql="SELECT `sdp_key`,`sd_plan`, `sd_group`,`sd_numA`,`sd_numB`,`sd_class`
																	   FROM `supplementary_dayplan` 
																	   WHERE `sd_plan`='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
											$supplementary_dayplanRs=new notrow_evaluation($supplementary_dayplanSql);
											foreach($supplementary_dayplanRs->evaluation_array as $rc_key=>$supplementary_dayplanRow){
												$sdp_key=$supplementary_dayplanRow["sdp_key"];
												$sdp_group=$supplementary_dayplanRow["sd_group"];
												$sdp_plan=$supplementary_dayplanRow["sd_plan"];
												$sdp_numA=$supplementary_dayplanRow["sd_numA"];
												$sdp_numB=$supplementary_dayplanRow["sd_numB"];
												if($sdp_group==0 or $sdp_group==Null){

										
															$data_dayplanSql="SELECT `sdp_key` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'
																			  and `sd_group`='0'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
													
												}else{
													$num_dayplanSql="SELECT `sdp_key`,`sd_numA`,`sd_numB`,`sd_group`  
																	 FROM `supplementary_dayplan` 
																	 WHERE `sd_plan` ='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
													$num_dayplanRs=new row_evaluation($num_dayplanSql);							
													foreach($num_dayplanRs->evaluation_array as $rc_key=>$num_dayplanRow){
														if($data_stu->rsc_num>=$num_dayplanRow["sd_numA"] and $data_stu->rsc_num<=$num_dayplanRow["sd_numB"]){
															$data_dayplanSql="SELECT `sdp_key`,`sd_plan`,`sd_group` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$data_stu->rc_plan}' 
																			  and `sd_group`='{$num_dayplanRow["sd_group"]}' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
														break;	
														}else{
															
														}
													}
													
												}
											}
										?>


							<?php
								$print_dayplanSql="SELECT `sdp_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` 
												   FROM `supplementary_dayplan` 
												   WHERE `sdp_key`='{$datasdp_key}'";
								$print_dayplanRs=new notrow_evaluation($print_dayplanSql);
								$count_study=0;
								foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
									$print_sdp_key=$print_dayplanRow["sdp_key"];
									$print_sd_mon=$print_dayplanRow["sd_mon"];
									$print_sd_tue=$print_dayplanRow["sd_tue"];
									$print_sd_wed=$print_dayplanRow["sd_wed"];
									$print_sd_thu=$print_dayplanRow["sd_thu"];
									$print_sd_frl=$print_dayplanRow["sd_frl"];
									$print_sd_sat=$print_dayplanRow["sd_sat"];
									$print_sd_sun=$print_dayplanRow["sd_sun"];
									
									
									if($print_sd_mon=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_tue=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_wed=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_thu=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_frl=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_sat=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_sun=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}
							
								}
							?>	

							<?php
								$count_study=($count_study-$call_dateactivity->count_activityON)+1;
							
								$study_rcSql="SELECT count(`sup_stuid`) as num_stu FROM `supplementary_sturs` 
											  WHERE `sup_stuid`='{$user_login}'  
											  and `sup_t`='{$data_term}'  
											  and `sup_l`='{$data_stu->IDLevel}' 
											  and `sup_year`='{$data_yaer}'";
								$study_rc=new row_evaluation($study_rcSql);
								foreach($study_rc->evaluation_array as $rc_key=>$study_print){
									$num_stu=$study_print["num_stu"];
									
									if($num_stu>=$count_study){ ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==12){ ?>
						<!--***********************************************************************-->
								
								
								
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>		
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>			
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>			
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>	
										
										

						<!--***********************************************************************-->			
							<?php	}    ?>



											
						<!--***********************************************************************-->				
							<?php	}else{  ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==12){ ?>
						<!--***********************************************************************-->
								
								
								<?php
								$supplementary_notstudySql="SELECT count(`notstudy_stu`) as num_noty FROM `supplementary_notstudy` 
															WHERE `notstudy_stu`='{$user_login}' 
															and `notstudy_t`='{$data_term}' 
															and `notstudy_l`='{$data_stu->IDLevel}'
															and `notstudy_y`='{$data_yaer}'";
								$supplementary_notstudy=new notrow_evaluation($supplementary_notstudySql);
								foreach($supplementary_notstudy->evaluation_array as $rc_key=>$supplementary_notstudyRow){
									$num_noty=$supplementary_notstudyRow["num_noty"];
									if($num_noty>=1){ ?>
										
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<input type="hidden" value="stu_not" name="stu_not">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form><br>				
										
							<?php   }else{ ?>
							
										<?php
										$set_supplementarySql="SELECT count(`supplementary_id`) as `set_count` 
															   from `supplementary_school` 
															   where `supplementary_t`='{$data_term}' 
															   and `supplementary_levelA`='{$data_stu->IDLevel}' 
															   and `supplementary_planA`='{$data_stu->rc_plan}' 
															   and `supplementary_not`='N' 
															   and `supplementary_off`='1'";
										$set_supplementary=new notrow_evaluation ($set_supplementarySql);
										foreach($set_supplementary->evaluation_array as $rc_key=>$set_supplementaryRow){
											$set_count=$set_supplementaryRow["set_count"];
											if($set_count>=1){ ?>
												<p><a href="./?evaluation_mod=supplementary&notstudy=notstudy"><button type="button" class="btn btn-success">ไม่ลงเรียนเพิ่ม</button></a></p>						
									<?php	}else{ ?> 

									<?php	}
										}
									
									?>	
							
										
							<?php	}
									
								}?>
								
								
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->

						<!--***********************************************************************-->			
							<?php	}    ?>				
						<!--***********************************************************************-->								
							<?php	}  ?>
								
						<?php	}      ?>						
												
												
											</center>
							
							</div>
						</div>	

						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++--->				
							<?php			break;
										case "cilk_flas": ?>
						<!--+++++++++++++++++++++++++++++++++++++++--->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

						<!--supplementary_notstudy-->
						<?php
							$print_notstudySql="SELECT `notstudy_stu` FROM `supplementary_notstudy`
												WHERE `notstudy_stu`='{$user_login}' 
												and `notstudy_t`='{$data_term}' 
												and `notstudy_l`='{$data_stu->IDLevel}' 
												and `notstudy_y`='{$data_yaer}' 
												and `notstudy_p`='{$data_stu->rc_plan}'";
							$print_notstudyRs=new notrow_evaluation($print_notstudySql);
							foreach($print_notstudyRs->evaluation_array as $rc_key=>$print_notstudyRow){
								
								if(isset($print_notstudyRow["notstudy_stu"])){
									$notstudy_stu=$print_notstudyRow["notstudy_stu"];
								}else{
									$notstudy_stu=null;
								}
								
								if($notstudy_stu=="" or $notstudy_stu==null){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="panel panel-info">
									<div class="panel-heading">ทะเบียนเรียน เรียนเสริมเย็น</div>
									<div class="panel-body">

										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="table-responsive">
												
												   <table class="table table-hover">
													<thead>
													  <tr>	
															<th>วิชา</th>
										<?php
											$print_supp_day=new supplementary_day();
											if($print_supp_day->sd_mon=="ON"){ ?>
															<th>วันจันทร์</th>
										<?php	}elseif($print_supp_day->sd_mon=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}      ?>
											
										<?php	if($print_supp_day->sd_tue=="ON"){ ?>
															<th>วันอังคาร</th>
										<?php	}elseif($print_supp_day->sd_tue=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}	   ?>				
											
										<?php	if($print_supp_day->sd_wed=="ON"){ ?>
															<th>วันพุธ</th>
										<?php	}elseif($print_supp_day->sd_wed=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}	   ?>					
											
										<?php	if($print_supp_day->sd_thu=="ON"){?>
															<th>วันพฤหัสบดี</th>
										<?php	}elseif($print_supp_day->sd_thu=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>					
											
										<?php	if($print_supp_day->sd_frl=="ON"){?>
															<th>วันศุกร์</th>
										<?php	}elseif($print_supp_day->sd_frl=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>					
											
										<?php	if($print_supp_day->sd_sat=="ON"){?>
															<th>วันเสาร์</th>
										<?php	}elseif($print_supp_day->sd_sat=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>

										<?php	if($print_supp_day->sd_sun=="ON"){?>
															<th>วันอาทิตย์</th>
										<?php	}elseif($print_supp_day->sd_sun=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>				
													  </tr>
													  
													</thead>
													<tbody>
										<?php
											$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
																	   FROM `supplementary_subject` 
																	   WHERE `ss_t`='{$data_term}' 
																	   and `ss_l`='{$data_stu->IDLevel}' 
																	   and `ss_year`='{$data_yaer}' 
																	   and `ss_academic`='1'";
											$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){  ?>
												
									
												<tr>
														<td><?php echo $supplementary_subjectRow["ss_txtth"];?></td>
														
										
										
										<?php
											$print_daysubject=new supplementary_daysubject($supplementary_subjectRow["ss_id"]);	
										?>
										
										
										
										
										<?php
											$supplementary_dayplanSql="SELECT `sdp_key`,`sd_plan`, `sd_group`,`sd_numA`,`sd_numB`
																	   FROM `supplementary_dayplan` 
																	   WHERE `sd_plan`='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
											$supplementary_dayplanRs=new notrow_evaluation($supplementary_dayplanSql);
											foreach($supplementary_dayplanRs->evaluation_array as $rc_key=>$supplementary_dayplanRow){
												$sdp_key=$supplementary_dayplanRow["sdp_key"];
												$sdp_group=$supplementary_dayplanRow["sd_group"];
												$sdp_plan=$supplementary_dayplanRow["sd_plan"];
												$sdp_numA=$supplementary_dayplanRow["sd_numA"];
												$sdp_numB=$supplementary_dayplanRow["sd_numB"];
												if($sdp_group==0 or $sdp_group==Null){

										
															$data_dayplanSql="SELECT `sdp_key` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$data_stu->rc_plan}' 
																			  and `sd_group`='0' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
													
												}else{
													$num_dayplanSql="SELECT `sdp_key`,`sd_numA`,`sd_numB`,`sd_group`  
																	 FROM `supplementary_dayplan` 
																	 WHERE `sd_plan` ='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
													$num_dayplanRs=new row_evaluation($num_dayplanSql);							
													foreach($num_dayplanRs->evaluation_array as $rc_key=>$num_dayplanRow){
														if($data_stu->rsc_num>=$num_dayplanRow["sd_numA"] and $data_stu->rsc_num<=$num_dayplanRow["sd_numB"]){
															$data_dayplanSql="SELECT `sdp_key`,`sd_plan`,`sd_group` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$data_stu->rc_plan}' 
																			  and `sd_group`='{$num_dayplanRow["sd_group"]}' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
														break;	
														}else{
															
														}
													}
													
												}
											}
										?>					
										
										
							<?php
								$print_dayplanSql="SELECT `sdp_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` 
												   FROM `supplementary_dayplan` 
												   WHERE `sdp_key`='{$datasdp_key}'";
								$print_dayplanRs=new notrow_evaluation($print_dayplanSql);
								foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
									$print_sdp_key=$print_dayplanRow["sdp_key"];
									$print_sd_mon=$print_dayplanRow["sd_mon"];
									$print_sd_tue=$print_dayplanRow["sd_tue"];
									$print_sd_wed=$print_dayplanRow["sd_wed"];
									$print_sd_thu=$print_dayplanRow["sd_thu"];
									$print_sd_frl=$print_dayplanRow["sd_frl"];
									$print_sd_sat=$print_dayplanRow["sd_sat"];
									$print_sd_sun=$print_dayplanRow["sd_sun"];
								}
							?>	



										
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_mon=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_mon=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_year`='{$data_yaer}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_mon`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_MonCount`,`subject_MonKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_MonCount=$supplementary_subjectRow["subject_MonCount"];
												$subject_MonKeep=$supplementary_subjectRow["subject_MonKeep"];
												if($subject_MonKeep>=$subject_MonCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Mon&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_MonKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_mon=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
								
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_mon=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->				
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_tue=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_tue=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_tues`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_TuesCount`,`subject_TuesKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}' 
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_TuesCount=$supplementary_subjectRow["subject_TuesCount"];
												$subject_TuesKeep=$supplementary_subjectRow["subject_TuesKeep"];
												if($subject_TuesKeep>=$subject_TuesCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Tues&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_TuesKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_tue=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_tue=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->									
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_wed=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_wed=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_wedne`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_WednesCount`,`subject_WednesKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_WednesCount=$supplementary_subjectRow["subject_WednesCount"];
												$subject_WednesKeep=$supplementary_subjectRow["subject_WednesKeep"];
												if($subject_WednesKeep>=$subject_WednesCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Wednes&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_WednesKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_wed=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_wed=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->									
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_thu=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_thu=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_thurs`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_ThursCount`,`subject_ThursKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_ThursCount=$supplementary_subjectRow["subject_ThursCount"];
												$subject_ThursKeep=$supplementary_subjectRow["subject_ThursKeep"];
												if($subject_ThursKeep>=$subject_ThursCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Thurs&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_ThursKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_thu=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_thu=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->	
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_frl=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_frl=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_fri`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_FriCount`,`subject_FriKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}' 
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_FriCount=$supplementary_subjectRow["subject_FriCount"];
												$subject_FriKeep=$supplementary_subjectRow["subject_FriKeep"];
												if($subject_FriKeep>=$subject_FriCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=fri&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_FriKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_frl=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_frl=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_sat=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_sat=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_sat`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_SaturCount`,`subject_SaturKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_SaturCount=$supplementary_subjectRow["subject_SaturCount"];
												$subject_SaturKeep=$supplementary_subjectRow["subject_SaturKeep"];
												if($subject_SaturKeep>=$subject_SaturCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Satur&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_SaturKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_sat=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_sat=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->	
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_sun=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_sun=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_sun`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_SunCount`,`subject_SunKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_SunCount=$supplementary_subjectRow["subject_SunCount"];
												$subject_SunKeep=$supplementary_subjectRow["subject_SunKeep"];
												if($subject_SunKeep>=$subject_SunCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_SunKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_sun=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_sun=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->										
												</tr>	
											
											
										<?php	}  ?>
												
												
												

									
													</tbody>
												  </table>
												
												
												
												
												
												</div>
											</div>
										</div>

									</div>
								</div>	
							</div>
							
						</div>


						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
						<?php	}else{ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
						<?php	} ?>
						<?php	} ?>
						<!--supplementary_notstudy-->

							

						<div class="row">	
								
							<div class="col-<?php echo $grid;?>-12">
							
												<center>
												
												
										<?php
											$supplementary_dayplanSql="SELECT `sdp_key`,`sd_plan`, `sd_group`,`sd_numA`,`sd_numB`,`sd_class`
																	   FROM `supplementary_dayplan` 
																	   WHERE `sd_plan`='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
											$supplementary_dayplanRs=new notrow_evaluation($supplementary_dayplanSql);
											foreach($supplementary_dayplanRs->evaluation_array as $rc_key=>$supplementary_dayplanRow){
												$sdp_key=$supplementary_dayplanRow["sdp_key"];
												$sdp_group=$supplementary_dayplanRow["sd_group"];
												$sdp_plan=$supplementary_dayplanRow["sd_plan"];
												$sdp_numA=$supplementary_dayplanRow["sd_numA"];
												$sdp_numB=$supplementary_dayplanRow["sd_numB"];
												if($sdp_group==0 or $sdp_group==Null){

										
															$data_dayplanSql="SELECT `sdp_key` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'
																			  and `sd_group`='0'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
													
												}else{
													$num_dayplanSql="SELECT `sdp_key`,`sd_numA`,`sd_numB`,`sd_group`  
																	 FROM `supplementary_dayplan` 
																	 WHERE `sd_plan` ='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
													$num_dayplanRs=new row_evaluation($num_dayplanSql);							
													foreach($num_dayplanRs->evaluation_array as $rc_key=>$num_dayplanRow){
														if($data_stu->rsc_num>=$num_dayplanRow["sd_numA"] and $data_stu->rsc_num<=$num_dayplanRow["sd_numB"]){
															$data_dayplanSql="SELECT `sdp_key`,`sd_plan`,`sd_group` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$data_stu->rc_plan}' 
																			  and `sd_group`='{$num_dayplanRow["sd_group"]}' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
														break;	
														}else{
															
														}
													}
													
												}
											}
										?>


							<?php
								$print_dayplanSql="SELECT `sdp_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` 
												   FROM `supplementary_dayplan` 
												   WHERE `sdp_key`='{$datasdp_key}'";
								$print_dayplanRs=new notrow_evaluation($print_dayplanSql);
								$count_study=0;
								foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
									$print_sdp_key=$print_dayplanRow["sdp_key"];
									$print_sd_mon=$print_dayplanRow["sd_mon"];
									$print_sd_tue=$print_dayplanRow["sd_tue"];
									$print_sd_wed=$print_dayplanRow["sd_wed"];
									$print_sd_thu=$print_dayplanRow["sd_thu"];
									$print_sd_frl=$print_dayplanRow["sd_frl"];
									$print_sd_sat=$print_dayplanRow["sd_sat"];
									$print_sd_sun=$print_dayplanRow["sd_sun"];
									
									
									if($print_sd_mon=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_tue=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_wed=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_thu=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_frl=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_sat=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_sun=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}
								
								}
							?>	

							<?php
								$study_rcSql="SELECT count(`sup_stuid`) as num_stu FROM `supplementary_sturs` 
											  WHERE `sup_stuid`='{$user_login}'  
											  and `sup_t`='{$data_term}'  
											  and `sup_l`='{$data_stu->IDLevel}' 
											  and `sup_year`='{$data_yaer}'";
								$study_rc=new row_evaluation($study_rcSql);
								foreach($study_rc->evaluation_array as $rc_key=>$study_print){
									$num_stu=$study_print["num_stu"];
									
									if($num_stu>=$count_study){ ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==12){ ?>
						<!--***********************************************************************-->
								
								
								
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>		
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>			
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>			
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>	
										
										

						<!--***********************************************************************-->			
							<?php	}    ?>



											
						<!--***********************************************************************-->				
							<?php	}else{  ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==12){ ?>
						<!--***********************************************************************-->
								
								
								<?php
								$supplementary_notstudySql="SELECT count(`notstudy_stu`) as num_noty FROM `supplementary_notstudy` 
															WHERE `notstudy_stu`='{$user_login}' 
															and `notstudy_t`='{$data_term}' 
															and `notstudy_l`='{$data_stu->IDLevel}'
															and `notstudy_y`='{$data_yaer}'";
								$supplementary_notstudy=new notrow_evaluation($supplementary_notstudySql);
								foreach($supplementary_notstudy->evaluation_array as $rc_key=>$supplementary_notstudyRow){
									$num_noty=$supplementary_notstudyRow["num_noty"];
									if($num_noty>=1){ ?>
										
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<input type="hidden" value="stu_not" name="stu_not">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form><br>				
										
							<?php   }else{ ?>
							
										<?php
										$set_supplementarySql="SELECT count(`supplementary_id`) as `set_count` 
															   from `supplementary_school` 
															   where `supplementary_t`='{$data_term}' 
															   and `supplementary_levelA`='{$data_stu->IDLevel}' 
															   and `supplementary_planA`='{$data_stu->rc_plan}' 
															   and `supplementary_not`='N' 
															   and `supplementary_off`='1'";
										$set_supplementary=new notrow_evaluation ($set_supplementarySql);
										foreach($set_supplementary->evaluation_array as $rc_key=>$set_supplementaryRow){
											$set_count=$set_supplementaryRow["set_count"];
											if($set_count>=1){ ?>
												<p><a href="./?evaluation_mod=supplementary&notstudy=notstudy"><button type="button" class="btn btn-success">ไม่ลงเรียนเพิ่ม</button></a></p>						
									<?php	}else{ ?> 

									<?php	}
										}
									
									?>	
							
										
							<?php	}
									
								}?>
								
								
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->

						<!--***********************************************************************-->			
							<?php	}    ?>				
						<!--***********************************************************************-->								
							<?php	}  ?>
								
						<?php	}      ?>						
												
												
											</center>
							
							</div>
						</div>	
						<!--+++++++++++++++++++++++++++++++++++++++--->				
							<?php			break;
										default:
										//****************************
									}
								}
							?>
						<!--+++++++++++++++++++++++++++++++++++++++--->







										
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
									<?php	}else{ ?>
						<!--***************************************************************************************************-->	
								<div class="row">
									<div class="col-<?php echo $grid;?>-12">
									
									
									</div>
								</div>				
						<!--***************************************************************************************************-->					
									<?php	}      ?>
						<!--///////////////////////////////////////////////////////////////////////////////////////////////////////-->	

						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						
		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<?php
							if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){
								//------------------------------------------------------------------------------------------------------
							}else{ ?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--++++++++++++++++++++++++++++++++++++++++-->
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">
									<center><input  type="image"  src="Template/global_assets/images/ac03.jpg" data-toggle="modal" data-target="#myModal"></center>
								</div>
							</div><hr>
						<!--++++++++++++++++++++++++++++++++++++++++-->						
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
					<?php	}?>
		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				

							<div id="myModal" class="modal fade" role="dialog">
								<div class="modal-dialog">

								<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">รายการที่ลงทะเบียน</h4>
										</div>
										<div class="modal-body">
							<form>			
											<div class="row">
												<div class="col-<?php echo $grid;?>-12">
													<div class="table-responsive">
														  <table class="table table-hover">
															<thead>
															  <tr>
																<th>ลำดับ</th>
																<th>รายวิชา / กิจกรรมตามความถนัดและสนใจ</th>
																<th>ดำเนินการ</th>
															  </tr>
															</thead>
															<tbody>
															
													<?php
														$subject_printSql="select `supplementary_subject`.`ss_txtth`,`supplementary_subject`.`ss_id` 
																		   from `supplementary_subject` 
																		   join `supplementary_sturs` on (`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
																		   where`supplementary_sturs`.`sup_stuid`='{$user_login}' 
																		   and `supplementary_sturs`.`sup_t`='{$data_term}'
																		   and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
																		   and  `supplementary_sturs`.`sup_year`='{$data_yaer}'";
														$subject_printRs=new row_evaluation($subject_printSql);
														$count_subject_print=1;
														foreach($subject_printRs->evaluation_array as $rc_key=>$subject_printRow){ ?>
															
															  <tr>
																<td><?php echo $count_subject_print;?></td>
																<td><?php echo $subject_printRow["ss_txtth"];?></td>
																<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $subject_printRow["ss_id"];?>&system=system"><b style="color:#0623FB">ยกเลิกรายวิชานี้</b></a></td>
															  </tr>	
															  
												<?php	$count_subject_print=$count_subject_print+1;}?>		
															

															  
															</tbody>
														  </table>
													</div>
												</div>
											</div>
								</form>			
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
										</div>
									</div>

								</div>
							</div>



						<!--++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
							
						<!--///////////////////////////////////////////////////////////////////////////////////////////////////////-->		

						<?php	}else{ ?>
						<!--*******************************************************************************************************-->
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<div class="alert alert-danger">
												<p><strong>ปิดระบบ...</strong><!--นักเรียนระดับมัธยมศึกษา สามารถเริ่มลงทะเบียนเรียนเสริมนอกเวลาเรียน ภาคเรียนที่ 2 ปีการศึกษา 2563 ได้ <u>ตั้งแต่วันที่ 26 ตุลาคม 2563</u> เป็นต้นไป</p>-->		
											</div>	
										</div>
									</div>	
						<!--*******************************************************************************************************-->				
						<?php	}      ?>	
								
								<?php	}elseif($data_stu->IDLevel>=41 and $data_stu->IDLevel<=43){ ?>
						<!--*******************************************************************************************************-->	




						<?php
								$off_system="ON";
								if($off_system=="ON"){ ?>
						<!--*******************************************************************************************************-->

							
						<!--///////////////////////////////////////////////////////////////////////////////////////////////////////-->
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">
									<div class="panel panel-success">
										<div class="panel-heading"><center><h5>เหลือเวลาลงทะเบียนเรียน เรียนเสริมเย็น<div id="demo"></div></h5></center></div>
									</div>
								</div>
							</div><hr>
						<!------------------------------------------------------------------------------------------------------->

						<!------------------------------------------------------------------------------------------------------->
									<?php
									
											if($data_stu->rc_plan==13){
												$copy_plan=$data_stu->rc_plan;
											}else{
												$copy_plan=14;
											}
									
									
											//sr_academic -> วิชาการ
											//sr_activity -> กิจกรรม
											$call_registration=new supplementary_registration($data_stu->IDLevel,$copy_plan);
											if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){//รวมทั้งหมด ?>

		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																																
		<!------------------------------------------------------------------------------------------------------->					
				
			<form name="stu_supplementary" accept-charset="UTF-8" method="post" action="./?evaluation_mod=supplementary">

				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="panel panel-info">
						<div class="panel-heading">ลงทะเบียน โครงการสอนเสริมนอกเวลาเรียน ภาคเรียนที่&nbsp;<?php echo $data_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_yaer;?>&nbsp;</div>
							<div class="panel-body">
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
										if($count_use>=1){ ?>
				<!--******************************************************************************************************-->	
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
															$pay_supplementarySql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` FROM `supplementary_school` WHERE  `ss_id`='{$print_subjectId}'";
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
											<center><button type="submit" name="stu_cilk" value="cilk_yes" class="btn btn-danger">ยกเลิกลงทะเบียน</button></center>						
										</div>
									</div>
				<!--******************************************************************************************************-->										
								<?php		}else{ ?>
				<!--******************************************************************************************************-->	
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<center><button type="submit" name="stu_cilk" value="cilk_no" class="btn btn-success">ลงทะเบียน</button></center>						
										</div>
									</div>					
				<!--******************************************************************************************************-->													
								<?php		}							
									} ?>				
							</div>
						</div>		
					</div>
				</div>	

				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="panel panel-info">
							<div class="panel-heading">ค่าลงทะเบียน โครงการสอนเสริมนอกเวลาเรียน ภาคเรียนที่&nbsp;<?php echo $data_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_yaer;?>&nbsp;</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-<?php echo $grid;?>-12">
										<div class="table-responsive">
											<table class="table table-hover">
												<thead>
													<tr>
														<th><center>รายการ</center></th>
														<th><center>ค่าลงทะเบียน</center></th>
														<th><center>หมายเหตุ</center></th>
													</tr>
												</thead>
												<tbody> 
											<?php 
												$call_schoolSql="SELECT `supplementary_txt`,`supplementary_pay`,`supplementary_levelA`,`supplementary_levelB`,`supplementary_note` 
																 FROM `supplementary_school` 
																 WHERE `supplementary_t`='{$data_term}' 
																 and `supplementary_planA`>='{$copy_plan}' 
																 and `supplementary_planB`<='{$copy_plan}'
																 and `supplementary_levelA`>='{$data_stu->IDLevel}'
																 and `supplementary_levelB`<='{$data_stu->IDLevel}'
																 and `supplementary_not`='N'
																 and `supplementary_off`='0'
																 and `ss_pay`='ALLPAY';";
												$call_schoolRs=new row_evaluation($call_schoolSql);
												foreach($call_schoolRs->evaluation_array as $rc_key=>$call_schoolRow){ 
												
													if($data_stu->IDLevel>=$call_schoolRow["supplementary_levelA"] and $data_stu->IDLevel<=$call_schoolRow["supplementary_levelB"]){ ?>
			<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
													<tr>
														<td><?php echo $call_schoolRow["supplementary_txt"];?></td>
														
											<?php
												$sud_grouppay=new print_stu_grouppay($user_login,$data_yaer,$copy_plan,$data_stu->IDLevel);
												
													if($sud_grouppay->ps_id=="11"){ ?>
														<td>เรียนพรี</td>
											<?php	}elseif($sud_grouppay->ps_id=="12"){ ?>
														<td>เรียนพรี</td>
											<?php	}else{ ?>
														<td><?php echo number_format($call_schoolRow["supplementary_pay"], 2, '.', ',')." บาท";?></td>
											<?php	}?>			
														
														<td><?php echo $call_schoolRow["supplementary_note"];?></td>
													</tr>
			<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
											<?php	}else{
														//********************************************************************************************************************************
													}
												} ?>	
												
												</tbody>
										  </table>
										</div>						
									</div>
								</div>				
							</div>
						</div>
					</div>
				</div>
			</form>
				
			<!------------------------------------------------------------------------------------------------------->															
																		
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

																		
									<?php	}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="N"){//เรียนเฉราะวิชาการ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
						<!--supplementary_notstudy-->
						<?php
							$print_notstudySql="SELECT `notstudy_stu` FROM `supplementary_notstudy`
												WHERE `notstudy_stu`='{$user_login}' 
												and `notstudy_t`='{$data_term}' 
												and `notstudy_l`='{$data_stu->IDLevel}' 
												and `notstudy_y`='{$data_yaer}' 
												and `notstudy_p`='{$copy_plan}'";
							$print_notstudyRs=new notrow_evaluation($print_notstudySql);
							foreach($print_notstudyRs->evaluation_array as $rc_key=>$print_notstudyRow){
								
								if(isset($print_notstudyRow["notstudy_stu"])){
									$notstudy_stu=$print_notstudyRow["notstudy_stu"];
								}else{
									$notstudy_stu=null;
								}
								
								if($notstudy_stu==""){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="panel panel-info">
									<div class="panel-heading">ทะเบียนเรียน เรียนเสริมเย็น</div>
									<div class="panel-body">

										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="table-responsive">
												
												   <table class="table table-hover">
													<thead>
													  <tr>	
															<th>วิชา</th>
										<?php
											$print_supp_day=new supplementary_day();
											if($print_supp_day->sd_mon=="ON"){ ?>
															<th>วันจันทร์</th>
										<?php	}elseif($print_supp_day->sd_mon=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}      ?>
											
										<?php	if($print_supp_day->sd_tue=="ON"){ ?>
															<th>วันอังคาร</th>
										<?php	}elseif($print_supp_day->sd_tue=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}	   ?>				
											
										<?php	if($print_supp_day->sd_wed=="ON"){ ?>
															<th>วันพุธ</th>
										<?php	}elseif($print_supp_day->sd_wed=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}	   ?>					
											
										<?php	if($print_supp_day->sd_thu=="ON"){?>
															<th>วันพฤหัสบดี</th>
										<?php	}elseif($print_supp_day->sd_thu=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>					
											
										<?php	if($print_supp_day->sd_frl=="ON"){?>
															<th>วันศุกร์</th>
										<?php	}elseif($print_supp_day->sd_frl=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>					
											
										<?php	if($print_supp_day->sd_sat=="ON"){?>
															<th>วันเสาร์</th>
										<?php	}elseif($print_supp_day->sd_sat=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>

										<?php	if($print_supp_day->sd_sun=="ON"){?>
															<th>วันอาทิตย์</th>
										<?php	}elseif($print_supp_day->sd_sun=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>				
													  </tr>
													  
													</thead>
													<tbody>
										<?php
											$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
																	   FROM `supplementary_subject` 
																	   WHERE `ss_t`='{$data_term}' 
																	   and `ss_l`='{$data_stu->IDLevel}' 
																	   and `ss_year`='{$data_yaer}' 
																	   and `ss_academic`='1'";
											$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){  ?>
												
									
												<tr>
														<td><?php echo $supplementary_subjectRow["ss_txtth"];?></td>
														
										
										
										<?php
											$print_daysubject=new supplementary_daysubject($supplementary_subjectRow["ss_id"]);	
										?>
										
										
										
										
										<?php
											$supplementary_dayplanSql="SELECT `sdp_key`,`sd_plan`, `sd_group`,`sd_numA`,`sd_numB`
																	   FROM `supplementary_dayplan` 
																	   WHERE `sd_plan`='{$copy_plan}' and `sd_class`='{$data_stu->IDLevel}'";
											$supplementary_dayplanRs=new notrow_evaluation($supplementary_dayplanSql);
											foreach($supplementary_dayplanRs->evaluation_array as $rc_key=>$supplementary_dayplanRow){
												$sdp_key=$supplementary_dayplanRow["sdp_key"];
												$sdp_group=$supplementary_dayplanRow["sd_group"];
												$sdp_plan=$supplementary_dayplanRow["sd_plan"];
												$sdp_numA=$supplementary_dayplanRow["sd_numA"];
												$sdp_numB=$supplementary_dayplanRow["sd_numB"];
												if($sdp_group==0 or $sdp_group==Null){

										
															$data_dayplanSql="SELECT `sdp_key` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$copy_plan}' 
																			  and `sd_group`='0' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
													
												}else{
													$num_dayplanSql="SELECT `sdp_key`,`sd_numA`,`sd_numB`,`sd_group`  
																	 FROM `supplementary_dayplan` 
																	 WHERE `sd_plan` ='{$copy_plan}' and `sd_class`='{$data_stu->IDLevel}'";
													$num_dayplanRs=new row_evaluation($num_dayplanSql);							
													foreach($num_dayplanRs->evaluation_array as $rc_key=>$num_dayplanRow){
														if($data_stu->rsc_num>=$num_dayplanRow["sd_numA"] and $data_stu->rsc_num<=$num_dayplanRow["sd_numB"]){
															$data_dayplanSql="SELECT `sdp_key`,`sd_plan`,`sd_group` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$copy_plan}' 
																			  and `sd_group`='{$num_dayplanRow["sd_group"]}' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
														break;	
														}else{
															
														}
													}
													
												}
											}
										?>					
										
										
							<?php
								$print_dayplanSql="SELECT `sdp_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` 
												   FROM `supplementary_dayplan` 
												   WHERE `sdp_key`='{$datasdp_key}'";
								$print_dayplanRs=new notrow_evaluation($print_dayplanSql);
								foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
									$print_sdp_key=$print_dayplanRow["sdp_key"];
									$print_sd_mon=$print_dayplanRow["sd_mon"];
									$print_sd_tue=$print_dayplanRow["sd_tue"];
									$print_sd_wed=$print_dayplanRow["sd_wed"];
									$print_sd_thu=$print_dayplanRow["sd_thu"];
									$print_sd_frl=$print_dayplanRow["sd_frl"];
									$print_sd_sat=$print_dayplanRow["sd_sat"];
									$print_sd_sun=$print_dayplanRow["sd_sun"];
								}
							?>	



										
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_mon=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_mon=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_year`='{$data_yaer}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_mon`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_MonCount`,`subject_MonKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_MonCount=$supplementary_subjectRow["subject_MonCount"];
												$subject_MonKeep=$supplementary_subjectRow["subject_MonKeep"];
												if($subject_MonKeep>=$subject_MonCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Mon"><b style="color:#0623FB"><?php echo $subject_MonKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_mon=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
								
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_mon=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->				
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_tue=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_tue=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_tues`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_TuesCount`,`subject_TuesKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}' 
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_TuesCount=$supplementary_subjectRow["subject_TuesCount"];
												$subject_TuesKeep=$supplementary_subjectRow["subject_TuesKeep"];
												if($subject_TuesKeep>=$subject_TuesCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Tues"><b style="color:#0623FB"><?php echo $subject_TuesKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_tue=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_tue=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->									
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_wed=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_wed=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_wedne`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_WednesCount`,`subject_WednesKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_WednesCount=$supplementary_subjectRow["subject_WednesCount"];
												$subject_WednesKeep=$supplementary_subjectRow["subject_WednesKeep"];
												if($subject_WednesKeep>=$subject_WednesCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Wednes"><b style="color:#0623FB"><?php echo $subject_WednesKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_wed=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_wed=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->									
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_thu=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_thu=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_thurs`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_ThursCount`,`subject_ThursKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_ThursCount=$supplementary_subjectRow["subject_ThursCount"];
												$subject_ThursKeep=$supplementary_subjectRow["subject_ThursKeep"];
												if($subject_ThursKeep>=$subject_ThursCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Thurs"><b style="color:#0623FB"><?php echo $subject_ThursKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_thu=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_thu=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->	
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_frl=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_frl=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_fri`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_FriCount`,`subject_FriKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}' 
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_FriCount=$supplementary_subjectRow["subject_FriCount"];
												$subject_FriKeep=$supplementary_subjectRow["subject_FriKeep"];
												if($subject_FriKeep>=$subject_FriCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=fri"><b style="color:#0623FB"><?php echo $subject_FriKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_frl=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_frl=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_sat=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_sat=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_sat`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_SaturCount`,`subject_SaturKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_SaturCount=$supplementary_subjectRow["subject_SaturCount"];
												$subject_SaturKeep=$supplementary_subjectRow["subject_SaturKeep"];
												if($subject_SaturKeep>=$subject_SaturCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Satur"><b style="color:#0623FB"><?php echo $subject_SaturKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_sat=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_sat=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->	
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_sun=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_sun=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_sun`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_SunCount`,`subject_SunKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_SunCount=$supplementary_subjectRow["subject_SunCount"];
												$subject_SunKeep=$supplementary_subjectRow["subject_SunKeep"];
												if($subject_SunKeep>=$subject_SunCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun"><b style="color:#0623FB"><?php echo $subject_SunKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_sun=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_sun=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->										
												</tr>	
											
											
										<?php	}  ?>
												
												
												

									
													</tbody>
												  </table>
												
												
												
												
												
												</div>
											</div>
										</div>

									</div>
								</div>	
							</div>
							
						</div>


						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
						<?php	}else{ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
						<?php	} ?>
						<?php	} ?>
						<!--supplementary_notstudy-->

							

						<div class="row">	
								
							<div class="col-<?php echo $grid;?>-12">
							
												<center>
												
												
										<?php
											$supplementary_dayplanSql="SELECT `sdp_key`,`sd_plan`, `sd_group`,`sd_numA`,`sd_numB`,`sd_class`
																	   FROM `supplementary_dayplan` 
																	   WHERE `sd_plan`='{$copy_plan}' and `sd_class`='{$data_stu->IDLevel}'";
											$supplementary_dayplanRs=new notrow_evaluation($supplementary_dayplanSql);
											foreach($supplementary_dayplanRs->evaluation_array as $rc_key=>$supplementary_dayplanRow){
												$sdp_key=$supplementary_dayplanRow["sdp_key"];
												$sdp_group=$supplementary_dayplanRow["sd_group"];
												$sdp_plan=$supplementary_dayplanRow["sd_plan"];
												$sdp_numA=$supplementary_dayplanRow["sd_numA"];
												$sdp_numB=$supplementary_dayplanRow["sd_numB"];
												if($sdp_group==0 or $sdp_group==Null){

										
															$data_dayplanSql="SELECT `sdp_key` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$copy_plan}' and `sd_class`='{$data_stu->IDLevel}'
																			  and `sd_group`='0'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
													
												}else{
													$num_dayplanSql="SELECT `sdp_key`,`sd_numA`,`sd_numB`,`sd_group`  
																	 FROM `supplementary_dayplan` 
																	 WHERE `sd_plan` ='{$copy_plan}' and `sd_class`='{$data_stu->IDLevel}'";
													$num_dayplanRs=new row_evaluation($num_dayplanSql);							
													foreach($num_dayplanRs->evaluation_array as $rc_key=>$num_dayplanRow){
														if($data_stu->rsc_num>=$num_dayplanRow["sd_numA"] and $data_stu->rsc_num<=$num_dayplanRow["sd_numB"]){
															$data_dayplanSql="SELECT `sdp_key`,`sd_plan`,`sd_group` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$copy_plan}' 
																			  and `sd_group`='{$num_dayplanRow["sd_group"]}' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
														break;	
														}else{
															
														}
													}
													
												}
											}
										?>


							<?php
								$print_dayplanSql="SELECT `sdp_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` 
												   FROM `supplementary_dayplan` 
												   WHERE `sdp_key`='{$datasdp_key}'";
								$print_dayplanRs=new notrow_evaluation($print_dayplanSql);
								$count_study=0;
								foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
									$print_sdp_key=$print_dayplanRow["sdp_key"];
									$print_sd_mon=$print_dayplanRow["sd_mon"];
									$print_sd_tue=$print_dayplanRow["sd_tue"];
									$print_sd_wed=$print_dayplanRow["sd_wed"];
									$print_sd_thu=$print_dayplanRow["sd_thu"];
									$print_sd_frl=$print_dayplanRow["sd_frl"];
									$print_sd_sat=$print_dayplanRow["sd_sat"];
									$print_sd_sun=$print_dayplanRow["sd_sun"];
									
									
									if($print_sd_mon=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_tue=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_wed=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_thu=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_frl=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_sat=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_sun=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}
								
								}
							?>	

							<?php
								$study_rcSql="SELECT count(`sup_stuid`) as num_stu FROM `supplementary_sturs` 
											  WHERE `sup_stuid`='{$user_login}'  
											  and `sup_t`='{$data_term}'  
											  and `sup_l`='{$data_stu->IDLevel}' 
											  and `sup_year`='{$data_yaer}'";
								$study_rc=new row_evaluation($study_rcSql);
								foreach($study_rc->evaluation_array as $rc_key=>$study_print){
									$num_stu=$study_print["num_stu"];
									
									if($num_stu>=1){ ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==13){ ?>
						<!--***********************************************************************-->
								
								
								
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>		
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>			
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>			
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>	
										
										

						<!--***********************************************************************-->			
							<?php	}    ?>



											
						<!--***********************************************************************-->				
							<?php	}else{  ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==13){ ?>
						<!--***********************************************************************-->
								
								
								<?php
								$supplementary_notstudySql="SELECT count(`notstudy_stu`) as num_noty FROM `supplementary_notstudy` 
															WHERE `notstudy_stu`='{$user_login}' 
															and `notstudy_t`='{$data_term}' 
															and `notstudy_l`='{$data_stu->IDLevel}'
															and `notstudy_y`='{$data_yaer}'";
								$supplementary_notstudy=new notrow_evaluation($supplementary_notstudySql);
								foreach($supplementary_notstudy->evaluation_array as $rc_key=>$supplementary_notstudyRow){
									$num_noty=$supplementary_notstudyRow["num_noty"];
									if($num_noty>=1){ ?>
										
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<input type="hidden" value="stu_not" name="stu_not">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form><br>				
										
							<?php   }else{ ?>
							
										<?php
										$set_supplementarySql="SELECT count(`supplementary_id`) as `set_count` 
															   from `supplementary_school` 
															   where `supplementary_t`='{$data_term}' 
															   and `supplementary_levelA`='{$data_stu->IDLevel}' 
															   and `supplementary_planA`='{$copy_plan}' 
															   and `supplementary_not`='N' 
															   and `supplementary_off`='1'";
										$set_supplementary=new notrow_evaluation ($set_supplementarySql);
										foreach($set_supplementary->evaluation_array as $rc_key=>$set_supplementaryRow){
											$set_count=$set_supplementaryRow["set_count"];
											if($set_count>=1){ ?>
												<p><a href="./?evaluation_mod=supplementary&notstudy=notstudy"><button type="button" class="btn btn-success">ไม่ลงเรียนเพิ่ม</button></a></p>						
									<?php	}else{ ?> 

									<?php	}
										}
									
									?>	
							
										
							<?php	}
									
								}?>
								
								
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->

						<!--***********************************************************************-->			
							<?php	}    ?>				
						<!--***********************************************************************-->								
							<?php	}  ?>
								
						<?php	}      ?>						
												
												
											</center>
							
							</div>
						</div>	
										
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
									<?php	}elseif($call_registration->sr_academic=="N" and $call_registration->sr_activity=="Y"){//เรียนเฉราะกิจกรรม
																	
											}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="Y"){//เรียนทั้ง วิชาการ และ กิจกรรม ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

						<!--+++++++++++++++++++++++++++++++++++++++--->
							<?php 
								$show_supp_stursSql="SELECT `sup_stuid`,`ss_activity`
													 FROM `supplementary_sturs`
													 WHERE `sup_t` = '{$data_term}'
													 AND `sup_l` = '{$data_stu->IDLevel}'
													 AND `sup_stuid`='{$user_login}';";
								$show_supp_stursRs=new notrow_evaluation($show_supp_stursSql);
								
								foreach($show_supp_stursRs->evaluation_array as $rc_key=>$show_supp_stursRow){
								
									$ss_activity=$show_supp_stursRow["ss_activity"];
									
									switch ($ss_activity){
										case "cilk_true": ?>
						<!--+++++++++++++++++++++++++++++++++++++++--->

						<!--+++++++++++++++++++++++++++++++++++++++--->				
							<?php			break;
										case "cilk_flas": ?>
						<!--+++++++++++++++++++++++++++++++++++++++--->

						<!--+++++++++++++++++++++++++++++++++++++++--->				
							<?php			break;
										default: ?>
						<!--+++++++++++++++++++++++++++++++++++++++--->
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
									<input type="hidden" name="copy_yaer"  id="copy_yaer"  value="<?php echo $data_yaer;?>">
									<input type="hidden" name="copy_term"  id="copy_term"  value="<?php echo $data_term;?>">
									<input type="hidden" name="copy_login" id="copy_login" value="<?php echo $user_login;?>">
								<center>			
									<input  type="image"  src="Template/global_assets/images/ac02.jpg" value="cilk_true"  id="cilk_true4143">    
									<input  type="image"  src="Template/global_assets/images/ac01.jpg" value="cilk_flas"  id="cilk_flas4143">
								</center>
							</div>
						</div><hr>
						<!--+++++++++++++++++++++++++++++++++++++++--->				
							<?php	}
								}
							?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++--->	

						<!--++++++++++++++++++++++++1+++++++++++++++-->
							<div id="show_cilk4143"></div>
						<!--++++++++++++++++++++++++1+++++++++++++++-->

						<!--+++++++++++++++++++++++++++++++++++++++--->
							<?php 
								$show_supp_stursSql="SELECT `sup_stuid`,`ss_activity`
													 FROM `supplementary_sturs`
													 WHERE `sup_t` = '{$data_term}'
													 AND `sup_l` = '{$data_stu->IDLevel}'
													 AND `sup_stuid`='{$user_login}'";
								$show_supp_stursRs=new notrow_evaluation($show_supp_stursSql);
								
								foreach($show_supp_stursRs->evaluation_array as $rc_key=>$show_supp_stursRow){
								
									$ss_activity=$show_supp_stursRow["ss_activity"];
									$call_clik=$show_supp_stursRow["ss_activity"];
									switch ($ss_activity){
										case "cilk_true": ?>
						<!--+++++++++++++++++++++++++++++++++++++++--->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--supplementary_notstudy-->
						<?php
							$print_notstudySql="SELECT `notstudy_stu` FROM `supplementary_notstudy`
												WHERE `notstudy_stu`='{$user_login}' 
												and `notstudy_t`='{$data_term}' 
												and `notstudy_l`='{$data_stu->IDLevel}' 
												and `notstudy_y`='{$data_yaer}' 
												and `notstudy_p`='{$copy_plan}'";
							$print_notstudyRs=new notrow_evaluation($print_notstudySql);
							foreach($print_notstudyRs->evaluation_array as $rc_key=>$print_notstudyRow){
								$notstudy_stu=$print_notstudyRow["notstudy_stu"];
								if($notstudy_stu==""){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="panel panel-info">
									<div class="panel-heading">ทะเบียนเรียน เรียนเสริมเย็น</div>
									<div class="panel-body">

										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="table-responsive">
												
												   <table class="table table-hover">
													<thead>
													  <tr>	
															<th>วิชา</th>
										<?php
											$print_supp_day=new supplementary_day();
											if($print_supp_day->sd_mon=="ON"){ ?>
															<th>วันจันทร์</th>
										<?php	}elseif($print_supp_day->sd_mon=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}      ?>
											
										<?php	if($print_supp_day->sd_tue=="ON"){ ?>
															<th>วันอังคาร</th>
										<?php	}elseif($print_supp_day->sd_tue=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}	   ?>				
											
										<?php	if($print_supp_day->sd_wed=="ON"){ ?>
															<th>วันพุธ</th>
										<?php	}elseif($print_supp_day->sd_wed=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}	   ?>					
											
										<?php	if($print_supp_day->sd_thu=="ON"){?>
															<th>วันพฤหัสบดี</th>
										<?php	}elseif($print_supp_day->sd_thu=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>					
											
										<?php	if($print_supp_day->sd_frl=="ON"){?>
															<th>วันศุกร์</th>
										<?php	}elseif($print_supp_day->sd_frl=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>					
											
										<?php	if($print_supp_day->sd_sat=="ON"){?>
															<th>วันเสาร์</th>
										<?php	}elseif($print_supp_day->sd_sat=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>

										<?php	if($print_supp_day->sd_sun=="ON"){?>
															<th>วันอาทิตย์</th>
										<?php	}elseif($print_supp_day->sd_sun=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>				
													  </tr>
													  
													</thead>
													<tbody>
										<?php
											$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
																	   FROM `supplementary_subject` 
																	   WHERE `ss_t`='{$data_term}' 
																	   and `ss_l`='{$data_stu->IDLevel}' 
																	   and `ss_year`='{$data_yaer}'
																	   and `ss_academic`='1'";
											$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){  ?>
												
									
												<tr>
														<td><?php echo $supplementary_subjectRow["ss_txtth"];?></td>
														
										
										
										<?php
											$print_daysubject=new supplementary_daysubject($supplementary_subjectRow["ss_id"]);	
										?>
										
										
										
										
										<?php
											$supplementary_dayplanSql="SELECT `sdp_key`,`sd_plan`, `sd_group`,`sd_numA`,`sd_numB`
																	   FROM `supplementary_dayplan` 
																	   WHERE `sd_plan`='{$copy_plan}' and `sd_class`='{$data_stu->IDLevel}'";
											$supplementary_dayplanRs=new notrow_evaluation($supplementary_dayplanSql);
											foreach($supplementary_dayplanRs->evaluation_array as $rc_key=>$supplementary_dayplanRow){
												$sdp_key=$supplementary_dayplanRow["sdp_key"];
												$sdp_group=$supplementary_dayplanRow["sd_group"];
												$sdp_plan=$supplementary_dayplanRow["sd_plan"];
												$sdp_numA=$supplementary_dayplanRow["sd_numA"];
												$sdp_numB=$supplementary_dayplanRow["sd_numB"];
												if($sdp_group==0 or $sdp_group==Null){

										
															$data_dayplanSql="SELECT `sdp_key` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$copy_plan}' 
																			  and `sd_group`='0' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
													
												}else{
													$num_dayplanSql="SELECT `sdp_key`,`sd_numA`,`sd_numB`,`sd_group`  
																	 FROM `supplementary_dayplan` 
																	 WHERE `sd_plan` ='{$copy_plan}' and `sd_class`='{$data_stu->IDLevel}'";
													$num_dayplanRs=new row_evaluation($num_dayplanSql);							
													foreach($num_dayplanRs->evaluation_array as $rc_key=>$num_dayplanRow){
														if($data_stu->rsc_num>=$num_dayplanRow["sd_numA"] and $data_stu->rsc_num<=$num_dayplanRow["sd_numB"]){
															$data_dayplanSql="SELECT `sdp_key`,`sd_plan`,`sd_group` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$copy_plan}' 
																			  and `sd_group`='{$num_dayplanRow["sd_group"]}' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
														break;	
														}else{
															
														}
													}
													
												} 
											}
										?>					
										
										
							<?php
								$print_dayplanSql="SELECT `sdp_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` 
												   FROM `supplementary_dayplan` 
												   WHERE `sdp_key`='{$datasdp_key}'";
								$print_dayplanRs=new notrow_evaluation($print_dayplanSql);
								foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
									$print_sdp_key=$print_dayplanRow["sdp_key"];
									$print_sd_mon=$print_dayplanRow["sd_mon"];
									$print_sd_tue=$print_dayplanRow["sd_tue"];
									$print_sd_wed=$print_dayplanRow["sd_wed"];
									$print_sd_thu=$print_dayplanRow["sd_thu"];
									$print_sd_frl=$print_dayplanRow["sd_frl"];
									$print_sd_sat=$print_dayplanRow["sd_sat"];
									$print_sd_sun=$print_dayplanRow["sd_sun"];
								}
							?>	


						<?php
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
							$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

								if($call_dateactivity->day_activity_mon=="ON"){ ?>
								
														<td></td>		
														
						<?php	}elseif($call_dateactivity->day_activity_mon=="OFF"){ ?>
								
						<!----------------------------------------------------------------------->				
								<?php
												if($print_daysubject->sds_mon=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_mon=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_year`='{$data_yaer}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_mon`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_MonCount`,`subject_MonKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_MonCount=$supplementary_subjectRow["subject_MonCount"];
												$subject_MonKeep=$supplementary_subjectRow["subject_MonKeep"];
												if($subject_MonKeep>=$subject_MonCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Mon&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_MonKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>		
						<!--................................................................................-->



						<!--................................................................................-->



								
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_mon=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
								
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_mon=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->		

						<?php	}else{
								//***********************************************
							}
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
						?>


						<?php
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
							$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);
								if($call_dateactivity->day_activity_tue=="ON"){ ?>
								
														<td></td>		
														
						<?php	}elseif($call_dateactivity->day_activity_tue=="OFF"){ ?>
							
						<!----------------------------------------------------------------------->				
								<?php
												if($print_daysubject->sds_tue=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_tue=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_tuene`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_tuenesCount`,`subject_tuenesKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_tuenesCount=$supplementary_subjectRow["subject_tuenesCount"];
												$subject_tuenesKeep=$supplementary_subjectRow["subject_tuenesKeep"];
												if($subject_tuenesKeep>=$subject_tuenesCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=tuenes&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_tuenesKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_tue=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_tue=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->	
								
						<?php	}else{
								//***********************************************
							}
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
						?>




						<?php
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
							$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

								if($call_dateactivity->day_activity_wed=="ON"){ ?>
								
														<td></td>		
														
						<?php	}elseif($call_dateactivity->day_activity_wed=="OFF"){ ?>
						<!----------------------------------------------------------------------->		
						<!----------------------------------------------------------------------->				
								<?php
												if($print_daysubject->sds_wed=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_wed=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_wedne`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_WednesCount`,`subject_WednesKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_WednesCount=$supplementary_subjectRow["subject_WednesCount"];
												$subject_WednesKeep=$supplementary_subjectRow["subject_WednesKeep"];
												if($subject_WednesKeep>=$subject_WednesCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Wednes&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_WednesKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_wed=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_wed=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->


						<!----------------------------------------------------------------------->		
						<?php	}else{
								//***********************************************
							}
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
						?>

										
							
						<?php
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
							$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

								if($call_dateactivity->day_activity_thu=="ON"){ ?>
								
														<td></td>		
														
						<?php	}elseif($call_dateactivity->day_activity_thu=="OFF"){ ?>
						<!----------------------------------------------------------------------->		

						<!----------------------------------------------------------------------->				
								<?php
												if($print_daysubject->sds_thu=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_thu=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_thurs`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_ThursCount`,`subject_ThursKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_ThursCount=$supplementary_subjectRow["subject_ThursCount"];
												$subject_ThursKeep=$supplementary_subjectRow["subject_ThursKeep"];
												if($subject_ThursKeep>=$subject_ThursCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Thurs&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_ThursKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_thu=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_thu=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->
						<!----------------------------------------------------------------------->		
						<?php	}else{
								//***********************************************
							}
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
						?>
									
							
						<?php
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
							$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

								if($call_dateactivity->day_activity_frl=="ON"){ ?>
								
														<td></td>		
														
						<?php	}elseif($call_dateactivity->day_activity_frl=="OFF"){ ?>
						<!----------------------------------------------------------------------->		

						<!----------------------------------------------------------------------->				
								<?php
												if($print_daysubject->sds_frl=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_frl=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_fri`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_FriCount`,`subject_FriKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_FriCount=$supplementary_subjectRow["subject_FriCount"];
												$subject_FriKeep=$supplementary_subjectRow["subject_FriKeep"];
												if($subject_FriKeep>=$subject_FriCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=fri&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_FriKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_frl=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_frl=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->
						<!----------------------------------------------------------------------->		
						<?php	}else{
								//***********************************************
							}
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
						?>	
															
							
						<?php
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
							$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

								if($call_dateactivity->day_activity_sat=="ON"){ ?>
								
														<td></td>		
														
						<?php	}elseif($call_dateactivity->day_activity_sat=="OFF"){ ?>
						<!----------------------------------------------------------------------->		
						<!----------------------------------------------------------------------->				
								<?php
												if($print_daysubject->sds_sat=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_sat=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_sat`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_SaturCount`,`subject_SaturKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}' 
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_SaturCount=$supplementary_subjectRow["subject_SaturCount"];
												$subject_SaturKeep=$supplementary_subjectRow["subject_SaturKeep"];
												if($subject_SaturKeep>=$subject_SaturCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Satur&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_SaturKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_sat=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_sat=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->
						<!----------------------------------------------------------------------->		
						<?php	}else{
								//***********************************************
							}
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
						?>	
							
						<?php
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
							$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

								if($call_dateactivity->day_activity_sun=="ON"){ ?>
								
														<td></td>		
														
						<?php	}elseif($call_dateactivity->day_activity_sun=="OFF"){ ?>
						<!----------------------------------------------------------------------->		
						<!----------------------------------------------------------------------->				
								<?php
												if($print_daysubject->sds_sun=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_sun=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_sun`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_SunCount`,`subject_SunKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}' 
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_SunCount=$supplementary_subjectRow["subject_SunCount"];
												$subject_SunKeep=$supplementary_subjectRow["subject_SunKeep"];
												if($subject_SunKeep>=$subject_SunCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_SunKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_sun=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_sun=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->	
						<!----------------------------------------------------------------------->		
						<?php	}else{
								//***********************************************
							}
						///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
						?>
							
															
												</tr>	
											
											
										<?php	}  ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
												<tr>		
													<td><div>กิจกรรมตามความถนัดและสนใจ<div></td>
													
													
							<?php
								$print_activitySql="select `supplementary_subject`.`ss_txtth` 
													from `supplementary_subject` join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													where `supplementary_sturs`.`sup_t`='{$data_term}' 
													and   `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													and   `supplementary_sturs`.`sup_year`='{$data_yaer}'
													and   `supplementary_sturs`.`sup_stuid`='{$user_login}'
													and   `supplementary_subject`.`ss_academic`='0';";		
								$print_activityRs=new notrow_evaluation($print_activitySql);
								
								foreach($print_activityRs->evaluation_array as $rc_key=>$print_activityRow){
									
									$print_dataTxtth=$print_activityRow["ss_txtth"];
									
									if($print_dataTxtth==""){ ?>
						<!----------------------------------------------------------------------->
													
														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

																if($call_dateactivity->day_activity_mon=="ON"){ ?>
																
																						<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_mon=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>
														
														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

																if($call_dateactivity->day_activity_tue=="ON"){ ?>
																
																						<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_tue=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td><div></div></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>			

														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

																if($call_dateactivity->day_activity_wed=="ON"){ ?>
																
																						<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_wed=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>	
														
														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

																if($call_dateactivity->day_activity_wed=="ON"){ ?>
																
																						<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_wed=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>	

														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

																if($call_dateactivity->day_activity_thu=="ON"){ ?>
																
																						<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_thu=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>		

														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

																if($call_dateactivity->day_activity_frl=="ON"){ ?>
																
																						<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_frl=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>									
														
														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

																if($call_dateactivity->day_activity_sat=="ON"){ ?>
																
																						<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_sat=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>		

														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

																if($call_dateactivity->day_activity_sun=="ON"){ ?>
																
																						<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_sun=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>	
						<!----------------------------------------------------------------------->				
							<?php	}else{ ?>
						<!----------------------------------------------------------------------->
													
														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

																if($call_dateactivity->day_activity_mon=="ON"){ ?>
																
																						<td><?php echo $print_dataTxtth;?></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_mon=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>
														
														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

																if($call_dateactivity->day_activity_tue=="ON"){ ?>
																
																						<td><?php echo $print_dataTxtth;?></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_tue=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>			

														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

																if($call_dateactivity->day_activity_wed=="ON"){ ?>
																
																						<td><?php echo $print_dataTxtth;?></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_wed=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>	
														
														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

																if($call_dateactivity->day_activity_wed=="ON"){ ?>
																
																						<td><?php echo $print_dataTxtth;?></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_wed=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>	

														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

																if($call_dateactivity->day_activity_thu=="ON"){ ?>
																
																						<td><?php echo $print_dataTxtth;?></td>	
																						
														<?php	}elseif($call_dateactivity->day_activity_thu=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>		

														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

																if($call_dateactivity->day_activity_frl=="ON"){ ?>
																
																						<td><?php echo $print_dataTxtth;?></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_frl=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>									
														
														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

																if($call_dateactivity->day_activity_sat=="ON"){ ?>
																
																						<td><?php echo $print_dataTxtth;?></td>		
																						
														<?php	}elseif($call_dateactivity->day_activity_sat=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>		

														<?php
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
															$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);

																if($call_dateactivity->day_activity_sun=="ON"){ ?>
																
																						<td><?php echo $print_dataTxtth;?></td>	
																						
														<?php	}elseif($call_dateactivity->day_activity_sun=="OFF"){ ?>
														<!----------------------------------------------------------------------->		

																						<td></td>
														<!----------------------------------------------------------------------->		
														<?php	}else{
																//***********************************************
															}
														///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
														?>	
						<!----------------------------------------------------------------------->				
							<?php	}
								}
							?>						
													
														
														
												</tr>	
												

									
													</tbody>
												  </table>
												
												
												
												
												
												</div>
											</div>
										</div>

									</div>
								</div>	
							</div>
							
						</div>


						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
						<?php	}else{ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
						<?php	} ?>
						<?php	} ?>
						<!--supplementary_notstudy-->

							

						<div class="row">	
								
							<div class="col-<?php echo $grid;?>-12">
							
												<center>
												
												
										<?php
											$supplementary_dayplanSql="SELECT `sdp_key`,`sd_plan`, `sd_group`,`sd_numA`,`sd_numB`,`sd_class`
																	   FROM `supplementary_dayplan` 
																	   WHERE `sd_plan`='{$copy_plan}' and `sd_class`='{$data_stu->IDLevel}'";
											$supplementary_dayplanRs=new notrow_evaluation($supplementary_dayplanSql);
											foreach($supplementary_dayplanRs->evaluation_array as $rc_key=>$supplementary_dayplanRow){
												$sdp_key=$supplementary_dayplanRow["sdp_key"];
												$sdp_group=$supplementary_dayplanRow["sd_group"];
												$sdp_plan=$supplementary_dayplanRow["sd_plan"];
												$sdp_numA=$supplementary_dayplanRow["sd_numA"];
												$sdp_numB=$supplementary_dayplanRow["sd_numB"];
												if($sdp_group==0 or $sdp_group==Null){

										
															$data_dayplanSql="SELECT `sdp_key` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$copy_plan}' and `sd_class`='{$data_stu->IDLevel}'
																			  and `sd_group`='0'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
													
												}else{
													$num_dayplanSql="SELECT `sdp_key`,`sd_numA`,`sd_numB`,`sd_group`  
																	 FROM `supplementary_dayplan` 
																	 WHERE `sd_plan` ='{$copy_plan}' and `sd_class`='{$data_stu->IDLevel}'";
													$num_dayplanRs=new row_evaluation($num_dayplanSql);							
													foreach($num_dayplanRs->evaluation_array as $rc_key=>$num_dayplanRow){
														if($data_stu->rsc_num>=$num_dayplanRow["sd_numA"] and $data_stu->rsc_num<=$num_dayplanRow["sd_numB"]){
															$data_dayplanSql="SELECT `sdp_key`,`sd_plan`,`sd_group` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$copy_plan}' 
																			  and `sd_group`='{$num_dayplanRow["sd_group"]}' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
														break;	
														}else{
															
														}
													}
													
												}
											}
										?>


							<?php
								$print_dayplanSql="SELECT `sdp_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` 
												   FROM `supplementary_dayplan` 
												   WHERE `sdp_key`='{$datasdp_key}'";
								$print_dayplanRs=new notrow_evaluation($print_dayplanSql);
								$count_study=0;
								foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
									$print_sdp_key=$print_dayplanRow["sdp_key"];
									$print_sd_mon=$print_dayplanRow["sd_mon"];
									$print_sd_tue=$print_dayplanRow["sd_tue"];
									$print_sd_wed=$print_dayplanRow["sd_wed"];
									$print_sd_thu=$print_dayplanRow["sd_thu"];
									$print_sd_frl=$print_dayplanRow["sd_frl"];
									$print_sd_sat=$print_dayplanRow["sd_sat"];
									$print_sd_sun=$print_dayplanRow["sd_sun"];
									
									
									if($print_sd_mon=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_tue=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_wed=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_thu=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_frl=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_sat=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_sun=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}
							
								}
							?>	

							<?php
								$count_study=($count_study-$call_dateactivity->count_activityON)+1;
							
								$study_rcSql="SELECT count(`sup_stuid`) as num_stu FROM `supplementary_sturs` 
											  WHERE `sup_stuid`='{$user_login}'  
											  and `sup_t`='{$data_term}'  
											  and `sup_l`='{$data_stu->IDLevel}' 
											  and `sup_year`='{$data_yaer}'";
								$study_rc=new row_evaluation($study_rcSql);
								foreach($study_rc->evaluation_array as $rc_key=>$study_print){
									$num_stu=$study_print["num_stu"];
									
									if($num_stu>=1){ ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==13){ ?>
						<!--***********************************************************************-->
								
								
								
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>		
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>			
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>			
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>	
										
										

						<!--***********************************************************************-->			
							<?php	}    ?>



											
						<!--***********************************************************************-->				
							<?php	}else{  ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==13){ ?>
						<!--***********************************************************************-->
								
								
								<?php
								$supplementary_notstudySql="SELECT count(`notstudy_stu`) as num_noty FROM `supplementary_notstudy` 
															WHERE `notstudy_stu`='{$user_login}' 
															and `notstudy_t`='{$data_term}' 
															and `notstudy_l`='{$data_stu->IDLevel}'
															and `notstudy_y`='{$data_yaer}'";
								$supplementary_notstudy=new notrow_evaluation($supplementary_notstudySql);
								foreach($supplementary_notstudy->evaluation_array as $rc_key=>$supplementary_notstudyRow){
									$num_noty=$supplementary_notstudyRow["num_noty"];
									if($num_noty>=1){ ?>
										
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<input type="hidden" value="stu_not" name="stu_not">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form><br>				
										
							<?php   }else{ ?>
							
										<?php
										$set_supplementarySql="SELECT count(`supplementary_id`) as `set_count` 
															   from `supplementary_school` 
															   where `supplementary_t`='{$data_term}' 
															   and `supplementary_levelA`='{$data_stu->IDLevel}' 
															   and `supplementary_planA`='{$copy_plan}' 
															   and `supplementary_not`='N' 
															   and `supplementary_off`='1'";
										$set_supplementary=new notrow_evaluation ($set_supplementarySql);
										foreach($set_supplementary->evaluation_array as $rc_key=>$set_supplementaryRow){
											$set_count=$set_supplementaryRow["set_count"];
											if($set_count>=1){ ?>
												<p><a href="./?evaluation_mod=supplementary&notstudy=notstudy"><button type="button" class="btn btn-success">ไม่ลงเรียนเพิ่ม</button></a></p>						
									<?php	}else{ ?> 

									<?php	}
										}
									
									?>	
							
										
							<?php	}
									
								}?>
								
								
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->

						<!--***********************************************************************-->			
							<?php	}    ?>				
						<!--***********************************************************************-->								
							<?php	}  ?>
								
						<?php	}      ?>						
												
												
											</center>
							
							</div>
						</div>	

						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++--->				
							<?php			break;
										case "cilk_flas": ?>
						<!--+++++++++++++++++++++++++++++++++++++++--->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

						<!--supplementary_notstudy-->
						<?php
							$print_notstudySql="SELECT `notstudy_stu` FROM `supplementary_notstudy`
												WHERE `notstudy_stu`='{$user_login}' 
												and `notstudy_t`='{$data_term}' 
												and `notstudy_l`='{$data_stu->IDLevel}' 
												and `notstudy_y`='{$data_yaer}' 
												and `notstudy_p`='{$copy_plan}'";
							$print_notstudyRs=new notrow_evaluation($print_notstudySql);
							foreach($print_notstudyRs->evaluation_array as $rc_key=>$print_notstudyRow){
								$notstudy_stu=$print_notstudyRow["notstudy_stu"];
								if($notstudy_stu==""){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
								<div class="panel panel-info">
									<div class="panel-heading">ทะเบียนเรียน เรียนเสริมเย็น</div>
									<div class="panel-body">

										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="table-responsive">
												
												   <table class="table table-hover">
													<thead>
													  <tr>	
															<th>วิชา</th>
										<?php
											$print_supp_day=new supplementary_day();
											if($print_supp_day->sd_mon=="ON"){ ?>
															<th>วันจันทร์</th>
										<?php	}elseif($print_supp_day->sd_mon=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}      ?>
											
										<?php	if($print_supp_day->sd_tue=="ON"){ ?>
															<th>วันอังคาร</th>
										<?php	}elseif($print_supp_day->sd_tue=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}	   ?>				
											
										<?php	if($print_supp_day->sd_wed=="ON"){ ?>
															<th>วันพุธ</th>
										<?php	}elseif($print_supp_day->sd_wed=="OFF"){ ?>
												
										<?php	}else{ ?>
												
										<?php	}	   ?>					
											
										<?php	if($print_supp_day->sd_thu=="ON"){?>
															<th>วันพฤหัสบดี</th>
										<?php	}elseif($print_supp_day->sd_thu=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>					
											
										<?php	if($print_supp_day->sd_frl=="ON"){?>
															<th>วันศุกร์</th>
										<?php	}elseif($print_supp_day->sd_frl=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>					
											
										<?php	if($print_supp_day->sd_sat=="ON"){?>
															<th>วันเสาร์</th>
										<?php	}elseif($print_supp_day->sd_sat=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>

										<?php	if($print_supp_day->sd_sun=="ON"){?>
															<th>วันอาทิตย์</th>
										<?php	}elseif($print_supp_day->sd_sun=="OFF"){?>
												
										<?php	}else{?>
												
										<?php	}	  ?>				
													  </tr>
													  
													</thead>
													<tbody>
										<?php
											$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
																	   FROM `supplementary_subject` 
																	   WHERE `ss_t`='{$data_term}' 
																	   and `ss_l`='{$data_stu->IDLevel}' 
																	   and `ss_year`='{$data_yaer}' 
																	   and `ss_academic`='1'";
											$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){  ?>
												
									
												<tr>
														<td><?php echo $supplementary_subjectRow["ss_txtth"];?></td>
														
										
										
										<?php
											$print_daysubject=new supplementary_daysubject($supplementary_subjectRow["ss_id"]);	
										?>
										
										
										
										
										<?php
											$supplementary_dayplanSql="SELECT `sdp_key`,`sd_plan`, `sd_group`,`sd_numA`,`sd_numB`
																	   FROM `supplementary_dayplan` 
																	   WHERE `sd_plan`='{$copy_plan}' and `sd_class`='{$data_stu->IDLevel}'";
											$supplementary_dayplanRs=new notrow_evaluation($supplementary_dayplanSql);
											foreach($supplementary_dayplanRs->evaluation_array as $rc_key=>$supplementary_dayplanRow){
												$sdp_key=$supplementary_dayplanRow["sdp_key"];
												$sdp_group=$supplementary_dayplanRow["sd_group"];
												$sdp_plan=$supplementary_dayplanRow["sd_plan"];
												$sdp_numA=$supplementary_dayplanRow["sd_numA"];
												$sdp_numB=$supplementary_dayplanRow["sd_numB"];
												if($sdp_group==0 or $sdp_group==Null){

										
															$data_dayplanSql="SELECT `sdp_key` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$copy_plan}' 
																			  and `sd_group`='0' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
													
												}else{
													$num_dayplanSql="SELECT `sdp_key`,`sd_numA`,`sd_numB`,`sd_group`  
																	 FROM `supplementary_dayplan` 
																	 WHERE `sd_plan` ='{$copy_plan}' and `sd_class`='{$data_stu->IDLevel}'";
													$num_dayplanRs=new row_evaluation($num_dayplanSql);							
													foreach($num_dayplanRs->evaluation_array as $rc_key=>$num_dayplanRow){
														if($data_stu->rsc_num>=$num_dayplanRow["sd_numA"] and $data_stu->rsc_num<=$num_dayplanRow["sd_numB"]){
															$data_dayplanSql="SELECT `sdp_key`,`sd_plan`,`sd_group` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$copy_plan}' 
																			  and `sd_group`='{$num_dayplanRow["sd_group"]}' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
														break;	
														}else{
															
														}
													}
													
												}
											}
										?>					
										
										
							<?php
								$print_dayplanSql="SELECT `sdp_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` 
												   FROM `supplementary_dayplan` 
												   WHERE `sdp_key`='{$datasdp_key}'";
								$print_dayplanRs=new notrow_evaluation($print_dayplanSql);
								foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
									$print_sdp_key=$print_dayplanRow["sdp_key"];
									$print_sd_mon=$print_dayplanRow["sd_mon"];
									$print_sd_tue=$print_dayplanRow["sd_tue"];
									$print_sd_wed=$print_dayplanRow["sd_wed"];
									$print_sd_thu=$print_dayplanRow["sd_thu"];
									$print_sd_frl=$print_dayplanRow["sd_frl"];
									$print_sd_sat=$print_dayplanRow["sd_sat"];
									$print_sd_sun=$print_dayplanRow["sd_sun"];
								}
							?>	



										
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_mon=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_mon=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_year`='{$data_yaer}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_mon`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_MonCount`,`subject_MonKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_MonCount=$supplementary_subjectRow["subject_MonCount"];
												$subject_MonKeep=$supplementary_subjectRow["subject_MonKeep"];
												if($subject_MonKeep>=$subject_MonCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Mon&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_MonKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_mon=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
								
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_mon=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->				
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_tue=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_tue=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_tues`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_TuesCount`,`subject_TuesKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}' 
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_TuesCount=$supplementary_subjectRow["subject_TuesCount"];
												$subject_TuesKeep=$supplementary_subjectRow["subject_TuesKeep"];
												if($subject_TuesKeep>=$subject_TuesCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Tues&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_TuesKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_tue=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_tue=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->									
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_wed=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_wed=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_wedne`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_WednesCount`,`subject_WednesKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_WednesCount=$supplementary_subjectRow["subject_WednesCount"];
												$subject_WednesKeep=$supplementary_subjectRow["subject_WednesKeep"];
												if($subject_WednesKeep>=$subject_WednesCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Wednes&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_WednesKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_wed=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_wed=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->									
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_thu=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_thu=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_thurs`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_ThursCount`,`subject_ThursKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_ThursCount=$supplementary_subjectRow["subject_ThursCount"];
												$subject_ThursKeep=$supplementary_subjectRow["subject_ThursKeep"];
												if($subject_ThursKeep>=$subject_ThursCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Thurs&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_ThursKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_thu=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_thu=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->	
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_frl=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_frl=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_fri`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_FriCount`,`subject_FriKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}' 
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_FriCount=$supplementary_subjectRow["subject_FriCount"];
												$subject_FriKeep=$supplementary_subjectRow["subject_FriKeep"];
												if($subject_FriKeep>=$subject_FriCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=fri&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_FriKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_frl=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_frl=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_sat=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_sat=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_sat`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_SaturCount`,`subject_SaturKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_SaturCount=$supplementary_subjectRow["subject_SaturCount"];
												$subject_SaturKeep=$supplementary_subjectRow["subject_SaturKeep"];
												if($subject_SaturKeep>=$subject_SaturCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Satur&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_SaturKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_sat=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_sat=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->	
						<!----------------------------------------------------------------------->				
										<?php
												if($print_daysubject->sds_sun=="ON"){ ?>
						<!--*******************************************************************-->
								<?php
										if($print_sd_sun=="ON"){ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php
									$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
													   FROM `supplementary_sturs` 
													   WHERE `sup_stuid`='{$user_login}' 
													   and `sup_t`='{$data_term}' 
													   and `sup_l`='{$data_stu->IDLevel}' 
													   and `sup_year`='{$data_yaer}' 
													   and `ss_id`='{$print_daysubject->sss_id}' 
													   and `ss_sun`='1';";
									$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
									foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
										$num_stuid=$doing_subjectRow["num_stuid"];
										if($num_stuid>=1){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
														<td>ลงเรียนแล้ว</td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<?php	}else{ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
										<?php
											$supplementary_subject="SELECT `ss_id`,`subject_SunCount`,`subject_SunKeep` 
																	FROM `supplementary_subject` 
																	WHERE `ss_id`='{$print_daysubject->sss_id}' 
																	and `ss_t`='{$data_term}' 
																	and `ss_l`='{$data_stu->IDLevel}' 
																	and `ss_year`='{$data_yaer}'
																	and `ss_academic`='1'";
											$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
											foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
												$subject_SunCount=$supplementary_subjectRow["subject_SunCount"];
												$subject_SunKeep=$supplementary_subjectRow["subject_SunKeep"];
												if($subject_SunKeep>=$subject_SunCount){ ?>
						<!--*****************************************************************************************************-->	
														<td><b style="color: #F80B0F">เต็ม</b></td>
						<!--*****************************************************************************************************-->							
									<?php		}else{ ?>
						<!--*****************************************************************************************************-->	
														<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_SunKeep;?></b></a></td>
						<!--*****************************************************************************************************-->							
									<?php		}
											}
										?>
													
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
								<?php	}
									}
								?>				
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<?php	}elseif($print_sd_sun=="OFF"){ ?>
														<td></td>
								<?php	}else{ ?>
														<td></td>
								<?php	}?>
						<!--*******************************************************************-->						
										<?php	}elseif($print_daysubject->sds_sun=="OFF"){ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	}else{ ?>
						<!--*******************************************************************-->
														<td></td>
						<!--*******************************************************************-->							
										<?php	} ?>
						<!----------------------------------------------------------------------->										
												</tr>	
											
											
										<?php	}  ?>
												
												
												

									
													</tbody>
												  </table>
												
												
												
												
												
												</div>
											</div>
										</div>

									</div>
								</div>	
							</div>
							
						</div>


						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
						<?php	}else{ ?>
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
						<?php	} ?>
						<?php	} ?>
						<!--supplementary_notstudy-->

							

						<div class="row">	
								
							<div class="col-<?php echo $grid;?>-12">
							
												<center>
												
												
										<?php
											$supplementary_dayplanSql="SELECT `sdp_key`,`sd_plan`, `sd_group`,`sd_numA`,`sd_numB`,`sd_class`
																	   FROM `supplementary_dayplan` 
																	   WHERE `sd_plan`='{$copy_plan}' and `sd_class`='{$data_stu->IDLevel}'";
											$supplementary_dayplanRs=new notrow_evaluation($supplementary_dayplanSql);
											foreach($supplementary_dayplanRs->evaluation_array as $rc_key=>$supplementary_dayplanRow){
												$sdp_key=$supplementary_dayplanRow["sdp_key"];
												$sdp_group=$supplementary_dayplanRow["sd_group"];
												$sdp_plan=$supplementary_dayplanRow["sd_plan"];
												$sdp_numA=$supplementary_dayplanRow["sd_numA"];
												$sdp_numB=$supplementary_dayplanRow["sd_numB"];
												if($sdp_group==0 or $sdp_group==Null){

										
															$data_dayplanSql="SELECT `sdp_key` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$copy_plan}' and `sd_class`='{$data_stu->IDLevel}'
																			  and `sd_group`='0'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
													
												}else{
													$num_dayplanSql="SELECT `sdp_key`,`sd_numA`,`sd_numB`,`sd_group`  
																	 FROM `supplementary_dayplan` 
																	 WHERE `sd_plan` ='{$copy_plan}' and `sd_class`='{$data_stu->IDLevel}'";
													$num_dayplanRs=new row_evaluation($num_dayplanSql);							
													foreach($num_dayplanRs->evaluation_array as $rc_key=>$num_dayplanRow){
														if($data_stu->rsc_num>=$num_dayplanRow["sd_numA"] and $data_stu->rsc_num<=$num_dayplanRow["sd_numB"]){
															$data_dayplanSql="SELECT `sdp_key`,`sd_plan`,`sd_group` 
																			  FROM `supplementary_dayplan` 
																			  WHERE `sd_plan`='{$copy_plan}' 
																			  and `sd_group`='{$num_dayplanRow["sd_group"]}' and `sd_class`='{$data_stu->IDLevel}'";
															$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
															foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
																$datasdp_key=$data_dayplanRow["sdp_key"];
															}
														break;	
														}else{
															
														}
													}
													
												}
											}
										?>


							<?php
								$print_dayplanSql="SELECT `sdp_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` 
												   FROM `supplementary_dayplan` 
												   WHERE `sdp_key`='{$datasdp_key}'";
								$print_dayplanRs=new notrow_evaluation($print_dayplanSql);
								$count_study=0;
								foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
									$print_sdp_key=$print_dayplanRow["sdp_key"];
									$print_sd_mon=$print_dayplanRow["sd_mon"];
									$print_sd_tue=$print_dayplanRow["sd_tue"];
									$print_sd_wed=$print_dayplanRow["sd_wed"];
									$print_sd_thu=$print_dayplanRow["sd_thu"];
									$print_sd_frl=$print_dayplanRow["sd_frl"];
									$print_sd_sat=$print_dayplanRow["sd_sat"];
									$print_sd_sun=$print_dayplanRow["sd_sun"];
									
									
									if($print_sd_mon=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_tue=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_wed=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_thu=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_frl=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_sat=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}			
									
									if($print_sd_sun=="ON"){
										$count_study=$count_study+1;
									}else{
										$count_study=$count_study+0;
									}
								
								}
							?>	

							<?php
								$study_rcSql="SELECT count(`sup_stuid`) as num_stu FROM `supplementary_sturs` 
											  WHERE `sup_stuid`='{$user_login}'  
											  and `sup_t`='{$data_term}'  
											  and `sup_l`='{$data_stu->IDLevel}' 
											  and `sup_year`='{$data_yaer}'";
								$study_rc=new row_evaluation($study_rcSql);
								foreach($study_rc->evaluation_array as $rc_key=>$study_print){
									$num_stu=$study_print["num_stu"];
									
									if($num_stu>=1){ ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==13){ ?>
						<!--***********************************************************************-->
								
								
								
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>		
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>			
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>			
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>	
										
										

						<!--***********************************************************************-->			
							<?php	}    ?>



											
						<!--***********************************************************************-->				
							<?php	}else{  ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==13){ ?>
						<!--***********************************************************************-->
								
								
								<?php
								$supplementary_notstudySql="SELECT count(`notstudy_stu`) as num_noty FROM `supplementary_notstudy` 
															WHERE `notstudy_stu`='{$user_login}' 
															and `notstudy_t`='{$data_term}' 
															and `notstudy_l`='{$data_stu->IDLevel}'
															and `notstudy_y`='{$data_yaer}'";
								$supplementary_notstudy=new notrow_evaluation($supplementary_notstudySql);
								foreach($supplementary_notstudy->evaluation_array as $rc_key=>$supplementary_notstudyRow){
									$num_noty=$supplementary_notstudyRow["num_noty"];
									if($num_noty>=1){ ?>
										
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<input type="hidden" value="stu_not" name="stu_not">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form><br>				
										
							<?php   }else{ ?>
							
										<?php
										$set_supplementarySql="SELECT count(`supplementary_id`) as `set_count` 
															   from `supplementary_school` 
															   where `supplementary_t`='{$data_term}' 
															   and `supplementary_levelA`='{$data_stu->IDLevel}' 
															   and `supplementary_planA`='{$copy_plan}' 
															   and `supplementary_not`='N' 
															   and `supplementary_off`='1'";
										$set_supplementary=new notrow_evaluation ($set_supplementarySql);
										foreach($set_supplementary->evaluation_array as $rc_key=>$set_supplementaryRow){
											$set_count=$set_supplementaryRow["set_count"];
											if($set_count>=1){ ?>
												<p><a href="./?evaluation_mod=supplementary&notstudy=notstudy"><button type="button" class="btn btn-success">ไม่ลงเรียนเพิ่ม</button></a></p>						
									<?php	}else{ ?> 

									<?php	}
										}
									
									?>	
							
										
							<?php	}
									
								}?>
								
								
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->

						<!--***********************************************************************-->			
							<?php	}    ?>				
						<!--***********************************************************************-->								
							<?php	}  ?>
								
						<?php	}      ?>						
												
												
											</center>
							
							</div>
						</div>	
						<!--+++++++++++++++++++++++++++++++++++++++--->				
							<?php			break;
										default:
										//****************************
									}
								}
							?>
						<!--+++++++++++++++++++++++++++++++++++++++--->







										
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
									<?php	}else{ ?>
						<!--***************************************************************************************************-->	
								<div class="row">
									<div class="col-<?php echo $grid;?>-12">
									
									
									</div>
								</div>				
						<!--***************************************************************************************************-->					
									<?php	}      ?>
						<!--///////////////////////////////////////////////////////////////////////////////////////////////////////-->		

						<?php	}else{ ?>
						<!--*******************************************************************************************************-->
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<div class="alert alert-danger">
												<p><strong>ปิดระบบ...</strong><!--นักเรียนระดับมัธยมศึกษา สามารถเริ่มลงทะเบียนเรียนเสริมนอกเวลาเรียน ภาคเรียนที่ 2 ปีการศึกษา 2563 ได้ <u>ตั้งแต่วันที่ 26 ตุลาคม 2563</u> เป็นต้นไป</p>-->		
											</div>	
										</div>
									</div>	
						<!--*******************************************************************************************************-->		

						<!--*******************************************************************************************************-->		

						<?php   } ?>


						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<?php
							if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){
								//------------------------------------------------------------------------------------------------------
							}else{ ?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--++++++++++++++++++++++++++++++++++++++++-->
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">
									<center><input  type="image"  src="Template/global_assets/images/ac03.jpg" data-toggle="modal" data-target="#myModal"></center>
								</div>
							</div><hr>
						<!--++++++++++++++++++++++++++++++++++++++++-->						
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
					<?php	}?>

							<div id="myModal" class="modal fade" role="dialog">
								<div class="modal-dialog">

								<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">รายการที่ลงทะเบียน</h4>
										</div>
										<div class="modal-body">
							<form>			
											<div class="row">
												<div class="col-<?php echo $grid;?>-12">
													<div class="table-responsive">
														  <table class="table table-hover">
															<thead>
															  <tr>
																<th>ลำดับ</th>
																<th>รายวิชา / กิจกรรมตามความถนัดและสนใจ</th>
																<th>ดำเนินการ</th>
															  </tr>
															</thead>
															<tbody>
															
													<?php
														$subject_printSql="select `supplementary_subject`.`ss_txtth`,`supplementary_subject`.`ss_id` 
																		   from `supplementary_subject` 
																		   join `supplementary_sturs` on (`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
																		   where`supplementary_sturs`.`sup_stuid`='{$user_login}' 
																		   and `supplementary_sturs`.`sup_t`='{$data_term}'
																		   and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
																		   and  `supplementary_sturs`.`sup_year`='{$data_yaer}'";
														$subject_printRs=new row_evaluation($subject_printSql);
														$count_subject_print=1;
														foreach($subject_printRs->evaluation_array as $rc_key=>$subject_printRow){ ?>
															
															  <tr>
																<td><?php echo $count_subject_print;?></td>
																<td><?php echo $subject_printRow["ss_txtth"];?></td>
																<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $subject_printRow["ss_id"];?>&system=system"><b style="color:#0623FB">ยกเลิกรายวิชานี้</b></a></td>
															  </tr>	
															  
												<?php	$count_subject_print=$count_subject_print+1;}?>		
															

															  
															</tbody>
														  </table>
													</div>
												</div>
											</div>
								</form>			
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
										</div>
									</div>

								</div>
							</div>



						<!--++++++++++++++++++++++++++++++++++++++++-->
						<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->


						<!--*******************************************************************************************************-->				
								<?php	}else{
										//************************************************************
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
			<?php
				if($data_stu->IDLevel>=31 and $data_stu->IDLevel<=33){
					$call_registration=new supplementary_registration($data_stu->IDLevel,$data_stu->rc_plan);
						if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){//รวมทั้งหมด 
						
						
						
						
						}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="N"){?>
						
							<?php
								$study_rcSql="SELECT count(`sup_stuid`) as num_stu FROM `supplementary_sturs` 
											  WHERE `sup_stuid`='{$user_login}'  
											  and `sup_t`='{$data_term}'  
											  and `sup_l`='{$data_stu->IDLevel}' 
											  and `sup_year`='{$data_yaer}'";
								$study_rc=new row_evaluation($study_rcSql);
								foreach($study_rc->evaluation_array as $rc_key=>$study_print){
									$num_stu=$study_print["num_stu"];
									
									if($num_stu>=$count_study){ ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==12){ ?>
						<!--***********************************************************************-->
								
								
								
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>		
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>			
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>			
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>	
										
										

						<!--***********************************************************************-->			
							<?php	}    ?>



											
						<!--***********************************************************************-->				
							<?php	}else{  ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==12){ ?>
						<!--***********************************************************************-->
								
								
								<?php
								$supplementary_notstudySql="SELECT count(`notstudy_stu`) as num_noty FROM `supplementary_notstudy` 
															WHERE `notstudy_stu`='{$user_login}' 
															and `notstudy_t`='{$data_term}' 
															and `notstudy_l`='{$data_stu->IDLevel}'
															and `notstudy_y`='{$data_yaer}'";
								$supplementary_notstudy=new notrow_evaluation($supplementary_notstudySql);
								foreach($supplementary_notstudy->evaluation_array as $rc_key=>$supplementary_notstudyRow){
									$num_noty=$supplementary_notstudyRow["num_noty"];
									if($num_noty>=1){ ?>
										
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<input type="hidden" value="stu_not" name="stu_not">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form><br>				
										
							<?php   }else{ ?>
							
										<?php
										$set_supplementarySql="SELECT count(`supplementary_id`) as `set_count` 
															   from `supplementary_school` 
															   where `supplementary_t`='{$data_term}' 
															   and `supplementary_levelA`='{$data_stu->IDLevel}' 
															   and `supplementary_planA`='{$data_stu->rc_plan}' 
															   and `supplementary_not`='N' 
															   and `supplementary_off`='1'";
										$set_supplementary=new notrow_evaluation ($set_supplementarySql);
										foreach($set_supplementary->evaluation_array as $rc_key=>$set_supplementaryRow){
											$set_count=$set_supplementaryRow["set_count"];
											if($set_count>=1){ ?>
												<p><a href="./?evaluation_mod=supplementary&notstudy=notstudy"><button type="button" class="btn btn-success">ไม่ลงเรียนเพิ่ม</button></a></p>						
									<?php	}else{ ?> 

									<?php	}
										}
									
									?>	
							
										
							<?php	}
									
								}?>
								
								
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->

						<!--***********************************************************************-->			
							<?php	}    ?>				
						<!--***********************************************************************-->								
							<?php	}  ?>
								
						<?php	}      ?>					
						
						
				<?php	}elseif($call_registration->sr_academic=="N" and $call_registration->sr_activity=="Y"){//เรียนเฉราะกิจกรรม 
						
						}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="Y"){//เรียนทั้ง วิชาการ และ กิจกรรม 
						//echo"44";
						?>
						
							<?php
								$study_rcSql="SELECT count(`sup_stuid`) as num_stu FROM `supplementary_sturs` 
											  WHERE `sup_stuid`='{$user_login}'  
											  and `sup_t`='{$data_term}'  
											  and `sup_l`='{$data_stu->IDLevel}' 
											  and `sup_year`='{$data_yaer}'";
								$study_rc=new row_evaluation($study_rcSql);
								foreach($study_rc->evaluation_array as $rc_key=>$study_print){
									$num_stu=$study_print["num_stu"];
									
									if($num_stu>=$count_study){ ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==12){ ?>
						<!--***********************************************************************-->
								
								
								
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>		
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>			
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>			
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>	
										
										

						<!--***********************************************************************-->			
							<?php	}    ?>



											
						<!--***********************************************************************-->				
							<?php	}else{  ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==12){ ?>
						<!--***********************************************************************-->
								
								
								<?php
								$supplementary_notstudySql="SELECT count(`notstudy_stu`) as num_noty FROM `supplementary_notstudy` 
															WHERE `notstudy_stu`='{$user_login}' 
															and `notstudy_t`='{$data_term}' 
															and `notstudy_l`='{$data_stu->IDLevel}'
															and `notstudy_y`='{$data_yaer}'";
								$supplementary_notstudy=new notrow_evaluation($supplementary_notstudySql);
								foreach($supplementary_notstudy->evaluation_array as $rc_key=>$supplementary_notstudyRow){
									$num_noty=$supplementary_notstudyRow["num_noty"];
									if($num_noty>=1){ ?>
										
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<input type="hidden" value="stu_not" name="stu_not">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form><br>				
										
							<?php   }else{ ?>
							
										<?php
										$set_supplementarySql="SELECT count(`supplementary_id`) as `set_count` 
															   from `supplementary_school` 
															   where `supplementary_t`='{$data_term}' 
															   and `supplementary_levelA`='{$data_stu->IDLevel}' 
															   and `supplementary_planA`='{$data_stu->rc_plan}' 
															   and `supplementary_not`='N' 
															   and `supplementary_off`='1'";
										$set_supplementary=new notrow_evaluation ($set_supplementarySql);
										foreach($set_supplementary->evaluation_array as $rc_key=>$set_supplementaryRow){
											$set_count=$set_supplementaryRow["set_count"];
											if($set_count>=1){ ?>
												<p><a href="./?evaluation_mod=supplementary&notstudy=notstudy"><button type="button" class="btn btn-success">ไม่ลงเรียนเพิ่ม</button></a></p>						
									<?php	}else{ ?> 

									<?php	}
										}
									
									?>	
							
										
							<?php	}
									
								}?>
								
								
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->

						<!--***********************************************************************-->			
							<?php	}    ?>				
						<!--***********************************************************************-->								
							<?php	}  ?>
								
						<?php	}      ?>				
					
					
				<?php	}else{
							//*************************************************************************************************
						}			
				}elseif($data_stu->IDLevel>=41 and $data_stu->IDLevel<=43){
														
						if($data_stu->rc_plan==13){
							$copy_plan=$data_stu->rc_plan;
						}else{
							$copy_plan=14;
						}
									
				
									
					
					$call_registration=new supplementary_registration($data_stu->IDLevel,$copy_plan);
						if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){//รวมทั้งหมด
						
						
						}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="N"){ ?>
						
							<?php
								$study_rcSql="SELECT count(`sup_stuid`) as num_stu FROM `supplementary_sturs` 
											  WHERE `sup_stuid`='{$user_login}'  
											  and `sup_t`='{$data_term}'  
											  and `sup_l`='{$data_stu->IDLevel}' 
											  and `sup_year`='{$data_yaer}'";
								$study_rc=new row_evaluation($study_rcSql);
								foreach($study_rc->evaluation_array as $rc_key=>$study_print){
									$num_stu=$study_print["num_stu"];
									
									if($num_stu>=1){ ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==13){ ?>
						<!--***********************************************************************-->
								
								
								
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>		
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>			
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>			
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>	
										
										

						<!--***********************************************************************-->			
							<?php	}    ?>



											
						<!--***********************************************************************-->				
							<?php	}else{  ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==13){ ?>
						<!--***********************************************************************-->
								
								
								<?php
								$supplementary_notstudySql="SELECT count(`notstudy_stu`) as num_noty FROM `supplementary_notstudy` 
															WHERE `notstudy_stu`='{$user_login}' 
															and `notstudy_t`='{$data_term}' 
															and `notstudy_l`='{$data_stu->IDLevel}'
															and `notstudy_y`='{$data_yaer}'";
								$supplementary_notstudy=new notrow_evaluation($supplementary_notstudySql);
								foreach($supplementary_notstudy->evaluation_array as $rc_key=>$supplementary_notstudyRow){
									$num_noty=$supplementary_notstudyRow["num_noty"];
									if($num_noty>=1){ ?>
										
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<input type="hidden" value="stu_not" name="stu_not">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form><br>				
										
							<?php   }else{ ?>
							
										<?php
										$set_supplementarySql="SELECT count(`supplementary_id`) as `set_count` 
															   from `supplementary_school` 
															   where `supplementary_t`='{$data_term}' 
															   and `supplementary_levelA`='{$data_stu->IDLevel}' 
															   and `supplementary_planA`='{$copy_plan}' 
															   and `supplementary_not`='N' 
															   and `supplementary_off`='1'";
										$set_supplementary=new notrow_evaluation ($set_supplementarySql);
										foreach($set_supplementary->evaluation_array as $rc_key=>$set_supplementaryRow){
											$set_count=$set_supplementaryRow["set_count"];
											if($set_count>=1){ ?>
												<p><a href="./?evaluation_mod=supplementary&notstudy=notstudy"><button type="button" class="btn btn-success">ไม่ลงเรียนเพิ่ม</button></a></p>						
									<?php	}else{ ?> 

									<?php	}
										}
									
									?>	
							
										
							<?php	}
									
								}?>
								
								
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->

						<!--***********************************************************************-->			
							<?php	}    ?>				
						<!--***********************************************************************-->								
							<?php	}  ?>
								
						<?php	}      ?>					
						
						
				<?php	}elseif($call_registration->sr_academic=="N" and $call_registration->sr_activity=="Y"){//เรียนเฉราะกิจกรรม 
						
						}elseif($call_registration->sr_academic=="Y" and $call_registration->sr_activity=="Y"){//เรียนทั้ง วิชาการ และ กิจกรรม ?>
						
							<?php
								$study_rcSql="SELECT count(`sup_stuid`) as num_stu FROM `supplementary_sturs` 
											  WHERE `sup_stuid`='{$user_login}'  
											  and `sup_t`='{$data_term}'  
											  and `sup_l`='{$data_stu->IDLevel}' 
											  and `sup_year`='{$data_yaer}'";
								$study_rc=new row_evaluation($study_rcSql);
								foreach($study_rc->evaluation_array as $rc_key=>$study_print){
									$num_stu=$study_print["num_stu"];
									
									if($num_stu>=1){ ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==13){ ?>
						<!--***********************************************************************-->
								
								
								
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>		
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>			
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form>			
								<div class="alert alert-info">

								<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถ นำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ตั้งแต่วันนี้เป็นต้นไป...</p>		

								</div>	
										
										

						<!--***********************************************************************-->			
							<?php	}    ?>



											
						<!--***********************************************************************-->				
							<?php	}else{  ?>
						<!--***********************************************************************-->
							<?php
								if($data_stu->rc_plan==13){ ?>
						<!--***********************************************************************-->
								
								
								<?php
								$supplementary_notstudySql="SELECT count(`notstudy_stu`) as num_noty FROM `supplementary_notstudy` 
															WHERE `notstudy_stu`='{$user_login}' 
															and `notstudy_t`='{$data_term}' 
															and `notstudy_l`='{$data_stu->IDLevel}'
															and `notstudy_y`='{$data_yaer}'";
								$supplementary_notstudy=new notrow_evaluation($supplementary_notstudySql);
								foreach($supplementary_notstudy->evaluation_array as $rc_key=>$supplementary_notstudyRow){
									$num_noty=$supplementary_notstudyRow["num_noty"];
									if($num_noty>=1){ ?>
										
								<form name="print_supp" action="<?php echo $golink;?>/print_supplementary/special/<?php echo $user_login;?>" method="post" target="_blank">
									
										<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
										<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
										<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
										
										<input type="hidden" value="stu_not" name="stu_not">
										
										<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
										
								</form><br>				
										
							<?php   }else{ ?>
							
										<?php
										$set_supplementarySql="SELECT count(`supplementary_id`) as `set_count` 
															   from `supplementary_school` 
															   where `supplementary_t`='{$data_term}' 
															   and `supplementary_levelA`='{$data_stu->IDLevel}' 
															   and `supplementary_planA`='{$copy_plan}' 
															   and `supplementary_not`='N' 
															   and `supplementary_off`='1'";
										$set_supplementary=new notrow_evaluation ($set_supplementarySql);
										foreach($set_supplementary->evaluation_array as $rc_key=>$set_supplementaryRow){
											$set_count=$set_supplementaryRow["set_count"];
											if($set_count>=1){ ?>
												<p><a href="./?evaluation_mod=supplementary&notstudy=notstudy"><button type="button" class="btn btn-success">ไม่ลงเรียนเพิ่ม</button></a></p>						
									<?php	}else{ ?> 

									<?php	}
										}
									
									?>	
							
										
							<?php	}
									
								}?>
								
								
						<!--***********************************************************************-->			
							<?php	}else{ ?>
						<!--***********************************************************************-->

						<!--***********************************************************************-->			
							<?php	}    ?>				
						<!--***********************************************************************-->								
							<?php	}  ?>
								
						<?php	}      ?>				
							
				<?php	}else{
								// echo "dd";//*************************************************************************************************
						}				
				}else{
					
				}
			?>							
		<!--///////////////////////////////////////////////////////////////////////////////////////////////////////-->		
						<?php	break;
							}
						?>
	
		<?php	} ?>

<!--#######################################################################################################-->			
<?php	}      ?>


<?php   } ?><!--OFF-->