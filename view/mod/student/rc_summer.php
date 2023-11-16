<style>
#RuningLoad {
	display:none;
}
</style>
<?php
//-----------------------------------------------------------------------------
	include("view/database/pdo_data.php");
	include("view/database/class_pdo.php");	
//-----------------------------------------------------------------------------	
	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");	
//-----------------------------------------------------------------------------		
	
	$PrintSystem=new SystemSummer("read","-","-","-","-","-","-","-","-","-","-");
		if(($PrintSystem->RunSS_Error()=="No")){
			foreach($PrintSystem->RunSS_Array() as $rc=>$PrintSystemRow){
				$data_yaer=$PrintSystemRow["data_yaer"];
				$data_term=$PrintSystemRow["data_term"];
				$data_summer=$PrintSystemRow["data_summer"];
				$OFFONDateTime=date("Y-m-d H:i:s",strtotime($PrintSystemRow["OFFONDateTime"]));
				$EndDateTime=date("Y-m-d H:i:s",strtotime($PrintSystemRow["EndDateTime"]));
				$test_system=$PrintSystemRow["test_system"];
				$time_add=date("Y-m-d H:i:s",strtotime($PrintSystemRow["time_add"]));
				$DeletePay_Sud=$PrintSystemRow["DeletePay_Sud"];
				$DeletePay_Admin=$PrintSystemRow["DeletePay_Admin"];
				$End4143_notrun=$PrintSystemRow["End4143_notrun"];
			}
		}else{
			$data_yaer="-";
			$data_term="-";
			$data_summer="-";
			$time_start="-";
			$time_end="-";
			$test_ict="-";	
			$DeletePay_Sud="-";
			$DeletePay_Admin="-";
			$End4143_notrun="-";
		}
	
	
	
	/*$data_yaer=2566;
	$data_term=1;
	$data_summer=2566;
	
	$user_login;*/
//------------------------------------------------------------------------------
	//ข้อมูลนักเรียน 
		$call_sturc=new regina_stu_data($user_login);
	//ระดับชั้น
		$call_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
			if((isset($call_stu->rc_plan))){
				$rc_IDPlan=$call_stu->rc_plan;
			}else{
				$rc_IDPlan=0;
			}
			
//------------------------------------------------------------------------------
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<script>
	$(function() {
		$("#RunLoad").fadeOut(5000, function() {
			$("#RuningLoad").fadeIn(4000);
		});
	});
</script>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<center>
			<div id="RunLoad">
				<img class="img-thumbnail" src="Template/global_assets/images/Cube-1s-200px.gif" />
			</div>	
		</center>
	</div>
</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div id="RuningLoad">
	<?php
//$EndDateTime=date("2023-01-30 00:00:00");//สิ้นสุดระยะเวลาลงทะเบียน
		$End4143_Cr=date("Y-m-d H:i:s");
		$End4143_notrun=strtotime($End4143_notrun);
		$End4143_run=strtotime($End4143_Cr);
//----------------------------------------------------------------			
			if(($End4143_run>=$End4143_notrun)){
				$End4143_runtime="OFF";
			}else{
				$End4143_runtime="ON";
			}
//----------------------------------------------------------------				
			if(($call_stu->IDLevel>=3 and $call_stu->IDLevel<=33)){ ?>
<!--############################################################################-->
<!--############################################################################-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4><span class="text-semibold">ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</span></h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=rc_summer" class="btn btn-link  text-size-small"><span>ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		/*$End4143DateTime_Cr=date("Y-m-d H:i:s");
		$End4143DateTime_notrun=strtotime("2023-02-09 16:00:00");
		$End4143DateTime_run=strtotime($End4143DateTime_Cr);*/
//---------------------------------------------------------------------------------			
			/*if(($End4143DateTime_run>=$End4143DateTime_notrun)){
				$End4143Print_runtime="OFF";
			}else{
				$End4143Print_runtime="ON";
			}*/
//---------------------------------------------------------------------------------							
	?>


	<?php
		//$test_system="OFF";
		switch($test_system){
			case "ON": ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alpha-teal border-teal alert-styled-left">
					<div>ขออภัยในความสะดวก&nbsp;เจ้าหน้าที่&nbsp;ICT&nbsp;กำลังทดสอบระบบ... </div>
					<div>หากผู้ปกครองดำเนินการกรอกข้อมูล&nbsp;จะถือว่าดำเนินการไม่สำเร็จ</div>
				</div>
			</div>
		</div>
	</div>		
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	break;
			default:
	//---------------------------------------------------------------		
		}
	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<?php
	//time_add
	$TimeAddTime_Cr=date("Y-m-d H:i:s");
	$TimeAddTime_notrun=strtotime($time_add);
	$TimeAddTime_run=strtotime($TimeAddTime_Cr);
		if(($TimeAddTime_run>=$TimeAddTime_notrun)){
			$TimeAdd_runtime="OFF";
		}else{
			$TimeAdd_runtime="ON";
		}
	//time_add End	
?>

<?php
	//$OFFONDateTime=date("2023-01-19 08:00:00");
	//$OFFONDateTime=date("2021-07-24 08:00:00");
	$OFFONDateTime_Cr=date("Y-m-d H:i:s");
	$OFFONDateTime_notrun=strtotime($OFFONDateTime);
	$OFFONDateTime_run=strtotime($OFFONDateTime_Cr);
//+++++++++++++++23End	
		if(($OFFONDateTime_run>=$OFFONDateTime_notrun)){
			$OFFONPrint_runtime="ON";
		}else{
			$OFFONPrint_runtime="OFF"; 
		}
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
		if(($OFFONPrint_runtime=="OFF")){ ?>
<!--##########################################################-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					การลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน&nbsp;ปีการศึกษา&nbsp;<?php echo $data_summer;?>&nbsp;จะเริ่มลงทะเบียนตั้งแต่วันที่&nbsp;<?php echo date("Y-m-d H:i:s",strtotime($OFFONDateTime));?>&nbsp;เป็นต้นไป
				</div>
			</div>
		</div>
	</div>
<!--##########################################################-->
<?php	}elseif(($OFFONPrint_runtime=="ON")){	?>
<!--##########################################################-->
	<?php
		//$EndDateTime=date("2023-01-30 00:00:00");//สิ้นสุดระยะเวลาลงทะเบียน
		$EndDateTime_Cr=date("Y-m-d H:i:s");
		$EndDateTime_notrun=strtotime($EndDateTime);
		$EndDateTime_run=strtotime($EndDateTime_Cr);
//----------------------------------------------------------------			
			if(($EndDateTime_run>=$EndDateTime_notrun)){
				$EndPrint_runtime="OFF";
			}else{
				$EndPrint_runtime="ON";
			}
//----------------------------------------------------------------
//----------------------------------------------------------------			
			if(($EndPrint_runtime=="OFF")){	?>
<!--##########################################################-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					<div>&nbsp;สิ้นสุดระยะเวลาดำเนินการ&nbsp;ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน&nbsp;ปีการศึกษา&nbsp;<?php echo $data_summer;?>&nbsp;</div>
					<div>&nbsp;ติดต่อฝ่ายวิชาการ&nbsp;โทรศัพท์&nbsp;053-282395&nbsp;ต่อ&nbsp;121&nbsp;หรือ&nbsp;122&nbsp;(การเรียนการสอนเรียนเสริมภาคฤูดร้อน)</div>
					<div>&nbsp;ติดต่อฝ่ายกิจการนักเรียน&nbsp;โทรศัพท์&nbsp;053-282395&nbsp;ต่อ&nbsp;114&nbsp;(กิจกรรมเรียนเสริมภาคฤูดร้อน)</div>
				</div>
			</div>
		</div>
	</div>		
<!--Update coding by beer 14/03/2023-->
	<?php
		$StatusPaySummerData= new StatusPaySummer($user_login,$data_summer);
			if((@$StatusPaySummerData->SPS_RMD_on==1)){	  ?>

	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<span class="text-semibold" style="text-shadow: 0 0 0.2em #F87, 0 0 0.2em #F87; font-size: 20px;"><?php echo $StatusPaySummerData->SPS_RMD_txt;?></span>
			</div>	
		</div>
	</div><br>		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-info">
				<div class="panel-heading">รายการลงทะเบียนเรียนเสริมภาคฤดูร้อน</div>
			</div>	
		</div>
	</div>	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr class="success">
							<th><div>#</div></th>
							<th><div>รหัสวิชา / กิจกรรม</div></th>
							<th><div>รายการวิชา / กิจกรรม</div></th>
						</tr>
					</thead>
					<tbody>

	<?php
			$CSD_Count=1;
			$CSD_Sumpay=0;
			$CallSummerData=new PrintSummerData($user_login,$data_summer);
			foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
						<tr class="info">
							<td><div><?php echo $CSD_Count;?></div></td>
							<td><div><?php echo $CallSummerDataRow["RSD_no"];?></div></td>
							<td><div><?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
						</tr>		
	<?php		$CSD_Count=$CSD_Count+1;
				$CSD_Sumpay=$CSD_Sumpay+$CallSummerDataRow["RSP_price"];
			} ?>						

					</tbody>
				</table>
			</div>	
		</div>
	</div><hr>	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
	<form name="print_rc_summer" action="<?php echo base_url();?>rcprint/print_summer/<?php echo $user_login;?>" method="post" target="_blank">
		<div class="panel panel-body border-top-teal">
			<div class="row">
				<div class="col-<?php echo $grid;?>-3">				
		<?php
//-----------------------------------------------------------------------------------
			//include("view/database/class_pdo.php");    
			include("view/database/regina_student.php");
			include("view/function/pay_scb.php");
//-----------------------------------------------------------------------------------	
			$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
			$stu_data=new regina_stu_data($user_login);	
//-----------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------		
			$class=$data_stu->IDLevel;
			$class_ex=$data_stu->Sort_name_E2;
			$txt_billerId="099400043439110";
			$txt_ref1=strtoupper($user_login."L".$class_ex);
			$txt_ref2=strtoupper("SUMMER".$data_term."0Y".$data_yaer);
			$txt_amount=number_format($CSD_Sumpay, 2, '.', '');                                                   
			$txt_width="104";
			$payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
		?>		
				
					<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="104" height="104"></div>
					<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
					<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
					<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
					<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($CSD_Sumpay, 2, '.', ',');?></div>				
				
				</div>
				<div class="col-<?php echo $grid;?>-3">
					<button type="submit" class="btn btn-success">พิมพ์ใบชำระเงิน ค่าลงทะเบียน</button>
				</div>
				
				<div class="col-<?php echo $grid;?>-3">
	
	<script>
		$(document).ready(function(){
            $("#SaveQRCodeA").on('click',function(){
                var ImageB = '<?php echo $payqrcode->call_qrcode_scb();?>';
                var a = document.createElement('a');
                a.href = ImageB;
                a.download = ImageB.substr(ImageB.lastIndexOf('/') + 1);
                window.win = open(a);
                setTimeout('win.document.execCommand("SaveAs")', 0);	
            })
		})
	</script>			
				
					<button type="button" name="SaveQRCodeA" id="SaveQRCodeA" class="btn btn-default"><i class="icon-qrcode position-left"></i> Save QRCode</button>
				
				</div>
				
				<div class="col-<?php echo $grid;?>-3"></div>
			</div>
			<input type="hidden" name="data_summer" value="<?php echo $data_summer;?>">
			<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
			<input type="hidden" name="data_term" value="<?php echo $data_term;?>">
			<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
		</div>
	</form>
		</div>
	</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	}elseif((@$StatusPaySummerData->SPS_RMD_on==2)){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<span class="text-semibold" style="text-shadow: 0 0 0.2em #8F7; font-size: 20px;"><?php echo $StatusPaySummerData->SPS_RMD_txt;?></span>
			</div>	
		</div>
	</div><br>	

	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-success">
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="panel panel-info">
							<div class="panel-heading">รายการลงทะเบียนเรียนเสริมภาคฤดูร้อน</div>
						</div>	
					</div>
				</div>	
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr class="success">
											<th><div>#</div></th>
											<th><div>รหัสวิชา / กิจกรรม</div></th>
											<th><div>รายการวิชา / กิจกรรม</div></th>
										</tr>
									</thead>
									<tbody>
					<?php
							$CSD_Count=1;
							$CallSummerData=new PrintSummerData($user_login,$data_summer);
							foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
										<tr class="info">
											<td><div><?php echo $CSD_Count;?></div></td>
											<td><div><?php echo $CallSummerDataRow["RSD_no"];?></div></td>
											<td><div><?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
										</tr>		
					<?php	$CSD_Count=$CSD_Count+1;} ?>						

									</tbody>
								</table>
							</div>	
					</div>
				</div>			
			</div>
		</div>
	</div>
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php   } ?>
<!--Update coding by beer End 14/03/2023-->	
<!--##########################################################-->				
<?php		}elseif(($EndPrint_runtime=="ON")){ ?>
<!--##########################################################-->
<!--##########################################################-->
	<?php
			if(($call_stu->IDLevel==41)){ ?>
<!--##########################################################-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning no-border">
				<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">กิจกรรม ช่วงบ่าย "(เพิ่ม 500)" </span>ต้องชำระค่าลงทะเบียนเพิ่ม 500 บาท ที่ห้องการเงิน
			</div>		
		</div>
	</div>
<!--##########################################################-->			
	<?php	}else{}?>
<!--##########################################################-->
<!--##########################################################-->
		<?php
			$ClassSummer=new SetClassSummer($call_stu->IDLevel);
			$StatusPaySummer=new StatusPaySummer($user_login,$data_summer);
			
				if(($ClassSummer->RunSetClassSummer()=="A")){	?>
<!--##########################################################-->		
			<?php
					if((isset($StatusPaySummer->SPS_RMD_on))){ ?>
<!--##########################################################-->
				<?php
						if(($StatusPaySummer->SPS_RMD_on==null or $StatusPaySummer->SPS_RMD_on==0)){	?>
<!--##########################################################-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">รายการกิจกรรมเรียนเสริมภาคฤดูร้อน</div>		
					<div class="panel-body">
	<form class="form-horizontal">
					
						<div class="row">
	<?php
		$ShowRsSubjectData=new ShowRsSubjectData($data_summer,$call_stu->IDLevel);
			$count_su=0;
			foreach($ShowRsSubjectData->RunShowRsSubjectData() as $rc=>$ShowRsSubjectDataRow){ ?>
							
	<!--##########################################################-->			
				<?php
					$SummerKeep=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
					$SummerKeep=$SummerKeep->CountSummerKeep();
					$SummerCount=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
					$SummerCount=$SummerCount->CountSummerCount();
					
				?>
	<!--##########################################################-->	
				<?php
					if((isset($SummerKeep,$SummerCount))){
						if(($SummerCount>=$SummerKeep)){ ?>
	<!--##########################################################-->	
	<!--##########################################################-->							
							<div class="col-<?php echo $grid;?>-12">
								<div class="form-group">
									<label class="radio-inline">
										<input type="radio" class="styled" disabled="disabled" name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
										<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
									</label>			
								</div>
							</div>	
	<!--##########################################################-->	
		<script>
			$(document).ready(function (){
				$('#RSDno<?php echo $count_su;?>').on('click', function() {
					var RSDno=$("#RSDno<?php echo $count_su;?>").val();
					var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
					var RSYear="<?php echo $data_summer;?>";
					var RSKey="<?php echo $user_login;?>";
					var RSClass="<?php echo $call_stu->IDLevel;?>";
					var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
					var StudentID="<?php echo $user_login;?>";
					var StudentName="<?php echo $myname;?>";
					swal({
						title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
						text:  "กิจกรรม : "+RSDnoName,
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#EF5350",
						confirmButtonText: "ใช้ ยืนยันการลงทะเบียน",
						cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
						closeOnConfirm: false,
						closeOnCancel: false
					},
					function(isConfirm){
						if (isConfirm) {
							if(RSDno==""){
								swal({
									title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
									text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
									confirmButtonColor: "#66BB6A",
									type: "error"
								});							
							}else{
								swal({
									title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
									text:  "กิจกรรม : "+RSDnoName,
									confirmButtonColor: "#66BB6A",
									type: "success"
								},function(){
									$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
										RSD_no:RSDno,
										RSD_noName:RSDnoName,
										RS_Year:RSYear,
										RS_Key:RSKey,
										RS_Class:RSClass,
										RS_Est:RSEst,
										Student_ID:StudentID,
										Student_Name:StudentName
									},function(){
										document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
									})
								});							
							}

						}
						else {
							swal({
								title: "ยกเลิกการลงทะเบียน",
								text: "เลือกรายการกิจกรรมที่สนใจ",
								confirmButtonColor: "#2196F3",
								type: "error"
							});
						}
					});
				});			
			})	
		</script>
<!--##########################################################-->	
<!--##########################################################-->							
				<?php	}else{	?>
<!--##########################################################-->	
<!--##########################################################-->			
					<?php
						$SummerKeep=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
						$SummerKeep=$SummerKeep->CountSummerKeep();
						$SummerCount=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
						$SummerCount=$SummerCount->CountSummerCount();
					?>
<!--##########################################################-->
					<?php
							if(($SummerCount>=$SummerKeep)){ ?>
<!--##########################################################-->
<!--##########################################################-->							
							<div class="col-<?php echo $grid;?>-12">
								<div class="form-group">
									<label class="radio-inline">
										<input type="radio" class="styled" disabled="disabled" name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
										<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
									</label>			
								</div>
							</div>	
	<!--##########################################################-->	
		<script>
			$(document).ready(function (){
				$('#RSDno<?php echo $count_su;?>').on('click', function() {
					var RSDno=$("#RSDno<?php echo $count_su;?>").val();
					var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
					var RSYear="<?php echo $data_summer;?>";
					var RSKey="<?php echo $user_login;?>";
					var RSClass="<?php echo $call_stu->IDLevel;?>";
					var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
					var StudentID="<?php echo $user_login;?>";
					var StudentName="<?php echo $myname;?>";
					swal({
						title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
						text:  "กิจกรรม : "+RSDnoName,
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#EF5350",
						confirmButtonText: "ใช้ ยืนยันการลงทะเบียน",
						cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
						closeOnConfirm: false,
						closeOnCancel: false
					},
					function(isConfirm){
						if(isConfirm){
							if(RSDno==""){
								swal({
									title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
									text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
									confirmButtonColor: "#66BB6A",
									type: "error"
								});							
							}else{
								swal({
									title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
									text:  "กิจกรรม : "+RSDnoName,
									confirmButtonColor: "#66BB6A",
									type: "success"
								},function(){
									$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
										RSD_no:RSDno,
										RSD_noName:RSDnoName,
										RS_Year:RSYear,
										RS_Key:RSKey,
										RS_Class:RSClass,
										RS_Est:RSEst,
										Student_ID:StudentID,
										Student_Name:StudentName
									},function(){
										document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
									})
								});							
							}
						}else{
							swal({
								title: "ยกเลิกการลงทะเบียน",
								text: "เลือกรายการกิจกรรมที่สนใจ",
								confirmButtonColor: "#2196F3",
								type: "error"
							});
						}
					});
				});			
			})	
		</script>
<!--##########################################################-->							
<!--##########################################################-->							
					<?php	}else{	?>
<!--##########################################################-->
<!--##########################################################-->							
							<div class="col-<?php echo $grid;?>-12">
								<div class="form-group">
									<label class="radio-inline">
										<input type="radio" class="styled"  name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
										<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
									</label>			
								</div>
							</div>	
	<!--##########################################################-->	
		<script>
			$(document).ready(function (){
				$('#RSDno<?php echo $count_su;?>').on('click', function() {
					var RSDno=$("#RSDno<?php echo $count_su;?>").val();
					var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
					var RSYear="<?php echo $data_summer;?>";
					var RSKey="<?php echo $user_login;?>";
					var RSClass="<?php echo $call_stu->IDLevel;?>";
					var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
				    var StudentID="<?php echo $user_login;?>";
					var StudentName="<?php echo $myname;?>";
					swal({
						title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
						text:  "กิจกรรม : "+RSDnoName,
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#EF5350",
						confirmButtonText: "ใช้ ยืนยันการลงทะเบียน",
						cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
						closeOnConfirm: false,
						closeOnCancel: false
					},
					function(isConfirm){
						if (isConfirm) {
							if(RSDno==""){
								swal({
									title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
									text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
									confirmButtonColor: "#66BB6A",
									type: "error"
								});							
							}else{
								swal({
									title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
									text:  "กิจกรรม : "+RSDnoName,
									confirmButtonColor: "#66BB6A",
									type: "success"
								},function(){
									$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
										RSD_no:RSDno,
										RSD_noName:RSDnoName,
										RS_Year:RSYear,
										RS_Key:RSKey,
										RS_Class:RSClass,
										RS_Est:RSEst,
										Student_ID:StudentID,
										Student_Name:StudentName
									},function(){
										document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
									})
								});							
							}

						}
						else {
							swal({
								title: "ยกเลิกการลงทะเบียน",
								text: "เลือกรายการกิจกรรมที่สนใจ",
								confirmButtonColor: "#2196F3",
								type: "error"
							});
						}
					});
				});			
			})	
		</script>
<!--##########################################################-->							
<!--##########################################################-->							
					<?php	} ?>

	
<!--##########################################################-->						
				<?php	}
					}else{ ?>
	<!--<div class="row">
		<div class="col-<?php //echo $grid;?>-12">
			<div class="alert alert-danger alert-styled-left alert-bordered">			
				<span class="text-semibold">ไม่พบรายการข้อมูล...</span>
			</div>		
		</div>
	</div>-->						
			<?php	} ?>


					
	<?php	$count_su=$count_su+1;
			} ?>		
	</form>								
						</div>
					</div>		
				</div>
			</div>
		</div>		
