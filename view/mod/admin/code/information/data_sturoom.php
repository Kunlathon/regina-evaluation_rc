<?php
	include("../../../../database/database_evaluation.php");
	
	include("../../../../database/pdo_admission.php");
	include("../../../../database/pdo_conndatastu.php");
	include("../../../../database/pdo_data.php");
	
	include("../../../../database/class_pdodatastu.php");
	

	include("../../../../database/class_admin.php");
	

	
	include("../../../../database/regina_student.php");
	
	$txt_year=post_data(filter_input(INPUT_POST,'txt_year'));
	$txt_class=post_data(filter_input(INPUT_POST,'txt_class'));
	$txt_room=post_data(filter_input(INPUT_POST,'txt_room'));
	
	$txt_t=substr($txt_year,0,1);
	$txt_y=substr($txt_year,2,4);

	$txt_level=new print_level($txt_class);
?>
<!--****************************************************************************-->			
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
					filename: 'ข้อมูลพื้นฐาน นักเรียนทั้งหมด  ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
					title: 'ข้อมูลพื้นฐาน นักเรียนทั้งหมด  ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
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



<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading">ข้อมูลพื้นฐาน นักเรียนทั้งหมด  ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></div>
			<div class="panel-body">

				<div class="table-responsive">				
					<table class="table datatable-button-html5-columns table-bordered">
						<thead>   
							<tr>
								<th colspan="200"><center>ข้อมูลพื้นฐาน นักเรียนทั้งหมด  ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></center></th>
							</tr>
							<tr>
								<th >เลขที่</th>
								<th >รหัสนักเรียน</th>
								<th >รหัสประจำตัวประชาชน</th>
								<th >ชื่อ - สกุล ไทย</th>
								<th >ชื่อเล่น ไทย</th>
								<th >ชื่อเล่น อังกฤษ</th>
								<th >ชื่อ - สกุล อังกฤษ</th>
								<th >แผนการเรียน</th>
								<th >สีบ้าน</th>
<!--Pint data_student-->							
								<th >วันเดือนปีเกิด</th>
								<th >อายุ</th>
								<th >กรุ๊ปเลือด</th>
								<th >เชื้อชาติ</th>
								<th >สัญชาติ</th>
								<th >ศาสนา</th>
								<th >เบอร์โทรศัพท์นักเรียน</th>
								<th >จำนวนฟี่น้องรวม</th>
								<th >มีฟี่น้องเรียนสถานศึกษานี้</th>
								<th >เป็นบุตรคนที่</th>
								<th >ความบกพร่องทางร่างกาย</th>
								<th >ที่เกิดโรงพยาบาล</th>
								<th >ที่เกิดตำบล</th>
								<th >ที่เกิดอำเภอ</th>
								<th >ที่เกิดจังหวัด</th>
								<th >โรงเรียนเดิม</th>
								<th >ระดับชั้น (โรงเรียนเดิม)</th>
<!--Pint data_student End-->
<!--Pint stu_address_home-->
								<th >บ้านเลขที่ (ทะเบียนบ้าน)</th>
								<th >หมู่ (ทะเบียนบ้าน)</th>
								<th >ซอย (ทะเบียนบ้าน)</th>
								<th >ถนน (ทะเบียนบ้าน)</th>
								<th >ตำบล (ทะเบียนบ้าน)</th>
								<th >อำเภอ (ทะเบียนบ้าน)</th>
								<th >จังหวัด (ทะเบียนบ้าน)</th>
								<th >รหัสไปรษณีย์ (ทะเบียนบ้าน)</th>
<!--Pint stu_address_home End-->		
<!--Pint stu_address -->
								<th >บ้านเลขที่ (ปัจจุบัน)</th>
								<th >หมู่ (ปัจจุบัน)</th>
								<th >ซอย (ปัจจุบัน)</th>
								<th >ถนน (ปัจจุบัน)</th>
								<th >ตำบล (ปัจจุบัน)</th>
								<th >อำเภอ (ปัจจุบัน)</th>
								<th >จังหวัด (ปัจจุบัน)</th>
								<th >รหัสไปรษณีย์ (ปัจจุบัน)</th>
<!--Pint stu_address End-->			
<!--print depend_stu-->
								<th >นักเรียนอาศัยอยู่กับ</th>
								<th >ชื่อหอพัก</th>
								<th >ที่อยู่เลขที่</th>
								<th >หมู่ที่</th>
								<th >ซอย</th>
								<th >ถนน</th>
								<th >ตำบล</th>
								<th >อำเภอ</th>
								<th >จังหวัด</th>
								<th >รหัสไปรษณีย์</th>
								<th >โทรศัพท์</th>
								<th >ชื่อเจ้าของหรือผู้ปกครองหอพัก</th>
								<th >การเดินทางมาโรงเรียน</th>
								<th >สถานภาพบิดา-มารดา</th>
								<th >การแพ้อาหาร</th>
								<th >โรคประจำตัว</th>
								<th >การแพ้ยา</th>
								<th >การแพ้พิษ</th>
								
