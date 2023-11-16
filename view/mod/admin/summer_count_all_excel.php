<?php
	include("view/database/pdo_data.php");
	include("view/database/pdo_conndatastu.php");
	include("view/database/pdo_admission.php");
	include("view/database/regina_student.php");
	
	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">กิจกรรมเรียนเสริมภาคฤดูร้อน&nbsp;>&nbsp;</span>ข้อมูลยอดผู้ลงทะเบียน&nbsp;/&nbsp;(รวมตามกลุ่มช่วงชั้น)&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>&nbsp;ข้อมูลยอดผู้ลงทะเบียน&nbsp;/&nbsp;(รวมตามกลุ่มช่วงชั้น)&nbsp;</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

	<?php
		$RSCAExcel_RgId=filter_input(INPUT_POST,"RSCAExcel_no");
		$RSCAExcel_Year=filter_input(INPUT_POST,"RSCAExcel_Year");
		$RSCAExcel_txt=filter_input(INPUT_POST,"RSCAExcel_txt");
		$RSCAExcel_level=filter_input(INPUT_POST,"RSCAExcel_level");
		
			if((isset($RSCAExcel_RgId,$RSCAExcel_Year))){
					switch($RSCAExcel_level){
						case "3":
							$Level_Txt="อนุบาล 3";
							$LeveL_ClassA=3;
							$LeveL_ClassB=3;
						break;
						case "11":
							$Level_Txt="ประถมศึกษาปีที่ 1";
							$LeveL_ClassA=11;
							$LeveL_ClassB=11;							
						break;
						case "12-23":
							$Level_Txt="ประถมศึกษาปีที่ 2 ถึง 6";
							$LeveL_ClassA=12;
							$LeveL_ClassB=23;							
						break;						
						case "31-33":
							$Level_Txt="มัธยมศึกษาปีที่ 1 ถึง 3";
							$LeveL_ClassA=31;
							$LeveL_ClassB=33;							
						break;						
						case "41-43":
							$Level_Txt="มัธยมศึกษาปีที่ 4 ถึง 6";
							$LeveL_ClassA=41;
							$LeveL_ClassB=43;							
						break;						
						default:
							$Level_Txt=null;
					}
				?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
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
						filename: '<?php echo $RSCAExcel_txt." ระดับชั้น ".$Level_Txt." ปีการศึกษา ".$RSCAExcel_Year;?>',
						title: '<?php echo $RSCAExcel_txt." ระดับชั้น ".$Level_Txt." ปีการศึกษา ".$RSCAExcel_Year;?>',
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
					"searching"    : true,
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
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-violet">
					<h6 class="content-group text-semibold">
						<?php echo $RSCAExcel_txt;?>&nbsp;
						<small class="display-block"><?php echo "ระดับชั้น ".$Level_Txt." ปีการศึกษา ".$RSCAExcel_Year?></small>
					</h6>		
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-violet">
					<div class="table-responsive">
						<table class="table datatable-button-html5-columns">
							<thead>
								<tr>
									<th><div>เลขประจำตัวนักเรียน</div></th>
									<th><div>ชื่อ-สกุลภาษาไทย</div></th>
									<th><div>ชื่อ-สกุลภาษาอังกฤษ</div></th>
									<th><div>ระดับชั้น</div></th>
									<th><div>เลขที่</div></th>
									<th><div>ห้อง</div></th>
									<th><div>โรงเรียน</div></th>
								</tr>
							</thead>
							<tbody>

		<?php
			$PrintSubjectKey=new PrintRsSubjectGJ("join",$LeveL_ClassA,$LeveL_ClassB,$RSCAExcel_Year,$RSCAExcel_RgId);
				foreach($PrintSubjectKey->RunSubjectGJ_Print() as $rc=>$PrintSubjectKeyRow){

					$MoneyPaySummer=new PrintMoneyPaySummer($PrintSubjectKeyRow["RSD_no"],$RSCAExcel_Year);
					foreach($MoneyPaySummer->RunPrintMoneyPaySummer() as $rc=>$MoneyPaySummerRow){ 
					
						$ReginaStuData=new PrintReginaStuDataClass($MoneyPaySummerRow['rs_key']);
							if((isset($ReginaStuData->PRS_SudId))){
								$StudentId=$ReginaStuData->PRS_SudId;
								$Myname=$ReginaStuData->PRS_nameTH;
								$MynameEN=$ReginaStuData->PRS_nameEH;
								
								$Sud_Class=new RcClassStudenYear("NokeyClassA",$StudentId,"1",$RSCAExcel_Year,$RSCAExcel_level);
								foreach($Sud_Class->RunRcClassStudent() as $rc=>$Sud_ClassRow){
									$Call_Class=new PrintLavaL($Sud_ClassRow["rsc_class"]);
									$TheClass=$Call_Class->RunPrintLavaL();	
									$TheNumber=$Sud_ClassRow["rsc_num"];
									$TheRoom=$Sud_ClassRow["rsc_room"];
									$TheSchool="โรงเรียนเรยีนาเชลีวิทยาลัย";										
								}
								
							}else{
								$StudentData=new DataRsStudentData2($MoneyPaySummerRow['rs_key'],$RSCAExcel_Year);
									if(isset($StudentData->RSDKey)){
										$StudentId=$StudentData->RSDKey;
										$Myname=$StudentData->mynameTh;
										$MynameEN=$StudentData->mynameEh;	
										$TheClass=0;	
										$TheNumber=0;
										$TheRoom=0;
										$TheSchool=$StudentData->RSDSchool;
									}else{
										$StudentId="-";
										$Myname="-";
										$MynameEN="-";
										$TheClass="-";	
										$TheNumber="-";
										$TheRoom="-";
										$TheSchool="-";										
									}
							}
					?>
					
								<tr>
									<td><div><?php echo $StudentId;?></div></td>
									<td><div><?php echo $Myname;?></div></td>
									<td><div><?php echo $MynameEN?></div></td>
									<td><div><?php echo $TheClass;?></div></td>
									<td><div><?php echo $TheNumber;?></div></td>
									<td><div><?php echo $TheRoom;?></div></td>
									<td><div><?php echo $TheSchool;?></div></td>
								</tr>					
					
			<?php	} ?>
						
		<?php	} ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<button type="button" id="asj_go" class="btn btn-warning">ย้อนกลับไป</button>
			</div>
		</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{}?>





