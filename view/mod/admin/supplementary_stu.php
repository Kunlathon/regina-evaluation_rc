<?php
	include("view/database/pdo_data.php");
	include("view/database/class_pdo.php");
	
	$subjectid=filter_input(INPUT_GET,'subjectid');
	$day=filter_input(INPUT_GET,'day');
    $t=filter_input(INPUT_GET,'t');
    $l=filter_input(INPUT_GET,'l');
    $y=filter_input(INPUT_GET,'y');
    
	
	if($subjectid=="" and $day==""){
		exit("<script>window.location='./?evaluation_mod=supplementary_data';</script>");
	}elseif($subjectid=="" or $day==""){
		exit("<script>window.location='./?evaluation_mod=supplementary_data';</script>");
	}else{
		if($day=="Mon"){
			$day_txt="วันจันทร์";
		}elseif($day=="Tues"){
			$day_txt="วันอังคาร";
		}elseif($day=="Wednes"){
			$day_txt="วันพุธ";
		}elseif($day=="Thurs"){
			$day_txt="วันพฤหัสบดี";
		}elseif($day=="fri"){
			$day_txt="วันศุกร์";
		}elseif($day=="Satur"){
			$day_txt="วันเสาร์";
		}elseif($day=="Sun"){
			$day_txt="วันอาทิตย์";
		}else{
			$day_txt="";
		}
		$call_subjectSql="SELECT `ss_id`,`ss_t`,`ss_l`,`ss_year`,`ss_txtth`,`ss_txten` FROM `supplementary_subject` WHERE `ss_id`='{$subjectid}' and `ss_t`='{$t}' and `ss_l`='{$l}' and `ss_year`='{$y}'";
		$call_subject=new notrow_evaluation($call_subjectSql);
		
		foreach($call_subject->evaluation_array as $rc_key=>$call_subjectRow){
			$ss_id=$call_subjectRow["ss_id"];
			$ss_t=$call_subjectRow["ss_t"];
			$ss_l=$call_subjectRow["ss_l"];
			$ss_year=$call_subjectRow["ss_year"];
			$ss_txtth=$call_subjectRow["ss_txtth"];
			$ss_txten=$call_subjectRow["ss_txten"];
		}
		
		$call_level=new print_level($ss_l);
	}
	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ข้อมูลนักเรียน</span> เรียนเสริมเย็น ระดับชั้น : <?php echo $call_level->set_Sort_name;?> ภาคเรียนที่ : <?php echo $ss_t;?> ปีการศึกษา : <?php echo $ss_year;?> วิชา : <?php echo $ss_txtth;?> คาบ : <?php echo $day_txt;?></h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ข้อมูลนักเรียน เรียนเสริมเย็น</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-info">
			<div class="panel-heading">รายชื่อนักเรียน ลงเรียนเสริมเย็น</div>
			<div class="panel-body">
			
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="table-responsive">
							  <table class="table table datatable-button-html5-columns">
								<thead>
								  <tr>
									<th>ลำดับ</th>
									<th>เลขประจำตัวนักเรียน</th>									
									<th>ชื่อ-สกุล</th>									
									<th>ชั้น</th>									
									<th>เลขที่</th>									
								  </tr>
								</thead>
								<tbody>
								  
		<?php
			if($day=="Mon"){ ?> 
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime`,`sup_t`,`sup_l`,`sup_year` FROM `supplementary_sturs`
								 WHERE `ss_id`='{$subjectid}' 
								 and `ss_mon`='1' and `sup_t`='{$ss_t}' and `sup_l`='{$ss_l}' and `sup_year`='{$ss_year}' 
								 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
		$print_supplementaryRs=new row_evaluation($print_supplementarySql);
		$count_stu=1;
		foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
	

								  <tr>
	<?php
		$stu_data=new regina_stu_data2($print_supplementaryRow["sup_stuid"],$print_supplementaryRow["sup_year"],$print_supplementaryRow["sup_t"],$print_supplementaryRow["sup_l"]);
	?>										

									<td><?php echo $count_stu;?></td>	
									<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>	
									<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
									<td><?php echo $stu_data->Sort_name."/".$stu_data->rsc_room;?></td>		
									<td><?php echo $stu_data->rsc_num;?></td>

								  </tr>	
	<?php	$count_stu=$count_stu+1;}
	
	
	?>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}elseif($day=="Tues"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime`,`sup_t`,`sup_l`,`sup_year` FROM `supplementary_sturs`
								 WHERE `ss_id`='{$subjectid}' 
								 and `ss_tues`='1' and `sup_t`='{$ss_t}' and `sup_l`='{$ss_l}' and `sup_year`='{$ss_year}'
								 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
		$print_supplementaryRs=new row_evaluation($print_supplementarySql);
		$count_stu=1;
		foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
	

								  <tr>
	<?php
		$stu_data=new regina_stu_data2($print_supplementaryRow["sup_stuid"],$print_supplementaryRow["sup_year"],$print_supplementaryRow["sup_t"],$print_supplementaryRow["sup_l"]);
	?>										  
									<td><?php echo $count_stu;?></td>	
									<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>	
									<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
									<td><?php echo $stu_data->Sort_name."/".$stu_data->rsc_room;?></td>		
									<td><?php echo $stu_data->rsc_num;?></td>
									
								  </tr>	
	<?php	$count_stu=$count_stu+1;}
	
	
	?>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}elseif($day=="Wednes"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime`,`sup_t`,`sup_l`,`sup_year` FROM `supplementary_sturs`
								 WHERE `ss_id`='{$subjectid}' 
								 and `ss_wedne`='1' and `sup_t`='{$ss_t}' and `sup_l`='{$ss_l}' and `sup_year`='{$ss_year}'
								 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
		$print_supplementaryRs=new row_evaluation($print_supplementarySql);
		$count_stu=1;
		foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
	

								  <tr>
	<?php
		$stu_data=new regina_stu_data2($print_supplementaryRow["sup_stuid"],$print_supplementaryRow["sup_year"],$print_supplementaryRow["sup_t"],$print_supplementaryRow["sup_l"]);
	?>										  
									<td><?php echo $count_stu;?></td>	
									<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>	
									<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
									<td><?php echo $stu_data->Sort_name."/".$stu_data->rsc_room;?></td>		
									<td><?php echo $stu_data->rsc_num;?></td>
									
								  </tr>	
	<?php	$count_stu=$count_stu+1;}
	
	
	?>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}elseif($day=="Thurs"){  ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime`,`sup_t`,`sup_l`,`sup_year` FROM `supplementary_sturs`
								 WHERE `ss_id`='{$subjectid}' 
								 and `ss_thurs`='1' and `sup_t`='{$ss_t}' and `sup_l`='{$ss_l}' and `sup_year`='{$ss_year}'
								 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
		$print_supplementaryRs=new row_evaluation($print_supplementarySql);
		$count_stu=1;
		foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
	

								  <tr>
	<?php
		$stu_data=new regina_stu_data2($print_supplementaryRow["sup_stuid"],$print_supplementaryRow["sup_year"],$print_supplementaryRow["sup_t"],$print_supplementaryRow["sup_l"]);
	?>										  
									<td><?php echo $count_stu;?></td>	
									<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>	
									<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
									<td><?php echo $stu_data->Sort_name."/".$stu_data->rsc_room;?></td>		
									<td><?php echo $stu_data->rsc_num;?></td>
									
								  </tr>	
	<?php	$count_stu=$count_stu+1;}
	
	
	?>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}elseif($day=="fri"){    ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime`,`sup_t`,`sup_l`,`sup_year` FROM `supplementary_sturs`
								 WHERE `ss_id`='{$subjectid}' 
								 and `ss_fri`='1' and `sup_t`='{$ss_t}' and `sup_l`='{$ss_l}' and `sup_year`='{$ss_year}'
								 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
		$print_supplementaryRs=new row_evaluation($print_supplementarySql);
		$count_stu=1;
		foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
	

								  <tr>
	<?php
		$stu_data=new regina_stu_data2($print_supplementaryRow["sup_stuid"],$print_supplementaryRow["sup_year"],$print_supplementaryRow["sup_t"],$print_supplementaryRow["sup_l"]);
	?>										  
									<td><?php echo $count_stu;?></td>	
									<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>	
									<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
									<td><?php echo $stu_data->Sort_name."/".$stu_data->rsc_room;?></td>		
									<td><?php echo $stu_data->rsc_num;?></td>
									
								  </tr>	
	<?php	$count_stu=$count_stu+1;}
	
	
	?>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}elseif($day=="Satur"){  ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime`,`sup_t`,`sup_l`,`sup_year` FROM `supplementary_sturs`
								 WHERE `ss_id`='{$subjectid}' 
								 and `ss_satur`='1' and `sup_t`='{$ss_t}' and `sup_l`='{$ss_l}' and `sup_year`='{$ss_year}'
								 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
		$print_supplementaryRs=new row_evaluation($print_supplementarySql);
		$count_stu=1;
		foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
	

								  <tr>
	<?php
		$stu_data=new regina_stu_data2($print_supplementaryRow["sup_stuid"],$print_supplementaryRow["sup_year"],$print_supplementaryRow["sup_t"],$print_supplementaryRow["sup_l"]);
	?>										  
									<td><?php echo $count_stu;?></td>	
									<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>	
									<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
									<td><?php echo $stu_data->Sort_name."/".$stu_data->rsc_room;?></td>		
									<td><?php echo $stu_data->rsc_num;?></td>
									
								  </tr>	
	<?php	$count_stu=$count_stu+1;}
	
	
	?>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}elseif($day=="Sun"){    ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$print_supplementarySql="SELECT `sup_stuid`,`sup_datetime`,`sup_t`,`sup_l`,`sup_year` FROM `supplementary_sturs`
								 WHERE `ss_id`='{$subjectid}' 
								 and `ss_sun`='1' and `sup_t`='{$ss_t}' and `sup_l`='{$ss_l}' and `sup_year`='{$ss_year}'
								 ORDER BY `supplementary_sturs`.`sup_datetime` ASC";
		$print_supplementaryRs=new row_evaluation($print_supplementarySql);
		$count_stu=1;
		foreach($print_supplementaryRs->evaluation_array as $rc_key=>$print_supplementaryRow){ ?>
	

								  <tr>
	<?php
		$stu_data=new regina_stu_data2($print_supplementaryRow["sup_stuid"],$print_supplementaryRow["sup_year"],$print_supplementaryRow["sup_t"],$print_supplementaryRow["sup_l"]);
	?>										  
									<td><?php echo $count_stu;?></td>	
									<td><?php echo $print_supplementaryRow["sup_stuid"];?></td>	
									<td><?php echo $stu_data->rsd_name." ".$stu_data->rsd_surname;?></td>
									<td><?php echo $stu_data->Sort_name."/".$stu_data->rsc_room;?></td>		
									<td><?php echo $stu_data->rsc_num;?></td>
									
								  </tr>	
	<?php	$count_stu=$count_stu+1;}
	
	
	?>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}else{
			
		} ?>						  
								  
								  

								  
								  
								  
								</tbody>
							  </table>
						</div>				
					</div>
				</div>
			
			</div>
		</div>
	</div>
