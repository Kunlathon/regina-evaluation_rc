<style>
#RuningLoad {
	display:none;
}
</style>


	<!-- Theme JS files colors_pink.html-->
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
			// Selects
			// ------------------------------

			// Basic select2
			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-pink'
			});


			// Select2 ultiselect item color
			$('.select-item-color').select2({
				containerCssClass: 'bg-pink'
			});


			// Select2 dropdown menu color
			$('.select-menu-color').select2({
				containerCssClass: 'bg-pink',
				dropdownCssClass: 'bg-pink'
			});


			// Multiselect
			$('.multiselect').multiselect({
				buttonClass: 'btn bg-pink',
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
				$.jGrowl('I am a well highlighted pink notice..', { theme: 'bg-pink-400', header: 'Well highlighted' });
			});


			// PNotify
			$('.pnotify-launch').on('click', function () {
				new PNotify({
					title: 'pink Notice',
					text: 'Check me out! I\'m a notice.',
					icon: 'icon-pink22',
					delay: 5000,
					addclass: 'bg-pink-400'
				});
			});



			// Form components
			// ------------------------------

			// Switchery toggle
			var switchery = document.querySelector('.switch');
			var init = new Switchery(switchery, {color: '#E91E63'});


			// Checkboxes and radios
			$(".styled").uniform({
				wrapperClass: "border-pink text-pink-600"
			});


			// File input
			$(".file-styled").uniform({
				fileButtonClass: 'action btn bg-pink'
			});



			// Popups
			// ------------------------------

			// Tooltip
			$('[data-popup=tooltip-custom]').tooltip({
				template: '<div class="tooltip"><div class="bg-pink"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div></div>'
			});


			// Popover title
			$('[data-popup=popover-custom]').popover({
				template: '<div class="popover border-pink"><div class="arrow"></div><h3 class="popover-title bg-pink"></h3><div class="popover-content"></div></div>'
			});


			// Popover background color
			$('[data-popup=popover-solid]').popover({
				template: '<div class="popover bg-pink"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
			});			
		})
	</script>
	<!-- /theme JS files -->
	
	<!-- Theme JS files components_modals.html-->
	<script src="Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<!-- /theme JS files -->

<script>
	$(function() {
		$("#RunLoad").fadeOut(5000, function() {
			$("#RuningLoad").fadeIn(4000);
		});
	});
</script>