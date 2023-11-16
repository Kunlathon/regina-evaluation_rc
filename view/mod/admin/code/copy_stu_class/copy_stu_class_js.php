<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>	
<!-- /theme JS files -->

<!-- Theme JS files colors_primary.html-->
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
	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>

	<script>
	$(document).ready(function () {	
		// Basic select2
		$('.select').select2({
			minimumResultsForSearch: Infinity,
			containerCssClass: 'bg-primary',
			allowClear: true
		});		
	})
	</script>
<!-- /theme JS files -->

<!-- Theme JS files components_buttons.html-->
	<script src="Template/global_assets/js/plugins/velocity/velocity.min.js"></script>
	<script src="Template/global_assets/js/plugins/velocity/velocity.ui.min.js"></script>
	<script src="Template/global_assets/js/plugins/buttons/spin.min.js"></script>
	<script src="Template/global_assets/js/plugins/buttons/ladda.min.js"></script>

	<script>
	$(document).ready(function () {	
		// Buttons with progress/spinner
		// ------------------------------

		// Initialize on button click
		$('.btn-loading').on('click', function () {
			var btn = $(this);
			btn.button('loading')
			setTimeout(function () {
				btn.button('reset')
			}, 3000)
		});

		// Button with spinner
		Ladda.bind('.btn-ladda-spinner', {
			dataSpinnerSize: 16,
			timeout: 2000
		});

		// Button with progress
		Ladda.bind('.btn-ladda-progress', {
			callback: function(instance) {
				var progress = 0;
				var interval = setInterval(function() {
					progress = Math.min(progress + Math.random() * 0.1, 1);
					instance.setProgress(progress);

					if( progress === 1 ) {
						instance.stop();
						clearInterval(interval);
					}
				}, 200);
			}
		});



		// Animated dropdowns
		// ------------------------------

		// CSS3 animations
		$('.dropdown-animated, .btn-group-animated').on('show.bs.dropdown', function(e){
			$(this).find('.dropdown-menu').addClass('animated bounceIn').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).removeClass('animated bounceIn')
			});
		});


		//
		// Velocity animations
		//

		// Open
		$('.dropdown-velocity, .btn-group-velocity').on('show.bs.dropdown', function(e){
			$(this).find('.dropdown-menu').velocity('transition.slideUpIn', {
				duration: 200
			})
		});

		// Close
		$('.dropdown-velocity, .btn-group-velocity').on('hide.bs.dropdown', function(e){
			$(this).find('.dropdown-menu').velocity('transition.slideLeftOut', {
				duration: 200,
				complete: function() {
					$(this).removeAttr('style');
				}
			})
		});


		//
		// jQuery animations
		//

		// Open
		$('.dropdown-fade, .btn-group-fade').on('show.bs.dropdown', function(e){
			$(this).find('.dropdown-menu').fadeIn(250);
		});

		// Close
		$('.dropdown-fade, .btn-group-fade').on('hide.bs.dropdown', function(e){
			$(this).find('.dropdown-menu').fadeOut(250);
		});	
	})
	</script>
<!-- /theme JS files -->
	<script>
	$(document).ready(function () {	
		$('#button_run').on('click', function() {
			swal({
				title: "คุณแน่ใจใช้ไหม...",
				text: "คุณต้องการคัดลอกข้อมูล ภาคเรียนที่ 1 ไป ภาคเรียนที่ 2",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#FF7043",
				confirmButtonText: "ใช้ ต้องการคัดลอก"
			},function(buttonrun){
				if(buttonrun){
					var data_year=$("#stu_year").val();
					if(data_year!=""){
						$.post("view/mod/admin/code/copy_stu_class/load_class.php",{
							txt_year:data_year
						},function(datarc){
							if(datarc!=""){
								$("#stu_class").html(datarc);
							}
						})
					}else{
						//----------------------------------------------------------
					}					
				}else{
					//---------------------------------------------------------------
				}
			});
		});
	})
	</script>

	<script>
	$(document).ready(function () {
		$('#cp_csc').on('click', function(cpcsc){
			if(cpcsc!=""){
				document.location="./?evaluation_mod=copy_stu_class";
			}else{
				//----------------------
			}			
		})
	})
	</script>
	
