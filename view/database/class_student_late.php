<?php
    header('Content-Type: text/html; charset=UTF-8');
    
//รันระยะเวลาเรียน เทอม และ ปีการศึกษา
    class SetTimeSL{ 
        public $STSL_Type,$STSL_T,$STSL_Y;
        public $SetTimeSL_Array,$SetTimeSL_Error;
        function __construct($STSL_Type,$STSL_T,$STSL_Y){
            $Student_Late_Ip=$_SERVER['REMOTE_ADDR'];
            $Student_Late_Connect= new connect_database_student_late($Student_Late_Ip);
            $pdo_student_late=$Student_Late_Connect->getconnto_connto_student_late();
            $this->STSL_Type=$STSL_Type;
            $this->STSL_T=$STSL_T;
            $this->STSL_Y=$STSL_Y;
            $SetTimeSL_Error="Error";
            $SetTimeSL_Array=array();
                if(($this->STSL_Type=="Loop")){
                    try{
                        $SetTimeSL_Sql="SELECT * FROM `sl_set_year` ORDER BY `ssy_id` DESC";
                            if(($SetTimeSL_Rs=$pdo_student_late->query($SetTimeSL_Sql))){
                                while($SetTimeSLRow=$SetTimeSL_Rs->Fetch(PDO::FETCH_ASSOC)){
                                    if((is_array($SetTimeSLRow) AND count($SetTimeSLRow))){
                                        $SetTimeSL_Array[]=$SetTimeSLRow;
                                        $SetTimeSL_Error="NotError";
                                    }else{
                                        $SetTimeSL_Array="-";
                                        $SetTimeSL_Error="Error";
                                    }                                
                                }
                            }else{
                                $SetTimeSL_Array="-";
                                $SetTimeSL_Error="Error";
                            }
                    }catch(PDOException $e){
                        $SetTimeSL_Array="-";
                        $SetTimeSL_Error="Error";
                    }
                }elseif(($this->STSL_Type=="Row")){
                    try{
                        $SetTimeSL_Sql="SELECT * FROM `sl_set_year` ORDER BY `ssy_id` DESC;";
                            if(($SetTimeSL_Rs=$pdo_student_late->query($SetTimeSL_Sql))){
                                $SetTimeSLRow=$SetTimeSL_Rs->Fetch(PDO::FETCH_ASSOC);
                                if((is_array($SetTimeSLRow) AND count($SetTimeSLRow))){
                                    $SetTimeSL_Array[]=$SetTimeSLRow;
                                    $SetTimeSL_Error="NotError";
                                }else{
                                    $SetTimeSL_Array="-";
                                    $SetTimeSL_Error="Error";
                                }
                            }else{
                                $SetTimeSL_Array="-";
                                $SetTimeSL_Error="Error";
                            }
                    }catch(PDOException $e){
                        $SetTimeSL_Array="-";
                        $SetTimeSL_Error="Error";
                    }
                }elseif(($this->STSL_Type=="Row_Id")){
                    try{
                        $SetTimeSL_Sql="SELECT * FROM `sl_set_year` WHERE `ssy_id` ='{$this->STSL_T}';";
                            if(($SetTimeSL_Rs=$pdo_student_late->query($SetTimeSL_Sql))){
                                $SetTimeSLRow=$SetTimeSL_Rs->Fetch(PDO::FETCH_ASSOC);
                                if((is_array($SetTimeSLRow) AND count($SetTimeSLRow))){
                                    $SetTimeSL_Array[]=$SetTimeSLRow;
                                    $SetTimeSL_Error="NotError";
                                }else{
                                    $SetTimeSL_Array="-";
                                    $SetTimeSL_Error="Error";
                                }
                            }else{
                                $SetTimeSL_Array="-";
                                $SetTimeSL_Error="Error";
                            }
                    }catch(PDOException $e){
                        $SetTimeSL_Array="-";
                        $SetTimeSL_Error="Error";
                    }
                }else{
                    $SetTimeSL_Array="-";
                    $SetTimeSL_Error="Error";
                }
            $pdo_student_late=null;
            $this->SetTimeSL_Array=$SetTimeSL_Array;
            $this->SetTimeSL_Error=$SetTimeSL_Error;
        }function PrintSetTime(){
            return $this->SetTimeSL_Array;
        }function ErrorSetTime(){
            return $this->SetTimeSL_Error;
        }
    }
