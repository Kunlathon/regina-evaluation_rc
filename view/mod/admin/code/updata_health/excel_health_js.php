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
			$("#ex_term,#ex_year").change(function (){
				var ex_term=$("#ex_term").val();
				var ex_year=$("#ex_year").val();
				if(ex_term !="" && ex_year !=""){
					$.post("view/mod/admin/code/updata_health/excel_health_run.php",{
						txt_term:ex_term,
						txt_year:ex_year
					},function(print_excel){
						if(print_excel !=""){
							$("#run_excel").html(print_excel)
						}
					})
				}
			})
		})
	</script>

	<script>
		$(document).ready(function () {
			$("#ex2_term,#ex2_year").change(function (){
				var ex2_term=$("#ex2_term").val();
				var ex2_year=$("#ex2_year").val();
				if(ex2_term !="" && ex2_year !=""){
					$.post("view/mod/admin/code/updata_health/excel2_health_run.php",{
						txt2_term:ex2_term,
						txt2_year:ex2_year
					},function(print_excel2){
						if(print_excel2 !=""){
							$("#run_excel2").html(print_excel2)
						}
					})
				}
			})
		})
	</script>