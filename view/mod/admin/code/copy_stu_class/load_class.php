<?php
	$txt_year=(filter_input(INPUT_POST,'txt_year'));
		if(isset($txt_year)){ ?>
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
			$CRSC_TA=1;
			$CRSC_YA=$txt_year;
			$CRSC_TB=2;
			$CRSC_YB=$txt_year;
			$CopyReginaStuClass=new CopyReginaStuClass($CRSC_TA,$CRSC_YA,$CRSC_TB,$CRSC_YB);	
		?>
				
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel bg-primary">
					<div class="panel-heading">
						<h6 class="panel-title">โหลดข้อมูลภาคเรียนที่&nbsp;<?php echo $CRSC_TA;?>&nbsp;ปีการศึกษา &nbsp;<?php echo $CRSC_YA;?>&nbsp;ไปยัง ภาคเรียนที่&nbsp;<?php echo $CRSC_TB;?>&nbsp; ปีการศึกษา <?php echo $CRSC_YB;?>&nbsp;</h6>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">
								<div class="panel panel-body bg-danger-400 has-bg-image">
									<div class="media no-margin">
										<div class="media-body">
											<h3 class="no-margin"><?php echo $CopyReginaStuClass->Count_Sum;?></h3>
											<span class="text-uppercase text-size-mini">จำนวนข้อมูลที่รอการคัดลอก</span>
										</div>

										<div class="media-right media-middle">
											<i class="icon-database-refresh icon-3x opacity-75"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="col-<?php echo $grid;?>-6">
								<div class="panel panel-body bg-indigo-400 has-bg-image">
									<div class="media no-margin">
										<div class="media-body">
											<h3 class="no-margin"><?php echo $CopyReginaStuClass->Count_Copy;?></h3>
											<span class="text-uppercase text-size-mini">จำนวนข้อมูลที่คัดลอกสำเร็จ</span>
										</div>

										<div class="media-right media-middle">
											<i class="icon-database-check icon-3x opacity-75"></i>
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


