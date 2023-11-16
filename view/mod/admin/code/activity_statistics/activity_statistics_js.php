	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>


	<!-- /theme JS files -->
	

<!--****************************************************************************-->		
	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/visualization/echarts/echarts.min.js"></script>
	<!-- /theme JS files -->	
<!--****************************************************************************-->	

	
	<script>
		$(document).ready(function () {
	// Default initialization
			$('.select').select2({
			minimumResultsForSearch: Infinity
			});
    // Select with search
			$('.select-search').select2();	
		})
	</script>
	



	
	<script>
		$(document).ready(function () {
			$("#run_data").click(function (){
				
					


	
 
				
				var data_year=$("#stu_year").val();	



				
					if(data_year!=""){
						$.post("view/mod/admin/code/activity_statistics/statistice.php",{
						txt_year:data_year
					},function(statistics){
						if(statistics!=""){

							$("#stu_statistics").html(statistics);
							
														$("#preload").fadeOut(2000, function() {
			$("#content").fadeIn(1000);
		});
		
							
						}
					})
				}
				
				
			})
		})
	</script>