<?php include("../../../../database/database_evaluation.php"); 
	$rcdata_connect= connect();
	$copy_year=post_data($_POST["copy_year"]);	
	$copy_count=post_data($_POST["copy_count"]);
	if(isset($copy_year)){
	//delete favorite_score	
		$delete_favorite_score="DELETE FROM `favorite_score` WHERE `fc_yaer`='{$copy_year}'";
		$delete_favorite_scoreRs=add_rc($delete_favorite_score);
	//delete favorite_score
		
		$print_favorite_score="select `rc_person`.`IDTeacher`,`favorite_teacher`.`ft_year`,count(`favorite_teacher`.`ft_key`) as num_score
		                       from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`) 
							   join `favorite_teacher` on(`rc_person`.`IDTeacher`=`favorite_teacher`.`tt_rc`)
							   WHERE `favorite_teacher`.`ft_year`='{$copy_year}' group by `favorite_teacher`.`tt_rc`";
		$print_favorite_scoreRs=$rcdata_connect->query($print_favorite_score) or die($rcdata_connect->error);
		if($print_favorite_scoreRs->num_rows>0){
			while($print_favorite_scoreRow=$print_favorite_scoreRs->fetch_assoc()){
				$pfs_IDTeacher=$print_favorite_scoreRow["IDTeacher"];
				$pfs_ft_year=$print_favorite_scoreRow["ft_year"];
				$pfs_num_score=$print_favorite_scoreRow["num_score"];
//------------------------------------------------------------				
				$insert_favorite_score="INSERT INTO `favorite_score` (`fc_teacher`, `fc_yaer`, `fc_score`) VALUES ('{$pfs_IDTeacher}', '{$pfs_ft_year}', '{$pfs_num_score}');";
				$insert_favorite_scoreRs=add_rc($insert_favorite_score);
//------------------------------------------------------------				
			} ?>
<!-------------------------------------------------------------->				
<?php
	$team_teacher_group="SELECT ttg_key,ttg_txt FROM `team_teacher_group` WHERE `ttg_key` !='4'";
	$team_teacher_groupRr=rc_array($team_teacher_group);
	
	foreach($team_teacher_groupRr as $rc_key =>$team_teacher_groupRow){
			if($team_teacher_groupRow["ttg_key"]==1){ ?>
			
		<?php
			$favorite_score="select `rc_person`.`IDTeacher`,`rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName`,`favorite_score`.`fc_score`,`team_teacher_group`.`ttg_txt` 
			                 from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`) 
							 join `team_teacher` on(`rc_person`.`IDTeacher`=`team_teacher`.`tt_rc`) 
							 join `team_teacher_group` on(`team_teacher`.`ttg_key`=`team_teacher_group`.`ttg_key`) 
							 join `favorite_score` on(`team_teacher`.`tt_rc`=`favorite_score`.`fc_teacher`) 
							 where `favorite_score`.`fc_yaer`='{$copy_year}' 
							 and `team_teacher`.`ttg_key`='{$team_teacher_groupRow["ttg_key"]}' 
							 ORDER BY `favorite_score`.`fc_score` DESC LIMIT $copy_count";
			$favorite_scoreRs=$rcdata_connect->query($favorite_score) or die($rcdata_connect->error);
			if($favorite_scoreRs->num_rows>0){ ?>
				
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
<!--*****************************************************************-->		
	<div class="panel panel-success">
		<div class="panel-heading">ครู <?php echo $team_teacher_groupRow["ttg_txt"]; ?>  <a href="./?evaluation_mod=favorite_score_data1"><button type="button"  class="btn btn-default">แสดงข้อมูลทั้งหมด</button></a></div>
		<div class="panel-body">
<!--*****************************************************************-->	

						<div class="row">
			<?php	while($favorite_scoreRow=$favorite_scoreRs->fetch_assoc()){ 
					$myname=$favorite_scoreRow["prefixname"]." ".$favorite_scoreRow["FName"]." ".$favorite_scoreRow["SName"];
					$fc_score=$favorite_scoreRow["fc_score"];
					$IDTeacher=$favorite_scoreRow["IDTeacher"];
					
					$TeacherKey=encode($IDTeacher);
					
			?>
					
					
								<div class="col-sm-3 col-md-3 col-lg-3">
									<div class="panel">
										<div class="bg-danger-600 demo-color">
											<center><a href="./?evaluation_mod=favorite_score_info&TeacherKey=<?php echo $TeacherKey;?>"><img src="view/t/<?php echo $IDTeacher;?>.jpg" class="img-thumbnail" alt="Cinque Terre" style="width: 93px; height: 125px;"></a></center>
											<span><?php echo $myname;?></span>
										</div>
								
										<div class="p-15">
											<div class="media-body">
												<strong><?php echo $fc_score;?>  คะแนน</strong>
											</div>
										</div>
									</div>
								</div>
					
					
			<?php	} ?>
						</div>
	
<!--*****************************************************************-->			
		</div>
    </div>	
<!--*****************************************************************-->			
		</div>
	</div>			

				
				

				
	<?php	}else{ ?>
		<div class="alert alert-danger">
			<strong>ไม่พบข้อมูล...</strong>
		</div>					
	<?php	}
		?>			
				
