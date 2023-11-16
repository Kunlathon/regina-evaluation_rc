<?php
	include("../../../../../view/database/pdo_talent.php");	
	include("../../../../../view/database/class_talent.php");
?>
<style>
#RuningLoadTalent{
	display:none;
}

.one{
  border-style: solid;
  border-color: #9900FF;
  border-width: 5px;
}

</style>  
<!--****************************************************************************-->	
	
<!--****************************************************************************-->		
    <script type="text/javascript">
        function setScreenHWCookie() {
            $.cookie('sw',screen.width);
                //$.cookie('sh',screen.height);
            return true;
        }
            setScreenHWCookie();
    </script>
<!--****************************************************************************-->	
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
	<script>
		$(function() {
			$("#RunLoadTalent").fadeOut(5000, function() {
				$("#RuningLoadTalent").fadeIn(4000);
			});
		});
	</script>
<!--****************************************************************************-->	
	<script>
		$(document).ready(function(){
			
			// Multiselect
			$('.MultiselectInfo').multiselect({
				buttonClass: 'btn bg-info',
				nonSelectedText: 'เลือก รายการวิชาการ'
			});
			// Multiselect End
			// Multiselect	
			$('.MultiselectWarning').multiselect({
				buttonClass: 'btn bg-warning',
				nonSelectedText: 'เลือก ระดับผลงาน / รางวัลที่เคยได้รับ'
			});	
			// Multiselect
			// Multiselect End	
			
		});
	</script>


	<script>
		$(document).ready(function(){
			$("#ClearData").click(function(){
				document.location="/programming/evaluation_rc/?evaluation_mod=talent_student";
			})
		})
	</script>
<!--****************************************************************************-->	
	<script>
	
		$(document).ready(function(){
			
			Noty.overrideDefaults({
				theme: 'limitless',
				layout: 'topRight',
				type: 'alert',
				timeout: 2500
			});
			
			var Count_AT_Txt=2;
			$("#ButAdd_AT_Txt").click(function () {
				if(Count_AT_Txt>=6){
					
					new PNotify({
						title: 'เข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล (ด้านวิชาการ)',
						text: 'อนุญาตเพียง 5 กล่องข้อความ',
						icon: 'icon-blocked',
						type: 'error'
					});

					return false;
				}else{
							
					var newTextBoxDiv = $(document.createElement('div'))
					   .attr("id", 'BoxATTxt' + Count_AT_Txt);
                
						newTextBoxDiv.after().html('<div class="col-<?php echo $grid;?>-12">'+
												        '<div class="row">'+
												             '<fieldset class="content-group">'+
												                  '<div class="form-group">'+
												                       '<label class="control-label col-<?php echo $grid;?>-3">เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล</label>'+
												                       '<div class="col-<?php echo $grid;?>-9">'+
												                            '<input type="text" name="AcademicTxt[]"  class="form-control" maxlength="100" minlength="5"  placeholder="เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล"  />'+
												                       '</div>'+
												                  '</div>'+
												             '</fieldset>'+
												        '</div>'+
												   '</div>');
						newTextBoxDiv.appendTo("#GroupATTxt");					
				}   
				Count_AT_Txt++;
			    return true;
			});
			
			$("#ButDele_AT_Txt").click(function () {
				if(Count_AT_Txt==1){
					
					new PNotify({
						title: 'เข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล (ด้านวิชาการ)',
						text: 'ไม่มีกล่องข้อความให้ลบอีกต่อไป',
						icon: 'icon-blocked',
						type: 'error'
					});					
					
					  return false;
				}else{
					Count_AT_Txt--;    
					$("#BoxATTxt" + Count_AT_Txt).remove();		
					return true;
				}   
        

            
     });
			
		});
	</script>
<!--****************************************************************************-->	

