<?php
	//Develop By Kunlathon Saowakhon
	//พัฒนาเว็บไซต์โดย นายกุลธร เสาวคนธ์
	//Tel 0932670639
	//โทร 0932670639
	//Email: mpamese.pc2001@gmail.com , missing_yrc2014@hotmail.com
	//ห้ามใช้ /**/ จะส่งผลให้ค่า return js ทำงานผิดปกติ !!
?>








<?php
	//ส่วนประกอบของโครงสร้างรายงานคะแนนเรียน Summer

	class KeepScoreSet{//Score Full
		public $KSS_Term,$KSS_Year,$KSS_Class;
		public $KeepScoreSet_Print;
		function __construct($KSS_Term,$KSS_Year,$KSS_Class){
			$this->KSS_Term=$KSS_Term;
			$this->KSS_Year=$KSS_Year;
			$this->KSS_Class=$KSS_Class;
			$KeepScoreSet_Print=array();
			$KeepScoreSet_Error="Error";
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
				try{
					$KeepScoreSetSql="select `rssubject_data`.`RSD_no`, `rssubject_data`.`RSD_txtTh`, `summer_set_up_score`.`SSUS_Score_full` 
									  from `summer_set_up_score` right join `rssubject_data` on (`summer_set_up_score`.`SSUS_Subject`=`rssubject_data`.`RSD_no`)
									  where `summer_set_up_score`.`SSUS_Term`='{$this->KSS_Term}' 
									  and `summer_set_up_score`.`SSUS_Year`='{$this->KSS_Year}' 
									  and `rssubject_data`.`RSD_class`='{$this->KSS_Class}'
									  and `rssubject_data`.`RSD_year`='{$this->KSS_Year}' 
									  ORDER BY `rssubject_data`.`RSD_no` ASC";
						if(($KeepScoreSetRs=$pdo_summer->query($KeepScoreSetSql))){
							while($KeepScoreSetRow=$KeepScoreSetRs->Fetch(PDO::FETCH_ASSOC)){
								if((is_array($KeepScoreSetRow) && count($KeepScoreSetRow))){
									$KeepScoreSet_Print[]=$KeepScoreSetRow;
									$KeepScoreSet_Error="NoError";
								}else{
									$KeepScoreSet_Print="-";
									$KeepScoreSet_Error="Error";
								}
							}
						}else{
							$KeepScoreSet_Print="-";
							$KeepScoreSet_Error="Error";
						}
				}catch(PDOException $e){
					$KeepScoreSet_Print="-";
					$KeepScoreSet_Error="Error";
				}
				if((isset($KeepScoreSet_Print,$KeepScoreSet_Error))){
					$this->KeepScoreSet_Print=$KeepScoreSet_Print;
					$this->KeepScoreSet_Error=$KeepScoreSet_Error;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
		}function RunPrintKeepScoreSet(){
			return $this->KeepScoreSet_Print;
		}function RunErrorKeepScoreSet(){
			return $this->KeepScoreSet_Error;
		}
	}
	
	
	
	
	//ส่วนประกอบของโครงสร้างรายงานคะแนนเรียน Summer by beer 07/04/2023
?>

<?php
	//Print rssubject group / join
	class PrintRsSubjectGJ{
		public $PRSGJ_Type,$PRSGJ_ClassA,$PRSGJ_ClassB,$PRSGJ_year,$PRSGJ_RSDno;
		public $RsSubjectGJ_Print,$RsSubjectGJ_Error;
		function __construct($PRSGJ_Type,$PRSGJ_ClassA,$PRSGJ_ClassB,$PRSGJ_year,$PRSGJ_RSDno){
			$this->PRSGJ_Type=$PRSGJ_Type;
			$this->PRSGJ_ClassA=$PRSGJ_ClassA;
			$this->PRSGJ_ClassB=$PRSGJ_ClassB;
			$this->PRSGJ_year=$PRSGJ_year;
			$this->PRSGJ_RSDno=$PRSGJ_RSDno;
			$RsSubjectGJ_Print=array();
			$RsSubjectGJ_Error="Error";
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
				if(($this->PRSGJ_Type=="group")){
					try{
						$RsSubjectSql="select * from `rssubject_group` 
									   where `rg_classA` >='{$this->PRSGJ_ClassA}' and `rg_classB`<='{$this->PRSGJ_ClassB}' and `rg_year`='{$this->PRSGJ_year}' 
									   ORDER BY `rg_id` ASC;";
							if(($RsSubjectRs=$pdo_summer->query($RsSubjectSql))){
								while($RsSubjectRow=$RsSubjectRs->Fetch(PDO::FETCH_ASSOC)){
									if((is_array($RsSubjectRow) && count($RsSubjectRow))){
										$RsSubjectGJ_Print[]=$RsSubjectRow;
										$RsSubjectGJ_Error="Noerror";
									}else{
										$RsSubjectGJ_Print="-";
										$RsSubjectGJ_Error="Error";
									}
								}
							}else{
								$RsSubjectGJ_Print="-";
								$RsSubjectGJ_Error="Error";
							}
					}catch(PDOException $e){
						$RsSubjectGJ_Print="-";
						$RsSubjectGJ_Error="Error";
					}
				}elseif(($this->PRSGJ_Type=="join")){
					try{
						$RsSubjectSql="SELECT * FROM `rssubject_join` 
						               WHERE `rg_id`='{$this->PRSGJ_RSDno}' 
									   AND `rg_year`='{$this->PRSGJ_year}'";
							if(($RsSubjectRs=$pdo_summer->query($RsSubjectSql))){
								while($RsSubjectRow=$RsSubjectRs->Fetch(PDO::FETCH_ASSOC)){
									if((is_array($RsSubjectRow) && count($RsSubjectRow))){
										$RsSubjectGJ_Print[]=$RsSubjectRow;
										$RsSubjectGJ_Error="Noerror";
									}else{
										$RsSubjectGJ_Print="-";
										$RsSubjectGJ_Error="Error";
									}
								}
							}else{
								$RsSubjectGJ_Print="-";
								$RsSubjectGJ_Error="Error";
							}
					}catch(PDOException $e){
						$RsSubjectGJ_Print="-";
						$RsSubjectGJ_Error="Error";
					}					
				}else{
					$RsSubjectGJ_Print="-";
					$RsSubjectGJ_Error="Error";
				}
				if((isset($RsSubjectGJ_Print,$RsSubjectGJ_Error))){
					$this->RsSubjectGJ_Print=$RsSubjectGJ_Print;
					$this->RsSubjectGJ_Error=$RsSubjectGJ_Error;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;					
				}
		}function RunSubjectGJ_Print(){
			return $this->RsSubjectGJ_Print;
		}function RunSubjectGJ_Error(){
			return $this->RsSubjectGJ_Error;
		}
	}
	
	//Print rssubject group / join End
?>


<?php
	class TestRegisterSummer{
		public $TRS_Key,$TRS_Year;
		public $TRS_Count;
		function __construct($TRS_Key,$TRS_Year){
			$this->TRS_Key=$TRS_Key;
			$this->TRS_Year=$TRS_Year;
			$TRS_Count=0;
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
				try{
					$TRS_Sql="SELECT COUNT(`rs_key`) AS `int_key` 
							  FROM `rs_student` 
							  WHERE `rs_key` ='{$this->TRS_Key}' 
							  AND `rs_year`='{$this->TRS_Year}'";
						if(($TRS_Rs=$pdo_summer->query($TRS_Sql))){
							$TRS_Row=$TRS_Rs->Fetch(PDO::FETCH_ASSOC);
								if((is_array($TRS_Row) && count($TRS_Row))){
									$int_key=$TRS_Row["int_key"];
										if(($int_key>=1)){
											$TRS_Count=1;
										}else{
											$TRS_Count=0;
										}
								}else{
									$TRS_Count=0;
								}
						}else{
							$TRS_Count=0;
						}
				}catch(PDOException $e){
					$TRS_Count=0;
				}
			$this->TRS_Count=$TRS_Count;
			$pdo_summer=null;	
		}function RunTestRegisterSummer(){
			return $this->TRS_Count;
		}
	}
?>


<?php
	class PrintSummerPlan{
		public $PSP_Y,$PSP_CA,$PSP_CB;
		public $PSP_Print;
		function __construct($PSP_Y,$PSP_CA,$PSP_CB){
			$this->PSP_Y=$PSP_Y;
			$this->PSP_CA=$PSP_CA;
			$this->PSP_CB=$PSP_CB;
			$PSP_Print=array();
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
				try{
					$PrintSummerPlanSql="SELECT DISTINCT `RSD_Plan` AS `Plan_ID` FROM `rssubject_data` 
										 WHERE `RSD_class`>='{$this->PSP_CA}' 
										 AND `RSD_class`<='{$this->PSP_CB}' 
										 AND `RSD_year`='{$this->PSP_Y}';";
						if(($PrintSummerPlanRs=$pdo_summer->query($PrintSummerPlanSql))){
							while($PrintSummerPlanRow=$PrintSummerPlanRs->Fetch(PDO::FETCH_ASSOC)){
								if((is_array($PrintSummerPlanRow) && count($PrintSummerPlanRow))){
									$PSP_Print[]=$PrintSummerPlanRow;
								}else{
									$PSP_Print[]=$PrintSummerPlanRow;
								}
							}
						}else{
							$PSP_Print="-";
						}			
				}catch(PDOException $e){
					$PSP_Print="-";		
				}
			$this->PSP_Print=$PSP_Print;
			$pdo_summer=null;
		}function RunPrintSummerPlan(){
			return $this->PSP_Print;
		}
	}
?>


<?php
	class Print_Rssubject_Data{
		public $PRD_Year,$PRD_Class,$PRD_Plan,$PRD_RST_on;
		public $Pint_Rssubject,$Rssubject_Error;
		function __construct($PRD_Year,$PRD_Class,$PRD_Plan,$PRD_RST_on){
			$this->PRD_Year=$PRD_Year;
			$this->PRD_Class=$PRD_Class;
			$this->PRD_Plan=$PRD_Plan;
			$this->PRD_RST_on=$PRD_RST_on;
			$Pint_Rssubject=array();
			$Rssubject_Error="Error";
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();

				try{
					$RssubjectDataSql="select `rssubject_data`.`RSD_no`,`rssubject_data`.`RSD_txtTh`,`rssubject_data`.`RSD_txtEn`,`rssubject_data`.`RSD_class`,`rssubject_data`.`RSD_Plan`,`rssubject_type`.`RST_on`,`rssubject_type`.`RST_txtTh` 
									   from `rssubject_data` left join `rssubject_type`on (`rssubject_data`.`RST_on`=`rssubject_type`.`RST_on`) 
									   where `rssubject_data`.`RSD_class`='{$this->PRD_Class}' 
									   and `rssubject_data`.`RSD_Plan`='{$this->PRD_Plan}' 
									   and `rssubject_data`.`RSD_year`='{$this->PRD_Year}' 
									   and `rssubject_data`.`RST_on`='{$this->PRD_RST_on}';";
						if(($RssubjectDataRs=$pdo_summer->query($RssubjectDataSql))){
							while($RssubjectDataRow=$RssubjectDataRs->Fetch(PDO::FETCH_ASSOC)){
								if((is_array($RssubjectDataRow) && count($RssubjectDataRow))){
									$Pint_Rssubject[]=$RssubjectDataRow;
									$Rssubject_Error="NoError";
								}else{
									$Pint_Rssubject="-";
									$Rssubject_Error="Error";
								}
							}
						}else{
							$Pint_Rssubject="-";
							$Rssubject_Error="Error";
						}
				}catch(PDOException $e){
					$Pint_Rssubject="-";
					$Rssubject_Error="Error";
				}
				
				if((isset($Pint_Rssubject,$Rssubject_Error))){
					$this->Pint_Rssubject=$Pint_Rssubject;
					$this->Rssubject_Error=$Rssubject_Error;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
				
		}function Run_Print_Rssubject(){
			return $this->Pint_Rssubject;
		}function Run_Rssubject_Error(){
			return $this->Rssubject_Error;
		}
	}
?>


<?php
	//System Summer
	class SystemSummer{
		public $SS_Type,$test_system,$OFFONDateTime,$EndDateTime,$data_yaer,$data_term,$data_summer,$time_add,$DeletePay_Sud,$DeletePay_Admin,$End4143_notrun;
		public $SS_Error,$SS_Array;
		function __construct($SS_Type,$test_system,$OFFONDateTime,$EndDateTime,$data_yaer,$data_term,$data_summer,$time_add,$DeletePay_Sud,$DeletePay_Admin,$End4143_notrun){
			$this->SS_Type=$SS_Type;
			$this->test_system=$test_system;
			$this->OFFONDateTime=$OFFONDateTime;
			$this->EndDateTime=$EndDateTime;
			$this->data_yaer=$data_yaer;
			$this->data_term=$data_term;
			$this->data_summer=$data_summer;
			$this->time_add=$time_add;
			$this->DeletePay_Sud=$DeletePay_Sud;
			$this->DeletePay_Admin=$DeletePay_Admin;
			$this->End4143_notrun=$End4143_notrun;
			$SS_Error="Yes";
			$SS_Array=array();
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();

				if(($this->SS_Type=="edit")){
					try{
						$EditSystemSummer="UPDATE `system_summer` SET `test_system`='{$this->test_system}',`OFFONDateTime`='{$this->OFFONDateTime}',`EndDateTime`='{$this->EndDateTime}',`data_yaer`='{$this->data_yaer}',`data_term`='{$this->data_term}',`data_summer`='{$this->data_summer}',`time_add`='{$this->time_add}',`DeletePay_Sud`='{$DeletePay_Sud}',`DeletePay_Admin`='{$DeletePay_Admin}',`End4143_notrun`='{$this->End4143_notrun}' 
						                   WHERE `ss_id`='2023900401'";
						$pdo_summer->exec($EditSystemSummer);
						$SS_Error="No";
						$SS_Array[]="-";
					}catch(PDOException $e){
						$SS_Error="Yes";
						$SS_Array[]="-";
					}
				}elseif(($this->SS_Type=="read")){
					$ReadSystemSummer="SELECT * FROM `system_summer`";
						if(($ReadSystemSummerRs=$pdo_summer->query($ReadSystemSummer))){
							while(($ReadSystemSummerRow=$ReadSystemSummerRs->Fetch(PDO::FETCH_ASSOC))){
								if((is_array($ReadSystemSummerRow) && count($ReadSystemSummerRow))){
									$SS_Error="No";
									$SS_Array[]=$ReadSystemSummerRow;
								}else{
									$SS_Error="Yes";
									$SS_Array[]="-";
								}
							}
						}else{
							$SS_Error="Yes";
							$SS_Array[]="-";							
						}
				}else{
					$SS_Error="Yes";
					$SS_Array[]="-";					
				}
			if((isset($SS_Error,$SS_Array))){
				$this->SS_Error=$SS_Error;
				$this->SS_Array=$SS_Array;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}
		}function RunSS_Error(){
			return $this->SS_Error;
		}function RunSS_Array(){
			return $this->SS_Array;
		}
	}
?>

<?php
	class SystemYear{
		public $SY_Type,$SY_id,$SY_year;
		public $ST_Error,$ST_Array;
		function __construct($SY_Type,$SY_id,$SY_year){
			$this->SY_Type=$SY_Type;
			$this->SY_id=$SY_id;
			$this->SY_year=$SY_year;
			$ST_Error="Yes";
			$ST_Array=array();
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
			
				if(($this->SY_Type=="add")){
					try{
						$AddSystemYear="INSERT INTO `system_year`(`sy_id`, `sy_year`) 
									    VALUES ('{$this->SY_id}','{$this->SY_year}')";
						$pdo_summer->exec($AddSystemYear);
						$ST_Error="No";
						$ST_Array[]="-";
					}catch(PDOException $e){
						$ST_Error="Yes";
						$ST_Array[]="-";						
					}
				}elseif(($this->SY_Type=="read")){
					try{
						$ReadSystemYear="SELECT * FROM `system_year` WHERE 1 ORDER BY `sy_year` DESC";
							if(($ReadSystemYearRs=$pdo_summer->query($ReadSystemYear))){
								while(($ReadSystemYearRow=$ReadSystemYearRs->Fetch(PDO::FETCH_ASSOC))){
									if((is_array($ReadSystemYearRow) && count($ReadSystemYearRow))){
										$ST_Error="No";
										$ST_Array[]=$ReadSystemYearRow;
									}else{
										$ST_Error="Yes";
										$ST_Array[]="-";
									}
								}
							}else{
								$ST_Error="Yes";
								$ST_Array[]="-";								
							}
					}catch(PDOException $e){
						$ST_Error="Yes";
						$ST_Array[]="-";						
					}
				}elseif($this->SY_Type=="notrow"){
					try{
						$ReadSystemYear="SELECT * FROM `system_year` WHERE 1 ORDER BY `sy_year` DESC";
							if(($ReadSystemYearRs=$pdo_summer->query($ReadSystemYear))){
								$ReadSystemYearRow=$ReadSystemYearRs->Fetch(PDO::FETCH_ASSOC);
									if((is_array($ReadSystemYearRow) && count($ReadSystemYearRow))){
										$ST_Error="No";
										$ST_Array[]=$ReadSystemYearRow;
									}else{
										$ST_Error="Yes";
										$ST_Array[]="-";
									}
							}else{
								$ST_Error="Yes";
								$ST_Array[]="-";								
							}
					}catch(PDOException $e){
						$ST_Error="Yes";
						$ST_Array[]="-";						
					}					
				}else{
					$ST_Error="Yes";
					$ST_Array[]="-";					
				}
			if(isset($ST_Error,$ST_Array)){
				$this->ST_Error=$ST_Error;
				$this->ST_Array=$ST_Array;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}
		}function RunST_Error(){
			return $this->ST_Error;
		}function RunST_Array(){
			return $this->ST_Array;
		}
	}
?>

<?php
	class TestScore{
		public $TS_Score,$TS_Type,$TS_ScoreFull;
		public $TxtScoreTh,$KeyScore,$TS_Full;
		function __construct($TS_Score,$TS_Type,$TS_ScoreFull){
//----------------------------------------------------------------------------------		
		$this->TS_Score=$TS_Score;
		$this->TS_Type=$TS_Type;
		$this->TS_ScoreFull=$TS_ScoreFull;
//----------------------------------------------------------------------------------		
		$db_summerID=$_SERVER['REMOTE_ADDR'];
		$connpdo_summer=new connected_summer($db_summerID);
		$pdo_summer=$connpdo_summer->run_connto_summer();	
//----------------------------------------------------------------------------------			
			if(($this->TS_Type=="A")){//แปลงคะแนนให้ถึง 100
				$TS_A=0;
				$TS_Full=0;
				$TS_A=(100/$this->TS_ScoreFull);
				$TS_Full=($this->TS_Score*$TS_A);
				$TS_Full=number_format($TS_Full,0,"","");
					if(($TS_Full>=80 and $TS_Full<=100)){
						$TxtScoreTh="ดีเยี่ยม";
						$KeyScore="A";
					}elseif(($TS_Full>=70 and $TS_Full<=79)){
						$TxtScoreTh="ดี";
						$KeyScore="B";
					}elseif(($TS_Full>=60 and $TS_Full<=69)){
						$TxtScoreTh="ค่อนข้างดี";
						$KeyScore="C";
					}elseif(($TS_Full>=50 and $TS_Full<=59)){
						$TxtScoreTh="พอใช้";
						$KeyScore="D";
					}elseif(($TS_Full>=0 and $TS_Full<=49)){
						$TxtScoreTh="ควรเสริม";
						$KeyScore="F";
					}else{
						$TxtScoreTh="ไม่สามารถแปลผลได้";
						$KeyScore="E";
					}
			}elseif(($this->TS_Type=="B")){//
				$TS_Full=number_format($this->TS_Score,0,"","");
					if(($TS_Full>=80 and $TS_Full<=100)){
						$TxtScoreTh="ดีเยี่ยม";
						$KeyScore="A";
					}elseif(($TS_Full>=70 and $TS_Full<=79)){
						$TxtScoreTh="ดี";
						$KeyScore="B";
					}elseif(($TS_Full>=60 and $TS_Full<=69)){
						$TxtScoreTh="ค่อนข้างดี";
						$KeyScore="C";
					}elseif(($TS_Full>=50 and $TS_Full<=59)){
						$TxtScoreTh="พอใช้";
						$KeyScore="D";
					}elseif(($TS_Full>=0 and $TS_Full<=49)){
						$TxtScoreTh="ควรเสริม";
						$KeyScore="F";
					}else{
						$TxtScoreTh="ไม่สามารถแปลผลได้";
						$KeyScore="E";
					}				
			}else{
				$TxtScoreTh=null;
				$KeyScore=null;
				$TS_Full=0;
			}
			
			if((isset($TxtScoreTh,$KeyScore))){
				$this->TxtScoreTh=$TxtScoreTh;
				$this->KeyScore=$KeyScore;
				$this->TS_Full=$TS_Full;
			}else{}
		}function __destruct(){
			if(isset($this->TxtScoreTh,$this->KeyScore,$this->TS_Full)){
				$this->TxtScoreTh;
				$this->KeyScore;
				$this->TS_Full;
			}else{}
		}
	}

?>

<?php
	class PrintSummerSetUpScore{
		public $PSSU_Class,$PSSU_Year;
		function __construct($PSSU_Class,$PSSU_Year){
//----------------------------------------------------------------------------------
		$this->PSSU_Class=$PSSU_Class;
		$this->PSSU_Year=$PSSU_Year;
//----------------------------------------------------------------------------------	
		$db_summerID=$_SERVER['REMOTE_ADDR'];
		$connpdo_summer=new connected_summer($db_summerID);
		$pdo_summer=$connpdo_summer->run_connto_summer();			
//----------------------------------------------------------------------------------		
		$PSSU_Array=array();
//----------------------------------------------------------------------------------		
			try{
				$PSSU_Sql="select `rssubject_data`.`RSD_no`,`rssubject_data`.`RSD_txtTh`,`rssubject_data`.`RSD_txtEn`,`rssubject_data`.`RSD_class`,`rssubject_data`.`RSD_Plan`
						 ,`summer_set_up_score`.`SSUS_Term`,`summer_set_up_score`.`SSUS_Year`,`summer_set_up_score`.`SSUS_Score_full`
						 ,`summer_set_up_score`.`SSUS_DateTime`,`summer_set_up_score`.`SSUS_Rc`
						   from `summer_set_up_score` left join `rssubject_data`
						   on (`summer_set_up_score`.`SSUS_Subject`=`rssubject_data`.`RSD_no`)
						   where `rssubject_data`.`RSD_class`='{$this->PSSU_Class}'
						   and `rssubject_data`.`RSD_year`='{$this->PSSU_Year}'
						   ORDER BY `rssubject_data`.`RSD_no` ASC";
					if(($PSSU_Rs=$pdo_summer->query($PSSU_Sql))){
						while($PSSU_Row=$PSSU_Rs->Fetch(PDO::FETCH_ASSOC)){
							if((is_array($PSSU_Row) && count($PSSU_Row))){
								$PSSU_Array[]=$PSSU_Row;
							}else{
								$PSSU_Array=null;
							}
						}
					}else{
						$PSSU_Array=null;
					}
			}catch(PDOException $pssu){
				$PSSU_Array=null;
			}
			if(isset($PSSU_Array)){
				$this->PSSU_Array=$PSSU_Array;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}
		}function RunPrintSummerSetUpScore(){
			if(isset($this->PSSU_Array)){
				return $this->PSSU_Array;
			}else{}
		}
	}
?>

<?php
	class ManagementScoreSummer{
		public $MSS_Subject,$MSS_Term,$MSS_Year,$MSS_Scorefull,$MSS_Rc,$Typy_MSS;
		function __construct($MSS_Subject,$MSS_Term,$MSS_Year,$MSS_Scorefull,$MSS_Rc,$Typy_MSS){
//----------------------------------------------------------------------------------		
		$this->MSS_Subject=$MSS_Subject;
		$this->MSS_Term=$MSS_Term;
		$this->MSS_Year=$MSS_Year;
		$this->MSS_Scorefull=$MSS_Scorefull;
		$this->MSS_Rc=$MSS_Rc;
		$this->Typy_MSS=$Typy_MSS;
//----------------------------------------------------------------------------------
		$MSS_Error="Yes";	
		$MSS_DateTime=date("Y-m-d H:i:s");		
//----------------------------------------------------------------------------------
		$db_summerID=$_SERVER['REMOTE_ADDR'];
		$connpdo_summer=new connected_summer($db_summerID);
		$pdo_summer=$connpdo_summer->run_connto_summer();			
//----------------------------------------------------------------------------------	
			if(($this->Typy_MSS=="Into")){
				try{
					$MSS_Sql="INSERT INTO `summer_set_up_score` (`SSUS_Subject`, `SSUS_Term`, `SSUS_Year`, `SSUS_Score_full`, `SSUS_DateTime`, `SSUS_Rc`) 
							  VALUES ('{$this->MSS_Subject}', '{$this->MSS_Term}', '{$this->MSS_Year}', '{$this->MSS_Scorefull}', '{$MSS_DateTime}', '{$this->MSS_Rc}');";
					$pdo_summer->exec($MSS_Sql);
					$MSS_Error="No";
				}catch(PDOException $mss){
					$MSS_Error="Yes";
				}				
			}elseif(($this->Typy_MSS=="Delete")){
				try{
					$MSS_Sql="DELETE FROM `summer_set_up_score` WHERE `SSUS_Subject`='{$this->MSS_Subject}' AND `SSUS_Term`='{$this->MSS_Term}' AND `SSUS_Year`='{$this->MSS_Year}'";
					$pdo_summer->exec($MSS_Sql);
					$MSS_Error="No";
				}catch(PDOException $mss){
					$MSS_Error="Yes";
				}				
			}else{
				$MSS_Error="Yes";
			}
	
			if((isset($MSS_Error))){
				$this->MSS_Error=$MSS_Error;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}
		}function RunManagementScoreSummer(){
			if(isset($this->MSS_Error)){
				return $this->MSS_Error;
			}else{}
		}
	}
?>

<?php
	class IntoDataScore{
		public $IDS_SudKey,$IDS_SubjectKey,$IDS_Year,$IDS_Rc,$IDS_Term,$IDS_Score,$IDS_Type;
		function __construct($IDS_SudKey,$IDS_SubjectKey,$IDS_Year,$IDS_Rc,$IDS_Term,$IDS_Score,$IDS_Type){
//----------------------------------------------------------------------------------
			$this->IDS_SudKey=$IDS_SudKey;
			$this->IDS_SubjectKey=$IDS_SubjectKey;
			$this->IDS_Year=$IDS_Year;
			$this->IDS_Rc=$IDS_Rc;
			$this->IDS_Term=$IDS_Term;
			$this->IDS_Score=$IDS_Score;
			$this->IDS_Type=$IDS_Type;
//----------------------------------------------------------------------------------
			$st_TestNo=$this->IDS_SudKey.$this->IDS_Year;
			$IntoErrey="Yes";
			$IntoDateTime=date("Y-m-d H:i:s");
//----------------------------------------------------------------------------------						
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$SudCount=1;
			if($SudCount>=1){
//---------------------------------------------------------------------------------------				
//Into summer_save_score
				try{
					$IsummerSaveScoreSql="INSERT INTO `summer_save_score`(`st_KeyStu`, `SKS_Subject`, `SKS_Term`, `SKS_Year`, `SSS_Score`, `SSS_Type`) 
										  VALUES ('{$this->IDS_SudKey}','{$this->IDS_SubjectKey}','{$this->IDS_Term}','{$this->IDS_Year}','{$this->IDS_Score}','{$this->IDS_Type}')";
					$pdo_summer->exec($IsummerSaveScoreSql);
					$IntoErrey="No";
				}catch(PDOException $ids){
					$IntoErrey="Yes";
				}
//Into summer_save_score End		
					if($IntoErrey="No"){
//Into summer_test
						try{
							$IsummerTestSql="INSERT INTO `summer_test`(`st_TestNo`, `st_KeyStu`, `st_Term`, `st_Year`, `st_DateTime`, `st_Rc`) 
											 VALUES ('{$st_TestNo}','{$this->IDS_SudKey}','{$this->IDS_Term}','{$this->IDS_Year}','{$IntoDateTime}','{$this->IDS_Rc}')";
							$pdo_summer->exec($IsummerTestSql);
							//$IntoErrey=="No";
						}catch(PDOException $ids){
							//$IntoErrey="Yes";
						}
//Into summer_test End		
//Into	summer_keep_score				
						try{
							$IsummerKeepScoreSql="INSERT INTO `summer_keep_score`(`SKS_Subject`, `SKS_Term`, `SKS_Year`, `SKS_Datetime`, `SKS_Rc`, `st_KeyStu`) 
												  VALUES ('{$this->IDS_SubjectKey}','{$this->IDS_Term}','{$this->IDS_Year}','{$IntoDateTime}','{$this->IDS_Rc}','{$this->IDS_SudKey}')";
							$pdo_summer->exec($IsummerKeepScoreSql);
							//$IntoErrey="No";
						}catch(PDOException $ids){
							//$IntoErrey="Yes";
						}
//Into summer_keep_score End				
					}else{
						$IntoErrey="Yes";
					}
//---------------------------------------------------------------------------------------				
			}else{
				$IntoErrey="Yes";
			}
//Test Error
			if(isset($IntoErrey)){
				$this->IntoErrey=$IntoErrey;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}
		}function RunIntoDataScore(){
			if(isset($this->IntoErrey)){
				return $this->IntoErrey;
			}else{}
		}
	}

?>

<?php
	class IntoDataScoreB{
		public $IDS_SudKey,$IDS_SubjectKey,$IDS_Year,$IDS_Rc,$IDS_Term,$IDS_Score,$IDS_Type;
		function __construct($IDS_SudKey,$IDS_SubjectKey,$IDS_Year,$IDS_Rc,$IDS_Term,$IDS_Score,$IDS_Type){
//----------------------------------------------------------------------------------
			$this->IDS_SudKey=$IDS_SudKey;
			$this->IDS_SubjectKey=$IDS_SubjectKey;
			$this->IDS_Year=$IDS_Year;
			$this->IDS_Rc=$IDS_Rc;
			$this->IDS_Term=$IDS_Term;
			$this->IDS_Score=$IDS_Score;
			$this->IDS_Type=$IDS_Type;
//----------------------------------------------------------------------------------
			$st_TestNo=$this->IDS_SudKey.$this->IDS_Year;
			$IntoErrey="Yes";
			$IntoDateTime=date("Y-m-d H:i:s");
//----------------------------------------------------------------------------------						
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
//Test rs_student
			try{
				$TstudentSql="SELECT COUNT(`rs_key`) AS `SudCount` 
							  FROM `rs_student` 
							  WHERE `rs_key`='{$this->IDS_SudKey}' 
							  AND `rs_year`='{$this->IDS_Year}';";
					if($TstudentRs=$pdo_summer->query($TstudentSql)){
						$TstudentRow=$TstudentRs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($TstudentRow) && count($TstudentRow)){
								$SudCount=$TstudentRow["SudCount"];
							}else{
								$SudCount=0;
							}
					}else{
						$SudCount=0;
					}
			}catch(PDOException $ids){
				$SudCount=0;
			}
//Test rs_student End
			if($SudCount>=1){
//---------------------------------------------------------------------------------------				
//Into summer_save_score
				try{
					$IsummerSaveScoreSql="INSERT INTO `summer_save_score`(`st_KeyStu`, `SKS_Subject`, `SKS_Term`, `SKS_Year`, `SSS_Score`, `SSS_Type`) 
										  VALUES ('{$this->IDS_SudKey}','{$this->IDS_SubjectKey}','{$this->IDS_Term}','{$this->IDS_Year}','{$this->IDS_Score}','{$this->IDS_Type}')";
					$pdo_summer->exec($IsummerSaveScoreSql);
					$IntoErrey="No";
				}catch(PDOException $ids){
					$IntoErrey="Yes";
				}
//Into summer_save_score End		
					if($IntoErrey="No"){
//Into summer_test
						try{
							$IsummerTestSql="INSERT INTO `summer_test`(`st_TestNo`, `st_KeyStu`, `st_Term`, `st_Year`, `st_DateTime`, `st_Rc`) 
											 VALUES ('{$st_TestNo}','{$this->IDS_SudKey}','{$this->IDS_Term}','{$this->IDS_Year}','{$IntoDateTime}','{$this->IDS_Rc}')";
							$pdo_summer->exec($IsummerTestSql);
							//$IntoErrey=="No"
						}catch(PDOException $ids){
							//$IntoErrey="Yes";
						}
//Into summer_test End		
//Into	summer_keep_score				
						try{
							$IsummerKeepScoreSql="INSERT INTO `summer_keep_score`(`SKS_Subject`, `SKS_Term`, `SKS_Year`, `SKS_Datetime`, `SKS_Rc`, `st_KeyStu`) 
												  VALUES ('{$this->IDS_SubjectKey}','{$this->IDS_Term}','{$this->IDS_Year}','{$IntoDateTime}','{$this->IDS_Rc}','{$this->IDS_SudKey}')";
							$pdo_summer->exec($IsummerKeepScoreSql);
							//$IntoErrey="No";
						}catch(PDOException $ids){
							//$IntoErrey="Yes";
						}
//Into summer_keep_score End				
					}else{
						$IntoErrey="Yes";
					}
//---------------------------------------------------------------------------------------				
			}else{
				$IntoErrey="Yes";
			}
//Test Error
			if(isset($IntoErrey)){
				$this->IntoErrey=$IntoErrey;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}
		}function RunIntoDataScore(){
			if(isset($this->IntoErrey)){
				return $this->IntoErrey;
			}else{}
		}
	}

?>

<?php
	class DataTestSaveScoreA{
		public $DTSS_Key,$DTSS_Year,$DTSS_Subject;
		function __construct($DTSS_Key,$DTSS_Year,$DTSS_Subject){
//----------------------------------------------------------------------------------	
			$this->DTSS_Key=$DTSS_Key;
			$this->DTSS_Year=$DTSS_Year;
			$this->DTSS_Subject=$DTSS_Subject;
//----------------------------------------------------------------------------------	
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			try{
				$DataTestSaveScoreSql="SELECT `st_KeyStu`, `SKS_Subject`, `SKS_Term`, `SKS_Year`, `SSS_Score`, `SSS_Type` FROM `summer_save_score`
									   WHERE `st_KeyStu`='{$this->DTSS_Key}' AND `SKS_Year`='{$this->DTSS_Year}' AND `SKS_Subject`='{$this->DTSS_Subject}'";
					if($DataTestSaveScoreRs=$pdo_summer->query($DataTestSaveScoreSql)){
						$DataTestSaveScoreRow=$DataTestSaveScoreRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($DataTestSaveScoreRow) && count($DataTestSaveScoreRow)){
							$DTSS_KeyStu=$DataTestSaveScoreRow["st_KeyStu"];
							$DTSS_Subject=$DataTestSaveScoreRow["SKS_Subject"];
							$DTSS_Term=$DataTestSaveScoreRow["SKS_Term"];
							$DTSS_Year=$DataTestSaveScoreRow["SKS_Year"];
							$DTSS_Score=$DataTestSaveScoreRow["SSS_Score"];
							$DTSS_Type=$DataTestSaveScoreRow["SSS_Type"];
						}else{
							$DTSS_KeyStu=null;
							$DTSS_Subject=null;
							$DTSS_Term=null;
							$DTSS_Year=null;
							$DTSS_Score=null;
							$DTSS_Type=null;							
						}
					}else{
						$DTSS_KeyStu=null;
						$DTSS_Subject=null;
						$DTSS_Term=null;
						$DTSS_Year=null;
						$DTSS_Score=null;
						$DTSS_Type=null;						
					}
			}catch(PDOException $dtss){
				$DTSS_KeyStu=null;
				$DTSS_Subject=null;
				$DTSS_Term=null;
				$DTSS_Year=null;
				$DTSS_Score=null;
				$DTSS_Type=null;				
			}
			
			if(isset($DTSS_KeyStu,$DTSS_Subject,$DTSS_Term,$DTSS_Year,$DTSS_Score,$DTSS_Type)){
				$this->DTSS_KeyStu=$DTSS_KeyStu;
				$this->DTSS_Subject=$DTSS_Subject;
				$this->DTSS_Term=$DTSS_Term;
				$this->DTSS_Year=$DTSS_Year;
				$this->DTSS_Score=$DTSS_Score;
				$this->DTSS_Type=$DTSS_Type;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}
		
		}function __destruct(){
			if(isset($this->DTSS_KeyStu,$this->DTSS_Subject,$this->DTSS_Term,$this->DTSS_Year,$this->DTSS_Score,$this->DTSS_Type)){
				$this->DTSS_KeyStu;
				$this->DTSS_Subject;
				$this->DTSS_Term;
				$this->DTSS_Year;
				$this->DTSS_Score;
				$this->DTSS_Type;
			}else{}
		}
	}
