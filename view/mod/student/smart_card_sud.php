<style>
	#RuningLoadHome{
		display:none;
	}
	
	.imgA{
		width: 5.4cm; height: 8.6cm;
	}
	
	.textAlignVer{
		display:block;
		filter: flipv fliph;
		-webkit-transform: rotate(-90deg); 
		-moz-transform: rotate(-90deg); 
		transform: rotate(-90deg); 
		position:relative;
		width:20px;
		white-space:nowrap;
		font-size:12px;
		margin-bottom:10px;
	}	
</style>

<?php
	include("view/database/pdo_data.php");
	include("view/database/class_pdo.php");
	
	include("view/database/pdo_conndatastu.php");

	
	include("view/database/pdo_release.php");
	include("view/database/class_release.php");
	
	include("view/database/pdo_admission.php");
	
	include("view/database/regina_student.php");

//pay_scb+++++++++++++++++++++++++++++++++++++++	
	include("view/function/pay_scb.php");
//pay_scb+++++++++++++++++++++++++++++++++++++++	

	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");

	include("view/database/pdo_activity.php");
	include("view/database/class_activity.php");
	
	$data_yaer=2566;
	$user_login;
	$PrintReginaStuData=new PrintReginaStuData($user_login);
	
	
	if($TxtIdClass==3){
		$file_img="sud_img03";
	}elseif($TxtIdClass>=11 and $TxtIdClass<=22){
		$file_img="sud_img1122";
	}elseif($TxtIdClass>=23 and $TxtIdClass<=33){
		$file_img="sud_img2333";
	}elseif($TxtIdClass>=41 and $TxtIdClass<=43){
		$file_img="sud_img4143";
	}else{
		$file_img="all";
	}
									
	$txt_y=$data_yaer;		
	if($TxtIdClass==3){
		$ExpY=$txt_y+1;
	}elseif($TxtIdClass==11){
		$ExpY=$txt_y+6;
	}elseif($TxtIdClass==12){
		$ExpY=$txt_y+5;
	}elseif($TxtIdClass==13){
		$ExpY=$txt_y+4;
	}elseif($TxtIdClass==21){
		$ExpY=$txt_y+3;
	}elseif($TxtIdClass==22){
		$ExpY=$txt_y+2;
	}elseif($TxtIdClass==23){
		$ExpY=$txt_y+1;
	}elseif($TxtIdClass==31){
		$ExpY=$txt_y+3;
	}elseif($TxtIdClass==32){
		$ExpY=$txt_y+2;
	}elseif($TxtIdClass==33){
		$ExpY=$txt_y+1;							
	}elseif($TxtIdClass==41){
		$ExpY=$txt_y+3;
	}elseif($TxtIdClass==42){
		$ExpY=$txt_y+2;
	}elseif($TxtIdClass==43){
		$ExpY=$txt_y+1;
	}else{
		$ExpY="-";
	}	
									
	if(file_exists("view/$file_img/$user_login.jpg")){
		$user_img="$user_login.jpg";
	}else{
		if(file_exists("view/$file_img/$user_login.JPG")){
			$user_img="$user_login.JPG";                       
		}else{
			$user_img="newimg_rc.jpg";                        
		}
	}											
			
	?>	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="breadcrumb-line breadcrumb-line-component">
				<ul class="breadcrumb">
					<h4><span class="text-semibold">บัตรประจำตัวนักเรียน&nbsp;(Smart&nbsp;Card&nbsp;Student)</span></h4>
				</ul>
				<ul class="breadcrumb-elements">
					<div class="heading-btn-group">
						<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
						<a class="btn btn-link text-size-small"><span>/</span></a>
						<a href="./?evaluation_mod=smart_card_sud" class="btn btn-link  text-size-small"><span>บัตรประจำตัวนักเรียน&nbsp;(Smart&nbsp;Card&nbsp;Student)</span></a>
					</div>
				</ul>
			</div>
		</div>
	</div><br>
	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-info">
				<div class="panel-heading">รูปบัตรนักเรียน</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-<?php echo $grid;?>-4">
							<center><section class="sheet padding-10mm imgA" style="background-image: url('<?php echo base_url();?>/view/img_user/student_card.png'); background-repeat: no-repeat; background-size: 100%; float:center;">
								<div>&nbsp;</div>
								<div>&nbsp;</div>
								<div>&nbsp;</div>
								<div>&nbsp;</div>
								<div>&nbsp;</div>
								<div>
									<table style="width: 120%; vertical-align: top; font-family: THSarabunNew ;" border="0" cellpadding="0" cellspacing="0" align="canter">
										<tbody>
											<tr>
												<td>
													<div style="text-align: center;"><img src="<?php echo base_url();?>/view/<?php echo $file_img;?>/<?php echo $user_img;?>" style="width: 1.80cm; height: 2.30cm;" class="img-thumbnail"/></div>				
												</td>
											</tr>
										</tbody>
									</table>												
									<table style="width: 120%; vertical-align: top; font-family: THSarabunNew ;" border="0" cellpadding="0" cellspacing="0" align="canter">
										<tbody>
											<tr>
												<td>
													<div style="text-align: center; font-size: 7px; font-weight: bold; line-height: 10px;">เลขประจำตัว&nbsp;/&nbsp;STUDENT&nbsp;ID</div>
													<div style="text-align: center; font-size: 11px; font-weight: bold; line-height: 10px;"><?php echo $user_login;?></div>
													<div style="text-align: center; font-size: 7px; font-weight: bold; line-height: 10px;">ชื่อ-สกุล&nbsp;NAME-SURNAME</div>
													<div style="text-align: center; font-size: 12px; font-weight: bold; line-height: 10px;"><?php echo $PrintReginaStuData->PRS_NTH;?></div>
													<div style="font-size: 9px; float:left; font-weight: bold; line-height: 10px;"></div>
												</td>
											</tr>
										</tbody>
									</table>
									<table style="width: 100%; vertical-align: top; font-family: THSarabunNew ;" border="0" cellpadding="0" cellspacing="0" align="canter">
										<tbody>
											<tr>
												<td>
													<div style="font-size: 9px; float:right; font-weight: bold; line-height: 10px;" class="textAlignVer">Exp.&nbsp;Date&nbsp;05&nbsp;/&nbsp;<?php echo $ExpY;?></div>
												</td>
											</tr>
										</tbody>
									</table>
													
								</div>												
							</section></center>							
						</div>
						<div class="col-<?php echo $grid;?>-4">
							<center><section class="sheet padding-10mm imgA" style="background-image: url('<?php echo base_url();?>/view/img_user/card_behind07.jpg'); background-repeat: no-repeat; background-size: 100%;"></section>
						</div>
						<div class="col-<?php echo $grid;?>-4">
							<div><center>เงื่อนไขการใช้บัตร</center></div>
							<div>1.&nbsp;บัตรนี้เป็นกรรมสิทธิ์ของโรงเรียนเรยีนาเชลีวิยาลัย การใช้บัตรต้องเป็นไปตามกฎข้อบังคับของโรงเรียน</div>
							<div>2.&nbsp;กรณีบัตรสูญหาย ติดต่อที่ผ่ายการเงิน</div>
							<div>3.&nbsp;บัตรหมดอายุเมื่อจบช่วงชั้น ป.3 ป.6 ม.3 ม.6 และเมื่อนักเรียนพันสภาพการเป็นนักเรียน</div>
							<div>4.&nbsp;ผู้ใดเก็บบัตรนี้ได้กรุณาส่งคืนโรงเรียนเรยีนาเชลีวิยาลัย</div>
							<div>&nbsp;</div>
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
	<script>   
		$(document).ready(function(){	
// Set the date we're counting down to
			var countDownDate = new Date("May 05, <?php echo $ExpY-543; ?> 00:00:00").getTime();
// Update the count down every 1 second
			var x = setInterval(function(){
// Get today's date and time
			var now = new Date().getTime();
// Find the distance between now and the count down date
			var distance = countDownDate - now;    
// Time calculations for days, hours, minutes and seconds
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
// Output the result in an element with id="demo"
			document.getElementById("card_sud_time").innerHTML = days + " วัน " + hours + " ชั่วโมง "
			+ minutes + " นาที " + seconds + " วินาที ";
// If the count down is over, write some text 
				if (distance < 0) {
					clearInterval(x);
					document.getElementById("card_sud_time").innerHTML = "บัตรนักเรียนหมดอายุ";
				}else{}
				
			}, 1000);		
		});
	

	</script>							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
							<div>Exp.&nbsp;Date&nbsp;05&nbsp;/&nbsp;<?php echo $ExpY;?></div>
							<div id="card_sud_time"></div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
	
	
	
	
	