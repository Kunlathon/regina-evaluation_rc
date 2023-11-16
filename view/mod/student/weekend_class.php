	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<div id="RunLoad">
					<img class="img-thumbnail" src="Template/global_assets/images/Cube-1s-200px.gif"/>
				</div>	
			</center>
		</div>
	</div>
<?php
	$OFFONDateTime=date("2023-05-24 10:00:00");//Time Open***************
	//$OFFONDateTime=date("2021-07-24 08:00:00");
	$OFFONDateTime_Cr=date("Y-m-d H:i:s");
	$OFFONDateTime_notrun=strtotime($OFFONDateTime);
	$OFFONDateTime_run=strtotime($OFFONDateTime_Cr);		
//***********************************************************************		
		if($OFFONDateTime_run>=$OFFONDateTime_notrun){
			$OFFONPrint_runtime="ON";
		}else{
			$OFFONPrint_runtime="OFF"; 
		}
//***********************************************************************		
		switch($OFFONPrint_runtime){
			case "OFF":	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div id="RuningLoad" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="content-group-<?php echo $grid;?>">
					<div class="alert alpha-teal border-teal alert-styled-left">
						<div>RC&nbsp;Happy&nbsp;Weekend&nbsp;เปิดรับสมัครตั้งแต่วันที่&nbsp;26&nbsp;กันยายน&nbsp;ถึง&nbsp;28&nbsp;ตุลาคม&nbsp;2565</div>
						<div>RC&nbsp;Happy&nbsp;Weekend&nbsp;Open&nbsp;Now!&nbsp;on&nbsp;26,September&nbsp;to&nbsp;28,October&nbsp;2022</div>
					</div>
				</div>
			</div>
		</div>		
	</div>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php		break;
			case "ON":  ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$datetime="2023-06-01 24:00:00";//Time End
		$datetime_cr=date("Y-m-d H:i:s");
		$datatime_notrun=strtotime($datetime);
		$datatime_run=strtotime($datetime_cr);
//-----------------------------------------------------------------------
			if($datatime_run>=$datatime_notrun){
				$print_runtime="OFF";
			}else{
				$print_runtime="ON";
			}
//------------------------------------------------------------------------		
			switch($print_runtime){
				case "ON":	
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	include("view/database/pdo_quota.php");
	include("view/database/pdo_data.php");
	include("view/database/class_quota.php");
	
	include("view/database/pdo_weekend.php");
	include("view/database/class_weekend.php");
	
	//error_reporting(error_reporting() & ~E_NOTICE); 
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	$data_yaer=2566;
	$data_year_en=($data_yaer-543);
	$data_term=1;
	$user_login;
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	$call_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

	<div id="RuningLoad">	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="breadcrumb-line breadcrumb-line-component">
					<ul class="breadcrumb">
						<h4><span class="text-semibold">Open&nbsp;Now&nbsp;!&nbsp;RC&nbsp;Happy&nbsp;Weekend&nbsp;Class&nbsp;<?php echo $data_term."/".$data_year_en;?></span></h4>
					</ul>
					<ul class="breadcrumb-elements">
						<div class="heading-btn-group">
							<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>Home</span></a>
							<a class="btn btn-link text-size-small"><span>/</span></a>
							<a href="./?evaluation_mod=weekend_class" class="btn btn-link  text-size-small"><span>RC&nbsp;Happy&nbsp;Weekend&nbsp;Class</span></a>
						</div>
					</ul>
				</div>
			</div>
		</div><br>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php
		$rc=filter_input(INPUT_GET,'rc');
			if($rc=="e7fed1944be880f14a7335eac65e2cc2"){ ?>
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
							<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
							<span class="text-semibold">การลงทะเบียนสำเร็จ</span> 
						</div>					
					</div>			
				</div>
	<?php	}elseif($rc=="cb5e100e5a9a3e7f6d1fd97512215282"){ ?>
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="alert alert-warning alert-styled-left">
							<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
							<span class="text-semibold">พบข้อผิดพลาด</span>&nbsp;กรุณาลงทะเบียนใหม่อีกครั้ง
						</div>				
					</div>			
				</div>		
	<?php   }else{ }?>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<?php 
			$WeekendPrint=new WeekendSystem($call_stu->IDLevel);
			foreach($WeekendPrint->RunWeekendSystem() as $rc=>$WeekendPrintRow){
//Test Null
				if(isset($WeekendPrintRow["ws_key"])){
					$WsKey=$WeekendPrintRow["ws_key"];
				}else{
					$WsKey=null;
				}
				if(isset($WeekendPrintRow["ws_classA"])){
					$WsClassA=$WeekendPrintRow["ws_classA"];
				}else{
					$WsClassA=null;
				}
				if(isset($WeekendPrintRow["ws_classB"])){
					$WsClassB=$WeekendPrintRow["ws_classB"];
				}else{
					$WsClassB=null;
				}				
				if(isset($WeekendPrintRow["ws_test_time"])){
					$WsTestTime=$WeekendPrintRow["ws_test_time"];
				}else{
					$WsTestTime=null;
				}
				if(isset($WeekendPrintRow["ws_test_class"])){
					$WsTestClass=$WeekendPrintRow["ws_test_class"];
				}else{
					$WsTestClass=null;
				}
				if(isset($WeekendPrintRow["weekend_discount_wd_key"])){
					$WdKey=$WeekendPrintRow["weekend_discount_wd_key"];
				}else{
					$WdKey=null;
				}
//Test Null End				
				
			}
				if(isset($WsKey)){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($WsTestTime=="Y" and $WsTestClass=="N"){ ?>
<!--*********************************************************************-->

	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-teal">
				<div class="row">
					<div class="col-<?php echo $grid;?>-2">
						<div>วัตถุประสงค์</div>
					</div>
					<div class="col-<?php echo $grid;?>-10">
						<div>1.&nbsp;ส่งเสริมเวลาว่างอย่างมีประโยชน์</div>
						<div>2.&nbsp;เพิ่มศักยภาพผู้เรียนด้านวิชาการ</div>
						<div>3.&nbsp;ส่งเสริมทักษณะสมรรถนะที่จำเป็นอย่างมีประสิทธิภาพตามความถนัดและสนใจ</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<?php
		$TestWeekendClassRc=new PrintWeekendClassRc($user_login,$data_term,$data_yaer,'NotArray'); 
		foreach($TestWeekendClassRc->RunPrintWeekendClassRc() as $rc=>$TestWeekendClassRcRow){
//-------------------------------------------------------------------------------------------------------			
			if(isset($TestWeekendClassRcRow["wcr_learn"])){
				$TestWcrLearn=$TestWeekendClassRcRow["wcr_learn"];
			}else{
				$TestWcrLearn="-";
			}
//----------------------------------------------------------------------------------------------------------------			
			if($TestWcrLearn=="A"){ 
			
			}elseif($TestWcrLearn=="B"){ 
	
			}elseif($TestWcrLearn=="C"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-default">
				<div class="panel-heading">รายการลงทะเบียน</div>
				<div class="panel-body">
				
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th><div>ลำดับ</div></th>
											<th><div>รายการ</div></th>
											<th><div>เวลา</div></th>
											<th><div>ราคา</div></th>
											<th><div>&nbsp;</div></th>
										</tr>
									</thead>
									<tbody>
					<?php
							$CallWeekendDiscount=new WeekendDiscount("3");
							$SumPay=0;
							$CWCR_Count=1;
							$CallWeekendClassRc=new PrintWeekendClassRc($user_login,$data_term,$data_yaer,'Array2');
							foreach($CallWeekendClassRc->RunPrintWeekendClassRc() as $rc=>$CallWeekendClassRcRow){ 
							
							$CallWeekendClass=new DataWeekendClass($CallWeekendClassRcRow["weekend_class_wc_key"],$CallWeekendClassRcRow["wcr_t"],$CallWeekendClassRcRow["wcr_y"]);
							$CallWeekendClassTime=new DataWeekendClassTime($CallWeekendClassRcRow["weekend_class_time_wct_key"],$CallWeekendClassRcRow["wcr_t"],$CallWeekendClassRcRow["wcr_y"]);
							
							?>
										<tr>
											<td><div><?php echo $CWCR_Count;?></div></td>
											<td><div><?php echo $CallWeekendClass->wc_txt;?></div></td>
											<td><div><?php echo $CallWeekendClassTime->wct_timeA;?>&nbsp;น.&nbsp;ถึง&nbsp;<?php echo $CallWeekendClassTime->wct_timeB;?>&nbsp;น.</div></td>
											<td><div><?php echo number_format($CallWeekendClass->wc_pay, 2, '.', ',');?></div></td>
											<td><div><button type="button" id="Delete<?php echo $CWCR_Count;?>" class="btn btn-danger btn-xs">ยกเลิกการลงทะเบียน</button></div></td>
										</tr>		

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<script>
		$(document).ready(function (){
			$('#Delete<?php echo $CWCR_Count;?>').on('click', function() {
				var DeleteSudKey="<?php echo $user_login;?>";
				var DeleteWcTxt="<?php echo $CallWeekendClass->wc_txt;?>";
				var DeleteWcKey="<?php echo $CallWeekendClass->wc_key;?>";
				var DeleteWcT="<?php echo $data_term;?>";
				var DeleteWcY="<?php echo $data_yaer;?>";
				swal({
					title: "ต้องการยกเลิกรายวิชา / กิจกรรม ใช้หรือไม่",
					text: "<?php echo $CallWeekendClass->wc_txt;?>",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#EF5350",
					confirmButtonText: "ต้องการยกเลิก",
					cancelButtonText: "ไม่ต้องการยกเลิก",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						
						swal({
							title: "ดำเนินการยกเลิกรายวิชา / กิจกรรม!",
							//text: "Your imaginary file has been deleted.",
							confirmButtonColor: "#66BB6A",
							type: "success"
						},function(){
							$.post("<?php echo $golink;?>/Weekend_class/backspace",{
								DeleteSudKey:DeleteSudKey,
								DeleteWcTxt:DeleteWcTxt,
								DeleteWcKey:DeleteWcKey,
								DeleteWcT:DeleteWcT,
								DeleteWcY:DeleteWcY								
							},function(Deleteweekend){
								if(Deleteweekend !=""){
									document.location="<?php echo $golink;?>/?evaluation_mod=weekend_class"
								}else{}
							})
						});
						
					}else{
						swal({
							title: "ไม่ดำเนินการยกเลิกรายวิชา / กิจกรรม",
							//text: "",
							confirmButtonColor: "#2196F3",
							type: "error"
						});
					}
				});
			});
		})
	</script>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

										
					<?php	$SumPay=$SumPay+$CallWeekendClass->wc_pay;				
							$CWCR_Count=$CWCR_Count+1;
							} ?>	


<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
							<?php  
									$DataServePay=new PayServeWeekRc($user_login,$data_term,$data_yaer,$call_stu->IDLevel,'LIST','Loop');
									foreach($DataServePay->RunLoopPayServeWeek() as $rc=>$DataServePayRow){	
										$NameServe=new DataServeWeek($DataServePayRow["WSL_WS_No"]);
									?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<tr>
											<td><div><div><?php echo $CWCR_Count;?></div></div></td>
											<td><div><?php echo $NameServe->ReadDSWTxtTh();?></div></td>
											<td><div></div></td>
											<td><div><?php echo $DataServePayRow["WSL_WSP_Pay"];?></div></td>
											<td><div></div></td>
	
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
											<td></td>
											<td><div style="font-weight: bold; font-size: 18px; color:#FF0000;"><?php echo number_format($SumPay, 2, '.', ',');?></div></td>
											<th><div></div></th>
										</tr>
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
											<td>ส่วนสด&nbsp;-<?php echo number_format($CallWeekendDiscount->PrintWdDiscount(), 2, '.', ',');?></td>
											<td><div style="font-weight: bold; font-size: 18px; color:#FF0000;"><?php echo number_format($SumPay, 2, '.', ',');?></div></td>
											<td>&nbsp;</td>									
							
					<?php	}else{ ?>
							
											<td>&nbsp;</td>
											<td><div style="font-weight: bold; font-size: 18px; color:#FF0000;"><?php echo number_format($SumPay, 2, '.', ',');?></div></td>
											<td>&nbsp;</td>		
											
					<?php	} ?>						
											
					<?php ?>
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
								$txt_ref1=strtoupper($user_login."L".$class_ex."Y".$data_yaer);
								$txt_ref2=strtoupper("WEEKEND".$data_term."TY".$data_yaer);
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
	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
			<div class=" col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">RC Happy Weekend</div>
					<div class="panel-body">
					
				<?php
						$WC_CountC=20200;
						$CallWeekendA=new PrintWeekendA($call_stu->IDLevel,$data_yaer,$data_term,'ALL');
						foreach($CallWeekendA->RunPrintWeekendA() as $rc=>$CallWeekendARow){ ?>
						
							<div class="col-<?php echo $grid;?>-4" style="">
								<div class="panel panel-body border-top-pink">
									<div class="text-center"><?php echo $CallWeekendARow["wc_txt"];?></div>
									<ul>
										<li>ค่าลงทะเบียน&nbsp;<?php echo number_format($CallWeekendARow["wc_pay"], 2, '.', ',');?></li>
										<li>เวลาเรียน&nbsp;<?php echo $CallWeekendARow["wct_timeA"];?>&nbsp;ถึง&nbsp;<?php echo $CallWeekendARow["wct_timeB"];?></li>
										<li>จำนวน&nbsp;<?php echo $CallWeekendARow["wc_count"];?>&nbsp;คน</li>
									</ul>
					<?php
						$TestWeekendCount=new TestWeekendCountB($CallWeekendARow["wc_key"],$data_term,$data_yaer,$CallWeekendARow["wct_key"]);
							if($TestWeekendCount->RunTestWeekendCount()=="N"){ ?>
									<div class="text-center"><button type="button" id="<?php echo $WC_CountC;?>" class="btn btn-info" value="<?php echo $CallWeekendARow["wc_key"];?>">ลงทะเบียน&nbsp;คลิกที่นี้</button></div>
					<?php	}elseif($TestWeekendCount->RunTestWeekendCount()=="Y"){ ?>
									<div class="text-center"><button type="button" class="btn btn-danger disabled">เต็ม</button></div>
					<?php	}else{ 
								//-------------------------------------------------------------------------
							}
					?>											
									
									
									
								</div>
							</div>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<script>
		$(document).ready(function (){
			$('#<?php echo $WC_CountC;?>').on('click', function() {
				var WcKey="<?php echo $CallWeekendARow["wc_key"];?>";
				var WcTxt="<?php echo $CallWeekendARow["wc_txt"];?>";
				var WcT="<?php echo $data_term;?>";
				var WcY="<?php echo $data_yaer;?>";
				var WcSud="<?php echo $user_login;?>";
				var WcClass="<?php echo $call_stu->IDLevel;?>";
				var WctKey="<?php echo $CallWeekendARow["wct_key"];?>";
				var WctTimeA="<?php echo $CallWeekendARow["wct_timeA"];?>";
				var WctTimeB="<?php echo $CallWeekendARow["wct_timeB"];?>";
				var WcrLearn="C";
				swal({
					title: "<?php echo $CallWeekendARow["wc_txt"];?>",
					text: "เวลาเรียน <?php echo $CallWeekendARow["wct_timeA"];?> ถึง <?php echo $CallWeekendARow["wct_timeB"];?> ค่าลงทะเบียน <?php echo $CallWeekendARow["wc_pay"];?> บาท",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#EF5350",
					confirmButtonText: "ต้องการลงทะเบียน",
					cancelButtonText: "ไม่ต้องการลงทะเบียน",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						swal({
							title: "ลงทะเบียน!",
							//text: "Your imaginary file has been deleted.",
							confirmButtonColor: "#66BB6A",
							type: "success"
						},function(){
							$.post("<?php echo $golink;?>/Weekend_class",{
								WcKey:WcKey,
								WcTxt:WcTxt,
								WcT:WcT,
								WcY:WcY,
								WcSud:WcSud,
								WcClass:WcClass,
								WctKey:WctKey,
								WctTimeA:WctTimeA,
								WctTimeB:WctTimeB,
								WcrLearn:WcrLearn
							},function(weekend){
								if(weekend !=""){
									$("#RunWeekendClass").html(weekend)
								}else{}
							})
						});
					}
					else {
						swal({
							title: "ไม่ลงทะเบียน",
							//text: "",
							confirmButtonColor: "#2196F3",
							type: "error"
						});
					}
				});
			});
		})
	</script>							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
				<?php	$WC_CountC=$WC_CountC+1;
						} ?>						
					
		
					</div>
				</div>
			</div>
		</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<div id="RunWeekendClass"></div>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-12">
		    <div class="panel panel-info">
				<div class="panel-heading">รายการค่าบริการเสริม...</div>
				<div class="panel-body">
					<div class="row">
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$PrintWeekendServe=new WeekendServeLoop('1','00','00');
		$PWS_Count=1111;
		foreach($PrintWeekendServe->RunWeekendServeLoop() as $rc=>$PrintWeekendServeRow){
			$LeveLA=$PrintWeekendServeRow["WS_CA"];
			$LeveLB=$PrintWeekendServeRow["WS_CB"];
				if($call_stu->IDLevel>=$LeveLA and $call_stu->IDLevel<=$LeveLB){ 
					$TestUserServe=new PayServeWeekRc($user_login,$data_term,$data_yaer,$call_stu->IDLevel,$PrintWeekendServeRow["WS_No"],"-");
						if($TestUserServe->RunCountServePay()>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div class="col-<?php echo $grid;?>-3">
							<div class="panel panel-body bg-danger-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin"><?php echo $PrintWeekendServeRow["WS_Pay"];?></h3>
										<span class="text-uppercase text-size-mini"><?php echo $PrintWeekendServeRow["WS_TxtTh"];?></span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-cart icon-3x opacity-75"></i>
									</div>
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<center><button type="button" name="ServeDelete" id="ServeDelete<?php echo $PWS_Count;?>" class="btn btn-success">ยกเลิก</button></center>
										</div>
									</div>									
								</div>
							</div>
						</div>								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<script>
		$(document).ready(function (){
			$('#ServeDelete<?php echo $PWS_Count;?>').on('click', function() {
				var WS_TxtTh="<?php echo $PrintWeekendServeRow["WS_TxtTh"];?>";
				var WS_Pay="<?php echo $PrintWeekendServeRow["WS_Pay"];?>";
				var WS_Key="<?php echo $user_login;?>";
				var WS_T="<?php echo $data_term;?>";
				var WS_Y="<?php echo $data_yaer;?>";
				var WS_C="<?php echo $call_stu->IDLevel;?>";
				var WS_No="<?php echo $PrintWeekendServeRow["WS_No"];?>";
				var WS_System="DeleteNO";
				
				swal({
					title: WS_TxtTh,
					text: "ต้องการยกเลิกรายการนี้ใช้ไหม",
					type: "info",
					showCancelButton: true,
					closeOnConfirm: false,
					confirmButtonColor: "#2196F3",
					showLoaderOnConfirm: true
				},
				function() {
					setTimeout(function() {
						swal({
							title: "ดำเนินรายการสำเร็จ",
							confirmButtonColor: "#2196F3"
						},function(){
							if(WS_TxtTh!="" && WS_Pay!="" && WS_Key!="" && WS_T!="" && WS_Y!="" && WS_C!="" && WS_No!="" && WS_System!=""){
								$.post("<?php echo $golink;?>/Weekend_class/weekend_serve",{
									WS_TxtTh:WS_TxtTh,
									WS_Pay:WS_Pay,
									WS_Key:WS_Key,
									WS_T:WS_T,
									WS_Y:WS_Y,
									WS_C:WS_C,
									WS_No:WS_No,
									WS_System:WS_System
								},function(run_ws){
									if(run_ws!=""){
										$("#RunServe").html(run_ws)
									}else{}
								})
							}else{}
						});
					}, 2000);
				});
			});		
		})
	</script>							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div id="RunServe"></div>								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
				<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div class="col-<?php echo $grid;?>-3">
							<div class="panel panel-body bg-blue-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin"><?php echo $PrintWeekendServeRow["WS_Pay"];?></h3>
										<span class="text-uppercase text-size-mini"><?php echo $PrintWeekendServeRow["WS_TxtTh"];?></span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-cart icon-3x opacity-75"></i>
									</div>
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<center><button type="button" name="ServeAdd" id="ServeAdd<?php echo $PWS_Count;?>" class="btn btn-success">คลิก</button></center>
										</div>
									</div>
								</div>
							</div>
						</div>								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<script>
		$(document).ready(function (){
			$('#ServeAdd<?php echo $PWS_Count;?>').on('click', function() {
				var WS_TxtTh="<?php echo $PrintWeekendServeRow["WS_TxtTh"];?>";
				var WS_Pay="<?php echo $PrintWeekendServeRow["WS_Pay"];?>";
				var WS_Key="<?php echo $user_login;?>";
				var WS_T="<?php echo $data_term;?>";
				var WS_Y="<?php echo $data_yaer;?>";
				var WS_C="<?php echo $call_stu->IDLevel;?>";
				var WS_No="<?php echo $PrintWeekendServeRow["WS_No"];?>";
				var WS_System="Add";
				swal({
					title: WS_TxtTh,
					text: "ต้องเพิ่มรายการนี้ใช้ไหม",
					type: "info",
					showCancelButton: true,
					closeOnConfirm: false,
					confirmButtonColor: "#2196F3",
					showLoaderOnConfirm: true
				},
				function() {
					setTimeout(function() {
						swal({
							title: "ดำเนินรายการสำเร็จ",
							confirmButtonColor: "#2196F3"
						},function(){
							if(WS_TxtTh!="" && WS_Pay!="" && WS_Key!="" && WS_T!="" && WS_Y!="" && WS_C!="" && WS_No!="" && WS_System!=""){
								$.post("<?php echo $golink;?>/Weekend_class/weekend_serve",{
									WS_TxtTh:WS_TxtTh,
									WS_Pay:WS_Pay,
									WS_Key:WS_Key,
									WS_T:WS_T,
									WS_Y:WS_Y,
									WS_C:WS_C,
									WS_No:WS_No,
									WS_System:WS_System
								},function(run_ws){
									if(run_ws!=""){
										$("#RunServe").html(run_ws)
									}else{}
								})
							}else{}
						});
					}, 2000);
				});
			});		
		})
	</script>								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div id="RunServe"></div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
				<?php	}
				}else{}
			$PWS_Count=$PWS_Count+1;	
		}
	?>
					</div>
				</div>
			</div>
		</div>	
	</div>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-4">&nbsp;</div>
		<div class="col-<?php echo $grid;?>-4">
			<a href="<?php echo $golink;?>/weekend_class/print_weekend/<?php echo $data_term;?>/<?php echo $data_yaer;?>/<?php echo $user_login;?>" target="_blank"><div class="panel panel-body bg-blue-400 has-bg-image">
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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
	<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$DeleteAllServe=new AddDeleteUserServeWeek($user_login,$data_yaer,$data_term,$call_stu->IDLevel,'Delete','Delete','Delete');
	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
			<div class=" col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">RC Happy Weekend</div>
					<div class="panel-body">
					
				<?php
						$WC_CountC=20200;
						$CallWeekendA=new PrintWeekendA($call_stu->IDLevel,$data_yaer,$data_term,'ALL');
						foreach($CallWeekendA->RunPrintWeekendA() as $rc=>$CallWeekendARow){ ?>
						
							<div class="col-<?php echo $grid;?>-4" style="font-family: surafont_sanukchang; font-size: 14px;">
								<div class="panel panel-body border-top-pink">
									<div class="text-center"><?php echo $CallWeekendARow["wc_txt"];?></div>
									<ul>
										<li>ค่าลงทะเบียน&nbsp;<?php echo number_format($CallWeekendARow["wc_pay"], 2, '.', ',');?></li>
										<li>เวลาเรียน&nbsp;<?php echo $CallWeekendARow["wct_timeA"];?>&nbsp;ถึง&nbsp;<?php echo $CallWeekendARow["wct_timeB"];?></li>
										<li>จำนวน&nbsp;<?php echo $CallWeekendARow["wc_count"];?>&nbsp;คน</li>
									</ul>
					<?php
						$TestWeekendCount=new TestWeekendCountB($CallWeekendARow["wc_key"],$data_term,$data_yaer,$CallWeekendARow["wct_key"]);
							if($TestWeekendCount->RunTestWeekendCount()=="N"){ ?>
									<div class="text-center"><button type="button" id="<?php echo $WC_CountC;?>" class="btn btn-info" value="<?php echo $CallWeekendARow["wc_key"];?>">ลงทะเบียน&nbsp;คลิกที่นี้</button></div>
					<?php	}elseif($TestWeekendCount->RunTestWeekendCount()=="Y"){ ?>
									<div class="text-center"><button type="button" class="btn btn-danger disabled">เต็ม</button></div>
					<?php	}else{ 
								//-------------------------------------------------------------------------
							}
					?>											
									
									
									
								</div>
							</div>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<script>
		$(document).ready(function (){
			$('#<?php echo $WC_CountC;?>').on('click', function() {
				var WcKey="<?php echo $CallWeekendARow["wc_key"];?>";
				var WcTxt="<?php echo $CallWeekendARow["wc_txt"];?>";
				var WcT="<?php echo $data_term;?>";
				var WcY="<?php echo $data_yaer;?>";
				var WcSud="<?php echo $user_login;?>";
				var WcClass="<?php echo $call_stu->IDLevel;?>";
				var WctKey="<?php echo $CallWeekendARow["wct_key"];?>";
				var WctTimeA="<?php echo $CallWeekendARow["wct_timeA"];?>";
				var WctTimeB="<?php echo $CallWeekendARow["wct_timeB"];?>";
				var WcrLearn="C";
				swal({
					title: "<?php echo $CallWeekendARow["wc_txt"];?>",
					text: "เวลาเรียน <?php echo $CallWeekendARow["wct_timeA"];?> ถึง <?php echo $CallWeekendARow["wct_timeB"];?> ค่าลงทะเบียน <?php echo $CallWeekendARow["wc_pay"];?> บาท",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#EF5350",
					confirmButtonText: "ต้องการลงทะเบียน",
					cancelButtonText: "ไม่ต้องการลงทะเบียน",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						swal({
							title: "ลงทะเบียน!",
							//text: "Your imaginary file has been deleted.",
							confirmButtonColor: "#66BB6A",
							type: "success"
						},function(){
							$.post("<?php echo $golink;?>/Weekend_class",{
								WcKey:WcKey,
								WcTxt:WcTxt,
								WcT:WcT,
								WcY:WcY,
								WcSud:WcSud,
								WcClass:WcClass,
								WctKey:WctKey,
								WctTimeA:WctTimeA,
								WctTimeB:WctTimeB,
								WcrLearn:WcrLearn
							},function(weekend){
								if(weekend !=""){
									$("#RunWeekendClass").html(weekend)
								}else{}
							})
						});
					}
					else {
						swal({
							title: "ไม่ลงทะเบียน",
							//text: "",
							confirmButtonColor: "#2196F3",
							type: "error"
						});
					}
				});
			});
		})
	</script>							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
				<?php	$WC_CountC=$WC_CountC+1;
						} ?>						
					
		
					</div>
				</div>
			</div>
		</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<div id="RunWeekendClass"></div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} 
		}
	?> 
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--*********************************************************************-->					
			<?php	}elseif($WsTestTime=="N" and $WsTestClass=="Y"){ ?>
<!--*********************************************************************-->
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-teal">
				<div class="row">
					<div class="col-<?php echo $grid;?>-2">
						<div>วัตถุประสงค์</div>
					</div>
					<div class="col-<?php echo $grid;?>-10">
						<div>1.&nbsp;ส่งเสริมเวลาว่างอย่างมีประโยชน์</div>
						<div>2.&nbsp;เพิ่มศักยภาพผู้เรียนด้านวิชาการ</div>
						<div>3.&nbsp;ส่งเสริมทักษณะสมรรถนะที่จำเป็นอย่างมีประสิทธิภาพตามความถนัดและสนใจ</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php
		$TestWeekendClassRc=new PrintWeekendClassRc($user_login,$data_term,$data_yaer,'NotArray'); 
		foreach($TestWeekendClassRc->RunPrintWeekendClassRc() as $rc=>$TestWeekendClassRcRow){
//-------------------------------------------------------------------------------------------------------			
			if(isset($TestWeekendClassRcRow["wcr_learn"])){
				$TestWcrLearn=$TestWeekendClassRcRow["wcr_learn"];
			}else{
				$TestWcrLearn="-";
			}
//----------------------------------------------------------------------------------------------------------------			
			if($TestWcrLearn=="A"){ ?><!--4 วิชาหลัก + 1กิจกรรม-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-default">
				<div class="panel-heading">รายการลงทะเบียน</div>
				<div class="panel-body">
				
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th><div>ลำดับ</div></th>
											<th><div>รายการ</div></th>
											<th><div>เวลา</div></th>
											<th><div>ราคา</div></th>
											<th><div>&nbsp;</div></th>
										</tr>
									</thead>
									<tbody>
					<?php
							$CallWeekendDiscount=new WeekendDiscount("2");
							$SumPay=0;
							$CWCR_Count=1;
							$CallWeekendClassRc=new PrintWeekendClassRc($user_login,$data_term,$data_yaer,'Array');
							foreach($CallWeekendClassRc->RunPrintWeekendClassRc() as $rc=>$CallWeekendClassRcRow){ ?>
										<tr>
											<td><div><?php echo $CWCR_Count;?></div></td>
											<td><div><?php echo $CallWeekendClassRcRow["wc_txt"];?></div></td>
											<td><div><?php echo $CallWeekendClassRcRow["wct_timeA"];?>&nbsp;น.&nbsp;ถึง&nbsp;<?php echo $CallWeekendClassRcRow["wct_timeB"];?>&nbsp;น.</div></td>
											<td><div><?php echo number_format($CallWeekendClassRcRow["wc_pay"], 2, '.', ',');?></div></td>
											
						<?php
								if($CallWeekendClassRcRow["weekend_class_type_wt_on"]==1){ ?>
											<td><div>&nbsp;</div></td>
						<?php	}else{ ?>
											<td><div><button type="button" id="Delete<?php echo $CWCR_Count;?>" class="btn btn-danger btn-xs">ยกเลิกการลงทะเบียน</button></div></td>								
						<?php	}	?>					
											

										</tr>			

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<script>
		$(document).ready(function (){
			$('#Delete<?php echo $CWCR_Count;?>').on('click', function() {
				var DeleteSudKey="<?php echo $user_login;?>";
				var DeleteWcTxt="<?php echo $CallWeekendClassRcRow["wc_txt"];?>";
				var DeleteWcKey="<?php echo $CallWeekendClassRcRow["wc_key"];?>";
				var DeleteWcT="<?php echo $data_term;?>";
				var DeleteWcY="<?php echo $data_yaer;?>";
				var DeleteLearn="A";
				swal({
					title: "ต้องการยกเลิกรายวิชา / กิจกรรม ใช้หรือไม่",
					text: "<?php echo $CallWeekendClassRcRow["wc_txt"];?>",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#EF5350",
					confirmButtonText: "ต้องการยกเลิก",
					cancelButtonText: "ไม่ต้องการยกเลิก",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						
						swal({
							title: "ดำเนินการยกเลิกรายวิชา / กิจกรรม!",
							//text: "Your imaginary file has been deleted.",
							confirmButtonColor: "#66BB6A",
							type: "success"
						},function(){
							$.post("<?php echo $golink;?>/Weekend_class/backspace",{
								DeleteSudKey:DeleteSudKey,
								DeleteWcTxt:DeleteWcTxt,
								DeleteWcKey:DeleteWcKey,
								DeleteWcT:DeleteWcT,
								DeleteWcY:DeleteWcY,
								DeleteLearn:DeleteLearn
							},function(Deleteweekend){
								if(Deleteweekend !=""){
									document.location="<?php echo $golink;?>/?evaluation_mod=weekend_class"
								}else{}
							})
						});
						
					}else{
						swal({
							title: "ไม่ดำเนินการยกเลิกรายวิชา / กิจกรรม",
							//text: "",
							confirmButtonColor: "#2196F3",
							type: "error"
						});
					}
				});
			});
		})
	</script>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										
					<?php	$SumPay=$SumPay+$CallWeekendClassRcRow["wc_pay"];
							$CWCR_Count=$CWCR_Count+1;} ?>
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
							<?php  
									$DataServePay=new PayServeWeekRc($user_login,$data_term,$data_yaer,$call_stu->IDLevel,'LIST','Loop');
									foreach($DataServePay->RunLoopPayServeWeek() as $rc=>$DataServePayRow){	
										$NameServe=new DataServeWeek($DataServePayRow["WSL_WS_No"]);
									?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<tr>
											<td><div><div><?php echo $CWCR_Count;?></div></div></td>
											<td><div><?php echo $NameServe->ReadDSWTxtTh();?></div></td>
											<td><div></div></td>
											<td><div><?php echo number_format($DataServePayRow["WSL_WSP_Pay"], 2, '.', ',');?></div></td>
											<td><div></div></td>
	
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
											<td><div><?php echo $CallWeekendDiscount->PrintWdDiscount();?></div></td>
											<td><div></div></td>
										</tr>
										<tr>
											<td><div></div></td>
											<td><div></div></td>
											<td><div></div></td>
											<td><div style="font-weight: bold; font-size: 18px; color:#FF0000;"><?php echo number_format($SumPay, 2, '.', ',');?></div></td>
											<td><div></div></td>
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
								$txt_ref1=strtoupper($user_login."L".$class_ex."Y".$data_yaer);
								$txt_ref2=strtoupper("WEEKEND".$data_term."TY".$data_yaer);
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
	</div><hr>	
	
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-12">
		    <div class="panel panel-info">
				<div class="panel-heading">รายการค่าบริการเสริม...</div>
				<div class="panel-body">
					<div class="row">
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$PrintWeekendServe=new WeekendServeLoop('1','00','00');
		$PWS_Count=1111;
		foreach($PrintWeekendServe->RunWeekendServeLoop() as $rc=>$PrintWeekendServeRow){
			$LeveLA=$PrintWeekendServeRow["WS_CA"];
			$LeveLB=$PrintWeekendServeRow["WS_CB"];
				if($call_stu->IDLevel>=$LeveLA and $call_stu->IDLevel<=$LeveLB){ 
					$TestUserServe=new PayServeWeekRc($user_login,$data_term,$data_yaer,$call_stu->IDLevel,$PrintWeekendServeRow["WS_No"],"-");
						if($TestUserServe->RunCountServePay()>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div class="col-<?php echo $grid;?>-3">
							<div class="panel panel-body bg-danger-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin"><?php echo $PrintWeekendServeRow["WS_Pay"];?></h3>
										<span class="text-uppercase text-size-mini"><?php echo $PrintWeekendServeRow["WS_TxtTh"];?></span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-cart icon-3x opacity-75"></i>
									</div>
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<center><button type="button" name="ServeDelete" id="ServeDelete<?php echo $PWS_Count;?>" class="btn btn-success">ยกเลิก</button></center>
										</div>
									</div>									
								</div>
							</div>
						</div>								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<script>
		$(document).ready(function (){
			$('#ServeDelete<?php echo $PWS_Count;?>').on('click', function() {
				var WS_TxtTh="<?php echo $PrintWeekendServeRow["WS_TxtTh"];?>";
				var WS_Pay="<?php echo $PrintWeekendServeRow["WS_Pay"];?>";
				var WS_Key="<?php echo $user_login;?>";
				var WS_T="<?php echo $data_term;?>";
				var WS_Y="<?php echo $data_yaer;?>";
				var WS_C="<?php echo $call_stu->IDLevel;?>";
				var WS_No="<?php echo $PrintWeekendServeRow["WS_No"];?>";
				var WS_System="DeleteNO";
				
				swal({
					title: WS_TxtTh,
					text: "ต้องการยกเลิกรายการนี้ใช้ไหม",
					type: "info",
					showCancelButton: true,
					closeOnConfirm: false,
					confirmButtonColor: "#2196F3",
					showLoaderOnConfirm: true
				},
				function() {
					setTimeout(function() {
						swal({
							title: "ดำเนินรายการสำเร็จ",
							confirmButtonColor: "#2196F3"
						},function(){
							if(WS_TxtTh!="" && WS_Pay!="" && WS_Key!="" && WS_T!="" && WS_Y!="" && WS_C!="" && WS_No!="" && WS_System!=""){
								$.post("<?php echo $golink;?>/Weekend_class/weekend_serve",{
									WS_TxtTh:WS_TxtTh,
									WS_Pay:WS_Pay,
									WS_Key:WS_Key,
									WS_T:WS_T,
									WS_Y:WS_Y,
									WS_C:WS_C,
									WS_No:WS_No,
									WS_System:WS_System
								},function(run_ws){
									if(run_ws!=""){
										$("#RunServe").html(run_ws)
									}else{}
								})
							}else{}
						});
					}, 2000);
				});
			});		
		})
	</script>							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div id="RunServe"></div>								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
				<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div class="col-<?php echo $grid;?>-3">
							<div class="panel panel-body bg-blue-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin"><?php echo $PrintWeekendServeRow["WS_Pay"];?></h3>
										<span class="text-uppercase text-size-mini"><?php echo $PrintWeekendServeRow["WS_TxtTh"];?></span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-cart icon-3x opacity-75"></i>
									</div>
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<center><button type="button" name="ServeAdd" id="ServeAdd<?php echo $PWS_Count;?>" class="btn btn-success">คลิก</button></center>
										</div>
									</div>
								</div>
							</div>
						</div>								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<script>
		$(document).ready(function (){
			$('#ServeAdd<?php echo $PWS_Count;?>').on('click', function() {
				var WS_TxtTh="<?php echo $PrintWeekendServeRow["WS_TxtTh"];?>";
				var WS_Pay="<?php echo $PrintWeekendServeRow["WS_Pay"];?>";
				var WS_Key="<?php echo $user_login;?>";
				var WS_T="<?php echo $data_term;?>";
				var WS_Y="<?php echo $data_yaer;?>";
				var WS_C="<?php echo $call_stu->IDLevel;?>";
				var WS_No="<?php echo $PrintWeekendServeRow["WS_No"];?>";
				var WS_System="Add";
				swal({
					title: WS_TxtTh,
					text: "ต้องเพิ่มรายการนี้ใช้ไหม",
					type: "info",
					showCancelButton: true,
					closeOnConfirm: false,
					confirmButtonColor: "#2196F3",
					showLoaderOnConfirm: true
				},
				function() {
					setTimeout(function() {
						swal({
							title: "ดำเนินรายการสำเร็จ",
							confirmButtonColor: "#2196F3"
						},function(){
							if(WS_TxtTh!="" && WS_Pay!="" && WS_Key!="" && WS_T!="" && WS_Y!="" && WS_C!="" && WS_No!="" && WS_System!=""){
								$.post("<?php echo $golink;?>/Weekend_class/weekend_serve",{
									WS_TxtTh:WS_TxtTh,
									WS_Pay:WS_Pay,
									WS_Key:WS_Key,
									WS_T:WS_T,
									WS_Y:WS_Y,
									WS_C:WS_C,
									WS_No:WS_No,
									WS_System:WS_System
								},function(run_ws){
									if(run_ws!=""){
										$("#RunServe").html(run_ws)
									}else{}
								})
							}else{}
						});
					}, 2000);
				});
			});		
		})
	</script>								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div id="RunServe"></div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
				<?php	}
				}else{}
			$PWS_Count=$PWS_Count+1;	
		}
	?>
					</div>
				</div>
			</div>
		</div>	
	</div>	
	
	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-4">&nbsp;</div>
		<div class="col-<?php echo $grid;?>-4">
			<a href="<?php echo $golink;?>/weekend_class/print_weekend/<?php echo $data_term;?>/<?php echo $data_yaer;?>/<?php echo $user_login;?>" target="_blank"><div class="panel panel-body bg-blue-400 has-bg-image">
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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
	<?php	}elseif($TestWcrLearn=="B"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-default">
				<div class="panel-heading">รายการลงทะเบียน</div>
				<div class="panel-body">
				
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th><div>ลำดับ</div></th>
											<th><div>รายการ</div></th>
											<th><div>เวลา</div></th>
											<th><div>ราคา</div></th>
											<th><div></div></th>
										</tr>
									</thead>
									<tbody>
					<?php
							$SumPay=0;
							$CWCR_Count=1;
							$CallWeekendClassRc=new PrintWeekendClassRc($user_login,$data_term,$data_yaer,'Array');
							foreach($CallWeekendClassRc->RunPrintWeekendClassRc() as $rc=>$CallWeekendClassRcRow){ ?>
										<tr>
											<td><div><?php echo $CWCR_Count;?></div></td>
											<td><div><?php echo $CallWeekendClassRcRow["wc_txt"];?></div></td>
											<td><div><?php echo $CallWeekendClassRcRow["wct_timeA"];?>&nbsp;น.&nbsp;ถึง&nbsp;<?php echo $CallWeekendClassRcRow["wct_timeB"];?>&nbsp;น.</div></td>
											<td><div><?php echo number_format($CallWeekendClassRcRow["wc_pay"], 2, '.', ',');?></div></td>
											<td><div><button type="button" id="Delete<?php echo $CWCR_Count;?>" class="btn btn-danger btn-xs">ยกเลิกการลงทะเบียน</button></div></td>
										</tr>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<script>
		$(document).ready(function (){
			$('#Delete<?php echo $CWCR_Count;?>').on('click', function() {
				var DeleteSudKey="<?php echo $user_login;?>";
				var DeleteWcTxt="<?php echo $CallWeekendClassRcRow["wc_txt"];?>";
				var DeleteWcKey="<?php echo $CallWeekendClassRcRow["wc_key"];?>";
				var DeleteWcT="<?php echo $data_term;?>";
				var DeleteWcY="<?php echo $data_yaer;?>";
				swal({
					title: "ต้องการยกเลิกรายวิชา / กิจกรรม ใช้หรือไม่",
					text: "<?php echo $CallWeekendClassRcRow["wc_txt"];?>",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#EF5350",
					confirmButtonText: "ต้องการยกเลิก",
					cancelButtonText: "ไม่ต้องการยกเลิก",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						
						swal({
							title: "ดำเนินการยกเลิกรายวิชา / กิจกรรม!",
							//text: "Your imaginary file has been deleted.",
							confirmButtonColor: "#66BB6A",
							type: "success"
						},function(){
							$.post("<?php echo $golink;?>/Weekend_class/backspace",{
								DeleteSudKey:DeleteSudKey,
								DeleteWcTxt:DeleteWcTxt,
								DeleteWcKey:DeleteWcKey,
								DeleteWcT:DeleteWcT,
								DeleteWcY:DeleteWcY								
							},function(Deleteweekend){
								if(Deleteweekend !=""){
									document.location="<?php echo $golink;?>/?evaluation_mod=weekend_class"
								}else{}
							})
						});
						
					}else{
						swal({
							title: "ไม่ดำเนินการยกเลิกรายวิชา / กิจกรรม",
							//text: "",
							confirmButtonColor: "#2196F3",
							type: "error"
						});
					}
				});
			});
		})
	</script>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
					<?php	$SumPay=$SumPay+$CallWeekendClassRcRow["wc_pay"];
							$CWCR_Count=$CWCR_Count+1;
							} ?>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
							<?php  
									$DataServePay=new PayServeWeekRc($user_login,$data_term,$data_yaer,$call_stu->IDLevel,'LIST','Loop');
									foreach($DataServePay->RunLoopPayServeWeek() as $rc=>$DataServePayRow){	
										$NameServe=new DataServeWeek($DataServePayRow["WSL_WS_No"]);
									?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										<tr>
											<td><div><div><?php echo $CWCR_Count;?></div></div></td>
											<td><div><?php echo $NameServe->ReadDSWTxtTh();?></div></td>
											<td><div></div></td>
											<td><div><?php echo number_format($DataServePayRow["WSL_WSP_Pay"], 2, '.', ',');?></div></td>
											<td><div></div></td>
	
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
											<td></td>
											<td><div style="font-weight: bold; font-size: 18px; color:#FF0000;"><?php echo number_format($SumPay, 2, '.', ',');?></div></td>
											<th><div></div></th>
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
								$txt_ref1=strtoupper($user_login."L".$class_ex."Y".$data_yaer);
								$txt_ref2=strtoupper("WEEKEND".$data_term."TY".$data_yaer);
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
	</div><hr>	
	
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-12">
		    <div class="panel panel-info">
				<div class="panel-heading">รายการค่าบริการเสริม...</div>
				<div class="panel-body">
					<div class="row">
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$PrintWeekendServe=new WeekendServeLoop('1','00','00');
		$PWS_Count=1111;
		foreach($PrintWeekendServe->RunWeekendServeLoop() as $rc=>$PrintWeekendServeRow){
			$LeveLA=$PrintWeekendServeRow["WS_CA"];
			$LeveLB=$PrintWeekendServeRow["WS_CB"];
				if($call_stu->IDLevel>=$LeveLA and $call_stu->IDLevel<=$LeveLB){ 
					$TestUserServe=new PayServeWeekRc($user_login,$data_term,$data_yaer,$call_stu->IDLevel,$PrintWeekendServeRow["WS_No"],"-");
						if($TestUserServe->RunCountServePay()>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div class="col-<?php echo $grid;?>-3">
							<div class="panel panel-body bg-danger-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin"><?php echo $PrintWeekendServeRow["WS_Pay"];?></h3>
										<span class="text-uppercase text-size-mini"><?php echo $PrintWeekendServeRow["WS_TxtTh"];?></span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-cart icon-3x opacity-75"></i>
									</div>
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<center><button type="button" name="ServeDelete" id="ServeDelete<?php echo $PWS_Count;?>" class="btn btn-success">ยกเลิก</button></center>
										</div>
									</div>									
								</div>
							</div>
						</div>								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<script>
		$(document).ready(function (){
			$('#ServeDelete<?php echo $PWS_Count;?>').on('click', function() {
				var WS_TxtTh="<?php echo $PrintWeekendServeRow["WS_TxtTh"];?>";
				var WS_Pay="<?php echo $PrintWeekendServeRow["WS_Pay"];?>";
				var WS_Key="<?php echo $user_login;?>";
				var WS_T="<?php echo $data_term;?>";
				var WS_Y="<?php echo $data_yaer;?>";
				var WS_C="<?php echo $call_stu->IDLevel;?>";
				var WS_No="<?php echo $PrintWeekendServeRow["WS_No"];?>";
				var WS_System="DeleteNO";
				
				swal({
					title: WS_TxtTh,
					text: "ต้องการยกเลิกรายการนี้ใช้ไหม",
					type: "info",
					showCancelButton: true,
					closeOnConfirm: false,
					confirmButtonColor: "#2196F3",
					showLoaderOnConfirm: true
				},
				function() {
					setTimeout(function() {
						swal({
							title: "ดำเนินรายการสำเร็จ",
							confirmButtonColor: "#2196F3"
						},function(){
							if(WS_TxtTh!="" && WS_Pay!="" && WS_Key!="" && WS_T!="" && WS_Y!="" && WS_C!="" && WS_No!="" && WS_System!=""){
								$.post("<?php echo $golink;?>/Weekend_class/weekend_serve",{
									WS_TxtTh:WS_TxtTh,
									WS_Pay:WS_Pay,
									WS_Key:WS_Key,
									WS_T:WS_T,
									WS_Y:WS_Y,
									WS_C:WS_C,
									WS_No:WS_No,
									WS_System:WS_System
								},function(run_ws){
									if(run_ws!=""){
										$("#RunServe").html(run_ws)
									}else{}
								})
							}else{}
						});
					}, 2000);
				});
			});		
		})
	</script>							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div id="RunServe"></div>								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
				<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div class="col-<?php echo $grid;?>-3">
							<div class="panel panel-body bg-blue-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin"><?php echo $PrintWeekendServeRow["WS_Pay"];?></h3>
										<span class="text-uppercase text-size-mini"><?php echo $PrintWeekendServeRow["WS_TxtTh"];?></span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-cart icon-3x opacity-75"></i>
									</div>
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<center><button type="button" name="ServeAdd" id="ServeAdd<?php echo $PWS_Count;?>" class="btn btn-success">คลิก</button></center>
										</div>
									</div>
								</div>
							</div>
						</div>								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<script>
		$(document).ready(function (){
			$('#ServeAdd<?php echo $PWS_Count;?>').on('click', function() {
				var WS_TxtTh="<?php echo $PrintWeekendServeRow["WS_TxtTh"];?>";
				var WS_Pay="<?php echo $PrintWeekendServeRow["WS_Pay"];?>";
				var WS_Key="<?php echo $user_login;?>";
				var WS_T="<?php echo $data_term;?>";
				var WS_Y="<?php echo $data_yaer;?>";
				var WS_C="<?php echo $call_stu->IDLevel;?>";
				var WS_No="<?php echo $PrintWeekendServeRow["WS_No"];?>";
				var WS_System="Add";
				swal({
					title: WS_TxtTh,
					text: "ต้องเพิ่มรายการนี้ใช้ไหม",
					type: "info",
					showCancelButton: true,
					closeOnConfirm: false,
					confirmButtonColor: "#2196F3",
					showLoaderOnConfirm: true
				},
				function() {
					setTimeout(function() {
						swal({
							title: "ดำเนินรายการสำเร็จ",
							confirmButtonColor: "#2196F3"
						},function(){
							if(WS_TxtTh!="" && WS_Pay!="" && WS_Key!="" && WS_T!="" && WS_Y!="" && WS_C!="" && WS_No!="" && WS_System!=""){
								$.post("<?php echo $golink;?>/Weekend_class/weekend_serve",{
									WS_TxtTh:WS_TxtTh,
									WS_Pay:WS_Pay,
									WS_Key:WS_Key,
									WS_T:WS_T,
									WS_Y:WS_Y,
									WS_C:WS_C,
									WS_No:WS_No,
									WS_System:WS_System
								},function(run_ws){
									if(run_ws!=""){
										$("#RunServe").html(run_ws)
									}else{}
								})
							}else{}
						});
					}, 2000);
				});
			});		
		})
	</script>								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div id="RunServe"></div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
				<?php	}
				}else{}
			$PWS_Count=$PWS_Count+1;	
		}
	?>
					</div>
				</div>
			</div>
		</div>	
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-4">&nbsp;</div>
		<div class="col-<?php echo $grid;?>-4">
			<a href="<?php echo $golink;?>/weekend_class/print_weekend/<?php echo $data_term;?>/<?php echo $data_yaer;?>/<?php echo $user_login;?>" target="_blank"><div class="panel panel-body bg-blue-400 has-bg-image">
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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
	<?php	}elseif($TestWcrLearn=="C"){
					
			}else{ ?> 
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$DeleteAllServe=new AddDeleteUserServeWeek($user_login,$data_yaer,$data_term,$call_stu->IDLevel,'Delete','Delete','Delete');
	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-12">
			<div class="container">                 
				<ul class="pager">
					<li><a data-toggle="tab" href="#weekend_A">เลือกเรียนทั้งวัน</a></li>
					<li><a data-toggle="tab" href="#weekend_B">เลือกเรียนครึ่งวัน</a></li>
				</ul>
			</div>
		</div>
	</div><hr>
	<div class="tab-content" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div id="weekend_A" class="tab-pane fade">
			
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-success">
					<div class="panel-heading">RC&nbsp;Happy&nbsp;Weekend&nbsp;:&nbsp;เรียนทั้งวัน</div>
					<div class="panel-body">
					

					
					
					
						<div class="row">	
						
						
				<?php	
						//$WC_CountA=10100;
						$RunWeekendA=new PrintWeekendA($call_stu->IDLevel,$data_yaer,$data_term,'1');
						foreach($RunWeekendA->RunPrintWeekendA() as $rc=>$RunWeekendARow){ ?>
						
							<div class="col-<?php echo $grid;?>-4" style="font-family: surafont_sanukchang; font-size: 14px;">
								<div class="panel panel-body border-top-pink">
									<div class="text-center"><?php echo $RunWeekendARow["wc_txt"];?></div>
									<ul>
										<li>ค่าลงทะเบียน&nbsp;<?php echo number_format($RunWeekendARow["wc_pay"], 2, '.', ',');?></li>
										<li>เวลาเรียน&nbsp;<?php echo $RunWeekendARow["wct_timeA"];?>&nbsp;ถึง&nbsp;<?php echo $RunWeekendARow["wct_timeB"];?></li>
									</ul>
										<input type="hidden" name="Wc_TestKey" id="Wc_TestKey" value="<?php echo $RunWeekendARow["wc_key"];?>">
										
									<div style="font-family: surafont_sanukchang; font-size: 12px;">*หมายเหตุ&nbsp;กรณีเลือกเรียนเต็มวัน&nbsp;ภาคเช้ารายวิชา&nbsp;/&nbsp;กิจกรรม&nbsp;นี้&nbsp;ต้องเรียนทุกคน</div>
								</div>
							</div>	
				<?php		} ?>
						
						
				<?php	
						$WC_CountA=10100;
						$CallWeekendA=new PrintWeekendA($call_stu->IDLevel,$data_yaer,$data_term,'2');
						foreach($CallWeekendA->RunPrintWeekendA() as $rc=>$CallWeekendARow){ ?>
						
							<div class="col-<?php echo $grid;?>-4" style="font-family: surafont_sanukchang; font-size: 14px;">
								<div class="panel panel-body border-top-pink">
									<div class="text-center"><?php echo $CallWeekendARow["wc_txt"];?></div>
									<ul>
										<li>ค่าลงทะเบียน&nbsp;<?php echo number_format($CallWeekendARow["wc_pay"], 2, '.', ',');?></li>
										<li>เวลาเรียน&nbsp;<?php echo $CallWeekendARow["wct_timeA"];?>&nbsp;ถึง&nbsp;<?php echo $CallWeekendARow["wct_timeB"];?></li>
										<li>จำนวน&nbsp;<?php echo $CallWeekendARow["wc_count"];?>&nbsp;คน</li>
									</ul>
					<?php
						$TestWeekendCount=new TestWeekendCountB($CallWeekendARow["wc_key"],$data_term,$data_yaer,$CallWeekendARow["wct_key"]);
							if($TestWeekendCount->RunTestWeekendCount()=="N"){ ?>
									<div class="text-center"><button type="button" id="<?php echo $WC_CountA;?>" class="btn btn-info" value="<?php echo $CallWeekendARow["wc_key"];?>">ลงทะเบียน&nbsp;คลิกที่นี้</button></div>
					<?php	}elseif($TestWeekendCount->RunTestWeekendCount()=="Y"){ ?>
									<div class="text-center" style="p.outset {outline-style: outset;}">เต็ม</div>
					<?php	}else{ 
								//-------------------------------------------------------------------------
							}
					?>					
									
								</div>
							</div>		
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<script>
		$(document).ready(function (){
			$('#<?php echo $WC_CountA;?>').on('click', function() {
				var WcKey="<?php echo $CallWeekendARow["wc_key"];?>";
				var WcTestKey=$("#Wc_TestKey").val();
				var WcTxt="<?php echo $CallWeekendARow["wc_txt"];?>";
				var WcT="<?php echo $data_term;?>";
				var WcY="<?php echo $data_yaer;?>";
				var WcSud="<?php echo $user_login;?>";
				var WcClass="<?php echo $call_stu->IDLevel;?>";
				var WctKey="<?php echo $CallWeekendARow["wct_key"];?>";
				var WctTestKey="<?php echo $RunWeekendARow["wct_key"];?>";
				var WcrLearn="A";
				swal({
					title: "<?php echo $CallWeekendARow["wc_txt"];?>",
					text: "เวลาเรียน <?php echo $CallWeekendARow["wct_timeA"];?> ถึง <?php echo $CallWeekendARow["wct_timeB"];?> ค่าลงทะเบียน <?php echo $CallWeekendARow["wc_pay"];?> บาท",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#EF5350",
					confirmButtonText: "ต้องการลงทะเบียน",
					cancelButtonText: "ไม่ต้องการลงทะเบียน",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						
						swal({
							title: "ลงทะเบียน!",
							//text: "Your imaginary file has been deleted.",
							confirmButtonColor: "#66BB6A",
							type: "success"
						},function(){
							$.post("<?php echo $golink;?>/Weekend_class",{
								WcKey:WcKey,
								WcTestKey:WcTestKey,
								WcTxt:WcTxt,
								WcT:WcT,
								WcY:WcY,
								WcSud:WcSud,
								WcClass:WcClass,
								WctKey:WctKey,
								WctTestKey:WctTestKey,
								WcrLearn:WcrLearn
							},function(weekend){
								if(weekend !=""){
									$("#RunWeekendClass").html(weekend)
								}else{}
							})
						});
						
					}
					else {
						swal({
							title: "ไม่ลงทะเบียน",
							//text: "",
							confirmButtonColor: "#2196F3",
							type: "error"
						});
					}
				});
			});
		})
	</script>							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
				<?php	$WC_CountA=$WC_CountA+1;
						}?>


						</div>

					
					</div>
				</div>
			</div>
			
						
			
		</div>
		<div id="weekend_B" class="tab-pane fade">
			
			<div class=" col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">RC&nbsp;Happy&nbsp;Weekend&nbsp;:&nbsp;เรียนครึ่งวัน</div>
					<div class="panel-body">
					
				<?php
						$WC_CountB=10200;
						$CallWeekendA=new PrintWeekendA($call_stu->IDLevel,$data_yaer,$data_term,'ALL');
						foreach($CallWeekendA->RunPrintWeekendA() as $rc=>$CallWeekendARow){ ?>
						
							<div class="col-<?php echo $grid;?>-4" style="font-family: surafont_sanukchang; font-size: 14px;">
								<div class="panel panel-body border-top-pink">
									<div class="text-center"><?php echo $CallWeekendARow["wc_txt"];?></div>
									<ul>
										<li>ค่าลงทะเบียน&nbsp;<?php echo number_format($CallWeekendARow["wc_pay"], 2, '.', ',');?></li>
										<li>เวลาเรียน&nbsp;<?php echo $CallWeekendARow["wct_timeA"];?>&nbsp;ถึง&nbsp;<?php echo $CallWeekendARow["wct_timeB"];?></li>
										
					<?php
							if($CallWeekendARow["weekend_class_type_wt_on"]==1){ ?>
							
					<?php	}else{ ?>
										<li>จำนวน&nbsp;<?php echo $CallWeekendARow["wc_count"];?>&nbsp;คน</li>
					<?php	} ?>					
										
										
									</ul>
					<?php
						$TestWeekendCount=new TestWeekendCountB($CallWeekendARow["wc_key"],$data_term,$data_yaer,$CallWeekendARow["wct_key"]);
							if($TestWeekendCount->RunTestWeekendCount()=="N"){ ?>
									<div class="text-center"><button type="button" id="<?php echo $WC_CountB;?>" class="btn btn-info" value="<?php echo $CallWeekendARow["wc_key"];?>">ลงทะเบียน&nbsp;คลิกที่นี้</button></div>
					<?php	}elseif($TestWeekendCount->RunTestWeekendCount()=="Y"){ ?>
									<div class="text-center"><button type="button" class="btn btn-danger disabled">เต็ม</button></div>
					<?php	}else{ 
								//-------------------------------------------------------------------------
							}
					?>											
									
									
									
								</div>
							</div>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<script>
		$(document).ready(function (){
			$('#<?php echo $WC_CountB;?>').on('click', function() {
				var WcKey="<?php echo $CallWeekendARow["wc_key"];?>";
				var WcTxt="<?php echo $CallWeekendARow["wc_txt"];?>";
				var WcT="<?php echo $data_term;?>";
				var WcY="<?php echo $data_yaer;?>";
				var WcSud="<?php echo $user_login;?>";
				var WcClass="<?php echo $call_stu->IDLevel;?>";
				var WctKey="<?php echo $CallWeekendARow["wct_key"];?>";
				var WcrLearn="B";
				swal({
					title: "<?php echo $CallWeekendARow["wc_txt"];?>",
					text: "เวลาเรียน <?php echo $CallWeekendARow["wct_timeA"];?> ถึง <?php echo $CallWeekendARow["wct_timeB"];?> ค่าลงทะเบียน <?php echo $CallWeekendARow["wc_pay"];?> บาท",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#EF5350",
					confirmButtonText: "ต้องการลงทะเบียน",
					cancelButtonText: "ไม่ต้องการลงทะเบียน",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						swal({
							title: "ลงทะเบียน!",
							//text: "Your imaginary file has been deleted.",
							confirmButtonColor: "#66BB6A",
							type: "success"
						},function(){
							$.post("<?php echo $golink;?>/Weekend_class",{
								WcKey:WcKey,
								WcTxt:WcTxt,
								WcT:WcT,
								WcY:WcY,
								WcSud:WcSud,
								WcClass:WcClass,
								WctKey:WctKey,
								WcrLearn:WcrLearn
							},function(weekend){
								if(weekend !=""){
									$("#RunWeekendClass").html(weekend)
								}else{}
							})
						});
					}
					else {
						swal({
							title: "ไม่ลงทะเบียน",
							//text: "",
							confirmButtonColor: "#2196F3",
							type: "error"
						});
					}
				});
			});
		})
	</script>							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
				<?php	$WC_CountB=$WC_CountB+1;
						} ?>						
					
						
					</div>
				</div>
			</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
				<div id="RunWeekendClass"></div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	}
		} ?>
	
	
	

	
					
