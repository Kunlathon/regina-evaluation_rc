<!--
##################################
pdo_data.php######################
#class count_pdodata##############
#public function call_pdodata()###
##################################
-->
<!--
####################################
pdo_conndatastu.php#################
#class count_conndatastu############
#function call_coun_conndatastu()###
####################################
-->
<!--
####################################
pdo_admission.php###################
#class connect_Admission############
#function call_RunConnAdmission()###
#####################################
-->

<?php
	class SortPaln{
		public $SP_Class;
		public $SortPrint_Error,$SortPrint_Paln;
		function __construct($SP_Class){
			$this->SP_Class=$SP_Class;
			$regina_dataID=$_SERVER['REMOTE_ADDR'];
			$connect_data=new count_pdodata($regina_dataID);
			$pdodata_regina=$connect_data->call_pdodata();
			$SortPrint_Paln=array();
			$SortPrint_Error="error";
				try{
					$SortPlanSql="select `rc_plan`.`IDPlan`, `rc_plan`.`Name` as `Plan_Name`,`rc_plan`.`LName` as `Plan_Lname` ,`rc_plan`.`swip_key`
					              from `rc_plan_join` left join `rc_plan` on (`rc_plan_join`.`rc_plan`=`rc_plan`.`IDPlan`)
								  where `rc_plan_join`.`rc_class` ='{$this->SP_Class}' 
								  ORDER BY `rc_plan`.`swip_key` ASC;";
						if(($SortPlanRs=$pdodata_regina->query($SortPlanSql))){
							while($SortPlanRow=$SortPlanRs->Fetch(PDO::FETCH_ASSOC)){
								if((is_array($SortPlanRow) && count($SortPlanRow))){
									$SortPrint_Error="no_error";
									$SortPrint_Paln[]=$SortPlanRow;
								}else{
									$SortPrint_Error="error";
									$SortPrint_Paln="-";
								}
							}
						}else{
							$SortPrint_Error="error";
							$SortPrint_Paln="-";
						}
				}catch(PDOException $e){
					$SortPrint_Error="error";
					$SortPrint_Print="-";
				}
			$this->SortPrint_Error=$SortPrint_Error;
			$this->SortPrint_Paln=$SortPrint_Paln;
			$pdodata_regina=null;
		}function CallSortError(){
			return $this->SortPrint_Error;
		}function CallSortArray(){
			return $this->SortPrint_Paln;
		}
	}

?>


<?php
	class RSPlan{
		public $RSP_ID;
		public $PlanName,$PlanLName;
		function __construct($RSP_ID){
			$this->RSP_ID=$RSP_ID;
			$regina_dataID=$_SERVER['REMOTE_ADDR'];
			$connect_data=new count_pdodata($regina_dataID);
			$pdodata_regina=$connect_data->call_pdodata();
				try{
					$RSPlanSql="SELECT `Name` AS `PlanName`,`LName` AS `PlanLName` 
							    FROM `rc_plan` 
								WHERE `IDPlan`='{$this->RSP_ID}';";
						if(($RSPlanRs=$pdodata_regina->query($RSPlanSql))){
							$RSPlanRow=$RSPlanRs->Fetch(PDO::FETCH_ASSOC);
								if((is_array($RSPlanRow) && count($RSPlanRow))){
									$PlanName=$RSPlanRow["PlanName"];
									$PlanLName=$RSPlanRow["PlanLName"];
								}else{
									$PlanName="-";
									$PlanLName="-";
								}
						}else{
							$PlanName="-";
							$PlanLName="-";							
						}
				}catch(PDOException $e){
					$PlanName="-";
					$PlanLName="-";
				}
			$this->PlanName=$PlanName;
			$this->PlanLName=$PlanLName;
			$pdodata_regina=null;
		}function __destruct(){
			$this->PlanName;
			$this->PlanLName;
		}
	}
?>



<?php
	//Group Room Class 
	class GroupRoomClass{
		public $GRC_Year,$GRC_Class;
		public $GroupRoomClass;
		function __construct($GRC_Year,$GRC_Class){
			$this->GRC_Year=$GRC_Year;
			$this->GRC_Class=$GRC_Class;
			$regina_dataID=$_SERVER['REMOTE_ADDR'];
			$connect_data=new count_pdodata($regina_dataID);
			$pdodata_regina=$connect_data->call_pdodata();
			$GroupRoomClass=Array();
				try{
					$group_RoomClassSql="select distinct `rsc_room` as `int_room` 
										 from `regina_stu_class` 
										 where `rsc_year`='{$this->GRC_Year}' 
										 and `rsc_class`='{$this->GRC_Class}' 
										 ORDER BY `rsc_room` ASC;";
						if(($group_RoomClassRs=$pdodata_regina->query($group_RoomClassSql))){
							while($group_RoomClassRow=$group_RoomClassRs->Fetch(PDO::FETCH_ASSOC)){
								if((is_array($group_RoomClassRow) && count($group_RoomClassRow))){
									$GroupRoomClass[]=$group_RoomClassRow;
								}else{
									$GroupRoomClass="-";
								}
							}
						}else{
							$GroupRoomClass="-";
						}
				}catch(PDOException $e){
					$GroupRoomClass="-";
				}
			$this->GroupRoomClass=$GroupRoomClass;
			$pdodata_regina=null;
		}function RunGroupRoomClass(){
			return $this->GroupRoomClass;
		}
	}
?>


<?php
	class RcClassStudenYear{
		public $DCS_Type,$DCS_Key,$DCS_Term,$DCS_Year,$DCS_Class;
		public $DataClassStuArray;
		function __construct($DCS_Type,$DCS_Key,$DCS_Term,$DCS_Year,$DCS_Class){
//-------------------------------------------------------------------------
			$this->DCS_Type=$DCS_Type;
			$this->DCS_Key=$DCS_Key;
			$this->DCS_Term=$DCS_Term;
			$this->DCS_Year=$DCS_Year;
			$this->DCS_Class=$DCS_Class;
//-------------------------------------------------------------------------			
			$DataClassStuArray=array();
//-------------------------------------------------------------------------			
			$regina_dataID=$_SERVER['REMOTE_ADDR'];
			$connect_data=new count_pdodata($regina_dataID);
			$pdodata_regina=$connect_data->call_pdodata();
//-------------------------------------------------------------------------
				if(($this->DCS_Type=="KeyClass")){
//-------------------------------------------------------------------------		
					try{
						$DataClassStuSql="SELECT * FROM `regina_stu_class` 
										  WHERE `rsd_studentid` ='{$this->DCS_Key}' 
										  AND `rsc_year`='{$this->DCS_Year}' 
										  AND `rsc_term`='{$this->DCS_Term}'
										  AND `rsc_class`='{$this->DCS_Class}'";
							if(($DataClassStuRs=$pdodata_regina->query($DataClassStuSql))){
								while($DataClassStuRow=$DataClassStuRs->Fetch(PDO::FETCH_ASSOC)){
									if((is_array($DataClassStuRow) && count($DataClassStuRow))){
										$DataClassStuArray[]=$DataClassStuRow;
									}else{
										$DataClassStuArrayp[]=$DataClassStuRow;
									}
								}
							}else{
								$DataClassStuArray=null;
							}				
					}catch(PDOException $e){
						$DataClassStuArray=null;
					}
//-------------------------------------------------------------------------						
				}elseif(($this->DCS_Type=="NokeyClassA")){
					try{
						$DataClassStuSql="SELECT * FROM `regina_stu_class` 
										  WHERE `rsd_studentid` ='{$this->DCS_Key}' 
										  AND `rsc_year`='{$this->DCS_Year}' 
										  AND `rsc_term`='{$this->DCS_Term}'";
							if(($DataClassStuRs=$pdodata_regina->query($DataClassStuSql))){
								while($DataClassStuRow=$DataClassStuRs->Fetch(PDO::FETCH_ASSOC)){
									if((is_array($DataClassStuRow) && count($DataClassStuRow))){
										$DataClassStuArray[]=$DataClassStuRow;
									}else{
										$DataClassStuArray[]=$DataClassStuRow;
									}
								}
							}else{
								$DataClassStuArray=null;
							}				
					}catch(PDOException $e){
						$DataClassStuArray=null;
					}					
				}elseif(($this->DCS_Type=="NokeyClassB")){
					try{
						$DataClassStuSql="SELECT * FROM `regina_stu_class` 
										  WHERE `rsd_studentid` ='{$this->DCS_Key}' 
										  AND `rsc_year`='{$this->DCS_Year}'";
							if(($DataClassStuRs=$pdodata_regina->query($DataClassStuSql))){
								while($DataClassStuRow=$DataClassStuRs->Fetch(PDO::FETCH_ASSOC)){
									if((is_array($DataClassStuRow) && count($DataClassStuRow))){
										$DataClassStuArray[]=$DataClassStuRow;
									}else{
										$DataClassStuArray[]=$DataClassStuRow;
									}
								}
							}else{
								$DataClassStuArray=null;
							}				
					}catch(PDOException $e){
						$DataClassStuArray=null;
					}					
				}elseif(($this->DCS_Type=="studying")){
					try{
						$DataClassStuSql="SELECT * FROM `regina_stu_class` 
										  WHERE `rsc_year` = '{$this->DCS_Year}' 
										  AND `rsc_term` = '{$this->DCS_Term}'
										  AND `rsc_class` = '{$this->DCS_Class}' 
										  AND `rsc_status` = '1'";
							if(($DataClassStuRs=$pdodata_regina->query($DataClassStuSql))){
								while($DataClassStuRow=$DataClassStuRs->Fetch(PDO::FETCH_ASSOC)){
									if((is_array($DataClassStuRow) && count($DataClassStuRow))){
										$DataClassStuArray[]=$DataClassStuRow;
									}else{
										$DataClassStuArray[]=$DataClassStuRow;
									}
								}
							}else{
								$DataClassStuArray=null;
							}				
					}catch(PDOException $e){
						$DataClassStuArray=null;
					}	
				}elseif(($this->DCS_Type=="studying_no_status")){
					try{
						$DataClassStuSql="SELECT * FROM `regina_stu_class` 
										  WHERE `rsc_year` = '{$this->DCS_Year}' 
										  AND `rsc_term` = '{$this->DCS_Term}'
										  AND `rsc_class` = '{$this->DCS_Class}'";
							if(($DataClassStuRs=$pdodata_regina->query($DataClassStuSql))){
								while($DataClassStuRow=$DataClassStuRs->Fetch(PDO::FETCH_ASSOC)){
									if((is_array($DataClassStuRow) && count($DataClassStuRow))){
										$DataClassStuArray[]=$DataClassStuRow;
									}else{
										$DataClassStuArray[]=$DataClassStuRow;
									}
								}
							}else{
								$DataClassStuArray=null;
							}				
					}catch(PDOException $e){
						$DataClassStuArray=null;
					}	
				}else{
//-------------------------------------------------------------------------		
					try{
						$DataClassStuSql="SELECT * FROM `regina_stu_class` 
										  WHERE `rsd_studentid` ='{$this->DCS_Key}' 
										  AND `rsc_year`='{$this->DCS_Year}' 
										  AND `rsc_term`='{$this->DCS_Term}'
										  AND `rsc_class`='{$this->DCS_Class}'";
							if(($DataClassStuRs=$pdodata_regina->query($DataClassStuSql))){
								while($DataClassStuRow=$DataClassStuRs->Fetch(PDO::FETCH_ASSOC)){
									if((is_array($DataClassStuRow) && count($DataClassStuRow))){
										$DataClassStuArray[]=$DataClassStuRow;
									}else{
										$DataClassStuArray[]=$DataClassStuRow;
									}
								}
							}else{
								$DataClassStuArray=null;
							}				
					}catch(PDOException $e){
						$DataClassStuArray=null;
					}
//-------------------------------------------------------------------------						
				}
				
				if((isset($DataClassStuArray))){
					$this->DataClassStuArray=$DataClassStuArray;
					$pdodata_regina=null;
				}else{
					$pdodata_regina=null;
				}
//-------------------------------------------------------------------------	
		}function RunRcClassStudent(){
			if((isset($this->DataClassStuArray))){
				return $this->DataClassStuArray;
			}else{}
		}
	}
