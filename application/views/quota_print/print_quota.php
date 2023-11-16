<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
	include ("view/js_css_code/php-barcode-generator-master/src/BarcodeGenerator.php");
	include ("view/js_css_code/php-barcode-generator-master/src/BarcodeGeneratorHTML.php");
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
			if($log_row["int_uesr"]>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	$UesrRc=$this->load->database("default",TRUE);
	$UesrRc=$this->db->select("rsd_studentid");
	$UesrRc=$this->db->where("rsl_user",$LoginKey);
	$UesrRcRow=$this->db->get("regina_stu_login");
	foreach($UesrRcRow->result() as $URR){
		$usercopy=($URR->rsd_studentid);
		if(($usercopy==$RcId)){ ?>
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
		<title>พิมพ์&nbsp;ใบมอบตัวนักเรียนรอบโควตานักเรียนโรงเรียนเรยีนาเชลีวิทยาลัย</title>
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
										<div><button type="button"  style="font-size: 18px;" class="btn btn-default" onclick="window.print()"><b>พิมพ์&nbsp;ใบมอบตัวนักเรียนรอบโควตานักเรียนโรงเรียนเรยีนาเชลีวิทยาลัย</b></button></div>
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
		include("view/database/pdo_data.php");
		include("view/database/pdo_quota.php");	
		include("view/database/pdo_conndatastu.php");

		include("view/database/class_pdodatastu.php");	
		include("view/database/class_quota.php");
		error_reporting(error_reporting() & ~E_NOTICE); 
		$txt_year=$RcYear;
		$next_year=$RcYear+1;
		$date_time=date("Y-m-d H:i:s");
		//ระดับชั้น
		/*$call_stu=new stu_levelpdo($stuID,$txt_year,"1");
			switch ($call_stu->IDLevel){
					case "23":
						$leve_name="มัธยมศึกษาปีที่ 1";
						$leve_ID="31";
					break;
					
					case "33":
						$leve_name="มัธยมศึกษาปีที่ 4";
						$leve_ID="41";
					break;
						$leve_name="";
						$leve_ID="";
					default:
						
			}*/

	//ระดับชั้น
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
		$qce_key=filter_input(INPUT_POST,'qce_key');
		$qr_plan=filter_input(INPUT_POST,'qr_plan');
		$stuID=filter_input(INPUT_POST,'request_stuid');
		/*$qce_key="ON";
		$qr_plan="12";
		$stuID="16839";*/
	//ระดับชั้น
		$call_stu=new stu_levelpdo($stuID,$txt_year,"1");
		if(($call_stu->IDLevel==null or $call_stu->IDLevel=="0")){
			$call_stu=new stu_levelpdo($stuID,$txt_year,"2");		
		}else{
			//************************************************
		}
			switch ($call_stu->IDLevel){
				case "3" :
					$leve_name="ประถมศึกษาปีที่ 1";
					$leve_ID="11";	
				break;					
				case "23":
					$leve_name="มัธยมศึกษาปีที่ 1";
					$leve_ID="31";
				break;
				case "33":
					$leve_name="มัธยมศึกษาปีที่ 4";
					$leve_ID="41";
				break;
					$leve_name="-";
					$leve_ID="-";
				default:	
			}
	//ระดับชั้น	

		if(($qce_key==null or $qce_key=="-")){
			$key_key="-";
		}elseif($qce_key=="NO"){
			$key_key="-";
		}else{
			$key_key=$qce_key;
		}

		
	
		$count_quota_requesSql="SELECT count(`request_stuid`) as `count_rs` 
								FROM `quota_request` 
								WHERE `request_stuid`='{$stuID}' 
								and `request_year`='{$next_year}'
								and `request_level`='{$leve_ID}'";
		$count_quota_reques=new row_quotanotarray($count_quota_requesSql);
		foreach($count_quota_reques->print_quotanotarray() as $quot_key=>$count_quota_requesRow){
			$count_rs=$count_quota_requesRow["count_rs"];
			if($count_rs>=1){
				$up_quota_requesSql="UPDATE `quota_request` SET `qr_stuid`='{$qr_plan}',`qce_key`='{$key_key}' 
									WHERE `request_stuid`='{$stuID}' and `request_year`='{$next_year}' and `request_level`='{$leve_ID}'";
				$up_quota_reques=new insert_quota($up_quota_requesSql);
				if($up_quota_reques->print_insertQuota()=="yes"){
					//*************************************************
				}else{
					//*************************************************				
				}
			}else{
				$in_quota_requesSql="INSERT INTO `quota_request` (`request_stuid`, `request_year`, `request_level`, `requset_datetime`, `qr_stuid`, `qce_key`)
									 VALUES ('{$stuID}', '{$next_year}', '{$leve_ID}', '{$date_time}', '{$qr_plan}', '{$key_key}');";
				$in_quota_reques=new insert_quota($in_quota_requesSql);
				if($in_quota_reques->print_insertQuota()=="yes"){
					//*************************************************				
				}else{
					//*************************************************				
				}
			}
		}
	//--------------------------------------------------------
		//$next_year=2564;
		//$txt_year=2563;
		//$stuID="16616";



		$regina_stu_dataSql="SELECT * FROM `regina_stu_data` WHERE `rsd_studentid`='{$stuID}'";
		$regina_stu_data=new notrow_evaluation($regina_stu_dataSql);
		foreach($regina_stu_data->evaluation_array as $rc_key=>$regina_stu_datarow){}
	//home
		switch($regina_stu_datarow["rse_home"]){
			case "1":
				$txt_home="ฟ้า";
			break;
			
			case "2":
				$txt_home="แดง";
			break;	
			
			case "3":
				$txt_home="เหลือง";
			break;	
			
			case "4":
				$txt_home="เขียว";
			break;	
			
			default:
				$txt_home=".........................";
		}

	//home end





	?>


	<section class="sheet padding-10mm imgA">
	
		<table style="width: 100%; vertical-align: top;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 20%; font-size: 28px; text-align: center; font-family: THSarabunNew; font-weight: bold;">
						<div><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 75px; height: 73px;" alt=""/></div>
						<div>&nbsp;</div>
						<div>
							<table style="width: 100%; font-size: 20px; text-align: left; font-family: THSarabunNew; font-weight: bold; vertical-align: top;" border="1" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td>
											<div>&nbsp;เลขประจำตัว<input type="text" size="4" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $regina_stu_datarow["rsd_studentid"];?>" readonly="readonly" required="required"/></div>
											<div>&nbsp;สีบ้าน<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $txt_home;?>" readonly="readonly" required="required"/></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
					<td style="width: 60%; font-size: 25px; text-align: center; font-family: THSarabunNew; font-weight: bold;">
						<div>ใบมอบตัวนักเรียน&nbsp;ชั้น<?php echo $leve_name;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $next_year;?></b></div>  
						<div>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;จังหวัดเชียงใหม่</div>  
						<div>รอบโควตาภายใน</div>
						
						<div>
							<?php
									$quota_rightSql="SELECT `qr_stuid`, `qr_year`, `qr_level`, `qr_plan` 
									 FROM `quota_right` 
									 WHERE `qr_stuid`='{$stuID}' 
									 and `qr_year`='{$next_year}' 
									 and `qr_level`='{$leve_ID}'";
									$quota_right=new row_quotanotarray($quota_rightSql);
									foreach($quota_right->print_quotanotarray() as $rc_quota=>$quota_rightRow){
										$qr_stuid=$quota_rightRow["qr_stuid"];
										$qr_year=$quota_rightRow["qr_year"];
										$qr_level=$quota_rightRow["qr_level"];
										$qr_plan=$quota_rightRow["qr_plan"];
										if($qr_stuid!=""){ 
											$call_quota=new print_plan($qr_plan); ?>
							<center>
							<table  border="1" cellpadding="0" cellspacing="0" aligh="center" style="width: 95%; font-size: 20px; text-align: center; font-family: THSarabunNew; font-weight: bold; vertical-align: top;">
								 <tbody>
									<tr>
										<?php
											if($leve_ID=="31"){  ?>
													<td><center><div style="color :#F50206; font-weight: bold;">ได้รับสิทธิ์โควตา&nbsp;ห้องเรียน&nbsp;<?php echo $call_quota->plan_LName;?></div></center></td>						
									<?php	}else{ ?>
													<td><center><div style="color :#F50206; font-weight: bold;">ได้รับสิทธิ์โควตา&nbsp;แผนการเรียน&nbsp;<?php echo $call_quota->plan_LName;?></div></center></td>						
									<?php	}  ?>
									</tr>
								</tbody>
							</table>
							</center>
						   <?php 		}else{
											//---------------------------------------------------------------------
										}
									}
							?>
						</div>
						
					</td>
					<td style="width: 20%; font-size: 28px; text-align: center; font-family: THSarabunNew; font-weight: bold;">
						<div><img class="img-thumbnail" src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 2.50cm; height: 3.25cm;" alt="กรอกรูป"/></div>
					</td>
				
													
				</tr>
			</tbody>
		</table>

<?php
//*************************************************************************************************	
	$stu_motherSql="SELECT * FROM `stu_mother` WHERE`stu_id`='{$stuID}';";
	$stu_mother=new notrow_datastu($stu_motherSql);
	foreach($stu_mother->datastu_array as $rc_key=>$stu_motherRow){}



	$stu_mother_addressSql="SELECT * FROM `stu_mother_address` WHERE `stu_id`='{$stuID}'";
	$stu_mother_address=new notrow_datastu($stu_mother_addressSql);
	foreach($stu_mother_address->datastu_array as $rc_key=>$stu_mother_addressRow){
//---------------------------------------------------------------------------------------------		
		if(isset($stu_mother_addressRow["mother_hno"])){
			$mother_hno=$stu_mother_addressRow["mother_hno"];
		}else{
			$mother_hno="-";
		}
//---------------------------------------------------------------------------------------------		
		if(isset($stu_mother_addressRow['mother_moo'])){
			$mother_moo=$stu_mother_addressRow['mother_moo'];
		}else{
			$mother_moo="-";
		}
//---------------------------------------------------------------------------------------------
		if(isset($stu_mother_addressRow["mother_road"])){
			$mother_road=$stu_mother_addressRow["mother_road"];
		}else{
			$mother_road="-";
		}
//---------------------------------------------------------------------------------------------
		if(isset($stu_mother_addressRow['mother_soi'])){
			$mother_soi=$stu_mother_addressRow['mother_soi'];
		}else{
			$mother_soi="-";
		}
//---------------------------------------------------------------------------------------------
		if(isset($stu_mother_addressRow['mother_zipcode'])){
			$mother_zipcode=$stu_mother_addressRow['mother_zipcode'];
		}else{
			$mother_zipcode="-";
		}		
//---------------------------------------------------------------------------------------------		
	}	
	
	

	$stu_mother_addwordSql="SELECT * FROM `stu_mother_addword` WHERE `stu_id`='{$stuID}';";
	$stu_mother_addword=new notrow_datastu($stu_mother_addwordSql);
	foreach($stu_mother_addword->datastu_array as $rc_key=>$stu_mother_addwordRow){}	
	
	$mother_wordprovince=new data_Province($stu_mother_addwordRow["mother_wordprovince"]);
	
	$m_np=new stu_prefix($stu_motherRow["mother_prefix"]);
	$myname_m=$m_np->prefix_prefixname." ".$stu_motherRow["mother_fname"]." ".$stu_motherRow["mother_sname"];
	
	$mother_tumbon=new data_Subdistrict($stu_mother_addressRow["mother_tumbon"]);//ตำบล
	$mother_amphur=new data_District($stu_mother_addressRow["mother_amphur"]);///อำเภอ
	$mother_province=new data_Province($stu_mother_addressRow["mother_province"]);///จังหวัด
	
	$data_McareerSql="SELECT `dc_key`, `dc_txt2` FROM `data_career` WHERE `dc_key`='{$stu_motherRow["mother_career"]}'";
	$data_McareerRs=new notrow_datastu($data_McareerSql);
	foreach($data_McareerRs->datastu_array as $rc_key=>$data_McareerRow){
		$Mcareer=$data_McareerRow["dc_txt2"];
	}
	
//*************************************************************************************************	
	$stu_fatherSql="SELECT * FROM `stu_father` WHERE `stu_id`='{$stuID}'";
	$stu_father=new notrow_datastu($stu_fatherSql);
	foreach($stu_father->datastu_array as $rc_key=>$stu_fatherRow){}
	
	$stu_father_addwordSql="SELECT * FROM `stu_father_addword` WHERE `stu_id`='{$stuID}'";
	$stu_father_addword=new notrow_datastu($stu_father_addwordSql);
	foreach($stu_father_addword->datastu_array as $rc_key=>$stu_father_addwordRow){}
	
	
	
	$father_addwordprovince=new data_Province($stu_father_addwordRow["father_addwordprovince"]);

	
	$stu_father_addressSql="SELECT * FROM `stu_father_address` WHERE `stu_id`='{$stuID}';";
	$stu_father_address=new notrow_datastu($stu_father_addressSql);
	foreach($stu_father_address->datastu_array as $rc_key=>$stu_father_addressRow){
//---------------------------------------------------------------------------------------------		
		if(isset($stu_father_addressRow["father_hno"])){
			$father_hno=$stu_father_addressRow["father_hno"];
		}else{
			$father_hno="-";
		}
//---------------------------------------------------------------------------------------------		
		if(isset($stu_father_addressRow['father_moo'])){
			$father_moo=$stu_father_addressRow['father_moo'];
		}else{
			$father_moo="-";
		}
//---------------------------------------------------------------------------------------------		
		if(isset($stu_father_addressRow["father_road"])){
			$father_road=$stu_father_addressRow["father_road"];
		}else{
			$father_road="-";
		}
//---------------------------------------------------------------------------------------------		
		if(isset($stu_father_addressRow['father_soi'])){
			$father_soi=$stu_father_addressRow['father_soi'];
		}else{
			$father_soi="-";
		}
//---------------------------------------------------------------------------------------------		
		if(isset($stu_father_addressRow['father_zipcode'])){
			$father_zipcode=$stu_father_addressRow['father_zipcode'];
		}else{
			$father_zipcode="-";
		}
//---------------------------------------------------------------------------------------------	
	}
	
	$f_np=new stu_prefix($stu_fatherRow["father_prefix"]);
	$myname_f=$f_np->prefix_prefixname."&nbsp;".$stu_fatherRow["father_fname"]."&nbsp;".$stu_fatherRow["father_sname"];
	
	$father_tumbon=new data_Subdistrict($stu_father_addressRow["father_tumbon"]); // ตำบล
	$father_amphur=new data_District($stu_father_addressRow["father_amphur"]); //อำเภอ
	$father_province=new data_Province($stu_father_addressRow["father_province"]); //จังหวัด	
	
	$data_FcareerSql="SELECT `dc_key`, `dc_txt2` FROM `data_career` WHERE `dc_key`='{$stu_fatherRow["father_career"]}'";
	$data_FcareerRs=new notrow_datastu($data_FcareerSql);
	foreach($data_FcareerRs->datastu_array as $rc_key=>$data_FcareerRow){
		if(isset($data_FcareerRow["dc_txt2"])){
			$Fcareer=$data_FcareerRow["dc_txt2"];
		}else{
			$Fcareer="-";
		}
		
	}
	
	
	
//*************************************************************************************************	

	$stu_guardianSql="SELECT * FROM `stu_guardian` WHERE `stu_id`='{$stuID}';";
	$stu_guardian=new notrow_datastu($stu_guardianSql);
	foreach($stu_guardian->datastu_array as $rc_key=>$stu_guardianRow){}
	
	$stu_guardian_addressSql="SELECT * FROM `stu_guardian_address` WHERE `stu_id`='{$stuID}'";
	$stu_guardian_address=new notrow_datastu($stu_guardian_addressSql);
	foreach($stu_guardian_address->datastu_array as $rc_key=>$stu_guardian_addressRow){}
	
	$stu_guardian_addwordSql="SELECT * FROM `stu_guardian_addword` WHERE `stu_id`='{$stuID}'";
	$stu_guardian_addword=new notrow_datastu($stu_guardian_addwordSql);
	foreach($stu_guardian_addword->datastu_array as $rc_key=>$stu_guardian_addwordRow){}
	
	$print_parent_status=new data_rely ($stu_guardianRow["parent_status"]);
	
	$g_np=new stu_prefix($stu_guardianRow["parent_prefix"]);
		if(isset($g_np->prefix_prefixname)){
			$myname_g=$g_np->prefix_prefixname."&nbsp;".$stu_guardianRow["parent_fname"]."&nbsp;".$stu_guardianRow["parent_sname"];
		}else{
			$myname_g=$stu_guardianRow["parent_fname"]."&nbsp;".$stu_guardianRow["parent_sname"];
		}
	
	$parent_tumbon=new data_Subdistrict($stu_guardian_addressRow["parent_tumbon"]);
	$parent_amphur=new data_District($stu_guardian_addressRow["parent_amphur"]);
	$parent_province=new data_Province($stu_guardian_addressRow["parent_province"]);
	
	/*$parent_tumbon=new data_Subdistrict($stu_guardian_addressRow["parent_tumbon"]);// ตำบล
	$parent_amphur=new data_District($stu_guardian_addressRow["parent_amphur"]);//อำเภอ
	$parent_province=new data_Province($stu_guardian_addressRow["parent_province"]);//จังหวัด*/
//*************************************************************************************************	
	$stu_depend_stuSql="SELECT * FROM `depend_stu` WHERE `ds_stuid`='{$stuID}'";
	$stu_depend_stu=new notrow_datastu($stu_depend_stuSql);
	foreach($stu_depend_stu->datastu_array as $rc_key=>$stu_depend_stuRow){}

	
	
	$ds_dormitoryTumbon=new data_Subdistrict ($stu_depend_stuRow["ds_dormitoryTumbon"]);		
	$ds_dormitoryAmphur=new data_District ($stu_depend_stuRow["ds_dormitoryAmphur"]);
	$ds_dormitoryProvince=new data_Province ($stu_depend_stuRow["ds_dormitoryProvince"]);

//*************************************************************************************************	
	
?>

<?php
	if($stu_guardianRow["parent_status"]==2){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		
	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า(ผู้ปกครอง)<input type="text" size="50" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $myname_f; ?>" readonly="readonly" required="required">เลขบัตรประชาชน<input type="text" size="19" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_fatherRow['father_code'];?>" readonly="readonly" required="required"></div>
					<div>ที่อยู่ปัจจุบัน&nbsp;เลขที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_hno;?>" readonly="readonly" required="required">หมู่ที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_moo;?>" readonly="readonly" required="required">ถนน<input type="text" size="40" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_road;?>" readonly="readonly" required="required">ซอย<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_soi;?>" readonly="readonly" required="required"></div>
					<div>ตำบล<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_tumbon->DISTRICT_NAME; ?>" readonly="readonly" required="required">อำเภอ<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required">จังหวัด<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_province->PROVINCE_NAME; ?>" readonly="readonly" required="required">รหัสไปรษณีย์<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_zipcode;?>" readonly="readonly" required="required"></div>
					<div>โทรศัพท์<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_fatherRow['father_phone'];?>" readonly="readonly" required="required">เกี่ยวข้องกับนักเรียนเป็น<input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $print_parent_status->dr_txt;?>" readonly="readonly" required="required">&nbsp;ขอมอบตัวนักเรียนไว้กับผู้บริหารโรงเรียนเรยีนาเชลีวิทยาลัย</div>
				</td>
			</tr>
		</tbody>
	</table>	
	


<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	}elseif($stu_guardianRow["parent_status"]==3){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า(ผู้ปกครอง)<input type="text" size="50" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $myname_m; ?>" readonly="readonly" required="required">เลขบัตรประชาชน<input type="text" size="19" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_motherRow['mother_code'];?>" readonly="readonly" required="required"></div>
					<div>ที่อยู่ปัจจุบัน&nbsp;เลขที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_hno;?>" readonly="readonly" required="required">หมู่ที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_moo;?>" readonly="readonly" required="required">ถนน<input type="text" size="40" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_road;?>" readonly="readonly" required="required">ซอย<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_soi;?>" readonly="readonly" required="required"></div>
					<div>ตำบล<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_tumbon->DISTRICT_NAME; ?>" readonly="readonly" required="required">อำเภอ<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required">จังหวัด<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_province->PROVINCE_NAME; ?>" readonly="readonly" required="required">รหัสไปรษณีย์<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_zipcode;?>" readonly="readonly" required="required"></div>
					<div>โทรศัพท์<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_motherRow['mother_phone'];?>" readonly="readonly" required="required">เกี่ยวข้องกับนักเรียนเป็น<input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $print_parent_status->dr_txt;?>" readonly="readonly" required="required">&nbsp;ขอมอบตัวนักเรียนไว้กับผู้บริหารโรงเรียนเรยีนาเชลีวิทยาลัย</div>
				</td>
			</tr>
		</tbody>
	</table>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}elseif($stu_guardianRow["parent_status"]==5){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า(ผู้ปกครอง)<input type="text" size="50" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_depend_stuRow["ds_dormitoryMyName"]; ?>" readonly="readonly" required="required">เลขบัตรประชาชน<input type="text" size="19" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;" readonly="readonly" required="required"></div>
					<div>ที่อยู่ปัจจุบัน&nbsp;เลขที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_depend_stuRow['ds_dormitoryHno']; ?>" readonly="readonly" required="required">หมู่ที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_depend_stuRow['ds_dormitoryMoo'];?>" readonly="readonly" required="required">ถนน<input type="text" size="40" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_depend_stuRow["ds_dormitoryRoad"];?>" readonly="readonly" required="required">ซอย<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_depend_stuRow['ds_dormitorySoi']?>" readonly="readonly" required="required"></div>
					<div>ตำบล<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $ds_dormitoryTumbon->DISTRICT_NAME; ?>" readonly="readonly" required="required">อำเภอ<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $ds_dormitoryAmphur->AMPHUR_NAME;?>" readonly="readonly" required="required">จังหวัด<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $ds_dormitoryProvince->PROVINCE_NAME; ?>" readonly="readonly" required="required">รหัสไปรษณีย์<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_depend_stuRow['ds_dormitoryZipcode'];?>" readonly="readonly" required="required"></div>
					<div>โทรศัพท์<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_depend_stuRow['ds_dormitoryPhone'];?>" readonly="readonly" required="required">เกี่ยวข้องกับนักเรียนเป็น<input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $print_parent_status->dr_txt;?>" readonly="readonly" required="required">&nbsp;ขอมอบตัวนักเรียนไว้กับผู้บริหารโรงเรียนเรยีนาเชลีวิทยาลัย</div>
				</td>
			</tr>
		</tbody>
	</table>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า(ผู้ปกครอง)<input type="text" size="50" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $myname_g; ?>" readonly="readonly" required="required">เลขบัตรประชาชน<input type="text" size="19" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_guardianRow ['parent_code'];?>" readonly="readonly" required="required"></div>
					<div>ที่อยู่ปัจจุบัน&nbsp;เลขที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_guardian_addressRow ['parent_hno']; ?>" readonly="readonly" required="required">หมู่ที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_guardian_addressRow['parent_moo'];?>" readonly="readonly" required="required">ถนน<input type="text" size="40" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_guardian_addressRow["parent_road"];?>" readonly="readonly" required="required">ซอย<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_guardian_addressRow['parent_soi'];?>" readonly="readonly" required="required"></div>
					<div>ตำบล<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $parent_tumbon->DISTRICT_NAME; ?>" readonly="readonly" required="required">อำเภอ<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $parent_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required">จังหวัด<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $parent_province->PROVINCE_NAME; ?>" readonly="readonly" required="required">รหัสไปรษณีย์<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_guardian_addressRow['parent_zipcode'];?>" readonly="readonly" required="required"></div>
					<div>โทรศัพท์<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_guardianRow['mother_phone'];?>" readonly="readonly" required="required">เกี่ยวข้องกับนักเรียนเป็น<input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $print_parent_status->dr_txt;?>" readonly="readonly" required="required">&nbsp;ขอมอบตัวนักเรียนไว้กับผู้บริหารโรงเรียนเรยีนาเชลีวิทยาลัย</div>
				</td>
			</tr>
		</tbody>
	</table>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	} ?>

<?php
	$regina_stu_dataSql="SELECT * FROM `regina_stu_data` WHERE `rsd_studentid`='{$stuID}'";
	$regina_stu_data=new notrow_evaluation($regina_stu_dataSql);
	foreach($regina_stu_data->evaluation_array as $rc_key=>$regina_stu_datarow){
		if($regina_stu_datarow["rsd_prefix"]==2){
			$mynameTh="เด็กหญิง&nbsp;".$regina_stu_datarow["rsd_name"]."&nbsp;".$regina_stu_datarow["rsd_surname"];			
		}elseif($regina_stu_datarow["rsd_prefix"]==4){
			$mynameTh="นางสาว&nbsp;".$regina_stu_datarow["rsd_name"]."&nbsp;".$regina_stu_datarow["rsd_surname"];			
		}else{
			$mynameTh=$regina_stu_datarow["rsd_name"]."&nbsp;".$regina_stu_datarow["rsd_surname"];			
		}
		$mynameEn="Miss&nbsp;".$regina_stu_datarow["rsd_nameEn"]."&nbsp;".$regina_stu_datarow["rsd_surnameEn"];
	}

	$data_studentSql="SELECT * FROM `data_student` WHERE `stu_id`='{$stuID}'";
	$data_student=new notrow_datastu($data_studentSql);
	foreach($data_student->datastu_array as $rc_key=>$data_studentrow){}
	
	$stu_addressSql="SELECT * FROM `stu_address` WHERE `stu_id`='{$stuID}'";
	$stu_address=new notrow_datastu($stu_addressSql);
	foreach($stu_address->datastu_array as $rc_key=>$stu_addressRow){}
	
	$stu_nation=new db_country($data_studentrow["stu_nation"]);
	$stu_sun=new  db_country($data_studentrow["stu_sun"]);


	$rc_religionSql="SELECT `Religion` FROM `rc_religion` WHERE `IDReligion`='{$data_studentrow["IDReligion"]}';";
	$rc_religion=new notrow_datastu($rc_religionSql);
	foreach($rc_religion->datastu_array as $rc_key=>$rc_religionRow){
		$Religion=$rc_religionRow["Religion"];
	}

	$stu_tumbon=new data_Subdistrict ($stu_addressRow["stu_tumbon"]); // ตำบล
	$stu_amphur=new data_District ($stu_addressRow["stu_amphur"]); //อำเภอ
	$stu_province=new data_Province($stu_addressRow["stu_province"]); //จังหวัด

	$stu_depend_stuSql="SELECT * FROM `depend_stu` WHERE `ds_stuid`='{$stuID}'";
	$stu_depend_stu=new notrow_datastu($stu_depend_stuSql);
	foreach($stu_depend_stu->datastu_array as $rc_key=>$stu_depend_stuRow){}



?>


		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อนักเรียนภาษาไทย<input type="text" size="50" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mynameTh;?>" readonly="readonly" required="required"><b>เลขบัตรประชาชน</b><input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $regina_stu_datarow['rsd_Identification'];?>" readonly="readonly" required="required"></div>
						<div>
							<font style="font-weight: bold;">ชื่อนักเรียนภาษาอังกฤษ</font><input type="text" size="43" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mynameEn;?>" readonly="readonly" required="required">
							
<?php
		if(($data_studentrow['stu_birth']==null or $data_studentrow['stu_birth']=="-")){ ?>
							<font style="font-weight: bold;">วัน/เดือน/ปี เกิด</font><input type="text" size="12" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="" readonly="readonly" required="required">
<?php	}else{ ?>
							<font style="font-weight: bold;">วัน/เดือน/ปี เกิด</font><input type="text" size="12" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo datethai($data_studentrow['stu_birth']);?>" readonly="readonly" required="required">			
<?php	} ?>
							

							<font style="font-weight: bold;">หมู่เลือด</font><input type="text" size="4" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $data_studentrow['stu_blood'];?>" readonly="readonly" required="required">
						</div>
						<div>
							<font style="font-weight: bold;">เชื่อชาติ</font><input type="text" size="15" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_nation->nation_name_th;?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">สัญชาติ</font><input type="text" size="15" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_sun->nation_name_th;?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">ศาสนา</font><input type="text" size="14" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $Religion;?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">ที่อยู่ปัจจุบัน เลขที่</font><input type="text" size="6" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_addressRow['stu_hno'];?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">หมู่ที่</font><input type="text" size="2" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_addressRow['stu_moo'];?>" readonly="readonly" required="required">
						</div>
						<div>
							<font style="font-weight: bold;">ถนน</font><input type="text" size="40" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_addressRow['stu_road'];?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">ซอย</font><input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_addressRow['stu_soi'];?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">ตำบล</font><input type="text" size="27" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_tumbon->DISTRICT_NAME;?>" readonly="readonly" required="required">

						</div>
						<div>
							<font style="font-weight: bold;">อำเภอ</font><input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">จังหวัด</font><input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_province->PROVINCE_NAME;?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">รหัสไปรษณีย์</font><input type="text" size="13" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_addressRow["stu_zipcode"];?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">โทรศัพท์</font><input type="text" size="12" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $data_studentrow["stu_phone"];?>" readonly="readonly" required="required">
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							ชื่อบิดา<input type="text" size="37" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $myname_f;?>" readonly="readonly" required="required">
							เลขบัตรประชาชน<input type="text" size="13" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_fatherRow['father_code'];?>" readonly="readonly" required="required">
							อาชีพ<input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $Fcareer;?>" readonly="readonly" required="required">
						</div>
						<div>สถานที่ทำงาน<input type="text" size="34" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_fatherRow['father_workplace'];?>" readonly="readonly" required="required">จังหวัด<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_addwordprovince->PROVINCE_NAME;?>" readonly="readonly" required="required">โทรศัพท์ที่ทำงาน<input type="text" size="15" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_fatherRow['father_wp_tel'];?>" readonly="readonly" required="required"></div>
						<div>ที่อยู่ปัจจุบัน เลขที่<input type="text" size="6" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_father_addressRow['father_hno'];?>" readonly="readonly" required="required">หมู่ที่<input type="text" size="3" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_father_addressRow['father_moo'];?>" readonly="readonly" required="required">ถนน<input type="text" size="29" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_father_addressRow["father_road"];?>" readonly="readonly" required="required">ซอย<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_father_addressRow['father_soi'];?>" readonly="readonly" required="required">ตำบล<input type="text" size="13" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_tumbon->DISTRICT_NAME;?>" readonly="readonly" required="required"></div>
						<div>อำเภอ<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required">จังหวัด<input type="text" size="26" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_province->PROVINCE_NAME;?>" readonly="readonly" required="required">รหัสไปรษณีย์<input type="text" size="6" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_father_addressRow['father_zipcode'];?>" readonly="readonly" required="required">โทรศัพท์<input type="text" size="15" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_fatherRow['father_phone'];?>" readonly="readonly" required="required"></div>
					</td>
				</tr>
			</tbody>					
		</table>

		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อมารดา<input type="text" size="35" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $myname_m;?>" readonly="readonly" required="required">เลขบัตรประชาชน<input type="text" size="13" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_motherRow['mother_code'];?>" readonly="readonly" required="required">อาชีพ<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $Mcareer;?>" readonly="readonly" required="required"></div>
						<div>สถานที่ทำงาน<input type="text" size="34" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_motherRow['mother_workplace'];?>" readonly="readonly" required="required">จังหวัด<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_wordprovince->PROVINCE_NAME;?>" readonly="readonly" required="required">โทรศัพท์ที่ทำงาน<input type="text" size="15" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_motherRow['mother_wp_tel'];?>" readonly="readonly" required="required"></div>
						<div>ที่อยู่ปัจจุบัน เลขที่<input type="text" size="6" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_mother_addressRow['mother_hno'];?>" readonly="readonly" required="required">หมู่ที่<input type="text" size="3" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_mother_addressRow['mother_moo'];?>" readonly="readonly" required="required">ถนน<input type="text" size="29" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_mother_addressRow["mother_road"];?>" readonly="readonly" required="required">ซอย<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_mother_addressRow['mother_soi'];?>" readonly="readonly" required="required">ตำบล<input type="text" size="13" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_tumbon->DISTRICT_NAME;?>" readonly="readonly" required="required"></div>
						<div>อำเภอ<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required">จังหวัด<input type="text" size="26" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_province->PROVINCE_NAME;?>" readonly="readonly" required="required">รหัสไปรษณีย์<input type="text" size="6" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_mother_addressRow['mother_zipcode'];?>" readonly="readonly" required="required">โทรศัพท์<input type="text" size="15" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_motherRow['mother_phone'];?>" readonly="readonly" required="required"></div>
					</td>
				</tr>
			</tbody>					
		</table>
		<div>&nbsp;</div>
		<center><table style="width: 60%; vertical-align: top; font-size: 20px; font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
		  <tbody>
			<tr>
			  <td><div><center><b>สถานภาพบิดา-มารดา</b></center></div></td>
			  
			<?php 	if ($stu_depend_stuRow['ds_FMstatus'] == '1') { ?>
				<td>
				<center><div>
				&nbsp;<font style="font-family: THSarabunNew; font-size: 20px"><img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="13" height="13" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
				</div></center>
				<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
			  </td>
				
		<?php		} else if ($stu_depend_stuRow['ds_FMstatus'] == '2') { ?>
				<td>
				<center><div>
				&nbsp;<font style="font-family: THSarabunNew; font-size: 20px"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="13" height="13" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
				</div></center>
				<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
			  </td>			
		<?php		} else if ($stu_depend_stuRow['ds_FMstatus'] == '3') { ?>
				<td>
				<center><div>
				&nbsp;<font style="font-family: THSarabunNew; font-size: 20px"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="13" height="13" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
				</div></center>
				<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
			  </td>			
		<?php		} else if ($stu_depend_stuRow['ds_FMstatus'] == '4') { ?>
				<td>
				<center><div>
				&nbsp;<font style="font-family: THSarabunNew; font-size: 20px"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
				</div></center>
				<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="13" height="13" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
			  </td>			
		<?php		} else if ($stu_depend_stuRow['ds_FMstatus'] == '5') { ?>
				<td>
				<center><div>
				&nbsp;<font style="font-family: THSarabunNew; font-size: 20px"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
				</div></center>
				<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="13" height="13" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
			  </td>		
		<?php		}else{ ?>
				<td>
				<center><div>
				&nbsp;<font style="font-family: THSarabunNew; font-size: 20px"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
				</div></center>
				<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
			  </td>				
		<?php		} ?>	
			</tr>
		  </tbody>
		</table></center>
		<br>
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้ามีความประสงค์ที่จะให้บุตรสาวศึกษาต่อที่โรงเรียนเรยีนาเชลีวิทยาลัย และยินดีให้ความร่วมมือกับทางโรงเรียนในการส่งเสริม สนับสนุน ดูแลบุตรสาวทั้งด้านการเรียน ความประพฤติให้ปฏิบัติอยู่ในกฎระเบียบของโรงเรียน พร้อมกันนี้ข้าพเจ้าได้ชำระเงินยืนยันการมอบตัวนักเรียนเรียบร้อยแล้ว หากบุตรสาวของข้าพเจ้าสละสิทธิ์ไม่ว่ากรณีใดๆ ข้าพเจ้ายินดีมอบเงินทั้งหมดให้กับทางโรงเรียนเพื่อ สนับสนุนการศึกษาของโรงเรียนต่อไป</div>
					</td>
				</tr>
			</tbody>					
		</table>
		
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 50%">
					
		<table style="vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
  			<tbody>
    			<tr>
			      <td>
					<div id="fontA"><center><b>เอกสารประกอบการมอบตัว มีดังนี้</b></center></div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$quota_InternalSaveRights=new PrintSendDocuments($stuID,$next_year);
		if($quota_InternalSaveRights->RowArraySendDocuments() && (gettype($quota_InternalSaveRights->RowArraySendDocuments())=='array' || gettype($quota_InternalSaveRights->RowArraySendDocuments())=='object')){
			foreach($quota_InternalSaveRights->RowArraySendDocuments() as $rc=>$InternalSaveRightsRow){ 
				$sd_send_documents=$InternalSaveRightsRow["sd_send_documents"];
				$SdStudentIDCard=$InternalSaveRightsRow["SdStudentIDCard"];
				$SdParentIDCard=$InternalSaveRightsRow["SdParentIDCard"];
				$sd_surrender=$InternalSaveRightsRow["sd_surrender"];
				$sd_financial_documents=$InternalSaveRightsRow["sd_financial_documents"];				
			}			
		}else{
			$sd_send_documents="-";
			$SdStudentIDCard="-";
			$SdParentIDCard="-";
			$sd_surrender="-";
			$sd_financial_documents="-";
		}
	?>			

		
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
				

				
		<?php
			   if($SdStudentIDCard=="yes"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div id="fontA">&nbsp;<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="12" height="12" alt=""/>&nbsp;สำเนาบัตรประชาชนนักเรียน จำนวน 1 ฉบับ</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php  }else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div id="fontA">&nbsp;<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="12" height="12" alt=""/>&nbsp;สำเนาบัตรประชาชนนักเรียน จำนวน 1 ฉบับ</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php  } ?>					
					
		<?php
			   if($SdParentIDCard=="yes"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div id="fontA">&nbsp;<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="12" height="12" alt=""/>&nbsp;สำเนาบัตรประชาชนบิดา หรือ มารดา หรือ ผู้ปกครอง จำนวน 1 ฉบับ</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php  }else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div id="fontA">&nbsp;<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="12" height="12" alt=""/>&nbsp;สำเนาบัตรประชาชนบิดา หรือ มารดา หรือ ผู้ปกครอง จำนวน 1 ฉบับ</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php  }?>	

		<?php
			   if($sd_financial_documents=="yes"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div id="fontA">&nbsp;<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="12" height="12" alt=""/>&nbsp;หลักฐานการชำระเงิน (สลิปโอนเงิน หรือสำเนาใบเสร็จรับเงิน)</div>				   
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				   
		<?php  }else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div id="fontA">&nbsp;<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="12" height="12" alt=""/>&nbsp;หลักฐานการชำระเงิน (สลิปโอนเงิน หรือสำเนาใบเสร็จรับเงิน)</div>				   
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				   
		<?php  }?>
					
		<?php
				if(isset($sd_send_documents)){
					if($sd_send_documents=="mail"){ ?>
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
					<center>
						<div id="fontA">วิธีการนำส่งเอกสารประกอบการมอบตัว</div>
					</center>						
						<div id="fontA">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ส่งทาง E-mail : academic@regina.ac.th</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
		<?php		}elseif($sd_send_documents=="zip"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
					<center>
						<div id="fontA">วิธีการนำส่งเอกสารประกอบการมอบตัว</div>
					</center>							
						<div id="fontA">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ส่งทางไปรษณีย์</div>
						<div id="fontA">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ชื่อและที่อยู่ผู้รับ)&nbsp;ฝ่ายวิชาการ&nbsp;โรงเรียนเรยีนาเชลีวิทยาลัย</div>
						<div id="fontA">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขที่&nbsp;166&nbsp;ถ.เจริญประเทศ&nbsp;ต.ช้างคลาน&nbsp;อ.เมือง&nbsp;จ.เชียงใหม่ 50100</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
		<?php		}else{  ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
		<?php		}       
				}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}      ?>				

				  </td>
			    </tr>
  			</tbody>
		</table>					
					
					</td>
					<td style="width: 5%"></td>
					<td style="width: 37%">
					
