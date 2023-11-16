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
		if($usercopy==$RcId){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<style>
.psrA{
	margin: auto;
	border: 3px solid #73AD21;
}
</style>
<?php
	//$RcId="18288";
	$this->load->library('session');
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
		<title>พิมพ์รูปนักเรียนขนาด&nbsp;1&nbsp;นิ้ว</title>
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
					size: A5 landscape;
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
				width: 210mm; height: 147mm;
			}
			#imgA{
				width: 210mm; height: 147mm;
			}
			#imgB{
				width: 210mm; height: 147mm;
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
<?php
//-----------------------------------------------------------------------------------
		if(file_exists("view/all/$RcId.jpg")){
			$user_img="$RcId.jpg";
		}else{
            if(file_exists("view/all/$RcId.JPG")){
                $user_img="$RcId.JPG";                       
            }else{
                $user_img="newimg_rc.jpg";                        
            }
        }
//----------------------------------------------------------------------------------- 

?>		
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
									<td><div>A5&nbsp;:&nbsp;210mm&nbsp;X&nbsp;147mm</div></td>
									<td><div>แนวนอน</div></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>		
			</div>		
		</div>
	</div>
	
	<section class="sheet padding-10mm" id="imgA">
		<table>
			<tbody>
				<tr>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
				</tr>
				<tr>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
				</tr>
				<tr>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
				</tr>				
			</tbody>
		</table>			
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
<style>
.psrA{
	margin: auto;
	border: 3px solid #73AD21;
}
</style>
<?php
	//$RcId="18288";
	$this->load->library('session');
?>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>พิมพ์รูปนักเรียนขนาด 1 นิ้ว</title>

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
					size: A5 landscape;
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
				width: 210mm; height: 147mm;
			}
			#imgA{
				width: 210mm; height: 147mm;
			}
			#imgB{
				width: 210mm; height: 147mm;
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
<?php
//-----------------------------------------------------------------------------------
		if(file_exists("view/all/$RcId.jpg")){
			$user_img="$RcId.jpg";
		}else{
            if(file_exists("view/all/$RcId.JPG")){
                $user_img="$RcId.JPG";                       
            }else{
                $user_img="newimg_rc.jpg";                        
            }
        }
//----------------------------------------------------------------------------------- 

?>		
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
									<td><div>A5&nbsp;:&nbsp;210mm&nbsp;X&nbsp;147mm</div></td>
									<td><div>แนวนอน</div></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>		
			</div>		
		</div>
	</div>
	
	<section class="sheet padding-10mm" id="imgA">
		<table>
			<tbody>
				<tr>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
				</tr>
				<tr>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
				</tr>
				<tr>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
					<td><div><img src="<?php echo base_url();?>/view/all/<?php echo $user_img;?>" style="width: 3.00cm; height: 4.00cm" class="img-thumbnail"/></div></td>
				</tr>				
			</tbody>
		</table>			
	</section>	
	
	
	
	</body>
</html>				
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
