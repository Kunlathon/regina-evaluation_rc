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
					filename: 'รายชื่อนักเรียน  ชั้น <?php echo $txt_level->set_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?> ลงทะเบียนเรียนเสริมนอกตารางเรียน',
					title: 'รายชื่อนักเรียน  ชั้น <?php echo $txt_level->set_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?> ลงทะเบียนเรียนเสริมนอกตารางเรียน',
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
								<th colspan="10"><center>รายชื่อนักเรียน  ชั้น <?php echo $txt_level->set_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?> ลงทะเบียนเรียนเสริมนอกตารางเรียน</center></th>
							</tr>
							<tr>
								<th>ลำดับ</th>
								<th>รหัสนักเรียน</th>
								<!--<th>รหัสประจำตัวประชาชน</th>-->
								<th>ชื่อ - สกุล </th>
								<th>แผนการเรียน</th>

		<?php
				$print_supp_day=new supplementary_day();
				if($print_supp_day->sd_mon=="ON"){ ?>
							<th>วันจันทร์</th>
		<?php	}elseif($print_supp_day->sd_mon=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}      ?>
					
		<?php	if($print_supp_day->sd_tue=="ON"){ ?>
							<th>วันอังคาร</th>
		<?php	}elseif($print_supp_day->sd_tue=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}	   ?>				
					
		<?php	if($print_supp_day->sd_wed=="ON"){ ?>
							<th>วันพุธ</th>
		<?php	}elseif($print_supp_day->sd_wed=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}	   ?>					
					
		<?php	if($print_supp_day->sd_thu=="ON"){?>
							<th>วันพฤหัสบดี</th>
		<?php	}elseif($print_supp_day->sd_thu=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>					
				
		<?php	if($print_supp_day->sd_frl=="ON"){?>
							<th>วันศุกร์</th>
		<?php	}elseif($print_supp_day->sd_frl=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>					
					
		<?php	if($print_supp_day->sd_sat=="ON"){?>
							<th>วันเสาร์</th>
		<?php	}elseif($print_supp_day->sd_sat=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>

		<?php	if($print_supp_day->sd_sun=="ON"){?>
							<th>วันอาทิตย์</th>
		<?php	}elseif($print_supp_day->sd_sun=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>	
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
				$count_supplementary_stursSql="SELECT count(`sup_stuid`) as `count_stuid` 
											   FROM `supplementary_sturs` 
											   WHERE `sup_stuid`='{$rsd_studentid}' and `sup_t` ='{$txt_t}' and `sup_l` ='{$txt_level->set_IDLevel}' and `sup_year`='{$txt_y}';";
				$count_supplementary_sturs=new notrow_evaluation($count_supplementary_stursSql);
				foreach($count_supplementary_sturs->evaluation_array as $rc_key=>$count_supplementary_sturom){ 
					$count_stuid=$count_supplementary_sturom["count_stuid"];
					if($count_stuid>=1){
					$count_stu=$count_stu+1;?>
<!--***************************************************************************************************************************-->		
							<tr>
								<td><?php echo $count_stu;?></td>
								<td><?php echo $rsd_studentid;?></td>
								<!--<td><?php //echo $rsd_Identification;?></td>-->
								<td><?php echo $name_th;?></td>
								<td><?php echo $data_plan->plan_Name;?></td>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				$print_supp_day=new supplementary_day();
				if($print_supp_day->sd_mon=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$print_subjectSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_txtth`
						       from `supplementary_sturs` join `supplementary_subject` on (`supplementary_sturs`.`ss_id`=`supplementary_subject`.`ss_id`)
			                   where  `supplementary_sturs`.`sup_stuid`='{$rsd_studentid}' 
							   and `supplementary_sturs`.`sup_t`='{$txt_t}' 
							   and `supplementary_sturs`.`sup_l`='{$txt_level->set_IDLevel}' 
							   and  `supplementary_sturs`.`sup_year`='{$txt_y}' 
							   and `supplementary_sturs`.`ss_mon`='1';";
			$print_subjectRs=new notrow_evaluation($print_subjectSql);
			foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectrom){ 
				$print_ss_id=$print_subjectrom["ss_id"];
				$print_ss_txtth=$print_subjectrom["ss_txtth"];
			?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td><?php echo $print_ss_txtth;?></td>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_mon=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}      ?>
					
		<?php	if($print_supp_day->sd_tue=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$print_subjectSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_txtth`
						       from `supplementary_sturs` join `supplementary_subject` on (`supplementary_sturs`.`ss_id`=`supplementary_subject`.`ss_id`)
			                   where  `supplementary_sturs`.`sup_stuid`='{$rsd_studentid}' 
							   and `supplementary_sturs`.`sup_t`='{$txt_t}' 
							   and `supplementary_sturs`.`sup_l`='{$txt_level->set_IDLevel}' 
							   and  `supplementary_sturs`.`sup_year`='{$txt_y}' 
							   and `supplementary_sturs`.`ss_tues`='1'";
			$print_subjectRs=new notrow_evaluation($print_subjectSql);
			foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectrom){ 
				$print_ss_id=$print_subjectrom["ss_id"];
				$print_ss_txtth=$print_subjectrom["ss_txtth"];
			?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td><?php echo $print_ss_txtth;?></td>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_tue=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}	   ?>				
					
		<?php	if($print_supp_day->sd_wed=="ON"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$print_subjectSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_txtth`
						       from `supplementary_sturs` join `supplementary_subject` on (`supplementary_sturs`.`ss_id`=`supplementary_subject`.`ss_id`)
			                   where  `supplementary_sturs`.`sup_stuid`='{$rsd_studentid}' 
							   and `supplementary_sturs`.`sup_t`='{$txt_t}' 
							   and `supplementary_sturs`.`sup_l`='{$txt_level->set_IDLevel}' 
							   and  `supplementary_sturs`.`sup_year`='{$txt_y}' 
							   and `supplementary_sturs`.`ss_wedne`='1'";
			$print_subjectRs=new notrow_evaluation($print_subjectSql);
			foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectrom){ 
				$print_ss_id=$print_subjectrom["ss_id"];
				$print_ss_txtth=$print_subjectrom["ss_txtth"];
			?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td><?php echo $print_ss_txtth;?></td>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_wed=="OFF"){ ?>
						
		<?php	}else{ ?>
						
		<?php	}	   ?>					
					
		<?php	if($print_supp_day->sd_thu=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$print_subjectSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_txtth`
						       from `supplementary_sturs` join `supplementary_subject` on (`supplementary_sturs`.`ss_id`=`supplementary_subject`.`ss_id`)
			                   where  `supplementary_sturs`.`sup_stuid`='{$rsd_studentid}' 
							   and `supplementary_sturs`.`sup_t`='{$txt_t}' 
							   and `supplementary_sturs`.`sup_l`='{$txt_level->set_IDLevel}' 
							   and  `supplementary_sturs`.`sup_year`='{$txt_y}' 
							   and `supplementary_sturs`.`ss_thurs`='1';";
			$print_subjectRs=new notrow_evaluation($print_subjectSql);
			foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectrom){ 
				$print_ss_id=$print_subjectrom["ss_id"];
				$print_ss_txtth=$print_subjectrom["ss_txtth"];
			?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td><?php echo $print_ss_txtth;?></td>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_thu=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>					
				
		<?php	if($print_supp_day->sd_frl=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$print_subjectSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_txtth`
						       from `supplementary_sturs` join `supplementary_subject` on (`supplementary_sturs`.`ss_id`=`supplementary_subject`.`ss_id`)
			                   where  `supplementary_sturs`.`sup_stuid`='{$rsd_studentid}' 
							   and `supplementary_sturs`.`sup_t`='{$txt_t}' 
							   and `supplementary_sturs`.`sup_l`='{$txt_level->set_IDLevel}' 
							   and  `supplementary_sturs`.`sup_year`='{$txt_y}' 
							   and  `supplementary_sturs`.`ss_fri`='1';";
			$print_subjectRs=new notrow_evaluation($print_subjectSql);
			foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectrom){ 
				$print_ss_id=$print_subjectrom["ss_id"];
				$print_ss_txtth=$print_subjectrom["ss_txtth"];
			?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td><?php echo $print_ss_txtth;?></td>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_frl=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>					
					
		<?php	if($print_supp_day->sd_sat=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$print_subjectSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_txtth`
						       from `supplementary_sturs` join `supplementary_subject` on (`supplementary_sturs`.`ss_id`=`supplementary_subject`.`ss_id`)
			                   where  `supplementary_sturs`.`sup_stuid`='{$rsd_studentid}' 
							   and `supplementary_sturs`.`sup_t`='{$txt_t}' 
							   and `supplementary_sturs`.`sup_l`='{$txt_level->set_IDLevel}' 
							   and  `supplementary_sturs`.`sup_year`='{$txt_y}' 
							   and  `supplementary_sturs`.`ss_satur`='1';";
			$print_subjectRs=new notrow_evaluation($print_subjectSql);
			foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectrom){ 
				$print_ss_id=$print_subjectrom["ss_id"];
				$print_ss_txtth=$print_subjectrom["ss_txtth"];
			?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td><?php echo $print_ss_txtth;?></td>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_sat=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>

		<?php	if($print_supp_day->sd_sun=="ON"){?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$print_subjectSql="select `supplementary_subject`.`ss_id`,`supplementary_subject`.`ss_txtth`
						       from `supplementary_sturs` join `supplementary_subject` on (`supplementary_sturs`.`ss_id`=`supplementary_subject`.`ss_id`)
			                   where  `supplementary_sturs`.`sup_stuid`='{$rsd_studentid}' 
							   and `supplementary_sturs`.`sup_t`='{$txt_t}' 
							   and `supplementary_sturs`.`sup_l`='{$txt_level->set_IDLevel}' 
							   and  `supplementary_sturs`.`sup_year`='{$txt_y}'  
							   and `supplementary_sturs`.`ss_sun`='1';";
			$print_subjectRs=new notrow_evaluation($print_subjectSql);
			foreach($print_subjectRs->evaluation_array as $rc_key=>$print_subjectrom){ 
				$print_ss_id=$print_subjectrom["ss_id"];
				$print_ss_txtth=$print_subjectrom["ss_txtth"];
			?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td><?php echo $print_ss_txtth;?></td>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}elseif($print_supp_day->sd_sun=="OFF"){?>
						
		<?php	}else{?>
						
		<?php	}	  ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<td></td>
							</tr>					
<!--***************************************************************************************************************************-->							
			<?php	}else{ ?>
<!--***************************************************************************************************************************-->		
					
<!--***************************************************************************************************************************-->							
			<?php	}
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