<?php
//--Activity Count All-->

class activity_count_all{
	public $aca_activity_key,$aca_activity_t,$aca_activity_y,$aca_type;
	public $activity_error,$activity_row,$activity_ae_id,$activity_ae_txt,$activity_ae_quota,$activity_aej_id;
	function __construct($aca_activity_key,$aca_activity_t,$aca_activity_y,$aca_type){
		$db_activityID=$_SERVER['REMOTE_ADDR'];
		$connpdo_activity=new conntopdo_activity($db_activityID);
		$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();		
		$this->aca_activity_key=$aca_activity_key;
		$this->aca_activity_t=$aca_activity_t;
		$this->aca_activity_y=$aca_activity_y;
		$this->aca_type=$aca_type;
		$activity_row=array();
		$activity_error="error";
		switch($this->aca_type){
			case "Count_Activity_join":
				try{
					$activity_aca_sql="select `activity_event`.`ae_id`,`activity_event_join`.`aej_id`,`activity_event`.`ae_txt`,`activity_event`.`ae_quota` 
									   from `activity_event` inner join `activity_event_join` 
									   on (`activity_event`.`ae_id`=`activity_event_join`.`ae_id`) 
									   where `activity_event_join`.`aej_id`='{$this->aca_activity_key}' 
									   and `activity_event_join`.`aej_t`='{$this->aca_activity_t}' 
									   and `activity_event_join`.`aej_year`='{$this->aca_activity_y}';";
					if(($activity_aca_rs=$pdo_activity->query($activity_aca_sql))){
						$activity_aca_row=$activity_aca_rs->Fetch(PDO::FETCH_ASSOC);
							if((is_array($activity_aca_row) && count($activity_aca_row))){
								$activity_error="no_error";
								$activity_ae_id=$activity_aca_row["ae_id"];
								$activity_ae_txt=$activity_aca_row["ae_txt"];
								$activity_ae_quota=$activity_aca_row["ae_quota"];
								$activity_aej_id=$activity_aca_row["aej_id"];
							}else{
								$activity_error="error";
								$activity_ae_id="-";
								$activity_ae_txt="-";
								$activity_ae_quota="-";
								$activity_aej_id="-";
							}
					}else{
						$activity_error="error";
						$activity_ae_id="-";
						$activity_ae_txt="-";
						$activity_ae_quota="-";
						$activity_aej_id="-";
					}
				}catch(PDOException $e){
					$activity_error="error";
					$activity_ae_id="-";
					$activity_ae_txt="-";
					$activity_ae_quota="-";
					$activity_aej_id="-";
				}
			break;
			case "Row_Activity";
			try{
				$activity_aca_sql="select `activity_event`.`ae_id`,`activity_event_join`.`aej_id`,`activity_event`.`ae_txt`,`activity_event`.`ae_t`,`activity_event`.`ae_year`,`activity_event`.`ae_quota` 
				from `activity_event` inner join `activity_event_join` on (`activity_event`.`ae_id`=`activity_event_join`.`ae_id`) 
				where `activity_event_join`.`ae_id`='{$this->aca_activity_key}' 
				and `activity_event_join`.`aej_t`='{$this->aca_activity_t}' 
				and `activity_event_join`.`aej_year`='{$this->aca_activity_y}';";
				if(($activity_aca_rs=$pdo_activity->query($activity_aca_sql))){
					while($activity_aca_row=$activity_aca_rs->Fetch(PDO::FETCH_ASSOC)){
						if((is_array($activity_aca_row) && count($activity_aca_row))){
							$activity_row[]=$activity_aca_row;
							$activity_error="no_error";
						}else{
							$activity_row="-";
							$activity_error="error";
						}						
					}
				}else{
					$activity_row="-";
					$activity_error="error";
				}
			}catch(PDOException $e){
				$activity_row="-";
				$activity_error="error";
			}
			break;
			default:
				$activity_error="error";			
				$activity_row="-";
				$activity_ae_id="-";
				$activity_ae_txt="-";
				$activity_ae_quota="-";
				$activity_aej_id="-";
		}
		@$this->activity_error=$activity_error;
		@$this->activity_row=$activity_row;
		@$this->activity_ae_id=$activity_ae_id;
		@$this->activity_ae_txt=$activity_ae_txt;
		@$this->activity_ae_quota=$activity_ae_quota;
		@$this->activity_aej_id=$activity_aej_id;
		$pdo_activity=null;
	}function print_txt_error(){
		return $this->activity_error;
	}function print_activity_row(){
		return $this->activity_row;
	}function print_activity_ae_id(){
		return $this->activity_ae_id;
	}function print_activity_aej_id(){
		return $this->activity_aej_id;
	}function print_activity_ae_txt(){
		return $this->activity_ae_txt;
	}function print_activity_ae_quota(){
		return $this->activity_ae_quota;
	} 
}
//--Activity Count All-->
?>









