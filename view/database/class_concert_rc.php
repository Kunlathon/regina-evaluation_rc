
<?php
	class StatisticsPayConcert{
		public $SPC_Type,$SPC_Year,$SPC_PayType,$SPC_Id;
		function __construct($SPC_Type,$SPC_Year,$SPC_PayType,$SPC_Id){
			$this->SPC_Type=$SPC_Type;
			$this->SPC_Year=$SPC_Year;
			$this->SPC_PayType=$SPC_PayType;
			$this->SPC_Id=$SPC_Id;
			$SPC_Array=array();
			$SPC_Error="Error";
			$PRKC_DB=new connect_concert();
			$PRKC_Concert=$PRKC_DB->connect_db_ConcertRc();
				if($this->SPC_Type=="Datapay"){
					try{
						$DatapaySql="select `list_concert`.`PC_no`,`list_concert`.`NC_no`,`list_concert`.`KC_Id`,`list_concert`.`KC_price`,`pay_concert`.`PC_pay`,`pay_concert`.`PC_SaveDay`,`pay_concert`.`PC_savetime`
									 from `pay_concert` join `list_concert` on (`pay_concert`.`PC_no`=`list_concert`.`PC_no`)
									 where `pay_concert`.`PC_year`='{$this->SPC_Year}' and `pay_concert`.`PC_pay`='{$this->SPC_PayType}';";
							if($DatapayRs=$PRKC_Concert->query($DatapaySql)){
								while($DatapayRow=$DatapayRs->Fetch(PDO::FETCH_ASSOC)){
									if(is_array($DatapayRow) &&count($DatapayRow)){
										$SPC_Array[]=$DatapayRow;
										$SPC_Error="NoError";
									}else{
										$SPC_Array[]="-";
										$SPC_Error="Error";
									}
								}
							}else{
								$SPC_Array[]="-";
								$SPC_Error="Error";
							}
					}catch(PDOException $e){
						$SPC_Array[]="-";
						$SPC_Error="Error";						
					}
				}elseif($this->SPC_Type=="DatapayPrice"){
					try{
						$DatapayPriceSql="select * from `pay_concert` join `list_concert` on (`pay_concert`.`PC_no`=`list_concert`.`PC_no`)
										  where `pay_concert`.`PC_year`='{$this->SPC_Year}' and `list_concert`.`KC_Id`='{$this->SPC_Id}'";
							if($DatapayPriceRs=$PRKC_Concert->query($DatapayPriceSql)){
								while($DatapayPriceRow=$DatapayPriceRs->Fetch(PDO::FETCH_ASSOC)){
									if(is_array($DatapayPriceRow) &&count($DatapayPriceRow)){
										$SPC_Array[]=$DatapayPriceRow;
										$SPC_Error="NoError";
									}else{
										$SPC_Array[]="-";
										$SPC_Error="Error";
									}
								}
							}else{
								$SPC_Array[]="-";
								$SPC_Error="Error";
							}
					}catch(PDOException $e){
						$SPC_Array[]="-";
						$SPC_Error="Error";						
					}					
				}elseif($this->SPC_Type=="ReceiptAll"){
					try{
						$ReceiptAllSql="select * from `pay_concert` join `list_concert` on (`pay_concert`.`PC_no`=`list_concert`.`PC_no`)
										where `pay_concert`.`PC_year`='{$this->SPC_Year}' and `pay_concert`.`PC_no`='{$this->SPC_Id}';";
							if($ReceiptAllRs=$PRKC_Concert->query($ReceiptAllSql)){
								while($ReceiptAllRow=$ReceiptAllRs->Fetch(PDO::FETCH_ASSOC)){
									if(is_array($ReceiptAllRow) &&count($ReceiptAllRow)){
										$SPC_Array[]=$ReceiptAllRow;
										$SPC_Error="NoError";
									}else{
										$SPC_Array[]="-";
										$SPC_Error="Error";
									}
								}
							}else{
								$SPC_Array[]="-";
								$SPC_Error="Error";
							}
					}catch(PDOException $e){
						$SPC_Array[]="-";
						$SPC_Error="Error";						
					}					
				}elseif($this->SPC_Type=="Receipt"){
					try{
						$ReceiptAllSql="SELECT * FROM `pay_concert` WHERE `PC_year`='{$this->SPC_Year}';";
							if($ReceiptRs=$PRKC_Concert->query($ReceiptSql)){
								while($ReceiptRow=$ReceiptRs->Fetch(PDO::FETCH_ASSOC)){
									if(is_array($ReceiptRow) &&count($ReceiptRow)){
										$SPC_Array[]=$ReceiptRow;
										$SPC_Error="NoError";
									}else{
										$SPC_Array[]="-";
										$SPC_Error="Error";
									}
								}
							}else{
								$SPC_Array[]="-";
								$SPC_Error="Error";
							}
					}catch(PDOException $e){
						$SPC_Array[]="-";
						$SPC_Error="Error";						
					}					
				}else{
					$SPC_Array[]="-";
					$SPC_Error="Error";
				}
//----------------------------------------------------------------------				
			if(isset($SPC_Array)){
				$this->SPC_Array=$SPC_Array;
			}else{}
			if(isset($SPC_Error)){
				$this->SPC_Error=$SPC_Error;
			}else{}
//----------------------------------------------------------------------
			$PRKC_Concert=null;
		}function RunSPC_Array(){
			if(isset($this->SPC_Array)){
				return $this->SPC_Array;
			}else{}
		}function RunSPC_Error(){
			if(isset($this->SPC_Error)){
				return $this->SPC_Error;
			}else{}			
		}
	}

