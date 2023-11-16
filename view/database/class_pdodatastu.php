<?php error_reporting(error_reporting() & ~E_NOTICE); ?>


<?php
//saveswiptime
	class CheckSaveSwisTime{
		public $CSST_key;
		function __construct($CSST_key){			
//------------------------------------------------------------------------------------
			$this->CSST_key=$CSST_key;
//------------------------------------------------------------------------------------
			$dataA=date("Y-m-d");
//------------------------------------------------------------------------------------			
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];//-------------------------------
			$connpdo_datastu=new count_conndatastu($db_evaluationID);//---------------
			$pdo_datastu=$connpdo_datastu->call_coun_conndatastu();//-----------------
//------------------------------------------------------------------------------------			
			$CSST_Sql="SELECT `SST_Key`,`SST_DateTime`
					   FROM `saveswiptime` WHERE `SST_Key`='{$this->CSST_key}'";
				if($CSST_Rs=$pdo_datastu->query($CSST_Sql)){
					$CSST_Row=$CSST_Rs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($CSST_Row) && count($CSST_Row)){
							$dataB=date("Y-m-d",strtotime($CSST_Row["SST_DateTime"]));
//------------------------------------------------------------------------------------							
							$rundataA=preg_split("/-/",$dataA);
							list($year1,$month1,$day1)=$rundataA;
							$Day1=mktime(0,0,0,$month1,$day1,$year1);
							
							$rundataB=preg_split("/-/",$dataB);
							list($year2,$month2,$day2)=$rundataB;
							$Day2=mktime(0,0,0,$month2,$day2,$year2);							
							
							$int_date=round(abs($Day1-$Day2)/86400)+1;
//------------------------------------------------------------------------------------
						}else{
							$int_date=null;
						}
				}else{
					$int_date=null;
				}
				
				if(isset($int_date)){
					if($int_date<=7){
						$CSST_UpData="New";
						$this->CSST_UpData=$CSST_UpData;
					}else{
						$CSST_UpData="NotNew";
						$this->CSST_UpData=$CSST_UpData;
					}
					$pdo_datastu=null;
				}else{
					$pdo_datastu=null;
				}
		}function RunCheckSaveSwisTime(){
			if(isset($this->CSST_UpData)){
				return $this->CSST_UpData;
			}else{
//------------------------------------------------------------------------------------				
			}
		}
	}
//saveswiptime end	
?>






<?php
//up_into_saveswiptime
	class UpIntoSaveSwipTime{//---------------------------------------------------
		public $SST_Key;//--------------------------------------------------------
		function __construct($SST_Key){//-----------------------------------------
//--------------------------------------------------------------------------------		
		$SaveSwipTimeSystem="Error";//--------------------------------------------
		$SST_HTTP=$_SERVER["HTTP_USER_AGENT"];//----------------------------------
		$SST_DateTime=date("Y-m-d H:i:s");//--------------------------------------
//--------------------------------------------------------------------------------	
		$db_evaluationID=$_SERVER['REMOTE_ADDR'];//-------------------------------
		$connpdo_datastu=new count_conndatastu($db_evaluationID);//---------------
		$pdo_datastu=$connpdo_datastu->call_coun_conndatastu();//-----------------
//--------------------------------------------------------------------------------
		$this->SST_Key=$SST_Key;//------------------------------------------------
//--------------------------------------------------------------------------------	
		$CountSaveSwipTimeSql="SELECT COUNT(`SST_Key`) AS `count_sst` 
							   FROM `saveswiptime` 
							   WHERE `SST_Key`='{$this->SST_Key}'";
			if($CountSaveSwipTimeRs=$pdo_datastu->query($CountSaveSwipTimeSql)){
				$CountSaveSwipTimeRow=$CountSaveSwipTimeRs->Fetch(PDO::FETCH_ASSOC);
				if(is_array($CountSaveSwipTimeRow) && count($CountSaveSwipTimeRow)){
					$count_sst=$CountSaveSwipTimeRow["count_sst"];
						if($count_sst>=1){
							try{
								$SaveSwipTimeUp="UPDATE `saveswiptime` SET `SST_IP`='{$db_evaluationID}',`SST_HTTP`='{$SST_HTTP}',`SST_DateTime`='{$SST_DateTime}' 
								                 WHERE `SST_Key`='{$this->SST_Key}'";
								$pdo_datastu->exec($SaveSwipTimeUp);	
								$SaveSwipTimeSystem="NotError";
							}catch(PDOException $e){
								$SaveSwipTimeSystem="Error";
							}
						}else{
							try{
								$SaveSwipTimeInto="INSERT INTO `saveswiptime`(`SST_Key`, `SST_IP`, `SST_HTTP`, `SST_DateTime`) 
												   VALUES ('{$this->SST_Key}','{$db_evaluationID}','{$SST_HTTP}','{$SST_DateTime}')";
								$pdo_datastu->exec($SaveSwipTimeInto);	
								$SaveSwipTimeSystem="NotError";
							}catch(PDOException $e){
								$SaveSwipTimeSystem="Error";
							}							
						}
				}else{
					$SaveSwipTimeSystem="Error";
				}
			}else{
				$SaveSwipTimeSystem="Error";
			}
//-------------------------------------------------------------------------------------------------------------------------------------------
			if(isset($SaveSwipTimeSystem)){
				$this->SaveSwipTimeSystem=$SaveSwipTimeSystem;
				$pdo_datastu=null;
			}else{
				$pdo_datastu=null;
			}
//-------------------------------------------------------------------------------------------------------------------------------------------
		}function RunUpIntoSaveSwipTime(){
			if(isset($this->SaveSwipTimeSystem)){
				return $this->SaveSwipTimeSystem;
			}else{
//-------------------------------------------------------------------------------------------------------------------------------------------				
			}
		}
	}
?>
<?php
//data_career
  class data_career{
    public $career_key;
    function __construct($career_key){
      $this->career_key=$career_key;
	  
	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
	  
	  
	  $data_careerSql="SELECT `dc_key`, `dc_txt`, `dc_txt2` FROM `data_career` WHERE `dc_key`='{$this->career_key}';";
			if($data_careerRs=$pdo_datastu->query($data_careerSql)){
			   $data_careerRow=$data_careerRs->Fetch(PDO::FETCH_ASSOC);
				   if(is_array($data_careerRow) && count($data_careerRow)){
					     $dc_run="dc_run";
						 $dc_key=$data_careerRow["dc_key"];
						 $dc_txt=$data_careerRow["dc_txt"];
						 $dc_txt2=$data_careerRow["dc_txt2"];					   
				   }else{
						 $dc_run="-";
					     $dc_key="-";
						 $dc_txt="-";
						 $dc_txt2="-";
				   }
			}else{
				 $dc_run="-";
				 $dc_key="-";
				 $dc_txt="-";
				 $dc_txt2="-";
			}
			if(isset($dc_run)){
				$this->dc_key=$dc_key;
				$this->dc_txt=$dc_txt;
				$this->dc_txt2=$dc_txt2;			
			}else{
				//---------------------------------
			}
			$pdo_datastu=Null;
    }
    function __destruct(){
			if(isset($dc_run)){
				 $this->dc_key;
				 $this->dc_txt;
				 $this->dc_txt2;			
			}else{
				//-------------------------------------
			}
		}
  }

//data_incom
  class data_incom{
    public $incom_key;
    function __construct($incom_key){
      $this->incom_key=$incom_key;
	  
	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
	  
	  
			$data_incomSql="SELECT `di_key`, `di_txt` FROM `data_incom` WHERE `di_key`='{$this->incom_key}';";
			if($data_incomRs=$pdo_datastu->query($data_incomSql)){
			   $data_incomRow=$data_incomRs->Fetch(PDO::FETCH_ASSOC);
			   if(is_array($data_incomRow) && count($data_incomRow)){
				 $di_key=$data_incomRow["di_key"];
				 $di_txt=$data_incomRow["di_txt"];				   
			   }else{
				 $di_key="-";
				 $di_txt="-";				   
			   }
			}else{
			   $di_key="-";
			   $di_txt="-";	
			}
			if(isset($di_key)){
			  $this->di_key=$di_key;
			  $this->di_txt=$di_txt;				
			}else{
			  //------------------------------------------------------	
			}
			$pdo_datastu=Null;
    }
    function __destruct(){
			if(isset($this->di_key)){
			  $this->di_key;
			  $this->di_txt;			
			}else{
				//---------------------------------------------------------
			}

		}
  }

//data_study
  class data_study{
    public $data_study;
    function __construct($data_study){
      $this->data_study=$data_study;

	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();

			$data_studySql="SELECT `study_id`, `study_txt` FROM `data_study` WHERE `study_id`='{$this->data_study}';";
			if($data_studyRs=$pdo_datastu->query($data_studySql)){
			   $data_studyRow=$data_studyRs->Fetch(PDO::FETCH_ASSOC);
			   if(is_array($data_studyRow) && count($data_studyRow)){
				 $study_id=$data_studyRow["study_id"];
				 $study_txt=$data_studyRow["study_txt"];				   
			   }else{
				 $study_id="-";
				 $study_txt="-";					   
			   }
			}else{
			 $study_id="-";
			 $study_txt="-";
			}
			if(isset($study_id)){
			  $this->study_id=$study_id;
			  $this->study_txt=$study_txt;				
			}else{
			  //--------------------------	
			}
			$pdo_datastu=Null;
    }
    function __destruct(){
			  if(isset($this->study_id)){
				  $this->study_id;
				  $this->study_txt;		  
			  }else{
				 //-------------------------------- 
			  }

		}
  }




