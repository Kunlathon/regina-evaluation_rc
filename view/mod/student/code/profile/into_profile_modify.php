<?php
	include("../../../../database/pdo_data.php");
	include("../../../../database/pdo_conndatastu.php");
	
	include("../../../../database/class_pdo.php");	
	
	include("../../../../database/class_pdodatastu.php");
    include("../../../../database/database_evaluation.php");
	error_reporting(error_reporting() & ~E_NOTICE); 
?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!--<title>Untitled Document</title>-->
</head>

<body>


<?php
	/*function DateThai($strDate)
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

	$strDate = "2008-08-14 13:42:44";
	echo "ThaiCreate.Com Time now : ".DateThai($strDate);*/
?>

	<?php 
		$stu_id=filter_input(INPUT_POST,'stu_id');
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		$UpIntoSaveSwipTime=new UpIntoSaveSwipTime($stu_id);
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
//*******************************************************************	
		/*$regina_stu_dataSql="SELECT `rsd_prefix`,`rsd_name`,`rsd_surname` FROM `regina_stu_data` WHERE `rsd_studentid`='{$stu_id}';";
		$regina_stu_data=new notrow_evaluation($regina_stu_data);
		foreach($regina_stu_data->evaluation_array as $rc_key=>$regina_stu_dataRow){
			if($regina_stu_dataRow["rsd_prefix"]==2){
				$myname="เด็กหญิง ".$regina_stu_dataRow["rsd_name"]." ".$regina_stu_dataRow["rsd_surname"];
			}elseif($regina_stu_dataRow["rsd_prefix"]==4){
				$myname="นางสาว ".$regina_stu_dataRow["rsd_name"]." ".$regina_stu_dataRow["rsd_surname"];
			}else{
				$myname=$regina_stu_dataRow["rsd_name"]." ".$regina_stu_dataRow["rsd_surname"];
			}
			$group="S";
		}*/
		$myname=filter_input(INPUT_POST,'myname');
		$group=filter_input(INPUT_POST,'group');
		
		
		
