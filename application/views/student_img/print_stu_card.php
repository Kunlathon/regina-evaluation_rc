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
		$admin_log=$this->load->database("default",TRUE);		
		$admin_log=$this->db->query("SELECT COUNT(`login_id`) AS `int_uesr` 
									 FROM `login` 
									 WHERE `use_status`='1' 
									 AND `login_id`='{$LoginKey}'");
		foreach($admin_log->result_array() as $log_row){
			if($log_row["int_uesr"]>=1){ ?>
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

	$data_sturcroom=new regina_stu_data4($txt_key,$txt_y,$txt_t);
	
	/*$txt_t=substr($txt_year,0,1);
	$txt_y=substr($txt_year,2,4);*/

	//$txt_level=new print_level($txt_class);
	
		if($data_sturcroom->rsc_class==3){
			$file_img="sud_img03";
		}elseif($data_sturcroom->rsc_class>=11 and $data_sturcroom->rsc_class<=22){
			$file_img="sud_img1122";
		}elseif($data_sturcroom->rsc_class>=23 and $data_sturcroom->rsc_class<=33){
			$file_img="sud_img2333";
		}elseif($data_sturcroom->rsc_class>=41 and $data_sturcroom->rsc_class<=43){
			$file_img="sud_img4143";
		}else{
			$file_img="all";
		}
	
	
?>

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
		<title>พิมพ์ บัตรนักเรียนรายบุคคล</title>
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
    
	<div id="p_echo">
		<div class="container psrA">
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="table-responsive">
						<table class="table" align="center">
							<thead>
								<tr>
									<th style="width: 20%">
										<div><button type="button"  class="btn btn-default" onclick="window.print()"><b>พิมพ์ บัตรนักเรียนรายบุคคล</b></button></div>
									</th>
								</tr>
								<tr>
									<th style="width: 20%">
										<div><font color="#F70105"><b>ระบบการพิมพ์  รองรับ เว็บเบราว์เซอร์  Google Chrome และ  Microsoft Edge เท่านั้น<b></font></div>
									</th>								
								</tr>
							</thead>						
						</table>
						<table class="table" align="center">
							<thead>
								<tr>
									<th style="width: 20%"><div>ขนาดกระดาษ</div></th>
									<th style="width: 20%"><div>แนวกระดาษ</div></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><div>C&nbsp;:&nbsp;54mm&nbsp;X&nbsp;86mm</div></td>
									<td><div>แนวตั้ง</div></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>		
			</div>		
		</div>
	</div>


	<?php
		
		if(isset($data_sturcroom->rsd_studentid)){
			$rsd_studentid=$data_sturcroom->rsd_studentid;
			$txt_class=$data_sturcroom->rsc_class;
			$name_th=$data_sturcroom->rsd_name."&nbsp;".$data_sturcroom->rsd_surname;
//Year_Card				
			if($txt_class==3){
					$ExpY=$txt_y+1;
			}elseif($txt_class==11){
					$ExpY=$txt_y+6;
			}elseif($txt_class==12){
					$ExpY=$txt_y+5;
			}elseif($txt_class==13){
					$ExpY=$txt_y+4;
			}elseif($txt_class==21){
					$ExpY=$txt_y+3;
			}elseif($txt_class==22){
					$ExpY=$txt_y+2;
			}elseif($txt_class==23){
					$ExpY=$txt_y+1;
			}elseif($txt_class==31){
					$ExpY=$txt_y+3;
			}elseif($txt_class==32){
					$ExpY=$txt_y+2;
			}elseif($txt_class==33){
					$ExpY=$txt_y+1;
			}elseif($txt_class==41){
					$ExpY=$txt_y+3;
			}elseif($txt_class==42){
					$ExpY=$txt_y+2;
			}elseif($txt_class==43){
					$ExpY=$txt_y+1;
			}else{
					$ExpY="-";
				}				
//Year_Card End					
//-------------------------------------------------------------------------------------	
				if(file_exists("view/$file_img/$rsd_studentid.jpg")){
					$user_img="$rsd_studentid.jpg";
				}else{
                    if(file_exists("view/$file_img/$rsd_studentid.JPG")){
                        $user_img="$rsd_studentid.JPG";                       
                    }else{
						if($txt_class==22){
							$file_img="sud_img2333";
							if(file_exists("view/$file_img/$rsd_studentid.jpg")){
								$user_img="$rsd_studentid.jpg";
							}else{
								if(file_exists("view/$file_img/$rsd_studentid.JPG")){
									$user_img="$rsd_studentid.jpg";
								}else{
									$user_img="newimg_rc.jpg";
								}
							}
						}else{
							$user_img="newimg_rc.jpg";
						}                     
                    }
				}				
//-------------------------------------------------------------------------------------
?>				
				
	<section class="sheet padding-10mm imgA" style="background-image: url('<?php echo base_url();?>/view/img_user/student_card.png'); background-repeat: no-repeat; background-size: 100%;">
		<div>&nbsp;</div>
		<div>&nbsp;</div>
		<div>&nbsp;</div>
		<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>/view/<?php echo $file_img;?>/<?php echo $user_img;?>" style="width: 1.80cm; height: 2.30cm;" class="img-thumbnail"/></div>
		
		<div>
			<table style="width: 130%; vertical-align: top; font-family: THSarabunNew ;" border="0" cellpadding="0" cellspacing="0" align="canter">
				<tbody>
					<tr>
						<td>
							<div style="text-align: center; font-size: 7px; font-weight: bold; line-height: 10px;">เลขประจำตัว&nbsp;/&nbsp;STUDENT&nbsp;ID</div>
							<div style="text-align: center; font-size: 20px; font-weight: bold; line-height: 10px;"><?php echo $rsd_studentid;?></div>
							<div style="text-align: center; font-size: 7px; font-weight: bold; line-height: 10px;">ชื่อ-สกุล&nbsp;NAME-SURNAME</div>
							<div style="text-align: center; font-size: 18px; font-weight: bold; line-height: 10px;"><?php echo $name_th;?></div>
							<div style="font-size: 9px; float:right; font-weight: bold; line-height: 10px;" class="textAlignVer">Exp.&nbsp;Date&nbsp;05&nbsp;/&nbsp;<?php echo $ExpY;?></div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>	
	</section>				
				
	<?php
		$img_card=array("card_behind01.jpg","card_behind02.jpg","card_behind03.jpg","card_behind04.jpg","card_behind05.jpg","card_behind06.jpg","card_behind07.jpg","card_behind08.jpg");?>
			
	<section class="sheet padding-10mm imgA" style="background-image: url('<?php echo base_url();?>/view/img_user/<?php echo $img_card[6];?>'); background-repeat: no-repeat; background-size: 100%;"></section>	
			
	
			
			
<?php	}else{	?>
	<section class="sheet padding-10mm imgA"></section>			
	<section class="sheet padding-10mm imgA"></section>			
<?php	}?>





				
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



