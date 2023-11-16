	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>

	<script src="Template/global_assets/js/demo_pages/form_select2.js"></script>
	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	
	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>

	<!-- Theme JS files -->
		
	<script>
		$(document).ready(function () {
			$("#txt_term").change(function (){
				var data_term=$("#txt_term").val();
				var data_year=$("#txt_year").val();
				var data_oc=$("#txt_oc").val();
				if(data_term !="" && data_year!="" && data_oc!=""){
					$.post("view/mod/admin/code/overdue/overdue_data.php",{
						copy_term:data_term,
						copy_year:data_year,
						copy_oc:data_oc
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
			$("#txt_oc").change(function (){
				var data_term=$("#txt_term").val();
				var data_year=$("#txt_year").val();
				var data_oc=$("#txt_oc").val();
				if(data_term !="" && data_year!="" && data_oc!=""){
					$.post("view/mod/admin/code/overdue/overdue_data.php",{
						copy_term:data_term,
						copy_year:data_year,
						copy_oc:data_oc
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
			$("#txt_year").change(function (){
				var data_term=$("#txt_term").val();
				var data_year=$("#txt_year").val();
				var data_oc=$("#txt_oc").val();
				if(data_term !="" && data_year!="" && data_oc!=""){
					$.post("view/mod/admin/code/overdue/overdue_data.php",{
						copy_term:data_term,
						copy_year:data_year,
						copy_oc:data_oc
					},function(string_class){
						if(string_class !="" ){
							$("#print_class").html(string_class)
						}
						
					})
				}
				
			})
			
		})
	
	</script>