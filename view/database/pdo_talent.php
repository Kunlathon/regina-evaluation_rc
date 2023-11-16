<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<?php
	class Connect_PdoTalent{
		public $talent_IP;
		public $connect_talent;
		function __construct($talent_IP){
			$this->talent_IP=$talent_IP;
//******************************************************************************************			
					if($this->talent_IP=="127.0.0.1" or $this->talent_IP=="localhost"){
						$talent_server="localhost";
						$talent_username="root";
						$talent_password="053282395";
						$talent_db="regina_talent";
						$talent_port=3399;
							try{
								$connect_talent=new PDO("mysql:host=$talent_server;dbname=$talent_db;port=$talent_port;charset=utf8",$talent_username,$talent_password);
								$connect_talent->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							}catch(PDOException $e){
								echo "Connection Failed: ->pdo_talent<-". $e->getMessage();
							}
					}else{
						$talent_server="localhost";
						$talent_username="Regina@ict2022";
						$talent_password="Regina@ict2022";
						$talent_db="regina_talent";
						$talent_port=3306;
							try{
								$connect_talent=new PDO("mysql:host=$talent_server;dbname=$talent_db;port=$talent_port;charset=utf8",$talent_username,$talent_password);
								$connect_talent->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							}catch(PDOException $e){
								echo "Connection Failed: ->pdo_talent<-". $e->getMessage();
							}						
					}
//******************************************************************************************					
					if(isset($connect_talent)){
						$this->connect_talent=$connect_talent;
					}else{
						//------------------------------------------------------------------
					}
//******************************************************************************************					
		}function call_PdoTalent(){
			if(isset($this->connect_talent)){
				return $this->connect_talent;
			}else{
				//----------------------------------------------------------------------
			}
		}
	}
?>