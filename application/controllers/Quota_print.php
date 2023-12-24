<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Quota_print extends CI_Controller {
	    public function index(){
			$this->load->view('errors/system_error');
		}public function error(){
			$this->load->view('errors/system_error');
		}public function print_img(){
			$this->load->view('errors/system_error');
		}public function print_intention($RcYear,$RcId){
			$set_stuid=array('RcYear'=>$RcYear,'RcId'=>$RcId);
			$this->load->view('quota_print/print_intention',$set_stuid);
		}public function print_quota($RcYear,$RcId){
			$set_stuid=array('RcYear'=>$RcYear,'RcId'=>$RcId);
			$this->load->view('quota_print/print_quota',$set_stuid);
		}public function print_quota_admin($RcYear,$RcId,$Rc_qr_plan,$Rc_qce_key){
			$set_stuid=array('RcYear'=>$RcYear,'RcId'=>$RcId,'Rc_qr_plan'=>$Rc_qr_plan,'Rc_qce_key'=>$Rc_qce_key);
			$this->load->view('quota_print/print_quota',$set_stuid);
		}
		
		public function delete_form(){
			$this->load->view('quota_print/delete_form');
		}public function qm_show_quota(){
			$this->load->view('quota_print/qm_show_quota');
		}public function qm_into_quota(){
			$this->load->view('quota_print/am_into_quota');
		}public function qm_upin_quota(){
			$this->load->view('quota_print/qm_upin_quota');
		}
	} 
?>