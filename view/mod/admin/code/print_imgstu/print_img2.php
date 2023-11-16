<?php
	$set_stuid=filter_input(INPUT_GET,'set_stuid');
	$set_stuid=base64_decode($set_stuid);
	
	if(file_exists("../../../../all/$set_stuid.JPG")){
		$dataall_img="../../../../all/$set_stuid.JPG";
	}else{
		$dataall_img="../../../../all/newimg_rc.jpg";
	}	
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
    'format' => 'A4-L',
    'margin_left' => 5,
    'margin_right' => 5,
    'margin_top' => 5,
    'margin_bottom' => 5,
    'margin_header' => 5,
    'margin_footer' => 5,		
		
]);

ob_start(); // Start get HTML code
?>


<!DOCTYPE html>
<html>
<head>
<title>PDF</title>

<style>
	body{
    	font-family: sarabun;
	}
	
	body.mobile div#logo {

		text-align: center;

	}

	body.desktop div#logo {

		text-align: left;

	}	
	
</style>
	
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
		size: A5;
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
	<p>ดาวโหลดรายงานในรูปแบบ PDF <a href="stuimg1.pdf">คลิกที่นี้</a></p>
	<p>พิมพ์รูบนักเรียน <a href="#" onclick="window.print()">คลิกที่นี้</a> <font color="#F70105"><b>ระบบการพิมพ์เอกสารใบมอบตัว ระบบจะรองรับ เว็บเบราว์เซอร์  Google Chrome และ  Microsoft Edge<b></font></p>
</div>
<body style="auto;">



	
<table width="1024"  border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td>
		<table width="1024" border="0">
		  <tbody>
			<tr>
			  <td>&nbsp;&nbsp;<img src="<?php echo $dataall_img;?>" style="width: 600px ; height: 800px;" />&nbsp;&nbsp;</td>
			  <td>&nbsp;&nbsp;<img src="<?php echo $dataall_img;?>" style="width: 600px ; height: 800px;" />&nbsp;&nbsp;</td>
			  <td>&nbsp;&nbsp;<img src="<?php echo $dataall_img;?>" style="width: 600px ; height: 800px;" />&nbsp;&nbsp;</td>
			  <td>&nbsp;&nbsp;<img src="<?php echo $dataall_img;?>" style="width: 600px ; height: 800px;" />&nbsp;&nbsp;</td>
			</tr>
			<tr>
			  <td>&nbsp;&nbsp;<img src="<?php echo $dataall_img;?>" style="width: 600px ; height: 800px;" />&nbsp;&nbsp;</td>
			  <td>&nbsp;&nbsp;<img src="<?php echo $dataall_img;?>" style="width: 600px ; height: 800px;" />&nbsp;&nbsp;</td>
			  <td>&nbsp;&nbsp;<img src="<?php echo $dataall_img;?>" style="width: 600px ; height: 800px;" />&nbsp;&nbsp;</td>
			  <td>&nbsp;&nbsp;<img src="<?php echo $dataall_img;?>" style="width: 600px ; height: 800px;" />&nbsp;&nbsp;</td>

			</tr>
			<tr>
			  <td>&nbsp;&nbsp;<img src="<?php echo $dataall_img;?>" style="width: 600px ; height: 800px;" />&nbsp;&nbsp;</td>
			  <td>&nbsp;&nbsp;<img src="<?php echo $dataall_img;?>" style="width: 600px ; height: 800px;" />&nbsp;&nbsp;</td>
			  <td>&nbsp;&nbsp;<img src="<?php echo $dataall_img;?>" style="width: 600px ; height: 800px;" />&nbsp;&nbsp;</td>
			  <td>&nbsp;&nbsp;<img src="<?php echo $dataall_img;?>" style="width: 600px ; height: 800px;" />&nbsp;&nbsp;</td>

			</tr>			  
		  </tbody>
		</table>

	  </td>
    </tr>
  </tbody>
</table>
</body>
</html>




<?php
	$html = ob_get_contents();
	//$mpdf->AddPage('');
	$mpdf->WriteHTML($html);
	$mpdf->Output("stuimg2.pdf");
    ob_end_flush()
?>

<?php //exit("<script>window.location='stuimg2.pdf';</script>");?>



