<?php 
	class IntoUpQuotaRc{//การจัดการสิทธิ์โควตารายบุคคล
		public $IUQR_StuKey,$IUQR_ClassNew,$IUQR_QuotaNew,$IUQR_Year,$IUQR_YearNew;
		public $ErrorQuotaRc;
		function __construct($IUQR_StuKey,$IUQR_ClassNew,$IUQR_QuotaNew,$IUQR_Year,$IUQR_YearNew){
//---------------------------------------------------------------------	
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();				
//---------------------------------------------------------------------	
			$this->IUQR_StuKey=$IUQR_StuKey;
			$this->IUQR_ClassNew=$IUQR_ClassNew;
			$this->IUQR_QuotaNew=$IUQR_QuotaNew;//PlanNew
			$this->IUQR_Year=$IUQR_Year;
			$this->IUQR_YearNew=$IUQR_YearNew;
//---------------------------------------------------------------------
			$DateTime=date("Y-m-d H:i:s");
//---------------------------------------------------------------------
//internal_save_rights
			try{
				$TestInternalSaveRights="SELECT COUNT(`isr_key`) AS `CountSaveRights`
									     FROM `internal_save_rights` 
										 WHERE `isr_key`='{$this->IUQR_StuKey}' 
										 AND `isr_year`='{$this->IUQR_Year}' 
										 AND `isr_YearNew`='{$this->IUQR_YearNew}'";
					if($TestInternalSaveRightsRs=$pdo_quota->query($TestInternalSaveRights)){
						$TestInternalSaveRightsRow=$TestInternalSaveRightsRs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($TestInternalSaveRightsRow) && count($TestInternalSaveRightsRow)){
								$CountSaveRights=$TestInternalSaveRightsRow["CountSaveRights"];
							}else{
								$CountSaveRights=0;
							}
					}else{
						$CountSaveRights=0;
					}
			}catch(PDOException $e){
				$CountSaveRights=0;	
			}
//internal_save_rights End
				if($CountSaveRights>=1){
//internal_save_rights					
					try{
						$EditInternalSaveRightsSql="UPDATE `internal_save_rights` 
										            SET `isr_PlanNew`='{$this->IUQR_QuotaNew}',`isr_MaintainRights`='รักษาสิทธิ์',`isr_MaintainRightsTxT`='',`isr_quota_datetime`='{$DateTime}' 
													WHERE `isr_key`='{$this->IUQR_StuKey}' AND `isr_year`='{$this->IUQR_Year}' AND `isr_YearNew`='{$this->IUQR_YearNew}'";
						$pdo_quota->exec($EditInternalSaveRightsSql);
						$ErrorQuotaRc="Y";						
					}catch(PDOException $e){
						$ErrorQuotaRc="N";
					}
//internal_save_rights End		
						if($ErrorQuotaRc=="Y"){
//delete : quota_request
							try{
								$DeleteQuotaRequestSql="DELETE FROM `quota_request` 
														WHERE `request_stuid`='{$this->IUQR_StuKey}' AND `request_year`='{$this->IUQR_YearNew}' AND `request_level`='{$this->IUQR_ClassNew}'";
								$pdo_quota->exec($DeleteQuotaRequestSql);
								$ErrorQuotaRc="Y";
							}catch(PDOException $e){
								$ErrorQuotaRc="N";
							}
//delete : quota_request End
//delete : quota_right
							try{
								$DeleteQuotaRightSql="DELETE FROM `quota_right` 
													  WHERE `qr_stuid`='{$this->IUQR_StuKey}' AND `qr_year`='{$this->IUQR_YearNew}' AND `qr_level`='{$this->IUQR_ClassNew}'";
								$pdo_quota->exec($DeleteQuotaRightSql);
								$ErrorQuotaRc="Y";
							}catch(PDOException $e){
								$ErrorQuotaRc="N";
							}
//delete : quota_right End		
//delete : quota_thetest
							try{
								$DeleteQuotaThetestSql="DELETE FROM `quota_thetest` WHERE `qtt_sud`='{$this->IUQR_StuKey}' AND `qtt_year`='{$this->IUQR_YearNew}'";
								$pdo_quota->exec($DeleteQuotaThetestSql);
								$ErrorQuotaRc="Y";
							}catch(PDOException $e){
								$ErrorQuotaRc="N";
							}
//delete : quota_thetest End
							if($ErrorQuotaRc=="Y"){
//InTo : quota_right
								try{
									$IntoQuotaRightSql="INSERT INTO `quota_right`(`qr_stuid`, `qr_year`, `qr_level`, `qr_plan`, `qr_datetime`)
														VALUES ('{$this->IUQR_StuKey}','{$this->IUQR_YearNew}','{$this->IUQR_ClassNew}','{$this->IUQR_QuotaNew}','{$DateTime}')";
									$pdo_quota->exec($IntoQuotaRightSql);
									$ErrorQuotaRc="Y";
								}catch(PDOException $e){
									$ErrorQuotaRc="N";
								}
//InTo : quota_right					
							}else{
								$ErrorQuotaRc="N";
							}
						}else{
							$ErrorQuotaRc="N";
						}
				}else{

//delete : quota_request
					try{
						$DeleteQuotaRequestSql="DELETE FROM `quota_request` 
												WHERE `request_stuid`='{$this->IUQR_StuKey}' AND `request_year`='{$this->IUQR_YearNew}' AND `request_level`='{$this->IUQR_ClassNew}'";
						$pdo_quota->exec($DeleteQuotaRequestSql);
						$ErrorQuotaRc="Y";
					}catch(PDOException $e){
						$ErrorQuotaRc="N";
					}
//delete : quota_request End					
//delete : quota_right
					try{
						$DeleteQuotaRightSql="DELETE FROM `quota_right` 
											  WHERE `qr_stuid`='{$this->IUQR_StuKey}' AND `qr_year`='{$this->IUQR_YearNew}' AND `qr_level`='{$this->IUQR_ClassNew}'";
						$pdo_quota->exec($DeleteQuotaRightSql);
						$ErrorQuotaRc="Y";
					}catch(PDOException $e){
						$ErrorQuotaRc="N";
					}
//delete : quota_right End	
//delete : quota_thetest
					try{
						$DeleteQuotaThetestSql="DELETE FROM `quota_thetest` WHERE `qtt_sud`='{$this->IUQR_StuKey}' AND `qtt_year`='{$this->IUQR_YearNew}'";
						$pdo_quota->exec($DeleteQuotaThetestSql);
						$ErrorQuotaRc="Y";
					}catch(PDOException $e){
						$ErrorQuotaRc="N";
					}
//delete : quota_thetest End
						if($ErrorQuotaRc=="Y"){
//InTo : quota_right
							try{
								$IntoQuotaRightSql="INSERT INTO `quota_right`(`qr_stuid`, `qr_year`, `qr_level`, `qr_plan`, `qr_datetime`)
														VALUES ('{$this->IUQR_StuKey}','{$this->IUQR_YearNew}','{$this->IUQR_ClassNew}','{$this->IUQR_QuotaNew}','{$DateTime}')";
								$pdo_quota->exec($IntoQuotaRightSql);
								$ErrorQuotaRc="Y";
							}catch(PDOException $e){
								$ErrorQuotaRc="N";
							}
//InTo : quota_right					
						}else{
							$ErrorQuotaRc="N";
						}	
//Management : quota_capital
						try{
							$CountQuotaCapitalSql="SELECT COUNT(`qc_stuid`) AS `test_capital` FROM `quota_capital` WHERE `qc_stuid`='{$this->IUQR_StuKey}' AND `qc_year`='{$this->IUQR_YearNew}' AND `qc_level`='{$this->IUQR_ClassNew}'";
							$CountQuotaCapitalRs=$pdo_quota->query($CountQuotaCapitalSql);
							$CountQuotaCapitalRow=$CountQuotaCapitalRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($CountQuotaCapitalRow) && count($CountQuotaCapitalRow)){
									$test_capital=$CountQuotaCapitalRow["test_capital"];
								}else{
									$test_capital=0;
								}
						}catch(PDOException $e){
							$test_capital=0;
						}	
						if($test_capital>=1){
							try{
								$UpQuotaCapitalSql="UPDATE `quota_capital` SET `qc_plan`='{$this->IUQR_QuotaNew}' WHERE `qc_stuid`='{$this->IUQR_StuKey}' AND `qc_year`='{$this->IUQR_YearNew}' AND `qc_level`='{$this->IUQR_ClassNew}'";
								$pdo_quota->exec($UpQuotaCapitalSql);	
								$ErrorQuotaRc="Y";				
							}catch(PDOException $e){
								$ErrorQuotaRc="N";
							}
						}else{
							//--------------------------------------------------------------------
						}
//Management : quota_capital End
				}
//---------------------------------------------------------------------
			if(isset($ErrorQuotaRc)){
				$this->ErrorQuotaRc=$ErrorQuotaRc;
				$pdo_quota=null;
			}else{
				$pdo_quota=null;
			}
		}function RunIntoUpQuotaRc(){
			if(isset($this->ErrorQuotaRc)){
				return $this->ErrorQuotaRc;
			}else{}
		}
	}
?>



