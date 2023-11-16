<?php
		if($print_runtime=="ON"){ ?>
<?php
	$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
	
	
	if($data_stu->IDLevel>=3 and $data_stu->IDLevel<=3){ ?>
<!------------------------------------------------------------------------------------------------------->		
		


		
			<?php
				//sr_academic -> วิชาการ
				//sr_activity -> กิจกรรม
				$call_registration=new supplementary_registration($data_stu->IDLevel);
				if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){ //รวมทั้งหมด?>
<!------------------------------------------------------------------------------------------------------->					
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading"><center><h5>เหลือเวลาลงทะเบียนเรียน เรียนเสริมเย็น<div id="demo"></div></h5></center></div>
		</div>
	</div>
</div><hr>				



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
													 and `supplementary_planB`<='{$data_stu->rc_plan}'; ";
									$call_schoolRs=new row_evaluation($call_schoolSql);
									foreach($call_schoolRs->evaluation_array as $rc_key=>$call_schoolRow){ 
									
										if($data_stu->IDLevel>=$call_schoolRow["supplementary_levelA"] and $data_stu->IDLevel<=$call_schoolRow["supplementary_levelB"]){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<tr>
											<td><?php echo $call_schoolRow["supplementary_txt"];?></td>
											<td><?php echo $call_schoolRow["supplementary_pay"]." บาท";?></td>
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
		
<!------------------------------------------------------------------------------------------------------->
<?php	}elseif($data_stu->IDLevel>=11 and $data_stu->IDLevel<=23){ ?>
<!------------------------------------------------------------------------------------------------------->			
<!------------------------------------------------------------------------------------------------------->		
		


		
			<?php
				//sr_academic -> วิชาการ
				//sr_activity -> กิจกรรม
				$call_registration=new supplementary_registration($data_stu->IDLevel);
				if($call_registration->sr_academic=="Y2" and $call_registration->sr_activity=="Y2"){ //รวมทั้งหมด?>
<!------------------------------------------------------------------------------------------------------->					
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading"><center><h5>เหลือเวลาลงทะเบียนเรียน เรียนเสริมเย็น<div id="demo"></div></h5></center></div>
		</div>
	</div>
</div><hr>				



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
													 and `supplementary_planB`<='{$data_stu->rc_plan}'; ";
									$call_schoolRs=new row_evaluation($call_schoolSql);
									foreach($call_schoolRs->evaluation_array as $rc_key=>$call_schoolRow){ 
									
										if($data_stu->IDLevel>=$call_schoolRow["supplementary_levelA"] and $data_stu->IDLevel<=$call_schoolRow["supplementary_levelB"]){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<tr>
											<td><?php echo $call_schoolRow["supplementary_txt"];?></td>
											<td><?php echo $call_schoolRow["supplementary_pay"]." บาท";?></td>
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
																   and `ss_plan`='{$data_stu->rc_plan}'";
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
													   WHERE  `ss_t` ='{$data_term}' and `ss_l` = '{$data_stu->IDLevel}' and `ss_year` = '{$data_yaer}' and `ss_plan` = '{$data_stu->rc_plan}'";
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
											<td><?php echo $call_schoolRow["supplementary_pay"]." บาท";?></td>
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
		
		
		</div>
	</div>				
<!--***************************************************************************************************-->					
		<?php	}      ?>
		
<!------------------------------------------------------------------------------------------------------->


		



<!------------------------------------------------------------------------------------------------------->			
<?php	}elseif($data_stu->IDLevel>=31 and $data_stu->IDLevel<=33){ ?>
		


















<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading"><center><h5>เหลือเวลาลงทะเบียนเรียน เรียนเสริมเย็น<div id="demo"></div></h5></center></div>
		</div>
	</div>
</div><hr>		

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
											   and `ss_year`='{$data_yaer}' ";
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
											and `ss_year`='{$data_yaer}' ";
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
											and `ss_year`='{$data_yaer}' ";
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
											and `ss_year`='{$data_yaer}' ";
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
											and `ss_year`='{$data_yaer}' ";
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
											and `ss_year`='{$data_yaer}' ";
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
											and `ss_year`='{$data_yaer}' ";
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
											and `ss_year`='{$data_yaer}' ";
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
		
	<div class="class="col-<?php echo $grid;?>-12">
	
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
		
		
		
		<form name="print_supp" action="view/mod/student/code/stu_supplementary/supplementary_print.php" method="post" target="_blank">
			
				<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
				<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
				<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
				
				<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
				
		</form>		
		<div class="alert alert-info">

		<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถพิมพ์ ใบยืนยันการลงทะเบียน ได้ในวันจันทร์ ที่ 6 ก.ค 2563 ถึง วันพุธที่ 8 ก.ค 2563 และนำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ระหว่างวันที่ 8 ถึง 31 ก.ค 2563</p>		

		</div>			
<!--***********************************************************************-->			
	<?php	}else{ ?>
<!--***********************************************************************-->
		<form name="print_supp" action="view/mod/student/code/stu_supplementary/supplementary_print.php" method="post" target="_blank">
			
				<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
				<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
				<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
				
				<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
				
		</form>			
		<div class="alert alert-info">

		<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถพิมพ์ ใบยืนยันการลงทะเบียน ได้ในวันจันทร์ ที่ 6 ก.ค 2563 ถึง วันพุธที่ 8 ก.ค 2563 และนำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ระหว่างวันที่ 8 ถึง 31 ก.ค 2563</p>		

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
				
		<form name="print_supp" action="view/mod/student/code/stu_supplementary/supplementary_print.php" method="post" target="_blank">
			
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
						
			<?php	}else{ ?> 
						<p><a href="./?evaluation_mod=supplementary&notstudy=notstudy"><button type="button" class="btn btn-success">ไม่ลงเรียนเพิ่ม</button></a></p>
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



	
	


<?php	}elseif($data_stu->IDLevel>=41 and $data_stu->IDLevel<=43){ ?>

<?php
	if($data_stu->rc_plan==13){
		$copy_plan=$data_stu->rc_plan;
	}else{
		$copy_plan=14;
	}
?>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading"><center><h5>เหลือเวลาลงทะเบียนเรียน เรียนเสริมเย็น<div id="demo"></div></h5></center></div>
		</div>
	</div>
</div><hr>		

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
											   and `ss_year`='{$data_yaer}' ";
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
							   and `sup_l`='{$data_stu->IDLevel}' 
							   and `sup_year`='{$data_yaer}' 
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
											and `ss_year`='{$data_yaer}' ";
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
											and `ss_year`='{$data_yaer}' ";
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
											and `ss_year`='{$data_yaer}' ";
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
											and `ss_year`='{$data_yaer}' ";
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
											and `ss_year`='{$data_yaer}' ";
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
											and `ss_year`='{$data_yaer}' ";
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
											and `ss_year`='{$data_yaer}' ";
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
		
	<div class="class="col-<?php echo $grid;?>-12">
	
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
		
		foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
			$print_sdp_key=$print_dayplanRow["sdp_key"];
			$print_sd_mon=$print_dayplanRow["sd_mon"];
			$print_sd_tue=$print_dayplanRow["sd_tue"];
			$print_sd_wed=$print_dayplanRow["sd_wed"];
			$print_sd_thu=$print_dayplanRow["sd_thu"];
			$print_sd_frl=$print_dayplanRow["sd_frl"];
			$print_sd_sat=$print_dayplanRow["sd_sat"];
			$print_sd_sun=$print_dayplanRow["sd_sun"];
			$count_study=0;
			
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
		$study_rc=new notrow_evaluation($study_rcSql);
		foreach($study_rc->evaluation_array as $rc_key=>$study_print){
			$num_stu=$study_print["num_stu"];
				
			if($num_stu>=1){ ?>
<!--***********************************************************************-->
	<?php
		if($data_stu->rc_plan==13){ ?>
<!--***********************************************************************-->
		<form name="print_supp" action="view/mod/student/code/stu_supplementary/supplementary_print.php" method="post" target="_blank">
			
				<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
				<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
				<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
				
				<button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button>
				
		</form><br>
		<div class="alert alert-info">

		<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถพิมพ์ ใบยืนยันการลงทะเบียน ได้ในวันจันทร์ ที่ 6 ก.ค 2563 ถึง วันพุธที่ 8 ก.ค 2563 และนำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ระหว่างวันที่ 8 ถึง 31 ก.ค 2563</p>		

		</div>			
<!--***********************************************************************-->			
	<?php	}else{ ?>
<!--***********************************************************************-->
		<form name="print_supp" action="view/mod/student/code/stu_supplementary/supplementary_print.php" method="post" target="_blank">
			
				<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
				<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
				<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
				
				<button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button>
				
		</form><br>
		<div class="alert alert-info">

		<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถพิมพ์ ใบยืนยันการลงทะเบียน ได้ในวันจันทร์ ที่ 6 ก.ค 2563 ถึง วันพุธที่ 8 ก.ค 2563 และนำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ระหว่างวันที่ 8 ถึง 31 ก.ค 2563</p>		

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
		$supplementary_schoolSql="SELECT `supplementary_not` 
							      FROM `supplementary_school` 
								  WHERE`supplementary_t`='{$data_term}'
								  and`supplementary_levelA`='{$data_stu->IDLevel}' 
								  and`supplementary_planA`='{$data_stu->rc_plan}'
								  and `supplementary_not`='N'";
		$supplementary_school=new notrow_evaluation($supplementary_schoolSql);
		foreach($supplementary_school->evaluation_array as $rc_key=>$supplementary_schoolRow){
			$supplementary_not=$supplementary_schoolRow["supplementary_not"];
			if($supplementary_not=="N"){ ?>
				
				
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
				
		<form name="print_supp" action="view/mod/student/code/stu_supplementary/supplementary_print.php" method="post" target="_blank"  >
			
				<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
				<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
				<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
				
				<input type="hidden" value="stu_not" name="stu_not">
				
				<button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button>
				
		</form><br>				
				
	<?php   }else{?>
	
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
						
			<?php	}else{ ?> 
						<a href="./?evaluation_mod=supplementary&notstudy=notstudy"><button type="button" class="btn btn-success">ไม่ลงเรียนเพิ่ม</button></a>
			<?php	}
				}
			
			?>	
	
				
	<?php	}
			
		}
	?>			
				
				
				
				
				
	<?php	}else{ ?>
				
	<?php	}
		}
	?>	
		
		
		
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

<?php	}else{ ?>
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="alert alert-danger">
							<strong>ไม่มีสิทธ์ เข้าถึงหน้านี้</strong> 
						</div>
					</div>
				</div>			
<?php	}  ?>		
		
	
		
		
	
		
		
		
<?php	}elseif($print_runtime=="OFF"){ ?>
		
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger">
			<p><strong>ปิดระบบ...</strong>สิ้นสุดระยะเวลาลงทะเบียนเรียนเสริมนอกตารางแล้ว ในขณะนี้ พบข้อสงสัย ติดต่อสอบถาม ได้ที่ห้องวิชาการ</p>		
		</div>	
	</div>
</div>		

<?php
	$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
	$count_stursSql="SELECT count(`sup_stuid`) as `num_stu` 
				     FROM  `supplementary_sturs` 
					 WHERE `sup_stuid`='{$user_login}' 
					 and   `sup_t`='{$data_term}' 
					 and   `sup_l`='{$data_stu->IDLevel}' 
					 and   `sup_year`='{$data_yaer}'";
	$count_stursRs=new notrow_evaluation($count_stursSql);
	foreach($count_stursRs->evaluation_array as $rc_key=>$count_stursRow){
		$num_stu=$count_stursRow["num_stu"];
		if($num_stu>=1){ ?>
<!--**********************************************************************-->
  <div class="panel panel-default">
    <div class="panel-heading">รายการเรียนเสริมเย็น ภาคเรียนที่ : <?php echo $data_term;?> ปีการศึกษา : <?php echo $data_yaer;?></div>
    <div class="panel-body">
	
		<div class="table-responsive">
			  <table class="table table-striped">
				<thead>
				  <tr>
					  <th>ลำดับ</th>
					  <th>รหัสวิชา</th>
					  <th>วิชา</th>
					  <th>วันที่เรียน</th>
				  </tr>
				</thead>
				<tbody>

<?php
	$count_num=1;
	$print_subjectSql="SELECT `supplementary_subject`.`ss_id` , `supplementary_subject`.`ss_txtth` , `supplementary_sturs`.`ss_mon` , `supplementary_sturs`.`ss_tues` , `supplementary_sturs`.`ss_wedne` , `supplementary_sturs`.`ss_thurs` , `supplementary_sturs`.`ss_fri` , `supplementary_sturs`.`ss_satur` , `supplementary_sturs`.`ss_sun`
					   FROM `supplementary_sturs`
					   JOIN `supplementary_subject` ON ( `supplementary_sturs`.`ss_id` = `supplementary_subject`.`ss_id` )
					   WHERE `supplementary_sturs`.`sup_stuid` = '{$user_login}'
					   AND `supplementary_sturs`.`sup_t` = '{$data_term}'
					   AND `supplementary_sturs`.`sup_l` = '{$data_stu->IDLevel}'
					   AND `supplementary_sturs`.`sup_year` = '{$data_yaer}'";
	$print_subjectRs=new row_evaluation($print_subjectSql);
	foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectRow){

		if($print_subjectRow["ss_mon"]==1){ ?>
    <tr>
		<td><?php echo $count_num;?></td>
		<td>&nbsp;<?php echo $print_subjectRow["ss_id"];?></td>
		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันจันทร์</td>
    </tr>			
<?php	}else{
			
			
		}		
		
		if($print_subjectRow["ss_tues"]==1){ ?>
    <tr>
		<td><?php echo $count_num;?></td>		
		<td>&nbsp;<?php echo $print_subjectRow["ss_id"];?></td>
		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันอังคาร</td>
    </tr>	
<?php	}else{
			
			
		}		
		
		if($print_subjectRow["ss_wedne"]==1){ ?>
    <tr>
		<td><?php echo $count_num;?></td>
		<td>&nbsp;<?php echo $print_subjectRow["ss_id"];?></td>
		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันพุธ</td>
    </tr>
<?php	}else{


		}		
		
		if($print_subjectRow["ss_thurs"]==1){ ?>
    <tr>
		<td><?php echo $count_num;?></td>
		<td>&nbsp;<?php echo $print_subjectRow["ss_id"];?></td>
		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันพฤหัสบดี</td>		
    </tr>			
<?php   }else{
			
		}		
		
		if($print_subjectRow["ss_fri"]==1){ ?>
    <tr>
		<td><?php echo $count_num;?></td>		
		<td>&nbsp;<?php echo $print_subjectRow["ss_id"];?></td>
		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันศุกร์</td>
    </tr>			
<?php	}else{
			
		}		
		
		if($print_subjectRow["ss_satur"]==1){ ?>
    <tr>
		<td><?php echo $count_num;?></td>		
		<td>&nbsp;<?php echo $print_subjectRow["ss_id"];?></td>
		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันเสาร์</td>
    </tr>			
<?php	}else{
			
		}		
		
		if($print_subjectRow["ss_sun"]==1){ ?>
    <tr>
		<td><?php echo $count_num;?></td>		
		<td>&nbsp;<?php echo $print_subjectRow["ss_id"];?></td>
		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันอาทิตย์</td>
    </tr>			
<?php	}else{
			
		}
		
	$count_num=$count_num+1;}
?>	
	
<?php
	if($data_stu->IDLevel==31){
		if($data_stu->rc_plan==12){ ?>		
			<?php
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y' 
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
					<!--<tr>
					  <td colspan="3"><center>รวม</center></td>
					  <td><center><?php //echo $pay_row["supplementary_pay"]." บาท";?></center></td>
					</tr>-->					
		  <?php } ?>
<?php	}else{ ?>
			<?php
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
					<!--<tr>
					  <td colspan="3"><center>รวม</center></td>
					  <td><center><?php //echo $pay_row["supplementary_pay"]." บาท";?></center></td>
					</tr>-->					
		<?php	}?>
<?php	}
	}elseif($data_stu->IDLevel==32){
		if($data_stu->rc_plan==12){ ?>
			<?php
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y' 
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
					<!--<tr>
					  <td colspan="3"><center>รวม</center></td>
					  <td><center><?php //echo $pay_row["supplementary_pay"]." บาท";?></center></td>
					</tr>-->					
		  <?php } ?>			
<?php	}else{ ?>
			<?php
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
					<!--<tr>
					  <td colspan="3"><center>รวม</center></td>
					  <td><center><?php //echo $pay_row["supplementary_pay"]." บาท";?></center></td>
					</tr>-->					
		<?php	}?>			
<?php	}		
	}elseif($data_stu->IDLevel==33){
		if($data_stu->rc_plan==12){ ?>
			<?php
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y' 
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
					<!--<tr>
					  <td colspan="3"><center>รวม</center></td>
					  <td><center><?php //echo $pay_row["supplementary_pay"]." บาท";?></center></td>
					</tr>-->					
		  <?php } ?>			
<?php	}else{ ?>
			<?php
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
					<!--<tr>
					  <td colspan="3"><center>รวม</center></td>
					  <td><center><?php// echo $pay_row["supplementary_pay"]." บาท";?></center></td>
					</tr>-->					
		<?php	}?>			
<?php	}		
	}elseif($data_stu->IDLevel==41){
		if($data_stu->rc_plan==13){
			
			
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y' 
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ 
					$supplementary_pay=$pay_row["supplementary_pay"];
					if($supplementary_pay==""){
						$set_pay=0;
					}else{
						$set_pay=$supplementary_pay;
					}
				} 	

				$count_subjectSql="SELECT count(`sup_stuid`) as set_subject 
								   FROM `supplementary_sturs` 
								   WHERE `sup_stuid`='{$user_login}' 
								   and `sup_t`='{$data_term}' 
								   and `sup_l`='{$data_stu->IDLevel}' 
								   and `sup_year`='{$data_yaer}'";
				$count_subjectRs=new notrow_evaluation($count_subjectSql);
				foreach($count_subjectRs->evaluation_array as $rc_key=>$count_subjectRow){
					$set_subject=$count_subjectRow["set_subject"];
					if($set_subject==""){
						$set_subject=0;
					}else{
						$set_subject;
					}
				}
				
				$payIPSTSql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
							 FROM `supplementary_school` 
						     WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						     and `supplementary_not`='N' 
						     and `supplementary_planA`='{$data_stu->rc_plan}'";
				$payIPSTRs=new notrow_evaluation($payIPSTSql);
				foreach($payIPSTRs->evaluation_array as $rc_key=>$payIPSTRow){
					$set_IPST=$payIPSTRow["supplementary_pay"];
					if($set_IPST==""){
						$set_IPST=0;
					}else{
						$set_IPST;
					}
				}
				
				$set_sum=$set_IPST+($set_pay*$set_subject);
				
				?>
					
					<!--<tr>
					  <td colspan="3"><center>รวม</center></td>
					  <td><center><?php //echo  $set_sum." บาท";?></center></td>
					</tr>-->				
				
				
<?php	}else{
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y' 
						  and `supplementary_planA`='14'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ 
					$supplementary_pay=$pay_row["supplementary_pay"];
					if($supplementary_pay==""){
						$set_pay=0;
					}else{
						$set_pay=$supplementary_pay;
					}
				} 
				
				$count_subjectSql="SELECT count(`sup_stuid`) as set_subject 
								   FROM `supplementary_sturs` 
								   WHERE `sup_stuid`='{$user_login}' 
								   and `sup_t`='{$data_term}' 
								   and `sup_l`='{$data_stu->IDLevel}' 
								   and `sup_year`='{$data_yaer}'";
				$count_subjectRs=new notrow_evaluation($count_subjectSql);
				foreach($count_subjectRs->evaluation_array as $rc_key=>$count_subjectRow){
					$set_subject=$count_subjectRow["set_subject"];
					if($set_subject==""){
						$set_subject=0;
					}else{
						$set_subject;
					}
				} 
				$set_sum=($set_pay*$set_subject);
				?>
				
				<!--<tr>
					<td colspan="3"><center>รวม</center></td>
					<td><center><?php //echo $set_sum." บาท";?></center></td>
				</tr>-->
				