<!--<?php
		if(!isset($stu_guardianRow["parent_status"])){ ?>
		<p><center><div>ลงชื่อ<input type="text" size="25" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="" readonly="readonly" required="required">ผู้ปกครอง</div>			
<?php	}elseif($stu_guardianRow["parent_status"]=="2"){ ?>
		<p><center><div>ลงชื่อ<input type="text" size="25" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php //echo $myname_f; ?>" readonly="readonly" required="required">ผู้ปกครอง</div>			
<?php	}elseif($stu_guardianRow["parent_status"]=="3"){ ?>
		<p><center><div>ลงชื่อ<input type="text" size="25" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php //echo $myname_m; ?>" readonly="readonly" required="required">ผู้ปกครอง</div>			
<?php	}elseif($stu_guardianRow["parent_status"]=="5"){ ?>
		<p><center><div>ลงชื่อ<input type="text" size="25" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php //echo $stu_depend_stuRow["ds_dormitoryMyName"]; ?>" readonly="readonly" required="required">ผู้ปกครอง</div>			
<?php	}else{ ?>
		<p><center><div>ลงชื่อ<input type="text" size="25" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php //echo $myname_g; ?>" readonly="readonly" required="required">ผู้ปกครอง</div>			
<?php	}?>-->	
						<P>
						<center>
							<div>ลงชื่อ.............................................ผู้ปกครอง</div>
							<div>(.....................................................)</div>
							<div>วันที่...........เดือน.....................พ.ศ............</div>
						</center>		
						<P>
						<center>
							<div>ลงชื่อ.............................................ผู้รับเอกสาร</div>
							<div>(.....................................................)</div>
							<div>วันที่...........เดือน.....................พ.ศ............</div>
						</center>
										
					</td>
				</tr>
			</tbody>					
		</table>




		


	</section>	
	
