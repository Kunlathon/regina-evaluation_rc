<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
	include("view/database/pdo_weekend.php");
	include("view/database/class_weekend.php");
//--------------------------------------------------------------------
//--------------------------------------------------------------------
		if($this->session->userdata("rc_user")==null){
			$this->session->unset_userdata("rc_user");
			exit("<script>window.location='$golink/print_imgstu/error';</script>");
		}else{ 
			$WcKey=filter_input(INPUT_POST,'WcKey');
			$WcTxt=filter_input(INPUT_POST,'WcTxt');
			$WcT=filter_input(INPUT_POST,'WcT');
			$WcY=filter_input(INPUT_POST,'WcY');
			$WcSud=filter_input(INPUT_POST,'WcSud');
			$WcClass=filter_input(INPUT_POST,'WcClass');
			$WctKey=filter_input(INPUT_POST,'WctKey');
			$WcrLearn=filter_input(INPUT_POST,'WcrLearn');
			$WcrTime=date("Y-m-d H:i:s");
				if($WcrLearn=="A"){
					//if(isset($_POST["WcTestKey"]){
						$WcTestKey=filter_input(INPUT_POST,'WcTestKey');
						$WctTestKey=filter_input(INPUT_POST,'WctTestKey');
						$AddWeekendClassA=new AddWeekendClass($WcSud,$WcT,$WcY,$WcrTime,$WcTestKey,$WctTestKey,$WcrLearn);
							if($AddWeekendClassA->RunAddWeekendClass()=="Y"){
								$AddWeekendClassB=new AddWeekendClass($WcSud,$WcT,$WcY,$WcrTime,$WcKey,$WctKey,$WcrLearn);
									if($AddWeekendClassB->RunAddWeekendClass()=="Y"){
										$Error="e7fed1944be880f14a7335eac65e2cc2";
									}elseif($AddWeekendClassB->RunAddWeekendClass()=="N"){
										$Error="cb5e100e5a9a3e7f6d1fd97512215282";
									}else{
										$Error="cb5e100e5a9a3e7f6d1fd97512215282";
									}
							}elseif($AddWeekendClassA->RunAddWeekendClass()=="N"){
								$Error="cb5e100e5a9a3e7f6d1fd97512215282";
							}
						exit("<script>window.location='$golink/?evaluation_mod=weekend_class&rc=$Error';</script>");
						/*}else{
							$Error="cb5e100e5a9a3e7f6d1fd97512215282";
						}*/
					//exit("<script>window.location='$golink/?evaluation_mod=weekend_class';</script>");
				}elseif($WcrLearn=="B"){
					$AddWeekendClassB=new AddWeekendClass($WcSud,$WcT,$WcY,$WcrTime,$WcKey,$WctKey,$WcrLearn);					
						if($AddWeekendClassB->RunAddWeekendClass()=="Y"){
							$Error="e7fed1944be880f14a7335eac65e2cc2";
						}elseif($AddWeekendClassB->RunAddWeekendClass()=="N"){
							$Error="cb5e100e5a9a3e7f6d1fd97512215282";
						}else{
							$Error="cb5e100e5a9a3e7f6d1fd97512215282";
						}
					exit("<script>window.location='$golink/?evaluation_mod=weekend_class&rc=$Error';</script>");	
				}elseif($WcrLearn=="C"){
					
						$WctTimeA=filter_input(INPUT_POST,'WctTimeA');
						$WctTimeB=filter_input(INPUT_POST,'WctTimeB');		
						$TestWeekendRc=new PrintWeekendClassRc($WcSud,$WcT,$WcY,"Array2");
						foreach($TestWeekendRc->RunPrintWeekendClassRc() as $rc=>$TestWeekendRcRow){
							
							$DataWeekendClassTime=new DataWeekendClassTime($TestWeekendRcRow["weekend_class_time_wct_key"],$TestWeekendRcRow["wcr_t"],$TestWeekendRcRow["wcr_y"]);
							if($WctTimeA==$DataWeekendClassTime->wct_timeA){
								$ErrorTime="Error";
								break;
							}elseif($WctTimeB==$DataWeekendClassTime->wct_timeB){
								$ErrorTime="Error";
								break;								
							}else{
								$ErrorTime="NotError";
							}
						}
												
						if(!isset($ErrorTime)){
							
							$AddWeekendClassC=new AddWeekendClass($WcSud,$WcT,$WcY,$WcrTime,$WcKey,$WctKey,$WcrLearn);
								if($AddWeekendClassC->RunAddWeekendClass()=="Y"){
									$Error="e7fed1944be880f14a7335eac65e2cc2";
								}elseif($AddWeekendClassC->RunAddWeekendClass()=="N"){
									$Error="cb5e100e5a9a3e7f6d1fd97512215282";
								}else{
									$Error="cb5e100e5a9a3e7f6d1fd97512215282";
								}
								
						}elseif($ErrorTime=="Error"){
							$Error="cb5e100e5a9a3e7f6d1fd97512215282";
						}else{
							
							$AddWeekendClassC=new AddWeekendClass($WcSud,$WcT,$WcY,$WcrTime,$WcKey,$WctKey,$WcrLearn);
								if($AddWeekendClassC->RunAddWeekendClass()=="Y"){
									$Error="e7fed1944be880f14a7335eac65e2cc2";
								}elseif($AddWeekendClassC->RunAddWeekendClass()=="N"){
									$Error="cb5e100e5a9a3e7f6d1fd97512215282";
								}else{
									$Error="cb5e100e5a9a3e7f6d1fd97512215282";
								}							
							
						}
					exit("<script>window.location='$golink/?evaluation_mod=weekend_class&rc=$Error';</script>");
				}else{
					$this->session->unset_userdata("rc_user");
					exit("<script>window.location='$golink/print_imgstu/error';</script>");
				}
		}
		 
		?>
		
		