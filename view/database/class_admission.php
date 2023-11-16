<?php
	include("pdo_data.php");
	include("pdo_swiprc.php");
	include("pdo_conndatastu.php");
	include("pdo_admission.php");
?>



<?php
	class PrintSudNewAdmission{
		public $PSNAR_Year,$PSNAR_Class,$PSNAR_Type;
		function __construct($PSNAR_Year,$PSNAR_Class,$PSNAR_Type){
			$this->PSNAR_Year=$PSNAR_Year;
			$this->PSNAR_Class=$PSNAR_Class;
			$this->PSNAR_Type=$PSNAR_Type;
			
		}
	}


?>




<?php
	class delete_login{
		public $LoginYear;
		function __construct($LoginYear){
			$this->LoginYear=$LoginYear;
			$IdAdder_Student=$_SERVER["REMOTE_ADDR"];//--------------------------------------
			$connect_student=new count_pdodata($IdAdder_Student);//--------------------------
			$pdo_student=$connect_student->call_pdodata();//---------------------------------
//----------------------------------------------------------------			
			$y=substr($this->LoginYear,2,2);			
			$rsl_user="login".$y;
//----------------------------------------------------------------			
				$DeleteLoginSql="DELETE FROM `regina_stu_login` 
								 WHERE `rsl_user` LIKE '%{$rsl_user}%'";
				if($pdo_student->exec($DeleteLoginSql)>0){
					$RunDeleteLoging="Yes";
				}else{
					$RunDeleteLoging="No";
				}
//------------------------------------------------------------------				
				if(isset($RunDeleteLoging)){
					$this->RunDeleteLoging=$RunDeleteLoging;
				}else{
					//----------------------------------------
				}
//------------------------------------------------------------------	
				unset($pdo_student);	
		}function DeleteLoging(){
			if(isset($this->RunDeleteLoging)){
				return $this->RunDeleteLoging;
			}else{
				//---------------------------------------------------
			}
		}
	}
?>

<?php
	class SudRcAdmission{
		public $admission_year;
		function __construct($admission_year){
			$this->admission_year=$admission_year;
//------------------------------------------------------------------
			$IdAdder=$_SERVER["REMOTE_ADDR"];
			$connect_admission=new connect_Admission($IdAdder);
			$pdo_admission=$connect_admission->call_RunConnAdmission();
//------------------------------------------------------------------			
			$admission_array=array();
			try{
				$admissionSql="SELECT `rc_IDReg`,`rc_IDCard`,`rc_IDstu` 
						       FROM `regina_class` 
						       WHERE `rc_yaer`='{$this->admission_year}' AND `rc_type`!='rc';";
					if($admissionRs=$pdo_admission->query($admissionSql)){
						while($admissionRow=$admissionRs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($admissionRow) && count($admissionRow)){
								$admission_array[]=$admissionRow;
							}else{
								$admission_array=null;
							}
						}						
					}else{
						$admission_array=null;
					}		   
			}catch(PDOException $sa){
				$admission_array=null;
			}
			
			if(isset($admission_array)){
				$this->admission_array=$admission_array;
				unset($pdo_admission);
			}else{
				unset($pdo_admission);
			}
			
		}function RunDataAdmission(){
			if(isset($this->admission_array)){
				return $this->admission_array;
			}else{
				//------------------------------------------
			}			
		}
	}

?>





<?php
	class UpInt_DataLogin{
		public $UL_IDReg,$UL_IDCard,$UL_IDstu,$UL_Year;
		function __construct($UL_IDReg,$UL_IDCard,$UL_IDstu,$UL_Year){
//---------------------------------------------------------------------------------------------------------------------			
			$this->UL_IDReg=$UL_IDReg;
			$this->UL_IDCard=$UL_IDCard;
			$this->UL_IDstu=$UL_IDstu;
			$this->UL_Year=$UL_Year;
			//$Count_ReginaStuData=0;
			//$Count_ReginaStuLogin=0;
			$y=substr($this->UL_Year,2,2);
			$CopyYear="login".$y;
			
			$Date_UpInt=date("Y-m-d H:i:s");
//pdo_admission------------------------------------------------------------------------------		
			$IdAdder_Admission=$_SERVER["REMOTE_ADDR"];//------------------------------------
			$connect_admission=new connect_Admission($IdAdder_Admission);//------------------
			$pdo_admission=$connect_admission->call_RunConnAdmission();//--------------------
//pdo_admission End--------------------------------------------------------------------------
//pdo_data-----------------------------------------------------------------------------------
			$IdAdder_Student=$_SERVER["REMOTE_ADDR"];//--------------------------------------
			$connect_student=new count_pdodata($IdAdder_Student);//--------------------------
			$pdo_student=$connect_student->call_pdodata();//---------------------------------
//pdo_dat End--------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------
//pdo_swiprc-----------------------------------------------------------------------------------------------------------
			$IdAdder_swiprc=$_SERVER["REMOTE_ADDR"];//-----------------------------------------------------------------
			$connect_swiprc=new connect_swiprc($IdAdder_swiprc);//-----------------------------------------------------
			$pdo_swiprc=$connect_swiprc->call_RunConnSwiprc();//-------------------------------------------------------
//pdo_swiprc End-------------------------------------------------------------------------------------------------------
//pdo_conndatastu------------------------------------------------------------------------------------------------------
			$IdAdder_conndatastu=$_SERVER["REMOTE_ADDR"];//------------------------------------------------------------
			$connect_conndatastu=new count_conndatastu($IdAdder_conndatastu);//----------------------------------------
			$pdo_conndatastu=$connect_conndatastu->call_coun_conndatastu();//------------------------------------------
//pdo_conndatastu End--------------------------------------------------------------------------------------------------			
//---------------------------------------------------------------------------------------------------------------------			
			try{
				$print_stu_loginSql="SELECT COUNT(`rsl_user`) AS `RU` FROM `regina_stu_login`
							         WHERE `rsl_user` LIKE '%{$CopyYear}%'  
							         ORDER BY `regina_stu_login`.`rsl_user` DESC";				
				if($print_stu_loginRs=$pdo_student->query($print_stu_loginSql)){
					  $print_stu_loginRow=$print_stu_loginRs->Fetch(PDO::FETCH_ASSOC);
					  if(is_array($print_stu_loginRow) && count($print_stu_loginRow)){
							$rsl_user=$print_stu_loginRow["RU"];
							$rsl_user=$rsl_user+1;
							$TxtIntRslUser=$CopyYear.$rsl_user;		 				  
					  }else{
							$rsl_user=$print_stu_loginRow["RU"];
							$TxtIntRslUser=$CopyYear."1";
					  }
				 }else{
					$rsl_user=Null;
					$TxtIntRslUser=null;
				 }									 					 
			}catch(PDOException $pls){
				$rsl_user=Null;
				$TxtIntRslUser=null;				
			}
//---------------------------------------------------------------------------------------------------------------------		
			try{
				$ReginaStuLoginSql="SELECT COUNT(`rsl_user`) AS `ini_user` FROM `regina_stu_login` 
									WHERE `rsd_studentid`='{$this->UL_IDstu}'";
				if($ReginaStuLoginRs=$pdo_student->query($ReginaStuLoginSql)){
				   $ReginaStuLoginRow=$ReginaStuLoginRs->Fetch(PDO::FETCH_ASSOC);
				   if(is_array($ReginaStuLoginRow) && count($ReginaStuLoginRow)){
					   $ini_user=$ReginaStuLoginRow["ini_user"];
					   if($ini_user>=1){
	//-----------------------------------------------------------------------------------------------------------------	
						   $DeleteReginaStuLoginSql="DELETE FROM `regina_stu_login` WHERE `rsd_studentid`='{$this->UL_IDstu}'";
								if($pdo_student->exec($DeleteReginaStuLoginSql)>0){
									//--------------------------------------------
								}else{
									//--------------------------------------------
								}
						   //unset($pdo_student);				   
	//-----------------------------------------------------------------------------------------------------------------						   
						   $InToStuLoginSql="INSERT INTO `regina_stu_login`(`rsl_user`, `rsl_status`, `rsl_login`, `rsl_update`, `rsd_studentid`, `model1`) 
											 VALUES ('{$TxtIntRslUser}','1','0','{$Date_UpInt}','{$this->UL_IDstu}','navbar navbar-default header-highlight')";
							   if($pdo_student->exec($InToStuLoginSql)>0){
								   $Count_ReginaStuLogin=1;
							   }else{
								   $Count_ReginaStuLogin=0;
							   }
						   //unset($pdo_student);		
	//-----------------------------------------------------------------------------------------------------------------	  
							//echo $this->UL_IDstu."/".$TxtIntRslUser."<br>";
					   }else{
	//-----------------------------------------------------------------------------------------------------------------	
						   $DeleteReginaStuLoginSql="DELETE FROM `regina_stu_login` WHERE `rsd_studentid`='{$this->UL_IDstu}'";
								if($pdo_student->exec($DeleteReginaStuLoginSql)>0){
									//--------------------------------------------
								}else{
									//--------------------------------------------
								}
						   //unset($pdo_student);				   
	//-----------------------------------------------------------------------------------------------------------------					   
						   $InToStuLoginSql="INSERT INTO `regina_stu_login`(`rsl_user`, `rsl_status`, `rsl_login`, `rsl_update`, `rsd_studentid`, `model1`) 
											 VALUES ('{$TxtIntRslUser}','1','0','{$Date_UpInt}','{$this->UL_IDstu}','navbar navbar-default header-highlight')";
							   if($pdo_student->exec($InToStuLoginSql)>0){
								   $Count_ReginaStuLogin=1;
							   }else{
								   $Count_ReginaStuLogin=0;
							   }
						  //unset($pdo_student);		
	//-----------------------------------------------------------------------------------------------------------------					  
					   }
				   }else{
					   $ini_user=0;
				   }
				}else{
					$ini_user=0;
				}
			}catch(PDOException $rrls){
				$ini_user=0;
			}
//---------------------------------------------------------------------------------------------------------------------			
			
			try{
				$CountTestInsertSql="SELECT `IDReg`,`IDCard`,`stu_prefix`,`stu_fname`,`stu_sname`,`stu_fname_e`,`stu_sname_e`,`stu_birth`,`stu_blood`,`IDReligion` 
								     FROM `insert_student_admission` 
								     WHERE `IDReg`='{$this->UL_IDReg}' 
								     and   `IDCard`='{$this->UL_IDCard}'";
				if($CountTestInsertRs=$pdo_admission->query($CountTestInsertSql)){
					$CountTestInsertRow=$CountTestInsertRs->Fetch(PDO::FETCH_ASSOC);
					if(is_array($CountTestInsertRow) && count($CountTestInsertRow)){
						$TxtInsert="Y";
						$IDReg=$CountTestInsertRow["IDReg"];
						$IDCard=$CountTestInsertRow["IDCard"];
						$stu_prefix=$CountTestInsertRow["stu_prefix"];
						$stu_fname=$CountTestInsertRow["stu_fname"];
						$stu_sname=$CountTestInsertRow["stu_sname"];
						$stu_fname_e=$CountTestInsertRow["stu_fname_e"];
						$stu_sname_e=$CountTestInsertRow["stu_sname_e"];
						$nickTh=null;
						$nickEn=null;
						$stu_birth=$CountTestInsertRow["stu_birth"];
						$stu_birth=date("d-m-Y",strtotime($stu_birth));
	//--------------------------------------------------------------------					
						$stu_blood=strtoupper($CountTestInsertRow["stu_blood"]);
						$IDReligion=$CountTestInsertRow["IDReligion"];						
					}else{
						$TxtInsert="N";
						$IDReg=null;
						$IDCard=null;
						$stu_prefix=null;
						$stu_fname=null;
						$stu_sname=null;
						$stu_fname_e=null;
						$stu_sname_e=null;
						$nickTh=null;
						$nickEn=null;
						$stu_birth=null;
//--------------------------------------------------------------------					
						$stu_blood=null;
						$IDReligion=null;
//---------------------------------------------------------------------						
					}
				}else{
					$TxtInsert="N";
					$IDReg=null;
					$IDCard=null;
					$stu_prefix=null;
					$stu_fname=null;
					$stu_sname=null;
					$stu_fname_e=null;
					$stu_sname_e=null;
					$nickTh=null;
					$nickEn=null;
					$stu_birth=null;
//--------------------------------------------------------------------					
					$stu_blood=null;
					$IDReligion=null;
//---------------------------------------------------------------------					
				}
			}catch(PDOException $un){
				$TxtInsert="N";
				$IDReg=null;
				$IDCard=null;
				$stu_prefix=null;
				$stu_fname=null;
				$stu_sname=null;
				$stu_fname_e=null;
				$stu_sname_e=null;
				$nickTh=null;
				$nickEn=null;
				$stu_birth=null;
//--------------------------------------------------------------------					
				$stu_blood=null;
				$IDReligion=null;
//---------------------------------------------------------------------				
			}
			
			try{
				$CountTestRcSql="SELECT `IDReg`,`IDCard`,`stu_prefix`,`stu_fname`,`stu_sname`,`stu_fname_e`,`stu_sname_e`,`nickTh`,`nickEn`,`stu_birth` 
							     FROM `rc_student_admission` 
							     WHERE `IDReg`='{$this->UL_IDReg}' AND `IDCard`='{$this->UL_IDCard}'";
				if($CountTestRcRs=$pdo_admission->query($CountTestRcSql)){
					$CountTestRcRow=$CountTestRcRs->Fetch(PDO::FETCH_ASSOC);
					if(is_array($CountTestRcRow) && count($CountTestRcRow)){
						$TxtRc="Y";
						$IDReg=$CountTestRcRow["IDReg"];
						$IDCard=$CountTestRcRow["IDCard"];
						$stu_prefix=$CountTestRcRow["stu_prefix"];
						$stu_fname=$CountTestRcRow["stu_fname"];
						$stu_sname=$CountTestRcRow["stu_sname"];
						$stu_fname_e=$CountTestRcRow["stu_fname_e"];
						$stu_sname_e=$CountTestRcRow["stu_sname_e"];
						$nickTh=$CountTestRcRow["nickTh"];
						$nickEn=$CountTestRcRow["nickEn"];
						$stu_birth=$CountTestRcRow["stu_birth"];
						$stu_birth=date("d-m-Y",strtotime($stu_birth));		
//--------------------------------------------------------------------					
						$stu_blood=null;
						$IDReligion=null;
//---------------------------------------------------------------------							
					}else{
						$TxtRc="N";
						$IDReg=null;
						$IDCard=null;
						$stu_prefix=null;
						$stu_fname=null;
						$stu_sname=null;
						$stu_fname_e=null;
						$stu_sname_e=null;
						$nickTh=null;
						$nickEn=null;
						$stu_birth=null;
//--------------------------------------------------------------------					
						$stu_blood=null;
						$IDReligion=null;
//---------------------------------------------------------------------						
					}
				}else{
					$TxtRc="N";
					$IDReg=null;
					$IDCard=null;
					$stu_prefix=null;
					$stu_fname=null;
					$stu_sname=null;
					$stu_fname_e=null;
					$stu_sname_e=null;
					$nickTh=null;
					$nickEn=null;
					$stu_birth=null;
//--------------------------------------------------------------------					
					$stu_blood=null;
					$IDReligion=null;
//---------------------------------------------------------------------					
				}
			}catch(PDOException $un){
				$TxtRc="N";
			}			
			
			if($TxtInsert=="Y" and $TxtRc=="N"){//แทรกชั้น
								
				try{
					$UpData_ReginaStuDataSql="insert into `regina_stu_data`(`rsd_studentid`,`rsd_Identification`,`rsd_prefix`,`rsd_name`,`rsd_surname`,`rsd_nameEn`,`rsd_surnameEn`,`nickTh`,`nickEn`,`rse_student_status`)
											  VALUES ('{$this->UL_IDstu}','{$this->UL_IDCard}','{$stu_prefix}','{$stu_fname}','{$stu_sname}','{$stu_fname_e}','{$stu_sname_e}','{$nickTh}','{$nickEn}','1')";
					if($pdo_student->exec($UpData_ReginaStuDataSql)>0){
						$Count_ReginaStuData=1;
					}else{
						$Count_ReginaStuData=0;
					}					
				}catch(PDOException $ursd){
					$Count_ReginaStuData=0;
				}
				
//pring_data_student ----------------------------------------------------
				try{
					$PringDataStudentSql="SELECT * FROM `data_student` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringDataStudentRs=$pdo_swiprc->query($PringDataStudentSql)){
							$PringDataStudentRow=$PringDataStudentRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringDataStudentRow) && count($PringDataStudentRow)){
									$InDataDataStudentSql="INSERT INTO `data_student`(`stu_id`, `stu_birth`, `stu_blood`, `stu_nation`, `stu_sun`, `IDReligion`, `stu_phone`, `stu_brethren`, `stu_brethreS`, `stu_child`, `stu_physical`, `breed_add`, `breed_district`, `breed_city`, `breed_province`, `ds_SameSchool`, `ds_ProvinceSchool`, `ds_gradeSchool`, `ds_OriginalClass`) 
														   VALUES ('{$this->UL_IDstu}','{$stu_birth}','{$PringDataStudentRow["stu_blood"]}','{$PringDataStudentRow["stu_nation"]}'
														   ,'{$PringDataStudentRow["stu_sun"]}','{$PringDataStudentRow["IDReligion"]}','{$PringDataStudentRow["stu_phone"]}'
														   ,'{$PringDataStudentRow["stu_brethren"]}','{$PringDataStudentRow["stu_brethreS"]}','{$PringDataStudentRow["stu_child"]}'
														   ,'{$PringDataStudentRow["stu_physical"]}','{$PringDataStudentRow["breed_add"]}','{$PringDataStudentRow["breed_district"]}'
														   ,'{$PringDataStudentRow["breed_city"]}','{$PringDataStudentRow["breed_province"]}','{$PringDataStudentRow["ds_SameSchool"]}','{$PringDataStudentRow["ds_ProvinceSchool"]}','{$PringDataStudentRow["ds_gradeSchool"]}','{$PringDataStudentRow["ds_OriginalClass"]}')";
									if($pdo_conndatastu->exec($InDataDataStudentSql)>0){
										$T_InToDataStudent=1;
									}else{
										$F_InToDataStudent=0;
									}
								}else{
									$F_InToDataStudent=0;
								}
						}else{
							$F_InToDataStudent=0;
						}					
				}catch(PDOException $pdss){
					$F_InToDataStudent=0;
				}
//pring_data_student End-------------------------------------------------
//pring_depend_stu				
				try{
				$PringDependStuSql="SELECT * FROM `depend_stu` WHERE `ds_stuid`='{$this->UL_IDReg}';";
					if($PringDependStuRs=$pdo_swiprc->query($PringDependStuSql)){
						$PringDependStuRow=$PringDependStuRs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($PringDependStuRow) && count($PringDependStuRow)){
								$InDataDependStuSql="INSERT INTO `depend_stu`(`ds_stuid`, `ds_status`, `ds_dormitoryName`, `ds_dormitoryHno`, `ds_dormitoryMoo`, `ds_dormitorySoi`, `ds_dormitoryRoad`, `ds_dormitoryTumbon`, `ds_dormitoryAmphur`, `ds_dormitoryProvince`, `ds_dormitoryZipcode`, `ds_dormitoryPhone`, `ds_dormitoryMyName`, `ds_FoodAllergies`, `ds_CongenitalDisease`, `ds_DrugAllergy`, `ds_trip`, `ds_triptxt`, `ds_FMstatus`, `ds_allergic`) VALUES 
													('{$this->UL_IDstu}','{$PringDependStuRow["ds_status"]}','{$PringDependStuRow["ds_dormitoryName"]}','{$PringDependStuRow["ds_dormitoryHno"]}','{$PringDependStuRow["ds_dormitoryMoo"]}','{$PringDependStuRow["ds_dormitorySoi"]}','{$PringDependStuRow["ds_dormitoryRoad"]}','{$PringDependStuRow["ds_dormitoryTumbon"]}','{$PringDependStuRow["ds_dormitoryAmphur"]}','{$PringDependStuRow["ds_dormitoryProvince"]}','{$PringDependStuRow["ds_dormitoryZipcode"]}','{$PringDependStuRow["ds_dormitoryPhone"]}','{$PringDependStuRow["ds_dormitoryMyName"]}','{$PringDependStuRow["ds_FoodAllergies"]}','{$PringDependStuRow["ds_CongenitalDisease"]}','{$PringDependStuRow["ds_DrugAllergy"]}','{$PringDependStuRow["ds_trip"]}','{$PringDependStuRow["ds_triptxt"]}','{$PringDependStuRow["ds_FMstatus"]}','{$PringDependStuRow["ds_allergic"]}')";
								if($pdo_conndatastu->exec($InDataDependStuSql)>0){
									$T_InToDependStu=1;
								}else{
									$F_InToDependStu=0;
								}
							}else{
								$F_InToDependStu=0;
							}
					}else{
						$F_InToDependStu=0;
					}					
				}catch(PDOException $ursd){
					$F_InToDependStu=0;
				}
