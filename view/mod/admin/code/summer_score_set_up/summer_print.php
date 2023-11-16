<?php
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");
	include("../../../../database/pdo_summer.php");
	include("../../../../database/class_summer.php");		

		$RdYear=filter_input(INPUT_POST,'txtyear');
		$RdClass=filter_input(INPUT_POST,'txtclass');
		$RdRssubject=filter_input(INPUT_POST,'txtrssubject');
		$RdScore=filter_input(INPUT_POST,'txtscore');
		$RdUesr=filter_input(INPUT_POST,'txtuesr');
		$Rdtype=filter_input(INPUT_POST,'txttype');
			if(isset($RdYear,$RdClass,$RdRssubject,$RdScore,$RdUesr)){	
				$IntoSummerSetUpScore=new ManagementScoreSummer($RdRssubject,"1",$RdYear,$RdScore,$RdUesr,$Rdtype);
			}else{}
?>