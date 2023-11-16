	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>


	<!-- /theme JS files -->
	

	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>

	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
	<script src="Template/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>




	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->

	
	<script>
		$(document).ready(function () {
	// Default initialization
			$('.select').select2({
			minimumResultsForSearch: Infinity
			});
    // Select with search
			$('.select-search').select2();	
		})
	</script>
	
	<script>
		$(document).ready(function () {
			$("#stu_year,#stu_class").change(function (){
				var data_year=$("#stu_year").val();
				var data_class=$("#stu_class").val();
				var txt_classA=0;
				var txt_classB=0;
				var data_classTxt="-";
					if(data_class=="2123"){
						data_classA=21;
						data_classB=23;
						data_classTxt="ประถมศึกษาตอนปลาย";
					}else if(data_class=="3133"){
						data_classA=31;
						data_classB=33;	
						data_classTxt="มัธยมศึกษาตอนต้น";						
					}else if(data_class=="4143"){
						data_classA=41;
						data_classB=43;
						data_classTxt="มัธยมศึกษาตอนปลาย";						
					}else if(data_class=="3142"){
						data_classA=31;
						data_classB=42;
						data_classTxt="มัธยมศึกษาปีที่ 1-5";
					}else{
						data_classA=0;
						data_classB=0;
						data_classTxt="-";						
					}
					if(data_year!="" && data_class!=""){
						$.post("view/mod/admin/code/activity_stu/activity_sturun.php",{
							txt_year:data_year,
							txt_classA:data_classA,
							txt_classB:data_classB,
							txt_classTxt:data_classTxt
						},function(datarc){
							if(datarc!=""){
								$("#studata_room").html(datarc);
							}else{}
						})
					}else{}
			})
		})
	</script>	

	