<?php 
	class ShowDeleteTheTest{
		public $SDTT_Key,$SDTT_Year,$SDTT_Class,$SDTT_Plan,$SDTT_Type;
		function __construct($SDTT_Key,$SDTT_Year,$SDTT_Class,$SDTT_Plan,$SDTT_Type){
//---------------------------------------------------------------------	
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();				
//---------------------------------------------------------------------		
			$this->SDTT_Key=$SDTT_Key;
			$this->SDTT_Year=$SDTT_Year;
			$this->SDTT_Class=$SDTT_Class;
			$this->SDTT_Plan=$SDTT_Plan;
			$this->SDTT_Type=$SDTT_Type;
//---------------------------------------------------------------------			
				if($this->SDTT_Type=="Eackspace"){
					try{
						$DeleteTheTestSql="DELETE FROM `quota_thetest` 
										   WHERE `qtt_sud`='{$this->SDTT_Key}' 
								           AND `qtt_year`='{$this->SDTT_Year}'";
						$pdo_quota->exec($DeleteTheTestSql);
						$ErrorDelete="Y";
					}catch(PDOException $e){
						$ErrorDelete="N";
					}
				}elseif($this->SDTT_Type=="ShowDate"){
					$ShowTheTestArray=array();
					try{
						$ShowTheTestSql="SELECT * FROM `quota_thetest` 
										 WHERE `qtt_sud`='{$this->SDTT_Key}' 
										 AND `qtt_year`='{$this->SDTT_Year}' 
										 and `qtt_class`='{$this->SDTT_Class}'";
							if($ShowTheTestRs=$pdo_quota->query($ShowTheTestSql)){
								while($ShowTheTestRow=$ShowTheTestRs->Fetch(PDO::FETCH_ASSOC)){
									if(is_array($ShowTheTestRow) && count($ShowTheTestRow)){
										$ShowTheTestArray[]=$ShowTheTestRow;
										$ErrorDelete="Y";
									}else{
										$ShowTheTestArray[]="-";
										$ErrorDelete="N";
									}
								}
							}else{
								$ShowTheTestArray[]="-";
								$ErrorDelete="N";
							}
					}catch(PDOException $e){
						$ShowTheTestArray[]="-";
						$ErrorDelete="N";						
					}
				}else{
					$ErrorDelete="N";
					$ShowTheTestArray[]="-";
				}
			
				if(isset($ErrorDelete,$ShowTheTestArray)){
					$this->ErrorDelete=$ErrorDelete;
					$this->ShowTheTestArray=$ShowTheTestArray;
					$pdo_quota=null;
				}else{
					$pdo_quota=null;
				}
			
		}function RunDeleteTheTest(){
			if(isset($this->ErrorDelete)){
				return $this->ErrorDelete;
			}else{}
		}function RunShowTheTest(){
			if(isset($this->ShowTheTestArray)){
				return $this->ShowTheTestArray;
			}else{}			
		}
	}
?>


<?php
	class IntoTheTest{
		public $ITT_SudKey,$ITT_Class,$ITT_Plan,$ITT_Year;
		function __construct($ITT_SudKey,$ITT_Class,$ITT_Plan,$ITT_Year){
//---------------------------------------------------------------------	
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();				
//---------------------------------------------------------------------
			$this->ITT_SudKey=$ITT_SudKey;
			$this->ITT_Class=$ITT_Class;
			$this->ITT_Plan=$ITT_Plan;
			$this->ITT_Year=$ITT_Year;
//---------------------------------------------------------------------	
			$IntoTheTestYear=date("y");
			$IntoTheTestYear=$IntoTheTestYear+44;
			$IntoTheTestError="N";
//------------------IntoTheTest---------------------------------------------------	
			try{
				$IntoTheTestSql="SELECT COUNT(`qtt_id`) AS `count_qtt` FROM `quota_thetest` 
								 WHERE `qtt_year`='{$this->ITT_Year}' and `qtt_plan`='{$this->ITT_Plan}' and `qtt_class`='{$this->ITT_Class}';";
					if($IntoTheTestRs=$pdo_quota->query($IntoTheTestSql)){
						$IntoTheTestRow=$IntoTheTestRs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($IntoTheTestRow) && count($IntoTheTestRow)){
								$count_qtt=$IntoTheTestRow["count_qtt"];
								$count_qtt=$count_qtt+1;
							}else{
								$count_qtt="-";
							}
					}else{
						$count_qtt="-";
					}
			}catch(PDOException $e){
				$count_qtt="-";
			}
				if($count_qtt=="-"){
					$IntoTheTestError="N";
				}else{
		
					try{
						$QuotaTheTypeSql="SELECT `qtty_teston`,`qtty_id`
										  FROM `quota_thetype` 
										  WHERE `qtty_class`='{$this->ITT_Class}' 
										  AND `qtty_plan`='{$this->ITT_Plan}'";
							if($QuotaTheTypeRs=$pdo_quota->query($QuotaTheTypeSql)){
								$QuotaTheTypeRow=$QuotaTheTypeRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($QuotaTheTypeRow) && count($QuotaTheTypeRow)){
										$qtty_teston=$QuotaTheTypeRow["qtty_teston"];
										$qtty_id=$QuotaTheTypeRow["qtty_id"];
									}else{
										$qtty_teston="00";
										$qtty_id="00";
									}
							}else{
								$qtty_teston="00";
								$qtty_id="00";
							}						
					}catch(PDOException $e){
						$qtty_teston="00";
						$qtty_id="00";
					}
					
						if($count_qtt<=9){
							$TestKey=$IntoTheTestYear.$qtty_teston."00".$count_qtt;
						}elseif($count_qtt<=99){
							$TestKey=$IntoTheTestYear.$qtty_teston."0".$count_qtt;
						}else{
							$TestKey=$IntoTheTestYear.$qtty_teston.$count_qtt;
						}
					
							try{
								$QuotaTheCheckA="SELECT COUNT(`qtt_sud`) AS `Count_Qtt` 
												 FROM `quota_thetest` 
												 WHERE `qtt_id`='{$TestKey}' 
												 AND `qtt_year`='{$this->ITT_Year}' 
												 AND `qtt_class`='{$this->ITT_Class}' 
												 AND `qtt_plan`='{$this->ITT_Plan}'";
									if($QuotaTheCheckRs=$pdo_quota->query($QuotaTheCheckA)){
										$QuotaTheCheckRow=$QuotaTheCheckRs->Fetch(PDO::FETCH_ASSOC);
											if(is_array($QuotaTheCheckRow) && count($QuotaTheCheckRow)){
												$CountQtt=$QuotaTheCheckRow["Count_Qtt"];
											}else{
												$CountQtt=0;
											}
									}else{
										$CountQtt=0;
									}
							}catch(PDOException $e){
								$CountQtt=0;
							}
							
							while($CountQtt>=1){
								
								$count_qtt=$count_qtt+1;
									if($count_qtt<=9){
										$TestKey=$IntoTheTestYear.$qtty_teston."00".$count_qtt;
									}elseif($count_qtt<=99){
										$TestKey=$IntoTheTestYear.$qtty_teston."0".$count_qtt;
									}else{
										$TestKey=$IntoTheTestYear.$qtty_teston.$count_qtt;
									}
									
									try{
										$QuotaTheCheckA="SELECT COUNT(`qtt_sud`) AS `Count_Qtt` 
														 FROM `quota_thetest` 
														 WHERE `qtt_id`='{$TestKey}' 
														 AND `qtt_year`='{$this->ITT_Year}' 
														 AND `qtt_class`='{$this->ITT_Class}' 
														 AND `qtt_plan`='{$this->ITT_Plan}'";
											if($QuotaTheCheckRs=$pdo_quota->query($QuotaTheCheckA)){
												$QuotaTheCheckRow=$QuotaTheCheckRs->Fetch(PDO::FETCH_ASSOC);
													if(is_array($QuotaTheCheckRow) && count($QuotaTheCheckRow)){
														$CountQtt=$QuotaTheCheckRow["Count_Qtt"];
													}else{
														$CountQtt=0;
													}
											}else{
												$CountQtt=0;
											}
									}catch(PDOException $e){
										$CountQtt=0;
									}
								
							}
//---------------------------------------------------------------------							
//---------------------------------------------------------------------							
						try{
							$quota_thetestSql="INSERT INTO `quota_thetest` (`qtt_id`, `qtt_sud`, `qtt_year`, `qtt_plan`, `qtt_class`, `qtty_id`) 
											   VALUES ('{$TestKey}', '{$this->ITT_SudKey}', '{$this->ITT_Year}', '{$this->ITT_Plan}', '{$this->ITT_Class}', '{$qtty_id}');";
							$pdo_quota->exec($quota_thetestSql);
							$IntoTheTestError="Y";
						}catch(PDOException $e){
							$IntoTheTestError="N";
						}
						
				}
			
			if(isset($IntoTheTestError)){
				$this->IntoTheTestError=$IntoTheTestError;
				$pdo_quota=null;
			}else{
				$pdo_quota=null;
			}

		}function RunIntoTheTest(){
			if(isset($this->IntoTheTestError)){
				return $this->IntoTheTestError;
			}else{}
		}
	}
?>