?>



<?php
    //การจัดการสถานะจดหมาย
    class manage_mail_status{
        public $MMS_Type,$MMS_si_id,$MMS_si_txt;
        public $MMS_Array,$MMS_Error;
        function __construct($MMS_Type,$MMS_si_id,$MMS_si_txt){
            $Student_Late_Ip=$_SERVER['REMOTE_ADDR'];
            $Student_Late_Connect= new connect_database_student_late($Student_Late_Ip);
            $pdo_student_late=$Student_Late_Connect->getconnto_connto_student_late();
            $this->MMS_Type=$MMS_Type;
            $this->MMS_si_id=$MMS_si_id;
            $this->MMS_si_txt=$MMS_si_txt;
            $MMS_Array=array();
            $MMS_Error="Error";
                if(($this->MMS_Type=="Add")){

                }elseif(($this->MMS_Type=="Up")){

                }elseif(($this->MMS_Type=="Loop")){
                    try{
                        $manage_mail_sql="SELECT `si_id`, `si_txt` 
                                          FROM `sl_mail_status` 
                                          ORDER BY `si_id` ASC;";
                            if(($manage_mail_rs=$pdo_student_late->query($manage_mail_sql))){
                                while($manage_mail_row=$manage_mail_rs->Fetch(PDO::FETCH_ASSOC)){
                                    if((is_array($manage_mail_row) AND count($manage_mail_row))){
                                        $MMS_Array[]=$manage_mail_row;
                                        $MMS_Error="NoError";
                                    }else{
                                        $MMS_Array="-";
                                        $MMS_Error="Error";
                                    }
                                }
                            }else{
                                $MMS_Array="-";
                                $MMS_Error="Error";
                            }
                    }catch(PDOException $e){
                        $MMS_Array="-";
                        $MMS_Error="Error";
                    }
                }elseif(($this->MMS_Type=="Row")){

                }elseif(($this->MMS_Type=="Where")){
                    try{
                        $manage_mail_sql="SELECT `si_id`,`si_txt` 
                                          FROM `sl_mail_status` 
                                          WHERE`si_id`='{$MMS_si_id}';";
                            if(($manage_mail_rs=$pdo_student_late->query($manage_mail_sql))){
                                while($manage_mail_row=$manage_mail_rs->Fetch(PDO::FETCH_ASSOC)){
                                    if((is_array($manage_mail_row) AND count($manage_mail_row))){
                                        $MMS_Array[]=$manage_mail_row;
                                        $MMS_Error="NoError";
                                    }else{
                                        $MMS_Array="-";
                                        $MMS_Error="Error";
                                    }
                                }
                            }else{
                                $MMS_Array="-";
                                $MMS_Error="Error";
                            }
                    }catch(PDOException $e){
                        $MMS_Array="-";
                        $MMS_Error="Error";
                    }
                }else{
                    $MMS_Array="-";
                    $MMS_Error="Error";
                }
            $pdo_student_late=null;
            $this->MMS_Array=$MMS_Array;
            $this->MMS_Error=$MMS_Error;
        }function Call_MMS_Print(){
            return $this->MMS_Array;
        }function Call_MMS_Error(){
            return $this->MMS_Error;
        }
    }
?>

