<?php
	
	include("../../../../database/pdo_conndatastu.php");
	include("../../../../database/class_pdodatastu.php");
	
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");
	
	include("../../../../database/database_paynew.php");
	include("../../../../database/class_pay.php");
	
	$count_setpay=count($_POST["fee_set"]);
	$count_set=0;
	
	while($count_set<$count_setpay){
			
		$txt_plan=$_POST["txt_plan"][$count_set];
		$txt_level=$_POST["txt_level"][$count_set];
		$fee_set=$_POST["fee_set"][$count_set];
		
//***********************************************************
		$pay_datafeeSql="UPDATE `pay_datafee` 
		                 SET `pdf_pay`='{$fee_set}' 
						 WHERE `pdf_plan`='{$txt_plan}' 
						 and `pdf_level`='{$txt_level}';";   
		$pay_datafee=new into_pay($pay_datafeeSql);	
		
		if($pay_datafee->system_pay=="yes"){
			//***********************************************
		}else{
			//***********************************************			
		}
//***********************************************************		
		$count_set=$count_set+1;
	}
		exit("<script>window.location='../../../../../?evaluation_mod=fee_pay_set';</script>");
?>



