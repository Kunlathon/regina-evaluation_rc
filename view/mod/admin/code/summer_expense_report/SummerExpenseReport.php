<?php
	$txt_year=filter_input(INPUT_POST,'txt_year');
		if(isset($txt_year)){ ?>
	<?php
		include("../../../../database/pdo_data.php");
		include("../../../../database/class_admin.php");	
		include("../../../../database/pdo_summer.php");
		include("../../../../database/class_summer.php");
		include("../../../../database/pdo_conndatastu.php");
		include("../../../../database/pdo_admission.php");
		include("../../../../database/regina_stusent.php");
	//--------------------------------------------------------------------    
		include("../../../../img_user/document/gotolink.php");//-----------------
		$goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
		$golink=$goingtolink->Rungotolink();//----------------------------
	//--------------------------------------------------------------------	
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
		$(document).ready(function () {
			// Setting datatable defaults
			$.extend( $.fn.dataTable.defaults, {
				autoWidth: false,
				dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
				language: {
					search: '<span>ค้นหา:</span> _INPUT_',
					searchPlaceholder: 'พิมพ์เพื่อค้นหาที่นี้...',
					lengthMenu: '<span>แสดง:</span> _MENU_',
					paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
				}
			});		

			$('.datatable-button-html5-columnsA').DataTable({
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
							filename: 'รายงานผู้ชำระค่าการเรียนการสอน กิจกรรมเรียนเสริมภาคฤดูร้อน (รายชื่อผู้ชำระ) <?php echo $txt_year;?>',
							title: 'รายงานผู้ชำระค่าการเรียนการสอน กิจกรรมเรียนเสริมภาคฤดูร้อน (รายชื่อผู้ชำระ) <?php echo $txt_year;?>',
							exportOptions: {
								columns: ':visible'
							}
						}
					]
				},
					"paging"       : true,
					"lengthChange" : true,
					"searching"    : true,
					"ordering"     : true,
					"info"         : true,
					"autoWidth"    : true,
					
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
			
			$('.datatable-button-html5-columnsB').DataTable({
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
							filename: 'รายงานผู้ชำระค่าการเรียนการสอน กิจกรรมเรียนเสริมภาคฤดูร้อน (รายชื่อผู้ยังไม่ได้ชำระ) <?php echo $txt_year;?>',
							title: 'รายงานผู้ชำระค่าการเรียนการสอน กิจกรรมเรียนเสริมภาคฤดูร้อน (รายชื่อผู้ยังไม่ได้ชำระ) <?php echo $txt_year;?>',
							exportOptions: {
								columns: ':visible'
							}
						}
					]
				},
					"paging"       : true,
					"lengthChange" : true,
					"searching"    : true,
					"ordering"     : true,
					"info"         : true,
					"autoWidth"    : true,
					
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
	
	<!--****************************************************************************-->			
		<?php
			$PrintDataSumSummer=new DataSumSummer($txt_year);
		?>
	<div class="row">
		
			<?php
					$count_rcp=0;
					foreach($PrintDataSumSummer->Runcount_paying() as $rc=>$Runcount_payingRow){ 
						$count_rcp=$count_rcp+$Runcount_payingRow["count_pay"];
					?>
					
		<div class="col-<?php echo $grid;?>-3">
			<h6 class="content-group text-semibold">
				<div><?php echo $Runcount_payingRow["RMD_txt"];?></div>
				<div></div>
			</h6>
			<div class="panel panel-body border-top-orange">
				<div style="font-size: 20px; font-weight: bold; color:#006400;"><center><?php echo $Runcount_payingRow["count_pay"];?></center></div>
			</div>
		</div>	
		
			<?php 	} ?>
			
		<div class="col-<?php echo $grid;?>-3">
			<h6 class="content-group text-semibold">
				<div>ยอดรวมผู้ลงทะเบียนทั้งหมด</div>
				<div></div>
			</h6>		
			<div class="panel panel-body border-top-orange">
				<div style="font-size: 20px; font-weight: bold; color:#800080;"><center><?php echo $count_rcp;?></center></div>
			</div>
		</div>	
		
		<div class="col-<?php echo $grid;?>-3">
			<h6 class="content-group text-semibold">
				<div>ยอดรวมค่าเรียนเสริมภาคฤดูร้อนทั้งหมด</div>
				<div></div>
			</h6>		
			<div class="panel panel-body border-top-orange">
				<div style="font-size: 20px; font-weight: bold; color:#800080;"><center><?php echo number_format($PrintDataSumSummer->Runsum_pay(), 2, '.', ',');?></center></div>
			</div>
		</div>
	</div>
			
	<div class="row">
		<div class="col-<?php echo $grid;?>-6">
			<h6 class="content-group text-semibold">
				รายชื่อผู้ชำระ
			</h6>		
			<div class="panel panel-body border-top-orange">
				
				<div class="table-responsive">
					<table class="table datatable-button-html5-columnsA">
						<thead>
							<tr>
								<th><div>รหัสนักเรียน</div></th>
								<th><div>ชื่อ-นามสกุล</div></th>
								<th><div>ชั้น</div></th>
								<th><div>กิจกรรมเสริมทักษะตามความถนัดและความสนใจ</div></th>
								<th><div>จำนวนเงิน</div></th>
							</tr>
						</thead>
						<tbody>
					<?php
							$SumPayAllB=0;
							foreach($PrintDataSumSummer->RunB_paying() as $rc=>$RunB_paying){ 
							
								$SummerData=new PrintSummerData($RunB_paying["rs_key"],$txt_year); 
								$stu_pay_p=0;
								foreach($SummerData->RunPrintSummerData() as $rc=>$SummerDataRow){
									$stu_pay_p=$stu_pay_p+$SummerDataRow["RSP_price"];
								}
								
							$ReginaStuData=new regina_stu_data4($RunB_paying["rs_key"],$txt_year,'1');
								if(isset($ReginaStuData->rsd_studentid)){
									if($ReginaStuData->sd_prefix=="2"){
										$myname="เด็กหญิง ".$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
									}elseif($ReginaStuData->sd_prefix=="4"){
										$myname="นางสาว ".$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
									}else{
										$myname=$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
									}
										$class_txt=$ReginaStuData->Sort_name;
								}else{
									$StudentData=new DataRsStudentDataA($RunB_paying["rs_key"],$txt_year);
										if(isset($StudentData->RSDKey)){
											$ClassAdmin=new LavaLClassAdmin($StudentData->RSDClass);
											$myname=$StudentData->mynameTh;
											$class_txt=$ClassAdmin->RunPrintLavaL();
										}else{}
								}
								

								
							?>
							
							<tr>
								<td><div><?php echo $RunB_paying["rs_key"];?></div></td>
								<td><div><?php echo $myname;?></div></td>
								<td><div><?php echo $class_txt;?></div></td>

						<?php 
								$Data_Summer=new PrintSummerData($RunB_paying["rs_key"],$txt_year);
									foreach($Data_Summer->RunPrintSummerData() as $rc=>$Data_SummerRow){
										if(($Data_SummerRow["RST_on"])==1){ ?>
								<td><div><?php echo $Data_SummerRow["RSD_txtTh"];?></div></td>												
						<?php			}else{}
									} ?>

								<td><div><?php echo number_format($stu_pay_p, 2, '.', ',');?></div></td>
							</tr>		
							
					<?php	$SumPayAllB=$SumPayAllB+$stu_pay_p;}?>	
						
						</tbody>
					</table>
				</div>
				<br>
				<div><div>รวมทั้งหมด &nbsp;(รายชื่อผู้ชำระ)&nbsp;:&nbsp;<?php echo number_format($SumPayAllB, 2, '.', ',');?>&nbsp;</div> </div>
			</div>		
		</div>
		<div class="col-<?php echo $grid;?>-6">
			<h6 class="content-group text-semibold">
				รายชื่อผู้ยังไม่ได้ชำระ
			</h6>		
			<div class="panel panel-body border-top-orange">

				<div class="table-responsive">
					<table class="table datatable-button-html5-columnsB">
						<thead>
							<tr>
								<th><div>รหัสนักเรียน</div></th>
								<th><div>ชื่อ-นามสกุล</div></th>
								<th><div>ชั้น</div></th>
								<th><div>กิจกรรมเสริมทักษะตามความถนัดและความสนใจ</div></th>
								<th><div>จำนวนเงิน</div></th>
							</tr>
						</thead>
						<tbody>
						<?php
								$SumPayAllA=0;
								foreach($PrintDataSumSummer->RunA_paying() as $rc=>$RunA_paying){ 
									$SummerData=new PrintSummerData($RunA_paying["rs_key"],$txt_year); 
									$stu_pay_p=0;
									foreach($SummerData->RunPrintSummerData() as $rc=>$SummerDataRow){
										$stu_pay_p=$stu_pay_p+$SummerDataRow["RSP_price"];
									}
									
									$ReginaStuData=new regina_stu_data4($RunA_paying["rs_key"],$txt_year,'1');
										if(isset($ReginaStuData->rsd_studentid)){
											if($ReginaStuData->sd_prefix=="2"){
												$myname="เด็กหญิง ".$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
											}elseif($ReginaStuData->sd_prefix=="4"){
												$myname="นางสาว ".$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
											}else{
												$myname=$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
											}
												$class_txt=$ReginaStuData->Sort_name;
										}else{
											$StudentData=new DataRsStudentDataA($RunA_paying["rs_key"],$txt_year);
												if(isset($StudentData->RSDKey)){
													$ClassAdmin=new LavaLClassAdmin($StudentData->RSDClass);
													$myname=$StudentData->mynameTh;
													$class_txt=$ClassAdmin->RunPrintLavaL();
												}else{}
										}	
								
									
								?>
								
							<tr>
								<td><?php echo $RunA_paying["rs_key"];?></td>
								<td><?php echo $myname;?></td>
								<td><?php echo $class_txt;?></td>

						<?php 
								$Data_Summer=new PrintSummerData($RunA_paying["rs_key"],$txt_year);
									foreach($Data_Summer->RunPrintSummerData() as $rc=>$Data_SummerRow){
										if(($Data_SummerRow["RST_on"])==1){ ?>
								<td><div><?php echo $Data_SummerRow["RSD_txtTh"];?></div></td>												
						<?php			}else{}
									} ?>

								<td><?php echo number_format($stu_pay_p, 2, '.', ',');?></td>
							</tr>		
								
						<?php	$SumPayAllA=$SumPayAllA+$stu_pay_p;}?>						
						</tbody>
					</table>
				</div>
				<br>
				<div>รวมทั้งหมด &nbsp;(รายชื่อผู้ยังไม่ได้ชำระ)&nbsp;:&nbsp;<?php echo number_format($SumPayAllA, 2, '.', ',');?>&nbsp;</div>
			</div>		
		</div>
	</div>
			
			
<?php	}else{}?>









