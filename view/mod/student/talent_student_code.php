<style>
#RuningLoad {
	display:none;
}
</style>
<?php
//-----------------------------------------------------------------------------
	include("view/database/pdo_data.php");
	include("view/database/class_pdo.php");	
//-----------------------------------------------------------------------------	
	include("view/database/pdo_talent.php");
	include("view/database/class_talent.php");
//-----------------------------------------------------------------------------		
	$data_yaer=2565;
	$data_term=1;

	$user_login;
//------------------------------------------------------------------------------
	$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
//------------------------------------------------------------------------------

//Off System
	$OFFNO_System=array("OFF","ON");
	$level0033=$OFFNO_System[0];
	$level1113=$OFFNO_System[1];
	$level2123=$OFFNO_System[1];
	$level3133=$OFFNO_System[1];
	$level4143=$OFFNO_System[1];
//Off System End
?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<script>
	$(function() {
		$("#RunLoad").fadeOut(5000, function() {
			$("#RuningLoad").fadeIn(4000);
		});
	});
</script>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<script>
	$(document).ready(function (){
		
		$("#buttonA").click(function(){
			document.location = "/programming/evaluation_rc/?evaluation_mod=talent_student";
		})
		
		$("#buttonB").click(function(){
			document.location = "/programming/evaluation_rc/?evaluation_mod=home";
		})
		
	})
</script>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<center>
			<div id="RunLoad">
				<img class="img-thumbnail" src="Template/global_assets/images/Cube-1s-200px.gif" />
			</div>	
		</center>
	</div>
</div>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
<div id="RuningLoad">
<!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4><span class="text-semibold">แบบสำรวจนักเรียนที่มีความสามารถพิเศษ (สำหรับผู้ปกครอง) <?php echo $data_term."/".$data_yaer;?></span></h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=talent_student" class="btn btn-link  text-size-small"><span>แบบสำรวจนักเรียนที่มีความสามารถพิเศษ (สำหรับผู้ปกครอง)</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<?php 
		if($data_stu->IDLevel>=3 and $data_stu->IDLevel<=3){ ?>
<!--================================================================================================-->	
		<?php
			switch($level0033){
				case "OFF": ?>
<!--################################################################################################-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger alert-styled-left">
			สิ้นสุดระยะเวลา สำรวจนักเรียนที่มีความสามารถพิเศษ พบข้อสงสัย กรุณาติดผ่ายงาน แนวแนะประถม / มัธยม ในเวลา 08.00 - 17.00 น. วันจันทร์ ถึง วันศุกร์
		</div>
	</div>
</div>				
<!--################################################################################################-->				
		<?php	break;
				case "ON":  ?>
<!--################################################################################################-->	
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<h6 class="content-group text-semibold">
			แบบสำรวจนักเรียนที่มีความสามารถพิเศษ ระดับชั้น อนุบาล
			<small class="display-block">
			ประจำปีการศึกษา <?php echo $data_yaer;?> (สำหรับผู้ปกครอง)
			</small>
		</h6>
	</div>
</div>		
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->		
	<?php
		$ButTalent=filter_input(INPUT_POST,'ButTalent');
		switch($ButTalent){
			case "ButTalentY": ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->	
	<?php
		$CallIntoJoinTheEvent=new IntoJoinTheEvent($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$ButTalent);
			if($CallIntoJoinTheEvent->RunIntoJoinTheEvent()=="Yes"){
				
//รายการวิชาการ
				if(isset($_POST["academic"])){
					$NumAcademic=count($_POST["academic"]);
					$CountAcademic=0;
						while($CountAcademic<$NumAcademic){
							$Academic=$_POST["academic"][$CountAcademic];
								if($Academic!=null or $Academic!=""){
									$CountAcademic=$CountAcademic+1;
									$CallIntoTalentAttention=new IntoTalentAttention($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$CountAcademic,$Academic);
										if($CallIntoTalentAttention->RunIntoTalentAttention()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------								
										}else{
											break;
										}								
								}else{
//---------------------------------------------------------------------------------------------------------------------------								
								}
						}					
					}else{
//---------------------------------------------------------------------------------------------------------------------------					
					}
//รายการวิชาการ  จบ				
//เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล
//ด้านวิชาการ
					if(isset($_POST["AcademicTxt"])){
						$NumAcademicTxt=count($_POST["AcademicTxt"]);
						$CountAcademicTxt=0;
							while($CountAcademicTxt<$NumAcademicTxt){
								$AcademicTxt=$_POST["AcademicTxt"][$CountAcademicTxt];
								$CountAcademicTxt=$CountAcademicTxt+1;
									if($AcademicTxt!=null or $AcademicTxt!=""){
										$CallIntoAcademicTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"1",$CountAcademicTxt,$AcademicTxt);
											if($CallIntoAcademicTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------																
											}else{
												break;
											}										
									}else{
//---------------------------------------------------------------------------------------------------------------------------									
									}								
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}

//ด้านวิชาการ จบ
//ด้านกีฬา		
					if(isset($_POST["SportTxt"])){
						$NumSportTxt=count($_POST["SportTxt"]);
						$CountSportTxt=0;
							while($CountSportTxt<$NumSportTxt){
								$SportTxt=$_POST["SportTxt"][$CountSportTxt];
								$CountSportTxt=$CountSportTxt+1;
									if($SportTxt!=null or $SportTxt!=""){
										$CallIntoSportTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"2",$CountSportTxt,$SportTxt);
											if($CallIntoSportTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------											
											}else{
												break;
											}
									}else{
//---------------------------------------------------------------------------------------------------------------------------									
									}
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}

//ด้านกีฬา จบ
//ด้านดนตรี
					if(isset($_POST["MusicTxt"])){
						$NumMusicTxt=count($_POST["MusicTxt"]);
						$CountMusicTxt=0;
							while($CountMusicTxt<$NumMusicTxt){
								$MusicTxt=$_POST["MusicTxt"][$CountMusicTxt];
								$CountMusicTxt=$CountMusicTxt+1;
									if($MusicTxt!=null or $MusicTxt!=""){
										$CallIntoMusicTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"3",$CountMusicTxt,$MusicTxt);
											if($CallIntoMusicTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------											
											}else{
												break;
											}
									}else{
//---------------------------------------------------------------------------------------------------------------------------									
									}
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}
//ด้านดนตรี จบ
//ด้านศิลปะและการแสดง
					if(isset($_POST["AAPTxt"])){
						$NumAAPTxt=count($_POST["AAPTxt"]);
						$CountAAPTxt=0;
							while($CountAAPTxt<$NumAAPTxt){
								$AAPTxt=$_POST["AAPTxt"][$CountAAPTxt];
								$CountAAPTxt=$CountAAPTxt+1;
									if($AAPTxt!=null or $AAPTxt!=""){
										$CallIntoAAPTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"4",$CountAAPTxt,$AAPTxt);
											if($CallIntoAAPTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------												
											}else{
												break;
											}
									}else{
//---------------------------------------------------------------------------------------------------------------------------										
									}
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}
//ด้านศิลปะและการแสดง จบ
//ด้านอื่นๆ
					if(isset($_POST["OtherTxt"])){
						$NumOtherTxt=count($_POST["OtherTxt"]);
						$CountOtherTxt=0;
							while($CountOtherTxt<$NumOtherTxt){
								$OtherTxt=$_POST["OtherTxt"][$CountOtherTxt];
								$CountOtherTxt=$CountOtherTxt+1;
									if($OtherTxt!=null or $OtherTxt!=""){
										$CallIntoOtherTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"5",$CountOtherTxt,$OtherTxt);
											if($CallIntoOtherTxt->RunIntoActivityMatch()=="Yes"){
//--------------------------------------------------------------------------------------------------													
											}else{
												break;
											}
									}else{
//--------------------------------------------------------------------------------------------------											
									}
							}						
					}else{
//--------------------------------------------------------------------------------------------------						
					}
//ด้านอื่นๆ จบ

//เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล จบ

//ระดับผลงาน / รางวัลที่เคยได้รับ				
//ด้านวิชาการ	
				if(isset($_POST["PortfolioAcademic"])){
					$NumPortfolioAcademic=count($_POST["PortfolioAcademic"]);
					$CountPortfolioAcademic=0;
						while($CountPortfolioAcademic<$NumPortfolioAcademic){
							$PortfolioAcademicTxt=$_POST["PortfolioAcademic"][$CountPortfolioAcademic];
								if($PortfolioAcademicTxt!=null or $PortfolioAcademicTxt!=""){
									$CountPortfolioAcademic=$CountPortfolioAcademic+1;
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioAcademic=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioAcademicTxt,"1");
										if($IntoPortfolioAcademic->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------								
								}
						}					
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านวิชาการ จบ				
//ด้านกีฬา
				if(isset($_POST["PortfolioSport"])){
					$NumPortfolioSport=count($_POST["PortfolioSport"]);
					$CountPortfolioSport=0;
					while($CountPortfolioSport<$NumPortfolioSport){
						$PortfolioSportTxt=$_POST["PortfolioSport"][$CountPortfolioSport];
							if($PortfolioSportTxt!=null or $PortfolioSportTxt!=""){
								$CountPortfolioSport=$CountPortfolioSport+1;
//--------------------------------------------------------------------------------------------------			
								$IntoPortfolioSport=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioSportTxt,"2");
									if($IntoPortfolioSport->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
									}else{
										break;
									}
//--------------------------------------------------------------------------------------------------								
							}else{
//--------------------------------------------------------------------------------------------------								
							}
					}					
				}else{
//--------------------------------------------------------------------------------------------------					
				}
//ด้านกีฬา จบ
//ด้านดนตรี
				if(isset($_POST["PortfolioMusic"])){
					$NumPortfolioMusic=count($_POST["PortfolioMusic"]);
					$CountPortfolioMusic=0;
						while($CountPortfolioMusic<$NumPortfolioMusic){
							$PortfolioMusicTxt=$_POST["PortfolioMusic"][$CountPortfolioMusic];
								if($PortfolioMusicTxt!=null or $PortfolioMusicTxt!=""){
									$CountPortfolioMusic=$CountPortfolioMusic+1;
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioMusic=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioMusicTxt,"3");
										if($IntoPortfolioMusic->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------								
								}
						}
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านดนตรี จบ
//ด้านศิลปะและการแสดง
				if(isset($_POST["PortfolioAAP"])){
					$NumPortfolioAAP=count($_POST["PortfolioAAP"]);
					$CountPortfolioAAP=0;
						while($CountPortfolioAAP<$NumPortfolioAAP){
							$PortfolioAAPTxt=$_POST["PortfolioAAP"][$CountPortfolioAAP];
								if($PortfolioAAPTxt!=null or $PortfolioAAPTxt!=""){
									$CountPortfolioAAP=$CountPortfolioAAP+1;
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioAAP=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioAAPTxt,"4");
										if($IntoPortfolioAAP->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------							
								}
						}					
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านศิลปะและการแสดง จบ
//ด้านอื่นๆ
				if(isset($_POST["PortfolioOther"])){
					$NumPortfolioOther=count($_POST["PortfolioOther"]);
					$CountPortfolioOther=0;
						while($CountPortfolioOther<$NumPortfolioOther){
							$PortfolioOtherTxt=$_POST["PortfolioOther"][$CountPortfolioOther];
								if($PortfolioOtherTxt!=null or $PortfolioOtherTxt!=""){
									$CountPortfolioOther=$CountPortfolioOther+1; 
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioOther=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioOtherTxt,"5");
										if($IntoPortfolioOther->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------								
								}
						}					
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านอื่นๆ จบ
//ระดับผลงาน / รางวัลที่เคยได้รับ จบ						
				
//ความสนใจหรือกิจกรรมที่ประสงค์อยากให้ทางโรงเรียนส่งเสริมหรือจัดกิจกรรม
					if(isset($_POST["ra_txt"])){
						$RaTxtCount=count($_POST["ra_txt"]);
						$CountRaTxt=0;
							while($CountRaTxt<$RaTxtCount){
								$AttentionTxt=$_POST["ra_txt"][$CountRaTxt];
									if($AttentionTxt!=null or $AttentionTxt!=""){
										$CountRaTxt=$CountRaTxt+1;
										$CallIntoJoinAttention=new IntoJoinAttention($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$CountRaTxt,$AttentionTxt);
										$SystemIntoJoinAttention=$CallIntoJoinAttention->RunIntoJoinAttention();
											if($SystemIntoJoinAttention=="Yes"){
//-----------------------------------------------------------------------------------------------------										
											}else{
												break;
											}
									}else{
//-----------------------------------------------------------------------------------------------------								
									}
							}
					}else{
//-----------------------------------------------------------------------------------------------------					
					}
//ความสนใจหรือกิจกรรมที่ประสงค์อยากให้ทางโรงเรียนส่งเสริมหรือจัดกิจกรรม จบ		?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>บันทึกแบบสำรวจ สำเร็จ</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."บันทึกแบบสำรวจนักเรียนที่มีความสามารถประจำปีการศึกษา".$data_yaer." เรียบร้อยแล้ว IP:".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
	}
?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php				
			}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>บันทึกแบบสำรวจ ไม่สำเร็จ</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php	}?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->			
	<?php	break;
			case "ButTalentN": ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->	
	<?php
		$CallIntoJoinTheEvent=new IntoJoinTheEvent($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$ButTalent);
			if($CallIntoJoinTheEvent->RunIntoJoinTheEvent()=="Yes"){
				if(isset($_POST["ra_txt"])){
					$RaTxtCount=count($_POST["ra_txt"]);
					$CountRaTxt=0;
						while($CountRaTxt<$RaTxtCount){
							$AttentionTxt=$_POST["ra_txt"][$CountRaTxt];
								if($AttentionTxt!=null or $AttentionTxt!=""){
									$CountRaTxt=$CountRaTxt+1;
									$CallIntoJoinAttention=new IntoJoinAttention($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$CountRaTxt,$AttentionTxt);
									$SystemIntoJoinAttention=$CallIntoJoinAttention->RunIntoJoinAttention();
										if($SystemIntoJoinAttention=="Yes"){
//-----------------------------------------------------------------------------------------------------										
										}else{
											break;
										}
								}else{
//-----------------------------------------------------------------------------------------------------								
								}
						}
				}else{
//-----------------------------------------------------------------------------------------------------					
				} ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>บันทึกแบบสำรวจ สำเร็จ</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."บันทึกแบบสำรวจนักเรียนที่มีความสามารถประจำปีการศึกษา".$data_yaer." เรียบร้อยแล้ว IP:".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
	}
?>				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php		}else{ ?>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>บันทึกแบบสำรวจ ไม่สำเร็จ</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php		}?>			
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->			
	<?php	break;
			default: ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>เกิดข้อผิดพลาด ไม่สามารถดำเนินการได้</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->			
	<?php	}        ?>
<!--################################################################################################-->					
		<?php	break;
				default:    ?>
<!--################################################################################################-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>เกิดข้อผิดพลาด ไม่สามารถดำเนินการได้</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--################################################################################################-->					
		<?php	}           ?>		
