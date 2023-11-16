	<!-- Theme JS files colors_danger-->
	<script src="<?php echo $golink;?>/Template/global_assets/js/core/libraries/jquery_ui/core.min.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/forms/selects/selectboxit.min.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/notifications/pnotify.min.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/notifications/noty.min.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/notifications/jgrowl.min.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	
	<script>
		$(document).ready(function(){
			
    // Selects
    // ------------------------------

    // Basic select2
    $('.select').select2({
        minimumResultsForSearch: Infinity,
        containerCssClass: 'bg-danger-400'
    });


    // Select2 ultiselect item color
    $('.select-item-color').select2({
        containerCssClass: 'bg-danger-400'
    });


    // Select2 dropdown menu color
    $('.select-menu-color').select2({
        containerCssClass: 'bg-danger-400',
        dropdownCssClass: 'bg-danger-400'
    });


    // Multiselect
    $('.multiselect').multiselect({
        buttonClass: 'btn bg-danger-400',
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
        $.jGrowl('I am a well highlighted danger notice..', { theme: 'bg-danger-400', header: 'Well highlighted' });
    });


    // PNotify
    $('.pnotify-launch').on('click', function () {
        new PNotify({
            title: 'Info Notice',
            text: 'Check me out! I\'m a notice.',
            icon: 'icon-info22',
            delay: 5000,
            addclass: 'bg-danger'
        });
    });



    // Form components
    // ------------------------------

    // Switchery toggle
    var switchery = document.querySelector('.switch');
    var init = new Switchery(switchery, {color: '#EF5350'});


    // Checkboxes and radios
    $(".styled").uniform({
        wrapperClass: "border-danger text-danger-600"
    });


    // File input
    $(".file-styled").uniform({
        fileButtonClass: 'action btn bg-danger'
    });



    // Popups
    // ------------------------------

    // Tooltip
    $('[data-popup=tooltip-custom]').tooltip({
        template: '<div class="tooltip"><div class="bg-danger-400"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div></div>'
    });


    // Popover title
    $('[data-popup=popover-custom]').popover({
        template: '<div class="popover border-danger-400"><div class="arrow"></div><h3 class="popover-title bg-danger-400"></h3><div class="popover-content"></div></div>'
    });


    // Popover background color
    $('[data-popup=popover-solid]').popover({
        template: '<div class="popover bg-danger-400"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    });
		})	
	</script>
	<!-- /theme JS files -->
	
	<!-- Theme JS files -->

	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/ui/moment/moment.min.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/pickers/daterangepicker.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/pickers/anytime.min.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/pickers/pickadate/picker.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/pickers/pickadate/picker.time.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/pickers/pickadate/legacy.js"></script>
	
	<script>
		$(document).ready(function(){
			$('#OFFONDateTime_button').on('click', function (e) {
				$('#OFFONDateTime').AnyTime_noPicker().AnyTime_picker().focus();
				e.preventDefault();
			});			
			
			$('#EndDateTime_button').on('click', function (e) {
				$('#EndDateTime').AnyTime_noPicker().AnyTime_picker().focus();
				e.preventDefault();
			});	
			
			$('#time_add_button').on('click', function (e) {
				$('#time_add').AnyTime_noPicker().AnyTime_picker().focus();
				e.preventDefault();
			});		

			$('#time_add_button4143').on('click', function (e) {
				$('#time_add').AnyTime_noPicker().AnyTime_picker().focus();
				e.preventDefault();
			});			
			
		})
		
	</script>
	<!-- /theme JS files -->
	
    <!-- Theme JS files -->
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<!-- /theme JS files -->
	
	<!-- Theme JS files datatable_basic-->
	<script src="<?php echo $golink;?>/Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
	
	<script>
		$(document).ready(function(){
			
			$.extend( $.fn.dataTable.defaults, {
				autoWidth: false,
				columnDefs: [{ 
					orderable: false,
					width: '100px',
				}],
				dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
				language: {
					search: '<span>กรอง:</span> _INPUT_',
					searchPlaceholder: 'พิมพ์เพื่อกรอง...',
					lengthMenu: '<span>แสดง:</span> _MENU_',
					paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
				},
				drawCallback: function () {
					$(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
				},
				preDrawCallback: function() {
					$(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
				}
			});			
			
			$('.datatable-basic').DataTable();
		})		
	</script>

	<!-- /theme JS files -->

	
	<script>
		$(document).ready(function(){
			
		})
	</script>