<?php
	include("../../../../database/database_evaluation.php");
	
	include("../../../../database/pdo_conndatastu.php");
	include("../../../../database/class_pdodatastu.php");
	
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");
	
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
					filename: 'tab5  ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
					title: 'tab5  ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?>  ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
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
			<div class="panel-heading">tab5 ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?>  ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></div>
			<div class="panel-body">

				<div class="table-responsive">				
					<table class="table datatable-button-html5-columns table-bordered">
						<thead>   
							<tr>
								<th>รหัสประจำตัวนักเรียน</th>
								<th>คำนำหน้า</th>
								<th>ชื่อ</th>
								<th>นามสกุล</th>
								<th>วันเกิด (27/06/2018 )</th>
								<th>สัญชาติ </th>
								<th>เชื้อชาติ</th>
								<th>ศาสนา</th>
								<th>เลขประจำตัวประชาชน</th>
								<th>อาชีพ</th>
								<th>อาชีพอื่นๆ</th>
								<th>ช่วงรายได้</th>
								<th>ช่วงรายได้/ต่อเดือน (15000)</th>
								<th>การศึกษา</th>
								<th>ที่ทำงาน</th>
								<th>โทรศัพท์ (0899999999)</th>
								<th>คำนำหน้า</th>
								<th>ชื่อ</th>
								<th>นามสกุล</th>
								<th>วันเกิด (27/06/2018 )</th>
								<th> สัญชาติ</th>
								<th>เชื้อชาติ</th>
								<th>ศาสนา</th>
								<th>เลขประจำตัวประชาชน</th>
								<th>อาชีพ</th>
								<th>อาชีพอื่นๆ</th>
								<th>ช่วงรายได้ </th>
								<th>ช่วงรายได้/ต่อเดือน (15000)</th>
								<th>การศึกษา </th>
								<th>ที่ทำงาน </th>
								<th>โทรศัพท์ (0899999999) </th>
								<th>สถานะครอบครัว</th> 	    	     	 	    	   	   	   	 	  	 	  		





  	  	   	  	  	  	   	   	  	   	   	   	   	 

  	   	  	  	   	   	   	   	  	  	  								

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
					$nickEn=$sturcroom_rom["nickEn"];
					$data_prefix=new print_prefix($rsd_prefix=$sturcroom_rom["rsd_prefix"]);
					$data_plan=new print_plan($rsc_plan=$sturcroom_rom["rsc_plan"]);
					
					$name_th=$data_prefix->prefix_prefix_SName." ".$sturcroom_rom["rsd_name"]." ".$sturcroom_rom["rsd_surname"];
					$name_en="Miss ".$sturcroom_rom["rsd_nameEn"]." ".$sturcroom_rom["rsd_surnameEn"];
					
					if($sturcroom_rom["rse_home"]==1){
						$print_home="ฟ";
					}elseif($sturcroom_rom["rse_home"]==2){
						$print_home="ด";
					}elseif($sturcroom_rom["rse_home"]==3){
						$print_home="ล";
					}elseif($sturcroom_rom["rse_home"]==4){
						$print_home="ข";
					}else{
						$print_home="";
					}
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
	
				?>			
					
					
			<?php
				$CheckSaveSwisTime=new CheckSaveSwisTime($rsd_studentid);
					if($CheckSaveSwisTime->RunCheckSaveSwisTime()=="New"){ ?>
					
							<tr>

								<td><?php echo $rsd_studentid;?></td>
								<td><?php echo $father_prefix->prefix_prefix_SName;?></td>
								<td><?php echo $call_stu_father->father_fname;?></td>
								<td><?php echo $call_stu_father->father_sname;?></td>
			<?php
					if($call_stu_father->af_birthday==""){ ?>
								<td></td>					
			<?php	}else{ ?>
								<td><?php echo date("d/m/Y",strtotime($call_stu_father->af_birthday));?></td>	
			<?php	} ?>									
								
								<td><?php echo $sf_nation->nation_name_th;?></td>
								<td><?php echo $sf_sun->nation_name_th;?></td>
								<td><?php echo $sf_IDReligion->Religion;?></td>
								<td><?php echo $call_stu_father->father_code; ?></td>
								<td><?php echo $call_father_career->dc_txt2;?></td>
								<td></td>
								<td><?php echo $call_father_salary->di_txt;?></td>
								<td></td>
								<td><?php echo $call_father_study->study_txt;?></td>
								<td><?php echo $call_stu_father->father_workplace;?></td>
								<td><?php echo $call_stu_father->father_phone;?></td>
								<td><?php echo $mother_prefix->prefix_prefix_SName;?></td>
								<td><?php echo $call_stu_mother->mother_fname;?></td>
								<td><?php echo $call_stu_mother->mother_sname;?></td>
	<?php
					if($call_stu_mother->mother_birthday==""){ ?>
								<td></td>					
			<?php	}else{ ?>
								<td><?php echo date("d/m/Y",strtotime($call_stu_mother->mother_birthday));?></td>	
			<?php	} ?>
								<td><?php echo $mother_nation->nation_name_th;?></td>
								<td><?php echo $mother_sun->nation_name_th;?></td>
								<td><?php echo $mother_IDReligion->Religion;?></td>
								<td><?php echo $call_stu_mother->mother_code; ?></td>
								<td><?php echo $mother_career->dc_txt2;?></td>
								<td></td>
								<td><?php echo $mother_salary->di_txt;?></td>
								<td></td>
								<td><?php echo $mother_study->study_txt;?></td>
								<td><?php echo $call_stu_mother->mother_workplace;?></td>
								<td><?php echo $call_stu_mother->mother_phone;?></td>
								<td><?php echo $ds_FMstatus->family_txt;?></td>

							</tr>					
					
			<?php   }else{
					
					}?>					
					


					
		<?php	} ?>		
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
</div>