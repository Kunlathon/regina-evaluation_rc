<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Activity extends CI_Controller {
    public function index(){
        $this->load->view('errors/system_error');
    }
	public function error(){
		$this->load->view('errors/system_error');
	}    
	public function print_activity(){
		$this->load->view('activity/activity_report_all');
	}    
} ?>