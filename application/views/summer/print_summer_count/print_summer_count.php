<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
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
<style>
.psrA{
	margin: auto;
	border: 3px solid #73AD21;
}
</style>

<?php	
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");//**
    include("view/database/class_plan.php");
	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");
	include("view/database/regina_student.php");//**




    $DataClass=new print_level($PSC_Class);
		
	/*$txt_year=post_data(filter_input(INPUT_POST,'txt_year'));
	$txt_class=post_data(filter_input(INPUT_POST,'txt_class'));
	$txt_room=post_data(filter_input(INPUT_POST,'txt_room'));*/
	
	/*$txt_year="1/2564";
	$txt_class="23";
	$txt_room="1";*/
	
?>


<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="stats-in-th" content="b062" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="shortcut icon" type="image/png">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="72x72">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="114x114">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="144x144">
		<title>พิมพ์&nbsp;ยอดจำนวนนักเรียนลงทะเบียน&nbsp;</title>
		<link rel="shortcut icon" href="<?php echo base_url();?>/Template/global_assets/images/logo_rc_wbe.ico"/>
<!-- Global stylesheets -->
		<link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->		
<!--Code Print css-->
		<link rel="stylesheet" href="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/css/normalize.css">
		<link rel="stylesheet" href="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/css/paper.css"> 	
