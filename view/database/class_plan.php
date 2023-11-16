<?php
//pdo_data
	class PlanClass{
		public $PC_Y,$PC_T,$PC_C;
		public $PlanClass_Print;
		function __construct($PC_Y,$PC_T,$PC_C){
			$this->PC_Y=$PC_Y;
			$this->PC_T=$PC_T;
			$this->PC_C=$PC_C;
			$PlanClass_Print=array();
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_evaluation->call_pdodata();		
//-----------------------------------------------
//db regina_stu_class		
				try{
					$RSC_Sql="select distinct `rsc_plan` from `regina_stu_class` 
					          where `rsc_year`='{$this->PC_Y}' 
							  and `rsc_class`='{$this->PC_C}' 
							  and `rsc_term`='{$this->PC_T}';";
						if(($RSC_Rs=$pdo_eveluation->query($RSC_Sql))){
							while($RSC_Row=$RSC_Rs->Fetch(PDO::FETCH_ASSOC)){
								if((is_array($RSC_Row) && count($RSC_Row))){	
//db rc_plan									
							try{
								$RP_Sql="select `IDPlan`,`Name` as `PlanNameSmall`,`LName` as `PlanName` 
										 from `rc_plan` where `IDPlan`='{$RSC_Row['rsc_plan']}';";
									if(($RP_Rs=$pdo_eveluation->query($RP_Sql))){
										$RP_Row=$RP_Rs->Fetch(PDO::FETCH_ASSOC);
											if((is_array($RP_Row) && count($RP_Row))){
												$PlanClass_Print[]=$RP_Row;
											}else{
												$PlanClass_Print[]="-";
											}
										
									}else{
										$PlanClass_Print[]="-";								
									}
							}catch(PDOException $e){
								$PlanClass_Print[]="-";						
							}
//db rc_plan end				
								}else{
									$PlanClass_Print[]="-";
								}								
							}
						}else{
							$PlanClass_Print[]="-";
						}
				}catch(PDOException $e){
					$PlanClass_Print[]="-";
				}
//db regina_stu_class End
//-----------------------------------------------	
				$this->PlanClass_Print=$PlanClass_Print;
				$pdo_eveluation=null;
		}function RunPlanClass(){
			return $this->PlanClass_Print;
		}
	}
?>