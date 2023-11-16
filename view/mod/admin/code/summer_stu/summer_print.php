<?php
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");
	include("../../../../database/pdo_summer.php");
	include("../../../../database/class_summer.php");		
?>

<?php
	$txtyear=filter_input(INPUT_POST,'txtyear');
	$txtclass=filter_input(INPUT_POST,'txtclass');
	$txtssubject=filter_input(INPUT_POST,'txtssubject');
		if(isset($txtyear,$txtclass,$txtssubject)){	
//----------------------------------------------------------
			$DataClass=new print_level($txtclass);
			$NameSubjectData=new NameRsSubjectData($txtssubject,$txtyear);
//----------------------------------------------------------		
		?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<script>
		$(document).ready(function (){


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
						filename: 'กิจกรรมเรียนเสริมภาคฤดูร้อน : <?php echo $NameSubjectData->RSD_txtTh;?> ระดับชั้น <?php echo $DataClass->level_Lname;?> ปีการศึกษา <?php echo $txtyear;?>',
						title: 'กิจกรรมเรียนเสริมภาคฤดูร้อน : <?php echo $NameSubjectData->RSD_txtTh;?> ระดับชั้น <?php echo $DataClass->level_Lname;?> ปีการศึกษา <?php echo $txtyear;?>',
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

		})
	</script>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-violet">
				<div class="table-responsive">
					<table class="table datatable-button-html5-columns">
						<thead>
							<tr>
								<th><div>เลขประจำตัวนักเรียน</div></th>
								<th><div>เลขประชาชน</div></th>
								<th><div>ชื่อ-สกุล</div></th>
								<th><div>ระดับชั้น</div></th>
								<th><div>เลขที่</div></th>
								<th><div>ห้อง</div></th>
								<th><div>โรงเรียน</div></th>
							</tr>
						</thead>
						<tbody>
						
		<?php
			$MoneyPaySummer=new PrintMoneyPaySummer($txtssubject,$txtyear);
			foreach($MoneyPaySummer->RunPrintMoneyPaySummer() as $rc=>$MoneyPaySummerRow){
//-------------------------------------------------------------------------------------------------------				
				$ReginaStuData=new regina_stu_data2($MoneyPaySummerRow['rs_key'],$txtyear,'1',$txtclass);
					if(isset($ReginaStuData->rsd_studentid)){
						if($ReginaStuData->sd_prefix=="2"){
							$myname="เด็กหญิง ".$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
						}elseif($ReginaStuData->sd_prefix=="4"){
							$myname="นางสาว ".$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
						}else{
							$myname=$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
						}
						?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
							<tr>
								<td><div><?php echo $ReginaStuData->rsd_studentid;?></div></td>
								<td><div><?php echo $ReginaStuData->rsd_Identification;?></div></td>
								<td><div><?php echo $myname;?></div></td>
								<td><div><?php echo $ReginaStuData->Sort_name;?></div></td>
								<td><div><?php echo $ReginaStuData->rsc_num;?></div></td>
								<td><div><?php echo $ReginaStuData->rsc_room;?></div></td>
								<td><div>เรยีนาเชลีวิทยาลัย</div></td>
							</tr>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}else{
						$StudentData=new DataRsStudentData($MoneyPaySummerRow['rs_key'],$txtyear,$txtclass);
							if(isset($StudentData->RSDKey)){
								$ClassAdmin=new LavaLClassAdmin($StudentData->RSDClass);

								?>
							<tr>
								<td><div><?php echo $StudentData->RSDKey;?></div></td>
								<td><div><?php echo $StudentData->RSDIDnumber;?></div></td>
								<td><div><?php echo $StudentData->mynameTh;?></div></td>
								<td><div><?php echo $ClassAdmin->RunPrintLavaL();?></div></td>
								<td><div>0</div></td>
								<td><div>0</div></td>
								<td><div><?php echo $StudentData->RSDSchool;?></div></td>
							</tr>								
			<?php			}else{}
					}
//-------------------------------------------------------------------------------------------------------				
				
				
			}?>						
						

						</tbody>
					</table>			
				</div>
			</div>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}else{}?>

