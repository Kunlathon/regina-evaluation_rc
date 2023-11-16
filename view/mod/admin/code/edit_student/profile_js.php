	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/inputs/touchspin.min.js"></script>


	<script src="Template/global_assets/js/demo_pages/form_input_groups.js"></script>

	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->	
	<!-- Theme JS files -->
	<script src="Template/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script src="Template/global_assets/js/plugins/forms/selects/select2.min.js"></script>


	<!--<script src="Template/global_assets/js/demo_pages/form_select2.js"></script>-->

	<!--<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>-->
	

	<!-- Theme JS files -->

	<script src="Template/global_assets/js/plugins/pickers/pickadate/picker.js"></script>
	<script src="Template/global_assets/js/plugins/pickers/pickadate/picker.date.js"></script>


	<!-- Theme JS files -->
	<script src="Template/global_assets/js/plugins/notifications/noty.min.js"></script>
	<script src="Template/global_assets/js/plugins/notifications/jgrowl.min.js"></script>




	<script src="Template/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->

	<script src="../js/Simple-Lightweight-jQuery-Input-Mask-Plugin-Masked-input/dist/jquery.masked-input.js"></script>

	<!--<script src="Template/global_assets/js/demo_pages/picker_date.js"></script>-->
	<!-- /theme JS files -->
	
	<!-- /theme JS files -->	
	<!--<script type="text/javascript" src="view/js_css_code/Product-Zoom-On-Hover-Plugin-For-jQuery-imgZoom-js/imgZoom/jquery.imgzoom.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.imgBox').imgZoom({
				boxWidth: 200,
				boxHeight: 200,
				marginLeft: 5,
				origin: 'data-origin'
			});				
		});
    </script>-->
<!--เกิด-->	
	<script>
		$(document).ready(function () {
		// Accessibility labels
			$('.pickadate-accessibility').pickadate({
				labelMonthNext: 'ไปที่เดือนถัดไป',
				labelMonthPrev: 'ไปที่เดือนก่อนหน้า',
				labelMonthSelect: 'เลือกเดือนจากรายการแบบเลื่อนลง',
				labelYearSelect: 'เลือกหนึ่งปีจากรายการแบบเลื่อนลง',
				selectMonths: true,
				selectYears: '200',
				//yearSuffix: year+543, 
				formatSubmit: 'dd-mm-yyyy',
				format:'dd-mm-yyyy',
				today:"วันนี้",
				clear:"ลบ",
				close:"ออก",
				monthsFull: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
                weekdaysShort: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤ', 'ศุกร์', 'เสาร์'],
			
			});
		})
	</script>


	<script>
		$(document).ready(function () {
			
			$('.select-size-<?php echo $grid;?>').select2({
			containerCssClass: 'select-<?php echo $grid;?>'
			});
			
		})
	</script>
	
	

