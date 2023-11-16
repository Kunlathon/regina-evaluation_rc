	<!-- Theme JS files -->
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

$(document).ready(function (){
// Checkboxes and radios
    $(".styled").uniform({
        wrapperClass: "border-pink text-pink-600"
    });	
// Checkboxes and radios End

// Basic select2
    $('.select').select2({
        minimumResultsForSearch: Infinity,
        containerCssClass: 'bg-pink'
    });	
// Basic select2 End	
// File input
    $(".file-styled").uniform({
        fileButtonClass: 'action btn bg-pink'
    });
// File input End
})
	</script>
	<!-- /theme JS files -->


	
	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>

	<script src="Template/global_assets/js/demo_pages/form_select2.js"></script>

	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	
	<script>
		$(document).ready(function (){
			$("#goto").click(function(){
				document.location="<?php echo $golink;?>/?evaluation_mod=rc_quota"
			})
		})
	</script>
	
	
	
	<script>
		$(document).ready(function (){
			$("#gotopdfM1").click(function(){
				document.location="<?php echo $golink;?>/view/img_user/document/pdf/q2567_31.pdf";

			})
		})
	</script>
	
	<script>
		$(document).ready(function (){
			$("#gotopdfM4").click(function(){
				document.location="<?php echo $golink;?>/view/img_user/document/pdf/q2567_41.pdf";
				
			})
		})
	</script>
	