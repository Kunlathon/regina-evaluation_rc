<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
    $this->load->library('session');
    //----------------------------------------------------------------------------    
	include("view/img_user/document/gotolink.php");//-----------------
	$goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
	$golink=$goingtolink->Rungotolink();//----------------------------
    //----------------------------------------------------------------------------
    include("view/function_class/run_date_time.php");  
	include("view/database/pdo_student_late.php");
	include("view/database/class_student_late.php");
    //----------------------------------------------------------------------------
    if($this->session->userdata("rc_user")==null){
        $this->session->unset_userdata("rc_user");
        exit("<script>window.location='$golink';</script>");
    }else{ 
        //echo $type_count."<br>".$type_data."<br>".$Status."<br>";

        $SetDateLate=new SetTimeSL("Row","-","-");
        foreach($SetDateLate->PrintSetTime() as $key=>$SetDateLateRow){
            if((is_array($SetDateLateRow) and count($SetDateLateRow))){
                $txt_t=$SetDateLateRow["ssy_t"];
                $txt_y=$SetDateLateRow["ssy_y"];
                $date_start=date("Y-m-d",strtotime($SetDateLateRow["ssy_date_start"]));
                $date_end=date("Y-m-d",strtotime($SetDateLateRow["ssy_date_end"]));
            }else{
                $date_start=null;
                $date_end=null;
            }
        }

            if(($date_start!=null and $date_end!=null)){
                $data_student_late=new ManageDataSudentLate($type_data,"-","-","-","-",$date_start,$date_end);
                foreach($data_student_late->Call_MDSL_Print() as $rc_key=>$data_student_late_Row){
                    if((is_array($data_student_late_Row) and count($data_student_late_Row))){
                        $student_key=$data_student_late_Row["sls_StuKey"];
                        $Student_Late_Count=new CountLateStudent($type_count,$student_key,$date_start,$date_end);
                        $int_late_count=$Student_Late_Count->int_student_late;
                        if(($int_late_count!=0)){
//คำนวนตามเงื่อนไข
                            if(($type_if=="where")){

                                if(($Status=="A")){

                                    $CountLateMail=new ManageSetCountLate($type_if,"-","-",$Status,"-");
                                        foreach($CountLateMail->CalllMSCL_Print() as $rc_key=>$CountLateMailRow){
                                            if((is_array($CountLateMailRow) and count($CountLateMailRow))){
                                                if(($CountLateMailRow["sscl_CountA"]!=null or $CountLateMailRow["sscl_CountA"]!="-")){
                                                    $sscl_count=$CountLateMailRow["sscl_CountA"];
                                                    $ilcount=intval($int_late_count/$sscl_count);
    
                                                     $count_key=1;
                                                        while($count_key<=$ilcount){                                                       
                                                            $MSM_Key=$txt_y.$txt_t.$student_key.$count_key;
                                                            $add_mail=new Manage_sl_mail("add",$MSM_Key,$student_key,"1");
                                                            
                                                            //echo $add_mail->Run_MSM_Error();
                                                            //echo $MSM_Key."<br>";
    
                                                            $count_key=$count_key+1;
                                                        }
                                                
                                                }else{}
                                            }else{}
                                        }

                                }elseif(($Status=="B")){

                                    $CountLateMail=new ManageSetCountLate($type_if,"-","-",$Status,"-");
                                        $count_key=1;
                                        foreach($CountLateMail->CalllMSCL_Print() as $rc_key=>$CountLateMailRow){
                                            if((is_array($CountLateMailRow) and count($CountLateMailRow))){
//Set null
                                                if((isset($CountLateMailRow["sscl_CountA"]))){
                                                    $sscl_CountA=$CountLateMailRow["sscl_CountA"];
                                                }else{
                                                    $sscl_CountA=0;
                                                }
//Set null End
//Set null 
                                                if((isset($CountLateMailRow["sscl_CountB"]))){
                                                    $sscl_CountB=$CountLateMailRow["sscl_CountB"];
                                                }else{
                                                    $sscl_CountB=0;
                                                }
//Set null End
                                                if(($sscl_CountA==$sscl_CountB)){
                                                    
                                                    if(($int_late_count>=$sscl_CountA)){
                                                        $MSM_Key=$txt_y.$txt_t.$student_key.$count_key;
                                                        $add_mail=new Manage_sl_mail("add",$MSM_Key,$student_key,"1");
                                                        $count_key=$count_key+1;
                                                    }else{}

                                                }else{

                                                    if(($int_late_count>=$sscl_CountA and $int_late_count<=$sscl_CountB)){
                                                        $MSM_Key=$txt_y.$txt_t.$student_key.$count_key;
                                                        $add_mail=new Manage_sl_mail("add",$MSM_Key,$student_key,"1");
                                                        $count_key=$count_key+1;
                                                    }else{}

                                                }
                                               
                                            }else{}
                                        }

                                }else{}

                            }else{
                                //echo "5555";
                            }
//คำนวนตามเงื่อนไข จบ                                         
                        }else{}

                    }else{}
                }

                echo "RunCountMail";

            }else{}
    }
//update 2023/11/14 by beer
?>




