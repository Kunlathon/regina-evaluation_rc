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
			$("#cilk_true3133").click(function (){
				var txt_cilk=$("#cilk_true3133").val();
				var txt_yaer=$("#copy_yaer").val();
				var txt_term=$("#copy_term").val();
				var txt_login=$("#copy_login").val();
				if(txt_cilk!="" && txt_yaer!="" && txt_term!="" && txt_login!=""){
					$.post("view/mod/student/code/stu_supplementary/show_cilk3133.php",{
						call_clik:txt_cilk,
						call_yaer:txt_yaer,
						call_term:txt_term,
						call_login:txt_login
					},function(city3133){
						if(city3133!=""){
							$("#show_cilk3133").html(city3133);
						}
						
					})
				}
				
			})	
		})
	</script>
	
	<script>
		$(document).ready(function(){
			$("#cilk_flas3133").click(function (){
				var txt_cilk=$("#cilk_flas3133").val();
				var txt_yaer=$("#copy_yaer").val();
				var txt_term=$("#copy_term").val();
				var txt_login=$("#copy_login").val();
				if(txt_cilk!="" && txt_yaer!="" && txt_term!="" && txt_login!=""){
					$.post("view/mod/student/code/stu_supplementary/show_cilk3133.php",{
						call_clik:txt_cilk,
						call_yaer:txt_yaer,
						call_term:txt_term,
						call_login:txt_login
					},function(city3133){
						if(city3133!=""){
							$("#show_cilk3133").html(city3133);
						}
						
					})
				}
				
			})	
		})
	</script>
	
	
	<script>
		$(document).ready(function(){
			$("#cilk_true4143").click(function (){
				var txt_cilk=$("#cilk_true4143").val();
				var txt_yaer=$("#copy_yaer").val();
				var txt_term=$("#copy_term").val();
				var txt_login=$("#copy_login").val();
				if(txt_cilk!="" && txt_yaer!="" && txt_term!="" && txt_login!=""){
					$.post("view/mod/student/code/stu_supplementary/show_cilk4143.php",{
						call_clik:txt_cilk,
						call_yaer:txt_yaer,
						call_term:txt_term,
						call_login:txt_login
					},function(city3133){
						if(city3133!=""){
							$("#show_cilk4143").html(city3133);
						}
						
					})
				}
				
			})	
		})
	</script>
	
	<script>
		$(document).ready(function(){
			$("#cilk_flas4143").click(function (){
				var txt_cilk=$("#cilk_flas4143").val();
				var txt_yaer=$("#copy_yaer").val();
				var txt_term=$("#copy_term").val();
				var txt_login=$("#copy_login").val();
				if(txt_cilk!="" && txt_yaer!="" && txt_term!="" && txt_login!=""){
					$.post("view/mod/student/code/stu_supplementary/show_cilk4143.php",{
						call_clik:txt_cilk,
						call_yaer:txt_yaer,
						call_term:txt_term,
						call_login:txt_login
					},function(city3133){
						if(city3133!=""){
							$("#show_cilk4143").html(city3133);
						}
						
					})
				}
				
			})	
		})
	</script>


	<script>
		$(document).ready(function(){
			$("#copy_ss_id").change(function(){
				var copy_ssid=$("#copy_ss_id").val();
				var copy_yaer=$("#data_yaer").val();
				var copy_term=$("#data_term").val();
				if(copy_ssid!="" && copy_yaer!="" && copy_term!=""){
					$.post("view/mod/student/code/stu_supplementary/activity.php",{
						call_ssid:copy_ssid,
						call_yaer:copy_yaer,
						call_term:copy_term
					},function(data){
						if(data !=""){
							$("#show_data").html(data)
						}
					})
				}
			})

		})
	</script>
	
	
<!-- theme JS files -->
	<script>   
		$(document).ready(function(){
			
	// Set the date we're counting down to 2022-12-01 00:00:00
		var countDownDate = new Date("Jul 01, 2023 00:00:00").getTime();

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
			}else{}
		//}, 1000);		
		  }, );
		});
	

	</script>
<!-- /theme JS files -->