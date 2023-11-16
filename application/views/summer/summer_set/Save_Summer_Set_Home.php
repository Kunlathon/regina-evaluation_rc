<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>






<?php
	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");
//--------------------------------------------------------------------
	if($this->session->userdata("rc_user")==null){
		$this->session->unset_userdata("rc_user");
		exit("<script>window.location='$golink/print_imgstu/error';</script>");		
	}else{
		$LoginKey=$this->session->userdata("rc_user");
		$admin_log=$this->load->database("default",TRUE);		
		$admin_log=$this->db->query("SELECT COUNT(`login_id`) AS `int_uesr` 
									 FROM `login` 
									 WHERE `use_status`='1' 
									 AND `login_id`='{$LoginKey}'");
		foreach($admin_log->result_array() as $log_row){
			if($log_row["int_uesr"]>=1){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$test_system=filter_input(INPUT_POST,'test_system');
		$OFFONDateTime=filter_input(INPUT_POST,'OFFONDateTime');
		$EndDateTime=filter_input(INPUT_POST,'EndDateTime');
		$data_yaer=filter_input(INPUT_POST,'data_yaer');
		$data_term=filter_input(INPUT_POST,'data_term');
		$data_summer=filter_input(INPUT_POST,'data_summer');
		$time_add=filter_input(INPUT_POST,'time_add');
		$DeletePay_Sud=filter_input(INPUT_POST,'DeletePay_Sud');
		$DeletePay_Admin=filter_input(INPUT_POST,'DeletePay_Admin');
		$End4143_notrun=filter_input(INPUT_POST,'End4143_notrun');
		
		
		$Update_SetSSSH=new SystemSummer("edit",$test_system,$OFFONDateTime,$EndDateTime,$data_yaer,$data_term,$data_summer,$time_add,$DeletePay_Sud,$DeletePay_Admin,$End4143_notrun);
				
	?>
	
	
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
    
      <!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">ตั้งค่าระบบการลงทะเบียนสอนเสริม ภาคฤดูร้อน</h4>
			</div>
			<div class="modal-body">
				<button type="button" name="SSSH_RUN" id="SSSH_RUN" class="btn btn-warning">ตรวจสอบผลการตั้งค่า</button>
			</div>
		</div>
      
		</div>
	</div>	
	



	<script>
		$(document).ready(function(){
			$("#myModal").modal({backdrop: false});
		});
		
		$(document).ready(function(){
			$('#SSSH_RUN').on('click', function() {
				var UP_SSSH="<?php echo $Update_SetSSSH->RunSS_Error();?>";
					if(UP_SSSH=="No"){
						swal({
							title: "สำเร็จ",
							text: "การตั้งค่าระบบ สำเร็จ",
							confirmButtonColor: "#32CD32",
							type: "success"
						},function(){
							document.location="<?php echo base_url();?>/?evaluation_mod=summer_set";
						});						
					}else if(UP_SSSH=="Yes"){
						swal({
							title: "ไม่สำเร็จ",
							text: "การตั้งค่าระบบ ไม่สำเร็จ",
							confirmButtonColor: "#FF0000",
							type: "error"
						},function(){
							document.location="<?php echo base_url();?>/?evaluation_mod=summer_set";
						});	
					}else{
						swal({
							title: "เกิดข้อผิดพลาด",
							text: "เกิดข้อผิดพลาดไม่สามารถดำเนินการได้",
							confirmButtonColor: "#FF8C00",
							type: "warning"
						},function(){
							document.location="<?php echo base_url();?>/?evaluation_mod=summer_set";
						});						
					}
			});
		});
		
	</script>


<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{
				$this->session->unset_userdata('rc_user');
				exit("<script>window.location='$golink/print_imgstu/error';</script>");				
			}
		}							 
	}
?>	
	
	


