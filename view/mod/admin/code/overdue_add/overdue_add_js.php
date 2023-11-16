	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>


	<script src="Template/global_assets/js/demo_pages/form_inputs.js"></script>

	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	
	<script src="Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script src="Template/global_assets/js/demo_pages/form_inputs.js"></script>

	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>	
	
	<!-- Theme JS files -->

	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js"></script>
	<script src="Template/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js"></script>
	<script src="Template/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>



	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->


	<script>
		$(document).ready(function () {	
		
    //
    // Define variables
    //

    // Modal template
    var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
        '  <div class="modal-content">\n' +
        '    <div class="modal-header">\n' +
        '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
        '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
        '    </div>\n' +
        '    <div class="modal-body">\n' +
        '      <div class="floating-buttons btn-group"></div>\n' +
        '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
        '    </div>\n' +
        '  </div>\n' +
        '</div>\n';

    // Buttons inside zoom modal
    var previewZoomButtonClasses = {
        toggleheader: 'btn btn-default btn-icon btn-xs btn-header-toggle',
        fullscreen: 'btn btn-default btn-icon btn-xs',
        borderless: 'btn btn-default btn-icon btn-xs',
        close: 'btn btn-default btn-icon btn-xs'
    };

    // Icons inside zoom modal classes
    var previewZoomButtonIcons = {
        prev: '<i class="icon-arrow-left32"></i>',
        next: '<i class="icon-arrow-right32"></i>',
        toggleheader: '<i class="icon-menu-open"></i>',
        fullscreen: '<i class="icon-screen-full"></i>',
        borderless: '<i class="icon-alignment-unalign"></i>',
        close: '<i class="icon-cross3"></i>'
    };

    // File actions
    var fileActionSettings = {
        zoomClass: 'btn btn-link btn-xs btn-icon',
        zoomIcon: '<i class="icon-zoomin3"></i>',
        dragClass: 'btn btn-link btn-xs btn-icon',
        dragIcon: '<i class="icon-three-bars"></i>',
        removeClass: 'btn btn-link btn-icon btn-xs',
        removeIcon: '<i class="icon-trash"></i>',
        indicatorNew: '<i class="icon-file-plus text-slate"></i>',
        indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
        indicatorError: '<i class="icon-cross2 text-danger"></i>',
        indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
    };


    //
    // Basic example
    //		

    $(".file-input-extensions").fileinput({
        browseLabel: 'อัพโหลด',
        browseClass: 'btn btn-primary',
        uploadClass: 'btn btn-default',
        browseIcon: '<i class="icon-file-plus"></i>',
        uploadIcon: '<i class="icon-file-upload2"></i>',
        removeIcon: '<i class="icon-cross3"></i>',
        layoutTemplates: {
            icon: '<i class="icon-file-check"></i>',
            modal: modalTemplate
        },
        maxFilesNum: 1,
        allowedFileExtensions: ["xls", "xlsx"],
        initialCaption: "ไม่ได้เลือกไฟล์",
        previewZoomButtonClasses: previewZoomButtonClasses,
        previewZoomButtonIcons: previewZoomButtonIcons,
        fileActionSettings: fileActionSettings
    });

		})
	</script>

	<!-- /theme JS files -->
	<script>
		$(document).ready(function () {
			$("#od_student").change(function (){
				var data_student=$("#od_student").val();
				if(data_student !=""){
					$.post("view/mod/admin/code/overdue_add/over_stu_js.php",{
						txt_student:data_student
					},function(string_class){
						if(string_class !=""){
							$("#print_string").html(string_class)
						}
					})
				}
			})
		})
	</script>	
	
	
	
	
	
