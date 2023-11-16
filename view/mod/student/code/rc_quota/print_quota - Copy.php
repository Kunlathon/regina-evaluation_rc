<?php
	include("../../../../database/pdo_data.php");
	include("../../../../database/pdo_quota.php");	
	include("../../../../database/pdo_conndatastu.php");

	include("../../../../database/class_pdodatastu.php");	
	include("../../../../database/class_quota.php");
	error_reporting(error_reporting() & ~E_NOTICE); 
	$next_year=2565;
	$txt_year=2564;
	$date_time=date("Y-m-d H:i:s");
	//ระดับชั้น
	$call_stu=new stu_levelpdo($stuID,$txt_year,"1");
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
					
		}

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
	
	
//ระดับชั้น
		$call_stu=new stu_levelpdo($stuID,$txt_year,"1");
	if($call_stu->IDLevel=="" or $call_stu->IDLevel=="0"){
		$call_stu=new stu_levelpdo($stuID,$txt_year,"2");		
	}else{
		//************************************************
	}
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
		}
//ระดับชั้น	

	if($qce_key==""){
		$keyqce_key=="";
	}elseif($qce_key=="NO"){
		$key_key=="";
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

//img
	if(file_exists("../../../../all/$stuID.jpg")){
		$user_img="../../../../all/$stuID.jpg";
	}else{
		$user_img="../../../../all/newimg_rc.jpg";
	}	
//img



?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ใบมอบตัวนักเรียนโควตาภายใน</title>
<style>
@font-face {
    font-family: 'THSarabunNew';
    src: url('../../../../font/thsarabunnew-webfont.eot');
    src: url('../../../../font/thsarabunnew-webfont.eot?#iefix') format('embedded-opentype'),
url('../../../../font/thsarabunnew-webfont.woff') format('woff'),
url('../../../../font/THSarabunNew.ttf') format('truetype');
}

	body{
		font-family: "THSarabunNew";
		font-size: 26px;
		color: #032E3B;
		
	}
</style>	
<style type="text/css" >

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
		font-size: 19pt; 

		background: white;
		
	}
	
	#fontA{
		font-family: "THSarabunNew";
		font-size: 16pt; 

		background: white;		
	}

  
}


@page 
    {
        size: auto;   /* กำหนดขนาดของหน้าเอกสารเป็นออโต้ครับ */
        margin: 8mm;  /* กำหนดขอบกระดาษเป็น 0 มม. */
    }

    body 
    {
        margin: 8px;  /* เป็นการกำหนดขอบกระดาษของเนื้อหาที่จะพิมพ์ก่อนที่จะส่งไปให้เครื่องพิมพ์ครับ */
    }
	
	
</style>

	
	
</head>
<div id="p_echo">
	<button type="button" class="btn btn-default" onclick="window.print()">พิมพ์เอกสารใบมอบตัว</button>
	<font color="#F70105"><p><b>ระบบการพิมพ์เอกสารใบมอบตัว ระบบจะรองรับ เว็บเบราว์เซอร์  Google Chrome และ  Microsoft Edge<b></p></font>
</div>
<body onload="window.print()">