<?php
    //set_count_late คำนวนการมาสาย
    class ManageSetCountLate{
        public $MSCL_type,$MSCL_CountA,$MSCL_CountB,$MSCL_Status,$MSCL_Save;
        public $MSCL_Array,$MSCL_Error;
        function __construct($MSCL_type,$MSCL_CountA,$MSCL_CountB,$MSCL_Status,$MSCL_Save){
            $Student_Late_Ip=$_SERVER['REMOTE_ADDR'];
            $Student_Late_Connect= new connect_database_student_late($Student_Late_Ip);
            $pdo_student_late=$Student_Late_Connect->getconnto_connto_student_late();
            $this->MSCL_type=$MSCL_type;
            $this->MSCL_CountA=$MSCL_CountA;
            $this->MSCL_CountB=$MSCL_CountB;
            $this->MSCL_Status=$MSCL_Status;
            $this->MSCL_Save=$MSCL_Save;
            $MSCL_Array=array();
            $MSCL_Error="error";
            if(($this->MSCL_type=="up")){

            }elseif(($this->MSCL_type=="condition")){
                try{
                    $MSCL_Sql="SELECT * 
                               FROM `sl_set_count_late` 
                               WHERE `sscl_Status`='{$this->MSCL_Status}';";
                        if(($MSCL_Rs=$pdo_student_late->query($MSCL_Sql))){
                            while($MSCL_Row=$MSCL_Rs->Fetch(PDO::FETCH_ASSOC)){
                                if((is_array($MSCL_Row) AND count($MSCL_Row))){
                                    $MSCL_Array[]=$MSCL_Row;
                                    $MSCL_Error="Noerror";
                                }else{
                                    $MSCL_Array="-";
                                    $MSCL_Error="error";
                                }                                
                            }
                        }else{
                            $MSCL_Array="-";
                            $MSCL_Error="error";
                        }
                }catch(PDOException $e){
                    $MSCL_Array="-";
                    $MSCL_Error="error";
                }
            }elseif($this->MSCL_type=="where"){
                try{
                    $MSCL_Sql="SELECT * 
                               FROM `sl_set_count_late` 
                               WHERE `sscl_Status`='{$this->MSCL_Status}';";
                        if(($MSCL_Rs=$pdo_student_late->query($MSCL_Sql))){
                            while($MSCL_Row=$MSCL_Rs->Fetch(PDO::FETCH_ASSOC)){
                                if((is_array($MSCL_Row) AND count($MSCL_Row))){
                                    $MSCL_Array[]=$MSCL_Row;
                                    $MSCL_Error="Noerror";
                                }else{
                                    $MSCL_Array="-";
                                    $MSCL_Error="error";
                                }                                
                            }
                        }else{
                            $MSCL_Array="-";
                            $MSCL_Error="error";
                        }
                }catch(PDOException $e){
                    $MSCL_Array="-";
                    $MSCL_Error="error";
                }
            }else{
                $MSCL_Array="-";
                $MSCL_Error="error";
            }
            $pdo_student_late=null;
            $this->MSCL_Array=$MSCL_Array;
            $this->MSCL_Error=$MSCL_Error;
        }function CalllMSCL_Print(){
            return $this->MSCL_Array;
        }function CallMSCL_Error(){
            return $this->MSCL_Error;
        }
    }
?>

