<?php
include("../../../../database/database_evaluation.php");
include("../../../../database/pdo_data.php");
include("../../../../database/class_pdo.php");	

$subjectid=filter_input(INPUT_POST,'subjectid');
$day=filter_input(INPUT_POST,'day');
$data_yaer=filter_input(INPUT_POST,'data_yaer');
$data_term=filter_input(INPUT_POST,'data_term');
$user_login=filter_input(INPUT_POST,'user_login');
$datetime=filter_input(INPUT_POST,'datetime');	
$copy_ss_id=filter_input(INPUT_POST,'copy_ss_id');

$ss_activity=filter_input(INPUT_POST,'call_clik');
	
$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);

//****************************************************************
	if($data_stu->IDLevel>=31 and $data_stu->IDLevel<=33){
		if($data_stu->rc_plan==12){
			$copy_plan=$data_stu->rc_plan;
		}else{
			$copy_plan=2;
		}
	}elseif($data_stu->IDLevel>=41 and $data_stu->IDLevel<=43){
		if($data_stu->rc_plan==13){
			$copy_plan=$data_stu->rc_plan;
		}else{
			$copy_plan=14;
		}		
	}else{
		//********************************************************
	}
//****************************************************************
	$datetime_cr=date("Y-m-d H:i:s");
	$datatime_notrun=strtotime($datetime);
	$datatime_run=strtotime($datetime_cr);
		if($datatime_run>=$datatime_notrun){
			$print_runtime="OFF";
		}else{
			$print_runtime="ON";
		}
//****************************************************************	
	
