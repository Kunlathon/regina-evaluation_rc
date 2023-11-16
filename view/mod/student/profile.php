<?php
	include("view/database/pdo_data.php");
	include("view/database/pdo_conndatastu.php");
	include("view/database/pdo_admission.php");	
	
	include("view/database/class_pdo.php");	
	include("view/database/class_pdodatastu.php");
	include("view/database/regina_student.php");
	
	//error_reporting(error_reporting() & ~E_NOTICE); 
	
	
	$regina_stu_dataSql="SELECT * FROM `regina_stu_data` WHERE `rsd_studentid`='{$user_login}'";
	$regina_stu_data=new notrow_evaluation($regina_stu_dataSql);
	foreach($regina_stu_data->evaluation_array as $rc_key=>$regina_stu_datarow){
		
		//$rsc_num=$regina_stu_datarow["rsc_num"];
		$rsd_studentid=$regina_stu_datarow["rsd_studentid"];
		$rsd_Identification=$regina_stu_datarow["rsd_Identification"];
		$nickTh=$regina_stu_datarow["nickTh"];
		$nickEn=$regina_stu_datarow["nickEn"];
		$data_prefix=new print_prefix($regina_stu_datarow["rsd_prefix"]);
		//$data_plan=new print_plan($rsc_plan=$regina_stu_datarow["rsc_plan"]);
					
	 	$DataSudRegina=new PrintReginaStuDataClass($rsd_studentid);			
					
					
		//$name_th=$data_prefix->prefix_prefix_SName." ".$regina_stu_datarow["rsd_name"]." ".$regina_stu_datarow["rsd_surname"];
		//$name_en="Miss ".$regina_stu_datarow["rsd_nameEn"]." ".$regina_stu_datarow["rsd_surnameEn"];
		
		$name_th=$DataSudRegina->PRS_nameTH;
		$name_en=$DataSudRegina->PRS_nameEH;
					
			if(($regina_stu_datarow["rse_home"]==1)){
				$print_home="ฟ้า";
			}elseif(($regina_stu_datarow["rse_home"]==2)){
				$print_home="แดง";
			}elseif(($regina_stu_datarow["rse_home"]==3)){
				$print_home="เหลือง";
			}elseif(($regina_stu_datarow["rse_home"]==4)){
				$print_home="เขียว";
			}else{
				$print_home="-";
			}
				
	}

?>



				<?php
				//data_student
					$call_data_student=new data_student($user_login);
					
				//stu_nation
					$stu_nation=new	db_country($call_data_student->stu_nation);
				//stu_sun
					$stu_sun=new db_country($call_data_student->stu_sun);
				//IDReligion	
					$IDReligion=new rc_religion($call_data_student->IDReligion);
				//stu_physical
					$stu_physical=new data_disabled($call_data_student->stu_physical);	
				//breed_district
					$breed_district=new	data_Subdistrict($call_data_student->breed_district); //$stu_physical->DISTRICT_NAME
				//breed_city
					$breed_city=new data_District($call_data_student->breed_city); //$breed_city->AMPHUR_NAME
				//breed_province
					$breed_province=new data_Province($call_data_student->breed_province); //$breed_province->PROVINCE_NAME
				//ds_OriginalClass
					$ds_OriginalClass=new print_level($call_data_student->ds_OriginalClass);
					
				?>				
<!------------------------------------------------------------------------------>		
				<?php
				//stu_address_home
					$call_stu_address_home=new stu_address_home($user_login);
				
					$stu_reg_tumbon=new data_Subdistrict($call_stu_address_home->stu_reg_tumbon); //$stu_reg_tumbon->DISTRICT_NAME
					$stu_reg_amphur=new data_District($call_stu_address_home->stu_reg_amphur); //$stu_reg_amphur->AMPHUR_NAME
					$stu_reg_province=new data_Province($call_stu_address_home->stu_reg_province); //$stu_reg_province->PROVINCE_NAME
					
				
				?>
		
<!------------------------------------------------------------------------------>		
				<?php
				//stu_address
					$call_stu_address=new stu_address($user_login);
					
					$stu_tumbon=new data_Subdistrict($call_stu_address->stu_tumbon); //$stu_tumbon->DISTRICT_NAME
					$stu_amphur=new data_District($call_stu_address->stu_amphur); //$stu_amphur->AMPHUR_NAME
					$stu_province=new data_Province($call_stu_address->stu_province); //$stu_province->PROVINCE_NAME
				?>
<!------------------------------------------------------------------------------>
				<?php
				//depend_stu
					$call_depend_stu=new depend_stu($user_login);	
				//ds_status
					$ds_status=new data_rely($call_depend_stu->ds_status);
					
				//ds_dormitoryTumbon
					$ds_dormitoryTumbon=new data_Subdistrict($call_depend_stu->ds_dormitoryTumbon);//$ds_dormitoryTumbon->DISTRICT_NAME
				//ds_dormitoryAmphur
					$ds_dormitoryAmphur=new data_District($call_depend_stu->ds_dormitoryAmphur);//$ds_dormitoryAmphur->AMPHUR_NAME
				//ds_dormitoryProvince	
					$ds_dormitoryProvince=new data_Province($call_depend_stu->ds_dormitoryProvince);//$ds_dormitoryProvince->PROVINCE_NAME
				//ds_FMstatus
					$ds_FMstatus=new data_family($call_depend_stu->ds_FMstatus);
				
				?>	