<?php
	class CancelForm{
		public $CF_Key,$CF_Year,$CF_YearNew;
		function __construct($CF_Key,$CF_Year,$CF_YearNew){
//---------------------------------------------------------------------	
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();				
//---------------------------------------------------------------------			
			$this->CF_Key=$CF_Key;
			$this->CF_Year=$CF_Year;
			$this->CF_YearNew=$CF_YearNew;
//---------------------------------------------------------------------
			$Error_Delete="NoDelete";
//---------------------------------------------------------------------
				try{
					$TestQuotaRequestSql="SELECT COUNT(`request_stuid`) AS `COUNT_USE` 
										  FROM `quota_request` 
										  WHERE `request_stuid`='{$this->CF_Key}' 
										  AND `request_year`='{$this->CF_YearNew}';";
						if($TestQuotaRequestRs=$pdo_quota->query($TestQuotaRequestSql)){
							$TestQuotaRequestRow=$TestQuotaRequestRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($TestQuotaRequestRow) && count($TestQuotaRequestRow)){
									$count_use=$TestQuotaRequestRow["COUNT_USE"];
								}else{
									$count_use=0;
								}
						}else{
							$count_use=0;
						}
				}catch(PDOException $e){
					$count_use=0;
				}
				
				if($count_use>=1){
					$Error_Delete="NoDelete";
				}else{
				
					try{
						$internalSaveRightsSql="DELETE FROM `internal_save_rights` 
												WHERE `isr_key`='{$this->CF_Key}' 
												AND `isr_year`='{$this->CF_Year}' 
												AND `isr_YearNew`='{$this->CF_YearNew}'";
						$pdo_quota->exec($internalSaveRightsSql);
						$Error_Delete="Delete";
					}catch(PDOException $e){
						$Error_Delete="NoDelete";
					}
					
					try{
						$QotaRightSql="DELETE FROM `quota_right`
									   WHERE `qr_stuid`='{$this->CF_Key}' 
									   AND `qr_year`='{$this->CF_YearNew}'";
						$pdo_quota->exec($QotaRightSql);	
						$Error_Delete="Delete";						
					}catch(PDOException $e){
						$Error_Delete="NoDelete";		
					}
				
				}
				
				if(isset($Error_Delete)){
					$this->Error_Delete=$Error_Delete;
					$pdo_quota=null;
				}else{
					$pdo_quota=null;
				}
		}function RunCancelForm(){
			if(isset($this->Error_Delete)){
				return $this->Error_Delete;
			}else{}
		}
	}
	
?>



<?php
	class PrintQuotaRequest{
		public $PQR_key,$PQR_year,$PQR_level;
		function __construct($PQR_key,$PQR_year,$PQR_level){
//---------------------------------------------------------------------	
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();				
//---------------------------------------------------------------------	
			$this->PQR_key=$PQR_key;
			$this->PQR_year=$PQR_year;
			$this->PQR_level=$PQR_level;
//---------------------------------------------------------------------		
			$quota_requestSql="select `quota_request`.`request_stuid`,`quota_request`.`request_year`, `quota_request`.`request_level`
						     ,`quota_request`.`requset_datetime`,`quota_request`.`qr_stuid`,`quota_request`.`qce_key`
							   from `quota_request` LEFT join `rc_level` 
							   on (`quota_request`.`request_level`=`rc_level`.`IDLevel`)
							   where  `quota_request`.`request_stuid`='{$this->PQR_key}' 
							   and `quota_request`.`request_year`='{$this->PQR_year}'
							   and `quota_request`.`request_level`='{$this->PQR_level}'";
				if($quota_requestRs=$pdo_quota->query($quota_requestSql)){
					$quota_requestRow=$quota_requestRs->Fetch(PDO::FETCH_ASSOC);
					if(is_array($quota_requestRow) && count ($quota_requestRow)){
						$Request_stuid=$quota_requestRow["request_stuid"];
						$Request_year=$quota_requestRow["request_year"];
						$Request_level=$quota_requestRow["request_level"];
						$Request_datetime=$quota_requestRow["requset_datetime"];
						$Request_qr_stuid=$quota_requestRow["qr_stuid"];
						$Request_qce_key=$quota_requestRow["qce_key"];
						$PQR_system="yes";
//------------------------------------------------------------------------------------------						
					}else{
						$Request_stuid=null;
						$Request_year=null;
						$Request_level=null;
						$Request_datetime=null;
						$Request_qr_stuid=null;
						$Request_qce_key=null;
//------------------------------------------------------------------------------------------
						$PQR_system="no";
//------------------------------------------------------------------------------------------						
					}
				}else{
					$Request_stuid=null;
					$Request_year=null;
					$Request_level=null;
					$Request_datetime=null;
					$Request_qr_stuid=null;
					$Request_qce_key=null;
//------------------------------------------------------------------------------------------
					$PQR_system="no";
//------------------------------------------------------------------------------------------					
				}
				
				if(isset($Request_stuid)){
					$this->Request_stuid=$Request_stuid;
					$this->Request_year=$Request_year;
					$this->Request_level=$Request_level;
					$this->Request_datetime=$Request_datetime;
					$this->Request_qr_stuid=$Request_qr_stuid;
					$this->Request_qce_key=$Request_qce_key;
					$this->PQR_system=$PQR_system;
					$pdo_quota=null;
				}else{
					$pdo_quota=null;
				}
		}function __destruct(){
			if(isset($this->Request_stuid)){
				$this->Request_stuid;
				$this->Request_year;
				$this->Request_level;
				$this->Request_datetime;
				$this->Request_qr_stuid;
				$this->Request_qce_key;
				$this->PQR_system;
			}else{
				//-------------------------------------------
			}
		}
	}
?>

<?php
	class InUpSendDocuments{
		public $IUSD_key,$IUSD_year,$IUSD_sd_send_documents,$IUSD_SdStudentIDCard,$IUSD_SdParentIDCard,$IUSD_surrender,$IUSD_FinancialDocuments;
		function __construct($IUSD_key,$IUSD_year,$IUSD_sd_send_documents,$IUSD_SdStudentIDCard,$IUSD_SdParentIDCard,$IUSD_surrender,$IUSD_FinancialDocuments){
//---------------------------------------------------------------------	
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();				
//---------------------------------------------------------------------	
			$this->IUSD_key=$IUSD_key;
			$this->IUSD_year=$IUSD_year;
			$this->IUSD_sd_send_documents=$IUSD_sd_send_documents;
			$this->IUSD_SdStudentIDCard=$IUSD_SdStudentIDCard;
			$this->IUSD_SdParentIDCard=$IUSD_SdParentIDCard;
			$this->IUSD_surrender=$IUSD_surrender;
			$this->IUSD_FinancialDocuments=$IUSD_FinancialDocuments;
//---------------------------------------------------------------------	
			$CountSendDocumentsSql="SELECT COUNT(`sd_key`) AS `SendDocumentsCount`
									FROM `send_documents` 
									WHERE `sd_key`='{$this->IUSD_key}' 
									AND `sd_year`='{$this->IUSD_year}'";
				if($CountSendDocumentsRs=$pdo_quota->query($CountSendDocumentsSql)){
					$CountSendDocumentRow=$CountSendDocumentsRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($CountSendDocumentRow) && count($CountSendDocumentRow)){
							$SendDocumentsCount=$CountSendDocumentRow["SendDocumentsCount"];
								if($SendDocumentsCount>=1){
//Updata--------------------------------------------------------------
									try{
										$UpDataSendDocumentsSql="UPDATE `send_documents` SET `sd_send_documents`='{$this->IUSD_sd_send_documents}',`SdStudentIDCard`='{$this->IUSD_SdStudentIDCard}',`SdParentIDCard`='{$this->IUSD_SdParentIDCard}',`sd_surrender`='{$this->IUSD_surrender}',`sd_financial_documents`='{$this->IUSD_FinancialDocuments}'
															     WHERE `sd_key`='{$this->IUSD_key}' AND `sd_year`='{$this->IUSD_year}'";
										$pdo_quota->exec($UpDataSendDocumentsSql);
										$SystemSendDocuments="Yes";
									}catch(PDOException $e){
										$SystemSendDocuments="No";
									}
//Updata End----------------------------------------------------------									
								}else{
//Into data-----------------------------------------------------------		
									try{
										$InToSendDocumentsSql="INSERT INTO `send_documents`(`sd_key`, `sd_year`, `sd_send_documents`, `SdStudentIDCard`, `SdParentIDCard` ,`sd_surrender` ,`sd_financial_documents`) 
															   VALUES ('{$this->IUSD_key}','{$this->IUSD_year}','{$this->IUSD_sd_send_documents}','{$this->IUSD_SdStudentIDCard}','{$this->IUSD_SdParentIDCard}','{$this->IUSD_surrender}','{$this->IUSD_FinancialDocuments}')";
										$pdo_quota->exec($InToSendDocumentsSql);
										$SystemSendDocuments="Yes";
									}catch(PDOException $e){
										$SystemSendDocuments="No";
									}									
//Into data End-------------------------------------------------------									
								}
						}else{
							$SystemSendDocuments="Error";
						}
				}else{
					$SystemSendDocuments="Error";					
				}
				if(isset($SystemSendDocuments)){
					$this->SystemSendDocuments=$SystemSendDocuments;
				}else{
//---------------------------------------------------------------------					
				}
				$pdo_quota=null;
		}function RunIntoUpdataSendDocuments(){
			if(isset($this->SystemSendDocuments)){
				return $this->SystemSendDocuments;
			}else{
//---------------------------------------------------------------------				
			}
		}
	}
?>


