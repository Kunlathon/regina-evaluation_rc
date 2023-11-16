	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jasny_bootstrap.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="Template/global_assets/js/core/libraries/jquery_ui/core.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/selectboxit.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/tags/tagsinput.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/tags/tokenfield.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/inputs/touchspin.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/inputs/maxlength.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/inputs/formatter.min.js"></script>

	<script src="Template/global_assets/js/demo_pages/form_floating_labels.js"></script>
	<!-- /theme JS files -->
	
	<!-- form_select2 -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	

	<script src="Template/global_assets/js/demo_pages/form_select2.js"></script>
	<!-- /form_select2 -->	
	
	<!--uploader_bootstrap -->
	<script src="Template/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js"></script>
	<script src="Template/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js"></script>
	<script src="Template/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
	<!-- /uploader_bootstrap -->
	
	<!-- components_modals -->
	<script src="Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>

	<script src="../../../../global_assets/js/demo_pages/components_modals.js"></script>
	<!-- components_modals end -->

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



    $(".file-input-ajax").fileinput({
			//uploadUrl: "http://evaluation2020.test/view/QR/1_2563", // server upload action
			uploadAsync: true,
			maxFileCount: 1,
			initialPreview: [],
			fileActionSettings: {
				removeIcon: '<i class="icon-bin"></i>',
				removeClass: 'btn btn-link btn-xs btn-icon',
				uploadIcon: '<i class="icon-upload"></i>',
				uploadClass: 'btn btn-link btn-xs btn-icon',
				zoomIcon: '<i class="icon-zoomin3"></i>',
				zoomClass: 'btn btn-link btn-xs btn-icon',
				indicatorNew: '<i class="icon-file-plus text-slate"></i>',
				indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
				indicatorError: '<i class="icon-cross2 text-danger"></i>',
				indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
			},
			layoutTemplates: {
				icon: '<i class="icon-file-check"></i>',
				modal: modalTemplate
			},
			initialCaption: "ไม่ได้เลือกไฟล์",
			previewZoomButtonClasses: previewZoomButtonClasses,
			allowedFileExtensions: ["xlsx","xls"],
			maxFileSize: 100,
			previewZoomButtonIcons: previewZoomButtonIcons
		});


		})
	</script>		

	<script>
		$(document).ready(function () {
			$('#submit_upload').on('click',function(){ // id-><button id="submit_upload"></button>
				event.preventDefault();
				var count=0;
				var uh_term=$("#uh_term").val();
				var uh_year=$("#uh_year").val();
				var uh_health=$("#uh_health").val();
				swal({
					title: "ยืนยันอัพโหลดข้อมูล",
					text: "อัพโหลดข้อมูลผ่านไฟส์ Excel ข้อมูลสุขภาพพื้นฐานนักเรียน",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#FF7043",
					confirmButtonText: "ยืนยันการนำเข้าไฟส์"
				},function(){
					if(uh_term===""){
						document.getElementById("uh_term-null").innerHTML
						='<font style="color: #FF0000;">กรุณาเลือกรายการเทอม</font>';
						count=count+1;
					}else{
						document.getElementById("uh_term-null").innerHTML
						='<font></font>';
						count=count+0;
					}
					if(uh_year===""){
						document.getElementById("uh_year-null").innerHTML
						='<font style="color: #FF0000;">กรุณาเลือกรายการปีการศึกษา</font>';
						count=count+1;
					}else{
						document.getElementById("uh_year-null").innerHTML
						='<font></font>';
						count=count+0;
					}

					if(uh_health===""){
						document.getElementById("uh_health-null").innerHTML
						='<font style="color: #FF0000;">การนำเข้าไฟส์ไม่สำเร็จ</font>';
						count=count+1;
					}else{
						document.getElementById("uh_health-null").innerHTML
						='<font></font>';
						count=count+0;
					}

					if(count>=1){

					}else{
						$("#up_form_health").submit(); //<form id="up_form_health"></form>					
					}


				});
			})
		})
	</script>