<?php
		//include("view/function/pay_scb.php");
		$txt_billerId="099400043439110";
		$txt_year=(date("Y")+543);
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
				var txt_time='<?php echo date("YmdHis");?>';
				var txt_ref1='FY'+txt_time.toUpperCase();
				var txt_ref2='FAMILYDAY'+pay_year.toUpperCase();

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
						if(pay_int===""){
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
						}else if(isNaN(pay_int)){
							swal({
								title: "กรุณาระบุจำนวนเงิน",
								confirmButtonColor: "#2196F3",
								type: "error"
							});
						}else{
							swal({
								title: "สร้าง QRcode Payment",
								text: "กำลังดำเนินการสร้าง QRcode Payment",						
								confirmButtonColor: "#66BB6A",
								type: "success"
							},function(Txqfd){

								pay_int=parseFloat(pay_int);				
								var CSD_Sumpay=pay_int.toFixed(2);
								var txt_amount=CSD_Sumpay.replace(".","");

								$.post("<?php echo base_url();?>/QR_Code_Payment",{
									pay_billerID:pay_billerID,
									txt_ref1:txt_ref1,
									txt_ref2:txt_ref2,
									txt_amount:txt_amount,
									CSD_Sumpay:CSD_Sumpay
								},function(Txqfd_Data){
			
									$("#Txqfd_Data").html(Txqfd_Data);
//Modal content
									$("#myModal").modal("show");
    
									$("#myBtn").click(function(){
										$("#myModal").modal({backdrop: "static"});
									});
//Modal content end
								})
							})					
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


	<script>
		$(document).ready(function(){
			$("#modal_qfa").on('click',function(){
				var modal_qfa=$("#modal_qfa").val();
					if(modal_qfa==="Close"){
						location.reload();
					}else{}
			})
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

<div class="row" style="font-family: surafont_sanukchang; font-size: 17px;">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-blue">
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div><b>วิธีการชำระ</b></div>
                    <div>1&nbsp;.&nbsp;ทำการสแกน&nbsp;QR&nbsp;Code&nbsp;ที่ปรากฏในเพจนี้&nbsp;ด้วยแอปพลิเคชัน&nbsp;Mobile&nbsp;Banking&nbsp;ของท่าน</div>
                    <div>2&nbsp;.&nbsp;ตรวจสอบข้อมูลที่ปรากฏใน&nbsp;Mobile&nbsp;Banking&nbsp;ให้ถูกต้องก่อนชำระเงิน</div>
                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบจำนวนเงินให้ถูกต้อง</div>
                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบชื่อผู้รับเงินต้องเป็น&nbsp;โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;หรือ&nbsp;REGINA&nbsp;COELI&nbsp;COLLEGE&nbsp;SCHOOL&nbsp;เท่านั้น</div>
                    <div>3&nbsp;.&nbsp;สำหรับหลักฐานการชำระเงินให้ท่านเก็บไว้เป็นหลักฐาน</div>
                    <div>4&nbsp;.&nbsp;ทางโรงเรียนจะทำการตรวจสอบรายการและยืนยันการชำระเงินของท่าน </div>
                    <div>5&nbsp;.&nbsp;การชำระเงินจะเสร็จสมบูรณ์&nbsp;เมื่อทางโรงเรียนได้ตรวจสอบการชำระเงินของท่านเรียบร้อยแล้ว</div>
                    <div>6&nbsp;.&nbsp;หากต้องการใบเสร็จรับเงิน&nbsp;ติดต่อขอรับได้ที่ห้องการเงินของโรงเรียน</div>
                    <div>7&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่ม&nbsp;กรณาติดต่อ&nbsp;053-282395&nbsp;ต่อ&nbsp;0</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Thai QR Payment </h4>
        </div>

        <div class="modal-body">
          	<div id="Txqfd_Data"></div>
        </div>

		<div class="modal-footer">
			<button type="button" class="btn btn-danger" id="modal_qfa" value="Close" data-dismiss="modal">ปิด / Close</button>
		</div>

      </div>
      
    </div>
  </div>