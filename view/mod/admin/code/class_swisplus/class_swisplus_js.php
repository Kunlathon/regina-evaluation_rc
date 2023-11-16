	<!-- Theme JS files colors_violet.html-->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/core.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/selectboxit.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/pnotify.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/noty.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/jgrowl.min.js"></script>
	<script>
		$(document).ready(function () {
			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-violet-400'
			});				
		})
	</script>
	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
	<script>
		$(document).ready(function (){
			$("#cs_year").change(function (){
				var ScYear=$("#cs_year").val();
				var ScClass=$("#cs_class").val();
				var ScDate=$("#cs_date").val();
					if(ScYear!="" && ScClass!="" && ScDate!=""){
						$.post("view/mod/admin/code/class_swisplus/swisplus.php",{
							txtyear:ScYear,
							txtclass:ScClass,
							txtdate:ScDate
						},function(sc){
							if(sc!=""){
								$("#swisplus").html(sc)
							}else{}
						})
					}else{}
			})
		})
	</script>
	
	<script>
		$(document).ready(function (){
			$("#cs_class").change(function (){
				var ScYear=$("#cs_year").val();
				var ScClass=$("#cs_class").val();
				var ScDate=$("#cs_date").val();
					if(ScYear!="" && ScClass!="" && ScDate!=""){
						$.post("view/mod/admin/code/class_swisplus/swisplus.php",{
							txtyear:ScYear,
							txtclass:ScClass,
							txtdate:ScDate
						},function(sc){
							if(sc!=""){
								$("#swisplus").html(sc)
							}else{}
						})
					}else{}
			})
		})
	</script>			
	
	<script>
		$(document).ready(function (){
			$("#cs_date").change(function (){
				var ScYear=$("#cs_year").val();
				var ScClass=$("#cs_class").val();
				var ScDate=$("#cs_date").val();
					if(ScYear!="" && ScClass!="" && ScDate!=""){
						$.post("view/mod/admin/code/class_swisplus/swisplus.php",{
							txtyear:ScYear,
							txtclass:ScClass,
							txtdate:ScDate
						},function(sc){
							if(sc!=""){
								$("#swisplus").html(sc)
							}else{}
						})
					}else{}
			})
		})
	</script>	
	
	<!-- Theme JS files picker_date.html-->
	<script src="Template/global_assets/js/plugins/ui/moment/moment.min.js"></script>
	<script src="Template/global_assets/js/plugins/pickers/daterangepicker.js"></script>
	<script src="Template/global_assets/js/plugins/pickers/anytime.min.js"></script>
	<script src="Template/global_assets/js/plugins/pickers/pickadate/picker.js"></script>
	<script src="Template/global_assets/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script src="Template/global_assets/js/plugins/pickers/pickadate/picker.time.js"></script>
	<script src="Template/global_assets/js/plugins/pickers/pickadate/legacy.js"></script>

	<script>
		$(document).ready(function (){
			$('.pickadate-limits').pickadate({
				monthsFull: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
                weekdaysShort: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
				formatSubmit: 'DD/MM/YYYY',
				locale: {
					daysOfWeek: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
                    monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
					format: 'DD/MM/YYYY'
				}
			});
		})	
	</script>
	<!-- /theme JS files -->
	
	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>

	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->