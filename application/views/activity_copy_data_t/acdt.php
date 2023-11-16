<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
//--------------------------------------------------------------------		
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
		
		<script src="<?php echo base_url();?>/view/js_css_code/countUp/countUp.umd.min.js"></script>
	
		<script>
			let done = [];
			function isComing(el){
				const rect = el.getBoundingClientRect();
				return (
					rect.top <= (window.innerHeight || document.documentElement.clientHeight)
				);
			}
			
			function s_counters(){
			const s_counters = document.querySelectorAll(".count_acdt");
				s_counters.forEach(function (cntr) {
					if(isComing(cntr)){
						var cntr_id = cntr.id;
						if(!done[cntr_id]){
							var cntr_val = cntr.dataset.value;
							var cntr_run = new countUp.CountUp(cntr_id, cntr_val);
							cntr_run.start();
							done[cntr_id] = true;
						}else{}
					}else{}
				});
			}
			document.addEventListener("DOMContentLoaded", s_counters);
			window.addEventListener("scroll", s_counters, { passive: true }); 
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
<!--****************************************************************************-->
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
	</head>
	<body>
		<?php
			$ACDT_T=filter_input(INPUT_POST,'ACDT_T');
			$ACDT_Y=filter_input(INPUT_POST,'ACDT_Y');
				if(isset($ACDT_T,$ACDT_Y)){ 
					$CopyData_Activity=new CopyDbActivityAllT($ACDT_T,$ACDT_Y);
				?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-purple text-center">
					<h6 class="no-margin text-semibold">ข้อมูล&nbsp;:&nbsp;กิจกรรมชุมนุม</h6>
					<div class="row">
						<div class="col-<?php echo $grid;?>-4">
							<div class="panel panel-body bg-blue-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin"><b id="acdt1" class="count_acdt" style="font-family: surafont_sanukchang; font-size: 20px;" data-value="<?php echo $CopyData_Activity->Count_AcAll;?>"><?php echo $CopyData_Activity->Count_AcAll;?></b></h3>
										<span class="text-uppercase text-size-mini" style="font-family: surafont_sanukchang; font-size: 14px;">ข้อมูลคัดลอกทั้งหมด</span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-database-refresh icon-3x opacity-75"></i>
									</div>
								</div>
							</div>						
						</div>
						<div class="col-<?php echo $grid;?>-4">
							<div class="panel panel-body bg-success-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin"><b id="acdt2" class="count_acdt" style="font-family: surafont_sanukchang; font-size: 20px;" data-value="<?php echo $CopyData_Activity->Count_AcCopy;?>"><?php echo $CopyData_Activity->Count_AcCopy;?></b></h3>
										<span class="text-uppercase text-size-mini" style="font-family: surafont_sanukchang; font-size: 14px;">คัดลอกสำเร็จ</span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-database-check icon-3x opacity-75"></i>
									</div>
								</div>
							</div>						
						</div>
						<div class="col-<?php echo $grid;?>-4">
							<div class="panel panel-body bg-danger has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin"><b id="acdt3" class="count_acdt" style="font-family: surafont_sanukchang; font-size: 20px;" data-value="<?php echo $CopyData_Activity->Count_NotAcCopy;?>"><?php echo $CopyData_Activity->Count_NotAcCopy;?></b></h3>
										<span class="text-uppercase text-size-mini" style="font-family: surafont_sanukchang; font-size: 14px;">คัดลอกไม่สำเร็จ</span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-database-remove icon-3x opacity-75"></i>
									</div>
								</div>
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-purple text-center">
					<h6 class="no-margin text-semibold">ข้อมูล&nbsp;:&nbsp;โค้วตากิจกรรมชุมนุม</h6>
					<div class="row">
						<div class="col-<?php echo $grid;?>-4">
							<div class="panel panel-body bg-blue-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin"><b id="acdt4" class="count_acdt" style="font-family: surafont_sanukchang; font-size: 20px;" data-value="<?php echo $CopyData_Activity->Count_ACkAll;?>"><?php echo $CopyData_Activity->Count_ACkAll;?></b></h3>
										<span class="text-uppercase text-size-mini" style="font-family: surafont_sanukchang; font-size: 14px;">ข้อมูลคัดลอกทั้งหมด</span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-database-refresh icon-3x opacity-75"></i>
									</div>
								</div>
							</div>						
						</div>
						<div class="col-<?php echo $grid;?>-4">
							<div class="panel panel-body bg-success-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin"><b id="acdt5" class="count_acdt" style="font-family: surafont_sanukchang; font-size: 20px;" data-value="<?php echo $CopyData_Activity->Count_ACkCopy;?>"><?php echo $CopyData_Activity->Count_ACkCopy;?></b></h3>
										<span class="text-uppercase text-size-mini" style="font-family: surafont_sanukchang; font-size: 14px;">คัดลอกสำเร็จ</span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-database-check icon-3x opacity-75"></i>
									</div>
								</div>
							</div>						
						</div>
						<div class="col-<?php echo $grid;?>-4">
							<div class="panel panel-body bg-danger has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin"><b id="acdt6" class="count_acdt" style="font-family: surafont_sanukchang; font-size: 20px;" data-value="<?php echo $CopyData_Activity->Count_NotACkCopy;?>"><?php echo $CopyData_Activity->Count_NotACkCopy;?></b></h3>
										<span class="text-uppercase text-size-mini" style="font-family: surafont_sanukchang; font-size: 14px;">คัดลอกไม่สำเร็จ</span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-database-remove icon-3x opacity-75"></i>
									</div>
								</div>
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-purple text-center">
					<h6 class="no-margin text-semibold">ข้อมูล&nbsp;:&nbsp;นักเรียนลงทะเบียนกิจกรรมชุมนุม</h6>
					<div class="row">
						<div class="col-<?php echo $grid;?>-4">
							<div class="panel panel-body bg-blue-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin" ><b id="acdt7" class="count_acdt" style="font-family: surafont_sanukchang; font-size: 20px;" data-value="<?php echo $CopyData_Activity->Count_AsAll;?>"><?php echo $CopyData_Activity->Count_AsAll;?></b></h3>
										<span class="text-uppercase text-size-mini" style="font-family: surafont_sanukchang; font-size: 14px;">ข้อมูลคัดลอกทั้งหมด</span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-database-refresh icon-3x opacity-75"></i>
									</div>
								</div>
							</div>						
						</div>
						<div class="col-<?php echo $grid;?>-4">
							<div class="panel panel-body bg-success-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin" ><b id="acdt8" class="count_acdt" style="font-family: surafont_sanukchang; font-size: 20px;" data-value="<?php echo $CopyData_Activity->Count_AsCopy;?>"><?php echo $CopyData_Activity->Count_AsCopy;?></b></h3>
										<span class="text-uppercase text-size-mini" style="font-family: surafont_sanukchang; font-size: 14px;">คัดลอกสำเร็จ</span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-database-check icon-3x opacity-75"></i>
									</div>
								</div>
							</div>						
						</div>
						<div class="col-<?php echo $grid;?>-4">
							<div class="panel panel-body bg-danger has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin"><b id="acdt9" class="count_acdt" style="font-family: surafont_sanukchang; font-size: 20px;" data-value="<?php echo $CopyData_Activity->Count_NotAsCopy;?>"><?php echo $CopyData_Activity->Count_NotAsCopy;?></b></h3>
										<span class="text-uppercase text-size-mini" style="font-family: surafont_sanukchang; font-size: 14px;">คัดลอกไม่สำเร็จ</span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-database-remove icon-3x opacity-75"></i>
									</div>
								</div>
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-purple text-center">
					<h6 class="no-margin text-semibold">ข้อมูล&nbsp;:&nbsp;คุณครูที่ปรึกษาหรือประธานชุมนุม</h6>
					<div class="row">
						<div class="col-<?php echo $grid;?>-4">
							<div class="panel panel-body bg-blue-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin"><b id="acdt10" class="count_acdt" style="font-family: surafont_sanukchang; font-size: 20px;" data-value="<?php echo $CopyData_Activity->Count_AtAll;?>"><?php echo $CopyData_Activity->Count_AtAll;?></b></h3>
										<span class="text-uppercase text-size-mini" style="font-family: surafont_sanukchang; font-size: 14px;">ข้อมูลคัดลอกทั้งหมด</span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-database-refresh icon-3x opacity-75"></i>
									</div>
								</div>
							</div>						
						</div>
						<div class="col-<?php echo $grid;?>-4">
							<div class="panel panel-body bg-success-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin"><b id="acdt11" class="count_acdt" style="font-family: surafont_sanukchang; font-size: 20px;" data-value="<?php echo $CopyData_Activity->Count_AtCopy;?>"><?php echo $CopyData_Activity->Count_AtCopy;?></b></h3>
										<span class="text-uppercase text-size-mini" style="font-family: surafont_sanukchang; font-size: 14px;">คัดลอกสำเร็จ</span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-database-check icon-3x opacity-75"></i>
									</div>
								</div>
							</div>						
						</div>
						<div class="col-<?php echo $grid;?>-4">
							<div class="panel panel-body bg-danger has-bg-image">
								<div class="media no-margin">
									<div class="media-body">
										<h3 class="no-margin"><b id="acdt12" class="count_acdt" style="font-family: surafont_sanukchang; font-size: 20px;" data-value="<?php echo $CopyData_Activity->Count_NotAtCopy;?>"><?php echo $CopyData_Activity->Count_NotAtCopy;?></b></h3>
										<span class="text-uppercase text-size-mini" style="font-family: surafont_sanukchang; font-size: 14px;">คัดลอกไม่สำเร็จ</span>
									</div>

									<div class="media-right media-middle">
										<i class="icon-database-remove icon-3x opacity-75"></i>
									</div>
								</div>
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>		
		
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-purple text-center">
					
				</div>
			</div>
		</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<?php	}?>
	</body>
</html>		
			
		<?php	}else{
					$this->session->unset_userdata('rc_user');
					exit("<script>window.location='$golink/print_imgstu/error';</script>");				
				}
			}							 
		}
?>