//print stu_father
  class stu_father{
    public $stu_key;
    function __construct($stu_key){
      $this->stu_key=$stu_key;

	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();

		$stu_fatherSql="SELECT  `father_prefix`, `father_fname`, `father_sname`, `father_prefix_en`, `father_fname_en`, `father_sname_en`, `father_code`, `sf_blood`, `sf_nation`, `sf_sun`, `sf_IDReligion`, `af_birthday`, `father_career`, `father_study`, `father_careerOther`, `father_salary`, `father_workplace`, `father_wp_pro`, `father_wp_tel`, `father_phone` FROM `stu_father` WHERE`stu_id`='{$this->stu_key}';";
			if($stu_fatherRs=$pdo_datastu->query($stu_fatherSql)){
			   $stu_fatherRow=$stu_fatherRs->Fetch(PDO::FETCH_ASSOC);
				if(is_array($stu_fatherRow) && count($stu_fatherRow)){
					 $father_run="father_run";
					 $father_prefix=$stu_fatherRow["father_prefix"];
					 $father_fname=$stu_fatherRow["father_fname"];
					 $father_sname=$stu_fatherRow["father_sname"];
					 $father_prefix_en=$stu_fatherRow["father_prefix_en"];
					 $father_fname_en=$stu_fatherRow["father_fname_en"];
					 $father_sname_en=$stu_fatherRow["father_sname_en"];
					 $father_code=$stu_fatherRow["father_code"];
					 $sf_blood=$stu_fatherRow["sf_blood"];
					 $sf_nation=$stu_fatherRow["sf_nation"];
					 $sf_sun=$stu_fatherRow["sf_sun"];
					 $sf_IDReligion=$stu_fatherRow["sf_IDReligion"];
					 $af_birthday=$stu_fatherRow["af_birthday"];
					 $father_career=$stu_fatherRow["father_career"];
					 $father_study=$stu_fatherRow["father_study"];
					 $father_careerOther=$stu_fatherRow["father_careerOther"];
					 $father_salary=$stu_fatherRow["father_salary"];
					 $father_workplace=$stu_fatherRow["father_workplace"];
					 $father_wp_pro=$stu_fatherRow["father_wp_pro"];
					 $father_wp_tel=$stu_fatherRow["father_wp_tel"];
					 $father_phone=$stu_fatherRow["father_phone"];					
				}else{
					 $father_run="-";
					 $father_prefix="-";
					 $father_fname="-";
				     $father_sname="-";
				     $father_prefix_en="-";
				     $father_fname_en="-";
				     $father_sname_en="-";
				     $father_code="-";
				     $sf_blood="-";
				     $sf_nation="-";
				     $sf_sun="-";
				     $sf_IDReligion="-";
				     $af_birthday="-";
					 $father_career="-";
					 $father_study="-";
				     $father_careerOther="-";
				     $father_salary="-";
				     $father_workplace="-";
				     $father_wp_pro="-";
				     $father_wp_tel="-";
				     $father_phone="-";					
				}
			}else{
				$father_run="-";
				$father_prefix="-";
				$father_fname="-";
				$father_sname="-";
				$father_prefix_en="-";
				$father_fname_en="-";
				$father_sname_en="-";
				$father_code="-";
				$sf_blood="-";
				$sf_nation="-";
				$sf_sun="-";
				$sf_IDReligion="-";
				$af_birthday="-";
			    $father_career="-";
			    $father_study="-";
				$father_careerOther="-";
				$father_salary="-";
				$father_workplace="-";
				$father_wp_pro="-";
				$father_wp_tel="-";
				$father_phone="-";
			}
			if(isset($father_run)){
				 $this->father_prefix=$father_prefix;
				 $this->father_fname=$father_fname;
				 $this->father_sname=$father_sname;
				 $this->father_prefix_en=$father_prefix_en;
				 $this->father_fname_en=$father_fname_en;
				 $this->father_sname_en=$father_sname_en;
				 $this->father_code=$father_code;
				 $this->sf_blood=$sf_blood;
				 $this->sf_nation=$sf_nation;
				 $this->sf_sun=$sf_sun;
				 $this->sf_IDReligion=$sf_IDReligion;
				 $this->af_birthday=$af_birthday;
				 $this->father_career=$father_career;
				 $this->father_study=$father_study;
				 $this->father_careerOther=$father_careerOther;
				 $this->father_salary=$father_salary;
				 $this->father_workplace=$father_workplace;
				 $this->father_wp_pro=$father_wp_pro;
				 $this->father_wp_tel=$father_wp_tel;
				 $this->father_phone=$father_phone;				
			}else{
				//---------------------------------------------
			}
			$pdo_datastu=Null;
    }
    function __destruct(){
			if(isset($father_run)){
				 $this->father_prefix;
				 $this->father_fname;
				 $this->father_sname;
				 $this->father_prefix_en;
				 $this->father_fname_en;
				 $this->father_sname_en;
				 $this->father_code;
				 $this->sf_blood;
				 $this->sf_nation;
				 $this->sf_sun;
				 $this->sf_IDReligion;
				 $this->af_birthday;
				 $this->father_career;
				 $this->father_study;
				 $this->father_careerOther;
				 $this->father_salary;
				 $this->father_workplace;
				 $this->father_wp_pro;
				 $this->father_wp_tel;
				 $this->father_phone;			
			}else{
				 //-----------------------------------------
			}
		}
  }

//print stu_father_address
  class stu_father_address{
     public $stu_key;
    function __construct($stu_key){
      $this->stu_key=$stu_key;

	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();

		 $stu_father_addressSql="SELECT  `father_hno`, `father_moo`, `father_soi`, `father_road`, `father_tumbon`, `father_amphur`, `father_province`, `father_zipcode` FROM `stu_father_address` WHERE `stu_id`='{$this->stu_key}'";
			if($stu_father_addressRs=$pdo_datastu->query($stu_father_addressSql)){
			   $stu_father_addressRow=$stu_father_addressRs->Fetch(PDO::FETCH_ASSOC);
				   if(is_array($stu_father_addressRow) && count($stu_father_addressRow)){
					     $father_run="father_run";
						 $father_hno=$stu_father_addressRow["father_hno"];
						 $father_moo=$stu_father_addressRow["father_moo"];
						 $father_soi=$stu_father_addressRow["father_soi"];
						 $father_road=$stu_father_addressRow["father_road"];
						 $father_tumbon=$stu_father_addressRow["father_tumbon"];
						 $father_amphur=$stu_father_addressRow["father_amphur"];
						 $father_province=$stu_father_addressRow["father_province"];
						 $father_zipcode=$stu_father_addressRow["father_zipcode"];					   
				   }else{
						 $father_run="-";
						 $father_hno="-";
						 $father_moo="-";
						 $father_soi="-";
						 $father_road="-";
						 $father_tumbon="-";
						 $father_amphur="-";
						 $father_province="-";
						 $father_zipcode="-";					   
				   }
			}else{
				$father_run="-";
				$father_hno="-";
				$father_moo="-";
				$father_soi="-";
				$father_road="-";
				$father_tumbon="-";
				$father_amphur="-";
				$father_province="-";
				$father_zipcode="-";	
			}
			$pdo_datastu=Null;
			if(isset($father_run)){
				$this->father_hno=$father_hno;
				$this->father_moo=$father_moo;
				$this->father_soi=$father_soi;
				$this->father_road=$father_road;
				$this->father_tumbon=$father_tumbon;
				$this->father_amphur=$father_amphur;
				$this->father_province=$father_province;
				$this->father_zipcode=$father_zipcode;				
			}else{
				//--------------------------------------
			}
    }
    function __destruct(){
			if(isset($father_run)){
				$this->father_hno;
				$this->father_moo;
				$this->father_soi;
				$this->father_road;
				$this->father_tumbon;
				$this->father_amphur;
				$this->father_province;
				$this->father_zipcode;			
			}else{
				//-------------------------------------	
			}
		}
  }
//print_stu_father_addword
  class stu_father_addword{
    public $stu_key;
    function __construct($stu_key){
      $this->stu_key=$stu_key;

	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();

	  $stu_father_addwordSql="SELECT `father_addwordhno`, `father_addwordmoo`, `father_addwordsoi`, `father_addwordroad`, `father_addwordtumbon`, `father_addwordamphur`, `father_addwordprovince`, `father_addwordzipcode`, `father_addwordphone` FROM `stu_father_addword` WHERE`stu_id`='{$this->stu_key}';";
			if($stu_father_addwordRs=$pdo_datastu->query($stu_father_addwordSql)){
			   $stu_father_addwordRow=$stu_father_addwordRs->Fetch(PDO::FETCH_ASSOC);
			   if(is_array($stu_father_addwordRow) && count($stu_father_addwordRow)){
				   $father_run="father_run";
				   $father_addwordhno=$stu_father_addwordRow["father_addwordhno"];
				   $father_addwordmoo=$stu_father_addwordRow["father_addwordmoo"];
				   $father_addwordsoi=$stu_father_addwordRow["father_addwordsoi"];
				   $father_addwordroad=$stu_father_addwordRow["father_addwordroad"];
				   $father_addwordtumbon=$stu_father_addwordRow["father_addwordtumbon"];
				   $father_addwordamphur=$stu_father_addwordRow["father_addwordamphur"];
				   $father_addwordprovince=$stu_father_addwordRow["father_addwordprovince"];
				   $father_addwordzipcode=$stu_father_addwordRow["father_addwordzipcode"];
				   $father_addwordphone=$stu_father_addwordRow["father_addwordphone"];				   
			   }else{
				   $father_run="-";
				   $father_addwordhno="-";
                   $father_addwordmoo="-";
                   $father_addwordsoi="-";
				   $father_addwordroad="-";
                   $father_addwordtumbon="-";
                   $father_addwordamphur="-";
                   $father_addwordprovince="-";
                   $father_addwordzipcode="-";
                   $father_addwordphone="-";				   
			   }
			}else{
				$father_run="-";
				$father_addwordhno="-";
                $father_addwordmoo="-";
                $father_addwordsoi="-";
				$father_addwordroad="-";
                $father_addwordtumbon="-";
                $father_addwordamphur="-";
                $father_addwordprovince="-";
                $father_addwordzipcode="-";
                $father_addwordphone="-";
			}if(isset($father_run)){
				 $this->father_addwordhno=$father_addwordhno;
				 $this->father_addwordmoo=$father_addwordmoo;
				 $this->father_addwordsoi=$father_addwordsoi;
				 $this->father_addwordroad=$father_addwordroad;
				 $this->father_addwordtumbon=$father_addwordtumbon;
				 $this->father_addwordamphur=$father_addwordamphur;
				 $this->father_addwordprovince=$father_addwordprovince;
				 $this->father_addwordzipcode=$father_addwordzipcode;
				 $this->father_addwordphone=$father_addwordphone;				
			}else{
				//-------------------------------------------------------
			}
   			 $pdo_datastu=Null;
    }function __destruct(){
			if(isset($father_run)){
				 $this->father_addwordhno;
				 $this->father_addwordmoo;
				 $this->father_addwordsoi;
				 $this->father_addwordroad;
				 $this->father_addwordtumbon;
				 $this->father_addwordamphur;
				 $this->father_addwordprovince;
				 $this->father_addwordzipcode;
				 $this->father_addwordphone;			
			}else{
				//--------------------------------------------------------
			}
		}
  }

