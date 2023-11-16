	<!-- Theme JS files ###colors_slate-->
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
	<!-- /theme JS files -->
	
	<script>
		$(document).ready(function () {
			$('.select-menu-color').select2({
				containerCssClass: 'bg-slate',
				dropdownCssClass: 'bg-slate'
			});
		})
	</script>
	
	<script>
		$(document).ready(function () {
			$("#wu_c").change(function (){
				var Wut=$("#wu_t").val();
				var Wuy=$("#wu_y").val();
				var Wuc=$("#wu_c").val();
					if(Wut!="" && Wuy!="" && Wuc!=""){
						$.post("<?php echo base_url();?>/Weekend_class/weekend_use",{
							Wut:Wut,
							Wuy:Wuy,
							Wuc:Wuc
						},function(wu){
							if(wu!=""){
								$("#RunWu").html(wu)
							}else{}
						})
					}else{}
			})
		})	
	</script>
	
	
	
	
	