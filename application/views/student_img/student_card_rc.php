<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
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
		$uesr_log=$this->load->database("default",TRUE);
		$uesr_log=$this->db->query("SELECT COUNT(`rsl_user`) AS `int_uesr` 
									FROM `regina_stu_login` 
									WHERE `rsl_user`='{$LoginKey}'");
		foreach($uesr_log->result_array() as $log_row){
			if($log_row["int_uesr"]>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	$UesrRc=$this->load->database("default",TRUE);
	$UesrRc=$this->db->select("rsd_studentid");
	$UesrRc=$this->db->where("rsl_user",$LoginKey);
	$UesrRcRow=$this->db->get("regina_stu_login");
	foreach($UesrRcRow->result() as $URR){
		$usercopy=($URR->rsd_studentid);
		if($usercopy==$sud_key){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
										
					
<style>
.psrA{
	margin: auto;
	border: 3px solid #73AD21;
}
</style>
	<?php
		include("view/database/database_evaluation.php");
		include("view/database/pdo_data.php");
		include("view/database/class_admin.php");
		
		/*$txt_year=post_data(filter_input(INPUT_POST,'txt_year'));
		$txt_class=post_data(filter_input(INPUT_POST,'txt_class'));
		$txt_room=post_data(filter_input(INPUT_POST,'txt_room'));*/
		
		/*$txt_year="1/2564";
		$txt_class="23";
		$txt_room="1";*/
	
	?>		

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
		<title>พิมพ์&nbsp;รูปนักเรียน</title>
		<link rel="shortcut icon" href="<?php echo base_url();?>/Template/global_assets/images/logo_rc_wbe.ico"/>
<!-- Global stylesheets -->
<!-- /global stylesheets -->		
<!--Code Print css-->
		<link rel="stylesheet" href="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/css/normalize.css">
		<link rel="stylesheet" href="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/css/paper.css"> 	
<!--Code Print css End-->	


		<style>
			@font-face {
				font-family: 'THSarabunNew';
				src: url('<?php echo base_url();?>/view/font/thsarabunnew-webfont.eot');
				src: url('<?php echo base_url();?>/view/font/thsarabunnew-webfont.eot?#iefix') format('embedded-opentype'),
			url('<?php echo base_url();?>/view/font/thsarabunnew-webfont.woff') format('woff'),
			url('<?php echo base_url();?>/view/font/THSarabunNew.ttf') format('truetype');
			}
			body{
				font-family: "THSarabunNew";
				font-size: 16px;
				color: #032E3B;
			}
		</style>
	
		<style>
			@media print {
				
				@page{
					size: c;
					margin: 1 cm;
				}
				
				button {
					display:none;
				}
				
				#p_echo{
					display:none;
				}
				
				body{
					font-family: "THSarabunNew";
					font-size: 13pt; 
							
				}
			}
			
			body{
				width: 5.4cm; height: 8.6cm;
			}
			.imgA{
				width: 5.4cm; height: 8.6cm;
			}
			
			.textAlignVer{
				display:block;
				filter: flipv fliph;
				-webkit-transform: rotate(-90deg); 
				-moz-transform: rotate(-90deg); 
				transform: rotate(-90deg); 
				position:relative;
				width:20px;
				white-space:nowrap;
				font-size:12px;
				margin-bottom:10px;
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
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery.min.js"></script>
<!-- /core JS files -->	
<!--Code Print js-->
	<script src="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/js/html2canvas.js"></script>	
<!--Code Print js End-->		
	
	</head>
	<body>

		<section class="sheet padding-10mm imgA" style="background-image: url('<?php echo base_url();?>/view/img_user/student_card.png'); background-repeat: no-repeat; background-size: 100%;">
		
		<?php
			$date_rc=new class_stuA($sud_key,$txt_year,$txt_t);
				if(isset($date_rc->rsd_studentid)){
					$sudrc_key=$date_rc->rsd_studentid;
					$sudrc_class=$date_rc->rsc_class;
					
					$txt_level=new print_level($sudrc_class);
		
						if($sudrc_class==3){
							$file_img="sud_img03";
						}elseif($sudrc_class>=11 and $sudrc_class<=22){
							$file_img="sud_img1122";
						}elseif($sudrc_class>=23 and $sudrc_class<=33){
							$file_img="sud_img2333";
						}elseif($sudrc_class>=41 and $sudrc_class<=43){
							$file_img="sud_img4143";
						}else{
							$file_img="all";
						}
					
					
					
					
				}else{
					
				}
		?>

		</section>

	</body>
</html>					
					
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}else{
			$this->session->unset_userdata("rc_user");
			exit("<script>window.location='$golink/print_imgstu/error';</script>");
		}
	}
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{
				$admin_log=$this->load->database("default",TRUE);		
				$admin_log=$this->db->query("SELECT COUNT(`login_id`) AS `int_uesr` 
											 FROM `login` 
											 WHERE `use_status`='1' 
											 AND `login_id`='{$LoginKey}'");
				foreach($admin_log->result_array() as $log_row){
					if($log_row["int_uesr"]>=1){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
			<?php	}else{
						$this->session->unset_userdata("rc_user");
						exit("<script>window.location='$golink/print_imgstu/error';</script>");
					}
				}							 
			}
		}
		
	}
?>


