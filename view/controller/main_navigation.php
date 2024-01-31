<?php
		if(($group=="S")){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
			<div class="sidebar-category sidebar-category-visible">
				<div class="category-content no-padding">
					<ul class="navigation navigation-main navigation-accordion">
	<?php
			if(($copy_evaluation_mod=="profile")){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li class="active"><a href="./?evaluation_mod=profile"><i class="icon-user-plus"></i>&nbsp;<span>ข้อมูลส่วนตัว&nbsp;/&nbsp;My&nbsp;profile</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li><a href="./?evaluation_mod=profile"><i class="icon-user-plus"></i>&nbsp;<span>ข้อมูลส่วนตัว&nbsp;/&nbsp;My&nbsp;profile</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} ?>					
	<?php
			if(($copy_evaluation_mod=="account_settings")){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li class="active"><a href="./?evaluation_mod=account_settings"><i class="icon-cog5"></i>&nbsp;<span>การตั้งค่าบัญชี&nbsp;/&nbsp;Account&nbsp;Settings</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li><a href="./?evaluation_mod=account_settings"><i class="icon-cog5"></i>&nbsp;<span>การตั้งค่าบัญชี&nbsp;/&nbsp;Account&nbsp;Settings</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} ?>									

						<li id="sweet_warning"><a><i class="icon-switch2"></i>&nbsp;<span>ออกจากระบบ&nbsp;/&nbsp;Logout</span></a></li>
		
						<li class="navigation-header"><span>ข้อมูลสารสนเทศ&nbsp;สำหรับนักเรียน</span><i class="icon-menu" title="Main pages"></i></li>	
	<?php
			if(($copy_evaluation_mod=="smart_card_sud")){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li class="active"><a href="./?evaluation_mod=smart_card_sud"><i class="icon-pie-chart5"></i>&nbsp;<span>บัตรประจำตัวนักเรียน&nbsp;(Smart&nbsp;Card&nbsp;Student)</span></a></li>									
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li><a href="./?evaluation_mod=smart_card_sud"><i class="icon-pie-chart5"></i>&nbsp;<span>บัตรประจำตัวนักเรียน&nbsp;(Smart&nbsp;Card&nbsp;Student)</span></a></li>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} ?>							
						<li class="navigation-header"><span>แบบประเมิน / แบบสำเร็จ</span>&nbsp;<i class="icon-menu" title="Main pages"></i></li>						
						
	<?php
			if($copy_evaluation_mod=="talent_student"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li class="active"><a href="./?evaluation_mod=talent_student"><i class="icon-pie-chart5"></i>&nbsp;<span>แบบสำรวจนักเรียนที่มีความสามารถพิเศษ</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li><a href="./?evaluation_mod=talent_student"><i class="icon-pie-chart5"></i>&nbsp;<span>แบบสำรวจนักเรียนที่มีความสามารถพิเศษ</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} ?>	
	
	<?php
			if($copy_evaluation_mod=="aft_course"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--<li class="active"><a href="./?evaluation_mod=aft_course"><i class="icon-pie-chart3"></i> <span>แบบประเมินการเรียนการสอน</span></a></li>-->			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--<li><a href="./?evaluation_mod=aft_course"><i class="icon-pie-chart3"></i> <span>แบบประเมินการเรียนการสอน</span></a></li>-->			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} ?>							

	<?php
			if($copy_evaluation_mod=="favorite_teacher"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--<li class="active"><a href="./?evaluation_mod=favorite_teacher"><i class="icon-pie-chart4"></i> <span>แบบประเมินคุณครูในดวงใจ</span></a></li>-->			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--<li><a href="./?evaluation_mod=favorite_teacher"><i class="icon-pie-chart4"></i> <span>แบบประเมินคุณครูในดวงใจ</span></a></li>-->			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} ?>							
						<li class="navigation-header"><span>กิจกรรมพัฒนาผู้นักเรียน</span>&nbsp;<i class="icon-menu" title="Main pages"></i></li>
	<?php
			if($copy_evaluation_mod=="activity"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li class="active"><a href="./?evaluation_mod=activity"><i class="icon-bucket"></i>&nbsp;<span>ทะเบียนกิจกรรมชุมรม</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li><a href="./?evaluation_mod=activity"><i class="icon-bucket"></i>&nbsp;<span>ทะเบียนกิจกรรมชุมรม</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} ?>

						<li class="navigation-header"><span>วิชาการ / ทะเบียนวัดผล</span>&nbsp;<i class="icon-menu" title="Main pages"></i></li>
	<?php
			if($copy_evaluation_mod=="final_term"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--<li class="active"><a href="./?evaluation_mod=final_term"><i class="icon-pencil"></i> <span>ตรวจสอบผลการเรียนออนไลน์ </span></a></li>-->			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--<li><a href="./?evaluation_mod=final_term"><i class="icon-pencil"></i> <span>ตรวจสอบผลการเรียนออนไลน์ </span></a></li>-->			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} ?>

	<?php
			if($copy_evaluation_mod=="stu_supplementary"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li class="active"><a href="./?evaluation_mod=stu_supplementary"><i class="icon-pencil4"></i>&nbsp;<span>ลงทะเบียนเรียน&nbsp;เรียนเสริมเย็น</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li><a href="./?evaluation_mod=stu_supplementary"><i class="icon-pencil4"></i>&nbsp;<span>ลงทะเบียนเรียน&nbsp;เรียนเสริมเย็น</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} ?>

	<?php
			if($copy_evaluation_mod=="intention_quotas"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li class="active"><a href="./?evaluation_mod=intention_quotas"><i class="icon-pen6"></i>&nbsp;<span>ประกาศรายชื่อผู้มีสิทธิ์ได้รับโควตา</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li><a href="./?evaluation_mod=intention_quotas"><i class="icon-pen6"></i>&nbsp;<span>ประกาศรายชื่อผู้มีสิทธิ์ได้รับโควตา</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} ?>

	<?php
			if($copy_evaluation_mod=="rc_quota"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li class="active"><a href="./?evaluation_mod=rc_quota"><i class="icon-pencil3"></i>&nbsp;<span>ประกาศผล&nbsp;/&nbsp;มอบตัว&nbsp;นักเรียนได้รับสิทธิ์โควตาภายใน</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li><a href="./?evaluation_mod=rc_quota"><i class="icon-pencil3"></i>&nbsp;<span>ประกาศผล&nbsp;/&nbsp;มอบตัว&nbsp;นักเรียนได้รับสิทธิ์โควตาภายใน</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} ?>	

	<?php
			if($copy_evaluation_mod=="quotak"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--<li class="active"><a href="./?evaluation_mod=quotak"><i class="icon-design"></i> <span>ตรวจสอบชำระธรรมเนียมทางการศึกษา โควตาภายใน ระดับชั้น ประถมศึกษาปีที่ 1 / 2564</span></a></li>-->			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--<li><a href="./?evaluation_mod=quotak"><i class="icon-design"></i> <span>ตรวจสอบชำระธรรมเนียมทางการศึกษา โควตาภายใน ระดับชั้น ประถมศึกษาปีที่ 1 / 2564</span></a></li>-->			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} ?>
						
	<?php
			if($copy_evaluation_mod=="rc_summer"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li class="active"><a href="./?evaluation_mod=rc_summer"><i class="icon-pencil3"></i>&nbsp;<span>ลงทะเบียนเรียน&nbsp;เสริมภาคฤดูร้อน</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li><a href="./?evaluation_mod=rc_summer"><i class="icon-pencil3"></i>&nbsp;<span>ลงทะเบียนเรียน&nbsp;เสริมภาคฤดูร้อน</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} ?>

	<?php
			if($copy_evaluation_mod=="weekend_class"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li class="active"><a href="./?evaluation_mod=weekend_class"><i class="icon-pencil3"></i>&nbsp;<span>ลงทะเบียนเรียน&nbsp;RC&nbsp;Happy&nbsp;Weekend&nbsp;Class</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li><a href="./?evaluation_mod=weekend_class"><i class="icon-pencil3"></i>&nbsp;<span>ลงทะเบียนเรียน&nbsp;RC&nbsp;Happy&nbsp;Weekend&nbsp;Class</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} ?>	
						<li class="navigation-header"><span>การเงิน&nbsp;/&nbsp;ค่าชำระในกิจการโรงเรียน</span>&nbsp;<i class="icon-menu" title="Main pages"></i></li>
	<?php
			if($copy_evaluation_mod=="stu_book"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li class="active"><a href="./?evaluation_mod=stu_book"><i class="icon-cash"></i>&nbsp;<span>ตรวจสอบชำระค่าหนังสือ</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<li><a href="./?evaluation_mod=stu_book"><i class="icon-cash"></i>&nbsp;<span>ตรวจสอบชำระค่าหนังสือ</span></a></li>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} ?>	

	<?php
			if($copy_evaluation_mod=="tuition_fee"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--<li class="active"><a href="./?evaluation_mod=tuition_fee"><i class="icon-cash2"></i> <span>ตรวจสอบชำระธรรมเนียมทางการศึกษา</span></a></li>-->			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
						<!--<li><a href="./?evaluation_mod=tuition_fee"><i class="icon-cash2"></i> <span>ตรวจสอบชำระธรรมเนียมทางการศึกษา</span></a></li>-->			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	<?php	} ?>

					</ul>
				</div>
			</div>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		
<!--class="active"-->
		<?php	}elseif($group=="A"){ ?>
			
					
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<li class="navigation-header"><span>แบบประเมิน /สำรวจ สำหรับนักเรียนและผู้ปกครอง</span> <i class="icon-menu" title="Main pages"></i></li>
								<li>
									<a href="#"><i class="icon-stats-bars3"></i> <span>คุณครูในดวงใจของหนู</span></a>
									<ul>
										<li><a href="./?evaluation_mod=favorite_data">สรุปยอดนักเรียน&nbsp;-&nbsp;โหวตคุณครูในดวงใจของหนู</a></li>
										<li><a href="./?evaluation_mod=favorite_score">ผลคะแนน&nbsp;-&nbsp;โหวตคุณครูในดวงใจของหนู</a></li>										
									</ul>
								</li>	
								
								<li>
									<a href="#"><i class="icon-stats-bars2"></i> <span>ประเมินความพึงพอใจการจัดการเรียนการสอน</span></a>
									<ul>
										<li><a href="./?evaluation_mod=aft_data_teacher">ข้อมูลครูผู้สอน&nbsp;ประเมินความพึงพอใจการจัดการเรียนการสอน</a></li>
										<li><a href="./?evaluation_mod=aft_student">สรุปยอดนักเรียน&nbsp;ประเมินความพึงพอใจการจัดการเรียนการสอน</a></li>										
									</ul>
								</li>
								
								<li>
									<a href="#"><i class="icon-stats-bars4"></i> <span>แบบสำรวจนักเรียนที่มีความสามารถพิเศษ</span></a>
									<ul>
										<li><a href="./?evaluation_mod=talent_category">ข้อมูลแบบสำรวจนักเรียนที่มีความสามารถพิเศษ</a></li>
										<li><a href="./?evaluation_mod=talent_nostalgiasee">ข้อมูลความสนใจหรือกิจกรรมที่ประสงค์อยากให้ทางโรงเรียนส่งเสริมหรือจัดกิจกรรม</a></li>											
									</ul>
								</li>								
								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
								<li class="navigation-header"><span>ค่าใช้จ่ายในกิจกรรมโรงรียน</span> <i class="icon-menu" title="Main pages"></i></li>
								<li>
									<a href="#"><i class="icon-cash"></i> <span>ข้อมูลค่าใช้จ่ายสำหรับนักเรียน</span></a>
									<ul>
										<li class="navigation-header"><span>การจัดการ / การตั้งค่า</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=overdue">นักเรียน ค้างจ่าย</a></li>
										<li><a href="./?evaluation_mod=overdue_add">เพิ่มข้อมูล นักเรียนค้างจ่าย</a></li>										
									</ul>
								</li>	
<!--..............................................................................-->				
								<li>
									<a href="#"><i class="icon-cash3"></i> <span>ค่าธรรมเนียมการศึกษา</span></a>
									<ul>
										<li class="navigation-header"><span>การจัดการ / การตั้งค่า</span> <i class="icon-menu" title="Main pages"></i></li>
	<?php
		    if(($copy_evaluation_mod=="qrcode_payment_up")){ ?>
										<li class="active"><a href="./?evaluation_mod=qrcode_payment_up">ค่าธรรมเนียมการศึกษา สร้าง Execlอนำเข้าสู่ระบบ SCB</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=qrcode_payment_up">ค่าธรรมเนียมการศึกษา สร้าง Execlอนำเข้าสู่ระบบ SCB</a></li>			
    <?php	} ?>										
	<?php
		    if(($copy_evaluation_mod=="img_qrcode")){ ?>
										<li class="active"><a href="./?evaluation_mod=img_qrcode">ค่าธรรมเนียมการศึกษา รายการ QR Code ชำระค่าบำรุงการศึกษา</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=img_qrcode">ค่าธรรมเนียมการศึกษา รายการ QR Code ชำระค่าบำรุงการศึกษา</a></li>			
    <?php	} ?>
	<?php
		    if(($copy_evaluation_mod=="fee_pay_set")){ ?>
										<li class="active"><a href="./?evaluation_mod=fee_pay_set">ค่าธรรมเนียมการศึกษา ตั้งค่ายอดค่าเทอม</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=fee_pay_set">ค่าธรรมเนียมการศึกษา ตั้งค่ายอดค่าเทอม</a></li>			
    <?php	} ?>
	<?php
		    if(($copy_evaluation_mod=="save_scbpay")){ ?>
										<li class="active"><a href="./?evaluation_mod=save_scbpay">ค่าธรรมเนียมการศึกษา จดบันทึก</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=save_scbpay">ค่าธรรมเนียมการศึกษา จดบันทึก</a></li>			
    <?php	} ?>										
										<li class="navigation-header"><span>รายงาน / ข้อมูล</span> <i class="icon-menu" title="Main pages"></i></li>											
	<?php
		    if(($copy_evaluation_mod=="fee_pay_qrcode")){ ?>
										<li class="active"><a href="./?evaluation_mod=fee_pay_qrcode">ค่าธรรมเนียมการศึกษา สร้าง Execl นำเข้าสู่ระบบ SCB</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=fee_pay_qrcode">ค่าธรรมเนียมการศึกษา สร้าง Execl นำเข้าสู่ระบบ SCB</a></li>			
    <?php	} ?>									
									</ul>
								</li>	
<!--..............................................................................-->
								<li>
									<a href="#"><i class="icon-magazine"></i> <span>QRCode Payment กิจกรรมโรงเรียน</span></a>
									<ul>
										<li class="navigation-header"><span>การจัดการ / การตั้งค่า</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=qsa_family_day">กิจกรรม วันครอบครัวโรงเรียนเรยีนาเชลีวิทยาลัย</a></li>																			
									</ul>								
								</li>
<!--..............................................................................-->								
								<li>
									<a href="#"><i class="icon-graduation2"></i> <span>การจัดการระบบหนังสือเรียน</span></a>
									<ul>
										<li class="navigation-header"><span>การจัดการ / การตั้งค่า</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=rcbooks_up_price">ลงทะเบียนข้อมูลราคา จำหน่ายหนังสือเรียนประจำปีการศึกษา</a></li>	
										<li class="navigation-header"><span>รายงาน / แสดงข้อมูล</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=rcbooks_receipt_all">พิมพ์ฉบับร่างใบแทนค่า จำหน่ายหนังสือเรียนประจำปีการศึกษา</a></li>
									</ul>									
								</li>
<!--..............................................................................-->								
								<li>
									<a href="#"><i class="icon-magazine"></i> <span>คอนเสิร์ต เรยีนาเชลีวิทยาลัย</span></a>
									<ul>
									    <li class="navigation-header"><span>การจัดการ / การตั้งค่า</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=concert_pay">ชำระค่าบัตรคอนเสิร์ต </a></li>	
										<li class="navigation-header"><span>รายงาน / ข้อมูล</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=concert_predicate">สรุปยอดขาย </a></li>										
									</ul>								
								</li>								
								
								
								
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
																
								<li class="navigation-header"><span>ข้อมูลนักเรียน</span> <i class="icon-menu" title="Main pages"></i></li>								
								<li>
									<a href="#"><i class="icon-paint-format"></i> <span>ข้อมูลพื้นฐานนักเรียน</span></a>
									
									<ul>
										<li class="navigation-header"><span>การจัดการ / การตั้งค่า</span> <i class="icon-menu" title="Main pages"></i></li>
																	
										<li class="navigation-header"><span>รายงาน / แสดงข้อมูล</span> <i class="icon-menu" title="Main pages"></i></li>
										
	<?php
			if(($copy_evaluation_mod=="sturc_dataall")){ ?>
										<li class="active"><a href="./?evaluation_mod=sturc_dataall">ข้อมูลนักเรียน ทั้งหมด</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=sturc_dataall">ข้อมูลนักเรียน ทั้งหมด</a></li>			
	<?php	} ?>
	<?php
			if(($copy_evaluation_mod=="stu_room")){ ?>
										<li class="active"><a href="./?evaluation_mod=stu_room">รายชื่อนักเรียน แยกตามห้องเรียน</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=stu_room">รายชื่อนักเรียน แยกตามห้องเรียน</a></li>			
	<?php	} ?>
	<?php
			if(($copy_evaluation_mod=="stu_roomimg")){ ?>
										<li class="active"><a href="./?evaluation_mod=stu_roomimg">รูปนักเรียน แยกตามห้องเรียน</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=stu_roomimg">รูปนักเรียน แยกตามห้องเรียน</a></li>			
	<?php	} ?>
	<?php
			if(($copy_evaluation_mod=="information")){ ?>
										<li class="active"><a href="./?evaluation_mod=information">ข้อมูลพื้นฐาน นักเรียนทั้งหมด</a></li>				
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=information">ข้อมูลพื้นฐาน นักเรียนทั้งหมด</a></li>				
	<?php	} ?>	
	
	
										

										
										
								
																			
									</ul>	
									
								</li>								
								
								

								<li class="navigation-header"><span>SWIS PLUS System</span> <i class="icon-menu" title="Main pages"></i></li>
								
								<li>
	<?php
			if(($copy_evaluation_mod=="summer_pay")){ ?>
									<li class="active"><a href="./?evaluation_mod=summer_pay"><i class="icon-drawer-in"></i> <span>Into Data to SWIS System นักเรียน เข้าห้องเรียน</span></a></li>												
	<?php	}else{ ?>
									<li><a href="./?evaluation_mod=summer_pay"><i class="icon-drawer-in"></i> <span>Into Data to SWIS System นักเรียน เข้าห้องเรียน</span></a></li>													
	<?php	} ?>								
								</li>
								
								<li>
									<a href="#"><i class="icon-drawer-in"></i> <span>ข้อมูลนำเข้าระบบ SWIS PLUS (ทั้งหมด)</span></a>
									<ul>
	<?php
			if(($copy_evaluation_mod=="data_swis_tab1")){ ?>
										<li class="active"><a href="./?evaluation_mod=data_swis_tab1">นำเข้าข้อมูลพื้นฐาน SWIS PLUS TAB1</a></li>																				
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=data_swis_tab1">นำเข้าข้อมูลพื้นฐาน SWIS PLUS TAB1</a></li>																					
	<?php	} ?>
	<?php
			if(($copy_evaluation_mod=="data_swis_tab2")){ ?>
										<li class="active"><a href="./?evaluation_mod=data_swis_tab2">นำเข้าข้อมูลพื้นฐาน SWIS PLUS TAB2</a></li>																				
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=data_swis_tab2">นำเข้าข้อมูลพื้นฐาน SWIS PLUS TAB2</a></li>																					
	<?php	} ?>
	<?php
			if(($copy_evaluation_mod=="data_swis_tab3")){ ?>
										<li class="active"><a href="./?evaluation_mod=data_swis_tab3">นำเข้าข้อมูลพื้นฐาน SWIS PLUS TAB3</a></li>																				
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=data_swis_tab3">นำเข้าข้อมูลพื้นฐาน SWIS PLUS TAB3</a></li>																					
	<?php	} ?>
	<?php
			if(($copy_evaluation_mod=="data_swis_tab4")){ ?>
										<li class="active"><a href="./?evaluation_mod=data_swis_tab4">นำเข้าข้อมูลพื้นฐาน SWIS PLUS TAB4</a></li>																				
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=data_swis_tab4">นำเข้าข้อมูลพื้นฐาน SWIS PLUS TAB4</a></li>																					
	<?php	} ?>
	<?php
			if(($copy_evaluation_mod=="data_swis_tab5")){ ?>
										<li class="active"><a href="./?evaluation_mod=data_swis_tab5">นำเข้าข้อมูลพื้นฐาน SWIS PLUS TAB5</a></li>																				
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=data_swis_tab5">นำเข้าข้อมูลพื้นฐาน SWIS PLUS TAB5</a></li>																					
	<?php	} ?>
	<?php
			if(($copy_evaluation_mod=="data_swis_tab6")){ ?>
										<li class="active"><a href="./?evaluation_mod=data_swis_tab6">นำเข้าข้อมูลพื้นฐาน SWIS PLUS TAB6</a></li>																				
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=data_swis_tab6">นำเข้าข้อมูลพื้นฐาน SWIS PLUS TAB6</a></li>																					
	<?php	} ?>
	<?php
			if(($copy_evaluation_mod=="data_swis_tab7")){ ?>
										<li class="active"><a href="./?evaluation_mod=data_swis_tab7">นำเข้าข้อมูลพื้นฐาน SWIS PLUS TAB7</a></li>																				
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=data_swis_tab7">นำเข้าข้อมูลพื้นฐาน SWIS PLUS TAB7</a></li>																					
	<?php	} ?>								
									</ul>								
								</li>
								
								<li>
									<a href="#"><i class="icon-download"></i> <span>ข้อมูลนำเข้าระบบ SWIS PLUS (แก้ไขล่าสุด 7 วัน)</span></a>
									<ul>
										<li><a href="./?evaluation_mod=updata_swis_tab1">นำเข้าข้อมูลพื้นฐาน SWIS System (Updata) TAB1</a></li>																		
										<li><a href="./?evaluation_mod=updata_swis_tab2">นำเข้าข้อมูลพื้นฐาน SWIS System (Updata) TAB2</a></li>																		
										<li><a href="./?evaluation_mod=updata_swis_tab3">นำเข้าข้อมูลพื้นฐาน SWIS System (Updata) TAB3</a></li>																		
										<li><a href="./?evaluation_mod=updata_swis_tab4">นำเข้าข้อมูลพื้นฐาน SWIS System (Updata) TAB4</a></li>																		
										<li><a href="./?evaluation_mod=updata_swis_tab5">นำเข้าข้อมูลพื้นฐาน SWIS System (Updata) TAB5</a></li>																		
										<li><a href="./?evaluation_mod=updata_swis_tab6">นำเข้าข้อมูลพื้นฐาน SWIS System (Updata) TAB6</a></li>																		
										<li><a href="./?evaluation_mod=updata_swis_tab7">นำเข้าข้อมูลพื้นฐาน SWIS System (Updata) TAB7</a></li>																		
									</ul>								
								</li>
								
								
																	
								<li class="navigation-header"><span>วิชาการ</span> <i class="icon-menu" title="Main pages"></i></li>								
								<li>
									<a href="#"><i class="icon-paint-format"></i> <span>นักเรียนโควตาภายใน</span></a>
									
									<ul>
										<li class="navigation-header"><span>การจัดการ / การตั้งค่า</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=quota_mana">แก้ไข โควตานักเรียน</a></li>
										<li><a href="./?evaluation_mod=quota_academic">นักเรียนติดปัญหาวิชาการ</a></li>										
										<li><a href="./?evaluation_mod=quota_capital">นักเรียนได้รับทุนโควตา</a></li>										
																			
										<li class="navigation-header"><span>รายงาน / แสดงข้อมูล</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=information_quota">ข้อมูลนักเรียนแผนการเรียนที่ได้สิทธิ์</a></li>
										<li><a href="./?evaluation_mod=data_intention_quota">ข้อมูลนักเรียนแสดงความจำนงสิทธิ์โควตาภายใน</a></li>										
										<li><a href="./?evaluation_mod=quota_show">ข้อมูลนักเรียนได้รับสิทธิ์โควตา</a></li>										
										<li><a href="./?evaluation_mod=Internal_quota_testing_plan">รายการสอบย้ายแผนการเรียน</a></li>										
										<li><a href="./?evaluation_mod=quota_dataall">ข้อมูลนักเรียนประสงค์มอบตัวเพื่อศึกษาต่อ</a></li>										
																			
									</ul>	
									
								</li>								
								
								<li class="navigation-header"><span>โครงการเรียนเสริมสำหรับนักเรียน</span> <i class="icon-menu" title="Main pages"></i></li>							
								<li>
									<a href="#"><i class="icon-archive"></i> <span>เรียนเสริมนอกตารางเรียน</span></a>
									<ul>
										<li class="navigation-header"><span>การจัดการ / การตั้งค่า</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=supplementary_count">ข้อมูลทางสถิติ เรียนเสริมเย็น</a></li>										
										<li><a href="./?evaluation_mod=supplementary_data">ข้อมูลนักเรียน เรียนเสริมเย็น</a></li>										
										<li><a href="./?evaluation_mod=supplementary_datastu">ข้อมูลนักเรียน เรียนเสริมเย็นนักเรียนลงทะเบียน</a></li>										
										<li><a href="./?evaluation_mod=supplementary_datanotstu">ข้อมูลนักเรียน เรียนเสริมเย็น นักเรียนไม่ลงเรียนเสริมนอกตารางเรียน</a></li>			

										<li class="navigation-header"><span>รายงาน / แสดงข้อมูล</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=supplementary_report">รายชื่อนักเรียนลงเรียน</a></li>
									</ul>
								</li>								
								
								<li>
									<a href="#"><i class="icon-paint-format"></i> <span>RC Happy Weekend</span></a>
									<ul>
										<li class="navigation-header"><span>การจัดการ / การตั้งค่า</span> <i class="icon-menu" title="Main pages"></i></li>
										<li class="navigation-header"><span>รายงาน / แสดงข้อมูล</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=weekend_statistics">ยอดลงทะเบียน </a></li>
									</ul>
								</li>								
								
								<li>
									<a href="#"><i class="icon-paint-format"></i> <span>กิจกรรมเรียนเสริมภาคฤดูร้อน</span></a>
									<ul>
										<li class="navigation-header"><span>การจัดการ / การตั้งค่า</span> <i class="icon-menu" title="Main pages"></i></li>
	<?php
			if(($copy_evaluation_mod=="ad_summer" or $copy_evaluation_mod=="ad_summer_code")){ ?>
										<li class="active"><a href="./?evaluation_mod=ad_summer">ลงทะเบียนเรียน</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=ad_summer">ลงทะเบียนเรียน</a></li>			
	<?php	} ?>						

	<?php
			if(($copy_evaluation_mod=="summer_set")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_set">ตั้งค่าระบบ</a></li>													
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_set">ตั้งค่าระบบ</a></li>													
	<?php	} ?>



	
	<?php
			if(($copy_evaluation_mod=="summer_pay")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_pay">ชำระค่าธรรมเนียม</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_pay">ชำระค่าธรรมเนียม</a></li>			
	<?php	} ?>
	<?php
			if(($copy_evaluation_mod=="summer_score_set_up")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_score_set_up">ลงทะเบียนวิชา / กิจกรรมสำหรับวัดและประเมินผล</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_score_set_up">ลงทะเบียนวิชา / กิจกรรมสำหรับวัดและประเมินผล</a></li>			
	<?php	} ?>
	<?php
			if(($copy_evaluation_mod=="summer_score_upload")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_score_upload">อัพโหลดคะแนน / กิจกรรมสำหรับวัดและประเมินผล</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_score_upload">อัพโหลดคะแนน / กิจกรรมสำหรับวัดและประเมินผล</a></li>			
	<?php	} ?>
	
										<li class="navigation-header"><span>รายงาน / แสดงข้อมูล</span> <i class="icon-menu" title="Main pages"></i></li>
	<?php
			if(($copy_evaluation_mod=="summer_count")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_count">ข้อมูลยอดผู้ลงทะเบียน</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_count">ข้อมูลยอดผู้ลงทะเบียน</a></li>			
	<?php	} ?>	
	<?php
			if(($copy_evaluation_mod=="summer_count_all")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_count_all">ข้อมูลยอดผู้ลงทะเบียน / (รวมตามกลุ่มช่วงชั้น)</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_count_all">ข้อมูลยอดผู้ลงทะเบียน / (รวมตามกลุ่มช่วงชั้น)</a></li>			
	<?php	} ?>
	<?php
			if(($copy_evaluation_mod=="summer_stu")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_stu">ข้อมูลผู้ลงทะเบียน ตามกลุ่มวิชา / กิจกรรม</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_stu">ข้อมูลผู้ลงทะเบียน ตามกลุ่มวิชา / กิจกรรม</a></li>			
	<?php	} ?>
	<?php
			if(($copy_evaluation_mod=="summer_register")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_register">ข้อมูลรายชื่อ ลง / ไม่ ทะเบียน</a></li>				
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_register">ข้อมูลรายชื่อ ลง / ไม่ ทะเบียน</a></li>				
	<?php	} ?>	
	<?php
			if(($copy_evaluation_mod=="summer_expense_report")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_expense_report">รายงานผู้ชำระค่า</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_expense_report">รายงานผู้ชำระค่า</a></li>			
	<?php	} ?>
	<?php
			if(($copy_evaluation_mod=="summer_score_print")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_score_print">รายงานข้อมูลคะแนน / กิจกรรมสำหรับวัดและประเมินผล</a></li>			
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_score_print">รายงานข้อมูลคะแนน / กิจกรรมสำหรับวัดและประเมินผล</a></li>			
	<?php	} ?>									
									</ul>	
								</li>							
							
								<li class="navigation-header"><span>กิจการนักเรียน</span> <i class="icon-menu" title="Main pages"></i></li>
								<li>
									<a href="#"><i class="icon-paint-format"></i> <span>กิจกรรมชุมรม</span></a>
									<ul>
										<li class="navigation-header"><span>การจัดการ / การตั้งค่า</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=register_activity">ลงทะเบียน</a></li>
										<li><a href="./?evaluation_mod=activity_copy_data_t">คัดลอกข้อมูลภาคเรียนถัดไป</a></li>
										
										<li class="navigation-header"><span>รายงาน / แสดงข้อมูล</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=activity_show">รายชื่อกิจกรรม</a></li>
										<li><a href="./?evaluation_mod=activity_stu">รายชื่อนักเรียนไม่ลงกิจกรรม</a></li>																				
										<li><a href="./?evaluation_mod=activity_statistics">สถิติกิจกรรมชุมนุม</a></li>	
										<li><a href="./?evaluation_mod=activity_report">รายชื่อนักเรียนลงกิจกรรม</a></li>
										
									</ul>									
								</li>	

								<li>
									<a href="#"><i class="icon-paint-format"></i> <span>นักเรียนมาสาย</span></a>
									<ul>
										<li class="navigation-header"><span>การจัดการ / การตั้งค่า</span> <i class="icon-menu" title="Main pages"></i></li>
	
	<?php
			if(($copy_evaluation_mod=="student_late_save")){	?>
										<li class="active"><a href="./?evaluation_mod=student_late_save">การจัดการข้อมูลนักเรียนมาสาย</a></li>
	<?php	}else{	?>
										<li><a href="./?evaluation_mod=student_late_save">การจัดการข้อมูลนักเรียนมาสาย</a></li>
	<?php	} ?>


	<?php
			if(($copy_evaluation_mod=="student_late_load")){ 	?>
										<li class="active"><a href="./?evaluation_mod=student_late_load">ประมวลผลข้อมูลนักเรียนมาสาย</a></li>
	<?php	}else{	?>
										<li><a href="./?evaluation_mod=student_late_load">ประมวลผลข้อมูลนักเรียนมาสาย</a></li>
	<?php	} ?>


										<li class="navigation-header"><span>รายงาน / แสดงข้อมูล</span> <i class="icon-menu" title="Main pages"></i></li>
	<?php
			if(($copy_evaluation_mod=="student_late_mail")){ ?>
										<li class="active"><a href="./?evaluation_mod=student_late_mail">ออกหนังสือแจ้งเตือนการมาสาย</a></li>
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=student_late_mail">ออกหนังสือแจ้งเตือนการมาสาย</a></li>
	<?php	} ?>
									</ul>									
								</li>
								

								<li class="navigation-header"><span>ทะเบียนวัดผล</span> <i class="icon-menu" title="Main pages"></i></li>								
	<?php
			if(($copy_evaluation_mod=="language_activities")){ ?>
								<li>
									<ul>
									    <li class="navigation-header"><span>รายงาน / แสดงข้อมูล</span> <i class="icon-menu" title="Main pages"></i></li>
										<li class="active"><a href="./?evaluation_mod=language_activities">รายงาน ประเมินผลกิจกรรมภาษาที่ 3</a></li>																																						
									</ul>
								</li>			
	<?php	}else{ ?>
								<li>
									<ul>
									    <li class="navigation-header"><span>รายงาน / แสดงข้อมูล</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=language_activities">รายงาน ประเมินผลกิจกรรมภาษาที่ 3</a></li>																																						
									</ul>
								</li>			
	<?php	} ?>
	<?php 
			if(($copy_evaluation_mod=="data_stunew")){ ?>
								<li>
									<a href="#"><i class="icon-folder-download3"></i> <span>ข้อมูลนักเรียนส่งงานทะเบียนวัดผล</span></a>
									<ul>
										<li class="active"><a href="./?evaluation_mod=data_stunew">ข้อมูล นักเรียนใหม่ รายงานส่งห้องวัดผล</a></li>																																						
									</ul>
								</li>				
	<?php	}else{ ?>
								<li>
									<a href="#"><i class="icon-folder-download3"></i> <span>ข้อมูลนักเรียนส่งงานทะเบียนวัดผล</span></a>
									<ul>
										<li><a href="./?evaluation_mod=data_stunew">ข้อมูล นักเรียนใหม่ รายงานส่งห้องวัดผล</a></li>																																						
									</ul>
								</li>				
	<?php	} ?>
								<li class="navigation-header"><span>พยาบาล / อนามัย</span> <i class="icon-menu" title="Main pages"></i></li>
								<li>
									<a href="#"><i class="icon-pulse2"></i> <span>ข้อมูลการตรวจสุขภาพนักเรียน</span></a>
									<ul>
	<?php
			if(($copy_evaluation_mod=="updata_health")){ ?>
										<li class="active"><a href="./?evaluation_mod=updata_health">ข้อมูลการตรวจสุขภาพนักเรียน อัพโหลดข้อมูลการตรวจ</a></li>				
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=updata_health">ข้อมูลการตรวจสุขภาพนักเรียน อัพโหลดข้อมูลการตรวจ</a></li>				
	<?php	}?>
	<?php
			if(($copy_evaluation_mod=="excel_health")){ ?>
										<li class="active"><a href="./?evaluation_mod=excel_health">ข้อมูลการตรวจสุขภาพนักเรียน อัพโหลด ระบบ SWIS Plus ข้อมูลชุดที่ 1</a></li>				
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=excel_health">ข้อมูลการตรวจสุขภาพนักเรียน อัพโหลด ระบบ SWIS Plus ข้อมูลชุดที่ 1</a></li>				
	<?php	}?>	
	<?php
			if(($copy_evaluation_mod=="excel2_health")){ ?>
										<li class="active"><a href="./?evaluation_mod=excel2_health">ข้อมูลการตรวจสุขภาพนักเรียน อัพโหลด ระบบ SWIS Plus ข้อมูลชุดที่ 2</a></li>				
	<?php	}else{ ?>
										<li><a href="./?evaluation_mod=excel2_health">ข้อมูลการตรวจสุขภาพนักเรียน อัพโหลด ระบบ SWIS Plus ข้อมูลชุดที่ 2</a></li>				
	<?php	}?>		
																																																			
									</ul>
								</li>


							
								<li class="navigation-header"><span>การจัดการและการบริหารระบบ</span> <i class="icon-menu" title="Main pages"></i></li>	

									<li class="navigation-header"><span>การจัดการ / การตั้งค่า</span> <i class="icon-menu" title="Main pages"></i></li>

										<li><a href="./?evaluation_mod=copy_class_year"><i class="icon-files-empty2"></i> <span>คัดลอกนักเรียนเลือนปีการศึกษา</span></a></li>									
										<li><a href="./?evaluation_mod=copy_stu_class"><i class="icon-files-empty2"></i> <span>คัดลอกนักเรียนเลือนภาคเรียน</span></a></li>
										<li><a href="./?evaluation_mod=stu_check_up"><i class="icon-upload"></i> <span>อัพโหลดข้อมูลเปรียบเทียบนักเรียน จากทะเบียนวัดผล </span></a></li>									
										<li><a href="./?evaluation_mod=runing_studentnew"><i class="icon-spinner9"></i> <span>อัพโหลดข้อมูลนักเรียนจากระบบ รับสมัครนักเรียนใหม่</span></a></li>	
										<li><a href="./?evaluation_mod=load_stu_new"><i class="icon-spinner9"></i> <span>เชื่อมต่อข้อมูลนักเรียนใหม่เข้าสู่ระบบ</span></a></li>									
														
									<li class="navigation-header"><span>รายงาน / แสดงข้อมูล</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=work_admin"><i class="icon-wrench"></i> <span>ข้อมูลทางเทคนิค ระบบสารสนเทศนักเรียน</span></a></li>
							</ul>
						</div>
					</div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php	}elseif($group=="C"){ //ผ่ายงานวิชาการและทะเบียนวัดผล ?>
		
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<li class="navigation-header"><span>ข้อมูลนักเรียน</span> <i class="icon-menu" title="Main pages"></i></li>
								<li>
									<a href="#"><i class="icon-magazine"></i> <span>ข้อมูลพื้นฐานนักเรียน</span></a>
									<ul>
										<li class="active"><a href="./?evaluation_mod=sturc_dataall">ข้อมูลนักเรียน ทั้งหมด</a></li>
										<li><a href="./?evaluation_mod=stu_room">รายชื่อนักเรียน แยกตามห้องเรียน</a></li>										
										<li><a href="./?evaluation_mod=stu_roomimg">รูปนักเรียน แยกตามห้องเรียน</a></li>																				
									</ul>								
								</li>
	
								<li class="navigation-header"><span>วิชาการ</span> <i class="icon-menu" title="Main pages"></i></li>
								<li>
									<a href="#"><i class="icon-archive"></i> <span>เรียนเสริมนอกตารางเรียน</span></a>
									<ul>
										
										<li><a href="./?evaluation_mod=supplementary_count">ข้อมูลทางสถิติ เรียนเสริมเย็น</a></li>										
										<li><a href="./?evaluation_mod=supplementary_data">ข้อมูลนักเรียน เรียนเสริมเย็น</a></li>										
										<li><a href="./?evaluation_mod=supplementary_datastu">ข้อมูลนักเรียน เรียนเสริมเย็นนักเรียนลงทะเบียน</a></li>										
										<li><a href="./?evaluation_mod=supplementary_datanotstu">ข้อมูลนักเรียน เรียนเสริมเย็น นักเรียนไม่ลงเรียนเสริมนอกตารางเรียน</a></li>										
									</ul>
								</li>
								
								<li>
									<a href="#"><i class="icon-paint-format"></i> <span>RC Happy Weekend</span></a>
									<ul>
										<li class="navigation-header"><span>การจัดการ</span> <i class="icon-menu" title="Main pages"></i></li>
										<li class="navigation-header"><span>รายงาน</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=weekend_statistics">ยอดลงทะเบียน </a></li>
										<li><a href="./?evaluation_mod=weekend_student">ข้อมูลการลงทะเบียน รายบุคคล </a></li>
										<li><a href="./?evaluation_mod=weekend_use">ข้อมูลวิชา / กิจกรรม  </a></li>
									</ul>
								</li>

								
								<li>
									<a href="#"><i class="icon-paint-format"></i> <span>นักเรียนโควตาภายใน</span></a>
									
									<ul>
										<li class="navigation-header"><span>การจัดการ</span> <i class="icon-menu" title="Main pages"></i></li>
		<?php
				if(($copy_evaluation_mod=="quota_mana")){ ?>
										<li class="active"><a href="./?evaluation_mod=quota_mana">แก้ไข โควตานักเรียน</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=quota_mana">แก้ไข โควตานักเรียน</a></li>				
		<?php	} ?>								

		<?php
				if(($copy_evaluation_mod=="quota_academic")){ ?>
										<li class="active"><a href="./?evaluation_mod=quota_academic">นักเรียนติดปัญหาวิชาการ</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=quota_academic">นักเรียนติดปัญหาวิชาการ</a></li>				
		<?php	} ?>										

		<?php
				if(($copy_evaluation_mod=="quota_capital")){ ?>
										<li class="active"><a href="./?evaluation_mod=quota_capital">นักเรียนได้รับทุนโควตา</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=quota_capital">นักเรียนได้รับทุนโควตา</a></li>				
		<?php	} ?>										
										
																			
										<li class="navigation-header"><span>รายงาน</span> <i class="icon-menu" title="Main pages"></i></li>
		<?php
				if(($copy_evaluation_mod=="information_quota")){ ?>
										<li class="active"><a href="./?evaluation_mod=information_quota">ข้อมูลนักเรียนแผนการเรียนที่ได้สิทธิ์</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=information_quota">ข้อมูลนักเรียนแผนการเรียนที่ได้สิทธิ์</a></li>				
		<?php	} ?>											

		<?php
				if(($copy_evaluation_mod=="data_intention_quota")){ ?>
										<li class="active"><a href="./?evaluation_mod=data_intention_quota">ข้อมูลนักเรียนแสดงความจำนงสิทธิ์โควตาภายใน</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=data_intention_quota">ข้อมูลนักเรียนแสดงความจำนงสิทธิ์โควตาภายใน</a></li>				
		<?php	} ?>											

		<?php
				if(($copy_evaluation_mod=="quota_show")){ ?>
										<li class="active"><a href="./?evaluation_mod=quota_show">ข้อมูลนักเรียนได้รับสิทธิ์โควตา</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=quota_show">ข้อมูลนักเรียนได้รับสิทธิ์โควตา</a></li>				
		<?php	} ?>											
	
		<?php
				if(($copy_evaluation_mod=="Internal_quota_testing_plan")){ ?>
										<li class="active"><a href="./?evaluation_mod=Internal_quota_testing_plan">รายการสอบย้ายแผนการเรียน</a></li>					
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=Internal_quota_testing_plan">รายการสอบย้ายแผนการเรียน</a></li>					
		<?php	} ?>											

		<?php
				if(($copy_evaluation_mod=="quota_dataall")){ ?>
										<li class="active"><a href="./?evaluation_mod=quota_dataall">ข้อมูลนักเรียนประสงค์มอบตัวเพื่อศึกษาต่อ</a></li>					
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=quota_dataall">ข้อมูลนักเรียนประสงค์มอบตัวเพื่อศึกษาต่อ</a></li>					
		<?php	} ?>											
									
																			
									</ul>	
									
								</li>								
								
								<li class="navigation-header"><span>กิจการนักเรียน</span> <i class="icon-menu" title="Main pages"></i></li>
								<li>
									<a href="#"><i class="icon-paint-format"></i> <span>กิจกรรมชุมรม</span></a>
									<ul>
										<li class="navigation-header"><span>การจัดการ</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=register_activity">ลงทะเบียน</a></li>
										
										<li class="navigation-header"><span>รายงาน</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=activity_show">รายชื่อกิจกรรม</a></li>
										<li><a href="./?evaluation_mod=activity_stu">รายชื่อนักเรียนไม่ลงกิจกรรม</a></li>																				
										<li><a href="./?evaluation_mod=activity_statistics">สถิติกิจกรรมชุมนุม</a></li>	
										<li><a href="./?evaluation_mod=activity_report">รายชื่อนักเรียนลงกิจกรรม</a></li>
										
									</ul>									
								</li>	
								
								<li>
									<a href="#"><i class="icon-paint-format"></i> <span>กิจกรรมเรียนเสริมภาคฤดูร้อน</span></a>
									
									<ul>
									
										<li class="navigation-header"><span>การจัดการ</span> <i class="icon-menu" title="Main pages"></i></li>
		<?php
				if(($copy_evaluation_mod=="ad_summer")){ ?>
										<li class="active"><a href="./?evaluation_mod=ad_summer">ลงทะเบียนเรียน</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=ad_summer">ลงทะเบียนเรียน</a></li>				
		<?php	} ?>										

		<?php
				if(($copy_evaluation_mod=="summer_pay")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_pay">ชำระค่าธรรมเนียม</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_pay">ชำระค่าธรรมเนียม</a></li>				
		<?php	} ?>										

		<?php
				if(($copy_evaluation_mod=="summer_score_set_up")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_score_set_up">ลงทะเบียนวิชา / กิจกรรมสำหรับวัดและประเมินผล</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_score_set_up">ลงทะเบียนวิชา / กิจกรรมสำหรับวัดและประเมินผล</a></li>				
		<?php	} ?>										

		<?php
				if(($copy_evaluation_mod=="summer_score_upload")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_score_upload">อัพโหลดคะแนน / กิจกรรมสำหรับวัดและประเมินผล</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_score_upload">อัพโหลดคะแนน / กิจกรรมสำหรับวัดและประเมินผล</a></li>				
		<?php	} ?>										
										<li class="navigation-header"><span>รายงาน</span> <i class="icon-menu" title="Main pages"></i></li>
		<?php
				if(($copy_evaluation_mod=="summer_count")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_count">ข้อมูลยอดผู้ลงทะเบียน</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_count">ข้อมูลยอดผู้ลงทะเบียน</a></li>				
		<?php	} ?>

		<?php
				if(($copy_evaluation_mod=="summer_count_all")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_count_all">ข้อมูลยอดผู้ลงทะเบียน / (รวมตามกลุ่มช่วงชั้น)</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_count_all">ข้อมูลยอดผู้ลงทะเบียน / (รวมตามกลุ่มช่วงชั้น)</a></li>				
		<?php	} ?>

		<?php
				if(($copy_evaluation_mod=="summer_stu")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_stu">ข้อมูลผู้ลงทะเบียน ตามกลุ่มวิชา / กิจกรรม</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_stu">ข้อมูลผู้ลงทะเบียน ตามกลุ่มวิชา / กิจกรรม</a></li>				
		<?php	} ?>
		<?php
				if(($copy_evaluation_mod=="summer_register")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_register">ข้อมูลรายชื่อ ลง / ไม่ ทะเบียน</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_register">ข้อมูลรายชื่อ ลง / ไม่ ทะเบียน</a></li>				
		<?php	} ?>
		<?php
				if(($copy_evaluation_mod=="summer_expense_report")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_expense_report">รายงานผู้ชำระค่า</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_expense_report">รายงานผู้ชำระค่า</a></li>				
		<?php	} ?>
		<?php
				if(($copy_evaluation_mod=="summer_score_print")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_score_print">รายงานข้อมูลคะแนน / กิจกรรมสำหรับวัดและประเมินผล</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_score_print">รายงานข้อมูลคะแนน / กิจกรรมสำหรับวัดและประเมินผล</a></li>				
		<?php	} ?>																			
									</ul>	
									
								</li>																
								
							</ul>
						</div>
					</div>		
		
		<?php	}elseif($group=="D"){ //งานกิจการนักเรียน ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<li class="navigation-header"><span>ข้อมูลนักเรียน</span> <i class="icon-menu" title="Main pages"></i></li>
								<li>
									<a href="#"><i class="icon-magazine"></i> <span>ข้อมูลพื้นฐานนักเรียน</span></a>
									<ul>
		<?php
				if(($copy_evaluation_mod=="sturc_dataall")){ ?>
										<li class="active"><a href="./?evaluation_mod=sturc_dataall">ข้อมูลนักเรียน ทั้งหมด</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=sturc_dataall">ข้อมูลนักเรียน ทั้งหมด</a></li>				
		<?php	} ?>									
		<?php
				if(($copy_evaluation_mod=="stu_room")){ ?>
										<li class="active"><a href="./?evaluation_mod=stu_room">รายชื่อนักเรียน แยกตามห้องเรียน</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=stu_room">รายชื่อนักเรียน แยกตามห้องเรียน</a></li>				
		<?php	} ?>
		<?php
				if(($copy_evaluation_mod=="stu_roomimg")){ ?>
										<li class="active"><a href="./?evaluation_mod=stu_roomimg">รูปนักเรียน แยกตามห้องเรียน</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=stu_roomimg">รูปนักเรียน แยกตามห้องเรียน</a></li>				
		<?php	} ?>		
										
									</ul>								
								</li>
	
								<li class="navigation-header"><span>วิชาการ</span> <i class="icon-menu" title="Main pages"></i></li>
								<li>
									<a href="#"><i class="icon-archive"></i> <span>เรียนเสริมนอกตารางเรียน</span></a>
									<ul>
										<li class="navigation-header"><span>การจัดการ</span> <i class="icon-menu" title="Main pages"></i></li>
										<li class="navigation-header"><span>รายงาน</span> <i class="icon-menu" title="Main pages"></i></li>										
										<li><a href="./?evaluation_mod=supplementary_count">ข้อมูลทางสถิติ เรียนเสริมเย็น</a></li>										
										<li><a href="./?evaluation_mod=supplementary_data">ข้อมูลนักเรียน เรียนเสริมเย็น</a></li>										
										<li><a href="./?evaluation_mod=supplementary_datastu">ข้อมูลนักเรียน เรียนเสริมเย็นนักเรียนลงทะเบียน</a></li>										
										<li><a href="./?evaluation_mod=supplementary_datanotstu">ข้อมูลนักเรียน เรียนเสริมเย็น นักเรียนไม่ลงเรียนเสริมนอกตารางเรียน</a></li>										
									</ul>
								</li>
								<li>
									<a href="#"><i class="icon-paint-format"></i> <span>RC Happy Weekend</span></a>
									<ul>
										<li class="navigation-header"><span>การจัดการ</span> <i class="icon-menu" title="Main pages"></i></li>
										<li class="navigation-header"><span>รายงาน</span> <i class="icon-menu" title="Main pages"></i></li>
										<li><a href="./?evaluation_mod=weekend_statistics">ยอดลงทะเบียน </a></li>
										<li><a href="./?evaluation_mod=weekend_student">ข้อมูลการลงทะเบียน รายบุคคล </a></li>
										<li><a href="./?evaluation_mod=weekend_use">ข้อมูลวิชา / กิจกรรม  </a></li>
									</ul>
								</li>
								
								<li class="navigation-header"><span>กิจการนักเรียน</span> <i class="icon-menu" title="Main pages"></i></li>
								<li>
									<a href="#"><i class="icon-paint-format"></i> <span>กิจกรรมชุมรม</span></a>
									<ul>
										<li class="navigation-header"><span>การจัดการ</span> <i class="icon-menu" title="Main pages"></i></li>
		<?php
				if(($copy_evaluation_mod=="register_activity")){ ?>
										<li class="active"><a href="./?evaluation_mod=register_activity">ลงทะเบียน</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=register_activity">ลงทะเบียน</a></li>				
		<?php	} ?>										
										<li class="navigation-header"><span>รายงาน</span> <i class="icon-menu" title="Main pages"></i></li>
		<?php
				if(($copy_evaluation_mod=="activity_show")){ ?>
										<li class="active"><a href="./?evaluation_mod=activity_show">รายชื่อกิจกรรม</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=activity_show">รายชื่อกิจกรรม</a></li>				
		<?php	} ?>
		<?php
				if(($copy_evaluation_mod=="activity_stu")){ ?>
										<li class="active"><a href="./?evaluation_mod=activity_stu">รายชื่อนักเรียนไม่ลงกิจกรรม</a></li>					
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=activity_stu">รายชื่อนักเรียนไม่ลงกิจกรรม</a></li>					
		<?php	} ?>
		<?php
				if(($copy_evaluation_mod=="activity_statistics")){ ?>
										<li class="active"><a href="./?evaluation_mod=activity_statistics">สถิติกิจกรรมชุมนุม</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=activity_statistics">สถิติกิจกรรมชุมนุม</a></li>				
		<?php	} ?>
		<?php
				if(($copy_evaluation_mod=="activity_report")){ ?>
										<li class="active"><a href="./?evaluation_mod=activity_report">รายชื่อนักเรียนลงกิจกรรม</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=activity_report">รายชื่อนักเรียนลงกิจกรรม</a></li>				
		<?php	} ?>		
									</ul>									
								</li>	
								
								<li>
									<a href="#"><i class="icon-paint-format"></i> <span>กิจกรรมเรียนเสริมภาคฤดูร้อน</span></a>
									
									<ul>
									
										<li class="navigation-header"><span>การจัดการ</span> <i class="icon-menu" title="Main pages"></i></li>
		<?php
				if(($copy_evaluation_mod=="ad_summer")){ ?>
										<li class="active"><a href="./?evaluation_mod=ad_summer">ลงทะเบียนเรียน</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=ad_summer">ลงทะเบียนเรียน</a></li>				
		<?php	} ?>
		<?php
				if(($copy_evaluation_mod=="summer_pay")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_pay">ชำระค่าธรรมเนียม</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_pay">ชำระค่าธรรมเนียม</a></li>				
		<?php	} ?>
		<?php
				if(($copy_evaluation_mod=="summer_score_set_up")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_score_set_up">ลงทะเบียนวิชา / กิจกรรมสำหรับวัดและประเมินผล</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_score_set_up">ลงทะเบียนวิชา / กิจกรรมสำหรับวัดและประเมินผล</a></li>				
		<?php	} ?>
		<?php
				if(($copy_evaluation_mod=="summer_score_upload")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_score_upload">อัพโหลดคะแนน / กิจกรรมสำหรับวัดและประเมินผล</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_score_upload">อัพโหลดคะแนน / กิจกรรมสำหรับวัดและประเมินผล</a></li>				
		<?php	} ?>		
										<li class="navigation-header"><span>รายงาน</span> <i class="icon-menu" title="Main pages"></i></li>
		<?php
				if(($copy_evaluation_mod=="summer_count")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_count">ข้อมูลยอดผู้ลงทะเบียน</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_count">ข้อมูลยอดผู้ลงทะเบียน</a></li>				
		<?php	} ?>
		<?php
				if(($copy_evaluation_mod=="summer_count_all")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_count_all">ข้อมูลยอดผู้ลงทะเบียน / (รวมตามกลุ่มช่วงชั้น)</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_count_all">ข้อมูลยอดผู้ลงทะเบียน / (รวมตามกลุ่มช่วงชั้น)</a></li>				
		<?php	} ?>
		<?php
				if(($copy_evaluation_mod=="summer_stu")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_stu">ข้อมูลผู้ลงทะเบียน ตามกลุ่มวิชา / กิจกรรม</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_stu">ข้อมูลผู้ลงทะเบียน ตามกลุ่มวิชา / กิจกรรม</a></li>				
		<?php	} ?>
		<?php
				if(($copy_evaluation_mod=="summer_register")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_register">ข้อมูลรายชื่อ ลง / ไม่ ทะเบียน</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_register">ข้อมูลรายชื่อ ลง / ไม่ ทะเบียน</a></li>				
		<?php	} ?>
		<?php
				if(($copy_evaluation_mod=="summer_expense_report")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_expense_report">รายงานผู้ชำระค่า</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_expense_report">รายงานผู้ชำระค่า</a></li>				
		<?php	} ?>
		<?php
				if(($copy_evaluation_mod=="summer_score_print")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_score_print">รายงานข้อมูลคะแนน / กิจกรรมสำหรับวัดและประเมินผล</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_score_print">รายงานข้อมูลคะแนน / กิจกรรมสำหรับวัดและประเมินผล</a></li>				
		<?php	} ?>		
																			
									</ul>	
									
								</li>								
																
							</ul>
						</div>
					</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<?php	}elseif($group=="F"){ //งานการเงิน ?>
		
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<li class="navigation-header"><span>ข้อมูลนักเรียน</span> <i class="icon-menu" title="Main pages"></i></li>
								<li>
									<a href="#"><i class="icon-magazine"></i> <span>ข้อมูลพื้นฐานนักเรียน</span></a>
									<ul>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($copy_evaluation_mod=="sturc_dataall"){ ?>
										<li class="active"><a href="./?evaluation_mod=sturc_dataall">ข้อมูลนักเรียน ทั้งหมด</a></li>					
			<?php	}else{ ?>
										<li><a href="./?evaluation_mod=sturc_dataall">ข้อมูลนักเรียน ทั้งหมด</a></li>					
			<?php	} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($copy_evaluation_mod=="stu_room"){ ?>
										<li class="active"><a href="./?evaluation_mod=stu_room">รายชื่อนักเรียน แยกตามห้องเรียน</a></li>					
			<?php	}else{ ?>
										<li><a href="./?evaluation_mod=stu_room">รายชื่อนักเรียน แยกตามห้องเรียน</a></li>					
			<?php	} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($copy_evaluation_mod=="stu_roomimg"){ ?>
										<li class="active"><a href="./?evaluation_mod=stu_roomimg">รูปนักเรียน แยกตามห้องเรียน</a></li>						
			<?php	}else{ ?>
										<li><a href="./?evaluation_mod=stu_roomimg">รูปนักเรียน แยกตามห้องเรียน</a></li>						
			<?php	} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																	
									</ul>								
								</li>

								<li class="navigation-header"><span>QRCode Payment</span> <i class="icon-menu" title="Main pages"></i></li>
								<li>
									<a href="#"><i class="icon-magazine"></i> <span>QRCode Payment กิจกรรมโรงเรียน</span></a>
									<ul>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
			<?php
					if($copy_evaluation_mod=="qsa_family_day"){ ?>
										<li class="active"><a href="./?evaluation_mod=qsa_family_day">กิจกรรม วันครอบครัวโรงเรียนเรยีนาเชลีวิทยาลัย</a></li>
			<?php	}else{ ?>
										<li><a href="./?evaluation_mod=qsa_family_day">กิจกรรม วันครอบครัวโรงเรียนเรยีนาเชลีวิทยาลัย</a></li>
			<?php	} ?>						
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																			
									</ul>								
								</li>
								
								<li class="navigation-header"><span>งานคอนเสิร์ต เรยีนาเชลี</span> <i class="icon-menu" title="Main pages"></i></li>
								<li>
									<a href="#"><i class="icon-magazine"></i> <span>คอนเสิร์ต เรยีนาเชลีวิทยาลัย</span></a>
									<ul>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
			<?php
				    if($copy_evaluation_mod=="concert_pay"){ ?>
										<li class="active"><a href="./?evaluation_mod=concert_pay">ชำระค่าบัตรคอนเสิร์ต </a></li>					
			<?php	}else{ ?>
										<li><a href="./?evaluation_mod=concert_pay">ชำระค่าบัตรคอนเสิร์ต </a></li>					
			<?php	} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
			<?php
				    if($copy_evaluation_mod=="concert_predicate"){ ?>
										<li class="active"><a href="./?evaluation_mod=concert_predicate">สรุปยอดขาย </a></li>					
			<?php	}else{ ?>
										<li><a href="./?evaluation_mod=concert_predicate">สรุปยอดขาย </a></li>					
			<?php	} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																					
									</ul>								
								</li>
								
								<li class="navigation-header"><span>กิจการนักเรียน</span> <i class="icon-menu" title="Main pages"></i></li>
								<li>
									<a href="#"><i class="icon-paint-format"></i> <span>กิจกรรมเรียนเสริมภาคฤดูร้อน</span></a>
									
									<ul>
									
										<li class="navigation-header"><span>การจัดการ</span> <i class="icon-menu" title="Main pages"></i></li>									
		<?php
				if(($copy_evaluation_mod=="summer_pay")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_pay">ชำระค่าธรรมเนียม</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_pay">ชำระค่าธรรมเนียม</a></li>				
		<?php	} ?>																			
										<li class="navigation-header"><span>รายงาน</span> <i class="icon-menu" title="Main pages"></i></li>
		<?php
				if(($copy_evaluation_mod=="summer_expense_report")){ ?>
										<li class="active"><a href="./?evaluation_mod=summer_expense_report">รายงานผู้ชำระค่า</a></li>				
		<?php	}else{ ?>
										<li><a href="./?evaluation_mod=summer_expense_report">รายงานผู้ชำระค่า</a></li>				
		<?php	} ?>																		
									</ul>	
									
								</li>
								
							</ul>
						</div>
					</div>		
					
		<?php   }elseif($group=="G"){ //งานประชาสัมพันธ์ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php   }else{ 
			
				} ?>


