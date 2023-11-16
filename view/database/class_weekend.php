
<!--ค่าบริการเสริม กิจกรรมเรียนเสริมวันเสาร์-->
<?php
//DB:weekend_serve_list**
//DB:weekend_serve_pay*
	class AddDeleteUserServeWeek{
		public $ADUSW_Key,$ADUSW_Y,$ADUSW_T,$ADUSW_C,$ADUSW_NO,$ADUSW_Pay,$ADUSW_System;
		function __construct($ADUSW_Key,$ADUSW_Y,$ADUSW_T,$ADUSW_C,$ADUSW_NO,$ADUSW_Pay,$ADUSW_System){
			$this->ADUSW_Key=$ADUSW_Key;
			$this->ADUSW_Y=$ADUSW_Y;
			$this->ADUSW_T=$ADUSW_T;
			$this->ADUSW_C=$ADUSW_C;
			$this->ADUSW_NO=$ADUSW_NO;
			$this->ADUSW_Pay=$ADUSW_Pay;//** If null == 0
			$this->ADUSW_System=$ADUSW_System;
			$ADUSW_Error="Error123";
			$DateTime=date("Y-m-d H:i:s");
			$db_weekendID=$_SERVER['REMOTE_ADDR'];
			$connpdo_weekend=new count_weekend($db_weekendID);
			$pdo_weekend=$connpdo_weekend->call_coun_weekend();
				if($this->ADUSW_System=="Add"){
					try{
						$AddWeekendServePaySql="INSERT INTO `weekend_serve_pay`(`WSP_key`, `WSP_T`, `WSP_Y`, `WSP_C`, `WSP_Time`) 
									            VALUES ('{$this->ADUSW_Key}','{$this->ADUSW_T}','{$this->ADUSW_Y}','{$this->ADUSW_C}','{$DateTime}')";
						$pdo_weekend->exec($AddWeekendServePaySql);
							try{
								$AddWeekendServeListSql="INSERT INTO `weekend_serve_list`(`WSL_WS_No`, `WSL_WSP_key`, `WSL_WSP_T`, `WSL_WSP_Y`, `WSL_WSP_C`, `WSL_WSP_Pay`) 
														 VALUES ('{$this->ADUSW_NO}','{$this->ADUSW_Key}','{$this->ADUSW_T}','{$this->ADUSW_Y}','{$this->ADUSW_C}','{$this->ADUSW_Pay}')";
								$pdo_weekend->exec($AddWeekendServeListSql);
								$ADUSW_Error="NotError";
							}catch(PDOException $e){
								$ADUSW_Error="Error312";
							}
					}catch(PDOException $e){
						try{
							$UpWeekendServePaySql="UPDATE `weekend_serve_pay` SET `WSP_Time`='{$DateTime}' 
												   WHERE `WSP_key`='{$this->ADUSW_Key}' 
												   AND `WSP_T`='{$this->ADUSW_T}' 
												   AND `WSP_Y`='{$this->ADUSW_Y}' 
												   AND `WSP_C`='{$this->ADUSW_C}'";
							$pdo_weekend->exec($UpWeekendServePaySql);
								try{
									$AddWeekendServeListSql="INSERT INTO `weekend_serve_list`(`WSL_WS_No`, `WSL_WSP_key`, `WSL_WSP_T`, `WSL_WSP_Y`, `WSL_WSP_C`, `WSL_WSP_Pay`) 
															 VALUES ('{$this->ADUSW_NO}','{$this->ADUSW_Key}','{$this->ADUSW_T}','{$this->ADUSW_Y}','{$this->ADUSW_C}','{$this->ADUSW_Pay}')";
									$pdo_weekend->exec($AddWeekendServeListSql);
									$ADUSW_Error="NotError";
								}catch(PDOException $e){
									$ADUSW_Error="Error312";
								}						
						}catch(PDOException $e){
							$ADUSW_Error="Error213";
						}
					}
				}elseif($this->ADUSW_System=="DeleteNO"){
					try{
						$TestServeListSql="SELECT COUNT(`WSL_WSP_key`) AS `CountPay` FROM `weekend_serve_list` 
										   WHERE `WSL_WSP_key`='{$this->ADUSW_Key}' 
										   AND `WSL_WSP_T`='{$this->ADUSW_T}' 
										   AND `WSL_WSP_Y`='{$this->ADUSW_Y}' 
										   AND `WSL_WSP_C`='{$this->ADUSW_C}';";
							if($TestServeListRs=$pdo_weekend->query($TestServeListSql)){
								$TestServeListRow=$TestServeListRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($TestServeListRow) && count($TestServeListRow)){
										$CountPay=$TestServeListRow["CountPay"];
									}else{
										$CountPay=0;
									}
							}else{
								$CountPay=0;
							}
					}catch(PDOException $e){
						$CountPay=0;
					}
//-----------------------------------------------------------					
					if($CountPay>=2){
						try{
							$WeekendServeListSql="DELETE FROM `weekend_serve_list` 
												  WHERE `WSL_WSP_key`='{$this->ADUSW_Key}'
												  AND `WSL_WSP_T`='{$this->ADUSW_T}'
												  AND `WSL_WSP_Y`='{$this->ADUSW_Y}'
												  AND `WSL_WSP_C`='{$this->ADUSW_C}'
												  AND `WSL_WS_No`='{$this->ADUSW_NO}'";
							$pdo_weekend->exec($WeekendServeListSql);
							$ADUSW_Error="NotError";
						}catch(PDOException $e){
							$ADUSW_Error="Error213";
						}						
					}else{
						try{
							$WeekendServePaySql="DELETE FROM `weekend_serve_pay` 
												 WHERE `WSP_key`='{$this->ADUSW_Key}'
												 AND `WSP_T`='{$this->ADUSW_T}'
												 AND `WSP_Y`='{$this->ADUSW_Y}'
												 AND `WSP_C`='{$this->ADUSW_C}'";
							$pdo_weekend->exec($WeekendServePaySql);
								try{
									$WeekendServeListSql="DELETE FROM `weekend_serve_list` 
														  WHERE `WSL_WSP_key`='{$this->ADUSW_Key}'
												          AND `WSL_WSP_T`='{$this->ADUSW_T}'
												          AND `WSL_WSP_Y`='{$this->ADUSW_Y}'
												          AND `WSL_WSP_C`='{$this->ADUSW_C}'
												          AND `WSL_WS_No`='{$this->ADUSW_NO}'";
									$pdo_weekend->exec($WeekendServeListSql);
								}catch(PDOException $e){
									$ADUSW_Error="NotError";
								}
						}catch(PDOException $e){
							$ADUSW_Error="Error312";
						}						
					}
//-----------------------------------------------------------						
				}elseif($this->ADUSW_System=="Delete" and $this->ADUSW_NO=="Delete" and $this->ADUSW_Pay=="Delete"){
					try{
						$WeekendServePaySql="DELETE FROM `weekend_serve_pay` 
											 WHERE `WSP_key`='{$this->ADUSW_Key}'
											 AND `WSP_T`='{$this->ADUSW_T}'
											 AND `WSP_Y`='{$this->ADUSW_Y}'
											 AND `WSP_C`='{$this->ADUSW_C}'";
						$pdo_weekend->exec($WeekendServePaySql);						
							try{
								$WeekendServeListSql="DELETE FROM `weekend_serve_list` 
													  WHERE `WSL_WSP_key`='{$this->ADUSW_Key}'
													  AND `WSL_WSP_T`='{$this->ADUSW_T}'
													  AND `WSL_WSP_Y`='{$this->ADUSW_Y}'
													  AND `WSL_WSP_C`='{$this->ADUSW_C}'";
								$pdo_weekend->exec($WeekendServeListSql);
								$ADUSW_Error="NotError";
							}catch(PDOException $e){
								$ADUSW_Error="Error312";
							}
					}catch(PDOException $e){
						$ADUSW_Error="Error213";
					}					
				}else{
					$ADUSW_Error="Error123";
				}
				if(isset($ADUSW_Error)){
					$this->ADUSW_Error=$ADUSW_Error;
				}else{
					$pdo_weekend=null;
				}
		}function RunAddDeleteUserServeWeek(){
			if(isset($this->ADUSW_Error)){
				return $this->ADUSW_Error;
			}else{}
		}
	}
