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

	$txt_t=substr($txt_year,0,1);
	$txt_y=substr($txt_year,2,4);

	$txt_level=new print_level($txt_class);
	
		if($txt_class==3){
			$file_img="sud_img03";
		}elseif($txt_class>=11 and $txt_class<=22){
			$file_img="sud_img1122";
		}elseif($txt_class>=23 and $txt_class<=33){
			$file_img="sud_img2333";
		}elseif($txt_class>=41 and $txt_class<=43){
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
		<title>พิมพ์&nbsp;รูปนักเรียน</title>
		<link rel="shortcut icon" href="<?php echo base_url();?>/Template/global_assets/images/logo_rc_wbe.ico"/>
<!-- Global stylesheets -->
		<link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
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
				font-size: 20px;
				color: #032E3B;
			}
		</style>
	
		<style>
			@media print {
				
				@page{
					size: A4;
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
					font-size: 14pt; 
							
				}
			}
			
			body{
				width: 210mm; height: 296mm;
			}
			.imgA{
				width: 210mm; height: 296mm;
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
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/bootstrap.min.js"></script>
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
										<div><button type="button"  class="btn btn-default" onclick="window.print()"><b>พิมพ์ รูปนักเรียน</b></button></div>
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
									<td><div>A4&nbsp;:&nbsp;210mm&nbsp;X&nbsp;296mm</div></td>
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
		$psr_count=1;
	?>

	<section class="sheet padding-10mm imgA">
		<table style="width: 100%; text-align: right;">
			<tbody>
				<tr>
					<td>
						<div><?php echo "หน้าที่ &nbsp;".$psr_count;?></div>
					</td>
				</tr>
			</tbody>
		</table>
		<table  style="width: 100%">
			<tbody>
				<tr>
					<td colspan="4">
						<div>
							<center><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" width="96" height="91"></center> 
						</div>
						<div>
							<center>รูปนักเรียน  ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></center>
						</div>
					</td>
				</tr>
				
				<tr>

	<?php
		$data_sturcroom=new data_sturoom($txt_t,$txt_y,$txt_class,$txt_room);
	  	$count_img=0;
		$count_print=0;
		$count_p=0;
		foreach($data_sturcroom->printdata_sturoom as $rc_key=>$sturcroom_rom){
			$rsc_num=$sturcroom_rom["rsc_num"];
			$rsd_studentid=$sturcroom_rom["rsd_studentid"];
			$name_th=$sturcroom_rom["rsd_name"]." ".$sturcroom_rom["rsd_surname"];
			$rsd_Identification=$sturcroom_rom["rsd_Identification"];
			$data_prefix=new print_prefix($rsd_prefix=$sturcroom_rom["rsd_prefix"]);
			$data_plan=new print_plan($rsc_plan=$sturcroom_rom["rsc_plan"]);
			$count_img=$count_img+1;
			$count_print=$count_print+1;
			
//-----------------------------------------------------------------------------------
				if(file_exists("view/$file_img/$rsd_studentid.jpg")){
					$user_img="$rsd_studentid.jpg";
				}else{
                    if(file_exists("view/$file_img/$rsd_studentid.JPG")){
                        $user_img="$rsd_studentid.JPG";                       
                    }else{
						if($txt_class==22){
							$user_img="sud_img2333";
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
//----------------------------------------------------------------------------------- 
				
				if($count_img%4==0){ ?>
					<td style="width: 25%">
						<div><center><img src="<?php echo base_url();?>/view/<?php echo $file_img;?>/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></center></div>
						<div><center><small><?php echo $rsd_studentid;?> - <?php echo $name_th;?></small></center></div>
					</td>
				</tr>
				<tr>
				
		<?php	if($count_print%20==0){ 
					$psr_count=$psr_count+1;
		?>
		
			</tbody>
		</table>			
	</section>
	
	<section class="sheet padding-10mm imgA">
		<table style="width: 100%; text-align: right;">
			<tbody>
				<tr>
					<td>
						<div><?php echo "หน้าที่ &nbsp;".$psr_count;?></div>
					</td>
				</tr>
			</tbody>
		</table>	
		<table style="width: 100%">
			<tbody>
				<tr>
					<td colspan="4">
						<div>
							<center><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" width="96" height="91"></center> 
						</div>
						<div>
							<center>รูปนักเรียน  ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></center>
						</div>
					</td>
				</tr>			

		<?php	}else{
					//-----------------------------------------------
				}?>
				
				
				
		<?php	}else{ ?>
					<td style="width: 25%">
						<div><center><img src="<?php echo base_url();?>/view/<?php echo $file_img;?>/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></center></div>
						<div><center><small><?php echo $rsd_studentid;?> - <?php echo $name_th;?></small></center></div>
					</td>
		<?php	}
		
		
		}
	?>	
				
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



