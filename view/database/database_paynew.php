<?php

	date_default_timezone_set('Asia/Bangkok');
	$db_pay_mentID=$_SERVER['REMOTE_ADDR'];
	if(isset($db_pay_mentID)){
		if($db_pay_mentID=="127.0.0.1"){
		//db_pay_ment
			$hostname_pay_ment = "127.0.0.1";
			$username_pay_ment = "codebeer2019";
			$password_pay_ment = "codebeer2019";
			$database_pay_ment = "regina_payment";
		}else{
		//db_pay_ment	
			$hostname_pay_ment = "localhost";
			$username_pay_ment = "regina_payment";
			$password_pay_ment = "payment2019";
			$database_pay_ment = "regina_payment";
		}
	}else{
		echo"Error";
	}

?>


<?php
	class conntopdo_payment{
		
		public $id_payment;
		function __construct($id_payment){
			$this->id_payment=$id_payment;
				if($this->id_payment=="127.0.0.1" or $this->id_payment=="localhost" or $this->id_payment=="::1"){
					$payment_server="localhost";
					$payment_username="root";
					$payment_password="053282395";
					$payment_db="regina_payment";
					$payment_post=3399;
						try{
							$connto_payment_evaluation=new PDO("mysql:host=$payment_server;dbname=$payment_db;port=$payment_post;charset=utf8",$payment_username,$payment_password);
							$connto_payment_evaluation->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
						}catch(PDOException $e){
							echo "Connection failed: ->regina_payment<- ".$e->getMessage();
						}
				}else{
					$payment_server="localhost";
					$payment_username="Regina@ict2022";
					$payment_password="Regina@ict2022";
					$payment_db="regina_payment";
					$payment_post=3306;
						try{
							$connto_payment_evaluation=new PDO("mysql:host=$payment_server;dbname=$payment_db;port=$payment_post;charset=utf8",$payment_username,$payment_password);
							$connto_payment_evaluation->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
						}catch(PDOException $e){
							echo "Connection failed: ->regina_payment<- ".$e->getMessage();
						}					
				}
			$this->connto_payment_evaluation=$connto_payment_evaluation;	
		}public function getconnto_payment_evaluationect(){
			return $this->connto_payment_evaluation;
		}
	}
?>



<?php
/*
	class conntopdo_payment{
		private $connto_payment_evaluation;
		private $dsn_mysql="mysql:host=localhost;dbname=regina_payment;post=3308;charset=utf8";
		private $dsn_sqlite="sqlite:my_sqlite.db";
		private $user="codebeer2019";
		private $password="codebeer2019";

		public function __construct($db){
			//$this->connto_payment_evaluation=$connto_payment_evaluation;
			//$this->dsn_mysql=$dsn_mysql;
			//$this->dsn_sqlite=$dsn_sqlite;
			//$this->user=$user;
			//$this->password=$password;
			
			try{
				switch($db){
					case "mysql":
					
					$this->connto_payment_evaluation = new PDO($this->dsn_mysql, $this->user, $this->password);
					// set the PDO error mode to exception
					$this->connto_payment_evaluation->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					//echo "connto_payment_evaluationected successfully";
					
					break;
					
					case "sqlite":
					
					$this->connto_payment_evaluation=new PDO($this->dsn_sqlite);
					break;
					
				default : echo "No database ->database_paynew<-..regina_payment.."; break;
					
				}
			}
			catch(PDOException $e){
				die('Could not ->database_paynew<- to database because'.$e->getmessage());
				
			}
		}
		public function getconnto_payment_evaluationect(){
			return $this->connto_payment_evaluation;
		}
	}*/
?>










