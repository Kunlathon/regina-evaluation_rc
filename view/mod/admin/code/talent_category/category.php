<?php
//-----------------------------------------------------------------------------	
	include("../../../../database/database_evaluation.php");
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");
//-----------------------------------------------------------------------------	
	include("../../../../database/pdo_talent.php");	
	include("../../../../database/class_talent.php");
//-----------------------------------------------------------------------------	
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
					filename: 'แบบสำรวจนักเรียนที่มีความสามารถพิเศษ  ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?>  ปีการศึกษา <?php echo $txt_y;?>',
					title: 'แบบสำรวจนักเรียนที่มีความสามารถพิเศษ  ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?>  ปีการศึกษา <?php echo $txt_y;?>',
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
			<div class="panel-heading">แบบสำรวจนักเรียนที่มีความสามารถพิเศษ  ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?>  ปีการศึกษา <?php echo $txt_y;?></div>
			<div class="panel-body">

				<div class="table-responsive">				
					<table class="table datatable-button-html5-columns table-bordered">
						<thead>   
							<tr>
								<th colspan="14"><center>แบบสำรวจนักเรียนที่มีความสามารถพิเศษ  ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?>  ปีการศึกษา <?php echo $txt_y;?></center></th>
							</tr>
							<tr>
								<th>เลขที่</th>
								<th>รหัสนักเรียน</th>
								<th>ชื่อ - สกุล</th>
								
								<th><div>รายการวิชาการ</div></th>
								<th><div>เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล (ด้านวิชาการ)</div></th>
								<th><div>ระดับผลงาน / รางวัลที่เคยได้รับ (ด้านวิชาการ)</div></th>
								
								<th><div>เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล (ด้านกีฬา)</div></th>
								<th><div>ระดับผลงาน / รางวัลที่เคยได้รับ (ด้านกีฬา)</div></th>
								
								<th><div>เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล (ด้านดนตรี)</div></th>
								<th><div>ระดับผลงาน / รางวัลที่เคยได้รับ (ด้านดนตรี)</div></th>	

								<th><div>เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล (ด้านศิลปะและการแสดง)</div></th>
								<th><div>ระดับผลงาน / รางวัลที่เคยได้รับ (ด้านศิลปะและการแสดง)</div></th>
								
								<th><div>เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล (ด้านอื่น ๆ)</div></th>
								<th><div>ระดับผลงาน / รางวัลที่เคยได้รับ (ด้านอื่น ๆ)</div></th>
								
							

							</tr>
						</thead>
						<tbody>
	
			<?php			
				$data_sturcroom=new data_sturoom($txt_t,$txt_y,$txt_class,$txt_room);	
				foreach($data_sturcroom->printdata_sturoom as $rc_key=>$sturcroom_rom){ 
					$rsc_num=$sturcroom_rom["rsc_num"];
					$rsd_studentid=$sturcroom_rom["rsd_studentid"];
					$data_prefix=new print_prefix($rsd_prefix=$sturcroom_rom["rsd_prefix"]);
					$name_th=$data_prefix->prefix_prefix_SName." ".$sturcroom_rom["rsd_name"]." ".$sturcroom_rom["rsd_surname"];
				?>
				
							<tr>
								<td><?php echo $rsc_num;?></td>
								<td><?php echo $rsd_studentid;?></td>
								<td><?php echo $name_th;?></td>
								
								
			<?php
				$CreckJoinTheEvent=new CreckJoinTheEvent($rsd_studentid,$txt_y,$txt_class);
					if($CreckJoinTheEvent->RunCreckJoinTheEvent()=="Yes"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
								<td>
		<?php
				$CallAcademicSud=new CallAcademicSud($rsd_studentid,$txt_y,$txt_class);
				foreach($CallAcademicSud->PrintAcademicSud() as $rc_key=>$AcademicSudRow){ ?>								
								
								<div>&nbsp;&nbsp;<?php echo $AcademicSudRow["academic_txtTh"];?>&nbsp;&nbsp;</div>
		<?php	}?>									
								</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
								<td>
		<?php
				$CallJoinActivityMatchSud=new CallJoinActivityMatchSud($rsd_studentid,$txt_y,$txt_class,'1');
				foreach($CallJoinActivityMatchSud->PrintJoinActivityMatchSud() as $rc_key=>$JoinActivityMatchSudRow){ ?>
					
								<div>&nbsp;&nbsp;<?php echo $JoinActivityMatchSudRow["JAM_txt"];?>&nbsp;&nbsp;</div>
					
		<?php	} ?>			
								</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<td>
		<?php
				$CallLevelPortfolioSud=new CallLevelPortfolioSud($rsd_studentid,$txt_y,$txt_class,'1');
				foreach($CallLevelPortfolioSud->PrintLevelPortfolioSud() as $rc_key=>$LevelPortfolioSudRow){ ?>
					
								<div>&nbsp;&nbsp;<?php echo $LevelPortfolioSudRow["lp_txtTh"];?>&nbsp;&nbsp;</div>
					
		<?php	}?>
								</td>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
						
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>
		<?php
				$CallJoinActivityMatchSud=new CallJoinActivityMatchSud($rsd_studentid,$txt_y,$txt_class,'2');
				foreach($CallJoinActivityMatchSud->PrintJoinActivityMatchSud() as $rc_key=>$JoinActivityMatchSudRow){ ?>
					
								<div>&nbsp;&nbsp;<?php echo $JoinActivityMatchSudRow["JAM_txt"];?>&nbsp;&nbsp;</div>
					
		<?php	} ?>			
								</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<td>
		<?php
				$CallLevelPortfolioSud=new CallLevelPortfolioSud($rsd_studentid,$txt_y,$txt_class,'2');
				foreach($CallLevelPortfolioSud->PrintLevelPortfolioSud() as $rc_key=>$LevelPortfolioSudRow){ ?>
					
								<div>&nbsp;&nbsp;<?php echo $LevelPortfolioSudRow["lp_txtTh"];?>&nbsp;&nbsp;</div>
					
		<?php	}?>
								</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>
		<?php
				$CallJoinActivityMatchSud=new CallJoinActivityMatchSud($rsd_studentid,$txt_y,$txt_class,'3');
				foreach($CallJoinActivityMatchSud->PrintJoinActivityMatchSud() as $rc_key=>$JoinActivityMatchSudRow){ ?>
					
								<div>&nbsp;&nbsp;<?php echo $JoinActivityMatchSudRow["JAM_txt"];?>&nbsp;&nbsp;</div>
					
		<?php	} ?>			
								</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<td>
		<?php
				$CallLevelPortfolioSud=new CallLevelPortfolioSud($rsd_studentid,$txt_y,$txt_class,'3');
				foreach($CallLevelPortfolioSud->PrintLevelPortfolioSud() as $rc_key=>$LevelPortfolioSudRow){ ?>
					
								<div>&nbsp;&nbsp;<?php echo $LevelPortfolioSudRow["lp_txtTh"];?>&nbsp;&nbsp;</div>
					
		<?php	}?>
								</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>
		<?php
				$CallJoinActivityMatchSud=new CallJoinActivityMatchSud($rsd_studentid,$txt_y,$txt_class,'4');
				foreach($CallJoinActivityMatchSud->PrintJoinActivityMatchSud() as $rc_key=>$JoinActivityMatchSudRow){ ?>
					
								<div>&nbsp;&nbsp;<?php echo $JoinActivityMatchSudRow["JAM_txt"];?>&nbsp;&nbsp;</div>
					
		<?php	} ?>			
								</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<td>
		<?php
				$CallLevelPortfolioSud=new CallLevelPortfolioSud($rsd_studentid,$txt_y,$txt_class,'4');
				foreach($CallLevelPortfolioSud->PrintLevelPortfolioSud() as $rc_key=>$LevelPortfolioSudRow){ ?>
					
								<div>&nbsp;&nbsp;<?php echo $LevelPortfolioSudRow["lp_txtTh"];?>&nbsp;&nbsp;</div>
					
		<?php	}?>
								</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td>
		<?php
				$CallJoinActivityMatchSud=new CallJoinActivityMatchSud($rsd_studentid,$txt_y,$txt_class,'5');
				foreach($CallJoinActivityMatchSud->PrintJoinActivityMatchSud() as $rc_key=>$JoinActivityMatchSudRow){ ?>
					
								<div>&nbsp;&nbsp;<?php echo $JoinActivityMatchSudRow["JAM_txt"];?>&nbsp;&nbsp;</div>
					
		<?php	} ?>			
								</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<td>
		<?php
				$CallLevelPortfolioSud=new CallLevelPortfolioSud($rsd_studentid,$txt_y,$txt_class,'5');
				foreach($CallLevelPortfolioSud->PrintLevelPortfolioSud() as $rc_key=>$LevelPortfolioSudRow){ ?>
					
								<div>&nbsp;&nbsp;<?php echo $LevelPortfolioSudRow["lp_txtTh"];?>&nbsp;&nbsp;</div>
					
		<?php	}?>
								</td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
			<?php	}elseif($CreckJoinTheEvent->RunCreckJoinTheEvent()=="No"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td><div><center>ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน</center></div></td>
								<td><div><center>ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน</center></div></td>
								<td><div><center>ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน</center></div></td>
								<td><div><center>ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน</center></div></td>
								<td><div><center>ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน</center></div></td>
								<td><div><center>ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน</center></div></td>
								<td><div><center>ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน</center></div></td>
								<td><div><center>ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน</center></div></td>
								<td><div><center>ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน</center></div></td>
								<td><div><center>ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน</center></div></td>
								<td><div><center>ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน</center></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
			<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<td><div><center>ไม่ได้ตอบกลับแบบสำนักเรียนนักเรียนที่มีความสามารถพิเศษ</center></div></td>						
								<td><div><center>ไม่ได้ตอบกลับแบบสำนักเรียนนักเรียนที่มีความสามารถพิเศษ</center></div></td>						
								<td><div><center>ไม่ได้ตอบกลับแบบสำนักเรียนนักเรียนที่มีความสามารถพิเศษ</center></div></td>						
								<td><div><center>ไม่ได้ตอบกลับแบบสำนักเรียนนักเรียนที่มีความสามารถพิเศษ</center></div></td>						
								<td><div><center>ไม่ได้ตอบกลับแบบสำนักเรียนนักเรียนที่มีความสามารถพิเศษ</center></div></td>						
								<td><div><center>ไม่ได้ตอบกลับแบบสำนักเรียนนักเรียนที่มีความสามารถพิเศษ</center></div></td>						
								<td><div><center>ไม่ได้ตอบกลับแบบสำนักเรียนนักเรียนที่มีความสามารถพิเศษ</center></div></td>						
								<td><div><center>ไม่ได้ตอบกลับแบบสำนักเรียนนักเรียนที่มีความสามารถพิเศษ</center></div></td>						
								<td><div><center>ไม่ได้ตอบกลับแบบสำนักเรียนนักเรียนที่มีความสามารถพิเศษ</center></div></td>						
								<td><div><center>ไม่ได้ตอบกลับแบบสำนักเรียนนักเรียนที่มีความสามารถพิเศษ</center></div></td>																		
								<td><div><center>ไม่ได้ตอบกลับแบบสำนักเรียนนักเรียนที่มีความสามารถพิเศษ</center></div></td>																		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
			<?php	}?>					
							</tr>
				

			<?php	} ?>			
		
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
</div>