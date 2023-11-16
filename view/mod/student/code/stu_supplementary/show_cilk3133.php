<?php
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_pdo.php");	
	
	include("../../../../database/database_paynew.php");
	include("../../../../database/class_pay.php");
	
	
	$call_clik=filter_input(INPUT_POST,'call_clik');
	
	$call_yaer=filter_input(INPUT_POST,'call_yaer');
	$call_term=filter_input(INPUT_POST,'call_term');
	$call_login=filter_input(INPUT_POST,'call_login');	
				
	$data_yaer=$call_yaer;
	$data_term=$call_term;

	$user_login=$call_login;
	
	

	
	//$stu_cilk=filter_input(INPUT_POST,'stu_cilk');	
	
	$datetime="2021-07-30 16:00:00";
	$datetime_cr=date("Y-m-d H:i:s");
	$datatime_notrun=strtotime($datetime);
	$datatime_run=strtotime($datetime_cr);
		
		if($datatime_run>=$datatime_notrun){
			$print_runtime="OFF";
		}else{
			$print_runtime="ON";
		}
			$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
?>

<?php
	
	switch($call_clik){
		case "cilk_true": ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--supplementary_notstudy-->
<?php
	$print_notstudySql="SELECT `notstudy_stu` FROM `supplementary_notstudy`
						WHERE `notstudy_stu`='{$user_login}' 
						and `notstudy_t`='{$data_term}' 
						and `notstudy_l`='{$data_stu->IDLevel}' 
						and `notstudy_y`='{$data_yaer}' 
						and `notstudy_p`='{$data_stu->rc_plan}'";
	$print_notstudyRs=new notrow_evaluation($print_notstudySql);
	foreach($print_notstudyRs->evaluation_array as $rc_key=>$print_notstudyRow){
		
		if(isset($print_notstudyRow["notstudy_stu"])){
			$notstudy_stu=$print_notstudyRow["notstudy_stu"];
		}else{
			$notstudy_stu=null;
		}
		
		if($notstudy_stu==""){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-info">
			<div class="panel-heading">ทะเบียนเรียน เรียนเสริมเย็น</div>
			<div class="panel-body">

				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="table-responsive">
						
						   <table class="table table-hover">
							<thead>
							  <tr>	
									<th>วิชา</th>
				<?php
					$print_supp_day=new supplementary_day();
					if($print_supp_day->sd_mon=="ON"){ ?>
									<th>วันจันทร์</th>
				<?php	}elseif($print_supp_day->sd_mon=="OFF"){ ?>
						
				<?php	}else{ ?>
						
				<?php	}      ?>
					
				<?php	if($print_supp_day->sd_tue=="ON"){ ?>
									<th>วันอังคาร</th>
				<?php	}elseif($print_supp_day->sd_tue=="OFF"){ ?>
						
				<?php	}else{ ?>
						
				<?php	}	   ?>				
					
				<?php	if($print_supp_day->sd_wed=="ON"){ ?>
									<th>วันพุธ</th>
				<?php	}elseif($print_supp_day->sd_wed=="OFF"){ ?>
						
				<?php	}else{ ?>
						
				<?php	}	   ?>					
					
				<?php	if($print_supp_day->sd_thu=="ON"){?>
									<th>วันพฤหัสบดี</th>
				<?php	}elseif($print_supp_day->sd_thu=="OFF"){?>
						
				<?php	}else{?>
						
				<?php	}	  ?>					
					
				<?php	if($print_supp_day->sd_frl=="ON"){?>
									<th>วันศุกร์</th>
				<?php	}elseif($print_supp_day->sd_frl=="OFF"){?>
						
				<?php	}else{?>
						
				<?php	}	  ?>					
					
				<?php	if($print_supp_day->sd_sat=="ON"){?>
									<th>วันเสาร์</th>
				<?php	}elseif($print_supp_day->sd_sat=="OFF"){?>
						
				<?php	}else{?>
						
				<?php	}	  ?>

				<?php	if($print_supp_day->sd_sun=="ON"){?>
									<th>วันอาทิตย์</th>
				<?php	}elseif($print_supp_day->sd_sun=="OFF"){?>
						
				<?php	}else{?>
						
				<?php	}	  ?>				
							  </tr>
							  
							</thead>
							<tbody>
				<?php
					$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
									           FROM `supplementary_subject` 
											   WHERE `ss_t`='{$data_term}' 
											   and `ss_l`='{$data_stu->IDLevel}' 
											   and `ss_year`='{$data_yaer}'
											   and `ss_academic`='1'";
					$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){  ?>
						
			
						<tr>
								<td><?php echo $supplementary_subjectRow["ss_txtth"];?></td>
								
				
				
				<?php
					$print_daysubject=new supplementary_daysubject($supplementary_subjectRow["ss_id"]);	
				?>
				
				
				
				
				<?php
					$supplementary_dayplanSql="SELECT `sdp_key`,`sd_plan`, `sd_group`,`sd_numA`,`sd_numB`
											   FROM `supplementary_dayplan` 
											   WHERE `sd_plan`='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
					$supplementary_dayplanRs=new notrow_evaluation($supplementary_dayplanSql);
					foreach($supplementary_dayplanRs->evaluation_array as $rc_key=>$supplementary_dayplanRow){
						$sdp_key=$supplementary_dayplanRow["sdp_key"];
						$sdp_group=$supplementary_dayplanRow["sd_group"];
						$sdp_plan=$supplementary_dayplanRow["sd_plan"];
						$sdp_numA=$supplementary_dayplanRow["sd_numA"];
						$sdp_numB=$supplementary_dayplanRow["sd_numB"];
						if($sdp_group==0 or $sdp_group==Null){

				
									$data_dayplanSql="SELECT `sdp_key` 
											          FROM `supplementary_dayplan` 
													  WHERE `sd_plan`='{$data_stu->rc_plan}' 
													  and `sd_group`='0' and `sd_class`='{$data_stu->IDLevel}'";
									$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
									foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
										$datasdp_key=$data_dayplanRow["sdp_key"];
									}
							
						}else{
							$num_dayplanSql="SELECT `sdp_key`,`sd_numA`,`sd_numB`,`sd_group`  
										     FROM `supplementary_dayplan` 
											 WHERE `sd_plan` ='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
							$num_dayplanRs=new row_evaluation($num_dayplanSql);							
							foreach($num_dayplanRs->evaluation_array as $rc_key=>$num_dayplanRow){
								if($data_stu->rsc_num>=$num_dayplanRow["sd_numA"] and $data_stu->rsc_num<=$num_dayplanRow["sd_numB"]){
									$data_dayplanSql="SELECT `sdp_key`,`sd_plan`,`sd_group` 
											          FROM `supplementary_dayplan` 
													  WHERE `sd_plan`='{$data_stu->rc_plan}' 
													  and `sd_group`='{$num_dayplanRow["sd_group"]}' and `sd_class`='{$data_stu->IDLevel}'";
									$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
									foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
										$datasdp_key=$data_dayplanRow["sdp_key"];
									}
								break;	
								}else{
									
								}
							}
							
						} 
					}
				?>					
				
				
	<?php
		$print_dayplanSql="SELECT `sdp_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` 
		                   FROM `supplementary_dayplan` 
						   WHERE `sdp_key`='{$datasdp_key}'";
		$print_dayplanRs=new notrow_evaluation($print_dayplanSql);
		foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
			$print_sdp_key=$print_dayplanRow["sdp_key"];
			$print_sd_mon=$print_dayplanRow["sd_mon"];
			$print_sd_tue=$print_dayplanRow["sd_tue"];
			$print_sd_wed=$print_dayplanRow["sd_wed"];
			$print_sd_thu=$print_dayplanRow["sd_thu"];
			$print_sd_frl=$print_dayplanRow["sd_frl"];
			$print_sd_sat=$print_dayplanRow["sd_sat"];
			$print_sd_sun=$print_dayplanRow["sd_sun"];
		}
	?>	


