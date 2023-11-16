<?php
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");
	include("../../../../database/pdo_summer.php");
	include("../../../../database/class_summer.php");	


//--------------------------------------------------------------------    
    include("../../../../img_user/document/gotolink.php");//-----------------
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
?>
	
	<?php
		if(isset($data_year,$data_class)){
			switch($data_class){
				case "3":	?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$countA=0;
		$RSDA_txtTh=array();
		$PrintSubjectData=new PrintRsSubjectGJ("group","3","3",$data_year,"-");
			foreach($PrintSubjectData->RunSubjectGJ_Print() as $rc=>$PrintSubjectDataRow){ 
				$RSDA_txtTh[$countA]=$PrintSubjectDataRow["rg_txt"];
				$rg_id[$countA]=$PrintSubjectDataRow["rg_id"];
					$PrintSubjectKey=new PrintRsSubjectGJ("join","3","3",$data_year,$rg_id[$countA]);
						$Sum_MPS=0;
						foreach($PrintSubjectKey->RunSubjectGJ_Print() as $rc=>$PrintSubjectKeyRow){
//Class : CountMoneyPaySummer					
							$MoneyPaySummerA=new CountMoneyPaySummer($PrintSubjectKeyRow["RSD_no"],$data_year);
//Class : CountMoneyPaySummer End
							$Sum_MPS=$Sum_MPS+$MoneyPaySummerA->RunCountSummer();
						}
				$RSDA_Count[$countA]=$Sum_MPS;
				$countA=$countA+1;
			} ?>
					

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-violet">
			<div class="row">
				<div class="col-<?php echo $grid; ?>-12">
					<h6 class="content-group text-semibold">
						<div></div>
					</h6>
				</div>
			</div>		
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr class="info">
									<th><div>รายการกิจกรรม</div></th>
									<th><div>จำนวนผู้ลงทะเบียน</div></th>
									<th><div>โหลดข้อมูลผู้เรียน</div></th>
								</tr>
							</thead>
							<tbody>
					<?php
						$count_run=0;
						while($count_run<$countA){	
							$RSD_Sum=$RSDA_Count[$count_run];
						?>
							
								<tr class="success">
									<td><div class="text-semibold" style="color:DodgerBlue; color:#D2691E;"><?php echo $RSDA_txtTh[$count_run];?></div></td>
									<td><div class="text-semibold" style="color:DodgerBlue; color:#006400;"><b><?php echo $RSD_Sum;?></b></div></td>
									<td>
										<form name="RSC<?php echo $count_run;?>" action="<?php echo $golink;?>/?evaluation_mod=summer_count_all_excel" method="post">

									
										<input type="hidden" name="RSCAExcel_Year" value="<?php echo $data_year;?>">
										<input type="hidden" name="RSCAExcel_no" value="<?php echo $rg_id[$count_run];?>">
										<input type="hidden" name="RSCAExcel_txt" value="<?php echo $RSDA_txtTh[$count_run];?>">
										<input type="hidden" name="RSCAExcel_level" value="<?php echo $data_class;?>">
																
										<div><button type="submit" class="btn btn-success">โหลดข้อมูล</button></div>
										</form>
									</td>						
								
								</tr>					
							
							
							
							
							
					<?php	$count_run=$count_run+1;
					    } ?>	
							
							
							</tbody>				
						</table>
					</div>				
				</div>
			</div>
		</div>
	</div>
</div>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php		break;
				case "12-23":	?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$countA=0;
		$RSDA_txtTh=array();
		$PrintSubjectData=new PrintRsSubjectGJ("group","12","23",$data_year,"-");
			foreach($PrintSubjectData->RunSubjectGJ_Print() as $rc=>$PrintSubjectDataRow){ 
				$RSDA_txtTh[$countA]=$PrintSubjectDataRow["rg_txt"];
				$rg_id[$countA]=$PrintSubjectDataRow["rg_id"];
					$PrintSubjectKey=new PrintRsSubjectGJ("join","12","23",$data_year,$rg_id[$countA]);
						$Sum_MPS=0;
						foreach($PrintSubjectKey->RunSubjectGJ_Print() as $rc=>$PrintSubjectKeyRow){
//Class : CountMoneyPaySummer					
							$MoneyPaySummerA=new CountMoneyPaySummer($PrintSubjectKeyRow["RSD_no"],$data_year);
//Class : CountMoneyPaySummer End
							$Sum_MPS=$Sum_MPS+$MoneyPaySummerA->RunCountSummer();
						}
				$RSDA_Count[$countA]=$Sum_MPS;
				$countA=$countA+1;
			} ?>
					

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-violet">
			<div class="row">
				<div class="col-<?php echo $grid; ?>-12">
					<h6 class="content-group text-semibold">
						<div></div>
					</h6>
				</div>
			</div>		
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr class="info">
									<th><div>รายการกิจกรรม</div></th>
									<th><div>จำนวนผู้ลงทะเบียน</div></th>
									<th><div>โหลดข้อมูลผู้เรียน</div></th>
								</tr>
							</thead>
							<tbody>
					<?php
						$count_run=0;
						while($count_run<$countA){	
							$RSD_Sum=$RSDA_Count[$count_run];
						?>
							
								<tr class="success">
									<td><div class="text-semibold" style="color:DodgerBlue; color:#D2691E;"><?php echo $RSDA_txtTh[$count_run];?></div></td>
									<td><div class="text-semibold" style="color:DodgerBlue; color:#006400;"><b><?php echo $RSD_Sum;?></b></div></td>
									<td>
										<form name="RSC<?php echo $count_run;?>" action="<?php echo $golink;?>/?evaluation_mod=summer_count_all_excel" method="post">

									
										<input type="hidden" name="RSCAExcel_Year" value="<?php echo $data_year;?>">
										<input type="hidden" name="RSCAExcel_no" value="<?php echo $rg_id[$count_run];?>">
										<input type="hidden" name="RSCAExcel_txt" value="<?php echo $RSDA_txtTh[$count_run];?>">
										<input type="hidden" name="RSCAExcel_level" value="<?php echo $data_class;?>">
																
										<div><button type="submit" class="btn btn-success">โหลดข้อมูล</button></div>
										</form>
									</td>						
								
								</tr>					
							
							
							
							
							
					<?php	$count_run=$count_run+1;
					    } ?>	
							
							
							</tbody>				
						</table>
					</div>				
				</div>
			</div>
		</div>
	</div>
</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php		break;
				case "31-33":	?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$countA=0;
		$RSDA_txtTh=array();
		$PrintSubjectData=new PrintRsSubjectGJ("group","31","33",$data_year,"-");
			foreach($PrintSubjectData->RunSubjectGJ_Print() as $rc=>$PrintSubjectDataRow){ 
				$RSDA_txtTh[$countA]=$PrintSubjectDataRow["rg_txt"];
				$rg_id[$countA]=$PrintSubjectDataRow["rg_id"];
					$PrintSubjectKey=new PrintRsSubjectGJ("join","31","33",$data_year,$rg_id[$countA]);
						$Sum_MPS=0;
						foreach($PrintSubjectKey->RunSubjectGJ_Print() as $rc=>$PrintSubjectKeyRow){
//Class : CountMoneyPaySummer					
							$MoneyPaySummerA=new CountMoneyPaySummer($PrintSubjectKeyRow["RSD_no"],$data_year);
//Class : CountMoneyPaySummer End
							$Sum_MPS=$Sum_MPS+$MoneyPaySummerA->RunCountSummer();
						}
				$RSDA_Count[$countA]=$Sum_MPS;
				$countA=$countA+1;
			} ?>
					

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-violet">
			<div class="row">
				<div class="col-<?php echo $grid; ?>-12">
					<h6 class="content-group text-semibold">
						<div></div>
					</h6>
				</div>
			</div>		
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr class="info">
									<th><div>รายการกิจกรรม</div></th>
									<th><div>จำนวนผู้ลงทะเบียน</div></th>
									<th><div>โหลดข้อมูลผู้เรียน</div></th>
								</tr>
							</thead>
							<tbody>
					<?php
						$count_run=0;
						while($count_run<$countA){	
							$RSD_Sum=$RSDA_Count[$count_run];
						?>
							
								<tr class="success">
									<td><div class="text-semibold" style="color:DodgerBlue; color:#D2691E;"><?php echo $RSDA_txtTh[$count_run];?></div></td>
									<td><div class="text-semibold" style="color:DodgerBlue; color:#006400;"><b><?php echo $RSD_Sum;?></b></div></td>
									<td>
										<form name="RSC<?php echo $count_run;?>" action="<?php echo $golink;?>/?evaluation_mod=summer_count_all_excel" method="post">

									
										<input type="hidden" name="RSCAExcel_Year" value="<?php echo $data_year;?>">
										<input type="hidden" name="RSCAExcel_no" value="<?php echo $rg_id[$count_run];?>">
										<input type="hidden" name="RSCAExcel_txt" value="<?php echo $RSDA_txtTh[$count_run];?>">
										<input type="hidden" name="RSCAExcel_level" value="<?php echo $data_class;?>">
																
										<div><button type="submit" class="btn btn-success">โหลดข้อมูล</button></div>
										</form>
									</td>						
								
								</tr>					
							
							
							
							
							
					<?php	$count_run=$count_run+1;
					    } ?>	
							
							
							</tbody>				
						</table>
					</div>				
				</div>
			</div>
		</div>
	</div>
</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php		break;
				case "41-43":	?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$countA=0;
		$RSDA_txtTh=array();
		$PrintSubjectData=new PrintRsSubjectGJ("group","41","43",$data_year,"-");
			foreach($PrintSubjectData->RunSubjectGJ_Print() as $rc=>$PrintSubjectDataRow){ 
				$RSDA_txtTh[$countA]=$PrintSubjectDataRow["rg_txt"];
				$rg_id[$countA]=$PrintSubjectDataRow["rg_id"];
					$PrintSubjectKey=new PrintRsSubjectGJ("join","41","43",$data_year,$rg_id[$countA]);
						$Sum_MPS=0;
						foreach($PrintSubjectKey->RunSubjectGJ_Print() as $rc=>$PrintSubjectKeyRow){
//Class : CountMoneyPaySummer					
							$MoneyPaySummerA=new CountMoneyPaySummer($PrintSubjectKeyRow["RSD_no"],$data_year);
//Class : CountMoneyPaySummer End
							$Sum_MPS=$Sum_MPS+$MoneyPaySummerA->RunCountSummer();
						}
				$RSDA_Count[$countA]=$Sum_MPS;
				$countA=$countA+1;
			} ?>
					

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-violet">
			<div class="row">
				<div class="col-<?php echo $grid; ?>-12">
					<h6 class="content-group text-semibold">
						<div></div>
					</h6>
				</div>
			</div>		
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr class="info">
									<th><div>รายการกิจกรรม</div></th>
									<th><div>จำนวนผู้ลงทะเบียน</div></th>
									<th><div>โหลดข้อมูลผู้เรียน</div></th>
								</tr>
							</thead>
							<tbody>
					<?php
						$count_run=0;
						while($count_run<$countA){	
							$RSD_Sum=$RSDA_Count[$count_run];
						?>
							
								<tr class="success">
									<td><div class="text-semibold" style="color:DodgerBlue; color:#D2691E;"><?php echo $RSDA_txtTh[$count_run];?></div></td>
									<td><div class="text-semibold" style="color:DodgerBlue; color:#006400;"><b><?php echo $RSD_Sum;?></b></div></td>
									<td>
										<form name="RSC<?php echo $count_run;?>" action="<?php echo $golink;?>/?evaluation_mod=summer_count_all_excel" method="post">

									
										<input type="hidden" name="RSCAExcel_Year" value="<?php echo $data_year;?>">
										<input type="hidden" name="RSCAExcel_no" value="<?php echo $rg_id[$count_run];?>">
										<input type="hidden" name="RSCAExcel_txt" value="<?php echo $RSDA_txtTh[$count_run];?>">
										<input type="hidden" name="RSCAExcel_level" value="<?php echo $data_class;?>">
																
										<div><button type="submit" class="btn btn-success">โหลดข้อมูล</button></div>
										</form>
									</td>						
								
								</tr>					
							
							
							
							
							
					<?php	$count_run=$count_run+1;
					    } ?>	
							
							
							</tbody>				
						</table>
					</div>				
				</div>
			</div>
		</div>
	</div>
</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php		default:
					//-----------------------------------------------
			}
		}else{}
	
	?>