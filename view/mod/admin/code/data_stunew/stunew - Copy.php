<?php
	include("../../../../database/database_evaluation.php");
			
	include("../../../../database/pdo_conndatastu.php");
	include("../../../../database/class_pdodatastu.php");
			
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");
			
?>
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
<?php
	$txt_year=post_data(filter_input(INPUT_POST,'txt_year'));
	$txt_class=post_data(filter_input(INPUT_POST,'txt_class'));
	//$txt_room=post_data(filter_input(INPUT_POST,'txt_room'));
		if(isset($txt_year,$txt_class)){
			$txt_t=substr($txt_year,0,1);
			$txt_y=substr($txt_year,2,4);
			$txt_level=new print_level($txt_class); ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<script>
	$(document).ready(function () {

    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>กรอง:</span> _INPUT_',
            searchPlaceholder: 'พิมพ์เพื่อกรอง...',
            lengthMenu: '<span>แสดง:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
        }
    });


    // Column selectors
    $('.datatable-button-html5-columns').DataTable({
        buttons: {            
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn btn-default',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-default',
					filename: 'ข้อมูล นักเรียนใหม่ รายงานส่งห้องวัดผล ชั้น <?php echo $txt_level->level_Sort_name;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
					title: 'ข้อมูล นักเรียนใหม่ รายงานส่งห้องวัดผล ชั้น <?php echo $txt_level->level_Sort_name;?>  ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
                    exportOptions: {
                        columns: ':visible'
                    }
                },


                {
                    extend: 'colvis',
                    text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                    className: 'btn bg-blue btn-icon'
                }
            ]
        },
				"paging"       : false,
				"lengthChange" : false,
				"searching"    : false,
				"ordering"     : false,
				"info"         : false,
				"autoWidth"    : false,
				
							"language": {
							"sEmptyTable"      : "ไม่มีข้อมูลในตาราง",
							"sInfo"            : "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
							"sInfoEmpty"       : "แสดง 0 ถึง 0 จาก 0 แถว",
							"sInfoFiltered"    : "(กรองข้อมูล _MAX_ ทุกแถว)",
							"sInfoPostFix"     : "",
							"sInfoThousands"   : ",",
							"sLengthMenu"      : "แสดง _MENU_ แถว",
							"sLoadingRecords"  : "กำลังโหลดข้อมูล...",
							"sProcessing"      : "กำลังดำเนินการ...",
							"sSeainserth"          : "ค้นหา: ",
							"sZeroRecords"     : "ไม่พบข้อมูล",
							"oPaginate"        : {
							"sFirst"           : "หน้าแรก",
							"sPrevious"        : "ก่อนหน้า",
							"sNext"            : "ถัดไป",
							"sLast"            : "หน้าสุดท้าย"
										         }
							}
		
    });

/*		*/
			
		})
