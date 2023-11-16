<style>
	#RuningLoadQuotasCode{
		display:none;
	}
	.solid{
		border-style: solid;
		border-width: 5px;
		border-color: #0000FF;
	}
</style>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<div id="RunLoadQuotasCode">
					<img class="img-thumbnail" src="Template/global_assets/images/Cube-1s-200px.gif" />
				</div>	
			</center>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	$system_datetime=date("Y-m-d H:i:s");
	$OFFONDateTime=date("2023-07-19 08:00:00");//Time Open
	//$OFFONDateTime=date("2021-07-24 08:00:00");
	$OFFONDateTime_Cr=date("Y-m-d H:i:s");
	$OFFONDateTime_notrun=strtotime($OFFONDateTime);
	$OFFONDateTime_run=strtotime($OFFONDateTime_Cr);
//+++++++++++++++23End	
		if($OFFONDateTime_run>=$OFFONDateTime_notrun){
			$OFFONPrint_runtime="ON";
		}else{
			$OFFONPrint_runtime="OFF"; 
		}
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
		if($OFFONPrint_runtime=="OFF"){ ?>
<!--##########################################################-->
<div id="RuningLoadTalent">
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alpha-teal border-teal alert-styled-left">
					ประกาศรายชื่อผู้มีสิทธิ์ได้รับโควตา ปีการศึกษา 2566 เปิดระบบในวันที่ 20 ก.ค. 2566 เวลา 08.00 เป็นต้นไป
				</div>
			</div>
		</div>
	</div>		
</div>
<!--##########################################################-->		
<?php	}elseif($OFFONPrint_runtime=="ON"){ ?>
<!--##########################################################-->
	<div id="RuningLoadQuotasCode">
	<?php
		$test_system="ON";
		switch($test_system){
			case "OFF": ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alpha-teal border-teal alert-styled-left">
					ขออภัยในความสะดวก เจ้าหน้าที่ ICT กำลังทดสอบระบบ... 
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
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		include("view/database/pdo_quota.php");
		include("view/database/pdo_data.php");
		include("view/database/class_quota.php");
	//+++++++++++++++++++++++++++++++++++++++++++*****************
		$data_yaer=2566;
		$user_login;
		//********************************************************
		$next_yaer=2567;
		//********************************************************
	//ข้อมูลนักเรียน 
		$call_sturc=new regina_stu_data($user_login);
	//ระดับชั้น
		$call_stu=new stu_levelpdo($user_login,$data_yaer,"1");
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
		if($call_stu->IDLevel==23){
			$class_new=31;
		}elseif($call_stu->IDLevel==33){
			$class_new=41;
		}else{
			$class_new=null;
		}
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	?>
		<script>
			$(document).ready(function(){
				$("#rc_quotasA").click(function (){
					var button_quota="bqA";
					var copy_user_login="<?php echo $user_login;?>";
					var copy_data_yaer="<?php echo $data_yaer;?>";
					var copy_next_yaer="<?php echo $next_yaer;?>";
					var copy_class="<?php echo $call_stu->IDLevel;?>";
					var copy_class_new="<?php echo $class_new;?>";
					
						if(button_quota !="" && copy_user_login!="" && copy_data_yaer!="" && copy_next_yaer!="" && copy_class!="" && copy_class_new!=""){
							$.post("view/mod/student/code/intention_quotas/run_quota.php",{
								quota_txt:button_quota,
								quota_user_login:copy_user_login,
								quota_data_yaer:copy_data_yaer,
								quota_next_yaer:copy_next_yaer,
								quota_class:copy_class,
								quota_class_new:copy_class_new
							},function(quota){
								if(quota!=""){
									$("#run_quota").html(quota);
								}else{}
							})
						}else{}
				})
				
			})
		</script>
		<script>
			$(document).ready(function(){
				$("#rc_quotasB").click(function (){
					var button_quota="bqB";
					var copy_user_login="<?php echo $user_login;?>";
					var copy_data_yaer="<?php echo $data_yaer;?>";
					var copy_next_yaer="<?php echo $next_yaer;?>";
					var copy_class="<?php echo $call_stu->IDLevel;?>";
					var copy_class_new="<?php echo $class_new;?>";				
						if(button_quota !="" && copy_user_login!="" && copy_data_yaer!="" && copy_next_yaer!="" && copy_class!="" && copy_class_new!=""){
							$.post("view/mod/student/code/intention_quotas/run_quota.php",{
								quota_txt:button_quota,
								quota_user_login:copy_user_login,
								quota_data_yaer:copy_data_yaer,
								quota_next_yaer:copy_next_yaer,
								quota_class:copy_class,
								quota_class_new:copy_class_new
							},function(quota){
								if(quota!=""){
									$("#run_quota").html(quota);
								}else{}
							})
						}else{}
				})
				
			})
		</script>
	<?php
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	//+++++++++++++++23
		//$End23DateTime=date("2021-08-06 17:00:00");
		$End23DateTime=date("2023-12-01 00:00:00");//Time End*********************************
		$End23DateTime_Cr=date("Y-m-d H:i:s");
		$End23DateTime_notrun=strtotime($End23DateTime);
		$End23DateTime_run=strtotime($End23DateTime_Cr);
	//+++++++++++++++23End	
			if($End23DateTime_run>=$End23DateTime_notrun){
				$End23Print_runtime="OFF";
			}else{
				$End23Print_runtime="ON";
			}
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//+++++++++++++++33
		//$End33DateTime=date("2021-08-06 17:00:00");
		$End33DateTime=date("2023-12-01 00:00:00");//Time End**********************************
		$End33DateTime_Cr=date("Y-m-d H:i:s");
		$End33DateTime_notrun=strtotime($End33DateTime);
		$End33DateTime_run=strtotime($End33DateTime_Cr);
	//+++++++++++++++33End	
			if($End33DateTime_run>=$End33DateTime_notrun){
				$End33Print_runtime="OFF";
			}else{
				$End33Print_runtime="ON";
			}
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
			if($call_stu->IDLevel==23){ ?>
	<!--***********************************************************-->	
	<!--***********************************************************-->	
			<?php
				switch($End23Print_runtime){
					case "OFF": ?>
	<!--------------------------------------------------------------->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					สิ้นสุดระยะเวลาดำเนินการ ประกาศรายชื่อผู้มีสิทธิ์ได้รับโควตา ปีการศึกษา <?php echo $next_yaer;?> ติดต่อฝ่ายวิชาการ โทรศัพท์ 053-282395 ต่อ 121 หรือ 122
				</div>
			</div>
		</div>
	</div>	
	<!--------------------------------------------------------------->		
			<?php	break;
					case "ON":  ?>
	<!--------------------------------------------------------------->		
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-teal">
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<h6 class="content-group text-semibold">
								ประกาศรายชื่อผู้มีสิทธิ์ได้รับโควตาเข้าศึกษาต่อในระดับชั้นมัธยมศึกษาปีที่ 1 ปีการศึกษา <?php echo $next_yaer;?>
								<small class="display-block">โรงเรียนเรยีนาเชลีวิทยาลัย</small>
							</h6>
						</div>
					</div>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
					<?php
						$rc_quotas=new internal_quota_rights($user_login,$next_yaer,$class_new);
							if(is_array($rc_quotas->print_internal_quota_rights()) && count($rc_quotas->print_internal_quota_rights())){ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$quota_txt=filter_input(INPUT_POST,'quota_txt');
		switch($quota_txt){
			case "bqA": ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$isr_quota_np=filter_input(INPUT_POST,'isr_quota_np');
		$isr_quota_name=filter_input(INPUT_POST,'isr_quota_name');
		$isr_quota_surname=filter_input(INPUT_POST,'isr_quota_surname');
		$isr_quota_relationship=filter_input(INPUT_POST,'isr_quota_relationship');
		$isr_quota_phone=filter_input(INPUT_POST,'isr_quota_phone');
		$quota_plan=filter_input(INPUT_POST,'quota_plan');

		if(isset($_POST["isr_MaintainRightsTxT"])){
			$isr_MaintainRightsTxT=filter_input(INPUT_POST,'isr_MaintainRightsTxT');
		}else{
	//------------------------------------------------------------------------------------------------------		
		}
		
			if(isset($isr_quota_np,$isr_quota_name,$isr_quota_surname,$isr_quota_relationship,$isr_quota_phone,$quota_plan)){
				$InternalSaveRightsTest=new InternalSaveRightsTest($user_login,$data_yaer);
					if($InternalSaveRightsTest->RunInternalSaveRightsTest()>=1){ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					ไม่สามารถบันทึกข้อมูลได้เนื่องจาก ท่านส่งแบบแจ้งความจำนงเรียบร้อยแล้ว 
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-success">หน้าแบบแจ้งความจำนง</button>
				<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>
			</center>
		</div>
	</div>					
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
			<?php   }else{ 
	//-----------------------------------------------------------------------------------------------------
						$InternalSaveRightsInto=new InternalSaveRightsInto($user_login,$data_yaer,$next_yaer,$class_new,$quota_plan,'รักษาสิทธิ์','',$isr_quota_np,$isr_quota_name,$isr_quota_surname,$isr_quota_phone,$isr_quota_relationship,$system_datetime);
							if($InternalSaveRightsInto->RunInternalSaveRightsInto()=="Yes"){
								$IntoQuotaRight=new IntoQuotaRight($user_login,$next_yaer,$class_new,$quota_plan);
									if($IntoQuotaRight->RunIntoQuotaRight()=="Yes"){ ?>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-success alert-styled-left">
					บันทึกข้อมูลสำเร็จ
				</div>
			</div>
		</div>
	</div>		
	<form name="print_quota" action="quota_print/print_intention/<?php echo $next_yaer;?>/<?php echo $user_login; ?>" method="post" target="_blank"> 	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<center><button type="submit" name="rc_quotasA" class="btn btn-success">พิมพ์แบบแจ้งความจำนง</button></center>
			</div>
		</div>		
		<input type="hidden" name="print_key" value="<?php echo $user_login; ?>">
		<input type="hidden" name="print_year" value="<?php echo $data_yaer; ?>">
		<input type="hidden" name="print_yearnew" value="<?php echo $next_yaer;?>">
	</form>							
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		if($db_evaluationID=="127.0.0.1"){
			//****************************
		}else{
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ทำรายการแบบแจ้งความจำนง นักเรียนได้รับสิทธิ์โควตาภายใน สถานะ รักษาสิทธิ์".$data_yaer." เรียบร้อยแล้ว IP:".$db_evaluationID;

					
					$chOne = curl_init(); 
					curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
					curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
					curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
					curl_setopt( $chOne, CURLOPT_POST, 1); 
					curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
					$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
					curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
					curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
					$result = curl_exec( $chOne ); 

					//Result error 
					if(curl_error($chOne)) 
					{ 
						echo 'error:' . curl_error($chOne); 
					} 
					else { 
						$result_ = json_decode($result, true); 
						//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
					} 
					curl_close( $chOne ); 		
		}
	?>	
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->									
			<?php					}else{
										$InternalSaveRightsDelete=new InternalSaveRightsDelete($user_login,$data_yaer); ?>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-danger alert-styled-left">
				บันทึกข้อมูลไม่สำเร็จ				
				</div>
			</div>
		</div>
	</div>		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-success">หน้าแบบแจ้งความจำนง</button>
				<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>
			</center>
		</div>
	</div>						
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->										
							<?php	}
							}else{ ?>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-danger alert-styled-left">
				บันทึกข้อมูลไม่สำเร็จ				
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-success">หน้าแบบแจ้งความจำนง</button>
				<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>
			</center>
		</div>
	</div>										
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->								
			<?php			}
	//-----------------------------------------------------------------------------------------------------		
					}
			}else{ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					ข้อมูลไม่ถูกต้อง ไม่สามารถดำเนินการได้
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-success">หน้าแบบแจ้งความจำนง</button>
				<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>
			</center>
		</div>
	</div>					
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	break;
			case "bqB": ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$isr_quota_np=filter_input(INPUT_POST,'isr_quota_np');
		$isr_quota_name=filter_input(INPUT_POST,'isr_quota_name');
		$isr_quota_surname=filter_input(INPUT_POST,'isr_quota_surname');
		$isr_quota_relationship=filter_input(INPUT_POST,'isr_quota_relationship');
		$isr_quota_phone=filter_input(INPUT_POST,'isr_quota_phone');
		//$quota_plan=filter_input(INPUT_POST,'quota_plan');

		if(isset($_POST["isr_MaintainRightsTxT"])){
			$isr_MaintainRightsTxT=filter_input(INPUT_POST,'isr_MaintainRightsTxT');
		}else{
	//------------------------------------------------------------------------------------------------------		
		}
		
			if(isset($isr_quota_np,$isr_quota_name,$isr_quota_surname,$isr_quota_relationship,$isr_quota_phone)){
				$InternalSaveRightsTest=new InternalSaveRightsTest($user_login,$data_yaer);
					if($InternalSaveRightsTest->RunInternalSaveRightsTest()>=1){ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					ไม่สามารถบันทึกข้อมูลได้เนื่องจาก ท่านส่งแบบแจ้งความจำนงเรียบร้อยแล้ว 
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-success">หน้าแบบแจ้งความจำนง</button>
				<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>
			</center>
		</div>
	</div>					
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
			<?php   }else{ 
	//-----------------------------------------------------------------------------------------------------
						$InternalSaveRightsInto=new InternalSaveRightsInto($user_login,$data_yaer,'','','','สละสิทธิ์',$isr_MaintainRightsTxT,$isr_quota_np,$isr_quota_name,$isr_quota_surname,$isr_quota_phone,$isr_quota_relationship,$system_datetime);
							if($InternalSaveRightsInto->RunInternalSaveRightsInto()=="Yes"){?>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-success alert-styled-left">
					บันทึกข้อมูลสำเร็จ
				</div>
			</div>
		</div>
	</div>		
	<form name="print_quota" action="quota_print/print_intention/<?php echo $next_yaer;?>/<?php echo $user_login; ?>" method="post" target="_blank"> 	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<center><button type="submit" name="rc_quotasA" class="btn btn-success">พิมพ์แบบแจ้งความจำนง</button></center>
			</div>
		</div>		
		<input type="hidden" name="print_key" value="<?php echo $user_login; ?>">
		<input type="hidden" name="print_year" value="<?php echo $data_yaer; ?>">
		<input type="hidden" name="print_yearnew" value="<?php echo $next_yaer;?>">
	</form>							
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		if($db_evaluationID=="127.0.0.1"){
			//****************************
		}else{
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ทำรายการแบบแจ้งความจำนง นักเรียนได้รับสิทธิ์โควตาภายใน ปีการศึกษา ".$data_yaer." สถานะ สละสิทธิ์ เรียบร้อยแล้ว IP:".$db_evaluationID;

					
					$chOne = curl_init(); 
					curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
					curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
					curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
					curl_setopt( $chOne, CURLOPT_POST, 1); 
					curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
					$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
					curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
					curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
					$result = curl_exec( $chOne ); 

					//Result error 
					if(curl_error($chOne)) 
					{ 
						echo 'error:' . curl_error($chOne); 
					} 
					else { 
						$result_ = json_decode($result, true); 
						//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
					} 
					curl_close( $chOne ); 		
		}
	?>	
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
			<?php			}else{ ?>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-danger alert-styled-left">
				บันทึกข้อมูลไม่สำเร็จ				
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-success">หน้าแบบแจ้งความจำนง</button>
				<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>
			</center>
		</div>
	</div>										
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->								
			<?php			}
	//-----------------------------------------------------------------------------------------------------		
					}
			}else{ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					ข้อมูลไม่ถูกต้อง ไม่สามารถดำเนินการได้
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-success">หน้าแบบแจ้งความจำนง</button>
				<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>
			</center>	
		</div>
	</div>					
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}?>	
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php	break;
			default: ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					เกิดข้อผิดพลาดไม่สามารถดำเนินการได้
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-success">หน้าแบบแจ้งความจำนง</button>
				<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>
			</center>
		</div>
	</div>	
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	}?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
					<?php	}else{ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					ติดต่อฝ่ายวิชาการ โทรศัพท์ 053-282395 ต่อ 121 หรือ 122
				</div>
			</div>
		</div>
	</div>
	<!--<div class="row">
		<div class="col-<?php //echo $grid;?>-12">
			<div class="content-group-<?php //echo $grid;?>">
				<h6 class="content-group text-semibold">
				 
				</h6>
			</div>
		</div>
	</div>-->							
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
					<?php	}  ?>			
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
				</div>
			</div>
		</div>
	<!--------------------------------------------------------------->		
			<?php	break;
					default:    ?>
	<!--------------------------------------------------------------->		
	<!--------------------------------------------------------------->		
			<?php	}?>	
	<!--***********************************************************-->	
	<!--***********************************************************-->		
	<?php	}elseif($call_stu->IDLevel==33){ ?>
	<!--***********************************************************-->	
	<!--***********************************************************-->	
			<?php
				switch($End33Print_runtime){
					case "OFF": ?>
	<!--------------------------------------------------------------->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					สิ้นสุดระยะเวลาดำเนินการ ประกาศรายชื่อผู้มีสิทธิ์ได้รับโควตา ปีการศึกษา <?php echo $next_yaer;?> ติดต่อฝ่ายวิชาการ โทรศัพท์ 053-282395 ต่อ 121 หรือ 122
				</div>
			</div>
		</div>
	</div>	
	<!--------------------------------------------------------------->		
			<?php	break;
					case "ON":  ?>
	<!--------------------------------------------------------------->		
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-teal">
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<h6 class="content-group text-semibold">
								ประกาศรายชื่อผู้มีสิทธิ์ได้รับโควตาเข้าศึกษาต่อในระดับชั้นมัธยมศึกษาปีที่ 4 ปีการศึกษา <?php echo $next_yaer;?>
								<small class="display-block">โรงเรียนเรยีนาเชลีวิทยาลัย</small>
							</h6>
						</div>
					</div>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
					<?php
						$rc_quotas=new internal_quota_rights($user_login,$next_yaer,$class_new);
							if(is_array($rc_quotas->print_internal_quota_rights()) && count($rc_quotas->print_internal_quota_rights())){ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$quota_txt=filter_input(INPUT_POST,'quota_txt');
		switch($quota_txt){
			case "bqA": ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$isr_quota_np=filter_input(INPUT_POST,'isr_quota_np');
		$isr_quota_name=filter_input(INPUT_POST,'isr_quota_name');
		$isr_quota_surname=filter_input(INPUT_POST,'isr_quota_surname');
		$isr_quota_relationship=filter_input(INPUT_POST,'isr_quota_relationship');
		$isr_quota_phone=filter_input(INPUT_POST,'isr_quota_phone');
		$quota_plan=filter_input(INPUT_POST,'quota_plan');

		if(isset($_POST["isr_MaintainRightsTxT"])){
			$isr_MaintainRightsTxT=filter_input(INPUT_POST,'isr_MaintainRightsTxT');
		}else{
	//------------------------------------------------------------------------------------------------------		
		}
		
			if(isset($isr_quota_np,$isr_quota_name,$isr_quota_surname,$isr_quota_relationship,$isr_quota_phone,$quota_plan)){
				$InternalSaveRightsTest=new InternalSaveRightsTest($user_login,$data_yaer);
					if($InternalSaveRightsTest->RunInternalSaveRightsTest()>=1){ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					ไม่สามารถบันทึกข้อมูลได้เนื่องจาก ท่านส่งแบบแจ้งความจำนงเรียบร้อยแล้ว 
				</div>
			</div>
		</div>
	</div>				
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
			<?php   }else{ 
	//-----------------------------------------------------------------------------------------------------
						$InternalSaveRightsInto=new InternalSaveRightsInto($user_login,$data_yaer,$next_yaer,$class_new,$quota_plan,'รักษาสิทธิ์','',$isr_quota_np,$isr_quota_name,$isr_quota_surname,$isr_quota_phone,$isr_quota_relationship);
							if($InternalSaveRightsInto->RunInternalSaveRightsInto()=="Yes"){
								$IntoQuotaRight=new IntoQuotaRight($user_login,$next_yaer,$class_new,$quota_plan);
									if($IntoQuotaRight->RunIntoQuotaRight()=="Yes"){ ?>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-success alert-styled-left">
					บันทึกข้อมูลสำเร็จ
				</div>
			</div>
		</div>
	</div>		
	<form name="print_quota" action="quota_print/print_intention/<?php echo $next_yaer;?>/<?php echo $user_login; ?>" method="post" target="_blank"> 	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<center>
					<button type="submit" name="rc_quotasA" class="btn btn-success">พิมพ์แบบแจ้งความจำนง</button>
					<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>	
				</center>
			</div>
		</div>		
		<input type="hidden" name="print_key" value="<?php echo $user_login; ?>">
		<input type="hidden" name="print_year" value="<?php echo $data_yaer; ?>">
		<input type="hidden" name="print_yearnew" value="<?php echo $next_yaer;?>">
	</form>							
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		if($db_evaluationID=="127.0.0.1"){
			//****************************
		}else{
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ทำรายการแบบแจ้งความจำนง นักเรียนได้รับสิทธิ์โควตาภายใน ปีการศึกษา ".$data_yaer." สถานะ รักษาสิทธิ์ เรียบร้อยแล้ว IP:".$db_evaluationID;

					
					$chOne = curl_init(); 
					curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
					curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
					curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
					curl_setopt( $chOne, CURLOPT_POST, 1); 
					curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
					$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
					curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
					curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
					$result = curl_exec( $chOne ); 

					//Result error 
					if(curl_error($chOne)) 
					{ 
						echo 'error:' . curl_error($chOne); 
					} 
					else { 
						$result_ = json_decode($result, true); 
						//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
					} 
					curl_close( $chOne ); 		
		}
	?>	
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->									
			<?php					}else{
										$InternalSaveRightsDelete=new InternalSaveRightsDelete($user_login,$data_yaer); ?>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-danger alert-styled-left">
				บันทึกข้อมูลไม่สำเร็จ				
				</div>
			</div>
		</div>
	</div>		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-success">หน้าแบบแจ้งความจำนง</button>
				<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>
			</center>	
		</div>
	</div>						
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->										
							<?php	}
							}else{ ?>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-danger alert-styled-left">
				บันทึกข้อมูลไม่สำเร็จ				
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-success">หน้าแบบแจ้งความจำนง</button>
				<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>
			</center>
		</div>
	</div>										
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->								
			<?php			}
	//-----------------------------------------------------------------------------------------------------		
					}
			}else{ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					ข้อมูลไม่ถูกต้อง ไม่สามารถดำเนินการได้
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-success">หน้าแบบแจ้งความจำนง</button>
				<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>
			</center>
		</div>
	</div>					
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	break;
			case "bqB": ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$isr_quota_np=filter_input(INPUT_POST,'isr_quota_np');
		$isr_quota_name=filter_input(INPUT_POST,'isr_quota_name');
		$isr_quota_surname=filter_input(INPUT_POST,'isr_quota_surname');
		$isr_quota_relationship=filter_input(INPUT_POST,'isr_quota_relationship');
		$isr_quota_phone=filter_input(INPUT_POST,'isr_quota_phone');
		//$quota_plan=filter_input(INPUT_POST,'quota_plan');

		if(isset($_POST["isr_MaintainRightsTxT"])){
			$isr_MaintainRightsTxT=filter_input(INPUT_POST,'isr_MaintainRightsTxT');
		}else{
	//------------------------------------------------------------------------------------------------------		
		}
		
			if(isset($isr_quota_np,$isr_quota_name,$isr_quota_surname,$isr_quota_relationship,$isr_quota_phone)){
				$InternalSaveRightsTest=new InternalSaveRightsTest($user_login,$data_yaer);
					if($InternalSaveRightsTest->RunInternalSaveRightsTest()>=1){ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					ไม่สามารถบันทึกข้อมูลได้เนื่องจาก ท่านส่งแบบแจ้งความจำนงเรียบร้อยแล้ว 
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-success">หน้าแบบแจ้งความจำนง</button>
				<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>
			</center>
		</div>
	</div>				
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
			<?php   }else{ 
	//-----------------------------------------------------------------------------------------------------
						$InternalSaveRightsInto=new InternalSaveRightsInto($user_login,$data_yaer,'','','','สละสิทธิ์',$isr_MaintainRightsTxT,$isr_quota_np,$isr_quota_name,$isr_quota_surname,$isr_quota_phone,$isr_quota_relationship);
							if($InternalSaveRightsInto->RunInternalSaveRightsInto()=="Yes"){?>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-success alert-styled-left">
					บันทึกข้อมูลสำเร็จ
				</div>
			</div>
		</div>
	</div>		
	<form name="print_quota" action="quota_print/print_intention/<?php echo $next_yaer;?>/<?php echo $user_login; ?>" method="post" target="_blank"> 	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<center>
					<button type="submit" name="rc_quotasA" class="btn btn-success">พิมพ์แบบแจ้งความจำนง</button>
					<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>	
				</center>
			</div>
		</div>		
		<input type="hidden" name="print_key" value="<?php echo $user_login; ?>">
		<input type="hidden" name="print_year" value="<?php echo $data_yaer; ?>">
		<input type="hidden" name="print_yearnew" value="<?php echo $next_yaer;?>">
	</form>							
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
	
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		if($db_evaluationID=="127.0.0.1"){
			//****************************
		}else{
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
					date_default_timezone_set("Asia/Bangkok");

					$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
					$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ทำรายการแบบแจ้งความจำนง นักเรียนได้รับสิทธิ์โควตาภายใน สถานะ สละสิทธิ์".$data_yaer." เรียบร้อยแล้ว IP:".$db_evaluationID;

					
					$chOne = curl_init(); 
					curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
					curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
					curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
					curl_setopt( $chOne, CURLOPT_POST, 1); 
					curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
					$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
					curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
					curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
					$result = curl_exec( $chOne ); 

					//Result error 
					if(curl_error($chOne)) 
					{ 
						echo 'error:' . curl_error($chOne); 
					} 
					else { 
						$result_ = json_decode($result, true); 
						//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
					} 
					curl_close( $chOne ); 		
		}
	?>	
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
			<?php			}else{ ?>
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-danger alert-styled-left">
				บันทึกข้อมูลไม่สำเร็จ				
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-success">หน้าแบบแจ้งความจำนง</button>
				<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>
			</center>
		</div>
	</div>										
	<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->								
			<?php			}
	//-----------------------------------------------------------------------------------------------------		
					}
			}else{ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					ข้อมูลไม่ถูกต้อง ไม่สามารถดำเนินการได้
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-success">หน้าแบบแจ้งความจำนง</button>
				<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>
			</center>
		</div>
	</div>					
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}?>	
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php	break;
			default: ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					เกิดข้อผิดพลาดไม่สามารถดำเนินการได้
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-success">หน้าแบบแจ้งความจำนง</button>
				<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>
			</center>
		</div>
	</div>	
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	}?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
					<?php	}else{ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="content-group-<?php echo $grid;?>">
				<div class="alert alert-warning alert-styled-left">
					กรุณาติดต่อฝ่ายวิชาการ ช่วงเปิดเรียนปกติ (ในเวลาราชการ)
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-success">หน้าแบบแจ้งความจำนง</button>
				<button type="button" id="buttonB" class="btn btn-info">หน้าแรก</button>
			</center>
		</div>
	</div>
	<!--<div class="row">
		<div class="col-<?php //echo $grid;?>-12">
			<div class="content-group-<?php //echo $grid;?>">
				<h6 class="content-group text-semibold">
				 
				</h6>
			</div>
		</div>
	</div>-->							
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
					<?php	}  ?>			
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
				</div>
			</div>
		</div>
	<!--------------------------------------------------------------->		
			<?php	break;
					default:    ?>
	<!--------------------------------------------------------------->		
	<!--------------------------------------------------------------->		
			<?php	}?>	
	<!--***********************************************************-->	
	<!--***********************************************************-->		
	<?php	}else{ ?>
	<!--***********************************************************-->		
	<!--***********************************************************-->		
	<?php	}      ?>
	</div>		
<!--##########################################################-->		
<?php	}else{} ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