?>

<?php
	class DataServeWeek{
		public $DSW_ON;
		function __construct($DSW_ON){
			$this->DSW_ON=$DSW_ON;
			$db_weekendID=$_SERVER['REMOTE_ADDR'];
			$connpdo_weekend=new count_weekend($db_weekendID);
			$pdo_weekend=$connpdo_weekend->call_coun_weekend();
				try{
					$DataServeWeekSql="SELECT `WS_TxtTh`,`WS_TxtEn` FROM `weekend_serve` WHERE `WS_No`='{$this->DSW_ON}'";
						if($DataServeWeekRs=$pdo_weekend->query($DataServeWeekSql)){
							$DataServeWeekRow=$DataServeWeekRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($DataServeWeekRow) && count($DataServeWeekRow)){
									$DSWTxtTh=$DataServeWeekRow["WS_TxtTh"];
									$DSWTxtEh=$DataServeWeekRow["WS_TxtEn"];
								}else{
									$DSWTxtTh="-";
									$DSWTxtEh="-";
								}
						}else{
							$DSWTxtTh="-";
							$DSWTxtEh="-";							
						}
				}catch(PDOException $e){
					$DSWTxtTh="-";
					$DSWTxtEh="-";						
				}
			if(isset($DSWTxtTh)){
				$this->DSWTxtTh=$DSWTxtTh;
			}else{}
			if(isset($DSWTxtEh)){
				$this->DSWTxtEh=$DSWTxtEh;
			}else{}
			$pdo_weekend=null;
		}function ReadDSWTxtTh(){
			if(isset($this->DSWTxtTh)){
				return $this->DSWTxtTh;
			}else{}
		}function ReadDSWTxtEn(){
			if(isset($this->DSWTxtEh)){
				return $this->DSWTxtEh;
			}else{}
		}
	}
?>



<?php
	class PayServeWeekRc{
		public $PSWR_SudKey,$PSWR_T,$PSWR_Y,$PSWR_C,$PSWR_NO,$PSWR_SET;
		function __construct($PSWR_SudKey,$PSWR_T,$PSWR_Y,$PSWR_C,$PSWR_NO,$PSWR_SET){
			$this->PSWR_SudKey=$PSWR_SudKey;
			$this->PSWR_T=$PSWR_T;
			$this->PSWR_Y=$PSWR_Y;
			$this->PSWR_C=$PSWR_C;
			$this->PSWR_NO=$PSWR_NO;
			$this->PSWR_SET=$PSWR_SET;
			$LoopPayServeWeek=array();
			$db_weekendID=$_SERVER['REMOTE_ADDR'];
			$connpdo_weekend=new count_weekend($db_weekendID);
			$pdo_weekend=$connpdo_weekend->call_coun_weekend();			
				if($this->PSWR_SET=="Loop" and $this->PSWR_NO=="ALL"){
					try{
						$PayServeWeekRcSql="select `weekend_serve_pay`.`WSP_key`,`weekend_serve_pay`.`WSP_Y`,`weekend_serve_pay`.`WSP_T`,`weekend_serve_pay`.`WSP_C` ,`weekend_serve_list`.`WSL_WSP_Pay`,`weekend_serve_list`.`WSL_WS_No` 
											from `weekend_serve_pay` 
											right join `weekend_serve_list` on(`weekend_serve_pay`.`WSP_key`=`weekend_serve_list`.`WSL_WSP_key`) 
											where `weekend_serve_pay`.`WSP_key`='{$this->PSWR_SudKey}' 
											and `weekend_serve_pay`.`WSP_T`='{$this->PSWR_T}' 
											and `weekend_serve_pay`.`WSP_Y`='{$this->PSWR_Y}' 
											and `weekend_serve_pay`.`WSP_C`='{$this->PSWR_C}';";
							if($PayServeWeekRcRs=$pdo_weekend->query($PayServeWeekRcSql)){
								while($PayServeWeekRcRow=$PayServeWeekRcRs->Fetch(PDO::FETCH_ASSOC)){
									if(is_array($PayServeWeekRcRow) && count($PayServeWeekRcRow)){
										$LoopPayServeWeek[]=$PayServeWeekRcRow;
									}else{
										$LoopPayServeWeek[]="-";
									}
								}
							}else{
								$LoopPayServeWeek[]="-";
							}
					}catch(PDOException $e){
						$LoopPayServeWeek[]="-";
					}
				}elseif(($this->PSWR_SET=="Loop" and $this->PSWR_NO=="LIST")){
					try{
						$PayServeWeekRcSql="select `weekend_serve_pay`.`WSP_key`,`weekend_serve_pay`.`WSP_Y`,`weekend_serve_pay`.`WSP_T`,`weekend_serve_pay`.`WSP_C` ,`weekend_serve_list`.`WSL_WSP_Pay`,`weekend_serve_list`.`WSL_WS_No` 
										    from `weekend_serve_pay` 
											join `weekend_serve_list` 
											on(`weekend_serve_pay`.`WSP_key`=`weekend_serve_list`.`WSL_WSP_key`) 
											where `weekend_serve_pay`.`WSP_key`='{$this->PSWR_SudKey}' 
											and `weekend_serve_pay`.`WSP_T`='{$this->PSWR_T}' 
											and `weekend_serve_pay`.`WSP_Y`='{$this->PSWR_Y}' 
											and `weekend_serve_pay`.`WSP_C`='{$this->PSWR_C}' 
											and `weekend_serve_list`.`WSL_WSP_key`='{$this->PSWR_SudKey}' 
											and `weekend_serve_list`.`WSL_WSP_T`='{$this->PSWR_T}' 
											and `weekend_serve_list`.`WSL_WSP_C`='{$this->PSWR_C}' 
											and `weekend_serve_list`.`WSL_WSP_Y`='{$this->PSWR_Y}';";
							if($PayServeWeekRcRs=$pdo_weekend->query($PayServeWeekRcSql)){
								while($PayServeWeekRcRow=$PayServeWeekRcRs->Fetch(PDO::FETCH_ASSOC)){
									if(is_array($PayServeWeekRcRow) && count($PayServeWeekRcRow)){
										$LoopPayServeWeek[]=$PayServeWeekRcRow;
									}else{
										$LoopPayServeWeek[]="-";
									}
								}
							}else{
								$LoopPayServeWeek[]="-";
							}
					}catch(PDOException $e){
						$LoopPayServeWeek[]="-";
					}					
				}elseif($this->PSWR_SET=="Count"){
					try{
						$PayServeWeekRcSql="SELECT COUNT(`WSL_WSP_key`) AS `CountServePay`,`WSL_WS_No` 
											FROM `weekend_serve_list` 
									        WHERE `WSL_WSP_Y`='{$this->PSWR_Y}' 
											AND `WSL_WSP_T`='{$this->PSWR_T}' 
											AND `WSL_WSP_C`='{$this->PSWR_C}' 
											group by `WSL_WS_No`;";
							if($PayServeWeekRcRs=$pdo_weekend->query($PayServeWeekRcSql)){
								while($PayServeWeekRcRow=$PayServeWeekRcRs->Fetch(PDO::FETCH_ASSOC)){
									if(is_array($PayServeWeekRcRow) && count($PayServeWeekRcRow)){
										$LoopPayServeWeek[]=$PayServeWeekRcRow;
									}else{
										$LoopPayServeWeek[]="-";
									}
								}
							}else{
								$LoopPayServeWeek[]="-";
							}
					}catch(PDOException $e){
						$LoopPayServeWeek[]="-";
					}
				}else{
					try{
						$PayServeWeekRcSql="select count(`WSL_WSP_key`) as `CountServePay` 
											from  `weekend_serve_list` 
											where `WSL_WS_No`='{$this->PSWR_NO}' 
											and `WSL_WSP_key`='{$this->PSWR_SudKey}' 
											and `WSL_WSP_T`='{$this->PSWR_T}' 
											and `WSL_WSP_Y`='{$this->PSWR_Y}' 
											and `WSL_WSP_C`='{$this->PSWR_C}';";
							if($PayServeWeekRcRs=$pdo_weekend->query($PayServeWeekRcSql)){
								$PayServeWeekRcRow=$PayServeWeekRcRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($PayServeWeekRcRow) && count($PayServeWeekRcRow)){
										$CountServePay=$PayServeWeekRcRow["CountServePay"];
									}else{
										$CountServePay="Null";
									}
							}else{
								$CountServePay="Null";
							}						
					}catch(PDOException $e){
						$CountServePay="Null";
					}
				}
				if(isset($LoopPayServeWeek)){
					$this->LoopPayServeWeek=$LoopPayServeWeek;					
				}else{}
				if(isset($CountServePay)){
					$this->CountServePay=$CountServePay;
				}else{}
				$pdo_weekend=null;
		}function RunLoopPayServeWeek(){
			if(isset($this->LoopPayServeWeek)){
				return $this->LoopPayServeWeek;				
			}else{}
		}function RunCountServePay(){
			if(isset($this->CountServePay)){
				return $this->CountServePay;				
			}else{}
		}
	}
