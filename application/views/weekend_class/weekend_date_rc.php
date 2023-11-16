<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
//--------------------------------------------------------------------		
		include("view/database/pdo_conndatastu.php");
		include("view/database/class_pdodatastu.php");
		
		include("view/database/pdo_data.php");
		include("view/database/class_admin.php");

		
		include("view/database/pdo_admission.php");
		include("view/database/regina_student.php");
		
		include("view/database/pdo_weekend.php");
		include("view/database/class_weekend.php");  


//--------------------------------------------------------------------  
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
	if($this->session->userdata("rc_user")==null){
		$this->session->unset_userdata("rc_user");
		exit("<script>window.location='$golink/print_imgstu/error';</script>");
	}else{
		$LoginKey=$this->session->userdata("rc_user");
		$admin_log=$this->load->database("default",TRUE);		
		$admin_log=$this->db->query("SELECT COUNT(`login_id`) AS `int_uesr` 
									 FROM `login` 
									 WHERE `use_status`='1' 
									 AND `login_id`='{$LoginKey}'");
		foreach($admin_log->result_array() as $log_row){
			if($log_row["int_uesr"]>=1){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

	<?php
	
		$DataWeekendClass=new DataWeekendClass($WeekendKey,$WeekendT,$WeekendY);
 		
	?>
				
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="stats-in-th" content="b062" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="shortcut icon" type="image/png">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="72x72">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="114x114">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="144x144">
		
	    <link href="<?php echo base_url();?>/Template/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	    <link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	    <link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/core.min.css" rel="stylesheet" type="text/css">
	    <link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/components.min.css" rel="stylesheet" type="text/css">
	    <link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/colors.min.css" rel="stylesheet" type="text/css">
		
		<style>
			@font-face {
				font-family: 'surafont_sanukchang';
				src: url('view/font/surafont_sanukchang.eot');
				src: url('view/font/surafont_sanukchang.eot?#iefix') format('embedded-opentype'),
				url('view/font/surafont_sanukchang.woff') format('woff'),
				url('view/font/surafont_sanukchang.ttf') format('truetype');
			}
			body{
					font-family: "surafont_sanukchang";
					font-size: 15px;
			}
		</style>		
		
		<title>รายชื่อผู้ลงทะเบียน วิชา / กิจกรรม</title>
		<link rel="shortcut icon" href="<?php echo base_url();?>/Template/global_assets/images/logo_rc_wbe.ico"/>
	<!-- Core JS files -->
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/loaders/pace.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->
	<!-- Theme JS files -->
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
	<!-- /theme JS files -->	
	
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
			$.extend( $.fn.dataTable.defaults, {
				autoWidth: false,
				dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
				language: {
					search: '<span>ค้นหา : </span> _INPUT_',
					searchPlaceholder: 'ช่องค้นหา...',
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
							filename: 'รายชื่อผู้ลงทะเบียน วิชา / กิจกรรม <?php echo $DataWeekendClass->wc_txt;?> ภาคเรียนที่ <?php echo $WeekendT;?> ปีการศึกษา <?php echo $WeekendY;?>',
					        title: 'รายชื่อผู้ลงทะเบียน วิชา / กิจกรรม <?php echo $DataWeekendClass->wc_txt;?> ภาคเรียนที่ <?php echo $WeekendT;?> ปีการศึกษา <?php echo $WeekendY;?>',
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




	</head>
	<body>
		
			<div class="content">
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="panel panel-warning">
							<div class="panel-heading">
								<div>รายชื่อผู้ลงทะเบียน วิชา / กิจกรรม <?php echo $DataWeekendClass->wc_txt;?></div>
								<div>ภาคเรียนที่ <?php echo $WeekendT;?> ปีการศึกษา <?php echo $WeekendY;?></div>
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table datatable-button-html5-columns">
										<thead>
											<tr>
												<th><div>ลำดับ</div></th>
												<th><div>รหัสนักเรียน</div></th>
												<th><div>ชื่อ-สกุล</div></th>
												<th><div>ชั้น</div></th>
												<th><div>ห้อง</div></th>
											</tr>
										</thead>
										<tbody>
										
			<?php
				$CountPWC=1;
				$PrintWeekendClassRc=new PrintWeekendClassSud($WeekendKey,$WeekendT,$WeekendY);
				foreach($PrintWeekendClassRc->RunPrintWeekendClassRc() as $rc=>$PrintWeekendClassRow){ 
					$PrintStu=new PrintReginaStuData($PrintWeekendClassRow["wcr_key"]);
					
					$PrintReginaYear=new PrintReginaYear4($WeekendY,$WeekendT,$PrintWeekendClassRow["wcr_key"]);
					foreach($PrintReginaYear->RunReginaStuClass() as $rc=>$PrintReginaYearRow){
						$PrintLavaL=new PrintLavaL($PrintReginaYearRow["rsc_class"]);
					}
					
					
			
				?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
											<tr>
												<td><div><?php echo $CountPWC;?></div></td>
												<td><div><?php echo $PrintWeekendClassRow["wcr_key"];?></div></td>
												
			<?php
					if(isset($PrintStu->PRS_nameTH)){ ?>
												<td><div><?php echo $PrintStu->PRS_nameTH;?></div></td>
			<?php	}else{ 
						$NameTh=new Prove_A_PersonRc($PrintWeekendClassRow["wcr_key"]);
				?>
												<td><div><?php echo $NameTh->NameTh;?></div></td>
			<?php	} ?>												
												
												<td><div><?php echo $PrintLavaL->RunPrintLavaL();?></div></td>
												<td><div><?php echo $PrintReginaYearRow["rsc_room"];?></div></td>
											</tr>					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
			<?php	
					$CountPWC=$CountPWC+1;
				} ?>

										</tbody>
									</table>
								</div>							
							</div>
						</div>					
					</div>
				</div>
			</div>
		
	</body>
</html>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{
				$this->session->unset_userdata('rc_user');
				exit("<script>window.location='$golink/print_imgstu/error';</script>");		
			}
		}							 		
	}
?>



