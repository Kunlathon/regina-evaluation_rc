<?php
	include("../../../../database/pdo_data.php");//--------------------------------
	include("../../../../database/class_admin.php");//-----------------------------
//---------------------------------------------------------------------------------
	include("../../../../database/pdo_health.php");//------------------------------
	include("../../../../database/class_health.php");//----------------------------
//---------------------------------------------------------------------------------	
	$txt_term=filter_input(INPUT_POST,'txt_term');//-------------------------------
	$txt_year=filter_input(INPUT_POST,'txt_year');//-------------------------------
//---------------------------------------------------------------------------------	
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
					filename: 'ข้อมูลการตรวจสุขภาพนักเรียน อัพโหลด ระบบ SWIS Plus ข้อมูลชุดที่ 1',
					title: 'ข้อมูลการตรวจสุขภาพนักเรียน อัพโหลด ระบบ SWIS Plus ข้อมูลชุดที่ 1',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    className: 'btn btn-default',
					filename: 'ข้อมูลการตรวจสุขภาพนักเรียน อัพโหลด ระบบ SWIS Plus ข้อมูลชุดที่ 1',
					title: 'ข้อมูลการตรวจสุขภาพนักเรียน อัพโหลด ระบบ SWIS Plus ข้อมูลชุดที่ 1',
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
				"paging"       : true,
				"lengthChange" : true,
				"searching"    : true,
				"ordering"     : true,
				"info"         : false,
				"autoWidth"    : false,
				"lengthMenu"   :[[40,60,80,100,-1],[40,60,80,100,"ทั้งหมด"]],
				
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
<?php
		if(isset($txt_term,$txt_year)){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-default">
				<div class="panel-heading">Panel Heading</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table datatable-button-html5-columns table-bordered">
							<thead>
								<tr>
									<th><div>รหัสประจำตัวนักเรียน</div></th>
									<th><div>น้ำหนัก</div></th>
									<th><div>ส่วนสูง</div></th>
									<th><div>รอบศรีษะ</div></th>
									<th><div>ภาวะโภชนาการ</div></th>
									<th><div>ตรวจตา(การมองเห็น)</div></th>
									<th><div>ตรวจหู (การได้ยิน)</div></th>
									<th><div>ตรวจคอพอก</div></th>
									<th><div>ตรวจโลหิตจาง</div></th>
									<th><div>วันที่ตรวจ (05/09/2563)</div></th>
								</tr>
							</thead>
							<tbody>
								
						<?php
								$run_health_sud=new print_health_sud($txt_term,$txt_year);
								foreach($run_health_sud->call_health_sudarray() as $rc=>$run_health_sudRow){ ?>
								<tr>
									<td><div><?php echo $run_health_sudRow["hs_key"];?></div></td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
						<?php
							$run_count=0;
							$run_health=array('2','3','0','7','0','0','0','0');							
							while($run_count<8){ 
								$print_runH=$run_health[$run_count];
									if($print_runH=="0"){ ?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
									<td><div>-</div></td>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php		}else{ 
										$echo_health=new print_health_notrow($txt_term,$txt_year,$run_health_sudRow["hs_class"],$print_runH,$run_health_sudRow["hs_key"]);?>	
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<?php
										if($print_runH=="2" or $print_runH=="3"){ ?>
									<td><div><?php echo number_format($echo_health->print_hlhhs_txt,1);?></div></td>	
								<?php	}else{ ?>
									<td><div><?php echo $echo_health->print_hlhhs_txt;?></div></td>									
								<?php	}      ?>			
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->															
						<?php			
									}
								$run_count=$run_count+1;
							}
						?>
						<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			

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
	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php	}  ?>


