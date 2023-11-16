<?php
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_pdo.php");
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
		if(($width_system>=1200)){
			$grid="lg";
		}elseif(($width_system<=992)){
			$grid="md";
		}elseif(($width_system<=768)){
			$grid="sm";
		}else{
			$grid="xs";
		}
    ?>
	
	<?php
		$data_term=filter_input(INPUT_POST,'copy_term');     
		$data_year=filter_input(INPUT_POST,'copy_year');    
		$data_class=filter_input(INPUT_POST,'copy_class');     

        //echo $data_term." ".$data_year." ".$data_class;
	?>
	
<!--****************************************************************************-->	

<?php
		if(($data_class>=3 and $data_class<=11)){ ?>
<!--//////////////////////////////////////////////////////////////////////////////-->
<div class="row">
	<div  class="col-<?php echo $grid;?>-12">
	​    <div class="panel panel-info">
			<div class="panel-heading">ลงทะเบียนเรียนเสริมนอกเวลาเรียน ภาคเรียน <?php echo $data_term." / ".$data_year;?></div>
			<div class="panel-body">
		  
				<div class="table-responsive">
					  <table class="table table-hover">
						<thead>
						  <tr>
							<th>รหัสวิชา</th>
							<th>ชื่อวิชา</th>

		<?php
				$print_supp_day=new supplementary_day();
				if(($print_supp_day->sd_mon=="ON")){ ?>
							<th>วันจันทร์</th>
		<?php	}elseif($print_supp_day->sd_mon=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}      ?>
					
		<?php	if(($print_supp_day->sd_tue=="ON")){ ?>
							<th>วันอังคาร</th>
		<?php	}elseif(($print_supp_day->sd_tue=="OFF")){ ?>
						
		<?php	}else{ ?>
						
		<?php	}	   ?>				
					
		<?php	if(($print_supp_day->sd_wed=="ON")){ ?>
							<th>วันพุธ</th>
		<?php	}elseif(($print_supp_day->sd_wed=="OFF")){ ?>
						
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
											   and `ss_l`='{$data_class}' 
											   and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){  ?>
						
			
						<tr>
								<td><?php echo $supplementary_subjectRow["ss_id"];?></td>
								<td><?php echo $supplementary_subjectRow["ss_txtth"];?></td>
								
				<?php
					$print_daysubject=new supplementary_daysubject($supplementary_subjectRow["ss_id"]);	
				?>
				
		<?php
				$print_supp_day=new supplementary_day();
				if(($print_supp_day->sd_mon=="ON")){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if(($print_daysubject->sds_mon=="ON")){ ?>
<!--***************************************************************************************************-->
				<?php
					$IntSudSuppMon=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,0,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_MonCount`,`subject_MonKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_MonCount=$supplementary_subjectRow["subject_MonCount"];
						//$subject_MonKeep=$supplementary_subjectRow["subject_MonKeep"];
						if(($IntSudSuppMon->ShowIntSudSupplementary()>=$subject_MonCount)){ ?>
<!--*****************************************************************************************************-->	
								<td><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Mon&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Mon&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppMon->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>						
<!--***************************************************************************************************-->						
			<?php	}elseif($print_daysubject->sds_mon=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}elseif($print_supp_day->sd_mon=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}      ?>
					
		<?php	if($print_supp_day->sd_tue=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_tue=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppTues=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,1,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_TuesCount`,`subject_TuesKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_TuesCount=$supplementary_subjectRow["subject_TuesCount"];
						//$subject_TuesKeep=$supplementary_subjectRow["subject_TuesKeep"];
						if($IntSudSuppTues->ShowIntSudSupplementary()>=$subject_TuesCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Tues&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppTues->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_tue=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_tue=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}	   ?>				
					
		<?php	if($print_supp_day->sd_wed=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_wed=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppWednes=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,2,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_WednesCount`,`subject_WednesKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_WednesCount=$supplementary_subjectRow["subject_WednesCount"];
						//$subject_WednesKeep=$supplementary_subjectRow["subject_WednesKeep"];
						if($IntSudSuppWednes->ShowIntSudSupplementary()>=$subject_WednesCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Tues&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Wednes&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppWednes->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_wed=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_wed=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}	   ?>					
					
		<?php	if($print_supp_day->sd_thu=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_thu=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppThurs=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,3,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_ThursCount`,`subject_ThursKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_ThursCount=$supplementary_subjectRow["subject_ThursCount"];
						//$subject_ThursKeep=$supplementary_subjectRow["subject_ThursKeep"];
						if($IntSudSuppThurs->ShowIntSudSupplementary()>=$subject_ThursCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Tues&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Thurs&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppThurs->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
			<?php	}elseif($print_daysubject->sds_thu=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif(($print_supp_day->sd_thu=="OFF")){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>					
				
		<?php	if(($print_supp_day->sd_frl=="ON")){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if(($print_daysubject->sds_frl=="ON")){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppFri=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,4,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_FriCount`,`subject_FriKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_FriCount=$supplementary_subjectRow["subject_FriCount"];
						//$subject_FriKeep=$supplementary_subjectRow["subject_FriKeep"];
						if(($IntSudSuppFri->ShowIntSudSupplementary()>=$subject_FriCount)){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=fri&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม </b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=fri&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppFri->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif(($print_daysubject->sds_frl=="OFF")){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_frl=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>					
					
		<?php	if(($print_supp_day->sd_sat=="ON")){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if(($print_daysubject->sds_sat=="ON")){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppSatur=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,5,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_SaturCount`,`subject_SaturKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_SaturCount=$supplementary_subjectRow["subject_SaturCount"];
						//$subject_SaturKeep=$supplementary_subjectRow["subject_SaturKeep"];
						if($IntSudSuppSatur->ShowIntSudSupplementary()>=$subject_SaturCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Satur&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppSatur->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_sat=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_sat=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>

		<?php	if($print_supp_day->sd_sun=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_sun=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppSun=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,6,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_SunCount`,`subject_SunKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_SunCount=$supplementary_subjectRow["subject_SunCount"];
						//$subject_SunKeep=$supplementary_subjectRow["subject_SunKeep"];
						if($IntSudSuppSun->ShowIntSudSupplementary()>=$subject_SunCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppSun->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_sun=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_sun=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>
				
				
				
				
				
				
				
				
									
						</tr>	
					
					
				<?php	}  ?>
						
						
						

			
							</tbody>

					  </table>
				</div>
		  
		  

		  
		  
		  
		  
		  
		  
		  
			</div>
		</div>	
	</div>
</div>
<!--//////////////////////////////////////////////////////////////////////////////-->			
<?php	}elseif(($data_class>=12 and $data_class<=23)){ ?>
<!--//////////////////////////////////////////////////////////////////////////////-->
<div class="row">
	<div  class="col-<?php echo $grid;?>-12">
	​    <div class="panel panel-info">
			<div class="panel-heading">ลงทะเบียนเรียนเสริมนอกเวลาเรียน ภาคเรียน <?php echo $data_term." / ".$data_year;?></div>
			<div class="panel-body">
		  
				<div class="table-responsive">
					  <table class="table table-hover">
						<thead>
						  <tr>
							<th>รหัสวิชา</th>
							<th>ชื่อวิชา</th>

		<?php
				$print_supp_day=new supplementary_day();
				if(($print_supp_day->sd_mon=="ON")){ ?>
							<th>วันจันทร์</th>
		<?php	}elseif(($print_supp_day->sd_mon=="OFF")){ ?>
						
		<?php	}else{ ?>
						
		<?php	}      ?>
					
		<?php	if(($print_supp_day->sd_tue=="ON")){ ?>
							<th>วันอังคาร</th>
		<?php	}elseif(($print_supp_day->sd_tue=="OFF")){ ?>
						
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
					
		<?php	if(($print_supp_day->sd_sat=="ON")){?>
							<th>วันเสาร์</th>
		<?php	}elseif(($print_supp_day->sd_sat=="OFF")){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>

		<?php	if(($print_supp_day->sd_sun=="ON")){?>
							<th>วันอาทิตย์</th>
		<?php	}elseif(($print_supp_day->sd_sun=="OFF")){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>							
						  </tr>
						</thead>

							<tbody>
				<?php
					$supplementary_subjectSql="SELECT `ss_id`, `ss_t`, `ss_l`, `ss_year`, `ss_txtth`, `ss_txten`,  `ss_plan`, `ss_rc` 
									           FROM `supplementary_subject` 
											   WHERE `ss_t`='{$data_term}' 
											   and `ss_l`='{$data_class}' 
											   and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){  ?>
						
			
						<tr>
								<td><?php echo $supplementary_subjectRow["ss_id"];?></td>
								<td><?php echo $supplementary_subjectRow["ss_txtth"];?></td>
								
				<?php
					$print_daysubject=new supplementary_daysubject($supplementary_subjectRow["ss_id"]);	
				?>
				
		<?php
				$print_supp_day=new supplementary_day();
				if($print_supp_day->sd_mon=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_mon=="ON"){ ?>
<!--***************************************************************************************************-->
				<?php
				    $IntSudSuppMon=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,0,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_MonCount`,`subject_MonKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_MonCount=$supplementary_subjectRow["subject_MonCount"];
						//$subject_MonKeep=$supplementary_subjectRow["subject_MonKeep"];
						if($IntSudSuppMon->ShowIntSudSupplementary()>=$subject_MonCount){ ?>
<!--*****************************************************************************************************-->	
								<td><b style="color: #F80B0F"><?php echo $data_year;?></b></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Mon&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppMon->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>						
<!--***************************************************************************************************-->						
			<?php	}elseif($print_daysubject->sds_mon=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}elseif($print_supp_day->sd_mon=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}      ?>
					
		<?php	if($print_supp_day->sd_tue=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_tue=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppTues=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,1,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_TuesCount`,`subject_TuesKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_TuesCount=$supplementary_subjectRow["subject_TuesCount"];
						//$subject_TuesKeep=$supplementary_subjectRow["subject_TuesKeep"];
						if($IntSudSuppTues->ShowIntSudSupplementary()>=$subject_TuesCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Tues&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppTues->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_tue=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_tue=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}	   ?>				
					
		<?php	if($print_supp_day->sd_wed=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_wed=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppWednes=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,2,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_WednesCount`,`subject_WednesKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_WednesCount=$supplementary_subjectRow["subject_WednesCount"];
						//$subject_WednesKeep=$supplementary_subjectRow["subject_WednesKeep"];
						if($IntSudSuppWednes->ShowIntSudSupplementary()>=$subject_WednesCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Wednes&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppWednes->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_wed=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_wed=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}	   ?>					
					
		<?php	if($print_supp_day->sd_thu=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_thu=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppThurs=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,3,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_ThursCount`,`subject_ThursKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_ThursCount=$supplementary_subjectRow["subject_ThursCount"];
						//$subject_ThursKeep=$supplementary_subjectRow["subject_ThursKeep"];
						if($IntSudSuppThurs->ShowIntSudSupplementary()>=$subject_ThursCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Thurs&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppThurs->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
			<?php	}elseif($print_daysubject->sds_thu=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_thu=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>					
				
		<?php	if($print_supp_day->sd_frl=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_frl=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppFri=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,4,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_FriCount`,`subject_FriKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_FriCount=$supplementary_subjectRow["subject_FriCount"];
						//$subject_FriKeep=$supplementary_subjectRow["subject_FriKeep"];
						if($IntSudSuppFri->ShowIntSudSupplementary()>=$subject_FriCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=fri&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppFri->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_frl=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_frl=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>					
					
		<?php	if($print_supp_day->sd_sat=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_sat=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
				    $IntSudSuppSatur=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,5,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_SaturCount`,`subject_SaturKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_SaturCount=$supplementary_subjectRow["subject_SaturCount"];
						//$subject_SaturKeep=$supplementary_subjectRow["subject_SaturKeep"];
						if($IntSudSuppSatur->ShowIntSudSupplementary()>=$subject_SaturCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Satur&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppSatur->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_sat=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_sat=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>

		<?php	if($print_supp_day->sd_sun=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_sun=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppSun=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,6,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_SunCount`,`subject_SunKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_SunCount=$supplementary_subjectRow["subject_SunCount"];
						//$subject_SunKeep=$supplementary_subjectRow["subject_SunKeep"];
						if($IntSudSuppSun->ShowIntSudSupplementary()>=$subject_SunCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppSun->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_sun=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_sun=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>
				
				
				
				
				
				
				
				
									
						</tr>	
					
					
				<?php	}  ?>
						
						
						

			
							</tbody>

					  </table>
				</div>
		  
		  

		  
		  
		  
		  
		  
		  
		  
			</div>
		</div>	
	</div>
</div>
<!--//////////////////////////////////////////////////////////////////////////////-->		
<?php	}elseif(($data_class>=31 and $data_class<=33)){ ?>
<!--//////////////////////////////////////////////////////////////////////////////-->
<div class="row">
	<div  class="col-<?php echo $grid;?>-12">
	​    <div class="panel panel-info">
			<div class="panel-heading">ลงทะเบียนเรียนเสริมนอกเวลาเรียน ภาคเรียน <?php echo $data_term." / ".$data_year;?></div>
			<div class="panel-body">
		  
				<div class="table-responsive">
					  <table class="table table-hover">
						<thead>
						  <tr>
							<th>รหัสวิชา</th>
							<th>ชื่อวิชา</th>

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
											   and `ss_l`='{$data_class}' 
											   and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){  ?>
						
			
						<tr>
								<td><?php echo $supplementary_subjectRow["ss_id"];?></td>
								<td><?php echo $supplementary_subjectRow["ss_txtth"];?></td>
								
				<?php
					$print_daysubject=new supplementary_daysubject($supplementary_subjectRow["ss_id"]);	
				?>
				
		<?php
				$print_supp_day=new supplementary_day();
				if($print_supp_day->sd_mon=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_mon=="ON"){ ?>
<!--***************************************************************************************************-->
				<?php
					$IntSudSuppMon=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,'0',$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_MonCount`,`subject_MonKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_MonCount=$supplementary_subjectRow["subject_MonCount"];
						//$subject_MonKeep=$supplementary_subjectRow["subject_MonKeep"];
						if($IntSudSuppMon->ShowIntSudSupplementary()>=$subject_MonCount){ ?>
<!--*****************************************************************************************************-->	
								<td><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Mon&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Mon&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppMon->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>						
<!--***************************************************************************************************-->						
			<?php	}elseif($print_daysubject->sds_mon=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}elseif($print_supp_day->sd_mon=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}      ?>
					
		<?php	if($print_supp_day->sd_tue=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_tue=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppTues=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,1,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_TuesCount`,`subject_TuesKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_TuesCount=$supplementary_subjectRow["subject_TuesCount"];
						//$subject_TuesKeep=$supplementary_subjectRow["subject_TuesKeep"];
						if($IntSudSuppTues->ShowIntSudSupplementary()>=$subject_TuesCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Tues&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppTues->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_tue=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_tue=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}	   ?>				
					
		<?php	if($print_supp_day->sd_wed=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_wed=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppWednes=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,2,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_WednesCount`,`subject_WednesKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_WednesCount=$supplementary_subjectRow["subject_WednesCount"];
						//$subject_WednesKeep=$supplementary_subjectRow["subject_WednesKeep"];
						if($IntSudSuppWednes->ShowIntSudSupplementary()>=$subject_WednesCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Wednes&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppWednes->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_wed=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_wed=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}	   ?>					
					
		<?php	if($print_supp_day->sd_thu=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_thu=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppThurs=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,3,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_ThursCount`,`subject_ThursKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_ThursCount=$supplementary_subjectRow["subject_ThursCount"];
						//$subject_ThursKeep=$supplementary_subjectRow["subject_ThursKeep"];
						if($IntSudSuppThurs->ShowIntSudSupplementary()>=$subject_ThursCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Thurs&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppThurs->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
			<?php	}elseif($print_daysubject->sds_thu=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_thu=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>					
				
		<?php	if($print_supp_day->sd_frl=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_frl=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppFri=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,4,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_FriCount`,`subject_FriKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_FriCount=$supplementary_subjectRow["subject_FriCount"];
						//$subject_FriKeep=$supplementary_subjectRow["subject_FriKeep"];
						if($IntSudSuppFri->ShowIntSudSupplementary()>=$subject_FriCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=fri&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppFri->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_frl=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_frl=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>					
					
		<?php	if($print_supp_day->sd_sat=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_sat=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppSatur=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,5,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_SaturCount`,`subject_SaturKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_SaturCount=$supplementary_subjectRow["subject_SaturCount"];
						//$subject_SaturKeep=$supplementary_subjectRow["subject_SaturKeep"];
						if($IntSudSuppSatur->ShowIntSudSupplementary()>=$subject_SaturCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Satur&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppSatur->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_sat=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_sat=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>

		<?php	if($print_supp_day->sd_sun=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_sun=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppSun=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,6,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_SunCount`,`subject_SunKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_SunCount=$supplementary_subjectRow["subject_SunCount"];
						//$subject_SunKeep=$supplementary_subjectRow["subject_SunKeep"];
						if($IntSudSuppSun->ShowIntSudSupplementary()>=$subject_SunCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppSun->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_sun=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_sun=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>
				
				
				
				
				
				
				
				
									
						</tr>	
					
					
				<?php	}  ?>
						
						
						

			
							</tbody>

					  </table>
				</div>
		  
		  

		  
		  
		  
		  
		  
		  
		  
			</div>
		</div>	
	</div>
</div>
<!--//////////////////////////////////////////////////////////////////////////////-->		
<?php	}elseif($data_class>=41 and $data_class<=43){ ?>
<!--//////////////////////////////////////////////////////////////////////////////-->
<div class="row">
	<div  class="col-<?php echo $grid;?>-12">
	​    <div class="panel panel-info">
			<div class="panel-heading">ลงทะเบียนเรียนเสริมนอกเวลาเรียน ภาคเรียน <?php echo $data_term." / ".$data_year;?></div>
			<div class="panel-body">
		  
				<div class="table-responsive">
					  <table class="table table-hover">
						<thead>
						  <tr>
							<th><div>รหัสวิชา</div></th>
							<th><div>ชื่อวิชา</div></th>

		<?php
				$print_supp_day=new supplementary_day();
				if($print_supp_day->sd_mon=="ON"){ ?>
							<th><div>วันจันทร์</div></th>
		<?php	}elseif($print_supp_day->sd_mon=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}      ?>
					
		<?php	if($print_supp_day->sd_tue=="ON"){ ?>
							<th><div>วันอังคาร</div></th>
		<?php	}elseif($print_supp_day->sd_tue=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}	   ?>				
					
		<?php	if($print_supp_day->sd_wed=="ON"){ ?>
							<th><div>วันพุธ</div></th>
		<?php	}elseif($print_supp_day->sd_wed=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}	   ?>					
					
		<?php	if($print_supp_day->sd_thu=="ON"){?>
							<th><div>วันพฤหัสบดี</div></th>
		<?php	}elseif($print_supp_day->sd_thu=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>					
				
		<?php	if($print_supp_day->sd_frl=="ON"){?>
							<th><div>วันศุกร์</div></th>
		<?php	}elseif($print_supp_day->sd_frl=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>					
					
		<?php	if($print_supp_day->sd_sat=="ON"){?>
							<th><div>วันเสาร์</div></th>
		<?php	}elseif($print_supp_day->sd_sat=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>

		<?php	if($print_supp_day->sd_sun=="ON"){?>
							<th><div>วันอาทิตย์</div></th>
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
											   and `ss_l`='{$data_class}' 
											   and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new row_evaluation($supplementary_subjectSql);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){  ?>
						
			
						<tr>
								<td><?php echo $supplementary_subjectRow["ss_id"];?></td>
								<td><?php echo $supplementary_subjectRow["ss_txtth"];?></td>
								
				<?php
					$print_daysubject=new supplementary_daysubject($supplementary_subjectRow["ss_id"]);	
				?>
				
		<?php
				$print_supp_day=new supplementary_day();
				if($print_supp_day->sd_mon=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_mon=="ON"){ ?>
<!--***************************************************************************************************-->
				<?php
				    $IntSudSuppMon=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,0,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_MonCount`,`subject_MonKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_MonCount=$supplementary_subjectRow["subject_MonCount"];
						//$subject_MonKeep=$supplementary_subjectRow["subject_MonKeep"];
						if($IntSudSuppMon->ShowIntSudSupplementary()>=$subject_MonCount){ ?>
<!--*****************************************************************************************************-->	
								<td><b style="color: #F80B0F"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Mon&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>">เต็ม</a></b></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Mon&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppMon->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>						
<!--***************************************************************************************************-->						
			<?php	}elseif($print_daysubject->sds_mon=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}elseif($print_supp_day->sd_mon=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}      ?>
					
		<?php	if($print_supp_day->sd_tue=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_tue=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
				    $IntSudSuppTues=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,1,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_TuesCount`,`subject_TuesKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_TuesCount=$supplementary_subjectRow["subject_TuesCount"];
						//$subject_TuesKeep=$supplementary_subjectRow["subject_TuesKeep"];
						if($IntSudSuppTues->ShowIntSudSupplementary()>=$subject_TuesCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Tues&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Tues&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppTues->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_tue=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_tue=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}	   ?>				
					
		<?php	if($print_supp_day->sd_wed=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_wed=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
				    $IntSudSuppWednes=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,2,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_WednesCount`,`subject_WednesKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_WednesCount=$supplementary_subjectRow["subject_WednesCount"];
						$subject_WednesKeep=$supplementary_subjectRow["subject_WednesKeep"];
						if($IntSudSuppWednes->ShowIntSudSupplementary()>=$subject_WednesCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Wednes&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Wednes&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppWednes->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_wed=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif(($print_supp_day->sd_wed=="OFF")){ ?>
						
		<?php	}else{ ?>
						
		<?php	}	   ?>					
					
		<?php	if(($print_supp_day->sd_thu=="ON")){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if(($print_daysubject->sds_thu=="ON")){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
				    $IntSudSuppThurs=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,3,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_ThursCount`,`subject_ThursKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_ThursCount=$supplementary_subjectRow["subject_ThursCount"];
						//$subject_ThursKeep=$supplementary_subjectRow["subject_ThursKeep"];
						if($IntSudSuppThurs->ShowIntSudSupplementary()>=$subject_ThursCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Thurs&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Thurs&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppThurs->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
			<?php	}elseif($print_daysubject->sds_thu=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_thu=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>					
				
		<?php	if($print_supp_day->sd_frl=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_frl=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppFri=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,4,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_FriCount`,`subject_FriKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_FriCount=$supplementary_subjectRow["subject_FriCount"];
						//$subject_FriKeep=$supplementary_subjectRow["subject_FriKeep"];
						if($IntSudSuppFri->ShowIntSudSupplementary()>=$subject_FriCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=fri&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=fri&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppFri->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_frl=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_frl=="OFF"){?>
						<td>A</td>	
		<?php	}else{?>
						<td>V</td>
		<?php	}	  ?>					
					
		<?php	if($print_supp_day->sd_sat=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_sat=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppSatur=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,5,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_SaturCount`,`subject_SaturKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}' ";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_SaturCount=$supplementary_subjectRow["subject_SaturCount"];
						$subject_SaturKeep=$supplementary_subjectRow["subject_SaturKeep"];
						if($IntSudSuppSatur->ShowIntSudSupplementary()>=$subject_SaturCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Satur&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Satur&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppSatur->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_sat=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_sat=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>

		<?php	if($print_supp_day->sd_sun=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($print_daysubject->sds_sun=="ON"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$IntSudSuppSun=new CountSudSupplementary($data_class,$data_year,$print_daysubject->sss_id,6,$data_term);
					$supplementary_subject="SELECT `ss_id`,`subject_SunCount`,`subject_SunKeep` 
											FROM `supplementary_subject` 
											WHERE `ss_id`='{$print_daysubject->sss_id}' 
											and `ss_t`='{$data_term}' 
											and `ss_l`='{$data_class}' 
											and `ss_year`='{$data_year}'";
					$supplementary_subjectRs=new notrow_evaluation($supplementary_subject);
					foreach($supplementary_subjectRs->evaluation_array as $rc_key=>$supplementary_subjectRow){
						$subject_SunCount=$supplementary_subjectRow["subject_SunCount"];
						//$subject_SunKeep=$supplementary_subjectRow["subject_SunKeep"];
						if($IntSudSuppSun->ShowIntSudSupplementary()>=$subject_SunCount){ ?>
<!--*****************************************************************************************************-->	
								<td class="success"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color: #F80B0F">เต็ม</b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}else{ ?>
<!--*****************************************************************************************************-->	
								<td class="warning"><a href="./?evaluation_mod=supplementary_stu&subjectid=<?php echo $print_daysubject->sss_id;?>&day=Sun&t=<?php echo $data_term;?>&l=<?php echo $data_class;?>&y=<?php echo $data_year;?>"><b style="color:#0623FB"><?php echo $IntSudSuppSun->ShowIntSudSupplementary();?></b></a></td>
<!--*****************************************************************************************************-->							
			<?php		}
					}
				?>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php	}elseif($print_daysubject->sds_sun=="OFF"){ ?>
						<td class="danger">ไม่เปิดสอนในวันนี้</td>
			<?php	}else{ ?>
						<td class="warning">ไม่พบข้อมูล</td>
			<?php	}      ?>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_sun=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>
				
				
				
				
				
				
				
				
									
						</tr>	
					
					
				<?php	}  ?>
						
						
						

			
							</tbody>

					  </table>
				</div>
		  
		  

		  
		  
		  
		  
		  
		  
		  
			</div>
		</div>	
	</div>
</div>
<!--//////////////////////////////////////////////////////////////////////////////-->	
<?php	}else{
		
	}
?>
