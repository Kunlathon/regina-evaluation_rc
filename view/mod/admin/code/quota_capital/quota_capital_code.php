<?php
	include("../../../../database/pdo_quota.php");
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_quota.php");
	
	
	//$copy_year=filter_input(INPUT_POST,'copy_year');
	//$copy_level=filter_input(INPUT_POST,'copy_level');
	
	$txt_year=filter_input(INPUT_POST,'txt_year');
	$txt_level=filter_input(INPUT_POST,'txt_level');
	
	$txt_capital=filter_input(INPUT_POST,'txt_capital');
	
	$txt_yearnext=$txt_year+1;
	
	switch($txt_level){
		case "23":
			$txt_levelnext="31";
		break;
		
		default:
			$txt_levelnext="41";
	}
	
	
	$copy_yearnew=$txt_year+1;
	if($txt_year=="" and $txt_level==""){
		$txt_call="qac01";
	}elseif($txt_year=="" or $txt_level==""){
		$txt_call="qac01";
	}else{
//Delete
		$delete_quota_capitalSql="DELETE FROM `quota_capital` WHERE `qc_year`='{$txt_yearnext}' and `qc_level`='{$txt_levelnext}' and `qcs_key`='{$txt_capital}';";
		$delete_quota_capital=new insert_quota($delete_quota_capitalSql);
		if($delete_quota_capital->print_insertQuota()=="yes"){
			if(is_array($_POST['data_stu']) && count($_POST['data_stu'])){
				$keey_count=count($_POST["data_stu"]);
				$run_count=0;
				while($run_count<$keey_count){
					$data_stu=$_POST["data_stu"][$run_count];
//---------------------------------------------------------------------------------					
				$plan_sql="SELECT `qr_stuid` 
						   FROM `quota_request` 
						   WHERE`request_stuid`='{$data_stu}' 
						   and `request_year`='{$txt_yearnext}' 
						   and `request_level`='{$txt_levelnext}'";
				$plan_rs=new row_quotanotarray($plan_sql);
				foreach($plan_rs->print_quotanotarray() as $rc_key=>$plan_row){
					if(is_array($plan_row) && count($plan_row)){
						$qr_stuid=$plan_row["qr_stuid"];
					}else{
						$qr_stuid=Null;
					}
				}	
//quota_capital
				$into_quota_capitalSql="INSERT INTO `quota_capital` (`qc_stuid`, `qc_year`, `qc_level`, `qc_plan`, `qcs_key`) VALUES ('{$data_stu}', '{$txt_yearnext}', '{$txt_levelnext}', '{$qr_stuid}', '{$txt_capital}');";
					$into_quota_capital=new insert_quota($into_quota_capitalSql);
					if($into_quota_capital->print_insertQuota()=="yes"){
						//*********************************************************
					}else{
						//*********************************************************
					}					
//---------------------------------------------------------------------------------					
					$run_count=$run_count+1;
				}					
				$txt_call="qac02";
			}else{
				$txt_call="qac03";	
			}
		}else{
			if(is_array($_POST['data_stu']) && count($_POST['data_stu'])){
				$keey_count=count($_POST["data_stu"]);
				$run_count=0;
				while($run_count<$keey_count){
					$data_stu=$_POST["data_stu"][$run_count];
//---------------------------------------------------------------------------------					
				$plan_sql="SELECT `qr_stuid` 
						   FROM `quota_request` 
						   WHERE`request_stuid`='{$data_stu}' 
						   and `request_year`='{$txt_yearnext}' 
						   and `request_level`='{$txt_levelnext}'";
				$plan_rs=new row_quotanotarray($plan_sql);
				foreach($plan_rs->print_quotanotarray() as $rc_key=>$plan_row){
					if(is_array($plan_row) && count($plan_row)){
						$qr_stuid=$plan_row["qr_stuid"];
					}else{
						$plan_row=null;
					}
				}
				
//quota_capital
					$into_quota_capitalSql="INSERT INTO `quota_capital` (`qc_stuid`, `qc_year`, `qc_level`, `qc_plan`, `qcs_key`) VALUES ('{$data_stu}', '{$txt_yearnext}', '{$txt_levelnext}', '{$qr_stuid}', '{$txt_capital}');";
					$into_quota_capital=new insert_quota($into_quota_capitalSql);
					if($into_quota_capital->print_insertQuota()=="yes"){
						//*********************************************************
					}else{
						//*********************************************************
					}					
//---------------------------------------------------------------------------------
					$run_count=$run_count+1;
				}					
				$txt_call="qac02";			
			}else{
				$txt_call="qac03";
			}				
		}		
	}
	
	$txt_call=base64_encode($txt_call);
	
	exit("<script>window.location='../../../../../?evaluation_mod=quota_capital&txt_call=$txt_call';</script>");
?>