<?php
	//Copy Data All Activity TtoT*********
	//*******************************
	class CopyDbActivityAllT{
		public $CDAT_Tcopy,$CDAT_Ycopy;
		function __construct($CDAT_Tcopy,$CDAT_Ycopy){
			$this->CDAT_Tcopy=$CDAT_Tcopy;
			$this->CDAT_Ycopy=$CDAT_Ycopy;
//---------------------------------------------------------------------------------	
			$Count_AcAll=0;
			$Count_AcCopy=0;
			$Count_NotAcCopy=0;
//---------------------------------------------------------------------------------
			$Count_ACkAll=0;
			$Count_ACkCopy=0;
			$Count_NotACkCopy=0;
//---------------------------------------------------------------------------------	
			$Count_AsAll=0;
			$Count_AsCopy=0;
			$Count_NotAsCopy=0;
//---------------------------------------------------------------------------------	
			$Count_AtAll=0;
			$Count_AtCopy=0;
			$Count_NotAtCopy=0;
//---------------------------------------------------------------------------------			
			$Tnew=$this->CDAT_Tcopy+1;
			$Ynew=$this->CDAT_Ycopy;
//---------------------------------------------------------------------------------			
			$PrintActivityArray=array();
			$db_activityID=$_SERVER['REMOTE_ADDR'];
			$connpdo_activity=new conntopdo_activity($db_activityID);
			$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
//---------------------------------------------------------------------------------		
//activity
	//delete
			try{
				$delete_activitySql="DELETE FROM `activity` 
									 WHERE `activity_t`='{$Tnew}' 
									 AND `activity_y`='{$Ynew}'";
				$pdo_activity->exec($delete_activitySql);
				$delete_ac="Y";
			}catch(PDOException $e){
				$delete_ac="N";
			}
	//delete end
	//copy 
			try{
				$copy_activitySql="SELECT * FROM `activity` 
				                   WHERE `activity_t`='{$this->CDAT_Tcopy}' 
								   and `activity_y`='{$this->CDAT_Ycopy}'";
					if($copy_activityRs=$pdo_activity->query($copy_activitySql)){
						while($copy_activityRow=$copy_activityRs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($copy_activityRow) && count($copy_activityRow)){
								$Count_AcAll=$Count_AcAll+1;
								try{
									$Into_activitySql="INSERT INTO `activity`(`activity_key`, `activity_txt`, `activity_level`, `activity_plan`, `activity_showstudent`, `activity_save`, `activity_t`, `activity_y`, `activity_category_ac_num`, `activity_teacher_at_key`) 
													   VALUES ('{$copy_activityRow['activity_key']}','{$copy_activityRow['activity_txt']}','{$copy_activityRow['activity_level']}','{$copy_activityRow['activity_plan']}','{$copy_activityRow['activity_showstudent']}','{$copy_activityRow['activity_save']}','{$Tnew}','{$Ynew}','{$copy_activityRow['activity_category_ac_num']}','{$copy_activityRow['activity_teacher_at_key']}')";
									$pdo_activity->exec($Into_activitySql);
									$Into_ac="Y";
									$Count_AcCopy=$Count_AcCopy+1;
								}catch(PDOException $e){
									$Into_ac="N";
									$Count_NotAcCopy=$Count_NotAcCopy+1;
								}
							}else{
								$Into_ac="N";
								$Count_AcAll=0;
								$Count_AcCopy=0;
								$Count_NotAcCopy=0;
							}
						}
					}else{
						$Into_ac="N";
						$Count_AcAll=0;
						$Count_AcCopy=0;
						$Count_NotAcCopy=0;						
					}
			}catch(PDOException $e){
				$Into_ac="N";
				$Count_AcAll=0;
				$Count_AcCopy=0;
				$Count_NotAcCopy=0;				
			}
	//copy end
//activity end
//activity_keep
	//delete
			try{
				$DeleteActivityKeepSql="DELETE FROM `activity_keep` 
										WHERE `activity_activity_t`='{$Tnew}' 
										AND `activity_activity_y`='{$Ynew}'";
				$pdo_activity->exec($DeleteActivityKeepSql);
				$delete_ACk="Y";
			}catch(PDOException $e){
				$delete_ACk="N";
			}
	//delete end
	//copy
			try{
				$copy_ActivityKeepSql="SELECT * FROM `activity_keep` 
									   WHERE `activity_activity_t`='{$this->CDAT_Tcopy}' 
									   AND `activity_activity_y`='{$this->CDAT_Ycopy}';";
					if($copy_ActivityKeepRs=$pdo_activity->query($copy_ActivityKeepSql)){
						while($copy_ActivityKeepRow=$copy_ActivityKeepRs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($copy_ActivityKeepRow) && count ($copy_ActivityKeepRow)){
								$Count_ACkAll=$Count_ACkAll+1;
								try{
									$IntoActivityKeepSql="INSERT INTO `activity_keep`(`ak_keep`, `ak_count`, `activity_activity_key`, `activity_activity_t`, `activity_activity_y`) 
														  VALUES ('{$copy_ActivityKeepRow['ak_keep']}','{$copy_ActivityKeepRow['ak_count']}','{$copy_ActivityKeepRow['activity_activity_key']}','{$Tnew}','{$Ynew}')";
									$pdo_activity->exec($IntoActivityKeepSql);
									$Into_ACk="Y";
									$Count_ACkCopy=$Count_ACkCopy+1;
								}catch(PDOException $e){
									$Into_ACk="N";
									$Count_NotACkCopy=$Count_NotACkCopy+1;
								}
							}else{
								$Into_ACk="N";
								$Count_ACkAll=0;
								$Count_ACkCopy=0;
								$Count_NotACkCopy=0;
							}
						}
					}else{
						$Into_ACk="N";
						$Count_ACkAll=0;
						$Count_ACkCopy=0;
						$Count_NotACkCopy=0;					
					}
			}catch(PDOException $e){
				$Into_ACk="N";
				$Count_ACkAll=0;
				$Count_ACkCopy=0;
				$Count_NotACkCopy=0;			
			}
	//copy end
//activity_keep end
//activity_student
	//delete
			try{
				$Delete_ActivityStudentSql="DELETE FROM `activity_student` 
											WHERE `ac_t`='{$Tnew}' 
											AND `ac_y`='{$Ynew}'";
				$pdo_activity->exec($Delete_ActivityStudentSql);
				$delete_As="Y";
			}catch(PDOException $e){
				$delete_As="N";
			}
	//delete end
	//copy
			try{
				$Copy_ActivityStudentSql="SELECT * FROM `activity_student` 
										  WHERE `ac_t`='{$this->CDAT_Tcopy}' AND `ac_y`='{$this->CDAT_Ycopy}'";
					if($Copy_ActivityStudentRs=$pdo_activity->query($Copy_ActivityStudentSql)){
						while($Copy_ActivityStudentRow=$Copy_ActivityStudentRs->Fetch(PDO::FETCH_ASSOC)){
							$Count_AsAll=$Count_AsAll+1;
							if(is_array($Copy_ActivityStudentRow) && count($Copy_ActivityStudentRow)){
								try{
									$Into_ActivityStudentSql="INSERT INTO `activity_student`(`ac_key`, `ac_t`, `ac_y`, `activity_activity_key`) 
															  VALUES ('{$Copy_ActivityStudentRow['ac_key']}','{$Tnew}','{$Ynew}','{$Copy_ActivityStudentRow['activity_activity_key']}')";
									$pdo_activity->exec($Into_ActivityStudentSql);
									$Into_As="Y";
									$Count_AsCopy=$Count_AsCopy+1;
								}catch(PDOException $e){
									$Into_As="N";
									$Count_NotAsCopy=$Count_NotAsCopy+1;
								}
							}else{
								$Into_As="N";
								$Count_AsAll=0;
								$Count_AsCopy=0;
								$Count_NotAsCopy=0;
							}
						}
					}else{
						$Into_As="N";
						$Count_AsAll=0;
						$Count_AsCopy=0;
						$Count_NotAsCopy=0;					
					}
			}catch(PDOException $e){
				$Into_As="N";
				$Count_AsAll=0;
				$Count_AsCopy=0;
				$Count_NotAsCopy=0;			
			}
	//copy end
