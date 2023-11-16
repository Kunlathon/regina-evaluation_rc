
<?php
	$data_yaer=2566;
	$data_term=1;

	$user_login;

    include("view/database/pdo_data.php");
    include("view/database/pdo_conndatastu.php");
    include("view/database/rgina_student.php");

?>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4><span class="text-semibold">ลงทะเบียนทุน ภาคเรียน <?php echo $data_term." / ".$data_yaer;?></span></h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=regina_bursary" class="btn btn-link  text-size-small"><span>ลงทะเบียนทุน ภาคเรียน <?php echo $data_term." / ".$data_yaer;?></span></a>
				</div> 
			</ul>
		</div>
	</div>
</div><br>


<?php
    $OFFON_System=array('OFF','ON');
        if(($OFFON_System[1]=="ON")){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

    <?php
        $Data_Student=new RcClassStudenYear('NokeyClassA',$user_login,$data_term,$data_yaer,"-");

        foreach($Data_Student->RunRcClassStudent() as $rc=>$Data_Student_Print){

            if((isset($Data_Student_Print["rsd_studentid"]))){
                $student_key=$Data_Student_Print["rsd_studentid"];
            }else{}

            if((isset($Data_Student_Print["rsc_class"]))){
                $class_key=$Data_Student_Print["rsc_class"];
            }else{}

            if((isset($Data_Student_Print["rsc_term"]))){
                $term_key=$Data_Student_Print["rsc_term"];
            }else{}

            if((isset($Data_Student_Print["rsc_plan"]))){
                $plan_key=$Data_Student_Print["rsc_plan"];
            }else{}
            
            if((isset($Data_Student_Print["rsc_room"]))){
                $room_no=$Data_Student_Print["rsc_room"];
            }else{}

            if((isset($Data_Student_Print["rsc_num"]))){
                $num_no=$Data_Student_Print["rsc_num"];
            }else{}
        }
    ?>


<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php   }else{ ?>

<?php   } ?>