<?php		}elseif($team_teacher_groupRow["ttg_key"]==2){ ?>

		<?php
			$favorite_score="select `rc_person`.`IDTeacher`,`rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName`,`favorite_score`.`fc_score`,`team_teacher_group`.`ttg_txt` 
			                 from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`) 
							 join `team_teacher` on(`rc_person`.`IDTeacher`=`team_teacher`.`tt_rc`) 
							 join `team_teacher_group` on(`team_teacher`.`ttg_key`=`team_teacher_group`.`ttg_key`) 
							 join `favorite_score` on(`team_teacher`.`tt_rc`=`favorite_score`.`fc_teacher`) 
							 where `favorite_score`.`fc_yaer`='{$copy_year}' 
							 and `team_teacher`.`ttg_key`='{$team_teacher_groupRow["ttg_key"]}' 
							 ORDER BY `favorite_score`.`fc_score` DESC LIMIT $copy_count";
			$favorite_scoreRs=$rcdata_connect->query($favorite_score) or die($rcdata_connect->error);
			if($favorite_scoreRs->num_rows>0){ ?>
				
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
<!--*****************************************************************-->		
	<div class="panel panel-success">
		<div class="panel-heading">ครู <?php echo $team_teacher_groupRow["ttg_txt"]; ?> <a href="./?evaluation_mod=favorite_score_data2"><button type="button"  class="btn btn-default">แสดงข้อมูลทั้งหมด</button></a></div>
		<div class="panel-body">
<!--*****************************************************************-->	

						<div class="row">
			<?php	while($favorite_scoreRow=$favorite_scoreRs->fetch_assoc()){ 
					$myname=$favorite_scoreRow["prefixname"]." ".$favorite_scoreRow["FName"]." ".$favorite_scoreRow["SName"];
					$fc_score=$favorite_scoreRow["fc_score"];
					$IDTeacher=$favorite_scoreRow["IDTeacher"];
					
					$TeacherKey=encode($IDTeacher);
			?>
					
					
								<div class="col-sm-3 col-md-3 col-lg-3">
									<div class="panel">
										<div class="bg-success-600 demo-color">
											<center><a href="./?evaluation_mod=favorite_score_info&TeacherKey=<?php echo $TeacherKey;?>"><img src="view/t/<?php echo $IDTeacher;?>.jpg" class="img-thumbnail" alt="Cinque Terre" style="width: 93px; height: 125px;"></a></center>
											<span><?php echo $myname;?></span>                                                   
										</div>
								
										<div class="p-15">
											<div class="media-body">
												<strong><?php echo $fc_score;?>  คะแนน</strong>
											</div>
										</div>
									</div>
								</div>
					
					
			<?php	} ?>
						</div>
	
<!--*****************************************************************-->			
		</div>
    </div>	
<!--*****************************************************************-->			
		</div>
	</div>			

				
				

				
	<?php	}else{ ?>
		<div class="alert alert-danger">
			<strong>ไม่พบข้อมูล...</strong>
		</div>				
	<?php		 }
		?>			
			
<?php		}elseif($team_teacher_groupRow["ttg_key"]==3){ ?>
			
		<?php
			$favorite_score="select `rc_person`.`IDTeacher`,`rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName`,`favorite_score`.`fc_score`,`team_teacher_group`.`ttg_txt` 
			                 from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`) 
							 join `team_teacher` on(`rc_person`.`IDTeacher`=`team_teacher`.`tt_rc`) 
							 join `team_teacher_group` on(`team_teacher`.`ttg_key`=`team_teacher_group`.`ttg_key`) 
							 join `favorite_score` on(`team_teacher`.`tt_rc`=`favorite_score`.`fc_teacher`) 
							 where `favorite_score`.`fc_yaer`='{$copy_year}' 
							 and `team_teacher`.`ttg_key`='{$team_teacher_groupRow["ttg_key"]}' 
							 ORDER BY `favorite_score`.`fc_score` DESC LIMIT $copy_count";
			$favorite_scoreRs=$rcdata_connect->query($favorite_score) or die($rcdata_connect->error);
			if($favorite_scoreRs->num_rows>0){ ?>
				
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
<!--*****************************************************************-->		
	<div class="panel panel-success">
		<div class="panel-heading">ครู <?php echo $team_teacher_groupRow["ttg_txt"]; ?> <a href="./?evaluation_mod=favorite_score_data3"><button type="button"  class="btn btn-default">แสดงข้อมูลทั้งหมด</button></a></div>
		<div class="panel-body">
<!--*****************************************************************-->	

						<div class="row">
			<?php	while($favorite_scoreRow=$favorite_scoreRs->fetch_assoc()){ 
					$myname=$favorite_scoreRow["prefixname"]." ".$favorite_scoreRow["FName"]." ".$favorite_scoreRow["SName"];
					$fc_score=$favorite_scoreRow["fc_score"];
					$IDTeacher=$favorite_scoreRow["IDTeacher"];
					
					$TeacherKey=encode($IDTeacher);
			?>
					
					
								<div class="col-sm-3 col-md-3 col-lg-3">
									<div class="panel">
										<div class="bg-primary-600 demo-color">
											<center><a href="./?evaluation_mod=favorite_score_info&TeacherKey=<?php echo $TeacherKey;?>"><img src="view/t/<?php echo $IDTeacher;?>.jpg" class="img-thumbnail" alt="Cinque Terre" style="width: 93px; height: 125px;"></a></a></center>
											<span><?php echo $myname;?></span>
										</div>
								
										<div class="p-15">
											<div class="media-body">
												<strong><?php echo $fc_score;?>  คะแนน</strong>
											</div>
										</div>
									</div>
								</div>
					
					
			<?php	} ?>
						</div>
	
<!--*****************************************************************-->			
		</div>
    </div>	
<!--*****************************************************************-->			
		</div>
	</div>			

				
				

				
	<?php	}else{ ?>
		<div class="alert alert-danger">
			<strong>ไม่พบข้อมูล...</strong>
		</div>					
	<?php	}
		?>			
			
<?php		}else{
			//error
		}
	}
?>
<!-------------------------------------------------------------->			
<?php	}else{
			//error
		}
	}elseif($copy_year==""){ ?>
		<div class="alert alert-danger">
			<strong>ไม่พบข้อมูล...</strong>
		</div>		
<?php	}else{ ?>
		<div class="alert alert-danger">
			<strong>ไม่พบข้อมูล...</strong>
		</div>		
<?php	}?>