<?php
///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
	$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

		if($call_dateactivity->day_activity_mon=="ON"){ ?>
		
								<td></td>		
								
<?php	}elseif($call_dateactivity->day_activity_mon=="OFF"){ ?>
		
<!----------------------------------------------------------------------->				
		<?php
						if($print_daysubject->sds_mon=="ON"){ ?>
<!--*******************************************************************-->
		<?php
				if($print_sd_mon=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							   FROM `supplementary_sturs` 
							   WHERE `sup_stuid`='{$user_login}' 
							   and `sup_t`='{$data_term}' 
							   and `sup_year`='{$data_yaer}' 
							   and `sup_l`='{$data_stu->IDLevel}' 
							   and `ss_id`='{$print_daysubject->sss_id}' 
							   and `ss_mon`='1';";
			$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
			foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
				$num_stuid=$doing_subjectRow["num_stuid"];
				if($num_stuid>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>ลงเรียนแล้ว</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$supplementary_subject="SELECT `ss_id`,`subject_MonCount`,`subject_MonKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}'
											and `ss_academic`='1'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_MonCount=$supplementary_subjectRow["subject_MonCount"];
						$subject_MonKeep=$supplementary_subjectRow["subject_MonKeep"];
						if($subject_MonKeep>=$subject_MonCount){ ?>
<!--*****************************************************************************************************-->	
								<td><b style="color: #F80B0F">เต็ม</b></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Mon&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_MonKeep;?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
		<?php	}
			}
		?>		
<!--................................................................................-->



<!--................................................................................-->



		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_sd_mon=="OFF"){ ?>
								<td></td>
		<?php	}else{ ?>
								<td></td>
		<?php	}?>
		
<!--*******************************************************************-->						
				<?php	}elseif($print_daysubject->sds_mon=="OFF"){ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	}else{ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	} ?>
<!----------------------------------------------------------------------->		

<?php	}else{
		//***********************************************
	}
///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
?>


<?php
///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
	$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);
		if($call_dateactivity->day_activity_tue=="ON"){ ?>
		
								<td></td>		
								
<?php	}elseif($call_dateactivity->day_activity_tue=="OFF"){ ?>
	
<!----------------------------------------------------------------------->				
		<?php
						if($print_daysubject->sds_tue=="ON"){ ?>
<!--*******************************************************************-->
		<?php
				if($print_sd_tue=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							   FROM `supplementary_sturs` 
							   WHERE `sup_stuid`='{$user_login}' 
							   and `sup_t`='{$data_term}' 
							   and `sup_l`='{$data_stu->IDLevel}' 
							   and `sup_year`='{$data_yaer}' 
							   and `ss_id`='{$print_daysubject->sss_id}' 
							   and `ss_thurs`='1';";
			$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
			foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
				$num_stuid=$doing_subjectRow["num_stuid"];
				if($num_stuid>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>ลงเรียนแล้ว</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$supplementary_subject="SELECT `ss_id`,`subject_TuesCount`,`subject_TuesKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}'
											and `ss_academic`='1'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_TuesCount=$supplementary_subjectRow["subject_TuesCount"];
						$subject_TuesKeep=$supplementary_subjectRow["subject_TuesKeep"];
						if($subject_TuesKeep>=$subject_TuesCount){ ?>
<!--*****************************************************************************************************-->	
								<td><b style="color: #F80B0F">เต็ม</b></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=tuenes&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_TuesKeep;?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
		<?php	}
			}
		?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_sd_tue=="OFF"){ ?>
								<td></td>
		<?php	}else{ ?>
								<td></td>
		<?php	}?>
<!--*******************************************************************-->						
				<?php	}elseif($print_daysubject->sds_tue=="OFF"){ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	}else{ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	} ?>
<!----------------------------------------------------------------------->	
		
<?php	}else{
		//***********************************************
	}
///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
?>




<?php
///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
	$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

		if($call_dateactivity->day_activity_wed=="ON"){ ?>
		
								<td></td>		
								
<?php	}elseif($call_dateactivity->day_activity_wed=="OFF"){ ?>
<!----------------------------------------------------------------------->		
<!----------------------------------------------------------------------->				
		<?php
						if($print_daysubject->sds_wed=="ON"){ ?>
<!--*******************************************************************-->
		<?php
				if($print_sd_wed=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							   FROM `supplementary_sturs` 
							   WHERE `sup_stuid`='{$user_login}' 
							   and `sup_t`='{$data_term}' 
							   and `sup_l`='{$data_stu->IDLevel}' 
							   and `sup_year`='{$data_yaer}' 
							   and `ss_id`='{$print_daysubject->sss_id}' 
							   and `ss_wedne`='1';";
			$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
			foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
				$num_stuid=$doing_subjectRow["num_stuid"];
				if($num_stuid>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>ลงเรียนแล้ว</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$supplementary_subject="SELECT `ss_id`,`subject_WednesCount`,`subject_WednesKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}'
											and `ss_academic`='1'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_WednesCount=$supplementary_subjectRow["subject_WednesCount"];
						$subject_WednesKeep=$supplementary_subjectRow["subject_WednesKeep"];
						if($subject_WednesKeep>=$subject_WednesCount){ ?>
<!--*****************************************************************************************************-->	
								<td><b style="color: #F80B0F">เต็ม</b></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Wednes&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_WednesKeep;?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
		<?php	}
			}
		?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_sd_wed=="OFF"){ ?>
								<td></td>
		<?php	}else{ ?>
								<td></td>
		<?php	}?>
<!--*******************************************************************-->						
				<?php	}elseif($print_daysubject->sds_wed=="OFF"){ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	}else{ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	} ?>
<!----------------------------------------------------------------------->


<!----------------------------------------------------------------------->		
<?php	}else{
		//***********************************************
	}
///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
?>

				
	
<?php
///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
	$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

		if($call_dateactivity->day_activity_thu=="ON"){ ?>
		
								<td></td>		
								
<?php	}elseif($call_dateactivity->day_activity_thu=="OFF"){ ?>
<!----------------------------------------------------------------------->		

<!----------------------------------------------------------------------->				
		<?php
						if($print_daysubject->sds_thu=="ON"){ ?>
<!--*******************************************************************-->
		<?php
				if($print_sd_thu=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							   FROM `supplementary_sturs` 
							   WHERE `sup_stuid`='{$user_login}' 
							   and `sup_t`='{$data_term}' 
							   and `sup_l`='{$data_stu->IDLevel}' 
							   and `sup_year`='{$data_yaer}' 
							   and `ss_id`='{$print_daysubject->sss_id}' 
							   and `ss_thurs`='1';";
			$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
			foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
				$num_stuid=$doing_subjectRow["num_stuid"];
				if($num_stuid>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>ลงเรียนแล้ว</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$supplementary_subject="SELECT `ss_id`,`subject_ThursCount`,`subject_ThursKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}'
											and `ss_academic`='1'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_ThursCount=$supplementary_subjectRow["subject_ThursCount"];
						$subject_ThursKeep=$supplementary_subjectRow["subject_ThursKeep"];
						if($subject_ThursKeep>=$subject_ThursCount){ ?>
<!--*****************************************************************************************************-->	
								<td><b style="color: #F80B0F">เต็ม</b></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Thurs&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_ThursKeep;?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
		<?php	}
			}
		?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_sd_thu=="OFF"){ ?>
								<td></td>
		<?php	}else{ ?>
								<td></td>
		<?php	}?>
<!--*******************************************************************-->						
				<?php	}elseif($print_daysubject->sds_thu=="OFF"){ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	}else{ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	} ?>
<!----------------------------------------------------------------------->
<!----------------------------------------------------------------------->		
<?php	}else{
		//***********************************************
	}
///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
?>
			
	
<?php
///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
	$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

		if($call_dateactivity->day_activity_frl=="ON"){ ?>
		
								<td></td>		
								
<?php	}elseif($call_dateactivity->day_activity_frl=="OFF"){ ?>
<!----------------------------------------------------------------------->		

<!----------------------------------------------------------------------->				
		<?php
						if($print_daysubject->sds_frl=="ON"){ ?>
<!--*******************************************************************-->
		<?php
				if($print_sd_frl=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							   FROM `supplementary_sturs` 
							   WHERE `sup_stuid`='{$user_login}' 
							   and `sup_t`='{$data_term}' 
							   and `sup_l`='{$data_stu->IDLevel}' 
							   and `sup_year`='{$data_yaer}' 
							   and `ss_id`='{$print_daysubject->sss_id}' 
							   and `ss_fri`='1';";
			$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
			foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
				$num_stuid=$doing_subjectRow["num_stuid"];
				if($num_stuid>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>ลงเรียนแล้ว</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$supplementary_subject="SELECT `ss_id`,`subject_FriCount`,`subject_FriKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}'
											and `ss_academic`='1'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_FriCount=$supplementary_subjectRow["subject_FriCount"];
						$subject_FriKeep=$supplementary_subjectRow["subject_FriKeep"];
						if($subject_FriKeep>=$subject_FriCount){ ?>
<!--*****************************************************************************************************-->	
								<td><b style="color: #F80B0F">เต็ม</b></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=fri&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_FriKeep;?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
		<?php	}
			}
		?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_sd_frl=="OFF"){ ?>
								<td></td>
		<?php	}else{ ?>
								<td></td>
		<?php	}?>
<!--*******************************************************************-->						
				<?php	}elseif($print_daysubject->sds_frl=="OFF"){ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	}else{ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	} ?>
<!----------------------------------------------------------------------->
<!----------------------------------------------------------------------->		
<?php	}else{
		//***********************************************
	}
