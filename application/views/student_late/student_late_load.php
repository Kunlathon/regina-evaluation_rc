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

    <script>
        $(document).ready(function(){

            $.extend( $.fn.dataTable.defaults, {
                autoWidth: false,
                columnDefs: [{ 
                    orderable: false,
                    width: '100px',
                    targets: [ 5 ]
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
            
            if((isset($_POST["type_show"]))){
                $type_show=filter_input(INPUT_POST,'type_show');
            }else{
                $type_show=null;
            }

            ?>

            <?php
                     if(($type_show=="run")){   ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
            <?php
                        if((isset($_POST["copy_date_start"]))){
                            $cds_date=filter_input(INPUT_POST,'copy_date_start');
                        }else{
                            $cds_date=null;
                        }
                        
                        if((isset($_POST["copy_date_end"]))){
                            $cde_date=filter_input(INPUT_POST,'copy_date_end');
                        }else{
                            $cde_date=null;
                        }
            ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
        <div class="row">
            <div class="col-<?php echo $grid;?>-12">
                <div class="table-responsive">
                    <table class="table table-condensed datatable-basic">
                        <thead>
                            <tr>
                                <th><div>ลำดับ</div></th>
                                <th><div>รหัส</div></th>
                                <th><div>ชื่อ - สกุล</div></th>
                                <th><div>ระดับชั้น</div></th>
                                <th><div>ห้อง</div></th>
                                <th><div>เลขที่</div></th>
                                <th><div>วันที่มาสาย</div></th>
                                <th><div>การจัดการ</div></th>
                            </tr>
                            </thead>
                            <tbody>
            <?php
                    $StudentLateData=new ManageDataSudentLate("Loop_id","-","-","-","-",$cds_date,$cde_date);
                    $CountStudent=0;
                    foreach($StudentLateData->Call_MDSL_Print() as $key=>$StudentLateDataPrint){    
                        $CountStudent=$CountStudent+1;                   
                            if((isset($StudentLateDataPrint["sls_StuKey"]))){
                                $PrintStudent_Data=new PrintReginaStuDataClass($StudentLateDataPrint["sls_StuKey"]);  
                                $SLL_Student_Key=$PrintStudent_Data->PRS_SudId;
                                $SLL_Student_Name=$PrintStudent_Data->PRS_nameTH;         
                                $date_late=$StudentLateDataPrint["sls_DateLate"];
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
                                $date_late="0000-00-00";
                            }                  


                        ?>
                            <tr>
                                <td><div><?php echo $CountStudent;?></div></td>
                                <td><div><?php echo $SLL_Student_Key;?></div></td>
                                <td><div><?php echo $SLL_Student_Name;?></div></td>
                                <td>
                                    <div>    
                                        <?php 
                                            if((isset($SLL_class))){
                                                echo $SLL_class;
                                            }else{
                                                echo "-";
                                            }
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <?php 
                                            if((isset($SLL_room))){
                                                echo $SLL_room;
                                            }else{
                                                echo "-";
                                            }
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <?php 
                                            if((isset($SLL_no))){
                                                echo $SLL_no;
                                            }else{
                                                echo "-";
                                            } ?>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <?php echo $date_late;?>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <ul class="pager">
                                            <li><button type="button" class="btn btn-primary btn-icon"><i class="icon-search4"></i></button></li>
                                            <li>
                                                <input type="hidden" name="sutdent_key<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>" id="sutdent_key<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>" value="<?php echo $StudentLateDataPrint["sls_StuKey"];?>">
                                                <input type="hidden" name="sutdent_date<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>" id="sutdent_date<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>" value="<?php echo $StudentLateDataPrint["sls_DateLate"];?>">
                                                <button type="button" class="btn btn-danger btn-icon" name="button_delete<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>" id="button_delete<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>"><i class="icon-trash"></i></button></li>
                                        </ul>
                                    </div>                               
                                </td>
                            </tr>
            <?php     

                    } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>




            <?php
                    $StudentLateData=new ManageDataSudentLate("Loop_id","-","-","-","-",$cds_date,$cde_date);
                    $CountStudent=0;
                    foreach($StudentLateData->Call_MDSL_Print() as $key=>$StudentLateDataPrint){
                        if((isset($StudentLateDataPrint["sls_StuKey"]))){   ?>

        <script>
            $(document).ready(function(){
                var sutdent_key=$("#sutdent_key<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>").val();
                var sutdent_date=$("#sutdent_date<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>").val();
                var action="delete";
                $('#button_delete<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>').on('click', function() {
                    swal({
                        title: "ลบข้อมูล",
                        text: "ต้องการลบข้อมูล รหัส "+sutdent_key+sutdent_date,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#EF5350",
                        confirmButtonText: "ใช่, ต้องการลบ!",
                        cancelButtonText: "ไม่, ไม่ต้องการลบ!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm){
                        if (isConfirm){

                            $.post("<?php echo base_url();?>/student_late/student_late_save",{
                                sutdent_key:sutdent_key,
                                sutdent_date:sutdent_date,
                                action:action
                            },function(rc_code){
                                var code_mode=rc_code.trim();
                                    if(code_mode==="NoError"){
                                        swal({
                                            title: "ลบสำเร็จ",
                                            confirmButtonColor: "#66BB6A",
                                            type: "success"
                                        },function(){
                                            location.reload();
                                        });
                                    }else if(code_mode==="Error"){
                                        swal({
                                            title: "ลบไม่สำเร็จ",
                                            confirmButtonColor: "#2196F3",
                                            type: "error"
                                        });
                                    }else{
                                        swal({
                                            title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
                                            //text: ""+code_mode,
                                            confirmButtonColor: "#2196F3",
                                            type: "error"
                                        });
                                    }
                            })

                        }else{
                            swal({
                                title: "ยกเลิกการลบข้อมูล",
                                confirmButtonColor: "#2196F3",
                                type: "error"
                            });
                        }
                    });
                });
            })
        </script>

            <?php       }else{}

                    } ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
            <?php    }elseif(($type_show=="search")){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
            <?php
                        if((isset($_POST["txt_search"]))){
                            $txt_search=filter_input(INPUT_POST,"txt_search");
                        }else{
                            $txt_search=null;
                        }
                        $data_late_date=new SetTimeSL("Row_Id",$txt_search,"-");
                        foreach($data_late_date->PrintSetTime() as $rc=>$data_late_date_print){
                            if((isset($data_late_date_print["ssy_date_start"]))){
                                $cds_date=$data_late_date_print["ssy_date_start"];
                            }else{
                                $cds_date=null;
                            }

                            if((isset($data_late_date_print["ssy_date_end"]))){
                                $cde_date=$data_late_date_print["ssy_date_end"];
                            }else{
                                $cde_date=null;
                            }
                        }
            ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
        <div class="row">
            <div class="col-<?php echo $grid;?>-12">
                <div class="table-responsive">
                    <table class="table table-condensed datatable-basic">
                        <thead>
                            <tr>
                                <th><div>ลำดับ</div></th>
                                <th><div>รหัส</div></th>
                                <th><div>ชื่อ - สกุล</div></th>
                                <th><div>ระดับชั้น</div></th>
                                <th><div>ห้อง</div></th>
                                <th><div>เลขที่</div></th>
                                <th><div>วันที่มาสาย</div></th>
                                <th><div>การจัดการ</div></th>
                            </tr>
                            </thead>
                            <tbody>
            <?php
                    $StudentLateData=new ManageDataSudentLate("Loop_id","-","-","-","-",$cds_date,$cde_date);
                    $CountStudent=0;
                    foreach($StudentLateData->Call_MDSL_Print() as $key=>$StudentLateDataPrint){    
                        $CountStudent=$CountStudent+1;                   
                            if((isset($StudentLateDataPrint["sls_StuKey"]))){
                                $PrintStudent_Data=new PrintReginaStuDataClass($StudentLateDataPrint["sls_StuKey"]);  
                                $SLL_Student_Key=$PrintStudent_Data->PRS_SudId;
                                $SLL_Student_Name=$PrintStudent_Data->PRS_nameTH;         
                                $date_late=$StudentLateDataPrint["sls_DateLate"];
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
                                $date_late="0000-00-00";
                            }                  


                        ?>
                            <tr>
                                <td><div><?php echo $CountStudent;?></div></td>
                                <td><div><?php echo $SLL_Student_Key;?></div></td>
                                <td><div><?php echo $SLL_Student_Name;?></div></td>
                                <td>
                                    <div>    
                                        <?php 
                                            if((isset($SLL_class))){
                                                echo $SLL_class;
                                            }else{
                                                echo "-";
                                            }
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <?php 
                                            if((isset($SLL_room))){
                                                echo $SLL_room;
                                            }else{
                                                echo "-";
                                            }
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <?php 
                                            if((isset($SLL_no))){
                                                echo $SLL_no;
                                            }else{
                                                echo "-";
                                            } ?>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <?php echo $date_late;?>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <ul class="pager">
                                            <li><button type="button" class="btn btn-primary btn-icon"><i class="icon-search4"></i></button></li>
                                            <li>
                                                <input type="hidden" name="sutdent_key<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>" id="sutdent_key<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>" value="<?php echo $StudentLateDataPrint["sls_StuKey"];?>">
                                                <input type="hidden" name="sutdent_date<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>" id="sutdent_date<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>" value="<?php echo $StudentLateDataPrint["sls_DateLate"];?>">
                                                <button type="button" class="btn btn-danger btn-icon" name="button_delete<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>" id="button_delete<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>"><i class="icon-trash"></i></button></li>
                                        </ul>
                                    </div>                               
                                </td>
                            </tr>
            <?php     

                    } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>




            <?php
                    $StudentLateData=new ManageDataSudentLate("Loop_id","-","-","-","-",$cds_date,$cde_date);
                    $CountStudent=0;
                    foreach($StudentLateData->Call_MDSL_Print() as $key=>$StudentLateDataPrint){
                        if((isset($StudentLateDataPrint["sls_StuKey"]))){   ?>

        <script>
            $(document).ready(function(){
                var sutdent_key=$("#sutdent_key<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>").val();
                var sutdent_date=$("#sutdent_date<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>").val();
                var action="delete";
                $('#button_delete<?php echo $StudentLateDataPrint["sls_StuKey"].$StudentLateDataPrint["sls_DateLate"];?>').on('click', function() {
                    swal({
                        title: "ลบข้อมูล",
                        text: "ต้องการลบข้อมูล รหัส "+sutdent_key+sutdent_date,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#EF5350",
                        confirmButtonText: "ใช่, ต้องการลบ!",
                        cancelButtonText: "ไม่, ไม่ต้องการลบ!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm){
                        if (isConfirm){

                            $.post("<?php echo base_url();?>/student_late/student_late_save",{
                                sutdent_key:sutdent_key,
                                sutdent_date:sutdent_date,
                                action:action
                            },function(rc_code){
                                var code_mode=rc_code.trim();
                                    if(code_mode==="NoError"){
                                        swal({
                                            title: "ลบสำเร็จ",
                                            confirmButtonColor: "#66BB6A",
                                            type: "success"
                                        },function(){
                                            location.reload();
                                        });
                                    }else if(code_mode==="Error"){
                                        swal({
                                            title: "ลบไม่สำเร็จ",
                                            confirmButtonColor: "#2196F3",
                                            type: "error"
                                        });
                                    }else{
                                        swal({
                                            title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
                                            //text: ""+code_mode,
                                            confirmButtonColor: "#2196F3",
                                            type: "error"
                                        });
                                    }
                            })

                        }else{
                            swal({
                                title: "ยกเลิกการลบข้อมูล",
                                confirmButtonColor: "#2196F3",
                                type: "error"
                            });
                        }
                    });
                });
            })
        </script>
        
            <?php       }else{}

                    } ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
            <?php    }else{

                    } 
        } ?>

