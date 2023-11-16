<?php
error_reporting(error_reporting() & ~E_NOTICE);
?>


<?php
	class CallJoinAttentionSud{
		public $CJA_uesr,$CJA_year,$CJA_class;
		public $ArrayJoinAttentionSud;
		function __construct($CJA_uesr,$CJA_year,$CJA_class){
//------------------------------------------------------------------------------
			$TalentID=$_SERVER['REMOTE_ADDR'];
			$connect_talent=new Connect_PdoTalent($TalentID);
			$pdo_talent=$connect_talent->call_PdoTalent();
//------------------------------------------------------------------------------
			$ArrayJoinAttentionSud=array();
//------------------------------------------------------------------------------
			$this->CJA_uesr=$CJA_uesr;
			$this->CJA_year=$CJA_year;
			$this->CJA_class=$CJA_class;
//------------------------------------------------------------------------------
			$JoinAttentionSudSql="SELECT `JA_num`,`JA_txt` FROM `join_attention` 
						          WHERE `JA_uesr`='{$this->CJA_uesr}' 
								  AND `JA_year`='{$this->CJA_year}'
								  AND `JA_class`='{$this->CJA_class}' 
								  ORDER BY `join_attention`.`JA_num` ASC";
				if($JoinAttentionSudRs=$pdo_talent->query($JoinAttentionSudSql)){
					while($JoinAttentionSudRow=$JoinAttentionSudRs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($JoinAttentionSudRow) && count($JoinAttentionSudRow)){
							$ArrayJoinAttentionSud[]=$JoinAttentionSudRow;
						}else{
							$ArrayJoinAttentionSud[]=null;
						}
					}
				}else{
					$ArrayJoinAttentionSud=null;
				}
//------------------------------------------------------------------------------				
				if(isset($ArrayJoinAttentionSud)){
					$this->ArrayJoinAttentionSud=$ArrayJoinAttentionSud;
					$pdo_talent=null;
				}else{
					$pdo_talent=null;
				}
//------------------------------------------------------------------------------			
		}public function PrintJoinAttentionSud(){
			if(isset($this->ArrayJoinAttentionSud)){
				return $this->ArrayJoinAttentionSud;
			}else{
//------------------------------------------------------------------------------				
			}
		}
	}
?>


<?php
	class CallJoinActivityMatchSud{
		public $CAMS_uesr,$CAMS_year,$CAMS_class,$CAMS_category;
		public $ArrayJoinActivityMatchSud;
		function __construct($CAMS_uesr,$CAMS_year,$CAMS_class,$CAMS_category){
//------------------------------------------------------------------------------
			$TalentID=$_SERVER['REMOTE_ADDR'];
			$connect_talent=new Connect_PdoTalent($TalentID);
			$pdo_talent=$connect_talent->call_PdoTalent();
//------------------------------------------------------------------------------
			$ArrayJoinActivityMatchSud=array();
//------------------------------------------------------------------------------
			$this->CAMS_uesr=$CAMS_uesr;
			$this->CAMS_year=$CAMS_year;
			$this->CAMS_class=$CAMS_class;
			$this->CAMS_category=$CAMS_category;
//------------------------------------------------------------------------------
			$JoinActivityMatchSudSql="SELECT `JAM_num`,`JAM_txt` FROM `join_activity_match` 
									  WHERE `JAM_uesr`='{$this->CAMS_uesr}' 
									  AND `JAM_year`='{$this->CAMS_year}' 
									  AND `JAM_class`='{$this->CAMS_class}' 
									  AND `JAM_category`='{$this->CAMS_category}' 
									  ORDER BY `join_activity_match`.`JAM_num` ASC";
				if($JoinActivityMatchSudRs=$pdo_talent->query($JoinActivityMatchSudSql)){
					while($JoinActivityMatchSudRow=$JoinActivityMatchSudRs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($JoinActivityMatchSudRow) && count($JoinActivityMatchSudRow)){
							$ArrayJoinActivityMatchSud[]=$JoinActivityMatchSudRow;
						}else{
							$ArrayJoinActivityMatchSud[]=null;
						}
					}
				}else{
					$ArrayJoinActivityMatchSud=null;
				}
				if(isset($ArrayJoinActivityMatchSud)){
					$this->ArrayJoinActivityMatchSud=$ArrayJoinActivityMatchSud;
					$pdo_talent=null;
				}else{
					$pdo_talent=null;
				}
		}public function PrintJoinActivityMatchSud(){
			if(isset($this->ArrayJoinActivityMatchSud)){
				return $this->ArrayJoinActivityMatchSud;
			}else{
//------------------------------------------------------------------------------				
			}
		}
	}
