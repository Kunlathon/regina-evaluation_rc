<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
//--------------------------------------------------------------------		
		/*include("view/database/pdo_conndatastu.php");
		include("view/database/class_pdodatastu.php");
		
		include("view/database/pdo_data.php");
		include("view/database/class_admin.php");

		
		include("view/database/pdo_admission.php");
		include("view/database/regina_student.php");
		
		include("view/database/pdo_activity.php");
		include("view/database/class_supplementary.php");  */


//--------------------------------------------------------------------  
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
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
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="stats-in-th" content="b062" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

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
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery.min.js"></script>
<!--****************************************************************************-->


	
		<?php
			$pay_int=filter_input(INPUT_POST,'pay_int');
			$pay_billerID=filter_input(INPUT_POST,'pay_billerID');
			$pay_year=filter_input(INPUT_POST,'pay_year');
				if(isset($pay_int,$pay_billerID,$pay_year)){ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		
			<?php
				include("view/function/pay_scb.php");
				$txt_billerId=$pay_billerID;
				$txt_year=$pay_year;
				$CSD_Sumpay=$pay_int;
				$txt_time=date("YmdHis");
				$txt_ref1=strtoupper("FY".$txt_time);
				$txt_ref2=strtoupper("FAMILYDAY".$txt_year);
				$txt_amount=number_format($CSD_Sumpay, 2, '.', '');                                                   
				$txt_width="104";
				$payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
			?>	
		
		
		<script>
			$(document).ready(function(){
				$('#sweet_qfd').on('click', function() {
					swal({
						title: 'QRcode',
						text: '<img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width;?>" width="204" height="136">',
						html: true
					});
				});					
			})
		</script>
				
				
		<div class="row">
			<div class="col-<?php echo $grid;?>-6">
                <div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
                <div>ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
                <div>ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
                <div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($txt_amount, 2, '.', ',');?></div>
			</div>
			<div class="col-<?php echo $grid;?>-6">
				<button type="button" id="sweet_qfd" name="sweet_qfd" class="btn btn-success">แสดง Qrcode</button>
			</div>
		</div>


	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}else{ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div>พบข้อผิดพลาดไม่สามารถดำเนินการสร้าง&nbsp;Qrcode&nbsp;ได้</div>
			</div>
		</div>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{
				$this->session->unset_userdata('rc_user');
				exit("<script>window.location='$golink/print_imgstu/error';</script>");		
			}
		}							 		
	}
?>



