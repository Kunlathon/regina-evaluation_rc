<meta charset="utf-8">

<?php

		$datetime="2020-01-15 00:00:00";
		$datetime_cr=date("Y-m-d H:i:s");
		
		//$txt_T=1;
		//$txt_Y=2562;
		
		$datatime_notrun=strtotime($datetime);
		$datatime_run=strtotime($datetime_cr);
		
		if($datatime_run>=$datatime_notrun){
			$print_runtime="OFF";
		}else{
			$print_runtime="ON";
		}
			
			if($print_runtime=="OFF"){
				exit("<meta charset='utf-8'/><script>alert('ปิดโหวตคุณครูในดวงใจของหนู');location.href='../../../../?evaluation_mod=favorite_teacher';</script>");
			}else{ ?>
<!--*******************************************************-->

<?php
	$yaer=2562;
	$datetime=date("Y-m-d H:i:s");
	include("../../../database/database_evaluation.php");
	$rcdata_connect=connect();
//-------------------------------------------------------	
	if(isset($_POST["code_system"])){
		$code_system=$_POST["code_system"];
			if($code_system=="add"){ 
				$ft_student=post_data($_POST["ft_student"]);
				$tt_key=post_data($_POST["tt_key"]);
				$tt_rc=post_data($_POST["tt_rc"]);
				$ttg_key=post_data($_POST["ttg_key"]);
				$ft_reason=post_data($_POST["ft_reason"]); //เหตุผล----------			
			?>
<!--**************************************************************************************-->
	<?php
//สร้างรหัส
		$ft_key="$tt_rc$ft_student";
		
//ตรวจสอบสถานะการประเมิน
		
		$check_results="SELECT count(`ft_key`) as count_ft 
					    FROM `favorite_teacher` 
						WHERE `ft_student`='{$ft_student}' and `ft_year`='{$yaer}'";
		$check_resultsRs=$rcdata_connect->query($check_results) or die($rcdata_connect->error);
			if($check_resultsRs->num_rows > 0){
				$check_resultsRow=$check_resultsRs->fetch_assoc();
				$count_ft=$check_resultsRow["count_ft"];
			}else{
				$count_ft=0;
			}
		if($count_ft>=3){
			exit("<meta charset='utf-8'/><script>alert('จำนวนคะแนนโหวตครบแล้ว');location.href='../../../../?evaluation_mod=favorite_teacher';</script>");
		}else{ ?>
<!--**************************************************************************************-->
<?php
	$favorite_teacher="INSERT INTO `favorite_teacher` (`ft_key`, `ft_year`, `ft_score`, `ft_reason`, `ft_datetime`, `ft_student`, `tt_key`, `tt_rc`, `ttg_key`)
                       VALUES ('{$ft_key}', '{$yaer}', '1', '{$ft_reason}', '{$datetime}', '{$ft_student}', '{$tt_key}', '{$tt_rc}', '{$ttg_key}');";
	$favorite_teacherCr=add_rc($favorite_teacher);
	if($favorite_teacherCr=="yes"){
		exit("<meta charset='utf-8'/><script>alert('โหวตสำเร็จ');location.href='../../../../?evaluation_mod=favorite_teacher';</script>");
	}else{
		exit("<meta charset='utf-8'/><script>alert('โหวตไม่สำเร็จ');location.href='../../../../?evaluation_mod=favorite_teacher';</script>");
	}
?>
<!--**************************************************************************************-->			
<?php	}?>
<!--**************************************************************************************-->			
<?php		}elseif($code_system=="delete"){ ?>
<!--**************************************************************************************-->
<?php
		$ft_key=post_data($_POST["ft_key"]);
		if(isset($ft_key)){
			if($ft_key!=""){
				$favorite_delete="DELETE FROM `favorite_teacher` WHERE `ft_key`='{$ft_key}' and `ft_year`='{$yaer}'";
				$favorite_deleteRs=add_rc($favorite_delete);
				if($favorite_deleteRs=="yes"){
					exit("<meta charset='utf-8'/><script>alert('แก้ไขรายการสำเร็จ');location.href='../../../../?evaluation_mod=favorite_teacher';</script>");
				}else{
					exit("<meta charset='utf-8'/><script>alert('แก้ไขรายการไม่สำเร็จ');location.href='../../../../?evaluation_mod=favorite_teacher';</script>");
				}
			}else{
				exit("<meta charset='utf-8'/><script>alert('แก้ไขรายการไม่สำเร็จ');location.href='../../../../?evaluation_mod=favorite_teacher';</script>");
			}
		}else{
			exit("<meta charset='utf-8'/><script>alert('แก้ไขรายการไม่สำเร็จ');location.href='../../../../?evaluation_mod=favorite_teacher';</script>");
		}
?>
<!--**************************************************************************************-->			
<?php		}else{
			exit("<meta charset='utf-8'/><script>alert('โหวตไม่สำเร็จ');location.href='../../../../?evaluation_mod=favorite_teacher';</script>");
		}	
	}else{
		exit("<meta charset='utf-8'/><script>alert('โหวตไม่สำเร็จ');location.href='../../../../?evaluation_mod=favorite_teacher';</script>");
	}
?>				

<!--*******************************************************-->				
<?php		} ?>









