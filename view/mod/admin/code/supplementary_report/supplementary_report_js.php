	<!-- Theme JS files colors_pink-->
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
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	
	
	<script>
		$(document).ready(function () {

			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-pink'
			});			
					
			$('.select-menu-color').select2({
				containerCssClass: 'bg-pink',
				dropdownCssClass: 'bg-pink'
			});					
			
		})	
	</script>	
	
	<!-- /theme JS files -->
	

	
	<script>
		$(document).ready(function () {
			$("#ra_term,#ra_year,#ra_class").change(function (){
				var data_year=$("#ra_year").val();
				var data_term=$("#ra_term").val();			
				var data_class=$("#ra_class").val();			
				if(data_year!="" && data_term!="" && data_class!=""){
					$.post("<?php echo base_url();?>/view/mod/admin/code/supplementary_report/read_supplementary.php",{
						txt_year:data_year,
						txt_term:data_term,
						txt_class:data_class
					},function(datarc){
						if(datarc!=""){
							$("#ra_report").html(datarc);
						}else{}
					})
				}else{}
				
			})
		})
	</script>

