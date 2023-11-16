<meta charset="utf-8">

<?php
	class connect_concert{
		//public $id_system;
		function __construct(){
			$db_concertID=$_SERVER['REMOTE_ADDR'];
//------------------------------------------------------------------------------------------------------------			
				if($db_concertID=="127.0.0.1" or $db_concertID=="localhost" or $db_concertID=="::1"){
					$concert_server="localhost";
					$concert_username="Regina@coding2022";
					$concert_password="Regina@coding2022";
					$concert_db="concert_regina";
					$concert_post=3306;
						try{
							$ConnectConcert= new PDO("mysql:host=$concert_server;dbname=$concert_db;port=$concert_post;charset=utf8",$concert_username,$concert_password);
							$ConnectConcert->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							//echo "Connected successfully";
						}catch(PDOException $e){
							echo "Connection failed: ->pdo_weekend<-" . $e->getMessage();
						}
				}else{
					$concert_server="localhost";
					$concert_username="Regina@coding2022";
					$concert_password="Regina@coding2022";
					$concert_db="concert_regina";
					$concert_post=3306;
						try{
							$ConnectConcert= new PDO("mysql:host=$concert_server;dbname=$concert_db;port=$concert_post;charset=utf8",$concert_username,$concert_password);
							$ConnectConcert->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							//echo "Connected successfully";
						}catch(PDOException $e){
							echo "Connection failed: ->pdo_weekend<-" . $e->getMessage();
						}					
				}		
//------------------------------------------------------------------------------------------------------------				
			$this->ConnectConcert=$ConnectConcert;
		}function connect_db_ConcertRc(){
			return $this->ConnectConcert;
		}
	}
?>