<!--================================================================================================-->		
<?php	}elseif($data_stu->IDLevel>=11 and $data_stu->IDLevel<=13){ ?>
<!--================================================================================================-->	
		<?php
			switch($level1113){
				case "OFF": ?>
<!--################################################################################################-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger alert-styled-left">
			สิ้นสุดระยะเวลา สำรวจนักเรียนที่มีความสามารถพิเศษ พบข้อสงสัย กรุณาติดผ่ายงาน แนวแนะประถม / มัธยม ในเวลา 08.00 - 17.00 น. วันจันทร์ ถึง วันศุกร์
		</div>
	</div>
</div>				
<!--################################################################################################-->				
		<?php	break;
				case "ON":  ?>
<!--################################################################################################-->	
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<h6 class="content-group text-semibold">
			แบบสำรวจนักเรียนที่มีความสามารถพิเศษ ระดับชั้น ประถมศึกษาตอนต้น
			<small class="display-block">
			ประจำปีการศึกษา <?php echo $data_yaer;?> (สำหรับผู้ปกครอง)
			</small>
		</h6>
	</div>
</div>		
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->		
	<?php
		$ButTalent=filter_input(INPUT_POST,'ButTalent');
		switch($ButTalent){
			case "ButTalentY": ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->	
	<?php
		$CallIntoJoinTheEvent=new IntoJoinTheEvent($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$ButTalent);
			if($CallIntoJoinTheEvent->RunIntoJoinTheEvent()=="Yes"){
				
//รายการวิชาการ
				if(isset($_POST["academic"])){
					$NumAcademic=count($_POST["academic"]);
					$CountAcademic=0;
						while($CountAcademic<$NumAcademic){
							$Academic=$_POST["academic"][$CountAcademic];
								if($Academic!=null or $Academic!=""){
									$CountAcademic=$CountAcademic+1;
									$CallIntoTalentAttention=new IntoTalentAttention($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$CountAcademic,$Academic);
										if($CallIntoTalentAttention->RunIntoTalentAttention()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------								
										}else{
											break;
										}								
								}else{
//---------------------------------------------------------------------------------------------------------------------------								
								}
						}					
					}else{
//---------------------------------------------------------------------------------------------------------------------------					
					}
//รายการวิชาการ  จบ				
//เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล
//ด้านวิชาการ
					if(isset($_POST["AcademicTxt"])){
						$NumAcademicTxt=count($_POST["AcademicTxt"]);
						$CountAcademicTxt=0;
							while($CountAcademicTxt<$NumAcademicTxt){
								$AcademicTxt=$_POST["AcademicTxt"][$CountAcademicTxt];
								$CountAcademicTxt=$CountAcademicTxt+1;
									if($AcademicTxt!=null or $AcademicTxt!=""){
										$CallIntoAcademicTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"1",$CountAcademicTxt,$AcademicTxt);
											if($CallIntoAcademicTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------																
											}else{
												break;
											}										
									}else{
//---------------------------------------------------------------------------------------------------------------------------									
									}								
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}

//ด้านวิชาการ จบ
//ด้านกีฬา		
					if(isset($_POST["SportTxt"])){
						$NumSportTxt=count($_POST["SportTxt"]);
						$CountSportTxt=0;
							while($CountSportTxt<$NumSportTxt){
								$SportTxt=$_POST["SportTxt"][$CountSportTxt];
								$CountSportTxt=$CountSportTxt+1;
									if($SportTxt!=null or $SportTxt!=""){
										$CallIntoSportTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"2",$CountSportTxt,$SportTxt);
											if($CallIntoSportTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------											
											}else{
												break;
											}
									}else{
//---------------------------------------------------------------------------------------------------------------------------									
									}
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}

//ด้านกีฬา จบ
//ด้านดนตรี
					if(isset($_POST["MusicTxt"])){
						$NumMusicTxt=count($_POST["MusicTxt"]);
						$CountMusicTxt=0;
							while($CountMusicTxt<$NumMusicTxt){
								$MusicTxt=$_POST["MusicTxt"][$CountMusicTxt];
								$CountMusicTxt=$CountMusicTxt+1;
									if($MusicTxt!=null or $MusicTxt!=""){
										$CallIntoMusicTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"3",$CountMusicTxt,$MusicTxt);
											if($CallIntoMusicTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------											
											}else{
												break;
											}
									}else{
//---------------------------------------------------------------------------------------------------------------------------									
									}
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}
//ด้านดนตรี จบ
//ด้านศิลปะและการแสดง
					if(isset($_POST["AAPTxt"])){
						$NumAAPTxt=count($_POST["AAPTxt"]);
						$CountAAPTxt=0;
							while($CountAAPTxt<$NumAAPTxt){
								$AAPTxt=$_POST["AAPTxt"][$CountAAPTxt];
								$CountAAPTxt=$CountAAPTxt+1;
									if($AAPTxt!=null or $AAPTxt!=""){
										$CallIntoAAPTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"4",$CountAAPTxt,$AAPTxt);
											if($CallIntoAAPTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------												
											}else{
												break;
											}
									}else{
//---------------------------------------------------------------------------------------------------------------------------										
									}
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}
//ด้านศิลปะและการแสดง จบ
//ด้านอื่นๆ
					if(isset($_POST["OtherTxt"])){
						$NumOtherTxt=count($_POST["OtherTxt"]);
						$CountOtherTxt=0;
							while($CountOtherTxt<$NumOtherTxt){
								$OtherTxt=$_POST["OtherTxt"][$CountOtherTxt];
								$CountOtherTxt=$CountOtherTxt+1;
									if($OtherTxt!=null or $OtherTxt!=""){
										$CallIntoOtherTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"5",$CountOtherTxt,$OtherTxt);
											if($CallIntoOtherTxt->RunIntoActivityMatch()=="Yes"){
//--------------------------------------------------------------------------------------------------													
											}else{
												break;
											}
									}else{
//--------------------------------------------------------------------------------------------------											
									}
							}						
					}else{
//--------------------------------------------------------------------------------------------------						
					}
//ด้านอื่นๆ จบ

//เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล จบ

//ระดับผลงาน / รางวัลที่เคยได้รับ				
//ด้านวิชาการ	
				if(isset($_POST["PortfolioAcademic"])){
					$NumPortfolioAcademic=count($_POST["PortfolioAcademic"]);
					$CountPortfolioAcademic=0;
						while($CountPortfolioAcademic<$NumPortfolioAcademic){
							$PortfolioAcademicTxt=$_POST["PortfolioAcademic"][$CountPortfolioAcademic];
								if($PortfolioAcademicTxt!=null or $PortfolioAcademicTxt!=""){
									$CountPortfolioAcademic=$CountPortfolioAcademic+1;
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioAcademic=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioAcademicTxt,"1");
										if($IntoPortfolioAcademic->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------								
								}
						}					
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านวิชาการ จบ				
//ด้านกีฬา
				if(isset($_POST["PortfolioSport"])){
					$NumPortfolioSport=count($_POST["PortfolioSport"]);
					$CountPortfolioSport=0;
					while($CountPortfolioSport<$NumPortfolioSport){
						$PortfolioSportTxt=$_POST["PortfolioSport"][$CountPortfolioSport];
							if($PortfolioSportTxt!=null or $PortfolioSportTxt!=""){
								$CountPortfolioSport=$CountPortfolioSport+1;
//--------------------------------------------------------------------------------------------------			
								$IntoPortfolioSport=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioSportTxt,"2");
									if($IntoPortfolioSport->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
									}else{
										break;
									}
//--------------------------------------------------------------------------------------------------								
							}else{
//--------------------------------------------------------------------------------------------------								
							}
					}					
				}else{
//--------------------------------------------------------------------------------------------------					
				}
//ด้านกีฬา จบ
//ด้านดนตรี
				if(isset($_POST["PortfolioMusic"])){
					$NumPortfolioMusic=count($_POST["PortfolioMusic"]);
					$CountPortfolioMusic=0;
						while($CountPortfolioMusic<$NumPortfolioMusic){
							$PortfolioMusicTxt=$_POST["PortfolioMusic"][$CountPortfolioMusic];
								if($PortfolioMusicTxt!=null or $PortfolioMusicTxt!=""){
									$CountPortfolioMusic=$CountPortfolioMusic+1;
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioMusic=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioMusicTxt,"3");
										if($IntoPortfolioMusic->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------								
								}
						}
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านดนตรี จบ
//ด้านศิลปะและการแสดง
				if(isset($_POST["PortfolioAAP"])){
					$NumPortfolioAAP=count($_POST["PortfolioAAP"]);
					$CountPortfolioAAP=0;
						while($CountPortfolioAAP<$NumPortfolioAAP){
							$PortfolioAAPTxt=$_POST["PortfolioAAP"][$CountPortfolioAAP];
								if($PortfolioAAPTxt!=null or $PortfolioAAPTxt!=""){
									$CountPortfolioAAP=$CountPortfolioAAP+1;
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioAAP=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioAAPTxt,"4");
										if($IntoPortfolioAAP->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------							
								}
						}					
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านศิลปะและการแสดง จบ
//ด้านอื่นๆ
				if(isset($_POST["PortfolioOther"])){
					$NumPortfolioOther=count($_POST["PortfolioOther"]);
					$CountPortfolioOther=0;
						while($CountPortfolioOther<$NumPortfolioOther){
							$PortfolioOtherTxt=$_POST["PortfolioOther"][$CountPortfolioOther];
								if($PortfolioOtherTxt!=null or $PortfolioOtherTxt!=""){
									$CountPortfolioOther=$CountPortfolioOther+1; 
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioOther=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioOtherTxt,"5");
										if($IntoPortfolioOther->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------								
								}
						}					
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านอื่นๆ จบ
//ระดับผลงาน / รางวัลที่เคยได้รับ จบ						
				
//ความสนใจหรือกิจกรรมที่ประสงค์อยากให้ทางโรงเรียนส่งเสริมหรือจัดกิจกรรม
					if(isset($_POST["ra_txt"])){
						$RaTxtCount=count($_POST["ra_txt"]);
						$CountRaTxt=0;
							while($CountRaTxt<$RaTxtCount){
								$AttentionTxt=$_POST["ra_txt"][$CountRaTxt];
									if($AttentionTxt!=null or $AttentionTxt!=""){
										$CountRaTxt=$CountRaTxt+1;
										$CallIntoJoinAttention=new IntoJoinAttention($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$CountRaTxt,$AttentionTxt);
										$SystemIntoJoinAttention=$CallIntoJoinAttention->RunIntoJoinAttention();
											if($SystemIntoJoinAttention=="Yes"){
//-----------------------------------------------------------------------------------------------------										
											}else{
												break;
											}
									}else{
//-----------------------------------------------------------------------------------------------------								
									}
							}
					}else{
//-----------------------------------------------------------------------------------------------------					
					}
//ความสนใจหรือกิจกรรมที่ประสงค์อยากให้ทางโรงเรียนส่งเสริมหรือจัดกิจกรรม จบ		?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>บันทึกแบบสำรวจ สำเร็จ</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."บันทึกแบบสำรวจนักเรียนที่มีความสามารถประจำปีการศึกษา".$data_yaer." เรียบร้อยแล้ว IP:".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
	}
?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php				
			}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>บันทึกแบบสำรวจ ไม่สำเร็จ</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php	}?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->			
	<?php	break;
			case "ButTalentN": ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->	
	<?php
		$CallIntoJoinTheEvent=new IntoJoinTheEvent($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$ButTalent);
			if($CallIntoJoinTheEvent->RunIntoJoinTheEvent()=="Yes"){
				if(isset($_POST["ra_txt"])){
					$RaTxtCount=count($_POST["ra_txt"]);
					$CountRaTxt=0;
						while($CountRaTxt<$RaTxtCount){
							$AttentionTxt=$_POST["ra_txt"][$CountRaTxt];
								if($AttentionTxt!=null or $AttentionTxt!=""){
									$CountRaTxt=$CountRaTxt+1;
									$CallIntoJoinAttention=new IntoJoinAttention($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$CountRaTxt,$AttentionTxt);
									$SystemIntoJoinAttention=$CallIntoJoinAttention->RunIntoJoinAttention();
										if($SystemIntoJoinAttention=="Yes"){
//-----------------------------------------------------------------------------------------------------										
										}else{
											break;
										}
								}else{
//-----------------------------------------------------------------------------------------------------								
								}
						}
				}else{
//-----------------------------------------------------------------------------------------------------					
				} ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>บันทึกแบบสำรวจ สำเร็จ</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."บันทึกแบบสำรวจนักเรียนที่มีความสามารถประจำปีการศึกษา".$data_yaer." เรียบร้อยแล้ว IP:".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
	}
?>				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php		}else{ ?>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>บันทึกแบบสำรวจ ไม่สำเร็จ</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php		}?>			
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->			
	<?php	break;
			default: ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>เกิดข้อผิดพลาด ไม่สามารถดำเนินการได้</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->			
	<?php	}        ?>
<!--################################################################################################-->					
		<?php	break;
				default:    ?>
<!--################################################################################################-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>เกิดข้อผิดพลาด ไม่สามารถดำเนินการได้</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--################################################################################################-->					
		<?php	}           ?>
