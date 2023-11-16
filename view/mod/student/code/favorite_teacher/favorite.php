
<?php include("../../../../database/database_evaluation.php"); ?>

<?php
		$data_tg=post_data($_POST["data_tg"]);
		$data_studentid=post_data($_POST["data_studentid"]);
		
		$count_t=post_data($_POST["stucount_t"]);
		
		if($count_t>3){
			$button='<button type="button" class="btn btn-primary disabled">โหวต</button>';
		}else{
			$button='<button type="submit" class="btn btn-primary">โหวต</button>';
		}
		
		
		if($data_tg==1){ ?>
<!--*************************************************************-->

	<?php
		/*$df_num="select count(`team_teacher`.`tt_rc`) as df_count from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`)
						join `team_teacher` on (`rc_person`.`IDTeacher`=`team_teacher`.`tt_rc`)
						join `team_teacher_group` on (`team_teacher`.`ttg_key`=`team_teacher_group`.`ttg_key`)
						where `rc_person`.`IDWorkStatus`='1' and `team_teacher`.`ttg_key`='{$data_tg}'; ";
		$df_numRs=rc_data($df_num);
		foreach($df_numRs as $rc_key=>$df_numRow){
			$df_count=$df_numRow["df_count"];
		}*/
	
	?>

	<div class="row">
			
	<?php
		$data_favorite="select `team_teacher`.`tt_rc`,`rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName`
					  ,`team_teacher_group`.`ttg_txt`,`team_teacher`.`tt_key`,`team_teacher_group`.`ttg_key`
						from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`)
						join `team_teacher` on (`rc_person`.`IDTeacher`=`team_teacher`.`tt_rc`)
						join `team_teacher_group` on (`team_teacher`.`ttg_key`=`team_teacher_group`.`ttg_key`)
						where `rc_person`.`IDWorkStatus`='1' and `team_teacher`.`ttg_key`='{$data_tg}';";
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
						<?php echo $button;?>
						<button type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าต่างนี้</button>
					</center>
				</div>
			</div>
			<input type="hidden" name="ft_student" value="<?php echo $data_studentid;?>"><!--รหัสนักเรียน-->
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
<!--*************************************************************-->	
<?php	}elseif($data_tg==2){ ?>
<!--*************************************************************-->

	<?php
		/*$df_num="select count(`team_teacher`.`tt_rc`) as df_count from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`)
						join `team_teacher` on (`rc_person`.`IDTeacher`=`team_teacher`.`tt_rc`)
						join `team_teacher_group` on (`team_teacher`.`ttg_key`=`team_teacher_group`.`ttg_key`)
						where `rc_person`.`IDWorkStatus`='1' and `team_teacher`.`ttg_key`='{$data_tg}'; ";
		$df_numRs=rc_data($df_num);
		foreach($df_numRs as $rc_key=>$df_numRow){
			$df_count=$df_numRow["df_count"];
		}*/
	
	?>

	<div class="row">
			
	<?php
		$data_favorite="select `team_teacher`.`tt_rc`,`rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName`
					  ,`team_teacher_group`.`ttg_txt`,`team_teacher`.`tt_key`,`team_teacher_group`.`ttg_key`
						from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`)
						join `team_teacher` on (`rc_person`.`IDTeacher`=`team_teacher`.`tt_rc`)
						join `team_teacher_group` on (`team_teacher`.`ttg_key`=`team_teacher_group`.`ttg_key`)
						where `rc_person`.`IDWorkStatus`='1' and `team_teacher`.`ttg_key`='{$data_tg}';";
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
						<?php echo $button;?>
						<button type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าต่างนี้</button>
					</center>
				</div>
			</div>
			<input type="hidden" name="ft_student" value="<?php echo $data_studentid;?>"><!--รหัสนักเรียน-->
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
<!--*************************************************************-->		
<?php	}elseif($data_tg==3){ ?>
<!--*************************************************************-->

	<?php
		/*$df_num="select count(`team_teacher`.`tt_rc`) as df_count from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`)
						join `team_teacher` on (`rc_person`.`IDTeacher`=`team_teacher`.`tt_rc`)
						join `team_teacher_group` on (`team_teacher`.`ttg_key`=`team_teacher_group`.`ttg_key`)
						where `rc_person`.`IDWorkStatus`='1' and `team_teacher`.`ttg_key`='{$data_tg}'; ";
		$df_numRs=rc_data($df_num);
		foreach($df_numRs as $rc_key=>$df_numRow){
			$df_count=$df_numRow["df_count"];
		}*/
	
	?>	

	<div class="row">
			
	<?php
		$data_favorite="select `team_teacher`.`tt_rc`,`rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName`
					  ,`team_teacher_group`.`ttg_txt`,`team_teacher`.`tt_key`,`team_teacher_group`.`ttg_key`
						from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`)
						join `team_teacher` on (`rc_person`.`IDTeacher`=`team_teacher`.`tt_rc`)
						join `team_teacher_group` on (`team_teacher`.`ttg_key`=`team_teacher_group`.`ttg_key`)
						where `rc_person`.`IDWorkStatus`='1' and `team_teacher`.`ttg_key`='{$data_tg}';";
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
							<textarea name="ft_reason" maxlength="100" cols="85" rows="2"   class="form-control"></textarea></h5>
						</div>
					</div>
				</div>	
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<center>
						<?php echo $button;?>
						<button type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าต่างนี้</button>
					</center>
				</div>
			</div>
			<input type="hidden" name="ft_student" value="<?php echo $data_studentid;?>"><!--รหัสนักเรียน-->
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
<!--*************************************************************-->		
<?php	}else{ ?>
<!--*************************************************************-->

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

	<div class="row">
			
	<?php
		$data_favorite="select `team_teacher`.`tt_rc`,`rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName`
					  ,`team_teacher_group`.`ttg_txt`,`team_teacher`.`tt_key`,`team_teacher_group`.`ttg_key`
						from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`)
						join `team_teacher` on (`rc_person`.`IDTeacher`=`team_teacher`.`tt_rc`)
						join `team_teacher_group` on (`team_teacher`.`ttg_key`=`team_teacher_group`.`ttg_key`)
						where `rc_person`.`IDWorkStatus`='1' and `team_teacher`.`ttg_key` !='4';";
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
						<?php echo $button;?>
						<button type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าต่างนี้</button>
					</center>
				</div>
			</div>
			<input type="hidden" name="ft_student" value="<?php echo $data_studentid;?>"><!--รหัสนักเรียน-->
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
	
			
<!--*************************************************************-->		
<?php	}?>




