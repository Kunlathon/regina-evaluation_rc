<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class QR_Code_Payment extends CI_Controller{
		public function index(){
			$this->load->view('qr_code_payment/qsa_family_day');
		}
	}
?>