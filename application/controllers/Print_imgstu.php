<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Print_imgstu extends CI_Controller {
    public function index(){
        $this->load->view('errors/system_error');
    }public function error(){
		$this->load->view('errors/system_error');
	}public function print_img(){
        $this->load->view('errors/system_error');
    }
	
    public function print_img1($RcId){
        $set_stuid=array('RcId'=>$RcId);
        $this->load->view('student_img/img1',$set_stuid);
    }public function print_img1_5($RcId){
        $set_stuid=array('RcId'=>$RcId);
        $this->load->view('student_img/img1_5',$set_stuid);
    }public function print_img2($RcId){
        $set_stuid=array('RcId'=>$RcId);
        $this->load->view('student_img/img2',$set_stuid);
    }
	
	public function print_roomimg($txt_year,$txt_class,$txt_room){
		$img_room=array('txt_year'=>$txt_year,'txt_class'=>$txt_class,'txt_room'=>$txt_room);
		$this->load->view('student_img/print_stu_roomimg',$img_room);
	}
	
	public function print_student_card($txt_year,$txt_class,$txt_room){
		$img_room=array('txt_year'=>$txt_year,'txt_class'=>$txt_class,'txt_room'=>$txt_room);
		$this->load->view('student_img/print_student_card',$img_room);		
	}public function print_student_card_behind(){
		$this->load->view('student_img/print_student_card_behind');
	}public function student_card_rc($sud_key,$txt_year,$txt_t){
		$rc_date=array('sud_key'=>$sud_key,'txt_year'=>$txt_year,'txt_t'=>$txt_t);
		$this->load->view('student_img/student_card_rc',$rc_date);
	}public function print_stu_card($txt_key,$txt_t,$txt_y){
		$img_room=array('txt_key'=>$txt_key,'txt_t'=>$txt_t,'txt_y'=>$txt_y);
		$this->load->view('student_img/print_stu_card',$img_room);
	}
	
} ?>
