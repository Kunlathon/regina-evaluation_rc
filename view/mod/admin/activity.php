<?php
	include("view/database/pdo_data.php");
	include("view/database/class_pdo.php");	
	
	include("view/database/database_paynew.php");
	include("view/database/class_pay.php");
	
	include("view/database/pdo_activity.php");
	include("view/database/class_activity.php");
	
	@$data_yaer=2566;
	@$data_term=1;

	@$user_login;
	


	$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);		
		if(($data_stu->IDLevel>=3 and $data_stu->IDLevel<=3)){ ?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ข้อผิดพลาด ! </strong> ระดับชั้น อนุบาล การใช้งานในส่วนนี้ยังไม่เปิดใช้บริการ
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php	}elseif(($data_stu->IDLevel>=11 and $data_stu->IDLevel<=13)){ ?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ข้อผิดพลาด ! </strong> ระดับชั้น ประถมศึกษาปีที่ 1-3 การใช้งานในส่วนนี้ยังไม่เปิดใช้บริการ
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php	}elseif(($data_stu->IDLevel>=31 and $data_stu->IDLevel<=33)){ ?>
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<?php
	//time run------------------------------------------------------------------------------------  
		$datetime=date("Y-m-d H:i:s",strtotime("2023-05-21 00:00:00"));//สิ้นสุดการลงทะเบียน
		$datetime_cr=date("Y-m-d H:i:s");
		$datetime_cr=date("Y-m-d H:i:s");
		$datatime_notrun=strtotime($datetime);
		$datatime_run=strtotime($datetime_cr);
			if(($datatime_run>=$datatime_notrun)){
				$print_runtime="OFF";
			}else{
				$print_runtime="ON";
			}	
	//time run End--------------------------------------------------------------------------------
		$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
		//$print_runtime="ON";
?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="breadcrumb-line breadcrumb-line-component">
            <ul class="breadcrumb">
                <h4><span class="text-semibold">ลงทะเบียนกิจกรรมชุมนุม ภาคเรียน <?php echo $data_term." / ".$data_yaer;?></span></h4>
            </ul>
            <ul class="breadcrumb-elements">
                <div class="heading-btn-group">
                    <a href="./?evaluation_mod=#"
                        class="btn btn-link  text-size-small"><span>ลงทะเบียนกิจกรรมชุมนุม</span></a>
                </div>
            </ul>
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php
	switch($print_runtime){
		case "ON": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
<?php
						$datetimeON="2023-05-19 08:00:00";	
						$datetime_crON=date("Y-m-d H:i:s");
						//$datetime_crON=$datetimeON;
						
						
						$datatime_notrunON=strtotime($datetimeON);
						$datatime_runON=strtotime($datetime_crON);	
						
							if(($datatime_runON>=$datatime_notrunON)){
								//$print_runtime="ON";
								$print_runtimeON="ON";
							}else{
								//$print_runtime="OFF";
								$print_runtimeON="OFF";
							}
					?>
<!--/////////////////////////////////////////////////////////////////////-->
<?php
						if(($print_runtimeON=="OFF")){ ?>
<!--/////////////////////////////////////////////////////////////////////-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>
            <!--<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>-->
        </div>
    </div>
</div><br>
<!--/////////////////////////////////////////////////////////////////////-->
<?php	}else{ ?>
<!--/////////////////////////////////////////////////////////////////////-->
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <center>
                    <h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมชุมนุม<div id="demoA"></div>
                    </h5>
                </center>
            </div>
        </div>
    </div>
</div>
<hr>
<!--*******************************************************************************************-->
<?php 
	$count_SturcActivity=new sturc_activity($user_login,$data_term,$data_yaer);
	$count_SA=0;
	foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
		$count_SA=$count_SA+1;
	}
		if(($count_SA>=1)){ ?>
<!--*************************************************************************************************************************************************************************************-->

<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>กิจกรรมชุมนุมลงทะเบียนสำเร็จแล้ว</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><div>ลำดับ</div></th>
                                        <th><div>ชื่อกิจกรรมส่งเสริม</div></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
																																			$call_print_activity=new sturc_activity($user_login,$data_term,$data_yaer);
																																			$cpa=0;
																																			foreach($call_print_activity->print_sturcto() as $rc_key=>$call_print_activityRow){ 
																																				$cpa++;
																																			?>

                                    <tr>
                                        <td><div><?php echo $cpa;?></div></td>
                                        <td><div><?php echo $call_print_activityRow["activity_txt"];?></div></td>
                                    </tr>

                                    <?php	} ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
																										    if($call_print_activityRow["activity_showstudent"]=="ON"){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <form name="delete_activity" method="post" accept-charset="UTF-8">
                            <center>
                                <input type="hidden" name="activity_key"
                                    value="<?php echo $call_print_activityRow['activity_key'];?>" id="activity_key">
                                <button type="button" class="btn btn-success btn-lg" name="code_key" id="code_key"
                                    value="notkey_system">ยกเลิกลงทะเบียน</button>
                            </center>
                        </form>
                    </div>
                </div>
                <hr>
                <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <script>
                $(document).ready(function() {
                    $('#code_key').on('click', function() {
                        swal({
                                title: "ต้องการยกเลิกกิจกรรมชุมนุมใช้หรือไม่",
                                text: "ยืนยันการยกเลิกกิจกรรมชุมนุม ถ้าแน่ใจว่าจะยกเลิกให้กด OK ถ้าไม่แน่ใจให้กด Cancel",
                                type: "info",
                                showCancelButton: true,
                                closeOnConfirm: false,
                                confirmButtonColor: "#2196F3",
                                showLoaderOnConfirm: true
                            },
                            function() {
                                setTimeout(function() {
                                    swal({
                                        title: "ยกเลิกกิจกรรมชุมนุมสำเร็จ",
                                        confirmButtonColor: "#2196F3"
                                    }, function() {
                                        var ActivityKey = $("#activity_key").val();
                                        var CodeKey = $("#code_key").val();
                                        if (ActivityKey != "" && CodeKey != "") {
                                            $.post("./?evaluation_mod=activity_show", {
                                                activity_key: ActivityKey,
                                                code_key: CodeKey
                                            }, function(rc) {
                                                if (rc != "") {
                                                    document.location =
                                                        "./?evaluation_mod=activity";
                                                } else {}
                                            })
                                        } else {}
                                    });
                                }, 2000);
                            });
                    });
                })
                </script>
                <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <?php	}elseif(($call_print_activityRow["activity_showstudent"]=="OFF")){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="alert alert-danger">
                            <strong>ไม่มีสิทธิ์ ! ยกเลิกลงทะเบียนกิจกรรมชุมนุม</strong>
                        </div>
                    </div>
                </div><br>
                <?php	}else{ ?>

                <?php	}      ?>
            </div>
        </div>
    </div>
</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if(($hr_arc%4==0)){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--********************************************************************************************************************************************************************************************************************-->
<!--********************************************************************************************************************************************************************************************************************-->
<?php	}else{ ?>
<!--*************************************************************************************************************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if(($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF")){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if(($hr_arc%4==0)){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <a id="Btn_activity<?php echo $hr_arc;?>" data-toggle="tooltip"
                            title="<?php echo $call_activityRow["activity_txt"];?>">
                            <div class="panel panel-body" style="background-color: #02FAF0">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                    </div>

                                    <div class="media-body">
                                        <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                            <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                            <div>
                                                <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                            </div>
                                        </font>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <a id="Btn_activity<?php echo $hr_arc;?>" data-toggle="tooltip"
                            title="<?php echo $call_activityRow["activity_txt"];?>">
                            <div class="panel panel-body" style="background-color: #02FAF0">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                    </div>

                                    <div class="media-body">
                                        <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                            <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                            <div>
                                                <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                            </div>
                                        </font>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!-- Modal -->
                    <div class="modal fade" id="Modal_activity<?php echo $hr_arc;?>" role="dialog">
                        <div class="modal-dialog">

                            <!--activity_taacher ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                            <?php 
			if(($data_stu->IDLevel>=11 and $data_stu->IDLevel<=23)){
				$teacher_activity=new activity_taacher($call_activityRow["activity_key"],$data_term,$data_yaer);
				$activity_adviser=new print_teacher_rc($teacher_activity->taacher_keyrc());
					$img_t=$activity_adviser->teacherRC_key().".jpg";
						if(isset($img_t)){
							if(file_exists("view/t/$img_t")){
								$adviser_img="view/t/$img_t";
							}else{
								$adviser_img="view/t/uesr.jpg";
							}								
						}else{
							//--------------------------------------
						}
			}elseif(($data_stu->IDLevel>=31 and $data_stu->IDLevel<=43)){
				$teacher_activity=new activity_taacher($call_activityRow["activity_key"],$data_term,$data_yaer);
				$activity_adviser=new regina_stu_data($teacher_activity->taacher_keyrc());
					if(file_exists("view/all/$activity_adviser->rsd_studentid.jpg")){
						$adviser_img="view/all/$activity_adviser->rsd_studentid.jpg";
					}else{
						$adviser_img="view/all/newimg_rc.jpg";
					}				
			}else{
				
			}
		?>
                            <!--activity_taacher End ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">กิจกรรมชุมนุม :
                                        <?php echo $call_activityRow["activity_txt"];?></h4>

                                    <?php
			if(($data_stu->IDLevel>=11 and $data_stu->IDLevel<=23)){ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <h4 class="modal-title">ครูชุมนุม :
                                        <?php echo $activity_adviser->teacherRC_nameTh();?></h4>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php
				if((isset($img_t))){ ?>
                                    <center><img src="<?php echo $adviser_img;?>" align="center" width="40%"
                                            class="img-thumbnail" alt=""></center>
                                    <?php	}else{ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}      ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}elseif(($data_stu->IDLevel>=31 and $data_stu->IDLevel<=43)){ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <h4 class="modal-title">ประธานชุมนุม :
                                        <?php echo "นางสาว ".$activity_adviser->rsd_name." ".$activity_adviser->rsd_surname;?>
                                    </h4>
                                    <center><img src="<?php echo $adviser_img;?>" align="center" width="40%"
                                            class="img-thumbnail" alt=""></center>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}else{ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}	   ?>



                                </div>
                                <div class="modal-body">


                                </div>
                                <div class="modal-footer">
                                    <form name="activityA" action="./?evaluation_mod=activity_show" method="post"
                                        accept-charset="UTF-8">
                                        <input type="hidden" name="activity_key"
                                            value="<?php echo $call_activityRow["activity_key"];?>">
                                        <button type="submit" class="btn btn-success" name="code_key"
                                            value="key_system">ลงทะเบียน</button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">ปิด</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Modal -->
                    <script>
                    $(document).ready(function() {
                        $("#Btn_activity<?php echo $hr_arc;?>").click(function() {
                            $("#Modal_activity<?php echo $hr_arc;?>").modal({
                                backdrop: false
                            });
                        });
                    })
                    </script>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php
									if($hr_arc>=1){
//------------------------------------------------------------------------------------------------
									}else{ ?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ ! </strong>
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php	}  ?>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php	}      ?>
<!--*******************************************************************************************-->

<!--*******************************************************************************************-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->
<?php }       ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<?php break;
		  case "OFF": ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>หมดเวลา ลงทะเบียนกิจกรรมชุมนุม พบข้อสงสัยกรุณาติดต่อ ห้องกิจการนักเรียน...</strong>
        </div>
    </div>
</div><br>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <center>
                    <h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมชุมนุม<div id="demoA"></div>
                    </h5>
                </center>
            </div>
        </div>
    </div>
</div>
<hr>
<!--*******************************************************************************************-->
<?php 
																							$count_SturcActivity=new sturc_activity($user_login,$data_term,$data_yaer);
																							$count_SA=0;
																							foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
																								$count_SA=$count_SA+1;
																							}
																								if($count_SA>=1){ ?>
<!--*************************************************************************************************************************************************************************************-->

<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>กิจกรรมชุมนุมลงทะเบียนสำเร็จแล้ว</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <div>ลำดับ</div>
                                        </th>
                                        <th>
                                            <div>ชื่อกิจกรรมชุมนุม/ส่งเสริม</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
																																			$call_print_activity=new sturc_activity($user_login,$data_term,$data_yaer);
																																			$cpa=0;
																																			foreach($call_print_activity->print_sturcto() as $rc_key=>$call_print_activityRow){ 
																																				$cpa++;
																																			?>

                                    <tr>
                                        <td>
                                            <div><?php echo $cpa;?></div>
                                        </td>
                                        <td>
                                            <div><?php echo $call_print_activityRow["activity_txt"];?></div>
                                        </td>
                                    </tr>

                                    <?php	} ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
																										    if($call_print_activityRow["activity_showstudent"]=="ON"){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <form name="delete_activity" method="post" accept-charset="UTF-8">
                            <center>
                                <input type="hidden" name="activity_key"
                                    value="<?php echo $call_print_activityRow['activity_key'];?>" id="activity_key">
                                <!--<button type="button" class="btn btn-success btn-lg" name="code_key" id="code_key"  value="notkey_system">ยกเลิกลงทะเบียน</button>-->
                            </center>
                        </form>
                    </div>
                </div>
                <hr>
                <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <?php	}elseif($call_print_activityRow["activity_showstudent"]=="OFF"){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="alert alert-danger">
                            <strong>ไม่มีสิทธิ์ ! ยกเลิกลงทะเบียนกิจกรรมชุมนุม</strong>
                        </div>
                    </div>
                </div><br>
                <?php	}else{ ?>

                <?php	}      ?>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if($hr_arc%4==0){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<?php	}else{ ?>
<!--*************************************************************************************************************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if($hr_arc%4==0){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php
									if(($hr_arc>=1)){
//------------------------------------------------------------------------------------------------
									}else{ ?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ ! </strong>
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php	}  ?>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php	}      ?>
<!--*******************************************************************************************-->

<!--*******************************************************************************************-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<?php break;
		  default: ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<?php	}   ?>
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<?php   }elseif(($data_stu->IDLevel==41)){ ?>
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<?php
	//time run------------------------------------------------------------------------------------  
		$datetime=date("Y-m-d H:i:s",strtotime("2023-05-23 00:00:00"));//สิ้นสุดการลงทะเบียน
		$datetime_cr=date("Y-m-d H:i:s");
		$datatime_notrun=strtotime($datetime);
		$datatime_run=strtotime($datetime_cr);
			if(($datatime_run>=$datatime_notrun)){
				$print_runtime="OFF";
			}else{
				$print_runtime="ON";
			}	
	//time run End--------------------------------------------------------------------------------
		$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="breadcrumb-line breadcrumb-line-component">
            <ul class="breadcrumb">
                <h4><span class="text-semibold">ลงทะเบียนกิจกรรมชุมนุม ภาคเรียน
                        <?php echo $data_term." / ".$data_yaer;?></span></h4>
            </ul>
            <ul class="breadcrumb-elements">
                <div class="heading-btn-group">
                    <a href="./?evaluation_mod=#"
                        class="btn btn-link  text-size-small"><span>ลงทะเบียนกิจกรรมชุมนุม</span></a>
                </div>
            </ul>
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php
	switch($print_runtime){
		case "ON": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
<?php
						//$datetimeON="2021-06-20 06:00:00";	
						$datetimeON="2023-05-21 08:00:00";	
						$datetime_crON=date("Y-m-d H:i:s");
						//$datetime_crON=$datetimeON;
						$datatime_notrunON=strtotime($datetimeON);
						$datatime_runON=strtotime($datetime_crON);	
						
							if(($datatime_runON>=$datatime_notrunON)){
								//$print_runtime="ON";
								$print_runtimeON="ON";
							}else{
								//$print_runtime="OFF";
								$print_runtimeON="OFF";
							}
					?>
<!--/////////////////////////////////////////////////////////////////////-->
<?php
						if(($print_runtimeON=="OFF")){ ?>
<!--/////////////////////////////////////////////////////////////////////-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>
            <!--<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>-->
        </div>
    </div>
</div><br>
<!--/////////////////////////////////////////////////////////////////////-->
<?php	}else{ ?>
<!--/////////////////////////////////////////////////////////////////////-->
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <center>
                    <h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมชุมนุม<div id="time_m5"></div>
                    </h5>
                </center>
            </div>
        </div>
    </div>
</div>
<hr>
<!--*******************************************************************************************-->
<?php 
																							$count_SturcActivity=new sturc_activity($user_login,$data_term,$data_yaer);
																							$count_SA=0;
																							foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
																								$count_SA=$count_SA+1;
																							}
																								if(($count_SA>=1)){ ?>
<!--*************************************************************************************************************************************************************************************-->

<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>กิจกรรมชุมนุมลงทะเบียนสำเร็จแล้ว</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อกิจกรรมส่งเสริม</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
																																			$call_print_activity=new sturc_activity($user_login,$data_term,$data_yaer);
																																			$cpa=0;
																																			foreach($call_print_activity->print_sturcto() as $rc_key=>$call_print_activityRow){ 
																																				$cpa++;
																																			?>

                                    <tr>
                                        <td><?php echo $cpa;?></td>
                                        <td><?php echo $call_print_activityRow["activity_txt"];?></td>
                                    </tr>

                                    <?php	} ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
																										    if(($call_print_activityRow["activity_showstudent"]=="ON")){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <form name="delete_activity" method="post" accept-charset="UTF-8">
                            <center>
                                <input type="hidden" name="activity_key" id="activity_key"
                                    value="<?php echo $call_print_activityRow["activity_key"];?>">
                                <button type="button" class="btn btn-success btn-lg" name="code_key" id="code_key"
                                    value="notkey_system">ยกเลิกลงทะเบียน</button>
                            </center>
                        </form>
                    </div>
                </div>
                <hr>
                <?php	}elseif(($call_print_activityRow["activity_showstudent"]=="OFF")){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="alert alert-danger">
                            <strong>ไม่มีสิทธิ์ ! ยกเลิกลงทะเบียนกิจกรรมชุมนุม</strong>
                        </div>
                    </div>
                </div><br>
                <?php	}else{ ?>

                <?php	}      ?>
            </div>
        </div>
    </div>
</div>

<!--*************************************************************************************************************************************************************************************-->
<script>
$(document).ready(function() {
    $('#code_key').on('click', function() {
        swal({
                title: "ต้องการยกเลิกกิจกรรมชุมนุมใช้หรือไม่",
                text: "ยืนยันการยกเลิกกิจกรรมชุมนุม ถ้าแน่ใจว่าจะยกเลิกให้กด OK ถ้าไม่แน่ใจให้กด Cancel",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonColor: "#2196F3",
                showLoaderOnConfirm: true
            },
            function() {
                setTimeout(function() {
                    swal({
                        title: "ยกเลิกกิจกรรมชุมนุมสำเร็จ",
                        confirmButtonColor: "#2196F3"
                    }, function() {
                        var ActivityKey = $("#activity_key").val();
                        var CodeKey = $("#code_key").val();
                        if (ActivityKey != "" && CodeKey != "") {
                            $.post("./?evaluation_mod=activity_show", {
                                activity_key: ActivityKey,
                                code_key: CodeKey
                            }, function(rc) {
                                if (rc != "") {
                                    document.location =
                                        "./?evaluation_mod=activity";
                                } else {}
                            })
                        } else {}
                    });
                }, 2000);
            });
    });
})
</script>
<!--*************************************************************************************************************************************************************************************-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if($hr_arc%4==0){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*************************************************************************************************************************************************************************************-->
<?php	}else{ ?>
<!--*************************************************************************************************************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if($hr_arc%4==0){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <a id="Btn_activity<?php echo $hr_arc;?>" data-toggle="tooltip"
                            title="<?php echo $call_activityRow["activity_txt"];?>">
                            <div class="panel panel-body" style="background-color: #02FAF0">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                    </div>

                                    <div class="media-body">
                                        <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                            <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                            <div>
                                                <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                            </div>
                                        </font>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <a id="Btn_activity<?php echo $hr_arc;?>" data-toggle="tooltip"
                            title="<?php echo $call_activityRow["activity_txt"];?>">
                            <div class="panel panel-body" style="background-color: #02FAF0">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                    </div>

                                    <div class="media-body">
                                        <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                            <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                            <div>
                                                <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                            </div>
                                        </font>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!-- Modal -->
                    <div class="modal fade" id="Modal_activity<?php echo $hr_arc;?>" role="dialog">
                        <div class="modal-dialog">

                            <!--activity_taacher ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                            <?php 
			if(($data_stu->IDLevel>=42 and $data_stu->IDLevel<=23)){
				$teacher_activity=new activity_taacher($call_activityRow["activity_key"],$data_term,$data_yaer);
				$activity_adviser=new print_teacher_rc($teacher_activity->taacher_keyrc());
					$img_t=$activity_adviser->teacherRC_key().".jpg";
						if((isset($img_t))){
							if((file_exists("view/t/$img_t"))){
								$adviser_img="view/t/$img_t";
							}else{
								$adviser_img="view/t/uesr.jpg";
							}								
						}else{
							//--------------------------------------
						}
			}elseif(($data_stu->IDLevel>=31 and $data_stu->IDLevel<=43)){
				$teacher_activity=new activity_taacher($call_activityRow["activity_key"],$data_term,$data_yaer);
				$activity_adviser=new regina_stu_data($teacher_activity->taacher_keyrc());
					if((file_exists("view/all/$activity_adviser->rsd_studentid.jpg"))){
						$adviser_img="view/all/$activity_adviser->rsd_studentid.jpg";
					}else{
						$adviser_img="view/all/newimg_rc.jpg";
					}				
			}else{
				
			}
		?>
                            <!--activity_taacher End ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">กิจกรรมชุมนุม :
                                        <?php echo $call_activityRow["activity_txt"];?></h4>

                                    <?php
			if(($data_stu->IDLevel>=11 and $data_stu->IDLevel<=23)){ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <h4 class="modal-title">ครูชุมนุม :
                                        <?php echo $activity_adviser->teacherRC_nameTh();?></h4>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php
				if((isset($img_t))){ ?>
                                    <center><img src="<?php echo $adviser_img;?>" align="center" width="40%" class="img-thumbnail" alt=""></center>
                                    <?php	}else{ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}      ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}elseif(($data_stu->IDLevel>=31 and $data_stu->IDLevel<=43)){ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <h4 class="modal-title">ประธานชุมนุม :
                                        <?php echo "นางสาว ".$activity_adviser->rsd_name." ".$activity_adviser->rsd_surname;?>
                                    </h4>
                                    <center><img src="<?php echo $adviser_img;?>" align="center" width="40%"
                                            class="img-thumbnail" alt=""></center>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}else{ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}	   ?>



                                </div>
                                <div class="modal-body">


                                </div>
                                <div class="modal-footer">
                                    <form name="activityA" action="./?evaluation_mod=activity_show" method="post"
                                        accept-charset="UTF-8">
                                        <input type="hidden" name="activity_key"
                                            value="<?php echo $call_activityRow["activity_key"];?>">
                                        <button type="submit" class="btn btn-success" name="code_key"
                                            value="key_system">ลงทะเบียน</button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">ปิด</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Modal -->
                    <script>
                    $(document).ready(function() {
                        $("#Btn_activity<?php echo $hr_arc;?>").click(function() {
                            $("#Modal_activity<?php echo $hr_arc;?>").modal({
                                backdrop: false
                            });
                        });
                    })
                    </script>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php
									if($hr_arc>=1){
//------------------------------------------------------------------------------------------------
									}else{ ?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ ! </strong>
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php	}  ?>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php	}      ?>
<!--*******************************************************************************************-->

<!--*******************************************************************************************-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->
<?php }       ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<?php break;
		  case "OFF": ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>หมดเวลา ลงทะเบียนกิจกรรมชุมนุม พบข้อสงสัยกรุณาติดต่อ ห้องกิจการนักเรียน...</strong>
        </div>
    </div>
</div><br>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <center>
                    <h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมชุมนุม<div id="time_m5"></div>
                    </h5>
                </center>
            </div>
        </div>
    </div>
</div>
<hr>
<!--*******************************************************************************************-->
<?php 
																							$count_SturcActivity=new sturc_activity($user_login,$data_term,$data_yaer);
																							$count_SA=0;
																							foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
																								$count_SA=$count_SA+1;
																							}
																								if(($count_SA>=1)){ ?>
<!--*************************************************************************************************************************************************************************************-->

<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>กิจกรรมชุมนุมลงทะเบียนสำเร็จแล้ว</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <div>ลำดับ</div>
                                        </th>
                                        <th>
                                            <div>ชื่อกิจกรรมชุมนุม/ส่งเสริม</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
																																			$call_print_activity=new sturc_activity($user_login,$data_term,$data_yaer);
																																			$cpa=0;
																																			foreach($call_print_activity->print_sturcto() as $rc_key=>$call_print_activityRow){ 
																																				$cpa++;
																																			?>

                                    <tr>
                                        <td>
                                            <div><?php echo $cpa;?></div>
                                        </td>
                                        <td>
                                            <div><?php echo $call_print_activityRow["activity_txt"];?></div>
                                        </td>
                                    </tr>

                                    <?php	} ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
																										    if(($call_print_activityRow["activity_showstudent"]=="ON")){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <form name="delete_activity" method="post" accept-charset="UTF-8">
                            <center>
                                <input type="hidden" name="activity_key"
                                    value="<?php echo $call_print_activityRow['activity_key'];?>" id="activity_key">
                                <!--<button type="button" class="btn btn-success btn-lg" name="code_key" id="code_key"  value="notkey_system">ยกเลิกลงทะเบียน</button>-->
                            </center>
                        </form>
                    </div>
                </div>
                <hr>
                <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <?php	}elseif(($call_print_activityRow["activity_showstudent"]=="OFF")){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="alert alert-danger">
                            <strong>ไม่มีสิทธิ์ ! ยกเลิกลงทะเบียนกิจกรรมชุมนุม</strong>
                        </div>
                    </div>
                </div><br>
                <?php	}else{ ?>

                <?php	}      ?>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if(($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF")){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if(($hr_arc%4==0)){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<?php	}else{ ?>
<!--*************************************************************************************************************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if(($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF")){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if(($hr_arc%4==0)){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php
									if(($hr_arc>=1)){
//------------------------------------------------------------------------------------------------
									}else{ ?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ ! </strong>
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php	}  ?>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php	}      ?>
<!--*******************************************************************************************-->

<!--*******************************************************************************************-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<?php break;
		  default: ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<?php	}   ?>
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<?php   }elseif((($data_stu->IDLevel==42))){ ?>


<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<?php
	//time run------------------------------------------------------------------------------------  
		$datetime=date("Y-m-d H:i:s",strtotime("2023-05-23 00:00:00"));//สิ้นสุดการลงทะเบียน
		$datetime_cr=date("Y-m-d H:i:s");
		$datatime_notrun=strtotime($datetime);
		$datatime_run=strtotime($datetime_cr);
			if(($datatime_run>=$datatime_notrun)){
				$print_runtime="OFF";
			}else{
				$print_runtime="ON";
			}	
	//time run End--------------------------------------------------------------------------------
		$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="breadcrumb-line breadcrumb-line-component">
            <ul class="breadcrumb">
                <h4><span class="text-semibold">ลงทะเบียนกิจกรรมชุมนุม ภาคเรียน
                        <?php echo $data_term." / ".$data_yaer;?></span></h4>
            </ul>
            <ul class="breadcrumb-elements">
                <div class="heading-btn-group">
                    <a href="./?evaluation_mod=#"
                        class="btn btn-link  text-size-small"><span>ลงทะเบียนกิจกรรมชุมนุม</span></a>
                </div>
            </ul>
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php
	switch($print_runtime){
		case "ON": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
<?php
						$datetimeON="2023-05-21 08:00:00";	
						$datetime_crON=date("Y-m-d H:i:s");
						//$datetime_crON=$datetimeON;
						$datatime_notrunON=strtotime($datetimeON);
						$datatime_runON=strtotime($datetime_crON);	
						
							if(($datatime_runON>=$datatime_notrunON)){
								//$print_runtime="ON";
								$print_runtimeON="ON";
							}else{
								//$print_runtime="OFF";
								$print_runtimeON="OFF";
							}
					?>
<!--/////////////////////////////////////////////////////////////////////-->
<?php
						if(($print_runtimeON=="OFF")){ ?>
<!--/////////////////////////////////////////////////////////////////////-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>&nbsp;เริ่มลงทะเบียนวันที่&nbsp;21&nbsp;พฤษภาคม&nbsp;2566&nbsp;เวลา&nbsp;08.00น.&nbsp;ถึงวันที่&nbsp;22&nbsp;พฤษภาคม&nbsp;2566&nbsp;เวลา&nbsp;24.00 น.
            <!--<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>-->
        </div>
    </div>
</div><br>
<!--/////////////////////////////////////////////////////////////////////-->
<?php	}else{ ?>
<!--/////////////////////////////////////////////////////////////////////-->
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <center>
                    <h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมชุมนุม<div id="time_m5"></div>
                    </h5>
                </center>
            </div>
        </div>
    </div>
</div>
<hr>
<!--*******************************************************************************************-->
<?php 
	$count_SturcActivity=new sturc_activity($user_login,$data_term,$data_yaer);
	$count_SA=0;
	foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
		$count_SA=$count_SA+1;
	}
		if($count_SA>=1){ ?>
<!--*************************************************************************************************************************************************************************************-->

<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>กิจกรรมชุมนุมลงทะเบียนสำเร็จแล้ว</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อกิจกรรมส่งเสริม</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
										$call_print_activity=new sturc_activity($user_login,$data_term,$data_yaer);
										$cpa=0;
											foreach($call_print_activity->print_sturcto() as $rc_key=>$call_print_activityRow){ 
											$cpa++;
										?>

                                    <tr>
                                        <td><?php echo $cpa;?></td>
                                        <td><?php echo $call_print_activityRow["activity_txt"];?></td>
                                    </tr>

                                    <?php	} ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
						if(($call_print_activityRow["activity_showstudent"]=="ON")){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <form name="delete_activity" method="post" accept-charset="UTF-8">
                            <center>
                                <input type="hidden" name="activity_key" id="activity_key"
                                    value="<?php echo $call_print_activityRow["activity_key"];?>">
                                <button type="button" class="btn btn-success btn-lg" name="code_key" id="code_key"
                                    value="notkey_system">ยกเลิกลงทะเบียน</button>
                            </center>
                        </form>
                    </div>
                </div>
                <hr>
                <?php	}elseif($call_print_activityRow["activity_showstudent"]=="OFF"){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="alert alert-danger">
                            <strong>ไม่มีสิทธิ์ ! ยกเลิกลงทะเบียนกิจกรรมชุมนุม</strong>
                        </div>
                    </div>
                </div><br>
                <?php	}else{ ?>

                <?php	}      ?>
            </div>
        </div>
    </div>
</div>



<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<script>
$(document).ready(function() {
    $('#code_key').on('click', function() {
        swal({
                title: "ต้องการยกเลิกกิจกรรมชุมนุมใช้หรือไม่",
                text: "ยืนยันการยกเลิกกิจกรรมชุมนุม ถ้าแน่ใจว่าจะยกเลิกให้กด OK ถ้าไม่แน่ใจให้กด Cancel",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonColor: "#2196F3",
                showLoaderOnConfirm: true
            },
            function() {
                setTimeout(function() {
                    swal({
                        title: "ยกเลิกกิจกรรมชุมนุมสำเร็จ",
                        confirmButtonColor: "#2196F3"
                    }, function() {
                        var ActivityKey = $("#activity_key").val();
                        var CodeKey = $("#code_key").val();
                        if (ActivityKey != "" && CodeKey != "") {
                            $.post("./?evaluation_mod=activity_show", {
                                activity_key: ActivityKey,
                                code_key: CodeKey
                            }, function(rc) {
                                if (rc != "") {
                                    document.location =
                                        "./?evaluation_mod=activity";
                                } else {}
                            })
                        } else {}
                    });
                }, 2000);
            });
    });
})
</script>
<!--*************************************************************************************************************************************************************************************-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if($hr_arc%4==0){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*************************************************************************************************************************************************************************************-->
<?php	}else{ ?>
<!--*************************************************************************************************************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if($hr_arc%4==0){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <a id="Btn_activity<?php echo $hr_arc;?>" data-toggle="tooltip"
                            title="<?php echo $call_activityRow["activity_txt"];?>">
                            <div class="panel panel-body" style="background-color: #02FAF0">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                    </div>

                                    <div class="media-body">
                                        <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                            <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                            <div>
                                                <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                            </div>
                                        </font>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <a id="Btn_activity<?php echo $hr_arc;?>" data-toggle="tooltip"
                            title="<?php echo $call_activityRow["activity_txt"];?>">
                            <div class="panel panel-body" style="background-color: #02FAF0">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                    </div>

                                    <div class="media-body">
                                        <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                            <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                            <div>
                                                <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                            </div>
                                        </font>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!-- Modal -->
                    <div class="modal fade" id="Modal_activity<?php echo $hr_arc;?>" role="dialog">
                        <div class="modal-dialog">

                            <!--activity_taacher ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                            <?php 
			if(($data_stu->IDLevel>=11 and $data_stu->IDLevel<=23)){
				$teacher_activity=new activity_taacher($call_activityRow["activity_key"],$data_term,$data_yaer);
				$activity_adviser=new print_teacher_rc($teacher_activity->taacher_keyrc());
					$img_t=$activity_adviser->teacherRC_key().".jpg";
						if(isset($img_t)){
							if(file_exists("view/t/$img_t")){
								$adviser_img="view/t/$img_t";
							}else{
								$adviser_img="view/t/uesr.jpg";
							}								
						}else{
							//--------------------------------------
						}
			}elseif(($data_stu->IDLevel>=31 and $data_stu->IDLevel<=43)){
				$teacher_activity=new activity_taacher($call_activityRow["activity_key"],$data_term,$data_yaer);
				$activity_adviser=new regina_stu_data($teacher_activity->taacher_keyrc());
					if(file_exists("view/all/$activity_adviser->rsd_studentid.jpg")){
						$adviser_img="view/all/$activity_adviser->rsd_studentid.jpg";
					}else{
						$adviser_img="view/all/newimg_rc.jpg";
					}				
			}else{
				
			}
		?>
                            <!--activity_taacher End ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">กิจกรรมชุมนุม :
                                        <?php echo $call_activityRow["activity_txt"];?></h4>

                                    <?php
			if(($data_stu->IDLevel>=11 and $data_stu->IDLevel<=23)){ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <h4 class="modal-title">ครูชุมนุม :
                                        <?php echo $activity_adviser->teacherRC_nameTh();?></h4>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php
				if((isset($img_t))){ ?>
                                    <center><img src="<?php echo $adviser_img;?>" align="center" width="40%"
                                            class="img-thumbnail" alt=""></center>
                                    <?php	}else{ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}      ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}elseif(($data_stu->IDLevel>=31 and $data_stu->IDLevel<=43)){ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <h4 class="modal-title">ประธานชุมนุม :
                                        <?php echo "นางสาว ".$activity_adviser->rsd_name." ".$activity_adviser->rsd_surname;?>
                                    </h4>
                                    <center><img src="<?php echo $adviser_img;?>" align="center" width="40%" class="img-thumbnail" alt=""></center>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}else{ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}	   ?>



                                </div>
                                <div class="modal-body">


                                </div>
                                <div class="modal-footer">
                                    <form name="activityA" action="./?evaluation_mod=activity_show" method="post"
                                        accept-charset="UTF-8">
                                        <input type="hidden" name="activity_key"
                                            value="<?php echo $call_activityRow["activity_key"];?>">
                                        <button type="submit" class="btn btn-success" name="code_key"
                                            value="key_system">ลงทะเบียน</button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">ปิด</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Modal -->
                    <script>
                    $(document).ready(function() {
                        $("#Btn_activity<?php echo $hr_arc;?>").click(function() {
                            $("#Modal_activity<?php echo $hr_arc;?>").modal({
                                backdrop: false
                            });
                        });
                    })
                    </script>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php
									if($hr_arc>=1){
//------------------------------------------------------------------------------------------------
									}else{ ?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ ! </strong>
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php	}  ?>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php	}      ?>
<!--*******************************************************************************************-->

<!--*******************************************************************************************-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->
<?php }       ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<?php break;
		  case "OFF": ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>หมดเวลา ลงทะเบียนกิจกรรมชุมนุม พบข้อสงสัยกรุณาติดต่อ ห้องกิจการนักเรียน...</strong>
        </div>
    </div>
</div><br>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <center>
                    <h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมชุมนุม<div id="time_m5"></div>
                    </h5>
                </center>
            </div>
        </div>
    </div>
</div>
<hr>
<!--*******************************************************************************************-->
<?php 
																							$count_SturcActivity=new sturc_activity($user_login,$data_term,$data_yaer);
																							$count_SA=0;
																							foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
																								$count_SA=$count_SA+1;
																							}
																								if($count_SA>=1){ ?>
<!--*************************************************************************************************************************************************************************************-->

<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>กิจกรรมชุมนุมลงทะเบียนสำเร็จแล้ว</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <div>ลำดับ</div>
                                        </th>
                                        <th>
                                            <div>ชื่อกิจกรรมชุมนุม/ส่งเสริม</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
																																			$call_print_activity=new sturc_activity($user_login,$data_term,$data_yaer);
																																			$cpa=0;
																																			foreach($call_print_activity->print_sturcto() as $rc_key=>$call_print_activityRow){ 
																																				$cpa++;
																																			?>

                                    <tr>
                                        <td>
                                            <div><?php echo $cpa;?></div>
                                        </td>
                                        <td>
                                            <div><?php echo $call_print_activityRow["activity_txt"];?></div>
                                        </td>
                                    </tr>

                                    <?php	} ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
																										    if($call_print_activityRow["activity_showstudent"]=="ON"){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <form name="delete_activity" method="post" accept-charset="UTF-8">
                            <center>
                                <input type="hidden" name="activity_key"
                                    value="<?php echo $call_print_activityRow['activity_key'];?>" id="activity_key">
                                <!--<button type="button" class="btn btn-success btn-lg" name="code_key" id="code_key"  value="notkey_system">ยกเลิกลงทะเบียน</button>-->
                            </center>
                        </form>
                    </div>
                </div>
                <hr>
                <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <?php	}elseif($call_print_activityRow["activity_showstudent"]=="OFF"){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="alert alert-danger">
                            <strong>ไม่มีสิทธิ์ ! ยกเลิกลงทะเบียนกิจกรรมชุมนุม</strong>
                        </div>
                    </div>
                </div><br>
                <?php	}else{ ?>

                <?php	}      ?>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if($hr_arc%4==0){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<?php	}else{ ?>
<!--*************************************************************************************************************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if($hr_arc%4==0){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php
									if($hr_arc>=1){
//------------------------------------------------------------------------------------------------
									}else{ ?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ ! </strong>
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php	}  ?>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php	}      ?>
<!--*******************************************************************************************-->

<!--*******************************************************************************************-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->


<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<?php break;
		  default: ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<?php	}   ?>
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->

	
<?php   }elseif(($data_stu->IDLevel==21)){ ?>
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<?php
	//time run------------------------------------------------------------------------------------  
		$datetime=date("Y-m-d H:i:s",strtotime("2023-05-22 00:00:00"));//สิ้นสุดการลงทะเบียน
		$datetime_cr=date("Y-m-d H:i:s");
		$datatime_notrun=strtotime($datetime);
		$datatime_run=strtotime($datetime_cr);
			if(($datatime_run>=$datatime_notrun)){
				$print_runtime="OFF";
			}else{
				$print_runtime="ON";
			}	
	//time run End--------------------------------------------------------------------------------
		$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="breadcrumb-line breadcrumb-line-component">
            <ul class="breadcrumb">
                <h4><span class="text-semibold">ลงทะเบียนกิจกรรมชุมนุม ภาคเรียน
                        <?php echo $data_term." / ".$data_yaer;?></span></h4>
            </ul>
            <ul class="breadcrumb-elements">
                <div class="heading-btn-group">
                    <a href="./?evaluation_mod=#"
                        class="btn btn-link  text-size-small"><span>ลงทะเบียนกิจกรรมชุมนุม</span></a>
                </div>
            </ul>
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php
	switch($print_runtime){
		case "ON": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
<?php
						$datetimeON="2023-05-20 08:00:00";	
						$datetime_crON=date("Y-m-d H:i:s");
						//$datetime_crON=$datetimeON;
						$datatime_notrunON=strtotime($datetimeON);
						$datatime_runON=strtotime($datetime_crON);	
						
							if($datatime_runON>=$datatime_notrunON){
								//$print_runtime="ON";
								$print_runtimeON="ON";
							}else{
								//$print_runtime="OFF";
								$print_runtimeON="OFF";
							}
					?>
<!--/////////////////////////////////////////////////////////////////////-->
<?php
						if(($print_runtimeON=="OFF")){ ?>
<!--/////////////////////////////////////////////////////////////////////-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>
            <!--<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>-->
        </div>
    </div>
</div><br>
<!--/////////////////////////////////////////////////////////////////////-->
<?php	}else{ ?>
<!--/////////////////////////////////////////////////////////////////////-->
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <center>
                    <h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมชุมนุม<div id="demoC"></div>
                    </h5>
                </center>
            </div>
        </div>
    </div>
</div>
<hr>
<!--*******************************************************************************************-->
<?php 
																							$count_SturcActivity=new sturc_activity($user_login,$data_term,$data_yaer);
																							$count_SA=0;
																							foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
																								$count_SA=$count_SA+1;
																							}
																								if(($count_SA>=1)){ ?>
<!--*************************************************************************************************************************************************************************************-->

<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>กิจกรรมชุมนุมลงทะเบียนสำเร็จแล้ว</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อกิจกรรมส่งเสริม</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
																																			$call_print_activity=new sturc_activity($user_login,$data_term,$data_yaer);
																																			$cpa=0;
																																			foreach($call_print_activity->print_sturcto() as $rc_key=>$call_print_activityRow){ 
																																				$cpa++;
																																			?>

                                    <tr>
                                        <td><?php echo $cpa;?></td>
                                        <td><?php echo $call_print_activityRow["activity_txt"];?></td>
                                    </tr>

                                    <?php	} ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
																										    if($call_print_activityRow["activity_showstudent"]=="ON"){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <form name="delete_activity" method="post" accept-charset="UTF-8">
                            <center>
                                <input type="hidden" name="activity_key" id="activity_key"
                                    value="<?php echo $call_print_activityRow["activity_key"];?>">
                                <button type="button" class="btn btn-success btn-lg" name="code_key" id="code_key"
                                    value="notkey_system">ยกเลิกลงทะเบียน</button>
                            </center>
                        </form>
                    </div>
                </div>
                <hr>
                <?php	}elseif($call_print_activityRow["activity_showstudent"]=="OFF"){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="alert alert-danger">
                            <strong>ไม่มีสิทธิ์ ! ยกเลิกลงทะเบียนกิจกรรมชุมนุม</strong>
                        </div>
                    </div>
                </div><br>
                <?php	}else{ ?>

                <?php	}      ?>
            </div>
        </div>
    </div>
</div>



<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<script>
$(document).ready(function() {
    $('#code_key').on('click', function() {
        swal({
                title: "ต้องการยกเลิกกิจกรรมชุมนุมใช้หรือไม่",
                text: "ยืนยันการยกเลิกกิจกรรมชุมนุม ถ้าแน่ใจว่าจะยกเลิกให้กด OK ถ้าไม่แน่ใจให้กด Cancel",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonColor: "#2196F3",
                showLoaderOnConfirm: true
            },
            function() {
                setTimeout(function() {
                    swal({
                        title: "ยกเลิกกิจกรรมชุมนุมสำเร็จ",
                        confirmButtonColor: "#2196F3"
                    }, function() {
                        var ActivityKey = $("#activity_key").val();
                        var CodeKey = $("#code_key").val();
                        if (ActivityKey != "" && CodeKey != "") {
                            $.post("./?evaluation_mod=activity_show", {
                                activity_key: ActivityKey,
                                code_key: CodeKey
                            }, function(rc) {
                                if (rc != "") {
                                    document.location ="./?evaluation_mod=activity";
                                } else {}
                            })
                        } else {}
                    });
                }, 2000);
            });
    });
})
</script>
<!--*************************************************************************************************************************************************************************************-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if($hr_arc%4==0){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*************************************************************************************************************************************************************************************-->
<?php	}else{ ?>
<!--*************************************************************************************************************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if($hr_arc%4==0){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <a id="Btn_activity<?php echo $hr_arc;?>" data-toggle="tooltip"
                            title="<?php echo $call_activityRow["activity_txt"];?>">
                            <div class="panel panel-body" style="background-color: #02FAF0">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                    </div>

                                    <div class="media-body">
                                        <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                            <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                            <div>
                                                <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                            </div>
                                        </font>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <a id="Btn_activity<?php echo $hr_arc;?>" data-toggle="tooltip"
                            title="<?php echo $call_activityRow["activity_txt"];?>">
                            <div class="panel panel-body" style="background-color: #02FAF0">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                    </div>

                                    <div class="media-body">
                                        <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                            <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                            <div>
                                                <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                            </div>
                                        </font>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!-- Modal -->
                    <div class="modal fade" id="Modal_activity<?php echo $hr_arc;?>" role="dialog">
                        <div class="modal-dialog">

                            <!--activity_taacher ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                            <?php 
			if($data_stu->IDLevel>=11 and $data_stu->IDLevel<=23){
				$teacher_activity=new activity_taacher($call_activityRow["activity_key"],$data_term,$data_yaer);
				$activity_adviser=new print_teacher_rc($teacher_activity->taacher_keyrc());
					$img_t=$activity_adviser->teacherRC_key().".jpg";
						if(isset($img_t)){
							if(file_exists("view/t/$img_t")){
								$adviser_img="view/t/$img_t";
							}else{
								$adviser_img="view/t/uesr.jpg";
							}								
						}else{
							//--------------------------------------
						}
			}elseif($data_stu->IDLevel>=31 and $data_stu->IDLevel<=43){
				$teacher_activity=new activity_taacher($call_activityRow["activity_key"],$data_term,$data_yaer);
				$activity_adviser=new regina_stu_data($teacher_activity->taacher_keyrc());
					if(file_exists("view/all/$activity_adviser->rsd_studentid.jpg")){
						$adviser_img="view/all/$activity_adviser->rsd_studentid.jpg";
					}else{
						$adviser_img="view/all/newimg_rc.jpg";
					}				
			}else{
				
			}
		?>
                            <!--activity_taacher End ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">กิจกรรมชุมนุม :
                                        <?php echo $call_activityRow["activity_txt"];?></h4>

                                    <?php
			if($data_stu->IDLevel>=11 and $data_stu->IDLevel<=23){ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <h4 class="modal-title">ครูชุมนุม :
                                        <?php echo $activity_adviser->teacherRC_nameTh();?></h4>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php
				if(isset($img_t)){ ?>
                                    <center><img src="<?php echo $adviser_img;?>" align="center" width="40%"
                                            class="img-thumbnail" alt=""></center>
                                    <?php	}else{ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}      ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}elseif($data_stu->IDLevel>=31 and $data_stu->IDLevel<=43){ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <h4 class="modal-title">ประธานชุมนุม :
                                        <?php echo "นางสาว ".$activity_adviser->rsd_name." ".$activity_adviser->rsd_surname;?>
                                    </h4>
                                    <center><img src="<?php echo $adviser_img;?>" align="center" width="40%"
                                            class="img-thumbnail" alt=""></center>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}else{ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}	   ?>



                                </div>
                                <div class="modal-body">


                                </div>
                                <div class="modal-footer">
                                    <form name="activityA" action="./?evaluation_mod=activity_show" method="post"
                                        accept-charset="UTF-8">
                                        <input type="hidden" name="activity_key"
                                            value="<?php echo $call_activityRow["activity_key"];?>">
                                        <button type="submit" class="btn btn-success" name="code_key"
                                            value="key_system">ลงทะเบียน</button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">ปิด</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Modal -->
                    <script>
                    $(document).ready(function() {
                        $("#Btn_activity<?php echo $hr_arc;?>").click(function() {
                            $("#Modal_activity<?php echo $hr_arc;?>").modal({
                                backdrop: false
                            });
                        });
                    })
                    </script>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php
									if($hr_arc>=1){
//------------------------------------------------------------------------------------------------
									}else{ ?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ ! </strong>
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php	}  ?>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php	}      ?>
<!--*******************************************************************************************-->

<!--*******************************************************************************************-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->
<?php }       ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<?php break;
		  case "OFF": ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>หมดเวลา ลงทะเบียนกิจกรรมชุมนุม พบข้อสงสัยกรุณาติดต่อ ห้องกิจการนักเรียน...</strong>
        </div>
    </div>
</div><br>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <center>
                    <h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมชุมนุม<div id="demoC"></div></h5>
                </center>
            </div>
        </div>
    </div>
</div>
<hr>
<!--*******************************************************************************************-->
<?php 
																							$count_SturcActivity=new sturc_activity($user_login,$data_term,$data_yaer);
																							$count_SA=0;
																							foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
																								$count_SA=$count_SA+1;
																							}
																								if(($count_SA>=1)){ ?>
<!--*************************************************************************************************************************************************************************************-->

<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>กิจกรรมชุมนุมลงทะเบียนสำเร็จแล้ว</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <div>ลำดับ</div>
                                        </th>
                                        <th>
                                            <div>ชื่อกิจกรรมชุมนุม/ส่งเสริม</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
																																			$call_print_activity=new sturc_activity($user_login,$data_term,$data_yaer);
																																			$cpa=0;
																																			foreach($call_print_activity->print_sturcto() as $rc_key=>$call_print_activityRow){ 
																																				$cpa++;
																																			?>

                                    <tr>
                                        <td>
                                            <div><?php echo $cpa;?></div>
                                        </td>
                                        <td>
                                            <div><?php echo $call_print_activityRow["activity_txt"];?></div>
                                        </td>
                                    </tr>

                                    <?php	} ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
																										    if($call_print_activityRow["activity_showstudent"]=="ON"){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <form name="delete_activity" method="post" accept-charset="UTF-8">
                            <center>
                                <input type="hidden" name="activity_key"
                                    value="<?php echo $call_print_activityRow['activity_key'];?>" id="activity_key">
                                <!--<button type="button" class="btn btn-success btn-lg" name="code_key" id="code_key"  value="notkey_system">ยกเลิกลงทะเบียน</button>-->
                            </center>
                        </form>
                    </div>
                </div>
                <hr>
                <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <?php	}elseif($call_print_activityRow["activity_showstudent"]=="OFF"){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="alert alert-danger">
                            <strong>ไม่มีสิทธิ์ ! ยกเลิกลงทะเบียนกิจกรรมชุมนุม</strong>
                        </div>
                    </div>
                </div><br>
                <?php	}else{ ?>

                <?php	}      ?>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if($hr_arc%4==0){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<?php	}else{ ?>
<!--*************************************************************************************************************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if($hr_arc%4==0){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php
									if($hr_arc>=1){
//------------------------------------------------------------------------------------------------
									}else{ ?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ ! </strong>
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php	}  ?>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php	}      ?>
<!--*******************************************************************************************-->

<!--*******************************************************************************************-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->


<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<?php break;
		  default: ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<?php	}   ?>
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<?php	}elseif(($data_stu->IDLevel==22 or $data_stu->IDLevel==23)){ //Open class M4 and M5 ?>
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<?php
	//time run------------------------------------------------------------------------------------  
		$datetime=date("Y-m-d H:i:s",strtotime("2023-05-22 00:00:00"));//สิ้นสุดการลงทะเบียน
		$datetime_cr=date("Y-m-d H:i:s");
		$datatime_notrun=strtotime($datetime);
		$datatime_run=strtotime($datetime_cr);
			if(($datatime_run>=$datatime_notrun)){
				$print_runtime="OFF";
			}else{
				$print_runtime="ON";
			}	
	//time run End--------------------------------------------------------------------------------
		$data_stu=new stu_levelpdo($user_login,$data_yaer,$data_term);
?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="breadcrumb-line breadcrumb-line-component">
            <ul class="breadcrumb">
                <h4><span class="text-semibold">ลงทะเบียนกิจกรรมชุมนุม ภาคเรียน
                        <?php echo $data_term." / ".$data_yaer;?></span></h4>
            </ul>
            <ul class="breadcrumb-elements">
                <div class="heading-btn-group">
                    <a href="./?evaluation_mod=#"
                        class="btn btn-link  text-size-small"><span>ลงทะเบียนกิจกรรมชุมนุม</span></a>
                </div>
            </ul>
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php
	switch($print_runtime){
		case "ON": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*******************************************************************************************-->
<?php
						$datetimeON="2023-05-20 08:00:00";	
						$datetime_crON=date("Y-m-d H:i:s");
						//$datetime_crON=$datetimeON;
						$datatime_notrunON=strtotime($datetimeON);
						$datatime_runON=strtotime($datetime_crON);	
						
							if(($datatime_runON>=$datatime_notrunON)){
								//$print_runtime="ON";
								$print_runtimeON="ON";
							}else{
								//$print_runtime="OFF";
								$print_runtimeON="OFF";
							}
					?>
<!--/////////////////////////////////////////////////////////////////////-->
<?php
						if($print_runtimeON=="OFF"){ ?>
<!--/////////////////////////////////////////////////////////////////////-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>
            <!--<strong>ยังไม่เปิดให้ลงทะเบียน&nbsp;!&nbsp;</strong>-->
        </div>
    </div>
</div><br>
<!--/////////////////////////////////////////////////////////////////////-->
<?php	}else{ ?>
<!--/////////////////////////////////////////////////////////////////////-->
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <center>
                    <h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมชุมนุม<div id="demoD"></div>
                    </h5>
                </center>
            </div>
        </div>
    </div>
</div>
<hr>
<!--*******************************************************************************************-->
<?php 
																							$count_SturcActivity=new sturc_activity($user_login,$data_term,$data_yaer);
																							$count_SA=0;
																							foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
																								$count_SA=$count_SA+1;
																							}
																								if($count_SA>=1){ ?>
<!--*************************************************************************************************************************************************************************************-->

<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>กิจกรรมชุมนุมลงทะเบียนสำเร็จแล้ว</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อกิจกรรมส่งเสริม</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
																																			$call_print_activity=new sturc_activity($user_login,$data_term,$data_yaer);
																																			$cpa=0;
																																			foreach($call_print_activity->print_sturcto() as $rc_key=>$call_print_activityRow){ 
																																				$cpa++;
																																			?>

                                    <tr>
                                        <td><?php echo $cpa;?></td>
                                        <td><?php echo $call_print_activityRow["activity_txt"];?></td>
                                    </tr>

                                    <?php	} ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
																										    if($call_print_activityRow["activity_showstudent"]=="ON"){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <form name="delete_activity" method="post" accept-charset="UTF-8">
                            <center>
                                <input type="hidden" name="activity_key" id="activity_key"
                                    value="<?php echo $call_print_activityRow["activity_key"];?>">
                                <button type="button" class="btn btn-success btn-lg" name="code_key" id="code_key"
                                    value="notkey_system">ยกเลิกลงทะเบียน</button>
                            </center>
                        </form>
                    </div>
                </div>
                <hr>
                <?php	}elseif($call_print_activityRow["activity_showstudent"]=="OFF"){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="alert alert-danger">
                            <strong>ไม่มีสิทธิ์ ! ยกเลิกลงทะเบียนกิจกรรมชุมนุม</strong>
                        </div>
                    </div>
                </div><br>
                <?php	}else{ ?>

                <?php	}      ?>
            </div>
        </div>
    </div>
</div>



<!--*************************************************************************************************************************************************************************************-->
<script>
$(document).ready(function() {
    $('#code_key').on('click', function() {
        swal({
                title: "ต้องการยกเลิกกิจกรรมชุมนุมใช้หรือไม่",
                text: "ยืนยันการยกเลิกกิจกรรมชุมนุม ถ้าแน่ใจว่าจะยกเลิกให้กด OK ถ้าไม่แน่ใจให้กด Cancel",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonColor: "#2196F3",
                showLoaderOnConfirm: true
            },
            function() {
                setTimeout(function() {
                    swal({
                        title: "ยกเลิกกิจกรรมชุมนุมสำเร็จ",
                        confirmButtonColor: "#2196F3"
                    }, function() {
                        var ActivityKey = $("#activity_key").val();
                        var CodeKey = $("#code_key").val();
                        if (ActivityKey != "" && CodeKey != "") {
                            $.post("./?evaluation_mod=activity_show", {
                                activity_key: ActivityKey,
                                code_key: CodeKey
                            }, function(rc) {
                                if (rc != "") {
                                    document.location =
                                        "./?evaluation_mod=activity";
                                } else {}
                            })
                        } else {}
                    });
                }, 2000);
            });
    });
})
</script>
<!--*************************************************************************************************************************************************************************************-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if($hr_arc%4==0){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--*************************************************************************************************************************************************************************************-->
<?php	}else{ ?>
<!--*************************************************************************************************************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if($hr_arc%4==0){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <a id="Btn_activity<?php echo $hr_arc;?>" data-toggle="tooltip"
                            title="<?php echo $call_activityRow["activity_txt"];?>">
                            <div class="panel panel-body" style="background-color: #02FAF0">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                    </div>

                                    <div class="media-body">
                                        <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                            <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                            <div>
                                                <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                            </div>
                                        </font>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <a id="Btn_activity<?php echo $hr_arc;?>" data-toggle="tooltip"
                            title="<?php echo $call_activityRow["activity_txt"];?>">
                            <div class="panel panel-body" style="background-color: #02FAF0">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                    </div>

                                    <div class="media-body">
                                        <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                            <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                            <div>
                                                <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                            </div>
                                        </font>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!-- Modal -->
                    <div class="modal fade" id="Modal_activity<?php echo $hr_arc;?>" role="dialog">
                        <div class="modal-dialog">

                            <!--activity_taacher ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                            <?php 
			if(($data_stu->IDLevel>=11 and $data_stu->IDLevel<=23)){
				$teacher_activity=new activity_taacher($call_activityRow["activity_key"],$data_term,$data_yaer);
				$activity_adviser=new print_teacher_rc($teacher_activity->taacher_keyrc());
					$img_t=$activity_adviser->teacherRC_key().".jpg";
						if(isset($img_t)){
							if(file_exists("view/t/$img_t")){
								$adviser_img="view/t/$img_t";
							}else{
								$adviser_img="view/t/uesr.jpg";
							}								
						}else{
							//--------------------------------------
						}
			}elseif(($data_stu->IDLevel>=31 and $data_stu->IDLevel<=43)){
				$teacher_activity=new activity_taacher($call_activityRow["activity_key"],$data_term,$data_yaer);
				$activity_adviser=new regina_stu_data($teacher_activity->taacher_keyrc());
					if(file_exists("view/all/$activity_adviser->rsd_studentid.jpg")){
						$adviser_img="view/all/$activity_adviser->rsd_studentid.jpg";
					}else{
						$adviser_img="view/all/newimg_rc.jpg";
					}				
			}else{
				
			}
		?>
                            <!--activity_taacher End ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">กิจกรรมชุมนุม :
                                        <?php echo $call_activityRow["activity_txt"];?></h4>

                                    <?php
			if(($data_stu->IDLevel>=11 and $data_stu->IDLevel<=23)){ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <h4 class="modal-title">ครูชุมนุม :
                                        <?php echo $activity_adviser->teacherRC_nameTh();?></h4>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php
				if((isset($img_t))){ ?>
                                    <center><img src="<?php echo $adviser_img;?>" align="center" width="40%" class="img-thumbnail" alt=""></center>
                                    <?php	}else{ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}      ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}elseif(($data_stu->IDLevel>=31 and $data_stu->IDLevel<=43)){ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <h4 class="modal-title">ประธานชุมนุม :
                                        <?php echo "นางสาว ".$activity_adviser->rsd_name." ".$activity_adviser->rsd_surname;?>
                                    </h4>
                                    <center><img src="<?php echo $adviser_img;?>" align="center" width="40%"
                                            class="img-thumbnail" alt=""></center>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}else{ ?>
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                    <?php	}	   ?>



                                </div>
                                <div class="modal-body">


                                </div>
                                <div class="modal-footer">
                                    <form name="activityA" action="./?evaluation_mod=activity_show" method="post"
                                        accept-charset="UTF-8">
                                        <input type="hidden" name="activity_key"
                                            value="<?php echo $call_activityRow["activity_key"];?>">
                                        <button type="submit" class="btn btn-success" name="code_key"
                                            value="key_system">ลงทะเบียน</button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">ปิด</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Modal -->
                    <script>
                    $(document).ready(function() {
                        $("#Btn_activity<?php echo $hr_arc;?>").click(function() {
                            $("#Modal_activity<?php echo $hr_arc;?>").modal({
                                backdrop: false
                            });
                        });
                    })
                    </script>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php
									if($hr_arc>=1){
//------------------------------------------------------------------------------------------------
									}else{ ?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ ! </strong>
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php	}  ?>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php	}      ?>
<!--*******************************************************************************************-->

<!--*******************************************************************************************-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->
<?php }       ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<?php break;
		  case "OFF": ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>หมดเวลา ลงทะเบียนกิจกรรมชุมนุม พบข้อสงสัยกรุณาติดต่อ ห้องกิจการนักเรียน...</strong>
        </div>
    </div>
</div><br>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <center>
                    <h5>เหลือเวลาลงทะเบียนเรียน กิจกรรมชุมนุม<div id="demoD"></div>
                    </h5>
                </center>
            </div>
        </div>
    </div>
</div>
<hr>
<!--*******************************************************************************************-->
<?php 
																							$count_SturcActivity=new sturc_activity($user_login,$data_term,$data_yaer);
																							$count_SA=0;
																							foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
																								$count_SA=$count_SA+1;
																							}
																								if($count_SA>=1){ ?>
<!--*************************************************************************************************************************************************************************************-->

<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>กิจกรรมชุมนุมลงทะเบียนสำเร็จแล้ว</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <div>ลำดับ</div>
                                        </th>
                                        <th>
                                            <div>ชื่อกิจกรรมชุมนุม/ส่งเสริม</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
																																			$call_print_activity=new sturc_activity($user_login,$data_term,$data_yaer);
																																			$cpa=0;
																																			foreach($call_print_activity->print_sturcto() as $rc_key=>$call_print_activityRow){ 
																																				$cpa++;
																																			?>

                                    <tr>
                                        <td>
                                            <div><?php echo $cpa;?></div>
                                        </td>
                                        <td>
                                            <div><?php echo $call_print_activityRow["activity_txt"];?></div>
                                        </td>
                                    </tr>

                                    <?php	} ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
																										    if($call_print_activityRow["activity_showstudent"]=="ON"){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <form name="delete_activity" method="post" accept-charset="UTF-8">
                            <center>
                                <input type="hidden" name="activity_key"
                                    value="<?php echo $call_print_activityRow['activity_key'];?>" id="activity_key">
                                <!--<button type="button" class="btn btn-success btn-lg" name="code_key" id="code_key"  value="notkey_system">ยกเลิกลงทะเบียน</button>-->
                            </center>
                        </form>
                    </div>
                </div>
                <hr>
                <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                <?php	}elseif($call_print_activityRow["activity_showstudent"]=="OFF"){ ?>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="alert alert-danger">
                            <strong>ไม่มีสิทธิ์ ! ยกเลิกลงทะเบียนกิจกรรมชุมนุม</strong>
                        </div>
                    </div>
                </div><br>
                <?php	}else{ ?>

                <?php	}      ?>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF"){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if($hr_arc%4==0){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<?php	}else{ ?>
<!--*************************************************************************************************************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #0642FA">
                <h4>
                    <center>รายชื่อกิจกรรมชุมนุม</center>
                </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <?php
																											$call_activityRc=new activityRc($data_stu->IDLevel,$data_stu->rc_plan,$data_term,$data_yaer);
																											$hr_arc=0;
																											foreach($call_activityRc->print_activityRcto() as $rc_key=>$call_activityRow){ 
																												
																												if(($call_activityRow["activity_showstudent"]=="ON" or $call_activityRow["activity_showstudent"]=="OFF")){ ?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php 
																																										$show_num_activity=new check_activity($call_activityRow["activity_key"],$data_term,$data_yaer);
																																									?>




                    <?php
																																											if($hr_arc%4==0){ ?>
                </div><br>
                <div class="row">
                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}else{ ?>

                    <div class="col-<?php echo $grid;?>-3">
                        <div class="panel panel-body" style="background-color: #02FAF0">
                            <div class="media">
                                <div class="media-left">
                                    <i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i>
                                </div>

                                <div class="media-body">
                                    <font style="color: #0642FA; font-size: 16px; font-family: THSarabunNew;">
                                        <div><b><?php echo $call_activityRow["activity_txt"];?></b></div>
                                        <div>
                                            <?php echo $show_num_activity->ak_count;?>/<?php echo $show_num_activity->ak_keep;?>
                                        </div>
                                    </font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php	}?>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                    <?php	$hr_arc=$hr_arc+1;}else{
//**********************************************************************************************************************************************************************************************************************																													
																												}
																										}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php
									if(($hr_arc>=1)){
//------------------------------------------------------------------------------------------------
									}else{ ?>
<!--*******************************************************************************************-->
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>ไม่มีสิทธิ์ การใช้งานในส่วนนี้ ! </strong>
        </div>
    </div>
</div><br>
<!--*******************************************************************************************-->
<?php	}  ?>
<!--*************************************************************************************************************************************************************************************-->
<!--*************************************************************************************************************************************************************************************-->
<?php	}      ?>
<!--*******************************************************************************************-->

<!--*******************************************************************************************-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<?php break;
		  default: ?>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<?php	}   ?>
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<!--*******************************************************************************************-->
<?php   }else{ ?>
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="alert alert-danger">
            <strong>พบข้อผิดพลาด </strong> ไม่สามารถใช้งานได้ มีข้อสังสัยกรุณาติดต่อสอบถามได้ที่ งาน ฝ่าย ICT 053-282395
            ต่อ 108
        </div>
    </div>
</div><br>
<?php	} ?>