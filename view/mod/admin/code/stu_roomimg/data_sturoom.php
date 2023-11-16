<?php
	include("../../../../database/database_evaluation.php");
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");
	
	$txt_year=post_data(filter_input(INPUT_POST,'txt_year'));
	$txt_class=post_data(filter_input(INPUT_POST,'txt_class'));
	$txt_room=post_data(filter_input(INPUT_POST,'txt_room'));
	
	$txt_t=substr($txt_year,0,1);
	$txt_y=substr($txt_year,2,4);

	$txt_level=new print_level($txt_class);
	
		if($txt_class==3){
			$file_img="sud_img03";
		}elseif($txt_class>=11 and $txt_class<=22){
			$file_img="sud_img1122";
		}elseif($txt_class>=23 and $txt_class<=33){
			$file_img="sud_img2333";
		}elseif($txt_class>=41 and $txt_class<=43){
			$file_img="sud_img4143";
		}else{
			$file_img="all";
		}
    
//--------------------------------------------------------------------    
    include("../../../../img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
    
?>
<!--****************************************************************************-->			

 <script type="text/javascript">
        function setScreenHWCookie() {
            $.cookie('sw',screen.width);
                //$.cookie('sh',screen.height);
            return true;
        }
            setScreenHWCookie();
    </script>

    <?php
		$width_system=filter_input(INPUT_COOKIE,'sw');
		if($width_system>=1200){
			$grid="lg";
		}elseif($width_system<=992){
			$grid="md";
		}elseif($width_system<=768){
			$grid="sm";
		}else{
			$grid="xs";
		}
    ?>
<!--****************************************************************************-->

<div class="row">
	<div class="col-<?php echo $grid;?>-6">
		<center><a href="<?php echo $golink;?>/print_imgstu/print_roomimg/<?php echo $txt_t.'_'.$txt_y;?>/<?php echo $txt_class;?>/<?php echo $txt_room;?>" target="_blank"><button type="button" class="btn btn-default">Print</button></a></center>	
	</div>
	<div class="col-<?php echo $grid;?>-6">
		<center><a href="<?php echo $golink;?>/print_imgstu/print_student_card/<?php echo $txt_t.'_'.$txt_y;?>/<?php echo $txt_class;?>/<?php echo $txt_room;?>" target="_blank"><button type="button" class="btn btn-default">Student Card Print</button></a></center>	
	</div>	
</div>
<hr>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading">รายชื่อนักเรียน  ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></div>
			<div class="panel-body">
				<div class="row">
				<?php			
				$data_sturcroom=new data_sturoom($txt_t,$txt_y,$txt_class,$txt_room);	
				foreach($data_sturcroom->printdata_sturoom as $rc_key=>$sturcroom_rom){ 
					$rsc_num=$sturcroom_rom["rsc_num"];
					$rsd_studentid=$sturcroom_rom["rsd_studentid"];
					$rsd_Identification=$sturcroom_rom["rsd_Identification"];
					$data_prefix=new print_prefix($rsd_prefix=$sturcroom_rom["rsd_prefix"]);
					$data_plan=new print_plan($rsc_plan=$sturcroom_rom["rsc_plan"]);
					
					$name_th=$sturcroom_rom["rsd_name"]." ".$sturcroom_rom["rsd_surname"];
					$name_en="Miss ".$sturcroom_rom["rsd_nameEn"]." ".$sturcroom_rom["rsd_surnameEn"];
					
					
					$StatusName=$sturcroom_rom["StatusName"];
					$IDStatus=$sturcroom_rom["IDStatus"];
					
			/*if(file_exists("../../../../all/$rsd_studentid.jpg")){
				$user_img="view/all/$rsd_studentid.jpg";
			}else{
				if(file_exists("../../../../all/$rsd_studentid.JPG")){
					$user_img="view/all/$rsd_studentid.JPG";
				}else{
					$user_img="view/all/newimg_rc.jpg";
				}
			}*/

				if(file_exists("../../../../$file_img/$rsd_studentid.jpg")){
					$user_img="view/$file_img/$rsd_studentid.jpg";
				}else{
                    if(file_exists("../../../../$file_img/$rsd_studentid.JPG")){
                        $user_img="view/$file_img/$rsd_studentid.JPG";
                    }else{
						if($txt_class==22){
							if(file_exists("../../../../sud_img2333/$rsd_studentid.jpg")){
								$user_img="view/sud_img2333/$rsd_studentid.jpg";
							}else{
								if(file_exists("../../../../sud_img2333/$rsd_studentid.JPG")){
									 $user_img="view/sud_img2333/$rsd_studentid.JPG";
								}else{
									$user_img="view/sud_img2333/newimg_rc.jpg";
								}
							}
						}else{
							$user_img="view/$file_img/newimg_rc.jpg";							
						}
                    }
				}
				
				?>
				<div class="col-<?php echo $grid;?>-3">
					<center><img src="<?php echo $user_img;?>" class="img-thumbnail" alt="<?php echo $rsd_studentid;?> - <?php echo $name_th;?>" style="width: 304 px; height: 236px;" >
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
					<?php
							if($IDStatus=="1"){ ?>
					<p><?php echo $rsd_studentid;?>&nbsp;-&nbsp;<?php echo $name_th;?></p></center>		
					<?php	}else{ ?>
					<p><?php echo $rsd_studentid;?>&nbsp;-&nbsp;<?php echo $name_th;?>&nbsp;<small>(<?php echo $StatusName;?>)</small></p></center>		
					<?php	}?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
				</div>
			<?php	} ?>
				</div>
			</div>
		</div>
	</div>
</div>