?>

<?php
	class RowDataTestSaveScore{
		public $RDTSS_SudKey,$RDTSS_Term,$RDTSS_Year;
		function __construct($RDTSS_SudKey,$RDTSS_Term,$RDTSS_Year){
//----------------------------------------------------------------------------------	
			$this->RDTSS_SudKey=$RDTSS_SudKey;
			$this->RDTSS_Term=$RDTSS_Term;
			$this->RDTSS_Year=$RDTSS_Year;
//----------------------------------------------------------------------------------	
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$DataTestSaveScoreArray=array();
//----------------------------------------------------------------------------------
			try{
				$TestSaveScoreSql="SELECT DISTINCT `SKS_Subject`  FROM `summer_save_score` 
								   WHERE `st_KeyStu` ='{$this->RDTSS_SudKey}' AND `SKS_Term` ='{$this->RDTSS_Term}' AND `SKS_Year` ='{$this->RDTSS_Year}'  
								   ORDER BY `summer_save_score`.`SKS_Subject`  ASC";
					if($TestSaveScoreRs=$pdo_summer->query($TestSaveScoreSql)){
						while($TestSaveScoreRow=$TestSaveScoreRs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($TestSaveScoreRow) && count($TestSaveScoreRow)){
								$DataTestSaveScoreArray[]=$TestSaveScoreRow;
							}else{
								$DataTestSaveScoreArray=null;
							}
						}
					}else{
						$DataTestSaveScoreArray=null;
					}
			}catch(PDOException $rdtss){
				$DataTestSaveScoreArray=null;
			}
			
			if(isset($DataTestSaveScoreArray)){
				$this->DataTestSaveScoreArray=$DataTestSaveScoreArray;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}
			
		}function RunRowDataTestSaveScore(){
			if(isset($this->DataTestSaveScoreArray)){
				return $this->DataTestSaveScoreArray;
			}else{}
		}
	}