<table  style="width: 1024px;"  border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td width="203">
		  <center><div><img src="../../../../../Template/global_assets/images/logo_rc.jpg" alt="โรงเรียนเรยีนาเชลีวิทยาลัย จังหวัดเชียงใหม่" width="99" height="103"  style="width: 85px; height: 89px;"/></div></center>
		  <div>
		  <table width="200" border="1" cellpadding="0" cellspacing="0">
  			<tbody>
    			<tr>
      				<td>
						<div>&nbsp;เลขประจำตัว <?php echo $regina_stu_datarow["rsd_studentid"];?></div>
						<div>&nbsp;สีบ้าน <?php echo $txt_home;?></div>
					</td>
    			</tr>
  			</tbody>
		</table>

		  </div>
	  </td>
      <td width="662">
		<center>
			<div><b>ใบมอบตัวนักเรียน <?php echo $leve_name;?> ปีการศึกษา <?php echo $next_year;?></b></div>  
			<div><b>โรงเรียนเรยีนาเชลีวิทยาลัย จังหวัดเชียงใหม่</b></div>  
			<div><b>รอบโควตานักเรียนโรงเรียนเรยีนาเชลีวิทยาลัย</b></div> 
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
				<table width="517" border="1" cellpadding="0" cellspacing="0">
 					 <tbody>
    					<tr>
				<?php
					if($leve_ID=="31"){  ?>
      						<td><center><div><font  color="#F50206"><b>ได้รับสิทธิ์โควตา ห้องเรียน <?php echo $call_quota->plan_LName;?></b></font></div></center></td>						
			<?php	}else{ ?>
      						<td><center><div><font  color="#F50206"><b>ได้รับสิทธิ์โควตา แผนการเรียน <?php echo $call_quota->plan_LName;?></b></font></div></center></td>						
			<?php	}  ?>
						

    					</tr>
  					</tbody>
				</table>
			   <?php 		}else{
								
							}
						}
				?>
			</div>
		</center>
	  </td>
      <td width="159">	  
		  <div><img src="<?php echo $user_img;?>" style="width: 158px; height: 196px;" alt="กรอกรูป"/></div>
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
	foreach($stu_mother_address->datastu_array as $rc_key=>$stu_mother_addressRow){}	
	
	

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
	foreach($stu_father_address->datastu_array as $rc_key=>$stu_father_addressRow){}
	
	$f_np=new stu_prefix($stu_fatherRow["father_prefix"]);
	$myname_f=$f_np->prefix_prefixname." ".$stu_fatherRow["father_fname"]." ".$stu_fatherRow["father_sname"];
	
	$father_tumbon=new data_Subdistrict($stu_father_addressRow["father_tumbon"]); // ตำบล
	$father_amphur=new data_District($stu_father_addressRow["father_amphur"]); //อำเภอ
	$father_province=new data_Province($stu_father_addressRow["father_province"]); //จังหวัด	
	
	$data_FcareerSql="SELECT `dc_key`, `dc_txt2` FROM `data_career` WHERE `dc_key`='{$stu_fatherRow["father_career"]}'";
	$data_FcareerRs=new notrow_datastu($data_FcareerSql);
	foreach($data_FcareerRs->datastu_array as $rc_key=>$data_FcareerRow){
		$Fcareer=$data_FcareerRow["dc_txt2"];
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
	$myname_g=$g_np->prefix_prefixname." ".$stu_guardianRow["parent_fname"]." ".$stu_guardianRow["parent_sname"];
	
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
<table style="width: 1024px;"  border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td>
		<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ข้าพเจ้า(ผู้ปกครอง)</b><input type="text" size="40" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $myname_f; ?>" readonly="readonly" required="required"><b>เลขบัตรประชาชน</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_fatherRow["father_code"];?>" readonly="readonly" required="required"></div>
		<div><b>ที่อยู่ปัจจุบัน เลขที่</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_father_addressRow["father_hno"]; ?>" readonly="readonly" required="required"><b>หมู่ที่</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_father_addressRow["father_moo"];?>" readonly="readonly" required="required"><b>ถนน</b><input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_father_addressRow["father_road"];?>" readonly="readonly" required="required"><b>ซอย</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_father_addressRow["father_soi"]?>" readonly="readonly" required="required"></div><div><b>ตำบล</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $father_tumbon->DISTRICT_NAME; ?>" readonly="readonly" required="required"><b>อำเภอ</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $father_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required"><b>จังหวัด</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $father_province->PROVINCE_NAME; ?>" readonly="readonly" required="required"><b>รหัสไปรษณีย์</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_father_addressRow["father_zipcode"];?>" readonly="readonly" required="required"></div><div><b>โทรศัพท์</b><input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_fatherRow["father_phone"];?>" readonly="readonly" required="required"></div>
		 
		<div>
			<b>เกี่ยวข้องกับนักเรียนเป็น</b><input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $print_parent_status->dr_txt;?>" readonly="readonly" required="required">&nbsp;ขอมอบตัวนักเรียนไว้กับผู้บริหารโรงเรียนเรยีนาเชลีวิทยาลัย
		</div> 
		  
	  </td>
    </tr>
  </tbody>
</table>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	}elseif($stu_guardianRow["parent_status"]==3){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<table style="width: 1024px;"  border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td>
		<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ข้าพเจ้า(ผู้ปกครอง)</b><input type="text" size="40" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $myname_m; ?>" readonly="readonly" required="required"><b>เลขบัตรประชาชน</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_motherRow['mother_code'];?>" readonly="readonly" required="required"></div>
		<div><b>ที่อยู่ปัจจุบัน เลขที่</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_mother_addressRow["mother_hno"];?>" readonly="readonly" required="required"><b>หมู่ที่</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_mother_addressRow['mother_moo'];?>" readonly="readonly" required="required"><b>ถนน</b><input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_mother_addressRow["mother_road"];?>" readonly="readonly" required="required"><b>ซอย</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_mother_addressRow['mother_soi']?>" readonly="readonly" required="required"></div><div><b>ตำบล</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $mother_tumbon->DISTRICT_NAME; ?>" readonly="readonly" required="required"><b>อำเภอ</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $mother_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required"><b>จังหวัด</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $mother_province->PROVINCE_NAME; ?>" readonly="readonly" required="required"><b>รหัสไปรษณีย์</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_mother_addressRow['mother_zipcode'];?>" readonly="readonly" required="required"></div><div><b>โทรศัพท์</b><input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_motherRow['mother_phone'];?>" readonly="readonly" required="required"></div>
		 
		<div>
			<b>เกี่ยวข้องกับนักเรียนเป็น</b><input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $print_parent_status->dr_txt;?>" readonly="readonly" required="required">&nbsp;ขอมอบตัวนักเรียนไว้กับผู้บริหารโรงเรียนเรยีนาเชลีวิทยาลัย
		</div>  
		  
	  </td>
    </tr>
  </tbody>
</table>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}elseif($stu_guardianRow["parent_status"]==5){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<table style="width: 1024px;"  border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td>
		<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ข้าพเจ้า(ผู้ปกครอง)</b><input type="text" size="40" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_depend_stuRow["ds_dormitoryMyName"]; ?>" readonly="readonly" required="required"><b>เลขบัตรประชาชน</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="" readonly="readonly" required="required"></div>
		<div><b>ที่อยู่ปัจจุบัน เลขที่</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_depend_stuRow['ds_dormitoryHno']; ?>" readonly="readonly" required="required"><b>หมู่ที่</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_depend_stuRow['ds_dormitoryMoo'];?>" readonly="readonly" required="required"><b>ถนน</b><input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_depend_stuRow["ds_dormitoryRoad"];?>" readonly="readonly" required="required"><b>ซอย</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_depend_stuRow['ds_dormitorySoi']?>" readonly="readonly" required="required"></div><div><b>ตำบล</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $ds_dormitoryTumbon->DISTRICT_NAME; ?>" readonly="readonly" required="required"><b>อำเภอ</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $ds_dormitoryAmphur->AMPHUR_NAME;?>" readonly="readonly" required="required"><b>จังหวัด</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $ds_dormitoryProvince->PROVINCE_NAME; ?>" readonly="readonly" required="required"><b>รหัสไปรษณีย์</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_depend_stuRow['ds_dormitoryZipcode'];?>" readonly="readonly" required="required"></div><div><b>โทรศัพท์</b><input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_depend_stuRow['ds_dormitoryPhone'];?>" readonly="readonly" required="required"></div>
		 
		<div>
			<b>เกี่ยวข้องกับนักเรียนเป็น</b><input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $print_parent_status->dr_txt;?>" readonly="readonly" required="required">&nbsp;ขอมอบตัวนักเรียนไว้กับผู้บริหารโรงเรียนเรยีนาเชลีวิทยาลัย
		</div>  
		  
	  </td>
    </tr>
  </tbody>
</table>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<table style="width: 1024px;"  border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td>
		<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ข้าพเจ้า(ผู้ปกครอง)</b><input type="text" size="40" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $myname_g; ?>" readonly="readonly" required="required"><b>เลขบัตรประชาชน</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_guardianRow ['parent_code'];?>" readonly="readonly" required="required"></div>
		<div><b>ที่อยู่ปัจจุบัน เลขที่</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_guardian_addressRow ['parent_hno']; ?>" readonly="readonly" required="required"><b>หมู่ที่</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_guardian_addressRow['parent_moo'];?>" readonly="readonly" required="required"><b>ถนน</b><input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_guardian_addressRow["parent_road"];?>" readonly="readonly" required="required"><b>ซอย</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_guardian_addressRow['parent_soi']?>" readonly="readonly" required="required"></div><div><b>ตำบล</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $parent_tumbon->DISTRICT_NAME; ?>" readonly="readonly" required="required"><b>อำเภอ</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $parent_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required"><b>จังหวัด</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $parent_province->PROVINCE_NAME;?>" readonly="readonly" required="required"><b>รหัสไปรษณีย์</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_guardian_addressRow['parent_zipcode'];?>" readonly="readonly" required="required"></div><div><b>โทรศัพท์</b><input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_guardianRow['mother_phone'];?>" readonly="readonly" required="required"></div>
		 
		<div>
			<b>เกี่ยวข้องกับนักเรียนเป็น</b><input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $print_parent_status->dr_txt;?>" readonly="readonly" required="required">&nbsp;ขอมอบตัวนักเรียนไว้กับผู้บริหารโรงเรียนเรยีนาเชลีวิทยาลัย
		</div>
		  
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
			$mynameTh="เด็กหญิง ".$regina_stu_datarow["rsd_name"]." ".$regina_stu_datarow["rsd_surname"];			
		}elseif($regina_stu_datarow["rsd_prefix"]==4){
			$mynameTh="นางสาว ".$regina_stu_datarow["rsd_name"]." ".$regina_stu_datarow["rsd_surname"];			
		}else{
			$mynameTh=$regina_stu_datarow["rsd_name"]." ".$regina_stu_datarow["rsd_surname"];			
		}
		$mynameEn="Miss ".$regina_stu_datarow["rsd_nameEn"]." ".$regina_stu_datarow["rsd_surnameEn"];
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
<table width="1024" border="0">
  <tbody>
    <tr>
      <td>
		<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ชื่อนักเรียนภาษาไทย</b><input type="text" size="40" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $mynameTh;?>" readonly="readonly" required="required"><b>เลขบัตรประชาชน</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $regina_stu_datarow['rsd_Identification'];?>" readonly="readonly" required="required"></div>
		<div><b>ชื่อนักเรียนภาษาอังกฤษ</b><input type="text" size="40" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $mynameEn;?>" readonly="readonly" required="required">&nbsp;<b>วัน/เดือน/ปี เกิด</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo datethai($data_studentrow['stu_birth']);?>" readonly="readonly" required="required">&nbsp;<b>หมู่เลือด</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $data_studentrow['stu_blood'];?>" readonly="readonly" required="required"></div>
		<div><b>เชื่อชาติ</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_nation->nation_name_th;?>" readonly="readonly" required="required">&nbsp;<b>สัญชาติ</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_sun->nation_name_th;?>" readonly="readonly" required="required">&nbsp;<b>ศาสนา</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $Religion;?>" readonly="readonly" required="required">&nbsp;<b>ที่อยู่ปัจจุบัน เลขที่</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_addressRow['stu_hno'];?>" readonly="readonly" required="required">&nbsp;<b>หมู่ที่</b><input type="text" size="5" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_addressRow['stu_moo'];?>" readonly="readonly" required="required"></div>  
		<div><b>ถนน</b><input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_addressRow['stu_road'];?>" readonly="readonly" required="required">&nbsp;<b>ซอย</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_addressRow['stu_soi'];?>" readonly="readonly" required="required">&nbsp;<b>ตำบล</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_tumbon->DISTRICT_NAME;?>" readonly="readonly" required="required">&nbsp;<b>อำเภอ</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required"></div>  
		<div><b>จังหวัด</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_province->PROVINCE_NAME;?>" readonly="readonly" required="required">&nbsp;<b>รหัสไปรษณีย์</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_addressRow['stu_zipcode'];?>" readonly="readonly" required="required">&nbsp;<b>โทรศัพท์</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $data_studentrow["stu_phone"];?>" readonly="readonly" required="required"></div>
	 </td>
    </tr>
  </tbody>