///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
?>	
									
	
<?php
///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
	$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

		if($call_dateactivity->day_activity_sat=="ON"){ ?>
		
								<td></td>		
								
<?php	}elseif($call_dateactivity->day_activity_sat=="OFF"){ ?>
<!----------------------------------------------------------------------->		
<!----------------------------------------------------------------------->				
		<?php
						if($print_daysubject->sds_sat=="ON"){ ?>
<!--*******************************************************************-->
		<?php
				if($print_sd_sat=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							   FROM `supplementary_sturs` 
							   WHERE `sup_stuid`='{$user_login}' 
							   and `sup_t`='{$data_term}' 
							   and `sup_l`='{$data_stu->IDLevel}' 
							   and `sup_year`='{$data_yaer}' 
							   and `ss_id`='{$print_daysubject->sss_id}' 
							   and `ss_sat`='1';";
			$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
			foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
				$num_stuid=$doing_subjectRow["num_stuid"];
				if($num_stuid>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>ลงเรียนแล้ว</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$supplementary_subject="SELECT `ss_id`,`subject_SaturCount`,`subject_SaturKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}' 
											and `ss_academic`='1'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_SaturCount=$supplementary_subjectRow["subject_SaturCount"];
						$subject_SaturKeep=$supplementary_subjectRow["subject_SaturKeep"];
						if($subject_SaturKeep>=$subject_SaturCount){ ?>
<!--*****************************************************************************************************-->	
								<td><b style="color: #F80B0F">เต็ม</b></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Satur&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_SaturKeep;?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
		<?php	}
			}
		?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_sd_sat=="OFF"){ ?>
								<td></td>
		<?php	}else{ ?>
								<td></td>
		<?php	}?>
<!--*******************************************************************-->						
				<?php	}elseif($print_daysubject->sds_sat=="OFF"){ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	}else{ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	} ?>
<!----------------------------------------------------------------------->
<!----------------------------------------------------------------------->		
<?php	}else{
		//***********************************************
	}
///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
?>	
	
<?php
///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
	$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

		if($call_dateactivity->day_activity_sun=="ON"){ ?>
		
								<td></td>		
								
<?php	}elseif($call_dateactivity->day_activity_sun=="OFF"){ ?>
<!----------------------------------------------------------------------->		
<!----------------------------------------------------------------------->				
		<?php
						if($print_daysubject->sds_sun=="ON"){ ?>
<!--*******************************************************************-->
		<?php
				if($print_sd_sun=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							   FROM `supplementary_sturs` 
							   WHERE `sup_stuid`='{$user_login}' 
							   and `sup_t`='{$data_term}' 
							   and `sup_l`='{$data_stu->IDLevel}' 
							   and `sup_year`='{$data_yaer}' 
							   and `ss_id`='{$print_daysubject->sss_id}' 
							   and `ss_sun`='1';";
			$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
			foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
				$num_stuid=$doing_subjectRow["num_stuid"];
				if($num_stuid>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>ลงเรียนแล้ว</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$supplementary_subject="SELECT `ss_id`,`subject_SunCount`,`subject_SunKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}' 
											and `ss_academic`='1'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_SunCount=$supplementary_subjectRow["subject_SunCount"];
						$subject_SunKeep=$supplementary_subjectRow["subject_SunKeep"];
						if($subject_SunKeep>=$subject_SunCount){ ?>
<!--*****************************************************************************************************-->	
								<td><b style="color: #F80B0F">เต็ม</b></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_SunKeep;?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
		<?php	}
			}
		?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_sd_sun=="OFF"){ ?>
								<td></td>
		<?php	}else{ ?>
								<td></td>
		<?php	}?>
<!--*******************************************************************-->						
				<?php	}elseif($print_daysubject->sds_sun=="OFF"){ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	}else{ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	} ?>
<!----------------------------------------------------------------------->	
<!----------------------------------------------------------------------->		
<?php	}else{
		//***********************************************
	}