?>


<?php
	class CreatePayConcertNo{
		public $CPCN_Year;
		function __construct($CPCN_Year){
			//$CPCN_Error="ERROR";
			$this->CPCN_Year=$CPCN_Year;
			$PRKC_DB=new connect_concert();
			$PRKC_Concert=$PRKC_DB->connect_db_ConcertRc();			

//Create KeyConcert
				try{
					$CK_Sql="SELECT COUNT(`PC_no`) AS `INTPC` FROM `pay_concert` WHERE `PC_year`='{$this->CPCN_Year}';";
					$CK_Rs=$PRKC_Concert->query($CK_Sql);
					$CK_Row=$CK_Rs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($CK_Row) && count($CK_Row)){
							$INTPC=$CK_Row["INTPC"];
						}else{
							$INTPC=0;
						}
				}catch(PDOException $e){
						$INTPC=0;
				}
//--------------------------------------------------------------------------------------------------------------					
						$Copy_PC=$INTPC+1;
//--------------------------------------------------------------------------------------------------------------						
						if($Copy_PC<=9){
							$CreateKeyConcert=$this->CPCN_Year."000".$Copy_PC;
						}elseif($Copy_PC<=99){
							$CreateKeyConcert=$this->CPCN_Year."00".$Copy_PC;
						}elseif($Copy_PC<=999){
							$CreateKeyConcert=$this->CPCN_Year."0".$Copy_PC;
						}else{
							$CreateKeyConcert=$this->CPCN_Year.$Copy_PC;
						}
//Test 	Create KeyConcert	

							try{
								$TCKCSql="SELECT count(`PC_no`) AS `IntPCNo`
										  FROM `pay_concert` 
										  WHERE `PC_no`='{$CreateKeyConcert}' AND `PC_year`='{$this->CPCN_Year}'";
									if($TCKCRs=$PRKC_Concert->query($TCKCSql)){
										$TCKCRow=$TCKCRs->Fetch(PDO::FETCH_ASSOC);
											if(is_array($TCKCRow) && count($TCKCRow)){
												$IntPCNo=$TCKCRow["IntPCNo"];
											}else{
												$IntPCNo=0;
											}
									}else{
										$IntPCNo=0;
									}
							}catch(PDOException $e){
								$IntPCNo=0;
							}
						
							while($IntPCNo!=0){
								
								$Copy_PC=$Copy_PC+1;
									if($Copy_PC<=9){
										$CreateKeyConcert=$this->CPCN_Year."000".$Copy_PC;
									}elseif($Copy_PC<=99){
										$CreateKeyConcert=$this->CPCN_Year."00".$Copy_PC;
									}elseif($Copy_PC<=999){
										$CreateKeyConcert=$this->CPCN_Year."0".$Copy_PC;
									}else{
										$CreateKeyConcert=$this->CPCN_Year.$Copy_PC;
									}
								
									try{
										$TCKCSql="SELECT count(`PC_no`) AS `IntPCNo`
												  FROM `pay_concert` 
												  WHERE `PC_no`='{$CreateKeyConcert}' AND `PC_year`='{$this->CPCN_Year}'";
											if($TCKCRs=$PRKC_Concert->query($TCKCSql)){
												$TCKCRow=$TCKCRs->Fetch(PDO::FETCH_ASSOC);
													if(is_array($TCKCRow) && count($TCKCRow)){
														$IntPCNo=$TCKCRow["IntPCNo"];
													}else{
														$IntPCNo=0;
													}
											}else{
												$IntPCNo=0;
											}
									}catch(PDOException $e){
										$IntPCNo=0;
									}								
								
							}

	
//Test 	Create KeyConcert End
			if(isset($CreateKeyConcert)){
				$this->CreateKeyConcert=$CreateKeyConcert;
			}else{}
		}function RunCreatePayConcertNo(){
			if(isset($this->CreateKeyConcert)){
				return $this->CreateKeyConcert;
			}else{}
		}
	}