<!--****************************************************************************-->	
	<script>
	
		$(document).ready(function(){
			
			Noty.overrideDefaults({
				theme: 'limitless',
				layout: 'topRight',
				type: 'alert',
				timeout: 2500
			});
			
			var Count_Sport_Txt=2;
			$("#ButAdd_Sport_Txt").click(function () {
				if(Count_Sport_Txt>=6){
					
					new PNotify({
						title: 'เข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล (ด้านกีฬา)',
						text: 'อนุญาตเพียง 5 กล่องข้อความ',
						icon: 'icon-blocked',
						type: 'error'
					});

					return false;
				}else{
							
					var newTextBoxDiv = $(document.createElement('div'))
					   .attr("id", 'BoxSportTxt' + Count_Sport_Txt);
                
						newTextBoxDiv.after().html('<div class="col-<?php echo $grid;?>-12">'+
												        '<div class="row">'+
												             '<fieldset class="content-group">'+
												                  '<div class="form-group">'+
												                       '<label class="control-label col-<?php echo $grid;?>-3">เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล</label>'+
												                       '<div class="col-<?php echo $grid;?>-9">'+
												                            '<input type="text" name="SportTxt[]" id="SportTxt" class="form-control" maxlength="100" minlength="5"  placeholder="เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล"  />'+
												                       '</div>'+
												                  '</div>'+
												             '</fieldset>'+
												        '</div>'+
												   '</div>');
						newTextBoxDiv.appendTo("#GroupSportTxt");					
				}   
				Count_Sport_Txt++;
			    return true;
			});
			
			$("#ButDele_Sport_Txt").click(function () {
				if(Count_Sport_Txt==1){
					
					new PNotify({
						title: 'เข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล (ด้านกีฬา)',
						text: 'ไม่มีกล่องข้อความให้ลบอีกต่อไป',
						icon: 'icon-blocked',
						type: 'error'
					});					
					
					  return false;
				}else{
					Count_Sport_Txt--;    
					$("#BoxSportTxt" + Count_Sport_Txt).remove();		
					return true;
				}   
        

            
     });
			
		});
	</script>
<!--****************************************************************************-->	

<!--****************************************************************************-->	
	<script>
	
		$(document).ready(function(){
			
			Noty.overrideDefaults({
				theme: 'limitless',
				layout: 'topRight',
				type: 'alert',
				timeout: 2500
			});
			
			var Count_Music_Txt=2;
			$("#ButAdd_Music_Txt").click(function () {
				if(Count_Music_Txt>=6){
					
					new PNotify({
						title: 'เข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล (ด้านดนตรี)',
						text: 'อนุญาตเพียง 5 กล่องข้อความ',
						icon: 'icon-blocked',
						type: 'error'
					});

					return false;
				}else{
							
					var newTextBoxDiv = $(document.createElement('div'))
					   .attr("id", 'BoxMusicTxt' + Count_Music_Txt);
                
						newTextBoxDiv.after().html('<div class="col-<?php echo $grid;?>-12">'+
												        '<div class="row">'+
												             '<fieldset class="content-group">'+
												                  '<div class="form-group">'+
												                       '<label class="control-label col-<?php echo $grid;?>-3">เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล</label>'+
												                       '<div class="col-<?php echo $grid;?>-9">'+
												                            '<input type="text" name="MusicTxt[]" id="MusicTxt" class="form-control" maxlength="100" minlength="5"  placeholder="เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล"  />'+
												                       '</div>'+
												                  '</div>'+
												             '</fieldset>'+
												        '</div>'+
												   '</div>');
						newTextBoxDiv.appendTo("#GroupMusicTxt");					
				}   
				Count_Music_Txt++;
			    return true;
			});
			
			$("#ButDele_Music_Txt").click(function () {
				if(Count_Music_Txt==1){
					
					new PNotify({
						title: 'เข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล (ด้านดนตรี)',
						text: 'ไม่มีกล่องข้อความให้ลบอีกต่อไป',
						icon: 'icon-blocked',
						type: 'error'
					});					
					
					  return false;
				}else{
					Count_Music_Txt--;    
					$("#BoxMusicTxt" + Count_Music_Txt).remove();		
					return true;
				}   
        

            
     });
			
		});
	</script>
<!--****************************************************************************-->

