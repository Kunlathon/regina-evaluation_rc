<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rcprint extends CI_Controller{
    public function print_summer($RcId){
		$set_stuid=array('RcId'=>$RcId);
        $this->load->view('rc_print/print_summer',$set_stuid);        
    }
	
	public function print_receipt_ex(){
		$this->load->view('rc_print/print_receipt_ex'); 
	}
		
    public function index(){
        $this->load->view('errors/system_error');
    }   
	
    public function error(){
		$this->load->view('errors/system_error');
	}    
}
?>