//----------System----------------------------------------------------||
//*******************************************************************		
		$enter=filter_input(INPUT_POST,'enter');
		if(!isset($enter,$stu_id)){ ?>
<!--**************************************************************-->	
	<script>   
		$(document).ready(function(){
	// Noty plugin
    // ------------------------------

    // Override Noty defaults
			Noty.overrideDefaults({
        		theme: 'limitless',
        		layout: 'topRight',
        		type: 'alert',
        		timeout: 2500
    		});			
	   new Noty({
            text: 'เกิดข้อผิดพลาดในระบบไม่สามารถทำรายการได้.',
            type: 'error'
        }).show();
			
		});
	</script>		
<!--**************************************************************-->			
<?php	}else{
			if($enter=="" and $stu_id==""){ ?>
<!--**************************************************************-->	
	<script>   
		$(document).ready(function(){
	// Noty plugin
    // ------------------------------

    // Override Noty defaults
			Noty.overrideDefaults({
        		theme: 'limitless',
        		layout: 'topRight',
        		type: 'alert',
        		timeout: 2500
    		});			
	   new Noty({
            text: 'เกิดข้อผิดพลาดในระบบไม่สามารถทำรายการได้.',
            type: 'error'
        }).show();
			
		});
	</script>		
<!--**************************************************************-->
<?php		}elseif($enter=="" or $stu_id==""){ ?>
<!--**************************************************************-->	
	<script>   
		$(document).ready(function(){
	// Noty plugin
    // ------------------------------

    // Override Noty defaults
			Noty.overrideDefaults({
        		theme: 'limitless',
        		layout: 'topRight',
        		type: 'alert',
        		timeout: 2500
    		});			
	   new Noty({
            text: 'เกิดข้อผิดพลาดในระบบไม่สามารถทำรายการได้.',
            type: 'error'
        }).show();
			
		});
	</script>		
<!--**************************************************************-->			
<?php		}elseif($enter=="up_stu"){ ?>
<!--------------------------------------------------------------------------->
<?php
	$stu_birth=filter_input(INPUT_POST,'stu_birth');
	
		if($stu_birth==""){ ?>
<!--*************************************************************-->	
<!--------------------------------------------------------------------------->
<?php
//updata: regina_stu_data		
//*************************************************************				
	$rsd_name=filter_input(INPUT_POST,'rsd_name');
	$rsd_surname=filter_input(INPUT_POST,'rsd_surname');
	$rsd_nameEn=filter_input(INPUT_POST,'rsd_nameEn');
	$rsd_surnameEn=filter_input(INPUT_POST,'rsd_surnameEn');
	$nickTh=filter_input(INPUT_POST,'nickTh');
	$nickEn=filter_input(INPUT_POST,'nickEn');
	$rsd_Identification=filter_input(INPUT_POST,'rsd_Identification');
				
		$into_stu="UPDATE `regina_stu_data` SET `rsd_name`='{$rsd_name}',`rsd_surname`='{$rsd_surname}',`rsd_Identification`='{$rsd_Identification}',`rsd_nameEn`='{$rsd_nameEn}',`rsd_surnameEn`='{$rsd_surnameEn}',`nickTh`='{$nickTh}',`nickEn`='{$nickEn}' WHERE `rsd_studentid`='{$stu_id}'";
		$into_stuRs=new insert_evaluation($into_stu);
			if($into_stu->system_insert=="yes"){
				//echo"";
			}else{
			  	//echo"";
			}
	?>	
<!--------------------------------------------------------------------------->	
<!--*************************************************************-->		
<?php	}else{ ?>
<!--*************************************************************-->	
<!--------------------------------------------------------------------------->
<?php
//updata: regina_stu_data
	$stu_birth=filter_input(INPUT_POST,'stu_birth');
	
	$copy_birth=datethaiM2($stu_birth);					
	$print_birth=new dateofbirth($copy_birth);
	if($print_birth->wyear>=15){
		$rsd_prefix=4;
	}else{
		$rsd_prefix=2;
	}			
//*************************************************************				
	$rsd_name=filter_input(INPUT_POST,'rsd_name');
	$rsd_surname=filter_input(INPUT_POST,'rsd_surname');
	$rsd_nameEn=filter_input(INPUT_POST,'rsd_nameEn');
	$rsd_surnameEn=filter_input(INPUT_POST,'rsd_surnameEn');
	$nickTh=filter_input(INPUT_POST,'nickTh');
	$nickEn=filter_input(INPUT_POST,'nickEn');
				
		$into_stu="UPDATE `regina_stu_data` SET `rsd_prefix`='{$rsd_prefix}',`rsd_name`='{$rsd_name}',`rsd_surname`='{$rsd_surname}',`rsd_nameEn`='{$rsd_nameEn}',`rsd_surnameEn`='{$rsd_surnameEn}',`nickTh`='{$nickTh}',`nickEn`='{$nickEn}' WHERE `rsd_studentid`='{$stu_id}'";
		$into_stuRs=new insert_evaluation($into_stu);
			if($into_stu->system_insert=="yes"){
				//echo"";
			}else{
			  	//echo"";
			}
	?>	
<!--------------------------------------------------------------------------->	
<!--*************************************************************-->		
<?php	}      ?>

<?php
//updata: data_student	
	$stu_birth=filter_input(INPUT_POST,'stu_birth');	
	$stu_blood=filter_input(INPUT_POST,'stu_blood');		
	$stu_nation=filter_input(INPUT_POST,'stu_nation');	
	$stu_sun=filter_input(INPUT_POST,'stu_sun');		
	$IDReligion=filter_input(INPUT_POST,'IDReligion');	
	$stu_phone=filter_input(INPUT_POST,'stu_phone');	
	$stu_brethren=filter_input(INPUT_POST,'stu_brethren');	
	$stu_brethreS=filter_input(INPUT_POST,'stu_brethreS');	
	$stu_child=filter_input(INPUT_POST,'stu_child');	
	$stu_physical=filter_input(INPUT_POST,'stu_physical');		
	$breed_add=filter_input(INPUT_POST,'breed_add');		
	$breed_district=filter_input(INPUT_POST,'breed_district');	
	$breed_city=filter_input(INPUT_POST,'breed_city');		
	$breed_province=filter_input(INPUT_POST,'breed_province');		
	$ds_SameSchool=filter_input(INPUT_POST,'ds_SameSchool');		
	$ds_OriginalClass=filter_input(INPUT_POST,'ds_OriginalClass');	
	$ds_SameSchool=filter_input(INPUT_POST,'ds_SameSchool');
	$ds_gradeSchool=filter_input(INPUT_POST,'ds_gradeSchool');
	$ds_ProvinceSchool=filter_input(INPUT_POST,'ds_ProvinceSchool');

	
	
	$Ckdata_studentSql="SELECT count(`stu_id`) as `num_stu` FROM `data_student` WHERE `stu_id`='{$stu_id}'";
	$Ckdata_studentRs=new notrow_datastu($Ckdata_studentSql);
	foreach($Ckdata_studentRs->datastu_array as $rc_key=>$Ckdata_studentRow){
		$num_stu=$Ckdata_studentRow["num_stu"];
		if($num_stu>=1){
			$up_data_studentSql="UPDATE `data_student` SET `stu_birth`='{$stu_birth}',`stu_blood`='{$stu_blood}',`stu_nation`='{$stu_nation}',`stu_sun`='{$stu_sun}',`IDReligion`='{$IDReligion}',`stu_phone`='{$stu_phone}'
							   ,`stu_brethren`='{$stu_brethren}',`stu_brethreS`='{$stu_brethreS}',`stu_child`='{$stu_child}',`stu_physical`='{$stu_physical}',`breed_add`='{$breed_add}',`breed_district`='{$breed_district}',`breed_city`='{$breed_city}'
							   ,`breed_province`='{$breed_province}',`ds_SameSchool`='{$ds_SameSchool}',`ds_OriginalClass`='{$ds_OriginalClass}',`ds_gradeSchool`='{$ds_gradeSchool}',`ds_ProvinceSchool`='{$ds_ProvinceSchool}' WHERE `stu_id`='{$stu_id}';";
			$up_data_student=new insert_datastu($up_data_studentSql);
			if($up_data_student->system_insert=="yes"){
				//*************************************
			}else{
				//*************************************
			}
		}else{
			$into_data_studentSql="INSERT INTO `data_student` (`stu_id`, `stu_birth`, `stu_blood`, `stu_nation`, `stu_sun`, `IDReligion`, `stu_phone`, `stu_brethren`, `stu_brethreS`, `stu_child`, `stu_physical`, `breed_add`, `breed_district`, `breed_city`, `breed_province`,`ds_SameSchool`,`ds_OriginalClass`,`ds_gradeSchool`,`ds_ProvinceSchool`) 
							       VALUES ('{$stu_id}', '{$stu_birth}', '{$stu_blood}', '{$stu_nation}', '{$stu_sun}', '{$IDReligion}', '{$stu_phone}', '{$stu_brethren}', '{$stu_brethreS}', '{$stu_child}', '{$stu_physical}', '{$breed_add}', '{$breed_district}', '{$breed_city}', '{$breed_province}','{$ds_SameSchool}','{$ds_OriginalClass}','{$ds_gradeSchool}','{$ds_ProvinceSchool}');";
			$into_data_student=new insert_datastu($into_data_studentSql);
			if($into_data_student->system_insert=="yes"){
				//*************************************
			}else{
				//*************************************
			}			
		}
	}
?>	
<!--------------------------------------------------------------------------->	
<?php
//updata: stu_address
	$stu_hno=filter_input(INPUT_POST,'stu_hno');		
	$stu_moo=filter_input(INPUT_POST,'stu_moo');	
	$stu_soi=filter_input(INPUT_POST,'stu_soi');	
	$stu_road=filter_input(INPUT_POST,'stu_road');	
	$stu_tumbon=filter_input(INPUT_POST,'stu_tumbon');	
	$stu_amphur=filter_input(INPUT_POST,'stu_amphur');	
	$stu_province=filter_input(INPUT_POST,'stu_province');	
	$stu_zipcode=filter_input(INPUT_POST,'stu_zipcode');	
	
	$ck_stu_addressSql="SELECT count(`stu_id`) as `num_stuaddress` FROM `stu_address` WHERE `stu_id`='{$stu_id}';";
	$ck_stu_address=new notrow_datastu($ck_stu_addressSql);
	foreach($ck_stu_address->datastu_array as $rc_key=>$ck_stu_addressRow){
		$num_stuaddress=$ck_stu_addressRow["num_stuaddress"];
		if($num_stuaddress>=1){
			$up_stu_addressSql="UPDATE `stu_address` SET `stu_hno`='{$stu_hno}',`stu_moo`='{$stu_moo}',`stu_soi`='{$stu_soi}',`stu_road`='{$stu_road}',`stu_tumbon`='{$stu_tumbon}',`stu_amphur`='{$stu_amphur}',`stu_province`='{$stu_province}',`stu_zipcode`='{$stu_zipcode}' WHERE `stu_id`='{$stu_id}';";
			$up_stu_address=new insert_datastu($up_stu_addressSql);
			if($up_stu_address->system_insert=="yes"){
				//************************************
			}else{
				//*************************************
			}
		}else{
			$into_stu_addressSql="INSERT INTO `stu_address` (`stu_id`, `stu_hno`, `stu_moo`, `stu_soi`, `stu_road`, `stu_tumbon`, `stu_amphur`, `stu_province`, `stu_zipcode`) 
						          VALUES ('{$stu_id}', '{$stu_hno}', '{$stu_moo}', '{$stu_soi}', '{$stu_road}', '{$stu_tumbon}', '{$stu_amphur}', '{$stu_province}', '{$stu_zipcode}');";
			$into_stu_address=new insert_datastu($into_stu_addressSql);
			if($into_stu_address->system_insert=="yes"){
				//*************************************
			}else{
				//*************************************
			}
		}
	}
?>
<!--------------------------------------------------------------------------->	
<?php
//updata:stu_address_home
	$stu_reg_hno=filter_input(INPUT_POST,'stu_reg_hno');	
	$stu_reg_moo=filter_input(INPUT_POST,'stu_reg_moo');	
	$stu_reg_soi=filter_input(INPUT_POST,'stu_reg_soi');	
	$stu_reg_road=filter_input(INPUT_POST,'stu_reg_road');
	$stu_reg_tumbon=filter_input(INPUT_POST,'stu_reg_tumbon');
	$stu_reg_amphur=filter_input(INPUT_POST,'stu_reg_amphur');
	$stu_reg_province=filter_input(INPUT_POST,'stu_reg_province');
	$stu_reg_zipcode=filter_input(INPUT_POST,'stu_reg_zipcode');

	$ck_stu_address_homeSql="SELECT count(`stu_id`) as `count_addhome` FROM `stu_address_home` WHERE `stu_id`='{$stu_id}';";
	$ck_stu_address_home=new notrow_datastu($ck_stu_address_homeSql);
	foreach($ck_stu_address_home->datastu_array as $rc_key=>$ck_stu_address_homeRow){
		$count_addhome=$ck_stu_address_homeRow["count_addhome"];
		if($count_addhome>=1){
			$up_stu_address_homeSql="UPDATE `stu_address_home` SET `stu_reg_hno`='{$stu_reg_hno}',`stu_reg_moo`='{$stu_reg_moo}',`stu_reg_soi`='{$stu_reg_soi}',`stu_reg_road`='{$stu_reg_road}',`stu_reg_tumbon`='{$stu_reg_tumbon}',`stu_reg_amphur`='{$stu_reg_amphur}',`stu_reg_province`='{$stu_reg_province}',`stu_reg_zipcode`='{$stu_reg_zipcode}' WHERE `stu_id`='{$stu_id}'";
			$up_stu_address_home=new insert_datastu($up_stu_address_homeSql);
			if($up_stu_address_home->system_insert=="yes"){
				//*****************************************
			}else{ 
				//*****************************************
			}
		}else{
			$into_stu_address_homeSql="INSERT INTO `stu_address_home`(`stu_id`, `stu_reg_hno`, `stu_reg_moo`, `stu_reg_soi`, `stu_reg_road`, `stu_reg_tumbon`, `stu_reg_amphur`, `stu_reg_province`, `stu_reg_zipcode`) VALUES ('{$stu_id}','{$stu_reg_hno}','{$stu_reg_moo}','{$stu_reg_soi}','{$stu_reg_road}','{$stu_reg_tumbon}','{$stu_reg_amphur}','{$stu_reg_province}','{$stu_reg_zipcode}');";
			$into_stu_address_home=new insert_datastu($into_stu_address_homeSql);
			if($into_stu_address_home->system_insert=="yes"){
				//*****************************************
			}else{
				//*****************************************
			}			
		}
	} ?>
<!--**************************************************************-->	
	<script>   
		$(document).ready(function(){
	// Noty plugin
    // ------------------------------

    // Override Noty defaults
			Noty.overrideDefaults({
        		theme: 'limitless',
        		layout: 'topRight',
        		type: 'alert',
        		timeout: 2500
    		});			
	   new Noty({
            text: 'บันทึกข้อมูลนักเรียน สำเร็จ.',
            type: 'success'
        }).show();
			
		});
	</script>		
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
			
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$stu_id."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ทำรายการแก้ไขข้อมูลนักเรียน IP".$db_evaluationID;
				//$sMessage="444";

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
		//****************************
			
		//****************************				
	}
	
?>
<!--**************************************************************-->	
<?php //*** ?>
<!--------------------------------------------------------------------------->	
	<?php	}elseif($enter=="up_stuadd"){ ?>
<!--------------------------------------------------------------------------->		
<?php
//****************************************************************************		
	$ds_status=filter_input(INPUT_POST,'ds_status');	
	$ds_dormitoryName=filter_input(INPUT_POST,'ds_dormitoryName');
	$ds_dormitoryHno=filter_input(INPUT_POST,'ds_dormitoryHno');
	$ds_dormitoryMoo=filter_input(INPUT_POST,'ds_dormitoryMoo');
	$ds_dormitorySoi=filter_input(INPUT_POST,'ds_dormitorySoi');	
	$ds_dormitoryRoad=filter_input(INPUT_POST,'ds_dormitoryRoad');
	$ds_dormitoryTumbon=filter_input(INPUT_POST,'ds_dormitoryTumbon');
	$ds_dormitoryAmphur=filter_input(INPUT_POST,'ds_dormitoryAmphur');
	$ds_dormitoryProvince=filter_input(INPUT_POST,'ds_dormitoryProvince');
	$ds_dormitoryZipcode=filter_input(INPUT_POST,'ds_dormitoryZipcode');	
	$ds_dormitoryPhone=filter_input(INPUT_POST,'ds_dormitoryPhone');	
	$ds_dormitoryMyName=filter_input(INPUT_POST,'ds_dormitoryMyName');	
	$ds_FoodAllergies=filter_input(INPUT_POST,'ds_FoodAllergies');
	$ds_CongenitalDisease=filter_input(INPUT_POST,'ds_CongenitalDisease');
	$ds_DrugAllergy=filter_input(INPUT_POST,'ds_DrugAllergy');	
	$ds_trip=filter_input(INPUT_POST,'ds_trip');		
	$ds_triptxt=filter_input(INPUT_POST,'ds_triptxt');
	$ds_FMstatus=filter_input(INPUT_POST,'ds_FMstatus');
	$ds_allergic=filter_input(INPUT_POST,'ds_allergic');

	$ck_stu_depend_stuSql="SELECT COUNT(`ds_stuid`) as `count_stuid` FROM `depend_stu` WHERE `ds_stuid`='{$stu_id}';";
	$ck_stu_depend_stu=new notrow_datastu($ck_stu_depend_stuSql);
	foreach($ck_stu_depend_stu->datastu_array as $rc_key=>$ck_depend_stuRow){
		$count_stuid=$ck_depend_stuRow["count_stuid"];
		if($count_stuid>=1){
			$up_depend_stuSql="UPDATE `depend_stu` SET `ds_status`='{$ds_status}',`ds_dormitoryName`='{$ds_dormitoryName}',`ds_dormitoryHno`='{$ds_dormitoryHno}',`ds_dormitoryMoo`='{$ds_dormitoryMoo}',`ds_dormitorySoi`='{$ds_dormitorySoi}',`ds_dormitoryRoad`='{$ds_dormitoryRoad}',`ds_dormitoryTumbon`='{$ds_dormitoryTumbon}',`ds_dormitoryAmphur`='{$ds_dormitoryAmphur}',`ds_dormitoryProvince`='{$ds_dormitoryProvince}',`ds_dormitoryZipcode`='{$ds_dormitoryZipcode}',`ds_dormitoryPhone`='{$ds_dormitoryPhone}',`ds_dormitoryMyName`='{$ds_dormitoryMyName}',`ds_FoodAllergies`='{$ds_FoodAllergies}',`ds_CongenitalDisease`='{$ds_CongenitalDisease}',`ds_DrugAllergy`='{$ds_DrugAllergy}',`ds_trip`='{$ds_trip}',`ds_triptxt`='{$ds_triptxt}',`ds_FMstatus`='{$ds_FMstatus}',`ds_allergic`='{$ds_allergic}' WHERE `ds_stuid`='{$stu_id}';";
			$up_depend_stu=new insert_datastu($up_depend_stuSql);
			if($up_depend_stu->system_insert=="yes"){
				//*****************************************
			}else{ 
				//*****************************************
			}
		}else{
			$into_depend_stuSql="INSERT INTO `depend_stu` (`ds_stuid`, `ds_status`, `ds_dormitoryName`, `ds_dormitoryHno`, `ds_dormitoryMoo`, `ds_dormitorySoi`, `ds_dormitoryRoad`, `ds_dormitoryTumbon`, `ds_dormitoryAmphur`, `ds_dormitoryProvince`, `ds_dormitoryZipcode`, `ds_dormitoryPhone`, `ds_dormitoryMyName`, `ds_FoodAllergies`, `ds_CongenitalDisease`, `ds_DrugAllergy`, `ds_trip`, `ds_triptxt`, `ds_FMstatus`,`ds_allergic`) 
								VALUES ('{$stu_id}', '{$ds_status}', '{$ds_dormitoryName}', '{$ds_dormitoryHno}', '{$ds_dormitoryMoo}', '{$ds_dormitorySoi}', '{$ds_dormitoryRoad}', '{$ds_dormitoryTumbon}', '{$ds_dormitoryAmphur}', '{$ds_dormitoryProvince}', '{$ds_dormitoryZipcode}', '{$ds_dormitoryPhone}', '{$ds_dormitoryMyName}', '{$ds_FoodAllergies}', '{$ds_CongenitalDisease}', '{$ds_DrugAllergy}', '{$ds_trip}', '{$ds_triptxt}', '{$ds_FMstatus}','{$ds_allergic}');";
			$into_depend_stu=new insert_datastu($into_depend_stuSql);
			if($into_depend_stu->system_insert=="yes"){
				//*****************************************
			}else{
				//*****************************************
			}			
		}
	} ?>
<!--**************************************************************-->	
	<script>   
		$(document).ready(function(){
	// Noty plugin
    // ------------------------------

    // Override Noty defaults
			Noty.overrideDefaults({
        		theme: 'limitless',
        		layout: 'topRight',
        		type: 'alert',
        		timeout: 2500
    		});			
	   new Noty({
            text: 'บันทึกข้อมูลเพิ่มเติม นักเรียน สำเร็จ.',
            type: 'success'
        }).show();
			
		});
	</script>		
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
			
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$stu_id."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ทำรายการแก้ไขข้อมูลเพิ่มเติม นักเรียน IP".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne );
		//****************************
			
		//****************************				
	}
