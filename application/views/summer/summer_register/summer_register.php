<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
    include("view/database/pdo_data.php");
    include("view/database/pdo_conndatastu.php");
    include("view/database/pdo_admission.php");
    include("view/database/regina_student.php");

    include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");
//--------------------------------------------------------------------
	if($this->session->userdata("rc_user")==null){
		$this->session->unset_userdata("rc_user");
		exit("<script>window.location='$golink/print_imgstu/error';</script>");		
	}else{
		$LoginKey=$this->session->userdata("rc_user");
		$admin_log=$this->load->database("default",TRUE);		
		$admin_log=$this->db->query("SELECT COUNT(`login_id`) AS `int_uesr` 
									 FROM `login` 
									 WHERE `use_status`='1' 
									 AND `login_id`='{$LoginKey}'");
		foreach($admin_log->result_array() as $log_row){
			if($log_row["int_uesr"]>=1){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->


<script type="text/javascript">
        function setScreenHWCookie() {
            $.cookie('sw',screen.width);
                //$.cookie('sh',screen.height);
            return true;
        }
            setScreenHWCookie();
</script>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
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
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
        <?php
            $sr_year=filter_input(INPUT_POST,'sr_year');
            $sr_class=filter_input(INPUT_POST,'sr_class');
            $SR_DataClass=new PrintLavaL($sr_class);
                if((isset($sr_year,$sr_class))){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    
            <?php
                $PrintGroupRoomClass=new GroupRoomClass($sr_year,$sr_class);
                    foreach($PrintGroupRoomClass->RunGroupRoomClass() as $rc=>$GroupRoomClassRow){ ?>
            
    <div class="row">
        <div class="col-<?php echo $grid;?>-12">
            <div class="panel">
                <div class="panel-heading bg-success"><?php echo "ระดับชั้น&nbsp;".$SR_DataClass->RunprintLavaTxtTh()."&nbsp;ห้อง&nbsp;".$GroupRoomClassRow["int_room"];?></div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-<?php echo $grid;?>-6">
                            <div class="row">
                                <div class="col-<?php echo $grid;?>-12">
                                    <div class="panel panel-body border-top-success">
                                        <div class="row">
                                            <div class="col-<?php echo $grid;?>-12">
                                                <p class="content-group">ลงทะเบียนแล้ว</p>
                                            </div>
                                        </div>    
                                        
                                        <div class="row">
                                            <div class="col-<?php echo $grid;?>-12">
                                                <div class="table-responsive">
                                                    <table class="table table_summer_register_A">
                                                        <thead>
                                                            <tr>
                                                                <th><div>รหัสนักเรียน</div></th>
                                                                <th><div>ชื่อ-สกุล</div></th>
                                                                <th><div>เลขที่</div></th>
                                                                <th><div>แผนการเรียน</div></th>
																<th><div>กิจกรรมเสริมทักษะตามความถนัดและความสนใจ</div></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                            <?php
                                $PrintSudA=new PrintReginaStuClass($sr_year,"1",$sr_class,$GroupRoomClassRow["int_room"]);
                                    foreach($PrintSudA->RunReginaStuClass() as $rc=>$PrintSudARow){
                                        $SudKeyA=$PrintSudARow["rsd_studentid"];

                                        $Data_SudName=new Prove_A_PersonRc($SudKeyA);
                                        $Sud_NameA=$Data_SudName->NameTh;

                                        $Data_Sud=new PrintReginaStuData($SudKeyA);
                                        //@$Sud_IdentificationA=$Data_Sud->PRS_Identification;
                                        

                                        $Data_Plan=new RSPlan($PrintSudARow["rsc_plan"]);

                                        $SudNumA=$PrintSudARow["rsc_num"];


                                            if(($PrintSudARow["rsc_status"]==1)){ ?>
            <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
            <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--> 
                                <?php
                                    $TestAppSummerA=new TestRegisterSummer($SudKeyA,$sr_year);
                                        if(($TestAppSummerA->RunTestRegisterSummer()>=1)){ ?>
            <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                                            <tr>
                                                                <td><div><?php echo $SudKeyA;?></div></td>
                                                                <td><div><?php echo $Sud_NameA;?></div></td>
                                                                <td><div><?php echo $SudNumA;?></div></td>
                                                                <td><div><?php echo $Data_Plan->PlanLName;?></div></td>
																
								<?php 
									$Data_Summer=new PrintSummerData($SudKeyA,$sr_year);
										foreach($Data_Summer->RunPrintSummerData() as $rc=>$Data_SummerRow){
											if(($Data_SummerRow["RST_on"])==1){ ?>
																<td><div><?php echo $Data_SummerRow["RSD_txtTh"];?></div></td>												
								<?php		}else{}
										} ?>								
                                                            </tr>                           
            <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                <?php   }else{} ?>
            <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                            <?php           }else{}
                                    } ?>


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            



<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                        </div>
                        <div class="col-<?php echo $grid;?>-6">
                            <div class="row">
                                <div class="col-<?php echo $grid;?>-12">
                                    <div class="panel panel-body border-top-success">
                                        <div class="row">
                                            <div class="col-<?php echo $grid;?>-12">
                                                <p class="content-group">ยังไม่ได้ลงทะเบียน</p>
                                            </div>
                                        </div>        
                                        
                                        <div class="row">
                                            <div class="col-<?php echo $grid;?>-12">
                                                <div class="table-responsive">
                                                    <table class="table table_summer_register_B">
                                                        <thead>
                                                            <tr>
                                                                <th><div>รหัสนักเรียน</div></th>
                                                                <th><div>ชื่อ-สกุล</div></th>
                                                                <th><div>เลขที่</div></th>
                                                                <th><div>แผนการเรียน</div></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                            <?php
                                $PrintSudB=new PrintReginaStuClass($sr_year,"1",$sr_class,$GroupRoomClassRow["int_room"]);
                                    foreach($PrintSudB->RunReginaStuClass() as $rc=>$PrintSudBRow){
                                        $SudKeyB=$PrintSudBRow["rsd_studentid"];

                                        $Data_SudName=new Prove_A_PersonRc($SudKeyB);
                                        $Sud_NameB=$Data_SudName->NameTh;

                                        $Data_Sud=new PrintReginaStuData($SudKeyB);
                                        //@$Sud_IdentificationB=$Data_Sud->PRS_Identification;

                                        $Data_Plan=new RSPlan($PrintSudBRow["rsc_plan"]);

                                        $SudNumB=$PrintSudBRow["rsc_num"];
                                        
                                            if(($PrintSudBRow["rsc_status"]==1)){ ?>
            <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
            <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--> 
                                <?php
                                    $TestAppSummerB=new TestRegisterSummer($SudKeyA,$sr_year);
                                        if(($TestAppSummerB->RunTestRegisterSummer()==0 or $TestAppSummerB->RunTestRegisterSummer()==null)){ ?>
            <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                                            <tr>
                                                                <td><div><?php echo $SudKeyB;?></div></td>
                                                                <td><div><?php echo $Sud_NameB;?></div></td>
                                                                <td><div><?php echo $SudNumB;?></div></td>
                                                                <td><div><?php echo $Data_Plan->PlanLName;?></div></td>
                                                            </tr>   
            <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                <?php   }else{} ?>
            <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                            <?php           }else{}
                                    } ?>


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        





<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
            <?php   } ?>            
    

    <script>
		$(document).ready(function (){
			$.extend( $.fn.dataTable.defaults, {
				autoWidth: false,
				dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
				language: {
					search: '<span>ค้นหา:</span> _INPUT_',
					searchPlaceholder: 'พิมพ์เพื่อค้นหาที่นี้...',
					lengthMenu: '<span>แสดง:</span> _MENU_',
					paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
				}
			});	            
		// Setting datatable defaults
		// Column selectors
            $('.table_summer_register_A').DataTable({
                buttons: {            
                    buttons: [
                        {
                            extend: 'copyHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [ 0, ':visible' ]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'btn btn-default',
                            filename: 'รายชื่อนักเรียนลงทะเบียนเรียนเสริมภาคฤดูร้อน <?php echo $SR_DataClass->RunprintLavaTxtTh();?>',
                            title: 'รายชื่อนักเรียนลงทะเบียนเรียนเสริมภาคฤดูร้อน <?php echo $SR_DataClass->RunprintLavaTxtTh();?>',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                            className: 'btn bg-blue btn-icon'
                        }
                    ]
                },
                            "paging"       : true,
                            "lengthChange" : true,
                            "searching"    : true,
                            "ordering"     : true,
                            "info"         : true,
                            "autoWidth"    : true,
                        
                                    "language": {
                                    "sEmptyTable"      : "ไม่มีข้อมูลในตาราง",
                                    "sInfo"            : "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                                    "sInfoEmpty"       : "แสดง 0 ถึง 0 จาก 0 แถว",
                                    "sInfoFiltered"    : "(กรองข้อมูล _MAX_ ทุกแถว)",
                                    "sInfoPostFix"     : "",
                                    "sInfoThousands"   : ",",
                                    "sLengthMenu"      : "แสดง _MENU_ แถว",
                                    "sLoadingRecords"  : "กำลังโหลดข้อมูล...",
                                    "sProcessing"      : "กำลังดำเนินการ...",
                                    "sSeainserth"          : "ค้นหา: ",
                                    "sZeroRecords"     : "ไม่พบข้อมูล",
                                    "oPaginate"        : {
                                    "sFirst"           : "หน้าแรก",
                                    "sPrevious"        : "ก่อนหน้า",
                                    "sNext"            : "ถัดไป",
                                    "sLast"            : "หน้าสุดท้าย"
                                                        }
                                    }
            });
            
            $('.table_summer_register_B').DataTable({
                buttons: {            
                    buttons: [
                        {
                            extend: 'copyHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [ 0, ':visible' ]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'btn btn-default',
                            filename: 'รายชื่อนักเรียนไม่ลงทะเบียนเรียนเสริมภาคฤดูร้อน <?php echo $SR_DataClass->RunprintLavaTxtTh();?>',
                            title: 'รายชื่อนักเรียนไม่ลงทะเบียนเรียนเสริมภาคฤดูร้อน <?php echo $SR_DataClass->RunprintLavaTxtTh();?>',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                            className: 'btn bg-blue btn-icon'
                        }
                    ]
                },
                            "paging"       : true,
                            "lengthChange" : true,
                            "searching"    : true,
                            "ordering"     : true,
                            "info"         : true,
                            "autoWidth"    : true,
                        
                                    "language": {
                                    "sEmptyTable"      : "ไม่มีข้อมูลในตาราง",
                                    "sInfo"            : "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                                    "sInfoEmpty"       : "แสดง 0 ถึง 0 จาก 0 แถว",
                                    "sInfoFiltered"    : "(กรองข้อมูล _MAX_ ทุกแถว)",
                                    "sInfoPostFix"     : "",
                                    "sInfoThousands"   : ",",
                                    "sLengthMenu"      : "แสดง _MENU_ แถว",
                                    "sLoadingRecords"  : "กำลังโหลดข้อมูล...",
                                    "sProcessing"      : "กำลังดำเนินการ...",
                                    "sSeainserth"          : "ค้นหา: ",
                                    "sZeroRecords"     : "ไม่พบข้อมูล",
                                    "oPaginate"        : {
                                    "sFirst"           : "หน้าแรก",
                                    "sPrevious"        : "ก่อนหน้า",
                                    "sNext"            : "ถัดไป",
                                    "sLast"            : "หน้าสุดท้าย"
                                                        }
                                    }
            });            

		})
</script>


<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
        <?php   }else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <div class="row">
        <div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger alert-styled-right alert-bordered">
				<span class="text-semibold">พบข้อมูลพลาด</span>
        </div>
    </div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
        <?php   } ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{
				$this->session->unset_userdata('rc_user');
				exit("<script>window.location='$golink/print_imgstu/error';</script>");				
			}
		}							 
	}
?>	



