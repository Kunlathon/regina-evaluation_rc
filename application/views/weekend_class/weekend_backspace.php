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
//--------------------------------------------------------------------			
			$DeleteSudKey=filter_input(INPUT_POST,'DeleteSudKey');
			$DeleteWcTxt=filter_input(INPUT_POST,'DeleteWcTxt');
			$DeleteWcKey=filter_input(INPUT_POST,'DeleteWcKey');
			$DeleteWcT=filter_input(INPUT_POST,'DeleteWcT');
			$DeleteWcY=filter_input(INPUT_POST,'DeleteWcY');
//--------------------------------------------------------------------			
			$DeleteLearn=filter_input(INPUT_POST,'DeleteLearn');
				if($DeleteLearn=="A"){
					$PrintWeekendClassRc=new PrintWeekendClassRc($DeleteSudKey,$DeleteWcT,$DeleteWcY,"Array2");
					foreach($PrintWeekendClassRc->RunPrintWeekendClassRc() as $rc=>$PrintWeekendClassRcRow){
						$DeletEweekendClass=new DeletEweekendClassRc($PrintWeekendClassRcRow["wcr_key"],$PrintWeekendClassRcRow["weekend_class_wc_key"],$PrintWeekendClassRcRow["wcr_t"],$PrintWeekendClassRcRow["wcr_y"]);						
					}
				}else{
					$DeletEweekendClass=new DeletEweekendClassRc($DeleteSudKey,$DeleteWcKey,$DeleteWcT,$DeleteWcY);					
				}
//--------------------------------------------------------------------						
		}	 
	?>