<?php
    header('Content-Type: text/html; charset=UTF-8');

	class connected_bursary{
		public $id_bursary;
        public $connto_bursary;
		function __construct($id_bursary){
			$this->id_bursary=$id_bursary;
			switch($this->id_bursary){
				case "127.0.0.1" or "localhost" or "::1";
					$bursary_server="localhost";
					$bursary_username="root";
					$bursary_password="053282395";
					$bursary_db="regina_fund";
					$bursary_post=3399;
						try{
							$connto_bursary=new PDO("mysql:host=$bursary_server;dbname=$bursary_db;port=$bursary_post;charset=utf8",$bursary_username,$bursary_password);
							$connto_bursary->exec("set names utf8");
							$connto_bursary->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						}catch(PDOException $e){
							echo "Connection Failed: ->pdo_bursary<-".$e->getMessage();
						}				
				break;
				default;
					$bursary_server="localhost";
					$bursary_username="Regina@ict2022";
					$bursary_password="Regina@ict2022";
					$bursary_db="regina_fund";
					$bursary_post=3306;
						try{
							$connto_bursary=new PDO("mysql:host=$bursary_server;dbname=$bursary_db;port=$bursary_post;charset=utf8",$bursary_username,$bursary_password);
							$connto_bursary->exec("set names utf8");
							$connto_bursary->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						}catch(PDOException $e){
							echo "Connection Failed: ->pdo_bursary<-".$e->getMessage();
						}				
			}
			$this->connto_bursary=$connto_bursary;	
		}function run_connto_bursary(){
			return $this->connto_bursary;
		}
	}



?>