<!--##########################################################-->					
				<?php	}else{ ?>
	<!--##########################################################-->	
	<?php
		$StatusPaySummerData= new StatusPaySummer($user_login,$data_summer);
			if(($StatusPaySummerData->SPS_RMD_on==1)){	  ?>

	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<span class="text-semibold" style="text-shadow: 0 0 0.2em #F87, 0 0 0.2em #F87; font-size: 20px;"><?php echo $StatusPaySummerData->SPS_RMD_txt;?></span>
			</div>	
		</div>
	</div><br>		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-info">
				<div class="panel-heading">รายการลงทะเบียนเรียนเสริมภาคฤดูร้อน</div>
			</div>	
		</div>
	</div>	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr class="success">
							<th><div>#</div></th>
							<th><div>รหัสวิชา / กิจกรรม</div></th>
							<th><div>รายการวิชา / กิจกรรม</div></th>
						</tr>
					</thead>
					<tbody>

	<?php
			$CSD_Count=1;
			$CSD_Sumpay=0;
			$CallSummerData=new PrintSummerData($user_login,$data_summer);
			foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
						<tr class="info">
							<td><div><?php echo $CSD_Count;?></div></td>
							<td><div><?php echo $CallSummerDataRow["RSD_no"];?></div></td>
							<td><div><?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
						</tr>		
	<?php		$CSD_Count=$CSD_Count+1;
				$CSD_Sumpay=$CSD_Sumpay+$CallSummerDataRow["RSP_price"];
			} ?>						

					</tbody>
				</table>
			</div>	
		</div>
	</div><hr>	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
	<form name="print_rc_summer" action="<?php echo base_url();?>rcprint/print_summer/<?php echo $user_login;?>" method="post" target="_blank">
		<div class="panel panel-body border-top-teal">
			<div class="row">
				<div class="col-<?php echo $grid;?>-3">				
		<?php
//-----------------------------------------------------------------------------------
			//include("view/database/class_pdo.php");    
			include("view/database/regina_student.php");
			include("view/function/pay_scb.php");
//-----------------------------------------------------------------------------------	
			$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
			$stu_data=new regina_stu_data($user_login);	
//-----------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------		
			$class=$data_stu->IDLevel;
			$class_ex=$data_stu->Sort_name_E2;
			$txt_billerId="099400043439110";
			$txt_ref1=strtoupper($user_login."L".$class_ex);
			$txt_ref2=strtoupper("SUMMER".$data_term."0Y".$data_yaer);
			$txt_amount=number_format($CSD_Sumpay, 2, '.', '');                                                   
			$txt_width="104";
			$payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
		?>		
				
					<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="104" height="104"></div>
					<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
					<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
					<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
					<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($CSD_Sumpay, 2, '.', ',');?></div>				
				
				</div>
				<div class="col-<?php echo $grid;?>-3">
					<button type="submit" class="btn btn-success">พิมพ์ใบชำระเงิน ค่าลงทะเบียน</button>
				</div>
				
				<div class="col-<?php echo $grid;?>-3">
	
	<script>
		$(document).ready(function(){
            $("#SaveQRCodeA").on('click',function(){
                var ImageB = '<?php echo $payqrcode->call_qrcode_scb();?>';
                var a = document.createElement('a');
                a.href = ImageB;
                a.download = ImageB.substr(ImageB.lastIndexOf('/') + 1);
                window.win = open(a);
                setTimeout('win.document.execCommand("SaveAs")', 0);	
            })
		})
	</script>			
				
					<button type="button" name="SaveQRCodeA" id="SaveQRCodeA" class="btn btn-default"><i class="icon-qrcode position-left"></i> Save QRCode</button>
				
				</div>
				
				<div class="col-<?php echo $grid;?>-3">
				
					<button type="button" class="btn btn-info" id="sweet_loader">ยกเลิกการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</button>				
	
				</div>
			</div>
			<input type="hidden" name="data_summer" value="<?php echo $data_summer;?>">
			<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
			<input type="hidden" name="data_term" value="<?php echo $data_term;?>">
			<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
		</div>
	</form>
		</div>
	</div>	
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
			<script>
				$(document).ready(function (){
						var TimeAdd_runtime="<?php echo $TimeAdd_runtime;?>";
					$('#sweet_loader').on('click', function() {
						var URSCYear="<?php echo $data_yaer;?>";//ปีการศึกษา
						var URSCKey="<?php echo $user_login;?>";//
						var URSCTxtTh="<?php echo $CallSummerDataRow['RSD_txtTh'];?>";
						var URSCName="<?php echo $myname;?>";
						swal({
							title: "คุณต้องการยกเลิกหรือไม่",
							text: "<?php echo $CallSummerDataRow['RSD_txtTh'];?>",
							type: "info",
							showCancelButton: true,
							closeOnConfirm: false,
							confirmButtonColor: "#2196F3",
							showLoaderOnConfirm: true
						},function() {
							setTimeout(function() {
								if(TimeAdd_runtime=="OFF"){
									swal({
										title: "หมดเวลายกเลิกการลงทะเบียน",
										text: "ขออภัยไม่สามารถยกเลิกได้ เนื่องจากสิ้นสุดระยะเวลายกเลิกลงทะเบียน",
										confirmButtonColor: "#2196F3",
										type: "warning"
									});
								}else if(TimeAdd_runtime=="ON"){
									swal({
										title: "ยกเลิกสำเร็จ",
										confirmButtonColor: "#2196F3"
									},function (RunSummer){
										$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer_count.php",{
											URSC_Year:URSCYear,
											URSC_Key:URSCKey,
											URSC_Txtth:URSCTxtTh,
											URSC_Name:URSCName
										},function(RS){
											if(RS !=""){
												document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
											}else{}
										})
									});									
								}else{
									swal({
										title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
										//text: "เลือกรายการกิจกรรมที่สนใจ",
										confirmButtonColor: "#2196F3",
										type: "error"
									});									
								}
							}, 2000);
						});
					});					
				})
			</script>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	}elseif(($StatusPaySummerData->SPS_RMD_on==2)){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<span class="text-semibold" style="text-shadow: 0 0 0.2em #8F7; font-size: 20px;"><?php echo $StatusPaySummerData->SPS_RMD_txt;?></span>
			</div>	
		</div>
	</div><br>	

	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-success">
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="panel panel-info">
							<div class="panel-heading">รายการลงทะเบียนเรียนเสริมภาคฤดูร้อน</div>
						</div>	
					</div>
				</div>	
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr class="success">
											<th><div>#</div></th>
											<th><div>รหัสวิชา / กิจกรรม</div></th>
											<th><div>รายการวิชา / กิจกรรม</div></th>
										</tr>
									</thead>
									<tbody>
					<?php
							$CSD_Count=1;
							$CallSummerData=new PrintSummerData($user_login,$data_summer);
							foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
										<tr class="info">
											<td><div><?php echo $CSD_Count;?></div></td>
											<td><div><?php echo $CallSummerDataRow["RSD_no"];?></div></td>
											<td><div><?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
										</tr>		
					<?php	$CSD_Count=$CSD_Count+1;} ?>						

									</tbody>
								</table>
							</div>	
					</div>
				</div>			
			</div>
		</div>
	</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
			if(($DeletePay_Sud=="Yes")){ ?>
			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if(($TimeAdd_runtime=="ON")){ ?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-teal">
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<button type="button" class="btn btn-info" id="sweet_loader">ยกเลิกการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</button>			
					</div>
				</div>
				<input type="hidden" name="data_summer" value="<?php echo $data_summer;?>">
				<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
				<input type="hidden" name="data_term" value="<?php echo $data_term;?>">
				<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
			</div>
		</div>
	</div>				
		<?php	}else{} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
	<?php	}else{ ?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
		<!--
			<div class="panel panel-body border-top-teal">
				<div class="row">
					<div class="col-<?php //echo $grid;?>-12">
						<button type="button" class="btn btn-info" id="sweet_loader">ยกเลิกการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</button>			
					</div>
				</div>
				<input type="hidden" name="data_summer" value="<?php //echo $data_summer;?>">
				<input type="hidden" name="data_yaer" value="<?php //echo $data_yaer;?>">
				<input type="hidden" name="data_term" value="<?php //echo $data_term;?>">
				<input type="hidden" name="user_login" value="<?php //echo $user_login;?>">
			</div>
		-->
		</div>
	</div>				
	<?php	} ?>
	

	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
			<script>
				$(document).ready(function (){
					$('#sweet_loader').on('click', function() {
						var URSCYear="<?php echo $data_yaer;?>";//ปีการศึกษา
						var URSCKey="<?php echo $user_login;?>";//
						var URSCTxtTh="<?php echo $CallSummerDataRow['RSD_txtTh'];?>";
						var URSCName="<?php echo $myname;?>";
						swal({
							title: "คุณต้องการยกเลิกหรือไม่",
							text: "<?php echo $CallSummerDataRow['RSD_txtTh'];?>",
							type: "info",
							showCancelButton: true,
							closeOnConfirm: false,
							confirmButtonColor: "#2196F3",
							showLoaderOnConfirm: true
						},
						function() {
							setTimeout(function() {
								swal({
									title: "ยกเลิกสำเร็จ",
									confirmButtonColor: "#2196F3"
								},function (RunSummer){
									$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer_count.php",{
										URSC_Year:URSCYear,
										URSC_Key:URSCKey,
										URSC_Txtth:URSCTxtTh,
										URSC_Name:URSCName
									},function(RS){
										if(RS !=""){
											document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
										}else{}
									})
								});
							}, 2000);
						});
					});					
					
				})
			</script>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	}else{ ?>
	
	<?php   } ?>				
	<!--##########################################################-->						
				<?php	}?>				