///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
?>
	
									
						</tr>	
					
					
				<?php	}  ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
						<tr>		
							<td>กิจกรรมตามความถนัดและสนใจ</td>
							
							
	<?php
		$print_activitySql="select `supplementary_subject`.`ss_txtth` 
					        from `supplementary_subject` join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
						    where `supplementary_sturs`.`sup_t`='{$data_term}' 
							and   `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
							and   `supplementary_sturs`.`sup_year`='{$data_yaer}'
							and   `supplementary_sturs`.`sup_stuid`='{$user_login}'
							and   `supplementary_subject`.`ss_academic`='0';";		
		$print_activityRs=new notrow_evaluation($print_activitySql);
		
		foreach($print_activityRs->evaluation_array as $rc_key=>$print_activityRow){
			
			//$print_dataTxtth=$print_activityRow["ss_txtth"];
			
			if(isset($print_activityRow["ss_txtth"])){
				$print_dataTxtth=$print_activityRow["ss_txtth"];
			}else{
				$print_dataTxtth=null;
			}
			
			if($print_dataTxtth==""){ ?>
<!----------------------------------------------------------------------->
							
								<?php
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
									$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

										if($call_dateactivity->day_activity_mon=="ON"){ ?>
										
																<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																
								<?php	}elseif($call_dateactivity->day_activity_mon=="OFF"){ ?>
								<!----------------------------------------------------------------------->		

																<td></td>
								<!----------------------------------------------------------------------->		
								<?php	}else{
										//***********************************************
									}
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
								?>
								
								<?php
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
									$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

										if($call_dateactivity->day_activity_tue=="ON"){ ?>
										
																<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																
								<?php	}elseif($call_dateactivity->day_activity_tue=="OFF"){ ?>
								<!----------------------------------------------------------------------->		

																<td></td>
								<!----------------------------------------------------------------------->		
								<?php	}else{
										//***********************************************
									}
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
								?>			

								<?php
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
									$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

										if($call_dateactivity->day_activity_wed=="ON"){ ?>
										
																<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																
								<?php	}elseif($call_dateactivity->day_activity_wed=="OFF"){ ?>
								<!----------------------------------------------------------------------->		

																<td></td>
								<!----------------------------------------------------------------------->		
								<?php	}else{
										//***********************************************
									}
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
								?>	
								
								<?php
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
									$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

										if($call_dateactivity->day_activity_wed=="ON"){ ?>
										
																<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																
								<?php	}elseif($call_dateactivity->day_activity_wed=="OFF"){ ?>
								<!----------------------------------------------------------------------->		

																<td></td>
								<!----------------------------------------------------------------------->		
								<?php	}else{
										//***********************************************
									}
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
								?>	

								<?php
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
									$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

										if($call_dateactivity->day_activity_thu=="ON"){ ?>
										
																<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																
								<?php	}elseif($call_dateactivity->day_activity_thu=="OFF"){ ?>
								<!----------------------------------------------------------------------->		

																<td></td>
								<!----------------------------------------------------------------------->		
								<?php	}else{
										//***********************************************
									}
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
								?>		

								<?php
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
									$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

										if($call_dateactivity->day_activity_frl=="ON"){ ?>
										
																<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																
								<?php	}elseif($call_dateactivity->day_activity_frl=="OFF"){ ?>
								<!----------------------------------------------------------------------->		

																<td></td>
								<!----------------------------------------------------------------------->		
								<?php	}else{
										//***********************************************
									}
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
								?>									
								
								<?php
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
									$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

										if($call_dateactivity->day_activity_sat=="ON"){ ?>
										
																<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																
								<?php	}elseif($call_dateactivity->day_activity_sat=="OFF"){ ?>
								<!----------------------------------------------------------------------->		

																<td></td>
								<!----------------------------------------------------------------------->		
								<?php	}else{
										//***********************************************
									}
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
								?>		

								<?php
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
									$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

										if($call_dateactivity->day_activity_sun=="ON"){ ?>
										
																<td><a href="./?evaluation_mod=supplementary&subjectid=activity&day=All&call_clik=<?php echo $call_clik;?>">ลงทะเบียนกิจกรรม</a></td>		
																
								<?php	}elseif($call_dateactivity->day_activity_sun=="OFF"){ ?>
								<!----------------------------------------------------------------------->		

																<td></td>
								<!----------------------------------------------------------------------->		
								<?php	}else{
										//***********************************************
									}
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
								?>	
<!----------------------------------------------------------------------->				
	<?php	}else{ ?>
<!----------------------------------------------------------------------->
							
								<?php
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
									$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

										if($call_dateactivity->day_activity_mon=="ON"){ ?>
										
																<td><?php echo $print_dataTxtth;?></td>		
																
								<?php	}elseif($call_dateactivity->day_activity_mon=="OFF"){ ?>
								<!----------------------------------------------------------------------->		

																<td></td>
								<!----------------------------------------------------------------------->		
								<?php	}else{
										//***********************************************
									}
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
								?>
								
								<?php
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
									$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

										if($call_dateactivity->day_activity_tue=="ON"){ ?>
										
																<td><?php echo $print_dataTxtth;?></td>		
																
								<?php	}elseif($call_dateactivity->day_activity_tue=="OFF"){ ?>
								<!----------------------------------------------------------------------->		

																<td></td>
								<!----------------------------------------------------------------------->		
								<?php	}else{
										//***********************************************
									}
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
								?>			

								<?php
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
									$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

										if($call_dateactivity->day_activity_wed=="ON"){ ?>
										
																<td><?php echo $print_dataTxtth;?></td>		
																
								<?php	}elseif($call_dateactivity->day_activity_wed=="OFF"){ ?>
								<!----------------------------------------------------------------------->		

																<td></td>
								<!----------------------------------------------------------------------->		
								<?php	}else{
										//***********************************************
									}
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
								?>	
								
								<?php
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
									$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

										if($call_dateactivity->day_activity_wed=="ON"){ ?>
										
																<td><?php echo $print_dataTxtth;?></td>		
																
								<?php	}elseif($call_dateactivity->day_activity_wed=="OFF"){ ?>
								<!----------------------------------------------------------------------->		

																<td></td>
								<!----------------------------------------------------------------------->		
								<?php	}else{
										//***********************************************
									}
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
								?>	

								<?php
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
									$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

										if($call_dateactivity->day_activity_thu=="ON"){ ?>
										
																<td><?php echo $print_dataTxtth;?></td>	
																
								<?php	}elseif($call_dateactivity->day_activity_thu=="OFF"){ ?>
								<!----------------------------------------------------------------------->		

																<td></td>
								<!----------------------------------------------------------------------->		
								<?php	}else{
										//***********************************************
									}
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
								?>		

								<?php
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
									$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

										if($call_dateactivity->day_activity_frl=="ON"){ ?>
										
																<td><?php echo $print_dataTxtth;?></td>		
																
								<?php	}elseif($call_dateactivity->day_activity_frl=="OFF"){ ?>
								<!----------------------------------------------------------------------->		

																<td></td>
								<!----------------------------------------------------------------------->		
								<?php	}else{
										//***********************************************
									}
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
								?>									
								
								<?php
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
									$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

										if($call_dateactivity->day_activity_sat=="ON"){ ?>
										
																<td><?php echo $print_dataTxtth;?></td>		
																
								<?php	}elseif($call_dateactivity->day_activity_sat=="OFF"){ ?>
								<!----------------------------------------------------------------------->		

																<td></td>
								<!----------------------------------------------------------------------->		
								<?php	}else{
										//***********************************************
									}
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
								?>		

								<?php
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
									$call_dateactivity=new date_activity($data_stu->IDLevel,$data_stu->rc_plan);

										if($call_dateactivity->day_activity_sun=="ON"){ ?>
										
																<td><?php echo $print_dataTxtth;?></td>	
																
								<?php	}elseif($call_dateactivity->day_activity_sun=="OFF"){ ?>
								<!----------------------------------------------------------------------->		

																<td></td>
								<!----------------------------------------------------------------------->		
								<?php	}else{
										//***********************************************
									}
								///*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-*-/*-/*-
								?>	
<!----------------------------------------------------------------------->				
	<?php	}
		}
	?>						
							
								
								
						</tr>	
						

			
							</tbody>
						  </table>
						
						
						
						
						
						</div>
					</div>
				</div>

			</div>
		</div>	
	</div>
	
</div>


<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	} ?>
<?php	} ?>
<!--supplementary_notstudy-->

	

<div class="row">	
		
	<div class="col-<?php echo $grid;?>-12">
	
						<center>
						
						
				<?php
					$supplementary_dayplanSql="SELECT `sdp_key`,`sd_plan`, `sd_group`,`sd_numA`,`sd_numB`,`sd_class`
											   FROM `supplementary_dayplan` 
											   WHERE `sd_plan`='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
					$supplementary_dayplanRs=new notrow_evaluation($supplementary_dayplanSql);
					foreach($supplementary_dayplanRs->evaluation_array as $rc_key=>$supplementary_dayplanRow){
						$sdp_key=$supplementary_dayplanRow["sdp_key"];
						$sdp_group=$supplementary_dayplanRow["sd_group"];
						$sdp_plan=$supplementary_dayplanRow["sd_plan"];
						$sdp_numA=$supplementary_dayplanRow["sd_numA"];
						$sdp_numB=$supplementary_dayplanRow["sd_numB"];
						if($sdp_group==0 or $sdp_group==Null){

				
									$data_dayplanSql="SELECT `sdp_key` 
											          FROM `supplementary_dayplan` 
													  WHERE `sd_plan`='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'
													  and `sd_group`='0'";
									$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
									foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
										$datasdp_key=$data_dayplanRow["sdp_key"];
									}
							
						}else{
							$num_dayplanSql="SELECT `sdp_key`,`sd_numA`,`sd_numB`,`sd_group`  
										     FROM `supplementary_dayplan` 
											 WHERE `sd_plan` ='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
							$num_dayplanRs=new row_evaluation($num_dayplanSql);							
							foreach($num_dayplanRs->evaluation_array as $rc_key=>$num_dayplanRow){
								if($data_stu->rsc_num>=$num_dayplanRow["sd_numA"] and $data_stu->rsc_num<=$num_dayplanRow["sd_numB"]){
									$data_dayplanSql="SELECT `sdp_key`,`sd_plan`,`sd_group` 
											          FROM `supplementary_dayplan` 
													  WHERE `sd_plan`='{$data_stu->rc_plan}' 
													  and `sd_group`='{$num_dayplanRow["sd_group"]}' and `sd_class`='{$data_stu->IDLevel}'";
									$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
									foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
										$datasdp_key=$data_dayplanRow["sdp_key"];
									}
								break;	
								}else{
									
								}
							}
							
						}
					}
				?>


	<?php
		$print_dayplanSql="SELECT `sdp_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` 
		                   FROM `supplementary_dayplan` 
						   WHERE `sdp_key`='{$datasdp_key}'";
		$print_dayplanRs=new notrow_evaluation($print_dayplanSql);
		$count_study=0;
		foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
			$print_sdp_key=$print_dayplanRow["sdp_key"];
			$print_sd_mon=$print_dayplanRow["sd_mon"];
			$print_sd_tue=$print_dayplanRow["sd_tue"];
			$print_sd_wed=$print_dayplanRow["sd_wed"];
			$print_sd_thu=$print_dayplanRow["sd_thu"];
			$print_sd_frl=$print_dayplanRow["sd_frl"];
			$print_sd_sat=$print_dayplanRow["sd_sat"];
			$print_sd_sun=$print_dayplanRow["sd_sun"];
			
			
			if($print_sd_mon=="ON"){
				$count_study=$count_study+1;
			}else{
				$count_study=$count_study+0;
			}			
			
			if($print_sd_tue=="ON"){
				$count_study=$count_study+1;
			}else{
				$count_study=$count_study+0;
			}			
			
			if($print_sd_wed=="ON"){
				$count_study=$count_study+1;
			}else{
				$count_study=$count_study+0;
			}			
			
			if($print_sd_thu=="ON"){
				$count_study=$count_study+1;
			}else{
				$count_study=$count_study+0;
			}			
			
			if($print_sd_frl=="ON"){
				$count_study=$count_study+1;
			}else{
				$count_study=$count_study+0;
			}			
			
			if($print_sd_sat=="ON"){
				$count_study=$count_study+1;
			}else{
				$count_study=$count_study+0;
			}			
			
			if($print_sd_sun=="ON"){
				$count_study=$count_study+1;
			}else{
				$count_study=$count_study+0;
			}
	
		}
	?>	

	<?php
		$count_study=($count_study-$call_dateactivity->count_activityON)+1;
	
		$study_rcSql="SELECT count(`sup_stuid`) as num_stu FROM `supplementary_sturs` 
					  WHERE `sup_stuid`='{$user_login}'  
					  and `sup_t`='{$data_term}'  
					  and `sup_l`='{$data_stu->IDLevel}' 
					  and `sup_year`='{$data_yaer}'";
		$study_rc=new row_evaluation($study_rcSql);
		foreach($study_rc->evaluation_array as $rc_key=>$study_print){
			$num_stu=$study_print["num_stu"];
			
			if($num_stu>=$count_study){ ?>
<!--***********************************************************************-->
	<?php
		if($data_stu->rc_plan==12){ ?>
<!--***********************************************************************-->
		
		
		
		<form name="print_supp" action="view/mod/student/code/stu_supplementary/supplementary_print.php" method="post" target="_blank">
			
				<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
				<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
				<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
				
				<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
				
		</form>		
		<div class="alert alert-info">

		<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถพิมพ์ ใบยืนยันการลงทะเบียน ได้ในวันจันทร์ ที่ 6 ก.ค 2563 ถึง วันพุธที่ 8 ก.ค 2563 และนำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ระหว่างวันที่ 8 ถึง 31 ก.ค 2563</p>		

		</div>			
<!--***********************************************************************-->			
	<?php	}else{ ?>
<!--***********************************************************************-->
		<form name="print_supp" action="view/mod/student/code/stu_supplementary/supplementary_print.php" method="post" target="_blank">
			
				<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
				<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
				<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
				
				<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
				
		</form>			
		<div class="alert alert-info">

		<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถพิมพ์ ใบยืนยันการลงทะเบียน ได้ในวันจันทร์ ที่ 6 ก.ค 2563 ถึง วันพุธที่ 8 ก.ค 2563 และนำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ระหว่างวันที่ 8 ถึง 31 ก.ค 2563</p>		

		</div>	
				
				

<!--***********************************************************************-->			
	<?php	}    ?>



					
<!--***********************************************************************-->				
	<?php	}else{  ?>
<!--***********************************************************************-->
	<?php
		if($data_stu->rc_plan==12){ ?>
<!--***********************************************************************-->
		
		
		<?php
		$supplementary_notstudySql="SELECT count(`notstudy_stu`) as num_noty FROM `supplementary_notstudy` 
									WHERE `notstudy_stu`='{$user_login}' 
									and `notstudy_t`='{$data_term}' 
									and `notstudy_l`='{$data_stu->IDLevel}'
									and `notstudy_y`='{$data_yaer}'";
		$supplementary_notstudy=new notrow_evaluation($supplementary_notstudySql);
		foreach($supplementary_notstudy->evaluation_array as $rc_key=>$supplementary_notstudyRow){
			$num_noty=$supplementary_notstudyRow["num_noty"];
			if($num_noty>=1){ ?>
				
		<form name="print_supp" action="view/mod/student/code/stu_supplementary/supplementary_print.php" method="post" target="_blank">
			
				<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
				<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
				<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
				
				<input type="hidden" value="stu_not" name="stu_not">
				
				<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
				
		</form><br>				
				
	<?php   }else{ ?>
	
				<?php
				$set_supplementarySql="SELECT count(`supplementary_id`) as `set_count` 
									   from `supplementary_school` 
									   where `supplementary_t`='{$data_term}' 
									   and `supplementary_levelA`='{$data_stu->IDLevel}' 
									   and `supplementary_planA`='{$data_stu->rc_plan}' 
									   and `supplementary_not`='N' 
									   and `supplementary_off`='1'";
				$set_supplementary=new notrow_evaluation ($set_supplementarySql);
				foreach($set_supplementary->evaluation_array as $rc_key=>$set_supplementaryRow){
					$set_count=$set_supplementaryRow["set_count"];
					if($set_count>=1){ ?>
						<p><a href="./?evaluation_mod=supplementary&notstudy=notstudy"><button type="button" class="btn btn-success">ไม่ลงเรียนเพิ่ม</button></a></p>						
			<?php	}else{ ?> 

			<?php	}
				}
			
			?>	
	
				
	<?php	}
			
		}?>
		
		
<!--***********************************************************************-->			
	<?php	}else{ ?>
<!--***********************************************************************-->

<!--***********************************************************************-->			
	<?php	}    ?>				
<!--***********************************************************************-->								
	<?php	}  ?>
		
<?php	}      ?>						
						
						
					</center>
	
	</div>
</div>	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	break;		
		case "cilk_flas": ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--supplementary_notstudy-->
<?php
	$print_notstudySql="SELECT `notstudy_stu` FROM `supplementary_notstudy`
						WHERE `notstudy_stu`='{$user_login}' 
						and `notstudy_t`='{$data_term}' 
						and `notstudy_l`='{$data_stu->IDLevel}' 
						and `notstudy_y`='{$data_yaer}' 
						and `notstudy_p`='{$data_stu->rc_plan}'";
	$print_notstudyRs=new notrow_evaluation($print_notstudySql);
	foreach($print_notstudyRs->evaluation_array as $rc_key=>$print_notstudyRow){
		
		if(isset($print_notstudyRow["notstudy_stu"])){
			$notstudy_stu=$print_notstudyRow["notstudy_stu"];
		}else{
			$notstudy_stu=null;
		}
		
		if($notstudy_stu==""){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-info">
			<div class="panel-heading">ทะเบียนเรียน เรียนเสริมเย็น</div>
			<div class="panel-body">

				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="table-responsive">
						
						   <table class="table table-hover">
							<thead>
							  <tr>	
									<th>วิชา</th>
				<?php
					$print_supp_day=new supplementary_day();
					if($print_supp_day->sd_mon=="ON"){ ?>
									<th>วันจันทร์</th>
				<?php	}elseif($print_supp_day->sd_mon=="OFF"){ ?>
						
				<?php	}else{ ?>
						
				<?php	}      ?>
					
				<?php	if($print_supp_day->sd_tue=="ON"){ ?>
									<th>วันอังคาร</th>
				<?php	}elseif($print_supp_day->sd_tue=="OFF"){ ?>
						
				<?php	}else{ ?>
						
				<?php	}	   ?>				
					
				<?php	if($print_supp_day->sd_wed=="ON"){ ?>
									<th>วันพุธ</th>
				<?php	}elseif($print_supp_day->sd_wed=="OFF"){ ?>
						
				<?php	}else{ ?>
						
				<?php	}	   ?>					
					
				<?php	if($print_supp_day->sd_thu=="ON"){?>
									<th>วันพฤหัสบดี</th>
				<?php	}elseif($print_supp_day->sd_thu=="OFF"){?>
						
				<?php	}else{?>
						
				<?php	}	  ?>					
					
				<?php	if($print_supp_day->sd_frl=="ON"){?>
									<th>วันศุกร์</th>
				<?php	}elseif($print_supp_day->sd_frl=="OFF"){?>
						
				<?php	}else{?>
						
				<?php	}	  ?>					
					
				<?php	if($print_supp_day->sd_sat=="ON"){?>
									<th>วันเสาร์</th>
				<?php	}elseif($print_supp_day->sd_sat=="OFF"){?>
						
				<?php	}else{?>
						
				<?php	}	  ?>

				<?php	if($print_supp_day->sd_sun=="ON"){?>
									<th>วันอาทิตย์</th>
				<?php	}elseif($print_supp_day->sd_sun=="OFF"){?>
						
				<?php	}else{?>
						
				<?php	}	  ?>				
							  </tr>
							  
							</thead>
							<tbody>
				<?php
					$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
									           FROM `supplementary_subject` 
											   WHERE `ss_t`='{$data_term}' 
											   and `ss_l`='{$data_stu->IDLevel}' 
											   and `ss_year`='{$data_yaer}' 
											   and `ss_academic`='1'";
					$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){  ?>
						
			
						<tr>
								<td><?php echo $supplementary_subjectRow["ss_txtth"];?></td>
								
				
				
				<?php
					$print_daysubject=new supplementary_daysubject($supplementary_subjectRow["ss_id"]);	
				?>
				
				
				
				
				<?php
					$supplementary_dayplanSql="SELECT `sdp_key`,`sd_plan`, `sd_group`,`sd_numA`,`sd_numB`
											   FROM `supplementary_dayplan` 
											   WHERE `sd_plan`='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
					$supplementary_dayplanRs=new notrow_evaluation($supplementary_dayplanSql);
					foreach($supplementary_dayplanRs->evaluation_array as $rc_key=>$supplementary_dayplanRow){
						$sdp_key=$supplementary_dayplanRow["sdp_key"];
						$sdp_group=$supplementary_dayplanRow["sd_group"];
						$sdp_plan=$supplementary_dayplanRow["sd_plan"];
						$sdp_numA=$supplementary_dayplanRow["sd_numA"];
						$sdp_numB=$supplementary_dayplanRow["sd_numB"];
						if($sdp_group==0 or $sdp_group==Null){

				
									$data_dayplanSql="SELECT `sdp_key` 
											          FROM `supplementary_dayplan` 
													  WHERE `sd_plan`='{$data_stu->rc_plan}' 
													  and `sd_group`='0' and `sd_class`='{$data_stu->IDLevel}'";
									$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
									foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
										$datasdp_key=$data_dayplanRow["sdp_key"];
									}
							
						}else{
							$num_dayplanSql="SELECT `sdp_key`,`sd_numA`,`sd_numB`,`sd_group`  
										     FROM `supplementary_dayplan` 
											 WHERE `sd_plan` ='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
							$num_dayplanRs=new row_evaluation($num_dayplanSql);							
							foreach($num_dayplanRs->evaluation_array as $rc_key=>$num_dayplanRow){
								if($data_stu->rsc_num>=$num_dayplanRow["sd_numA"] and $data_stu->rsc_num<=$num_dayplanRow["sd_numB"]){
									$data_dayplanSql="SELECT `sdp_key`,`sd_plan`,`sd_group` 
											          FROM `supplementary_dayplan` 
													  WHERE `sd_plan`='{$data_stu->rc_plan}' 
													  and `sd_group`='{$num_dayplanRow["sd_group"]}' and `sd_class`='{$data_stu->IDLevel}'";
									$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
									foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
										$datasdp_key=$data_dayplanRow["sdp_key"];
									}
								break;	
								}else{
									
								}
							}
							
						}
					}
				?>					
				
				
	<?php
		$print_dayplanSql="SELECT `sdp_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` 
		                   FROM `supplementary_dayplan` 
						   WHERE `sdp_key`='{$datasdp_key}'";
		$print_dayplanRs=new notrow_evaluation($print_dayplanSql);
		foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
			$print_sdp_key=$print_dayplanRow["sdp_key"];
			$print_sd_mon=$print_dayplanRow["sd_mon"];
			$print_sd_tue=$print_dayplanRow["sd_tue"];
			$print_sd_wed=$print_dayplanRow["sd_wed"];
			$print_sd_thu=$print_dayplanRow["sd_thu"];
			$print_sd_frl=$print_dayplanRow["sd_frl"];
			$print_sd_sat=$print_dayplanRow["sd_sat"];
			$print_sd_sun=$print_dayplanRow["sd_sun"];
		}
	?>	



				
<!----------------------------------------------------------------------->				
				<?php
						if($print_daysubject->sds_mon=="ON"){ ?>
<!--*******************************************************************-->
		<?php
				if($print_sd_mon=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							   FROM `supplementary_sturs` 
							   WHERE `sup_stuid`='{$user_login}' 
							   and `sup_t`='{$data_term}' 
							   and `sup_year`='{$data_yaer}' 
							   and `sup_l`='{$data_stu->IDLevel}' 
							   and `ss_id`='{$print_daysubject->sss_id}' 
							   and `ss_mon`='1';";
			$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
			foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
				$num_stuid=$doing_subjectRow["num_stuid"];
				if($num_stuid>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>ลงเรียนแล้ว</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$supplementary_subject="SELECT `ss_id`,`subject_MonCount`,`subject_MonKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}'
											and `ss_academic`='1'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_MonCount=$supplementary_subjectRow["subject_MonCount"];
						$subject_MonKeep=$supplementary_subjectRow["subject_MonKeep"];
						if($subject_MonKeep>=$subject_MonCount){ ?>
<!--*****************************************************************************************************-->	
								<td><b style="color: #F80B0F">เต็ม</b></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Mon&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_MonKeep;?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
		<?php	}
			}
		?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_sd_mon=="OFF"){ ?>
								<td></td>
		<?php	}else{ ?>
								<td></td>
		<?php	}?>
		