?>


<?php 
	class CallLevelPortfolioSud{
		public $CPS_uesr,$CPS_year,$CPS_class,$CPS_category;
		public $ArrayLevelPortfolioSud;
		function __construct($CPS_uesr,$CPS_year,$CPS_class,$CPS_category){
//------------------------------------------------------------------------------
			$TalentID=$_SERVER['REMOTE_ADDR'];
			$connect_talent=new Connect_PdoTalent($TalentID);
			$pdo_talent=$connect_talent->call_PdoTalent();
//------------------------------------------------------------------------------
			$ArrayLevelPortfolioSud=array();
//------------------------------------------------------------------------------
			$this->CPS_uesr=$CPS_uesr;
			$this->CPS_year=$CPS_year;
			$this->CPS_class=$CPS_class;
			$this->CPS_category=$CPS_category;
//------------------------------------------------------------------------------	
			$LevelPortfolioSudSql="select `level_portfolio`.`lp_id`,`level_portfolio`.`lp_txtTh`,`level_portfolio`.`lp_txtEn` 
								   from `level_portfolio` 
								   right join `portfolio_save`
								   on(`level_portfolio`.`lp_id`=`portfolio_save`.`ps_level_portfolio`) 
								   where `portfolio_save`.`ps_uesr`='{$this->CPS_uesr}' 
								   and `portfolio_save`.`ps_year`='{$this->CPS_year}' 
								   and `portfolio_save`.`ps_class`='{$this->CPS_class}' 
								   and `portfolio_save`.`ps_talent_category`='{$this->CPS_category}' 
								   ORDER BY `level_portfolio`.`lp_id` ASC";
				if($LevelPortfolioSudRs=$pdo_talent->query($LevelPortfolioSudSql)){
					while($LevelPortfolioSudRow=$LevelPortfolioSudRs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($LevelPortfolioSudRow) && count($LevelPortfolioSudRow)){
							$ArrayLevelPortfolioSud[]=$LevelPortfolioSudRow;
						}else{
							$ArrayLevelPortfolioSud[]=null;
						}
					}
				}else{
					$ArrayLevelPortfolioSud=null;
				}
				
				if(isset($ArrayLevelPortfolioSud)){
					$this->ArrayLevelPortfolioSud=$ArrayLevelPortfolioSud;
					$pdo_talent=null;
				}else{
					$pdo_talent=null;
				}		
		}public function PrintLevelPortfolioSud(){
			if(isset($this->ArrayLevelPortfolioSud)){
				return $this->ArrayLevelPortfolioSud;
			}else{
//------------------------------------------------------------------------------				
			}
		}
	}
?>

<?php 
	class CallAcademicSud{
		public $CAS_key,$CAS_year,$CAS_class;
		function __construct($CAS_key,$CAS_year,$CAS_class){
//------------------------------------------------------------------------------
			$TalentID=$_SERVER['REMOTE_ADDR'];
			$connect_talent=new Connect_PdoTalent($TalentID);
			$pdo_talent=$connect_talent->call_PdoTalent();
//------------------------------------------------------------------------------
			$ArrayAcademicSud=array();
//------------------------------------------------------------------------------	
			$this->CAS_key=$CAS_key;
			$this->CAS_year=$CAS_year;
			$this->CAS_class=$CAS_class;
//------------------------------------------------------------------------------	
			$AcademicSudSql="select `talent_academic`.`academic_id`,`talent_academic`.`academic_txtTh`,`talent_academic`.`academic_txtEn` 
							 from `talent_academic` 
							 right join `talent_attention` 
							 on(`talent_academic`.`academic_id`=`talent_attention`.`talent_academic_academic_id`) 
							 where `talent_attention`.`ra_sud`='{$this->CAS_key}' 
							 and `talent_attention`.`ra_year`='{$this->CAS_year}' 
							 and `talent_attention`.`ra_class`='{$this->CAS_class}' 
							 ORDER BY `talent_academic`.`academic_id` ASC";
				if($AcademicSudRs=$pdo_talent->query($AcademicSudSql)){
					while($AcademicSudRow=$AcademicSudRs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($AcademicSudRow) && count($AcademicSudRow)){
							$ArrayAcademicSud[]=$AcademicSudRow;
						}else{
							$ArrayAcademicSud[]=null;
						}
					}
				}else{
					$ArrayAcademicSud=null;
				}
				if(isset($ArrayAcademicSud)){
					$this->ArrayAcademicSud=$ArrayAcademicSud;
					$pdo_talent=null;
				}else{
					$pdo_talent=null;
				}
		}public function PrintAcademicSud(){
			if(isset($this->ArrayAcademicSud)){
				return $this->ArrayAcademicSud;
			}else{
//------------------------------------------------------------------------------				
			}
		}
	}
