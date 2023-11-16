<?php
	include("../../../../database/database_evaluation.php");
	$rcdata_connect=connect();
	$copy_class=post_data($_POST["copy_class"]);
	$copy_year=post_data($_POST["copy_year"]);
	$copy_datetime=date("Y-m-d H:i:s");
?>

<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="tabbable">
					<ul class="nav nav-tabs nav-tabs-top nav-justified">
						<li class="active"><a href="#top-justified-tab1" data-toggle="tab">สรุปภาพรวมทั้งโรงเรียน</a></li>
						<li><a href="#top-justified-tab2" data-toggle="tab">สรุปภาพรวมกลุ่มสาระ</a></li>
						<li><a href="#top-justified-tab2" data-toggle="tab">สรุปภาพรวมทีมชั้น</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="top-justified-tab1">

						<?php
							//delect******evaluation_dele
							$evaluation_deleTA="DELETE FROM `evaluation_ans` WHERE `ea_term`='{$copy_class}' and `ea_year`='{$copy_year}' and `ea_type`='A'";
							$evaluation_deleTArs=add_rc($evaluation_deleTA);						
							//delect******evaluation_dele end
						
							$sum_score="select count(`es_student`) as `count_score_a`,`es_score`
										from `evaluation_score` 
										where `es_term`='{$copy_class}' 
										and `es_year`='{$copy_year}' 
										and `es_status`='1' 
										group by `es_score` 
										ORDER BY `es_score` ASC;";
							$sum_scoreRs=$rcdata_connect->query($sum_score)or die ($rcdata_connect->error);
								if($sum_scoreRs->num_rows > 0){
									$count_a=0;
										while($sum_scoreRow=$sum_scoreRs->fetch_assoc()){
											$count_score_a=$sum_scoreRow["count_score_a"];
											if($count_score_a==""){
												$keep_countsc[$count_a]=0;
											}else{
												$keep_countsc[$count_a]=$sum_scoreRow["count_score_a"];
											}
											
											$count_a=$count_a+1;	
										}	
							//ans score.....
							//number_students
									$number_stuA="SELECT count(`evaluation_id`) as `num_stu` 
												  FROM `evaluation` 
												  WHERE `evaluation_year`='{$copy_year}' 
												  and `evaluation_term`='{$copy_class}' 
												  and `evaluation_s`='1' 
												  and `evaluation_st`='1';";
												$number_stuARs=rc_data($number_stuA);
						
												foreach($number_stuARs as $rc_key=>$number_stuARow){
													$num_stuA=$number_stuARow["num_stu"];
												}		
											//score_all	
												$evaluation_scoreA="select sum(`es_score`) as `scoreall` 
																	from `evaluation_score` 
																	where `es_term`='{$copy_class}' 
																	and `es_year`='{$copy_year}';";
												$evaluation_scoreARs=rc_data($evaluation_scoreA);
												foreach($evaluation_scoreARs as $rc_key=>$evaluation_scoreARow){
													$scoreall=$evaluation_scoreARow["scoreall"];
												}
											//es_all
												$es_allA="select count(distinct `evaluation_subject`.`es_id`) as countes 
														  from `evaluation_score` 
														  join `evaluation_subject` on  (`evaluation_score`.`es_es`=`evaluation_subject`.`es_id`) 
														  where `evaluation_score`.`es_term`='{$copy_class}' 
														  and `evaluation_score`.`es_year`='{$copy_year}' 
														  and `evaluation_score`.`es_status`='1'";
												$es_allARs=rc_data($es_allA);
												foreach($es_allARs as $rc_key=>$es_allARow){
													$countes=$es_allARow["countes"];
												}
												$ans_scoreall=number_format($scoreall/($num_stuA*$countes),2);  ?>
<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
							<div class="row">
								<div class="col-sm-6 col-md-6 col-lg-6">
									<div class="panel panel-default">
										<div class="panel-body">
										
										
										
	<script>
	$(document).ready(function (){

    // Donut chart
    // ------------------------------

    // Generate chart
    var donut_chart = c3.generate({
        bindto: '#c3-donut-chart-aftschool',
        size: { width: 300 },
        color: {
            pattern: ['#3F51B5', '#FF9800', '#4CAF50', '#00BCD4', '#F44336']
        },
        data: {
            columns: [
			
			<?php
					$print_keepscoreA=0;
					while($print_keepscoreA<5){
					error_reporting(error_reporting() & ~E_NOTICE);
						?>
					
					['ระดับ <?php echo $print_keepscoreA+1; ?>', <?php echo $keep_countsc[$print_keepscoreA];?>],	
					
			<?php	$print_keepscoreA=$print_keepscoreA+1; }	?>
			
				
            ],
            type : 'donut'
        },
        donut: {
            title: "เฉลี่ยรวม <?php echo $ans_scoreall;?>"
        }
    });
			
	})
	</script>						

	<script>									
		$(document).ready(function(){
			var txt_ans=<?php echo $ans_scoreall;?>;
			if(txt_ans >=1.00 && txt_ans <=1.50){
				var show_txtans="พึงพอใจน้อยที่สุด";
			}else if(txt_ans >=1.60 && txt_ans <=2.00){
				var show_txtans="พึงพอใจน้อย";
			}else if(txt_ans >=2.60 && txt_ans <=3.00){
				var show_txtans="พึงพอใจ";
			}else if(txt_ans >=3.60 && txt_ans <=4.00){
				var show_txtans="พึงพอใจมาก";
			}else if(txt_ans >=4.60 && txt_ans <=5.00){
				var show_txtans="พึงพอใจมากที่สุด";
			}else{
				var show_txtans="ไม่ประมวลค่าพึงพอใจ";
			}
			document.getElementById("txtans").innerHTML = show_txtans ;
		})															
	</script>	
	
											<div class="chart-container text-center">
												<div class="display-inline-block" id="c3-donut-chart-aftschool"></div>
											</div>
											<div class="chart-container text-center">
												<div id="txtans"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
				<?php
					$evaluation_content="select DISTINCT `evaluation_content`.`ec_id`,`evaluation_content`.`ec_txt` 
								         from `evaluation_score` 
										 join `evaluation_content` 
										 on(`evaluation_score`.`es_ec`=`evaluation_content`.`ec_id`) 
										 where `evaluation_score`.`es_term`='{$copy_class}' 
										 and `evaluation_score`.`es_year`='{$copy_year}' 
										 ORDER BY `evaluation_content`.`ec_id` ASC";
					$evaluation_coutentRs=$rcdata_connect->query($evaluation_content) or die ($rcdata_connect->error);
					
					if($evaluation_coutentRs->num_rows>0){
						$count_a=1;
						while($evaluation_coutentRow=$evaluation_coutentRs->fetch_assoc()){
						$ec_id=$evaluation_coutentRow["ec_id"];
						$ec_txt=$evaluation_coutentRow["ec_txt"]; ?>
<!--*********************************************************************************************************-->	
								<div class="col-sm-6 col-md-6 col-lg-6">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h6 class="panel-title text-semibold"><?php echo $ec_txt;?></h6>
										</div>
										<div class="panel-body">
										
											<?php
												$keep_score_keyA01="select count(`es_student`) as `keep_scorekeyA`,`es_score`
																    from `evaluation_score` 
															        where `es_term`='{$copy_class}' 
																	and `es_year`='{$copy_year}' 
																	and `es_status`='1' 
																	and `evaluation_score`.`es_ec`='{$ec_id}'
																	group by `es_score` 
																	ORDER BY `es_score` ASC;";
												$keep_score_keyA01Rs=rc_array($keep_score_keyA01);
												$array_keepA01=0;
												foreach($keep_score_keyA01Rs as $rc_key=>$keep_score_keyA01Row){
													
													$keep_scorekeyA=$keep_score_keyA01Row["keep_scorekeyA"];
													$es_score=$keep_score_keyA01Row["es_score"];
													
													$keep_scorekeyA[$array_keepA01]=$keep_score_keyA01Row["keep_scorekeyA"];
													
													if($keep_scorekeyA[$array_keepA01]==""){
														$keep_scorekeyA[$array_keepA01]=0;
													}else{
														$keep_scorekeyA[$array_keepA01]=$keep_score_keyA01Row["keep_scorekeyA"];
													}
													
													$array_keepA01=$array_keepA01+1;
												}
											
						//number_students
						$number_stuA="SELECT count(`evaluation_id`) as num_stuA 
									 FROM  `evaluation` 
									 WHERE `evaluation_year`='{$copy_year}' 
									 and `evaluation_term`='{$copy_class}' 
									 and `evaluation_s`='1' 
									 and `evaluation_st`='1'";
						$number_stuRsA=rc_data($number_stuA);
						
						foreach($number_stuRsA as $rc_key=>$number_stuRowA){
							$num_stuA=$number_stuRowA["num_stuA"];
						}										
						//number_students***End

						$number_ecA="SELECT count(`es_id`) as num_esA 
						             FROM `evaluation_subject` WHERE `ec_id`='{$ec_id}'";
						$number_ecRsA=rc_data($number_ecA);
						
						foreach($number_ecRsA as $rc_key=>$number_ecRowA){
							$num_esA=$number_ecRowA["num_esA"];//จำนวนข้อ...
						}
					//number_ec**********End											
					//sum_score คะแนน รวม 5 4 3 2 1
						$sum_scoreA="select sum(`es_score`) as sum_scoreallA 
						             from `evaluation_score` 
									 where `es_term`='{$copy_class}' 
									 and `es_year`='{$copy_year}' 
									 and `es_ec`='{$ec_id}' 
									 and `es_status`='1'";
						$sum_scoreRsA=rc_data($sum_scoreA);
						
						foreach($sum_scoreRsA as $rc_key=>$sum_scoreRowA){
							$sum_scoreallA=$sum_scoreRowA["sum_scoreallA"];
							if($sum_scoreallA==""){
								$sum_scoreallA=0;
							}else{
								$sum_scoreallA; //คะแนนรวม 5 4 3 2 1
							}
						}
					//sum_score**********End  
						$ans_ecA=number_format($sum_scoreallA/($num_stuA*$num_esA),2);											
							
						
											?>
										
	<script>
	$(document).ready(function (){

    // Donut chart
    // ------------------------------

    // Generate chart
    var donut_chart = c3.generate({
        bindto: '#aftschoolA-<?php echo $count_a;?>',
        size: { width: 300 },
        color: {
            pattern: ['#3F51B5', '#FF9800', '#4CAF50', '#00BCD4', '#F44336']
        },
        data: {
            columns: [
			
			<?php
				$print_keepscoreA=0;
				while($print_keepscoreA<5){ ?>
					
				['ระดับ <?php echo $print_keepscoreA+1; ?>', <?php echo $keep_scorekeyA[$print_keepscoreA];?>],	
					
		<?php	$print_keepscoreA=$print_keepscoreA+1; }	?>
			
			
                

				
            ],
            type : 'donut'
        },
        donut: {
            title: "เฉลี่ยรวม <?php echo $ans_ecA;?>"
        }
    });
			
	})
	</script>										
										
										
											<div class="chart-container text-center">
												<div class="display-inline-block" id="aftschoolA-<?php echo $count_a;?>"></div>
											</div>										
										
										
<!-- add/ans -->
<!-- -->
		<?php
		
			$data_TA="select DISTINCT `course_teacher`.`ct_coursekey` from `course_teacher` 
			join `rc_person` on(`course_teacher`.`ct_coursekey`=`rc_person`.`IDTeacher`)
			WHERE `course_teacher`.`ct_courseterm`='{$copy_class}' 
			and `course_teacher`.`ct_courseyear`='{$copy_year}'";
			$data_TARs=$rcdata_connect->query($data_TA);
			
			if($data_TARs->num_rows>0){
				$count_ansTa=0;
				while($data_TARow=$data_TARs->fetch_assoc()){
					$ct_coursekeyTA=$data_TARow["ct_coursekey"];
					//number_students
						$number_stuTA="SELECT count(`evaluation_id`) as num_stuTA 
									 FROM `evaluation` 
									 WHERE `evaluation_teacher`='{$ct_coursekeyTA}' 
									 and `evaluation_year`='{$copy_year}' 
									 and `evaluation_term`='{$copy_class}' 
									 and `evaluation_s`='1' 
									 and `evaluation_st`='1'";
						$number_stuRsTA=rc_data($number_stuTA);
						
						foreach($number_stuRsTA as $rc_key=>$number_stuTARow){
							$num_stuTA=$number_stuTARow["num_stuTA"];
						}					
					//number_students End
					
					
					//number_ec**********
						$number_ecTA="SELECT count(`es_id`) as num_esTA 
						            FROM `evaluation_subject` WHERE `ec_id`='{$ec_id}'";
						$number_ecTARs=rc_data($number_ecTA);
						
						foreach($number_ecTARs as $rc_key=>$number_ecTARow){
							$num_esTA=$number_ecTARow["num_esTA"];//จำนวนข้อ...
						}
					//number_ec**********End					
					//sum_score คะแนน รวม 5 4 3 2 1
						$sum_scoreTA="select sum(`es_score`) as sum_scoreallTA 
						            from `evaluation_score` 
									where `es_term`='{$copy_class}' 
									and `es_year`='{$copy_year}' 
									and `es_ec`='{$ec_id}' 
									and `es_status`='1' 
									and `es_teacher`='{$ct_coursekeyTA}'";
						$sum_scoreTARs=rc_data($sum_scoreTA);
						
						foreach($sum_scoreTARs as $rc_key=>$sum_scoreTARow){
							$sum_scoreallTA=$sum_scoreTARow["sum_scoreallTA"];
							if($sum_scoreallTA==""){
								$sum_scoreallTA=0;
							}else{
								$sum_scoreallTA; //คะแนนรวม 5 4 3 2 1
							}
						
						}
					//sum_score**********End					
					
						$ans_ecTA=number_format($sum_scoreallTA/($num_stuTA*$num_esTA),2);	

						$copy_ansTa_te[$count_ansTa]=$ct_coursekeyTA;
						$copy_ansTa_ans[$count_ansTa]=$ans_ecTA;
						$copy_ansTa_stu[$count_ansTa]=$num_stuTA;
						
						
						$count_ansTa=$count_ansTa+1;
				}
			}else{
				
				
			}
		?>
<!-- -->
											<div class="chart-container">

		<?php
		
		$count_Ta=0;
		
		while($count_Ta<$count_ansTa){
			
			$into_ansTa="INSERT INTO `evaluation_ans` (`ea_teacher`, `ea_term`, `ea_year`, `ea_type`, `ea_ec`, `ea_ans`, `ea_datetime`, `ea_stu`) 
			             VALUES ('{$copy_ansTa_te[$count_Ta]}', '{$copy_class}', '{$copy_year}', 'A', '{$ec_id}', '{$copy_ansTa_ans[$count_Ta]}', '{$copy_datetime}', '{$copy_ansTa_stu[$count_Ta]}');";
			$into_ansTars=add_rc($into_ansTa);
			
			$count_Ta=$count_Ta+1;
		}
		
		?>
												<h6>ครูที่มีคะแนนสูงสุด 5 คนแรก</h6>											
		<?php
			$data_teacherTa="select `rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName`,`evaluation_ans`.`ea_ec`,`evaluation_ans`.`ea_ans`,`evaluation_ans`.`ea_stu` 
						     from `evaluation_ans` 
							 join `rc_person` on (`evaluation_ans`.`ea_teacher`=`rc_person`.`IDTeacher`) 
							 join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`) 
							 where `evaluation_ans`.`ea_term`='{$copy_class}' 
							 and `evaluation_ans`.`ea_year`='{$copy_year}' 
							 and `evaluation_ans`.`ea_type`='A' 
							 and `evaluation_ans`.`ea_ec`='{$ec_id}' 
							 ORDER BY `evaluation_ans`.`ea_ans` DESC , `evaluation_ans`.`ea_stu` DESC LIMIT 5";
			$data_teacherTaRs=rc_array($data_teacherTa);
				$ta_count=0;
			foreach($data_teacherTaRs as $rc_key=>$data_teacherTaRow){ 
				$ta_list[0]="";
				$ta_list[1]="";
				$ta_list[2]="";
				$ta_list[3]="";
				$ta_list[4]="";
				$ta_myname=$data_teacherTaRow["prefixname"]." ".$data_teacherTaRow["FName"]." ".$data_teacherTaRow["SName"];
				$ta_ans=$data_teacherTaRow["ea_ans"];
				$ta_stu=$data_teacherTaRow["ea_stu"];?>
				
				
				
		<?php	} ?>										
												
											</div>
<!-- add/ans End -->


										</div>
									</div>
								</div>
<!--*********************************************************************************************************-->							
				<?php	$count_a=$count_a+1;}
					}else{
						//echo"not data....";
					}
				?>					
										
										
						
							</div>	
<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////-->																		
									<?php		}else{
													
												}
									?>

							
							
						</div>
						<div class="tab-pane" id="top-justified-tab2">
							Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.1
						</div>
						<div class="tab-pane" id="top-justified-tab3">
							DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.2
						</div>
					</div>
				</div>					
			</div>
		</div>
	</div>
</div>