<!--##########################################################-->				
			<?php	}else{ ?>
<!--##########################################################-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">รายการกิจกรรมเรียนเสริมภาคฤดูร้อน</div>
					<div class="panel-body">
	<form class="form-horizontal">
					
						<div class="row">
	<?php
		$ShowRsSubjectData=new ShowRsSubjectData($data_summer,$call_stu->IDLevel);
			$count_su=0;
			foreach($ShowRsSubjectData->RunShowRsSubjectData() as $rc=>$ShowRsSubjectDataRow){ ?>
							
<!--##########################################################-->			
				<?php
					$SummerKeep=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
					$SummerKeep=$SummerKeep->CountSummerKeep();
					$SummerCount=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
					$SummerCount=$SummerCount->CountSummerCount();
				?>
<!--##########################################################-->	
				<?php
						if(($SummerCount>=$SummerKeep)){	?>
<!--##########################################################-->	
<!--##########################################################-->							
							
							<div class="col-<?php echo $grid;?>-12">
								<div class="form-group">
									<label class="radio-inline">
										<input type="radio" class="styled" disabled="disabled" name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
										<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
									</label>			
								</div>
							</div>	
							
							
							
	<!--##########################################################-->	
		<script>
			$(document).ready(function (){
				$('#RSDno<?php echo $count_su;?>').on('click', function() {
					var RSDno=$("#RSDno<?php echo $count_su;?>").val();
					var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
					var RSYear="<?php echo $data_summer;?>";
					var RSKey="<?php echo $user_login;?>";
					var RSClass="<?php echo $call_stu->IDLevel;?>";
					var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
					var StudentID="<?php echo $user_login;?>";
					var StudentName="<?php echo $myname;?>";
					swal({
						title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
						text:  "กิจกรรม : "+RSDnoName,
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#EF5350",
						confirmButtonText: "ใช่ ยืนยันการลงทะเบียน",
						cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
						closeOnConfirm: false,
						closeOnCancel: false
					},
					function(isConfirm){
						if (isConfirm) {
							if(RSDno==""){
								swal({
									title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
									text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
									confirmButtonColor: "#66BB6A",
									type: "error"
								});							
							}else{
								swal({
									title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
									text:  "กิจกรรม : "+RSDnoName,
									confirmButtonColor: "#66BB6A",
									type: "success"
								},function(){
									$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
										RSD_no:RSDno,
										RSD_noName:RSDnoName,
										RS_Year:RSYear,
										RS_Key:RSKey,
										RS_Class:RSClass,
										RS_Est:RSEst,
										Student_ID:StudentID,
										Student_Name:StudentName
									},function(){
										document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
									})
								});							
							}

						}else{
							swal({
								title: "ยกเลิกการลงทะเบียน",
								text: "เลือกรายการกิจกรรมที่สนใจ",
								confirmButtonColor: "#2196F3",
								type: "error"
							});
						}
					});
				});			
			})	
		</script>
<!--##########################################################-->					
<!--##########################################################-->						
				<?php	}else{ ?>
<!--##########################################################-->
<!--##########################################################-->							
							
							<div class="col-<?php echo $grid;?>-12">
								<div class="form-group">
									<label class="radio-inline">
										<input type="radio" class="styled"  name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
										<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
									</label>			
								</div>
							</div>	
							
							
							
	<!--##########################################################-->	
		<script>
			$(document).ready(function (){
				$('#RSDno<?php echo $count_su;?>').on('click', function() {
					var RSDno=$("#RSDno<?php echo $count_su;?>").val();
					var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
					var RSYear="<?php echo $data_summer;?>";
					var RSKey="<?php echo $user_login;?>";
					var RSClass="<?php echo $call_stu->IDLevel;?>";
					var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
					var StudentID="<?php echo $user_login;?>";
					var StudentName="<?php echo $myname;?>";
					swal({
						title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
						text:  "กิจกรรม : "+RSDnoName,
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#EF5350",
						confirmButtonText: "ใช้ ยืนยันการลงทะเบียน",
						cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
						closeOnConfirm: false,
						closeOnCancel: false
					},
					function(isConfirm){
						if (isConfirm) {
							if(RSDno==""){
								swal({
									title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
									text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
									confirmButtonColor: "#66BB6A",
									type: "error"
								});							
							}else{
								swal({
									title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
									text:  "กิจกรรม : "+RSDnoName,
									confirmButtonColor: "#66BB6A",
									type: "success"
								},function(){
									$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
										RSD_no:RSDno,
										RSD_noName:RSDnoName,
										RS_Year:RSYear,
										RS_Key:RSKey,
										RS_Class:RSClass,
										RS_Est:RSEst,
										Student_ID:StudentID,
										Student_Name:StudentName
									},function(){
										document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
									})
								});							
							}

						}
						else {
							swal({
								title: "ยกเลิกการลงทะเบียน",
								text: "เลือกรายการกิจกรรมที่สนใจ",
								confirmButtonColor: "#2196F3",
								type: "error"
							});
						}
					});
				});			
			})	
		</script>
<!--##########################################################-->
<!--##########################################################-->						
				<?php	}      ?>
					
	<?php	$count_su=$count_su+1;
			} ?>		
	</form>								
						</div>
					</div>		
				</div>
			</div>
		</div>		
<!--##########################################################-->				
			<?php	}?>
<!--##########################################################-->					
		<?php	}elseif(($ClassSummer->RunSetClassSummer()=="B")){ ?>
<!--##########################################################-->
			<?php
					if((isset($StatusPaySummer->SPS_RMD_on))){ ?>
<!--##########################################################-->	
				<?php
						if(($StatusPaySummer->SPS_RMD_on==null or $StatusPaySummer->SPS_RMD_on==0)){	?>
<!--##########################################################-->
	<?php
			if(($call_stu->IDLevel>=12 and $call_stu->IDLevel<=23)){ ?>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="panel panel-info">
						<div class="panel-heading">ภาคเช้า วิชาการ</div>
						<div class="panel-body">
							<ul>
								<li>ภาษาไทย</li>
								<li>คณิตศาสตร์</li>
								<li>วิทยาศาสตร์</li>
								<li>ภาษาอังกฤษ</li>
								<li>สังคมศึกษา</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
	<?php	}elseif(($call_stu->IDLevel>=31 and $call_stu->IDLevel<=33)){ ?>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="panel panel-info">
						<div class="panel-heading">ภาคเช้า วิชาการ</div>
						<div class="panel-body">
							<ul>
								<li>ภาษาไทย</li>
								<li>คณิตศาสตร์</li>
								<li>วิทยาศาสตร์</li>
								<li>ภาษาอังกฤษ</li>
								<li>สังคมศึกษา</li>
								<li>ภาษาอังกฤษเพื่อการสื่อสาร</li>
							</ul>
						</div>
					</div>
				</div>
			</div>			
	<?php	}elseif(($call_stu->IDLevel>=41 and $call_stu->IDLevel<=43)){ ?>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="panel panel-info">
						<div class="panel-heading">ภาคเช้า วิชาการ</div>
						<div class="panel-body">
							<ul>
								<li>จัดเรียนการสอนตามแผนการเรียน</li>
							</ul>
						</div>
					</div>
				</div>
			</div>			
	<?php	}else{}?>	
<!--##########################################################-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
	<?php
			if(($call_stu->IDLevel>=12 and $call_stu->IDLevel<=43)){ ?>
					<div class="panel-heading">
						<div>ภาคบ่าย เรียนกิจกรรมตามความสนใจ</div>
						<div>กรุณาเลือกกิจกรรม...</div>
					</div>			
	<?php	}else{?>
					<div class="panel-heading">รายการกิจกรรมเรียนเสริมภาคฤดูร้อน</div>		
	<?php   } ?>				
					<div class="panel-body">
	<form class="form-horizontal">
					
						<div class="row">
	<?php
		$ShowRsSubjectData=new ShowRsSubjectData($data_summer,$call_stu->IDLevel);
			$count_su=0;
			foreach($ShowRsSubjectData->RunShowRsSubjectData() as $rc=>$ShowRsSubjectDataRow){ ?>
				
		<?php
				if(($ShowRsSubjectDataRow["RST_on"]==1)){	?>		
			<?php
				    if(($ShowRsSubjectDataRow['RSD_Plan']==0 or $ShowRsSubjectDataRow['RSD_Plan']==$rc_IDPlan)){ ?>
					
			<!--##########################################################-->			
						<?php
							$SummerKeep=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
							$SummerKeep=$SummerKeep->CountSummerKeep();
							$SummerCount=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
							$SummerCount=$SummerCount->CountSummerCount();
						?>
			<!--##########################################################-->	
						<?php
							if((isset($SummerKeep,$SummerCount))){
								if(($SummerCount>=$SummerKeep)){ ?>
			<!--##########################################################-->
			<!--##########################################################-->				
									<div class="col-<?php echo $grid;?>-6">
										<div class="form-group">
											<label class="radio-inline">
												<input type="radio" class="styled" disabled="disabled" name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
												<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
											</label>			
										</div>
									</div>	
			<!--##########################################################-->	
				<script>
					$(document).ready(function (){
						$('#RSDno<?php echo $count_su;?>').on('click', function() {
							var RSDno=$("#RSDno<?php echo $count_su;?>").val();
							var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
							var RSYear="<?php echo $data_summer;?>";
							var RSKey="<?php echo $user_login;?>";
							var RSClass="<?php echo $call_stu->IDLevel;?>";
							var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
							var StudentID="<?php echo $user_login;?>";
							var StudentName="<?php echo $myname;?>";					
							swal({
								title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
								text:  "กิจกรรม : "+RSDnoName,
								type: "warning",
								showCancelButton: true,
								confirmButtonColor: "#EF5350",
								confirmButtonText: "ใช่ ยืนยันการลงทะเบียน",
								cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
								closeOnConfirm: false,
								closeOnCancel: false
							},
							function(isConfirm){
								if (isConfirm) {
									if(RSDno==""){
										swal({
											title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
											text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
											confirmButtonColor: "#66BB6A",
											type: "error"
										});							
									}else{
										swal({
											title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
											text:  "กิจกรรม : "+RSDnoName,
											confirmButtonColor: "#66BB6A",
											type: "success"
										},function(){
											$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
												RSD_no:RSDno,
												RSD_noName:RSDnoName,
												RS_Year:RSYear,
												RS_Key:RSKey,
												RS_Class:RSClass,
												RS_Est:RSEst,
												Student_ID:StudentID,
												Student_Name:StudentName										
											},function(){
												document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
											})
										});							
									}

								}
								else {
									swal({
										title: "ยกเลิกการลงทะเบียน",
										text: "เลือกรายการกิจกรรมที่สนใจ",
										confirmButtonColor: "#2196F3",
										type: "error"
									});
								}
							});
						});			
					})	
				</script>
			<!--##########################################################-->	
			<!--##########################################################-->							
						<?php	}else{	?>
			<!--##########################################################-->	
			<!--##########################################################-->				
									<div class="col-<?php echo $grid;?>-6">
										<div class="form-group">
											<label class="radio-inline">
												<input type="radio" class="styled"  name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
												<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
											</label>			
										</div>
									</div>	
			<!--##########################################################-->	
				<script>
					$(document).ready(function (){
						$('#RSDno<?php echo $count_su;?>').on('click', function() {
							var RSDno=$("#RSDno<?php echo $count_su;?>").val();
							var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
							var RSYear="<?php echo $data_summer;?>";
							var RSKey="<?php echo $user_login;?>";
							var RSClass="<?php echo $call_stu->IDLevel;?>";
							var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
							var StudentID="<?php echo $user_login;?>";
							var StudentName="<?php echo $myname;?>";					
							swal({
								title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
								text:  "กิจกรรม : "+RSDnoName,
								type: "warning",
								showCancelButton: true,
								confirmButtonColor: "#EF5350",
								confirmButtonText: "ใช่ ยืนยันการลงทะเบียน",
								cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
								closeOnConfirm: false,
								closeOnCancel: false
							},
							function(isConfirm){
								if (isConfirm) {
									if(RSDno==""){
										swal({
											title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
											text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
											confirmButtonColor: "#66BB6A",
											type: "error"
										});							
									}else{
										swal({
											title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
											text:  "กิจกรรม : "+RSDnoName,
											confirmButtonColor: "#66BB6A",
											type: "success"
										},function(){
											$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
												RSD_no:RSDno,
												RSD_noName:RSDnoName,
												RS_Year:RSYear,
												RS_Key:RSKey,
												RS_Class:RSClass,
												RS_Est:RSEst,
												Student_ID:StudentID,
												Student_Name:StudentName
											},function(){
												document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
											})
										});							
									}

								}
								else {
									swal({
										title: "ยกเลิกการลงทะเบียน",
										text: "เลือกรายการกิจกรรมที่สนใจ",
										confirmButtonColor: "#2196F3",
										type: "error"
									});
								}
							});
						});			
					})	
				</script>
			<!--##########################################################-->	
			<!--##########################################################-->							
						<?php	}
							}else{}
						?>
			
			
			
				<?php $count_su=$count_su+1; ?>	
				
			<?php	}else{}?>
	
		
		
		<?php	}else{} ?>
								
	<?php	} ?>		
	</form>								
						</div>
					</div>		
				</div>
			</div>	
		</div>
	<!--##########################################################-->					
				<?php	}else{ ?>
	<!--##########################################################-->	
		<?php
			$StatusPaySummerData= new StatusPaySummer($user_login,$data_summer);

				if(($StatusPaySummerData->SPS_RMD_on==1)){	  ?>
				
		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<span class="text-semibold" style="text-shadow: 0 0 0.2em #F87, 0 0 0.2em #F87; font-size: 20px;"><?php echo $StatusPaySummerData->SPS_RMD_txt;?></span>
			</div>	
		</div>
	</div><br>		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-info">
				<div class="panel-heading">รายการลงทะเบียนเรียนเสริมภาคฤดูร้อน</div>
			</div>	
		</div>
	</div>	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr class="success">
							<th><div>#</div></th>
							<th><div>รหัสวิชา / กิจกรรม</div></th>
							<th><div>รายการวิชา / กิจกรรม</div></th>
						</tr>
					</thead>
					<tbody>

	<?php
			$CSD_Count=1;
			$CSD_Sumpay=0;
			$CallSummerData=new PrintSummerData($user_login,$data_summer);
			foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
						<tr class="info">
							<td><div><?php echo $CSD_Count;?></div></td>
							<td><div><?php echo $CallSummerDataRow["RSD_no"];?></div></td>
							<td><div><?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
						</tr>		
	<?php		$CSD_Count=$CSD_Count+1;
				$CSD_Sumpay=$CSD_Sumpay+$CallSummerDataRow["RSP_price"];
			} ?>						

					</tbody>
				</table>
			</div>	
		</div>
	</div><hr>	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
	<form name="print_rc_summer" action="<?php echo base_url();?>rcprint/print_summer/<?php echo $user_login;?>" method="post" target="_blank">
		<div class="panel panel-body border-top-teal">
			<div class="row">
				<div class="col-<?php echo $grid;?>-3">				
		<?php
//-----------------------------------------------------------------------------------
		//	include("view/database/class_pdo.php");    
			include("view/database/regina_student.php");
			include("view/function/pay_scb.php");
//-----------------------------------------------------------------------------------	
			$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
			$stu_data=new regina_stu_data($user_login);	
//-----------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------		
			$class=$data_stu->IDLevel;
			$class_ex=$data_stu->Sort_name_E2;
			$txt_billerId="099400043439110";
			$txt_ref1=strtoupper($user_login."L".$class_ex);
			$txt_ref2=strtoupper("SUMMER".$data_term."0Y".$data_yaer);
			$txt_amount=number_format($CSD_Sumpay, 2, '.', '');                                                   
			$txt_width="104";
			$payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
		?>		
				
				<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="104" height="104"></div>
				<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
				<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
				<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
				<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($CSD_Sumpay, 2, '.', ',');?></div>				
				
				</div>
				<div class="col-<?php echo $grid;?>-3">
					<button type="submit" class="btn btn-success">พิมพ์ใบชำระเงิน&nbsp;ค่าลงทะเบียน</button>
				</div>
				
				<div class="col-<?php echo $grid;?>-3">
	
	<script>
		$(document).ready(function(){
            $("#SaveQRCodeC").on('click',function(){
                var ImageB = '<?php echo $payqrcode->call_qrcode_scb();?>';
                var a = document.createElement('a');
                a.href = ImageB;
                a.download = ImageB.substr(ImageB.lastIndexOf('/') + 1);
                window.win = open(a);
                setTimeout('win.document.execCommand("SaveAs")', 0);	
            })
		})
	</script>			
				
					<button type="button" name="SaveQRCodeC" id="SaveQRCodeC" class="btn btn-default"><i class="icon-qrcode position-left"></i> Save QRCode</button>
				
				</div>				
				
				<div class="col-<?php echo $grid;?>-3">
				
					<button type="button" class="btn btn-info" id="sweet_loader">ยกเลิกการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</button>				

				</div>
			</div>
			<input type="hidden" name="data_summer" value="<?php echo $data_summer;?>">
			<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
			<input type="hidden" name="data_term" value="<?php echo $data_term;?>">
			<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
		</div>
	</form>
		</div>
	</div>	
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
			<script>
				$(document).ready(function (){
						var TimeAdd_runtime="<?php echo $TimeAdd_runtime;?>";
					$('#sweet_loader').on('click', function() {
						var URSCYear="<?php echo $data_yaer;?>";//ปีการศึกษา
						var URSCKey="<?php echo $user_login;?>";//
						var URSCTxtTh="<?php echo $CallSummerDataRow['RSD_txtTh'];?>";
						var URSCName="<?php echo $myname;?>";
						swal({
							title: "คุณต้องการยกเลิกหรือไม่",
							text: "<?php echo $CallSummerDataRow['RSD_txtTh'];?>",
							type: "info",
							showCancelButton: true,
							closeOnConfirm: false,
							confirmButtonColor: "#2196F3",
							showLoaderOnConfirm: true
						},function() {
							setTimeout(function() {
								if(TimeAdd_runtime=="OFF"){
									swal({
										title: "หมดเวลายกเลิกการลงทะเบียน",
										text: "ขออภัยไม่สามารถยกเลิกได้ เนื่องจากสิ้นสุดระยะเวลายกเลิกลงทะเบียน",
										confirmButtonColor: "#2196F3",
										type: "warning"
									});
								}else if(TimeAdd_runtime=="ON"){
									swal({
										title: "ยกเลิกสำเร็จ",
										confirmButtonColor: "#2196F3"
									},function (RunSummer){
										$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer_count.php",{
											URSC_Year:URSCYear,
											URSC_Key:URSCKey,
											URSC_Txtth:URSCTxtTh,
											URSC_Name:URSCName
										},function(RS){
											if(RS !=""){
												document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
											}else{}
										})
									});									
								}else{
									swal({
										title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
										//text: "เลือกรายการกิจกรรมที่สนใจ",
										confirmButtonColor: "#2196F3",
										type: "error"
									});									
								}
							}, 2000);
						});
					});					
				})
			</script>
		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<?php	}elseif(($StatusPaySummerData->SPS_RMD_on==2)){ ?>
		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-success alert-styled-left">
					<span class="text-semibold" style="text-shadow: 0 0 0.2em #8F7; font-size: 20px;"><?php echo $StatusPaySummerData->SPS_RMD_txt;?></span>
				</div>	
			</div>
		</div><br>	

		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-success">
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-info">
								<div class="panel-heading">รายการลงทะเบียนเรียนเสริมภาคฤดูร้อน</div>
							</div>	
						</div>
					</div>	
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr class="success">
												<th><div>#</div></th>
												<th><div>รหัสวิชา / กิจกรรม</div></th>
												<th><div>รายการวิชา / กิจกรรม</div></th>
											</tr>
										</thead>
										<tbody>

						<?php
								$CSD_Count=1;
								$CallSummerData=new PrintSummerData($user_login,$data_summer);
								foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
											<tr class="info">
												<td><div><?php echo $CSD_Count;?></div></td>
												<td><div><?php echo $CallSummerDataRow["RSD_no"];?></div></td>
												<td><div><?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
											</tr>		
						<?php	$CSD_Count=$CSD_Count+1;} ?>						

										</tbody>
									</table>
								</div>				
										
						</div>
					</div>				
				</div>
			</div>
		</div>

		

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
		if(($DeletePay_Sud=="Yes")){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php
		    if(($TimeAdd_runtime=="ON")){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if(($call_stu->IDLevel==31 or $call_stu->IDLevel==41)){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
	<form name="print_rc_summer" action="<?php echo base_url();?>rcprint/print_summer/<?php echo $user_login;?>" method="post" target="_blank">
		<div class="panel panel-body border-top-teal">
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<button type="submit" class="btn btn-success">พิมพ์ใบยืนยันการลงทะเบียน</button>
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<button type="button" class="btn btn-info" id="sweet_loader">ยกเลิกการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</button>
				</div>
			</div>
			<input type="hidden" name="data_summer" value="<?php echo $data_summer;?>">
			<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
			<input type="hidden" name="data_term" value="<?php echo $data_term;?>">
			<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
		</div>
	</form>
		</div>
	</div>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-teal">
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<button type="button" class="btn btn-info" id="sweet_loader">ยกเลิกการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</button>			
					</div>
				</div>
				<input type="hidden" name="data_summer" value="<?php echo $data_summer;?>">
				<input type="hidden" name="data_yaer" value="<?php  echo $data_yaer;?>">
				<input type="hidden" name="data_term" value="<?php  echo $data_term;?>">
				<input type="hidden" name="user_login" value="<?php  echo $user_login;?>">
			</div>
		</div>
	</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php   }?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
    <?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<?php
				if(($call_stu->IDLevel==31 or $call_stu->IDLevel==41)){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
	<form name="print_rc_summer" action="<?php echo base_url();?>rcprint/print_summer/<?php echo $user_login;?>" method="post" target="_blank">
		<div class="panel panel-body border-top-teal">
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<button type="submit" class="btn btn-success">พิมพ์ใบยืนยันการลงทะเบียน</button>
				</div>
			</div>
			<input type="hidden" name="data_summer" value="<?php echo $data_summer;?>">
			<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
			<input type="hidden" name="data_term" value="<?php echo $data_term;?>">
			<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
		</div>
	</form>
		</div>
	</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}else{} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php   }?>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php	}else{ ?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
		<!--
		<div class="panel panel-body border-top-teal">
			<div class="row">
				<div class="col-<?php //echo $grid;?>-12">
					<button type="button" class="btn btn-info" id="sweet_loader">ยกเลิกการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</button>			
				</div>
			</div>
			<input type="hidden" name="data_summer" value="<?php //echo $data_summer;?>">
			<input type="hidden" name="data_yaer" value="<?php //echo $data_yaer;?>">
			<input type="hidden" name="data_term" value="<?php //echo $data_term;?>">
			<input type="hidden" name="user_login" value="<?php //echo $user_login;?>">
		</div>
		-->
		</div>
	</div>		
<?php	} ?>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
			<script>
				$(document).ready(function (){
					$('#sweet_loader').on('click', function() {
						var URSCYear="<?php echo $data_yaer;?>";//ปีการศึกษา
						var URSCKey="<?php echo $user_login;?>";//
						var URSCTxtTh="<?php echo $CallSummerDataRow['RSD_txtTh'];?>";
						var URSCName="<?php echo $myname;?>";
						swal({
							title: "คุณต้องการยกเลิกหรือไม่",
							text: "<?php echo $CallSummerDataRow['RSD_txtTh'];?>",
							type: "info",
							showCancelButton: true,
							closeOnConfirm: false,
							confirmButtonColor: "#2196F3",
							showLoaderOnConfirm: true
						},
						function() {
							setTimeout(function() {
								swal({
									title: "ยกเลิกสำเร็จ",
									confirmButtonColor: "#2196F3"
								},function (RunSummer){
									$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer_count.php",{
										URSC_Year:URSCYear,
										URSC_Key:URSCKey,
										URSC_Txtth:URSCTxtTh,
										URSC_Name:URSCName
									},function(RS){
										if(RS !=""){
											document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
										}else{}
									})
								});
							}, 2000);
						});
					});					
					
				})
			</script>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<?php	}else{} ?>
	<!--##########################################################-->						
				<?php	}?>						