<?php
	class PrintSendDocuments{
		public $PSD_key,$PSD_year;
		function __construct($PSD_key,$PSD_year){
//---------------------------------------------------------------------	
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();				
//---------------------------------------------------------------------			
			$PSD_data=array();
			$this->PSD_key=$PSD_key;
			$this->PSD_year=$PSD_year;
			$PSDsql="SELECT `sd_key`, `sd_year`, `sd_send_documents`, `SdStudentIDCard`, `SdParentIDCard`, `sd_surrender`, `sd_financial_documents` 
				     FROM `send_documents` 
					 WHERE `sd_key`='{$this->PSD_key}' 
					 AND `sd_year`='{$this->PSD_year}'";
				if($PSDrs=$pdo_quota->query($PSDsql)){
					$PSDrow=$PSDrs->Fetch(PDO::FETCH_ASSOC);
					if(is_array($PSDrow) && count($PSDrow)){
						$PSD_data[]=$PSDrow;
					}else{
						$PSD_data=null;
					}
				}else{
					$PSD_data=null;
				}
				if(isset($PSD_data)){
					$this->PSD_data=$PSD_data;
				}else{
//---------------------------------------------------------------------					
				}
			$pdo_quota=null;
		}function RowArraySendDocuments(){
			if(isset($this->PSD_data)){
				return $this->PSD_data;
			}else{
//---------------------------------------------------------------------				
			}
		}
	}
?>

<?php
	class PrintInternalSaveRights{
		public $RISR_Key,$RISR_Year,$RISR_MaintainRights;
		function __construct($RISR_Key,$RISR_Year,$RISR_MaintainRights){
//---------------------------------------------------------------------	
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();				
//---------------------------------------------------------------------	
			$this->RISR_Key=$RISR_Key;
			$this->RISR_Year=$RISR_Year;
			$this->RISR_MaintainRights=$RISR_MaintainRights;
			$InternalSaveRightsSql="SELECT `isr_key`,`isr_year`,`isr_YearNew`,`isr_ClassNew`,`isr_PlanNew`,`isr_MaintainRights`
								  ,`isr_MaintainRightsTxT`,`isr_quota_np`,`isr_quota_name`,`isr_quota_surname`,`isr_quota_phone`
								  ,`isr_quota_relationship`,`isr_quota_datetime` 
									FROM `internal_save_rights` 
									WHERE `isr_key`='{$this->RISR_Key}' 
									AND `isr_year`='{$this->RISR_Year}' 
									AND `isr_MaintainRights`='{$this->RISR_MaintainRights}'";
				if($InternalSaveRightsRs=$pdo_quota->query($InternalSaveRightsSql)){
					$InternalSaveRightsRow=$InternalSaveRightsRs->Fetch(PDO::FETCH_ASSOC);
					if(is_array($InternalSaveRightsRow) && count($InternalSaveRightsRow)){
						$ISR_isr_key=$InternalSaveRightsRow["isr_key"];
						$ISR_isr_year=$InternalSaveRightsRow["isr_year"];
						$ISR_isr_YearNew=$InternalSaveRightsRow["isr_YearNew"];
						$ISR_isr_ClassNew=$InternalSaveRightsRow["isr_ClassNew"];
						$ISR_isr_PlanNew=$InternalSaveRightsRow["isr_PlanNew"];
						$ISR_isr_MaintainRights=$InternalSaveRightsRow["isr_MaintainRights"];
						$ISR_isr_MaintainRightsTxT=$InternalSaveRightsRow["isr_MaintainRightsTxT"];
						$ISR_isr_quota_np=$InternalSaveRightsRow["isr_quota_np"];
						$ISR_isr_quota_name=$InternalSaveRightsRow["isr_quota_name"];
						$ISR_isr_quota_surname=$InternalSaveRightsRow["isr_quota_surname"];
						$ISR_isr_quota_phone=$InternalSaveRightsRow["isr_quota_phone"];
						$ISR_isr_quota_relationship=$InternalSaveRightsRow["isr_quota_relationship"];
						$ISR_isr_quota_datetime=$InternalSaveRightsRow["isr_quota_datetime"];
					}else{
						$ISR_isr_key=null;
						$ISR_isr_year=null;
						$ISR_isr_YearNew=null;
						$ISR_isr_ClassNew=null;
						$ISR_isr_PlanNew=null;
						$ISR_isr_MaintainRights=null;
						$ISR_isr_MaintainRightsTxT=null;
						$ISR_isr_quota_np=null;
						$ISR_isr_quota_name=null;
						$ISR_isr_quota_surname=null;
						$ISR_isr_quota_phone=null;
						$ISR_isr_quota_relationship=null;
						$ISR_isr_quota_datetime=null;						
					}
				}else{
					$ISR_isr_key=null;
					$ISR_isr_year=null;
					$ISR_isr_YearNew=null;
					$ISR_isr_ClassNew=null;
					$ISR_isr_PlanNew=null;
					$ISR_isr_MaintainRights=null;
					$ISR_isr_MaintainRightsTxT=null;
					$ISR_isr_quota_np=null;
					$ISR_isr_quota_name=null;
					$ISR_isr_quota_surname=null;
					$ISR_isr_quota_phone=null;
					$ISR_isr_quota_relationship=null;
					$ISR_isr_quota_datetime=null;
				}
				if(isset($ISR_isr_key,$ISR_isr_year)){
					$this->ISR_isr_key=$ISR_isr_key;
					$this->ISR_isr_year=$ISR_isr_year;
					$this->ISR_isr_YearNew=$ISR_isr_YearNew;
					$this->ISR_isr_ClassNew=$ISR_isr_ClassNew;
					$this->ISR_isr_PlanNew=$ISR_isr_PlanNew;
					$this->ISR_isr_MaintainRights=$ISR_isr_MaintainRights;
					$this->ISR_isr_MaintainRightsTxT=$ISR_isr_MaintainRightsTxT;
					$this->ISR_isr_quota_np=$ISR_isr_quota_np;
					$this->ISR_isr_quota_name=$ISR_isr_quota_name;
					$this->ISR_isr_quota_surname=$ISR_isr_quota_surname;
					$this->ISR_isr_quota_phone=$ISR_isr_quota_phone;
					$this->ISR_isr_quota_relationship=$ISR_isr_quota_relationship;
					$this->ISR_isr_quota_datetime=$ISR_isr_quota_datetime;
				}else{
//---------------------------------------------------------------------					
				}
				$pdo_quota=null;
		}function __destruct(){
			if(isset($this->ISR_isr_key,$this->ISR_isr_year)){
				$this->ISR_isr_key;
				$this->ISR_isr_year;
				$this->ISR_isr_YearNew;
				$this->ISR_isr_ClassNew;
				$this->ISR_isr_PlanNew;
				$this->ISR_isr_MaintainRights;
				$this->ISR_isr_MaintainRightsTxT;
				$this->ISR_isr_quota_np;
				$this->ISR_isr_quota_name;
				$this->ISR_isr_quota_surname;
				$this->ISR_isr_quota_phone;
				$this->ISR_isr_quota_relationship;
				$this->ISR_isr_quota_datetime;				
			}else{
//---------------------------------------------------------------------				
			}
		}
	}
?>



<?php
	class Run_quota_capital{
		public $qc_key,$qc_year,$qc_class;
		function __construct($qc_key,$qc_year,$qc_class){
//---------------------------------------------------------------------	
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();				
//---------------------------------------------------------------------	
			$this->qc_key=$qc_key;
			$this->qc_year=$qc_year;
			$this->qc_class=$qc_class;
//---------------------------------------------------------------------			
			try{
				$quota_capitalSql="SELECT `quota_capital_status`.`qcs_txt`,`quota_capital_status`.`qcs_key` 
								   FROM `quota_capital` LEFT JOIN `quota_capital_status` on (`quota_capital`.`qcs_key`=`quota_capital_status`.`qcs_key`)
								   WHERE `qc_stuid`='{$this->qc_key}'
								   AND `qc_year`='{$this->qc_year}' 
								   AND `qc_level`='{$this->qc_class}'";
					if($quota_capitalRs=$pdo_quota->query($quota_capitalSql)){
						$quota_capitalRow=$quota_capitalRs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($quota_capitalRow) && count($quota_capitalRow)){
								$qc_qcs_txt=$quota_capitalRow["qcs_txt"];
								$qc_qcs_key=$quota_capitalRow["qcs_key"];
							}else{
								$qc_qcs_txt="-";
								$qc_qcs_key="-";
							}
					}else{
						$qc_qcs_txt="-";
						$qc_qcs_key="-";
					}	
			}catch(PDOException $e){
				$qc_qcs_txt="-";
				$qc_qcs_key="-";
			}
				if(isset($qc_qcs_txt)){
					$this->qc_qcs_txt=$qc_qcs_txt;
					$this->qc_qcs_key=$qc_qcs_key;
					$pdo_quota=null;					
				}else{
					$pdo_quota=null;
				}
		}function Print_quota_capital(){
			if(isset($this->qc_qcs_txt)){
				return $this->qc_qcs_txt;
			}else{
//---------------------------------------------------------------------				
			}
		}function Print_quota_capital_key(){
			if(isset($this->qc_qcs_key)){
				return $this->qc_qcs_key;
			}else{
//---------------------------------------------------------------------				
			}			
		}
	}
?>


