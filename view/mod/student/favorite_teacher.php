
<?php
	 $ft_dataYear = 2562 ;

?>

<!-- Page header -->
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4><span class="text-semibold">โหวตคุณครูในดวงใจของหนู</span> ปีการศึกษา  <?php echo $ft_dataYear;?> </h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="index.php?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>โหวตคุณครูในดวงใจของหนู</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
<!-- /page header -->


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


		if($print_runtime=="OFF"){ ?>
			
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">แจ้งเตือนจากระบบ โหวตคุณครูในดวงใจของหนู ผ่านทางออนไลน์</div>
				<div class="panel-body"><center>ประเมินครูผู้สอน โหวตคุณครูในดวงใจของหนู  สิ้นสุดวันที่ 15 มกราคม 2563 เป็นต้นไป</center></div>
			</div>
		</div>
	</div>			
			
	<?php	}else{ ?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading"><center><h5><div id="demo"></div></h5></center></div>
			</div>
		</div>
	</div>	
	<div class="row">	
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="alert alert-warning">
								นักเรียนสามารถเลือกคุณครูในดวงใจ ได้ คน ละ 3 ท่าน 
							</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="form-group">
								<label>ครูในทีมชั้น</label>
								<select class="select-search" name="tg" id="tg">
									<option value="0">ทั้งหมด</option>
					<?php
						$team_teacher_group="SELECT * FROM `team_teacher_group` WHERE `ttg_key` !='4'";
						$team_teacher_groupRs=rc_array($team_teacher_group);
						foreach($team_teacher_groupRs as $rc_key =>$team_teacher_groupRow){ ?>
									<option value="<?php echo $team_teacher_groupRow["ttg_key"];?>"><?php echo $team_teacher_groupRow["ttg_txt"];?></option>
				    <?php	} ?>
								</select>
							</div>
						</div>
					</div>
					
			<?php
				$team_teacher="SELECT count(`ft_key`) as num_key 
				               FROM `favorite_teacher` 
							   WHERE `ft_year`='{$ft_dataYear}' and `ft_student`='{$user_login}';";
				$team_teacherRs=rc_data($team_teacher);
				
				foreach($team_teacherRs as $rc_key=>$team_teacherRow){
					$num_key=$team_teacherRow["num_key"];
				}
				
					if($num_key==0){ ?>
	<div class="alert alert-warning">
		ยังไม่ได้ โหวต คุณครูในดวงใจของหนู 
	</div>					
			<?php	}else{ ?>
	<form name="favorite_teacher" method="post" action="application/code_view/user/favorite_teacher/favorite_code.php"> 
		<div class="row">
	<?php
		$count_t=1;
		$data_favorite="select `team_teacher`.`tt_rc`,`rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName`
					  ,`team_teacher_group`.`ttg_txt`,`team_teacher`.`tt_key`,`team_teacher_group`.`ttg_key`,`favorite_teacher`.`ft_reason`,`favorite_teacher`.`ft_key`
						from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`)
						join `team_teacher` on (`rc_person`.`IDTeacher`=`team_teacher`.`tt_rc`)
						join `team_teacher_group` on (`team_teacher`.`ttg_key`=`team_teacher_group`.`ttg_key`)
						join `favorite_teacher` on (`rc_person`.`IDTeacher`=`favorite_teacher`.`tt_rc`)
						where `favorite_teacher`.`ft_student`='{$user_login}' and `favorite_teacher`.`ft_year`='{$ft_dataYear}';";
		$data_favoriteRs=rc_array($data_favorite);
		foreach($data_favoriteRs as $rc_key =>$data_favoriteRow){ 
		$t_name=$data_favoriteRow["prefixname"]." ".$data_favoriteRow["FName"]." ".$data_favoriteRow["SName"];
		$tt_rc=$data_favoriteRow["tt_rc"];
		$ttg_key=$data_favoriteRow["ttg_key"];
		$tt_key=$data_favoriteRow["tt_key"]; 
		$ft_reason=$data_favoriteRow["ft_reason"];
		$ft_key=$data_favoriteRow["ft_key"];?>
		
			<div class="col-sm-4 col-md-4 col-lg-4">
			    <div class="thumbnail">
					
						<img src="view/t/<?php echo $data_favoriteRow["tt_rc"];?>.jpg" style="width: 140px; height: 206px" class="img-thumbnail">
						<center><button type="submit" name="ft_key" class="btn" value="<?php echo $ft_key;?>">แก้ไข</button></center>
					<div class="caption">
						<p><?php echo $t_name;?></p>
						<p><?php echo $ft_reason;?></p>
					</div>
					
				</div>
			</div>
<?php	$count_t=$count_t+1;}
		
		
		if($count_t==""){
			$count_copy=0;
		}else{
			$count_copy=$count_t;
		}
?>	
		

		</div>
		<input type="hidden" name="code_system" value="delete">
		<input type="hidden" name="count_t" id="count_t" value="<?php echo $count_copy; ?>">
	</form>						
			<?php	}?>		
						
						
<?php
		
	

		error_reporting(error_reporting() & ~E_NOTICE);
		if($count_copy>3){
			$button='<button type="button" class="btn btn-primary disabled">โหวต</button>';
		}else{
			$button='<button type="submit" class="btn btn-primary">โหวต</button>';
		}
?>
						
				</div>
				<div class="panel-body">
				
				<div id="show_enter">
<!--All-->				
	<div class="row">
			
	<?php
		/*$df_num="select count(`team_teacher`.`tt_rc`) as df_count from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`)
						join `team_teacher` on (`rc_person`.`IDTeacher`=`team_teacher`.`tt_rc`)
						join `team_teacher_group` on (`team_teacher`.`ttg_key`=`team_teacher_group`.`ttg_key`)
						where `rc_person`.`IDWorkStatus`='1' and `team_teacher`.`ttg_key` !='4'; ";
		$df_numRs=rc_data($df_num);
		foreach($df_numRs as $rc_key=>$df_numRow){
			$df_count=$df_numRow["df_count"];
		}*/
	
	?>		
			
			
			
	<?php
		$data_favorite="select `team_teacher`.`tt_rc`,`rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName`
					  ,`team_teacher_group`.`ttg_txt`,`team_teacher`.`tt_key`,`team_teacher_group`.`ttg_key`
						from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`)
						join `team_teacher` on (`rc_person`.`IDTeacher`=`team_teacher`.`tt_rc`)
						join `team_teacher_group` on (`team_teacher`.`ttg_key`=`team_teacher_group`.`ttg_key`)
						where `rc_person`.`IDWorkStatus`='1' and `team_teacher`.`ttg_key` !='4'; ";
		$data_favoriteRs=rc_array($data_favorite);
		$count_data=1;
		foreach($data_favoriteRs as $rc_key =>$data_favoriteRow){ 
		$t_name=$data_favoriteRow["prefixname"]." ".$data_favoriteRow["FName"]." ".$data_favoriteRow["SName"];
		$tt_rc=$data_favoriteRow["tt_rc"];
		$ttg_key=$data_favoriteRow["ttg_key"];
		$tt_key=$data_favoriteRow["tt_key"];
		
		?>
			
	
		<?php
				if($count_data%6==0){ ?> 
				
		<div class="col-sm-2 col-md-2 col-lg-2">
		
		    <div class="thumbnail">
				<a id="myBtn<?php echo $data_favoriteRow["tt_rc"];?>">
					<img src="view/t/<?php echo $data_favoriteRow["tt_rc"];?>.jpg" style="width: 180px; height: 226px">
					
				<div class="caption">
					<p><?php echo $t_name;?></p>
				</div>
				</a>
			</div>		
		
		</div>					
				
	</div><hr>
	<div class="row">		
									
		<?php	}else{ ?>

		<div class="col-sm-2 col-md-2 col-lg-2">
		
		    <div class="thumbnail">
				<a id="myBtn<?php echo $data_favoriteRow["tt_rc"];?>">
					<img src="view/t/<?php echo $data_favoriteRow["tt_rc"];?>.jpg" style="width: 180px; height: 226px">
					
				<div class="caption">
					<p><?php echo $t_name;?></p>
				</div>
				</a>
			</div>		
		
		</div>					
		

		
		<?php	} ?>
		

		<div class="modal fade" id="myModal<?php echo $data_favoriteRow["tt_rc"];?>" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
		<div class="modal-content">
        <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h4 class="modal-title">คุณครูในดวงใจของหนู</h4>
        </div>
        <div class="modal-body">
<!--****************************************-->
		<form name="favorite" class="form-inline" method="post" action="application/code_view/user/favorite_teacher/favorite_code.php"> 	
			<div class="row">
				<div class="col-sm-3 col-md-3 col-lg-3">
					<img src="view/t/<?php echo $data_favoriteRow["tt_rc"];?>.jpg" style="width: 180px; height: 226px" class="img-thumbnail" >
				</div>
				<div class="col-sm-8 col-md-8 col-lg-8">
					<div class="row col-sm-12 col-md-12 col-lg-12">
						<div class="form-group">
							<h5><label for="email">ชื่อคุณครู : </label>
							<?php echo $t_name;?></h5>
						</div>					
					</div>
					<div class="row col-sm-12 col-md-12 col-lg-12">
						<div class="form-group">
						<h5><label for="email">ทีมชั้น : </label>
						<?php echo $data_favoriteRow["ttg_txt"];?></h5>
						</div>					
					</div>
					<div class="row col-sm-12 col-md-12 col-lg-12">
						<div class="form-group">
						<h5><label for="email">เหตุผล : </label>
							<textarea name="ft_reason" maxlength="100" cols="85" rows="2" required  class="form-control"></textarea></h5>
						</div>
					</div>
				</div>	
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<center>
						<!--<button type="submit" class="btn btn-primary">โหวต</button>-->
						<?php echo $button ; ?>
						<button type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าต่างนี้</button>
					</center>
				</div>
			</div>
			<input type="hidden" name="ft_student" value="<?php echo $user_login;?>"><!--รหัสนักเรียน-->
			<input type="hidden" name="tt_key" value="<?php echo $tt_key;?>">
			<input type="hidden" name="tt_rc" value="<?php echo $tt_rc;?>">
			<input type="hidden" name="ttg_key" value="<?php echo $ttg_key;?>">
			
			<input type="hidden" name="code_system" value="add">
		</form>
<!--****************************************-->				  
        </div>
        <div class="modal-footer">
			
        </div>
		</div>
      
    </div>
		</div>
		
		
		
		
		
<script>
$(document).ready(function(){

  $("#myBtn<?php echo $data_favoriteRow["tt_rc"];?>").click(function(){
    $("#myModal<?php echo $data_favoriteRow["tt_rc"];?>").modal({backdrop: false});
  });

});
</script>
			
	<?php	$count_data=$count_data+1;}  ?>		
	</div>				
<!-- End All-->				
				</div>
			
				</div>
			</div>
		
		</div>
	</div>			
			
	<?php	}?>

		
		