?>	
<!--**************************************************************-->	
<?php //**** ?>	
	
	
<!--------------------------------------------------------------------------->			
	<?php   }elseif($enter=="up_father"){ ?>
<!--------------------------------------------------------------------------->		
<?php
//****************************************************************************	
//stu_father 
	$father_prefix=filter_input(INPUT_POST,'father_prefix');
	$father_fname=filter_input(INPUT_POST,'father_fname');
	$father_sname=filter_input(INPUT_POST,'father_sname');
	$father_prefix_en=filter_input(INPUT_POST,'father_prefix_en');
	$father_fname_en=filter_input(INPUT_POST,'father_fname_en');
	$father_sname_en=filter_input(INPUT_POST,'father_sname_en');	
	$father_code=filter_input(INPUT_POST,'father_code');	
	$sf_blood=filter_input(INPUT_POST,'sf_blood');	
	$sf_nation=filter_input(INPUT_POST,'sf_nation');	
	$sf_sun=filter_input(INPUT_POST,'sf_sun');	
	$sf_IDReligion=filter_input(INPUT_POST,'sf_IDReligion');
	$af_birthday=filter_input(INPUT_POST,'af_birthday');	
	$father_career=filter_input(INPUT_POST,'father_career');
	$father_study=filter_input(INPUT_POST,'father_study');
	$father_careerOther=filter_input(INPUT_POST,'father_careerOther');	
	$father_salary=filter_input(INPUT_POST,'father_salary');
	$father_workplace=filter_input(INPUT_POST,'father_workplace');
	$father_wp_pro=filter_input(INPUT_POST,'father_wp_pro');	
	$father_wp_tel=filter_input(INPUT_POST,'father_wp_tel');	
	$father_phone=filter_input(INPUT_POST,'father_phone');

    $ck_stu_fatherSql="SELECT count(`stu_id`) as `countstu_father` FROM `stu_father` WHERE `stu_id`='{$stu_id}';";
	$ck_stu_father=new notrow_datastu($ck_stu_fatherSql);
	foreach($ck_stu_father->datastu_array as $rc_key=>$ck_stu_fatherRow){
		$countstu_father=$ck_stu_fatherRow["countstu_father"];
		if($countstu_father>=1){
			$up_stu_fatherSql="UPDATE `stu_father` SET `father_prefix`='{$father_prefix}',`father_fname`='{$father_fname}',`father_sname`='{$father_sname}',`father_prefix_en`='{$father_prefix_en}',
							  `father_fname_en`='{$father_fname_en}',`father_sname_en`='{$father_sname_en}',`father_code`='{$father_code}',`sf_blood`='{$sf_blood}',`sf_nation`='{$sf_nation}',
							  `sf_sun`='{$sf_sun}',`sf_IDReligion`='{$sf_IDReligion}',`af_birthday`='{$af_birthday}',`father_career`='{$father_career}',`father_study`='{$father_study}',
							  `father_careerOther`='{$father_careerOther}',`father_salary`='{$father_salary}',`father_workplace`='{$father_workplace}',`father_wp_pro`='{$father_wp_pro}',
							  `father_wp_tel`='{$father_wp_tel}',`father_phone`='{$father_phone}' WHERE `stu_id`='{$stu_id}';";
			$up_stu_father=new insert_datastu($up_stu_fatherSql);
			if($up_stu_father->system_insert=="yes"){
				//*****************************************
			}else{ 
				//*****************************************
			}
		}else{
			$into_stu_fatherSql="INSERT INTO `stu_father` (`stu_id`, `father_prefix`, `father_fname`, `father_sname`, `father_prefix_en`, `father_fname_en`, `father_sname_en`, `father_code`, `sf_blood`, `sf_nation`, `sf_sun`, `sf_IDReligion`, `af_birthday`, `father_career`, `father_study`, `father_careerOther`, `father_salary`, `father_workplace`, `father_wp_pro`, `father_wp_tel`, `father_phone`) 
			                     VALUES ('{$stu_id}', '{$father_prefix}', '{$father_fname}', '{$father_sname}', '{$father_prefix_en}', '{$father_fname_en}', '{$father_sname_en}', '{$father_code}', '{$sf_blood}', '{$sf_nation}', '{$sf_sun}', '{$sf_IDReligion}', '{$af_birthday}', '{$father_career}', '{$father_study}', '{$father_careerOther}', '{$father_salary}', '{$father_workplace}', '{$father_wp_pro}', '{$father_wp_tel}', '{$father_phone}');";
			$into_stu_father=new insert_datastu($into_stu_fatherSql);
			if($into_stu_father->system_insert=="yes"){
				//*****************************************
			}else{
				//*****************************************
			}			
		}
	}
//stu_father End 


//stu_father_address
	$father_hno=filter_input(INPUT_POST,'father_hno');
	$father_moo=filter_input(INPUT_POST,'father_moo');	
	$father_soi=filter_input(INPUT_POST,'father_soi');	
	$father_road=filter_input(INPUT_POST,'father_road');	
	$father_tumbon=filter_input(INPUT_POST,'father_tumbon');
	$father_amphur=filter_input(INPUT_POST,'father_amphur');
	$father_province=filter_input(INPUT_POST,'father_province');	
	$father_zipcode=filter_input(INPUT_POST,'father_zipcode');
	
    $ck_stu_father_addressSql="SELECT count(`stu_id`) as `count_father_address` FROM `stu_father_address` WHERE `stu_id`='{$stu_id}';";
	$ck_stu_father_address=new notrow_datastu($ck_stu_father_addressSql);
	foreach($ck_stu_father_address->datastu_array as $rc_key=>$ck_stu_father_addressRow){
		$count_father_address=$ck_stu_father_addressRow["count_father_address"];
		if($count_father_address>=1){
			$up_stu_father_addressSql="UPDATE `stu_father_address` SET `father_hno`='{$father_hno}',`father_moo`='{$father_moo}',`father_soi`='{$father_soi}',`father_road`='{$father_road}',
									  `father_tumbon`='{$father_tumbon}',`father_amphur`='{$father_amphur}',`father_province`='{$father_province}',`father_zipcode`='{$father_zipcode}' WHERE `stu_id`='{$stu_id}';";
			$up_stu_father_address=new insert_datastu($up_stu_father_addressSql);
			if($up_stu_father_address->system_insert=="yes"){
				//*****************************************
			}else{ 
				//*****************************************
			}
		}else{
			$into_stu_father_addressSql="INSERT INTO `stu_father_address` (`stu_id`, `father_hno`, `father_moo`, `father_soi`, `father_road`, `father_tumbon`, `father_amphur`, `father_province`, `father_zipcode`) 
									     VALUES ('{$stu_id}', '{$father_hno}', '{$father_moo}', '{$father_soi}', '{$father_road}', '{$father_tumbon}', '{$father_amphur}', '{$father_province}', '{$father_zipcode}');";
			$into_stu_father_address=new insert_datastu($into_stu_father_addressSql);
			if($into_stu_father_address->system_insert=="yes"){
				//*****************************************
			}else{
				//*****************************************
			}			
		}
	}

//stu_father_address End


//stu_father_addword

	$father_addwordhno=filter_input(INPUT_POST,'father_addwordhno');	
	$father_addwordmoo=filter_input(INPUT_POST,'father_addwordmoo');	
	$father_addwordsoi=filter_input(INPUT_POST,'father_addwordsoi');	
	$father_addwordroad=filter_input(INPUT_POST,'father_addwordroad');
	$father_addwordtumbon=filter_input(INPUT_POST,'father_addwordtumbon');
	$father_addwordamphur=filter_input(INPUT_POST,'father_addwordamphur');
	$father_addwordprovince=filter_input(INPUT_POST,'father_addwordprovince');	
	$father_addwordzipcode=filter_input(INPUT_POST,'father_addwordzipcode');
	$father_addwordphone=filter_input(INPUT_POST,'father_addwordphone');

    $ck_stu_father_addwordSql="SELECT count(`stu_id`) as `count_addword` FROM `stu_father_addword` WHERE `stu_id`='{$stu_id}'";
	$ck_stu_father_addword=new notrow_datastu($ck_stu_father_addwordSql);
	foreach($ck_stu_father_addword->datastu_array as $rc_key=>$ck_stu_father_addwordRow){
		$count_addword=$ck_stu_father_addwordRow["count_addword"];
		if($count_addword>=1){
			$up_stu_father_addwordSql="UPDATE `stu_father_addword` SET `father_addwordhno`='{$father_addwordhno}',`father_addwordmoo`='{$father_addwordmoo}',`father_addwordsoi`='{$father_addwordsoi}',
									  `father_addwordroad`='{$father_addwordroad}',`father_addwordtumbon`='{$father_addwordtumbon}',`father_addwordamphur`='{$father_addwordamphur}',`father_addwordprovince`='{$father_addwordprovince}',
									  `father_addwordzipcode`='{$father_addwordzipcode}',`father_addwordphone`='{$father_addwordphone}' WHERE `stu_id`='{$stu_id}';";
			$up_stu_father_addword=new insert_datastu($up_stu_father_addwordSql);
			if($up_stu_father_addword->system_insert=="yes"){
				//*****************************************
			}else{ 
				//*****************************************
			}
		}else{
			$into_stu_father_addwordSql="INSERT INTO `stu_father_addword` (`stu_id`, `father_addwordhno`, `father_addwordmoo`, `father_addwordsoi`, `father_addwordroad`, `father_addwordtumbon`, `father_addwordamphur`, `father_addwordprovince`, `father_addwordzipcode`, `father_addwordphone`) 
										 VALUES ('{$stu_id}', '{$father_addwordhno}', '{$father_addwordmoo}', '{$father_addwordsoi}', '{$father_addwordroad}', '{$father_addwordtumbon}', '{$father_addwordamphur}', '{$father_addwordprovince}', '{$father_addwordzipcode}', '{$father_addwordphone}');";
			$into_stu_father_addword=new insert_datastu($into_stu_father_addwordSql);
			if($into_stu_father_addword->system_insert=="yes"){
				//*****************************************
			}else{
				//*****************************************
			}			
		}
	}

//stu_father_addwordEnd ?>
<!--**************************************************************-->	
	<script>   
		$(document).ready(function(){
	// Noty plugin
    // ------------------------------

    // Override Noty defaults
			Noty.overrideDefaults({
        		theme: 'limitless',
        		layout: 'topRight',
        		type: 'alert',
        		timeout: 2500
    		});			
	   new Noty({
            text: 'บันทึกข้อมูลบิดา สำเร็จ.',
            type: 'success'
        }).show();
			
		});
	</script>
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
			
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$stu_id."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ทำรายการแก้ไขข้อมูลบิดา IP".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
		//****************************
			
		//****************************				
	}
	
	//echo $stu_id;