?>

<?php
	class DataTestSaveScoreB{
		public $DTSS_Key,$DTSS_Year,$DTSS_Type,$DTSS_Subject;
		function __construct($DTSS_Key,$DTSS_Year,$DTSS_Type,$DTSS_Subject){
//----------------------------------------------------------------------------------	
			$this->DTSS_Key=$DTSS_Key;
			$this->DTSS_Year=$DTSS_Year;
			$this->DTSS_Type=$DTSS_Type;
			$this->DTSS_Subject=$DTSS_Subject;
//----------------------------------------------------------------------------------	
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			try{
				$DataTestSaveScoreSql="SELECT `st_KeyStu`, `SKS_Subject`, `SKS_Term`, `SKS_Year`, `SSS_Score`, `SSS_Type` FROM `summer_save_score`
									   WHERE `st_KeyStu`='{$this->DTSS_Key}' AND `SKS_Year`='{$this->DTSS_Year}' AND `SSS_Type`='{$this->DTSS_Type}' AND `SKS_Subject`='{$this->DTSS_Subject}'";
					if($DataTestSaveScoreRs=$pdo_summer->query($DataTestSaveScoreSql)){
						$DataTestSaveScoreRow=$DataTestSaveScoreRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($DataTestSaveScoreRow) && count($DataTestSaveScoreRow)){
							$DTSS_KeyStu=$DataTestSaveScoreRow["st_KeyStu"];
							$DTSS_Subject=$DataTestSaveScoreRow["SKS_Subject"];
							$DTSS_Term=$DataTestSaveScoreRow["SKS_Term"];
							$DTSS_Year=$DataTestSaveScoreRow["SKS_Year"];
							$DTSS_Score=$DataTestSaveScoreRow["SSS_Score"];
							$DTSS_Type=$DataTestSaveScoreRow["SSS_Type"];
						}else{
							$DTSS_KeyStu=null;
							$DTSS_Subject=null;
							$DTSS_Term=null;
							$DTSS_Year=null;
							$DTSS_Score=null;
							$DTSS_Type=null;							
						}
					}else{
						$DTSS_KeyStu=null;
						$DTSS_Subject=null;
						$DTSS_Term=null;
						$DTSS_Year=null;
						$DTSS_Score=null;
						$DTSS_Type=null;						
					}
			}catch(PDOException $dtss){
				$DTSS_KeyStu=null;
				$DTSS_Subject=null;
				$DTSS_Term=null;
				$DTSS_Year=null;
				$DTSS_Score=null;
				$DTSS_Type=null;				
			}
			
			if(isset($DTSS_KeyStu,$DTSS_Subject,$DTSS_Term,$DTSS_Year,$DTSS_Score,$DTSS_Type)){
				$this->DTSS_KeyStu=$DTSS_KeyStu;
				$this->DTSS_Subject=$DTSS_Subject;
				$this->DTSS_Term=$DTSS_Term;
				$this->DTSS_Year=$DTSS_Year;
				$this->DTSS_Score=$DTSS_Score;
				$this->DTSS_Type=$DTSS_Type;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}
		
		}function __destruct(){
			if(isset($this->DTSS_KeyStu,$this->DTSS_Subject,$this->DTSS_Term,$this->DTSS_Year,$this->DTSS_Score,$this->DTSS_Type)){
				$this->DTSS_KeyStu;
				$this->DTSS_Subject;
				$this->DTSS_Term;
				$this->DTSS_Year;
				$this->DTSS_Score;
				$this->DTSS_Type;
			}else{}
		}
	}
?>