<!--****************************************************************************-->	
	<script>
	
		$(document).ready(function(){
			
			Noty.overrideDefaults({
				theme: 'limitless',
				layout: 'topRight',
				type: 'alert',
				timeout: 2500
			});
			
			var Count_AAP_Txt=2;
			$("#ButAdd_AAP_Txt").click(function () {
				if(Count_AAP_Txt>=6){
					
					new PNotify({
						title: 'เข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล (ด้านศิลปะและการแสดง)',
						text: 'อนุญาตเพียง 5 กล่องข้อความ',
						icon: 'icon-blocked',
						type: 'error'
					});

					return false;
				}else{
							
					var newTextBoxDiv = $(document.createElement('div'))
					   .attr("id", 'BoxAAPTxt' + Count_AAP_Txt);
                
						newTextBoxDiv.after().html('<div class="col-<?php echo $grid;?>-12">'+
												        '<div class="row">'+
												             '<fieldset class="content-group">'+
												                  '<div class="form-group">'+
												                       '<label class="control-label col-<?php echo $grid;?>-3">เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล</label>'+
												                       '<div class="col-<?php echo $grid;?>-9">'+
												                            '<input type="text" name="AAPTxt[]" id="AAPTxt" class="form-control" maxlength="100" minlength="5"  placeholder="เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล"  />'+
												                       '</div>'+
												                  '</div>'+
												             '</fieldset>'+
												        '</div>'+
												   '</div>');
						newTextBoxDiv.appendTo("#GroupAAPTxt");					
				}   
				Count_AAP_Txt++;
			    return true;
			});
			
			$("#ButDele_AAP_Txt").click(function () {
				if(Count_AAP_Txt==1){
					
					new PNotify({
						title: 'เข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล (ด้านศิลปะและการแสดง)',
						text: 'ไม่มีกล่องข้อความให้ลบอีกต่อไป',
						icon: 'icon-blocked',
						type: 'error'
					});					
					
					  return false;
				}else{
					Count_AAP_Txt--;    
					$("#BoxAAPTxt" + Count_AAP_Txt).remove();		
					return true;
				}   
        

            
     });
			
		});
	</script>
<!--****************************************************************************-->
<!--****************************************************************************-->	
	<script>
	
		$(document).ready(function(){
			
			Noty.overrideDefaults({
				theme: 'limitless',
				layout: 'topRight',
				type: 'alert',
				timeout: 2500
			});
			
			var Count_Other_Txt=2;
			$("#ButAdd_Other_Txt").click(function () {
				if(Count_Other_Txt>=6){
					
					new PNotify({
						title: 'เข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล (ด้านอื่นๆ)',
						text: 'อนุญาตเพียง 5 กล่องข้อความ',
						icon: 'icon-blocked',
						type: 'error'
					});

					return false;
				}else{
							
					var newTextBoxDiv = $(document.createElement('div'))
					   .attr("id", 'BoxOtherTxt' + Count_Other_Txt);
                
						newTextBoxDiv.after().html('<div class="col-<?php echo $grid;?>-12">'+
												        '<div class="row">'+
												             '<fieldset class="content-group">'+
												                  '<div class="form-group">'+
												                       '<label class="control-label col-<?php echo $grid;?>-3">เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล</label>'+
												                       '<div class="col-<?php echo $grid;?>-9">'+
												                            '<input type="text" name="OtherTxt[]" id="OtherTxt" class="form-control" maxlength="100" minlength="5"  placeholder="เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล"  />'+
												                       '</div>'+
												                  '</div>'+
												             '</fieldset>'+
												        '</div>'+
												   '</div>');
						newTextBoxDiv.appendTo("#GroupOtherTxt");					
				}   
				Count_Other_Txt++;
			    return true;
			});
			
			$("#ButDele_Other_Txt").click(function () {
				if(Count_Other_Txt==1){
					
					new PNotify({
						title: 'เข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล (ด้านอื่นๆ)',
						text: 'ไม่มีกล่องข้อความให้ลบอีกต่อไป',
						icon: 'icon-blocked',
						type: 'error'
					});					
					
					  return false;
				}else{
					Count_Other_Txt--;    
					$("#BoxOtherTxt" + Count_Other_Txt).remove();		
					return true;
				}   
        

            
     });
			
		});
	</script>
