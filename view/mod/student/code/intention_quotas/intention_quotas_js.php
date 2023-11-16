	<!-- Theme JS files componebts_modats-->
	<script src="Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<!-- /theme JS files -->	
	
	<!-- Theme JS files form_validation.html-->
	<script src="Template/global_assets/js/plugins/forms/validation/validate.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/inputs/touchspin.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/styling/switch.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	
	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	<!-- Theme JS files colors_teal.html-->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/core.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/selectboxit.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/pnotify.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/noty.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/jgrowl.min.js"></script>
	
	<!-- /theme JS files colors_teal.html-->
	
	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jasny_bootstrap.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/tags/tagsinput.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/tags/tokenfield.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/inputs/maxlength.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/inputs/formatter.min.js"></script>
	<!-- /theme JS files -->
	
	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<!-- /theme JS files -->	
	
<!--****************************************************************************-->	
	<script>
		$(function() {
			$("#RunLoadTalent").fadeOut(5000, function() {
				$("#RuningLoadTalent").fadeIn(4000);
			});
		});
	</script>	
	<script>
		$(function() {
			$("#RunLoadQuotasCode").fadeOut(5000, function() {
				$("#RuningLoadQuotasCode").fadeIn(4000);
			});
		});
	</script>
<!--****************************************************************************-->
	<script>
		$(document).ready(function(){
			$("#buttonA").click(function(){
				document.location="./?evaluation_mod=intention_quotas";
			})
			$("#buttonB").click(function(){
				document.location="./?evaluation_mod=home";
			})			
		})
	</script>
	<script>   
		$(document).ready(function(){
			
	// Set the date we're counting down to
		var countDownDate = new Date("Dec 01, 2023 00:00:00").getTime();

	// Update the count down every 1 second
		var x = setInterval(function() {

	// Get today's date and time
		var now = new Date().getTime();
    
	// Find the distance between now and the count down date
		var distance = countDownDate - now;
    
	// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
	// Output the result in an element with id="demo"
		document.getElementById("demoA").innerHTML = days + " วัน " + hours + " ชั่วโมง "
		+ minutes + " นาที " + seconds + " วินาที ";
    
	// If the count down is over, write some text 
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("demoA").innerHTML = "EXPIRED";
			}
		//}, 1000);		
		  }, );
		});
	</script>
	
	<script>   
		$(document).ready(function(){
			
	// Set the date we're counting down to
		var countDownDate = new Date("Dec 01, 2023 00:00:00").getTime();

	// Update the count down every 1 second
		var x = setInterval(function() {

	// Get today's date and time
		var now = new Date().getTime();
    
	// Find the distance between now and the count down date
		var distance = countDownDate - now;
    
	// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
	// Output the result in an element with id="demo"
		document.getElementById("demoB").innerHTML = days + " วัน " + hours + " ชั่วโมง "
		+ minutes + " นาที " + seconds + " วินาที ";
    
	// If the count down is over, write some text 
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("demoB").innerHTML = "EXPIRED";
			}
		//}, 1000);		
		  }, );
		});
	</script>