	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>


	<script src="Template/global_assets/js/demo_pages/form_select2.js"></script>
	<!-- /theme JS files -->
	
	
	<script type="text/javascript">
			$(document).ready(function (){
			$("#stcqrcode").click(function (){
				var pd_term=$("#pd_term").val();				
				var pd_year=$("#pd_year").val();
				if(pd_term !="" && pd_year !=""){
			$.post("view/mod/admin/code/img_qrcode/qr_code.php",{
				term: pd_term,
				year: pd_year
			    },function(data){
				if(data !=""){
					$("#print_qrcode").html(data)
				}
			})
		}
	})
})
	</script>