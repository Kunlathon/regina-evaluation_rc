<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
//--------------------------------------------------------------------        
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
	include("view/database/pdo_quota.php");
	include("view/database/class_quota.php");
	
	include("view/database/pdo_data.php");
	include("view/database/pdo_conndatastu.php");
	include("view/database/pdo_admission.php");
	include("view/database/regina_student.php");
	
	
	include("view/database/pdo_weekend.php");
	include("view/database/class_weekend.php");
		
//--------------------------------------------------------------------
//--------------------------------------------------------------------	
		if($this->session->userdata("rc_user")==null){
			$this->session->unset_userdata("rc_user");
			exit("<script>window.location='$golink/print_imgstu/error';</script>");
		}else{	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$LoginKey=$this->session->userdata("rc_user");
		$uesr_log=$this->load->database("default",TRUE);
		$uesr_log=$this->db->query("SELECT COUNT(`rsl_user`) AS `int_uesr` 
									FROM `regina_stu_login` 
									WHERE `rsl_user`='{$LoginKey}'");
		foreach($uesr_log->result_array() as $log_row){
			if($log_row["int_uesr"]>=1){
				$UesrRc=$this->load->database("default",TRUE);
				$UesrRc=$this->db->select("rsd_studentid");
				$UesrRc=$this->db->where("rsl_user",$LoginKey);
				$UesrRcRow=$this->db->get("regina_stu_login");
				foreach($UesrRcRow->result() as $URR){
					$usercopy=($URR->rsd_studentid);
						if($usercopy==$pw_key){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<style>
.psrA{
	margin: auto;
	border: 3px solid #73AD21;
}
</style>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="stats-in-th" content="b062" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="shortcut icon" type="image/png">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="72x72">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="114x114">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="144x144">
		<title>พิมพ์&nbsp;ใบมอบตัวนักเรียนรอบโควตานักเรียนโรงเรียนเรยีนาเชลีวิทยาลัย</title>
		<link rel="shortcut icon" href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png"/>
<!-- Global stylesheets -->

<!-- Global stylesheets -->
<!-- /global stylesheets -->		
<!--Code Print css-->
		<link rel="stylesheet" href="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/css/normalize.css">
		<link rel="stylesheet" href="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/css/paper.css"> 	
<!--Code Print css End-->

		<style>
			@font-face {
				font-family: 'THSarabunNew';
				src: url('<?php echo base_url();?>/view/font/thsarabunnew-webfont.eot');
				src: url('<?php echo base_url();?>/view/font/thsarabunnew-webfont.eot?#iefix') format('embedded-opentype'),
			url('<?php echo base_url();?>/view/font/thsarabunnew-webfont.woff') format('woff'),
			url('<?php echo base_url();?>/view/font/THSarabunNew.ttf') format('truetype');
			}
			body{
				font-family: "THSarabunNew";
				font-size: 20px;
				color: #032E3B;
			}
		</style>
	
		<style>
			@media print {
				
				@page{
					size: A4;
					margin: 1 cm;
				}
				
				button {
					display:none;
				}
				
				#p_echo{
					display:none;
				}
				
				body{
					font-family: "THSarabunNew";
					font-size: 16pt; 
							
				}
			}
			
			body{
				width: 210mm; height: 296mm;
			}
			.imgA{
				width: 210mm; height: 296mm;
			}
		</style>
		
		

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
<!-- Core JS files -->
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery.min.js"></script>
	
<!-- /core JS files -->	
<!--Code Print js-->
	<script src="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/js/html2canvas.js"></script>	
<!--Code Print js End-->
		
	</head>
	<body>
	<div id="p_echo">
		<div class="container psrA">
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="table-responsive">
						<table class="table" align="center" >
							<thead>
								<tr>
									<th style="width: 20%">
										<div><button type="button"  style="font-size: 18px;" class="btn btn-default" onclick="window.print()"><b>พิมพ์&nbsp;ใบรายการลงทะเบียน&nbsp;RC&nbsp;Happy&nbsp;Weekend</b></button></div>
									</th>
								</tr>
								<tr>
									<th style="width: 20%">
										<div><font color="#F70105" style="font-size: 18px;"><b>ระบบการพิมพ์ &nbsp;รองรับ&nbsp;เว็บเบราว์เซอร์ &nbsp;Google&nbsp;Chrome&nbsp;และ &nbsp;Microsoft&nbsp;Edge&nbsp;เท่านั้น<b></font></div>
									</th>								
								</tr>
							</thead>						
						</table>
						<table class="table" align="center">
							<thead>
								<tr>
									<th style="width: 20%" style="font-size: 18px;"><div>ขนาดกระดาษ</div></th>
									<th style="width: 20%" style="font-size: 18px;"><div>แนวกระดาษ</div></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><div style="font-size: 18px;">A4&nbsp;:&nbsp;210mm&nbsp;X&nbsp;147mm</div></td>
									<td><div style="font-size: 18px;">แนวตั้ง</div></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>		
			</div>		
		</div>
	</div>	
	
	<?php
//----------------------------------------------------------------------------------			
		$WDAKey=$pw_key;
		$WDAY=$pw_y;
		$WDAT=$pw_t;
//----------------------------------------------------------------------------------			
		$call_stu=new stu_levelpdo($WDAKey,$WDAY,$WDAT); 	
		$weekend_rcname=new PrintReginaStuData($WDAKey);
//----------------------------------------------------------------------------------	
	?>	
	
	<section class="sheet padding-10mm imgA">
	
		<table style="width: 740px;"  border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 65px; height: 69px;" alt=""/></td>
					<td>
						
						<div style="font-style:bold; font-size: 22px;"><b>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;จังหวัดเชียงใหม่&nbsp;</b></div>
						<div style="font-style:bold; font-size: 22px;"><b>ใบรายการลงทะเบียนเรียน&nbsp;RC&nbsp;Happy&nbsp;Weekend&nbsp;ปีการศึกษา&nbsp;<?php echo $WDAT;?>/<?php echo $WDAY;?>&nbsp;</b></div>			
						
					</td>
					<td>
						<div style="font-style:bold; font-size: 20px;"><b>เลขที่</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" size="20" value="&nbsp;<?php echo $WDAKey.$WDAT.$WDAY;?>"></div>
						<div style="font-style:bold; font-size: 20px;"><b>วันที่</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" size="20" value="&nbsp;<?php echo date("d/m/Y H:i:s")?>"></div>
					</td>
				</tr>
			</tbody>
		</table><br>
		
		<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div style="font-style:bold; font-size: 20px;"><b>รหัสนักเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" size="10" value="&nbsp;<?php echo $WDAKey;?>"><b>ชื่อ - สกุล</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" size="50" value="&nbsp;<?php echo $weekend_rcname->PRS_nameTH;?>"><b>ระดับชั้น</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" size="18" value="&nbsp;<?php echo $call_stu->Sort_name."/".$call_stu->rsc_room;?>"></div>
					</td>
				</tr>
			</tbody>				
		</table>
		
	
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
				if(isset($WsKey)){
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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
                                <br>
								<table style="width: 740px; font-size: 20px;" border="1" cellpadding="0" cellspacing="0">
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
									$DataServePay=new PayServeWeekRc($WDAKey,$WDAT,$WDAY,$call_stu->IDLevel,'LIST','Loop');
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
											<th>&nbsp;</th>
											<th>&nbsp;</th>										
										    <th>รวม&nbsp;</th>	
										    <th><div style="font-weight: bold; font-size: 18px; color:#FF0000; text-align: right;"><?php echo number_format($SumPay, 2, '.', ',');?></div></th>	
										    <th style="text-align: right;">บาท</th>											
										</tr>
										
									</tbody>
								</table>								
                                <br>
								<br>
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
								<table style="width: 200px;"  border="0" cellpadding="0" cellspacing="0">
									<tbody>
										<tr>
											<td style="width: 100px;">
												<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="160" height="160"></div>
											</td>
											<td style="width: 100px;">
												<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
												<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
												<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
												<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($SumPay, 2, '.', ',');?></div>											
											</td>
										</tr>
									</tbody>
								</table>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
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
							if($TestWcrLearn=="A"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<br>
								
								<table style="width: 740px; font-size: 20px;" border="1" cellpadding="0" cellspacing="0">
									<thead>
										<tr align="center">
											<th style="width: 48px;"><div style="text-align: center;">ลำดับ</div></th>
											<th style="width: 448px;"><div style="text-align: center;">รายการ</div></th>
											<th style="width: 48px;"><div style="text-align: center;">เวลา</div></th>
											<th style="width: 100px;"><div style="text-align: center;">ราคา</div></th>
											<th style="width: 104px;"><div style="text-align: center;">ราคาต่อหน่วย</div></th>
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
											<td><div>&nbsp;<?php echo $CallWeekendClassRcRow["wc_txt"];?></div></td>
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
									$DataServePay=new PayServeWeekRc($WDAKey,$WDAT,$WDAY,$call_stu->IDLevel,'LIST','Loop');
									foreach($DataServePay->RunLoopPayServeWeek() as $rc=>$DataServePayRow){	
										$NameServe=new DataServeWeek($DataServePayRow["WSL_WS_No"]);
									?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<tr>
											<td><div style="text-align: center;"><?php echo $CWCR_Count;?></div></td>
											<td><div>&nbsp;<?php echo $NameServe->ReadDSWTxtTh();?></div></td>
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
											<th><div></div></th>
											<th><div></div></th>
											<th><div>รวม</div></th>
											<th><div style="font-weight: bold; font-size: 18px; color:#FF0000; text-align: right;"><?php echo number_format($SumPay, 2, '.', ',');?></div></th>
											<th><div style="text-align: right;">บาท</div></th>
										</tr>										
									</tbody>
								</table>								
								
                                <br>
								<br>
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
								<table style="width: 200px;"  border="0" cellpadding="0" cellspacing="0">
									<tbody>
										<tr>
											<td style="width: 100px;">
												<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="160" height="160"></div>
											</td>
											<td style="width: 100px;">
												<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
												<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
												<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
												<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($SumPay, 2, '.', ',');?></div>											
											</td>
										</tr>
									</tbody>
								</table>
								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
					<?php	}elseif($TestWcrLearn=="B"){ ?>

                                <br>


								<table style="width: 740px; font-size: 20px;" border="1" cellpadding="0" cellspacing="0">
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
											<td><div>&nbsp;<?php echo $CallWeekendClassRcRow["wc_txt"];?></div></td>
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
									$DataServePay=new PayServeWeekRc($WDAKey,$WDAT,$WDAY,$call_stu->IDLevel,'LIST','Loop');
									foreach($DataServePay->RunLoopPayServeWeek() as $rc=>$DataServePayRow){	
										$NameServe=new DataServeWeek($DataServePayRow["WSL_WS_No"]);
									?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<tr>
											<td><div style="text-align: center;"><?php echo $CWCR_Count;?></div></td>
											<td><div>&nbsp;<?php echo $NameServe->ReadDSWTxtTh();?></div></td>
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
											<th></th>
											<th></th>
											<th>รวม</th>
											<th><div style="font-weight: bold; font-size: 18px; color:#FF0000; text-align: right;"><?php echo number_format($SumPay, 2, '.', ',');?></div></th>
											<th><div style="text-align: right;">บาท</div></th>
										</tr>
									</tbody>
								</table>								
								
                                <br>
								<br>
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
								<table style="width: 200px;"  border="0" cellpadding="0" cellspacing="0">
									<tbody>
										<tr>
											<td style="width: 100px;">
												<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="160" height="160"></div>
											</td>
											<td style="width: 100px;">
												<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
												<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
												<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
												<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($SumPay, 2, '.', ',');?></div>											
											</td>
										</tr>
									</tbody>
								</table>								
								
					<?php	}else{}
						}
					}else{}
				}else{}
		?>


	</section>
	
	
	</body>
</html>						
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
				<?php	}else{
							$this->session->unset_userdata("rc_user");
							exit("<script>window.location='$golink/print_imgstu/error';</script>");
						}
				}
			}else{
				$admin_log=$this->load->database("default",TRUE);		
				$admin_log=$this->db->query("SELECT COUNT(`login_id`) AS `int_uesr` 
											 FROM `login` 
											 WHERE `use_status`='1' 
											 AND `login_id`='{$LoginKey}'");
				foreach($admin_log->result_array() as $log_row){
					if($log_row["int_uesr"]>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<style>
.psrA{
	margin: auto;
	border: 3px solid #73AD21;
}
</style>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="stats-in-th" content="b062" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="shortcut icon" type="image/png">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="72x72">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="114x114">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="144x144">
		<title>พิมพ์&nbsp;ใบมอบตัวนักเรียนรอบโควตานักเรียนโรงเรียนเรยีนาเชลีวิทยาลัย</title>
		<link rel="shortcut icon" href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png"/>
<!-- Global stylesheets -->

<!-- Global stylesheets -->
<!-- /global stylesheets -->		
<!--Code Print css-->
		<link rel="stylesheet" href="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/css/normalize.css">
		<link rel="stylesheet" href="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/css/paper.css"> 	
<!--Code Print css End-->

		<style>
			@font-face {
				font-family: 'THSarabunNew';
				src: url('<?php echo base_url();?>/view/font/thsarabunnew-webfont.eot');
				src: url('<?php echo base_url();?>/view/font/thsarabunnew-webfont.eot?#iefix') format('embedded-opentype'),
			url('<?php echo base_url();?>/view/font/thsarabunnew-webfont.woff') format('woff'),
			url('<?php echo base_url();?>/view/font/THSarabunNew.ttf') format('truetype');
			}
			body{
				font-family: "THSarabunNew";
				font-size: 20px;
				color: #032E3B;
			}
		</style>
	
		<style>
			@media print {
				
				@page{
					size: A4;
					margin: 1 cm;
				}
				
				button {
					display:none;
				}
				
				#p_echo{
					display:none;
				}
				
				body{
					font-family: "THSarabunNew";
					font-size: 16pt; 
							
				}
			}
			
			body{
				width: 210mm; height: 296mm;
			}
			.imgA{
				width: 210mm; height: 296mm;
			}
		</style>
		
		

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
<!-- Core JS files -->
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery.min.js"></script>
	
<!-- /core JS files -->	
<!--Code Print js-->
	<script src="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/js/html2canvas.js"></script>	
<!--Code Print js End-->
		
	</head>
	<body>
	<div id="p_echo">
		<div class="container psrA">
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="table-responsive">
						<table class="table" align="center" >
							<thead>
								<tr>
									<th style="width: 20%">
										<div><button type="button"  style="font-size: 18px;" class="btn btn-default" onclick="window.print()"><b>พิมพ์&nbsp;ใบรายการลงทะเบียน&nbsp;RC&nbsp;Happy&nbsp;Weekend</b></button></div>
									</th>
								</tr>
								<tr>
									<th style="width: 20%">
										<div><font color="#F70105" style="font-size: 18px;"><b>ระบบการพิมพ์ &nbsp;รองรับ&nbsp;เว็บเบราว์เซอร์ &nbsp;Google&nbsp;Chrome&nbsp;และ &nbsp;Microsoft&nbsp;Edge&nbsp;เท่านั้น<b></font></div>
									</th>								
								</tr>
							</thead>						
						</table>
						<table class="table" align="center">
							<thead>
								<tr>
									<th style="width: 20%" style="font-size: 18px;"><div>ขนาดกระดาษ</div></th>
									<th style="width: 20%" style="font-size: 18px;"><div>แนวกระดาษ</div></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><div style="font-size: 18px;">A4&nbsp;:&nbsp;210mm&nbsp;X&nbsp;147mm</div></td>
									<td><div style="font-size: 18px;">แนวตั้ง</div></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>		
			</div>		
		</div>
	</div>	
	
	<?php
//----------------------------------------------------------------------------------			
		$WDAKey=$pw_key;
		$WDAY=$pw_y;
		$WDAT=$pw_t;
//----------------------------------------------------------------------------------			
		$call_stu=new stu_levelpdo($WDAKey,$WDAY,$WDAT); 	
		$weekend_rcname=new PrintReginaStuData($WDAKey);
//----------------------------------------------------------------------------------	
	?>	
	
	<section class="sheet padding-10mm imgA">
	
		<table style="width: 740px;"  border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 65px; height: 69px;" alt=""/></td>
					<td>
						
						<div style="font-style:bold; font-size: 22px;"><b>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;จังหวัดเชียงใหม่&nbsp;</b></div>
						<div style="font-style:bold; font-size: 22px;"><b>ใบรายการลงทะเบียนเรียน&nbsp;RC&nbsp;Happy&nbsp;Weekend&nbsp;ปีการศึกษา&nbsp;<?php echo $WDAT;?>/<?php echo $WDAY;?>&nbsp;</b></div>			
						
					</td>
					<td>
						<div style="font-style:bold; font-size: 20px;"><b>เลขที่</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" size="20" value="&nbsp;<?php echo $WDAKey.$WDAT.$WDAY;?>"></div>
						<div style="font-style:bold; font-size: 20px;"><b>วันที่</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" size="20" value="&nbsp;<?php echo date("d/m/Y H:i:s")?>"></div>
					</td>
				</tr>
			</tbody>
		</table><br>
		
		<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div style="font-style:bold; font-size: 20px;"><b>รหัสนักเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" size="10" value="&nbsp;<?php echo $WDAKey;?>"><b>ชื่อ - สกุล</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" size="50" value="&nbsp;<?php echo $weekend_rcname->PRS_nameTH;?>"><b>ระดับชั้น</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" size="18" value="&nbsp;<?php echo $call_stu->Sort_name."/".$call_stu->rsc_room;?>"></div>
					</td>
				</tr>
			</tbody>				
		</table>
		
	
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
				if(isset($WsKey)){
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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
                                <br>
								<table style="width: 740px; font-size: 20px;" border="1" cellpadding="0" cellspacing="0">
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
									$DataServePay=new PayServeWeekRc($WDAKey,$WDAT,$WDAY,$call_stu->IDLevel,'LIST','Loop');
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
											<th>&nbsp;</th>
											<th>&nbsp;</th>										
										    <th>รวม&nbsp;</th>	
										    <th><div style="font-weight: bold; font-size: 18px; color:#FF0000; text-align: right;"><?php echo number_format($SumPay, 2, '.', ',');?></div></th>	
										    <th style="text-align: right;">บาท</th>											
										</tr>
										
									</tbody>
								</table>								
                                <br>
								<br>
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
								<table style="width: 200px;"  border="0" cellpadding="0" cellspacing="0">
									<tbody>
										<tr>
											<td style="width: 100px;">
												<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="160" height="160"></div>
											</td>
											<td style="width: 100px;">
												<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
												<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
												<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
												<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($SumPay, 2, '.', ',');?></div>											
											</td>
										</tr>
									</tbody>
								</table>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
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
							if($TestWcrLearn=="A"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<br>
								
								<table style="width: 740px; font-size: 20px;" border="1" cellpadding="0" cellspacing="0">
									<thead>
										<tr align="center">
											<th style="width: 48px;"><div style="text-align: center;">ลำดับ</div></th>
											<th style="width: 448px;"><div style="text-align: center;">รายการ</div></th>
											<th style="width: 48px;"><div style="text-align: center;">เวลา</div></th>
											<th style="width: 100px;"><div style="text-align: center;">ราคา</div></th>
											<th style="width: 104px;"><div style="text-align: center;">ราคาต่อหน่วย</div></th>
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
											<td><div>&nbsp;<?php echo $CallWeekendClassRcRow["wc_txt"];?></div></td>
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
									$DataServePay=new PayServeWeekRc($WDAKey,$WDAT,$WDAY,$call_stu->IDLevel,'LIST','Loop');
									foreach($DataServePay->RunLoopPayServeWeek() as $rc=>$DataServePayRow){	
										$NameServe=new DataServeWeek($DataServePayRow["WSL_WS_No"]);
									?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<tr>
											<td><div style="text-align: center;"><?php echo $CWCR_Count;?></div></td>
											<td><div>&nbsp;<?php echo $NameServe->ReadDSWTxtTh();?></div></td>
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
											<th><div></div></th>
											<th><div></div></th>
											<th><div>รวม</div></th>
											<th><div style="font-weight: bold; font-size: 18px; color:#FF0000; text-align: right;"><?php echo number_format($SumPay, 2, '.', ',');?></div></th>
											<th><div style="text-align: right;">บาท</div></th>
										</tr>										
									</tbody>
								</table>								
								
                                <br>
								<br>
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
								<table style="width: 200px;"  border="0" cellpadding="0" cellspacing="0">
									<tbody>
										<tr>
											<td style="width: 100px;">
												<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="160" height="160"></div>
											</td>
											<td style="width: 100px;">
												<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
												<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
												<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
												<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($SumPay, 2, '.', ',');?></div>											
											</td>
										</tr>
									</tbody>
								</table>
								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
					<?php	}elseif($TestWcrLearn=="B"){ ?>

                                <br>


								<table style="width: 740px; font-size: 20px;" border="1" cellpadding="0" cellspacing="0">
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
											<td><div>&nbsp;<?php echo $CallWeekendClassRcRow["wc_txt"];?></div></td>
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
									$DataServePay=new PayServeWeekRc($WDAKey,$WDAT,$WDAY,$call_stu->IDLevel,'LIST','Loop');
									foreach($DataServePay->RunLoopPayServeWeek() as $rc=>$DataServePayRow){	
										$NameServe=new DataServeWeek($DataServePayRow["WSL_WS_No"]);
									?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<tr>
											<td><div style="text-align: center;"><?php echo $CWCR_Count;?></div></td>
											<td><div>&nbsp;<?php echo $NameServe->ReadDSWTxtTh();?></div></td>
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
											<th></th>
											<th></th>
											<th>รวม</th>
											<th><div style="font-weight: bold; font-size: 18px; color:#FF0000; text-align: right;"><?php echo number_format($SumPay, 2, '.', ',');?></div></th>
											<th><div style="text-align: right;">บาท</div></th>
										</tr>
									</tbody>
								</table>								
								
                                <br>
								<br>
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
								<table style="width: 200px;"  border="0" cellpadding="0" cellspacing="0">
									<tbody>
										<tr>
											<td style="width: 100px;">
												<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="160" height="160"></div>
											</td>
											<td style="width: 100px;">
												<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
												<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
												<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
												<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($SumPay, 2, '.', ',');?></div>											
											</td>
										</tr>
									</tbody>
								</table>								
								
					<?php	}else{}
						}
					}else{}
				}else{}
		?>


	</section>
	
	
	</body>
</html>
						
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}else{
						$this->session->unset_userdata("rc_user");
						exit("<script>window.location='$golink/print_imgstu/error';</script>");						
					}
				}							 
			}
		}
	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	} ?>