</script>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading">ข้อมูล นักเรียนใหม่ รายงานส่งห้องวัดผล ชั้น  <?php echo $txt_level->level_Sort_name;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></div>
			<div class="panel-body">

				<div class="table-responsive">				
					<table class="table datatable-button-html5-columns table-bordered">
						<thead>   
							<tr>
								<th><div>เลขประจำตัว</div></th>
								<th><div>เลขประจำตัวประชาชน</div></th>
								<th><div>ชื่อ - นามสกุล</div></th>
								<th><div>วัน/เดือน/ปี เกิด</div></th>
								<th><div>ตำบลที่เกิด</div></th>
								<th><div>อำเภอที่เกิด</div></th>
								<th><div>จังหวัดที่เกิด</div></th>
								<th><div>ชื่อบิดา</div></th>
								<th><div>อาชีพบิดา</div></th>
								<th><div>ชื่อมารดา</div></th>
								<th><div>อาชีพมารดา</div></th>
								<th><div>สถานศึกษาเดิม</div></th>
								<th><div>จังหวัดสถานศึกษาเดิม</div></th>
								<th><div>เหตุที่ย้าย</div></th>
								<th><div>วันที่เข้าเรียน</div></th>
								<th><div>ที่อยู่ปัจจุบัน</div></th>
								<th><div>ความรู้เดิม ( จบชั้น )</div></th>
								<th><div>วันที่จำหน่าย</div></th>
								<th><div>เหตุที่จำหน่าย</div></th>
								<th><div>ความรู้และความประพฤติ</div></th>
								<th><div>หมายเหตุ</div></th>
							</tr>
						</thead>
						<tbody>
						
				<?php
					$print_stuallnew=new data_stuallnew($txt_t,$txt_y,$txt_class);
					foreach($print_stuallnew->printdata_stuallnew as $rc_key=>$print_stuallnewRow){ 
										
						$rsd_studentid=$print_stuallnewRow["rsd_studentid"];
						$rsd_Identification=$print_stuallnewRow["rsd_Identification"];
						$nickTh=$print_stuallnewRow["nickTh"];
						$nickEn=$print_stuallnewRow["nickEn"];
						
						$rsd_name=$print_stuallnewRow["rsd_name"];
						$rsd_surname=$print_stuallnewRow["rsd_surname"];
						
						$rsd_nameEn=$print_stuallnewRow["rsd_nameEn"];
						$rsd_surnameEn=$print_stuallnewRow["rsd_surnameEn"];
						$data_prefix=new print_prefix($rsd_prefix=$print_stuallnewRow["rsd_prefix"]);
						$data_plan=new print_plan($rsc_plan=$print_stuallnewRow["rsc_plan"]);
						
						$name_th=$data_prefix->prefix_prefix_SName." ".$print_stuallnewRow["rsd_name"]." ".$print_stuallnewRow["rsd_surname"];
						$name_en="Miss ".$print_stuallnewRow["rsd_nameEn"]." ".$print_stuallnewRow["rsd_surnameEn"];
						
						if($print_stuallnewRow["rse_home"]==1){
							$print_home="ฟ";
						}elseif($print_stuallnewRow["rse_home"]==2){
							$print_home="ด";
						}elseif($print_stuallnewRow["rse_home"]==3){
							$print_home="ล";
						}elseif($print_stuallnewRow["rse_home"]==4){
							$print_home="ข";
						}else{
							$print_home="";
						}
						$rsc_status=$print_stuallnewRow["rsc_status"];					

				//data_student
					$call_data_student=new data_student($rsd_studentid);
				//depend_stu
					$call_depend_stu=new depend_stu($rsd_studentid);	
							
				//stu_physical
					$stu_physical=new data_disabled($call_data_student->stu_physical);		
				//Religion	
					$IDReligion=new rc_religion($call_data_student->IDReligion);	

				//ds_status
					$ds_status=new data_rely($call_depend_stu->ds_status);
				//stu_address_home
					$call_stu_address=new stu_address($rsd_studentid);
					$stu_tumbon=new data_Subdistrict($call_stu_address->stu_tumbon); //$stu_tumbon->DISTRICT_NAME
					$stu_amphur=new data_District($call_stu_address->stu_amphur); //$stu_amphur->AMPHUR_NAME
					$stu_province=new data_Province($call_stu_address->stu_province); //$stu_province->PROVINCE_NAME					
														
					?>
<!------------------------------------------------------------------------------>
				<?php
					//data_student
					$call_data_student=new data_student($rsd_studentid);
					
					//breed_district
					$breed_district=new	data_Subdistrict($call_data_student->breed_district); //$stu_physical->DISTRICT_NAME
					//breed_city
					$breed_city=new data_District($call_data_student->breed_city); //$breed_city->AMPHUR_NAME
					//breed_province
					$breed_province=new data_Province($call_data_student->breed_province); //$breed_province->PROVINCE_NAME
					
					//stu_address_home
					$call_stu_address_home=new stu_address_home($rsd_studentid);
				
					$stu_reg_tumbon=new data_Subdistrict($call_stu_address_home->stu_reg_tumbon); //$stu_reg_tumbon->DISTRICT_NAME
					$stu_reg_amphur=new data_District($call_stu_address_home->stu_reg_amphur); //$stu_reg_amphur->AMPHUR_NAME
					$stu_reg_province=new data_Province($call_stu_address_home->stu_reg_province); //$stu_reg_province->PROVINCE_NAME
					
					
					
				?>				
<!------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------>
				<?php
				//stu_father
					$call_stu_father=new stu_father($rsd_studentid);	
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
				//parent_salary
					$parent_salary=new data_incom($call_stu_guardian->parent_salary);
				//stu_father_addword
					$call_stu_father_addword=new stu_father_addword($rsd_studentid);
					$father_addwordtumbon=new data_Subdistrict($call_stu_father_addword->father_addwordtumbon);//$father_addwordtumbon->DISTRICT_NAME
					$father_addwordamphur=new data_District($call_stu_father_addword->father_addwordamphur);//$father_addwordamphur->AMPHUR_NAME
					$father_addwordprovince=new data_Province($call_stu_father_addword->father_addwordprovince);//$father_addwordprovince->PROVINCE_NAME
				?>
<!------------------------------------------------------------------------------>
				<?php
				//stu_father
					$call_stu_father=new stu_father($rsd_studentid);	
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
					$call_stu_father_addword=new stu_father_addword($rsd_studentid);
					$father_addwordtumbon=new data_Subdistrict($call_stu_father_addword->father_addwordtumbon);//$father_addwordtumbon->DISTRICT_NAME
					$father_addwordamphur=new data_District($call_stu_father_addword->father_addwordamphur);//$father_addwordamphur->AMPHUR_NAME
					$father_addwordprovince=new data_Province($call_stu_father_addword->father_addwordprovince);//$father_addwordprovince->PROVINCE_NAME
				?>
<!------------------------------------------------------------------------------>		
				<?php
				//stu_father_address
					$call_stu_father_address=new stu_father_address($rsd_studentid);
					$father_tumbon=new data_Subdistrict($call_stu_father_address->father_tumbon);//$father_tumbon->DISTRICT_NAME
					$father_amphur=new data_District($call_stu_father_address->father_amphur);//$father_amphur->AMPHUR_NAME
					$father_province=new data_Province($call_stu_father_address->father_province);//$father_province->PROVINCE_NAME
					
				?>
<!------------------------------------------------------------------------------>	
				<?php
				//stu_mother
					$call_stu_mother=new stu_mother($rsd_studentid);
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
					$call_stu_mother_addword=new stu_mother_addword($rsd_studentid);
					$mother_wordtumbon=new data_Subdistrict($call_stu_mother_addword->mother_wordtumbon);//$mother_wordtumbon->DISTRICT_NAME
					$mother_wordamphur=new data_District($call_stu_mother_addword->mother_wordamphur);//$mother_wordamphur->AMPHUR_NAME
					$mother_wordprovince=new data_Province($call_stu_mother_addword->mother_wordprovince);//$mother_wordprovince->PROVINCE_NAME
				?>
<!------------------------------------------------------------------------------>
				<?php
				//stu_mother_address
					$call_stu_mother_address=new stu_mother_address($rsd_studentid);
				
				
				
					$mother_tumbon=new data_Subdistrict($call_stu_mother_address->mother_tumbon);//$mother_tumbon->DISTRICT_NAME
					$mother_amphur=new data_District($call_stu_mother_address->mother_amphur);//$mother_amphur->AMPHUR_NAME
					$mother_province=new data_Province($call_stu_mother_address->mother_province);//$mother_province->PROVINCE_NAME
				?>
<!------------------------------------------------------------------------------>	
				<?php
				//stu_guardian
					$call_stu_guardian=new stu_guardian($rsd_studentid);	
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
					$call_stu_guardian_addword=new stu_guardian_addword($rsd_studentid);
					$parent_addwordtumbon=new data_Subdistrict($call_stu_guardian_addword->parent_addwordtumbon);//$parent_addwordtumbon->DISTRICT_NAME
					$parent_addwordamphur=new data_District($call_stu_guardian_addword->parent_addwordamphur);//$parent_addwordamphur->AMPHUR_NAME
					$parent_addwordprovince=new data_Province($call_stu_guardian_addword->parent_addwordprovince);//$parent_addwordprovince->PROVINCE_NAME
				?>
<!------------------------------------------------------------------------------>
				<?php
				//stu_guardian_address
					$call_stu_guardian_address=new stu_guardian_address($rsd_studentid);
				
				
				
					$parent_tumbon=new data_Subdistrict($call_stu_guardian_address->parent_tumbon);//$parent_tumbon->DISTRICT_NAME
					$parent_amphur=new data_District($call_stu_guardian_address->parent_amphur);//$parent_amphur->AMPHUR_NAME
					$parent_province=new data_Province($call_stu_guardian_address->parent_province);//$parent_province->PROVINCE_NAME
					
				//depend_stu
					$call_depend_stu=new depend_stu($rsd_studentid);					
				//ds_FMstatus
					$ds_FMstatus=new data_family($call_depend_stu->ds_FMstatus);
					
					$print_student=new data_student($rsd_studentid);
					
					
					$call_ds_OriginalClass=new print_level($print_student->ds_OriginalClass);
					
					$call_province=new data_Province($print_student->ds_ProvinceSchool);					
	
				?>		
				
				
<?php
		$stu_newSql="SELECT count(`rsn_id`) as `int_rsn`
					 FROM `regina_stu_new` 
					 WHERE `rsn_id`='{$rsd_studentid}' 
					 and `rsn_year`='{$txt_y}' 
					 and `rsn_level`='{$txt_class}'";
		$stu_new=new pdo_notarray($stu_newSql);
		foreach($stu_new->print_pdonotarray as $rc_key=>$stu_newRow){ 
			$int_rsn=$stu_newRow["int_rsn"];
				if($int_rsn>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
							<tr>
								<td><div><?php echo $rsd_studentid;?></div></td>
								<td><div><?php echo $rsd_Identification;?></div></td>
								
<?php
	$date_me=date($call_data_student->stu_birth);
	$date_me=date("Y-m-d",strtotime($date_me));
	$call_dateme=new set_age($date_me);
	
		if($call_dateme->print_set_age()<=15){ ?>
								<td>เด็กหญิง<div>&nbsp;<?php echo $rsd_name."&nbsp;".$rsd_surname;?></div></td>		
<?php	}elseif($call_dateme->print_set_age()==0){ ?>
								<td>นางสาว<div>&nbsp;<?php echo $rsd_name."&nbsp;".$rsd_surname;?></div> </td>	
<?php   }else{ ?>
								<td>เด็กหญิง <div>&nbsp;<?php echo $rsd_name."&nbsp;".$rsd_surname;?></div></td>		
<?php	} ?>								
								
			<?php
					if($call_data_student->stu_birth==""){ ?>
								<td style="background-color: #D2F2DC"><div>&nbsp;</div></td>					
			<?php	}else{ ?>
								<td style="background-color: #D2F2DC"><div><?php echo date("d/m/Y",strtotime($call_data_student->stu_birth));?></div></td>	
			<?php	} ?>
								
								<td><div><?php echo $breed_district->DISTRICT_NAME;?></div></td>
								<td><div><?php echo $breed_city->AMPHUR_NAME;?></div></td>
								<td><div><?php echo $breed_province->PROVINCE_NAME;?></div></td>
								<td><div><?php echo $father_prefix->prefix_prefix_SName." ".$call_stu_father->father_fname." ".$call_stu_father->father_sname?></div></td>
								<td><div><?php echo $call_father_career->dc_txt2;?></div></td>
								<td><div><?php echo $mother_prefix->prefix_prefix_SName." ".$call_stu_mother->mother_fname." ".$call_stu_mother->mother_sname;?></div></td>
								<td><div><?php echo $mother_career->dc_txt2;?></div></td>
								<td><div><?php echo $print_student->ds_SameSchool;?></div></td>
								<td><div><?php echo $call_province->PROVINCE_NAME;?></div></td>
								<td><div>&nbsp;</div></td>
								<td><div>&nbsp;</div></td>
								
								<td><div><?php echo $call_stu_address->stu_hno." หมู่ที่ ".$call_stu_address->stu_moo." ตรอก/ซอย ".$call_stu_address->stu_soi." ถนน ".$call_stu_address->stu_road." ตำบล ".$stu_amphur->AMPHUR_NAME." อำเภอ ".$stu_tumbon->DISTRICT_NAME." จังหวัด ".$stu_province->PROVINCE_NAME." รหัสไปรษณีย์ ".$call_stu_address->stu_zipcode;?></div></td>
								
								
			<?php
					if($txt_class==3){ ?>
								<td><div>จบ อ.2 เข้าเรียน อ.3</div></td>						
			<?php	}elseif($txt_class==12){ ?>
								<td><div>จบ ป.1 เข้าเรียน ป.2</div></td>					
			<?php	}elseif($txt_class==13){ ?>
								<td><div>จบ ป.2 เข้าเรียน ป.3</div></td>					
			<?php	}elseif($txt_class==21){ ?>
								<td><div>จบ ป.3 เข้าเรียน ป.4</div></td>					
			<?php	}elseif($txt_class==22){ ?>
								<td><div>จบ ป.4 เข้าเรียน ป.5</div></td>					
			<?php	}elseif($txt_class==23){ ?>
								<td><div>จบ ป.5 เข้าเรียน ป.6</div></td>					
			<?php	}elseif($txt_class==32){ ?>
								<td><div>จบ ป.6 เข้าเรียน ม.2</div></td>					
			<?php	}elseif($txt_class==33){ ?>
								<td><div>จบ ม.2 เข้าเรียน ม.3</div></td>					
			<?php	}else{ ?>
								<td><div>&nbsp;</div></td>					
			<?php	}	?>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
								<td><div></div></td>
								<td><div></div></td>
								<td><div></div></td>
								<td><div></div></td>
							</tr>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
<?php			}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
							<!--<tr>-->
													
							<!--</tr>-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
<?php			}
		} ?>								
			<?php	} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
</div>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php   }else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-danger">
				<div class="panel-heading">พบข้อผิดพลาด</div>
				<div class="panel-body">กรุณา เลือกปีการศึกษา และ ระดับชั้น</div>
			</div>		
		</div>
	</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}