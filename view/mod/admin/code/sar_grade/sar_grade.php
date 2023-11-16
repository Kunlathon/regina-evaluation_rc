<?php
	include("../../../../database/database_evaluation.php");
	include("../../../../database/class_admin.php");
	$rcdata_connect=connect();
	
	$copy_class=post_data(filter_input(INPUT_POST,'copy_class'));// ชั้น   
	$copy_year=post_data(filter_input(INPUT_POST,'copy_year'));// ปีการศึกษา   
	$copy_term=post_data(filter_input(INPUT_POST,'copy_term'));//ภาคเรียน    
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

<?php
	if($copy_class>=11 and $copy_class<=23){
		if($copy_term==1){
			//"*********";
		}else{
			$txt_type=1;
			$txt_term=0;
		}		
	}else{
		if($copy_term==1){
			$txt_type=2;
			$txt_term=1;
		}else{
			$txt_type=2;
			$txt_term=2;
		}		
	} 
?>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"></div>
			<div class="panel-body">
			
			<div class="table-responsive">
 
 		<table class="table datatable-button-html5-basic">
			<tbody>
				<tr>
					<td>รหัสนักเรียน</td>
					<td>ชื่อ-สกุล</td>
		<?php
			$data_Subject="SELECT `IDSubject`,`Name` as `Subject_Name`
						   FROM `rc_subject_2562` 
						   WHERE `IDSubtype`='11' 
						   AND `IDLevel` ='{$copy_class}' 
						   AND `Type` = '{$txt_type}' 
						   AND `Term` = '{$txt_term}' 
						   ORDER BY `IDsaraGroup`,`Order_4` ASC";
			$data_SubjectRs=rc_array($data_Subject);
			
			foreach($data_SubjectRs as $rc_key=>$data_SubjectRow){ 
				$IDSubject=mb_substr($data_SubjectRow["IDSubject"],0,6,'UTF-8');
				$Subject_Name=$data_SubjectRow["Subject_Name"];
			
			?>
					<td><?php echo $IDSubject;?></td>
									
		<?php	} ?>			
					
				</tr>
		<?php
			$data_rcstd= new stu_room($copy_year,$copy_term,$copy_class);
			foreach($data_rcstd->stu_array as $rc_key=>$data_rcstdRow){ ?>
				<tr>
					<td><?php echo $data_rcstdRow["rsd_studentid"];?></td>
					<td><?php echo $data_rcstdRow["prefixname"]." ".$data_rcstdRow["rsd_name"]." ".$data_rcstdRow["rsd_surname"];?></td>

		<?php
			$data_SubjectB="SELECT `IDSubject` 
						   FROM `rc_subject_2562` 
						   WHERE `IDSubtype`='11' 
						   AND `IDLevel` ='{$copy_class}' 
						   AND `Type` = '{$txt_type}' 
						   AND `Term` = '{$txt_term}' 
						   ORDER BY `IDsaraGroup`,`Order_4` ASC";
			$data_SubjectBRs=rc_array($data_SubjectB);
			
			foreach($data_SubjectBRs as $rc_key=>$data_SubjectBRow){ 
				$print_IDSubject=$data_SubjectBRow["IDSubject"];

				$rc_master_score="SELECT `Grade`,`ReGrade`  
								  FROM `rc_master_score` 
								  WHERE `IDStudent` LIKE '{$data_rcstdRow["rsd_studentid"]}' 
								  AND `IDSubject` LIKE '{$print_IDSubject}'
								  AND `Term` LIKE '{$txt_term}' 
								  AND `YearEdu` LIKE '{$copy_year}' 
								  AND `Type` LIKE '{$txt_type}' ORDER BY `IDSubject`  DESC ";
				$rc_master_scoreRs=$rcdata_connect->query($rc_master_score) or die($rcdata_connect->error);
				if($rc_master_scoreRs->num_rows>0){
					$rc_master_scoreRow=$rc_master_scoreRs->fetch_assoc();
						$txt_Grade=$rc_master_scoreRow["Grade"];
						$txt_ReGrade=$rc_master_scoreRow["ReGrade"];
						if($txt_Grade==0.00){
							$Grade=new stu_grade($txt_ReGrade);
							$print_Grade=$Grade->txt_gradeint;
						}else{
							$Grade=new stu_grade($txt_Grade);
							$print_Grade=$Grade->txt_gradeint;
						}
				}else{
					$print_Grade="ไม่ได้ลงเรียน";
				}?>
				
				<td><?php echo $print_Grade;?></td>
			
		<?php	?>
					
									
		<?php	} ?>




				</tr>				
		<?php	} ?>					
				
			
				
				
				
				
		
				
				
				
				

			</tbody>
		</table>
 
			</div>		
			
			
			</div>
		</div>	
	</div>
</div>








	

		


		
			

		