<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	class InternalSaveRightsInto{
		public 	$isr_key,$isr_year,$isr_YearNew,$isr_ClassNew,$isr_PlanNew,$isr_MaintainRights,$isr_MaintainRightsTxT,$isr_quota_np,$isr_quota_name,$isr_quota_surname,$isr_quota_phone,$isr_quota_relationship,$isr_quota_datetime;
		function __construct($isr_key,$isr_year,$isr_YearNew,$isr_ClassNew,$isr_PlanNew,$isr_MaintainRights,$isr_MaintainRightsTxT,$isr_quota_np,$isr_quota_name,$isr_quota_surname,$isr_quota_phone,$isr_quota_relationship,$isr_quota_datetime){
//---------------------------------------------------------------------	
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();				
//---------------------------------------------------------------------	
			$this->isr_key=$isr_key;
			$this->isr_year=$isr_year;
			$this->isr_YearNew=$isr_YearNew;
			$this->isr_ClassNew=$isr_ClassNew;
			$this->isr_PlanNew=$isr_PlanNew;
			$this->isr_MaintainRights=$isr_MaintainRights;
			$this->isr_MaintainRightsTxT=$isr_MaintainRightsTxT;
			$this->isr_quota_np=$isr_quota_np;
			$this->isr_quota_name=$isr_quota_name;
			$this->isr_quota_surname=$isr_quota_surname;
			$this->isr_quota_phone=$isr_quota_phone;
			$this->isr_quota_relationship=$isr_quota_relationship;
			$this->isr_quota_datetime=date("Y-m-d H:i:s",strtotime($isr_quota_datetime));
//---------------------------------------------------------------------	
			try{
				$InternalSaveRightsIntoSql="INSERT INTO `internal_save_rights`(`isr_key`, `isr_year`, `isr_YearNew`, `isr_ClassNew`, `isr_PlanNew`, `isr_MaintainRights`, `isr_MaintainRightsTxT`, `isr_quota_np`, `isr_quota_name`, `isr_quota_surname`, `isr_quota_phone`, `isr_quota_relationship`,`isr_quota_datetime`) 
										    VALUES ('{$this->isr_key}','{$this->isr_year}','{$this->isr_YearNew}','{$this->isr_ClassNew}','{$this->isr_PlanNew}','{$this->isr_MaintainRights}','{$this->isr_MaintainRightsTxT}','{$this->isr_quota_np}','{$this->isr_quota_name}','{$this->isr_quota_surname}','{$this->isr_quota_phone}','{$this->isr_quota_relationship}','{$this->isr_quota_datetime}')";
				$pdo_quota->exec($InternalSaveRightsIntoSql);
				$InternalSaveRightsIntoDate="Yes";
			}catch(PDOException $e){
				$InternalSaveRightsIntoDate="No";
			}
			if(isset($InternalSaveRightsIntoDate)){
				$this->InternalSaveRightsIntoDate=$InternalSaveRightsIntoDate;
			}else{
//---------------------------------------------------------------------
			}
			$pdo_quota=null;
		}function RunInternalSaveRightsInto(){
			if(isset($this->InternalSaveRightsIntoDate)){
				return $this->InternalSaveRightsIntoDate;
			}else{
//---------------------------------------------------------------------				
			}
		}
	}
?>

<?php
	class InternalSaveRightsDelete{
		public 	$isr_key,$isr_year;
		function __construct($isr_key,$isr_year){
//---------------------------------------------------------------------	
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();				
//---------------------------------------------------------------------	
			$this->isr_key=$isr_key;
			$this->isr_year=$isr_year;
//---------------------------------------------------------------------	
			try{
				$InternalSaveRightsIntoSql="DELETE FROM `internal_save_rights` WHERE `isr_key`='{$this->isr_key}' AND `isr_year`='{$this->isr_year}'";
				$pdo_quota->exec($InternalSaveRightsIntoSql);
				$InternalSaveRightsIntoDate="Yes";
			}catch(PDOException $e){
				$InternalSaveRightsIntoDate="No";
			}
			if(isset($InternalSaveRightsIntoDate)){
				$this->InternalSaveRightsIntoDate=$InternalSaveRightsIntoDate;
			}else{
//---------------------------------------------------------------------
			}
			$pdo_quota=null;
		}function RunInternalSaveRightsDelete(){
			if(isset($this->InternalSaveRightsIntoDate)){
				return $this->InternalSaveRightsIntoDate;
			}else{
//---------------------------------------------------------------------				
			}
		}
	}
?>

<?php
	class InternalSaveRightsTest{
		public 	$isr_key,$isr_year;
		function __construct($isr_key,$isr_year){
//---------------------------------------------------------------------	
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();
//---------------------------------------------------------------------	
			$this->isr_key=$isr_key;
			$this->isr_year=$isr_year;
//---------------------------------------------------------------------	
			$InternalSaveRightsSql="SELECT COUNT(`isr_key`) AS `num_internal` 
								    FROM `internal_save_rights` 
									WHERE `isr_key`='{$this->isr_key}' AND `isr_year`='{$this->isr_year}'";
				if($InternalSaveRightsRs=$pdo_quota->query($InternalSaveRightsSql)){
					$InternalSaveRightsRow=$InternalSaveRightsRs->Fetch(PDO::FETCH_ASSOC);
					if(is_array($InternalSaveRightsRow) && count($InternalSaveRightsRow)){
						$num_internal=$InternalSaveRightsRow["num_internal"];
					}else{
						$num_internal=0;
					}
				}else{
					$num_internal=0;
				}
				if(isset($num_internal)){
					$this->num_internal=$num_internal;
				}else{
//---------------------------------------------------------------------					
				}
//---------------------------------------------------------------------
		}function RunInternalSaveRightsTest(){
			if(isset($this->num_internal)){
				return $this->num_internal;
			}else{
//---------------------------------------------------------------------				
			}
		}
	}
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	class InternalSaveRightsPrint{
		public 	$isr_key,$isr_year;
		function __construct($isr_key,$isr_year){
//---------------------------------------------------------------------	
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();
//---------------------------------------------------------------------	
			$this->isr_key=$isr_key;
			$this->isr_year=$isr_year;
			$InternalSaveRightsArray=array();
//---------------------------------------------------------------------	
			$InternalSaveRightsSql="SELECT *
								    FROM `internal_save_rights` 
									WHERE `isr_key`='{$this->isr_key}' AND `isr_year`='{$this->isr_year}'";
				if($InternalSaveRightsRs=$pdo_quota->query($InternalSaveRightsSql)){
					while($InternalSaveRightsRow=$InternalSaveRightsRs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($InternalSaveRightsRow) && count($InternalSaveRightsRow)){
							$InternalSaveRightsArray[]=$InternalSaveRightsRow;
						}else{
							$InternalSaveRightsArray=null;
						}						
					}
				}else{
					$InternalSaveRightsArray=null;
				}
				if(isset($InternalSaveRightsArray)){
					$this->InternalSaveRightsArray=$InternalSaveRightsArray;
				}else{
//---------------------------------------------------------------------					
				}
//---------------------------------------------------------------------
		}function RunInternalSaveRightsPrint(){
			if(isset($this->InternalSaveRightsArray)){
				return $this->InternalSaveRightsArray;
			}else{
//---------------------------------------------------------------------				
			}
		}
	}
?>
<?php
	class RowQuotaRight{
		public $RQR_key,$RQR_year,$RQR_level;
		function __construct($RQR_key,$RQR_year,$RQR_level){
//---------------------------------------------------------------------	
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();
//---------------------------------------------------------------------
			$this->RQR_key=$RQR_key;
			$this->RQR_year=$RQR_year;
			$this->RQR_level=$RQR_level;
//---------------------------------------------------------------------
			$QuotaRightSql="SELECT `qr_stuid`,`qr_year`,`qr_level`,`qr_plan`,`qr_datetime` 
						    FROM `quota_right` 
							WHERE `qr_stuid`='{$this->RQR_key}' 
							AND `qr_year`='{$this->RQR_year}' 
							AND `qr_level`='{$this->RQR_level}'";
				if($QuotaRightRs=$pdo_quota->query($QuotaRightSql)){
					$QuotaRightRow=$QuotaRightRs->Fetch(PDO::FETCH_ASSOC);
					if(is_array($QuotaRightRow) && count($QuotaRightRow)){
						$qr_stuid=$QuotaRightRow["qr_stuid"];
						$qr_year=$QuotaRightRow["qr_year"];
						$qr_level=$QuotaRightRow["qr_level"];
						$qr_plan=$QuotaRightRow["qr_plan"];
						$qr_datetime=$QuotaRightRow["qr_datetime"];
					}else{
						$qr_stuid=null;
						$qr_year=null;
						$qr_level=null;
						$qr_plan=null;
						$qr_datetime=null;						
					}
				}else{
					$qr_stuid=null;
					$qr_year=null;
					$qr_level=null;
					$qr_plan=null;
					$qr_datetime=null;					
				}
				if(isset($qr_stuid)){
					$this->qr_stuid=$qr_stuid;
					$this->qr_year=$qr_year;
					$this->qr_level=$qr_level;
					$this->qr_plan=$qr_plan;
					$this->qr_datetime=$qr_datetime;
				}else{
//-----------------------------------------------------------------------					
				}
		}function __destruct(){
			if(isset($this->qr_stuid)){
				$this->qr_stuid;
				$this->qr_year;
				$this->qr_level;
				$this->qr_plan;
				$this->qr_datetime;
			}else{
//------------------------------------------------------------------------				
			}
		}
	}
?>