<!--Code Print css End-->	

		<style>
			@font-face {
				font-family: 'THSarabunNew';
				src: url('<?php echo base_url();?>/view/font/thsarabunnew-webfont.eot');
				src: url('<?php echo base_url();?>/view/font/thsarabunnew-webfont.eot?#iefix') format('embedded-opentype'),
			url('<?php echo base_url();?>/view/font/thsarabunnew-webfont.woff') format('woff'),
			url('<?php echo base_url();?>/view/font/THSarabunNew.ttf') format('truetype');
			}
			body{
				font-family: "THSarabunNew";
				font-size: 20px;
				color: #032E3B;
			}
		</style>
	
		<style>
			@media print {
				
				@page{
					size: A4;
					margin: 1 cm;
				}
				
				button {
					display:none;
				}
				
				#p_echo{
					display:none;
				}
				
				body{
					font-family: "THSarabunNew";
					font-size: 16pt; 
							
				}
			}
			
			body{
				width: 210mm; height: 296mm;
			}
			.imgA{
				width: 210mm; height: 296mm;
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
<!--****************************************************************************-->
	
<!-- Core JS files -->
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/bootstrap.min.js"></script>
<!-- /core JS files -->	
<!--Code Print js-->
	<script src="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/js/html2canvas.js"></script>	
<!--Code Print js End-->	
	
	</head>
	<body>
    
	<div id="p_echo">
		<div class="container psrA">
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="table-responsive">
						<table class="table" align="center">
							<thead>
								<tr>
									<th style="width: 20%">
										<div><button type="button" style="font-size: 18px;" class="btn btn-default" onclick="window.print()"><b>พิมพ์ ยอดจำนวนนักเรียนลงทะเบียน</b></button></div>
									</th>
								</tr>
								<tr>
									<th style="width: 20%">
										<div style="font-size: 18px;"><font color="#F70105"><b>ระบบการพิมพ์  รองรับ เว็บเบราว์เซอร์  Google Chrome และ  Microsoft Edge เท่านั้น<b></font></div>
									</th>								
								</tr>
							</thead>						
						</table>
						<table class="table" align="center">
							<thead>
								<tr>
									<th style="width: 20%; font-size: 18px;"><div>ขนาดกระดาษ</div></th>
									<th style="width: 20%; font-size: 18px;"><div>แนวกระดาษ</div></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><div style="font-size: 18px;">A4&nbsp;:&nbsp;210mm&nbsp;X&nbsp;296mm</div></td>
									<td><div style="font-size: 18px;">แนวตั้ง</div></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>		
			</div>		
		</div>
	</div>


    <?php
            if(($PSC_Class>=41 and $PSC_Class<=43)){ ?>  

        <?php
            $ShowPalnClass=new PlanClass($PSC_Year,'1',$PSC_Class);
            $count4143=0;
                foreach($ShowPalnClass->RunPlanClass() as $rc=>$PrintPlanClass){
                    $count4143=$count4143+1;    
                    ?> 

    <section class="sheet padding-10mm imgA">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 10%;">
                        <div><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 75px; height: 73px;" alt=""/></div>
                    </td>
                    <td style="width: 90%;">
                        <div style="font-size: 22px; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;เชียงใหม่&nbsp;(Regina&nbsp;Coeli&nbsp;College)</div>
                        <div style="font-size: 22px; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;166&nbsp;ถ.เจริญประเทศ&nbsp;อ.เมือง&nbsp;จ.เชียงใหม่&nbsp;50100&nbsp;&#9742;&nbsp;Tel.&nbsp;0-5328-2395&nbsp;https://www.regina.ac.th</div>
                    </td>					
                </tr>
            </tbody>
        </table>    
           
        <table style="width: 100%; text-align: center;">
            <tbody>
                <tr>
                    <td>
                        <div style="font-size: 22px; font-weight: bold;">&nbsp;</div>
                        <div style="font-size: 22px; font-weight: bold;">&nbsp;ยอดจำนวนนักเรียนลงทะเบียนระดับชั้น&nbsp;<?php echo $DataClass->level_Lname;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $PSC_Year;?>&nbsp;(ข้อมูลจะแสดงตามแผนการเรียน)&nbsp;</div>
                        <div style="font-size: 22px; font-weight: bold;">&nbsp;แผนการเรียน&nbsp;<?php echo $PrintPlanClass["PlanName"];?>&nbsp;</div>
                    </td>					
                </tr>
            </tbody>
        </table>

        <table style="width: 100%;" cellspacing="0" cellpadding="0" border="1">
            <thead>
                <tr>
                    <th style="width: 10%"><div style="font-size: 20px; font-weight: bold; text-align: center;">ลำดับ</div></th>
                    <th style="width: 80%"><div style="font-size: 20px; font-weight: bold; text-align: center;">รายการกิจกรรมเสริมทักษะตามความถนัดและความสนใจ</div></th>
                    <th style="width: 10%"><div style="font-size: 20px; font-weight: bold; text-align: center;">จำนวนผู้ลงทะเบียน</div></th>
                </tr>
            <thead>

            <?php
					$ShowRsSubjectData=new ShowRsSubjectDataPlan($PSC_Year,$PSC_Class,$PrintPlanClass["IDPlan"]);
					$RSCount=1;
					foreach($ShowRsSubjectData->RunShowRsSubjectData() as $rc=>$ShowRsSubjectDataRow){
			//---------------------------------------------------------------------------------			
						$CountMoneyPaySummer=new CountMoneyPaySummer($ShowRsSubjectDataRow["RSD_no"],$PSC_Year);
			//---------------------------------------------------------------------------------			
						?>	
					

                <tr>
                    <td style="width: 1%"><div style="font-size: 20px; font-weight: lighter; text-align: center;"><?php echo $RSCount;?></div></td>                
                    <td style="width: 80%"><div style="font-size: 20px; font-weight: lighter;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?></div></td> 
                    <td style="width: 10%"><div style="font-size: 20px; font-weight: lighter; text-align: center;"><?php echo $CountMoneyPaySummer->RunCountSummer();?></div></td>                 
                </tr>                   
		
							
				<?php	$RSCount=$RSCount+1;} ?>

        </table>


        <table style="width: 100%; text-align: right;">
            <tbody>
                <tr>
                    <td>
                        <div style="font-size: 22px; font-weight: bold;">&nbsp;</div>
                        <div style="font-size: 22px; font-weight: bold;">ข้อมูล&nbsp;ณ&nbsp;วันที่&nbsp;:&nbsp;<?php echo date("d-m-Y H:i:s");?>&nbsp;</div>
                    </td>					
                </tr>
            </tbody>
        </table>                



    </section>                




        <?php   }  ?>

       
    <section class="sheet padding-10mm imgA";>
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 10%;">
                        <div><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 75px; height: 73px;" alt=""/></div>
                    </td>
                    <td style="width: 90%;">
                        <div style="font-size: 22px; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;เชียงใหม่&nbsp;(Regina&nbsp;Coeli&nbsp;College)</div>
                        <div style="font-size: 22px; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;166&nbsp;ถ.เจริญประเทศ&nbsp;อ.เมือง&nbsp;จ.เชียงใหม่&nbsp;50100&nbsp;&#9742;&nbsp;Tel.&nbsp;0-5328-2395&nbsp;https://www.regina.ac.th</div>
                    </td>					
                </tr>
            </tbody>
        </table>          

    </section>



    <?php   }else{ ?>
		
	<section class="sheet padding-10mm imgA">	 
		<table style="width: 100%;">
			<tbody>
				<tr>
					<td style="width: 10%;">
						<div><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 75px; height: 73px;" alt=""/></div>
					</td>
					<td style="width: 90%;">
						<div style="font-size: 22px; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;เชียงใหม่&nbsp;(Regina&nbsp;Coeli&nbsp;College)</div>
						<div style="font-size: 22px; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;166&nbsp;ถ.เจริญประเทศ&nbsp;อ.เมือง&nbsp;จ.เชียงใหม่&nbsp;50100&nbsp;&#9742;&nbsp;Tel.&nbsp;0-5328-2395&nbsp;https://www.regina.ac.th</div>
					</td>					
				</tr>
			</tbody>
		</table> 

        <table style="width: 100%; text-align: center;">
            <tbody>
                <tr>
                    <td>
                        <div style="font-size: 22px; font-weight: bold;">&nbsp;</div>
                        <div style="font-size: 22px; font-weight: bold;">&nbsp;ยอดจำนวนนักเรียนลงทะเบียนระดับชั้น&nbsp;<?php echo $DataClass->level_Lname;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $PSC_Year;?>&nbsp;(ข้อมูลจะแสดงตามระดับชั้นเรียน)&nbsp;</div>
                        <div style="font-size: 22px; font-weight: bold;">&nbsp;กิจกรรมเสริมทักษะตามความถนัดและความสนใจ&nbsp;</div>
                    </td>					
                </tr>
            </tbody>
        </table>

        <table style="width: 100%;" cellspacing="0" cellpadding="0" border="1">
            <thead>
                <tr>
                    <th style="width: 10%"><div style="font-size: 20px; font-weight: bold; text-align: center;">ลำดับ</div></th>
                    <th style="width: 80%"><div style="font-size: 20px; font-weight: bold; text-align: center;">รายการกิจกรรมเสริมทักษะตามความถนัดและความสนใจ</div></th>
                    <th style="width: 10%"><div style="font-size: 20px; font-weight: bold; text-align: center;">จำนวนผู้ลงทะเบียน</div></th>
                </tr>
            <thead>

			<?php
				$ShowRsSubjectData=new ShowRsSubjectData($PSC_Year,$PSC_Class);
				$RSCount=1;
				foreach($ShowRsSubjectData->RunShowRsSubjectData() as $rc=>$ShowRsSubjectDataRow){
//---------------------------------------------------------------------------------			
					$CountMoneyPaySummer=new CountMoneyPaySummer($ShowRsSubjectDataRow["RSD_no"],$PSC_Year);
//---------------------------------------------------------------------------------	?>	
				<?php
						if(($ShowRsSubjectDataRow["RST_on"]==1)){ ?>

                <tr>
                    <td style="width: 10%"><div style="font-size: 20px; font-weight: lighter; text-align: center;"><?php echo $RSCount;?></div></td>                
                    <td style="width: 80%"><div style="font-size: 20px; font-weight: lighter;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?></div></td> 
                    <td style="width: 10%"><div style="font-size: 20px; font-weight: lighter; text-align: center;"><?php echo $CountMoneyPaySummer->RunCountSummer();?></div></td>                 
                </tr> 

				<?php $RSCount=$RSCount+1; ?>

				<?php	}else{} ?>
	
				
		<?php	} ?>

        </table>

		<table style="width: 100%; text-align: center;">
            <tbody>
                <tr>
                    <td>
                        <div style="font-size: 22px; font-weight: bold;">&nbsp;</div>
                        <div style="font-size: 22px; font-weight: bold;">&nbsp;ยอดจำนวนนักเรียนลงทะเบียนระดับชั้น&nbsp;<?php echo $DataClass->level_Lname;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $PSC_Year;?>&nbsp;(ข้อมูลจะแสดงตามระดับชั้นเรียน)&nbsp;</div>
                        <div style="font-size: 22px; font-weight: bold;">&nbsp;วิชาการ&nbsp;/&nbsp;เรียนตามแผนการเรียน&nbsp;</div>
                    </td>					
                </tr>
            </tbody>
        </table>

        <table style="width: 100%;" cellspacing="0" cellpadding="0" border="1">
            <thead>
                <tr>
                    <th style="width: 10%"><div style="font-size: 20px; font-weight: bold; text-align: center;">ลำดับ</div></th>
                    <th style="width: 80%"><div style="font-size: 20px; font-weight: bold; text-align: center;">รายการวิชาการ&nbsp;/&nbsp;เรียนตามแผนการเรียน</div></th>
                    <th style="width: 10%"><div style="font-size: 20px; font-weight: bold; text-align: center;">จำนวนผู้ลงทะเบียน</div></th>
                </tr>
            <thead>

			<?php
				$ShowRsSubjectData=new ShowRsSubjectData($PSC_Year,$PSC_Class);
				$RSCount=1;
				foreach($ShowRsSubjectData->RunShowRsSubjectData() as $rc=>$ShowRsSubjectDataRow){
//---------------------------------------------------------------------------------			
					$CountMoneyPaySummer=new CountMoneyPaySummer($ShowRsSubjectDataRow["RSD_no"],$PSC_Year);
//---------------------------------------------------------------------------------	?>	
				<?php
						if(($ShowRsSubjectDataRow["RST_on"]>=2 and $ShowRsSubjectDataRow["RST_on"]<=3)){ ?>

                <tr>
                    <td style="width: 10%"><div style="font-size: 20px; font-weight: lighter; text-align: center;"><?php echo $RSCount;?></div></td>                
                    <td style="width: 80%"><div style="font-size: 20px; font-weight: lighter;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?></div></td> 
                    <td style="width: 10%"><div style="font-size: 20px; font-weight: lighter; text-align: center;"><?php echo $CountMoneyPaySummer->RunCountSummer();?></div></td>                 
                </tr> 

				<?php $RSCount=$RSCount+1;?>

				<?php	}else{} ?>
	
				
		<?php	} ?>

        </table>		

        <table style="width: 100%; text-align: right;">
            <tbody>
                <tr>
                    <td>
                        <div style="font-size: 22px; font-weight: bold;">&nbsp;</div>
                        <div style="font-size: 22px; font-weight: bold;">ข้อมูล&nbsp;ณ&nbsp;วันที่&nbsp;:&nbsp;<?php echo date("d-m-Y H:i:s");?>&nbsp;</div>
                    </td>					
                </tr>
            </tbody>
        </table> 

	</section>

    <?php   } ?>



    

 






				
	</body>
</html>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{
				$this->session->unset_userdata('rc_user');
				exit("<script>window.location='$golink/print_imgstu/error';</script>");		
			}
		}							 		
	}
?>