<?php
	class CountSudSupplementary{//นับจำนวนนักเรียนลงเรียนรายวิชา/กิจกรรมนั้นๆในแต่ละวัน
		public $CSS_Class,$CSS_Year,$CSS_ID,$CSS_Day,$CSS_T;
		public $IntSudSupp;
		function __construct($CSS_Class,$CSS_Year,$CSS_ID,$CSS_Day,$CSS_T){
			$this->CSS_Class=$CSS_Class;
			$this->CSS_Year=$CSS_Year;
			$this->CSS_ID=$CSS_ID;
			//$this->CSS_Day=$CSS_Day; pyte int*****
			$this->CSS_T=$CSS_T;
			$TxtDay=array("`ss_mon`","`ss_tues`","`ss_wedne`","`ss_thurs`","`ss_fri`","`ss_satur`","`ss_sun`");
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_evaluation->call_pdodata();
				$CountSudSupplementarySql="select count(`sup_stuid`) as `IntSudSupp` 
										   from `supplementary_sturs` 
										   where `sup_t`='{$this->CSS_T}' 
										   and `sup_l`='{$this->CSS_Class}' 
										   and `sup_year`='{$this->CSS_Year}' 
										   and `ss_id`='{$this->CSS_ID}' 
										   and $TxtDay[$CSS_Day]='1';";
					if($CountSudSupplementaryRs=$pdo_eveluation->query($CountSudSupplementarySql)){
						$CountSudSupplementaryRow=$CountSudSupplementaryRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($CountSudSupplementaryRow) && count($CountSudSupplementaryRow)){
							$IntSudSupp=$CountSudSupplementaryRow["IntSudSupp"];
						}else{
							$IntSudSupp=0;
						}
					}else{
						$IntSudSupp=0;
					}
			if(isset($IntSudSupp)){
				$this->IntSudSupp=$IntSudSupp;
				$pdo_eveluation=null;
			}else{
				$pdo_eveluation=null;
			}
		}function ShowIntSudSupplementary(){
			if(isset($this->IntSudSupp)){
				return $this->IntSudSupp;
			}else{}
		}
	}
?>
<?php
class print_teacher_rc{
	public $key_rc;
	function __construct($key_rc){
		$this->key_rc=$key_rc;
		$db_evaluationID=$_SERVER['REMOTE_ADDR'];
		$connpdo_evaluation=new count_pdodata($db_evaluationID);
		$pdo_eveluation=$connpdo_evaluation->call_pdodata();
				$teacher_sql="SELECT `IDTeacher`,`IDPrefix`,`FName`,`SName`,`IDPrefix_en`,`FName_en`,`SName_en` FROM `rc_person` WHERE `IDTeacher`='{$this->key_rc}'";
				if($teacher_rs=$pdo_eveluation->query($teacher_sql)){
					 $teacher_row=$teacher_rs->Fetch(PDO::FETCH_ASSOC);
					 	if(is_array($teacher_row) && count($teacher_row)){
//------------------------------------------------------------------------------
							$npTh_sql="SELECT `prefixname` FROM `rc_prefix` WHERE `IDPrefix`='{$teacher_row["IDPrefix"]}'";
								if($npTh_rs=$pdo_eveluation->query($npTh_sql)){
									 $npTh_row=$npTh_rs->Fetch(PDO::FETCH_ASSOC);
									 	if(is_array($npTh_row) && count($npTh_row)){
											$prefixTh=$npTh_row["prefixname"];
										}else{
											$prefixTh=null;
										}
								}else{
										$prefixTh=null;
								}
//------------------------------------------------------------------------------
							$npEn_sql="SELECT `prefixname` FROM `rc_prefix` WHERE `IDPrefix`='{$teacher_row["IDPrefix_en"]}'";
								if($npEn_rs=$pdo_eveluation->query($npEn_sql)){
									 $npEn_row=$npEn_rs->Fetch(PDO::FETCH_ASSOC);
									 	if(is_array($npEn_row) && count($npEn_row)){
											$prefixEh=$npEn_row["prefixname"];
										}else{
											$prefixEh=null;
										}
								}else{
										$prefixEh=null;
								}
//------------------------------------------------------------------------------

							$mynameTh=$prefixTh."&nbsp;".$teacher_row["FName"]."&nbsp;".$teacher_row["SName"];
							$mynameEn=$prefixEh."&nbsp;".$teacher_row["FName_en"]."&nbsp;".$teacher_row["SName_en"];
							$rc_key=$teacher_row["IDTeacher"];
							
						}else{
							$mynameTh=null;
							$mynameEn=null;
							$rc_key=null;
						}
				}else{
					$mynameTh=null;
					$mynameEn=null;
					$rc_key=null;
				}
				if(isset($mynameTh)){
					$this->mynameTh=$mynameTh;
					$this->mynameEn=$mynameEn;
					$this->rc_key=$rc_key;
				}else{
					//--------------------------------------------------------------------
				}
		$pdo_eveluation=null;
	}public function teacherRC_nameTh(){
		if(isset($this->mynameTh)){
			return $this->mynameTh;
		}else{
			//------------------------------------------------------------------------
		}
	}public function teacherRC_nameEn(){
		if(isset($this->mynameEn)){
			return $this->mynameEn;
		}else{
			//------------------------------------------------------------------------
		}
	}public function teacherRC_key(){
		if(isset($this->rc_key)){
			return $this->rc_key;
		}else{
			//------------------------------------------------------------------------
		}
	}
}


