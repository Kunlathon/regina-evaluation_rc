<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
        if(($this->session->userdata("rc_user")==null)){
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
    
	include("view/database/class_pdo.php");    
    include("view/database/regina_student.php");
    include("view/function/pay_scb.php");
    
	$data_yaer=filter_input(INPUT_POST,'data_yaer');
	$data_term=filter_input(INPUT_POST,'data_term');
	$user_login=filter_input(INPUT_POST,'user_login');
	
	/*$data_yaer=2564;
	$data_term=2;
	$user_login=16050;*/
	//**********************************************	
	$pay_fresh31=0;
	$pat_fresh32=0;
	$pat_fresh33=0;
	$pay_fresh41=0;
	$pay_fresh42=0;
	$pay_fresh43=0;
	
    $PrintReginaStuData=new PrintReginaStuData($user_login);
    
	$stu_not=filter_input(INPUT_POST,'stu_not');
	
	//**********************************************
	$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
	$stu_data=new regina_stu_data($user_login);
	
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
		<title>ใบชำระเงินค่าลงทะเบียนเรียน&nbsp;นอกตารางเรียน</title>
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
										<div><button type="button"  class="btn btn-default" onclick="window.print()"><b><h3>พิมพ์ ใบลงทะเบียน เรียนเสริมนอกเวลาเรียน</h3></b></button></div>
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
      <td><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 75px; height: 73px;" alt=""/></td>
   	  <td>
		  <center>
	  		<div style="font-size: 22px; font-weight: bold;"><b>ใบลงทะเบียน  เรียนเสริมนอกเวลาเรียน &nbsp;&nbsp;ภาคเรียนที่&nbsp;<?php echo $data_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_yaer;?>&nbsp;</b></div>
	  		<div style="font-size: 22px; font-weight: bold;"><b>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;&nbsp;จังหวัดเชียงใหม่</b></div>			
		  </center>
  	  </td>
	  <td>
			<div style="color: #FA0408; font-weight: bold;">สำหรับชำระค่าลงทะเบียนที่ห้องการเงิน</div>
	  </td>
    </tr>
  </tbody>
</table><br>
<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td>
		<div style="font-family: THSarabunNew;font-size: 19px;"><b>รหัสประจำตัวนักเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 19px; text-align: center; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; " size="10" value="<?php echo $data_stu->rsd_studentid;?>"><b>ชื่อ-สกุล</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 19px; text-align: center; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted;" size="50" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $PrintReginaStuData->PRS_nameTH;?>"><b>ชั้น</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 19px; text-align: center; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted;" size="11" value="<?php echo $data_stu->Sort_name;?>"></div>
		<div style="font-family: THSarabunNew;font-size: 19px;"><b>ห้อง</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 19px; text-align: center; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted;" size="5" value="<?php echo $data_stu->rsc_room;?>"><b>แผนการเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 19px; text-align: center; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted;" size="80" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data_stu->planname;?>"></div>
	  </td>
    </tr>
  </tbody>
</table>    
    
<?php
		if(($stu_not=="stu_not")){
			if(($data_stu->IDLevel==31)){
				if(($data_stu->rc_plan==12)){ ?>
				
			<center><table style="width: 740px;" border="1" cellpadding="0" cellspacing="0">
			  <tbody>
				<tr>
				  <td><center>รายการ</center></td>
				  <td><center>จำนวนเงิน</center></td>
				</tr>
			<?php
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='N'
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
				<tr>
				  <td><center><?php echo $pay_row["supplementary_txt"];?></center></td>
				  <td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
				</tr>				
		<?php	}?>					

			  </tbody>
			</table></center>				
				
		<?php	}else{
					
				}
			}elseif($data_stu->IDLevel==32){
				if($data_stu->rc_plan==12){ ?>
				
			<center><table style="width: 740px;" border="1" cellpadding="0" cellspacing="0">
			  <tbody>
				<tr>
				  <td><center>รายการ</center></td>
				  <td><center>จำนวนเงิน</center></td>
				</tr>
			<?php
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='N'
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
				<tr>
				  <td><center><?php echo $pay_row["supplementary_txt"];?></center></td>
				  <td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
				</tr>				
		<?php	}?>					

			  </tbody>
			</table></center>
				
		<?php	}else{
					
				}				
			}elseif($data_stu->IDLevel==33){
				if($data_stu->rc_plan==12){ ?>
					
			<center><table style="width: 740px;" border="1" cellpadding="0" cellspacing="0">
			  <tbody>
				<tr>
				  <td><center>รายการ</center></td>
				  <td><center>จำนวนเงิน</center></td>
				</tr>
			<?php
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='N'
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
				<tr>
				  <td><center><?php echo $pay_row["supplementary_txt"];?></center></td>
				  <td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
				</tr>				
		<?php	}?>					

			  </tbody>
			</table></center>					
					
		<?php	}else{
					
				}				
			}elseif($data_stu->IDLevel==41){
				if($data_stu->rc_plan==13){ ?>
					
			<center><table style="width: 740px;" border="1" cellpadding="0" cellspacing="0">
			  <tbody>
				<tr>
				  <td><center>รายการ</center></td>
				  <td><center>จำนวนเงิน</center></td>
				</tr>
			<?php
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='N'
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
				<tr>
				  <td><center><?php echo $pay_row["supplementary_txt"];?></center></td>
				  <td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
				</tr>				
		<?php	}?>					

			  </tbody>
			</table></center>
					
		<?php	}else{
					
				}
			}else{
				
			} ?>
			
<p>
    <table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
              <td>
              
