	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script src="Template/global_assets/js/plugins/visualization/c3/c3.min.js"></script>
	
	<script src="Template/global_assets/js/demo_pages/charts/c3/c3_bars_pies.js"></script>

	<!-- /theme JS files -->	
		
<!-- theme JS files -->
	<script>   
		$(document).ready(function(){
			
	// Set the date we're counting down to
		var countDownDate = new Date("Mar 06, 2020 00:59:00").getTime();

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
		document.getElementById("demo").innerHTML = days + " วัน " + hours + " ชั่วโมง "
		+ minutes + " นาที " + seconds + " วินาที ";
    
	// If the count down is over, write some text 
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("demo").innerHTML = "EXPIRED";
			}
		//}, 1000);		
		  }, );
		});
	

</script>
<!-- /theme JS files -->