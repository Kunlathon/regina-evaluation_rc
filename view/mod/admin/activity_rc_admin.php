<?php
	include("view/database/pdo_data.php");
	include("view/database/class_pdo.php");	
	
	include("view/database/database_paynew.php");
	include("view/database/class_pay.php");
	
	include("view/database/pdo_activity.php");
	include("view/database/class_activity.php");
	

	$data_yaer=filter_input(INPUT_POST,'ra_year');
	$data_term=filter_input(INPUT_POST,'ra_term');  

	$SudRc=filter_input(INPUT_POST,'ra_sudkey');

	$data_stu=new stu_levelpdo($SudRc,$data_yaer,$data_term);		
			 if(($data_stu->IDLevel>=3 and $data_stu->IDLevel<=3)){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success">
				<strong>ข้อผิดพลาด ! </strong> ระดับชั้น อนุบาล การใช้งานในส่วนนี้ยังไม่เปิดใช้บริการ 
			</div>			
		</div>
	</div><br>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	  <?php }elseif($data_stu->IDLevel>=11 and $data_stu->IDLevel<=13){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success">
				<strong>ข้อผิดพลาด ! </strong> ระดับชั้น อนุบาล การใช้งานในส่วนนี้ยังไม่เปิดใช้บริการ 
			</div>			
		</div>
	</div><br>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
	  <?php }elseif($data_stu->IDLevel>=21 and $data_stu->IDLevel<=42){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--********************************************************************************************-->	
                    <?php
						//time run------------------------------------------------------------------------------------  
							/*$datetime="2022-05-21 00:00:00";
							$datetime_cr=date("Y-m-d H:i:s");
							$datatime_notrun=strtotime($datetime);
							$datatime_run=strtotime($datetime_cr);
								if($datatime_run>=$datatime_notrun){
									$print_runtime="OFF";
								}else{
									$print_runtime="ON";
								}	
							*/	
						//time run End--------------------------------------------------------------------------------
						$print_runtime="ON";
					?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--********************************************************************************************-->  
	  <?php
			switch($print_runtime){
				case "ON": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
<!--********************************************************************************************-->
					<?php
						/*$datetimeON="2022-05-19 18:00:00";	
						$datetime_crON=date("Y-m-d H:i:s");
						//$datetime_crON=$datetimeON;
						$datatime_notrunON=strtotime($datetimeON);
						$datatime_runON=strtotime($datetime_crON);	
						
							if($datatime_runON>=$datatime_notrunON){
								
								$print_runtimeON="ON";
							}else{
								
								$print_runtimeON="OFF";
							}
						*/
						$print_runtimeON="ON";
					?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
<!--********************************************************************************************-->	
				<?php
						if($print_runtimeON=="OFF"){ ?>
<!--/////////////////////////////////////////////////////////////////////-->	
	<!--<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>&nbsp;เริ่มลงทะเบียนวันที่&nbsp;19&nbsp;พฤษภาคม&nbsp;2565&nbsp;เวลา&nbsp;18.00 น.&nbsp;ถึงวันที่&nbsp;20&nbsp;พฤษภาคม&nbsp;2565&nbsp;เวลา&nbsp;23.59 น.
				<!--<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>-->
			</div>			
		</div>
	</div><br>-->							
<!--/////////////////////////////////////////////////////////////////////-->							
				<?php	}else{ ?>
<!--/////////////////////////////////////////////////////////////////////-->	
<!--/////////////////////////////////////////////////////////////////////-->	
					<!--<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-success">
								<div class="panel-heading"><center><h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมกิจกรรมชุมนุม<div id="demoA"></div></h5></center></div>
							</div>
						</div>
					</div><hr>-->
<!--*******************************************************************************************-->	

							<?php
									$activity_key=filter_input(INPUT_POST,'activity_key');
									if($activity_key==""){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-warning">
													<strong>พบข้อผิดพลาด</strong> ไม่สามารถลงทะเบียนกิจกรรมชุมนุมได้ 
												</div>
											</div>
										</div>							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
							<?php	}else{
										$count_SturcActivity=new sturc_activity($SudRc,$data_term,$data_yaer);
										$count_SA=0;
										foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
											$count_SA=$count_SA+1;
										}
											if($count_SA>=1){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
										<div class="row">
											<div class="col-<?php echo $grid;?>-12">
												<div class="alert alert-warning">
													<strong>พบข้อผิดพลาด</strong> ไม่สามารถลงทะเบียนซ้ำได้
												</div>
											</div>
										</div>							
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
							<?php			}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php
				$show_count_all=new activity_count_all($activity_key,$data_term,$data_yaer,"Count_Activity_join");
				$activity_quota=$show_count_all->print_activity_ae_quota();
				$activity_ae_id=$show_count_all->print_activity_ae_id();
				$test_count_all=new check_activity_all($activity_ae_id,$data_term,$data_yaer,$activity_quota);
					if(($test_count_all->test_activity_txt()=="yes")){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
$count_activity=new check_activity($activity_key,$data_term,$data_yaer);
if(($count_activity->ak_txt=="yes")){
    $call_into_activity=new insert_activity_student($SudRc,$data_term,$data_yaer,$activity_key);
    if(($call_into_activity->insert_activity_rc()=="yes")){
        $call_updata_keep=new updata_activity_keep($activity_key,$data_term,$data_yaer,$count_activity->count_ac);
        if(($call_updata_keep->updatato_activiry_keep()=="yes")){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
            <div class="row">
                <div class="col-<?php echo $grid;?>-12">
                    <div class="alert alert-info">
                        <strong>สำเร็จ </strong> ลงทะเบียนกิจกรรมกิจกรรมชุมนุมเรียบร้อยแล้ว
                    </div>
                </div>
            </div>	
            <div class="row">
                <div class="col-<?php echo $grid;?>-12">
                    <form action="./?evaluation_mod=register_activity" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                        
                        <center>
                            <button type="submit" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button>																	
                            <button type="button" id="GoToHome" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button>
                        </center>	
                        
                        <input type="hidden" name="ra_year" value="<?php echo $data_yaer;?>">
                        <input type="hidden" name="ra_term" value="<?php echo $data_term;?>">
                        <input type="hidden" name="ra_sudkey" value="<?php echo $SudRc;?>">																			
                    
                    </form>


                    
                    

                    
                </div>
            </div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<?php
if($db_evaluationID=="127.0.0.1"){
//****************************
}else{
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("Asia/Bangkok");

$sToken = "suuY6cfHw1R6uOxqgaEbVkdj4TCtYhBpkdh9zaQXJnl";
$sMessage ="รหัส:".$user_login."ชื่อผู้ใช้งานระบบ:".$myname."กลุ่ม:".$group."ลงทะเบียนกิจกรรมชุมนุมเรียบร้อยแล้ว รหัสกิจกรรม ".$activity_key." ".$data_term." / ".$data_yaer." IP:".$db_evaluationID;


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
<!--**************************************************************-->																	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																		
<?php		}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
            <div class="row">
                <div class="col-<?php echo $grid;?>-12">
                    <div class="alert alert-info">
                        <strong>ไม่สำเร็จ </strong> เกิดข้อผิดพลาดการลงทะเบียนกิจกรรมชุมนุม
                    </div>
                </div>
            </div>	
            <div class="row">
                <div class="col-<?php echo $grid;?>-12">
                    
                    <center>
                        <button type="button" id="GoTo" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button>																		
                        <button type="button" id="GoToHome" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button>
                    </center>
                    
                </div>
            </div>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																	
<?php		}
    }else{
        //************************************************************
    }
}else{ ?>
    <div class="row">
        <div class="col-<?php echo $grid;?>-12">																																			
            <div class="alert alert-warning">
                <strong>กิจกรรมนี้มีนักเรียนลงทะเบียนครบตามจำนวนแล้ว </strong>  ไม่สามารถลงทะเบียนเพิ่มได้
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-<?php echo $grid;?>-12">	
            <center>
                <button id="GoTo" type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button>																		
                <button id="GoToHome" type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button>
            </center>
        </div>
    </div>
<?php	}      ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
        <div class="col-<?php echo $grid;?>-12">																																			
            <div class="alert alert-warning">
                <strong>กิจกรรมนี้มีนักเรียนลงทะเบียนครบตามจำนวนแล้ว </strong>  ไม่สามารถลงทะเบียนเพิ่มได้
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-<?php echo $grid;?>-12">	
            <center>
                <button id="GoTo" type="button" class="btn btn-warning btn-lg">กลับหน้าลงทะเบียนกิจกรรมชุมนุม</button>																		
                <button id="GoToHome" type="button" class="btn btn-default btn-lg">หน้าสู่เมนูหลัก</button>
            </center>
        </div>
    </div>						
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php	} ?>


							<?php			}
									}   ?>						
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->		
				<?php }       ?>
