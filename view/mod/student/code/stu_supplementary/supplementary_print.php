<?php
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_pdo.php");

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ใบชำระเงินค่าลงทะเบียนเรียน นอกตารางเรียน</title>
	
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
	<div id="p_echo">
		<button type="button" class="btn btn-default" onclick="window.print()">พิมพ์เอกสารใบมอบตัว</button>
		<font color="#F70105"><p><b>ระบบการพิมพ์เอกสารใบมอบตัว ระบบจะรองรับ เว็บเบราว์เซอร์  Google Chrome และ  Microsoft Edge<b></p></font>
	</div>	
</head>

<body style="width: 1024px;"  border="0" cellpadding="0" cellspacing="0">

<?php
	$data_yaer=filter_input(INPUT_POST,'data_yaer');
	$data_term=filter_input(INPUT_POST,'data_term');
	$user_login=filter_input(INPUT_POST,'user_login');
	
	/*$data_yaer=2563;
	$data_term=1;
	$user_login=14860;*/
	//**********************************************	
	$pay_fresh31=0;
	$pat_fresh32=0;
	$pat_fresh33=0;
	$pay_fresh41=0;
	$pay_fresh42=0;
	$pay_fresh43=0;
	
	$stu_not=filter_input(INPUT_POST,'stu_not');
	
	//**********************************************
	$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
	$stu_data=new regina_stu_data($user_login);

	/*if(file_exists("http://www.regina.ac.th/programming/evaluation_rc/view/all/$user_login.jpg")){
				$user_img="http://www.regina.ac.th/programming/evaluation_rc/view/all/$user_login.jpg";
			}else{
				if(file_exists("http://www.regina.ac.th/programming/evaluation_rc/view/all/$user_login.JPG")){
					$user_img="http://www.regina.ac.th/programming/evaluation_rc/view/all/$user_login.JPG";
				}else{
					$user_img="http://www.regina.ac.th/programming/evaluation_rc/view/all/newimg_rc.jpg";
				}
			}*/
	
?>

<table style="width: 1024px;" border="0">
  <tbody>
    <tr>
      <td><img src="../../../../../Template/global_assets/images/logoserviam.png" width="90" height="79" alt=""/></td>
   	  <td>
		  <center>
	  		<div><b>ใบลงทะเบียน  เรียนเสริมนอกเวลาเรียน &nbsp;&nbsp;ภาคเรียนที่&nbsp;<?php echo $data_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_yaer;?>&nbsp;</b></div>
	  		<div><b>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;&nbsp;จังหวัดเชียงใหม่</b></div>			
		  </center>
  	  </td>
	  <td>
			<div><font color="#FA0408"><b>สำหรับชำระค่าลงทะเบียนที่ห้องการเงิน</b></font></div>
	  </td>
    </tr>
  </tbody>
</table><br>
<table style="width: 1024px;" border="0">
  <tbody>
    <tr>
      <td>
		<div>รหัสประจำตัวนักเรียน&nbsp;<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 28px; border:0px;" size="10" value="<?php echo $data_stu->rsd_studentid;?>">&nbsp;ชื่อ-สกุล&nbsp;<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 28px; border:0px;" size="48" value="<?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?>">&nbsp;ชั้น&nbsp;<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 28px; border:0px;" size="5" value="<?php echo $data_stu->Sort_name;?>">&nbsp;</div>
		<div>ห้อง&nbsp;<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 28px; border:0px;" size="5" value="<?php echo $data_stu->rsc_room;?>">&nbsp;แผนการเรียน<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 28px; border:0px;" value="<?php echo $data_stu->planname;?>">&nbsp;</div>
	  </td>
    </tr>
  </tbody>
</table>


