<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Summer extends CI_Controller{
	
	public function sud_summer($data_class,$data_year){
		$RunSummer=array('data_class'=>$data_class,'data_year'=>$data_year);
		$this->load->view('summer/print_summer',$RunSummer);
	}
	
	public function report_summer($data_class,$data_year){
		$RunSummer=array('data_class'=>$data_class,'data_year'=>$data_year);
		$this->load->view('summer/report_summer',$RunSummer);
	}


	public function Save_Summer_Set_Home(){
		$this->load->view('summer/summer_set/Save_Summer_Set_Home');
	}
	
	public function index(){
        $this->load->view('errors/system_error');
    }   
	
    public function error(){
		$this->load->view('errors/system_error');
	}
	
	public function Data_Sud_Summer(){
		$this->load->view("summer/ad_summer/Data_Sud_summer");
	}

	public function summer_register(){
		$this->load->view('summer/summer_register/summer_register');
	}

	public function print_summer_count($PSC_Year,$PSC_Class){
		$RunSummer=array('PSC_Year'=>$PSC_Year,'PSC_Class'=>$PSC_Class);
		$this->load->view('summer/print_summer_count/print_summer_count',$RunSummer);
	}


}
?>