?>

<?php
	class RcClassStudent{
		public $DCS_Key;
		public $DataClassStuArray;
		function __construct($DCS_Key){
//-------------------------------------------------------------------------
			$this->DCS_Key=$DCS_Key;
//-------------------------------------------------------------------------			
			$DataClassStuArray=array();
//-------------------------------------------------------------------------			
			$regina_dataID=$_SERVER['REMOTE_ADDR'];
			$connect_data=new count_pdodata($regina_dataID);
			$pdodata_regina=$connect_data->call_pdodata();
//-------------------------------------------------------------------------		
			try{
				$DataClassStuSql="SELECT * 
								  FROM `regina_stu_class` 
								  WHERE `rsd_studentid` ='{$this->DCS_Key}'
								  ORDER BY `rsc_year`,`rsc_term` ASC;";
					if(($DataClassStuRs=$pdodata_regina->query($DataClassStuSql))){
						while($DataClassStuRow=$DataClassStuRs->Fetch(PDO::FETCH_ASSOC)){
							if((is_array($DataClassStuRow) && count($DataClassStuRow))){
								$DataClassStuArray[]=$DataClassStuRow;
							}else{
								$DataClassStuArray=null;
							}
						}
					}else{
						$DataClassStuArray=null;
					}				
			}catch(PDOException $e){
				$DataClassStuArray=null;
			}
//-------------------------------------------------------------------------					
				if((isset($DataClassStuArray))){
					$this->DataClassStuArray=$DataClassStuArray;
					$pdodata_regina=null;
				}else{
					$pdodata_regina=null;
				}
//-------------------------------------------------------------------------	
		}function RunRcClassStudent(){
			if((isset($this->DataClassStuArray))){
				return $this->DataClassStuArray;
			}else{}
		}
	}
?>


<?php
	class PrintLavaL{
		public $PL_key;
		public $LavaTh,$LavaEh,$LavaTxt;
		function __construct($PL_key){
//-------------------------------------------------------------------------
			$this->PL_key=$PL_key;
//-------------------------------------------------------------------------		
			switch($this->PL_key){
				case 3:
					$LavaTh="อ.3";
					$LavaTxt="อนุบาล 3";
					$LavaEh="K3";
				break;
				case 11:
					$LavaTh="ป.1";
					$LavaTxt="ประถมศึกษาปีที่ 1";
					$LavaEh="P1";
				break;			
				case 12:
					$LavaTh="ป.2";
					$LavaTxt="ประถมศึกษาปีที่ 2";
					$LavaEh="P2";
				break;				
				case 13:
					$LavaTh="ป.3";
					$LavaTxt="ประถมศึกษาปีที่ 3";
					$LavaEh="P3";
				break;				
				case 21:
					$LavaTh="ป.4";
					$LavaTxt="ประถมศึกษาปีที่ 4";
					$LavaEh="P4";
				break;				
				case 22:
					$LavaTh="ป.5";
					$LavaTxt="ประถมศึกษาปีที่ 5";
					$LavaEh="P5";
				break;				
				case 23:
					$LavaTh="ป.6";
					$LavaTxt="ประถมศึกษาปีที่ 6";
					$LavaEh="P6";
				break;				
				case 31:
					$LavaTh="ม.1";
					$LavaTxt="มัธยมศึกษาปีที่ 1";
					$LavaEh="S1";
				break;				
				case 32:
					$LavaTh="ม.2";
					$LavaTxt="มัธยมศึกษาปีที่ 2";
					$LavaEh="S2";
				break;				
				case 33:
					$LavaTh="ม.3";
					$LavaTxt="มัธยมศึกษาปีที่ 3";
					$LavaEh="S3";
				break;				
				case 41:
					$LavaTh="ม.4";
					$LavaTxt="มัธยมศึกษาปีที่ 4";
					$LavaEh="S4";
				break;				
				case 42:
					$LavaTh="ม.5";
					$LavaTxt="มัธยมศึกษาปีที่ 5";
					$LavaEh="S5";
				break;				
				case 43:
					$LavaTh="ม.6";
					$LavaTxt="มัธยมศึกษาปีที่ 6";
					$LavaEh="S6";
				break;
				default:
					$LavaTxt=null;
					$LavaTh=null;
					$LavaEh=null;
			}
			if(isset($LavaTh,$LavaEh,$LavaTxt)){
				$this->LavaTh=$LavaTh;
				$this->LavaEh=$LavaEh;
				$this->LavaTxt=$LavaTxt;
			}else{
				//--------------------
			}
		}function RunPrintLavaL(){
			if(isset($this->LavaTh)){
				return $this->LavaTh;
			}else{}
		}function RunPrintLavaEh(){
			if(isset($this->LavaEh)){
				return $this->LavaEh;
			}else{}
		}function RunprintLavaTxtTh(){
			if(isset($this->LavaTxt)){
				return $this->LavaTxt;
			}else{}
		}
	}

?>

<?php
    class NewRcClass{
        public $NRCclass,$NRCyear;
		public $NewClass;
        function __construct($NRCclass,$NRCyear){
//-------------------------------------------------------------------------            
            $this->NRCclass=$NRCclass;
            $this->NRCyear=$NRCyear;
//------------------------------------------------------------------------- 
            $NewClass=array();
//-------------------------------------------------------------------------			
			$regina_dataID=$_SERVER['REMOTE_ADDR'];
			$connect_data=new count_pdodata($regina_dataID);
			$pdodata_regina=$connect_data->call_pdodata();
//-------------------------------------------------------------------------            
            try{
				$NewRcClassSql="SELECT `rsn_id`, `rsn_year`, `rsn_level` 
								FROM `regina_stu_new` 
								WHERE `rsn_year`='{$this->NRCyear}' 
								AND `rsn_level`='{$this->NRCclass}';";
					if($NewRcClassRs=$pdodata_regina->query($NewRcClassSql)){
						while($NewRcClassRow=$NewRcClassRs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($NewRcClassRow) && count($NewRcClassRow)){
								$NewClass[]=$NewRcClassRow;
							}else{
								$NewClass[]=null;
							}
						}
					}else{
						$NewClass=null;
					}				
			}catch(PDOException $e){
				$NewClass=null;
			}
				if(isset($NewClass)){
					$this->NewClass=$NewClass;
					$pdodata_regina=null;
				}else{
					$pdodata_regina=null;
				}    
        }function RunNewRcClass(){
            if(isset($this->NewClass)){
                return $this->NewClass;
            }else{
                //---------------------
            }
        }
    }

?>