<?php
		if($stu_not=="stu_not"){
			if($data_stu->IDLevel==31){
				if($data_stu->rc_plan==12){ ?>
				
			<center><table style="width: 900px;" border="1" cellpadding="0" cellspacing="0">
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
				
			<center><table style="width: 900px;" border="1" cellpadding="0" cellspacing="0">
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
					
			<center><table style="width: 900px;" border="1" cellpadding="0" cellspacing="0">
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
					
			<center><table style="width: 900px;" border="1" cellpadding="0" cellspacing="0">
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
			
<p><table style="width: 1024px; text-align: right;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td>
		<div align="right">ลงชื่อ ผู้ปกครอง______________________</div>
		<div align="right">ลงชื่อผู้รับเงิน_________________________</div>
		<div align="right">วันที่รับเงิน___________________________</div>
	  </td>
    </tr>
  </tbody>
</table></p>	

<table style="width: 1024px;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td>
		<div><center>-------------------------------------------------------------------------ฉีกตามรอยปะ--------------------------------------------------------------------</center></div>
	  </td>
    </tr>
  </tbody>
</table>		
			
<table style="width: 1024px;" border="0">
  <tbody>
    <tr>
      <td><img src="../../../../../Template/global_assets/images/logoserviam.png" width="90" height="79" alt=""/></td>
   	  <td>
		  <center>
	  		<div><b>ใบลงทะเบียน  เรียนเสริมนอกเวลาเรียน &nbsp;&nbsp;ภาคเรียนที่&nbsp;<?php echo $data_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_yaer;?>&nbsp;</b></div>
	  		<div><b>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;&nbsp;จังหวัดเชียงใหม่ (สำหรับชำระค่าลงทะเบียนที่ห้องการเงิน)</b></div>			
		  </center>
  	  </td>
	  <td>
		<div><font color="#FA0408"><b>สำหรับชำระค่าลงทะเบียนที่ห้องการเงิน</b></font></div>
	  </td>
    </tr>
  </tbody>
</table><br>
<table style="width: 1024px;" border="0">
  <tbody>
    <tr>
      <td>
		<div>รหัสประจำตัวนักเรียน&nbsp;<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 28px; border:0px;" size="10" value="<?php echo $data_stu->rsd_studentid;?>">&nbsp;ชื่อ-สกุล&nbsp;<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 28px; border:0px;" size="48" value="<?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?>">&nbsp;ชั้น&nbsp;<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 28px; border:0px;" size="5" value="<?php echo $data_stu->Sort_name;?>">&nbsp;</div>
		<div>ห้อง&nbsp;<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 28px; border:0px;" size="5" value="<?php echo $data_stu->rsc_room;?>">&nbsp;แผนการเรียน<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 28px; border:0px;" value="<?php echo $data_stu->planname;?>">&nbsp;</div>
	  </td>
    </tr>
  </tbody>
</table>		

	<?php	if($data_stu->IDLevel==31){
				if($data_stu->rc_plan==12){ ?>
				
			<center><table style="width: 900px;" border="1" cellpadding="0" cellspacing="0">
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
				
			<center><table style="width: 900px;" border="1" cellpadding="0" cellspacing="0">
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
					
			<center><table style="width: 900px;" border="1" cellpadding="0" cellspacing="0">
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
					
			<center><table style="width: 900px;" border="1" cellpadding="0" cellspacing="0">
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
			
<p><table style="width: 1024px; text-align: right;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td>
		<div align="right">ลงชื่อ ผู้ปกครอง______________________</div>
		<div align="right">ลงชื่อผู้รับเงิน_________________________</div>
		<div align="right">วันที่รับเงิน___________________________</div>
	  </td>
    </tr>
  </tbody>
</table></p>			
			
			
<?php	}else{ ?>
		
<p><table style="width: 1024px;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td><center><b><u>ตารางเรียนเสริมนอกเวลาเรียน</u></b></center></td>
    </tr>
  </tbody>
</table></p>
<center><table style="width: 900px;"  border="1" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <th>ลำดับ</th>

      <th>วิชา</th>
      <th>วันที่เรียน</th>
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
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
												$sum_pay=$sum_pay-$pay_fresh42;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;											
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
												$sum_pay=$sum_pay-$pay_fresh42;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
												$sum_pay=$sum_pay-$pay_fresh42;																						
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
												$sum_pay=$sum_pay-$pay_fresh42;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;
											}
										

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh43;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;											
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh43;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
												$sum_pay=$sum_pay-$pay_fresh43;																						
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+@$set_payB;
												$sum_pay=$sum_pay-$pay_fresh43;												
											}else{
												$sum_pay=($set_payA*$count_academic)+@$set_payB;
											}
										

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
</table></center>
<p><table style="width: 1024px; text-align: right;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td>
		<div align="right">ลงชื่อ ผู้ปกครอง______________________</div>
		<div align="right">ลงชื่อผู้รับเงิน_________________________</div>
		<div align="right">วันที่รับเงิน___________________________</div>
	  </td>
    </tr>
  </tbody>
</table></p>
<table style="width: 1024px;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td>
		<div><center>-------------------------------------------------------------------------ฉีกตามรอยปะ--------------------------------------------------------------------</center></div>
	  </td>
    </tr>
  </tbody>
</table>
<table style="width: 1024px;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td><img src="../../../../../Template/global_assets/images/logoserviam.png" width="90" height="79" alt=""/></td>
   	  <td>
		  <center>
	  		<b><div>ใบลงทะเบียน  เรียนเสริมนอกเวลาเรียน &nbsp;&nbsp;ภาคเรียนที่&nbsp;<?php echo $data_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_yaer;?>&nbsp;</div>
	  		<div>โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;&nbsp;จังหวัดเชียงใหม่</div></b>			
		  </center>
  	  </td>
	  <td>
		<div><font color="#FA0408"><b>สำหรับนักเรียน</b></font></div>
	  </td>
    </tr>
  </tbody>
</table>
<br>
<table style="width: 1024px;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td>
		<div>รหัสประจำตัวนักเรียน&nbsp;<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 28px; border:0px;" size="10" value="<?php echo $data_stu->rsd_studentid;?>">&nbsp;ชื่อ-สกุล&nbsp;<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 28px; border:0px;" size="48" value="<?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?>">&nbsp;ชั้น&nbsp;<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 28px; border:0px;" size="5" value="<?php echo $data_stu->Sort_name;?>">&nbsp;</div>
		<div>ห้อง&nbsp;<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 28px; border:0px;" size="5" value="<?php echo $data_stu->rsc_room;?>">&nbsp;แผนการเรียน<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 28px; border:0px;" value="<?php echo $data_stu->planname;?>">&nbsp;</div>
	  </td>
    </tr>
  </tbody>
</table>
<p><table style="width: 1024px;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
		<td><center><b><u>ตารางเรียนเสริมนอกเวลาเรียน</u></b></center></td>
    </tr>
  </tbody>
</table></p>
<center><table style="width: 900px;" border="1" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <th>ลำดับ</th>

      <th>วิชา</th>
      <th>วันที่เรียน</th>
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
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
											$sum_pay=($set_payA*$count_academic)+$set_payB;
											$sum_pay=$sum_pay-$pay_fresh31;
											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh41;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;											
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh42;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;											
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh42;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
												$sum_pay=$sum_pay-$pay_fresh42;																						
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
												$sum_pay=$sum_pay-$pay_fresh42;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;
											}
										

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh43;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;											
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+$set_payB;
												$sum_pay=$sum_pay-$pay_fresh43;												
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
												$sum_pay=$sum_pay-$pay_fresh43;																						
											}else{
												$sum_pay=($set_payA*$count_academic)+$set_payB;												
											}

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
										
											if($count_academic>=5){
												$sum_pay=($set_payA*$count_academic)+@$set_payB;
												$sum_pay=$sum_pay-$pay_fresh43;												
											}else{
												$sum_pay=($set_payA*$count_academic)+@$set_payB;
											}
										

											
										?>
							
											<tr>
												<td colspan="2"><center>รวม</center></td>
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
</table></center>
	
			
		
<?php	}  ?>


	
</body>
</html>