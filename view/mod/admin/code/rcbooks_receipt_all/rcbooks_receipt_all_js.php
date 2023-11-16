	<!-- Theme JS files form_select2.html-->
	<script src="<?php echo $golink;?>/Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<script>
	$(document).ready(function () {
	    $('.select').select2({
			minimumResultsForSearch: Infinity
		});		
	})
	</script>
	<!-- /theme JS files -->