<?php
	class  dateofbirthRS{
		public $birthdate;
		public $wyear,$wmonth,$wday,$ystr,$agestr;
		function __construct($birthdate){
			$this->birthdate=$birthdate;
			$today = date('d-m-Y');
			list($bday,$bmonth,$byear) = explode('-',$this->birthdate);
			list($tday,$tmonth,$tyear) = explode('-',$today);
				if($byear < 1970){
					$yearad = 1970 - $byear;
					$byear = 1970;
				}else{
					$yearad = 0;
				}
			$mbirth = mktime(0,0,0, $bmonth,$bday,$byear);
			$mtoday = mktime(0,0,0, $tmonth,$tday,$tyear);
			
			$mage = ($mtoday - $mbirth);
			$wyear = (date('Y', $mage)-1970+$yearad);
			$wmonth = (date('m', $mage)-1);
			$wday = (date('d', $mage)-1);
			
			$ystr = ($wyear > 1 ? " ปี" : " ปี");
			$mstr = ($wmonth > 1 ? " เดือน" : " เดือน");
			$dstr = ($wday > 1 ? " วัน" : " วัน");
			
			if(($wyear > 0 and $wmonth > 0 and $wday > 0)) {
				$agestr = $wyear.$ystr." ".$wmonth.$mstr." ".$wday.$dstr;
			}elseif(($wyear == 0 and $wmonth == 0 and $wday > 0)) {
				$agestr = $wday.$dstr;
				//$wyear=0;
				//$wmonth=0;
			}elseif(($wyear > 0 and $wmonth > 0 and $wday == 0)) {
				$agestr = $wyear.$ystr." ".$wmonth.$mstr;
				//$wday=0;
			}elseif(($wyear == 0 and $wmonth > 0 and $wday > 0)) {
				$agestr = $wmonth.$mstr." ".$wday.$dstr;
				//$wyear=0;
			}elseif(($wyear > 0 and $wmonth == 0 and $wday > 0)) {
				$agestr = $wyear.$ystr." ".$wday.$dstr;
				//$wmonth=0;
			}elseif(($wyear == 0 and $wmonth > 0 and $wday == 0)) {
				$agestr = $wmonth.$mstr;
				//$wyear=0;
				//$wday=0;
			}else {
				$agestr ="";
				//$wyear="";
				//$wmonth="";
				//$wday="";
			}
			$this->wyear=$wyear;
			$this->wmonth=$wmonth;
			$this->wday=$wday;
			$this->ystr=$ystr;
			$this->agestr=$agestr;
		}function __destruct(){
			$this->wyear;
			$this->wmonth;
			$this->wday;
			$this->ystr;
			$this->agestr;
		}
	}
?>



<?php
	class PrintReginaStuDataClass{//ข้อมูลนักเรียนราบบุคคลเบืองต้น คำหน้านามคำนวนจาก clsss
		public $studentid;
		public $age,$DataAge,$PRS_nameTH,$PRS_nameEH,$PRS_NTH,$PRS_nickTh,$PRS_nickEn,$PRS_status,$PRS_SudId,$birth,$PRS_home,$PRS_Identification;
		function __construct($studentid){
			$this->studentid=$studentid;
//-------------------------------------------------------------------------			
			$regina_dataID=$_SERVER['REMOTE_ADDR'];
			$connect_data=new count_pdodata($regina_dataID);
			$pdodata_regina=$connect_data->call_pdodata();
//-------------------------------------------------------------------------			
			try{
				$PrintReginaStuClassSql="SELECT `rsc_class` FROM `regina_stu_class` WHERE `rsd_studentid` = '{$this->studentid}' ORDER BY `rsc_year` DESC;";
					if(($PrintReginaStuClassRs=$pdodata_regina->query($PrintReginaStuClassSql))){
						$PrintReginaStuClassRow=$PrintReginaStuClassRs->Fetch(PDO::FETCH_ASSOC);
							if((is_array($PrintReginaStuClassRow) && count($PrintReginaStuClassRow))){
								$rsc_class=$PrintReginaStuClassRow["rsc_class"];
							}else{
								$rsc_class="-";
							}
					}else{
						$rsc_class="-";
					}
			}catch(PDOException $e){
				$rsc_class="-";
			}
			
			try{
				$DataReginaSal="SELECT `rsd_studentid`,`rsd_Identification`, `rsd_name` ,`rsd_surname`,LOWER(`rsd_nameEn`) AS `rsd_nameEn`,LOWER(`rsd_surnameEn`) AS `rsd_surnameEn` ,`nickTh`,`nickEn`,`rse_home`,`rse_student_status` 
								FROM `regina_stu_data` 
								WHERE `rsd_studentid`='{$this->studentid}';";
					if(($DataReginaRs=$pdodata_regina->query($DataReginaSal))){
						$DataReginaRow=$DataReginaRs->Fetch(PDO::FETCH_ASSOC);
							if((is_array($DataReginaRow) && count($DataReginaRow))){
								
	//-------------------------------------------------------------------------				
								$regina_conndatastuID=$_SERVER['REMOTE_ADDR'];
								$connect_conndatastu=new count_conndatastu($regina_conndatastuID);
								$pdoconndatastu_regina=$connect_conndatastu->call_coun_conndatastu();
	//-------------------------------------------------------------------------		
									try{
										$RcStuBirthSql="SELECT `stu_birth` FROM `data_student` WHERE `stu_id`='{$this->studentid}';";
											if(($RcStuBirthRs=$pdoconndatastu_regina->query($RcStuBirthSql))){
												$RcStuBirthRow=$RcStuBirthRs->Fetch(PDO::FETCH_ASSOC);
													if((is_array($RcStuBirthRow) && count($RcStuBirthRow))){
														if(($RcStuBirthRow["stu_birth"]!=null)){
															$data_birth=new dateofbirthRS(date("d-m-Y",strtotime($RcStuBirthRow["stu_birth"])));
															$DataAge=$data_birth->agestr;
															$birth=$RcStuBirthRow["stu_birth"];
															$age=$data_birth->wyear;															
														}else{
															$age="-";
															$DataAge="-";
															$birth="-";															
														}
													}else{
														$age="-";
														$DataAge="-";
														$birth="-";
													}
											}else{
												$age="-";
												$DataAge="-";
												$birth="-";
											}	
									}catch(PDOException $e){
										$age="-";
										$DataAge="-";
										$birth="-";
									}
	//-------------------------------------------------------------------------	
								
								if((is_numeric($age))){
									if(($age>=0 and $age<=14)){
										$PRS_nameTH="เด็กหญิง"."&nbsp;".$DataReginaRow["rsd_name"]."&nbsp;".$DataReginaRow["rsd_surname"];									
									}elseif(($age>=15)){
										$PRS_nameTH="นางสาว"."&nbsp;".$DataReginaRow["rsd_name"]."&nbsp;".$DataReginaRow["rsd_surname"];									
									}else{
										if(($rsc_class>=3 and $rsc_class<=33)){
											$PRS_nameTH="เด็กหญิง"."&nbsp;".$DataReginaRow["rsd_name"]."&nbsp;".$DataReginaRow["rsd_surname"];
										}elseif(($rsc_class>=41 and $rsc_class<=43)){
											$PRS_nameTH="นางสาว"."&nbsp;".$DataReginaRow["rsd_name"]."&nbsp;".$DataReginaRow["rsd_surname"];
										}else{
											$PRS_nameTH=$DataReginaRow["rsd_name"]."&nbsp;".$DataReginaRow["rsd_surname"];
										}									
									}									
								}else{
									if(($rsc_class>=3 and $rsc_class<=33)){
										$PRS_nameTH="เด็กหญิง"."&nbsp;".$DataReginaRow["rsd_name"]."&nbsp;".$DataReginaRow["rsd_surname"];
									}elseif(($rsc_class>=41 and $rsc_class<=43)){
										$PRS_nameTH="นางสาว"."&nbsp;".$DataReginaRow["rsd_name"]."&nbsp;".$DataReginaRow["rsd_surname"];
									}else{
										$PRS_nameTH=$DataReginaRow["rsd_name"]."&nbsp;".$DataReginaRow["rsd_surname"];
									}										
								}
								
									$PRS_nameEH=strtolower("Miss"." ".$DataReginaRow["rsd_nameEn"]." ".$DataReginaRow["rsd_surnameEn"]);
									$PRS_nameEH=ucwords($PRS_nameEH);
									$PRS_NTH=$DataReginaRow["rsd_name"]."&nbsp;".$DataReginaRow["rsd_surname"];
									$PRS_nickTh=$DataReginaRow["nickTh"];
									$PRS_nickEn=strtolower($DataReginaRow["nickEn"]);
									$PRS_nickEn=ucwords($PRS_nickEn);
									$PRS_home=$DataReginaRow["rse_home"];
									$PRS_status=$DataReginaRow["rse_student_status"];
									$PRS_SudId=$DataReginaRow["rsd_studentid"];
									$PRS_Identification=$DataReginaRow["rsd_Identification"];
									
							}else{
								$PRS_nameTH="-";
								$PRS_nameEH="-";
								$PRS_NTH="-";
								$PRS_nickTh="-";
								$PRS_nickEn="-";
								$PRS_home="-";
								$PRS_status="-";
								$PRS_SudId="-";
								$PRS_Identification="-";
							}
					}else{
						$PRS_nameTH="-";
						$PRS_nameEH="-";
						$PRS_NTH="-";
						$PRS_nickTh="-";
						$PRS_nickEn="-";
						$PRS_home="-";
						$PRS_status="-";
						$PRS_SudId="-";
						$PRS_Identification="-";
					}
			}catch(PDOException $e){
				$PRS_nameTH="-";
				$PRS_nameEH="-";
				$PRS_NTH="-";
				$PRS_nickTh="-";
				$PRS_nickEn="-";
				$PRS_home="-";
				$PRS_status="-";
				$PRS_SudId="-";
				$PRS_Identification="-";
			}
				if((isset($age))){
					$age;
				}else{
					$age=0;
				}
			
				if((isset($birth))){
					$birth;
				}else{
					$birth="-";
				}			

				if((isset($birth))){
					$birth;
				}else{
					$birth="-";
				}

				if((isset($PRS_nameTH))){
					$PRS_nameTH;
				}else{
					$PRS_nameTH="-";
				}

			$this->age=$age;
			$this->PRS_home=$PRS_home;
			$this->birth=$birth;
			$this->DataAge=$birth;
			$this->PRS_nameTH=$PRS_nameTH;
			$this->PRS_nameEH=$PRS_nameEH;
			$this->PRS_NTH=$PRS_NTH;
			$this->PRS_nickTh=$PRS_nickTh;		
			$this->PRS_nickEn=$PRS_nickEn;
			$this->PRS_status=$PRS_status;
			$this->PRS_SudId=$PRS_SudId;	
			$this->PRS_Identification=$PRS_Identification;
			$pdodata_regina=null;
		}function __destruct(){
			$this->age;
			$this->PRS_home;
			$this->birth;
			$this->DataAge;
			$this->PRS_nameTH;
			$this->PRS_nameEH;
			$this->PRS_NTH;
			$this->PRS_nickTh;		
			$this->PRS_nickEn;
			$this->PRS_status;
			$this->PRS_SudId;
			$this->PRS_Identification;
		}	
	}

