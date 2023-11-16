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
					$.post("view/mod/admin/code/talent_category/count_room.php",{
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
					$.post("view/mod/admin/code/talent_category/count_room.php",{
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
			$("#stu_room").change(function (){
				var data_year=$("#stu_year").val();
				var data_class=$("#stu_class").val();
				var data_room=$("#stu_room").val();
				if(data_year!="" && data_class!="" && data_room!=""){
					$.post("view/mod/admin/code/talent_category/category.php",{
						txt_year:data_year,
						txt_class:data_class,
						txt_room:data_room
					},function(datarc){
						if(datarc!=""){
							$("#studata_room").html(datarc);
						}
					})
				}
				
			})	
		})
	</script>
	
	
	
	<script>
		$(document).ready(function () {
			$("#NGstu_year").change(function (){
				var data_year=$("#NGstu_year").val();
				var data_class=$("#NGstu_class").val();				
				if(data_year!="" && data_class!=""){
					$.post("view/mod/admin/code/talent_category/count_room.php",{
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
			$("#NGstu_class").change(function (){
				var data_year=$("#NGstu_year").val();
				var data_class=$("#NGstu_class").val();				
				if(data_year!="" && data_class!=""){
					$.post("view/mod/admin/code/talent_category/count_room.php",{
						txt_year:data_year,
						txt_class:data_class
					},function(datarc){
						if(datarc!=""){
							$("#NGstu_room").html(datarc);
						}
					})
				}
				
			})
		})
	</script>
	
	<script>
		$(document).ready(function () {	
			$("#NGstu_room").change(function (){
				var data_year=$("#NGstu_year").val();
				var data_class=$("#NGstu_class").val();
				var data_room=$("#NGstu_room").val();
				if(data_year!="" && data_class!="" && data_room!=""){
					$.post("view/mod/admin/code/talent_category/data.php",{
						txt_year:data_year,
						txt_class:data_class,
						txt_room:data_room
					},function(datarc){
						if(datarc!=""){
							$("#studata_room").html(datarc);
						}
					})
				}
				
			})	
		})
	</script>