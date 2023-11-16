<?php
	include("../../../../database/pdo_conndatastu.php");
	include("../../../../database/class_pdodatastu.php");
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
	
<!--ที่อยู่ผุ้ปกครองทำงาน-->
	<script>
		$(document).ready(function () {
			$("#parent_addwordprovince").change(function () {
				var province=$("#parent_addwordprovince").val();
				
				if(province!=""){
					$.post("view/mod/student/code/profile/p_word/pword_city.php",{
						txt_province:province
					},function(dataprovince){
						if(dataprovince!=""){
							$("#parent_addwordamphur").html(dataprovince);
						}
					})
				}
				
			})
		})
	</script>
	<script>
		$(document).ready(function () {
			$("#parent_addwordamphur").change(function () {
				var city=$("#parent_addwordamphur").val();
				
				if(city!=""){
					$.post("view/mod/student/code/profile/p_word/pword_amphures.php",{
						txt_city:city
					},function(datacity){
						if(datacity!=""){
							$("#parent_addwordtumbon").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	<script>
		$(document).ready(function () {
			$("#parent_addwordtumbon").change(function () {
				var zip=$("#parent_addwordtumbon").val();
				
				if(zip!=""){
					$.post("view/mod/student/code/profile/p_word/pword_zip.php",{
						txt_zip:zip
					},function(datacity){
						if(datacity!=""){
							$("#parent_addwordzipcode").html(datacity);
						}
					})
				}
				
			})
		})
	</script>	
	
	
	<!--ที่อยู่ผู้ปกครอง--->

	<script>
		$(document).ready(function () {
			$("#parent_province").change(function () {
				var province=$("#parent_province").val();
				
				if(province!=""){
					$.post("view/mod/student/code/profile/p_add/padd_city.php",{
						txt_province:province
					},function(dataprovince){
						if(dataprovince!=""){
							$("#parent_amphur").html(dataprovince);
						}
					})
				}
				
			})
		})
	</script>
	<script>
		$(document).ready(function () {
			$("#parent_amphur").change(function () {
				var city=$("#parent_amphur").val();
				
				if(city!=""){
					$.post("view/mod/student/code/profile/p_add/padd_amphures.php",{
						txt_city:city
					},function(datacity){
						if(datacity!=""){
							$("#parent_tumbon").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	<script>
		$(document).ready(function () {
			$("#parent_tumbon").change(function () {
				var zip=$("#parent_tumbon").val();
				
				if(zip!=""){
					$.post("view/mod/student/code/profile/p_add/padd_zip.php",{
						txt_zip:zip
					},function(datacity){
						if(datacity!=""){
							$("#parent_zipcode").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	
	
	<script>
		$(document).ready(function () {
			$("#ds_dormitoryProvince").change(function () {
				var province=$("#ds_dormitoryProvince").val();
				
				if(province!=""){
					$.post("view/mod/student/code/profile/ds_statusjs/statusjs_city.php",{
						txt_province:province
					},function(dataprovince){
						if(dataprovince!=""){
							$("#ds_dormitoryAmphur").html(dataprovince);
						}
					})
				}
				
			})
		})
	</script>
	<script>
		$(document).ready(function () {
			$("#ds_dormitoryAmphur").change(function () {
				var city=$("#ds_dormitoryAmphur").val();
				
				if(city!=""){
					$.post("view/mod/student/code/profile/ds_statusjs/statusjs_amphures.php",{
						txt_city:city
					},function(datacity){
						if(datacity!=""){
							$("#ds_dormitoryTumbon").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	<script>
		$(document).ready(function () {
			$("#ds_dormitoryTumbon").change(function () {
				var zip=$("#ds_dormitoryTumbon").val();
				
				if(zip!=""){
					$.post("view/mod/student/code/profile/ds_statusjs/statusjs_zip.php",{
						txt_zip:zip
					},function(datacity){
						if(datacity!=""){
							$("#ds_dormitoryZipcode").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	
	<script>
		$(document).ready(function () {
			$("#parent_status").change(function () {
				var parent=$("#parent_status").val();
				var stuid=$("#stu_id").val();
				if(parent!="" && stuid!=""){
					$.post("view/mod/student/code/profile/profile_dr.php",{
						txt_parent:parent,
						txt_stuid:stuid
					},function(datacity){
						if(datacity!=""){
							$("#print_parent").html(datacity);
						}
					})
				}
				
			})
		})
	</script>	
	
	
	
	
	
<?php

	
		$txt_status=filter_input(INPUT_POST,'txt_status');

		
			if($txt_status==2){ ?>
					<div class="col-<?php echo $grid;?>-4"></div>			
<?php		}elseif($txt_status==3){ ?>
					<div class="col-<?php echo $grid;?>-4"></div>			
<?php		}elseif($txt_status==5){ ?>
					<div class="col-<?php echo $grid;?>-4"></div>			
<?php		}elseif($txt_status==0){ ?>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">โปรดระบุ....</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select data-placeholder="ผู้ปกครอง..." name="parent_status" id="parent_status" class="select-size-<?php echo $grid;?>"  required="required">
											<option></option>
								<?php
									$data_relySql="SELECT `dr_key`,`dr_txt`FROM `data_rely` WHERE `dr_key` !='1' and `dr_key` !='2' and `dr_key` !='3' and `dr_key` !='5'";
									$data_relyRs=new row_datastu($data_relySql);
									foreach($data_relyRs->datastu_array as $rc_key=>$data_relyRow){
										if($stu_guardianRow["parent_status"]==$data_relyRow["dr_key"]){
											$parent_selected="selected";
										}else{
											$parent_selected="";
										}
										?>
												<option value="<?php echo $data_relyRow["dr_key"];?>"<?php echo $parent_selected;?>><?php echo $data_relyRow["dr_txt"];?></option>
							<?php	}   ?>		


										</select>
								</div>
							</div>
                        </fieldset>						
					</div>			
<?php		}else{ ?>
					<div class="col-<?php echo $grid;?>-4"></div>			
<?php		}?>

