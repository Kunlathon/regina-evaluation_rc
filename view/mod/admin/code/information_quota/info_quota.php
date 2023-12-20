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
	
	function date_timeThailand($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
	}
	
	
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
			include("../../../../database/pdo_quota.php");
			include("../../../../database/pdo_data.php");
			include("../../../../database/class_quota.php");
			
			
			$copy_year=filter_input(INPUT_POST,'copy_year');
			$copy_yearnew=$copy_year+1;
			$copy_level=filter_input(INPUT_POST,'copy_level');
			
			
					switch($copy_level){
					
					case "3":
						$call_levelA="อนุบาล 3";
						$call_levelB="ประถมศึกษาปีที่ 1";
						$call_levelC="อ.3";
						$call_levelF="11";
					break;

					case "23":
						$call_levelA="ประถมศึกษาปีที่ 6";
						$call_levelB="มัธยมศึกษาปีที่ 1";
						$call_levelC="ป.6";
						$call_levelF="31";
					break;
					
					case "33":
						$call_levelA="มัธยมศึกษาปีที่ 3";
						$call_levelB="มัธยมศึกษาปีที่ 4";
						$call_levelC="ม.3";
						$call_levelF="41";
					break;
					
					default:
						$call_levelA=null;
						$call_levelB=null;
						$call_levelC=null;
						$call_levelF=null;
				}	
			
			
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
            search: '<span>ค้นหา:</span> _INPUT_',
            searchPlaceholder: 'พิมพ์...',
            lengthMenu: '<span>Show:</span> _MENU_',
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
					filename: 'รายชื่อนักเรียนได้สิทธิ์โควตาภายใน ระดับชั้น <?php echo $call_levelA;?> ปีการศึกษา<?php echo $copy_yearnew;?>',
					title: 'รายชื่อนักเรียนได้สิทธิ์โควตาภายใน ระดับชั้น <?php echo $call_levelA;?> ปีการศึกษา<?php echo $copy_yearnew;?>',
                    exportOptions: {
                        columns: ':visible'
                    }
                },


                {
                    extend: 'colvis',
                    text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                    className: 'btn bg-blue btn-icon'
                }
            ]
        },
				"paging"       : false,
				"lengthChange" : false,
				"searching"    : true,
				"ordering"     : true,
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

/*		*/
			
		})
</script> 


<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-info">
			<div class="panel-body">
				รายชื่อนักเรียนได้สิทธิ์โควตาภายใน&nbsp;ระดับชั้น&nbsp;<?php echo $call_levelA;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $copy_yearnew;?>
			</div>
			<div class="table-responsive">
						<table class="table datatable-button-html5-columns">
							<thead>
								<tr>
									<th>เลขประจำตัวนักเรียน</th>								
									<th>เลขประจำตัวประชาชน</th>
									<th>ชื่อ-สกุล</th>
									<th>ห้อง</th>
									<th>เลขที่</th>
									<th>สิทธิ์โควตา</th>
								</tr>
							</thead>
							<tbody>
			<?php
				$call_datastuSql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`regina_stu_data`.`rsd_prefix`
										,`regina_stu_data`.`rsd_name` ,`regina_stu_data`.`rsd_surname`,`regina_stu_class`.`rsc_room`,`regina_stu_class`.`rsc_num`  
								          from `regina_stu_data` join `regina_stu_class` on(`regina_stu_data`.`rsd_studentid`=`regina_stu_class`.`rsd_studentid`)
										  where `regina_stu_data`.`rse_student_status`='1'
										  and `regina_stu_class`.`rsc_year`='{$copy_year}' 
										  and `regina_stu_class`.`rsc_term`='2' 
										  and `regina_stu_class`.`rsc_class`='{$copy_level}'";
				$call_datastuRs=new row_evaluation ($call_datastuSql);
				$count=0;
					foreach($call_datastuRs->print_evaluation_array() as $rc_quota=>$call_datastuRow){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
					<?php
						
						$QuotaRights=new internal_quota_rights($call_datastuRow["rsd_studentid"],$copy_yearnew,$call_levelF);
						foreach($QuotaRights->print_internal_quota_rights() as $rc=>$QuotaRightsRow){
							if(is_array($QuotaRightsRow) && count($QuotaRightsRow)){ ?>
								
								<tr>
									<td><?php echo $call_datastuRow["rsd_studentid"];?></td>
									<td><?php echo $call_datastuRow["rsd_Identification"];?></td>
									<td><?php echo "เด็กหญิง&nbsp;".$call_datastuRow["rsd_name"]."&nbsp;".$call_datastuRow["rsd_surname"];?></td>
									<td><?php echo $call_levelC."/".$call_datastuRow["rsc_room"];?></td>
									<td><?php echo $call_datastuRow["rsc_num"];?></td>
									<td><?php echo $QuotaRightsRow["LName"];?></td>	
								</tr>							
							
					<?php	}else{
								
							}
						}
					?>			
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
			<?php	$count=$count+1;
					}	?>

					
							</tbody>
						</table>
			</div>
		</div>
	</div>
</div>