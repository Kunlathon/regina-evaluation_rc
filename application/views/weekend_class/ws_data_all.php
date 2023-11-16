<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
	include("view/database/pdo_quota.php");
	include("view/database/pdo_data.php");
	include("view/database/class_quota.php");
	
	include("view/database/pdo_weekend.php");
	include("view/database/class_weekend.php");
//--------------------------------------------------------------------
		if($this->session->userdata("rc_user")==null){
			$this->session->unset_userdata("rc_user");
			exit("<script>window.location='$golink/print_imgstu/error';</script>");				
		}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery.min.js"></script>
<!--****************************************************************************-->			
    <script type="text/javascript">
        function setScreenHWCookie() {
            $.cookie('sw',screen.width);
                //$.cookie('sh',screen.height);
            return true;
        }
            setScreenHWCookie();
    </script>
<!--****************************************************************************-->	
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
//----------------------------------------------------------------------------------			
			$WDAKey=$this->input->post('WsKey');
			$WDAY=$this->input->post('WsY');
			$WDAT=$this->input->post('WsT');
//----------------------------------------------------------------------------------			
			$call_stu=new stu_levelpdo($WDAKey,$WDAY,$WDAT); 			
//----------------------------------------------------------------------------------			
		?>
<!--****************************************************************************-->	
			<?php
			
				$WeekendPrint=new WeekendSystem($call_stu->IDLevel);
					foreach($WeekendPrint->RunWeekendSystem() as $rc=>$WeekendPrintRow){
						@$WsKey=$WeekendPrintRow["ws_key"];
						@$WsClassA=$WeekendPrintRow["ws_classA"];
						@$WsClassB=$WeekendPrintRow["ws_classB"];
						@$WsTestTime=$WeekendPrintRow["ws_test_time"];
						@$WsTestClass=$WeekendPrintRow["ws_test_class"];
						@$WdKey=$WeekendPrintRow["weekend_discount_wd_key"];
					}
					if(isset($WsKey)){ ?>
<!--****************************************************************************-->	
						<?php
							if($WsTestTime=="Y" and $WsTestClass=="N"){
								
								$TestWeekendClassRc=new PrintWeekendClassRc($WDAKey,$WDAT,$WDAY,'NotArray'); 
								foreach($TestWeekendClassRc->RunPrintWeekendClassRc() as $rc=>$TestWeekendClassRcRow){
//-------------------------------------------------------------------------------------------------------									
									if(isset($TestWeekendClassRcRow["wcr_learn"])){
										$TestWcrLearn=$TestWeekendClassRcRow["wcr_learn"];
									}else{
										$TestWcrLearn="-";
									}									
//-------------------------------------------------------------------------------------------------------
									if($TestWcrLearn=="C"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-default">
				<div class="panel-heading">รายการลงทะเบียน&nbsp;:&nbsp;ภาคเรียนที่&nbsp;<?php echo $WDAT;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $WDAY;?>&nbsp;รหัสนักเรียน&nbsp;<?php echo $WDAKey;?></div>
				<div class="panel-body">
				
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th><div style="text-align: center;">ลำดับ</div></th>
											<th><div style="text-align: center;">รายการ</div></th>
											<th><div style="text-align: center;">เวลา</div></th>
											<th><div style="text-align: center;">ราคา</div></th>
											<th><div style="text-align: center;">ราคาต่อหน่วย</div></th>
										</tr>
									</thead>
									<tbody>
					<?php
							$CallWeekendDiscount=new WeekendDiscount("3");
							$SumPay=0;
							$CWCR_Count=1;
							$CallWeekendClassRc=new PrintWeekendClassRc($WDAKey,$WDAT,$WDAY,'Array2');
							foreach($CallWeekendClassRc->RunPrintWeekendClassRc() as $rc=>$CallWeekendClassRcRow){ 
							
							$CallWeekendClass=new DataWeekendClass($CallWeekendClassRcRow["weekend_class_wc_key"],$CallWeekendClassRcRow["wcr_t"],$CallWeekendClassRcRow["wcr_y"]);
							$CallWeekendClassTime=new DataWeekendClassTime($CallWeekendClassRcRow["weekend_class_time_wct_key"],$CallWeekendClassRcRow["wcr_t"],$CallWeekendClassRcRow["wcr_y"]);
							
							?>
										<tr>
											<td><div style="text-align: center;"><?php echo $CWCR_Count;?></div></td>
											<td><div><?php echo $CallWeekendClass->wc_txt;?></div></td>
											<td><div><?php echo $CallWeekendClassTime->wct_timeA;?>&nbsp;น.&nbsp;ถึง&nbsp;<?php echo $CallWeekendClassTime->wct_timeB;?>&nbsp;น.</div></td>
											<td><div style="text-align: right;"><?php echo number_format($CallWeekendClass->wc_pay, 2, '.', ',');?></div></td>
											<td><div style="text-align: right;">บาท</div></td>
										</tr>		

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

										
					<?php	$SumPay=$SumPay+$CallWeekendClass->wc_pay;				
							$CWCR_Count=$CWCR_Count+1;
							} ?>	


<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
							<?php  
									$DataServePay=new PayServeWeekRc($WDAKey,$WDAT,$WDAY,$call_stu->IDLevel,'ALL','Loop');
									foreach($DataServePay->RunLoopPayServeWeek() as $rc=>$DataServePayRow){	
										$NameServe=new DataServeWeek($DataServePayRow["WSL_WS_No"]);
									?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<tr>
											<td><div style="text-align: center;"><div><?php echo $CWCR_Count;?></div></div></td>
											<td><div><?php echo $NameServe->ReadDSWTxtTh();?></div></td>
											<td><div></div></td>
											<td><div style="text-align: right;"><?php echo $DataServePayRow["WSL_WSP_Pay"];?></div></td>
											<td><div style="text-align: right;">บาท</div></td>
	
										</tr>									
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
							<?php	
								$SumPay=$SumPay+$DataServePayRow["WSL_WSP_Pay"];
								$CWCR_Count=$CWCR_Count+1;
									} ?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

							
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											
					<?php
							$CWCR_Count=$CWCR_Count-1;
							if($CWCR_Count>=$CallWeekendDiscount->PrintWdCount()){ 
								$SumPay=$SumPay-$CallWeekendDiscount->PrintWdDiscount();
							?>
											<td>ส่วนสด&nbsp;</td>
											<td><div style="text-align: right;">-<?php echo number_format($CallWeekendDiscount->PrintWdDiscount(), 2, '.', ',');?></div></td>
											<td style="text-align: right;">บาท</td>									
							
					<?php	}else{ ?>
							
											<td>ส่วนสด&nbsp;</td>
											<td><div style="text-align: right;">-0.00</div></td>
											<td style="text-align: right;">บาท</td>		
											
					<?php	} ?>						

					
										</tr>	
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>										
										    <td>รวม&nbsp;</td>	
										    <td><div style="font-weight: bold; font-size: 18px; color:#FF0000; text-align: right;"><?php echo number_format($SumPay, 2, '.', ',');?></div></td>	
										    <td style="text-align: right;">บาท</td>											
										</tr>
										
									</tbody>
								</table>
							</div>						
						</div>
					</div><hr>
					
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<?php
								include("view/function/pay_scb.php");
								$class_ex=$call_stu->IDLevel;
								$txt_billerId="099400043439110";
								$txt_ref1=strtoupper($WDAKey."L".$class_ex."Y".$WDAY);
								$txt_ref2=strtoupper("WEEKEND".$WDAT."TY".$WDAY);
								$txt_amount=number_format($SumPay, 2, '.', '');                                                   
								$txt_width="104";
								$payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
							?>	
							<div class="row">
								<div class="col-<?php echo $grid;?>-2">
									<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="160" height="160"></div>								
								</div>
								<div class="col-<?php echo $grid;?>-10">
									<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
									<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
									<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
									<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($SumPay, 2, '.', ',');?></div>								
								</div>
							</div>
						</div>
					</div>
					

				
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-4">&nbsp;</div>
		<div class="col-<?php echo $grid;?>-4">
			<a href="<?php echo $golink;?>/weekend_class/print_weekend/<?php echo $WDAT;?>/<?php echo $WDAY;?>/<?php echo $WDAKey;?>" target="_blank"><div class="panel panel-body bg-blue-400 has-bg-image">
				<div class="media no-margin">
					<div class="media-body">  
						<h3 class="no-margin">พิมพ์</h3>
						<span class="text-uppercase"><h5>ใบรายการลงทะเบียนเรียน RC Happy Weekend</h5></span>
					</div>

					<div class="media-right media-middle">
						<i class="icon-printer icon-3x opacity-75"></i>
					</div>
				</div>
			</div></a>
		</div>
		<div class="col-<?php echo $grid;?>-4">&nbsp;</div>
	</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
							<?php	}else{}
								}
							}elseif($WsTestTime=="N" and $WsTestClass=="Y"){
								$TestWeekendClassRc=new PrintWeekendClassRc($WDAKey,$WDAT,$WDAY,'NotArray'); 
								foreach($TestWeekendClassRc->RunPrintWeekendClassRc() as $rc=>$TestWeekendClassRcRow){
//-------------------------------------------------------------------------------------------------------									
									if(isset($TestWeekendClassRcRow["wcr_learn"])){
										$TestWcrLearn=$TestWeekendClassRcRow["wcr_learn"];
									}else{
										$TestWcrLearn="-";
									}
//-------------------------------------------------------------------------------------------------------
									if($TestWcrLearn=="A"){ ?><!--4 วิชาหลัก + 1กิจกรรม-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-default">
				<div class="panel-heading">รายการลงทะเบียน&nbsp;:&nbsp;ภาคเรียนที่&nbsp;<?php echo $WDAT;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $WDAY;?>&nbsp;รหัสนักเรียน&nbsp;<?php echo $WDAKey;?></div>
				<div class="panel-body">
				
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr align="center">
											<th><div style="text-align: center;">ลำดับ</div></th>
											<th><div style="text-align: center;">รายการ</div></th>
											<th><div style="text-align: center;">เวลา</div></th>
											<th><div style="text-align: center;">ราคา</div></th>
											<th><div style="text-align: center;">ราคาต่อหน่วย</div></th>
										</tr>
									</thead>
									<tbody>
					<?php
							$CallWeekendDiscount=new WeekendDiscount("2");
							$SumPay=0;
							$CWCR_Count=1;
							$CallWeekendClassRc=new PrintWeekendClassRc($WDAKey,$WDAT,$WDAY,'Array');
							foreach($CallWeekendClassRc->RunPrintWeekendClassRc() as $rc=>$CallWeekendClassRcRow){ ?>
										<tr>
											<td><div style="text-align: center;"><?php echo $CWCR_Count;?></div></td>
											<td><div><?php echo $CallWeekendClassRcRow["wc_txt"];?></div></td>
											<td><div><?php echo $CallWeekendClassRcRow["wct_timeA"];?>&nbsp;น.&nbsp;ถึง&nbsp;<?php echo $CallWeekendClassRcRow["wct_timeB"];?>&nbsp;น.</div></td>
											<td><div style="text-align: right;"><?php echo number_format($CallWeekendClassRcRow["wc_pay"], 2, '.', ',');?></div></td>
											
						<?php
								if($CallWeekendClassRcRow["weekend_class_type_wt_on"]==1){ ?>
											<td><div style="text-align: right;">บาท</div></td>
						<?php	}else{ ?>
											<td><div style="text-align: right;">บาท</div></td>								
						<?php	}	?>					
											

										</tr>			

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										
					<?php	$SumPay=$SumPay+$CallWeekendClassRcRow["wc_pay"];
							$CWCR_Count=$CWCR_Count+1;} ?>
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
							<?php  
									$DataServePay=new PayServeWeekRc($WDAKey,$WDAT,$WDAY,$call_stu->IDLevel,'ALL','Loop');
									foreach($DataServePay->RunLoopPayServeWeek() as $rc=>$DataServePayRow){	
										$NameServe=new DataServeWeek($DataServePayRow["WSL_WS_No"]);
									?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<tr>
											<td><div style="text-align: center;"><?php echo $CWCR_Count;?></div></td>
											<td><div><?php echo $NameServe->ReadDSWTxtTh();?></div></td>
											<td><div></div></td>
											<td><div style="text-align: right;"><?php echo number_format($DataServePayRow["WSL_WSP_Pay"], 2, '.', ',');?></div></td>
											<td><div style="text-align: right;">บาท</div></td>
	
										</tr>									
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
							<?php	
								$SumPay=$SumPay+$DataServePayRow["WSL_WSP_Pay"];
								$CWCR_Count=$CWCR_Count+1;
									} ?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
							
					<?php	
							$SumPay=$SumPay-$CallWeekendDiscount->PrintWdDiscount();
							?>				
										<tr>
											<td><div></div></td>
											<td><div></div></td>
											<td><div>ส่วนลด</div></td>
											<td><div style="text-align: right;">-<?php echo $CallWeekendDiscount->PrintWdDiscount();?></div></td>
											<td><div style="text-align: right;">บาท</div></td>
										</tr>
										<tr>
											<td><div></div></td>
											<td><div></div></td>
											<td><div>รวม</div></td>
											<td><div style="font-weight: bold; font-size: 18px; color:#FF0000; text-align: right;"><?php echo number_format($SumPay, 2, '.', ',');?></div></td>
											<td><div style="text-align: right;">บาท</div></td>
										</tr>										
									</tbody>
								</table>
							</div>						
						</div>
					</div><hr>
					
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<?php
								include("view/function/pay_scb.php");
								$class_ex=$call_stu->IDLevel;
								$txt_billerId="099400043439110";
								$txt_ref1=strtoupper($WDAKey."L".$class_ex."Y".$WDAY);
								$txt_ref2=strtoupper("WEEKEND".$WDAT."TY".$WDAY);
								$txt_amount=number_format($SumPay, 2, '.', '');                                                   
								$txt_width="104";
								$payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
							?>	
							<div class="row">
								<div class="col-<?php echo $grid;?>-2">
									<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="160" height="160"></div>								
								</div>
								<div class="col-<?php echo $grid;?>-10">
									<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
									<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
									<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
									<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($SumPay, 2, '.', ',');?></div>								
								</div>
							</div>
						</div>
					</div>
					


				
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-4">&nbsp;</div>
		<div class="col-<?php echo $grid;?>-4">
			<a href="<?php echo $golink;?>/weekend_class/print_weekend/<?php echo $WDAT;?>/<?php echo $WDAY;?>/<?php echo $WDAKey;?>" target="_blank"><div class="panel panel-body bg-blue-400 has-bg-image">
				<div class="media no-margin">
					<div class="media-body">  
						<h3 class="no-margin">พิมพ์</h3>
						<span class="text-uppercase"><h5>ใบรายการลงทะเบียนเรียน RC Happy Weekend</h5></span>
					</div>

					<div class="media-right media-middle">
						<i class="icon-printer icon-3x opacity-75"></i>
					</div>
				</div>
			</div></a>
		</div>
		<div class="col-<?php echo $grid;?>-4">&nbsp;</div>
	</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
							<?php	}elseif($TestWcrLearn=="B"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-default">
				<div class="panel-heading">รายการลงทะเบียน&nbsp;:&nbsp;ภาคเรียนที่&nbsp;<?php echo $WDAT;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $WDAY;?>&nbsp;รหัสนักเรียน&nbsp;<?php echo $WDAKey;?></div>
				<div class="panel-body">
				
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr align="center">
											<th><div style="text-align: center;">ลำดับ</div></th>
											<th><div style="text-align: center;">รายการ</div></th>
											<th><div style="text-align: center;">เวลา</div></th>
											<th><div style="text-align: center;">ราคา</div></th>
											<th><div style="text-align: center;">ราคาต่อหน่วย</div></th>
										</tr>
									</thead>
									<tbody>
					<?php
							$SumPay=0;
							$CWCR_Count=1;
							$CallWeekendClassRc=new PrintWeekendClassRc($WDAKey,$WDAT,$WDAY,'Array');
							foreach($CallWeekendClassRc->RunPrintWeekendClassRc() as $rc=>$CallWeekendClassRcRow){ ?>
										<tr>
											<td><div style="text-align: center;"><?php echo $CWCR_Count;?></div></td>
											<td><div><?php echo $CallWeekendClassRcRow["wc_txt"];?></div></td>
											<td><div><?php echo $CallWeekendClassRcRow["wct_timeA"];?>&nbsp;น.&nbsp;ถึง&nbsp;<?php echo $CallWeekendClassRcRow["wct_timeB"];?>&nbsp;น.</div></td>
											<td><div style="text-align: right;"><?php echo number_format($CallWeekendClassRcRow["wc_pay"], 2, '.', ',');?></div></td>
											<td><div style="text-align: right;">บาท</div></td>
										</tr>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
					<?php	$SumPay=$SumPay+$CallWeekendClassRcRow["wc_pay"];
							$CWCR_Count=$CWCR_Count+1;
							} ?>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
							<?php  
									$DataServePay=new PayServeWeekRc($WDAKey,$WDAT,$WDAY,$call_stu->IDLevel,'ALL','Loop');
									foreach($DataServePay->RunLoopPayServeWeek() as $rc=>$DataServePayRow){	
										$NameServe=new DataServeWeek($DataServePayRow["WSL_WS_No"]);
									?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<tr>
											<td><div style="text-align: center;"><?php echo $CWCR_Count;?></div></td>
											<td><div><?php echo $NameServe->ReadDSWTxtTh();?></div></td>
											<td><div></div></td>
											<td><div style="text-align: right;"><?php echo number_format($DataServePayRow["WSL_WSP_Pay"], 2, '.', ',');?></div></td>
											<td><div style="text-align: right;">บาท</div></td>
	
										</tr>									
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
							<?php	
								$SumPay=$SumPay+$DataServePayRow["WSL_WSP_Pay"];
								$CWCR_Count=$CWCR_Count+1;
									} ?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
										<tr>
											<td></td>
											<td></td>
											<td>รวม</td>
											<td><div style="font-weight: bold; font-size: 18px; color:#FF0000; text-align: right;"><?php echo number_format($SumPay, 2, '.', ',');?></div></td>
											<th><div style="text-align: right;">บาท</div></th>
										</tr>
									</tbody>
								</table>
							</div>						
						</div>
					</div><hr>
					
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<?php
								include("view/function/pay_scb.php");
								$class_ex=$call_stu->IDLevel;
								$txt_billerId="099400043439110";
								$txt_ref1=strtoupper($WDAKey."L".$class_ex."Y".$WDAY);
								$txt_ref2=strtoupper("WEEKEND".$WDAT."TY".$WDAY);
								$txt_amount=number_format($SumPay, 2, '.', '');                                                   
								$txt_width="104";
								$payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
							?>	
							<div class="row">
								<div class="col-<?php echo $grid;?>-2">
									<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="160" height="160"></div>								
								</div>
								<div class="col-<?php echo $grid;?>-10">
									<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
									<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
									<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
									<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($SumPay, 2, '.', ',');?></div>								
								</div>
							</div>
						</div>
					</div>
				
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-4">&nbsp;</div>
		<div class="col-<?php echo $grid;?>-4">
			<a href="<?php echo $golink;?>/weekend_class/print_weekend/<?php echo $WDAT;?>/<?php echo $WDAY;?>/<?php echo $WDAKey;?>" target="_blank"><div class="panel panel-body bg-blue-400 has-bg-image">
				<div class="media no-margin">
					<div class="media-body">  
						<h3 class="no-margin">พิมพ์</h3>
						<span class="text-uppercase"><h5>ใบรายการลงทะเบียนเรียน RC Happy Weekend</h5></span>
					</div>

					<div class="media-right media-middle">
						<i class="icon-printer icon-3x opacity-75"></i>
					</div>
				</div>
			</div></a>
		</div>
		<div class="col-<?php echo $grid;?>-4">&nbsp;</div>
	</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
							<?php	}else{}
								}
							}else{}
						?>
<!--****************************************************************************-->							
			<?php	}else{} ?>
<!--****************************************************************************-->
<!--****************************************************************************-->	
<?php   } ?>