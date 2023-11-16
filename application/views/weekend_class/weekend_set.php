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
<form>
	<div class="row" style="font-size: 16px;">
		<div class="col-md-12">
			<div class="panel panel-body border-top-brown">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr class="danger">
								<th style="text-align: center; width: 10%;"><div>ลำดับ</div></th>
								<th style="text-align: center; width: 20%;"><div>รหัส วิชา / กิจกรรม</div></th>
								<th style="text-align: center; width: 50%;"><div>รายการ วิชา / กิจกรรม</div></th>
								<th style="text-align: center; width: 10%;"><div>ราคา</div></th>
								<th style="text-align: center; width: 10%;"><div>จำนวนที่เปิดรับลงทะเบียน</div></th>
							</tr>
						</thead>
						<tbody>
	<?php
			$count=1;
			$PrintYTWeekendClass=new PrintYTWeekendClass($txt_t,$txt_y);
			foreach($PrintYTWeekendClass->RunPrintYTWeekendClass() as $rc=>$PrintYTWeekendRow){ ?>
				 
							<tr class="info">
								<td style="width: 10%;"><div><?php echo $count;?></div></td>
								<td style="width: 20%;"><div><input type="text"   name="WcKey<?php echo $count;?>"    class="form-control" value="<?php echo $PrintYTWeekendRow["wc_key"];?> "  required="required" readonly="readonly" style="font-size: 16px;"></div></td>
								<td style="width: 50%;"><div><input type="text"   name="WcTxt<?php echo $count;?>"    class="form-control" value="<?php echo $PrintYTWeekendRow["wc_txt"];?>"   required="required" style="font-size: 16px;"></div></td>
								<td style="width: 10%;"><div><input type="number" name="WcPay<?php echo $count;?>"    class="form-control" value="<?php echo $PrintYTWeekendRow["wc_pay"];?>"   required="required" min="<?php echo $PrintYTWeekendRow["wc_pay"];?>" style="font-size: 16px;"></div></td>
								<td style="width: 10%;"><div><input type="number" name="WcCount<?php echo $count;?>"  class="form-control" value="<?php echo $PrintYTWeekendRow["wc_count"];?>" required="required" min="<?php echo $PrintYTWeekendRow["wc_count"];?>" style="font-size: 16px;"></div></td>
							</tr>			
							
		
	
	<?php	
			$count=$count+1;
	
			} ?>	
					

					  
						</tbody>
					</table>
				</div>			
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-body border-top-brown">
				<button type="submit" class="btn btn-success">บันทึกการแก้ไขข้อมูล</button>
			</div>
		</div>
	</div>
</form>	
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