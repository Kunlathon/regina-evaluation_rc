<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Weekend_class extends CI_Controller {
	public function index(){
		$this->load->view('weekend_class/code_weekend');
	}public function backspace(){
		$this->load->view('weekend_class/weekend_backspace');
	}public function statistics(){
		$this->load->view("weekend_class/statistics_weekend");
	}public function set(){
		$this->load->view("weekend_class/weekend_set");
	}public function up_date(){
		$this->load->view("weekend_class/weekend_setup");
	}public function date_rc($WeekendT,$WeekendY,$WeekendKey){
		$set_stuid=array('WeekendT'=>$WeekendT,'WeekendY'=>$WeekendY,'WeekendKey'=>$WeekendKey); 
		$this->load->view("weekend_class/weekend_date_rc",$set_stuid);
	}public function weekend_use(){
		$this->load->view("weekend_class/weekend_use");
	}public function weekend_serve(){
		$this->load->view("weekend_class/weekend_serve");
	}public function print_weekend($pw_t,$pw_y,$pw_key){
		$set_weekend=array('pw_t'=>$pw_t,'pw_y'=>$pw_y,'pw_key'=>$pw_key);
		$this->load->view("weekend_class/weekend_print",$set_weekend);
	}public function ws_student(){
		$this->load->view("weekend_class/ws_student");
	}public function ws_data_all(){
		$this->load->view("weekend_class/ws_data_all");
	}	
} ?>




