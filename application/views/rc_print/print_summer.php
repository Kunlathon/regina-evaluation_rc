<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
	//$RcId="17989";
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
        if($this->session->userdata("rc_user")==null){
            $this->session->unset_userdata("rc_user");
            exit("<script>window.location='$golink/print_imgstu/error';</script>");            
        }else{
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
                            if($usercopy==$RcId){ ?>
                            
	<style>
		.psrA{
			margin: auto;
			border: 3px solid #73AD21;
		}
	</style>

<?php
    include("view/database/pdo_data.php");
	include("view/database/pdo_conndatastu.php");
	include("view/database/pdo_admission.php"); 
    
	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");	
	
	include("view/database/class_pdo.php");    
    include("view/database/regina_student.php");
    include("view/function/pay_scb.php");
    
	$data_summer=filter_input(INPUT_POST,'data_summer');
	$data_yaer=filter_input(INPUT_POST,'data_yaer');
	$data_term=filter_input(INPUT_POST,'data_term');
	$user_login=filter_input(INPUT_POST,'user_login');
    /*$data_summer=2565;
	$data_yaer=2564;
	$data_term=2;
	$user_login=17989;*/
	//**********************************************	

	
    $PrintReginaStuData=new PrintReginaStuData($user_login);
    
	$stu_not=filter_input(INPUT_POST,'stu_not');
	
	//**********************************************
	$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
	$stu_data=new PrintReginaStuDataClass($user_login);
	
	
?>



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
		<title>ใบชำระเงินค่าลงทะเบียนเรียน&nbsp;เสริมภาคฤดูร้อน</title>
		<link rel="shortcut icon" href="<?php echo base_url();?>/Template/global_assets/images/logo_rc_wbe.ico"/>
<!-- Global stylesheets -->
		<link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
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
				font-size: 30px;
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
					font-size: 18pt; 
							
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
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/bootstrap.min.js"></script>
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
						<table class="table" align="center" style="font-size: 18px;">
							<thead>
								<tr>
									<th style="width: 20%">
										<div><button type="button"  class="btn btn-default" onclick="window.print()"><b>พิมพ์ ใบชำระเงินค่าลงทะเบียนเรียน เสริมภาคฤดูร้อน</b></button></div>
									</th>
								</tr>
								<tr>
									<th style="width: 20%">
										<div><font color="#F70105"><b>ระบบการพิมพ์  รองรับ เว็บเบราว์เซอร์  Google Chrome และ  Microsoft Edge เท่านั้น<b></font></div>
									</th>								
								</tr>
							</thead>						
						</table>
						<table class="table" align="center" style="font-size: 18px;">
							<thead>
								<tr>
									<th style="width: 20%; font-size: 18px;"><div>ขนาดกระดาษ</div></th>
									<th style="width: 20%; font-size: 18px;"><div>แนวกระดาษ</div></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><div>A4&nbsp;:&nbsp;210mm&nbsp;X&nbsp;296mm</div></td>
									<td><div>แนวตั้ง</div></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>		
			</div>		
		</div>
	</div>

	<section class="sheet padding-10mm imgA">
	
	<?php
			if(($data_stu->IDLevel==41)){ ?>
		<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 65px; height: 69px;" alt=""/></td>
					<td>
						<center>
							<div style="font-style:bold; font-size: 25px;"><b>ใบยืนยันการลงทะเบียนเรียน&nbsp;เสริมภาคฤดูร้อน&nbsp;ปีการศึกษา&nbsp;<?php echo $data_summer;?>&nbsp;</b></div>
							<div style="font-style:bold; font-size: 25px;"><b>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;จังหวัดเชียงใหม่&nbsp;</b></div>			
						</center>
					</td>
					<td>
						<div style="font-style:bold; font-size: 20px;"><font color="#FA0408"><b>สำหรับชำระค่าลงทะเบียนที่ห้องการเงิน</b></font></div>
					</td>
				</tr>
			</tbody>
		</table><br>			
	<?php	}elseif(($data_stu->IDLevel==31)){ ?>
		<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 65px; height: 69px;" alt=""/></td>
					<td>
						<center>
							<div style="font-style:bold; font-size: 25px;"><b>ใบยืนยันการลงทะเบียนเรียน&nbsp;เสริมภาคฤดูร้อน&nbsp;ปีการศึกษา&nbsp;<?php echo $data_summer;?>&nbsp;</b></div>
							<div style="font-style:bold; font-size: 25px;"><b>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;จังหวัดเชียงใหม่&nbsp;</b></div>			
						</center>
					</td>
					<!--<td>
						<div style="font-style:bold; font-size: 20px;"><font color="#FA0408"><b>สำหรับชำระค่าลงทะเบียนที่ห้องการเงิน</b></font></div>
					</td>-->
				</tr>
			</tbody>
		</table><br>		
	<?php   }else{ ?>
		<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 65px; height: 69px;" alt=""/></td>
					<td>
						<center>
							<div style="font-style:bold; font-size: 25px;"><b>ใบชำระเงินค่าลงทะเบียนเรียน&nbsp;เสริมภาคฤดูร้อน&nbsp;ปีการศึกษา&nbsp;<?php echo $data_summer;?>&nbsp;</b></div>
							<div style="font-style:bold; font-size: 25px;"><b>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;จังหวัดเชียงใหม่&nbsp;</b></div>			
						</center>
					</td>
					<td>
						<div style="font-style:bold; font-size: 20px;"><font color="#FA0408"><b>สำหรับชำระค่าลงทะเบียนที่ห้องการเงิน</b></font></div>
					</td>
				</tr>
			</tbody>
		</table><br>		
	<?php   } ?>

		
		
		<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div style="font-style:bold; font-size: 20px;"><b>รหัสประจำตัวนักเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="10" value="<?php echo $data_stu->rsd_studentid;?>"><b>ชื่อ-สกุล</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="50" value="<?php echo $PrintReginaStuData->PRS_nameTH;?>"><b>ชั้น</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="5" value="<?php echo $data_stu->Sort_name;?>"></div>
						<div style="font-style:bold; font-size: 20px;"><b>ห้อง</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="5" value="<?php echo $data_stu->rsc_room;?>"><b>แผนการเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="60" value="<?php echo $data_stu->planname;?>"></div>
					</td>
				</tr>
			</tbody>
		</table>	
		<table style="width: 740px; font-size: 20px;" border="1" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th style="width: 140px;"><div><center>ลำดับ</center></div></th>
					<th style="width: 600px;"><div><center>รายการ&nbsp;วิชา&nbsp;/&nbsp;กิจกรรมที่ลงทะเบียน</center></div></th>
				</tr>
			</thead>
			<thead>
<?php
		$CSD_Count=1;
		$CSD_Sumpay=0;
		$CallSummerData=new PrintSummerData($user_login,$data_summer);
		foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
				<tr>
					<td style="width: 140px;"><div><center><?php echo $CSD_Count;?></center></div></td>
					<td style="width: 600px;"><div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
				</tr>		
<?php	$CSD_Count=$CSD_Count+1;
		$CSD_Sumpay=$CSD_Sumpay+$CallSummerDataRow["RSP_price"];
		} ?>			

			</thead>
		</table>	
		
		
<?php
		if(($data_stu->IDLevel==31)){ ?>

<?php   }else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$class=$data_stu->IDLevel;
		$class_ex=$data_stu->Sort_name_E2;
		$txt_billerId="099400043439110";
		$txt_ref1=strtoupper($usercopy."L".$class_ex);
		$txt_ref2=strtoupper("SUMMER".$data_term."0Y".$data_yaer);
		$txt_amount=number_format($CSD_Sumpay, 2, '.', '');                                                   
		$txt_width="104";
		$payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
	?>  		
			
			<table style="width: 740px; font-size: 20px;" border="0" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<td style="width: 370px;">
							<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="104" height="104"></div>
							<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
							<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
							<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
							<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($CSD_Sumpay, 2, '.', ',');?></div>
						</td>
						<td style="width: 370px;">
							<div style="text-align :center;">ช่องทางการชำระเงิน</div>
							<div>&nbsp;<img src="<?php echo base_url();?>Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;เงินสด</div>
							<div>&nbsp;<img src="<?php echo base_url();?>Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;เงินโอน&nbsp;(QRCode)</div>
							<div>&nbsp;&nbsp;</div>
							<div>ลงชื่อผู้รับเงิน....................................................</div>
						</td>
					</tr>
				<thead>
			</table>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php   } ?>		
		

		
		
		
		<table style="width: 740px; font-size: 20px;" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td><center>-------------------------------------------------------------------------ฉีกตามรอยปะ--------------------------------------------------------------------</center></td>
			<tr>
		</table>
		
	<?php
			if(($data_stu->IDLevel==31)){ ?>
		<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 65px; height: 69px;" alt=""/></td>
					<td>
						<center>
							<div style="font-style:bold; font-size: 25px;"><b>ใบยืนยันการลงทะเบียนเรียน&nbsp;เสริมภาคฤดูร้อน&nbsp;ปีการศึกษา&nbsp;<?php echo $data_summer;?>&nbsp;</b></div>
							<div style="font-style:bold; font-size: 25px;"><b>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;จังหวัดเชียงใหม่&nbsp;</b></div>			
						</center>
					</td>
					<td>
						<div style="font-style:bold; font-size: 20px;"><font color="#FA0408"><b>สำหรับนักเรียน</b></font></div>
					</td>
				</tr>
			</tbody>
		</table><br>			
	<?php	}else{ ?>
		<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 65px; height: 69px;" alt=""/></td>
					<td>
						<center>
							<div style="font-style:bold; font-size: 25px;"><b>ใบชำระเงินค่าลงทะเบียนเรียน&nbsp;เสริมภาคฤดูร้อน&nbsp;ปีการศึกษา&nbsp;<?php echo $data_summer;?>&nbsp;</b></div>
							<div style="font-style:bold; font-size: 25px;"><b>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;จังหวัดเชียงใหม่&nbsp;</b></div>			
						</center>
					</td>
					<td>
						<div style="font-style:bold; font-size: 20px;"><font color="#FA0408"><b>สำหรับนักเรียน</b></font></div>
					</td>
				</tr>
			</tbody>
		</table><br>			
	<?php	} ?>

		<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div style="font-style:bold; font-size: 20px;"><b>รหัสประจำตัวนักเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="10" value="<?php echo $data_stu->rsd_studentid;?>"><b>ชื่อ-สกุล</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="50" value="<?php echo $PrintReginaStuData->PRS_nameTH;?>"><b>ชั้น</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="5" value="<?php echo $data_stu->Sort_name;?>"></div>
						<div style="font-style:bold; font-size: 20px;"><b>ห้อง</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="5" value="<?php echo $data_stu->rsc_room;?>"><b>แผนการเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="60" value="<?php echo $data_stu->planname;?>"></div>
					</td>
				</tr>
			</tbody>
		</table>		
		
		<table style="width: 740px; font-size: 20px;" border="1" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th style="width: 140px;"><div><center>ลำดับ</center></div></th>
					<th style="width: 600px;"><div><center>รายการ&nbsp;วิชา&nbsp;/&nbsp;กิจกรรมที่ลงทะเบียน</center></div></th>
				</tr>
			</thead>
			<thead>
