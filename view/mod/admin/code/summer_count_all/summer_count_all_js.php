	<!-- Theme JS files colors_violet.html-->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/core.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/selectboxit.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/pnotify.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/noty.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/jgrowl.min.js"></script>
	<script>
		$(document).ready(function () {
			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-violet-400'
			});				
		})
	</script>
	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	
	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
	

	<!-- /theme JS files -->	
	
	<script>
		$(document).ready(function (){
			$("#sc_year").change(function (){
				var ScYear=$("#sc_year").val();
				var ScClass=$("#sc_class").val();
					if(ScYear!="" && ScClass!=""){
						$.post("view/mod/admin/code/summer_count_all/RunSummerCountAll.php",{
							txtyear:ScYear,
							txtclass:ScClass
						},function(sc){
							if(sc!=""){
								$("#RunSummerCount").html(sc)
							}else{}
						})
					}else{}
			})
		})
	</script>
	
	<script>
		$(document).ready(function (){
			$("#sc_class").change(function (){
				var ScYear=$("#sc_year").val();
				var ScClass=$("#sc_class").val();
					if(ScYear!="" && ScClass!=""){
						$.post("view/mod/admin/code/summer_count_all/RunSummerCountAll.php",{
							txtyear:ScYear,
							txtclass:ScClass
						},function(sc){
							if(sc!=""){
								$("#RunSummerCount").html(sc)
							}else{}
						})
					}else{}
			})
		})
	</script>			
	
	<script>
		$(document).ready(function (){
			$("#asj_go").on("click",function (){
				document.location ="<?php echo $golink;?>/?evaluation_mod=summer_count_all";
			})
		})
	</script>