//print stu_mother
  class stu_mother{
    function __construct($stu_key){
      $this->stu_key=$stu_key;

	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();

		  $stu_motherSql="SELECT  `mother_prefix`, `mother_fname`, `mother_sname`, `mother_prefix_en`, `mother_fname_en`, `mother_sname_en`, `mother_code`, `mother_blood`, `mother_nation`, `mother_sun`, `mother_IDReligion`, `mother_birthday`, `mother_career`, `mother_careerOther`, `mother_study`, `mother_salary`, `mother_workplace`, `mother_wp_pro`, `mother_wp_tel`, `mother_phone` FROM `stu_mother` WHERE `stu_id`='{$this->stu_key}';";
			if($stu_motherRs=$pdo_datastu->query($stu_motherSql)){
			    $stu_motherRow=$stu_motherRs->Fetch(PDO::FETCH_ASSOC);
				if(is_array($stu_motherRow) && count($stu_motherRow)){
					  $mother_run="mother_run";
					  $mother_prefix=$stu_motherRow["mother_prefix"];
					  $mother_fname=$stu_motherRow["mother_fname"];
					  $mother_sname=$stu_motherRow["mother_sname"];
					  $mother_prefix_en=$stu_motherRow["mother_prefix_en"];
					  $mother_fname_en=$stu_motherRow["mother_fname_en"];
					  $mother_sname_en=$stu_motherRow["mother_sname_en"];
					  $mother_code=$stu_motherRow["mother_code"];
					  $mother_blood=$stu_motherRow["mother_blood"];
					  $mother_nation=$stu_motherRow["mother_nation"];
					  $mother_sun=$stu_motherRow["mother_sun"];
					  $mother_IDReligion=$stu_motherRow["mother_IDReligion"];
					  $mother_birthday=$stu_motherRow["mother_birthday"];
					  $mother_career=$stu_motherRow["mother_career"];
					  $mother_careerOther=$stu_motherRow["mother_careerOther"];
					  $mother_study=$stu_motherRow["mother_study"];
					  $mother_salary=$stu_motherRow["mother_salary"];
					  $mother_workplace=$stu_motherRow["mother_workplace"];
					  $mother_wp_pro=$stu_motherRow["mother_wp_pro"];
					  $mother_wp_tel=$stu_motherRow["mother_wp_tel"];
					  $mother_phone=$stu_motherRow["mother_phone"];					
				}else{
					  $mother_run="-";
					  $mother_prefix="-";
					  $mother_fname="-";
					  $mother_sname="-";
					  $mother_prefix_en="-";
					  $mother_fname_en="-";
					  $mother_sname_en="-";
					  $mother_code="-";
					  $mother_blood="-";
					  $mother_nation="-";
					  $mother_sun="-";
					  $mother_IDReligion="-";
					  $mother_birthday="-";
					  $mother_career="-";
					  $mother_careerOther="-";
					  $mother_study="-";
					  $mother_salary="-";
					  $mother_workplace="-";
					  $mother_wp_pro="-";
					  $mother_wp_tel="-";
					  $mother_phone="-";					  
				}
			}else{
				$mother_run="-";
			    $mother_prefix="-";
			    $mother_fname="-";
				$mother_sname="-";
				$mother_prefix_en="-";
				$mother_fname_en="-";
				$mother_sname_en="-";
				$mother_code="-";
				$mother_blood="-";
				$mother_nation="-";
				$mother_sun="-";
				$mother_IDReligion="-";
				$mother_birthday="-";
				$mother_career="-";
				$mother_careerOther="-";
				$mother_study="-";
				$mother_salary="-";
				$mother_workplace="-";
				$mother_wp_pro="-";
				$mother_wp_tel="-";
				$mother_phone="-";
			}
		  if(isset($mother_run)){
			  $this->mother_prefix=$mother_prefix;
			  $this->mother_fname=$mother_fname;
			  $this->mother_sname=$mother_sname;
			  $this->mother_prefix_en=$mother_prefix_en;
			  $this->mother_fname_en=$mother_fname_en;
			  $this->mother_sname_en=$mother_sname_en;
			  $this->mother_code=$mother_code;
			  $this->mother_blood=$mother_blood;
			  $this->mother_nation=$mother_nation;
			  $this->mother_sun=$mother_sun;
			  $this->mother_IDReligion=$mother_IDReligion;
			  $this->mother_birthday=$mother_birthday;
			  $this->mother_career=$mother_career;
			  $this->mother_careerOther=$mother_careerOther;
			  $this->mother_study=$mother_study;
			  $this->mother_salary=$mother_salary;
			  $this->mother_workplace=$mother_workplace;
			  $this->mother_wp_pro=$mother_wp_pro;
			  $this->mother_wp_tel=$mother_wp_tel;
			  $this->mother_phone=$mother_phone;			  
		  }else{
			  //----------------------------------------------------------
		  }
			  $pdo_datastu=Null;
    }function __destruct(){
		  if(isset($mother_run)){
			  $this->mother_prefix=$mother_prefix;
			  $this->mother_fname=$mother_fname;
			  $this->mother_sname=$mother_sname;
			  $this->mother_prefix_en=$mother_prefix_en;
			  $this->mother_fname_en=$mother_fname_en;
			  $this->mother_sname_en=$mother_sname_en;
			  $this->mother_code=$mother_code;
			  $this->mother_blood=$mother_blood;
			  $this->mother_nation=$mother_nation;
			  $this->mother_sun=$mother_sun;
			  $this->mother_IDReligion=$mother_IDReligion;
			  $this->mother_birthday=$mother_birthday;
			  $this->mother_career=$mother_career;
			  $this->mother_careerOther=$mother_careerOther;
			  $this->mother_study=$mother_study;
			  $this->mother_salary=$mother_salary;
			  $this->mother_workplace=$mother_workplace;
			  $this->mother_wp_pro=$mother_wp_pro;
			  $this->mother_wp_tel=$mother_wp_tel;
			  $this->mother_phone=$mother_phone;			  
		  }else{
			  //-------------------------------------------------------	
		  }
		}
  }

//print stu_mother_address

  class stu_mother_address{
    public $stu_key;
    function __construct($stu_key){
      $this->stu_key=$stu_key;

	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();

		  $stu_mother_addressSql="SELECT  `mother_hno`, `mother_moo`, `mother_soi`, `mother_road`, `mother_tumbon`, `mother_amphur`, `mother_province`, `mother_zipcode` FROM `stu_mother_address` WHERE `stu_id`='{$this->stu_key}';";
			if($stu_mother_addressRs=$pdo_datastu->query($stu_mother_addressSql)){
			   $stu_mother_addressRow=$stu_mother_addressRs->Fetch(PDO::FETCH_ASSOC);
          $mother_hno=$stu_mother_addressRow["mother_hno"];
          $mother_moo=$stu_mother_addressRow["mother_moo"];
          $mother_soi=$stu_mother_addressRow["mother_soi"];
          $mother_road=$stu_mother_addressRow["mother_road"];
          $mother_tumbon=$stu_mother_addressRow["mother_tumbon"];
          $mother_amphur=$stu_mother_addressRow["mother_amphur"];
          $mother_province=$stu_mother_addressRow["mother_province"];
          $mother_zipcode=$stu_mother_addressRow["mother_zipcode"];
			}else{
          $mother_hno="-";
          $mother_moo="-";
          $mother_soi="-";
          $mother_road="-";
          $mother_tumbon="-";
          $mother_amphur="-";
          $mother_province="-";
          $mother_zipcode="-";
			}
			$pdo_datastu=Null;
          $this->mother_hno=$mother_hno;
          $this->mother_moo=$mother_moo;
          $this->mother_soi=$mother_soi;
          $this->mother_road=$mother_road;
          $this->mother_tumbon=$mother_tumbon;
          $this->mother_amphur=$mother_amphur;
          $this->mother_province=$mother_province;
          $this->mother_zipcode=$mother_zipcode;
    }
    function __destruct(){
          $this->mother_hno;
          $this->mother_moo;
          $this->mother_soi;
          $this->mother_road;
          $this->mother_tumbon;
          $this->mother_amphur;
          $this->mother_province;
          $this->mother_zipcode;

		}
  }

//print stu_mother_addword
  class stu_mother_addword{
    public $stu_key;
    function __construct($stu_key){
      $this->stu_key=$stu_key;

	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();

		 $stu_mother_addwordSql="SELECT `mother_wordhno`, `mother_wordmoo`, `mother_wordsoi`, `mother_wordroad`, `mother_wordtumbon`, `mother_wordamphur`, `mother_wordprovince`, `mother_wordzipcode` FROM `stu_mother_addword` WHERE `stu_id`='{$this->stu_key}'";
			if($stu_mother_addwordRs=$pdo_datastu->query($stu_mother_addwordSql)){
			   $stu_mother_addwordRow=$stu_mother_addwordRs->Fetch(PDO::FETCH_ASSOC);
         $mother_wordhno=$stu_mother_addwordRow["mother_wordhno"];
         $mother_wordmoo=$stu_mother_addwordRow["mother_wordmoo"];
         $mother_wordsoi=$stu_mother_addwordRow["mother_wordsoi"];
         $mother_wordroad=$stu_mother_addwordRow["mother_wordroad"];
         $mother_wordtumbon=$stu_mother_addwordRow["mother_wordtumbon"];
         $mother_wordamphur=$stu_mother_addwordRow["mother_wordamphur"];
         $mother_wordprovince=$stu_mother_addwordRow["mother_wordprovince"];
         $mother_wordzipcode=$stu_mother_addwordRow["mother_wordzipcode"];
			}else{
         $mother_wordhno="-";
         $mother_wordmoo="-";
         $mother_wordsoi="-";
         $mother_wordroad="-";
         $mother_wordtumbon="-";
         $mother_wordamphur="-";
         $mother_wordprovince="-";
         $mother_wordzipcode="-";
			}
			$pdo_datastu=Null;
         $this->mother_wordhno=$mother_wordhno;
         $this->mother_wordmoo=$mother_wordmoo;
         $this->mother_wordsoi=$mother_wordsoi;
         $this->mother_wordroad=$mother_wordroad;
         $this->mother_wordtumbon=$mother_wordtumbon;
         $this->mother_wordamphur=$mother_wordamphur;
         $this->mother_wordprovince=$mother_wordprovince;
         $this->mother_wordzipcode=$mother_wordzipcode;
    }function __destruct(){
         $this->mother_wordhno;
         $this->mother_wordmoo;
         $this->mother_wordsoi;
         $this->mother_wordroad;
         $this->mother_wordtumbon;
         $this->mother_wordamphur;
         $this->mother_wordprovince;
         $this->mother_wordzipcode;

		}
  }


