<?php
		//include("view/function/pay_scb.php");
		$txt_billerId="099400043439110";
		$txt_year="2565";
		/*$CSD_Sumpay=filter_input(INPUT_COOKIE,'py');;
		$txt_time=date("YmdHis");
		$txt_ref1=strtoupper("FY".$txt_time);
		$txt_ref2=strtoupper("FAMILYDAY".$txt_year);
		$txt_amount=number_format($CSD_Sumpay, 2, '.', '');                                                   
		$txt_width="104";
		$payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);*/
?>		
	<script>
		$(document).ready(function () {
//Alert combination
			$('#Enter_qfd').on('click', function() {
				var pay_int=$("#pay_qfd").val();
				var pay_billerID="<?php echo $txt_billerId;?>";
				var pay_year="<?php echo $txt_year;?>";
				swal({
					title: "QRcode Payment",
					text: "ต้องการสร้าง QRcode Payment",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#EF5350",
					confirmButtonText: "Yes",
					cancelButtonText: "No",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if(isConfirm){
						if(pay_int==""){
							swal({
								title: "กรุณาระบุจำนวนเงิน",
								confirmButtonColor: "#2196F3",
								type: "error"
							});							
						}else if(pay_int=="0" || pay_int=="0.00"){
							swal({
								title: "จำนวนเงิน 0 บาท ไม่สามารถสร้าง Qrcodeได้ กรุณาระบุจำนวนเงินอย่างน้อย 1.00 บาท ขึ้นไป",
								confirmButtonColor: "#2196F3",
								type: "warning"
							});							
						}else{
							swal({
								title: "สร้าง QRcode Payment",
								text: "กำลังดำเนินการสร้าง QRcode Payment",						
								confirmButtonColor: "#66BB6A",
								type: "success"
							},function(Txqfd){
								$.post("<?php echo base_url();?>/QR_Code_Payment",{
									pay_int:pay_int,
									pay_billerID:pay_billerID,
									pay_year:pay_year
								},function(Txqfd_Data){
									$("#Txqfd_Data").html(Txqfd_Data)
								})
							});							
						}
					}else{
						swal({
							title: "ไม่ต้องการสร้าง QRcode Payment",
							confirmButtonColor: "#2196F3",
							type: "error"
						});
					}
				});
			});	
//Alert combination End			
		})	
	</script>




<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">QRCode&nbsp;Payment&nbsp;กิจกรรม&nbsp;โรงเรียน&nbsp;>&nbsp;</span>&nbsp;วันครอบครัวโรงเรียนเรยีนาเชลีวิทยาลัย</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>&nbsp;สร้าง&nbsp;QR&nbsp;Code&nbsp;Payment&nbsp;กิจกรรม&nbsp;วันครอบครัวโรงเรียนเรยีนาเชลีวิทยาลัย</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>



<div class="row" style="font-family: surafont_sanukchang; font-size: 17px;">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-blue">
			<div class="row">
				<div class="col-<?php echo $grid;?>-4">
					<div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
					<div>ref1&nbsp;:&nbsp;FYXXXXXX</div>
					<div>ref2&nbsp;:&nbsp;FAMILYDAY<?php echo $txt_year;?></div>
					<div>จำนวนเงิน&nbsp;:&nbsp;X.XX</div>
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<fieldset class="content-group">
						<div class="form-group">
							<label class="control-label col-<?php echo $grid;?>-6">จำนวนเงินสำหรับสร้าง&nbsp;QRcode&nbsp;Payment</label>
							<div class="col-<?php echo $grid;?>-6">
								<input type="text" id="pay_qfd" name="pay_qfd" style="font-family: surafont_sanukchang; font-size: 17px;" class="form-control border-blue border-lg" placeholder="จำนวนเงิน 0.00">
							</div>
						</div>
					</fieldset>
				</div>
				<div class="col-<?php echo $grid;?>-2">
					<button type="button"id="Enter_qfd" name="Enter_qfd" class="btn btn-success">&nbsp;สร้าง&nbsp;QRCode&nbsp;</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="Txqfd_Data"></div>