<!--*********************************************************************-->					
			<?php	}else{ 
//--------------------------------------------------------------------------
					}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">			
				<span class="text-semibold">แจ้งเตือนจากระบบ!</span> ระดับชั้นนี้&nbsp;ไม่มีสิทธิ์เข้าถึงบริการนี้...
			</div>		
		</div>
	</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}?>
		
	</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php		break;
				case "OFF": ?>
	<div id="RuningLoad">
		<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
			<div class="col-<?php echo $grid;?>-12">
				<div class="breadcrumb-line breadcrumb-line-component">
					<ul class="breadcrumb">
						<h4><span class="text-semibold">RC&nbsp;Happy&nbsp;Weekend&nbsp;Class</span></h4>
					</ul>
					<ul class="breadcrumb-elements">
						<div class="heading-btn-group">
							<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>Home</span></a>
							<a class="btn btn-link text-size-small"><span>/</span></a>
							<a href="./?evaluation_mod=weekend_class" class="btn btn-link  text-size-small"><span>Open&nbsp;Now&nbsp;!&nbsp;RC&nbsp;Happy&nbsp;Weekend&nbsp;Class</span></a>
						</div>
					</ul>
				</div>
			</div>
		</div><br>	
		<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
			<div class="col-<?php echo $grid;?>-12">
				<div class="content-group-<?php echo $grid;?>">
					<div class="alert alpha-teal border-teal alert-styled-left">
						<div>End&nbsp;of&nbsp;registration&nbsp;period!&nbsp;RC&nbsp;Happy&nbsp;Weekend...</div>
					</div>
				</div>
			</div>
		</div>		
	</div>				
	<?php		break;
				default: ?>
	<div id="RuningLoad">
		<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
			<div class="col-<?php echo $grid;?>-12">
				<div class="breadcrumb-line breadcrumb-line-component">
					<ul class="breadcrumb">
						<h4><span class="text-semibold">RC&nbsp;Happy&nbsp;Weekend&nbsp;Class</span></h4>
					</ul>
					<ul class="breadcrumb-elements">
						<div class="heading-btn-group">
							<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>Home</span></a>
							<a class="btn btn-link text-size-small"><span>/</span></a>
							<a href="./?evaluation_mod=weekend_class" class="btn btn-link  text-size-small"><span>Open&nbsp;Now&nbsp;!&nbsp;RC&nbsp;Happy&nbsp;Weekend Class</span></a>
						</div>
					</ul>
				</div>
			</div>
		</div><br>	
		<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
			<div class="col-<?php echo $grid;?>-12">
				<div class="content-group-<?php echo $grid;?>">
					<div class="alert alpha-teal border-teal alert-styled-left">
						<div>Error!&nbsp;RC&nbsp;Happy&nbsp;Weekend...</div>
					</div>
				</div>
			</div>
		</div>		
	</div>					
	<?php	}?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php		break;
			default: ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div id="RuningLoad">
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="breadcrumb-line breadcrumb-line-component">
					<ul class="breadcrumb">
						<h4><span class="text-semibold">RC&nbsp;Happy&nbsp;Weekend&nbsp;Class</span></h4>
					</ul>
					<ul class="breadcrumb-elements">
						<div class="heading-btn-group">
							<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>Home</span></a>
							<a class="btn btn-link text-size-small"><span>/</span></a>
							<a href="./?evaluation_mod=weekend_class" class="btn btn-link  text-size-small"><span>Open&nbsp;Now&nbsp;!&nbsp;RC&nbsp;Happy&nbsp;Weekend&nbsp;Class</span></a>
						</div>
					</ul>
				</div>
			</div>
		</div><br>	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="content-group-<?php echo $grid;?>">
					<div class="alert alpha-teal border-teal alert-styled-left">
						<div>Error!&nbsp;RC&nbsp;Happy&nbsp;Weekend...</div>
					</div>
				</div>
			</div>
		</div>		
	</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}?>