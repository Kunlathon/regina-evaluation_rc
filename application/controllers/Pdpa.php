<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pdpa extends CI_Controller {
	public function index(){
        $this->load->view('errors/system_error');
    }public function error(){
		$this->load->view('errors/system_error');
	}public function pdpa_th(){
		$this->load->view('pdpa_data/pdpa_th');
	}public function pdpa_en(){
		$this->load->view('pdpa_data/pdpa_en');		
	}
}
?>