<?php
	class conntopdo_evaluationto{
		private $connto_evaluationto_evaluation;
		private $dsn_mysql="mysql:host=localhost;dbname=regina_student;charset=utf8";
		private $dsn_sqlite="sqlite:my_sqlite.db";
		private $user="codebeer2020";
		private $password="codebeer2020";

		public function __construct($db){
			//$this->connto_evaluationto_evaluation=$connto_evaluationto_evaluation;
			//$this->dsn_mysql=$dsn_mysql;
			//$this->dsn_sqlite=$dsn_sqlite;
			//$this->user=$user;
			//$this->password=$password;
			
			try{
				switch($db){
					case "mysql":
					
					$this->connto_evaluationto_evaluation = new PDO($this->dsn_mysql, $this->user, $this->password);
					// set the PDO error mode to exception
					$this->connto_evaluationto_evaluation->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					//echo "connto_evaluationto_evaluationected successfully";
					
					break;
					
					case "sqlite":
					
					$this->connto_evaluationto_evaluation=new PDO($this->dsn_sqlite);
					break;
					
				default : echo "No database connto_evaluationto_evaluationecting"; break;
					
				}
			}
			catch(PDOException $e){
				die('Could not connto_evaluationto_evaluationection to database because'.$e->getmessage());
				
			}
		}
		public function getconnto_evaluationto_evaluationect(){
			return $this->connto_evaluationto_evaluation;
		}				
	}


	class conntoppdo_stuquota{

		private $connto_stuquota;
		private $dsn_mysql="mysql:host=localhost;dbname=regina_quota;charset=utf8";
		private $dsn_sqlite="sqlite:my_sqlite.db";
		private $user="codebeer2020";
		private $password="codebeer2020";
		
		public function __construct($quota_db){
			try{
				switch($quota_db){
					case "mysql":
					$this->connto_stuquota=new PDO($this->dsn_mysql, $this->user, $this->password);
					$this->connto_stuquota->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					break;
					
					case "sqlite":
					
					$this->connto_stuquota=new PDO($this->dsn_sqlite);
					break;
					
					default  : echo "No database connto_datastuto_datastuecting"; break;
				}
			}
				catch(PDOException $e){
					die('Could not connto_datastuto_datastuection to database because'.$e->getmessage());
				}
				
		}
			public function  getconnto_stuquota(){
				return $this->connto_stuquota;
			}
	}

	class conntopdo_datastuto{
		private $connto_datastuto_datastu;
		private $dsn_mysql="mysql:host=localhost;dbname=regina_stu;charset=utf8";
		private $dsn_sqlite="sqlite:my_sqlite.db";
		private $user="codebeer2020";
		private $password="codebeer2020";

		public function __construct($db){
			//$this->connto_datastuto_datastu=$connto_datastuto_datastu;
			//$this->dsn_mysql=$dsn_mysql;
			//$this->dsn_sqlite=$dsn_sqlite;
			//$this->user=$user;
			//$this->password=$password;
			
			try{
				switch($db){
					case "mysql":
					
					$this->connto_datastuto_datastu = new PDO($this->dsn_mysql, $this->user, $this->password);
					// set the PDO error mode to exception
					$this->connto_datastuto_datastu->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					//echo "connto_datastuto_datastuected successfully";
					
					break;
					
					case "sqlite":
					
					$this->connto_datastuto_datastu=new PDO($this->dsn_sqlite);
					break;
					
				default : echo "No database connto_datastuto_datastuecting"; break;
					
				}
			}
			catch(PDOException $e){
				die('Could not connto_datastuto_datastuection to database because'.$e->getmessage());
				
			}
		}
		public function getconnto_datastuto_datastuect(){
			return $this->connto_datastuto_datastu;
		}				
	}


	class row_quotanotarray{
		public $txt_quotanotarray;
		function __construct($txt_quotanotarray){
			$this->txt_quotanotarray=$txt_quotanotarray;
			$quotanotarray=array();
			$connpdo_quota=new conntoppdo_stuquota("mysql");
			$pdo_quota=$connpdo_quota->getconnto_stuquota();
			$quotaSql=$this->txt_quotanotarray;
				if($quotaRs=$pdo_quota->query($quotaSql)){
					$quotaRow=$quotaRs->Fetch(PDO::FETCH_ASSOC);
					$quotanotarray[]=$quotaRow;
				}else{
					
				}
					$connpdo_quota=Null;
					$this->quotanotarray=$quotanotarray;
		}function print_quotanotarray(){
			return $this->quotanotarray;
		}		
		
	}

	class stu_levelpdo{
		public $stu_id;
		public $stu_year;
		public $stu_term;
		
		function __construct($stu_id,$stu_year,$stu_term){
			$this->stu_id=$stu_id;
			$this->stu_year=$stu_year;
			$this->stu_term=$stu_term;
			$connpdo_evaluation=new conntopdo_evaluationto("mysql");
			$pdo_evaluation=$connpdo_evaluation->getconnto_evaluationto_evaluationect();
			$stu_levelsql="select `regina_stu_class`.`rsd_studentid`,`rc_level`.`IDLevel`,`rc_level`.`Sort_name`,`rc_level`.`Lname`
						 ,`rc_plan`.`Name`as `planname`,`regina_stu_class`.`rsc_room`,`regina_stu_class`.`rsc_num`,`regina_stu_class`.`rsc_plan`
						   from `regina_stu_class` join `rc_level` on(`rc_level`.`IDLevel`=`regina_stu_class`.`rsc_class`)
						   join `rc_plan` on(`regina_stu_class`.`rsc_plan`=`rc_plan`.`IDPlan`)
						   where `regina_stu_class`.`rsc_year`='{$this->stu_year}'
						   and `regina_stu_class`.`rsc_term`='{$this->stu_term}'
						   and `regina_stu_class`.`rsd_studentid`='{$this->stu_id}'";
			if($stu_levelRs=$pdo_evaluation->query($stu_levelsql)){
				$stu_levelRow=$stu_levelRs->Fetch(PDO::FETCH_ASSOC);
				$this->rsd_studentid=$stu_levelRow["rsd_studentid"];
				$this->IDLevel=$stu_levelRow["IDLevel"];
				$this->Sort_name=$stu_levelRow["Sort_name"];
				$this->Lname=$stu_levelRow["Lname"];
				$this->planname=$stu_levelRow["planname"];
				$this->rsc_room=$stu_levelRow["rsc_room"];
				$this->rsc_num=$stu_levelRow["rsc_num"];
				$this->rc_plan=$stu_levelRow["rsc_plan"];				
			}else{
				$this->rsd_studentid="";
				$this->IDLevel="";
				$this->Sort_name="";
				$this->Lname="";
				$this->planname="";
				$this->rsc_room="";
				$this->rsc_num="";
				$this->rc_plan="";
			}
			$pdo_evaluation=Null;
		}	function __destruct(){
			$this->rsd_studentid;
			$this->IDLevel;
			$this->Sort_name;
			$this->Lname;
			$this->planname;
			$this->rsc_room;
			$this->rsc_num;
			$this->rc_plan;			
		}
			
	}
	
	
		class insert_quota{
			public $quota_sql;
			function __construct($quota_sql){
				$this->quota_sql=$quota_sql;
				
				$connpdo_quota=new conntoppdo_stuquota("mysql");
				$pdo_quota=$connpdo_quota->getconnto_stuquota();
				
				$sql=$this->quota_sql;
				
				if($pdo_quota->exec($sql)>0){
					$system_insertQuota="yes";
				}else{
					$system_insertQuota="no";
				}
				unset($pdo_quota);
				$this->system_insertQuota=$system_insertQuota;	
			}function print_insertQuota(){
				 return $this->system_insertQuota;
			}	
		}
		
			class notrow_evaluation{
			public $txt_evaluation;
			function __construct($txt_evaluation){
				$this->txt_evaluation=$txt_evaluation;
				$evaluation_array=array();
				$connpdo_evaluation=new conntopdo_evaluationto("mysql");
				$pdo_evaluation=$connpdo_evaluation->getconnto_evaluationto_evaluationect();
				$evaluation_sql=$this->txt_evaluation;
					if($evaluation_rs=$pdo_evaluation->query($evaluation_sql)){
						$evaluation_row=$evaluation_rs->Fetch(PDO::FETCH_ASSOC);
						$evaluation_array[]=$evaluation_row;
					}else{
				
					}
						$pdo_evaluation=Null;
						$this->evaluation_array=$evaluation_array;				
				}function __destruct(){
					$this->evaluation_array;
			}
		}

