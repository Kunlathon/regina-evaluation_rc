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
					filename: 'tab2 ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
					title: 'tab2 ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?>  ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
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
			<div class="panel-heading">tab2 ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?>  ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></div>
			<div class="panel-body">

				<div class="table-responsive">				
					<table class="table datatable-button-html5-columns table-bordered">
						<thead>   
							<tr>
								<th><div>รหัสประจำตัวนักเรียน</div></th>
								<th><div>เลขประจำตัวประชาชน</div></th>
								<th><div>วันเดือนปีเกิด (9/12/2018)</div></th>
								<th><div>สัญชาติ</div></th>
								<th><div>เชื้อชาติ</div></th>
								<th><div>ศาสนา</div></th>
								<th><div>จำนวนพี่น้องรวม</div></th>
								<th><div>มีพี่น้องเรียนสถานศึกษานี้</div></th>
								<th><div>เป็นบุตรคนที่</div></th>
								<th><div>ความผิดปรกติทางร่างกาย</div></th>
								<th><div>ประเภทการมาเรียน</div></th>
								<th><div>ประเภทนักเรียนพิเศษ</div></th>
								<th><div>สีบ้าน</div></th>
								<th><div>จำนวนพี่น้องร่วมบิดามารดา</div></th>
								<th><div>จำนวนพี่น้องต่างบิดามารดา</div></th>
								<th><div>การเดินทางมาโรงเรียน ( 1 = เดิน,2 = ผู้ปกครองมาส่ง , 3 = รถรับส่งนักเรียน ,4 = รถประจำทาง)</div></th>
								<th><div>พาหนะ ( 1 = รถจักรยาน,2 = รถจักรยานยนต์ , 3 = รถยนต์ส่วนตัว ,4 = รถไฟ)</div></th>
								<th><div>เวลาในการเดินทาง ชั่วโมง ระบุ ตัวเลข</div></th>
								<th><div>เวลาในการเดินทาง นาที ระบุ ตัวเลข</div></th>



  	   	  	  	   	   	   	   	  	  	  								

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
						$print_home="ฟ้า";
					}elseif($sturcroom_rom["rse_home"]==2){
						$print_home="แดง";
					}elseif($sturcroom_rom["rse_home"]==3){
						$print_home="เหลือง";
					}elseif($sturcroom_rom["rse_home"]==4){
						$print_home="เขียว";
					}else{
						$print_home="";
					}
					
				?>						
					
<!------------------------------------------------------------------------------>
				<?php
				//data_student
					$call_data_student=new data_student($rsd_studentid);
				//depend_stu
					$call_depend_stu=new depend_stu($rsd_studentid);	
							
				//stu_physical
					$stu_physical=new data_disabled($call_data_student->stu_physical);		
				//Religion	
					$IDReligion=new rc_religion($call_data_student->IDReligion);							
				?>			

				<?php
					if($call_depend_stu->ds_trip==1){
						$print_goA=1;
						$print_goB="";
					}elseif($call_depend_stu->ds_trip==2){
						$print_goA=2;
						$print_goB="";						
					}elseif($call_depend_stu->ds_trip==3){
						$print_goA=3;
						$print_goB="";						
					}elseif($call_depend_stu->ds_trip==4){
						$print_goA=4;
						$print_goB="";						
					}elseif($call_depend_stu->ds_trip==5){
						$print_goA=5;
						$print_goB=1;						
					}elseif($call_depend_stu->ds_trip==6){
						$print_goA=5;
						$print_goB=3;						
					}else{
						$print_goA="";
						$print_goB="";						
					}
				
				?>

				
<!------------------------------------------------------------------------------>					
					
					
					
							<tr>

								<td><div><?php echo $rsd_studentid;?></div></td>
								<td><div><?php echo $rsd_Identification;?></div></td>
			<?php
					if($call_data_student->stu_birth==""){ ?>
								<td style="background-color: #D2F2DC"><div></div></td>					
			<?php	}else{ ?>
								<td style="background-color: #D2F2DC"><div><?php echo date("d/m/Y",strtotime($call_data_student->stu_birth));?></div></td>	
			<?php	} ?>
								<td><div></div></td>
								<td><div></div></td>
								<td><div><?php echo $IDReligion->Religion;?></div></td>
								<td><div><?php echo $call_data_student->stu_brethren;?></div></td>
								<td><div><?php echo $call_data_student->stu_brethreS;?></div></td>
								<td><div><?php echo $call_data_student->stu_child;?></div></td>
								<td><div><?php echo $stu_physical->disabled_txt;?></div></td>
								<td><div></div></td>
								<td><div></div></td>
								<td><div><?php echo $print_home;?></div></td>
								<td><div></div></td>
								<td><div></div></td>
								<td><div><?php echo $print_goA;?></div></td>
								<td><div><?php echo $print_goB;?></div></td>
								<td><div></div></td>
								<td><div></div></td>
							</tr>

					
		<?php	} ?>		
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
</div>