<?php
//เพิ่มข้อมูลนักเรียนมาสาย
    class ManageDataSudentLate{ 
        public $MDSL_Type,$MDSL_Date,$MDSL_StuKey,$MDSL_UseSave,$datetime_type,$datetime_start,$datetime_end;
        public $MDSL_Array,$MDSL_Error;
        function __construct($MDSL_Type,$MDSL_Date,$MDSL_StuKey,$MDSL_UseSave,$datetime_type,$datetime_start,$datetime_end){
            $Student_Late_Ip=$_SERVER['REMOTE_ADDR'];
            $Student_Late_Connect= new connect_database_student_late($Student_Late_Ip);
            $pdo_student_late=$Student_Late_Connect->getconnto_connto_student_late();
            $this->MDSL_Type=$MDSL_Type;
            $this->MDSL_Date=$MDSL_Date;
            $this->MDSL_StuKey=$MDSL_StuKey;
            $this->MDSL_UseSave=$MDSL_UseSave;
            $this->datetime_type=$datetime_type;
            $this->datetime_start=$datetime_start;
            $this->datetime_end=$datetime_end;
            $datetime=date("Y-m-d H:i:s");
            $date=date("Y-m-d");
            $MDSL_Array=array();
            $MDSL_Error="Error";
                if(($this->MDSL_Type=="add")){
                    try{
                        $into_data_stu="INSERT INTO `sl_data_stu` (`sds_key`) VALUES ('{$this->MDSL_StuKey}');";
                        $pdo_student_late->exec($into_data_stu);
                    }catch(PDOException $e){
                        $updata_data_stu="UPDATE `sl_data_stu` SET `sds_key`='{$this->MDSL_StuKey}' WHERE `sds_key`='{$this->MDSL_StuKey}'";
                        $pdo_student_late->exec($updata_data_stu);
                    }

                    try{
                        $into_MDSL="INSERT INTO `sl_late_save` (`sls_StuKey`, `sls_DateLate`, `sls_DateSave`, `sls_UseSave`) 
                                    VALUES ('{$this->MDSL_StuKey}', '{$this->MDSL_Date}', '{$datetime}', '{$this->MDSL_UseSave}');";
                        $pdo_student_late->exec($into_MDSL);
                        $MDSL_Array="-";
                        $MDSL_Error="NoError";
                    }catch(PDOException $e){
                        $MDSL_Array="-";
                        $MDSL_Error="Error";
                    }
                }elseif(($this->MDSL_Type=="add_time")){
                    $set_date_time_system=new RunDateTime("date_all",$this->datetime_start,$this->datetime_end);
                        if(($set_date_time_system->Call_DateTime_Start()=="ON")){

                            try{
                                $into_data_stu="INSERT INTO `sl_data_stu` (`sds_key`) VALUES ('{$this->MDSL_StuKey}');";
                                $pdo_student_late->exec($into_data_stu);
                            }catch(PDOException $e){
                                $updata_data_stu="UPDATE `sl_data_stu` SET `sds_key`='{$this->MDSL_StuKey}' WHERE `sds_key`='{$this->MDSL_StuKey}'";
                                $pdo_student_late->exec($updata_data_stu);
                            }

                            try{
                                $into_MDSL="INSERT INTO `sl_late_save` (`sls_StuKey`, `sls_DateLate`, `sls_DateSave`, `sls_UseSave`) 
                                            VALUES ('{$this->MDSL_StuKey}', '{$this->MDSL_Date}', '{$datetime}', '{$this->MDSL_UseSave}');";
                                $pdo_student_late->exec($into_MDSL);
                                $MDSL_Array="-";
                                $MDSL_Error="NoError";
                            }catch(PDOException $e){
                                $MDSL_Array="-";
                                $MDSL_Error="Error";
                            }
                            
                        }elseif(($set_date_time_system->Call_DateTime_Start()=="OFF")){
                            $MDSL_Array="-";
                            $MDSL_Error="Error_Time";
                        }else{
                            $MDSL_Array="-";
                            $MDSL_Error="Error";
                        }
                }elseif(($this->MDSL_Type=="Loop")){
                    try{
                        $MDSL_Sql="SELECT `sls_StuKey`, `sls_DateLate`, `sls_DateSave`, `sls_UseSave` 
                                FROM `sl_late_save` WHERE 1";
                            if(($MDSL_Rs=$pdo_student_late->query($MDSL_Sql))){
                                while($MDSL_Row=$MDSL_Rs->Fetch(PDO::FETCH_ASSOC)){
                                    if((is_array($MDSL_Row) AND count($MDSL_Row))){
                                        $MDSL_Array[]=$MDSL_Row;
                                        $MDSL_Error="NoError";
                                    }else{
                                        $MDSL_Array="-";
                                        $MDSL_Error="Error";
                                    }
                                }
                            }else{
                                $MDSL_Array="-";
                                $MDSL_Error="Error";
                            }
                    }catch(PDOException $e){
                        $MDSL_Array="-";
                        $MDSL_Error="Error";
                    }
                }elseif(($this->MDSL_Type=="Loop_id")){
                    try{
                        $MDSL_Sql="SELECT * 
                                FROM `sl_late_save` 
                                WHERE `sls_DateSave` 
                                BETWEEN '{$this->datetime_start}' AND '{$this->datetime_end}';";
                            if(($MDSL_Rs=$pdo_student_late->query($MDSL_Sql))){
                                while($MDSL_Row=$MDSL_Rs->Fetch(PDO::FETCH_ASSOC)){
                                    if((is_array($MDSL_Row) AND count($MDSL_Row))){
                                        $MDSL_Array[]=$MDSL_Row;
                                        $MDSL_Error="NoError";
                                    }else{
                                        $MDSL_Array="-";
                                        $MDSL_Error="Error";
                                    }
                                }
                            }else{
                                $MDSL_Array="-";
                                $MDSL_Error="Error";
                            }
                    }catch(PDOException $e){
                        $MDSL_Array="-";
                        $MDSL_Error="Error";
                    }
                }elseif(($this->MDSL_Type=="Loop_key")){
                    try{
                        $MDSL_Sql="SELECT DISTINCT `sls_StuKey` 
                                FROM `sl_late_save` 
                                WHERE `sls_DateSave` 
                                BETWEEN '{$this->datetime_start}' AND '{$this->datetime_end}';";
                            if(($MDSL_Rs=$pdo_student_late->query($MDSL_Sql))){
                                while($MDSL_Row=$MDSL_Rs->Fetch(PDO::FETCH_ASSOC)){
                                    if((is_array($MDSL_Row) AND count($MDSL_Row))){
                                        $MDSL_Array[]=$MDSL_Row;
                                        $MDSL_Error="NoError";
                                    }else{
                                        $MDSL_Array="-";
                                        $MDSL_Error="Error";
                                    }
                                }
                            }else{
                                $MDSL_Array="-";
                                $MDSL_Error="Error";
                            }
                    }catch(PDOException $e){
                        $MDSL_Array="-";
                        $MDSL_Error="Error";
                    }                    
                }elseif(($this->MDSL_Type=="delete")){
                    try{
                        $delete_MDSL="DELETE FROM `sl_late_save` 
                                      WHERE `sls_StuKey`='{$this->MDSL_StuKey}' 
                                      AND `sls_DateLate`='{$this->MDSL_Date}'";
                        $pdo_student_late->exec($delete_MDSL);
                        $MDSL_Array="-";
                        $MDSL_Error="NoError";
                    }catch(PDOException $e){
                        $MDSL_Array="-";
                        $MDSL_Error="Error";
                    }
                }else{
                    $MDSL_Array="-";
                    $MDSL_Error="Error";
                }
            $pdo_student_late=null;
            $this->MDSL_Array=$MDSL_Array;
            $this->MDSL_Error=$MDSL_Error;
        }function Call_MDSL_Print(){
            return $this->MDSL_Array;
        }function Call_MDSL_Error(){
            return $this->MDSL_Error;
        }
    }