<?php
		if($key_key==12 or $key_key==13){ ?>
		
				
		<?php
			
			if(isset($stuID,$leve_ID,$key_key,$next_year)){
				$IntoTheTest=new IntoTheTest($stuID,$leve_ID,$key_key,$next_year);
			}else{
				//----------------------------------------------------------------
			}
			
			$ShowDeleteTheTest=new ShowDeleteTheTest($stuID,$next_year,$leve_ID,$key_key,"ShowDate");
				if(is_array($ShowDeleteTheTest->RunShowTheTest()) && count($ShowDeleteTheTest->RunShowTheTest())){
					foreach($ShowDeleteTheTest->RunShowTheTest() as $rc=>$ShowDeleteTheTestRow){
						if(isset($ShowDeleteTheTestRow["qtt_id"])){
							$qtt_id=$ShowDeleteTheTestRow["qtt_id"];
							$qtt_year=$ShowDeleteTheTestRow["qtt_year"];
							$qtt_plan=$ShowDeleteTheTestRow["qtt_plan"];
							$qtt_class=$ShowDeleteTheTestRow["qtt_class"];
						}else{
							$qtt_id="-";
							$qtt_year="-";
							$qtt_plan="-";
							$qtt_class="-";							
						}
					}		
				}else{
					$qtt_id="-";
					$qtt_year="-";
					$qtt_plan="-";
					$qtt_class="-";
				}
		?>
		
	<section class="sheet padding-10mm imgA">

		<table  style="width: 100%; vertical-align: top; font-size: 22px; font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 50%;">
						<div style="text-align: left;">เลขประจำตัวผู้เข้าสอบ<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $qtt_id;?>" readonly="readonly" required="required"></div>
					</td>
					<td style="width: 50%;">
						<div style="text-align: right;">สำหรับเจ้าหน้าที่</div>
					</td>
				</tr>
			</tbody>		
		</table>

		<table  style="width: 100%; vertical-align: top; font-size: 21px; font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<center>
							<div><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 65px; height: 63px;" alt="โรงเรียนเรยีนาเชลีวิทยาลัย จังหวัดเชียงใหม่"/></div>
							<div>ใบสมัครสอบคัดเลือกนักเรียนห้องเรียน วิทยาศาสตร์-คณิตศาสตร์ (สสวท.) </div>
							<div>ระดับชั้น<?php echo $leve_name;?> ปีการศึกษา <?php echo $next_year;?></div>
							<div>โรงเรียนเรยีนาเชลีวิทยาลัย  จังหวัดเชียงใหม่</div>
						</center>
					</td>
				</tr>
			</tbody>
		</table>
	
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div align="right"><img class="img-thumbnail" src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" alt="กรอกรูป"  style="width: 2.50cm; height: 3.25cm; text-align: right;"/></div>
					</td>
				</tr>
			</tbody>
		</table>
	
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			  <tbody>
				<tr>
				  <td>
					<div>ข้าพเจ้า<input type="text" size="102" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mynameTh;?>" readonly="readonly" required="required"></div>
					<div>เลขประจำตัวนักเรียน<input type="text" size="30" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $regina_stu_datarow["rsd_studentid"];?>" readonly="readonly" required="required">เลขประจำตัวประชาชน<input type="text" size="36" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $regina_stu_datarow['rsd_Identification'];?>" readonly="readonly" required="required"></div>  
				  </td>
				</tr>
			  </tbody>
		</table>
	
<?php
if($key_key==12){ ?>
		<br>
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<center>
							<div>มีความประสงค์สมัครสอบคัดเลือกห้องเรียน วิทยาศาสตร์-คณิตศาสตร์ (สสวท.) ระดับชั้นมัธยมศึกษาปีที่ 1  ปีการศึกษา <?php echo $next_year;?></div>
							<div>และจะปฏิบัติตามระเบียบและข้อปฎบัติในการสอบทุกประการ</div>
						</center>
					</td>
				</tr>
			</tbody>
		</table>
		
		<!--<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td colspan="3">
						<div><b><u><center>กำหนดการรับสมัคร</center></u></b></div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 20%;"><div><center>วัน/เดือน/ปี</center></div></td>
					<td style="width: 60%;"><div><center>รายการ</center></div></td>
					<td style="width: 20%;"><div><center>สถานที่</center></div></td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>20 ส.ค. - 3 ก.ย. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>สมัครสอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>26 พ.ย. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>ตรวจสอบรายชื่อ เลขที่นั่งสอบ และสถานที่สอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>27 พ.ย. 2564</div>
						<div>เวลา 13.00 - 16.00 น.</div>
					</td>
					<td style="width: 60%;">
						<div>สอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
						<div><u>เนื้อหาที่สอบ</u>&nbsp;ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
						<div>ระดับชั้นประถมศึกษาปีที่ 4-5 และประถมศึกษาปีที่ 6 (เฉพาะภาคเรียนที่ 1)</div>
					</td>
					<td style="width: 20%;">
						<div>ตามประกาศ</div>
					</td>
				</tr>	
				<tr>
					<td style="width: 20%;">
						<div>1 ธ.ค. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>ประกาศผลสอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>				
				<tr>
					<td style="width: 20%;">
						<div><b><u>เนื้อหาที่สอบ</u></b></div>
					</td>
					<td style="width: 60%;">
						<div>ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
						<div>ระดับชั้นประถมศึกษาปีที่ 4-5 และประถมศึกษาปีที่ 6 (เฉพาะภาคเรียนที่ 1)</div>
					</td>
					<td style="width: 20%;">
						<div></div>
					</td>
				</tr>				
			</tbody>
		</table>-->				

<?php }else{ ?>
		<br>
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<center>
							<div>มีความประสงค์สมัครสอบคัดเลือกห้องเรียน วิทยาศาสตร์-คณิตศาสตร์ (สสวท.) ระดับชั้นมัธยมศึกษาปีที่ 4  ปีการศึกษา <?php echo $next_year;?></div>
							<div>และจะปฏิบัติตามระเบียบและข้อปฎบัติในการสอบทุกประการ</div>
						</center>
					</td>
				</tr>
			</tbody>
		</table>
		
		<!--<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td colspan="3">
						<div><b><u><center>กำหนดการรับสมัคร</center></u></b></div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 20%;"><div><center>วัน/เดือน/ปี</center></div></td>
					<td style="width: 60%;"><div><center>รายการ</center></div></td>
					<td style="width: 20%;"><div><center>สถานที่</center></div></td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>20 ส.ค. - 3 ก.ย. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>สมัครสอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>26 พ.ย. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>ตรวจสอบรายชื่อ เลขที่นั่งสอบ และสถานที่สอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>27 พ.ย. 2564</div>
						<div>เวลา 13.00 - 16.00 น.</div>
					</td>
					<td style="width: 60%;">
						<div>สอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
						<div><u>เนื้อหาที่สอบ</u>&nbsp;ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
						<div>ระดับชั้นมัธยมศึกษาปีที่ 4-5 และมัธยมศึกษาปีที่ 6 (เฉพาะภาคเรียนที่ 1)</div>
					</td>
					<td style="width: 20%;">
						<div>ตามประกาศ</div>
					</td>
				</tr>	
				<tr>
					<td style="width: 20%;">
						<div>1 ธ.ค. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>ประกาศผลสอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>				
				<tr>
					<td style="width: 20%;">
						<div><b><u>เนื้อหาที่สอบ</u></b></div>
					</td>
					<td style="width: 60%;">
						<div>ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
						<div>ระดับชั้นมัธยมศึกษาปีที่ 1-3 (เฉพาะภาคเรียนที่ 1)</div>
					</td>
					<td style="width: 20%;">
						<div></div>
					</td>
				</tr>				
			</tbody>
		</table>-->	
<?php }      ?>	

	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td><center><div>ข้าพเจ้าขอรับรองว่า ข้อความดังกล่าวทั้งหมดในใบสมัครนี้เป็นจริงทุกประการ และจะนำใบสมัครมาแสดงต่อเจ้าหน้าที่ในวันสอบ</div></td>
			</tr>
		</tbody>
	</table>
	<br>
	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
	  <tbody>
		<tr>
		  <td>
			<center>
				<div>ลงชื่อ<input type="text" size="30" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="<?php //echo $mynameTh;?>" readonly="readonly" required="required"></div>
				<div>วันที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="<?php //echo datethai($date_time);?>" readonly="readonly" required="required"></div>
				<div>ผู้สมัคร</div>
			</center>
		  </td>
		  <td>
			<center>
			<div>ลงชื่อ................................................</div>
			<div>(.....................................................)</div>
			<div>เจ้าหน้าที่รับสมัคร</div></center>		
		  </td>
		</tr>
	  </tbody>
	</table>

	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div>----------------------------------------------------------------------------------------------------------------------------------------------------------------------</div>
				</td>
			</tr>
		</tbody>	
	</table>

		<table  style="width: 100%; vertical-align: top; font-size: 22px; font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 50%;">
						<div style="text-align: left;">เลขประจำตัวผู้เข้าสอบ<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $qtt_id;?>" readonly="readonly" required="required"></div>
					</td>
					<td style="width: 50%;">
						<div style="text-align: right;">สำหรับนักเรียน</div>
					</td>
				</tr>
			</tbody>		
		</table>

		<table  style="width: 100%; vertical-align: top; font-size: 21px; font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<center>
							<div><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 65px; height: 63px;" alt="โรงเรียนเรยีนาเชลีวิทยาลัย จังหวัดเชียงใหม่"/></div>
							<div>ใบสมัครสอบคัดเลือกนักเรียนห้องเรียน วิทยาศาสตร์-คณิตศาสตร์ (สสวท.) </div>
							<div>ระดับชั้น<?php echo $leve_name;?> ปีการศึกษา <?php echo $next_year;?></div>
							<div>โรงเรียนเรยีนาเชลีวิทยาลัย  จังหวัดเชียงใหม่</div>
						</center>
					</td>
				</tr>
			</tbody>
		</table>
	
		<!--<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div align="right"><img class="img-thumbnail" src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" alt="กรอกรูป"  style="width: 2.50cm; height: 3.25cm; text-align: right;"/></div>
					</td>
				</tr>
			</tbody>
		</table>-->
	
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			  <tbody>
				<tr>
				  <td>
					<div>ข้าพเจ้า<input type="text" size="102" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mynameTh;?>" readonly="readonly" required="required"></div>
					<div>เลขประจำตัวนักเรียน<input type="text" size="30" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $regina_stu_datarow["rsd_studentid"];?>" readonly="readonly" required="required">เลขประจำตัวประชาชน<input type="text" size="36" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $regina_stu_datarow['rsd_Identification'];?>" readonly="readonly" required="required"></div>  
				  </td>
				</tr>
			  </tbody>
		</table>
	
<?php
if($key_key==12){ ?>
		<br>
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<center>
							<div>มีความประสงค์สมัครสอบคัดเลือกห้องเรียน วิทยาศาสตร์-คณิตศาสตร์ (สสวท.) ระดับชั้นมัธยมศึกษาปีที่ 1  ปีการศึกษา<?php echo $next_year;?></div>
							<div>และจะปฏิบัติตามระเบียบและข้อปฎบัติในการสอบทุกประการ</div>
						</center>
					</td>
				</tr>
			</tbody>
		</table>
		
		<!--<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td colspan="3">
						<div><b><u><center>กำหนดการรับสมัคร</center></u></b></div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 20%;"><div><center>วัน/เดือน/ปี</center></div></td>
					<td style="width: 60%;"><div><center>รายการ</center></div></td>
					<td style="width: 20%;"><div><center>สถานที่</center></div></td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>20 ส.ค. - 3 ก.ย. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>สมัครสอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>26 พ.ย. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>ตรวจสอบรายชื่อ เลขที่นั่งสอบ และสถานที่สอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>27 พ.ย. 2564</div>
						<div>เวลา 13.00 - 16.00 น.</div>
					</td>
					<td style="width: 60%;">
						<div>สอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
						<div><u>เนื้อหาที่สอบ</u>&nbsp;ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
						<div>ระดับชั้นประถมศึกษาปีที่ 4-5 และประถมศึกษาปีที่ 6 (เฉพาะภาคเรียนที่ 1)</div>
					</td>
					<td style="width: 20%;">
						<div>ตามประกาศ</div>
					</td>
				</tr>	
				<tr>
					<td style="width: 20%;">
						<div>1 ธ.ค. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>ประกาศผลสอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>				
				<tr>
					<td style="width: 20%;">
						<div><b><u>เนื้อหาที่สอบ</u></b></div>
					</td>
					<td style="width: 60%;">
						<div>ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
						<div>ระดับชั้นประถมศึกษาปีที่ 4-5 และประถมศึกษาปีที่ 6 (เฉพาะภาคเรียนที่ 1)</div>
					</td>
					<td style="width: 20%;">
						<div></div>
					</td>
				</tr>				
			</tbody>
		</table>-->				

<?php }else{ ?>
		<br>
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<center>
							<div>มีความประสงค์สมัครสอบคัดเลือกห้องเรียน วิทยาศาสตร์-คณิตศาสตร์ (สสวท.) ระดับชั้นมัธยมศึกษาปีที่ 4  ปีการศึกษา <?php echo $next_year;?></div>
							<div>และจะปฏิบัติตามระเบียบและข้อปฎบัติในการสอบทุกประการ</div>
						</center>
					</td>
				</tr>
			</tbody>
		</table>
		
		<!--<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td colspan="3">
						<div><b><u><center>กำหนดการรับสมัคร</center></u></b></div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 20%;"><div><center>วัน/เดือน/ปี</center></div></td>
					<td style="width: 60%;"><div><center>รายการ</center></div></td>
					<td style="width: 20%;"><div><center>สถานที่</center></div></td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>20 ส.ค. - 3 ก.ย. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>สมัครสอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>26 พ.ย. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>ตรวจสอบรายชื่อ เลขที่นั่งสอบ และสถานที่สอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>27 พ.ย. 2564</div>
						<div>เวลา 13.00 - 16.00 น.</div>
					</td>
					<td style="width: 60%;">
						<div>สอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
						<div><u>เนื้อหาที่สอบ</u>&nbsp;ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
						<div>ระดับชั้นมัธยมศึกษาปีที่ 4-5 และมัธยมศึกษาปีที่ 6 (เฉพาะภาคเรียนที่ 1)</div>
					</td>
					<td style="width: 20%;">
						<div>ตามประกาศ</div>
					</td>
				</tr>	
				<tr>
					<td style="width: 20%;">
						<div>1 ธ.ค. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>ประกาศผลสอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>				
				<tr>
					<td style="width: 20%;">
						<div><b><u>เนื้อหาที่สอบ</u></b></div>
					</td>
					<td style="width: 60%;">
						<div>ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
						<div>ระดับชั้นมัธยมศึกษาปีที่ 1-3 (เฉพาะภาคเรียนที่ 1)</div>
					</td>
					<td style="width: 20%;">
						<div></div>
					</td>
				</tr>				
			</tbody>
		</table>-->	
<?php }      ?>	
	
	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td><center><div>ข้าพเจ้าขอรับรองว่า ข้อความดังกล่าวทั้งหมดในใบสมัครนี้เป็นจริงทุกประการ และจะนำใบสมัครมาแสดงต่อเจ้าหน้าที่ในวันสอบ</div></td>
			</tr>
		</tbody>
	</table>
	<br>
	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
	  <tbody>
		<tr>
		  <td>
			<center>
				<div>ลงชื่อ<input type="text" size="30" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="<?php //echo $mynameTh;?>" readonly="readonly" required="required"></div>
				<div>วันที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="<?php //echo datethai($date_time);?>" readonly="readonly" required="required"></div>
				<div>ผู้สมัคร</div>
			</center>
		  </td>
		  <td>
			<center>
			<div>ลงชื่อ................................................</div>
			<div>(.....................................................)</div>
			<div>เจ้าหน้าที่รับสมัคร</div></center>		
		  </td>
		</tr>
	  </tbody>
	</table>


	
	</section>		
<?php	}else{
	
			$ShowDeleteTheTest=new ShowDeleteTheTest($stuID,$next_year,$leve_ID,$key_key,"Eackspace");
	
		}?>	

	
	