?>


<?php
	class WeekendServeLoop{
		public $WSD_OffOn,$WSD_ClassA,$WSD_ClassB;
		function __construct($WSD_OffOn,$WSD_ClassA,$WSD_ClassB){
			$this->WSD_OffOn=$WSD_OffOn;
			$this->WSD_ClassA=$WSD_ClassA;
			$this->WSD_ClassB=$WSD_ClassB;
			$WSServeLoop=Array();
			$db_weekendID=$_SERVER['REMOTE_ADDR'];
			$connpdo_weekend=new count_weekend($db_weekendID);
			$pdo_weekend=$connpdo_weekend->call_coun_weekend();				
				if($this->WSD_OffOn=="ALL"){
					try{
						$WSServeLoopSql="SELECT `WS_No`, `WS_TxtTh`, `WS_TxtEn`, `WS_Pay`, `WS_Offon`, `WS_CA`, `WS_CB` 
										 FROM `weekend_serve` WHERE 1 ORDER BY `WS_No` ASC";
							if($WSServeLoopRs=$pdo_weekend->query($WSServeLoopSql)){
								while($WSServeLoopRow=$WSServeLoopRs->Fetch(PDO::FETCH_ASSOC)){
									if(is_array($WSServeLoopRow) && count($WSServeLoopRow)){
										$WSServeLoop[]=$WSServeLoopRow;
									}else{
										$WSServeLoop[]="-";
									}
								}
							}else{
								$WSServeLoop[]="-";
							}
					}catch(PDOException $e){
						$WSServeLoop[]="-";
					}					
				}elseif($this->WSD_ClassA=="00" and $this->WSD_ClassB=="00"){
					try{
						$WSServeLoopSql="SELECT `WS_No`, `WS_TxtTh`, `WS_TxtEn`, `WS_Pay`, `WS_Offon`, `WS_CA`, `WS_CB` FROM `weekend_serve` 
										 WHERE `WS_Offon`='{$this->WSD_OffOn}' 
										 ORDER BY `WS_No` ASC;";
							if($WSServeLoopRs=$pdo_weekend->query($WSServeLoopSql)){
								while($WSServeLoopRow=$WSServeLoopRs->Fetch(PDO::FETCH_ASSOC)){
									if(is_array($WSServeLoopRow) && count($WSServeLoopRow)){
										$WSServeLoop[]=$WSServeLoopRow;
									}else{
										$WSServeLoop[]="-";
									}
								}
							}else{
								$WSServeLoop[]="-";
							}
					}catch(PDOException $e){
						$WSServeLoop[]="-";
					}					
				}else{
					try{
						$WSServeLoopSql="SELECT `WS_No`, `WS_TxtTh`, `WS_TxtEn`, `WS_Pay`, `WS_Offon`, `WS_CA`, `WS_CB` FROM `weekend_serve` 
										 WHERE `WS_Offon`='{$this->WSD_OffOn}' 
										 AND `WS_CA`='{$this->WSD_ClassA}' 
										 AND `WS_CB`='{$this->WSD_ClassB}'
										 ORDER BY `WS_No` ASC;";
							if($WSServeLoopRs=$pdo_weekend->query($WSServeLoopSql)){
								while($WSServeLoopRow=$WSServeLoopRs->Fetch(PDO::FETCH_ASSOC)){
									if(is_array($WSServeLoopRow) && count($WSServeLoopRow)){
										$WSServeLoop[]=$WSServeLoopRow;
									}else{
										$WSServeLoop[]="-";
									}
								}
							}else{
								$WSServeLoop[]="-";
							}
					}catch(PDOException $e){
						$WSServeLoop[]="-";
					}						
				}
//-------------------------------------------------------------------
				if(isset($WSServeLoop)){
					$this->WSServeLoop=$WSServeLoop;
					$pdo_weekend=null;
				}else{
					$pdo_weekend=null;
				}
//-------------------------------------------------------------------				
		}function RunWeekendServeLoop(){
			if(isset($this->WSServeLoop)){
				return $this->WSServeLoop;
			}else{}
		}
	}
?>
<!--ค่าบริการเสริม กิจกรรมเรียนเสริมวันเสาร์-->







<?php
	class WeekendDiscount{
		public $wd_key;
		function __construct($wd_key){
			$this->wd_key=$wd_key;
			$db_weekendID=$_SERVER['REMOTE_ADDR'];
			$connpdo_weekend=new count_weekend($db_weekendID);
			$pdo_weekend=$connpdo_weekend->call_coun_weekend();	
				try{
					$WeekendDiscountSql="SELECT `wd_discount`, `wd_count` FROM `weekend_discount` 
									     WHERE `wd_key`='{$this->wd_key}'";
						if($WeekendDiscountRs=$pdo_weekend->query($WeekendDiscountSql)){
							$WeekendDiscountRow=$WeekendDiscountRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($WeekendDiscountRow) && count($WeekendDiscountRow)){
									$WdDiscount=$WeekendDiscountRow["wd_discount"];
									$WdCount=$WeekendDiscountRow["wd_count"];
								}else{
									$WdDiscount=0;
									$WdCount=0;
								}
						}else{
							$WdDiscount=0;
							$WdCount=0;							
						}
				}catch(PDOException $e){
					$WdDiscount=0;
					$WdCount=0;						
				}
				$this->WdDiscount=$WdDiscount;
				$this->WdCount=$WdCount;
				$pdo_weekend=null;
		}function PrintWdDiscount(){
			return $this->WdDiscount;
		}function PrintWdCount(){
			return $this->WdCount;
		}
	}