//-----------------------------------------------------------------------------------------
	error_reporting(error_reporting() & ~E_NOTICE); 
	$next_year=2564;
	$txt_year=2563;
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
	if(file_exists("../../../../all/$stuID.JPG")){
		$user_img="../../../../all/$stuID.JPG";
	}else{
		$user_img="../../../../all/newimg_rc.jpg";
	}	

//img

//-----------------------------------------------------------------------------------------
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
]);

ob_start(); // Start get HTML code
?>





<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>

<style>
body {
    font-family: sarabun;
	font-size: 23px;
	margin: 0px ;
	padding:0px;
	A_CSS_ATTRIBUTE:all;
	position: absolute;
	bottom: 20px; 
	right: 25px;
	left: 25px;
	top: 15px;
}
table {
  border-collapse: collapse;
  width: 100%;
}




</style>

	
	



</head>

<body>

<div style="A_CSS_ATTRIBUTE:all;position: absolute;bottom: 20px; right: 20px;left: 20px; top: 15px;">


<table width="100%" border="0">
  <tbody>
    <tr>
      <td>
		<div>
			<img src="../../../../../Template/global_assets/images/logo_rc.jpg" alt="โรงเรียนเรยีนาเชลีวิทยาลัย จังหวัดเชียงใหม่" width="99" height="103"  >
		</div>
		<div>
				  <table  border="1">
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
      <td></td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>











</div>





</body>

</html>
<?php
$html = ob_get_contents();
$mpdf->WriteHTML($html);
//$mpdf->AddPage();
$mpdf->Output();
ob_end_flush()
?>