?>



<?php
	class PrintReginaStuData{//ข้อมูลนักเรียนราบบุคคลเบืองต้น
		public $studentid;
		public $PRS_studentid,$PRS_Identification,$PRS_nameTH,$PRS_nameEH,$PRS_nickTh,$PRS_nickEn,$PRS_NTH,$PRS_home,$PRS_status,$ErrorReginaStuData,$age,$birth;
		function __construct($studentid){
//-------------------------------------------------------------------------			
			$this->studentid=$studentid;
//-------------------------------------------------------------------------			
			$ErrorReginaStuData="Error";
//-------------------------------------------------------------------------			
			$regina_dataID=$_SERVER['REMOTE_ADDR'];
			$connect_data=new count_pdodata($regina_dataID);
			$pdodata_regina=$connect_data->call_pdodata();
//-------------------------------------------------------------------------	
			try{
				$PrintReginaStuDataSql="SELECT `rsd_studentid`,`rsd_Identification`, `rsd_name` ,`rsd_surname`,LOWER(`rsd_nameEn`) AS `rsd_nameEn`,LOWER(`rsd_surnameEn`) AS `rsd_surnameEn` ,`nickTh`,`nickEn`,`rse_home`,`rse_student_status` 
										FROM `regina_stu_data` 
										WHERE `rsd_studentid`='{$this->studentid}';";
					if($PrintReginaStuDataRs=$pdodata_regina->query($PrintReginaStuDataSql)){
						$PrintReginaStuDataRow=$PrintReginaStuDataRs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($PrintReginaStuDataRow) && count($PrintReginaStuDataRow)){
	//Data	Stu_birth		
	//-------------------------------------------------------------------------				
				$regina_conndatastuID=$_SERVER['REMOTE_ADDR'];
				$connect_conndatastu=new count_conndatastu($regina_conndatastuID);
				$pdoconndatastu_regina=$connect_conndatastu->call_coun_conndatastu();
	//-------------------------------------------------------------------------			
								$RcStuBirthSql="SELECT `stu_birth` FROM `data_student` WHERE `stu_id`='{$this->studentid}';";
									if($RcStuBirthRs=$pdoconndatastu_regina->query($RcStuBirthSql)){
										$RcStuBirthRow=$RcStuBirthRs->Fetch(PDO::FETCH_ASSOC);
											if(is_array($RcStuBirthRow) && count($RcStuBirthRow)){
													if((!isset($RcStuBirthRow["stu_birth"]))){
														$rc_age=0; 
													}else{
														$data_birth=new dateofbirthRS(date("d-m-Y",strtotime($RcStuBirthRow["stu_birth"])));
														$rc_age=$data_birth->wyear;
														$birth=$RcStuBirthRow["stu_birth"];
														$age=$data_birth->agestr;														
													}
											}else{
											   $rc_age=0; 
											}
									}else{
										$rc_age=0;
									}
									
								if((!isset($rc_age))){
									$rc_age=0;
								}else{}
								
	//Data	Stu_birth	End		
	//Data					
								$PRS_studentid=$PrintReginaStuDataRow["rsd_studentid"];
								$PRS_Identification=$PrintReginaStuDataRow["rsd_Identification"];
									if(($rc_age==null or $rc_age==0)){
										$ClassSql="SELECT `rsc_class` 
												   FROM `regina_stu_class` 
												   WHERE `rsd_studentid` = '{$this->studentid}' ORDER BY `rsc_year` DESC;";
										if($ClassRs=$pdoconndatastu_regina->query($ClassSql)){
										    $ClassRow=$ClassRs->Fetch(PDO::FETCH_ASSOC);
											if(is_array($ClassRow) && count($ClassRow)){
												if($ClassRow["rsc_class"]>=3 and $ClassRow["rsc_class"]<=33){
													$PRS_nameTH="เด็กหญิง"."&nbsp;".$PrintReginaStuDataRow["rsd_name"]."&nbsp;".$PrintReginaStuDataRow["rsd_surname"];
												}elseif($ClassRow["rsc_class"]>=41 and $ClassRow["rsc_class"]<=43){
													$PRS_nameTH="นางสาว"."&nbsp;".$PrintReginaStuDataRow["rsd_name"]."&nbsp;".$PrintReginaStuDataRow["rsd_surname"];
												}else{
													$PRS_nameTH=$PrintReginaStuDataRow["rsd_name"]."&nbsp;".$PrintReginaStuDataRow["rsd_surname"];
												}
											}else{
												$PRS_nameTH="-";
											}
										}else{
											$PRS_nameTH="-";		
										}
									}else{
										if($rc_age<=15){
											$PRS_nameTH="เด็กหญิง"."&nbsp;".$PrintReginaStuDataRow["rsd_name"]."&nbsp;".$PrintReginaStuDataRow["rsd_surname"];
										}else{											
											$PRS_nameTH="นางสาว"."&nbsp;".$PrintReginaStuDataRow["rsd_name"]."&nbsp;".$PrintReginaStuDataRow["rsd_surname"];
										}									
									}
								$PRS_nameEH=strtolower("Miss"."&nbsp;".$PrintReginaStuDataRow["rsd_nameEn"]."&nbsp;".$PrintReginaStuDataRow["rsd_surnameEn"]);
								$PRS_nameEH=ucfirst($PRS_nameEH);
								
								$PRS_NTH=$PrintReginaStuDataRow["rsd_name"]."&nbsp;".$PrintReginaStuDataRow["rsd_surname"];
								
								$PRS_nickTh=$PrintReginaStuDataRow["nickTh"];
								
								$PRS_nickEn=strtolower($PrintReginaStuDataRow["nickEn"]);
								$PRS_nickEn=ucfirst($PRS_nickEn);
								
								$PRS_home=$PrintReginaStuDataRow["rse_home"];
								$PRS_status=$PrintReginaStuDataRow["rse_student_status"];
								$ErrorReginaStuData="Not Error";
	//Data End					
							}else{
								$ErrorReginaStuData="Error";
							}
					}else{
						$ErrorReginaStuData="Error";
					}				
			}catch(PDOException $e){
				$ErrorReginaStuData="Error";
			}
				if($ErrorReginaStuData=="Not Error"){
					$this->PRS_studentid=$PRS_studentid;	
					$this->PRS_Identification=$PRS_Identification;	
					$this->PRS_nameTH=$PRS_nameTH;	
					$this->PRS_nameEH=$PRS_nameEH;	
					$this->PRS_nickTh=$PRS_nickTh;	
					$this->PRS_nickEn=$PRS_nickEn;
					$this->PRS_NTH=$PRS_NTH;
					$this->PRS_home=$PRS_home;	
					$this->PRS_status=$PRS_status;	
					$this->ErrorReginaStuData=$ErrorReginaStuData;
                        if(isset($birth)){
                            $this->birth=$birth;
                        }else{
                            //-----------------
                        }
                        if(isset($age)){
                            $this->age=$age;
                        }else{
                            //---------------
                        }
							$pdodata_regina=null;
							$pdoconndatastu_regina=null;
				}else{
					$this->ErrorReginaStuData=$ErrorReginaStuData;
					$pdodata_regina=null;
					$pdoconndatastu_regina=null;				
				}
		}function __destruct(){
			if(isset($this->PRS_studentid,$this->PRS_Identification,$this->PRS_nameTH,$this->PRS_nameEH,$this->PRS_nickTh,$this->PRS_nickEn,$this->PRS_home,$this->PRS_status,$this->ErrorReginaStuData)){
				$this->PRS_studentid;	
				$this->PRS_Identification;	
				$this->PRS_nameTH;	
				$this->PRS_nameEH;	
				$this->PRS_nickTh;	
				$this->PRS_nickEn;
                $this->PRS_NTH;				
				$this->PRS_home;	
				$this->PRS_status;	
				$this->ErrorReginaStuData;
			}else{}
            if(isset($this->birth)){
                $this->birth;
            }else{
                //------------------
            }
            if(isset($this->age)){
                $this->age;
            }else{
                //------------------
            }
		}
	}	
