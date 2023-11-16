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
		
		include("view/database/pdo_activity.php");
		include("view/database/class_activity.php");  


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
		$txt_c=filter_input(INPUT_POST,'txt_c');
		$txt_t=filter_input(INPUT_POST,'txt_t');
		$txt_y=filter_input(INPUT_POST,'txt_y');
		$txt_name=filter_input(INPUT_POST,'txt_name');
		if($txt_c=="2123"){
			$PrintClass="ประถมศึกษาตอนปลาย";
		}elseif($txt_c=="3133"){
			$PrintClass="มัธยมศึกษาตอนต้น";
		}elseif($txt_c=="4143"){
			$PrintClass="มัธยมศึกษาตอนปลาย";
		}elseif($txt_c=="3142"){
			$PrintClass="มัธยมศึกษาปีที่1-5";
		}else{
			$PrintClass=null;
		}  		
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
		
		<title></title>
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
					search: '<span>Filter:</span> _INPUT_',
					searchPlaceholder: 'Type to filter...',
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
							filename: 'รายงานรายชื่อนักเรียนลงเรียน กิจกรรม <?php echo $txt_name;?> ระดับชั้น <?php echo $PrintClass;?> ปีการศึกษา <?php echo $txt_y;?>',
					        title: 'รายงานรายชื่อนักเรียนลงเรียน กิจกรรม <?php echo $txt_name;?> ระดับชั้น <?php echo $PrintClass;?> ปีการศึกษา <?php echo $txt_y;?>',
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
								<div>รายงานรายชื่อนักเรียนลงเรียน&nbsp;กิจกรรม&nbsp;<?php echo $txt_name;?></div>
								<div>ระดับชั้น&nbsp;<?php echo $PrintClass;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $txt_y;?></div>
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
				$count=1;
				$ActivitySudRc=new ActivitySudRc($txt_c,$txt_t,$txt_y,$txt_name);
				foreach($ActivitySudRc->RunSudActivityArray() as $rc=>$ActivitySudRow){ 
					$Printclass=new PrintReginaYear4($txt_y,$txt_t,$ActivitySudRow["ac_key"]);
					foreach($Printclass->RunReginaStuClass() as $rc=>$PrintclassRow){
						$PrintStu=new PrintReginaStuData($PrintclassRow["rsd_studentid"]); 
						$PrintLavaL=new PrintLavaL($PrintclassRow["rsc_class"]);
						?>
						
											<tr>
												<td><div><?php echo $count;?></div></td>
							<?php
									if(isset($PrintStu->PRS_studentid)){ ?>
												<td><div><?php echo $PrintStu->PRS_studentid;?></div></td>
							<?php	}else{ ?>
												<td><div><?php echo $PrintclassRow["rsd_studentid"];?></div></td>
							<?php	}?>					
												
							<?php
									if(isset($PrintStu->PRS_nameTH)){ ?>
												<td><div><?php echo $PrintStu->PRS_nameTH;?></div></td>
							<?php	}else{ 
									$NameTh=new Prove_A_PersonRc($PrintclassRow["rsd_studentid"]);
							?>
												<td><div><?php echo $NameTh->NameTh;?></div></td>
							<?php	} ?>					
												
												<td><div><?php echo $PrintLavaL->RunPrintLavaL();?></div></td>
												<td><div><?php echo $PrintclassRow["rsc_room"];?></div></td>
												
											</tr>	
						
		<?php		} 
				$count=$count+1;
				}
		?>		


											
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



