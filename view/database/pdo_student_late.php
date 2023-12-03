<?php
    header('Content-Type: text/html; charset=UTF-8');
    class connect_database_student_late{
        public $cdsl_ip;
        public $connto_student_late;
        function __construct($cdsl_ip){
            $this->cdsl_ip=$cdsl_ip;
                if(($this->cdsl_ip=="::1" OR $this->cdsl_ip=="127.0.0.1" OR $this->cdsl_ip=="localhost")){
                    $student_late_server="localhost";
					$student_late_username="root";
					$student_late_password="053282395";
					$student_late_db="rc_student_late";
					$student_late_port=3399;
                    try{
                        $connto_student_late=new PDO("mysql:host=$student_late_server;dbname=$student_late_db;port=$student_late_port;charset=utf8",$student_late_username,$student_late_password);
                        $connto_student_late->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    }catch(PDOException $e){
                        $connto_student_late=null;
                        echo "Connection failed: ->rc_student_late<-";
                    }
                }else{
                    $student_late_server="localhost";
					$student_late_username="Regina@ict2022";
					$student_late_password="Regina@ict2022";
					$student_late_db="rc_student_late";
					$student_late_port=3306;
                    try{
                        $connto_student_late=new PDO("mysql:host=$student_late_server;dbname=$student_late_db;port=$student_late_port;charset=utf8",$student_late_username,$student_late_password);
                        $connto_student_late->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    }catch(PDOException $e){
                        $connto_student_late=null;
                        echo "Connection failed: ->rc_student_late<-";
                    }
                }
            $this->connto_student_late=$connto_student_late;	
        }public function getconnto_connto_student_late(){
			return $this->connto_student_late;
		}
    }
?>

