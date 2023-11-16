<?php
	class count_newstu{
		public $id_system;
		public $conndb_newstu;
		function __construct($id_system){
			$this->id_system=$id_system;
				if($this->id_system=="127.0.0.1" or $this->id_system=="localhost" or $this->id_system=="::1"){
					$newstu_server="localhost";
					$newstu_username="Regina@ict2022";
					$newstu_password="Regina@ict2022";
					$newstu_db="regina_student";
					$newstu_port=3306;
						try{
							$conndb_newstu= new PDO("mysql:host=$newstu_server;dbname=$newstu_db;port=$newstu_port;charset=utf8",$newstu_username,$newstu_password);
							$conndb_newstu->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							//echo "Connected successfully";
						}catch(PDOException $e){
							echo "Connection failed: ->pdo_newstu<-" . $e->getMessage();
						}
				}else{
					$newstu_server="localhost";
					$newstu_username="Regina@ict2022";
					$newstu_password="Regina@ict2022";
					$newstu_db="regina_student";
					$newstu_port=3306;
						try{
							$conndb_newstu= new PDO("mysql:host=$newstu_server;dbname=$newstu_db;port=$newstu_port;charset=utf8",$newstu_username,$newstu_password);
							$conndb_newstu->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							//echo "Connected successfully";
						}catch(PDOException $e){
							echo "Connection failed: ->pdo_newstu<-" . $e->getMessage();
						}					
				}
		$this->conndb_newstu=$conndb_newstu;
		}public function call_coun_newstu(){
			return $this->conndb_newstu;
		}
	}
?>

<?php
//print_plan->pdo
	class print_plan{
		public $plan;
		public $plan_Name,$plan_LName;
		function __construct($plan){
			
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$sever_newstu=new count_newstu($db_evaluationID);
			$sever_newstu=$sever_newstu->call_coun_newstu();
			
			$this->plan=$plan;

			$plan_sql="SELECT `Name`,`LName` FROM `rc_plan` WHERE `IDPlan`='{$this->plan}'";
			if($plan_rs=$sever_newstu->query($plan_sql)){
				$plan_row=$plan_rs->Fetch(PDO::FETCH_ASSOC);
				$plan_Name=$plan_row["Name"];
				$plan_LName=$plan_row["LName"];
			}else{
				$plan_Name="";
				$plan_LName="";
			}
			$sever_newstu=Null;
				if(isset($plan_Name,$plan_LName)){
					$this->plan_Name=$plan_Name;
					$this->plan_LName=$plan_LName;					
				}else{
					//----------------------------
				}
		}
		function __destruct(){
			if(isset($this->plan_Name,$this->plan_LName)){
				$this->plan_Name;
				$this->plan_LName;				
			}else{
				//---------------------------------
			}
		}
	}

?>


