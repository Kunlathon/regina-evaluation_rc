	<!-- Theme JS files -->
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/styling/switch.min.js"></script>


	<script src="<?php echo base_url();?>/Template/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>

	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	
	
	<!-- Theme JS files -->
	<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>




	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	
	
	<!-- Theme JS files components_modals-->
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<!-- /theme JS files -->
	
	

    <script type="text/javascript">
        function setScreenHWCookie() {
            $.cookie('sw',screen.width);
                //$.cookie('sh',screen.height);
            return true;
        }
            setScreenHWCookie();
    </script>

    <?php
		$width_system=filter_input(INPUT_COOKIE,'sw');
		if($width_system>=1200){
			$grid="lg";
		}elseif($width_system<=992){
			$grid="md";
		}elseif($width_system<=768){
			$grid="sm";
		}else{
			$grid="xs";
		}
    ?>
	<script>
		$(document).ready(function(){
			
			$('.select-search').select2();
				
			$('.select-size-<?php echo $grid;?>').select2({
				containerCssClass: 'select-<?php echo $grid;?>'
			});
			
		})
	</script>
	
	<script>
		$(document).ready(function(){
			$("#GoTo").click(function (){
				document.location="<?php echo base_url();?>/?evaluation_mod=register_activity";
			})
		})
	</script>	
	<script>
		$(document).ready(function(){
			$("#GoToHome").click(function (){
				document.location="<?php echo base_url();?>/?evaluation_mod=home";
			})
		})
	</script>	