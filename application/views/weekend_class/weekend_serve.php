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
		$WS_TxtTh=filter_input(INPUT_POST,'WS_TxtTh');
		$WS_Pay=filter_input(INPUT_POST,'WS_Pay');
		$WS_Key=filter_input(INPUT_POST,'WS_Key');
		$WS_T=filter_input(INPUT_POST,'WS_T');
		$WS_Y=filter_input(INPUT_POST,'WS_Y');
		$WS_C=filter_input(INPUT_POST,'WS_C');
		$WS_No=filter_input(INPUT_POST,'WS_No');
		$WS_System=filter_input(INPUT_POST,'WS_System');
		//echo $WS_TxtTh."<br>".$WS_Pay."<br>".$WS_Key."<br>".$WS_T."<br>".$WS_Y."<br>".$WS_C."<br>".$WS_No."<br>".$WS_System;
		$RunServeWeek=new AddDeleteUserServeWeek($WS_Key,$WS_Y,$WS_T,$WS_C,$WS_No,$WS_Pay,$WS_System);
		//echo $RunServeWeek->RunAddDeleteUserServeWeek();
		exit("<script>window.location='$golink/?evaluation_mod=weekend_class';</script>");
	}
?>