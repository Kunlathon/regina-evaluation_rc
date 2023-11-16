	<!-- Theme JS files colors_brown-->
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery_ui/core.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/selectboxit.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/pnotify.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/noty.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/jgrowl.min.js"></script>

	<script>
		$(document).ready(function () {	
			// Basic select2
			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-brown'
			});


			// Select2 ultiselect item color
			$('.select-item-color').select2({
				containerCssClass: 'bg-brown'
			});


			// Select2 dropdown menu color
			$('.select-menu-color').select2({
				containerCssClass: 'bg-brown',
				dropdownCssClass: 'bg-brown'
			});


			// Multiselect
			$('.multiselect').multiselect({
				buttonClass: 'btn bg-brown',
				nonSelectedText: 'Select your state'
			});


			// SelectBoxIt
			$(".selectbox").selectBoxIt({
				autoWidth: false,
				theme: "bootstrap"
			});


			// Bootstrap select
			$.fn.selectpicker.defaults = {
				iconBase: '',
				tickIcon: 'icon-checkmark-circle'
			}
			$('.bootstrap-select').selectpicker();



			// Notifications
			// ------------------------------

			// jGrowl
			$('.growl-launch').on('click', function () {
				$.jGrowl('I am a well highlighted brown notice..', { theme: 'bg-brown-400', header: 'Well highlighted' });
			});


			// PNotify
			$('.pnotify-launch').on('click', function () {
				new PNotify({
					title: 'brown Notice',
					text: 'Check me out! I\'m a notice.',
					icon: 'icon-brown22',
					delay: 5000,
					addclass: 'bg-brown-400'
				});
			});



			// Form components
			// ------------------------------

			// Switchery toggle
			var switchery = document.querySelector('.switch');
			var init = new Switchery(switchery, {color: '#795548'});


			// Checkboxes and radios
			$(".styled").uniform({
				wrapperClass: "border-brown text-brown-600"
			});


			// File input
			$(".file-styled").uniform({
				fileButtonClass: 'action btn bg-brown'
			});



			// Popups
			// ------------------------------

			// Tooltip
			$('[data-popup=tooltip-custom]').tooltip({
				template: '<div class="tooltip"><div class="bg-brown"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div></div>'
			});


			// Popover title
			$('[data-popup=popover-custom]').popover({
				template: '<div class="popover border-brown"><div class="arrow"></div><h3 class="popover-title bg-brown"></h3><div class="popover-content"></div></div>'
			});


			// Popover background color
			$('[data-popup=popover-solid]').popover({
				template: '<div class="popover bg-brown"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
			});
		})
	</script>

	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	
	
	<script>
		$(document).ready(function (){
			$("#ws_ty").change(function (){
				var WsTY=$("#ws_ty").val();
					if(WsTY!=""){
						$.post("<?php echo base_url();?>/Weekend_class/statistics",{
							WsTY:WsTY
						},function(ws){
							if(ws!=""){
								$("#RunStatistics").html(ws)
							}else{}
						})
					}else{}
			})
		})
	</script>
	
	
	
	
	