<?php
	include("view/function/pay.php");
	include("view/function/pay_scb.php");
	
	include("view/database/database_paynew.php");
	include("view/database/class_pay.php");
	
?>
	<section class="sheet padding-10mm imgA">	
	

	    <table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td>
                        <div>
                            <center><div><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 65px; height: 63px;" alt="โรงเรียนเรยีนาเชลีวิทยาลัย จังหวัดเชียงใหม่"/></div></center>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <th>
                        <div align="center">รายการค่ามอบตัวรอบโควตานักเรียนโรงเรียนเรยีนาเชลีวิทยาลัย ปีการศึกษา <?php echo $next_year;?></div>
                        <div>ชื่อ - สกุล<input type="text" size="50" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mynameTh;?>" readonly="readonly" required="required">&nbsp;เลขประจำตัวผู้มอบตัวรอบโควตา<input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stuID;?>" readonly="readonly" required="required"></div>
                    </th>                  
                </tr>
            </tbody>
        </table>


        
        <table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <th style="width: 10%;"><div align="center">ลำดับ</div></th>
                    <th style="width: 70%;"><div align="center">รายการ</div></th>
                    <th style="width: 20%;"><div align="center">ราคา</div></th>
                </tr>
                <tr>
                    
                        <td style="width: 10%;">
						
			<?php
				$RunQuotaCapitalA=new Run_quota_capital($stuID,$qr_year,$qr_level);
					if($RunQuotaCapitalA->Print_quota_capital_key()=="1"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$countA=0;
					$datapayASql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
								  from `surrender_fee` 
								  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
								  where `surrender_fee`.`sf_year`='{$qr_year}' 
								  and `surrender_fee`.`sf_class`='{$qr_level}' 
								  and `surrender_fee`.`sf_plan`='{$qr_plan}' 
								  and `surrender_fee_list`.`sft_key`='A003' 
								  and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
					$datapayA=new row_quotaarray($datapayASql);
					foreach($datapayA->print_quotaarray() as $rc=>$datapayARow){
						$countA=$countA+1;?>
						<?php
								if($datapayARow["sfl_price"]=="0.00"){ ?>
								
						<?php   }else{ ?>
						
								<div align="center"><?php echo $countA;?></div>
								
						<?php   }?>                       
						
								
				<?php    } ?>					
					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}elseif($RunQuotaCapitalA->Print_quota_capital_key()=="2"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$countA=0;
					$datapayASql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
								  from `surrender_fee` 
								  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
								  where `surrender_fee`.`sf_year`='{$qr_year}' 
								  and `surrender_fee`.`sf_class`='{$qr_level}' 
								  and `surrender_fee`.`sf_plan`='{$qr_plan}' 
								  and `surrender_fee_list`.`sft_key`='A004'
								  and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
					$datapayA=new row_quotaarray($datapayASql);
					foreach($datapayA->print_quotaarray() as $rc=>$datapayARow){
						$countA=$countA+1;?>
						
						<?php
								if($datapayARow["sfl_price"]=="0.00"){ ?>
								
						<?php   }else{ ?>
						
								<div align="center"><?php echo $countA;?></div>
								
						<?php   }?>                       
						
								
				<?php    } ?>					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$TestPayGroupA=new TestPayGroup($stuID,$txt_year);
						if($TestPayGroupA->RunTestPayGroupStu()==null or $TestPayGroupA->RunTestPayGroupStu()==0 or $TestPayGroupA->RunTestPayGroupStu()=="-"){ ?> 
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
							<?php
								$countA=0;
								$datapayASql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
											  from `surrender_fee` 
											  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
											  where `surrender_fee`.`sf_year`='{$qr_year}' 
											  and `surrender_fee`.`sf_class`='{$qr_level}' 
											  and `surrender_fee`.`sf_plan`='{$qr_plan}'
											  and `surrender_fee_list`.`sft_key`='A001'
											  and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
								$datapayA=new row_quotaarray($datapayASql);
								foreach($datapayA->print_quotaarray() as $rc=>$datapayARow){
									$countA=$countA+1;?>
									
									<?php
											if($datapayARow["sfl_price"]=="0.00"){ ?>
											
									<?php   }else{ ?>
									
											<div align="center"><?php echo $countA;?></div>
											
									<?php   }?>  
									
							<?php    } ?>						
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
				<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
							<?php
								$countA=0;
								$datapayASql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
											  from `surrender_fee` 
											  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
											  where `surrender_fee`.`sf_year`='{$qr_year}' 
											  and `surrender_fee`.`sf_class`='{$qr_level}' 
											  and `surrender_fee`.`sf_plan`='{$qr_plan}'
											  and `surrender_fee_list`.`sft_key`='A002'
											  and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
								$datapayA=new row_quotaarray($datapayASql);
								foreach($datapayA->print_quotaarray() as $rc=>$datapayARow){
									$countA=$countA+1;?>
									
									<?php
											if($datapayARow["sfl_price"]=="0.00"){ ?>
											
									<?php   }else{ ?>
									
											<div align="center"><?php echo $countA;?></div>
											
									<?php   }?>  
									
							<?php    } ?>						
					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
				<?php   }?>				

				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}?>			
						
						
                        
            
                        
                        
                        </td>
                        <td style="width: 70%;">
                      
			<?php
				$RunQuotaCapitalB=new Run_quota_capital($stuID,$qr_year,$qr_level);
					if($RunQuotaCapitalB->Print_quota_capital_key()=="1"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$datapayBSql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
								  from `surrender_fee` 
								  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
								  where `surrender_fee`.`sf_year`='{$qr_year}' 
								  and `surrender_fee`.`sf_class`='{$qr_level}' 
								  and `surrender_fee_list`.`sft_key`='A003'
								  and `surrender_fee`.`sf_plan`='{$qr_plan}' and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
					$datapayB=new row_quotaarray($datapayBSql);
					foreach($datapayB->print_quotaarray() as $rc=>$datapayBRow){ ?>
						<?php
								if($datapayBRow["sfl_price"]=="0.00"){ ?>
								
						<?php   }else{ ?>
								<div>&nbsp;<?php echo $datapayBRow["sfl_txt"];?></div>
						<?php   }?>        
								
								
				<?php    } ?>					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}elseif($RunQuotaCapitalB->Print_quota_capital_key()=="2"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$datapayBSql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
								  from `surrender_fee` 
								  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
								  where `surrender_fee`.`sf_year`='{$qr_year}' 
								  and `surrender_fee`.`sf_class`='{$qr_level}' 
								  and `surrender_fee_list`.`sft_key`='A004'
								  and `surrender_fee`.`sf_plan`='{$qr_plan}' and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
					$datapayB=new row_quotaarray($datapayBSql);
					foreach($datapayB->print_quotaarray() as $rc=>$datapayBRow){ ?>
						<?php
								if($datapayBRow["sfl_price"]=="0.00"){ ?>
								
						<?php   }else{ ?>
								<div>&nbsp;<?php echo $datapayBRow["sfl_txt"];?></div>
						<?php   }?>        
								
								
				<?php    } ?>					
					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$TestPayGroupB=new TestPayGroup($stuID,$txt_year);
						if($TestPayGroupB->RunTestPayGroupStu()==null or $TestPayGroupB->RunTestPayGroupStu()==0 or $TestPayGroupB->RunTestPayGroupStu()=="-"){ ?> 
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
							<?php
								$datapayBSql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
											  from `surrender_fee` 
											  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
											  where `surrender_fee`.`sf_year`='{$qr_year}' 
											  and `surrender_fee`.`sf_class`='{$qr_level}' 
											  and `surrender_fee_list`.`sft_key`='A001'
											  and `surrender_fee`.`sf_plan`='{$qr_plan}' and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
								$datapayB=new row_quotaarray($datapayBSql);
								foreach($datapayB->print_quotaarray() as $rc=>$datapayBRow){ ?>
									<?php
											if($datapayBRow["sfl_price"]=="0.00"){ ?>
											
									<?php   }else{ ?>
											<div>&nbsp;<?php echo $datapayBRow["sfl_txt"];?></div>
									<?php   }?>        
											
											
							<?php    } ?>							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
				<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
							<?php
								$datapayBSql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
											  from `surrender_fee` 
											  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
											  where `surrender_fee`.`sf_year`='{$qr_year}' 
											  and `surrender_fee`.`sf_class`='{$qr_level}' 
											  and `surrender_fee_list`.`sft_key`='A002'
											  and `surrender_fee`.`sf_plan`='{$qr_plan}' and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
								$datapayB=new row_quotaarray($datapayBSql);
								foreach($datapayB->print_quotaarray() as $rc=>$datapayBRow){ ?>
									<?php
											if($datapayBRow["sfl_price"]=="0.00"){ ?>
											
									<?php   }else{ ?>
											<div>&nbsp;<?php echo $datapayBRow["sfl_txt"];?></div>
									<?php   }?>        
											
											
							<?php    } ?>					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
				<?php   }?>


				
					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}?>
					  
            
                        
                        </td>
                        <td style="width: 20%;">
						
			<?php
				$RunQuotaCapitalC=new Run_quota_capital($stuID,$qr_year,$qr_level);
					if($RunQuotaCapitalC->Print_quota_capital_key()=="1"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$sumpay=0;
					$datapayCSql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
								  from `surrender_fee` 
								  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
								  where `surrender_fee`.`sf_year`='{$qr_year}' 
								  and `surrender_fee`.`sf_class`='{$qr_level}' 
								  and `surrender_fee`.`sf_plan`='{$qr_plan}' 
								  and `surrender_fee_list`.`sft_key`='A003'
								  and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
					$datapayC=new row_quotaarray($datapayCSql);
					foreach($datapayC->print_quotaarray() as $rc=>$datapayCRow){ 
						$sumpay=$sumpay+$datapayCRow["sfl_price"];
					?>
					
						<?php
								if($datapayBRow["sfl_price"]=="0.00"){ ?>
								
						<?php   }else{ ?>
								<div align="right"><?php echo number_format($datapayCRow["sfl_price"], 2, '.', ',');?>&nbsp;&nbsp;&nbsp;</div>                            
						<?php   }?>                               
									   
				<?php    } ?>					
				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
			<?php	}elseif($RunQuotaCapitalC->Print_quota_capital_key()=="2"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$sumpay=0;
					$datapayCSql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
								  from `surrender_fee` 
								  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
								  where `surrender_fee`.`sf_year`='{$qr_year}' 
								  and `surrender_fee`.`sf_class`='{$qr_level}' 
								  and `surrender_fee`.`sf_plan`='{$qr_plan}' 
								  and `surrender_fee_list`.`sft_key`='A004'
								  and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
					$datapayC=new row_quotaarray($datapayCSql);
					foreach($datapayC->print_quotaarray() as $rc=>$datapayCRow){ 
						$sumpay=$sumpay+$datapayCRow["sfl_price"];
					?>
					
						<?php
								if($datapayBRow["sfl_price"]=="0.00"){ ?>
								
						<?php   }else{ ?>
								<div align="right"><?php echo number_format($datapayCRow["sfl_price"], 2, '.', ',');?>&nbsp;&nbsp;&nbsp;</div>                            
						<?php   }?>                               
									   
				<?php    } ?>					
				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				
				<?php
					$TestPayGroupC=new TestPayGroup($stuID,$txt_year);
						if($TestPayGroupC->RunTestPayGroupStu()==null or $TestPayGroupC->RunTestPayGroupStu()==0 or $TestPayGroupC->RunTestPayGroupStu()=="-"){ ?> 
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
							<?php
								$sumpay=0;
								$datapayCSql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
											  from `surrender_fee` 
											  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
											  where `surrender_fee`.`sf_year`='{$qr_year}' 
											  and `surrender_fee`.`sf_class`='{$qr_level}' 
											  and `surrender_fee`.`sf_plan`='{$qr_plan}' 
											   and `surrender_fee_list`.`sft_key`='A001'
											  and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
								$datapayC=new row_quotaarray($datapayCSql);
								foreach($datapayC->print_quotaarray() as $rc=>$datapayCRow){ 
									$sumpay=$sumpay+$datapayCRow["sfl_price"];
								?>
								
									<?php
											if($datapayBRow["sfl_price"]=="0.00"){ ?>
											
									<?php   }else{ ?>
											<div align="right"><?php echo number_format($datapayCRow["sfl_price"], 2, '.', ',');?>&nbsp;&nbsp;&nbsp;</div>                            
									<?php   }?>    
					   
							<?php    } ?>						
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
				<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
							<?php
								$sumpay=0;
								$datapayCSql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
											  from `surrender_fee` 
											  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
											  where `surrender_fee`.`sf_year`='{$qr_year}' 
											  and `surrender_fee`.`sf_class`='{$qr_level}' 
											  and `surrender_fee`.`sf_plan`='{$qr_plan}' 
											   and `surrender_fee_list`.`sft_key`='A002'
											  and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
								$datapayC=new row_quotaarray($datapayCSql);
								foreach($datapayC->print_quotaarray() as $rc=>$datapayCRow){ 
									$sumpay=$sumpay+$datapayCRow["sfl_price"];
								?>
								
									<?php
											if($datapayBRow["sfl_price"]=="0.00"){ ?>
											
									<?php   }else{ ?>
											<div align="right"><?php echo number_format($datapayCRow["sfl_price"], 2, '.', ',');?>&nbsp;&nbsp;&nbsp;</div>                            
									<?php   }?>    
					   
							<?php    } ?>						
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
				<?php   }?>
				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>						
						
                        
                        </td>
                    
                </tr> 
                 
                <tr>
                    <td></td>
                    <td>
						<?php $bathformat=new bathformat(number_format($sumpay, 2, '.', ','));?>
                        <div><center><?php echo $bathformat->run_pay();?> </center></div>
                    </td>
                    <td>
                        <div align="right"><?php echo number_format($sumpay, 2, '.', ',');?>&nbsp;&nbsp;&nbsp;</div>
                    </td>
                </tr>
                
            </tbody>
        </table>
<?php
	//$class=$qr_year;
	//$class_ex=$data_stu->Sort_name_E2;
	$txt_billerId="099400043439110";
	$txt_ref1=strtoupper($stuID."Y".$qr_year);
	$txt_ref2=strtoupper("QUOTARC".$qr_year."C".$qr_level."P".$qr_plan);
	$txt_amount=number_format($sumpay, 2, '.', '');                                                   
	$txt_width="150";
	$payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
?>


        <table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td style="width: 20%;">
						<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="150" height="150"></div>
						<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
						<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
						<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
						<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($sumpay, 2, '.', ',');?></div>   
                    </td> 
					<td style="width: 80%;">
					    <div>&nbsp;&nbsp;&nbsp;&nbsp;<b>วิธีการชำระ</b></div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;1&nbsp;.&nbsp;ทำการสแกน QR Code ที่ปรากฏในเพจนี้ ด้วยแอปพลิเคชัน Mobile Banking ของท่าน</div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;2&nbsp;.&nbsp;ตรวจสอบข้อมูลที่ปรากฏใน Mobile Banking ให้ถูกต้องก่อนชำระเงิน</div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบเลขประจำตัวผู้สมัครให้ถูกต้อง</div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบจำนวนเงินให้ถูกต้อง</div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบชื่อผู้รับเงินต้องเป็นโรงเรียนเรยีนาเชลีวิทยาลัย หรือ REGINA COELI COLLEGE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SCHOOL เท่านั้น</div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;3&nbsp;.&nbsp;สำหรับหลักฐานการชำระเงินให้ท่านเก็บไว้เป็นหลักฐาน</div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;4&nbsp;.&nbsp;ทางโรงเรียนจะทำการตรวจสอบรายการและยืนยันการชำระเงินของท่าน </div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;5&nbsp;.&nbsp;การชำระเงินจะเสร็จสมบูรณ์ เมื่อทางโรงเรียนได้ตรวจสอบการชำระเงินของท่านเรียบร้อยแล้ว</div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;6&nbsp;.&nbsp;หากต้องการใบเสร็จรับเงิน ติดต่อขอรับได้ที่ห้องการเงินของโรงเรียน</div>
					</td>
                <tr>
            <tbody>
        </table>

	</section>					
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
		<title>พิมพ์&nbsp;ใบมอบตัวนักเรียนรอบโควตานักเรียนโรงเรียนเรยีนาเชลีวิทยาลัย</title>

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
										<div><button type="button"  style="font-size: 18px;" class="btn btn-default" onclick="window.print()"><b>พิมพ์&nbsp;ใบมอบตัวนักเรียนรอบโควตานักเรียนโรงเรียนเรยีนาเชลีวิทยาลัย</b></button></div>
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
		include("view/database/pdo_data.php");
		include("view/database/pdo_quota.php");	
		include("view/database/pdo_conndatastu.php");

		include("view/database/class_pdodatastu.php");	
		include("view/database/class_quota.php");
		error_reporting(error_reporting() & ~E_NOTICE); 
		$txt_year=$RcYear;
		$next_year=$RcYear+1;
		$date_time=date("Y-m-d H:i:s");
		//ระดับชั้น
		/*$call_stu=new stu_levelpdo($stuID,$txt_year,"1");
			switch ($call_stu->IDLevel){
					case "23":
						$leve_name="มัธยมศึกษาปีที่ 1";
						$leve_ID="31";
					break;
					
					case "33":
						$leve_name="มัธยมศึกษาปีที่ 4";
						$leve_ID="41";
					break;
						$leve_name="";
						$leve_ID="";
					default:
						
			}*/

	//ระดับชั้น
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
		$qce_key=filter_input(INPUT_POST,'qce_key');
		$qr_plan=filter_input(INPUT_POST,'qr_plan');
		$stuID=filter_input(INPUT_POST,'request_stuid');
		/*$qce_key="ON";
		$qr_plan="12";
		$stuID="16839";*/
	//ระดับชั้น
		$call_stu=new stu_levelpdo($stuID,$txt_year,"1");
		if($call_stu->IDLevel==null or $call_stu->IDLevel=="0"){
			$call_stu=new stu_levelpdo($stuID,$txt_year,"2");		
		}else{
			//************************************************
		}
			switch ($call_stu->IDLevel){
				case "3" :
					$leve_name="ประถมศึกษาปีที่ 1";
					$leve_ID="11";	
				break;					
				case "23":
					$leve_name="มัธยมศึกษาปีที่ 1";
					$leve_ID="31";
				break;
				case "33":
					$leve_name="มัธยมศึกษาปีที่ 4";
					$leve_ID="41";
				break;
					$leve_name="-";
					$leve_ID="-";
				default:	
			}
			
			if(($qr_plan==0)){
				$leve_name="อนุบาล 3";
				$leve_ID="3";
			}else{}
			
			
	//ระดับชั้น	

		if($qce_key==null or $qce_key=="-"){
			$key_key="-";
		}elseif($qce_key=="NO"){
			$key_key="-";
		}else{
			$key_key=$qce_key;
		}

		
	
		$count_quota_requesSql="SELECT count(`request_stuid`) as `count_rs` 
								FROM `quota_request` 
								WHERE `request_stuid`='{$stuID}' 
								and `request_year`='{$next_year}'
								and `request_level`='{$leve_ID}'";
		$count_quota_reques=new row_quotanotarray($count_quota_requesSql);
		foreach($count_quota_reques->print_quotanotarray() as $quot_key=>$count_quota_requesRow){
			$count_rs=$count_quota_requesRow["count_rs"];
			if($count_rs>=1){
				$up_quota_requesSql="UPDATE `quota_request` SET `qr_stuid`='{$qr_plan}',`qce_key`='{$key_key}' 
									WHERE `request_stuid`='{$stuID}' and `request_year`='{$next_year}' and `request_level`='{$leve_ID}'";
				$up_quota_reques=new insert_quota($up_quota_requesSql);
				if($up_quota_reques->print_insertQuota()=="yes"){
					//*************************************************
				}else{
					//*************************************************				
				}
			}else{
				$in_quota_requesSql="INSERT INTO `quota_request` (`request_stuid`, `request_year`, `request_level`, `requset_datetime`, `qr_stuid`, `qce_key`)
									 VALUES ('{$stuID}', '{$next_year}', '{$leve_ID}', '{$date_time}', '{$qr_plan}', '{$key_key}');";
				$in_quota_reques=new insert_quota($in_quota_requesSql);
				if($in_quota_reques->print_insertQuota()=="yes"){
					//*************************************************				
				}else{
					//*************************************************				
				}
			}
		}
	//--------------------------------------------------------
		//$next_year=2564;
		//$txt_year=2563;
		//$stuID="16616";



		$regina_stu_dataSql="SELECT * FROM `regina_stu_data` WHERE `rsd_studentid`='{$stuID}'";
		$regina_stu_data=new notrow_evaluation($regina_stu_dataSql);
		foreach($regina_stu_data->evaluation_array as $rc_key=>$regina_stu_datarow){}
	//home
		switch($regina_stu_datarow["rse_home"]){
			case "1":
				$txt_home="ฟ้า";
			break;
			
			case "2":
				$txt_home="แดง";
			break;	
			
			case "3":
				$txt_home="เหลือง";
			break;	
			
			case "4":
				$txt_home="เขียว";
			break;	
			
			default:
				$txt_home=".........................";
		}

	//home end





	?>


	<section class="sheet padding-10mm imgA">
	
		<table style="width: 100%; vertical-align: top;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 20%; font-size: 28px; text-align: center; font-family: THSarabunNew; font-weight: bold;">
						<div><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 75px; height: 73px;" alt=""/></div>
						<div>&nbsp;</div>
						<div>
							<table style="width: 100%; font-size: 20px; text-align: left; font-family: THSarabunNew; font-weight: bold; vertical-align: top;" border="1" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td>
											<div>&nbsp;เลขประจำตัว<input type="text" size="4" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $regina_stu_datarow["rsd_studentid"];?>" readonly="readonly" required="required"/></div>
											<div>&nbsp;สีบ้าน<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $txt_home;?>" readonly="readonly" required="required"/></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
					<td style="width: 60%; font-size: 25px; text-align: center; font-family: THSarabunNew; font-weight: bold;">
						<div>ใบมอบตัวนักเรียน&nbsp;ชั้น<?php echo $leve_name;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $next_year;?></b></div>  
						<div>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;จังหวัดเชียงใหม่</div>  
						
		<?php
				if(($qr_plan==0)){ ?>
						<div>รอบทั่วไป</div>				
		<?php	}else{ ?>				
						<div>รอบโควตาภายใน</div>							
		<?php   } ?>
						
						<div>
							<?php
									$quota_rightSql="SELECT `qr_stuid`, `qr_year`, `qr_level`, `qr_plan` 
									 FROM `quota_right` 
									 WHERE `qr_stuid`='{$stuID}' 
									 and `qr_year`='{$next_year}' 
									 and `qr_level`='{$leve_ID}'";
									$quota_right=new row_quotanotarray($quota_rightSql);
									foreach($quota_right->print_quotanotarray() as $rc_quota=>$quota_rightRow){
										$qr_stuid=$quota_rightRow["qr_stuid"];
										$qr_year=$quota_rightRow["qr_year"];
										$qr_level=$quota_rightRow["qr_level"];
										$qr_plan=$quota_rightRow["qr_plan"];
										if($qr_stuid!=""){ 
											$call_quota=new print_plan($qr_plan); ?>
							<center>
							<table  border="1" cellpadding="0" cellspacing="0" aligh="center" style="width: 95%; font-size: 20px; text-align: center; font-family: THSarabunNew; font-weight: bold; vertical-align: top;">
								 <tbody>
									<tr>
										<?php
											if($leve_ID=="31"){  ?>
													<td><center><div><font color="#F50206"><b>ได้รับสิทธิ์โควตา ห้องเรียน <?php echo $call_quota->plan_LName;?></b></font></div></center></td>						
									<?php	}else{ ?>
													<td><center><div><font color="#F50206"><b>ได้รับสิทธิ์โควตา แผนการเรียน <?php echo $call_quota->plan_LName;?></b></font></div></center></td>						
									<?php	}  ?>
									</tr>
								</tbody>
							</table>
							</center>
						   <?php 		}else{
											//---------------------------------------------------------------------
										}
									}
							?>
						</div>
						
					</td>
					<td style="width: 20%; font-size: 28px; text-align: center; font-family: THSarabunNew; font-weight: bold;">
						<div><img class="img-thumbnail" src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 2.50cm; height: 3.25cm;" alt="กรอกรูป"/></div>
					</td>
				
													
				</tr>
			</tbody>
		</table>

<?php
//*************************************************************************************************	
	$stu_motherSql="SELECT * FROM `stu_mother` WHERE`stu_id`='{$stuID}';";
	$stu_mother=new notrow_datastu($stu_motherSql);
	foreach($stu_mother->datastu_array as $rc_key=>$stu_motherRow){}



	$stu_mother_addressSql="SELECT * FROM `stu_mother_address` WHERE `stu_id`='{$stuID}'";
	$stu_mother_address=new notrow_datastu($stu_mother_addressSql);
	foreach($stu_mother_address->datastu_array as $rc_key=>$stu_mother_addressRow){
//---------------------------------------------------------------------------------------------		
		if(isset($stu_mother_addressRow["mother_hno"])){
			$mother_hno=$stu_mother_addressRow["mother_hno"];
		}else{
			$mother_hno="-";
		}
//---------------------------------------------------------------------------------------------		
		if(isset($stu_mother_addressRow['mother_moo'])){
			$mother_moo=$stu_mother_addressRow['mother_moo'];
		}else{
			$mother_moo="-";
		}
//---------------------------------------------------------------------------------------------
		if(isset($stu_mother_addressRow["mother_road"])){
			$mother_road=$stu_mother_addressRow["mother_road"];
		}else{
			$mother_road="-";
		}
//---------------------------------------------------------------------------------------------
		if(isset($stu_mother_addressRow['mother_soi'])){
			$mother_soi=$stu_mother_addressRow['mother_soi'];
		}else{
			$mother_soi="-";
		}
//---------------------------------------------------------------------------------------------
		if(isset($stu_mother_addressRow['mother_zipcode'])){
			$mother_zipcode=$stu_mother_addressRow['mother_zipcode'];
		}else{
			$mother_zipcode="-";
		}		
//---------------------------------------------------------------------------------------------		
	}	
	
	

	$stu_mother_addwordSql="SELECT * FROM `stu_mother_addword` WHERE `stu_id`='{$stuID}';";
	$stu_mother_addword=new notrow_datastu($stu_mother_addwordSql);
	foreach($stu_mother_addword->datastu_array as $rc_key=>$stu_mother_addwordRow){}	
	
	$mother_wordprovince=new data_Province($stu_mother_addwordRow["mother_wordprovince"]);
	
	$m_np=new stu_prefix($stu_motherRow["mother_prefix"]);
	$myname_m=$m_np->prefix_prefixname." ".$stu_motherRow["mother_fname"]." ".$stu_motherRow["mother_sname"];
	
	$mother_tumbon=new data_Subdistrict($stu_mother_addressRow["mother_tumbon"]);//ตำบล
	$mother_amphur=new data_District($stu_mother_addressRow["mother_amphur"]);///อำเภอ
	$mother_province=new data_Province($stu_mother_addressRow["mother_province"]);///จังหวัด
	
	$data_McareerSql="SELECT `dc_key`, `dc_txt2` FROM `data_career` WHERE `dc_key`='{$stu_motherRow["mother_career"]}'";
	$data_McareerRs=new notrow_datastu($data_McareerSql);
	foreach($data_McareerRs->datastu_array as $rc_key=>$data_McareerRow){
		$Mcareer=$data_McareerRow["dc_txt2"];
	}
	
//*************************************************************************************************	
	$stu_fatherSql="SELECT * FROM `stu_father` WHERE `stu_id`='{$stuID}'";
	$stu_father=new notrow_datastu($stu_fatherSql);
	foreach($stu_father->datastu_array as $rc_key=>$stu_fatherRow){}
	
	$stu_father_addwordSql="SELECT * FROM `stu_father_addword` WHERE `stu_id`='{$stuID}'";
	$stu_father_addword=new notrow_datastu($stu_father_addwordSql);
	foreach($stu_father_addword->datastu_array as $rc_key=>$stu_father_addwordRow){}
	
	
	
	$father_addwordprovince=new data_Province($stu_father_addwordRow["father_addwordprovince"]);

	
	$stu_father_addressSql="SELECT * FROM `stu_father_address` WHERE `stu_id`='{$stuID}';";
	$stu_father_address=new notrow_datastu($stu_father_addressSql);
	foreach($stu_father_address->datastu_array as $rc_key=>$stu_father_addressRow){
//---------------------------------------------------------------------------------------------		
		if(isset($stu_father_addressRow["father_hno"])){
			$father_hno=$stu_father_addressRow["father_hno"];
		}else{
			$father_hno="-";
		}
//---------------------------------------------------------------------------------------------		
		if(isset($stu_father_addressRow['father_moo'])){
			$father_moo=$stu_father_addressRow['father_moo'];
		}else{
			$father_moo="-";
		}
//---------------------------------------------------------------------------------------------		
		if(isset($stu_father_addressRow["father_road"])){
			$father_road=$stu_father_addressRow["father_road"];
		}else{
			$father_road="-";
		}
//---------------------------------------------------------------------------------------------		
		if(isset($stu_father_addressRow['father_soi'])){
			$father_soi=$stu_father_addressRow['father_soi'];
		}else{
			$father_soi="-";
		}
//---------------------------------------------------------------------------------------------		
		if(isset($stu_father_addressRow['father_zipcode'])){
			$father_zipcode=$stu_father_addressRow['father_zipcode'];
		}else{
			$father_zipcode="-";
		}
//---------------------------------------------------------------------------------------------	
	}
	
	$f_np=new stu_prefix($stu_fatherRow["father_prefix"]);
	$myname_f=$f_np->prefix_prefixname."&nbsp;".$stu_fatherRow["father_fname"]."&nbsp;".$stu_fatherRow["father_sname"];
	
	$father_tumbon=new data_Subdistrict($stu_father_addressRow["father_tumbon"]); // ตำบล
	$father_amphur=new data_District($stu_father_addressRow["father_amphur"]); //อำเภอ
	$father_province=new data_Province($stu_father_addressRow["father_province"]); //จังหวัด	
	
	$data_FcareerSql="SELECT `dc_key`, `dc_txt2` FROM `data_career` WHERE `dc_key`='{$stu_fatherRow["father_career"]}'";
	$data_FcareerRs=new notrow_datastu($data_FcareerSql);
	foreach($data_FcareerRs->datastu_array as $rc_key=>$data_FcareerRow){
		if(isset($data_FcareerRow["dc_txt2"])){
			$Fcareer=$data_FcareerRow["dc_txt2"];
		}else{
			$Fcareer="-";
		}
		
	}
	
	
	
//*************************************************************************************************	

	$stu_guardianSql="SELECT * FROM `stu_guardian` WHERE `stu_id`='{$stuID}';";
	$stu_guardian=new notrow_datastu($stu_guardianSql);
	foreach($stu_guardian->datastu_array as $rc_key=>$stu_guardianRow){}
	
	$stu_guardian_addressSql="SELECT * FROM `stu_guardian_address` WHERE `stu_id`='{$stuID}'";
	$stu_guardian_address=new notrow_datastu($stu_guardian_addressSql);
	foreach($stu_guardian_address->datastu_array as $rc_key=>$stu_guardian_addressRow){}
	
	$stu_guardian_addwordSql="SELECT * FROM `stu_guardian_addword` WHERE `stu_id`='{$stuID}'";
	$stu_guardian_addword=new notrow_datastu($stu_guardian_addwordSql);
	foreach($stu_guardian_addword->datastu_array as $rc_key=>$stu_guardian_addwordRow){}
	
	$print_parent_status=new data_rely ($stu_guardianRow["parent_status"]);
	
	$g_np=new stu_prefix($stu_guardianRow["parent_prefix"]);
		if(isset($g_np->prefix_prefixname)){
			$myname_g=$g_np->prefix_prefixname."&nbsp;".$stu_guardianRow["parent_fname"]."&nbsp;".$stu_guardianRow["parent_sname"];
		}else{
			$myname_g=$stu_guardianRow["parent_fname"]."&nbsp;".$stu_guardianRow["parent_sname"];
		}
	
	$parent_tumbon=new data_Subdistrict($stu_guardian_addressRow["parent_tumbon"]);
	$parent_amphur=new data_District($stu_guardian_addressRow["parent_amphur"]);
	$parent_province=new data_Province($stu_guardian_addressRow["parent_province"]);
	
	/*$parent_tumbon=new data_Subdistrict($stu_guardian_addressRow["parent_tumbon"]);// ตำบล
	$parent_amphur=new data_District($stu_guardian_addressRow["parent_amphur"]);//อำเภอ
	$parent_province=new data_Province($stu_guardian_addressRow["parent_province"]);//จังหวัด*/
//*************************************************************************************************	
	$stu_depend_stuSql="SELECT * FROM `depend_stu` WHERE `ds_stuid`='{$stuID}'";
	$stu_depend_stu=new notrow_datastu($stu_depend_stuSql);
	foreach($stu_depend_stu->datastu_array as $rc_key=>$stu_depend_stuRow){}

	
	
	$ds_dormitoryTumbon=new data_Subdistrict ($stu_depend_stuRow["ds_dormitoryTumbon"]);		
	$ds_dormitoryAmphur=new data_District ($stu_depend_stuRow["ds_dormitoryAmphur"]);
	$ds_dormitoryProvince=new data_Province ($stu_depend_stuRow["ds_dormitoryProvince"]);

//*************************************************************************************************	
	
?>

<?php
	if($stu_guardianRow["parent_status"]==2){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		
	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า(ผู้ปกครอง)<input type="text" size="50" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $myname_f; ?>" readonly="readonly" required="required">เลขบัตรประชาชน<input type="text" size="19" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_fatherRow['father_code'];?>" readonly="readonly" required="required"></div>
					<div>ที่อยู่ปัจจุบัน&nbsp;เลขที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_hno;?>" readonly="readonly" required="required">หมู่ที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_moo;?>" readonly="readonly" required="required">ถนน<input type="text" size="40" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_road;?>" readonly="readonly" required="required">ซอย<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_soi;?>" readonly="readonly" required="required"></div>
					<div>ตำบล<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_tumbon->DISTRICT_NAME; ?>" readonly="readonly" required="required">อำเภอ<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required">จังหวัด<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_province->PROVINCE_NAME; ?>" readonly="readonly" required="required">รหัสไปรษณีย์<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_zipcode;?>" readonly="readonly" required="required"></div>
					<div>โทรศัพท์<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_fatherRow['father_phone'];?>" readonly="readonly" required="required">เกี่ยวข้องกับนักเรียนเป็น<input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $print_parent_status->dr_txt;?>" readonly="readonly" required="required">&nbsp;ขอมอบตัวนักเรียนไว้กับผู้บริหารโรงเรียนเรยีนาเชลีวิทยาลัย</div>
				</td>
			</tr>
		</tbody>
	</table>	
	


<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	}elseif($stu_guardianRow["parent_status"]==3){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า(ผู้ปกครอง)<input type="text" size="50" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $myname_m; ?>" readonly="readonly" required="required">เลขบัตรประชาชน<input type="text" size="19" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_motherRow['mother_code'];?>" readonly="readonly" required="required"></div>
					<div>ที่อยู่ปัจจุบัน&nbsp;เลขที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_hno;?>" readonly="readonly" required="required">หมู่ที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_moo;?>" readonly="readonly" required="required">ถนน<input type="text" size="40" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_road;?>" readonly="readonly" required="required">ซอย<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_soi;?>" readonly="readonly" required="required"></div>
					<div>ตำบล<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_tumbon->DISTRICT_NAME; ?>" readonly="readonly" required="required">อำเภอ<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required">จังหวัด<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_province->PROVINCE_NAME; ?>" readonly="readonly" required="required">รหัสไปรษณีย์<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_zipcode;?>" readonly="readonly" required="required"></div>
					<div>โทรศัพท์<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_motherRow['mother_phone'];?>" readonly="readonly" required="required">เกี่ยวข้องกับนักเรียนเป็น<input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $print_parent_status->dr_txt;?>" readonly="readonly" required="required">&nbsp;ขอมอบตัวนักเรียนไว้กับผู้บริหารโรงเรียนเรยีนาเชลีวิทยาลัย</div>
				</td>
			</tr>
		</tbody>
	</table>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}elseif($stu_guardianRow["parent_status"]==5){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า(ผู้ปกครอง)<input type="text" size="50" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_depend_stuRow["ds_dormitoryMyName"]; ?>" readonly="readonly" required="required">เลขบัตรประชาชน<input type="text" size="19" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;" readonly="readonly" required="required"></div>
					<div>ที่อยู่ปัจจุบัน&nbsp;เลขที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_depend_stuRow['ds_dormitoryHno']; ?>" readonly="readonly" required="required">หมู่ที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_depend_stuRow['ds_dormitoryMoo'];?>" readonly="readonly" required="required">ถนน<input type="text" size="40" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_depend_stuRow["ds_dormitoryRoad"];?>" readonly="readonly" required="required">ซอย<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_depend_stuRow['ds_dormitorySoi']?>" readonly="readonly" required="required"></div>
					<div>ตำบล<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $ds_dormitoryTumbon->DISTRICT_NAME; ?>" readonly="readonly" required="required">อำเภอ<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $ds_dormitoryAmphur->AMPHUR_NAME;?>" readonly="readonly" required="required">จังหวัด<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $ds_dormitoryProvince->PROVINCE_NAME; ?>" readonly="readonly" required="required">รหัสไปรษณีย์<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_depend_stuRow['ds_dormitoryZipcode'];?>" readonly="readonly" required="required"></div>
					<div>โทรศัพท์<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_depend_stuRow['ds_dormitoryPhone'];?>" readonly="readonly" required="required">เกี่ยวข้องกับนักเรียนเป็น<input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $print_parent_status->dr_txt;?>" readonly="readonly" required="required">&nbsp;ขอมอบตัวนักเรียนไว้กับผู้บริหารโรงเรียนเรยีนาเชลีวิทยาลัย</div>
				</td>
			</tr>
		</tbody>
	</table>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า(ผู้ปกครอง)<input type="text" size="50" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $myname_g; ?>" readonly="readonly" required="required">เลขบัตรประชาชน<input type="text" size="19" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_guardianRow ['parent_code'];?>" readonly="readonly" required="required"></div>
					<div>ที่อยู่ปัจจุบัน&nbsp;เลขที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_guardian_addressRow ['parent_hno']; ?>" readonly="readonly" required="required">หมู่ที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_guardian_addressRow['parent_moo'];?>" readonly="readonly" required="required">ถนน<input type="text" size="40" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_guardian_addressRow["parent_road"];?>" readonly="readonly" required="required">ซอย<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_guardian_addressRow['parent_soi'];?>" readonly="readonly" required="required"></div>
					<div>ตำบล<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $parent_tumbon->DISTRICT_NAME; ?>" readonly="readonly" required="required">อำเภอ<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $parent_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required">จังหวัด<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $parent_province->PROVINCE_NAME; ?>" readonly="readonly" required="required">รหัสไปรษณีย์<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_guardian_addressRow['parent_zipcode'];?>" readonly="readonly" required="required"></div>
					<div>โทรศัพท์<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_guardianRow['mother_phone'];?>" readonly="readonly" required="required">เกี่ยวข้องกับนักเรียนเป็น<input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $print_parent_status->dr_txt;?>" readonly="readonly" required="required">&nbsp;ขอมอบตัวนักเรียนไว้กับผู้บริหารโรงเรียนเรยีนาเชลีวิทยาลัย</div>
				</td>
			</tr>
		</tbody>
	</table>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	} ?>

<?php
	$regina_stu_dataSql="SELECT * FROM `regina_stu_data` WHERE `rsd_studentid`='{$stuID}'";
	$regina_stu_data=new notrow_evaluation($regina_stu_dataSql);
	foreach($regina_stu_data->evaluation_array as $rc_key=>$regina_stu_datarow){
		if($regina_stu_datarow["rsd_prefix"]==2){
			$mynameTh="เด็กหญิง&nbsp;".$regina_stu_datarow["rsd_name"]."&nbsp;".$regina_stu_datarow["rsd_surname"];			
		}elseif($regina_stu_datarow["rsd_prefix"]==4){
			$mynameTh="นางสาว&nbsp;".$regina_stu_datarow["rsd_name"]."&nbsp;".$regina_stu_datarow["rsd_surname"];			
		}else{
			$mynameTh=$regina_stu_datarow["rsd_name"]."&nbsp;".$regina_stu_datarow["rsd_surname"];			
		}
		$mynameEn="Miss&nbsp;".$regina_stu_datarow["rsd_nameEn"]."&nbsp;".$regina_stu_datarow["rsd_surnameEn"];
	}

	$data_studentSql="SELECT * FROM `data_student` WHERE `stu_id`='{$stuID}'";
	$data_student=new notrow_datastu($data_studentSql);
	foreach($data_student->datastu_array as $rc_key=>$data_studentrow){}
	
	$stu_addressSql="SELECT * FROM `stu_address` WHERE `stu_id`='{$stuID}'";
	$stu_address=new notrow_datastu($stu_addressSql);
	foreach($stu_address->datastu_array as $rc_key=>$stu_addressRow){}
	
	$stu_nation=new db_country($data_studentrow["stu_nation"]);
	$stu_sun=new  db_country($data_studentrow["stu_sun"]);


	$rc_religionSql="SELECT `Religion` FROM `rc_religion` WHERE `IDReligion`='{$data_studentrow["IDReligion"]}';";
	$rc_religion=new notrow_datastu($rc_religionSql);
	foreach($rc_religion->datastu_array as $rc_key=>$rc_religionRow){
		$Religion=$rc_religionRow["Religion"];
	}

	$stu_tumbon=new data_Subdistrict ($stu_addressRow["stu_tumbon"]); // ตำบล
	$stu_amphur=new data_District ($stu_addressRow["stu_amphur"]); //อำเภอ
	$stu_province=new data_Province($stu_addressRow["stu_province"]); //จังหวัด

	$stu_depend_stuSql="SELECT * FROM `depend_stu` WHERE `ds_stuid`='{$stuID}'";
	$stu_depend_stu=new notrow_datastu($stu_depend_stuSql);
	foreach($stu_depend_stu->datastu_array as $rc_key=>$stu_depend_stuRow){}



?>


		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="font-weight: bold;">ชื่อนักเรียนภาษาไทย</font><input type="text" size="50" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mynameTh;?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">เลขบัตรประชาชน</font><input type="text" size="17" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $regina_stu_datarow['rsd_Identification'];?>" readonly="readonly" required="required">
						</div>
						<div>
							<font style="font-weight: bold;">ชื่อนักเรียนภาษาอังกฤษ</font><input type="text" size="43" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mynameEn;?>" readonly="readonly" required="required">
							
<?php
		if(($data_studentrow['stu_birth']==null or $data_studentrow['stu_birth']=="-")){ ?>
							<font style="font-weight: bold;">วัน/เดือน/ปี เกิด</font><input type="text" size="12" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="" readonly="readonly" required="required">
<?php	}else{ ?>
							<font style="font-weight: bold;">วัน/เดือน/ปี เกิด</font><input type="text" size="12" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo datethai($data_studentrow['stu_birth']);?>" readonly="readonly" required="required">			
<?php	} ?>
							

							<font style="font-weight: bold;">หมู่เลือด</font><input type="text" size="4" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $data_studentrow['stu_blood'];?>" readonly="readonly" required="required">
						</div>
						<div>
							<font style="font-weight: bold;">เชื่อชาติ</font><input type="text" size="15" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_nation->nation_name_th;?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">สัญชาติ</font><input type="text" size="15" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_sun->nation_name_th;?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">ศาสนา</font><input type="text" size="14" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $Religion;?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">ที่อยู่ปัจจุบัน เลขที่</font><input type="text" size="6" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_addressRow['stu_hno'];?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">หมู่ที่</font><input type="text" size="2" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_addressRow['stu_moo'];?>" readonly="readonly" required="required">
						</div>
						<div>
							<font style="font-weight: bold;">ถนน</font><input type="text" size="40" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_addressRow['stu_road'];?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">ซอย</font><input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_addressRow['stu_soi'];?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">ตำบล</font><input type="text" size="27" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_tumbon->DISTRICT_NAME;?>" readonly="readonly" required="required">

						</div>
						<div>
							<font style="font-weight: bold;">อำเภอ</font><input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">จังหวัด</font><input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_province->PROVINCE_NAME;?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">รหัสไปรษณีย์</font><input type="text" size="13" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_addressRow["stu_zipcode"];?>" readonly="readonly" required="required">
							<font style="font-weight: bold;">โทรศัพท์</font><input type="text" size="12" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $data_studentrow["stu_phone"];?>" readonly="readonly" required="required">
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							ชื่อบิดา<input type="text" size="37" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $myname_f;?>" readonly="readonly" required="required">
							เลขบัตรประชาชน<input type="text" size="13" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_fatherRow['father_code'];?>" readonly="readonly" required="required">
							อาชีพ<input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $Fcareer;?>" readonly="readonly" required="required">
						</div>
						<div>สถานที่ทำงาน<input type="text" size="34" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_fatherRow['father_workplace'];?>" readonly="readonly" required="required">จังหวัด<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_addwordprovince->PROVINCE_NAME;?>" readonly="readonly" required="required">โทรศัพท์ที่ทำงาน<input type="text" size="15" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_fatherRow['father_wp_tel'];?>" readonly="readonly" required="required"></div>
						<div>ที่อยู่ปัจจุบัน เลขที่<input type="text" size="6" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_father_addressRow['father_hno'];?>" readonly="readonly" required="required">หมู่ที่<input type="text" size="3" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_father_addressRow['father_moo'];?>" readonly="readonly" required="required">ถนน<input type="text" size="29" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_father_addressRow["father_road"];?>" readonly="readonly" required="required">ซอย<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_father_addressRow['father_soi'];?>" readonly="readonly" required="required">ตำบล<input type="text" size="13" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_tumbon->DISTRICT_NAME;?>" readonly="readonly" required="required"></div>
						<div>อำเภอ<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required">จังหวัด<input type="text" size="26" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_province->PROVINCE_NAME;?>" readonly="readonly" required="required">รหัสไปรษณีย์<input type="text" size="6" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_father_addressRow['father_zipcode'];?>" readonly="readonly" required="required">โทรศัพท์<input type="text" size="15" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_fatherRow['father_phone'];?>" readonly="readonly" required="required"></div>
					</td>
				</tr>
			</tbody>					
		</table>

		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อมารดา<input type="text" size="35" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $myname_m;?>" readonly="readonly" required="required">เลขบัตรประชาชน<input type="text" size="13" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_motherRow['mother_code'];?>" readonly="readonly" required="required">อาชีพ<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $Mcareer;?>" readonly="readonly" required="required"></div>
						<div>สถานที่ทำงาน<input type="text" size="34" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_motherRow['mother_workplace'];?>" readonly="readonly" required="required">จังหวัด<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_wordprovince->PROVINCE_NAME;?>" readonly="readonly" required="required">โทรศัพท์ที่ทำงาน<input type="text" size="15" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_motherRow['mother_wp_tel'];?>" readonly="readonly" required="required"></div>
						<div>ที่อยู่ปัจจุบัน เลขที่<input type="text" size="6" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_mother_addressRow['mother_hno'];?>" readonly="readonly" required="required">หมู่ที่<input type="text" size="3" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_mother_addressRow['mother_moo'];?>" readonly="readonly" required="required">ถนน<input type="text" size="29" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_mother_addressRow["mother_road"];?>" readonly="readonly" required="required">ซอย<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_mother_addressRow['mother_soi'];?>" readonly="readonly" required="required">ตำบล<input type="text" size="13" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_tumbon->DISTRICT_NAME;?>" readonly="readonly" required="required"></div>
						<div>อำเภอ<input type="text" size="20" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required">จังหวัด<input type="text" size="26" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_province->PROVINCE_NAME;?>" readonly="readonly" required="required">รหัสไปรษณีย์<input type="text" size="6" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_mother_addressRow['mother_zipcode'];?>" readonly="readonly" required="required">โทรศัพท์<input type="text" size="15" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_motherRow['mother_phone'];?>" readonly="readonly" required="required"></div>
					</td>
				</tr>
			</tbody>					
		</table>
		<div>&nbsp;</div>
		<center><table style="width: 60%; vertical-align: top; font-size: 20px; font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
		  <tbody>
			<tr>
			  <td><div><center><b>สถานภาพบิดา-มารดา</b></center></div></td>
			  
			<?php 	if ($stu_depend_stuRow['ds_FMstatus'] == '1') { ?>
				<td>
				<center><div>
				&nbsp;<font style="font-family: THSarabunNew; font-size: 20px"><img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="13" height="13" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
				</div></center>
				<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
			  </td>
				
		<?php		} else if ($stu_depend_stuRow['ds_FMstatus'] == '2') { ?>
				<td>
				<center><div>
				&nbsp;<font style="font-family: THSarabunNew; font-size: 20px"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="13" height="13" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
				</div></center>
				<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
			  </td>			
		<?php		} else if ($stu_depend_stuRow['ds_FMstatus'] == '3') { ?>
				<td>
				<center><div>
				&nbsp;<font style="font-family: THSarabunNew; font-size: 20px"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="13" height="13" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
				</div></center>
				<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
			  </td>			
		<?php		} else if ($stu_depend_stuRow['ds_FMstatus'] == '4') { ?>
				<td>
				<center><div>
				&nbsp;<font style="font-family: THSarabunNew; font-size: 20px"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
				</div></center>
				<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="13" height="13" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
			  </td>			
		<?php		} else if ($stu_depend_stuRow['ds_FMstatus'] == '5') { ?>
				<td>
				<center><div>
				&nbsp;<font style="font-family: THSarabunNew; font-size: 20px"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
				</div></center>
				<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="13" height="13" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
			  </td>		
		<?php		}else{ ?>
				<td>
				<center><div>
				&nbsp;<font style="font-family: THSarabunNew; font-size: 20px"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
				</div></center>
				<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 20px;"><img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="13" height="13" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
			  </td>				
		<?php		} ?>	
			</tr>
		  </tbody>
		</table></center>
		<br>
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้ามีความประสงค์ที่จะให้บุตรสาวศึกษาต่อที่โรงเรียนเรยีนาเชลีวิทยาลัย และยินดีให้ความร่วมมือกับทางโรงเรียนในการส่งเสริม สนับสนุน ดูแลบุตรสาวทั้งด้านการเรียน ความประพฤติให้ปฏิบัติอยู่ในกฎระเบียบของโรงเรียน พร้อมกันนี้ข้าพเจ้าได้ชำระเงินยืนยันการมอบตัวนักเรียนเรียบร้อยแล้ว หากบุตรสาวของข้าพเจ้าสละสิทธิ์ไม่ว่ากรณีใดๆ ข้าพเจ้ายินดีมอบเงินทั้งหมดให้กับทางโรงเรียนเพื่อ สนับสนุนการศึกษาของโรงเรียนต่อไป</div>
					</td>
				</tr>
			</tbody>					
		</table>
		
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 50%">
					
		<table style="vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
  			<tbody>
    			<tr>
			      <td>
					<div id="fontA"><center><b>เอกสารประกอบการมอบตัว มีดังนี้</b></center></div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$quota_InternalSaveRights=new PrintSendDocuments($stuID,$next_year);
		if($quota_InternalSaveRights->RowArraySendDocuments() && (gettype($quota_InternalSaveRights->RowArraySendDocuments())=='array' || gettype($quota_InternalSaveRights->RowArraySendDocuments())=='object')){
			foreach($quota_InternalSaveRights->RowArraySendDocuments() as $rc=>$InternalSaveRightsRow){ 
				$sd_send_documents=$InternalSaveRightsRow["sd_send_documents"];
				$SdStudentIDCard=$InternalSaveRightsRow["SdStudentIDCard"];
				$SdParentIDCard=$InternalSaveRightsRow["SdParentIDCard"];
				$sd_surrender=$InternalSaveRightsRow["sd_surrender"];
				$sd_financial_documents=$InternalSaveRightsRow["sd_financial_documents"];				
			}			
		}else{
			$sd_send_documents="-";
			$SdStudentIDCard="-";
			$SdParentIDCard="-";
			$sd_surrender="-";
			$sd_financial_documents="-";
		}
	?>			

		
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
				

				
		<?php
			   if($SdStudentIDCard=="yes"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div id="fontA">&nbsp;<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="12" height="12" alt=""/>&nbsp;สำเนาบัตรประชาชนนักเรียน จำนวน 1 ฉบับ</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php  }else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div id="fontA">&nbsp;<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="12" height="12" alt=""/>&nbsp;สำเนาบัตรประชาชนนักเรียน จำนวน 1 ฉบับ</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php  } ?>					
					
		<?php
			   if($SdParentIDCard=="yes"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div id="fontA">&nbsp;<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="12" height="12" alt=""/>&nbsp;สำเนาบัตรประชาชนบิดา หรือ มารดา หรือ ผู้ปกครอง จำนวน 1 ฉบับ</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php  }else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div id="fontA">&nbsp;<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="12" height="12" alt=""/>&nbsp;สำเนาบัตรประชาชนบิดา หรือ มารดา หรือ ผู้ปกครอง จำนวน 1 ฉบับ</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php  }?>	

		<?php
			   if($sd_financial_documents=="yes"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div id="fontA">&nbsp;<img src="<?php echo base_url();?>/Template/global_assets/images/f.JPG" width="12" height="12" alt=""/>&nbsp;หลักฐานการชำระเงิน (สลิปโอนเงิน หรือสำเนาใบเสร็จรับเงิน)</div>				   
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				   
		<?php  }else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div id="fontA">&nbsp;<img src="<?php echo base_url();?>/Template/global_assets/images/t.JPG" width="12" height="12" alt=""/>&nbsp;หลักฐานการชำระเงิน (สลิปโอนเงิน หรือสำเนาใบเสร็จรับเงิน)</div>				   
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				   
		<?php  }?>
					
		<?php
				if(isset($sd_send_documents)){
					if($sd_send_documents=="mail"){ ?>
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
					<center>
						<div id="fontA">วิธีการนำส่งเอกสารประกอบการมอบตัว</div>
					</center>						
						<div id="fontA">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ส่งทาง E-mail : academic@regina.ac.th</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
		<?php		}elseif($sd_send_documents=="zip"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					
					<center>
						<div id="fontA">วิธีการนำส่งเอกสารประกอบการมอบตัว</div>
					</center>							
						<div id="fontA">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ส่งทางไปรษณีย์</div>
						<div id="fontA">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ชื่อและที่อยู่ผู้รับ)&nbsp;ฝ่ายวิชาการ&nbsp;โรงเรียนเรยีนาเชลีวิทยาลัย</div>
						<div id="fontA">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขที่&nbsp;166&nbsp;ถ.เจริญประเทศ&nbsp;ต.ช้างคลาน&nbsp;อ.เมือง&nbsp;จ.เชียงใหม่ 50100</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
		<?php		}else{  ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
		<?php		}       
				}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}      ?>				

				  </td>
			    </tr>
  			</tbody>
		</table>					
					
					</td>
					<td style="width: 5%"></td>
					<td style="width: 37%">
					