?>

<?php
    //การจัดการจดหมาย
    class Manage_sl_mail{
        public $MSM_Type,$MSM_sm_id,$MSM_sm_Stukey,$MSM_si_id;
        public $MSM_Array,$MSM_Error;
        function __construct($MSM_Type,$MSM_sm_id,$MSM_sm_Stukey,$MSM_si_id){
            $Student_Late_Ip=$_SERVER['REMOTE_ADDR'];
            $Student_Late_Connect= new connect_database_student_late($Student_Late_Ip);
            $pdo_student_late=$Student_Late_Connect->getconnto_connto_student_late();
            $this->MSM_Type=$MSM_Type;
            $this->MSM_sm_id=$MSM_sm_id;
            $this->MSM_sm_Stukey=$MSM_sm_Stukey;
            $this->MSM_si_id=$MSM_si_id;
            $date_int=strtotime(date("Y-m-d"));
            $date=date("Y-m-d H:i:s");
            //$SmId=$this->MSM_sm_id.$date_int;
            $MSM_Array=array();
            $MSM_Error="Error";
                if(($this->MSM_Type=="add")){
                    try{
                        $IntoMailSql="INSERT INTO `sl_mail`(`sm_id`, `sm_StuKey`, `sm_DateTime`, `si_id`)
                                      VALUES ('{$this->MSM_sm_id}','{$this->MSM_sm_Stukey}','{$date}','{$this->MSM_si_id}')";
                        $pdo_student_late->exec($IntoMailSql);
                            try{
                                $IntoSaveMailSql="INSERT INTO `save_mai`(`sds_key`, `sm_id`) 
                                                  VALUES ('{$this->MSM_sm_Stukey}','{$this->MSM_sm_id}')";
                                $pdo_student_late->exec($IntoSaveMailSql);
                                $MSM_Array="-";
                                $MSM_Error="NoError";
                            }catch(PDOException $e){
                                try{
                                    $DeleteMailSql="DELETE FROM `sl_mail` WHERE `sm_id`='{$this->MSM_sm_id}'";
                                    $pdo_student_late->exec($DeleteMailSql);
                                }catch(PDOException $e){} 

                            $MSM_Array="-";
                            $MSM_Error="Error"; 

                            }
                    }catch(PDOException $e){
                        $MSM_Array="-";
                        $MSM_Error="Error";
                    }
                }elseif(($this->MSM_Type=="add2")){
                    try{
                        $IntoMailSql="INSERT INTO `sl_mail`(`sm_id`, `sm_StuKey`, `sm_DateTime`, `si_id`)
                                      VALUES ('{$this->MSM_sm_id}','{$this->MSM_sm_Stukey}','{$date}','{$this->MSM_si_id}')";
                        $pdo_student_late->exec($IntoMailSql);
                            try{
                                $IntoSaveMailSql="INSERT INTO `save_mai`(`sds_key`, `sm_id`) 
                                                  VALUES ('{$this->MSM_sm_Stukey}','{$this->MSM_sm_id}')";
                                $pdo_student_late->exec($IntoSaveMailSql);
                                $MSM_Array="-";
                                $MSM_Error="NoError";
                            }catch(PDOException $e){
                                $MSM_Array="-";
                                $MSM_Error="Error";
                            }
                    }catch(PDOException $e){
                        $MSM_Array="-";
                        $MSM_Error="Error";
                    }
                }elseif(($this->MSM_Type=="up")){

                }else{
                    $MSM_Array="-";
                    $MSM_Error="Error";
                }
            $pdo_student_late=null;
            $this->MSM_Array=$MSM_Array;
            $this->MSM_Error=$MSM_Error;
        }function Run_MSM_Row(){
            return $this->MSM_Array;
        }function Run_MSM_Error(){
            return $this->MSM_Error;
        }
    }
