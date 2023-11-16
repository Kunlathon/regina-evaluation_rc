	<!-- Theme JS files components_notifications_pnotify.html-->
	<script src="Template/global_assets/js/plugins/notifications/pnotify.min.js"></script>
	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->	
	
	
	
	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>

	<!-- /theme JS files -->
	
	<!-- Theme JS files colors_warning.html-->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/core.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/selectboxit.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>

	<script src="Template/global_assets/js/plugins/notifications/noty.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/jgrowl.min.js"></script>


	<script>
	$(document).ready(function (){
		
		$('.select').select2({
			minimumResultsForSearch: Infinity,
			containerCssClass: 'bg-warning-400'
		});	
	
	})
	</script>


	<!-- /theme JS files -->


	<!-- Theme JS files datatable_basic.html-->
	<script src="Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
	



	<script>
		$(document).ready(function (){
			$.extend( $.fn.dataTable.defaults, {
				autoWidth: false,
				columnDefs: [{ 
					orderable: false,
					width: '100px',
					//targets: [ 5 ]
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
			
			$('.datatable-basic').DataTable({
				
				
				"paging"           : false,
				"lengthChange"     : true,
				"searching"        : true,
				"ordering"         : true,
				"info"             : true,
				"autoWidth"        : true,
				"language"		   : {
				"sEmptyTable"      : "ไม่มีข้อมูลในตาราง",
				"sInfo"            : "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
				"sInfoEmpty"       : "แสดง 0 ถึง 0 จาก 0 แถว",
				"sInfoFiltered"    : "(กรองข้อมูล _MAX_ ทุกแถว)",
				"sInfoPostFix"     : "",
				"sInfoThousands"   : ",",
				"sLengthMenu"      : "แสดง _MENU_ แถว",
				"sLoadingRecords"  : "กำลังโหลดข้อมูล...",
				"sProcessing"      : "กำลังดำเนินการ...",
				"sSeainserth"      : "ค้นหา: ",
				"sZeroRecords"     : "ไม่พบข้อมูล",
				"oPaginate"        : {
				"sFirst"           : "หน้าแรก",
				"sPrevious"        : "ก่อนหน้า",
				"sNext"            : "ถัดไป",
				"sLast"            : "หน้าสุดท้าย"
									 }
									}
			});			
		})
	</script>

	<!-- /theme JS files -->
	
	<!-- Theme JS files uploader_bootstrap.html-->
	<script src="Template/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js"></script>
	<script src="Template/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js"></script>
	<script src="Template/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>

	<script>
		$(document).ready(function (){
   
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
		
			$('.file-input-advanced').fileinput({
				browseLabel: 'Browse',
				browseClass: 'btn btn-default',
				removeClass: 'btn btn-default',
				uploadClass: 'btn bg-success-400',
				browseIcon: '<i class="icon-file-plus"></i>',
				uploadIcon: '<i class="icon-file-upload2"></i>',
				removeIcon: '<i class="icon-cross3"></i>',
				layoutTemplates: {
					icon: '<i class="icon-file-check"></i>',
					main1: "{preview}\n" +
						"<div class='input-group {class}'>\n" +
						"   <div class='input-group-btn'>\n" +
						"       {browse}\n" +
						"   </div>\n" +
						"   {caption}\n" +
						"   <div class='input-group-btn'>\n" +
						"       {upload}\n" +
						"       {remove}\n" +
						"   </div>\n" +
						"</div>",
					modal: modalTemplate
				},
				maxFileCount: 1,
				maxFilesNum: 1,
				allowedFileExtensions: ["xlsx", "xls"],
				initialCaption: "No file selected",
				previewZoomButtonClasses: previewZoomButtonClasses,
				previewZoomButtonIcons: previewZoomButtonIcons,
				fileActionSettings: fileActionSettings
			});
		
		})
	</script>

	<!-- /theme JS files -->
	
	<script>
		$(document).ready(function (){
			$("#asj_go").on("click",function (){
				document.location ="<?php echo $golink;?>/?evaluation_mod=summer_pay";
			})
		})
	</script>