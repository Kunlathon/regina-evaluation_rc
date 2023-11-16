<?php
	session_start();
	header("cache-Control: max-age=0; no-cache; must-revalidate");
    include("../../../../database/database_evaluation.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ระบบนักเรียน โรงเรียนเรนีนาเชลีวิทยาลัย</title>
</head>
<?php
	$model1=post_data($_POST["model1"]);
	$model2=post_data($_POST["model2"]);
	$user_login=post_data($_POST["user_login"]);
	
	if(isset($user_login)){
		$user_login="UPDATE `login` 
					 SET `model1`='{$model1}'
					    ,`model2`='{$model2}' 
					 WHERE `login_rc`='{$user_login}';";
		$user_loginCr=add_rc($user_login);
		if($user_loginCr=="yes"){
			exit("<script>window.location='../../../../../index.php?evaluation_mod=account_settings';</script>");
		}else{
			exit("<script>window.location='../../../../../index.php?evaluation_mod=account_settings';</script>");
		}		
	}else{
		
	}
?>
<body>
</body>
</html>


