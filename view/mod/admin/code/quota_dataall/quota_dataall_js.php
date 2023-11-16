	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>

	<!-- /theme JS files -->

	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>



	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->


	<!-- /theme JS files -->
	
	
	<script>
		$(document).ready(function () {		
			$('.select').select2({
				minimumResultsForSearch: Infinity
			});
		})	
	</script>

	<script>
		$(document).ready(function () {
			$("#txt_year,#txt_level").change(function (){
				var data_year=$("#txt_year").val();
				var data_level=$("#txt_level").val();
				if(data_year!="" && data_level!=""){
					$.post("view/mod/admin/code/quota_dataall/print_dataall.php",{
						copy_level:data_level,
						copy_year:data_year
					},function(print_quota){
						if(print_quota !="" ){
							$("#show_quota_dataall").html(print_quota)
						}
						
					})
				}
				
			})
			
		})
	
	</script>
	
	
	

	
	
	
	
	
	
	
	