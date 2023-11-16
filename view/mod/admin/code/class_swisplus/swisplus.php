<?php
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");
	include("../../../../database/regina_student.php");
		
?>
	<script>
		$(document).ready(function () {
			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-violet-400'
			});				
		})
	</script>
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
<!--****************************************************************************-->
	<?php
		$data_year=filter_input(INPUT_POST,'txtyear');
		$data_class=filter_input(INPUT_POST,'txtclass');
		$txt_date=filter_input(INPUT_POST,'txtdate');
			if(isset($data_year,$data_class,$txt_date)){	
//---------------------------------------------------------------------------------
				$DataClass=new print_level($data_class);
				$PrintStuRc=new PrintReginaYearClass3($data_year,1,$data_class);
				$CopyYear=substr($txt_date,6);
				$CopyYear=$CopyYear+543;
				$CopyM=substr($txt_date,3,2);
				$CopyD=substr($txt_date,0,2);
				$DateTime=$CopyD."/".$CopyM."/".$CopyYear;
//---------------------------------------------------------------------------------		
		?>
<!--****************************************************************************-->	
	<script>
		$(document).ready(function (){

			$.extend( $.fn.dataTable.defaults, {
				autoWidth: false,
				dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
				language: {
					search: '<span>ค้นหา:</span> _INPUT_',
					searchPlaceholder: 'พิมพ์เพื่อค้นหา...',
					lengthMenu: '<span>Show:</span> _MENU_',
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
							filename: 'Into Data to SWIS System นักเรียน เข้าห้องเรียน ชั้น <?php echo $DataClass->level_Sort_name;?> ปีการศึกษา <?php echo $CopyYear;?>',
							title: 'Into Data to SWIS System นักเรียน เข้าห้องเรียน ชั้น <?php echo $DataClass->level_Sort_name;?> ปีการศึกษา <?php echo $CopyYear;?>',
							exportOptions: {
								columns: ':visible'
							}
						}
					]
				},
					"paging"       : false,
					"lengthChange" : false,
					"searching"    : true,
					"ordering"     : false,
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
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<h6 class="content-group text-semibold">
			ข้อมูลนักเรียน เข้าห้องเรียน&nbsp;<?php echo $DataClass->level_Lname;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_year;?>&nbsp;
			<small class="display-block">ข้อมูลจะแสดงตามระดับชั้นเรียน</small>
		</h6>
	</div>
</div>
<div class="row">
	<div class="col-<?php echo $grid; ?>-12">
		<div class="panel panel-body border-top-violet">
			<div class="table-responsive">
				<table class="table datatable-button-html5-columns">
					<thead>
						<tr>
							<th><div>รหัสประจำตัว</div></th>
							<th><div>ห้อง</div></th>
							<th><div>เลขที่</div></th>
							<th><div>วันที่เข้าห้องเรียน(19/05/2654) จัดรูปแบบเซล ให้เป็นข้อความ</div></th>
							<th><div>รหัสแผน</div></th>
						</tr>
					</thead>
					<tbody>
		
		<?php
				foreach($PrintStuRc->RunReginaStuClass() as $rc=>$PrintStuRcRow){
					$PrintPlan=new print_plan($PrintStuRcRow["rsc_plan"]);

					?>
				
						<tr>
							<td><div class="text-semibold" style="color:DodgerBlue; color:#D2691E;"><?php echo $PrintStuRcRow["rsd_studentid"];?></div></td>
							<td><div class="text-semibold" style="color:DodgerBlue; color:#006400;"><b><?php echo $PrintStuRcRow["rsc_room"];?></b></div></td>
							<td><div class="text-semibold" style="color:DodgerBlue; color:#FFA500;"><b><?php echo $PrintStuRcRow["rsc_num"];?></b></div></td>
							<td><div class="text-semibold" style="color:DodgerBlue; color:#FF4500;"><b><?php echo $DateTime;?></b></div></td>
							<td><div class="text-semibold" style="color:DodgerBlue; color:#FF4500;"><b><?php echo $PrintPlan->plan_SwipKey;?></b></div></td>
						</tr>	
						
		<?php	} ?>


					</tbody>
				</table>
			</div>		
		</div>
	</div>
</div>			
<!--****************************************************************************-->			
<?php		}else{}?>
