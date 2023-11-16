<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<?php
	class connected_summer{
		public $id_summer;
		public $connto_summer;
		function __construct($id_summer){
			$this->id_summer=$id_summer;
			switch($this->id_summer){
				case "127.0.0.1" or "localhost" or "::1";
					$summer_server="localhost";
					$summer_username="root";
					$summer_password="053282395";
					$summer_db="rc_summer";
					$summer_post=3399;
						try{
							$connto_summer=new PDO("mysql:host=$summer_server;dbname=$summer_db;port=$summer_post;charset=utf8",$summer_username,$summer_password);
							$connto_summer->exec("set names utf8");
							$connto_summer->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						}catch(PDOException $e){
							echo "Connection Failed: ->pdo_summer<-".$e->getMessage();
						}				
				break;
				default;
					$summer_server="localhost";
					$summer_username="Regina@ict2022";
					$summer_password="Regina@ict2022";
					$summer_db="rc_summer";
					$summer_post=3306;
						try{
							$connto_summer=new PDO("mysql:host=$summer_server;dbname=$summer_db;port=$summer_post;charset=utf8",$summer_username,$summer_password);
							$connto_summer->exec("set names utf8");
							$connto_summer->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						}catch(PDOException $e){
							echo "Connection Failed: ->pdo_summer<-".$e->getMessage();
						}				
			}
			$this->connto_summer=$connto_summer;	
		}public function run_connto_summer(){
			return $this->connto_summer;
		}
	}
?>