//activity_student end
//activity_teacher
	//delete
			try{
				$Delete_ActivityTeacherSql="DELETE FROM `activity_teacher` 
											WHERE `activity_activity_t`='{$Tnew}' 
											AND `activity_activity_y`='{$Ynew}'";
				$pdo_activity->exec($Delete_ActivityTeacherSql);
				$delete_At="Y";
			}catch(PDOException $e){
				$delete_At="N";
			}
	//delete end
	//copy
			try{
				$Copy_ActivityTeacherSql="SELECT * FROM `activity_teacher` 
										  WHERE `activity_activity_t`='{$this->CDAT_Tcopy}' 
										  AND `activity_activity_y`='{$this->CDAT_Ycopy}'";
					if($Copy_ActivityTeacherRs=$pdo_activity->query($Copy_ActivityTeacherSql)){
						while($Copy_ActivityTeacherRow=$Copy_ActivityTeacherRs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($Copy_ActivityTeacherRow) && count($Copy_ActivityTeacherRow)){
								$Count_AtAll=$Count_AtAll+1;
								try{
									$Into_ActivityTeacherSql="INSERT INTO `activity_teacher`(`at_key`, `activity_activity_key`, `activity_activity_t`, `activity_activity_y`)
															  VALUES ('{$Copy_ActivityTeacherRow['at_key']}','{$Copy_ActivityTeacherRow['activity_activity_key']}','{$Tnew}','{$Ynew}')";
									$pdo_activity->exec($Into_ActivityTeacherSql);
									$Into_At="Y";
									$Count_AtCopy=$Count_AtCopy+1;
								}catch(PDOException $e){
									$Into_At="N";
									$Count_NotAtCopy=$Count_NotAtCopy+1;
								}
							}else{
								$Into_At="N";
								$Count_AtAll=0;
								$Count_AtCopy=0;
								$Count_NotAtCopy=0;
							}
						}
					}else{
						$Into_At="N";
						$Count_AtAll=0;
						$Count_AtCopy=0;
						$Count_NotAtCopy=0;					
					}
			}catch(PDOException $e){
				$Into_At="N";
				$Count_AtAll=0;
				$Count_AtCopy=0;
				$Count_NotAtCopy=0;				
			}
	//copy end
//activity_teacher End
//--------------------------------------------------------------------------------	
	//activity
			$this->Into_ac=$Into_ac;
			$this->Count_AcAll=$Count_AcAll;
			$this->Count_AcCopy=$Count_AcCopy;
			$this->Count_NotAcCopy=$Count_NotAcCopy;
//--------------------------------------------------------------------------------
	//activity_keep
			$this->Into_ACk=$Into_ACk;
			$this->Count_ACkAll=$Count_ACkAll;
			$this->Count_ACkCopy=$Count_ACkCopy;
			$this->Count_NotACkCopy=$Count_NotACkCopy;	
//--------------------------------------------------------------------------------	
	//activity_student
			$this->Into_As=$Into_As;
			$this->Count_AsAll=$Count_AsAll;
			$this->Count_AsCopy=$Count_AsCopy;
			$this->Count_NotAsCopy=$Count_NotAsCopy;	
//--------------------------------------------------------------------------------
	//activity_teacher
			$this->Into_At=$Into_At;
			$this->Count_AtAll=$Count_AtAll;
			$this->Count_AtCopy=$Count_AtCopy;
			$this->Count_NotAtCopy=$Count_NotAtCopy;	
//--------------------------------------------------------------------------------			
			$pdo_activity=null;
		}function __destruct(){
	//activity
			$this->Into_ac;
			$this->Count_AcAll;
			$this->Count_AcCopy;
			$this->Count_NotAcCopy;
	//activity_keep
			$this->Into_ACk;
			$this->Count_ACkAll;
			$this->Count_ACkCopy;
			$this->Count_NotACkCopy;
	//activity_student
			$this->Into_As;
			$this->Count_AsAll;
			$this->Count_AsCopy;
			$this->Count_NotAsCopy;
	//activity_teacher
			$this->Into_At;
			$this->Count_AtAll;
			$this->Count_AtCopy;
			$this->Count_NotAtCopy;			
		}
	}
?>



<?php 
	class ShowActivityName{
		public $PA_Class,$PA_T,$PA_Y;
		public $PrintActivityArray;
		function __construct($PA_Class,$PA_T,$PA_Y){
			$this->PA_Class=$PA_Class;
			$this->PA_T=$PA_T;
			$this->PA_Y=$PA_Y;
//---------------------------------------------------------------------------------			
			$PrintActivityArray=array();
			$db_activityID=$_SERVER['REMOTE_ADDR'];
			$connpdo_activity=new conntopdo_activity($db_activityID);
			$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
//---------------------------------------------------------------------------------	
			$PAClassA=substr($this->PA_Class,0,2);
			$PAClassB=substr($this->PA_Class,2,2);
//---------------------------------------------------------------------------------			
			try{
				$PrintActivitySql="SELECT DISTINCT `activity_txt` 
								   FROM `activity` 
								   WHERE `activity_level` >='{$PAClassA}' 
								   AND `activity_level` <='{$PAClassB}'
								   AND `activity_t` ='{$this->PA_T}' 
								   AND `activity_y` ='{$this->PA_Y}';";
					if($PrintActivityRc=$pdo_activity->query($PrintActivitySql)){
						while($PrintActivityRow=$PrintActivityRc->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($PrintActivityRow) && count($PrintActivityRow)){
								$PrintActivityArray[]=$PrintActivityRow;
							}else{
								$PrintActivityArray=null;
							}
						}    
					}else{
						$PrintActivityArray=null;
					}								
			}catch(PDOException $PA){
				$PrintActivityArray=null;
			}   
			if(isset($PrintActivityArray)){
				$this->PrintActivityArray=$PrintActivityArray;
				unset($pdo_activity);
			}else{
				unset($pdo_activity);
			}
		}function RunShowActivityName(){
			if(isset($this->PrintActivityArray)){
				return $this->PrintActivityArray;
			}else{}
		}
	} 
?>

