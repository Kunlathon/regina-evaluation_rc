<?php
//include("database_evaluation.php");


//print_notarray
	class print_notarray{
		public $print_sql;
		function __construct($print_sql){
			$this->print_sql=$print_sql;
			$print_array=array();
			$rcdata_connect= connect();
			$data_result=$rcdata_connect->query($this->print_sql);
			
			if($data_result->num_rows>0){
				$txt_notarray="have";
				$data_row=$data_result->fetch_assoc();
				$print_array[]=$data_row;
			}else{
				$txt_notarray="not_have";
			}
			$this->txt_notarray=$txt_notarray;
			$this->print_array=$print_array;
		}
		function __destruct(){
			$this->txt_notarray;
			$this->print_array;
		}
		
	}
	
		class print_rowarray{
		public $print_sql;
		function __construct($print_sql){
			$this->print_sql=$print_sql;
			$print_array=array();
			$rcdata_connect= connect();
			$data_result=$rcdata_connect->query($this->print_sql);
			
			if($data_result->num_rows>0){
				$txt_notarray="have";
				while($data_row=$data_result->fetch_assoc()){
					$print_array[]=$data_row;
				}
			}else{
				$txt_notarray="not_have";
			}
			$this->txt_notarray=$txt_notarray;
			$this->print_array=$print_array;
		}
		function __destruct(){
			$this->txt_notarray;
			$this->print_array;
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
			$rcdata_connect= connect();
			
			$advisor_sql="select `rc_person`.`IDTeacher`,`rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName` ,`rc_level`.`IDLevel`
						  from `rc_advisor` 
						  join `rc_level` on (`rc_advisor`.`IDLevel`=`rc_level`.`IDLevel`) 
						  join `rc_person` on (`rc_person`.`IDTeacher`=`rc_advisor`.`IDPerson`) 
						  join `rc_prefix` on (`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`) 
						  where `rc_advisor`.`YearEdu`='{$this->txt_YearEdu}' 
						  and `rc_advisor`.`IDLevel`='{$this->txt_IDLevel}' 
						  and `rc_advisor`.`Room`='{$this->txt_Room}' 
						  ORDER BY `rc_advisor`.`Status` DESC";
			$advisor_array=array();
			$advisor_rs=$rcdata_connect->query($advisor_sql);
				if($advisor_rs->num_rows>0){
					while($advisor_row=$advisor_rs->fetch_assoc()){
						$advisor_array[]=$advisor_row;
					}
				}else{
					
				}
				$this->advisor_array=$advisor_array;
		}
		function __destruct(){
			$this->advisor_array;
		}
	}
//rc_advisor****end




//rc_advisor***end



//stu_level
	class stu_level{
		public $stu_id;
		public $stu_year;
		public $stu_term;
		
		function __construct($stu_id,$stu_year,$stu_term){
			$this->stu_id=$stu_id;
			$this->stu_year=$stu_year;
			$this->stu_term=$stu_term;
			
			$stu_levelsql="select `regina_stu_class`.`rsd_studentid`,`rc_level`.`IDLevel`,`rc_level`.`Sort_name`,`rc_level`.`Lname`
						 ,`rc_plan`.`Name`as `planname`,`regina_stu_class`.`rsc_room`,`regina_stu_class`.`rsc_num`,`regina_stu_class`.`rsc_plan`,`regina_stu_class`.`rsc_txt`
						   from `regina_stu_class` join `rc_level` on(`rc_level`.`IDLevel`=`regina_stu_class`.`rsc_class`)
						   join `rc_plan` on(`regina_stu_class`.`rsc_plan`=`rc_plan`.`IDPlan`)
						   where `regina_stu_class`.`rsc_year`='{$this->stu_year}'
						   and `regina_stu_class`.`rsc_term`='{$this->stu_term}'
						   and `regina_stu_class`.`rsd_studentid`='{$this->stu_id}'";
			$rcdata_connect= connect();						   
			$stu_levelRs=$rcdata_connect->query($stu_levelsql);
				if($stu_levelRs->num_rows>0){
					$stu_levelRow=$stu_levelRs->fetch_assoc();
					$this->rsd_studentid=$stu_levelRow["rsd_studentid"];
					$this->IDLevel=$stu_levelRow["IDLevel"];
					$this->Sort_name=$stu_levelRow["Sort_name"];
					$this->Lname=$stu_levelRow["Lname"];
					$this->planname=$stu_levelRow["planname"];
					$this->rsc_room=$stu_levelRow["rsc_room"];
					$this->rsc_num=$stu_levelRow["rsc_num"];
					$this->rc_plan=$stu_levelRow["rsc_plan"];
					$this->rsc_txt=$stu_levelRow["rsc_txt"];
				}else{
					$this->rsd_studentid="";
					$this->IDLevel="";
					$this->Sort_name="";
					$this->Lname="";
					$this->planname="";
					$this->rsc_room="";
					$this->rsc_num="";
					$this->rc_plan="";
					$this->rsc_txt="";
				}
			
		}
		function __destruct(){
			$this->rsd_studentid;
			$this->IDLevel;
			$this->Sort_name;
			$this->Lname;
			$this->planname;
			$this->rsc_room;
			$this->rsc_num;
			$this->rc_plan;	
			$this->rsc_txt;
		}			
	}

