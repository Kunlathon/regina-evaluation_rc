<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>แบบแจ้งความจำนงเข้าศึกษา</title>
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
		font-size: 25px; 

		background: white;
		
	}
	
	#fontA{
		font-family: "THSarabunNew";
		font-size: 16px; 

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
<?php
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	include("../../../../database/pdo_data.php");
	include("../../../../database/pdo_quota.php");	
	include("../../../../database/pdo_conndatastu.php");
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	include("../../../../database/class_pdodatastu.php");	
	include("../../../../database/class_quota.php");
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$print_key=filter_input(INPUT_POST,'print_key');
	$print_year=filter_input(INPUT_POST,'print_year');
	$print_yearnew=filter_input(INPUT_POST,'print_yearnew');
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
			$mynameTh="เด็กหญิง ".$regina_stu_datarow["rsd_name"]." ".$regina_stu_datarow["rsd_surname"];			
		}elseif($regina_stu_datarow["rsd_prefix"]==4){
			$mynameTh="นางสาว ".$regina_stu_datarow["rsd_name"]." ".$regina_stu_datarow["rsd_surname"];			
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
	$myname_p=$p_np->prefix_prefixname." ".$isr_quota_name." ".$isr_quota_surname;	
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$print_parent_status=new data_rely ($isr_quota_relationship);	
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
?>

	<br>
	<br>
	<table style="width: 1024px; vertical-align: top;"  border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td style="font-size: 25px; text-align: center; font-family: THSarabunNew;">
					<img src="../../../../../Template/global_assets/images/logo_rc.jpg" alt="โรงเรียนเรยีนาเชลีวิทยาลัย จังหวัดเชียงใหม่" width="99" height="103"  style="width: 85px; height: 89px;"/>
				</td>
			</tr>
			<tr>
				<td style="font-size: 30px; text-align: center; font-family: THSarabunNew;">
					<div><b>แบบแจ้งความจำนง</b></div>
					<div><b>เข้าศึกษาต่อในระดับชั้น<?php echo $class_new_txt;?> ปีการศึกษา <?php echo $next_yaer;?> (รอบโควตาภายใน)</b></div>
					<div><b>โรงเรียนเรยีนาเชลีวิทยาลัย จังหวัดเชียงใหม่</b></div>
				</td>
			</tr>			
		</tbody>
	</table>	
	<br>
	<table style="width: 1024px; vertical-align: top;"  border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div style="font-size: 25px;font-family: THSarabunNew;">
					ข้าพเจ้า<input type="text" size="40" style="font-family: THSarabunNew; font-size: 25px; text-align: center; border:0px; text-align: center; border:0px; " value="<?php echo $myname_p;?>" readonly="readonly" required="required"/>ผู้ปกครองของ<input type="text" size="40" style="font-family: THSarabunNew; font-size: 25px; text-align: center; border:0px; text-align: center; border:0px; " value="<?php echo $mynameTh;?>" readonly="readonly" required="required"/>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div style="font-size: 25px;font-family: THSarabunNew;">
					ชั้น<input type="text" size="20" style="font-family: THSarabunNew; font-size: 25px; text-align: center; border:0px; text-align: center; border:0px; " value="<?php echo $call_stu->Sort_name."/".$call_stu->rsc_room;?>" readonly="readonly" required="required"/>เลขประจำตัว<input type="text" size="20" style="font-family: THSarabunNew; font-size: 25px; text-align: center; border:0px; text-align: center; border:0px; " value="<?php echo $regina_stu_datarow["rsd_studentid"];?>" readonly="readonly" required="required"/>เลขประจำตัวประชาชน<input type="text" size="20" style="font-family: THSarabunNew; font-size: 25px; text-align: center; border:0px; text-align: center; border:0px; " value="<?php echo $regina_stu_datarow['rsd_Identification'];?>" readonly="readonly" required="required"/>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div style="font-size: 25px;font-family: THSarabunNew;">
					ความสัมพันธ์กับนักเรียน<input type="text" size="20" style="font-family: THSarabunNew; font-size: 25px; text-align: center; border:0px; text-align: center; border:0px; " value="<?php echo $print_parent_status->dr_txt;?>" readonly="readonly" required="required"/>เบอร์โทรศัพท์ <input type="text" size="20" style="font-family: THSarabunNew; font-size: 25px; text-align: center; border:0px; text-align: center; border:0px; " value="<?php echo $isr_quota_phone;?>" readonly="readonly" required="required"/>
					</div>
				</td>
			</tr>			
		</tbody>
	</table>	
	<br>
	<table style="width: 1024px; vertical-align: top;"  border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div style="font-size: 25px;font-family: THSarabunNew;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้าได้รับทราบและพิจารณาสิทธิ์โควตาเข้าศึกษาต่อในระดับ<?php echo $class_new_txt;?> ปีการศึกษา <?php echo $next_yaer;?> โรงเรียนเรยีนาเชลีวิทยาลัย ร่วมกับนักเรียนในความปกครองของข้าพเจ้าแล้ว&nbsp;
					</div>
				</td>
			</tr>
			
		</tbody>
	</table>	
	<br>
	<table style="width: 1024px;"  border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td style="width: 112px; vertical-align: top;">
					<div style="font-size: 25px;font-family: THSarabunNew;">
					มีความประสงค์
					</div>
				</td>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if($isr_MaintainRights=="รักษาสิทธิ์"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<td style="width: 250px; vertical-align: top;">
					<div style="font-size: 25px;font-family: THSarabunNew;">
					<img src="../../../../../Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;รักษาสิทธิ์&nbsp;(โปรดเลือก 1 ข้อ)
					</div>				
				</td>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<td style="width: 250px; vertical-align: top;">
					<div style="font-size: 25px;font-family: THSarabunNew;">
					<img src="../../../../../Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;รักษาสิทธิ์&nbsp;(โปรดเลือก 1 ข้อ)
					</div>				
				</td>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
				
				<td style="width: 674px; vertical-align: top;" >
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php
			if($call_stu->IDLevel==23){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if($isr_PlanNew==12){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;ห้องเรียนวิทยาศาสตร์ - คณิตศาสตร์ (สสวท.)&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}else{ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;ห้องเรียนวิทยาศาสตร์ - คณิตศาสตร์ (สสวท.)&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if($isr_PlanNew==2){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;ห้องเรียนปกติ&nbsp;
					</div>		
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}else{ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;ห้องเรียนปกติ&nbsp;
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
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน วิทยาศาสตร์ - คณิตศาสตร์ (สสวท.)&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}else{ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน วิทยาศาสตร์ - คณิตศาสตร์ (สสวท.)&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if($isr_PlanNew==3){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน วิทยาศาสตร์ – คณิตศาสตร์&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}else{ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน วิทยาศาสตร์ – คณิตศาสตร์&nbsp;
					</div>		
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if($isr_PlanNew==4){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียนภาษาอังกฤษ – คณิตศาสตร์&nbsp;(ศิลป์ - คำนวณ)&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}else{ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – คณิตศาสตร์&nbsp;(ศิลป์ - คำนวณ)&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if($isr_PlanNew==5){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาฝรั่งเศส&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}else{ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาฝรั่งเศส&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if($isr_PlanNew==6){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาญี่ปุ่น&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}else{ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียนภาษาอังกฤษ – ภาษาญี่ปุ่น&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if($isr_PlanNew==7){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาจีน&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}else{ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาจีน&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if($isr_PlanNew==11){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาอังกฤษ&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}else{ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ภาษาอังกฤษ – ภาษาอังกฤษ&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if($isr_PlanNew==15){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ศิลป์อาชีพ - ศิลปะการอาหารและการจัดการ&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}else{ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ศิลป์อาชีพ - ศิลปะการอาหารและการจัดการ&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if($isr_PlanNew==16){ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ศิลป์อาชีพ - การจัดการธุรกิจบริการสุขภาพและผลิตภัณฑ์สมุนไพร&nbsp;
					</div>	
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}else{ ?>
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div style="font-size: 25px;font-family: THSarabunNew;">
						<img src="../../../../../Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;แผนการเรียน ศิลป์อาชีพ - การจัดการธุรกิจบริการสุขภาพและผลิตภัณฑ์สมุนไพร&nbsp;
					</div>		
	<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php	}?>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php	}else{
//------------------------------------------------------------------------------
			}	?>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
				</td>							
			</tr>
			<tr>
				<td style="width: 112px; vertical-align: top;">	
					<div style="font-size: 25px;font-family: THSarabunNew;">
						
					</div>	
				</td>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				if($isr_MaintainRights=="สละสิทธิ์"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<td style="width: 250px; vertical-align: top;">
					<div style="font-size: 25px;font-family: THSarabunNew;">
					<img src="../../../../../Template/global_assets/images/f.JPG" width="22" height="22" alt=""/>&nbsp;สละสิทธิ์&nbsp;เนื่องจาก
					</div>				
				</td>						
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<td style="width: 250px; vertical-align: top;">
					<div style="font-size: 25px;font-family: THSarabunNew;">
					<img src="../../../../../Template/global_assets/images/t.JPG" width="22" height="22" alt=""/>&nbsp;สละสิทธิ์&nbsp;เนื่องจาก
					</div>				
				</td>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	} ?>
			<td style="width: 674px; vertical-align: top;">	
				<div style="font-size: 25px;font-family: THSarabunNew;">
				<?php echo $isr_MaintainRightsTxT;?>
				</div>	
			</td>			
		</tr>			
		</tbody>
	</table>	

	
	<br>	
	<table style="width: 1024px;"  border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div style="font-size: 25px;font-family: THSarabunNew;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้าขอรับรองว่าข้อมูลตามที่ได้แจ้งในเอกสารฉบับนี้เป็นจริงทุกประการ
					</div>
				</td>
			</tr>
			
		</tbody>
	</table>
	
	
	<br><br>	
	<table style="width: 1024px; vertical-align: top;"  border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td style="width: 512px;"></td>
				<td style="width: 512px;">
					<div style="font-size: 25px;font-family: THSarabunNew; text-align: center;">
						ลงชื่อ<input type="text" size="40" style="font-family: THSarabunNew; font-size: 25px; text-align: center; border:0px; text-align: center; border:0px; " value="<?php echo $myname_p;?>" readonly="readonly" required="required"/>ผู้ปกครอง
					</div>
				</td>
			</tr>
			<tr>
				<td style="width: 512px;"></td>
				<td style="width: 512px;">
					<div style="font-size: 25px;font-family: THSarabunNew; text-align: center;">
						วันที่<input type="text" size="20" style="font-family: THSarabunNew; font-size: 25px; text-align: center; border:0px; text-align: center; border:0px; " value="<?php echo datethai($print_data);?>" readonly="readonly" required="required"/>
					<div>
				</td>
			</tr>			
		</tbody>
	</table>	
	
</body>
</html>





