


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
						<h4> <span class="text-semibold">นักเรียนมาสาย </span>ประมวลผลข้อมูลนักเรียนมาสาย</h4>
					</ul>
					<ul class="breadcrumb-elements">
						<div class="heading-btn-group">
							<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
							<a class="btn btn-link  text-size-small"><span>/</span></a>
							<a class="btn btn-link  text-size-small"><span>ประมวลผลข้อมูลนักเรียนมาสาย</span></a>
						</div>
					</ul>
				</div>
			</div>
		</div>
	</fieldset>
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

        if((isset($_POST["manage"]))){
            $manage=filter_input(INPUT_POST,'manage');
        }else{
            if((isset($_GET["manage"]))){
                $manage=filter_input(INPUT_GET,'manage');
            }else{
                $manage="show";
            }
        }  

		$set_time_system=new RunDateTime("date_all",$ssy_date_start,$ssy_date_end);
?>

	<input type="hidden" name="manage" id="manage" value="<?php echo $manage;?>">
 	<input type="hidden" name="DateTime_Start" id="DateTime_Start" value="<?php echo $set_time_system->Call_DateTime_Start();?>">

	<script>
        var DateTime_Start=$("#DateTime_Start").val();
		var manage=$("#manage").val();
        var Type_Data="Loop_id";
        var Type_Count="TIME";
        var Type_If="where";
        var Status="B";
            if(DateTime_Start==="ON" && manage==="show"){
                $.post("<?php echo base_url();?>/student_late/load_late_mail/"+Type_Data+"/"+Type_Count+"/"+Type_If+"/"+Status,{
                    DateTime_Start:DateTime_Start
                },function(SetRunCountMail){
					var SetRunCountMail=SetRunCountMail.trim();
						if(SetRunCountMail==="RunCountMail"){
							$.post("<?php echo base_url();?>/student_late/late_load",{
								DateTime_Start:DateTime_Start
							},function(DateTime_Start_Run){
								if(DateTime_Start_Run!=""){
									$("#TimeStartRun").html(DateTime_Start_Run);
								}else{}
							})
						}else{}
                })
            }else{}
    </script>

	<?php
			if(($manage=="show")){ ?>

	<div id="TimeStartRun">
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div><i class="icon-spinner2 spinner"></i> <span>กำลังประมวลผลข้อมูลแจ้งเตือนการมาสาย</span></div>
			</div>
		</div>
	</div>

	<?php	}else{} ?>

	