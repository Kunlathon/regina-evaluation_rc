<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
	include("view/database/pdo_quota.php");
	include("view/database/pdo_data.php");
	include("view/database/class_quota.php");
	
	include("view/database/pdo_weekend.php");
	include("view/database/class_weekend.php");
//--------------------------------------------------------------------
    $Wut=filter_input(INPUT_POST,'Wut');
    $Wuy=filter_input(INPUT_POST,'Wuy');
    $Wuc=filter_input(INPUT_POST,'Wuc');
//--------------------------------------------------------------------
		if($this->session->userdata("rc_user")==null){
			$this->session->unset_userdata("rc_user");
			exit("<script>window.location='$golink/print_imgstu/error';</script>");
		}else{ 			
			if(isset($Wut,$Wuy,$Wuc)){ ?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
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
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<?php
			$WeekendPrint=new WeekendSystem($Wuc);
			foreach($WeekendPrint->RunWeekendSystem() as $rc=>$WeekendPrintRow){
				$WsKey=$WeekendPrintRow["ws_key"];
				$WsClassA=$WeekendPrintRow["ws_classA"];
				$WsClassB=$WeekendPrintRow["ws_classB"];
				$WsTestTime=$WeekendPrintRow["ws_test_time"];
				$WsTestClass=$WeekendPrintRow["ws_test_class"];
				$WdKey=$WeekendPrintRow["weekend_discount_wd_key"];
			}
				if($WsTestTime=="Y" and $WsTestClass=="N"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
		<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
			<div class=" col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">RC&nbsp;Happy&nbsp;Weekend</div>
					<div class="panel-body">
					
				<?php
						$WC_CountC=20200;
						$CallWeekendA=new PrintWeekendA($Wuc,$Wuy,$Wut,'ALL');
						foreach($CallWeekendA->RunPrintWeekendA() as $rc=>$CallWeekendARow){ ?>
						
							<div class="col-<?php echo $grid;?>-4" style="font-family: surafont_sanukchang; font-size: 14px;">
								<div class="panel panel-body border-top-pink">
									<div class="text-center"><?php echo $CallWeekendARow["wc_txt"];?></div>
									<ul>
										<li>ค่าลงทะเบียน&nbsp;<?php echo number_format($CallWeekendARow["wc_pay"], 2, '.', ',');?></li>
										<li>เวลาเรียน&nbsp;<?php echo $CallWeekendARow["wct_timeA"];?>&nbsp;ถึง&nbsp;<?php echo $CallWeekendARow["wct_timeB"];?></li>
										<li>จำนวน&nbsp;<?php echo $CallWeekendARow["wc_count"];?>&nbsp;คน</li>
									</ul>
					<?php
						$TestWeekendCount=new TestWeekendCountB($CallWeekendARow["wc_key"],$Wut,$Wuy,$CallWeekendARow["wct_key"]);
							if($TestWeekendCount->RunTestWeekendCount()=="N"){ ?>
									<div class="text-center"><button type="button" class="btn btn-info disabled">ว่าง</button></div>
					<?php	}elseif($TestWeekendCount->RunTestWeekendCount()=="Y"){ ?>
									<div class="text-center"><button type="button" class="btn btn-danger disabled">เต็ม</button></div>
					<?php	}else{ 
								//-------------------------------------------------------------------------
							}
					?>											
									
									
									
								</div>
							</div>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
				<?php	$WC_CountC=$WC_CountC+1;
						} ?>						
					
		
					</div>
				</div>
			</div>
		</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<?php	}elseif($WsTestTime=="N" and $WsTestClass=="Y"){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div class="col-<?php echo $grid;?>-12">
			<div class="container">                 
				<ul class="pager">
					<li><a data-toggle="tab" href="#weekend_A">เลือกเรียนทั้งวัน</a></li>
					<li><a data-toggle="tab" href="#weekend_B">เลือกเรียนครึ่งวัน</a></li>
				</ul>
			</div>
		</div>
	</div><hr>
	
	<div class="tab-content" style="font-family: surafont_sanukchang; font-size: 16px;">
		<div id="weekend_A" class="tab-pane fade">
			
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-success">
					<div class="panel-heading">RC&nbsp;Happy&nbsp;Weekend&nbsp;:&nbsp;เรียนทั้งวัน</div>
					<div class="panel-body">
					

					
					
					
						<div class="row">	
						
						
				<?php	
						//$WC_CountA=10100;
						$RunWeekendA=new PrintWeekendA($Wuc,$Wuy,$Wut,'1');
						foreach($RunWeekendA->RunPrintWeekendA() as $rc=>$RunWeekendARow){ ?>
						
							<div class="col-<?php echo $grid;?>-4" style="font-family: surafont_sanukchang; font-size: 14px;">
								<div class="panel panel-body border-top-pink">
									<div class="text-center"><?php echo $RunWeekendARow["wc_txt"];?></div>
									<ul>
										<li>ค่าลงทะเบียน&nbsp;<?php echo number_format($RunWeekendARow["wc_pay"], 2, '.', ',');?></li>
										<li>เวลาเรียน&nbsp;<?php echo $RunWeekendARow["wct_timeA"];?>&nbsp;ถึง&nbsp;<?php echo $RunWeekendARow["wct_timeB"];?></li>
									</ul>
										<input type="hidden" name="Wc_TestKey" id="Wc_TestKey" value="<?php echo $RunWeekendARow["wc_key"];?>">
										
									<div style="font-family: surafont_sanukchang; font-size: 12px;">*หมายเหตุ กรณีเลือกเรียนเต็มวัน ภาคเช้ารายวิชา / กิจกรรม นี้ ต้องเรียนทุกคน</div>
								</div>
							</div>	
				<?php		} ?>
						
						
				<?php	
						$WC_CountA=10100;
						$CallWeekendA=new PrintWeekendA($Wuc,$Wuy,$Wut,'2');
						foreach($CallWeekendA->RunPrintWeekendA() as $rc=>$CallWeekendARow){ ?>
						
							<div class="col-<?php echo $grid;?>-4" style="font-family: surafont_sanukchang; font-size: 14px;">
								<div class="panel panel-body border-top-pink">
									<div class="text-center"><?php echo $CallWeekendARow["wc_txt"];?></div>
									<ul>
										<li>ค่าลงทะเบียน&nbsp;<?php echo number_format($CallWeekendARow["wc_pay"], 2, '.', ',');?></li>
										<li>เวลาเรียน&nbsp;<?php echo $CallWeekendARow["wct_timeA"];?>&nbsp;ถึง&nbsp;<?php echo $CallWeekendARow["wct_timeB"];?></li>
										<li>จำนวน&nbsp;<?php echo $CallWeekendARow["wc_count"];?>&nbsp;คน</li>
									</ul>
					<?php
						$TestWeekendCount=new TestWeekendCountB($CallWeekendARow["wc_key"],$Wut,$Wuy,$CallWeekendARow["wct_key"]);
							if($TestWeekendCount->RunTestWeekendCount()=="N"){ ?>
									<div class="text-center"><button type="button" class="btn btn-info disabled">ว่าง</button></div>
					<?php	}elseif($TestWeekendCount->RunTestWeekendCount()=="Y"){ ?>
									<div class="text-center"><button type="button" class="btn btn-danger disabled">เต็ม</button></div>
					<?php	}else{ 
								//-------------------------------------------------------------------------
							}
					?>					
									
								</div>
							</div>		
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
				<?php		$WC_CountA=$WC_CountA+1;
						}?>


						</div>

					
					</div>
				</div>
			</div>
			
						
			
		</div>
		<div id="weekend_B" class="tab-pane fade">
			
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">RC&nbsp;Happy&nbsp;Weekend&nbsp;:&nbsp;เรียนครึ่งวัน</div>
					<div class="panel-body">
					
				<?php
						$WC_CountB=10200;
						$CallWeekendA=new PrintWeekendA($Wuc,$Wuy,$Wut,'ALL');
						foreach($CallWeekendA->RunPrintWeekendA() as $rc=>$CallWeekendARow){ ?>
						
							<div class="col-<?php echo $grid;?>-4" style="font-family: surafont_sanukchang; font-size: 14px;">
								<div class="panel panel-body border-top-pink">
									<div class="text-center"><?php echo $CallWeekendARow["wc_txt"];?></div>
									<ul>
										<li>ค่าลงทะเบียน&nbsp;<?php echo number_format($CallWeekendARow["wc_pay"], 2, '.', ',');?></li>
										<li>เวลาเรียน&nbsp;<?php echo $CallWeekendARow["wct_timeA"];?>&nbsp;ถึง&nbsp;<?php echo $CallWeekendARow["wct_timeB"];?></li>
										
					<?php
							if($CallWeekendARow["weekend_class_type_wt_on"]==1){ ?>
							
					<?php	}else{ ?>
										<li>จำนวน&nbsp;<?php echo $CallWeekendARow["wc_count"];?>&nbsp;คน</li>
					<?php	} ?>					
										
										
									</ul>
					<?php
						$TestWeekendCount=new TestWeekendCountB($CallWeekendARow["wc_key"],$Wut,$Wuy,$CallWeekendARow["wct_key"]);
							if($TestWeekendCount->RunTestWeekendCount()=="N"){ ?>
									<div class="text-center"><button type="button" class="btn btn-info disabled">ว่าง</button></div>
					<?php	}elseif($TestWeekendCount->RunTestWeekendCount()=="Y"){ ?>
									<div class="text-center"><button type="button" class="btn btn-danger disabled">เต็ม</button></div>
					<?php	}else{ 
								//-------------------------------------------------------------------------
							}
					?>											
									
									
									
								</div>
							</div>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
				<?php	$WC_CountB=$WC_CountB+1;
						} ?>						
					
						
					</div>
				</div>
			</div>		
				
		</div>
	</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php   }else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-warning alert-styled-left">			
				<span class="text-semibold">แจ้งเตือนจากระบบ!</span> ระดับชั้นนี้&nbsp;ไม่มีสิทธิ์เข้าถึงบริการนี้...
			</div>		
		</div>
	</div>						
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--> 			
		<?php   }?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{
				$this->session->unset_userdata("rc_user");
				exit("<script>window.location='$golink/print_imgstu/error';</script>");				
			}
}?>