//print stu_guardian
  class stu_guardian{
     public $stu_key;
    function __construct($stu_key){
      $this->stu_key=$stu_key;

	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();

		 $stu_guardianSql="SELECT  `parent_prefix`, `parent_fname`, `parent_sname`, `parent_prefix_en`, `parent_fname_en`, `parent_sname_en`, `parent_code`, `guardian_birthday`, `parent_phone`, `parent_blood`, `parent_nation`, `parent_sun`, `parent_IDReligion`, `parent_birthday`, `parent_career`, `parent_careerOther`, `parent_study`, `parent_salary`, `parent_workplace`, `parent_family`, `parent_wp_pro`, `parent_wp_tel`, `parent_status` FROM `stu_guardian` WHERE `stu_id`='{$this->stu_key}';";
			if($stu_guardianRs=$pdo_datastu->query($stu_guardianSql)){
			   $stu_guardianRow=$stu_guardianRs->Fetch(PDO::FETCH_ASSOC);
	     $parent_prefix=$stu_guardianRow["parent_prefix"];
         $parent_fname=$stu_guardianRow["parent_fname"];
         $parent_sname=$stu_guardianRow["parent_sname"];
         $parent_prefix_en=$stu_guardianRow["parent_prefix_en"];
         $parent_fname_en=$stu_guardianRow["parent_fname_en"];
         $parent_sname_en=$stu_guardianRow["parent_sname_en"];
         $parent_code=$stu_guardianRow["parent_code"];
         $guardian_birthday=$stu_guardianRow["guardian_birthday"];
         $parent_phone=$stu_guardianRow["parent_phone"];
         $parent_blood=$stu_guardianRow["parent_blood"];
         $parent_nation=$stu_guardianRow["parent_nation"];
         $parent_sun=$stu_guardianRow["parent_sun"];
         $parent_IDReligion=$stu_guardianRow["parent_IDReligion"];
         $parent_birthday=$stu_guardianRow["parent_birthday"];
         $parent_career=$stu_guardianRow["parent_career"];
         $parent_careerOther=$stu_guardianRow["parent_careerOther"];
         $parent_study=$stu_guardianRow["parent_study"];
         $parent_salary=$stu_guardianRow["parent_salary"];
         $parent_workplace=$stu_guardianRow["parent_workplace"];
         $parent_family=$stu_guardianRow["parent_family"];
         $parent_wp_pro=$stu_guardianRow["parent_wp_pro"];
         $parent_wp_tel=$stu_guardianRow["parent_wp_tel"];
         $parent_status=$stu_guardianRow["parent_status"];

			}else{

	       $parent_prefix="-";
         $parent_fname="-";
         $parent_sname="-";
         $parent_prefix_en="-";
         $parent_fname_en="-";
         $parent_sname_en="-";
         $parent_code="-";
         $guardian_birthday="-";
         $parent_phone="-";
         $parent_blood="-";
         $parent_nation="-";
         $parent_sun="-";
         $parent_IDReligion="-";
         $parent_birthday="-";
         $parent_career="-";
         $parent_careerOther="-";
         $parent_study="-";
         $parent_salary="-";
         $parent_workplace="-";
         $parent_family="-";
         $parent_wp_pro="-";
         $parent_wp_tel="-";
         $parent_status="-";
			}
			$pdo_datastu=Null;

	       $this->parent_prefix=$parent_prefix;
         $this->parent_fname=$parent_fname;
         $this->parent_sname=$parent_sname;
         $this->parent_prefix_en=$parent_prefix_en;
         $this->parent_fname_en=$parent_fname_en;
         $this->parent_sname_en=$parent_sname_en;
         $this->parent_code=$parent_code;
         $this->guardian_birthday=$guardian_birthday;
         $this->parent_phone=$parent_phone;
         $this->parent_blood=$parent_blood;
         $this->parent_nation=$parent_nation;
         $this->parent_sun=$parent_sun;
         $this->parent_IDReligion=$parent_IDReligion;
         $this->parent_birthday=$parent_birthday;
         $this->parent_career=$parent_career;
         $this->parent_careerOther=$parent_careerOther;
         $this->parent_study=$parent_study;
         $this->parent_salary=$parent_salary;
         $this->parent_workplace=$parent_workplace;
         $this->parent_family=$parent_family;
         $this->parent_wp_pro=$parent_wp_pro;
         $this->parent_wp_tel=$parent_wp_tel;
         $this->parent_status=$parent_status;

    }
    function __destruct(){
      
	       $this->parent_prefix;
         $this->parent_fname;
         $this->parent_sname;
         $this->parent_prefix_en;
         $this->parent_fname_en;
         $this->parent_sname_en;
         $this->parent_code;
         $this->guardian_birthday;
         $this->parent_phone;
         $this->parent_blood;
         $this->parent_nation;
         $this->parent_sun;
         $this->parent_IDReligion;
         $this->parent_birthday;
         $this->parent_career;
         $this->parent_careerOther;
         $this->parent_study;
         $this->parent_salary;
         $this->parent_workplace;
         $this->parent_family;
         $this->parent_wp_pro;
         $this->parent_wp_tel;
         $this->parent_status;
         
		}
    
  }

//print stu_guardian_addword
  class stu_guardian_addword{
    public $stu_key;
    function __construct($stu_key){
      $this->stu_key=$stu_key;

	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();

		  $stu_guardian_addwordSql="SELECT `parent_addwordhno`, `parent_addwordmoo`, `parent_addwordsoi`, `parent_addwordroad`, `parent_addwordtumbon`, `parent_addwordamphur`, `parent_addwordprovince`, `parent_addwordzipcode`, `parent_addwordstu` FROM `stu_guardian_addword` WHERE `stu_id`='{$this->stu_key}';";
			if($stu_guardian_addwordRs=$pdo_datastu->query($stu_guardian_addwordSql)){
			   $stu_guardian_addwordRow=$stu_guardian_addwordRs->Fetch(PDO::FETCH_ASSOC);
    
          $parent_addwordhno=$stu_guardian_addwordRow["parent_addwordhno"];
          $parent_addwordmoo=$stu_guardian_addwordRow["parent_addwordmoo"];
          $parent_addwordsoi=$stu_guardian_addwordRow["parent_addwordsoi"];
          $parent_addwordroad=$stu_guardian_addwordRow["parent_addwordroad"];
          $parent_addwordtumbon=$stu_guardian_addwordRow["parent_addwordtumbon"];
          $parent_addwordamphur=$stu_guardian_addwordRow["parent_addwordamphur"];
          $parent_addwordprovince=$stu_guardian_addwordRow["parent_addwordprovince"];
          $parent_addwordzipcode=$stu_guardian_addwordRow["parent_addwordzipcode"];
          $parent_addwordstu=$stu_guardian_addwordRow["parent_addwordstu"];

			}else{
          $parent_addwordhno="-";
          $parent_addwordmoo="-";
          $parent_addwordsoi="-";
          $parent_addwordroad="-";
          $parent_addwordtumbon="-";
          $parent_addwordamphur="-";
          $parent_addwordprovince="-";
          $parent_addwordzipcode="-";
          $parent_addwordstu="-";
			}
			$pdo_datastu=Null;
          $this->parent_addwordhno=$parent_addwordhno;
          $this->parent_addwordmoo=$parent_addwordmoo;
          $this->parent_addwordsoi=$parent_addwordsoi;
          $this->parent_addwordroad=$parent_addwordroad;
          $this->parent_addwordtumbon=$parent_addwordtumbon;
          $this->parent_addwordamphur=$parent_addwordamphur;
          $this->parent_addwordprovince=$parent_addwordprovince;
          $this->parent_addwordzipcode=$parent_addwordzipcode;
          $this->parent_addwordstu=$parent_addwordstu;
    }function __destruct(){
          $this->parent_addwordhno;
          $this->parent_addwordmoo;
          $this->parent_addwordsoi;
          $this->parent_addwordroad;
          $this->parent_addwordtumbon;
          $this->parent_addwordamphur;
          $this->parent_addwordprovince;
          $this->parent_addwordzipcode;
          $this->parent_addwordstu;

		}
    
  }



//print stu_guardian_address
  class stu_guardian_address{
    public $stu_key;
    function __construct($stu_key){
      $this->stu_key=$stu_key;

	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();

		 $data_studentSql="SELECT `stu_id`, `parent_hno`, `parent_moo`, `parent_soi`, `parent_road`, `parent_tumbon`, `parent_amphur`, `parent_province`, `parent_zipcode`, `parent_stu` FROM `stu_guardian_address` WHERE `stu_id`='{$this->stu_key}';";
			if($data_studentRs=$pdo_datastu->query($data_studentSql)){
			   $data_studentRow=$data_studentRs->Fetch(PDO::FETCH_ASSOC);
                    if(is_array($data_studentRow) && count ($data_studentRow)){
                        $parent_hno=$data_studentRow["parent_hno"];
                        $parent_moo=$data_studentRow["parent_moo"];
                        $parent_soi=$data_studentRow["parent_soi"];
                        $parent_road=$data_studentRow["parent_road"];
                        $parent_tumbon=$data_studentRow["parent_tumbon"];
                        $parent_amphur=$data_studentRow["parent_amphur"];
                        $parent_province=$data_studentRow["parent_province"];
                        $parent_zipcode=$data_studentRow["parent_zipcode"];
                        $parent_stu=$data_studentRow["parent_stu"];                        
                    }else{
                        $parent_hno="-";
                        $parent_moo="-";
                        $parent_soi="-";
                        $parent_road="-";
                        $parent_tumbon="-";
                        $parent_amphur="-";
                        $parent_province="-";
                        $parent_zipcode="-";
                        $parent_stu="-";                        
                    }
			}else{
                $parent_hno="-";
                $parent_moo="-";
                $parent_soi="-";
                $parent_road="-";
                $parent_tumbon="-";
                $parent_amphur="-";
                $parent_province="-";
                $parent_zipcode="-";
                $parent_stu="-";
            }
            
            if(isset($this->parent_hno)){
                $this->parent_hno=$parent_hno;                
            }else{}
            
            if(isset($this->parent_moo)){
                $this->parent_moo=$parent_moo;                
            }else{}

            if(isset($this->parent_soi)){
                $this->parent_soi=$parent_soi;                
            }else{}

            if(isset($this->parent_road)){
                $this->parent_road=$parent_road;                
            }else{}  

            if(isset($this->parent_tumbon)){
                $this->parent_tumbon=$parent_tumbon;                
            }else{} 

            if(isset($this->parent_amphur)){
                $this->parent_amphur=$parent_amphur;                
            }else{} 

            if(isset($this->parent_province)){
                $this->parent_province=$parent_province;                
            }else{} 

            if(isset($this->parent_zipcode)){
                $this->parent_zipcode=$parent_zipcode;                
            }else{} 

            if(isset($this->parent_stu)){
                $this->parent_stu=$parent_stu;                
            }else{}             

			$pdo_datastu=Null;
    }function __destruct(){
        
        if(isset($this->parent_hno)){
            $this->parent_hno;            
        }else{}
        
        if(isset($this->parent_moo)){
            $this->parent_moo;            
        }else{}
        
        if(isset($this->parent_soi)){
            $this->parent_soi;            
        }else{}
        
        if(isset($this->parent_road)){
            $this->parent_road;            
        }else{}

        if(isset($this->parent_tumbon)){
            $this->parent_tumbon;            
        }else{}
        
        if(isset($this->parent_amphur)){
            $this->parent_amphur;            
        }else{}
        
        if(isset($this->parent_province)){
            $this->parent_province;            
        }else{}
        
        if(isset($this->parent_zipcode)){
            $this->parent_zipcode;            
        }else{}
        
    }
  }









