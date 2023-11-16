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
		
		<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/bootstrap.min.js"></script>	
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
				if($this->session->userdata("rc_user")==null){
					$this->session->unset_userdata("rc_user");
					exit("<script>window.location='$golink';</script>");
				}else{?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										
									

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php	} ?>
	</body>
</html>