?>

<?php
	class PrintReginaYearClass{//ข้อมูลนักเรียนราบบุคคลเบืองต้นรายปี/เทอม เรียงเลขที่
		public $PRSC_year,$PRSC_term,$PRSC_class;
		public $ReginaStuClassArray;
		function __construct($PRSC_year,$PRSC_term,$PRSC_class){
//-------------------------------------------------------------------------
		$this->PRSC_year=$PRSC_year;
		$this->PRSC_term=$PRSC_term;
		$this->PRSC_class=$PRSC_class;
		//$this->PRSC_room=$PRSC_room;
//-------------------------------------------------------------------------
		$ReginaStuClassArray=array();
//-------------------------------------------------------------------------
		$regina_dataID=$_SERVER['REMOTE_ADDR'];
		$connect_data=new count_pdodata($regina_dataID);
		$pdodata_regina=$connect_data->call_pdodata();			
//-------------------------------------------------------------------------			
			try{
				$PRSC_Sql="SELECT `rsc_roomid`, `rsc_year`, `rsc_term`, `rsc_plan`, `rsc_class`, `rsc_room`, `rsc_num`
						 ,`rsc_update`, `rsd_studentid`, `rsc_status`, `rsc_txt`
						   FROM `regina_stu_class` WHERE `rsc_year`='{$this->PRSC_year}' 
						   AND `rsc_term`='{$this->PRSC_term}'
						   AND `rsc_class`='{$this->PRSC_class}'
						   ORDER BY `regina_stu_class`.`rsc_num` ASC";
					if($PRSC_Rs=$pdodata_regina->query($PRSC_Sql)){
						while($PRSC_Row=$PRSC_Rs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($PRSC_Row) && count($PRSC_Row)){
								$ReginaStuClassArray[]=$PRSC_Row;
							}else{
								$ReginaStuClassArray=null;
							}
						}
					}else{
						$ReginaStuClassArray=null;
					}				
			}catch(PDOException $e){
				$ReginaStuClassArray=null;
			}
				if(isset($ReginaStuClassArray)){
					$this->ReginaStuClassArray=$ReginaStuClassArray;
					$pdodata_regina=null;
				}else{
					$pdodata_regina=null;
				}
		}function RunReginaStuClass(){
			if(isset($this->ReginaStuClassArray)){
				return $this->ReginaStuClassArray;
			}else{
				//-------------------------
			}
		}	
	}	

?>

<?php
	class PrintReginaYear4{//ข้อมูลนักเรียนราบบุคคลเบืองต้นรายปี/เทอม เรียงเลขที่
		public $PRSC_year,$PRSC_term,$PRSC_key;
		public $ReginaStuClassArray;
		function __construct($PRSC_year,$PRSC_term,$PRSC_key){
//-------------------------------------------------------------------------
		$this->PRSC_year=$PRSC_year;
		$this->PRSC_term=$PRSC_term;
		$this->PRSC_key=$PRSC_key;
		//$this->PRSC_class=$PRSC_class;
		//$this->PRSC_room=$PRSC_room;
//-------------------------------------------------------------------------
		$ReginaStuClassArray=array();
//-------------------------------------------------------------------------
		$regina_dataID=$_SERVER['REMOTE_ADDR'];
		$connect_data=new count_pdodata($regina_dataID);
		$pdodata_regina=$connect_data->call_pdodata();			
//-------------------------------------------------------------------------			
			try{
				$PRSC_Sql="SELECT `rsc_roomid`, `rsc_year`, `rsc_term`, `rsc_plan`, `rsc_class`, `rsc_room`, `rsc_num` ,`rsc_update`, `rsd_studentid`, `rsc_status`, `rsc_txt`
						   FROM `regina_stu_class` 
						   WHERE `rsc_year`='{$this->PRSC_year}' 
						   AND `rsc_term`='{$this->PRSC_term}'
						   AND `rsd_studentid`='{$this->PRSC_key}'
						   ORDER BY `regina_stu_class`.`rsc_class` ASC";
					if($PRSC_Rs=$pdodata_regina->query($PRSC_Sql)){
						while($PRSC_Row=$PRSC_Rs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($PRSC_Row) && count($PRSC_Row)){
								$ReginaStuClassArray[]=$PRSC_Row;
							}else{
								$ReginaStuClassArray=null;
							}
						}
					}else{
						$ReginaStuClassArray=null;
					}				
			}catch(PDOException $e){
				$ReginaStuClassArray=null;
			}
				if(isset($ReginaStuClassArray)){
					$this->ReginaStuClassArray=$ReginaStuClassArray;
					$pdodata_regina=null;
				}else{
					$pdodata_regina=null;
				}
		}function RunReginaStuClass(){
			if(isset($this->ReginaStuClassArray)){
				return $this->ReginaStuClassArray;
			}else{
				//-------------------------
			}
		}	
	}	

?>


<?php
	class PrintReginaYear{//ข้อมูลนักเรียนราบบุคคลเบืองต้นรายปี/เทอม เรียงเลขที่
		public $PRSC_year,$PRSC_term;
		public $ReginaStuClassArray;
		function __construct($PRSC_year,$PRSC_term){
//-------------------------------------------------------------------------
		$this->PRSC_year=$PRSC_year;
		$this->PRSC_term=$PRSC_term;
		//$this->PRSC_class=$PRSC_class;
		//$this->PRSC_room=$PRSC_room;
//-------------------------------------------------------------------------
		$ReginaStuClassArray=array();
//-------------------------------------------------------------------------
		$regina_dataID=$_SERVER['REMOTE_ADDR'];
		$connect_data=new count_pdodata($regina_dataID);
		$pdodata_regina=$connect_data->call_pdodata();			
//-------------------------------------------------------------------------			
			try{
				$PRSC_Sql="SELECT `rsc_roomid`, `rsc_year`, `rsc_term`, `rsc_plan`, `rsc_class`, `rsc_room`, `rsc_num` ,`rsc_update`, `rsd_studentid`, `rsc_status`, `rsc_txt`
						   FROM `regina_stu_class` 
						   WHERE `rsc_year`='{$this->PRSC_year}' 
						   AND `rsc_term`='{$this->PRSC_term}'
						   ORDER BY `regina_stu_class`.`rsc_class` ASC";
					if($PRSC_Rs=$pdodata_regina->query($PRSC_Sql)){
						while($PRSC_Row=$PRSC_Rs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($PRSC_Row) && count($PRSC_Row)){
								$ReginaStuClassArray[]=$PRSC_Row;
							}else{
								$ReginaStuClassArray=null;
							}
						}
					}else{
						$ReginaStuClassArray=null;
					}				
			}catch(PDOException $e){
				$ReginaStuClassArray=null;
			}
				if(isset($ReginaStuClassArray)){
					$this->ReginaStuClassArray=$ReginaStuClassArray;
					$pdodata_regina=null;
				}else{
					$pdodata_regina=null;
				}
		}function RunReginaStuClass(){
			if(isset($this->ReginaStuClassArray)){
				return $this->ReginaStuClassArray;
			}else{
				//-------------------------
			}
		}	
	}	

?>

<?php
	class PrintReginaYearClass3{//ข้อมูลนักเรียนราบบุคคลเบืองต้นรายปี/เทอมเรียงห้อง/เรียงเลขที่
		public $PRSC_year,$PRSC_term,$PRSC_class;
		public $ReginaStuClassArray;
		function __construct($PRSC_year,$PRSC_term,$PRSC_class){
//-------------------------------------------------------------------------
		$this->PRSC_year=$PRSC_year;
		$this->PRSC_term=$PRSC_term;
		$this->PRSC_class=$PRSC_class;
		//$this->PRSC_room=$PRSC_room;
//-------------------------------------------------------------------------
		$ReginaStuClassArray=array();
//-------------------------------------------------------------------------
		$regina_dataID=$_SERVER['REMOTE_ADDR'];
		$connect_data=new count_pdodata($regina_dataID);
		$pdodata_regina=$connect_data->call_pdodata();			
//-------------------------------------------------------------------------			
			$PRSC_Sql="SELECT `rsc_roomid`, `rsc_year`, `rsc_term`, `rsc_plan`, `rsc_class`, `rsc_room`, `rsc_num`
					 ,`rsc_update`, `rsd_studentid`, `rsc_status`, `rsc_txt`
				       FROM `regina_stu_class` WHERE `rsc_year`='{$this->PRSC_year}' 
					   AND `rsc_term`='{$this->PRSC_term}'
					   AND `rsc_class`='{$this->PRSC_class}'
					   ORDER BY `regina_stu_class`.`rsc_room` ,`regina_stu_class`.`rsc_num` ASC";
				if($PRSC_Rs=$pdodata_regina->query($PRSC_Sql)){
					while($PRSC_Row=$PRSC_Rs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($PRSC_Row) && count($PRSC_Row)){
							$ReginaStuClassArray[]=$PRSC_Row;
						}else{
							$ReginaStuClassArray=null;
						}
					}
				}else{
					$ReginaStuClassArray=null;
				}
				if(isset($ReginaStuClassArray)){
					$this->ReginaStuClassArray=$ReginaStuClassArray;
					$pdodata_regina=null;
				}else{
					$pdodata_regina=null;
				}
		}function RunReginaStuClass(){
			if(isset($this->ReginaStuClassArray)){
				return $this->ReginaStuClassArray;
			}else{
				//-------------------------
			}
		}	
	}	