<!--<?php
		if(!isset($stu_guardianRow["parent_status"])){ ?>
		<p><center><div>ลงชื่อ<input type="text" size="25" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="" readonly="readonly" required="required">ผู้ปกครอง</div>			
<?php	}elseif($stu_guardianRow["parent_status"]=="2"){ ?>
		<p><center><div>ลงชื่อ<input type="text" size="25" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php //echo $myname_f; ?>" readonly="readonly" required="required">ผู้ปกครอง</div>			
<?php	}elseif($stu_guardianRow["parent_status"]=="3"){ ?>
		<p><center><div>ลงชื่อ<input type="text" size="25" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php //echo $myname_m; ?>" readonly="readonly" required="required">ผู้ปกครอง</div>			
<?php	}elseif($stu_guardianRow["parent_status"]=="5"){ ?>
		<p><center><div>ลงชื่อ<input type="text" size="25" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php //echo $stu_depend_stuRow["ds_dormitoryMyName"]; ?>" readonly="readonly" required="required">ผู้ปกครอง</div>			
<?php	}else{ ?>
		<p><center><div>ลงชื่อ<input type="text" size="25" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php //echo $myname_g; ?>" readonly="readonly" required="required">ผู้ปกครอง</div>			
<?php	}?>-->	
						<P>
						<center>
							<div>ลงชื่อ.............................................ผู้ปกครอง</div>
							<div>(.....................................................)</div>
							<div>วันที่...........เดือน.....................พ.ศ............</div>
						</center>		
						<P>
						<center>
							<div>ลงชื่อ.............................................ผู้รับเอกสาร</div>
							<div>(.....................................................)</div>
							<div>วันที่...........เดือน.....................พ.ศ............</div>
						</center>
										
					</td>
				</tr>
			</tbody>					
		</table>




		


	</section>	
	
