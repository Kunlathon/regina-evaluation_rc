
<?php
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_pdo.php");	
	
	include("../../../../database/database_paynew.php");
	include("../../../../database/class_pay.php");


	$call_ssid=filter_input(INPUT_POST,'call_ssid');
	$call_yaer=filter_input(INPUT_POST,'call_yaer');
	$call_term=filter_input(INPUT_POST,'call_term');

?>
												<hr>
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
										$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime` FROM `supplementary_sturs`
																 WHERE `ss_id`='{$call_ssid}' 
																 and `sup_t`='{$call_term}'
																 and `sup_year`='{$call_yaer}'
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

																  
																  

																  
																  
																  
																</tbody>
															  </table>
														</div>				
													</div>
												</div>