<!--********************************************************************************************************************************-->
	<script>
		$(document).ready(function (){
			$("#ds_FMstatus").change(function (){
				var txt_onclik=$("#ds_FMstatus").val();
				var txt_stuid=$("#stu_id").val();
				if(txt_onclik!=""){
					$.post("view/mod/admin/code/edit_student/print_fandm.php",{
						call_onclik:txt_onclik,
						user_login:txt_stuid
					},function(datacity){
						if(datacity!=""){
							$("#call_showon").html(datacity);
						}
						
					})
				}
				
			})
	
		})
	</script>

	<script>
	
			
			function loadFMstatus (){
				var txt_onclik=$("#ds_FMstatus").val();
				var txt_stuid=$("#stu_id").val();
				if(txt_onclik!=""){
					$.post("view/mod/admin/code/edit_student/print_fandm.php",{
						call_onclik:txt_onclik,
						user_login:txt_stuid
					},function(datacity){
						if(datacity!=""){
							$("#call_showon").html(datacity);
						}
						
					})
				}				
			}
			
	
	</script>


	<script>
		$(document).ready(function () {
			$("#parent_statusA").change(function () {
				var parent_status=$("#parent_statusA").val();

				
				if(parent_status!=""){
					$.post("view/mod/admin/code/edit_student/show_p.php",{
						txt_status:parent_status

					},function(datacity){
						if(datacity!=""){
							$("#show_p").html(datacity);
						}
					})
				}
				
			})
		})
	</script>	
	
	<script>
		$(document).ready(function () {
			$("#parent_statusB").change(function () {
				var parent_status=$("#parent_statusB").val();

				
				if(parent_status!=""){
					$.post("view/mod/admin/code/edit_student/show_p.php",{
						txt_status:parent_status

					},function(datacity){
						if(datacity!=""){
							$("#show_p").html(datacity);
						}
					})
				}
				
			})
		})
	</script>	
	
	<script>
		$(document).ready(function () {
			$("#parent_statusC").change(function () {
				var parent_status=$("#parent_statusC").val();

				
				if(parent_status!=""){
					$.post("view/mod/admin/code/edit_student/show_p.php",{
						txt_status:parent_status

					},function(datacity){
						if(datacity!=""){
							$("#show_p").html(datacity);
						}
					})
				}
				
			})
		})
	</script>	
	
	<script>
		$(document).ready(function () {
			$("#parent_statusD").change(function () {
				var parent_status=$("#parent_statusD").val();

				
				if(parent_status!=""){
					$.post("view/mod/admin/code/edit_student/show_p.php",{
						txt_status:parent_status

					},function(datacity){
						if(datacity!=""){
							$("#show_p").html(datacity);
						}
					})
				}
				
			})
		})
	</script>	
	


	<script>
		$(document).ready(function () {
			$("#submit_button").click(function () {
				var call_rsd_name=$("#rsd_name").val();
				var call_rsd_surname=$("#rsd_surname").val();
				var call_nickTh=$("#nickTh").val();
				var call_nickEn=$("#nickEn").val();
				var call_rsd_nameEn=$("#rsd_nameEn").val();
				var call_rsd_surnameEn=$("#rsd_surnameEn").val();
				var call_rsd_Identification=$("#rsd_Identification").val();
				var call_stu_birth=$("#stu_birth").val();
				var call_stu_blood=$("#stu_blood").val();
				var call_stu_nation=$("#stu_nation").val();
				var call_stu_sun=$("#stu_sun").val();
				var call_IDReligion=$("#IDReligion").val();
				var call_stu_phone=$("#stu_phone").val();
				var call_stu_brethren=$("#stu_brethren").val();
				var call_stu_brethreS=$("#stu_brethreS").val();
				var call_stu_child=$("#stu_child").val();
				var call_stu_physical=$("#stu_physical").val();
				var call_breed_add=$("#breed_add").val();
				var call_breed_province=$("#breed_province").val();
				var call_breed_city=$("#breed_city").val();
				var call_breed_district=$("#breed_district").val();
				var call_stu_reg_hno=$("#stu_reg_hno").val();
				var call_stu_reg_moo=$("#stu_reg_moo").val();
				var call_stu_reg_soi=$("#stu_reg_soi").val();
				var call_stu_reg_road=$("#stu_reg_road").val();
				var call_stu_reg_province=$("#stu_reg_province").val();
				var call_stu_reg_amphur=$("#stu_reg_amphur").val();
				var call_stu_reg_tumbon=$("#stu_reg_tumbon").val();
				var call_stu_reg_zipcodecopy=$("#stu_reg_zipcodecopy").val();
				var call_stu_hno=$("#stu_hno").val();
				var call_stu_moo=$("#stu_moo").val();
				var call_stu_soi=$("#stu_soi").val();
				var call_stu_road=$("#stu_road").val();
				var call_stu_province=$("#stu_province").val();
				var call_stu_amphur=$("#stu_amphur").val();
				var call_stu_tumbon=$("#stu_tumbon").val();
				var call_stu_zipcodecopy=$("#stu_zipcodecopy").val();
				var call_ds_SameSchool=$("#ds_SameSchool").val();
				var call_ds_OriginalClass=$("#ds_OriginalClass").val();
				var call_stu_id=$("#stu_id").val();
				var	call_enter=$("#enter").val();
				var call_myname=$("#myname").val();
				var call_group=$("#group").val();
				var call_ds_gradeSchool=$("#ds_gradeSchool").val();
				var call_ds_ProvinceSchool=$("#ds_ProvinceSchool").val();
				
				if(call_stu_id!="" && call_enter!=""){
					$.post("view/mod/admin/code/edit_student/into_profile_modify.php",{
						
						rsd_name:call_rsd_name,
						rsd_surname:call_rsd_surname,
						nickTh:call_nickTh,
						nickEn:call_nickEn,
						rsd_nameEn:call_rsd_nameEn,
						rsd_surnameEn:call_rsd_surnameEn,
						rsd_Identification:call_rsd_Identification,
						stu_birth:call_stu_birth,
						stu_blood:call_stu_blood,
						stu_nation:call_stu_nation,
						stu_sun:call_stu_sun,
						IDReligion:call_IDReligion,
						stu_phone:call_stu_phone,
						stu_brethren:call_stu_brethren,
						stu_brethreS:call_stu_brethreS,
						stu_child:call_stu_child,
						stu_physical:call_stu_physical,
						breed_add:call_breed_add,
						breed_province:call_breed_province,
						breed_city:call_breed_city,
						breed_district:call_breed_district,
						stu_reg_hno:call_stu_reg_hno,
						stu_reg_moo:call_stu_reg_moo,
						stu_reg_soi:call_stu_reg_soi,
						stu_reg_road:call_stu_reg_road,
						stu_reg_province:call_stu_reg_province,
						stu_reg_amphur:call_stu_reg_amphur,
						stu_reg_tumbon:call_stu_reg_tumbon,
						stu_reg_zipcode:call_stu_reg_zipcodecopy,
						stu_hno:call_stu_hno,
						stu_moo:call_stu_moo,
						stu_soi:call_stu_soi,
						stu_road:call_stu_road,
						stu_province:call_stu_province,
						stu_amphur:call_stu_amphur,
						stu_tumbon:call_stu_tumbon,
						stu_zipcode:call_stu_zipcodecopy,
						ds_SameSchool:call_ds_SameSchool,
						ds_OriginalClass:call_ds_OriginalClass,
						stu_id:call_stu_id,
						enter:call_enter,
						myname:call_myname,
						group:call_group,
						ds_gradeSchool:call_ds_gradeSchool,
				        ds_ProvinceSchool:call_ds_ProvinceSchool
						
					},function(call_data_stu){
						if(call_data_stu!=""){
							$("#print_data_stu").html(call_data_stu);
						}
					})
				}
				
			})
		})
	</script>
	
	<script>
		$(document).ready(function () {
			$("#data_addstu").click(function () {
				
				var call_ds_CongenitalDisease=$("#ds_CongenitalDisease").val();
				var call_ds_FoodAllergies=$("#ds_FoodAllergies").val();
				var call_ds_DrugAllergy=$("#ds_DrugAllergy").val();
				var call_ds_status=$("#ds_status").val();
				var call_ds_dormitoryName=$("#ds_dormitoryName").val();
				var call_ds_dormitoryHno=$("#ds_dormitoryHno").val();
				var call_ds_dormitoryMoo=$("#ds_dormitoryMoo").val();
				var call_ds_dormitorySoi=$("#ds_dormitorySoi").val();
				var call_ds_dormitoryMyName=$("#ds_dormitoryMyName").val();
				var call_ds_dormitoryPhone=$("#ds_dormitoryPhone").val();
				var call_ds_dormitoryRoad=$("#ds_dormitoryRoad").val();
				var call_ds_dormitoryProvince=$("#ds_dormitoryProvince").val();
				var call_ds_dormitoryAmphur=$("#ds_dormitoryAmphur").val();
				var call_ds_dormitoryTumbon=$("#ds_dormitoryTumbon").val();
				var call_ds_dormitoryZipcodecopy=$("#ds_dormitoryZipcodecopy").val();
				var call_ds_trip=$("#ds_trip").val();
				var call_ds_triptxtcopy=$("#ds_triptxtcopy").val();
				var call_ds_FMstatus=$("#ds_FMstatus").val();
				var call_ds_allergic=$("#ds_allergic").val();
				var call_stu_id=$("#stu_id_pda").val();
				var call_enter=$("#enter_pda").val();
				var call_myname=$("#myname").val();
				var call_group=$("#group").val();
				
				
				if(call_stu_id!="" && call_enter!=""){
					$.post("view/mod/admin/code/edit_student/into_profile_modify.php",{
						
					ds_CongenitalDisease:call_ds_CongenitalDisease,
					ds_FoodAllergies:call_ds_FoodAllergies,
					ds_DrugAllergy:call_ds_DrugAllergy,
					ds_status:call_ds_status,
					ds_dormitoryName:call_ds_dormitoryName,
					ds_dormitoryHno:call_ds_dormitoryHno,
					ds_dormitoryMoo:call_ds_dormitoryMoo,
					ds_dormitorySoi:call_ds_dormitorySoi,
					ds_dormitoryMyName:call_ds_dormitoryMyName,
					ds_dormitoryPhone:call_ds_dormitoryPhone,
					ds_dormitoryRoad:call_ds_dormitoryRoad,
					ds_dormitoryProvince:call_ds_dormitoryProvince,
					ds_dormitoryAmphur:call_ds_dormitoryAmphur,
					ds_dormitoryTumbon:call_ds_dormitoryTumbon,
					ds_dormitoryZipcode:call_ds_dormitoryZipcodecopy,
					ds_trip:call_ds_trip,
					ds_triptxt:call_ds_triptxtcopy,
					ds_FMstatus:call_ds_FMstatus,
					ds_allergic:call_ds_allergic,
					stu_id:call_stu_id,
					enter:call_enter,
					myname:call_myname,
					group:call_group
					
					
					
						
					},function(call_data_addstu){
						if(call_data_addstu!=""){
							$("#print_data_addstu").html(call_data_addstu);
						}
					})
				}
				
			})
		})
	</script>
	



	
	
	<script>
		$(document).ready(function () {
			$("#parent_modify").click(function () {
				

                var call_parent_family=$("#parent_family").val();
                var call_parent_status=$("#parent_status").val();
                var call_parent_prefix=$("#parent_prefix").val();
                var call_parent_fname=$("#parent_fname").val();
                var call_parent_sname=$("#parent_sname").val();
                var call_parent_prefix_en=$("#parent_prefix_en").val();
                var call_parent_fname_en=$("#parent_fname_en").val();
                var call_parent_sname_en=$("#parent_sname_en").val();
                var call_parent_code=$("#parent_code").val();
                var call_guardian_birthday=$("#guardian_birthday").val();
                var call_parent_blood=$("#parent_blood").val();
                var call_parent_nation=$("#parent_nation").val();
                var call_parent_sun=$("#parent_sun").val();
                var call_parent_IDReligion=$("#parent_IDReligion").val();
                var call_parent_phone=$("#parent_phone").val();
                var call_parent_career=$("#parent_career").val();
                var call_parent_salary=$("#parent_salary").val();
                var call_parent_study=$("#parent_study").val();
                var call_parent_workplace=$("#parent_workplace").val();
                var call_parent_wp_pro=$("#parent_wp_pro").val();
                var call_parent_addwordhno=$("#parent_addwordhno").val();
                var call_parent_addwordmoo=$("#parent_addwordmoo").val();
                var call_parent_addwordsoi=$("#parent_addwordsoi").val();
                var call_parent_addwordroad=$("#parent_addwordroad").val();
                var call_parent_addwordprovince=$("#parent_addwordprovince").val();
                var call_parent_addwordamphur=$("#parent_addwordamphur").val();
                var call_parent_addwordtumbon=$("#parent_addwordtumbon").val();
                var call_parent_addwordzipcodecopy=$("#parent_addwordzipcodecopy").val();
                var call_parent_wp_tel=$("#parent_wp_tel").val();
                var call_parent_hno=$("#parent_hno").val();
                var call_parent_moo=$("#parent_moo").val();
                var call_parent_soi=$("#parent_soi").val();
                var call_parent_road=$("#parent_road").val();
                var call_parent_province=$("#parent_province").val();
                var call_parent_amphur=$("#parent_amphur").val();
                var call_parent_tumbon=$("#parent_tumbon").val();
                var call_parent_zipcodecopy=$("#parent_zipcodecopy").val();
                var call_stu_id_pm=$("#stu_id_pm").val();
                var call_enter_pm=$("#enter_pm").val();
				var call_myname=$("#myname").val();
				var call_group=$("#group").val();
				var call_statusA=$("#parent_statusA").val();
				var call_statusB=$("#parent_statusB").val();
				var call_statusC=$("#parent_statusC").val();
				var call_statusD=$("#parent_statusD").val();
				
				
				if(call_stu_id_pm!="" && call_enter_pm!=""){
					$.post("view/mod/admin/code/edit_student/into_profile_modify.php",{
						
					parent_family:call_parent_family,
					parent_status:call_parent_status,
					parent_prefix:call_parent_prefix,
					parent_fname:call_parent_fname,
					parent_sname:call_parent_sname,
					parent_prefix_en:call_parent_prefix_en,
					parent_fname_en:call_parent_fname_en,
					parent_sname_en:call_parent_sname_en,
					parent_code:call_parent_code,
					guardian_birthday:call_guardian_birthday,
					parent_blood:call_parent_blood,
					parent_nation:call_parent_nation,
					parent_sun:call_parent_sun,
					parent_IDReligion:call_parent_IDReligion,
					parent_phone:call_parent_phone,
					parent_career:call_parent_career,
					parent_salary:call_parent_salary,
					parent_study:call_parent_study,
					parent_workplace:call_parent_workplace,
					parent_wp_pro:call_parent_wp_pro,
					parent_addwordhno:call_parent_addwordhno,
					parent_addwordmoo:call_parent_addwordmoo,
					parent_addwordsoi:call_parent_addwordsoi,
					parent_addwordroad:call_parent_addwordroad,
					parent_addwordprovince:call_parent_addwordprovince,
					parent_addwordamphur:call_parent_addwordamphur,
					parent_addwordtumbon:call_parent_addwordtumbon,
					parent_addwordzipcode:call_parent_addwordzipcodecopy,
					parent_wp_tel:call_parent_wp_tel,
					parent_hno:call_parent_hno,
					parent_moo:call_parent_moo,
					parent_soi:call_parent_soi,
					parent_road:call_parent_road,
					parent_province:call_parent_province,
					parent_amphur:call_parent_amphur,
					parent_tumbon:call_parent_tumbon,
					parent_zipcode:call_parent_zipcodecopy,
					stu_id:call_stu_id_pm,
					enter:call_enter_pm,
					myname:call_myname,
					group:call_group,
					parent_statusA:call_statusA,
					parent_statusB:call_statusB,
					parent_statusC:call_statusC,
					parent_statusD:call_statusD
						
					},function(call_parent_modify){
						if(call_parent_modify!=""){
							$("#print_parent_modify").html(call_parent_modify);
						}
					})
				}
				
			})
		})
	</script>
	