//pring_depend_stu End				
//pring_stu_address
				try{
				$PringStuAddressSql="SELECT * FROM `stu_address` WHERE `stu_id`='{$this->UL_IDReg}';";
					if($PringStuAddressRs=$pdo_swiprc->query($PringStuAddressSql)){
						$PringStuAddressRow=$PringStuAddressRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringStuAddressRow) && count($PringStuAddressRow)){
							$InDataStuAddressSql="INSERT INTO `stu_address`(`stu_id`, `stu_hno`, `stu_moo`, `stu_soi`, `stu_road`, `stu_tumbon`, `stu_amphur`, `stu_province`, `stu_zipcode`) 
												  VALUES ('{$this->UL_IDstu}','{$PringStuAddressRow["stu_hno"]}','{$PringStuAddressRow["stu_moo"]}','{$PringStuAddressRow["stu_moo_name"]}','{$PringStuAddressRow["stu_soi"]}','{$PringStuAddressRow["stu_road"]}','{$PringStuAddressRow["stu_tumbon"]}','{$PringStuAddressRow["stu_amphur"]}','{$PringStuAddressRow["stu_province"]}','{$PringStuAddressRow["stu_zipcode"]}')";
							if($pdo_conndatastu->exec($InDataStuAddressSql)>0){
								$T_InToStuAddress=1;
							}else{
								$F_InToStuAddress=0;
							}
						}else{
							$F_InToStuAddress=0;
						}
					}else{
						$F_InToStuAddress=0;
					}
				}catch(PDOException $psas){
					$F_InToStuAddress=0;
				}
//pring_stu_address End	
//pring_stu_address_home	
				try{
					$PringStuAddressHomeSql="SELECT * FROM `stu_address_home` WHERE `stu_id`='{$this->UL_IDReg}';";
					if($PringStuAddressHomeRs=$pdo_swiprc->query($PringStuAddressHomeSql)){
						$PringStuAddressHomeRow=$PringStuAddressHomeRs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($PringStuAddressHomeRow) && count($PringStuAddressHomeRow)){
								$InDataStuAddressHomeSql="INSERT INTO `stu_address_home`(`stu_id`, `stu_reg_hno`, `stu_reg_moo`,`stu_reg_moo_name`, `stu_reg_soi`, `stu_reg_road`, `stu_reg_tumbon`, `stu_reg_amphur`, `stu_reg_province`, `stu_reg_zipcode`) VALUES 
														 ('{$this->UL_IDstu}','{$PringStuAddressHomeRow["stu_reg_hno"]}','{$PringStuAddressHomeRow["stu_reg_moo"]}','{$PringStuAddressHomeRow["stu_reg_moo_name"]}','{$PringStuAddressHomeRow["stu_reg_soi"]}','{$PringStuAddressHomeRow["stu_reg_road"]}','{$PringStuAddressHomeRow["stu_reg_tumbon"]}','{$PringStuAddressHomeRow["stu_reg_amphur"]}','{$PringStuAddressHomeRow["stu_reg_province"]}','{$PringStuAddressHomeRow["stu_reg_zipcode"]}')";
								if($pdo_conndatastu->exec($InDataStuAddressHomeSql)>0){
									$T_InToStuAddressHome=1;
								}else{
									$F_InToStuAddressHome=0;
								}
							}else{
								$F_InToStuAddressHome=0;
							}
					}else{
						$F_InToStuAddressHome=0;
					}
				}catch(PDOException $psahs){
					$F_InToStuAddressHome=0;
				}
//pring_stu_address_home end				
//pring_stu_father
				try{
					$PringStuFatherSql="SELECT * FROM `stu_father` WHERE `stu_id`='{$this->UL_IDReg}';";
					if($PringStuFatherRs=$pdo_swiprc->query($PringStuFatherSql)){
						$PringStuFatherRow=$PringStuFatherRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringStuFatherRow) && count($PringStuFatherRow)){
						$InDataStuFatherSql="INSERT INTO `stu_father`(`stu_id`, `father_prefix`, `father_fname`, `father_sname`, `father_prefix_en`, `father_fname_en`, `father_sname_en`, `father_code`, `sf_blood`, `sf_nation`, `sf_sun`, `sf_IDReligion`, `af_birthday`, `father_career`, `father_study`, `father_careerOther`, `father_salary`, `father_workplace`, `father_wp_pro`, `father_wp_tel`, `father_phone`) VALUES 
											('{$this->UL_IDstu}','{$PringStuFatherRow["father_prefix"]}','{$PringStuFatherRow["father_fname"]}','{$PringStuFatherRow["father_sname"]}','{$PringStuFatherRow["father_prefix_en"]}','{$PringStuFatherRow["father_fname_en"]}','{$PringStuFatherRow["father_sname_en"]}','{$PringStuFatherRow["father_code"]}','{$PringStuFatherRow["sf_blood"]}','{$PringStuFatherRow["sf_nation"]}','{$PringStuFatherRow["sf_sun"]}','{$PringStuFatherRow["sf_IDReligion"]}','{$PringStuFatherRow["af_birthday"]}','{$PringStuFatherRow["father_career"]}','{$PringStuFatherRow["father_study"]}','{$PringStuFatherRow["father_careerOther"]}','{$PringStuFatherRow["father_salary"]}','{$PringStuFatherRow["father_workplace"]}','{$PringStuFatherRow["father_wp_pro"]}','{$PringStuFatherRow["father_wp_tel"]}','{$PringStuFatherRow["father_phone"]}')";
							if($pdo_conndatastu->exec($InDataStuFatherSql)>0){
								$T_InToStuFather=1;
							}else{
								$F_InToStuFather=0;
							}	
						}else{
							$F_InToStuFather=0;									
						}
					}else{
						$F_InToStuFather=0;							
					}
						
				}catch(PDOException $psfs){
					$F_InToStuFather=0;					
				}
//pring_stu_father End	
//pring_stu_father_address			
				try{
					$PringFatherAddressSql="SELECT * FROM `stu_father_address` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringFatherAddressRs=$pdo_swiprc->query($PringFatherAddressSql)){
							$PringFatherAddressRow=$PringFatherAddressRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringFatherAddressRow) && count($PringFatherAddressRow)){
								    $InDataFatherAddressSql="INSERT INTO `stu_father_address`(`stu_id`, `father_hno`, `father_moo`,`father_moo_name`,`father_soi`, `father_road`, `father_tumbon`, `father_amphur`, `father_province`, `father_zipcode`) 
												             VALUES ('{$this->UL_IDstu}','{$PringFatherAddressRow["father_hno"]}','{$PringFatherAddressRow["father_moo"]}','{$PringFatherAddressRow["father_moo_name"]}','{$PringFatherAddressRow["father_soi"]}','{$PringFatherAddressRow["father_road"]}','{$PringFatherAddressRow["father_tumbon"]}','{$PringFatherAddressRow["father_amphur"]}','{$PringFatherAddressRow["father_province"]}','{$PringFatherAddressRow["father_zipcode"]}')";
									if($pdo_conndatastu->exec($InDataFatherAddressSql)>0){
										$T_InToFatherAddress=1;
									}else{
										$F_InToFatherAddress=0;
									}
								}else{
									$F_InToFatherAddress=0;
								}
						}else{
							$F_InToFatherAddress=0;
						}
					
				}catch(PDOException $psfas){
					$F_InToFatherAddress=0;
				}
//pring_stu_father_address End	
//pring_stu_father_addword			
				try{
					$PringStuFatherAddwordSql="SELECT * FROM `stu_father_addword` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringStuFatherAddwordRs=$pdo_swiprc->query($PringStuFatherAddwordSql)){
							$PringStuFatherAddwordRow=$PringStuFatherAddwordRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringStuFatherAddwordRow) && count($PringStuFatherAddwordRow)){
									$InDataStuFatherAddwordSql="INSERT INTO `stu_father_addword`(`stu_id`, `father_addwordhno`, `father_addwordmoo`,`father_addwordmoo_name`, `father_addwordsoi`, `father_addwordroad`, `father_addwordtumbon`, `father_addwordamphur`, `father_addwordprovince`, `father_addwordzipcode`, `father_addwordphone`) VALUES 
																('{$this->UL_IDstu}','{$PringStuFatherAddwordRow["father_addwordhno"]}','{$PringStuFatherAddwordRow["father_addwordmoo"]}','{$PringStuFatherAddwordRow["father_addwordmoo_name"]}','{$PringStuFatherAddwordRow["father_addwordsoi"]}','{$PringStuFatherAddwordRow["father_addwordroad"]}','{$PringStuFatherAddwordRow["father_addwordtumbon"]}','{$PringStuFatherAddwordRow["father_addwordamphur"]}','{$PringStuFatherAddwordRow["father_addwordprovince"]}','{$PringStuFatherAddwordRow["father_addwordzipcode"]}','{$PringStuFatherAddwordRow["father_addwordphone"]}')";
										if($pdo_conndatastu->exec($InDataStuFatherAddwordSql)>0){
											$T_InToStuFatherAddword=1;
										}else{
											$F_InToStuFatherAddword=0;
										}
								}else{
									$F_InToStuFatherAddword=0;
								}
						}else{
							$F_InToStuFatherAddword=0;
						}
				}catch(PDOException $psfas){
					$F_InToStuFatherAddword=0;
				}
//pring_stu_father_addword End	
//pring_stu_guardian				
				try{
					$PringStuGuardianSql="SELECT * FROM `stu_guardian` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringStuGuardianRs=$pdo_swiprc->query($PringStuGuardianSql)){
							$PringStuGuardianRow=$PringStuGuardianRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringStuGuardianRow) && count($PringStuGuardianRow)){
									$InDataStuGuardianSql="INSERT INTO `stu_guardian`(`stu_id`, `parent_prefix`, `parent_fname`, `parent_sname`, `parent_prefix_en`, `parent_fname_en`, `parent_sname_en`, `parent_code`, `guardian_birthday`, `parent_phone`, `parent_blood`, `parent_nation`, `parent_sun`, `parent_IDReligion`, `parent_birthday`, `parent_career`, `parent_careerOther`, `parent_study`, `parent_salary`, `parent_workplace`, `parent_family`, `parent_wp_pro`, `parent_wp_tel`, `parent_status`) 
																	   VALUES ('{$this->UL_IDstu}','{$PringStuGuardianRow["parent_prefix"]}','{$PringStuGuardianRow["parent_fname"]}','{$PringStuGuardianRow["parent_sname"]}','{$PringStuGuardianRow["parent_prefix_en"]}','{$PringStuGuardianRow["parent_fname_en"]}','{$PringStuGuardianRow["parent_sname_en"]}','{$PringStuGuardianRow["parent_code"]}','{$PringStuGuardianRow["guardian_birthday"]}','{$PringStuGuardianRow["parent_phone"]}','{$PringStuGuardianRow["parent_blood"]}','{$PringStuGuardianRow["parent_nation"]}','{$PringStuGuardianRow["parent_sun"]}','{$PringStuGuardianRow["parent_IDReligion"]}','{$PringStuGuardianRow["parent_birthday"]}','{$PringStuGuardianRow["parent_career"]}','{$PringStuGuardianRow["parent_careerOther"]}','{$PringStuGuardianRow["parent_study"]}','{$PringStuGuardianRow["parent_salary"]}','{$PringStuGuardianRow["parent_workplace"]}','{$PringStuGuardianRow["parent_family"]}','{$PringStuGuardianRow["parent_wp_pro"]}','{$PringStuGuardianRow["parent_wp_tel"]}','{$PringStuGuardianRow["parent_status"]}')";
									if($pdo_conndatastu->exec($InDataStuGuardianSql)>0){
										$T_InToStuGuardian=1;
									}else{
										$F_InToStuGuardian=0;
									}
								}else{
									$F_InToStuGuardian=0;
								}
						}else{
							$F_InToStuGuardian=0;
						}
				}catch(PDOException $psgs){
					$F_InToStuGuardian=0;
				}
//pring_stu_guardian End		
//pring_stu_guardian_address		
				try{
					$PringStuGuardianAddressSql="SELECT * FROM `stu_guardian_address` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringStuGuardianAddressRs=$pdo_swiprc->query($PringStuGuardianAddressSql)){
							$PringStuGuardianAddressRow=$PringStuGuardianAddressRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringStuGuardianAddressRow) && count($PringStuGuardianAddressRow)){
									$InDataStuGuardianAddressSql="INSERT INTO `stu_guardian_address`(`stu_id`, `parent_hno`, `parent_moo`,`parent_moo_name`, `parent_soi`, `parent_road`, `parent_tumbon`, `parent_amphur`, `parent_province`, `parent_zipcode`, `parent_stu`) 
																  VALUES ('{$this->UL_IDstu}','{$PringStuGuardianAddressRow["parent_hno"]}','{$PringStuGuardianAddressRow["parent_moo"]}','{$PringStuGuardianAddressRow["parent_moo_name"]}','{$PringStuGuardianAddressRow["parent_soi"]}','{$PringStuGuardianAddressRow["parent_road"]}','{$PringStuGuardianAddressRow["parent_tumbon"]}','{$PringStuGuardianAddressRow["parent_amphur"]}','{$PringStuGuardianAddressRow["parent_province"]}','{$PringStuGuardianAddressRow["parent_zipcode"]}','{$PringStuGuardianAddressRow["parent_stu"]}')";
									if($pdo_conndatastu->exec($InDataStuGuardianAddressSql)>0){
										$T_InToStuGuardianAddress=1;
									}else{
										$F_InToStuGuardianAddress=0;
									}
								}else{
									$F_InToStuGuardianAddress=0;
								}
						}else{
							$F_InToStuGuardianAddress=0;
						}
				}catch(PDOException $psgas){
					$F_InToStuGuardianAddress=0;
				}
//pring_stu_guardian_address End
//pring_stu_guardian_addword	
				try{
					$PringStuGuardianAddWordSql="SELECT * FROM `stu_guardian_addword` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringStuGuardianAddWordRs=$pdo_swiprc->query($PringStuGuardianAddWordSql)){
							$PringStuGuardianAddWordRow=$PringStuGuardianAddWordRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringStuGuardianAddWordRow) && count($PringStuGuardianAddWordRow)){
									$InDataStuGuardianAddWordSql="INSERT INTO `stu_guardian_addword`(`stu_id`, `parent_addwordhno`, `parent_addwordmoo`,`parent_addwordmoo_name`, `parent_addwordsoi`, `parent_addwordroad`, `parent_addwordtumbon`, `parent_addwordamphur`, `parent_addwordprovince`, `parent_addwordzipcode`, `parent_addwordstu`) 
																  VALUES ('{$this->UL_IDstu}','{$PringStuGuardianAddWordRow["parent_addwordhno"]}','{$PringStuGuardianAddWordRow["parent_addwordmoo"]}','{$PringStuGuardianAddWordRow["parent_addwordmoo_name"]}','{$PringStuGuardianAddWordRow["parent_addwordsoi"]}','{$PringStuGuardianAddWordRow["parent_addwordroad"]}','{$PringStuGuardianAddWordRow["parent_addwordtumbon"]}','{$PringStuGuardianAddWordRow["parent_addwordamphur"]}','{$PringStuGuardianAddWordRow["parent_addwordprovince"]}','{$PringStuGuardianAddWordRow["parent_addwordzipcode"]}','{$PringStuGuardianAddWordRow["parent_addwordstu"]}')";
									if($pdo_conndatastu->exec($InDataStuGuardianAddWordSql)>0){
										$T_InToStuGuardianAddWord=1;
									}else{
										$F_InToStuGuardianAddWord=0;
									}
								}else{
									$F_InToStuGuardianAddWord=0;
								}
						}else{
							$F_InToStuGuardianAddWord=0;
						}
				}catch(PDOException $psgas){
					$F_InToStuGuardianAddWord=0;
				}
//print_stu_guardian_addword End
//print_stu_mother
				try{
					$PringStuMotherSql="SELECT * FROM `stu_mother` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringStuMotherRs=$pdo_swiprc->query($PringStuMotherSql)){
							$PringStuMotherRow=$PringStuMotherRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringStuMotherRow) && count($PringStuMotherRow)){
									$InDataStuMotherSql="INSERT INTO `stu_mother`(`stu_id`, `mother_prefix`, `mother_fname`, `mother_sname`, `mother_prefix_en`, `mother_fname_en`, `mother_sname_en`, `mother_code`, `mother_blood`, `mother_nation`, `mother_sun`, `mother_IDReligion`, `mother_birthday`, `mother_career`, `mother_careerOther`, `mother_study`, `mother_salary`, `mother_workplace`, `mother_wp_pro`, `mother_wp_tel`, `mother_phone`) 
														 VALUES ('{$this->UL_IDstu}','{$PringStuMotherRow["mother_prefix"]}','{$PringStuMotherRow["mother_fname"]}','{$PringStuMotherRow["mother_sname"]}','{$PringStuMotherRow["mother_prefix_en"]}','{$PringStuMotherRow["mother_fname_en"]}','{$PringStuMotherRow["mother_sname_en"]}','{$PringStuMotherRow["mother_code"]}','{$PringStuMotherRow["mother_blood"]}','{$PringStuMotherRow["mother_nation"]}','{$PringStuMotherRow["mother_sun"]}','{$PringStuMotherRow["mother_IDReligion"]}','{$PringStuMotherRow["mother_birthday"]}','{$PringStuMotherRow["mother_career"]}','{$PringStuMotherRow["mother_careerOther"]}','{$PringStuMotherRow["mother_study"]}','{$PringStuMotherRow["mother_salary"]}','{$PringStuMotherRow["mother_workplace"]}','{$PringStuMotherRow["mother_wp_pro"]}','{$PringStuMotherRow["mother_wp_tel"]}','{$PringStuMotherRow["mother_phone"]}')";
									if($pdo_conndatastu->exec($InDataStuMotherSql)>0){
										$T_InToStuMother=1;
									}else{
										$F_InToStuMother=0;
									}
								}else{
									$F_InToStuMother=0;
								}
						}else{
							$F_InToStuMother=0;
						}
					
				}catch(PDOException $psms){
					$F_InToStuMother=0;
				}
//print_stu_mother End		
//print_stu_mother_address
				try{
					$PringMotherAddressSql="SELECT * FROM `stu_mother_address` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringMotherAddressRs=$pdo_swiprc->query($PringMotherAddressSql)){
							$PringMotherAddressRow=$PringMotherAddressRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringMotherAddressRow) && count($PringMotherAddressRow)){
									$InDataMotherAddressSql="INSERT INTO `stu_mother_address`(`stu_id`, `mother_hno`, `mother_moo`,`mother_moo_name`, `mother_soi`, `mother_road`, `mother_tumbon`, `mother_amphur`, `mother_province`, `mother_zipcode`) 
															 VALUES ('{$this->UL_IDstu}','{$PringMotherAddressRow["mother_hno"]}','{$PringMotherAddressRow["mother_moo"]}','{$PringMotherAddressRow["mother_moo_name"]}','{$PringMotherAddressRow["mother_soi"]}','{$PringMotherAddressRow["mother_road"]}','{$PringMotherAddressRow["mother_tumbon"]}','{$PringMotherAddressRow["mother_amphur"]}','{$PringMotherAddressRow["mother_province"]}','{$PringMotherAddressRow["mother_zipcode"]}')";
										if($pdo_conndatastu->exec($InDataMotherAddressSql)>0){
											$T_InToMotherAddress=1;
										}else{
											$F_InToMotherAddress=0;
										}
								}else{
									$F_InToMotherAddress=0;
								}
						}else{
							$F_InToMotherAddress=0;
						}
					
				}catch(PDOException $psmas){
					$F_InToMotherAddress=0;
				}