<?php	}
	}elseif($data_stu->IDLevel==42){
		if($data_stu->rc_plan==13){

				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y' 
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ 
					$supplementary_pay=$pay_row["supplementary_pay"];
					if($supplementary_pay==""){
						$set_pay=0;
					}else{
						$set_pay=$supplementary_pay;
					}
				} 	

				$count_subjectSql="SELECT count(`sup_stuid`) as set_subject 
								   FROM `supplementary_sturs` 
								   WHERE `sup_stuid`='{$user_login}' 
								   and `sup_t`='{$data_term}' 
								   and `sup_l`='{$data_stu->IDLevel}' 
								   and `sup_year`='{$data_yaer}'";
				$count_subjectRs=new notrow_evaluation($count_subjectSql);
				foreach($count_subjectRs->evaluation_array as $rc_key=>$count_subjectRow){
					$set_subject=$count_subjectRow["set_subject"];
					if($set_subject==""){
						$set_subject=0;
					}else{
						$set_subject;
					}
				}
				
				$payIPSTSql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
							 FROM `supplementary_school` 
						     WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						     and `supplementary_not`='N' 
						     and `supplementary_planA`='{$data_stu->rc_plan}'";
				$payIPSTRs=new notrow_evaluation($payIPSTSql);
				foreach($payIPSTRs->evaluation_array as $rc_key=>$payIPSTRow){
					$set_IPST=$payIPSTRow["supplementary_pay"];
					if($set_IPST==""){
						$set_IPST=0;
					}else{
						$set_IPST;
					}
				}
				
				$set_sum=$set_IPST+($set_pay*$set_subject);
				
				?>
					
					<!--<tr>
					  <td colspan="3"><center>รวม</center></td>
					  <td><center><?php //echo $set_sum." บาท";?></center></td>
					</tr>--> 
			
<?php	}else{
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y' 
						  and `supplementary_planA`='14'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ 
					$supplementary_pay=$pay_row["supplementary_pay"];
					if($supplementary_pay==""){
						$set_pay=0;
					}else{
						$set_pay=$supplementary_pay;
					}
				} 
				
				$count_subjectSql="SELECT count(`sup_stuid`) as set_subject 
								   FROM `supplementary_sturs` 
								   WHERE `sup_stuid`='{$user_login}' 
								   and `sup_t`='{$data_term}' 
								   and `sup_l`='{$data_stu->IDLevel}' 
								   and `sup_year`='{$data_yaer}'";
				$count_subjectRs=new notrow_evaluation($count_subjectSql);
				foreach($count_subjectRs->evaluation_array as $rc_key=>$count_subjectRow){
					$set_subject=$count_subjectRow["set_subject"];
					if($set_subject==""){
						$set_subject=0;
					}else{
						$set_subject;
					}
				} 
				$set_sum=($set_pay*$set_subject);
				?>
				
				<!--<tr>
					<td colspan="3"><center>รวม</center></td>
					<td><center><?php //echo $set_sum." บาท";?></center></td>
				</tr>-->			
