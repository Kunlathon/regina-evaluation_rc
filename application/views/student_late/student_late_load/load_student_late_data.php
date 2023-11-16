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
            }

            if(($type_show=="run")){  ?>
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
                                <th><div>เลขที่</div></th>
                                <th><div>สาย</div></th>
                                <th><div>หมายแจ้งเตือน</div></th>
                            </tr>
                            </thead>
                            <tbody>
            <?php
                    $StudentLateData=new ManageDataSudentLate("Loop_key","-","-","-","-",$cds_date,$cde_date);
                    $CountStudent=0;
                    foreach($StudentLateData->Call_MDSL_Print() as $key=>$StudentLateDataPrint){    
                        $CountStudent=$CountStudent+1;                   
                            if((isset($StudentLateDataPrint["sls_StuKey"]))){
                                $PrintStudent_Data=new PrintReginaStuDataClass($StudentLateDataPrint["sls_StuKey"]);  
                                $SLL_Student_Key=$PrintStudent_Data->PRS_SudId;
                                $SLL_Student_Name=$PrintStudent_Data->PRS_nameTH;   
                                
                                $CLS_TIME=new CountLateStudent('TIME',$SLL_Student_Key,$cds_date,$cde_date);
                                $count_late=$CLS_TIME->int_student_late;

                                $Int_Mail=new count_late_mail('Key',$SLL_Student_Key,$cds_date,$cde_date);
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
                               
                            }                  

                        ?>
                            <tr>
                                <td><div><?php echo $CountStudent;?></div></td>
                                <td><div><?php echo $SLL_Student_Key;?></div></td>
                                <td><div><?php echo $SLL_Student_Name;?></div></td>
                                <td>
                                    <div>    
                                        <?php 
                                            if((isset($SLL_class,$SLL_room))){
                                                echo $SLL_class."/".$SLL_room;
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
                                    <div class="badge bg-violet-400 text-center" style="font-size: 12px;"><?php echo $count_late;?></div>
                                </td>
                                <td>
                                    <div class="badge bg-success-400 text-center" style="font-size: 12px;"><?php echo $count_mail;?></div>
                                </td>

                            </tr>
            <?php     

                    } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <?php   }else{}

    ?>