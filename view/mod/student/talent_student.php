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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<script>
	$(function() {
		$("#RunLoad").fadeOut(5000, function() {
			$("#RuningLoad").fadeIn(4000);
		});
	});
</script>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
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
<div id="RuningLoad">
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

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
//------------------------------------------------------------------------------

	if($data_stu->IDLevel>=3 and $data_stu->IDLevel<=3){
		switch($level0033){
			case "OFF":
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-danger alert-styled-left">
					สิ้นสุดระยะเวลา สำรวจนักเรียนที่มีความสามารถพิเศษ พบข้อสงสัย กรุณาติดผ่ายงาน แนวแนะประถม / มัธยม ในเวลา 08.00 - 17.00 น. วันจันทร์ ถึง วันศุกร์
				</div>
			</div>
		</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php			
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-			
			break;
			case "ON":
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
<?php 
	$RunCreckJoinTheEvent=new CreckJoinTheEvent($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan);
		if($RunCreckJoinTheEvent->RunCreckJoinTheEvent()=="No"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>แบบสำรวจนักเรียนที่มีความสามารถพิเศษ ประจำปีการศึกษา <?php echo $data_yaer;?> ท่านได้ทำแบบสำรวจเรียบร้อยแล้ว</div>
			</div>		
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}elseif($RunCreckJoinTheEvent->RunCreckJoinTheEvent()=="Yes"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>แบบสำรวจนักเรียนที่มีความสามารถพิเศษ ประจำปีการศึกษา <?php echo $data_yaer;?> ท่านได้ทำแบบสำรวจเรียบร้อยแล้ว</div>
			</div>		
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php   }else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<form name="talent_student" action="./?evaluation_mod=talent_student_code" method="post" >	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-warning">
				<div class="row">
					<div class="col-<?php echo $grid;?>-2">
						<div class="content-group text-semibold">คำชี้แจง</div>
					</div>
					<div class="col-<?php echo $grid;?>-10">
						<div class="content-group text-semibold ">ขอความกรุณาผู้ปกครอง&nbsp;<?php echo $myname;?>&nbsp; ระดับชั้น กรอกความสามารถพิเศษของนักเรียนในความปกครองของท่าน เพื่อทางโรงเรียนจะได้ ส่งเสริมและจัดกิจกรรมสำหรับให้นักเรียน ความสามารถและความสนใจต่อไป</div>
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<div class="content-group text-semibold">
							<center><button type="button" id="ButTalentY" name="ButTalentY"  value="ButTalentY" class="btn btn-primary" class="btn bg-warning-400" data-popup="popover-custom" title="เคยเข้าร่วมกิจกรรม / เคยเข้าร่วมแข่งขัน"  data-placement="bottom" data-container="body">เคยเข้าร่วมกิจกรรม / เคยเข้าร่วมแข่งขัน</button></center>
						</div>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<div class="content-group text-semibold">
							<center><button type="button" id="ButTalentN" name="ButTalentN" value="ButTalentN" class="btn btn-success" class="btn bg-warning-400" data-popup="popover-custom" title="ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน"  data-placement="bottom" data-container="body">ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน</button></center>
						</div>
					</div>
				</div>
			</div>		
		</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<input name="run_date" id="run_date" type="hidden" value="<?php echo $level2123;?>">		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<div id="RunTalent"></div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
</form>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php	}		
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-			
			break;
			default:
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>เกิดข้อผิดพลาดไม่สามารถดำเนินการได้</div>		
			</div>	
		</div>
	</div>
<?php
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-			
		}
	}elseif($data_stu->IDLevel>=11 and $data_stu->IDLevel<=13){
		switch($level1113){
			case "OFF":
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-danger alert-styled-left">
					สิ้นสุดระยะเวลา สำรวจนักเรียนที่มีความสามารถพิเศษ พบข้อสงสัย กรุณาติดผ่ายงาน แนวแนะประถม / มัธยม ในเวลา 08.00 - 17.00 น. วันจันทร์ ถึง วันศุกร์
				</div>
			</div>
		</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php			
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-			
			break;
			case "ON":
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
<?php 
	$RunCreckJoinTheEvent=new CreckJoinTheEvent($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan);
		if($RunCreckJoinTheEvent->RunCreckJoinTheEvent()=="No"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>แบบสำรวจนักเรียนที่มีความสามารถพิเศษ ประจำปีการศึกษา <?php echo $data_yaer;?> ท่านได้ทำแบบสำรวจเรียบร้อยแล้ว</div>
			</div>		
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}elseif($RunCreckJoinTheEvent->RunCreckJoinTheEvent()=="Yes"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>แบบสำรวจนักเรียนที่มีความสามารถพิเศษ ประจำปีการศึกษา <?php echo $data_yaer;?> ท่านได้ทำแบบสำรวจเรียบร้อยแล้ว</div>
			</div>		
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php   }else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<form name="talent_student" action="./?evaluation_mod=talent_student_code" method="post" >	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-warning">
				<div class="row">
					<div class="col-<?php echo $grid;?>-2">
						<div class="content-group text-semibold">คำชี้แจง</div>
					</div>
					<div class="col-<?php echo $grid;?>-10">
						<div class="content-group text-semibold ">ขอความกรุณาผู้ปกครอง&nbsp;<?php echo $myname;?>&nbsp; ระดับชั้น กรอกความสามารถพิเศษของนักเรียนในความปกครองของท่าน เพื่อทางโรงเรียนจะได้ ส่งเสริมและจัดกิจกรรมสำหรับให้นักเรียน ความสามารถและความสนใจต่อไป</div>
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<div class="content-group text-semibold">
							<center><button type="button" id="ButTalentY" name="ButTalentY"  value="ButTalentY" class="btn btn-primary" class="btn bg-warning-400" data-popup="popover-custom" title="เคยเข้าร่วมกิจกรรม / เคยเข้าร่วมแข่งขัน"  data-placement="bottom" data-container="body">เคยเข้าร่วมกิจกรรม / เคยเข้าร่วมแข่งขัน</button></center>
						</div>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<div class="content-group text-semibold">
							<center><button type="button" id="ButTalentN" name="ButTalentN" value="ButTalentN" class="btn btn-success" class="btn bg-warning-400" data-popup="popover-custom" title="ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน"  data-placement="bottom" data-container="body">ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน</button></center>
						</div>
					</div>
				</div>
			</div>		
		</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<input name="run_date" id="run_date" type="hidden" value="<?php echo $level2123;?>">		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<div id="RunTalent"></div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
</form>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php	}		
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-			
			break;
			default:
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>เกิดข้อผิดพลาดไม่สามารถดำเนินการได้</div>		
			</div>	
		</div>
	</div>
<?php
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-			
		}		
	}elseif($data_stu->IDLevel>=21 and $data_stu->IDLevel<=23){
		switch($level2123){
			case "OFF":
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-danger alert-styled-left">
					สิ้นสุดระยะเวลา สำรวจนักเรียนที่มีความสามารถพิเศษ พบข้อสงสัย กรุณาติดผ่ายงาน แนวแนะประถม / มัธยม ในเวลา 08.00 - 17.00 น. วันจันทร์ ถึง วันศุกร์
				</div>
			</div>
		</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php			
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-			
			break;
			case "ON":
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
<?php 
	$RunCreckJoinTheEvent=new CreckJoinTheEvent($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan);
		if($RunCreckJoinTheEvent->RunCreckJoinTheEvent()=="No"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>แบบสำรวจนักเรียนที่มีความสามารถพิเศษ ประจำปีการศึกษา <?php echo $data_yaer;?> ท่านได้ทำแบบสำรวจเรียบร้อยแล้ว</div>
			</div>		
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}elseif($RunCreckJoinTheEvent->RunCreckJoinTheEvent()=="Yes"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>แบบสำรวจนักเรียนที่มีความสามารถพิเศษ ประจำปีการศึกษา <?php echo $data_yaer;?> ท่านได้ทำแบบสำรวจเรียบร้อยแล้ว</div>
			</div>		
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php   }else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<form name="talent_student" action="./?evaluation_mod=talent_student_code" method="post" >	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-warning">
				<div class="row">
					<div class="col-<?php echo $grid;?>-2">
						<div class="content-group text-semibold">คำชี้แจง</div>
					</div>
					<div class="col-<?php echo $grid;?>-10">
						<div class="content-group text-semibold ">ขอความกรุณาผู้ปกครอง&nbsp;<?php echo $myname;?>&nbsp; ระดับชั้น กรอกความสามารถพิเศษของนักเรียนในความปกครองของท่าน เพื่อทางโรงเรียนจะได้ ส่งเสริมและจัดกิจกรรมสำหรับให้นักเรียน ความสามารถและความสนใจต่อไป</div>
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<div class="content-group text-semibold">
							<center><button type="button" id="ButTalentY" name="ButTalentY"  value="ButTalentY" class="btn btn-primary" class="btn bg-warning-400" data-popup="popover-custom" title="เคยเข้าร่วมกิจกรรม / เคยเข้าร่วมแข่งขัน"  data-placement="bottom" data-container="body">เคยเข้าร่วมกิจกรรม / เคยเข้าร่วมแข่งขัน</button></center>
						</div>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<div class="content-group text-semibold">
							<center><button type="button" id="ButTalentN" name="ButTalentN" value="ButTalentN" class="btn btn-success" class="btn bg-warning-400" data-popup="popover-custom" title="ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน"  data-placement="bottom" data-container="body">ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน</button></center>
						</div>
					</div>
				</div>
			</div>		
		</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<input name="run_date" id="run_date" type="hidden" value="<?php echo $level2123;?>">		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<div id="RunTalent"></div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
</form>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php	}		
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-			
			break;
			default:
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>เกิดข้อผิดพลาดไม่สามารถดำเนินการได้</div>		
			</div>	
		</div>
	</div>
<?php
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-			
		}		
	}elseif($data_stu->IDLevel>=31 and $data_stu->IDLevel<=33){
		switch($level3133){
			case "OFF":
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-danger alert-styled-left">
					สิ้นสุดระยะเวลา สำรวจนักเรียนที่มีความสามารถพิเศษ พบข้อสงสัย กรุณาติดผ่ายงาน แนวแนะประถม / มัธยม ในเวลา 08.00 - 17.00 น. วันจันทร์ ถึง วันศุกร์
				</div>
			</div>
		</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php			
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-			
			break;
			case "ON":
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
<?php 
	$RunCreckJoinTheEvent=new CreckJoinTheEvent($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan);
		if($RunCreckJoinTheEvent->RunCreckJoinTheEvent()=="No"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>แบบสำรวจนักเรียนที่มีความสามารถพิเศษ ประจำปีการศึกษา <?php echo $data_yaer;?> ท่านได้ทำแบบสำรวจเรียบร้อยแล้ว</div>
			</div>		
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}elseif($RunCreckJoinTheEvent->RunCreckJoinTheEvent()=="Yes"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>แบบสำรวจนักเรียนที่มีความสามารถพิเศษ ประจำปีการศึกษา <?php echo $data_yaer;?> ท่านได้ทำแบบสำรวจเรียบร้อยแล้ว</div>
			</div>		
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php   }else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<form name="talent_student" action="./?evaluation_mod=talent_student_code" method="post" >	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-warning">
				<div class="row">
					<div class="col-<?php echo $grid;?>-2">
						<div class="content-group text-semibold">คำชี้แจง</div>
					</div>
					<div class="col-<?php echo $grid;?>-10">
						<div class="content-group text-semibold ">ขอความกรุณาผู้ปกครอง&nbsp;<?php echo $myname;?>&nbsp; ระดับชั้น กรอกความสามารถพิเศษของนักเรียนในความปกครองของท่าน เพื่อทางโรงเรียนจะได้ ส่งเสริมและจัดกิจกรรมสำหรับให้นักเรียน ความสามารถและความสนใจต่อไป</div>
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<div class="content-group text-semibold">
							<center><button type="button" id="ButTalentY" name="ButTalentY"  value="ButTalentY" class="btn btn-primary" class="btn bg-warning-400" data-popup="popover-custom" title="เคยเข้าร่วมกิจกรรม / เคยเข้าร่วมแข่งขัน"  data-placement="bottom" data-container="body">เคยเข้าร่วมกิจกรรม / เคยเข้าร่วมแข่งขัน</button></center>
						</div>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<div class="content-group text-semibold">
							<center><button type="button" id="ButTalentN" name="ButTalentN" value="ButTalentN" class="btn btn-success" class="btn bg-warning-400" data-popup="popover-custom" title="ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน"  data-placement="bottom" data-container="body">ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน</button></center>
						</div>
					</div>
				</div>
			</div>		
		</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<input name="run_date" id="run_date" type="hidden" value="<?php echo $level2123;?>">		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<div id="RunTalent"></div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
</form>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php	}		
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-			
			break;
			default:
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>เกิดข้อผิดพลาดไม่สามารถดำเนินการได้</div>		
			</div>	
		</div>
	</div>
<?php
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-			
		}		
	}elseif($data_stu->IDLevel>=41 and $data_stu->IDLevel<=43){
		switch($level4143){
			case "OFF":
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-danger alert-styled-left">
					สิ้นสุดระยะเวลา สำรวจนักเรียนที่มีความสามารถพิเศษ พบข้อสงสัย กรุณาติดผ่ายงาน แนวแนะประถม / มัธยม ในเวลา 08.00 - 17.00 น. วันจันทร์ ถึง วันศุกร์
				</div>
			</div>
		</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php			
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-			
			break;
			case "ON":
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
<?php 
	$RunCreckJoinTheEvent=new CreckJoinTheEvent($user_login,$data_yaer,$data_stu->IDLevel,$data_stu->rc_plan);
		if($RunCreckJoinTheEvent->RunCreckJoinTheEvent()=="No"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>แบบสำรวจนักเรียนที่มีความสามารถพิเศษ ประจำปีการศึกษา <?php echo $data_yaer;?> ท่านได้ทำแบบสำรวจเรียบร้อยแล้ว</div>
			</div>		
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	}elseif($RunCreckJoinTheEvent->RunCreckJoinTheEvent()=="Yes"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success alert-styled-left">
				<div>แบบสำรวจนักเรียนที่มีความสามารถพิเศษ ประจำปีการศึกษา <?php echo $data_yaer;?> ท่านได้ทำแบบสำรวจเรียบร้อยแล้ว</div>
			</div>		
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php   }else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<form name="talent_student" action="./?evaluation_mod=talent_student_code" method="post" >	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-warning">
				<div class="row">
					<div class="col-<?php echo $grid;?>-2">
						<div class="content-group text-semibold">คำชี้แจง</div>
					</div>
					<div class="col-<?php echo $grid;?>-10">
						<div class="content-group text-semibold ">ขอความกรุณาผู้ปกครอง&nbsp;<?php echo $myname;?>&nbsp; ระดับชั้น กรอกความสามารถพิเศษของนักเรียนในความปกครองของท่าน เพื่อทางโรงเรียนจะได้ ส่งเสริมและจัดกิจกรรมสำหรับให้นักเรียน ความสามารถและความสนใจต่อไป</div>
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<div class="content-group text-semibold">
							<center><button type="button" id="ButTalentY" name="ButTalentY"  value="ButTalentY" class="btn btn-primary" class="btn bg-warning-400" data-popup="popover-custom" title="เคยเข้าร่วมกิจกรรม / เคยเข้าร่วมแข่งขัน"  data-placement="bottom" data-container="body">เคยเข้าร่วมกิจกรรม / เคยเข้าร่วมแข่งขัน</button></center>
						</div>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<div class="content-group text-semibold">
							<center><button type="button" id="ButTalentN" name="ButTalentN" value="ButTalentN" class="btn btn-success" class="btn bg-warning-400" data-popup="popover-custom" title="ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน"  data-placement="bottom" data-container="body">ไม่เคยเข้าร่วมกิจกรรม / ไม่เคยเข้าร่วมแข่งขัน</button></center>
						</div>
					</div>
				</div>
			</div>		
		</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<input name="run_date" id="run_date" type="hidden" value="<?php echo $level2123;?>">		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<div id="RunTalent"></div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
</form>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php	}		
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-			
			break;
			default:
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">
				<div>เกิดข้อผิดพลาดไม่สามารถดำเนินการได้</div>		
			</div>	
		</div>
	</div>
<?php
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-			
		}		
	}else{ ?> 			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-danger alert-styled-left">
					ไม่มีสิทธิ์ใช้งานในส่วนนี้
				</div>
			</div>
		</div>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php }  ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
</div>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->