<!--/////////////////////////////////////////////////////////////////////-->					
<!--*******************************************************************************************-->	

<!--*******************************************************************************************-->
<!--*******************************************************************************************-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		break;
				case "OFF": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--/////////////////////////////////////////////////////////////////////-->	
<!--/////////////////////////////////////////////////////////////////////-->	
	<!--<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>หมดเวลาลงทะเบียน </strong> ลงทะเบียนกิจกรรมชุมนุม ตั้งแต่วันนี้เป็นต้นไป  
			</div>			
		</div>
	</div><br>-->						
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		break;   
				default: ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	  <?php		}        ?>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->  
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		  
	<?php 	}elseif($data_stu->IDLevel==43){ ?>
<!--*******************************************************************************************-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>ข้อผิดพลาด ! </strong> ระดับชั้น มัธยมศึกษาปีที่ 6 การใช้งานในส่วนนี้ยังไม่เปิดใช้บริการ 
			</div>			
		</div>
	</div><br>	
<!--*******************************************************************************************-->		  
	<?php	}else{ ?>
<!--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+-+-+->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
				<strong>พบข้อผิดพลาด </strong> ไม่สามารถใช้งานได้ มีข้อสังสัยกรุณาติดต่อสอบถามได้ที่ งาน ฝ่าย ICT 053-282395 ต่อ 123 
			</div>			
		</div>
	</div><br>	
			
<!--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+--+-+-+-+-+-+-+-+->			
<?php		}	   ?>






	










