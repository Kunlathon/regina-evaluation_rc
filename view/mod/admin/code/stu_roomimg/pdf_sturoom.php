<?php
// Require composer autoload
require_once __DIR__ . '/../../../../js_css_code/mpdf-5.7-php7-master/vendor/autoload.php';

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/../../../../js_css_code/mpdf-5.7-php7-master/tmp',
    'fontdata' => $fontData + [
            'sarabun' => [  
                'R' => 'THSarabunNew.ttf',
                'I' => 'THSarabunNewItalic.ttf',
                'B' =>  'THSarabunNewBold.ttf',
                'BI' => "THSarabunNewBoldItalic.ttf",
            ]
        ],
]);

ob_start(); // Start get HTML code
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>
	body{
		font-family: sarabun;
	}
	td, th{
  		border: 1px solid #dddddd;
  		text-align: left;
  		padding: 5px;		
	}   		
	tr:nth-child(even) {
  		background-color: #dddddd;
	}
</style>
</head>

<body>

	<h1>ตัวอย่างในการเก็บโค้ด HTML มาเป็น PDF</h1>
<table width="100%">
  <tr>
    <th>ชื่อ</th>
    <th>ที่อยู่</th>
    <th>ประเทศ</th>
  </tr>
  <tr>
    <td>น้องไก่ คนงาม</td>
    <td>นายบ้าน บ้าน</td>
    <td>ไทย</td>
  </tr>
  <tr>
    <td>นายรักเรียน</td>
    <td>Francisco Chang</td>
    <td>Mexico</td>
  </tr>
  <tr>
    <td>นายรักดี</td>
    <td>Roland Mendel</td>
    <td>Austria</td>
  </tr>
</table>
	
</body>
</html>
<?php

$html = ob_get_contents();

  


$mpdf->WriteHTML($html);

$mpdf->Output();
ob_end_flush()
	
?>


