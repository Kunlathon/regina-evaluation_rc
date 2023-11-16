<?php
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");
	include("../../../../database/class_plan.php");
	include("../../../../database/pdo_summer.php");
	include("../../../../database/class_summer.php");	

//--------------------------------------------------------------------    
    include("../../../../img_user/document/gotolink.php");//----------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
	
?>
	<script>
		$(document).ready(function () {
			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-violet-400'
			});				
		})
	</script>
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

<?php
	$data_year=filter_input(INPUT_POST,'txtyear');
	$data_class=filter_input(INPUT_POST,'txtclass');
		if(isset($data_year,$data_class)){	
//---------------------------------------------------------------------------------
			$DataClass=new print_level($data_class);
//---------------------------------------------------------------------------------		
		?>
<!--****************************************************************************-->		
	<?php
			if(($data_class>=41 and $data_class<=43)){ ?>
<div class="row">
	<div class="col-<?php echo $grid; ?>-12">
		<h6 class="content-group text-semibold">
			<div>ยอดจำนวนนักเรียนลงทะเบียนระดับชั้น&nbsp;<?php echo $DataClass->level_Lname;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_year;?>&nbsp;</div>
			<div><small class="display-block">ข้อมูลจะแสดงตามแผนการเรียน</small></div>
		</h6>
	</div>
</div>	

<form name="print_rss" target="_blank" action="<?php echo $golink;?>/summer/print_summer_count/<?php echo $data_year;?>/<?php echo $data_class;?>" method="post">
<div class="panel panel-body border-top-teal">
	<div class="row">
		<div class="col-<?php echo $grid;?>-12" style="font-weight: bold; text-align: center;">
			<div>พิมพ์ใบรายงานยอดจำนวนนักเรียนลงทะเบียนระดับชั้น&nbsp;<?php echo $DataClass->level_Lname;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_year;?>&nbsp;</div>
			<div><input type="image" style="width: 15%;" name="img"  src="<?php echo $golink;?>/Template/global_assets/images/print.png" border="0" title="พิมพ์ใบรายงานยอดจำนวนนักเรียนลงทะเบียนระดับชั้น&nbsp;<?php echo $DataClass->level_Lname;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_year;?>&nbsp;"></div>
		</div>

	</div>
</div>
<hr>
</from>
		
<div class="row">
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$ShowPalnClass=new PlanClass($data_year,'1',$data_class);
				foreach($ShowPalnClass->RunPlanClass() as $rc=>$PrintPlanClass){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="col-<?php echo $grid; ?>-12">
		<div class="panel panel-body border-top-teal">
			<div class="row">
				<div class="col-<?php echo $grid; ?>-12">
					<div class="text-center">
						<h6 class="no-margin text-semibold">แผนการเรียน <?php echo $PrintPlanClass["PlanName"];?></h6>
					</div>			
				</div>
			</div>
			
			<div class="row">
				<div class="col-<?php echo $grid; ?>-12">
					<h6 class="content-group text-semibold">
						<div>ยอดจำนวนนักเรียนลงทะเบียนระดับชั้น&nbsp;<?php echo $DataClass->level_Lname;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_year;?>&nbsp;</div>
						<div><small class="display-block">ข้อมูลจะแสดงตามระดับชั้นเรียน</small></div>
					</h6>
				</div>
			</div>
			<div class="row">
				<div class="col-<?php echo $grid; ?>-12">
					
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr class="info">
										<th><div>รายการกิจกรรม</div></th>
										<th><div>จำนวนผู้ลงทะเบียน</div></th>
										<th><div>จำนวนโควต้า</div></th>
										<th><div>จำนวนคงเหลือโควต้า</div></th>
									</tr>
								</thead>
								<tbody>
				<?php
					$ShowRsSubjectData=new ShowRsSubjectDataPlan($data_year,$data_class,$PrintPlanClass["IDPlan"]);
					$RSCount=0;
					foreach($ShowRsSubjectData->RunShowRsSubjectData() as $rc=>$ShowRsSubjectDataRow){
			//---------------------------------------------------------------------------------			
						$CountMoneyPaySummer=new CountMoneyPaySummer($ShowRsSubjectDataRow["RSD_no"],$data_year);
			//---------------------------------------------------------------------------------			
						?>	
					
									<tr class="success">
										<td><div class="text-semibold" style="color:DodgerBlue; color:#D2691E;"><?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?></div></td>
										<td><div class="text-semibold" style="color:DodgerBlue; color:#006400;"><b><?php echo $CountMoneyPaySummer->RunCountSummer();?></b></div></td>
										<td><div class="text-semibold" style="color:DodgerBlue; color:#FFA500;"><b><?php echo $CountMoneyPaySummer->RunKeepSummer();?></b></div></td>
										<td><div class="text-semibold" style="color:DodgerBlue; color:#FF4500;"><b><?php echo $CountMoneyPaySummer->RunRemainSummer();?></b></div></td>
									</tr>		
							
				<?php	$RSCount=$RSCount+1;} ?>

								</tbody>
							</table>
						</div>		
					
				</div>
			</div>		

		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	} ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="col-<?php echo $grid; ?>-12">
			<div class="panel panel-body border-top-teal">
				<div class="row">
					<div class="col-<?php echo $grid; ?>-12">
						<div class="text-center">
							<h6 class="no-margin text-semibold">กิจกรรมลงเรียนได้ทุกแผนการเรียน</h6>
						</div>			
					</div>
				</div>
				
				<div class="row">
					<div class="col-<?php echo $grid; ?>-12">
						<h6 class="content-group text-semibold">
							<div>ยอดจำนวนนักเรียนลงทะเบียนระดับชั้น&nbsp;<?php echo $DataClass->level_Lname;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_year;?>&nbsp;</div>
							<div><small class="display-block">ข้อมูลจะแสดงตามระดับชั้นเรียน</small></div>
						</h6>
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid; ?>-12">
						
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr class="info">
											<th><div>รายการกิจกรรม</div></th>
											<th><div>จำนวนผู้ลงทะเบียน</div></th>
											<th><div>จำนวนโควต้า</div></th>
											<th><div>จำนวนคงเหลือโควต้า</div></th>
										</tr>
									</thead>
									<tbody>
					<?php
						$ShowRsSubjectData=new ShowRsSubjectDataPlan($data_year,$data_class,"0");
						$RSCount=0;
						foreach($ShowRsSubjectData->RunShowRsSubjectData() as $rc=>$ShowRsSubjectDataRow){
				//---------------------------------------------------------------------------------			
							$CountMoneyPaySummer=new CountMoneyPaySummer($ShowRsSubjectDataRow["RSD_no"],$data_year);
				//---------------------------------------------------------------------------------			
							?>	
						
										<tr class="success">
											<td><div class="text-semibold" style="color:DodgerBlue; color:#D2691E;"><?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?></div></td>
											<td><div class="text-semibold" style="color:DodgerBlue; color:#006400;"><b><?php echo $CountMoneyPaySummer->RunCountSummer();?></b></div></td>
											<td><div class="text-semibold" style="color:DodgerBlue; color:#FFA500;"><b><?php echo $CountMoneyPaySummer->RunKeepSummer();?></b></div></td>
											<td><div class="text-semibold" style="color:DodgerBlue; color:#FF4500;"><b><?php echo $CountMoneyPaySummer->RunRemainSummer();?></b></div></td>
										</tr>		
								
					<?php	$RSCount=$RSCount+1;} ?>

									</tbody>
								</table>
							</div>		
						
					</div>
				</div>						

			</div>
		</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
</div>



				


	<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
	<div class="col-<?php echo $grid; ?>-12">
		<h6 class="content-group text-semibold">
			<div>ยอดจำนวนนักเรียนลงทะเบียนระดับชั้น&nbsp;<?php echo $DataClass->level_Lname;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_year;?>&nbsp;</div>
			<div><small class="display-block">ข้อมูลจะแสดงตามระดับชั้นเรียน</small></div>
		</h6>
	</div>
</div>

<form name="print_rss" target="_blank" action="<?php echo $golink;?>/summer/print_summer_count/<?php echo $data_year;?>/<?php echo $data_class;?>" method="post">
<div class="panel panel-body border-top-teal">
	<div class="row">
		<div class="col-<?php echo $grid;?>-12" style="font-weight: bold; text-align: center;">
			<div>พิมพ์ใบรายงานยอดจำนวนนักเรียนลงทะเบียนระดับชั้น&nbsp;<?php echo $DataClass->level_Lname;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_year;?>&nbsp;</div>
			<div><input type="image" style="width: 15%;" name="img"  src="<?php echo $golink;?>/Template/global_assets/images/print.png" border="0" title="พิมพ์ใบรายงานยอดจำนวนนักเรียนลงทะเบียนระดับชั้น&nbsp;<?php echo $DataClass->level_Lname;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_year;?>&nbsp;"></div>
		</div>

	</div>
</div>
<hr>
</from>

<div class="row">
	<div class="col-<?php echo $grid; ?>-12">
		<div class="panel panel-body border-top-violet">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr class="info">
							<th><div>รายการกิจกรรม</div></th>
							<th><div>จำนวนผู้ลงทะเบียน</div></th>
							<th><div>จำนวนโควต้า</div></th>
							<th><div>จำนวนคงเหลือโควต้า</div></th>
						</tr>
					</thead>
					<tbody>
	<?php
		$ShowRsSubjectData=new ShowRsSubjectData($data_year,$data_class);
		$RSCount=0;
		foreach($ShowRsSubjectData->RunShowRsSubjectData() as $rc=>$ShowRsSubjectDataRow){
//---------------------------------------------------------------------------------			
			$CountMoneyPaySummer=new CountMoneyPaySummer($ShowRsSubjectDataRow["RSD_no"],$data_year);
//---------------------------------------------------------------------------------			
			?>	
		
						<tr class="success">
							<td><div class="text-semibold" style="color:DodgerBlue; color:#D2691E;"><?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?></div></td>
							<td><div class="text-semibold" style="color:DodgerBlue; color:#006400;"><b><?php echo $CountMoneyPaySummer->RunCountSummer();?></b></div></td>
							<td><div class="text-semibold" style="color:DodgerBlue; color:#FFA500;"><b><?php echo $CountMoneyPaySummer->RunKeepSummer();?></b></div></td>
							<td><div class="text-semibold" style="color:DodgerBlue; color:#FF4500;"><b><?php echo $CountMoneyPaySummer->RunRemainSummer();?></b></div></td>
						</tr>		
				
	<?php	$RSCount=$RSCount+1;} ?>

					</tbody>
				</table>
			</div>		
		</div>
	</div>
</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php	} ?>
<!--****************************************************************************-->			
<?php	}else{}?>

