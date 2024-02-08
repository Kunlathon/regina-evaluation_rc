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

	public function process_summer_set($txt_process){
		$Row_Summer=array('txt_process'=>$txt_process);
		$this->load->view('summer/summer_set/summer_set_process',$Row_Summer);
	}

	public function test_summer_quota($tsq_year,$tsq_id){
		$Row_Summer=array('tsq_year'=>$tsq_year,'tsq_id'=>$tsq_id);
		$this->load->view('summer/summer_set/test_summer_quota',$Row_Summer);
	}

}
?>