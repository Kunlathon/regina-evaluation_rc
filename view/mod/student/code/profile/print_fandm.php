<?php
	include("../../../../database/pdo_conndatastu.php");
	include("../../../../database/class_pdodatastu.php");
	
	error_reporting(error_reporting() & ~E_NOTICE); 
?>
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
			$grid="<?php echo $grid;?>";
		}elseif($width_system<=992){
			$grid="md";
		}elseif($width_system<=768){
			$grid="sm";
		}else{
			$grid="xs";
		}
    ?>	
	
	<script>
		$(document).ready(function () {
		// Accessibility labels
			$('.pickadate-accessibility').pickadate({
				labelMonthNext: 'ไปที่เดือนถัดไป',
				labelMonthPrev: 'ไปที่เดือนก่อนหน้า',
				labelMonthSelect: 'เลือกเดือนจากรายการแบบเลื่อนลง',
				labelYearSelect: 'เลือกหนึ่งปีจากรายการแบบเลื่อนลง',
				selectMonths: true,
				selectYears: '200',
				//yearSuffix: year+543, 
				formatSubmit: 'dd-mm-yyyy',
				format:'dd-mm-yyyy',
				today:"วันนี้",
				clear:"ลบ",
				close:"ออก",
				monthsFull: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
                weekdaysShort: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤ', 'ศุกร์', 'เสาร์'],
			
			});
		})
	</script>


	<script>
		$(document).ready(function () {
			
			$('.select-size-<?php echo $grid;?>').select2({
			containerCssClass: 'select-<?php echo $grid;?>'
			});
			
		})
	</script>	
	