<?php
	class ActivitySudRc{
		public $ASR_Class,$ASR_T,$ASR_Y,$ASR_Name;
		public $SudActivityCount,$SudActivityArray;
		function __construct($ASR_Class,$ASR_T,$ASR_Y,$ASR_Name){
			$this->ASR_Class=$ASR_Class;
			$this->ASR_T=$ASR_T;
			$this->ASR_Y=$ASR_Y;
			$this->ASR_Name=$ASR_Name;
			
			$db_activityID=$_SERVER['REMOTE_ADDR'];
			$connpdo_activity=new conntopdo_activity($db_activityID);
			$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
			
			$SAKNClassA=substr($this->ASR_Class,0,2);
			$SAKNClassB=substr($this->ASR_Class,2,2);	

			$SudActivityCount=0;
			$SudActivityArray=array();
				
			try{
				$SudActivityNameSql="select `activity_txt`,`activity_key` 
									 from `activity` where `activity_t`='{$this->ASR_T}' 
									 and `activity_y`='{$this->ASR_Y}' 
									 and `activity_level`>='{$SAKNClassA}' 
									 and `activity_level`<='{$SAKNClassB}' 
									 and `activity_txt` like '%{$this->ASR_Name}%' 
									 ORDER BY `activity_key` ASC;";
					if($SudActivityNameRs=$pdo_activity->query($SudActivityNameSql)){
						while($SudActivityNameRow=$SudActivityNameRs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($SudActivityNameRow) && count($SudActivityNameRow)){
								$SudActivityCountSql="SELECT COUNT(`ac_key`) AS `activity_count` 
													  FROM `activity_student` 
													  WHERE `ac_t`='{$this->ASR_T}' 
													  AND `ac_y`='{$this->ASR_Y}' 
													  AND `activity_activity_key`='{$SudActivityNameRow['activity_key']}';";
									if($SudActivityCountRs=$pdo_activity->query($SudActivityCountSql)){
										$SudActivityCountRow=$SudActivityCountRs->Fetch(PDO::FETCH_ASSOC);
											if(is_array($SudActivityCountRow) && count($SudActivityCountRow)){
													$activity_count=$SudActivityCountRow["activity_count"];
													$SudActivityCount=$SudActivityCount+$activity_count;
											}else{
													$SudActivityCount=$SudActivityCount+0;
											}
									}else{
										$SudActivityCount=$SudActivityCount+0;
									}
									
								$SudActivitySudSql="SELECT `ac_key` 
													FROM `activity_student` 
													WHERE `ac_t`='{$this->ASR_T}' 
													AND `ac_y`='{$this->ASR_Y}' 
													AND `activity_activity_key`='{$SudActivityNameRow['activity_key']}';";
									if($SudActivitySudRs=$pdo_activity->query($SudActivitySudSql)){
										while($SudActivitySudRow=$SudActivitySudRs->Fetch(PDO::FETCH_ASSOC)){
											$SudActivityArray[]=$SudActivitySudRow;
										}
									}else{
										$SudActivityArray=null;
									}
							}else{
								//---------------------------------------------
							}
						}
					}else{
						//-----------------------------------------------------
					}
			}catch(PDOException $ASS){
				//-------------------------------------------------------------
			}
			if(isset($SudActivityCount,$SudActivityArray)){
				$this->SudActivityCount=$SudActivityCount;
				$this->SudActivityArray=$SudActivityArray;				
			}else{
				
			}			
		}function RunSudActivityCount(){
			if(isset($this->SudActivityCount)){
				return $this->SudActivityCount;
			}else{}
		}function RunSudActivityArray(){
			if(isset($this->SudActivityArray)){
				return $this->SudActivityArray;
			}else{}
		}
	}
?>

<?php
	class activity_taacher{
		public $activity_k,$activity_t,$activity_y;
		public $at_key;
		function __construct($activity_k,$activity_t,$activity_y){
			$this->activity_k=$activity_k;
			$this->activity_t=$activity_t;
			$this->activity_y=$activity_y;
			
			$db_activityID=$_SERVER['REMOTE_ADDR'];
			$connpdo_activity=new conntopdo_activity($db_activityID);
			$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
			
			$activitySql="SELECT `at_key` 
						  FROM `activity_teacher` 
						  WHERE `activity_activity_key`='{$this->activity_k}'
						  AND `activity_activity_t`='{$this->activity_t}' 
						  AND `activity_activity_y`='{$this->activity_y}'";
				if($activityRc=$pdo_activity->query($activitySql)){
					$activityRow=$activityRc->Fetch(PDO::FETCH_ASSOC);					
					if(is_array($activityRow) && count($activityRow)){
						$at_key=$activityRow["at_key"];						
					}else{
						$at_key=null;
					}
				}else{
					$at_key=null;
				}
				if(isset($at_key)){
					$this->at_key=$at_key;
				}else{
					$pdo_activity=Null;
				}
			
		}function taacher_keyrc(){
			if(isset($this->at_key)){
				return $this->at_key;
			}else{
				//-----------------------------------------------------
			}
		}
	}
?>



<?php
	class insert_activity_student{
		public $ias_key,$ias_t,$ias_y,$ias_activity;
		public $insert_ias;
		function __construct($ias_key,$ias_t,$ias_y,$ias_activity){
			$this->ias_key=$ias_key;
			$this->ias_t=$ias_t;
			$this->ias_y=$ias_y;
			$this->ias_activity=$ias_activity;
			
			$db_activityID=$_SERVER['REMOTE_ADDR'];
			$connpdo_activity=new conntopdo_activity($db_activityID);
			$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
			
			$ias_sql="INSERT INTO `activity_student`(`ac_key`, `ac_t`, `ac_y`, `activity_activity_key`)
					  VALUES ('{$this->ias_key}','{$this->ias_t}','{$this->ias_y}','{$this->ias_activity}')";
			if($pdo_activity->exec($ias_sql)>0){
				$insert_ias="yes";
			}else{
				$insert_ias="no";
			}
			unset($pdo_activity);
			$this->insert_ias=$insert_ias;
		}function insert_activity_rc(){
			return $this->insert_ias;
		}
	}
?>

<?php
	class delete_activity_student{
		public $das_key,$das_t,$das_y,$das_activity;
		public $delete_das;
		function __construct($das_key,$das_t,$das_y,$das_activity){
			$this->das_key=$das_key;
			$this->das_t=$das_t;
			$this->das_y=$das_y;
			$this->das_activity=$das_activity;
			
			$db_activityID=$_SERVER['REMOTE_ADDR'];
			$connpdo_activity=new conntopdo_activity($db_activityID);
			$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
			
			$das_sql="DELETE FROM `activity_student` 
					  WHERE`ac_key`='{$this->das_key}' 
					  and `ac_t`='{$this->das_t}' 
					  and `ac_y`='{$this->das_y}' 
					  and `activity_activity_key`='{$this->das_activity}';";
			if($pdo_activity->exec($das_sql)>0){
				$delete_das="yes";
			}else{
				$delete_das="no";
			}
			unset($pdo_activity);
			$this->delete_das=$delete_das;
		}function delete_activity_rc(){
			return $this->delete_das;
		}
	}
