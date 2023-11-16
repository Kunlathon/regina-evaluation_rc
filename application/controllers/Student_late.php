<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Student_late extends CI_Controller{
        public function student_late_save(){
            $this->load->view('student_late/student_late_save');
        }

        public function student_late_load($type_load){
            $run_type_load=array('type_load'=>$type_load);
            $this->load->view('student_late/student_late_load',$run_type_load);
        }

        public function index(){
            $this->load->view('errors/system_error');
        }public function error(){
            $this->load->view('errors/system_error');
        }

        public function load_late_mail($type_data,$type_count,$type_if,$Status){
            //Loop_id,TIME,where 1
            //Loop_key,TIME,where 2 ***
            $run_array=array('type_data'=>$type_data,'type_count'=>$type_count,'type_if'=>$type_if,'Status'=>$Status);
            $this->load->view('student_late/load_late_mail',$run_array);
        }

        public function load_student_late_data($type_load){
            $run_type_load=array('type_load'=>$type_load);
            $this->load->view('student_late/student_late_load/load_student_late_data',$run_type_load);
        }

        public function late_load(){
            $this->load->view('student_late/student_late_load/late_load');
        }

        


    }
?>