?>


<?php
	class PrintWeekendClassSud{
		public $PWCR_WcKey,$PWCR_T,$PWCR_Y;
		function __construct($PWCR_WcKey,$PWCR_T,$PWCR_Y){
//---------------------------------------------------------------
			$this->PWCR_WcKey=$PWCR_WcKey;
			$this->PWCR_T=$PWCR_T;
			$this->PWCR_Y=$PWCR_Y;
//---------------------------------------------------------------						
			$db_weekendID=$_SERVER['REMOTE_ADDR'];
			$connpdo_weekend=new count_weekend($db_weekendID);
			$pdo_weekend=$connpdo_weekend->call_coun_weekend();			
//---------------------------------------------------------------	
			$PrintWeekendClassRsArray=Array();
				try{
					$WeekendClass="SELECT `wcr_key`, `wcr_t`, `wcr_y`, `wcr_time`, `weekend_class_wc_key`, `weekend_class_time_wct_key`, `wcr_learn`
								   FROM `weekend_class_rc` 
								   WHERE `weekend_class_wc_key`='{$this->PWCR_WcKey}' 
								   AND `wcr_t`='{$this->PWCR_T}' 
								   AND `wcr_y`='{$this->PWCR_Y}'";
						if($WeekendClassRs=$pdo_weekend->query($WeekendClass)){
							while($WeekendClassRow=$WeekendClassRs->Fetch(PDO::FETCH_ASSOC)){
								if(is_array($WeekendClassRow) && count($WeekendClassRow)){
									$PrintWeekendClassRsArray[]=$WeekendClassRow;
								}else{
									$PrintWeekendClassRsArray[]="-";
								}
							}
						}else{
							$PrintWeekendClassRsArray[]="-";
						}
				}catch(PDOException $e){
					$PrintWeekendClassRsArray[]="-";
				}
				if(isset($PrintWeekendClassRsArray)){
					$this->PrintWeekendClassRsArray=$PrintWeekendClassRsArray;
					$pdo_weekend=null;
				}else{
					$pdo_weekend=null;
				}
		}function RunPrintWeekendClassRc(){
			if(isset($this->PrintWeekendClassRsArray)){
				return $this->PrintWeekendClassRsArray;
			}else{}
		}
	}
	
?>




<?php
	class UpDateWeekendClass{
		public $UDWC_Key,$UDWC_Txt,$UDWC_Y,$UDWC_T,$UDWC_Pay,$UDWC_Count;
			function __construct($UDWC_Key,$UDWC_Txt,$UDWC_Y,$UDWC_T,$UDWC_Pay,$UDWC_Count){
				$this->UDWC_Key=$UDWC_Key;
				$this->UDWC_Txt=$UDWC_Txt;
				$this->UDWC_Y=$UDWC_Y;
				$this->UDWC_T=$UDWC_T;
				$this->UDWC_Pay=$UDWC_Pay;
				$this->UDWC_Count=$UDWC_Count;
//---------------------------------------------------------------						
				$db_weekendID=$_SERVER['REMOTE_ADDR'];
				$connpdo_weekend=new count_weekend($db_weekendID);
				$pdo_weekend=$connpdo_weekend->call_coun_weekend();			
//---------------------------------------------------------------
				$ErrorUpDateWeekendClass="Y";
//---------------------------------------------------------------				
					try{
						$UpDateWeekendClassSql="UPDATE `weekend_class` 
										        SET `wc_txt`='{$this->UDWC_Txt}',`wc_pay`='{$this->UDWC_Pay}',`wc_count`='{$this->UDWC_Count}' 
												WHERE `wc_key`='{$this->UDWC_Key}' AND `wc_t`='{$this->UDWC_T}' AND `wc_y`='{$this->UDWC_Y}'";
						$pdo_weekend->exec($UpDateWeekendClassSql);
						$ErrorUpDateWeekendClass="N";
					}catch(PDOException $e){
						$ErrorUpDateWeekendClass="Y";
					}
					if(isset($ErrorUpDateWeekendClass)){
						$this->ErrorUpDateWeekendClass=$ErrorUpDateWeekendClass;
						$pdo_weekend=null;
					}else{
						$pdo_weekend=null;
					}
			}function RunUpDateWeekendClass(){
				if(isset($this->ErrorUpDateWeekendClass)){
					return $this->ErrorUpDateWeekendClass;
				}else{}
			}
		}
	

?>

<?php
	class DeletEweekendClassRc{
		public $DECR_Key,$DECR_WcKey,$DECR_T,$DECR_Y;
		function __construct($DECR_Key,$DECR_WcKey,$DECR_T,$DECR_Y){
			$this->DECR_Key=$DECR_Key;
			$this->DECR_WcKey=$DECR_WcKey;
			$this->DECR_T=$DECR_T;
			$this->DECR_Y=$DECR_Y;
//---------------------------------------------------------------						
			$db_weekendID=$_SERVER['REMOTE_ADDR'];
			$connpdo_weekend=new count_weekend($db_weekendID);
			$pdo_weekend=$connpdo_weekend->call_coun_weekend();			
//---------------------------------------------------------------
			$ErrorDeletEweekendClass="N";
//---------------------------------------------------------------
			try{
				$DeletEweekendClassRcSql="DELETE FROM `weekend_class_rc` 
										  WHERE `wcr_key`='{$this->DECR_Key}' 
										  AND `wcr_t`='{$this->DECR_T}' 
										  AND `wcr_y`='{$this->DECR_Y}' 
										  AND `weekend_class_wc_key`='{$this->DECR_WcKey}'";
				$pdo_weekend->exec($DeletEweekendClassRcSql);
				$ErrorDeletEweekendClass="Y";
			}catch(PDOException $e){
				$ErrorDeletEweekendClass="N";
			}
			
			if(isset($ErrorDeletEweekendClass)){
				$this->ErrorDeletEweekendClass=$ErrorDeletEweekendClass;
				$pdo_weekend=null;
			}else{
				$pdo_weekend=null;
			}
			
		}function RunDeletEweekendClassRc(){
			if(isset($this->ErrorDeletEweekendClass)){
				return $this->ErrorDeletEweekendClass;
			}else{}
		}
	}
?>