?>




<?php
		class updata_activity_keep{
			public $activity_key,$activity_t,$activity_y,$activity_count;
			public $updata_uak;
			function __construct($activity_key,$activity_t,$activity_y,$activity_count){
				$this->activity_key=$activity_key;
				$this->activity_t=$activity_t;
				$this->activity_y=$activity_y;
				$this->activity_count=$activity_count;

				$db_activityID=$_SERVER['REMOTE_ADDR'];
				$connpdo_activity=new conntopdo_activity($db_activityID);
				$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
				
				$uak_sql="UPDATE `activity_keep` SET `ak_count`='{$this->activity_count}' 
						  WHERE `activity_activity_key`='{$this->activity_key}' and `activity_activity_t`='{$this->activity_t}' and `activity_activity_y`='{$this->activity_y}'";
				if($pdo_activity->exec($uak_sql)>0){
					$updata_uak="yes";
				}else{
					$updata_uak="no";
				}
				unset($pdo_activity);
				$this->updata_uak=$updata_uak;
			}function updatato_activiry_keep(){
				return $this->updata_uak;
			}
		}
?>


<?php
	class check_activity{ //count***
		public $check_key,$check_t,$check_y;
		public $ak_txt,$count_ac,$ak_keep,$ak_count;
		function __construct($check_key,$check_t,$check_y){
			$this->check_key=$check_key;
			$this->check_t=$check_t;
			$this->check_y=$check_y;
			
			$db_activityID=$_SERVER['REMOTE_ADDR'];
			$connpdo_activity=new conntopdo_activity($db_activityID);
			$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
			
			$keep_activitySql="SELECT `ak_keep`,`ak_count`,`activity_activity_key` 
						       FROM `activity_keep` 
							   WHERE `activity_activity_key`='{$this->check_key}' 
							   and `activity_activity_t`='{$this->check_t}'
							   and `activity_activity_y`='{$this->check_y}' ";
			if($keep_activityRs=$pdo_activity->query($keep_activitySql)){
				$keep_activityRow=$keep_activityRs->Fetch(PDO::FETCH_ASSOC);
				$ak_keep=$keep_activityRow["ak_keep"];
				$ak_count=$keep_activityRow["ak_count"];
				
				$copy_numSql="SELECT COUNT(`ac_key`) AS `count_ac` 
							  FROM `activity_student` 
							  WHERE `activity_activity_key`='{$this->check_key}' 
							  AND `ac_t`='{$this->check_t}' 
							  AND `ac_y`='{$this->check_y}';";
				if($copy_numRs=$pdo_activity->query($copy_numSql)){
				   $copy_numRow=$copy_numRs->Fetch(PDO::FETCH_ASSOC);
				   $count_ac=$copy_numRow["count_ac"];
				   $count_ac=$count_ac+1;
						if(($count_ac<=$ak_keep)){
							$ak_txt="yes";
						}else{
							$ak_txt="no";							
						}
				}else{
					//**************************************************************
				}
			}else{
				$ak_keep=0;
				$ak_count=0;
			}
			$pdo_activity=null;
				$this->ak_txt=$ak_txt;
				$this->count_ac=$count_ac;
				$this->ak_keep=$ak_keep;
				$this->ak_count=$ak_count;
		}function __destruct(){
				$this->ak_txt;
				$this->count_ac;
				$this->ak_keep;
				$this->ak_count;
		}
	}
?>

<?php  
	class check_activity_all{

		public $caa_key,$caa_t,$caa_y,$caa_quota;
		public $caa_txt,$sum_activity_print;
		function __construct($caa_key,$caa_t,$caa_y,$caa_quota){
			$this->caa_key=$caa_key;
			$this->caa_t=$caa_t;
			$this->caa_y=$caa_y;
			$this->caa_quota=$caa_quota;

			/*$db_activityID=$_SERVER['REMOTE_ADDR'];
			$connpdo_activity=new conntopdo_activity($db_activityID);
			$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();*/

//class activity_count_all
			$activity_data=new activity_count_all($this->caa_key,$this->caa_t,$this->caa_y,"Row_Activity");
				if(($activity_data->print_txt_error()!="error")){
					$sum_count=0;
					$sum_row=array();
					foreach($activity_data->print_activity_row() as $rc=>$activity_data_row){
						//check_activity
							$count_activity=new check_activity($activity_data_row["aej_id"],$this->caa_t,$this->caa_y);
						//check_activity end
						$sum_row[$sum_count]=$count_activity->count_ac;
						$sum_count=$sum_count+1;
					}
					$sum_activity=array_sum($sum_row);
				}else{
					$sum_activity=0;
				}

				if(($sum_activity==0 or $sum_activity==null)){
					$sum_activity_print=$sum_activity;
				}else{
					$sum_activity_print=($sum_activity-$sum_count);
				}

//class activity_count_all end  40
				//$test_sum_activity=$sum_activity_print-1;
				if(($sum_activity_print>=$this->caa_quota)){
					$caa_txt="no";
				}else{
					$caa_txt="yes";
				}
			$this->caa_txt=$caa_txt;
			$this->sum_activity_print=$sum_activity_print;
		}function test_activity_txt(){
			return $this->caa_txt;
		}function test_sum_activity_print(){
			return $this->sum_activity_print;
		}
	}

?>







<?php
	class check_activityA{
		public $check_key,$check_t,$check_y;
		public $ak_txt,$count_ac;
		function __construct($check_key,$check_t,$check_y){
			$this->check_key=$check_key;
			$this->check_t=$check_t;
			$this->check_y=$check_y;

			$db_activityID=$_SERVER['REMOTE_ADDR'];
			$connpdo_activity=new conntopdo_activity($db_activityID);
			$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
			
			$keep_activitySql="SELECT `ak_keep`,`ak_count`,`activity_activity_key` 
						       FROM `activity_keep` 
							   WHERE `activity_activity_key`='{$this->check_key}' 
							   and `activity_activity_t`='{$this->check_t}'
							   and `activity_activity_y`='{$this->check_y}' ";
			if(($keep_activityRs=$pdo_activity->query($keep_activitySql))){
				$keep_activityRow=$keep_activityRs->Fetch(PDO::FETCH_ASSOC);
				$ak_keep=$keep_activityRow["ak_keep"];
				$ak_count=$keep_activityRow["ak_count"];
				
				$copy_numSql="SELECT COUNT(`ac_key`) as `count_ac` 
							  FROM `activity_student` 
							  WHERE `activity_activity_key`='{$this->check_key}' 
							  and `ac_t`='{$this->check_t}' 
							  and `ac_y`='{$this->check_y}';";
				if(($copy_numRs=$pdo_activity->query($copy_numSql))){
				   $copy_numRow=$copy_numRs->Fetch(PDO::FETCH_ASSOC);
				   $count_ac=$copy_numRow["count_ac"];
				   //$count_ac=$count_ac-1;
						if(($count_ac<=$ak_keep)){
							$ak_txt="yes";
						}else{
							$ak_txt="no";							
						}
				}else{
					//**************************************************************
				}
			}else{
				//******************************************************************
			}
			$pdo_activity=null;
				$this->ak_txt=$ak_txt;
				$this->count_ac=$count_ac;
		}function __destruct(){
				$this->ak_txt;
				$this->count_ac;
		}
	}