</table>

<table width="1024" border="0">
  <tbody>
    <tr>
      <td>
		<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ชื่อบิดา</b><input type="text" size="40" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $myname_f;?>" readonly="readonly" required="required"><b>เลขบัตรประชาชน</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_fatherRow['father_code'];?>" readonly="readonly" required="required">&nbsp;<b>อาชีพ</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $Fcareer;?>" readonly="readonly" required="required"></div>
		
		<div><b>สถานที่ทำงาน</b><input type="text" size="40" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_fatherRow['father_workplace'];?>" readonly="readonly" required="required">&nbsp;<b>จังหวัด</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $father_addwordprovince->PROVINCE_NAME;?>" readonly="readonly" required="required">&nbsp;<b>โทรศัพท์ที่ทำงาน</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_fatherRow['father_wp_tel'];?>" readonly="readonly" required="required"></div>  
		<div><b>โทรศัพท์มือถือ</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="" readonly="readonly" required="required">&nbsp;<b>ที่อยู่ปัจจุบัน เลขที่</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_father_addressRow['father_hno'];?>" readonly="readonly" required="required">&nbsp;<b>หมู่ที่</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_father_addressRow['father_moo'];?>" readonly="readonly" required="required"><b>ถนน</b><input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_father_addressRow["father_road"];?>" readonly="readonly" required="required"></div>
		<div><b>ซอย</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_father_addressRow['father_soi'];?>" readonly="readonly" required="required">&nbsp;<b>ตำบล</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $father_tumbon->DISTRICT_NAME;?>" readonly="readonly" required="required">&nbsp;<b>อำเภอ</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $father_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required"><b>จังหวัด</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $father_province->PROVINCE_NAME;?>" readonly="readonly" required="required"></div>
		<div><b>รหัสไปรษณีย์</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_father_addressRow['father_zipcode'];?>" readonly="readonly" required="required">&nbsp;<b>โทรศัพท์</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_fatherRow['father_phone'];?>" readonly="readonly" required="required"></div>  
	  </td>
    </tr>
  </tbody>
