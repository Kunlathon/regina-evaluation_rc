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
	
	<?php
		$data_term=filter_input(INPUT_POST,'copy_term');     
		$data_year=filter_input(INPUT_POST,'copy_year');    
		$data_class=filter_input(INPUT_POST,'copy_class');      
	?>
	
<!--****************************************************************************-->	

<?php
		if($data_class==3){ ?>
<!--//////////////////////////////////////////////////////////////////////////////-->

<!--//////////////////////////////////////////////////////////////////////////////-->		
<?php	}elseif($data_class>=11 and $data_class<=23){ ?>
<!--//////////////////////////////////////////////////////////////////////////////-->

<!--//////////////////////////////////////////////////////////////////////////////-->		
<?php	}elseif($data_class>=31 and $data_class<=33){ ?>
<!--//////////////////////////////////////////////////////////////////////////////-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading">จำนวนนักเรียน ลงทะเบียน มัธยมศึกษาตอนต้น...</div>
			<div class="panel-body">
		  
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<div class="panel panel-info">
							<div class="panel-heading">นักเรียนไม่ลงเรียนเพิ่ม (IPST) จำนวนนักเรียน/คน</div>
							<div class="panel-body">
							
								<div class="row">
						<?php
							$supplementary_notstudySql="SELECT COUNT(`notstudy_stu`) as `countnotstudy_stu`,`notstudy_l`
												        FROM `supplementary_notstudy`
														WHERE `notstudy_t` = '{$data_term}'
														AND `notstudy_y` = '{$data_year}'
														AND `notstudy_p` = '12'
														AND `notstudy_l` >= '31'
														AND `notstudy_l` <= '33'
														GROUP BY `notstudy_l`";
							$supplementary_notstudyRs=new row_evaluation($supplementary_notstudySql);
							foreach($supplementary_notstudyRs->evaluation_array as $key_rc=>$supplementary_notstudyRow){
									$countnotstudy_stu=$supplementary_notstudyRow["countnotstudy_stu"];
									$notstudy_l=$supplementary_notstudyRow["notstudy_l"];
								?>
								
									<div class="col-<?php echo $grid;?>-4">
										<div class="panel panel-body">
											<div class="media no-margin">
												<div class="media-body">
													<h3 class="no-margin text-semibold"><?php echo $countnotstudy_stu;?></h3>
													
								<?php
									$show_level=new print_level($notstudy_l);
								?>					
													<span class="text-uppercase text-size-mini text-muted"><?php echo $show_level->set_Lname;?></span>
												</div>

												<div class="media-right media-middle">
													<i class="icon-bag icon-2x text-danger-300"></i>
												</div>
											</div>
										</div>									
									</div>								
								
				<?php		} ?>		

								</div>
							

							
							
							</div>
						</div>
					</div>
					<div class="col-<?php echo $grid;?>-6">
					    <div class="panel panel-danger">
							<div class="panel-heading">นักเรียนลงทะเบียนเรียน</div>
							<div class="panel-body">
							
				<?php
					$print_stuingSql="SELECT COUNT( DISTINCT `sup_stuid` ) as `count_stu` , `sup_l`
								      FROM `supplementary_sturs`
									  WHERE `sup_t` = '{$data_term}'
									  AND `sup_l` >= '31'
						              AND `sup_l` <= '33'
									  AND `sup_year` = '{$data_year}'
									  GROUP BY `sup_l`";
					$print_stuing=new row_evaluation($print_stuingSql);
					foreach($print_stuing->evaluation_array as $rc_key=>$print_stuingRow){
						$count_stu=$print_stuingRow["count_stu"];
						$sup_l=$print_stuingRow["sup_l"]; ?>
						
						
						
									<div class="col-<?php echo $grid;?>-4">
										<div class="panel panel-body">
											<div class="media no-margin">
												<div class="media-body">
													<h3 class="no-margin text-semibold"><?php echo $count_stu;?></h3>
													
								<?php
									$show_levelB=new print_level($sup_l);
								?>					
													<span class="text-uppercase text-size-mini text-muted"><?php echo $show_levelB->set_Lname;?></span>
												</div>

												<div class="media-right media-middle">
													<i class="icon-bubbles4 icon-2x text-danger-300"></i>
												</div>
											</div>
										</div>									
									</div>							
						
						
						
			<?php	} ?>			
							
							
							
							
							
							
							</div>
						</div>
					</div>
				</div>
		  
		  
		  
			</div>
		</div>	
	</div>
</div>
<!--//////////////////////////////////////////////////////////////////////////////-->		
<?php	}elseif($data_class>=41 and $data_class<=43){ ?>
<!--//////////////////////////////////////////////////////////////////////////////-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading">จำนวนนักเรียน ลงทะเบียน มัธยมศึกษาตอนต้น...</div>
			<div class="panel-body">
		  
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<div class="panel panel-info">
							<div class="panel-heading">นักเรียนไม่ลงเรียนเพิ่ม (IPST) จำนวนนักเรียน/คน</div>
							<div class="panel-body">
							
								<div class="row">
						<?php
							$supplementary_notstudySql="SELECT COUNT(`notstudy_stu`) as `countnotstudy_stu`,`notstudy_l`
												        FROM `supplementary_notstudy`
														WHERE `notstudy_t` = '{$data_term}'
														AND `notstudy_y` = '{$data_year}'
														AND `notstudy_p` = '13'
														AND `notstudy_l` >= '41'
														AND `notstudy_l` <= '43'
														GROUP BY `notstudy_l`";
							$supplementary_notstudyRs=new row_evaluation($supplementary_notstudySql);
							foreach($supplementary_notstudyRs->evaluation_array as $key_rc=>$supplementary_notstudyRow){
									$countnotstudy_stu=$supplementary_notstudyRow["countnotstudy_stu"];
									$notstudy_l=$supplementary_notstudyRow["notstudy_l"];
								?>
								
									<div class="col-<?php echo $grid;?>-4">
										<div class="panel panel-body">
											<div class="media no-margin">
												<div class="media-body">
													<h3 class="no-margin text-semibold"><?php echo $countnotstudy_stu;?></h3>
													
								<?php
									$show_level=new print_level($notstudy_l);
								?>					
													<span class="text-uppercase text-size-mini text-muted"><?php echo $show_level->set_Lname;?></span>
												</div>

												<div class="media-right media-middle">
													<i class="icon-bag icon-2x text-danger-300"></i>
												</div>
											</div>
										</div>									
									</div>								
								
				<?php		} ?>		

								</div>
							

							
							
							</div>
						</div>
					</div>
					<div class="col-<?php echo $grid;?>-6">
					    <div class="panel panel-danger">
							<div class="panel-heading">นักเรียนลงทะเบียนเรียน</div>
							<div class="panel-body">
							
				<?php
					$print_stuingSql="SELECT COUNT( DISTINCT `sup_stuid` ) as `count_stu` , `sup_l`
								      FROM `supplementary_sturs`
									  WHERE `sup_t` = '{$data_term}'
									  AND `sup_l` >= '41'
						              AND `sup_l` <= '43'
									  AND `sup_year` = '{$data_year}'
									  GROUP BY `sup_l`";
					$print_stuing=new row_evaluation($print_stuingSql);
					foreach($print_stuing->evaluation_array as $rc_key=>$print_stuingRow){
						$count_stu=$print_stuingRow["count_stu"];
						$sup_l=$print_stuingRow["sup_l"]; ?>
						
						
						
									<div class="col-<?php echo $grid;?>-4">
										<div class="panel panel-body">
											<div class="media no-margin">
												<div class="media-body">
													<h3 class="no-margin text-semibold"><?php echo $count_stu;?></h3>
													
								<?php
									$show_levelB=new print_level($sup_l);
								?>					
													<span class="text-uppercase text-size-mini text-muted"><?php echo $show_levelB->set_Lname;?></span>
												</div>

												<div class="media-right media-middle">
													<i class="icon-bubbles4 icon-2x text-danger-300"></i>
												</div>
											</div>
										</div>									
									</div>							
						
						
						
			<?php	} ?>			
							
							
							
							
							
							
							</div>
						</div>
					</div>
				</div>
		  
		  
		  
			</div>
		</div>	
	</div>
</div>
<!--//////////////////////////////////////////////////////////////////////////////-->
<?php	}else{
		
	}
?>







