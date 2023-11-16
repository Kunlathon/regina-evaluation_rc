<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
    <style>
			@font-face {
				font-family: 'surafont_sanukchang';
				src: url('view/font/surafont_sanukchang.eot');
				src: url('view/font/surafont_sanukchang.eot?#iefix') format('embedded-opentype'),
				url('view/font/surafont_sanukchang.woff') format('woff'),
				url('view/font/surafont_sanukchang.ttf') format('truetype');
			}
			body{
					font-family: "surafont_sanukchang";
					font-size: 15px;
			}
	</style>	
<!--****************************************************************************-->
    <script type="text/javascript">
        function setScreenHWCookie() {
            $.cookie('sw',screen.width);
                //$.cookie('sh',screen.height);
            return true;
        }
            setScreenHWCookie();
    </script>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
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
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<script>
        $(document).ready(function(){
            var type_show=$("#type_show").val();
            var copy_date_start=$("#copy_date_start").val();
            var copy_date_end=$("#copy_date_end").val();
                if(type_show==="run"){
                    if(copy_date_start!=="" && copy_date_end!==""){
                        $.post("<?php echo base_url();?>/student_late/load_student_late_data/"+type_show,{
                            type_show:type_show,
                            copy_date_start:copy_date_start,
                            copy_date_end:copy_date_end
                        },function(Run_Print){
                            if(Run_Print!=""){
                                $("#Run_Print").html(Run_Print);
                            }else{}
                        })
                    }else{}
                }else{}
        })
    </script>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <?php
    	$this->load->library('session');
        //----------------------------------------------------------------------------    
            include("view/img_user/document/gotolink.php");//-----------------
            $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
            $golink=$goingtolink->Rungotolink();//----------------------------
        //----------------------------------------------------------------------------
            include("view/function_class/run_date_time.php");  
        
            include("view/database/pdo_student_late.php");
            include("view/database/class_student_late.php");
        
            include("view/database/pdo_data.php");
            include("view/database/pdo_conndatastu.php");
            include("view/database/pdo_admission.php");
            include("view/database/regina_student.php");
        //----------------------------------------------------------------------------
            if($this->session->userdata("rc_user")==null){
                $this->session->unset_userdata("rc_user");
                exit("<script>window.location='$golink';</script>");
            }else{  

                $Time_Student_Set=new SetTimeSL("Row","-","-");    
                foreach($Time_Student_Set->PrintSetTime() as $rc_key=>$Time_Student_Print){
                    
                    if((isset($Time_Student_Print["ssy_id"]))){
                        $ssy_id=$Time_Student_Print["ssy_id"];
                    }else{
                        $ssy_id="-";
                    }
        
                    if((isset($Time_Student_Print["ssy_t"]))){
                        $ssy_t=$Time_Student_Print["ssy_t"];
                    }else{
                        $ssy_t="-";
                    }
        
                    if((isset($Time_Student_Print["ssy_y"]))){
                        $ssy_y=$Time_Student_Print["ssy_y"];
                    }else{
                        $ssy_y="-";
                    }
        
                    if((isset($Time_Student_Print["ssy_date_start"]))){
                        $ssy_date_start=date("Y-m-d",strtotime($Time_Student_Print["ssy_date_start"]));
                    }else{
                        $ssy_date_start="-";
                    }
        
                    if((isset($Time_Student_Print["ssy_date_end"]))){
                        $ssy_date_end=date("Y-m-d",strtotime($Time_Student_Print["ssy_date_end"]));
                    }else{
                        $ssy_date_end="-";
                    }
        
                } 
                
                $set_time_system=new RunDateTime("date_all",$ssy_date_start,$ssy_date_end);

                ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->




    <div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel">
				<div class="panel-heading bg-pink">
					<h6 class="panel-title">ประมวลผลข้อมูลนักเรียนมาสาย ภาคเรียนที่ <?php echo $ssy_t;?> ปีการศึกษา <?php echo $ssy_y;?> </h6>
				</div>

				<div class="panel-body">
		<?php
				if(($set_time_system->Call_DateTime_Start()=="ON")){ 
						$imc_ALL=new count_late_mail("ALL","-",$ssy_date_start,$ssy_date_end);
						$imc_Status1=new count_late_mail("status","1",$ssy_date_start,$ssy_date_end);
						$imc_Status2=new count_late_mail("status","2",$ssy_date_start,$ssy_date_end);
					?>
				
					<fieldset class="content-group">
						<div class="form-group">
							<div class="row">
								<div class="col-<?php echo $grid;?>-4">
									<div class="panel panel-body bg-indigo-400 has-bg-image">
										<div class="media no-margin">
											<div class="media-left media-middle">
												<i class="icon-mailbox icon-3x opacity-75"></i>
											</div>

											<div class="media-body text-right">
												<div style="font-size: 20px" class="no-margin"><?php echo $imc_ALL->int_count_late;?></div>
												<span class="text-uppercase text-size-mini">จำนวนออกจดหมาย</span>
											</div>
										</div>
									</div>						
								</div>
								<div class="col-<?php echo $grid;?>-4">
									<div class="panel panel-body bg-indigo-400 has-bg-image">
										<div class="media no-margin">
											<div class="media-left media-middle">
												<i class="icon-mail5 icon-3x opacity-75"></i>
											</div>

											<div class="media-body text-right">
												<div style="font-size: 20px" class="no-margin"><?php echo $imc_Status1->int_count_late;?></div>
												<span class="text-uppercase text-size-mini">จดหมายยังไม่ได้จัดพิมพ์</span>
											</div>
										</div>
									</div>						
								</div>
								<div class="col-<?php echo $grid;?>-4">
									<div class="panel panel-body bg-indigo-400 has-bg-image">
										<div class="media no-margin">
											<div class="media-left media-middle">
												<i class="icon-mail-read icon-3x opacity-75"></i>
											</div>

											<div class="media-body text-right">
												<div style="font-size: 20px" class="no-margin"><?php echo $imc_Status2->int_count_late;?></div>
												<span class="text-uppercase text-size-mini">จดหมายจัดพิมพ์แล้ว</span>
											</div>
										</div>
									</div>						
								</div>
							</div>
						</div>
					</fieldset>

					<fieldset class="content-group">
						<div class="form-group">
							<div id="Run_Print">
								<div class="row">
									<div class="col-<?php echo $grid;?>-12">
										<div><i class="icon-spinner2 spinner"></i> <span>กำลังโหลดข้อมูล</span></div>
	<input type="hidden" name="type_show" id="type_show" value="run">
    <input type="hidden" name="copy_date_start" id="copy_date_start" value="<?php echo $ssy_date_start;?>">
    <input type="hidden" name="copy_date_end" id="copy_date_end" value="<?php echo $ssy_date_end;?>">
									</div>
								</div>
							</div> 
						</div>
					</fieldset>

		<?php	}elseif(($set_time_system->Call_DateTime_Start()=="OFF")){	?>

					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="text-center content-group">
                                <h1 class="error-title">หมดเวลา</h1>
                                <h5>สิ้นสุดระยะการลงทะเบียนข้อมูลนักเรียนมาสาย ภาคเรียนที่ <?php echo $ssy_t;?> ปีการศึกษา <?php echo $ssy_y;?></h5>
                            </div>  					
						</div>
					</div>

		<?php	}else{} ?>
				</div>
			</div>
		</div>
	</div>

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
     <?php  } ?>