?>


<?php

	class row_activityarray{
		public $txt_activitynotarray;
		public $activityarray;
		function __construct($txt_activitynotarray){
			$this->txt_activitynotarray=$txt_activitynotarray;
			$activityarray=array();
			$db_activityID=$_SERVER['REMOTE_ADDR'];
			$connpdo_activity=new conntopdo_activity($db_activityID);
			$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
			
			$activitySql=$this->txt_activitynotarray;
				if($activityRs=$pdo_activity->query($activitySql)){
					while($activityRow=$activityRs->Fetch(PDO::FETCH_ASSOC)){
						$activityarray[]=$activityRow;
					}
				}else{
					
				}
					$pdo_activity=Null;
					$this->activityarray=$activityarray;
		}function print_activityarray(){
			return $this->activityarray;
		}
		
	}

?>

<?php

		class row_activity{
			public $txt_activity;
			public $activity_notarray;
			function __construct($txt_activity){
				$this->txt_activity=$txt_activity;
				$activity_notarray=array();
				
				$db_activityID=$_SERVER['REMOTE_ADDR'];
				$connpdo_activity=new conntopdo_activity($db_activityID);
				$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
				
				$activity_sql=$this->txt_activity;
					if($activity_rs=$pdo_activity->query($activity_sql)){
						$activity_row=$activity_rs->Fetch(PDO::FETCH_ASSOC);
						$activity_notarray[]=$activity_row;
						
					}else{
				
					}
						$pdo_activity=Null;
						$this->activity_notarray=$activity_notarray;
				}function print_activity_notarray(){
					return $this->activity_notarray;
			}
		}

?>

<?php
	class print_stu_activity{
		public $psa_t,$pas_y,$pas_ak;
		public $stu_activity;
		function __construct($psa_t,$pas_y,$pas_ak){
			$this->psa_t=$psa_t;
			$this->pas_y=$pas_y;
			$this->pas_ak=$pas_ak;
			
			$db_activityID=$_SERVER['REMOTE_ADDR'];
			$connpdo_activity=new conntopdo_activity($db_activityID);
			$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
			
			$stu_activity=array();
			$activity_stuSql="SELECT `ac_key`, `ac_t`, `ac_y`, `activity_activity_key`
							  FROM `activity_student` 
							  WHERE `activity_activity_key`='{$this->pas_ak}'
							  and `ac_t`='{$this->psa_t}'
							  and `ac_y`='{$this->pas_y}' ";
			if($activity_stuRs=$pdo_activity->query($activity_stuSql)){
				while($activity_stuRow=$activity_stuRs->Fetch(PDO::FETCH_ASSOC)){
					$stu_activity[]=$activity_stuRow;
				}
			}else{
				$stu_activity=Null;
			}
			$pdo_activity=Null;
			$this->stu_activity=$stu_activity;
		}function print_activitydata(){
			return $this->stu_activity;
		}
	}
?>

<?php
	class print_activity{
		public $pa_level;
		public $pa_t;
		public $pa_y;
		function __construct($pa_level,$pa_t,$pa_y){
			$this->pa_level=$pa_level;
			$this->pa_t=$pa_t;
			$this->pa_y=$pa_y;
			
			$db_activityID=$_SERVER['REMOTE_ADDR'];
			$connpdo_activity=new conntopdo_activity($db_activityID);
			$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
			
			$activity_array=array();
			$activitySql="SELECT `activity_key`,`activity_txt`,`activity_showstudent`,`activity_category_ac_num`,`activity_teacher_at_key` 
					      FROM `activity` 
						  WHERE `activity_level`='{$this->pa_level}' 
						  and `activity_t`='{$this->pa_t}' 
						  and `activity_y`='{$this->pa_y}';";
			if($activityRs=$pdo_activity->query($activitySql)){
				while($activityRow=$activityRs->Fetch(PDO::FETCH_ASSOC)){
					$activity_array[]=$activityRow;
				}
			}else{
				$activity_array=Null;
			}
			$pdo_activity=Null;
			$this->activity_array=$activity_array;
			
		}function print_activitydata(){
			return $this->activity_array;
		}
	}
?>

<?php
	//stuRc_activity
	class sturc_activity{
		public $sa_key,$sa_t,$sa_y;		
		public $sturc_array;
		function __construct($sa_key,$sa_t,$sa_y){
			$this->sa_key=$sa_key;
			$this->sa_t=$sa_t;
			$this->sa_y=$sa_y;
			$sturc_array=array();
			
			$db_activityID=$_SERVER['REMOTE_ADDR'];
			$connpdo_activity=new conntopdo_activity($db_activityID);
			$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
			
			$aturc_activitySql="select  `activity`.`activity_key`,`activity`.`activity_txt`,`activity`.`activity_showstudent` 
							    from `activity_student` join `activity` on (`activity_student`.`activity_activity_key`=`activity`.`activity_key`)
								where `activity_student`.`ac_t`='{$this->sa_t}'
								and `activity_student`.`ac_y`='{$this->sa_y}'
								and `activity_student`.`ac_key`='{$this->sa_key}';";
				if($aturc_activityRs=$pdo_activity->query($aturc_activitySql)){
					while($aturc_activityRow=$aturc_activityRs->Fetch(PDO::FETCH_ASSOC)){
						$sturc_array[]=$aturc_activityRow;
					}
				}else{
						$sturc_array=Null;				
				}
			$pdo_activity=Null;
			$this->sturc_array=$sturc_array;
		}function print_sturcto(){
			return $this->sturc_array;
		}
	}
?>




