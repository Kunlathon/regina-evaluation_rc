	<!-- Theme JS files colors_danger-->
	
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery_ui/core.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/selectboxit.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/pnotify.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/noty.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/jgrowl.min.js"></script>

	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	
	<script>
		$(document).ready(function () {

			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-pink'
			});			
					
			$('.select-menu-color').select2({
				containerCssClass: 'bg-pink',
				dropdownCssClass: 'bg-pink'
			});					
			
		})	
	
	
	</script>	
	
	<!-- /theme JS files -->
	
	
	<!-- Theme JS files commponents_modals-->
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	
	<!-- /theme JS files -->	
	
	
	<script>
		$(document).ready(function(){
			$('#ACDT_But').on('click', function() {
				var ACDT_T="1";
				var ACDT_Y=$("#ACDT_Y").val();
				swal({
					title: "ต้องการคัดลอกข้อมูลใช้หรือไม่",
					text: "ภาคเรียนที่ "+ACDT_T+" ปีการศึกษา "+ACDT_Y,
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#EF5350",
					confirmButtonText: "ใช้, ต้องการคัดลอกข้อมูล",
					cancelButtonText: "ไม่ใช้, ไม่ต้องการคัดลอกข้อมูล",
					closeOnConfirm: false,
					closeOnCancel: false
				},function(isConfirm){
					if(isConfirm) {
						if(ACDT_Y==""){
							swal({
								title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
								confirmButtonColor: "#2196F3",
								type: "warning"
							});
						}else{
							swal({
								title: "ดำเนินการคัดลอกข้อมูล",
								text: "ภาคเรียนที่ "+ACDT_T+" ปีการศึกษา "+ACDT_Y,
								confirmButtonColor: "#66BB6A",
								type: "success"
							},function(){
								$.post("<?php echo base_url();?>/Activity_copy_data_t",{
									ACDT_T:ACDT_T,
									ACDT_Y:ACDT_Y
								},function(ACDT_Data){
									if(ACDT_Data!=""){
										$("#ACDT_Run").html(ACDT_Data)
									}else{}
								})							
							});							
						}
					}else{
						swal({
							title: "ยกเลิกการคัดลอกข้อมูล",
							text: "ภาคเรียนที่ "+ACDT_T+" ปีการศึกษา "+ACDT_Y,
							confirmButtonColor: "#2196F3",
							type: "error"
						});
					}
				});
			});
		})
	</script>
	
	
	
	