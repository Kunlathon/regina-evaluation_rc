	<!-- Core JS files -->
	<script src="Template/global_assets/js/plugins/loaders/pace.min.js"></script>
	<script src="Template/global_assets/js/core/libraries/jquery.min.js"></script>
	<script src="Template/global_assets/js/core/libraries/bootstrap.min.js"></script>
	<script src="Template/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->

	<!-- /theme JS files -->
	
	<!-- Core JS files -->
	<script src="Template/global_assets/js/plugins/loaders/pace.min.js"></script>
	<script src="Template/global_assets/js/core/libraries/jquery.min.js"></script>
	<script src="Template/global_assets/js/core/libraries/bootstrap.min.js"></script>
	<script src="Template/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/pnotify.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>


	<!-- /theme JS files -->
	
	
	<script src="Template/global_assets/js/plugins/notifications/pnotify.min.js"></script>

	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>


	<script src="Template/global_assets/js/demo_pages/form_select2.js"></script>

	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->

	<!-- /theme JS files -->
	
	<script>
		$(document).ready(function () {
			
    $('.multiselect-full-featured').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        templates: {
            filter: '<li class="multiselect-item multiselect-filter"><i class="icon-search4"></i> <input class="form-control" type="text"></li>'
        }
    });			
			
		})
	</script>
	
	
	<script>
		$(document).ready(function () {
			$("#txt_year,#txt_level").change(function (){
				var data_level=$("#txt_level").val();
				var data_year=$("#txt_year").val();
				if(data_year!="" && data_level!=""){
					$.post("view/mod/admin/code/quota_academic/quota_stu.php",{
						copy_level:data_level,
						copy_year:data_year
					},function(string_class){
						if(string_class !="" ){
							$("#data_stu").html(string_class)
						}
						
					})
				}
				
			})
			
		})
	
	</script>
	
	<script>
	
		
    // Stacks
    // ------------------------------

    // Define directions
    var stack_top_left = {"dir1": "right", "dir2": "down", "push": "top"};
    var stack_bottom_left = {"dir1": "right", "dir2": "up", "push": "top"};
    var stack_bottom_right = {"dir1": "left", "dir2": "up", "firstpos1": 5, "firstpos2": 5};
    var stack_custom_left = {"dir1": "right", "dir2": "down"};
    var stack_custom_right = {"dir1": "left", "dir2": "up", "push": "top"};
    var stack_custom_top = {"dir1": "right", "dir2": "down", "push": "top", "spacing1": 1};
    var stack_custom_bottom = {"dir1": "right", "dir2": "up", "spacing1": 1};

    var stack_top_left_rtl = {"dir1": "left", "dir2": "down", "push": "top"};
    var stack_bottom_left_rtl = {"dir1": "left", "dir2": "up", "push": "top"};
    var stack_bottom_right_rtl = {"dir1": "right", "dir2": "up", "firstpos1": 5, "firstpos2": 5};
    var stack_custom_left_rtl = {"dir1": "left", "dir2": "down"};
    var stack_custom_right_rtl = {"dir1": "right", "dir2": "up", "push": "top"};


    //
    // Setup options for positions
    //
	
    // Bottom right
    function show_stack_bottom_right(type) {
        var opts = {
            title: "บันทึกสำเร็จ",
            text: "ทำรายการบันทึกข้อมูลสำเร็จ",
            addclass: "stack-bottom-right bg-primary",
            stack: $('html').attr('dir') == 'rtl' ? stack_bottom_right_rtl : stack_bottom_right
        };
        switch (type) {
            case 'error':
            opts.title = "เกิดข้อผิดพลาด";
            opts.text = "ทำรายการบันทึกข้อมูลไม่สำเร็จ หรือทำรายการไม่ถูกต้อง";
            opts.addclass = "stack-bottom-right bg-danger";
            opts.type = "error";
            break;

            case 'info':
            opts.title = "ล้างข้อมูล";
            opts.text = "ทำรายการล้างข้อมูลเรียบร้อยแล้ว สามารถดำเนินการบันทึกข้อมูลใหม่ได้ทันที";
            opts.addclass = "stack-bottom-right bg-info";
            opts.type = "info";
            break;

            /*case 'success':
            opts.title = "Good News Everyone";
            opts.text = "I've invented a device that bites shiny metal asses.";
            opts.addclass = "stack-bottom-right bg-success";
            opts.type = "success";
            break;*/
        }
        new PNotify(opts);
    }

	</script>
	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	