<!--##########################################################-->						
			<?php	}else{	?>
<!--##########################################################-->
	<?php
			if(($call_stu->IDLevel>=12 and $call_stu->IDLevel<=23)){ ?>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="panel panel-info">
						<div class="panel-heading">ภาคเช้า วิชาการ</div>
						<div class="panel-body">
							<ul>
								<li>ภาษาไทย</li>
								<li>คณิตศาสตร์</li>
								<li>วิทยาศาสตร์</li>
								<li>ภาษาอังกฤษ</li>
								<li>สังคมศึกษา</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
	<?php	}elseif(($call_stu->IDLevel>=31 and $call_stu->IDLevel<=33)){ ?>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="panel panel-info">
						<div class="panel-heading">ภาคเช้า วิชาการ</div>
						<div class="panel-body">
							<ul>
								<li>ภาษาไทย</li>
								<li>คณิตศาสตร์</li>
								<li>วิทยาศาสตร์</li>
								<li>ภาษาอังกฤษ</li>
								<li>สังคมศึกษา</li>
								<li>ภาษาอังกฤษเพื่อการสื่อสาร</li>
							</ul>
						</div>
					</div>
				</div>
			</div>			
	<?php	}elseif(($call_stu->IDLevel>=41 and $call_stu->IDLevel<=43)){ ?>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="panel panel-info">
						<div class="panel-heading">ภาคเช้า วิชาการ</div>
						<div class="panel-body">
							<ul>
								<li>จัดเรียนการสอนตามแผนการเรียน</li>
							</ul>
						</div>
					</div>
				</div>
			</div>			
	<?php	}else{}?>		
<!--##########################################################-->		
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
	<?php
			if(($call_stu->IDLevel>=12 and $call_stu->IDLevel<=43)){ ?>
					<div class="panel-heading">
						<div>ภาคบ่าย เรียนกิจกรรมตามความสนใจ</div>
						<div>กรุณาเลือกกิจกรรม...</div>
					</div>			
	<?php	}else{?>
					<div class="panel-heading">รายการกิจกรรมเรียนเสริมภาคฤดูร้อน</div>		
	<?php   } ?>	
					<div class="panel-body">
	<form class="form-horizontal">
					
						<div class="row">
	<?php
		$ShowRsSubjectData=new ShowRsSubjectData($data_summer,$call_stu->IDLevel);
			$count_su=0;
			foreach($ShowRsSubjectData->RunShowRsSubjectData() as $rc=>$ShowRsSubjectDataRow){ ?>
				
		<?php
				if(($ShowRsSubjectDataRow["RST_on"]==1)){	?>
				
				<?php
					    if(($ShowRsSubjectDataRow['RSD_Plan']==0 or $ShowRsSubjectDataRow['RSD_Plan']==$rc_IDPlan)){ ?>
						
				<!--##########################################################-->			
							<?php
								$SummerKeep=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
								$SummerKeep=$SummerKeep->CountSummerKeep();
								$SummerCount=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
								$SummerCount=$SummerCount->CountSummerCount();
							?>
				<!--##########################################################-->	
							<?php
								if((isset($SummerKeep,$SummerCount))){
									if(($SummerCount>=$SummerKeep)){ ?>
				<!--##########################################################-->	
										<div class="col-<?php echo $grid;?>-6">
											<div class="form-group">
												<label class="radio-inline">
													<input type="radio" class="styled"  disabled="disabled" name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
													<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
												</label>

											</div>
										</div>	
				<!--##########################################################-->	
					<script>
						$(document).ready(function (){
							$('#RSDno<?php echo $count_su;?>').on('click', function() {
								var RSDno=$("#RSDno<?php echo $count_su;?>").val();
								var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
								var RSYear="<?php echo $data_summer;?>";
								var RSKey="<?php echo $user_login;?>";
								var RSClass="<?php echo $call_stu->IDLevel;?>";
								var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
								var StudentID="<?php echo $user_login;?>";
								var StudentName="<?php echo $myname;?>";					
								swal({
									title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
									text:  "กิจกรรม : "+RSDnoName,
									type: "warning",
									showCancelButton: true,
									confirmButtonColor: "#EF5350",
									confirmButtonText: "ใช่ ยืนยันการลงทะเบียน",
									cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
									closeOnConfirm: false,
									closeOnCancel: false
								},
								function(isConfirm){
									if (isConfirm) {
										if(RSDno==""){
											swal({
												title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
												text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
												confirmButtonColor: "#66BB6A",
												type: "error"
											});							
										}else{
											swal({
												title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
												text:  "กิจกรรม : "+RSDnoName,
												confirmButtonColor: "#66BB6A",
												type: "success"
											},function(){
												$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
													RSD_no:RSDno,
													RSD_noName:RSDnoName,
													RS_Year:RSYear,
													RS_Key:RSKey,
													RS_Class:RSClass,
													RS_Est:RSEst,
													Student_ID:StudentID,
													Student_Name:StudentName										
												},function(){
													document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
												})
											});							
										}

									}
									else {
										swal({
											title: "ยกเลิกการลงทะเบียน",
											text: "เลือกรายการกิจกรรมที่สนใจ",
											confirmButtonColor: "#2196F3",
											type: "error"
										});
									}
								});
							});			
						})	
					</script>	
				<!--##########################################################-->							
							<?php	}else{	?>
				<!--##########################################################-->
										<div class="col-<?php echo $grid;?>-6">
											<div class="form-group">
												<label class="radio-inline">
													<input type="radio" class="styled"  name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
													<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
												</label>

											</div>
										</div>	
				<!--##########################################################-->	
					<script>
						$(document).ready(function (){
							$('#RSDno<?php echo $count_su;?>').on('click', function() {
								var RSDno=$("#RSDno<?php echo $count_su;?>").val();
								var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
								var RSYear="<?php echo $data_summer;?>";
								var RSKey="<?php echo $user_login;?>";
								var RSClass="<?php echo $call_stu->IDLevel;?>";
								var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
								var StudentID="<?php echo $user_login;?>";
								var StudentName="<?php echo $myname;?>";					
								swal({
									title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
									text:  "กิจกรรม : "+RSDnoName,
									type: "warning",
									showCancelButton: true,
									confirmButtonColor: "#EF5350",
									confirmButtonText: "ใช่ ยืนยันการลงทะเบียน",
									cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
									closeOnConfirm: false,
									closeOnCancel: false
								},
								function(isConfirm){
									if (isConfirm) {
										if(RSDno==""){
											swal({
												title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
												text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
												confirmButtonColor: "#66BB6A",
												type: "error"
											});							
										}else{
											swal({
												title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
												text:  "กิจกรรม : "+RSDnoName,
												confirmButtonColor: "#66BB6A",
												type: "success"
											},function(){
												$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
													RSD_no:RSDno,
													RSD_noName:RSDnoName,
													RS_Year:RSYear,
													RS_Key:RSKey,
													RS_Class:RSClass,
													RS_Est:RSEst,
													Student_ID:StudentID,
													Student_Name:StudentName										
												},function(){
													document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
												})
											});							
										}

									}
									else {
										swal({
											title: "ยกเลิกการลงทะเบียน",
											text: "เลือกรายการกิจกรรมที่สนใจ",
											confirmButtonColor: "#2196F3",
											type: "error"
										});
									}
								});
							});			
						})	
					</script>	
				<!--##########################################################-->							
							<?php	}
								}else{}?>
				<!--##########################################################-->
				<!--##########################################################-->	
					<?php $count_su=$count_su+1; ?>	
					
				<?php	}else{ ?>
	<!--<div class="row">
		<div class="col-<?php //echo $grid;?>-12">
			<div class="alert alert-danger alert-styled-left alert-bordered">			
				<span class="text-semibold">ไม่พบรายการข้อมูล...</span>
			</div>		
		</div>
	</div>-->						
				<?php   } ?>

		<?php	}else{} ?>
									
	<?php	} ?>		
	</form>								
						</div>
					</div>		
				</div>
			</div>	
		</div>
<!--##########################################################-->						
			<?php	}?>
<!--##########################################################-->					
		<?php	}else{ ?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">			
				<span class="text-semibold">การดำเนินการไม่ถูกต้องไม่สามารถดำเนินการได้...</span>
			</div>		
		</div>
	</div>			
			
		<?php   }?>		
<!--##########################################################-->				
<?php		}else{ ?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">			
				<span class="text-semibold">การดำเนินการไม่ถูกต้องไม่สามารถดำเนินการได้...</span>
			</div>		
		</div>
	</div>	
	
	  <?php } ?>