</table>

<table width="1024" border="0">
  <tbody>
    <tr>
      <td>
		<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ชื่อมารดา</b><input type="text" size="40" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $myname_m;?>" readonly="readonly" required="required"><b>เลขบัตรประชาชน</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_motherRow['mother_code'];?>" readonly="readonly" required="required">&nbsp;<b>อาชีพ</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $Mcareer;?>" readonly="readonly" required="required"></div>
		<div><b>สถานที่ทำงาน</b><input type="text" size="40" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_motherRow['mother_workplace'];?>" readonly="readonly" required="required">&nbsp;<b>จังหวัด</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $mother_wordprovince->PROVINCE_NAME;?>" readonly="readonly" required="required">&nbsp;<b>โทรศัพท์ที่ทำงาน</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_motherRow['mother_wp_tel'];?>" readonly="readonly" required="required"></div>  
		<div><b>โทรศัพท์มือถือ</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="`" readonly="readonly" required="required">&nbsp;<b>ที่อยู่ปัจจุบัน เลขที่</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_mother_addressRow['mother_hno'];?>" readonly="readonly" required="required">&nbsp;<b>หมู่ที่</b><input type="text" size="10" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_mother_addressRow['mother_moo'];?>" readonly="readonly" required="required"><b>ถนน</b><input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_mother_addressRow["father_road"];?>" readonly="readonly" required="required"></div>
		<div><b>ซอย</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_mother_addressRow['mother_soi'];?>" readonly="readonly" required="required">&nbsp;<b>ตำบล</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $mother_tumbon->DISTRICT_NAME;?>" readonly="readonly" required="required">&nbsp;<b>อำเภอ</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $mother_amphur->AMPHUR_NAME; ?>" readonly="readonly" required="required"><b>จังหวัด</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $mother_province->PROVINCE_NAME; ?>" readonly="readonly" required="required"></div>
		<div><b>รหัสไปรษณีย์</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_mother_addressRow['mother_zipcode']; ?>" readonly="readonly" required="required">&nbsp;<b>โทรศัพท์</b><input type="text" size="20" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $stu_motherRow['mother_phone']; ?>" readonly="readonly" required="required"></div>  
	  </td>
    </tr>
  </tbody>
