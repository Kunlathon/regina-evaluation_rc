	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>


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
			$("#txt_year,#txt_term").change(function (){
				var data_term=$("#txt_term").val();
				var data_year=$("#txt_year").val();
				if(data_year!="" && data_term!=""){
					$.post("view/mod/admin/code/supplementary/pay_supplementaryqr.php",{
						copy_term:data_term,
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
	