<?php


    $class=$data_stu->IDLevel;
    $class_ex=$data_stu->Sort_name_E2;
    $txt_billerId="099400043439110";
    $txt_ref1=strtoupper($usercopy."L".$class_ex);
    $txt_ref2=strtoupper("TUTOR0T".$data_term."0Y".$data_yaer);
    //$txt_amount;                                                   
    $txt_width="104";
    $payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
?>              
                <div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="104" height="104"></div>
                <div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
                <div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
                <div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
                <div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($txt_amount, 2, '.', ',');?></div>
              </td>
              <td>
                <div><b>วิธีการชำระ</b></div>
                <div>1&nbsp;.&nbsp;ทำการสแกน QR Code ที่ปรากฏในเพจนี้ ด้วยแอปพลิเคชัน Mobile Banking ของท่าน</div>
                <div>2&nbsp;.&nbsp;ตรวจสอบข้อมูลที่ปรากฏใน Mobile Banking ให้ถูกต้องก่อนชำระเงิน</div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบเลขประจำตัวนักเรียนให้ถูกต้อง</div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ref1&nbsp;:&nbsp;เลขประจำตัวนักเรียน&nbsp;5&nbsp;หลัก &nbsp;L&nbsp;คือชั้น</div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ref2&nbsp;:&nbsp;ตัวอักษรคำว่า&nbsp;"TUTOR"&nbsp;0T&nbsp;คือ&nbsp;ภาคเรียน&nbsp;0Y&nbsp;คือ&nbsp;ปีการศึกษา</div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบจำนวนเงินให้ถูกต้อง</div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบชื่อผู้รับเงินต้องเป็น โรงเรียนเรยีนาเชลีวิทยาลัย หรือ REGINA COELI COLLEGE SCHOOL เท่านั้น</div>
                <div>3&nbsp;.&nbsp;สำหรับหลักฐานการชำระเงินให้ท่านเก็บไว้เป็นหลักฐาน</div>
                <div>4&nbsp;.&nbsp;ทางโรงเรียนจะทำการตรวจสอบรายการและยืนยันการชำระเงินของท่าน </div>
                <div>5&nbsp;.&nbsp;การชำระเงินจะเสร็จสมบูรณ์ เมื่อทางโรงเรียนได้ตรวจสอบการชำระเงินของท่านเรียบร้อยแล้ว</div>
                <div>6&nbsp;.&nbsp;หากต้องการใบเสร็จรับเงิน ติดต่อขอรับได้ที่ห้องการเงินของโรงเรียน</div>
                <div>7&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการชำระเงิน กรณาติดต่อ ห้องการเงิน 053-282395 ต่อ 105</div>                                                                
                <div>8&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการเรียนเสริมนอกตารางเรียนกรณาติดต่อ ห้องวิชาการ 053-282395 ต่อ 121</div>
              </td>
            </tr>
        </tbody>
    </table>
</p>	

<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td>
		<div><center>-------------------------------------------------------------------------ฉีกตามรอยปะ--------------------------------------------------------------------</center></div>
	  </td>
    </tr>
  </tbody>
</table>		
			
<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td><img src="../../../../../Template/global_assets/images/logoserviam.png" style="width: 75px; height: 73px;" alt=""/></td>
   	  <td>
		  <center>
	  		<div style="font-size: 22px; font-weight: bold;"><b>ใบลงทะเบียน  เรียนเสริมนอกเวลาเรียน &nbsp;&nbsp;ภาคเรียนที่&nbsp;<?php echo $data_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_yaer;?>&nbsp;</b></div>
	  		<div style="font-size: 22px; font-weight: bold;"><b>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;&nbsp;จังหวัดเชียงใหม่ (สำหรับชำระค่าลงทะเบียนที่ห้องการเงิน)</b></div>			
		  </center>
  	  </td>
	  <td>
		<div style="color=#FA0408; font-weight: bold;">สำหรับชำระค่าลงทะเบียนที่ห้องการเงิน</div>
	  </td>
    </tr>
  </tbody>
</table><br>
<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td>
		<div style="font-family: THSarabunNew;font-size: 19px;"><b>รหัสประจำตัวนักเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 19px; text-align: center; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted;" size="10" value="<?php echo $data_stu->rsd_studentid;?>"><b>ชื่อ-สกุล</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 19px; text-align: center; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted;" size="50" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $PrintReginaStuData->PRS_nameTH;?>"><b>ชั้น</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 19px; text-align: center; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted;" size="11" value="<?php echo $data_stu->Sort_name;?>"></div>
		<div style="font-family: THSarabunNew;font-size: 19px;"><b>ห้อง</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 19px; text-align: center; border:0px; text-align: center; border:0px;" size="5" value="<?php echo $data_stu->rsc_room;?>"><b>แผนการเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 19px; text-align: center; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted;" size="80" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data_stu->planname;?>"></div>
	  </td>
    </tr>
  </tbody>