?>





<?php
	class CreckJoinTheEvent{
		public $CJTE_uesr,$CJTE_year,$CJTE_class;
		function __construct($CJTE_uesr,$CJTE_year,$CJTE_class){
			//------------------------------------------------------------------------------
				$TalentID=$_SERVER['REMOTE_ADDR'];
				$connect_talent=new Connect_PdoTalent($TalentID);
				$pdo_talent=$connect_talent->call_PdoTalent();
				$datetime=date("Y-m-d H:i:s");
			//------------------------------------------------------------------------------
				$this->CJTE_uesr=$CJTE_uesr;
				$this->CJTE_year=$CJTE_year;
				$this->CJTE_class=$CJTE_class;
			//------------------------------------------------------------------------------
				$CreckTheEventSql="SELECT `jte_join` FROM `join_the_event` 
								   WHERE `jte_sud`='{$this->CJTE_uesr}' 
								   AND `jte_year`='{$this->CJTE_year}' 
								   AND `jte_class`='{$this->CJTE_class}'";
					if($CreckTheEventRs=$pdo_talent->query($CreckTheEventSql)){
						$CreckTheEventRow=$CreckTheEventRs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($CreckTheEventRow) && count($CreckTheEventRow)){
								$JoinTheEvent=$CreckTheEventRow["jte_join"];
							}else{
								$JoinTheEvent=null;
							}
					}else{
						$JoinTheEvent=null;
					}
					if(isset($JoinTheEvent)){
						$this->JoinTheEvent=$JoinTheEvent;
						$pdo_talent=null;
					}else{
						$pdo_talent=null;
					}
					$pdo_talent=null;
		}public function RunCreckJoinTheEvent(){
			if(isset($this->JoinTheEvent)){
				return $this->JoinTheEvent;
			}else{
				//-------------------------------------------------------------------------------
			}
		}
	} 
?>


<?php
	class IntoPortfolioSave{
		public $IPS_uesr,$IPS_year,$IPS_class,$IPS_plan,$IPS_portfolio,$IPS_category;
		function __construct($IPS_uesr,$IPS_year,$IPS_class,$IPS_plan,$IPS_portfolio,$IPS_category){
			//------------------------------------------------------------------------------
				$TalentID=$_SERVER['REMOTE_ADDR'];
				$connect_talent=new Connect_PdoTalent($TalentID);
				$pdo_talent=$connect_talent->call_PdoTalent();
				$datetime=date("Y-m-d H:i:s");
			//------------------------------------------------------------------------------
				$this->IPS_uesr=$IPS_uesr;
				$this->IPS_year=$IPS_year;
				$this->IPS_class=$IPS_class;
				$this->IPS_plan=$IPS_plan;
				$this->IPS_portfolio=$IPS_portfolio;
				$this->IPS_category=$IPS_category;
				//$this->IPS_num=$IPS_num;
			//------------------------------------------------------------------------------
				$LevelPortfolioSql="SELECT COUNT(`lp_id`) AS `num_portfolio` 
									FROM `level_portfolio` WHERE `lp_id`='{$this->IPS_portfolio}'";
					if($LevelPortfolioRs=$pdo_talent->query($LevelPortfolioSql)){
						$LevelPortfolioRow=$LevelPortfolioRs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($LevelPortfolioRow) && count($LevelPortfolioRow)){
								$num_portfolio=$LevelPortfolioRow["num_portfolio"];
									if($num_portfolio>=1){
										try{
											$PortfolioSaveSql="INSERT INTO `portfolio_save`(`ps_uesr`, `ps_year`, `ps_class`, `ps_plan`, `ps_level_portfolio`, `ps_talent_category`) 
															   VALUES ('{$this->IPS_uesr}','{$this->IPS_year}','{$this->IPS_class}','{$this->IPS_plan}','{$this->IPS_portfolio}','{$this->IPS_category}')";
											$pdo_talent->exec($PortfolioSaveSql);
											$SystemPortfolio="Yes";
										}catch(PDOException $e){
											$SystemPortfolio="No";
										}
									}else{
										$SystemPortfolio="No";
									}
							}else{
								$SystemPortfolio="No";
							}
					}else{
						$SystemPortfolio="No";
					}
					if(isset($SystemPortfolio)){
						$this->SystemPortfolio=$SystemPortfolio;
					}else{
			//------------------------------------------------------------------------------						
					}
					$pdo_talent=null;
		}public function RunIntoPortfolioSave(){
			if(isset($this->SystemPortfolio)){
				return $this->SystemPortfolio;
			}else{
			//------------------------------------------------------------------------------				
			}
		}
	}