<?php
	class DataTestSaveScoreC{
		public $DTSS_Key,$DTSS_Year;
		function __construct($DTSS_Key,$DTSS_Year){
//----------------------------------------------------------------------------------	
			$this->DTSS_Key=$DTSS_Key;
			$this->DTSS_Year=$DTSS_Year;
//----------------------------------------------------------------------------------	
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			try{
				$DataTestSaveScoreSql="SELECT `st_KeyStu`, `SKS_Subject`, `SKS_Term`, `SKS_Year`, `SSS_Score`, `SSS_Type` FROM `summer_save_score`
									   WHERE `st_KeyStu`='{$this->DTSS_Key}' AND `SKS_Year`='{$this->DTSS_Year}'";
					if($DataTestSaveScoreRs=$pdo_summer->query($DataTestSaveScoreSql)){
						$DataTestSaveScoreRow=$DataTestSaveScoreRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($DataTestSaveScoreRow) && count($DataTestSaveScoreRow)){
							$DTSS_KeyStu=$DataTestSaveScoreRow["st_KeyStu"];
							$DTSS_Subject=$DataTestSaveScoreRow["SKS_Subject"];
							$DTSS_Term=$DataTestSaveScoreRow["SKS_Term"];
							$DTSS_Year=$DataTestSaveScoreRow["SKS_Year"];
							$DTSS_Score=$DataTestSaveScoreRow["SSS_Score"];
							$DTSS_Type=$DataTestSaveScoreRow["SSS_Type"];
						}else{
							$DTSS_KeyStu=null;
							$DTSS_Subject=null;
							$DTSS_Term=null;
							$DTSS_Year=null;
							$DTSS_Score=null;
							$DTSS_Type=null;							
						}
					}else{
						$DTSS_KeyStu=null;
						$DTSS_Subject=null;
						$DTSS_Term=null;
						$DTSS_Year=null;
						$DTSS_Score=null;
						$DTSS_Type=null;						
					}
			}catch(PDOException $dtss){
				$DTSS_KeyStu=null;
				$DTSS_Subject=null;
				$DTSS_Term=null;
				$DTSS_Year=null;
				$DTSS_Score=null;
				$DTSS_Type=null;				
			}
			
			if(isset($DTSS_KeyStu,$DTSS_Subject,$DTSS_Term,$DTSS_Year,$DTSS_Score,$DTSS_Type)){
				$this->DTSS_KeyStu=$DTSS_KeyStu;
				$this->DTSS_Subject=$DTSS_Subject;
				$this->DTSS_Term=$DTSS_Term;
				$this->DTSS_Year=$DTSS_Year;
				$this->DTSS_Score=$DTSS_Score;
				$this->DTSS_Type=$DTSS_Type;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}
		
		}function __destruct(){
			if(isset($this->DTSS_KeyStu,$this->DTSS_Subject,$this->DTSS_Term,$this->DTSS_Year,$this->DTSS_Score,$this->DTSS_Type)){
				$this->DTSS_KeyStu;
				$this->DTSS_Subject;
				$this->DTSS_Term;
				$this->DTSS_Year;
				$this->DTSS_Score;
				$this->DTSS_Type;
			}else{}
		}
	}
?>


<?php
	class DataStuPaySummer{
		public $DSPS_Key,$DSPS_Year,$DSPS_Class;
		public $StuPayini;
		function __construct($DSPS_Key,$DSPS_Year,$DSPS_Class){
//----------------------------------------------------------------------------------			
			$this->DSPS_Key=$DSPS_Key;
			$this->DSPS_Year=$DSPS_Year;
			$this->DSPS_Class=$DSPS_Class;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------		
			try{
				$DSPS_Sql="SELECT COUNT(`rsf_key`) AS `StuPayini` 
						   FROM `rc_summer_first` 
						   WHERE `rsf_key`='{$this->DSPS_Key}' 
						   AND `rsf_year`='{$this->DSPS_Year}' 
						   AND `rsf_class`='{$this->DSPS_Class}'";	
					if($DSPS_Rs=$pdo_summer->query($DSPS_Sql)){
						$DSPS_Row=$DSPS_Rs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($DSPS_Row) && count($DSPS_Row)){
								$StuPayini=$DSPS_Row["StuPayini"];
							}else{
								$StuPayini=0;
							}
					}else{
						$StuPayini=0;
					}
			}catch(PDOException $cs){
				$StuPayini=0;
			}

				if(isset($StuPayini)){
					$this->StuPayini=$StuPayini;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
			
		}function RunDataStuPaySummer(){
			if(isset($this->StuPayini)){
				return $this->StuPayini;
			}else{}
		}
	}
?>

<?php
	class DataRsStudentRow{
		public $DRSD_Year,$DRSD_Class;
		public $DataRsStudentArray;
		function __construct($DRSD_Year,$DRSD_Class){
			$this->DRSD_Year=$DRSD_Year;
			$this->DRSD_Class=$DRSD_Class;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$DataRsStudentArray=array();
//----------------------------------------------------------------------------------			
			$RsStudentDataSql="SELECT * FROM `rs_student_data` 
							   WHERE `RSD_year`='{$this->DRSD_Year}' 
							   AND `RSD_class`='{$this->DRSD_Class}'";
				if($RsStudentDataRs=$pdo_summer->query($RsStudentDataSql)){
					while($RsStudentDataRow=$RsStudentDataRs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($RsStudentDataRow) && count($RsStudentDataRow)){
							$DataRsStudentArray[]=$RsStudentDataRow;
						}else{
							$DataRsStudentArray=null;
						}						
					}
				}else{
					$DataRsStudentArray=null;
				}
				if(isset($DataRsStudentArray)){
					$this->DataRsStudentArray=$DataRsStudentArray;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
		}function RunDataRsStudentRow(){
			if(isset($this->DataRsStudentArray)){
				return $this->DataRsStudentArray;
			}else{}
		}
	}

?>

<?php
	class DataRsStudentDataA{
		public $DRSD_Key,$DRSD_Year,$DRSD_Class;
		public $RSDKey,$RSDIDnumber,$mynameTh,$RSDNicknameTh,$RSDSchool,$RSDClass,$RSDPhone;
		function __construct($DRSD_Key,$DRSD_Year,$DRSD_Class){
			$this->DRSD_Key=$DRSD_Key;
			$this->DRSD_Year=$DRSD_Year;
			$this->DRSD_Class=$DRSD_Class;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$RsStudentDataSql="SELECT * FROM `rs_student_data` 
							   WHERE `RSD_key`='{$this->DRSD_Key}' 
							   AND `RSD_year`='{$this->DRSD_Year}'
							   AND `RSD_Class`='{$this->DRSD_Class}'";
				if($RsStudentDataRs=$pdo_summer->query($RsStudentDataSql)){
					$RsStudentDataRow=$RsStudentDataRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($RsStudentDataRow) && count($RsStudentDataRow)){
							$RSDKey=$RsStudentDataRow["RSD_key"];
							$RSDIDnumber=$RsStudentDataRow["RSD_IDnumber"];
							if($RsStudentDataRow["RSD_PrefixTh"]==2){
								$mynameTh="เด็กหญิง ".$RsStudentDataRow["RSD_NameTh"]." ".$RsStudentDataRow["RSD_SurnameTh"];
							}elseif($RsStudentDataRow["RSD_PrefixTh"]==4){
								$mynameTh="นางสาว ".$RsStudentDataRow["RSD_NameTh"]." ".$RsStudentDataRow["RSD_SurnameTh"];
							}else{
								$mynameTh=$RsStudentDataRow["RSD_NameTh"]." ".$RsStudentDataRow["RSD_SurnameTh"];
							}
								$RSDNicknameTh=$RsStudentDataRow["RSD_nicknameTh"];
								$RSDSchool=$RsStudentDataRow["RSD_school"];
								$RSDClass=$RsStudentDataRow["RSD_class"];
								$RSDPhone=$RsStudentDataRow["RSD_phone"];
						}else{
							$RSDKey=null;
							$RSDIDnumber=null;
							$mynameTh=null;
							$RSDNicknameTh=null;
							$RSDSchool=null;
							$RSDClass=null;
							$RSDPhone=null;
						}
				}else{
					$RSDKey=null;
					$RSDIDnumber=null;
					$mynameTh=null;
				    $RSDNicknameTh=null;
					$RSDSchool=null;
					$RSDClass=null;
					$RSDPhone=null;
				}
				if(isset($RSDKey)){
					$this->RSDKey=$RSDKey;
					$this->RSDIDnumber=$RSDIDnumber;
					$this->mynameTh=$mynameTh;
					$this->RSDNicknameTh=$RSDNicknameTh;
					$this->RSDSchool=$RSDSchool;
					$this->RSDClass=$RSDClass;
					$this->RSDPhone=$RSDPhone;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
		}function __destruct(){
			if(isset($this->RSDKey)){
				$this->RSDKey;
				$this->RSDIDnumber;
				$this->mynameTh;
				$this->RSDNicknameTh;
				$this->RSDSchool;
				$this->RSDClass;
				$this->RSDPhone;				
			}else{}
		}
	}

	

?>


<?php
	class DataRsStudentData{
		public $DRSD_Key,$DRSD_Year,$DRSD_Class;
		function __construct($DRSD_Key,$DRSD_Year,$DRSD_Class){
			$this->DRSD_Key=$DRSD_Key;
			$this->DRSD_Year=$DRSD_Year;
			$this->DRSD_Class=$DRSD_Class;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$RsStudentDataSql="SELECT * FROM `rs_student_data` 
							   WHERE `RSD_key`='{$this->DRSD_Key}' 
							   AND `RSD_year`='{$this->DRSD_Year}' 
							   AND `RSD_class`='{$this->DRSD_Class}'";
				if($RsStudentDataRs=$pdo_summer->query($RsStudentDataSql)){
					$RsStudentDataRow=$RsStudentDataRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($RsStudentDataRow) && count($RsStudentDataRow)){
							$RSDKey=$RsStudentDataRow["RSD_key"];
							$RSDIDnumber=$RsStudentDataRow["RSD_IDnumber"];
							
							if(($RsStudentDataRow["RSD_class"]>=3 and $RsStudentDataRow["RSD_class"]<=33)){
								$mynameTh="เด็กหญิง ".$RsStudentDataRow["RSD_NameTh"]." ".$RsStudentDataRow["RSD_SurnameTh"];								
							}elseif(($RsStudentDataRow["RSD_class"]>=41 and $RsStudentDataRow["RSD_class"]<=43)){
								$mynameTh="นางสาว ".$RsStudentDataRow["RSD_NameTh"]." ".$RsStudentDataRow["RSD_SurnameTh"];								
							}else{
								$mynameTh=$RsStudentDataRow["RSD_NameTh"]." ".$RsStudentDataRow["RSD_SurnameTh"];								
							}
							
							$RSDNicknameTh=$RsStudentDataRow["RSD_nicknameTh"];
							$RSDSchool=$RsStudentDataRow["RSD_school"];
							$RSDClass=$RsStudentDataRow["RSD_class"];
							$RSDPhone=$RsStudentDataRow["RSD_phone"];
								
						}else{
							$RSDKey=null;
							$RSDIDnumber=null;
							$mynameTh=null;
							$RSDNicknameTh=null;
							$RSDSchool=null;
							$RSDClass=null;
							$RSDPhone=null;
						}
				}else{
					$RSDKey=null;
					$RSDIDnumber=null;
					$mynameTh=null;
				    $RSDNicknameTh=null;
					$RSDSchool=null;
					$RSDClass=null;
					$RSDPhone=null;
				}
				if(isset($RSDKey)){
					$this->RSDKey=$RSDKey;
					$this->RSDIDnumber=$RSDIDnumber;
					$this->mynameTh=$mynameTh;
					$this->RSDNicknameTh=$RSDNicknameTh;
					$this->RSDSchool=$RSDSchool;
					$this->RSDClass=$RSDClass;
					$this->RSDPhone=$RSDPhone;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
		}function __destruct(){
			if(isset($this->RSDKey)){
				$this->RSDKey;
				$this->RSDIDnumber;
				$this->mynameTh;
				$this->RSDNicknameTh;
				$this->RSDSchool;
				$this->RSDClass;
				$this->RSDPhone;				
			}else{}
		}
	}

?>


<?php
	class DataRsStudentData2{
		public $DRSD_Key,$DRSD_Year;
		function __construct($DRSD_Key,$DRSD_Year){
			$this->DRSD_Key=$DRSD_Key;
			$this->DRSD_Year=$DRSD_Year;
			//$this->DRSD_Class=$DRSD_Class;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$RsStudentDataSql="SELECT * FROM `rs_student_data` 
							   WHERE `RSD_key`='{$this->DRSD_Key}' 
							   AND `RSD_year`='{$this->DRSD_Year}'";
				if($RsStudentDataRs=$pdo_summer->query($RsStudentDataSql)){
					$RsStudentDataRow=$RsStudentDataRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($RsStudentDataRow) && count($RsStudentDataRow)){
							$RSDKey=$RsStudentDataRow["RSD_key"];
							$RSDIDnumber=$RsStudentDataRow["RSD_IDnumber"];
							
							if(($RsStudentDataRow["RSD_class"]>=3 and $RsStudentDataRow["RSD_class"]<=33)){
								$mynameTh="เด็กหญิง ".$RsStudentDataRow["RSD_NameTh"]." ".$RsStudentDataRow["RSD_SurnameTh"];								
							}elseif(($RsStudentDataRow["RSD_class"]>=41 and $RsStudentDataRow["RSD_class"]<=43)){
								$mynameTh="นางสาว ".$RsStudentDataRow["RSD_NameTh"]." ".$RsStudentDataRow["RSD_SurnameTh"];								
							}else{
								$mynameTh=$RsStudentDataRow["RSD_NameTh"]." ".$RsStudentDataRow["RSD_SurnameTh"];								
							}
							
							$RSDNicknameTh=$RsStudentDataRow["RSD_nicknameTh"];
							$RSDSchool=$RsStudentDataRow["RSD_school"];
							$RSDClass=$RsStudentDataRow["RSD_class"];
							$RSDPhone=$RsStudentDataRow["RSD_phone"];
								
						}else{
							$RSDKey=null;
							$RSDIDnumber=null;
							$mynameTh=null;
							$RSDNicknameTh=null;
							$RSDSchool=null;
							$RSDClass=null;
							$RSDPhone=null;
						}
				}else{
					$RSDKey=null;
					$RSDIDnumber=null;
					$mynameTh=null;
				    $RSDNicknameTh=null;
					$RSDSchool=null;
					$RSDClass=null;
					$RSDPhone=null;
				}
				if(isset($RSDKey)){
					$this->RSDKey=$RSDKey;
					$this->RSDIDnumber=$RSDIDnumber;
					$this->mynameTh=$mynameTh;
					$this->RSDNicknameTh=$RSDNicknameTh;
					$this->RSDSchool=$RSDSchool;
					$this->RSDClass=$RSDClass;
					$this->RSDPhone=$RSDPhone;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
		}function __destruct(){
			if(isset($this->RSDKey)){
				$this->RSDKey;
				$this->RSDIDnumber;
				$this->mynameTh;
				$this->RSDNicknameTh;
				$this->RSDSchool;
				$this->RSDClass;
				$this->RSDPhone;				
			}else{}
		}
	}

?>