<!--##########################################################-->	
<?php   } ?>
<!--##########################################################-->
<!--##########################################################-->				
	<?php	}elseif(($call_stu->IDLevel=="-" or $call_stu->IDLevel==null)){ ?>
		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					ไม่สามารถ&nbsp;ดำเนินการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน&nbsp;ปีการศึกษา&nbsp;<?php echo $data_summer;?>&nbsp;ได้เนื่องข้อมูลไม่ถูกต้อง&nbsp;ติดต่อฝ่ายวิชาการ&nbsp;โทรศัพท์&nbsp;053-282395&nbsp;ต่อ&nbsp;121&nbsp;หรือ&nbsp;122
				</div>
			</div>
		</div>
	</div>		
		
	<?php   }else{
		
				if(($End4143_runtime=="OFF")){ ?>
	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					<div>&nbsp;สิ้นสุดระยะเวลาดำเนินการ&nbsp;ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน&nbsp;ปีการศึกษา&nbsp;<?php echo $data_summer;?>&nbsp;</div>
					<div>&nbsp;ติดต่อฝ่ายวิชาการ&nbsp;โทรศัพท์&nbsp;053-282395&nbsp;ต่อ&nbsp;121&nbsp;หรือ&nbsp;122&nbsp;(การเรียนการสอนเรียนเสริมภาคฤูดร้อน)</div>
					<div>&nbsp;ติดต่อฝ่ายกิจการนักเรียน&nbsp;โทรศัพท์&nbsp;053-282395&nbsp;ต่อ&nbsp;114&nbsp;(กิจกรรมเรียนเสริมภาคฤูดร้อน)</div>
				</div>
			</div>
		</div>
	</div>			
<!--Update coding by beer 14/03/2023-->
	<?php
		$StatusPaySummerData= new StatusPaySummer($user_login,$data_summer);
			if((@$StatusPaySummerData->SPS_RMD_on==1)){	  ?>

	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<span class="text-semibold" style="text-shadow: 0 0 0.2em #F87, 0 0 0.2em #F87; font-size: 20px;"><?php echo $StatusPaySummerData->SPS_RMD_txt;?></span>
			</div>	
		</div>
	</div><br>		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-info">
				<div class="panel-heading">รายการลงทะเบียนเรียนเสริมภาคฤดูร้อน</div>
			</div>	
		</div>
	</div>	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr class="success">
							<th><div>#</div></th>
							<th><div>รหัสวิชา / กิจกรรม</div></th>
							<th><div>รายการวิชา / กิจกรรม</div></th>
						</tr>
					</thead>
					<tbody>

	<?php
			$CSD_Count=1;
			$CSD_Sumpay=0;
			$CallSummerData=new PrintSummerData($user_login,$data_summer);
			foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
						<tr class="info">
							<td><div><?php echo $CSD_Count;?></div></td>
							<td><div><?php echo $CallSummerDataRow["RSD_no"];?></div></td>
							<td><div><?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
						</tr>		
	<?php		$CSD_Count=$CSD_Count+1;
				$CSD_Sumpay=$CSD_Sumpay+$CallSummerDataRow["RSP_price"];
			} ?>						

					</tbody>
				</table>
			</div>	
		</div>
	</div><hr>	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
	<form name="print_rc_summer" action="<?php echo base_url();?>rcprint/print_summer/<?php echo $user_login;?>" method="post" target="_blank">
		<div class="panel panel-body border-top-teal">
			<div class="row">
				<div class="col-<?php echo $grid;?>-3">				
		<?php
//-----------------------------------------------------------------------------------
			//include("view/database/class_pdo.php");    
			include("view/database/regina_student.php");
			include("view/function/pay_scb.php");
//-----------------------------------------------------------------------------------	
			$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
			$stu_data=new regina_stu_data($user_login);	
//-----------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------		
			$class=$data_stu->IDLevel;
			$class_ex=$data_stu->Sort_name_E2;
			$txt_billerId="099400043439110";
			$txt_ref1=strtoupper($user_login."L".$class_ex);
			$txt_ref2=strtoupper("SUMMER".$data_term."0Y".$data_yaer);
			$txt_amount=number_format($CSD_Sumpay, 2, '.', '');                                                   
			$txt_width="104";
			$payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
		?>		
				
					<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="104" height="104"></div>
					<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
					<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
					<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
					<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($CSD_Sumpay, 2, '.', ',');?></div>				
				
				</div>
				<div class="col-<?php echo $grid;?>-3">
					<button type="submit" class="btn btn-success">พิมพ์ใบชำระเงิน ค่าลงทะเบียน</button>
				</div>
				
				<div class="col-<?php echo $grid;?>-3">
	
	<script>
		$(document).ready(function(){
            $("#SaveQRCodeA").on('click',function(){
                var ImageB = '<?php echo $payqrcode->call_qrcode_scb();?>';
                var a = document.createElement('a');
                a.href = ImageB;
                a.download = ImageB.substr(ImageB.lastIndexOf('/') + 1);
                window.win = open(a);
                setTimeout('win.document.execCommand("SaveAs")', 0);	
            })
		})
	</script>			
				
					<button type="button" name="SaveQRCodeA" id="SaveQRCodeA" class="btn btn-default"><i class="icon-qrcode position-left"></i> Save QRCode</button>
				
				</div>
				
				<div class="col-<?php echo $grid;?>-3"></div>
			</div>
			<input type="hidden" name="data_summer" value="<?php echo $data_summer;?>">
			<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
			<input type="hidden" name="data_term" value="<?php echo $data_term;?>">
			<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
		</div>
	</form>
		</div>
	</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	}elseif((@$StatusPaySummerData->SPS_RMD_on==2)){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<span class="text-semibold" style="text-shadow: 0 0 0.2em #8F7; font-size: 20px;"><?php echo $StatusPaySummerData->SPS_RMD_txt;?></span>
			</div>	
		</div>
	</div><br>	

	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-success">
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="panel panel-info">
							<div class="panel-heading">รายการลงทะเบียนเรียนเสริมภาคฤดูร้อน</div>
						</div>	
					</div>
				</div>	
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr class="success">
											<th><div>#</div></th>
											<th><div>รหัสวิชา / กิจกรรม</div></th>
											<th><div>รายการวิชา / กิจกรรม</div></th>
										</tr>
									</thead>
									<tbody>
					<?php
							$CSD_Count=1;
							$CallSummerData=new PrintSummerData($user_login,$data_summer);
							foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
										<tr class="info">
											<td><div><?php echo $CSD_Count;?></div></td>
											<td><div><?php echo $CallSummerDataRow["RSD_no"];?></div></td>
											<td><div><?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
										</tr>		
					<?php	$CSD_Count=$CSD_Count+1;} ?>						

									</tbody>
								</table>
							</div>	
					</div>
				</div>			
			</div>
		</div>
	</div>
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php   } ?>
<!--Update coding by beer End -->			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			
	<?php		}else{ ?>
<!--##########################################################-->
<!--##########################################################-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4><span class="text-semibold">ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</span></h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=rc_summer" class="btn btn-link  text-size-small"><span>ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$End4143DateTime_Cr=date("Y-m-d H:i:s");
		$End4143DateTime_notrun=strtotime("2023-02-09 16:00:00");
		$End4143DateTime_run=strtotime($End4143DateTime_Cr);
//---------------------------------------------------------------------------------			
			if(($End4143DateTime_run>=$End4143DateTime_notrun)){
				$End4143Print_runtime="OFF";
			}else{
				$End4143Print_runtime="ON";
			}
//---------------------------------------------------------------------------------							
	?>


	<?php
		//$test_system="OFF";
		switch($test_system){
			case "ON": ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alpha-teal border-teal alert-styled-left">
					<div>ขออภัยในความสะดวก&nbsp;เจ้าหน้าที่&nbsp;ICT&nbsp;กำลังทดสอบระบบ... </div>
					<div>หากผู้ปกครองดำเนินการกรอกข้อมูล&nbsp;จะถือว่าดำเนินการไม่สำเร็จ</div>
				</div>
			</div>
		</div>
	</div>		
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	break;
			default:
	//---------------------------------------------------------------		
		}
	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<?php
	//time_add
	$TimeAddTime_Cr=date("Y-m-d H:i:s");
	$TimeAddTime_notrun=strtotime($time_add);
	$TimeAddTime_run=strtotime($TimeAddTime_Cr);
		if(($TimeAddTime_run>=$TimeAddTime_notrun)){
			$TimeAdd_runtime="OFF";
		}else{
			$TimeAdd_runtime="ON";
		}
	//time_add End	
?>

<?php
	//$OFFONDateTime=date("2023-01-19 08:00:00");
	//$OFFONDateTime=date("2021-07-24 08:00:00");
	$OFFONDateTime_Cr=date("Y-m-d H:i:s");
	$OFFONDateTime_notrun=strtotime($OFFONDateTime);
	$OFFONDateTime_run=strtotime($OFFONDateTime_Cr);
//+++++++++++++++23End	
		if(($OFFONDateTime_run>=$OFFONDateTime_notrun)){
			$OFFONPrint_runtime="ON";
		}else{
			$OFFONPrint_runtime="OFF"; 
		}
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
		if(($OFFONPrint_runtime=="OFF")){ ?>
<!--##########################################################-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					การลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน&nbsp;ปีการศึกษา&nbsp;<?php echo $data_summer;?>&nbsp;จะเริ่มลงทะเบียนตั้งแต่วันที่&nbsp;<?php echo date("Y-m-d H:i:s",strtotime($OFFONDateTime));?>&nbsp;เป็นต้นไป
				</div>
			</div>
		</div>
	</div>
<!--##########################################################-->
<?php	}elseif(($OFFONPrint_runtime=="ON")){	?>
<!--##########################################################-->
	<?php
		//$EndDateTime=date("2023-01-30 00:00:00");//สิ้นสุดระยะเวลาลงทะเบียน
		$EndDateTime_Cr=date("Y-m-d H:i:s");
		$EndDateTime_notrun=strtotime($EndDateTime);
		$EndDateTime_run=strtotime($EndDateTime_Cr);
//----------------------------------------------------------------			
			if(($EndDateTime_run>=$EndDateTime_notrun)){
				$EndPrint_runtime="OFF";
			}else{
				$EndPrint_runtime="ON";
			}
//----------------------------------------------------------------
//----------------------------------------------------------------			
			if(($EndPrint_runtime=="OFF")){	?>
<!--##########################################################-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					<div>&nbsp;สิ้นสุดระยะเวลาดำเนินการ&nbsp;ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน&nbsp;ปีการศึกษา&nbsp;<?php echo $data_summer;?>&nbsp;</div>
					<div>&nbsp;ติดต่อฝ่ายวิชาการ&nbsp;โทรศัพท์&nbsp;053-282395&nbsp;ต่อ&nbsp;121&nbsp;หรือ&nbsp;122&nbsp;(การเรียนการสอนเรียนเสริมภาคฤูดร้อน)</div>
					<div>&nbsp;ติดต่อฝ่ายกิจการนักเรียน&nbsp;โทรศัพท์&nbsp;053-282395&nbsp;ต่อ&nbsp;114&nbsp;(กิจกรรมเรียนเสริมภาคฤูดร้อน)</div>
				</div>
			</div>
		</div>
	</div>				
<!--Update coding by beer 14/03/2023-->
	<?php
		$StatusPaySummerData= new StatusPaySummer($user_login,$data_summer);
			if((@$StatusPaySummerData->SPS_RMD_on==1)){	  ?>

	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<span class="text-semibold" style="text-shadow: 0 0 0.2em #F87, 0 0 0.2em #F87; font-size: 20px;"><?php echo $StatusPaySummerData->SPS_RMD_txt;?></span>
			</div>	
		</div>
	</div><br>		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-info">
				<div class="panel-heading">รายการลงทะเบียนเรียนเสริมภาคฤดูร้อน</div>
			</div>	
		</div>
	</div>	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr class="success">
							<th><div>#</div></th>
							<th><div>รหัสวิชา / กิจกรรม</div></th>
							<th><div>รายการวิชา / กิจกรรม</div></th>
						</tr>
					</thead>
					<tbody>

	<?php
			$CSD_Count=1;
			$CSD_Sumpay=0;
			$CallSummerData=new PrintSummerData($user_login,$data_summer);
			foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
						<tr class="info">
							<td><div><?php echo $CSD_Count;?></div></td>
							<td><div><?php echo $CallSummerDataRow["RSD_no"];?></div></td>
							<td><div><?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
						</tr>		
	<?php		$CSD_Count=$CSD_Count+1;
				$CSD_Sumpay=$CSD_Sumpay+$CallSummerDataRow["RSP_price"];
			} ?>						

					</tbody>
				</table>
			</div>	
		</div>
	</div><hr>	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
	<form name="print_rc_summer" action="<?php echo base_url();?>rcprint/print_summer/<?php echo $user_login;?>" method="post" target="_blank">
		<div class="panel panel-body border-top-teal">
			<div class="row">
				<div class="col-<?php echo $grid;?>-3">				
		<?php
//-----------------------------------------------------------------------------------
			//include("view/database/class_pdo.php");    
			include("view/database/regina_student.php");
			include("view/function/pay_scb.php");
//-----------------------------------------------------------------------------------	
			$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
			$stu_data=new regina_stu_data($user_login);	
//-----------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------		
			$class=$data_stu->IDLevel;
			$class_ex=$data_stu->Sort_name_E2;
			$txt_billerId="099400043439110";
			$txt_ref1=strtoupper($user_login."L".$class_ex);
			$txt_ref2=strtoupper("SUMMER".$data_term."0Y".$data_yaer);
			$txt_amount=number_format($CSD_Sumpay, 2, '.', '');                                                   
			$txt_width="104";
			$payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
		?>		
				
					<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="104" height="104"></div>
					<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
					<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
					<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
					<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($CSD_Sumpay, 2, '.', ',');?></div>				
				
				</div>
				<div class="col-<?php echo $grid;?>-3">
					<button type="submit" class="btn btn-success">พิมพ์ใบชำระเงิน ค่าลงทะเบียน</button>
				</div>
				
				<div class="col-<?php echo $grid;?>-3">
	
	<script>
		$(document).ready(function(){
            $("#SaveQRCodeA").on('click',function(){
                var ImageB = '<?php echo $payqrcode->call_qrcode_scb();?>';
                var a = document.createElement('a');
                a.href = ImageB;
                a.download = ImageB.substr(ImageB.lastIndexOf('/') + 1);
                window.win = open(a);
                setTimeout('win.document.execCommand("SaveAs")', 0);	
            })
		})
	</script>			
				
					<button type="button" name="SaveQRCodeA" id="SaveQRCodeA" class="btn btn-default"><i class="icon-qrcode position-left"></i> Save QRCode</button>
				
				</div>
				
				<div class="col-<?php echo $grid;?>-3"></div>
			</div>
			<input type="hidden" name="data_summer" value="<?php echo $data_summer;?>">
			<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
			<input type="hidden" name="data_term" value="<?php echo $data_term;?>">
			<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
		</div>
	</form>
		</div>
	</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	}elseif((@$StatusPaySummerData->SPS_RMD_on==2)){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<span class="text-semibold" style="text-shadow: 0 0 0.2em #8F7; font-size: 20px;"><?php echo $StatusPaySummerData->SPS_RMD_txt;?></span>
			</div>	
		</div>
	</div><br>	

	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-success">
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="panel panel-info">
							<div class="panel-heading">รายการลงทะเบียนเรียนเสริมภาคฤดูร้อน</div>
						</div>	
					</div>
				</div>	
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr class="success">
											<th><div>#</div></th>
											<th><div>รหัสวิชา / กิจกรรม</div></th>
											<th><div>รายการวิชา / กิจกรรม</div></th>
										</tr>
									</thead>
									<tbody>
					<?php
							$CSD_Count=1;
							$CallSummerData=new PrintSummerData($user_login,$data_summer);
							foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
										<tr class="info">
											<td><div><?php echo $CSD_Count;?></div></td>
											<td><div><?php echo $CallSummerDataRow["RSD_no"];?></div></td>
											<td><div><?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
										</tr>		
					<?php	$CSD_Count=$CSD_Count+1;} ?>						

									</tbody>
								</table>
							</div>	
					</div>
				</div>			
			</div>
		</div>
	</div>
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php   } ?>
<!--Update coding by beer End 14/03/2023-->
<!--##########################################################-->				
<?php		}elseif(($EndPrint_runtime=="ON")){ ?>
<!--##########################################################-->
<!--##########################################################-->
	<?php
			if(($call_stu->IDLevel==41)){ ?>
<!--##########################################################-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning no-border">
				<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">กิจกรรม ช่วงบ่าย "(เพิ่ม 500)" </span>ต้องชำระค่าลงทะเบียนเพิ่ม 500 บาท ที่ห้องการเงิน
			</div>		
		</div>
	</div>
<!--##########################################################-->			
	<?php	}else{}?>
<!--##########################################################-->
<!--##########################################################-->
		<?php
			$ClassSummer=new SetClassSummer($call_stu->IDLevel);
			$StatusPaySummer=new StatusPaySummer($user_login,$data_summer);
			
				if(($ClassSummer->RunSetClassSummer()=="A")){	?>
<!--##########################################################-->		
			<?php
					if((isset($StatusPaySummer->SPS_RMD_on))){ ?>
<!--##########################################################-->
				<?php
						if(($StatusPaySummer->SPS_RMD_on==null or $StatusPaySummer->SPS_RMD_on==0)){	?>
<!--##########################################################-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">รายการกิจกรรมเรียนเสริมภาคฤดูร้อน</div>		
					<div class="panel-body">
	<form class="form-horizontal">
					
						<div class="row">
	<?php
		$ShowRsSubjectData=new ShowRsSubjectData($data_summer,$call_stu->IDLevel);
			$count_su=0;
			foreach($ShowRsSubjectData->RunShowRsSubjectData() as $rc=>$ShowRsSubjectDataRow){ ?>
							
	<!--##########################################################-->			
				<?php
					$SummerKeep=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
					$SummerKeep=$SummerKeep->CountSummerKeep();
					$SummerCount=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
					$SummerCount=$SummerCount->CountSummerCount();
					
				?>
	<!--##########################################################-->	
				<?php
					if((isset($SummerKeep,$SummerCount))){
						if(($SummerCount>=$SummerKeep)){ ?>
	<!--##########################################################-->	
	<!--##########################################################-->							
							<div class="col-<?php echo $grid;?>-12">
								<div class="form-group">
									<label class="radio-inline">
										<input type="radio" class="styled" disabled="disabled" name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
										<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
									</label>			
								</div>
							</div>	
	<!--##########################################################-->	
		<script>
			$(document).ready(function (){
				$('#RSDno<?php echo $count_su;?>').on('click', function() {
					var RSDno=$("#RSDno<?php echo $count_su;?>").val();
					var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
					var RSYear="<?php echo $data_summer;?>";
					var RSKey="<?php echo $user_login;?>";
					var RSClass="<?php echo $call_stu->IDLevel;?>";
					var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
					var StudentID="<?php echo $user_login;?>";
					var StudentName="<?php echo $myname;?>";
					swal({
						title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
						text:  "กิจกรรม : "+RSDnoName,
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#EF5350",
						confirmButtonText: "ใช้ ยืนยันการลงทะเบียน",
						cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
						closeOnConfirm: false,
						closeOnCancel: false
					},
					function(isConfirm){
						if (isConfirm) {
							if(RSDno==""){
								swal({
									title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
									text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
									confirmButtonColor: "#66BB6A",
									type: "error"
								});							
							}else{
								swal({
									title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
									text:  "กิจกรรม : "+RSDnoName,
									confirmButtonColor: "#66BB6A",
									type: "success"
								},function(){
									$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
										RSD_no:RSDno,
										RSD_noName:RSDnoName,
										RS_Year:RSYear,
										RS_Key:RSKey,
										RS_Class:RSClass,
										RS_Est:RSEst,
										Student_ID:StudentID,
										Student_Name:StudentName
									},function(){
										document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
									})
								});							
							}

						}
						else {
							swal({
								title: "ยกเลิกการลงทะเบียน",
								text: "เลือกรายการกิจกรรมที่สนใจ",
								confirmButtonColor: "#2196F3",
								type: "error"
							});
						}
					});
				});			
			})	
		</script>
<!--##########################################################-->	
<!--##########################################################-->							
				<?php	}else{	?>
<!--##########################################################-->	
<!--##########################################################-->			
					<?php
						$SummerKeep=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
						$SummerKeep=$SummerKeep->CountSummerKeep();
						$SummerCount=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
						$SummerCount=$SummerCount->CountSummerCount();
					?>
<!--##########################################################-->
					<?php
							if(($SummerCount>=$SummerKeep)){ ?>
<!--##########################################################-->
<!--##########################################################-->							
							<div class="col-<?php echo $grid;?>-12">
								<div class="form-group">
									<label class="radio-inline">
										<input type="radio" class="styled" disabled="disabled" name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
										<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
									</label>			
								</div>
							</div>	
	<!--##########################################################-->	
		<script>
			$(document).ready(function (){
				$('#RSDno<?php echo $count_su;?>').on('click', function() {
					var RSDno=$("#RSDno<?php echo $count_su;?>").val();
					var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
					var RSYear="<?php echo $data_summer;?>";
					var RSKey="<?php echo $user_login;?>";
					var RSClass="<?php echo $call_stu->IDLevel;?>";
					var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
					var StudentID="<?php echo $user_login;?>";
					var StudentName="<?php echo $myname;?>";
					swal({
						title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
						text:  "กิจกรรม : "+RSDnoName,
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#EF5350",
						confirmButtonText: "ใช้ ยืนยันการลงทะเบียน",
						cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
						closeOnConfirm: false,
						closeOnCancel: false
					},
					function(isConfirm){
						if(isConfirm){
							if(RSDno==""){
								swal({
									title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
									text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
									confirmButtonColor: "#66BB6A",
									type: "error"
								});							
							}else{
								swal({
									title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
									text:  "กิจกรรม : "+RSDnoName,
									confirmButtonColor: "#66BB6A",
									type: "success"
								},function(){
									$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
										RSD_no:RSDno,
										RSD_noName:RSDnoName,
										RS_Year:RSYear,
										RS_Key:RSKey,
										RS_Class:RSClass,
										RS_Est:RSEst,
										Student_ID:StudentID,
										Student_Name:StudentName
									},function(){
										document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
									})
								});							
							}
						}else{
							swal({
								title: "ยกเลิกการลงทะเบียน",
								text: "เลือกรายการกิจกรรมที่สนใจ",
								confirmButtonColor: "#2196F3",
								type: "error"
							});
						}
					});
				});			
			})	
		</script>
<!--##########################################################-->							
<!--##########################################################-->							
					<?php	}else{	?>
<!--##########################################################-->
<!--##########################################################-->							
							<div class="col-<?php echo $grid;?>-12">
								<div class="form-group">
									<label class="radio-inline">
										<input type="radio" class="styled"  name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
										<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
									</label>			
								</div>
							</div>	
	<!--##########################################################-->	
		<script>
			$(document).ready(function (){
				$('#RSDno<?php echo $count_su;?>').on('click', function() {
					var RSDno=$("#RSDno<?php echo $count_su;?>").val();
					var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
					var RSYear="<?php echo $data_summer;?>";
					var RSKey="<?php echo $user_login;?>";
					var RSClass="<?php echo $call_stu->IDLevel;?>";
					var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
				    var StudentID="<?php echo $user_login;?>";
					var StudentName="<?php echo $myname;?>";
					swal({
						title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
						text:  "กิจกรรม : "+RSDnoName,
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#EF5350",
						confirmButtonText: "ใช้ ยืนยันการลงทะเบียน",
						cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
						closeOnConfirm: false,
						closeOnCancel: false
					},
					function(isConfirm){
						if (isConfirm) {
							if(RSDno==""){
								swal({
									title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
									text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
									confirmButtonColor: "#66BB6A",
									type: "error"
								});							
							}else{
								swal({
									title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
									text:  "กิจกรรม : "+RSDnoName,
									confirmButtonColor: "#66BB6A",
									type: "success"
								},function(){
									$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
										RSD_no:RSDno,
										RSD_noName:RSDnoName,
										RS_Year:RSYear,
										RS_Key:RSKey,
										RS_Class:RSClass,
										RS_Est:RSEst,
										Student_ID:StudentID,
										Student_Name:StudentName
									},function(){
										document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
									})
								});							
							}

						}
						else {
							swal({
								title: "ยกเลิกการลงทะเบียน",
								text: "เลือกรายการกิจกรรมที่สนใจ",
								confirmButtonColor: "#2196F3",
								type: "error"
							});
						}
					});
				});			
			})	
		</script>
<!--##########################################################-->							
<!--##########################################################-->							
					<?php	} ?>

	
<!--##########################################################-->						
				<?php	}
					}else{ ?>
	<!--<div class="row">
		<div class="col-<?php //echo $grid;?>-12">
			<div class="alert alert-danger alert-styled-left alert-bordered">			
				<span class="text-semibold">ไม่พบรายการข้อมูล...</span>
			</div>		
		</div>
	</div>-->						
			<?php	} ?>


					
	<?php	$count_su=$count_su+1;
			} ?>		
	</form>								
						</div>
					</div>		
				</div>
			</div>
		</div>		