//stu_level End

//
	class stu_grade{
		public $data_grade;
		function __construct($data_grade){
			$this->data_grade=$data_grade;
			if($this->data_grade==4.00){
				$txt_gradeint=4;
				$txt_gradeen="A";
			}elseif($this->data_grade==3.50){
				$txt_gradeint=3.5;
				$txt_gradeen="B+";
			}elseif($this->data_grade==3.00){
				$txt_gradeint=3;
				$txt_gradeen="B";
			}elseif($this->data_grade==2.50){
				$txt_gradeint=2.5;
				$txt_gradeen="C+";
			}elseif($this->data_grade==2.00){
				$txt_gradeint=2;
				$txt_gradeen="C";
			}elseif($this->data_grade==1.50){
				$txt_gradeint=1.5;
				$txt_gradeen="D+";
			}elseif($this->data_grade==1.00){
				$txt_gradeint=1;
				$txt_gradeen="D";
			}elseif($this->data_grade==0.00){
				$txt_gradeint=0;
				$txt_gradeen="F";
			}else{
				$txt_gradeint=0;
				$txt_gradeen="F";
			}
			$this->txt_gradeint=$txt_gradeint;
			$this->txt_gradeen=$txt_gradeen;		
		}
		function __destruct(){
			$this->txt_gradeint;
			$this->txt_gradeen;	
		}			
	}
//overdue_data
	class overdue_rc{
		public $ove_student;
		public $ove_term;
		public $ove_year;
		public $ove_oc;
		function __construct($ove_student,$ove_term,$ove_year,$ove_oc){
			$this->ove_student=$ove_student;
			$this->ove_term=$ove_term;
			$this->ove_year=$ove_year;
			$this->ove_oc=$ove_oc;
			
				$overdue_dataSql="select `overdue_data`.`od_student`,`overdue_data`.`od_term`,`overdue_data`.`od_year`,`overdue_data`.`od_class`,`overdue_data`.`os_id`,`overdue_data`.`oc_id`,`overdue_category`.`oc_text` 
								  from `overdue_data` join `overdue_category` on(`overdue_data`.`oc_id`=`overdue_category`.`oc_id`) 
								  where `overdue_data`.`od_student`='{$this->ove_student}' 
								  and `overdue_data`.`od_term`='{$this->ove_term}' 
								  and `overdue_data`.`od_year`='{$this->ove_year}' 
								  and `overdue_data`.`oc_id`='{$this->ove_oc}'";
				$rcdata_connect= connect();
				$overdue_dataRS=$rcdata_connect->query($overdue_dataSql) or die ($rcdata_connect->error);
				
				if($overdue_dataRS->num_rows>0){
					$overdue_dataRow=$overdue_dataRS->fetch_assoc();
					$os_id=$overdue_dataRow["os_id"];
					$oc_id=$overdue_dataRow["oc_id"];
					$oc_text=$overdue_dataRow["oc_text"];
					if($os_id=="os02"){//ค้างชำระเงินบางส่วน
						$overdue_echo="pay";
						$overdue_os=$os_id;
						$overdue_oc=$oc_id;
						$overdue_oc_text=$oc_text;
					}elseif($os_id=="os03"){//ชำระเงินแล้ว
						$overdue_echo="pay";
						$overdue_os=$os_id;
						$overdue_oc=$oc_id;
						$overdue_oc_text=$oc_text;
					}else{
						$overdue_echo="notpay";
						$overdue_os=$os_id;
						$overdue_oc=$oc_id;
						$overdue_oc_text=$oc_text;
					}
				}else{
					$overdue_echo="pay";
					$overdue_os="";
					$overdue_oc="";
					$overdue_oc_text="";
					
				}
				$this->overdue_echo=$overdue_echo;
				$this->overdue_os=$overdue_os;
				$this->overdue_oc=$overdue_oc;
				$this->overdue_oc_text=$overdue_oc_text;
		}
			function __destruct(){
				$this->overdue_echo;
				$this->overdue_os;
				//$this->overdue_os;
				$this->overdue_oc;
				$this->overdue_oc_text;
			}
	}
	
?>