<?php
	include("../../../../database/pdo_quota.php");
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_quota.php");
	include("../../../../img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
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

	<script>
		$(document).ready(function (){
			
			$.extend( $.fn.dataTable.defaults, {
				autoWidth: false,
				columnDefs: [{ 
				orderable: false,
				width: '100px'
				//targets: [ 6 ]
				}],
			colReorder: true,
			dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
			language: {
				search: '<span>Filter:</span> _INPUT_',
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

			    $('.datatable-reorder').DataTable({
					
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
							"sSearch"          : "ค้นหา: ",
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

	<script>
		$(document).ready(function () {
			
			$('.select').select2({
				minimumResultsForSearch: Infinity
			});		
			
		})
	</script>

<?php
	$copy_year=filter_input(INPUT_POST,'copy_year');
	$copy_level=filter_input(INPUT_POST,'copy_level');
	$stx_year=$copy_year+1;
	$next_yaer=$copy_year+1;
	
			switch($copy_level){
			case "2":
				$call_level="อนุบาล 3";
			break;
			case "3":
				$call_level="ประถมศึกษาปีที่ 1";
			break;
			case "23":
				$call_level="มัธยมศึกษาปีที่ 1";
			break;
			case "33":
				$call_level="มัธยมศึกษาปีที่ 4";
			break;
			
			default:
				$call_level="";
		}	
?>



<div class="row">
	<div class="col-<?php echo $grid;?>-12">	
		<div class="alert alert-success">
			<div class="panel-body">
				รายชื่อนักเรียนได้รับสิทธิ์โควต้า ระดับชั้น <?php echo $call_level;?> ปีการศึกษา <?php echo $stx_year;?>
			</div>		
			<div class="table-responsive">

						<table class="table datatable-reorder">
							<thead>
								<tr>
					                <th><div>เลขประจำตัวนักเรียน</div></th>
					                <th><div>เลขประจำตัวประชาชน</div></th>
					                <th><div>ชื่อ-สกุล</div></th>
					                <th><div>ระดับชั้นที่ได้โควต้า</div></th>
					                <th><div>แผนการเรียนที่ได้</div></th>
					                <th><div>เอกสารมอบตัว</div></th>
					            </tr>
							</thead>
							<tbody>

	<?php
		if(($copy_level==2)){
			$call_datasturc=new print_datasturc_k($copy_year,'3');
		}else{
			$call_datasturc=new print_datasturc($copy_year,$copy_level);
		}
		
		$count=1;
		foreach($call_datasturc->echo_datasturc() as $rc_key=>$call_datastuRow){

			$cx_stuid=$call_datastuRow["rsd_studentid"];
			$cx_year=$call_datastuRow["rsc_year"];
			$cx_year=$cx_year+1;
			$cx_myname=$call_datastuRow["prefixname"]." ".$call_datastuRow["rsd_name"]." ".$call_datastuRow["rsd_surname"];
			$quota_rightSql="SELECT `qr_stuid`, `qr_year`, `qr_level`, `qr_plan`, `qr_datetime` 
							 FROM `quota_right` WHERE `qr_stuid`='{$cx_stuid}' 
							 and `qr_year`='{$cx_year}'";
			$quota_rightRs=new row_quotanotarray($quota_rightSql);
			foreach($quota_rightRs->print_quotanotarray() as $quota_key=>$quota_rightRow){
				
				if((isset($quota_rightRow["qr_stuid"]))){

					if(($quota_rightRow["qr_level"]==3)){
						$txt_level="อนุบาล 3";
					}elseif(($quota_rightRow["qr_level"]==11)){
						$txt_level="ประถมศึกษาปีที่ 1";
					}elseif(($quota_rightRow["qr_level"]==31)){
						$txt_level="มัธยมศึกษาปีที่ 1";
					}elseif(($quota_rightRow["qr_level"]==41)){
						$txt_level="มัธยมศึกษาปีที่ 4";
					}elseif(($quota_rightRow["qr_level"]==11)){
						$txt_level="ประถมศึกษาปีที่ 1";
					}else{
						$txt_level="-";
					}

					//$print_qr_level=new ($quota_rightRow["qr_level"]);
					$print_qr_plan=new  print_plan($quota_rightRow["qr_plan"]);
					//$key_qr_plan=base64_encode($quota_rightRow["qr_plan"]);
					//$key_studentid=base64_encode($call_datastuRow["rsd_studentid"]); ?>

								<tr>
									<td><div><?php echo $call_datastuRow["rsd_studentid"];?></div></td>
									<td><div><?php echo $call_datastuRow["rsd_Identification"];?></div></td>
									<td><div><?php echo $cx_myname;?></div></td>
									<td><div><?php echo $txt_level;?></div></td>
									<td><div><?php echo $print_qr_plan->plan_Name;?></div></td>
									<td><div><button type="button" data-toggle="modal" data-target="#Quota_Show_Modal<?php echo $call_datastuRow["rsd_studentid"];?>" class="btn btn-info">ดำเนินการมอบตัว</button></div></td>
								</tr>

									<div id="Quota_Show_Modal<?php echo $call_datastuRow["rsd_studentid"];?>" class="modal fade" tabindex="-1">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-primary">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h6 class="modal-title">มอบตัวนักเรียนโควต้าภายใน ปีการศึกษา <?php echo $next_yaer;?> รหัสนักเรียน <?php echo $call_datastuRow["rsd_studentid"];?></h6>
												</div>

												<div class="modal-body">

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$qr_plan=$quota_rightRow["qr_plan"];
			$studentid=$call_datastuRow["rsd_studentid"];
			$data_yaer=$copy_year;	
		//ข้อมูลนักเรียน 
			$call_sturc=new regina_stu_data($studentid);
		//ระดับชั้น
			$call_stu=new stu_levelpdo($studentid,$data_yaer,"1");
				if(($call_stu->IDLevel==null or $call_stu->IDLevel=="0")){
					$call_stu=new stu_levelpdo($studentid,$data_yaer,"2");		
				}else{}
		?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
				switch ($call_stu->IDLevel){
				case "2":  ?>
				
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<?php 
				$quota_transfer_testSql="SELECT count(`qtt_key`) as `count_qtt` FROM `quota_transfer_test` WHERE`qtt_key`='{$qr_plan}'";
				$quota_transfer_test=new row_quotanotarray($quota_transfer_testSql);
				foreach($quota_transfer_test->print_quotanotarray() as $quota=>$quota_transfer_testRow){
					$count_qtt=$quota_transfer_testRow["count_qtt"];
					if(($count_qtt>=1)){ 
					
						$keep_quota_requestSql="SELECT `qce_key` FROM `quota_request`
												WHERE `request_stuid`='{$studentid}' 
												and `request_year`='{$next_yaer}' 
												and `request_level`='3'";
						$keep_quota_request=new row_quotanotarray($keep_quota_requestSql);
						foreach($keep_quota_request->print_quotanotarray() as $quota=>$keep_quota_requestRow){
							$keep_qce_key=$keep_quota_requestRow["qce_key"];
						}
					
					?>
		<!--////////////////////////////////////////////////////////-->	
		<form name="quota" method="post" action="#" target="_blank">
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-success">
					<div class="row">

		

						<div class="col-<?php echo $grid;?>-4"><h5>นักเรียนที่ประสงค์สมัครสอบย้ายห้องเรียน</h5></div>
						<div class="col-<?php echo $grid;?>-8">
							<div class="form-group">
								<select data-placeholder="เลือกแผนห้องเรียน..." class="select" name="qce_key_<?php echo $call_datastuRow["rsd_studentid"];?>" id="qce_key_<?php echo $call_datastuRow["rsd_studentid"];?>">
									<option></option>
									
							<?php
								if(($keep_qce_key==null)){ ?>
		<!--*******************************************************************************************************************************-->						
										<option value="NO">ไม่ประสงค์สมัครสอบย้ายห้องเรียน</option>
							<?php
								$quota_choose_examSql="SELECT `qce_key`, `qtt_key` FROM `quota_choose_exam` WHERE `qtt_key`='{$qr_plan}';";
								$quota_choose_exam=new row_quotaarray($quota_choose_examSql);
								foreach($quota_choose_exam->print_quotaarray() as $quota_key=>$quota_choose_examRow){
									$qce_key=$quota_choose_examRow["qce_key"];
									$call_plan=new print_plan($qce_key); ?>

										<option value="<?php echo $qce_key;?>"><?php echo $call_plan->plan_Name;?></option>
						<?php	}  ?>						
		<!--*******************************************************************************************************************************-->								
						<?php	}else{ ?>
		<!--*******************************************************************************************************************************-->						
										<option value="NO">ไม่ประสงค์สมัครสอบย้ายห้องเรียน</option>
							<?php
								$quota_choose_examSql="SELECT `qce_key`, `qtt_key` FROM `quota_choose_exam` WHERE `qtt_key`='{$qr_plan}';";
								$quota_choose_exam=new row_quotaarray($quota_choose_examSql);
								foreach($quota_choose_exam->print_quotaarray() as $quota_key=>$quota_choose_examRow){
									$qce_key=$quota_choose_examRow["qce_key"];
									$call_plan=new print_plan($qce_key); 
									if($keep_qce_key==$quota_choose_examRow["qce_key"]){
										$selected_plan="selected";
									}else{
										$selected_plan="";
									}

									?>

										<option value="<?php echo $qce_key;?>" <?php echo $selected_plan;?>><?php echo $call_plan->plan_Name;?></option>
						<?php	}  ?>						
		<!--*******************************************************************************************************************************-->						
						<?php	}?>		
				
										
								</select>
							</div>				
						
						</div>
					</div>


					<div class="row">
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" class="btn btn-success" name="request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>" id="request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>" value="<?php echo $studentid;?>">บันทึกและพิมพ์ใบมอบตัว</button>
						</div>
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" data-dismiss="modal" class="btn btn-warning">กลับ ข้อมูลนักเรียนได้รับสิทธิ์โควต้า</button>
						</div>
					</div>
							<input type="hidden" name="qr_plan_<?php echo $call_datastuRow["rsd_studentid"];?>" id="qr_plan_<?php echo $call_datastuRow["rsd_studentid"];?>" value="<?php echo $qr_plan;?>">

				</div>
			</div>
		</div><br>		
		</form>	
		<!--////////////////////////////////////////////////////////-->	
		<?php		}else{ ?>
		<!--////////////////////////////////////////////////////////-->	
		<form name="quota" method="post" action="#" target="_blank">
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-success">

					<div class="row">
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" class="btn btn-success" name="request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>" id="request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>" value="<?php echo $studentid;?>" >บันทึกและพิมพ์ใบมอบตัว</button>
						</div>
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" data-dismiss="modal" class="btn btn-warning">กลับ ข้อมูลนักเรียนได้รับสิทธิ์โควต้า</button>
						</div>				
					</div>
							<input type="hidden" name="qr_plan_<?php echo $call_datastuRow["rsd_studentid"];?>" id="qr_plan_<?php echo $call_datastuRow["rsd_studentid"];?>" value="<?php echo $qr_plan;?>">
							<input type="hidden" name="qce_key_<?php echo $call_datastuRow["rsd_studentid"];?>" id="qce_key_<?php echo $call_datastuRow["rsd_studentid"];?>" value="NO">

				</div>
			</div>
		</div><br>		
		</form>	
		<!--////////////////////////////////////////////////////////-->					
			<?php	}
				}
			?>
		</form>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php 	break;
				case "3":  ?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php 
				$quota_transfer_testSql="SELECT count(`qtt_key`) as `count_qtt` FROM `quota_transfer_test` WHERE`qtt_key`='{$qr_plan}'";
				$quota_transfer_test=new row_quotanotarray($quota_transfer_testSql);
				foreach($quota_transfer_test->print_quotanotarray() as $quota=>$quota_transfer_testRow){
					$count_qtt=$quota_transfer_testRow["count_qtt"];
					if(($count_qtt>=1)){ 
					
						$keep_quota_requestSql="SELECT `qce_key` FROM `quota_request`
												WHERE `request_stuid`='{$studentid}' 
												and `request_year`='{$next_yaer}' 
												and `request_level`='11'";
						$keep_quota_request=new row_quotanotarray($keep_quota_requestSql);
						foreach($keep_quota_request->print_quotanotarray() as $quota=>$keep_quota_requestRow){
							$keep_qce_key=$keep_quota_requestRow["qce_key"];
						}
					
					?>
		<!--////////////////////////////////////////////////////////-->	
		<form name="quota" method="post" action="#" target="_blank">
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-success">
					<div class="row">

		

						<div class="col-<?php echo $grid;?>-4"><h5>นักเรียนที่ประสงค์สมัครสอบย้ายห้องเรียน</h5></div>
						<div class="col-<?php echo $grid;?>-8">
							<div class="form-group">
								<select data-placeholder="เลือกแผนห้องเรียน..." class="select" name="qce_key_<?php echo $call_datastuRow["rsd_studentid"];?>" id="qce_key_<?php echo $call_datastuRow["rsd_studentid"];?>">
									<option></option>
									
							<?php
								if(($keep_qce_key==null)){ ?>
		<!--*******************************************************************************************************************************-->						
										<option value="NO">ไม่ประสงค์สมัครสอบย้ายห้องเรียน</option>
							<?php
								$quota_choose_examSql="SELECT `qce_key`, `qtt_key` FROM `quota_choose_exam` WHERE `qtt_key`='{$qr_plan}';";
								$quota_choose_exam=new row_quotaarray($quota_choose_examSql);
								foreach($quota_choose_exam->print_quotaarray() as $quota_key=>$quota_choose_examRow){
									$qce_key=$quota_choose_examRow["qce_key"];
									$call_plan=new print_plan($qce_key); ?>

										<option value="<?php echo $qce_key;?>"><?php echo $call_plan->plan_Name;?></option>
						<?php	}  ?>						
		<!--*******************************************************************************************************************************-->								
						<?php	}else{ ?>
		<!--*******************************************************************************************************************************-->						
										<option value="NO">ไม่ประสงค์สมัครสอบย้ายห้องเรียน</option>
							<?php
								$quota_choose_examSql="SELECT `qce_key`, `qtt_key` FROM `quota_choose_exam` WHERE `qtt_key`='{$qr_plan}';";
								$quota_choose_exam=new row_quotaarray($quota_choose_examSql);
								foreach($quota_choose_exam->print_quotaarray() as $quota_key=>$quota_choose_examRow){
									$qce_key=$quota_choose_examRow["qce_key"];
									$call_plan=new print_plan($qce_key); 
									if($keep_qce_key==$quota_choose_examRow["qce_key"]){
										$selected_plan="selected";
									}else{
										$selected_plan="";
									}

									?>

										<option value="<?php echo $qce_key;?>" <?php echo $selected_plan;?>><?php echo $call_plan->plan_Name;?></option>
						<?php	}  ?>						
		<!--*******************************************************************************************************************************-->						
						<?php	}?>		
				
										
								</select>
							</div>				
						
						</div>
					</div>


					<div class="row">
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" class="btn btn-success" name="request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>" id="request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>" value="<?php echo $studentid;?>">บันทึกและพิมพ์ใบมอบตัว</button>
						</div>
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" data-dismiss="modal" class="btn btn-warning">กลับ ข้อมูลนักเรียนได้รับสิทธิ์โควต้า</button>
						</div>
					</div>
							<input type="hidden" name="qr_plan_<?php echo $call_datastuRow["rsd_studentid"];?>" id="qr_plan_<?php echo $call_datastuRow["rsd_studentid"];?>" value="<?php echo $qr_plan;?>">

				</div>
			</div>
		</div><br>		
		</form>	
		<!--////////////////////////////////////////////////////////-->	
		<?php		}else{ ?>
		<!--////////////////////////////////////////////////////////-->	
		<form name="quota" method="post" action="#" target="_blank">
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-success">

					<div class="row">
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" class="btn btn-success" name="request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>" id="request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>" value="<?php echo $studentid;?>" >บันทึกและพิมพ์ใบมอบตัว</button>
						</div>
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" data-dismiss="modal" class="btn btn-warning">กลับ ข้อมูลนักเรียนได้รับสิทธิ์โควต้า</button>
						</div>				
					</div>
							<input type="hidden" name="qr_plan_<?php echo $call_datastuRow["rsd_studentid"];?>" id="qr_plan_<?php echo $call_datastuRow["rsd_studentid"];?>" value="<?php echo $qr_plan;?>">
							<input type="hidden" name="qce_key_<?php echo $call_datastuRow["rsd_studentid"];?>" id="qce_key_<?php echo $call_datastuRow["rsd_studentid"];?>" value="NO">

				</div>
			</div>
		</div><br>		
		</form>	
		<!--////////////////////////////////////////////////////////-->					
			<?php	}
				}
			?>
		</form>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<?php   break;
				case "23": ?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php 
				$quota_transfer_testSql="SELECT count(`qtt_key`) as `count_qtt` FROM `quota_transfer_test` WHERE`qtt_key`='{$qr_plan}'";
				$quota_transfer_test=new row_quotanotarray($quota_transfer_testSql);
				foreach($quota_transfer_test->print_quotanotarray() as $quota=>$quota_transfer_testRow){
					$count_qtt=$quota_transfer_testRow["count_qtt"];
					if($count_qtt>=1){ 
					
						$keep_quota_requestSql="SELECT `qce_key` FROM `quota_request`
												WHERE `request_stuid`='{$studentid}' 
												and `request_year`='{$next_yaer}' 
												and `request_level`='31'";
						$keep_quota_request=new row_quotanotarray($keep_quota_requestSql);
						foreach($keep_quota_request->print_quotanotarray() as $quota=>$keep_quota_requestRow){
							$keep_qce_key=$keep_quota_requestRow["qce_key"];
						}
					
					?>
		<!--////////////////////////////////////////////////////////-->	
		<form name="quota" method="post" action="#" target="_blank">
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-success">
					<div class="row">
						<div class="col-<?php echo $grid;?>-4"><h5>นักเรียนที่ประสงค์สมัครสอบย้ายห้องเรียน</h5></div>
						<div class="col-<?php echo $grid;?>-8">
							<div class="form-group">
								<select data-placeholder="เลือกแผนห้องเรียน..." class="select" name="qce_key_<?php echo $call_datastuRow["rsd_studentid"];?>" id="qce_key_<?php echo $call_datastuRow["rsd_studentid"];?>">
									<option></option>
									
							<?php
								if($keep_qce_key==null){ ?>
		<!--*******************************************************************************************************************************-->						
										<option value="NO">ไม่ประสงค์สมัครสอบย้ายห้องเรียน</option>
							<?php
								$quota_choose_examSql="SELECT `qce_key`, `qtt_key` FROM `quota_choose_exam` WHERE `qtt_key`='{$qr_plan}';";
								$quota_choose_exam=new row_quotaarray($quota_choose_examSql);
								foreach($quota_choose_exam->print_quotaarray() as $quota_key=>$quota_choose_examRow){
									$qce_key=$quota_choose_examRow["qce_key"];
									$call_plan=new print_plan($qce_key); ?>

										<option value="<?php echo $qce_key;?>"><?php echo $call_plan->plan_Name;?></option>
						<?php	}  ?>						
		<!--*******************************************************************************************************************************-->								
						<?php	}else{ ?>
		<!--*******************************************************************************************************************************-->						
										<option value="NO">ไม่ประสงค์สมัครสอบย้ายห้องเรียน</option>
							<?php
								$quota_choose_examSql="SELECT `qce_key`, `qtt_key` FROM `quota_choose_exam` WHERE `qtt_key`='{$qr_plan}';";
								$quota_choose_exam=new row_quotaarray($quota_choose_examSql);
								foreach($quota_choose_exam->print_quotaarray() as $quota_key=>$quota_choose_examRow){
									$qce_key=$quota_choose_examRow["qce_key"];
									$call_plan=new print_plan($qce_key); 
									if($keep_qce_key==$quota_choose_examRow["qce_key"]){
										$selected_plan="selected";
									}else{
										$selected_plan="";
									}

									?>

										<option value="<?php echo $qce_key;?>" <?php echo $selected_plan;?>><?php echo $call_plan->plan_Name;?></option>
						<?php	}  ?>						
		<!--*******************************************************************************************************************************-->						
						<?php	}?>		
				
										
								</select>
							</div>				
						
						</div>
					</div>


					<div class="row">
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" class="btn btn-success" name="request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>" id="request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>" value="<?php echo $studentid;?>">บันทึกและพิมพ์ใบมอบตัว</button>
						</div>
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" data-dismiss="modal" class="btn btn-warning">กลับ ข้อมูลนักเรียนได้รับสิทธิ์โควต้า</button>
						</div>
					</div>
							<input type="hidden" name="qr_plan_<?php echo $call_datastuRow["rsd_studentid"];?>" id="qr_plan_<?php echo $call_datastuRow["rsd_studentid"];?>" value="<?php echo $qr_plan;?>">

				</div>
			</div>
		</div><br>		
		</form>	
		<!--////////////////////////////////////////////////////////-->	
		<?php		}else{ ?>
		<!--////////////////////////////////////////////////////////-->	
		<form name="quota" method="post" action="#" target="_blank">
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-success">

					<div class="row">
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" class="btn btn-success" name="request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>" id="request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>" value="<?php echo $studentid;?>" >บันทึกและพิมพ์ใบมอบตัว</button>
						</div>
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" data-dismiss="modal" class="btn btn-warning">กลับ ข้อมูลนักเรียนได้รับสิทธิ์โควต้า</button>
						</div>				
					</div>
							<input type="hidden" name="qr_plan_<?php echo $call_datastuRow["rsd_studentid"];?>" id="qr_plan_<?php echo $call_datastuRow["rsd_studentid"];?>" value="<?php echo $qr_plan;?>">
							<input type="hidden" name="qce_key_<?php echo $call_datastuRow["rsd_studentid"];?>" id="qce_key_<?php echo $call_datastuRow["rsd_studentid"];?>" value="NO">
				</div>
			</div>
		</div><br>		
		</form>	
		<!--////////////////////////////////////////////////////////-->					
			<?php	}
				}
			?>
		</form>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<?php		
				break;
				case "33": ?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php 
				$quota_transfer_testSql="SELECT count(`qtt_key`) as `count_qtt` FROM `quota_transfer_test` WHERE`qtt_key`='{$qr_plan}'";
				$quota_transfer_test=new row_quotanotarray($quota_transfer_testSql);
				foreach($quota_transfer_test->print_quotanotarray() as $quota=>$quota_transfer_testRow){
					$count_qtt=$quota_transfer_testRow["count_qtt"];
					if($count_qtt>=1){ 
					
						$keep_quota_requestSql="SELECT `qce_key` FROM `quota_request`
												WHERE `request_stuid`='{$studentid}' 
												and `request_year`='{$next_yaer}' 
												and `request_level`='41'";
						$keep_quota_request=new row_quotanotarray($keep_quota_requestSql);
						foreach($keep_quota_request->print_quotanotarray() as $quota=>$keep_quota_requestRow){
							$keep_qce_key=$keep_quota_requestRow["qce_key"];
						}
					
					?>
		<!--////////////////////////////////////////////////////////-->	
		<form name="quota" method="post" action="#" target="_blank">
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-success">
					<div class="row">
						<div class="col-<?php echo $grid;?>-4"><h5>นักเรียนที่ประสงค์สมัครสอบย้ายแผนการเรียน</h5></div>
						<div class="col-<?php echo $grid;?>-8">
							<div class="form-group">
								<select data-placeholder="เลือกแผนการเรียน..." class="select" name="qce_key_<?php echo $call_datastuRow["rsd_studentid"];?>" id="qce_key_<?php echo $call_datastuRow["rsd_studentid"];?>">
									<option></option>
									
							<?php
								if($keep_qce_key==""){ ?>
		<!--*******************************************************************************************************************************-->						
										<option value="NO">ไม่ประสงค์สมัครสอบย้ายแผนการเรียน</option>
							<?php
								$quota_choose_examSql="SELECT `qce_key`, `qtt_key` FROM `quota_choose_exam` WHERE `qtt_key`='{$qr_plan}';";
								$quota_choose_exam=new row_quotaarray($quota_choose_examSql);
								foreach($quota_choose_exam->print_quotaarray() as $quota_key=>$quota_choose_examRow){
									$qce_key=$quota_choose_examRow["qce_key"];
									$call_plan=new print_plan($qce_key); ?>

										<option value="<?php echo $qce_key;?>"><?php echo $call_plan->plan_Name." (".$call_plan->plan_LName.")";?></option>
						<?php	}  ?>						
		<!--*******************************************************************************************************************************-->								
						<?php	}else{ ?>
		<!--*******************************************************************************************************************************-->						
										<option value="NO">ไม่ประสงค์สมัครสอบย้ายแผนการเรียน</option>
							<?php
								$quota_choose_examSql="SELECT `qce_key`, `qtt_key` FROM `quota_choose_exam` WHERE `qtt_key`='{$qr_plan}';";
								$quota_choose_exam=new row_quotaarray($quota_choose_examSql);
								foreach($quota_choose_exam->print_quotaarray() as $quota_key=>$quota_choose_examRow){
									$qce_key=$quota_choose_examRow["qce_key"];
									$call_plan=new print_plan($qce_key); 
									if($keep_qce_key==$quota_choose_examRow["qce_key"]){
										$selected_plan="selected";
									}else{
										$selected_plan="";
									}

									?>

										<option value="<?php echo $qce_key;?>" <?php echo $selected_plan;?>><?php echo $call_plan->plan_Name." (".$call_plan->plan_LName.")";?></option>
						<?php	}  ?>						
		<!--*******************************************************************************************************************************-->						
						<?php	}?>		
				
										
								</select>
							</div>				
						
						</div>
					</div>


					<div class="row">
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" class="btn btn-success" name="request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>" id="request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>" value="<?php echo $studentid;?>" >บันทึกและพิมพ์ใบมอบตัว</button>
						</div>
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" data-dismiss="modal" class="btn btn-warning">กลับ ข้อมูลนักเรียนได้รับสิทธิ์โควต้า</button>
						</div>				
					</div>
							<input type="hidden" name="qr_plan_<?php echo $call_datastuRow["rsd_studentid"];?>" id="qr_plan_<?php echo $call_datastuRow["rsd_studentid"];?>" value="<?php echo $qr_plan;?>">

				</div>
			</div>
		</div><br>		
		</form>	
		<!--////////////////////////////////////////////////////////-->	
		<?php		}else{ ?>
		<!--////////////////////////////////////////////////////////-->	
		<form name="quota" method="post" action="#" target="_blank">
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-success">

					<div class="row">
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" class="btn btn-success" name="request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>" id="request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>"  value="<?php echo $studentid;?>" >บันทึกและพิมพ์ใบมอบตัว</button>
						</div>
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" data-dismiss="modal" class="btn btn-warning">กลับ ข้อมูลนักเรียนได้รับสิทธิ์โควต้า</button>
						</div>				
					</div>
							<input type="hidden" name="qr_plan_<?php echo $call_datastuRow["rsd_studentid"];?>" value="<?php echo $qr_plan;?>">
							<input type="hidden" name="qce_key_<?php echo $call_datastuRow["rsd_studentid"];?>" value="NO">
				</div>
			</div>
		</div><br>		
		</form>	
		<!--////////////////////////////////////////////////////////-->					
			<?php	}
				}
			?>
		</form>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<?php			
				break;
				default: ?>
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-danger">
					ไม่มีสิทธิ์เข้าถึงหน้านี้
				</div>		
			</div>
		</div>	
		<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php 	} ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<script>
		$(document).ready(function (){
			$("#request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>").on("click",function (){
				var RcYear="<?php echo $data_yaer;?>";
				var RcId=$("#request_stuid_<?php echo $call_datastuRow["rsd_studentid"];?>").val();
				var Rc_qr_plan=$("#qr_plan_<?php echo $call_datastuRow["rsd_studentid"];?>").val();
				var Rc_qce_key=$("#qce_key_<?php echo $call_datastuRow["rsd_studentid"];?>").val();
					if(RcId!==""){
						if(Rc_qce_key===""){
							window.open('<?php echo $golink;?>/quota_print/print_quota_admin/'+RcYear+'/'+RcId+'/'+Rc_qr_plan+'/NO','_blank');
						}else{
							window.open('<?php echo $golink;?>/quota_print/print_quota_admin/'+RcYear+'/'+RcId+'/'+Rc_qr_plan+'/'+Rc_qce_key,'_blank');	
						}
					}else{}
			})
		})
	</script>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

												</div>

												<div class="modal-footer">
													<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>								

	<?php		}else{}
			}

			
		}
		
	?>

							</tbody>
						</table>			
			
			</div>
		</div>
	</div>
</div>