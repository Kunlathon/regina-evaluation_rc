<?php
	//Develop By Kunlathon Saowakhon
	//พัฒนาเว็บไซต์โดย นายกุลธร เสาวคนธ์
	//Tel 0932670639
	//โทร 0932670639
	//Email: mpamese.pc2001@gmail.com , missing_yrc2014@hotmail.com
	//ห้ามใช้ /**/ จะส่งผลให้ค่า return js ทำงานผิดปกติ !!
?>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------	        
        include("view/database/pdo_data.php");
        include("view/database/class_admin.php");
        include("view/database/pdo_summer.php");
        include("view/database/class_summer.php");       
//--------------------------------------------------------------------
//--------------------------------------------------------------------
	if($this->session->userdata("rc_user")==null){
		$this->session->unset_userdata("rc_user");
		exit("<script>window.location='$golink/print_imgstu/error';</script>");		
	}else{
		$LoginKey=$this->session->userdata("rc_user");
		$admin_log=$this->load->database("default",TRUE);		
		$admin_log=$this->db->query("SELECT COUNT(`login_id`) AS `int_uesr` FROM `login` WHERE `use_status`='1' AND `login_id`='{$LoginKey}'");
		foreach($admin_log->result_array() as $log_row){
			if(($log_row["int_uesr"]>=1)){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
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
		if(($width_system>=1200)){
			$grid="lg";
		}elseif(($width_system<=992)){
			$grid="md";
		}elseif(($width_system<=768)){
			$grid="sm";
		}else{
			$grid="xs";
		}
    ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$load_year=filter_input(INPUT_POST,'load_year');
		$load_class=filter_input(INPUT_POST,'load_class');
		$load_subject=filter_input(INPUT_POST,'load_subject');
		$load_user=filter_input(INPUT_POST,'load_user');
	?>


<script>
		$(document).ready(function (){

		var js_year="<?php echo $load_year;?>";
		var js_subject="<?php echo $load_subject;?>";

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
						filename: 'ไฟส์อัพโหลดคะแนน / วัดและประเมินผล Summer ปีการศึกษา '+js_year+' รหัสวิชา '+js_subject,
						title: 'คะแนน / วัดและประเมินผล Summer ปีการศึกษา '+js_year+' รหัสวิชา '+js_subject,
						exportOptions: {
							columns: ':visible'
						}
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

		})
	</script>


	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="table-responsive">
				<table class="table table-bordered datatable-button-html5-columns">
					<thead>
						<tr>
							<th><div>รหัสนักเรียน</div></th>
							<th><div>รหัสรายวิชาSummer</div></th>
							<th><div>ปีการศึกษา</div></th>
							<th><div>รหัสผู้บันทึก</div></th>
							<th><div>ภาคเรียน</div></th>
							<th><div>คะแนน</div></th>
							<th><div>ประเภทของคะแนน</div></th>							
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><div></div></td>
							<td><div><?php echo $load_subject;?></div></td>
							<td><div><?php echo $load_year;?></div></td>
							<td><div><?php echo $load_user;?></div></td>
							<td><div>1</div></td>
							<td><div></div></td>
							<td><div>Pre</div></td>							
						</tr>
						<tr>
							<td><div></div></td>
							<td><div><?php echo $load_subject;?></div></td>
							<td><div><?php echo $load_year;?></div></td>
							<td><div><?php echo $load_user;?></div></td>
							<td><div>1</div></td>
							<td><div></div></td>
							<td><div>Post</div></td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
	</div>



<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php	}else{
				$this->session->unset_userdata('rc_user');
				exit("<script>window.location='$golink/print_imgstu/error';</script>");				
			}
		}							 
	}
?>