<?php
		$CSD_Count=1;
		//$CSD_Sumpay=0;
		$CallSummerData=new PrintSummerData($user_login,$data_summer);
		foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
				<tr>
					<td style="width: 140px;"><div><center><?php echo $CSD_Count;?></center></div></td>
					<td style="width: 600px;"><div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
				</tr>		
<?php	$CSD_Count=$CSD_Count+1;
		//$CSD_Sumpay=$CSD_Sumpay+$CallSummerDataRow["RSP_price"];
		} ?>			

			</thead>
		</table>		
		
	
	</section>

    </body>
   
</html>

                            
                <?php       }else{
                                //$this->session->unset_userdata("rc_user");
                                //exit("<script>window.location='$golink/print_supplementary/error';</script>");
                            }
                    }
                }else{
                    $admin_log=$this->load->database("default",TRUE);		
                    $admin_log=$this->db->query("SELECT COUNT(`login_id`) AS `int_uesr` 
											     FROM `login` 
											     WHERE `use_status`='1'  
											     AND `login_id`='{$LoginKey}'");
                    foreach($admin_log->result_array() as $log_row){
                            if($log_row["int_uesr"]>=1){ 
	
	
							?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->  

	<style>
		.psrA{
			margin: auto;
			border: 3px solid #73AD21;
		}
	</style>

<?php
    include("view/database/pdo_data.php");
	include("view/database/pdo_conndatastu.php");
	include("view/database/pdo_admission.php"); 
    
	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");	
	
	include("view/database/class_pdo.php");    
    include("view/database/regina_student.php");
    include("view/function/pay_scb.php");
    
	$data_summer=filter_input(INPUT_POST,'data_summer');
	$data_yaer=filter_input(INPUT_POST,'data_yaer');
	$data_term=filter_input(INPUT_POST,'data_term');
	//$user_login=filter_input(INPUT_POST,'user_login');
	$user_login=$RcId;
    /*$data_summer=2565;
	$data_yaer=2564;
	$data_term=2;
	$user_login=17989;*/
	//**********************************************	

	
    $PrintReginaStuData=new PrintReginaStuData($user_login);
    
	$stu_not=filter_input(INPUT_POST,'stu_not');
	
	//**********************************************
//-----------------------------------------------------------------	
	//$RsStudentData=new DataRsStudentDataA($user_login,$data_yaer,$class);   
	$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
		if(isset($data_stu->rsd_studentid)){
			$RC_rsd_studentid=$data_stu->rsd_studentid;
			$RC_Sort_name=$data_stu->Sort_name;
			$RC_rsc_room=$data_stu->rsc_room;
			$RC_planname=$data_stu->planname;
			$RC_IDLevel=$data_stu->IDLevel;
			$RC_Sort_name_E2=$data_stu->Sort_name_E2;
		}else{
//-----------------------------------------------------------------			
			//$RsLavaL=new PrintLavaL($RsStudentData->RSDClass);	
//-----------------------------------------------------------------			
			//$RC_rsd_studentid=$RsStudentData->RSDKey;
			$RC_Sort_name=$RsLavaL->RunPrintLavaL();
			$RC_rsc_room="0";
			//$RC_planname="($RsStudentData->RSDSchool) ".$RsStudentData->RSDPhone;
			//$RC_IDLevel=$RsStudentData->RSDClass;
			$RC_Sort_name_E2=$RsLavaL->RunPrintLavaEh();			
		}
//-----------------------------------------------------------------	

	/*$stu_data=new regina_stu_data($user_login);
		if(isset($stu_data->rsd_studentid)){
			$mynameTh=$PrintReginaStuData->PRS_nameTH;
		}else{
			$mynameTh=$RsStudentData->mynameTh;
		}*/
	
	
	$stu_data=new PrintReginaStuDataClass($user_login);
		if((isset($stu_data->PRS_nameTH))){
			$mynameTh=$stu_data->PRS_nameTH;
		}else{
			$mynameTh=$RsStudentData->mynameTh;
		}
	
	
?>



<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>ใบชำระเงินค่าลงทะเบียนเรียน เสริมภาคฤดูร้อน</title>
<!-- Global stylesheets -->
		<link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
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
				font-size: 30px;
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
					font-size: 18pt; 
							
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
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/bootstrap.min.js"></script>
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
						<table class="table" align="center">
							<thead>
								<tr>
									<th style="width: 20%">
										<div><button type="button"  class="btn btn-default" onclick="window.print()"><b>พิมพ์ ใบชำระเงินค่าลงทะเบียนเรียน เสริมภาคฤดูร้อน</b></button></div>
									</th>
								</tr>
								<tr>
									<th style="width: 20%">
										<div><font color="#F70105"><b>ระบบการพิมพ์  รองรับ เว็บเบราว์เซอร์  Google Chrome และ  Microsoft Edge เท่านั้น<b></font></div>
									</th>								
								</tr>
							</thead>						
						</table>
						<table class="table" align="center">
							<thead>
								<tr>
									<th style="width: 20%"><div>ขนาดกระดาษ</div></th>
									<th style="width: 20%"><div>แนวกระดาษ</div></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><div>A4&nbsp;:&nbsp;210mm&nbsp;X&nbsp;296mm</div></td>
									<td><div>แนวตั้ง</div></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>		
			</div>		
		</div>
	</div>

	<section class="sheet padding-10mm imgA">
	
		<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 65px; height: 69px;" alt=""/></td>
					<td>
						<center>
							<div style="font-style:bold; font-size: 25px;"><b>ใบชำระเงินค่าลงทะเบียนเรียน&nbsp;เสริมภาคฤดูร้อน&nbsp;ปีการศึกษา&nbsp;<?php echo $data_summer;?>&nbsp;</b></div>
							<div style="font-style:bold; font-size: 25px;"><b>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;จังหวัดเชียงใหม่&nbsp;</b></div>			
						</center>
					</td>
					<td>
						<div style="font-style:bold; font-size: 20px;"><font color="#FA0408"><b>สำหรับชำระค่าลงทะเบียนที่ห้องการเงิน</b></font></div>
					</td>
				</tr>
			</tbody>
		</table><br>
		<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div style="font-style:bold; font-size: 20px;"><b>รหัสประจำตัวนักเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="10" value="<?php echo $RC_rsd_studentid;?>"><b>ชื่อ-สกุล</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="50" value="<?php echo $mynameTh;?>"><b>ชั้น</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="5" value="<?php echo $RC_Sort_name;?>"></div>
						<div style="font-style:bold; font-size: 20px;"><b>ห้อง</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="5" value="<?php echo $RC_rsc_room;?>"><b>แผนการเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="60" value="<?php echo $RC_planname;?>"></div>
					</td>
				</tr>
			</tbody>
		</table>	
		<table style="width: 740px; font-size: 20px;" border="1" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th style="width: 140px;"><div><center>ลำดับ</center></div></th>
					<th style="width: 600px;"><div><center>รายการ&nbsp;วิชา&nbsp;/&nbsp;กิจกรรมที่ลงทะเบียน</center></div></th>
				</tr>
			</thead>
			<thead>
<?php
		$CSD_Count=1;
		$CSD_Sumpay=0;
		$CallSummerData=new PrintSummerData($user_login,$data_summer);
		foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
				<tr>
					<td style="width: 140px;"><div><center><?php echo $CSD_Count;?></center></div></td>
					<td style="width: 600px;"><div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
				</tr>		
<?php	$CSD_Count=$CSD_Count+1;
		$CSD_Sumpay=$CSD_Sumpay+$CallSummerDataRow["RSP_price"];
		} ?>			

			</thead>
		</table>	
		
<?php
    $class=$RC_rsd_studentid;
    $class_ex=$RC_Sort_name_E2;
    $txt_billerId="099400043439110";
    $txt_ref1=strtoupper($user_login."L".$class_ex);
    $txt_ref2=strtoupper("SUMMER".$data_term."0Y".$data_yaer);
    $txt_amount=number_format($CSD_Sumpay, 2, '.', '');                                                   
    $txt_width="104";
    $payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
?>  		
		
		<table style="width: 740px; font-size: 20px;" border="0" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<td style="width: 370px;">
					    <div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="104" height="104"></div>
						<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
						<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
						<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
						<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($CSD_Sumpay, 2, '.', ',');?></div>
					</td>
					<td style="width: 370px;">
						<div style="text-align :center;">ช่องทางการชำระเงิน</div>
						<div>&nbsp;<img src="<?php echo base_url();?>Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;เงินสด</div>
						<div>&nbsp;<img src="<?php echo base_url();?>Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;เงินโอน&nbsp;(QRCode)</div>
						<div>&nbsp;&nbsp;</div>
						<div>ลงชื่อผู้รับเงิน....................................................</div>
					</td>
				</tr>
			<thead>
		</table>
		
		<table style="width: 740px; font-size: 20px;" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td><center>-------------------------------------------------------------------------ฉีกตามรอยปะ--------------------------------------------------------------------</center></td>
			<tr>
		</table>
		
		<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 65px; height: 69px;" alt=""/></td>
					<td>
						<center>
							<div style="font-style:bold; font-size: 25px;"><b>ใบชำระเงินค่าลงทะเบียนเรียน&nbsp;เสริมภาคฤดูร้อน&nbsp;ปีการศึกษา&nbsp;<?php echo $data_summer;?>&nbsp;</b></div>
							<div style="font-style:bold; font-size: 25px;"><b>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;จังหวัดเชียงใหม่&nbsp;</b></div>			
						</center>
					</td>
					<td>
						<div style="font-style:bold; font-size: 20px;"><font color="#FA0408"><b>สำหรับนักเรียน</b></font></div>
					</td>
				</tr>
			</tbody>
		</table><br>
		<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div style="font-style:bold; font-size: 20px;"><b>รหัสประจำตัวนักเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="10" value="<?php echo $RC_rsd_studentid;?>"><b>ชื่อ-สกุล</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="50" value="<?php echo $mynameTh;?>"><b>ชั้น</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="5" value="<?php echo $RC_Sort_name;?>"></div>
						<div style="font-style:bold; font-size: 20px;"><b>ห้อง</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="5" value="<?php echo $RC_rsc_room;?>"><b>แผนการเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="60" value="<?php echo $RC_planname;?>"></div>
					</td>
				</tr>
			</tbody>
		</table>		
		
		<table style="width: 740px; font-size: 20px;" border="1" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th style="width: 140px;"><div><center>ลำดับ</center></div></th>
					<th style="width: 600px;"><div><center>รายการ&nbsp;วิชา&nbsp;/&nbsp;กิจกรรมที่ลงทะเบียน</center></div></th>
				</tr>
			</thead>
			<thead>
<?php
		$CSD_Count=1;
		//$CSD_Sumpay=0;
		$CallSummerData=new PrintSummerData($user_login,$data_summer);
		foreach($CallSummerData->RunPrintSummerData() as $rc=>$CallSummerDataRow){ ?>
				<tr>
					<td style="width: 140px;"><div><center><?php echo $CSD_Count;?></center></div></td>
					<td style="width: 600px;"><div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $CallSummerDataRow["RSD_txtTh"];?></div></td>
				</tr>		
<?php	$CSD_Count=$CSD_Count+1;
		//$CSD_Sumpay=$CSD_Sumpay+$CallSummerDataRow["RSP_price"];
		} ?>			

			</thead>
		</table>		
		
	
	</section>

    </body>
   
</html>

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->                                
                <?php       }else{
                                //$this->session->unset_userdata("rc_user");
                                //exit("<script>window.location='$golink/print_supplementary/error';</script>");
                            }
                    }                             
                }
            }                       
        }

?>
