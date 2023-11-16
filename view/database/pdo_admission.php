<!doctype html>
<html>
<head>
<meta charset="urf-8">
<title></title>
	<body>
		<?php
			class connect_Admission{
				public $IdAdderAdmission;
				public $RunConnAdmission;
				function __construct($IdAdderAdmission){
					$this->IdAdderAdmission=$IdAdderAdmission;
					switch($this->IdAdderAdmission){
						case "127.0.0.1" or "localhost" or "::1";
//-----------------------------------------------------------------------	
							$Admission_server="localhost";
							$Admission_username="root";
							$Admission_password="053282395";
							$Admission_db="regina_admission";
							$Admission_port=3399;
								try{
									$RunConnAdmission=new PDO("mysql:host=$Admission_server;dbname=$Admission_db;port=$Admission_port;charset=utf8",$Admission_username,$Admission_password);
									$RunConnAdmission->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								}catch(PDOException $e_rc){
									echo "Connection to The Admission db".$e_rc->getMessage();
								}
//-----------------------------------------------------------------------						
						break;
						default:
//-----------------------------------------------------------------------	
							$Admission_server="localhost";
							$Admission_username="Regina@ict2022";
							$Admission_password="Regina@ict2022";
							$Admission_db="regina_admission";
							$Admission_port=3306;
								try{
									$RunConnAdmission=new PDO("mysql:host=$Admission_server;dbname=$Admission_db;port=$Admission_port;charset=utf8",$Admission_username,$Admission_password);
									$RunConnAdmission->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								}catch(PDOException $e_rc){
									echo "Connection to The Admission db".$e_rc->getMessage();
								}
//-----------------------------------------------------------------------						
					}
					$this->RunConnAdmission=$RunConnAdmission;					
				}function call_RunConnAdmission(){
					return $this->RunConnAdmission;
				}
			}
		?>
	</body>
</head>
