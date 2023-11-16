<meta charset="utf-8">

<?php
	date_default_timezone_set('Asia/Bangkok');
   /* $ip_activity=$_SERVER["REMOTE_ADDR"];
    if(isset($ip_activity)){
        if($ip_activity=="127.0.0.1"){
            $activity_host="127.0.0.1";
            $activity_user="codebeer2019";
            $activity_password="codebeer2019";
            $activity_database="regina_activity";
        }else{
            $activity_host="localhost";
            $activity_user="regina_activity";
            $activity_password="activity_rc2020";
            $activity_database="regina_activity";
        }
    }*/
?>



<?php
	class conntopdo_activity{
		public $id_system;
		public $connto_dataactivity_rc;
		function __construct($id_system){
			$this->id_system=$id_system;
				if($this->id_system=="127.0.0.1" or $this->id_system=="localhost" or $this->id_system=="::1"){
					$activity_server="localhost";
					$activity_username="root";
					$activity_password="053282395";
					$activity_db="regina_activity";
					$activity_port=3399;
						try{
							$connto_dataactivity_rc=new PDO("mysql:host=$activity_server;dbname=$activity_db;port=$activity_port;charset=utf8",$activity_username,$activity_password);
							$connto_dataactivity_rc->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
						}catch(PDOException $e){
							echo "Connection failed: ->pdo_activity<-";
						}
				}else{
					$activity_server="localhost";
					$activity_username="Regina@ict2022";
					$activity_password="Regina@ict2022";
					$activity_db="regina_activity";
					$activity_port=3306;
						try{
							$connto_dataactivity_rc=new PDO("mysql:host=$activity_server;dbname=$activity_db;port=$activity_port;charset=utf8",$activity_username,$activity_password);
							$connto_dataactivity_rc->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
						}catch(PDOException $e){
							echo "Connection failed: ->pdo_activity<-";
						}					
				}
			$this->connto_dataactivity_rc=$connto_dataactivity_rc;	
		}public function getconnto_connto_dataactivity_rc(){
			return $this->connto_dataactivity_rc;
		}
	}

?>



<?php
    /*class conntopdo_activity{

        private $connto_dataactivity_rc;
        private $dsn_mysql="mysql:host=localhost;dbname=regina_activity;post=3308;charset=utf8";
		private $dsn_sqlite="sqlite:my_sqlite.db";
		private $user="codebeer2019";
        private $password="codebeer2019";
        
        public function __construct($db){
            try{
				switch($db){
					case "mysql":
					
					$this->connto_dataactivity_rc = new PDO($this->dsn_mysql, $this->user, $this->password);
					// set the PDO error mode to exception
					$this->connto_dataactivity_rc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					//echo "connto_datastuto_datastuected successfully";
					
					break;
					
					case "sqlite":
					
					$this->connto_dataactivity_rc=new PDO($this->dsn_sqlite);
					break;
					
				default : echo "No database ->pdo_activity<-..regina_activity.."; break;
					
				}
			}
			catch(PDOException $e){
				die('Could not ->pdo_activity<- to database because'.$e->getmessage());
			}
        }public function getconnto_connto_dataactivity_rc(){
			return $this->connto_dataactivity_rc;
		}

    }*/
?>