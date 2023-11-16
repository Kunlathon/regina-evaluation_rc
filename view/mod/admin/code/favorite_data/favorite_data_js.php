	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>

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
				//var data_class=$("#txt_class").val();
				var data_year=$("#txt_year").val();
				if(data_year!=""){
					$.post("view/mod/admin/code/favorite_data/favorite.php",{
						//copy_class:data_class,
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
	
	