?>




<?php
	class ManagementPayingKeyConcert{
		public $MPKC_Type,$MPKC_PC_no,$MPKC_PC_year,$MPKC_PC_pay,$MPKC_NC_no,$MPKC_KC_id,$MPKC_KC_price,$MPKC_Admin;
		function __construct($MPKC_Type,$MPKC_PC_no,$MPKC_PC_year,$MPKC_PC_pay,$MPKC_NC_no,$MPKC_KC_id,$MPKC_KC_price,$MPKC_Admin){
			$MPKC_Error="ERROR";
			$MPKC_Array=array();
			$MPKC_DateTime=date("Y-m-d H:i:s");
			$MPKC_Date=date("Y-m-d");
			$this->MPKC_Type=$MPKC_Type;
			$this->MPKC_PC_no=$MPKC_PC_no;
			$this->MPKC_PC_year=$MPKC_PC_year;
			$this->MPKC_PC_pay=$MPKC_PC_pay;
			$this->MPKC_NC_no=$MPKC_NC_no;
			$this->MPKC_KC_id=$MPKC_KC_id;
			$this->MPKC_KC_price=$MPKC_KC_price;
			$this->MPKC_Admin=$MPKC_Admin;
			//$db_concertID=$_SERVER['REMOTE_ADDR'];
			$PRKC_DB=new connect_concert();
			$PRKC_Concert=$PRKC_DB->connect_db_ConcertRc();	
				if($this->MPKC_Type=="AddUpPayConcert"){					
//Into : pay_concert
						try{
							$PayConcertAddSql="INSERT INTO `pay_concert`(`PC_no`, `PC_year`, `PC_savetime`,`PC_SaveDay`,`PC_pay`) 
											   VALUES ('{$this->MPKC_PC_no}','{$this->MPKC_PC_year}','{$MPKC_DateTime}','{$MPKC_Date}','{$this->MPKC_PC_pay}')";
							$PRKC_Concert->exec($PayConcertAddSql);
							$MPKC_Error="NoERROR";
							$MPKC_Array[]="-";
						}catch(PDOException $e){
//UpDate : pay_concert
							$MPKC_Error="ERROR";
							$MPKC_Array[]="-";
							/*try{
								$PayConcertUpSql="UPDATE `pay_concert` SET `PC_savetime`='{$MPKC_DateTime}',`PC_SaveDay`='{$MPKC_Date}',`PC_pay`='{$this->MPKC_PC_pay}' 
												  WHERE `PC_no`='{$this->MPKC_PC_no}' AND `PC_year`='{$this->MPKC_PC_year}'";
								$PRKC_Concert->exec($PayConcertUpSql);
								$MPKC_Error="NoERROR";
								$MPKC_Array[]="-";								
							}catch(PDOException $e){
								$MPKC_Error="ERROR";
								$MPKC_Array[]="-";								
							}*/
//UpDate : pay_concert	End												
						}
//Into : pay_concert End					
				}elseif($this->MPKC_Type=="AddListConcert"){
//Into : list_concert
					try{
						$ListConcertAddSql="INSERT INTO `list_concert`(`PC_no`, `NC_no`, `KC_Id`, `KC_price`) VALUES 
											('{$this->MPKC_PC_no}','{$this->MPKC_NC_no}','{$this->MPKC_KC_id}','{$this->MPKC_KC_price}')";
						$PRKC_Concert->exec($ListConcertAddSql);
						$MPKC_Error="NoERROR";
						$MPKC_Array[]="-";
					}catch(PDOException $e){
						$MPKC_Error="ERROR";
						$MPKC_Array[]="-";
								
					}
//Into : list_concert End					
				}elseif($this->MPKC_Type=="DeleteAll"){
//Delete : pay_concert					
					try{
						$DeletePayConcertSql="DELETE FROM `pay_concert` WHERE `PC_no`='{$this->MPKC_PC_no}'";
						$PRKC_Concert->exec($DeletePayConcertSql);
//Delete : list_concert
							try{
								$DeleteListConcertSql="DELETE FROM `list_concert` WHERE `PC_no`='{$this->MPKC_PC_no}'";
								$PRKC_Concert->exec($DeleteListConcertSql);
								$MPKC_Error="NoERROR";
								$MPKC_Array[]="-";								
							}catch(PDOException $e){
								$MPKC_Error="ERROR";
								$MPKC_Array[]="-";								
							}
//Delete : list_concert End						
					}catch(PDOException $e){
						$MPKC_Error="ERROR";
						$MPKC_Array[]="-";						
					}
//Delete : pay_concert End						
				}elseif($this->MPKC_Type=="DeleteLC"){
//Delete : list_concert
					try{
						$DeleteListConcertSql="DELETE FROM `list_concert` WHERE `NC_no`='{$this->MPKC_NC_no}'";
						$PRKC_Concert->exec($DeleteListConcertSql);
						$MPKC_Error="NoERROR";
						$MPKC_Array[]="-";								
					}catch(PDOException $e){
						$MPKC_Error="ERROR";
						$MPKC_Array[]="-";								
					}
//Delete : list_concert End						
				}elseif($this->MPKC_Type=="DeleteLCCAll"){
//Delete : list_concert_copy					
					try{
						$DeleteListConcertCopySql="DELETE FROM `list_concert_copy` WHERE `LCC_Admin`='{$this->MPKC_Admin}'";
						$PRKC_Concert->exec($DeleteListConcertCopySql);
						$MPKC_Error="NoERROR";
						$MPKC_Array[]="-";						
					}catch(PDOException $e){
						$MPKC_Error="ERROR";
						$MPKC_Array[]="-";						
					}
//Delete : list_concert_copy End					
				}elseif($this->MPKC_Type=="DeleteLCC"){
//Delete : list_concert_copy
					try{
						$DeleteListConcertCopySql="DELETE FROM `list_concert_copy` WHERE `LCC_NC_no`='{$this->MPKC_NC_no}'";
						$PRKC_Concert->exec($DeleteListConcertCopySql);
						$MPKC_Error="NoERROR";
						$MPKC_Array[]="-";						
					}catch(PDOException $e){
						$MPKC_Error="ERROR";
						$MPKC_Array[]="-";						
					}
//Delete : list_concert_copy End				
				}elseif($this->MPKC_Type=="AddLCC"){
//Add : list_concert_copy
					try{
						$AddListConcertCopySql="INSERT INTO `list_concert_copy`(`LCC_NC_no`, `LCC_KC_Id`, `LCC_KC_price`, `LCC_Admin`, `LCC_Time`) 
						                        VALUES ('{$this->MPKC_NC_no}','{$this->MPKC_KC_id}','{$this->MPKC_KC_price}','{$this->MPKC_Admin}','{$MPKC_DateTime}')";
						$PRKC_Concert->exec($AddListConcertCopySql);
						$MPKC_Error="NoERROR";
						$MPKC_Array[]="-";						
					}catch(PDOException $e){
						$MPKC_Error="ERROR";
						$MPKC_Array[]="-";						
					}
//Add : list_concert_copy End					
				}else{
					$MPKC_Error="ERROR";
					$MPKC_Array[]="-";
				}
//--------------------------------------------------------------------------------------------------------------				
			if(isset($MPKC_Error)){
				$this->MPKC_Error=$MPKC_Error;
			}else{}
			if(isset($MPKC_Array)){
				$this->MPKC_Array=$MPKC_Array;
			}else{}
			if(isset($CreateKeyConcert)){
				$this->CreateKeyConcert=$CreateKeyConcert;
			}else{}
			$PRKC_Concert=null;
//--------------------------------------------------------------------------------------------------------------			
		}function RunMPKC_Error(){
			if(isset($this->MPKC_Error)){
				return $this->MPKC_Error;
			}else{}
		}function RunMPKC_Array(){
			if(isset($this->MPKC_Array)){
				return $this->MPKC_Array;
			}else{}			
		}function PrintCreateKeyConcert(){
			if(isset($this->CreateKeyConcert)){
				return $this->CreateKeyConcert;
			}else{}
		}
	}
