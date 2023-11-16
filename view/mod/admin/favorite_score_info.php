<?php
	$copy_year=2562;
?>
<!-- Page header -->

<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4><span class="text-semibold">ข้อมูล </span> - โหวตคุณครูในดวงใจของหนู </h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>การจัดการ คุณครูในดวงใจของหนู</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=favorite_score" class="btn btn-link  text-size-small"><span>ข้อมูล โหวตคุณครูในดวงใจของหนู</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<!-- /page header -->


<?php
	$TeacherKey=post_data($_GET["TeacherKey"]);
	$TeacherKey=decode($TeacherKey);
	if(isset($TeacherKey)){
		if($TeacherKey==""){
			//Error
		}else{ ?>
<!--****************************************************************-->	
<?php
//Data:  rc_person 
	$data_rc_person="select `rc_person`.`IDTeacher`,`rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName`,`team_teacher_group`.`ttg_txt` from rc_person join rc_prefix on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`)
					 join `team_teacher` on(`rc_person`.`IDTeacher`=`team_teacher`.`tt_rc`)
					 join `team_teacher_group` on(`team_teacher`.`ttg_key`=`team_teacher_group`.`ttg_key`)
					 where `rc_person`.`IDTeacher`='{$TeacherKey}';";
	$data_rc_personRs=rc_data($data_rc_person);
	
	foreach($data_rc_personRs as $rc_key=>$data_rc_personRow){
		$IDTeacher=$data_rc_personRow["IDTeacher"];
		$myname=$data_rc_personRow["prefixname"]." ".$data_rc_personRow["FName"]." ".$data_rc_personRow["SName"];	
		$ttg_txt=$data_rc_personRow["ttg_txt"];
	}
//Data:  rc_person End
?>

<div class="row">
	<div class="col-sm-3 col-md-3 col-lg-3">
							<div class="thumbnail no-padding">
								<div class="thumb">
									<img  src="view/t/<?php echo $IDTeacher;?>.jpg" alt=""  >
								</div>
						    	<div class="caption text-center">
						    		<h6 class="text-semibold no-margin"><?php echo $myname; ?> <small class="display-block"><?php echo $ttg_txt;?></small></h6>
						    	</div>
					    	</div>
	</div>
	<div class="col-sm-9 col-md-9 col-lg-9">
		<div class="row">
			
			
			<?php
				$print_level="select IDLevel,Sort_name,Lname 
							  from rc_level
							  where IDLevel >= 21 and IDLevel <= 43 ";
				$print_levelRs=rc_array($print_level);
				$sum_scoreAll=0;
				foreach($print_levelRs as $rc_key =>$print_levelRow){ ?>
				
					<?php
						$score_teacherSql="select count(`favorite_teacher`.`ft_key`) as score_teacher 
									       from `regina_stu_class` join `favorite_teacher` on(`regina_stu_class`.`rsd_studentid`=`favorite_teacher`.`ft_student`)
                                           where `regina_stu_class`.`rsc_class`='{$print_levelRow["IDLevel"]}' and `regina_stu_class`.`rsc_year`='{$copy_year}' and `favorite_teacher`.`tt_rc`='{$TeacherKey}';";
						$score_teacherRs=rc_data($score_teacherSql);
						
						foreach($score_teacherRs as $rc_key =>$score_teacherRow){
							$score_teacher=$score_teacherRow["score_teacher"];
						}
						
						$sum_scoreAll=$sum_scoreAll+$score_teacher;
				
					?>
				
				
				
				
				
			<div class="col-sm-3 col-md-3 col-lg-3">		
				<div class="panel panel-body bg-blue-400 has-bg-image">
					<div class="media no-margin">
						<div class="media-body">
							<h3 class="no-margin"><?php echo $score_teacher;?></h3>
							<span class="text-uppercase text-size-mini"><?php echo $print_levelRow["Lname"];?></span>
						</div>

						<div class="media-right media-middle">
							<i class="icon-bubbles4 icon-3x opacity-75"></i>
						</div>
					</div>
				</div>					
			</div>		
			
			
			
		    <?php   }  ?>
				<div class="col-sm-3 col-md-3 col-lg-3">
					<div class="panel panel-body bg-danger-400 has-bg-image">
						<div class="media no-margin">
							<div class="media-body">
								<h3 class="no-margin"><?php echo $sum_scoreAll;?></h3>
								<span class="text-uppercase text-size-mini">รวมทั้งหมด</span>
							</div>

							<div class="media-right media-middle">
								<i class="icon-user icon-3x opacity-75"></i>
							</div>
						</div>
					</div>		
				</div>		
		</div>
				
	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading">เหตุผล คุณครูในดวงใจของหนู จากนักเรียน</div>
			<div class="panel-body">
				<div class="table-responsive">

					<table border="1" class="table table-bordered datatable-button-html5-columns2" width="100%">
						<thead>
							<tr>
								<td colspan="1" align="center"><b>เหตุผล คุณครูในดวงใจของหนู จากนักเรียน </b></td>
							</tr>
						</thead>
						<tbody>
						
			<?php
				$comment_student="select ft_reason 
								  from favorite_teacher 
								  where tt_rc='{$TeacherKey}';";
				$comment_studentRs=rc_array($comment_student);
				
				foreach($comment_studentRs as $rc_key => $comment_studentRow){ ?>
					
							<tr>
								<td><?php echo $comment_studentRow["ft_reason"]; ?></td>
							</tr>					
					
			<?php	}   ?>			
						
						


						</tbody>
					</table>

				</div>			
			</div>
		</div>
	</div>
</div>






<!--****************************************************************-->	
<?php   }
	}else{
		//Error
	}
?>