?>

<?php
	class IntoJoinTheEvent{
		public $IJTE_uesr,$IJTE_year,$IJTE_class,$IJTE_plan,$IJIE_join;
		function __construct($IJTE_uesr,$IJTE_year,$IJTE_class,$IJTE_plan,$IJIE_join){
			//------------------------------------------------------------------------------
				$TalentID=$_SERVER['REMOTE_ADDR'];
				$connect_talent=new Connect_PdoTalent($TalentID);
				$pdo_talent=$connect_talent->call_PdoTalent();
				$datetime=date("Y-m-d H:i:s");
			//------------------------------------------------------------------------------
				$this->IJTE_uesr=$IJTE_uesr;
				$this->IJTE_year=$IJTE_year;
				$this->IJTE_class=$IJTE_class;
				$this->IJTE_plan=$IJTE_plan;
				$this->IJIE_join=$IJIE_join;
					switch($this->IJIE_join){
						case "ButTalentY":
							try{
								$JoinTheEventSql="INSERT INTO `join_the_event`(`jte_sud`, `jte_year`, `jte_class`, `jte_join`, `jte_plan`, `jte_datetime`) 
												  VALUES ('{$this->IJTE_uesr}','{$this->IJTE_year}','{$this->IJTE_class}','Yes','{$this->IJTE_plan}','{$datetime}')";
								$pdo_talent->exec($JoinTheEventSql);
								$system_join="Yes";
							}catch(PDOException $e){
								$system_join="No";
							}
						break;
						case "ButTalentN":
							try{
								$JoinTheEventSql="INSERT INTO `join_the_event`(`jte_sud`, `jte_year`, `jte_class`, `jte_join`, `jte_plan`, `jte_datetime`) 
												  VALUES ('{$this->IJTE_uesr}','{$this->IJTE_year}','{$this->IJTE_class}','No','{$this->IJTE_plan}','{$datetime}')";
								$pdo_talent->exec($JoinTheEventSql);
								$system_join="Yes";
							}catch(PDOException $e){
								$system_join="No";
							}						
						break;
						default:
							$system_join="No";
					}
					if(isset($system_join)){
						$this->system_join=$system_join;
					}else{
						//--------------------------------------------------------------------
					}
					$pdo_talent=null;
		}public function RunIntoJoinTheEvent(){
			if(isset($this->system_join)){
				return $this->system_join;
			}else{
				//----------------------------------------------------------------------------
			}
		} 
	}
?>

<?php
	class IntoTalentAttention{
		public $ITA_uesr,$ITA_year,$ITA_class,$ITA_plan,$ITA_num,$ITA_AcademicId;
		function __construct($ITA_uesr,$ITA_year,$ITA_class,$ITA_plan,$ITA_num,$ITA_AcademicId){
			//------------------------------------------------------------------------------
							$TalentID=$_SERVER['REMOTE_ADDR'];
							$connect_talent=new Connect_PdoTalent($TalentID);
							$pdo_talent=$connect_talent->call_PdoTalent();
							$datetime=date("Y-m-d H:i:s");
			//------------------------------------------------------------------------------
							$this->ITA_uesr=$ITA_uesr;
							$this->ITA_year=$ITA_year;
							$this->ITA_class=$ITA_class;
							$this->ITA_plan=$ITA_plan;
							$this->ITA_num=$ITA_num;
							$this->ITA_AcademicId=$ITA_AcademicId;
//---+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
							$academicSql="SELECT COUNT(`academic_id`)
														AS `num_academic`
														FROM `talent_academic`
														WHERE `academic_id`='{$this->ITA_AcademicId}';";
							if($academicRs=$pdo_talent->query($academicSql)){
								$academicRow=$academicRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($academicRow) && count($academicRow)){
										$num_academic=$academicRow["num_academic"];
											if($num_academic>=1){
												try{
													$IntoTalentAttentionSql="INSERT INTO `talent_attention`(`ra_sud`, `ra_year`, `ra_class`, `ra_num`, `talent_academic_academic_id`)
																			 VALUES ('{$this->ITA_uesr}','{$this->ITA_year}','{$this->ITA_class}','{$this->ITA_num}','{$this->ITA_AcademicId}')";
													$pdo_talent->exec($IntoTalentAttentionSql);
													$TalentAttentionSystem="Yes";
												}catch(PDOException $e){
													$TalentAttentionSystem="No";
												}
											}else{
												$TalentAttentionSystem="No";
											}
									}else{
										$TalentAttentionSystem="No";
									}
							}else{
								$TalentAttentionSystem="No";
							}
						if(isset($TalentAttentionSystem)){
							$this->TalentAttentionSystem=$TalentAttentionSystem;
						}else{
							//----------------------------------------------------------------
						}
						$pdo_talent=null;
//---+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		}public function RunIntoTalentAttention(){
			if(isset($this->TalentAttentionSystem)){
				return $this->TalentAttentionSystem;
			}else{
				//----------------------------------------------------------------------------
			}
		}
	}
