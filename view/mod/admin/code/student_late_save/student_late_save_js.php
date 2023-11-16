    <script type="text/javascript">
        function setScreenHWCookie() {
            $.cookie('sw', screen.width);
            //$.cookie('sh',screen.height);
            return true;
        }
    setScreenHWCookie();
    </script>

    <?php
		$width_system=filter_input(INPUT_COOKIE,'sw');
		if(($width_system>=1200)){
			$grid="lg";
		}elseif(($width_system<=992)){
			$grid="md";
		}elseif(($width_system<=768)){
			$grid="sm";
		}else{
			$grid="xs";
		}
    ?>

<!--uploader_bootstrap-->
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>

    <script>
        $(document).ready(function (){

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

            $('.file-input').fileinput({
                browseLabel: 'Browse',
                browseIcon: '<i class="icon-file-plus"></i>',
                uploadIcon: '<i class="icon-file-upload2"></i>',
                removeIcon: '<i class="icon-cross3"></i>',
                layoutTemplates: {
                    icon: '<i class="icon-file-check"></i>',
                    modal: modalTemplate
                },
                maxFilesNum: 1,
                maxFileCount: 1,
                allowedFileExtensions: ["xlsx", "XLSX","xls","XLS"],
                initialCaption: "No file selected",
                maxFileSize: 200,
                previewZoomButtonClasses: previewZoomButtonClasses,
                previewZoomButtonIcons: previewZoomButtonIcons,
                fileActionSettings: fileActionSettings
            });

        })
    </script>

<!--uploader_bootstrap end uploader_bootstrap.js-->

<!--picker_date-->
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/jgrowl.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/moment/moment.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/pickers/daterangepicker.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/pickers/anytime.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/pickers/pickadate/picker.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/pickers/pickadate/picker.time.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/pickers/pickadate/legacy.js"></script>

    <script>
        $(document).ready(function (){
            $('.daterange-single').daterangepicker({ 
                singleDatePicker: true,
                locale: {
                    daysOfWeek: ['อา','จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
                    monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
                    format: 'DD-MM-YYYY'
                }
            });
        })
    </script>

<!--picker_date end picker_date.js-->


<!-- Theme JS files components_modals.html-->
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	
    <script>
		$(document).ready(function(){
			$('#button_save_up').on('click',function(){
			    event.preventDefault();
                swal({
                    title: "คุณต้องการอัพข้อมูลหรือไม่",
                    text: "นำเข้าข้อมูลนักเรียนมาสายผ่านไฟส์ Excel",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FF7043",
                    confirmButtonText: "อัพโหลดข้อมูล"
                },function(){
                    var student_key=$("#student_key").val();
          
                    var count_error=0;

                        if(student_key!==""){
                            document.getElementById("student_key-null").innerHTML
                            ='  <div id="student_key-null">'
                            +'      <span class="help-block">นานสกุลไฟส์<code>file-input</code>. </span>' 
                            +'  </div>';
                            count_error=count_error+0;
                        }else{
                            document.getElementById("student_key-null").innerHTML
                            ='  <div id="student_key-null">'
                            +'      <span class="help-block">นานสกุลไฟส์<code>file-input</code>. กรุณานำเข้าข้อมูลด้วยไฟส์ Excel</span>' 
                            +'  </div>';
                            count_error=count_error+1;
                        }

                        if(count_error>=1){
                            //this.submit();
                        }else{
                            $("#form_studnt_late_save_add_file").submit();
                        }                   
                });

			})
		})
	</script>

<!-- /theme JS files components_modals.html-->

    <script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script>
        $(document).ready(function(){
            $('.select-search').select2();
        })
    </script>

<!-- Theme JS files -->
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
<!-- /theme JS files -->


    <script>
        $(document).ready(function(){
            var type_show=$("#type_show").val();
            var copy_date_start=$("#copy_date_start").val();
            var copy_date_end=$("#copy_date_end").val();
                if(type_show==="run"){
                    if(copy_date_start!=="" && copy_date_end!==""){
                        $.post("<?php echo base_url();?>/student_late/student_late_load/"+type_show,{
                            type_show:type_show,
                            copy_date_start:copy_date_start,
                            copy_date_end:copy_date_end
                        },function(Run_Print){
                            if(Run_Print!=""){
                                $("#Run_Print").html(Run_Print);
                            }
                        })
                    }else{}
                }else{}
        })
    </script>

    <script>
        $(document).ready(function(){
            $("#late_search").on('change',function(){
                var type_show="search";
                var txt_search=$("#late_search").val();
                    if(txt_search!==""){
                        $.post("<?php echo base_url();?>/student_late/student_late_load/"+type_show,{
                            type_show:type_show,
                            txt_search:txt_search
                        },function(Run_Print){
                            if(Run_Print!=""){
                                $("#Run_Print").html(Run_Print);
                            }
                        })
                    }else{}
            })
        })
    </script>    

    <script>
        $(document).ready(function(){
            $("#load_file_sl").on("click",function(){
                var load_file_sl=$("#load_file_sl").val();
                    if(load_file_sl==="Load"){
                        document.location="<?php echo base_url();?>/view/excel/DataStudentLate.xlsx";
                    }else{}
            })
        })
    </script>