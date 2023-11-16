<?php
	include("../../../../database/database_evaluation.php");
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");
	//$rcdata_connect=connect();
	
	$txt_year=post_data(filter_input(INPUT_POST,'txt_year'));
	$txt_class=post_data(filter_input(INPUT_POST,'txt_class'));
	
	$txt_t=substr($txt_year,0,1);
	$txt_y=substr($txt_year,2,4);
	
   
   $count_roomSql="SELECT `rsc_room` FROM `regina_stu_class` 
				   WHERE `rsc_year` = '{$txt_y}' 
				   AND `rsc_term` = '{$txt_t}' 
				   AND `rsc_class` = '{$txt_class}' 
				   ORDER BY `rsc_room` 
				   DESC LIMIT 0,1";
   $count_room=new pdo_notarray($count_roomSql);
   
    foreach($count_room->print_pdonotarray as $rc_key=>$count_roomRow){
	   $rsc_room=$count_roomRow["rsc_room"];
    }
	

	
	
	
?>

								<select class="select" name="stu_room" id="stu_room">
									<option value="">เลือกห้องเรียน</option>
							<?php
								$count_pdo=1;
								while($count_pdo<=$rsc_room){ ?>
									<option value="<?php echo $count_pdo;?>">ห้อง <?php echo $count_pdo;?></option>
						<?php	$count_pdo=$count_pdo+1;} ?>		
									
								</select>