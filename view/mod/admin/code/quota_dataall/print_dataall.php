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
	$copy_level=filter_input(INPUT_POST,'copy_level');
	
			switch($copy_level){
			case "3":
				$call_levelA="อนุบาล 3 (ฝากเรียน)";
				$call_levelB="อนุบาล 3";
			break;
			case "11":
				$call_levelA="อนุบาล 3";
				$call_levelB="ประถมศึกษาปีที่ 1";
			break;
			case "31":
				$call_levelA="ประถมศึกษาปีที่ 6";
				$call_levelB="มัธยมศึกษาปีที่ 1";
			break;
			
			case "41":
				$call_levelA="มัธยมศึกษาปีที่ 3";
				$call_levelB="มัธยมศึกษาปีที่ 4";
			break;
			
			default:
				$call_levelA=null;
				$call_levelB=null;
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
            searchPlaceholder: 'พิมพ์เพื่อค้นหาที่นี...',
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
					filename: 'รายชื่อนักเรียนประสงค์มอบตัวเพื่อศึกษาต่อ ระดับชั้น <?php echo $call_levelB;?> ปีการศึกษา <?php echo $copy_year;?>',
					title: 'รายชื่อนักเรียนประสงค์มอบตัวเพื่อศึกษาต่อ ระดับชั้น <?php echo $call_levelB;?> ปีการศึกษา <?php echo $copy_year;?>',
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
				"ordering"     : false,
				"info"         : false,
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
				รายชื่อนักเรียนประสงค์มอบตัวเพื่อศึกษาต่อ ระดับชั้น <?php echo $call_levelB;?> ปีการศึกษา <?php echo $copy_year;?>
			</div>
			<div class="table-responsive">
						<table class="table datatable-button-html5-columns">
							<thead>
								<tr>
									<th><div>เลขประจำตัวนักเรียน</div></th>
								
									<th><div>เลขประจำตัวประชาชน</div></th>
									<th><div>ชื่อ-สกุล</div></th>
									<th><div>ระดับชั้นเดิม</div></th>
									<th><div>ระดับชั้นโควตา</div></th>
									<th><div>ห้องเรียน/แผนการที่ได้โควตา</div></th>
									<th><div>สอบย้ายห้องเรียน/แผนการ</div></th>
									<th><div>เลขประจำตัวสอบ</div></th>
									<th><div>เวลาพิมพ์ใบมอบตัว</div></th>
								</tr>
							</thead>
							<tbody>
				<?php
					$calltodata_quota=new quota_request($copy_year,$copy_level);
					foreach($calltodata_quota->print_quota_requset() as $rc_quota=>$calltodata){ 
					
					$data_stu=new regina_stu_data($calltodata["request_stuid"]);
					
					/*if($data_stu->sd_prefix=="2"){
						$prefix="เด็กหญิง";
					}elseif($data_stu->sd_prefix=="4"){
						$prefix="นางสาว";
					}else{
						$prefix="";
					}*/
						$prefix="เด็กหญิง";
						

						
					$quotaA=new print_plan($calltodata["qr_stuid"]);
					$quotaB=new print_plan($calltodata["qce_key"]);
					
					?>
					
								<tr>
									<td><?php echo $data_stu->rsd_studentid;?></td>
								
									<td><?php echo $data_stu->rsd_Identification;?></td>
									<td><?php echo $prefix."&nbsp;".$data_stu->rsd_name."&nbsp;".$data_stu->rsd_surname;?></td>
									<td><?php echo $call_levelA;?></td>
									<td><?php echo $call_levelB;?></td>
									<td><?php echo $quotaA->plan_LName;?></td>
									
					<?php
							if($quotaB->plan_LName=="" or $quotaB->plan_LName==null){ ?>
									<td><div>ไม่ประสงค์สอบย้ายห้องเรียน/แผนการ</div></td>	
									<td><div>-</div></td>
					<?php	}else{ ?>
									<td><div><?php echo $quotaB->plan_LName;?></div></td>
									
						<?php
							$ShowDeleteTheTest=new ShowDeleteTheTest($data_stu->rsd_studentid,$copy_year,$copy_level,$calltodata["qce_key"],"ShowDate");
							if(is_array($ShowDeleteTheTest->RunShowTheTest()) && count($ShowDeleteTheTest->RunShowTheTest())){
								foreach($ShowDeleteTheTest->RunShowTheTest() as $rc=>$ShowDeleteTheTestRow){
									if(isset($ShowDeleteTheTestRow["qtt_id"])){
										$qtt_id=$ShowDeleteTheTestRow["qtt_id"];
										$qtt_year=$ShowDeleteTheTestRow["qtt_year"];
										$qtt_plan=$ShowDeleteTheTestRow["qtt_plan"];
										$qtt_class=$ShowDeleteTheTestRow["qtt_class"];
									}else{
										$qtt_id="-";
										$qtt_year="-";
										$qtt_plan="-";
										$qtt_class="-";							
									}
								}		
							}else{
								$qtt_id="-";
								$qtt_year="-";
								$qtt_plan="-";
								$qtt_class="-";
							}
						?>				
									
									
									
									<td><div><?php echo $qtt_id;?></div></td>
					<?php	}?>				

									
									
									<td><?php echo date_timeThailand($calltodata["requset_datetime"]);?></td>
								</tr>					
						
			<?php	}?>			
							
							
							


							</tbody>
						</table>
			</div>
		</div>
	</div>
</div>