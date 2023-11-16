<?php
	include("../../../../database/database_evaluation.php");
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
					filename: 'รายชื่อนักเรียน  ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
					title: 'รายชื่อนักเรียน  ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
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
			<div class="panel-heading">รายชื่อนักเรียน  ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></div>
			<div class="panel-body">

				<div class="table-responsive">				
					<table class="table datatable-button-html5-columns table-bordered">
						<thead>   
							<tr>
								<th colspan="12"><center>รายชื่อนักเรียน  ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></center></th>
							</tr>
							<tr>
								<th><div>เลขที่</div></th>
								<th><div>รหัสนักเรียน</div></th>
								<th><div>รหัสประจำตัวประชาชน</div></th>
								<th><div>ชื่อ&nbsp;-&nbsp;สกุล&nbsp;ภาษาไทย</div></th>
								<th><div>ชื่อ&nbsp;-&nbsp;สกุล&nbsp;ภาษาอังกฤษ</div></th>
								<th><div>แผนการเรียน</div></th>
								<th><div>สีบ้าน</div></th>
								<th><div>&nbsp;</div></th>
								<th><div>&nbsp;</div></th>
								<th><div>&nbsp;</div></th>
								<th><div>&nbsp;</div></th>
								<th><div>หมายเหตุ</div></th>
							</tr>
						</thead>
						<tbody>
	
			<?php			
				$data_sturcroom=new data_sturoom($txt_t,$txt_y,$txt_class,$txt_room);	
				foreach($data_sturcroom->printdata_sturoom as $rc_key=>$sturcroom_rom){ 
					$rsc_num=$sturcroom_rom["rsc_num"];
					$rsd_studentid=$sturcroom_rom["rsd_studentid"];
					$rsd_Identification=$sturcroom_rom["rsd_Identification"];
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
					
					
					$StatusName=$sturcroom_rom["StatusName"];
					$IDStatus=$sturcroom_rom["IDStatus"];
					
				?>
				
		<?php
				if($sturcroom_rom["rsc_txt"]=="new"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
				<?php
					//$call_regina_stu_data=new regina_stu_class();
					if($sturcroom_rom["rsc_status"]==1 or $sturcroom_rom["rsc_status"]==0 or $sturcroom_rom["rsc_status"]==""){ ?>
							<tr>
								<td><div><?php echo $rsc_num;?></div></td>
								<td><div><?php echo $rsd_studentid;?></div></td>
								<td><div><?php echo $rsd_Identification;?></div></td>
								<td><div><?php echo $name_th;?></div></td>
								<td><div><?php echo ucwords($name_en);?></div></td>
								<td><div><?php echo $data_plan->plan_Name;?></div></td>
								<td><div><?php echo $print_home;?></div></td>
								<td><div>&nbsp;</div></td>
								<td><div>&nbsp;</div></td>
								<td><div>&nbsp;</div></td>
								<td><div>&nbsp;</div></td>
								<td><div>นักเรียนใหม่</div></td>
							</tr>						
				<?php	}else{ ?>
							<tr>
								<td><div><?php echo $rsc_num;?></div></td>
								<td><div><?php echo $rsd_studentid;?></div></td>
								<td><div><?php echo $rsd_Identification;?></div></td>
								<td><div><?php echo $name_th;?></div></td>
								<td><div><?php echo ucwords($name_en);?></div></td>
								<td><div><?php echo $data_plan->plan_Name;?></div></td>
								<td><div><?php echo $print_home;?></div></td>
								<td><div>&nbsp;</div></td>
								<td><div>&nbsp;</div></td>
								<td><div>&nbsp;</div></td>
								<td><div>&nbsp;</div></td>
								
				<?php //$call_regina_stu_data=new regina_stu_class($rsd_studentid,$txt_t,$txt_y,$txt_class);?>				
								<!--<td><div><?php //echo $call_regina_stu_data->student_status();?> (นักเรียนใหม่)</div></td>-->		

				<?php
						if($IDStatus=="1"){ ?>
								<td><div></div></td>
				<?php	}else{ ?>
								<td><div><?php echo $StatusName;?></div></td>
				<?php	}?>
								
							</tr>							
				<?php	} ?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
				<?php
					//$call_regina_stu_data=new regina_stu_class();
					if($sturcroom_rom["rsc_status"]==1 or $sturcroom_rom["rsc_status"]==0 or $sturcroom_rom["rsc_status"]==""){ ?>
							<tr>
								<td><div><?php echo $rsc_num;?></div></td>
								<td><div><?php echo $rsd_studentid;?></div></td>
								<td><div><?php echo $rsd_Identification;?></div></td>
								<td><div><?php echo $name_th;?></div></td>
								<td><div><?php echo ucwords($name_en);?></div></td>
								<td><div><?php echo $data_plan->plan_Name;?></div></td>
								<td><div><?php echo $print_home;?></div></td>
								<td><div>&nbsp;</div></td>
								<td><div>&nbsp;</div></td>
								<td><div>&nbsp;</div></td>
								<td><div>&nbsp;</div></td>

				<?php
						if($IDStatus=="1"){ ?>
								<td><div></div></td>
				<?php	}else{ ?>
								<td><div><?php echo $StatusName;?></div></td>
				<?php	}?>								
								
								
							</tr>						
				<?php	}else{ ?>
							<tr>
								<td><div><?php echo $rsc_num;?></div></td>
								<td><div><?php echo $rsd_studentid;?></div></td>
								<td><div><?php echo $rsd_Identification;?></div></td>
								<td><div><?php echo $name_th;?></div></td>
								<td><div><?php echo ucwords($name_en);?></div></td>
								<td><div><?php echo $data_plan->plan_Name;?></div></td>
								<td><div><?php echo $print_home;?></div></td>
								<td><div>&nbsp;</div></td>
								<td><div>&nbsp;</div></td>
								<td><div>&nbsp;</div></td>
								<td><div>&nbsp;</div></td>
				<?php
						if($IDStatus=="1"){ ?>
								<td><div></div></td>
				<?php	}else{ ?>
								<td><div><?php echo $StatusName;?></div></td>
				<?php	}?>
																
							</tr>							
				<?php	} ?>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
		<?php	} ?>
				

				
					
			<?php	} ?>			
		
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
</div>