<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	class IntoQuotaRight{
		public $qr_stuid,$qr_year,$qr_level,$qr_plan;
		function __construct($qr_stuid,$qr_year,$qr_level,$qr_plan){
//----------------------------------------------------------
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();				
//----------------------------------------------------------	
			$this->qr_stuid=$qr_stuid;
			$this->qr_year=$qr_year;
			$this->qr_level=$qr_level;
			$this->qr_plan=$qr_plan;
			$datetime=date("Y-m-d H:i:s");
			try{
				$IntoQuotaRightSql="INSERT INTO `quota_right`(`qr_stuid`, `qr_year`, `qr_level`, `qr_plan`, `qr_datetime`) VALUES 
								   ('{$this->qr_stuid}','{$this->qr_year}','{$this->qr_level}','{$this->qr_plan}','{$datetime}')";
				$pdo_quota->exec($IntoQuotaRightSql);
				$IntoQuotaRightDate="Yes";
			}catch(PDOException $e){
				$IntoQuotaRightDate="No";
			}		
			if(isset($IntoQuotaRightDate)){
				$this->IntoQuotaRightDate=$IntoQuotaRightDate;
			}else{
//----------------------------------------------------------				
			}
			$pdo_quota=Null;
		}function RunIntoQuotaRight(){
			if(isset($this->IntoQuotaRightDate)){
				return $this->IntoQuotaRightDate;
			}else{
//----------------------------------------------------------				
			}
		}
	} 
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	class DeleteQuotaRight{
		public $qr_stuid,$qr_year;
		function __construct($qr_stuid,$qr_year){
//----------------------------------------------------------
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();				
//----------------------------------------------------------	
			$this->qr_stuid=$qr_stuid;
			$this->qr_year=$qr_year;
			try{
				$IntoQuotaRightSql="DELETE FROM `quota_right` WHERE`qr_stuid`='{$this->qr_stuid}' AND `qr_year`='{$this->qr_year}'";
				$pdo_quota->exec($IntoQuotaRightSql);
				$IntoQuotaRightDate="Yes";
			}catch(PDOException $e){
				$IntoQuotaRightDate="No";
			}		
			if(isset($IntoQuotaRightDate)){
				$this->IntoQuotaRightDate=$IntoQuotaRightDate;
			}else{
//----------------------------------------------------------				
			}
			$pdo_quota=Null;
		}function RunDeleteQuotaRight(){
			if(isset($this->IntoQuotaRightDate)){
				return $this->IntoQuotaRightDate;
			}else{
//----------------------------------------------------------				
			}
		}
	} 
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->


<?php
	class internal_quota_rights{
		public $iqr_key,$iqr_year,$iqr_class;
		function __construct($iqr_key,$iqr_year,$iqr_class){
//----------------------------------------------------------
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();				
//----------------------------------------------------------				
			$this->iqr_key=$iqr_key;
			$this->iqr_year=$iqr_year;
			$this->iqr_class=$iqr_class;
			$iqr_array=array();
			
			$iqr_sql="SELECT `internal_quota_rights`.`quota_key`, `internal_quota_rights`.`quota_year` ,`internal_quota_rights`.`quota_class`
				    ,`internal_quota_rights`.`quota_plan`,`rc_plan`.`LName`,`rc_plan`.`Name` 
				      FROM `internal_quota_rights` LEFT JOIN `rc_plan` ON(`internal_quota_rights`.`quota_plan`=`rc_plan`.`IDPlan`)
				      WHERE `internal_quota_rights`.`quota_key`='{$this->iqr_key}' 
				      AND `internal_quota_rights`.`quota_year`='{$this->iqr_year}'
				      AND `internal_quota_rights`.`quota_class`='{$this->iqr_class}'
					  ORDER BY `rc_plan`.`plan_num` ASC";
				if($iqr_rs=$pdo_quota->query($iqr_sql)){
					while($iqr_row=$iqr_rs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($iqr_row) && count($iqr_row)){
							$iqr_array[]=$iqr_row;
						}else{
							$iqr_array=null;
						}
					}
				}else{
					$iqr_array=null;
				}
			
				if(isset($iqr_array)){
					$this->iqr_array=$iqr_array;
				}else{
//----------------------------------------------------------------					
				}
				$pdo_quota=Null;
		}function print_internal_quota_rights(){
			if(isset($this->iqr_array)){
				return $this->iqr_array;
			}else{
//----------------------------------------------------------------				
			}
		}
	}
?>
<?php
	class quota_request{
		public $txt_year;
		public $txt_class;
		
		function __construct($txt_year,$txt_class){
			$this->txt_year=$txt_year;
			$this->txt_class=$txt_class;
			$request_array=array();
			
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();
			
			$quota_requestSql="SELECT * FROM `quota_request` WHERE`request_year`='{$this->txt_year}' and `request_level`='{$this->txt_class}'";
				if($quota_requestRs=$pdo_quota->query($quota_requestSql)){
					while($quota_requestRow=$quota_requestRs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($quota_requestRow) && count($quota_requestRow)){
							$request_array[]=$quota_requestRow;
						}else{
							$request_array=null;
						}
					}
				}else{
					$request_array=null;
				}
				
				if(isset($request_array)){
					$this->request_array=$request_array;
				}else{
//----------------------------------------------------------------
				}
				$pdo_quota=Null;
		}function print_quota_requset(){
			if(isset($this->request_array)){
				return $this->request_array;
			}else{
//----------------------------------------------------------------				
			}
      }
		
	}

?>



<?php
			class notrow_evaluation{
			public $txt_evaluation;
			function __construct($txt_evaluation){
				$this->txt_evaluation=$txt_evaluation;
				$evaluation_array=array();
				
				$connpdo_evaluation=new conntopdo_evaluationto("mysql");
				$pdo_evaluation=$connpdo_evaluation->getconnto_evaluationto_evaluationect();
				
				$evaluation_sql=$this->txt_evaluation;
					if($evaluation_rs=$pdo_evaluation->query($evaluation_sql)){
						$evaluation_row=$evaluation_rs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($evaluation_row) && count($evaluation_row)){
							$evaluation_array[]=$evaluation_row;
						}else{
							$evaluation_array=null;
						}
					}else{
						$evaluation_array=null;
					}
					if(isset($evaluation_array)){
						$this->evaluation_array=$evaluation_array;
					}else{
//---------------------------------------------------------------------------------------------						
					}
					$pdo_evaluation=Null;	
				}function __destruct(){
					if(isset($this->evaluation_array)){
						$this->evaluation_array;
					}else{
//---------------------------------------------------------------------------------------------						
					}
				}
			}
?>

<?php
//regina_stu_data
	class regina_stu_data{
		public $stu_id;
		
		function __construct($stu_id){
			$this->stu_id=$stu_id;
			$connpdo_evaluation=new conntopdo_evaluationto("mysql");
			$pdo_evaluation=$connpdo_evaluation->getconnto_evaluationto_evaluationect();
			$regina_stu_dataSql="SELECT `rsd_studentid`, `rsd_Identification`, `rsd_prefix`, `rsd_name`, `rsd_surname`, `rsd_nameEn`, `rsd_surnameEn`,  `rse_student_status`, `rse_studentimg`, `rse_home`
								 FROM `regina_stu_data` WHERE`rsd_studentid`='{$this->stu_id}'";
			if($regina_stu_dataRs=$pdo_evaluation->query($regina_stu_dataSql)){
				$regina_stu_dataRow=$regina_stu_dataRs->Fetch(PDO::FETCH_ASSOC);
				if(is_array($regina_stu_dataRow) && count($regina_stu_dataRow)){
					$rsd_studentid=$regina_stu_dataRow["rsd_studentid"];
					$rsd_Identification=$regina_stu_dataRow["rsd_Identification"];
					$sd_prefix=$regina_stu_dataRow["rsd_prefix"];
					$rsd_name=$regina_stu_dataRow["rsd_name"];
					$rsd_surname=$regina_stu_dataRow["rsd_surname"];					
				}else{
					$rsd_studentid="";
					$rsd_Identification="";
					$sd_prefix="";
					$rsd_name="";
					$rsd_surname="";					
				}
			}else{
				$rsd_studentid="";
				$rsd_Identification="";
				$sd_prefix="";
				$rsd_name="";
				$rsd_surname="";
			}
			if(isset($rsd_studentid)){
				$this->rsd_studentid=$rsd_studentid;
				$this->rsd_Identification=$rsd_Identification;
				$this->sd_prefix=$sd_prefix;
				$this->rsd_name=$rsd_name;
				$this->rsd_surname=$rsd_surname;				
			}else{
//---------------------------------------------------------------------------------------------				
			}
			$pdo_evaluation=Null;
		}function __destruct(){
			if(isset($this->rsd_studentid)){
				$this->rsd_studentid;
				$this->rsd_Identification;
				$this->sd_prefix;
				$this->rsd_name;
				$this->rsd_surname;				
			}else{
//---------------------------------------------------------------------------------------------				
			}
		}
	}

?>

