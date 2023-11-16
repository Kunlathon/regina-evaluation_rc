	<script>
		$(document).ready(function () {

    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            //width: '100px',
           // targets: [ 5 ]
        }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>ค้นหา:</span> _INPUT_',
            searchPlaceholder: 'พิมพ์เพื่อกรอง...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });


    // Basic datatable
    $('.datatable-basic').DataTable({
		"paging"       : false,
		"lengthChange" : false,
		"searching"    : true,
		"ordering"     : true,
		"info"         : true,
		"autoWidth"    : true,
		//"lengthMenu":[[40,60,80,100,-1],[40,60,80,100,"ทั้งหมด"]],
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



<?php
	include("../../../../database/database_evaluation.php");
	$rcdata_connect=connect();
	$copy_term=post_data($_POST["copy_term"]);
	$copy_year=post_data($_POST["copy_year"]);
	$copy_oc=post_data($_POST["copy_oc"]);
	
	

?>
<form name="overdue_data" method="post" action="view/mod/admin/code/overdue/overdue_code.php">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-info">
			<div class="panel-heading">นักเรียนค้างชำระเงิน ภาคเรียนที่ <?php echo $copy_term;?> ปีการศึกษา <?php echo $copy_year;?></div>
			<div class="panel-body">
				<div class="table-responsive">
				
						<table class="table datatable-basic">
							<thead>
								<tr>
									<th>รหัสนักเรียน</th>
									<th>ชื่อ-สกุล</th>
									<th>ชั้นเรียน</th>
									<th>สถานะการชำระ</th>
									<th>ประเภทการชำระ</th>
								</tr>
							</thead>
							<tbody>
							
					<?php
						$count_pay=0;
						$pay_stuto="select `overdue_data`.`od_student`,`regina_stu_data`.`rsd_name`, `regina_stu_data`.`rsd_surname`,`rc_level`.`Lname`,`overdue_data`.`os_id`,`overdue_data`.`oc_id` from `overdue_data` join `regina_stu_data` on(`overdue_data`.`od_student`=`regina_stu_data`.`rsd_studentid`)
									join `rc_level` on (`overdue_data`.`od_class`=`rc_level`.`IDLevel`)
									where `overdue_data`.`od_term`='{$copy_term}' 
									and  `overdue_data`.`od_year`='{$copy_year}'
									and `overdue_data`.`oc_id`='{$copy_oc}'";
						$pay_sturs=rc_array($pay_stuto);
						
						foreach($pay_sturs as $rc_key=>$pay_sturow){  
							$od_student=$pay_sturow["od_student"];
							$stu_name=$pay_sturow["rsd_name"]." ".$pay_sturow["rsd_surname"];
							$stu_level=$pay_sturow["Lname"];
							$os_id=$pay_sturow["os_id"];//สถานะการจ่าย
							$oc_id=$pay_sturow["oc_id"];//ประเภท
							
						?>
									
								<tr>
									<td><?php echo $od_student;?></td>
									<input type="hidden" name="stu<?php echo $count_pay;?>" value="<?php echo $od_student;?>">
									<td><?php echo $stu_name;?></td>
									<td><?php echo $stu_level;?></td>
									<td>
										<div class="form-group" >
											<select class="form-control" name="txt_os<?php echo $count_pay;?>">
											
								<?php
									$data_os="SELECT `os_id`,`os_text` FROM `overdue_status`";
									$data_osrs=rc_array($data_os);
									
									foreach($data_osrs as $rc_key=>$data_osrow){ 
									
									if($os_id==$data_osrow["os_id"]){
										$selectedos="selected";
									}else{
										$selectedos="";
									}
									
									?>
										
												<option  value="<?php echo $data_osrow["os_id"];?>" <?php echo $selectedos;?>><?php echo $data_osrow["os_text"];?></option>										
								<?php	}   ?>	
								
											</select>
										</div>
									</td>
									<td>
										<div class="form-group" >
											<select class="form-control" name="txt_oc<?php echo $count_pay;?>">
											
								<?php
									$data_oc="SELECT `oc_id`,`oc_text` FROM `overdue_category`";
									$data_ocrs=rc_array($data_oc);
									
									foreach($data_ocrs as $rc_key=>$data_ocrow){ 
									
										if($oc_id==$data_ocrow["oc_id"]){
											$selectedoc="selected";
										}else{
											$selectedoc="";
										}
										
									?>
										
												<option value="<?php echo $data_ocrow["oc_id"];?>" <?php echo $selectedoc;?>><?php echo $data_ocrow["oc_text"];?></option>
								<?php	}   ?>											
											
											</select>
										</div>
									</td>
								</tr>	
					<?php	$count_pay=$count_pay+1;}?>

					
							</tbody>
						</table>
				</div>			
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<center>
			<button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
			<button type="reset" class="btn btn-info">ล้างรายการข้อมูล</button>
		</center>
	</div>
</div>
	<input type="hidden" name="countstu" value="<?php echo $count_pay;?>">
	<input type="hidden" name="copy_term" value="<?php echo $copy_term;?>">
	<input type="hidden" name="copy_year" value="<?php echo $copy_year;?>">
</form>
