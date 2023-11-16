<?php
	include("../../../../database/pdo_quota.php");
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_quota.php");
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

<?php
	$copy_year=filter_input(INPUT_POST,'copy_year');
	$copy_level=filter_input(INPUT_POST,'copy_level');
	$stx_year=$copy_year+1;
	
			switch($copy_level){
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
					                <th>เลขประจำตัวนักเรียน</th>
					                <th>เลขประจำตัวประชาชน</th>
					                <th>ชื่อ-สกุล</th>
					                <th>ระดับชั้นที่ได้โควต้า</th>
					                <th>แผนการเรียนที่ได้</th>
					                <th>เอกสารมอบตัว</th>
					            </tr>
							</thead>
							<tbody>
							
	<?php
			if(($copy_level==3)){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
						$call_datasturc=new print_datasturc_dts($copy_year,$copy_level);
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
								error_reporting(error_reporting() & ~E_NOTICE);
								if($quota_rightRow["qr_stuid"]!=""){
										if(($quota_rightRow["qr_level"]==3)){
											$txt_level="อนุบาล 3";
										}elseif(($quota_rightRow["qr_level"]==11)){
											$txt_level="ประถมศึกษาปีที่ 1";
										}elseif($quota_rightRow["qr_level"]==31){
											$txt_level="มัธยมศึกษาปีที่ 1";
										}elseif($quota_rightRow["qr_level"]==41){
											$txt_level="มัธยมศึกษาปีที่ 4";
										}elseif($quota_rightRow["qr_level"]==11){
											$txt_level="ประถมศึกษาปีที่ 1";
										}else{
											$txt_level="-";
										}
											
										//$print_qr_level=new ($quota_rightRow["qr_level"]);
										$print_qr_plan=new  print_plan($quota_rightRow["qr_plan"]);
										//$key_qr_plan=base64_encode($quota_rightRow["qr_plan"]);
										//$key_studentid=base64_encode($call_datastuRow["rsd_studentid"]);

									?>
						
								<tr>
									<td><div><?php echo $call_datastuRow["rsd_studentid"];?></div></td>
									<td><div><?php echo $call_datastuRow["rsd_Identification"];?></div></td>
									<td><div><?php echo $cx_myname;?></div></td>
									<td><div><?php echo $txt_level;?></div></td>
									<td><div><?php echo $print_qr_plan->plan_Name;?></div></td>
									<td><div>
									
<form name="quota_show<?php echo $count;?>" id="quota_show<?php echo $count;?>" action="./?evaluation_mod=admin_quota" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
										
	<input type="hidden" name="qr_plan" value="<?php echo $quota_rightRow["qr_plan"];?>">
	<input type="hidden" name="studentid" value="<?php echo $call_datastuRow["rsd_studentid"];?>">
	<input type="hidden" name="data_yaer" value="<?php echo $copy_year;?>">
										<button type="submit" class="btn btn-success btn-xs">พิมพ์ใบมอบตัว</button>
</form>									
										</div>
									</td>
								</tr>	
						
						<?php	}else{
									//******************************
								}
							}
							$count=$count+1;
						}   ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
						$call_datasturc=new print_datasturc($copy_year,$copy_level);
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
								error_reporting(error_reporting() & ~E_NOTICE);
								if($quota_rightRow["qr_stuid"]!=""){

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
										//$key_studentid=base64_encode($call_datastuRow["rsd_studentid"]);

									?>
						
								<tr>
									<td><div><?php echo $call_datastuRow["rsd_studentid"];?></div></td>
									<td><div><?php echo $call_datastuRow["rsd_Identification"];?></div></td>
									<td><div><?php echo $cx_myname;?></div></td>
									<td><div><?php echo $txt_level;?></div></td>
									<td><div><?php echo $print_qr_plan->plan_Name;?></div></td>
									<td><div>
									
<form name="quota_show<?php echo $count;?>" id="quota_show<?php echo $count;?>" action="./?evaluation_mod=admin_quota" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
										
	<input type="hidden" name="qr_plan" value="<?php echo $quota_rightRow["qr_plan"];?>">
	<input type="hidden" name="studentid" value="<?php echo $call_datastuRow["rsd_studentid"];?>">
	<input type="hidden" name="data_yaer" value="<?php echo $copy_year;?>">
										<button type="submit" class="btn btn-success btn-xs">พิมพ์ใบมอบตัว</button>
</form>									
										</div>
									</td>
								</tr>	
						
						<?php	}else{
									//******************************
								}
							}
							$count=$count+1;
						}   ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<?php
						$call_datasturc=new print_datasturc($copy_year,$copy_level);
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
								error_reporting(error_reporting() & ~E_NOTICE);
								if($quota_rightRow["qr_stuid"]!=""){

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
										//$key_studentid=base64_encode($call_datastuRow["rsd_studentid"]);

									?>
						
								<tr>
									<td><div><?php echo $call_datastuRow["rsd_studentid"];?></div></td>
									<td><div><?php echo $call_datastuRow["rsd_Identification"];?></div></td>
									<td><div><?php echo $cx_myname;?></div></td>
									<td><div><?php echo $txt_level;?></div></td>
									<td><div><?php echo $print_qr_plan->plan_Name;?></div></td>
									<td><div>
									
<form name="quota_show<?php echo $count;?>" id="quota_show<?php echo $count;?>" action="./?evaluation_mod=admin_quota" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
										
	<input type="hidden" name="qr_plan" value="<?php echo $quota_rightRow["qr_plan"];?>">
	<input type="hidden" name="studentid" value="<?php echo $call_datastuRow["rsd_studentid"];?>">
	<input type="hidden" name="data_yaer" value="<?php echo $copy_year;?>">
										<button type="submit" class="btn btn-success btn-xs">พิมพ์ใบมอบตัว</button>
</form>									
										</div>
									</td>
								</tr>	
						
						<?php	}else{
									//******************************
								}
							}
							$count=$count+1;
						}   ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php	} ?>


						
							</tbody>
						</table>			
			
			</div>
		</div>
	</div>
</div>