if($subjectid=="" and $day==""){
	exit("<meta charset='utf-8'/><script>alert('เกิดข้อผิดพลาดไม่สามารถสมัครได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
}elseif($subjectid=="" or $day==""){
	exit("<meta charset='utf-8'/><script>alert('เกิดข้อผิดพลาดไม่สามารถสมัครได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
}elseif($print_runtime=="OFF"){
	exit("<meta charset='utf-8'/><script>alert('หมดเวลารับสมัครเรียนเสริมนอกตารางเรียน');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
}elseif($print_runtime=="ON"){
	
	
		$TestSupplementarraySql="SELECT count(`sup_stuid`) AS `test_rc`
        		                 FROM `supplementary_sturs` 
								 WHERE `sup_stuid`='{$user_login}' 
								 AND `sup_t`='{$data_term}' 
								 AND `sup_l`='{$data_stu->IDLevel}' 
								 AND `sup_year`='{$data_yaer}' 
								 AND `ss_id`='{$subjectid}';"; 
	
		$TestSupplementarrayRs=new row_evaluation($TestSupplementarraySql);
		foreach($TestSupplementarrayRs->evaluation_array as $rc_key=>$TestSupplementarrayRow){
			$test_rc=$TestSupplementarrayRow["test_rc"];
		}
	
		if($test_rc>=1){
			exit("<meta charset='utf-8'/><script>alert('ไม่สามารถสมัครเรียนช้ำรายวิชา / กิจกรรม ได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
		}else{}	
	
	
	if($day=="Mon"){
		
					$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
									           FROM `supplementary_subject` 
											   WHERE `ss_t`='{$data_term}' 
											   and `ss_l`='{$data_stu->IDLevel}' 
											   and `ss_year`='{$data_yaer}' ";
					$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
					$count_subject=0;
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						
						$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							               FROM `supplementary_sturs` 
							               WHERE `sup_stuid`='{$user_login}' 
							               and `sup_t`='{$data_term}' 
							               and `sup_l`='{$data_stu->IDLevel}' 
							               and `sup_year`='{$data_yaer}' 
							               and `ss_id`='{$supplementary_subjectRow["ss_id"]}' 
							               and `ss_mon`='1';";
						$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
						foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
						$num_stuid=$doing_subjectRow["num_stuid"];
							if($num_stuid>=1){
								$count_subject=$count_subject+1;
							}else{
								
							}
			
						}
					}
		
		if($count_subject==0){
		
					$supplementary_subject="SELECT `ss_id`,`subject_MonCount`,`subject_MonKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$subjectid}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_MonCount=$supplementary_subjectRow["subject_MonCount"];
						$subject_MonKeep=$supplementary_subjectRow["subject_MonKeep"];
						if($subject_MonKeep>=$subject_MonCount){
							exit("<meta charset='utf-8'/><script>alert('จำนวนนักเรียนครบแล้วไม่สามารถสมัครเรียนได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");	
						}else{
							$sup_datetime=date("Y-m-d H:i:s");
							$add_supplementarySql="INSERT INTO `supplementary_sturs` (`sup_stuid`, `sup_t`, `sup_l`, `sup_year`, `ss_id`, `ss_mon`, `ss_tues`, `ss_wedne`, `ss_thurs`, `ss_fri`, `ss_satur`, `ss_sun`,`ss_activity`, `sup_datetime`) VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$subjectid}', '1', NULL, NULL, NULL, NULL, NULL, NULL, '{$ss_activity}','{$sup_datetime}');";
							$add_supplementaryInto=new insert_evaluation($add_supplementarySql);
							if($add_supplementaryInto->system_insert=="yes"){
								
								
								$print_subjectSql="SELECT `subject_MonKeep` FROM `supplementary_subject` WHERE `ss_id`='{$subjectid}'";
								$print_subjectRs=new notrow_evaluation ($print_subjectSql);
								foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectRow){
									$num_MonKeep=$print_subjectRow["subject_MonKeep"];
								}
								$num_MonKeep=$num_MonKeep+1;
								
								$num_stuSql="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$num_MonKeep}' WHERE `ss_id`='{$subjectid}';";
								$num_stuUP=new insert_evaluation($num_stuSql);
								
								
								exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันจันทร์สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
							}else{
								exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันจันทร์ไม่สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
							}
							
						}	
					}
		}else{
			exit("<meta charset='utf-8'/><script>alert('ไม่สามารถสมัครเรียนช้ำวันได้ ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
		}
	}elseif($day=="Tues"){
		
					$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
									           FROM `supplementary_subject` 
											   WHERE `ss_t`='{$data_term}' 
											   and `ss_l`='{$data_stu->IDLevel}' 
											   and `ss_year`='{$data_yaer}' ";
					$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
					$count_subject=0;
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						
						$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							               FROM `supplementary_sturs` 
							               WHERE `sup_stuid`='{$user_login}' 
							               and `sup_t`='{$data_term}' 
							               and `sup_l`='{$data_stu->IDLevel}' 
							               and `sup_year`='{$data_yaer}' 
							               and `ss_id`='{$supplementary_subjectRow["ss_id"]}' 
							               and `ss_tues`='1';";
						$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
						foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
						$num_stuid=$doing_subjectRow["num_stuid"];
							if($num_stuid>=1){
								$count_subject=$count_subject+1;
							}else{
								
							}
			
						}
					}
		
		if($count_subject==0){
		
					$supplementary_subject="SELECT `ss_id`,`subject_TuesCount`,`subject_TuesKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$subjectid}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_TuesCount=$supplementary_subjectRow["subject_TuesCount"];
						$subject_TuesKeep=$supplementary_subjectRow["subject_TuesKeep"];
						if($subject_TuesKeep>=$subject_TuesCount){
							exit("<meta charset='utf-8'/><script>alert('จำนวนนักเรียนครบแล้วไม่สามารถสมัครเรียนได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");	
						}else{
							$sup_datetime=date("Y-m-d H:i:s");
							$add_supplementarySql="INSERT INTO `supplementary_sturs` (`sup_stuid`, `sup_t`, `sup_l`, `sup_year`, `ss_id`, `ss_mon`, `ss_tues`, `ss_wedne`, `ss_thurs`, `ss_fri`, `ss_satur`, `ss_sun`,`ss_activity`, `sup_datetime`) VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$subjectid}', NULL, '1', NULL, NULL, NULL, NULL, NULL, '{$ss_activity}','{$sup_datetime}');";
							$add_supplementaryInto=new insert_evaluation($add_supplementarySql);
							if($add_supplementaryInto->system_insert=="yes"){
								
								$print_subjectSql="SELECT `subject_TuesKeep` FROM `supplementary_subject` WHERE `ss_id`='{$subjectid}'";
								$print_subjectRs=new notrow_evaluation ($print_subjectSql);
								foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectRow){
									$num_TuesKeep=$print_subjectRow["subject_TuesKeep"];
								}
								$num_TuesKeep=$num_TuesKeep+1;
								
								$num_stuSql="UPDATE `supplementary_subject` SET `subject_TuesKeep`='{$num_TuesKeep}' WHERE `ss_id`='{$subjectid}';";
								$num_stuUP=new insert_evaluation($num_stuSql);
								
								exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันอังคารสำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
							}else{
								exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันอังคารไม่สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
							}
							
						}	
					}
		}else{
			exit("<meta charset='utf-8'/><script>alert('ไม่สามารถสมัครเรียนช้ำวันได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
		}		
	}elseif($day=="Wednes"){
		
					$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
									           FROM `supplementary_subject` 
											   WHERE `ss_t`='{$data_term}' 
											   and `ss_l`='{$data_stu->IDLevel}' 
											   and `ss_year`='{$data_yaer}' ";
					$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
					$count_subject=0;
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						
						$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							               FROM `supplementary_sturs` 
							               WHERE `sup_stuid`='{$user_login}' 
							               and `sup_t`='{$data_term}' 
							               and `sup_l`='{$data_stu->IDLevel}' 
							               and `sup_year`='{$data_yaer}' 
							               and `ss_id`='{$supplementary_subjectRow["ss_id"]}' 
							               and `ss_wedne`='1';";
						$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
						foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
						$num_stuid=$doing_subjectRow["num_stuid"];
							if($num_stuid>=1){
								$count_subject=$count_subject+1;
							}else{
								
							}
			
						}
					}
		
		if($count_subject==0){
		
					$supplementary_subject="SELECT `ss_id`,`subject_WednesCount`,`subject_WednesKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$subjectid}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_WednesCount=$supplementary_subjectRow["subject_WednesCount"];
						$subject_WednesKeep=$supplementary_subjectRow["subject_WednesKeep"];
						if($subject_WednesKeep>=$subject_WednesCount){
							exit("<meta charset='utf-8'/><script>alert('จำนวนนักเรียนครบแล้วไม่สามารถสมัครเรียนได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");	
						}else{
							$sup_datetime=date("Y-m-d H:i:s");
							$add_supplementarySql="INSERT INTO `supplementary_sturs` (`sup_stuid`, `sup_t`, `sup_l`, `sup_year`, `ss_id`, `ss_mon`, `ss_tues`, `ss_wedne`, `ss_thurs`, `ss_fri`, `ss_satur`, `ss_sun`,`ss_activity`, `sup_datetime`) VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$subjectid}', NULL, NULL, '1', NULL, NULL, NULL, NULL, '{$ss_activity}', '{$sup_datetime}');";
							$add_supplementaryInto=new insert_evaluation($add_supplementarySql);
							if($add_supplementaryInto->system_insert=="yes"){
								
								$print_subjectSql="SELECT `subject_WednesKeep` FROM `supplementary_subject` WHERE `ss_id`='{$subjectid}'";
								$print_subjectRs=new notrow_evaluation ($print_subjectSql);
								foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectRow){
									$num_WednesKeep=$print_subjectRow["subject_WednesKeep"];
								}
								$num_WednesKeep=$num_WednesKeep+1;
								
								$num_stuSql="UPDATE `supplementary_subject` SET `subject_WednesKeep`='{$num_WednesKeep}' WHERE `ss_id`='{$subjectid}';";
								$num_stuUP=new insert_evaluation($num_stuSql);
								
								exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันพุธสำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
							}else{
								exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันพุธไม่สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
							}
							
						}	
					}
		}else{
			exit("<meta charset='utf-8'/><script>alert('ไม่สามารถสมัครเรียนช้ำวันได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
		}		
	}elseif($day=="Thurs"){
		
					$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
									           FROM `supplementary_subject` 
											   WHERE `ss_t`='{$data_term}' 
											   and `ss_l`='{$data_stu->IDLevel}' 
											   and `ss_year`='{$data_yaer}' ";
					$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
					$count_subject=0;
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						
						$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							               FROM `supplementary_sturs` 
							               WHERE `sup_stuid`='{$user_login}' 
							               and `sup_t`='{$data_term}' 
							               and `sup_l`='{$data_stu->IDLevel}' 
							               and `sup_year`='{$data_yaer}' 
							               and `ss_id`='{$supplementary_subjectRow["ss_id"]}' 
							               and `ss_thurs`='1';";
						$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
						foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
						$num_stuid=$doing_subjectRow["num_stuid"];
							if($num_stuid>=1){
								$count_subject=$count_subject+1;
							}else{
								
							}
			
						}
					}
		
		if($count_subject==0){
		
					$supplementary_subject="SELECT `ss_id`,`subject_ThursCount`,`subject_ThursKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$subjectid}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_ThursCount=$supplementary_subjectRow["subject_ThursCount"];
						$subject_ThursKeep=$supplementary_subjectRow["subject_ThursKeep"];
						if($subject_ThursKeep>=$subject_ThursCount){
							exit("<meta charset='utf-8'/><script>alert('จำนวนนักเรียนครบแล้วไม่สามารถสมัครเรียนได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");	
						}else{
							$sup_datetime=date("Y-m-d H:i:s");
							$add_supplementarySql="INSERT INTO `supplementary_sturs` (`sup_stuid`, `sup_t`, `sup_l`, `sup_year`, `ss_id`, `ss_mon`, `ss_tues`, `ss_wedne`, `ss_thurs`, `ss_fri`, `ss_satur`, `ss_sun`, `ss_activity`,`sup_datetime`) VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$subjectid}', NULL, NULL, NULL, '1', NULL, NULL, NULL, '{$ss_activity}','{$sup_datetime}');";
							$add_supplementaryInto=new insert_evaluation($add_supplementarySql);
							if($add_supplementaryInto->system_insert=="yes"){
								
								$print_subjectSql="SELECT `subject_ThursKeep` FROM `supplementary_subject` WHERE `ss_id`='{$subjectid}'";
								$print_subjectRs=new notrow_evaluation ($print_subjectSql);
								foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectRow){
									$num_ThursKeep=$print_subjectRow["subject_ThursKeep"];
								}
								$num_ThursKeep=$num_ThursKeep+1;
								
								$num_stuSql="UPDATE `supplementary_subject` SET `subject_ThursKeep`='{$num_ThursKeep}' WHERE `ss_id`='{$subjectid}';";
								$num_stuUP=new insert_evaluation($num_stuSql);
								
								exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันพฤหัสบดีสำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
							}else{
								exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันพฤหัสบดีไม่สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
							}
							
						}	
					}
		}else{
			exit("<meta charset='utf-8'/><script>alert('ไม่สามารถสมัครเรียนช้ำวันได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
		}			
	}elseif($day=="fri"){
		
					$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
									           FROM `supplementary_subject` 
											   WHERE `ss_t`='{$data_term}' 
											   and `ss_l`='{$data_stu->IDLevel}' 
											   and `ss_year`='{$data_yaer}' ";
					$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
					$count_subject=0;
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						
						$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							               FROM `supplementary_sturs` 
							               WHERE `sup_stuid`='{$user_login}' 
							               and `sup_t`='{$data_term}' 
							               and `sup_l`='{$data_stu->IDLevel}' 
							               and `sup_year`='{$data_yaer}' 
							               and `ss_id`='{$supplementary_subjectRow["ss_id"]}' 
							               and `ss_fri`='1';";
						$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
						foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
						$num_stuid=$doing_subjectRow["num_stuid"];
							if($num_stuid>=1){
								$count_subject=$count_subject+1;
							}else{
								
							}
			
						}
					}
		
		if($count_subject==0){
		
					$supplementary_subject="SELECT `ss_id`,`subject_FriCount`,`subject_FriKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$subjectid}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_FriCount=$supplementary_subjectRow["subject_FriCount"];
						$subject_FriKeep=$supplementary_subjectRow["subject_FriKeep"];
						if($subject_FriKeep>=$subject_FriCount){
							exit("<meta charset='utf-8'/><script>alert('จำนวนนักเรียนครบแล้วไม่สามารถสมัครเรียนได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");	
						}else{
							$sup_datetime=date("Y-m-d H:i:s");
							$add_supplementarySql="INSERT INTO `supplementary_sturs` (`sup_stuid`, `sup_t`, `sup_l`, `sup_year`, `ss_id`, `ss_mon`, `ss_tues`, `ss_wedne`, `ss_thurs`, `ss_fri`, `ss_satur`, `ss_sun`,`ss_activity`, `sup_datetime`) VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$subjectid}', NULL, NULL, NULL, NULL, '1', NULL, NULL, '{$ss_activity}','{$sup_datetime}');";
							$add_supplementaryInto=new insert_evaluation($add_supplementarySql);
							if($add_supplementaryInto->system_insert=="yes"){
								
								$print_subjectSql="SELECT `subject_FriKeep` FROM `supplementary_subject` WHERE `ss_id`='{$subjectid}'";
								$print_subjectRs=new notrow_evaluation ($print_subjectSql);
								foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectRow){
									$num_FriKeep=$print_subjectRow["subject_FriKeep"];
								}
								$num_FriKeep=$num_FriKeep+1;
								
								$num_stuSql="UPDATE `supplementary_subject` SET `subject_FriKeep`='{$num_FriKeep}' WHERE `ss_id`='{$subjectid}';";
								$num_stuUP=new insert_evaluation($num_stuSql);
								
								exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันศุกร์สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
							}else{
								
								exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันศุกร์ไม่สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
							}
							
						}	
					}
		}else{
			exit("<meta charset='utf-8'/><script>alert('ไม่สามารถสมัครเรียนช้ำวันได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
		}			
	}elseif($day=="Satur"){
		
					$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
									           FROM `supplementary_subject` 
											   WHERE `ss_t`='{$data_term}' 
											   and `ss_l`='{$data_stu->IDLevel}' 
											   and `ss_year`='{$data_yaer}' ";
					$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
					$count_subject=0;
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						
						$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							               FROM `supplementary_sturs` 
							               WHERE `sup_stuid`='{$user_login}' 
							               and `sup_t`='{$data_term}' 
							               and `sup_l`='{$data_stu->IDLevel}' 
							               and `sup_year`='{$data_yaer}' 
							               and `ss_id`='{$supplementary_subjectRow["ss_id"]}' 
							               and `ss_satur`='1';";
						$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
						foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
						$num_stuid=$doing_subjectRow["num_stuid"];
							if($num_stuid>=1){
								$count_subject=$count_subject+1;
							}else{
								
							}
			
						}
					}
		
		if($count_subject==0){
		
					$supplementary_subject="SELECT `ss_id`,`subject_SaturCount`,`subject_SaturKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$subjectid}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_SaturCount=$supplementary_subjectRow["subject_SaturCount"];
						$subject_SaturKeep=$supplementary_subjectRow["subject_SaturKeep"];
						if($subject_SaturKeep>=$subject_SaturCount){
							exit("<meta charset='utf-8'/><script>alert('จำนวนนักเรียนครบแล้วไม่สามารถสมัครเรียนได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");	
						}else{
							$sup_datetime=date("Y-m-d H:i:s");
							$add_supplementarySql="INSERT INTO `supplementary_sturs` (`sup_stuid`, `sup_t`, `sup_l`, `sup_year`, `ss_id`, `ss_mon`, `ss_tues`, `ss_wedne`, `ss_thurs`, `ss_fri`, `ss_satur`, `ss_sun`,`ss_activity`, `sup_datetime`) VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$subjectid}', NULL, NULL, NULL, NULL, NULL, '1', NULL,'{$ss_activity}', '{$sup_datetime}');";
							$add_supplementaryInto=new insert_evaluation($add_supplementarySql);
							if($add_supplementaryInto->system_insert=="yes"){
								
								$print_subjectSql="SELECT `subject_SaturKeep` FROM `supplementary_subject` WHERE `ss_id`='{$subjectid}'";
								$print_subjectRs=new notrow_evaluation ($print_subjectSql);
								foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectRow){
									$num_SaturKeep=$print_subjectRow["subject_SaturKeep"];
								}
								$num_SaturKeep=$num_SaturKeep+1;
								
								$num_stuSql="UPDATE `supplementary_subject` SET `subject_SaturKeep`='{$num_SaturKeep}' WHERE `ss_id`='{$subjectid}';";
								$num_stuUP=new insert_evaluation($num_stuSql);					
								
								exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันเสาร์สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
							}else{
								exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันเสาร์ไม่สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
							}
							
						}	
					}
		}else{
			exit("<meta charset='utf-8'/><script>alert('ไม่สามารถสมัครเรียนช้ำวันได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
		}			
	}elseif($day=="Sun"){
		
					$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
									           FROM `supplementary_subject` 
											   WHERE `ss_t`='{$data_term}' 
											   and `ss_l`='{$data_stu->IDLevel}' 
											   and `ss_year`='{$data_yaer}' ";
					$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
					$count_subject=0;
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						
						$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							               FROM `supplementary_sturs` 
							               WHERE `sup_stuid`='{$user_login}' 
							               and `sup_t`='{$data_term}' 
							               and `sup_l`='{$data_stu->IDLevel}' 
							               and `sup_year`='{$data_yaer}' 
							               and `ss_id`='{$supplementary_subjectRow["ss_id"]}' 
							               and `ss_sun`='1';";
						$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
						foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
						$num_stuid=$doing_subjectRow["num_stuid"];
							if($num_stuid>=1){
								$count_subject=$count_subject+1;
							}else{
								
							}
			
						}
					}
		
		if($count_subject==0){
		
					$supplementary_subject="SELECT `ss_id`,`subject_SunCount`,`subject_SunKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$subjectid}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_SunCount=$supplementary_subjectRow["subject_SunCount"];
						$subject_SunKeep=$supplementary_subjectRow["subject_SunKeep"];
						if($subject_SunKeep>=$subject_SunCount){
							exit("<meta charset='utf-8'/><script>alert('จำนวนนักเรียนครบแล้วไม่สามารถสมัครเรียนได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");	
						}else{
							$sup_datetime=date("Y-m-d H:i:s");
							$add_supplementarySql="INSERT INTO `supplementary_sturs` (`sup_stuid`, `sup_t`, `sup_l`, `sup_year`, `ss_id`, `ss_mon`, `ss_tues`, `ss_wedne`, `ss_thurs`, `ss_fri`, `ss_satur`, `ss_sun`, `ss_activity`,`sup_datetime`) VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$subjectid}', NULL, NULL, NULL, NULL, NULL, NULL, '1', '{$ss_activity}','{$sup_datetime}');";
							$add_supplementaryInto=new insert_evaluation($add_supplementarySql);
							if($add_supplementaryInto->system_insert=="yes"){
								
								$print_subjectSql="SELECT `subject_SunKeep` FROM `supplementary_subject` WHERE `ss_id`='{$subjectid}'";
								$print_subjectRs=new notrow_evaluation ($print_subjectSql);
								foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectRow){
									$num_SunKeep=$print_subjectRow["subject_SunKeep"];
								}
								$num_SunKeep=$num_SunKeep+1;
								
								$num_stuSql="UPDATE `supplementary_subject` SET `subject_SunKeep`='{$num_SunKeep}' WHERE `ss_id`='{$subjectid}';";
								$num_stuUP=new insert_evaluation($num_stuSql);
								
								
								exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันอาทิตย์สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
							}else{
								exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันอาทิตย์ไม่สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
							}
							
						}	
					}
		}else{
			exit("<meta charset='utf-8'/><script>alert('ไม่สามารถสมัครเรียนช้ำวันได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
		}		
	}elseif($day=="All"){
	
		
					$call_dateactivity=new date_activity($data_stu->IDLevel,$copy_plan);
		
						if($call_dateactivity->day_activity_mon=="ON"){ 
								
										$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
																   FROM `supplementary_subject` 
																   WHERE `ss_t`='{$data_term}' 
																   and `ss_l`='{$data_stu->IDLevel}' 
																   and `ss_year`='{$data_yaer}'
																   and `ss_academic`='0'";
										$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
										$count_subject=0;
										foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
											
											$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
															   FROM `supplementary_sturs` 
															   WHERE `sup_stuid`='{$user_login}' 
															   and `sup_t`='{$data_term}' 
															   and `sup_l`='{$data_stu->IDLevel}' 
															   and `sup_year`='{$data_yaer}' 
															   and `ss_id`='{$copy_ss_id}' 
															   and `ss_mon`='1';";
											$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
											foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
											$num_stuid=$doing_subjectRow["num_stuid"];
												if($num_stuid>=1){
													$count_subject=$count_subject+1;
												}else{
													
												}
								
											}
										}
							
							if($count_subject==0){
							
										$supplementary_subject="SELECT `ss_id`,`subject_MonCount`,`subject_MonKeep` 
																FROM `supplementary_subject` 
																WHERE `ss_id`='{$copy_ss_id}' 
																and `ss_t`='{$data_term}' 
																and `ss_l`='{$data_stu->IDLevel}' 
																and `ss_year`='{$data_yaer}' ";
										$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
										foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
											$subject_MonCount=$supplementary_subjectRow["subject_MonCount"];
											$subject_MonKeep=$supplementary_subjectRow["subject_MonKeep"];
											if($subject_MonKeep>=$subject_MonCount){
												exit("<meta charset='utf-8'/><script>alert('จำนวนนักเรียนครบแล้วไม่สามารถสมัครเรียนได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");	
											}else{
												
												
												
												$call_suppSql="SELECT count(`sup_stuid`) as `int_ac` 
															   FROM `supplementary_sturs` 
															   WHERE `sup_stuid`='{$user_login}' 
															   and `sup_t`='{$data_term}' 
													           and `sup_l`='{$data_stu->IDLevel}' 
															   and `sup_year`='{$data_yaer}' 
															   and `ss_id`='{$copy_ss_id}' 
															   and `ss_activity`='cilk_true' ;";
												$call_suppRs= new notrow_evaluation($call_suppSql);
												
												foreach($call_suppRs->evaluation_array as $rc_key=>$call_suppRow){
													
													$int_ac=$call_suppRow["int_ac"];
													
													if($int_ac>=1){
														$sup_datetime=date("Y-m-d H:i:s");
														$add_supplementarySql="UPDATE `supplementary_sturs` SET `ss_mon`='1' WHERE `sup_stuid`='{$user_login}' and `sup_t`='{$data_term}' and `sup_l`='{$data_stu->IDLevel}' and `sup_year`='{$data_yaer}' and `ss_id`='{$copy_ss_id}'";
;
														$add_supplementaryInto=new insert_evaluation($add_supplementarySql);
														if($add_supplementaryInto->system_insert=="yes"){
															
															$print_subjectSql="SELECT `subject_MonKeep` FROM `supplementary_subject` WHERE `ss_id`='{$copy_ss_id}'";
															$print_subjectRs=new notrow_evaluation ($print_subjectSql);
															foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectRow){
																$num_MonKeep=$print_subjectRow["subject_MonKeep"];
															}
															$num_MonKeep=$num_MonKeep+1;
															
															$num_stuSql="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$num_MonKeep}' WHERE `ss_id`='{$copy_ss_id}';";
															$num_stuUP=new insert_evaluation($num_stuSql);
															
															//exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันอาทิตย์สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
														}else{
															//exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันอาทิตย์ไม่สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
														}														
													}else{
														$sup_datetime=date("Y-m-d H:i:s");
														$add_supplementarySql="INSERT INTO `supplementary_sturs` (`sup_stuid`, `sup_t`, `sup_l`, `sup_year`, `ss_id`, `ss_mon`, `ss_activity`, `sup_datetime`) VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$copy_ss_id}', '1', '{$ss_activity}', '{$sup_datetime}');";
														
														$add_supplementaryInto=new insert_evaluation($add_supplementarySql);
														if($add_supplementaryInto->system_insert=="yes"){
															
															$print_subjectSql="SELECT `subject_MonKeep` FROM `supplementary_subject` WHERE `ss_id`='{$copy_ss_id}'";
															$print_subjectRs=new notrow_evaluation ($print_subjectSql);
															foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectRow){
																$num_MonKeep=$print_subjectRow["subject_MonKeep"];
															}
															$num_MonKeep=$num_MonKeep+1;
															
															$num_stuSql="UPDATE `supplementary_subject` SET `subject_MonKeep`='{$num_MonKeep}' WHERE `ss_id`='{$copy_ss_id}';";
															$num_stuUP=new insert_evaluation($num_stuSql);
															
															//exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันอาทิตย์สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
														}else{
															//exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันอาทิตย์ไม่สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
														}														
													}
													
												}
												
												
												
												
												

												
											}	
										}
							}else{
								exit("<meta charset='utf-8'/><script>alert('ไม่สามารถสมัครเรียนช้ำวันได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
							}								

							
						}elseif($call_dateactivity->day_activity_mon=="OFF"){
							
						}else{
							
						}
	
						if($call_dateactivity->day_activity_tue=="ON"){
							
										$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
																   FROM `supplementary_subject` 
																   WHERE `ss_t`='{$data_term}' 
																   and `ss_l`='{$data_stu->IDLevel}' 
																   and `ss_year`='{$data_yaer}'
																   and `ss_academic`='0'";
										$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
										$count_subject=0;
										foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
											
											$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
															   FROM `supplementary_sturs` 
															   WHERE `sup_stuid`='{$user_login}' 
															   and `sup_t`='{$data_term}' 
															   and `sup_l`='{$data_stu->IDLevel}' 
															   and `sup_year`='{$data_yaer}' 
															   and `ss_id`='{$copy_ss_id}' 
															   and `ss_tues`='1';";
											$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
											foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
											$num_stuid=$doing_subjectRow["num_stuid"];
												if($num_stuid>=1){
													$count_subject=$count_subject+1;
												}else{
													
												}
								
											}
										}
							
							if($count_subject==0){
							
										$supplementary_subject="SELECT `ss_id`,`subject_TuesCount`,`subject_TuesKeep` 
																FROM `supplementary_subject` 
																WHERE `ss_id`='{$copy_ss_id}' 
																and `ss_t`='{$data_term}' 
																and `ss_l`='{$data_stu->IDLevel}' 
																and `ss_year`='{$data_yaer}' ";
										$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
										foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
											$subject_TuesCount=$supplementary_subjectRow["subject_TuesCount"];
											$subject_TuesKeep=$supplementary_subjectRow["subject_TuesKeep"];
											if($subject_TuesKeep>=$subject_TuesCount){
												exit("<meta charset='utf-8'/><script>alert('จำนวนนักเรียนครบแล้วไม่สามารถสมัครเรียนได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");	
											}else{
												
												
												
												$call_suppSql="SELECT count(`sup_stuid`) as `int_ac` 
															   FROM `supplementary_sturs` 
															   WHERE `sup_stuid`='{$user_login}' 
															   and `sup_t`='{$data_term}' 
													           and `sup_l`='{$data_stu->IDLevel}' 
															   and `sup_year`='{$data_yaer}' 
															   and `ss_id`='{$copy_ss_id}' 
															   and `ss_activity`='cilk_true' ;";
												$call_suppRs= new notrow_evaluation($call_suppSql);
												
												foreach($call_suppRs->evaluation_array as $rc_key=>$call_suppRow){
													
													$int_ac=$call_suppRow["int_ac"];
													
													if($int_ac>=1){
														$sup_datetime=date("Y-m-d H:i:s");
														$add_supplementarySql="UPDATE `supplementary_sturs` SET `ss_tues`='1' WHERE `sup_stuid`='{$user_login}' and `sup_t`='{$data_term}' and `sup_l`='{$data_stu->IDLevel}' and `sup_year`='{$data_yaer}' and `ss_id`='{$copy_ss_id}'";
;
														$add_supplementaryInto=new insert_evaluation($add_supplementarySql);
														if($add_supplementaryInto->system_insert=="yes"){
															
															$print_subjectSql="SELECT `subject_TuesKeep` FROM `supplementary_subject` WHERE `ss_id`='{$copy_ss_id}'";
															$print_subjectRs=new notrow_evaluation ($print_subjectSql);
															foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectRow){
																$num_MonKeep=$print_subjectRow["subject_TuesKeep"];
															}
															$num_MonKeep=$num_MonKeep+1;
															
															$num_stuSql="UPDATE `supplementary_subject` SET `subject_TuesKeep`='{$num_MonKeep}' WHERE `ss_id`='{$copy_ss_id}';";
															$num_stuUP=new insert_evaluation($num_stuSql);
															
															//exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันอาทิตย์สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
														}else{
															//exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันอาทิตย์ไม่สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
														}														
													}else{
														$sup_datetime=date("Y-m-d H:i:s");
														$add_supplementarySql="INSERT INTO `supplementary_sturs` (`sup_stuid`, `sup_t`, `sup_l`, `sup_year`, `ss_id`, `ss_tues`, `ss_activity`, `sup_datetime`) VALUES ('{$user_login}', '{$data_term}', '{$data_stu->IDLevel}', '{$data_yaer}', '{$copy_ss_id}', '1', '{$ss_activity}', '{$sup_datetime}');";
														
														$add_supplementaryInto=new insert_evaluation($add_supplementarySql);
														if($add_supplementaryInto->system_insert=="yes"){
															
															$print_subjectSql="SELECT `subject_TuesKeep` FROM `supplementary_subject` WHERE `ss_id`='{$copy_ss_id}'";
															$print_subjectRs=new notrow_evaluation ($print_subjectSql);
															foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectRow){
																$num_MonKeep=$print_subjectRow["subject_TuesKeep"];
															}
															$num_MonKeep=$num_MonKeep+1;
															
															$num_stuSql="UPDATE `supplementary_subject` SET `subject_TuesKeep`='{$num_MonKeep}' WHERE `ss_id`='{$copy_ss_id}';";
															$num_stuUP=new insert_evaluation($num_stuSql);
															
															//exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันอาทิตย์สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
														}else{
															//exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเรียนลงวันอาทิตย์ไม่สำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");								
														}														
													}
													
												}
												
												
												
												
												

												
											}	
										}
										exit("<meta charset='utf-8'/><script>alert('ลงทะเบียนเกิจกรรมตามความถนัดและสนใจสำเร็จ');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
							}else{
								exit("<meta charset='utf-8'/><script>alert('ไม่สามารถสมัครเรียนช้ำวันได้');location.href='../../../../../?evaluation_mod=stu_supplementary';</script>");
							}							
							
						}elseif($call_dateactivity->day_activity_tue=="OFF"){
							
						}else{
							
						}						
						
						if($call_dateactivity->day_activity_wed=="ON"){
							
						}elseif($call_dateactivity->day_activity_wed=="OFF"){
							
						}else{
							
						}
	
						if($call_dateactivity->day_activity_thu=="ON"){
							
						}elseif($call_dateactivity->day_activity_thu=="OFF"){
							
						}else{
							
						}						
						
						if($call_dateactivity->day_activity_frl=="ON"){
							
						}elseif($call_dateactivity->day_activity_frl=="OFF"){
							
						}else{
							
						}
	
						if($call_dateactivity->day_activity_sat=="ON"){
							
						}elseif($call_dateactivity->day_activity_sat=="OFF"){
							
						}else{
							
						}
		
						if($call_dateactivity->day_activity_sun=="ON"){
							
						}elseif($call_dateactivity->day_activity_sun=="OFF"){
							
						}else{
							
						}		
				
		
	}else{
	//***********	
	}
}else{
//***********	
} ?>