	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>

	<script src="Template/global_assets/js/demo_pages/form_select2.js"></script>
	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	
	
	<script src="Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>

	


	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>	
	
	
	<script>
		$(document).ready(function () {
			$("#txt_class").change(function (){
				var data_class=$("#txt_class").val();
				var data_year=$("#txt_year").val();
				var data_term=$("#txt_term").val();
				if(data_class !="" && data_year!="" && data_term!="" ){
					$.post("view/mod/admin/code/sar_grade/sar_grade.php",{
						copy_class:data_class,
						copy_year:data_year,
						copy_term:data_term
					},function(string_data){
						if(string_data !="" ){
							$("#print_data").html(string_data)
						}
						
					})
				}
				
			})
			
		})
	
	</script>
	<script>
		$(document).ready(function () {
			$("#txt_year").change(function (){
				var data_class=$("#txt_class").val();
				var data_year=$("#txt_year").val();
				var data_term=$("#txt_term").val();
				if(data_class !="" && data_year!="" && data_term!="" ){
					$.post("view/mod/admin/code/sar_grade/sar_grade.php",{
						copy_class:data_class,
						copy_year:data_year,
						copy_term:data_term
					},function(string_data){
						if(string_data !="" ){
							$("#print_data").html(string_data)
						}
						
					})
				}
				
			})
			
		})
	
	</script>	
	<script>
		$(document).ready(function () {
			$("#txt_term").change(function (){
				var data_class=$("#txt_class").val();
				var data_year=$("#txt_year").val();
				var data_term=$("#txt_term").val();
				if(data_class !="" && data_year!="" && data_term!="" ){
					$.post("view/mod/admin/code/sar_grade/sar_grade.php",{
						copy_class:data_class,
						copy_year:data_year,
						copy_term:data_term
					},function(string_data){
						if(string_data !="" ){
							$("#print_data").html(string_data)
						}
						
					})
				}
				
			})
			
		})
	
	</script>	
	