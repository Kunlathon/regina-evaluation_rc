<?php
 	include("view/function_class/run_date_time.php");  

	include("view/database/pdo_student_late.php");
	include("view/database/class_student_late.php");
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">นักเรียนมาสาย </span>การจัดการข้อมูลนักเรียนมาสาย</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>การจัดการข้อมูลนักเรียนมาสาย</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

    <?php
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
            if((isset($_POST["manage"]))){
                $manage=filter_input(INPUT_POST,'manage');
            }else{
                if((isset($_GET["manage"]))){
                    $manage=filter_input(INPUT_GET,'manage');
                }else{
                    $manage="add_file";
                }
            }   ?>


            <div class="row">
                <div class="col-<?php echo $grid;?>-12">
                    <div class="btn-group">
					    <label>
<form name="form_manage_add_file" id="form_manage_add_file"  method="post" action="<?php echo base_url();?>?evaluation_mod=student_late_save">
					        <button type="submit" name="submit_manage_add_file" id="submit_manage_add_file" class="btn bg-primary-700">เพิ่มข้อมูล ไฟส์นำเข้า</button>
                            <input type="hidden" name="manage" id="manage" value="add_file">
</form>										
						</label>

						<label>
<form name="form_manage_add" id="form_manage_add"  method="post" action="<?php echo base_url();?>?evaluation_mod=student_late_save">
					        <button type="submit" name="submit_manage_add" id="submit_manage_add" class="btn bg-info-700">เพิ่มข้อมูล รายบุคคล</button>
                            <input type="hidden" name="manage" id="manage" value="add">
</form>										
						</label>

						<label>
<form name="form_manage_show" id="form_manage_show"  method="post" action="<?php echo base_url();?>?evaluation_mod=student_late_save">
					        <button type="submit" name="submit_manage_add" id="submit_manage_add" class="btn bg-info-700">ข้อมูลรายชื่อนักเรียนมาสาย</button>
                            <input type="hidden" name="manage" id="manage" value="show">