//print data_student
  class data_student{
    public $stu_key;
    function __construct($stu_key){
      $this->stu_key=$stu_key;

	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();

		$data_studentSql="SELECT `stu_id`, `stu_birth`, `stu_blood`, `stu_nation`, `stu_sun`, `IDReligion`, `stu_phone`, `stu_brethren`, `stu_brethreS`, `stu_child`, `stu_physical`, `breed_add`, `breed_district`, `breed_city`, `breed_province`, `ds_SameSchool`, `ds_OriginalClass`,`ds_ProvinceSchool` FROM `data_student` WHERE`stu_id`='{$this->stu_key}';";
			if($data_studentRs=$pdo_datastu->query($data_studentSql)){
                $data_studentRow=$data_studentRs->Fetch(PDO::FETCH_ASSOC);
                    if(is_array($data_studentRow) && count($data_studentRow)){
                        $stu_birth=$data_studentRow["stu_birth"];
                        $stu_blood=$data_studentRow["stu_blood"];
                        $stu_nation=$data_studentRow["stu_nation"];
                        $stu_sun=$data_studentRow["stu_sun"];
                        $IDReligion=$data_studentRow["IDReligion"];
                        $stu_phone=$data_studentRow["stu_phone"];
                        $stu_brethren=$data_studentRow["stu_brethren"];
                        $stu_brethreS=$data_studentRow["stu_brethreS"];
                        $stu_child=$data_studentRow["stu_child"];
                        $stu_physical=$data_studentRow["stu_physical"];
                        $breed_add=$data_studentRow["breed_add"];
                        $breed_district=$data_studentRow["breed_district"];
                        $breed_city=$data_studentRow["breed_city"];
                        $breed_province=$data_studentRow["breed_province"];
                        $ds_SameSchool=$data_studentRow["ds_SameSchool"];
                        $ds_OriginalClass=$data_studentRow["ds_OriginalClass"];
                        $ds_ProvinceSchool=$data_studentRow["ds_ProvinceSchool"];                        
                    }else{
                        $stu_birth="-";
                        $stu_blood="-";
                        $stu_nation="-";
                        $stu_sun="-";
                        $IDReligion="-";
                        $stu_phone="-";
                        $stu_brethren="-";
                        $stu_brethreS="-";
                        $stu_child="-";
                        $stu_physical="-";
                        $breed_add="-";
                        $breed_district="-";
                        $breed_city="-";
                        $breed_province="-";
                        $ds_SameSchool="-";
                        $ds_OriginalClass="-";
                        $ds_ProvinceSchool="-";
                    }
			}else{
                $stu_birth="-";
                $stu_blood="-";
                $stu_nation="-";
                $stu_sun="-";
                $IDReligion="-";
                $stu_phone="-";
                $stu_brethren="-";
                $stu_brethreS="-";
                $stu_child="-";
                $stu_physical="-";
                $breed_add="-";
                $breed_district="-";
                $breed_city="-";
                $breed_province="-";
                $ds_SameSchool="-";
                $ds_OriginalClass="-";
                $ds_ProvinceSchool="-";
			}
			$pdo_datastu=Null;
            
                if(isset($stu_birth)){
                    $this->stu_birth=$stu_birth;
                }else{}
            
                if(isset($stu_blood)){
                    $this->stu_blood=$stu_blood;
                }else{}

                if(isset($stu_nation)){
                    $this->stu_nation=$stu_nation;
                }else{}                
			    
                if(isset($stu_sun)){
                    $this->stu_sun=$stu_sun;
                }else{} 

                if(isset($IDReligion)){
                    $this->IDReligion=$IDReligion;
                }else{} 

                if(isset($stu_phone)){
                    $this->stu_phone=$stu_phone;
                }else{} 			    

                if(isset($stu_brethren)){
                     $this->stu_brethren=$stu_brethren;
                }else{} 

                if(isset($stu_brethreS)){
                    $this->stu_brethreS=$stu_brethreS;                    
                }else{} 
			    
                if(isset($stu_child)){
                    $this->stu_child=$stu_child;                    
                }else{}

                if(isset($stu_physical)){
                    $this->stu_physical=$stu_physical;                     
                }else{}                

                if(isset($breed_add)){
                    $this->breed_add=$breed_add;                   
                }else{} 

                if(isset($breed_district)){
                    $this->breed_district=$breed_district;                    
                }else{} 

                if(isset($breed_city)){
                    $this->breed_city=$breed_city;                    
                }else{} 

                if(isset($breed_province)){
                    $this->breed_province=$breed_province;                    
                }else{} 

                if(isset($ds_SameSchool)){
                    $this->ds_SameSchool=$ds_SameSchool;                    
                }else{} 			    
			   
                if(isset($ds_OriginalClass)){
                    $this->ds_OriginalClass=$ds_OriginalClass;                    
                }else{} 			    

                if(isset($ds_ProvinceSchool)){
                    $this->ds_ProvinceSchool=$ds_ProvinceSchool;                    
                }else{} 			   

    }
    function __destruct(){
            if(isset($this->stu_birth)){
                $this->stu_birth;
            }else{}
            if(isset($this->stu_blood)){
                $this->stu_blood;
            }else{}
            if(isset($this->stu_nation)){
                $this->stu_nation;
            }else{}
            if(isset($this->stu_sun)){
                $this->stu_sun;
            }else{}   
            if(isset($this->IDReligion)){
                $this->IDReligion;
            }else{}   
            if(isset($this->stu_phone)){
                $this->stu_phone;
            }else{}          
            if(isset($this->stu_brethren)){
                $this->stu_brethren;
            }else{}          
            if(isset($this->stu_brethren)){
                $this->stu_brethren;
            }else{}           
            if(isset($this->stu_brethreS)){
                $this->stu_brethreS;
            }else{}         
            if(isset($this->stu_child)){
                $this->stu_child;
            }else{} 			   
            if(isset($this->stu_physical)){
                $this->stu_physical;
            }else{} 			    
            if(isset($this->breed_add)){
                $this->breed_add;
            }else{} 			    
            if(isset($this->breed_district)){
                $this->breed_district;
            }else{} 			    
            if(isset($this->breed_city)){
                $this->breed_city;
            }else{} 			    
            if(isset($this->breed_province)){
                $this->breed_province;
            }else{} 			    
            if(isset($this->ds_SameSchool)){
                $this->ds_SameSchool;
            }else{} 
            if(isset($this->ds_OriginalClass)){
                $this->ds_OriginalClass;
            }else{}			
            if(isset($this->ds_ProvinceSchool)){
                $this->ds_ProvinceSchool;
            }else{}			    
			  
	}
  }
  
  
  