</table> 		

	<?php	if($data_stu->IDLevel==31){
				if($data_stu->rc_plan==12){ ?>
				
			<center><table style="width: 740px;" border="1" cellpadding="0" cellspacing="0">
			  <tbody>
				<tr>
				  <td><center>รายการ</center></td>
				  <td><center>จำนวนเงิน</center></td>
				</tr>
			<?php
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='N'
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
				<tr>
				  <td><center><?php echo $pay_row["supplementary_txt"];?></center></td>
				  <td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
				</tr>				
		<?php	}?>					

			  </tbody>
			</table></center>				
				
		<?php	}else{
					
				}
			}elseif($data_stu->IDLevel==32){
				if($data_stu->rc_plan==12){ ?>
				
			<center><table style="width: 740px;" border="1" cellpadding="0" cellspacing="0">
			  <tbody>
				<tr>
				  <td><center>รายการ</center></td>
				  <td><center>จำนวนเงิน</center></td>
				</tr>
			<?php
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='N'
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
				<tr>
				  <td><center><?php echo $pay_row["supplementary_txt"];?></center></td>
				  <td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
				</tr>				
		<?php	}?>					

			  </tbody>
			</table></center>
				
		<?php	}else{
					
				}				
			}elseif($data_stu->IDLevel==33){
				if($data_stu->rc_plan==12){ ?>
					
			<center><table style="width: 740px;" border="1" cellpadding="0" cellspacing="0">
			  <tbody>
				<tr>
				  <td><center>รายการ</center></td>
				  <td><center>จำนวนเงิน</center></td>
				</tr>
			<?php
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='N'
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
				<tr>
				  <td><center><?php echo $pay_row["supplementary_txt"];?></center></td>
				  <td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
				</tr>				
		<?php	}?>					

			  </tbody>
			</table></center>					
					
		<?php	}else{
					
				}				
			}elseif($data_stu->IDLevel==41){
				if($data_stu->rc_plan==13){ ?>
					
			<center><table style="width: 740px;" border="1" cellpadding="0" cellspacing="0">
			  <tbody>
				<tr>
				  <td><center>รายการ</center></td>
				  <td><center>จำนวนเงิน</center></td>
				</tr>
			<?php
				$pay_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay` 
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='N'
						  and `supplementary_planA`='{$data_stu->rc_plan}'";
				$pay_rs=new notrow_evaluation($pay_sql);
				foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
				<tr>
				  <td><center><?php echo $pay_row["supplementary_txt"];?></center></td>
				  <td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
				</tr>				
		<?php	}?>					

			  </tbody>
			</table></center>
					
		<?php	}else{
					
				}
			}else{
				
				
				
				
			} ?>	
			
<p>
    <table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
              <td>
              
<?php


    $class=$data_stu->IDLevel;
    $class_ex=$data_stu->Sort_name_E2;
    $txt_billerId="099400043439110";
    $txt_ref1=strtoupper($usercopy."L".$class_ex);
    $txt_ref2=strtoupper("TUTOR0T".$data_term."0Y".$data_yaer);
    //$txt_amount;                                                   
    $txt_width="104";
    $payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
?>              
                <div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="104" height="104"></div>
                <div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
                <div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
                <div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
                <div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($txt_amount, 2, '.', ',');?></div>
              </td>
              <td>
                <div><b>วิธีการชำระ</b></div>
                <div>1&nbsp;.&nbsp;ทำการสแกน QR Code ที่ปรากฏในเพจนี้ ด้วยแอปพลิเคชัน Mobile Banking ของท่าน</div>
                <div>2&nbsp;.&nbsp;ตรวจสอบข้อมูลที่ปรากฏใน Mobile Banking ให้ถูกต้องก่อนชำระเงิน</div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบเลขประจำตัวนักเรียนให้ถูกต้อง</div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ref1&nbsp;:&nbsp;เลขประจำตัวนักเรียน&nbsp;5&nbsp;หลัก &nbsp;L&nbsp;คือชั้น</div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ref2&nbsp;:&nbsp;ตัวอักษรคำว่า&nbsp;"TUTOR"&nbsp;0T&nbsp;คือ&nbsp;ภาคเรียน&nbsp;0Y&nbsp;คือ&nbsp;ปีการศึกษา</div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบจำนวนเงินให้ถูกต้อง</div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบชื่อผู้รับเงินต้องเป็น โรงเรียนเรยีนาเชลีวิทยาลัย หรือ REGINA COELI COLLEGE SCHOOL เท่านั้น</div>
                <div>3&nbsp;.&nbsp;สำหรับหลักฐานการชำระเงินให้ท่านเก็บไว้เป็นหลักฐาน</div>
                <div>4&nbsp;.&nbsp;ทางโรงเรียนจะทำการตรวจสอบรายการและยืนยันการชำระเงินของท่าน </div>
                <div>5&nbsp;.&nbsp;การชำระเงินจะเสร็จสมบูรณ์ เมื่อทางโรงเรียนได้ตรวจสอบการชำระเงินของท่านเรียบร้อยแล้ว</div>
                <div>6&nbsp;.&nbsp;หากต้องการใบเสร็จรับเงิน ติดต่อขอรับได้ที่ห้องการเงินของโรงเรียน</div>
                <div>7&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการชำระเงิน กรณาติดต่อ ห้องการเงิน 053-282395 ต่อ 105</div>                                                                
                <div>8&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการเรียนเสริมนอกตารางเรียนกรณาติดต่อ ห้องวิชาการ 053-282395 ต่อ 121</div>
              </td>
            </tr>
        </tbody>
    </table>
</p>			
			
			
<?php	}else{ ?>
		
<p><table style="width: 740px; font-family: THSarabunNew;font-size: 19px;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td><center><b><u>ตารางเรียนเสริมนอกเวลาเรียน</u></b></center></td>
    </tr>
  </tbody>
</table></p>
<table style="width: 740px; font-family: THSarabunNew;font-size: 19px;" border="1" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <th><div><center>ลำดับ</center></div></th>
      <th><div><center>วิชา</center></div></th>
      <th><div><center>วันที่เรียน</center></div></th>
    </tr>
	
<?php
	$count_num=1;
	$print_subjectSql="SELECT `supplementary_subject`.`ss_id` , `supplementary_subject`.`ss_txtth` , `supplementary_sturs`.`ss_mon` , `supplementary_sturs`.`ss_tues` , `supplementary_sturs`.`ss_wedne` , `supplementary_sturs`.`ss_thurs` , `supplementary_sturs`.`ss_fri` , `supplementary_sturs`.`ss_satur` , `supplementary_sturs`.`ss_sun`
					   FROM `supplementary_sturs`
					   JOIN `supplementary_subject` ON ( `supplementary_sturs`.`ss_id` = `supplementary_subject`.`ss_id` )
					   WHERE `supplementary_sturs`.`sup_stuid` = '{$user_login}'
					   AND `supplementary_sturs`.`sup_t` = '{$data_term}'
					   AND `supplementary_sturs`.`sup_l` = '{$data_stu->IDLevel}'
					   AND `supplementary_sturs`.`sup_year` = '{$data_yaer}'";
	$print_subjectRs=new row_evaluation($print_subjectSql);
	foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectRow){

		if($print_subjectRow["ss_mon"]==1){ ?>
    <tr>
		<td><center><?php echo $count_num;?></center></td>
		
		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันจันทร์</td>
    </tr>			
<?php	}else{
			
			
		}		
		
		if($print_subjectRow["ss_tues"]==1){ ?>
    <tr>
		<td><center><?php echo $count_num;?></center></td>		

		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันอังคาร</td>
    </tr>	
<?php	}else{
			
			
		}		
		
		if($print_subjectRow["ss_wedne"]==1){ ?>
    <tr>
		<td><center><?php echo $count_num;?></center></td>
	
		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันพุธ</td>
    </tr>
<?php	}else{


		}		
		
		if($print_subjectRow["ss_thurs"]==1){ ?>
    <tr>
		<td><center><?php echo $count_num;?></center></td>
	
		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันพฤหัสบดี</td>		
    </tr>			
<?php   }else{
			
		}		
		
		if($print_subjectRow["ss_fri"]==1){ ?>
    <tr>
		<td><center><?php echo $count_num;?></center></td>		

		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันศุกร์</td>
    </tr>			
<?php	}else{
			
		}		
		
		if($print_subjectRow["ss_satur"]==1){ ?>
    <tr>
		<td><center><?php echo $count_num;?></center></td>		
	
		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันเสาร์</td>
    </tr>			
<?php	}else{
			
		}		
		
		if($print_subjectRow["ss_sun"]==1){ ?>
    <tr>
		<td><center><?php echo $count_num;?></center></td>		
	
		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันอาทิตย์</td>
    </tr>			
<?php	}else{
			
		}
		
	$count_num=$count_num+1;}
?>	
	
	
	
	
	
	<?php
		if(($data_stu->IDLevel==31)){
			if(($data_stu->rc_plan==12)){
			
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if(($supple_stursRow["ss_activity"]=="cilk_true")){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php echo $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
//echo $data_term;
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_true' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
											
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										//echo $data_term;
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_flas'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}	
			}else{

				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
							
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
									
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										} ?>
<!--************************************************************************************************-->
										<?php 
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',')." บาท";?></center></td>
											</tr>
									
<!--************************************************************************************************-->									
						<?php	}else{
									//********************
								}
								
							}
//-------------------------------------------------------------------------------------------------------							
						}else{
							//**********************************
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
							
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
									
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										} ?>
<!--************************************************************************************************-->
										<?php 
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',')." บาท";?></center></td>
											</tr>
									
<!--************************************************************************************************-->									
						<?php	}else{
									//********************
								}
								
							}
//-------------------------------------------------------------------------------------------------------							
						}else{
							//**********************************
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}

			}	
		}elseif($data_stu->IDLevel==32){
			if($data_stu->rc_plan==12){
			
			 
			 
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										//echo $data_term;
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_true' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
										
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										//echo $data_term;
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_flas'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}	
			}else{
				
				
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
							
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
									
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										} ?>
<!--************************************************************************************************-->
										<?php 
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',')." บาท";?></center></td>
											</tr>
									
<!--************************************************************************************************-->									
						<?php	}else{
									//********************
								}
								
							}
//-------------------------------------------------------------------------------------------------------							
						}else{
							//**********************************
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
							
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
									
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										} ?>
<!--************************************************************************************************-->
										<?php 
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',')." บาท";?></center></td>
											</tr>
									
<!--************************************************************************************************-->									
						<?php	}else{
									//********************
								}
								
							}
//-------------------------------------------------------------------------------------------------------							
						}else{
							//**********************************
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}
				
			}			
		}elseif($data_stu->IDLevel==33){
			if($data_stu->rc_plan==13){
//*****************************************************************************************
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										//echo $data_term;
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_true' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh33;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;											
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										//echo $data_term;
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_flas'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh33;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}
//*****************************************************************************************				
			}else{
//*****************************************************************************************	
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										//echo $data_term;
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_true' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh33;																						
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										//echo $data_term;
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_flas'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh33;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;
											}
										

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}			
//*****************************************************************************************				
			}
		}elseif($data_stu->IDLevel==41){
			if($data_stu->rc_plan==13){
//*****************************************************************************************
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}'";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											
											if(isset($payA_row["supplementary_pay"])){
												$set_payB=$payA_row["supplementary_pay"];
											}else{
												$set_payB=0;
											}
											
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh41;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;											
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
					
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											
											if(isset($payA_row["supplementary_pay"])){
												$set_payA=$payA_row["supplementary_pay"];
											}else{
												$set_payA=0;
											}
											
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											
											if(isset($payA_row["supplementary_pay"])){
												$set_payB=$payA_row["supplementary_pay"];
											}else{
												$set_payB=0;
											}
											
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
												
										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+@$set_payB;
												$sum_pay=$sum_pay-$pay_fresh41;												
											}else{
												$sum_pay=($set_payA*$count_academic)+@$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}
//*****************************************************************************************				
			}else{
//*****************************************************************************************	
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='14'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='14' 
									  and `supplementary_planB`='14' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='14' 
												   and `supplementary_planB`='14' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='14' 
												  and `supplementary_planB`='14' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh41;																						
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='14'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='14' 
									  and `supplementary_planB`='14' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='14' 
												   and `supplementary_planB`='14' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='14' 
												  and `supplementary_planB`='14' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}										
											
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh41;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;
											}
										

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}			
//*****************************************************************************************				
			}						
						
		}elseif($data_stu->IDLevel==42){	
			if($data_stu->rc_plan==13){
//*****************************************************************************************
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}'";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh42;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;											
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
					
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
											
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh42;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}
//*****************************************************************************************				
			}else{
//*****************************************************************************************	
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='14'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='14' 
									  and `supplementary_planB`='14' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='14' 
												   and `supplementary_planB`='14' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='14' 
												  and `supplementary_planB`='14' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh42;																						
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='14'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='14' 
									  and `supplementary_planB`='14' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='14' 
												   and `supplementary_planB`='14' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='14' 
												  and `supplementary_planB`='14' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
																	
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh42;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;
											}
										

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}			
//*****************************************************************************************				
			}			
		}elseif($data_stu->IDLevel==43){
		
			if($data_stu->rc_plan==13){
//*****************************************************************************************
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}'";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End
										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh43;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;											
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
					
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
											
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End								
		
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh43;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}
//*****************************************************************************************				
			}else{
//*****************************************************************************************	
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='14'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='14' 
									  and `supplementary_planB`='14' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='14' 
												   and `supplementary_planB`='14' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='14' 
												  and `supplementary_planB`='14' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh43;																						
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='14'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='14' 
									  and `supplementary_planB`='14' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='14' 
												   and `supplementary_planB`='14' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='14' 
												  and `supplementary_planB`='14' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											if(isset($payA_row["supplementary_pay"])){
												$set_payB=$payA_row["supplementary_pay"];
											}else{
												$set_payB=0;
											}
											
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh43;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;
											}
										

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}			
//*****************************************************************************************				
			}			
		
		}else{
			//****
		}
	
	
	?>
	
	
	
	


	
	



  </tbody>
</table>
<p>
    <table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
              <td>
              
<?php


    $class=$data_stu->IDLevel;
    $class_ex=$data_stu->Sort_name_E2;
    $txt_billerId="099400043439110";
    $txt_ref1=strtoupper($usercopy."L".$class_ex);
    $txt_ref2=strtoupper("TUTOR0T".$data_term."0Y".$data_yaer);
    //$txt_amount;                                                   
    $txt_width="104";
    $payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
?>              
                <div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="104" height="104"></div>
                <div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
                <div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
                <div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
                <div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($txt_amount, 2, '.', ',');?></div>
              </td>
              <td>
                <div><b>วิธีการชำระ</b></div>
                <div>1&nbsp;.&nbsp;ทำการสแกน QR Code ที่ปรากฏในเพจนี้ ด้วยแอปพลิเคชัน Mobile Banking ของท่าน</div>
                <div>2&nbsp;.&nbsp;ตรวจสอบข้อมูลที่ปรากฏใน Mobile Banking ให้ถูกต้องก่อนชำระเงิน</div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบเลขประจำตัวนักเรียนให้ถูกต้อง</div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ref1&nbsp;:&nbsp;เลขประจำตัวนักเรียน&nbsp;5&nbsp;หลัก &nbsp;L&nbsp;คือชั้น</div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ref2&nbsp;:&nbsp;ตัวอักษรคำว่า&nbsp;"TUTOR"&nbsp;0T&nbsp;คือ&nbsp;ภาคเรียน&nbsp;0Y&nbsp;คือ&nbsp;ปีการศึกษา</div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบจำนวนเงินให้ถูกต้อง</div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบชื่อผู้รับเงินต้องเป็น โรงเรียนเรยีนาเชลีวิทยาลัย หรือ REGINA COELI COLLEGE SCHOOL เท่านั้น</div>
                <div>3&nbsp;.&nbsp;สำหรับหลักฐานการชำระเงินให้ท่านเก็บไว้เป็นหลักฐาน</div>
                <div>4&nbsp;.&nbsp;ทางโรงเรียนจะทำการตรวจสอบรายการและยืนยันการชำระเงินของท่าน </div>
                <div>5&nbsp;.&nbsp;การชำระเงินจะเสร็จสมบูรณ์ เมื่อทางโรงเรียนได้ตรวจสอบการชำระเงินของท่านเรียบร้อยแล้ว</div>
                <div>6&nbsp;.&nbsp;หากต้องการใบเสร็จรับเงิน ติดต่อขอรับได้ที่ห้องการเงินของโรงเรียน</div>
                <div>7&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการชำระเงิน กรณาติดต่อ ห้องการเงิน 053-282395 ต่อ 105</div>                                                                
                <div>8&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการเรียนเสริมนอกตารางเรียนกรณาติดต่อ ห้องวิชาการ 053-282395 ต่อ 121</div>
              </td>
            </tr>
        </tbody>
    </table>
</p> 

<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td>
		<div><center>-------------------------------------------------------------------------ฉีกตามรอยปะ--------------------------------------------------------------------</center></div>
	  </td>
    </tr>
  </tbody>
</table>
<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 75px; height: 73px;" alt=""/></td>
   	  <td>
		  <center>
	  		<div style="font-size: 22px; font-weight: bold;"><b>ใบลงทะเบียน  เรียนเสริมนอกเวลาเรียน &nbsp;&nbsp;ภาคเรียนที่&nbsp;<?php echo $data_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_yaer;?>&nbsp;</b></div>
	  		<div style="font-size: 22px; font-weight: bold;"><b>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;&nbsp;จังหวัดเชียงใหม่</b></div>			
		  </center>
  	  </td>
	  <td>
			<div style="color: #FA0408; font-weight: bold;">สำหรับนักเรียน</div>
	  </td>
    </tr>
  </tbody>
</table><br>

<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td>
		<div style="font-family: THSarabunNew;font-size: 19px;"><b>รหัสประจำตัวนักเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 19px; text-align: center; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted;" size="10" value="<?php echo $data_stu->rsd_studentid;?>"><b>ชื่อ-สกุล</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 19px; text-align: center; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted;" size="50" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $PrintReginaStuData->PRS_nameTH;?>"><b>ชั้น</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 19px; text-align: center; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted;" size="11" value="<?php echo $data_stu->Sort_name;?>"></div>
		<div style="font-family: THSarabunNew;font-size: 19px;"><b>ห้อง</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 19px; text-align: center; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted;" size="5" value="<?php echo $data_stu->rsc_room;?>"><b>แผนการเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 19px; text-align: center; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted;" size="80" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data_stu->planname;?>"></div>
	  </td>
    </tr>
  </tbody>
</table> 
<p><table style="width: 740px; font-family: THSarabunNew;font-size: 19px;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
		<td><center><b><u>ตารางเรียนเสริมนอกเวลาเรียน</u></b></center></td>
    </tr>
  </tbody>
</table></p>
<table style="width: 740px; font-family: THSarabunNew;font-size: 19px;" border="1" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <th><div><center>ลำดับ</center></div></th>
      <th><div><center>วิชา</center></div></th>
      <th><div><center>วันที่เรียน</center></div></th>
    </tr>
	
<?php
	$count_num=1;
	$print_subjectSql="SELECT `supplementary_subject`.`ss_id` , `supplementary_subject`.`ss_txtth` , `supplementary_sturs`.`ss_mon` , `supplementary_sturs`.`ss_tues` , `supplementary_sturs`.`ss_wedne` , `supplementary_sturs`.`ss_thurs` , `supplementary_sturs`.`ss_fri` , `supplementary_sturs`.`ss_satur` , `supplementary_sturs`.`ss_sun`
					   FROM `supplementary_sturs`
					   JOIN `supplementary_subject` ON ( `supplementary_sturs`.`ss_id` = `supplementary_subject`.`ss_id` )
					   WHERE `supplementary_sturs`.`sup_stuid` = '{$user_login}'
					   AND `supplementary_sturs`.`sup_t` = '{$data_term}'
					   AND `supplementary_sturs`.`sup_l` = '{$data_stu->IDLevel}'
					   AND `supplementary_sturs`.`sup_year` = '{$data_yaer}'";
	$print_subjectRs=new row_evaluation($print_subjectSql);
	foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectRow){

		if($print_subjectRow["ss_mon"]==1){ ?>
    <tr>
		<td><center><?php echo $count_num;?></center></td>
	
		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันจันทร์</td>
    </tr>			
<?php	}else{
			
			
		}		
		
		if($print_subjectRow["ss_tues"]==1){ ?>
    <tr>
		<td><center><?php echo $count_num;?></center></td>		

		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันอังคาร</td>
    </tr>	
<?php	}else{
			
			
		}		
		
		if($print_subjectRow["ss_wedne"]==1){ ?>
    <tr>
		<td><center><?php echo $count_num;?></center></td>

		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันพุธ</td>
    </tr>
<?php	}else{


		}		
		
		if($print_subjectRow["ss_thurs"]==1){ ?>
    <tr>
		<td><center><?php echo $count_num;?></center></td>
	
		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันพฤหัสบดี</td>		
    </tr>			
<?php   }else{
			
		}		
		
		if($print_subjectRow["ss_fri"]==1){ ?>
    <tr>
		<td><center><?php echo $count_num;?></center></td>		

		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันศุกร์</td>
    </tr>			
<?php	}else{
			
		}		
		
		if($print_subjectRow["ss_satur"]==1){ ?>
    <tr>
		<td><center><?php echo $count_num;?></center></td>		

		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันเสาร์</td>
    </tr>			
<?php	}else{
			
		}		
		
		if($print_subjectRow["ss_sun"]==1){ ?>
    <tr>
		<td><center><?php echo $count_num;?></center></td>		
		
		<td>&nbsp;<?php echo $print_subjectRow["ss_txtth"];?></td>
		<td>&nbsp;วันอาทิตย์</td>
    </tr>			
<?php	}else{
			
		}
		
	$count_num=$count_num+1;}
?>	

	<?php
		if($data_stu->IDLevel==31){
			if($data_stu->rc_plan==12){
			
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										//echo $data_term;
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_true' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										//echo $data_term;
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_flas'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
										
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}	
			}else{

				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
							
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
									
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										} ?>
<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$pay_row["supplementary_pay"];?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',')." บาท";?></center></td>
											</tr>
									
<!--************************************************************************************************-->									
						<?php	}else{
									//********************
								}
								
							}
//-------------------------------------------------------------------------------------------------------							
						}else{
							//**********************************
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
							
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
									
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										} ?>
<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$pay_row["supplementary_pay"];?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',')." บาท";?></center></td>
											</tr>
									
<!--************************************************************************************************-->									
						<?php	}else{
									//********************
								}
								
							}
//-------------------------------------------------------------------------------------------------------							
						}else{
							//**********************************
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}

			}	
		}elseif($data_stu->IDLevel==32){
			if($data_stu->rc_plan==12){
			
			 
			 
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										//echo $data_term;
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_true' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
										
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										//echo $data_term;
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_flas'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}	
			}else{
				
				
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
							
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
									
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										} ?>
<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',')." บาท";?></center></td>
											</tr>
									
<!--************************************************************************************************-->									
						<?php	}else{
									//********************
								}
								
							}
//-------------------------------------------------------------------------------------------------------							
						}else{
							//**********************************
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
							
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
									
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										} ?>
<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',')." บาท";?></center></td>
											</tr>
									
<!--************************************************************************************************-->									
						<?php	}else{
									//********************
								}
								
							}
//-------------------------------------------------------------------------------------------------------							
						}else{
							//**********************************
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}
				
			}			
		}elseif($data_stu->IDLevel==33){
			if($data_stu->rc_plan==13){
//*****************************************************************************************
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										//echo $data_term;
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_true' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh33;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;											
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										//echo $data_term;
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_flas'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh33;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}
//*****************************************************************************************				
			}else{
//*****************************************************************************************	
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										//echo $data_term;
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_true' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh33;																						
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										//echo $data_term;
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_flas'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh33;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;
											}
										

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}			
//*****************************************************************************************				
			}
		}elseif($data_stu->IDLevel==41){
			if($data_stu->rc_plan==13){
//*****************************************************************************************
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}'";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh41;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;											
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
					
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											
											if(isset($payA_row["supplementary_pay"])){
												$set_payA=$payA_row["supplementary_pay"];
											}else{
												$set_payA=0;
											}
											
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											
												$set_payB=$payA_row["supplementary_pay"];
	
											
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh41;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}
//*****************************************************************************************				
			}else{
//*****************************************************************************************	
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='14'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='14' 
									  and `supplementary_planB`='14' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='14' 
												   and `supplementary_planB`='14' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='14' 
												  and `supplementary_planB`='14' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh41;																						
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='14'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='14' 
									  and `supplementary_planB`='14' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='14' 
												   and `supplementary_planB`='14' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='14' 
												  and `supplementary_planB`='14' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh41;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;
											}
										

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}			
//*****************************************************************************************				
			}						
						
		}elseif($data_stu->IDLevel==42){	
			if($data_stu->rc_plan==13){
//*****************************************************************************************
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}'";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh42;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;											
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
					
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh42;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}
//*****************************************************************************************				
			}else{
//*****************************************************************************************	
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='14'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='14' 
									  and `supplementary_planB`='14' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='14' 
												   and `supplementary_planB`='14' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='14' 
												  and `supplementary_planB`='14' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh42;																						
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='14'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='14' 
									  and `supplementary_planB`='14' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='14' 
												   and `supplementary_planB`='14' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='14' 
												  and `supplementary_planB`='14' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh42;												
											}else{
												$sum_pay=($set_payA*$count_academic);
											}
										

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}			
//*****************************************************************************************				
			}			
		}elseif($data_stu->IDLevel==43){
		
			if($data_stu->rc_plan==13){
//*****************************************************************************************
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}'";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
										
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh43;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;											
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='{$data_stu->rc_plan}'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
					
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='{$data_stu->rc_plan}' 
									  and `supplementary_planB`='{$data_stu->rc_plan}' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='{$data_stu->rc_plan}' 
												   and `supplementary_planB`='{$data_stu->rc_plan}' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='{$data_stu->rc_plan}' 
												  and `supplementary_planB`='{$data_stu->rc_plan}' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh43;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}
//*****************************************************************************************				
			}else{
//*****************************************************************************************	
				$supple_stursSql="SELECT `ss_activity`  
								  FROM `supplementary_sturs` 
								  WHERE `sup_stuid` = '{$user_login}' 
								  AND `sup_t` = '{$data_term}' 
								  AND `sup_l` = '{$data_stu->IDLevel}' 
								  AND `sup_year` = '{$data_yaer}'";
				$supple_stursRs=new notrow_evaluation($supple_stursSql);
				foreach($supple_stursRs->evaluation_array as $rc_key=>$supple_stursRow){
					if($supple_stursRow["ss_activity"]=="cilk_true"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='14'
						  and `ss_activity`='cilk_true';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='0'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_true'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='14' 
									  and `supplementary_planB`='14' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_true'
									  and `ss_pay`='ALLPAY' 
									  and `ss_id`='{$copy_ss_id}' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
						
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='14' 
												   and `supplementary_planB`='14' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='14' 
												  and `supplementary_planB`='14' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh43;																						
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------						
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
	<?php			}elseif($supple_stursRow["ss_activity"]=="cilk_flas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

		<?php
					$payA_sql="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`ss_pay`
						  FROM `supplementary_school` 
						  WHERE `supplementary_levelA`='{$data_stu->IDLevel}' 
						  and `supplementary_not`='Y'
						  and `supplementary_t`='{$data_term}'
						  and `supplementary_planA`='14'
						  and `ss_activity`='cilk_flas';";
					$payA_rs=new notrow_evaluation($payA_sql);
					foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
						
						if($payA_row["ss_pay"]=="ALLPAY"){
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id` 
													 from `supplementary_subject`
													 join `supplementary_sturs` 
													 on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`) 
													 where `supplementary_subject`.`ss_t`='{$data_term}'
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}'
													 and `supplementary_subject`.`ss_academic`='1'
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`ss_activity`='cilk_flas'";
							$supplementary_stursRs=new notrow_evaluation($supplementary_stursSql);
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								
								$pay_sql="SELECT `supplementary_pay` 
									  FROM `supplementary_school`
									  WHERE`supplementary_t`='{$data_term}' 
									  and `supplementary_levelA`='{$data_stu->IDLevel}' 
									  and `supplementary_levelB`='{$data_stu->IDLevel}' 
									  and `supplementary_planA`='14' 
									  and `supplementary_planB`='14' 
									  and `supplementary_not`='Y'
									  and `ss_activity`='cilk_flas'
									  and `ss_pay`='ALLPAY' ";
								$pay_rs=new notrow_evaluation($pay_sql);
								foreach($pay_rs->evaluation_array as $rc_key=>$pay_row){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

									<tr>
										<td colspan="2"><center>รวม</center></td>
                                        <?php $txt_amount=$pay_row["supplementary_pay"];?>
										<td><center><?php echo number_format($pay_row["supplementary_pay"], 2, '.', ',')." บาท";?></center></td>
									</tr>	
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	}	
							}
//-------------------------------------------------------------------------------------------------------							
						}elseif($payA_row["ss_pay"]=="PAYMENT"){
							
//-------------------------------------------------------------------------------------------------------	
							$supplementary_stursSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_academic`,`supplementary_subject`.`ss_id` 
													 from `supplementary_subject` 
													 join `supplementary_sturs` on(`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
													 where `supplementary_subject`.`ss_t`='{$data_term}' 
													 and `supplementary_subject`.`ss_l`='{$data_stu->IDLevel}' 
													 and `supplementary_subject`.`ss_year`='{$data_yaer}' 
													 and `supplementary_sturs`.`sup_stuid`='{$user_login}' 
													 and `supplementary_sturs`.`sup_t`='{$data_term}' 
													 and `supplementary_sturs`.`sup_l`='{$data_stu->IDLevel}' 
													 and `supplementary_sturs`.`sup_year`='{$data_yaer}'";
							$supplementary_stursRs=new row_evaluation($supplementary_stursSql);
							$count_academic=0;
							$set_activity=0;
							foreach($supplementary_stursRs->evaluation_array as $rc_key=>$supplementary_stursRow){
								$copy_ss_id=$supplementary_stursRow["ss_id"];
								$copy_academic=$supplementary_stursRow["ss_academic"];
									
									if($copy_academic==1){
										
										
										
										$payA_sql="SELECT `supplementary_pay` 
												   FROM `supplementary_school` 
												   WHERE`supplementary_t`='{$data_term}' 
												   and `supplementary_levelA`='{$data_stu->IDLevel}' 
												   and `supplementary_levelB`='{$data_stu->IDLevel}' 
												   and `supplementary_planA`='14' 
												   and `supplementary_planB`='14' 
												   and `supplementary_not`='Y' 
												   and `ss_activity`='cilk_flas' 
												   and `ss_pay`='PAYMENT'";
										$payA_rs=new notrow_evaluation($payA_sql);
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payA=$payA_row["supplementary_pay"];
										}									
										
									
										
										$count_academic=$count_academic+1;
									}elseif($copy_academic==0){
											
										$payA_sql="SELECT `supplementary_pay` 
												  FROM `supplementary_school`
												  WHERE`supplementary_t`='{$data_term}' 
												  and `supplementary_levelA`='{$data_stu->IDLevel}' 
												  and `supplementary_levelB`='{$data_stu->IDLevel}' 
												  and `supplementary_planA`='14' 
												  and `supplementary_planB`='14' 
												  and `supplementary_not`='Y'
												  and `ss_activity`='cilk_true'
												  and `ss_pay`='PAYMENT' 
												  and `ss_id`='{$copy_ss_id}' ";
										$payA_rs=new notrow_evaluation($payA_sql);
										
										foreach($payA_rs->evaluation_array as $rc_key=>$payA_row){
											$set_payB=$payA_row["supplementary_pay"];
										}
									}else{
									//********************
									
									}
								
							} ?>
							
							<!--************************************************************************************************-->
										<?php 
//Error Null											
											if(isset($set_payB)){
												$set_payB;
											}else{
												$set_payB=0;
											}
//Error Null End										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh43;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;
											}
										

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
                                                <?php $txt_amount=$sum_pay;?>
												<td><center><?php echo number_format($sum_pay, 2, '.', ',');?></center></td>
											</tr>
									
<!--************************************************************************************************-->		
							
							  <?php
//-------------------------------------------------------------------------------------------------------
							
						}else{
							//**********************************
							
						}
					}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<?php			}else{
						//****
					}
				}			
//*****************************************************************************************				
			}			
		
		}else{
			//****
		}
	
	
	?>


	
	
	
  </tbody>
</table>
	
			
		
<?php	}  ?>    
    
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
                                //--------------------------------------------------------------------
                            }else{
                                //$this->session->unset_userdata("rc_user");
                                //exit("<script>window.location='$golink/print_supplementary/error';</script>");
                            }
                    }                             
                }
            }                       
        }

?>