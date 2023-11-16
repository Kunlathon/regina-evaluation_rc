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
	
	
//--------------------------------------------------------------------    
    include("../../../../img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
	
	
	$txt_year=post_data(filter_input(INPUT_POST,'txt_year'));
	$txt_class=post_data(filter_input(INPUT_POST,'txt_class'));
	//$txt_room=post_data(filter_input(INPUT_POST,'txt_room'));
	
	$txt_t=substr($txt_year,0,1);
	$txt_y=substr($txt_year,2,4);




	//$txt_level=new print_level($txt_class);
	
	if($txt_class==21){
		$print_l="ประถมศึกษาปีที่ 4";	
	}elseif($txt_class==22){
		$print_l="ประถมศึกษาปีที่ 5";	
	}elseif($txt_class==23){
		$print_l="ประถมศึกษาปีที่ 6";	
	}elseif($txt_class==31){
		$print_l="มัธยมศึกษาปีที่ 1";	
	}elseif($txt_class==32){
		$print_l="มัธยมศึกษาปีที่ 2";
	}elseif($txt_class==33){
		$print_l="มัธยมศึกษาปีที่ 3";
	}elseif($txt_class==93){
		$print_l="มัธยมศึกษา ตอนต้น";
	}elseif($txt_class==41){
		$print_l="มัธยมศึกษาปีที่ 4";
	}elseif($txt_class==42){
		$print_l="มัธยมศึกษาปีที่ 5";	
	}elseif($txt_class==43){
		$print_l="มัธยมศึกษาปีที่ 6";	
	}elseif($txt_class==94){
		$print_l="มัธยมศึกษา ตอนปลาย";	
	}else{
		$print_l="";
	}
	
?>
<!--****************************************************************************-->			
<style>
.RuningLoad {
	display:none;
}
</style>

<script>
	$(function() {
		$(".RunLoad").fadeOut(5000, function() {
			$(".RuningLoad").fadeIn(4000);
		});
	});
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
		<div class="RunLoad">
		  <center><img class="img-thumbnail" src="Template/global_assets/images/Cube-1s-200px.gif"></center>
		</div>	
	</div>
</div>

<div class="row RuningLoad">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading">ข้อมูลนักเรียนลงทะเบียนกิจกรรม <?php echo $print_l;?></div>
			<div class="panel-body">

																									<div class="row">
																										<div class="col-<?php echo $grid;?>-12">	
																											<div class="panel panel-default">
																												<div class="panel-heading" style="color: #0642FA"><h4><center>รายชื่อกิจกรรมส่งเสริมศักยภาพ</center></h4></div>
																												<div class="panel-body">
																													
																																												<div class="row">
																										<?php
																											$call_activityRc=new activityRc2($txt_class,$txt_t,$txt_y);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																										?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
																																									<?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$txt_t,$txt_y);
																																									?>
																																									
																																															
						
									
																													                                                 <?php
																																											if($hr_arc%4==0){ ?>
																																												</div><br>
																																												<div class="row">
																																													<div class="col-<?php echo $grid;?>-3">
																																														<a id="Btn_activity<?php echo $hr_arc;?>" data-toggle="tooltip" title="<?php echo $call_activityRow["activity_txt"];?>"><div class="panel panel-body" style="background-color: #02FAF0">
																																															<div class="media">
																																																<div class="media-left">
																																																	<i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
																																																</div>

																																															<div class="media-body">
																																																<font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
																																																	<div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
																																																	<div><?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?></div>
																																																</font>
																																															</div>
																																															</div>
																																														</div></a>	
																																													</div>
		
																																									 <?php	}else{ ?>
																																												
																																													<div class="col-<?php echo $grid;?>-3">
																																														<a id="Btn_activity<?php echo $hr_arc;?>" data-toggle="tooltip" title="<?php echo $call_activityRow["activity_txt"];?>"><div class="panel panel-body" style="background-color: #02FAF0">
																																															<div class="media">
																																																<div class="media-left">
																																																	<i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
																																																</div>

																																															<div class="media-body">
																																																<font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
																																																	<div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
																																																	<div><?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?></div>
																																																</font>
																																															</div>
																																															</div>
																																														</div></a>	
																																													</div>
																																												
																																									 <?php	}?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																																										 
	<!-- Modal -->
		<div class="modal fade-lg" id="Modal_activity<?php echo $hr_arc;?>" role="dialog">
			<div class="modal-dialog modal-lg">