<?php
		if(($key_key==12 or $key_key==13)){ ?>
		
				
		<?php
			
			if(isset($stuID,$leve_ID,$key_key,$next_year)){
				$IntoTheTest=new IntoTheTest($stuID,$leve_ID,$key_key,$next_year);
			}else{
				//----------------------------------------------------------------
			}
			
			$ShowDeleteTheTest=new ShowDeleteTheTest($stuID,$next_year,$leve_ID,$key_key,"ShowDate");
				if(is_array($ShowDeleteTheTest->RunShowTheTest()) && count($ShowDeleteTheTest->RunShowTheTest())){
					foreach($ShowDeleteTheTest->RunShowTheTest() as $rc=>$ShowDeleteTheTestRow){
						if(isset($ShowDeleteTheTestRow["qtt_id"])){
							$qtt_id=$ShowDeleteTheTestRow["qtt_id"];
							$qtt_year=$ShowDeleteTheTestRow["qtt_year"];
							$qtt_plan=$ShowDeleteTheTestRow["qtt_plan"];
							$qtt_class=$ShowDeleteTheTestRow["qtt_class"];
						}else{
							$qtt_id="-";
							$qtt_year="-";
							$qtt_plan="-";
							$qtt_class="-";							
						}
					}		
				}else{
					$qtt_id="-";
					$qtt_year="-";
					$qtt_plan="-";
					$qtt_class="-";
				}
		?>
		
	<section class="sheet padding-10mm imgA">

		<table  style="width: 100%; vertical-align: top; font-size: 22px; font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 50%;">
						<div style="text-align: left;">เลขประจำตัวผู้เข้าสอบ<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $qtt_id;?>" readonly="readonly" required="required"></div>
					</td>
					<td style="width: 50%;">
						<div style="text-align: right;">สำหรับเจ้าหน้าที่</div>
					</td>
				</tr>
			</tbody>		
		</table>

		<table  style="width: 100%; vertical-align: top; font-size: 21px; font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<center>
							<div><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 65px; height: 63px;" alt="โรงเรียนเรยีนาเชลีวิทยาลัย จังหวัดเชียงใหม่"/></div>
							<div>ใบสมัครสอบคัดเลือกนักเรียนห้องเรียน วิทยาศาสตร์-คณิตศาสตร์ (สสวท.) </div>
							<div>ระดับชั้น<?php echo $leve_name;?> ปีการศึกษา <?php echo $next_year;?></div>
							<div>โรงเรียนเรยีนาเชลีวิทยาลัย  จังหวัดเชียงใหม่</div>
						</center>
					</td>
				</tr>
			</tbody>
		</table>
	
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div align="right"><img class="img-thumbnail" src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" alt="กรอกรูป"  style="width: 2.50cm; height: 3.25cm; text-align: right;"/></div>
					</td>
				</tr>
			</tbody>
		</table>
	
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			  <tbody>
				<tr>
				  <td>
					<div>ข้าพเจ้า<input type="text" size="102" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mynameTh;?>" readonly="readonly" required="required"></div>
					<div>เลขประจำตัวนักเรียน<input type="text" size="30" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $regina_stu_datarow["rsd_studentid"];?>" readonly="readonly" required="required">เลขประจำตัวประชาชน<input type="text" size="36" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $regina_stu_datarow['rsd_Identification'];?>" readonly="readonly" required="required"></div>  
				  </td>
				</tr>
			  </tbody>
		</table>
	
<?php
if($key_key==12){ ?>
		<br>
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<center>
							<div>มีความประสงค์สมัครสอบคัดเลือกห้องเรียน วิทยาศาสตร์-คณิตศาสตร์ (สสวท.) ระดับชั้นมัธยมศึกษาปีที่ 1  ปีการศึกษา <?php echo $next_year;?></div>
							<div>และจะปฏิบัติตามระเบียบและข้อปฎบัติในการสอบทุกประการ</div>
						</center>
					</td>
				</tr>
			</tbody>
		</table>
		
		<!--<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td colspan="3">
						<div><b><u><center>กำหนดการรับสมัคร</center></u></b></div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 20%;"><div><center>วัน/เดือน/ปี</center></div></td>
					<td style="width: 60%;"><div><center>รายการ</center></div></td>
					<td style="width: 20%;"><div><center>สถานที่</center></div></td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>20 ส.ค. - 3 ก.ย. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>สมัครสอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>26 พ.ย. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>ตรวจสอบรายชื่อ เลขที่นั่งสอบ และสถานที่สอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>27 พ.ย. 2564</div>
						<div>เวลา 13.00 - 16.00 น.</div>
					</td>
					<td style="width: 60%;">
						<div>สอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
						<div><u>เนื้อหาที่สอบ</u>&nbsp;ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
						<div>ระดับชั้นประถมศึกษาปีที่ 4-5 และประถมศึกษาปีที่ 6 (เฉพาะภาคเรียนที่ 1)</div>
					</td>
					<td style="width: 20%;">
						<div>ตามประกาศ</div>
					</td>
				</tr>	
				<tr>
					<td style="width: 20%;">
						<div>1 ธ.ค. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>ประกาศผลสอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>				
				<tr>
					<td style="width: 20%;">
						<div><b><u>เนื้อหาที่สอบ</u></b></div>
					</td>
					<td style="width: 60%;">
						<div>ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
						<div>ระดับชั้นประถมศึกษาปีที่ 4-5 และประถมศึกษาปีที่ 6 (เฉพาะภาคเรียนที่ 1)</div>
					</td>
					<td style="width: 20%;">
						<div></div>
					</td>
				</tr>				
			</tbody>
		</table>-->				

<?php }else{ ?>
		<br>
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<center>
							<div>มีความประสงค์สมัครสอบคัดเลือกห้องเรียน วิทยาศาสตร์-คณิตศาสตร์ (สสวท.) ระดับชั้นมัธยมศึกษาปีที่ 4  ปีการศึกษา <?php echo $next_year;?></div>
							<div>และจะปฏิบัติตามระเบียบและข้อปฎบัติในการสอบทุกประการ</div>
						</center>
					</td>
				</tr>
			</tbody>
		</table>
		
		<!--<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td colspan="3">
						<div><b><u><center>กำหนดการรับสมัคร</center></u></b></div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 20%;"><div><center>วัน/เดือน/ปี</center></div></td>
					<td style="width: 60%;"><div><center>รายการ</center></div></td>
					<td style="width: 20%;"><div><center>สถานที่</center></div></td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>20 ส.ค. - 3 ก.ย. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>สมัครสอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>26 พ.ย. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>ตรวจสอบรายชื่อ เลขที่นั่งสอบ และสถานที่สอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>27 พ.ย. 2564</div>
						<div>เวลา 13.00 - 16.00 น.</div>
					</td>
					<td style="width: 60%;">
						<div>สอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
						<div><u>เนื้อหาที่สอบ</u>&nbsp;ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
						<div>ระดับชั้นมัธยมศึกษาปีที่ 4-5 และมัธยมศึกษาปีที่ 6 (เฉพาะภาคเรียนที่ 1)</div>
					</td>
					<td style="width: 20%;">
						<div>ตามประกาศ</div>
					</td>
				</tr>	
				<tr>
					<td style="width: 20%;">
						<div>1 ธ.ค. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>ประกาศผลสอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>				
				<tr>
					<td style="width: 20%;">
						<div><b><u>เนื้อหาที่สอบ</u></b></div>
					</td>
					<td style="width: 60%;">
						<div>ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
						<div>ระดับชั้นมัธยมศึกษาปีที่ 1-3 (เฉพาะภาคเรียนที่ 1)</div>
					</td>
					<td style="width: 20%;">
						<div></div>
					</td>
				</tr>				
			</tbody>
		</table>-->	
<?php }      ?>	

	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td><center><div>ข้าพเจ้าขอรับรองว่า ข้อความดังกล่าวทั้งหมดในใบสมัครนี้เป็นจริงทุกประการ และจะนำใบสมัครมาแสดงต่อเจ้าหน้าที่ในวันสอบ</div></td>
			</tr>
		</tbody>
	</table>
	<br>
	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
	  <tbody>
		<tr>
		  <td>
			<center>
				<div>ลงชื่อ<input type="text" size="30" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="<?php //echo $mynameTh;?>" readonly="readonly" required="required"></div>
				<div>วันที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="<?php //echo datethai($date_time);?>" readonly="readonly" required="required"></div>
				<div>ผู้สมัคร</div>
			</center>
		  </td>
		  <td>
			<center>
			<div>ลงชื่อ................................................</div>
			<div>(.....................................................)</div>
			<div>เจ้าหน้าที่รับสมัคร</div></center>		
		  </td>
		</tr>
	  </tbody>
	</table>

	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div>----------------------------------------------------------------------------------------------------------------------------------------------------------------------</div>
				</td>
			</tr>
		</tbody>	
	</table>

		<table  style="width: 100%; vertical-align: top; font-size: 22px; font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 50%;">
						<div style="text-align: left;">เลขประจำตัวผู้เข้าสอบ<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $qtt_id;?>" readonly="readonly" required="required"></div>
					</td>
					<td style="width: 50%;">
						<div style="text-align: right;">สำหรับนักเรียน</div>
					</td>
				</tr>
			</tbody>		
		</table>

		<table  style="width: 100%; vertical-align: top; font-size: 21px; font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<center>
							<div><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 65px; height: 63px;" alt="โรงเรียนเรยีนาเชลีวิทยาลัย จังหวัดเชียงใหม่"/></div>
							<div>ใบสมัครสอบคัดเลือกนักเรียนห้องเรียน วิทยาศาสตร์-คณิตศาสตร์ (สสวท.) </div>
							<div>ระดับชั้น<?php echo $leve_name;?> ปีการศึกษา <?php echo $next_year;?></div>
							<div>โรงเรียนเรยีนาเชลีวิทยาลัย  จังหวัดเชียงใหม่</div>
						</center>
					</td>
				</tr>
			</tbody>
		</table>
	
		<!--<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div align="right"><img class="img-thumbnail" src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" alt="กรอกรูป"  style="width: 2.50cm; height: 3.25cm; text-align: right;"/></div>
					</td>
				</tr>
			</tbody>
		</table>-->
	
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			  <tbody>
				<tr>
				  <td>
					<div>ข้าพเจ้า<input type="text" size="102" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mynameTh;?>" readonly="readonly" required="required"></div>
					<div>เลขประจำตัวนักเรียน<input type="text" size="30" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $regina_stu_datarow["rsd_studentid"];?>" readonly="readonly" required="required">เลขประจำตัวประชาชน<input type="text" size="36" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $regina_stu_datarow['rsd_Identification'];?>" readonly="readonly" required="required"></div>  
				  </td>
				</tr>
			  </tbody>
		</table>
	
<?php
if($key_key==12){ ?>
		<br>
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<center>
							<div>มีความประสงค์สมัครสอบคัดเลือกห้องเรียน วิทยาศาสตร์-คณิตศาสตร์ (สสวท.) ระดับชั้นมัธยมศึกษาปีที่ 1  ปีการศึกษา <?php echo $next_year;?></div>
							<div>และจะปฏิบัติตามระเบียบและข้อปฎบัติในการสอบทุกประการ</div>
						</center>
					</td>
				</tr>
			</tbody>
		</table>
		
		<!--<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td colspan="3">
						<div><b><u><center>กำหนดการรับสมัคร</center></u></b></div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 20%;"><div><center>วัน/เดือน/ปี</center></div></td>
					<td style="width: 60%;"><div><center>รายการ</center></div></td>
					<td style="width: 20%;"><div><center>สถานที่</center></div></td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>20 ส.ค. - 3 ก.ย. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>สมัครสอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>26 พ.ย. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>ตรวจสอบรายชื่อ เลขที่นั่งสอบ และสถานที่สอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>27 พ.ย. 2564</div>
						<div>เวลา 13.00 - 16.00 น.</div>
					</td>
					<td style="width: 60%;">
						<div>สอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
						<div><u>เนื้อหาที่สอบ</u>&nbsp;ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
						<div>ระดับชั้นประถมศึกษาปีที่ 4-5 และประถมศึกษาปีที่ 6 (เฉพาะภาคเรียนที่ 1)</div>
					</td>
					<td style="width: 20%;">
						<div>ตามประกาศ</div>
					</td>
				</tr>	
				<tr>
					<td style="width: 20%;">
						<div>1 ธ.ค. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>ประกาศผลสอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>				
				<tr>
					<td style="width: 20%;">
						<div><b><u>เนื้อหาที่สอบ</u></b></div>
					</td>
					<td style="width: 60%;">
						<div>ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
						<div>ระดับชั้นประถมศึกษาปีที่ 4-5 และประถมศึกษาปีที่ 6 (เฉพาะภาคเรียนที่ 1)</div>
					</td>
					<td style="width: 20%;">
						<div></div>
					</td>
				</tr>				
			</tbody>
		</table>-->				

<?php }else{ ?>
		<br>
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<center>
							<div>มีความประสงค์สมัครสอบคัดเลือกห้องเรียน วิทยาศาสตร์-คณิตศาสตร์ (สสวท.) ระดับชั้นมัธยมศึกษาปีที่ 4  ปีการศึกษา<?php echo $next_year;?></div>
							<div>และจะปฏิบัติตามระเบียบและข้อปฎบัติในการสอบทุกประการ</div>
						</center>
					</td>
				</tr>
			</tbody>
		</table>
		
		<!--<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td colspan="3">
						<div><b><u><center>กำหนดการรับสมัคร</center></u></b></div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width: 20%;"><div><center>วัน/เดือน/ปี</center></div></td>
					<td style="width: 60%;"><div><center>รายการ</center></div></td>
					<td style="width: 20%;"><div><center>สถานที่</center></div></td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>20 ส.ค. - 3 ก.ย. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>สมัครสอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>26 พ.ย. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>ตรวจสอบรายชื่อ เลขที่นั่งสอบ และสถานที่สอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;">
						<div>27 พ.ย. 2564</div>
						<div>เวลา 13.00 - 16.00 น.</div>
					</td>
					<td style="width: 60%;">
						<div>สอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
						<div><u>เนื้อหาที่สอบ</u>&nbsp;ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
						<div>ระดับชั้นมัธยมศึกษาปีที่ 4-5 และมัธยมศึกษาปีที่ 6 (เฉพาะภาคเรียนที่ 1)</div>
					</td>
					<td style="width: 20%;">
						<div>ตามประกาศ</div>
					</td>
				</tr>	
				<tr>
					<td style="width: 20%;">
						<div>1 ธ.ค. 2564</div>
					</td>
					<td style="width: 60%;">
						<div>ประกาศผลสอบคัดเลือกนักเรียนห้องเรียน วิทย์ - คณิต (สสวท.)</div>
					</td>
					<td style="width: 20%;">
						<div>www.regina.ac.th</div>
					</td>
				</tr>				
				<tr>
					<td style="width: 20%;">
						<div><b><u>เนื้อหาที่สอบ</u></b></div>
					</td>
					<td style="width: 60%;">
						<div>ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
						<div>ระดับชั้นมัธยมศึกษาปีที่ 1-3 (เฉพาะภาคเรียนที่ 1)</div>
					</td>
					<td style="width: 20%;">
						<div></div>
					</td>
				</tr>				
			</tbody>
		</table>-->	
<?php }      ?>	
	
	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td><center><div>ข้าพเจ้าขอรับรองว่า ข้อความดังกล่าวทั้งหมดในใบสมัครนี้เป็นจริงทุกประการ และจะนำใบสมัครมาแสดงต่อเจ้าหน้าที่ในวันสอบ</div></td>
			</tr>
		</tbody>
	</table>
	<br>
	<table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
	  <tbody>
		<tr>
		  <td>
			<center>
				<div>ลงชื่อ<input type="text" size="30" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="<?php //echo $mynameTh;?>" readonly="readonly" required="required"></div>
				<div>วันที่<input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: center; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="<?php //echo datethai($date_time);?>" readonly="readonly" required="required"></div>
				<div>ผู้สมัคร</div>
			</center>
		  </td>
		  <td>
			<center>
			<div>ลงชื่อ................................................</div>
			<div>(.....................................................)</div>
			<div>เจ้าหน้าที่รับสมัคร</div></center>		
		  </td>
		</tr>
	  </tbody>
	</table>


	
	</section>		
<?php	}else{
	
			$ShowDeleteTheTest=new ShowDeleteTheTest($stuID,$next_year,$leve_ID,$key_key,"Eackspace");
	
		}?>	

	
	
