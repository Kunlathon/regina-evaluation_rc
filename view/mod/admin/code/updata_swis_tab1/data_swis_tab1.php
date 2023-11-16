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
					filename: 'tab1 ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
					title: 'tab1 ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?>  ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
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
			<div class="panel-heading">tab1 ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?>  ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></div>
			<div class="panel-body">

				<div class="table-responsive">				
					<table class="table datatable-button-html5-columns table-bordered">
						<thead>   
							<tr>
								<th><div>รหัสประจำตัวนักเรียน</div></th>
								<th><div>รหัสผ่าน</div></th>
								<th><div>ชื่อ</div></th>
								<th><div>นามสกุล</div></th>
								<th><div>ชื่อเล่น</div></th>
								<th><div>ชื่อ English</div></th>
								<th><div>นามสกุล English</div></th>
								<th><div>เพศ ( ชาย = m หญิง = f )</div></th>
								<th><div>กรุ๊ปเลือด ใช้ตัวอักษรพิมพ์ใหญ่</div></th>
								<th><div>วันที่เข้าเรียน ( 21/07/2018)</div></th>
								<th><div>ปีการศึกษาที่เข้าเรียน (2561)</div></th>
								<th><div>ภาคเรียนที่ เข้าเรียน (1)</div></th>
								<th><div>โรคประจำตัว</div></th>
								<th><div>ชั้นที่เข้าเรียน (ประถมศึกษาปีที่ 1)</div></th>
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
					$rsd_nameTn=$sturcroom_rom["rsd_name"];
					$rsd_surnameTn=$sturcroom_rom["rsd_surname"];
					$rsd_nameEn=$sturcroom_rom["rsd_nameEn"];
					
					$rsd_surnameEn=strtolower($sturcroom_rom["rsd_surnameEn"]);
					$rsd_surnameEn=ucwords($rsd_surnameEn);
					
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
				//data_student
					$call_data_student=new data_student($rsd_studentid);
				//depend_stu
					$call_depend_stu=new depend_stu($rsd_studentid);	
					
				?>				
<!------------------------------------------------------------------------------>					
					
		<?php
			$CheckSaveSwisTime=new CheckSaveSwisTime($rsd_studentid);
				if($CheckSaveSwisTime->RunCheckSaveSwisTime()=="New"){ ?>
				
							<tr>
								<td><div><?php echo $rsd_studentid;?></div></td>
								<td><div></div></td>
								<td><div><?php echo $rsd_nameTn;?></div></td>
								<td><div><?php echo $rsd_surnameTn;?></div></td>
								<td><div><?php echo $nickTh;?></div></td>
								<td><div><?php echo $rsd_nameEn;?></div></td>
								<td><div><?php echo $rsd_surnameEn;?></div></td>
								<td><div>f</div></td>
								<td><div><?php echo $call_data_student->stu_blood;?></div></td>
								<td><div></div></td>
								<td><div></div></td>
								<td><div></div></td>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
					<?php
							if($call_depend_stu->ds_CongenitalDisease==null){ ?>
								<td><div>ไม่มีโรคประจำตัว</div></td>						
					<?php	}elseif($call_depend_stu->ds_CongenitalDisease=="-" or $call_depend_stu->ds_CongenitalDisease=="--"){  ?>
								<td><div>ไม่มีโรคประจำตัว</div></td>						
					<?php	}elseif($call_depend_stu->ds_CongenitalDisease=="ไม่" or $call_depend_stu->ds_CongenitalDisease=="ไม่มี"){   ?>
								<td><div>ไม่มีโรคประจำตัว</div></td>						
					<?php	}else{  ?>
								<td><div><?php echo $call_depend_stu->ds_CongenitalDisease;?></div></td>						
					<?php	} ?>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<td><div></div></td>
							</tr>
				
		<?php	}else{
					
				}
		?>			
					


					
		<?php	} ?>		
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
</div>

