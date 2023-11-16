	<!-- Theme JS files colors_grey.html-->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/core.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/selectboxit.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/pnotify.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/noty.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/jgrowl.min.js"></script>

	<script>
		$(document).ready(function(){
			$('.select-menu-color').select2({
				containerCssClass: 'bg-grey-600',
				dropdownCssClass: 'bg-grey-600'
			});
		})
	</script>
	<!-- /theme JS files -->
	
	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	
	<script>
		$(document).ready(function(){
			$('#CP_See').on('click', function() {
				var CP_Year=$("#CP_Year").val();
				swal({
					title: "ต้องการสรุปยอดขาย บัตรคอนเสิร์ต ",
					text: "บัตรคอนเสิร์ต "+CP_Year,
					type: "info",
					showCancelButton: true,
					closeOnConfirm: false,
					confirmButtonColor: "#2196F3",
					showLoaderOnConfirm: true
				},
				function() {
					setTimeout(function() {
						swal({
							title: "โหลดข้อมูล สรุปยอดขาย บัตรคอนเสิร์ต "+CP_Year,
							confirmButtonColor: "#2196F3"
						},function(){
							$.post("<?php echo base_url();?>Concert_pay/concert_predicate",{
								CP_Year:CP_Year
							},function(cp_data){
								if(cp_data!=""){
									$("#CPData").html(cp_data)
								}else{}
							})
						});
					}, 2000);
				});
			});			
		})
	</script>