<!--ที่อยู่พ่อทำงาน-->
	<script>
		$(document).ready(function () {
			$("#father_addwordprovince").change(function () {
				var province=$("#father_addwordprovince").val();
				
				if(province!=""){
					$.post("view/mod/student/code/profile/f_word/fword_city.php",{
						txt_province:province
					},function(dataprovince){
						if(dataprovince!=""){
							$("#father_addwordamphur").html(dataprovince);
						}
					})
				}
				
			})
		})
	</script>
	<script>
		$(document).ready(function () {
			$("#father_addwordamphur").change(function () {
				var city=$("#father_addwordamphur").val();
				
				if(city!=""){
					$.post("view/mod/student/code/profile/f_word/fword_amphures.php",{
						txt_city:city
					},function(datacity){
						if(datacity!=""){
							$("#father_addwordtumbon").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	<script>
		$(document).ready(function () {
			$("#father_addwordtumbon").change(function () {
				var zip=$("#father_addwordtumbon").val();
				
				if(zip!=""){
					$.post("view/mod/student/code/profile/f_word/fword_zip.php",{
						txt_zip:zip
					},function(datacity){
						if(datacity!=""){
							$("#father_addwordzipcode").html(datacity);
						}
					})
				}
				
			})
		})
	</script>


<!--ที่อยู่พ่อ-->

	<script>
		$(document).ready(function () {
			$("#father_province").change(function () {
				var province=$("#father_province").val();
				
				if(province!=""){
					$.post("view/mod/student/code/profile/f_add/fadd_city.php",{
						txt_province:province
					},function(dataprovince){
						if(dataprovince!=""){
							$("#father_amphur").html(dataprovince);
						}
					})
				}
				
			})
		})
	</script>
	<script>
		$(document).ready(function () {
			$("#father_amphur").change(function () {
				var city=$("#father_amphur").val();
				
				if(city!=""){
					$.post("view/mod/student/code/profile/f_add/fadd_amphures.php",{
						txt_city:city
					},function(datacity){
						if(datacity!=""){
							$("#father_tumbon").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	<script>
		$(document).ready(function () {
			$("#father_tumbon").change(function () {
				var zip=$("#father_tumbon").val();
				
				if(zip!=""){
					$.post("view/mod/student/code/profile/f_add/fadd_zip.php",{
						txt_zip:zip
					},function(datacity){
						if(datacity!=""){
							$("#father_zipcode").html(datacity);
						}
					})
				}
				
			})
		})
	</script>

<!--ที่อยู่แม่ทำงาน-->
	<script>
		$(document).ready(function () {
			$("#mother_wordprovince").change(function () {
				var province=$("#mother_wordprovince").val();
				
				if(province!=""){
					$.post("view/mod/student/code/profile/m_word/mword_city.php",{
						txt_province:province
					},function(dataprovince){
						if(dataprovince!=""){
							$("#mother_wordamphur").html(dataprovince);
						}
					})
				}
				
			})
		})
	</script>
	<script>
		$(document).ready(function () {
			$("#mother_wordamphur").change(function () {
				var city=$("#mother_wordamphur").val();
				
				if(city!=""){
					$.post("view/mod/student/code/profile/m_word/mword_amphures.php",{
						txt_city:city
					},function(datacity){
						if(datacity!=""){
							$("#mother_wordtumbon").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	<script>
		$(document).ready(function () {
			$("#mother_wordtumbon").change(function () {
				var zip=$("#mother_wordtumbon").val();
				
				if(zip!=""){
					$.post("view/mod/student/code/profile/m_word/mword_zip.php",{
						txt_zip:zip
					},function(datacity){
						if(datacity!=""){
							$("#mother_wordzipcode").html(datacity);
						}
					})
				}
				
			})
		})
	</script>

<!--ที่อยู่แม่-->

	<script>
		$(document).ready(function () {
			$("#mother_province").change(function () {
				var province=$("#mother_province").val();
				
				if(province!=""){
					$.post("view/mod/student/code/profile/m_add/madd_city.php",{
						txt_province:province
					},function(dataprovince){
						if(dataprovince!=""){
							$("#mother_amphur").html(dataprovince);
						}
					})
				}
				
			})
		})
	</script>
	<script>
		$(document).ready(function () {
			$("#mother_amphur").change(function () {
				var city=$("#mother_amphur").val();
				
				if(city!=""){
					$.post("view/mod/student/code/profile/m_add/madd_amphures.php",{
						txt_city:city
					},function(datacity){
						if(datacity!=""){
							$("#mother_tumbon").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	<script>
		$(document).ready(function () {
			$("#mother_tumbon").change(function () {
				var zip=$("#mother_tumbon").val();
				
				if(zip!=""){
					$.post("view/mod/student/code/profile/m_add/madd_zip.php",{
						txt_zip:zip
					},function(datacity){
						if(datacity!=""){
							$("#mother_zipcode").html(datacity);
						}
					})
				}
				
			})
		})
	</script>	
	
	
	<script>
		$(document).ready(function () {
			$("#father_add").click(function () {
				
				var call_father_prefix=$("#father_prefix").val();
				var call_father_fname=$("#father_fname").val();
				var call_father_sname=$("#father_sname").val();
				var call_father_prefix_en=$("#father_prefix_en").val();
				var call_father_fname_en=$("#father_fname_en").val();
				var call_father_sname_en=$("#father_sname_en").val();
				var call_father_code=$("#father_code").val();
				var call_af_birthday=$("#af_birthday").val();
				var call_sf_blood=$("#sf_blood").val();
				var call_sf_nation=$("#sf_nation").val();
				var call_sf_sun=$("#sf_sun").val();
				var call_sf_IDReligion=$("#sf_IDReligion").val();
				var call_father_phone=$("#father_phone").val();
				var call_father_career=$("#father_career").val();
				var call_father_salary=$("#father_salary").val();
				var call_father_study=$("#father_study").val();
				var call_father_workplace=$("#father_workplace").val();
				var call_father_wp_pro=$("#father_wp_pro").val();
				var call_father_addwordhno=$("#father_addwordhno").val();
				var call_father_addwordmoo=$("#father_addwordmoo").val();
				var call_father_addwordsoi=$("#father_addwordsoi").val();
				var call_father_addwordroad=$("#father_addwordroad").val();
				var call_father_addwordprovince=$("#father_addwordprovince").val();
				var call_father_addwordamphur=$("#father_addwordamphur").val();
				var call_father_addwordtumbon=$("#father_addwordtumbon").val();
				var call_father_addwordzipcodecopy=$("#father_addwordzipcodecopy").val();
				var call_father_wp_tel=$("#father_wp_tel").val();
				var call_father_hno=$("#father_hno").val();
				var call_father_moo=$("#father_moo").val();
				var call_father_soi=$("#father_soi").val();
				var call_father_road=$("#father_road").val();
				var call_father_province=$("#father_province").val();
				var call_father_amphur=$("#father_amphur").val();
				var call_father_tumbon=$("#father_tumbon").val();
				var call_father_zipcode=$("#father_zipcodecopy").val();
				var call_stu_id_pfa=$("#stu_id_pfa").val();
				var call_enter_pfa=$("#enter_pfa").val();
				var call_myname=$("#myname").val();
				var call_group=$("#group").val();
				
				
				if(call_stu_id_pfa!="" && call_enter_pfa!=""){
					$.post("view/mod/student/code/profile/into_profile_modify.php",{
						
					father_prefix:call_father_prefix,
					father_fname:call_father_fname,
					father_sname:call_father_sname,
					father_prefix_en:call_father_prefix_en,
					father_fname_en:call_father_fname_en,
					father_sname_en:call_father_sname_en,
					father_code:call_father_code,
					af_birthday:call_af_birthday,
					sf_blood:call_sf_blood,
					sf_nation:call_sf_nation,
					sf_sun:call_sf_sun,
					sf_IDReligion:call_sf_IDReligion,
					father_phone:call_father_phone,
					father_career:call_father_career,
					father_salary:call_father_salary,
					father_study:call_father_study,
					father_workplace:call_father_workplace,
					father_wp_pro:call_father_wp_pro,
					father_addwordhno:call_father_addwordhno,
					father_addwordmoo:call_father_addwordmoo,
					father_addwordsoi:call_father_addwordsoi,
					father_addwordroad:call_father_addwordroad,
					father_addwordprovince:call_father_addwordprovince,
					father_addwordamphur:call_father_addwordamphur,
					father_addwordtumbon:call_father_addwordtumbon,
					father_addwordzipcode:call_father_addwordzipcodecopy,
					father_wp_tel:call_father_wp_tel,
					father_hno:call_father_hno,
					father_moo:call_father_moo,
					father_soi:call_father_soi,
					father_road:call_father_road,
					father_province:call_father_province,
					father_amphur:call_father_amphur,
					father_tumbon:call_father_tumbon,
					father_zipcode:call_father_zipcode,
					stu_id:call_stu_id_pfa,
					enter:call_enter_pfa,
					myname:call_myname,
					group:call_group
					
					},function(call_father_add){
						if(call_father_add!=""){
							$("#print_father_add").html(call_father_add);
						}
					})
				}
				
			})
		})
	</script>
	
	
	<script>
		$(document).ready(function () {
			$("#mother_modify").click(function () {
				
				var call_mother_prefix=$("#mother_prefix").val();
				var call_mother_fname=$("#mother_fname").val();
				var call_mother_sname=$("#mother_sname").val();
				var call_mother_prefix_en=$("#mother_prefix_en").val();
				var call_mother_fname_en=$("#mother_fname_en").val();
				var call_mother_sname_en=$("#mother_sname_en").val();
				var call_mother_code=$("#mother_code").val();
				var call_mother_birthday=$("#mother_birthday").val();
				var call_mother_blood=$("#mother_blood").val();
				var call_mother_nation=$("#mother_nation").val();
				var call_mother_sun=$("#mother_sun").val();
				var call_mother_IDReligion=$("#mother_IDReligion").val();
				var call_mother_phone=$("#mother_phone").val();
				var call_mother_career=$("#mother_career").val();
				var call_mother_salary=$("#mother_salary").val();
				var call_mother_study=$("#mother_study").val();
				var call_mother_workplace=$("#mother_workplace").val();
				var call_mother_wp_pro=$("#mother_wp_pro").val();
				var call_mother_wordhno=$("#mother_wordhno").val();
				var call_mother_wordmoo=$("#mother_wordmoo").val();
				var call_mother_wordsoi=$("#mother_wordsoi").val();
				var call_mother_wordroad=$("#mother_wordroad").val();
				var call_mother_wordprovince=$("#mother_wordprovince").val();
				var call_mother_wordamphur=$("#mother_wordamphur").val();
				var call_mother_wordtumbon=$("#mother_wordtumbon").val();
				var call_mother_wordzipcodecopy=$("#mother_wordzipcodecopy").val();
				var call_mother_wp_tel=$("#mother_wp_tel").val();
				var call_mother_hno=$("#mother_hno").val();
				var call_mother_moo=$("#mother_moo").val();
				var call_mother_soi=$("#mother_soi").val();
				var call_mother_road=$("#mother_road").val();
				var call_mother_province=$("#mother_province").val();
				var call_mother_amphur=$("#mother_amphur").val();
				var call_mother_tumbon=$("#mother_tumbon").val();
				var call_mother_zipcodecopy=$("#mother_zipcodecopy").val();
				var call_stu_id_mm=$("#stu_id_mm").val();
				var call_enter_mm=$("#enter_mm").val();
				var call_myname=$("#myname").val();
				var call_group=$("#group").val();
				
				
				
				if(call_stu_id_mm!="" && call_enter_mm!=""){
					$.post("view/mod/student/code/profile/into_profile_modify.php",{
						
					mother_prefix:call_mother_prefix,
					mother_fname:call_mother_fname,
					mother_sname:call_mother_sname,
					mother_prefix_en:call_mother_prefix_en,
					mother_fname_en:call_mother_fname_en,
					mother_sname_en:call_mother_sname_en,
					mother_code:call_mother_code,
					mother_birthday:call_mother_birthday,
					mother_blood:call_mother_blood,
					mother_nation:call_mother_nation,
					mother_sun:call_mother_sun,
					mother_IDReligion:call_mother_IDReligion,
					mother_phone:call_mother_phone,
					mother_career:call_mother_career,
					mother_salary:call_mother_salary,
					mother_study:call_mother_study,
					mother_workplace:call_mother_workplace,
					mother_wp_pro:call_mother_wp_pro,
					mother_wordhno:call_mother_wordhno,
					mother_wordmoo:call_mother_wordmoo,
					mother_wordsoi:call_mother_wordsoi,
					mother_wordroad:call_mother_wordroad,
					mother_wordprovince:call_mother_wordprovince,
					mother_wordamphur:call_mother_wordamphur,
					mother_wordtumbon:call_mother_wordtumbon,
					mother_wordzipcode:call_mother_wordzipcodecopy,
					mother_wp_tel:call_mother_wp_tel,
					mother_hno:call_mother_hno,
					mother_moo:call_mother_moo,
					mother_soi:call_mother_soi,
					mother_road:call_mother_road,
					mother_province:call_mother_province,
					mother_amphur:call_mother_amphur,
					mother_tumbon:call_mother_tumbon,
					mother_zipcode:call_mother_zipcodecopy,
					stu_id:call_stu_id_mm,
					enter:call_enter_mm,		
					myname:call_myname,
					group:call_group
					
					},function(call_mother_modify){
						if(call_mother_modify!=""){
							$("#print_mother_modify").html(call_mother_modify);
						}
					})
				}
				
			})
		})
	</script>
	
<?php
	$call_onclik=filter_input(INPUT_POST,'call_onclik');
	$user_login=filter_input(INPUT_POST,'user_login');
	
		if($call_onclik=="4"){ ?><!--บิดาถึงแก่กรรม-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php


	$stu_fatherSql="SELECT * FROM `stu_father` WHERE `stu_id`='{$user_login}'";
	$stu_father=new notrow_datastu($stu_fatherSql);
	foreach($stu_father->datastu_array as $rc_key=>$stu_fatherRow){}
	
	$stu_father_addwordSql="SELECT * FROM `stu_father_addword` WHERE `stu_id`='{$user_login}'";
	$stu_father_addword=new notrow_datastu($stu_father_addwordSql);
	foreach($stu_father_addword->datastu_array as $rc_key=>$stu_father_addwordRow){}
	
	
	$stu_father_addressSql="SELECT * FROM `stu_father_address` WHERE `stu_id`='{$user_login}';";
	$stu_father_address=new notrow_datastu($stu_father_addressSql);
	foreach($stu_father_address->datastu_array as $rc_key=>$stu_father_addressRow){}
	
?>



<form class="form-horizontal" name="father_add" method="post" action="view/mod/student/code/profile/profile_modify.php">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading" style="color: #000000"><h4>ข้อมูลบิดา</h4></div>
			<div class="panel-body">
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">คำนำหน้า</b></label>
								<div class="col-<?php echo $grid;?>-9">
							<select name="father_prefix" id="father_prefix" data-placeholder="คำนำหน้าภาษาไทย.." class="select-size-<?php echo $grid;?>">
								<option></option>
								<optgroup label="คำนำหน้า..">
					<?php
						$npthailSql="SELECT `IDPrefix`,`prefixname`,`prefix_SName` 
						             FROM `rc_prefix` 
									 WHERE `IDPrefix`!='1' and `IDPrefix`!='2' and `IDPrefix`!='4' and `IDPrefix`!='5' and `IDPrefix`!='7'and `IDPrefix`!='8'and `IDPrefix`!='9'";
						$npthail=new row_datastu($npthailSql);
						foreach($npthail->datastu_array as $rc_key=>$npthailRow){
							if($stu_fatherRow["father_prefix"]==$npthailRow["IDPrefix"]){
								$fp_selected="selected";
							}else{
								$fp_selected="";
							}

							?>
									<option value="<?php echo $npthailRow["IDPrefix"]?>" <?php echo $fp_selected;?>><?php echo $npthailRow["prefixname"]?></option>
									
				<?php	}?>					
			
								</optgroup>
							</select>
								</div>
							</div>
                        </fieldset>						
								
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ชื่อ </b></label>							
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" name="father_fname" id="father_fname" value="<?php echo $stu_fatherRow["father_fname"]?>" placeholder="ชื่อ (ภาษาไทย)" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">นามสกุล </b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="นามสกุล (ภาษาไทย)" size="100" name="father_sname"  id="father_sname" value="<?php echo $stu_fatherRow["father_sname"]?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>				
				
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<h4>หมายเหตุ บิดาถึงแก่กรรม</h4>
					</div>				
				</div>
					
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<center><button type="button" class="btn btn-info" id="father_add">บันทึกข้อมูล...บิดา</button></center>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
<input type="hidden" name="stu_id" id="stu_id_pfa" value="<?php echo $user_login;?>">
<input type="hidden" name="enter" id="enter_pfa" value="up_father">
<input type="hidden" name="myname" value="<?php echo $myname;?>" id="myname" >
<input type="hidden" name="group" value="S" id="group" >

</form>
<div id="print_father_add"></div>
<?php

	$stu_motherSql="SELECT * FROM `stu_mother` WHERE`stu_id`='{$user_login}';";
	$stu_mother=new notrow_datastu($stu_motherSql);
	foreach($stu_mother->datastu_array as $rc_key=>$stu_motherRow){}

	$stu_mother_addressSql="SELECT * FROM `stu_mother_address` WHERE `stu_id`='{$user_login}'";
	$stu_mother_address=new notrow_datastu($stu_mother_addressSql);
	foreach($stu_mother_address->datastu_array as $rc_key=>$stu_mother_addressRow){}	

	$stu_mother_addwordSql="SELECT * FROM `stu_mother_addword` WHERE `stu_id`='{$user_login}';";
	$stu_mother_addword=new notrow_datastu($stu_mother_addwordSql);
	foreach($stu_mother_addword->datastu_array as $rc_key=>$stu_mother_addwordRow){}
		
?>

<form class="form-horizontal" name="mother_modify" method="post" action="view/mod/student/code/profile/profile_modify.php">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading" style="color: #000000"><h4>ข้อมูลมารดา</h4></div>
			<div class="panel-body">
				
			
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">คำนำหน้า (ภาษาไทย)</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<select name="mother_prefix"  id="mother_prefix" data-placeholder="คำนำหน้าภาษาไทย.." class="select-size-<?php echo $grid;?>">
										<option></option>
										<optgroup label="คำนำหน้า..">
							<?php
								$npthailSql="SELECT `IDPrefix`,`prefixname`,`prefix_SName` 
											 FROM `rc_prefix` 
											 WHERE `IDPrefix`!='1' and `IDPrefix`!='2' and `IDPrefix`!='3' and `IDPrefix`!='7' and `IDPrefix`!='8'and `IDPrefix`!='9'";
								$npthail=new row_datastu($npthailSql);
								foreach($npthail->datastu_array as $rc_key=>$npthailRow){
										if($stu_motherRow["mother_prefix"]==$npthailRow["IDPrefix"]){
											$mp_selected="selected";
										}else{
											$mp_selected="";
										}
								?>
											<option value="<?php echo $npthailRow["IDPrefix"]?>" <?php echo $mp_selected;?>><?php echo $npthailRow["prefixname"]?></option>
											
						<?php	}?>					
					
										</optgroup>
									</select>								
								</div>
							</div>
                        </fieldset>						
							
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ชื่อ (ภาษาไทย)</b></label>							
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ชื่อ (ภาษาไทย)" size="100" name="mother_fname" id="mother_fname" value="<?php echo $stu_motherRow["mother_fname"];?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">นามสกุล (ภาษาไทย)</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="นามสกุล (ภาษาไทย)" size="100" name="mother_sname" id="mother_sname" value="<?php echo $stu_motherRow["mother_sname"];?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>				
		
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">คำนำหน้า (ภาษาอังกฤษ)</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<select name="mother_prefix_en" id="mother_prefix_en"  data-placeholder="คำนำหน้าภาษา (ภาษาอังกฤษ).." class="select-size-<?php echo $grid;?>">
										<option></option>
										<optgroup label="คำนำหน้าภาษา (ภาษาอังกฤษ)..">
													
							<?php
								$npenSql="SELECT `IDPrefix`,`prefixname`,`prefix_SName` 
											 FROM `rc_prefix` 
											 WHERE `IDPrefix`='8' or `IDPrefix`='9'";
								$npen=new row_datastu($npenSql);
								foreach($npen->datastu_array as $rc_key=>$npenRow){
										if($stu_motherRow["mother_prefix_en"]==$npenRow["IDPrefix"]){
											$mpe_selected="selected";
										}else{
											$mpe_selected="";
										}
									?>
											<option value="<?php echo $npenRow["IDPrefix"]?>"<?php echo $mpe_selected;?>><?php echo $npenRow["prefixname"]?></option>
											
						<?php	}?>												
					
										</optgroup>
									</select>

								</div>
							</div>
                        </fieldset>									
					</div>				
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ชื่อ (ภาษาอังกฤษ)</b></label>							
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ชื่อ  (ภาษาอังกฤษ)" size="100" name="mother_fname_en" id="mother_fname_en" value="<?php echo $stu_motherRow["mother_fname_en"];?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">นามสกุล (ภาษาอังกฤษ)</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="นามสกุล  (ภาษาอังกฤษ)" size="100" name="mother_sname_en" id="mother_sname_en" value="<?php echo $stu_motherRow["mother_sname_en"];?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>			
		
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5"><b style="color: #00008B">เลขประจำตัวชาชน </b> </label>							
								<div class="col-<?php echo $grid;?>-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="เลขประจำตัวชาชน" size="100" name="mother_code" id="mother_code" maxlength="13" value="<?php echo $stu_motherRow["mother_code"]?>" >
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-5">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">วัน/เดือน/ปี เกิด ค.ศ.</b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text" class="form-control pickadate-accessibility"  placeholder="คลิกเลือก วัน/เดือน/ปี เกิด" size="100" name="mother_birthday" id="mother_birthday" value="<?php echo $stu_motherRow["mother_birthday"]?>">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">กรุ๊ปเลือด </b></label>
								<div class="col-<?php echo $grid;?>-7">
								
										<select data-placeholder="กรุ๊ปเลือด..." class="select-size-<?php echo $grid;?>" name="mother_blood" id="mother_blood">
											<option></option>
						<?php
							if($stu_motherRow["mother_blood"]=="A"){ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A" selected="selected">กรุ๊ปเลือด A</option>
												<option value="B">กรุ๊ปเลือด B</option>
												<option value="O">กรุ๊ปเลือด O</option>
												<option value="AB">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}elseif($stu_motherRow["mother_blood"]=="B"){ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A">กรุ๊ปเลือด A</option>
												<option value="B" selected="selected">กรุ๊ปเลือด B</option>
												<option value="O">กรุ๊ปเลือด O</option>
												<option value="AB">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}elseif($stu_motherRow["mother_blood"]=="O"){ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A">กรุ๊ปเลือด A</option>
												<option value="B">กรุ๊ปเลือด B</option>
												<option value="O" selected="selected">กรุ๊ปเลือด O</option>
												<option value="AB">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}elseif($stu_motherRow["mother_blood"]=="AB"){ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A">กรุ๊ปเลือด A</option>
												<option value="B">กรุ๊ปเลือด B</option>
												<option value="O">กรุ๊ปเลือด O</option>
												<option value="AB" selected="selected">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}else{ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A">กรุ๊ปเลือด A</option>
												<option value="B">กรุ๊ปเลือด B</option>
												<option value="O">กรุ๊ปเลือด O</option>
												<option value="AB">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}   ?>
										</select>										
									
								</div>
							</div>
                        </fieldset>						
					</div>
									
				</div>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">เชื้อชาติ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="เชื้อชาติ..." class="select-size-<?php echo $grid;?>" name="mother_nation" id="mother_nation">
											<option></option>
											<optgroup label="เชื้อชาติ">
						<?php
								if($stu_motherRow["mother_nation"]=="188"){ ?>
												<option value="188" selected="selected">ไทย / Thailand</option>
						<?php	}else{ ?>
												<option value="188">ไทย / Thailand</option>
						<?php	}      ?>				
						
							<?php
								$stusun_stu="SELECT `id`,`country_name_th`,`country_name_en` FROM `db_country`where `id`!='188' order by convert ( `country_name_th` using tis620) asc";
								$stusun_sturs=new row_datastu($stusun_stu);
								foreach($stusun_sturs->datastu_array as $rc_key=>$stusun_sturow){ 
									if($stu_motherRow["mother_nation"]==$stusun_sturow["id"]){
										$mn_selected="selected";
									}else{
										$mn_selected="";
									}
								?>
											<option value="<?php echo $stusun_sturow["id"] ;?>" <?php echo $mn_selected;?>><?php echo $stusun_sturow["country_name_th"]." / ".$stusun_sturow["country_name_en"];?></option>
							<?php		 } ?>						
						
											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						

					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">สัญชาติ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="สัญชาติ..." class="select-size-<?php echo $grid;?>" name="mother_sun" id="mother_sun">
											<option></option>
											<optgroup label="สัญชาติ">

						<?php
								if($stu_motherRow["mother_sun"]=="188"){ ?>
												<option value="188" selected="selected">ไทย / Thailand</option>
						<?php	}else{ ?>
												<option value="188">ไทย / Thailand</option>
						<?php	}      ?>				
						
							<?php
								$stusun_stu="SELECT `id`,`country_name_th`,`country_name_en` FROM `db_country`where `id`!='188' order by convert ( `country_name_th` using tis620) asc";
								$stusun_sturs=new row_datastu($stusun_stu);
								foreach($stusun_sturs->datastu_array as $rc_key=>$stusun_sturow){ 
									if($stu_motherRow["mother_sun"]==$stusun_sturow["id"]){
										$stu_selected="selected";
									}else{
										$stu_selected="";
									}
								?>
											<option value="<?php echo $stusun_sturow["id"] ;?>" <?php echo $stu_selected;?>><?php echo $stusun_sturow["country_name_th"]." / ".$stusun_sturow["country_name_en"];?></option>
							<?php		 } ?>

											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						
									
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">ศาสนา</b></label>
								<div class="col-<?php echo $grid;?>-9">

										<select data-placeholder="ศาสนา..." class="select-size-<?php echo $grid;?>" name="mother_IDReligion" id="mother_IDReligion">
											<option></option>
											<optgroup label="ศาสนา">
							<?php
								$ReligionSql="SELECT `IDReligion`,`Religion` FROM `rc_religion`";
								$Religion=new row_datastu($ReligionSql);
								foreach($Religion->datastu_array as $rc_key=>$Religion_print){ 
								if($stu_motherRow["mother_IDReligion"]==$Religion_print["IDReligion"]){
									$m_Religion="selected";
								}else{
									$m_Religion="";
								}
								?>
											<option value="<?php echo $Religion_print["IDReligion"];?>" <?php echo $m_Religion;?>><?php echo $Religion_print["Religion"];?></option>
							<?php	} ?>					

											</optgroup>
										</select>
								
								</div>
							</div>
                        </fieldset>						
				
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5"><b style="color: #00008B">เบอร์โทรศัทพ์ </b></label>							
								<div class="col-<?php echo $grid;?>-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="เบอร์โทรศัทพ์" size="100" name="mother_phone" id="mother_phone" value="<?php echo $stu_motherRow["mother_phone"];?>" data-masked-input="9999999999" maxlength="10">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				

				
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">อาชีพ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="อาชีพ..." class="select-size-<?php echo $grid;?>" name="mother_career" id="mother_career">
											<option></option>
					<?php
						$data_careerSql="SELECT `dc_key`, `dc_txt` FROM `data_career` ORDER BY `data_career`.`dc_key` ASC";
						$data_career=new row_datastu($data_careerSql);
						foreach($data_career->datastu_array as $rc_key=>$data_careerRow){
								if($stu_motherRow["mother_career"]==$data_careerRow["dc_key"]){
									$mc_selected="selected";
								}else{
									$mc_selected="";
								}
							?>
												<option value="<?php echo $data_careerRow["dc_key"];?>"<?php echo $mc_selected;?>><?php echo $data_careerRow["dc_txt"];?></option>
					<?php	}   ?>
										</select>
								</div>
							</div>
                        </fieldset>						
									
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">ช่วงรายได้ / เดือน</b></label>
								<div class="col-<?php echo $grid;?>-8">
										<select data-placeholder="ช่วงรายได้..." class="select-size-<?php echo $grid;?>" name="mother_salary" id="mother_salary">
											<option></option>
					<?php
						$data_incomSql="SELECT `di_key`, `di_txt` FROM `data_incom` ORDER BY `data_incom`.`di_key` ASC";
						$data_incom=new row_datastu($data_incomSql);
						foreach($data_incom->datastu_array as $rc_key=>$data_incomRow){ 
							if($stu_motherRow["mother_salary"]==$data_incomRow["di_key"]){
								$salary_selected="selected";
							}else{
								$salary_selected="";
							}
						?>
												<option value="<?php echo $data_incomRow["di_key"];?>"<?php echo $salary_selected;?>><?php echo $data_incomRow["di_txt"];?></option>
					<?php	}   ?>
					
										</select>
								</div>
							</div>
                        </fieldset>						
					
					</div>
					<!--<div class="col-<?php //echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php //echo $grid;?>-4">รายได้/เดือน</label>							
								<div class="col-<?php //echo $grid;?>-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>-->
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">วุฒิการศึกษา</b></label>
								<div class="col-<?php echo $grid;?>-8">
										<select data-placeholder="วุฒิการศึกษา..." class="select-size-<?php echo $grid;?>" name="mother_study" id="mother_study">
											<option></option>
					<?php
						$data_studySql="SELECT `study_id`, `study_txt` FROM `data_study` ORDER BY `data_study`.`study_id` ASC";
						$data_study=new row_datastu($data_studySql);
						foreach($data_study->datastu_array as $rc_key=>$data_studyRow){
							if($stu_motherRow["mother_study"]==$data_studyRow["study_id"]){
								$ms_selected="selected";
							}else{
								$ms_selected="";
							}

							?>
												<option value="<?php echo $data_studyRow["study_id"];?>"<?php echo $ms_selected;?>><?php echo $data_studyRow["study_txt"];?></option>
					<?php	}   ?>	
										</select>
								</div>
							</div>
                        </fieldset>						
					
											
					</div>
				</div>

				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">สถานที่ทำงาน </b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="สถานที่ทำงาน" size="100" maxlength="100" name="mother_workplace" id="mother_workplace" value="<?php echo $stu_motherRow["mother_workplace"];?>">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">ตำแหน่ง</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ตำแหน่ง" size="100" maxlength="10" name="mother_wp_pro" id="mother_wp_pro" value="<?php echo $stu_motherRow["mother_wp_pro"];?>">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				
				<hr><p><h4><u><b style="color: #336600">ที่อยู่ที่ทำงาน</b></u></h4></p><hr>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">เลขที่ </b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="เลขที่" size="100" maxlength="20" name="mother_wordhno" id="mother_wordhno" value="<?php echo $stu_mother_addwordRow["mother_wordhno"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">หมู่ที </b>่</label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="หมู่ที่" size="100" maxlength="50" name="mother_wordmoo" id="mother_wordmoo" value="<?php echo $stu_mother_addwordRow["mother_wordmoo"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ซอย </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ซอย" size="100" maxlength="100" name="mother_wordsoi" id="mother_wordsoi" value="<?php echo $stu_mother_addwordRow["mother_wordsoi"];?>"> 
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ถนน </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ถนน" size="100" maxlength="100" name="mother_wordroad" id="mother_wordroad" value="<?php echo $stu_mother_addwordRow["mother_wordroad"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
				</div>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">จังหวัด</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="จังหวัด..." class="select-size-<?php echo $grid;?>" name="mother_wordprovince" id="mother_wordprovince">
											<option></option>
											<optgroup label="จังหวัด">
											
								<?php
									$data_provinces="SELECT `PROVINCE_ID`,`PROVINCE_NAME`,`PROVINCE_NAME_ENG` FROM `provinces` order by convert ( `PROVINCE_NAME` using tis620) asc";
									$txt_provinces=new row_datastu($data_provinces);
									foreach($txt_provinces->datastu_array as $rc_key=>$provincesRow){
										if($stu_mother_addwordRow["mother_wordprovince"]==$provincesRow["PROVINCE_ID"]){
											$mwp_selected="selected";
										}else{
											$mwp_selected="";
										}
										?>
									
												<option value="<?php echo $provincesRow["PROVINCE_ID"];?>" <?php echo $mwp_selected;?>><?php echo $provincesRow["PROVINCE_NAME"]." / ".$provincesRow["PROVINCE_NAME_ENG"];?></option>
								<?php	} ?>			 
											</optgroup>
										</select>	
								</div>
							</div>
                        </fieldset>						
									
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">อำเภอ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="อำเภอ..." class="select-size-<?php echo $grid;?>" name="mother_wordamphur" id="mother_wordamphur">
											<option></option>

											<optgroup label="อำเภอ">
											
							<?php
								$amphuresSql="SELECT `AMPHUR_ID`,`AMPHUR_NAME`,`AMPHUR_NAME_ENG` FROM `amphures` WHERE `PROVINCE_ID`='{$stu_mother_addwordRow["mother_wordprovince"]}'";
								$amphuresRs=new row_datastu($amphuresSql);
								foreach($amphuresRs->datastu_array as $rc_key=>$amphuresRow){ 
								if($stu_mother_addwordRow["mother_wordamphur"]==$amphuresRow["AMPHUR_ID"]){
									$sa_selected="selected";
								}else{
									$sa_selected="";
								}
								?>
												<option value="<?php echo $amphuresRow["AMPHUR_ID"];?>" <?php echo $sa_selected;?>><?php echo $amphuresRow["AMPHUR_NAME"]." / ".$amphuresRow["AMPHUR_NAME_ENG"];?></option>
						<?php	}   ?>				
											</optgroup>
										</select>									
								</div>
							</div>
                        </fieldset>						
					
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">ตำบล</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="ตำบล..." class="select-size-<?php echo $grid;?>" name="mother_wordtumbon" id="mother_wordtumbon">
											<option></option>
											<optgroup label="ตำบล">
								<?php
									$districtsSql="SELECT `DISTRICT_ID`,`DISTRICT_NAME`,`DISTRICT_NAME_ENG` FROM `districts` WHERE `AMPHUR_ID`='{$stu_mother_addwordRow["mother_wordamphur"]}';";
									$districts=new row_datastu($districtsSql);
									foreach($districts->datastu_array as $rc_key=>$districts_print){ 
										if($stu_mother_addwordRow["mother_wordtumbon"]==$districts_print["DISTRICT_ID"]){
											$stum_selected="selected";
										}else{
											$stum_selected="";
										}
									
									?>
											<option value="<?php echo $districts_print["DISTRICT_ID"];?>" <?php echo $stum_selected;?>><?php echo $districts_print["DISTRICT_NAME"]." / ".$districts_print["DISTRICT_NAME_ENG"];?></option>
							<?php	} ?>

											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						
					
					</div>

					
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">รหัสไปรษณีย์ </b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<div id="mother_wordzipcode"><input type="text" name="mother_wordzipcode" id="mother_wordzipcodecopy"  class="form-control" readonly="readonly" placeholder="รหัสไปรษณีย์" size="100" maxlength="6" value="<?php echo $stu_mother_addwordRow["mother_wordzipcode"];?>"></div>
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>				
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">เบอร์โทรศัทพ์ที่ทำงาน </b></label>							
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="เบอร์โทรศัทพ์ที่ทำงาน" size="100" name="mother_wp_tel" id="mother_wp_tel" value="<?php echo $stu_motherRow["mother_wp_tel"];?>" data-masked-input="999999999999999" maxlength="15">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>				
				<hr><p><h4><u><b style="color: #336600">ที่อยู่ มารดา</b></u></h4></p><hr>
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">บ้านเลขที่ </b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="บ้านเลขที่" size="100" maxlength="10" name="mother_hno" id="mother_hno" value="<?php echo $stu_mother_addressRow["mother_hno"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">หมู่ที่ </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="หมู่ที่" size="100" maxlength="20" name="mother_moo" id="mother_moo" value="<?php echo $stu_mother_addressRow["mother_moo"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ซอย </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="50" maxlength="100" name="mother_soi" id="mother_soi" value="<?php echo $stu_mother_addressRow["mother_soi"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ถนน </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ถนน" size="100" maxlength="100" name="mother_road" id="mother_road" value="<?php echo $stu_mother_addressRow["mother_road"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
				</div>

				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">จังหวัด</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="จังหวัด..." class="select-size-<?php echo $grid;?>" name="mother_province" id="mother_province">
											<option></option>
											<optgroup label="จังหวัด">
											
								<?php
									$data_provinces="SELECT `PROVINCE_ID`,`PROVINCE_NAME`,`PROVINCE_NAME_ENG` FROM `provinces` order by convert ( `PROVINCE_NAME` using tis620) asc";
									$txt_provinces=new row_datastu($data_provinces);
									foreach($txt_provinces->datastu_array as $rc_key=>$provincesRow){
										if($stu_mother_addressRow["mother_province"]==$provincesRow["PROVINCE_ID"]){
											$mp_selected="selected";
										}else{
											$mp_selected="";
										}
										?>
									
												<option value="<?php echo $provincesRow["PROVINCE_ID"];?>" <?php echo $mp_selected;?>><?php echo $provincesRow["PROVINCE_NAME"]." / ".$provincesRow["PROVINCE_NAME_ENG"];?></option>
								<?php	} ?>			 
											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						
					
					
										
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">อำเภอ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="อำเภอ..." class="select-size-<?php echo $grid;?>" name="mother_amphur" id="mother_amphur">
											<option></option>
											<optgroup label="อำเภอ">
											
							<?php
								$amphuresSql="SELECT `AMPHUR_ID`,`AMPHUR_NAME`,`AMPHUR_NAME_ENG` FROM `amphures` WHERE `PROVINCE_ID`='{$stu_mother_addressRow["mother_province"]}'";
								$amphuresRs=new row_datastu($amphuresSql);
								foreach($amphuresRs->datastu_array as $rc_key=>$amphuresRow){ 
								if($stu_mother_addressRow["mother_amphur"]==$amphuresRow["AMPHUR_ID"]){
									$ma_selected="selected";
								}else{
									$ma_selected="";
								}
								?>
												<option value="<?php echo $amphuresRow["AMPHUR_ID"];?>" <?php echo $ma_selected;?>><?php echo $amphuresRow["AMPHUR_NAME"]." / ".$amphuresRow["AMPHUR_NAME_ENG"];?></option>
						<?php	}   ?>				
											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						
					
					
														
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">ตำบล</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="ตำบล..." class="select-size-<?php echo $grid;?>" name="mother_tumbon" id="mother_tumbon">
											<option></option>
											<optgroup label="ตำบล">
								<?php
									$districtsSql="SELECT `DISTRICT_ID`,`DISTRICT_NAME`,`DISTRICT_NAME_ENG` FROM `districts` WHERE `AMPHUR_ID`='{$stu_mother_addressRow["mother_amphur"]}';";
									$districts=new row_datastu($districtsSql);
									foreach($districts->datastu_array as $rc_key=>$districts_print){ 
										if($stu_mother_addressRow["mother_tumbon"]==$districts_print["DISTRICT_ID"]){
											$mt_selected="selected";
										}else{
											$mt_selected="";
										}
									
									?>
											<option value="<?php echo $districts_print["DISTRICT_ID"];?>" <?php echo $mt_selected;?>><?php echo $districts_print["DISTRICT_NAME"]." / ".$districts_print["DISTRICT_NAME_ENG"];?></option>
							<?php	} ?>

											</optgroup>	
										</select>
								</div>
							</div>
                        </fieldset>						
					
														
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5"><b style="color: #00008B">รหัสไปรษณีย์ </b></label>
								<div class="col-<?php echo $grid;?>-7">
									<div class="input-group">
										<div id="mother_zipcode"><input type="text" name="mother_zipcode" id="mother_zipcodecopy" class="form-control" readonly="readonly" placeholder="รหัสไปรษณีย์" size="100" maxlength="6" value="<?php echo $stu_mother_addressRow["mother_zipcode"];?>"></div>
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					
				</div><hr>
				<!--<div class="row">
					<div class="col-<?php //echo $grid;?>-12">
						<center><button type="submit" class="btn btn-info">บันทึกข้อมูล...มารดา</button></center>
					</div>
				</div>-->
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<center><button type="button" class="btn btn-info" id="mother_modify">บันทึกข้อมูล...มารดา</button></center>
					</div>
				</div>
		</div>	
	</div>
	</div>
</div>
<input type="hidden" name="stu_id" value="<?php echo $user_login;?>" id="stu_id_mm">
<input type="hidden" name="enter" value="up_mother" id="enter_mm">
<input type="hidden" name="myname" value="<?php echo $myname;?>" id="myname" >
<input type="hidden" name="group" value="S" id="group" >
</form>
<div id="print_mother_modify"></div>				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	}elseif($call_onclik=="5"){ ?><!---->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php


	$stu_fatherSql="SELECT * FROM `stu_father` WHERE `stu_id`='{$user_login}'";
	$stu_father=new notrow_datastu($stu_fatherSql);
	foreach($stu_father->datastu_array as $rc_key=>$stu_fatherRow){}
	
	$stu_father_addwordSql="SELECT * FROM `stu_father_addword` WHERE `stu_id`='{$user_login}'";
	$stu_father_addword=new notrow_datastu($stu_father_addwordSql);
	foreach($stu_father_addword->datastu_array as $rc_key=>$stu_father_addwordRow){}
	
	
	$stu_father_addressSql="SELECT * FROM `stu_father_address` WHERE `stu_id`='{$user_login}';";
	$stu_father_address=new notrow_datastu($stu_father_addressSql);
	foreach($stu_father_address->datastu_array as $rc_key=>$stu_father_addressRow){}
	
?>



<form class="form-horizontal" name="father_add" method="post" action="view/mod/student/code/profile/profile_modify.php">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading" style="color: #000000"><h4>ข้อมูลบิดา</h4></div>
			<div class="panel-body">
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">คำนำหน้า</b></label>
								<div class="col-<?php echo $grid;?>-9">
							<select name="father_prefix" id="father_prefix" data-placeholder="คำนำหน้าภาษาไทย.." class="select-size-<?php echo $grid;?>">
								<option></option>
								<optgroup label="คำนำหน้า..">
					<?php
						$npthailSql="SELECT `IDPrefix`,`prefixname`,`prefix_SName` 
						             FROM `rc_prefix` 
									 WHERE `IDPrefix`!='1' and `IDPrefix`!='2' and `IDPrefix`!='4' and `IDPrefix`!='5' and `IDPrefix`!='7'and `IDPrefix`!='8'and `IDPrefix`!='9'";
						$npthail=new row_datastu($npthailSql);
						foreach($npthail->datastu_array as $rc_key=>$npthailRow){
							if($stu_fatherRow["father_prefix"]==$npthailRow["IDPrefix"]){
								$fp_selected="selected";
							}else{
								$fp_selected="";
							}

							?>
									<option value="<?php echo $npthailRow["IDPrefix"]?>" <?php echo $fp_selected;?>><?php echo $npthailRow["prefixname"]?></option>
									
				<?php	}?>					
			
								</optgroup>
							</select>
								</div>
							</div>
                        </fieldset>						
								
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ชื่อ </b></label>							
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" name="father_fname" id="father_fname" value="<?php echo $stu_fatherRow["father_fname"]?>" placeholder="ชื่อ (ภาษาไทย)" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">นามสกุล </b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="นามสกุล (ภาษาไทย)" size="100" name="father_sname"  id="father_sname" value="<?php echo $stu_fatherRow["father_sname"]?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>				
					
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">คำนำหน้า</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<select name="father_prefix_en" id="father_prefix_en"  data-placeholder="คำนำหน้า (ภาษาอังกฤษ)" class="select-size-<?php echo $grid;?>">
										<option></option>
										<optgroup label="คำนำหน้า (ภาษาไทย)">
													
							<?php
								$npenSql="SELECT `IDPrefix`,`prefixname`,`prefix_SName` 
											 FROM `rc_prefix` 
											 WHERE `IDPrefix`='7'";
								$npen=new row_datastu($npenSql);
								foreach($npen->datastu_array as $rc_key=>$npenRow){
									if($stu_fatherRow["father_prefix_en"]==$npenRow["IDPrefix"]){
										$fpe_selected="selected";
									}else{
										$fpe_selected="";
									}
									?>
											<option value="<?php echo $npenRow["IDPrefix"]?>"<?php echo $fpe_selected;?>><?php echo $npenRow["prefixname"]?></option>
											
						<?php	}?>												
					
										</optgroup>
									</select>
								</div>
							</div>
                        </fieldset>									
					</div>				
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ชื่อ (ภาษาอังกฤษ)</b></label>							
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ชื่อ  (ภาษาอังกฤษ)" size="100" name="father_fname_en" id="father_fname_en" value="<?php echo $stu_fatherRow["father_fname_en"];?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">นามสกุล (ภาษาอังกฤษ)</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="นามสกุล  (ภาษาอังกฤษ)" size="100" name="father_sname_en" id="father_sname_en" value="<?php echo $stu_fatherRow["father_sname_en"];?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5"><b style="color: #00008B">เลขประจำตัวชาชน </b></label>							
								<div class="col-<?php echo $grid;?>-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="เลขประจำตัวชาชน" size="100" name="father_code" id="father_code" value="<?php echo $stu_fatherRow["father_code"];?>" maxlength="13">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-5">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">วัน/เดือน/ปี เกิด ค.ศ. </b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text"  class="form-control pickadate-accessibility" placeholder="คลิกเลือก วัน/เดือน/ปี เกิด" size="100" name="af_birthday" id="af_birthday" value="<?php echo $stu_fatherRow["af_birthday"];?>">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">กรุ๊ปเลือด</b></label>
								<div class="col-<?php echo $grid;?>-8">
										<select data-placeholder="กรุ๊ปเลือด..." class="select-size-<?php echo $grid;?>" name="sf_blood" id="sf_blood">
											<option></option>
						<?php
							if($stu_fatherRow["sf_blood"]=="A"){ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A" selected="selected">กรุ๊ปเลือด A</option>
												<option value="B">กรุ๊ปเลือด B</option>
												<option value="O">กรุ๊ปเลือด O</option>
												<option value="AB">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}elseif($stu_fatherRow["sf_blood"]=="B"){ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A">กรุ๊ปเลือด A</option>
												<option value="B" selected="selected">กรุ๊ปเลือด B</option>
												<option value="O">กรุ๊ปเลือด O</option>
												<option value="AB">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}elseif($stu_fatherRow["sf_blood"]=="O"){ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A">กรุ๊ปเลือด A</option>
												<option value="B">กรุ๊ปเลือด B</option>
												<option value="O" selected="selected">กรุ๊ปเลือด O</option>
												<option value="AB">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}elseif($stu_fatherRow["sf_blood"]=="AB"){ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A">กรุ๊ปเลือด A</option>
												<option value="B">กรุ๊ปเลือด B</option>
												<option value="O">กรุ๊ปเลือด O</option>
												<option value="AB" selected="selected">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}else{ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A">กรุ๊ปเลือด A</option>
												<option value="B">กรุ๊ปเลือด B</option>
												<option value="O">กรุ๊ปเลือด O</option>
												<option value="AB">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}   ?>
										</select>
								</div>
							</div>
                        </fieldset>							
				
					</div>					
				</div>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">เชื้อชาติ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="เชื้อชาติ..." name="sf_nation" id="sf_nation" class="select-size-<?php echo $grid;?>">
											<option></option>
											<optgroup label="เชื้อชาติ">
						<?php
								if($stu_fatherRow["sf_nation"]=="188"){ ?>
												<option value="188" selected="selected">ไทย / Thailand</option>
						<?php	}else{ ?>
												<option value="188">ไทย / Thailand</option>
						<?php	}      ?>				
						
							<?php
								$stusun_stu="SELECT `id`,`country_name_th`,`country_name_en` FROM `db_country`where `id`!='188' order by convert ( `country_name_th` using tis620) asc";
								$stusun_sturs=new row_datastu($stusun_stu);
								foreach($stusun_sturs->datastu_array as $rc_key=>$stusun_sturow){ 
									if($stu_fatherRow["sf_nation"]==$stusun_sturow["id"]){
										$stu_selected="selected";
									}else{
										$stu_selected="";
									}
								?>
											<option value="<?php echo $stusun_sturow["id"] ;?>" <?php echo $stu_selected;?>><?php echo $stusun_sturow["country_name_th"]." / ".$stusun_sturow["country_name_en"];?></option>
							<?php		 } ?>						
						
											</optgroup>
										</select>

								</div>
							</div>
                        </fieldset>						
					
				
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">สัญชาติ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="สัญชาติ..." name="sf_sun" id="sf_sun" class="select-size-<?php echo $grid;?>">
											<option></option>
											<optgroup label="สัญชาติ">

						<?php
								if($stu_fatherRow["sf_sun"]=="188"){ ?>
												<option value="188" selected="selected">ไทย / Thailand</option>
						<?php	}else{ ?>
												<option value="188">ไทย / Thailand</option>
						<?php	}      ?>				
						
							<?php
								$stusun_stu="SELECT `id`,`country_name_th`,`country_name_en` FROM `db_country`where `id`!='188' order by convert ( `country_name_th` using tis620) asc";
								$stusun_sturs=new row_datastu($stusun_stu);
								foreach($stusun_sturs->datastu_array as $rc_key=>$stusun_sturow){ 
									if($stu_fatherRow["sf_sun"]==$stusun_sturow["id"]){
										$stu_selected="selected";
									}else{
										$stu_selected="";
									}
								?>
											<option value="<?php echo $stusun_sturow["id"] ;?>" <?php echo $stu_selected;?>><?php echo $stusun_sturow["country_name_th"]." / ".$stusun_sturow["country_name_en"];?></option>
							<?php		 } ?>

											</optgroup>	
										</select>

								</div>
							</div>
                        </fieldset>						
					
					
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">ศาสนา</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="ศาสนา..." name="sf_IDReligion" id="sf_IDReligion" class="select-size-<?php echo $grid;?>">
											<option></option>
											<optgroup label="ศาสนา">
							<?php
								$ReligionSql="SELECT `IDReligion`,`Religion` FROM `rc_religion`";
								$Religion=new row_datastu($ReligionSql);
								foreach($Religion->datastu_array as $rc_key=>$Religion_print){ 
								if($stu_fatherRow["sf_IDReligion"]==$Religion_print["IDReligion"]){
									$stu_Religion="selected";
								}else{
									$stu_Religion="";
								}
								?>
											<option value="<?php echo $Religion_print["IDReligion"];?>" <?php echo $stu_Religion;?>><?php echo $Religion_print["Religion"];?></option>
							<?php	} ?>					

											</optgroup>	
										</select>
								</div>
							</div>
                        </fieldset>						
								
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5"><b style="color: #00008B">เบอร์โทรศัทพ์ </b></label>							
								<div class="col-<?php echo $grid;?>-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="เบอร์โทรศัทพ์" size="100" name="father_phone" id="father_phone" data-masked-input="9999999999" maxlength="10" value="<?php echo $stu_fatherRow["father_phone"];?>">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				

				
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">อาชีพ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="อาชีพ..." class="select-size-<?php echo $grid;?>" name="father_career" id="father_career">
											<option></option>
											
					<?php
						$data_careerSql="SELECT `dc_key`, `dc_txt` FROM `data_career` ORDER BY `data_career`.`dc_key` ASC";
						$data_career=new row_datastu($data_careerSql);
						foreach($data_career->datastu_array as $rc_key=>$data_careerRow){
								if($stu_fatherRow["father_career"]==$data_careerRow["dc_key"]){
									$fc_selected="selected";
								}else{
									$fc_selected="";
								}
							?>
												<option value="<?php echo $data_careerRow["dc_key"];?>" <?php echo $fc_selected;?>><?php echo $data_careerRow["dc_txt"];?></option>
					<?php	}   ?>						

										</select>
								</div>
							</div>
                        </fieldset>						
									
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">ช่วงรายได้ / เดือน</b></label>
								<div class="col-<?php echo $grid;?>-8">
										<select data-placeholder="ช่วงรายได้..." class="select-size-<?php echo $grid;?>" name="father_salary" id="father_salary">
											<option></option>
											
					<?php
						$data_incomSql="SELECT `di_key`, `di_txt` FROM `data_incom` ORDER BY `data_incom`.`di_key` ASC";
						$data_incom=new row_datastu($data_incomSql);
						foreach($data_incom->datastu_array as $rc_key=>$data_incomRow){ 
							if($stu_fatherRow["father_salary"]==$data_incomRow["di_key"]){
								$fs_selected="selected";
							}else{
								$fs_selected="";
							}
						?>
												<option value="<?php echo $data_incomRow["di_key"];?>" <?php echo $fs_selected;?>><?php echo $data_incomRow["di_txt"];?></option>
					<?php	}   ?>							
											
										</select>
								</div>
							</div>
                        </fieldset>						
				
					</div>
					<!--<div class="col-<?php //echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php //echo $grid;?>-4">รายได้/เดือน</label>							
								<div class="col-<?php //echo $grid;?>-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>-->
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">วุฒิการศึกษา</b></label>
								<div class="col-<?php echo $grid;?>-8">
										<select data-placeholder="วุฒิการศึกษา..." class="select-size-<?php echo $grid;?>" name="father_study" id="father_study">
											<option></option>
											
					<?php
						$data_studySql="SELECT `study_id`, `study_txt` FROM `data_study` ORDER BY `data_study`.`study_id` ASC";
						$data_study=new row_datastu($data_studySql);
						foreach($data_study->datastu_array as $rc_key=>$data_studyRow){
							if($stu_fatherRow["father_study"]==$data_studyRow["study_id"]){
								$fstudy_selected="selected";
							}else{
								$fstudy_selected="";
							}
							?>
												<option value="<?php echo $data_studyRow["study_id"];?>" <?php echo $fstudy_selected;?>><?php echo $data_studyRow["study_txt"];?></option>
					<?php	}   ?>						

										</select>

								</div>
							</div>
                        </fieldset>						
									
					</div>
				</div>

				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">สถานที่ทำงาน </b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="สถานที่ทำงาน" size="100" maxlength="100" name="father_workplace" id="father_workplace" value="<?php echo $stu_fatherRow["father_workplace"];?>">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">ตำแหน่ง </b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ตำแหน่ง" size="100" maxlength="100" name="father_wp_pro" id="father_wp_pro" value="<?php echo $stu_fatherRow["father_wp_pro"];?>">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				<hr><p><h4><u><b style="color: #336600">ที่อยู่ที่ทำงาน</b></u></h4></p><hr>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">เลขที่ </b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="เลขที่" size="100" maxlength="100" name="father_addwordhno" id="father_addwordhno" value="<?php echo $stu_father_addwordRow["father_addwordhno"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">หมู่ที่ </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="หมู่ที่" size="100" maxlength="100" name="father_addwordmoo" id="father_addwordmoo" value="<?php echo $stu_father_addwordRow["father_addwordmoo"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ซอย </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ซอย" size="100" maxlength="100" name="father_addwordsoi" id="father_addwordsoi" value="<?php echo $stu_father_addwordRow["father_addwordsoi"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ถนน </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ถนน" size="100" maxlength="100" name="father_addwordroad" id="father_addwordroad" value="<?php echo $stu_father_addwordRow["father_addwordroad"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
				</div>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">จังหวัด</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="จังหวัด..." class="select-size-<?php echo $grid;?>" name="father_addwordprovince" id="father_addwordprovince">
											<option></option>
											<optgroup label="จังหวัด">
											
								<?php
									$data_provinces="SELECT `PROVINCE_ID`,`PROVINCE_NAME`,`PROVINCE_NAME_ENG` FROM `provinces` order by convert ( `PROVINCE_NAME` using tis620) asc";
									$txt_provinces=new row_datastu($data_provinces);
									foreach($txt_provinces->datastu_array as $rc_key=>$provincesRow){
										if($stu_father_addwordRow["father_addwordprovince"]==$provincesRow["PROVINCE_ID"]){
											$faw_selected="selected";
										}else{
											$faw_selected="";
										}
										?>
									
												<option value="<?php echo $provincesRow["PROVINCE_ID"];?>" <?php echo $faw_selected;?>><?php echo $provincesRow["PROVINCE_NAME"]." / ".$provincesRow["PROVINCE_NAME_ENG"];?></option>
								<?php	} ?>			 
											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						
							
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">อำเภอ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="อำเภอ..." class="select-size-<?php echo $grid;?>" name="father_addwordamphur" id="father_addwordamphur">
											<option></option>
											<optgroup label="อำเภอ">
											
							<?php
								$amphuresSql="SELECT `AMPHUR_ID`,`AMPHUR_NAME`,`AMPHUR_NAME_ENG` FROM `amphures` WHERE `PROVINCE_ID`='{$stu_father_addwordRow["father_addwordprovince"]}'";
								$amphuresRs=new row_datastu($amphuresSql);
								foreach($amphuresRs->datastu_array as $rc_key=>$amphuresRow){ 
								if($stu_father_addwordRow["father_addwordamphur"]==$amphuresRow["AMPHUR_ID"]){
									$fawd_selected="selected";
								}else{
									$fawd_selected="";
								}
								?>
												<option value="<?php echo $amphuresRow["AMPHUR_ID"];?>" <?php echo $fawd_selected;?>><?php echo $amphuresRow["AMPHUR_NAME"]." / ".$amphuresRow["AMPHUR_NAME_ENG"];?></option>
						<?php	}   ?>				
											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						
				
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">ตำบล</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="ตำบล..." class="select-size-<?php echo $grid;?>" name="father_addwordtumbon" id="father_addwordtumbon">
											<option></option>
											<optgroup label="ตำบล">
								<?php
									$districtsSql="SELECT `DISTRICT_ID`,`DISTRICT_NAME`,`DISTRICT_NAME_ENG` FROM `districts` WHERE `AMPHUR_ID`='{$stu_father_addwordRow["father_addwordamphur"]}';";
									$districts=new row_datastu($districtsSql);
									foreach($districts->datastu_array as $rc_key=>$districts_print){ 
										if($stu_father_addwordRow["father_addwordtumbon"]==$districts_print["DISTRICT_ID"]){
											$fawt_selected="selected";
										}else{
											$fawt_selected="";
										}
									
									?>
											<option value="<?php echo $districts_print["DISTRICT_ID"];?>" <?php echo $fawt_selected;?>><?php echo $districts_print["DISTRICT_NAME"]." / ".$districts_print["DISTRICT_NAME_ENG"];?></option>
							<?php	} ?>

											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						
						
					</div>

					
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">รหัสไปรษณีย์ </b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<div id="father_addwordzipcode"><input type="text" name="father_addwordzipcode" id="father_addwordzipcodecopy"  class="form-control" readonly="readonly" placeholder="รหัสไปรษณีย์" size="100" maxlength="6" value="<?php echo $stu_father_addwordRow["father_addwordzipcode"];?>"></div>
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>				
				
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">เบอร์โทรศัทพ์ที่ทำงาน </b></label>							
								<div class="col-<?php echo $grid;?>-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="เบอร์โทรศัทพ์ที่ทำงาน" size="100" name="father_wp_tel" id="father_wp_tel" value="<?php echo $stu_fatherRow["father_wp_tel"];?>" data-masked-input="999999999999999" maxlength="15">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>				
				<hr><p><h4><u><b style="color: #336600">ที่อยู่ บิดา</b></u></h4></p><hr>
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">บ้านเลขที่ </b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="บ้านเลขที่" size="100" maxlength="100" name="father_hno" id="father_hno" value="<?php echo $stu_father_addressRow["father_hno"];?>" maxlength="10">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">หมู่ที่ </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="หมู่ที่" size="100" maxlength="100" name="father_moo" id="father_moo" value="<?php echo $stu_father_addressRow["father_moo"];?>" maxlength="20">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ซอย </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ซอย" size="100" maxlength="100" name="father_soi" id="father_soi" value="<?php echo $stu_father_addressRow["father_soi"];?>" maxlength="50">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ถนน </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ถนน" size="100" maxlength="100" name="father_road" id="father_road" value="<?php echo $stu_father_addressRow["father_road"];?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
				</div>

				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">จังหวัด</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="จังหวัด..." class="select-size-<?php echo $grid;?>" name="father_province" id="father_province">
											<option></option>
											<optgroup label="จังหวัด">
											
								<?php
									$data_provinces="SELECT `PROVINCE_ID`,`PROVINCE_NAME`,`PROVINCE_NAME_ENG` FROM `provinces` order by convert ( `PROVINCE_NAME` using tis620) asc";
									$txt_provinces=new row_datastu($data_provinces);
									foreach($txt_provinces->datastu_array as $rc_key=>$provincesRow){
										if($stu_father_addressRow["father_province"]==$provincesRow["PROVINCE_ID"]){
											$fp_selected="selected";
										}else{
											$fp_selected="";
										}
										?>
									
												<option value="<?php echo $provincesRow["PROVINCE_ID"];?>" <?php echo $fp_selected;?>><?php echo $provincesRow["PROVINCE_NAME"]." / ".$provincesRow["PROVINCE_NAME_ENG"];?></option>
								<?php	} ?>			 
											</optgroup>
										</select>	
	
								</div>
							</div>
                        </fieldset>						
					
										
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">อำเภอ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="อำเภอ..." class="select-size-<?php echo $grid;?>" name="father_amphur" id="father_amphur">
											<option></option>
											<optgroup label="อำเภอ">
											
							<?php
								$amphuresSql="SELECT `AMPHUR_ID`,`AMPHUR_NAME`,`AMPHUR_NAME_ENG` FROM `amphures` WHERE `PROVINCE_ID`='{$stu_father_addressRow["father_province"]}'";
								$amphuresRs=new row_datastu($amphuresSql);
								foreach($amphuresRs->datastu_array as $rc_key=>$amphuresRow){ 
								if($stu_father_addressRow["father_amphur"]==$amphuresRow["AMPHUR_ID"]){
									$fa_selected="selected";
								}else{
									$fa_selected="";
								}
								?>
												<option value="<?php echo $amphuresRow["AMPHUR_ID"];?>" <?php echo $fa_selected;?>><?php echo $amphuresRow["AMPHUR_NAME"]." / ".$amphuresRow["AMPHUR_NAME_ENG"];?></option>
						<?php	}   ?>				
											</optgroup>
										</select>								
								</div>
							</div>
                        </fieldset>						
					
												
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">ตำบล</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="ตำบล..." class="select-size-<?php echo $grid;?>" name="father_tumbon" id="father_tumbon">
											<option></option>
											<optgroup label="ตำบล">
								<?php
									$districtsSql="SELECT `DISTRICT_ID`,`DISTRICT_NAME`,`DISTRICT_NAME_ENG` FROM `districts` WHERE `AMPHUR_ID`='{$stu_father_addressRow["father_amphur"]}';";
									$districts=new row_datastu($districtsSql);
									foreach($districts->datastu_array as $rc_key=>$districts_print){ 
										if($stu_father_addressRow["father_tumbon"]==$districts_print["DISTRICT_ID"]){
											$ft_selected="selected";
										}else{
											$ft_selected="";
										}
									
									?>
											<option value="<?php echo $districts_print["DISTRICT_ID"];?>" <?php echo $ft_selected;?>><?php echo $districts_print["DISTRICT_NAME"]." / ".$districts_print["DISTRICT_NAME_ENG"];?></option>
							<?php	} ?>

											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						
														
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5"><b style="color: #00008B">รหัสไปรษณีย์ </b></label>
								<div class="col-<?php echo $grid;?>-7">
									<div class="input-group">
										<div id="father_zipcode"><input type="text" name="father_zipcode" id="father_zipcodecopy" class="form-control" readonly="readonly" placeholder="รหัสไปรษณีย์" size="100" maxlength="6" value="<?php echo $stu_father_addressRow["father_zipcode"];?>"></div>
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					
				</div><hr>
			
				<!--<div class="row">
					<div class="col-<?php //echo $grid;?>-12">
						<center><button type="submit" class="btn btn-info">แก้ไข...บิดา</button></center>
					</div>
				</div>-->
				
				
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<center><button type="button" class="btn btn-info" id="father_add">บันทึกข้อมูล...บิดา</button></center>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
<input type="hidden" name="stu_id" id="stu_id_pfa" value="<?php echo $user_login;?>">
<input type="hidden" name="enter" id="enter_pfa" value="up_father">
<input type="hidden" name="myname" value="<?php echo $myname;?>" id="myname" >
<input type="hidden" name="group" value="S" id="group" >

</form>
<div id="print_father_add"></div>
<?php

	$stu_motherSql="SELECT * FROM `stu_mother` WHERE`stu_id`='{$user_login}';";
	$stu_mother=new notrow_datastu($stu_motherSql);
	foreach($stu_mother->datastu_array as $rc_key=>$stu_motherRow){}

	$stu_mother_addressSql="SELECT * FROM `stu_mother_address` WHERE `stu_id`='{$user_login}'";
	$stu_mother_address=new notrow_datastu($stu_mother_addressSql);
	foreach($stu_mother_address->datastu_array as $rc_key=>$stu_mother_addressRow){}	

	$stu_mother_addwordSql="SELECT * FROM `stu_mother_addword` WHERE `stu_id`='{$user_login}';";
	$stu_mother_addword=new notrow_datastu($stu_mother_addwordSql);
	foreach($stu_mother_addword->datastu_array as $rc_key=>$stu_mother_addwordRow){}
		
?>

<form class="form-horizontal" name="mother_modify" method="post" action="view/mod/student/code/profile/profile_modify.php">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading" style="color: #000000"><h4>ข้อมูลมารดา</h4></div>
			<div class="panel-body">
				
			
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">คำนำหน้า (ภาษาไทย)</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<select name="mother_prefix"  id="mother_prefix" data-placeholder="คำนำหน้าภาษาไทย.." class="select-size-<?php echo $grid;?>">
										<option></option>
										<optgroup label="คำนำหน้า..">
							<?php
								$npthailSql="SELECT `IDPrefix`,`prefixname`,`prefix_SName` 
											 FROM `rc_prefix` 
											 WHERE `IDPrefix`!='1' and `IDPrefix`!='2' and `IDPrefix`!='3' and `IDPrefix`!='7' and `IDPrefix`!='8'and `IDPrefix`!='9'";
								$npthail=new row_datastu($npthailSql);
								foreach($npthail->datastu_array as $rc_key=>$npthailRow){
										if($stu_motherRow["mother_prefix"]==$npthailRow["IDPrefix"]){
											$mp_selected="selected";
										}else{
											$mp_selected="";
										}
								?>
											<option value="<?php echo $npthailRow["IDPrefix"]?>" <?php echo $mp_selected;?>><?php echo $npthailRow["prefixname"]?></option>
											
						<?php	}?>					
					
										</optgroup>
									</select>								
								</div>
							</div>
                        </fieldset>						
							
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ชื่อ (ภาษาไทย)</b></label>							
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ชื่อ (ภาษาไทย)" size="100" name="mother_fname" id="mother_fname" value="<?php echo $stu_motherRow["mother_fname"];?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">นามสกุล (ภาษาไทย)</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="นามสกุล (ภาษาไทย)" size="100" name="mother_sname" id="mother_sname" value="<?php echo $stu_motherRow["mother_sname"];?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>				
		
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<h4>หมายเหตุ มารดาถึงแก่กรรม</h4>
					</div>				
				</div>		
		
	
				<!--<div class="row">
					<div class="col-<?php //echo $grid;?>-12">
						<center><button type="submit" class="btn btn-info">บันทึกข้อมูล...มารดา</button></center>
					</div>
				</div>-->
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<center><button type="button" class="btn btn-info" id="mother_modify">บันทึกข้อมูล...มารดา</button></center>
					</div>
				</div>
		</div>	
	</div>
	</div>
</div>
<input type="hidden" name="stu_id" value="<?php echo $user_login;?>" id="stu_id_mm">
<input type="hidden" name="enter" value="up_mother" id="enter_mm">
<input type="hidden" name="myname" value="<?php echo $myname;?>" id="myname" >
<input type="hidden" name="group" value="S" id="group" >
</form>
<div id="print_mother_modify"></div>				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php


	$stu_fatherSql="SELECT * FROM `stu_father` WHERE `stu_id`='{$user_login}'";
	$stu_father=new notrow_datastu($stu_fatherSql);
	foreach($stu_father->datastu_array as $rc_key=>$stu_fatherRow){}
	
	$stu_father_addwordSql="SELECT * FROM `stu_father_addword` WHERE `stu_id`='{$user_login}'";
	$stu_father_addword=new notrow_datastu($stu_father_addwordSql);
	foreach($stu_father_addword->datastu_array as $rc_key=>$stu_father_addwordRow){}
	
	
	$stu_father_addressSql="SELECT * FROM `stu_father_address` WHERE `stu_id`='{$user_login}';";
	$stu_father_address=new notrow_datastu($stu_father_addressSql);
	foreach($stu_father_address->datastu_array as $rc_key=>$stu_father_addressRow){}
	
?>



<form class="form-horizontal" name="father_add" method="post" action="view/mod/student/code/profile/profile_modify.php">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading" style="color: #000000"><h4>ข้อมูลบิดา</h4></div>
			<div class="panel-body">
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">คำนำหน้า</b></label>
								<div class="col-<?php echo $grid;?>-9">
							<select name="father_prefix" id="father_prefix" data-placeholder="คำนำหน้าภาษาไทย.." class="select-size-<?php echo $grid;?>">
								<option></option>
								<optgroup label="คำนำหน้า..">
					<?php
						$npthailSql="SELECT `IDPrefix`,`prefixname`,`prefix_SName` 
						             FROM `rc_prefix` 
									 WHERE `IDPrefix`!='1' and `IDPrefix`!='2' and `IDPrefix`!='4' and `IDPrefix`!='5' and `IDPrefix`!='7'and `IDPrefix`!='8'and `IDPrefix`!='9'";
						$npthail=new row_datastu($npthailSql);
						foreach($npthail->datastu_array as $rc_key=>$npthailRow){
							if($stu_fatherRow["father_prefix"]==$npthailRow["IDPrefix"]){
								$fp_selected="selected";
							}else{
								$fp_selected="";
							}

							?>
									<option value="<?php echo $npthailRow["IDPrefix"];?>" <?php echo $fp_selected;?>><?php echo $npthailRow["prefixname"];?></option>
									
				<?php	}?>					
			
								</optgroup>
							</select>
								</div>
							</div>
                        </fieldset>						
								
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ชื่อ </b></label>							
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" name="father_fname" id="father_fname" value="<?php echo $stu_fatherRow["father_fname"]?>" placeholder="ชื่อ (ภาษาไทย)" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">นามสกุล </b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="นามสกุล (ภาษาไทย)" size="100" name="father_sname"  id="father_sname" value="<?php echo $stu_fatherRow["father_sname"]?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>				
					
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">คำนำหน้า</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<select name="father_prefix_en" id="father_prefix_en"  data-placeholder="คำนำหน้า (ภาษาอังกฤษ)" class="select-size-<?php echo $grid;?>">
										<option></option>
										<optgroup label="คำนำหน้า (ภาษาไทย)">
													
							<?php
								$npenSql="SELECT `IDPrefix`,`prefixname`,`prefix_SName` 
											 FROM `rc_prefix` 
											 WHERE `IDPrefix`='7'";
								$npen=new row_datastu($npenSql);
								foreach($npen->datastu_array as $rc_key=>$npenRow){
									if($stu_fatherRow["father_prefix_en"]==$npenRow["IDPrefix"]){
										$fpe_selected="selected";
									}else{
										$fpe_selected="";
									}
									?>
											<option value="<?php echo $npenRow["IDPrefix"]?>"<?php echo $fpe_selected;?>><?php echo $npenRow["prefixname"]?></option>
											
						<?php	}?>												
					
										</optgroup>
									</select>
								</div>
							</div>
                        </fieldset>									
					</div>				
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ชื่อ (ภาษาอังกฤษ)</b></label>							
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ชื่อ  (ภาษาอังกฤษ)" size="100" name="father_fname_en" id="father_fname_en" value="<?php echo $stu_fatherRow["father_fname_en"];?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">นามสกุล (ภาษาอังกฤษ)</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="นามสกุล  (ภาษาอังกฤษ)" size="100" name="father_sname_en" id="father_sname_en" value="<?php echo $stu_fatherRow["father_sname_en"];?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5"><b style="color: #00008B">เลขประจำตัวชาชน </b></label>							
								<div class="col-<?php echo $grid;?>-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="เลขประจำตัวชาชน" size="100" name="father_code" id="father_code" value="<?php echo $stu_fatherRow["father_code"];?>" maxlength="13">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-5">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">วัน/เดือน/ปี เกิด ค.ศ. </b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text"  class="form-control pickadate-accessibility" placeholder="คลิกเลือก วัน/เดือน/ปี เกิด" size="100" name="af_birthday" id="af_birthday" value="<?php echo $stu_fatherRow["af_birthday"];?>">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">กรุ๊ปเลือด</b></label>
								<div class="col-<?php echo $grid;?>-8">
										<select data-placeholder="กรุ๊ปเลือด..." class="select-size-<?php echo $grid;?>" name="sf_blood" id="sf_blood">
											<option></option>
						<?php
							if($stu_fatherRow["sf_blood"]=="A"){ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A" selected="selected">กรุ๊ปเลือด A</option>
												<option value="B">กรุ๊ปเลือด B</option>
												<option value="O">กรุ๊ปเลือด O</option>
												<option value="AB">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}elseif($stu_fatherRow["sf_blood"]=="B"){ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A">กรุ๊ปเลือด A</option>
												<option value="B" selected="selected">กรุ๊ปเลือด B</option>
												<option value="O">กรุ๊ปเลือด O</option>
												<option value="AB">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}elseif($stu_fatherRow["sf_blood"]=="O"){ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A">กรุ๊ปเลือด A</option>
												<option value="B">กรุ๊ปเลือด B</option>
												<option value="O" selected="selected">กรุ๊ปเลือด O</option>
												<option value="AB">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}elseif($stu_fatherRow["sf_blood"]=="AB"){ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A">กรุ๊ปเลือด A</option>
												<option value="B">กรุ๊ปเลือด B</option>
												<option value="O">กรุ๊ปเลือด O</option>
												<option value="AB" selected="selected">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}else{ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A">กรุ๊ปเลือด A</option>
												<option value="B">กรุ๊ปเลือด B</option>
												<option value="O">กรุ๊ปเลือด O</option>
												<option value="AB">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}   ?>
										</select>
								</div>
							</div>
                        </fieldset>							
				
					</div>					
				</div>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">เชื้อชาติ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="เชื้อชาติ..." name="sf_nation" id="sf_nation" class="select-size-<?php echo $grid;?>">
											<option></option>
											<optgroup label="เชื้อชาติ">
						<?php
								if($stu_fatherRow["sf_nation"]=="188"){ ?>
												<option value="188" selected="selected">ไทย / Thailand</option>
						<?php	}else{ ?>
												<option value="188">ไทย / Thailand</option>
						<?php	}      ?>				
						
							<?php
								$stusun_stu="SELECT `id`,`country_name_th`,`country_name_en` FROM `db_country`where `id`!='188' order by convert ( `country_name_th` using tis620) asc";
								$stusun_sturs=new row_datastu($stusun_stu);
								foreach($stusun_sturs->datastu_array as $rc_key=>$stusun_sturow){ 
									if($stu_fatherRow["sf_nation"]==$stusun_sturow["id"]){
										$stu_selected="selected";
									}else{
										$stu_selected="";
									}
								?>
											<option value="<?php echo $stusun_sturow["id"] ;?>" <?php echo $stu_selected;?>><?php echo $stusun_sturow["country_name_th"]." / ".$stusun_sturow["country_name_en"];?></option>
							<?php		 } ?>						
						
											</optgroup>
										</select>

								</div>
							</div>
                        </fieldset>						
					
				
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">สัญชาติ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="สัญชาติ..." name="sf_sun" id="sf_sun" class="select-size-<?php echo $grid;?>">
											<option></option>
											<optgroup label="สัญชาติ">

						<?php
								if($stu_fatherRow["sf_sun"]=="188"){ ?>
												<option value="188" selected="selected">ไทย / Thailand</option>
						<?php	}else{ ?>
												<option value="188">ไทย / Thailand</option>
						<?php	}      ?>				
						
							<?php
								$stusun_stu="SELECT `id`,`country_name_th`,`country_name_en` FROM `db_country`where `id`!='188' order by convert ( `country_name_th` using tis620) asc";
								$stusun_sturs=new row_datastu($stusun_stu);
								foreach($stusun_sturs->datastu_array as $rc_key=>$stusun_sturow){ 
									if($stu_fatherRow["sf_sun"]==$stusun_sturow["id"]){
										$stu_selected="selected";
									}else{
										$stu_selected="";
									}
								?>
											<option value="<?php echo $stusun_sturow["id"] ;?>" <?php echo $stu_selected;?>><?php echo $stusun_sturow["country_name_th"]." / ".$stusun_sturow["country_name_en"];?></option>
							<?php		 } ?>

											</optgroup>	
										</select>

								</div>
							</div>
                        </fieldset>						
					
					
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">ศาสนา</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="ศาสนา..." name="sf_IDReligion" id="sf_IDReligion" class="select-size-<?php echo $grid;?>">
											<option></option>
											<optgroup label="ศาสนา">
							<?php
								$ReligionSql="SELECT `IDReligion`,`Religion` FROM `rc_religion`";
								$Religion=new row_datastu($ReligionSql);
								foreach($Religion->datastu_array as $rc_key=>$Religion_print){ 
								if($stu_fatherRow["sf_IDReligion"]==$Religion_print["IDReligion"]){
									$stu_Religion="selected";
								}else{
									$stu_Religion="";
								}
								?>
											<option value="<?php echo $Religion_print["IDReligion"];?>" <?php echo $stu_Religion;?>><?php echo $Religion_print["Religion"];?></option>
							<?php	} ?>					

											</optgroup>	
										</select>
								</div>
							</div>
                        </fieldset>						
								
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5"><b style="color: #00008B">เบอร์โทรศัทพ์ </b></label>							
								<div class="col-<?php echo $grid;?>-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="เบอร์โทรศัทพ์" size="100" name="father_phone" id="father_phone" data-masked-input="9999999999" maxlength="10" value="<?php echo $stu_fatherRow["father_phone"];?>">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				

				
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">อาชีพ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="อาชีพ..." class="select-size-<?php echo $grid;?>" name="father_career" id="father_career">
											<option></option>
											
					<?php
						$data_careerSql="SELECT `dc_key`, `dc_txt` FROM `data_career` ORDER BY `data_career`.`dc_key` ASC";
						$data_career=new row_datastu($data_careerSql);
						foreach($data_career->datastu_array as $rc_key=>$data_careerRow){
								if($stu_fatherRow["father_career"]==$data_careerRow["dc_key"]){
									$fc_selected="selected";
								}else{
									$fc_selected="";
								}
							?>
												<option value="<?php echo $data_careerRow["dc_key"];?>" <?php echo $fc_selected;?>><?php echo $data_careerRow["dc_txt"];?></option>
					<?php	}   ?>						

										</select>
								</div>
							</div>
                        </fieldset>						
									
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">ช่วงรายได้ / เดือน</b></label>
								<div class="col-<?php echo $grid;?>-8">
										<select data-placeholder="ช่วงรายได้..." class="select-size-<?php echo $grid;?>" name="father_salary" id="father_salary">
											<option></option>
											
					<?php
						$data_incomSql="SELECT `di_key`, `di_txt` FROM `data_incom` ORDER BY `data_incom`.`di_key` ASC";
						$data_incom=new row_datastu($data_incomSql);
						foreach($data_incom->datastu_array as $rc_key=>$data_incomRow){ 
							if($stu_fatherRow["father_salary"]==$data_incomRow["di_key"]){
								$fs_selected="selected";
							}else{
								$fs_selected="";
							}
						?>
												<option value="<?php echo $data_incomRow["di_key"];?>" <?php echo $fs_selected;?>><?php echo $data_incomRow["di_txt"];?></option>
					<?php	}   ?>							
											
										</select>
								</div>
							</div>
                        </fieldset>						
				
					</div>
					<!--<div class="col-<?php //echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php //echo $grid;?>-4">รายได้/เดือน</label>							
								<div class="col-<?php //echo $grid;?>-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>-->
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">วุฒิการศึกษา</b></label>
								<div class="col-<?php echo $grid;?>-8">
										<select data-placeholder="วุฒิการศึกษา..." class="select-size-<?php echo $grid;?>" name="father_study" id="father_study">
											<option></option>
											
					<?php
						$data_studySql="SELECT `study_id`, `study_txt` FROM `data_study` ORDER BY `data_study`.`study_id` ASC";
						$data_study=new row_datastu($data_studySql);
						foreach($data_study->datastu_array as $rc_key=>$data_studyRow){
							if($stu_fatherRow["father_study"]==$data_studyRow["study_id"]){
								$fstudy_selected="selected";
							}else{
								$fstudy_selected="";
							}
							?>
												<option value="<?php echo $data_studyRow["study_id"];?>" <?php echo $fstudy_selected;?>><?php echo $data_studyRow["study_txt"];?></option>
					<?php	}   ?>						

										</select>

								</div>
							</div>
                        </fieldset>						
									
					</div>
				</div>

				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">สถานที่ทำงาน </b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="สถานที่ทำงาน" size="100" maxlength="100" name="father_workplace" id="father_workplace" value="<?php echo $stu_fatherRow["father_workplace"];?>">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">ตำแหน่ง </b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ตำแหน่ง" size="100" maxlength="100" name="father_wp_pro" id="father_wp_pro" value="<?php echo $stu_fatherRow["father_wp_pro"];?>">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				<hr><p><h4><u><b style="color: #336600">ที่อยู่ที่ทำงาน</b></u></h4></p><hr>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">เลขที่ </b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="เลขที่" size="100" maxlength="100" name="father_addwordhno" id="father_addwordhno" value="<?php echo $stu_father_addwordRow["father_addwordhno"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">หมู่ที่ </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="หมู่ที่" size="100" maxlength="100" name="father_addwordmoo" id="father_addwordmoo" value="<?php echo $stu_father_addwordRow["father_addwordmoo"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ซอย </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ซอย" size="100" maxlength="100" name="father_addwordsoi" id="father_addwordsoi" value="<?php echo $stu_father_addwordRow["father_addwordsoi"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ถนน </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ถนน" size="100" maxlength="100" name="father_addwordroad" id="father_addwordroad" value="<?php echo $stu_father_addwordRow["father_addwordroad"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
				</div>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">จังหวัด</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="จังหวัด..." class="select-size-<?php echo $grid;?>" name="father_addwordprovince" id="father_addwordprovince">
											<option></option>
											<optgroup label="จังหวัด">
											
								<?php
									$data_provinces="SELECT `PROVINCE_ID`,`PROVINCE_NAME`,`PROVINCE_NAME_ENG` FROM `provinces` order by convert ( `PROVINCE_NAME` using tis620) asc";
									$txt_provinces=new row_datastu($data_provinces);
									foreach($txt_provinces->datastu_array as $rc_key=>$provincesRow){
										if($stu_father_addwordRow["father_addwordprovince"]==$provincesRow["PROVINCE_ID"]){
											$faw_selected="selected";
										}else{
											$faw_selected="";
										}
										?>
									
												<option value="<?php echo $provincesRow["PROVINCE_ID"];?>" <?php echo $faw_selected;?>><?php echo $provincesRow["PROVINCE_NAME"]." / ".$provincesRow["PROVINCE_NAME_ENG"];?></option>
								<?php	} ?>			 
											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						
							
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">อำเภอ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="อำเภอ..." class="select-size-<?php echo $grid;?>" name="father_addwordamphur" id="father_addwordamphur">
											<option></option>
											<optgroup label="อำเภอ">
											
							<?php
								$amphuresSql="SELECT `AMPHUR_ID`,`AMPHUR_NAME`,`AMPHUR_NAME_ENG` FROM `amphures` WHERE `PROVINCE_ID`='{$stu_father_addwordRow["father_addwordprovince"]}'";
								$amphuresRs=new row_datastu($amphuresSql);
								foreach($amphuresRs->datastu_array as $rc_key=>$amphuresRow){ 
								if($stu_father_addwordRow["father_addwordamphur"]==$amphuresRow["AMPHUR_ID"]){
									$fawd_selected="selected";
								}else{
									$fawd_selected="";
								}
								?>
												<option value="<?php echo $amphuresRow["AMPHUR_ID"];?>" <?php echo $fawd_selected;?>><?php echo $amphuresRow["AMPHUR_NAME"]." / ".$amphuresRow["AMPHUR_NAME_ENG"];?></option>
						<?php	}   ?>				
											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						
				
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">ตำบล</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="ตำบล..." class="select-size-<?php echo $grid;?>" name="father_addwordtumbon" id="father_addwordtumbon">
											<option></option>
											<optgroup label="ตำบล">
								<?php
									$districtsSql="SELECT `DISTRICT_ID`,`DISTRICT_NAME`,`DISTRICT_NAME_ENG` FROM `districts` WHERE `AMPHUR_ID`='{$stu_father_addwordRow["father_addwordamphur"]}';";
									$districts=new row_datastu($districtsSql);
									foreach($districts->datastu_array as $rc_key=>$districts_print){ 
										if($stu_father_addwordRow["father_addwordtumbon"]==$districts_print["DISTRICT_ID"]){
											$fawt_selected="selected";
										}else{
											$fawt_selected="";
										}
									
									?>
											<option value="<?php echo $districts_print["DISTRICT_ID"];?>" <?php echo $fawt_selected;?>><?php echo $districts_print["DISTRICT_NAME"]." / ".$districts_print["DISTRICT_NAME_ENG"];?></option>
							<?php	} ?>

											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						
						
					</div>

					
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">รหัสไปรษณีย์ </b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<div id="father_addwordzipcode"><input type="text" name="father_addwordzipcode" id="father_addwordzipcodecopy"  class="form-control" readonly="readonly" placeholder="รหัสไปรษณีย์" size="100" maxlength="6" value="<?php echo $stu_father_addwordRow["father_addwordzipcode"];?>"></div>
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>				
				
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">เบอร์โทรศัทพ์ที่ทำงาน </b></label>							
								<div class="col-<?php echo $grid;?>-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="เบอร์โทรศัทพ์ที่ทำงาน" size="100" name="father_wp_tel" id="father_wp_tel" value="<?php echo $stu_fatherRow["father_wp_tel"];?>" data-masked-input="999999999999999" maxlength="15">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>				
				<hr><p><h4><u><b style="color: #336600">ที่อยู่ บิดา</b></u></h4></p><hr>
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">บ้านเลขที่ </b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="บ้านเลขที่" size="100" maxlength="100" name="father_hno" id="father_hno" value="<?php echo $stu_father_addressRow["father_hno"];?>" maxlength="10">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">หมู่ที่ </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="หมู่ที่" size="100" maxlength="100" name="father_moo" id="father_moo" value="<?php echo $stu_father_addressRow["father_moo"];?>" maxlength="20">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ซอย </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ซอย" size="100" maxlength="100" name="father_soi" id="father_soi" value="<?php echo $stu_father_addressRow["father_soi"];?>" maxlength="50">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ถนน </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ถนน" size="100" maxlength="100" name="father_road" id="father_road" value="<?php echo $stu_father_addressRow["father_road"];?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
				</div>

				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">จังหวัด</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="จังหวัด..." class="select-size-<?php echo $grid;?>" name="father_province" id="father_province">
											<option></option>
											<optgroup label="จังหวัด">
											
								<?php
									$data_provinces="SELECT `PROVINCE_ID`,`PROVINCE_NAME`,`PROVINCE_NAME_ENG` FROM `provinces` order by convert ( `PROVINCE_NAME` using tis620) asc";
									$txt_provinces=new row_datastu($data_provinces);
									foreach($txt_provinces->datastu_array as $rc_key=>$provincesRow){
										if($stu_father_addressRow["father_province"]==$provincesRow["PROVINCE_ID"]){
											$fp_selected="selected";
										}else{
											$fp_selected="";
										}
										?>
									
												<option value="<?php echo $provincesRow["PROVINCE_ID"];?>" <?php echo $fp_selected;?>><?php echo $provincesRow["PROVINCE_NAME"]." / ".$provincesRow["PROVINCE_NAME_ENG"];?></option>
								<?php	} ?>			 
											</optgroup>
										</select>	
	
								</div>
							</div>
                        </fieldset>						
					
										
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">อำเภอ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="อำเภอ..." class="select-size-<?php echo $grid;?>" name="father_amphur" id="father_amphur">
											<option></option>
											<optgroup label="อำเภอ">
											
							<?php
								$amphuresSql="SELECT `AMPHUR_ID`,`AMPHUR_NAME`,`AMPHUR_NAME_ENG` FROM `amphures` WHERE `PROVINCE_ID`='{$stu_father_addressRow["father_province"]}'";
								$amphuresRs=new row_datastu($amphuresSql);
								foreach($amphuresRs->datastu_array as $rc_key=>$amphuresRow){ 
								if($stu_father_addressRow["father_amphur"]==$amphuresRow["AMPHUR_ID"]){
									$fa_selected="selected";
								}else{
									$fa_selected="";
								}
								?>
												<option value="<?php echo $amphuresRow["AMPHUR_ID"];?>" <?php echo $fa_selected;?>><?php echo $amphuresRow["AMPHUR_NAME"]." / ".$amphuresRow["AMPHUR_NAME_ENG"];?></option>
						<?php	}   ?>				
											</optgroup>
										</select>								
								</div>
							</div>
                        </fieldset>						
					
												
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">ตำบล</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="ตำบล..." class="select-size-<?php echo $grid;?>" name="father_tumbon" id="father_tumbon">
											<option></option>
											<optgroup label="ตำบล">
								<?php
									$districtsSql="SELECT `DISTRICT_ID`,`DISTRICT_NAME`,`DISTRICT_NAME_ENG` FROM `districts` WHERE `AMPHUR_ID`='{$stu_father_addressRow["father_amphur"]}';";
									$districts=new row_datastu($districtsSql);
									foreach($districts->datastu_array as $rc_key=>$districts_print){ 
										if($stu_father_addressRow["father_tumbon"]==$districts_print["DISTRICT_ID"]){
											$ft_selected="selected";
										}else{
											$ft_selected="";
										}
									
									?>
											<option value="<?php echo $districts_print["DISTRICT_ID"];?>" <?php echo $ft_selected;?>><?php echo $districts_print["DISTRICT_NAME"]." / ".$districts_print["DISTRICT_NAME_ENG"];?></option>
							<?php	} ?>

											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						
														
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5"><b style="color: #00008B">รหัสไปรษณีย์ </b></label>
								<div class="col-<?php echo $grid;?>-7">
									<div class="input-group">
										<div id="father_zipcode"><input type="text" name="father_zipcode" id="father_zipcodecopy" class="form-control" readonly="readonly" placeholder="รหัสไปรษณีย์" size="100" maxlength="6" value="<?php echo $stu_father_addressRow["father_zipcode"];?>"></div>
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					
				</div><hr>
			
				<!--<div class="row">
					<div class="col-<?php //echo $grid;?>-12">
						<center><button type="submit" class="btn btn-info">แก้ไข...บิดา</button></center>
					</div>
				</div>-->
				
				
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<center><button type="button" class="btn btn-info" id="father_add">บันทึกข้อมูล...บิดา</button></center>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
<input type="hidden" name="stu_id" id="stu_id_pfa" value="<?php echo $user_login;?>">
<input type="hidden" name="enter" id="enter_pfa" value="up_father">
<input type="hidden" name="myname" value="<?php echo $myname;?>" id="myname" >
<input type="hidden" name="group" value="S" id="group" >

</form>
<div id="print_father_add"></div>
<?php

	$stu_motherSql="SELECT * FROM `stu_mother` WHERE`stu_id`='{$user_login}';";
	$stu_mother=new notrow_datastu($stu_motherSql);
	foreach($stu_mother->datastu_array as $rc_key=>$stu_motherRow){}

	$stu_mother_addressSql="SELECT * FROM `stu_mother_address` WHERE `stu_id`='{$user_login}'";
	$stu_mother_address=new notrow_datastu($stu_mother_addressSql);
	foreach($stu_mother_address->datastu_array as $rc_key=>$stu_mother_addressRow){}	

	$stu_mother_addwordSql="SELECT * FROM `stu_mother_addword` WHERE `stu_id`='{$user_login}';";
	$stu_mother_addword=new notrow_datastu($stu_mother_addwordSql);
	foreach($stu_mother_addword->datastu_array as $rc_key=>$stu_mother_addwordRow){}
		
?>

<form class="form-horizontal" name="mother_modify" method="post" action="view/mod/student/code/profile/profile_modify.php">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading" style="color: #000000"><h4>ข้อมูลมารดา</h4></div>
			<div class="panel-body">
				
			
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">คำนำหน้า (ภาษาไทย)</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<select name="mother_prefix"  id="mother_prefix" data-placeholder="คำนำหน้าภาษาไทย.." class="select-size-<?php echo $grid;?>">
										<option></option>
										<optgroup label="คำนำหน้า..">
							<?php
								$npthailSql="SELECT `IDPrefix`,`prefixname`,`prefix_SName` 
											 FROM `rc_prefix` 
											 WHERE `IDPrefix`!='1' and `IDPrefix`!='2' and `IDPrefix`!='3' and `IDPrefix`!='7' and `IDPrefix`!='8'and `IDPrefix`!='9'";
								$npthail=new row_datastu($npthailSql);
								foreach($npthail->datastu_array as $rc_key=>$npthailRow){
										if($stu_motherRow["mother_prefix"]==$npthailRow["IDPrefix"]){
											$mp_selected="selected";
										}else{
											$mp_selected="";
										}
								?>
											<option value="<?php echo $npthailRow["IDPrefix"]?>" <?php echo $mp_selected;?>><?php echo $npthailRow["prefixname"]?></option>
											
						<?php	}?>					
					
										</optgroup>
									</select>								
								</div>
							</div>
                        </fieldset>						
							
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ชื่อ (ภาษาไทย)</b></label>							
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ชื่อ (ภาษาไทย)" size="100" name="mother_fname" id="mother_fname" value="<?php echo $stu_motherRow["mother_fname"];?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">นามสกุล (ภาษาไทย)</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="นามสกุล (ภาษาไทย)" size="100" name="mother_sname" id="mother_sname" value="<?php echo $stu_motherRow["mother_sname"];?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>				
		
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">คำนำหน้า (ภาษาอังกฤษ)</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<select name="mother_prefix_en" id="mother_prefix_en"  data-placeholder="คำนำหน้าภาษา (ภาษาอังกฤษ).." class="select-size-<?php echo $grid;?>">
										<option></option>
										<optgroup label="คำนำหน้าภาษา (ภาษาอังกฤษ)..">
													
							<?php
								$npenSql="SELECT `IDPrefix`,`prefixname`,`prefix_SName` 
											 FROM `rc_prefix` 
											 WHERE `IDPrefix`='8' or `IDPrefix`='9'";
								$npen=new row_datastu($npenSql);
								foreach($npen->datastu_array as $rc_key=>$npenRow){
										if($stu_motherRow["mother_prefix_en"]==$npenRow["IDPrefix"]){
											$mpe_selected="selected";
										}else{
											$mpe_selected="";
										}
									?>
											<option value="<?php echo $npenRow["IDPrefix"]?>"<?php echo $mpe_selected;?>><?php echo $npenRow["prefixname"]?></option>
											
						<?php	}?>												
					
										</optgroup>
									</select>

								</div>
							</div>
                        </fieldset>									
					</div>				
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ชื่อ (ภาษาอังกฤษ)</b></label>							
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ชื่อ  (ภาษาอังกฤษ)" size="100" name="mother_fname_en" id="mother_fname_en" value="<?php echo $stu_motherRow["mother_fname_en"];?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">นามสกุล (ภาษาอังกฤษ)</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="นามสกุล  (ภาษาอังกฤษ)" size="100" name="mother_sname_en" id="mother_sname_en" value="<?php echo $stu_motherRow["mother_sname_en"];?>" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>			
		
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5"><b style="color: #00008B">เลขประจำตัวชาชน </b> </label>							
								<div class="col-<?php echo $grid;?>-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="เลขประจำตัวชาชน" size="100" name="mother_code" id="mother_code" maxlength="13" value="<?php echo $stu_motherRow["mother_code"]?>" >
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-5">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">วัน/เดือน/ปี เกิด ค.ศ.</b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text" class="form-control pickadate-accessibility"  placeholder="คลิกเลือก วัน/เดือน/ปี เกิด" size="100" name="mother_birthday" id="mother_birthday" value="<?php echo $stu_motherRow["mother_birthday"]?>">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">กรุ๊ปเลือด </b></label>
								<div class="col-<?php echo $grid;?>-7">
								
										<select data-placeholder="กรุ๊ปเลือด..." class="select-size-<?php echo $grid;?>" name="mother_blood" id="mother_blood">
											<option></option>
						<?php
							if($stu_motherRow["mother_blood"]=="A"){ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A" selected="selected">กรุ๊ปเลือด A</option>
												<option value="B">กรุ๊ปเลือด B</option>
												<option value="O">กรุ๊ปเลือด O</option>
												<option value="AB">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}elseif($stu_motherRow["mother_blood"]=="B"){ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A">กรุ๊ปเลือด A</option>
												<option value="B" selected="selected">กรุ๊ปเลือด B</option>
												<option value="O">กรุ๊ปเลือด O</option>
												<option value="AB">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}elseif($stu_motherRow["mother_blood"]=="O"){ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A">กรุ๊ปเลือด A</option>
												<option value="B">กรุ๊ปเลือด B</option>
												<option value="O" selected="selected">กรุ๊ปเลือด O</option>
												<option value="AB">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}elseif($stu_motherRow["mother_blood"]=="AB"){ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A">กรุ๊ปเลือด A</option>
												<option value="B">กรุ๊ปเลือด B</option>
												<option value="O">กรุ๊ปเลือด O</option>
												<option value="AB" selected="selected">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}else{ ?>
											<option></option>
											<optgroup label="กรุ๊ปเลือด">
												<option value="A">กรุ๊ปเลือด A</option>
												<option value="B">กรุ๊ปเลือด B</option>
												<option value="O">กรุ๊ปเลือด O</option>
												<option value="AB">กรุ๊ปเลือด AB</option>
											</optgroup>								
					<?php		}   ?>
										</select>										
									
								</div>
							</div>
                        </fieldset>						
					</div>
									
				</div>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">เชื้อชาติ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="เชื้อชาติ..." class="select-size-<?php echo $grid;?>" name="mother_nation" id="mother_nation">
											<option></option>
											<optgroup label="เชื้อชาติ">
						<?php
								if($stu_motherRow["mother_nation"]=="188"){ ?>
												<option value="188" selected="selected">ไทย / Thailand</option>
						<?php	}else{ ?>
												<option value="188">ไทย / Thailand</option>
						<?php	}      ?>				
						
							<?php
								$stusun_stu="SELECT `id`,`country_name_th`,`country_name_en` FROM `db_country`where `id`!='188' order by convert ( `country_name_th` using tis620) asc";
								$stusun_sturs=new row_datastu($stusun_stu);
								foreach($stusun_sturs->datastu_array as $rc_key=>$stusun_sturow){ 
									if($stu_motherRow["mother_nation"]==$stusun_sturow["id"]){
										$mn_selected="selected";
									}else{
										$mn_selected="";
									}
								?>
											<option value="<?php echo $stusun_sturow["id"] ;?>" <?php echo $mn_selected;?>><?php echo $stusun_sturow["country_name_th"]." / ".$stusun_sturow["country_name_en"];?></option>
							<?php		 } ?>						
						
											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						

					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">สัญชาติ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="สัญชาติ..." class="select-size-<?php echo $grid;?>" name="mother_sun" id="mother_sun">
											<option></option>
											<optgroup label="สัญชาติ">

						<?php
								if($stu_motherRow["mother_sun"]=="188"){ ?>
												<option value="188" selected="selected">ไทย / Thailand</option>
						<?php	}else{ ?>
												<option value="188">ไทย / Thailand</option>
						<?php	}      ?>				
						
							<?php
								$stusun_stu="SELECT `id`,`country_name_th`,`country_name_en` FROM `db_country`where `id`!='188' order by convert ( `country_name_th` using tis620) asc";
								$stusun_sturs=new row_datastu($stusun_stu);
								foreach($stusun_sturs->datastu_array as $rc_key=>$stusun_sturow){ 
									if($stu_motherRow["mother_sun"]==$stusun_sturow["id"]){
										$stu_selected="selected";
									}else{
										$stu_selected="";
									}
								?>
											<option value="<?php echo $stusun_sturow["id"] ;?>" <?php echo $stu_selected;?>><?php echo $stusun_sturow["country_name_th"]." / ".$stusun_sturow["country_name_en"];?></option>
							<?php		 } ?>

											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						
									
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">ศาสนา</b></label>
								<div class="col-<?php echo $grid;?>-9">

										<select data-placeholder="ศาสนา..." class="select-size-<?php echo $grid;?>" name="mother_IDReligion" id="mother_IDReligion">
											<option></option>
											<optgroup label="ศาสนา">
							<?php
								$ReligionSql="SELECT `IDReligion`,`Religion` FROM `rc_religion`";
								$Religion=new row_datastu($ReligionSql);
								foreach($Religion->datastu_array as $rc_key=>$Religion_print){ 
								if($stu_motherRow["mother_IDReligion"]==$Religion_print["IDReligion"]){
									$m_Religion="selected";
								}else{
									$m_Religion="";
								}
								?>
											<option value="<?php echo $Religion_print["IDReligion"];?>" <?php echo $m_Religion;?>><?php echo $Religion_print["Religion"];?></option>
							<?php	} ?>					

											</optgroup>
										</select>
								
								</div>
							</div>
                        </fieldset>						
				
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5"><b style="color: #00008B">เบอร์โทรศัทพ์ </b></label>							
								<div class="col-<?php echo $grid;?>-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="เบอร์โทรศัทพ์" size="100" name="mother_phone" id="mother_phone" value="<?php echo $stu_motherRow["mother_phone"];?>" data-masked-input="9999999999" maxlength="10">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				

				
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">อาชีพ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="อาชีพ..." class="select-size-<?php echo $grid;?>" name="mother_career" id="mother_career">
											<option></option>
					<?php
						$data_careerSql="SELECT `dc_key`, `dc_txt` FROM `data_career` ORDER BY `data_career`.`dc_key` ASC";
						$data_career=new row_datastu($data_careerSql);
						foreach($data_career->datastu_array as $rc_key=>$data_careerRow){
								if($stu_motherRow["mother_career"]==$data_careerRow["dc_key"]){
									$mc_selected="selected";
								}else{
									$mc_selected="";
								}
							?>
												<option value="<?php echo $data_careerRow["dc_key"];?>"<?php echo $mc_selected;?>><?php echo $data_careerRow["dc_txt"];?></option>
					<?php	}   ?>
										</select>
								</div>
							</div>
                        </fieldset>						
									
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">ช่วงรายได้ / เดือน</b></label>
								<div class="col-<?php echo $grid;?>-8">
										<select data-placeholder="ช่วงรายได้..." class="select-size-<?php echo $grid;?>" name="mother_salary" id="mother_salary">
											<option></option>
					<?php
						$data_incomSql="SELECT `di_key`, `di_txt` FROM `data_incom` ORDER BY `data_incom`.`di_key` ASC";
						$data_incom=new row_datastu($data_incomSql);
						foreach($data_incom->datastu_array as $rc_key=>$data_incomRow){ 
							if($stu_motherRow["mother_salary"]==$data_incomRow["di_key"]){
								$salary_selected="selected";
							}else{
								$salary_selected="";
							}
						?>
												<option value="<?php echo $data_incomRow["di_key"];?>"<?php echo $salary_selected;?>><?php echo $data_incomRow["di_txt"];?></option>
					<?php	}   ?>
					
										</select>
								</div>
							</div>
                        </fieldset>						
					
					</div>
					<!--<div class="col-<?php //echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php //echo $grid;?>-4">รายได้/เดือน</label>							
								<div class="col-<?php //echo $grid;?>-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>-->
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">วุฒิการศึกษา</b></label>
								<div class="col-<?php echo $grid;?>-8">
										<select data-placeholder="วุฒิการศึกษา..." class="select-size-<?php echo $grid;?>" name="mother_study" id="mother_study">
											<option></option>
					<?php
						$data_studySql="SELECT `study_id`, `study_txt` FROM `data_study` ORDER BY `data_study`.`study_id` ASC";
						$data_study=new row_datastu($data_studySql);
						foreach($data_study->datastu_array as $rc_key=>$data_studyRow){
							if($stu_motherRow["mother_study"]==$data_studyRow["study_id"]){
								$ms_selected="selected";
							}else{
								$ms_selected="";
							}

							?>
												<option value="<?php echo $data_studyRow["study_id"];?>"<?php echo $ms_selected;?>><?php echo $data_studyRow["study_txt"];?></option>
					<?php	}   ?>	
										</select>
								</div>
							</div>
                        </fieldset>						
					
											
					</div>
				</div>

				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">สถานที่ทำงาน </b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="สถานที่ทำงาน" size="100" maxlength="100" name="mother_workplace" id="mother_workplace" value="<?php echo $stu_motherRow["mother_workplace"];?>">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">ตำแหน่ง</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ตำแหน่ง" size="100" maxlength="100" name="mother_wp_pro" id="mother_wp_pro" value="<?php echo $stu_motherRow["mother_wp_pro"];?>">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				
				<hr><p><h4><u><b style="color: #336600">ที่อยู่ที่ทำงาน</b></u></h4></p><hr>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">เลขที่ </b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="เลขที่" size="100" maxlength="20" name="mother_wordhno" id="mother_wordhno" value="<?php echo $stu_mother_addwordRow["mother_wordhno"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">หมู่ที </b>่</label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="หมู่ที่" size="100" maxlength="50" name="mother_wordmoo" id="mother_wordmoo" value="<?php echo $stu_mother_addwordRow["mother_wordmoo"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ซอย </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ซอย" size="100" maxlength="100" name="mother_wordsoi" id="mother_wordsoi" value="<?php echo $stu_mother_addwordRow["mother_wordsoi"];?>"> 
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ถนน </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ถนน" size="100" maxlength="100" name="mother_wordroad" id="mother_wordroad" value="<?php echo $stu_mother_addwordRow["mother_wordroad"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
				</div>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">จังหวัด</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="จังหวัด..." class="select-size-<?php echo $grid;?>" name="mother_wordprovince" id="mother_wordprovince">
											<option></option>
											<optgroup label="จังหวัด">
											
								<?php
									$data_provinces="SELECT `PROVINCE_ID`,`PROVINCE_NAME`,`PROVINCE_NAME_ENG` FROM `provinces` order by convert ( `PROVINCE_NAME` using tis620) asc";
									$txt_provinces=new row_datastu($data_provinces);
									foreach($txt_provinces->datastu_array as $rc_key=>$provincesRow){
										if($stu_mother_addwordRow["mother_wordprovince"]==$provincesRow["PROVINCE_ID"]){
											$mwp_selected="selected";
										}else{
											$mwp_selected="";
										}
										?>
									
												<option value="<?php echo $provincesRow["PROVINCE_ID"];?>" <?php echo $mwp_selected;?>><?php echo $provincesRow["PROVINCE_NAME"]." / ".$provincesRow["PROVINCE_NAME_ENG"];?></option>
								<?php	} ?>			 
											</optgroup>
										</select>	
								</div>
							</div>
                        </fieldset>						
									
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">อำเภอ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="อำเภอ..." class="select-size-<?php echo $grid;?>" name="mother_wordamphur" id="mother_wordamphur">
											<option></option>

											<optgroup label="อำเภอ">
											
							<?php
								$amphuresSql="SELECT `AMPHUR_ID`,`AMPHUR_NAME`,`AMPHUR_NAME_ENG` FROM `amphures` WHERE `PROVINCE_ID`='{$stu_mother_addwordRow["mother_wordprovince"]}'";
								$amphuresRs=new row_datastu($amphuresSql);
								foreach($amphuresRs->datastu_array as $rc_key=>$amphuresRow){ 
								if($stu_mother_addwordRow["mother_wordamphur"]==$amphuresRow["AMPHUR_ID"]){
									$sa_selected="selected";
								}else{
									$sa_selected="";
								}
								?>
												<option value="<?php echo $amphuresRow["AMPHUR_ID"];?>" <?php echo $sa_selected;?>><?php echo $amphuresRow["AMPHUR_NAME"]." / ".$amphuresRow["AMPHUR_NAME_ENG"];?></option>
						<?php	}   ?>				
											</optgroup>
										</select>									
								</div>
							</div>
                        </fieldset>						
					
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">ตำบล</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="ตำบล..." class="select-size-<?php echo $grid;?>" name="mother_wordtumbon" id="mother_wordtumbon">
											<option></option>
											<optgroup label="ตำบล">
								<?php
									$districtsSql="SELECT `DISTRICT_ID`,`DISTRICT_NAME`,`DISTRICT_NAME_ENG` FROM `districts` WHERE `AMPHUR_ID`='{$stu_mother_addwordRow["mother_wordamphur"]}';";
									$districts=new row_datastu($districtsSql);
									foreach($districts->datastu_array as $rc_key=>$districts_print){ 
										if($stu_mother_addwordRow["mother_wordtumbon"]==$districts_print["DISTRICT_ID"]){
											$stum_selected="selected";
										}else{
											$stum_selected="";
										}
									
									?>
											<option value="<?php echo $districts_print["DISTRICT_ID"];?>" <?php echo $stum_selected;?>><?php echo $districts_print["DISTRICT_NAME"]." / ".$districts_print["DISTRICT_NAME_ENG"];?></option>
							<?php	} ?>

											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						
					
					</div>

					
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">รหัสไปรษณีย์ </b></label>
								<div class="col-<?php echo $grid;?>-9">
									<div class="input-group">
										<div id="mother_wordzipcode"><input type="text" name="mother_wordzipcode" id="mother_wordzipcodecopy"  class="form-control" readonly="readonly" placeholder="รหัสไปรษณีย์" size="100" maxlength="6" value="<?php echo $stu_mother_addwordRow["mother_wordzipcode"];?>"></div>
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>				
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">เบอร์โทรศัทพ์ที่ทำงาน </b></label>							
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="เบอร์โทรศัทพ์ที่ทำงาน" size="100" name="mother_wp_tel" id="mother_wp_tel" value="<?php echo $stu_motherRow["mother_wp_tel"];?>" data-masked-input="999999999999999" maxlength="15">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>				
				<hr><p><h4><u><b style="color: #336600">ที่อยู่ มารดา</b></u></h4></p><hr>
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">บ้านเลขที่ </b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="บ้านเลขที่" size="100" maxlength="10" name="mother_hno" id="mother_hno" value="<?php echo $stu_mother_addressRow["mother_hno"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">หมู่ที </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="หมู่ที่" size="100" maxlength="20" name="mother_moo" id="mother_moo" value="<?php echo $stu_mother_addressRow["mother_moo"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ซอย </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="50" maxlength="100" name="mother_soi" id="mother_soi" value="<?php echo $stu_mother_addressRow["mother_soi"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ถนน </b></label>
								<div class="col-<?php echo $grid;?>-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ถนน" size="100" maxlength="100" name="mother_road" id="mother_road" value="<?php echo $stu_mother_addressRow["mother_road"];?>">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
				</div>

				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">จังหวัด</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="จังหวัด..." class="select-size-<?php echo $grid;?>" name="mother_province" id="mother_province">
											<option></option>
											<optgroup label="จังหวัด">
											
								<?php
									$data_provinces="SELECT `PROVINCE_ID`,`PROVINCE_NAME`,`PROVINCE_NAME_ENG` FROM `provinces` order by convert ( `PROVINCE_NAME` using tis620) asc";
									$txt_provinces=new row_datastu($data_provinces);
									foreach($txt_provinces->datastu_array as $rc_key=>$provincesRow){
										if($stu_mother_addressRow["mother_province"]==$provincesRow["PROVINCE_ID"]){
											$mp_selected="selected";
										}else{
											$mp_selected="";
										}
										?>
									
												<option value="<?php echo $provincesRow["PROVINCE_ID"];?>" <?php echo $mp_selected;?>><?php echo $provincesRow["PROVINCE_NAME"]." / ".$provincesRow["PROVINCE_NAME_ENG"];?></option>
								<?php	} ?>			 
											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						
					
					
										
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">อำเภอ</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="อำเภอ..." class="select-size-<?php echo $grid;?>" name="mother_amphur" id="mother_amphur">
											<option></option>
											<optgroup label="อำเภอ">
											
							<?php
								$amphuresSql="SELECT `AMPHUR_ID`,`AMPHUR_NAME`,`AMPHUR_NAME_ENG` FROM `amphures` WHERE `PROVINCE_ID`='{$stu_mother_addressRow["mother_province"]}'";
								$amphuresRs=new row_datastu($amphuresSql);
								foreach($amphuresRs->datastu_array as $rc_key=>$amphuresRow){ 
								if($stu_mother_addressRow["mother_amphur"]==$amphuresRow["AMPHUR_ID"]){
									$ma_selected="selected";
								}else{
									$ma_selected="";
								}
								?>
												<option value="<?php echo $amphuresRow["AMPHUR_ID"];?>" <?php echo $ma_selected;?>><?php echo $amphuresRow["AMPHUR_NAME"]." / ".$amphuresRow["AMPHUR_NAME_ENG"];?></option>
						<?php	}   ?>				
											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>						
					
					
														
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">ตำบล</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="ตำบล..." class="select-size-<?php echo $grid;?>" name="mother_tumbon" id="mother_tumbon">
											<option></option>
											<optgroup label="ตำบล">
								<?php
									$districtsSql="SELECT `DISTRICT_ID`,`DISTRICT_NAME`,`DISTRICT_NAME_ENG` FROM `districts` WHERE `AMPHUR_ID`='{$stu_mother_addressRow["mother_amphur"]}';";
									$districts=new row_datastu($districtsSql);
									foreach($districts->datastu_array as $rc_key=>$districts_print){ 
										if($stu_mother_addressRow["mother_tumbon"]==$districts_print["DISTRICT_ID"]){
											$mt_selected="selected";
										}else{
											$mt_selected="";
										}
									
									?>
											<option value="<?php echo $districts_print["DISTRICT_ID"];?>" <?php echo $mt_selected;?>><?php echo $districts_print["DISTRICT_NAME"]." / ".$districts_print["DISTRICT_NAME_ENG"];?></option>
							<?php	} ?>

											</optgroup>	
										</select>
								</div>
							</div>
                        </fieldset>						
					
														
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-5"><b style="color: #00008B">รหัสไปรษณีย์ </b></label>
								<div class="col-<?php echo $grid;?>-7">
									<div class="input-group">
										<div id="mother_zipcode"><input type="text" name="mother_zipcode" id="mother_zipcodecopy" class="form-control" readonly="readonly" placeholder="รหัสไปรษณีย์" size="100" maxlength="6" value="<?php echo $stu_mother_addressRow["mother_zipcode"];?>"></div>
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					
				</div><hr>
				<!--<div class="row">
					<div class="col-<?php //echo $grid;?>-12">
						<center><button type="submit" class="btn btn-info">บันทึกข้อมูล...มารดา</button></center>
					</div>
				</div>-->
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<center><button type="button" class="btn btn-info" id="mother_modify">บันทึกข้อมูล...มารดา</button></center>
					</div>
				</div>
		</div>	
	</div>
	</div>
</div>
<input type="hidden" name="stu_id" value="<?php echo $user_login;?>" id="stu_id_mm">
<input type="hidden" name="enter" value="up_mother" id="enter_mm">
<input type="hidden" name="myname" value="<?php echo $myname;?>" id="myname" >
<input type="hidden" name="group" value="S" id="group" >
</form>
<div id="print_mother_modify"></div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	}	   ?>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	