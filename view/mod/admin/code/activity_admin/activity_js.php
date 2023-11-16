	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/styling/switch.min.js"></script>


	<script src="Template/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>

	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	
	
	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>




	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	
	
	<!-- Theme JS files components_modals-->
	<script src="Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<!-- /theme JS files -->
	
	

    <script type="text/javascript">
        function setScreenHWCookie() {
            $.cookie('sw',screen.width);
                //$.cookie('sh',screen.height);
            return true;
        }
            setScreenHWCookie();
    </script>

    <?php
		$width_system=filter_input(INPUT_COOKIE,'sw');
		if($width_system>=1200){
			$grid="lg";
		}elseif($width_system<=992){
			$grid="md";
		}elseif($width_system<=768){
			$grid="sm";
		}else{
			$grid="xs";
		}
    ?>
	<script>
		$(document).ready(function(){
			
			$('.select-search').select2();
				
			$('.select-size-<?php echo $grid;?>').select2({
				containerCssClass: 'select-<?php echo $grid;?>'
			});
			
		})
	</script>
	
	<script>   
		$(document).ready(function(){
			
	// Set the date we're counting down to
		var countDownDate = new Date("May 21, 2022 00:00:00").getTime();

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
		var countDownDate = new Date("May 22, 2022 00:00:00").getTime();

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

	<script>   
		$(document).ready(function(){
			
	// Set the date we're counting down to
		var countDownDate = new Date("May 23, 2022 00:00:00").getTime();

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
		document.getElementById("demoC").innerHTML = days + " วัน " + hours + " ชั่วโมง "
		+ minutes + " นาที " + seconds + " วินาที ";
    
	// If the count down is over, write some text 
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("demoC").innerHTML = "EXPIRED";
			}
		//}, 1000);		
		  }, );
		});
	</script>	
	
	<script>   
		$(document).ready(function(){
			
	// Set the date we're counting down to
		var countDownDate = new Date("May 24, 2022 00:00:00").getTime();

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
		document.getElementById("demoD").innerHTML = days + " วัน " + hours + " ชั่วโมง "
		+ minutes + " นาที " + seconds + " วินาที ";
    
	// If the count down is over, write some text 
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("demoD").innerHTML = "EXPIRED";
			}
		//}, 1000);		
		  }, );
		});
	</script>