<!--****************************************************************************-->
<!--****************************************************************************-->	
	<script>
	
		$(document).ready(function(){
			
			Noty.overrideDefaults({
				theme: 'limitless',
				layout: 'topRight',
				type: 'alert',
				timeout: 2500
			});
			
			var Count_Ra_Txt=2;
			$("#ButAdd_Ra_Txt").click(function () {
				if(Count_Ra_Txt>=6){
					
					new PNotify({
						title: 'นักเรียนมีความสนใจหรือความสามารถด้านใด',
						text: 'อนุญาตเพียง 5 กล่องข้อความ',
						icon: 'icon-blocked',
						type: 'error'
					});

					return false;
				}else{
							
					var newTextBoxDiv = $(document.createElement('div'))
					   .attr("id", 'BoxRaTxt' + Count_Ra_Txt);
                
						newTextBoxDiv.after().html('<div class="row">'+
														'<div class="col-<?php echo $grid;?>-12">'+
														'<fieldset class="content-group">'+
															'<div class="form-group">'+
																'<label class="control-label col-<?php echo $grid;?>-5">ความสนใจหรือกิจกรรมที่ประสงค์อยากให้ทางโรงเรียนส่งเสริมหรือจัดกิจกรรม</label>'+
															'<div class="col-<?php echo $grid;?>-7">'+
																'<input type="text" name="ra_txt[]" id="ra_txt" required="required" class="form-control" maxlength="100"  placeholder="ระบุความสนใจหรือกิจกรรมที่ประสงค์อยากให้โรงเรียนส่งเสริมหรือจัดกิจกรรมตามความสนใจของนักเรียน">'+
															'</div>'+
															'</div>'+
														'</fieldset>'+
														'</div>'+
												   '</div>');
						newTextBoxDiv.appendTo("#GroupRaTxt");					
				}   
				Count_Ra_Txt++;
			    return true;
			});
			
			$("#ButDele_Ra_Txt").click(function () {
				if(Count_Ra_Txt==1){
					
					new PNotify({
						title: 'นักเรียนมีความสนใจหรือความสามารถด้านใด',
						text: 'ไม่มีกล่องข้อความให้ลบอีกต่อไป',
						icon: 'icon-blocked',
						type: 'error'
					});					
					
					  return false;
				}else{
					Count_Ra_Txt--;    
					$("#BoxRaTxt" + Count_Ra_Txt).remove();		
					return true;
				}   
                    
     });
			
		});
	</script>
<!--****************************************************************************-->	



	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<div id="RunLoadTalent">
					<img class="img-thumbnail" src="Template/global_assets/images/Cube-1s-200px.gif" />
				</div>	
			</center>
		</div>
	</div>