<!--##########################################################-->					
				<?php	}else{ ?>
	<!--##########################################################-->	
	<?php
		$StatusPaySummerData= new StatusPaySummer($user_login,$data_summer);
			if(($StatusPaySummerData->SPS_RMD_on==1)){	  ?>

	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<span class="text-semibold" style="text-shadow: 0 0 0.2em #F87, 0 0 0.2em #F87; font-size: 20px;"><?php echo $StatusPaySummerData->SPS_RMD_txt;?></span>
			</div>	
		</div>
	</div><br>		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-info">
				<div class="panel-heading">รายการลงทะเบียนเรียนเสริมภาคฤดูร้อน</div>
			</div>	
		</div>
	</div>	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr class="success">
							<th><div>#</div></th>
							<th><div>รหัสวิชา / กิจกรรม</div></th>
							<th><div>รายการวิชา / กิจกรรม</div></th>
						</tr>
					</thead>
					<tbody>

	<?php
			$CSD_Count=1;
			$CSD_Sumpay=0;
			$CallSummerData=new PrintSummerData($user_login,$data_summer);
			foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
						<tr class="info">
							<td><div><?php echo $CSD_Count;?></div></td>
							<td><div><?php echo $CallSummerDataRow["RSD_no"];?></div></td>
							<td><div><?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
						</tr>		
	<?php		$CSD_Count=$CSD_Count+1;
				$CSD_Sumpay=$CSD_Sumpay+$CallSummerDataRow["RSP_price"];
			} ?>						

					</tbody>
				</table>
			</div>	
		</div>
	</div><hr>	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
	<form name="print_rc_summer" action="<?php echo base_url();?>rcprint/print_summer/<?php echo $user_login;?>" method="post" target="_blank">
		<div class="panel panel-body border-top-teal">
			<div class="row">
				<div class="col-<?php echo $grid;?>-3">				
		<?php
//-----------------------------------------------------------------------------------
			//include("view/database/class_pdo.php");    
			include("view/database/regina_student.php");
			include("view/function/pay_scb.php");
//-----------------------------------------------------------------------------------	
			$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
			$stu_data=new regina_stu_data($user_login);	
//-----------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------		
			$class=$data_stu->IDLevel;
			$class_ex=$data_stu->Sort_name_E2;
			$txt_billerId="099400043439110";
			$txt_ref1=strtoupper($user_login."L".$class_ex);
			$txt_ref2=strtoupper("SUMMER".$data_term."0Y".$data_yaer);
			$txt_amount=number_format($CSD_Sumpay, 2, '.', '');                                                   
			$txt_width="104";
			$payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
		?>		
				
				<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="104" height="104"></div>
				<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
				<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
				<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
				<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($CSD_Sumpay, 2, '.', ',');?></div>				
				
				</div>
				<div class="col-<?php echo $grid;?>-3">
					<button type="submit" class="btn btn-success">พิมพ์ใบชำระเงิน ค่าลงทะเบียน123</button>
				</div>
				
				<div class="col-<?php echo $grid;?>-3">
	
	<script>
		$(document).ready(function(){
            $("#SaveQRCodeD").on('click',function(){
                var ImageB = '<?php echo $payqrcode->call_qrcode_scb();?>';
                var a = document.createElement('a');
                a.href = ImageB;
                a.download = ImageB.substr(ImageB.lastIndexOf('/') + 1);
                window.win = open(a);
                setTimeout('win.document.execCommand("SaveAs")', 0);	
            })
		})
	</script>			
				
					<button type="button" name="SaveQRCodeD" id="SaveQRCodeD" class="btn btn-default"><i class="icon-qrcode position-left"></i> Save QRCode</button>
				
				</div>				
				
				<div class="col-<?php echo $grid;?>-3">
				
					<button type="button" class="btn btn-info" id="sweet_loader">ยกเลิกการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</button>				
	
				</div>
			</div>
			<input type="hidden" name="data_summer" value="<?php echo $data_summer;?>">
			<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
			<input type="hidden" name="data_term" value="<?php echo $data_term;?>">
			<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
		</div>
	</form>
		</div>
	</div>	
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
			<script>
				$(document).ready(function (){
						var TimeAdd_runtime="<?php echo $TimeAdd_runtime;?>";
					$('#sweet_loader').on('click', function() {
						var URSCYear="<?php echo $data_yaer;?>";//ปีการศึกษา
						var URSCKey="<?php echo $user_login;?>";//
						var URSCTxtTh="<?php echo $CallSummerDataRow['RSD_txtTh'];?>";
						var URSCName="<?php echo $myname;?>";
						swal({
							title: "คุณต้องการยกเลิกหรือไม่",
							text: "<?php echo $CallSummerDataRow['RSD_txtTh'];?>",
							type: "info",
							showCancelButton: true,
							closeOnConfirm: false,
							confirmButtonColor: "#2196F3",
							showLoaderOnConfirm: true
						},function() {
							setTimeout(function() {
								if(TimeAdd_runtime=="OFF"){
									swal({
										title: "หมดเวลายกเลิกการลงทะเบียน",
										text: "ขออภัยไม่สามารถยกเลิกได้ เนื่องจากสิ้นสุดระยะเวลายกเลิกลงทะเบียน",
										confirmButtonColor: "#2196F3",
										type: "warning"
									});
								}else if(TimeAdd_runtime=="ON"){
									swal({
										title: "ยกเลิกสำเร็จ",
										confirmButtonColor: "#2196F3"
									},function (RunSummer){
										$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer_count.php",{
											URSC_Year:URSCYear,
											URSC_Key:URSCKey,
											URSC_Txtth:URSCTxtTh,
											URSC_Name:URSCName
										},function(RS){
											if(RS !=""){
												document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
											}else{}
										})
									});									
								}else{
									swal({
										title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
										//text: "เลือกรายการกิจกรรมที่สนใจ",
										confirmButtonColor: "#2196F3",
										type: "error"
									});									
								}
							}, 2000);
						});
					});					
				})
			</script>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	}elseif(($StatusPaySummerData->SPS_RMD_on==2)){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<span class="text-semibold" style="text-shadow: 0 0 0.2em #8F7; font-size: 20px;"><?php echo $StatusPaySummerData->SPS_RMD_txt;?></span>
			</div>	
		</div>
	</div><br>	

	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-success">
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="panel panel-info">
							<div class="panel-heading">รายการลงทะเบียนเรียนเสริมภาคฤดูร้อน</div>
						</div>	
					</div>
				</div>	
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr class="success">
											<th><div>#</div></th>
											<th><div>รหัสวิชา / กิจกรรม</div></th>
											<th><div>รายการวิชา / กิจกรรม</div></th>
										</tr>
									</thead>
									<tbody>
					<?php
							$CSD_Count=1;
							$CallSummerData=new PrintSummerData($user_login,$data_summer);
							foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
										<tr class="info">
											<td><div><?php echo $CSD_Count;?></div></td>
											<td><div><?php echo $CallSummerDataRow["RSD_no"];?></div></td>
											<td><div><?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
										</tr>		
					<?php	$CSD_Count=$CSD_Count+1;} ?>						

									</tbody>
								</table>
							</div>	
					</div>
				</div>			
			</div>
		</div>
	</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
			if(($DeletePay_Sud=="Yes")){ ?>
			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if(($TimeAdd_runtime=="ON")){ ?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-teal">
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<button type="button" class="btn btn-info" id="sweet_loader">ยกเลิกการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</button>			
					</div>
				</div>
				<input type="hidden" name="data_summer" value="<?php echo $data_summer;?>">
				<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
				<input type="hidden" name="data_term" value="<?php echo $data_term;?>">
				<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
			</div>
		</div>
	</div>				
		<?php	}else{} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
	<?php	}else{ ?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
		<!--
			<div class="panel panel-body border-top-teal">
				<div class="row">
					<div class="col-<?php //echo $grid;?>-12">
						<button type="button" class="btn btn-info" id="sweet_loader">ยกเลิกการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</button>			
					</div>
				</div>
				<input type="hidden" name="data_summer" value="<?php //echo $data_summer;?>">
				<input type="hidden" name="data_yaer" value="<?php //echo $data_yaer;?>">
				<input type="hidden" name="data_term" value="<?php //echo $data_term;?>">
				<input type="hidden" name="user_login" value="<?php //echo $user_login;?>">
			</div>
		-->
		</div>
	</div>				
	<?php	} ?>
	

	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
			<script>
				$(document).ready(function (){
					$('#sweet_loader').on('click', function() {
						var URSCYear="<?php echo $data_yaer;?>";//ปีการศึกษา
						var URSCKey="<?php echo $user_login;?>";//
						var URSCTxtTh="<?php echo $CallSummerDataRow['RSD_txtTh'];?>";
						var URSCName="<?php echo $myname;?>";
						swal({
							title: "คุณต้องการยกเลิกหรือไม่",
							text: "<?php echo $CallSummerDataRow['RSD_txtTh'];?>",
							type: "info",
							showCancelButton: true,
							closeOnConfirm: false,
							confirmButtonColor: "#2196F3",
							showLoaderOnConfirm: true
						},
						function() {
							setTimeout(function() {
								swal({
									title: "ยกเลิกสำเร็จ",
									confirmButtonColor: "#2196F3"
								},function (RunSummer){
									$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer_count.php",{
										URSC_Year:URSCYear,
										URSC_Key:URSCKey,
										URSC_Txtth:URSCTxtTh,
										URSC_Name:URSCName
									},function(RS){
										if(RS !=""){
											document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
										}else{}
									})
								});
							}, 2000);
						});
					});					
					
				})
			</script>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	}else{ ?>
	
	<?php   } ?>				
	<!--##########################################################-->						
				<?php	}?>				