//print_stu_mother_address End
//print_stu_mother_addword
				try{
					$PringStuMotherAddwordSql="SELECT * FROM `stu_mother_addword` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringStuMotherAddwordRs=$pdo_swiprc->query($PringStuMotherAddwordSql)){
							$PringStuMotherAddwordRow=$PringStuMotherAddwordRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringStuMotherAddwordRow) && count($PringStuMotherAddwordRow)){
									$InDataStuMotherAddwordSql="INSERT INTO `stu_mother_addword`(`stu_id`, `mother_wordhno`, `mother_wordmoo`,`mother_wordmoo_name`, `mother_wordsoi`, `mother_wordroad`, `mother_wordtumbon`, `mother_wordamphur`, `mother_wordprovince`, `mother_wordzipcode`) 
																VALUES ('{$this->UL_IDstu}','{$PringStuMotherAddwordRow["mother_wordhno"]}','{$PringStuMotherAddwordRow["mother_wordmoo"]}','{$PringStuMotherAddwordRow["mother_wordmoo_name"]}','{$PringStuMotherAddwordRow["mother_wordsoi"]}','{$PringStuMotherAddwordRow["mother_wordroad"]}','{$PringStuMotherAddwordRow["mother_wordtumbon"]}','{$PringStuMotherAddwordRow["mother_wordamphur"]}','{$PringStuMotherAddwordRow["mother_wordprovince"]}','{$PringStuMotherAddwordRow["mother_wordzipcode"]}')";
									if($pdo_conndatastu->exec($InDataStuMotherAddwordSql)>0){
										$T_InToStuMotherAddword=1;
									}else{
										$F_InToStuMotherAddword=0;
									}
								}else{
									$F_InToStuMotherAddword=0;
								}
						}else{
							$F_InToStuMotherAddword=0;
						}	
				}catch(PDOException $ursd){
					$F_InToStuMotherAddword=0;
				}
//print_stu_mother_addword End		


			}elseif($TxtInsert=="N" and $TxtRc=="Y"){//ทั่วไป
				
				try{
					$UpData_ReginaStuDataSql="insert into `regina_stu_data`(`rsd_studentid`,`rsd_Identification`,`rsd_prefix`,`rsd_name`,`rsd_surname`,`rsd_nameEn`,`rsd_surnameEn`,`nickTh`,`nickEn`,`rse_student_status`)
											  VALUES ('{$this->UL_IDstu}','{$this->UL_IDCard}','{$stu_prefix}','{$stu_fname}','{$stu_sname}','{$stu_fname_e}','{$stu_sname_e}','{$nickTh}','{$nickEn}','1')";
					if($pdo_student->exec($UpData_ReginaStuDataSql)>0){
						$Count_ReginaStuData=1;
					}else{
						$Count_ReginaStuData=0;
					}					
				}catch(PDOException $ursd){
					$Count_ReginaStuData=0;
				}				
//pring_data_student ----------------------------------------------------				
				try{
					$PringDataStudentSql="SELECT * FROM `data_student` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringDataStudentRs=$pdo_swiprc->query($PringDataStudentSql)){
							$PringDataStudentRow=$PringDataStudentRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringDataStudentRow) && count($PringDataStudentRow)){
									$InDataDataStudentSql="INSERT INTO `data_student`(`stu_id`, `stu_birth`, `stu_blood`, `stu_nation`, `stu_sun`, `IDReligion`, `stu_phone`, `stu_brethren`, `stu_brethreS`, `stu_child`, `stu_physical`, `breed_add`, `breed_district`, `breed_city`, `breed_province`, `ds_SameSchool`, `ds_ProvinceSchool`, `ds_gradeSchool`, `ds_OriginalClass`) 
														   VALUES ('{$this->UL_IDstu}','{$stu_birth}','{$PringDataStudentRow["stu_blood"]}','{$PringDataStudentRow["stu_nation"]}'
														   ,'{$PringDataStudentRow["stu_sun"]}','{$PringDataStudentRow["IDReligion"]}','{$PringDataStudentRow["stu_phone"]}'
														   ,'{$PringDataStudentRow["stu_brethren"]}','{$PringDataStudentRow["stu_brethreS"]}','{$PringDataStudentRow["stu_child"]}'
														   ,'{$PringDataStudentRow["stu_physical"]}','{$PringDataStudentRow["breed_add"]}','{$PringDataStudentRow["breed_district"]}'
														   ,'{$PringDataStudentRow["breed_city"]}','{$PringDataStudentRow["breed_province"]}','{$PringDataStudentRow["ds_SameSchool"]}','{$PringDataStudentRow["ds_ProvinceSchool"]}','{$PringDataStudentRow["ds_gradeSchool"]}','{$PringDataStudentRow["ds_OriginalClass"]}')";
									if($pdo_conndatastu->exec($InDataDataStudentSql)>0){
										$T_InToDataStudent=1;
									}else{
										$F_InToDataStudent=0;
									}
								}else{
									$F_InToDataStudent=0;
								}
						}else{
							$F_InToDataStudent=0;
						}					
				}catch(PDOException $pdss){
					$F_InToDataStudent=0;
				}				
//pring_data_student End-------------------------------------------------				
//pring_depend_stu				
				try{
				$PringDependStuSql="SELECT * FROM `depend_stu` WHERE `ds_stuid`='{$this->UL_IDReg}';";
					if($PringDependStuRs=$pdo_swiprc->query($PringDependStuSql)){
						$PringDependStuRow=$PringDependStuRs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($PringDependStuRow) && count($PringDependStuRow)){
								$InDataDependStuSql="INSERT INTO `depend_stu`(`ds_stuid`, `ds_status`, `ds_dormitoryName`, `ds_dormitoryHno`, `ds_dormitoryMoo`, `ds_dormitorySoi`, `ds_dormitoryRoad`, `ds_dormitoryTumbon`, `ds_dormitoryAmphur`, `ds_dormitoryProvince`, `ds_dormitoryZipcode`, `ds_dormitoryPhone`, `ds_dormitoryMyName`, `ds_FoodAllergies`, `ds_CongenitalDisease`, `ds_DrugAllergy`, `ds_trip`, `ds_triptxt`, `ds_FMstatus`, `ds_allergic`) VALUES 
													('{$this->UL_IDstu}','{$PringDependStuRow["ds_status"]}','{$PringDependStuRow["ds_dormitoryName"]}','{$PringDependStuRow["ds_dormitoryHno"]}','{$PringDependStuRow["ds_dormitoryMoo"]}','{$PringDependStuRow["ds_dormitorySoi"]}','{$PringDependStuRow["ds_dormitoryRoad"]}','{$PringDependStuRow["ds_dormitoryTumbon"]}','{$PringDependStuRow["ds_dormitoryAmphur"]}','{$PringDependStuRow["ds_dormitoryProvince"]}','{$PringDependStuRow["ds_dormitoryZipcode"]}','{$PringDependStuRow["ds_dormitoryPhone"]}','{$PringDependStuRow["ds_dormitoryMyName"]}','{$PringDependStuRow["ds_FoodAllergies"]}','{$PringDependStuRow["ds_CongenitalDisease"]}','{$PringDependStuRow["ds_DrugAllergy"]}','{$PringDependStuRow["ds_trip"]}','{$PringDependStuRow["ds_triptxt"]}','{$PringDependStuRow["ds_FMstatus"]}','{$PringDependStuRow["ds_allergic"]}')";
								if($pdo_conndatastu->exec($InDataDependStuSql)>0){
									$T_InToDependStu=1;
								}else{
									$F_InToDependStu=0;
								}
							}else{
								$F_InToDependStu=0;
							}
					}else{
						$F_InToDependStu=0;
					}					
				}catch(PDOException $ursd){
					$F_InToDependStu=0;
				}
//pring_depend_stu End
//pring_stu_address
				try{
				$PringStuAddressSql="SELECT * FROM `stu_address` WHERE `stu_id`='{$this->UL_IDReg}';";
					if($PringStuAddressRs=$pdo_swiprc->query($PringStuAddressSql)){
						$PringStuAddressRow=$PringStuAddressRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringStuAddressRow) && count($PringStuAddressRow)){
							$InDataStuAddressSql="INSERT INTO `stu_address`(`stu_id`, `stu_hno`, `stu_moo`, `stu_soi`, `stu_road`, `stu_tumbon`, `stu_amphur`, `stu_province`, `stu_zipcode`) 
												  VALUES ('{$this->UL_IDstu}','{$PringStuAddressRow["stu_hno"]}','{$PringStuAddressRow["stu_moo"]}','{$PringStuAddressRow["stu_moo_name"]}','{$PringStuAddressRow["stu_soi"]}','{$PringStuAddressRow["stu_road"]}','{$PringStuAddressRow["stu_tumbon"]}','{$PringStuAddressRow["stu_amphur"]}','{$PringStuAddressRow["stu_province"]}','{$PringStuAddressRow["stu_zipcode"]}')";
							if($pdo_conndatastu->exec($InDataStuAddressSql)>0){
								$T_InToStuAddress=1;
							}else{
								$F_InToStuAddress=0;
							}
						}else{
							$F_InToStuAddress=0;
						}
					}else{
						$F_InToStuAddress=0;
					}
				}catch(PDOException $psas){
					$F_InToStuAddress=0;
				}
//pring_stu_address End			
//pring_stu_address_home	
				try{
					$PringStuAddressHomeSql="SELECT * FROM `stu_address_home` WHERE `stu_id`='{$this->UL_IDReg}';";
					if($PringStuAddressHomeRs=$pdo_swiprc->query($PringStuAddressHomeSql)){
						$PringStuAddressHomeRow=$PringStuAddressHomeRs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($PringStuAddressHomeRow) && count($PringStuAddressHomeRow)){
								$InDataStuAddressHomeSql="INSERT INTO `stu_address_home`(`stu_id`, `stu_reg_hno`, `stu_reg_moo`,`stu_reg_moo_name`, `stu_reg_soi`, `stu_reg_road`, `stu_reg_tumbon`, `stu_reg_amphur`, `stu_reg_province`, `stu_reg_zipcode`) VALUES 
														 ('{$this->UL_IDstu}','{$PringStuAddressHomeRow["stu_reg_hno"]}','{$PringStuAddressHomeRow["stu_reg_moo"]}','{$PringStuAddressHomeRow["stu_reg_moo_name"]}','{$PringStuAddressHomeRow["stu_reg_soi"]}','{$PringStuAddressHomeRow["stu_reg_road"]}','{$PringStuAddressHomeRow["stu_reg_tumbon"]}','{$PringStuAddressHomeRow["stu_reg_amphur"]}','{$PringStuAddressHomeRow["stu_reg_province"]}','{$PringStuAddressHomeRow["stu_reg_zipcode"]}')";
								if($pdo_conndatastu->exec($InDataStuAddressHomeSql)>0){
									$T_InToStuAddressHome=1;
								}else{
									$F_InToStuAddressHome=0;
								}
							}else{
								$F_InToStuAddressHome=0;
							}
					}else{
						$F_InToStuAddressHome=0;
					}
				}catch(PDOException $psahs){
					$F_InToStuAddressHome=0;
				}
//pring_stu_address_home end
//pring_stu_father
				try{
					$PringStuFatherSql="SELECT * FROM `stu_father` WHERE `stu_id`='{$this->UL_IDReg}';";
					if($PringStuFatherRs=$pdo_swiprc->query($PringStuFatherSql)){
						$PringStuFatherRow=$PringStuFatherRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringStuFatherRow) && count($PringStuFatherRow)){
						$InDataStuFatherSql="INSERT INTO `stu_father`(`stu_id`, `father_prefix`, `father_fname`, `father_sname`, `father_prefix_en`, `father_fname_en`, `father_sname_en`, `father_code`, `sf_blood`, `sf_nation`, `sf_sun`, `sf_IDReligion`, `af_birthday`, `father_career`, `father_study`, `father_careerOther`, `father_salary`, `father_workplace`, `father_wp_pro`, `father_wp_tel`, `father_phone`) VALUES 
											('{$this->UL_IDstu}','{$PringStuFatherRow["father_prefix"]}','{$PringStuFatherRow["father_fname"]}','{$PringStuFatherRow["father_sname"]}','{$PringStuFatherRow["father_prefix_en"]}','{$PringStuFatherRow["father_fname_en"]}','{$PringStuFatherRow["father_sname_en"]}','{$PringStuFatherRow["father_code"]}','{$PringStuFatherRow["sf_blood"]}','{$PringStuFatherRow["sf_nation"]}','{$PringStuFatherRow["sf_sun"]}','{$PringStuFatherRow["sf_IDReligion"]}','{$PringStuFatherRow["af_birthday"]}','{$PringStuFatherRow["father_career"]}','{$PringStuFatherRow["father_study"]}','{$PringStuFatherRow["father_careerOther"]}','{$PringStuFatherRow["father_salary"]}','{$PringStuFatherRow["father_workplace"]}','{$PringStuFatherRow["father_wp_pro"]}','{$PringStuFatherRow["father_wp_tel"]}','{$PringStuFatherRow["father_phone"]}')";
							if($pdo_conndatastu->exec($InDataStuFatherSql)>0){
								$T_InToStuFather=1;
							}else{
								$F_InToStuFather=0;
							}	
						}else{
							$F_InToStuFather=0;									
						}
					}else{
						$F_InToStuFather=0;							
					}
						
				}catch(PDOException $psfs){
					$F_InToStuFather=0;					
				}
//pring_stu_father End		
//pring_stu_father_address			
				try{
					$PringFatherAddressSql="SELECT * FROM `stu_father_address` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringFatherAddressRs=$pdo_swiprc->query($PringFatherAddressSql)){
							$PringFatherAddressRow=$PringFatherAddressRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringFatherAddressRow) && count($PringFatherAddressRow)){
								    $InDataFatherAddressSql="INSERT INTO `stu_father_address`(`stu_id`, `father_hno`, `father_moo`,`father_moo_name`,`father_soi`, `father_road`, `father_tumbon`, `father_amphur`, `father_province`, `father_zipcode`) 
												             VALUES ('{$this->UL_IDstu}','{$PringFatherAddressRow["father_hno"]}','{$PringFatherAddressRow["father_moo"]}','{$PringFatherAddressRow["father_moo_name"]}','{$PringFatherAddressRow["father_soi"]}','{$PringFatherAddressRow["father_road"]}','{$PringFatherAddressRow["father_tumbon"]}','{$PringFatherAddressRow["father_amphur"]}','{$PringFatherAddressRow["father_province"]}','{$PringFatherAddressRow["father_zipcode"]}')";
									if($pdo_conndatastu->exec($InDataFatherAddressSql)>0){
										$T_InToFatherAddress=1;
									}else{
										$F_InToFatherAddress=0;
									}
								}else{
									$F_InToFatherAddress=0;
								}
						}else{
							$F_InToFatherAddress=0;
						}
					
				}catch(PDOException $psfas){
					$F_InToFatherAddress=0;
				}
//pring_stu_father_address End
//pring_stu_father_addword			
				try{
					$PringStuFatherAddwordSql="SELECT * FROM `stu_father_addword` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringStuFatherAddwordRs=$pdo_swiprc->query($PringStuFatherAddwordSql)){
							$PringStuFatherAddwordRow=$PringStuFatherAddwordRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringStuFatherAddwordRow) && count($PringStuFatherAddwordRow)){
									$InDataStuFatherAddwordSql="INSERT INTO `stu_father_addword`(`stu_id`, `father_addwordhno`, `father_addwordmoo`,`father_addwordmoo_name`, `father_addwordsoi`, `father_addwordroad`, `father_addwordtumbon`, `father_addwordamphur`, `father_addwordprovince`, `father_addwordzipcode`, `father_addwordphone`) VALUES 
																('{$this->UL_IDstu}','{$PringStuFatherAddwordRow["father_addwordhno"]}','{$PringStuFatherAddwordRow["father_addwordmoo"]}','{$PringStuFatherAddwordRow["father_addwordmoo_name"]}','{$PringStuFatherAddwordRow["father_addwordsoi"]}','{$PringStuFatherAddwordRow["father_addwordroad"]}','{$PringStuFatherAddwordRow["father_addwordtumbon"]}','{$PringStuFatherAddwordRow["father_addwordamphur"]}','{$PringStuFatherAddwordRow["father_addwordprovince"]}','{$PringStuFatherAddwordRow["father_addwordzipcode"]}','{$PringStuFatherAddwordRow["father_addwordphone"]}')";
										if($pdo_conndatastu->exec($InDataStuFatherAddwordSql)>0){
											$T_InToStuFatherAddword=1;
										}else{
											$F_InToStuFatherAddword=0;
										}
								}else{
									$F_InToStuFatherAddword=0;
								}
						}else{
							$F_InToStuFatherAddword=0;
						}
				}catch(PDOException $psfas){
					$F_InToStuFatherAddword=0;
				}
//pring_stu_father_addword End
//pring_stu_guardian				
				try{
					$PringStuGuardianSql="SELECT * FROM `stu_guardian` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringStuGuardianRs=$pdo_swiprc->query($PringStuGuardianSql)){
							$PringStuGuardianRow=$PringStuGuardianRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringStuGuardianRow) && count($PringStuGuardianRow)){
									$InDataStuGuardianSql="INSERT INTO `stu_guardian`(`stu_id`, `parent_prefix`, `parent_fname`, `parent_sname`, `parent_prefix_en`, `parent_fname_en`, `parent_sname_en`, `parent_code`, `guardian_birthday`, `parent_phone`, `parent_blood`, `parent_nation`, `parent_sun`, `parent_IDReligion`, `parent_birthday`, `parent_career`, `parent_careerOther`, `parent_study`, `parent_salary`, `parent_workplace`, `parent_family`, `parent_wp_pro`, `parent_wp_tel`, `parent_status`) 
																	   VALUES ('{$this->UL_IDstu}','{$PringStuGuardianRow["parent_prefix"]}','{$PringStuGuardianRow["parent_fname"]}','{$PringStuGuardianRow["parent_sname"]}','{$PringStuGuardianRow["parent_prefix_en"]}','{$PringStuGuardianRow["parent_fname_en"]}','{$PringStuGuardianRow["parent_sname_en"]}','{$PringStuGuardianRow["parent_code"]}','{$PringStuGuardianRow["guardian_birthday"]}','{$PringStuGuardianRow["parent_phone"]}','{$PringStuGuardianRow["parent_blood"]}','{$PringStuGuardianRow["parent_nation"]}','{$PringStuGuardianRow["parent_sun"]}','{$PringStuGuardianRow["parent_IDReligion"]}','{$PringStuGuardianRow["parent_birthday"]}','{$PringStuGuardianRow["parent_career"]}','{$PringStuGuardianRow["parent_careerOther"]}','{$PringStuGuardianRow["parent_study"]}','{$PringStuGuardianRow["parent_salary"]}','{$PringStuGuardianRow["parent_workplace"]}','{$PringStuGuardianRow["parent_family"]}','{$PringStuGuardianRow["parent_wp_pro"]}','{$PringStuGuardianRow["parent_wp_tel"]}','{$PringStuGuardianRow["parent_status"]}')";
									if($pdo_conndatastu->exec($InDataStuGuardianSql)>0){
										$T_InToStuGuardian=1;
									}else{
										$F_InToStuGuardian=0;
									}
								}else{
									$F_InToStuGuardian=0;
								}
						}else{
							$F_InToStuGuardian=0;
						}
				}catch(PDOException $psgs){
					$F_InToStuGuardian=0;
				}