?>



<?php
	class ManagementPayKeyConcert{//การจัดการแสดงรายการบัตร
		public $MPKC_Type,$MPKC_Year,$MPKC_PayID,$MPKC_KeyID,$MPKC_Admin;
		function __construct($MPKC_Type,$MPKC_Year,$MPKC_PayID,$MPKC_KeyID,$MPKC_Admin){
			$MPKC_Error="ERROR";
			$MPKC_Array=array();
			$MPKC_CountLCC=0;
			$MPKC_CountLC=0;
			$this->MPKC_Type=$MPKC_Type;
			$this->MPKC_Year=$MPKC_Year;
			$this->MPKC_PayID=$MPKC_PayID;
			$this->MPKC_KeyID=$MPKC_KeyID;
			$this->MPKC_Admin=$MPKC_Admin;
			//$db_concertID=$_SERVER['REMOTE_ADDR'];
			$PRKC_DB=new connect_concert();
			$PRKC_Concert=$PRKC_DB->connect_db_ConcertRc();			
				if($this->MPKC_Type=="READKeyConAll"){
					try{
						$MPKC_Sql="select * from `number_concert` 
								   right join `key_concert` on `number_concert`.`KC_Id`=`key_concert`.`KC_Id` 
								   where `key_concert`.`KC_year`='{$this->MPKC_Year}';";
						if($MPKC_Rs=$PRKC_Concert->query($MPKC_Sql)){
							while($MPKC_Row=$MPKC_Rs->Fetch(PDO::FETCH_ASSOC)){
								if(is_array($MPKC_Row) && count($MPKC_Row)){
									$MPKC_Array[]=$MPKC_Row;
									$MPKC_Error="NoERROR";
								}else{
									$MPKC_Array[]="-";
									$MPKC_Error="ERROR";
								}
							}							
						}else{
							$MPKC_Array[]="-";
							$MPKC_Error="ERROR";							
						}
					}catch(PDOException $e){
						$MPKC_Array[]="-";
						$MPKC_Error="ERROR";
					}
				}elseif($this->MPKC_Type=="READKeyConPayA"){//แสดงรายการบัตรเลือกราคา
					try{
						$MPKC_Sql="select * from `number_concert` 
								   right join `key_concert` on `number_concert`.`KC_Id`=`key_concert`.`KC_Id` 
								   where `key_concert`.`KC_year`='{$this->MPKC_Year}' 
								   and `key_concert`.`KC_Id`='{$this->MPKC_KeyID}' ORDER BY `number_concert`.`NC_page` ASC;";
						$MPKC_Rs=$PRKC_Concert->query($MPKC_Sql);
							while($MPKC_Row=$MPKC_Rs->Fetch(PDO::FETCH_ASSOC)){
								if(is_array($MPKC_Row) && count($MPKC_Row)){
									$MPKC_Array[]=$MPKC_Row;
									$MPKC_Error="NoERROR";
								}else{
									$MPKC_Array[]="-";
									$MPKC_Error="ERROR";
								}
							}
					}catch(PDOException $e){
						$MPKC_Array[]="-";
						$MPKC_Error="ERROR";
					}					
				}elseif($this->MPKC_Type=="DataTest"){//แสดงรายการบัตรเลือกราคา จำแนกสถานะ จอง ชื้อแล้ว ว่าง
//Test DB : list_concert_copy  
					try{
						$TestListConcertCopySql="select count(`list_concert_copy`.`LCC_NC_no`) as `CountLCC` 
												 from `key_concert` right join `list_concert_copy` on `key_concert`.`KC_Id`=`list_concert_copy`.`LCC_KC_Id` 
												 where `key_concert`.`KC_year`='{$this->MPKC_Year}' 
												 and `list_concert_copy`.`LCC_NC_no`='{$this->MPKC_KeyID}';";
						$TestListConcertCopyRs=$PRKC_Concert->query($TestListConcertCopySql);
						$TestListConcertCopyRow=$TestListConcertCopyRs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($TestListConcertCopyRow) && count($TestListConcertCopyRow)){
								$MPKC_Array[]="-";
								$MPKC_Error="NoERROR";
								$MPKC_CountLCC=$TestListConcertCopyRow["CountLCC"];
							}else{
								$MPKC_Array[]="-";
								$MPKC_Error="ERROR";
								$MPKC_CountLCC=0;
							}
					}catch(PDOException $e){
						$MPKC_Array[]="-";
						$MPKC_Error="ERROR";
						$MPKC_CountLCC=0;
					}
//Test DB : list_concert_copy End					
//Test DB : list_concert
					try{
						$TestListConcertSql="select count(`list_concert`.`NC_no`) as `CountLC`
										     from `key_concert` 
										     right join `list_concert` 
									         on `key_concert`.`KC_Id`=`list_concert`.`KC_Id`
											 where `key_concert`.`KC_year`='{$this->MPKC_Year}'
											 and `list_concert`.`NC_no`='{$this->MPKC_KeyID}';";
						$TestListConcertRs=$PRKC_Concert->query($TestListConcertSql);
						$TestListConcertRow=$TestListConcertRs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($TestListConcertRow) && count($TestListConcertRow)){
								$MPKC_Array[]="-";
								$MPKC_Error="NoERROR";
								$MPKC_CountLC=$TestListConcertRow["CountLC"];										
							}else{
								$MPKC_Array[]="-";
								$MPKC_Error="ERROR";  
								$MPKC_CountLC=0;										
							}
					}catch(PDOException $e){
						$MPKC_Array[]="-";
						$MPKC_Error="ERROR";
						$MPKC_CountLC=0;						
					}
//Test DB : list_concert End					
				}elseif($this->MPKC_Type=="READ_LCC"){
					try{
						$TestListConcertCopySql="select * 
												 from `key_concert` right join `list_concert_copy` on `key_concert`.`KC_Id`=`list_concert_copy`.`LCC_KC_Id` 
												 where `key_concert`.`KC_year`='{$this->MPKC_Year}' 
												 and `list_concert_copy`.`LCC_NC_no`='{$this->MPKC_KeyID}';";
						$TestListConcertCopyRs=$PRKC_Concert->query($TestListConcertCopySql);
							while($TestListConcertCopyRow=$TestListConcertCopyRs->Fetch(PDO::FETCH_ASSOC)){
								if(is_array($TestListConcertCopyRow) && count($TestListConcertCopyRow)){
									$MPKC_Array[]=$TestListConcertCopyRow;
									$MPKC_Error="NoERROR";
									$MPKC_CountLCC=0;
								}else{
									$MPKC_Array[]="-";
									$MPKC_Error="ERROR";
									$MPKC_CountLCC=0;
								}									
							} 
					}catch(PDOException $e){
						$MPKC_Array[]="-";
						$MPKC_Error="ERROR";
						$MPKC_CountLCC=0;
					}					
				}elseif($this->MPKC_Type=="READ_LCC_ALL"){
					try{
						$TestListConcertCopySql="select * 
												 from `key_concert` right join `list_concert_copy` on `key_concert`.`KC_Id`=`list_concert_copy`.`LCC_KC_Id` 
												 where `key_concert`.`KC_year`='{$this->MPKC_Year}' 
												 and `list_concert_copy`.`LCC_Admin`='{$this->MPKC_Admin}';";
						$TestListConcertCopyRs=$PRKC_Concert->query($TestListConcertCopySql);
							while($TestListConcertCopyRow=$TestListConcertCopyRs->Fetch(PDO::FETCH_ASSOC)){
								if(is_array($TestListConcertCopyRow) && count($TestListConcertCopyRow)){
									$MPKC_Array[]=$TestListConcertCopyRow;
									$MPKC_Error="NoERROR";
									$MPKC_CountLCC=0;
								}else{
									$MPKC_Array[]="-";
									$MPKC_Error="ERROR";
									$MPKC_CountLCC=0;
								}									
							} 
					}catch(PDOException $e){
						$MPKC_Array[]="-";
						$MPKC_Error="ERROR";
						$MPKC_CountLCC=0;
					}					
				}elseif($this->MPKC_Type=="READ_LC"){
					try{
						$TestListConcertSql="select *
										     from `key_concert` 
										     right join `list_concert` 
									         on `key_concert`.`KC_Id`=`list_concert`.`KC_Id`
											 where `key_concert`.`KC_year`='{$this->MPKC_Year}'
											 and `list_concert`.`NC_no`='{$this->MPKC_KeyID}';";
						$TestListConcertRs=$PRKC_Concert->query($TestListConcertSql);
							while($TestListConcertRow=$TestListConcertRs->Fetch(PDO::FETCH_ASSOC)){
								if(is_array($TestListConcertRow) && count($TestListConcertRow)){
									$MPKC_Array[]=$TestListConcertRow;
									$MPKC_Error="NoERROR";
									$MPKC_CountLC=0;										
								}else{
									$MPKC_Array[]="-";
									$MPKC_Error="ERROR";
									$MPKC_CountLC=0;										
								}									
							}
					}catch(PDOException $e){
						$MPKC_Array[]="-";
						$MPKC_Error="ERROR";
						$MPKC_CountLC=0;						
					}					
				}else{
					$MPKC_Array[]="-";
					$MPKC_Error="ERROR";
				}
