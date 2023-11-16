<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
/* set the cache limiter to 'private' */
	//session_cache_limiter("regina");
	//$cache_limiter = session_cache_limiter();

/* set the cache expire to 30 minutes */
	//session_cache_expire(20);
	//$cache_expire = session_cache_expire();

/* start the session */
	//session_start();
	//ob_start();
	$this->load->library('session');
    
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
	header("Content-Type: text/html; charset=utf-8");
	header("Cache-control: private");

	include("view/database/database_evaluation.php");
	
	$evaluation_mod=isset($_GET["evaluation_mod"]) ? $_GET["evaluation_mod"] : "home";
	$rcdata_connect= connect();
//-----------------------------------------------------------------------------------
	$rc_y=2566;
	$rc_t=2;
//-----------------------------------------------------------------------------------	
	if(($this->session->userdata('rc_user')==null)){
		$this->session->unset_userdata('rc_user');
		exit("<script>window.location='$golink/rc/loginrc';</script>");
	}else{
		$rc_user=$this->session->userdata('rc_user');
		$log_user_student="select `rc_prefix`.`prefixname`,`regina_stu_data`.`rsd_name`,`regina_stu_data`.`rsd_surname`
		                 ,`regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`regina_stu_login`.`model1`
						 ,`regina_stu_login`.`model2`,`regina_stu_login`.`rsl_login`
						   from `regina_stu_data` join `regina_stu_login` on(`regina_stu_data`.`rsd_studentid`=`regina_stu_login`.`rsd_studentid`)
						   join `rc_prefix` on(`regina_stu_data`.`rsd_prefix`=`rc_prefix`.`IDPrefix`)
						   WHERE `regina_stu_login`.`rsl_user`='{$rc_user}';";
		$log_user_studentRs=$rcdata_connect->query($log_user_student) or die($log_user_studentRs->error);
		if(($log_user_studentRs->num_rows)){
			$log_user_studentRow=$log_user_studentRs->fetch_assoc();
			$user_login=$log_user_studentRow["rsd_studentid"];
			//$myname=$log_user_studentRow["prefixname"]." ".$log_user_studentRow["rsd_name"]." ".$log_user_studentRow["rsd_surname"];
			$myname=$log_user_studentRow["rsd_name"]." ".$log_user_studentRow["rsd_surname"];
			$model1=$log_user_studentRow["model1"];
			$model2=$log_user_studentRow["model2"];
			$login=$log_user_studentRow["rsl_login"];
			$Identification=$log_user_studentRow["rsd_Identification"];
//------------------------------------------------------------------------------------------------------			
			$classSql="select `rc_plan`.`LName` as `PlanName`,`rc_level`.`Lname` as `LevelName`,`regina_stu_class`.`rsc_class`,`regina_stu_class`.`rsc_plan` 
					   from `regina_stu_class` 
					   join `rc_level` on (`regina_stu_class`.`rsc_class`=`rc_level`.`IDLevel`)
					   join `rc_plan` on (`regina_stu_class`.`rsc_plan`=`rc_plan`.`IDPlan`)
					   where `regina_stu_class`.`rsc_year`='{$rc_y}' 
					   and `regina_stu_class`.`rsc_term`='{$rc_t}' 
					   and `regina_stu_class`.`rsd_studentid`='{$user_login}'
					   and `regina_stu_class`.`rsc_status`='1'";
			$classRs=$rcdata_connect->query($classSql) or die($classRs->error);
				if(($classRs->num_rows)){
					$classRow=$classRs->fetch_assoc();
					$txt_class=$classRow["LevelName"];
					$TxtIdClass=$classRow["rsc_class"];
					$txt_plan=$classRow["PlanName"];
					$plan_id=$classRow["rsc_plan"];
				}else{
					$txt_class=null;
					$TxtIdClass=null;
					$txt_plan=null;
					$plan_id=null;
				}
//------------------------------------------------------------------------------------------------------			
			//$keep_login=$log_user_studentRow["regina_stu_login"];
						
			/*if(file_exists("view/all/$user_login.jpg")){
				$user_img="view/all/$user_login.jpg";
			}else{
				if(file_exists("view/all/$user_login.JPG")){
					$user_img="view/all/$user_login.JPG";
				}else{
					$user_img="view/all/newimg_rc.jpg";
				}
			}*/
				if((file_exists("view/all/$user_login.jpg"))){
					$user_img="view/all/$user_login.jpg";
				}else{
					$user_img="view/all/newimg_rc.jpg";
				}
//----------System-----------------------------------------------------||			
			require_once("view/database/connect_login.php");		   //		
			$evaluation_load="view/mod/student/{$evaluation_mod}.php";//
			$group="S"; 
			$link_system="user";
			$copy_evaluation_mod=$evaluation_mod;
			//
//----------System----------------------------------------------------||			
			
		}else{
			$log_user_admin="select `login`.`login_rc`,`login`.`login_update`,`login`.`group`,`data_teacher`.`dt_name`,`data_teacher`.`dt_last_names`
						   ,`login`.`model1`,`login`.`model2`,`login`.`login_status`
                             from `data_teacher` join `login` on(`data_teacher`.`dt_rc`=`login`.`login_rc`)
                             where `login`.`use_status`='1' and `login`.`login_id`='{$rc_user}'";
			$log_user_adminRs=$rcdata_connect->query($log_user_admin) or die($log_user_adminRs->error);
			if(($log_user_adminRs->num_rows)){	
				$log_user_adminRow=$log_user_adminRs->fetch_assoc();
				$group=$log_user_adminRow["group"];
				$user_login=$log_user_adminRow["login_rc"];
				$myname=$log_user_adminRow["dt_name"]." ".$log_user_adminRow["dt_last_names"];
				$model1=$log_user_adminRow["model1"];
				$model2=$log_user_adminRow["model2"];
				$login=$log_user_adminRow["login_status"];
				$user_img="view/t/$user_login.jpg";
				$link_system="admin";
				$copy_evaluation_mod=$evaluation_mod;
				//$keep_login=$login;
				if(($group=="A")){
					$evaluation_load="view/mod/admin/{$evaluation_mod}.php";
				}elseif(($group=="B")){
					$evaluation_load="view/mod/admin/{$evaluation_mod}.php";
				}elseif(($group=="C")){
					$evaluation_load="view/mod/admin/{$evaluation_mod}.php";
				}elseif(($group=="D")){
					$evaluation_load="view/mod/admin/{$evaluation_mod}.php";
				}elseif(($group=="F")){
					$evaluation_load="view/mod/admin/{$evaluation_mod}.php";
				}else{
					session_destroy();
					exit("<script>window.location='$golink/rc/loginrc';</script>");
				}
//----------System----------------------------------------------------||			
			require_once("view/database/connect_admin.php");		  //	
		  //$evaluation_load="view/mod/student/{$evaluation_mod}.php";//
//----------System----------------------------------------------------||				
			}else{
				exit("<script>window.location='$golink/rc/loginrc';</script>");
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="stats-in-th" content="b062" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="shortcut icon"
        type="image/png">
    <link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon">
    <link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon"
        sizes="72x72">
    <link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon"
        sizes="114x114">
    <link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon"
        sizes="144x144">


    <?php
		if($evaluation_mod=="aft_person"){
			echo'<title>สรุปผลการประเมินรายบุคคล ประเมินความพึงพอใจการจัดการเรียนการสอน</title>';
		}elseif($evaluation_mod=="supplementary_stu"){
			echo'<title>ข้อมูลนักเรียน เรียนเสริมเย็น</title>';
		}else{
			echo'<title>ระบบนักเรียน โรงเรียนเรยีนาเชลีวิทยาลัย</title>';
		}
	?>

    <!-- Global stylesheets -->

    <link href="<?php echo base_url();?>/Template/global_assets/css/icons/icomoon/styles.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/bootstrap.min.css"
        rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/core.min.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/components.min.css"
        rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/colors.min.css" rel="stylesheet"
        type="text/css">
    <!-- /global stylesheets -->

    <style>
    @font-face {
        font-family: 'surafont_sanukchang';
        src: url('view/font/surafont_sanukchang.eot');
        src: url('view/font/surafont_sanukchang.eot?#iefix') format('embedded-opentype'),
            url('view/font/surafont_sanukchang.woff') format('woff'),
            url('view/font/surafont_sanukchang.ttf') format('truetype');
    }

    body {
        font-family: "surafont_sanukchang";
        font-size: 15px;

    }
    </style>

    <?php
		if(($evaluation_mod=="aft_form")){ ?>
    <style type="text/css">
    body {
        background-color: #fafafa;
    }

    img {
        display: block;
    }

    .imgBox {
        width: 210px;
        height: 267px;
        border: 0px solid #222;
    }
    </style>
    <link rel="stylesheet"
        href="<?php echo base_url();?>/view/js_css_code/icheck-bootstrap-master/icheck-bootstrap.min.css" />
    <?php	}elseif(($evaluation_mod=="account_settings")){ ?>
    <link rel="stylesheet"
        href="<?php echo base_url();?>/view/js_css_code/icheck-bootstrap-master/icheck-bootstrap.min.css" />
    <?php   }elseif(($evaluation_mod=="questionnaire")){ ?>
    <link rel="stylesheet"
        href="<?php echo base_url();?>/view/js_css_code/icheck-bootstrap-master/icheck-bootstrap.min.css" />
    <?php   }elseif(($evaluation_mod=="profile_modify")){ ?>
    <link rel="stylesheet"
        href="<?php echo base_url();?>/view/js_css_code/icheck-bootstrap-master/icheck-bootstrap.min.css" />
    <link rel="stylesheet"
        href="<?php echo base_url();?>/view/js_css_code/Simple-Lightweight-jQuery-Input-Mask-Plugin-Masked-input/demo/css/main.css">
    <?php   }elseif(($evaluation_mod=="edit_student")){ ?>
    <link rel="stylesheet"
        href="<?php echo base_url();?>/view/js_css_code/icheck-bootstrap-master/icheck-bootstrap.min.css" />
    <link rel="stylesheet"
        href="<?php echo base_url();?>/view/js_css_code/Simple-Lightweight-jQuery-Input-Mask-Plugin-Masked-input/demo/css/main.css">
    <?php   }elseif(($evaluation_mod=="home")){ 
			if(($group=="S")){ ?>
    <style>
    #myBtn {
        width: 300px;
        padding: 10px;
        font-size: 20px;
        position: absolute;
        margin: 0 auto;
        right: 0;
        left: 0;
        bottom: 50px;
        z-index: 9999;
    }
    </style>
    <?php		}else{}
		}else{ 
		
		}    
		?>
    <!--****************************************************************************-->
    <script type="text/javascript">
    function setScreenHWCookie() {
        $.cookie('sw', screen.width);
        //$.cookie('sh',screen.height);
        return true;
    }
    setScreenHWCookie();
    </script>

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
    <!--****************************************************************************-->
    <!-- Core JS files -->
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/loaders/pace.min.js"></script>
    <script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery.min.js"></script>
    <script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <?php
	switch ($link_system){
		case "user":
			if(($evaluation_mod=="aft_course")){
				include("view/mod/student/code/aft_course/aft_course_js.php");
			}elseif(($evaluation_mod=="aft_form")){
				include("view/mod/student/code/aft_form/aft_form_js.php");
			}elseif(($evaluation_mod=="aft_form_code")){
				include("view/mod/student/code/aft_form/aft_form_js.php");
			}elseif(($evaluation_mod=="profile")){
				include("view/mod/student/code/profile/profile_js.php");
			}elseif($evaluation_mod=="profile_modify"){
				include("view/mod/student/code/profile/profile_js.php");
			}elseif($evaluation_mod=="favorite_teacher"){
				include("view/mod/student/code/favorite_teacher/favorite_teacher_js.php");
			}elseif($evaluation_mod=="account_settings"){
				include("view/mod/student/code/account_settings/account_settings_js.php");
			}elseif($evaluation_mod=="questionnaire"){
				include("view/mod/student/code/questionnaire/questionnaire_js.php");
			}elseif($evaluation_mod=="questionnaire_code"){
				include("view/mod/student/code/questionnaire/questionnaire_js.php");
			}elseif($evaluation_mod=="final_term"){
				include("view/mod/student/code/final_term/final_term_js.php");
			}elseif($evaluation_mod=="stu_book"){
				include("view/mod/student/code/stu_book/stu_book_js.php");
			}elseif($evaluation_mod=="tuition_fee"){
				include("view/mod/student/code/tuition_fee/tuition_fee_js.php");
			}elseif($evaluation_mod=="stu_supplementary"){
				include("view/mod/student/code/stu_supplementary/stu_supplementary_js.php");
			}elseif($evaluation_mod=="supplementary"){
				include("view/mod/student/code/stu_supplementary/stu_supplementary_js.php");
			}elseif($evaluation_mod=="rc_quota"){
				include("view/mod/student/code/rc_quota/rc_quota_js.php");
			}elseif($evaluation_mod=="quota"){
				include("view/mod/student/code/rc_quota/rc_quota_js.php");
			}elseif($evaluation_mod=="activity" or $evaluation_mod=="activity_show" or $evaluation_mod=="activity_rc"){
				include("view/mod/student/code/activity/activity_js.php");
			}elseif($evaluation_mod=="quotak"){
				include("view/mod/student/code/quotak/quotak_js.php");
			}elseif($evaluation_mod=="talent_student" or $evaluation_mod=="talent_student_code"){
				include("view/mod/student/code/talent_student/talent_student_js.php");
			}elseif($evaluation_mod=="intention_quotas" or $evaluation_mod=="intention_quotas_code"){
				include("view/mod/student/code/intention_quotas/intention_quotas_js.php");
			}elseif(($evaluation_mod=="rc_summer")){
				include("view/mod/student/code/rc_summer/rc_summer_js.php");
			}elseif(($evaluation_mod=="weekend_class")){
				include("view/mod/student/code/weekend_class/weekend_class_js.php");
			}elseif(($evaluation_mod=="smart_card_sud")){
				include("view/mod/student/code/smart_card_sud/smart_card_sud_js.php");
			}elseif(($evaluation_mod=="regina_bursary")){
				include("view/mod/student/code/regina_bursary/regina_bursary_js.php");
			}else{ ?>
    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <!-- Theme JS files user_pages_profile_cover-->
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/fullcalendar/fullcalendar.min.js">
    </script>
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/visualization/echarts/echarts.min.js">
    </script>

    <script src="<?php echo base_url();?>/Template/global_assets/js/demo_pages/user_pages_profile.js"></script>
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/ripple.min.js"></script>
    <!-- /theme JS files -->

    <!-- Theme JS files -->
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>


    <script src="<?php echo base_url();?>/Template/global_assets/js/demo_pages/general_widgets_stats.js"></script>


    <!-- /theme JS files -->

    <!-- Theme JS files -->
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/noty.min.js"></script>
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/jgrowl.min.js"></script>

    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/ripple.min.js"></script>
    <!-- /theme JS files -->



    <script>
    function noty_info() {

        Noty.overrideDefaults({
            theme: 'limitless',
            layout: 'topRight',
            type: 'alert',
            timeout: 2500

        });

        new Noty({
            text: 'ยินดีต้อนรับ <?php echo $myname;?> เข้าสู่ระบบ',
            type: 'info'
        }).show();
    }
    </script>


    <script>
    $(document).ready(function() {
        // Show the Modal on load
        $("#myModal").modal("show");

        // Hide the Modal
        $("#myBtn").click(function() {
            $("#myModal").modal("hide");
        });
    });
    </script>

    <script>
    $(function() {
        $("#RunLoadHome").fadeOut(5000, function() {
            $("#RuningLoadHome").fadeIn(4000);
        });
    });
    </script>



    <script type="text/javascript">
    //disable back button
    history.pushState(null, null, '');
    window.addEventListener('popstate', function(event) {
        history.pushState(null, null, '');
    });
    </script>
    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <?php	} ?>
    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <!-- Theme JS files components_modals-->
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#sweet_warning,#sweet_warning2').on('click', function() {
            swal({
                title: "คุณแน่ใจใช้ไหม ?",
                text: "คุณต้องการออกจากระบบ...",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#FF7043",
                confirmButtonText: "ใช้,  ต้องการออกจากระบบ"
            }, function(gotologin) {
                if (gotologin) {
                    document.location = "<?php echo base_url();?>/rc/logout"
                } else {
                    //--------------------------------------------------------------
                }
            })
        })
    })
    </script>
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/ripple.min.js"></script>
    <!-- /theme JS files -->
    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <?php	break;
		case "admin":
			if($evaluation_mod=="favorite_data"){
				include("view/mod/admin/code/favorite_data/favorite_data_js.php");
			}elseif($evaluation_mod=="favorite_score"){
				include("view/mod/admin/code/favorite_score/favorite_score_js.php");
			}elseif($evaluation_mod=="favorite_score_data1"){
				include("view/mod/admin/code/favorite_score/favorite_score_js.php");			
			}elseif($evaluation_mod=="favorite_score_data2"){
				include("view/mod/admin/code/favorite_score/favorite_score_js.php");
			}elseif($evaluation_mod=="favorite_score_data3"){
				include("view/mod/admin/code/favorite_score/favorite_score_js.php");			
			}elseif($evaluation_mod=="favorite_score_info"){
				include("view/mod/admin/code/favorite_score/favorite_score_js.php");			
			}elseif($evaluation_mod=="aft_student"){
				include("view/mod/admin/code/aft_student/aft_student_js.php");
			}elseif($evaluation_mod=="aft_school"){
				include("view/mod/admin/code/aft_school/aft_school_js.php");		
			}elseif($evaluation_mod=="aft_person"){
				include("view/mod/admin/code/aft_person/aft_person_js.php");
			}elseif($evaluation_mod=="aft_data_teacher"){
				include("view/mod/admin/code/aft_data_teacher/aft_data_teacher_js.php");			
			}elseif($evaluation_mod=="aft_teacher"){
				include("view/mod/admin/code/aft_data_teacher/aft_data_teacher_js.php");		
			}elseif($evaluation_mod=="sturc_dataall" or $evaluation_mod=="data_rc"){
				include("view/mod/admin/code/sturc_dataall/sturc_dataall_js.php");		
			}elseif($evaluation_mod=="overdue"){
				include("view/mod/admin/code/overdue/overdue_js.php");		
			}elseif($evaluation_mod=="overdue_add"){
				include("view/mod/admin/code/overdue_add/overdue_add_js.php");
			}elseif($evaluation_mod=="overdue_code"){ 
				include("view/mod/admin/code/overdue_code/overdue_code_js.php");		
			}elseif($evaluation_mod=="sar_grade"){
				include("view/mod/admin/code/sar_grade/sar_grade_js.php");
			}elseif($evaluation_mod=="supplementary"){
				include("view/mod/admin/code/supplementary/pay_supplementary_qr_js.php");		
			}elseif($evaluation_mod=="supplementary_count"){		
				include("view/mod/admin/code/supplementary_count/supplementary_count_js.php");
			}elseif($evaluation_mod=="stu_room"){
				include("view/mod/admin/code/stu_room/stu_room_js.php");	
			}elseif($evaluation_mod=="stu_roomimg"){
				include("view/mod/admin/code/stu_roomimg/stu_roomimg_js.php");		
			}elseif($evaluation_mod=="stu_databook"){
				include("view/mod/admin/code/stu_databook/stu_databook_js.php");
			}elseif($evaluation_mod=="supplementary_data"){
				include("view/mod/admin/code/supplementary_data/supplementary_data_js.php");
			}elseif($evaluation_mod=="supplementary_datastu"){
				include("view/mod/admin/code/supplementary_datastu/supplementary_datastu_js.php");
			}elseif($evaluation_mod=="supplementary_datanotstu"){
				include("view/mod/admin/code/supplementary_datanotstu/supplementary_datanotstu_js.php");		
			}elseif($evaluation_mod=="supplementary_stu"){
				include("view/mod/admin/code/supplementary_data/supplementary_data_js.php");		
			}elseif($evaluation_mod=="work_admin"){
				include("view/mod/admin/code/work_admin/work_admin_js.php");		
			}elseif($evaluation_mod=="edit_student"){
				include("view/mod/admin/code/edit_student/profile_js.php");		
			}elseif($evaluation_mod=="Internal_quota_testing_plan"){
				include("view/mod/admin/code/Internal_quota_testing_plan/Internal_quota_testing_plan_js.php");
			}elseif($evaluation_mod=="quota_academic"){
				include("view/mod/admin/code/quota_academic/quota_academic_js.php");
			}elseif($evaluation_mod=="quota_capital"){
				include("view/mod/admin/code/quota_capital/quota_capital_js.php");
			}elseif($evaluation_mod=="stu_check_up"){	
				include("view/mod/admin/code/stu_check_up/stu_check_up_js.php");		
			}elseif($evaluation_mod=="stu_check_code"){	
				include("view/mod/admin/code/stu_check_up/stu_check_up_js.php");			
			}elseif($evaluation_mod=="quota_show"){
				include("view/mod/admin/code/quota_show/quota_show_js.php");	
			}elseif($evaluation_mod=="admin_quota"){
				include("view/mod/admin/code/admin_quota/admin_quota_js.php");
			}elseif($evaluation_mod=="quota_dataall"){
				include("view/mod/admin/code/quota_dataall/quota_dataall_js.php");
			}elseif($evaluation_mod=="information"){
				include("view/mod/admin/code/information/information_js.php");
			}elseif($evaluation_mod=="data_swis_tab1"){
				include("view/mod/admin/code/data_swis_tab1/data_swis_tab1_js.php");				
			}elseif($evaluation_mod=="data_swis_tab2"){
				include("view/mod/admin/code/data_swis_tab2/data_swis_tab2_js.php");				
			}elseif($evaluation_mod=="data_swis_tab3"){
				include("view/mod/admin/code/data_swis_tab3/data_swis_tab3_js.php");				
			}elseif($evaluation_mod=="data_swis_tab4"){
				include("view/mod/admin/code/data_swis_tab4/data_swis_tab4_js.php");				
			}elseif($evaluation_mod=="data_swis_tab5"){
				include("view/mod/admin/code/data_swis_tab5/data_swis_tab5_js.php");				
			}elseif($evaluation_mod=="data_swis_tab6"){
				include("view/mod/admin/code/data_swis_tab6/data_swis_tab6_js.php");
			}elseif($evaluation_mod=="data_swis_tab7"){
				include("view/mod/admin/code/data_swis_tab7/data_swis_tab7_js.php");	
			}elseif($evaluation_mod=="updata_swis_tab1"){
				include("view/mod/admin/code/updata_swis_tab1/data_swis_tab1_js.php");				
			}elseif($evaluation_mod=="updata_swis_tab2"){
				include("view/mod/admin/code/updata_swis_tab2/data_swis_tab2_js.php");				
			}elseif($evaluation_mod=="updata_swis_tab3"){
				include("view/mod/admin/code/updata_swis_tab3/data_swis_tab3_js.php");				
			}elseif($evaluation_mod=="updata_swis_tab4"){
				include("view/mod/admin/code/updata_swis_tab4/data_swis_tab4_js.php");				
			}elseif($evaluation_mod=="updata_swis_tab5"){
				include("view/mod/admin/code/updata_swis_tab5/data_swis_tab5_js.php");				
			}elseif($evaluation_mod=="updata_swis_tab6"){
				include("view/mod/admin/code/updata_swis_tab6/data_swis_tab6_js.php");
			}elseif($evaluation_mod=="updata_swis_tab7"){
				include("view/mod/admin/code/updata_swis_tab7/data_swis_tab7_js.php");	
			}elseif($evaluation_mod=="print_imgstu"){
				include("view/mod/admin/code/print_imgstu/print_imgstu_js.php");				
			}elseif($evaluation_mod=="fee_pay_qrcode"){
				include("view/mod/admin/code/fee_pay_qrcode/fee_pay_qrcode_js.php");
			}elseif($evaluation_mod=="qrcode_payment_up" or $evaluation_mod=="qrcode_payment_up_code"){
				include("view/mod/admin/code/qrcode_payment_up/qrcode_payment_up_js.php");
			}elseif($evaluation_mod=="fee_pay_set"){
				include("view/mod/admin/code/fee_pay_set/fee_pay_set_js.php");
			}elseif($evaluation_mod=="save_scbpay"){
				include("view/mod/admin/code/save_scbpay/save_scbpay_js.php");
			}elseif($evaluation_mod=="activity_show"){
				include("view/mod/admin/code/activity_show/activity_show_js.php");
			}elseif($evaluation_mod=="activity_stu"){
				include("view/mod/admin/code/activity_stu/activity_stu_js.php");
			}elseif($evaluation_mod=="data_stunew"){
				include("view/mod/admin/code/data_stunew/data_stunew_js.php");
			}elseif($evaluation_mod=="show_stunew"){
				include("view/mod/admin/code/show_stunew/show_stunew_js.php");
			}elseif($evaluation_mod=="books_dataup" or $evaluation_mod=="books_qrcodeup" or $evaluation_mod=="books_up_code"){
				include("view/mod/admin/code/book_up/book_up_js.php");
			}elseif($evaluation_mod=="updata_health" or $evaluation_mod=="updata_health_code"){
				include("view/mod/admin/code/updata_health/updata_health_js.php");
			}elseif($evaluation_mod=="excel2_health" or $evaluation_mod=="excel_health"){
				include("view/mod/admin/code/updata_health/excel_health_js.php");
			}elseif(($evaluation_mod=="language_activities" or $evaluation_mod=="language_activities_run")){
				include("view/mod/admin/code/language_activities/language_activities_js.php");
			}elseif($evaluation_mod=="activity_statistics"){
				include("view/mod/admin/code/activity_statistics/activity_statistics_js.php");
			}elseif($evaluation_mod=="runing_studentnew"){
				include("view/mod/admin/code/runing_studentnew/runing_studentnew_js.php");
			}elseif($evaluation_mod=="student"){
				include("view/mod/admin/code/student/student_js.php");
			}elseif($evaluation_mod=="data_intention_quota"){
				include("view/mod/admin/code/data_intention_quota/data_intention_quota_js.php");
			}elseif($evaluation_mod=="talent_category" or $evaluation_mod=="talent_nostalgiasee"){
				include("view/mod/admin/code/talent_category/talent_category_js.php");
			}elseif($evaluation_mod=="load_stu_new"){
				include("view/mod/admin/code/load_stu_new/load_stu_new_js.php");
			}elseif($evaluation_mod=="copy_stu_class"){
				include("view/mod/admin/code/copy_stu_class/copy_stu_class_js.php");
			}elseif($evaluation_mod=="copy_class_year"){
				include("view/mod/admin/code/copy_class_year/copy_class_year_js.php");
			}elseif($evaluation_mod=="summer_count"){
				include("view/mod/admin/code/summer_count/summer_count_js.php");
			}elseif($evaluation_mod=="summer_stu"){
				include("view/mod/admin/code/summer_stu/summer_stu_js.php");
			}elseif($evaluation_mod=="summer_pay" or $evaluation_mod=="summer_pay_up"){
				include("view/mod/admin/code/summer_pay/summer_pay_js.php");
			}elseif($evaluation_mod=="summer_count_all" or $evaluation_mod=="summer_count_all_excel"){
				include("view/mod/admin/code/summer_count_all/summer_count_all_js.php");
			}elseif($evaluation_mod=="summer_system"){
				include("view/mod/admin/code/summer_system/summer_system_js.php");
			}elseif($evaluation_mod=="ad_summer" or $evaluation_mod=="ad_summer_code"){
				include("view/mod/admin/code/ad_summer/ad_summer_js.php");	
			}elseif($evaluation_mod=="rcbooks_up_price"){
				include("view/mod/admin/code/rcbooks_up_price/rcbooks_up_price_js.php");
			}elseif($evaluation_mod=="rcbooks_receipt_all"){
				include("view/mod/admin/code/rcbooks_receipt_all/rcbooks_receipt_all_js.php");
			}elseif($evaluation_mod=="summer_expense_report"){
				include("view/mod/admin/code/summer_expense_report/summer_expense_report_js.php");
			}elseif($evaluation_mod=="class_swisplus"){
				include("view/mod/admin/code/class_swisplus/class_swisplus_js.php");
			}elseif($evaluation_mod=="summer_score_set_up"){
				include("view/mod/admin/code/summer_score_set_up/summer_score_set_up_js.php");
			}elseif($evaluation_mod=="summer_score_upload"){
				include("view/mod/admin/code/summer_score_upload/summer_score_upload_js.php");
			}elseif($evaluation_mod=="summer_score_print"){
				include("view/mod/admin/code/summer_score_print/summer_score_print_js.php");
			}elseif($evaluation_mod=="register_activity"){
				include("view/mod/admin/code/register_activity/register_activity_js.php");
			}elseif($evaluation_mod=="activity_admin" or $evaluation_mod=="activity_rc_admin" or $evaluation_mod=="activity_show_admin"){
				include("view/mod/admin/code/activity_admin/activity_admin_js.php");
			}elseif($evaluation_mod=="activity_report"){
				include("view/mod/admin/code/activity_report/activity_report_js.php");
			}elseif($evaluation_mod=="supplementary_report"){
				include("view/mod/admin/code/supplementary_report/supplementary_report_js.php");
			}elseif($evaluation_mod=="weekend_statistics"){
				include("view/mod/admin/code/weekend_statistics/weekend_statistics_js.php");
			}elseif($evaluation_mod=="weekend_set"){
				include("view/mod/admin/code/weekend_set/weekend_set_js.php");
			}elseif($evaluation_mod=="information_quota"){
				include("view/mod/admin/code/information_quota/information_quota_js.php");	
			}elseif($evaluation_mod=="quota_mana"){
				include("view/mod/admin/code/quota_mana/quota_mana_js.php");
			}elseif($evaluation_mod=="weekend_use"){
				include("view/mod/admin/code/weekend_use/weekend_use_js.php");
			}elseif($evaluation_mod=="weekend_student"){
				include("view/mod/admin/code/weekend_student/weekend_student_js.php");
			}elseif($evaluation_mod=="qsa_family_day"){
				include("view/mod/admin/code/qrcode_school_activities/qrcode_school_activities_js.php");
			}elseif(($evaluation_mod=="concert_pay" or $evaluation_mod=="concert_paying")){
				include("view/mod/admin/code/concert_pay/concert_pay_js.php");
			}elseif(($evaluation_mod=="concert_predicate")){
				include("view/mod/admin/code/concert_predicate/concert_predicate_js.php");
			}elseif(($evaluation_mod=="activity_copy_data_t")){
				include("view/mod/admin/code/activity_copy_data_t/activity_copy_data_t_js.php");
			}elseif(($evaluation_mod=="summer_set")){
				include("view/mod/admin/code/summer_set/summer_set_js.php");
			}elseif(($evaluation_mod=="summer_register")){
				include("view/mod/admin/code/summer_register/summer_register_js.php");
			}elseif(($evaluation_mod=="student_data")){
				include("view/mod/admin/code/student_data/student_data_js.php");
			}elseif(($evaluation_mod=="student_late_save")){
				include("view/mod/admin/code/student_late_save/student_late_save_js.php");
			}elseif(($evaluation_mod=="student_late_load")){
				include("view/mod/admin/code/student_late_load/student_late_load_js.php");
			}elseif(($evaluation_mod=="student_late_mail")){
				include("view/mod/admin/code/student_late_mail/student_late_mail_js.php");
			}else{ ?>
    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <!-- Theme JS files -->
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>


    <script src="<?php echo base_url();?>/Template/global_assets/js/demo_pages/general_widgets_stats.js"></script>


    <!-- /theme JS files -->

    <!-- Theme JS files -->
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/noty.min.js"></script>
    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/jgrowl.min.js"></script>

    <script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/ripple.min.js"></script>
    <!-- /theme JS files -->



    <script>
    function noty_info() {

        Noty.overrideDefaults({
            theme: 'limitless',
            layout: 'topRight',
            type: 'alert',
            timeout: 2500

        });

        new Noty({
            text: 'ยินดีต้อนรับ <?php echo $myname;?> เข้าสู่ระบบ',
            type: 'info'
        }).show();
    }
    </script>



    <script type="text/javascript">
    //disable back button
    history.pushState(null, null, '');
    window.addEventListener('popstate', function(event) {
        history.pushState(null, null, '');
    });
    </script>

    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

    <!-- Theme JS files -->
    <script src="<?php echo base_url();?>Template/global_assets/js/plugins/visualization/echarts/echarts.min.js">
    </script>

    <script src="<?php echo base_url();?>Template/global_assets/js/plugins/ui/ripple.min.js"></script>
    <!-- /theme JS files -->

    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <?php		} 	?>
    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <!-- Theme JS files components_modals-->
    <script src="<?php echo base_url();?>Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
    <script src="<?php echo base_url();?>Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script src="<?php echo base_url();?>Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#sweet_warning').on('click', function() {
            swal({
                title: "คุณแน่ใจใช้ไหม ?",
                text: "คุณต้องการออกจากระบบ...",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#FF7043",
                confirmButtonText: "ใช้,  ต้องการออกจากระบบ"
            }, function(gotologin) {
                if (gotologin) {
                    document.location = "<?php echo base_url();?>/rc/logout_admin"
                } else {
                    //--------------------------------------------------------------
                }
            })
        })
    })
    </script>
    <script src="<?php echo base_url();?>Template/global_assets/js/plugins/ui/ripple.min.js"></script>
    <!-- /theme JS files -->
    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <?php	break;
		
		default:
			//****************************************************
	}
?>

    <script src="<?php echo base_url();?>Template/layout_2/LTR/material/full/assets/js/app.js"></script>

    <?php //include("view/function/data_time_user/real_time.php"); ?>

</head>

<?php   if(($evaluation_mod=="home")){ ?>
<!----------------------------------------------------->
<?php
						if(($login==1)){ ?>

<body class="<?php echo $model2;?>" onload="noty_info()">
    <!----------------------------------------------------->
    <!----------------------------------------------------->
    <?php	}else{ ?>

    <body class="<?php echo $model2;?>">
        <!----------------------------------------------------->
        <!----------------------------------------------------->
        <?php	}      ?>
        <!----------------------------------------------------->
        <?php	}elseif(($evaluation_mod=="profile_modify")){ ?>

        <body class="<?php echo $model2;?>" onload="loadFMstatus()">
            <!----------------------------------------------------->
            <!----------------------------------------------------->
            <?php   }elseif(($evaluation_mod=="ad_summer")){ ?>

            <body class="<?php echo $model2;?>" onload="load_ad_summer()">
                <?php   }else{ ?>
                <!----------------------------------------------------->

                <body class="<?php echo $model2;?>">
                    <!----------------------------------------------------->
                    <!----------------------------------------------------->
                    <?php	}      ?>
                    <!--navbar navbar-inverse header-highlight-->

                    <!--navbar navbar-default header-highlight-->

                    <!--class="layout-boxed"-->
                    <!-- Main navbar -->
                    <?php include("view/controller/main_navbar.php"); ?>
                    <!-- /main navbar -->


                    <!-- Page container -->
                    <div class="page-container">

                        <!-- Page content -->
                        <div class="page-content">

                            <!-- Main sidebar -->
                            <div class="sidebar sidebar-main">
                                <div class="sidebar-content">


                                    <!-- User menu -->
                                    <?php include("view/controller/user_menu.php"); ?>
                                    <!-- /user menu -->


                                    <!-- Main navigation -->
                                    <?php include("view/controller/main_navigation.php"); ?>
                                    <!-- /main navigation -->

                                </div>
                            </div>
                            <!-- /main sidebar -->


                            <!-- Main content -->
                            <div class="content-wrapper">
                                <!-- Page header -->

                                <div class="content">

                                    <?php
//************************************************************
		if(file_exists($evaluation_load)){
			if($group=="S"){
				include $evaluation_load;
			}elseif($group=="C"){
				if($copy_evaluation_mod=="supplementary_count"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="supplementary"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="home"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="sturc_dataall"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="stu_room"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="stu_roomimg"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="account_settings"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="supplementary_data"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="supplementary_stu"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="supplementary_datastu"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="supplementary_datanotstu"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="quota_show"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="Internal_quota_testing_plan"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="quota_academic"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="quota_capital"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="edit_student"){
					include $evaluation_load;		
				}elseif($copy_evaluation_mod=="admin_quota"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="quota_dataall"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="activity_show"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="activity_stu"){
					include $evaluation_load;					
				}elseif($copy_evaluation_mod=="data_intention_quota"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="summer_count" or $copy_evaluation_mod=="summer_count_all" or $copy_evaluation_mod=="summer_stu" or $copy_evaluation_mod=="summer_pay" or $copy_evaluation_mod=="ad_summer" or $copy_evaluation_mod=="ad_summer_code"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="summer_score_set_up" or $copy_evaluation_mod=="summer_score_upload" or $copy_evaluation_mod=="summer_up_score" or $copy_evaluation_mod=="summer_score_print" or $copy_evaluation_mod=="summer_expense_report" or $copy_evaluation_mod=="summer_count_all" or $copy_evaluation_mod=="summer_register" or $copy_evaluation_mod=="summer_count_all_excel"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="weekend_statistics" or $copy_evaluation_mod=="weekend_set" or $copy_evaluation_mod=="weekend_use" or $copy_evaluation_mod=="weekend_student"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="information_quota" or $copy_evaluation_mod=="quota_mana"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="concert_pay" or $copy_evaluation_mod=="concert_paying" or $copy_evaluation_mod=="concert_predicate"){//****
					include $evaluation_load;
				}else{
					$evaluation_load="view/mod/admin/not_file404.php";
					include $evaluation_load;
				}
			}elseif($group=="D"){
				if($copy_evaluation_mod=="supplementary_count"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="supplementary"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="home"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="sturc_dataall"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="stu_room"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="stu_roomimg"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="account_settings"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="supplementary_data"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="supplementary_stu"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="supplementary_datastu"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="supplementary_datanotstu"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="quota_show"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="Internal_quota_testing_plan"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="quota_academic"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="quota_capital"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="edit_student"){
					include $evaluation_load;		
				}elseif($copy_evaluation_mod=="admin_quota"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="quota_dataall"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="activity_show"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="activity_stu"){
					include $evaluation_load;					
				}elseif($copy_evaluation_mod=="data_intention_quota"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="summer_count" or $copy_evaluation_mod=="summer_count_all" or $copy_evaluation_mod=="summer_stu" or $copy_evaluation_mod=="summer_pay" or $copy_evaluation_mod=="ad_summer" or $copy_evaluation_mod=="ad_summer_code"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="summer_score_set_up" or $copy_evaluation_mod=="summer_score_upload" or $copy_evaluation_mod=="summer_up_score" or $copy_evaluation_mod=="summer_score_print" or $copy_evaluation_mod=="summer_expense_report" or $copy_evaluation_mod=="summer_count_all"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="weekend_statistics" or $copy_evaluation_mod=="weekend_set" or $copy_evaluation_mod=="weekend_use" or $copy_evaluation_mod=="weekend_student"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="information_quota" or $copy_evaluation_mod=="quota_mana"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="concert_pay" or $copy_evaluation_mod=="concert_paying" or $copy_evaluation_mod=="concert_predicate"){//****
					include $evaluation_load;
				}else{
					$evaluation_load="view/mod/admin/not_file404.php";
					include $evaluation_load;
				}
			}elseif($group=="F"){
				if($copy_evaluation_mod=="home"){
					include $evaluation_load;	
				}elseif($copy_evaluation_mod=="qsa_family_day"){
					include $evaluation_load;
				}elseif($copy_evaluation_mod=="concert_pay" or $copy_evaluation_mod=="concert_paying" or $copy_evaluation_mod=="concert_predicate"){
					include $evaluation_load;
				}else{
					$evaluation_load="view/mod/admin/not_file404.php";
					include $evaluation_load;
				}				
			}else{
				include $evaluation_load;
			}
		}else{
			
			if($group=="S"){
				$evaluation_load="view/mod/student/not_file404.php";
				include $evaluation_load;
			}else{
				$evaluation_load="view/mod/admin/not_file404.php";
				include $evaluation_load;
			}
			
		}
//************************************************************
	?>
                                </div>

                                <!-- /page header -->

                                <!-- Content area -->
                                <div class="content">
                                    <!-- Footer -->
                                    <div class="footer text-muted">
                                        <div><span class="help-block text-center no-margin">Copyright © 2023 Regina
                                                Coeli Collage. All Rights Reserved.</span></div>
                                        <div><span class="help-block text-center no-margin">พัฒนาระบบโดย กลุ่มงาน ICT
                                                โรงเรียนเรยีนาเชลีวิทยาลัย </span></div>
                                        <div><span class="help-block text-center no-margin">http://www.regina.ac.th
                                                ติดต่อ 053-282-395 ต่อ 123</span></div>
                                    </div>
                                    <!-- /footer -->
                                </div>
                                <!-- /content area -->
                            </div>
                            <!-- /main content -->

                        </div>
                        <!-- /page content -->

                    </div>
                    <!-- /page container -->

                </body>

                <?php
		if($evaluation_mod=="favorite_score_info"){
			include("view/mod/admin/code/favorite_score/datatable_js.php");
		}elseif($evaluation_mod=="favorite_score_data1"){
			include("view/mod/admin/code/favorite_score/datatable_js.php");
		}elseif($evaluation_mod=="favorite_score_data2"){
			include("view/mod/admin/code/favorite_score/datatable_js.php");
		}elseif($evaluation_mod=="favorite_score_data3"){
			include("view/mod/admin/code/favorite_score/datatable_js.php");
		}else{
			
		}
?>
                <?php
				if($_SERVER['REMOTE_ADDR']=="127.0.0.1" or $_SERVER['REMOTE_ADDR']=="::1"){ ?>
                <!--Start of Tawk.to Script-->
                <!--End Start of Tawk.to Script-->
                <?php	}else{ ?>
                <!--Start of Tawk.to Script-->
                <script type="text/javascript">
                var group = "<?php echo $group;?>";
                if (group != "A") {
                    var Tawk_API = Tawk_API || {},
                        Tawk_LoadStart = new Date();
                    (function() {
                        var s1 = document.createElement("script"),
                            s0 = document.getElementsByTagName("script")[0];
                        s1.async = true;
                        s1.src = 'https://embed.tawk.to/62734275b0d10b6f3e70ad06/1g293n712';
                        s1.charset = 'UTF-8';
                        s1.setAttribute('crossorigin', '*');
                        s0.parentNode.insertBefore(s1, s0);
                    })();
                } else {
                    //--------------------------------------
                }
                </script>
                <!--End of Tawk.to Script-->
                <?php   } ?>

</html>