//pring_stu_guardian End
//pring_stu_guardian_address		
				try{
					$PringStuGuardianAddressSql="SELECT * FROM `stu_guardian_address` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringStuGuardianAddressRs=$pdo_swiprc->query($PringStuGuardianAddressSql)){
							$PringStuGuardianAddressRow=$PringStuGuardianAddressRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringStuGuardianAddressRow) && count($PringStuGuardianAddressRow)){
									$InDataStuGuardianAddressSql="INSERT INTO `stu_guardian_address`(`stu_id`, `parent_hno`, `parent_moo`,`parent_moo_name`, `parent_soi`, `parent_road`, `parent_tumbon`, `parent_amphur`, `parent_province`, `parent_zipcode`, `parent_stu`) 
																  VALUES ('{$this->UL_IDstu}','{$PringStuGuardianAddressRow["parent_hno"]}','{$PringStuGuardianAddressRow["parent_moo"]}','{$PringStuGuardianAddressRow["parent_moo_name"]}','{$PringStuGuardianAddressRow["parent_soi"]}','{$PringStuGuardianAddressRow["parent_road"]}','{$PringStuGuardianAddressRow["parent_tumbon"]}','{$PringStuGuardianAddressRow["parent_amphur"]}','{$PringStuGuardianAddressRow["parent_province"]}','{$PringStuGuardianAddressRow["parent_zipcode"]}','{$PringStuGuardianAddressRow["parent_stu"]}')";
									if($pdo_conndatastu->exec($InDataStuGuardianAddressSql)>0){
										$T_InToStuGuardianAddress=1;
									}else{
										$F_InToStuGuardianAddress=0;
									}
								}else{
									$F_InToStuGuardianAddress=0;
								}
						}else{
							$F_InToStuGuardianAddress=0;
						}
				}catch(PDOException $psgas){
					$F_InToStuGuardianAddress=0;
				}
//pring_stu_guardian_address End
//pring_stu_guardian_addword	
				try{
					$PringStuGuardianAddWordSql="SELECT * FROM `stu_guardian_addword` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringStuGuardianAddWordRs=$pdo_swiprc->query($PringStuGuardianAddWordSql)){
							$PringStuGuardianAddWordRow=$PringStuGuardianAddWordRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringStuGuardianAddWordRow) && count($PringStuGuardianAddWordRow)){
									$InDataStuGuardianAddWordSql="INSERT INTO `stu_guardian_addword`(`stu_id`, `parent_addwordhno`, `parent_addwordmoo`,`parent_addwordmoo_name`, `parent_addwordsoi`, `parent_addwordroad`, `parent_addwordtumbon`, `parent_addwordamphur`, `parent_addwordprovince`, `parent_addwordzipcode`, `parent_addwordstu`) 
																  VALUES ('{$this->UL_IDstu}','{$PringStuGuardianAddWordRow["parent_addwordhno"]}','{$PringStuGuardianAddWordRow["parent_addwordmoo"]}','{$PringStuGuardianAddWordRow["parent_addwordmoo_name"]}','{$PringStuGuardianAddWordRow["parent_addwordsoi"]}','{$PringStuGuardianAddWordRow["parent_addwordroad"]}','{$PringStuGuardianAddWordRow["parent_addwordtumbon"]}','{$PringStuGuardianAddWordRow["parent_addwordamphur"]}','{$PringStuGuardianAddWordRow["parent_addwordprovince"]}','{$PringStuGuardianAddWordRow["parent_addwordzipcode"]}','{$PringStuGuardianAddWordRow["parent_addwordstu"]}')";
									if($pdo_conndatastu->exec($InDataStuGuardianAddWordSql)>0){
										$T_InToStuGuardianAddWord=1;
									}else{
										$F_InToStuGuardianAddWord=0;
									}
								}else{
									$F_InToStuGuardianAddWord=0;
								}
						}else{
							$F_InToStuGuardianAddWord=0;
						}
				}catch(PDOException $psgas){
					$F_InToStuGuardianAddWord=0;
				}
//print_stu_guardian_addword End	
//print_stu_mother
				try{
					$PringStuMotherSql="SELECT * FROM `stu_mother` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringStuMotherRs=$pdo_swiprc->query($PringStuMotherSql)){
							$PringStuMotherRow=$PringStuMotherRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringStuMotherRow) && count($PringStuMotherRow)){
									$InDataStuMotherSql="INSERT INTO `stu_mother`(`stu_id`, `mother_prefix`, `mother_fname`, `mother_sname`, `mother_prefix_en`, `mother_fname_en`, `mother_sname_en`, `mother_code`, `mother_blood`, `mother_nation`, `mother_sun`, `mother_IDReligion`, `mother_birthday`, `mother_career`, `mother_careerOther`, `mother_study`, `mother_salary`, `mother_workplace`, `mother_wp_pro`, `mother_wp_tel`, `mother_phone`) 
														 VALUES ('{$this->UL_IDstu}','{$PringStuMotherRow["mother_prefix"]}','{$PringStuMotherRow["mother_fname"]}','{$PringStuMotherRow["mother_sname"]}','{$PringStuMotherRow["mother_prefix_en"]}','{$PringStuMotherRow["mother_fname_en"]}','{$PringStuMotherRow["mother_sname_en"]}','{$PringStuMotherRow["mother_code"]}','{$PringStuMotherRow["mother_blood"]}','{$PringStuMotherRow["mother_nation"]}','{$PringStuMotherRow["mother_sun"]}','{$PringStuMotherRow["mother_IDReligion"]}','{$PringStuMotherRow["mother_birthday"]}','{$PringStuMotherRow["mother_career"]}','{$PringStuMotherRow["mother_careerOther"]}','{$PringStuMotherRow["mother_study"]}','{$PringStuMotherRow["mother_salary"]}','{$PringStuMotherRow["mother_workplace"]}','{$PringStuMotherRow["mother_wp_pro"]}','{$PringStuMotherRow["mother_wp_tel"]}','{$PringStuMotherRow["mother_phone"]}')";
									if($pdo_conndatastu->exec($InDataStuMotherSql)>0){
										$T_InToStuMother=1;
									}else{
										$F_InToStuMother=0;
									}
								}else{
									$F_InToStuMother=0;
								}
						}else{
							$F_InToStuMother=0;
						}
					
				}catch(PDOException $psms){
					$F_InToStuMother=0;
				}
//print_stu_mother End		
//print_stu_mother_address
				try{
					$PringMotherAddressSql="SELECT * FROM `stu_mother_address` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringMotherAddressRs=$pdo_swiprc->query($PringMotherAddressSql)){
							$PringMotherAddressRow=$PringMotherAddressRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringMotherAddressRow) && count($PringMotherAddressRow)){
									$InDataMotherAddressSql="INSERT INTO `stu_mother_address`(`stu_id`, `mother_hno`, `mother_moo`,`mother_moo_name`, `mother_soi`, `mother_road`, `mother_tumbon`, `mother_amphur`, `mother_province`, `mother_zipcode`) 
															 VALUES ('{$this->UL_IDstu}','{$PringMotherAddressRow["mother_hno"]}','{$PringMotherAddressRow["mother_moo"]}','{$PringMotherAddressRow["mother_moo_name"]}','{$PringMotherAddressRow["mother_soi"]}','{$PringMotherAddressRow["mother_road"]}','{$PringMotherAddressRow["mother_tumbon"]}','{$PringMotherAddressRow["mother_amphur"]}','{$PringMotherAddressRow["mother_province"]}','{$PringMotherAddressRow["mother_zipcode"]}')";
										if($pdo_conndatastu->exec($InDataMotherAddressSql)>0){
											$T_InToMotherAddress=1;
										}else{
											$F_InToMotherAddress=0;
										}
								}else{
									$F_InToMotherAddress=0;
								}
						}else{
							$F_InToMotherAddress=0;
						}
					
				}catch(PDOException $psmas){
					$F_InToMotherAddress=0;
				}
//print_stu_mother_address End	
//print_stu_mother_addword
				try{
					$PringStuMotherAddwordSql="SELECT * FROM `stu_mother_addword` WHERE `stu_id`='{$this->UL_IDReg}';";
						if($PringStuMotherAddwordRs=$pdo_swiprc->query($PringStuMotherAddwordSql)){
							$PringStuMotherAddwordRow=$PringStuMotherAddwordRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($PringStuMotherAddwordRow) && count($PringStuMotherAddwordRow)){
									$InDataStuMotherAddwordSql="INSERT INTO `stu_mother_addword`(`stu_id`, `mother_wordhno`, `mother_wordmoo`,`mother_wordmoo_name`, `mother_wordsoi`, `mother_wordroad`, `mother_wordtumbon`, `mother_wordamphur`, `mother_wordprovince`, `mother_wordzipcode`) 
																VALUES ('{$this->UL_IDstu}','{$PringStuMotherAddwordRow["mother_wordhno"]}','{$PringStuMotherAddwordRow["mother_wordmoo"]}','{$PringStuMotherAddwordRow["mother_wordmoo_name"]}','{$PringStuMotherAddwordRow["mother_wordsoi"]}','{$PringStuMotherAddwordRow["mother_wordroad"]}','{$PringStuMotherAddwordRow["mother_wordtumbon"]}','{$PringStuMotherAddwordRow["mother_wordamphur"]}','{$PringStuMotherAddwordRow["mother_wordprovince"]}','{$PringStuMotherAddwordRow["mother_wordzipcode"]}')";
									if($pdo_conndatastu->exec($InDataStuMotherAddwordSql)>0){
										$T_InToStuMotherAddword=1;
									}else{
										$F_InToStuMotherAddword=0;
									}
								}else{
									$F_InToStuMotherAddword=0;
								}
						}else{
							$F_InToStuMotherAddword=0;
						}	
				}catch(PDOException $ursd){
					$F_InToStuMotherAddword=0;
				}
//print_stu_mother_addword End	
	
	
			}else{}
			
			if(isset($Count_ReginaStuLogin,$Count_ReginaStuData)){
				$this->Count_ReginaStuLogin=$Count_ReginaStuLogin;
				$this->Count_ReginaStuData=$Count_ReginaStuData;
				unset($pdo_admission);
				unset($pdo_student);
				unset($pdo_conndatastu);				
			}else{
				unset($pdo_admission);
				unset($pdo_student);
				unset($pdo_conndatastu);
			}
		}function Run_ReginaStuLogin(){
			if(isset($this->Count_ReginaStuLogin)){
				return $this->Count_ReginaStuLogin;
			}else{
				//--------------------------------------------------------------
			}			
		}function Run_ReginaStuData(){
			if(isset($this->Count_ReginaStuData)){
				return $this->Count_ReginaStuData;
			}else{
				//--------------------------------------------------------------
			}
		}
	}
?>