<!--*******************************************************************-->						
				<?php	}elseif($print_daysubject->sds_mon=="OFF"){ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	}else{ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	} ?>
<!----------------------------------------------------------------------->				
<!----------------------------------------------------------------------->				
				<?php
						if($print_daysubject->sds_tue=="ON"){ ?>
<!--*******************************************************************-->
		<?php
				if($print_sd_tue=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							   FROM `supplementary_sturs` 
							   WHERE `sup_stuid`='{$user_login}' 
							   and `sup_t`='{$data_term}' 
							   and `sup_l`='{$data_stu->IDLevel}' 
							   and `sup_year`='{$data_yaer}' 
							   and `ss_id`='{$print_daysubject->sss_id}' 
							   and `ss_tues`='1';";
			$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
			foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
				$num_stuid=$doing_subjectRow["num_stuid"];
				if($num_stuid>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>ลงเรียนแล้ว</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$supplementary_subject="SELECT `ss_id`,`subject_TuesCount`,`subject_TuesKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}' 
											and `ss_academic`='1'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_TuesCount=$supplementary_subjectRow["subject_TuesCount"];
						$subject_TuesKeep=$supplementary_subjectRow["subject_TuesKeep"];
						if($subject_TuesKeep>=$subject_TuesCount){ ?>
<!--*****************************************************************************************************-->	
								<td><b style="color: #F80B0F">เต็ม</b></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Tues&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_TuesKeep;?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
		<?php	}
			}
		?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_sd_tue=="OFF"){ ?>
								<td></td>
		<?php	}else{ ?>
								<td></td>
		<?php	}?>
<!--*******************************************************************-->						
				<?php	}elseif($print_daysubject->sds_tue=="OFF"){ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	}else{ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	} ?>