<?php
	class LoopClassTimeWeek{
		public $LCT_WcKey,$LCT_Y,$LCT_T;
		function __construct($LCT_WcKey,$LCT_Y,$LCT_T){
			$this->LCT_WcKey=$LCT_WcKey;
			$this->LCT_Y=$LCT_Y;
			$this->LCT_T=$LCT_T;
//---------------------------------------------------------------			
			$db_weekendID=$_SERVER['REMOTE_ADDR'];
			$connpdo_weekend=new count_weekend($db_weekendID);
			$pdo_weekend=$connpdo_weekend->call_coun_weekend();	
//---------------------------------------------------------------			
			$ClassTimeWeekend=array();
				try{
					$ClassTimeWeekendSql="SELECT `wct_key`, `wct_timeA`, `wct_timeB`, `wct_y`, `wct_t`, `weekend_class_wc_key` 
					                      FROM `weekend_class_time` 
										  WHERE `weekend_class_wc_key`='{$this->LCT_WcKey}'
										  AND `wct_y`='{$this->LCT_Y}' 
										  AND `wct_t`='{$this->LCT_T}';";
						if($ClassTimeWeekendRs=$pdo_weekend->query($ClassTimeWeekendSql)){
							while($ClassTimeWeekendRow=$ClassTimeWeekendRs->Fetch(PDO::FETCH_ASSOC)){
								if(is_array($ClassTimeWeekendRow) && count($ClassTimeWeekendRow)){
									$ClassTimeWeekend[]=$ClassTimeWeekendRow;
								}else{
									$ClassTimeWeekend[]="-";
								}
							}
						}else{
							$ClassTimeWeekend="-";
						}
				}catch(PDOException $e){
					$ClassTimeWeekend="-";
				}
//---------------------------------------------------------------				
				if(isset($ClassTimeWeekend)){
					$this->ClassTimeWeekend=$ClassTimeWeekend;
					$pdo_weekend=null;
				}else{
					$pdo_weekend=null;
				}
//---------------------------------------------------------------				
		}function RunLoopClassTimeWeek(){
			if(isset($this->ClassTimeWeekend)){
				return $this->ClassTimeWeekend;
			}else{}
		}
	}
?>


<?php
	class DataWeekendClassTime{
		public $DWCT_Key,$DWCT_T,$DWCT_Y;
		function __construct($DWCT_Key,$DWCT_T,$DWCT_Y){
			$this->DWCT_Key=$DWCT_Key;
			$this->DWCT_T=$DWCT_T;
			$this->DWCT_Y=$DWCT_Y;
//---------------------------------------------------------------						
			$db_weekendID=$_SERVER['REMOTE_ADDR'];
			$connpdo_weekend=new count_weekend($db_weekendID);
			$pdo_weekend=$connpdo_weekend->call_coun_weekend();			
//---------------------------------------------------------------
				try{
					$DataWeekendClassTimeSql="SELECT `wct_key`, `wct_timeA`, `wct_timeB`, `wct_y`, `wct_t`, `weekend_class_wc_key` 
											  FROM `weekend_class_time` WHERE `wct_key`='{$this->DWCT_Key}' AND `wct_y`='{$this->DWCT_Y}' AND `wct_t`='{$this->DWCT_T}'";
						if($DataWeekendClassTimeRs=$pdo_weekend->query($DataWeekendClassTimeSql)){
							$DataWeekendClassTimeRow=$DataWeekendClassTimeRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($DataWeekendClassTimeRow) && count($DataWeekendClassTimeRow)){
									$wct_key=$DataWeekendClassTimeRow["wct_key"];
									$wct_timeA=$DataWeekendClassTimeRow["wct_timeA"];
									$wct_timeB=$DataWeekendClassTimeRow["wct_timeB"];
									$wct_y=$DataWeekendClassTimeRow["wct_y"];
									$wct_t=$DataWeekendClassTimeRow["wct_t"];
									$weekend_class_wc_key=$DataWeekendClassTimeRow["weekend_class_wc_key"];
								}else{
									$wct_key="-";
									$wct_timeA="-";
									$wct_timeB="-";
									$wct_y="-";
									$wct_t="-";
									$weekend_class_wc_key="-";									
								}
						}else{
							$wct_key="-";
							$wct_timeA="-";
							$wct_timeB="-";
							$wct_y="-";
							$wct_t="-";
							$weekend_class_wc_key="-";							
						}
				}catch(PDOException $e){
					$wct_key="-";
					$wct_timeA="-";
					$wct_timeB="-";
					$wct_y="-";
					$wct_t="-";
					$weekend_class_wc_key="-";					
				}
			$this->wct_key=$wct_key;
			$this->wct_timeA=$wct_timeA;
			$this->wct_timeB=$wct_timeB;
			$this->wct_y=$wct_y;		
			$this->wct_t=$wct_t;
			$this->weekend_class_wc_key=$weekend_class_wc_key;
			$pdo_weekend=null;
		}function __destruct(){
			$this->wct_key;
			$this->wct_timeA;
			$this->wct_timeB;
			$this->wct_y;		
			$this->wct_t;
			$this->weekend_class_wc_key;			
		}
	}
?>







<?php
	class DataWeekendClass{
		public $DWC_Key,$DWC_T,$DWC_Y;
		function __construct($DWC_Key,$DWC_T,$DWC_Y){
			$this->DWC_Key=$DWC_Key;
			$this->DWC_T=$DWC_T;
			$this->DWC_Y=$DWC_Y;
//---------------------------------------------------------------						
			$db_weekendID=$_SERVER['REMOTE_ADDR'];
			$connpdo_weekend=new count_weekend($db_weekendID);
			$pdo_weekend=$connpdo_weekend->call_coun_weekend();			
//---------------------------------------------------------------			
				try{
					$DataWeekendClassSql="SELECT `wc_key`, `wc_txt`, `wc_y`, `wc_t`, `wc_pay`, `wc_count`, `weekend_class_type_wt_on` 
										  FROM `weekend_class` 
										  WHERE `wc_key`='{$this->DWC_Key}' 
										  and `wc_y`='{$this->DWC_Y}' 
										  and `wc_t`='{$this->DWC_T}'";
						if($DataWeekendClassRs=$pdo_weekend->query($DataWeekendClassSql)){
							$DataWeekendClassRow=$DataWeekendClassRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($DataWeekendClassRow) && count($DataWeekendClassRow)){
									$wc_key=$DataWeekendClassRow["wc_key"];
									$wc_txt=$DataWeekendClassRow["wc_txt"];
									$wc_pay=$DataWeekendClassRow["wc_pay"];
									$wc_count=$DataWeekendClassRow["wc_count"];
									$weekend_class_type_wt_on=$DataWeekendClassRow["weekend_class_type_wt_on"];
								}else{
									$wc_key="-";
									$wc_txt="-";
									$wc_pay="-";
									$wc_count="-";
									$weekend_class_type_wt_on="-";									
								}
						}else{
							$wc_key="-";
							$wc_txt="-";
							$wc_pay="-";
							$wc_count="-";
							$weekend_class_type_wt_on="-";							
						}
				}catch(PDOException $e){
					$wc_key="-";
					$wc_txt="-";
					$wc_pay="-";
					$wc_count="-";
					$weekend_class_type_wt_on="-";
				}
			$this->wc_key=$wc_key;
			$this->wc_txt=$wc_txt;
			$this->wc_pay=$wc_pay;
			$this->wc_count=$wc_count;
			$this->weekend_class_type_wt_on=$weekend_class_type_wt_on;
			$pdo_weekend=null;
		}function __destruct(){
			$this->wc_key;
			$this->wc_txt;
			$this->wc_pay;
			$this->wc_count;
			$this->weekend_class_type_wt_on;			
		}
	}
?>


