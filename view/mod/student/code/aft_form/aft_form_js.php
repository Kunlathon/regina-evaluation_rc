    <script type="text/javascript" src="view/js_css_code/Product-Zoom-On-Hover-Plugin-For-jQuery-imgZoom-js/imgZoom/jquery.imgzoom.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.imgBox').imgZoom({
				boxWidth: 400,
				boxHeight: 400,
				marginLeft: 5,
				origin: 'data-origin'
			});				
		});
    </script>
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

<?php
		$evaluation_oeq="SELECT `evaluation_oeqid`,`evaluation_oeqtxt` FROM `evaluation_oeq`";
		$evaluation_oeqRs=rc_array($evaluation_oeq);
			
		foreach($evaluation_oeqRs as $rc_key=>$evaluation_oeqRow){ ?>
		
<script>
	$(document).ready(function(){
		var txt_length=1000;
		$("#<?php echo $evaluation_oeqRow["evaluation_oeqid"];?>").keyup(function(){
			var key_length=txt_length-$(this).val().length;
			if(key_length<0){
				$(this).val($(this).val().substr(0,1000));
			}else{
				$("#print_<?php echo $evaluation_oeqRow["evaluation_oeqid"];?>").html(key_length+" ตัวอักษร")
			}
		})
		
		
	});
</script>		
		
<?php	} ?>



	

	