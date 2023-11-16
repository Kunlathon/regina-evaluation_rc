<?php
	//Develop By Kunlathon Saowakhon
	//พัฒนาเว็บไซต์โดย นายกุลธร เสาวคนธ์
	//Tel 0932670639
	//โทร 0932670639
	//Email: mpamese.pc2001@gmail.com , missing_yrc2014@hotmail.com
	//ห้ามใช้ /**/ จะส่งผลให้ค่า return js ทำงานผิดปกติ !!
?>
<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Summer_score_upload extends CI_Controller{
        public function index(){
            $this->load->view('summer_score_upload/load_excel');
        } 
        public function print_rssubject(){
            $this->load->view('summer_score_upload/print_rssubject');
        }
        public function load_excel(){
            $this->load->view('summer_score_upload/load_excel');
        }
        public function error(){
            $this->load->view('errors/system_error');
        }

    }
?>