<?php
	class stu_levelpdo{
		public $stu_id;
		public $stu_year;
		public $stu_term;
		
		function __construct($stu_id,$stu_year,$stu_term){
			$this->stu_id=$stu_id;
			$this->stu_year=$stu_year;
			$this->stu_term=$stu_term;
			$connpdo_evaluation=new conntopdo_evaluationto("mysql");
			$pdo_evaluation=$connpdo_evaluation->getconnto_evaluationto_evaluationect();
			$stu_levelsql="select `regina_stu_class`.`rsd_studentid`,`rc_level`.`IDLevel`,`rc_level`.`Sort_name`,`rc_level`.`Lname`
						 ,`rc_plan`.`Name`as `planname`,`regina_stu_class`.`rsc_room`,`regina_stu_class`.`rsc_num`,`regina_stu_class`.`rsc_plan`
						   from `regina_stu_class` join `rc_level` on(`rc_level`.`IDLevel`=`regina_stu_class`.`rsc_class`)
						   join `rc_plan` on(`regina_stu_class`.`rsc_plan`=`rc_plan`.`IDPlan`)
						   where `regina_stu_class`.`rsc_year`='{$this->stu_year}'
						   and `regina_stu_class`.`rsc_term`='{$this->stu_term}'
						   and `regina_stu_class`.`rsd_studentid`='{$this->stu_id}'";
			if($stu_levelRs=$pdo_evaluation->query($stu_levelsql)){
				$stu_levelRow=$stu_levelRs->Fetch(PDO::FETCH_ASSOC);
				$this->rsd_studentid=$stu_levelRow["rsd_studentid"];
				$this->IDLevel=$stu_levelRow["IDLevel"];
				$this->Sort_name=$stu_levelRow["Sort_name"];
				$this->Lname=$stu_levelRow["Lname"];
				$this->planname=$stu_levelRow["planname"];
				$this->rsc_room=$stu_levelRow["rsc_room"];
				$this->rsc_num=$stu_levelRow["rsc_num"];
				$this->rc_plan=$stu_levelRow["rsc_plan"];
			}else{
				$this->rsd_studentid="";
				$this->IDLevel="";
				$this->Sort_name="";
				$this->Lname="";
				$this->planname="";
				$this->rsc_room="";
				$this->rsc_num="";
				$this->rc_plan="";
			}
			$pdo_evaluation=Null;
		}	function __destruct(){
			$this->rsd_studentid;
			$this->IDLevel;
			$this->Sort_name;
			$this->Lname;
			$this->planname;
			$this->rsc_room;
			$this->rsc_num;
			$this->rc_plan;
		}
			
	}
?>


<?php
  class plan_quota{
    function __construct(){
      $PlanQuotaArray=array();
      $connpdo_eveluation=new conntopdo_evaluationto("mysql");
	    $pdo_eveluation=$connpdo_eveluation->getconnto_evaluationto_evaluationect();
      $puota_planSql="select * from `rc_plan`
                      where IDPlan='2' or IDPlan='12' or IDPlan='3' or IDPlan='13' or IDPlan='4' or IDPlan='5' or IDPlan='6' or IDPlan='7' or IDPlan='11' or IDPlan='15' or IDPlan='16'";
      if($puota_planRs=$pdo_eveluation->query($puota_planSql)){
        while($puota_planRow=$puota_planRs->Fetch(PDO::FETCH_ASSOC)){
          $PlanQuotaArray[]=$puota_planRow;
        }
      }else{
        
      }
        $pdo_eveluation=Null;
        $this->PlanQuotaArray=$PlanQuotaArray;
    }
      function print_PlanQuota(){
        return $this->PlanQuotaArray;
      }
  }
    
?>



<?php
		class insert_quota{
			public $quota_sql;
			function __construct($quota_sql){
				$this->quota_sql=$quota_sql;
				
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();
				
				$sql=$this->quota_sql;
				
				if($pdo_quota->exec($sql)>0){
					$system_insertQuota="yes";
				}else{
					$system_insertQuota="no";
				}
				unset($pdo_quota);
				$this->system_insertQuota=$system_insertQuota;
			}function print_insertQuota(){
				 return $this->system_insertQuota;
			}
		}

?>

<?php
	class print_datasturc{
		public $txt_year,$txt_class;
		function __construct($txt_year,$txt_class){
			$this->txt_year=$txt_year;
			$this->txt_class=$txt_class;
			$array_datasturc=array();
			$connpdo_eveluation=new conntopdo_evaluationto("mysql");
			$pdo_eveluation=$connpdo_eveluation->getconnto_evaluationto_evaluationect();
			$datasturcSql="select distinct(`regina_stu_data`.`rsd_studentid`),`regina_stu_data`.`rsd_Identification`,`rc_prefix`.`prefixname`,`regina_stu_data`.`rsd_name`,
			                      `regina_stu_data`.`rsd_surname`,`regina_stu_data`.`rsd_nameEn`,`regina_stu_data`.`rsd_surnameEn`,`regina_stu_class`.`rsc_year`,`regina_stu_class`.`rsc_class`
								   from  `regina_stu_data` join `regina_stu_class` on (`regina_stu_data`.`rsd_studentid`=`regina_stu_class`.`rsd_studentid`)
                                   join `rc_prefix`on (`regina_stu_data`.`rsd_prefix`=`rc_prefix`.`IDPrefix` ) WHERE `regina_stu_data`.`rse_student_status`='1' 
                                   and `regina_stu_class`.`rsc_status`='1' and `regina_stu_class`.`rsc_year`='{$this->txt_year}'
								   and `regina_stu_class`.`rsc_class`='{$this->txt_class}';";
				if($datasturcRs=$pdo_eveluation->query($datasturcSql)){
					while($datasturcRow=$datasturcRs->Fetch(PDO::FETCH_ASSOC)){
						$array_datasturc[]=$datasturcRow;
					}
				}else{
					//******************************************************************
				}
					$pdo_eveluation=Null;
					$this->array_datasturc=$array_datasturc;
		}function echo_datasturc(){
			return $this->array_datasturc;
		}
	}
?>

<?php
	class print_datasturc_dts{
		public $txt_year,$txt_class;
		function __construct($txt_year,$txt_class){
			$this->txt_year=$txt_year;
			$this->txt_class=$txt_class;
			$array_datasturc=array();
			$connpdo_eveluation=new conntopdo_evaluationto("mysql");
			$pdo_eveluation=$connpdo_eveluation->getconnto_evaluationto_evaluationect();
			$datasturcSql="select distinct(`regina_stu_data`.`rsd_studentid`),`regina_stu_data`.`rsd_Identification`,`rc_prefix`.`prefixname`,`regina_stu_data`.`rsd_name`,
			                      `regina_stu_data`.`rsd_surname`,`regina_stu_data`.`rsd_nameEn`,`regina_stu_data`.`rsd_surnameEn`,`regina_stu_class`.`rsc_year`,`regina_stu_class`.`rsc_class`
								   from  `regina_stu_data` join `regina_stu_class` on (`regina_stu_data`.`rsd_studentid`=`regina_stu_class`.`rsd_studentid`)
                                   join `rc_prefix`on (`regina_stu_data`.`rsd_prefix`=`rc_prefix`.`IDPrefix` ) WHERE `regina_stu_data`.`rse_student_status`='1' 
                                   and `regina_stu_class`.`rsc_status`='11' and `regina_stu_class`.`rsc_year`='{$this->txt_year}'
								   and `regina_stu_class`.`rsc_class`='{$this->txt_class}';";
				if($datasturcRs=$pdo_eveluation->query($datasturcSql)){
					while($datasturcRow=$datasturcRs->Fetch(PDO::FETCH_ASSOC)){
						$array_datasturc[]=$datasturcRow;
					}
				}else{
					//******************************************************************
				}
					$pdo_eveluation=Null;
					$this->array_datasturc=$array_datasturc;
		}function echo_datasturc(){
			return $this->array_datasturc;
		}
	}
?>

<?php

	class row_quotanotarray{
		public $txt_quotanotarray;
		function __construct($txt_quotanotarray){
			$this->txt_quotanotarray=$txt_quotanotarray;
			$quotanotarray=array();

			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();

			$quotaSql=$this->txt_quotanotarray;
				if($quotaRs=$pdo_quota->query($quotaSql)){
					$quotaRow=$quotaRs->Fetch(PDO::FETCH_ASSOC);
					/*if(is_array($quotaRow) && count($quotaRow)){
						$quotanotarray[]=$quotaRow;						
					}else{
						$quotanotarray=null;
					}*/
					$quotanotarray[]=$quotaRow;
				}else{
					$quotanotarray=null;
				}

				/*if(isset($quotanotarray)){
					$this->quotanotarray=$quotanotarray;
				}else{
//---------------------------------------------------------------------------------------------					
				}*/	
				$this->quotanotarray=$quotanotarray;
				$connpdo_quota=Null;
		}function print_quotanotarray(){
			/*if(isset($this->quotanotarray)){
				return $this->quotanotarray;
			}else{
//---------------------------------------------------------------------------------------------				
			}*/
			return $this->quotanotarray;
		}
	}

?>

<?php

	class row_quotaarray{
		public $txt_quotanotarray;
		function __construct($txt_quotanotarray){
			$this->txt_quotanotarray=$txt_quotanotarray;
			$quotaarray=array();

			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();

			$quotaSql=$this->txt_quotanotarray;
				if($quotaRs=$pdo_quota->query($quotaSql)){
					while($quotaRow=$quotaRs->Fetch(PDO::FETCH_ASSOC)){
						/*if(is_array($quotaRow) && count($quotaRow)){
							$quotaarray[]=$quotaRow;							
						}else{
							$quotaarray=null;
						}*/
						$quotaarray[]=$quotaRow;
					}
				}else{
					$quotaarray=null;
				}
				/*if(isset($quotaarray)){
					$this->quotaarray=$quotaarray;
				}else{
//---------------------------------------------------------------------------------------------					
				}*/
				$this->quotaarray=$quotaarray;
				$connpdo_quota=Null;	
		}function print_quotaarray(){
			/*if(isset($this->quotaarray)){
				return $this->quotaarray;
			}else{
//---------------------------------------------------------------------------------------------				
			}*/
			return $this->quotaarray;
		}
	}