<!--##########################################################-->				
			<?php	}else{ ?>
<!--##########################################################-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">รายการกิจกรรมเรียนเสริมภาคฤดูร้อน</div>
					<div class="panel-body">
	<form class="form-horizontal">
					
						<div class="row">
	<?php
		$ShowRsSubjectData=new ShowRsSubjectData($data_summer,$call_stu->IDLevel);
			$count_su=0;
			foreach($ShowRsSubjectData->RunShowRsSubjectData() as $rc=>$ShowRsSubjectDataRow){ ?>
							
<!--##########################################################-->			
				<?php
					$SummerKeep=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
					$SummerKeep=$SummerKeep->CountSummerKeep();
					$SummerCount=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
					$SummerCount=$SummerCount->CountSummerCount();
				?>
<!--##########################################################-->	
				<?php
						if(($SummerCount>=$SummerKeep)){	?>
<!--##########################################################-->	
<!--##########################################################-->							
							
							<div class="col-<?php echo $grid;?>-12">
								<div class="form-group">
									<label class="radio-inline">
										<input type="radio" class="styled" disabled="disabled" name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
										<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
									</label>			
								</div>
							</div>	
							
							
							
	<!--##########################################################-->	
		<script>
			$(document).ready(function (){
				$('#RSDno<?php echo $count_su;?>').on('click', function() {
					var RSDno=$("#RSDno<?php echo $count_su;?>").val();
					var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
					var RSYear="<?php echo $data_summer;?>";
					var RSKey="<?php echo $user_login;?>";
					var RSClass="<?php echo $call_stu->IDLevel;?>";
					var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
					var StudentID="<?php echo $user_login;?>";
					var StudentName="<?php echo $myname;?>";
					swal({
						title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
						text:  "กิจกรรม : "+RSDnoName,
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#EF5350",
						confirmButtonText: "ใช่ ยืนยันการลงทะเบียน",
						cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
						closeOnConfirm: false,
						closeOnCancel: false
					},
					function(isConfirm){
						if (isConfirm) {
							if(RSDno==""){
								swal({
									title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
									text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
									confirmButtonColor: "#66BB6A",
									type: "error"
								});							
							}else{
								swal({
									title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
									text:  "กิจกรรม : "+RSDnoName,
									confirmButtonColor: "#66BB6A",
									type: "success"
								},function(){
									$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
										RSD_no:RSDno,
										RSD_noName:RSDnoName,
										RS_Year:RSYear,
										RS_Key:RSKey,
										RS_Class:RSClass,
										RS_Est:RSEst,
										Student_ID:StudentID,
										Student_Name:StudentName
									},function(){
										document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
									})
								});							
							}

						}else{
							swal({
								title: "ยกเลิกการลงทะเบียน",
								text: "เลือกรายการกิจกรรมที่สนใจ",
								confirmButtonColor: "#2196F3",
								type: "error"
							});
						}
					});
				});			
			})	
		</script>
<!--##########################################################-->					
<!--##########################################################-->						
				<?php	}else{ ?>
<!--##########################################################-->
<!--##########################################################-->							
							
							<div class="col-<?php echo $grid;?>-12">
								<div class="form-group">
									<label class="radio-inline">
										<input type="radio" class="styled"  name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
										<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
									</label>			
								</div>
							</div>	
							
							
							
	<!--##########################################################-->	
		<script>
			$(document).ready(function (){
				$('#RSDno<?php echo $count_su;?>').on('click', function() {
					var RSDno=$("#RSDno<?php echo $count_su;?>").val();
					var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
					var RSYear="<?php echo $data_summer;?>";
					var RSKey="<?php echo $user_login;?>";
					var RSClass="<?php echo $call_stu->IDLevel;?>";
					var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
					var StudentID="<?php echo $user_login;?>";
					var StudentName="<?php echo $myname;?>";
					swal({
						title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
						text:  "กิจกรรม : "+RSDnoName,
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#EF5350",
						confirmButtonText: "ใช้ ยืนยันการลงทะเบียน",
						cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
						closeOnConfirm: false,
						closeOnCancel: false
					},
					function(isConfirm){
						if (isConfirm) {
							if(RSDno==""){
								swal({
									title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
									text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
									confirmButtonColor: "#66BB6A",
									type: "error"
								});							
							}else{
								swal({
									title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
									text:  "กิจกรรม : "+RSDnoName,
									confirmButtonColor: "#66BB6A",
									type: "success"
								},function(){
									$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
										RSD_no:RSDno,
										RSD_noName:RSDnoName,
										RS_Year:RSYear,
										RS_Key:RSKey,
										RS_Class:RSClass,
										RS_Est:RSEst,
										Student_ID:StudentID,
										Student_Name:StudentName
									},function(){
										document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
									})
								});							
							}

						}
						else {
							swal({
								title: "ยกเลิกการลงทะเบียน",
								text: "เลือกรายการกิจกรรมที่สนใจ",
								confirmButtonColor: "#2196F3",
								type: "error"
							});
						}
					});
				});			
			})	
		</script>
<!--##########################################################-->
<!--##########################################################-->						
				<?php	}      ?>
					
	<?php	$count_su=$count_su+1;
			} ?>		
	</form>								
						</div>
					</div>		
				</div>
			</div>
		</div>		
<!--##########################################################-->				
			<?php	}?>
<!--##########################################################-->					
		<?php	}elseif(($ClassSummer->RunSetClassSummer()=="B")){ ?>
<!--##########################################################-->
			<?php
					if((isset($StatusPaySummer->SPS_RMD_on))){ ?>
<!--##########################################################-->	
				<?php
						if(($StatusPaySummer->SPS_RMD_on==null or $StatusPaySummer->SPS_RMD_on==0)){	?>
<!--##########################################################-->
	<?php
			if(($call_stu->IDLevel>=12 and $call_stu->IDLevel<=23)){ ?>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="panel panel-info">
						<div class="panel-heading">ภาคเช้า วิชาการ</div>
						<div class="panel-body">
							<ul>
								<li>ภาษาไทย</li>
								<li>คณิตศาสตร์</li>
								<li>วิทยาศาสตร์</li>
								<li>ภาษาอังกฤษ</li>
								<li>สังคมศึกษา</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
	<?php	}elseif(($call_stu->IDLevel>=31 and $call_stu->IDLevel<=33)){ ?>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="panel panel-info">
						<div class="panel-heading">ภาคเช้า วิชาการ</div>
						<div class="panel-body">
							<ul>
								<li>ภาษาไทย</li>
								<li>คณิตศาสตร์</li>
								<li>วิทยาศาสตร์</li>
								<li>ภาษาอังกฤษ</li>
								<li>สังคมศึกษา</li>
								<li>ภาษาอังกฤษเพื่อการสื่อสาร</li>
							</ul>
						</div>
					</div>
				</div>
			</div>			
	<?php	}elseif(($call_stu->IDLevel>=41 and $call_stu->IDLevel<=43)){ ?>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="panel panel-info">
						<div class="panel-heading">ภาคเช้า วิชาการ</div>
						<div class="panel-body">
							<ul>
								<li>จัดเรียนการสอนตามแผนการเรียน</li>
							</ul>
						</div>
					</div>
				</div>
			</div>			
	<?php	}else{}?>	
<!--##########################################################-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
	<?php
			if(($call_stu->IDLevel>=12 and $call_stu->IDLevel<=43)){ ?>
					<div class="panel-heading">
						<div>ภาคบ่าย เรียนกิจกรรมตามความสนใจ</div>
						<div>กรุณาเลือกกิจกรรม...</div>
					</div>			
	<?php	}else{?>
					<div class="panel-heading">รายการกิจกรรมเรียนเสริมภาคฤดูร้อน</div>		
	<?php   } ?>				
					<div class="panel-body">
	<form class="form-horizontal">
					
						<div class="row">
	<?php
		$ShowRsSubjectData=new ShowRsSubjectData($data_summer,$call_stu->IDLevel);
			$count_su=0;
			foreach($ShowRsSubjectData->RunShowRsSubjectData() as $rc=>$ShowRsSubjectDataRow){ ?>
				
		<?php
				if(($ShowRsSubjectDataRow["RST_on"]==1)){	?>		
			<?php
				    if(($ShowRsSubjectDataRow['RSD_Plan']==0 or $ShowRsSubjectDataRow['RSD_Plan']==$rc_IDPlan)){ ?>
					
			<!--##########################################################-->			
						<?php
							$SummerKeep=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
							$SummerKeep=$SummerKeep->CountSummerKeep();
							$SummerCount=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
							$SummerCount=$SummerCount->CountSummerCount();
						?>
			<!--##########################################################-->	
						<?php
							if((isset($SummerKeep,$SummerCount))){
								if(($SummerCount>=$SummerKeep)){ ?>
			<!--##########################################################-->
			<!--##########################################################-->				
									<div class="col-<?php echo $grid;?>-6">
										<div class="form-group">
											<label class="radio-inline">
												<input type="radio" class="styled" disabled="disabled" name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
												<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
											</label>			
										</div>
									</div>	
			<!--##########################################################-->	
				<script>
					$(document).ready(function (){
						$('#RSDno<?php echo $count_su;?>').on('click', function() {
							var RSDno=$("#RSDno<?php echo $count_su;?>").val();
							var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
							var RSYear="<?php echo $data_summer;?>";
							var RSKey="<?php echo $user_login;?>";
							var RSClass="<?php echo $call_stu->IDLevel;?>";
							var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
							var StudentID="<?php echo $user_login;?>";
							var StudentName="<?php echo $myname;?>";					
							swal({
								title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
								text:  "กิจกรรม : "+RSDnoName,
								type: "warning",
								showCancelButton: true,
								confirmButtonColor: "#EF5350",
								confirmButtonText: "ใช่ ยืนยันการลงทะเบียน",
								cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
								closeOnConfirm: false,
								closeOnCancel: false
							},
							function(isConfirm){
								if (isConfirm) {
									if(RSDno==""){
										swal({
											title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
											text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
											confirmButtonColor: "#66BB6A",
											type: "error"
										});							
									}else{
										swal({
											title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
											text:  "กิจกรรม : "+RSDnoName,
											confirmButtonColor: "#66BB6A",
											type: "success"
										},function(){
											$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
												RSD_no:RSDno,
												RSD_noName:RSDnoName,
												RS_Year:RSYear,
												RS_Key:RSKey,
												RS_Class:RSClass,
												RS_Est:RSEst,
												Student_ID:StudentID,
												Student_Name:StudentName										
											},function(){
												document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
											})
										});							
									}

								}
								else {
									swal({
										title: "ยกเลิกการลงทะเบียน",
										text: "เลือกรายการกิจกรรมที่สนใจ",
										confirmButtonColor: "#2196F3",
										type: "error"
									});
								}
							});
						});			
					})	
				</script>
			<!--##########################################################-->	
			<!--##########################################################-->							
						<?php	}else{	?>
			<!--##########################################################-->	
			<!--##########################################################-->				
									<div class="col-<?php echo $grid;?>-6">
										<div class="form-group">
											<label class="radio-inline">
												<input type="radio" class="styled"  name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
												<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
											</label>			
										</div>
									</div>	
			<!--##########################################################-->	
				<script>
					$(document).ready(function (){
						$('#RSDno<?php echo $count_su;?>').on('click', function() {
							var RSDno=$("#RSDno<?php echo $count_su;?>").val();
							var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
							var RSYear="<?php echo $data_summer;?>";
							var RSKey="<?php echo $user_login;?>";
							var RSClass="<?php echo $call_stu->IDLevel;?>";
							var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
							var StudentID="<?php echo $user_login;?>";
							var StudentName="<?php echo $myname;?>";					
							swal({
								title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
								text:  "กิจกรรม : "+RSDnoName,
								type: "warning",
								showCancelButton: true,
								confirmButtonColor: "#EF5350",
								confirmButtonText: "ใช่ ยืนยันการลงทะเบียน",
								cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
								closeOnConfirm: false,
								closeOnCancel: false
							},
							function(isConfirm){
								if (isConfirm) {
									if(RSDno==""){
										swal({
											title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
											text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
											confirmButtonColor: "#66BB6A",
											type: "error"
										});							
									}else{
										swal({
											title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
											text:  "กิจกรรม : "+RSDnoName,
											confirmButtonColor: "#66BB6A",
											type: "success"
										},function(){
											$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
												RSD_no:RSDno,
												RSD_noName:RSDnoName,
												RS_Year:RSYear,
												RS_Key:RSKey,
												RS_Class:RSClass,
												RS_Est:RSEst,
												Student_ID:StudentID,
												Student_Name:StudentName
											},function(){
												document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
											})
										});							
									}

								}
								else {
									swal({
										title: "ยกเลิกการลงทะเบียน",
										text: "เลือกรายการกิจกรรมที่สนใจ",
										confirmButtonColor: "#2196F3",
										type: "error"
									});
								}
							});
						});			
					})	
				</script>
			<!--##########################################################-->	
			<!--##########################################################-->							
						<?php	}
							}else{}
						?>
			
			
			
				<?php $count_su=$count_su+1; ?>	
				
			<?php	}else{}?>
	
		
		
		<?php	}else{} ?>
								
	<?php	} ?>		
	</form>								
						</div>
					</div>		
				</div>
			</div>	
		</div>
	<!--##########################################################-->					
				<?php	}else{ ?>
	<!--##########################################################-->	
		<?php
			$StatusPaySummerData= new StatusPaySummer($user_login,$data_summer);

				if(($StatusPaySummerData->SPS_RMD_on==1)){	  ?>
				
		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<span class="text-semibold" style="text-shadow: 0 0 0.2em #F87, 0 0 0.2em #F87; font-size: 20px;"><?php echo $StatusPaySummerData->SPS_RMD_txt;?></span>
			</div>	
		</div>
	</div><br>		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-info">
				<div class="panel-heading">รายการลงทะเบียนเรียนเสริมภาคฤดูร้อน</div>
			</div>	
		</div>
	</div>	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr class="success">
							<th><div>#</div></th>
							<th><div>รหัสวิชา / กิจกรรม</div></th>
							<th><div>รายการวิชา / กิจกรรม</div></th>
						</tr>
					</thead>
					<tbody>

	<?php
			$CSD_Count=1;
			$CSD_Sumpay=0;
			$CallSummerData=new PrintSummerData($user_login,$data_summer);
			foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
						<tr class="info">
							<td><div><?php echo $CSD_Count;?></div></td>
							<td><div><?php echo $CallSummerDataRow["RSD_no"];?></div></td>
							<td><div><?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
						</tr>		
	<?php		$CSD_Count=$CSD_Count+1;
				$CSD_Sumpay=$CSD_Sumpay+$CallSummerDataRow["RSP_price"];
			} ?>						

					</tbody>
				</table>
			</div>	
		</div>
	</div><hr>	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
	<form name="print_rc_summer" action="<?php echo base_url();?>rcprint/print_summer/<?php echo $user_login;?>" method="post" target="_blank">
		<div class="panel panel-body border-top-teal">
			<div class="row">
				<div class="col-<?php echo $grid;?>-3">				
		<?php
//-----------------------------------------------------------------------------------
		//	include("view/database/class_pdo.php");    
			include("view/database/regina_student.php");
			include("view/function/pay_scb.php");
//-----------------------------------------------------------------------------------	
			$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
			$stu_data=new regina_stu_data($user_login);	
//-----------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------		
			$class=$data_stu->IDLevel;
			$class_ex=$data_stu->Sort_name_E2;
			$txt_billerId="099400043439110";
			$txt_ref1=strtoupper($user_login."L".$class_ex);
			$txt_ref2=strtoupper("SUMMER".$data_term."0Y".$data_yaer);
			$txt_amount=number_format($CSD_Sumpay, 2, '.', '');                                                   
			$txt_width="104";
			$payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
		?>		
				
				<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="104" height="104"></div>
				<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
				<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
				<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
				<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($CSD_Sumpay, 2, '.', ',');?></div>				
				
				</div>
				<div class="col-<?php echo $grid;?>-3">
					<button type="submit" class="btn btn-success">พิมพ์ใบชำระเงิน&nbsp;ค่าลงทะเบียน321</button>
				</div>
				
				<div class="col-<?php echo $grid;?>-3">
	
	<script>
		$(document).ready(function(){
            $("#SaveQRCodeG").on('click',function(){
                var ImageB = '<?php echo $payqrcode->call_qrcode_scb();?>';
                var a = document.createElement('a');
                a.href = ImageB;
                a.download = ImageB.substr(ImageB.lastIndexOf('/') + 1);
                window.win = open(a);
                setTimeout('win.document.execCommand("SaveAs")', 0);	
            })
		})
	</script>			
				
					<button type="button" name="SaveQRCodeG" id="SaveQRCodeG" class="btn btn-default"><i class="icon-qrcode position-left"></i> Save QRCode</button>
				
				</div>				
				
				<div class="col-<?php echo $grid;?>-3">
				
					<button type="button" class="btn btn-info" id="sweet_loader">ยกเลิกการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</button>				

				</div>
			</div>
			<input type="hidden" name="data_summer" value="<?php echo $data_summer;?>">
			<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
			<input type="hidden" name="data_term" value="<?php echo $data_term;?>">
			<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
		</div>
	</form>
		</div>
	</div>	
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
			<script>
				$(document).ready(function (){
						var TimeAdd_runtime="<?php echo $TimeAdd_runtime;?>";
					$('#sweet_loader').on('click', function() {
						var URSCYear="<?php echo $data_yaer;?>";//ปีการศึกษา
						var URSCKey="<?php echo $user_login;?>";//
						var URSCTxtTh="<?php echo $CallSummerDataRow['RSD_txtTh'];?>";
						var URSCName="<?php echo $myname;?>";
						swal({
							title: "คุณต้องการยกเลิกหรือไม่",
							text: "<?php echo $CallSummerDataRow['RSD_txtTh'];?>",
							type: "info",
							showCancelButton: true,
							closeOnConfirm: false,
							confirmButtonColor: "#2196F3",
							showLoaderOnConfirm: true
						},function() {
							setTimeout(function() {
								if(TimeAdd_runtime=="OFF"){
									swal({
										title: "หมดเวลายกเลิกการลงทะเบียน",
										text: "ขออภัยไม่สามารถยกเลิกได้ เนื่องจากสิ้นสุดระยะเวลายกเลิกลงทะเบียน",
										confirmButtonColor: "#2196F3",
										type: "warning"
									});
								}else if(TimeAdd_runtime=="ON"){
									swal({
										title: "ยกเลิกสำเร็จ",
										confirmButtonColor: "#2196F3"
									},function (RunSummer){
										$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer_count.php",{
											URSC_Year:URSCYear,
											URSC_Key:URSCKey,
											URSC_Txtth:URSCTxtTh,
											URSC_Name:URSCName
										},function(RS){
											if(RS !=""){
												document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
											}else{}
										})
									});									
								}else{
									swal({
										title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
										//text: "เลือกรายการกิจกรรมที่สนใจ",
										confirmButtonColor: "#2196F3",
										type: "error"
									});									
								}
							}, 2000);
						});
					});					
				})
			</script>
		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<?php	}elseif(($StatusPaySummerData->SPS_RMD_on==2)){ ?>
		<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-success alert-styled-left">
					<span class="text-semibold" style="text-shadow: 0 0 0.2em #8F7; font-size: 20px;"><?php echo $StatusPaySummerData->SPS_RMD_txt;?></span>
				</div>	
			</div>
		</div><br>	

		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-success">
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-info">
								<div class="panel-heading">รายการลงทะเบียนเรียนเสริมภาคฤดูร้อน</div>
							</div>	
						</div>
					</div>	
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr class="success">
												<th><div>#</div></th>
												<th><div>รหัสวิชา / กิจกรรม</div></th>
												<th><div>รายการวิชา / กิจกรรม</div></th>
											</tr>
										</thead>
										<tbody>

						<?php
								$CSD_Count=1;
								$CallSummerData=new PrintSummerData($user_login,$data_summer);
								foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
											<tr class="info">
												<td><div><?php echo $CSD_Count;?></div></td>
												<td><div><?php echo $CallSummerDataRow["RSD_no"];?></div></td>
												<td><div><?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
											</tr>		
						<?php	$CSD_Count=$CSD_Count+1;} ?>						

										</tbody>
									</table>
								</div>				
										
						</div>
					</div>				
				</div>
			</div>
		</div>

		

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
		if(($DeletePay_Sud=="Yes")){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php
		    if(($TimeAdd_runtime=="ON")){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if(($call_stu->IDLevel==31 or $call_stu->IDLevel==41)){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
	<form name="print_rc_summer" action="<?php echo base_url();?>rcprint/print_summer/<?php echo $user_login;?>" method="post" target="_blank">
		<div class="panel panel-body border-top-teal">
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<button type="submit" class="btn btn-success">พิมพ์ใบยืนยันการลงทะเบียน</button>
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<button type="button" class="btn btn-info" id="sweet_loader">ยกเลิกการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</button>
				</div>
			</div>
			<input type="hidden" name="data_summer" value="<?php echo $data_summer;?>">
			<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
			<input type="hidden" name="data_term" value="<?php echo $data_term;?>">
			<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
		</div>
	</form>
		</div>
	</div>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-teal">
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<button type="button" class="btn btn-info" id="sweet_loader">ยกเลิกการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</button>			
					</div>
				</div>
				<input type="hidden" name="data_summer" value="<?php echo $data_summer;?>">
				<input type="hidden" name="data_yaer" value="<?php  echo $data_yaer;?>">
				<input type="hidden" name="data_term" value="<?php  echo $data_term;?>">
				<input type="hidden" name="user_login" value="<?php  echo $user_login;?>">
			</div>
		</div>
	</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php   }?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
    <?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<?php
				if(($call_stu->IDLevel==31 or $call_stu->IDLevel==41)){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
	<form name="print_rc_summer" action="<?php echo base_url();?>rcprint/print_summer/<?php echo $user_login;?>" method="post" target="_blank">
		<div class="panel panel-body border-top-teal">
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<button type="submit" class="btn btn-success">พิมพ์ใบยืนยันการลงทะเบียน</button>
				</div>
			</div>
			<input type="hidden" name="data_summer" value="<?php echo $data_summer;?>">
			<input type="hidden" name="data_yaer" value="<?php echo $data_yaer;?>">
			<input type="hidden" name="data_term" value="<?php echo $data_term;?>">
			<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
		</div>
	</form>
		</div>
	</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}else{} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php   }?>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php	}else{ ?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
		<!--
		<div class="panel panel-body border-top-teal">
			<div class="row">
				<div class="col-<?php //echo $grid;?>-12">
					<button type="button" class="btn btn-info" id="sweet_loader">ยกเลิกการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน</button>			
				</div>
			</div>
			<input type="hidden" name="data_summer" value="<?php //echo $data_summer;?>">
			<input type="hidden" name="data_yaer" value="<?php //echo $data_yaer;?>">
			<input type="hidden" name="data_term" value="<?php //echo $data_term;?>">
			<input type="hidden" name="user_login" value="<?php //echo $user_login;?>">
		</div>
		-->
		</div>
	</div>		
<?php	} ?>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
			<script>
				$(document).ready(function (){
					$('#sweet_loader').on('click', function() {
						var URSCYear="<?php echo $data_yaer;?>";//ปีการศึกษา
						var URSCKey="<?php echo $user_login;?>";//
						var URSCTxtTh="<?php echo $CallSummerDataRow['RSD_txtTh'];?>";
						var URSCName="<?php echo $myname;?>";
						swal({
							title: "คุณต้องการยกเลิกหรือไม่",
							text: "<?php echo $CallSummerDataRow['RSD_txtTh'];?>",
							type: "info",
							showCancelButton: true,
							closeOnConfirm: false,
							confirmButtonColor: "#2196F3",
							showLoaderOnConfirm: true
						},
						function() {
							setTimeout(function() {
								swal({
									title: "ยกเลิกสำเร็จ",
									confirmButtonColor: "#2196F3"
								},function (RunSummer){
									$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer_count.php",{
										URSC_Year:URSCYear,
										URSC_Key:URSCKey,
										URSC_Txtth:URSCTxtTh,
										URSC_Name:URSCName
									},function(RS){
										if(RS !=""){
											document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
										}else{}
									})
								});
							}, 2000);
						});
					});					
					
				})
			</script>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<?php	}else{} ?>
	<!--##########################################################-->						
				<?php	}?>						
