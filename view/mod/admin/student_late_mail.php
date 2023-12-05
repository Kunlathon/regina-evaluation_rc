<?php
    include("view/function_class/run_date_time.php");  

    include("view/database/pdo_student_late.php");
    include("view/database/class_student_late.php");
?>

    <fieldset class="content-group">
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="breadcrumb-line breadcrumb-line-component">
					<ul class="breadcrumb">
						<h4> <span class="text-semibold">นักเรียนมาสาย </span>ออกหนังสือแจ้งเตือนการมาสาย</h4>
					</ul>
					<ul class="breadcrumb-elements">
						<div class="heading-btn-group">
							<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
							<a class="btn btn-link  text-size-small"><span>/</span></a>
							<a class="btn btn-link  text-size-small"><span>ออกหนังสือแจ้งเตือนการมาสาย</span></a>
						</div>
					</ul>
				</div>
			</div>
		</div>
	</fieldset>

    <?php

        if((isset($_POST["manage"]))){
            $manage=filter_input(INPUT_POST,'manage');
        }else{
            if((isset($_GET["manage"]))){
                $manage=filter_input(INPUT_GET,'manage');
            }else{
                $manage="show";
            }
        }  
    
        if(($manage!=null)){
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
        }else{}

            if(($manage=="show")){  ?>

            <fieldset class="content-group">
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="panel panel-body border-top-pink">
                            <div class="form-group">
                                <label class="control-label col-<?php echo $grid;?>-4">เลือกข้อมูลภาคเรียน / ปีการศึกษา</label>
                                <div class="col-<?php echo $grid;?>-8">
                                    <select class="select-search" name="late_mail_search" id="late_mail_search" data-placeholder="เลือกข้อมูลภาคเรียน / ปีการศึกษา...">
                                            <option></option>                                                
                                        <optgroup label="ภาคเรียน / ปีการศึกษา">
        <?php
            $Time_Student_Data=new SetTimeSL("Loop","-","-"); 
                foreach($Time_Student_Data->PrintSetTime() as $rc_key=>$Time_Student_Row){ 
                    
                    if(($ssy_id==$Time_Student_Row["ssy_id"])){
                        $ssy_selected='selected="selected"';
                    }else{
                        $ssy_selected=null;
                    }
                    
                    ?>

                                            <option value="<?php echo $Time_Student_Row["ssy_id"];?>" <?php echo $ssy_selected;?>><?php echo "ภาคเรียนที่ ".$Time_Student_Row["ssy_t"]." ปีการศึกษา ".$Time_Student_Row["ssy_y"]." ".date("d-m-Y",strtotime($Time_Student_Row["ssy_date_start"]))." - ".date("d-m-Y",strtotime($Time_Student_Row["ssy_date_end"]));?></option>
        <?php   } ?>

                                        </optgroup>
                                    </select>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </fildset>

            <div id="Run_lms_data">
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div><i class="icon-spinner2 spinner"></i> <span>กำลังโหลดข้อมูล...</span></div>
                    </div>
                </div>
            </div>

    <?php   }else{  ?>
            
            <fieldset class="content-group">
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="text-center content-group">
                            <h1 class="error-title">404</h1>
                            <h5>Oops, an error has occurred. Page not found!</h5>
                        </div>
                    </div>
                </div>
            </fieldset>

    <?php    } ?>