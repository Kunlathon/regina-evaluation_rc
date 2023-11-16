<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Concert_pay extends CI_Controller {
    public function index(){
        $this->load->view('concert_pay/list_concert_pay');
    }public function add_keep_concert(){
		$this->load->view('concert_pay/add_keep_concert');
	}public function delete_lcc_admin($DLA_Key){
		$Concert_Data=array('DLA_Key'=>$DLA_Key);
		$this->load->view('concert_pay/delete_lcc_admin',$Concert_Data);
	}public function concert_predicate(){
		$this->load->view('concert_pay/concert_predicate');
	}
	
	
	
	public function error(){
		$this->load->view('errors/system_error');
	}      
} ?>