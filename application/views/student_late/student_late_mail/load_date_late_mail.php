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
		if(($width_system>=1200)){
			$grid="lg";
		}elseif(($width_system<=992)){
			$grid="md";
		}elseif(($width_system<=768)){
			$grid="sm";
		}else{
			$grid="xs";
		}
    ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <script>
        $(document).ready(function(){

            $.extend( $.fn.dataTable.defaults, {
                autoWidth: false,
                columnDefs: [{ 
                    orderable: false,
                    width: '100px'
                    //targets: [ 5 ]
                }],
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span>กรอง:</span> _INPUT_',
                    searchPlaceholder: 'พิมพ์เพื่อกรอง...',
                    lengthMenu: '<span>แสดง:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
                },
                drawCallback: function () {
                    $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
                },
                preDrawCallback: function() {
                    $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
                }
            });

            $('.datatable-basic').DataTable({
                'paging'        : true,
                'lengthChange'  : true,
                'searching'     : true,
                'ordering'      : true,
                'info'          : true,
                'autoWidth'     : false,
                'lengthMenu'    :[[-1,25,50,100,250,500],["All",25,50,100,250,500]]
            });

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
            if(($this->session->userdata("rc_user")==null)){
                $this->session->unset_userdata("rc_user");
                exit("<script>window.location='$golink';</script>");
            }else{ 
//----------------------------------------------------------------------------
                include("view/function_class/run_date_time.php");  
                
                include("view/database/pdo_student_late.php");
                include("view/database/class_student_late.php");
                
                include("view/database/pdo_data.php");
                include("view/database/pdo_conndatastu.php");
                include("view/database/pdo_admission.php");
                include("view/database/regina_student.php");
//----------------------------------------------------------------------------
                if((isset($_POST["type_show"]))){
                    $type_show=filter_input(INPUT_POST,'type_show');
                }else{
                    $type_show=null;
                } ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
            <?php
                    if(($type_show=="run")){ 

                        if((isset($_POST["late_mail_search"]))){
                            $late_mail_search=filter_input(INPUT_POST,'late_mail_search');
                        }else{
                            $late_mail_search=null;
                        }

                        if((isset($_POST["count_status"]))){
                            $count_status=filter_input(INPUT_POST,'count_status');
                        }else{
                            $count_status=null;
                        }

                            $DateTime_Late=new SetTimeSL("Row_Id",$late_mail_search,"-");
                            foreach($DateTime_Late->PrintSetTime() as $rc=>$DateTime_Late_Row){

                                if((isset($DateTime_Late_Row["ssy_t"]))){
                                    $ssy_t=$DateTime_Late_Row["ssy_t"];
                                }else{
                                    $ssy_t="-";
                                }
                    
                                if((isset($DateTime_Late_Row["ssy_y"]))){
                                    $ssy_y=$DateTime_Late_Row["ssy_y"];
                                }else{
                                    $ssy_y="-";
                                }

                                if((isset($DateTime_Late_Row["ssy_date_start"]))){
                                    $ssy_date_start=date("Y-m-d",strtotime($DateTime_Late_Row["ssy_date_start"]));
                                }else{
                                    $ssy_date_start="-";
                                }
                    
                                if((isset($DateTime_Late_Row["ssy_date_end"]))){
                                    $ssy_date_end=date("Y-m-d",strtotime($DateTime_Late_Row["ssy_date_end"]));
                                }else{
                                    $ssy_date_end="-";
                                }
                            }

                            $imc_ALL=new count_late_mail("ALL","-",$ssy_date_start,$ssy_date_end);
                            $imc_Status1=new count_late_mail("status","1",$ssy_date_start,$ssy_date_end);
                            $imc_Status2=new count_late_mail("status","2",$ssy_date_start,$ssy_date_end);

                        ?>

                <fildset class="content-group">
                    <div class="row">
                        <div class="col-<?php echo $grid;?>-12">
                            <div class="panel">
                                <div class="panel-heading bg-info">
                                    <h6 class="panel-title">ข้อมูลภาคเรียนที่ <?php echo $ssy_t;?> ปีการศึกษา <?php echo $ssy_y;?> ระหว่างวันที่ <?php echo $ssy_date_start." - ".$ssy_date_end;?></h6>
                                </div>

                                <div class="panel-body">
                                
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
                                        <div class="table-responsive">
                                            <table class="table table-bordered datatable-basic">
                                                <thead>
                                                    <tr>
                                                        <th><div>ลำดับ</div></th>
                                                        <th><div>รหัสนักเรียน</div></th>
                                                        <th><div>ชื่อ-สกุล</div></th>

                    <?php
                        if(($count_status=="B")){
                            $print_out_mail=new ManageSetCountLate("condition","-","-",$count_status,"-");
                            foreach($print_out_mail->CalllMSCL_Print() as $rc=>$out_mail_Row){  ?>
                                                        <th><div><?php echo $out_mail_Row["sscl_CountA"];?></div></th>
                    <?php   }
                        }elseif(($count_status=="A")){

                        }else{}
                    ?>


                                                    </tr>
                                                </thead>
                                                <tbody>
                    <?php 
                            $StudentLateData=new ManageDataSudentLate("Loop_key","-","-","-","-",$ssy_date_start,$ssy_date_end);
                            $CountStudent=0;
                            foreach($StudentLateData->Call_MDSL_Print() as $key=>$StudentLateDataPrint){
                                $CountStudent=$CountStudent+1;  
                                if((isset($StudentLateDataPrint["sls_StuKey"]))){
                                    $PrintStudent_Data=new PrintReginaStuDataClass($StudentLateDataPrint["sls_StuKey"]);  
                                    $SLL_Student_Key=$PrintStudent_Data->PRS_SudId;
                                    $SLL_Student_Name=$PrintStudent_Data->PRS_nameTH;   
                                    
                                    $CLS_TIME=new CountLateStudent('TIME',$SLL_Student_Key,$ssy_date_start,$ssy_date_end);
                                    $count_late=$CLS_TIME->int_student_late;

                                    $Int_Mail=new count_late_mail('Key',$SLL_Student_Key,$ssy_date_start,$ssy_date_end);
                                    $count_mail=$Int_Mail->int_count_late;
                                
                                    $class_student=new RcClassStudent($SLL_Student_Key);
                                    foreach($class_student->RunRcClassStudent() as $rc_key=>$data_class){
                                        if((is_array($data_class) and count($data_class))){
                                            if((isset($data_class["rsc_class"]))){
                                                $PrintLavaL=new PrintLavaL($data_class["rsc_class"]);
                                                $SLL_class=$PrintLavaL->RunPrintLavaL();
                                            }else{
                                                $SLL_class="-";
                                            }
                                            $SLL_room=$data_class["rsc_room"];
                                            $SLL_no=$data_class["rsc_num"];
                                        }else{
                                            $SLL_class="-";
                                            $SLL_room="-";
                                            $SLL_no="-";
                                        }
                                    }
                                }else{
                                    $SLL_Student_Key="-";
                                    $SLL_Student_Name="-";
                                    $SLL_class="-";
                                    $SLL_room="-";
                                    $SLL_no="-";
                                    $count_late="-";
                                    $count_mail="-";
                                } ?>

                                                    <tr>
                                                        <td><div><?php echo $CountStudent;?></div></td>
                                                        <td><div><?php echo $SLL_Student_Key;?></div></td>
                                                        <td><div><?php echo $SLL_Student_Name." ชั้น ".$SLL_class." ห้อง ".$SLL_room." เลขที่ ".$SLL_no;?></div></td>
                        <?php
                            if(($count_status=="B")){
                                $print_out_mail=new ManageSetCountLate("condition","-","-",$count_status,"-");
                                foreach($print_out_mail->CalllMSCL_Print() as $rc=>$out_mail_Row){  ?>

                                                            <td><div></div></td>
                                                            
                        <?php   }
                            }elseif(($count_status=="A")){

                            }else{}
                        ?>
                                                    </tr>
                    <?php  } ?>

                                                </tbody>
                                            </table>
                                        </div>                                        
                                    </fieldset>

                                </div>
                            </div>
                        </div>
                    </div>
                </fildset>



            <?php    }else{ ?>

            <?php    } ?>

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->                
    <?php } ?>