<meta charset="utf-8">
<?php
	date_default_timezone_set('Asia/Bangkok');
	class conntopdo_release{
		public $id_system;
		function __construct($id_system){
			$this->id_system=$id_system;
				if($this->id_system=="127.0.0.1" or $this->id_system=="localhost" or $this->id_system=="::1"){
					$release_server="localhost";
					$release_username="root";
					$release_password="053282395";
					$release_db="regina_release";
					$release_port=3399;
						try{
							$connto_release=new PDO("mysql:host=$release_server;dbname=$release_db;port=$release_port;charset=utf8",$release_username,$release_password);
							$connto_release->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
						}catch(PDOException $e){
							echo "Connection failed: ->pdo_release<-";
						}
				}else{
					$release_server="localhost";
					$release_username="Regina@ict2022";
					$release_password="Regina@ict2022";
					$release_db="regina_release";
					$release_port=3306;
						try{
							$connto_release=new PDO("mysql:host=$release_server;dbname=$release_db;port=$release_port;charset=utf8",$release_username,$release_password);
							$connto_release->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
						}catch(PDOException $e){
							echo "Connection failed: ->pdo_release<-";
						}					
				}
			$this->connto_release=$connto_release;	
		}public function getconnto_connto_release(){
			return $this->connto_release;
		}
	}

?>



<?php
    /*class conntopdo_release{

        private $connto_release;
        private $dsn_mysql="mysql:host=localhost;dbname=regina_release;post=3308;charset=utf8";
		private $dsn_sqlite="sqlite:my_sqlite.db";
		private $user="codebeer2019";
        private $password="codebeer2019";
        
        public function __construct($db){
            try{
				switch($db){
					case "mysql":
					
					$this->connto_release = new PDO($this->dsn_mysql, $this->user, $this->password);
					// set the PDO error mode to exception
					$this->connto_release->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					//echo "connto_datastuto_datastuected successfully";
					
					break;
					
					case "sqlite":
					
					$this->connto_release=new PDO($this->dsn_sqlite);
					break;
					
				default : echo "No database ->pdo_release<-..regina_release.."; break;
					
				}
			}
			catch(PDOException $e){
				die('Could not ->pdo_release<- to database because'.$e->getmessage());
			}
        }public function getconnto_connto_release(){
			return $this->connto_release;
		}

    }*/
?>