?>		
<!--**************************************************************-->
<?php 
//****************************************************************************	
?>
<!--------------------------------------------------------------------------->		
	<?php   }elseif($enter=="up_mother"){ ?>
<!--------------------------------------------------------------------------->
<?php
//****************************************************************************
	$mother_prefix=filter_input(INPUT_POST,'mother_prefix');
	$mother_fname=filter_input(INPUT_POST,'mother_fname');	
	$mother_sname=filter_input(INPUT_POST,'mother_sname');
	$mother_prefix_en=filter_input(INPUT_POST,'mother_prefix_en');
	$mother_fname_en=filter_input(INPUT_POST,'mother_fname_en');
	$mother_sname_en=filter_input(INPUT_POST,'mother_sname_en');	
	$mother_code=filter_input(INPUT_POST,'mother_code');	
	$mother_blood=filter_input(INPUT_POST,'mother_blood');	
	$mother_nation=filter_input(INPUT_POST,'mother_nation');
	$mother_sun=filter_input(INPUT_POST,'mother_sun');	
	$mother_IDReligion=filter_input(INPUT_POST,'mother_IDReligion');
	$mother_birthday=filter_input(INPUT_POST,'mother_birthday');
	$mother_career=filter_input(INPUT_POST,'mother_career');	
	$mother_careerOther=filter_input(INPUT_POST,'mother_careerOther');
	$mother_study=filter_input(INPUT_POST,'mother_study');	
	$mother_salary=filter_input(INPUT_POST,'mother_salary');
	$mother_workplace=filter_input(INPUT_POST,'mother_workplace');
	$mother_wp_pro=filter_input(INPUT_POST,'mother_wp_pro');	
	$mother_wp_tel=filter_input(INPUT_POST,'mother_wp_tel');	
	$mother_phone=filter_input(INPUT_POST,'mother_phone');
//stu_mother
    $ck_stu_motherSql="SELECT count(`stu_id`) as `countstu_mother` FROM `stu_mother` WHERE `stu_id`='{$stu_id}'";
	$ck_stu_mother=new notrow_datastu($ck_stu_motherSql);
	foreach($ck_stu_mother->datastu_array as $rc_key=>$ck_stu_motherRow){
		$countstu_mother=$ck_stu_motherRow["countstu_mother"];
		if($countstu_mother>=1){
			$up_stu_motherSql="UPDATE `stu_mother` SET `mother_prefix`='{$mother_prefix}',`mother_fname`='{$mother_fname}',`mother_sname`='{$mother_sname}',
			                  `mother_prefix_en`='{$mother_prefix_en}',`mother_fname_en`='{$mother_fname_en}',`mother_sname_en`='{$mother_sname_en}',`mother_code`='{$mother_code}',
							  `mother_blood`='{$mother_blood}',`mother_nation`='{$mother_nation}',`mother_sun`='{$mother_sun}',`mother_IDReligion`='{$mother_IDReligion}',
							  `mother_birthday`='{$mother_birthday}',`mother_career`='{$mother_career}',`mother_careerOther`='{$mother_careerOther}',
							  `mother_study`='{$mother_study}',`mother_salary`='{$mother_salary}',`mother_workplace`='{$mother_workplace}',
							  `mother_wp_pro`='{$mother_wp_pro}',`mother_wp_tel`='{$mother_wp_tel}',`mother_phone`='{$mother_phone}' WHERE`stu_id`='{$stu_id}'";
			$up_stu_mother=new insert_datastu($up_stu_motherSql);
			if($up_stu_mother->system_insert=="yes"){
				//*****************************************
			}else{ 
				//*****************************************
			}
		}else{
			$into_stu_motherSql="INSERT INTO `stu_mother` (`stu_id`, `mother_prefix`, `mother_fname`, `mother_sname`, `mother_prefix_en`, `mother_fname_en`, `mother_sname_en`, `mother_code`, `mother_blood`, `mother_nation`, `mother_sun`, `mother_IDReligion`, `mother_birthday`, `mother_career`, `mother_careerOther`, `mother_study`, `mother_salary`, `mother_workplace`, `mother_wp_pro`, `mother_wp_tel`, `mother_phone`) 
			                     VALUES ('{$stu_id}', '{$mother_prefix}', '{$mother_fname}', '{$mother_sname}', '{$mother_prefix_en}', '{$mother_fname_en}', '{$mother_sname_en}', '{$mother_code}', '{$mother_blood}', '{$mother_nation}', '{$mother_sun}', '{$mother_IDReligion}', '{$mother_birthday}', '{$mother_career}', '{$mother_careerOther}', '{$mother_study}', '{$mother_salary}', '{$mother_workplace}', '{$mother_wp_pro}', '{$mother_wp_tel}', '{$mother_phone}');";
			$into_stu_mother=new insert_datastu($into_stu_motherSql);
			if($into_stu_mother->system_insert=="yes"){
				//*****************************************
			}else{
				//*****************************************
			}			
		}
	}
//stu_mother end 

//stu_mother_address
	$mother_hno=filter_input(INPUT_POST,'mother_hno');
	$mother_moo=filter_input(INPUT_POST,'mother_moo');
	$mother_soi=filter_input(INPUT_POST,'mother_soi');
	$mother_road=filter_input(INPUT_POST,'mother_road');
	$mother_tumbon=filter_input(INPUT_POST,'mother_tumbon');
	$mother_amphur=filter_input(INPUT_POST,'mother_amphur');
	$mother_province=filter_input(INPUT_POST,'mother_province');
	$mother_zipcode=filter_input(INPUT_POST,'mother_zipcode');

    $ck_stu_mother_addressSql="SELECT count(`stu_id`)  as` count_sma` FROM `stu_mother_address` WHERE `stu_id`='{$stu_id}';";
	$ck_stu_mother_address=new notrow_datastu($ck_stu_mother_addressSql);
	foreach($ck_stu_mother_address->datastu_array as $rc_key=>$ck_stu_mother_addressRow){
		$count_sma=$ck_stu_mother_addressRow["count_sma"];
		if($count_sma>=1){
			$up_stu_mother_addressSql="UPDATE `stu_mother_address` SET `mother_hno`='{$mother_hno}',`mother_moo`='{$mother_moo}',`mother_soi`='{$mother_soi}',
									  `mother_road`='{$mother_road}',`mother_tumbon`='{$mother_tumbon}',`mother_amphur`='{$mother_amphur}',
									  `mother_province`='{$mother_province}',`mother_zipcode`='{$mother_zipcode}' WHERE `stu_id`='{$stu_id}'";
			$up_stu_mother_address=new insert_datastu($up_stu_mother_addressSql);
			if($up_stu_mother_address->system_insert=="yes"){
				//*****************************************
			}else{ 
				//*****************************************
			}
		}else{
			$into_stu_mother_addressSql="INSERT INTO `stu_mother_address` (`stu_id`, `mother_hno`, `mother_moo`, `mother_soi`, `mother_road`, `mother_tumbon`, `mother_amphur`, `mother_province`, `mother_zipcode`) 
										 VALUES ('{$stu_id}', '{$mother_hno}', '{$mother_moo}', '{$mother_soi}', '{$mother_road}', '{$mother_tumbon}', '{$mother_amphur}', '{$mother_province}', '{$mother_zipcode}');";
			$into_stu_mother_address=new insert_datastu($into_stu_mother_addressSql);
			if($into_stu_mother_address->system_insert=="yes"){
				//*****************************************
			}else{
				//*****************************************
			}			
		}
	}
//stu_mother_addressend 

//stu_mother_addword
	$mother_wordhno=filter_input(INPUT_POST,'mother_wordhno');	
	$mother_wordmoo=filter_input(INPUT_POST,'mother_wordmoo');	
	$mother_wordsoi=filter_input(INPUT_POST,'mother_wordsoi');	
	$mother_wordroad=filter_input(INPUT_POST,'mother_wordroad');
	$mother_wordtumbon=filter_input(INPUT_POST,'mother_wordtumbon');
	$mother_wordamphur=filter_input(INPUT_POST,'mother_wordamphur');	
	$mother_wordprovince=filter_input(INPUT_POST,'mother_wordprovince');	
	$mother_wordzipcode=filter_input(INPUT_POST,'mother_wordzipcode');

    $ck_stu_mother_addwordSql="SELECT COUNT(`stu_id`) as `count_smaw` FROM `stu_mother_addword` WHERE `stu_id`='{$stu_id}';";
	$ck_stu_mother_addword=new notrow_datastu($ck_stu_mother_addwordSql);
	foreach($ck_stu_mother_addword->datastu_array as $rc_key=>$ck_stu_mother_addwordRow){
		$count_smaw=$ck_stu_mother_addwordRow["count_smaw"];
		if($count_smaw>=1){
			$up_stu_mother_addwordSql="UPDATE `stu_mother_addword` SET `mother_wordhno`='{$mother_wordhno}',`mother_wordmoo`='{$mother_wordmoo}',
									  `mother_wordsoi`='{$mother_wordsoi}',`mother_wordroad`='{$mother_wordroad}',`mother_wordtumbon`='{$mother_wordtumbon}',
									  `mother_wordamphur`='{$mother_wordamphur}',`mother_wordprovince`='{$mother_wordprovince}',`mother_wordzipcode`='{$mother_wordzipcode}'
 									   WHERE `stu_id`='{$stu_id}'";
			$up_stu_mother_addword=new insert_datastu($up_stu_mother_addwordSql);
			if($up_stu_mother_addword->system_insert=="yes"){
				//*****************************************
			}else{ 
				//*****************************************
			}
		}else{
			$into_stu_mother_addwordSql="INSERT INTO `stu_mother_addword` (`stu_id`, `mother_wordhno`, `mother_wordmoo`, `mother_wordsoi`, `mother_wordroad`, `mother_wordtumbon`, `mother_wordamphur`, `mother_wordprovince`, `mother_wordzipcode`) 
										 VALUES ('{$stu_id}', '{$mother_wordhno}', '{$mother_wordmoo}', '{$mother_wordsoi}', '{$mother_wordroad}', '{$mother_wordtumbon}', '{$mother_wordamphur}', '{$mother_wordprovince}', '{$mother_wordzipcode}');";
			$into_stu_mother_addword=new insert_datastu($into_stu_mother_addwordSql);
			if($into_stu_mother_addword->system_insert=="yes"){
				//*****************************************
			}else{
				//*****************************************
			}			
		}
	}
//stu_mother_addwordEnd ?>
<!--**************************************************************-->	
	<script>   
		$(document).ready(function(){
	// Noty plugin
    // ------------------------------

    // Override Noty defaults
			Noty.overrideDefaults({
        		theme: 'limitless',
        		layout: 'topRight',
        		type: 'alert',
        		timeout: 2500
    		});			
	   new Noty({
            text: 'บันทึกข้อมูลมารดา สำเร็จ.',
            type: 'success'
        }).show();
			
		});
	</script>
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
			
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$stu_id."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ทำรายการแก้ไขข้อมูลมารดา IP".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
		//****************************
			
		//****************************				
	}