<!------------------------------------------------------------------------------>
				<?php
				//stu_father
					$call_stu_father=new stu_father($user_login);	
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
				?>
<!------------------------------------------------------------------------------>	
				<?php
				//stu_father_addword
					$call_stu_father_addword=new stu_father_addword($user_login);
					$father_addwordtumbon=new data_Subdistrict($call_stu_father_addword->father_addwordtumbon);//$father_addwordtumbon->DISTRICT_NAME
					$father_addwordamphur=new data_District($call_stu_father_addword->father_addwordamphur);//$father_addwordamphur->AMPHUR_NAME
					$father_addwordprovince=new data_Province($call_stu_father_addword->father_addwordprovince);//$father_addwordprovince->PROVINCE_NAME
				?>
<!------------------------------------------------------------------------------>		
				<?php
				//stu_father_address
					$call_stu_father_address=new stu_father_address($user_login);
					$father_tumbon=new data_Subdistrict($call_stu_father_address->father_tumbon);//$father_tumbon->DISTRICT_NAME
					$father_amphur=new data_District($call_stu_father_address->father_amphur);//$father_amphur->AMPHUR_NAME
					$father_province=new data_Province($call_stu_father_address->father_province);//$father_province->PROVINCE_NAME
					
				?>
<!------------------------------------------------------------------------------>	
				<?php
				//stu_mother
					$call_stu_mother=new stu_mother($user_login);
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
				
				?>			
<!------------------------------------------------------------------------------>			
<!------------------------------------------------------------------------------>	
				<?php
				//stu_mother_addword
					$call_stu_mother_addword=new stu_mother_addword($user_login);
					$mother_wordtumbon=new data_Subdistrict($call_stu_mother_addword->mother_wordtumbon);//$mother_wordtumbon->DISTRICT_NAME
					$mother_wordamphur=new data_District($call_stu_mother_addword->mother_wordamphur);//$mother_wordamphur->AMPHUR_NAME
					$mother_wordprovince=new data_Province($call_stu_mother_addword->mother_wordprovince);//$mother_wordprovince->PROVINCE_NAME
				?>
<!------------------------------------------------------------------------------>
				<?php
				//stu_mother_address
					$call_stu_mother_address=new stu_mother_address($user_login);
				
				
				
					$mother_tumbon=new data_Subdistrict($call_stu_mother_address->mother_tumbon);//$mother_tumbon->DISTRICT_NAME
					$mother_amphur=new data_District($call_stu_mother_address->mother_amphur);//$mother_amphur->AMPHUR_NAME
					$mother_province=new data_Province($call_stu_mother_address->mother_province);//$mother_province->PROVINCE_NAME
				?>
<!------------------------------------------------------------------------------>	
				<?php
				//stu_guardian
					$call_stu_guardian=new stu_guardian($user_login);	
				//parent_prefix
					$parent_prefix=new stu_prefix($call_stu_guardian->parent_prefix);
				//parent_prefix_en	
					$parent_prefix_en=new stu_prefix($call_stu_guardian->parent_prefix_en);
				//parent_nation
					$parent_nation=new db_country($call_stu_guardian->parent_nation);
				//parent_sun	
					$parent_sun=new db_country($call_stu_guardian->parent_sun);
				//parent_IDReligion
					$parent_IDReligion=new rc_religion($call_stu_guardian->parent_IDReligion);
				//parent_career
					$parent_career=new data_career($call_stu_guardian->parent_career);
				//parent_study
					$parent_study=new data_study($call_stu_guardian->parent_study);
				//parent_salary
					$parent_salary=new data_incom($call_stu_guardian->parent_salary);

				//parent_status
					$parent_status=new data_rely($call_stu_guardian->parent_status);
				
					
				?>

				<?php
				//stu_guardian_addword
					$call_stu_guardian_addword=new stu_guardian_addword($user_login);
					$parent_addwordtumbon=new data_Subdistrict($call_stu_guardian_addword->parent_addwordtumbon);//$parent_addwordtumbon->DISTRICT_NAME
					$parent_addwordamphur=new data_District($call_stu_guardian_addword->parent_addwordamphur);//$parent_addwordamphur->AMPHUR_NAME
					$parent_addwordprovince=new data_Province($call_stu_guardian_addword->parent_addwordprovince);//$parent_addwordprovince->PROVINCE_NAME
				?>