?>


<?php
	class PrintReginaYearClass2{//ข้อมูลนักเรียนราบบุคคลเบืองต้นรายปี/เทอมเรียงห้อง
		public $PRSC_year,$PRSC_term,$PRSC_class;
		public $ReginaStuClassArray;
		function __construct($PRSC_year,$PRSC_term,$PRSC_class){
//-------------------------------------------------------------------------
		$this->PRSC_year=$PRSC_year;
		$this->PRSC_term=$PRSC_term;
		$this->PRSC_class=$PRSC_class;
		//$this->PRSC_room=$PRSC_room;
//-------------------------------------------------------------------------
		$ReginaStuClassArray=array();
//-------------------------------------------------------------------------
		$regina_dataID=$_SERVER['REMOTE_ADDR'];
		$connect_data=new count_pdodata($regina_dataID);
		$pdodata_regina=$connect_data->call_pdodata();			
//-------------------------------------------------------------------------			
			$PRSC_Sql="SELECT `rsc_roomid`, `rsc_year`, `rsc_term`, `rsc_plan`, `rsc_class`, `rsc_room`, `rsc_num`
					 ,`rsc_update`, `rsd_studentid`, `rsc_status`, `rsc_txt`
				       FROM `regina_stu_class` WHERE `rsc_year`='{$this->PRSC_year}' 
					   AND `rsc_term`='{$this->PRSC_term}'
					   AND `rsc_class`='{$this->PRSC_class}'
					   ORDER BY `regina_stu_class`.`rsc_room` ASC";
				if($PRSC_Rs=$pdodata_regina->query($PRSC_Sql)){
					while($PRSC_Row=$PRSC_Rs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($PRSC_Row) && count($PRSC_Row)){
							$ReginaStuClassArray[]=$PRSC_Row;
						}else{
							$ReginaStuClassArray=null;
						}
					}
				}else{
					$ReginaStuClassArray=null;
				}
				if(isset($ReginaStuClassArray)){
					$this->ReginaStuClassArray=$ReginaStuClassArray;
					$pdodata_regina=null;
				}else{
					$pdodata_regina=null;
				}
		}function RunReginaStuClass(){
			if(isset($this->ReginaStuClassArray)){
				return $this->ReginaStuClassArray;
			}else{
				//-------------------------
			}
		}	
	}	

?>

<?php
	class PrintReginaStuClass{//ข้อมูลนักเรียนราบบุคคลเบืองต้นรายห้อง
		public $PRSC_year,$PRSC_term,$PRSC_class,$PRSC_room;
		public $ReginaStuClassArray;
		function __construct($PRSC_year,$PRSC_term,$PRSC_class,$PRSC_room){
//-------------------------------------------------------------------------
		$this->PRSC_year=$PRSC_year;
		$this->PRSC_term=$PRSC_term;
		$this->PRSC_class=$PRSC_class;
		$this->PRSC_room=$PRSC_room;
//-------------------------------------------------------------------------
		$ReginaStuClassArray=array();
//-------------------------------------------------------------------------
		$regina_dataID=$_SERVER['REMOTE_ADDR'];
		$connect_data=new count_pdodata($regina_dataID);
		$pdodata_regina=$connect_data->call_pdodata();			
//-------------------------------------------------------------------------			
			try{
				$PRSC_Sql="SELECT `rsc_roomid`, `rsc_year`, `rsc_term`, `rsc_plan`, `rsc_class`, `rsc_room`, `rsc_num`
						 ,`rsc_update`, `rsd_studentid`, `rsc_status`, `rsc_txt`
						   FROM `regina_stu_class` WHERE `rsc_year`='{$this->PRSC_year}' 
						   AND `rsc_term`='{$this->PRSC_term}'
						   AND `rsc_class`='{$this->PRSC_class}' 
						   AND `rsc_room`='{$this->PRSC_room}'  
						   ORDER BY `regina_stu_class`.`rsc_num` ASC";
					if($PRSC_Rs=$pdodata_regina->query($PRSC_Sql)){
						while($PRSC_Row=$PRSC_Rs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($PRSC_Row) && count($PRSC_Row)){
								$ReginaStuClassArray[]=$PRSC_Row;
							}else{
								$ReginaStuClassArray=null;
							}
						}
					}else{
						$ReginaStuClassArray=null;
					}				
			}catch(PDOException $e){
				$ReginaStuClassArray=null;
			}
				if(isset($ReginaStuClassArray)){
					$this->ReginaStuClassArray=$ReginaStuClassArray;
					$pdodata_regina=null;
				}else{
					$pdodata_regina=null;
				}
		}function RunReginaStuClass(){
			if(isset($this->ReginaStuClassArray)){
				return $this->ReginaStuClassArray;
			}else{
				//-------------------------
			}
		}	
	}
?>

<?php
	class LoadStuNew{//โหลดข้อมูลนักเรียนใหม่เข้าสู่ระบบ
		public $LSN_yaer;
		public $Count_StuNew,$Count_StuType,$Count_Save,$count_NotSave;
		function __construct($LSN_yaer){
//--------------------------------------
		$this->LSN_yaer=$LSN_yaer;
//-----------------------------------------------------------------------
		$Count_StuNew=0;
		$Count_StuType=0;
		$Count_Save=0;
		$Count_NotSave=0;
		$DateTime=date("Y-m-d H:i:s");
//-----------------------------------------------------------------------	
		$regina_AdmissionID=$_SERVER['REMOTE_ADDR'];
		$connect_Admission=new connect_Admission($regina_AdmissionID);
		$pdoAdmission_regina=$connect_Admission->call_RunConnAdmission();		
//-----------------------------------------------------------------------
		$regina_dataID=$_SERVER['REMOTE_ADDR'];
		$connect_data=new count_pdodata($regina_dataID);
		$pdodata_regina=$connect_data->call_pdodata();
//-----------------------------------------------------------------------
			try{
				$ReginaClassSql="SELECT `rc_IDstu`, `rc_yaer`, `rc_level`, `rc_type`, `rc_save` ,`rc_sturc`
								 FROM `regina_class` WHERE  `rc_yaer`='{$this->LSN_yaer}';";
					if($ReginaClassRs=$pdoAdmission_regina->query($ReginaClassSql)){
	//-------------------------------------------------------------------------
	//-------------------------------------------------------------------------
	//Delete regina_stu_new 		
						try{
							$DeleteReginaStunewSql="DELETE FROM `regina_stu_new` WHERE `rsn_year`='{$this->LSN_yaer}'";
							$pdodata_regina->exec($DeleteReginaStunewSql);
						}catch(PDOException $e){
							//--------------------------------------------------------
						}
	//Delete regina_stu_new end						
	//-------------------------------------------------------------------------					
	//-------------------------------------------------------------------------					
						while($ReginaClassRow=$ReginaClassRs->Fetch(PDO::FETCH_ASSOC)){					
							$ReginaStuClassSql="SELECT COUNT(`rsd_studentid`) AS `Int_student`
												FROM `regina_stu_class` 
												WHERE `rsd_studentid`='{$ReginaClassRow['rc_IDstu']}' 
												AND `rsc_year`='{$this->LSN_yaer}'";
								if($ReginaStuClassRs=$pdodata_regina->query($ReginaStuClassSql)){
									$ReginaStuClassRow=$ReginaStuClassRs->Fetch(PDO::FETCH_ASSOC);
										if(is_array($ReginaStuClassRow) && count($ReginaStuClassRow)){
											$Int_student=$ReginaStuClassRow['Int_student'];
											if($Int_student>=1){
	//-------------------------------------------------------------------------------------------------	
												if($ReginaClassRow["rc_sturc"]=="1"){
													try{
														$AddReginaStuNewSql="INSERT INTO `regina_stu_new`(`rsn_id`, `rsn_year`, `rsn_level`, `rsn_stu`, `rsn_datatime`) 
																			 VALUES ('{$ReginaClassRow['rc_IDstu']}','{$ReginaClassRow['rc_yaer']}','{$ReginaClassRow['rc_level']}','rc','{$DateTime}')";	
														$pdodata_regina->exec($AddReginaStuNewSql);
														$Count_Save=$Count_Save+1;
													}catch(PDOException $e){
														$Count_NotSave=$Count_NotSave+1;
													}												
												}elseif($ReginaClassRow["rc_sturc"]=="0" or $ReginaClassRow["rc_sturc"]==null){
													try{
														$AddReginaStuNewSql="INSERT INTO `regina_stu_new`(`rsn_id`, `rsn_year`, `rsn_level`, `rsn_stu`, `rsn_datatime`) 
																			 VALUES ('{$ReginaClassRow['rc_IDstu']}','{$ReginaClassRow['rc_yaer']}','{$ReginaClassRow['rc_level']}','new','{$DateTime}')";	
														$pdodata_regina->exec($AddReginaStuNewSql);
														$Count_Save=$Count_Save+1;
													}catch(PDOException $e){
														$Count_NotSave=$Count_NotSave+1;
													}												
													
												}else{
													//----------------------------------------
												}
	//-------------------------------------------------------------------------------------------------											
											}else{
												$Count_NotSave=$Count_NotSave+1;
											}
										}else{
											//--
										}
								}else{
									//--
								}
							$Count_StuNew=$Count_StuNew+1;
						}
					}else{
						//--
					}				
			}catch(PDOException $e){
				//--
			}
			$this->Count_StuNew=$Count_StuNew;
			$this->Count_StuType=$Count_StuType;
			$this->Count_Save=$Count_Save;
			$this->Count_NotSave=$Count_NotSave;
			$pdoAdmission_regina=null;
			$pdodata_regina=null;
		}function __destruct(){
			$this->Count_StuNew;
			$this->Count_StuType;
			$this->Count_Save;
			$this->Count_NotSave;
		}
	}