class date_activity{
	public $txt_level;
	public $txt_plan;
	function __construct($txt_level,$txt_plan){
		$this->txt_level=$txt_level;
		$this->txt_plan=$txt_plan;

		$db_evaluationID=$_SERVER['REMOTE_ADDR'];
		$connpdo_eveluation=new count_pdodata($db_evaluationID);
		$pdo_eveluation=$connpdo_eveluation->call_pdodata();

		$date_activitySql="SELECT `activity_mon`,`activity_tue`,`activity_wed`,`activity_thu`,`activity_frl`,`activity_sat`,`activity_sun`
						   FROM `supplementary_registration` WHERE `sr_level`='{$this->txt_level}' and `sr_plan`='{$this->txt_plan}';";
		if ($date_activityRs=$pdo_eveluation->query($date_activitySql)){
			$date_activityRow=$date_activityRs->Fetch(PDO::FETCH_ASSOC);
			
			$day_activity_mon=$date_activityRow["activity_mon"];
			$day_activity_tue=$date_activityRow["activity_tue"];
			$day_activity_wed=$date_activityRow["activity_wed"];
			$day_activity_thu=$date_activityRow["activity_thu"];
			$day_activity_frl=$date_activityRow["activity_frl"];
			$day_activity_sat=$date_activityRow["activity_sat"];
			$day_activity_sun=$date_activityRow["activity_sun"];

			$count_activityON=0;

				if($day_activity_mon=="ON"){
					$count_activityON=$count_activityON+1;
				}else{
					//----------------------
				}

				if($day_activity_tue=="ON"){
					$count_activityON=$count_activityON+1;
				}else{
					//----------------------
				}

				if($day_activity_wed=="ON"){
					$count_activityON=$count_activityON+1;
				}else{
					//----------------------
				}

				if($day_activity_thu=="ON"){
					$count_activityON=$count_activityON+1;
				}else{
					//----------------------
				}

				if($day_activity_frl=="ON"){
					$count_activityON=$count_activityON+1;
				}else{
					//----------------------
				}

				if($day_activity_sat=="ON"){
					$count_activityON=$count_activityON+1;
				}else{
					//----------------------
				}

				if($day_activity_sun=="ON"){
					$count_activityON=$count_activityON+1;
				}else{
					//----------------------
				}

		}else{
			$day_activity_mon=Null;
			$day_activity_tue=Null;
			$day_activity_wed=Null;
			$day_activity_thu=Null;
			$day_activity_frl=Null;
			$day_activity_sat=Null;
			$day_activity_sun=Null;
			$count_activityON=0;
		}
		$pdo_eveluation=Null;
		$this->day_activity_mon=$day_activity_mon;
		$this->day_activity_tue=$day_activity_tue;
		$this->day_activity_wed=$day_activity_wed;
		$this->day_activity_thu=$day_activity_thu;
		$this->day_activity_frl=$day_activity_frl;
		$this->day_activity_sat=$day_activity_sat;
		$this->day_activity_sun=$day_activity_sun;
		$this->count_activityON=$count_activityON;
	}function __destruct(){
		$this->day_activity_mon;
		$this->day_activity_tue;
		$this->day_activity_wed;
		$this->day_activity_thu;
		$this->day_activity_frl;
		$this->day_activity_sat;
		$this->day_activity_sun;
		$this->count_activityON;
	}
}



