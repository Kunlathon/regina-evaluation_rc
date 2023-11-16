<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
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
		<link rel="shortcut icon" href="<?php echo base_url();?>/Template/global_assets/images/logo_rc_wbe.ico"/>
		
		<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/bootstrap.min.js"></script>	
<!--****************************************************************************-->	
<!-- Theme JS files components_notifications_pnotify.html-->
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/pnotify.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/ripple.min.js"></script>
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
	</head>

	<body class="col-<?php echo $grid;?>-12">
		<?php
			$this->load->library('session');						
//-------------------------------------------------------------------------------    
			include("view/img_user/document/gotolink.php");//--------------------
			$goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//-------------
			$golink=$goingtolink->Rungotolink();//-------------------------------
//-------------------------------------------------------------------------------
			include("view/database/pdo_data.php");
			include("view/database/pdo_quota.php");
			include("view/database/class_quota.php");
//-------------------------------------------------------------------------------
			$SudId=$this->input->post("SudId");
			$PlanId=$this->input->post("PlanId");
			$YearNext=$this->input->post("YearNext");
			$Year=$this->input->post("Year");
			$ClassNew=$this->input->post("ClassNew");
			$Class=$this->input->post("Class");
//-------------------------------------------------------------------------------			
				if($this->session->userdata("rc_user")==null){
					$this->session->unset_userdata("rc_user");
					exit("<script>window.location='$golink';</script>");
				}else{?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										
				<?php
					$IntoUpQuotaRc=new IntoUpQuotaRc($SudId,$ClassNew,$PlanId,$Year,$YearNext);
						if($IntoUpQuotaRc->RunIntoUpQuotaRc()=="Y"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<script>
			$(document).ready(function () {
				new PNotify({
					title: 'สำเร็จ',
					text: 'ดำเนินการลงทะเบียนแผนการเรียนนี้สำเร็จ',
					addclass: 'bg-success'
				});			
			})
		</script>							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
				<?php	}elseif($IntoUpQuotaRc->RunIntoUpQuotaRc()=="N"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<script>
			$(document).ready(function () {
				new PNotify({
					title: 'ไม่สำเร็จ',
					text: 'ดำเนินการลงทะเบียนแผนการเรียนนี้ไม่สำเร็จ',
					addclass: 'bg-danger'
				});			
			})
		</script>							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
				<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<script>
			$(document).ready(function () {
				new PNotify({
					title: 'ไม่สำเร็จ',
					text: 'ดำเนินการลงทะเบียนแผนการเรียนนี้ไม่สำเร็จ',
					addclass: 'bg-danger'
				});				
			})
		</script>							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
				<?php	}?>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	} ?>
	</body>
</html>