<?php
	class NameRsSubjectData{
		public $NRJD_On,$NRJD_Year;
		function __construct($NRJD_On,$NRJD_Year){
			$this->NRJD_On=$NRJD_On;
			$this->NRJD_Year=$NRJD_Year;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$NRJD_Sql="SELECT `RSD_no`, `RSD_txtTh`, `RSD_txtEn`, `RSD_class`, `RSD_year`, `RST_on` 
					   FROM `rssubject_data` 
					   WHERE `RSD_no`='{$this->NRJD_On}' 
					   AND `RSD_year`='{$this->NRJD_Year}'";
				if($NRJD_Rs=$pdo_summer->query($NRJD_Sql)){
					$NRJD_Row=$NRJD_Rs->Fetch(PDO::FETCH_ASSOC);
						if((is_array($NRJD_Row) && count($NRJD_Row))){
							$RSD_no=$NRJD_Row["RSD_no"];
							$RSD_txtTh=$NRJD_Row["RSD_txtTh"];
							$RSD_txtEn=$NRJD_Row["RSD_txtEn"];
							$RSD_class=$NRJD_Row["RSD_class"];
							$RSD_year=$NRJD_Row["RSD_year"];
							$RST_on=$NRJD_Row["RST_on"];
						}else{
							$RSD_no=null;
							$RSD_txtTh=null;
							$RSD_txtEn=null;
							$RSD_class=null;
							$RSD_year=null;
							$RST_on=null;							
						}
				}else{
					$RSD_no=null;
					$RSD_txtTh=null;
					$RSD_txtEn=null;
					$RSD_class=null;
					$RSD_year=null;
					$RST_on=null;					
				}
			if(isset($RSD_no)){
				$this->RSD_no=$RSD_no;
				$this->RSD_txtTh=$RSD_txtTh;
				$this->RSD_txtEn=$RSD_txtEn;
				$this->RSD_class=$RSD_class;
				$this->RSD_year=$RSD_year;
				$this->RST_on=$RST_on;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}
		}function __destruct(){
			if(isset($this->RSD_no)){
				$this->RSD_no;
				$this->RSD_txtTh;
				$this->RSD_txtEn;
				$this->RSD_class;
				$this->RSD_year;
				$this->RST_on;				
			}else{}
		}
		
	}
?>

<?php
	class PrintMoneyPaySummer{//รายชื่อผู้ลงทะเบียนทั้งหมด
		public $PMPS_RSPno,$PMPS_RSPyear;
		function __construct($PMPS_RSPno,$PMPS_RSPyear){
			$this->PMPS_RSPno=$PMPS_RSPno;
			$this->PMPS_RSPyear=$PMPS_RSPyear;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$ArrayMoneyPaySummer=array();
//----------------------------------------------------------------------------------
			$PrintMoneyPaySummerSql="SELECT `RMT_no`, `RMT_year`, `rs_key`, `RSP_no`, `RSP_year` 
									 FROM `money_pay_summer` 
									 WHERE `RSP_no`='{$this->PMPS_RSPno}' AND `RSP_year`='{$this->PMPS_RSPyear}'
									 ORDER BY `rs_key` ASC";
				if($PrintMoneySummerRs=$pdo_summer->query($PrintMoneyPaySummerSql)){
					while($PrintMoneySummerRow=$PrintMoneySummerRs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($PrintMoneySummerRow) && count($PrintMoneySummerRow)){
							$ArrayMoneyPaySummer[]=$PrintMoneySummerRow;
						}else{
							$ArrayMoneyPaySummer=null;
						}
					}
				}else{
					$ArrayMoneyPaySummer=null;
				}
			if(isset($ArrayMoneyPaySummer)){
				$this->ArrayMoneyPaySummer=$ArrayMoneyPaySummer;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}
		}function RunPrintMoneyPaySummer(){
			if(isset($this->ArrayMoneyPaySummer)){
				return $this->ArrayMoneyPaySummer;
			}else{}
		}
	}

?>

<?php
	class StuMoneyPaySummer{//ข้อมูลลงทะเบียนรายบุคคล
		public $PMPS_key,$PMPS_year,$PMPS_RSPno;
		function __construct($PMPS_key,$PMPS_year,$PMPS_RSPno){
			$this->PMPS_key=$PMPS_key;
			$this->PMPS_year=$PMPS_year;
			$this->PMPS_RSPno=$PMPS_RSPno;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
//money_pay_summer
			$MoneyPaySummerSql="SELECT COUNT(`rs_key`) AS `CountStu` 
								FROM `money_pay_summer`
								WHERE `RSP_no`='{$this->PMPS_RSPno}' 
								AND `RSP_year`='{$this->PMPS_year}'
								AND `rs_key`='{$this->PMPS_key}'";
				if($MoneyPaySummerRs=$pdo_summer->query($MoneyPaySummerSql)){
					$MoneyPaySummerRow=$MoneyPaySummerRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($MoneyPaySummerRow) && count($MoneyPaySummerRow)){
							$CountStu=$MoneyPaySummerRow["CountStu"];
						}else{
							$CountStu=null;
						}
				}else{
					$CountStu=null;
				}
//money_pay_summer End
			if(isset($CountStu)){
				$this->CountStu=$CountStu;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}
		}function CallStuMoneyPaySummer(){
			if(isset($this->CountStu)){
				return $this->CountStu;
			}else{}
		}
	}
?>



<?php
	class CountMoneyPaySummer{
		public $SMPS_no,$SMPS_year;
		public $RSC_keep,$remain_summer,$count_rckey;
		function __construct($SMPS_no,$SMPS_year){
			$this->SMPS_no=$SMPS_no;
			$this->SMPS_year=$SMPS_year;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------			
//Call rssubject_count	
			$RsSubJectCountSql="SELECT `RSC_keep` 
								FROM `rssubject_count` 
								WHERE `RSD_no`='{$this->SMPS_no}';";
				if($RsSudJectCountRs=$pdo_summer->query($RsSubJectCountSql)){
					while($RsSudJectCountRow=$RsSudJectCountRs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($RsSudJectCountRow) && count($RsSudJectCountRow)){
							$RSC_keep=$RsSudJectCountRow["RSC_keep"];
						}else{
							$RSC_keep=null;
						}
					}
				}else{
					$RSC_keep=null;
				}
//Call rssubject_count	End
//call money_pay_summer
			$MoneyPaySummerSql="SELECT count(`rs_key`) AS `count_rckey`
          			            FROM `money_pay_summer` 
								WHERE `RSP_year`='{$this->SMPS_year}' 
								and `RSP_no`='{$this->SMPS_no}'";
				if($MoneyPaySummerRs=$pdo_summer->query($MoneyPaySummerSql)){
					$MoneyPaySummerRow=$MoneyPaySummerRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($MoneyPaySummerRow) && count($MoneyPaySummerRow)){
							$count_rckey=$MoneyPaySummerRow["count_rckey"];
						}else{
							$count_rckey=null;
						}
				}else{
					$count_rckey=null;
				}
//cal money_pay_summer End
				if(isset($RSC_keep,$count_rckey)){
					$remain_summer=$RSC_keep-$count_rckey;
//-----------------------------------------------------------------------------------------------					
					$this->RSC_keep=$RSC_keep;
					$this->count_rckey=$count_rckey;
					$this->remain_summer=$remain_summer;
//-----------------------------------------------------------------------------------------------					
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
		}function RunKeepSummer(){
			if(isset($this->RSC_keep)){
				return $this->RSC_keep;
			}else{}
		}function RunRemainSummer(){
			if(isset($this->remain_summer)){
				return $this->remain_summer;
			}else{}			
		}function RunCountSummer(){
			if(isset($this->count_rckey)){
				return $this->count_rckey;
			}else{}			
		}
	}
?>

<?php
	class ShowCountSummer{
		public $SCS_No,$SCS_year;
		public $SCS_RSC_count;
		function __construct($SCS_No,$SCS_year){
			$this->SCS_No=$SCS_No;
			$this->SCS_year=$SCS_year;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------			
//call CountMoneyPaySummer
			$CountSummer=new CountMoneyPaySummer($this->SCS_No,$this->SCS_year);
			$SCS_RSC_keep=$CountSummer->RunKeepSummer();
			$SCS_RSC_count=$CountSummer->RunCountSummer();
//call	CountMoneyPaySummer			
				if(isset($SCS_RSC_keep,$SCS_RSC_count)){
					$this->SCS_RSC_keep=$SCS_RSC_keep;
					$this->SCS_RSC_count=$SCS_RSC_count;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
		}function CountSummerKeep(){
			if(isset($this->SCS_RSC_keep)){
				return $this->SCS_RSC_keep;
			}else{}
		}function CountSummerCount(){
			if(isset($this->SCS_RSC_count)){
				return $this->SCS_RSC_count;
			}else{}			
		}
	}
?>

<?php
	class PrintSummerData{
		public $PSD_Key,$PSD_Year;
		public $PrintSummerDataArray;
		function __construct($PSD_Key,$PSD_Year){
			$this->PSD_Key=$PSD_Key;
			$this->PSD_Year=$PSD_Year;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$PrintSummerDataArray=array();
//----------------------------------------------------------------------------------
				$PSD_Sql="select `rssubject_data`.`RSD_no`,`rssubject_data`.`RSD_txtTh`,`rssubject_data`.`RSD_txtEn`,`rssubject_price`.`RSP_price`,`money_pay_summer`.`RSP_no`,`rssubject_data`.`RST_on`
						  from `money_pay_summer` join `rssubject_data` on (`money_pay_summer`.`RSP_no`=`rssubject_data`.`RSD_no`)
						  join `rssubject_price` on(`money_pay_summer`.`RSP_no`=`rssubject_price`.`RSP_no`)
						  where `money_pay_summer`.`rs_key`='{$this->PSD_Key}' 
						  and `money_pay_summer`.`RSP_year`='{$this->PSD_Year}'
						  and `rssubject_data`.`RSD_year`='{$this->PSD_Year}'
						  and `rssubject_price`.`RSP_year`='{$this->PSD_Year}' ORDER BY `rssubject_data`.`RSD_no` ASC";
					if($PSD_Rs=$pdo_summer->query($PSD_Sql)){
						while($PSD_Row=$PSD_Rs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($PSD_Row) && count($PSD_Row)){
								$PrintSummerDataArray[]=$PSD_Row;
							}else{
								$PrintSummerDataArray=null;
							}
						}
					}else{
						$PrintSummerDataArray=null;
					}	
					
					if(isset($PrintSummerDataArray)){
						$this->PrintSummerDataArray=$PrintSummerDataArray;
						$pdo_summer=null;
					}else{
						$pdo_summer=null;
					}		
		}function RunPrintSummerData(){
			if(isset($this->PrintSummerDataArray)){
				return $this->PrintSummerDataArray;
			}else{}
		}
	}
?>