?>


<?php
    //student count late
        class CountLateStudent{
            public $CLS_Type,$CLS_Key,$CLS_Date_Start,$CLS_Date_End;
            public $int_student_late;
            function __construct($CLS_Type,$CLS_Key,$CLS_Date_Start,$CLS_Date_End){
                $Student_Late_Ip=$_SERVER['REMOTE_ADDR'];
                $Student_Late_Connect= new connect_database_student_late($Student_Late_Ip);
                $pdo_student_late=$Student_Late_Connect->getconnto_connto_student_late();
                $this->CLS_Type=$CLS_Type;
                $this->CLS_Key=$CLS_Key;
                $this->CLS_Date_Start=$CLS_Date_Start;
                $this->CLS_Date_End=$CLS_Date_End;
                $student_count_late=0;
                    if(($this->CLS_Type=="ALL")){
                        try{
                            $student_late_sql="SELECT COUNT(`sls_StuKey`) AS `int_student_late` 
                                               FROM `sl_late_save` 
                                               WHERE `sls_StuKey`='{$this->CLS_Key}';";
                                if(($student_late_rs=$pdo_student_late->query($student_late_sql))){
                                    $student_late_row=$student_late_rs->Fetch(PDO::FETCH_ASSOC);
                                        if((isset($student_late_row["int_student_late"]))){
                                            $int_student_late=$student_late_row["int_student_late"];
                                        }else{
                                            $int_student_late=0;
                                        }
                                }else{
                                    $int_student_late=0;
                                }      
                        }catch(PDOException $e){
                            $int_student_late=0;
                        }
                    }elseif(($this->CLS_Type=="TIME")){
                        try{
                            $student_late_sql="SELECT COUNT(`sls_StuKey`) AS `int_student_late` 
                                               FROM `sl_late_save` 
                                               WHERE  `sls_DateLate`
                                               BETWEEN '{$this->CLS_Date_Start}' AND '{$this->CLS_Date_End}'
                                               AND `sls_StuKey`='{$this->CLS_Key}';";
                                if(($student_late_rs=$pdo_student_late->query($student_late_sql))){
                                    $student_late_row=$student_late_rs->Fetch(PDO::FETCH_ASSOC);
                                        if((isset($student_late_row["int_student_late"]))){
                                            $int_student_late=$student_late_row["int_student_late"];
                                        }else{
                                            $int_student_late=0;
                                        }
                                }else{
                                    $int_student_late=0;
                                }      
                        }catch(PDOException $e){
                            $int_student_late=0;
                        }
                    }else{
                        $int_student_late=0;
                    }
                $pdo_student_late=null;
                $this->int_student_late=$int_student_late;
            }function __destruct(){
                $this->int_student_late;
            }
        }
    //student count late end
