<?php
	include("../../../../database/database_evaluation.php");
	include("../../../../database/pdo_data.php");
	//include("../../../../database/class_admin.php");
	include("../../../../database/class_pdo.php");
	
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
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
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
					filename: 'รายชื่อนักเรียน  ชั้น <?php echo $txt_level->set_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?> นักเรียนไม่ลงเรียนเสริมนอกตารางเรียน',
					title: 'รายชื่อนักเรียน  ชั้น <?php echo $txt_level->set_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?> นักเรียนไม่ลงเรียนเสริมนอกตารางเรียน',
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
			<div class="panel-heading">รายชื่อนักเรียน  ชั้น <?php echo $txt_level->set_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></div>
			<div class="panel-body">

				<div class="table-responsive">				
					<table class="table datatable-button-html5-columns table-bordered">
						<thead>   
							<tr>
								<th colspan="10"><center>รายชื่อนักเรียน  ชั้น <?php echo $txt_level->set_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?> นักเรียนไม่ลงเรียนเสริมนอกตารางเรียน</center></th>
							</tr>
							<tr>
								<th>ลำดับ</th>
								<th>รหัสนักเรียน</th>
								<!--<th>รหัสประจำตัวประชาชน</th>-->
								<th>ชื่อ - สกุล </th>
								<th>แผนการเรียน</th>	
								<th>หมายเหตุ</th>
							</tr>
						</thead>
						<tbody>
	
			<?php			
				$data_sturcroom=new data_sturoom($txt_t,$txt_y,$txt_class,$txt_room);	
				$count_stu=0;
				foreach($data_sturcroom->printdata_sturoom as $rc_key=>$sturcroom_rom){ 
					$rsc_num=$sturcroom_rom["rsc_num"];
					$rsd_studentid=$sturcroom_rom["rsd_studentid"];
					$rsd_Identification=$sturcroom_rom["rsd_Identification"];
					$data_prefix=new print_prefix($rsd_prefix=$sturcroom_rom["rsd_prefix"]);
					$data_plan=new print_plan($rsc_plan=$sturcroom_rom["rsc_plan"]);
					
					$name_th=$data_prefix->prefix_prefix_SName." ".$sturcroom_rom["rsd_name"]." ".$sturcroom_rom["rsd_surname"];
					$name_en="Miss ".$sturcroom_rom["rsd_nameEn"]." ".$sturcroom_rom["rsd_surnameEn"];
				?> 
<!--***************************************************************************************************************************-->				
			<?php
				$count_supplementary_notstudySql="SELECT count(`notstudy_stu`) as `countnotstu` FROM `supplementary_notstudy` 
												  WHERE `notstudy_stu`='{$rsd_studentid}' 
												  and `notstudy_t`='{$txt_t}'
												  and `notstudy_l`='{$txt_level->set_IDLevel}' 
												  and `notstudy_y`='{$txt_y}'";
				$count_supplementary_notstudyRs=new notrow_evaluation($count_supplementary_notstudySql);
				foreach($count_supplementary_notstudyRs->evaluation_array as $rc_key=>$count_supplementary_notstudyRow){
					$countnotstu=$count_supplementary_notstudyRow["countnotstu"];
					if($countnotstu>=1){ 
					$count_stu=$count_stu+1;?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
							<tr>	
								<td><?php echo $count_stu;?></td>
								<td><?php echo $rsd_studentid;?></td>
								<!--<td><?php //echo $rsd_Identification;?></td>-->
								<td><?php echo $name_th;?></td>
								<td><?php echo $data_plan->plan_Name;?></td>
								<td></td>
							</tr>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}else{
						
					}
				}
			?>	
<!--***************************************************************************************************************************-->							
			<?php	} ?>			
		
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
</div>