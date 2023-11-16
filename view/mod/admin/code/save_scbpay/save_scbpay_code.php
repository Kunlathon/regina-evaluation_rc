<?php
	
	include("../../../../database/pdo_conndatastu.php");
	include("../../../../database/class_pdodatastu.php");
	
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");
	
	include("../../../../database/database_paynew.php");
	include("../../../../database/class_pay.php");
	
?>


<?php

	$p_mysavetxt=filter_input(INPUT_POST,'p_mysavetxt');
	$p_mysaveid=filter_input(INPUT_POST,'p_mysaveid');
	$p_mysaveAdmin=filter_input(INPUT_POST,'p_mysaveAdmin');
	$p_mysaveTime=date("Y-m-d H:i:s");

	$doshowmysaveSql="SELECT count(`p_mysaveid`) as `ini_mysave` FROM `pay_mysave` WHERE `p_mysaveid`='202001'";
	$doshowmysaveRs=new pdo_notpay($doshowmysaveSql); 
	
	foreach($doshowmysaveRs->call_pdonotpay() as $pay_rc=>$doshowmysaveRow){
		$ini_mysave=$doshowmysaveRow["ini_mysave"];
			if($ini_mysave>=1){
				$update_mysavepaySql="UPDATE `pay_mysave` 
				                      SET `p_mysavetxt`='{$p_mysavetxt}',`p_mysaveAdmin`='{$p_mysaveAdmin}',`p_mysaveTime`='{$p_mysaveTime}' 
									  WHERE `p_mysaveid`='202001';";
				$update_mysavepay=new into_pay($update_mysavepaySql);
					if($update_mysavepay->system_pay=="yes"){
						exit("<script>window.location='../../../../../?evaluation_mod=save_scbpay';</script>");
					}else{
						exit("<script>window.location='../../../../../?evaluation_mod=save_scbpay';</script>");					
					}
			}else{
				$into_mysavepaySql="INSERT INTO `pay_mysave` (`p_mysaveid`, `p_mysavetxt`, `p_mysaveAdmin`, `p_mysaveTime`)
									VALUES ('202001', '{$p_mysavetxt}', '{$p_mysaveAdmin}', '{$p_mysaveTime}');";
				$into_mysavepay=new into_pay($into_mysavepaySql);
					if($into_mysavepay->system_pay=="yes"){
						exit("<script>window.location='../../../../../?evaluation_mod=save_scbpay';</script>");								
					}else{
						exit("<script>window.location='../../../../../?evaluation_mod=save_scbpay';</script>");							
					}
			}
	}
?>