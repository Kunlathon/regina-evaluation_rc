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

?>



<style>
	#RuningLoadHome{
		display:none;
	}
</style>


<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<div id="RunLoadHome">
					<img class="img-thumbnail" src="Template/global_assets/images/Cube-1s-200px.gif" />
				</div>	
			</center>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div id="RuningLoadHome">
<?php
	$data_yaer=2566;
	$data_term=1;

	$user_login;

	$PrintReginaStuData=new PrintReginaStuData($user_login);
?>
<!---->
<!--ประกาศห้องเรียน Update by Rc0468 30/03/2023 The time : 00.29-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php
		$EchoClassOFF="OFF";
			if(($EchoClassOFF=="ON")){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$EchoClassStudenYear=new RcClassStudenYear("NokeyClassA",$user_login,"1","2566","-");
			foreach($EchoClassStudenYear->RunRcClassStudent() as $rc=>$EchoClassStudenRow){
				$SudYear_Class=new PrintLavaL($EchoClassStudenRow["rsc_class"]);
				$SudYear_Plan=new RSPlan($EchoClassStudenRow["rsc_plan"]);
					$SudReginaNewYear=new PrintReginaStuDataClass($user_login);
				?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="modal fade" id="PrintRcClass" role="dialog">
	<div class="modal-dialog modal-lg">
<!-- Modal content-->
		<div class="modal-content" style="background-color: lightblue;">
			<div class="modal-header">
				<div style="font-size: 20px;">ประกาศ ห้องเรียน ปีการศึกษา 2566</div>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="panel panel">
					<div class="panel-heading">
						<div class="row" style="font-size: 17px; color:#000080;">
							<div class="col-<?php echo $grid;?>-12" style="font-weight: bold;">ชื่อ-สกุล : <?php echo $SudReginaNewYear->PRS_nameTH;?> เลขประจำตัว : <?php echo $user_login;?></div>
							<div class="col-<?php echo $grid;?>-12" style="font-weight: bold;">ระดับชั้น : <?php echo $SudYear_Class->RunprintLavaTxtTh();?>   ห้อง : <?php echo $EchoClassStudenRow["rsc_room"];?></div>
							<div class="col-<?php echo $grid;?>-12" style="font-weight: bold;">ห้องเรียน / แผนกการเรียน : <?php echo $SudYear_Plan->PlanLName;?></div>
						</div>
					</div>
				</div> 
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
			</div>
		</div>
<!-- Modal content-->
    </div> 
</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php	} ?>					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
<!--ประกาศห้องเรียน จบ Update by Rc0468 30/03/2023 The time : 00.29-->
<script>
	$(document).ready(function(){
		$("#PrintRcClass").modal({backdrop: false});
	});
</script>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{} ?>
	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	$release_user=new release_user($user_login);
	if(($release_user->system_release=="Not_Error")){
		if(($release_user->print_runtime=="ON")){ ?>
			
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-lg">
<!-- Modal content-->
    <div class="modal-content" style="background-color: lightblue;">
        <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<center><div class="modal-title"><?php echo $release_user->SubjectHeading;?></div></center>
			<center><div class="modal-title"><?php echo $release_user->SubjectStory;?></div></center>
        </div>
        <div class="modal-body">
            <div class="panel panel-warning">
				<div class="panel-heading">
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
				<?php
						if($release_user->SubjectNo=="news2021002"){ ?>	
	<div class="row">
	<?php
		$data_termR=1;
		$data_stuR=new stu_levelpdo($user_login,$data_yaer,$data_termR);
	    $class=$data_stuR->IDLevel;
        $class_ex=$data_stuR->Sort_name_E2;
        $txt_billerId="099400043439110";
        $txt_ref1=strtoupper($user_login."L".$class_ex);
        $txt_ref2=strtoupper("TFFAS0T".$data_termR."0Y".$data_yaer);
        $txt_amount=$release_user->ReceiverTxt; 
        $txt_width=204;
		$txt_height=136;
        $payqrcode=new qrcode_scb($txt_billerId,$txt_ref1,$txt_ref2,$txt_amount,$txt_width);
	?>
		<div class="col-<?php echo $grid;?>-3">
            <div><img src="<?php echo $payqrcode->call_qrcode_scb();?>" class="img-thumbnail" alt="<?php echo $txt_billerId.$txt_ref1.$txt_ref2.$txt_amount.$txt_width.$txt_height;?>" width="204" height="136"></div>
            <div>BillerID&nbsp;:&nbsp;<?php echo $txt_billerId;?></div>
            <div>Ref1&nbsp;:&nbsp;<?php echo $txt_ref1;?></div>
            <div>Ref2&nbsp;:&nbsp;<?php echo $txt_ref2;?></div>
            <div>จำนวนเงิน&nbsp;:&nbsp;<?php echo number_format($txt_amount, 2, '.', ',');?></div>		
		</div>
		<div class="col-<?php echo $grid;?>-9">
            <div><b>วิธีการชำระ</b></div>
            <div>1&nbsp;.&nbsp;ทำการสแกน&nbsp;QR&nbsp;Code&nbsp;ที่ปรากฏในเพจนี้&nbsp;ด้วยแอปพลิเคชัน&nbsp;Mobile&nbsp;Banking&nbsp;ของท่าน</div>
            <div>2&nbsp;.&nbsp;ตรวจสอบข้อมูลที่ปรากฏใน&nbsp;Mobile&nbsp;Banking&nbsp;ให้ถูกต้องก่อนชำระเงิน</div>
            <div>&nbsp;&nbsp;&nbsp;-&nbsp;ตรวจสอบเลขประจำตัวนักเรียนให้ถูกต้อง</div>
            <div>&nbsp;&nbsp;&nbsp;&nbsp;Ref1&nbsp;:&nbsp;เลขประจำตัวนักเรียน&nbsp;5&nbsp;หลัก &nbsp;L&nbsp;คือชั้น</div>
            <div>&nbsp;&nbsp;&nbsp;&nbsp;Ref2&nbsp;:&nbsp;ตัวอักษรคำว่า&nbsp;"TFFAS ย่อมาจากคำว่า Tuition Fee for After School"&nbsp;0T&nbsp;คือ&nbsp;ภาคเรียน&nbsp;0Y&nbsp;คือ&nbsp;ปีการศึกษา</div>
            <div>&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบจำนวนเงินให้ถูกต้อง</div>
            <div>&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบชื่อผู้รับเงินต้องเป็น&nbsp;โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;หรือ&nbsp;REGINA&nbsp;COELI&nbsp;COLLEGE&nbsp;SCHOOL&nbsp;เท่านั้น</div>
            <div>3&nbsp;.&nbsp;สำหรับหลักฐานการชำระเงินให้ท่านเก็บไว้เป็นหลักฐาน</div>
            <div>4&nbsp;.&nbsp;ทางโรงเรียนจะทำการตรวจสอบรายการและยืนยันการชำระเงินของท่าน </div>
            <div>5&nbsp;.&nbsp;การชำระเงินจะเสร็จสมบูรณ์&nbsp;เมื่อทางโรงเรียนได้ตรวจสอบการชำระเงินของท่านเรียบร้อยแล้ว</div>
            <div>6&nbsp;.&nbsp;หากต้องการใบเสร็จรับเงิน&nbsp;ติดต่อขอรับได้ที่ห้องการเงินของโรงเรียน</div>
            <div>7&nbsp;.&nbsp;กรณีต้องการสอบถามเพิ่มเติ่มเกี่ยวกับการชำระเงิน&nbsp;กรุณาติดต่อ&nbsp;ห้องการเงิน&nbsp;053-282395&nbsp;ต่อ&nbsp;105</div>                                                                		
		</div>
	</div>						
							
				<?php	}else{
							echo $release_user->ReceiverTxt;
						}
					?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
				</div>
			</div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
        </div>
    </div> 
    </div> 
</div>						
<?php	}elseif($release_user->print_runtime=="OFF"){
			//------------------------------------------
		}else{
			//------------------------------------------
		}
	}elseif($release_user->system_release=="Error"){
		//------------------------------------------
	}else{
		//------------------------------------------
	}
?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

  
<!---->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
<!-- Cover area -->
		<div class="profile-cover">
		<div class="profile-cover-img" style="background-image: url(<?php echo $golink;?>/view/img_user/662023.jpg)"></div>
			<div class="media">
				<div class="media-left">
					<a href="#" class="profile-thumb" >
			<?php
//Update by beer 2023/05/19 			
					$sud_regina_data=new PrintReginaStuDataClass($user_login);
					if(isset($sud_regina_data->PRS_home)){ ?>
						<img src="<?php echo $golink;?>/view/img_user/<?php echo $sud_regina_data->PRS_home;?>.jpg"  class="img-circle" alt="<?php echo $sud_regina_data->PRS_home;?>">					
			<?php	}else{ ?>
						<img src="#"  class="img-circle" alt="">					
			<?php	}?>
					

					</a>
				</div>

				<div class="media-body">
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">&nbsp;</div>
						<div class="col-<?php echo $grid;?>-12"><?php echo $sud_regina_data->PRS_nameTH."&nbsp;(".$sud_regina_data->PRS_nickTh.")";?></div>
						<div class="col-<?php echo $grid;?>-12"><?php echo $sud_regina_data->PRS_nameEH."&nbsp;(".$sud_regina_data->PRS_nickEn.")";?></div>
						<div class="col-<?php echo $grid;?>-12">ระดับชั้น&nbsp;:&nbsp;<?php echo $txt_class;?>&nbsp;แผนกการเรียน&nbsp;:&nbsp;<?php echo $txt_plan;?></div>
					</div>
				</div>

				<div class="media-right media-middle">
					<ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">
						<li><a href="./?evaluation_mod=profile" class="btn btn-default"><i class="icon-file-picture position-left"></i>&nbsp;ข้อมูลส่วนตัว&nbsp;/&nbsp;My&nbsp;profile</a></li>
						<li><a id="sweet_warning2" class="btn btn-default"><i class="icon-exit2 position-left"></i>&nbsp;ออกจากระบบ</a></li>
					</ul>
				</div>
			</div>
		</div>
<!-- /cover area -->	
	</div>
</div>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
<!-- Toolbar -->
		<div class="navbar navbar-default navbar-xs content-group">
			<ul class="nav navbar-nav visible-xs-block">
				<li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
			</ul>

			<div class="navbar-collapse collapse" id="navbar-filter">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#activity" data-toggle="tab"><i class="icon-office position-left"></i>&nbsp;ช่องทางลัด</a></li>
					<li><a href="#schedule" data-toggle="tab"><i class="icon-graduation2 position-left"></i>&nbsp;ข้อมูลทางการศึกษา<!--<span class="badge badge-success badge-inline position-right">32</span>--></a></li>
					<li><a href="#homeict" data-toggle="tab"><i class="icon-usb-stick position-left"></i>&nbsp;ข้อมูลทางด้าน&nbsp;IT</a></li>
					<li><a href="#homedownload" data-toggle="tab"><i class="icon-download4 position-left"></i>&nbsp;Download&nbsp;ข้อมูล&nbsp;/&nbsp;เอกสาร</a></li>
				</ul>

						<!--<div class="navbar-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="icon-stack-text position-left"></i> Notes</a></li>
								<li><a href="#"><i class="icon-collaboration position-left"></i> Friends</a></li>
								<li><a href="#"><i class="icon-images3 position-left"></i> Photos</a></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-gear"></i> <span class="visible-xs-inline-block position-right"> Options</span> <span class="caret"></span></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="#"><i class="icon-image2"></i> Update cover</a></li>
										<li><a href="#"><i class="icon-clippy"></i> Update info</a></li>
										<li><a href="#"><i class="icon-make-group"></i> Manage sections</a></li>
										<li class="divider"></li>
										<li><a href="#"><i class="icon-three-bars"></i> Activity log</a></li>
										<li><a href="#"><i class="icon-cog5"></i> Profile settings</a></li>
									</ul>
								</li>
							</ul>
						</div>-->
			</div>
		</div>
<!-- /toolbar -->
	</div>
</div>





<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="tabbable">
			<div class="tab-content">
				<div class="tab-pane fade in active" id="activity">
				
					<div class="row">
						<div class="col-<?php echo $grid;?>-6">
							<div class="panel panel-body border-top-primary">
								<div class="text-center">
									<h6 class="no-margin text-semibold">ช่องทางลัด&nbsp;:&nbsp;แบบประเมิน&nbsp;/&nbsp;แบบสำเร็จ</h6>
								</div>
								<div class="panel-body">
									<div class="row" align="center">
										<div class="col-<?php echo $grid;?>-6">
											<a href=".?evaluation_mod=talent_student"><img src="Template/global_assets/images/k2020.jpg" width="300" height="100" class="img-thumbnail" alt="แบบสำรวจนักเรียนที่มีความสามารถพิเศษ (สำหรับผู้ปกครอง)"></a>						
										</div>
										<!--<div class="col-<?php //echo $grid;?>-6">
											<a href="./?evaluation_mod=aft_course"><img src="Template/global_assets/images/แบบประเมิน_1.jpg" width="300" height="100" class="img-thumbnail" alt="แบบประเมินการเรียนการสอน"></a>
										</div>-->
										<!--<div class="col-<?php //echo $grid;?>-6">
											<a href=".?evaluation_mod=favorite_teacher"><img src="Template/global_assets/images/โหวต_1.jpg" width="300" height="100" class="img-thumbnail" alt="ร่วม Vote คุณครูในดวงใจ"></a>
										</div>-->					
									</div>			
								</div>				
							</div>	
						</div>
						<div class="col-<?php echo $grid;?>-6">
							<div class="panel panel-body border-top-primary">
								<div class="text-center">
									<h6 class="no-margin text-semibold">ช่องทางลัด&nbsp;:&nbsp;กิจกรรมพัฒนาผู้นักเรียน</h6>
								</div>
								<div class="panel-body">
									<div class="row" align="center">
										<div class="col-<?php echo $grid;?>-6">
											<a href=".?evaluation_mod=activity"><img src="Template/global_assets/images/ส่งเสริมศักยภาพ.jpg" width="300" height="100" class="img-thumbnail" alt="ลงทะเบียนส่งเสริมศักย์ภาพ"></a>
										</div>
										<div class="col-<?php echo $grid;?>-6"></div>
									</div>			
								</div>				
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-<?php echo $grid;?>-6">
							<div class="panel panel-body border-top-primary">
								<div class="text-center">
									<h6 class="no-margin text-semibold">ช่องทางลัด&nbsp;:&nbsp;วิชาการ&nbsp;/&nbsp;ทะเบียนวัดผล</h6>
								</div>
								<div class="panel-body">
									<div class="row" align="center">
										<div class="row">
											<div class="col-<?php echo $grid;?>-6">
												<!--<a href=".?evaluation_mod=stu_supplementary"><img src="Template/global_assets/images/2020.jpg" width="300" height="100" style="width :300px; height:100;" class="img-thumbnail" alt="ชำระค่าลงเบียน กิจกรรมสอนเสริมนอกเวลาเรียน" ></a>-->
												<a href=".?evaluation_mod=stu_supplementary"><img src="Template/global_assets/images/2020.jpg" width="300" height="100" style="width :300px; height:100;" class="img-thumbnail" alt="ชำระค่าลงเบียน กิจกรรมสอนเสริมนอกเวลาเรียน" ></a>
											</div>
											<div class="col-<?php echo $grid;?>-6">
												<!--<a href=".?evaluation_mod=weekend_class"><img src="Template/global_assets/images/rc_happy_weekend.jpg" width="300" height="100" style="width :300px; height:100;" class="img-thumbnail" alt="ลงทะเบียน เรียนเสริมภาคฤดูร้อน"></a>-->
												<a href=".?evaluation_mod=weekend_class"><img src="Template/global_assets/images/rc_happy_weekend.jpg" width="300" height="100" style="width :300px; height:100;" class="img-thumbnail" alt="ลงทะเบียน เรียนเสริมภาคฤดูร้อน"></a>
											</div>										
										</div>										
										<div class="row">
											<div class="col-<?php echo $grid;?>-6">
												<a href=".?evaluation_mod=rc_summer"><img src="Template/global_assets/images/ICON SUMMER COURSE 2023-01.jpg" width="300" height="100" style="width :300px; height:100;" class="img-thumbnail" alt="ลงทะเบียน เรียนเสริมภาคฤดูร้อน"></a>
											</div>										
											<div class="col-<?php echo $grid;?>-6"></div>											
										</div>									
										<div class="row">
											<div class="col-<?php echo $grid;?>-6">
												<!--<a href=".?evaluation_mod=intention_quotas"><img src="Template/global_assets/images/QuotaBotton-01.png" width="300" height="100" class="img-thumbnail" alt="ประกาศรายชื่อผู้มีสิทธิ์ได้รับโควตา" style="background-image: url('Template/global_assets/images/new-menu.gif'); background-repeat: no-repeat;  background-position: left top; background-size: 15%;"></a>-->
												<a href=".?evaluation_mod=intention_quotas"><img src="Template/global_assets/images/QuotaBotton-01.png" width="300" height="100" style="width :300px; height:100; background-image: url('Template/global_assets/images/new-menu.gif'); background-repeat: no-repeat;  background-position: left top; background-size: 15%;" class="img-thumbnail" alt="ประกาศรายชื่อผู้มีสิทธิ์ได้รับโควตา" ></a>
											</div>
											<div class="col-<?php echo $grid;?>-6">
												<a href=".?evaluation_mod=rc_quota"><img src="Template/global_assets/images/QuotaBotton-02.png" width="300" height="100" style="width :300px; height:100; background-image: url('Template/global_assets/images/new-menu.gif'); background-repeat: no-repeat;  background-position: left top; background-size: 15%;" class="img-thumbnail" alt="ประกาศผล / มอบตัว นักเรียนได้รับสิทธิ์โควตาภายใน" ></a>
											</div>										
										</div>


										
									</div>			
								</div>				
							</div>	
						</div>
						<div class="col-<?php echo $grid;?>-6">
							<div class="panel panel-body border-top-primary">
								<div class="text-center">
									<h6 class="no-margin text-semibold">ช่องทางลัด : การเงิน / ค่าชำระในกิจการโรงเรียน</h6>
								</div>
								<div class="panel-body">
									<div class="row" align="center">
										<div class="col-<?php echo $grid;?>-6">
											<a href=".?evaluation_mod=stu_book"><img src="Template/global_assets/images/book.png" width="300" height="100" class="img-thumbnail" alt="ชำระค่าหนังสือ"></a>
										</div>
										<!--<div class="col-<?php //echo $grid;?>-6">
											<a href=".?evaluation_mod=tuition_fee"><img src="Template/global_assets/images/ชำระธรรมเนียมทางการศึกษา.jpg" width="300" height="100" class="img-thumbnail" alt="ชำระธรรมเนียมทางการศึกษา"></a>
										</div>-->
									</div>						
								</div>				
							</div>	
						</div>
					</div>				
				
				</div>
				<div class="tab-pane fade" id="schedule">
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-info">
								<div class="panel-heading">ข้อมูลการลงกิจกรรมส่งเสริมศักยภาพ / กิจกรรมชุมรม</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-hover">
											<thead>
												<tr>
													<th><div>ลำดับ</div></th>
													<th><div>ปีการศึกษา</div></th>
													<th><div>ระดับชั้น</div></th>
													<th><div>กิจกรรม</div></th>
													<th><div>ประเภทกิจกรรม</div></th>
												</tr>
											</thead>
											<tbody>
				<?php
					$count_IAY=1;
					$ActivityStudent=new InformationActivityStudent($user_login);
					foreach($ActivityStudent->RunInformationActivityStudent() as $rc=>$ActivityStudentRow){ ?>
											
												<tr style="color:#228B22; font-weight: bold;">
													<td><div><?php echo $count_IAY;?></div></td>
													<td><div><?php echo $ActivityStudentRow["activity_y"];?></div></td>
							<?php
								$Class_IAY=new PrintLavaL($ActivityStudentRow["activity_level"]);
							?>						
													<td><div><?php echo $Class_IAY->LavaTh;?></div></td>
													<td><div><?php echo $ActivityStudentRow["activity_txt"];?></div></td>
													<td><div><?php echo $ActivityStudentRow["ac_txt"];?></div></td>
												</tr>		
												
				<?php	$count_IAY=$count_IAY+1;} ?>


											</tbody>
										</table>
									</div>								
								</div>
							</div>					
						</div>
					</div>					

				
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-info">
								<div class="panel-heading">ข้อมูลการลงกิจกรรมเรียนภาคฤดูร้อน</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-hover">
											<thead>
												<tr>
													<th><div>ลำดับ</div></th>
													<th><div>ปีการศึกษา</div></th>
													<th><div>ระดับชั้น</div></th>
													<th><div>กิจกรรม</div></th>
												</tr>
											</thead>
											<tbody>
											
						<?php
								$count_DSS=1;
								$DataSummerStudent=new InformationSummerStudent($user_login,1);
								foreach($DataSummerStudent->RunInformationSummerStudent() as $rc=>$DataSummerStudentRow){ ?>
								
												<tr style="color:#7B68EE; font-weight: bold;">
													<td><div><?php echo $count_DSS;?></div></td>
													<td><div><?php echo $DataSummerStudentRow["RSD_year"];?></div></td>
							<?php
								$Class_DSS=new PrintLavaL($DataSummerStudentRow["RSD_class"]);
							?>						
													
													<td><?php echo $Class_DSS->LavaTh;?></td>
													<td><div><?php echo $DataSummerStudentRow["RSD_txtTh"];?></div></td>
												</tr>	
												
						<?php	$count_DSS=$count_DSS+1;} ?>						


											</tbody>
										</table>
									</div>								
								</div>
							</div>					
						</div>					
					</div>				
				
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-default">
								<div class="panel-body">เข้าร่วมชั้นเรียนในฐานะนักเรียน</div>
								<div class="panel-body">
									<div class="row">
						<?php
								$DataClassStu=new RcClassStudent($user_login);
								foreach($DataClassStu->RunRcClassStudent() as $rc=>$DataClassStuRow){

									$PrintDataStu=new regina_stu_data2($DataClassStuRow["rsd_studentid"],$DataClassStuRow["rsc_year"],$DataClassStuRow["rsc_term"],$DataClassStuRow["rsc_class"]);
									
									$PrintDataPlan=new print_plan($DataClassStuRow["rsc_plan"]);
									
									if($DataClassStuRow["rsc_class"]==3){ 
										if(file_exists("view/sud_img03/$user_login.JPG")){
											$user_img="view/sud_img03/$user_login.JPG";
										}else{
											if(file_exists("view/sud_img03/$user_login.jpg")){
												$user_img="view/sud_img03/$user_login.jpg";
											}else{
												$user_img="view/sud_img03/newimg_rc.jpg";
											}
										}
									}elseif($DataClassStuRow["rsc_class"]>=11 and $DataClassStuRow["rsc_class"]<=22){ 
										if(file_exists("view/sud_img1122/$user_login.JPG")){
											$user_img="view/sud_img1122/$user_login.JPG";
										}else{
											if(file_exists("view/sud_img1122/$user_login.jpg")){
												$user_img="view/sud_img1122/$user_login.jpg";
											}else{
												$user_img="view/sud_img1122/newimg_rc.jpg";
											}
										}	
									}elseif($DataClassStuRow["rsc_class"]>=23 and $DataClassStuRow["rsc_class"]<=33){
										if(file_exists("view/sud_img2333/$user_login.JPG")){
											$user_img="view/sud_img2333/$user_login.JPG";
										}else{
											if(file_exists("view/sud_img2333/$user_login.jpg")){
												$user_img="view/sud_img2333/$user_login.jpg";
											}else{
												$user_img="view/sud_img2333/newimg_rc.jpg";
											}
										}										
									}elseif($DataClassStuRow["rsc_class"]>=41 and $DataClassStuRow["rsc_class"]<=43){ 
										if(file_exists("view/sud_img4143/$user_login.JPG")){
											$user_img="view/sud_img4143/$user_login.JPG";
										}else{
											if(file_exists("view/sud_img4143/$user_login.jpg")){
												$user_img="view/sud_img4143/$user_login.jpg";
											}else{
												$user_img="view/sud_img4143/newimg_rc.jpg";
											}
										}									
									}else{
										$user_img="view/all/newimg_rc.jpg";
									}
									
									?>
								
									
										<div class="col-<?php echo $grid;?>-6">
											<!--<div class="panel panel-body border-top-primary">
												<div class="panel-body">-->
													<div class="row">
														<div class="col-<?php echo $grid;?>-3"><img src="<?php echo $user_img;?>" width="100%" class="img-thumbnail" alt=""></div>
														<div class="col-<?php echo $grid;?>-9">
															<div>แผนการเรียน&nbsp;:&nbsp;<?php echo $PrintDataPlan->plan_Name;?>&nbsp;(<?php echo $PrintDataPlan->plan_LName;?>)</div>
															<div>ระดับชั้น&nbsp;<?php echo $PrintDataStu->Sort_name;?>&nbsp;ห้อง&nbsp;<?php echo $PrintDataStu->rsc_room;?></div>
															<div>ภาคเรียนที่&nbsp;<?php echo $PrintDataStu->rsc_term;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $PrintDataStu->rsc_year;?></div>
															<div></div>
														</div>
													</div>			
												<!--</div>				
											</div>-->										
										</div>
																	
								
						<?php	} ?>			
									</div>

									
								</div>

								
							</div>
							
						</div>
					</div>
				
				</div>	



				<div class="tab-pane fade" id="homedownload">
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-primary">
								<div class="panel-heading">Print/Download ข้อมูลเอกสาร</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-<?php echo $grid;?>-4">
											<div class="panel panel-body">
												<div class="media">
													<div class="media-left">
														<a href="<?php echo $golink;?>/print_imgstu/print_img1/<?php echo $user_login;?>" target="_blank"><i class="icon-printer4 text-success-400 icon-2x no-edge-top mt-5"></i></a>
													</div>

													<div class="media-body">
														<h6 class="media-heading text-semibold"><a href="<?php echo $golink;?>/print_imgstu/print_img1/<?php echo $user_login;?>" target="_blank" class="text-default">พิมพ์รูปนักเรียน 1 นิ้ว</a></h6>
													</div>
												</div>
											</div>
										</div>
										<div class="col-<?php echo $grid;?>-4">
											<div class="panel panel-body">
												<div class="media">
													<div class="media-left">
														<a href="<?php echo $golink;?>/print_imgstu/print_img1_5/<?php echo $user_login;?>" target="_blank"><i class="icon-printer4 text-success-400 icon-2x no-edge-top mt-5"></i></a>
													</div>

													<div class="media-body">
														<h6 class="media-heading text-semibold"><a href="<?php echo $golink;?>/print_imgstu/print_img1_5/<?php echo $user_login;?>" target="_blank" class="text-default">พิมพ์รูปนักเรียน 1.5 นิ้ว</a></h6>
													</div>
												</div>
											</div>
										</div>									
										<div class="col-<?php echo $grid;?>-4">
											<div class="panel panel-body">
												<div class="media">
													<div class="media-left">
														<a href="<?php echo $golink;?>/print_imgstu/print_img2/<?php echo $user_login;?>" target="_blank"><i class="icon-printer4 text-success-400 icon-2x no-edge-top mt-5"></i></a>
													</div>

													<div class="media-body">
														<h6 class="media-heading text-semibold"><a href="<?php echo $golink;?>/print_imgstu/print_img2/<?php echo $user_login;?>" target="_blank" class="text-default">พิมพ์รูปนักเรียน 2 นิ้ว</a></h6>
													</div>
												</div>
											</div>
										</div>	
										
						<div class="col-<?php echo $grid;?>-4">
							<div class="panel panel-body">
								<div class="media">
									<div class="media-left">
										<a href="<?php echo $golink;?>/view/img_user/document/ฟอร์มแฟ้มสะสมผลงาน ม.ต้น.docx" target="_blank"><i class="icon-file-download2 text-info icon-2x no-edge-top mt-5"></i></a>
									</div>

									<div class="media-body">
										<h6 class="media-heading text-semibold"><a href="<?php echo $golink;?>/view/img_user/document/ฟอร์มแฟ้มสะสมผลงาน ม.ต้น.docx" class="text-default" target="_blank">ฟอร์มแฟ้มสะสมผลงาน ม.ต้น</a></h6>
									</div>
								</div>
							</div>
						</div>
						<!--<<div class="col-<?php //echo $grid;?>-4">
							<div class="panel panel-body">
								<div class="media">
									<div class="media-left">
										<a href="<?php //echo $golink;?>/view/img_user/document/ฟอร์มแฟ้มสะสมผลงาน ม.ปลาย.docx" target="_blank"><i class="icon-file-download2 text-info icon-2x no-edge-top mt-5"></i></a>
									</div>

									div class="media-body">
										<h6 class="media-heading text-semibold"><a href="<?php //echo $golink;?>/view/img_user/document/ฟอร์มแฟ้มสะสมผลงาน ม.ปลาย.docx" class="text-default" target="_blank">ฟอร์มแฟ้มสะสมผลงาน ม.ปลาย</a></h6>
									</div>
								</div>
							</div>
						</div>-->
						<div class="col-<?php echo $grid;?>-4">
							<div class="panel panel-body">
								<div class="media">
									<div class="media-left">
										<a href="<?php echo $golink;?>/view/img_user/document/ฟอร์มแฟ้มสะสมผลงานนักเรียนประถม.docx" target="_blank"><i class="icon-file-download2 text-info icon-2x no-edge-top mt-5"></i></a>
									</div>

									<div class="media-body">
										<h6 class="media-heading text-semibold"><a href="<?php echo $golink;?>/view/img_user/document/ฟอร์มแฟ้มสะสมผลงานนักเรียนประถม.docx" class="text-default" target="_blank">ฟอร์มแฟ้มสะสมผลงานนักเรียนประถม</a></h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-<?php echo $grid;?>-4">
							<div class="panel panel-body">
								<div class="media">
									<div class="media-left">
										<a href="<?php echo $golink;?>/view/img_user/document/ฟอร์มแฟ้มสะสมผลงานนักเรียนอนุบาล.docx" target="_blank"><i class="icon-file-download2 text-info icon-2x no-edge-top mt-5"></i></a>
									</div>

									<div class="media-body">
										<h6 class="media-heading text-semibold"><a href="<?php echo $golink;?>/view/img_user/document/ฟอร์มแฟ้มสะสมผลงานนักเรียนอนุบาล.docx" class="text-default" target="_blank">ฟอร์มแฟ้มสะสมผลงานนักเรียนอนุบาล</a></h6>
									</div>
								</div>
							</div>
						</div>						
						
					
									
									</div>
								</div>
							</div>						
						</div>
					</div>
				
				</div>

				
				
				<div class="tab-pane fade" id="homeict">
					<div class="row">
						<div class="col-<?php echo $grid;?>-6">    
							<div class="panel panel-primary">
								<div class="panel-heading">E-mail&nbsp;Regina</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-<?php echo $grid;?>-6">Google&nbsp;Account&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $user_login."@regina.ac.th";?></b></font></div>
										<div class="col-<?php echo $grid;?>-6">Password&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $Identification;?></b></font></div>
									</div>								
								</div>
							</div>
							<div class="panel panel-primary">
								<div class="panel-heading">Swis Plus for Student</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">เข้าสู่ระบบ&nbsp;:&nbsp;<font style="color: #4407FA"><b><a href="https://rc.swisplus.net/student/login.php" target="_blank">Swis Plus for Student</a></b></font></div>
									</div>								
									<div class="row">
										<div class="col-<?php echo $grid;?>-6">Username&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $user_login;?></b></font></div>
										<div class="col-<?php echo $grid;?>-6">Password&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $Identification;?></b></font></div>
									</div>
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<h5 class="panel-title">SWIS App for Student Application</h5>
										</div>
									</div>
									<div class="row">
										<div class="col-<?php echo $grid;?>-6" align="center">
											<div><img src="view/img_user/m_swis_stu.jpg" class="img-thumbnail" alt="Regina-WiFi" width="104" height="36"> </div>
											<div>Android</div>
										</div>
										<div class="col-<?php echo $grid;?>-6" align="center">
											<div><img src="view/img_user/os_swis_stu.jpg" class="img-thumbnail" alt="regina-wifi-AIS" width="104" height="36"> </div>
											<div>IPhone OS</div>										
										</div>
									</div>									
								</div>
							</div>							
							
						</div>
						<div class="col-<?php echo $grid;?>-6">
							<div class="panel panel-success">
								<div class="panel-heading">WiFi Regina</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<h5 class="panel-title">WiFi Account</h5>
										</div>
									</div>
									<!--<div class="row">
										<div class="col-<?php //echo $grid;?>-6" align="center">
											<div><img src="view/img_user/Regina-WiFi.png" class="img-thumbnail" alt="Regina-WiFi" width="104" height="36"> </div>
											<div>Regina-WiFi</div>
										</div>
										<div class="col-<?php //echo $grid;?>-6" align="center">
											<div><img src="view/img_user/regina-wifi-AIS.png" class="img-thumbnail" alt="regina-wifi-AIS" width="104" height="36"> </div>
											<div>regina-wifi-AIS</div>										
										</div>
									</div>-->
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<div>&nbsp;&nbsp;-&nbsp;&nbsp;regina-wifi-AIS</div>
											<div>&nbsp;&nbsp;-&nbsp;&nbsp;REGINA&nbsp;WIFI</div>
											<div>&nbsp;&nbsp;-&nbsp;&nbsp;All&nbsp;Password&nbsp;1661661661</div>
										</div>
									</div>
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<h5 class="panel-title">ยืนยันตัวตนเข้าสู่ระบบ&nbsp;WiFi&nbsp;Regina</h5>
										</div>
									</div>									
									<div class="row">
										<div class="col-<?php echo $grid;?>-6">
											<div>Username&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $PrintReginaStuData->PRS_studentid;?></b></font></div>
										</div>
										<div class="col-<?php echo $grid;?>-6">
											<div>password&nbsp;:&nbsp;<font style="color: #4407FA"><b><?php echo $PrintReginaStuData->PRS_Identification;?></b></font></div>
										</div>
									</div>	
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<h5 class="panel-title">เปลี่ยน Password&nbsp;ระบบยืนยันตัวตน&nbsp;WiFi&nbsp;Regina</h5>
											<small>หมายเหตุ&nbsp;ระบบอินเตอร์ภายใน&nbsp;ใช้งานได้เฉราะในโรงเรียน&nbsp;เท่านั้น</small>
										</div>
									</div>	
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
										<iframe src="http://adsrv.regina.local/iisadmpwd/aexp4b.asp" style="height:280px; width:100%;" class="img-thumbnail" frameborder="0"scrolling="auto"align="right"></iframe>
										</div>
									</div>
									
								</div>
							</div>							
						</div>
					</div>
				</div>		
			</div>
		</div>	
	</div>
</div>







<!--***///******///******///******///******///******///******///******///******///******///******///***-->
<?php
	$questionnaire="SELECT `ques_key` FROM `questionnaire` WHERE `ques_student`='{$user_login}' and `ques_term`='{$data_term}' and `ques_year`='{$data_yaer}'";
	$questionnaireRs=$rcdata_connect->query($questionnaire) or die($rcdata_connect->error());
	if($questionnaireRs->num_rows>0){ ?>
		
<?php	}else{

		$stu_new="SELECT `rsc_roomid` FROM `regina_stu_class` WHERE `rsc_year` = '{$data_yaer}' AND `rsc_term` = '{$data_term}' AND `rsd_studentid` = '{$user_login}'";
		$stu_newRs=$rcdata_connect->query($stu_new) or die($rcdata_connect->error());
		if($stu_newRs->num_rows>0){ ?>
	<!--<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">แบบสำรวจความพึงพอใจ การใช้งานระบบประเมินของนักเรียน โรงเรียนเรยีนาเชลีวิทยาลัย</h6>
			</div>
			<div class="modal-body">
				<center><a href="./?evaluation_mod=questionnaire"><button type="button" class="btn btn-info">แบบสำรวจความพึงพอใจ การใช้งานระบบประเมินของนักเรียน</button></a></center>
			</div>
		</div>
		</div>
	</div>-->			
<?php	}else{ ?>
	<!--<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title"><center>ยินดีต้องรับ นักเรียนใหม่ ปีการศึกษา 2563  โรงเรียนเรยีนาเชลีวิทยาลัย</center></h6>
			</div>
			<div class="modal-body">
				
			</div>
		</div>
		</div>
	</div>	-->		
<?php	} ?>
<!--***///******///******///******///******///******///******///******///******///******///******///***-->		



	
<?php	} ?>  
</div>