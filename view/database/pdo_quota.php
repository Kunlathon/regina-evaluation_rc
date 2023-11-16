<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<?php
	date_default_timezone_set('Asia/Bangkok');
//--------------------------------------------------------------
		/*$db_quotaPDOID=$_SERVER["REMOTE_ADDR"];
		if(isset($db_quotaPDOID)){
			if($db_quotaPDOID=="127.0.0.1"){
				$hostname_PODquota="localhost";
				$username_PODquota="codebeer2019";
				$password_PODquota="codebeer2019";
				$database_PODquota="regina_quota";
			}else{
				$hostname_PODquota="localhost";
				$username_PODquota="regina_quota";
				$password_PODquota="reginaquota16";
				$database_PODquota="regina_quota";			
			}
		}else{
			$db_quotaPDOID=Null;
		}*/
//---------------------------------------------------------------			
	//"mysql:host=localhost;dbname=regina_student;charset=utf8";
	
	
	class conntoppdo_stuquota{
		public $id_stuquota;
		public $connto_stuquota;
		function __construct($id_stuquota){
			$this->id_stuquota=$id_stuquota;
				if($this->id_stuquota=="127.0.0.1" or $this->id_stuquota=="localhost" or $this->id_stuquota=="::1"){
					$stuquota_server="localhost";
					$stuquota_username="root";
					$stuquota_password="053282395";
					$stuquota_db="regina_quota";
					$stuquota_post=3399;
						try{
							$connto_stuquota=new PDO("mysql:host=$stuquota_server;dbname=$stuquota_db;port=$stuquota_post;charset=utf8",$stuquota_username,$stuquota_password);
							$connto_stuquota->exec("set names utf8");
							$connto_stuquota->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						}catch(PDOException $e){
							echo "Connection Failed: ->pdo_quota<-".$e->getMessage();
						}
				}else{
					$stuquota_server="localhost";
					$stuquota_username="Regina@ict2022";
					$stuquota_password="Regina@ict2022";
					$stuquota_db="regina_quota";
					$stuquota_post=3306;
						try{
							$connto_stuquota=new PDO("mysql:host=$stuquota_server;dbname=$stuquota_db;port=$stuquota_post;charset=utf8",$stuquota_username,$stuquota_password);
							$connto_stuquota->exec("set names utf8");
							$connto_stuquota->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						}catch(PDOException $e){
							echo "Connection Failed: ->pdo_quota<-".$e->getMessage();
						}					
				}	
			$this->connto_stuquota=$connto_stuquota;	
		}public function getconnto_stuquota(){
			return $this->connto_stuquota;
		}
	}
	
	
	/*class conntoppdo_stuquota{

		private $connto_stuquota;
		private $dsn_mysql="mysql:host=localhost;dbname=regina_quota;port=3308;charset=utf8";
		private $dsn_sqlite="sqlite:my_sqlite.db";
		private $user="codebeer2019";
		private $password="codebeer2019";
		
		public function __construct($quota_db){
			try{
				switch($quota_db){
					case "mysql":
					$this->connto_stuquota=new PDO($this->dsn_mysql, $this->user, $this->password);
					$this->connto_stuquota->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					break;
					
					case "sqlite":
					
					$this->connto_stuquota=new PDO($this->dsn_sqlite);
					break;
					
					default  : echo "No database ->pdo_quota<-..regina_quota.."; break;
				}
			}
				catch(PDOException $e){
					die('Could not ->pdo_quota<- to database because'.$e->getmessage());
				}
				
		}
			public function  getconnto_stuquota(){
				return $this->connto_stuquota;
			}
	}*/

?>