<!--activity_taacher ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php 
			$teacher_activity=new activity_taacher($call_activityRow["activity_key"],$txt_t,$txt_y);
			$activity_teacher=new print_teacher($teacher_activity->taacher_keyrc());
		?>		
<!--activity_taacher End ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						
						<h4 class="modal-title">กิจกรรมส่งเสริมศักย์ภาพ&nbsp;/&nbsp;กิจกรรมชุมนุม : <?php echo $call_activityRow["activity_txt"];?></h4>
						
	<?php 
		if($txt_class>=11 and $txt_class<=23){
			$teacher_activity=new activity_taacher($call_activityRow["activity_key"],$txt_t,$txt_y);
			$activity_adviser=new print_teacher_rc($teacher_activity->taacher_keyrc());
			

		}elseif($txt_class>=31 and $txt_class<=43){
			$teacher_activity=new activity_taacher($call_activityRow["activity_key"],$txt_t,$txt_y);
			$activity_adviser=new regina_stu_data($teacher_activity->taacher_keyrc());
			
		}else{
			//--------------------------------------	
		}
	?>							
						
	<?php
			if($txt_class>=11 and $txt_class<=23){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
						<h4 class="modal-title">ครูชุมนุม&nbsp;:&nbsp;<?php echo $activity_adviser->teacherRC_nameTh();?></h4>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}elseif($txt_class>=31 and $txt_class<=43){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
						<h4 class="modal-title">ประธานชุมนุม&nbsp;:&nbsp;<?php echo "นางสาว&nbsp;".$activity_adviser->rsd_name."&nbsp;".$activity_adviser->rsd_surname;?></h4>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}	   ?>						
						<hr><center><button type="button" data-dismiss="modal" class="btn btn-default">ปิด</button></center>
						
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-<?php echo $grid;?>-12">
							
								<div class="table-responsive">
									<table class="table table-bordered" id="datatable-button-html5-columns<?php echo $hr_arc;?>">
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
										  
												$activity_sturc=new print_stu_activity($txt_t,$txt_y,$call_activityRow["activity_key"]);
												$sturc_num=0;
												foreach($activity_sturc->print_activitydata() as $rc_key=>$activity_sturcRow){
												$sturc_num=$sturc_num+1;	
												$copy_sturc=new stu_levelpdo($activity_sturcRow["ac_key"],$txt_y,$txt_t);

												$stu_data=new regina_stu_data($activity_sturcRow["ac_key"]);

												?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
												  <tr>
													<td><div><?php echo $sturc_num;?></div></td>
													<td><div><?php echo $activity_sturcRow["ac_key"];?></div></td>
													<td><div><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></div></td>
													
	<?php
		$stu_data2=new regina_stu_data2($activity_sturcRow["ac_key"],$txt_y,$txt_t,$copy_sturc->IDLevel);
	?>													
													<td><div><?php echo $stu_data2->Sort_name."/".$stu_data2->rsc_room;?></div></td>
													<td><div><?php echo $stu_data2->rsc_num;?></div></td>
												  </tr>													
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->														
										<?php	} ?>

										</tbody>
									</table>
								</div>
							
							
							
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<form name="activityA" action="" method="post" accept-charset="UTF-8">
							<!---<input type="hidden" name="activity_key" value="<?php //echo $call_activityRow["activity_key"];?>">
							<button type="submit" class="btn btn-success" name="code_key" value="key_system">ลงทะเบียน</button>
							<button type="button" class="btn btn-warning" data-dismiss="modal">ปิด</button>-->							
						</form>
					</div>
				</div>
		  
			</div>
		</div>																																									 
	<!-- Modal -->		
	<script>
		$(document).ready(function(){
			$("#Btn_activity<?php echo $hr_arc;?>").click(function(){
				$("#Modal_activity<?php echo $hr_arc;?>").modal({backdrop: false});
			});
		})
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
    $('#datatable-button-html5-columns<?php echo $hr_arc;?>').DataTable({
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
					filename: 'กิจกรรมส่งเสริมศักยภาพ : <?php echo $call_activityRow["activity_txt"];?> ชั้น <?php echo $print_l;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
					title: 'กิจกรรมส่งเสริมศักยภาพ : <?php echo $call_activityRow["activity_txt"];?> ชั้น <?php echo $print_l;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
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

	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																														
																										<?php	$hr_arc=$hr_arc+1;}?>
																											
																												
																										
																															
																												</div>
																											</div>
																										</div>
																									</div>	
																								</div>	

			</div>
		</div>		
	</div>
</div>
