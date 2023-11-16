<?php
	include("../../../../database/database_evaluation.php");
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");

	$txt_year=post_data(filter_input(INPUT_GET,'txt_year'));
	$txt_class=post_data(filter_input(INPUT_GET,'txt_class'));
	$txt_room=post_data(filter_input(INPUT_GET,'txt_room'));
	
	$txt_year=base64_decode($txt_year);
	$txt_class=base64_decode($txt_class);
	$txt_room=base64_decode($txt_room);




	$txt_t=substr($txt_year,0,1);
	$txt_y=substr($txt_year,2,4);

	$txt_level=new print_level($txt_class);
?>

<?php
// Require composer autoload
require_once __DIR__ . '/../../../../js_css_code/mpdf-5.7-php7-master/vendor/autoload.php';

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/tmp',
    'fontdata' => $fontData + [
            'sarabun' => [
                'R' => 'THSarabunNew.ttf',
                'I' => 'THSarabunNewItalic.ttf',
                'B' =>  'THSarabunNewBold.ttf',
                'BI' => "THSarabunNewBoldItalic.ttf",
            ]
        ],
    'format' => 'A4',
    'margin_left' => 1,
    'margin_right' => 1,
    'margin_top' => 1,
    'margin_bottom' => 1,
    'margin_header' => 1,
    'margin_footer' => 1,		
		
]);

ob_start(); // Start get HTML code
?>


<!--****************************************************************************-->	
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>รูปนักเรียนแยกห้อง</title>
  <style>
@charset "UTF-8";
@font-face {
    font-family: 'THSarabunNew';
    src: url('../../../../font/thsarabunnew-webfont.eot');
    src: url('../../../../font/thsarabunnew-webfont.eot?#iefix') format('embedded-opentype'),
url('../../../../font/thsarabunnew-webfont.woff') format('woff'),
url('../../../../font/THSarabunNew.ttf') format('truetype');
}

	body{
		font-family: "sarabun";
		font-size: 28px;
		color: #110001;
	}
	  
	small{
		font-family: "sarabun";
		font-size: 18px;
		color: #110001;		  
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

	
	
	
<button type="button" class="btn btn-default" onclick="window.print()">พิมพ์รูปนักเรียน</button>
<a href="print_sutroom.pdf"><button type="button" class="btn btn-default">โหลดรูปนักเรียน</button></a>	
<div id="p_echo" ><font color="#F70105"><p><b>ระบบการพิมพ์รูปนักเรียน ระบบจะรองรับ เว็บเบราว์เซอร์  Google Chrome และ  Microsoft Edge</b></p></font></div>	

	

<body  onload="location.href=\'print_sutroom.pdf\'">

<table style="width: 1024px;" border="0">
  <tbody>
    <tr>
      <td  colspan="5">
		  <div>
		  	<center><img src="../../../../../Template/global_assets/images/logoserviam.png" width="96" height="91"></center> 
		  </div>
		  <div><center>รูปนักเรียน  ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></center></div>
	  </td>
    </tr>	 
	<tr>
	  <td colspan="5">
		  <div>
		  	<center>หน้าที่ 1</center> 
		  </div>	  
	  </td>	
	</tr>	
    <tr>	  
	<?php			
		$data_sturcroom=new data_sturoom($txt_t,$txt_y,$txt_class,$txt_room);
	  	$count_img=0;
		$count_print=0;
		$count_p=1;
		foreach($data_sturcroom->printdata_sturoom as $rc_key=>$sturcroom_rom){ 
			$rsc_num=$sturcroom_rom["rsc_num"];
			$rsd_studentid=$sturcroom_rom["rsd_studentid"];
			$name_th=$sturcroom_rom["rsd_name"]." ".$sturcroom_rom["rsd_surname"];
			$rsd_Identification=$sturcroom_rom["rsd_Identification"];
			$data_prefix=new print_prefix($rsd_prefix=$sturcroom_rom["rsd_prefix"]);
			$data_plan=new print_plan($rsc_plan=$sturcroom_rom["rsc_plan"]);
		$count_img=$count_img+1;
		$count_print=$count_print+1;	
			/*if(file_exists("../../../../all/$rsd_studentid.jpg")){
				$user_img="../../../../all/$rsd_studentid.jpg";
			}else{
				if(file_exists("../../../../all/$rsd_studentid.JPG")){
					$user_img="../../../../all/$rsd_studentid.JPG";
				}else{
					$user_img="../../../../all/newimg_rc.jpg";
				}
			}*/
			
				if(file_exists("../../../../all/$rsd_studentid.JPG")){
					$user_img="../../../../all/$rsd_studentid.JPG";
				}else{
					$user_img="../../../../all/newimg_rc.jpg";
				}			
			
		if($count_img%5==0){ ?>
		
		
      <td>
		  <div><center><img src="<?php echo $user_img;?>" style="width: 304 px; height: 236px;" alt=""/></center></div>
		  <div><center><small><?php echo $rsd_studentid;?> - <?php echo $name_th;?></small></center></div>
	  </td>
    </tr>
	<?php
			if($count_print%20==0){
				$count_p=$count_p+1;
		?>
		
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>	
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>	
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>	
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>	
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>	 
    <tr>
      <td  colspan="5">
		  <div>
		  	<center><img src="../../../../../Template/global_assets/images/logoserviam.png" width="96" height="91"></center> 
		  </div>
		  <div><center>รูปนักเรียน  ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></center></div>
	  </td>
    </tr>	
	<tr>
	  <td colspan="5">
		  <div>
		  	<center>หน้าที่ <?php echo $count_p;?></center> 
		  </div>	  
	  </td>	
	</tr>
	<?php	}else{
				
			}
	?>
	<tr>  
<?php	}else{ ?>
      <td>
		  <div><center><img src="<?php echo $user_img;?>" style="width: 304 px; height: 236px;" alt=""/></center></div>
		  <div><center><small><?php echo $rsd_studentid;?> - <?php echo $name_th;?></small></center></div>
	  </td>			
<?php	}	
	} ?>	  
	  
	  
  </tbody>
</table>

</body>
</html>
<?php
	$html = ob_get_contents();
	//$mpdf->AddPage('L');
	$mpdf->charset_in='windows-1252';
	$mpdf->WriteHTML($html);
	$mpdf->Output("print_sutroom.pdf");
    ob_end_flush();
?>
<?php exit("<script>window.location='print_sutroom.pdf';</script>");?>