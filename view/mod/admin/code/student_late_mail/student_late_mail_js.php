<!-- Theme JS files -->
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
<!-- /theme JS files -->
<!-- /theme JS files components_modals.html-->
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script>
        $(document).ready(function(){
            $('.select-search').select2();
        })
    </script>
<!-- Theme JS files -->

    <script>
		$(document).ready(function(){
			var lms=$("#late_mail_search").val();
			var type_show="run";
			var count_status="B";
				if(lms!==""){
					$.post("<?php echo base_url();?>/student_late/load_date_late_mail/"+type_show,{
						late_mail_search:lms,
						type_show:type_show,
						count_status:count_status
					},function(lms_data){
						if(lms_data!=""){
							$("#Run_lms_data").html(lms_data);
						}else{}
					})
				}else{}
		})
	</script>

	<script>
		$(document).ready(function(){
			$("#late_mail_search").on("change",function(){
				var lms=$("#late_mail_search").val();
				var type_show="run";
				var count_status="B";
					if(lms!==""){
						$.post("<?php echo base_url();?>/student_late/load_date_late_mail/"+type_show,{
							late_mail_search:lms,
							type_show:type_show,
							count_status:count_status
						},function(lms_data){
							if(lms_data!=""){
								$("#Run_lms_data").html(lms_data);
							}else{}
						})
					}else{}
			})
		})
	</script>