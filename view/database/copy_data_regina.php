<?php
/*##################################
pdo_data.php########################
#class count_pdodata################
#public function call_pdodata()#####
####################################
####################################
pdo_conndatastu.php#################
#class count_conndatastu############
#function call_coun_conndatastu()###
####################################
####################################
pdo_admission.php###################
#class connect_Admission############
#function call_RunConnAdmission()###
####################################
*/

include("pdo_data.php");
include("pdo_conndatastu.php");
include("pdo_admission.php");

$CAD_Year="2566";
$CAD_Term="1";
$CAD_Class="11";
$CAD_Status="1";
?>

    <?php
        class copy_admission_data{
            public $CAD_Year,$CAD_Term,$CAD_Class,$CAD_Status;
            public $ids_error,$cad_ids,$cad_update;
            function __construct($CAD_Year,$CAD_Term,$CAD_Class,$CAD_Status){
//--------------------------------------------------------------------------                
                $regina_dataID=$_SERVER['REMOTE_ADDR'];
                $connect_data=new count_pdodata($regina_dataID);
                $pdodata_regina=$connect_data->call_pdodata();
//--------------------------------------------------------------------------
                $regina_conndatastuID=$_SERVER['REMOTE_ADDR'];
                $connect_conndatastu=new count_conndatastu($regina_conndatastuID);
                $pdoconndatastu_regina=$connect_conndatastu->call_coun_conndatastu();
//--------------------------------------------------------------------------
                $regina_AdmissionID=$_SERVER['REMOTE_ADDR'];
                $connect_Admission=new connect_Admission($regina_AdmissionID);
                $pdoAdmission_regina=$connect_Admission->call_RunConnAdmission();
//--------------------------------------------------------------------------
                $this->CAD_Year=$CAD_Year;
                $this->CAD_Term=$CAD_Term;
                $this->CAD_Class=$CAD_Class;
                $this->CAD_Status=$CAD_Status;
//---------------------------------------------------------------------------
                $cad_update=0;
                $cad_ids=0;
                $ids_error="yes";
//---------------------------------------------------------------------------
                    try{
                        $regina_data_sql="SELECT `rsd_studentid`
                                          FROM `regina_stu_class` 
                                          WHERE `rsc_year`='{$this->CAD_Year}' 
                                          AND `rsc_term`='{$this->CAD_Term}' 
                                          AND `rsc_class`='{$this->CAD_Class}'
                                          AND `rsc_status`='{$this->CAD_Status}';";
                            if(($regina_data_rs=$pdodata_regina->query($regina_data_sql))){
                                while($regina_data_row=$regina_data_rs->Fetch(PDO::FETCH_ASSOC)){
                                    if((is_array($regina_data_row) && count($regina_data_row))){
                                        $txt_studentid=$regina_data_row["rsd_studentid"];
                                        //$txt_rsd_Identification=$regina_data_row["rsd_Identification"];
                                    try{
                                        $regina_student_sql="SELECT `rsd_Identification` FROM `regina_stu_data` WHERE`rsd_studentid`='{$txt_studentid}';";
                                            if(($regina_student_rs=$pdodata_regina->query($regina_student_sql))){
                                                $regina_student_row=$regina_student_rs->Fetch(PDO::FETCH_ASSOC);
                                                    if((is_array($regina_student_row) && count($regina_student_row))){
                                                        $txt_rsd_Identification=$regina_student_row["rsd_Identification"];

                                                        //echo $txt_rsd_Identification."<br>";

                                                    }else{
                                                        $txt_rsd_Identification="-";
                                                    }
                                            }else{
                                                $txt_rsd_Identification="-";
                                            }
                                    }catch(PDOException $e){
                                        $txt_rsd_Identification="-";
                                    }

//the test 
                                        try{
                                            $test_data_student_sql="SELECT COUNT(`stu_id`) AS `count_test` 
                                                                    FROM `data_student` 
                                                                    WHERE `stu_id`='{$txt_studentid}' 
                                                                    AND `stu_birth`!='';";
                                                if(($test_data_student_rs=$pdoconndatastu_regina->query($test_data_student_sql))){
                                                    $test_data_student_row=$test_data_student_rs->Fetch(PDO::FETCH_ASSOC);
                                                        if((is_array($test_data_student_row) && count($test_data_student_row))){
                                                            $count_test=$test_data_student_row["count_test"];
                                                                if(($count_test>=1)){    
//copy                                                                     
                                                                    $txt_nickTh=null;
                                                                    $txt_nickEn=null;
                                                                    $txt_stu_birth=null;
                                                                    $txt_stu_blood=null;
                                                                    $txt_stu_nation=null;
                                                                    $txt_stu_sun=null;
                                                                    $txt_IDReligion=null;
//copy end

                                                                }else{
                                                                    try{
                                                                        $copy_admission_sql="SELECT `nickTh`,`nickEn`,`stu_birth`,`stu_blood`,`stu_nation`,`stu_sun`,`IDReligion` 
                                                                                             FROM `rc_student_admission` 
                                                                                             WHERE `IDCard`='{$txt_rsd_Identification}';";
                                                                            if(($copy_admission_rs=$pdoAdmission_regina->query($copy_admission_sql))){
                                                                                $copy_admission_row=$copy_admission_rs->Fetch(PDO::FETCH_ASSOC);
                                                                                    if((is_array($copy_admission_row) && count($copy_admission_row))){
                                                                                        $txt_nickTh=$copy_admission_row["nickTh"];
                                                                                        $txt_nickEn=$copy_admission_row["nickEn"];
                                                                                        $txt_stu_birth=$copy_admission_row["stu_birth"];
                                                                                        $txt_stu_birth=date("d-m-Y",strtotime($txt_stu_birth));
                                                                                        $txt_stu_blood=$copy_admission_row["stu_blood"];
                                                                                        $txt_stu_nation=$copy_admission_row["stu_nation"];
                                                                                        $txt_stu_sun=$copy_admission_row["stu_sun"];
                                                                                        $txt_IDReligion=$copy_admission_row["IDReligion"];
                                                                                    }else{
                                                                                        $txt_nickTh=null;
                                                                                        $txt_nickEn=null;
                                                                                        $txt_stu_birth=null;
                                                                                        $txt_stu_blood=null;
                                                                                        $txt_stu_nation=null;
                                                                                        $txt_stu_sun=null;
                                                                                        $txt_IDReligion=null;
                                                                                    }
                                                                            }else{
                                                                                $txt_nickTh=null;
                                                                                $txt_nickEn=null;
                                                                                $txt_stu_birth=null;
                                                                                $txt_stu_blood=null;
                                                                                $txt_stu_nation=null;
                                                                                $txt_stu_sun=null;
                                                                                $txt_IDReligion=null;                                                                                
                                                                            }
                                                                    }catch(PDOException $e){
                                                                        $txt_nickTh=null;
                                                                        $txt_nickEn=null;
                                                                        $txt_stu_birth=null;
                                                                        $txt_stu_blood=null;
                                                                        $txt_stu_nation=null;
                                                                        $txt_stu_sun=null;
                                                                        $txt_IDReligion=null;
                                                                    }
                                                                }
                                                        }else{
                                                            $txt_nickTh=null;
                                                            $txt_nickEn=null;
                                                            $txt_stu_birth=null;
                                                            $txt_stu_blood=null;
                                                            $txt_stu_nation=null;
                                                            $txt_stu_sun=null;
                                                            $txt_IDReligion=null;                                                            
                                                        }
                                                }
                                        }catch(PDOException $e){
                                            $txt_nickTh=null;
                                            $txt_nickEn=null;
                                            $txt_stu_birth=null;
                                            $txt_stu_blood=null;
                                            $txt_stu_nation=null;
                                            $txt_stu_sun=null;
                                            $txt_IDReligion=null;
                                        }                       
//the test end
//----------------------------------------------------------------------------
//UpDate
                                        
                                


                                        try{
                                            $copy_admission_sql="SELECT `nickTh`,`nickEn` 
                                                                FROM `rc_student_admission` 
                                                                WHERE `IDCard`='{$txt_rsd_Identification}';";
                                                if(($copy_admission_rs=$pdoAdmission_regina->query($copy_admission_sql))){
                                                    $copy_admission_row=$copy_admission_rs->Fetch(PDO::FETCH_ASSOC);
                                                        if((is_array($copy_admission_row) && count($copy_admission_row))){
                                                            $txt_nickTh=$copy_admission_row["nickTh"];
                                                            $txt_nickEn=$copy_admission_row["nickEn"];
                                                        }else{
                                                            $txt_nickTh=null;
                                                            $txt_nickEn=null;

                                                        }
                                                }else{
                                                    $txt_nickTh=null;
                                                    $txt_nickEn=null;                                                                           
                                                }
                                        }catch(PDOException $e){
                                            $txt_nickTh=null;
                                            $txt_nickEn=null;
                                        }






                                            try{
                                                $UpDateRegina_Stu_DataSql="UPDATE `regina_stu_data` 
                                                                        SET `nickTh`='{$txt_nickTh}',`nickEn`='{$txt_nickEn}' 
                                                                        WHERE `rsd_studentid`='{$txt_studentid}' 
                                                                        AND `rsd_Identification`='{$txt_rsd_Identification}'";
                                                $pdodata_regina->exec($UpDateRegina_Stu_DataSql);
                                                $cad_update=$cad_update+1;
                                                echo "good";
                                            }catch(PDOException $e){
                                                $cad_update=$cad_update+0;
                                                echo "not good";
                                            }  
                                 





                                        echo    $txt_studentid." // ".$txt_rsd_Identification." // ".$txt_nickTh." // ".$txt_nickEn."<br>";
//UpDate
//----------------------------------------------------------------------------

                                        if(($count_test>=1)){

                                        }else{
    //Into
                                            try{
                                                $IntoDataStudentSql="INSERT INTO `data_student`(`stu_id`,`stu_birth`, `stu_blood`, `stu_nation`, `stu_sun`, `IDReligion`) 
                                                                    VALUES ('{$txt_studentid}','{$txt_stu_birth}','{$txt_stu_blood}','{$txt_stu_nation}','{$txt_stu_sun}','{$txt_IDReligion}')";
                                                $pdoconndatastu_regina->exec($IntoDataStudentSql);
                                                $ids_error="yes";
                                                $cad_ids=$cad_ids+1;
                                            }catch(PDOException $e){
                                            
                                            
                                                try{
                                                    $UpDateStudentSql="UPDATE `data_student` 
                                                                    SET `stu_birth`='{$txt_stu_birth}',`stu_blood`='{$txt_stu_blood}',`stu_nation`='{$txt_stu_nation}',`stu_sun`='{$txt_stu_sun}',`IDReligion`='{$txt_IDReligion}' 
                                                                    WHERE `stu_id`='{$txt_studentid}'";
                                                    $pdoconndatastu_regina->exec($UpDateStudentSql);
                                                    $ids_error="yes1";
                                                    $cad_ids=$cad_ids+1;
                                                }catch(PDOException $e){
                                                    $ids_error="no1";
                                                    $cad_ids=$cad_ids+0;
                                                }             
                                            
                                                //$ids_error="no";
                                                //$cad_ids=$cad_ids+0;
                                            }
    //Into End                               
    
  /*echo  $txt_nickTh." // ".$txt_studentid." // ".$txt_stu_birth." // ".$txt_stu_blood." // ".$txt_stu_nation." // ".$txt_stu_sun." // ".$txt_IDReligion."<br>";  

  echo  $ids_error."<br>";*/

                                        }

       





//----------------------------------------------------------------------------
                                    }else{
                                        $ids_error="no2";
                                        $cad_ids=$cad_ids+0;
                                        $cad_update=$cad_update+0;
                                    }
                                }
                            }else{
                                $ids_error="no3";
                                $cad_ids=$cad_ids+0;
                                $cad_update=$cad_update+0;
                            }
                    }catch(PDOException $e){
                        $ids_error="no4";
                        $cad_ids=$cad_ids+0;
                        $cad_update=$cad_update+0;
                    }

                $this->ids_error=$ids_error;
                $this->cad_ids=$cad_ids;
                $this->cad_update=$cad_update;

                $pdoconndatastu_regina=null;
                $pdoAdmission_regina=null;
                $pdodata_regina=null;

            }function ShowCadError(){
                return $this->ids_error;
            }function ShowCadIds(){
                return $this->cad_ids;
            }function ShowCadUpdate(){
                return $this->cad_update;
            }
        }    

    ?>

--

<?php
    $txt_regina=new copy_admission_data($CAD_Year,$CAD_Term,$CAD_Class,$CAD_Status);

    echo $txt_regina->ShowCadError()."<br>";

    echo $txt_regina->ShowCadIds()."<br>";

    echo $txt_regina->ShowCadUpdate()."<br>";

    //echo  $."<br>";
?>