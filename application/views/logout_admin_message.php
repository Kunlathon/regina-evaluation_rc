<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

	<?php
/* set the cache limiter to 'private' */
	//session_cache_limiter("regina");
	//$cache_limiter = session_cache_limiter();

/* set the cache expire to 30 minutes */
	//session_cache_expire(20);
	//$cache_expire = session_cache_expire();

/* start the session */

	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
	header("Content-Type: text/html; charset=utf-8");
	header("Cache-control: private");
	
	require_once("view/database/connect_admin.php");
	$logout_sql="UPDATE `login` SET login_status = 0 , login_update = NULL WHERE login_id = '".$_SESSION["rc_user"]."' ";
	if($admin_connect->query($logout_sql)===TRUE){

		$this->session->unset_userdata('rc_user');
		exit("<script>window.location='$golink/rc';</script>");
	}else{
		$sql = "UPDATE `login` SET login_status = 0 , login_update = NULL WHERE login_id = '".$_SESSION["rc_user"]."' ";
		$query = mysqli_query($admin_connect,$sql);

		$this->session->unset_userdata('rc_user');
		exit("<script>window.location='$golink/rc';</script>");
	}

?>