?>



<?php
	class CopyReginaStuClass{//Copy Regina_Stu_Class คัดลอกนักเรียนเลือนภาคเรียน
		public $CRSC_TA,$CRSC_YA,$CRSC_TB,$CRSC_YB;
		public $Count_Sum,$Count_Copy;
		function __construct($CRSC_TA,$CRSC_YA,$CRSC_TB,$CRSC_YB){
//----------------------------------------------------------------
		$this->CRSC_TA=$CRSC_TA;
		$this->CRSC_YA=$CRSC_YA;
		$this->CRSC_TB=$CRSC_TB;
		$this->CRSC_YB=$CRSC_YB;
//----------------------------------------------------------------
		$Count_Sum=0;
		$Count_Copy=0;
		$DateTime=date("Y-m-d H:i:s");			
//----------------------------------------------------------------	
		$regina_dataID=$_SERVER['REMOTE_ADDR'];
		$connect_data=new count_pdodata($regina_dataID);
		$pdodata_regina=$connect_data->call_pdodata();		
//----------------------------------------------------------------	
			try{
				$CRSC_Sql="SELECT COUNT(`rsc_roomid`) AS `count_rsc` 
						   FROM `regina_stu_class` 
						   WHERE `rsc_year`='{$this->CRSC_YA}' AND `rsc_term`='{$this->CRSC_TA}'";
					if($CRSC_Rs=$pdodata_regina->query($CRSC_Sql)){
						$CRSC_Row=$CRSC_Rs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($CRSC_Row) && count($CRSC_Row)){
								$Count_Sum=$CRSC_Row["count_rsc"];
							}else{
								$Count_Sum=0;
							}
							if($Count_Sum>=1){
	//----------------------------------------------------------------
	//Delete: regina_stu_class
								try{
									$DRSC_Sql="DELETE FROM `regina_stu_class` 
											   WHERE `rsc_year`='{$this->CRSC_YB}' AND `rsc_term`='{$this->CRSC_TB}'";
									$pdodata_regina->exec($DRSC_Sql);
								}catch(PDOException $e){
									//--------------------------------------------------------------------------------
								}
	//Delete: regina_stu_class End				
	//----------------------------------------------------------------						
								$ReginaStuClassSql="SELECT  `rsc_roomid`, `rsc_year`, `rsc_term`, `rsc_plan`, `rsc_class`, `rsc_room`, `rsc_num`, `rsc_update`, `rsd_studentid`, `rsc_status`, `rsc_txt` 
													FROM `regina_stu_class` 
													WHERE `rsc_year`='{$this->CRSC_YA}' AND `rsc_term`='{$this->CRSC_TA}'";
									if($ReginaStuClassRs=$pdodata_regina->query($ReginaStuClassSql)){
										while($ReginaStuClassRow=$ReginaStuClassRs->Fetch(PDO::FETCH_ASSOC)){
											if(is_array($ReginaStuClassRow) && count($ReginaStuClassRow)){
												$rsc_roomid=$ReginaStuClassRow["rsd_studentid"]."0".$this->CRSC_TB.$ReginaStuClassRow["rsc_class"];
	//Add: 	regina_stu_class										
													try{
														$ARSC_Sql="INSERT INTO `regina_stu_class`(`rsc_roomid`, `rsc_year`, `rsc_term`, `rsc_plan`, `rsc_class`, `rsc_room`, `rsc_num`, `rsc_update`, `rsd_studentid`, `rsc_status`, `rsc_txt`) 
																   VALUES ('{$rsc_roomid}','{$this->CRSC_YB}','{$this->CRSC_TB}','{$ReginaStuClassRow['rsc_plan']}','{$ReginaStuClassRow['rsc_class']}','{$ReginaStuClassRow['rsc_room']}','{$ReginaStuClassRow['rsc_num']}','{$DateTime}','{$ReginaStuClassRow['rsd_studentid']}','{$ReginaStuClassRow['rsc_status']}','{$ReginaStuClassRow['rsc_txt']}')";
														$pdodata_regina->exec($ARSC_Sql);
														$Count_Copy=$Count_Copy+1;
													}catch(PDOException $e){
														//-------------------------------
													}
	//Add: 	regina_stu_class End			
											}else{
												$Count_Sum=0;
												$Count_Copy=0;
											}
										}
									}else{
										$Count_Sum=0;
										$Count_Copy=0;
									}
	//----------------------------------------------------------------							
							}else{
								$Count_Sum=0;
								$Count_Copy=0;
							}
					}else{
						$Count_Sum=0;
						$Count_Copy=0;
					}				
			}catch(PDOException $e){
				$Count_Sum=0;
				$Count_Copy=0;				
			}
			$this->Count_Sum=$Count_Sum;
			$this->Count_Copy=$Count_Copy;
			$pdodata_regina=null;
		}function __destruct(){
			$this->Count_Sum;
			$this->Count_Copy;
		}
	}
?>


<?php
	class Prove_A_PersonRc{
		public $PAP_Key;
		public $NameTh,$NameEn,$NameNicTh,$NameNicEn,$SudKeyId;
		function __construct($PAP_Key){
			$this->PAP_Key=$PAP_Key;
//----------------------------------------------------------------								
			$regina_dataID=$_SERVER['REMOTE_ADDR'];
			$connect_data=new count_pdodata($regina_dataID);
			$pdodata_regina=$connect_data->call_pdodata();
//----------------------------------------------------------------	
			try{
				$ProveAPersonRcSql="SELECT `rsd_studentid`,`rsd_prefix`,`rsd_name`,`rsd_surname`,`rsd_nameEn`,`rsd_surnameEn`,`nickTh`,`nickEn` 
									FROM `regina_stu_data` WHERE `rsd_studentid`='{$this->PAP_Key}'; ";
					if($ProveAPersonRc=$pdodata_regina->query($ProveAPersonRcSql)){
						$ProveAPerSonRcRow=$ProveAPersonRc->Fetch(PDO::FETCH_ASSOC);
							if(is_array($ProveAPerSonRcRow) && count($ProveAPerSonRcRow)){
//-----------------------------------------------------------------------------------------------------------------------------								
								try{
									$PrintClassSql="SELECT `rsc_class` 
												    FROM `regina_stu_class` 
												    WHERE `rsd_studentid` = '{$this->PAP_Key}' 
													ORDER BY `rsc_class` DESC;";
										if($PrintClassRs=$pdodata_regina->query($PrintClassSql)){
											$PrintClassRow=$PrintClassRs->Fetch(PDO::FETCH_ASSOC);
											if(is_array($PrintClassRow) && count($PrintClassRow)){
												$IntClass=$PrintClassRow["rsc_class"];
											}else{
												$IntClass=0;
											}
										}else{
											$IntClass=0;
										}
								}catch(PDOException $PAP){
									$IntClass=0;
								}
//-----------------------------------------------------------------------------------------------------------------------------								
								if($IntClass>=41){
									$NameTh="นางสาว&nbsp;".$ProveAPerSonRcRow["rsd_name"]."&nbsp;".$ProveAPerSonRcRow["rsd_surname"];
									
									$NameEn=strtolower("Miss&nbsp;".$ProveAPerSonRcRow["rsd_nameEn"]."&nbsp;".$ProveAPerSonRcRow["rsd_surnameEn"]);
									$NameEn==ucfirst($NameEn);
									
									$NameNicTh=$ProveAPerSonRcRow["nickTh"];
									
									$NameNicEn=strtolower($ProveAPerSonRcRow["nickEn"]);
									$NameNicEn=ucfirst($NameNicEn);
									
									$SudKeyId=$ProveAPerSonRcRow["rsd_studentid"];
								}else{
									$NameTh="เด็กหญิง&nbsp;".$ProveAPerSonRcRow["rsd_name"]."&nbsp;".$ProveAPerSonRcRow["rsd_surname"];
									
									$NameEn=strtolower("Miss&nbsp;".$ProveAPerSonRcRow["rsd_nameEn"]."&nbsp;".$ProveAPerSonRcRow["rsd_surnameEn"]);
									$NameEn=ucfirst($NameEn);
									
									$NameNicTh=$ProveAPerSonRcRow["nickTh"];
									
									$NameNicEn=strtolower($ProveAPerSonRcRow["nickEn"]);	
									$NameNicEn=ucfirst($NameNicEn);
									
									$SudKeyId=$ProveAPerSonRcRow["rsd_studentid"];
								}
							}else{
								$NameTh=null;
								$NameEn=null;
								$NameNicTh=null;
								$NameNicEn=null;	
								$SudKeyId=null;									
							}
					}else{
					    $NameTh=null;
						$NameEn=null;
						$NameNicTh=null;
						$NameNicEn=null;
						$SudKeyId=null;
					}
			}catch(PDOException $PAP){
				$NameTh=null;
				$NameEn=null;
				$NameNicTh=null;
				$NameNicEn=null;	
				$SudKeyId=null;				
			}
			
			if(isset($NameTh)){
				$this->NameTh=$NameTh;
				$this->NameEn=$NameEn;
				$this->NameNicTh=$NameNicTh;
				$this->NameNicEn=$NameNicEn;
				$this->SudKeyId=$SudKeyId;
				$pdodata_regina=null;
			}else{
				$pdodata_regina=null;
			}		
			
		}function __destruct(){
			if(isset($this->NameTh)){
				$this->NameTh;
				$this->NameEn;
				$this->NameNicTh;
				$this->NameNicEn;
				$this->SudKeyId;
			}else{}
		}
	}
