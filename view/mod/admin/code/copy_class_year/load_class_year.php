<?php
	$txt_year=(filter_input(INPUT_POST,'txt_year'));
		if(isset($txt_year)){
			$new_year=$txt_year+1;
			?>
<!--****************************************************************************-->	
	<?php
		include("../../../../database/pdo_data.php");
		include("../../../../database/pdo_conndatastu.php");	
		include("../../../../database/pdo_admission.php");	
		include("../../../../database/regina_student.php");
	?>
	<!--****************************************************************************-->
	<style>
	.RuningLoad {
		display:none;
	}
	</style>
	<script>
		$(function() {
			$(".RunLoad").fadeOut(5000, function() {
				$(".RuningLoad").fadeIn(4000);
			});
		});
	</script>
	
	
	
	<script type="text/javascript">
		function setScreenHWCookie() {
			$.cookie('sw',screen.width);
				//$.cookie('sh',screen.height);
			return true;
		}setScreenHWCookie();
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
		<div class="col-<?php echo $grid;?>-12">
			<div class="RunLoad">
			  <center><img class="img-thumbnail" src="Template/global_assets/images/Cube-1s-200px.gif"></center>
			</div>	
		</div>
	</div>
	<!--****************************************************************************-->	
	<div class="row RuningLoad">
		<?php
			$CopyStudentYear=new CopyStudentYear($txt_year);
		?>				
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel bg-primary">
					<div class="panel-heading">
						<h6 class="panel-title">โหลดข้อมูลปีการศึกษา&nbsp;<?php echo $txt_year;?>&nbsp;ไปยัง&nbsp;ปีการศึกษา&nbsp;<?php echo $new_year;?>&nbsp;</h6>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-<?php echo $grid;?>-3">
								<div class="panel panel-body bg-success-400 has-bg-image">
									<div class="media no-margin">
										<div class="media-body">
											<h3 class="no-margin"><?php echo $CopyStudentYear->CountAll;?></h3>
											<span class="text-uppercase text-size-mini">จำนวนข้อมูลทั้งหมด</span>
										</div>

										<div class="media-right media-middle">
											<i class="icon-database-refresh icon-3x opacity-75"></i>
										</div>
									</div>
								</div>							
							</div>
							<div class="col-<?php echo $grid;?>-3">
								<div class="panel panel-body bg-info-400 has-bg-image">
									<div class="media no-margin">
										<div class="media-body">
											<h3 class="no-margin"><?php echo $CopyStudentYear->CountCopy;?></h3>
											<span class="text-uppercase text-size-mini">จำนวนข้อมูลที่คัดลอก</span>
										</div>

										<div class="media-right media-middle">
											<i class="icon-database-check icon-3x opacity-75"></i>
										</div>
									</div>
								</div>							
							</div>
							<div class="col-<?php echo $grid;?>-3">
								<div class="panel panel-body bg-info-400 has-bg-image">
									<div class="media no-margin">
										<div class="media-body">
											<h3 class="no-margin"><?php echo $CopyStudentYear->CountY;?></h3>
											<span class="text-uppercase text-size-mini">จำนวนข้อมูลที่โหลดสำเร็จ</span>
										</div>

										<div class="media-right media-middle">
											<i class="icon-database-check icon-3x opacity-75"></i>
										</div>
									</div>
								</div>							
							</div>
							<div class="col-<?php echo $grid;?>-3">
								<div class="panel panel-body bg-danger-400 has-bg-image">
									<div class="media no-margin">
										<div class="media-body">
											<h3 class="no-margin"><?php echo $CopyStudentYear->CountN;?></h3>
											<span class="text-uppercase text-size-mini">จำนวนข้อมูลที่โหลดไม่สำเร็จ</span>
										</div>

										<div class="media-right media-middle">
											<i class="icon-database-remove icon-3x opacity-75"></i>
										</div>
									</div>
								</div>							
							</div>
						</div>			
					</div>
				</div>
			</div>
		</div>
	</div>
<!--****************************************************************************-->			
<?php	}else{ ?>
<!--****************************************************************************-->			
<!--****************************************************************************-->			
<?php	}      ?>


