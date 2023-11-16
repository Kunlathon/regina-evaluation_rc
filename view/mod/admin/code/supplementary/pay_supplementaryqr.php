<?php
	include("../../../../database/database_evaluation.php");
	include("../../../../database/class_admin.php");
	$rcdata_connect= connect();
	//$copy_year=$evaluation_sql->real_escape_string(htmlspecialchars($_POST["copy_year"]));


	$copy_term=filter_input(INPUT_POST,'copy_term');
	$copy_year=filter_input(INPUT_POST,'copy_year');



?>


	<script>
		$(document).ready(function () {

    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
        }
    });


    // Basic initialization
    $('.datatable-button-html5-basic').DataTable({
        buttons: {            
            dom: {
                button: {
                    className: 'btn btn-default'
                }
            },
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        }
    });
			
		})
	</script>



<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="panel-body">
					The HTML5 export buttons plug-in for Buttons provides four export buttons: <code>copyHtml5</code> - copy to clipboard; <code>csvHtml5</code> - save to CSV file; <code>excelHtml5</code> - save to XLSX file (requires JSZip); <code>pdfHtml5</code> - save to PDF file (requires PDFMake). This example demonstrates these four button types with their default options. Please note that these button types may also use a Flash fallback for older browsers (IE9-).
				</div>			
				<div class="table-responsive">
					<table class="table datatable-button-html5-basic">
						<thead>	
							<tr>
								<th>ID</th>
								<th>Payer Name * (40)</th>
								<th>Ref.1 * (Max 20)</th>
								<th>Ref.2 (Max 20)</th>
								<th>Amount *</th>
								<th>Payment Date * (dd/mm/yy) yy = 18</th>
								<th>Email Address</th>
								<th>Alert Message (100)</th>
								<th>Remark (100)</th>
							</tr>	
						<thead>	
						<tbody>
	<?php
		$txt_paySql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_prefix`,`regina_stu_data`.`rsd_name`,`regina_stu_data`.`rsd_surname`,`regina_stu_class`.`rsc_plan`,`regina_stu_class`.`rsc_class`,`regina_stu_class`.`rsc_room` from `regina_stu_data` JOIN `regina_stu_class` on(`regina_stu_data`.`rsd_studentid`=`regina_stu_class`.`rsd_studentid`)
				     where `regina_stu_data`.`rse_student_status`='1' 
					 and `regina_stu_class`.`rsc_year`='{$copy_year}'
					 and `regina_stu_class`.`rsc_term`='{$copy_term}'";
		$data_pay=new print_arrayrow($txt_paySql);
		foreach($data_pay->print_array as $rc_key=>$data_payRow){ 
		
		$Prefix  = new rc_prefix($data_payRow["rsd_prefix"]);
		$level   = new rc_level ($data_payRow["rsc_class"]);
		$rsd_studentid=$data_payRow["rsd_studentid"];
	
		$data_level=new stu_level($rsd_studentid,$copy_year,'1');
		

		if($data_payRow["rsc_class"]>=3 and $data_payRow["rsc_class"]<=3){
			$id_pay="0301001";
		}elseif($data_payRow["rsc_class"]>=11 and $data_payRow["rsc_class"]<=11){
			$id_pay="1101001";
		}elseif($data_payRow["rsc_class"]>=12 and $data_payRow["rsc_class"]<=23){
			$id_pay="1201001";
		}elseif($data_payRow["rsc_class"]==31){
			$id_pay="311201001";
		}elseif($data_payRow["rsc_class"]==32){
			$id_pay="321201001";
		}elseif($data_payRow["rsc_class"]==33){
			$id_pay="331201001";
		}elseif($data_payRow["rsc_class"]==41){
			$id_pay="411302001";
		}elseif($data_payRow["rsc_class"]==42){
			$id_pay="421301001";
		}
		/*elseif($data_payRow["rsc_class"]>=31 and $data_payRow["rsc_class"]<=33){
			$id_pay="103";
		}
		
		*/else{
			$id_pay="00";
		}
	
		if($id_pay=="00"){
			
		}else{
			
			$supplementary_school="SELECT `supplementary_id`,`supplementary_txt`,`supplementary_pay`,`supplementary_timepay` 
								   FROM `supplementary_school` 
								   WHERE `supplementary_id`='{$id_pay}' 
								   and `supplementary_t`='{$copy_term}' 
								   and `supplementary_type`='1'";
			$supplementary_rs=new print_notarray($supplementary_school);
			foreach($supplementary_rs->print_array as $rc_key=>$supplementary_row){
				$supplementary_id=$supplementary_row["supplementary_id"];
				$supplementary_txt=$supplementary_row["supplementary_txt"];
				$supplementary_pay=$supplementary_row["supplementary_pay"];
				$supplementary_timepay=$supplementary_row["supplementary_timepay"];
			}		?>	
	
							<tr>
								<td>&nbsp;</td>
								<td><?php echo $rsd_studentid."-".$Prefix->prefix_SName.".".$data_payRow["rsd_name"]." ".$data_payRow["rsd_surname"];?></td>
								<td><?php echo $rsd_studentid;?></td>
								<td><?php echo strtoupper("TUTOR".$copy_year.$level->Sort_name_E2.$data_payRow["rsc_room"].$copy_term);?></td>
								<td><?php echo $supplementary_pay;?></td>
								<td></td>
								<td>&nbsp;</td>
								<td><?php echo $supplementary_txt."เทอม".$copy_term."ปีการศึกษา".$copy_year;?></td>
								<td>&nbsp;</td>
							</tr>			
			
<?php		}
	

	

			
		} ?>
						
						
						
						

						</tbody>
					</table>

					</div>

				</div>
			</div>
		</div>
	</div>