<!--print depend_stu End--->
<!--print stu_father-->
								<th>ชื่อ-สกุล บิดา ภาษาไทย</th>
								<th>ชื่อ-สกุล บิดา ภาษาอังกฤษ</th>
								<th>รหัสประจำตัวประชาชน</th>
								<th>กรุ๊ปเลือด</th>
								<th>เชื้อชาติ</th>
								<th>สัญชาติ</th>
								<th>ศาสนา</th>		
								<th>วันเดือนปีเกิด</th>
								<th>อาชีพ</th>
								<th>วุฒิการศึกษา</th>
								<th>ช่วงรายได้ / เดือน</th>
								<!--<th>สถานที่ทำงาน</th>-->
								<th>ตำแหน่ง</th>
								<th>เบอร์โทรศัทพ์ที่ทำงาน</th>
								<th>เบอร์โทรศัทพ์ บิดา</th>
<!--print stu_father End -->
<!--print_stu_father_addword-->
								<th>สถานที่ทำงาน</th>
								<th>บ้านเลขที่ (ที่ทำงาน)</th>
								<th>หมู่ (ที่ทำงาน)</th>
								<th>ซอย (ที่ทำงาน)</th>
								<th>ถนน (ที่ทำงาน)</th>
								<th>ตำบล (ที่ทำงาน)</th>
								<th>อำเภอ (ปที่ทำงาน)</th>
								<th>จังหวัด (ที่ทำงาน)</th>
								<th>รหัสไปรษณีย์ (ที่ทำงาน)</th>
<!--print_stu_father_addword End-->

<!--print stu_father_address-->
								<th>บ้านเลขที่ (ที่อยู่)</th>
								<th>หมู่ (ที่อยู่)</th>
								<th>ซอย (ที่อยู่)</th>
								<th>ถนน (ที่อยู่)</th>
								<th>ตำบล (ที่อยู่)</th>
								<th>อำเภอ (ที่อยู่)</th>
								<th>จังหวัด (ที่อยู่)</th>
								<th>รหัสไปรษณีย์ (ที่อยู่)</th>
<!--print stu_father_address End-->

<!--print stu_mother-->
								<th>ชื่อ-สกุล มารดา ภาษาไทย</th>
								<th>ชื่อ-สกุล มารดา ภาษาอังกฤษ</th>
								<th>รหัสประจำตัวประชาชน</th>
								<th>กรุ๊ปเลือด</th>
								<th>เชื้อชาติ</th>
								<th>สัญชาติ</th>
								<th>ศาสนา</th>		
								<th>วันเดือนปีเกิด</th>
								<th>อาชีพ</th>
								<th>วุฒิการศึกษา</th>
								<th>ช่วงรายได้ / เดือน</th>
								<!--<th>สถานที่ทำงาน</th>-->
								<th>ตำแหน่ง</th>
								<th>เบอร์โทรศัทพ์ที่ทำงาน</th>
								<th>เบอร์โทรศัทพ์ มารดา</th>
<!--print stu_mother End-->
			
<!--print_mother_addword-->

								<th>สถานที่ทำงาน</th>
								<th>บ้านเลขที่ (ที่ทำงาน)</th>
								<th>หมู่ (ที่ทำงาน)</th>
								<th>ซอย (ที่ทำงาน)</th>
								<th>ถนน (ที่ทำงาน)</th>
								<th>ตำบล (ที่ทำงาน)</th>
								<th>อำเภอ (ปที่ทำงาน)</th>
								<th>จังหวัด (ที่ทำงาน)</th>
								<th>รหัสไปรษณีย์ (ที่ทำงาน)</th>
								
<!--print_mother_addword End-->			
			
<!--print stu_mother_address-->
								<th>บ้านเลขที่ (ที่อยู่)</th>
								<th>หมู่ (ที่อยู่)</th>
								<th>ซอย (ที่อยู่)</th>
								<th>ถนน (ที่อยู่)</th>
								<th>ตำบล (ที่อยู่)</th>
								<th>อำเภอ (ที่อยู่)</th>
								<th>จังหวัด (ที่อยู่)</th>
								<th>รหัสไปรษณีย์ (ที่อยู่)</th>