</table>


<br><center><table width="500" border="1" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td><div><center><b>สถานภาพบิดา-มารดา</b></center></div></td>
      
	<?php 	if ($stu_depend_stuRow['ds_FMstatus'] == '1') { ?>
		<td>
		<center><div>
		&nbsp;<font style="font-family: THSarabunNew; font-size: 24px"><img src="../../../../../Template/global_assets/images/f.JPG" width="11" height="11" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
		</div></center>
		<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
	  </td>
		
<?php		} else if ($stu_depend_stuRow['ds_FMstatus'] == '2') { ?>
		<td>
		<center><div>
		&nbsp;<font style="font-family: THSarabunNew; font-size: 24px"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/f.JPG" width="11" height="11" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
		</div></center>
		<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
	  </td>			
<?php		} else if ($stu_depend_stuRow['ds_FMstatus'] == '3') { ?>
		<td>
		<center><div>
		&nbsp;<font style="font-family: THSarabunNew; font-size: 24px"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/f.JPG" width="11" height="11" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
		</div></center>
		<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
	  </td>			
<?php		} else if ($stu_depend_stuRow['ds_FMstatus'] == '4') { ?>
		<td>
		<center><div>
		&nbsp;<font style="font-family: THSarabunNew; font-size: 24px"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
		</div></center>
		<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/f.JPG" width="11" height="11" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
	  </td>			
<?php		} else if ($stu_depend_stuRow['ds_FMstatus'] == '5') { ?>
		<td>
		<center><div>
		&nbsp;<font style="font-family: THSarabunNew; font-size: 24px"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
		</div></center>
		<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/f.JPG" width="11" height="11" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
	  </td>		
<?php		}else{ ?>
		<td>
		<center><div>
		&nbsp;<font style="font-family: THSarabunNew; font-size: 24px"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;อยู่ร่วมกัน&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;แยกกันอยู่&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;หย่าร้าง&nbsp;</font>  
		</div></center>
		<center><div>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;บิดาถึงแก่กรรม&nbsp;</font>&nbsp;<font style="font-family: THSarabunNew; font-size: 24px;"><img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;มารดาถึงแก่กรรม&nbsp;</font></div></center>
	  </td>				
<?php		} ?>	

    </tr>
  </tbody>
