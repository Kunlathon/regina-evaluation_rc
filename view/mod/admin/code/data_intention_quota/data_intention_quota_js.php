<!-- Theme JS files colors_green-->
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
		$(document).ready(function () {
// Basic select2
			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-green-600'
			});
// Basic select2 End			
		})
	</script>
<!-- /theme JS files -->

<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>

	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>

	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
<!-- /theme JS files -->



	<script>
		$(document).ready(function () {
			$("#txt_year,#txt_level,#txt_MaintainRights").change(function (){
				var data_level=$("#txt_level").val();
				var data_year=$("#txt_year").val();
				var data_MaintainRights=$("#txt_MaintainRights").val();
				if(data_year!="" && data_level!="" && data_MaintainRights!=""){
					$.post("view/mod/admin/code/data_intention_quota/intention_quota.php",{
						copy_level:data_level,
						copy_year:data_year,
						copy_MaintainRights:data_MaintainRights
					},function(intention_class){
						if(intention_class !="" ){
							$("#data_intention").html(intention_class)
						}
						
					})
				}
				
			})
			
		})
	
	</script>
	
	

	

	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	