?>


<?php
	class IntoActivityMatch{
		public $IAM_uesr,$IAM_year,$IAM_class,$IAM_plan,$IAM_category,$IAM_num,$IAM_txt;
		function __construct($IAM_uesr,$IAM_year,$IAM_class,$IAM_plan,$IAM_category,$IAM_num,$IAM_txt){
//------------------------------------------------------------------------------
				$TalentID=$_SERVER['REMOTE_ADDR'];
				$connect_talent=new Connect_PdoTalent($TalentID);
				$pdo_talent=$connect_talent->call_PdoTalent();
				$datetime=date("Y-m-d H:i:s");
//------------------------------------------------------------------------------
//---+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				$this->IAM_uesr=$IAM_uesr;
				$this->IAM_year=$IAM_year;
				$this->IAM_class=$IAM_class;
				$this->IAM_plan=$IAM_plan;
				$this->IAM_category=$IAM_category;
				$this->IAM_num=$IAM_num;
				$this->IAM_txt=$IAM_txt;
//---+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				$categorySql="SELECT COUNT(`tc_num`) AS `count_num`
									    FROM `talent_category`
											WHERE`tc_type`='off' AND `tc_num`='{$this->IAM_num}'";
					if($categoryRs=$pdo_talent->query($categorySql)){
						$categoryRow=$categoryRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($categoryRow) && count($categoryRow)){
							$count_num=$categoryRow["count_num"];
								if($count_num>=1){
	//------------------------------------------------------------------------------
									try{
										$ActivityMatchSql="INSERT INTO `join_activity_match`(`JAM_uesr`, `JAM_year`, `JAM_class`, `JAM_plan`, `JAM_category`, `JAM_num`, `JAM_txt`, `JAM_datetime`)
														   VALUES ('{$this->IAM_uesr}','{$this->IAM_year}','{$this->IAM_class}','{$this->IAM_plan}','{$this->IAM_category}','{$this->IAM_num}','{$this->IAM_txt}','{$datetime}')";
										$pdo_talent->exec($ActivityMatchSql);
										$IntoActivityMatchSystem="Yes";
									}catch(PDOException $e){
											$IntoActivityMatchSystem="No";
									}
	//------------------------------------------------------------------------------										
								}else{
									$IntoActivityMatchSystem="No";
								}
						}else{
							$IntoActivityMatchSystem="No";
						}
					}else{
						$IntoActivityMatchSystem="No";
					}
				if(isset($IntoActivityMatchSystem)){
					$this->IntoActivityMatchSystem=$IntoActivityMatchSystem;
				}else{
						//--------------------------------------------------------
				}
				$pdo_talent=null;
		}public function RunIntoActivityMatch(){
				if(isset($this->IntoActivityMatchSystem)) {
					return $this->IntoActivityMatchSystem;
				}else{
					//--------------------------------------------------------------------
				}
		}
	}
?>