<?php
	class Delete_Summer{
		public $DS_Key,$DS_Year;
		public $DS_Error;
		function __construct($DS_Key,$DS_Year){
			$this->DS_Key=$DS_Key;
			$this->DS_Year=$DS_Year;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
//Delete : rs_money_data
			try{
				$rs_money_dataSql="DELETE FROM `rs_money_data` WHERE `rs_key`='{$this->DS_Key}' AND `RMT_year`='{$this->DS_Year}'";
				$pdo_summer->exec($rs_money_dataSql);
				$DS_Error="yes";
			}catch(PDOException $e){
				$DS_Error="no";
			}
//Delete : money_pay_summer
			try{
				$money_pay_summerSql="DELETE FROM `money_pay_summer` WHERE `rs_key`='{$this->DS_Key}' AND `RSP_year`='{$this->DS_Year}' AND `RMT_year`='{$this->DS_Year}'";
				$pdo_summer->exec($money_pay_summerSql);
				$DS_Error="yes";
			}catch(PDOException $e){
				$DS_Error="no";
			}
//Delete : rs_student
			try{
				$rs_studentSql="DELETE FROM `rs_student` WHERE `rs_year`='{$this->DS_Year}' AND `rs_key`='{$this->DS_Key}'";
				$pdo_summer->exec($rs_studentSql);
				$DS_Error="yes";
			}catch(PDOException $e){
				$DS_Error="no";
			}
			
				if(isset($DS_Error)){
					$this->DS_Error=$DS_Error;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
				
		}function RunDelete_Summer(){
			if(isset($this->DS_Error)){
				return $this->DS_Error;
			}else{}
		}
	}
?>

<?php
	class AddSudSummer{
		public $ASS_sudid,$ASS_year,$ASS_summerid,$ASS_Est,$ASS_Class;
		function __construct($ASS_sudid,$ASS_year,$ASS_summerid,$ASS_Est,$ASS_Class){
			$this->ASS_sudid=$ASS_sudid;
			$this->ASS_year=$ASS_year;
			$this->ASS_summerid=$ASS_summerid;
			$this->ASS_Est=$ASS_Est;
			$this->ASS_Class=$ASS_Class;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$ASS_date=date("Y-m-d H:i:s");
//----------------------------------------------------------------------------------
			$SummerKeep=new ShowCountSummer($this->ASS_summerid,$this->ASS_year);
			$SummerKeep=$SummerKeep->CountSummerKeep();
			$SummerCount=new ShowCountSummer($this->ASS_summerid,$this->ASS_year);
			$SummerCount=$SummerCount->CountSummerCount();
//----------------------------------------------------------------------------------
				if(isset($SummerKeep,$SummerCount)){
					
					if($SummerCount>=$SummerKeep){
						$ASS_Error="no";
					}else{
//----------------------------------------------------------------------------------
		//RMT_NO
					$NewRmtNoSql="select `RMT_no` as `Count_RMT`
								  from `rs_money_data` 
								  where `RMT_year`='{$this->ASS_year}' order by `Count_RMT` desc ;";
						if($NewRmtNoRs=$pdo_summer->query($NewRmtNoSql)){
							$NewRmtNoRow=$NewRmtNoRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($NewRmtNoRow) && count($NewRmtNoRow)){
									$Count_RMT=substr($NewRmtNoRow["Count_RMT"],4);
									$Count_RMT=$Count_RMT+1;
								}else{
									$Count_RMT=0;
									$Count_RMT=$Count_RMT+1;
								}
						}else{
							$Count_RMT=0;
						}
						if($Count_RMT<=9){
							$RMT_NO=$this->ASS_year."00".$Count_RMT;
						}elseif($Count_RMT<=99){
							$RMT_NO=$this->ASS_year."0".$Count_RMT;
						}else{
							$RMT_NO=$this->ASS_year.$Count_RMT;
						}
		//RMT_NO end
		//RsSubjectCount
						$RsSubjectCountSql="SELECT `RSC_count` AS `Count_ASD` 
											FROM `rssubject_count` 
											WHERE `RSD_no`='{$this->ASS_summerid}' AND `RSD_year`='{$this->ASS_year}'";
							if($RsSubjectCountRs=$pdo_summer->query($RsSubjectCountSql)){
								$RsSubjectCountRow=$RsSubjectCountRs->Fetch(PDO::FETCH_ASSOC);
								if(is_array($RsSubjectCountRow) && count($RsSubjectCountRow)){
									$Count_ASD=$RsSubjectCountRow["Count_ASD"];
									$Count_ASD=$Count_ASD+1;
								}else{
									$Count_ASD=0;
									$Count_ASD=$Count_ASD+1;
								}
							}else{
								$Count_ASD=0;
							}
		//RsSubjectCountEnd

		//AddRs_money_data
							$SummerFirstSql="SELECT COUNT(`rsf_key`) AS `int_key` 
											 FROM  `rc_summer_first` 
											 WHERE `rsf_key`='{$this->ASS_sudid}' 
											 AND   `rsf_year`='{$this->ASS_year}'";
								if($SummerFirstRs=$pdo_summer->query($SummerFirstSql)){
									$SummerFirstRow=$SummerFirstRs->Fetch(PDO::FETCH_ASSOC);
									if(is_array($SummerFirstRow) && count($SummerFirstRow)){
										$int_key=$SummerFirstRow["int_key"];
									}else{
										$int_key=0;
									}
								}else{
									$int_key=0;
								}
								
								if($int_key>=1){
									try{
										$AddRs_money_dataSql="INSERT INTO `rs_money_data`(`RMT_data`, `RMT_no`, `RMT_year`, `RMD_on`, `rs_key`)
															  VALUES ('{$ASS_date}','{$RMT_NO}','{$this->ASS_year}','2','{$this->ASS_sudid}')";
										$pdo_summer->exec($AddRs_money_dataSql);
										//$pdo_summer->commit();
										$ASS_Error="yes";
									}catch(PDOException $e){
										//$pdo_summer->rollback();
										$ASS_Error="no";
									}							
								}else{
									try{
										$AddRs_money_dataSql="INSERT INTO `rs_money_data`(`RMT_data`, `RMT_no`, `RMT_year`, `RMD_on`, `rs_key`)
															  VALUES ('{$ASS_date}','{$RMT_NO}','{$this->ASS_year}','1','{$this->ASS_sudid}')";
										$pdo_summer->exec($AddRs_money_dataSql);
										//$pdo_summer->commit();
										$ASS_Error="yes";
									}catch(PDOException $e){
										//$pdo_summer->rollback();
										$ASS_Error="no";
									}							
								}					
		//AddRs_money_data end

								if($this->ASS_Est=="A"){					
		//AddMoney_pay_summer
									try{
										$AddMoney_pay_summerSql="INSERT INTO `money_pay_summer`(`RMT_no`, `RMT_year`, `rs_key`, `RSP_no`, `RSP_year`) 
																 VALUES ('{$RMT_NO}','{$this->ASS_year}','{$this->ASS_sudid}','{$this->ASS_summerid}','{$this->ASS_year}')";
										$pdo_summer->exec($AddMoney_pay_summerSql);
										//$pdo_summer->commit();
										$ASS_Error="yes";						
									}catch(PDOException $e){
										//$pdo_summer->rollback();
										$ASS_Error="no";						
									}
		//AddMoney_pay_summer end							
								}elseif($this->ASS_Est=="B"){
									
									$SRSD_Data=new ShowRsSubjectData($this->ASS_year,$this->ASS_Class);
									foreach($SRSD_Data->RunShowRsSubjectData() as $rc=>$SRSD_DataRow){
										if($SRSD_DataRow["RST_on"]==2){
											
		//AddMoney_pay_summer
											try{
												$AddMoney_pay_summerSql="INSERT INTO `money_pay_summer`(`RMT_no`, `RMT_year`, `rs_key`, `RSP_no`, `RSP_year`) 
																		 VALUES ('{$RMT_NO}','{$this->ASS_year}','{$this->ASS_sudid}','{$SRSD_DataRow["RSD_no"]}','{$this->ASS_year}')";
												$pdo_summer->exec($AddMoney_pay_summerSql);
												//$pdo_summer->commit();
												$ASS_Error="yes";						
											}catch(PDOException $e){
												//$pdo_summer->rollback();
												$ASS_Error="no";						
											}
		//AddMoney_pay_summer end				

							
										}elseif($SRSD_DataRow["RST_on"]==3){
		//AddMoney_pay_summer
											try{
												$AddMoney_pay_summerSql="INSERT INTO `money_pay_summer`(`RMT_no`, `RMT_year`, `rs_key`, `RSP_no`, `RSP_year`) 
																		 VALUES ('{$RMT_NO}','{$this->ASS_year}','{$this->ASS_sudid}','{$SRSD_DataRow["RSD_no"]}','{$this->ASS_year}')";
												$pdo_summer->exec($AddMoney_pay_summerSql);
												//$pdo_summer->commit();
												$ASS_Error="yes";						
											}catch(PDOException $e){
												//$pdo_summer->rollback();
												$ASS_Error="no";						
											}
		//AddMoney_pay_summer end									
										}else{}
									}
									
		//AddMoney_pay_summer
									try{
										$AddMoney_pay_summerSql="INSERT INTO `money_pay_summer`(`RMT_no`, `RMT_year`, `rs_key`, `RSP_no`, `RSP_year`) 
																 VALUES ('{$RMT_NO}','{$this->ASS_year}','{$this->ASS_sudid}','{$this->ASS_summerid}','{$this->ASS_year}')";
										$pdo_summer->exec($AddMoney_pay_summerSql);
										//$pdo_summer->commit();
										$ASS_Error="yes";						
									}catch(PDOException $e){
										//$pdo_summer->rollback();
										$ASS_Error="no";						
									}
		//AddMoney_pay_summer end							
									
								}else{
									$ASS_Error="no";
								}

		//Addrc_student
							try{
								$AddrcStudentSql="INSERT INTO `rs_student`(`rs_class`, `rs_data`, `rs_key`, `rs_year`) 
												  VALUES ('{$this->ASS_Class}','{$ASS_date}','{$this->ASS_sudid}','{$this->ASS_year}')";
								$pdo_summer->exec($AddrcStudentSql);
								//$pdo_summer->commit();
								$ASS_Error="yes";
							}catch(PDOException $e){
								//$pdo_summer->rollback();
								$ASS_Error="no";						
							}
		//Addrc_student end

		//updata rssubject_count
							if($ASS_Error=="yes"){
		//-----------------------------------------------------------------------------------------						
								$SummerKeep=new ShowCountSummer($this->ASS_summerid,$this->ASS_year);
								$SummerKeep=$SummerKeep->CountSummerKeep();
								$SummerCount=new ShowCountSummer($this->ASS_summerid,$this->ASS_year);
								$SummerCount=$SummerCount->CountSummerCount();	
									if($SummerCount>=$SummerKeep){
										$DeleteSummer=new Delete_Summer($this->ASS_sudid,$this->ASS_year);
									}else{
		//-----------------------------------------------------------------------------------------
										try{
											$Up_RSC="UPDATE `rssubject_count` SET `RSC_count`='{$Count_ASD}' WHERE `RSD_year`='{$this->ASS_year}' AND `RSD_no`='{$this->ASS_summerid}'";
											$pdo_summer->exec($Up_RSC);
											$ASS_Error="yes";
										}catch(PDOException $e){
											$ASS_Error="no";
										}
		//-----------------------------------------------------------------------------------------	
										$SRSD_DataC=new ShowRsSubjectData($this->ASS_year,$this->ASS_Class);
										foreach($SRSD_DataC->RunShowRsSubjectData() as $rc=>$SRSD_DataCRow){
											if($SRSD_DataCRow["RST_on"]==2){
		//-----------------------------------------------------------------------------------------	
		//RsSubjectCount
											$RsSubjectCountASql="SELECT `RSC_count` AS `Count_ASD` 
																 FROM `rssubject_count` 
																 WHERE `RSD_no`='{$SRSD_DataCRow['RSD_no']}' AND `RSD_year`='{$this->ASS_year}'";
												if($RsSubjectCountARs=$pdo_summer->query($RsSubjectCountASql)){
													$RsSubjectCountARow=$RsSubjectCountARs->Fetch(PDO::FETCH_ASSOC);
													if(is_array($RsSubjectCountARow) && count($RsSubjectCountARow)){
														$Count_ASDA=$RsSubjectCountARow["Count_ASD"];
														$Count_ASDA=$Count_ASDA+1;
													}else{
														$Count_ASDA=0;
														$Count_ASDA=$Count_ASDA+1;
													}
												}else{
													$Count_ASDA=0;
												}
		//RsSubjectCountEnd					
		//-----------------------------------------------------------------------------------------						
												try{
													$Up_RSCC="UPDATE `rssubject_count` SET `RSC_count`='{$Count_ASDA}' WHERE `RSD_year`='{$this->ASS_year}' AND `RSD_no`='{$SRSD_DataCRow["RSD_no"]}'";
													$pdo_summer->exec($Up_RSCC);
													$ASS_Error="yes";
												}catch(PDOException $e){
													$ASS_Error="no";
												}		
		//-----------------------------------------------------------------------------------------								
											}elseif($SRSD_DataCRow["RST_on"]==3){
		//-----------------------------------------------------------------------------------------
		//RsSubjectCount
											$RsSubjectCountASql="SELECT `RSC_count` AS `Count_ASD` 
																 FROM `rssubject_count` 
																 WHERE `RSD_no`='{$SRSD_DataCRow['RSD_no']}' AND `RSD_year`='{$this->ASS_year}'";
												if($RsSubjectCountARs=$pdo_summer->query($RsSubjectCountASql)){
													$RsSubjectCountARow=$RsSubjectCountARs->Fetch(PDO::FETCH_ASSOC);
													if(is_array($RsSubjectCountARow) && count($RsSubjectCountARow)){
														$Count_ASDA=$RsSubjectCountARow["Count_ASD"];
														$Count_ASDA=$Count_ASDA+1;
													}else{
														$Count_ASDA=0;
														$Count_ASDA=$Count_ASDA+1;
													}
												}else{
													$Count_ASDA=0;
												}
		//RsSubjectCountEnd							
		//-----------------------------------------------------------------------------------------						
												try{
													$Up_RSCC="UPDATE `rssubject_count` SET `RSC_count`='{$Count_ASDA}' WHERE `RSD_year`='{$this->ASS_year}' AND `RSD_no`='{$SRSD_DataCRow["RSD_no"]}'";
													$pdo_summer->exec($Up_RSCC);
													$ASS_Error="yes";
												}catch(PDOException $e){
													$ASS_Error="no";
												}		
		//-----------------------------------------------------------------------------------------	
											}else{}
										}							
		//-----------------------------------------------------------------------------------------	
		//-----------------------------------------------------------------------------------------								
									}
		//-----------------------------------------------------------------------------------------					
							}elseif($ASS_Error=="no"){
								$DeleteSummer=new Delete_Summer($this->ASS_sudid,$this->ASS_year);
							}else{}
		//updata rssubject_count							
//----------------------------------------------------------------------------------						
					}
				}else{
					$ASS_Error="no";
				}

			if(isset($ASS_Error)){
				$this->ASS_Error=$ASS_Error;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}
		}function RunAddSudSummer(){
			if(isset($this->ASS_Error)){
				return $this->ASS_Error;
			}else{}
		}
	}
?>

<?php
	class StatusPaySummer{  //สถานะการจ่ายค่าsummer
		public $SPS_Key,$SPS_Year;
		function __construct($SPS_Key,$SPS_Year){
			$this->SPS_Key=$SPS_Key;
			$this->SPS_Year=$SPS_Year;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$StatusPaySummerSql="SELECT `rs_money_data`.`RMT_no`,`rs_money_data`.`RMT_year`,`rs_money_data`.`rs_key`,`rs_money_data`.`RMD_on`,`rs_money_data`.`RMT_data`,`rs_money_status`.`RMD_txt`
								 FROM   `rs_money_data` LEFT JOIN `rs_money_status` on(`rs_money_data`.`RMD_on`=`rs_money_status`.`RMD_on`) 
								 WHERE  `rs_money_data`.`RMT_year`='{$this->SPS_Year}' AND  `rs_money_data`.`rs_key`='{$this->SPS_Key}'";
				if($StatusPaySummerRs=$pdo_summer->query($StatusPaySummerSql)){
					$StatusPaySummerRow=$StatusPaySummerRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($StatusPaySummerRow) && count($StatusPaySummerRow)){
							$SPS_RMT_no=$StatusPaySummerRow["RMT_no"];
							$SPS_RMT_year=$StatusPaySummerRow["RMT_year"];
							$SPS_rs_key=$StatusPaySummerRow["rs_key"];
							$SPS_RMD_on=$StatusPaySummerRow["RMD_on"];
							$SPS_RMT_data=$StatusPaySummerRow["RMT_data"];
							$SPS_RMD_txt=$StatusPaySummerRow["RMD_txt"];
						}else{
							$SPS_RMT_no=null;
							$SPS_RMT_year=null;
							$SPS_rs_key=null;
							$SPS_RMD_on=0;
							$SPS_RMT_data=null;
							$SPS_RMD_txt=null;							
						}
				}else{
					$SPS_RMT_no=null;
					$SPS_RMT_year=null;
					$SPS_rs_key=null;
					$SPS_RMD_on=0;
					$SPS_RMT_data=null;
					$SPS_RMD_txt=null;
				}
				if(isset($SPS_rs_key,$SPS_RMT_year)){
					$this->SPS_RMT_no=$SPS_RMT_no;
					$this->SPS_RMT_year=$SPS_RMT_year;
					$this->SPS_rs_key=$SPS_rs_key;
					$this->SPS_RMD_on=$SPS_RMD_on;
					$this->SPS_RMT_data=$SPS_RMT_data;
					$this->SPS_RMD_txt=$SPS_RMD_txt;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
		}function __destruct(){
			if(isset($this->SPS_rs_key,$this->SPS_RMT_year)){
				$this->SPS_RMT_no;
				$this->SPS_RMT_year;
				$this->SPS_rs_key;
				$this->SPS_RMD_on;
				$this->SPS_RMT_data;
				$this->SPS_RMD_txt;				
			}else{}
		}
	}
?>


