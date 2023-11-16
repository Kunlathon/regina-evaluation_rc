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
		include("../../../../database/database_evaluation.php");
		
		include("../../../../database/pdo_conndatastu.php");
		include("../../../../database/class_pdodatastu.php");
		
		include("../../../../database/pdo_data.php");
		include("../../../../database/class_admin.php");

		
		include("../../../../database/database_paynew.php");
		include("../../../../database/class_pay.php");
		
		include("../../../../database/pdo_activity.php");
		include("../../../../database/class_activity.php");
		
		
	//--------------------------------------------------------------------    
		include("../../../../img_user/document/gotolink.php");//-----------------
		$goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
		$golink=$goingtolink->Rungotolink();//----------------------------
	//--------------------------------------------------------------------	
		$txt_year=post_data(filter_input(INPUT_POST,'txt_year'));
		$txt_term=post_data(filter_input(INPUT_POST,'txt_term'));	
		$txt_class=post_data(filter_input(INPUT_POST,'txt_class'));	
	?>
		<?php
			if(isset($txt_year,$txt_term,$txt_class)){ ?>
			
			<script>
				$(document).ready(function(){
					var TxtClass="<?php echo $txt_class;?>";
					if(TxtClass=="2123"){
						document.getElementById("print_class").innerHTML ="ระดับชั้น&nbsp;:&nbsp;ประถมศึกษาตอนปลาย";
					}else if(TxtClass=="3133"){
						document.getElementById("print_class").innerHTML ="ระดับชั้น&nbsp;:&nbsp;มัธยมศึกษาตอนต้น";
					}else if(TxtClass=="4143"){
						document.getElementById("print_class").innerHTML ="ระดับชั้น&nbsp;:&nbsp;มัธยมศึกษาตอนปลาย";
					}else if(TxtClass=="3142"){
						document.getElementById("print_class").innerHTML ="ระดับชั้น&nbsp;:&nbsp;มัธยมศึกษาปีที่1-5";
					}else{
						document.getElementById("print_class").innerHTML ="";
					}
				});
			</script>	
			
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<h5 class="content-group text-semibold">
					รายงานรายชื่อนักเรียนลงเรียน 
					<small class="display-block" id="print_class"></small>
				</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-pink">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="success"><div>ลำดับ</div></th>
									<th class="info"><div>รายชื่อชุมนุม</div></th>
									<th class="warning"><div>จำนวนผู้ลงทะเบียน</div></th>
									<th class="danger"><div>เรียกดูข้อมูล</div></th>
								</tr>
							</thead>
							<tbody>
			<?php
					$count=1;
					$ShowActivityName=new ShowActivityName($txt_class,$txt_term,$txt_year);
					foreach($ShowActivityName->RunShowActivityName() as $rc=>$ShowActivityNameRow){	?>
						
				<?php
					$ActivitySudRc=new ActivitySudRc($txt_class,$txt_term,$txt_year,$ShowActivityNameRow["activity_txt"]);
						if($txt_class=="2123"){
							$PrintClass="ประถมศึกษาตอนปลาย";
						}elseif($txt_class=="3133"){
							$PrintClass="มัธยมศึกษาตอนต้น";
						}elseif($txt_class=="4143"){
							$PrintClass="มัธยมศึกษาตอนปลาย";
						}elseif($txt_class=="3142"){
							$PrintClass="มัธยมศึกษาปีที่1-5";
						}else{
							$PrintClass=null;
						}
				?>

								<tr>
									<td class="success"><div><?php echo $count;?></div></td>
									<td class="info"><div><?php echo $ShowActivityNameRow["activity_txt"];?></div></td>
									<td class="warning"><div><?php echo $ActivitySudRc->RunSudActivityCount();?></div></td>
									<td class="danger"><div>
<form name="read_report<?php echo $count;?>" action="<?php echo $golink;?>/activity/print_activity" method="post" target="_blank">									
										<button type="submit" class="btn btn-default">รายชื่อนักเรียนลงกิจกรรม</button> 
<input type="hidden" name="txt_c" value="<?php echo $txt_class;?>">								
<input type="hidden" name="txt_t" value="<?php echo $txt_term;?>">								
<input type="hidden" name="txt_y" value="<?php echo $txt_year;?>">					
<input type="hidden" name="txt_name" value="<?php echo $ShowActivityNameRow["activity_txt"];?>">							
</form>										
									</div></td>
								</tr>	
																
			<?php	$count=$count+1;} ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>	
		</div>
			
											
	<?php	}else{}?>