<!------------------------------------------------------------------------------>
				<?php
				//stu_guardian_address
					$call_stu_guardian_address=new stu_guardian_address($user_login);
				
				
				
					@$parent_tumbon=new data_Subdistrict($call_stu_guardian_address->parent_tumbon);//$parent_tumbon->DISTRICT_NAME
					@$parent_amphur=new data_District($call_stu_guardian_address->parent_amphur);//$parent_amphur->AMPHUR_NAME
					@$parent_province=new data_Province($call_stu_guardian_address->parent_province);//$parent_province->PROVINCE_NAME
					
					$print_birth=new dateofbirth(date("d-m-Y",strtotime($call_data_student->stu_birth)));
					
					
					
					$printF_birth=new dateofbirth(date("d-m-Y",strtotime($call_stu_father->af_birthday)));
					$printM_birth=new dateofbirth(date("d-m-Y",strtotime($call_stu_mother->mother_birthday)));
					
					$printP_birth=new dateofbirth(date("d-m-Y",strtotime($call_stu_guardian->parent_birthday)));
					
					$parent_status=new data_rely($call_stu_guardian->parent_status);
					
				?>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<a href="./?evaluation_mod=profile"><button type="button" class="btn btn-default">ข้อมูลส่วนตัว</button></a>
				<a href="./?evaluation_mod=profile_modify"><button type="button" class="btn btn-primary">แก้ไขข้อมูลส่วนตัว</button></a>				
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=profile" class="btn btn-link  text-size-small"><span>ข้อมูลส่วนตัว</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<!--<div class="row">
	<div class="col-<?php //echo $grid;?>-12">
		<div class="alert alert-warning">
		  <strong><center><a href="?evaluation_mod=profile_modify"><h4 style="color: #CC0000"><b>คลิกที่นี่</b></h4></a></strong>เพื่อ ตรวจสอบ และเพิ่มเติมข้อมูล นักเรียน</center>
		</div>
	</div>
</div><hr>-->

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<center>
			<button type="button" class="btn btn-warning"  data-toggle="tab" href="#home">ข้อมูลนักเรียน</button>
			<button type="button" class="btn btn-warning"  data-toggle="tab" href="#menu1">ข้อมูลบิดา</button>
			<button type="button" class="btn btn-warning"  data-toggle="tab" href="#menu2">ข้อมูลมารดา</button>
			<button type="button" class="btn btn-warning"  data-toggle="tab" href="#menu3">ข้อมูลผู้ปกครอง</button>
		</center>
	</div>
</div><hr>

