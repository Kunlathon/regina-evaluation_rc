	<!-- Theme JS files colors_orange-->
	<script src="<?php echo base_url();?>Template/global_assets/js/core/libraries/jquery_ui/core.min.js"></script>
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/forms/selects/selectboxit.min.js"></script>
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/notifications/pnotify.min.js"></script>
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/notifications/noty.min.js"></script>
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/notifications/jgrowl.min.js"></script>
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<script>
		$(document).ready(function () {
			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-orange-600'
			});			
		})
	</script>
	<!-- /theme JS files -->
	
	<!-- Theme JS files components_buttons-->
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/velocity/velocity.min.js"></script>
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/velocity/velocity.ui.min.js"></script>
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/buttons/spin.min.js"></script>
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/buttons/ladda.min.js"></script>

	<script>
		$(document).ready(function () {
			Ladda.bind('.btn-ladda-progress', {
				callback: function(instance) {
					var progress = 0;
					var interval = setInterval(function() {
						progress = Math.min(progress + Math.random() * 0.1, 1);
						instance.setProgress(progress);

						if( progress === 1 ) {
							instance.stop();
							clearInterval(interval);
						}
					}, 200);
				}
			});
		})	
	</script>
	<!-- /theme JS files -->
	
	<!-- Theme JS files datatable_extension_buttons-->
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>

	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
	<script src="<?php echo base_url();?>Template/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
	
	<!-- /theme JS files -->
	
	<script>
		$(document).ready(function () {
			$("#SER_But").click(function(){
				var SER_Year=$("#SER_Year").val();
					if(SER_Year!=""){
						$.post("<?php echo base_url();?>view/mod/admin/code/summer_expense_report/SummerExpenseReport.php",{
							txt_year:SER_Year
						},function(run_ser){
							if(run_ser !=""){
								$("#Run_SER").html(run_ser)
							}else{}
						})
					}else{}
			})
		})	
	</script>