<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
//--------------------------------------------------------------------
	if($this->session->userdata("rc_user")==null){
		$this->session->unset_userdata("rc_user");
		exit("<script>window.location='$golink/print_imgstu/error';</script>");
	}else{
		$LoginKey=$this->session->userdata("rc_user");
		$admin_log=$this->load->database("default",TRUE);		
		$admin_log=$this->db->query("SELECT COUNT(`login_id`) AS `int_uesr` 
									 FROM `login` 
									 WHERE `use_status`='1' 
									 AND `login_id`='{$LoginKey}'");
		foreach($admin_log->result_array() as $log_row){
			if($log_row["int_uesr"]>=1){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<style>
.psrA{
	margin: auto;
	border: 3px solid #73AD21;
}
</style>

<?php	
    include("view/database/database_evaluation.php");
	include("view/database/pdo_data.php");
	include("view/database/pdo_conndatastu.php");
	include("view/database/pdo_admission.php");	

    include("view/database/class_pdodatastu.php");
	include("view/database/regina_student.php");

	include("view/database/class_admin.php");
	



	/*$txt_year=post_data(filter_input(INPUT_POST,'txt_year'));
	$txt_class=post_data(filter_input(INPUT_POST,'txt_class'));
	$txt_room=post_data(filter_input(INPUT_POST,'txt_room'));*/
	
	/*$txt_year="1/2564";
	$txt_class="23";
	$txt_room="1";*/
	
//input data    
    //$stu_key
//input data end

?>


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
		<title>พิมพ์&nbsp;รายงานข้อมูลคะแนน&nbsp;กิจกรรมสำหรับวัดและประเมินผล</title>
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
				width: 210mm; height: 297mm;
			}
			.imgA{
				width: 210mm; height: 297mm;
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
						<table class="table" align="center">
							<thead>
								<tr>
									<th style="width: 20%">
										<div><button type="button" style="font-size: 18px;" class="btn btn-default" onclick="window.print()"><b>พิมพ์ รายงานข้อมูลคะแนน กิจกรรมสำหรับวัดและประเมินผล</b></button></div>
									</th>
								</tr>
								<tr>
									<th style="width: 20%">
										<div style="font-size: 18px;"><font color="#F70105"><b>ระบบการพิมพ์  รองรับ เว็บเบราว์เซอร์  Google Chrome และ  Microsoft Edge เท่านั้น<b></font></div>
									</th>								
								</tr>
							</thead>						
						</table>
						<table class="table" align="center">
							<thead>
								<tr>
									<th style="width: 20%; font-size: 18px;"><div>ขนาดกระดาษ</div></th>
									<th style="width: 20%; font-size: 18px;"><div>แนวกระดาษ</div></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><div style="font-size: 18px;">A4&nbsp;:&nbsp;210mm&nbsp;X&nbsp;296mm</div></td>
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
        $SudtentDataClass=new PrintReginaYearClass3($psdc_year,$psdc_term,$psdc_class);
        foreach($SudtentDataClass->RunReginaStuClass() as $rc=>$PeintSudtentDataClass){ 
            $stu_key=$PeintSudtentDataClass["rsd_studentid"]; ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<?php
    	if((file_exists("view/all/$stu_key.jpg"))){
                $user_img="$stu_key.jpg";
        }else{
            if((file_exists("view/all/$stu_key.JPG"))){
                $user_img="$stu_key.JPG";                       
            }else{
                $user_img="newimg_rc.jpg";                        
            }
        }

        $Print_PRSC=new PrintReginaStuDataClass($stu_key);



        $stu_depend_stuSql="SELECT * FROM `depend_stu` WHERE `ds_stuid`='{$stu_key}'";
        $stu_depend_stu=new notrow_datastu($stu_depend_stuSql);
        foreach($stu_depend_stu->datastu_array as $rc_key=>$stu_depend_stuRow){}


        $data_studentSql="SELECT * FROM `data_student` WHERE `stu_id`='{$stu_key}'";
        $data_student=new notrow_datastu($data_studentSql);
        foreach($data_student->datastu_array as $rc_key=>$data_studentrow){}


        $stu_nation=new db_country($data_studentrow["stu_nation"]);
        $stu_sun=new  db_country($data_studentrow["stu_sun"]);


        $rc_religionSql="SELECT `Religion` FROM `rc_religion` WHERE `IDReligion`='{$data_studentrow["IDReligion"]}';";
        $rc_religion=new notrow_datastu($rc_religionSql);
        foreach($rc_religion->datastu_array as $rc_key=>$rc_religionRow){
            $Religion=$rc_religionRow["Religion"];
        }

        $stu_addressSql="SELECT * FROM `stu_address` WHERE `stu_id`='{$stu_key}'";
        $stu_address=new notrow_datastu($stu_addressSql);
        foreach($stu_address->datastu_array as $rc_key=>$stu_addressRow){}
        
        $stu_tumbon=new data_Subdistrict ($stu_addressRow["stu_tumbon"]); // ตำบล
        $stu_amphur=new data_District ($stu_addressRow["stu_amphur"]); //อำเภอ
        $stu_province=new data_Province($stu_addressRow["stu_province"]); //จังหวัด


        $stu_fatherSql="SELECT * FROM `stu_father` WHERE `stu_id`='{$stu_key}'";
        $stu_father=new notrow_datastu($stu_fatherSql);
        foreach($stu_father->datastu_array as $rc_key=>$stu_fatherRow){}

        $f_np=new stu_prefix($stu_fatherRow["father_prefix"]);
        $myname_f=$f_np->prefix_prefixname."&nbsp;".$stu_fatherRow["father_fname"]."&nbsp;".$stu_fatherRow["father_sname"];
        
        $stu_father_addwordSql="SELECT * FROM `stu_father_addword` WHERE `stu_id`='{$stu_key}'";
        $stu_father_addword=new notrow_datastu($stu_father_addwordSql);
        foreach($stu_father_addword->datastu_array as $rc_key=>$stu_father_addwordRow){}

        $father_addwordprovince=new data_Province($stu_father_addwordRow["father_addwordprovince"]);

        $data_FcareerSql="SELECT `dc_key`, `dc_txt2` FROM `data_career` WHERE `dc_key`='{$stu_fatherRow["father_career"]}'";
        $data_FcareerRs=new notrow_datastu($data_FcareerSql);
        foreach($data_FcareerRs->datastu_array as $rc_key=>$data_FcareerRow){
            if(isset($data_FcareerRow["dc_txt2"])){
                $Fcareer=$data_FcareerRow["dc_txt2"];
            }else{
                $Fcareer="-";
            }
        }

        $stu_motherSql="SELECT * FROM `stu_mother` WHERE`stu_id`='{$stu_key}';";
        $stu_mother=new notrow_datastu($stu_motherSql);
        foreach($stu_mother->datastu_array as $rc_key=>$stu_motherRow){}        

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


        $call_data_student=new data_student($stu_key);
				
        //ds_OriginalClass
        $ds_OriginalClass=new print_level($call_data_student->ds_OriginalClass);

		//stu_physical
        $stu_physical=new data_disabled($call_data_student->stu_physical);	

	    //depend_stu
        $call_depend_stu=new depend_stu($stu_key);	


        
        //stu_father
            $call_stu_father=new stu_father($stu_key);	
        //father_prefix
            $father_prefix=new stu_prefix($call_stu_father->father_prefix);
        //father_prefix_en	
            $father_prefix_en=new stu_prefix($call_stu_father->father_prefix_en);
        //sf_nation
            $sf_nation=new db_country($call_stu_father->sf_nation);
        //sf_sun	
            $sf_sun=new db_country($call_stu_father->sf_sun);
        //sf_IDReligion
            $sf_IDReligion=new rc_religion($call_stu_father->sf_IDReligion);
        //father_career
            $call_father_career=new data_career($call_stu_father->father_career);
        //father_study
            $call_father_study=new data_study($call_stu_father->father_study);
        //father_salary
            $call_father_salary=new data_incom($call_stu_father->father_salary);
        
	
        
        //stu_father_addword
            $call_stu_father_addword=new stu_father_addword($rsd_studentid);
            $father_addwordtumbon=new data_Subdistrict($call_stu_father_addword->father_addwordtumbon);//$father_addwordtumbon->DISTRICT_NAME
            $father_addwordamphur=new data_District($call_stu_father_addword->father_addwordamphur);//$father_addwordamphur->AMPHUR_NAME
            $father_addwordprovince=new data_Province($call_stu_father_addword->father_addwordprovince);//$father_addwordprovince->PROVINCE_NAME
        
//------------------------------------------------------------------------------		
        
        //stu_father_address
            $call_stu_father_address=new stu_father_address($rsd_studentid);
            $father_tumbon=new data_Subdistrict($call_stu_father_address->father_tumbon);//$father_tumbon->DISTRICT_NAME
            $father_amphur=new data_District($call_stu_father_address->father_amphur);//$father_amphur->AMPHUR_NAME
            $father_province=new data_Province($call_stu_father_address->father_province);//$father_province->PROVINCE_NAME
            
        
//------------------------------------------------------------------------------

 
//------------------------------------------------------------------------------	
				
				//stu_mother
					$call_stu_mother=new stu_mother($stu_key);
				//mother_prefix
					$mother_prefix=new stu_prefix($call_stu_mother->mother_prefix);
				//mother_prefix_en	
					$mother_prefix_en=new stu_prefix($call_stu_mother->mother_prefix_en);
				//mother_nation
					$mother_nation=new db_country($call_stu_mother->mother_nation);
				//mother_sun	
					$mother_sun=new db_country($call_stu_mother->mother_sun);
				//mother_IDReligion
					$mother_IDReligion=new rc_religion($call_stu_mother->mother_IDReligion);
				//mother_career
					$mother_career=new data_career($call_stu_mother->mother_career);
				//mother_study
					$mother_study=new data_study($call_stu_mother->mother_study);
				//mother_salary
					$mother_salary=new data_incom($call_stu_mother->mother_salary);				
				
							
//------------------------------------------------------------------------------			
//------------------------------------------------------------------------------
				
				//stu_mother_addword
					$call_stu_mother_addword=new stu_mother_addword($rsd_studentid);
					$mother_wordtumbon=new data_Subdistrict($call_stu_mother_addword->mother_wordtumbon);//$mother_wordtumbon->DISTRICT_NAME
					$mother_wordamphur=new data_District($call_stu_mother_addword->mother_wordamphur);//$mother_wordamphur->AMPHUR_NAME
					$mother_wordprovince=new data_Province($call_stu_mother_addword->mother_wordprovince);//$mother_wordprovince->PROVINCE_NAME
				
//------------------------------------------------------------------------------
			
				//stu_mother_address
					$call_stu_mother_address=new stu_mother_address($rsd_studentid);
			
					$mother_tumbon=new data_Subdistrict($call_stu_mother_address->mother_tumbon);//$mother_tumbon->DISTRICT_NAME
					$mother_amphur=new data_District($call_stu_mother_address->mother_amphur);//$mother_amphur->AMPHUR_NAME
					$mother_province=new data_Province($call_stu_mother_address->mother_province);//$mother_province->PROVINCE_NAME
		
//------------------------------------------------------------------------------




		switch($Print_PRSC->PRS_home){
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


    ?>





	<section class="sheet padding-10mm imgA";>
		<table style="width: 690 px;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                    <td  style="width: 650px;">
                        <div style="font-size: 25px; font-weight: bold; text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 75px; height: 73px;" alt=""/></div>
						<div style="font-size: 25px; font-weight: bold; text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แบบบันทึกข้อมูลนักเรียนรายบุคคล</div>
                        <div style="font-size: 25px; font-weight: bold; text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;เชียงใหม่&nbsp;(Regina&nbsp;Coeli&nbsp;College)</div>
                    </td>
                    <td style="width: 40px;">
                        <div>
                            <table style="width: 3.00cm; height: 4.00cm" border="1">
                                <tr>
                                    <td><img style="width: 3.00cm; height: 4.00cm" src="<?php echo base_url();?>view/all/<?php echo $user_img;?>" class="img-thumbnail" alt="<?php echo $stu_key;?>"></td>
                                </tr>
                            </table>
                        </div>
                    </td>				
				</tr>
			</tbody>
		</table>
        <br>
        <table style="width: 690 px;" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td  style="width: 690 px;">
                        <div style="font-size: 20px; font-weight: bold;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>เลขประจำตัวนักเรียน</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="20" value="&nbsp;<?php echo $stu_key;?>">
                            
                            <b>เลขบัตรประจำตัวประชาชน</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="20" value="&nbsp;<?php echo $Print_PRSC->PRS_Identification;?>">

                            <b>สีบ้าน</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="6" value="&nbsp;<?php echo $txt_home;?>">
                        </div>

                        <div style="font-size: 20px; font-weight: bold;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>ชื่อ ภาษาไทย</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="40" value="&nbsp;<?php echo $Print_PRSC->PRS_nameTH;?>">

                            <b>ชื่อ ภาษาอังกฤษ</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="32" value="&nbsp;<?php echo $Print_PRSC->PRS_nameEH;?>">
                        </div>

                        <div style="font-size: 20px; font-weight: bold;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>ชื่อเล่น ภาษาไทย</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="18" value="&nbsp;<?php echo @$Print_PRSC->PRS_nickTh;?>">

                            <b>ชื่อเล่น ภาษาอังกฤษ</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="17" value="&nbsp;<?php echo @$Print_PRSC->PRS_nickEn;?>">
                            
                            <b>วัน เดือน ปี เกิด</b>                            
            <?php
					if(($call_data_student->stu_birth=="" or $call_data_student->stu_birth==null or $call_data_student->stu_birth=="-")){ ?>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="12" value="&nbsp;">										
			<?php	}else{ ?>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="12" value="&nbsp;<?php echo dateThailand($call_data_student->stu_birth);?>">								
			<?php	} ?>



                       
                        </div>

                        <div style="font-size: 20px; font-weight: bold;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>เชื่อชาติ</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="9" value="&nbsp;<?php echo $stu_nation->nation_name_th;?>">
                           
                            <b>สัญชาติ</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="9" value="&nbsp;<?php echo $stu_sun->nation_name_th;?>">

                            <b>ศาสนา</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="7" value="&nbsp;<?php echo $Religion;?>">


                            <b>โทรศัพท์</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="9" value="&nbsp;<?php echo $data_studentrow["stu_phone"];?>">

                            <b>E-Mail</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="16" value="&nbsp;<?php echo $stu_key;?>@regina.ac.th">
                        </div>

                        <div style="font-size: 20px; font-weight: bold;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>ที่อยู่ปัจจุบัน เลขที่</b>
                            <input type="text" size="11" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_addressRow['stu_hno'];?>" readonly="readonly" required="required">
                            
                            <b>หมู่ที่</b>
                            <input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_addressRow['stu_moo'];?>" readonly="readonly" required="required">

                            <b>ถนน</b>
                            <input type="text" size="27" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_addressRow['stu_road'];?>" readonly="readonly" required="required">

                            <b>ซอย</b>
                            <input type="text" size="12" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_addressRow['stu_soi'];?>" readonly="readonly" required="required">
                        </div>

                        <div style="font-size: 20px; font-weight: bold;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>ตำบล</b>
                            <input type="text" size="17" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_tumbon->DISTRICT_NAME;?>" readonly="readonly" required="required">
                            
                            <b>อำเภอ</b>
                            <input type="text" size="19" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_amphur->AMPHUR_NAME;?>" readonly="readonly" required="required">
                            
                            <b>จังหวัด</b>
                            <input type="text" size="19" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_province->PROVINCE_NAME;?>" readonly="readonly" required="required">
                            
                            <b>รหัสไปรษณีย์</b>
                            <input type="text" size="4" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_addressRow["stu_zipcode"];?>" readonly="readonly" required="required">
                        </div>

                        <div style="font-size: 20px; font-weight: bold;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>ชื่อบิดา ภาษาไทย</b>
                            <input type="text" size="37" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_prefix->prefix_prefix_SName." ".$call_stu_father->father_fname." ".$call_stu_father->father_sname;?>" readonly="readonly" required="required">
                        
                            <b>ชื่อบิดา ภาษาอังกฤษ</b>
                            <input type="text" size="28" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_prefix_en->prefix_prefix_SName." ".$call_stu_father->father_fname_en." ".$call_stu_father->father_sname_en;?>" readonly="readonly" required="required">
                        </div>

                        <div style="font-size: 20px; font-weight: bold;"> 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;						
                            <b>เลขบัตรประชาชน</b>
                            <input type="text" size="13" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $call_stu_father->father_code; ?>" readonly="readonly" required="required">
                            
                            <b>วัน เดือน ปี เกิด</b>

            <?php
					if(($call_stu_father->af_birthday==null or $call_stu_father->af_birthday=="-")){ ?>
							<input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;" readonly="readonly" required="required">					
			<?php	}else{ ?>
                            <input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo dateThailand($call_stu_father->af_birthday);?>" readonly="readonly" required="required">	
			<?php	} ?>
                            
                            <b>อาชีพ</b>
                            <input type="text" size="28" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $Mcareer;?>" readonly="readonly" required="required">
                        


                        </div>

                        <div style="font-size: 20px; font-weight: bold;"> 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            <b>ตำแหน่งงาน</b>
                            <input type="text" size="40" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $call_stu_father->father_wp_pro;?>" readonly="readonly" required="required">
                            
                        
                            <b>สถานที่ทำงาน</b>
                            <input type="text" size="35" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_fatherRow['father_workplace'];?>" readonly="readonly" required="required">
                            

                        </div>

                        <div style="font-size: 20px; font-weight: bold;">  
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>จังหวัด</b>
                            <input type="text" size="15" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $father_addwordprovince->PROVINCE_NAME;?>" readonly="readonly" required="required">


                            <b>โทรศัพท์ที่ทำงาน</b>
                            <input type="text" size="12" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $call_stu_father->father_wp_tel;?>" readonly="readonly" required="required">

                            <b>โทรศัพท์</b>
                            <input type="text" size="10" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $call_stu_father->father_phone;?>" readonly="readonly" required="required">

                            <b>ช่วงรายได้</b>
                            <input type="text" size="14" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $call_father_salary->di_txt;?>" readonly="readonly" required="required">

                        </div>


                        <div style="font-size: 20px; font-weight: bold;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>ชื่อมารดา ภาษาไทย</b>
                            <input type="text" size="33" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_prefix->prefix_prefix_SName." ".$call_stu_mother->mother_fname." ".$call_stu_mother->mother_sname;?>" readonly="readonly" required="required">
                        
                            <b>ชื่อมารดา ภาษาอังกฤษ</b>
                            <input type="text" size="28" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_prefix_en->prefix_prefix_SName." ".$call_stu_mother->mother_fname_en." ".$call_stu_mother->mother_sname_en;?>" readonly="readonly" required="required">
                        
                        </div>
                        <div style="font-size: 20px; font-weight: bold;">   
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;						
                            <b>เลขบัตรประชาชน</b>
                            <input type="text" size="13" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $call_stu_mother->mother_code; ?>" readonly="readonly" required="required">
                            
                            <b>วัน เดือน ปี เกิด</b>

            <?php
					if(($call_stu_mother->mother_birthday==null or $call_stu_mother->mother_birthday=="-")){ ?>
							<input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;" readonly="readonly" required="required">					
			<?php	}else{ ?>
                            <input type="text" size="18" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo dateThailand($call_stu_mother->mother_birthday);?>" readonly="readonly" required="required">
			<?php	} ?>
                            
                            <b>อาชีพ</b>
                            <input type="text" size="28" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $Mcareer;?>" readonly="readonly" required="required">
                        


                        </div>

                        <div style="font-size: 20px; font-weight: bold;"> 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            <b>ตำแหน่งงาน</b>
                            <input type="text" size="40" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $call_stu_mother->mother_wp_pro;?>" readonly="readonly" required="required">
                            
                        
                            <b>สถานที่ทำงาน</b>
                            <input type="text" size="35" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $stu_motherRow['mother_workplace'];?>" readonly="readonly" required="required">
                            

                        </div>

                        <div style="font-size: 20px; font-weight: bold;">  
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>จังหวัด</b>
                            <input type="text" size="11" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_wordprovince->PROVINCE_NAME;?>" readonly="readonly" required="required">
                            

                            <b>โทรศัพท์ที่ทำงาน</b>
                            <input type="text" size="9" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $call_stu_mother->mother_wp_tel;?>" readonly="readonly" required="required">
                            
                            <b>โทรศัพท์</b>
                            <input type="text" size="9" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $call_stu_mother->mother_phone;?>" readonly="readonly" required="required">

                            <b>ช่วงรายได้ / เดือน</b>
                            <input type="text" size="16" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $mother_salary->di_txt;?>" readonly="readonly" required="required">

                        </div>

                        <div style="font-size: 20px; font-weight: bold;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>ชั้นเรียนสุดท้ายก่อนเข้าเรียนโรงเรียนเรยีนา<b>
                            <input type="text" size="14" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $ds_OriginalClass->level_Lname;?>" readonly="readonly" required="required">
                            
                            <b>โรงเรียนเดิม<b>
                            <input type="text" size="38" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" value="&nbsp;<?php echo $call_data_student->ds_SameSchool;?>" readonly="readonly" required="required">
                        <div>

                    </td>
                </tr>
            </tbody>
        </table>

        <br>
        <table style="width: 690 px;" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td  style="width: 690 px;">
					   	
                       <div style="font-size: 25px; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อมูลด้านสุขภาพ</div>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <table style="width: 690 px;" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td  style="width: 690 px;">
                        
                        <div style="font-size: 20px; font-weight: bold;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<b>กรุ๊ปเลือด</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="10" value="&nbsp;<?php echo $call_data_student->stu_blood;?>">
                            
                            <b>ความบกพร่องทางร่างกาย</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="58" value="&nbsp;<?php echo $stu_physical->disabled_txt;?>">


                        </div>

                        <div style="font-size: 20px; font-weight: bold;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<b>สถานที่เกิด (โรงพยาบาล)</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="81" value="&nbsp;<?php echo $call_data_student->breed_add;?>">
                            
                        </div>

                        <div style="font-size: 20px; font-weight: bold;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<b>โรคประจำตัว<b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="91" value="&nbsp;<?php echo $call_depend_stu->ds_CongenitalDisease;?>">
                               
                        </div>

                        <div style="font-size: 20px; font-weight: bold;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<b>การแพ้อาหาร</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="90" value="&nbsp;<?php echo $call_depend_stu->ds_FoodAllergies;?>">
                            
      
                        </div>       
                        <div style="font-size: 20px; font-weight: bold;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<b>การแพ้ยา<b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="94" value="&nbsp;<?php echo $call_depend_stu->ds_DrugAllergy;?>">
                            
                        </div>    
                      
                        <div style="font-size: 20px; font-weight: bold;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<b>การแพ้พิษ</b>
                            <input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew; font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="93" value="&nbsp;<?php echo $call_depend_stu->ds_allergic;?>">

                        </div>            
                     
                  
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <table style="width: 690 px;" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td  style="width: 690 px;">
                       <div  style="font-size: 25px; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;บันทึกเพิ่มเติม</div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="width: 690 px;" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td>
                        <div>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;  border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="131" value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;  border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="131" value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;  border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="131" value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;  border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter" size="131" value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</div>
                    </td>
                </tr>
            </tbody>
        </table>


    </section>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <?php    } ?>





				



          








	</body>
</html>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{
				$this->session->unset_userdata('rc_user');
				exit("<script>window.location='$golink/print_imgstu/error';</script>");		
			}
		}							 		
	}
?>