<?php	}	
	}elseif($data_stu->IDLevel==43){
		if($data_stu->rc_plan==13){
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y' 
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ 
					$supplementary_pay=$pay_row["supplementary_pay"];
					if($supplementary_pay==""){
						$set_pay=0;
					}else{
						$set_pay=$supplementary_pay;
					}
				} 	

				$count_subjectSql="SELECT count(`sup_stuid`) as set_subject 
								   FROM `supplementary_sturs` 
								   WHERE `sup_stuid`='{$user_login}' 
								   and `sup_t`='{$data_term}' 
								   and `sup_l`='{$data_stu->IDLevel}' 
								   and `sup_year`='{$data_yaer}'";
				$count_subjectRs=new notrow_evaluation($count_subjectSql);
				foreach($count_subjectRs->evaluation_array as $rc_key=>$count_subjectRow){
					$set_subject=$count_subjectRow["set_subject"];
					if($set_subject==""){
						$set_subject=0;
					}else{
						$set_subject;
					}
				}
				
				$payIPSTSql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
							 FROM `supplementary_school` 
						     WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						     and `supplementary_not`='N' 
						     and `supplementary_planA`='{$data_stu->rc_plan}'";
				$payIPSTRs=new notrow_evaluation($payIPSTSql);
				foreach($payIPSTRs->evaluation_array as $rc_key=>$payIPSTRow){
					$set_IPST=$payIPSTRow["supplementary_pay"];
					if($set_IPST==""){
						$set_IPST=0;
					}else{
						$set_IPST;
					}
				}
				
				$set_sum=$set_IPST+($set_pay*$set_subject);
				
				?>
					
					<!--<tr>
					  <td colspan="3"><center>รวม</center></td>
					  <td><center><?php //echo $set_sum." บาท";?></center></td>
					</tr>-->			
<?php	}else{
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y' 
						  and `supplementary_planA`='14'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ 
					$supplementary_pay=$pay_row["supplementary_pay"];
					if($supplementary_pay==""){
						$set_pay=0;
					}else{
						$set_pay=$supplementary_pay;
					}
				} 
				
				$count_subjectSql="SELECT count(`sup_stuid`) as set_subject 
								   FROM `supplementary_sturs` 
								   WHERE `sup_stuid`='{$user_login}' 
								   and `sup_t`='{$data_term}' 
								   and `sup_l`='{$data_stu->IDLevel}' 
								   and `sup_year`='{$data_yaer}'";
				$count_subjectRs=new notrow_evaluation($count_subjectSql);
				foreach($count_subjectRs->evaluation_array as $rc_key=>$count_subjectRow){
					$set_subject=$count_subjectRow["set_subject"];
					if($set_subject==""){
						$set_subject=0;
					}else{
						$set_subject;
					}
				} 
				$set_sum=($set_pay*$set_subject);
				?>
				
				<!--<tr>
					<td colspan="3"><center>รวม</center></td>
					<td><center><?php //echo $set_sum." บาท";?></center></td>
				</tr>-->			
