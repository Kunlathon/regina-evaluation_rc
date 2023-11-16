<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
    include("view/database/pdo_data.php");
	include("view/database/pdo_conndatastu.php");
	include("view/database/pdo_admission.php"); 
	include("view/database/pdo_books.php");
	
//--------------------------------------------------------------------	
	include("view/database/class_pdo.php");    
    include("view/database/regina_student.php");
	include("view/database/class_books.php");
//--------------------------------------------------------------------	
    include("view/function/pay_scb.php");
//--------------------------------------------------------------------
			$PreYear=filter_input(INPUT_POST,'rra_year'); 
			$PreClass=filter_input(INPUT_POST,'rra_class');   
//--------------------------------------------------------------------
		if($this->session->userdata("rc_user")==null){
            $this->session->unset_userdata("rc_user");
            exit("<script>window.location='$golink/rcprint/error';</script>");			
		}elseif($PreYear==null and $PreClass==null){
			exit("<script>window.location='$golink/rcprint/error';</script>");
		}else{
			$LoginKey=$this->session->userdata("rc_user");
			$uesr_log=$this->load->database("default",TRUE);
            $uesr_log=$this->db->query("SELECT `group` 
										FROM `login` 
										WHERE `login_id`='{$LoginKey}';");
			foreach($uesr_log->result_array() as $log_row){
				$LogGroup=$log_row["group"];
			}
		}
?>
	<?php
		switch($LogGroup){
			case "A": ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
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
		<title>ใบแทนค่าหนังสือเรียน&nbsp;(ฉบับร่าง)</title>
		<link rel="shortcut icon" href="<?php echo base_url();?>/Template/global_assets/images/logo_rc_wbe.ico"/>
<!-- Global stylesheets -->
		<link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->		
<!--Code Print css-->
		<link rel="stylesheet" href="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/css/normalize.css">
		<link rel="stylesheet" href="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/css/paper.css"> 	
<!--Code Print css End-->	
		<style>
			.psrA{
				margin: auto;
				border: 3px solid #73AD21;
			}
		</style>
		<style>
			@font-face {
				font-family: 'THSarabunNew';
				src: url('<?php echo base_url();?>view/font/thsarabunnew-webfont.eot');
				src: url('<?php echo base_url();?>view/font/thsarabunnew-webfont.eot?#iefix') format('embedded-opentype'),
			url('<?php echo base_url();?>view/font/thsarabunnew-webfont.woff') format('woff'),
			url('<?php echo base_url();?>view/font/THSarabunNew.ttf') format('truetype');
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
										<div><button type="button" style="font-size: 18px;" class="btn btn-default" onclick="window.print()"><b>พิมพ์ ใบแทนค่าหนังสือเรียน (ฉบับร่าง)</b></button></div>
									</th>
								</tr>
								<tr>
									<th style="width: 20%">
										<div style="font-size: 18px;"><font color="#F70105"><b>ระบบการพิมพ์  รองรับ เว็บเบราว์เซอร์  Google Chrome และ  Microsoft Edge เท่านั้น<b></font></div>
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
									<td><div style="font-size: 18px;">A4&nbsp;:&nbsp;210mm&nbsp;X&nbsp;296mm</div></td>
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
				$count_pr=0;
				$DataSudRc=new PrintReginaYearClass3($PreYear,'1',$PreClass);
				foreach($DataSudRc->RunReginaStuClass() as $books_rc=>$DataSudRow){	
						$data_stu=new stu_levelpdo($DataSudRow["rsd_studentid"],$PreYear,'1');
					    $stu_data=new regina_stu_data($DataSudRow["rsd_studentid"]);
						
						//$PrintReginaStuData=new PrintReginaStuData($DataSudRow["rsd_studentid"]);
						
							//if((isset($PrintReginaStuData->PRS_nameTH))){
								//$ReginaBooksName=$PrintReginaStuData->PRS_nameTH;
							//}else{
								$PrintReginaStuDataA=new PrintReginaStuDataClass($DataSudRow["rsd_studentid"]);
								$ReginaBooksName=$PrintReginaStuDataA->PRS_nameTH;
							//}
						
						$CopyPreYear=substr($PreYear,2);
						$count_pr=$count_pr+1;
						
							if($count_pr<=9){
								$run_int=$CopyPreYear.$DataSudRow["rsc_class"]."00".$count_pr;
							}elseif($count_pr<=99){
								$run_int=$CopyPreYear.$DataSudRow["rsc_class"]."0".$count_pr;
							}else{
								$run_int=$CopyPreYear.$DataSudRow["rsc_class"].$count_pr;
							}
						
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<section class="sheet padding-10mm imgA">
	
		<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 65px; height: 69px;" alt=""/></td>
					<td>
						<center>
							<div style="font-style:bold; font-size: 25px;"><b>ใบแทนใบเสร็จรับเงิน&nbsp;ค่าหนังสือเรียน&nbsp;ปีการศึกษา&nbsp;<?php echo $PreYear;?>&nbsp;</b></div>
							<div style="font-style:bold; font-size: 25px;"><b>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;จังหวัดเชียงใหม่&nbsp;</b></div>			
						</center>
					</td>
					<td>
						<div style="font-style:bold; font-size: 20px;"><font color="#FA0408"><b>สำหรับโรงเรียน</b></font></div>
						<div style="font-style:bold; font-size: 20px; float:right;"><b>เลขที่</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="10" value="<?php echo $run_int;?>"></div>
					</td>
				</tr>
			</tbody>
		</table><br>
		<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div style="font-style:bold; font-size: 20px;"><b>เลขประจำตัวนักเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="10" value="<?php echo $data_stu->rsd_studentid;?>"><b>ชื่อ-สกุล</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="50" value="<?php echo $ReginaBooksName;?>"><b>ชั้น</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="5" value="<?php echo $data_stu->Sort_name;?>"></div>
						<div style="font-style:bold; font-size: 20px;"><b>ห้อง</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="5" value="<?php echo $data_stu->rsc_room;?>"><b>แผนการเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="60" value="<?php echo $data_stu->planname;?>"></div>
					</td>
				</tr>
			</tbody>
		</table>	
		<table style="width: 740px; font-size: 20px;" border="1" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th style="width: 46px;"><div><center>ลำดับ</center></div></th>
					<th style="width: 546px;"><div><center>รายการ</center></div></th>
					<th style="width: 146px;"><div><center>จำนวนเงิน</center></div></th>
				</tr>
			</thead>
			<thead>
			
			<?php
					$book_Count=1;
					$book_Sumpay=0;
					$DataBooks=new PrintStoreBooks($PreYear,$DataSudRow["rsc_class"],$DataSudRow["rsc_plan"]);
					foreach($DataBooks->PrintStoreBooksRun() as $rc_books=>$DataBooksRow){	?>
					
				<tr>
					<td style="width:  46px;"><div style="float:center;"><center><?php echo $book_Count;?></center></div></td>
					<td style="width: 546px;"><div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $DataBooksRow["RSD_Txt"];?></div></td>
					<td style="width: 146px;"><div style="float:center;"><center><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($DataBooksRow["RSD_Price"], 2, '.', ',');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></center></div></td>
					
				</tr>	
				
			<?php	$book_Count=$book_Count+1;
					$book_Sumpay=$book_Sumpay+$DataBooksRow["RSD_Price"];
					}  ?>
			
			</thead>
		</table>	
		
<?php
    //$class=$data_stu->IDLevel;
    $class_ex=$data_stu->Sort_name_E2;
    $txt_billerId="099400043439110";
    $txt_ref1=strtoupper($DataSudRow["rsd_studentid"]."L".$class_ex);
    $txt_ref2=strtoupper("RCBOOKS10Y".$PreYear);
    $txt_amount=number_format($book_Sumpay, 2, '.', '');                                                   
    $txt_width="104";
    $payQRCode=new QRCode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
?>  		
		<br>
		<table style="width: 740px; font-size: 20px;" border="0" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<td style="width: 370px;">
					    <div><img src="<?php echo $payQRCode->call_QRCode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="104" height="104"></div>
						<div><b>BillerID&nbsp;:&nbsp;</b><?php echo $txt_billerId;?></div>
						<div><b>ref1&nbsp;:&nbsp;</b><?php echo $txt_ref1;?></div>
						<div><b>ref2&nbsp;:&nbsp;</b><?php echo $txt_ref2;?></div>
						<div><b>จำนวนเงิน&nbsp;:&nbsp;</b><?php echo number_format($book_Sumpay, 2, '.', ',');?></div>
					</td>
					<td style="width: 370px;">
						<div><b>ช่องทางการชำระเงิน</b></div>
						<div>&nbsp;<img src="<?php echo base_url();?>Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;เงินสด</div>
						<div>&nbsp;<img src="<?php echo base_url();?>Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;เงินโอน&nbsp;(QR&nbsp;Code)</div>
						<div>&nbsp;</div>
						<div><b>ลงชื่อผู้จ่ายเงิน(ตัวบรรจง)</b>......................................................</div>
						<div><b>โทรศัพท์</b>..............................................................</div>
						<div></div>
						<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ลงชื่อผู้รับเงิน</b>..........................................</div>
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
							<div style="font-style:bold; font-size: 25px;"><b>ใบแทนใบเสร็จรับเงิน&nbsp;ค่าหนังสือเรียน&nbsp;ปีการศึกษา&nbsp;<?php echo $PreYear;?>&nbsp;</b></div>
							<div style="font-style:bold; font-size: 25px;"><b>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;จังหวัดเชียงใหม่&nbsp;</b></div>			
						</center>
					</td>
					<td>
						<div style="font-style:bold; font-size: 20px;"><font color="#FA0408"><b>สำหรับแลกรับหนังสือ</b></font></div>
					    <div style="font-style:bold; font-size: 20px; float:right;"><b>เลขที่</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="10" value="<?php echo $run_int;?>"></div>
					</td>
				</tr>
			</tbody>
		</table><br>
		<table style="width: 740px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div style="font-style:bold; font-size: 20px;"><b>เลขประจำตัวนักเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="10" value="<?php echo $data_stu->rsd_studentid;?>"><b>ชื่อ-สกุล</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="50" value="<?php echo $ReginaBooksName;?>"><b>ชั้น</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="5" value="<?php echo $data_stu->Sort_name;?>"></div>
						<div style="font-style:bold; font-size: 20px;"><b>ห้อง</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="5" value="<?php echo $data_stu->rsc_room;?>"><b>แผนการเรียน</b><input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; text-align: center; border:0px; text-align: center; border:0px;" size="60" value="<?php echo $data_stu->planname;?>"></div>
					</td>
				</tr>
			</tbody>
		</table>		
		
		<table style="width: 740px; font-size: 20px;" border="1" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th style="width:  46px;"><div><center>ลำดับ</center></div></th>
					<th style="width: 546px;"><div><center>รายการ</center></div></th>
					<th style="width: 146px;"><div><center>จำนวนเงิน</center></div></th>
				</tr>
			</thead>
			<thead>
			
			<?php
					$book_Count=1;
					$book_Sumpay=0;
					$DataBooks=new PrintStoreBooks($PreYear,$DataSudRow["rsc_class"],$DataSudRow["rsc_plan"]);
					foreach($DataBooks->PrintStoreBooksRun() as $rc_books=>$DataBooksRow){	?>
					
				<tr>
					<td style="width:  46px;"><div style="float:center;"><center><?php echo $book_Count;?></center></div></td>
					<td style="width: 546px;"><div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $DataBooksRow["RSD_Txt"];?></div></td>
					<td style="width: 146px;"><div style="float:center;"><center><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($DataBooksRow["RSD_Price"], 2, '.', ',');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></center></div></td>
				</tr>	
				
			<?php	$book_Count=$book_Count+1;
					$book_Sumpay=$book_Sumpay+$DataBooksRow["RSD_Price"];
					}  ?>			

			</thead>
		</table>		
		
	
		<br>
		<table style="width: 740px; font-size: 20px;" border="0" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<td style="width: 370px;"></td>
					<td style="width: 370px;">
						<div><b>ช่องทางการชำระเงิน</b></div>
						<div>&nbsp;<img src="<?php echo base_url();?>Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;เงินสด</div>
						<div>&nbsp;<img src="<?php echo base_url();?>Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;เงินโอน&nbsp;(QR&nbsp;Code)</div>
						<div>&nbsp;</div>
						<div><b>ลงชื่อผู้จ่ายเงิน(ตัวบรรจง)</b>......................................................</div>
						<div><b>โทรศัพท์</b>..............................................................</div>
						<div></div>
						<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ลงชื่อผู้รับเงิน</b>..........................................</div>
					</td>
				</tr>
			<thead>
		</table>		
	
	</section>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}?>




	

    </body>
   
</html>
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	break;
			default:
			exit("<script>window.location='$golink/rcprint/error';</script>");	
		}
	
	
	?>