<?php
	include("view/function/pay.php");
	include("view/function/pay_scb.php");
	
	include("view/database/database_paynew.php");
	include("view/database/class_pay.php");
	
?>
	<section class="sheet padding-10mm imgA">	
	

	    <table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td>
                        <div>
                            <center><div><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 65px; height: 63px;" alt="โรงเรียนเรยีนาเชลีวิทยาลัย จังหวัดเชียงใหม่"/></div></center>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <th>
                        <div align="center">รายการค่ามอบตัวรอบโควตานักเรียนโรงเรียนเรยีนาเชลีวิทยาลัย ปีการศึกษา <?php echo $next_year;?></div>
                        <div>ชื่อ - สกุล<input type="text" size="50" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mynameTh;?>" readonly="readonly" required="required">&nbsp;เลขประจำตัวผู้มอบตัวรอบโควตา<input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stuID;?>" readonly="readonly" required="required"></div>
                    </th>                  
                </tr>
            </tbody>
        </table>


        
        <table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="1" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <th style="width: 10%;"><div align="center">ลำดับ</div></th>
                    <th style="width: 70%;"><div align="center">รายการ</div></th>
                    <th style="width: 20%;"><div align="center">ราคา</div></th>
                </tr>
                <tr>
                    
                        <td style="width: 10%;">
						
			<?php
				$RunQuotaCapitalA=new Run_quota_capital($stuID,$qr_year,$qr_level);
					if($RunQuotaCapitalA->Print_quota_capital_key()=="1"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$countA=0;
					$datapayASql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
								  from `surrender_fee` 
								  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
								  where `surrender_fee`.`sf_year`='{$qr_year}' 
								  and `surrender_fee`.`sf_class`='{$qr_level}' 
								  and `surrender_fee`.`sf_plan`='{$qr_plan}' 
								  and `surrender_fee_list`.`sft_key`='A003' 
								  and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
					$datapayA=new row_quotaarray($datapayASql);
					foreach($datapayA->print_quotaarray() as $rc=>$datapayARow){
						$countA=$countA+1;?>
						<?php
								if($datapayARow["sfl_price"]=="0.00"){ ?>
								
						<?php   }else{ ?>
						
								<div align="center"><?php echo $countA;?></div>
								
						<?php   }?>                       
						
								
				<?php    } ?>					
					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}elseif($RunQuotaCapitalA->Print_quota_capital_key()=="2"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$countA=0;
					$datapayASql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
								  from `surrender_fee` 
								  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
								  where `surrender_fee`.`sf_year`='{$qr_year}' 
								  and `surrender_fee`.`sf_class`='{$qr_level}' 
								  and `surrender_fee`.`sf_plan`='{$qr_plan}' 
								  and `surrender_fee_list`.`sft_key`='A004'
								  and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
					$datapayA=new row_quotaarray($datapayASql);
					foreach($datapayA->print_quotaarray() as $rc=>$datapayARow){
						$countA=$countA+1;?>
						
						<?php
								if($datapayARow["sfl_price"]=="0.00"){ ?>
								
						<?php   }else{ ?>
						
								<div align="center"><?php echo $countA;?></div>
								
						<?php   }?>                       
						
								
				<?php    } ?>					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$TestPayGroupA=new TestPayGroup($stuID,$txt_year);
						if($TestPayGroupA->RunTestPayGroupStu()==null or $TestPayGroupA->RunTestPayGroupStu()==0 or $TestPayGroupA->RunTestPayGroupStu()=="-"){ ?> 
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
							<?php
								$countA=0;
								$datapayASql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
											  from `surrender_fee` 
											  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
											  where `surrender_fee`.`sf_year`='{$qr_year}' 
											  and `surrender_fee`.`sf_class`='{$qr_level}' 
											  and `surrender_fee`.`sf_plan`='{$qr_plan}'
											  and `surrender_fee_list`.`sft_key`='A001'
											  and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
								$datapayA=new row_quotaarray($datapayASql);
								foreach($datapayA->print_quotaarray() as $rc=>$datapayARow){
									$countA=$countA+1;?>
									
									<?php
											if($datapayARow["sfl_price"]=="0.00"){ ?>
											
									<?php   }else{ ?>
									
											<div align="center"><?php echo $countA;?></div>
											
									<?php   }?>  
									
							<?php    } ?>						
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
				<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
							<?php
								$countA=0;
								$datapayASql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
											  from `surrender_fee` 
											  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
											  where `surrender_fee`.`sf_year`='{$qr_year}' 
											  and `surrender_fee`.`sf_class`='{$qr_level}' 
											  and `surrender_fee`.`sf_plan`='{$qr_plan}'
											  and `surrender_fee_list`.`sft_key`='A002'
											  and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
								$datapayA=new row_quotaarray($datapayASql);
								foreach($datapayA->print_quotaarray() as $rc=>$datapayARow){
									$countA=$countA+1;?>
									
									<?php
											if($datapayARow["sfl_price"]=="0.00"){ ?>
											
									<?php   }else{ ?>
									
											<div align="center"><?php echo $countA;?></div>
											
									<?php   }?>  
									
							<?php    } ?>						
					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
				<?php   }?>				

				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}?>			
						
						
                        
            
                        
                        
                        </td>
                        <td style="width: 70%;">
                      
			<?php
				$RunQuotaCapitalB=new Run_quota_capital($stuID,$qr_year,$qr_level);
					if($RunQuotaCapitalB->Print_quota_capital_key()=="1"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$datapayBSql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
								  from `surrender_fee` 
								  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
								  where `surrender_fee`.`sf_year`='{$qr_year}' 
								  and `surrender_fee`.`sf_class`='{$qr_level}' 
								  and `surrender_fee_list`.`sft_key`='A003'
								  and `surrender_fee`.`sf_plan`='{$qr_plan}' and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
					$datapayB=new row_quotaarray($datapayBSql);
					foreach($datapayB->print_quotaarray() as $rc=>$datapayBRow){ ?>
						<?php
								if($datapayBRow["sfl_price"]=="0.00"){ ?>
								
						<?php   }else{ ?>
								<div>&nbsp;<?php echo $datapayBRow["sfl_txt"];?></div>
						<?php   }?>        
								
								
				<?php    } ?>					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}elseif($RunQuotaCapitalB->Print_quota_capital_key()=="2"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$datapayBSql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
								  from `surrender_fee` 
								  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
								  where `surrender_fee`.`sf_year`='{$qr_year}' 
								  and `surrender_fee`.`sf_class`='{$qr_level}' 
								  and `surrender_fee_list`.`sft_key`='A004'
								  and `surrender_fee`.`sf_plan`='{$qr_plan}' and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
					$datapayB=new row_quotaarray($datapayBSql);
					foreach($datapayB->print_quotaarray() as $rc=>$datapayBRow){ ?>
						<?php
								if($datapayBRow["sfl_price"]=="0.00"){ ?>
								
						<?php   }else{ ?>
								<div>&nbsp;<?php echo $datapayBRow["sfl_txt"];?></div>
						<?php   }?>        
								
								
				<?php    } ?>					
					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$TestPayGroupB=new TestPayGroup($stuID,$txt_year);
						if($TestPayGroupB->RunTestPayGroupStu()==null or $TestPayGroupB->RunTestPayGroupStu()==0 or $TestPayGroupB->RunTestPayGroupStu()=="-"){ ?> 
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
							<?php
								$datapayBSql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
											  from `surrender_fee` 
											  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
											  where `surrender_fee`.`sf_year`='{$qr_year}' 
											  and `surrender_fee`.`sf_class`='{$qr_level}' 
											  and `surrender_fee_list`.`sft_key`='A001'
											  and `surrender_fee`.`sf_plan`='{$qr_plan}' and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
								$datapayB=new row_quotaarray($datapayBSql);
								foreach($datapayB->print_quotaarray() as $rc=>$datapayBRow){ ?>
									<?php
											if($datapayBRow["sfl_price"]=="0.00"){ ?>
											
									<?php   }else{ ?>
											<div>&nbsp;<?php echo $datapayBRow["sfl_txt"];?></div>
									<?php   }?>        
											
											
							<?php    } ?>							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
				<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
							<?php
								$datapayBSql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
											  from `surrender_fee` 
											  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
											  where `surrender_fee`.`sf_year`='{$qr_year}' 
											  and `surrender_fee`.`sf_class`='{$qr_level}' 
											  and `surrender_fee_list`.`sft_key`='A002'
											  and `surrender_fee`.`sf_plan`='{$qr_plan}' and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
								$datapayB=new row_quotaarray($datapayBSql);
								foreach($datapayB->print_quotaarray() as $rc=>$datapayBRow){ ?>
									<?php
											if($datapayBRow["sfl_price"]=="0.00"){ ?>
											<div></div>
									<?php   }else{ ?>
											<div>&nbsp;<?php echo $datapayBRow["sfl_txt"];?></div>
									<?php   }?>        
											
											
							<?php    } ?>					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
				<?php   }?>


				
					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}?>
					  
            
                        
                        </td>
                        <td style="width: 20%;">
						
			<?php
				$RunQuotaCapitalC=new Run_quota_capital($stuID,$qr_year,$qr_level);
					if($RunQuotaCapitalC->Print_quota_capital_key()=="1"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$sumpay=0;
					$datapayCSql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
								  from `surrender_fee` 
								  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
								  where `surrender_fee`.`sf_year`='{$qr_year}' 
								  and `surrender_fee`.`sf_class`='{$qr_level}' 
								  and `surrender_fee`.`sf_plan`='{$qr_plan}' 
								  and `surrender_fee_list`.`sft_key`='A003'
								  and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
					$datapayC=new row_quotaarray($datapayCSql);
					foreach($datapayC->print_quotaarray() as $rc=>$datapayCRow){ 
						$sumpay=$sumpay+$datapayCRow["sfl_price"];
					?>
					
						<?php
								if($datapayBRow["sfl_price"]=="0.00"){ ?>
								
						<?php   }else{ ?>
								<div align="right"><?php echo number_format($datapayCRow["sfl_price"], 2, '.', ',');?>&nbsp;&nbsp;&nbsp;</div>                            
						<?php   }?>                               
									   
				<?php    } ?>					
				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
			<?php	}elseif($RunQuotaCapitalC->Print_quota_capital_key()=="2"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					$sumpay=0;
					$datapayCSql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
								  from `surrender_fee` 
								  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
								  where `surrender_fee`.`sf_year`='{$qr_year}' 
								  and `surrender_fee`.`sf_class`='{$qr_level}' 
								  and `surrender_fee`.`sf_plan`='{$qr_plan}' 
								  and `surrender_fee_list`.`sft_key`='A004'
								  and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
					$datapayC=new row_quotaarray($datapayCSql);
					foreach($datapayC->print_quotaarray() as $rc=>$datapayCRow){ 
						$sumpay=$sumpay+$datapayCRow["sfl_price"];
					?>
					
						<?php
								if($datapayBRow["sfl_price"]=="0.00"){ ?>
								
						<?php   }else{ ?>
								<div align="right"><?php echo number_format($datapayCRow["sfl_price"], 2, '.', ',');?>&nbsp;&nbsp;&nbsp;</div>                            
						<?php   }?>                               
									   
				<?php    } ?>					
				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				
				<?php
					$TestPayGroupC=new TestPayGroup($stuID,$txt_year);
						if($TestPayGroupC->RunTestPayGroupStu()==null or $TestPayGroupC->RunTestPayGroupStu()==0 or $TestPayGroupC->RunTestPayGroupStu()=="-"){ ?> 
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
							<?php
								$sumpay=0;
								$datapayCSql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
											  from `surrender_fee` 
											  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
											  where `surrender_fee`.`sf_year`='{$qr_year}' 
											  and `surrender_fee`.`sf_class`='{$qr_level}' 
											  and `surrender_fee`.`sf_plan`='{$qr_plan}' 
											   and `surrender_fee_list`.`sft_key`='A001'
											  and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
								$datapayC=new row_quotaarray($datapayCSql);
								foreach($datapayC->print_quotaarray() as $rc=>$datapayCRow){ 
									$sumpay=$sumpay+$datapayCRow["sfl_price"];
								?>
								
									<?php
											if($datapayBRow["sfl_price"]=="0.00"){ ?>
											
									<?php   }else{ ?>
											<div align="right"><?php echo number_format($datapayCRow["sfl_price"], 2, '.', ',');?>&nbsp;&nbsp;&nbsp;</div>                            
									<?php   }?>    
					   
							<?php    } ?>						
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
				<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
							<?php
								$sumpay=0;
								$datapayCSql="select `surrender_fee_list`.`sfl_no`,`surrender_fee_list`.`sfl_txt`,`surrender_fee_list`.`sfl_price`  
											  from `surrender_fee` 
											  right join `surrender_fee_list` on (`surrender_fee`.`sf_no`=`surrender_fee_list`.`sf_no`) 
											  where `surrender_fee`.`sf_year`='{$qr_year}' 
											  and `surrender_fee`.`sf_class`='{$qr_level}' 
											  and `surrender_fee`.`sf_plan`='{$qr_plan}' 
											   and `surrender_fee_list`.`sft_key`='A002'
											  and `surrender_fee_list`.`sfl_price` != '0.00' ORDER BY `surrender_fee_list`.`sfl_no` ASC";
								$datapayC=new row_quotaarray($datapayCSql);
								foreach($datapayC->print_quotaarray() as $rc=>$datapayCRow){ 
									$sumpay=$sumpay+$datapayCRow["sfl_price"];
								?>
								
									<?php
											if($datapayBRow["sfl_price"]=="0.00"){ ?>
											
									<?php   }else{ ?>
											<div align="right"><?php echo number_format($datapayCRow["sfl_price"], 2, '.', ',');?>&nbsp;&nbsp;&nbsp;</div>                            
									<?php   }?>    
					   
							<?php    } ?>						
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
				<?php   }?>
				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
			<?php	}?>						
						
                        
                        </td>
                    
                </tr> 
                 
                <tr>
                    <td></td>
                    <td>
						<?php $bathformat=new bathformat(number_format($sumpay, 2, '.', ','));?>
                        <div><center><?php echo $bathformat->run_pay();?> </center></div>
                    </td>
                    <td>
                        <div align="right"><?php echo number_format($sumpay, 2, '.', ',');?>&nbsp;&nbsp;&nbsp;</div>
                    </td>
                </tr>
                
            </tbody>
        </table>