<!--================================================================================================-->		
<?php	}elseif($data_stu->IDLevel>=21 and $data_stu->IDLevel<=23){ ?>
<!--================================================================================================-->	
		<?php
			switch($level2123){
				case "OFF": ?>
<!--################################################################################################-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger alert-styled-left">
			สิ้นสุดระยะเวลา สำรวจนักเรียนที่มีความสามารถพิเศษ พบข้อสงสัย กรุณาติดผ่ายงาน แนวแนะประถม / มัธยม ในเวลา 08.00 - 17.00 น. วันจันทร์ ถึง วันศุกร์
		</div>
	</div>
</div>				
<!--################################################################################################-->				
		<?php	break;
				case "ON":  ?>
<!--################################################################################################-->	
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<h6 class="content-group text-semibold">
			แบบสำรวจนักเรียนที่มีความสามารถพิเศษ ระดับชั้น ประถมศึกษาตอนปลาย
			<small class="display-block">
			ประจำปีการศึกษา <?php echo $data_yaer;?> (สำหรับผู้ปกครอง)
			</small>
		</h6>
	</div>
</div>		
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->		
	<?php
		$ButTalent=filter_input(INPUT_POST,'ButTalent');
		switch($ButTalent){
			case "ButTalentY": ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->	
	<?php
		$CallIntoJoinTheEvent=new IntoJoinTheEvent($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$ButTalent);
			if($CallIntoJoinTheEvent->RunIntoJoinTheEvent()=="Yes"){
				
//รายการวิชาการ
				if(isset($_POST["academic"])){
					$NumAcademic=count($_POST["academic"]);
					$CountAcademic=0;
						while($CountAcademic<$NumAcademic){
							$Academic=$_POST["academic"][$CountAcademic];
								if($Academic!=null or $Academic!=""){
									$CountAcademic=$CountAcademic+1;
									$CallIntoTalentAttention=new IntoTalentAttention($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$CountAcademic,$Academic);
										if($CallIntoTalentAttention->RunIntoTalentAttention()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------								
										}else{
											break;
										}								
								}else{
//---------------------------------------------------------------------------------------------------------------------------								
								}
						}					
					}else{
//---------------------------------------------------------------------------------------------------------------------------					
					}
//รายการวิชาการ  จบ				
//เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล
//ด้านวิชาการ
					if(isset($_POST["AcademicTxt"])){
						$NumAcademicTxt=count($_POST["AcademicTxt"]);
						$CountAcademicTxt=0;
							while($CountAcademicTxt<$NumAcademicTxt){
								$AcademicTxt=$_POST["AcademicTxt"][$CountAcademicTxt];
								$CountAcademicTxt=$CountAcademicTxt+1;
									if($AcademicTxt!=null or $AcademicTxt!=""){
										$CallIntoAcademicTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"1",$CountAcademicTxt,$AcademicTxt);
											if($CallIntoAcademicTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------																
											}else{
												break;
											}										
									}else{
//---------------------------------------------------------------------------------------------------------------------------									
									}								
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}

//ด้านวิชาการ จบ
//ด้านกีฬา		
					if(isset($_POST["SportTxt"])){
						$NumSportTxt=count($_POST["SportTxt"]);
						$CountSportTxt=0;
							while($CountSportTxt<$NumSportTxt){
								$SportTxt=$_POST["SportTxt"][$CountSportTxt];
								$CountSportTxt=$CountSportTxt+1;
									if($SportTxt!=null or $SportTxt!=""){
										$CallIntoSportTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"2",$CountSportTxt,$SportTxt);
											if($CallIntoSportTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------											
											}else{
												break;
											}
									}else{
//---------------------------------------------------------------------------------------------------------------------------									
									}
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}

//ด้านกีฬา จบ
//ด้านดนตรี
					if(isset($_POST["MusicTxt"])){
						$NumMusicTxt=count($_POST["MusicTxt"]);
						$CountMusicTxt=0;
							while($CountMusicTxt<$NumMusicTxt){
								$MusicTxt=$_POST["MusicTxt"][$CountMusicTxt];
								$CountMusicTxt=$CountMusicTxt+1;
									if($MusicTxt!=null or $MusicTxt!=""){
										$CallIntoMusicTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"3",$CountMusicTxt,$MusicTxt);
											if($CallIntoMusicTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------											
											}else{
												break;
											}
									}else{
//---------------------------------------------------------------------------------------------------------------------------									
									}
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}
//ด้านดนตรี จบ
//ด้านศิลปะและการแสดง
					if(isset($_POST["AAPTxt"])){
						$NumAAPTxt=count($_POST["AAPTxt"]);
						$CountAAPTxt=0;
							while($CountAAPTxt<$NumAAPTxt){
								$AAPTxt=$_POST["AAPTxt"][$CountAAPTxt];
								$CountAAPTxt=$CountAAPTxt+1;
									if($AAPTxt!=null or $AAPTxt!=""){
										$CallIntoAAPTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"4",$CountAAPTxt,$AAPTxt);
											if($CallIntoAAPTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------												
											}else{
												break;
											}
									}else{
//---------------------------------------------------------------------------------------------------------------------------										
									}
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}
//ด้านศิลปะและการแสดง จบ
//ด้านอื่นๆ
					if(isset($_POST["OtherTxt"])){
						$NumOtherTxt=count($_POST["OtherTxt"]);
						$CountOtherTxt=0;
							while($CountOtherTxt<$NumOtherTxt){
								$OtherTxt=$_POST["OtherTxt"][$CountOtherTxt];
								$CountOtherTxt=$CountOtherTxt+1;
									if($OtherTxt!=null or $OtherTxt!=""){
										$CallIntoOtherTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"5",$CountOtherTxt,$OtherTxt);
											if($CallIntoOtherTxt->RunIntoActivityMatch()=="Yes"){
//--------------------------------------------------------------------------------------------------													
											}else{
												break;
											}
									}else{
//--------------------------------------------------------------------------------------------------											
									}
							}						
					}else{
//--------------------------------------------------------------------------------------------------						
					}
//ด้านอื่นๆ จบ

//เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล จบ

//ระดับผลงาน / รางวัลที่เคยได้รับ				
//ด้านวิชาการ	
				if(isset($_POST["PortfolioAcademic"])){
					$NumPortfolioAcademic=count($_POST["PortfolioAcademic"]);
					$CountPortfolioAcademic=0;
						while($CountPortfolioAcademic<$NumPortfolioAcademic){
							$PortfolioAcademicTxt=$_POST["PortfolioAcademic"][$CountPortfolioAcademic];
								if($PortfolioAcademicTxt!=null or $PortfolioAcademicTxt!=""){
									$CountPortfolioAcademic=$CountPortfolioAcademic+1;
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioAcademic=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioAcademicTxt,"1");
										if($IntoPortfolioAcademic->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------								
								}
						}					
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านวิชาการ จบ				
//ด้านกีฬา
				if(isset($_POST["PortfolioSport"])){
					$NumPortfolioSport=count($_POST["PortfolioSport"]);
					$CountPortfolioSport=0;
					while($CountPortfolioSport<$NumPortfolioSport){
						$PortfolioSportTxt=$_POST["PortfolioSport"][$CountPortfolioSport];
							if($PortfolioSportTxt!=null or $PortfolioSportTxt!=""){
								$CountPortfolioSport=$CountPortfolioSport+1;
//--------------------------------------------------------------------------------------------------			
								$IntoPortfolioSport=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioSportTxt,"2");
									if($IntoPortfolioSport->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
									}else{
										break;
									}
//--------------------------------------------------------------------------------------------------								
							}else{
//--------------------------------------------------------------------------------------------------								
							}
					}					
				}else{
//--------------------------------------------------------------------------------------------------					
				}
//ด้านกีฬา จบ
//ด้านดนตรี
				if(isset($_POST["PortfolioMusic"])){
					$NumPortfolioMusic=count($_POST["PortfolioMusic"]);
					$CountPortfolioMusic=0;
						while($CountPortfolioMusic<$NumPortfolioMusic){
							$PortfolioMusicTxt=$_POST["PortfolioMusic"][$CountPortfolioMusic];
								if($PortfolioMusicTxt!=null or $PortfolioMusicTxt!=""){
									$CountPortfolioMusic=$CountPortfolioMusic+1;
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioMusic=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioMusicTxt,"3");
										if($IntoPortfolioMusic->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------								
								}
						}
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านดนตรี จบ
//ด้านศิลปะและการแสดง
				if(isset($_POST["PortfolioAAP"])){
					$NumPortfolioAAP=count($_POST["PortfolioAAP"]);
					$CountPortfolioAAP=0;
						while($CountPortfolioAAP<$NumPortfolioAAP){
							$PortfolioAAPTxt=$_POST["PortfolioAAP"][$CountPortfolioAAP];
								if($PortfolioAAPTxt!=null or $PortfolioAAPTxt!=""){
									$CountPortfolioAAP=$CountPortfolioAAP+1;
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioAAP=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioAAPTxt,"4");
										if($IntoPortfolioAAP->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------							
								}
						}					
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านศิลปะและการแสดง จบ
//ด้านอื่นๆ
				if(isset($_POST["PortfolioOther"])){
					$NumPortfolioOther=count($_POST["PortfolioOther"]);
					$CountPortfolioOther=0;
						while($CountPortfolioOther<$NumPortfolioOther){
							$PortfolioOtherTxt=$_POST["PortfolioOther"][$CountPortfolioOther];
								if($PortfolioOtherTxt!=null or $PortfolioOtherTxt!=""){
									$CountPortfolioOther=$CountPortfolioOther+1; 
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioOther=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioOtherTxt,"5");
										if($IntoPortfolioOther->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------								
								}
						}					
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านอื่นๆ จบ
//ระดับผลงาน / รางวัลที่เคยได้รับ จบ						
				
//ความสนใจหรือกิจกรรมที่ประสงค์อยากให้ทางโรงเรียนส่งเสริมหรือจัดกิจกรรม
					if(isset($_POST["ra_txt"])){
						$RaTxtCount=count($_POST["ra_txt"]);
						$CountRaTxt=0;
							while($CountRaTxt<$RaTxtCount){
								$AttentionTxt=$_POST["ra_txt"][$CountRaTxt];
									if($AttentionTxt!=null or $AttentionTxt!=""){
										$CountRaTxt=$CountRaTxt+1;
										$CallIntoJoinAttention=new IntoJoinAttention($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$CountRaTxt,$AttentionTxt);
										$SystemIntoJoinAttention=$CallIntoJoinAttention->RunIntoJoinAttention();
											if($SystemIntoJoinAttention=="Yes"){
//-----------------------------------------------------------------------------------------------------										
											}else{
												break;
											}
									}else{
//-----------------------------------------------------------------------------------------------------								
									}
							}
					}else{
//-----------------------------------------------------------------------------------------------------					
					}
//ความสนใจหรือกิจกรรมที่ประสงค์อยากให้ทางโรงเรียนส่งเสริมหรือจัดกิจกรรม จบ		?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>บันทึกแบบสำรวจ สำเร็จ</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."บันทึกแบบสำรวจนักเรียนที่มีความสามารถประจำปีการศึกษา".$data_yaer." เรียบร้อยแล้ว IP:".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
	}
?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php				
			}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>บันทึกแบบสำรวจ ไม่สำเร็จ</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php	}?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->			
	<?php	break;
			case "ButTalentN": ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->	
	<?php
		$CallIntoJoinTheEvent=new IntoJoinTheEvent($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$ButTalent);
			if($CallIntoJoinTheEvent->RunIntoJoinTheEvent()=="Yes"){
				if(isset($_POST["ra_txt"])){
					$RaTxtCount=count($_POST["ra_txt"]);
					$CountRaTxt=0;
						while($CountRaTxt<$RaTxtCount){
							$AttentionTxt=$_POST["ra_txt"][$CountRaTxt];
								if($AttentionTxt!=null or $AttentionTxt!=""){
									$CountRaTxt=$CountRaTxt+1;
									$CallIntoJoinAttention=new IntoJoinAttention($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$CountRaTxt,$AttentionTxt);
									$SystemIntoJoinAttention=$CallIntoJoinAttention->RunIntoJoinAttention();
										if($SystemIntoJoinAttention=="Yes"){
//-----------------------------------------------------------------------------------------------------										
										}else{
											break;
										}
								}else{
//-----------------------------------------------------------------------------------------------------								
								}
						}
				}else{
//-----------------------------------------------------------------------------------------------------					
				} ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>บันทึกแบบสำรวจ สำเร็จ</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."บันทึกแบบสำรวจนักเรียนที่มีความสามารถประจำปีการศึกษา".$data_yaer." เรียบร้อยแล้ว IP:".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
	}
?>				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php		}else{ ?>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>บันทึกแบบสำรวจ ไม่สำเร็จ</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php		}?>			
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->			
	<?php	break;
			default: ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>เกิดข้อผิดพลาด ไม่สามารถดำเนินการได้</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->			
	<?php	}        ?>
<!--################################################################################################-->					
		<?php	break;
				default:    ?>
<!--################################################################################################-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>เกิดข้อผิดพลาด ไม่สามารถดำเนินการได้</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--################################################################################################-->					
		<?php	}           ?>		
