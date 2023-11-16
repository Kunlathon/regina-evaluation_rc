	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>

	<script src="Template/global_assets/js/demo_pages/form_select2.js"></script>

	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>



<input type="hidden" name="rsi_student" id="rsi_student" value="<?php echo $Result_student_id;?>">

	<script>
		$(document).ready(function (){
			$("#tg").change(function (){
				var enter_tg=$("#tg").val();
				var rsi_student=$("#rsi_student").val();
				var count_t=$("#count_t").val();
				if(enter_tg !=""){
					$.post("view/mod/student/code/favorite_teacher/favorite.php",{
						data_tg: enter_tg,
						data_studentid: rsi_student,
						stucount_t: count_t
					}, function(txt_rc){
						if(txt_rc !=""){
							$("#show_enter").html(txt_rc)
						}
					})
				}
			})
			
		});
	
	</script>
	
<!-- theme JS files -->
	<script>   
		$(document).ready(function(){
			
	// Set the date we're counting down to
		var countDownDate = new Date("Jan 15, 2020 00:59:00").getTime();

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
				document.getElementById("demo").innerHTML = "ปิดโหวตคุณครูในดวงใจของหนู";
			}
		}, 1000);		
		
		});
	

</script>
<!-- /theme JS files -->	