<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
		<div class="row">
			<div class="col-<?php echo $grid;?>-6">
				<div class="panel panel-info">
					<div class="panel-heading">ประวัติส่วนตัวนักเรียน</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">รหัสนักเรียน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $rsd_studentid;?></b></font></div>
							<div class="col-<?php echo $grid;?>-6">สีบ้าน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $print_home;?></b></font></div>
						</div>
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">ชื่อภาษาไทย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $name_th;?></b></font></div>
						</div>					
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">ชื่อภาษาอังกฤษ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $name_en;?></b></font></div>
						</div>
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">ชื่อเล่น (ภาษาไทย)&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $nickTh;?></b></font></div>
							<div class="col-<?php echo $grid;?>-6">ชื่อเล่น (ภาษาอังกฤษ)&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $nickEn;?></b></font></div>
						</div>
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">เลขประจำตัวประชาชน / G Code&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $rsd_Identification;?></b></font></div>
						</div>					
						<div class="row">
				<?php
						if(($call_data_student->stu_birth==null or $call_data_student->stu_birth=="-")){ ?>
							<div class="col-<?php echo $grid;?>-6">วัน/เดือน/ปี เกิด ค.ศ.&nbsp;:&nbsp;-&nbsp;</div>
							<div class="col-<?php echo $grid;?>-6">อายุ&nbsp;:&nbsp;-&nbsp;</div>
				<?php	}else{ ?>
							<div class="col-<?php echo $grid;?>-6">วัน/เดือน/ปี เกิด ค.ศ.&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo dateThailand($call_data_student->stu_birth);?></b></font></div>
							<div class="col-<?php echo $grid;?>-6">อายุ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $print_birth->agestr;?></b></font></div>
				<?php	} ?>
		
						</div>						
						<div class="row">
							<div class="col-<?php echo $grid;?>-3">กรุ๊ปเลือด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_data_student->stu_blood;?></b></font></div>
							<div class="col-<?php echo $grid;?>-3">เชื้อชาติ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $stu_nation->nation_name_th;?></b></font></div>
							<div class="col-<?php echo $grid;?>-3">สัญชาติ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $stu_sun->nation_name_th;?></b></font></div>
							<div class="col-<?php echo $grid;?>-3">ศาสนา&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $IDReligion->Religion;?></b></font></div>
						</div>	
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">เบอร์โทรศัทพ์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_data_student->stu_phone;?></b></font></div>
						</div>					
					</div>
				</div>			
			</div>
			<div class="col-<?php echo $grid;?>-6">
				<div class="panel panel-info">
					<div class="panel-heading">ที่อยู่ตามทะเบียนบ้าน</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">บ้านเลขที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_address_home->stu_reg_hno;?></b></font></div>
							<div class="col-<?php echo $grid;?>-6">หมู่ที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_address_home->stu_reg_moo;?></b></font></div>
						</div>	
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">ซอย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_address_home->stu_reg_soi;?></b></font></div>
							<div class="col-<?php echo $grid;?>-6">ถนน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_address_home->stu_reg_road;?></b></font></div>
						</div>		
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">ตำบล&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $stu_reg_tumbon->DISTRICT_NAME;?></b></font></div>
							<div class="col-<?php echo $grid;?>-6">อำเภอ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $stu_reg_amphur->AMPHUR_NAME;?></b></font></div>
						</div>		
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">จังหวัด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $stu_reg_province->PROVINCE_NAME;?></b></font></div>
							<div class="col-<?php echo $grid;?>-6">รหัสไปรษณีย์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_address_home->stu_reg_zipcode;?></b></font></div>
						</div>							
					</div>
				</div>			
			</div>
		</div>
		<div class="row">
			<div class="col-<?php echo $grid;?>-6">
				<div class="panel panel-info">
					<div class="panel-heading">ที่อยู่ปัจจุบัน</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">บ้านเลขที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_address->stu_hno;?></b></font></div>
							<div class="col-<?php echo $grid;?>-6">หมู่ที&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_address->stu_moo;?></b></font>่</div>
						</div>	
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">ซอย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_address->stu_soi;?></b></font></div>
							<div class="col-<?php echo $grid;?>-6">ถนน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_address->stu_road;?></b></font></div>
						</div>		
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">ตำบล&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $stu_tumbon->DISTRICT_NAME;?></b></font></div>
							<div class="col-<?php echo $grid;?>-6">อำเภอ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $stu_amphur->AMPHUR_NAME;?></b></font></div>
						</div>		
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">จังหวัด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $stu_province->PROVINCE_NAME;?></b></font></div>
							<div class="col-<?php echo $grid;?>-6">รหัสไปรษณีย์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_address->stu_zipcode;?></b></font></div>
						</div>						
					</div>
				</div>			
			</div>
			<div class="col-<?php echo $grid;?>-6">
				<div class="panel panel-info">
					<div class="panel-heading">ประวิติการศึกษา</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">ชั้นเรียนสุดท้ายก่อนเข้าเรียน โรงเรียนเรยีนา&nbsp;:&nbsp;<font style="color: #4407FA"><b></b></font></div>
						</div>
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">ชื่อโรงเรียนเดิมที่จบการศึกษา&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_data_student->ds_SameSchool;?></b></font></div>
						</div>
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">จังหวัดโรงเรียนเดิมที่จบการศึกษา&nbsp;:&nbsp;<font style="color: #4407FA"><b></b></font></div>
						</div>	
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">หน่วยกิตเฉลี่ยสะสมจากโรงเรียนเดิมที่จบการศึกษา&nbsp;:&nbsp;<font style="color: #4407FA"><b></b></font></div>
						</div>						
					</div>
				</div>			
			</div>
		</div>
		<div class="row">
			<div class="col-<?php echo $grid;?>-6">
				<div class="panel panel-info">
					<div class="panel-heading">ข้อมูลเพิ่มเติม นักเรียน</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">โรคประจำตัว&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo @$call_depend_stu->ds_CongenitalDisease;?></b></font></div>
							<div class="col-<?php echo $grid;?>-6">การแพ้อาหาร&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo @$call_depend_stu->ds_FoodAllergies;?></b></font></div>
						</div>					
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">การแพ้ยา&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo @$call_depend_stu->ds_DrugAllergy;?></b></font></div>
							<div class="col-<?php echo $grid;?>-6">การแพ้พิษ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo @$call_depend_stu->ds_allergic;?></b></font></div>
						</div>				
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">สถานภาพบิดา-มารดา&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo @$ds_FMstatus->family_txt;?></b></font></div>
						</div>		
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">นักเรียนอาศัยอยู่กับ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo @$ds_status->dr_txt;?></b></font></div>
						</div>
						<div class="row">
							<?php
							$ds_trip=new data_gohome($call_depend_stu->ds_trip);
							if($ds_trip->dgh_id==7){ ?>
								<div class="col-<?php echo $grid;?>-12">การเดินทางมาโรงเรียน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo @$call_depend_stu->ds_triptxt;?></b></font></div>									
							<?php }else{ ?>
								<div class="col-<?php echo $grid;?>-12">การเดินทางมาโรงเรียน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo @$ds_trip->dgh_txt;?></b></font></div>			
							<?php }      ?>		
						</div>							
					</div>
				</div>			
			</div>
			<div class="col-<?php echo $grid;?>-6"></div>
		</div>		
    </div>
    <div id="menu1" class="tab-pane fade">
		
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ข้อมูลบิดา</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ชื่อบิดา ภาษาไทย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $father_prefix->prefix_prefix_SName." ".$call_stu_father->father_fname." ".$call_stu_father->father_sname;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ชื่อบิดา ภาษาอังกฤษ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $father_prefix_en->prefix_prefix_SName." ".$call_stu_father->father_fname_en." ".$call_stu_father->father_sname_en;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เลขประจำตัวชาชน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father->father_code; ?></b></font></div>
								
			<?php
					if($call_stu_father->af_birthday==""){ ?>
								<div class="col-<?php echo $grid;?>-6">วัน/เดือน/ปี เกิด พ.ศ.&nbsp;:&nbsp;<font style="color: #4407FA"><b></b></font></div>					
			<?php	}else{ ?>
								<div class="col-<?php echo $grid;?>-6">วัน/เดือน/ปี เกิด พ.ศ.&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo dateThailand($call_stu_father->af_birthday);?></b></font></div>	
			<?php	} ?>	
					
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">อายุ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $printF_birth->agestr;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">กรุ๊ปเลือด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father->sf_blood; ?></b></font></div>
							</div>				
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เชื้อชาติ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $sf_nation->nation_name_th;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">สัญชาติ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $sf_sun->nation_name_th;?></b></font></div>
							</div>		
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ศาสนา&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $sf_IDReligion->Religion;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">เบอร์โทรศัทพ์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father->father_phone;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">อาชีพ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_father_career->dc_txt2;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">ช่วงรายได้ / เดือน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_father_salary->di_txt;?></b></font></div>
							</div>			
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">วุฒิการศึกษา&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_father_study->study_txt;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">สถานที่ทำงาน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father->father_workplace;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ตำแหน่ง&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father->father_wp_pro;?></b></font></div>
							</div>				
						</div>
					</div>				
				
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ที่อยู่ที่ทำงาน</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เลขที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_addword->father_addwordhno;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">หมู่ที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_addword->father_addwordmoo;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ซอย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_addword->father_addwordsoi;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">ถนน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_addword->father_addwordroad;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ตำบล&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $father_addwordtumbon->DISTRICT_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">อำเภอ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $father_addwordamphur->AMPHUR_NAME;?></b></font></div>
							</div>				
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">จังหวัด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $father_addwordprovince->PROVINCE_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">รหัสไปรษณีย์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_addword->father_addwordzipcode;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">เบอร์โทรศัทพ์ที่ทำงาน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father->father_wp_tel; ?></b></font></div>
							</div>							
						</div>
					</div>	
				</div>				
			</div>
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ที่อยู่ บิดา</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เลขที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_address->father_hno;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">หมู่ที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_address->father_moo;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ซอย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_address->father_soi;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">ถนน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_address->father_road;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ตำบล&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $father_tumbon->DISTRICT_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">อำเภอ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $father_amphur->AMPHUR_NAME;?></b></font></div>
							</div>				
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">จังหวัด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $father_province->PROVINCE_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">รหัสไปรษณีย์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_address->father_zipcode;?></b></font></div>
							</div>				
						</div>
					</div>				
				</div>
				<div class="col-<?php echo $grid;?>-6"></div>
			</div>
			
	</div>
		

 
    <div id="menu2" class="tab-pane fade">

			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ข้อมูลมารดา</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ชื่อมารดา ภาษาไทย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_prefix->prefix_prefix_SName." ".$call_stu_mother->mother_fname." ".$call_stu_mother->mother_sname;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ชื่อมารดา ภาษาอังกฤษ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_prefix_en->prefix_prefix_SName." ".$call_stu_mother->mother_fname_en." ".$call_stu_mother->mother_sname_en;?></b></font></div>
							</div>							
							
							
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เลขประจำตัวชาชน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother->mother_code; ?></b></font></div>
				
			<?php
					if($call_stu_mother->mother_birthday==""){ ?>
								<div class="col-<?php echo $grid;?>-6">วัน/เดือน/ปี เกิด พ.ศ.&nbsp;:&nbsp;<font style="color: #4407FA"><b></b></font></div>
			<?php	}else{ ?>
								<div class="col-<?php echo $grid;?>-6">วัน/เดือน/ปี เกิด พ.ศ.&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo dateThailand($call_stu_mother->mother_birthday);?></b></font></div>  	
			<?php	} ?>					
						
							</div>
							<div class="row">
								
				<?php
					if($call_stu_mother->mother_birthday==""){ ?>
								<div class="col-<?php echo $grid;?>-6">อายุ&nbsp;:&nbsp;<font style="color: #4407FA"><b>-</b></font></div>
			<?php	}else{ ?>
								<div class="col-<?php echo $grid;?>-6">อายุ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $printM_birth->agestr; ?></b></font></div> 	
			<?php	} ?>								
								
								
								
								<div class="col-<?php echo $grid;?>-6">กรุ๊ปเลือด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother->mother_blood; ?></b></font></div>
							</div>				
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เชื้อชาติ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_nation->nation_name_th;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">สัญชาติ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_sun->nation_name_th;?></b></font></div>
							</div>		
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ศาสนา&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_IDReligion->Religion;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">เบอร์โทรศัทพ์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother->mother_phone;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">อาชีพ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_career->dc_txt2;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">ช่วงรายได้ / เดือน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_salary->di_txt;?></b></font></div>
							</div>			
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">วุฒิการศึกษา&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_study->study_txt;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">สถานที่ทำงาน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother->mother_workplace;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ตำแหน่ง&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother->mother_wp_pro;?></b></font></div>
							</div>				
						</div>
					</div>				
				
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ที่อยู่ที่ทำงาน</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เลขที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_addword->mother_wordhno;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">หมู่ที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_addword->mother_wordmoo;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ซอย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_addword->mother_wordsoi;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">ถนน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_addword->mother_wordroad;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ตำบล&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_wordtumbon->DISTRICT_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">อำเภอ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_wordamphur->AMPHUR_NAME;?></b></font></div>
							</div>				
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">จังหวัด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_wordprovince->PROVINCE_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">รหัสไปรษณีย์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_addword->mother_wordzipcode;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">เบอร์โทรศัทพ์ที่ทำงาน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother->mother_wp_tel;?></b></font></div>
							</div>							
						</div>
					</div>	
				</div>				
			</div>
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ที่อยู่ มารดา</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เลขที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_address->mother_hno;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">หมู่ที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_address->mother_moo;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ซอย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_address->mother_soi;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">ถนน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_address->mother_road;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ตำบล&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_tumbon->DISTRICT_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">อำเภอ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_amphur->AMPHUR_NAME;?></b></font></div>
							</div>				
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">จังหวัด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_province->PROVINCE_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">รหัสไปรษณีย์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_address->mother_zipcode;?></b></font></div>
							</div>				
						</div>
					</div>				
				</div>
				<div class="col-<?php echo $grid;?>-6"></div>
			</div>

    </div>
    <div id="menu3" class="tab-pane fade">

		<?php
				if($call_stu_guardian->parent_status==2){ ?>
					<div class="panel panel-info">
						<div class="panel-heading">ข้อมูลผู้ปกครอง</div>			
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ความสัมพันธ์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_status->dr_txt;?></b></font></div>
							</div>
						
						</div>
					</div>	
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ข้อมูลบิดา</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ชื่อบิดา ภาษาไทย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $father_prefix->prefix_prefix_SName." ".$call_stu_father->father_fname." ".$call_stu_father->father_sname;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ชื่อบิดา ภาษาอังกฤษ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $father_prefix_en->prefix_prefix_SName." ".$call_stu_father->father_fname_en." ".$call_stu_father->father_sname_en;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เลขประจำตัวชาชน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father->father_code; ?></b></font></div>
								
			<?php
					if($call_stu_father->af_birthday==""){ ?>
								<div class="col-<?php echo $grid;?>-6">วัน/เดือน/ปี เกิด พ.ศ.&nbsp;:&nbsp;<font style="color: #4407FA"><b></b></font></div>					
			<?php	}else{ ?>
								<div class="col-<?php echo $grid;?>-6">วัน/เดือน/ปี เกิด พ.ศ.&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo dateThailand($call_stu_father->af_birthday);?></b></font></div>	
			<?php	} ?>	
					
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">อายุ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $printF_birth->agestr;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">กรุ๊ปเลือด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father->sf_blood; ?></b></font></div>
							</div>				
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เชื้อชาติ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $sf_nation->nation_name_th;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">สัญชาติ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $sf_sun->nation_name_th;?></b></font></div>
							</div>		
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ศาสนา&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $sf_IDReligion->Religion;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">เบอร์โทรศัทพ์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father->father_phone;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">อาชีพ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_father_career->dc_txt2;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">ช่วงรายได้ / เดือน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_father_salary->di_txt;?></b></font></div>
							</div>			
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">วุฒิการศึกษา&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_father_study->study_txt;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">สถานที่ทำงาน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father->father_workplace;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ตำแหน่ง&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father->father_wp_pro;?></b></font></div>
							</div>				
						</div>
					</div>				
				
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ที่อยู่ที่ทำงาน</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เลขที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_addword->father_addwordhno;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">หมู่ที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_addword->father_addwordmoo;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ซอย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_addword->father_addwordsoi;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">ถนน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_addword->father_addwordroad;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ตำบล&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $father_addwordtumbon->DISTRICT_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">อำเภอ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $father_addwordamphur->AMPHUR_NAME;?></b></font></div>
							</div>				
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">จังหวัด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $father_addwordprovince->PROVINCE_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">รหัสไปรษณีย์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_addword->father_addwordzipcode;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">เบอร์โทรศัทพ์ที่ทำงาน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father->father_wp_tel; ?></b></font></div>
							</div>							
						</div>
					</div>	
				</div>				
			</div>
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ที่อยู่ บิดา</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เลขที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_address->father_hno;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">หมู่ที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_address->father_moo;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ซอย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_address->father_soi;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">ถนน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_address->father_road;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ตำบล&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $father_tumbon->DISTRICT_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">อำเภอ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $father_amphur->AMPHUR_NAME;?></b></font></div>
							</div>				
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">จังหวัด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $father_province->PROVINCE_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">รหัสไปรษณีย์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_father_address->father_zipcode;?></b></font></div>
							</div>				
						</div>
					</div>				
				</div>
				<div class="col-<?php echo $grid;?>-6"></div>
			</div>
					
		<?php	}elseif($call_stu_guardian->parent_status==3){ ?>
					<div class="panel panel-info">
						<div class="panel-heading">ข้อมูลผู้ปกครอง</div>			
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ความสัมพันธ์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_status->dr_txt;?></b></font></div>
							</div>
						
						</div>
					</div>	
					
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ข้อมูลมารดา</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ชื่อมารดา ภาษาไทย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_prefix->prefix_prefix_SName." ".$call_stu_mother->mother_fname." ".$call_stu_mother->mother_sname;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ชื่อมารดา ภาษาอังกฤษ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_prefix_en->prefix_prefix_SName." ".$call_stu_mother->mother_fname_en." ".$call_stu_mother->mother_sname_en;?></b></font></div>
							</div>							
							
							
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เลขประจำตัวชาชน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother->mother_code; ?></b></font></div>
				
			<?php
					if($call_stu_mother->mother_birthday==""){ ?>
								<div class="col-<?php echo $grid;?>-6">วัน/เดือน/ปี เกิด พ.ศ.&nbsp;:&nbsp;<font style="color: #4407FA"><b></b></font></div>
			<?php	}else{ ?>
								<div class="col-<?php echo $grid;?>-6">วัน/เดือน/ปี เกิด พ.ศ.&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo dateThailand($call_stu_mother->mother_birthday);?></b></font></div>  	
			<?php	} ?>					
						
							</div>
							<div class="row">
								
				<?php
					if($call_stu_mother->mother_birthday==""){ ?>
								<div class="col-<?php echo $grid;?>-6">อายุ&nbsp;:&nbsp;<font style="color: #4407FA"><b>-</b></font></div>
			<?php	}else{ ?>
								<div class="col-<?php echo $grid;?>-6">อายุ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $printM_birth->agestr; ?></b></font></div> 	
			<?php	} ?>								
								
								
								
								<div class="col-<?php echo $grid;?>-6">กรุ๊ปเลือด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother->mother_blood; ?></b></font></div>
							</div>				
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เชื้อชาติ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_nation->nation_name_th;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">สัญชาติ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_sun->nation_name_th;?></b></font></div>
							</div>		
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ศาสนา&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_IDReligion->Religion;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">เบอร์โทรศัทพ์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother->mother_phone;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">อาชีพ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_career->dc_txt2;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">ช่วงรายได้ / เดือน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_salary->di_txt;?></b></font></div>
							</div>			
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">วุฒิการศึกษา&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_study->study_txt;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">สถานที่ทำงาน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother->mother_workplace;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ตำแหน่ง&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother->mother_wp_pro;?></b></font></div>
							</div>				
						</div>
					</div>				
				
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ที่อยู่ที่ทำงาน</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เลขที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_addword->mother_wordhno;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">หมู่ที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_addword->mother_wordmoo;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ซอย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_addword->mother_wordsoi;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">ถนน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_addword->mother_wordroad;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ตำบล&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_wordtumbon->DISTRICT_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">อำเภอ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_wordamphur->AMPHUR_NAME;?></b></font></div>
							</div>				
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">จังหวัด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_wordprovince->PROVINCE_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">รหัสไปรษณีย์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_addword->mother_wordzipcode;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">เบอร์โทรศัทพ์ที่ทำงาน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother->mother_wp_tel;?></b></font></div>
							</div>							
						</div>
					</div>	
				</div>				
			</div>
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ที่อยู่ มารดา</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เลขที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_address->mother_hno;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">หมู่ที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_address->mother_moo;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ซอย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_address->mother_soi;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">ถนน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_address->mother_road;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ตำบล&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_tumbon->DISTRICT_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">อำเภอ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_amphur->AMPHUR_NAME;?></b></font></div>
							</div>				
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">จังหวัด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $mother_province->PROVINCE_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">รหัสไปรษณีย์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_mother_address->mother_zipcode;?></b></font></div>
							</div>				
						</div>
					</div>				
				</div>
				<div class="col-<?php echo $grid;?>-6"></div>
			</div>					
		<?php	}elseif($call_stu_guardian->parent_status==5){ ?>
					<div class="panel panel-info">
						<div class="panel-heading">ข้อมูลผู้ปกครอง</div>			
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ความสัมพันธ์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_status->dr_txt;?></b></font></div>
							</div>
						
						</div>
					</div>
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ข้อมูล<?php echo $parent_status->dr_txt;?></div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ชื่อ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_depend_stu->ds_dormitoryMyName;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">หมายเลขติดต่อ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_depend_stu->ds_dormitoryPhone;?></b></font></div>								
							</div>		
						</div>
					</div>				
				
				</div>
			</div>
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ที่อยู่ <?php echo $parent_status->dr_txt;?></div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เลขที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_depend_stu->ds_dormitoryHno;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">หมู่ที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_depend_stu->ds_dormitoryMoo;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ซอย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_depend_stu->ds_dormitorySoi;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">ถนน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_depend_stu->ds_dormitoryRoad;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ตำบล&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $ds_dormitoryTumbon->DISTRICT_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">อำเภอ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $ds_dormitoryAmphur->AMPHUR_NAME;?></b></font></div>
							</div>				
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">จังหวัด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $ds_dormitoryProvince->PROVINCE_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">รหัสไปรษณีย์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_depend_stu->ds_dormitoryZipcode;?></b></font></div>
							</div>				
						</div>
					</div>				
				</div>
				<div class="col-<?php echo $grid;?>-6"></div>
			</div>					
					
		<?php	}elseif($call_stu_guardian->parent_status==1 or $call_stu_guardian->parent_status==0 or $call_stu_guardian->parent_status==""){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}else{ ?>
					<div class="panel panel-info">
						<div class="panel-heading">ข้อมูลผู้ปกครอง</div>			
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ความสัมพันธ์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_status->dr_txt;?></b></font></div>
							</div>
						
						</div>
					</div>		
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ข้อมูล<?php echo $parent_status->dr_txt;?></div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ชื่อ<?php echo $parent_status->dr_txt;?> ภาษาไทย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_prefix->prefix_prefix_SName." ".$call_stu_guardian->parent_fname." ".$call_stu_guardian->parent_sname;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ชื่อ<?php echo $parent_status->dr_txt;?> ภาษาอังกฤษ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_prefix_en->prefix_prefix_SName." ".$call_stu_guardian->parent_fname_en." ".$call_stu_guardian->parent_sname_en;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เลขประจำตัวชาชน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_guardian->parent_code; ?></b></font></div>
								
			<?php
					if($call_stu_guardian->parent_birthday==""){ ?>
								<div class="col-<?php echo $grid;?>-6">วัน/เดือน/ปี เกิด พ.ศ.&nbsp;:&nbsp;<font style="color: #4407FA"><b></b></font></div>					
			<?php	}else{ ?>
								<div class="col-<?php echo $grid;?>-6">วัน/เดือน/ปี เกิด พ.ศ.&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo dateThailand($call_stu_guardian->parent_birthday);?></b></font></div>	
			<?php	} ?>	
					
							</div>
							<div class="row">
								
			<?php
					if($call_stu_guardian->parent_birthday==""){ ?>
								<div class="col-<?php echo $grid;?>-6">อายุ&nbsp;:&nbsp;<font style="color: #4407FA"><b></b></font></div>
			<?php	}else{ ?>
								<div class="col-<?php echo $grid;?>-6">อายุ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $printP_birth->agestr;?></b></font></div>
			<?php	} ?>								
								
								
								<div class="col-<?php echo $grid;?>-6">กรุ๊ปเลือด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_guardian->parent_blood; ?></b></font></div>
							</div>				
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เชื้อชาติ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_nation->nation_name_th;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">สัญชาติ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_sun->nation_name_th;?></b></font></div>
							</div>		
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ศาสนา&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_IDReligion->Religion;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">เบอร์โทรศัทพ์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_guardian->parent_phone;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">อาชีพ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_career->dc_txt2;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">ช่วงรายได้ / เดือน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_salary->di_txt;?></b></font></div>
							</div>			
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">วุฒิการศึกษา&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_study->study_txt;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">สถานที่ทำงาน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_guardian->parent_workplace;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">ตำแหน่ง&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_guardian->parent_wp_pro;?></b></font></div>
							</div>				
						</div>
					</div>				
				
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ที่อยู่ที่ทำงาน</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เลขที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_guardian_addword->parent_wordhno;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">หมู่ที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_guardian_addword->parent_wordmoo;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ซอย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_guardian_addword->parent_wordsoi;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">ถนน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_guardian_addword->parent_wordroad;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ตำบล&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_wordtumbon->DISTRICT_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">อำเภอ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_wordamphur->AMPHUR_NAME;?></b></font></div>
							</div>				
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">จังหวัด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_wordprovince->PROVINCE_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">รหัสไปรษณีย์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_guardian_addword->parent_wordzipcode;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-12">เบอร์โทรศัทพ์ที่ทำงาน&nbsp;:&nbsp;<font style="color: #4407FA"><b></b></font></div>
							</div>							
						</div>
					</div>	
				</div>				
			</div>
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-info">
						<div class="panel-heading">ที่อยู่ <?php echo $parent_status->dr_txt;?></div>
						<div class="panel-body">
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">เลขที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_guardian_address->parent_hno;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">หมู่ที่&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_guardian_address->parent_moo;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ซอย&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_guardian_address->parent_soi;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">ถนน&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_guardian_address->parent_road;?></b></font></div>
							</div>
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">ตำบล&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_tumbon->DISTRICT_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">อำเภอ&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_amphur->AMPHUR_NAME;?></b></font></div>
							</div>				
							<div class="row">
								<div class="col-<?php echo $grid;?>-6">จังหวัด&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $parent_province->PROVINCE_NAME;?></b></font></div>
								<div class="col-<?php echo $grid;?>-6">รหัสไปรษณีย์&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $call_stu_guardian_address->parent_zipcode;?></b></font></div>
							</div>				
						</div>
					</div>				
				</div>
				<div class="col-<?php echo $grid;?>-6"></div>
			</div>					
		<?php	}      ?>

    </div>
</div>










				
			
				


