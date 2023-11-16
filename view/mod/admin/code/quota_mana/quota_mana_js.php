
	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>

	<script>
		$(document).ready(function () {
			$('.select').select2({
				minimumResultsForSearch: Infinity
			});	
		})
	</script>	
	<script>
		$(document).ready(function () {
			$('.select-search').select2({
				containerCssClass: 'select-lg'
			});	
		})
	</script>
	<!-- /theme JS files -->
	
	


	
	
	<script>
		$(document).ready(function () {
			$("#txt_year,#txt_level").change(function (){
				var data_level=$("#txt_level").val();
				var data_year=$("#txt_year").val();
				if(data_year!="" && data_level!=""){
					$.post("<?php echo $golink;?>/view/mod/admin/code/quota_mana/quota_stu.php",{
						copy_level:data_level,
						copy_year:data_year
					},function(string_class){
						if(string_class !="" ){
							$("#show_stu").html(string_class)
						}else{}
						
					})
				}else{}
				
			})
			
		})
	
	</script>
	
	<script>
		$(document).ready(function(){
			$("#data_stu").change(function(){
				var txt_year=$("#txt_year").val();
				var txt_level=$("#txt_level").val();
				var data_stu=$("#data_stu").val();
					if(txt_year!="" && txt_level!=""){
						$.post("<?php echo $golink;?>/quota_print/qm_show_quota",{
							txt_year:txt_year,
							txt_level:txt_level,
							data_stu:data_stu
						},function(qsq){
							if(qsq!=""){
								$("#show_qsq").html(qsq)
							}else{}
						})
					}else{}
			})
		})
	</script>

	

	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	