<?php
	class PrintWeekendClassRc{
		public $PWCR_Key,$PWCR_T,$PWCR_Y,$PWCR_RUN;
		function __construct($PWCR_Key,$PWCR_T,$PWCR_Y,$PWCR_Array){
			$this->PWCR_Key=$PWCR_Key;
			$this->PWCR_T=$PWCR_T;
			$this->PWCR_Y=$PWCR_Y;
			$this->PWCR_Array=$PWCR_Array;
//---------------------------------------------------------------						
			$db_weekendID=$_SERVER['REMOTE_ADDR'];
			$connpdo_weekend=new count_weekend($db_weekendID);
			$pdo_weekend=$connpdo_weekend->call_coun_weekend();			
//---------------------------------------------------------------	
		    $WeekendClassRc=array();
//---------------------------------------------------------------	
				if($this->PWCR_Array=="NotArray"){
					try{
						$WeekendClassRcSql="select `weekend_class`.`wc_key`,`weekend_class`.`wc_txt`,`weekend_class`.`wc_pay`,`weekend_class`.`weekend_class_type_wt_on` ,`weekend_class_rc`.`wcr_key`,`weekend_class_rc`.`wcr_time`,`weekend_class_rc`.`wcr_learn`,`weekend_class_time`.`wct_timeA` ,`weekend_class_time`.`wct_timeB` 
											from `weekend_class_rc` 
											join `weekend_class` on (`weekend_class_rc`.`weekend_class_wc_key`=`weekend_class`.`wc_key`) 
											join `weekend_class_time` on (`weekend_class_rc`.`weekend_class_wc_key`=`weekend_class_time`.`weekend_class_wc_key`) 
											where `weekend_class_rc`.`wcr_key`='{$this->PWCR_Key}' 
											and `weekend_class_rc`.`wcr_t`='{$this->PWCR_T}' 
											and `weekend_class_rc`.`wcr_y`='{$this->PWCR_Y}'
											and `weekend_class_time`.`wct_t`='{$this->PWCR_T}'
                                            and	`weekend_class_time`.`wct_y`='{$this->PWCR_Y}'
											and `weekend_class`.`wc_t`='{$this->PWCR_T}'
											and `weekend_class`.`wc_y`='{$this->PWCR_Y}'";
							if($WeekendClassRcRs=$pdo_weekend->query($WeekendClassRcSql)){
								$WeekendClassRcRow=$WeekendClassRcRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($WeekendClassRcRow) && count($WeekendClassRcRow)){
										$WeekendClassRc[]=$WeekendClassRcRow;
									}else{
										$WeekendClassRc[]="-";
									}
							}else{
								$WeekendClassRc[]="-";
							}
					}catch(PDOException $e){
						$WeekendClassRc[]="-";
					}					
				}elseif($this->PWCR_Array=="Array"){
					try{
						$WeekendClassRcSql="select `weekend_class`.`wc_key`,`weekend_class`.`wc_txt`,`weekend_class`.`wc_pay`,`weekend_class`.`weekend_class_type_wt_on` ,`weekend_class_rc`.`wcr_key`,`weekend_class_rc`.`wcr_time`,`weekend_class_rc`.`wcr_learn`,`weekend_class_time`.`wct_timeA` ,`weekend_class_time`.`wct_timeB` 
											from `weekend_class_rc` 
											join `weekend_class` on (`weekend_class_rc`.`weekend_class_wc_key`=`weekend_class`.`wc_key`) 
											join `weekend_class_time` on (`weekend_class_rc`.`weekend_class_wc_key`=`weekend_class_time`.`weekend_class_wc_key`) 
											where `weekend_class_rc`.`wcr_key`='{$this->PWCR_Key}' 
											and `weekend_class_rc`.`wcr_t`='{$this->PWCR_T}' 
											and `weekend_class_rc`.`wcr_y`='{$this->PWCR_Y}'
											and `weekend_class_time`.`wct_t`='{$this->PWCR_T}'
                                            and	`weekend_class_time`.`wct_y`='{$this->PWCR_Y}'
											and `weekend_class`.`wc_t`='{$this->PWCR_T}'
											and `weekend_class`.`wc_y`='{$this->PWCR_Y}'
											order by `weekend_class_time`.`wct_timeA` asc";
							if($WeekendClassRcRs=$pdo_weekend->query($WeekendClassRcSql)){
								while($WeekendClassRcRow=$WeekendClassRcRs->Fetch(PDO::FETCH_ASSOC)){
									if(is_array($WeekendClassRcRow) && count($WeekendClassRcRow)){
										$WeekendClassRc[]=$WeekendClassRcRow;
									}else{
										$WeekendClassRc[]="-";
									}
								}
							}else{
								$WeekendClassRc[]="-";
							}
					}catch(PDOException $e){
						$WeekendClassRc[]="-";
					}					
				}elseif($this->PWCR_Array=="Array2"){
					try{
						$WeekendClassRcSql="SELECT `wcr_key`, `wcr_t`, `wcr_y`, `wcr_time`, `weekend_class_wc_key`, `weekend_class_time_wct_key`, `wcr_learn`
										    FROM `weekend_class_rc` 
											WHERE `wcr_key`='{$this->PWCR_Key}' 
											AND `wcr_t`='{$this->PWCR_T}'
											AND `wcr_y`='{$this->PWCR_Y}'
											ORDER BY `wcr_time` ASC";
							if($WeekendClassRcRs=$pdo_weekend->query($WeekendClassRcSql)){
								while($WeekendClassRcRow=$WeekendClassRcRs->Fetch(PDO::FETCH_ASSOC)){
									if(is_array($WeekendClassRcRow) && count($WeekendClassRcRow)){
										$WeekendClassRc[]=$WeekendClassRcRow;
									}else{
										$WeekendClassRc[]="-";
									}
								}
							}else{
								$WeekendClassRc[]="-";
							}
					}catch(PDOException $e){
						$WeekendClassRc[]="-";
					}
				}elseif($this->PWCR_Key=="ALL" and $this->PWCR_Array=="Array3"){
					try{
						$WeekendClassRcSql="SELECT DISTINCT `wcr_key` FROM `weekend_class_rc` 
											WHERE `wcr_t`='{$this->PWCR_T}'
											AND `wcr_y`='{$this->PWCR_Y}'";
							if($WeekendClassRcRs=$pdo_weekend->query($WeekendClassRcSql)){
								while($WeekendClassRcRow=$WeekendClassRcRs->Fetch(PDO::FETCH_ASSOC)){
									if(is_array($WeekendClassRcRow) && count($WeekendClassRcRow)){
										$WeekendClassRc[]=$WeekendClassRcRow;
									}else{
										$WeekendClassRc[]="-";
									}
								}
							}else{
								$WeekendClassRc[]="-";
							}
					}catch(PDOException $e){
						$WeekendClassRc[]="-";
					}					
				}else{
					$WeekendClassRc[]="-";
				}
			if(isset($WeekendClassRc)){
				$this->WeekendClassRc=$WeekendClassRc;
				$pdo_weekend=null;
			}else{
				$pdo_weekend=null;
			}
		}function RunPrintWeekendClassRc(){
			if(isset($this->WeekendClassRc)){
				return $this->WeekendClassRc;
			}else{}
		}
	}
?>


<?php
	class TestWeekendCountA{
		public $TW_Key,$TW_T,$TW_Y;
		function __construct($TW_Key,$TW_T,$TW_Y){
			$this->TW_Key=$TW_Key;
			$this->TW_T=$TW_T;
			$this->TW_Y=$TW_Y;
//---------------------------------------------------------------						
			$db_weekendID=$_SERVER['REMOTE_ADDR'];
			$connpdo_weekend=new count_weekend($db_weekendID);
			$pdo_weekend=$connpdo_weekend->call_coun_weekend();			
//---------------------------------------------------------------
				try{
					$TestWeekendCountSql="SELECT `wc_count` 
										  FROM `weekend_class`
										  WHERE `wc_key`='{$this->TW_Key}' 
										  AND `wc_y`='{$this->TW_Y}' 
										  AND `wc_t`='{$this->TW_T}'";
						if($TestWeekendCountRs=$pdo_weekend->query($TestWeekendCountSql)){
							$TestWeekendCountRow=$TestWeekendCountRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($TestWeekendCountRow) && count($TestWeekendCountRow)){
									$WcCount=$TestWeekendCountRow["wc_count"];
								}else{
									$WcCount="0";
								}
						}else{
							$WcCount="0";
						}
				}catch(PDOException $e){
					$WcCount="0";
				}
				if(isset($WcCount)){
					$this->WcCount=$WcCount;
					$pdo_weekend=null;
				}else{
					$pdo_weekend=null;
				}
		}function RunTestWeekendCount(){
			if(isset($this->WcCount)){
				return $this->WcCount;
			}else{}
		}
	}
