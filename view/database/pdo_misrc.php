<?php
	class Connection_MISRC{
		public $id_addsystem;
		function __construct($id_addsystem){
			$this->id_addsystem=$id_addsystem;	
				if($this->id_addsystem=="127.0.0.1" or $this->id_addsystem=="localhost" or $this->id_addsystem=="::1"){
//Run...id 127.0.0.1++++++++++++++++++++++++++++++++++++++++++++++++					
					$MISRC_server="localhost";
					$MISRC_username="Regina@ict2022";
					$MISRC_password="Regina@ict2022";
					$MISRC_db="regina_mis";
					$MISRC_port=3306;
						try{
							$conn_dbMISRC=new PDO("mysql:host=$MISRC_server;dbname=$MISRC_db;port=$MISRC_port;charset=utf8",$MISRC_username,$MISRC_password);
							$conn_dbMISRC->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
						}catch(PDOException $e){
							echo "Connection failed: ->regina_mis<- ".$e->getMessage();
						}
//Run...id 127.0.0.1 End++++++++++++++++++++++++++++++++++++++++++++					
				}else{
//Not Run...id 127.0.0.1++++++++++++++++++++++++++++++++++++++++++++++++					
					$MISRC_server="localhost";
					$MISRC_username="Regina@ict2022";
					$MISRC_password="Regina@ict2022";
					$MISRC_db="regina_mis";
					$MISRC_port=3306; //ปกติจะอยู่ใน port 3306
						try{
							$conn_dbMISRC=new PDO("mysql:host=$MISRC_server;dbname=$MISRC_db;post=$MISRC_port;charset=utf8",$MISRC_username,$MISRC_password);
							$conn_dbMISRC->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
						}catch(PDOException $e){
							echo "Connection failed: ->regina_MISRC2<-".$e->getMessage();
						}
//Not Run...id 127.0.0.1 End++++++++++++++++++++++++++++++++++++++++++++					
				}
			$this->conn_dbMISRC=$conn_dbMISRC;
		}function Call_Connection_MISRC(){
			return $this->conn_dbMISRC;
		}
	}
?>