<?php
	//$class=$qr_year;
	//$class_ex=$data_stu->Sort_name_E2;
	$txt_billerId="099400043439110";
	$txt_ref1=strtoupper($stuID."Y".$qr_year);
	$txt_ref2=strtoupper("QUOTARC".$qr_year."C".$qr_level."P".$qr_plan);
	$txt_amount=number_format($sumpay, 2, '.', '');                                                   
	$txt_width="150";
	$payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
?>


        <table style="width: 100%; vertical-align: top; font-size: 20px;font-family: THSarabunNew; font-weight: bold;" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td style="width: 20%;">
						<div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="150" height="150"></div>
						<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
						<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
						<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
						<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($sumpay, 2, '.', ',');?></div>   
                    </td> 
					<td style="width: 80%;">
					    <div>&nbsp;&nbsp;&nbsp;&nbsp;<b>วิธีการชำระ</b></div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;1&nbsp;.&nbsp;ทำการสแกน QR Code ที่ปรากฏในเพจนี้ ด้วยแอปพลิเคชัน Mobile Banking ของท่าน</div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;2&nbsp;.&nbsp;ตรวจสอบข้อมูลที่ปรากฏใน Mobile Banking ให้ถูกต้องก่อนชำระเงิน</div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบเลขประจำตัวผู้สมัครให้ถูกต้อง</div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบจำนวนเงินให้ถูกต้อง</div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบชื่อผู้รับเงินต้องเป็นโรงเรียนเรยีนาเชลีวิทยาลัย หรือ REGINA COELI COLLEGE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SCHOOL เท่านั้น</div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;3&nbsp;.&nbsp;สำหรับหลักฐานการชำระเงินให้ท่านเก็บไว้เป็นหลักฐาน</div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;4&nbsp;.&nbsp;ทางโรงเรียนจะทำการตรวจสอบรายการและยืนยันการชำระเงินของท่าน </div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;5&nbsp;.&nbsp;การชำระเงินจะเสร็จสมบูรณ์ เมื่อทางโรงเรียนได้ตรวจสอบการชำระเงินของท่านเรียบร้อยแล้ว</div>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;6&nbsp;.&nbsp;หากต้องการใบเสร็จรับเงิน ติดต่อขอรับได้ที่ห้องการเงินของโรงเรียน</div>
					</td>
                <tr>
            <tbody>
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


