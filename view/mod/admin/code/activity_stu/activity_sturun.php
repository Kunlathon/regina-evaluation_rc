<?php
	include("../../../../database/database_evaluation.php");
	
	include("../../../../database/pdo_conndatastu.php");
	include("../../../../database/class_pdodatastu.php");
	
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");

	

	
	include("../../../../database/database_paynew.php");
	include("../../../../database/class_pay.php");
	
	include("../../../../database/pdo_activity.php");
	include("../../../../database/class_activity.php");
	
	$txt_year=post_data(filter_input(INPUT_POST,'txt_year'));
	$txt_classA=post_data(filter_input(INPUT_POST,'txt_classA'));
	$txt_classB=post_data(filter_input(INPUT_POST,'txt_classB'));
	$txt_classTxt=post_data(filter_input(INPUT_POST,'txt_classTxt'));
	
	$txt_t=substr($txt_year,0,1);
	$txt_y=substr($txt_year,2,4);


	/*$txt_level=new print_level($txt_class);
	
	if($txt_class=="21"){
		$print_l="ประถมศึกษาปีที่ 4";			
	}elseif($txt_class=="22"){
		$print_l="ประถมศึกษาปีที่ 5";			
	}elseif($txt_class=="23"){
		$print_l="ประถมศึกษาปีที่ 6";			
	}elseif($txt_class=="31"){
		$print_l="มัธยมศึกษาปีที่ 1";	
	}elseif($txt_class=="32"){
		$print_l="มัธยมศึกษาปีที่ 2";
	}elseif($txt_class=="33"){
		$print_l="มัธยมศึกษาปีที่ 3";
	}elseif($txt_class=="41"){
		$print_l="มัธยมศึกษาปีที่ 4";
	}elseif($txt_class=="42"){
		$print_l="มัธยมศึกษาปีที่ 5";
	}elseif($txt_class=="43"){
		$print_l="มัธยมศึกษาปีที่ 6";
	}else{
		$print_l="";
	}*/
	
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

	<script>
		$(document).ready(function(){
	
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
    $('#datatable-button-html5-columns').DataTable({
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
					filename: 'รายชื่อนักเรียนไม่ลงทะเบียน กิจกรรมชุมนุม ระดับชั้น <?php echo $txt_classTxt;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
					title: 'รายชื่อนักเรียนไม่ลงทะเบียน กิจกรรมชุมนุม ระดับชั้น <?php echo $txt_classTxt;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
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
				"info"         : true,
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
			<div class="panel-heading">ข้อมูลนักเรียนไม่ลงทะเบียนกิจกรรม <?php echo $print_l;?></div>
			<div class="panel-body">
				
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						
						<div class="panel panel-default">
							<div class="panel-heading" style="color: #0642FA"><h4><center>รายชื่อนักเรียนไม่ลงทะเบียน กิจกรรมชุมนุม ระดับชั้น <?php echo $txt_classTxt;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></center></h4></div>
							<div class="panel-body">
							
							<div class="col-<?php echo $grid;?>-12">
							
								<div class="table-responsive">
									<table class="table table-bordered" id="datatable-button-html5-columns">
										<thead>
										  <tr>
											<th><div>ลำดับ</div></th>
											<th><div>เลขประจำตัวนักเรียน</div></th>
											<th><div>ชื่อ-สกุล</div></th>
											<th><div>ชั้น</div></th>
											<th><div>เลขที่</div></th>
										  </tr>
										</thead>
										<tbody>

<?php
	$run_classA=$txt_classA;
	$run_classB=$txt_classB;
	$as_count=0;
	while($run_classA<=$run_classB){ 
		$txt_level=new print_level($run_classA);
	?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	
					<?php			
						$data_sturcroom=new data_stuclass($txt_t,$txt_y,$run_classA);	
						foreach($data_sturcroom->printdata_stuclass as $rc_key=>$sturcroom_rom){ 
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
						?>
						

		<!--************************************************************************************************-->	
							<?php
								$count_SturcActivity=new sturc_activity($rsd_studentid,$txt_t,$txt_y);
								$count_SA=0;
								foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
									$count_SA=$count_SA+1;
								}
									if($count_SA>=1){
										//*************************************************************************
									}else{
										$as_count=$as_count+1;
										?>
		<!--************************************************************************************************-->			
									<?php
										//$call_regina_stu_data=new regina_stu_class();
										if($sturcroom_rom["rsc_status"]==1 or $sturcroom_rom["rsc_status"]==0 or $sturcroom_rom["rsc_status"]==""){ ?>
												<tr>
													<td><?php echo $as_count;?></td>
													<td><?php echo $rsd_studentid;?></td>
													<td><?php echo $name_th;?></td>
													<td><?php echo $txt_level->level_Sort_name;?></td>
													<td><?php echo $rsc_num;?></td>
												</tr>						
									<?php	}else{ ?>
												<tr>
													<td><?php echo $as_count;?></td>
													<td><?php echo $rsd_studentid;?></td>
													<td><?php echo $name_th;?></td>
													<td><?php echo $txt_level->level_Sort_name;?></td>
													<td><?php echo $rsc_num;?></td>
							
												</tr>							
									<?php	} ?>
		<!--************************************************************************************************-->									
							<?php	}?>
				
		<!--************************************************************************************************-->											
					<?php	} ?>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php		
		$run_classA=$run_classA+1;
	}
?>										  
	
										  
	

										</tbody>
									</table>
								</div>
							
							
							
							</div>							
							
							</div>
						</div>
					
					</div>
				</div>
			
			
			
			



			</div>
		</div>		
	</div>
</div>

