<?php
/* set the cache limiter to 'private' */
	session_cache_limiter("regina");
	$cache_limiter = session_cache_limiter();

/* set the cache expire to 30 minutes */
	session_cache_expire(20);
	$cache_expire = session_cache_expire();

/* start the session */

	session_start();
	ob_start();
	header("Cache-control: private");
//echo "The cache limiter is now set to $cache_limiter<br />";
//echo "The cached session pages expire after $cache_expire minutes";
	
	//session_start();
	header("cache-Control: max-age=0; no-cache; must-revalidate");
	include("../../../../database/database_evaluation.php");
	$evaluation_mod=isset($_GET["evaluation_mod"]) ? $_GET["evaluation_mod"] : "home";
	$rcdata_connect= connect();
		if(!isset($_SESSION['rc_user']))
	{
		header("location:../../../../../login.php");
		exit();
	}else{
		$rc_user=$_SESSION['rc_user'];
		$log_user_student="select `rc_prefix`.`prefixname`,`regina_stu_data`.`rsd_name`,`regina_stu_data`.`rsd_surname`
		                 ,`regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`regina_stu_login`.`model1`
						 ,`regina_stu_login`.`model2`,`regina_stu_login`.`rsl_login`
						   from `regina_stu_data` join `regina_stu_login` on(`regina_stu_data`.`rsd_studentid`=`regina_stu_login`.`rsd_studentid`)
						   join `rc_prefix` on(`regina_stu_data`.`rsd_prefix`=`rc_prefix`.`IDPrefix`)
						   WHERE `regina_stu_login`.`rsl_user`='{$rc_user}';";
		$log_user_studentRs=$rcdata_connect->query($log_user_student) or die($log_user_studentRs->error);
		if($log_user_studentRs->num_rows){
			$log_user_studentRow=$log_user_studentRs->fetch_assoc();
			$user_login=$log_user_studentRow["rsd_studentid"];
			$myname=$log_user_studentRow["prefixname"]." ".$log_user_studentRow["rsd_name"]." ".$log_user_studentRow["rsd_surname"];
			$model1=$log_user_studentRow["model1"];
			$model2=$log_user_studentRow["model2"];
			$login=$log_user_studentRow["rsl_login"];
			//$user_img="view/all/$user_login.jpg";
//----------System----------------------------------------------------||			
			require_once("../../../../database/connect_login.php");		  //	
			//$evaluation_load="view/mod/student/{$evaluation_mod}.php";//
			$group="S";                                               //
//----------System----------------------------------------------------||			
			
		}else{
			$log_user_admin="select `login`.`login_rc`,`login`.`login_update`,`login`.`group`,`data_teacher`.`dt_name`,`data_teacher`.`dt_last_names`
						   ,`login`.`model1`,`login`.`model2`,`login`.`login_status`
                             from `data_teacher` join `login` on(`data_teacher`.`dt_rc`=`login`.`login_rc`)
                             where `login`.`use_status`='1' and `login`.`login_id`='{$rc_user}'";
			$log_user_adminRs=$rcdata_connect->query($log_user_admin) or die($log_user_adminRs->error);
			if($log_user_adminRs->num_rows){	
				$log_user_adminRow=$log_user_adminRs->fetch_assoc();
				$group=$log_user_adminRow["group"];
				$user_login=$log_user_adminRow["login_rc"];
				$myname=$log_user_adminRow["dt_name"]." ".$log_user_adminRow["dt_last_names"];
				$model1=$log_user_adminRow["model1"];
				$model2=$log_user_adminRow["model2"];
				$login=$log_user_adminRow["login_status"];
				//$user_img="view/t/$user_login.jpg";
				if($group=="A"){
					//$evaluation_load="view/mod/admin/{$evaluation_mod}.php";
				}else{
					session_destroy();
					exit("<script>window.location='../../../../../login.php';</script>");
				}
//----------System----------------------------------------------------||			
			require_once("../../../../database/connect_admin.php");		  //	
		  //$evaluation_load="view/mod/student/{$evaluation_mod}.php";//
//----------System----------------------------------------------------||				
			}else{
				header("location:../../../../../login.php");
				exit();		
			}
		}
	}
?>

<meta charset="utf-8">
<?php
	//include("../../../../database/database_evaluation.php");
	//$rcdata_connect=connect();
	error_reporting(error_reporting() & ~E_NOTICE);
	$countstu=post_data($_POST["countstu"]);
	$copy_term=post_data($_POST["copy_term"]);
	$copy_year=post_data($_POST["copy_year"]);
	//$user_login=post_data($_POST["user_login"]);
	$datetime=date("Y-m-d H:i:s");
	if(isset($countstu)){
		if($countstu=="" or $countstu==0 and $copy_term=="" and $copy_year==""){
			exit("<meta charset='utf-8'/><script>alert('บันทึกไม่สำเร็จ');location.href='../../../../../?evaluation_mod=overdue';</script>");
		}else{
			$count_system=0;
			while($count_system<$countstu){
				$stu_id=post_data($_POST["stu$count_system"]);
				$os_id=post_data($_POST["txt_os$count_system"]);
				$oc_id=post_data($_POST["txt_oc$count_system"]); 
				if($stu_id=="" and $os_id=="" and $oc_id==""){
					//****************************************
				}else{
					$overdue_data="SELECT `od_student`,`os_id`,`oc_id` 
								   FROM `overdue_data`
								   WHERE `od_student`='{$stu_id}' 
								   and `od_term`='{$copy_term}' 
								   and `od_year`='{$copy_year}'";
					$overdue_dataRs=rc_data($overdue_data);
					
					foreach($overdue_dataRs as $rc_key=>$overdue_dataRow){
						$cros_id=$overdue_dataRow["os_id"];
						$croc_id=$overdue_dataRow["oc_id"];
					}
					
					if($os_id==$cros_id and $oc_id==$croc_id){
						//************************************
					}else{
						$updata_overdue="UPDATE `overdue_data` 
										 SET `os_id`='{$os_id}'
										 ,`oc_id`='{$oc_id}' 
										 ,`od_timemodify`='{$datetime}'
										 ,`od_save`='{$user_login}'  
										 WHERE `od_student`='{$stu_id}' 
										 and `od_term`='{$copy_term}' 
										 and `od_year`='{$copy_year}'";
						$overdue_up=add_rc($updata_overdue);	
					}	
				}
				$count_system=$count_system+1;
			}
			exit("<meta charset='utf-8'/><script>alert('บันทึกสำเร็จ');location.href='../../../../../?evaluation_mod=overdue';</script>");
		}
	}else{
		exit("<meta charset='utf-8'/><script>alert('บันทึกไม่สำเร็จ');location.href='../../../../../?evaluation_mod=overdue';</script>");
	}
?>