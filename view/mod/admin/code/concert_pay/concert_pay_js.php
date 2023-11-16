	<!-- Theme JS files colors_violet.html-->
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
			
			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-violet-400'
			});			
			
			$('.select-menu-color').select2({
				containerCssClass: 'bg-violet-400',
				dropdownCssClass: 'bg-violet-400'
			});
			
		})
	</script>

	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	
	<!-- Theme JS files components_modals.html-->
	<script src="Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<!-- /theme JS files -->	
	
	<script>
		$(document).ready(function(){
			$(".styled").uniform({
				wrapperClass: "border-pink text-pink-600"
			});			
		})	
	</script>
	<!-- Theme JS files -->

	<!-- /theme JS files -->	
	
	<script>
		$(document).ready(function(){
			$('#DeleLccAll').on('click', function() {
				swal({
					title: "ดำเนินการล้างรายการเก็บบัตร",
					text: "ต้องการล้างค่ารายการเก็บบัตรทั้งหมด",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#FF7043",
					confirmButtonText: "ใช้"
				},function(DeleteLCC){
					if(DeleteLCC){
						document.location = "<?php echo base_url();?>Concert_pay/delete_lcc_admin/<?php echo $user_login;?>";
					}else{}
				});				
			})

		})
	</script>
	
	<script>
		$(document).ready(function(){
			$('#butgo').on('click', function() {
				document.location = "<?php echo base_url();?>?evaluation_mod=concert_pay";
			})
		})
	</script>
