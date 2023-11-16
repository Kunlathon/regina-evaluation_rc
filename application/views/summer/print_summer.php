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
	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");
	
	include("view/database/pdo_conndatastu.php");
	
	include("view/database/regina_student.php");//**
		
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
		<title>พิมพ์&nbsp;รายงานข้อมูลคะแนน&nbsp;กิจกรรมสำหรับวัดและประเมินผล</title>
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
										<div><button type="button" style="font-size: 18px;" class="btn btn-default" onclick="window.print()"><b>พิมพ์ รายงานข้อมูลคะแนน กิจกรรมสำหรับวัดและประเมินผล</b></button></div>
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
			$PrintSudSummer=new SudSummer($data_class,$data_year);
				foreach($PrintSudSummer->RunSudSummer() as $rc=>$PrintSudSummerRow){
					$year_en=$data_year-543;
					$lavalTxt=new PrintLavaL($data_class);
					?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
			<?php
				$TestPrintScoreSud=new DataTestSaveScoreC($PrintSudSummerRow["rs_key"],$data_year);
					if(isset($TestPrintScoreSud->DTSS_KeyStu)){ ?>
				<?php
					$ReginaStuData=new regina_stu_data2($PrintSudSummerRow["rs_key"],$data_year,"1",$data_class);
						if(isset($ReginaStuData->rsd_studentid)){
							
							$PRSC=new PrintReginaStuDataClass($ReginaStuData->rsd_studentid);
							$myname=$PRSC->PRS_nameTH;
							
							/*if($ReginaStuData->sd_prefix=="2"){
								$myname="เด็กหญิง ".$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
							}elseif($ReginaStuData->sd_prefix=="4"){
								$myname="นางสาว ".$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
							}else{
								$myname=$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
							}*/	
							
						}else{
							
							$DataRsStudentData=new DataRsStudentDataA($PrintSudSummerRow["rs_key"],$data_year,$data_class);
							if(isset($DataRsStudentData->mynameTh)){
								$myname=$DataRsStudentData->mynameTh;
							}else{
								if(isset($myname)){
									$myname;
								}else{
									$myname="-";
									//$StudentEvaluation=new Prove_A_PersonRc($PrintSudSummerRow["rs_key"]);
						            //$myname=$StudentEvaluation->NameTh;
								}			
							}
						}
						
				?>
				

				
				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<section class="sheet padding-10mm imgA";>
		<table style="width: 100%;">
			<tbody>
				<tr>
					<td style="width: 10%;">
						<div><img src="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" style="width: 75px; height: 73px;" alt=""/></div>
					</td>
					<td style="width: 90%;">
						<div style="font-size: 22px; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;โรงเรียนเรยีนาเชลีวิทยาลัย&nbsp;เชียงใหม่&nbsp;(Regina&nbsp;Coeli&nbsp;College)</div>
						<div style="font-size: 22px; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;166&nbsp;ถ.เจริญประเทศ&nbsp;อ.เมือง&nbsp;จ.เชียงใหม่&nbsp;50100&nbsp;&#9742;&nbsp;Tel.&nbsp;0-5328-2395&nbsp;http://www.regina.ac.th</div>
					</td>					
				</tr>
			</tbody>
		</table>

		<table style="width: 100%;">
			<tbody>
				<tr>
					<td>
						<div>_______________________________________________________________________________________________________________________________</div>
					</td>					
				</tr>
			</tbody>
		</table>
		<br>
		<table style="width: 100%;" align="center">
			<tbody>
				<tr>
					<td style="width: 20%;">
						<div style="font-size: 25px; font-weight: bold; text-align: center;">รายงานผลการเรียนภาคฤดูร้อน&nbsp;ระดับชั้น&nbsp;<?php echo $lavalTxt->RunprintLavaTxtTh();?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_year;?></div>
						<div style="font-size: 25px; font-weight: bold; text-align: center;">Student&nbsp;Report&nbsp;for&nbsp;Summer&nbsp;Course&nbsp;<?php echo $year_en;?></div>
					</td>					
				</tr>
			</tbody>
		</table>
		<br>
		<table style="width: 100%;">
			<tbody>
				<tr>
					<td>                                                                                                                                                                                
						<div style="font-size: 20px; font-weight: bold;">ชื่อ-สกุล&nbsp;(Student’s&nbsp;Name)&nbsp;:&nbsp;&nbsp;<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" size="80" value="<?php echo $myname;?>"></div>
						<div style="font-size: 20px; font-weight: bold;">ชั้น&nbsp;(Class)&nbsp;:&nbsp;&nbsp;<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" size="20" value="<?php echo $lavalTxt->LavaTh;?>">เลขประจำตัว&nbsp;(Student&nbsp;Code)&nbsp;:&nbsp;&nbsp;<input type="text" readonly="readonly" required="required" style="font-family: THSarabunNew;font-size: 20px; border:0px; text-align: left; border:0px; border-bottom:#000 1px dotted; font-weight: lighter;" size="43" value="<?php echo $PrintSudSummerRow['rs_key'];?>"></div>
					</td>					
				</tr>
			</tbody>
		</table>
		<br>
		
		<table style="width: 100%;" border="1" cellspacing="0" cellpadding="0">
			<tbody>
				<tr>
					<td rowspan="2" style="width: 30%;">
						<div style="font-size: 16px; font-weight: bold; text-align: center;">ชื่อวิชา</div>
						<div style="font-size: 16px; font-weight: bold; text-align: center;">(Subject)</div>
					</td>
					<td rowspan="2" style="width: 10%;">
						<div style="font-size: 16px; font-weight: bold; text-align: center;">คะแนนเต็ม</div>
						<div style="font-size: 16px; font-weight: bold; text-align: center;">(Total&nbsp;Score)</div>
					</td>
					<td colspan="2">
						<div style="font-size: 16px; font-weight: bold; text-align: center;">คะแนนสอบ</div>
						<div style="font-size: 16px; font-weight: bold; text-align: center;">(Test&nbsp;Score)</div>
					</td>
					<td colspan="5">
						<div style="font-size: 16px; font-weight: bold; text-align: center;">ผลการประเมินการเรียนรู้  </div>
						<div style="font-size: 16px; font-weight: bold; text-align: center;">(Learning&nbsp;result)</div>
					</td>
				</tr>
				<tr>
					<td style="width: 6%;">
						<div style="font-size: 15px; font-weight: bold; text-align: center;">Pre&nbsp;Test</div>
					</td>
					<td style="width: 6%;">
						<div style="font-size: 15px; font-weight: bold; text-align: center;">Post&nbsp;Test</div>
					</td>
					<td style="width: 7%;">
						<div style="font-size: 15px; font-weight: bold; text-align: center;">ดีเยี่ยม</div>
						<div style="font-size: 15px; font-weight: bold; text-align: center;">(Excellent)</div>
					</td>
					<td style="width: 7%;">
						<div style="font-size: 15px; font-weight: bold; text-align: center;">ดี</div>
						<div style="font-size: 15px; font-weight: bold; text-align: center;">(Good)</div>
					</td>
					<td style="width: 7%;">
						<div style="font-size: 15px; font-weight: bold; text-align: center;">ค่อนข้างดี</div>
						<div style="font-size: 15px; font-weight: bold; text-align: center;">(Average)</div>
					</td>
					<td style="width: 7%;">
						<div style="font-size: 15px; font-weight: bold; text-align: center;">พอใช้</div>
						<div style="font-size: 15px; font-weight: bold; text-align: center;">(Fair)</div>
					</td>
					<td style="width: 7%;">
						<div style="font-size: 15px; font-weight: bold; text-align: center;">ควรเสริม</div>
						<div style="font-size: 15px; font-weight: bold; text-align: center;">(Try&nbsp;harder)</div>
					</td>
				</tr>		
			    <?php
					$SumSetUpScore=0;
					$SumScorePre=0;
					$SumScorePost=0;
					$PrintSummerSetUpScore=new PrintSummerSetUpScore($data_class,$data_year);
						foreach($PrintSummerSetUpScore->RunPrintSummerSetUpScore() as $rc=>$SummerSetUpScoreRow){
						$PrintScorePre=new DataTestSaveScoreB($PrintSudSummerRow["rs_key"],$data_year,"Pre",$SummerSetUpScoreRow["RSD_no"]);
						$PrintScorePost=new DataTestSaveScoreB($PrintSudSummerRow["rs_key"],$data_year,"Post",$SummerSetUpScoreRow["RSD_no"]);
							?>
					
				<tr>
					<td style="font-size: 18px; font-weight: bold; text-align: left;"><div>&nbsp;&nbsp;<?php echo $SummerSetUpScoreRow["RSD_txtTh"];?>&nbsp;(<?php echo ucwords($SummerSetUpScoreRow["RSD_txtEn"]);?>)</div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div><?php echo number_format($SummerSetUpScoreRow["SSUS_Score_full"],0,"","");?></div></td>
					
				
					
					<?php
							if(isset($PrintScorePre->DTSS_Score)){
								if(number_format($PrintScorePre->DTSS_Score,0,"","")==0){ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>-</div></td>					
								
					<?php		}else{ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div><?php echo number_format($PrintScorePre->DTSS_Score,0,"","") ;?></div></td>			
					<?php		}
							}else{ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>-</div></td>		
					<?php	} ?>
					
					
						<?php
								if(isset($PrintScorePost->DTSS_Score)){
									if(number_format($PrintScorePost->DTSS_Score,0,"","")==0){ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>-</div></td>									
						<?php		}else{ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div><?php echo number_format($PrintScorePost->DTSS_Score,0,"","") ;?></div></td>							
						<?php 	    }
								}else{ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>-</div></td>								
						<?php	}?>
					
					
						
					
				
				
							<?php
								$DataScore=new TestScore($PrintScorePost->DTSS_Score,"A",$SummerSetUpScoreRow["SSUS_Score_full"]);
									if($DataScore->KeyScore=="A"){ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>&#10004;</div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>										
							<?php	}elseif($DataScore->KeyScore=="B"){ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>&#10004;</div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>										
							<?php	}elseif($DataScore->KeyScore=="C"){ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>&#10004;</div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>										
							<?php	}elseif($DataScore->KeyScore=="D"){ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>&#10004;</div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>										
							<?php	}elseif($DataScore->KeyScore=="F"){ ?>
								<?php
										if($PrintScorePost->DTSS_Score==0 or $PrintScorePost->DTSS_Score=="0.00"){ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>										
								<?php	}else{ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>&#10004;</div></td>										
								<?php	} ?>
							<?php	}else{ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>										
							<?php	}?>

				</tr>					
					
				<?php	$SumSetUpScore=$SumSetUpScore+@$SummerSetUpScoreRow["SSUS_Score_full"];
						$SumScorePre=$SumScorePre+@$PrintScorePre->DTSS_Score;
						$SumScorePost=$SumScorePost+@$PrintScorePost->DTSS_Score;
				
						} ?>	
				
				<!--<tr>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>รวม</div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div><?php echo number_format($SumSetUpScore,0,"","");?></div></td>
									<?php
											if(number_format($SumScorePre,0,"","")==0){ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>-</div></td>											
									<?php	}else{ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div><?php echo number_format($SumScorePre,0,"","");?></div></td>											
									<?php 	} ?>

										<?php
												if(number_format($SumScorePost,0,"","")==0){ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>-</div></td>												
										<?php	}else{ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div><?php echo number_format($SumScorePost,0,"","");?></div></td>												
										<?php 	} ?>					
			
										<?php
											$DataScoreFull=new TestScore($SumScorePost,"B",$SummerSetUpScoreRow["SSUS_Score_full"]);
												if($DataScoreFull->KeyScore=="A"){ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>&#10004;</div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>													
										<?php	}elseif($DataScoreFull->KeyScore=="B"){ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>&#10004;</div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>													
										<?php	}elseif($DataScoreFull->KeyScore=="C"){ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>&#10004;</div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>													
										<?php	}elseif($DataScoreFull->KeyScore=="D"){ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>&#10004;</div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>													
										<?php	}elseif($DataScoreFull->KeyScore=="F"){ ?>
											<?php
													if(number_format($SumScorePost,0,"","")==0 or number_format($SumScorePost,0,"","")=="0.00"){ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>													
											<?php	}else{ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div>&#10004;</div></td>													
											<?php	}?>													
										<?php	}else{ ?>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>
					<td style="font-size: 18px; font-weight: bold; text-align: center;"><div></div></td>													
										<?php	}?>
				</tr>-->
			
				<!--<tr>
					<td colspan="9">
					<div style="font-size: 18px; font-weight: bold; text-align: center;">สรุปผลการประเมินภาคฤดูร้อน&nbsp;5&nbsp;รายวิชา&nbsp;ได้คะแนน&nbsp;ร้อยละ&nbsp;<?php echo number_format($SumScorePost,0,"","");?></div>
					</td>
				</tr>-->
			
			
			
			</tbody>
		</table>
		<br>
		<table style="width: 100%;" border="1" cellspacing="0" cellpadding="0">
			<tbody>
				<tr>
					<td>
						<table style="width: 100%;"  >
							<tbody>								
								<tr>
									<td style="width: 40%; font-size: 18px; font-weight: lighter; text-align: left;"><div>&nbsp;<b><u>การแปลผล&nbsp;(Meaning)</u></b></div></td>
									<td style="width: 20%; font-size: 18px; font-weight: lighter; text-align: left;"><div>&nbsp;</div></td>
									<td style="width: 40%; font-size: 18px; font-weight: lighter; text-align: left;"><div>&nbsp;</div></td>
								</tr>					
								<tr>
									<td style="width: 40%; font-size: 18px; font-weight: lighter; text-align: left;"><div>&nbsp;<b>ดีเยี่ยม</b>&nbsp;:&nbsp;นักเรียนมีระดับผลการเรียนอยู่ในร้อยละ80&nbsp;ขึ้นไป</div></td>
									<td style="width: 20%; font-size: 18px; font-weight: lighter; text-align: left;"><div>&nbsp;</div></td>
									<td style="width: 40%; font-size: 18px; font-weight: lighter; text-align: left;"><div>&nbsp;<b>ดี</b>&nbsp;:&nbsp;นักเรียนมีระดับผลการเรียนอยู่ในร้อยละ&nbsp;70-79</div></td>									

								</tr>		
								<tr>
									<td style="width: 40%; font-size: 18px; font-weight: lighter; text-align: left;"><div>&nbsp;<b>ค่อนข้างดี</b>&nbsp;:&nbsp;นักเรียนมีระดับผลการเรียนอยู่ในร้อยละ&nbsp;60-69</div></td>
									<td style="width: 20%; font-size: 18px; font-weight: lighter; text-align: left;"><div>&nbsp;</div></td>
									<td style="width: 40%; font-size: 18px; font-weight: lighter; text-align: left;"><div><b>พอใช้</b>&nbsp;:&nbsp;นักเรียนมีระดับผลการเรียนอยู่ในร้อยละ&nbsp;50-59</div></td>
								</tr>
								<tr>
									<td style="width: 40%; font-size: 18px; font-weight: lighter; text-align: left;"><div>&nbsp;<b>ควรเสริม</b>&nbsp;:&nbsp;นักเรียนมีระดับผลการเรียนต่ำกว่าร้อยละ&nbsp;50</div></td>
									<td style="width: 20%; font-size: 18px; font-weight: lighter; text-align: left;"><div>&nbsp;</div></td>
									<td style="width: 40%; font-size: 18px; font-weight: lighter; text-align: left;"><div>&nbsp;</div></td>
								</tr>	
								<tr>
									<td style="width: 40%; font-size: 18px; font-weight: lighter; text-align: left;"><div>&nbsp;<b><u>หมายเหตุ</u></b></div></td>
									<td style="width: 20%; font-size: 18px; font-weight: lighter; text-align: left;"><div>&nbsp;</div></td>
									<td style="width: 40%; font-size: 18px; font-weight: lighter; text-align: left;"><div>&nbsp;</div></td>
								</tr>		
								<tr>
									<td colspan="3" style="width: 40%; font-size: 18px; font-weight: lighter; text-align: left;">
										<div>&nbsp;&nbsp;-การวัดและประเมินผลภาคเรียนฤดูร้อน&nbsp;นักเรียนจะได้รับการทดสอบ&nbsp;ก่อนเรียน&nbsp;(Pre-test)&nbsp;หลังเรียน&nbsp;(Post-test)&nbsp;หากนักเรียนคนใด</div>
										<div>&nbsp;&nbsp;&nbsp;มีเครื่องหมาย&nbsp;“-”&nbsp;หมายถึงไม่ได้เข้าการทดสอบในครั้งนั้น</div>
										<div>&nbsp;&nbsp;-การประเมินผลการเรียนรู้ของนักเรียน&nbsp;(Learning&nbsp;Result)&nbsp;จะประเมินจากการทดสอบหลังเรียน&nbsp;(Post-test)</div>
									</td>
								</tr>								
							</tbody>
						</table>					
					</td>
				
				</tr>
			</tbody>
		</table>
		<br>
		<table style="width: 100%;">
			<tbody>
				<tr>
					<td style="width: 40%; font-size: 18px; font-weight: lighter; text-align: center;">
						<div>ลงชื่อ.................................................................................</div>
						<div>(.......................................................................................)</div>
						<div>ผู้ปกครอง</div>
					</td>					
					<td style="width: 20%;"></td>					
					<td style="width: 40%; font-size: 18px; font-weight: lighter; text-align: center;">
						<div>ลงชื่อ.................................................................................</div>
						<div>(.......................................................................................)</div>
						<div>ครูประจำชั้น</div>					
					</td>					
				</tr>
				<tr>
					<td style="width: 40%;">&nbsp;</td>					
					<td style="width: 20%;">&nbsp;</td>					
					<td style="width: 40%;">&nbsp;</td>					
				</tr>
				<tr>
					<td style="width: 40%;">&nbsp;</td>					
					<td style="width: 20%;">&nbsp;</td>					
					<td style="width: 40%;">&nbsp;</td>					
				</tr>					
										<?php
												if($data_class>=3 and $data_class<=23){	?>
				<tr>
					<td style="width: 40%; font-size: 18px; font-weight: lighter; text-align: center;">
						<div>ลงชื่อ.................................................................................</div>
						<div>(นางสาวพรสวรรค์&nbsp;&nbsp;ศรีวรกุล)</div>
						<div>รองผู้อำนวยการฝ่ายวิชาการระดับอนุบาลและระดับประถมศึกษา</div>
					</td>					
					<td style="width: 20%;"></td>					
					<td style="width: 40%; font-size: 18px; font-weight: lighter; text-align: center;">
						<div>ลงชื่อ.................................................................................</div>
						<div>(นางจันทร์จิรา&nbsp;&nbsp;ศิริพัฒน์)</div>
						<div>ผู้อำนวยการ</div>					
					</td>					
				</tr>												
										<?php	}elseif($data_class>=31 and $data_class<=43){ ?>
				<tr>
					<td style="width: 40%; font-size: 18px; font-weight: lighter; text-align: center;">
						<div>ลงชื่อ.................................................................................</div>
						<div>(นางสาวนิพาภรณ์&nbsp;&nbsp;ฟักทอง)</div>
						<div>รองผู้อำนวยการฝ่ายวิชาการระดับมัธยม</div>
					</td>					
					<td style="width: 20%;"></td>					
					<td style="width: 40%; font-size: 18px; font-weight: lighter; text-align: center;">
						<div>ลงชื่อ.................................................................................</div>
						<div>(นางจันทร์จิรา&nbsp;&nbsp;ศิริพัฒน์)</div>
						<div>ผู้อำนวยการ</div>					
					</td>					
				</tr>												
										<?php	}else{} ?>
				
			</tbody>
		</table>
		
	</section>						
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php   }else{} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
		<?php	} ?>








				
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