<!--================================================================================================-->		
<?php	}elseif($data_stu->IDLevel>=31 and $data_stu->IDLevel<=33){ ?>
<!--================================================================================================-->	
		<?php
			switch($level3133){
				case "OFF": ?>
<!--################################################################################################-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger alert-styled-left">
			สิ้นสุดระยะเวลา สำรวจนักเรียนที่มีความสามารถพิเศษ พบข้อสงสัย กรุณาติดผ่ายงาน แนวแนะประถม / มัธยม ในเวลา 08.00 - 17.00 น. วันจันทร์ ถึง วันศุกร์
		</div>
	</div>
</div>				
<!--################################################################################################-->				
		<?php	break;
				case "ON":  ?>
<!--################################################################################################-->	
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<h6 class="content-group text-semibold">
			แบบสำรวจนักเรียนที่มีความสามารถพิเศษ ระดับชั้น มัธยมศึกษาตอนต้น
			<small class="display-block">
			ประจำปีการศึกษา <?php echo $data_yaer;?> (สำหรับผู้ปกครอง)
			</small>
		</h6>
	</div>
</div>		
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->		
	<?php
		$ButTalent=filter_input(INPUT_POST,'ButTalent');
		switch($ButTalent){
			case "ButTalentY": ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->	
	<?php
		$CallIntoJoinTheEvent=new IntoJoinTheEvent($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$ButTalent);
			if($CallIntoJoinTheEvent->RunIntoJoinTheEvent()=="Yes"){
				
//รายการวิชาการ
				if(isset($_POST["academic"])){
					$NumAcademic=count($_POST["academic"]);
					$CountAcademic=0;
						while($CountAcademic<$NumAcademic){
							$Academic=$_POST["academic"][$CountAcademic];
								if($Academic!=null or $Academic!=""){
									$CountAcademic=$CountAcademic+1;
									$CallIntoTalentAttention=new IntoTalentAttention($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$CountAcademic,$Academic);
										if($CallIntoTalentAttention->RunIntoTalentAttention()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------								
										}else{
											break;
										}								
								}else{
//---------------------------------------------------------------------------------------------------------------------------								
								}
						}					
					}else{
//---------------------------------------------------------------------------------------------------------------------------					
					}
//รายการวิชาการ  จบ				
//เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล
//ด้านวิชาการ
					if(isset($_POST["AcademicTxt"])){
						$NumAcademicTxt=count($_POST["AcademicTxt"]);
						$CountAcademicTxt=0;
							while($CountAcademicTxt<$NumAcademicTxt){
								$AcademicTxt=$_POST["AcademicTxt"][$CountAcademicTxt];
								$CountAcademicTxt=$CountAcademicTxt+1;
									if($AcademicTxt!=null or $AcademicTxt!=""){
										$CallIntoAcademicTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"1",$CountAcademicTxt,$AcademicTxt);
											if($CallIntoAcademicTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------																
											}else{
												break;
											}										
									}else{
//---------------------------------------------------------------------------------------------------------------------------									
									}								
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}

//ด้านวิชาการ จบ
//ด้านกีฬา		
					if(isset($_POST["SportTxt"])){
						$NumSportTxt=count($_POST["SportTxt"]);
						$CountSportTxt=0;
							while($CountSportTxt<$NumSportTxt){
								$SportTxt=$_POST["SportTxt"][$CountSportTxt];
								$CountSportTxt=$CountSportTxt+1;
									if($SportTxt!=null or $SportTxt!=""){
										$CallIntoSportTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"2",$CountSportTxt,$SportTxt);
											if($CallIntoSportTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------											
											}else{
												break;
											}
									}else{
//---------------------------------------------------------------------------------------------------------------------------									
									}
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}

//ด้านกีฬา จบ
//ด้านดนตรี
					if(isset($_POST["MusicTxt"])){
						$NumMusicTxt=count($_POST["MusicTxt"]);
						$CountMusicTxt=0;
							while($CountMusicTxt<$NumMusicTxt){
								$MusicTxt=$_POST["MusicTxt"][$CountMusicTxt];
								$CountMusicTxt=$CountMusicTxt+1;
									if($MusicTxt!=null or $MusicTxt!=""){
										$CallIntoMusicTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"3",$CountMusicTxt,$MusicTxt);
											if($CallIntoMusicTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------											
											}else{
												break;
											}
									}else{
//---------------------------------------------------------------------------------------------------------------------------									
									}
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}
//ด้านดนตรี จบ
//ด้านศิลปะและการแสดง
					if(isset($_POST["AAPTxt"])){
						$NumAAPTxt=count($_POST["AAPTxt"]);
						$CountAAPTxt=0;
							while($CountAAPTxt<$NumAAPTxt){
								$AAPTxt=$_POST["AAPTxt"][$CountAAPTxt];
								$CountAAPTxt=$CountAAPTxt+1;
									if($AAPTxt!=null or $AAPTxt!=""){
										$CallIntoAAPTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"4",$CountAAPTxt,$AAPTxt);
											if($CallIntoAAPTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------												
											}else{
												break;
											}
									}else{
//---------------------------------------------------------------------------------------------------------------------------										
									}
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}
//ด้านศิลปะและการแสดง จบ
//ด้านอื่นๆ
					if(isset($_POST["OtherTxt"])){
						$NumOtherTxt=count($_POST["OtherTxt"]);
						$CountOtherTxt=0;
							while($CountOtherTxt<$NumOtherTxt){
								$OtherTxt=$_POST["OtherTxt"][$CountOtherTxt];
								$CountOtherTxt=$CountOtherTxt+1;
									if($OtherTxt!=null or $OtherTxt!=""){
										$CallIntoOtherTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"5",$CountOtherTxt,$OtherTxt);
											if($CallIntoOtherTxt->RunIntoActivityMatch()=="Yes"){
//--------------------------------------------------------------------------------------------------													
											}else{
												break;
											}
									}else{
//--------------------------------------------------------------------------------------------------											
									}
							}						
					}else{
//--------------------------------------------------------------------------------------------------						
					}
//ด้านอื่นๆ จบ

//เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล จบ

//ระดับผลงาน / รางวัลที่เคยได้รับ				
//ด้านวิชาการ	
				if(isset($_POST["PortfolioAcademic"])){
					$NumPortfolioAcademic=count($_POST["PortfolioAcademic"]);
					$CountPortfolioAcademic=0;
						while($CountPortfolioAcademic<$NumPortfolioAcademic){
							$PortfolioAcademicTxt=$_POST["PortfolioAcademic"][$CountPortfolioAcademic];
								if($PortfolioAcademicTxt!=null or $PortfolioAcademicTxt!=""){
									$CountPortfolioAcademic=$CountPortfolioAcademic+1;
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioAcademic=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioAcademicTxt,"1");
										if($IntoPortfolioAcademic->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------								
								}
						}					
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านวิชาการ จบ				
//ด้านกีฬา
				if(isset($_POST["PortfolioSport"])){
					$NumPortfolioSport=count($_POST["PortfolioSport"]);
					$CountPortfolioSport=0;
					while($CountPortfolioSport<$NumPortfolioSport){
						$PortfolioSportTxt=$_POST["PortfolioSport"][$CountPortfolioSport];
							if($PortfolioSportTxt!=null or $PortfolioSportTxt!=""){
								$CountPortfolioSport=$CountPortfolioSport+1;
//--------------------------------------------------------------------------------------------------			
								$IntoPortfolioSport=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioSportTxt,"2");
									if($IntoPortfolioSport->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
									}else{
										break;
									}
//--------------------------------------------------------------------------------------------------								
							}else{
//--------------------------------------------------------------------------------------------------								
							}
					}					
				}else{
//--------------------------------------------------------------------------------------------------					
				}
//ด้านกีฬา จบ
//ด้านดนตรี
				if(isset($_POST["PortfolioMusic"])){
					$NumPortfolioMusic=count($_POST["PortfolioMusic"]);
					$CountPortfolioMusic=0;
						while($CountPortfolioMusic<$NumPortfolioMusic){
							$PortfolioMusicTxt=$_POST["PortfolioMusic"][$CountPortfolioMusic];
								if($PortfolioMusicTxt!=null or $PortfolioMusicTxt!=""){
									$CountPortfolioMusic=$CountPortfolioMusic+1;
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioMusic=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioMusicTxt,"3");
										if($IntoPortfolioMusic->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------								
								}
						}
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านดนตรี จบ
//ด้านศิลปะและการแสดง
				if(isset($_POST["PortfolioAAP"])){
					$NumPortfolioAAP=count($_POST["PortfolioAAP"]);
					$CountPortfolioAAP=0;
						while($CountPortfolioAAP<$NumPortfolioAAP){
							$PortfolioAAPTxt=$_POST["PortfolioAAP"][$CountPortfolioAAP];
								if($PortfolioAAPTxt!=null or $PortfolioAAPTxt!=""){
									$CountPortfolioAAP=$CountPortfolioAAP+1;
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioAAP=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioAAPTxt,"4");
										if($IntoPortfolioAAP->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------							
								}
						}					
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านศิลปะและการแสดง จบ
//ด้านอื่นๆ
				if(isset($_POST["PortfolioOther"])){
					$NumPortfolioOther=count($_POST["PortfolioOther"]);
					$CountPortfolioOther=0;
						while($CountPortfolioOther<$NumPortfolioOther){
							$PortfolioOtherTxt=$_POST["PortfolioOther"][$CountPortfolioOther];
								if($PortfolioOtherTxt!=null or $PortfolioOtherTxt!=""){
									$CountPortfolioOther=$CountPortfolioOther+1; 
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioOther=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioOtherTxt,"5");
										if($IntoPortfolioOther->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------								
								}
						}					
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านอื่นๆ จบ
//ระดับผลงาน / รางวัลที่เคยได้รับ จบ						
				
//ความสนใจหรือกิจกรรมที่ประสงค์อยากให้ทางโรงเรียนส่งเสริมหรือจัดกิจกรรม
					if(isset($_POST["ra_txt"])){
						$RaTxtCount=count($_POST["ra_txt"]);
						$CountRaTxt=0;
							while($CountRaTxt<$RaTxtCount){
								$AttentionTxt=$_POST["ra_txt"][$CountRaTxt];
									if($AttentionTxt!=null or $AttentionTxt!=""){
										$CountRaTxt=$CountRaTxt+1;
										$CallIntoJoinAttention=new IntoJoinAttention($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$CountRaTxt,$AttentionTxt);
										$SystemIntoJoinAttention=$CallIntoJoinAttention->RunIntoJoinAttention();
											if($SystemIntoJoinAttention=="Yes"){
//-----------------------------------------------------------------------------------------------------										
											}else{
												break;
											}
									}else{
//-----------------------------------------------------------------------------------------------------								
									}
							}
					}else{
//-----------------------------------------------------------------------------------------------------					
					}
//ความสนใจหรือกิจกรรมที่ประสงค์อยากให้ทางโรงเรียนส่งเสริมหรือจัดกิจกรรม จบ		?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>บันทึกแบบสำรวจ สำเร็จ</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."บันทึกแบบสำรวจนักเรียนที่มีความสามารถประจำปีการศึกษา".$data_yaer." เรียบร้อยแล้ว IP:".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
	}
?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php				
			}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>บันทึกแบบสำรวจ ไม่สำเร็จ</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php	}?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->			
	<?php	break;
			case "ButTalentN": ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->	
	<?php
		$CallIntoJoinTheEvent=new IntoJoinTheEvent($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$ButTalent);
			if($CallIntoJoinTheEvent->RunIntoJoinTheEvent()=="Yes"){
				if(isset($_POST["ra_txt"])){
					$RaTxtCount=count($_POST["ra_txt"]);
					$CountRaTxt=0;
						while($CountRaTxt<$RaTxtCount){
							$AttentionTxt=$_POST["ra_txt"][$CountRaTxt];
								if($AttentionTxt!=null or $AttentionTxt!=""){
									$CountRaTxt=$CountRaTxt+1;
									$CallIntoJoinAttention=new IntoJoinAttention($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$CountRaTxt,$AttentionTxt);
									$SystemIntoJoinAttention=$CallIntoJoinAttention->RunIntoJoinAttention();
										if($SystemIntoJoinAttention=="Yes"){
//-----------------------------------------------------------------------------------------------------										
										}else{
											break;
										}
								}else{
//-----------------------------------------------------------------------------------------------------								
								}
						}
				}else{
//-----------------------------------------------------------------------------------------------------					
				} ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>บันทึกแบบสำรวจ สำเร็จ</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."บันทึกแบบสำรวจนักเรียนที่มีความสามารถประจำปีการศึกษา".$data_yaer." เรียบร้อยแล้ว IP:".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
	}
?>				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php		}else{ ?>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>บันทึกแบบสำรวจ ไม่สำเร็จ</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php		}?>			
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->			
	<?php	break;
			default: ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>เกิดข้อผิดพลาด ไม่สามารถดำเนินการได้</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->			
	<?php	}        ?>
<!--################################################################################################-->					
		<?php	break;
				default:    ?>
<!--################################################################################################-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>เกิดข้อผิดพลาด ไม่สามารถดำเนินการได้</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--################################################################################################-->					
		<?php	}           ?>		
