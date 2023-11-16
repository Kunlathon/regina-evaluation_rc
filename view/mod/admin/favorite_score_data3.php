<?php
	$copy_year=2562;
?>
<!-- Page header -->

<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ผลคะแนน </span> - โหวตคุณครูในดวงใจของหนู </h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>การจัดการ คุณครูในดวงใจของหนู</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=favorite_score" class="btn btn-link  text-size-small"><span>ผลคะแนน โหวตคุณครูในดวงใจของหนู ครูทีมชั้น สนับสนุน</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<!-- /page header -->

<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
<!------------------------------------------------------------------------>			
		<div class="table-responsive">
		
			<table class="table datatable-button-html5-columns">
				<thead>
					<tr>
						<th>ลำดับ</th>
						<th>ชื่อ - สกุล</th>
						<th>คะแนน</th>
					</tr>
				</thead>
				<tbody>
				
<?php
	$print_data="select `rc_person`.`IDTeacher`,`rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName`,`favorite_score`.`fc_score`,`team_teacher_group`.`ttg_txt` 
			     from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`) 
			     join `team_teacher` on(`rc_person`.`IDTeacher`=`team_teacher`.`tt_rc`) 
				 join `team_teacher_group` on(`team_teacher`.`ttg_key`=`team_teacher_group`.`ttg_key`) 
				 join `favorite_score` on(`team_teacher`.`tt_rc`=`favorite_score`.`fc_teacher`) 
				 where `favorite_score`.`fc_yaer`='{$copy_year}' 
				 and `team_teacher`.`ttg_key`='3' 
				 ORDER BY `favorite_score`.`fc_score` DESC";
	$print_dataRs=rc_array($print_data);

	foreach($print_dataRs as $rc_key =>$print_dataRow){
		$IDTeacher=$print_dataRow["IDTeacher"];
		$myname=$print_dataRow["prefixname"]." ".$print_dataRow["FName"]." ".$print_dataRow["SName"];
		$fc_score=$print_dataRow["fc_score"]; ?>
		
					<tr>
						<td><?php echo $IDTeacher;?></td>
						<td><?php echo $myname;?></td>
						<td><?php echo $fc_score ;?></td>
					</tr>		
		
<?php	} ?>				

				</tbody>
			</table>
		

		</div>
<!------------------------------------------------------------------------>			
			</div>
		</div>	
	

	</div>
</div>

