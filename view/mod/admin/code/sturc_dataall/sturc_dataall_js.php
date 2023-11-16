	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>

	<script src="Template/global_assets/js/demo_pages/form_select2.js"></script>
	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	
	<script src="Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	
	<script>
		$(document).ready(function () {
			$("#stu_year,#txt_status").change(function (){
				var data_year=$("#stu_year").val();
				var data_status=$("#txt_status").val();
				var data_myname=$("#myname").val();
				if(data_year !="" && data_status!=""){
					$.post("view/mod/admin/code/sturc_dataall/stu_dataall.php",{
						copy_year:data_year,
						copy_status:data_status,
						copy_myname:data_myname
					},function(string_data){
						if(string_data !="" ){
							$("#print_data").html(string_data)
						}
						
					})
				}
				
			})
			
		})
	</script>
