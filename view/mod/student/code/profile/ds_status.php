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
	
	<script>
		$(document).ready(function () {
			
			$('.select-size-<?php echo $grid;?>').select2({
			containerCssClass: 'select-<?php echo $grid;?>'
			});
			
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

<!--****************************************************************************-->	
<?php
	include("../../../../database/pdo_conndatastu.php");
	include("../../../../database/class_pdodatastu.php");

	$txt_ds=filter_input(INPUT_POST,'txt_ds');
	
	if($txt_ds==5){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<div class="row">
		<div class="col-<?php echo $grid;?>-6">
			<fieldset class="content-group">
				<div class="form-group">
					<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ชื่อหอพัก </b></label>
					<div class="col-<?php echo $grid;?>-10">
						<div class="input-group">
							<input type="text" name="ds_dormitoryName" id="ds_dormitoryName" class="form-control"  placeholder="ชื่อ หอพัก" size="100" maxlength="100">
						</div>
					</div>
				</div>
            </fieldset>	
		</div>
		<div class="col-<?php echo $grid;?>-3">
			<fieldset class="content-group">
				<div class="form-group">
					<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">เลขที่ </b></label>
						<div class="col-<?php echo $grid;?>-9">
							<div class="input-group">
								<input type="text" name="ds_dormitoryHno" id="ds_dormitoryHno" class="form-control" placeholder="เลขที่ หอพัก" size="100" maxlength="30">
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
								<input type="text" name="ds_dormitoryMoo" id="ds_dormitoryMoo" class="form-control" placeholder="หมู่ที่ หอพัก" size="100" maxlength="3">
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
					<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ซอย </b></label>
						<div class="col-<?php echo $grid;?>-10">
							<div class="input-group">
								<input type="text" name="ds_dormitorySoi" id="ds_dormitorySoi" class="form-control" placeholder="ซอย หอพัก" size="100" maxlength="100">
							</div>
						</div>
				</div>
            </fieldset>						
		</div>
		<div class="col-<?php echo $grid;?>-9">
			<fieldset class="content-group">
				<div class="form-group">
					<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">ชื่อเจ้าของหรือผู้ปกครอง </b></label>
						<div class="col-<?php echo $grid;?>-9">
							<div class="input-group">
								<input type="text" name="ds_dormitoryMyName" id="ds_dormitoryMyName" class="form-control" placeholder="ชื่อเจ้าของหรือผู้ปกครอง" size="100" maxlength="100">
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
					<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">โทรศัพท์ </b></label>
						<div class="col-<?php echo $grid;?>-10">
							<div class="input-group">
								<input type="text" name="ds_dormitoryPhone" id="ds_dormitoryPhone" class="form-control" placeholder="โทรศัพท์" size="100" maxlength="10">
							</div>
						</div>
				</div>
            </fieldset>			
		</div>	
		<div class="col-<?php echo $grid;?>-4">
			<fieldset class="content-group">
				<div class="form-group">
					<label class="control-label col-<?php echo $grid;?>-2"><b style="color: #00008B">ถนน </b></label>
						<div class="col-<?php echo $grid;?>-10">
							<div class="input-group">
								<input type="text" name="ds_dormitoryRoad" id="ds_dormitoryRoad" class="form-control" placeholder="ถนน หอพัก" size="100" maxlength="100">
							</div>
						</div>
				</div>
            </fieldset>						
		</div>	
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">จังหวัด</b></label>
								<div class="col-<?php echo $grid;?>-9">
										<select  name="ds_dormitoryProvince" id="ds_dormitoryProvince" data-placeholder="จังหวัด..." class="select-size-<?php echo $grid;?>">
											<option></option>
											<optgroup label="จังหวัด">
											
								<?php
									$data_provinces="SELECT `PROVINCE_ID`,`PROVINCE_NAME`,`PROVINCE_NAME_ENG` FROM `provinces` order by convert ( `PROVINCE_NAME` using tis620) asc";
									$txt_provinces=new row_datastu($data_provinces);
									foreach($txt_provinces->datastu_array as $rc_key=>$provincesRow){
										/*if($stu_address_homeRow["stu_reg_province"]==$provincesRow["PROVINCE_ID"]){
											$srp_selected="selected";
										}else{
											$srp_selected="";
										}*/
										?>
									
												<option value="<?php echo $provincesRow["PROVINCE_ID"];?>" <?php //echo $srp_selected;?>><?php echo $provincesRow["PROVINCE_NAME"]." / ".$provincesRow["PROVINCE_NAME_ENG"];?></option>
								<?php	} ?>											
			 
											</optgroup>
										</select>
								</div>
							</div>
                        </fieldset>					
				
					</div>		
		
	</div>
	
	
	<div class="row">

					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-3"><b style="color: #00008B">อำเภอ</b></label>
								<div class="col-<?php echo $grid;?>-9">
									<select name="ds_dormitoryAmphur" id="ds_dormitoryAmphur" data-placeholder="อำเภอ..." class="select-size-<?php echo $grid;?>">
										<option></option>
										<optgroup label="อำเภอ..">
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
									<select name="ds_dormitoryTumbon" id="ds_dormitoryTumbon" data-placeholder="ตำบล..." class="select-size-<?php echo $grid;?>">
										<option></option>
										<optgroup label="ตำบล">
										</optgroup>
									</select>
								</div>
							</div>
                        </fieldset>					
						
					</div>
					<div class="col-<?php echo $grid;?>-4"> 
				
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4"><b style="color: #00008B">รหัสไปรษณีย์ </b></label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="input-group">
										<div id="ds_dormitoryZipcode"><input type="text" name="ds_dormitoryZipcode" id="ds_dormitoryZipcodecopy" readonly="readonly" class="form-control" placeholder="รหัสไปรษณีย์" size="100" maxlength="6" value=""></div>
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>		
		
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	}else{
		//*****************
	}
?>
