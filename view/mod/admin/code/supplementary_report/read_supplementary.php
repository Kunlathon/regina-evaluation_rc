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
		include("../../../../database/database_evaluation.php");
		
		include("../../../../database/pdo_conndatastu.php");
		include("../../../../database/class_pdodatastu.php");
		
		include("../../../../database/pdo_data.php");
		include("../../../../database/class_admin.php");

		

		
		//include("../../../../database/pdo_activity.php");
		include("../../../../database/class_supplementary.php");
		
		
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
					if(TxtClass=="1213"){
						document.getElementById("print_class").innerHTML ="ระดับชั้น&nbsp;:&nbsp;ประถมศึกษาตอนต้น";	
						document.getElementById("ClassA").innerHTML ="12";
						document.getElementById("ClassB").innerHTML ="13";
						document.getElementById("PrintClass").innerHTML ="ประถมศึกษาตอนต้น";						
					}else if(TxtClass=="2123"){
						document.getElementById("print_class").innerHTML ="ระดับชั้น&nbsp;:&nbsp;ประถมศึกษาตอนปลาย";
						document.getElementById("ClassA").innerHTML ="21";
						document.getElementById("ClassB").innerHTML ="23";
						document.getElementById("PrintClass").innerHTML ="ประถมศึกษาตอนปลาย";										
					}else if(TxtClass=="3133"){
						document.getElementById("print_class").innerHTML ="ระดับชั้น&nbsp;:&nbsp;มัธยมศึกษาตอนต้น";
						document.getElementById("ClassA").innerHTML ="31";
						document.getElementById("ClassB").innerHTML ="33";
						document.getElementById("PrintClass").innerHTML ="มัธยมศึกษาตอนต้น";												
					}else if(TxtClass=="4143"){
						document.getElementById("print_class").innerHTML ="ระดับชั้น&nbsp;:&nbsp;มัธยมศึกษาตอนปลาย";
						document.getElementById("ClassA").innerHTML ="41";
						document.getElementById("ClassB").innerHTML ="43";
						document.getElementById("PrintClass").innerHTML ="มัธยมศึกษาตอนปลาย";					
					}else if(TxtClass=="1223"){
						document.getElementById("print_class").innerHTML ="ระดับชั้น&nbsp;:&nbsp;ประถมศึกษาปีที่&nbsp;2&nbsp;ถึง&nbsp;6";
						document.getElementById("ClassA").innerHTML ="12";
						document.getElementById("ClassB").innerHTML ="23";
						document.getElementById("PrintClass").innerHTML ="ประถมศึกษาปีที่&nbsp;2&nbsp;ถึง&nbsp;6";						
					}else{
						document.getElementById("print_class").innerHTML ="";
						document.getElementById("ClassA").innerHTML ="";
						document.getElementById("ClassB").innerHTML ="";
						document.getElementById("PrintClass").innerHTML ="";
					}
				});
			</script>	
			
			<?php
				switch($txt_class){
					case "1113":
						$ClassA="11";
						$ClassB="13";
						$PrintClass="ประถมศึกษาตอนต้น";
					break;
					case "2123":
						$ClassA="21";
						$ClassB="22";
						$PrintClass="ประถมศึกษาตอนปลาย";				
					break;
					case "3133":
						$ClassA="31";
						$ClassB="33";
						$PrintClass="มัธยมศึกษาตอนต้น";				
					break;		
					case "4143":
						$ClassA="41";
						$ClassB="43";
						$PrintClass="มัธยมศึกษาตอนปลาย";				
					break;
					case "1223":
						$ClassA="12";
						$ClassB="23";
						$PrintClass="ประถมศึกษาปีที่ 2 ถึง 6";				
					break;					
					default:
						$ClassA=null;
						$ClassB=null;
						$PrintClass=null;
				}
			?>
			
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
									<th class="info"><div>รายชื่อวิชา/กิจกรรม</div></th>
									<th class="warning"><div>จำนวนผู้ลงทะเบียน</div></th>
									<th class="danger"><div>เรียกดูข้อมูล</div></th>
								</tr>
							</thead>
							<tbody>
				<?php
					$count=1;
					$SupplementaryClass=new SupplementaryClass($txt_term,$ClassA,$ClassB,$txt_year);
						foreach($SupplementaryClass->RunSupplementaryClass() as $rc=>$SupplementaryClassRow){

								$CountSudSupplement=new CountSudSupplement($SupplementaryClassRow["ss_txtth"],$txt_term,$ClassA,$ClassB,$txt_year);

							?>
								
								<tr>
									<td class="success"><div><?php echo $count;?></div></td>
									<td class="info"><div><?php echo $SupplementaryClassRow["ss_txtth"];?></div></td>
									<td class="warning"><div><?php echo $CountSudSupplement->RunCountSudSupplementInt();?></div></td>
									<td class="danger"><div>
									
<form name="read_report<?php echo $count;?>" action="<?php echo $golink;?>/Print_supplementary/report_supplementary/<?php echo $txt_class;?>/<?php echo $txt_term;?>/<?php echo $txt_year;?>" method="post" target="_blank" >									
										<button type="submit" class="btn btn-default">รายชื่อนักเรียนลงกิจกรรม</button> 
										<input type="hidden" name="txt_c" value="<?php echo $txt_class;?>">								
										<input type="hidden" name="txt_t" value="<?php echo $txt_term;?>">								
										<input type="hidden" name="txt_y" value="<?php echo $txt_year;?>">					
										<input type="hidden" name="txt_name" value="<?php echo $SupplementaryClassRow["ss_txtth"];?>">		
</form>									
									</div></td>
								</tr>
								
			<?php		$count=$count+1;} ?>


							</tbody>
						</table>
					</div>
				</div>
			</div>	
		</div>
			
			
											
	<?php	}else{}?>