class supplementary_sturs{
	public $stu_key;
	function __construct($stu_key,$sup_t,$sup_l,$sup_year){
		$this->stu_key=$stu_key;
		$this->sup_t=$sup_t;
		$this->sup_l=$sup_l;
		$this->sup_year=$sup_year;

		$db_evaluationID=$_SERVER['REMOTE_ADDR'];
		$connpdo_eveluation=new count_pdodata($db_evaluationID);
		$pdo_eveluation=$connpdo_eveluation->call_pdodata();

		$array_sturs=array();

		$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_txtth`
								 from `supplementary_subject`
								 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
								 where `supplementary_sturs`.`sup_stuid`='{$this->stu_key}'
								 and `supplementary_sturs`.`sup_t`='{$this->sup_t}'
								 and `supplementary_sturs`.`sup_l`='{$this->sup_l}'
								 and `supplementary_sturs`.`sup_year`='{$this->sup_year}'
                                 and `supplementary_subject`.`ss_t`='{$this->sup_t}'
                                 and `supplementary_subject`.`ss_l`='{$this->sup_l}'
                                 and `supplementary_subject`.`ss_year`='{$this->sup_year}'";
		if($supplementary_stursRs=$pdo_eveluation->query($supplementary_stursSql)){
			while($supplementary_stursRow=$supplementary_stursRs->Fetch(PDO::FETCH_ASSOC)){
				$array_sturs[]=$supplementary_stursRow;
			}
		}else{
				$array_sturs=Null;
		}
		$pdo_eveluation=Null;
		$this->array_sturs=$array_sturs;
	}function __destruct(){
		$this->array_sturs;
	}
}



//print_plan->pdo
	class print_plan{
		public $plan;
		function __construct($plan){
			$this->plan=$plan;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();

			$plan_sql="SELECT `Name`,`LName` FROM `rc_plan` WHERE `IDPlan`='{$this->plan}'";
			if($plan_rs=$pdo_eveluation->query($plan_sql)){
				$plan_row=$plan_rs->Fetch(PDO::FETCH_ASSOC);
				$plan_Name=$plan_row["Name"];
				$plan_LName=$plan_row["LName"];
			}else{
				$plan_Name="";
				$plan_LName="";
			}
			$pdo_eveluation=Null;
			$this->plan_Name=$plan_Name;
			$this->plan_LName=$plan_LName;
		}
		function __destruct(){
			$this->plan_Name;
			$this->plan_LName;
		}
	}

//print_prefix->pdo
	class print_prefix{
		public $prefix;
		function __construct($prefix){
			$this->prefix=$prefix;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();

			$prefix_sql="SELECT `prefixname`,`prefix_SName`,`prefix_EName`,`prefixname` FROM `rc_prefix` WHERE `IDPrefix`='{$this->prefix}'";
			if($prefix_rs=$pdo_eveluation->query($prefix_sql)){
				$prefix_row=$prefix_rs->Fetch(PDO::FETCH_ASSOC);
				$prefix_prefixname=$prefix_row["prefixname"];
				$prefix_prefix_SName=$prefix_row["prefix_SName"];
				$prefix_prefixname=$prefix_row["prefixname"];
				$prefix_prefix_EName=$prefix_row["prefix_EName"];
			}else{
				$prefix_prefixname="";
				$prefix_prefix_SName="";
				$prefix_prefix_EName="";
				$prefix_prefixname="";
			}
			$pdo_eveluation=Null;
			$this->prefix_prefixname=$prefix_prefixname;
			$this->prefix_prefix_SName=$prefix_prefix_SName;
			$this->prefix_prefix_EName=$prefix_prefix_EName;
			$this->prefix_prefixname=$prefix_prefixname;
		}
		function __destruct(){
			$this->prefix_prefixname;
			$this->prefix_prefix_SName;
			$this->prefix_prefix_EName;
			$this->prefix_prefixname;
		}
	}

//data_sturoom->pdo
	class data_sturoom{
		public $sr_t;
		public $sr_y;
		public $sr_l;
		public $sr_r;
		function __construct($sr_t,$sr_y,$sr_l,$sr_r){
			$this->sr_t=$sr_t;
			$this->sr_y=$sr_y;
			$this->sr_l=$sr_l;
			$this->sr_r=$sr_r;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();

			$printdata_sturoom=array();
			$sturoom_sql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`regina_stu_data`.`rsd_prefix` ,`regina_stu_data`.`rsd_name`
						,`regina_stu_data`.`rsd_surname`,`regina_stu_data`.`rsd_nameEn`,`regina_stu_data`.`rsd_surnameEn` ,`regina_stu_class`.`rsc_year`
						,`regina_stu_class`.`rsc_term`,`regina_stu_class`.`rsc_plan`,`regina_stu_class`.`rsc_class` ,`regina_stu_class`.`rsc_room`
						,`regina_stu_class`.`rsc_num` from `regina_stu_class` join `regina_stu_data` on(`regina_stu_class`.`rsd_studentid`=`regina_stu_data`.`rsd_studentid`)
						where `regina_stu_class`.`rsc_term`='{$this->sr_t}'
						and `regina_stu_class`.`rsc_year`='{$this->sr_y}'
						and `regina_stu_class`.`rsc_class`='{$this->sr_l}'
						and `regina_stu_class`.`rsc_room`='{$this->sr_r}'
						ORDER BY `regina_stu_class`.`rsc_num` ASC";
			if($sturoom_rs=$pdo_eveluation->query($sturoom_sql)){
				while($sturoom_row=$sturoom_rs->Fetch(PDO::FETCH_ASSOC)){
					$printdata_sturoom[]=$sturoom_row;
				}
			}else{

			}
			$pdo_eveluation=Null;
			$this->printdata_sturoom=$printdata_sturoom;
		}
		function __destruct(){
			$this->printdata_sturoom;
		}
	}

	class print_level{
		public $level_id;
		function __construct($level_id){

			$this->level_id=$level_id;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();

			$level_sql="SELECT * FROM `rc_level` WHERE `IDLevel` = '{$this->level_id}'";
								if($level_rs=$pdo_evaluation->query($level_sql)){
					$level_row=$level_rs->Fetch(PDO::FETCH_ASSOC);				
					if(is_array($level_row) && count($level_row)){
						$set_IDLevel=$level_row["IDLevel"];
						$set_PLevel=$level_row["PLevel"];
						$set_Sort_name=$level_row["Sort_name"];
						$set_Sort_name_E=$level_row["Sort_name_E"];
						$set_Sort_name_E2=$level_row["Sort_name_E2"];
						$set_Lname=$level_row["Lname"];					
					}else{
						$set_IDLevel=null;
						$set_PLevel=null;
						$set_Sort_name=null;
						$set_Sort_name_E=null;
						$set_Sort_name_E2=null;
						$set_Lname=null;					
					}
				}else{
					$set_IDLevel=null;
					$set_PLevel=null;
					$set_Sort_name=null;
					$set_Sort_name_E=null;
					$set_Sort_name_E2=null;
					$set_Lname=null;
				}
				if(isset($this->set_IDLevel)){
					$this->set_IDLevel=$set_IDLevel;
					$this->set_PLevel=$set_PLevel;
					$this->set_Sort_name=$set_Sort_name;
					$this->set_Sort_name_E=$set_Sort_name_E;
					$this->set_Sort_name_E2=$set_Sort_name_E2;
					$this->set_Lname=$set_Lname;					
				}else{
					$this->set_IDLevel=$set_IDLevel;
					$this->set_PLevel=$set_PLevel;
					$this->set_Sort_name=$set_Sort_name;
					$this->set_Sort_name_E=$set_Sort_name_E;
					$this->set_Sort_name_E2=$set_Sort_name_E2;
					$this->set_Lname=$set_Lname;					
					
				}
			$pdo_evaluation=Null;
		}function __destruct(){
			if(isset($this->set_IDLevel)){
				$this->set_IDLevel;
				$this->set_PLevel;
				$this->set_Sort_name;
				$this->set_Sort_name_E;
				$this->set_Sort_name_E2;
				$this->set_Lname;				
			}else{
				//--------------------------------------------
			}
		}
	}


//regina_stu_data
	class regina_stu_data2{
		public $stu_id;
		public $stu_year;
		public $stu_term;
		public $stu_class;

		function __construct($stu_id,$stu_year,$stu_term,$stu_class){
			$this->stu_id=$stu_id;
			$this->stu_year=$stu_year;
			$this->stu_term=$stu_term;
			$this->stu_class=$stu_class;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();

			$regina_stu_dataSql="SELECT  `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`regina_stu_data`.`rsd_prefix`,`regina_stu_data`.`rsd_name`,`regina_stu_data`.`rsd_surname`
						       ,`regina_stu_data`.`rsd_nameEn`,`regina_stu_data`.`rsd_surnameEn`,`regina_stu_data`.`nickTh`,`regina_stu_data`.`nickEn`, `regina_stu_data`.`rse_student_status`
                               ,`regina_stu_data`.`rse_studentimg`,`regina_stu_data`.`rse_home`,`regina_stu_class`.`rsc_year`,`regina_stu_class`.`rsc_term`,`regina_stu_class`.`rsc_plan`
                               ,`regina_stu_class`.`rsc_class`,`regina_stu_class`.`rsc_room`,`regina_stu_class`.`rsc_num`,`rc_prefix`.`prefixname`,`rc_prefix`.`prefix_SName`,`rc_level`.`Sort_name`,`rc_level`.`Lname`
                                 FROM `regina_stu_data` join `regina_stu_class` on(`regina_stu_data`.`rsd_studentid`=`regina_stu_class`.`rsd_studentid`)
                                 join `rc_prefix` on(`regina_stu_data`.`rsd_prefix`=`rc_prefix`.`IDPrefix`)
                                 join `rc_level`  on(`regina_stu_class`.`rsc_class`=`rc_level`.`IDLevel`)
                                 WHERE `regina_stu_data`.`rsd_studentid`='{$this->stu_id}'
                                 and `regina_stu_class`.`rsc_year`='{$this->stu_year}'
                                 and `regina_stu_class`.`rsc_term`='{$this->stu_term}'
                                 and `regina_stu_class`.`rsc_class`='{$this->stu_class}';";
			if($regina_stu_dataRs=$pdo_evaluation->query($regina_stu_dataSql)){
				$regina_stu_dataRow=$regina_stu_dataRs->Fetch(PDO::FETCH_ASSOC);
				$rsd_studentid=$regina_stu_dataRow["rsd_studentid"];
				$rsd_Identification=$regina_stu_dataRow["rsd_Identification"];
				$sd_prefix=$regina_stu_dataRow["rsd_prefix"];
				$rsd_name=$regina_stu_dataRow["rsd_name"];
				$rsd_surname=$regina_stu_dataRow["rsd_surname"];
				$Sort_name=$regina_stu_dataRow["Sort_name"];
				$rsc_num=$regina_stu_dataRow["rsc_num"];
				$rsc_room=$regina_stu_dataRow["rsc_room"];
				
				$rsc_term=$regina_stu_dataRow["rsc_term"];
				$rsc_year=$regina_stu_dataRow["rsc_year"];
				$rsc_plan=$regina_stu_dataRow["rsc_plan"];

			}else{
				$rsd_studentid=null;
				$rsd_Identification=null;
				$sd_prefix=null;
				$rsd_name=null;
				$rsd_surname=null;
				$rsc_num=null;
				$rsc_room=null;
				$Sort_name=null;
				$rsc_term=null;
				$rsc_year=null;
				$rsc_plan=null;
			}
			$this->rsd_studentid=$rsd_studentid;
			$this->rsd_Identification=$rsd_Identification;
			$this->sd_prefix=$sd_prefix;
			$this->rsd_name=$rsd_name;
			$this->rsd_surname=$rsd_surname;
			$this->rsc_num=$rsc_num;
			$this->rsc_room=$rsc_room;
			$this->Sort_name=$Sort_name;
			$this->rsc_term=$rsc_term;
			$this->rsc_year=$rsc_year;
			$this->rsc_plan=$rsc_plan;
			
			
			$pdo_evaluation=Null;
		}function __destruct(){
			$this->rsd_studentid;
			$this->rsd_Identification;
			$this->sd_prefix;
			$this->rsd_name;
			$this->rsd_surname;
			$this->rsc_num;
			$this->rsc_room;
			$this->Sort_name;
			$this->rsc_term;
			$this->rsc_year;
			$this->rsc_plan;			
		}
	}