<?php
	class IntoJoinAttention{
		public $IJA_uesr,$IJA_year,$IJA_class,$IJA_plan,$IJA_num,$IJA_txt;
		function __construct($IJA_uesr,$IJA_year,$IJA_class,$IJA_plan,$IJA_num,$IJA_txt){
	//----------------------------------------------------------------------------
		$TalentID=$_SERVER['REMOTE_ADDR'];
		$connect_talent=new Connect_PdoTalent($TalentID);
		$pdo_talent=$connect_talent->call_PdoTalent();
		$datetime=date("Y-m-d H:i:s");
	//----------------------------------------------------------------------------
		$this->IJA_uesr=$IJA_uesr;
		$this->IJA_year=$IJA_year;
		$this->IJA_class=$IJA_class;
		$this->IJA_plan=$IJA_plan;
		$this->IJA_num=$IJA_num;
		$this->IJA_txt=$IJA_txt;
//---+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		try{
			$join_attentionSql="INSERT INTO `join_attention`(`JA_uesr`, `JA_year`, `JA_class`, `JA_plan`, `JA_num`, `JA_txt`, `JA_datetime`)
								VALUES ('{$this->IJA_uesr}','{$this->IJA_year}','{$this->IJA_class}','{$this->IJA_plan}','{$this->IJA_num}','{$this->IJA_txt}','{$datetime}')";
			$pdo_talent->exec($join_attentionSql);
			$IntoJoinAttentionSystem="Yes";
		}catch(PDOException $e){
			$IntoJoinAttentionSystem="No";
		}
			if(isset($IntoJoinAttentionSystem)){
				$this->IntoJoinAttentionSystem=$IntoJoinAttentionSystem;
			}else{
	//----------------------------------------------------------------------------
			}
			$pdo_talent=null;
		}public function RunIntoJoinAttention(){
				if(isset($this->IntoJoinAttentionSystem)) {
					return $this->IntoJoinAttentionSystem;
				}else{
					//--------------------------------------------------------------------
				}
		}
	}
?>


<?php
	class ArrayTalentAcademic{
		function __construct(){
			$Row_TalentAcademic=array();
//-------------------------------------------------------------------
			$TalentID=$_SERVER['REMOTE_ADDR'];
			$connect_talent=new Connect_PdoTalent($TalentID);
			$pdo_talent=$connect_talent->call_PdoTalent();
//-------------------------------------------------------------------
			$TalentAcademicSql="SELECT * FROM `talent_academic` WHERE 1 ORDER BY `academic_id` ASC";
				if($TalentAcademicRs=$pdo_talent->query($TalentAcademicSql)){
					while($TalentAcademicRow=$TalentAcademicRs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($TalentAcademicRow) && count($TalentAcademicRow)){
							$Row_TalentAcademic[]=$TalentAcademicRow;
						}else{
							$Row_TalentAcademic[]=null;
						}
					}
				}else{
					$Row_TalentAcademic[]=null;
				}
//-------------------------------------------------------------------
				if(isset($Row_TalentAcademic)){
					$this->Row_TalentAcademic=$Row_TalentAcademic;
				}else{
					//-----------------------------------------------
				}
//-------------------------------------------------------------------
				$pdo_talent=null;
		}public function PrintArrayTalentAcademic(){
			if(isset($this->Row_TalentAcademic)){
				return $this->Row_TalentAcademic;
			}else{
//-------------------------------------------------------------------
			}
		}
	}
?>
<?php
//ArrayLevelPortfolio
	class ArrayLevelPortfolio{
		function __construct(){
			$Row_LevelPortfolio=array();
//-----------------------------------------------------------
			$TalentID=$_SERVER["REMOTE_ADDR"];
			$connect_talent=new Connect_PdoTalent($TalentID);
			$pdo_talent=$connect_talent->call_PdoTalent();
//-----------------------------------------------------------
			$LevelPortfolioSql="SELECT * FROM `level_portfolio`
						        WHERE 1 ORDER BY `lp_id` ASC";
				if($LevelPortfolioRs=$pdo_talent->query($LevelPortfolioSql)){
					while($LevelPortfolioRow=$LevelPortfolioRs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($LevelPortfolioRow) && count($LevelPortfolioRow)){
							$Row_LevelPortfolio[]=$LevelPortfolioRow;
						}else{
							$Row_LevelPortfolio[]=null;
						}
					}
				}else{
					$Row_LevelPortfolio[]=null;
				}
//-------------------------------------------------------------------
				if(isset($Row_LevelPortfolio)){
					$this->Row_LevelPortfolio=$Row_LevelPortfolio;
				}else{
					//--------------------------------------------
				}
//-------------------------------------------------------------------
			$pdo_talent=null;
		}public function PrintArrayLevelPortfolio(){
			if(isset($this->Row_LevelPortfolio)){
				return $this->Row_LevelPortfolio;
			}else{
				//-------------------------------------------------
			}
		}
	}
//ArrayLevelPortfolio End
?>
