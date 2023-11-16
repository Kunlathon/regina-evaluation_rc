	<!-- /theme JS files -->
	
	<script src="Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="Template/global_assets/js/plugins/editors/wysihtml5/wysihtml5.min.js"></script>
	<script src="Template/global_assets/js/plugins/editors/wysihtml5/toolbar.js"></script>
	<script src="Template/global_assets/js/plugins/editors/wysihtml5/parsers.js"></script>
	<script src="Template/global_assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/jgrowl.min.js"></script>




	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	
	<script>
		$(document).ready(function () {

			// Simple toolbar
			$('.wysihtml5-min').wysihtml5({
				parserRules:  wysihtml5ParserRules,
				stylesheets: ["Template/layout_2/LTR/material/full/assets/css/components.css"],
				"font-styles": true, // Font styling, e.g. h1, h2, etc. Default true
				"emphasis": true, // Italics, bold, etc. Default true
				"lists": true, // (Un)ordered lists, e.g. Bullets, Numbers. Default true
				"html": true, // Button which allows you to edit the generated HTML. Default false
				"link": true, // Button to insert a link. Default true
				"image": false, // Button to insert an image. Default true,
				"action": false, // Undo / Redo buttons,
				"color": true // Button to change color of font
			});

			
		})
	</script>