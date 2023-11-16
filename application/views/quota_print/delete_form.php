<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="shortcut icon" href="<?php echo base_url();?>/Template/global_assets/images/logo_rc_wbe.ico"/>
	</head>
	<body>
		<?php
			$this->load->library('session');
//----------------------------------------------------------------------------    
			include("view/img_user/document/gotolink.php");//-----------------
			$goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
			$golink=$goingtolink->Rungotolink();//----------------------------
//----------------------------------------------------------------------------
			include("view/database/pdo_quota.php");
			include("view/database/class_quota.php");
//----------------------------------------------------------------------------			
			if($this->session->userdata("rc_user")==null){
				$this->session->unset_userdata("rc_user");
				exit("<script>window.location='$golink';</script>");
			}else{
				$txt_key=filter_input(INPUT_POST,'txt_key');    
				$txt_year=filter_input(INPUT_POST,'txt_year');    
				$txt_year_new=filter_input(INPUT_POST,'txt_year_new');
				/*$txt_key="16968";
				$txt_year="2564";
				$txt_year_new="2565";*/
					if(isset($txt_key,$txt_year,$txt_year_new)){
						$DeleteForm=new CancelForm($txt_key,$txt_year,$txt_year_new);
							if($DeleteForm->RunCancelForm()=="Delete"){
								exit("<script>window.location='$golink';</script>");
								//echo "Delete";
							}elseif($DeleteForm->RunCancelForm()=="NoDelete"){
								exit("<script>window.location='$golink';</script>");
								//echo "NoDelete";
							}else{
								exit("<script>window.location='$golink';</script>");
							}
					}else{
						exit("<script>window.location='$golink';</script>");
						//echo "Error";
					}
			}
		?>
	</body>
</html>