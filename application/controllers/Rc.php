<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rc extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$this->load->view('welcome_message');
	}
	
	public function loginrc(){
		$this->load->view('login_message');
	}
	
	public function connect_login(){
		$this->load->view('connect_login_message');
	}
	
	public function logout(){
		$this->load->view('logout_message');
	}
	
	public function logout_admin(){
		$this->load->view('logout_admin_message');
	}
	
} ?>