<!--##########################################################-->						
			<?php	}else{	?>
<!--##########################################################-->
	<?php
			if(($call_stu->IDLevel>=12 and $call_stu->IDLevel<=23)){ ?>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="panel panel-info">
						<div class="panel-heading">ภาคเช้า วิชาการ</div>
						<div class="panel-body">
							<ul>
								<li>ภาษาไทย</li>
								<li>คณิตศาสตร์</li>
								<li>วิทยาศาสตร์</li>
								<li>ภาษาอังกฤษ</li>
								<li>สังคมศึกษา</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
	<?php	}elseif(($call_stu->IDLevel>=31 and $call_stu->IDLevel<=33)){ ?>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="panel panel-info">
						<div class="panel-heading">ภาคเช้า วิชาการ</div>
						<div class="panel-body">
							<ul>
								<li>ภาษาไทย</li>
								<li>คณิตศาสตร์</li>
								<li>วิทยาศาสตร์</li>
								<li>ภาษาอังกฤษ</li>
								<li>สังคมศึกษา</li>
								<li>ภาษาอังกฤษเพื่อการสื่อสาร</li>
							</ul>
						</div>
					</div>
				</div>
			</div>			
	<?php	}elseif(($call_stu->IDLevel>=41 and $call_stu->IDLevel<=43)){ ?>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="panel panel-info">
						<div class="panel-heading">ภาคเช้า วิชาการ</div>
						<div class="panel-body">
							<ul>
								<li>จัดเรียนการสอนตามแผนการเรียน</li>
							</ul>
						</div>
					</div>
				</div>
			</div>			
	<?php	}else{}?>		
<!--##########################################################-->		
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
	<?php
			if(($call_stu->IDLevel>=12 and $call_stu->IDLevel<=43)){ ?>
					<div class="panel-heading">
						<div>ภาคบ่าย เรียนกิจกรรมตามความสนใจ</div>
						<div>กรุณาเลือกกิจกรรม...</div>
					</div>			
	<?php	}else{?>
					<div class="panel-heading">รายการกิจกรรมเรียนเสริมภาคฤดูร้อน</div>		
	<?php   } ?>	
					<div class="panel-body">
	<form class="form-horizontal">
					
						<div class="row">
	<?php
		$ShowRsSubjectData=new ShowRsSubjectData($data_summer,$call_stu->IDLevel);
			$count_su=0;
			foreach($ShowRsSubjectData->RunShowRsSubjectData() as $rc=>$ShowRsSubjectDataRow){ ?>
				
		<?php
				if(($ShowRsSubjectDataRow["RST_on"]==1)){	?>
				
				<?php
					    if(($ShowRsSubjectDataRow['RSD_Plan']==0 or $ShowRsSubjectDataRow['RSD_Plan']==$rc_IDPlan)){ ?>
						
				<!--##########################################################-->			
							<?php
								$SummerKeep=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
								$SummerKeep=$SummerKeep->CountSummerKeep();
								$SummerCount=new ShowCountSummer($ShowRsSubjectDataRow["RSD_no"],$data_summer);
								$SummerCount=$SummerCount->CountSummerCount();
							?>
				<!--##########################################################-->	
							<?php
								if((isset($SummerKeep,$SummerCount))){
									if(($SummerCount>=$SummerKeep)){ ?>
				<!--##########################################################-->	
										<div class="col-<?php echo $grid;?>-6">
											<div class="form-group">
												<label class="radio-inline">
													<input type="radio" class="styled"  disabled="disabled" name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
													<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
												</label>

											</div>
										</div>	
				<!--##########################################################-->	
					<script>
						$(document).ready(function (){
							$('#RSDno<?php echo $count_su;?>').on('click', function() {
								var RSDno=$("#RSDno<?php echo $count_su;?>").val();
								var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
								var RSYear="<?php echo $data_summer;?>";
								var RSKey="<?php echo $user_login;?>";
								var RSClass="<?php echo $call_stu->IDLevel;?>";
								var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
								var StudentID="<?php echo $user_login;?>";
								var StudentName="<?php echo $myname;?>";					
								swal({
									title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
									text:  "กิจกรรม : "+RSDnoName,
									type: "warning",
									showCancelButton: true,
									confirmButtonColor: "#EF5350",
									confirmButtonText: "ใช่ ยืนยันการลงทะเบียน",
									cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
									closeOnConfirm: false,
									closeOnCancel: false
								},
								function(isConfirm){
									if (isConfirm) {
										if(RSDno==""){
											swal({
												title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
												text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
												confirmButtonColor: "#66BB6A",
												type: "error"
											});							
										}else{
											swal({
												title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
												text:  "กิจกรรม : "+RSDnoName,
												confirmButtonColor: "#66BB6A",
												type: "success"
											},function(){
												$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
													RSD_no:RSDno,
													RSD_noName:RSDnoName,
													RS_Year:RSYear,
													RS_Key:RSKey,
													RS_Class:RSClass,
													RS_Est:RSEst,
													Student_ID:StudentID,
													Student_Name:StudentName										
												},function(){
													document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
												})
											});							
										}

									}
									else {
										swal({
											title: "ยกเลิกการลงทะเบียน",
											text: "เลือกรายการกิจกรรมที่สนใจ",
											confirmButtonColor: "#2196F3",
											type: "error"
										});
									}
								});
							});			
						})	
					</script>	
				<!--##########################################################-->							
							<?php	}else{	?>
				<!--##########################################################-->
										<div class="col-<?php echo $grid;?>-6">
											<div class="form-group">
												<label class="radio-inline">
													<input type="radio" class="styled"  name="RSDno" id="RSDno<?php echo $count_su;?>"  value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>" required="required">
													<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>
												</label>

											</div>
										</div>	
				<!--##########################################################-->	
					<script>
						$(document).ready(function (){
							$('#RSDno<?php echo $count_su;?>').on('click', function() {
								var RSDno=$("#RSDno<?php echo $count_su;?>").val();
								var RSDnoName="<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?>";
								var RSYear="<?php echo $data_summer;?>";
								var RSKey="<?php echo $user_login;?>";
								var RSClass="<?php echo $call_stu->IDLevel;?>";
								var RSEst="<?php echo $ClassSummer->RunSetClassSummer();?>";
								var StudentID="<?php echo $user_login;?>";
								var StudentName="<?php echo $myname;?>";					
								swal({
									title: "ยืนยันการลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
									text:  "กิจกรรม : "+RSDnoName,
									type: "warning",
									showCancelButton: true,
									confirmButtonColor: "#EF5350",
									confirmButtonText: "ใช่ ยืนยันการลงทะเบียน",
									cancelButtonText: "ไม่ ยืนยันการลงทะเบียน",
									closeOnConfirm: false,
									closeOnCancel: false
								},
								function(isConfirm){
									if (isConfirm) {
										if(RSDno==""){
											swal({
												title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
												text:  "กรุณาเลือกกิจกรรมใหม่อีกครั้ง",
												confirmButtonColor: "#66BB6A",
												type: "error"
											});							
										}else{
											swal({
												title: "ลงทะเบียนกิจกรรมเรียนเสริมภาคฤดูร้อน",
												text:  "กิจกรรม : "+RSDnoName,
												confirmButtonColor: "#66BB6A",
												type: "success"
											},function(){
												$.post("<?php echo base_url();?>view/mod/student/code/rc_summer/summer.php",{
													RSD_no:RSDno,
													RSD_noName:RSDnoName,
													RS_Year:RSYear,
													RS_Key:RSKey,
													RS_Class:RSClass,
													RS_Est:RSEst,
													Student_ID:StudentID,
													Student_Name:StudentName										
												},function(){
													document.location="<?php echo base_url();?>?evaluation_mod=rc_summer"
												})
											});							
										}

									}
									else {
										swal({
											title: "ยกเลิกการลงทะเบียน",
											text: "เลือกรายการกิจกรรมที่สนใจ",
											confirmButtonColor: "#2196F3",
											type: "error"
										});
									}
								});
							});			
						})	
					</script>	
				<!--##########################################################-->							
							<?php	}
								}else{}?>
				<!--##########################################################-->
				<!--##########################################################-->	
					<?php $count_su=$count_su+1; ?>	
					
				<?php	}else{ ?>
	<!--<div class="row">
		<div class="col-<?php //echo $grid;?>-12">
			<div class="alert alert-danger alert-styled-left alert-bordered">			
				<span class="text-semibold">ไม่พบรายการข้อมูล...</span>
			</div>		
		</div>
	</div>-->						
				<?php   } ?>

		<?php	}else{} ?>
									
	<?php	} ?>		
	</form>								
						</div>
					</div>		
				</div>
			</div>	
		</div>
<!--##########################################################-->						
			<?php	}?>
<!--##########################################################-->					
		<?php	}else{ ?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">			
				<span class="text-semibold">การดำเนินการไม่ถูกต้องไม่สามารถดำเนินการได้...</span>
			</div>		
		</div>
	</div>			
			
		<?php   }?>		
<!--##########################################################-->				
<?php		}else{ ?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">			
				<span class="text-semibold">การดำเนินการไม่ถูกต้องไม่สามารถดำเนินการได้...</span>
			</div>		
		</div>
	</div>	
	
	  <?php } ?>
<!--##########################################################-->	
<?php   } ?>
<!--##########################################################-->
<!--##########################################################-->		
	<?php       }
			} ?>
</div>		
		
		


