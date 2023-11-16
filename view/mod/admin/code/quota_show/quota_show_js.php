
	<!-- /theme JS files -->	
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>

	<!-- /theme JS files -->
	
	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/col_reorder.min.js"></script>




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
				var data_level=$("#txt_level").val();
				var data_year=$("#txt_year").val();
				if(data_year!="" && data_level!=""){
					$.post("view/mod/admin/code/quota_show/quota_show.php",{
						copy_level:data_level,
						copy_year:data_year
					},function(string_class){
						if(string_class !="" ){
							$("#data_stu").html(string_class)
						}
						
					})
				}
				
			})
			
		})
	
	</script>