<?php
	class DataRsSubjectPrice{
		public $SRSP_No,$SRSP_Year;
		public $RSP_price;
		function __construct($SRSP_No,$SRSP_Year){
			$this->SRSP_No=$SRSP_No;
			$this->SRSP_Year=$SRSP_Year;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$DataRsSubjectPriceSql="SELECT `RSP_price` 
								    FROM `rssubject_price` 
									WHERE `RSP_no`='{$this->SRSP_No}' AND `RSP_year`='{$this->SRSP_Year}'";
				if($DataRsSubjectPriceRs=$pdo_summer->query($DataRsSubjectPriceSql)){
					$DataRsSubjectPriceRow=$DataRsSubjectPriceRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($DataRsSubjectPriceRow) && count($DataRsSubjectPriceRow)){
							$RSP_price=$DataRsSubjectPriceRow["RSP_price"];
						}else{
							$RSP_price=0.00;
						}
				}else{
					$RSP_price=0.00;
				}
				if(isset($RSP_price)){
					$this->RSP_price=$RSP_price;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
		}function RunDataRsSubjectPrice(){
			if(isset($this->RSP_price)){
				return $this->RSP_price;
			}else{}
		}
	}
?>



<?php
	class ShowRsSubjectData{
		public $SRSD_Year,$SRSD_Class;
		public $SRDArray;
		function __construct($SRSD_Year,$SRSD_Class){
			$this->SRSD_Year=$SRSD_Year;
			$this->SRSD_Class=$SRSD_Class;
//----------------------------------------------------------------------------------
			$SRDArray=array();
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$SRDA_sql="SELECT `RSD_no`, `RSD_txtTh`, `RSD_txtEn`, `RSD_class`,`RSD_Plan`, `RSD_year`, `RST_on` 
					   FROM `rssubject_data` 
					   WHERE `RSD_year`='{$this->SRSD_Year}' AND `RSD_class`='{$this->SRSD_Class}'
					   ORDER BY `rssubject_data`.`RSD_no` ASC";
				if($SRDA_rs=$pdo_summer->query($SRDA_sql)){
					while($SRDA_row=$SRDA_rs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($SRDA_row) && count($SRDA_row)){
							$SRDArray[]=$SRDA_row;
						}else{
							$SRDArray=null;
						}
					}
				}else{
					$SRDArray=null;
				}
				if(isset($SRDArray)){
					$this->SRDArray=$SRDArray;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
		}function RunShowRsSubjectData(){
			if(isset($this->SRDArray)){
				return $this->SRDArray;
			}else{}
		}
	}
?>

<?php
	class ShowRsSubjectDataPlan{
		public $SRSD_Year,$SRSD_Class,$SRSD_Plan;
		public $SRDArray;
		function __construct($SRSD_Year,$SRSD_Class,$SRSD_Plan){
			$this->SRSD_Year=$SRSD_Year;
			$this->SRSD_Class=$SRSD_Class;
			$this->SRSD_Plan=$SRSD_Plan;
//----------------------------------------------------------------------------------
			$SRDArray=array();
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$SRDA_sql="SELECT `RSD_no`, `RSD_txtTh`, `RSD_txtEn`, `RSD_class`,`RSD_Plan`, `RSD_year`, `RST_on` 
					   FROM `rssubject_data` 
					   WHERE `RSD_year`='{$this->SRSD_Year}' AND `RSD_class`='{$this->SRSD_Class}' AND `RSD_Plan`='{$this->SRSD_Plan}'
					   ORDER BY `rssubject_data`.`RSD_no` ASC";
				if($SRDA_rs=$pdo_summer->query($SRDA_sql)){
					while($SRDA_row=$SRDA_rs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($SRDA_row) && count($SRDA_row)){
							$SRDArray[]=$SRDA_row;
						}else{
							$SRDArray=null;
						}
					}
				}else{
					$SRDArray=null;
				}
				if(isset($SRDArray)){
					$this->SRDArray=$SRDArray;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
		}function RunShowRsSubjectData(){
			if(isset($this->SRDArray)){
				return $this->SRDArray;
			}else{}
		}
	}
?>


<?php
	class SetClassSummer{
		public $SCS_Class;
		public $SCS_Set;
		function __construct($SCS_Class){
			$this->SCS_Class=$SCS_Class;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------			
			$SetClassSummerSql="SELECT `sss_set` 
						        FROM `set_system_summer` 
								WHERE `sss_class`='{$this->SCS_Class}'";
				if($SetClassSummerRs=$pdo_summer->query($SetClassSummerSql)){
					$SetClassSummerRow=$SetClassSummerRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($SetClassSummerRow) && count($SetClassSummerRow)){
							$SCS_Set=$SetClassSummerRow["sss_set"];
						}else{
							$SCS_Set=null;
						}
				}else{
					$SCS_Set=null;
				}
			
			if(isset($SCS_Set)){
				$this->SCS_Set=$SCS_Set;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}

		}function RunSetClassSummer(){
			if(isset($this->SCS_Set)){
				return $this->SCS_Set;
			}else{}
		}
	}
?>

<?php
	class DataSumSummer{
		public $DSS_year;
		public $B_paying,$A_paying;
		function __construct($DSS_year){
//----------------------------------------------------------------------------------	
			$this->DSS_year=$DSS_year;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------	
//Paying Summer
			try{
				$sum_payingSql="select `rs_money_data`.`RMT_no`,`rs_money_data`.`rs_key`,`rs_money_status`.`RMD_txt`
						   from `rs_money_data` left join `rs_money_status` 
						   on(`rs_money_data`.`RMD_on`=`rs_money_status`.`RMD_on`) 
						   where `rs_money_data`.`RMT_year`='{$this->DSS_year}';";
					if($sum_payingRs=$pdo_summer->query($sum_payingSql)){
						$sum_pay=0;
						while($sum_payingRow=$sum_payingRs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($sum_payingRow) && count($sum_payingRow)){
								
								$SummerData=new PrintSummerData($sum_payingRow["rs_key"],$this->DSS_year); 
								foreach($SummerData->RunPrintSummerData() as $rc=>$SummerDataRow){
									$sum_pay=$sum_pay+$SummerDataRow["RSP_price"];
								}
								
							}else{
								$sum_pay=0;
							}							
						}
					}else{
						$sum_pay=0;
					}
			}catch(PDOException $cs){
				$sum_pay=0;
			}
//Paying Summer	
//Pay y/n
			$count_paying=array();
			try{
				$count_paySql="select count(`rs_money_data`.`RMT_no`) as `count_pay`,`rs_money_status`.`RMD_txt`
							   from `rs_money_data` left join `rs_money_status` 
							   on(`rs_money_data`.`RMD_on`=`rs_money_status`.`RMD_on`) 
							   where `rs_money_data`.`RMT_year`='{$this->DSS_year}' 
							   group by `rs_money_status`.`RMD_on`;";
					if($count_payRs=$pdo_summer->query($count_paySql)){
						while($count_payRow=$count_payRs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($count_payRow) && count($count_payRow)){
								$count_paying[]=$count_payRow;
							}else{
								$count_paying=null;
							}
						}
					}else{
						$count_paying=null;
					}
			}catch(PDOException $cs){
				$count_paying=null;
			}
//Pay y/n end
//Data for paying A
			$A_paying=array();
			try{
				$A_paySql="select `rs_money_data`.`RMT_no`,`rs_money_data`.`rs_key`,`rs_money_status`.`RMD_txt`
						   from `rs_money_data` left join `rs_money_status` 
						   on(`rs_money_data`.`RMD_on`=`rs_money_status`.`RMD_on`) 
						   where `rs_money_data`.`RMT_year`='{$this->DSS_year}' 
						   and `rs_money_data`.`RMD_on`='1';";
					if($A_payRs=$pdo_summer->query($A_paySql)){
						while($A_payRow=$A_payRs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($A_payRow) && count($A_payRow)){
								$A_paying[]=$A_payRow;
							}else{
								$A_paying=null;
							}
						}
					}else{
						$A_paying=null;
					}
			}catch(PDOException $cs){
				$A_paying=null;
			}
//Data for paying A End
//Data for paying B
			$B_paying=array();
			try{
				$B_paySql="select `rs_money_data`.`RMT_no`,`rs_money_data`.`rs_key`,`rs_money_status`.`RMD_txt`
						   from `rs_money_data` left join `rs_money_status` 
						   on(`rs_money_data`.`RMD_on`=`rs_money_status`.`RMD_on`) 
						   where `rs_money_data`.`RMT_year`='{$this->DSS_year}' 
						   and `rs_money_data`.`RMD_on`='2';";
					if($B_payRs=$pdo_summer->query($B_paySql)){
						while($B_payRow=$B_payRs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($B_payRow) && count($B_payRow)){
								$B_paying[]=$B_payRow;
							}else{
								$B_paying=null;
							}
						}
					}else{
						$B_paying=null;
					}
			}catch(PDOException $cs){
				$B_paying=null;
			}
//Data for paying A End
			if(isset($sum_pay)){
				$this->sum_pay=$sum_pay;
			}else{}
				if(isset($count_paying)){
					$this->count_paying=$count_paying;
				}else{}
					if(isset($A_paying)){
						$this->A_paying=$A_paying;
					}else{}
						if(isset($B_paying)){
							$this->B_paying=$B_paying;
						}else{}
		}
			function Runsum_pay(){
				if(isset($this->sum_pay)){
					return $this->sum_pay;
				}else{}
			}	
				function Runcount_paying(){
					if(isset($this->count_paying)){//array
						return $this->count_paying;
					}else{}
				}
					function RunA_paying(){
						if(isset($this->A_paying)){//array
							return $this->A_paying;
						}else{}
					}
						function RunB_paying(){
							if(isset($this->B_paying)){//array
								return $this->B_paying;
							}else{}
						}
	}

?>

<?php
	class IntoDeleteRcSummerFirst{
		public $IDRSF_Key,$IDRSF_year,$IDRSF_class,$IDRSF_type;
		public $ErrorRcSummerFirst;
		function __construct($IDRSF_Key,$IDRSF_year,$IDRSF_class,$IDRSF_type){
			$this->IDRSF_Key=$IDRSF_Key;
			$this->IDRSF_year=$IDRSF_year;
			$this->IDRSF_class=$IDRSF_class;
			$this->IDRSF_type=$IDRSF_type;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$rsf_datatime=date("Y-m-d H:i:s");
//----------------------------------------------------------------------------------
				switch($this->IDRSF_type){
					case "Into";
//----------------------------------------------------------------------------------
						$UpdatePaySummer=new UpdatePaySummer($this->IDRSF_Key,$this->IDRSF_class,$this->IDRSF_year);
						$ErrorRcSummerFirst=$UpdatePaySummer->RunUpdatePaySummer();
//----------------------------------------------------------------------------------
					break;
					case "Delete";

						try{
							$UpMoneySql="UPDATE `rs_money_data` SET `RMT_data`='{$rsf_datatime}',`RMD_on`='1' WHERE `rs_key`='{$this->IDRSF_Key}' AND `RMT_year`='{$this->IDRSF_year}'";
							$pdo_summer->exec($UpMoneySql);
//-----------------------------------------------------------------------------							
							try{
								$DeleteRcSummerFirstSql="DELETE FROM `rc_summer_first` WHERE `rsf_key`='{$this->IDRSF_Key}' AND `rsf_year`='{$this->IDRSF_year}' ";
								$pdo_summer->exec($DeleteRcSummerFirstSql);
								$ErrorRcSummerFirst="Y";
							}catch(PDOException $e){
								try{
									$UpMoneySql="UPDATE `rs_money_data` SET `RMT_data`='{$rsf_datatime}',`RMD_on`='2' WHERE `rs_key`='{$this->IDRSF_Key}' AND `RMT_year`='{$this->IDRSF_year}'";
									$pdo_summer->exec($UpMoneySql);	
									$ErrorRcSummerFirst="N";									
								}catch(PDOException $e){
									$ErrorRcSummerFirst="N";
								}
							}			
//-----------------------------------------------------------------------------							
						}catch(PDOException $e){
							$ErrorRcSummerFirst="N";
						}
					break;
					default:
						$ErrorRcSummerFirst="N";
				}	
			if(isset($ErrorRcSummerFirst)){
				$this->ErrorRcSummerFirst=$ErrorRcSummerFirst;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}	
		}function CallIntoDeleteRcSummerFirst(){
			if(isset($this->ErrorRcSummerFirst)){
				return $this->ErrorRcSummerFirst;
			}else{}
		}
	}
?>
<?php
	class PrintRcSummerFirst{//ข้อมุลผู้ชำระเงินค่า Summer
		public $PRSF_year;
		public $ArrayRcSummerFirst;
		function __construct($PRSF_year){
			$this->PRSF_year=$PRSF_year;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$ArrayRcSummerFirst=array();
//----------------------------------------------------------------------------------			
			$RcSummerFirstqsl="SELECT `rsf_key`, `rsf_year`, `rsf_class`, `rsf_datatime` 
							   FROM `rc_summer_first` 
							   WHERE `rsf_year`='{$this->PRSF_year}'";
				if($RcSummerFirstRs=$pdo_summer->query($RcSummerFirstqsl)){
					while($RcSummerFirstRow=$RcSummerFirstRs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($RcSummerFirstRow) && count($RcSummerFirstRow)){
							$ArrayRcSummerFirst[]=$RcSummerFirstRow;
						}else{
							$ArrayRcSummerFirst=null;
						}
					}
				}else{
					$ArrayRcSummerFirst=null;
				}
			if(isset($ArrayRcSummerFirst)){
				$this->ArrayRcSummerFirst=$ArrayRcSummerFirst;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}
		}function RunPrintRcSummerFirst(){
			if(isset($this->ArrayRcSummerFirst)){
				return $this->ArrayRcSummerFirst;
			}else{}
		}
	}

?>