//------------------------------------------------------
				if(isset($MPKC_Array)){
					$this->MPKC_Array=$MPKC_Array;
				}else{}
				if(isset($MPKC_Error)){
					$this->MPKC_Error=$MPKC_Error;
				}else{}
				if(isset($MPKC_CountLCC)){
					$this->MPKC_CountLCC=$MPKC_CountLCC;
				}else{}
				if(isset($MPKC_CountLC)){
					$this->MPKC_CountLC=$MPKC_CountLC;
				}else{}
//------------------------------------------------------				
				$PRKC_Concert=null;
				
		}function RunMPKC_Array(){
			if(isset($this->MPKC_Array)){
				return $this->MPKC_Array;
			}else{}
		}function RunMPKC_Error(){
			if(isset($this->MPKC_Error)){
				return $this->MPKC_Error;
			}else{}			
		}function RunMPKC_CountLCC(){
			if(isset($this->MPKC_CountLCC)){
				return $this->MPKC_CountLCC;
			}else{}
		}function RunMPKC_CountLC(){
			if(isset($this->MPKC_CountLC)){
				return $this->MPKC_CountLC;
			}else{}			
		}
	}
?>





<?php
	class ManagementRowKeyConcert{
		public $PRKC_Type,$PRKC_KC_Id,$PRKC_KC_year,$PRKC_KC_price,$PRKC_KC_row,$PRKC_KC_page,$PRKC_KC_Daypay;
		function __construct($PRKC_Type,$PRKC_KC_Id,$PRKC_KC_year,$PRKC_KC_price,$PRKC_KC_row,$PRKC_KC_page,$PRKC_KC_Daypay){
//------------------------------------------------------------------------------------------------------------			
			$PRKC_Error="ERROR";
			$PRKC_Array=array();
//------------------------------------------------------------------------------------------------------------			
			$this->PRKC_Type=$PRKC_Type;
			$this->PRKC_KC_Id=$PRKC_KC_Id;
			$this->PRKC_KC_year=$PRKC_KC_year;
			$this->PRKC_KC_price=$PRKC_KC_price;
			$this->PRKC_KC_row=$PRKC_KC_row;
			$this->PRKC_KC_page=$PRKC_KC_page;
			$this->PRKC_KC_Daypay=$PRKC_KC_Daypay;
//------------------------------------------------------------------------------------------------------------
			//$db_concertID=$_SERVER['REMOTE_ADDR'];
			$PRKC_DB=new connect_concert();
			$PRKC_Concert=$PRKC_DB->connect_db_ConcertRc();
//------------------------------------------------------------------------------------------------------------
			if($this->PRKC_Type=="READRow"){
				try{
					$PRKCAddSql="SELECT * FROM `key_concert` 
								 WHERE `KC_year`='{$this->PRKC_KC_year}' 
								 ORDER BY `KC_Id` ASC";
						if($PRKCReadRs=$PRKC_Concert->query($PRKCAddSql)){
							while($PRKCReadRow=$PRKCReadRs->Fetch(PDO::FETCH_ASSOC)){
								if(is_array($PRKCReadRow) && count($PRKCReadRow)){
									$PRKC_Array[]=$PRKCReadRow;
									$PRKC_Error="NoERROR";
								}else{
									$PRKC_Array="-";
									$PRKC_Error="ERROR";
								}
							}
						}else{
							$PRKC_Array="-";
							$PRKC_Error="ERROR";						
						}
				}catch(PDOException $e){
					$PRKC_Array=null;
					$PRKC_Error="ERROR";				
				}				
			}elseif($this->PRKC_Type=="ADD"){
					try{
						$PRKCAddSql="INSERT INTO `key_concert`(`KC_Id`, `KC_year`, `KC_price`, `KC_row`, `KC_page`, `KC_Daypay`, `KC_Savetime`) 
						             VALUES ('{$this->PRKC_KC_Id}','{$this->PRKC_KC_year}','{$this->PRKC_KC_price}','{$this->PRKC_KC_row}','{$this->PRKC_KC_page}','{$this->PRKC_KC_Daypay}','{$PRKC_KC_Savetime}')";
						$PRKC_Concert->exec($PRKCAddSql);
						$PRKC_Error="NoERROR";
						$PRKC_Array="-";
					}catch(PDOException $e){
						$PRKC_Error="ERROR";
						$PRKC_Array="-";
					}				
			}else{
				$PRKC_Array="-";
				$PRKC_Error="ERROR";
			}
//------------------------------------------------------------------------------------------------------------			
			if(isset($PRKC_Array)){
				$this->PRKC_Array=$PRKC_Array;
			}else{}
			if(isset($PRKC_Error)){
				$this->PRKC_Error=$PRKC_Error;
			}else{}
//------------------------------------------------------------------------------------------------------------	
			$PRKC_Concert=null;
//------------------------------------------------------------------------------------------------------------			
		}function RunPRKC_Array(){
			if(isset($this->PRKC_Array)){
				return $this->PRKC_Array;
			}else{}
		}function RunPRKC_Error(){
			if(isset($this->PRKC_Error)){
				return $this->PRKC_Error;
			}else{}			
		}
	}

?>