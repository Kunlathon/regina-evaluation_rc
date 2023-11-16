	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>


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
			$("#stu_year").change(function (){
				var data_year=$("#stu_year").val();
				var data_class=$("#stu_class").val();				
				if(data_year!="" && data_class!=""){
					$.post("view/mod/admin/code/activity_show/activity_run.php",{
						txt_year:data_year,
						txt_class:data_class
					},function(datarc){
						if(datarc!=""){
							$("#stu_room").html(datarc);
						}
					})
				}
				
			})
		})
	</script>	
	<script>
		$(document).ready(function () {
			$("#stu_class").change(function (){
				var data_year=$("#stu_year").val();
				var data_class=$("#stu_class").val();				
				if(data_year!="" && data_class!=""){
					$.post("view/mod/admin/code/activity_show/activity_run.php",{
						txt_year:data_year,
						txt_class:data_class
					},function(datarc){
						if(datarc!=""){
							$("#stu_room").html(datarc);
						}
					})
				}
				
			$(".RunLoad").fadeOut(5000, function() {
				$(".RuningLoad").fadeIn(4000);
			});	
				
			})
		})
	</script>