<?php 
	class SudSummer{//ข้อมูลนักเรียนที่เรียนทั้งหมด สำหรับวิชาการ
		public $SSA_Class,$SSA_Year;
		public $SudSummerArray;
		function __construct($SSA_Class,$SSA_Year){
//----------------------------------------------------------------------------------
			$this->SSA_Class=$SSA_Class;
			$this->SSA_Year=$SSA_Year;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$SudSummerArray=array();
//----------------------------------------------------------------------------------
				try{
					$SudSummerAcademicSql="select distinct `summer_test`.`st_KeyStu` as `rs_key` ,`rssubject_data`.`RSD_class` as `rs_class` ,`rssubject_data`.`RSD_year` as `rs_year` 
					                       from `summer_test` join `summer_keep_score` on (`summer_test`.`st_KeyStu`=`summer_keep_score`.`st_KeyStu`) 
										   join `rssubject_data` on(`summer_keep_score`.`SKS_Subject`=`rssubject_data`.`RSD_no`) 
										   where `summer_test`.`st_Year`='{$this->SSA_Year}' 
										   and `summer_test`.`st_Term`='1' 
										   and `summer_keep_score`.`SKS_Term`='1' 
										   and `summer_keep_score`.`SKS_Year`='{$this->SSA_Year}' 
										   and `rssubject_data`.`RSD_class`='{$this->SSA_Class}' 
										   and `rssubject_data`.`RSD_year`='{$this->SSA_Year}' 
										   ORDER BY `rs_key` ASC";
						if($SudSummerAcademicRs=$pdo_summer->query($SudSummerAcademicSql)){
							while($SudSummerAcademicRow=$SudSummerAcademicRs->Fetch(PDO::FETCH_ASSOC)){
								if(is_array($SudSummerAcademicRow) && count($SudSummerAcademicRow)){
									$SudSummerArray[]=$SudSummerAcademicRow;
								}else{
									$SudSummerArray=null;
								}
							}
						}else{
							$SudSummerArray=null;
						}
				}catch(PDOException $ssa){
					$SudSummerArray=null;
				}
				if(isset($SudSummerArray)){
					$this->SudSummerArray=$SudSummerArray;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
		}function RunSudSummer(){
			if(isset($this->SudSummerArray)){
				return $this->SudSummerArray;
			}else{}
		}
		
	}

?>


<?php
	Class SudSummerB{//ข้อมูลนักเรียนที่เรียนทั้งหมด
		public $SS_Class,$SS_year;
		public $SudSummerArray;
		function __construct($SS_Class,$SS_year){
//----------------------------------------------------------------------------------
			$this->SS_Class=$SS_Class;
			$this->SS_year=$SS_year;
//----------------------------------------------------------------------------------	
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$SudSummerArray=array();
//----------------------------------------------------------------------------------
				try{
					$SudSummerSql="SELECT `rs_class`, `rs_data`, `rs_key`, `rs_year` 
					               FROM `rs_student` 
								   WHERE `rs_class`='{$this->SS_Class}' AND `rs_year`='{$this->SS_year}'";
						if($SudSummerRs=$pdo_summer->query($SudSummerSql)){
							while($SudSummerRow=$SudSummerRs->Fetch(PDO::FETCH_ASSOC)){
								if(is_array($SudSummerRow) && count($SudSummerRow)){
									$SudSummerArray[]=$SudSummerRow;
								}else{
									$SudSummerArray=null;
								}
							}
						}else{
							$SudSummerArray=null;
						}
				}catch(PDOException $ss){
					$SudSummerArray=null;
				}
				if(isset($SudSummerArray)){
					$this->SudSummerArray=$SudSummerArray;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
		}function RunSudSummer(){
			if(isset($this->SudSummerArray)){
				return $this->SudSummerArray;
			}else{}
		}
	}
?>


<?php
	class InformationSummerStudent{
		public $ISS_Key,$ISS_RMDNO;
		public $ISSArray;
		function __construct($ISS_Key,$ISS_RMDNO){
//----------------------------------------------------------------------------------
			$this->ISS_Key=$ISS_Key;
			//$this->ISS_Year=$ISS_Year;
			$this->ISS_RMDNO=$ISS_RMDNO;

//----------------------------------------------------------------------------------	
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------		
			$datatime=date("Y-m-d H:i:s");
			$ISSArray=array();
//----------------------------------------------------------------------------------
				if($this->ISS_RMDNO=="full"){
					$InformationSumStu_Sql="select `rssubject_data`.`RSD_year`,`rssubject_data`.`RSD_no`,`rssubject_data`.`RSD_txtTh`,`rssubject_data`.`RSD_txtEn`,`rssubject_data`.`RSD_class`,`rssubject_data`.`RSD_Plan` from `money_pay_summer` left join `rssubject_data` on (`money_pay_summer`.`RSP_no`=`rssubject_data`.`RSD_no`) 
									        where `money_pay_summer`.`rs_key`='{$this->ISS_Key}' 
											ORDER BY `rssubject_data`.`RSD_no` ASC ;";
						if($InformationSumStu_Rs=$pdo_summer->query($InformationSumStu_Sql)){
							while($InformationSumStu_Row=$InformationSumStu_Rs->Fetch(PDO::FETCH_ASSOC)){
								if(is_array($InformationSumStu_Row) && count($InformationSumStu_Row)){
									$ISSArray[]=$InformationSumStu_Row;
								}else{
									$ISSArray=null;
								}
							}
						}else{
							$ISSArray=null;
						}
				}else{
					$InformationSumStu_Sql="select `rssubject_data`.`RSD_year`,`rssubject_data`.`RSD_no`,`rssubject_data`.`RSD_txtTh`,`rssubject_data`.`RSD_txtEn`,`rssubject_data`.`RSD_class`,`rssubject_data`.`RSD_Plan` from `money_pay_summer` left join `rssubject_data` on (`money_pay_summer`.`RSP_no`=`rssubject_data`.`RSD_no`) 
									        where `money_pay_summer`.`rs_key`='{$this->ISS_Key}' 
											and `rssubject_data`.`RST_on`='{$this->ISS_RMDNO}'
											ORDER BY `rssubject_data`.`RSD_no` ASC ;";
						if($InformationSumStu_Rs=$pdo_summer->query($InformationSumStu_Sql)){
							while($InformationSumStu_Row=$InformationSumStu_Rs->Fetch(PDO::FETCH_ASSOC)){
								if(is_array($InformationSumStu_Row) && count($InformationSumStu_Row)){
									$ISSArray[]=$InformationSumStu_Row;
								}else{
									$ISSArray=null;
								}
							}
						}else{
							$ISSArray=null;
						}					
				}
				
				if(isset($ISSArray)){
					$this->ISSArray=$ISSArray;
					$pdo_summer=null;
				}else{
					$pdo_summer=null;
				}
		}function RunInformationSummerStudent(){
			if(isset($this->ISSArray)){
				return $this->ISSArray;
			}else{}
		}
	}
?>


<?php
	class UpdatePaySummer{
		public $UPS_key,$UPS_class,$UPS_year;
		public $ErrorUpdatePaySummer;
		function __construct($UPS_key,$UPS_class,$UPS_year){
//----------------------------------------------------------------------------------	
			$this->UPS_key=$UPS_key;
			$this->UPS_class=$UPS_class;
			$this->UPS_year=$UPS_year;
//----------------------------------------------------------------------------------			
			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();
//----------------------------------------------------------------------------------
			$datatime=date("Y-m-d H:i:s");
//----------------------------------------------------------------------------------	

//***
			try{
				$TestMoneyDataSql="SELECT COUNT(`rs_key`) AS `IntMD` 
								   FROM `rs_money_data` 
								   WHERE `rs_key`='{$this->UPS_key}' 
								   AND `RMT_year`='{$this->UPS_year}'";
				if($TestMoneyDataRs=$pdo_summer->query($TestMoneyDataSql)){
					$TestMoneyDataRow=$TestMoneyDataRs->Fetch(PDO::FETCH_ASSOC);
					if(is_array($TestMoneyDataRow) && count($TestMoneyDataRow)){
						$IntMD=$TestMoneyDataRow["IntMD"];
					}else{
						$IntMD=0;
					}
				}else{
					$IntMD=0;
				}
			}catch(PDOException $cs){
				$IntMD=0;
			}
//***
			if($IntMD>=1){
//-----------------------------------------------------------------------------				
				try{
					$DeleteRcSummerFirstSql="DELETE FROM `rc_summer_first` WHERE `rsf_key`='{$this->UPS_key}' AND `rsf_year`='{$this->UPS_year}' ";
					$pdo_summer->exec($DeleteRcSummerFirstSql);
					$ErrorUpdatePaySummer="Y";
				}catch(PDOException $e){
					$ErrorUpdatePaySummer="N";
				}
//-----------------------------------------------------------------------------	
				try{
					$IntoRcSummerFirstSql="INSERT INTO `rc_summer_first`(`rsf_key`, `rsf_year`, `rsf_class`, `rsf_datatime`) VALUES ('{$this->UPS_key}','{$this->UPS_year}','{$this->UPS_class}','{$datatime}')";
					$pdo_summer->exec($IntoRcSummerFirstSql);
					$ErrorUpdatePaySummer="Y";
				}catch(PDOException $e){
					$ErrorUpdatePaySummer="N";
				}			
//-----------------------------------------------------------------------------				
					if($ErrorUpdatePaySummer=="Y"){
						try{
							$UpMoneySql="UPDATE `rs_money_data` SET `RMT_data`='{$datatime}',`RMD_on`='2' WHERE `rs_key`='{$this->UPS_key}' AND `RMT_year`='{$this->UPS_year}'";
							$pdo_summer->exec($UpMoneySql);
							$ErrorUpdatePaySummer="Y";
						}catch(PDOException $e){
//-----------------------------------------------------------------------------							
							try{
								$DeleteRcSummerFirstSql="DELETE FROM `rc_summer_first` WHERE `rsf_key`='{$this->UPS_key}' AND `rsf_year`='{$this->UPS_year}' ";
								$pdo_summer->exec($DeleteRcSummerFirstSql);
								$ErrorUpdatePaySummer="N";
							}catch(PDOException $e){
								$ErrorUpdatePaySummer="N";
							}	
//-----------------------------------------------------------------------------							
						}
					}else{
						$ErrorUpdatePaySummer="N";
					}
			}else{
//-----------------------------------------------------------------------------				
				try{
					$DeleteRcSummerFirstSql="DELETE FROM `rc_summer_first` WHERE `rsf_key`='{$this->UPS_key}' AND `rsf_year`='{$this->UPS_year}' ";
					$pdo_summer->exec($DeleteRcSummerFirstSql);
					$ErrorUpdatePaySummer="Y";
				}catch(PDOException $e){
					$ErrorUpdatePaySummer="N";
				}
//-----------------------------------------------------------------------------	
				try{
					$IntoRcSummerFirstSql="INSERT INTO `rc_summer_first`(`rsf_key`, `rsf_year`, `rsf_class`, `rsf_datatime`) VALUES ('{$this->UPS_key}','{$this->UPS_year}','{$this->UPS_class}','{$datatime}')";
					$pdo_summer->exec($IntoRcSummerFirstSql);
					$ErrorUpdatePaySummer="Y";
				}catch(PDOException $e){
					$ErrorUpdatePaySummer="N";
				}			
//-----------------------------------------------------------------------------				
			}
			if(isset($ErrorUpdatePaySummer)){
				$this->ErrorUpdatePaySummer=$ErrorUpdatePaySummer;
				$pdo_summer=null;
			}else{
				$pdo_summer=null;
			}
		}function RunUpdatePaySummer(){
			if(isset($this->ErrorUpdatePaySummer)){
				return $this->ErrorUpdatePaySummer;
			}else{}
		}
	}
?>


<?php
	class KeepSummerQuota{
		public $KSQ_No,$KSQ_year;
		public $Int_Quota,$KSQ_System,$rq_no;
		function __construct($KSQ_No,$KSQ_year){

			$this->KSQ_No=$KSQ_No;
			$this->KSQ_year=$KSQ_year;

			$KSQ_System="ON";

			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();

			try{
				$KeepSummerQuotaSql="SELECT `rssubject_quota`.`rq_keep` AS `Int_Quota`,`rssubject_quota`.`rq_no` 
								     FROM `rssubject_quota` 
									 LEFT JOIN `rssubject_quota_list` 
									 ON (`rssubject_quota`.`rq_no`=`rssubject_quota_list`.`rq_id`) 
									 WHERE `rssubject_quota_list`.`rql_id`='{$this->KSQ_No}' 
									 AND `rssubject_quota_list`.`rq_year`='{$this->KSQ_year}' 
									 AND `rssubject_quota`.`rq_year`='{$this->KSQ_year}';";
					if(($KeepSummerQuotaRs=$pdo_summer->query($KeepSummerQuotaSql))){
						$KeepSummerQuotaRow=$KeepSummerQuotaRs->Fetch(PDO::FETCH_ASSOC);
							if((is_array($KeepSummerQuotaRow) and count($KeepSummerQuotaRow))){
								$Int_Quota=$KeepSummerQuotaRow["Int_Quota"];
								$rq_no=$KeepSummerQuotaRow["rq_no"];
								$KSQ_System="YES";
							}else{
								$Int_Quota=null;
								$rq_no=null;
								$KSQ_System="ON";
							}
					}else{
						$Int_Quota=null;
						$rq_no=null;
						$KSQ_System="ON";
					}
			}catch(PDOException $e){
				$Int_Quota=null;
				$rq_no=null;
				$KSQ_System="ON";
			}

			$pdo_summer=null;
			$this->Int_Quota=$Int_Quota;
			$this->rq_no=$rq_no;
			$this->KSQ_System=$KSQ_System;

		}function set_int_quota(){
			return $this->Int_Quota;
		}function set_id_quota(){
			return $this->rq_no;
		}function set_error_quota(){
			return $this->KSQ_System;
		}
	}

?>


<?php
	class Sum_Quota_Summer{
		public $TQS_ID,$TQS_Year;
		public $sum_summer_test;
		function __construct($TQS_ID,$TQS_Year){
			$this->TQS_ID=$TQS_ID;
			$this->TQS_Year=$TQS_Year;

			$db_summerID=$_SERVER['REMOTE_ADDR'];
			$connpdo_summer=new connected_summer($db_summerID);
			$pdo_summer=$connpdo_summer->run_connto_summer();

			$sum_summer_test=0;

			try{
				$Data_SummerSql="SELECT `rql_id`
								 FROM `rssubject_quota_list` 
								 WHERE`rq_id`='{$this->TQS_ID}' 
								 AND `rq_year`='{$this->TQS_Year}';";
						
					if(($Data_SummerRs=$pdo_summer->query($Data_SummerSql))){
						while($Data_SummerRow=$Data_SummerRs->Fetch(PDO::FETCH_ASSOC)){
							if((is_array($Data_SummerRow) and count($Data_SummerRow))){
								$summer_id=$Data_SummerRow["rql_id"];

								$int_summer_test=new CountMoneyPaySummer($summer_id,$this->TQS_Year);
								$copy_int_summer=$int_summer_test->RunCountSummer();

									if(isset($copy_int_summer)){
										$sum_summer_test=$sum_summer_test+$copy_int_summer;
									}else{
										$sum_summer_test=null;
									}

							}else{
								$sum_summer_test=null;
							}
						}
					}else{
						$sum_summer_test=null;
					}
			}catch(PDOException $e){
				$sum_summer_test=null;
			}

			$pdo_summer=null;

			$this->sum_summer_test=$sum_summer_test;

		}function PrintSumSummer(){
			return $this->sum_summer_test;
		}
	}

?>