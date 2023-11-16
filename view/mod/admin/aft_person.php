<?php
	
    $copy_spensor=post_data($_POST["copy_spensor"]);  
	$copy_class=post_data($_POST["copy_class"]);  
	$copy_year=post_data($_POST["copy_year"]);  
	
	if($copy_spensor=="" and $copy_class=="" and $copy_year==""){
		exit("<script>window.location='./?evaluation_mod=aft_data_teacher';</script>");
	}elseif($copy_spensor=="" or $copy_class=="" or $copy_year==""){
		exit("<script>window.location='./?evaluation_mod=aft_data_teacher';</script>");
	}else{ 	?>
<!--**********************************************************-->
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">สรุปผลการประเมินรายบุคคล </span>  ประเมินความพึงพอใจการจัดการเรียนการสอน </h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>การจัดการ ประเมินความพึงพอใจการจัดการเรียนการสอน</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a onClick="jascript:history.go(-1)" class="btn btn-link  text-size-small"><span>สรุปผลการประเมินรายบุคคล ประเมินความพึงพอใจการจัดการเรียนการสอน</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
<?php
		$evaluation_content="select DISTINCT `evaluation_content`.`ec_id`,`evaluation_content`.`ec_txt` 
							 from `evaluation_score` 
							 join `evaluation_content` 
							 on(`evaluation_score`.`es_ec`=`evaluation_content`.`ec_id`) 
							 where `evaluation_score`.`es_term`='{$copy_class}' 
							 and `evaluation_score`.`es_year`='{$copy_year}' 
							 and `evaluation_score`.`es_teacher`='{$copy_spensor}'  
							 ORDER BY `evaluation_content`.`ec_id` ASC";
		$evaluation_coutentRs=$rcdata_connect->query($evaluation_content) or die ($rcdata_connect->error);
			if($evaluation_coutentRs->num_rows>0){ ?>
		
<div class="row">
	<div class="col-sm-3 col-md-3 col-lg-3">
		<div class="panel panel-default">
			<div class="panel-body">
<?php
//Data:  rc_person 
	$data_rc_person="select `rc_person`.`IDTeacher`,`rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName` from rc_person join rc_prefix on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`)

					 where `rc_person`.`IDTeacher`='{$copy_spensor}';";
	$data_rc_personRs=rc_data($data_rc_person);
	
	foreach($data_rc_personRs as $rc_key=>$data_rc_personRow){
		$IDTeacher=$data_rc_personRow["IDTeacher"];
		$myname=$data_rc_personRow["prefixname"]." ".$data_rc_personRow["FName"]." ".$data_rc_personRow["SName"];	

	}
//Data:  rc_person End
?>			
				<div class="thumbnail no-padding">
					<div class="thumb">
					
						
						<div class="imgBox"><img src="view/t/<?php echo $IDTeacher;?>.jpg" class="img-thumbnail" alt="Cinque Terre"  data-origin="view/t/<?php echo $IDTeacher;?>.jpg"></div>
					</div>
					<div class="caption text-center">
						<h6 class="text-semibold no-margin"><?php echo $myname; ?></h6>
					</div>
				</div>
			
			</div>
		</div>
	</div>
	<div class="col-sm-9 col-md-9 col-lg-9">
		<div class="panel panel-default">
			<div class="panel-body">
		<div class="row">	
				<?php
					$evaluation_content="select DISTINCT `evaluation_content`.`ec_id`,`evaluation_content`.`ec_txt` 
								         from `evaluation_score` 
										 join `evaluation_content` 
										 on(`evaluation_score`.`es_ec`=`evaluation_content`.`ec_id`) 
										 where `evaluation_score`.`es_term`='{$copy_class}' 
										 and `evaluation_score`.`es_year`='{$copy_year}' 
										 and `evaluation_score`.`es_teacher`='{$copy_spensor}' 
										 ORDER BY `evaluation_content`.`ec_id` ASC";
					$evaluation_coutentRs=$rcdata_connect->query($evaluation_content) or die ($rcdata_connect->error);
					
					if($evaluation_coutentRs->num_rows>0){
						$count_a=1;
						while($evaluation_coutentRow=$evaluation_coutentRs->fetch_assoc()){
						$ec_id=$evaluation_coutentRow["ec_id"];
						$ec_txt=$evaluation_coutentRow["ec_txt"];


					//number_students
						$number_stu="SELECT count(`evaluation_id`) as num_stu 
									 FROM `evaluation` 
									 WHERE `evaluation_teacher`='{$copy_spensor}' 
									 and `evaluation_year`='{$copy_year}' 
									 and `evaluation_term`='{$copy_class}' 
									 and `evaluation_s`='1' 
									 and `evaluation_st`='1'";
						$number_stuRs=rc_data($number_stu);
						
						foreach($number_stuRs as $rc_key=>$number_stuRow){
							$num_stu=$number_stuRow["num_stu"];
						}
					

					
					//number_students***End

						$number_ec="SELECT count(`es_id`) as num_es 
						            FROM `evaluation_subject` WHERE `ec_id`='{$ec_id}'";
						$number_ecRs=rc_data($number_ec);
						
						foreach($number_ecRs as $rc_key=>$number_ecRow){
							$num_es=$number_ecRow["num_es"];//จำนวนข้อ...
						}
					//number_ec**********End
					//sum_score คะแนน รวม 5 4 3 2 1
						$sum_score="select sum(`es_score`) as sum_scoreall 
						            from `evaluation_score` 
									where `es_term`='{$copy_class}' 
									and `es_year`='{$copy_year}' 
									and `es_ec`='{$ec_id}' 
									and `es_status`='1' 
									and `es_teacher`='{$copy_spensor}'";
						$sum_scoreRs=rc_data($sum_score);
						
						foreach($sum_scoreRs as $rc_key=>$sum_scoreRow){
							$sum_scoreall=$sum_scoreRow["sum_scoreall"];
							if($sum_scoreall==""){
								$sum_scoreall=0;
							}else{
								$sum_scoreall; //คะแนนรวม 5 4 3 2 1
							}
						}
					//sum_score**********End  
						$ans_ec=number_format($sum_scoreall/($num_stu*$num_es),2);
					//keep_number
					$keep_array=0;
					$run_num=0;
						while($keep_array<5){
							$run_num=$run_num+1;
						
							$count_keystu="SELECT count(`es_student`) as keep_countstu FROM `evaluation_score` 
										   WHERE `es_term`='{$copy_class}' 
										   and `es_year`='{$copy_year}' 
										   and `es_ec`='{$ec_id}' 
										   and `es_teacher`='{$copy_spensor}' 
										   and `es_status`='1' 
										   and `es_score`='{$run_num}'";
							$count_keystuRs=rc_data($count_keystu);
							foreach($count_keystuRs as $rc_key=>$count_keystuRow) 
						
							$arr_keepscor[$keep_array]=$count_keystuRow["keep_countstu"];
						
							$keep_array=$keep_array+1;	
						}	



					//keep_number
					
						
						
						?>
	<script>
	$(document).ready(function (){

    // Donut chart
    // ------------------------------

    // Generate chart
    var donut_chart = c3.generate({
        bindto: '#c3-donut-chart<?php echo $count_a;?>',
        size: { width: 300 },
        color: {
            pattern: ['#3F51B5', '#FF9800', '#4CAF50', '#00BCD4', '#F44336']
        },
        data: {
            columns: [
			
			<?php
				$print_keepscore=0;
				while($print_keepscore<5){ ?>
					
				['ระดับ <?php echo $print_keepscore+1; ?>', <?php echo $arr_keepscor[$print_keepscore];?>],	
					
		<?php	$print_keepscore=$print_keepscore+1; }	?>
			
			
                

				
            ],
            type : 'donut'
        },
        donut: {
            title: "เฉลี่ยรวม <?php echo $ans_ec;?>"
        }
    });
			
	})
	</script>					
								
			<div class="col-sm-6 col-md-6 col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title text-semibold"><?php echo $ec_txt;?></h6>
					</div>

					<div class="panel-body">
						<div class="chart-container text-center">
							<div class="display-inline-block" id="c3-donut-chart<?php echo $count_a;?>"></div>
						</div>
					</div>
				</div>
			</div>							
<?php						$count_a=$count_a+1;} 

					}else{
						//echo"not data....";
					}

				?>
		</div>		
			</div>
		</div>	
	</div>	
</div><br>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
				
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><b><center>รายการประเมิน</center></b></th>
								<th><b><center>ผลคะแนนเฉลี่ย</center></b></th>
							</tr>
						</thead>
						<tbody>
						
						
			<?php
				$sum_ans_es=0;
				$evaluation_report="select DISTINCT `evaluation_content`.`ec_id`,`evaluation_subject`.`es_id`,`evaluation_subject`.`es_txt`,`evaluation_content`.`ec_txt`
                    				from `evaluation_score` join `evaluation_content` on(`evaluation_score`.`es_ec`=`evaluation_content`.`ec_id`) 
									join `evaluation_subject` on( `evaluation_content`.`ec_id`=`evaluation_subject`.`ec_id`) 
									where `evaluation_score`.`es_term`='{$copy_class}' 
									and `evaluation_score`.`es_year`='{$copy_year}' 
									and `evaluation_score`.`es_teacher`='{$copy_spensor}'  
									ORDER BY `evaluation_subject`.`es_id` ASC";
				$evaluation_reportRs=rc_array($evaluation_report);
				$count_txt=1;
				foreach($evaluation_reportRs as $rc_key=>$evaluation_reportRow){ 
					$report_es_id=$evaluation_reportRow["es_id"];
					$report_es_txt=$evaluation_reportRow["es_txt"];//Material->Total score / Number of students***   
//keep students
				$keep_students="select sum(`es_score`) as sumkeep_stu from `evaluation_score`
								where `es_term`='{$copy_class}'
								and `es_year`='{$copy_year}'  
								and  `es_es`='{$report_es_id}' 
								and `es_teacher`='{$copy_spensor}' and `es_status`='1'";
				$keep_studentsRs=rc_data($keep_students);
				foreach($keep_studentsRs as $rc_key=>$keep_studentsRow){
					$sumkeep_stu=$keep_studentsRow["sumkeep_stu"];
					if($sumkeep_stu==""){
						$sumkeep_stu=0;
					}else{
						$sumkeep_stu;
					}
				}
//keep students End

//Keep number_students
				$keep_num_stu="SELECT count(`evaluation_id`) as count_student 
							   FROM `evaluation` 
							   WHERE `evaluation_teacher`='{$copy_spensor}' 
							   and `evaluation_year`='{$copy_year}' 
							   and `evaluation_term`='{$copy_class}' 
							   and `evaluation_s`='1' 
							   and `evaluation_st`='1'";
				$keep_num_stuRs=rc_data($keep_num_stu);
				foreach($keep_num_stuRs as $rc_key=>$keep_num_stuRow){
					$count_student=$keep_num_stuRow["count_student"];
					if($count_student==""){
						$count_student=0;
					}else{
						$count_student;
					}
				}
//Keep number_students End
				$ans_es=number_format($sumkeep_stu/$count_student,2);?>

							<tr>
								<td><?php echo $count_txt.". ".$report_es_txt;?></td>
								<td><center><?php echo $ans_es;?></center></td>
							</tr>			
				
				
			<?php	$count_txt=$count_txt+1;
					$sum_ans_es=$sum_ans_es+$ans_es;
			}?>									
						</tbody>
						<thead>
							<tr>
								<th><b><center>ผลประเมิน</center></b></th>
								<th><b><center><?php echo number_format($sum_ans_es,2);?></center></b></th>
							</tr>
						</thead>
					</table>
				
				</div>
			</div>
		</div>	
	</div>		
</div>	
<?php
	$evaluation_oeq="SELECT `evaluation_oeqid`,`evaluation_oeqtxt` 
					 FROM `evaluation_oeq` 
					 ORDER BY `evaluation_oeq`.`evaluation_oeqid` ASC";
	$evaluation_oeqRs=rc_array($evaluation_oeq);
	foreach($evaluation_oeqRs as $rc_key=>$evaluation_oeqRow){ 
		$evaluation_oeqid=$evaluation_oeqRow["evaluation_oeqid"];
		$evaluation_oeqtxt=$evaluation_oeqRow["evaluation_oeqtxt"];
	?>
	
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-default">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title text-semibold"><?php echo $evaluation_oeqtxt;?></h6>
				</div>

				<div class="panel-body">
					
						<div class="table-responsive">
							<table class="table table datatable-button-html5-columns">
								<thead>
									<tr> 
										<th><center><b>ลำดับ</b></center></th>
										<th><center><b>แสดงความคิดเห็น</b></center></th>
										<th><center><b>เวลา</b></center></th>
									</tr>
								</thead>
								<tbody>
								
				<?php
					$print_dataoeq="SELECT `evaluation_odtxt`,`evaluation_odtime` 
									FROM `evaluation_oeq_data` 
									where `evaluation_odid`='{$evaluation_oeqid}' 
									and `evaluation_odterm`='{$copy_class}' 
									and `evaluation_odyear`='{$copy_year}' 
									and `evaluation_odteacher`='{$copy_spensor}'";
					$print_dataoeqRs=rc_array($print_dataoeq);
					$count_oeq=1;
					foreach($print_dataoeqRs as $rc_key=>$print_dataoeqRow){
							$evaluation_odtxt=$print_dataoeqRow["evaluation_odtxt"];
							$evaluation_odtime=$print_dataoeqRow["evaluation_odtime"];
						?>
									
									<tr>
										<td><?php echo $count_oeq;?></td>
										<td><?php echo $evaluation_odtxt;?></td>
										<td><?php echo date_timeThailand($evaluation_odtime);?></td>
									</tr>						
			<?php	$count_oeq=$count_oeq+1;} ?>				
								

								</tbody>
							</table>
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
					filename: '<?php echo $evaluation_oeqtxt."...".$myname." เทอม ".$copy_class." ปีการศึกษา ". $copy_year;?>',
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
	
	
	
<?php } ?>
		

<?php echo "* จำนวนนักเรียน " .$count_student." คน ข้อมูล เทอม  ".$copy_class." ปีการศึกษา ".$copy_year;?>					
<?php		}else{ ?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-danger">
				<strong>พบข้อมูลผิดพลาด</strong> ไม่พบข้อมูล....
			</div>
		</div>
	</div>			
<?php		} ?>		
<!--**********************************************************-->		
<?php	 }  ?>