</div>

			

<script>
	$(document).ready(function (){

    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            seainserth: '<span>กรอง:</span> _INPUT_',
            seainserthPlaceholder: 'พิมพ์เพื่อกรอง...',
            lengthMenu: '<span>แสดง:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
        }
    });

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
					filename: 'ข้อมูลนักเรียน เรียนเสริมเย็น ระดับชั้น : <?php echo $call_level->set_Sort_name;?> ภาคเรียนที่ : <?php echo $ss_t;?> ปีการศึกษา : <?php echo $ss_year;?> วิชา : <?php echo $ss_txtth;?> คาบ : <?php echo $day_txt;?>',
					title:'ข้อมูลนักเรียน เรียนเสริมเย็น ระดับชั้น : <?php echo $call_level->set_Sort_name;?> ภาคเรียนที่ : <?php echo $ss_t;?> ปีการศึกษา : <?php echo $ss_year;?> วิชา : <?php echo $ss_txtth;?> คาบ : <?php echo $day_txt;?>',
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
		//"order": [[ 2, "DESC" ]],
		"paging"         : true,
		"lengthChange"   : true,
		"searching"      : false,
		"ordering"       : false,
		"info"           : true,
		"autoWidth"      : false,
		"lengthMenu":[[40,60,80,100,-1],[40,60,80,100,"ทั้งหมด"]],
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
		
	})
</script>	