<!--********************************************************************************************************************************-->



	<script>
		$(document).ready(function () {
			$("#breed_province").change(function () {
				var province=$("#breed_province").val();
				
				if(province!=""){
					$.post("view/mod/admin/code/edit_student/breed/born_city.php",{
						txt_province:province
					},function(dataprovince){
						if(dataprovince!=""){
							$("#breed_city").html(dataprovince);
						}
					})
				}
				
			})
		})
	</script>
	
	<script>
		$(document).ready(function () {
			$("#breed_city").change(function () {
				var city=$("#breed_city").val();
				
				if(city!=""){
					$.post("view/mod/admin/code/edit_student/breed/born_amphures.php",{
						txt_city:city
					},function(datacity){
						if(datacity!=""){
							$("#breed_district").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
<!--ที่อยู่ปัจจุบัน-->
	<script>
		$(document).ready(function () {
			$("#stu_province").change(function () {
				var province=$("#stu_province").val();
				
				if(province!=""){
					$.post("view/mod/admin/code/edit_student/add_stu/addstu_city.php",{
						txt_province:province
					},function(dataprovince){
						if(dataprovince!=""){
							$("#stu_amphur").html(dataprovince);
						}
					})
				}
				
			})
		})
	</script>
	<script>
		$(document).ready(function () {
			$("#stu_amphur").change(function () {
				var city=$("#stu_amphur").val();
				
				if(city!=""){
					$.post("view/mod/admin/code/edit_student/add_stu/addstu_amphures.php",{
						txt_city:city
					},function(datacity){
						if(datacity!=""){
							$("#stu_tumbon").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	<script>
		$(document).ready(function () {
			$("#stu_tumbon").change(function () {
				var zip=$("#stu_tumbon").val();
				
				if(zip!=""){
					$.post("view/mod/admin/code/edit_student/add_stu/addstu_zip.php",{
						txt_zip:zip
					},function(datacity){
						if(datacity!=""){
							$("#stu_zipcode").html(datacity);
						}
					})
				}
				
			})
		})
	</script>	
<!--ตามทะเบียนบ้าน-->	
	<script>
		$(document).ready(function () {
			$("#stu_reg_province").change(function () {
				var province=$("#stu_reg_province").val();
				
				if(province!=""){
					$.post("view/mod/admin/code/edit_student/home_stu/home_city.php",{
						txt_province:province
					},function(dataprovince){
						if(dataprovince!=""){
							$("#stu_reg_amphur").html(dataprovince);
						}
					})
				}
				
			})
		})
	</script>
	<script>
		$(document).ready(function () {
			$("#stu_reg_amphur").change(function () {
				var city=$("#stu_reg_amphur").val();
				
				if(city!=""){
					$.post("view/mod/admin/code/edit_student/home_stu/home_amphures.php",{
						txt_city:city
					},function(datacity){
						if(datacity!=""){
							$("#stu_reg_tumbon").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	<script>
		$(document).ready(function () {
			$("#stu_reg_tumbon").change(function () {
				var zip=$("#stu_reg_tumbon").val();
				
				if(zip!=""){
					$.post("view/mod/admin/code/edit_student/home_stu/home_zip.php",{
						txt_zip:zip
					},function(datacity){
						if(datacity!=""){
							$("#stu_reg_zipcode").html(datacity);
						}
					})
				}
				
			})
		})
	</script>		
<!--นักเรียนอาศัยอยู่กับ-->
	<script>
		$(document).ready(function () {
			$("#ds_status").change(function () {
				var ds=$("#ds_status").val();
				
				if(ds!=""){
					$.post("view/mod/admin/code/edit_student/ds_status.php",{
						txt_ds:ds
					},function(datacity){
						if(datacity!=""){
							$("#print_ds").html(datacity);
						}
					})
				}
				
			})
		})
	</script>	
<!--การเดินทางมาโรงเรียน-->
	<script>
		$(document).ready(function () {
			$("#ds_trip").change(function () {
				var trip=$("#ds_trip").val();
				
				if(trip!=""){
					$.post("view/mod/admin/code/edit_student/ds_triptxt.php",{
						txt_trip:trip
					},function(datacity){
						if(datacity!=""){
							$("#ds_triptxt").html(datacity);
						}
					})
				}
				
			})
		})
	</script>


	
<!--ที่อยู่ผุ้ปกครองทำงาน-->
	<script>
		$(document).ready(function () {
			$("#parent_addwordprovince").change(function () {
				var province=$("#parent_addwordprovince").val();
				
				if(province!=""){
					$.post("view/mod/admin/code/edit_student/p_word/pword_city.php",{
						txt_province:province
					},function(dataprovince){
						if(dataprovince!=""){
							$("#parent_addwordamphur").html(dataprovince);
						}
					})
				}
				
			})
		})
	</script>
	<script>
		$(document).ready(function () {
			$("#parent_addwordamphur").change(function () {
				var city=$("#parent_addwordamphur").val();
				
				if(city!=""){
					$.post("view/mod/admin/code/edit_student/p_word/pword_amphures.php",{
						txt_city:city
					},function(datacity){
						if(datacity!=""){
							$("#parent_addwordtumbon").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	<script>
		$(document).ready(function () {
			$("#parent_addwordtumbon").change(function () {
				var zip=$("#parent_addwordtumbon").val();
				
				if(zip!=""){
					$.post("view/mod/admin/code/edit_student/p_word/pword_zip.php",{
						txt_zip:zip
					},function(datacity){
						if(datacity!=""){
							$("#parent_addwordzipcode").html(datacity);
						}
					})
				}
				
			})
		})
	</script>	
	
	
	<!--ที่อยู่ผู้ปกครอง--->

	<script>
		$(document).ready(function () {
			$("#parent_province").change(function () {
				var province=$("#parent_province").val();
				
				if(province!=""){
					$.post("view/mod/admin/code/edit_student/p_add/padd_city.php",{
						txt_province:province
					},function(dataprovince){
						if(dataprovince!=""){
							$("#parent_amphur").html(dataprovince);
						}
					})
				}
				
			})
		})
	</script>
	<script>
		$(document).ready(function () {
			$("#parent_amphur").change(function () {
				var city=$("#parent_amphur").val();
				
				if(city!=""){
					$.post("view/mod/admin/code/edit_student/p_add/padd_amphures.php",{
						txt_city:city
					},function(datacity){
						if(datacity!=""){
							$("#parent_tumbon").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	<script>
		$(document).ready(function () {
					
			$("#parent_amphur").change(function () {
				var city=$("#parent_amphur").val();
				
				if(city!=""){
					$.post("view/mod/admin/code/edit_student/p_add/padd_amphures.php",{
						txt_city:city
					},function(datacity){
						if(datacity!=""){
							$("#parent_tumbon").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	<script>
		$(document).ready(function () {
			$("#parent_tumbon").change(function () {
				var zip=$("#parent_tumbon").val();
				
				if(zip!=""){
					$.post("view/mod/admin/code/edit_student/p_add/padd_zip.php",{
						txt_zip:zip
					},function(datacity){
						if(datacity!=""){
							$("#parent_zipcode").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	
	
	<script>
		$(document).ready(function () {
			$("#ds_dormitoryProvince").change(function () {
				var province=$("#ds_dormitoryProvince").val();
				
				if(province!=""){
					$.post("view/mod/admin/code/edit_student/ds_statusjs/statusjs_city.php",{
						txt_province:province
					},function(dataprovince){
						if(dataprovince!=""){
							$("#ds_dormitoryAmphur").html(dataprovince);
						}
					})
				}
				
			})
		})
	</script>
	<script>
		$(document).ready(function () {
			$("#ds_dormitoryAmphur").change(function () {
				var city=$("#ds_dormitoryAmphur").val();
				
				if(city!=""){
					$.post("view/mod/admin/code/edit_student/ds_statusjs/statusjs_amphures.php",{
						txt_city:city
					},function(datacity){
						if(datacity!=""){
							$("#ds_dormitoryTumbon").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	<script>
		$(document).ready(function () {
			$("#ds_dormitoryTumbon").change(function () {
				var zip=$("#ds_dormitoryTumbon").val();
				
				if(zip!=""){
					$.post("view/mod/admin/code/edit_student/ds_statusjs/statusjs_zip.php",{
						txt_zip:zip
					},function(datacity){
						if(datacity!=""){
							$("#ds_dormitoryZipcode").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	
	
	
	
	
	<script>
		$(document).ready(function () {
			$("#parent_status").change(function () {
				var parent=$("#parent_status").val();
				var stuid=$("#stu_id").val();
				if(parent!="" && stuid!=""){
					$.post("view/mod/admin/code/edit_student/profile_dr.php",{
						txt_parent:parent,
						txt_stuid:stuid
					},function(datacity){
						if(datacity!=""){
							$("#print_parent").html(datacity);
						}
					})
				}
				
			})
		})
	</script>	
	
	<script>
		$(document).ready(function () {
			$("#parent_statusA").change(function () {
				var parent=$("#parent_statusA").val();
				var stuid=$("#stu_id").val();
				if(parent!="" && stuid!=""){
					$.post("view/mod/admin/code/edit_student/profile_dr.php",{
						txt_parent:parent,
						txt_stuid:stuid
					},function(datacity){
						if(datacity!=""){
							$("#print_parent").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	
	
	<script>
		$(document).ready(function () {
			$("#parent_statusB").change(function () {
				var parent=$("#parent_statusB").val();
				var stuid=$("#stu_id").val();
				if(parent!="" && stuid!=""){
					$.post("view/mod/admin/code/edit_student/profile_dr.php",{
						txt_parent:parent,
						txt_stuid:stuid
					},function(datacity){
						if(datacity!=""){
							$("#print_parent").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	
	<script>
		$(document).ready(function () {
			$("#parent_statusC").change(function () {
				var parent=$("#parent_statusC").val();
				var stuid=$("#stu_id").val();
				if(parent!="" && stuid!=""){
					$.post("view/mod/admin/code/edit_student/profile_dr.php",{
						txt_parent:parent,
						txt_stuid:stuid
					},function(datacity){
						if(datacity!=""){
							$("#print_parent").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	
	<script>
		$(document).ready(function () {
			$("#parent_statusD").change(function () {
				var parent=$("#parent_statusD").val();
				var stuid=$("#stu_id").val();
				if(parent!="" && stuid!=""){
					$.post("view/mod/admin/code/edit_student/profile_dr.php",{
						txt_parent:parent,
						txt_stuid:stuid
					},function(datacity){
						if(datacity!=""){
							$("#print_parent").html(datacity);
						}
					})
				}
				
			})
		})
	</script>
	
	
	
	
	
	
	