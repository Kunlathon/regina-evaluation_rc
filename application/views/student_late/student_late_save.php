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
                
            $sutdent_key=$this->input->Post('sutdent_key');
            $sutdent_date=$this->input->Post('sutdent_date');
            $action=$this->input->Post('action');

                if(($action=="delete")){
                    $delete_student_late=new ManageDataSudentLate("delete",$sutdent_date,$sutdent_key,"-","-","-","-");
                    echo $delete_student_late->Call_MDSL_Error();
                }else{

                }

        }
?>