<!--================================================================================================-->		
<?php	}elseif($data_stu->IDLevel>=41 and $data_stu->IDLevel<=43){ ?>
<!--================================================================================================-->	
		<?php
			switch($level4143){
				case "OFF": ?>
<!--################################################################################################-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-danger alert-styled-left">
			สิ้นสุดระยะเวลา สำรวจนักเรียนที่มีความสามารถพิเศษ พบข้อสงสัย กรุณาติดผ่ายงาน แนวแนะประถม / มัธยม ในเวลา 08.00 - 17.00 น. วันจันทร์ ถึง วันศุกร์
		</div>
	</div>
</div>				
<!--################################################################################################-->				
		<?php	break;
				case "ON":  ?>
<!--################################################################################################-->	
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<h6 class="content-group text-semibold">
			แบบสำรวจนักเรียนที่มีความสามารถพิเศษ ระดับชั้น มัธยมศึกษาตอนปลาย
			<small class="display-block">
			ประจำปีการศึกษา <?php echo $data_yaer;?> (สำหรับผู้ปกครอง)
			</small>
		</h6>
	</div>
</div>		
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->		
	<?php
		$ButTalent=filter_input(INPUT_POST,'ButTalent');
		switch($ButTalent){
			case "ButTalentY": ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->	
	<?php
		$CallIntoJoinTheEvent=new IntoJoinTheEvent($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$ButTalent);
			if($CallIntoJoinTheEvent->RunIntoJoinTheEvent()=="Yes"){
				
//รายการวิชาการ
				if(isset($_POST["academic"])){
					$NumAcademic=count($_POST["academic"]);
					$CountAcademic=0;
						while($CountAcademic<$NumAcademic){
							$Academic=$_POST["academic"][$CountAcademic];
								if($Academic!=null or $Academic!=""){
									$CountAcademic=$CountAcademic+1;
									$CallIntoTalentAttention=new IntoTalentAttention($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$CountAcademic,$Academic);
										if($CallIntoTalentAttention->RunIntoTalentAttention()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------								
										}else{
											break;
										}								
								}else{
//---------------------------------------------------------------------------------------------------------------------------								
								}
						}					
					}else{
//---------------------------------------------------------------------------------------------------------------------------					
					}
//รายการวิชาการ  จบ				
//เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล
//ด้านวิชาการ
					if(isset($_POST["AcademicTxt"])){
						$NumAcademicTxt=count($_POST["AcademicTxt"]);
						$CountAcademicTxt=0;
							while($CountAcademicTxt<$NumAcademicTxt){
								$AcademicTxt=$_POST["AcademicTxt"][$CountAcademicTxt];
								$CountAcademicTxt=$CountAcademicTxt+1;
									if($AcademicTxt!=null or $AcademicTxt!=""){
										$CallIntoAcademicTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"1",$CountAcademicTxt,$AcademicTxt);
											if($CallIntoAcademicTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------																
											}else{
												break;
											}										
									}else{
//---------------------------------------------------------------------------------------------------------------------------									
									}								
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}

//ด้านวิชาการ จบ
//ด้านกีฬา		
					if(isset($_POST["SportTxt"])){
						$NumSportTxt=count($_POST["SportTxt"]);
						$CountSportTxt=0;
							while($CountSportTxt<$NumSportTxt){
								$SportTxt=$_POST["SportTxt"][$CountSportTxt];
								$CountSportTxt=$CountSportTxt+1;
									if($SportTxt!=null or $SportTxt!=""){
										$CallIntoSportTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"2",$CountSportTxt,$SportTxt);
											if($CallIntoSportTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------											
											}else{
												break;
											}
									}else{
//---------------------------------------------------------------------------------------------------------------------------									
									}
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}

//ด้านกีฬา จบ
//ด้านดนตรี
					if(isset($_POST["MusicTxt"])){
						$NumMusicTxt=count($_POST["MusicTxt"]);
						$CountMusicTxt=0;
							while($CountMusicTxt<$NumMusicTxt){
								$MusicTxt=$_POST["MusicTxt"][$CountMusicTxt];
								$CountMusicTxt=$CountMusicTxt+1;
									if($MusicTxt!=null or $MusicTxt!=""){
										$CallIntoMusicTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"3",$CountMusicTxt,$MusicTxt);
											if($CallIntoMusicTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------											
											}else{
												break;
											}
									}else{
//---------------------------------------------------------------------------------------------------------------------------									
									}
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}
//ด้านดนตรี จบ
//ด้านศิลปะและการแสดง
					if(isset($_POST["AAPTxt"])){
						$NumAAPTxt=count($_POST["AAPTxt"]);
						$CountAAPTxt=0;
							while($CountAAPTxt<$NumAAPTxt){
								$AAPTxt=$_POST["AAPTxt"][$CountAAPTxt];
								$CountAAPTxt=$CountAAPTxt+1;
									if($AAPTxt!=null or $AAPTxt!=""){
										$CallIntoAAPTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"4",$CountAAPTxt,$AAPTxt);
											if($CallIntoAAPTxt->RunIntoActivityMatch()=="Yes"){
//---------------------------------------------------------------------------------------------------------------------------												
											}else{
												break;
											}
									}else{
//---------------------------------------------------------------------------------------------------------------------------										
									}
							}						
					}else{
//---------------------------------------------------------------------------------------------------------------------------						
					}
//ด้านศิลปะและการแสดง จบ
//ด้านอื่นๆ
					if(isset($_POST["OtherTxt"])){
						$NumOtherTxt=count($_POST["OtherTxt"]);
						$CountOtherTxt=0;
							while($CountOtherTxt<$NumOtherTxt){
								$OtherTxt=$_POST["OtherTxt"][$CountOtherTxt];
								$CountOtherTxt=$CountOtherTxt+1;
									if($OtherTxt!=null or $OtherTxt!=""){
										$CallIntoOtherTxt=new IntoActivityMatch($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,"5",$CountOtherTxt,$OtherTxt);
											if($CallIntoOtherTxt->RunIntoActivityMatch()=="Yes"){
//--------------------------------------------------------------------------------------------------													
											}else{
												break;
											}
									}else{
//--------------------------------------------------------------------------------------------------											
									}
							}						
					}else{
//--------------------------------------------------------------------------------------------------						
					}
//ด้านอื่นๆ จบ

//เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล จบ

//ระดับผลงาน / รางวัลที่เคยได้รับ				
//ด้านวิชาการ	
				if(isset($_POST["PortfolioAcademic"])){
					$NumPortfolioAcademic=count($_POST["PortfolioAcademic"]);
					$CountPortfolioAcademic=0;
						while($CountPortfolioAcademic<$NumPortfolioAcademic){
							$PortfolioAcademicTxt=$_POST["PortfolioAcademic"][$CountPortfolioAcademic];
								if($PortfolioAcademicTxt!=null or $PortfolioAcademicTxt!=""){
									$CountPortfolioAcademic=$CountPortfolioAcademic+1;
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioAcademic=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioAcademicTxt,"1");
										if($IntoPortfolioAcademic->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------								
								}
						}					
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านวิชาการ จบ				
//ด้านกีฬา
				if(isset($_POST["PortfolioSport"])){
					$NumPortfolioSport=count($_POST["PortfolioSport"]);
					$CountPortfolioSport=0;
					while($CountPortfolioSport<$NumPortfolioSport){
						$PortfolioSportTxt=$_POST["PortfolioSport"][$CountPortfolioSport];
							if($PortfolioSportTxt!=null or $PortfolioSportTxt!=""){
								$CountPortfolioSport=$CountPortfolioSport+1;
//--------------------------------------------------------------------------------------------------			
								$IntoPortfolioSport=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioSportTxt,"2");
									if($IntoPortfolioSport->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
									}else{
										break;
									}
//--------------------------------------------------------------------------------------------------								
							}else{
//--------------------------------------------------------------------------------------------------								
							}
					}					
				}else{
//--------------------------------------------------------------------------------------------------					
				}
//ด้านกีฬา จบ
//ด้านดนตรี
				if(isset($_POST["PortfolioMusic"])){
					$NumPortfolioMusic=count($_POST["PortfolioMusic"]);
					$CountPortfolioMusic=0;
						while($CountPortfolioMusic<$NumPortfolioMusic){
							$PortfolioMusicTxt=$_POST["PortfolioMusic"][$CountPortfolioMusic];
								if($PortfolioMusicTxt!=null or $PortfolioMusicTxt!=""){
									$CountPortfolioMusic=$CountPortfolioMusic+1;
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioMusic=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioMusicTxt,"3");
										if($IntoPortfolioMusic->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------								
								}
						}
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านดนตรี จบ
//ด้านศิลปะและการแสดง
				if(isset($_POST["PortfolioAAP"])){
					$NumPortfolioAAP=count($_POST["PortfolioAAP"]);
					$CountPortfolioAAP=0;
						while($CountPortfolioAAP<$NumPortfolioAAP){
							$PortfolioAAPTxt=$_POST["PortfolioAAP"][$CountPortfolioAAP];
								if($PortfolioAAPTxt!=null or $PortfolioAAPTxt!=""){
									$CountPortfolioAAP=$CountPortfolioAAP+1;
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioAAP=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioAAPTxt,"4");
										if($IntoPortfolioAAP->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------							
								}
						}					
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านศิลปะและการแสดง จบ
//ด้านอื่นๆ
				if(isset($_POST["PortfolioOther"])){
					$NumPortfolioOther=count($_POST["PortfolioOther"]);
					$CountPortfolioOther=0;
						while($CountPortfolioOther<$NumPortfolioOther){
							$PortfolioOtherTxt=$_POST["PortfolioOther"][$CountPortfolioOther];
								if($PortfolioOtherTxt!=null or $PortfolioOtherTxt!=""){
									$CountPortfolioOther=$CountPortfolioOther+1; 
//--------------------------------------------------------------------------------------------------					
									$IntoPortfolioOther=new IntoPortfolioSave($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$PortfolioOtherTxt,"5");
										if($IntoPortfolioOther->RunIntoPortfolioSave()=="Yes"){
//--------------------------------------------------------------------------------------------------							
										}else{
											break;
										}
//--------------------------------------------------------------------------------------------------								
								}else{
//--------------------------------------------------------------------------------------------------								
								}
						}					
					}else{
//--------------------------------------------------------------------------------------------------					
					}
//ด้านอื่นๆ จบ
//ระดับผลงาน / รางวัลที่เคยได้รับ จบ						
				
//ความสนใจหรือกิจกรรมที่ประสงค์อยากให้ทางโรงเรียนส่งเสริมหรือจัดกิจกรรม
					if(isset($_POST["ra_txt"])){
						$RaTxtCount=count($_POST["ra_txt"]);
						$CountRaTxt=0;
							while($CountRaTxt<$RaTxtCount){
								$AttentionTxt=$_POST["ra_txt"][$CountRaTxt];
									if($AttentionTxt!=null or $AttentionTxt!=""){
										$CountRaTxt=$CountRaTxt+1;
										$CallIntoJoinAttention=new IntoJoinAttention($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$CountRaTxt,$AttentionTxt);
										$SystemIntoJoinAttention=$CallIntoJoinAttention->RunIntoJoinAttention();
											if($SystemIntoJoinAttention=="Yes"){
//-----------------------------------------------------------------------------------------------------										
											}else{
												break;
											}
									}else{
//-----------------------------------------------------------------------------------------------------								
									}
							}
					}else{
//-----------------------------------------------------------------------------------------------------					
					}
//ความสนใจหรือกิจกรรมที่ประสงค์อยากให้ทางโรงเรียนส่งเสริมหรือจัดกิจกรรม จบ		?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>บันทึกแบบสำรวจ สำเร็จ</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."บันทึกแบบสำรวจนักเรียนที่มีความสามารถประจำปีการศึกษา".$data_yaer." เรียบร้อยแล้ว IP:".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
	}
?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php				
			}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>บันทึกแบบสำรวจ ไม่สำเร็จ</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php	}?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->			
	<?php	break;
			case "ButTalentN": ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->	
	<?php
		$CallIntoJoinTheEvent=new IntoJoinTheEvent($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$ButTalent);
			if($CallIntoJoinTheEvent->RunIntoJoinTheEvent()=="Yes"){
				if(isset($_POST["ra_txt"])){
					$RaTxtCount=count($_POST["ra_txt"]);
					$CountRaTxt=0;
						while($CountRaTxt<$RaTxtCount){
							$AttentionTxt=$_POST["ra_txt"][$CountRaTxt];
								if($AttentionTxt!=null or $AttentionTxt!=""){
									$CountRaTxt=$CountRaTxt+1;
									$CallIntoJoinAttention=new IntoJoinAttention($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan,$CountRaTxt,$AttentionTxt);
									$SystemIntoJoinAttention=$CallIntoJoinAttention->RunIntoJoinAttention();
										if($SystemIntoJoinAttention=="Yes"){
//-----------------------------------------------------------------------------------------------------										
										}else{
											break;
										}
								}else{
//-----------------------------------------------------------------------------------------------------								
								}
						}
				}else{
//-----------------------------------------------------------------------------------------------------					
				} ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>บันทึกแบบสำรวจ สำเร็จ</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	if($db_evaluationID=="127.0.0.1"){
		//****************************
	}else{
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
				$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."บันทึกแบบสำรวจนักเรียนที่มีความสามารถประจำปีการศึกษา".$data_yaer." เรียบร้อยแล้ว IP:".$db_evaluationID;

				
				$chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne ); 		
	}
?>				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php		}else{ ?>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>บันทึกแบบสำรวจ ไม่สำเร็จ</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php		}?>			
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->			
	<?php	break;
			default: ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>เกิดข้อผิดพลาด ไม่สามารถดำเนินการได้</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->			
	<?php	}        ?>
<!--################################################################################################-->					
		<?php	break;
				default:    ?>
<!--################################################################################################-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>เกิดข้อผิดพลาด ไม่สามารถดำเนินการได้</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--################################################################################################-->					
		<?php	}           ?>		
<!--================================================================================================-->		
<?php	}else{ ?>
<!--================================================================================================-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>เกิดข้อผิดพลาด ไม่สามารถดำเนินการได้</div>		
			</div>				
		</div>
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<button type="button" id="buttonA" class="btn btn-info">กลับสู่หน้า แบบสำรวจ</button>
				<button type="button" id="buttonB" class="btn btn-warning">กลับสู่เมนูหลัก</button>
			</center>
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--================================================================================================-->		
<?php	}?>
<!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
</div>
<!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->