//regina_stu_data
	class regina_stu_data{
		public $stu_id;

		function __construct($stu_id){
			$this->stu_id=$stu_id;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();

			$regina_stu_dataSql="SELECT `rsd_studentid`, `rsd_Identification`, `rsd_prefix`, `rsd_name`, `rsd_surname`, `rsd_nameEn`, `rsd_surnameEn`,  `rse_student_status`, `rse_studentimg`, `rse_home`
								 FROM `regina_stu_data` WHERE`rsd_studentid`='{$this->stu_id}'";
			if($regina_stu_dataRs=$pdo_evaluation->query($regina_stu_dataSql)){
				$regina_stu_dataRow=$regina_stu_dataRs->Fetch(PDO::FETCH_ASSOC);
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
			$this->rsd_studentid=$rsd_studentid;
			$this->rsd_Identification=$rsd_Identification;
			$this->sd_prefix=$sd_prefix;
			$this->rsd_name=$rsd_name;
			$this->rsd_surname=$rsd_surname;
			$pdo_evaluation=Null;
		}function __destruct(){
			$this->rsd_studentid;
			$this->rsd_Identification;
			$this->sd_prefix;
			$this->rsd_name;
			$this->rsd_surname;
		}
	}




//supplementary_subject
	class supplementary_subject{
		public $txt_ss_t;
		public $txt_ss_l;
		public $txt_ss_year;

		function __construct($txt_ss_t,$txt_ss_l,$txt_ss_year){
			$this->txt_ss_t=$txt_ss_t;
			$this->txt_ss_l=$txt_ss_l;
			$this->txt_ss_year=$txt_ss_year;
			$subjectarray=array();

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();

			$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc`
									   FROM `supplementary_subject`
									   WHERE `ss_t`='{$this->txt_ss_t}'
									   AND `ss_l`='{$this->txt_ss_l}'
									   AND `ss_year`='{$this->txt_ss_year}'";
			if($supplementary_subjectRs=$pdo_evaluation->query($supplementary_subjectSql)){
				while($supplementary_subjectRow=$supplementary_subjectRs->Fetch(PDO::FETCH_ASSOC)){
					$subjectarray[]=$supplementary_subjectRow;
				}
			}else{

			}
			$this->subjectarray=$subjectarray;
			$pdo_evaluation=Null;
		}function __destruct(){
			$this->subjectarray;
		}
	}



//insert_evaluation
	class insert_evaluation{
		public $evaluation_sql;
		function __construct($evaluation_sql){
			$this->evaluation_sql=$evaluation_sql;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();

			$sql=$this->evaluation_sql;
			if($pdo_evaluation->exec($sql)>0){
				$system_insert="yes";
			}else{
				$system_insert="no";
			}
			unset($pdo_evaluation);
			$this->system_insert=$system_insert;
		}
		function __destruct(){
			$this->system_insert;
		}

	}

//supplementary_daysubject
	class supplementary_daysubject{
		public $supplementary_ssid;

		function __construct($supplementary_ssid){
			$this->supplementary_ssid=$supplementary_ssid;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();


			$supple_daysubjectSql="SELECT *
			                       FROM `supplementary_daysubject` WHERE`ss_id`='{$this->supplementary_ssid}'";
			if($supple_daysubjectRs=$pdo_evaluation->query($supple_daysubjectSql)){
				$supple_daysubjectRow=$supple_daysubjectRs->Fetch(PDO::FETCH_ASSOC);
				$sds_key=$supple_daysubjectRow["sds_key"];
				$sds_mon=$supple_daysubjectRow["sd_mon"];
				$sds_tue=$supple_daysubjectRow["sd_tue"];
				$sds_wed=$supple_daysubjectRow["sd_wed"];
				$sds_thu=$supple_daysubjectRow["sd_thu"];
				$sds_frl=$supple_daysubjectRow["sd_frl"];
				$sds_sat=$supple_daysubjectRow["sd_sat"];
				$sds_sun=$supple_daysubjectRow["sd_sun"];
				$sss_id=$supple_daysubjectRow["ss_id"];
			}else{
				$sds_key="";
				$sds_mon="";
				$sds_tue="";
				$sds_wed="";
				$sds_thu="";
				$sds_frl="";
				$sds_sat="";
				$sds_sun="";
				$sss_id="";
			}
			$this->sds_key=$sds_key;
			$this->sds_mon=$sds_mon;
			$this->sds_tue=$sds_tue;
			$this->sds_wed=$sds_wed;
			$this->sds_thu=$sds_thu;
			$this->sds_frl=$sds_frl;
			$this->sds_sat=$sds_sat;
			$this->sds_sun=$sds_sun;
			$this->sss_id=$sss_id;
			$pdo_evaluation=Null;
		}function __destruct(){
			$this->sds_key;
			$this->sds_mon;
			$this->sds_tue;
			$this->sds_wed;
			$this->sds_thu;
			$this->sds_frl;
			$this->sds_sat;
			$this->sds_sun;
			$this->sss_id;
		}

	}



//print_supplementary_day
	class supplementary_day{

		function __construct(){
			//$supple_arrayday=array();
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();


			$supplementary_daySql="SELECT `sd_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` FROM `supplementary_day`";
			if($supplementary_dayRs=$pdo_evaluation->query($supplementary_daySql)){
				$supplementary_dayRow=$supplementary_dayRs->Fetch(PDO::FETCH_ASSOC);
				$sd_key=$supplementary_dayRow["sd_key"];
				$sd_mon=$supplementary_dayRow["sd_mon"];
				$sd_tue=$supplementary_dayRow["sd_tue"];
				$sd_wed=$supplementary_dayRow["sd_wed"];
				$sd_thu=$supplementary_dayRow["sd_thu"];
				$sd_frl=$supplementary_dayRow["sd_frl"];
				$sd_sat=$supplementary_dayRow["sd_sat"];
				$sd_sun=$supplementary_dayRow["sd_sun"];
			}else{
				$sd_key="";
				$sd_mon="";
				$sd_tue="";
				$sd_wed="";
				$sd_thu="";
				$sd_frl="";
				$sd_sat="";
				$sd_sun="";
			}
				$this->sd_key=$sd_key;
				$this->sd_mon=$sd_mon;
				$this->sd_tue=$sd_tue;
				$this->sd_wed=$sd_wed;
				$this->sd_thu=$sd_thu;
				$this->sd_frl=$sd_frl;
				$this->sd_sat=$sd_sat;
				$this->sd_sun=$sd_sun;
				$pdo_evaluation=Null;
		}function __destruct(){
			$this->sd_key;
			$this->sd_mon;
			$this->sd_tue;
			$this->sd_wed;
			$this->sd_thu;
			$this->sd_frl;
			$this->sd_sat;
			$this->sd_sun;
		}
	}



//stu_level

	class stu_levelpdo{
		public $stu_id,$stu_year,$stu_term;
		function __construct($stu_id,$stu_year,$stu_term){
			$this->stu_id=$stu_id;
			$this->stu_year=$stu_year;
			$this->stu_term=$stu_term;
			
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();
			
			try{
				$stu_levelSql="select `regina_stu_class`.`rsd_studentid`,`rc_level`.`IDLevel`,`rc_level`.`Sort_name`,`rc_level`.`Lname`,`rc_level`.`Sort_name_E2`
						     ,`rc_plan`.`Name`as `planname`,`regina_stu_class`.`rsc_room`,`regina_stu_class`.`rsc_num`,`regina_stu_class`.`rsc_plan`
						       from `regina_stu_class` join `rc_level` on(`rc_level`.`IDLevel`=`regina_stu_class`.`rsc_class`)
						       join `rc_plan` on(`regina_stu_class`.`rsc_plan`=`rc_plan`.`IDPlan`)
						       where `regina_stu_class`.`rsc_year`='{$this->stu_year}'
						       and `regina_stu_class`.`rsc_term`='{$this->stu_term}'
						       and `regina_stu_class`.`rsd_studentid`='{$this->stu_id}'";
				if($stu_levelRs=$pdo_evaluation->query($stu_levelSql)){
					$stu_leveRow=$stu_levelRs->Fetch(PDO::FETCH_ASSOC);
					if((is_array($stu_leveRow) && count($stu_leveRow))){
						$rsd_studentid=$stu_leveRow["rsd_studentid"];
						$IDLevel=$stu_leveRow["IDLevel"];
						$Sort_name_E2=$stu_leveRow["Sort_name_E2"];
						$Sort_name=$stu_leveRow["Sort_name"];
						$Lname=$stu_leveRow["Lname"];
						$planname=$stu_leveRow["planname"];
						$rsc_room=$stu_leveRow["rsc_room"];
						$rsc_num=$stu_leveRow["rsc_num"];
						$rc_plan=$stu_leveRow["rsc_plan"];						
					}else{
						$rsd_studentid="-";
						$IDLevel="-";
						$Sort_name_E2="-";
						$Sort_name="-";
						$Lname="-";
						$planname="-";
						$rsc_room="-";
						$rsc_num="-";
						$rc_plan="-";
					}
				}else{
					$rsd_studentid="-";
					$IDLevel="-";
					$Sort_name_E2="-";
					$Sort_name="-";
					$Lname="-";
					$planname="-";
					$rsc_room="-";
					$rsc_num="-";
					$rc_plan="-";					
				}			   
			}catch(PDOException $e){
				$rsd_studentid="-";
				$IDLevel="-";
				$Sort_name_E2="-";
				$Sort_name="-";
				$Lname="-";
				$planname="-";
				$rsc_room="-";
				$rsc_num="-";
				$rc_plan="-";				
			}
			
			if(isset($rsd_studentid)){
					$this->rsd_studentid=$rsd_studentid;
					$this->IDLevel=$IDLevel;
					$this->Sort_name_E2=$Sort_name_E2;
					$this->Sort_name=$Sort_name;
					$this->Lname=$Lname;
					$this->planname=$planname;
					$this->rsc_room=$rsc_room;
					$this->rsc_num=$rsc_num;
					$this->rc_plan=$rc_plan;
					$pdo_evaluation=null;
			}else{
					$pdo_evaluation=null;
			}
			
		}function __destruct(){
			if(isset($this->rsd_studentid)){
				$this->rsd_studentid;
				$this->IDLevel;
				$this->Sort_name_E2;
				$this->Sort_name;
				$this->Lname;
				$this->planname;
				$this->rsc_room;
				$this->rsc_num;
				$this->rc_plan;				
			}else{}
		}
	}







//rc_advisor
	class rc_advisor{
		public $txt_YearEdu;
		public $txt_IDLevel;
		public $txt_Room;
		function __construct($txt_YearEdu,$txt_IDLevel,$txt_Room){
			$this->txt_YearEdu=$txt_YearEdu;
			$this->txt_IDLevel=$txt_IDLevel;
			$this->txt_Room=$txt_Room;
			$advisor_array=array();

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();


			$advisor_sql="select `rc_person`.`IDTeacher`,`rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName` ,`rc_level`.`IDLevel`
						  from `rc_advisor`
						  join `rc_level` on (`rc_advisor`.`IDLevel`=`rc_level`.`IDLevel`)
						  join `rc_person` on (`rc_person`.`IDTeacher`=`rc_advisor`.`IDPerson`)
						  join `rc_prefix` on (`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`)
						  where `rc_advisor`.`YearEdu`='{$this->txt_YearEdu}'
						  and `rc_advisor`.`IDLevel`='{$this->txt_IDLevel}'
						  and `rc_advisor`.`Room`='{$this->txt_Room}'
						  ORDER BY `rc_advisor`.`Status` DESC";

			if($advisor_rs=$pdo_evaluation->query($advisor_sql)){
				while($advisor_row=$advisor_rs->Fetch(PDO::FETCH_ASSOC)){
					$advisor_array[]=$advisor_row;
				}
			}else{

			}
			$pdo_evaluation=Null;
			$this->advisor_array=$advisor_array;
		}function __destruct(){
			$this->advisor_array;
		}
	}


			class supplementary_registration{
				public $txt_sr_level;
				public $txt_sr_plan;
				function __construct($txt_sr_level,$txt_sr_plan)
				{
					$this->txt_sr_level=$txt_sr_level;
					$this->txt_sr_plan=$txt_sr_plan;

					$db_evaluationID=$_SERVER['REMOTE_ADDR'];
					$connpdo_evaluation=new count_pdodata($db_evaluationID);
					$pdo_evaluation=$connpdo_evaluation->call_pdodata();

					$registration_sql="SELECT `sr_key`, `sr_level`, `sr_academic`, `sr_activity`
									   FROM `supplementary_registration`
									   WHERE `sr_level`='{$this->txt_sr_level}'
									   AND `sr_plan`='{$this->txt_sr_plan}'";
						if($registration_rs=$pdo_evaluation->query($registration_sql)){
							$registration_row=$registration_rs->Fetch(PDO::FETCH_ASSOC);
							$sr_academic=$registration_row["sr_academic"];
							$sr_activity=$registration_row["sr_activity"];

						}else{
							$sr_academic=Null;
							$sr_activity=Null;
						}
							$pdo_evaluation=Null;
							$this->sr_academic=$sr_academic;
							$this->sr_activity=$sr_activity;

				}function __destruct(){
					$this->sr_academic;
					$this->sr_activity;
				}
			}


			class notrow_evaluation{
			public $txt_evaluation;
			function __construct($txt_evaluation){
				$this->txt_evaluation=$txt_evaluation;
				$evaluation_array=array();

				$db_evaluationID=$_SERVER['REMOTE_ADDR'];
				$connpdo_evaluation=new count_pdodata($db_evaluationID);
				$pdo_evaluation=$connpdo_evaluation->call_pdodata();

				$evaluation_sql=$this->txt_evaluation;
					if($evaluation_rs=$pdo_evaluation->query($evaluation_sql)){
						$evaluation_row=$evaluation_rs->Fetch(PDO::FETCH_ASSOC);
						$evaluation_array[]=$evaluation_row;
					}else{
						$evaluation_array[]=null;
					}
						$pdo_evaluation=Null;
						$this->evaluation_array=$evaluation_array;
				}function __destruct(){
					$this->evaluation_array;
			}
		}

		class row_evaluation{
			public $txt_evaluation;
			function __construct($txt_evaluation){
				$this->txt_evaluation=$txt_evaluation;
				$evaluation_array=array();

				$db_evaluationID=$_SERVER['REMOTE_ADDR'];
				$connpdo_evaluation=new count_pdodata($db_evaluationID);
				$pdo_evaluation=$connpdo_evaluation->call_pdodata();

				$evaluation_sql=$this->txt_evaluation;
					if($evaluation_rs=$pdo_evaluation->query($evaluation_sql)){
						while($evaluation_row=$evaluation_rs->Fetch(PDO::FETCH_ASSOC)){
							$evaluation_array[]=$evaluation_row;
						}
					}else{
						$evaluation_array[]=null;
					}
						$pdo_evaluation=Null;
						$this->evaluation_array=$evaluation_array;
				}function __destruct(){
					$this->evaluation_array;
			}
		}
?>
