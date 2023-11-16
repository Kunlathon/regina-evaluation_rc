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
					filename: 'tab7  ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
					title: 'tab7  ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?>  ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
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
			<div class="panel-heading">tab7 ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?>  ปีการศึกษา <?php echo $txt_y;?></div>
			<div class="panel-body">

				<div class="table-responsive">				
					<table class="table datatable-button-html5-columns table-bordered">
						<thead>   
							<tr>
								<th><div>รหัสประจำตัวนักเรียน</div></th>
								<th><div>สถานะการเรียน</div></th>
								<th><div>ประเภทการจำหน่าย (1 = กำลังศึกษา , 2 = จำหน่าย)</div></th>
								<th><div>จำหน่ายเมื่อ 29/12/2018</div></th>
								<th><div>สาเหตุ</div></th>
								<th><div>ชื่อสถานศึกษาเดิม</div></th>
								<th><div>ชั้นที่จบ (ป.6)</div></th>
								<th><div>จังหวัด</div></th>	  	
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
					$nickEn=ucwords($nickEn);
					
					$data_prefix=new print_prefix($rsd_prefix=$sturcroom_rom["rsd_prefix"]);
					$data_plan=new print_plan($rsc_plan=$sturcroom_rom["rsc_plan"]);
					
					$name_th=$data_prefix->prefix_prefix_SName."&nbsp;".$sturcroom_rom["rsd_name"]."&nbsp;".$sturcroom_rom["rsd_surname"];
					
					$name_en=strtolower("Miss&nbsp;".$sturcroom_rom["rsd_nameEn"]."&nbsp;".$sturcroom_rom["rsd_surnameEn"]);
					$name_en=ucwords($name_en);
					
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

				
					
					$print_student=new data_student($rsd_studentid);
					
					
					$call_ds_OriginalClass=new print_level($print_student->ds_OriginalClass);
					
					$call_province=new data_Province($print_student->ds_ProvinceSchool);
					
					
				?>				
					
					
					
							<tr>
							
								<td><div><?php echo $rsd_studentid;?></div></td>
								<td><div></div></td>
								<td><div></div></td>
								<td><div></div></td>
								<td><div></div></td>
								
								<td><div><?php echo $print_student->ds_SameSchool;?></div></td>
								<td><div><?php echo $call_ds_OriginalClass->set_Sort_name;?></div></td>
								<td><div><?php echo $call_province->PROVINCE_NAME;?></div></td>
								
							</tr>

					
		<?php	} ?>		
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
</div>