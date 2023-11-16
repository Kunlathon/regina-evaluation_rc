<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<?php
	class Connection_Health{
		public $id_addsystem;
		function __construct($id_addsystem){
			$this->id_addsystem=$id_addsystem;	
				if($this->id_addsystem=="127.0.0.1" or $this->id_addsystem=="localhost" or $this->id_addsystem=="::1"){
//Run...id 127.0.0.1++++++++++++++++++++++++++++++++++++++++++++++++					
					$health_server="localhost";
					$health_username="Regina@ict2022";
					$health_password="Regina@ict2022";
					$health_db="regina_health";
					$health_port=3306;
						try{
							$conn_dbhealth=new PDO("mysql:host=$health_server;dbname=$health_db;port=$health_port;charset=utf8",$health_username,$health_password);
							$conn_dbhealth->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
						}catch(PDOException $e){
							echo "Connection failed: ->regina_health<- ".$e->getMessage();
						}
//Run...id 127.0.0.1 End++++++++++++++++++++++++++++++++++++++++++++					
				}else{
//Not Run...id 127.0.0.1++++++++++++++++++++++++++++++++++++++++++++++++					
					$health_server="localhost";
					$health_username="Regina@ict2022";
					$health_password="Regina@ict2022";
					$health_db="regina_health";
					$health_port=3306; //ปกติจะอยู่ใน port 3306
						try{
							$conn_dbhealth=new PDO("mysql:host=$health_server;dbname=$health_db;post=$health_port;charset=utf8",$health_username,$health_password);
							$conn_dbhealth->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
						}catch(PDOException $e){
							echo "Connection failed: ->regina_health2<-".$e->getMessage();
						}
//Not Run...id 127.0.0.1 End++++++++++++++++++++++++++++++++++++++++++++					
				}
			$this->conn_dbhealth=$conn_dbhealth;
		}public function Call_Connection_Health(){
			return $this->conn_dbhealth;
		}
	}
?>