//depend_stu
  class depend_stu{
    public $stu_key;
    function __construct($stu_key){
      $this->stu_key=$stu_key;

	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();

		  $depend_stuSql="SELECT  `ds_status`, `ds_dormitoryName`, `ds_dormitoryHno`, `ds_dormitoryMoo`, `ds_dormitorySoi`, `ds_dormitoryRoad`, `ds_dormitoryTumbon`, `ds_dormitoryAmphur`, `ds_dormitoryProvince`, `ds_dormitoryZipcode`, `ds_dormitoryPhone`, `ds_dormitoryMyName`, `ds_FoodAllergies`, `ds_CongenitalDisease`, `ds_DrugAllergy`, `ds_trip`, `ds_triptxt`, `ds_FMstatus`, `ds_allergic` FROM `depend_stu` WHERE`ds_stuid`='{$this->stu_key}';";
			if($depend_stuRs=$pdo_datastu->query($depend_stuSql)){
			   $depend_stuRow=$depend_stuRs->Fetch(PDO::FETCH_ASSOC);
               
                if(is_array($depend_stuRow) && count($depend_stuRow)){
                  $ds_status=$depend_stuRow["ds_status"];
                  $ds_dormitoryName=$depend_stuRow["ds_dormitoryName"];
                  $ds_dormitoryHno=$depend_stuRow["ds_dormitoryHno"];
                  $ds_dormitoryMoo=$depend_stuRow["ds_dormitoryMoo"];
                  $ds_dormitorySoi=$depend_stuRow["ds_dormitorySoi"];
                  $ds_dormitoryRoad=$depend_stuRow["ds_dormitoryRoad"];
                  $ds_dormitoryTumbon=$depend_stuRow["ds_dormitoryTumbon"];
                  $ds_dormitoryAmphur=$depend_stuRow["ds_dormitoryAmphur"];
                  $ds_dormitoryProvince=$depend_stuRow["ds_dormitoryProvince"];
                  $ds_dormitoryZipcode=$depend_stuRow["ds_dormitoryZipcode"];
                  $ds_dormitoryPhone=$depend_stuRow["ds_dormitoryPhone"];
                  $ds_dormitoryMyName=$depend_stuRow["ds_dormitoryMyName"];
                  $ds_FoodAllergies=$depend_stuRow["ds_FoodAllergies"];
                  $ds_CongenitalDisease=$depend_stuRow["ds_CongenitalDisease"];
                  $ds_DrugAllergy=$depend_stuRow["ds_DrugAllergy"];
                  $ds_trip=$depend_stuRow["ds_trip"];
                  $ds_triptxt=$depend_stuRow["ds_triptxt"];
                  $ds_FMstatus=$depend_stuRow["ds_FMstatus"];
                  $ds_allergic=$depend_stuRow["ds_allergic"];                    
                }else{
                  $ds_status="-";
                  $ds_dormitoryName="-";
                  $ds_dormitoryHno="-";
                  $ds_dormitoryMoo="-";
                  $ds_dormitorySoi="-";
                  $ds_dormitoryRoad="-";
                  $ds_dormitoryTumbon="-";
                  $ds_dormitoryAmphur="-";
                  $ds_dormitoryProvince="-";
                  $ds_dormitoryZipcode="-";
                  $ds_dormitoryPhone="-";
                  $ds_dormitoryMyName="-";
                  $ds_FoodAllergies="-";
                  $ds_CongenitalDisease="-";
                  $ds_DrugAllergy="-";
                  $ds_trip="-";
                  $ds_triptxt="-";
                  $ds_FMstatus="-";
                  $ds_allergic="-"; 
                }
			}else{
                $ds_status="-";
                $ds_dormitoryName="-";
                $ds_dormitoryHno="-";
                $ds_dormitoryMoo="-";
                $ds_dormitorySoi="-";
                $ds_dormitoryRoad="-";
                $ds_dormitoryTumbon="-";
                $ds_dormitoryAmphur="-";
                $ds_dormitoryProvince="-";
                $ds_dormitoryZipcode="-";
                $ds_dormitoryPhone="-";
                $ds_dormitoryMyName="-";
                $ds_FoodAllergies="-";
                $ds_CongenitalDisease="-";
                $ds_DrugAllergy="-";
                $ds_trip="-";
                $ds_triptxt="-";
                $ds_FMstatus="-";
                $ds_allergic="-";
			}
            
                if(isset($ds_status)){
                    $this->ds_status=$ds_status;                    
                }else{}

                if(isset($ds_dormitoryName)){
                    $this->ds_dormitoryName=$ds_dormitoryName;                   
                }else{}

                if(isset($ds_dormitoryHno)){
                    $this->ds_dormitoryHno=$ds_dormitoryHno;                    
                }else{}

                if(isset($ds_dormitoryMoo)){
                    $this->ds_dormitoryMoo=$ds_dormitoryMoo;                    
                }else{}                
                
                if(isset($ds_dormitorySoi)){
                    $this->ds_dormitorySoi=$ds_dormitorySoi;                    
                }else{}
                
                if(isset($ds_dormitoryRoad)){
                    $this->ds_dormitoryRoad=$ds_dormitoryRoad;                    
                }else{}
                
                if(isset($ds_dormitoryTumbon)){
                    $this->ds_dormitoryTumbon=$ds_dormitoryTumbon;                    
                }else{}
                
                if(isset($ds_dormitoryAmphur)){
                    $this->ds_dormitoryAmphur=$ds_dormitoryAmphur;                    
                }else{}
            
                if(isset($ds_dormitoryProvince)){
                    $this->ds_dormitoryProvince=$ds_dormitoryProvince;                    
                }else{}
                
                if(isset($ds_dormitoryZipcode)){
                    $this->ds_dormitoryZipcode=$ds_dormitoryZipcode;                    
                }else{}
               
                if(isset($ds_dormitoryPhone)){
                    $this->ds_dormitoryPhone=$ds_dormitoryPhone;                    
                }else{}

                if(isset($ds_dormitoryMyName)){
                    $this->ds_dormitoryMyName=$ds_dormitoryMyName;                   
                }else{}  

                if(isset($ds_FoodAllergies)){
                    $this->ds_FoodAllergies=$ds_FoodAllergies;                   
                }else{}

                if(isset($ds_CongenitalDisease)){
                    $this->ds_CongenitalDisease=$ds_CongenitalDisease;                   
                }else{}

                if(isset($ds_DrugAllergy)){
                    $this->ds_DrugAllergy=$ds_DrugAllergy;                    
                }else{}    

                if(isset($ds_trip)){
                    $this->ds_trip=$ds_trip;                    
                }else{} 

                if(isset($ds_triptxt)){
                    $this->ds_triptxt=$ds_triptxt;                    
                }else{} 

                if(isset($ds_FMstatus)){
                    $this->ds_FMstatus=$ds_FMstatus;                    
                }else{}

                if(isset($ds_allergic)){
                    $this->ds_allergic=$ds_allergic;                    
                }else{}                 
                    $pdo_datastu=Null;                                                                                           
    }
    function __destruct(){
        if(isset($this->ds_status)){
            $this->ds_status;
        }else{}
        
        if(isset($this->ds_dormitoryName)){
            $this->ds_dormitoryName;
        }else{}
        
        if(isset($this->ds_dormitoryHno)){
            $this->ds_dormitoryHno;
        }else{}
        
        if(isset($this->ds_dormitoryMoo)){
            $this->ds_dormitoryMoo;
        }else{}

        if(isset($this->ds_dormitorySoi)){
            $this->ds_dormitorySoi;
        }else{}

        if(isset($this->ds_dormitoryRoad)){
            $this->ds_dormitoryRoad;
        }else{}

        if(isset($this->ds_dormitoryTumbon)){
            $this->ds_dormitoryTumbon;
        }else{}

        if(isset($this->ds_dormitoryAmphur)){
            $this->ds_dormitoryAmphur;
        }else{}   

        if(isset($this->ds_dormitoryProvince)){
            $this->ds_dormitoryProvince;
        }else{} 

        if(isset($this->ds_dormitoryZipcode)){
            $this->ds_dormitoryZipcode;
        }else{} 

        if(isset($this->ds_dormitoryPhone)){
            $this->ds_dormitoryPhone;
        }else{} 

        if(isset($this->ds_dormitoryMyName)){
            $this->ds_dormitoryMyName;
        }else{}         
          
        if(isset($this->ds_FoodAllergies)){
            $this->ds_FoodAllergies;
        }else{}        
 
        if(isset($this->ds_CongenitalDisease)){
            $this->ds_CongenitalDisease;
        }else{}

        if(isset($this->ds_DrugAllergy)){
            $this->ds_DrugAllergy;
        }else{}

        if(isset($this->ds_trip)){
            $this->ds_trip;
        }else{}        

        if(isset($this->ds_triptxt)){
            $this->ds_triptxt;
        }else{}  

        if(isset($this->ds_FMstatus)){
            $this->ds_FMstatus;
        }else{}  

        if(isset($this->ds_allergic)){
            $this->ds_allergic;
        }else{}          
         
	}
  }

//data_gohome
class data_gohome{
  public $txt_gohome;
      function __construct($txt_gohome){
      $this->txt_gohome=$txt_gohome;
	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
		 $data_gohomeSql="SELECT `dgh_id`, `dgh_txt` FROM `data_gohome` WHERE`dgh_id`='{$this->txt_gohome}'";
			if($data_gohomeRs=$pdo_datastu->query($data_gohomeSql)){
			   $data_gohomeRow=$data_gohomeRs->Fetch(PDO::FETCH_ASSOC);
         $dgh_id=$data_gohomeRow["dgh_id"];
         $dgh_txt=$data_gohomeRow["dgh_txt"];
			}else{
         $dgh_id="-";
         $dgh_txt="-";
      }
      $pdo_datastu=Null;
      $this->dgh_id=$dgh_id;
      $this->dgh_txt=$dgh_txt;
      }function __destruct(){
        $this->dgh_id;
        $this->dgh_txt;
		  }
}



//data_family

class data_family{
  public $txt_family;
        function __construct($txt_family){
        $this->txt_family=$txt_family;
        $db_evaluationID=$_SERVER['REMOTE_ADDR'];
        $connpdo_datastu=new count_conndatastu($db_evaluationID);
        $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
			$data_familySql="SELECT `family_key`,`family_txt` FROM `data_family` WHERE `family_key`='{$this->txt_family}';";
			if($data_familyRs=$pdo_datastu->query($data_familySql)){
                $data_familyRow=$data_familyRs->Fetch(PDO::FETCH_ASSOC);
                    if(is_array($data_familyRow) && count($data_familyRow)){
                        $family_key=$data_familyRow["family_key"];
                        $family_txt=$data_familyRow["family_txt"];                        
                    }else{
                        $family_key="-";
                        $family_txt="-";                        
                    }
			}else{
                $family_key="-";
                $family_txt="-"; 
            }
            
            if(isset($this->family_key)){
                $this->family_key=$family_key;    
            }else{}
            
            if(isset($this->family_txt)){
                $this->family_txt=$family_txt;    
            }else{}
                $pdo_datastu=Null;
        }function __destruct(){
            
            if(isset($this->family_key)){
                $this->family_key;
            }else{}
            
            if(isset($this->family_txt)){
                $this->family_txt;
            }else{}
      }
}





//stu_address
  class stu_address{
    public $stu_key;
    function __construct($stu_key){
      $this->stu_key=$stu_key;
	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
			$stu_addressSql="SELECT  `stu_hno`, `stu_moo`, `stu_soi`, `stu_road`, `stu_tumbon`, `stu_amphur`, `stu_province`, `stu_zipcode` FROM `stu_address` WHERE `stu_id`='{$this->stu_key}'";
			if($stu_addressRs=$pdo_datastu->query($stu_addressSql)){
                $stu_addressRow=$stu_addressRs->Fetch(PDO::FETCH_ASSOC);
                    if(is_array($stu_addressRow) && count($stu_addressRow)){
                        $stu_hno=$stu_addressRow["stu_hno"];
                        $stu_moo=$stu_addressRow["stu_moo"];
                        $stu_soi=$stu_addressRow["stu_soi"];
                        $stu_road=$stu_addressRow["stu_road"];
                        $stu_tumbon=$stu_addressRow["stu_tumbon"];
                        $stu_amphur=$stu_addressRow["stu_amphur"];
                        $stu_province=$stu_addressRow["stu_province"];
                        $stu_zipcode=$stu_addressRow["stu_zipcode"];                        
                    }else{
                        $stu_hno="-";
                        $stu_moo="-";
                        $stu_soi="-";
                        $stu_road="-";
                        $stu_tumbon="-";
                        $stu_amphur="-";
                        $stu_province="-";
                        $stu_zipcode="-";                        
                    }
			}else{
                $stu_hno="-";
                $stu_moo="-";
                $stu_soi="-";
                $stu_road="-";
                $stu_tumbon="-";
                $stu_amphur="-";
                $stu_province="-";
                $stu_zipcode="-";
            }
      $pdo_datastu=Null;
            if(isset($stu_hno)){
                $this->stu_hno=$stu_hno;
            }else{}
            if(isset($stu_moo)){
                $this->stu_moo=$stu_moo;
            }else{}            
            if(isset($stu_soi)){
                $this->stu_soi=$stu_soi;                
            }else{}           
            if(isset($stu_road)){
                $this->stu_road=$stu_road;                
            }else{}            
            if(isset($stu_tumbon)){
                $this->stu_tumbon=$stu_tumbon;                
            }else{}            
            if(isset($stu_amphur)){
                $this->stu_amphur=$stu_amphur;                
            }else{}           
            if(isset($stu_province)){
                $this->stu_province=$stu_province;                
            }else{}           
            if(isset($stu_zipcode)){
                $this->stu_zipcode=$stu_zipcode;                
            }else{}        
     }function __destruct(){
            if(isset($this->stu_hno)){
                $this->stu_hno;
            }else{}
            
            if(isset($this->stu_moo)){
                $this->stu_moo;
            }else{}
            
            if(isset($this->stu_soi)){
                $this->stu_soi;
            }else{}
            
            if(isset($this->stu_road)){
                $this->stu_road;
            }else{}
            
            if(isset($this->stu_tumbon)){
                $this->stu_tumbon;
            }else{}            

            if(isset($this->stu_amphur)){
                 $this->stu_amphur;
            }else{}

            if(isset($this->stu_province)){
                $this->stu_province;
            }else{}       
            
            if(isset($this->stu_zipcode)){
                $this->stu_zipcode;
            }else{}         
          
		}
    }


