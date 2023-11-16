<?php
	$txt_year=filter_input(INPUT_POST,'txt_year');
		if(isset($txt_year)){ ?>
	<?php
//database:	
		include("view/database/pdo_data.php");
		include("view/database/class_admin.php");
//	
		include("view/database/pdo_misrc.php");
		include("view/database/class_mis.php");
//	
		$LA_Pcount=0;
		$LA_Pclass=array('11','12','13','21','22','23');
		$LA_PclassTxt=array('ป.1','ป.2','ป.3','ป.4','ป.5','ป.6');
		$Pcl11=array('ญ11801','จ11801','ฝ11801');
		$Pcl12=array('ญ12801','จ12801','ฝ12801');
		$Pcl13=array('ญ13801','จ13801','ฝ13801');
		$Pcl21=array('ญ14801','จ14801','ฝ14801');
		$Pcl22=array('ญ15801','จ15801','ฝ15801');
		$Pcl23=array('ญ16801','จ16801','ฝ16801');
		$LA_Y=$txt_year;
		//$LA_Land=1;

		$angJT1=array();
		$angJT2=array();

		$angCT1=array();
		$angCT2=array();

		$angFT1=array();
		$angFT2=array();	
	?>		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">กิจกรรมภาษา </span>  ประเมินผลภาษาที่ 3 </h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>กิจกรรมภาษา ประเมินผลภาษาที่ 3</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=language_activities" class="btn btn-link  text-size-small"><span>รายงาน ประเมินผลกิจกรรมภาษาที่ 3</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><hr>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<h6 class="content-group-<?php echo $grid;?> text-semibold">
			กิจกรรมภาษา ภาคเรียนที่ 1 ปีการศึกษา <?php echo $LA_Y;?>
			<small class="display-block">กิจกรรมภาษา ประเมินผลภาษาที่ 3 ภาคเรียนที่ 1 ปีการศึกษา <?php echo $LA_Y;?></small>
		</h6>	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h6 class="panel-title">กิจกรรมภาษา : ภาษาญี่ปุ่น ระดับคุณภาพ</h6>
<?php
	$ract11=array(0,0,0,0,0,0,0,0);
	$ract12=array(0,0,0,0,0,0,0,0);
	$ract13=array(0,0,0,0,0,0,0,0);
	$ract21=array(0,0,0,0,0,0,0,0);
	$ract22=array(0,0,0,0,0,0,0,0);
	$ract23=array(0,0,0,0,0,0,0,0);
?>						
					</div>
					<div class="panel-body"> 
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th><div>ชั้น</div></th>
										<th><div>4</div></th>
										<th><div>3.5</div></th>
										<th><div>3</div></th>
										<th><div>2.5</div></th>
										<th><div>2</div></th>
										<th><div>1.5</div></th>
										<th><div>1</div></th>
										<th><div>0</div></th>
										<th><div>รวม</div></th>
										<th><div></div></th>
									</tr>
								</thead>
								<tbody>
							<?php
								$activities_count=0;
								while($activities_count<6){ 
															
									$sudRc=new stu_room($LA_Y,'1',$LA_Pclass[$activities_count]);
									foreach($sudRc->stu_array as $rc=>$sudRcRow){
										
										$IDLevel=$sudRcRow["IDLevel"];
											if($IDLevel==11){
												
												$run_activities=new RcSumLangActivities($Pcl11[0],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract11[0]=$ract11[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract11[1]=$ract11[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract11[2]=$ract11[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract11[3]=$ract11[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract11[4]=$ract11[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract11[5]=$ract11[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract11[6]=$ract11[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract11[7]=$ract11[7]+1;
												}else{
													//$ract11[8]=$ract11[8]+1;
												}
																						
												
											}elseif($IDLevel==12){
												
												$run_activities=new RcSumLangActivities($Pcl12[0],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract12[0]=$ract12[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract12[1]=$ract12[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract12[2]=$ract12[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract12[3]=$ract12[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract12[4]=$ract12[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract12[5]=$ract12[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract12[6]=$ract12[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract12[7]=$ract12[7]+1;
												}else{
													//$ract12[8]=$ract12[8]+1;
												}												
												
											}elseif($IDLevel==13){
												
												$run_activities=new RcSumLangActivities($Pcl13[0],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract13[0]=$ract13[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract13[1]=$ract13[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract13[2]=$ract13[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract13[3]=$ract13[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract13[4]=$ract13[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract13[5]=$ract13[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract13[6]=$ract13[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract13[7]=$ract13[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
												
											}elseif($IDLevel==21){
												$run_activities=new RcSumLangActivities($Pcl21[0],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract21[0]=$ract21[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract21[1]=$ract21[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract21[2]=$ract21[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract21[3]=$ract21[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract21[4]=$ract21[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract21[5]=$ract21[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract21[6]=$ract21[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract21[7]=$ract21[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}elseif($IDLevel==22){
												$run_activities=new RcSumLangActivities($Pcl22[0],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract22[0]=$ract22[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract22[1]=$ract22[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract22[2]=$ract22[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract22[3]=$ract22[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract22[4]=$ract22[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract22[5]=$ract22[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract22[6]=$ract22[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract22[7]=$ract22[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}elseif($IDLevel==23){
												$run_activities=new RcSumLangActivities($Pcl23[0],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract23[0]=$ract23[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract23[1]=$ract23[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract23[2]=$ract23[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract23[3]=$ract23[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract23[4]=$ract23[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract23[5]=$ract23[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract23[6]=$ract23[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract23[7]=$ract23[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}else{
												
											}
									}
									
								?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
							<?php
									if($LA_Pclass[$activities_count]==11){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
									<tr>
										<td><div><?php echo $LA_PclassTxt[0];?></div></td>
										<td><div><?php echo $ract11[0];?></div></td>
										<td><div><?php echo $ract11[1];?></div></td>
										<td><div><?php echo $ract11[2];?></div></td>
										<td><div><?php echo $ract11[3];?></div></td>
										<td><div><?php echo $ract11[4];?></div></td>
										<td><div><?php echo $ract11[5];?></div></td>
										<td><div><?php echo $ract11[6];?></div></td>
										<td><div><?php echo $ract11[7];?></div></td>
										<td><div><?php echo array_sum($ract11);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract11)==0){
									$angJT1[0]=0;
									?>
										<td><div></div></td>
						<?php	}else{ 
									$angJT1[0]=number_format((($ract11[0]+$ract11[1]+$ract11[2])*100)/array_sum($ract11), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract11[0]+$ract11[1]+$ract11[2])*100)/array_sum($ract11), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
									</tr>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
							<?php	}elseif($LA_Pclass[$activities_count]==12){?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[1];?></div></td>
										<td><div><?php echo $ract12[0];?></div></td>
										<td><div><?php echo $ract12[1];?></div></td>
										<td><div><?php echo $ract12[2];?></div></td>
										<td><div><?php echo $ract12[3];?></div></td>
										<td><div><?php echo $ract12[4];?></div></td>
										<td><div><?php echo $ract12[5];?></div></td>
										<td><div><?php echo $ract12[6];?></div></td>
										<td><div><?php echo $ract12[7];?></div></td>
										<td><div><?php echo array_sum($ract12);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract12)==0){ 
									$angJT1[1]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angJT1[1]=number_format((($ract12[0]+$ract12[1]+$ract12[2])*100)/array_sum($ract12), 2, '.', ' ');;
						?>
										<td><div><?php echo number_format((($ract12[0]+$ract12[1]+$ract12[2])*100)/array_sum($ract12), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php	}elseif($LA_Pclass[$activities_count]==13){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[2];?></div></td>
										<td><div><?php echo $ract13[0];?></div></td>
										<td><div><?php echo $ract13[1];?></div></td>
										<td><div><?php echo $ract13[2];?></div></td>
										<td><div><?php echo $ract13[3];?></div></td>
										<td><div><?php echo $ract13[4];?></div></td>
										<td><div><?php echo $ract13[5];?></div></td>
										<td><div><?php echo $ract13[6];?></div></td>
										<td><div><?php echo $ract13[7];?></div></td>
										<td><div><?php echo array_sum($ract13);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract13)==0){ 
									$angJT1[2]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angJT1[2]=number_format((($ract13[0]+$ract13[1]+$ract13[2])*100)/array_sum($ract13), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract13[0]+$ract13[1]+$ract13[2])*100)/array_sum($ract13), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
									</tr>								
							<?php	}elseif($LA_Pclass[$activities_count]==21){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[3];?></div></td>
										<td><div><?php echo $ract21[0];?></div></td>
										<td><div><?php echo $ract21[1];?></div></td>
										<td><div><?php echo $ract21[2];?></div></td>
										<td><div><?php echo $ract21[3];?></div></td>
										<td><div><?php echo $ract21[4];?></div></td>
										<td><div><?php echo $ract21[5];?></div></td>
										<td><div><?php echo $ract21[6];?></div></td>
										<td><div><?php echo $ract21[7];?></div></td>
										<td><div><?php echo array_sum($ract21);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract21)==0){ 
									$angJT1[3]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angJT1[3]=number_format((($ract21[0]+$ract21[1]+$ract21[2])*100)/array_sum($ract21), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract21[0]+$ract21[1]+$ract21[2])*100)/array_sum($ract21), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
									</tr>								
							<?php   }elseif($LA_Pclass[$activities_count]==22){ ?>
 									<tr>
										<td><div><?php echo $LA_PclassTxt[4];?></div></td>
										<td><div><?php echo $ract22[0];?></div></td>
										<td><div><?php echo $ract22[1];?></div></td>
										<td><div><?php echo $ract22[2];?></div></td>
										<td><div><?php echo $ract22[3];?></div></td>
										<td><div><?php echo $ract22[4];?></div></td>
										<td><div><?php echo $ract22[5];?></div></td>
										<td><div><?php echo $ract22[6];?></div></td>
										<td><div><?php echo $ract22[7];?></div></td>
										<td><div><?php echo array_sum($ract22);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract22)==0){ 
									$angJT1[4]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angJT1[4]=number_format((($ract22[0]+$ract22[1]+$ract22[2])*100)/array_sum($ract22), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract22[0]+$ract22[1]+$ract22[2])*100)/array_sum($ract22), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
									</tr>								
							<?php   }elseif($LA_Pclass[$activities_count]==23){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[5];?></div></td>
										<td><div><?php echo $ract23[0];?></div></td>
										<td><div><?php echo $ract23[1];?></div></td>
										<td><div><?php echo $ract23[2];?></div></td>
										<td><div><?php echo $ract23[3];?></div></td>
										<td><div><?php echo $ract23[4];?></div></td>
										<td><div><?php echo $ract23[5];?></div></td>
										<td><div><?php echo $ract23[6];?></div></td>
										<td><div><?php echo $ract23[7];?></div></td>
										<td><div><?php echo array_sum($ract23);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract23)==0){ 
									$angJT1[5]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angJT1[5]=number_format((($ract23[0]+$ract23[1]+$ract23[2])*100)/array_sum($ract23), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract23[0]+$ract23[1]+$ract23[2])*100)/array_sum($ract23), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
									</tr>								
							<?php  	}else{
										//---------------------------------------------------------
									}
							?>		

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	$activities_count=$activities_count+1;	} ?>

							</tbody>
							</table>
						</div>
					</div>
				</div>			
			</div>
			</div>
			
			<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h6 class="panel-title">กิจกรรมภาษา : ภาษาจีน ระดับคุณภาพ ระดับคุณภาพ</h6>
<?php
	$ract11=array(0,0,0,0,0,0,0,0);
	$ract12=array(0,0,0,0,0,0,0,0);
	$ract13=array(0,0,0,0,0,0,0,0);
	$ract21=array(0,0,0,0,0,0,0,0);
	$ract22=array(0,0,0,0,0,0,0,0);
	$ract23=array(0,0,0,0,0,0,0,0);
?>						
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th><div>ชั้น</div></th>
										<th><div>4</div></th>
										<th><div>3.5</div></th>
										<th><div>3</div></th>
										<th><div>2.5</div></th>
										<th><div>2</div></th>
										<th><div>1.5</div></th>
										<th><div>1</div></th>
										<th><div>0</div></th>
										<th><div>รวม</div></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
							<?php
								$activities_count=0;
								while($activities_count<6){ 
															
									$sudRc=new stu_room($LA_Y,'1',$LA_Pclass[$activities_count]);
									foreach($sudRc->stu_array as $rc=>$sudRcRow){
										
										$IDLevel=$sudRcRow["IDLevel"];
											if($IDLevel==11){
												
												$run_activities=new RcSumLangActivities($Pcl11[1],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract11[0]=$ract11[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract11[1]=$ract11[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract11[2]=$ract11[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract11[3]=$ract11[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract11[4]=$ract11[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract11[5]=$ract11[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract11[6]=$ract11[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract11[7]=$ract11[7]+1;
												}else{
													//$ract11[8]=$ract11[8]+1;
												}
																						
												
											}elseif($IDLevel==12){
												
												$run_activities=new RcSumLangActivities($Pcl12[1],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract12[0]=$ract12[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract12[1]=$ract12[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract12[2]=$ract12[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract12[3]=$ract12[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract12[4]=$ract12[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract12[5]=$ract12[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract12[6]=$ract12[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract12[7]=$ract12[7]+1;
												}else{
													//$ract12[8]=$ract12[8]+1;
												}												
												
											}elseif($IDLevel==13){
												
												$run_activities=new RcSumLangActivities($Pcl13[1],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract13[0]=$ract13[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract13[1]=$ract13[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract13[2]=$ract13[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract13[3]=$ract13[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract13[4]=$ract13[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract13[5]=$ract13[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract13[6]=$ract13[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract13[7]=$ract13[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
												
											}elseif($IDLevel==21){
												$run_activities=new RcSumLangActivities($Pcl21[1],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract21[0]=$ract21[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract21[1]=$ract21[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract21[2]=$ract21[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract21[3]=$ract21[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract21[4]=$ract21[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract21[5]=$ract21[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract21[6]=$ract21[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract21[7]=$ract21[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}elseif($IDLevel==22){
												$run_activities=new RcSumLangActivities($Pcl22[1],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract22[0]=$ract22[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract22[1]=$ract22[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract22[2]=$ract22[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract22[3]=$ract22[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract22[4]=$ract22[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract22[5]=$ract22[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract22[6]=$ract22[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract22[7]=$ract22[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}elseif($IDLevel==23){
												$run_activities=new RcSumLangActivities($Pcl23[1],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract23[0]=$ract23[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract23[1]=$ract23[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract23[2]=$ract23[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract23[3]=$ract23[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract23[4]=$ract23[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract23[5]=$ract23[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract23[6]=$ract23[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract23[7]=$ract23[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}else{
												
											}
									}
									
								?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
							<?php
									if($LA_Pclass[$activities_count]==11){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
									<tr>
										<td><div><?php echo $LA_PclassTxt[0];?></div></td>
										<td><div><?php echo $ract11[0];?></div></td>
										<td><div><?php echo $ract11[1];?></div></td>
										<td><div><?php echo $ract11[2];?></div></td>
										<td><div><?php echo $ract11[3];?></div></td>
										<td><div><?php echo $ract11[4];?></div></td>
										<td><div><?php echo $ract11[5];?></div></td>
										<td><div><?php echo $ract11[6];?></div></td>
										<td><div><?php echo $ract11[7];?></div></td>
										<td><div><?php echo array_sum($ract11);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract11)==0){ 
									$angCT1[0]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angCT1[0]=number_format((($ract11[0]+$ract11[1]+$ract11[2])*100)/array_sum($ract11), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract11[0]+$ract11[1]+$ract11[2])*100)/array_sum($ract11), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->												
									</tr>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
							<?php	}elseif($LA_Pclass[$activities_count]==12){?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[1];?></div></td>
										<td><div><?php echo $ract12[0];?></div></td>
										<td><div><?php echo $ract12[1];?></div></td>
										<td><div><?php echo $ract12[2];?></div></td>
										<td><div><?php echo $ract12[3];?></div></td>
										<td><div><?php echo $ract12[4];?></div></td>
										<td><div><?php echo $ract12[5];?></div></td>
										<td><div><?php echo $ract12[6];?></div></td>
										<td><div><?php echo $ract12[7];?></div></td>
										<td><div><?php echo array_sum($ract12);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract11)==0){ 
									$angCT1[1]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angCT1[1]=number_format((($ract11[0]+$ract11[1]+$ract11[2])*100)/array_sum($ract11), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract11[0]+$ract11[1]+$ract11[2])*100)/array_sum($ract11), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
									</tr>								
							<?php	}elseif($LA_Pclass[$activities_count]==13){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[2];?></div></td>
										<td><div><?php echo $ract13[0];?></div></td>
										<td><div><?php echo $ract13[1];?></div></td>
										<td><div><?php echo $ract13[2];?></div></td>
										<td><div><?php echo $ract13[3];?></div></td>
										<td><div><?php echo $ract13[4];?></div></td>
										<td><div><?php echo $ract13[5];?></div></td>
										<td><div><?php echo $ract13[6];?></div></td>
										<td><div><?php echo $ract13[7];?></div></td>
										<td><div><?php echo array_sum($ract13);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract13)==0){ 
									$angCT1[2]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angCT1[2]=number_format((($ract13[0]+$ract13[1]+$ract13[2])*100)/array_sum($ract13), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract13[0]+$ract13[1]+$ract13[2])*100)/array_sum($ract13), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php	}elseif($LA_Pclass[$activities_count]==21){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[3];?></div></td>
										<td><div><?php echo $ract21[0];?></div></td>
										<td><div><?php echo $ract21[1];?></div></td>
										<td><div><?php echo $ract21[2];?></div></td>
										<td><div><?php echo $ract21[3];?></div></td>
										<td><div><?php echo $ract21[4];?></div></td>
										<td><div><?php echo $ract21[5];?></div></td>
										<td><div><?php echo $ract21[6];?></div></td>
										<td><div><?php echo $ract21[7];?></div></td>
										<td><div><?php echo array_sum($ract21);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract21)==0){ 
									$angCT1[3]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angCT1[3]=number_format((($ract21[0]+$ract21[1]+$ract21[2])*100)/array_sum($ract21), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract21[0]+$ract21[1]+$ract21[2])*100)/array_sum($ract21), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
									</tr>								
							<?php   }elseif($LA_Pclass[$activities_count]==22){ ?>
 									<tr>
										<td><div><?php echo $LA_PclassTxt[4];?></div></td>
										<td><div><?php echo $ract22[0];?></div></td>
										<td><div><?php echo $ract22[1];?></div></td>
										<td><div><?php echo $ract22[2];?></div></td>
										<td><div><?php echo $ract22[3];?></div></td>
										<td><div><?php echo $ract22[4];?></div></td>
										<td><div><?php echo $ract22[5];?></div></td>
										<td><div><?php echo $ract22[6];?></div></td>
										<td><div><?php echo $ract22[7];?></div></td>
										<td><div><?php echo array_sum($ract22);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract22)==0){ 
									$angCT1[4]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angCT1[4]=number_format((($ract22[0]+$ract22[1]+$ract22[2])*100)/array_sum($ract22), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract22[0]+$ract22[1]+$ract22[2])*100)/array_sum($ract22), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php   }elseif($LA_Pclass[$activities_count]==23){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[5];?></div></td>
										<td><div><?php echo $ract23[0];?></div></td>
										<td><div><?php echo $ract23[1];?></div></td>
										<td><div><?php echo $ract23[2];?></div></td>
										<td><div><?php echo $ract23[3];?></div></td>
										<td><div><?php echo $ract23[4];?></div></td>
										<td><div><?php echo $ract23[5];?></div></td>
										<td><div><?php echo $ract23[6];?></div></td>
										<td><div><?php echo $ract23[7];?></div></td>
										<td><div><?php echo array_sum($ract23);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract23)==0){
									$angCT1[5]=0;
									?>
										<td><div></div></td>
						<?php	}else{ 
									$angCT1[5]=number_format((($ract23[0]+$ract23[1]+$ract23[2])*100)/array_sum($ract23), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract23[0]+$ract23[1]+$ract23[2])*100)/array_sum($ract23), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php  	}else{
									
									}
							?>		

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	$activities_count=$activities_count+1;	} ?>

							</tbody>
							</table>
						</div>
					</div>
				</div>			
			</div>
			</div>
			
			<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h6 class="panel-title">กิจกรรมภาษา : ภาษาฝรั่งเศส ระดับคุณภาพ</h6>
<?php
	$ract11=array(0,0,0,0,0,0,0,0);
	$ract12=array(0,0,0,0,0,0,0,0);
	$ract13=array(0,0,0,0,0,0,0,0);
	$ract21=array(0,0,0,0,0,0,0,0);
	$ract22=array(0,0,0,0,0,0,0,0);
	$ract23=array(0,0,0,0,0,0,0,0);
?>						
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th><div>ชั้น</div></th>
										<th><div>4</div></th>
										<th><div>3.5</div></th>
										<th><div>3</div></th>
										<th><div>2.5</div></th>
										<th><div>2</div></th>
										<th><div>1.5</div></th>
										<th><div>1</div></th>
										<th><div>0</div></th>
										<th><div>รวม</div></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
							<?php
								$activities_count=0;
								while($activities_count<6){ 
															
									$sudRc=new stu_room($LA_Y,'1',$LA_Pclass[$activities_count]);
									foreach($sudRc->stu_array as $rc=>$sudRcRow){
										
										$IDLevel=$sudRcRow["IDLevel"];
											if($IDLevel==11){
												
												$run_activities=new RcSumLangActivities($Pcl11[2],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract11[0]=$ract11[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract11[1]=$ract11[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract11[2]=$ract11[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract11[3]=$ract11[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract11[4]=$ract11[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract11[5]=$ract11[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract11[6]=$ract11[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract11[7]=$ract11[7]+1;
												}else{
													//$ract11[8]=$ract11[8]+1;
												}
																						
												
											}elseif($IDLevel==12){
												
												$run_activities=new RcSumLangActivities($Pcl12[2],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract12[0]=$ract12[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract12[1]=$ract12[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract12[2]=$ract12[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract12[3]=$ract12[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract12[4]=$ract12[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract12[5]=$ract12[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract12[6]=$ract12[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract12[7]=$ract12[7]+1;
												}else{
													//$ract12[8]=$ract12[8]+1;
												}												
												
											}elseif($IDLevel==13){
												
												$run_activities=new RcSumLangActivities($Pcl13[2],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract13[0]=$ract13[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract13[1]=$ract13[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract13[2]=$ract13[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract13[3]=$ract13[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract13[4]=$ract13[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract13[5]=$ract13[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract13[6]=$ract13[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract13[7]=$ract13[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
												
											}elseif($IDLevel==21){
												$run_activities=new RcSumLangActivities($Pcl21[2],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract21[0]=$ract21[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract21[1]=$ract21[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract21[2]=$ract21[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract21[3]=$ract21[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract21[4]=$ract21[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract21[5]=$ract21[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract21[6]=$ract21[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract21[7]=$ract21[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}elseif($IDLevel==22){
												$run_activities=new RcSumLangActivities($Pcl22[2],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract22[0]=$ract22[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract22[1]=$ract22[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract22[2]=$ract22[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract22[3]=$ract22[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract22[4]=$ract22[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract22[5]=$ract22[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract22[6]=$ract22[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract22[7]=$ract22[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}elseif($IDLevel==23){
												$run_activities=new RcSumLangActivities($Pcl23[2],$sudRcRow["rsd_studentid"],'1',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract23[0]=$ract23[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract23[1]=$ract23[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract23[2]=$ract23[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract23[3]=$ract23[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract23[4]=$ract23[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract23[5]=$ract23[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract23[6]=$ract23[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract23[7]=$ract23[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}else{
												
											}
									}
									
								?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
							<?php
									if($LA_Pclass[$activities_count]==11){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
									<tr>
										<td><div><?php echo $LA_PclassTxt[0];?></div></td>
										<td><div><?php echo $ract11[0];?></div></td>
										<td><div><?php echo $ract11[1];?></div></td>
										<td><div><?php echo $ract11[2];?></div></td>
										<td><div><?php echo $ract11[3];?></div></td>
										<td><div><?php echo $ract11[4];?></div></td>
										<td><div><?php echo $ract11[5];?></div></td>
										<td><div><?php echo $ract11[6];?></div></td>
										<td><div><?php echo $ract11[7];?></div></td>
										<td><div><?php echo array_sum($ract11);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract11)==0){ 
									$angFT1[0]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angFT1[0]=number_format((($ract11[0]+$ract11[1]+$ract11[2])*100)/array_sum($ract11), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract11[0]+$ract11[1]+$ract11[2])*100)/array_sum($ract11), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
										
									</tr>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
							<?php	}elseif($LA_Pclass[$activities_count]==12){?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[1];?></div></td>
										<td><div><?php echo $ract12[0];?></div></td>
										<td><div><?php echo $ract12[1];?></div></td>
										<td><div><?php echo $ract12[2];?></div></td>
										<td><div><?php echo $ract12[3];?></div></td>
										<td><div><?php echo $ract12[4];?></div></td>
										<td><div><?php echo $ract12[5];?></div></td>
										<td><div><?php echo $ract12[6];?></div></td>
										<td><div><?php echo $ract12[7];?></div></td>
										<td><div><?php echo array_sum($ract12);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract12)==0){ 
									$angFT1[1]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angFT1[1]=number_format((($ract12[0]+$ract12[1]+$ract12[2])*100)/array_sum($ract12), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract12[0]+$ract12[1]+$ract12[2])*100)/array_sum($ract12), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
									</tr>								
							<?php	}elseif($LA_Pclass[$activities_count]==13){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[2];?></div></td>
										<td><div><?php echo $ract13[0];?></div></td>
										<td><div><?php echo $ract13[1];?></div></td>
										<td><div><?php echo $ract13[2];?></div></td>
										<td><div><?php echo $ract13[3];?></div></td>
										<td><div><?php echo $ract13[4];?></div></td>
										<td><div><?php echo $ract13[5];?></div></td>
										<td><div><?php echo $ract13[6];?></div></td>
										<td><div><?php echo $ract13[7];?></div></td>
										<td><div><?php echo array_sum($ract13);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract13)==0){ 
									$angFT1[2]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angFT1[2]=number_format((($ract13[0]+$ract13[1]+$ract13[2])*100)/array_sum($ract13), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract13[0]+$ract13[1]+$ract13[2])*100)/array_sum($ract13), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
									</tr>								
							<?php	}elseif($LA_Pclass[$activities_count]==21){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[3];?></div></td>
										<td><div><?php echo $ract21[0];?></div></td>
										<td><div><?php echo $ract21[1];?></div></td>
										<td><div><?php echo $ract21[2];?></div></td>
										<td><div><?php echo $ract21[3];?></div></td>
										<td><div><?php echo $ract21[4];?></div></td>
										<td><div><?php echo $ract21[5];?></div></td>
										<td><div><?php echo $ract21[6];?></div></td>
										<td><div><?php echo $ract21[7];?></div></td>
										<td><div><?php echo array_sum($ract21);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract21)==0){ 
									$angFT1[3]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angFT1[3]=number_format((($ract21[0]+$ract21[1]+$ract21[2])*100)/array_sum($ract21), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract21[0]+$ract21[1]+$ract21[2])*100)/array_sum($ract21), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
									</tr>								
							<?php   }elseif($LA_Pclass[$activities_count]==22){ ?>
 									<tr>
										<td><div><?php echo $LA_PclassTxt[4];?></div></td>
										<td><div><?php echo $ract22[0];?></div></td>
										<td><div><?php echo $ract22[1];?></div></td>
										<td><div><?php echo $ract22[2];?></div></td>
										<td><div><?php echo $ract22[3];?></div></td>
										<td><div><?php echo $ract22[4];?></div></td>
										<td><div><?php echo $ract22[5];?></div></td>
										<td><div><?php echo $ract22[6];?></div></td>
										<td><div><?php echo $ract22[7];?></div></td>
										<td><div><?php echo array_sum($ract22);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract22)==0){
										$angFT1[4]=0;
									?>
										<td><div></div></td>
						<?php	}else{ 
										$angFT1[4]=number_format((($ract22[0]+$ract22[1]+$ract22[2])*100)/array_sum($ract22), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract22[0]+$ract22[1]+$ract22[2])*100)/array_sum($ract22), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php   }elseif($LA_Pclass[$activities_count]==23){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[5];?></div></td>
										<td><div><?php echo $ract23[0];?></div></td>
										<td><div><?php echo $ract23[1];?></div></td>
										<td><div><?php echo $ract23[2];?></div></td>
										<td><div><?php echo $ract23[3];?></div></td>
										<td><div><?php echo $ract23[4];?></div></td>
										<td><div><?php echo $ract23[5];?></div></td>
										<td><div><?php echo $ract23[6];?></div></td>
										<td><div><?php echo $ract23[7];?></div></td>
										<td><div><?php echo array_sum($ract23);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract23)==0){ 
									$angFT1[5]=0;
								?>
										<td><div></div></td>
						<?php	}else{
									$angFT1[5]=number_format((($ract23[0]+$ract23[1]+$ract23[2])*100)/array_sum($ract23), 2, '.', ' ');
							?>
										<td><div><?php echo number_format((($ract23[0]+$ract23[1]+$ract23[2])*100)/array_sum($ract23), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
									</tr>								
							<?php  	}else{
										//---------------------------------------------------------
									}
							?>		

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	$activities_count=$activities_count+1;	} ?>

							</tbody>
							</table>
						</div>
					</div>
				</div>			
			</div>			
			</div>
		</div>
	
	</div>


<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<h6 class="content-group-<?php echo $grid;?> text-semibold">
			กิจกรรมภาษา ภาคเรียนที่ 2 ปีการศึกษา <?php echo $LA_Y;?>
			<small class="display-block">กิจกรรมภาษา ประเมินผลภาษาที่ 3 ภาคเรียนที่ 2 ปีการศึกษา <?php echo $LA_Y;?></small>
		</h6>	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h6 class="panel-title">กิจกรรมภาษา : ภาษาญี่ปุ่น ระดับคุณภาพ</h6>
<?php
	$ract11=array(0,0,0,0,0,0,0,0);
	$ract12=array(0,0,0,0,0,0,0,0);
	$ract13=array(0,0,0,0,0,0,0,0);
	$ract21=array(0,0,0,0,0,0,0,0);
	$ract22=array(0,0,0,0,0,0,0,0);
	$ract23=array(0,0,0,0,0,0,0,0);
?>						
					</div>
					<div class="panel-body"> 
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th><div>ชั้น</div></th>
										<th><div>4</div></th>
										<th><div>3.5</div></th>
										<th><div>3</div></th>
										<th><div>2.5</div></th>
										<th><div>2</div></th>
										<th><div>1.5</div></th>
										<th><div>1</div></th>
										<th><div>0</div></th>
										<th><div>รวม</div></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
							<?php
								$activities_count=0;
								while($activities_count<6){ 
															
									$sudRc=new stu_room($LA_Y,'2',$LA_Pclass[$activities_count]);
									foreach($sudRc->stu_array as $rc=>$sudRcRow){
										
										$IDLevel=$sudRcRow["IDLevel"];
											if($IDLevel==11){
												
												$run_activities=new RcSumLangActivities($Pcl11[0],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract11[0]=$ract11[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract11[1]=$ract11[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract11[2]=$ract11[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract11[3]=$ract11[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract11[4]=$ract11[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract11[5]=$ract11[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract11[6]=$ract11[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract11[7]=$ract11[7]+1;
												}else{
													//$ract11[8]=$ract11[8]+1;
												}
																						
												
											}elseif($IDLevel==12){
												
												$run_activities=new RcSumLangActivities($Pcl12[0],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract12[0]=$ract12[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract12[1]=$ract12[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract12[2]=$ract12[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract12[3]=$ract12[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract12[4]=$ract12[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract12[5]=$ract12[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract12[6]=$ract12[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract12[7]=$ract12[7]+1;
												}else{
													//$ract12[8]=$ract12[8]+1;
												}												
												
											}elseif($IDLevel==13){
												
												$run_activities=new RcSumLangActivities($Pcl13[0],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract13[0]=$ract13[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract13[1]=$ract13[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract13[2]=$ract13[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract13[3]=$ract13[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract13[4]=$ract13[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract13[5]=$ract13[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract13[6]=$ract13[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract13[7]=$ract13[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
												
											}elseif($IDLevel==21){
												$run_activities=new RcSumLangActivities($Pcl21[0],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract21[0]=$ract21[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract21[1]=$ract21[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract21[2]=$ract21[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract21[3]=$ract21[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract21[4]=$ract21[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract21[5]=$ract21[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract21[6]=$ract21[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract21[7]=$ract21[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}elseif($IDLevel==22){
												$run_activities=new RcSumLangActivities($Pcl22[0],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract22[0]=$ract22[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract22[1]=$ract22[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract22[2]=$ract22[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract22[3]=$ract22[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract22[4]=$ract22[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract22[5]=$ract22[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract22[6]=$ract22[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract22[7]=$ract22[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}elseif($IDLevel==23){
												$run_activities=new RcSumLangActivities($Pcl23[0],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract23[0]=$ract23[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract23[1]=$ract23[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract23[2]=$ract23[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract23[3]=$ract23[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract23[4]=$ract23[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract23[5]=$ract23[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract23[6]=$ract23[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract23[7]=$ract23[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}else{
												
											}
									}
									
								?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
							<?php
									if($LA_Pclass[$activities_count]==11){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
									<tr>
										<td><div><?php echo $LA_PclassTxt[0];?></div></td>
										<td><div><?php echo $ract11[0];?></div></td>
										<td><div><?php echo $ract11[1];?></div></td>
										<td><div><?php echo $ract11[2];?></div></td>
										<td><div><?php echo $ract11[3];?></div></td>
										<td><div><?php echo $ract11[4];?></div></td>
										<td><div><?php echo $ract11[5];?></div></td>
										<td><div><?php echo $ract11[6];?></div></td>
										<td><div><?php echo $ract11[7];?></div></td>
										<td><div><?php echo array_sum($ract11);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract11)==0){ 
									$angJT2[0]=0;
								?>
										<td><div></div></td>
						<?php	}else{
									$angJT2[0]=number_format((($ract11[0]+$ract11[1]+$ract11[2])*100)/array_sum($ract11), 2, '.', ' ');
							?>
										<td><div><?php echo number_format((($ract11[0]+$ract11[1]+$ract11[2])*100)/array_sum($ract11), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
							<?php	}elseif($LA_Pclass[$activities_count]==12){?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[1];?></div></td>
										<td><div><?php echo $ract12[0];?></div></td>
										<td><div><?php echo $ract12[1];?></div></td>
										<td><div><?php echo $ract12[2];?></div></td>
										<td><div><?php echo $ract12[3];?></div></td>
										<td><div><?php echo $ract12[4];?></div></td>
										<td><div><?php echo $ract12[5];?></div></td>
										<td><div><?php echo $ract12[6];?></div></td>
										<td><div><?php echo $ract12[7];?></div></td>
										<td><div><?php echo array_sum($ract12);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract12)==0){ 
									$angJT2[1]=0;
								?>
										<td><div></div></td>
						<?php	}else{
									$angJT2[1]=number_format((($ract12[0]+$ract12[1]+$ract12[2])*100)/array_sum($ract12), 2, '.', ' ');
							?>
										<td><div><?php echo number_format((($ract12[0]+$ract12[1]+$ract12[2])*100)/array_sum($ract12), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php	}elseif($LA_Pclass[$activities_count]==13){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[2];?></div></td>
										<td><div><?php echo $ract13[0];?></div></td>
										<td><div><?php echo $ract13[1];?></div></td>
										<td><div><?php echo $ract13[2];?></div></td>
										<td><div><?php echo $ract13[3];?></div></td>
										<td><div><?php echo $ract13[4];?></div></td>
										<td><div><?php echo $ract13[5];?></div></td>
										<td><div><?php echo $ract13[6];?></div></td>
										<td><div><?php echo $ract13[7];?></div></td>
										<td><div><?php echo array_sum($ract13);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract13)==0){ 
									$angJT2[2]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angJT2[2]=number_format((($ract13[0]+$ract13[1]+$ract13[2])*100)/array_sum($ract13), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract13[0]+$ract13[1]+$ract13[2])*100)/array_sum($ract13), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php	}elseif($LA_Pclass[$activities_count]==21){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[3];?></div></td>
										<td><div><?php echo $ract21[0];?></div></td>
										<td><div><?php echo $ract21[1];?></div></td>
										<td><div><?php echo $ract21[2];?></div></td>
										<td><div><?php echo $ract21[3];?></div></td>
										<td><div><?php echo $ract21[4];?></div></td>
										<td><div><?php echo $ract21[5];?></div></td>
										<td><div><?php echo $ract21[6];?></div></td>
										<td><div><?php echo $ract21[7];?></div></td>
										<td><div><?php echo array_sum($ract21);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract21)==0){
										$angJT2[3]=0;
									?>
										<td><div></div></td>
						<?php	}else{ 
										$angJT2[3]=number_format((($ract21[0]+$ract21[1]+$ract21[2])*100)/array_sum($ract21), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract21[0]+$ract21[1]+$ract21[2])*100)/array_sum($ract21), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php   }elseif($LA_Pclass[$activities_count]==22){ ?>
 									<tr>
										<td><div><?php echo $LA_PclassTxt[4];?></div></td>
										<td><div><?php echo $ract22[0];?></div></td>
										<td><div><?php echo $ract22[1];?></div></td>
										<td><div><?php echo $ract22[2];?></div></td>
										<td><div><?php echo $ract22[3];?></div></td>
										<td><div><?php echo $ract22[4];?></div></td>
										<td><div><?php echo $ract22[5];?></div></td>
										<td><div><?php echo $ract22[6];?></div></td>
										<td><div><?php echo $ract22[7];?></div></td>
										<td><div><?php echo array_sum($ract22);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract22)==0){
										$angJT2[4]=0;
									?>
										<td><div></div></td>
						<?php	}else{ 
										$angJT2[4]=number_format((($ract22[0]+$ract22[1]+$ract22[2])*100)/array_sum($ract22), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract22[0]+$ract22[1]+$ract22[2])*100)/array_sum($ract22), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php   }elseif($LA_Pclass[$activities_count]==23){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[5];?></div></td>
										<td><div><?php echo $ract23[0];?></div></td>
										<td><div><?php echo $ract23[1];?></div></td>
										<td><div><?php echo $ract23[2];?></div></td>
										<td><div><?php echo $ract23[3];?></div></td>
										<td><div><?php echo $ract23[4];?></div></td>
										<td><div><?php echo $ract23[5];?></div></td>
										<td><div><?php echo $ract23[6];?></div></td>
										<td><div><?php echo $ract23[7];?></div></td>
										<td><div><?php echo array_sum($ract23);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract23)==0){
										$angJT2[5]=0;
									?>
										<td><div></div></td>
						<?php	}else{ 
										$angJT2[5]=number_format((($ract23[0]+$ract23[1]+$ract23[2])*100)/array_sum($ract23), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract23[0]+$ract23[1]+$ract23[2])*100)/array_sum($ract23), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php  	}else{
									
									}
							?>		

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	$activities_count=$activities_count+1;	} ?>

							</tbody>
							</table>
						</div>
					</div>
				</div>			
			</div>
			</div>
			
			<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h6 class="panel-title">กิจกรรมภาษา : ภาษาจีน ระดับคุณภาพ ระดับคุณภาพ</h6>
<?php
	$ract11=array(0,0,0,0,0,0,0,0);
	$ract12=array(0,0,0,0,0,0,0,0);
	$ract13=array(0,0,0,0,0,0,0,0);
	$ract21=array(0,0,0,0,0,0,0,0);
	$ract22=array(0,0,0,0,0,0,0,0);
	$ract23=array(0,0,0,0,0,0,0,0);
?>						
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th><div>ชั้น</div></th>
										<th><div>4</div></th>
										<th><div>3.5</div></th>
										<th><div>3</div></th>
										<th><div>2.5</div></th>
										<th><div>2</div></th>
										<th><div>1.5</div></th>
										<th><div>1</div></th>
										<th><div>0</div></th>
										<th><div>รวม</div></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
							<?php
								$activities_count=0;
								while($activities_count<6){ 
															
									$sudRc=new stu_room($LA_Y,'1',$LA_Pclass[$activities_count]);
									foreach($sudRc->stu_array as $rc=>$sudRcRow){
										
										$IDLevel=$sudRcRow["IDLevel"];
											if($IDLevel==11){
												
												$run_activities=new RcSumLangActivities($Pcl11[1],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract11[0]=$ract11[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract11[1]=$ract11[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract11[2]=$ract11[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract11[3]=$ract11[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract11[4]=$ract11[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract11[5]=$ract11[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract11[6]=$ract11[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract11[7]=$ract11[7]+1;
												}else{
													//$ract11[8]=$ract11[8]+1;
												}
																						
												
											}elseif($IDLevel==12){
												
												$run_activities=new RcSumLangActivities($Pcl12[1],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract12[0]=$ract12[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract12[1]=$ract12[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract12[2]=$ract12[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract12[3]=$ract12[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract12[4]=$ract12[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract12[5]=$ract12[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract12[6]=$ract12[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract12[7]=$ract12[7]+1;
												}else{
													//$ract12[8]=$ract12[8]+1;
												}												
												
											}elseif($IDLevel==13){
												
												$run_activities=new RcSumLangActivities($Pcl13[1],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract13[0]=$ract13[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract13[1]=$ract13[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract13[2]=$ract13[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract13[3]=$ract13[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract13[4]=$ract13[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract13[5]=$ract13[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract13[6]=$ract13[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract13[7]=$ract13[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
												
											}elseif($IDLevel==21){
												$run_activities=new RcSumLangActivities($Pcl21[1],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract21[0]=$ract21[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract21[1]=$ract21[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract21[2]=$ract21[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract21[3]=$ract21[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract21[4]=$ract21[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract21[5]=$ract21[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract21[6]=$ract21[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract21[7]=$ract21[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}elseif($IDLevel==22){
												$run_activities=new RcSumLangActivities($Pcl22[1],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract22[0]=$ract22[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract22[1]=$ract22[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract22[2]=$ract22[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract22[3]=$ract22[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract22[4]=$ract22[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract22[5]=$ract22[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract22[6]=$ract22[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract22[7]=$ract22[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}elseif($IDLevel==23){
												$run_activities=new RcSumLangActivities($Pcl23[1],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract23[0]=$ract23[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract23[1]=$ract23[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract23[2]=$ract23[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract23[3]=$ract23[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract23[4]=$ract23[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract23[5]=$ract23[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract23[6]=$ract23[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract23[7]=$ract23[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}else{
												
											}
									}
									
								?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
							<?php
									if($LA_Pclass[$activities_count]==11){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
									<tr>
										<td><div><?php echo $LA_PclassTxt[0];?></div></td>
										<td><div><?php echo $ract11[0];?></div></td>
										<td><div><?php echo $ract11[1];?></div></td>
										<td><div><?php echo $ract11[2];?></div></td>
										<td><div><?php echo $ract11[3];?></div></td>
										<td><div><?php echo $ract11[4];?></div></td>
										<td><div><?php echo $ract11[5];?></div></td>
										<td><div><?php echo $ract11[6];?></div></td>
										<td><div><?php echo $ract11[7];?></div></td>
										<td><div><?php echo array_sum($ract11);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract11)==0){ 
									$angCT2[0]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angCT2[0]=number_format((($ract11[0]+$ract11[1]+$ract11[2])*100)/array_sum($ract11), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract11[0]+$ract11[1]+$ract11[2])*100)/array_sum($ract11), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
							<?php	}elseif($LA_Pclass[$activities_count]==12){?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[1];?></div></td>
										<td><div><?php echo $ract12[0];?></div></td>
										<td><div><?php echo $ract12[1];?></div></td>
										<td><div><?php echo $ract12[2];?></div></td>
										<td><div><?php echo $ract12[3];?></div></td>
										<td><div><?php echo $ract12[4];?></div></td>
										<td><div><?php echo $ract12[5];?></div></td>
										<td><div><?php echo $ract12[6];?></div></td>
										<td><div><?php echo $ract12[7];?></div></td>
										<td><div><?php echo array_sum($ract12);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract12)==0){ 
									$angCT2[1]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angCT2[1]=number_format((($ract12[0]+$ract12[1]+$ract12[2])*100)/array_sum($ract12), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract12[0]+$ract12[1]+$ract12[2])*100)/array_sum($ract12), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php	}elseif($LA_Pclass[$activities_count]==13){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[2];?></div></td>
										<td><div><?php echo $ract13[0];?></div></td>
										<td><div><?php echo $ract13[1];?></div></td>
										<td><div><?php echo $ract13[2];?></div></td>
										<td><div><?php echo $ract13[3];?></div></td>
										<td><div><?php echo $ract13[4];?></div></td>
										<td><div><?php echo $ract13[5];?></div></td>
										<td><div><?php echo $ract13[6];?></div></td>
										<td><div><?php echo $ract13[7];?></div></td>
										<td><div><?php echo array_sum($ract13);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract13)==0){ 
									$angCT2[2]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angCT2[2]=number_format((($ract13[0]+$ract13[1]+$ract13[2])*100)/array_sum($ract13), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract13[0]+$ract13[1]+$ract13[2])*100)/array_sum($ract13), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php	}elseif($LA_Pclass[$activities_count]==21){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[3];?></div></td>
										<td><div><?php echo $ract21[0];?></div></td>
										<td><div><?php echo $ract21[1];?></div></td>
										<td><div><?php echo $ract21[2];?></div></td>
										<td><div><?php echo $ract21[3];?></div></td>
										<td><div><?php echo $ract21[4];?></div></td>
										<td><div><?php echo $ract21[5];?></div></td>
										<td><div><?php echo $ract21[6];?></div></td>
										<td><div><?php echo $ract21[7];?></div></td>
										<td><div><?php echo array_sum($ract21);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract21)==0){ 
									$angCT2[3]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angCT2[3]=number_format((($ract21[0]+$ract21[1]+$ract21[2])*100)/array_sum($ract21), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract21[0]+$ract21[1]+$ract21[2])*100)/array_sum($ract21), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php   }elseif($LA_Pclass[$activities_count]==22){ ?>
 									<tr>
										<td><div><?php echo $LA_PclassTxt[4];?></div></td>
										<td><div><?php echo $ract22[0];?></div></td>
										<td><div><?php echo $ract22[1];?></div></td>
										<td><div><?php echo $ract22[2];?></div></td>
										<td><div><?php echo $ract22[3];?></div></td>
										<td><div><?php echo $ract22[4];?></div></td>
										<td><div><?php echo $ract22[5];?></div></td>
										<td><div><?php echo $ract22[6];?></div></td>
										<td><div><?php echo $ract22[7];?></div></td>
										<td><div><?php echo array_sum($ract22);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract22)==0){ 
									$angCT2[4]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angCT2[4]=number_format((($ract22[0]+$ract22[1]+$ract22[2])*100)/array_sum($ract22), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract22[0]+$ract22[1]+$ract22[2])*100)/array_sum($ract22), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php   }elseif($LA_Pclass[$activities_count]==23){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[5];?></div></td>
										<td><div><?php echo $ract23[0];?></div></td>
										<td><div><?php echo $ract23[1];?></div></td>
										<td><div><?php echo $ract23[2];?></div></td>
										<td><div><?php echo $ract23[3];?></div></td>
										<td><div><?php echo $ract23[4];?></div></td>
										<td><div><?php echo $ract23[5];?></div></td>
										<td><div><?php echo $ract23[6];?></div></td>
										<td><div><?php echo $ract23[7];?></div></td>
										<td><div><?php echo array_sum($ract23);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract23)==0){
										$angCT2[5]=0;
									?>
										<td><div></div></td>
						<?php	}else{ 
										$angCT2[5]=number_format((($ract23[0]+$ract23[1]+$ract23[2])*100)/array_sum($ract23), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract23[0]+$ract23[1]+$ract23[2])*100)/array_sum($ract23), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php  	}else{
									
									}
							?>		

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	$activities_count=$activities_count+1;	} ?>

							</tbody>
							</table>
						</div>
					</div>
				</div>			
			</div>
			</div>
			
			<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h6 class="panel-title">กิจกรรมภาษา : ภาษาฝรั่งเศส ระดับคุณภาพ</h6>
<?php
	$ract11=array(0,0,0,0,0,0,0,0);
	$ract12=array(0,0,0,0,0,0,0,0);
	$ract13=array(0,0,0,0,0,0,0,0);
	$ract21=array(0,0,0,0,0,0,0,0);
	$ract22=array(0,0,0,0,0,0,0,0);
	$ract23=array(0,0,0,0,0,0,0,0);
?>						
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th><div>ชั้น</div></th>
										<th><div>4</div></th>
										<th><div>3.5</div></th>
										<th><div>3</div></th>
										<th><div>2.5</div></th>
										<th><div>2</div></th>
										<th><div>1.5</div></th>
										<th><div>1</div></th>
										<th><div>0</div></th>
										<th><div>รวม</div></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
							<?php
								$activities_count=0;
								while($activities_count<6){ 
															
									$sudRc=new stu_room($LA_Y,'1',$LA_Pclass[$activities_count]);
									foreach($sudRc->stu_array as $rc=>$sudRcRow){
										
										$IDLevel=$sudRcRow["IDLevel"];
											if($IDLevel==11){
												
												$run_activities=new RcSumLangActivities($Pcl11[2],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract11[0]=$ract11[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract11[1]=$ract11[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract11[2]=$ract11[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract11[3]=$ract11[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract11[4]=$ract11[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract11[5]=$ract11[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract11[6]=$ract11[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract11[7]=$ract11[7]+1;
												}else{
													//$ract11[8]=$ract11[8]+1;
												}
																						
												
											}elseif($IDLevel==12){
												
												$run_activities=new RcSumLangActivities($Pcl12[2],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract12[0]=$ract12[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract12[1]=$ract12[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract12[2]=$ract12[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract12[3]=$ract12[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract12[4]=$ract12[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract12[5]=$ract12[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract12[6]=$ract12[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract12[7]=$ract12[7]+1;
												}else{
													//$ract12[8]=$ract12[8]+1;
												}												
												
											}elseif($IDLevel==13){
												
												$run_activities=new RcSumLangActivities($Pcl13[2],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract13[0]=$ract13[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract13[1]=$ract13[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract13[2]=$ract13[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract13[3]=$ract13[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract13[4]=$ract13[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract13[5]=$ract13[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract13[6]=$ract13[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract13[7]=$ract13[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
												
											}elseif($IDLevel==21){
												$run_activities=new RcSumLangActivities($Pcl21[2],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract21[0]=$ract21[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract21[1]=$ract21[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract21[2]=$ract21[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract21[3]=$ract21[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract21[4]=$ract21[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract21[5]=$ract21[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract21[6]=$ract21[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract21[7]=$ract21[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}elseif($IDLevel==22){
												$run_activities=new RcSumLangActivities($Pcl22[2],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract22[0]=$ract22[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract22[1]=$ract22[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract22[2]=$ract22[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract22[3]=$ract22[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract22[4]=$ract22[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract22[5]=$ract22[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract22[6]=$ract22[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract22[7]=$ract22[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}elseif($IDLevel==23){
												$run_activities=new RcSumLangActivities($Pcl23[2],$sudRcRow["rsd_studentid"],'2',$LA_Y);
								
												if($run_activities->grade_skill=='4'){
													$ract23[0]=$ract23[0]+1;
												}elseif($run_activities->grade_skill=='3.5'){
													$ract23[1]=$ract23[1]+1;
												}elseif($run_activities->grade_skill=='3'){
													$ract23[2]=$ract23[2]+1;
												}elseif($run_activities->grade_skill=='2.5'){
													$ract23[3]=$ract23[3]+1;
												}elseif($run_activities->grade_skill=='2'){
													$ract23[4]=$ract23[4]+1;
												}elseif($run_activities->grade_skill=='1.5'){
													$ract23[5]=$ract23[5]+1;
												}elseif($run_activities->grade_skill=='1'){
													$ract23[6]=$ract23[6]+1;
												}elseif($run_activities->grade_skill=='0'){
													$ract23[7]=$ract23[7]+1;
												}else{
													//$ract13[8]=$ract13[8]+1;
												}												
											}else{
												
											}
									}
									
								?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
							<?php
									if($LA_Pclass[$activities_count]==11){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
									<tr>
										<td><div><?php echo $LA_PclassTxt[0];?></div></td>
										<td><div><?php echo $ract11[0];?></div></td>
										<td><div><?php echo $ract11[1];?></div></td>
										<td><div><?php echo $ract11[2];?></div></td>
										<td><div><?php echo $ract11[3];?></div></td>
										<td><div><?php echo $ract11[4];?></div></td>
										<td><div><?php echo $ract11[5];?></div></td>
										<td><div><?php echo $ract11[6];?></div></td>
										<td><div><?php echo $ract11[7];?></div></td>
										<td><div><?php echo array_sum($ract11);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract11)==0){
										$angFT2[0]=0;
									?>
										<td><div></div></td>
						<?php	}else{ 
										$angFT2[0]=number_format((($ract11[0]+$ract11[1]+$ract11[2])*100)/array_sum($ract11), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract11[0]+$ract11[1]+$ract11[2])*100)/array_sum($ract11), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
							<?php	}elseif($LA_Pclass[$activities_count]==12){?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[1];?></div></td>
										<td><div><?php echo $ract12[0];?></div></td>
										<td><div><?php echo $ract12[1];?></div></td>
										<td><div><?php echo $ract12[2];?></div></td>
										<td><div><?php echo $ract12[3];?></div></td>
										<td><div><?php echo $ract12[4];?></div></td>
										<td><div><?php echo $ract12[5];?></div></td>
										<td><div><?php echo $ract12[6];?></div></td>
										<td><div><?php echo $ract12[7];?></div></td>
										<td><div><?php echo array_sum($ract12);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract12)==0){ 
									$angFT2[1]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angFT2[1]=number_format((($ract12[0]+$ract12[1]+$ract12[2])*100)/array_sum($ract12), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract12[0]+$ract12[1]+$ract12[2])*100)/array_sum($ract12), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php	}elseif($LA_Pclass[$activities_count]==13){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[2];?></div></td>
										<td><div><?php echo $ract13[0];?></div></td>
										<td><div><?php echo $ract13[1];?></div></td>
										<td><div><?php echo $ract13[2];?></div></td>
										<td><div><?php echo $ract13[3];?></div></td>
										<td><div><?php echo $ract13[4];?></div></td>
										<td><div><?php echo $ract13[5];?></div></td>
										<td><div><?php echo $ract13[6];?></div></td>
										<td><div><?php echo $ract13[7];?></div></td>
										<td><div><?php echo array_sum($ract13);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract13)==0){ 
									$angFT2[2]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angFT2[2]=number_format((($ract13[0]+$ract13[1]+$ract13[2])*100)/array_sum($ract13), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract13[0]+$ract13[1]+$ract13[2])*100)/array_sum($ract13), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php	}elseif($LA_Pclass[$activities_count]==21){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[3];?></div></td>
										<td><div><?php echo $ract21[0];?></div></td>
										<td><div><?php echo $ract21[1];?></div></td>
										<td><div><?php echo $ract21[2];?></div></td>
										<td><div><?php echo $ract21[3];?></div></td>
										<td><div><?php echo $ract21[4];?></div></td>
										<td><div><?php echo $ract21[5];?></div></td>
										<td><div><?php echo $ract21[6];?></div></td>
										<td><div><?php echo $ract21[7];?></div></td>
										<td><div><?php echo array_sum($ract21);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract21)==0){ 
									$angFT2[3]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angFT2[3]=number_format((($ract21[0]+$ract21[1]+$ract21[2])*100)/array_sum($ract21), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract21[0]+$ract21[1]+$ract21[2])*100)/array_sum($ract21), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php   }elseif($LA_Pclass[$activities_count]==22){ ?>
 									<tr>
										<td><div><?php echo $LA_PclassTxt[4];?></div></td>
										<td><div><?php echo $ract22[0];?></div></td>
										<td><div><?php echo $ract22[1];?></div></td>
										<td><div><?php echo $ract22[2];?></div></td>
										<td><div><?php echo $ract22[3];?></div></td>
										<td><div><?php echo $ract22[4];?></div></td>
										<td><div><?php echo $ract22[5];?></div></td>
										<td><div><?php echo $ract22[6];?></div></td>
										<td><div><?php echo $ract22[7];?></div></td>
										<td><div><?php echo array_sum($ract22);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract22)==0){ 
									$angFT2[4]=0;
								?>
										<td><div></div></td>
						<?php	}else{ 
									$angFT2[4]=number_format((($ract22[0]+$ract22[1]+$ract22[2])*100)/array_sum($ract22), 2, '.', ' ');
						?>
										<td><div><?php echo number_format((($ract22[0]+$ract22[1]+$ract22[2])*100)/array_sum($ract22), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php   }elseif($LA_Pclass[$activities_count]==23){ ?>
									<tr>
										<td><div><?php echo $LA_PclassTxt[5];?></div></td>
										<td><div><?php echo $ract23[0];?></div></td>
										<td><div><?php echo $ract23[1];?></div></td>
										<td><div><?php echo $ract23[2];?></div></td>
										<td><div><?php echo $ract23[3];?></div></td>
										<td><div><?php echo $ract23[4];?></div></td>
										<td><div><?php echo $ract23[5];?></div></td>
										<td><div><?php echo $ract23[6];?></div></td>
										<td><div><?php echo $ract23[7];?></div></td>
										<td><div><?php echo array_sum($ract23);?></div></td>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
						<?php
								if(array_sum($ract23)==0){
										$angFT2[5]=0;
									?>
										<td><div></div></td>
						<?php	}else{
										$angFT2[5]=number_format((($ract23[0]+$ract23[1]+$ract23[2])*100)/array_sum($ract23), 2, '.', ' ');
							?>
										<td><div><?php echo number_format((($ract23[0]+$ract23[1]+$ract23[2])*100)/array_sum($ract23), 2, '.', ' ');?></div></td>									
						<?php	}?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
									</tr>								
							<?php  	}else{
									
									}
							?>		

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
						<?php	$activities_count=$activities_count+1;	} ?>

							</tbody>
							</table>
						</div>
					</div>
				</div>			
			</div>			
			</div>
			
		</div>

	
	</div>

	<div class="row">
		<div class="col-<?php echo $grid;?>-4">
			<div class="panel panel-success">
				<div class="panel-heading">กิจกรรมภาษา : ภาษาญี่ปุ่น</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>ชั้น</th>
									<th>ร้อยละ เทอม 1</th>
									<th>ร้อยละ เทอม 2</th>
									<th>เฉลี่ย</th>
								</tr>
							</thead>
							<tbody>
<!--*********************************************************************************-->							
				<?php
					$ang_count=0;
					while($ang_count<=5){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<tr>
									<td><?php echo $LA_PclassTxt[$ang_count];?></td>
									<td><?php echo $angJT1[$ang_count];?></td>
									<td><?php echo $angJT2[$ang_count];?></td>
									<td><?php echo number_format(($angJT1[$ang_count]+$angJT2[$ang_count])/2, 2, '.', ' ');?></td>
								</tr>						
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php		$ang_count=$ang_count+1;
					}?>			
<!--*********************************************************************************-->										
							</tbody>
						</table>
					</div>			
				</div>
			</div>		
		</div>
		<div class="col-<?php echo $grid;?>-4">
			<div class="panel panel-info">
				<div class="panel-heading">กิจกรรมภาษา : ภาษาจีน</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>ชั้น</th>
									<th>ร้อยละ เทอม 1</th>
									<th>ร้อยละ เทอม 2</th>
									<th>เฉลี่ย</th>
								</tr>
							</thead>
							<tbody>
<!--*********************************************************************************-->							
				<?php
					$ang_count=0;
					while($ang_count<=5){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<tr>
									<td><?php echo $LA_PclassTxt[$ang_count];?></td>
									<td><?php echo $angCT1[$ang_count];?></td>
									<td><?php echo $angCT2[$ang_count];?></td>
									<td><?php echo number_format(($angCT1[$ang_count]+$angCT2[$ang_count])/2, 2, '.', ' ');?></td>
								</tr>						
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php		$ang_count=$ang_count+1;
					}?>			
<!--*********************************************************************************-->
							</tbody>
						</table>
					</div>				
				</div>
			</div>		
		</div>
		<div class="col-<?php echo $grid;?>-4">
			<div class="panel panel-danger">
				<div class="panel-heading">กิจกรรมภาษา : ภาษาฝรั่งเศส</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>ชั้น</th>
									<th>ร้อยละ เทอม 1</th>
									<th>ร้อยละ เทอม 2</th>
									<th>เฉลี่ย</th>
								</tr>
							</thead>
							<tbody>
<!--*********************************************************************************-->							
				<?php
					$ang_count=0;
					while($ang_count<=5){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
								<tr>
									<td><?php echo $LA_PclassTxt[$ang_count];?></td>
									<td><?php echo $angFT1[$ang_count];?></td>
									<td><?php echo $angFT2[$ang_count];?></td>
									<td><?php echo number_format(($angFT1[$ang_count]+$angFT2[$ang_count])/2, 2, '.', ' ');?></td>
								</tr>						
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php		$ang_count=$ang_count+1;
					}?>			
<!--*********************************************************************************-->
							</tbody>
						</table>
					</div>				
				</div>
			</div>		
		</div>
	</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<button type="button" name="goback" id="goback" class="btn btn-danger">กลับไป ที่ กิจกรรมภาษา ประเมินผลภาษาที่ 3</button>
		</div>
	</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php	}else{}?>