?>		
<!--**************************************************************-->
<?php //****************************************************************************	?>
<!--------------------------------------------------------------------------->		
	<?php   }elseif($enter=="up_guardian"){ ?>
<!--------------------------------------------------------------------------->	

<?php 

//stu_guardian

	$parent_prefix=filter_input(INPUT_POST,'parent_prefix');	
	$parent_fname=filter_input(INPUT_POST,'parent_fname');	
	$parent_sname=filter_input(INPUT_POST,'parent_sname');	
	$parent_prefix_en=filter_input(INPUT_POST,'parent_prefix_en');	
	$parent_fname_en=filter_input(INPUT_POST,'parent_fname_en');
	$parent_sname_en=filter_input(INPUT_POST,'parent_sname_en');		
	$parent_code=filter_input(INPUT_POST,'parent_code');		
	$guardian_birthday=filter_input(INPUT_POST,'guardian_birthday');	
	$parent_phone=filter_input(INPUT_POST,'parent_phone');	
	$parent_blood=filter_input(INPUT_POST,'parent_blood');	
	$parent_nation=filter_input(INPUT_POST,'parent_nation');	
	$parent_sun=filter_input(INPUT_POST,'parent_sun');		
	$parent_IDReligion=filter_input(INPUT_POST,'parent_IDReligion');	
	$parent_birthday=filter_input(INPUT_POST,'parent_birthday');	
	$parent_career=filter_input(INPUT_POST,'parent_career');	
	$parent_careerOther=filter_input(INPUT_POST,'parent_careerOther');	
	$parent_study=filter_input(INPUT_POST,'parent_study');	
	$parent_salary=filter_input(INPUT_POST,'parent_salary');	
	$parent_workplace=filter_input(INPUT_POST,'parent_workplace');	
	$parent_family=filter_input(INPUT_POST,'parent_family');	
	$parent_wp_pro=filter_input(INPUT_POST,'parent_wp_pro');	
	$parent_wp_tel=filter_input(INPUT_POST,'parent_wp_tel');
	$parent_status=filter_input(INPUT_POST,'parent_status');
	

	$parent_statusA=filter_input(INPUT_POST,'parent_statusA'); // 2
	$parent_statusB=filter_input(INPUT_POST,'parent_statusB'); // 3
	$parent_statusC=filter_input(INPUT_POST,'parent_statusC'); // 5
	$parent_statusD=filter_input(INPUT_POST,'parent_statusD'); // 0
	
	
	/*if($parent_statusA=="2"){
		$parent_status=$parent_statusA;
	}else{
		if($parent_statusB=="3"){
			$parent_status=$parent_statusB;
		}else{
			if($parent_statusC=="5"){
				$parent_status=$parent_statusC;
			}else{
				$parent_status;
			}
		}
	}*/
	
	
	/*if($parent_statusA=="2"){
		$keep_status=$parent_statusA;
	}
	
	if($parent_statusB=="3"){
		$keep_status=$parent_statusB;
	}

	if($parent_statusC=="5"){
		$keep_status=$parent_statusC;
	}	
	
	if($parent_statusD=="0"){
		$keep_status=="";
	}
	
	if($keep_status!=""){
		$parent_status=$keep_status;
	}else{
		$parent_status;
	}*/
	
	
	
	
	
	/*if($parent_statusA!="" and $parent_statusB=="" and $parent_statusC=="" and $parent_statusD==""){
		$parent_status="2";
	}elseif($parent_statusA=="" and $parent_statusB!="" and $parent_statusC=="" and $parent_statusD==""){
		$parent_status="3";
	}elseif($parent_statusA=="" and $parent_statusB=="" and $parent_statusC!="" and $parent_statusD==""){
		$parent_status="5";
	}else{
		$parent_status;
	}*/
	
	
    $ck_stu_guardianSql="SELECT count(`stu_id`) as `count_guardian` FROM `stu_guardian` WHERE `stu_id`='{$stu_id}'";
	$ck_stu_guardian=new notrow_datastu($ck_stu_guardianSql);
	foreach($ck_stu_guardian->datastu_array as $rc_key=>$ck_stu_guardianRow){
		$count_guardian=$ck_stu_guardianRow["count_guardian"];
		if($count_guardian>=1){
			$up_stu_guardianSql="UPDATE `stu_guardian` SET `parent_prefix`='{$parent_prefix}',`parent_fname`='{$parent_fname}',`parent_sname`='{$parent_sname}',`parent_prefix_en`='{$parent_prefix_en}',
						        `parent_fname_en`='{$parent_fname_en}',`parent_sname_en`='{$parent_sname_en}',`parent_code`='{$parent_code}',`guardian_birthday`='{$guardian_birthday}',`parent_phone`='{$parent_phone}',
								`parent_blood`='{$parent_blood}',`parent_nation`='{$parent_nation}',`parent_sun`='{$parent_sun}',`parent_IDReligion`='{$parent_IDReligion}',`parent_birthday`='{$parent_birthday}',
								`parent_career`='{$parent_career}',`parent_careerOther`='{$parent_careerOther}',`parent_study`='{$parent_study}',`parent_salary`='{$parent_salary}',`parent_workplace`='{$parent_workplace}',
								`parent_family`='{$parent_family}',`parent_wp_pro`='{$parent_wp_pro}',`parent_wp_tel`='{$parent_wp_tel}',`parent_status`='{$parent_status}' WHERE`stu_id`='{$stu_id}';";
			$up_stu_guardian=new insert_datastu($up_stu_guardianSql);
			if($up_stu_guardian->system_insert=="yes"){
				//*****************************************
			}else{ 
				//*****************************************
			}
		}else{
			$into_stu_guardianSql="INSERT INTO `stu_guardian` (`stu_id`, `parent_prefix`, `parent_fname`, `parent_sname`, `parent_prefix_en`, `parent_fname_en`, `parent_sname_en`, `parent_code`, `guardian_birthday`, `parent_phone`, `parent_blood`, `parent_nation`, `parent_sun`, `parent_IDReligion`, `parent_birthday`, `parent_career`, `parent_careerOther`, `parent_study`, `parent_salary`, `parent_workplace`, `parent_family`, `parent_wp_pro`, `parent_wp_tel`,`parent_status`) 
								   VALUES ('{$stu_id}', '{$parent_prefix}', '{$parent_fname}', '{$parent_sname}', '{$parent_prefix_en}', '{$parent_fname_en}', '{$parent_sname_en}', '{$parent_code}', '{$guardian_birthday}', '{$parent_phone}', '{$parent_blood}', '{$parent_nation}', '{$parent_sun}', '{$parent_IDReligion}', '{$parent_birthday}', '{$parent_career}', '{$parent_careerOther}', '{$parent_study}', '{$parent_salary}', '{$parent_workplace}', '{$parent_family}', '{$parent_wp_pro}', '{$parent_wp_tel}','{$parent_status}');";
			$into_stu_guardian=new insert_datastu($into_stu_guardianSql);
			if($into_stu_guardian->system_insert=="yes"){
				//*****************************************
			}else{
				//*****************************************
			}			
		}
	}
//stu_guardian End


//stu_guardian_address

	$parent_hno=filter_input(INPUT_POST,'parent_hno');	
	$parent_moo=filter_input(INPUT_POST,'parent_moo');	
	$parent_soi=filter_input(INPUT_POST,'parent_soi');	
	$parent_road=filter_input(INPUT_POST,'parent_road');	
	$parent_tumbon=filter_input(INPUT_POST,'parent_tumbon');
	$parent_amphur=filter_input(INPUT_POST,'parent_amphur');
	$parent_province=filter_input(INPUT_POST,'parent_province');
	$parent_zipcode=filter_input(INPUT_POST,'parent_zipcode');	
	$parent_stu=filter_input(INPUT_POST,'parent_stu');

    $ck_stu_guardian_addressSql="SELECT count(`stu_id`)  as `count_sga` FROM `stu_guardian_address` WHERE `stu_id`='{$stu_id}'";
	$ck_stu_guardian_address=new notrow_datastu($ck_stu_guardian_addressSql);
	foreach($ck_stu_guardian_address->datastu_array as $rc_key=>$ck_stu_guardian_addressRow){
		$count_sga=$ck_stu_guardian_addressRow["count_sga"];
		if($count_sga>=1){
			$up_stu_guardian_addressSql="UPDATE `stu_guardian_address` SET `parent_hno`='{$parent_hno}',`parent_moo`='{$parent_moo}',`parent_soi`='{$parent_soi}',`parent_road`='{$parent_road}',
										`parent_tumbon`='{$parent_tumbon}',`parent_amphur`='{$parent_amphur}',`parent_province`='{$parent_province}',`parent_zipcode`='{$parent_zipcode}',`parent_stu`='{$parent_stu}' WHERE `stu_id`='{$stu_id}'";
			$up_stu_guardian_address=new insert_datastu($up_stu_guardian_addressSql);
			if($up_stu_guardian_address->system_insert=="yes"){
				//*****************************************
			}else{ 
				//*****************************************
			}
		}else{
			$into_stu_guardian_addressSql="INSERT INTO `stu_guardian_address` (`stu_id`, `parent_hno`, `parent_moo`, `parent_soi`, `parent_road`, `parent_tumbon`, `parent_amphur`, `parent_province`, `parent_zipcode`, `parent_stu`) 
										   VALUES ('{$stu_id}', '{$parent_hno}', '{$parent_moo}', '{$parent_soi}', '{$parent_road}', '{$parent_tumbon}', '{$parent_amphur}', '{$parent_province}', '{$parent_zipcode}', '{$parent_stu}');";
			$into_stu_guardian_address=new insert_datastu($into_stu_guardian_addressSql);
			if($into_stu_guardian_address->system_insert=="yes"){
				//*****************************************
			}else{
				//*****************************************
			}			
		}
	}
//stu_guardian_addressEnd


//stu_guardian_addword

	$parent_addwordhno=filter_input(INPUT_POST,'parent_addwordhno');		
	$parent_addwordmoo=filter_input(INPUT_POST,'parent_addwordmoo');		
	$parent_addwordsoi=filter_input(INPUT_POST,'parent_addwordsoi');		
	$parent_addwordroad=filter_input(INPUT_POST,'parent_addwordroad');	
	$parent_addwordtumbon=filter_input(INPUT_POST,'parent_addwordtumbon');	
	$parent_addwordamphur=filter_input(INPUT_POST,'parent_addwordamphur');	
	$parent_addwordprovince=filter_input(INPUT_POST,'parent_addwordprovince');	
	$parent_addwordzipcode=filter_input(INPUT_POST,'parent_addwordzipcode');		
	$parent_addwordstu=filter_input(INPUT_POST,'parent_addwordstu');	

    $ck_stu_guardian_addwordSql="SELECT count(`stu_id`) as `count_sgaw` FROM `stu_guardian_addword` WHERE `stu_id`='{$stu_id}';";
	$ck_stu_guardian_addword=new notrow_datastu($ck_stu_guardian_addwordSql);
	foreach($ck_stu_guardian_addword->datastu_array as $rc_key=>$ck_stu_guardian_addwordRow){
		$count_sgaw=$ck_stu_guardian_addwordRow["count_sgaw"];
		if($count_sgaw>=1){
			$up_stu_guardian_addwordSql="UPDATE `stu_guardian_addword` SET `parent_addwordhno`='{$parent_addwordhno}',`parent_addwordmoo`='{$parent_addwordmoo}',`parent_addwordsoi`='{$parent_addwordsoi}',
										`parent_addwordroad`='{$parent_addwordroad}',`parent_addwordtumbon`='{$parent_addwordtumbon}',`parent_addwordamphur`='{$parent_addwordamphur}',`parent_addwordprovince`='{$parent_addwordprovince}',
										`parent_addwordzipcode`='{$parent_addwordzipcode}',`parent_addwordstu`='{$parent_addwordstu}' WHERE `stu_id`='{$stu_id}';";
			$up_stu_guardian_addword=new insert_datastu($up_stu_guardian_addwordSql);
			if($up_stu_guardian_addword->system_insert=="yes"){
				//*****************************************
			}else{ 
				//*****************************************
			}
		}else{
			$into_stu_guardian_addwordSql="INSERT INTO `stu_guardian_addword` (`stu_id`, `parent_addwordhno`, `parent_addwordmoo`, `parent_addwordsoi`, `parent_addwordroad`, `parent_addwordtumbon`, `parent_addwordamphur`, `parent_addwordprovince`, `parent_addwordzipcode`, `parent_addwordstu`)
										   VALUES ('{$stu_id}', '{$parent_addwordhno}', '{$parent_addwordmoo}', '{$parent_addwordsoi}', '{$parent_addwordroad}', '{$parent_addwordtumbon}', '{$parent_addwordamphur}', '{$parent_addwordprovince}', '{$parent_addwordzipcode}', '{$parent_addwordstu}');";
			$into_stu_guardian_addword=new insert_datastu($into_stu_guardian_addwordSql);
			if($into_stu_guardian_addword->system_insert=="yes"){
				//*****************************************
			}else{
				//*****************************************
			}			
		}
	}

//stu_guardian_addwordEnd ?>

<!--**************************************************************-->	
	<script>   
		$(document).ready(function(){
	// Noty plugin
    // ------------------------------

    // Override Noty defaults
			Noty.overrideDefaults({
        		theme: 'limitless',
        		layout: 'topRight',
        		type: 'alert',
        		timeout: 2500
    		});			
	   new Noty({
            text: 'บันทึกข้อมูลผู้ปกครอง สำเร็จ.',
            type: 'success'
        }).show();
			
		});
	</script>
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
			
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$stu_id."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ทำรายการแก้ไขข้อมูลผู้ปกครอง IP".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 
		//****************************
			
		//****************************				
	}
?>		
<!--**************************************************************-->


<?php //**** ?>


<!--------------------------------------------------------------------------->	
	<?php	}else{ ?>
<!--**************************************************************-->	
	<script>   
		$(document).ready(function(){
	// Noty plugin
    // ------------------------------

    // Override Noty defaults
			Noty.overrideDefaults({
        		theme: 'limitless',
        		layout: 'topRight',
        		type: 'alert',
        		timeout: 2500
    		});			
	   new Noty({
            text: 'เกิดข้อผิดพลาดในระบบไม่สามารถทำรายการได้',
            type: 'warning'
        }).show();
			
		});
	</script>	
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
			
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$stu_id."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ทำรายการแก้ไขข้อมูลเกิดข้อผิดพลาดในระบบไม่สามารถทำรายการได้ IP".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 
		//****************************
			
		//****************************				
	}
?>		
<!--**************************************************************-->				

	<?php		}
		}
	
	?>


	
</body>
</html>