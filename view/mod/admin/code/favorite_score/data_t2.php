<?php
	include("../../../../database/database_evaluation.php");
	$rcdata_connect= connect();
	$copy_year=$evaluation_sql->real_escape_string(htmlspecialchars($_POST["copy_year"]));


?>