?>



<?php
	class CopyStudentYear{
		public $CSY_Year;
		public $CountAll,$CountCopy,$CountY,$CountN;
		function __construct($CSY_Year){
//----------------------------------------------------------------
			$this->CSY_Year=$CSY_Year;
//----------------------------------------------------------------
			$New_Year=$this->CSY_Year+1;
			$Term=2;
			$Term_new=1;
			$rsc_update=date("Y-m-d H:i:s");
//----------------------------------------------------------------								
			$regina_dataID=$_SERVER['REMOTE_ADDR'];
			$connect_data=new count_pdodata($regina_dataID);
			$pdodata_regina=$connect_data->call_pdodata();
//----------------------------------------------------------------	
			$CountAll=0;
			$CountCopy=0;
			$CountY=0;
			$CountN=0;
//----------------------------------------------------------------
//----------------------------------------------------------------	
			try{
				$DeleteStudentYearSql="DELETE FROM `regina_stu_class` WHERE `rsc_year`='{$New_Year}' AND `rsc_term`='{$Term_new}'";
				$pdodata_regina->exec($DeleteStudentYearSql);
			}catch(PDOException $e){
				//------------------------
			}
//----------------------------------------------------------------	
//----------------------------------------------------------------	
			try{
				$ReginaStuClassSql="SELECT * FROM `regina_stu_class` 
									WHERE `rsc_year` ='{$this->CSY_Year}' AND `rsc_term` = '{$Term}'";
					if($ReginaStuClassRs=$pdodata_regina->query($ReginaStuClassSql)){
						while($ReginaStuClassRow=$ReginaStuClassRs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($ReginaStuClassRow) && count($ReginaStuClassRow)){
								$CountAll=$CountAll+1;
	//----------------------------------------------------------------							
								$copy_rsc_class=$ReginaStuClassRow["rsc_class"];
	//----------------------------------------------------------------							
								$copy_class_new=$copy_rsc_class+1;
	//----------------------------------------------------------------							
								$copy_rsc_plan=$ReginaStuClassRow["rsc_plan"];
								$copy_rsc_room=$ReginaStuClassRow["rsc_room"];
								$copy_rsc_num=$ReginaStuClassRow["rsc_num"];
								$copy_rsd_studentid=$ReginaStuClassRow["rsd_studentid"];
								$copy_rsc_status=$ReginaStuClassRow["rsc_status"];
								$copy_rsc_txt=$ReginaStuClassRow["rsc_txt"];
	//----------------------------------------------------------------
									if($copy_rsc_class==3){
										$into_rsc_roomid=$copy_rsd_studentid."0".$Term_new."11";
										$into_rsc_year=$New_Year;
										$into_rsc_term=$Term_new;
										$into_rsc_plan="1";
										$intorsc_class="11";
										$intorsc_room=$copy_rsc_room;
										$intorsc_num=$copy_rsc_num;
										$into_rsc_update=$rsc_update;
										$into_rsd_studentid=$copy_rsd_studentid;
										$into_rsc_status=$copy_rsc_status;
										$into_rsc_txt=$copy_rsc_txt;
										$CountCopy=$CountCopy+1;
									}elseif($copy_rsc_class==13){
										$into_rsc_roomid=$copy_rsd_studentid."0".$Term_new."21";
										$into_rsc_year=$New_Year;
										$into_rsc_term=$Term_new;
										$into_rsc_plan="1";
										$intorsc_class="21";
										$intorsc_room=$copy_rsc_room;
										$intorsc_num=$copy_rsc_num;
										$into_rsc_update=$rsc_update;
										$into_rsd_studentid=$copy_rsd_studentid;
										$into_rsc_status=$copy_rsc_status;
										$into_rsc_txt=$copy_rsc_txt;
										$CountCopy=$CountCopy+1;									
									}elseif($copy_rsc_class==23){
										$into_rsc_roomid=$copy_rsd_studentid."0".$Term_new."31";
										$into_rsc_year=$New_Year;
										$into_rsc_term=$Term_new;
										$into_rsc_plan="2";
										$intorsc_class="31";
										$intorsc_room=$copy_rsc_room;
										$intorsc_num=$copy_rsc_num;
										$into_rsc_update=$rsc_update;
										$into_rsd_studentid=$copy_rsd_studentid;
										$into_rsc_status=$copy_rsc_status;
										$into_rsc_txt=$copy_rsc_txt;
										$CountCopy=$CountCopy+1;
									}elseif($copy_rsc_class==33){
										$into_rsc_roomid=$copy_rsd_studentid."0".$Term_new."41";
										$into_rsc_year=$New_Year;
										$into_rsc_term=$Term_new;
										$into_rsc_plan="14";
										$intorsc_class="41";
										$intorsc_room=$copy_rsc_room;
										$intorsc_num=$copy_rsc_num;
										$into_rsc_update=$rsc_update;
										$into_rsd_studentid=$copy_rsd_studentid;
										$into_rsc_status=$copy_rsc_status;
										$into_rsc_txt=$copy_rsc_txt;
										$CountCopy=$CountCopy+1;
									}elseif($copy_rsc_class==43){
										$into_rsc_roomid=null;
										$into_rsc_year=null;
										$into_rsc_term=null;
										$into_rsc_plan=null;
										$intorsc_class=null;
										$intorsc_room=null;
										$intorsc_num=null;
										$into_rsc_update=null;
										$into_rsd_studentid=null;
										$into_rsc_status=null;
										$into_rsc_txt=null;
										$CountCopy=$CountCopy+0;
									}else{
										$into_rsc_roomid=$copy_rsd_studentid."0".$Term_new.$copy_class_new;
										$into_rsc_year=$New_Year;
										$into_rsc_term=$Term_new;
										$into_rsc_plan=$copy_rsc_plan;
										$intorsc_class=$copy_class_new;
										$intorsc_room=$copy_rsc_room;
										$intorsc_num=$copy_rsc_num;
										$into_rsc_update=$rsc_update;
										$into_rsd_studentid=$copy_rsd_studentid;
										$into_rsc_status=$copy_rsc_status;
										$into_rsc_txt=$copy_rsc_txt;
										$CountCopy=$CountCopy+1;									
									}
	//----------------------------------------------------------------									
	//----------------------------------------------------------------								
									if(isset($into_rsc_roomid)){
	//----------------------------------------------------------------
										try{
											$IntoStudentYearSql="INSERT INTO `regina_stu_class`(`rsc_roomid`, `rsc_year`, `rsc_term`, `rsc_plan`, `rsc_class`, `rsc_room`, `rsc_num`, `rsc_update`, `rsd_studentid`, `rsc_status`, `rsc_txt`) 
																 VALUES ('{$into_rsc_roomid}','{$into_rsc_year}','{$into_rsc_term}','{$into_rsc_plan}','{$intorsc_class}','{$intorsc_room}','{$intorsc_num}','{$into_rsc_update}','{$into_rsd_studentid}','{$into_rsc_status}','{$into_rsc_txt}')";
											$pdodata_regina->exec($IntoStudentYearSql);
											$CountY=$CountY+1;
										}catch(PDOException $e){
											$CountN=$CountN+1;
										}
	//----------------------------------------------------------------										
									}else{		
										$CountN=$CountN+1;
									}
	//----------------------------------------------------------------									
	//----------------------------------------------------------------								
									
							}else{
								$into_rsc_roomid=null;
								$into_rsc_year=null;
								$into_rsc_term=null;
								$into_rsc_plan=null;
								$intorsc_class=null;
								$intorsc_room=null;
								$intorsc_num=null;
								$into_rsc_update=null;
								$into_rsd_studentid=null;
								$into_rsc_status=null;
								$into_rsc_txt=null;	
								$CountCopy=$CountCopy+0;
							}
							
						}
					}else{
						$into_rsc_roomid=null;
						$into_rsc_year=null;
						$into_rsc_term=null;
						$into_rsc_plan=null;
						$intorsc_class=null;
						$intorsc_room=null;
						$intorsc_num=null;
						$into_rsc_update=null;
						$into_rsd_studentid=null;
						$into_rsc_status=null;
						$into_rsc_txt=null;
						$CountCopy=$CountCopy+0;
					}				
			}catch(PDOException $e){
				$into_rsc_roomid=null;
				$into_rsc_year=null;
				$into_rsc_term=null;
				$into_rsc_plan=null;
				$intorsc_class=null;
				$intorsc_room=null;
				$intorsc_num=null;
				$into_rsc_update=null;
				$into_rsd_studentid=null;
				$into_rsc_status=null;
				$into_rsc_txt=null;
				$CountCopy=$CountCopy+0;				
			}

				if(isset($CountAll,$CountCopy,$CountY,$CountN)){
					$this->CountAll=$CountAll;
					$this->CountCopy=$CountCopy;
					$this->CountY=$CountY;
					$this->CountN=$CountN;
					$pdodata_regina=null;
				}else{
					$pdodata_regina=null;
				}

		}function __destruct(){
			if(isset($this->CountAll,$this->CountCopy,$this->CountY,$this->CountN)){
				$this->CountAll;
				$this->CountCopy;
				$this->CountY;
				$this->CountN;
			}else{}
		}
	}
?>



