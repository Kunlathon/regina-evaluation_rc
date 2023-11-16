<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
/* set the cache limiter to 'private' */
	//session_cache_limiter("regina");
	//$cache_limiter = session_cache_limiter();

/* set the cache expire to 20 minutes */
	//session_cache_expire(20);
	//$cache_expire = session_cache_expire();

/* start the session */
	//session_start();
	//ob_start();
	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
	header("Content-Type: text/html; charset=utf-8");
	header("Cache-control: private");
	
	if(isset($_SESSION['rc_user'])){
		exit("<script>window.location='$golink/rc';</script>");
	}else{
//------------------------------------------------------------------------------------
			if(isset($_GET['txt_error'])){
				$txt_error=$_GET['txt_error'];			
					if($txt_error=="null"){
						$print_login='<font color="#F20004">ข้อมูลเป็นค่าว่าง</font>';
					}elseif($txt_error=="key"){
						$print_login='<font color="#F20004">เข้าสู่ระบบช้ำ  กรุณารอสักครู่</font>';
					}elseif($txt_error=="notdata"){
						$print_login='<font color="#F20004">ไม่พบข้อมูล</font>';
					}elseif($txt_error=="notlogin"){
						$print_login='<font color="#F20004">ชื่อผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง</font>';
					}else{
						//-----------------------------------------------------------
					}			
			}else{	
//------------------------------------------------------------------------------------		
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
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
	
	<title>ระบบนักเรียน โรงเรียนเรยีนาเชลีวิทยาลัย</title>


	<!-- Global stylesheets -->
	<!--<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">-->
	<link href="<?php echo base_url();?>/Template/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->



<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: Arial;
  font-size: 17px;
  background-image: url("<?php echo base_url();?>/Template/global_assets/images/backgrounds/user_material_bg.jpg");
}

/*#myVideo {
  position: fixed;
  right: 0;
  bottom: 0;
  min-width: 100%; 
  min-height: 100%;
}*/

.page-container {
  position: fixed;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  color: #f1f1f1;
  width: 100%;
  padding: 20px;
}

#myBtn {
  width: 200px;
  font-size: 18px;
  padding: 10px;
  border: none;
  background: #000;
  color: #fff;
  cursor: pointer;
}

#myBtn:hover {
  background: #ddd;
  color: black;
}
</style>

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

	<!-- Core JS files -->
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/loaders/pace.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>

	<script src="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/js/app.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/demo_pages/general_widgets_stats.js"></script>

	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/ripple.min.js"></script>

	<!-- /theme JS files -->
</head>
	<script type="text/javascript">
		$(function(){
			$("*").keypress(function(event){
			if(event.keyCode==13){
            return false;
			}
		});
	});
	</script>
	
	<script type="text/javascript">
		function ShowPasswork(){
			var sp=document.getElementById("inputpass");
			if(sp.type=="password"){
			   sp.type="text";
			}else{
			   sp.type="password";
			}
		}
	</script>
	
	
<body class="login-container">

	<!--<video autoplay muted loop id="myVideo">
		<source src="<?php echo base_url();?>/Template/global_assets/images/test.m4v" type="video/mp4">
	</video>-->

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content">
				<div class="row">
			
					<div class="col-<?php echo $grid;?>-6">
						<center>
					<p><center>ระบบบริการข้อมูลสารสนเทศนักเรียน</center></p>	
					<!-- Advanced login -->
					<form action="<?php echo base_url();?>/rc/connect_login" method="post" name="login">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 72px; height: 63px;"/>
								<!--<h5 class="content-group">ลงชื่อเข้าใช้บัญชีของคุณ <small class="display-block">ป้อนข้อมูลของคุณด้านล่าง</small></h5>-->
							<?php
									if(isset($print_login)){ ?>
								<h5 class="content-group"><small><?php echo $print_login;?></small></h5>										
							<?php	}else{ ?>
								<h5 class="content-group"><small></small></h5>										
							<?php	}       ?>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="text" name="student_id" class="form-control" placeholder="เลขประจำตัวนักเรียน" required maxlength="6" minlength="4" >
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" name="student_Identification" class="form-control" id="inputpass" placeholder="เลขประจำตัวประชาชน" required maxlength="13" minlength="10">
								<small><input type="checkbox" onclick="ShowPasswork()"> Show Password</small>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-<?php echo $grid;?>-6">
										<button type="submit" class="btn bg-blue btn-block">เข้าสู่ระบบ<i class="icon-arrow-right14 position-right"></i></button>									
									</div>
									<div class="col-<?php echo $grid;?>-6">
										<button type="reset" class="btn btn-danger btn-block">ล้างข้อมูล<i class="icon-trash-alt position-right"></i></button>									
									</div>
								</div>


							</div>					
							<!--<div class="content-divider text-muted form-group"><span>Don't have an account?</span></div>
							<a href="layout_1/LTR/default/full/login_registration.html" class="btn btn-default btn-block content-group">Sign up</a>
							<span class="help-block text-center no-margin">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span>-->
						</div>
					</form>
					<!-- /advanced login -->						
						</center>
					</div>
							<div class="col-<?php echo $grid;?>-6"></div>
				</div>
			
					<div class="footer text-muted">
						<span class="help-block text-center no-margin">&copy; Copyright © 2020 Regina Coeli Collage. All Rights Reserved. พัฒนาระบบโดย กลุ่มงาน ICT โรงเรียนเรยีนาเชลีวิทยาลัย 2020</span>
					</div>
							
			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->


	</div>
	<!-- /page container -->
	
	<script>
		var video = document.getElementById("myVideo");
		var btn = document.getElementById("myBtn");

		function myFunction() {
			if(video.paused){
				video.play();
				btn.innerHTML = "Pause";
			}else{
				video.pause();
				btn.innerHTML = "Play";
			}
		}
	</script>

</body>
</html>

