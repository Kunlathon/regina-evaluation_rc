<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
    //--------------------------------------------------------------------    
        include("view/img_user/document/gotolink.php");//-----------------
        $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
        $golink=$goingtolink->Rungotolink();//----------------------------
    //--------------------------------------------------------------------
        include("view/database/pdo_summer.php");
        include("view/database/class_summer.php");

        if(($this->session->userdata("rc_user")!=null)){
	
            $RSDno=filter_input(INPUT_POST,'RSDno');
            $RSYear=filter_input(INPUT_POST,'RSYear');

            $PrintInt_Group=new KeepSummerQuota($RSDno,$RSYear);

            $Count_Summer=$PrintInt_Group->set_int_quota();
            $Key_Summer=$PrintInt_Group->set_id_quota();

            $Sum_Summer=new Sum_Quota_Summer($Key_Summer,$RSYear);

            $SumInt_Summer=$Sum_Summer->PrintSumSummer();

            if((isset($Count_Summer))){
                if(($SumInt_Summer>=$Count_Summer)){
                    echo "full";
                }else{
                    echo "No_full";
                }               
            }else{
                echo "No_full";
            }
            



        }else{
            $this->session->unset_userdata("rc_user");
            exit("<script>window.location='$golink/print_imgstu/error';</script>");	
        }
?>