//stu_address_home

  class stu_address_home{
    public $stu_key;
    function __construct($stu_key){
      $this->stu_key=$stu_key;
	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
			$stu_address_homeSql="SELECT  `stu_reg_hno`, `stu_reg_moo`, `stu_reg_soi`, `stu_reg_road`, `stu_reg_tumbon`, `stu_reg_amphur`, `stu_reg_province`, `stu_reg_zipcode` FROM `stu_address_home` WHERE `stu_id`='{$this->stu_key}';";
			if($stu_address_homeRs=$pdo_datastu->query($stu_address_homeSql)){
			   $stu_address_homeRow=$stu_address_homeRs->Fetch(PDO::FETCH_ASSOC);
                    if(is_array($stu_address_homeRow) && count($stu_address_homeRow)){
                        $stu_reg_hno=$stu_address_homeRow["stu_reg_hno"];
                        $stu_reg_moo=$stu_address_homeRow["stu_reg_moo"];
                        $stu_reg_soi=$stu_address_homeRow["stu_reg_soi"];
                        $stu_reg_road=$stu_address_homeRow["stu_reg_road"];
                        $stu_reg_tumbon=$stu_address_homeRow["stu_reg_tumbon"];
                        $stu_reg_amphur=$stu_address_homeRow["stu_reg_amphur"];
                        $stu_reg_province=$stu_address_homeRow["stu_reg_province"];
                        $stu_reg_zipcode=$stu_address_homeRow["stu_reg_zipcode"];                        
                    }else{
                        $stu_reg_hno="-";
                        $stu_reg_moo="-";
                        $stu_reg_soi="-";
                        $stu_reg_road="-";
                        $stu_reg_tumbon="-";
                        $stu_reg_amphur="-";
                        $stu_reg_province="-";
                        $stu_reg_zipcode="-";                         
                    }

			}else{
                $stu_reg_hno="-";
                $stu_reg_moo="-";
                $stu_reg_soi="-";
                $stu_reg_road="-";
                $stu_reg_tumbon="-";
                $stu_reg_amphur="-";
                $stu_reg_province="-";
                $stu_reg_zipcode="-";
            }
            
            if(isset($stu_reg_hno)){
                $this->stu_reg_hno=$stu_reg_hno;
            }else{}
            if(isset($stu_reg_moo)){
                $this->stu_reg_moo=$stu_reg_moo;
            }else{}
            if(isset($stu_reg_soi)){
                $this->stu_reg_soi=$stu_reg_soi;
            }else{}
            if(isset($stu_reg_road)){
                $this->stu_reg_road=$stu_reg_road;
            }else{}
            if(isset($stu_reg_tumbon)){
                $this->stu_reg_tumbon=$stu_reg_tumbon;
            }else{} 
            if(isset($stu_reg_amphur)){
                $this->stu_reg_amphur=$stu_reg_amphur;
            }else{} 
            if(isset($stu_reg_province)){
                $this->stu_reg_province=$stu_reg_province;
            }else{} 
            if(isset($stu_reg_zipcode)){
                $this->stu_reg_zipcode=$stu_reg_zipcode;
            }else{}               
                $pdo_datastu=Null;
        }function __destruct(){
            if(isset($this->stu_reg_hno)){
                $this->stu_reg_hno;
            }else{}
            if(isset($this->stu_reg_moo)){
                $this->stu_reg_moo;
            }else{}
            if(isset($this->stu_reg_soi)){
                $this->stu_reg_soi;
            }else{}
            if(isset($this->stu_reg_road)){
                $this->stu_reg_road;
            }else{}
            if(isset($this->stu_reg_tumbon)){
                $this->stu_reg_tumbon;
            }else{}
            if(isset($this->stu_reg_amphur)){
                $this->stu_reg_amphur;
            }else{}            
            if(isset($this->stu_reg_province)){
                $this->stu_reg_province;
            }else{}
            if(isset($this->stu_reg_zipcode)){
                $this->stu_reg_zipcode;
            }else{}            
		}
    }

class data_disabled{
  public $txt_disablrd;
      function __construct($txt_disablrd){
      $this->txt_disablrd=$txt_disablrd;
	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
			$data_disabledSql="SELECT `disabled_txt` FROM `data_disabled` WHERE `disabled_id`='{$this->txt_disablrd}';";
			if($data_disabledRs=$pdo_datastu->query($data_disabledSql)){
			   $data_disabledRow=$data_disabledRs->Fetch(PDO::FETCH_ASSOC);
         $disabled_txt=$data_disabledRow["disabled_txt"];
			}else{
         $disabled_txt="-";
      }
      $pdo_datastu=Null;
      
        $this->disabled_txt=$disabled_txt;
      }function __destruct(){
        $this->disabled_txt;
		  }
}


  class rc_religion{
    public $txt_religion;
    function __construct($txt_religion){
      $this->txt_religion=$txt_religion;
	  $db_evaluationID=$_SERVER['REMOTE_ADDR'];
      $connpdo_datastu=new count_conndatastu($db_evaluationID);
	  $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
      $religionSql="SELECT `Religion` FROM `rc_religion` WHERE `IDReligion`='{$this->txt_religion}';";
      if($religionRs=$pdo_datastu->query($religionSql)){
         $religionRow=$religionRs->Fetch(PDO::FETCH_ASSOC);
			 if(is_array($religionRow) && count($religionRow)){
				 $Religion=$religionRow["Religion"];
			 }else{
				 $Religion="-";
			 }
      }else{
         $Religion="-";
      }
	  if(isset($Religion)){
		$this->Religion=$Religion;
	  }else{
		//-----------------------  
	  }
         $pdo_datastu=Null;
    }
      function __destruct(){
		  if(isset($this->Religion)){
			  $this->Religion;
		  }else{
			  //----------------------
		  }
      }
  }


	class stu_prefix{
		public $prefix;
		function __construct($prefix){
			$this->prefix=$prefix;
	        $db_evaluationID=$_SERVER['REMOTE_ADDR'];
            $connpdo_datastu=new count_conndatastu($db_evaluationID);
	        $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
	  
			$prefix_sql="SELECT `prefixname`,`prefix_SName`,`prefix_EName` FROM `rc_prefix` WHERE `IDPrefix`='{$this->prefix}'";
				if($prefix_rs=$pdo_datastu->query($prefix_sql)){
					$prefix_row=$prefix_rs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($prefix_row) && count($prefix_row)){
							$prefix_prefixname=$prefix_row["prefixname"];
							$prefix_prefix_SName=$prefix_row["prefix_SName"];
							$prefix_prefix_EName=$prefix_row["prefix_EName"];						
						}else{
							$prefix_prefixname="-";
							$prefix_prefix_SName="-";
							$prefix_prefix_EName="-";							
						}
				}else{
					$prefix_prefixname="-";
					$prefix_prefix_SName="-";
					$prefix_prefix_EName="-";
				}
				if(isset($prefix_prefixname)){
					$this->prefix_prefixname=$prefix_prefixname;
					$this->prefix_prefix_SName=$prefix_prefix_SName;
					$this->prefix_prefix_EName=$prefix_prefix_EName;					
				}else{
					//----------------------------------------------
				}
			$pdo_datastu=Null;
		}function __destruct(){
			if(isset($this->prefix_prefixname)){
				$this->prefix_prefixname;
				$this->prefix_prefix_SName;
				$this->prefix_prefix_EName;				
			}else{
				//--------------------------------------------------
			}
		}
	}
?>


<?php
	class data_rely{
		public $txt_rely;
		function __construct($txt_rely){
			$this->txt_rely=$txt_rely;
	        $db_evaluationID=$_SERVER['REMOTE_ADDR'];
            $connpdo_datastu=new count_conndatastu($db_evaluationID);
	        $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
			$relySql="SELECT `dr_key`, `dr_txt` FROM `data_rely` WHERE`dr_key`='{$this->txt_rely}'";
				if($relyRs=$pdo_datastu->query($relySql)){
					$relyRow=$relyRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($relyRow) && count($relyRow)){
							$dr_key=$relyRow["dr_key"];
							$dr_txt=$relyRow["dr_txt"];							
						}else{
							$dr_key="-";
							$dr_txt="-";							
						}
				}else{
					$dr_key="-";
					$dr_txt="-";
				}
				if(isset($dr_key)){
					$this->dr_key=$dr_key;
					$this->dr_txt=$dr_txt;					
				}else{
					//----------------------------------------------
				}
					$pdo_datastu=Null;
		}function __destruct(){
			if(isset($this->dr_key)){
				$this->dr_key;
				$this->dr_txt;				
			}else{
				//---------------------------------------------------
			}
		}
	}
?>



<?php
	class db_country{
		public $txt_set;
		function __construct($txt_set){
			$this->txt_set=$txt_set;
			$evaluation_array=array();
	        $db_evaluationID=$_SERVER['REMOTE_ADDR'];
            $connpdo_datastu=new count_conndatastu($db_evaluationID);
	        $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
			$countrySql="SELECT `nation_name_th` FROM `db_country` WHERE `id`='{$this->txt_set}'";
				if($countryRs=$pdo_datastu->query($countrySql)){
					$countryRow=$countryRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($countryRow) && count($countryRow)){
							$nation_name_th=$countryRow["nation_name_th"];
						}else{
							$nation_name_th="-";
						}
				}else{
					$nation_name_th="-";
				}
				if(isset($nation_name_th)){
					$this->nation_name_th=$nation_name_th;
				}else{
					//------------------------------------------------------
				}
				$pdo_datastu=Null;	
		}function __destruct(){
			if(isset($this->nation_name_th)){
				$this->nation_name_th;
			}else{
				//-----------------------------------------------------------
			}
		}
	}
