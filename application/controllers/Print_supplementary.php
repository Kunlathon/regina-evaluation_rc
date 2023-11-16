<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Print_supplementary extends CI_Controller{
    public function special($RcId){
        $set_stuid=array('RcId'=>$RcId);
        $this->load->view('supplementary/supplementary_print',$set_stuid);
    }public function index(){
        $this->load->view('errors/system_error');
    }public function error(){
		$this->load->view('errors/system_error');
	}public function report_supplementary($PrC,$PrT,$PrY){
		$print_report=array('PrC'=>$PrC,'PrT'=>$PrT,'PrY'=>$PrY);
		$this->load->view('supplementary/report_supplementary',$print_report);
	}
}
?>

