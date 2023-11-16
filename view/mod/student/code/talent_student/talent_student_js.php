<!-- Theme JS files form_controls_extended-->
	<script src="Template/global_assets/js/core/libraries/jasny_bootstrap.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/inputs/autosize.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/inputs/formatter.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/inputs/typeahead/handlebars.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/inputs/passy.js"></script>
	<script src="Template/global_assets/js/plugins/forms/inputs/maxlength.min.js"></script>
<!-- /theme JS files -->


<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/core.min.js"></script>

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
	
			// Basic select2
			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-warning-400'
			});


			// Select2 ultiselect item color
			$('.select-item-color').select2({
				containerCssClass: 'bg-warning-400'
			});


			// Select2 dropdown menu color
			$('.select-menu-color').select2({
				containerCssClass: 'bg-warning-400',
				dropdownCssClass: 'bg-warning-400'
			});


			// Multiselect
			$('.multiselect').multiselect({
				buttonClass: 'btn bg-warning-400',
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
				$.jGrowl('I am a well highlighted warning notice..', { theme: 'bg-warning-400', header: 'Well highlighted' });
			});


			// PNotify
			$('.pnotify-launch').on('click', function () {
				new PNotify({
					title: 'Info Notice',
					text: 'Check me out! I\'m a notice.',
					icon: 'icon-info22',
					delay: 5000,
					addclass: 'bg-warning'
				});
			});



			// Form components
			// ------------------------------

			// Switchery toggle
			var switchery = document.querySelector('.switch');
			var init = new Switchery(switchery, {color: '#FF7043'});


			// Checkboxes and radios
			$(".styled").uniform({
				wrapperClass: "border-warning text-warning-600"
			});


			// File input
			$(".file-styled").uniform({
				fileButtonClass: 'action btn bg-warning'
			});



			// Popups
			// ------------------------------

			// Tooltip
			$('[data-popup=tooltip-custom]').tooltip({
				template: '<div class="tooltip"><div class="bg-warning-400"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div></div>'
			});


			// Popover title
			$('[data-popup=popover-custom]').popover({
				template: '<div class="popover border-warning-400"><div class="arrow"></div><h3 class="popover-title bg-warning-400"></h3><div class="popover-content"></div></div>'
			});


			// Popover background color
			$('[data-popup=popover-solid]').popover({
				template: '<div class="popover bg-warning-400"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
			});
		})
	</script>

<!-- /theme JS files -->
	<script>
		$(document).ready(function (){
//---------------------------------------------------------------------------------------			
			$("#ButTalentY").click(function(){
				var TxtTalent=$("#ButTalentY").val();
				var RunDare=$("#run_date").val();
					if(TxtTalent !="" && RunDare !=""){
						$.post("view/mod/student/code/talent_student/talent.php",{
							Talent_Txt:TxtTalent,
							Talent_Date:RunDare
						},function(TalentRc){
							if(TalentRc!=""){
								$("#RunTalent").html(TalentRc)
							}else{
								//-----------------------------------------------------
							}
						})
					}else{
						//-------------------------------------------------------------
					}
			})
//--------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------			
			$("#ButTalentN").click(function(){
				var TxtTalent=$("#ButTalentN").val();
				var RunDare=$("#run_date").val();
					if(TxtTalent !="" && RunDare !=""){
						$.post("view/mod/student/code/talent_student/talent.php",{
							Talent_Txt:TxtTalent,
							Talent_Date:RunDare
						},function(TalentRc){
							if(TalentRc!=""){
								$("#RunTalent").html(TalentRc)
							}else{
								//-----------------------------------------------------
							}
						})
					}else{
						//-------------------------------------------------------------
					}
			})
//--------------------------------------------------------------------------------------
		})
	</script>