?>

<?php

		class print_evaluation{
			public $txt_evaluation;
			function __construct($txt_evaluation){
				$this->txt_evaluation=$txt_evaluation;
				$evaluation_notarray=array();
				$connpdo_eveluation=new conntopdo_evaluationto("mysql");
				$pdo_eveluation=$connpdo_eveluation->getconnto_evaluationto_evaluationect();
				$evaluation_sql=$this->txt_evaluation;
					if($evaluation_rs=$pdo_eveluation->query($evaluation_sql)){
						$evaluation_row=$evaluation_rs->Fetch(PDO::FETCH_ASSOC);
						/*if(is_array($evaluation_row) && count($evaluation_row)){
							$evaluation_notarray[]=$evaluation_row;							
						}else{
							$evaluation_notarray=null;
						}*/
						$evaluation_notarray[]=$evaluation_row;
					}else{
						$evaluation_notarray=null;
					}
					/*if(isset($evaluation_notarray)){
						$this->evaluation_notarray=$evaluation_notarray;						
					}else{
//---------------------------------------------------------------------------------------------						
					}*/
					$this->evaluation_notarray=$evaluation_notarray;
					$pdo_eveluation=Null;
				}function print_evaluation_notarray(){
					/*if(isset($this->evaluation_notarray)){
						return $this->evaluation_notarray;	
					}else{
//---------------------------------------------------------------------------------------------							
					}*/
					return $this->evaluation_notarray;	
				}
			}

?>

<?php
//print_plan->pdo
	class print_plan{
		public $plan;
		function __construct($plan){
			$this->plan=$plan;
			$connpdo_eveluation=new conntopdo_evaluationto("mysql");
			$pdo_eveluation=$connpdo_eveluation->getconnto_evaluationto_evaluationect();
			$plan_sql="SELECT `Name`,`LName` FROM `rc_plan` WHERE `IDPlan`='{$this->plan}'";
			if($plan_rs=$pdo_eveluation->query($plan_sql)){
				$plan_row=$plan_rs->Fetch(PDO::FETCH_ASSOC);
				/*if(is_array($plan_row) && count($plan_row)){
					$plan_Name=$plan_row["Name"];
					$plan_LName=$plan_row["LName"];					
				}else{
					$plan_Name=null;
					$plan_LName=null;						
				}*/
				$plan_Name=$plan_row["Name"];
				$plan_LName=$plan_row["LName"];
			}else{
				$plan_Name="-";
				$plan_LName="-";
			}
			
			/*if(isset($this->plan_Name,$this->plan_LName)){
				$this->plan_Name=$plan_Name;
				$this->plan_LName=$plan_LName;				
			}else{
//---------------------------------------------------------------------------------------------				
			}*/
			$this->plan_Name=$plan_Name;
			$this->plan_LName=$plan_LName;
			$pdo_eveluation=Null;
		}function __destruct(){
			/*if(isset($this->plan_Name,$this->plan_LName)){
				$this->plan_Name;
				$this->plan_LName;				
			}else{
//---------------------------------------------------------------------------------------------				
			}*/
			$this->plan_Name;
			$this->plan_LName;
		}
	}
?>

<?php
//print_plan->pdo
	class print_plan2{
		public $plan;
		function __construct($plan){
			$this->plan=$plan;

			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();

			$plan_sql="SELECT `Name`,`LName` FROM `rc_plan` WHERE `IDPlan`='{$this->plan}'";
			if($plan_rs=$pdo_quota->query($plan_sql)){
				$plan_row=$plan_rs->Fetch(PDO::FETCH_ASSOC);
				/*if(is_array($plan_row) && count($plan_row)){
					$plan_Name=$plan_row["Name"];
					$plan_LName=$plan_row["LName"];						
				}else{
					$plan_Name=null;
					$plan_LName=null;						
				}*/
				$plan_Name=$plan_row["Name"];
				$plan_LName=$plan_row["LName"];	
			}else{
				$plan_Name="-";
				$plan_LName="-";
			}
			/*if(isset($plan_Name,$plan_LName)){
				$this->plan_Name=$plan_Name;
				$this->plan_LName=$plan_LName;				
			}else{
//---------------------------------------------------------------------------------------------				
			}*/
			$this->plan_Name=$plan_Name;
			$this->plan_LName=$plan_LName;
			$pdo_quota=Null;
		}function __destruct(){
			/*if(isset($this->plan_Name,$this->plan_LName)){
				$this->plan_Name;
				$this->plan_LName;				
			}else{
//---------------------------------------------------------------------------------------------				
			}*/
				$this->plan_Name;
				$this->plan_LName;	
		}
	}
?>

<?php

		class row_evaluation{
			public $txt_evaluation;
			function __construct($txt_evaluation){
				$this->txt_evaluation=$txt_evaluation;
				$evaluation_array=array();
				$connpdo_eveluation=new conntopdo_evaluationto("mysql");
				$pdo_eveluation=$connpdo_eveluation->getconnto_evaluationto_evaluationect();
				$evaluation_sql=$this->txt_evaluation;
					if($evaluation_rs=$pdo_eveluation->query($evaluation_sql)){
						while($evaluation_row=$evaluation_rs->Fetch(PDO::FETCH_ASSOC)){
							/*if(is_array($evaluation_row) && count($evaluation_row)){
								$evaluation_array[]=$evaluation_row;
							}else{
								$evaluation_array=null;
							}*/
							$evaluation_array[]=$evaluation_row;
						}
					}else{
						$evaluation_array=null;
					}
					/*if(isset($evaluation_array)){
						$this->evaluation_array=$evaluation_array;
					}else{
//---------------------------------------------------------------------------------------------						
					}*/
					$this->evaluation_array=$evaluation_array;
					$pdo_eveluation=Null;
				}function print_evaluation_array(){
					/*if($this->evaluation_array){
						return $this->evaluation_array;
					}else{
//---------------------------------------------------------------------------------------------						
					}*/
					return $this->evaluation_array;
			}
		}
?>

<?php
	class DoQuotaRequest{
		public $PQR_key,$PQR_year,$PQR_level;
		function __construct($PQR_key,$PQR_year,$PQR_level){
//---------------------------------------------------------------------	
			$db_requestID=$_SERVER["REMOTE_ADDR"];
			$connpdo_quota=new conntoppdo_stuquota($db_requestID);
			$pdo_quota=$connpdo_quota->getconnto_stuquota();				
//---------------------------------------------------------------------	
			$this->PQR_key=$PQR_key;
			$this->PQR_year=$PQR_year;
			$this->PQR_level=$PQR_level;
//---------------------------------------------------------------------		
			$quota_requestSql="select `quota_request`.`request_stuid`,`quota_request`.`request_year`, `quota_request`.`request_level`
						     ,`quota_request`.`requset_datetime`,`quota_request`.`qr_stuid`,`quota_request`.`qce_key`
							   from `quota_request` LEFT join `rc_level` 
							   on (`quota_request`.`request_level`=`rc_level`.`IDLevel`)
							   where  `quota_request`.`request_stuid`='{$this->PQR_key}' 
							   and `quota_request`.`request_year`='{$this->PQR_year}'
							   and `quota_request`.`request_level`='{$this->PQR_level}'";
				if($quota_requestRs=$pdo_quota->query($quota_requestSql)){
					$quota_requestRow=$quota_requestRs->Fetch(PDO::FETCH_ASSOC);
					if(is_array($quota_requestRow) && count ($quota_requestRow)){
						$Request_stuid=$quota_requestRow["request_stuid"];
						$Request_year=$quota_requestRow["request_year"];
						$Request_level=$quota_requestRow["request_level"];
						$Request_datetime=$quota_requestRow["requset_datetime"];
						$Request_qr_stuid=$quota_requestRow["qr_stuid"];
						$Request_qce_key=$quota_requestRow["qce_key"];
						$PQR_system="yes";
//------------------------------------------------------------------------------------------						
					}else{
						$Request_stuid="-";
						$Request_year="-";
						$Request_level="-";
						$Request_datetime="-";
						$Request_qr_stuid="-";
						$Request_qce_key="-";
//------------------------------------------------------------------------------------------
						$PQR_system="no";
//------------------------------------------------------------------------------------------						
					}
				}else{
					$Request_stuid="-";
					$Request_year="-";
					$Request_level="-";
					$Request_datetime="-";
					$Request_qr_stuid="-";
					$Request_qce_key="-";
//------------------------------------------------------------------------------------------
					$PQR_system="no";
//------------------------------------------------------------------------------------------					
				}
				
				if(isset($Request_stuid)){
					$this->Request_stuid=$Request_stuid;
					$this->Request_year=$Request_year;
					$this->Request_level=$Request_level;
					$this->Request_datetime=$Request_datetime;
					$this->Request_qr_stuid=$Request_qr_stuid;
					$this->Request_qce_key=$Request_qce_key;
					$this->PQR_system=$PQR_system;
					$pdo_quota=null;
				}else{
					$pdo_quota=null;
				}
		}function __destruct(){
			if(isset($this->Request_stuid)){
				$this->Request_stuid;
				$this->Request_year;
				$this->Request_level;
				$this->Request_datetime;
				$this->Request_qr_stuid;
				$this->Request_qce_key;
				$this->PQR_system;
			}else{
				//-------------------------------------------
			}
		}
	}
?>