<!--****************************************************************************-->	
<div id="RuningLoadTalent">
	<?php
		$Talent_Txt=filter_input(INPUT_POST,"Talent_Txt");
		$Talent_Date=filter_input(INPUT_POST,"Talent_Date");
		switch($Talent_Txt){
			case "ButTalentY": ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			  if($Talent_Date=="ON"){ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-info">
				
					<div class="row">
						<div class="col-<?php echo $grid;?>-12" style="border:2px solid Tomato;">
							<div class="text-semibold one">
								<p>
									<div><b>ส่วนที่ 1 <b>ความสามารถพิเศษ</div>
									<div><b>คำชี้แจง : <b>ส่วนนี้สำหรับนักเรียนที่เคยเข้าร่วมการแข่งขัน</div>								
								<p>
							</div>
						</div>
					</div><br>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-success">
								<div class="panel-heading">ด้านวิชาการ</div>
								<div class="panel-body">
<!--==============================================================-->								
									<div class="row">
										<div class="col-<?php echo $grid;?>-6">			
											<fieldset class="content-group">
												<div class="form-group">
													<label class="control-label col-<?php echo $grid;?>-3">รายการวิชาการ</label>
													<div class="col-<?php echo $grid;?>-9">
														<select class="MultiselectInfo" name="academic[]" multiple="multiple" >
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->															
												<?php
														$CallTalentAcademic=new ArrayTalentAcademic();
														foreach($CallTalentAcademic->PrintArrayTalentAcademic() as $modrc=>$TalentAcademicRow){ ?>
															<option value="<?php echo $TalentAcademicRow["academic_id"];?>"><?php echo $TalentAcademicRow["academic_txtTh"];?></option>
												<?php	} ?>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->																
														</select>														
													</div>												
												</div>
											</fieldset>
										</div>
										<div class="col-<?php echo $grid;?>-6">
											<fieldset class="content-group">
												<div class="form-group">
													<center>
														<button type="button" name="ButAdd_AT_Txt" id="ButAdd_AT_Txt" class="btn btn-info">เพิ่ม</button>
														<button type="button" name="ButDele_AT_Txt" id="ButDele_AT_Txt" class="btn btn-info">ลด</button>
													</center>								
												</div>
											</fieldset>						
										</div>									
									</div>
<!--==============================================================-->									
									<div class="row">
									<div id="GroupATTxt">
									<div id="BoxATTxt">
										<div class="col-<?php echo $grid;?>-12">
											<div class="row">
												<fieldset class="content-group">
													<div class="form-group">
														<label class="control-label col-<?php echo $grid;?>-3">เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล</label>
														<div class="col-<?php echo $grid;?>-9">
															<input type="text" name="AcademicTxt[]"  class="form-control" maxlength="100"  minlength="5" placeholder="เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล"  />
														</div>
													</div>
												</fieldset>													
											</div>
										</div>
									</div>
									</div>
									</div>
									<hr>
<!--==============================================================-->	
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">			
											<fieldset class="content-group">
												<div class="form-group">
													<label class="control-label col-<?php echo $grid;?>-3">ระดับผลงาน / รางวัลที่เคยได้รับ</label>
													<div class="col-<?php echo $grid;?>-9">
														<select class="MultiselectWarning" name="PortfolioAcademic[]" multiple="multiple" >
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->														
											<?php
													$LevelPortfolio=new ArrayLevelPortfolio();
													foreach($LevelPortfolio->PrintArrayLevelPortfolio() as $modrc=>$LevelPortfolioRow){ ?>
															<option value="<?php echo $LevelPortfolioRow["lp_id"];?>"><?php echo $LevelPortfolioRow["lp_txtTh"];?></option>
											<?php	} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
														</select>														
													</div>												
												</div>
											</fieldset>
										</div>
									</div>
<!--==============================================================-->								
								
								</div>
							</div>
						</div>	
					</div><br>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-success">
								<div class="panel-heading">ด้านกีฬา</div>
								<div class="panel-body">

<!--==============================================================-->								
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<fieldset class="content-group">
												<div class="form-group">
													<center>
														<button type="button" name="ButAdd_Sport_Txt" id="ButAdd_Sport_Txt" class="btn btn-info">เพิ่ม</button>
														<button type="button" name="ButDele_Sport_Txt" id="ButDele_Sport_Txt" class="btn btn-info">ลด</button>
													</center>								
												</div>
											</fieldset>						
										</div>									
									</div>
<!--==============================================================-->									
									<div class="row">
									<div id="GroupSportTxt">
									<div id="BoxSportTxt">
										<div class="col-<?php echo $grid;?>-12">
											<div class="row">
												<fieldset class="content-group">
													<div class="form-group">
														<label class="control-label col-<?php echo $grid;?>-3">เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล</label>
														<div class="col-<?php echo $grid;?>-9">
															<input type="text" name="SportTxt[]" id="SportTxt" class="form-control" maxlength="100" minlength="5"  placeholder="เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล"  />
														</div>
													</div>
												</fieldset>													
											</div>
										</div>
									</div>
									</div>
									</div>
									<hr>
<!--==============================================================-->	
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">			
											<fieldset class="content-group">
												<div class="form-group">
													<label class="control-label col-<?php echo $grid;?>-3">ระดับผลงาน / รางวัลที่เคยได้รับ</label>
													<div class="col-<?php echo $grid;?>-9">
														<select class="MultiselectWarning" name="PortfolioSport[]" multiple="multiple" >
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->														
											<?php
													$LevelPortfolio=new ArrayLevelPortfolio();
													foreach($LevelPortfolio->PrintArrayLevelPortfolio() as $modrc=>$LevelPortfolioRow){ ?>
															<option value="<?php echo $LevelPortfolioRow["lp_id"];?>"><?php echo $LevelPortfolioRow["lp_txtTh"];?></option>
											<?php	} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->													
														</select>
													</div>												
												</div>
											</fieldset>
										</div>
									</div>
<!--==============================================================-->								
								
								
								</div>
							</div>
						</div>	
					</div><br>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-success">
								<div class="panel-heading">ด้านดนตรี</div>
								<div class="panel-body">

<!--==============================================================-->								
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<fieldset class="content-group">
												<div class="form-group">
													<center>
														<button type="button" name="ButAdd_Music_Txt" id="ButAdd_Music_Txt" class="btn btn-info">เพิ่ม</button>
														<button type="button" name="ButDele_Music_Txt" id="ButDele_Music_Txt" class="btn btn-info">ลด</button>
													</center>								
												</div>
											</fieldset>						
										</div>									
									</div>
<!--==============================================================-->									
									<div class="row">
									<div id="GroupMusicTxt">
									<div id="BoxMusicTxt">
										<div class="col-<?php echo $grid;?>-12">
											<div class="row">
												<fieldset class="content-group">
													<div class="form-group">
														<label class="control-label col-<?php echo $grid;?>-3">เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล</label>
														<div class="col-<?php echo $grid;?>-9">
															<input type="text" name="MusicTxt[]" id="MusicTxt" class="form-control" maxlength="100" minlength="5"  placeholder="เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล"  />
														</div>
													</div>
												</fieldset>													
											</div>
										</div>
									</div>
									</div>
									</div>
									<hr>
<!--==============================================================-->	
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">			
											<fieldset class="content-group">
												<div class="form-group">
													<label class="control-label col-<?php echo $grid;?>-3">ระดับผลงาน / รางวัลที่เคยได้รับ</label>
													<div class="col-<?php echo $grid;?>-9">
														<select class="MultiselectWarning" name="PortfolioMusic[]" multiple="multiple" >
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->														
											<?php
													$LevelPortfolio=new ArrayLevelPortfolio();
													foreach($LevelPortfolio->PrintArrayLevelPortfolio() as $modrc=>$LevelPortfolioRow){ ?>
															<option value="<?php echo $LevelPortfolioRow["lp_id"];?>"><?php echo $LevelPortfolioRow["lp_txtTh"];?></option>
											<?php	} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->													
														</select>
													</div>												
												</div>
											</fieldset>
										</div>
									</div>
<!--==============================================================-->								
								
								
								</div>
							</div>
						</div>	
					</div><br>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-success">
								<div class="panel-heading">ด้านศิลปะและการแสดง</div>
								<div class="panel-body">

<!--==============================================================-->								
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<fieldset class="content-group">
												<div class="form-group">
													<center>
														<button type="button" name="ButAdd_AAP_Txt" id="ButAdd_AAP_Txt" class="btn btn-info">เพิ่ม</button>
														<button type="button" name="ButDele_AAP_Txt" id="ButDele_AAP_Txt" class="btn btn-info">ลด</button>
													</center>								
												</div>
											</fieldset>						
										</div>									
									</div>
<!--==============================================================-->									
									<div class="row">
									<div id="GroupAAPTxt">
									<div id="BoxAAPTxt">
										<div class="col-<?php echo $grid;?>-12">
											<div class="row">
												<fieldset class="content-group">
													<div class="form-group">
														<label class="control-label col-<?php echo $grid;?>-3">เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล</label>
														<div class="col-<?php echo $grid;?>-9">
															<input type="text" name="AAPTxt[]" id="AAPTxt" class="form-control" maxlength="100" minlength="5"  placeholder="เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล"  />
														</div>
													</div>
												</fieldset>													
											</div>
										</div>
									</div>
									</div>
									</div>
									<hr>
<!--==============================================================-->	
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">			
											<fieldset class="content-group">
												<div class="form-group">
													<label class="control-label col-<?php echo $grid;?>-3">ระดับผลงาน / รางวัลที่เคยได้รับ</label>
													<div class="col-<?php echo $grid;?>-9">
														<select class="MultiselectWarning" name="PortfolioAAP[]" multiple="multiple" >
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->														
											<?php
													$LevelPortfolio=new ArrayLevelPortfolio();
													foreach($LevelPortfolio->PrintArrayLevelPortfolio() as $modrc=>$LevelPortfolioRow){ ?>
															<option value="<?php echo $LevelPortfolioRow["lp_id"];?>"><?php echo $LevelPortfolioRow["lp_txtTh"];?></option>
											<?php	} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->													
														</select>
													</div>												
												</div>
											</fieldset>
										</div>
									</div>
<!--==============================================================-->								
								
								
								</div>
							</div>
						</div>	
					</div><br>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="panel panel-success">
								<div class="panel-heading">ด้านอื่นๆ</div>
								<div class="panel-body">

<!--==============================================================-->								
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">
											<fieldset class="content-group">
												<div class="form-group">
													<center>
														<button type="button" name="ButAdd_Other_Txt" id="ButAdd_Other_Txt" class="btn btn-info">เพิ่ม</button>
														<button type="button" name="ButDele_Other_Txt" id="ButDele_Other_Txt" class="btn btn-info">ลด</button>
													</center>								
												</div>
											</fieldset>						
										</div>									
									</div>
<!--==============================================================-->									
									<div class="row">
									<div id="GroupOtherTxt">
									<div id="BoxOtherTxt">
										<div class="col-<?php echo $grid;?>-12">
											<div class="row">
												<fieldset class="content-group">
													<div class="form-group">
														<label class="control-label col-<?php echo $grid;?>-3">เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล</label>
														<div class="col-<?php echo $grid;?>-9">
															<input type="text" name="OtherTxt[]" id="OtherTxt" class="form-control" maxlength="100" minlength="5"  placeholder="เคยเข้าร่วมกิจกรรมหรือแข่งขันได้รับรางวัล"  />
														</div>
													</div>
												</fieldset>													
											</div>
										</div>
									</div>
									</div>
									</div>
									<hr>
<!--==============================================================-->	
									<div class="row">
										<div class="col-<?php echo $grid;?>-12">			
											<fieldset class="content-group">
												<div class="form-group">
													<label class="control-label col-<?php echo $grid;?>-3">ระดับผลงาน / รางวัลที่เคยได้รับ</label>
													<div class="col-<?php echo $grid;?>-9">
														<select class="MultiselectWarning" name="PortfolioOther[]" multiple="multiple" >
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->														
											<?php
													$LevelPortfolio=new ArrayLevelPortfolio();
													foreach($LevelPortfolio->PrintArrayLevelPortfolio() as $modrc=>$LevelPortfolioRow){ ?>
															<option value="<?php echo $LevelPortfolioRow["lp_id"];?>"><?php echo $LevelPortfolioRow["lp_txtTh"];?></option>
											<?php	} ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->													
														</select>
													</div>												
												</div>
											</fieldset>
										</div>
									</div>
<!--==============================================================-->								
								
								
								</div>
							</div>
						</div>	
					</div><br>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

					<div class="row">
						<div class="col-<?php echo $grid;?>-12" style="border:2px solid Tomato;">
							<div class="text-semibold one">
								<p>
									<div><b>ส่วนที่ 2 <b>นักเรียนมีความสนใจหรือความสามารถด้านใด (โปรดระบุ)</div>
									<div><b>คำชี้แจง : <b>ขอความกรุณาผู้ปกครองระบุความสนใจหรือกิจกรรมที่ประสงค์อยากให้ทางโรงเรียนส่งเสริมหรือจัดกิจกรรมตามความสนใจของนักเรียน</div>								
								<p>
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<fieldset class="content-group">
								<div class="form-group">
									<center>
										<button type="button" name="ButAdd_Ra_Txt" id="ButAdd_Ra_Txt" class="btn btn-success">เพิ่ม</button>
										<button type="button" name="ButDele_Ra_Txt" id="ButDele_Ra_Txt" class="btn btn-success">ลด</button>										
									</center>								
								</div>
							</fieldset>						
						</div>
					</div>
					<div id="GroupRaTxt">
					<div id="BoxRaTxt">
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<fieldset class="content-group">
								<div class="form-group">
									<label class="control-label col-<?php echo $grid;?>-5">ความสนใจหรือกิจกรรมที่ประสงค์อยากให้ทางโรงเรียนส่งเสริมหรือจัดกิจกรรม</label>
									<div class="col-<?php echo $grid;?>-7">
										<input type="text" name="ra_txt[]" id="ra_txt" class="form-control" maxlength="100" required="required"  placeholder="ระบุความสนใจหรือกิจกรรมที่ประสงค์อยากให้โรงเรียนส่งเสริมหรือจัดกิจกรรมตามความสนใจของนักเรียน">
									</div>
								</div>
							</fieldset>	
						</div>
					</div>
					</div>
					</div>
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="alert alert-primary ">
								<div class="row">
									<div class="col-<?php echo $grid;?>-12">
										<center>
											<button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
											<button type="button" id="ClearData" class="btn btn-info">เคลียร์ข้อมูล</button>
										</center>
									</div>
								</div>
							</div>
					    </div>
					</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<input name="ButTalent"  type="hidden" value="ButTalentY">
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				
				</div>			
			</div>
		</div>		
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php }elseif($Talent_Date=="OFF"){ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-danger alert-styled-left">
					<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
					สิ้นสุดระยะเวลา สำรวจนักเรียนที่มีความสามารถพิเศษ พบข้อสงสัย กรุณาติดผ่ายงาน แนวแนะประถม / มัธยม ในเวลา 08.00 - 17.00 น. วันจันทร์ ถึง วันศุกร์
				</div>
			</div>
		</div>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php }else{ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-danger alert-styled-left">
					<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
					พบข้อผิดพลาดไม่สามารถใช้งานได้ พบข้อสงสัย กรุณาติดผ่ายงาน ห้อง ICT กรุณาติดต่อ 08.00 - 17.00 น. วันจันทร์ ถึง วันศุกร์
				</div>
			</div>
		</div>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php }?>		
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	break;
			case "ButTalentN": ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			  if($Talent_Date=="ON"){ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<div class="row content-group text-semibold">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-warning">
			
					<div class="row">
						<div class="col-<?php echo $grid;?>-12" style="border:2px solid Tomato;">
							<div class="text-semibold one">
								<p>
									<div><b>ส่วนที่ 2 <b>นักเรียนมีความสนใจหรือความสามารถด้านใด (โปรดระบุ)</div>
									<div><b>คำชี้แจง : <b>ขอความกรุณาผู้ปกครองระบุความสนใจหรือกิจกรรมที่ประสงค์อยากให้ทางโรงเรียนส่งเสริมหรือจัดกิจกรรมตามความสนใจของนักเรียน</div>								
								<p>
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<fieldset class="content-group">
								<div class="form-group">
									<center>
										<button type="button" name="ButAdd_Ra_Txt" id="ButAdd_Ra_Txt" class="btn btn-success">เพิ่ม</button>
										<button type="button" name="ButDele_Ra_Txt" id="ButDele_Ra_Txt" class="btn btn-success">ลด</button>
									</center>								
								</div>
							</fieldset>						
						</div>
					</div>
					<div id="GroupRaTxt">
					<div id="BoxRaTxt">
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<fieldset class="content-group">
								<div class="form-group">
									<label class="control-label col-<?php echo $grid;?>-5">ความสนใจหรือกิจกรรมที่ประสงค์อยากให้ทางโรงเรียนส่งเสริมหรือจัดกิจกรรม</label>
									<div class="col-<?php echo $grid;?>-7">
										<input type="text" name="ra_txt[]" id="ra_txt" class="form-control" required="required" maxlength="100" minlength="5"  placeholder="ระบุความสนใจหรือกิจกรรมที่ประสงค์อยากให้โรงเรียนส่งเสริมหรือจัดกิจกรรมตามความสนใจของนักเรียน">
									</div>
								</div>
							</fieldset>	
						</div>
					</div>
					</div>
					</div>
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<div class="alert alert-primary ">
								<div class="row">
									<div class="col-<?php echo $grid;?>-12">
										<center>
											<button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
											<button type="button" id="ClearData" class="btn btn-info">เคลียร์ข้อมูล</button>
										</center>
									</div>
								</div>
							</div>
					    </div>
					</div>
					
				</div>			
			</div>
		</div>		
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<input name="ButTalent"  type="hidden" value="ButTalentN">	
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php }elseif($Talent_Date=="OFF"){ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-danger alert-styled-left">
					<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
					สิ้นสุดระยะเวลา สำรวจนักเรียนที่มีความสามารถพิเศษ พบข้อสงสัย กรุณาติดผ่ายงาน แนวแนะประถม / มัธยม ในเวลา 08.00 - 17.00 น. วันจันทร์ ถึง วันศุกร์
				</div>
			</div>
		</div>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php }else{ ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-danger alert-styled-left">
					<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
					พบข้อผิดพลาดไม่สามารถใช้งานได้ พบข้อสงสัย กรุณาติดผ่ายงาน ห้อง ICT กรุณาติดต่อ 08.00 - 17.00 น. วันจันทร์ ถึง วันศุกร์
				</div>
			</div>
		</div>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php }?>		
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	break;
			default: ?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="alert alert-danger alert-styled-left">
					<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
					ไม่มีสิทธิ์ใช้งานในส่วนนี้
				</div>
			</div>
		</div>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php	} ?>
</div>