<?php
    //print_activityRc
    class activityRc{
        public $ARC_level,$ARC_plan,$ARC_t,$ARC_y;
        public $activityRc_array;
		function __construct($ARC_level,$ARC_plan,$ARC_t,$ARC_y){
			
			$this->ARC_level=$ARC_level;
			$this->ARC_plan=$ARC_plan;
			$this->ARC_t=$ARC_t;
			$this->ARC_y=$ARC_y;
			
			$db_activityID=$_SERVER['REMOTE_ADDR'];
			$connpdo_activity=new conntopdo_activity($db_activityID);
			$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
			
			$activityRc_array=array();


			$activityRc_numASql="SELECT count(`activity_key`)  as `activity_numA` 
							     FROM `activity` WHERE `activity_level`='{$this->ARC_level}' 
								 and `activity_plan`= '{$this->ARC_plan}' 
								 and `activity_t`='{$this->ARC_t}' 
								 and `activity_y`='{$this->ARC_y}'";
			if($activityRc_numARs=$pdo_activity->query($activityRc_numASql)){
				$activityRc_numARow=$activityRc_numARs->Fetch(PDO::FETCH_ASSOC);
				$activity_numA=$activityRc_numARow["activity_numA"];
				if($activity_numA>=1){
					$activityRcSql="SELECT `activity_key`, `activity_txt`, `activity_showstudent`, `activity_teacher_at_key` 
									FROM `activity` WHERE  `activity_level`='{$this->ARC_level}'
									and `activity_plan`= '{$this->ARC_plan}'
									and `activity_t`='{$this->ARC_t}' 
									and `activity_y`='{$this->ARC_y}'";
					if($activityRcRs=$pdo_activity->query($activityRcSql)){
						while($activityRcRow=$activityRcRs->Fetch(PDO::FETCH_ASSOC)){
							$activityRc_array[]=$activityRcRow;
						}
					}else{
							$activityRc_array=Null;
					}
				}else{
					if($this->ARC_level>=41 and $this->ARC_level<=43){
						$activityRc_numBSql="SELECT count(`activity_key`)  as `activity_numB` 
											 FROM `activity` WHERE `activity_level`='94' 
											 and `activity_plan`= '14' 
											 and `activity_t`='{$this->ARC_t}' 
											 and `activity_y`='{$this->ARC_y}'";	
						if($activityRc_numBRs=$pdo_activity->query($activityRc_numBSql)){
							$activityRc_numBRow=$activityRc_numBRs->Fetch(PDO::FETCH_ASSOC);
							$activity_numB=$activityRc_numBRow["activity_numB"];
							if($activity_numB>=1){
								$activityRcSql="SELECT `activity_key`, `activity_txt`, `activity_showstudent`, `activity_teacher_at_key` 
												FROM `activity` WHERE  `activity_level`='94'
												and `activity_plan`= '14'
												and `activity_t`='{$this->ARC_t}' 
												and `activity_y`='{$this->ARC_y}'";
								if($activityRcRs=$pdo_activity->query($activityRcSql)){
									while($activityRcRow=$activityRcRs->Fetch(PDO::FETCH_ASSOC)){
										$activityRc_array[]=$activityRcRow;
									}
								}else{
										$activityRc_array=Null;
								}								
							}else{
//---------------------------------------------------------------------------------------------		
								$activityRcSql="SELECT `activity_key`, `activity_txt`, `activity_showstudent`, `activity_teacher_at_key` 
												FROM `activity` WHERE  `activity_level`='{$this->ARC_level}'
												and `activity_plan`= '14'
												and `activity_t`='{$this->ARC_t}' 
												and `activity_y`='{$this->ARC_y}'";
								if($activityRcRs=$pdo_activity->query($activityRcSql)){
									while($activityRcRow=$activityRcRs->Fetch(PDO::FETCH_ASSOC)){
										$activityRc_array[]=$activityRcRow;
									}
								}else{
										$activityRc_array=Null;
								}
//---------------------------------------------------------------------------------------------									
							}
						}else{
//---------------------------------------------------------------------------------------------								
						}				 
					}elseif($this->ARC_level>=31 and $this->ARC_level<=33){
						$activityRc_numBSql="SELECT count(`activity_key`)  as `activity_numB` 
											 FROM `activity` WHERE `activity_level`='93' 
											 and `activity_plan`= '2' 
											 and `activity_t`='{$this->ARC_t}' 
											 and `activity_y`='{$this->ARC_y}'";	
						if($activityRc_numBRs=$pdo_activity->query($activityRc_numBSql)){
							$activityRc_numBRow=$activityRc_numBRs->Fetch(PDO::FETCH_ASSOC);
							$activity_numB=$activityRc_numBRow["activity_numB"];
							if($activity_numB>=1){
								$activityRcSql="SELECT `activity_key`, `activity_txt`, `activity_showstudent`, `activity_teacher_at_key` 
												FROM `activity` WHERE  `activity_level`='93'
												and `activity_plan`= '2'
												and `activity_t`='{$this->ARC_t}' 
												and `activity_y`='{$this->ARC_y}'";
								if($activityRcRs=$pdo_activity->query($activityRcSql)){
									while($activityRcRow=$activityRcRs->Fetch(PDO::FETCH_ASSOC)){
										$activityRc_array[]=$activityRcRow;
									}
								}else{
										$activityRc_array=Null;
								}								
							}else{
//---------------------------------------------------------------------------------------------	
								$activityRcSql="SELECT `activity_key`, `activity_txt`, `activity_showstudent`, `activity_teacher_at_key` 
												FROM `activity` WHERE  `activity_level`='{$this->ARC_level}'
												and `activity_plan`= '2'
												and `activity_t`='{$this->ARC_t}' 
												and `activity_y`='{$this->ARC_y}'";
								if($activityRcRs=$pdo_activity->query($activityRcSql)){
									while($activityRcRow=$activityRcRs->Fetch(PDO::FETCH_ASSOC)){
										$activityRc_array[]=$activityRcRow;
									}
								}else{
										$activityRc_array=Null;
								}
//---------------------------------------------------------------------------------------------								
							}
						}else{
//---------------------------------------------------------------------------------------------								
						}						
					}else{
//---------------------------------------------------------------------------------------------			
			
//---------------------------------------------------------------------------------------------						
					}
				}
			}else{
//---------------------------------------------------------------------------------------------
			}
				unset($pdo_activity);
				$this->activityRc_array=$activityRc_array;
		}function print_activityRcto(){
			return $this->activityRc_array;
		}
    }

?>


