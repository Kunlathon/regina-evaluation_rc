<style>
#RuningLoadQuota{
	display:none;
}
</style>
<?php
//---------------------------------------------------------------------------------
	include("../../../../database/pdo_quota.php");
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_quota.php");
//---------------------------------------------------------------------------------	
    include("../../../../database/pdo_conndatastu.php");
	include("../../../../database/class_pdodatastu.php");
//---------------------------------------------------------------------------------	
?>
<!--****************************************************************************-->	
	<script>
		$(document).ready(function(){
			// Switchery toggles
			var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
			elems.forEach(function(html) {
				var switchery = new Switchery(html);
			});


			// Touchspin
			$(".touchspin-postfix").TouchSpin({
				min: 0,
				max: 100,
				step: 0.1,
				decimals: 2,
				postfix: '%'
			});


			// Styled checkboxes, radios
			$(".styled").uniform();


			// Styled file input
			$(".file-styled").uniform({
				fileButtonClass: 'action btn bg-blue'
			});


			// Bootstrap Switch
			$(".switch").bootstrapSwitch({
				onSwitchChange: function(state) {
					if(state) {
						$(this).valid(true);
					}
					else {
						$(this).valid(false);
					}
				}
			});


			//
			// Select2 select
			//

			// Initialize
			var $select = $('.select').select2({
				minimumResultsForSearch: Infinity
			});
			
			// Trigger value change when selection is made
			$select.on('change', function() {
				$(this).trigger('blur');
			});



			// Setup validation
			// ------------------------------

			// Initialize
			var validator = $(".form-validate-jquery").validate({
				ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
				errorClass: 'validation-error-label',
				successClass: 'validation-valid-label',
				highlight: function(element, errorClass) {
					$(element).removeClass(errorClass);
				},
				unhighlight: function(element, errorClass) {
					$(element).removeClass(errorClass);
				},

				// Different components require proper error label placement
				errorPlacement: function(error, element) {

					// Styled checkboxes, radios, bootstrap switch
					if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
						if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
							error.appendTo( element.parent().parent().parent().parent() );
						}
						 else {
							error.appendTo( element.parent().parent().parent().parent().parent() );
						}
					}

					// Unstyled checkboxes, radios
					else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
						error.appendTo( element.parent().parent().parent() );
					}

					// Input with icons and Select2
					else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
						error.appendTo( element.parent() );
					}

					// Inline checkboxes, radios
					else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
						error.appendTo( element.parent().parent() );
					}

					// Input group, styled file input
					else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
						error.appendTo( element.parent().parent() );
					}

					else {
						error.insertAfter(element);
					}
				},
				validClass: "validation-valid-label",
				success: function(label) {
					label.addClass("validation-valid-label").text("Success.")
				},
				rules: {
					password: {
						minlength: 5
					},
					repeat_password: {
						equalTo: "#password"
					},
					email: {
						email: true
					},
					repeat_email: {
						equalTo: "#email"
					},
					minimum_characters: {
						minlength: 10
					},
					maximum_characters: {
						maxlength: 10
					},
					minimum_number: {
						min: 10
					},
					maximum_number: {
						max: 10
					},
					number_range: {
						range: [10, 20]
					},
					url: {
						url: true
					},
					date: {
						date: true
					},
					date_iso: {
						dateISO: true
					},
					numbers: {
						number: true
					},
					digits: {
						digits: true
					},
					creditcard: {
						creditcard: true
					},
					basic_checkbox: {
						minlength: 2
					},
					styled_checkbox: {
						minlength: 2
					},
					switchery_group: {
						minlength: 2
					},
					switch_group: {
						minlength: 2
					}
				},
				messages: {
					custom: {
						required: 'This is a custom error message'
					},
					basic_checkbox: {
						minlength: 'Please select at least {0} checkboxes'
					},
					styled_checkbox: {
						minlength: 'Please select at least {0} checkboxes'
					},
					switchery_group: {
						minlength: 'Please select at least {0} switches'
					},
					switch_group: {
						minlength: 'Please select at least {0} switches'
					},
					agree: 'Please accept our policy'
				}
			});

			// Reset form
			$('#reset').on('click', function() {
				validator.resetForm();
			});			
		})	
	</script>		
	<script>
		$(function() {
			$("#RunLoadQuota").fadeOut(5000, function() {
				$("#RuningLoadQuota").fadeIn(4000);
			});
		});
	</script>		
	<script>
		$(document).ready(function(){
			$("#QuotaBtn").click(function(){
			$("#QuotaModal").modal({backdrop: false});
			});
		})	
	</script>		
			
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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<center>
				<div id="RunLoadQuota">
					<img class="img-thumbnail" src="Template/global_assets/images/Cube-1s-200px.gif" />
				</div>	
			</center>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--****************************************************************************-->	