</table>
<p>
<table width="1024" border="0">
  <tbody>
    <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้ามีความประสงค์ที่จะให้บุตรสาวศึกษาต่อที่โรงเรียนเรยีนาเชลีวิทยาลัย และยินดีให้ความร่วมมือกับทางโรงเรียนในการส่งเสริม สนับสนุน ดูแลบุตรสาวทั้งด้านการเรียน ความประพฤติให้ปฏิบัติอยู่ในกฎระเบียบของโรงเรียน พร้อมกันนี้ข้าพเจ้าได้ชำระเงินยืนยันการมอบตัวนักเรียนเรียบร้อยแล้ว หากบุตรสาวของข้าพเจ้าสละสิทธิ์ไม่ว่ากรณีใดๆ ข้าพเจ้ายินดีมอบเงินทั้งหมดให้กับทางโรงเรียนเพื่อ สนับสนุนการศึกษาของโรงเรียนต่อไป</td>
    </tr>
  </tbody>
</table>
</p>

<table width="1024" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td width="428">
		<table width="428" border="1" cellpadding="0" cellspacing="0">
  			<tbody>
    			<tr>
			      <td width="424">
					<div id="fontA"><center><b>เอกสารประกอบการมอบตัวนักเรียน</b></center></div>
					<div id="fontA">&nbsp;<img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;สำเนาบัตรประชาชนนักเรียน จำนวน 1 ฉบับ</div>
					<div id="fontA">&nbsp;<img src="../../../../../Template/global_assets/images/t.JPG" width="11" height="11" alt=""/>&nbsp;สำเนาบัตรประชาชนบิดา หรือ มารดา หรือ ผู้ปกครอง จำนวน 1 ฉบับ</div>
				  </td>
			    </tr>
  			</tbody>
		</table>
	  </td>
	  
	  <td width="228">
	    <?php
			$qr_codefeeSql="SELECT`qr_name`,`amount` FROM `qr_codefee` WHERE `IDStudent`='{$stuID}';";
			$qr_codefee=new row_quotanotarray($qr_codefeeSql);
			foreach($qr_codefee->print_quotanotarray() as $qr_key=>$qr_codefeeRow){ ?>
		
	<?php
			if(isset($qr_codefeeRow["amount"])){ ?>
		<img src="../../../../qr_quota/<?php echo $next_year;?>/<?php echo $qr_codefeeRow["qr_name"];?>.png" style="width: 173px; height: 246px;" />			
	<?php	}else{ ?>
			
	<?php	} ?>
		
	
       
<?php	} ?>

	<?php
			if(isset($qr_codefeeRow["amount"])){ ?>
		<div><b>จำนวนเงิน <?php echo number_format($qr_codefeeRow["amount"] , 2 );?> บาท</b></div>			
	<?php	}else{ ?>
<br>			
<br>			
<br>			
<br>			
<br>
<br>			
<br>	
<br>
<br>		
	<?php	} ?>

		
	  </td>
	  
	  
	  
      <td width="457">
				<p><center><div>ลงชื่อ.............................................ผู้ปกครอง</div>
		<div>(....................................................)</div></center></p>
		  
		<p><center><div>ลงชื่อ.............................................ผู้รับเอกสาร</div>
		<div>(.....................................................)</div>
		<div>วันที่...........เดือน.....................พ.ศ............</div>
			</center></p>
		
	 </td>
    </tr>
  </tbody>