<!----------------------------------------------------------------------->									
<!----------------------------------------------------------------------->				
				<?php
						if($print_daysubject->sds_wed=="ON"){ ?>
<!--*******************************************************************-->
		<?php
				if($print_sd_wed=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							   FROM `supplementary_sturs` 
							   WHERE `sup_stuid`='{$user_login}' 
							   and `sup_t`='{$data_term}' 
							   and `sup_l`='{$data_stu->IDLevel}' 
							   and `sup_year`='{$data_yaer}' 
							   and `ss_id`='{$print_daysubject->sss_id}' 
							   and `ss_wedne`='1';";
			$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
			foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
				$num_stuid=$doing_subjectRow["num_stuid"];
				if($num_stuid>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>ลงเรียนแล้ว</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$supplementary_subject="SELECT `ss_id`,`subject_WednesCount`,`subject_WednesKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}'
											and `ss_academic`='1'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_WednesCount=$supplementary_subjectRow["subject_WednesCount"];
						$subject_WednesKeep=$supplementary_subjectRow["subject_WednesKeep"];
						if($subject_WednesKeep>=$subject_WednesCount){ ?>
<!--*****************************************************************************************************-->	
								<td><b style="color: #F80B0F">เต็ม</b></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Wednes&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_WednesKeep;?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
		<?php	}
			}
		?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_sd_wed=="OFF"){ ?>
								<td></td>
		<?php	}else{ ?>
								<td></td>
		<?php	}?>
<!--*******************************************************************-->						
				<?php	}elseif($print_daysubject->sds_wed=="OFF"){ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	}else{ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	} ?>