?>


<?php
//Subdistrict ตำบล
	class data_Subdistrict{
		public $key_Subdistrict;
		function __construct($key_Subdistrict){
			$this->key_Subdistrict=$key_Subdistrict;
	        $db_evaluationID=$_SERVER['REMOTE_ADDR'];
            $connpdo_datastu=new count_conndatastu($db_evaluationID);
	        $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
			$SubdistrictSql="SELECT `DISTRICT_NAME`,`DISTRICT_NAME_ENG` FROM `districts` WHERE `DISTRICT_ID`='{$this->key_Subdistrict}'";
				if($SubdistrictRs=$pdo_datastu->query($SubdistrictSql)){
					$SubdistrictRow=$SubdistrictRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($SubdistrictRow) && count($SubdistrictRow)){
							$DISTRICT_NAME=$SubdistrictRow["DISTRICT_NAME"];
							$DISTRICT_NAME_ENG=$SubdistrictRow["DISTRICT_NAME_ENG"];						
						}else{
							$DISTRICT_NAME="-";
							$DISTRICT_NAME_ENG="-";						
						}
				}else{
					$DISTRICT_NAME="-";
					$DISTRICT_NAME_ENG="-";					
				}
			
				if(isset($DISTRICT_NAME)){
					$this->DISTRICT_NAME=$DISTRICT_NAME;
					$this->DISTRICT_NAME_ENG=$DISTRICT_NAME_ENG;					
				}else{
					//------------------------------------------
				}
			$pdo_datastu=Null;
		}function __destruct(){
			if(isset($this->DISTRICT_NAME)){
				$this->DISTRICT_NAME;
				$this->DISTRICT_NAME_ENG;				
			}else{
				//--------------------------
			}
		}
	}
//Subdistrict

//District อำเภอ
	class data_District{
		public $key_District;
		function __construct($key_District){
			$this->key_District=$key_District;
	        $db_evaluationID=$_SERVER['REMOTE_ADDR'];
            $connpdo_datastu=new count_conndatastu($db_evaluationID);
	        $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
			$DistrictSql="SELECT `AMPHUR_NAME`,`AMPHUR_NAME_ENG` FROM `amphures` WHERE `AMPHUR_ID`='{$this->key_District}'";
				if($DistrictRs=$pdo_datastu->query($DistrictSql)){
					$DistrictRow=$DistrictRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($DistrictRow) && count($DistrictRow)){
							$AMPHUR_NAME=$DistrictRow["AMPHUR_NAME"];
							$AMPHUR_NAME_ENG=$DistrictRow["AMPHUR_NAME_ENG"];						
						}else{
							$AMPHUR_NAME="-";
							$AMPHUR_NAME_ENG="-";						
						}
				}else{
					$AMPHUR_NAME="-";
					$AMPHUR_NAME_ENG="-";					
				}
				if(isset($AMPHUR_NAME)){
					$this->AMPHUR_NAME=$AMPHUR_NAME;
					$this->AMPHUR_NAME_ENG=$AMPHUR_NAME_ENG;					
				}else{
					//--------------------------------------
				}
				$pdo_datastu=Null;
		}function __destruct(){
			if(isset($this->AMPHUR_NAME)){
				$this->AMPHUR_NAME;
				$this->AMPHUR_NAME_ENG;				
			}else{
				//------------------------------------------
			}
		}
	}
//District

//Province จังหวัด
	class data_Province{
		public $key_Province;
		function __construct($key_Province){
			$this->key_Province=$key_Province;
	        $db_evaluationID=$_SERVER['REMOTE_ADDR'];
            $connpdo_datastu=new count_conndatastu($db_evaluationID);
	        $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
			$ProvinceSql="SELECT `PROVINCE_NAME`,`PROVINCE_NAME_ENG` FROM `provinces`WHERE`PROVINCE_ID`='{$this->key_Province}'";
				if($ProvinceRs=$pdo_datastu->query($ProvinceSql)){
					$ProvinceRow=$ProvinceRs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($ProvinceRow) && count($ProvinceRow)){
							$PROVINCE_NAME=$ProvinceRow["PROVINCE_NAME"];
							$PROVINCE_NAME_ENG=$ProvinceRow["PROVINCE_NAME_ENG"];						
						}else{
							$PROVINCE_NAME="-";
							$PROVINCE_NAME_ENG="-";
						}
				}else{
					$PROVINCE_NAME="-";
					$PROVINCE_NAME_ENG="-";				
				}
				if(isset($PROVINCE_NAME)){
					$this->PROVINCE_NAME=$PROVINCE_NAME;
					$this->PROVINCE_NAME_ENG=$PROVINCE_NAME_ENG;					
				}else{
					//------------------------------------------
				}
				$pdo_datastu=Null;
		}function __destruct(){
			if(isset($this->PROVINCE_NAME)){
				$this->PROVINCE_NAME;
				$this->PROVINCE_NAME_ENG;
			}else{
				//----------------------------------------------
			}
		}
	}
//Province

?>




<?php


//insert_evaluation
	class insert_datastu{
		public $evaluation_sql;
		function __construct($evaluation_sql){
			$this->evaluation_sql=$evaluation_sql;
			
	        $db_evaluationID=$_SERVER['REMOTE_ADDR'];
            $connpdo_datastu=new count_conndatastu($db_evaluationID);
	        $pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
						
			$sql=$this->evaluation_sql;
			if($pdo_datastu->exec($sql)>0){
				$system_insert="yes";
			}else{
				$system_insert="no";
			}
			unset($pdo_datastu);
			$this->system_insert=$system_insert;
		}
		function __destruct(){
			$this->system_insert;
		}
		
	}


	class  dateofbirth{
		public $birthdate;
		function __construct($birthdate){
			$this->birthdate=$birthdate;
			$today = date('d-m-Y');
			list($bday,$bmonth,$byear) = explode('-',$this->birthdate);
			list($tday,$tmonth,$tyear) = explode('-',$today);
				if($byear < 1970){
					$yearad = 1970 - $byear;
					$byear = 1970;
				}else{
					$yearad = 0;
				}
			$mbirth = mktime(0,0,0, $bmonth,$bday,$byear);
			$mtoday = mktime(0,0,0, $tmonth,$tday,$tyear);
			
			$mage = ($mtoday - $mbirth);
			$wyear = (date('Y', $mage)-1970+$yearad);
			$wmonth = (date('m', $mage)-1);
			$wday = (date('d', $mage)-1);
			
			$ystr = ($wyear > 1 ? " ปี" : " ปี");
			$mstr = ($wmonth > 1 ? " เดือน" : " เดือน");
			$dstr = ($wday > 1 ? " วัน" : " วัน");
			
			if($wyear > 0 && $wmonth > 0 && $wday > 0) {
				$agestr = $wyear.$ystr." ".$wmonth.$mstr." ".$wday.$dstr;
			}else if($wyear == 0 && $wmonth == 0 && $wday > 0) {
				$agestr = $wday.$dstr;
				//$wyear=0;
				//$wmonth=0;
			}else if($wyear > 0 && $wmonth > 0 && $wday == 0) {
				$agestr = $wyear.$ystr." ".$wmonth.$mstr;
				//$wday=0;
			}else if($wyear == 0 && $wmonth > 0 && $wday > 0) {
				$agestr = $wmonth.$mstr." ".$wday.$dstr;
				//$wyear=0;
			}else if($wyear > 0 && $wmonth == 0 && $wday > 0) {
				$agestr = $wyear.$ystr." ".$wday.$dstr;
				//$wmonth=0;
			}else if($wyear == 0 && $wmonth > 0 && $wday == 0) {
				$agestr = $wmonth.$mstr;
				//$wyear=0;
				//$wday=0;
			}else {
				$agestr ="";
				//$wyear="";
				//$wmonth="";
				//$wday="";
			}
			$this->wyear=$wyear;
			$this->wmonth=$wmonth;
			$this->wday=$wday;
			$this->ystr=$ystr;
			$this->agestr=$agestr;
		}function __destruct(){
			$this->wyear;
			$this->wmonth;
			$this->wday;
			$this->ystr;
			$this->agestr;
		}
	}

	class income{
		public $txt_income;
		function __construct($txt_income){
			$this->txt_income=$txt_income;
			if($this->txt_income==1){
				$print_income="ต่ำกว่า 15,000";
			}elseif($this->txt_income==2){
				$print_income="15,001-30,000";
			}elseif($this->txt_income==3){
				$print_income="30,001-50,000";
			}elseif($this->txt_income==4){
				$print_income="มากกว่า 50,000";
			}elseif($this->txt_income==5){
				$print_income="ไม่มีรายได้";
			}else{
				$print_income="";
			}
			$this->print_income=$print_income;
		}function __destruct(){
			$this->print_income;
		}
	}

		class notrow_datastu{
			public $txt_datastu;
			function __construct($txt_datastu){
				$this->txt_datastu=$txt_datastu;
				$datastu_array=array();
				$db_evaluationID=$_SERVER['REMOTE_ADDR'];
				$connpdo_datastu=new count_conndatastu($db_evaluationID);
				$pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
				$datastu_sql=$this->txt_datastu;
					if($datastu_rs=$pdo_datastu->query($datastu_sql)){
						$datastu_row=$datastu_rs->Fetch(PDO::FETCH_ASSOC);
						$datastu_array[]=$datastu_row;
					}else{
				
					}
						$pdo_datastu=Null;
						$this->datastu_array=$datastu_array;
				}function __destruct(){
					$this->datastu_array;
			}
		}
		
			class  row_datastu{
			public $txt_datastu;
			function __construct($txt_datastu){
				$this->txt_datastu=$txt_datastu;
				$datastu_array=array();
				$db_evaluationID=$_SERVER['REMOTE_ADDR'];
				$connpdo_datastu=new count_conndatastu($db_evaluationID);
				$pdo_datastu=$connpdo_datastu->call_coun_conndatastu();
				$datastu_sql=$this->txt_datastu;
					if($datastu_rs=$pdo_datastu->query($datastu_sql)){
						while($datastu_row=$datastu_rs->Fetch(PDO::FETCH_ASSOC)){
							$datastu_array[]=$datastu_row;
						}
					}else{
				
					}
						$pdo_datastu=Null;
						$this->datastu_array=$datastu_array;
				}function __destruct(){
					$this->datastu_array;
			}
		}
?>