<?php
	class InformationActivityStudent{
		public $IAS_Key;
		public $IAS_Array;
		function __construct($IAS_Key){
//---------------------------------------------------------			
			$this->IAS_Key=$IAS_Key;
//---------------------------------------------------------	
			$db_activityID=$_SERVER['REMOTE_ADDR'];
			$connpdo_activity=new conntopdo_activity($db_activityID);
			$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
//---------------------------------------------------------	
			$IAS_Array=array();
//---------------------------------------------------------	
				$IAS_Sql="select `activity`.`activity_key`,`activity`.`activity_txt`,`activity`.`activity_level`,`activity`.`activity_y`,`activity_category`.`ac_txt` 
                          from `activity_student` left join `activity` on(`activity_student`.`activity_activity_key`=`activity`.`activity_key`)
                          join `activity_category` on(`activity`.`activity_category_ac_num`=`activity_category`.`ac_num`) 
                          where `activity_student`.`ac_key`='{$this->IAS_Key}'";
					if($IAS_Rs=$pdo_activity->query($IAS_Sql)){
						while($IAS_Row=$IAS_Rs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($IAS_Row) && count($IAS_Row)){
								$IAS_Array[]=$IAS_Row;
							}else{
								$IAS_Array=null;
							}
						}
					}else{
						$IAS_Array=null;
					}
			if(isset($IAS_Array)){
				$this->IAS_Array=$IAS_Array;
				$pdo_activity=null;
			}else{
				$pdo_activity=null;
			}
		}function RunInformationActivityStudent(){
			if(isset($this->IAS_Array)){
				return $this->IAS_Array;
			}else{}
		}
	}
?>



<?php
    //print_activityRc
    class activityRc2{
        public $ARC_level;
       // public $ARC_plan;
        public $ARC_t;
        public $ARC_y;
		function __construct($ARC_level,$ARC_t,$ARC_y){
			
			$this->ARC_level=$ARC_level;
			//$this->ARC_plan=$ARC_plan;
			$this->ARC_t=$ARC_t;
			$this->ARC_y=$ARC_y;
			
			$db_activityID=$_SERVER['REMOTE_ADDR'];
			$connpdo_activity=new conntopdo_activity($db_activityID);
			$pdo_activity=$connpdo_activity->getconnto_connto_dataactivity_rc();
			
			$activityRc_array=array();


			$activityRc_numASql="SELECT count(`activity_key`)  as `activity_numA` 
							     FROM `activity` WHERE `activity_level`='{$this->ARC_level}' 
								 and `activity_t`='{$this->ARC_t}' 
								 and `activity_y`='{$this->ARC_y}'";
			if($activityRc_numARs=$pdo_activity->query($activityRc_numASql)){
				$activityRc_numARow=$activityRc_numARs->Fetch(PDO::FETCH_ASSOC);
				$activity_numA=$activityRc_numARow["activity_numA"];
				if($activity_numA>=1){
					$activityRcSql="SELECT `activity_key`, `activity_txt`, `activity_showstudent`, `activity_teacher_at_key` 
									FROM `activity` WHERE  `activity_level`='{$this->ARC_level}'
									and `activity_t`='{$this->ARC_t}' 
									and `activity_y`='{$this->ARC_y}'";
					if($activityRcRs=$pdo_activity->query($activityRcSql)){
						while($activityRcRow=$activityRcRs->Fetch(PDO::FETCH_ASSOC)){
							$activityRc_array[]=$activityRcRow;
						}
					}else{
							$activityRc_array=Null;
					}
				}else{
					if($this->ARC_level>=41 and $this->ARC_level<=43){
						$activityRc_numBSql="SELECT count(`activity_key`)  as `activity_numB` 
											 FROM `activity` WHERE `activity_level`='{$this->ARC_level}' 
											 and `activity_t`='{$this->ARC_t}' 
											 and `activity_y`='{$this->ARC_y}'";	
						if($activityRc_numBRs=$pdo_activity->query($activityRc_numBSql)){
							$activityRc_numBRow=$activityRc_numBRs->Fetch(PDO::FETCH_ASSOC);
							$activity_numB=$activityRc_numBRow["activity_numB"];
							if($activity_numB>=1){
								$activityRcSql="SELECT `activity_key`, `activity_txt`, `activity_showstudent`, `activity_teacher_at_key` 
												FROM `activity` WHERE  `activity_level`='{$this->ARC_level}'
												and `activity_t`='{$this->ARC_t}' 
												and `activity_y`='{$this->ARC_y}'";
								if($activityRcRs=$pdo_activity->query($activityRcSql)){
									while($activityRcRow=$activityRcRs->Fetch(PDO::FETCH_ASSOC)){
										$activityRc_array[]=$activityRcRow;
									}
								}else{
										$activityRc_array=Null;
								}								
							}else{
//---------------------------------------------------------------------------------------------									
							}
						}else{
//---------------------------------------------------------------------------------------------								
						}				 
					}elseif($this->ARC_level>=31 and $this->ARC_level<=33){
						$activityRc_numBSql="SELECT count(`activity_key`)  as `activity_numB` 
											 FROM `activity` WHERE `activity_level`='93' 
											 and `activity_t`='{$this->ARC_t}' 
											 and `activity_y`='{$this->ARC_y}'";	
						if($activityRc_numBRs=$pdo_activity->query($activityRc_numBSql)){
							$activityRc_numBRow=$activityRc_numBRs->Fetch(PDO::FETCH_ASSOC);
							$activity_numB=$activityRc_numBRow["activity_numB"];
							if($activity_numB>=1){
								$activityRcSql="SELECT `activity_key`, `activity_txt`, `activity_showstudent`, `activity_teacher_at_key` 
												FROM `activity` WHERE  `activity_level`='93'
												and `activity_t`='{$this->ARC_t}' 
												and `activity_y`='{$this->ARC_y}'";
								if($activityRcRs=$pdo_activity->query($activityRcSql)){
									while($activityRcRow=$activityRcRs->Fetch(PDO::FETCH_ASSOC)){
										$activityRc_array[]=$activityRcRow;
									}
								}else{
										$activityRc_array=Null;
								}								
							}else{
//---------------------------------------------------------------------------------------------									
							}
						}else{
//---------------------------------------------------------------------------------------------								
						}						
					}else{
//---------------------------------------------------------------------------------------------						
					}
				}
			}else{
//---------------------------------------------------------------------------------------------
			}
				$pdo_activity=Null;
				$this->activityRc_array=$activityRc_array;
		}function print_activityRcto(){
			return $this->activityRc_array;
		}
    }







?>