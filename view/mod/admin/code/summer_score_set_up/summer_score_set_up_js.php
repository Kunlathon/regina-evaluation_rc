	<!-- Theme JS files colors_violet.html-->
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery_ui/core.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/selectboxit.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/pnotify.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/noty.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/jgrowl.min.js"></script>
	<script>
		$(document).ready(function () {
			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-violet-400'
			});			
			$('.select-menu-color').select2({
				containerCssClass: 'bg-violet-400',
				dropdownCssClass: 'bg-violet-400'
			});			
		})
	</script>

	<!-- /theme JS files -->

	<!-- Theme JS files -->
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
	

	<!-- /theme JS files -->

	<!-- Theme JS files components_modals-->
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->


	<script>
		$(document).ready(function (){
			$("#sc_year").change(function (){
				var ScYear=$("#sc_year").val();
				var ScClass=$("#sc_class").val();
				var ScUesr="<?php echo $user_login;?>";
					if(ScYear!="" && ScClass!="" && ScUesr!=""){
						$.post("<?php echo base_url();?>/view/mod/admin/code/summer_score_set_up/rssubject_data.php",{
							txtyear:ScYear,
							txtclass:ScClass,
							txtuesr:ScUesr
						},function(sc){
							if(sc!=""){
								$("#run_rssubject").html(sc)
							}else{}
						})
					}else{}
			})
		})
	</script>
	
	<script>
		$(document).ready(function (){
			$("#sc_class").change(function (){
				var ScYear=$("#sc_year").val();
				var ScClass=$("#sc_class").val();
				var ScUesr="<?php echo $user_login;?>";
					if(ScYear!="" && ScClass!="" && ScUesr!=""){
						$.post("<?php echo base_url();?>/view/mod/admin/code/summer_score_set_up/rssubject_data.php",{
							txtyear:ScYear,
							txtclass:ScClass,
							txtuesr:ScUesr
						},function(sc){
							if(sc!=""){
								$("#run_rssubject").html(sc)
							}else{}
						})
					}else{}
			})
		})
	</script>	

	