</form>										
						</label>
					</div>            
                </div>
            </div><br>


    
   


    <?php    if(($manage=="add_file")){  ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
            <?php
                    if(($set_time_system->Call_DateTime_Start()=="ON")){ ?>

            <div class="row">
                <div class="col-<?php echo $grid;?>-12">
                    <div class="tabbable tab-content-bordered">
                        <ul class="nav nav-tabs bg-pink">
                            <li class="active"><a href="#student_late-tab1" data-toggle="tab">บันทึกข้อมูลนักเรียนมาสาย</a></li>
                            <li><a href="#student_late-tab2" data-toggle="tab">คำแนะนำ</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active has-padding" id="student_late-tab1">
<form name="form_studnt_late_save_add_file" id="form_studnt_late_save_add_file" action="<?php echo base_url();?>/?evaluation_mod=student_late_save" method="post" enctype="multipart/form-data" >
                                <div class="row">
                                    <div class="col-<?php echo $grid;?>-6">
                                        <fieldset class="content-group">
                                            <div class="form-group">
                                                <label class="control-label col-<?php echo $grid;?>-5">ไฟส์อัพโหลดข้อมูลนักเรียนมาสาย</label>
                                                <div class="col-<?php echo $grid;?>-7">
                                                <button type="button" name="load_file_sl" id="load_file_sl" class="btn bg-teal"  title="ดาวน์โหลดไฟส์นำเข้า" data-placement="bottom" data-container="body" value="Load"><i class=" icon-file-word"></i></button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-<?php echo $grid;?>-6">
                                        <fieldset class="content-group">
                                            <div class="form-group">
                                                <label class="control-label col-<?php echo $grid;?>-2">นำเข้าไฟส์</label>
                                                <div class="col-<?php echo $grid;?>-10">
                                                    <input type="file" name="student_key" id="student_key" class="file-input" data-show-remove="true" data-show-caption="true" data-show-upload="false">
                                                    <div id="student_key-null">
                                                        <span class="help-block">นานสกุลไฟส์<code>file-input</code>.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-<?php echo $grid;?>-12">
                                        <fieldset class="content-group">
                                            <div class="row">
                                                <div class="col-<?php echo $grid;?>-12">
                                                    <button type="button" name="button_save_up" id="button_save_up" class="btn btn-success">บันทึก / Save</button>
                                                    <button type="button" name="button_delete" id="button_delete" class="btn btn-info">ลบ / Delete</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
            <input type="hidden" name="manage" id="manage" value="into_excel">
</form>
                            </div>

                            <div class="tab-pane has-padding" id="student_late-tab2">
                                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php   }elseif(($set_time_system->Call_DateTime_Start()=="OFF")){ ?>

                    <div class="row">
                        <div class="col-<?php echo $grid;?>-12">
                            <div class="text-center content-group">
                                <h1 class="error-title">หมดเวลา</h1>
                                <h5>สิ้นสุดระยะการลงทะเบียนข้อมูลนักเรียนมาสาย ภาคเรียนที่ <?php echo $ssy_t;?> ปีการศึกษา <?php echo $ssy_y;?></h5>
                            </div>                
                        </div>
                    </div>

            <?php   }else{ ?>

            <?php   } ?>

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <?php   }elseif(($manage=="add")){   ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
        <?php
                 if(($set_time_system->Call_DateTime_Start()=="ON")){ ?>

        <?php    }elseif(($set_time_system->Call_DateTime_Start()=="OFF")){ ?>
                    <div class="row">
                        <div class="col-<?php echo $grid;?>-12">
                            <div class="text-center content-group">
                                <h1 class="error-title">หมดเวลา</h1>
                                <h5>สิ้นสุดระยะการลงทะเบียนข้อมูลนักเรียนมาสาย ภาคเรียนที่ <?php echo $ssy_t;?> ปีการศึกษา <?php echo $ssy_y;?></h5>
                            </div>                
                        </div>
                    </div>
        <?php    }else{} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <?php   }elseif(($manage=="show")){  ?>

            <div class="row">
                <div class="col-<?php echo $grid;?>-12">
                    <div class="panel panel-body border-top-pink">
                        <div class="row">
                            <div class="col-<?php echo $grid;?>-12">
                                <fieldset class="content-group">
                                    <div class="form-group">
										<label class="control-label col-<?php echo $grid;?>-4">เลือกข้อมูลภาคเรียน / ปีการศึกษา</label>
										<div class="col-<?php echo $grid;?>-8">
                                            <select class="select-search" name="late_search" id="late_search" data-placeholder="เลือกข้อมูลภาคเรียน / ปีการศึกษา...">
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
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-<?php echo $grid;?>-12">
                    <div class="panel">
					    <div class="panel-heading bg-pink">
							<h6 class="panel-title">รายการข้อมูลนักเรียน</h6>
						</div>

							<div class="panel-body">
								
                                <div class="row">
                                    <div class="col-<?php echo $grid;?>-12">
                                        <div id="Run_Print">
                                            <div><i class="icon-spinner2 spinner"></i> <span>กำลังโหลดข้อมูล</span></div>
    <input type="hidden" name="type_show" id="type_show" value="run">
    <input type="hidden" name="copy_date_start" id="copy_date_start" value="<?php echo $ssy_date_start;?>">
    <input type="hidden" name="copy_date_end" id="copy_date_end" value="<?php echo $ssy_date_end;?>">
                                        </div>
                                    </div>
                                </div>

							</div>

					</div>           
                </div>
            </div>

    <?php   }elseif(($manage=="into_excel")){ ?>

        <?php
            if(($set_time_system->Call_DateTime_Start()=="ON")){

/** PHPExcel */
                require_once 'view/js_css_code/PHPExcel-1.8/Classes/PHPExcel.php';
/** PHPExcel_IOFactory - Reader */
                include 'view/js_css_code/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';  
            
                $student_key=$_FILES["student_key"]["tmp_name"];
                
                $inputFileName = $student_key;  
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);  
                $objReader->setReadDataOnly(true);  
                $objPHPExcel = $objReader->load($inputFileName); 																		 

                $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                $highestRow = $objWorksheet->getHighestRow();
                $highestColumn = $objWorksheet->getHighestColumn();

                $headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
                $headingsArray = $headingsArray[1];

                $r = -1;
                $namedDataArray = array();
                for ($row = 2; $row <= $highestRow; ++$row) {
                    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
                    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                        ++$r;
                        foreach($headingsArray as $columnKey => $columnHeading) {
                            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                        }
                    }else{}
                }			
