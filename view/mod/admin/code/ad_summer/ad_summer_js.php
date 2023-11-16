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
			$('.select-menu-color').select2({
				containerCssClass: 'bg-violet-400',
				dropdownCssClass: 'bg-violet-400'
			});					
		})
	</script>
	
	<script>
		$(document).ready(function (){
			$(".styled").uniform({
				wrapperClass: "border-indigo text-indigo-600"
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
	<script src="Template/global_assets/js/demo_pages/datatables_extension_buttons_html5.js"></script>

	<!-- /theme JS files -->
	
	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>

	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->	
	
	
	<script>
		$(document).ready(function(){
			$("#ad_year").change(function(){
				var ad_year=$("#ad_year").val();
				var ad_term=1;	
					if(ad_year!="" && ad_term!=""){
						$.post("<?php echo $golink;?>/Summer/Data_Sud_Summer",{
							ad_year:ad_year,
							ad_term:ad_term
						},function(AS_Data){
							if(AS_Data!=""){
								$("#ad_sudkey").html(AS_Data)	
							}else{}
						})
					}else{}
			})
		})
	</script>
	
	<script>
		//$(document).ready(function(){
			function load_ad_summer(){
				var ad_year=$("#ad_year").val();
				var ad_term=1;	
					if(ad_year!="" && ad_term!=""){
						$.post("<?php echo $golink;?>/Summer/Data_Sud_Summer",{
							ad_year:ad_year,
							ad_term:ad_term
						},function(AS_Data){
							if(AS_Data!=""){
								$("#ad_sudkey").html(AS_Data)	
							}else{}
						})
					}else{}
			}
		//})
	</script>
	
	
	
	<script>
		$(document).ready(function (){
			$("#asj_go").on("click",function (){
				document.location ="<?php echo $golink;?>/?evaluation_mod=ad_summer";
			})
		})
	</script>