<div id="RuningLoadQuota">
<?php
//---------------------------------------------------------------------------------
	$quota_txt=filter_input(INPUT_POST,'quota_txt');
//---------------------------------------------------------------------------------	
	$quota_user_login=filter_input(INPUT_POST,'quota_user_login');
	$quota_data_yaer=filter_input(INPUT_POST,'quota_data_yaer');
	$quota_next_yaer=filter_input(INPUT_POST,'quota_next_yaer');
	$quota_class=filter_input(INPUT_POST,'quota_class');
	$quota_class_new=filter_input(INPUT_POST,'quota_class_new');
	$quota_class_new_txt=filter_input(INPUT_POST,'quota_class_new_txt');
//---------------------------------------------------------------------------------	
		if(isset($quota_txt,$quota_user_login,$quota_data_yaer,$quota_next_yaer,$quota_class,$quota_class_new)){
			switch($quota_txt){
				case "bqA": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<div class="row">
	<div class="col-<?php echo $grid;?>-4">
		<fieldset class="content-group">
			<div class="form-group">
				<label class="control-label col-<?php echo $grid;?>-2">ข้าพเจ้า<span class="text-danger">*</span></label>
				<div class="col-<?php echo $grid;?>-10">
					<select data-placeholder="คำนำหน้า ผู้ปกครอง..."  name="isr_quota_np" class="select text-teal" required="required">
									<option></option>					
						<?php
								$npthailSql="SELECT `IDPrefix`,`prefixname`,`prefix_SName` 
											 FROM `rc_prefix` 
											 WHERE `IDPrefix`!='1' and `IDPrefix`!='2'  and `IDPrefix`!='7' and `IDPrefix`!='8'and `IDPrefix`!='9'";
								$npthail=new row_datastu($npthailSql);
								foreach($npthail->datastu_array as $rc_key=>$npthailRow){?>
									<option value="<?php echo $npthailRow["IDPrefix"]?>"><?php echo $npthailRow["prefixname"]?></option>
						<?php	}?>					
					</select>				
				</div>			
			</div>
		</fieldset>	
	</div>
	<div class="col-<?php echo $grid;?>-4">
		<fieldset class="content-group">
			<div class="form-group">
				<label class="control-label col-<?php echo $grid;?>-2">ชื่อ<span class="text-danger">*</span></label>
				<div class="col-<?php echo $grid;?>-10">
					<input type="text" name="isr_quota_name" class="form-control text-teal"  maxlength="100" minlength="3" required="required" placeholder="ชื่อ ผู้ปกครอง">
				</div>			
			</div>
		</fieldset>
	</div>
	<div class="col-<?php echo $grid;?>-4">
		<fieldset class="content-group">
			<div class="form-group">
				<label class="control-label col-<?php echo $grid;?>-2">นามสกุล<span class="text-danger">*</span></label>
				<div class="col-<?php echo $grid;?>-10">
					<input type="text" name="isr_quota_surname" class="form-control text-teal"  maxlength="100" minlength="3" required="required" placeholder="นามสกุล ผู้ปกครอง">
				</div>			
			</div>
		</fieldset>	
	</div>
</div>
<div class="row">
	<div class="col-<?php echo $grid;?>-6">
		<fieldset class="content-group">
			<div class="form-group">
				<label class="control-label col-<?php echo $grid;?>-4">ความสัมพันธ์กับนักเรียน<span class="text-danger">*</span></label>
				<div class="col-<?php echo $grid;?>-8">
					<select data-placeholder="ความสัมพันธ์กับนักเรียน..." class="select text-teal"  name="isr_quota_relationship" required="required">
						<option></option>
							<?php
									$data_relySql="SELECT `dr_key`,`dr_txt`FROM `data_rely` WHERE `dr_key` !='1'";
									$data_relyRs=new row_datastu($data_relySql);
									foreach($data_relyRs->datastu_array as $rc_key=>$data_relyRow){?>
												<option value="<?php echo $data_relyRow["dr_key"];?>"><?php echo $data_relyRow["dr_txt"];?></option>
							<?php	}   ?>					
					</select>				
				</div>			
			</div>
		</fieldset>		
	</div>		
	<div class="col-<?php echo $grid;?>-6">
		<fieldset class="content-group">
			<div class="form-group">
				<label class="control-label col-<?php echo $grid;?>-3">หมายเลขติดต่อ<span class="text-danger">*</span></label>
				<div class="col-<?php echo $grid;?>-9">
					<input type="tel" name="isr_quota_phone" maxlength="10"  minlength="10" data-mask="9999999999" pattern="[0-9]{1,}" class="form-control text-teal" required="required" placeholder="หมายเลขติดต่อ">
				</div>			
			</div>
		</fieldset>	
	</div>	
</div>
<div class="row">
	<div class="col-<?php echo $grid;?>-6" align="center">
		<fieldset class="content-group">
			<div class="form-group">
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						หลักสูตรที่ได้รับสิทธิ์โควตา (โปรดเลือก 1 รายการ) 
					</div>
				</div>
			</div>
		</fieldset>	
	</div>
	<div class="col-<?php echo $grid;?>-6" align="left">
		<fieldset class="content-group">
			<div class="form-group">
				
	<?php
			if($quota_class_new==31){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<?php
			$rc_quotas=new internal_quota_rights($quota_user_login,$quota_next_yaer,$quota_class_new);
			$countA=0;
				foreach($rc_quotas->print_internal_quota_rights() as $rc=>$rc_quotasRow){ 
				$countA=$countA+1;?>
				<div class="row">	
					<div class="col-<?php echo $grid;?>-12">
						<label class="radio-inline">
							<input type="radio" name="quota_plan"  class="styled" required="required" value="<?php echo $rc_quotasRow["quota_plan"];?>">
							หลักสูตรห้องเรียน<?php echo $rc_quotasRow["LName"];?>
						</label>					
					</div>
				</div>		
		<?php 	} ?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}elseif($quota_class_new==41){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<?php
			$rc_quotas=new internal_quota_rights($quota_user_login,$quota_next_yaer,$quota_class_new);
			$countA=0;
				foreach($rc_quotas->print_internal_quota_rights() as $rc=>$rc_quotasRow){ 
				$countA=$countA+1;?>
				<div class="row">	
					<div class="col-<?php echo $grid;?>-12">
						<label class="radio-inline">
							<input type="radio" name="quota_plan"  class="styled" required="required" value="<?php echo $rc_quotasRow["quota_plan"];?>">
							แผนการเรียน <?php echo $rc_quotasRow["LName"];?>
						</label>					
					</div>
				</div>		
		<?php 	} ?>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{
				
			}?>
				

				
				
				
			</div>
		</fieldset>
	</div>	
</div>
<div class="row">
	<div class="col-<?php echo $grid;?>-12" align="center">
		<fieldset class="content-group">
			<div class="form-group">
				<button type="button" class="btn btn-success" id="QuotaBtn">ดำเนินการต่อ</button>
			</div>
		</fieldset>
	</div>
</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="modal fade" id="QuotaModal" role="dialog">
		<div class="modal-dialog">
<!-- Modal content-->
		<div class="modal-content">
        <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h4 class="modal-title">
				<div class="alert alert-warning alert-styled-left"> 
				แบบแจ้งความจำนง
				</div>
			</h4>
        </div>
        <div class="modal-body">
				<div class="row" style="font-size: 16px" align="center">
					<div class="col-<?php echo $grid;?>-12">
						<fieldset class="content-group">
							<div class="form-group">
								<div class="row">
									<div class="col-<?php echo $grid;?>-12">
										<div class="panel panel-body border-top-warning">
											<div class="row">
												<div class="col-<?php echo $grid;?>-12">
												ข้าพเจ้าได้รับทราบและพิจารณาสิทธิ์โควตา
												</div>
											</div>	
											<div class="row">
												<div class="col-<?php echo $grid;?>-12">
												เข้าศึกษาต่อในระดับชั้น<?php echo $quota_class_new_txt;?> ปีการศึกษา <?php echo $quota_next_yaer;?>
												</div>
											</div>	
											<div class="row">
												<div class="col-<?php echo $grid;?>-12">
												โรงเรียนเรยีนาเชลีวิทยาลัย
												</div>
											</div>	
											<div class="row">
												<div class="col-<?php echo $grid;?>-12">
												ร่วมกับนักเรียนในความปกครองของข้าพเจ้าแล้วและมีความประสงค์ 
												</div>
											</div>								
											<div class="row">
												<div class="col-<?php echo $grid;?>-12">
												รักษาสิทธิ์โควตา
												</div>
											</div>										
										</div>
									</div>
								</div>
								
							</div>
						</fieldset>
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<fieldset class="content-group">
							<div class="form-group">
								<div class="row" align="center">
									<div class="col-<?php echo $grid;?>-12">
										<button type="submit" class="btn btn-success">ยืนยันรักษาสิทธิ์โควตา</button>
									</div>
								</div>
							</div>
						</fieldset>				
					</div>
				</div>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
			</div>
		</div>
		</div>
	</div>				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<input type="hidden" name="quota_txt" value="<?php echo $quota_txt;?>">			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php			break;
				case "bqB": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<div class="row">
	<div class="col-<?php echo $grid;?>-4">
		<fieldset class="content-group">
			<div class="form-group">
				<label class="control-label col-<?php echo $grid;?>-2">ข้าพเจ้า<span class="text-danger">*</span></label>
				<div class="col-<?php echo $grid;?>-10">
					<select data-placeholder="คำนำหน้า ผู้ปกครอง..."  name="isr_quota_np" class="select text-teal" required="required">
									<option></option>					
						<?php
								$npthailSql="SELECT `IDPrefix`,`prefixname`,`prefix_SName` 
											 FROM `rc_prefix` 
											 WHERE `IDPrefix`!='1' and `IDPrefix`!='2'  and `IDPrefix`!='7' and `IDPrefix`!='8'and `IDPrefix`!='9'";
								$npthail=new row_datastu($npthailSql);
								foreach($npthail->datastu_array as $rc_key=>$npthailRow){?>
									<option value="<?php echo $npthailRow["IDPrefix"]?>"><?php echo $npthailRow["prefixname"]?></option>
						<?php	}?>					
					</select>				
				</div>			
			</div>
		</fieldset>	
	</div>
	<div class="col-<?php echo $grid;?>-4">
		<fieldset class="content-group">
			<div class="form-group">
				<label class="control-label col-<?php echo $grid;?>-2">ชื่อ<span class="text-danger">*</span></label>
				<div class="col-<?php echo $grid;?>-10">
					<input type="text" name="isr_quota_name"  class="form-control text-teal" maxlength="100" minlength="3" required="required" placeholder="ชื่อ ผู้ปกครอง">
				</div>			
			</div>
		</fieldset>
	</div>
	<div class="col-<?php echo $grid;?>-4">
		<fieldset class="content-group">
			<div class="form-group">
				<label class="control-label col-<?php echo $grid;?>-2">นามสกุล<span class="text-danger">*</span></label>
				<div class="col-<?php echo $grid;?>-10">
					<input type="text" name="isr_quota_surname"  class="form-control text-teal" maxlength="100" minlength="3" required="required" placeholder="นามสกุล ผู้ปกครอง">
				</div>			
			</div>
		</fieldset>	
	</div>
</div>
<div class="row">
	<div class="col-<?php echo $grid;?>-6">
		<fieldset class="content-group">
			<div class="form-group">
				<label class="control-label col-<?php echo $grid;?>-4">ความสัมพันธ์กับนักเรียน<span class="text-danger">*</span></label>
				<div class="col-<?php echo $grid;?>-8">
					<select data-placeholder="ความสัมพันธ์กับนักเรียน..."  class="select text-teal" name="isr_quota_relationship" required="required">
						<option></option>
							<?php
									$data_relySql="SELECT `dr_key`,`dr_txt`FROM `data_rely` WHERE `dr_key` !='1'";
									$data_relyRs=new row_datastu($data_relySql);
									foreach($data_relyRs->datastu_array as $rc_key=>$data_relyRow){?>
												<option value="<?php echo $data_relyRow["dr_key"];?>"><?php echo $data_relyRow["dr_txt"];?></option>
							<?php	}   ?>					
					</select>				
				</div>			
			</div>
		</fieldset>		
	</div>		
	<div class="col-<?php echo $grid;?>-6">
		<fieldset class="content-group">
			<div class="form-group">
				<label class="control-label col-<?php echo $grid;?>-3">หมายเลขติดต่อ<span class="text-danger">*</span></label>
				<div class="col-<?php echo $grid;?>-9">
					<input type="tel" name="isr_quota_phone"  pattern="[0-9]{1,}" maxlength="10" minlength="10" data-mask="9999999999" class="form-control text-teal" required="required" placeholder="หมายเลขติดต่อ">
				</div>			
			</div>
		</fieldset>	
	</div>	
</div>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<fieldset class="content-group">
			<div class="form-group">
				<label class="control-label col-<?php echo $grid;?>-2">สละสิทธิ์เนื่องจาก<span class="text-danger">*</span></label>
				<div class="col-<?php echo $grid;?>-10">
					<input type="text" name="isr_MaintainRightsTxT"  class="form-control text-teal" maxlength="100" minlength="3" required="required" placeholder="สละสิทธิ์เนื่องจาก">
				</div>			
			</div>
		</fieldset>	
	</div>
</div>
<div class="row">
	<div class="col-<?php echo $grid;?>-12" align="center">
		<fieldset class="content-group">
			<div class="form-group">
				<button type="button" class="btn btn-success" id="QuotaBtn">ดำเนินการต่อ</button>
			</div>
		</fieldset>
	</div>
</div>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="modal fade" id="QuotaModal" role="dialog">
		<div class="modal-dialog">
<!-- Modal content-->
		<div class="modal-content">
        <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h4 class="modal-title">
				<div class="alert alert-warning alert-styled-left"> 
				แบบแจ้งความจำนง
				</div>
			</h4>
        </div>
        <div class="modal-body">
				<div class="row" style="font-size: 16px" align="center">
					<div class="col-<?php echo $grid;?>-12">
						<fieldset class="content-group">
							<div class="form-group">
								<div class="row">
									<div class="col-<?php echo $grid;?>-12">
										<div class="panel panel-body border-top-warning">
											<div class="row">
												<div class="col-<?php echo $grid;?>-12">
												ข้าพเจ้าได้รับทราบและพิจารณาสิทธิ์โควตา
												</div>
											</div>	
											<div class="row">
												<div class="col-<?php echo $grid;?>-12">
												เข้าศึกษาต่อในระดับชั้น<?php echo $quota_class_new_txt;?> ปีการศึกษา <?php echo $quota_next_yaer;?>
												</div>
											</div>	
											<div class="row">
												<div class="col-<?php echo $grid;?>-12">
												โรงเรียนเรยีนาเชลีวิทยาลัย
												</div>
											</div>	
											<div class="row">
												<div class="col-<?php echo $grid;?>-12">
												ร่วมกับนักเรียนในความปกครองของข้าพเจ้าแล้วและมีความประสงค์ 
												</div>
											</div>								
											<div class="row">
												<div class="col-<?php echo $grid;?>-12">
												สละสิทธิ์โควตา
												</div>
											</div>										
										</div>
									</div>
								</div>
								
							</div>
						</fieldset>
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<fieldset class="content-group">
							<div class="form-group">
								<div class="row" align="center">
									<div class="col-<?php echo $grid;?>-12">
										<button type="submit" class="btn btn-success">ยืนยันสละสิทธิ์โควตา</button>
									</div>
								</div>
							</div>
						</fieldset>				
					</div>
				</div>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
			</div>
		</div>
		</div>
	</div>				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<input type="hidden" name="quota_txt" value="<?php echo $quota_txt;?>">			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php			break;
				default;
//----------------------------------------------------------------				
//----------------------------------------------------------------				
			}
		}else{}
?>
</div>