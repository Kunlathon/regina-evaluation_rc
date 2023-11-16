<?php
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");
	include("../../../../database/pdo_summer.php");
	include("../../../../database/class_summer.php");	
	include("../../../../database/regina_student.php");
//--------------------------------------------------------------------    
    include("../../../../img_user/document/gotolink.php");//----------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------				
?>
	<script>
		$(document).ready(function () {
			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-violet-400'
			});				
		})
	</script>
<!--****************************************************************************-->			
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
<!--****************************************************************************-->

<?php
	$data_year=filter_input(INPUT_POST,'txtyear');
	$data_class=filter_input(INPUT_POST,'txtclass');
		if(isset($data_year,$data_class)){	
//---------------------------------------------------------------------------------
			$DataClass=new print_level($data_class);
//---------------------------------------------------------------------------------		
		?>
<!--****************************************************************************-->	
	<script>
		$(document).ready(function (){


		// Setting datatable defaults
		$.extend( $.fn.dataTable.defaults, {
			autoWidth: false,
			dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
			language: {
				search: '<span>ค้นหา:</span> _INPUT_',
				searchPlaceholder: 'พิมพ์เพื่อค้นหาที่นี้...',
				lengthMenu: '<span>แสดง:</span> _MENU_',
				paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
			}
		});

		// Column selectors
		$('.datatable-button-html5-columns').DataTable({
			buttons: {            
				buttons: [
					{
						extend: 'copyHtml5',
						className: 'btn btn-default',
						exportOptions: {
							columns: [ 0, ':visible' ]
						}
					},
					{
						extend: 'excelHtml5',
						className: 'btn btn-default',
						filename: 'ข้อมูลคะแนนวัดและประเมินผลระดับชั้น <?php echo $DataClass->level_Lname;?> ปีการศึกษา <?php echo $data_year;?>',
						title: 'ข้อมูลคะแนนวัดและประเมินผลระดับชั้น <?php echo $DataClass->level_Lname;?> ปีการศึกษา <?php echo $data_year;?>',
						exportOptions: {
							columns: ':visible'
						}
					}
				]
			},
					"paging"       : false,
					"lengthChange" : false,
					"searching"    : true,
					"ordering"     : false,
					"info"         : true,
					"autoWidth"    : false,
					
								"language": {
								"sEmptyTable"      : "ไม่มีข้อมูลในตาราง",
								"sInfo"            : "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
								"sInfoEmpty"       : "แสดง 0 ถึง 0 จาก 0 แถว",
								"sInfoFiltered"    : "(กรองข้อมูล _MAX_ ทุกแถว)",
								"sInfoPostFix"     : "",
								"sInfoThousands"   : ",",
								"sLengthMenu"      : "แสดง _MENU_ แถว",
								"sLoadingRecords"  : "กำลังโหลดข้อมูล...",
								"sProcessing"      : "กำลังดำเนินการ...",
								"sSeainserth"          : "ค้นหา: ",
								"sZeroRecords"     : "ไม่พบข้อมูล",
								"oPaginate"        : {
								"sFirst"           : "หน้าแรก",
								"sPrevious"        : "ก่อนหน้า",
								"sNext"            : "ถัดไป",
								"sLast"            : "หน้าสุดท้าย"
													 }
								}
		});

		})
	</script>	
<!--****************************************************************************-->		
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<h6 class="content-group text-semibold">
			ข้อมูลคะแนนวัดและประเมินผลระดับชั้น&nbsp;<?php echo $DataClass->level_Lname;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_year;?>&nbsp;
			<small class="display-block">ข้อมูลจะแสดงตามระดับชั้นเรียน</small>
		</h6>
	</div>
</div>
<form name="print_rss" target="_blank" action="<?php echo $golink;?>/summer/sud_summer/<?php echo $data_class;?>/<?php echo $data_year;?>" method="get">
<div class="row">
	<div class="col-<?php echo $grid;?>-12" style="font-weight: bold; text-align: center;">
	    <div>พิมพ์ใบรายงานการวัดประเมินผลการเรียน&nbsp;(Student&nbsp;Report&nbsp;for&nbsp;Summer&nbsp;Course)</div>
		<div><input type="image" style="width: 15%;" name="img"  src="<?php echo $golink;?>/Template/global_assets/images/print.png" border="0" title="พิมพ์ใบรายงานการวัดประเมินผลการเรียน&nbsp;(Student&nbsp;Report&nbsp;for&nbsp;Summer&nbsp;Course)"></div>
	</div>
</div><hr>
</from>

<div class="row">
	<div class="col-<?php echo $grid; ?>-12">
		<div class="panel panel-body border-top-violet">
			<div class="table-responsive">
				<table class="table datatable-button-html5-columns">
					<thead>
						<tr class="info">
							<th><div>รหัสนักเรียน</div></th>
							<th><div>ชื่อนักเรียน</div></th>
							<th><div>ชื่อวิชา</div></th>
							<th><div>คะแนนเต็ม</div></th>
							<th><div>คะแนนสอบ(Pre)</div></th>
							<th><div>คะแนนสอบ(Post)</div></th>
							<th><div>คะแนนเต็ม100</div></th>
							<th><div>ผลการประเมินการเรียนรู้</div></th>
						</tr>
					</thead>
					<tbody>
		<?php
			$PrintSudSummer=new SudSummer($data_class,$data_year);
			foreach($PrintSudSummer->RunSudSummer() as $rc=>$PrintSudSummerRow){ ?>
				
			<?php
				$PrintSummerSetUpScore=new PrintSummerSetUpScore($data_class,$data_year);
					foreach($PrintSummerSetUpScore->RunPrintSummerSetUpScore() as $rc=>$SummerSetUpScoreRow){ ?>
				
				<?php
					$PrintScoreSud=new DataTestSaveScoreA($PrintSudSummerRow["rs_key"],$data_year,$SummerSetUpScoreRow["RSD_no"]);
						if(isset($PrintScoreSud->DTSS_KeyStu)){ ?>
					
					<?php
						$PrintScorePre=new DataTestSaveScoreB($PrintScoreSud->DTSS_KeyStu,$PrintScoreSud->DTSS_Year,"Pre",$SummerSetUpScoreRow["RSD_no"]);
						$PrintScorePost=new DataTestSaveScoreB($PrintScoreSud->DTSS_KeyStu,$PrintScoreSud->DTSS_Year,"Post",$SummerSetUpScoreRow["RSD_no"]);
						
						$ReginaStuData=new regina_stu_data2($PrintScoreSud->DTSS_KeyStu,$PrintScoreSud->DTSS_Year,"1",$data_class);
							
							if($ReginaStuData->rsd_studentid!=null){
								if($ReginaStuData->sd_prefix=="2"){
									$myname="เด็กหญิง ".$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
								}elseif($ReginaStuData->sd_prefix=="4"){
									$myname="นางสาว ".$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
								}else{
									$myname=$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
								}	
							}else{
								$DataRsStudentData=new DataRsStudentData($PrintSudSummerRow["rs_key"],$data_year,$data_class);
								if(isset($DataRsStudentData->mynameTh)){
									$myname=$DataRsStudentData->mynameTh;
								}else{
									if(isset($myname)){
										$myname;
									}else{
										$StudentEvaluation=new Prove_A_PersonRc($PrintSudSummerRow["rs_key"]);
										$myname=$StudentEvaluation->NameTh;
									}			
								}
							}	
						

										
						
						
						$DataScore=new TestScore($PrintScorePost->DTSS_Score,"A",$SummerSetUpScoreRow["SSUS_Score_full"]);

					?>
					
						<tr class="success">
							<td><div><?php echo $PrintScoreSud->DTSS_KeyStu;?></div></td>
							<td><div><?php echo $myname;?></div></td>
							<td><div><?php echo $SummerSetUpScoreRow["RSD_txtTh"];?></div></td>
							<td><div><?php echo number_format($SummerSetUpScoreRow["SSUS_Score_full"],0,"","");?></div></td>
						
						<?php
								if(number_format($PrintScorePre->DTSS_Score,0,"","")==0){	?>
							<td><div>-</div></td>	
						<?php	}else{	?>
							<td><div><?php echo number_format($PrintScorePre->DTSS_Score,0,"","") ;?></div></td>	
						<?php	}?>
						
						<?php
								if(number_format($PrintScorePost->DTSS_Score,0,"","")==0){	?>
							<td><div>-</div></td>	
						<?php	}else{	?>
							<td><div><?php echo number_format($PrintScorePost->DTSS_Score,0,"","") ;?></div></td>	
						<?php	}?>						
						
						<?php
								if($DataScore->TS_Full==0){ ?>
							<td><div>-</div></td>		
						<?php	}else{ ?>
							<td><div><?php echo $DataScore->TS_Full;?></div></td>		
						<?php	}?>
							
							<?php
									if($PrintScorePost->DTSS_Score==0 or $PrintScorePost->DTSS_Score=="0.00"){ ?>
							<td><div>-</div></td>	
							<?php	}else{ ?>
							<td><div><?php echo $DataScore->TxtScoreTh;?></div></td>									
							<?php	}  ?>
							
						</tr>
					
				<?php	}else{}?>

			<?php	} ?>
								
		<?php	} ?>			


					</tbody>
				</table>
			</div>		
		</div>
	</div>
</div>			
<!--****************************************************************************-->			
<?php	}else{}?>

