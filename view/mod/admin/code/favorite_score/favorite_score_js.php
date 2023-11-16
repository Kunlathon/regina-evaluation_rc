	
	<script src="Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
	
	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>

	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>


	<script src="Template/global_assets/js/demo_pages/form_select2.js"></script>
	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	
	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script src="Template/global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>


	<script src="Template/global_assets/js/demo_pages/general_widgets_stats.js"></script>

	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->	
	
	
	<script>
		$(document).ready(function () {
			$("#txt_year").change(function (){
				var data_count=$("#txt_count").val();
				var data_year=$("#txt_year").val();
				if(data_year!="" && data_count!=""){
					$.post("view/mod/admin/code/favorite_score/score.php",{
						copy_count:data_count,
						copy_year:data_year
					},function(string_class){
						if(string_class !="" ){
							$("#print_class").html(string_class)
						}
						
					})
				}
				
			})
			
		})
	
	</script>
		<script>
		$(document).ready(function () {
			$("#txt_count").change(function (){
				var data_count=$("#txt_count").val();
				var data_year=$("#txt_year").val();
				if(data_year!="" && data_count!=""){
					$.post("view/mod/admin/code/favorite_score/score.php",{
						copy_count:data_count,
						copy_year:data_year
					},function(string_class){
						if(string_class !="" ){
							$("#print_class").html(string_class)
						}
						
					})
				}
				
			})
			
		})
	
	</script>