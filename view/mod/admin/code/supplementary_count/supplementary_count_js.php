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
			$("#set_term,#set_year,#set_class").change(function (){
				var data_term=$("#set_term").val();
				var data_year=$("#set_year").val();
				var data_class=$("#set_class").val();
				if(data_term !="" && data_year !="" && data_class !=""){
					$.post("view/mod/admin/code/supplementary_count/supplementary_count.php",{
						copy_term:data_term,
						copy_year:data_year,
						copy_class:data_class
					},function(supplementary){
						if(supplementary !="" ){
							$("#print_supplementary").html(supplementary)
						}
						
					})
				}
				
			})
			
		})
	
	</script>

	
