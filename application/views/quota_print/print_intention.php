<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
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
			if($log_row["int_uesr"]>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	$UesrRc=$this->load->database("default",TRUE);
	$UesrRc=$this->db->select("rsd_studentid");
	$UesrRc=$this->db->where("rsl_user",$LoginKey);
	$UesrRcRow=$this->db->get("regina_stu_login");
	foreach($UesrRcRow->result() as $URR){
		$usercopy=($URR->rsd_studentid);
		if($usercopy==$RcId){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
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
		<title>พิมพ์แบบแจ้งความจำนงเข้าศึกษา (รอบโควตาภายใน)</title>
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
<?php
//-----------------------------------------------------------------------------------
		if(file_exists("view/all/$RcId.jpg")){
			$user_img="$RcId.jpg";
		}else{
            if(file_exists("view/all/$RcId.JPG")){
                $user_img="$RcId.JPG";                       
            }else{
                $user_img="newimg_rc.jpg";                        
            }
        }
//----------------------------------------------------------------------------------- 

?>	
<!-- Global stylesheets -->
		<link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->		
<!--Code Print css-->
		<link rel="stylesheet" href="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/css/normalize.css">
		<link rel="stylesheet" href="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/css/paper.css"> 	
<!--Code Print css End-->
		
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
										<div><button type="button"  class="btn btn-default" onclick="window.print()"><b>พิมพ์ แบบแจ้งความจำนงเข้าศึกษา (รอบโควตาภายใน)</b></button></div>
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
	
		<?php
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	include("view/database/pdo_data.php");
	include("view/database/pdo_quota.php");	
	include("view/database/pdo_conndatastu.php");
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	include("view/database/class_pdodatastu.php");	
	include("view/database/class_quota.php");
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$print_key=$RcId;
	$print_yearnew=$RcYear;
	$print_year=$RcYear-1;
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$data_yaer=$print_year;
	$next_yaer=$print_yearnew;
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$user_login=$print_key;
	$print_data=date("Y-m-d H:i:s");
//ข้อมูลนักเรียน 
	$call_sturc=new regina_stu_data($user_login);
//ระดับชั้น
	$call_stu=new stu_levelpdo($user_login,$data_yaer,"1");
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	if($call_stu->IDLevel==23){
		$class_new=31;
		$class_new_txt="มัธยมศึกษาปีที่ 1";
	}elseif($call_stu->IDLevel==33){
		$class_new=41;
		$class_new_txt="มัธยมศึกษาปีที่ 4";
	}else{
		$class_new=null;
		$class_new_txt=null;
	}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
//-------------------------------------------------------
		function datethai($strDate){
	        $strYear = date("Y",strtotime($strDate))+543;
	        $strMonth= date("n",strtotime($strDate));
	        $strDay= date("j",strtotime($strDate));
	        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	        $strMonthThai=$strMonthCut[$strMonth];
	        return "$strDay $strMonthThai $strYear";
	    }
//--------------------------------------------------------
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	$regina_stu_dataSql="SELECT * FROM `regina_stu_data` WHERE `rsd_studentid`='{$user_login}'";
	$regina_stu_data=new notrow_evaluation($regina_stu_dataSql);
	foreach($regina_stu_data->evaluation_array as $rc_key=>$regina_stu_datarow){
		if($regina_stu_datarow["rsd_prefix"]==2){
			$mynameTh="เด็กหญิง ".$regina_stu_datarow["rsd_name"]."&nbsp;".$regina_stu_datarow["rsd_surname"];			
		}elseif($regina_stu_datarow["rsd_prefix"]==4){
			$mynameTh="นางสาว ".$regina_stu_datarow["rsd_name"]."&nbsp;".$regina_stu_datarow["rsd_surname"];			
		}else{
//------------------------------------------------------------------------------------------------------			
		}
	}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$InternalSaveRightsPrint=new InternalSaveRightsPrint($user_login,$data_yaer);
	foreach($InternalSaveRightsPrint->RunInternalSaveRightsPrint() as $rc=>$InternalSaveRightsPrintRow){
		$isr_quota_phone=$InternalSaveRightsPrintRow["isr_quota_phone"];
		$isr_MaintainRights=$InternalSaveRightsPrintRow["isr_MaintainRights"];
		$isr_PlanNew=$InternalSaveRightsPrintRow["isr_PlanNew"];
		$isr_quota_np=$InternalSaveRightsPrintRow["isr_quota_np"];
		$isr_quota_name=$InternalSaveRightsPrintRow["isr_quota_name"];
		$isr_quota_surname=$InternalSaveRightsPrintRow["isr_quota_surname"];
		$isr_quota_relationship=$InternalSaveRightsPrintRow["isr_quota_relationship"];
		$isr_MaintainRightsTxT=$InternalSaveRightsPrintRow["isr_MaintainRightsTxT"];
	}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$p_np=new stu_prefix($isr_quota_np);
	$myname_p=$p_np->prefix_prefixname."&nbsp;".$isr_quota_name."&nbsp;".$isr_quota_surname;	
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$print_parent_status=new data_rely ($isr_quota_relationship);	
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
		?>
	
	<section class="sheet padding-10mm imgA">

		<table style="width: 100%; vertical-align: top;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="font-size: 28px; text-align: center; font-family: THSarabunNew; font-weight: bold;">
						<div><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 75px; height: 73px;" alt=""/></div>
						<div>แบบแจ้งความจำนง</div>
						<div>เข้าศึกษาต่อในระดับชั้น<?php echo $class_new_txt;?> ปีการศึกษา <?php echo $next_yaer;?> (รอบโควตาภายใน)</div>
						<div>โรงเรียนเรยีนาเชลีวิทยาลัย จังหวัดเชียงใหม่</div>
					</td>										
				</tr>
			</tbody>
		</table>
		<br>
		<table style="width: 100%; vertical-align: top;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;" >
						ข้าพเจ้า<input type="text" size="35" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;<?php echo $myname_p;?>" readonly="readonly" required="required"/>ผู้ปกครองของ<input type="text" size="39" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;<?php echo $mynameTh;?>" readonly="readonly" required="required"/>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
						ชั้น<input type="text" size="11" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;<?php echo $call_stu->Sort_name."/".$call_stu->rsc_room;?>" readonly="readonly" required="required"/>เลขประจำตัว<input type="text" size="22" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;<?php echo $regina_stu_datarow["rsd_studentid"];?>" readonly="readonly" required="required"/>เลขประจำตัวประชาชน<input type="text" size="23" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;<?php echo $regina_stu_datarow['rsd_Identification'];?>" readonly="readonly" required="required"/>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
						ความสัมพันธ์กับนักเรียน<input type="text" size="30" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;<?php echo $print_parent_status->dr_txt;?>" readonly="readonly" required="required"/>เบอร์โทรศัพท์<input type="text" size="31" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;<?php echo $isr_quota_phone;?>" readonly="readonly" required="required"/>
						</div>
					</td>
				</tr>			
			</tbody>
		</table>		
		<br>
		<table style="width: 100%; vertical-align: top;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้าได้รับทราบและพิจารณาสิทธิ์โควตาเข้าศึกษาต่อในระดับ<?php echo $class_new_txt;?> ปีการศึกษา <?php echo $next_yaer;?> โรงเรียนเรยีนาเชลีวิทยาลัย ร่วมกับนักเรียนในความปกครองของข้าพเจ้าแล้ว&nbsp;
						</div>
					</td>
				</tr>
				
			</tbody>
		</table>
		<br>

		<table style="width: 100%; vertical-align: top;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 15%; vertical-align: top;">
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">มีความประสงค์</div>
					</td>		
					<td style="width: 26%; vertical-align: top;">
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if($isr_MaintainRights=="รักษาสิทธิ์"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
						<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;รักษาสิทธิ์&nbsp;(โปรดเลือก 1 ข้อ)
					</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				
					<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
					<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;รักษาสิทธิ์&nbsp;(โปรดเลือก 1 ข้อ)
					</div>				
						
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
					
					</td>
					
					<td style="width: 49%; vertical-align: top; font-weight: bold;">
					
					
		<?php
				if($call_stu->IDLevel==23){ ?>

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($isr_PlanNew==12){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold; ">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;ห้องเรียนวิทยาศาสตร์ - คณิตศาสตร์ (สสวท.)&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;ห้องเรียนวิทยาศาสตร์ - คณิตศาสตร์ (สสวท.)&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
			<?php
					if($isr_PlanNew==2){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;ห้องเรียนปกติ&nbsp;
						</div>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;ห้องเรียนปกติ&nbsp;
						</div>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
				
		<?php	}elseif($call_stu->IDLevel==33){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($isr_PlanNew==13){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน วิทยาศาสตร์ - คณิตศาสตร์ (สสวท.)&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน วิทยาศาสตร์ - คณิตศาสตร์ (สสวท.)&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($isr_PlanNew==3){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน วิทยาศาสตร์ – คณิตศาสตร์&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน วิทยาศาสตร์ – คณิตศาสตร์&nbsp;
						</div>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($isr_PlanNew==4){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียนภาษาอังกฤษ – คณิตศาสตร์&nbsp;(ศิลป์ - คำนวณ)&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – คณิตศาสตร์&nbsp;(ศิลป์ - คำนวณ)&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($isr_PlanNew==5){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาฝรั่งเศส&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาฝรั่งเศส&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php
					if($isr_PlanNew==6){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาญี่ปุ่น&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียนภาษาอังกฤษ – ภาษาญี่ปุ่น&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($isr_PlanNew==7){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาจีน&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาจีน&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($isr_PlanNew==11){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาอังกฤษ&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาอังกฤษ&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php
					if($isr_PlanNew==15){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ศิลป์อาชีพ - ศิลปะการอาหารและการจัดการ&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ศิลป์อาชีพ - ศิลปะการอาหารและการจัดการ&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php
					if($isr_PlanNew==16){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ศิลป์อาชีพ - การจัดการธุรกิจบริการสุขภาพและผลิตภัณฑ์สมุนไพร&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ศิลป์อาชีพ - การจัดการธุรกิจบริการสุขภาพและผลิตภัณฑ์สมุนไพร&nbsp;
						</div>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--> 				
		<?php	} ?>			
					</td>					
				</tr>
			</tbody>
		</table>
		
		<table style="width: 100%; vertical-align: top;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 15%; vertical-align: top; font-weight: bold;">
						<div>&nbsp;</div>
					</td>
					<td style="width: 75%; vertical-align: top; font-weight: bold;">
	
		<?php
				if($isr_MaintainRights=="สละสิทธิ์"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			
					<div style="font-size: 22px;font-family: THSarabunNew;">
					<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;สละสิทธิ์&nbsp;เนื่องจาก<input type="text" size="58" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;<?php echo $isr_MaintainRightsTxT;?>" readonly="readonly" required="required"/>
					</div>				
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			
					<div style="font-size: 22px;font-family: THSarabunNew;">
					<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;สละสิทธิ์&nbsp;เนื่องจาก<input type="text" size="58" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;" readonly="readonly" required="required"/>
					</div>				
						
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	} ?>	
	
					</td>
				</tr>
			</tbody>
		</table>
		
		<br>
		<table style="width: 100%; vertical-align: top;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้าขอรับรองว่าข้อมูลตามที่ได้แจ้งในเอกสารฉบับนี้เป็นจริงทุกประการ
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<br><br>	
		<table style="width: 100%; vertical-align: top;"  border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 40%;"></td>
					<td style="width: 60%;">
						<div style="font-size: 22px;font-family: THSarabunNew; text-align: center;">
							ลงชื่อ<input type="text" size="40" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="<?php echo $myname_p;?>" readonly="readonly" required="required"/>ผู้ปกครอง
						</div>
					</td>
				</tr>
				<tr>
					<td style="width: 40%;"></td>
					<td style="width: 60%;">
						<div style="font-size: 22px;font-family: THSarabunNew; text-align: center;">
							วันที่<input type="text" size="20" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter; " value="<?php echo datethai($print_data);?>" readonly="readonly" required="required"/>
						<div>
					</td>
				</tr>			
			</tbody>
		</table>
		
	</section>	
	

	
	
	</body>
</html>							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}else{
			$this->session->unset_userdata("rc_user");
			exit("<script>window.location='$golink/print_imgstu/error';</script>");
		}
	}
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{
				$admin_log=$this->load->database("default",TRUE);		
				$admin_log=$this->db->query("SELECT COUNT(`login_id`) AS `int_uesr` 
											 FROM `login` 
											 WHERE `use_status`='1' 
											 AND `login_id`='{$LoginKey}'");
				foreach($admin_log->result_array() as $log_row){
					if($log_row["int_uesr"]>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<style>
.psrA{
	margin: auto;
	border: 3px solid #73AD21;
}
</style>

<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>พิมพ์แบบแจ้งความจำนงเข้าศึกษา (รอบโควตาภายใน)</title>

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
    <?php
//-----------------------------------------------------------------------------------
		if(file_exists("view/all/$RcId.jpg")){
			$user_img="$RcId.jpg";
		}else{
            if(file_exists("view/all/$RcId.JPG")){
                $user_img="$RcId.JPG";                       
            }else{
                $user_img="newimg_rc.jpg";                        
            }
        }
//----------------------------------------------------------------------------------- 
    ?> 		
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
						<table class="table" align="center" >
							<thead>
								<tr>
									<th style="width: 20%">
										<div><button type="button" style="font-size: 18px;" class="btn btn-default" onclick="window.print()"><b>พิมพ์แบบแจ้งความจำนงเข้าศึกษา (รอบโควตาภายใน)</b></button></div>
									</th>
								</tr>
								<tr>
									<th style="width: 20%">
										<div><font color="#F70105" style="font-size: 18px;"><b>ระบบการพิมพ์  รองรับ เว็บเบราว์เซอร์  Google Chrome และ  Microsoft Edge เท่านั้น<b></font></div>
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
									<td><div style="font-size: 18px;">แนวนอน</div></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>		
			</div>		
		</div>
	</div>
	
		<?php
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	include("view/database/pdo_data.php");
	include("view/database/pdo_quota.php");	
	include("view/database/pdo_conndatastu.php");
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	include("view/database/class_pdodatastu.php");	
	include("view/database/class_quota.php");
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$print_key=$RcId;
	$print_yearnew=$RcYear;
	$print_year=$RcYear-1;
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$data_yaer=$print_year;
	$next_yaer=$print_yearnew;
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$user_login=$print_key;
	$print_data=date("Y-m-d H:i:s");
//ข้อมูลนักเรียน 
	$call_sturc=new regina_stu_data($user_login);
//ระดับชั้น
	$call_stu=new stu_levelpdo($user_login,$data_yaer,"1");
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	if($call_stu->IDLevel==23){
		$class_new=31;
		$class_new_txt="มัธยมศึกษาปีที่ 1";
	}elseif($call_stu->IDLevel==33){
		$class_new=41;
		$class_new_txt="มัธยมศึกษาปีที่ 4";
	}else{
		$class_new=null;
		$class_new_txt=null;
	}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
//-------------------------------------------------------
		function datethai($strDate){
	        $strYear = date("Y",strtotime($strDate))+543;
	        $strMonth= date("n",strtotime($strDate));
	        $strDay= date("j",strtotime($strDate));
	        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	        $strMonthThai=$strMonthCut[$strMonth];
	        return "$strDay $strMonthThai $strYear";
	    }
//--------------------------------------------------------
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	$regina_stu_dataSql="SELECT * FROM `regina_stu_data` WHERE `rsd_studentid`='{$user_login}'";
	$regina_stu_data=new notrow_evaluation($regina_stu_dataSql);
	foreach($regina_stu_data->evaluation_array as $rc_key=>$regina_stu_datarow){
		if($regina_stu_datarow["rsd_prefix"]==2){
			$mynameTh="เด็กหญิง ".$regina_stu_datarow["rsd_name"]."&nbsp;".$regina_stu_datarow["rsd_surname"];			
		}elseif($regina_stu_datarow["rsd_prefix"]==4){
			$mynameTh="นางสาว ".$regina_stu_datarow["rsd_name"]."&nbsp;".$regina_stu_datarow["rsd_surname"];			
		}else{
//------------------------------------------------------------------------------------------------------			
		}
	}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$InternalSaveRightsPrint=new InternalSaveRightsPrint($user_login,$data_yaer);
	foreach($InternalSaveRightsPrint->RunInternalSaveRightsPrint() as $rc=>$InternalSaveRightsPrintRow){
		$isr_quota_phone=$InternalSaveRightsPrintRow["isr_quota_phone"];
		$isr_MaintainRights=$InternalSaveRightsPrintRow["isr_MaintainRights"];
		$isr_PlanNew=$InternalSaveRightsPrintRow["isr_PlanNew"];
		$isr_quota_np=$InternalSaveRightsPrintRow["isr_quota_np"];
		$isr_quota_name=$InternalSaveRightsPrintRow["isr_quota_name"];
		$isr_quota_surname=$InternalSaveRightsPrintRow["isr_quota_surname"];
		$isr_quota_relationship=$InternalSaveRightsPrintRow["isr_quota_relationship"];
		$isr_MaintainRightsTxT=$InternalSaveRightsPrintRow["isr_MaintainRightsTxT"];
	}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$p_np=new stu_prefix($isr_quota_np);
	$myname_p=$p_np->prefix_prefixname."&nbsp;".$isr_quota_name."&nbsp;".$isr_quota_surname;	
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$print_parent_status=new data_rely ($isr_quota_relationship);	
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
		?>
	
	<section class="sheet padding-10mm imgA">

		<table style="width: 100%; vertical-align: top;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="font-size: 28px; text-align: center; font-family: THSarabunNew; font-weight: bold;">
						<div><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 75px; height: 73px;" alt=""/></div>
						<div>แบบแจ้งความจำนง</div>
						<div>เข้าศึกษาต่อในระดับชั้น<?php echo $class_new_txt;?> ปีการศึกษา <?php echo $next_yaer;?> (รอบโควตาภายใน)</div>
						<div>โรงเรียนเรยีนาเชลีวิทยาลัย จังหวัดเชียงใหม่</div>
					</td>										
				</tr>
			</tbody>
		</table>
		<br>
		<table style="width: 100%; vertical-align: top;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;" >
						ข้าพเจ้า<input type="text" size="35" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;<?php echo $myname_p;?>" readonly="readonly" required="required"/>ผู้ปกครองของ<input type="text" size="39" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;<?php echo $mynameTh;?>" readonly="readonly" required="required"/>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
						ชั้น<input type="text" size="11" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;<?php echo $call_stu->Sort_name."/".$call_stu->rsc_room;?>" readonly="readonly" required="required"/>เลขประจำตัว<input type="text" size="22" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;<?php echo $regina_stu_datarow["rsd_studentid"];?>" readonly="readonly" required="required"/>เลขประจำตัวประชาชน<input type="text" size="23" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;<?php echo $regina_stu_datarow['rsd_Identification'];?>" readonly="readonly" required="required"/>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
						ความสัมพันธ์กับนักเรียน<input type="text" size="30" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;<?php echo $print_parent_status->dr_txt;?>" readonly="readonly" required="required"/>เบอร์โทรศัพท์<input type="text" size="31" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;<?php echo $isr_quota_phone;?>" readonly="readonly" required="required"/>
						</div>
					</td>
				</tr>			
			</tbody>
		</table>		
		<br>
		<table style="width: 100%; vertical-align: top;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้าได้รับทราบและพิจารณาสิทธิ์โควตาเข้าศึกษาต่อในระดับ<?php echo $class_new_txt;?> ปีการศึกษา <?php echo $next_yaer;?> โรงเรียนเรยีนาเชลีวิทยาลัย ร่วมกับนักเรียนในความปกครองของข้าพเจ้าแล้ว&nbsp;
						</div>
					</td>
				</tr>
				
			</tbody>
		</table>
		<br>

		<table style="width: 100%; vertical-align: top;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 15%; vertical-align: top;">
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">มีความประสงค์</div>
					</td>		
					<td style="width: 26%; vertical-align: top;">
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if($isr_MaintainRights=="รักษาสิทธิ์"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
						<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;รักษาสิทธิ์&nbsp;(โปรดเลือก 1 ข้อ)
					</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				
					<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
					<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;รักษาสิทธิ์&nbsp;(โปรดเลือก 1 ข้อ)
					</div>				
						
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
					
					</td>
					
					<td style="width: 49%; vertical-align: top; font-weight: bold;">
					
					
		<?php
				if($call_stu->IDLevel==23){ ?>

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($isr_PlanNew==12){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold; ">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;ห้องเรียนวิทยาศาสตร์ - คณิตศาสตร์ (สสวท.)&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;ห้องเรียนวิทยาศาสตร์ - คณิตศาสตร์ (สสวท.)&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
			<?php
					if($isr_PlanNew==2){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;ห้องเรียนปกติ&nbsp;
						</div>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;ห้องเรียนปกติ&nbsp;
						</div>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
				
		<?php	}elseif($call_stu->IDLevel==33){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($isr_PlanNew==13){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน วิทยาศาสตร์ - คณิตศาสตร์ (สสวท.)&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน วิทยาศาสตร์ - คณิตศาสตร์ (สสวท.)&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($isr_PlanNew==3){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน วิทยาศาสตร์ – คณิตศาสตร์&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน วิทยาศาสตร์ – คณิตศาสตร์&nbsp;
						</div>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($isr_PlanNew==4){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียนภาษาอังกฤษ – คณิตศาสตร์&nbsp;(ศิลป์ - คำนวณ)&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – คณิตศาสตร์&nbsp;(ศิลป์ - คำนวณ)&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($isr_PlanNew==5){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาฝรั่งเศส&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาฝรั่งเศส&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php
					if($isr_PlanNew==6){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาญี่ปุ่น&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียนภาษาอังกฤษ – ภาษาญี่ปุ่น&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($isr_PlanNew==7){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาจีน&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาจีน&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($isr_PlanNew==11){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาอังกฤษ&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาอังกฤษ&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php
					if($isr_PlanNew==15){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ศิลป์อาชีพ - ศิลปะการอาหารและการจัดการ&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ศิลป์อาชีพ - ศิลปะการอาหารและการจัดการ&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php
					if($isr_PlanNew==16){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ศิลป์อาชีพ - การจัดการธุรกิจบริการสุขภาพและผลิตภัณฑ์สมุนไพร&nbsp;
						</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<div style="font-size: 22px;font-family: THSarabunNew;">
							<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ศิลป์อาชีพ - การจัดการธุรกิจบริการสุขภาพและผลิตภัณฑ์สมุนไพร&nbsp;
						</div>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--> 				
		<?php	} ?>			
					</td>					
				</tr>
			</tbody>
		</table>
		
		<table style="width: 100%; vertical-align: top;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 15%; vertical-align: top; font-weight: bold;">
						<div>&nbsp;</div>
					</td>
					<td style="width: 75%; vertical-align: top; font-weight: bold;">
	
		<?php
				if($isr_MaintainRights=="สละสิทธิ์"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			
					<div style="font-size: 22px;font-family: THSarabunNew;">
					<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;สละสิทธิ์&nbsp;เนื่องจาก<input type="text" size="58" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;<?php echo $isr_MaintainRightsTxT;?>" readonly="readonly" required="required"/>
					</div>				
							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			
					<div style="font-size: 22px;font-family: THSarabunNew;">
					<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;สละสิทธิ์&nbsp;เนื่องจาก<input type="text" size="58" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;&nbsp;" readonly="readonly" required="required"/>
					</div>				
						
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	} ?>	
	
					</td>
				</tr>
			</tbody>
		</table>
		
		<br>
		<table style="width: 100%; vertical-align: top;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div style="font-size: 22px;font-family: THSarabunNew; font-weight: bold;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้าขอรับรองว่าข้อมูลตามที่ได้แจ้งในเอกสารฉบับนี้เป็นจริงทุกประการ
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<br><br>	
		<table style="width: 100%; vertical-align: top;"  border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 40%;"></td>
					<td style="width: 60%;">
						<div style="font-size: 22px;font-family: THSarabunNew; text-align: center;">
							ลงชื่อ<input type="text" size="40" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="<?php echo $myname_p;?>" readonly="readonly" required="required"/>ผู้ปกครอง
						</div>
					</td>
				</tr>
				<tr>
					<td style="width: 40%;"></td>
					<td style="width: 60%;">
						<div style="font-size: 22px;font-family: THSarabunNew; text-align: center;">
							วันที่<input type="text" size="20" style="font-family: THSarabunNew; font-size: 22px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter; " value="<?php echo datethai($print_data);?>" readonly="readonly" required="required"/>
						<div>
					</td>
				</tr>			
			</tbody>
		</table>
		
	</section>	
	
	
	
		
	

	
	</body>
</html>				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
			<?php	}else{
						$this->session->unset_userdata("rc_user");
						exit("<script>window.location='$golink/print_imgstu/error';</script>");
					}
				}							 
			}
		}
		
	}
?>