<!----------------------------------------------------------------------->									
<!----------------------------------------------------------------------->				
				<?php
						if($print_daysubject->sds_thu=="ON"){ ?>
<!--*******************************************************************-->
		<?php
				if($print_sd_thu=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							   FROM `supplementary_sturs` 
							   WHERE `sup_stuid`='{$user_login}' 
							   and `sup_t`='{$data_term}' 
							   and `sup_l`='{$data_stu->IDLevel}' 
							   and `sup_year`='{$data_yaer}' 
							   and `ss_id`='{$print_daysubject->sss_id}' 
							   and `ss_thurs`='1';";
			$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
			foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
				$num_stuid=$doing_subjectRow["num_stuid"];
				if($num_stuid>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>ลงเรียนแล้ว</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$supplementary_subject="SELECT `ss_id`,`subject_ThursCount`,`subject_ThursKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}'
											and `ss_academic`='1'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_ThursCount=$supplementary_subjectRow["subject_ThursCount"];
						$subject_ThursKeep=$supplementary_subjectRow["subject_ThursKeep"];
						if($subject_ThursKeep>=$subject_ThursCount){ ?>
<!--*****************************************************************************************************-->	
								<td><b style="color: #F80B0F">เต็ม</b></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Thurs&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_ThursKeep;?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
		<?php	}
			}
		?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_sd_thu=="OFF"){ ?>
								<td></td>
		<?php	}else{ ?>
								<td></td>
		<?php	}?>
<!--*******************************************************************-->						
				<?php	}elseif($print_daysubject->sds_thu=="OFF"){ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	}else{ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	} ?>
<!----------------------------------------------------------------------->	
<!----------------------------------------------------------------------->				
				<?php
						if($print_daysubject->sds_frl=="ON"){ ?>
<!--*******************************************************************-->
		<?php
				if($print_sd_frl=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							   FROM `supplementary_sturs` 
							   WHERE `sup_stuid`='{$user_login}' 
							   and `sup_t`='{$data_term}' 
							   and `sup_l`='{$data_stu->IDLevel}' 
							   and `sup_year`='{$data_yaer}' 
							   and `ss_id`='{$print_daysubject->sss_id}' 
							   and `ss_fri`='1';";
			$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
			foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
				$num_stuid=$doing_subjectRow["num_stuid"];
				if($num_stuid>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>ลงเรียนแล้ว</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$supplementary_subject="SELECT `ss_id`,`subject_FriCount`,`subject_FriKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}' 
											and `ss_academic`='1'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_FriCount=$supplementary_subjectRow["subject_FriCount"];
						$subject_FriKeep=$supplementary_subjectRow["subject_FriKeep"];
						if($subject_FriKeep>=$subject_FriCount){ ?>
<!--*****************************************************************************************************-->	
								<td><b style="color: #F80B0F">เต็ม</b></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=fri&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_FriKeep;?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
		<?php	}
			}
		?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_sd_frl=="OFF"){ ?>
								<td></td>
		<?php	}else{ ?>
								<td></td>
		<?php	}?>
<!--*******************************************************************-->						
				<?php	}elseif($print_daysubject->sds_frl=="OFF"){ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	}else{ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	} ?>
<!----------------------------------------------------------------------->
<!----------------------------------------------------------------------->				
				<?php
						if($print_daysubject->sds_sat=="ON"){ ?>
<!--*******************************************************************-->
		<?php
				if($print_sd_sat=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							   FROM `supplementary_sturs` 
							   WHERE `sup_stuid`='{$user_login}' 
							   and `sup_t`='{$data_term}' 
							   and `sup_l`='{$data_stu->IDLevel}' 
							   and `sup_year`='{$data_yaer}' 
							   and `ss_id`='{$print_daysubject->sss_id}' 
							   and `ss_sat`='1';";
			$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
			foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
				$num_stuid=$doing_subjectRow["num_stuid"];
				if($num_stuid>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>ลงเรียนแล้ว</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$supplementary_subject="SELECT `ss_id`,`subject_SaturCount`,`subject_SaturKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}'
											and `ss_academic`='1'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_SaturCount=$supplementary_subjectRow["subject_SaturCount"];
						$subject_SaturKeep=$supplementary_subjectRow["subject_SaturKeep"];
						if($subject_SaturKeep>=$subject_SaturCount){ ?>
<!--*****************************************************************************************************-->	
								<td><b style="color: #F80B0F">เต็ม</b></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Satur&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_SaturKeep;?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
		<?php	}
			}
		?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_sd_sat=="OFF"){ ?>
								<td></td>
		<?php	}else{ ?>
								<td></td>
		<?php	}?>
<!--*******************************************************************-->						
				<?php	}elseif($print_daysubject->sds_sat=="OFF"){ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	}else{ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	} ?>
<!----------------------------------------------------------------------->	
<!----------------------------------------------------------------------->				
				<?php
						if($print_daysubject->sds_sun=="ON"){ ?>
<!--*******************************************************************-->
		<?php
				if($print_sd_sun=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$doing_subjectSql="SELECT COUNT(`sup_stuid`) as `num_stuid` 
							   FROM `supplementary_sturs` 
							   WHERE `sup_stuid`='{$user_login}' 
							   and `sup_t`='{$data_term}' 
							   and `sup_l`='{$data_stu->IDLevel}' 
							   and `sup_year`='{$data_yaer}' 
							   and `ss_id`='{$print_daysubject->sss_id}' 
							   and `ss_sun`='1';";
			$doing_subjectRs=new notrow_evaluation($doing_subjectSql);
			foreach($doing_subjectRs->evaluation_array as $rc_key=>$doing_subjectRow){
				$num_stuid=$doing_subjectRow["num_stuid"];
				if($num_stuid>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>ลงเรียนแล้ว</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$supplementary_subject="SELECT `ss_id`,`subject_SunCount`,`subject_SunKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_stu->IDLevel}' 
											and `ss_year`='{$data_yaer}'
											and `ss_academic`='1'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_SunCount=$supplementary_subjectRow["subject_SunCount"];
						$subject_SunKeep=$supplementary_subjectRow["subject_SunKeep"];
						if($subject_SunKeep>=$subject_SunCount){ ?>
<!--*****************************************************************************************************-->	
								<td><b style="color: #F80B0F">เต็ม</b></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td><a href="./?evaluation_mod=supplementary&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&call_clik=<?php echo $call_clik;?>"><b style="color:#0623FB"><?php echo $subject_SunKeep;?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
		<?php	}
			}
		?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_sd_sun=="OFF"){ ?>
								<td></td>
		<?php	}else{ ?>
								<td></td>
		<?php	}?>
<!--*******************************************************************-->						
				<?php	}elseif($print_daysubject->sds_sun=="OFF"){ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	}else{ ?>
<!--*******************************************************************-->
								<td></td>
<!--*******************************************************************-->							
				<?php	} ?>
<!----------------------------------------------------------------------->										
						</tr>	
					
					
				<?php	}  ?>
						
						
						

			
							</tbody>
						  </table>
						
						
						
						
						
						</div>
					</div>
				</div>

			</div>
		</div>	
	</div>
	
</div>


<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	} ?>
<?php	} ?>
<!--supplementary_notstudy-->

	