?>

<?php
	class TestWeekendCountB{
		public $TW_Key,$TW_T,$TW_Y,$TW_KeyId;
		function __construct($TW_Key,$TW_T,$TW_Y,$TW_KeyId){
			$this->TW_Key=$TW_Key;
			$this->TW_T=$TW_T;
			$this->TW_Y=$TW_Y;
			$this->TW_KeyId=$TW_KeyId;
//---------------------------------------------------------------						
			$db_weekendID=$_SERVER['REMOTE_ADDR'];
			$connpdo_weekend=new count_weekend($db_weekendID);
			$pdo_weekend=$connpdo_weekend->call_coun_weekend();			
//---------------------------------------------------------------
			$WeekendCountTxt="E";
//---------------------------------------------------------------
				try{
					$TestWeekendCountSql="SELECT `wc_count` 
										  FROM `weekend_class`
										  WHERE `wc_key`='{$this->TW_Key}' 
										  AND `wc_y`='{$this->TW_Y}' 
										  AND `wc_t`='{$this->TW_T}'";
						if($TestWeekendCountRs=$pdo_weekend->query($TestWeekendCountSql)){
							$TestWeekendCountRow=$TestWeekendCountRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($TestWeekendCountRow) && count($TestWeekendCountRow)){
									$WcCount=$TestWeekendCountRow["wc_count"];		
								}else{
									$WcCount="-";
								}
						}else{
							$WcCount="-";
						}
				}catch(PDOException $e){
					$WcCount="-";
				}
//---------------------------------------------------------------				
				try{
					$TestWeekendSql="SELECT COUNT(`wcr_key`) AS `KeyCount` FROM `weekend_class_rc` 
									 WHERE `weekend_class_wc_key`='{$this->TW_Key}' 
									 AND `wcr_t`='{$this->TW_T}'
									 AND `wcr_y`='{$this->TW_Y}'
									 AND `weekend_class_time_wct_key`='{$this->TW_KeyId}'";
						if($TestWeekendRs=$pdo_weekend->query($TestWeekendSql)){
							$TestWeekendRow=$TestWeekendRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($TestWeekendRow) && count($TestWeekendRow)){
									$KeyCount=$TestWeekendRow["KeyCount"];
									$PrintCount=$KeyCount;
									$KeyCount=$KeyCount+1;
								}else{
									$PrintCount=0;
									$KeyCount="-";					
								}
						}else{
							$PrintCount=0;
							$KeyCount="-";
						}						
				}catch(PDOException $e){
					$KeyCount="-";
					$PrintCount=0;
				}
//---------------------------------------------------------------				
				if($WcCount=="-" or $KeyCount=="-"){
					$WeekendCountTxt="E";
				}elseif($KeyCount<=$WcCount){
					$WeekendCountTxt="N";
				}else{
					$WeekendCountTxt="Y";//เต็ม
				}
//---------------------------------------------------------------
				if(isset($WeekendCountTxt,$PrintCount)){
					$this->WeekendCountTxt=$WeekendCountTxt;
					$this->PrintCount=$PrintCount;
					$pdo_weekend=null;
				}else{
					$pdo_weekend=null;
				}
		}function RunTestWeekendCount(){
			if(isset($this->WeekendCountTxt)){
				return $this->WeekendCountTxt;
			}else{}
		}function RunPrintCount(){
			if(isset($this->PrintCount)){
				return $this->PrintCount;
			}else{}
		}
	}
?>

<?php
	class AddWeekendClass{
		public $wcr_key,$wcr_t,$wcr_y,$wcr_time,$wc_key,$wct_key,$wcr_learn;
		function __construct($wcr_key,$wcr_t,$wcr_y,$wcr_time,$wc_key,$wct_key,$wcr_learn){
			$this->wcr_key=$wcr_key;
			$this->wcr_t=$wcr_t;
			$this->wcr_y=$wcr_y;
			$this->wcr_time=$wcr_time;
			$this->wc_key=$wc_key;
			$this->wct_key=$wct_key;
			$this->wcr_learn=$wcr_learn;
//---------------------------------------------------------------						
			$db_weekendID=$_SERVER['REMOTE_ADDR'];
			$connpdo_weekend=new count_weekend($db_weekendID);
			$pdo_weekend=$connpdo_weekend->call_coun_weekend();			
//---------------------------------------------------------------
			$AddWeekendClassSystem="N";
//---------------------------------------------------------------
			$TestCount=new TestWeekendCountB($this->wc_key,$this->wcr_t,$this->wcr_y,$this->wct_key);
				if($TestCount->RunTestWeekendCount()=="N"){
					

					
					
					try{
						$AddWeekendClass="INSERT INTO `weekend_class_rc`(`wcr_key`, `wcr_t`, `wcr_y`, `wcr_time`, `weekend_class_wc_key`, `weekend_class_time_wct_key`, `wcr_learn`) 
										  VALUES ('{$this->wcr_key}','{$this->wcr_t}','{$this->wcr_y}','{$this->wcr_time}','{$this->wc_key}','{$this->wct_key}','{$this->wcr_learn}')";
						$pdo_weekend->exec($AddWeekendClass);
						$AddWeekendClassSystem="Y";
					}catch(PDOException $e){
						$AddWeekendClassSystem="N";
					}
					
					
				}else{
					$AddWeekendClassSystem="N";
				}
				if(isset($AddWeekendClassSystem)){
					$this->AddWeekendClassSystem=$AddWeekendClassSystem;
					$pdo_weekend=null;
				}else{
					$pdo_weekend=null;
				}
		}function RunAddWeekendClass(){
			if(isset($this->AddWeekendClassSystem)){
				return $this->AddWeekendClassSystem;
			}else{}
		}
	}
?>


