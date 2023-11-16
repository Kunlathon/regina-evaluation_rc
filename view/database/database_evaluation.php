<?php
	date_default_timezone_set('Asia/Bangkok');
	$db_evaluationID=$_SERVER['REMOTE_ADDR'];
	if(isset($db_evaluationID)){
		if($db_evaluationID=="127.0.0.1" or $db_evaluationID=="localhost" or $db_evaluationID=="::1"){
		//db_evaluation
			$hostname_evaluation = "127.0.0.1";
			$username_evaluation = "root";
			$password_evaluation = "053282395";
			$database_evaluation = "regina_student";
			$post_evaluation="3399";
		// Create connection
			$evaluation_sql = new mysqli($hostname_evaluation,$username_evaluation,$password_evaluation,$database_evaluation,$post_evaluation);
		// Check connection
			if($evaluation_sql->connect_error){
				die("Connection failed: " . $evaluation_sql->connect_error);
			}else{
				date_default_timezone_set('Asia/Bangkok');
				$evaluation_sql->set_charset("utf8");
			}	
		}else{
		//db_evaluation	
			$hostname_evaluation = "localhost";
			$username_evaluation = "Regina@ict2022";
			$password_evaluation = "Regina@ict2022";
			$database_evaluation = "regina_student";
		// Create connection
			$evaluation_sql = new mysqli($hostname_evaluation,$username_evaluation,$password_evaluation,$database_evaluation);
		// Check connection
			if($evaluation_sql->connect_error){
				die("Connection failed: " . $evaluation_sql->connect_error);
			}else{
				date_default_timezone_set('Asia/Bangkok');
				$evaluation_sql->set_charset("utf8");
			}	
		//data from mis 
		

		/*$mis_hostname="119.46.246.171";
		$mis_username="regina";
		$mis_password="regina2019";
		$mis_database="regina_db";
		
		$mis_sql = new mysqli($mis_hostname,$mis_username,$mis_password,$mis_database);
		if($mis_sql->connect_error){
			die("Connection failed: ". $mis_sql->connect_error);
		}else{
			data_default_timezone_set('Asia/Bangkok');
			$mis_sql->set_charset("utf8");
		}

		*/

		}
	}else{
		echo"Error";
	}
// 	function php

	function connect(){
//*********************************************	
	$txt_error="Error";
	date_default_timezone_set('Asia/Bangkok');
	$db_evaluationID=$_SERVER['REMOTE_ADDR'];
	if(isset($db_evaluationID)){
		if($db_evaluationID=="127.0.0.1" or $db_evaluationID=="localhost" or $db_evaluationID=="::1"){
		//db_evaluation
			$hostname_evaluation = "127.0.0.1";
			$username_evaluation = "root";
			$password_evaluation = "053282395";
			$database_evaluation = "regina_student";
			$post_evaluation="3399";
		// Create connection
			$evaluation_sql = new mysqli($hostname_evaluation,$username_evaluation,$password_evaluation,$database_evaluation,$post_evaluation);
		// Check connection
			if($evaluation_sql->connect_error){
				die("Connection failed: " . $evaluation_sql->connect_error);
			}else{
				date_default_timezone_set('Asia/Bangkok');
				$evaluation_sql->set_charset("utf8");
			}	
		}else{
		//db_evaluation	
			$hostname_evaluation = "localhost";
			$username_evaluation = "Regina@ict2022";
			$password_evaluation = "Regina@ict2022";
			$database_evaluation = "regina_student";
		// Create connection
			$evaluation_sql = new mysqli($hostname_evaluation,$username_evaluation,$password_evaluation,$database_evaluation);
		// Check connection
			if($evaluation_sql->connect_error){
				die("Connection failed: " . $evaluation_sql->connect_error);
			}else{
				date_default_timezone_set('Asia/Bangkok');
				$evaluation_sql->set_charset("utf8");
			}	
		//data from mis 
		

		/*$mis_hostname="119.46.246.171";
		$mis_username="regina";
		$mis_password="regina2019";
		$mis_database="regina_db";
		
		$mis_sql = new mysqli($mis_hostname,$mis_username,$mis_password,$mis_database);
		if($mis_sql->connect_error){
			die("Connection failed: ". $mis_sql->connect_error);
		}else{
			data_default_timezone_set('Asia/Bangkok');
			$mis_sql->set_charset("utf8");
		}

		*/

		}
		return $evaluation_sql;
	}else{
		return $txt_error;
	}		
//*********************************************			

	}
//function php * select ->array
	function rc_array($rc_sql){
		$rcdata_array=array();
		$rcdata_connect= connect();
		
		$rcdata_rs=$rcdata_connect->query($rc_sql) or die($rcdata_connect->error);
		
		if($rcdata_rs->num_rows>0){
			while($rcdata_row=$rcdata_rs->fetch_assoc()){
				$rcdata_array[]=$rcdata_row;
			}
			return $rcdata_array;
		}else{
			return $rcdata_array;
		}
	}
//function php * select ->array	
	function rc_data($rc_sql){
		$rcdata_array=array();
		$rcdata_connect= connect();
		
		$rcdata_rs=$rcdata_connect->query($rc_sql);
		
		if($rcdata_rs->num_rows>0){
			$rcdata_row=$rcdata_rs->fetch_assoc();
			$rcdata_array[]=$rcdata_row;
			return $rcdata_array;
		}else{
			return $rcdata_array;
		}		
	}


	function post_data($post){
		$rcdata_connect=connect();
		$post_codehtml=$rcdata_connect->real_escape_string(htmlspecialchars($post));
		return $post_codehtml;
	}
	

//1. การเข้ารหัสใช้คำสั่ง base64_encode([MESSAGE])	
	function encode($txt_datakey){
		$txt_encode=base64_encode($txt_datakey);
		return $txt_encode;
	}
	
//2. การถอดรหัสใช้คำสั่ง base64_decode([MESSAGE])	
	function decode($txt_datakey){
		$txt_decode=base64_decode($txt_datakey);
		return $txt_decode;
	}

	//function into
	function add_rc($add_sql){
		$rcdata_connect=connect();
		if($rcdata_connect->query($add_sql)=== TRUE){
			$print="yes";
			return $print;
		}else{
			$print="no";
			return $print;
		}
	}

	function date_timeThailand($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
	}	
	
	function dateThailand($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}

		function datethaiM2($strDate){
	        $strYear = date("Y",strtotime($strDate));
			//$strYear=substr($strYear,2,2);
	        $strMonth= date("n",strtotime($strDate));
	        $strDay= date("j",strtotime($strDate));
	        $strMonthCut = Array("","01","02","03","04","05","06","07","08","09","10","11","12");
	        $strMonthThai= $strDay."-".$strMonthCut[$strMonth]."-".$strYear;
	        return "$strMonthThai";
	    }

	
?>
