<!--print stu_mother_address End-->

							

								<th>ชื่อ-สกุล ผู้ปกครอง ภาษาไทย</th>
								<th>ชื่อ-สกุล ผู้ปกครอง ภาษาอังกฤษ</th>
								<th>รหัสประจำตัวประชาชน</th>
								<th>กรุ๊ปเลือด</th>
								<th>เชื้อชาติ</th>
								<th>สัญชาติ</th>
								<th>ศาสนา</th>		
								<th>วันเดือนปีเกิด</th>
								<th>อาชีพ</th>
								<th>วุฒิการศึกษา</th>
								<th>ช่วงรายได้ / เดือน</th>
								<!--<th>สถานที่ทำงาน</th>-->
								<th>ตำแหน่ง</th>
								<th>เบอร์โทรศัทพ์ที่ทำงาน</th>
								<th>เบอร์โทรศัทพ์ ผู้ปกครอง</th>

								<th>สถานที่ทำงาน</th>
								<th>บ้านเลขที่ (ที่ทำงาน)</th>
								<th>หมู่ (ที่ทำงาน)</th>
								<th>ซอย (ที่ทำงาน)</th>
								<th>ถนน (ที่ทำงาน)</th>
								<th>ตำบล (ที่ทำงาน)</th>
								<th>อำเภอ (ปที่ทำงาน)</th>
								<th>จังหวัด (ที่ทำงาน)</th>
								<th>รหัสไปรษณีย์ (ที่ทำงาน)</th>

								<th>บ้านเลขที่ (ที่อยู่)</th>
								<th>หมู่ (ที่อยู่)</th>
								<th>ซอย (ที่อยู่)</th>
								<th>ถนน (ที่อยู่)</th>
								<th>ตำบล (ที่อยู่)</th>
								<th>อำเภอ (ที่อยู่)</th>
								<th>จังหวัด (ที่อยู่)</th>
								<th>รหัสไปรษณีย์ (ที่อยู่)</th>
								<th>ความสัมพันธ์</th>



			
			
							</tr>
						</thead>
						<tbody>
	
			<?php			
				$data_sturcroom=new data_sturoom($txt_t,$txt_y,$txt_class,$txt_room);	
				foreach($data_sturcroom->printdata_sturoom as $rc_key=>$sturcroom_rom){ 
					$rsc_num=$sturcroom_rom["rsc_num"];
					$rsd_studentid=$sturcroom_rom["rsd_studentid"];
					$rsd_Identification=$sturcroom_rom["rsd_Identification"];
					$nickTh=$sturcroom_rom["nickTh"];
					
					$nickEn=strtolower($sturcroom_rom["nickEn"]);
					$nickEn=ucfirst($nickEn);
					
					$data_prefix=new print_prefix($rsd_prefix=$sturcroom_rom["rsd_prefix"]);
					
					$ReginaStuName=new PrintReginaStuData($rsd_studentid);
										
//--Update : name_th / name_en					
					$NameSud=new PrintReginaStuDataClass($rsd_studentid);
					$name_th=$NameSud->PRS_nameTH;
					$name_en=$NameSud->PRS_nameEH;
					$DataAge=$NameSud->DataAge;
					
					/*if(isset($ReginaStuName->PRS_nameTH)){
						$name_th=$ReginaStuName->PRS_nameTH;
					}else{
						$name_th=$data_prefix->prefix_prefixname."&nbsp;".$sturcroom_rom["rsd_name"]."&nbsp;".$sturcroom_rom["rsd_surname"];
					}
					
					$name_en=strtolower("Miss&nbsp;".$sturcroom_rom["rsd_nameEn"]."&nbsp;".$sturcroom_rom["rsd_surnameEn"]) ;
					$name_en=ucfirst($name_en);*/
					
//--Update : name_th / name_en End 07/03/2023 by beer
					
					$data_plan=new print_plan($rsc_plan=$sturcroom_rom["rsc_plan"]);					
					
					if(($sturcroom_rom["rse_home"]==1)){
						$print_home="ฟ";
					}elseif(($sturcroom_rom["rse_home"]==2)){
						$print_home="ด";
					}elseif(($sturcroom_rom["rse_home"]==3)){
						$print_home="ล";
					}elseif(($sturcroom_rom["rse_home"]==4)){
						$print_home="ข";
					}else{
						$print_home=null;
					}
				?>
<!------------------------------------------------------------------------------>
				<?php
				//data_student
					$call_data_student=new data_student($rsd_studentid);
					
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
					$call_stu_address_home=new stu_address_home($rsd_studentid);
				
					$stu_reg_tumbon=new data_Subdistrict($call_stu_address_home->stu_reg_tumbon); //$stu_reg_tumbon->DISTRICT_NAME
					$stu_reg_amphur=new data_District($call_stu_address_home->stu_reg_amphur); //$stu_reg_amphur->AMPHUR_NAME
					$stu_reg_province=new data_Province($call_stu_address_home->stu_reg_province); //$stu_reg_province->PROVINCE_NAME
					
				
				?>
		
<!------------------------------------------------------------------------------>		
				<?php
				//stu_address
					$call_stu_address=new stu_address($rsd_studentid);
					
					$stu_tumbon=new data_Subdistrict($call_stu_address->stu_tumbon); //$stu_tumbon->DISTRICT_NAME
					$stu_amphur=new data_District($call_stu_address->stu_amphur); //$stu_amphur->AMPHUR_NAME
					$stu_province=new data_Province($call_stu_address->stu_province); //$stu_province->PROVINCE_NAME
				?>
<!------------------------------------------------------------------------------>
				<?php
				//depend_stu
					$call_depend_stu=new depend_stu($rsd_studentid);	
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
					
					
					
					
				?>
	
		
				
							<tr>
								<td ><?php echo $rsc_num;?></td>
								<td ><?php echo $rsd_studentid;?></td>
								<td ><?php echo $rsd_Identification;?></td>
								<td ><?php echo $name_th;?></td>
								<td ><?php echo $nickTh;?></td>
								<td ><?php echo $nickEn;?></td>
								<td ><?php echo $name_en;?></td>
								<td ><?php echo $data_plan->plan_Name;?></td>
								<td ><?php echo $print_home;?></td>
<!--Pint data_student-->								
			<?php
					if(($call_data_student->stu_birth=="" or $call_data_student->stu_birth==null or $call_data_student->stu_birth=="-")){ ?>
								<td >-</td>					
			<?php	}else{ ?>
								<td ><?php echo dateThailand($call_data_student->stu_birth);?></td>	
			<?php	} ?>					
								<td ><?php echo $DataAge;?></td>
								<td ><?php echo $call_data_student->stu_blood;?></td>
								<td ><?php echo $stu_nation->nation_name_th;?></td>
								<td ><?php echo $stu_sun->nation_name_th;?></td>
								<td ><?php echo $IDReligion->Religion;?></td>
								<td ><?php echo $call_data_student->stu_phone;?></td>
								<td ><?php echo $call_data_student->stu_brethren;?></td>
								<td ><?php echo $call_data_student->stu_brethreS;?></td>
								<td ><?php echo $call_data_student->stu_child;?></td>
								<td ><?php echo $stu_physical->disabled_txt;?></td>
								<td ><?php echo $call_data_student->breed_add;?></td>
								<td ><?php echo $breed_district->DISTRICT_NAME;?></td>
								<td ><?php echo $breed_city->AMPHUR_NAME;?></td>
								<td ><?php echo $breed_province->PROVINCE_NAME;?></td>
								<td ><?php echo $call_data_student->ds_SameSchool;?></td>
								<td ><?php echo $ds_OriginalClass->level_Lname;?></td>
<!--Pint data_student End-->		
<!--Pint stu_address_home-->			
								<td ><?php echo $call_stu_address_home->stu_reg_hno;?></td>
								<td ><?php echo $call_stu_address_home->stu_reg_moo;?></td>
								<td ><?php echo $call_stu_address_home->stu_reg_soi;?></td>
								<td ><?php echo $call_stu_address_home->stu_reg_road;?></td>
								<td ><?php echo $stu_reg_tumbon->DISTRICT_NAME;?></td>
								<td ><?php echo $stu_reg_amphur->AMPHUR_NAME;?></td>
								<td ><?php echo $stu_reg_province->PROVINCE_NAME;?></td>
								<td ><?php echo $call_stu_address_home->stu_reg_zipcode;?></td>
<!--Pint stu_address_home End-->
<!--Pint stu_address -->
								<td ><?php echo $call_stu_address->stu_hno;?></td>
								<td ><?php echo $call_stu_address->stu_moo;?></td>
								<td ><?php echo $call_stu_address->stu_soi;?></td>
								<td ><?php echo $call_stu_address->stu_road;?></td>
								<td ><?php echo $stu_tumbon->DISTRICT_NAME;?></td>
								<td ><?php echo $stu_amphur->AMPHUR_NAME;?></td>
								<td ><?php echo $stu_province->PROVINCE_NAME;?></td>
								<td ><?php echo $call_stu_address->stu_zipcode;?></td>
<!--Pint stu_address End-->					
								<td ><?php echo $ds_status->dr_txt;?></td>
								<td ><?php echo $call_depend_stu->ds_dormitoryName;?></td>
								<td ><?php echo $call_depend_stu->ds_dormitoryHno;?></td>
								<td ><?php echo $call_depend_stu->ds_dormitoryMoo;?></td>
								<td ><?php echo $call_depend_stu->ds_dormitorySoi;?></td>
								<td ><?php echo $call_depend_stu->ds_dormitoryRoad;?></td>
								<td ><?php echo $ds_dormitoryTumbon->DISTRICT_NAME;?></td>
								<td ><?php echo $ds_dormitoryAmphur->AMPHUR_NAME;?></td>
								<td ><?php echo $ds_dormitoryProvince->PROVINCE_NAME;?></td>
								<td ><?php echo $call_depend_stu->ds_dormitoryZipcode;?></td>
								<td ><?php echo $call_depend_stu->ds_dormitoryPhone;?></td>
								<td ><?php echo $call_depend_stu->ds_dormitoryMyName;?></td>
								
<!---->
			<?php
				$ds_trip=new data_gohome($call_depend_stu->ds_trip);
				if(($ds_trip->dgh_id==7)){ ?>
								<td ><?php echo $call_depend_stu->ds_triptxt;?></td>						
				<?php }else{ ?>
								<td ><?php echo $ds_trip->dgh_txt;?></td>
				<?php }      ?>		
								
<!---->								
								
								<td ><?php echo $ds_FMstatus->family_txt;?></td>
								<td ><?php echo $call_depend_stu->ds_FoodAllergies;?></td>
								<td ><?php echo $call_depend_stu->ds_CongenitalDisease;?></td>
								<td ><?php echo $call_depend_stu->ds_DrugAllergy;?></td>
								<td ><?php echo $call_depend_stu->ds_allergic;?></td>
<!--print stu_father-->
								<td><?php echo $father_prefix->prefix_prefix_SName." ".$call_stu_father->father_fname." ".$call_stu_father->father_sname;?></td>
								<td><?php echo $father_prefix_en->prefix_prefix_SName." ".$call_stu_father->father_fname_en." ".$call_stu_father->father_sname_en;?></td>
								<td><?php echo $call_stu_father->father_code; ?></td>
								<td><?php echo $call_stu_father->sf_blood; ?></td>
								<td><?php echo $sf_nation->nation_name_th;?></td>
								<td><?php echo $sf_sun->nation_name_th;?></td>
								<td><?php echo $sf_IDReligion->Religion;?></td>
			<?php
					if(($call_stu_father->af_birthday=="" or $call_stu_father->af_birthday==null)){ ?>
								<td></td>					
			<?php	}else{ ?>
								<td><?php echo dateThailand($call_stu_father->af_birthday);?></td>	
			<?php	} ?>								
<!---->
								<td><?php echo $call_father_career->dc_txt2;?></td>
								<td><?php echo $call_father_study->study_txt;?></td>
								<td><?php echo $call_father_salary->di_txt;?></td>
								<!--<td><?php //echo $call_stu_father->father_workplace;?></td>-->
								<td><?php echo $call_stu_father->father_wp_pro;?></td>
								<td><?php echo $call_stu_father->father_wp_tel;?></td>
								<td><?php echo $call_stu_father->father_phone;?></td>
								 
<!--print stu_father End -->					
<!--print_stu_father_addword-->
								<td><?php echo $call_stu_father->father_workplace;?></td>
								<td><?php echo $call_stu_father_addword->father_addwordhno;?></td>
								<td><?php echo $call_stu_father_addword->father_addwordmoo;?></td>
								<td><?php echo $call_stu_father_addword->father_addwordsoi;?></td>
								<td><?php echo $call_stu_father_addword->father_addwordroad;?></td>
								<td><?php echo $father_addwordtumbon->DISTRICT_NAME;?></td>
								<td><?php echo $father_addwordamphur->AMPHUR_NAME;?></td>
								<td><?php echo $father_addwordprovince->PROVINCE_NAME;?></td>
								<td><?php echo $call_stu_father_addword->father_addwordzipcode;?></td>
<!--print_stu_father_addword End-->					
<!--print stu_father_address-->
								<td><?php echo $call_stu_father_address->father_hno;?></td>
								<td><?php echo $call_stu_father_address->father_moo;?></td>
								<td><?php echo $call_stu_father_address->father_soi;?></td>
								<td><?php echo $call_stu_father_address->father_road;?></td>
								<td><?php echo $father_tumbon->DISTRICT_NAME;?></td>
								<td><?php echo $father_amphur->AMPHUR_NAME;?></td>
								<td><?php echo $father_province->PROVINCE_NAME;?></td>
								<td><?php echo $call_stu_father_address->father_zipcode;?></td>
<!--print stu_father_address End-->					
<!--print stu_mother-->
								<td><?php echo $mother_prefix->prefix_prefix_SName." ".$call_stu_mother->mother_fname." ".$call_stu_mother->mother_sname;?></td>
								<td><?php echo $mother_prefix_en->prefix_prefix_SName." ".$call_stu_mother->mother_fname_en." ".$call_stu_mother->mother_sname_en;?></td>
								<td><?php echo $call_stu_mother->mother_code; ?></td>
								<td><?php echo $call_stu_mother->mother_blood; ?></td>
								<td><?php echo $mother_nation->nation_name_th;?></td>
								<td><?php echo $mother_sun->nation_name_th;?></td>
								<td><?php echo $mother_IDReligion->Religion;?></td>
			<?php
					if($call_stu_mother->mother_birthday==""){ ?>
								<td></td>					
			<?php	}else{ ?>
								<td><?php echo dateThailand($call_stu_mother->mother_birthday);?></td>	
			<?php	} ?>	
								<td><?php echo $mother_career->dc_txt2;?></td>
								<td><?php echo $mother_study->study_txt;?></td>
								<td><?php echo $mother_salary->di_txt;?></td>
								<!--<td><?php //echo $call_stu_father->father_workplace;?></td>-->
								<td><?php echo $call_stu_mother->mother_wp_pro;?></td>
								<td><?php echo $call_stu_mother->mother_wp_tel;?></td>
								<td><?php echo $call_stu_mother->mother_phone;?></td>			
<!--stu_mother End-->					

<!--stu_mother_addword-->
								<td><?php echo $call_stu_mother->mother_workplace;?></td>
								<td><?php echo $call_stu_mother_addword->mother_wordhno;?></td>
								<td><?php echo $call_stu_mother_addword->mother_wordmoo;?></td>
								<td><?php echo $call_stu_mother_addword->mother_wordsoi;?></td>
								<td><?php echo $call_stu_mother_addword->mother_wordroad;?></td>
							
								<td><?php echo $mother_wordtumbon->DISTRICT_NAME;?></td>
								<td><?php echo $mother_wordamphur->AMPHUR_NAME;?></td>
								<td><?php echo $mother_wordprovince->PROVINCE_NAME;?></td>
								<td><?php echo $call_stu_mother_addword->mother_wordzipcode;?></td>
					
<!--stu_mother_addword End -->					

<!--print stu_mother_address-->
								<td><?php echo $call_stu_mother_address->mother_hno;?></td>
								<td><?php echo $call_stu_mother_address->mother_moo;?></td>
								<td><?php echo $call_stu_mother_address->mother_soi;?></td>
								<td><?php echo $call_stu_mother_address->mother_road;?></td>
								<td><?php echo $mother_tumbon->DISTRICT_NAME;?></td>
								<td><?php echo $mother_amphur->AMPHUR_NAME;?></td>
								<td><?php echo $mother_province->PROVINCE_NAME;?></td>
								<td><?php echo $call_stu_mother_address->mother_zipcode;?></td>
<!--print stu_mother_address End-->					
					


<!--print -->					
				<?php
					if($call_stu_guardian->parent_status==2){ ?>
			
<!--print stu_father-->
								<td><?php echo $father_prefix->prefix_prefix_SName." ".$call_stu_father->father_fname." ".$call_stu_father->father_sname;?></td>
								<td><?php echo $father_prefix_en->prefix_prefix_SName." ".$call_stu_father->father_fname_en." ".$call_stu_father->father_sname_en;?></td>
								<td><?php echo $call_stu_father->father_code; ?></td>
								<td><?php echo $call_stu_father->sf_blood; ?></td>
								<td><?php echo $sf_nation->nation_name_th;?></td>
								<td><?php echo $sf_sun->nation_name_th;?></td>
								<td><?php echo $sf_IDReligion->Religion;?></td>
			<?php
					if($call_stu_father->af_birthday==""){ ?>
								<td></td>					
			<?php	}else{ ?>
								<td><?php echo dateThailand($call_stu_father->af_birthday);?></td>	
			<?php	} ?>								
<!---->
								<td><?php echo $call_father_career->dc_txt2;?></td>
								<td><?php echo $call_father_study->study_txt;?></td>
								<td><?php echo $call_father_salary->di_txt;?></td>
								<!--<td><?php //echo $call_stu_father->father_workplace;?></td>-->
								<td><?php echo $call_stu_father->father_wp_pro;?></td>
								<td><?php echo $call_stu_father->father_wp_tel;?></td>
								<td><?php echo $call_stu_father->father_phone;?></td>
								 
<!--print stu_father End -->					
<!--print_stu_father_addword-->
								<td><?php echo $call_stu_father->father_workplace;?></td>
								<td><?php echo $call_stu_father_addword->father_addwordhno;?></td>
								<td><?php echo $call_stu_father_addword->father_addwordmoo;?></td>
								<td><?php echo $call_stu_father_addword->father_addwordsoi;?></td>
								<td><?php echo $call_stu_father_addword->father_addwordroad;?></td>
								<td><?php echo $father_addwordtumbon->DISTRICT_NAME;?></td>
								<td><?php echo $father_addwordamphur->AMPHUR_NAME;?></td>
								<td><?php echo $father_addwordprovince->PROVINCE_NAME;?></td>
								<td><?php echo $call_stu_father_addword->father_addwordzipcode;?></td>
<!--print_stu_father_addword End-->					
<!--print stu_father_address-->
								<td><?php echo $call_stu_father_address->father_hno;?></td>
								<td><?php echo $call_stu_father_address->father_moo;?></td>
								<td><?php echo $call_stu_father_address->father_soi;?></td>
								<td><?php echo $call_stu_father_address->father_road;?></td>
								<td><?php echo $father_tumbon->DISTRICT_NAME;?></td>
								<td><?php echo $father_amphur->AMPHUR_NAME;?></td>
								<td><?php echo $father_province->PROVINCE_NAME;?></td>
								<td><?php echo $call_stu_father_address->father_zipcode;?></td>
<!--print stu_father_address End-->	
			
			<?php	}elseif(($call_stu_guardian->parent_status==3)){ ?>

<!--print stu_mother-->
								<td><?php echo $mother_prefix->prefix_prefix_SName." ".$call_stu_mother->mother_fname." ".$call_stu_mother->mother_sname;?></td>
								<td><?php echo $mother_prefix_en->prefix_prefix_SName." ".$call_stu_mother->mother_fname_en." ".$call_stu_mother->mother_sname_en;?></td>
								<td><?php echo $call_stu_mother->mother_code; ?></td>
								<td><?php echo $call_stu_mother->mother_blood; ?></td>
								<td><?php echo $mother_nation->nation_name_th;?></td>
								<td><?php echo $mother_sun->nation_name_th;?></td>
								<td><?php echo $mother_IDReligion->Religion;?></td>
			<?php
					if(($call_stu_mother->mother_birthday=="" or $call_stu_mother->mother_birthday==null)){ ?>
								<td></td>					
			<?php	}else{ ?>
								<td><?php echo dateThailand($call_stu_mother->mother_birthday);?></td>	
			<?php	} ?>	
								<td><?php echo $mother_career->dc_txt2;?></td>
								<td><?php echo $mother_study->study_txt;?></td>
								<td><?php echo $mother_salary->di_txt;?></td>
								<!--<td><?php //echo $call_stu_father->father_workplace;?></td>-->
								<td><?php echo $call_stu_mother->mother_wp_pro;?></td>
								<td><?php echo $call_stu_mother->mother_wp_tel;?></td>
								<td><?php echo $call_stu_mother->mother_phone;?></td>			
<!--stu_mother End-->					

<!--stu_mother_addword-->
								<td><?php echo $call_stu_mother->mother_workplace;?></td>
								<td><?php echo $call_stu_mother_addword->mother_wordhno;?></td>
								<td><?php echo $call_stu_mother_addword->mother_wordmoo;?></td>
								<td><?php echo $call_stu_mother_addword->mother_wordsoi;?></td>
								<td><?php echo $call_stu_mother_addword->mother_wordroad;?></td>
							
								<td><?php echo $mother_wordtumbon->DISTRICT_NAME;?></td>
								<td><?php echo $mother_wordamphur->AMPHUR_NAME;?></td>
								<td><?php echo $mother_wordprovince->PROVINCE_NAME;?></td>
								<td><?php echo $call_stu_mother_addword->mother_wordzipcode;?></td>
					
<!--stu_mother_addword End -->					

<!--print stu_mother_address-->
								<td><?php echo $call_stu_mother_address->mother_hno;?></td>
								<td><?php echo $call_stu_mother_address->mother_moo;?></td>
								<td><?php echo $call_stu_mother_address->mother_soi;?></td>
								<td><?php echo $call_stu_mother_address->mother_road;?></td>
								<td><?php echo $mother_tumbon->DISTRICT_NAME;?></td>
								<td><?php echo $mother_amphur->AMPHUR_NAME;?></td>
								<td><?php echo $mother_province->PROVINCE_NAME;?></td>
								<td><?php echo $call_stu_mother_address->mother_zipcode;?></td>
<!--print stu_mother_address End-->			
						
		    <?php	}elseif(($call_stu_guardian->parent_status==5)){ ?>
			
<!--print stu_mother-->
								<td><?php echo $call_depend_stu->ds_dormitoryMyName;?></td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
			
								<td> - </td>					


	
								<td> - </td>
								<td> - </td>
								<td> - </td>
						
								<td> - </td>
								<td> - </td>
								<td><?php echo $call_depend_stu->ds_dormitoryPhone;?></td>			
<!--stu_mother End-->					

<!--stu_mother_addword-->
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
							
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
					
<!--stu_mother_addword End -->					

<!--print stu_mother_address-->
								<td ><?php echo $call_depend_stu->ds_dormitoryHno;?></td>
								<td ><?php echo $call_depend_stu->ds_dormitoryMoo;?></td>
								<td ><?php echo $call_depend_stu->ds_dormitorySoi;?></td>
								<td ><?php echo $call_depend_stu->ds_dormitoryRoad;?></td>
								<td ><?php echo $ds_dormitoryTumbon->DISTRICT_NAME;?></td>
								<td ><?php echo $ds_dormitoryAmphur->AMPHUR_NAME;?></td>
								<td ><?php echo $ds_dormitoryProvince->PROVINCE_NAME;?></td>
								<td ><?php echo $call_depend_stu->ds_dormitoryZipcode;?></td>
<!--print stu_mother_address End-->			
					
				<?php	}elseif(($call_stu_guardian->parent_status==1 or $call_stu_guardian->parent_status==0 or $call_stu_guardian->parent_status=="")){ ?>
					
<!--print stu_mother-->
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
			
								<td> - </td>					


	
								<td> - </td>
								<td> - </td>
								<td> - </td>
						
								<td> - </td>
								<td> - </td>
								<td> - </td>			
<!--stu_mother End-->					

<!--stu_mother_addword-->
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
							
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
					
<!--stu_mother_addword End -->					

<!--print stu_mother_address-->
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
								<td> - </td>
<!--print stu_mother_address End-->
					
			<?php	}else{ ?>
<!--print stu_parent-->
								<td><?php echo $parent_prefix->prefix_prefix_SName." ".$call_stu_guardian->parent_fname." ".$call_stu_guardian->parent_sname;?></td>
								<td><?php echo $parent_prefix_en->prefix_prefix_SName." ".$call_stu_guardian->parent_fname_en." ".$call_stu_guardian->parent_sname_en;?></td>
								<td><?php echo $call_stu_guardian->parent_code; ?></td>
								<td><?php echo $call_stu_guardian->parent_blood; ?></td>
								<td><?php echo $parent_nation->nation_name_th;?></td>
								<td><?php echo $parent_sun->nation_name_th;?></td>
								<td><?php echo $parent_IDReligion->Religion;?></td>
			<?php
					if(($call_stu_guardian->parent_birthday=="" or $call_stu_guardian->parent_birthday==null)){ ?>
								<td></td>					
			<?php	}else{ ?>
								<td><?php echo dateThailand($call_stu_guardian->parent_birthday);?></td>	
			<?php	} ?>	
								<td><?php echo $parent_career->dc_txt2;?></td>
								<td><?php echo $parent_study->study_txt;?></td>
								<td><?php echo $parent_salary->di_txt;?></td>
								<!--<td><?php //echo $call_stu_father->father_workplace;?></td>-->
								<td><?php echo $call_stu_guardian->parent_wp_pro;?></td>
								<td><?php echo $call_stu_guardian->parent_wp_tel;?></td>
								<td><?php echo $call_stu_guardian->parent_phone;?></td>			
<!--stu_parent End-->					

<!--stu_parent_addword-->
								<td><?php echo $call_stu_guardian->parent_workplace;?></td>
								<td><?php echo $call_stu_guardian_addword->parent_wordhno;?></td>
								<td><?php echo $call_stu_guardian_addword->parent_wordmoo;?></td>
								<td><?php echo $call_stu_guardian_addword->parent_wordsoi;?></td>
								<td><?php echo $call_stu_guardian_addword->parent_wordroad;?></td>
							
								<td><?php echo $parent_wordtumbon->DISTRICT_NAME;?></td>
								<td><?php echo $parent_wordamphur->AMPHUR_NAME;?></td>
								<td><?php echo $parent_wordprovince->PROVINCE_NAME;?></td>
								<td><?php echo $call_stu_guardian_addword->parent_wordzipcode;?></td>
					
<!--stu_parent_addword End -->					

<!--print stu_parent_address-->
								<td><?php echo $call_stu_guardian_address->parent_hno;?></td>
								<td><?php echo $call_stu_guardian_address->parent_moo;?></td>
								<td><?php echo $call_stu_guardian_address->parent_soi;?></td>
								<td><?php echo $call_stu_guardian_address->parent_road;?></td>
								<td><?php echo $parent_tumbon->DISTRICT_NAME;?></td>
								<td><?php echo $parent_amphur->AMPHUR_NAME;?></td>
								<td><?php echo $parent_province->PROVINCE_NAME;?></td>
								<td><?php echo $call_stu_guardian_address->parent_zipcode;?></td>
<!--print stu_parent_address End-->							
			<?php	}      ?>							
<!--print End -->						
								<td><?php echo $parent_status->dr_txt;?></td>
					
							</tr>					
			<?php	} ?>			
		
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
</div>