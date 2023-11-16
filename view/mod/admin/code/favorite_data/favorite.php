
<?php
	include("../../../../database/database_evaluation.php");
	$rcdata_connect= connect();
	$copy_year=$evaluation_sql->real_escape_string(htmlspecialchars($_POST["copy_year"]));
?>

<div class="row">
<?php 
	$rc_level="SELECT `IDLevel`,`Lname` as txtLevel FROM `rc_level` WHERE `IDLevel` >=21 and `IDLevel` <=43";
	$rc_levelRs=rc_array($rc_level);
	
	foreach($rc_levelRs as $rc_key=>$rc_levelRow){ 
		$txtLevel=$rc_levelRow["txtLevel"];
		$IDLevel=$rc_levelRow["IDLevel"];
	?>
		
		
	<?php
		$favorite_teacher="select count( DISTINCT `regina_stu_class`.`rsd_studentid`) as numstudent 
		                   from `regina_stu_class` 
						   join `rc_level` on(`regina_stu_class`.`rsc_class`=`rc_level`.`IDLevel`) 
						   join `favorite_teacher` on(`regina_stu_class`.`rsd_studentid`=`favorite_teacher`.`ft_student`) 
						   WHERE `favorite_teacher`.`ft_year`='{$copy_year}' 
						   and `rc_level`.`IDLevel`='{$IDLevel}'";
		$favorite_teacherRs=$rcdata_connect->query($favorite_teacher) or die($rcdata_connect->error);
		if($favorite_teacherRs->num_rows>0){
			$favorite_teacherRow=$favorite_teacherRs->fetch_assoc();
			$numstudent=$favorite_teacherRow["numstudent"];
		}else{
			$numstudent=0;
		}
	?>	
				
		<div class="col-sm-3 col-md-3 col-lg-3">							
			<div class="panel panel-body bg-success-400 has-bg-image">
				<div class="media no-margin">
					<div class="media-left media-middle">
						<i class="icon-hammer2 icon-3x opacity-75"></i>
					</div>

					<div class="media-body text-right">
						<h3 class="no-margin"><?php echo $numstudent;?></h3>
						<span class="text-uppercase"><?php echo $txtLevel;?></span>
					</div>
				</div>
			</div>	
		</div>
		
		
<?php	} ?>
</div>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<p>* ข้อมูลปี <?php echo $copy_year;?><p>
	</div>
</div>


