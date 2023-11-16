<?php header('Content-Type: text/html; charset=UTF-8'); ?>

<?php
	class count_pdodata{
		public $id_system;
		function __construct($id_system){
			$this->id_system=$id_system;
				if($this->id_system=="127.0.0.1" or $this->id_system=="localhost" or $this->id_system=="::1"){
					$newstu_server="localhost";
					$newstu_username="root";
					$newstu_password="053282395";
					$newstu_db="regina_student";
					$newstu_port=3399;
						try{
							$conndb_pdodata= new PDO("mysql:host=$newstu_server;dbname=$newstu_db;port=$newstu_port;charset=utf8",$newstu_username,$newstu_password);
							$conndb_pdodata->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							//echo "Connected successfully";
						}catch(PDOException $e){
							echo "Connection failed: ->pdo_newstu<-" . $e->getMessage();
						}
				}else{
					$newstu_server="localhost";
					$newstu_username="Regina@ict2022";
					$newstu_password="Regina@ict2022";
					$newstu_db="regina_student";
					$newstu_port=3306;
						try{
							$conndb_pdodata= new PDO("mysql:host=$newstu_server;dbname=$newstu_db;port=$newstu_port;charset=utf8",$newstu_username,$newstu_password);
							$conndb_pdodata->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							//echo "Connected successfully";
						}catch(PDOException $e){
							echo "Connection failed: ->pdo_newstu<-" . $e->getMessage();
						}					
				}
		$this->conndb_pdodata=$conndb_pdodata;
		}function call_pdodata(){
			return $this->conndb_pdodata;
		}
	}
?>

<?php
//การเชื่อมแบบเก่าที่ยังมีการใช้งานอยู่ RC0468************************************************ 
//**********************************************************************
	class conntopdo_evaluationto{
		private $connto_evaluationto_evaluation;
		private $dsn_mysql="mysql:host=localhost;dbname=regina_student;charset=utf8;port=3399";
		private $dsn_sqlite="sqlite:my_sqlite.db";
		/*private $user="regina_student";
		private $password="student2019";*/
		private $user="root";
		private $password="053282395";

		public function __construct($db){
			//$this->connto_evaluationto_evaluation=$connto_evaluationto_evaluation;
			//$this->dsn_mysql=$dsn_mysql;
			//$this->dsn_sqlite=$dsn_sqlite;
			//$this->user=$user;
			//$this->password=$password;
			
			try{
				switch($db){
					case "mysql":
					
					$this->connto_evaluationto_evaluation = new PDO($this->dsn_mysql, $this->user, $this->password);
					// set the PDO error mode to exception
					$this->connto_evaluationto_evaluation->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					//echo "connto_evaluationto_evaluationected successfully";
					
					break;
					
					case "sqlite":
					
					$this->connto_evaluationto_evaluation=new PDO($this->dsn_sqlite);
					break;
					
				default : echo "No database connto_evaluationto_evaluationecting"; break;
					
				}
			}
			catch(PDOException $e){
				die('Could not connto_evaluationto_evaluationection to database because'.$e->getmessage());
				
			}
		}
		function getconnto_evaluationto_evaluationect(){
			return $this->connto_evaluationto_evaluation;
		}
	}


?>