<?php	}		
	}else{
		
	}

?>

				</tbody>
			  </table>
		</div>	
	</div>
  </div>
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
			<form name="print_supp" action="view/mod/student/code/stu_supplementary/supplementary_print.php" method="post" target="_blank">
			
				<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
				<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
				<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
	
				<center><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></center>
			</form>			
			</div>
		</div>
<!--**********************************************************************-->
<?php		}else{
			$count_notstudySql="SELECT count(`notstudy_stu`) as `count_notstudy`
								FROM `supplementary_notstudy` 
								WHERE `notstudy_stu`='{$user_login}' 
								and `notstudy_t`='{$data_term}' 
								and `notstudy_l`='{$data_stu->IDLevel}'
								and `notstudy_y`='{$data_yaer}'";
			$count_notstudyRs=new notrow_evaluation($count_notstudySql);
			foreach($count_notstudyRs->evaluation_array as $rc_key=>$count_notstudyRow){
				$count_notstudy=$count_notstudyRow["count_notstudy"];
				if($count_notstudy>=1){ ?>
<!--**********************************************************************-->
	<div class="panel panel-default">
		<div class="panel-heading">รายการเรียนเสริมเย็น ภาคเรียนที่ : <?php echo $data_term;?> ปีการศึกษา : <?php echo $data_yaer;?></div>
		<div class="panel-body">
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="table-responsive">
						  <table class="table table-hover">
							<thead>
							  <tr>
								<th>รายการ</th>
							  </tr>
							</thead>
							<tbody>
							
								<?php
									$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
											  FROM `supplementary_school` 
											  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
											  and `supplementary_not`='N'
											  and `supplementary_planA`='{$data_stu->rc_plan}'";
									$pay_rs=new notrow_evaluation($pay_sql);
									foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
									<tr>
									  <td><?php echo $pay_row["supplementary_txt"];?></td>
									</tr>				
							<?php	}?>	
							  
							</tbody>
						  </table>
					</div>				
				</div>
			</div>	
		</div>
    </div>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<form name="print_supp" action="view/mod/student/code/stu_supplementary/supplementary_print.php" method="post" target="_blank"  >
						
							<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
							<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
							<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
							
							<input type="hidden" value="stu_not" name="stu_not">
							
							<center><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></center>
							
					</form>				
				</div>
			</div>


<!--**********************************************************************-->								
	<?php		}else{ ?>
<!--**********************************************************************-->
	<?php
		if($data_stu->IDLevel>=3 and $data_stu->IDLevel<=3){
			
		}elseif($data_stu->IDLevel>=11 and $data_stu->IDLevel<=23){
			
		}else{ ?>
		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning">
				<strong>ไม่พบข้อมูล</strong>ลงทะเบียนเรียนเสริมนอกตารางเรียน
			</div>
		</div>
	</div>	
<?php	}
	
	?>


<!--**********************************************************************-->					
<?php				}
			}
			
		}

		
	}
?>		
		
<?php	}else{
		
		
	}


?>