<div class="row">	
		
	<div class="col-<?php echo $grid;?>-12">
	
						<center>
						
						
				<?php
					$supplementary_dayplanSql="SELECT `sdp_key`,`sd_plan`, `sd_group`,`sd_numA`,`sd_numB`,`sd_class`
											   FROM `supplementary_dayplan` 
											   WHERE `sd_plan`='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
					$supplementary_dayplanRs=new notrow_evaluation($supplementary_dayplanSql);
					foreach($supplementary_dayplanRs->evaluation_array as $rc_key=>$supplementary_dayplanRow){
						$sdp_key=$supplementary_dayplanRow["sdp_key"];
						$sdp_group=$supplementary_dayplanRow["sd_group"];
						$sdp_plan=$supplementary_dayplanRow["sd_plan"];
						$sdp_numA=$supplementary_dayplanRow["sd_numA"];
						$sdp_numB=$supplementary_dayplanRow["sd_numB"];
						if($sdp_group==0 or $sdp_group==Null){

				
									$data_dayplanSql="SELECT `sdp_key` 
											          FROM `supplementary_dayplan` 
													  WHERE `sd_plan`='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'
													  and `sd_group`='0'";
									$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
									foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
										$datasdp_key=$data_dayplanRow["sdp_key"];
									}
							
						}else{
							$num_dayplanSql="SELECT `sdp_key`,`sd_numA`,`sd_numB`,`sd_group`  
										     FROM `supplementary_dayplan` 
											 WHERE `sd_plan` ='{$data_stu->rc_plan}' and `sd_class`='{$data_stu->IDLevel}'";
							$num_dayplanRs=new row_evaluation($num_dayplanSql);							
							foreach($num_dayplanRs->evaluation_array as $rc_key=>$num_dayplanRow){
								if($data_stu->rsc_num>=$num_dayplanRow["sd_numA"] and $data_stu->rsc_num<=$num_dayplanRow["sd_numB"]){
									$data_dayplanSql="SELECT `sdp_key`,`sd_plan`,`sd_group` 
											          FROM `supplementary_dayplan` 
													  WHERE `sd_plan`='{$data_stu->rc_plan}' 
													  and `sd_group`='{$num_dayplanRow["sd_group"]}' and `sd_class`='{$data_stu->IDLevel}'";
									$data_dayplanRs=new notrow_evaluation($data_dayplanSql);
									foreach($data_dayplanRs->evaluation_array as $rc_key=>$data_dayplanRow){
										$datasdp_key=$data_dayplanRow["sdp_key"];
									}
								break;	
								}else{
									
								}
							}
							
						}
					}
				?>


	<?php
		$print_dayplanSql="SELECT `sdp_key`, `sd_mon`, `sd_tue`, `sd_wed`, `sd_thu`, `sd_frl`, `sd_sat`, `sd_sun` 
		                   FROM `supplementary_dayplan` 
						   WHERE `sdp_key`='{$datasdp_key}'";
		$print_dayplanRs=new notrow_evaluation($print_dayplanSql);
		$count_study=0;
		foreach ($print_dayplanRs->evaluation_array as $rc_key=>$print_dayplanRow){
			$print_sdp_key=$print_dayplanRow["sdp_key"];
			$print_sd_mon=$print_dayplanRow["sd_mon"];
			$print_sd_tue=$print_dayplanRow["sd_tue"];
			$print_sd_wed=$print_dayplanRow["sd_wed"];
			$print_sd_thu=$print_dayplanRow["sd_thu"];
			$print_sd_frl=$print_dayplanRow["sd_frl"];
			$print_sd_sat=$print_dayplanRow["sd_sat"];
			$print_sd_sun=$print_dayplanRow["sd_sun"];
			
			
			if($print_sd_mon=="ON"){
				$count_study=$count_study+1;
			}else{
				$count_study=$count_study+0;
			}			
			
			if($print_sd_tue=="ON"){
				$count_study=$count_study+1;
			}else{
				$count_study=$count_study+0;
			}			
			
			if($print_sd_wed=="ON"){
				$count_study=$count_study+1;
			}else{
				$count_study=$count_study+0;
			}			
			
			if($print_sd_thu=="ON"){
				$count_study=$count_study+1;
			}else{
				$count_study=$count_study+0;
			}			
			
			if($print_sd_frl=="ON"){
				$count_study=$count_study+1;
			}else{
				$count_study=$count_study+0;
			}			
			
			if($print_sd_sat=="ON"){
				$count_study=$count_study+1;
			}else{
				$count_study=$count_study+0;
			}			
			
			if($print_sd_sun=="ON"){
				$count_study=$count_study+1;
			}else{
				$count_study=$count_study+0;
			}
		
		}
	?>	

	<?php
		$study_rcSql="SELECT count(`sup_stuid`) as num_stu FROM `supplementary_sturs` 
					  WHERE `sup_stuid`='{$user_login}'  
					  and `sup_t`='{$data_term}'  
					  and `sup_l`='{$data_stu->IDLevel}' 
					  and `sup_year`='{$data_yaer}'";
		$study_rc=new row_evaluation($study_rcSql);
		foreach($study_rc->evaluation_array as $rc_key=>$study_print){
			$num_stu=$study_print["num_stu"];
			
			if($num_stu>=$count_study){ ?>
<!--***********************************************************************-->
	<?php
		if($data_stu->rc_plan==12){ ?>
<!--***********************************************************************-->
		
		
		
		<form name="print_supp" action="view/mod/student/code/stu_supplementary/supplementary_print.php" method="post" target="_blank">
			
				<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
				<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
				<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
				
				<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
				
		</form>		
		<div class="alert alert-info">

		<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถพิมพ์ ใบยืนยันการลงทะเบียน ได้ในวันจันทร์ ที่ 6 ก.ค 2563 ถึง วันพุธที่ 8 ก.ค 2563 และนำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ระหว่างวันที่ 8 ถึง 31 ก.ค 2563</p>		

		</div>			
<!--***********************************************************************-->			
	<?php	}else{ ?>
<!--***********************************************************************-->
		<form name="print_supp" action="view/mod/student/code/stu_supplementary/supplementary_print.php" method="post" target="_blank">
			
				<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
				<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
				<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
				
				<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
				
		</form>			
		<div class="alert alert-info">

		<p><strong>สำเร็จ...</strong>ลงทะเบียนสำเร็จ นักเรียนสามารถพิมพ์ ใบยืนยันการลงทะเบียน ได้ในวันจันทร์ ที่ 6 ก.ค 2563 ถึง วันพุธที่ 8 ก.ค 2563 และนำใบยืนยันการลงทะเบียนมาชำระ ที่ห้องการเงิน ระหว่างวันที่ 8 ถึง 31 ก.ค 2563</p>		

		</div>	
				
				

<!--***********************************************************************-->			
	<?php	}    ?>



					
<!--***********************************************************************-->				
	<?php	}else{  ?>
<!--***********************************************************************-->
	<?php
		if($data_stu->rc_plan==12){ ?>
<!--***********************************************************************-->
		
		
		<?php
		$supplementary_notstudySql="SELECT count(`notstudy_stu`) as num_noty FROM `supplementary_notstudy` 
									WHERE `notstudy_stu`='{$user_login}' 
									and `notstudy_t`='{$data_term}' 
									and `notstudy_l`='{$data_stu->IDLevel}'
									and `notstudy_y`='{$data_yaer}'";
		$supplementary_notstudy=new notrow_evaluation($supplementary_notstudySql);
		foreach($supplementary_notstudy->evaluation_array as $rc_key=>$supplementary_notstudyRow){
			$num_noty=$supplementary_notstudyRow["num_noty"];
			if($num_noty>=1){ ?>
				
		<form name="print_supp" action="view/mod/student/code/stu_supplementary/supplementary_print.php" method="post" target="_blank">
			
				<input type="hidden" value="<?php echo $data_yaer;?>"  name="data_yaer">
				<input type="hidden" value="<?php echo $data_term;?>"  name="data_term">
				<input type="hidden" value="<?php echo $user_login;?>" name="user_login">
				
				<input type="hidden" value="stu_not" name="stu_not">
				
				<p><button type="submit" class="btn btn-success">ปรื้นใบลงทะเบียนเรียนเสริม</button></p>
				
		</form><br>				
				
	<?php   }else{ ?>
	
				<?php
				$set_supplementarySql="SELECT count(`supplementary_id`) as `set_count` 
									   from `supplementary_school` 
									   where `supplementary_t`='{$data_term}' 
									   and `supplementary_levelA`='{$data_stu->IDLevel}' 
									   and `supplementary_planA`='{$data_stu->rc_plan}' 
									   and `supplementary_not`='N' 
									   and `supplementary_off`='1'";
				$set_supplementary=new notrow_evaluation ($set_supplementarySql);
				foreach($set_supplementary->evaluation_array as $rc_key=>$set_supplementaryRow){
					$set_count=$set_supplementaryRow["set_count"];
					if($set_count>=1){ ?>
						<p><a href="./?evaluation_mod=supplementary&notstudy=notstudy"><button type="button" class="btn btn-success">ไม่ลงเรียนเพิ่ม</button></a></p>						
			<?php	}else{ ?> 

			<?php	}
				}
			
			?>	
	
				
	<?php	}
			
		}?>
		
		
<!--***********************************************************************-->			
	<?php	}else{ ?>
<!--***********************************************************************-->

<!--***********************************************************************-->			
	<?php	}    ?>				
<!--***********************************************************************-->								
	<?php	}  ?>
		
<?php	}      ?>						
						
						
					</center>
	
	</div>
</div>	
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	break;		
		default: ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	}        ?>