<?php
/*
//Update and into regina_stu_data and regina_stu_login
	class UpInt_DataLogin{
		public $UL_IDReg,$UL_IDCard,$UL_IDstu,$UL_Year;
		function __construct($UL_IDReg,$UL_IDCard,$UL_IDstu,$UL_Year){
			$this->UL_IDReg=$UL_IDReg;
			$this->UL_IDCard=$UL_IDCard;
			$this->UL_IDstu=$UL_IDstu;
			$this->UL_Year=$UL_Year;
			//$Count_ReginaStuData=0;
			//$Count_ReginaStuLogin=0;
			$y=substr($this->UL_Year,1,2);
			$CopyYear="login".$y;
			
			$Date_UpInt=date("Y-m-d H:i:s");
//pdo_admission------------------------------------------------------------------------------		
			$IdAdder_Admission=$_SERVER["REMOTE_ADDR"];//------------------------------------
			$connect_admission=new connect_Admission($IdAdder_Admission);//------------------
			$pdo_admission=$connect_admission->call_RunConnAdmission();//--------------------
//pdo_admission End--------------------------------------------------------------------------
//pdo_data-----------------------------------------------------------------------------------
			$IdAdder_Student=$_SERVER["REMOTE_ADDR"];//--------------------------------------
			$connect_student=new count_pdodata($IdAdder_Student);//--------------------------
			$pdo_student=$connect_student->call_pdodata();//---------------------------------
//pdo_dat End--------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------
//pdo_swiprc------------------------------------------------------------------------------------------------------
			$IdAdder_swiprc=$_SERVER["REMOTE_ADDR"];//--------------------------------------
			$connect_swiprc=new connect_swiprc($IdAdder_swiprc);//--------------------------
			$pdo_swiprc=$connect_swiprc->call_RunConnSwiprc();//---------------------------------
//pdo_swiprc End--------------------------------------------------------------------------------------------------
//pdo_conndatastu------------------------------------------------------------------------------------------------------
			$IdAdder_conndatastu=$_SERVER["REMOTE_ADDR"];//--------------------------------------
			$connect_conndatastu=new count_conndatastu($IdAdder_conndatastu);//--------------------------
			$pdo_conndatastu=$connect_conndatastu->call_coun_conndatastu();//---------------------------------
//pdo_conndatastu End--------------------------------------------------------------------------------------------------

//print_insert_student_admission------------------------------------------------------------------------------------
			$InsertAdmissionSql="SELECT `IDReg`,`IDCard`,`stu_prefix`,`stu_fname`,`stu_sname`,`stu_fname_e`,`stu_sname_e`,`stu_birth`,`stu_blood`,`IDReligion` 
								 FROM `insert_student_admission` 
								 WHERE `IDReg`='{$this->UL_IDReg}' 
								 and   `IDCard`='{$this->UL_IDCard}'";
			if($InsertAdmissionRs=$pdo_admission->query($InsertAdmissionSql)){
				$InsertAdmissionRow=$InsertAdmissionRs->Fetch(PDO::FETCH_ASSOC);
				if(is_array($InsertAdmissionRow) && count($InsertAdmissionRow)){
					$IDReg=$InsertAdmissionRow["IDReg"];
					$IDCard=$InsertAdmissionRow["IDCard"];
					$stu_prefix=$InsertAdmissionRow["stu_prefix"];
					$stu_fname=$InsertAdmissionRow["stu_fname"];
					$stu_sname=$InsertAdmissionRow["stu_sname"];
					$stu_fname_e=$InsertAdmissionRow["stu_fname_e"];
					$stu_sname_e=$InsertAdmissionRow["stu_sname_e"];
					$nickTh=null;
					$nickEn=null;
					$stu_birth=$InsertAdmissionRow["stu_birth"];
					$stu_birth=date("d-m-Y",strtotime($stu_birth));
//--------------------------------------------------------------------					
					$stu_blood=strtoupper($InsertAdmissionRow["stu_blood"]);
					$IDReligion=$InsertAdmissionRow["IDReligion"];
//---------------------------------------------------------------------****	ชั่วคราว ระบบเสร็จลบออก!!
					$DeleteDataStudentSql="DELETE FROM `data_student` WHERE `stu_id`='{$this->UL_IDstu}'";
						if($pdo_conndatastu->exec($DeleteDataStudentSql)>0){
							$InDataDataStudentSql="INSERT INTO `data_student`(`stu_id`, `stu_birth`, `stu_blood`, `stu_nation`, `stu_sun`, `IDReligion`) 
												   VALUES ('{$this->UL_IDstu}','{$stu_birth}','{$stu_blood}','188','188','{$IDReligion}')";
							if($pdo_conndatastu->exec($InDataDataStudentSql)>0){
								//$T_InToDataStudent=1;
							}else{
								//$F_InToDataStudent=1;
							}							
						}else{
							$InDataDataStudentSql="INSERT INTO `data_student`(`stu_id`, `stu_birth`, `stu_blood`, `stu_nation`, `stu_sun`, `IDReligion`) 
												   VALUES ('{$this->UL_IDstu}','{$stu_birth}','{$stu_blood}','188','188','{$IDReligion}')";
							if($pdo_conndatastu->exec($InDataDataStudentSql)>0){
								//$T_InToDataStudent=1;
							}else{
								//$F_InToDataStudent=1;
							}							
						}
//----------------------------------------------------------------------***	ชั่วคราว ระบบเสร็จลบออก!!
//---------------------------------------------------------------------
				}else{
//------------------------------------------------------------------------------------------------------------------------------------
//rc_student_admission
			$RCAdmissionSql="SELECT `IDReg`,`IDCard`,`stu_prefix`,`stu_fname`,`stu_sname`,`stu_fname_e`,`stu_sname_e`,`nickTh`,`nickEn`,`stu_birth` 
							 FROM `rc_student_admission` 
							 WHERE `IDReg`='{$this->UL_IDReg}' AND 
							       `IDCard`='{$this->UL_IDCard}'";
			if($RCAdmissionRs=$pdo_admission->query($RCAdmissionSql)){
				$RCAdmissionRow=$RCAdmissionRs->Fetch(PDO::FETCH_ASSOC);
				if(is_array($RCAdmissionRow) && count($RCAdmissionRow)){
					$IDReg=$RCAdmissionRow["IDReg"];
					$IDCard=$RCAdmissionRow["IDCard"];
					$stu_prefix=$RCAdmissionRow["stu_prefix"];
					$stu_fname=$RCAdmissionRow["stu_fname"];
					$stu_sname=$RCAdmissionRow["stu_sname"];
					$stu_fname_e=$RCAdmissionRow["stu_fname_e"];
					$stu_sname_e=$RCAdmissionRow["stu_sname_e"];
					$nickTh=$RCAdmissionRow["nickTh"];
					$nickEn=$RCAdmissionRow["nickEn"];
					$stu_birth=$RCAdmissionRow["stu_birth"];
					$stu_birth=date("d-m-Y",strtotime($stu_birth));
//--------------------------------------------------------------------					
					$stu_blood=null;
					$IDReligion=null;
//---------------------------------------------------------------------					
				}else{
					$IDReg=null;
					$IDCard=null;
					$stu_prefix=null;
					$stu_fname=null;
					$stu_sname=null;
					$stu_fname_e=null;
					$stu_sname_e=null;
					$nickTh=null;
					$nickEn=null;
					$stu_birth=null;
//--------------------------------------------------------------------					
					$stu_blood=null;
					$IDReligion=null;
//---------------------------------------------------------------------						
				}
			}else{
				$IDReg=null;
				$IDCard=null;
				$stu_prefix=null;
				$stu_fname=null;
				$stu_sname=null;
				$stu_fname_e=null;
				$stu_sname_e=null;
				$nickTh=null;
				$nickEn=null;
				$stu_birth=null;	
//--------------------------------------------------------------------					
				$stu_blood=null;
				$IDReligion=null;
//---------------------------------------------------------------------					
			}
//rc_student_admission End ------------------------------------------------------------------------------------------						   
//------------------------------------------------------------------------------------------------------------------------------------
				}
			}else{
				$IDReg=null;
				$IDCard=null;
				$stu_prefix=null;
				$stu_fname=null;
				$stu_sname=null;
				$stu_fname_e=null;
				$stu_sname_e=null;
				$nickTh=null;
				$nickEn=null;
				$stu_birth=null;
//--------------------------------------------------------------------					
				$stu_blood=null;
				$IDReligion=null;
//---------------------------------------------------------------------					
			}
//print_insert_student_admission End -------------------------------------------------------------------------------
//regina_stu_data
			$ReginaStuDataSql="SELECT COUNT(`rsd_studentid`) AS `count_stu` 
							   FROM  `regina_stu_data` 
							   WHERE `rsd_studentid`='{$UL_IDCard}' AND 
							         `rsd_Identification`='{$this->UL_IDstu}'";
				if($ReginaStuDataRs=$pdo_student->query($ReginaStuDataSql)){
						$ReginaStuDataRow=$ReginaStuDataRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($ReginaStuDataRow) && count($ReginaStuDataRow)){
							$count_stu=$ReginaStuDataRow["count_stu"];
							if($count_stu>=1){								
//-------------------------------------------------------------------------------------------------------------------	
								$DeleteReginaStuDataSql="DELETE FROM `regina_stu_data` WHERE `rsd_studentid`='{$this->UL_IDstu}'";
									if($pdo_student->exec($DeleteReginaStuDataSql)>0){
										//--------------------------------------------
									}else{
										//--------------------------------------------
									}
								//unset($pdo_student);		
//-------------------------------------------------------------------------------------------------------------------
								$UpData_ReginaStuDataSql="insert into `regina_stu_data`(`rsd_studentid`,`rsd_Identification`,`rsd_prefix`,`rsd_name`,`rsd_surname`,`rsd_nameEn`,`rsd_surnameEn`,`nickTh`,`nickEn`,`rse_student_status`)
							                              VALUES ('{$this->UL_IDstu}','{$this->UL_IDCard}','{$stu_prefix}','{$stu_fname}','{$stu_sname}','{$stu_fname_e}','{$stu_sname_e}','{$nickTh}','{$nickEn}','1')";
									if($pdo_student->exec($UpData_ReginaStuDataSql)>0){
										$Count_ReginaStuData=1;
									}else{
										$Count_ReginaStuData=0;
									}
								//unset($pdo_student);
//-------------------------------------------------------------------------------------------------------------------
							}else{
//-------------------------------------------------------------------------------------------------------------------	
								$DeleteReginaStuDataSql="DELETE FROM `regina_stu_data` WHERE `rsd_studentid`='{$this->UL_IDstu}'";
									if($pdo_student->exec($DeleteReginaStuDataSql)>0){
										//--------------------------------------------
									}else{
										//--------------------------------------------
									}
								//unset($pdo_student);		
//-------------------------------------------------------------------------------------------------------------------
								$UpData_ReginaStuDataSql="insert into `regina_stu_data`(`rsd_studentid`,`rsd_Identification`,`rsd_prefix`,`rsd_name`,`rsd_surname`,`rsd_nameEn`,`rsd_surnameEn`,`nickTh`,`nickEn`,`rse_student_status`)
							                              VALUES ('{$this->UL_IDstu}','{$this->UL_IDCard}','{$stu_prefix}','{$stu_fname}','{$stu_sname}','{$stu_fname_e}','{$stu_sname_e}','{$nickTh}','{$nickEn}','1')";
									if($pdo_student->exec($UpData_ReginaStuDataSql)>0){
										$Count_ReginaStuData=1;
									}else{
										$Count_ReginaStuData=0;
									}
								//unset($pdo_student);
//-------------------------------------------------------------------------------------------------------------------
							}	
						}else{
							//-------------------------------------------------------------------------------
						}
				}else{
					//---------------------------------------------------------------------------------------
				}
//regina_stu_data End ---------------------------------------------------------------------------------------			
//regina_stu_login
//------------------------------------------------------------------------------------------------------------
		  $print_stu_loginSql="SELECT COUNT(`rsl_user`) AS `RU` FROM `regina_stu_login`
							   WHERE `rsl_user` LIKE '%{$CopyYear}%'  
							   ORDER BY `regina_stu_login`.`rsl_user` DESC";
			 if($print_stu_loginRs=$pdo_student->query($print_stu_loginSql)){
				  $print_stu_loginRow=$print_stu_loginRs->Fetch(PDO::FETCH_ASSOC);
				  if(is_array($print_stu_loginRow) && count($print_stu_loginRow)){
						$rsl_user=$print_stu_loginRow["RU"];
						$rsl_user=$rsl_user+1;
						$TxtIntRslUser="login".$y.$rsl_user;		 				  
				  }else{
						$rsl_user=$print_stu_loginRow["RU"];
						//$rsl_user=$rsl_user+1;
						$TxtIntRslUser="login0".$rsl_user;
				  }
			 }else{
				$rsl_user=Null;
				//$IntRslUser=substr($rsl_user,3,);
				//$IntRslUser=$IntRslUser+1;
				//$TxtIntRslUser="login".$IntRslUser;	
			 }

//------------------------------------------------------------------------------------------------------------	
			$ReginaStuLoginSql="SELECT COUNT(`rsl_user`) AS `ini_user` FROM `regina_stu_login` 
							    WHERE `rsd_studentid`='{$this->UL_IDstu}'";
			if($ReginaStuLoginRs=$pdo_student->query($ReginaStuLoginSql)){
			   $ReginaStuLoginRow=$ReginaStuLoginRs->Fetch(PDO::FETCH_ASSOC);
			   if(is_array($ReginaStuLoginRow) && count($ReginaStuLoginRow)){
				   $ini_user=$ReginaStuLoginRow["ini_user"];
				   if($ini_user>=1){
//-----------------------------------------------------------------------------------------------------------------	
					   $DeleteReginaStuLoginSql="DELETE FROM `regina_stu_login` WHERE `rsd_studentid`='{$this->UL_IDstu}'";
							if($pdo_student->exec($DeleteReginaStuLoginSql)>0){
								//--------------------------------------------
							}else{
								//--------------------------------------------
							}
					   //unset($pdo_student);				   
//-----------------------------------------------------------------------------------------------------------------						   
					   $InToStuLoginSql="INSERT INTO `regina_stu_login`(`rsl_user`, `rsl_status`, `rsl_login`, `rsl_update`, `rsd_studentid`, `model1`) 
										 VALUES ('{$TxtIntRslUser}','1','0','{$Date_UpInt}','{$this->UL_IDstu}','navbar navbar-default header-highlight')";
						   if($pdo_student->exec($InToStuLoginSql)>0){
							   $Count_ReginaStuLogin=1;
						   }else{
							   $Count_ReginaStuLogin=0;
						   }
					   //unset($pdo_student);		
//-----------------------------------------------------------------------------------------------------------------	  
						//echo $this->UL_IDstu."/".$TxtIntRslUser."<br>";
				   }else{
//-----------------------------------------------------------------------------------------------------------------	
					   $DeleteReginaStuLoginSql="DELETE FROM `regina_stu_login` WHERE `rsd_studentid`='{$this->UL_IDstu}'";
							if($pdo_student->exec($DeleteReginaStuLoginSql)>0){
								//--------------------------------------------
							}else{
								//--------------------------------------------
							}
					   //unset($pdo_student);				   
//-----------------------------------------------------------------------------------------------------------------					   
					   $InToStuLoginSql="INSERT INTO `regina_stu_login`(`rsl_user`, `rsl_status`, `rsl_login`, `rsl_update`, `rsd_studentid`, `model1`) 
										 VALUES ('{$TxtIntRslUser}','1','0','{$Date_UpInt}','{$this->UL_IDstu}','navbar navbar-default header-highlight')";
						   if($pdo_student->exec($InToStuLoginSql)>0){
							   $Count_ReginaStuLogin=1;
						   }else{
							   $Count_ReginaStuLogin=0;
						   }
					  //unset($pdo_student);		
//-----------------------------------------------------------------------------------------------------------------					  
				   }
			   }else{
				   $ini_user=0;
			   }
			}else{
				$ini_user=0;
			}
//regina_stu_login End -------------------------------------------------------------------------------------------

//pring_data_student
			$PringDataStudentSql="SELECT * FROM `data_student` WHERE `stu_id`='{$this->UL_IDReg}';";
				if($PringDataStudentRs=$pdo_swiprc->query($PringDataStudentSql)){
					$PringDataStudentRow=$PringDataStudentRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringDataStudentRow) && count($PringDataStudentRow)){
							$Count_DataStudentSql="SELECT `stu_id` AS `count_ds` 
												   FROM `data_student` 
												   WHERE `stu_id`='{$this->UL_IDstu}'";
								if($Count_DataStudentRs=$pdo_conndatastu->query($Count_DataStudentSql)){
									$Count_DataStudentRow=$Count_DataStudentRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($Count_DataStudentRow) && count($Count_DataStudentRow)){
										$count_ds=$Count_DataStudentRow["count_ds"];
											if($count_ds>=1){
												$UpDataDataStudentSql="UPDATE `data_student` SET 
																	  `stu_birth`='{$stu_birth}',`stu_blood`='{$PringDataStudentRow["stu_blood"]}',`stu_nation`='{$PringDataStudentRow["stu_nation"]}'
																	 ,`stu_sun`='{$PringDataStudentRow["stu_sun"]}',`IDReligion`='{$PringDataStudentRow["IDReligion"]}',`stu_phone`='{$PringDataStudentRow["stu_phone"]}'
																	 ,`stu_brethren`='{$PringDataStudentRow["stu_brethren"]}',`stu_brethreS`='{$PringDataStudentRow["stu_brethreS"]}',`stu_child`='{$PringDataStudentRow["stu_child"]}'
																	 ,`stu_physical`='{$PringDataStudentRow["stu_physical"]}',`breed_add`='{$PringDataStudentRow["breed_add"]}',`breed_district`='{$PringDataStudentRow["breed_district"]}'
																	 ,`breed_city`='{$PringDataStudentRow["breed_city"]}',`breed_province`='{$PringDataStudentRow["breed_province"]}',`ds_SameSchool`='{$PringDataStudentRow["ds_SameSchool"]}'
																	 ,`ds_ProvinceSchool`='{$PringDataStudentRow["ds_ProvinceSchool"]}',`ds_gradeSchool`='{$PringDataStudentRow["ds_gradeSchool"]}',`ds_OriginalClass`='{$PringDataStudentRow["ds_OriginalClass"]}'
																	 WHERE `stu_id`='{$this->UL_IDstu}'";
													if($pdo_conndatastu->exec($UpDataDataStudentSql)>0){
														$T_UpDataDataStudent=1;
													}else{
														$F_UpDataDataStudent=1;
													}
											}else{
												$InDataDataStudentSql="INSERT INTO `data_student`(`stu_id`, `stu_birth`, `stu_blood`, `stu_nation`, `stu_sun`, `IDReligion`, `stu_phone`, `stu_brethren`, `stu_brethreS`, `stu_child`, `stu_physical`, `breed_add`, `breed_district`, `breed_city`, `breed_province`, `ds_SameSchool`, `ds_ProvinceSchool`, `ds_gradeSchool`, `ds_OriginalClass`) 
												                       VALUES ('{$this->UL_IDstu}','{$stu_birth}','{$PringDataStudentRow["stu_blood"]}','{$PringDataStudentRow["stu_nation"]}'
																	  ,'{$PringDataStudentRow["stu_sun"]}','{$PringDataStudentRow["IDReligion"]}','{$PringDataStudentRow["stu_phone"]}'
																	  ,'{$PringDataStudentRow["stu_brethren"]}','{$PringDataStudentRow["stu_brethreS"]}','{$PringDataStudentRow["stu_child"]}'
																	  ,'{$PringDataStudentRow["stu_physical"]}','{$PringDataStudentRow["breed_add"]}','{$PringDataStudentRow["breed_district"]}'
																	  ,'{$PringDataStudentRow["breed_city"]}','{$PringDataStudentRow["breed_province"]}','{$PringDataStudentRow["ds_SameSchool"]}','{$PringDataStudentRow["ds_ProvinceSchool"]}','{$PringDataStudentRow["ds_gradeSchool"]}','{$PringDataStudentRow["ds_OriginalClass"]}')";
													if($pdo_conndatastu->exec($InDataDataStudentSql)>0){
														$T_InToDataStudent=1;
													}else{
														$F_InToDataStudent=1;
													}												
											}
									}else{
//-----------------------------------------------------------------------No Data on the table No Run Array										
										$InDataDataStudentSql="INSERT INTO `data_student`(`stu_id`, `stu_birth`, `stu_blood`, `stu_nation`, `stu_sun`, `IDReligion`, `stu_phone`, `stu_brethren`, `stu_brethreS`, `stu_child`, `stu_physical`, `breed_add`, `breed_district`, `breed_city`, `breed_province`, `ds_SameSchool`, `ds_ProvinceSchool`, `ds_gradeSchool`, `ds_OriginalClass`) 
												               VALUES ('{$this->UL_IDstu}','{$stu_birth}','{$PringDataStudentRow["stu_blood"]}','{$PringDataStudentRow["stu_nation"]}'
																	  ,'{$PringDataStudentRow["stu_sun"]}','{$PringDataStudentRow["IDReligion"]}','{$PringDataStudentRow["stu_phone"]}'
																	  ,'{$PringDataStudentRow["stu_brethren"]}','{$PringDataStudentRow["stu_brethreS"]}','{$PringDataStudentRow["stu_child"]}'
																	  ,'{$PringDataStudentRow["stu_physical"]}','{$PringDataStudentRow["breed_add"]}','{$PringDataStudentRow["breed_district"]}'
																	  ,'{$PringDataStudentRow["breed_city"]}','{$PringDataStudentRow["breed_province"]}','{$PringDataStudentRow["ds_SameSchool"]}','{$PringDataStudentRow["ds_ProvinceSchool"]}','{$PringDataStudentRow["ds_gradeSchool"]}','{$PringDataStudentRow["ds_OriginalClass"]}')";
										if($pdo_conndatastu->exec($InDataDataStudentSql)>0){
											$T_InToDataStudent=1;
										  }else{
											$F_InToDataStudent=1;
										  }	
										
									}
//----------------------------------------------------------------------No Data on the table No Run Array									
								}else{
									//---------------------
								}
						}else{
							//------------------------------------------
						}
				}else{
					//--------------------------------------------------
				}
//pring_data_student End-------------------------------------------------
//pring_depend_stu
			$PringDependStuSql="SELECT * FROM `depend_stu` WHERE `ds_stuid`='{$this->UL_IDReg}';";
				if($PringDependStuRs=$pdo_swiprc->query($PringDependStuSql)){
					$PringDependStuRow=$PringDependStuRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringDependStuRow) && count($PringDependStuRow)){
							$Count_DependStuSql="SELECT `ds_stuid` AS `count_ds` 
												   FROM `depend_stu` 
												   WHERE `ds_stuid`='{$this->UL_IDstu}'";
								if($Count_DependStuRs=$pdo_conndatastu->query($Count_DependStuSql)){
									$Count_DependStuRow=$Count_DependStuRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($Count_DependStuRow) && count($Count_DependStuRow)){
										$count_ds=$Count_DependStuRow["count_ds"];
											if($count_ds>=1){
												$UpDependStuSql="UPDATE `depend_stu` SET `ds_status`='{$PringDependStuRow["ds_status"]}',`ds_dormitoryName`='{$PringDependStuRow["ds_dormitoryName"]}'
												,`ds_dormitoryHno`='{$PringDependStuRow["ds_dormitoryHno"]}',`ds_dormitoryMoo`='{$PringDependStuRow["ds_dormitoryMoo"]}',`ds_dormitorySoi`='{$PringDependStuRow["ds_dormitorySoi"]}',`ds_dormitoryRoad`='{$PringDependStuRow["ds_dormitoryRoad"]}'
												,`ds_dormitoryTumbon`='{$PringDependStuRow["ds_dormitoryTumbon"]}',`ds_dormitoryAmphur`='{$PringDependStuRow["ds_dormitoryAmphur"]}',`ds_dormitoryProvince`='{$PringDependStuRow["ds_dormitoryProvince"]}',`ds_dormitoryZipcode`='{$PringDependStuRow["ds_dormitoryZipcode"]}'
												,`ds_dormitoryPhone`='{$PringDependStuRow["ds_dormitoryPhone"]}',`ds_dormitoryMyName`='{$PringDependStuRow["ds_dormitoryMyName"]}',`ds_FoodAllergies`='{$PringDependStuRow["ds_FoodAllergies"]}',`ds_CongenitalDisease`='{$PringDependStuRow["ds_CongenitalDisease"]}'
												,`ds_DrugAllergy`='{$PringDependStuRow["ds_DrugAllergy"]}',`ds_trip`='{$PringDependStuRow["ds_trip"]}',`ds_triptxt`='{$PringDependStuRow["ds_triptxt"]}',`ds_FMstatus`='{$PringDependStuRow["ds_FMstatus"]}',`ds_allergic`='{$PringDependStuRow["ds_allergic"]}'
												WHERE `ds_stuid`='{$this->UL_IDstu}'";
													if($pdo_conndatastu->exec($UpDependStuSql)>0){
														$T_UpDataDependStu=1;
													}else{
														$F_UpDataDependStu=1;
													}
											}else{
												$InDataDependStuSql="INSERT INTO `depend_stu`(`ds_stuid`, `ds_status`, `ds_dormitoryName`, `ds_dormitoryHno`, `ds_dormitoryMoo`, `ds_dormitorySoi`, `ds_dormitoryRoad`, `ds_dormitoryTumbon`, `ds_dormitoryAmphur`, `ds_dormitoryProvince`, `ds_dormitoryZipcode`, `ds_dormitoryPhone`, `ds_dormitoryMyName`, `ds_FoodAllergies`, `ds_CongenitalDisease`, `ds_DrugAllergy`, `ds_trip`, `ds_triptxt`, `ds_FMstatus`, `ds_allergic`) VALUES 
												('{$this->UL_IDstu}','{$PringDependStuRow["ds_status"]}','{$PringDependStuRow["ds_dormitoryName"]}','{$PringDependStuRow["ds_dormitoryHno"]}','{$PringDependStuRow["ds_dormitoryMoo"]}','{$PringDependStuRow["ds_dormitorySoi"]}','{$PringDependStuRow["ds_dormitoryRoad"]}','{$PringDependStuRow["ds_dormitoryTumbon"]}','{$PringDependStuRow["ds_dormitoryAmphur"]}','{$PringDependStuRow["ds_dormitoryProvince"]}','{$PringDependStuRow["ds_dormitoryZipcode"]}','{$PringDependStuRow["ds_dormitoryPhone"]}','{$PringDependStuRow["ds_dormitoryMyName"]}','{$PringDependStuRow["ds_FoodAllergies"]}','{$PringDependStuRow["ds_CongenitalDisease"]}','{$PringDependStuRow["ds_DrugAllergy"]}','{$PringDependStuRow["ds_trip"]}','{$PringDependStuRow["ds_triptxt"]}','{$PringDependStuRow["ds_FMstatus"]}','{$PringDependStuRow["ds_allergic"]}')";
													if($pdo_conndatastu->exec($InDataDependStuSql)>0){
														$T_InToDependStu=1;
													}else{
														$F_InToDependStu=1;
													}												
											}
									}else{
//-----------------------------------------------------------------------No Data on the table No Run Array
										$InDataDependStuSql="INSERT INTO `depend_stu`(`ds_stuid`, `ds_status`, `ds_dormitoryName`, `ds_dormitoryHno`, `ds_dormitoryMoo`, `ds_dormitorySoi`, `ds_dormitoryRoad`, `ds_dormitoryTumbon`, `ds_dormitoryAmphur`, `ds_dormitoryProvince`, `ds_dormitoryZipcode`, `ds_dormitoryPhone`, `ds_dormitoryMyName`, `ds_FoodAllergies`, `ds_CongenitalDisease`, `ds_DrugAllergy`, `ds_trip`, `ds_triptxt`, `ds_FMstatus`, `ds_allergic`) VALUES 
										('{$this->UL_IDstu}','{$PringDependStuRow["ds_status"]}','{$PringDependStuRow["ds_dormitoryName"]}','{$PringDependStuRow["ds_dormitoryHno"]}','{$PringDependStuRow["ds_dormitoryMoo"]}','{$PringDependStuRow["ds_dormitorySoi"]}','{$PringDependStuRow["ds_dormitoryRoad"]}','{$PringDependStuRow["ds_dormitoryTumbon"]}','{$PringDependStuRow["ds_dormitoryAmphur"]}','{$PringDependStuRow["ds_dormitoryProvince"]}','{$PringDependStuRow["ds_dormitoryZipcode"]}','{$PringDependStuRow["ds_dormitoryPhone"]}','{$PringDependStuRow["ds_dormitoryMyName"]}','{$PringDependStuRow["ds_FoodAllergies"]}','{$PringDependStuRow["ds_CongenitalDisease"]}','{$PringDependStuRow["ds_DrugAllergy"]}','{$PringDependStuRow["ds_trip"]}','{$PringDependStuRow["ds_triptxt"]}','{$PringDependStuRow["ds_FMstatus"]}','{$PringDependStuRow["ds_allergic"]}')";
											if($pdo_conndatastu->exec($InDataDependStuSql)>0){
												$T_InToDependStu=1;
											}else{
												$F_InToDependStu=1;
											}										
//-----------------------------------------------------------------------No Data on the table No Run Array										
									}
								}else{
									//---------------------
								}
						}else{
							//------------------------------------------------------------------------------------
						}
				}else{
					//---------------------------------------------------------------------------------------------
				}
//pring_depend_stu End 			
//pring_stu_address
			$PringStuAddressSql="SELECT * FROM `stu_address` WHERE `stu_id`='{$this->UL_IDReg}';";
				if($PringStuAddressRs=$pdo_swiprc->query($PringStuAddressSql)){
					$PringStuAddressRow=$PringStuAddressRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringStuAddressRow) && count($PringStuAddressRow)){
							$Count_StuAddressSql="SELECT `stu_id` AS `count_ds` 
												   FROM `stu_address` 
												   WHERE `stu_id`='{$this->UL_IDstu}'";
								if($Count_StuAddressRs=$pdo_conndatastu->query($Count_StuAddressSql)){
									$Count_StuAddressRow=$Count_StuAddressRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($Count_StuAddressRow) && count($Count_StuAddressRow)){
										$count_ds=$Count_StuAddressRow["count_ds"];
											if($count_ds>=1){
												$UpDataStuAddressSql="UPDATE `stu_address` SET `stu_hno`='{$PringStuAddressRow["stu_hno"]}',`stu_moo`='{$PringStuAddressRow["stu_moo"]}',`stu_moo_name`='{$PringStuAddressRow["stu_moo_name"]}', `stu_soi`='{$PringStuAddressRow["stu_soi"]}'
												,`stu_road`='{$PringStuAddressRow["stu_road"]}',`stu_tumbon`='{$PringStuAddressRow["stu_tumbon"]}',`stu_amphur`='{$PringStuAddressRow["stu_amphur"]}',`stu_province`='{$PringStuAddressRow["stu_province"]}',`stu_zipcode`='{$PringStuAddressRow["stu_zipcode"]}' 
												WHERE `stu_id`='{$this->UL_IDstu}'";
													if($pdo_conndatastu->exec($UpDataStuAddressSql)>0){
														$T_UpDataStuAddress=1;
													}else{
														$F_UpDataStuAddress=1;
													}
											}else{
												$InDataStuAddressSql="INSERT INTO `stu_address`(`stu_id`, `stu_hno`, `stu_moo`, `stu_soi`, `stu_road`, `stu_tumbon`, `stu_amphur`, `stu_province`, `stu_zipcode`) 
												VALUES ('{$this->UL_IDstu}','{$PringStuAddressRow["stu_hno"]}','{$PringStuAddressRow["stu_moo"]}','{$PringStuAddressRow["stu_moo_name"]}','{$PringStuAddressRow["stu_soi"]}','{$PringStuAddressRow["stu_road"]}','{$PringStuAddressRow["stu_tumbon"]}','{$PringStuAddressRow["stu_amphur"]}','{$PringStuAddressRow["stu_province"]}','{$PringStuAddressRow["stu_zipcode"]}')";
													if($pdo_conndatastu->exec($InDataStuAddressSql)>0){
														$T_InToStuAddress=1;
													}else{
														$F_InToStuAddress=1;
													}												
											}
									}else{
//-----------------------------------------------------------------------No Data on the table No Run Array
										$InDataStuAddressSql="INSERT INTO `stu_address`(`stu_id`, `stu_hno`, `stu_moo`,`stu_moo_name`, `stu_soi`, `stu_road`, `stu_tumbon`, `stu_amphur`, `stu_province`, `stu_zipcode`) 
										VALUES ('{$this->UL_IDstu}','{$PringStuAddressRow["stu_hno"]}','{$PringStuAddressRow["stu_moo"]}','{$PringStuAddressRow["stu_moo_name"]}','{$PringStuAddressRow["stu_soi"]}','{$PringStuAddressRow["stu_road"]}','{$PringStuAddressRow["stu_tumbon"]}','{$PringStuAddressRow["stu_amphur"]}','{$PringStuAddressRow["stu_province"]}','{$PringStuAddressRow["stu_zipcode"]}')";
										if($pdo_conndatastu->exec($InDataStuAddressSql)>0){
											$T_InToStuAddress=1;
										}else{
											$F_InToStuAddress=1;
										}
//-----------------------------------------------------------------------No Data on the table No Run Array
									}
								}else{
									//---------------------
								}
						}else{
							//------------------------------------------------------------------------------------
						}
				}else{
					//---------------------------------------------------------------------------------------------
				}
//pring_stu_address End			
//pring_stu_address_home
			$PringStuAddressHomeSql="SELECT * FROM `stu_address_home` WHERE `stu_id`='{$this->UL_IDReg}';";
				if($PringStuAddressHomeRs=$pdo_swiprc->query($PringStuAddressHomeSql)){
					$PringStuAddressHomeRow=$PringStuAddressHomeRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringStuAddressHomeRow) && count($PringStuAddressHomeRow)){
							$Count_StuAddressHomeSql="SELECT `stu_id` AS `count_ds` 
												   FROM `stu_address_home` 
												   WHERE `stu_id`='{$this->UL_IDstu}'";
								if($Count_StuAddressHomeRs=$pdo_conndatastu->query($Count_StuAddressHomeSql)){
									$Count_StuAddressHomeRow=$Count_StuAddressHomeRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($Count_StuAddressHomeRow) && count($Count_StuAddressHomeRow)){
										$count_ds=$Count_StuAddressHomeRow["count_ds"];
											if($count_ds>=1){
												$UpDataStuAddressHomeSql="UPDATE `stu_address_home` SET `stu_reg_hno`='{$PringStuAddressHomeRow["stu_reg_hno"]}',`stu_reg_moo`='{$PringStuAddressHomeRow["stu_reg_moo"]}',`stu_reg_moo_name`='{$PringStuAddressHomeRow["stu_reg_moo_name"]}',`stu_reg_soi`='{$PringStuAddressHomeRow["stu_reg_soi"]}'
												,`stu_reg_road`='{$PringStuAddressHomeRow["stu_reg_road"]}',`stu_reg_tumbon`='{$PringStuAddressHomeRow["stu_reg_tumbon"]}',`stu_reg_amphur`='{$PringStuAddressHomeRow["stu_reg_amphur"]}',`stu_reg_province`='{$PringStuAddressHomeRow["stu_reg_province"]}'
												,`stu_reg_zipcode`='{$PringStuAddressHomeRow["stu_reg_zipcode"]}' WHERE `stu_id`='{$this->UL_IDstu}'";
													if($pdo_conndatastu->exec($UpDataStuAddressHomeSql)>0){
														$T_UpDataStuAddressHome=1;
													}else{
														$F_UpDataStuAddressHome=1;
													}
											}else{
												$InDataStuAddressHomeSql="INSERT INTO `stu_address_home`(`stu_id`, `stu_reg_hno`, `stu_reg_moo`,`stu_reg_moo_name`, `stu_reg_soi`, `stu_reg_road`, `stu_reg_tumbon`, `stu_reg_amphur`, `stu_reg_province`, `stu_reg_zipcode`) VALUES 
												('{$this->UL_IDstu}','{$PringStuAddressHomeRow["stu_reg_hno"]}','{$PringStuAddressHomeRow["stu_reg_moo"]}','{$PringStuAddressHomeRow["stu_reg_moo_name"]}','{$PringStuAddressHomeRow["stu_reg_soi"]}','{$PringStuAddressHomeRow["stu_reg_road"]}','{$PringStuAddressHomeRow["stu_reg_tumbon"]}','{$PringStuAddressHomeRow["stu_reg_amphur"]}','{$PringStuAddressHomeRow["stu_reg_province"]}','{$PringStuAddressHomeRow["stu_reg_zipcode"]}')";
													if($pdo_conndatastu->exec($InDataStuAddressHomeSql)>0){
														$T_InToStuAddressHome=1;
													}else{
														$F_InToStuAddressHome=1;
													}												
											}
									}else{
//-----------------------------------------------------------------------No Data on the table No Run Array
										$InDataStuAddressHomeSql="INSERT INTO `stu_address_home`(`stu_id`, `stu_reg_hno`, `stu_reg_moo`,`stu_reg_moo_name`, `stu_reg_soi`, `stu_reg_road`, `stu_reg_tumbon`, `stu_reg_amphur`, `stu_reg_province`, `stu_reg_zipcode`) VALUES 
										('{$this->UL_IDstu}','{$PringStuAddressHomeRow["stu_reg_hno"]}','{$PringStuAddressHomeRow["stu_reg_moo"]}','{$PringStuAddressHomeRow["stu_reg_moo_name"]}','{$PringStuAddressHomeRow["stu_reg_soi"]}','{$PringStuAddressHomeRow["stu_reg_road"]}','{$PringStuAddressHomeRow["stu_reg_tumbon"]}','{$PringStuAddressHomeRow["stu_reg_amphur"]}','{$PringStuAddressHomeRow["stu_reg_province"]}','{$PringStuAddressHomeRow["stu_reg_zipcode"]}')";
											if($pdo_conndatastu->exec($InDataStuAddressHomeSql)>0){
												$T_InToStuAddressHome=1;
											}else{
												$F_InToStuAddressHome=1;
											}
//-----------------------------------------------------------------------No Data on the table No Run Array
									}
								}else{
									//---------------------
								}
						}else{
							//------------------------------------------------------------------------------------
						}
				}else{
					//---------------------------------------------------------------------------------------------
				}
//pring_stu_address_home end
//pring_stu_father
			$PringStuFatherSql="SELECT * FROM `stu_father` WHERE `stu_id`='{$this->UL_IDReg}';";
				if($PringStuFatherRs=$pdo_swiprc->query($PringStuFatherSql)){
					$PringStuFatherRow=$PringStuFatherRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringStuFatherRow) && count($PringStuFatherRow)){
							$Count_StuFatherSql="SELECT `stu_id` AS `count_ds` 
												 FROM `stu_father` 
												 WHERE `stu_id`='{$this->UL_IDstu}'";
								if($Count_StuFatherRs=$pdo_conndatastu->query($Count_StuFatherSql)){
									$Count_StuFatherRow=$Count_StuFatherRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($Count_StuFatherRow) && count($Count_StuFatherRow)){
										$count_ds=$Count_StuFatherRow["count_ds"];
											if($count_ds>=1){
												$UpDataStuFatherSql="UPDATE `stu_father` SET `father_prefix`='{$PringStuFatherRow["father_prefix"]}',`father_fname`='{$PringStuFatherRow["father_fname"]}',`father_sname`='{$PringStuFatherRow["father_sname"]}'
												,`father_prefix_en`='{$PringStuFatherRow["father_prefix_en"]}',`father_fname_en`='{$PringStuFatherRow["father_fname_en"]}',`father_sname_en`='{$PringStuFatherRow["father_sname_en"]}',`father_code`='{$PringStuFatherRow["father_code"]}'
												,`sf_blood`='{$PringStuFatherRow["sf_blood"]}',`sf_nation`='{$PringStuFatherRow["sf_nation"]}',`sf_sun`='{$PringStuFatherRow["sf_sun"]}',`sf_IDReligion`='{$PringStuFatherRow["sf_IDReligion"]}',`af_birthday`='{$PringStuFatherRow["af_birthday"]}'
												,`father_career`='{$PringStuFatherRow["father_career"]}',`father_study`='{$PringStuFatherRow["father_study"]}',`father_careerOther`='{$PringStuFatherRow["father_careerOther"]}',`father_salary`='{$PringStuFatherRow["father_salary"]}'
												,`father_workplace`='{$PringStuFatherRow["father_workplace"]}',`father_wp_pro`='{$PringStuFatherRow["father_wp_pro"]}',`father_wp_tel`='{$PringStuFatherRow["father_wp_tel"]}',`father_phone`='{$PringStuFatherRow["father_phone"]}'
												WHERE `stu_id`='{$this->UL_IDstu}'";
													if($pdo_conndatastu->exec($UpDataStuFatherSql)>0){
														$T_UpDataStuFather=1;
													}else{
														$F_UpDataStuFather=1;
													}
											}else{
												$InDataStuFatherSql="INSERT INTO `stu_father`(`stu_id`, `father_prefix`, `father_fname`, `father_sname`, `father_prefix_en`, `father_fname_en`, `father_sname_en`, `father_code`, `sf_blood`, `sf_nation`, `sf_sun`, `sf_IDReligion`, `af_birthday`, `father_career`, `father_study`, `father_careerOther`, `father_salary`, `father_workplace`, `father_wp_pro`, `father_wp_tel`, `father_phone`) VALUES 
												('{$this->UL_IDstu}','{$PringStuFatherRow["father_prefix"]}','{$PringStuFatherRow["father_fname"]}','{$PringStuFatherRow["father_sname"]}','{$PringStuFatherRow["father_prefix_en"]}','{$PringStuFatherRow["father_fname_en"]}','{$PringStuFatherRow["father_sname_en"]}','{$PringStuFatherRow["father_code"]}','{$PringStuFatherRow["sf_blood"]}','{$PringStuFatherRow["sf_nation"]}','{$PringStuFatherRow["sf_sun"]}','{$PringStuFatherRow["sf_IDReligion"]}','{$PringStuFatherRow["af_birthday"]}','{$PringStuFatherRow["father_career"]}','{$PringStuFatherRow["father_study"]}','{$PringStuFatherRow["father_careerOther"]}','{$PringStuFatherRow["father_salary"]}','{$PringStuFatherRow["father_workplace"]}','{$PringStuFatherRow["father_wp_pro"]}','{$PringStuFatherRow["father_wp_tel"]}','{$PringStuFatherRow["father_phone"]}')";
													if($pdo_conndatastu->exec($InDataStuFatherSql)>0){
														$T_InToStuFather=1;
													}else{
														$F_InToStuFather=1;
													}												
											}
									}else{
//-----------------------------------------------------------------------No Data on the table No Run Array
										$InDataStuFatherSql="INSERT INTO `stu_father`(`stu_id`, `father_prefix`, `father_fname`, `father_sname`, `father_prefix_en`, `father_fname_en`, `father_sname_en`, `father_code`, `sf_blood`, `sf_nation`, `sf_sun`, `sf_IDReligion`, `af_birthday`, `father_career`, `father_study`, `father_careerOther`, `father_salary`, `father_workplace`, `father_wp_pro`, `father_wp_tel`, `father_phone`) VALUES 
										('{$this->UL_IDstu}','{$PringStuFatherRow["father_prefix"]}','{$PringStuFatherRow["father_fname"]}','{$PringStuFatherRow["father_sname"]}','{$PringStuFatherRow["father_prefix_en"]}','{$PringStuFatherRow["father_fname_en"]}','{$PringStuFatherRow["father_sname_en"]}','{$PringStuFatherRow["father_code"]}','{$PringStuFatherRow["sf_blood"]}','{$PringStuFatherRow["sf_nation"]}','{$PringStuFatherRow["sf_sun"]}','{$PringStuFatherRow["sf_IDReligion"]}','{$PringStuFatherRow["af_birthday"]}','{$PringStuFatherRow["father_career"]}','{$PringStuFatherRow["father_study"]}','{$PringStuFatherRow["father_careerOther"]}','{$PringStuFatherRow["father_salary"]}','{$PringStuFatherRow["father_workplace"]}','{$PringStuFatherRow["father_wp_pro"]}','{$PringStuFatherRow["father_wp_tel"]}','{$PringStuFatherRow["father_phone"]}')";
											if($pdo_conndatastu->exec($InDataStuFatherSql)>0){
												$T_InToStuFather=1;
											}else{
												$F_InToStuFather=1;
											}
//-----------------------------------------------------------------------No Data on the table No Run Array
									}
								}else{
									//---------------------
								}
						}else{
							//------------------------------------------------------------------------------------
						}
				}else{
					//---------------------------------------------------------------------------------------------
				}
//pring_stu_father End		
//pring_stu_father_address
			$PringFatherAddressSql="SELECT * FROM `stu_father_address` WHERE `stu_id`='{$this->UL_IDReg}';";
				if($PringFatherAddressRs=$pdo_swiprc->query($PringFatherAddressSql)){
					$PringFatherAddressRow=$PringFatherAddressRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringFatherAddressRow) && count($PringFatherAddressRow)){
							$Count_FatherAddressSql="SELECT `stu_id` AS `count_ds` 
												     FROM `stu_father_address` 
												     WHERE `stu_id`='{$this->UL_IDstu}'";
								if($Count_FatherAddressRs=$pdo_conndatastu->query($Count_FatherAddressSql)){
									$Count_FatherAddressRow=$Count_FatherAddressRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($Count_FatherAddressRow) && count($Count_FatherAddressRow)){
										$count_ds=$Count_FatherAddressRow["count_ds"];
											if($count_ds>=1){
												$UpDataFatherAddressSql="UPDATE `stu_father_address` SET `father_hno`='{$PringFatherAddressRow["father_hno"]}',`father_moo`='{$PringFatherAddressRow["father_moo"]}',`father_moo_name`='{$PringFatherAddressRow["father_moo_name"]}',`father_soi`='{$PringFatherAddressRow["father_soi"]}'
												,`father_road`='{$PringFatherAddressRow["father_road"]}',`father_tumbon`='{$PringFatherAddressRow["father_tumbon"]}',`father_amphur`='{$PringFatherAddressRow["father_amphur"]}',`father_province`='{$PringFatherAddressRow["father_province"]}'
												,`father_zipcode`='{$PringFatherAddressRow["father_zipcode"]}' WHERE `stu_id`='{$this->UL_IDstu}'";
													if($pdo_conndatastu->exec($UpDataFatherAddressSql)>0){
														$T_UpDataFatherAddress=1;
													}else{
														$F_UpDataFatherAddress=1;
													}
											}else{
												$InDataFatherAddressSql="INSERT INTO `stu_father_address`(`stu_id`, `father_hno`, `father_moo`,`father_moo_name`, `father_soi`, `father_road`, `father_tumbon`, `father_amphur`, `father_province`, `father_zipcode`) 
												VALUES ('{$this->UL_IDstu}','{$PringFatherAddressRow["father_hno"]}','{$PringFatherAddressRow["father_moo"]}','{$PringFatherAddressRow["father_moo_name"]}','{$PringFatherAddressRow["father_soi"]}','{$PringFatherAddressRow["father_road"]}','{$PringFatherAddressRow["father_tumbon"]}','{$PringFatherAddressRow["father_amphur"]}','{$PringFatherAddressRow["father_province"]}','{$PringFatherAddressRow["father_zipcode"]}')";
													if($pdo_conndatastu->exec($InDataFatherAddressSql)>0){
														$T_InToFatherAddress=1;
													}else{
														$F_InToFatherAddress=1;
													}												
											}
									}else{
//-----------------------------------------------------------------------No Data on the table No Run Array
										$InDataFatherAddressSql="INSERT INTO `stu_father_address`(`stu_id`, `father_hno`, `father_moo`,`father_moo_name`,`father_soi`, `father_road`, `father_tumbon`, `father_amphur`, `father_province`, `father_zipcode`) 
										VALUES ('{$this->UL_IDstu}','{$PringFatherAddressRow["father_hno"]}','{$PringFatherAddressRow["father_moo"]}','{$PringFatherAddressRow["father_moo_name"]}','{$PringFatherAddressRow["father_soi"]}','{$PringFatherAddressRow["father_road"]}','{$PringFatherAddressRow["father_tumbon"]}','{$PringFatherAddressRow["father_amphur"]}','{$PringFatherAddressRow["father_province"]}','{$PringFatherAddressRow["father_zipcode"]}')";
											if($pdo_conndatastu->exec($InDataFatherAddressSql)>0){
												$T_InToFatherAddress=1;
											}else{
												$F_InToFatherAddress=1;
											}
//-----------------------------------------------------------------------No Data on the table No Run Array
									}
								}else{
									//---------------------
								}
						}else{
							//------------------------------------------------------------------------------------
						}
				}else{
					//---------------------------------------------------------------------------------------------
				}
//pring_stu_father_address End
//pring_stu_father_addword
			$PringStuFatherAddwordSql="SELECT * FROM `stu_father_addword` WHERE `stu_id`='{$this->UL_IDReg}';";
				if($PringStuFatherAddwordRs=$pdo_swiprc->query($PringStuFatherAddwordSql)){
					$PringStuFatherAddwordRow=$PringStuFatherAddwordRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringStuFatherAddwordRow) && count($PringStuFatherAddwordRow)){
							$Count_StuFatherAddwordSql="SELECT `stu_id` AS `count_ds` 
												        FROM `stu_father_addword` 
												        WHERE `stu_id`='{$this->UL_IDstu}'";
								if($Count_StuFatherAddwordRs=$pdo_conndatastu->query($Count_StuFatherAddwordSql)){
									$Count_StuFatherAddwordRow=$Count_StuFatherAddwordRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($Count_StuFatherAddwordRow) && count($Count_StuFatherAddwordRow)){
										$count_ds=$Count_StuFatherAddwordRow["count_ds"];
											if($count_ds>=1){
												$UpDataStuFatherAddwordSql="UPDATE `stu_father_addword` SET `father_addwordhno`='{$PringStuFatherAddwordRow["father_addwordhno"]}',`father_addwordmoo`='{$PringStuFatherAddwordRow["father_addwordmoo"]}',`father_addwordmoo_name`='{$PringStuFatherAddwordRow["father_addwordmoo_name"]}'
												,`father_addwordsoi`='{$PringStuFatherAddwordRow["father_addwordsoi"]}',`father_addwordroad`='{$PringStuFatherAddwordRow["father_addwordroad"]}',`father_addwordtumbon`='{$PringStuFatherAddwordRow["father_addwordtumbon"]}',`father_addwordamphur`='{$PringStuFatherAddwordRow["father_addwordamphur"]}'
												,`father_addwordprovince`='{$PringStuFatherAddwordRow["father_addwordprovince"]}',`father_addwordzipcode`='{$PringStuFatherAddwordRow["father_addwordzipcode"]}',`father_addwordphone`='{$PringStuFatherAddwordRow["father_addwordphone"]}' 
												WHERE `stu_id`='{$this->UL_IDstu}'";
													if($pdo_conndatastu->exec($UpDataStuFatherAddwordSql)>0){
														$T_UpDataStuFatherAddword=1;
													}else{
														$F_UpDataStuFatherAddword=1;
													}
											}else{
												$InDataStuFatherAddwordSql="INSERT INTO `stu_father_addword`(`stu_id`, `father_addwordhno`, `father_addwordmoo`,`father_addwordmoo_name`, `father_addwordsoi`, `father_addwordroad`, `father_addwordtumbon`, `father_addwordamphur`, `father_addwordprovince`, `father_addwordzipcode`, `father_addwordphone`) VALUES 
																		    ('{$this->UL_IDstu}','{$PringStuFatherAddwordRow["father_addwordhno"]}','{$PringStuFatherAddwordRow["father_addwordmoo"]}','{$PringStuFatherAddwordRow["father_addwordmoo_name"]}','{$PringStuFatherAddwordRow["father_addwordsoi"]}','{$PringStuFatherAddwordRow["father_addwordroad"]}','{$PringStuFatherAddwordRow["father_addwordtumbon"]}','{$PringStuFatherAddwordRow["father_addwordamphur"]}','{$PringStuFatherAddwordRow["father_addwordprovince"]}','{$PringStuFatherAddwordRow["father_addwordzipcode"]}','{$PringStuFatherAddwordRow["father_addwordphone"]}')";
													if($pdo_conndatastu->exec($InDataStuFatherAddwordSql)>0){
														$T_InToStuFatherAddword=1;
													}else{
														$F_InToStuFatherAddword=1;
													}												
											}
									}else{
//-----------------------------------------------------------------------No Data on the table No Run Array
										$InDataStuFatherAddwordSql="INSERT INTO `stu_father_addword`(`stu_id`, `father_addwordhno`, `father_addwordmoo`,`father_addwordmoo_name`, `father_addwordsoi`, `father_addwordroad`, `father_addwordtumbon`, `father_addwordamphur`, `father_addwordprovince`, `father_addwordzipcode`, `father_addwordphone`) VALUES 
										                           ('{$this->UL_IDstu}','{$PringStuFatherAddwordRow["father_addwordhno"]}','{$PringStuFatherAddwordRow["father_addwordmoo"]}','{$PringStuFatherAddwordRow["father_addwordmoo_name"]}','{$PringStuFatherAddwordRow["father_addwordsoi"]}','{$PringStuFatherAddwordRow["father_addwordroad"]}','{$PringStuFatherAddwordRow["father_addwordtumbon"]}','{$PringStuFatherAddwordRow["father_addwordamphur"]}','{$PringStuFatherAddwordRow["father_addwordprovince"]}','{$PringStuFatherAddwordRow["father_addwordzipcode"]}','{$PringStuFatherAddwordRow["father_addwordphone"]}')";
										if($pdo_conndatastu->exec($InDataStuFatherAddwordSql)>0){
											$T_InToStuFatherAddword=1;
										}else{
											$F_InToStuFatherAddword=1;
										}
//-----------------------------------------------------------------------No Data on the table No Run Array
									}
								}else{
									//---------------------
								}
						}else{
							//------------------------------------------------------------------------------------
						}
				}else{
					//---------------------------------------------------------------------------------------------
				}
//pring_stu_father_addword End
//pring_stu_guardian
			$PringStuGuardianSql="SELECT * FROM `stu_guardian` WHERE `stu_id`='{$this->UL_IDReg}';";
				if($PringStuGuardianRs=$pdo_swiprc->query($PringStuGuardianSql)){
					$PringStuGuardianRow=$PringStuGuardianRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringStuGuardianRow) && count($PringStuGuardianRow)){
							$Count_StuGuardianSql="SELECT `stu_id` AS `count_ds` 
												   FROM `stu_guardian` 
												   WHERE `stu_id`='{$this->UL_IDstu}'";
								if($Count_StuGuardianRs=$pdo_conndatastu->query($Count_StuGuardianSql)){
									$Count_StuGuardianRow=$Count_StuGuardianRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($Count_StuGuardianRow) && count($Count_StuGuardianRow)){
										$count_ds=$Count_StuGuardianRow["count_ds"];
											if($count_ds>=1){
											$UpDataStuGuardianSql="UPDATE `stu_guardian` SET `parent_prefix`='{$PringStuGuardianRow["parent_prefix"]}',`parent_fname`='{$PringStuGuardianRow["parent_fname"]}',`parent_sname`='{$PringStuGuardianRow["parent_sname"]}'
												,`parent_prefix_en`='{$PringStuGuardianRow["parent_prefix_en"]}',`parent_fname_en`='{$PringStuGuardianRow["parent_fname_en"]}',`parent_sname_en`='{$PringStuGuardianRow["parent_sname_en"]}',`parent_code`='{$PringStuGuardianRow["parent_code"]}'
												,`guardian_birthday`='{$PringStuGuardianRow["guardian_birthday"]}',`parent_phone`='{$PringStuGuardianRow["parent_phone"]}',`parent_blood`='{$PringStuGuardianRow["parent_blood"]}',`parent_nation`='{$PringStuGuardianRow["parent_nation"]}'
												,`parent_sun`='{$PringStuGuardianRow["parent_sun"]}',`parent_IDReligion`='{$PringStuGuardianRow["parent_IDReligion"]}',`parent_birthday`='{$PringStuGuardianRow["parent_birthday"]}',`parent_career`='{$PringStuGuardianRow["parent_career"]}'
												,`parent_careerOther`='{$PringStuGuardianRow["parent_careerOther"]}',`parent_study`='{$PringStuGuardianRow["parent_study"]}',`parent_salary`='{$PringStuGuardianRow["parent_salary"]}',`parent_workplace`='{$PringStuGuardianRow["parent_workplace"]}'
												,`parent_family`='{$PringStuGuardianRow["parent_family"]}',`parent_wp_pro`='{$PringStuGuardianRow["parent_wp_pro"]}',`parent_wp_tel`='{$PringStuGuardianRow["parent_wp_tel"]}',`parent_status`='{$PringStuGuardianRow["parent_status"]}' 
												WHERE `stu_id`='{$this->UL_IDstu}'";
													if($pdo_conndatastu->exec($UpDataStuGuardianSql)>0){
														$T_UpDataStuGuardian=1;
													}else{
														$F_UpDataStuGuardian=1;
													}
											}else{
												$InDataStuGuardianSql="INSERT INTO `stu_guardian`(`stu_id`, `parent_prefix`, `parent_fname`, `parent_sname`, `parent_prefix_en`, `parent_fname_en`, `parent_sname_en`, `parent_code`, `guardian_birthday`, `parent_phone`, `parent_blood`, `parent_nation`, `parent_sun`, `parent_IDReligion`, `parent_birthday`, `parent_career`, `parent_careerOther`, `parent_study`, `parent_salary`, `parent_workplace`, `parent_family`, `parent_wp_pro`, `parent_wp_tel`, `parent_status`) 
												VALUES ('{$this->UL_IDstu}','{$PringStuGuardianRow["parent_prefix"]}','{$PringStuGuardianRow["parent_fname"]}','{$PringStuGuardianRow["parent_sname"]}','{$PringStuGuardianRow["parent_prefix_en"]}','{$PringStuGuardianRow["parent_fname_en"]}','{$PringStuGuardianRow["parent_sname_en"]}','{$PringStuGuardianRow["parent_code"]}','{$PringStuGuardianRow["guardian_birthday"]}','{$PringStuGuardianRow["parent_phone"]}','{$PringStuGuardianRow["parent_blood"]}','{$PringStuGuardianRow["parent_nation"]}','{$PringStuGuardianRow["parent_sun"]}','{$PringStuGuardianRow["parent_IDReligion"]}','{$PringStuGuardianRow["parent_birthday"]}','{$PringStuGuardianRow["parent_career"]}','{$PringStuGuardianRow["parent_careerOther"]}','{$PringStuGuardianRow["parent_study"]}','{$PringStuGuardianRow["parent_salary"]}','{$PringStuGuardianRow["parent_workplace"]}','{$PringStuGuardianRow["parent_family"]}','{$PringStuGuardianRow["parent_wp_pro"]}','{$PringStuGuardianRow["parent_wp_tel"]}','{$PringStuGuardianRow["parent_status"]}')";
													if($pdo_conndatastu->exec($InDataStuGuardianSql)>0){
														$T_InToStuGuardian=1;
													}else{
														$F_InToStuGuardian=1;
													}												
											}
									}else{
//-----------------------------------------------------------------------No Data on the table No Run Array
										$InDataStuGuardianSql="INSERT INTO `stu_guardian`(`stu_id`, `parent_prefix`, `parent_fname`, `parent_sname`, `parent_prefix_en`, `parent_fname_en`, `parent_sname_en`, `parent_code`, `guardian_birthday`, `parent_phone`, `parent_blood`, `parent_nation`, `parent_sun`, `parent_IDReligion`, `parent_birthday`, `parent_career`, `parent_careerOther`, `parent_study`, `parent_salary`, `parent_workplace`, `parent_family`, `parent_wp_pro`, `parent_wp_tel`, `parent_status`) 
											                   VALUES ('{$this->UL_IDstu}','{$PringStuGuardianRow["parent_prefix"]}','{$PringStuGuardianRow["parent_fname"]}','{$PringStuGuardianRow["parent_sname"]}','{$PringStuGuardianRow["parent_prefix_en"]}','{$PringStuGuardianRow["parent_fname_en"]}','{$PringStuGuardianRow["parent_sname_en"]}','{$PringStuGuardianRow["parent_code"]}','{$PringStuGuardianRow["guardian_birthday"]}','{$PringStuGuardianRow["parent_phone"]}','{$PringStuGuardianRow["parent_blood"]}','{$PringStuGuardianRow["parent_nation"]}','{$PringStuGuardianRow["parent_sun"]}','{$PringStuGuardianRow["parent_IDReligion"]}','{$PringStuGuardianRow["parent_birthday"]}','{$PringStuGuardianRow["parent_career"]}','{$PringStuGuardianRow["parent_careerOther"]}','{$PringStuGuardianRow["parent_study"]}','{$PringStuGuardianRow["parent_salary"]}','{$PringStuGuardianRow["parent_workplace"]}','{$PringStuGuardianRow["parent_family"]}','{$PringStuGuardianRow["parent_wp_pro"]}','{$PringStuGuardianRow["parent_wp_tel"]}','{$PringStuGuardianRow["parent_status"]}')";
											if($pdo_conndatastu->exec($InDataStuGuardianSql)>0){
												$T_InToStuGuardian=1;
											}else{
												$F_InToStuGuardian=1;
											}
//-----------------------------------------------------------------------No Data on the table No Run Array
									}
								}else{
									//---------------------
								}
						}else{
							//------------------------------------------------------------------------------------
						}
				}else{
					//---------------------------------------------------------------------------------------------
				}
//pring_stu_guardian End		
//pring_stu_guardian_address
			$PringStuGuardianAddressSql="SELECT * FROM `stu_guardian_address` WHERE `stu_id`='{$this->UL_IDReg}';";
				if($PringStuGuardianAddressRs=$pdo_swiprc->query($PringStuGuardianAddressSql)){
					$PringStuGuardianAddressRow=$PringStuGuardianAddressRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringStuGuardianAddressRow) && count($PringStuGuardianAddressRow)){
							$Count_StuGuardianAddressSql="SELECT `stu_id` AS `count_ds` 
												          FROM `stu_guardian_address` 
												          WHERE `stu_id`='{$this->UL_IDstu}'";
								if($Count_StuGuardianAddressRs=$pdo_conndatastu->query($Count_StuGuardianAddressSql)){
									$Count_StuGuardianAddressRow=$Count_StuGuardianAddressRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($Count_StuGuardianAddressRow) && count($Count_StuGuardianAddressRow)){
										$count_ds=$Count_StuGuardianAddressRow["count_ds"];
											if($count_ds>=1){
												$UpDataStuGuardianAddressSql="UPDATE `stu_guardian_address` SET `parent_hno`='{$PringStuGuardianAddressRow["parent_hno"]}',`parent_moo`='{$PringStuGuardianAddressRow["parent_moo"]}',`parent_moo_name`='{$PringStuGuardianAddressRow["parent_moo_name"]}',`parent_soi`='{$PringStuGuardianAddressRow["parent_soi"]}'
												,`parent_road`='{$PringStuGuardianAddressRow["parent_road"]}',`parent_tumbon`='{$PringStuGuardianAddressRow["parent_tumbon"]}',`parent_amphur`='{$PringStuGuardianAddressRow["parent_amphur"]}',`parent_province`='{$PringStuGuardianAddressRow["parent_province"]}'
												,`parent_zipcode`='{$PringStuGuardianAddressRow["parent_zipcode"]}',`parent_stu`='{$PringStuGuardianAddressRow["parent_stu"]}' WHERE `stu_id`='{$this->UL_IDstu}'";
													if($pdo_conndatastu->exec($UpDataStuGuardianAddressSql)>0){
														$T_UpDataStuGuardianAddress=1;
													}else{
														$F_UpDataStuGuardianAddress=1;
													}
											}else{
												$InDataStuGuardianAddressSql="INSERT INTO `stu_guardian_address`(`stu_id`, `parent_hno`, `parent_moo`,`parent_moo_name`, `parent_soi`, `parent_road`, `parent_tumbon`, `parent_amphur`, `parent_province`, `parent_zipcode`, `parent_stu`) 
												VALUES ('{$this->UL_IDstu}','{$PringStuGuardianAddressRow["parent_hno"]}','{$PringStuGuardianAddressRow["parent_moo"]}','{$PringStuGuardianAddressRow["parent_moo_name"]}','{$PringStuGuardianAddressRow["parent_soi"]}','{$PringStuGuardianAddressRow["parent_road"]}','{$PringStuGuardianAddressRow["parent_tumbon"]}','{$PringStuGuardianAddressRow["parent_amphur"]}','{$PringStuGuardianAddressRow["parent_province"]}','{$PringStuGuardianAddressRow["parent_zipcode"]}','{$PringStuGuardianAddressRow["parent_stu"]}')";
													if($pdo_conndatastu->exec($InDataStuGuardianAddressSql)>0){
														$T_InToStuGuardianAddress=1;
													}else{
														$F_InToStuGuardianAddress=1;
													}												
											}
									}else{
//-----------------------------------------------------------------------No Data on the table No Run Array
										$InDataStuGuardianAddressSql="INSERT INTO `stu_guardian_address`(`stu_id`, `parent_hno`, `parent_moo`,`parent_moo_name`, `parent_soi`, `parent_road`, `parent_tumbon`, `parent_amphur`, `parent_province`, `parent_zipcode`, `parent_stu`) 
												                      VALUES ('{$this->UL_IDstu}','{$PringStuGuardianAddressRow["parent_hno"]}','{$PringStuGuardianAddressRow["parent_moo"]}','{$PringStuGuardianAddressRow["parent_moo_name"]}','{$PringStuGuardianAddressRow["parent_soi"]}','{$PringStuGuardianAddressRow["parent_road"]}','{$PringStuGuardianAddressRow["parent_tumbon"]}','{$PringStuGuardianAddressRow["parent_amphur"]}','{$PringStuGuardianAddressRow["parent_province"]}','{$PringStuGuardianAddressRow["parent_zipcode"]}','{$PringStuGuardianAddressRow["parent_stu"]}')";
											if($pdo_conndatastu->exec($InDataStuGuardianAddressSql)>0){
												$T_InToStuGuardianAddress=1;
											}else{
												$F_InToStuGuardianAddress=1;
											}	
//-----------------------------------------------------------------------No Data on the table No Run Array
									}
								}else{
									//---------------------
								}
						}else{
							//------------------------------------------------------------------------------------
						}
				}else{
					//---------------------------------------------------------------------------------------------
				}
//pring_stu_guardian_address End			
//pring_stu_guardian_addword
			$PringStuGuardianAddWordSql="SELECT * FROM `stu_guardian_addword` WHERE `stu_id`='{$this->UL_IDReg}';";
				if($PringStuGuardianAddWordRs=$pdo_swiprc->query($PringStuGuardianAddWordSql)){
					$PringStuGuardianAddWordRow=$PringStuGuardianAddWordRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringStuGuardianAddWordRow) && count($PringStuGuardianAddWordRow)){
							$Count_StuGuardianAddWordSql="SELECT `stu_id` AS `count_ds` 
												          FROM `stu_guardian_addword` 
												          WHERE `stu_id`='{$this->UL_IDstu}'";
								if($Count_StuGuardianAddWordRs=$pdo_conndatastu->query($Count_StuGuardianAddWordSql)){
									$Count_StuGuardianAddWordRow=$Count_StuGuardianAddWordRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($Count_StuGuardianAddWordRow) && count($Count_StuGuardianAddWordRow)){
										$count_ds=$Count_StuGuardianAddWordRow["count_ds"];
											if($count_ds>=1){
												$UpDataStuGuardianAddWordSql="UPDATE `stu_guardian_addword` SET `parent_addwordhno`='{$PringStuGuardianAddWordRow["parent_addwordhno"]}',`parent_addwordmoo_name`='{$PringStuGuardianAddWordRow["parent_addwordmoo_name"]}',`parent_addwordmoo`='{$PringStuGuardianAddWordRow["parent_addwordmoo"]}',`parent_addwordsoi`='{$PringStuGuardianAddWordRow["parent_addwordsoi"]}'
												,`parent_addwordroad`='{$PringStuGuardianAddWordRow["parent_addwordroad"]}',`parent_addwordtumbon`='{$PringStuGuardianAddWordRow["parent_addwordtumbon"]}',`parent_addwordamphur`='{$PringStuGuardianAddWordRow["parent_addwordamphur"]}',`parent_addwordprovince`='{$PringStuGuardianAddWordRow["parent_addwordprovince"]}'
												,`parent_addwordzipcode`='{$PringStuGuardianAddWordRow["parent_addwordzipcode"]}',`parent_addwordstu`='{$PringStuGuardianAddWordRow["parent_addwordstu"]}' WHERE `stu_id`='{$this->UL_IDstu}'";
													if($pdo_conndatastu->exec($UpDataStuGuardianAddWordSql)>0){
														$T_UpDataStuGuardianAddWord=1;
													}else{
														$F_UpDataStuGuardianAddWord=1;
													}
											}else{
												$InDataStuGuardianAddWordSql="INSERT INTO `stu_guardian_addword`(`stu_id`, `parent_addwordhno`, `parent_addwordmoo`,`parent_addwordmoo_name`, `parent_addwordsoi`, `parent_addwordroad`, `parent_addwordtumbon`, `parent_addwordamphur`, `parent_addwordprovince`, `parent_addwordzipcode`, `parent_addwordstu`) 
												VALUES ('{$this->UL_IDstu}','{$PringStuGuardianAddWordRow["parent_addwordhno"]}','{$PringStuGuardianAddWordRow["parent_addwordmoo"]}','{$PringStuGuardianAddWordRow["parent_addwordmoo_name"]}','{$PringStuGuardianAddWordRow["parent_addwordsoi"]}','{$PringStuGuardianAddWordRow["parent_addwordroad"]}','{$PringStuGuardianAddWordRow["parent_addwordtumbon"]}','{$PringStuGuardianAddWordRow["parent_addwordamphur"]}','{$PringStuGuardianAddWordRow["parent_addwordprovince"]}','{$PringStuGuardianAddWordRow["parent_addwordzipcode"]}','{$PringStuGuardianAddWordRow["parent_addwordstu"]}')";
													if($pdo_conndatastu->exec($InDataStuGuardianAddWordSql)>0){
														$T_InToStuGuardianAddWord=1;
													}else{
														$F_InToStuGuardianAddWord=1;
													}												
											}
									}else{
//-----------------------------------------------------------------------No Data on the table No Run Array
										$InDataStuGuardianAddWordSql="INSERT INTO `stu_guardian_addword`(`stu_id`, `parent_addwordhno`, `parent_addwordmoo`,`parent_addwordmoo_name`, `parent_addwordsoi`, `parent_addwordroad`, `parent_addwordtumbon`, `parent_addwordamphur`, `parent_addwordprovince`, `parent_addwordzipcode`, `parent_addwordstu`) 
												                      VALUES ('{$this->UL_IDstu}','{$PringStuGuardianAddWordRow["parent_addwordhno"]}','{$PringStuGuardianAddWordRow["parent_addwordmoo"]}','{$PringStuGuardianAddWordRow["parent_addwordmoo_name"]}','{$PringStuGuardianAddWordRow["parent_addwordsoi"]}','{$PringStuGuardianAddWordRow["parent_addwordroad"]}','{$PringStuGuardianAddWordRow["parent_addwordtumbon"]}','{$PringStuGuardianAddWordRow["parent_addwordamphur"]}','{$PringStuGuardianAddWordRow["parent_addwordprovince"]}','{$PringStuGuardianAddWordRow["parent_addwordzipcode"]}','{$PringStuGuardianAddWordRow["parent_addwordstu"]}')";
											if($pdo_conndatastu->exec($InDataStuGuardianAddWordSql)>0){
												$T_InToStuGuardianAddWord=1;
											}else{
												$F_InToStuGuardianAddWord=1;
											}
//-----------------------------------------------------------------------No Data on the table No Run Array
									}
								}else{
									//---------------------
								}
						}else{
							//------------------------------------------------------------------------------------
						}
				}else{
					//---------------------------------------------------------------------------------------------
				}
//print_stu_guardian_addword End			
//print_stu_mother
			$PringStuMotherSql="SELECT * FROM `stu_mother` WHERE `stu_id`='{$this->UL_IDReg}';";
				if($PringStuMotherRs=$pdo_swiprc->query($PringStuMotherSql)){
					$PringStuMotherRow=$PringStuMotherRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringStuMotherRow) && count($PringStuMotherRow)){
							$Count_StuMotherSql="SELECT `stu_id` AS `count_ds` 
												 FROM `stu_mother` 
												 WHERE `stu_id`='{$this->UL_IDstu}'";
								if($Count_StuMotherRs=$pdo_conndatastu->query($Count_StuMotherSql)){
									$Count_StuMotherRow=$Count_StuMotherRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($Count_StuMotherRow) && count($Count_StuMotherRow)){
										$count_ds=$Count_StuMotherRow["count_ds"];
											if($count_ds>=1){
												$UpDataStuMotherSql="UPDATE `stu_mother` SET `mother_prefix`='{$PringStuMotherRow["mother_prefix"]}',`mother_fname`='{$PringStuMotherRow["mother_fname"]}',`mother_sname`='{$PringStuMotherRow["mother_sname"]}',`mother_prefix_en`='{$PringStuMotherRow["mother_prefix_en"]}'
												,`mother_fname_en`='{$PringStuMotherRow["mother_fname_en"]}',`mother_sname_en`='{$PringStuMotherRow["mother_sname_en"]}',`mother_code`='{$PringStuMotherRow["mother_code"]}',`mother_blood`='{$PringStuMotherRow["mother_blood"]}'
												,`mother_nation`='{$PringStuMotherRow["mother_nation"]}',`mother_sun`='{$PringStuMotherRow["mother_sun"]}',`mother_IDReligion`='{$PringStuMotherRow["mother_IDReligion"]}',`mother_birthday`='{$PringStuMotherRow["mother_birthday"]}'
												,`mother_career`='{$PringStuMotherRow["mother_career"]}',`mother_careerOther`='{$PringStuMotherRow["mother_careerOther"]}',`mother_study`='{$PringStuMotherRow["mother_study"]}',`mother_salary`='{$PringStuMotherRow["mother_salary"]}'
												,`mother_workplace`='{$PringStuMotherRow["mother_workplace"]}',`mother_wp_pro`='{$PringStuMotherRow["mother_wp_pro"]}',`mother_wp_tel`='{$PringStuMotherRow["mother_wp_tel"]}',`mother_phone`='{$PringStuMotherRow["mother_phone"]}'
												WHERE `stu_id`='{$this->UL_IDstu}'";
													if($pdo_conndatastu->exec($UpDataStuMotherSql)>0){
														$T_UpDataStuMother=1;
													}else{
														$F_UpDataStuMother=1;
													}
											}else{
												$InDataStuMotherSql="INSERT INTO `stu_mother`(`stu_id`, `mother_prefix`, `mother_fname`, `mother_sname`, `mother_prefix_en`, `mother_fname_en`, `mother_sname_en`, `mother_code`, `mother_blood`, `mother_nation`, `mother_sun`, `mother_IDReligion`, `mother_birthday`, `mother_career`, `mother_careerOther`, `mother_study`, `mother_salary`, `mother_workplace`, `mother_wp_pro`, `mother_wp_tel`, `mother_phone`) 
												VALUES ('{$this->UL_IDstu}','{$PringStuMotherRow["mother_prefix"]}','{$PringStuMotherRow["mother_fname"]}','{$PringStuMotherRow["mother_sname"]}','{$PringStuMotherRow["mother_prefix_en"]}','{$PringStuMotherRow["mother_fname_en"]}','{$PringStuMotherRow["mother_sname_en"]}','{$PringStuMotherRow["mother_code"]}','{$PringStuMotherRow["mother_blood"]}','{$PringStuMotherRow["mother_nation"]}','{$PringStuMotherRow["mother_sun"]}','{$PringStuMotherRow["mother_IDReligion"]}','{$PringStuMotherRow["mother_birthday"]}','{$PringStuMotherRow["mother_career"]}','{$PringStuMotherRow["mother_careerOther"]}','{$PringStuMotherRow["mother_study"]}','{$PringStuMotherRow["mother_salary"]}','{$PringStuMotherRow["mother_workplace"]}','{$PringStuMotherRow["mother_wp_pro"]}','{$PringStuMotherRow["mother_wp_tel"]}','{$PringStuMotherRow["mother_phone"]}')";
													if($pdo_conndatastu->exec($InDataStuMotherSql)>0){
														$T_InToStuMother=1;
													}else{
														$F_InToStuMother=1;
													}												
											}
									}else{
//-----------------------------------------------------------------------No Data on the table No Run Array
										$InDataStuMotherSql="INSERT INTO `stu_mother`(`stu_id`, `mother_prefix`, `mother_fname`, `mother_sname`, `mother_prefix_en`, `mother_fname_en`, `mother_sname_en`, `mother_code`, `mother_blood`, `mother_nation`, `mother_sun`, `mother_IDReligion`, `mother_birthday`, `mother_career`, `mother_careerOther`, `mother_study`, `mother_salary`, `mother_workplace`, `mother_wp_pro`, `mother_wp_tel`, `mother_phone`) 
															 VALUES ('{$this->UL_IDstu}','{$PringStuMotherRow["mother_prefix"]}','{$PringStuMotherRow["mother_fname"]}','{$PringStuMotherRow["mother_sname"]}','{$PringStuMotherRow["mother_prefix_en"]}','{$PringStuMotherRow["mother_fname_en"]}','{$PringStuMotherRow["mother_sname_en"]}','{$PringStuMotherRow["mother_code"]}','{$PringStuMotherRow["mother_blood"]}','{$PringStuMotherRow["mother_nation"]}','{$PringStuMotherRow["mother_sun"]}','{$PringStuMotherRow["mother_IDReligion"]}','{$PringStuMotherRow["mother_birthday"]}','{$PringStuMotherRow["mother_career"]}','{$PringStuMotherRow["mother_careerOther"]}','{$PringStuMotherRow["mother_study"]}','{$PringStuMotherRow["mother_salary"]}','{$PringStuMotherRow["mother_workplace"]}','{$PringStuMotherRow["mother_wp_pro"]}','{$PringStuMotherRow["mother_wp_tel"]}','{$PringStuMotherRow["mother_phone"]}')";
											if($pdo_conndatastu->exec($InDataStuMotherSql)>0){
												$T_InToStuMother=1;
											}else{
												$F_InToStuMother=1;
											}
//-----------------------------------------------------------------------No Data on the table No Run Array
									}
								}else{
									//---------------------
								}
						}else{
							//------------------------------------------------------------------------------------
						}
				}else{
					//---------------------------------------------------------------------------------------------
				}
//print_stu_mother End
//print_stu_mother_address
			$PringMotherAddressSql="SELECT * FROM `stu_mother_address` WHERE `stu_id`='{$this->UL_IDReg}';";
				if($PringMotherAddressRs=$pdo_swiprc->query($PringMotherAddressSql)){
					$PringMotherAddressRow=$PringMotherAddressRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringMotherAddressRow) && count($PringMotherAddressRow)){
							$Count_MotherAddressSql="SELECT `stu_id` AS `count_ds` 
												     FROM `stu_mother_address` 
												     WHERE `stu_id`='{$this->UL_IDstu}'";
								if($Count_MotherAddressRs=$pdo_conndatastu->query($Count_MotherAddressSql)){
									$Count_MotherAddressRow=$Count_MotherAddressRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($Count_MotherAddressRow) && count($Count_MotherAddressRow)){
										$count_ds=$Count_MotherAddressRow["count_ds"];
											if($count_ds>=1){
												$UpDataMotherAddressSql="UPDATE `stu_mother_address` SET `mother_hno`='{$PringMotherAddressRow["mother_hno"]}',`mother_moo`='{$PringMotherAddressRow["mother_moo"]}',`mother_moo_name`='{$PringMotherAddressRow["mother_moo_name"]}',`mother_soi`='{$PringMotherAddressRow["mother_soi"]}',`mother_road`='{$PringMotherAddressRow["mother_road"]}'
												,`mother_tumbon`='{$PringMotherAddressRow["mother_tumbon"]}',`mother_amphur`='{$PringMotherAddressRow["mother_amphur"]}',`mother_province`='{$PringMotherAddressRow["mother_province"]}',`mother_zipcode`='{$PringMotherAddressRow["mother_zipcode"]}' 
												WHERE `stu_id`='{$this->UL_IDstu}'";
													if($pdo_conndatastu->exec($UpDataMotherAddressSql)>0){
														$T_UpDataMotherAddress=1;
													}else{
														$F_UpDataMotherAddress=1;
													}
											}else{
												$InDataMotherAddressSql="INSERT INTO `stu_mother_address`(`stu_id`, `mother_hno`, `mother_moo`,`mother_moo_name`, `mother_soi`, `mother_road`, `mother_tumbon`, `mother_amphur`, `mother_province`, `mother_zipcode`) 
												VALUES ('{$this->UL_IDstu}','{$PringMotherAddressRow["mother_hno"]}','{$PringMotherAddressRow["mother_moo"]}','{$PringMotherAddressRow["mother_moo_name"]}','{$PringMotherAddressRow["mother_soi"]}','{$PringMotherAddressRow["mother_road"]}','{$PringMotherAddressRow["mother_tumbon"]}','{$PringMotherAddressRow["mother_amphur"]}','{$PringMotherAddressRow["mother_province"]}','{$PringMotherAddressRow["mother_zipcode"]}')";
													if($pdo_conndatastu->exec($InDataMotherAddressSql)>0){
														$T_InToMotherAddress=1;
													}else{
														$F_InToMotherAddress=1;
													}												
											}
									}else{
//-----------------------------------------------------------------------No Data on the table No Run Array
										$InDataMotherAddressSql="INSERT INTO `stu_mother_address`(`stu_id`, `mother_hno`, `mother_moo`,`mother_moo_name`, `mother_soi`, `mother_road`, `mother_tumbon`, `mother_amphur`, `mother_province`, `mother_zipcode`) 
												                 VALUES ('{$this->UL_IDstu}','{$PringMotherAddressRow["mother_hno"]}','{$PringMotherAddressRow["mother_moo"]}','{$PringMotherAddressRow["mother_moo_name"]}','{$PringMotherAddressRow["mother_soi"]}','{$PringMotherAddressRow["mother_road"]}','{$PringMotherAddressRow["mother_tumbon"]}','{$PringMotherAddressRow["mother_amphur"]}','{$PringMotherAddressRow["mother_province"]}','{$PringMotherAddressRow["mother_zipcode"]}')";
											if($pdo_conndatastu->exec($InDataMotherAddressSql)>0){
												$T_InToMotherAddress=1;
											}else{
												$F_InToMotherAddress=1;
											}	
//-----------------------------------------------------------------------No Data on the table No Run Array
									}
								}else{
									//---------------------
								}
						}else{
							//------------------------------------------------------------------------------------
						}
				}else{
					//---------------------------------------------------------------------------------------------
				}
//print_stu_mother_address End			
//print_stu_mother_addword
			$PringStuMotherAddwordSql="SELECT * FROM `stu_mother_addword` WHERE `stu_id`='{$this->UL_IDReg}';";
				if($PringStuMotherAddwordRs=$pdo_swiprc->query($PringStuMotherAddwordSql)){
					$PringStuMotherAddwordRow=$PringStuMotherAddwordRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($PringStuMotherAddwordRow) && count($PringStuMotherAddwordRow)){
							$Count_StuMotherAddwordSql="SELECT `stu_id` AS `count_ds` 
												        FROM `stu_mother_addword` 
												        WHERE `stu_id`='{$this->UL_IDstu}'";
								if($Count_StuMotherAddwordRs=$pdo_conndatastu->query($Count_StuMotherAddwordSql)){
									$Count_StuMotherAddwordRow=$Count_StuMotherAddwordRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($Count_StuMotherAddwordRow) && count($Count_StuMotherAddwordRow)){
										$count_ds=$Count_StuMotherAddwordRow["count_ds"];
											if($count_ds>=1){
												$UpDataStuMotherAddwordSql="UPDATE `stu_mother_addword` SET `mother_wordhno`='{$PringStuMotherAddwordRow["mother_wordhno"]}',`mother_wordmoo`='{$PringStuMotherAddwordRow["mother_wordmoo"]}',`mother_wordmoo_name`='{$PringStuMotherAddwordRow["mother_wordmoo_name"]}',`mother_wordsoi`='{$PringStuMotherAddwordRow["mother_wordsoi"]}'
												,`mother_wordroad`='{$PringStuMotherAddwordRow["mother_wordroad"]}',`mother_wordtumbon`='{$PringStuMotherAddwordRow["mother_wordtumbon"]}',`mother_wordamphur`='{$PringStuMotherAddwordRow["mother_wordamphur"]}',`mother_wordprovince`='{$PringStuMotherAddwordRow["mother_wordprovince"]}'
												,`mother_wordzipcode`='{$PringStuMotherAddwordRow["mother_wordzipcode"]}' WHERE `stu_id`='{$this->UL_IDstu}'";
													if($pdo_conndatastu->exec($UpDataStuMotherAddwordSql)>0){
														$T_UpDataStuMotherAddword=1;
													}else{
														$F_UpDataStuMotherAddword=1;
													}
											}else{
												$InDataStuMotherAddwordSql="INSERT INTO `stu_mother_addword`(`stu_id`, `mother_wordhno`, `mother_wordmoo`,`mother_wordmoo_name`, `mother_wordsoi`, `mother_wordroad`, `mother_wordtumbon`, `mother_wordamphur`, `mother_wordprovince`, `mother_wordzipcode`) 
												VALUES ('{$this->UL_IDstu}','{$PringStuMotherAddwordRow["mother_wordhno"]}','{$PringStuMotherAddwordRow["mother_wordmoo"]}','{$PringStuMotherAddwordRow["mother_wordmoo_name"]}','{$PringStuMotherAddwordRow["mother_wordsoi"]}','{$PringStuMotherAddwordRow["mother_wordsoi"]}','{$PringStuMotherAddwordRow["mother_wordsoi"]}','{$PringStuMotherAddwordRow["mother_wordroad"]}','{$PringStuMotherAddwordRow["mother_wordtumbon"]}','{$PringStuMotherAddwordRow["mother_wordamphur"]}','{$PringStuMotherAddwordRow["mother_wordprovince"]}','{$PringStuMotherAddwordRow["mother_wordzipcode"]}')";
													if($pdo_conndatastu->exec($InDataStuMotherAddwordSql)>0){
														$T_InToStuMotherAddword=1;
													}else{
														$F_InToStuMotherAddword=1;
													}												
											}
									}else{
//-----------------------------------------------------------------------No Data on the table No Run Array
										$InDataStuMotherAddwordSql="INSERT INTO `stu_mother_addword`(`stu_id`, `mother_wordhno`, `mother_wordmoo`,`mother_wordmoo_name`, `mother_wordsoi`, `mother_wordroad`, `mother_wordtumbon`, `mother_wordamphur`, `mother_wordprovince`, `mother_wordzipcode`) 
										         		            VALUES ('{$this->UL_IDstu}','{$PringStuMotherAddwordRow["mother_wordhno"]}','{$PringStuMotherAddwordRow["mother_wordmoo"]}','{$PringStuMotherAddwordRow["mother_wordmoo_name"]}','{$PringStuMotherAddwordRow["mother_wordsoi"]}','{$PringStuMotherAddwordRow["mother_wordroad"]}','{$PringStuMotherAddwordRow["mother_wordtumbon"]}','{$PringStuMotherAddwordRow["mother_wordamphur"]}','{$PringStuMotherAddwordRow["mother_wordprovince"]}','{$PringStuMotherAddwordRow["mother_wordzipcode"]}')";
											if($pdo_conndatastu->exec($InDataStuMotherAddwordSql)>0){
												$T_InToStuMotherAddword=1;
											}else{
												$F_InToStuMotherAddword=1;
											}
//-----------------------------------------------------------------------No Data on the table No Run Array
									}
								}else{
									//---------------------
								}
						}else{
							//------------------------------------------------------------------------------------
						}
				}else{
					//---------------------------------------------------------------------------------------------
				}
//print_stu_mother_addword End			
//----------------------------------------------------------------------------------------------------------------
			$pdo_admission=null;
			$pdo_student=null;
			$pdo_conndatastu=null;
			if(isset($Count_ReginaStuData,$Count_ReginaStuLogin)){
				$this->Count_ReginaStuData=$Count_ReginaStuData;
				$this->Count_ReginaStuLogin=$Count_ReginaStuLogin;			
			}else{
				//-------------------------------------------------------------------------------------------
			}
		}function Run_ReginaStuData(){
			if(isset($this->Count_ReginaStuData)){
				return $this->Count_ReginaStuData;
			}else{
				//--------------------------------------------------------------
			}
		}function Run_ReginaStuLogin(){
			if(isset($this->Count_ReginaStuLogin)){
				return $this->Count_ReginaStuLogin;
			}else{
				//--------------------------------------------------------------
			}			
		}
	}
//-------------------------------------------------End
*/
?>


