</table>	
	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
		if($key_key==12 or $key_key==13){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<br><br><br>
<table width="1024" border="0">
  <tbody>
    <tr>
      <td>
		<table width="163" border="1" align="right" cellpadding="0" cellspacing="0">
  			<tbody>
    			<tr>
      				<td><center>สำหรับเจ้าหน้าที่</center></td>
    			</tr>
  			</tbody>
		</table>

	  </td>
    </tr>
  </tbody>
</table>
<table width="1024" border="0">
  <tbody>
    <tr>
      <td><center><div><img src="../../../../../Template/global_assets/images/logo_rc.jpg" alt="โรงเรียนเรยีนาเชลีวิทยาลัย จังหวัดเชียงใหม่" width="99" height="103"  style="width: 85px; height: 89px;"/></div></center></td>
      <td>
		<center><div><b>ใบสมัครสอบคัดเลือกนักเรียนห้องเรียน สสวท. ระดับชั้น<?php echo $leve_name;?> ปีการศึกษา <?php echo $next_year;?></b></div>
		<div><b>โรงเรียนเรยีนาเชลีวิทยาลัย  จังหวัดเชียงใหม่</b></div></center>
	  </td>
    </tr>
  </tbody>
</table>

<table width="1024" border="0">
  <tbody>
    <tr>
      <td>
		<div><b>ข้าพเจ้า<input type="text" size="60" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $mynameTh;?>" readonly="readonly" required="required"></b>&nbsp;<b>เลขที่นั่งสอบ</b>....................................................</div>
		<div><b>เลขประจำตัว <input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $regina_stu_datarow["rsd_studentid"];?>" readonly="readonly" required="required"></b>&nbsp;<b>เลขประจำตัวประชาชน  <input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $regina_stu_datarow['rsd_Identification'];?>" readonly="readonly" required="required"></b></div>  
	  </td>
    </tr>
  </tbody>
</table>
<br><table width="1024" border="0">
  <tbody>
    <tr>
      <td><center><div>ขอสมัครสอบคัดเลือกห้องเรียน สสวท. ระดับชั้นมัธยมศึกษาปีที่ 1  ปีการศึกษา 2564</div>
		  <div>และจะปฏิบัติตาม กฎระเบียบทุกประการของการสอบทุกประการ</div></center>
	 </td>
    </tr>
  </tbody>
</table>
<br>
<table width="1024" border="0">
  <tbody>
    <tr>
      <td><center>
		<div>ลงชื่อ................................................</div>
		<div>(...................................................)</div>
		<div>ผู้สมัคร</div></center>
	  </td>
      <td>
		<center>
		<div>ลงชื่อ................................................</div>
		<div>(...................................................)</div>
		<div>เจ้าหน้าที่รับสมัคร</div></center>		
	  </td>
    </tr>
  </tbody>
</table>
<table width="1024" border="0">
  <tbody>
    <tr>
      <td>...........................................................................................................................................................................................................................................................</td>
    </tr>
  </tbody>
</table>
	
<br>
<table width="1024" border="0">
  <tbody>
    <tr>
      <td>
		<table width="163" border="1" align="right" cellpadding="0" cellspacing="0">
  			<tbody>
    			<tr>
      				<td><center>สำหรับนักเรียน</center></td>
    			</tr>
  			</tbody>
		</table>

	  </td>
    </tr>
  </tbody>
</table>
<table width="1024" border="0">
  <tbody>
    <tr>
      <td><center><div><img src="../../../../../Template/global_assets/images/logo_rc.jpg" alt="โรงเรียนเรยีนาเชลีวิทยาลัย จังหวัดเชียงใหม่" width="99" height="103"  style="width: 85px; height: 89px;"/></div></center></td>
      <td>
		<center><div><b>ใบสมัครสอบคัดเลือกนักเรียนห้องเรียน สสวท. ระดับชั้น<?php echo $leve_name;?> ปีการศึกษา <?php echo $next_year;?></b></div>
		<div><b>โรงเรียนเรยีนาเชลีวิทยาลัย  จังหวัดเชียงใหม่</b></div></center>
	  </td>
    </tr>
  </tbody>
</table>
<br>

<table width="1024" border="0">
  <tbody>
    <tr>
      <td><table width="60" border="0" align="right">
  			<tbody>
   			 <tr>
      			<td><center>
					<div><img src="<?php echo $user_img;?>" alt="กรอกรูป"  style="width: 120px; height: 148px;"/></div>
					<div>...........................................</div>
					<div>ลายมือชื่อนักเรียน</div>
					</center>
				</td>
    		</tr>
  			</tbody>
		</table>
	 </td>
    </tr>
  </tbody>
</table>
<table width="1024" border="0">
  <tbody>
    <tr>
      <td>
		<div><b>ข้าพเจ้า<input type="text" size="60" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $mynameTh;?>" readonly="readonly" required="required"></b>&nbsp;<b>เลขที่นั่งสอบ</b>....................................................</div>
		<div><b>เลขประจำตัว <input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $regina_stu_datarow["rsd_studentid"];?>" readonly="readonly" required="required"></b>&nbsp;<b>เลขประจำตัวประชาชน  <input type="text" size="30" style="font-family: THSarabunNew; font-size: 24px; text-align: center; border:0px; text-align: center; border:0px;" value="<?php echo $regina_stu_datarow['rsd_Identification'];?>" readonly="readonly" required="required"></b></div>  
	  </td>
    </tr>
  </tbody>
</table>
<br><table width="1024" border="0">
  <tbody>
    <tr>
      <td><center><div>ขอสมัครสอบคัดเลือกห้องเรียน สสวท. ระดับชั้นมัธยมศึกษาปีที่ 1  ปีการศึกษา 2564</div>
		  <div>และจะปฏิบัติตาม กฎระเบียบทุกประการของการสอบทุกประการ</div></center>
	 </td>
    </tr>
  </tbody>
</table>
<br>
<?php
if($key_key==12){ ?>
	<table width="1024" border="1" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td colspan="3"><div><b><u>กำหนดการ</u></b></div></td>
    </tr>
    <tr>
      <td><div><center><b>วัน/เดือน/ปี</b></center></div></td>
      <td><div><center><b>กำหนดการ</b></center></div></td>
      <td><div><center><b>สถานที่</b></center></div></td>
    </tr>
    <tr>
      <td><div>18 – 31 ส.ค. 63</div></td>
      <td><div>ยื่นใบสมัครสอบคัดเลือกนักเรียนห้องเรียน สสวท.</div></td>
      <td><div>ห้องประชาสัมพันธ์</div></td>
    </tr>
    <tr>
      <td><div>11 พ.ย. 63</div></td>
      <td><div>ตรวจสอบรายชื่อ เลขที่นั่งสอบ และสถานที่
สอบคัดเลือกนักเรียนห้องเรียน สสวท.
</div></td>
      <td><div>www.regina.ac.th</div></td>
    </tr>
    <tr>
      <td><div>19 ธ.ค. 63 เวลา 08.00-11.30 น.</div></td>
      <td><div>สอบคัดเลือกนักเรียนห้องเรียน สสวท.</div></td>
      <td><div>อาคารเซอร์เวียม</div></td>
    </tr>
    <tr>
      <td><div>23 ธ.ค. 63</div></td>
      <td><div>ประกาศผลการสอบคัดเลือกนักเรียนห้องเรียน สสวท.</div></td>
      <td><div>www.regina.ac.th</div></td>
    </tr>
    <tr>
	  <td><div><b><u>เนื้อหาที่สอบ</u></b></div></td>
      <td colspan="2"><div>ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ ภาษาอังกฤษ และความถนัดทางการเรียน (มิติสัมพันธ์)</div>
      				  <div>ระดับชั้นประถมศึกษาปีที่ 4-5 และประถมศึกษาปีที่ 6 (เฉพาะภาคเรียนที่ 1)</div></td>
    </tr>
  </tbody>
</table>

	
<?php }else{ ?>
	<table width="1024" border="1" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td colspan="3"><div><b><u>กำหนดการ</u></b></div></td>
    </tr>
    <tr>
      <td><div><center><b>วัน/เดือน/ปี</b></center></div></td>
      <td><div><center><b>กำหนดการ</b></center></div></td>
      <td><div><center><b>สถานที่</b></center></div></td>
    </tr>
    <tr>
      <td><div>18 – 31 ส.ค. 63</div></td>
      <td><div>ยื่นใบสมัครสอบคัดเลือกนักเรียนห้องเรียน สสวท.</div></td>
      <td><div>ห้องประชาสัมพันธ์</div></td>
    </tr>
    <tr>
      <td><div>11 พ.ย. 63</div></td>
      <td><div>ตรวจสอบรายชื่อ เลขที่นั่งสอบ และสถานที่
สอบคัดเลือกนักเรียนห้องเรียน สสวท.
</div></td>
      <td><div>www.regina.ac.th</div></td>
    </tr>
    <tr>
      <td><div>19 ธ.ค. 63 เวลา 08.00-11.30 น.</div></td>
      <td><div>สอบคัดเลือกนักเรียนห้องเรียน สสวท.</div></td>
      <td><div>อาคารเซอร์เวียม</div></td>
    </tr>
    <tr>
      <td><div>23 ธ.ค. 63</div></td>
      <td><div>ประกาศผลการสอบคัดเลือกนักเรียนห้องเรียน สสวท.</div></td>
      <td><div>www.regina.ac.th</div></td>
    </tr>
    <tr>
	  <td><div><b><u>เนื้อหาที่สอบ</u></b></div></td>
      <td colspan="2"><div>ความรู้วิชาคณิตศาสตร์ วิทยาศาสตร์ และภาษาอังกฤษ</div>
      				  <div>(เนื้อหาระดับชั้นมัธยมศึกษาปีที่ 1-2 และมัธยมศึกษาปีที่ 3 เฉพาะภาคเรียนที่ 1)</div></td>
    </tr>
  </tbody>
</table>	
<?php }      ?>
<table width="1024" border="0">
  <tbody>
    <tr>
      <td><div><center><b>*** กรุณานำบัตรนี้มาแสดงต่อเจ้าหน้าที่ในวันสอบด้วย ***</b></center></div></td>
    </tr>
  </tbody>
</table>

	
	
	
	
	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	}else{
		
	}
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
	
	
	
	
	
	
</body>
</html>





