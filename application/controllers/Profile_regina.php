<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Profile_regina extends CI_Controller{
        
        public function error(){
            $this->load->view('errors/system_error');
        }  
        public function Data_Sud_Summer(){
            $this->load->view("summer/ad_summer/Data_Sud_summer");
        }
        public function profile_student_document($stu_key){
            $profile_row=array('stu_key'=>$stu_key);
            $this->load->view("proflie_regina/profile_student_document",$profile_row);
        }
        
        public function profile_student_document_class($psdc_year,$psdc_term,$psdc_class){
            $profile_row=array('psdc_year'=>$psdc_year,'psdc_term'=>$psdc_term,'psdc_class'=>$psdc_class);
            $this->load->view("proflie_regina/profile_student_document_class",$profile_row);
        }

        public function profile_student_document_room($psdc_year,$psdc_term,$psdc_class,$psdc_room){
            $profile_row=array('psdc_year'=>$psdc_year,'psdc_term'=>$psdc_term,'psdc_class'=>$psdc_class,'psdc_room'=>$psdc_room);
            $this->load->view("proflie_regina/profile_student_document_class",$profile_row);
        }

    }

?>