	<!-- Theme JS files form_select2-->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>

	
	<script>
		$(document).ready(function () {
			$('.select').select2({
				minimumResultsForSearch: Infinity
			 });
		})
	</script>
	<!-- /theme JS files form_select2 End-->
	

	
	<script>
		$(document).ready(function (){
			$("#go_button").click(function (){
				var runing_year=$("#runing_year").val();	
					if(runing_year !=""){
						$.post("view/mod/admin/code/runing_studentnew/studentnew.php",{
							TxtYear:runing_year
						},function(gorun){
							if(gorun !=""){
								$("#show_gorun").html(gorun);
							}else{
								//------------------------------------------------------
							}
						})
					}else{
						//--------------------------------------------------------------
					}		
			})
		})
	</script>