<?php
	class PrintWeekendA{
		public $PWA_Class,$PWA_Y,$PWA_T,$PWA_Type;
		function __construct($PWA_Class,$PWA_Y,$PWA_T,$PWA_Type){
			$this->PWA_Class=$PWA_Class;
			$this->PWA_Y=$PWA_Y;
			$this->PWA_T=$PWA_T;
			$this->PWA_Type=$PWA_Type;
//---------------------------------------------------------------						
			$db_weekendID=$_SERVER['REMOTE_ADDR'];
			$connpdo_weekend=new count_weekend($db_weekendID);
			$pdo_weekend=$connpdo_weekend->call_coun_weekend();			
//---------------------------------------------------------------		
			$DataWeekendA=array();
				if($this->PWA_Type=="ALL"){
					try{
						$PrintWeekendASql="select `weekend_class`.`wc_key`,`weekend_class`.`wc_txt`,`weekend_class`.`wc_pay`,`weekend_class`.`wc_count`
										 ,`weekend_class`.`weekend_class_type_wt_on`,`weekend_class_time`.`wct_timeA`,`weekend_class_time`.`wct_timeB`
										 ,`weekend_class_time`.`wct_key`
										   from `weekend_class` join `weekend_class_c` on(`weekend_class`.`wc_key`=`weekend_class_c`.`weekend_class_wc_key`)
										   join `weekend_class_time` on(`weekend_class`.`wc_key`=`weekend_class_time`.`weekend_class_wc_key`)
										   where `weekend_class_c`.`wcc_class`='{$this->PWA_Class}'
										   and `weekend_class_c`.`wcc_y`='{$this->PWA_Y}'
										   and `weekend_class_c`.`wcc_t`='{$this->PWA_T}'
										   and `weekend_class`.`wc_y`='{$this->PWA_Y}'
										   and `weekend_class`.`wc_t`='{$this->PWA_T}'
										   and `weekend_class_time`.`wct_y`='{$this->PWA_Y}'
										   and `weekend_class_time`.`wct_t`='{$this->PWA_T}'
										   order by `wct_timeA` ASC";
							if($PrintWeekendARs=$pdo_weekend->query($PrintWeekendASql)){
								while($PrintWeekendARow=$PrintWeekendARs->Fetch(PDO::FETCH_ASSOC)){
									if(is_array($PrintWeekendARow) && count($PrintWeekendARow)){
										$DataWeekendA[]=$PrintWeekendARow;
									}else{
										$DataWeekendA[]="-";
									}
								}
							}else{
								$DataWeekendA[]="-";
							}
					}catch(PDOException $e){
						$DataWeekendA[]="-";
					}					
				}else{
					try{
						$PrintWeekendASql="select `weekend_class`.`wc_key`,`weekend_class`.`wc_txt`,`weekend_class`.`wc_pay`,`weekend_class`.`wc_count`
										 ,`weekend_class`.`weekend_class_type_wt_on`,`weekend_class_time`.`wct_timeA`,`weekend_class_time`.`wct_timeB`
										 ,`weekend_class_time`.`wct_key`
										   from `weekend_class` join `weekend_class_c` on(`weekend_class`.`wc_key`=`weekend_class_c`.`weekend_class_wc_key`)
										   join `weekend_class_time` on(`weekend_class`.`wc_key`=`weekend_class_time`.`weekend_class_wc_key`)
										   where `weekend_class_c`.`wcc_class`='{$this->PWA_Class}'
										   and `weekend_class_c`.`wcc_y`='{$this->PWA_Y}'
										   and `weekend_class_c`.`wcc_t`='{$this->PWA_T}'
										   and `weekend_class`.`wc_y`='{$this->PWA_Y}'
										   and `weekend_class`.`wc_t`='{$this->PWA_T}'
										   and `weekend_class_time`.`wct_y`='{$this->PWA_Y}'
										   and `weekend_class_time`.`wct_t`='{$this->PWA_T}'
										   and `weekend_class`.`weekend_class_type_wt_on`='{$this->PWA_Type}'
										   order by `wct_timeA` ASC";
							if($PrintWeekendARs=$pdo_weekend->query($PrintWeekendASql)){
								while($PrintWeekendARow=$PrintWeekendARs->Fetch(PDO::FETCH_ASSOC)){
									if(is_array($PrintWeekendARow) && count($PrintWeekendARow)){
										$DataWeekendA[]=$PrintWeekendARow;
									}else{
										$DataWeekendA[]="-";
									}
								}
							}else{
								$DataWeekendA[]="-";
							}
					}catch(PDOException $e){
						$DataWeekendA[]="-";
					}					
				}
				if(isset($DataWeekendA)){
					$this->DataWeekendA=$DataWeekendA;
					$pdo_weekend=null;
				}else{
					$pdo_weekend=null;
				}
		}function RunPrintWeekendA(){
			if(isset($this->DataWeekendA)){
				return $this->DataWeekendA;
			}else{}
		}
	}

?>

<?php
	class WeekendSystem{
		public $WS_Class;
		public $WeekendSystemPrint;
		function __construct($WS_Class){
//---------------------------------------------------------------
		$this->WS_Class=$WS_Class;
//---------------------------------------------------------------						
		$db_weekendID=$_SERVER['REMOTE_ADDR'];
		$connpdo_weekend=new count_weekend($db_weekendID);
		$pdo_weekend=$connpdo_weekend->call_coun_weekend();			
//---------------------------------------------------------------	
		$WeekendSystemPrint=array();
//---------------------------------------------------------------			
			try{
				$WeekendSystemSql="SELECT `ws_key`, `ws_classA`, `ws_classB`, `ws_test_time`, `ws_test_class`, `weekend_discount_wd_key` 
							       FROM `weekend_system` 
								   WHERE `ws_classA`='{$this->WS_Class}';";
					if($WeekendSystemRs=$pdo_weekend->query($WeekendSystemSql)){
						$WeekendSystemRow=$WeekendSystemRs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($WeekendSystemRow) && count($WeekendSystemRow)){
								$WeekendSystemPrint[]=$WeekendSystemRow;
							}else{
								$WeekendSystemPrint[]="-";
							}
					}else{
						$WeekendSystemPrint="-";
					}
			}catch(PDOException $e){
				$WeekendSystemPrint=null;			
			}
			if(isset($WeekendSystemPrint)){
				$this->WeekendSystemPrint=$WeekendSystemPrint;
				$pdo_weekend=null;
			}else{
				$pdo_weekend=null;
			}
		}function RunWeekendSystem(){
			if(isset($this->WeekendSystemPrint)){
				return $this->WeekendSystemPrint;
			}else{}
		}
	}
?>

<?php
	class PrintYTWeekendClass{
		public $PYTWC_T,$PYTWC_Y;
		function __construct($PYTWC_T,$PYTWC_Y){
//---------------------------------------------------------------
			$this->PYTWC_T=$PYTWC_T;
			$this->PYTWC_Y=$PYTWC_Y;
//---------------------------------------------------------------						
			$db_weekendID=$_SERVER['REMOTE_ADDR'];
			$connpdo_weekend=new count_weekend($db_weekendID);
			$pdo_weekend=$connpdo_weekend->call_coun_weekend();			
//---------------------------------------------------------------	
			$PrintYTWeekendClassArray=array();
//---------------------------------------------------------------
			try{
				$PrintYTWeekendClassSql="SELECT `wc_key`, `wc_txt`, `wc_y`, `wc_t`, `wc_pay`, `wc_count`, `weekend_class_type_wt_on` 
										 FROM `weekend_class` 
										 WHERE `wc_y`='{$this->PYTWC_Y}' AND `wc_t`='{$this->PYTWC_T}'";
					if($PrintYTWeekendClassRs=$pdo_weekend->query($PrintYTWeekendClassSql)){
						while($PrintYTWeekendClassRow=$PrintYTWeekendClassRs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($PrintYTWeekendClassRow) && count($PrintYTWeekendClassRow)){
								$PrintYTWeekendClassArray[]=$PrintYTWeekendClassRow;
							}else{
								$PrintYTWeekendClassArray[]="-";
							}
						}
					}else{
						$PrintYTWeekendClassArray[]="-";
					}
			}catch(PDOException $e){
				$PrintYTWeekendClassArray[]="-";
			}
			if(isset($PrintYTWeekendClassArray)){
				$this->PrintYTWeekendClassArray=$PrintYTWeekendClassArray;
				$pdo_weekend=null;
			}else{
				$pdo_weekend=null;
			}
		}function RunPrintYTWeekendClass(){
			if(isset($this->PrintYTWeekendClassArray)){
				return $this->PrintYTWeekendClassArray;
			}else{}
		}
	}
?>