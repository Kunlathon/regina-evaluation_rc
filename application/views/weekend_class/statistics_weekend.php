<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
	include("view/database/pdo_weekend.php");
	include("view/database/class_weekend.php");
//--------------------------------------------------------------------
//--------------------------------------------------------------------
		if($this->session->userdata("rc_user")==null){
			$this->session->unset_userdata("rc_user");
			exit("<script>window.location='$golink/print_imgstu/error';</script>");
		}else{ ?>		
		<?php
			$WsTY=filter_input(INPUT_POST,'WsTY');
				if(isset($WsTY)){
					$txt_t=substr($WsTY,0,1);
					$txt_y=substr($WsTY,2,4); ?>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row" style="font-size: 16px;">
		<div class="col-md-12">
			<div class="panel panel-body border-top-brown">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr class="danger">
							
								<th style="text-align: center;"><div>รหัส วิชา / กิจกรรม</div></th>
								<th style="text-align: center;"><div>รายการ วิชา / กิจกรรม</div></th>
								<!--<th style="text-align: center;"><div>ราคา</div></th>-->
								<th style="text-align: center;"><div>รับลงทะเบียน</div></th>
								<th style="text-align: center;"><div>ผู้ลงทะเบียน</div></th>
								<th style="text-align: center;"><div>เวลาเรียน</div></th>
							</tr>
						</thead>
						<tbody>
	<?php
			$count=1;
			$PrintYTWeekendClass=new PrintYTWeekendClass($txt_t,$txt_y);
			foreach($PrintYTWeekendClass->RunPrintYTWeekendClass() as $rc=>$PrintYTWeekendRow){ ?>
<!--********************************************************************************************-->		
		
		<?php
				$ClassTimeWeek=new LoopClassTimeWeek($PrintYTWeekendRow["wc_key"],$txt_y,$txt_t);
				foreach($ClassTimeWeek->RunLoopClassTimeWeek() as $rc=>$ClassTimeWeekRow){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
							<tr class="info">
								
								<td><div><?php echo $PrintYTWeekendRow["wc_key"];?></div></td>
								<td><div><?php echo $PrintYTWeekendRow["wc_txt"];?></div></td>
								<!--<td><div><?php //echo number_format($PrintYTWeekendRow["wc_pay"], 2, '.', ',');?></div></td>-->
								<td style="font-weight: bold; text-align: center;"><div><?php echo $PrintYTWeekendRow["wc_count"];?></div></td>
								
		<?php
			$TestWeekendCount=new TestWeekendCountB($ClassTimeWeekRow["weekend_class_wc_key"],$ClassTimeWeekRow["wct_t"],$ClassTimeWeekRow["wct_y"],$ClassTimeWeekRow["wct_key"]);
		?>						
								
								<td style="font-weight: bold; text-align: center;"><div><a href="<?php echo $golink;?>/weekend_class/date_rc/<?php echo $PrintYTWeekendRow["wc_t"];?>/<?php echo $PrintYTWeekendRow["wc_y"];?>/<?php echo $PrintYTWeekendRow["wc_key"];?>" target="_blank"><?php echo $TestWeekendCount->RunPrintCount();?></a></div></td>
							
								<td style="font-weight: bold; text-align: center;"><div><?php echo $ClassTimeWeekRow["wct_timeA"]." ถึง ".$ClassTimeWeekRow["wct_timeB"];?></div></td>
							</tr>				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	} ?>
		
<!--********************************************************************************************-->				
	<?php	
			$count=$count+1;
			} ?>	
					

					  
						</tbody>
					</table>
				</div>			
			</div>
		</div>
	</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php   }	 ?>