<?php header('Content-Type: text/html; charset=UTF-8'); ?>
		<?php
			class connect_swiprc{
				public $IdAdderSwiprc;
				public $RunConnSwiprc;
				function __construct($IdAdderSwiprc){
					$this->IdAdderSwiprc=$IdAdderSwiprc;
					switch($this->IdAdderSwiprc){
						case "127.0.0.1" or "localhost" or "::1";
//-----------------------------------------------------------------------	
							$swiprc_server="localhost";
							$swiprc_username="root";
							$swiprc_password="053282395";
							$swiprc_db="regina_swiprc";
							$swiprc_port=3399;
								try{
									$RunConnSwiprc=new PDO("mysql:host=$swiprc_server;dbname=$swiprc_db;port=$swiprc_port;charset=utf8",$swiprc_username,$swiprc_password);
									$RunConnSwiprc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								}catch(PDOException $e_rc){
									echo "Connection to The Swiprc db".$e_rc->getMessage();
								}
//-----------------------------------------------------------------------						
						break;
						default:
//-----------------------------------------------------------------------	
							$swiprc_server="localhost";
							$swiprc_username="Regina@ict2022";
							$swiprc_password="Regina@ict2022";
							$swiprc_db="regina_swiprc";
							$swiprc_port=3306;
								try{
									$RunConnSwiprc=new PDO("mysql:host=$swiprc_server;dbname=$swiprc_db;port=$swiprc_port;charset=utf8",$swiprc_username,$swiprc_password);
									$RunConnSwiprc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								}catch(PDOException $e_rc){
									echo "Connection to The Swiprc db".$e_rc->getMessage();
								}
//-----------------------------------------------------------------------						
					}
					$this->RunConnSwiprc=$RunConnSwiprc;					
				}public function call_RunConnSwiprc(){
					return $this->RunConnSwiprc;
				}
			}
		?>