/** PHPExcel End***********************/ ?>

            <div class="row">
                <div class="col-<?php echo $grid;?>-12">
                    <div class="panel bg-indigo">
                        <div class="panel-heading">
                            <h6 class="panel-title">ประมวลผลการนำเข้าข้อมูล</h6>
                        </div>

                        <div class="panel-body">
                                            
                    <?php
                        $student_count=0;
                        $null_count=0;
                        $save_count=0;
                        $duplicate_count=0;
                        $error_count=0;
                        foreach($namedDataArray as $Student_Row){

                            if((isset($Student_Row["วันที่สาย Ep.(05/11/2560)"]))){

                                //$DateLate=$Student_Row["วันที่สาย Ep.(05/11/2560)"];

                                //$dateString = '$Student_Row["วันที่สาย Ep.(05/11/2560)"]';
                                $dateObject = DateTime::createFromFormat('d/m/Y', $Student_Row["วันที่สาย Ep.(05/11/2560)"]);
                                $DateLate = $dateObject->format('d/m/Y');
                                
                                $DateLate=str_replace("/","-",$DateLate);
                                $DateLate= date("Y-m-d",strtotime("-543 year",strtotime($DateLate)));
                              
                            }else{
                                $DateLate="-";
                            }
                          
                            if((isset($Student_Row["เลขประจำตัว"]))){
                                $Student_Key=$Student_Row["เลขประจำตัว"];
                            }else{
                                $Student_Key="-";
                            }

                            if(($Student_Key!="-" and $DateLate!="-")){
                                $copy_Student_Key=$Student_Key;
                                $null_count=$null_count+1;
                            }else{
                                $null_count=$null_count+0;                               
                            }
                                
                            if(($Student_Key=="-" and $DateLate!="-")){
                                $Student_Key=$copy_Student_Key;
                                $null_count=$null_count+1;
                            }else{
                                $null_count=$null_count+0;  
                            }


                           //echo $Student_Key."->".$DateLate."<br>"; 

                           $AddFile_Student=new ManageDataSudentLate("add_time",$DateLate,$Student_Key,$user_login,$ssy_id,$ssy_date_start,$ssy_date_end);

                                if(($AddFile_Student->Call_MDSL_Error()=="NoError")){
                                    $save_count=$save_count+1;
                                }elseif(($AddFile_Student->Call_MDSL_Error()=="Error")){
                                    $duplicate_count=$duplicate_count+1;
                                }else{
                                    $error_count=$error_count+1;
                                }
                                

                            $student_count=$student_count+1;
                        }
                    ?>
                
                            <div class="row">
                                <div class="col-<?php echo $grid;?>-12">
                            
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><div>ทั้งหมด</div></th>
                                                <th><div><?php echo $student_count;?></div></th>
                                            </tr>
                                            <tr>
                                                <th><div>ค่าว่าง</div></th>                
                                                <th><div><?php echo $null_count;?></div></th>

                                            </tr>
                                            <tr>
                                                <th><div>พบข้อผิกพลาด</div></th>                
                                                <th><div><?php echo $error_count;?></div></th>

                                            </tr>
                                            <tr>
                                                <th><div>บันทึกสำเร็จ</div></th>                
                                                <th><div><?php echo $save_count;?></div></th>

                                            </tr>
                                            <tr>
                                                <th><div>ข้อมูลซ้ำ</div></th>              
                                                <th><div><?php echo $duplicate_count;?></div></th>
                                            </tr>
                                        </thead>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>




    <?php   }elseif(($set_time_system->Call_DateTime_Start()=="OFF")){ ?>

                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="text-center content-group">
                            <h1 class="error-title">หมดเวลา</h1>
                            <h5>สิ้นสุดระยะการลงทะเบียนข้อมูลนักเรียนมาสาย ภาคเรียนที่ <?php echo $ssy_t;?> ปีการศึกษา <?php echo $ssy_y;?></h5>
                        </div>                
                    </div>
                </div>

    <?php   }else{

            }




        ?>



    <?php   }else{  ?>

    
            

    <?php   } ?>