?>


<?php
    class count_late_mail{
        public $CLM_Type,$CLM_Key,$CLM_Date_Start,$CLM_Date_End;
        public $int_count_late;
            function __construct($CLM_Type,$CLM_Key,$CLM_Date_Start,$CLM_Date_End){
                $this->CLM_Type=$CLM_Type;
                $this->CLM_Key=$CLM_Key;
                $this->CLM_Date_Start=$CLM_Date_Start;
                $this->CLM_Date_End=$CLM_Date_End;
                $Student_Late_Ip=$_SERVER['REMOTE_ADDR'];
                $Student_Late_Connect= new connect_database_student_late($Student_Late_Ip);
                $pdo_student_late=$Student_Late_Connect->getconnto_connto_student_late();
                $int_count_late=0;
                if(($this->CLM_Type=="ALL")){
                    try{
                        $CountLateMailSql="SELECT COUNT(`sm_id`) AS `Int_Late_M` FROM `sl_mail` 
                                           WHERE `sm_DateTime` 
                                           BETWEEN '{$this->CLM_Date_Start}' AND '{$this->CLM_Date_End}';";
                            if(($CountLateMailRs=$pdo_student_late->query($CountLateMailSql))){
                                $CountLateMailRow=$CountLateMailRs->Fetch(PDO::FETCH_ASSOC);
                                    if((is_array($CountLateMailRow) and count($CountLateMailRow))){
                                        $int_count_late=$CountLateMailRow["Int_Late_M"];
                                    }else{
                                        $int_count_late=0;
                                    }
                            }else{
                                $int_count_late=0;
                            }
                    }catch(PDOException $e){
                        $int_count_late=0;
                    }
                }elseif(($this->CLM_Type=="Key")){
                    try{
                        $CountLateMailSql="SELECT COUNT(`sm_id`) AS `Int_Late_M` FROM `sl_mail` 
                                           WHERE `sm_DateTime` 
                                           BETWEEN '{$this->CLM_Date_Start}' AND '{$this->CLM_Date_End}'
                                           AND `sm_StuKey`='{$this->CLM_Key}';";
                            if(($CountLateMailRs=$pdo_student_late->query($CountLateMailSql))){
                                $CountLateMailRow=$CountLateMailRs->Fetch(PDO::FETCH_ASSOC);
                                    if((is_array($CountLateMailRow) and count($CountLateMailRow))){
                                        $int_count_late=$CountLateMailRow["Int_Late_M"];
                                    }else{
                                        $int_count_late=0;
                                    }
                            }else{
                                $int_count_late=0;
                            }
                    }catch(PDOException $e){
                        $int_count_late=0;
                    }
                }elseif(($this->CLM_Type=="status")){
                    try{
                        $CountLateMailSql="SELECT COUNT(`sm_id`) AS `Int_Late_M` FROM `sl_mail` 
                                           WHERE `sm_DateTime` 
                                           BETWEEN '{$this->CLM_Date_Start}' AND '{$this->CLM_Date_End}'
                                           AND `si_id`='{$this->CLM_Key}';";
                            if(($CountLateMailRs=$pdo_student_late->query($CountLateMailSql))){
                                $CountLateMailRow=$CountLateMailRs->Fetch(PDO::FETCH_ASSOC);
                                    if((is_array($CountLateMailRow) and count($CountLateMailRow))){
                                        $int_count_late=$CountLateMailRow["Int_Late_M"];
                                    }else{
                                        $int_count_late=0;
                                    }
                            }else{
                                $int_count_late=0;
                            }
                    }catch(PDOException $e){
                        $int_count_late=0;
                    }
                }else{
                    $int_count_late=0;
                }
                $pdo_student_late=null;
                $this->int_count_late=$int_count_late;
            }function __destruct(){
                $this->int_count_late;
            }
    }
?>
