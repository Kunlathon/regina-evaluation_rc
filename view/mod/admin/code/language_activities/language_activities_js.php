	<!-- Theme JS files form_select2-->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>

	<script src="Template/global_assets/js/demo_pages/form_select2.js"></script>
	<!-- /theme JS files -->
	
	<script>
		$(document).ready(function(){
			$('.select').select2({
				minimumResultsForSearch: Infinity
			});			
		})
	</script>
	
	<script>
		$(document).ready(function (){
			$("#goback").on("click",function (){
				document.location ="<?php echo $golink;?>/?evaluation_mod=language_activities";
			})
		})
	</script>