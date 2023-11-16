	<!-- Theme JS files colors_green-->
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
		$(document).ready(function(){
			$('.select-results-color').select2({
				containerCssClass: 'bg-teal-400'
			});
		})
	</script>
	
	<script>
		$(document).ready(function(){
			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-green-400'
			});
		})
	</script>

	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	
	<script>
		$(document).ready(function(){
			$("#ws_yt").change(function(){
				var ws_yt=$("#ws_yt").val();
				var ws_y=ws_yt.substr(2,4); 
				var ws_t=ws_yt.substr(0,1);
					if(ws_yt!=""){
						$.post("<?php echo base_url();?>/Weekend_class/ws_student",{
							ws_y:ws_y,
							ws_t:ws_t
						},function(run_yt){
							if(run_yt !=""){
								$("#ws_stu").html(run_yt)
							}else{}
						})
					}else{}
			})
		})
	</script>
	
	<script>
		$(document).ready(function(){
			$("#ws_stu").change(function(){
				var WsKey=$("#ws_stu").val();
				var ws_yt=$("#ws_yt").val();
				var WsY=ws_yt.substr(2,4); 
				var WsT=ws_yt.substr(0,1);
					if(WsKey!="" && WsY!="" && WsT!=""){
						$.post("<?php echo base_url();?>/Weekend_class/ws_data_all",{
							WsKey:WsKey,
							WsY:WsY,
							WsT:WsT
						},function(run_Txws){
							if(run_Txws!=""){
								$("#RunTxws").html(run_Txws)
							}else{}
						})
					}else{}
			})
		})
	</script>
	