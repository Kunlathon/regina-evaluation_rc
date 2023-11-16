
	<?php
/* set the cache limiter to 'private' */
	session_cache_limiter("regina");
	$cache_limiter = session_cache_limiter();

/* set the cache expire to 30 minutes */
	session_cache_expire(20);
	$cache_expire = session_cache_expire();

/* start the session */

	session_start();
	ob_start();
	header("Cache-control: private");

	require_once("../database/connect_admin.php");


	$logout_sql="UPDATE `login` SET login_status = 0 , login_update = NULL WHERE login_id = '".$_SESSION["rc_user"]."' ";
	if($admin_connect->query($logout_sql)===TRUE){

		session_destroy();
		header("location:../../index.php");

	}else{
		$sql = "UPDATE `login` SET login_status = 0 , login_update = NULL WHERE login_id = '".$_SESSION["rc_user"]."' ";
		$query = mysqli_query($admin_connect,$sql);

		session_destroy();
		header("location:../../index.php");
	}

?>

