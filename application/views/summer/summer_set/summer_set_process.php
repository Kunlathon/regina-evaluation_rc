<?php 
    //Develop By Kunlathon Saowakhon
    //พัฒนาเว็บไซต์โดย นายกุลธร เสาวคนธ์
    //Tel 0932670639
    //โทร 0932670639
    //Email: mpamese.pc2001@gmail.com , missing_yrc2014@hotmail.com	
    defined('BASEPATH') OR exit('No direct script access allowed'); 

    $this->load->library('session');
    //----------------------------------------------------------------------------    
	include("view/img_user/document/gotolink.php");//-----------------
	$goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
	$golink=$goingtolink->Rungotolink();//----------------------------
    //----------------------------------------------------------------------------
	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");	
    //----------------------------------------------------------------------------
        if(($this->session->userdata("rc_user")==null)){
            $this->session->unset_userdata("rc_user");
            exit("<script>window.location='$golink';</script>");
        }else{ 

            if((isset($_POST["action"]))){
                $action=filter_input(INPUT_POST,'action');
                    if(($action=="create")){
                       
                        $count_error=0;
                            if((isset($_POST["sy_id"]))){
                                $sy_id=filter_input(INPUT_POST,'sy_id');
                                $count_error=$count_error+0;
                            }else{
                                $sy_id=null;
                                $count_error=$count_error+1;
                            }

                            if((isset($_POST["sy_th"]))){
                                $sy_th=filter_input(INPUT_POST,'sy_th');
                                $count_error=$count_error+0;
                            }else{
                                $sy_th=null;
                                $count_error=$count_error+1;
                            }

                            if(($count_error>=1)){
                                echo "error";
                            }else{
                                $Call_System_Year=new SystemYear("add",$sy_id,$sy_th);
                                    if(($Call_System_Year->RunST_Error()=="No")){
                                        echo "no_error";
                                    }elseif($Call_System_Year->RunST_Error()=="Yes"){
                                        echo "error";
                                    }else{
                                        echo "error";

                                    }
                            }


                    }else{}
            }else{}
            
        }
?>