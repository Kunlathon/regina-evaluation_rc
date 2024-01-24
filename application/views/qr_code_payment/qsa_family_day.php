<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--****************************************************************************-->			
<script type="text/javascript">
        function setScreenHWCookie() {
            $.cookie('sw',screen.width);
                //$.cookie('sh',screen.height);
            return true;
        }
            setScreenHWCookie();
    </script>

    <?php
		$width_system=filter_input(INPUT_COOKIE,'sw');
		if($width_system>=1200){
			$grid="lg";
		}elseif($width_system<=992){
			$grid="md";
		}elseif($width_system<=768){
			$grid="sm";
		}else{
			$grid="xs";
		}
    ?>
<!--****************************************************************************-->	

	
	

	<script src="<?php echo base_url();?>/view/js_css_code/qrcodejs/qrcode.min.js"></script>

<!--****************************************************************************-->
	<?php
		$this->load->library('session');
//----------------------------------------------------------------------------  
			include("view/img_user/document/gotolink.php");//-----------------
			$goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
			$golink=$goingtolink->Rungotolink();//----------------------------
//----------------------------------------------------------------------------
				if(($this->session->userdata("rc_user")==null)){
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
						if(($log_row["int_uesr"]>=1)){ 
							
							$pay_billerID=filter_input(INPUT_POST,'pay_billerID');
							$txt_ref1=filter_input(INPUT_POST,'txt_ref1');
							$txt_ref2=filter_input(INPUT_POST,'txt_ref2');
							$txt_amount=filter_input(INPUT_POST,'txt_amount');
							$CSD_Sumpay=filter_input(INPUT_POST,'CSD_Sumpay');
							?>


<script>
	$(document).ready(function(){
		var pay_billerID='<?php echo $pay_billerID;?>';
		var txt_ref1='<?php echo $txt_ref1;?>';
		var txt_ref2='<?php echo $txt_ref2;?>';
		var txt_amount='<?php echo $txt_amount;?>';
		var code_pay=decodeURIComponent("%7C"+pay_billerID+"%0D"+txt_ref1+"%0D"+txt_ref2+"%0D"+txt_amount);
			
		var qrcode_pay = new QRCode(document.getElementById("qrcode_pay"), {
		  text: code_pay,
		  width: 120,
		  height: 120
		})		
	
	})
  </script>

		<fieldset class="content-group">
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div>BillerID&nbsp;:&nbsp;<?php echo $pay_billerID;?></div>
					<div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
					<div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<center>
						<div id="qrcode_pay" class="img-thumbnail"></div>
						<div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($CSD_Sumpay, 2, '.', ',');?>&nbsp;&nbsp;บาท</div>
						<div></div>
					</center> 
				</div>
			</div>
		</fieldset>

	<?php				}else{}
					}
				}
	?>