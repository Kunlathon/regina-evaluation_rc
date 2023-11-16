<?php
	class year_eduyeardata{
		function __construct(){
			$eduyeardata_array=array();
			$LangActivitiesID=$_SERVER["REMOTE_ADDR"];
			$Connpdo_LangActivities=new Connection_MISRC($LangActivitiesID);
			$PDO_LangActivities=$Connpdo_LangActivities->Call_Connection_MISRC();
			$eduyeardataSql="SELECT * FROM `eduyeardata` WHERE 1";
				if($eduyeardataRs=$PDO_LangActivities->query($eduyeardataSql)){
					while($eduyeardataRow=$eduyeardataRs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($eduyeardataRow) && count($eduyeardataRow)){
							$eduyeardata_array[]=$eduyeardataRow;
						}else{
							$eduyeardata_array[]=null;
						}
					}
				}else{
					$eduyeardata_array[]=null;
				}
			if(isset($eduyeardata_array)){
				$this->eduyeardata_array=$eduyeardata_array;
			}else{
				//------------------------------------------
			}
			$PDO_LangActivities=Null;
		}public function Print_DataeDuyeardata(){
			if(isset($this->eduyeardata_array)){
				return $this->eduyeardata_array;
			}else{
				//-------------------------------------------
			}
		}
	}
?>


<?php
	class RcSumLangActivities{
		public $IDSubject;
		public $IDStudent;
		public $Term;
		public $Year;
		function __construct($IDSubject,$IDStudent,$Term,$Year){
			$this->IDSubject=$IDSubject;
			$this->IDStudent=$IDStudent;
			$this->Term=$Term;
			$this->Year=$Year;
			$LangActivitiesID=$_SERVER["REMOTE_ADDR"];
			$Connpdo_LangActivities=new Connection_MISRC($LangActivitiesID);
			$PDO_LangActivities=$Connpdo_LangActivities->Call_Connection_MISRC();
			$RSLA_sql="select `rc_student_re_act_$this->Year`.`ach_skill1`,`rc_student_re_act_$this->Year`.`ach_skill2`,`rc_student_re_act_$this->Year`.`ach_skill3`
					   ,`rc_student_re_act_$this->Year`.`ach_skill4`,`rc_student_re_act_$this->Year`.`ach_skill5`,`rc_student_re_act_$this->Year`.`ach_skill6`
					   from `rc_register_$this->Year` join `rc_student_re_act_$this->Year` on(`rc_register_$this->Year`.`IDStudent`=`rc_student_re_act_$this->Year`.`IDStudent`)
					   where `rc_register_$this->Year`.`IDSubject`='{$this->IDSubject}'
                       and `rc_register_$this->Year`.`IDStudent`='{$this->IDStudent}'
                       and `rc_student_re_act_$this->Year`.`IDStudent`='{$this->IDStudent}'
                       and `rc_student_re_act_$this->Year`.`Term`='{$this->Term}'";
				if($RSLA_rs=$PDO_LangActivities->query($RSLA_sql)){
					$RSLA_row=$RSLA_rs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($RSLA_row) && count($RSLA_row)){
							$ach_skill1=$RSLA_row["ach_skill1"];
							$ach_skill2=$RSLA_row["ach_skill2"];
							$ach_skill3=$RSLA_row["ach_skill3"];
							$ach_skill4=$RSLA_row["ach_skill4"];
							$ach_skill5=$RSLA_row["ach_skill5"];
							$ach_skill6=$RSLA_row["ach_skill6"];
							$sum_skill=$ach_skill1+$ach_skill2+$ach_skill3+$ach_skill4+$ach_skill5+$ach_skill6;
								if($sum_skill>=80 and $sum_skill<=100){
									$grade_skill=4;
								}elseif($sum_skill>=75 and $sum_skill<=79){
									$grade_skill=3.5;
								}elseif($sum_skill>=70 and $sum_skill<=74){
									$grade_skill=3;
								}elseif($sum_skill>=65 and $sum_skill<=69){
									$grade_skill=2.5;
								}elseif($sum_skill>=60 and $sum_skill<=64){
									$grade_skill=2;
								}elseif($sum_skill>=55 and $sum_skill<=59){
									$grade_skill=1.5;
								}elseif($sum_skill>=50 and $sum_skill<=54){
									$grade_skill=1;
								}elseif($sum_skill>=0 and $sum_skill<=49){
									$grade_skill=0;
								}else{
									$grade_skill=Null;
								}
						}else{
							$ach_skill1=null;
							$ach_skill2=null;
							$ach_skill3=null;
							$ach_skill4=null;
							$ach_skill5=null;
							$ach_skill6=null;
							$sum_skill=null;
							$grade_skill=null;
						}
				}else{
					$ach_skill1=null;
					$ach_skill2=null;
					$ach_skill3=null;
					$ach_skill4=null;
					$ach_skill5=null;
					$ach_skill6=null;
					$sum_skill=null;
					$grade_skill=null;
				}
			$this->ach_skill1=$ach_skill1;
			$this->ach_skill2=$ach_skill2;
			$this->ach_skill3=$ach_skill3;
			$this->ach_skill4=$ach_skill4;
			$this->ach_skill5=$ach_skill5;
			$this->ach_skill6=$ach_skill6;
			$this->sum_skill=$sum_skill;
			$this->grade_skill=$grade_skill;
			$PDO_LangActivities=null;
		}function __destruct(){
			$this->ach_skill1;
			$this->ach_skill2;
			$this->ach_skill3;
			$this->ach_skill4;
			$this->ach_skill5;
			$this->ach_skill6;
			$this->sum_skill;
			$this->grade_skill;	
		}
	}	
?>

<?php
	class Subject_LangActivities{
		public $sla_lang;
		public $sla_class;
		public $sla_term;
		public $sla_year;
		public $sla_subject;
		function __construct($sla_lang,$sla_class,$sla_term,$sla_year,$sla_subject){
			$LangActivities_array=array();
			$this->sla_lang=$sla_lang;
			$this->sla_class=$sla_class;
			$this->sla_term=$sla_term;
			$this->sla_year=$sla_year;
			$this->sla_subject=$sla_subject;
			$LangActivitiesID=$_SERVER["REMOTE_ADDR"];
			$Connpdo_LangActivities=new Connection_MISRC($LangActivitiesID);
			$PDO_LangActivities=$Connpdo_LangActivities->Call_Connection_MISRC();		
			$LangActivitiesSql="SELECT `IDSubject`,`Name` AS `Subjectname` 
							    FROM `rc_subject_$this->sla_year` 
								WHERE `LangActivities`='{$this->sla_lang}' 
								and `IDLevel`='{$this->sla_class}' 
								and `Type`='{$this->sla_year}'
								and `IDSubject`='{$this->sla_subject}'";
				if($LangActivitiesRs=$PDO_LangActivities->query($LangActivitiesSql)){
					while($LangActivitiesRow=$LangActivitiesRs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($LangActivitiesRow) && count($LangActivitiesRow)){
							$LangActivities_array[]=$LangActivitiesRow;							
						}else{
							$LangActivities_array[]=null;
						}
					}
				}else{
					$LangActivities_array[]=null;
				}
				
				if(isset($LangActivities_array)){
					$this->LangActivities_array=$LangActivities_array;
				}else{
					//------------------------------------------------
				}
			$PDO_LangActivities=Null;
		}public function Print_LangActivities(){
			if(isset($this->LangActivities_array)){
				return $this->LangActivities_array;
			}else{
				//----------------------------------------------------
			}
		}
	}
?>