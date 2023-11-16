<?php
	include("../../../../database/database_evaluation.php");
	
	include("../../../../database/pdo_conndatastu.php");
	include("../../../../database/class_pdodatastu.php");
	
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");
	
	include("../../../../database/database_paynew.php");
	include("../../../../database/class_pay.php");
	
	$txt_year=post_data(filter_input(INPUT_POST,'txt_year'));
	$txt_class=post_data(filter_input(INPUT_POST,'txt_class'));
	$txt_room=post_data(filter_input(INPUT_POST,'txt_room'));
	
	$txt_t=substr($txt_year,0,1);
	$txt_y=substr($txt_year,2,4);

	$txt_level=new print_level($txt_class);
	
	$Payment_Date=date("2021/06/01"); 
	$Payment_Date=date("d/m/y",strtotime($Payment_Date));
	
?>
<!--****************************************************************************-->			
<script>
		$(document).ready(function () {

    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>กรอง:</span> _INPUT_',
            searchPlaceholder: 'พิมพ์เพื่อกรอง...',
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
					filename: 'ค่าธรรมเนียมการศึกษา สร้าง Execl นำเข้าสู่ระบบ SCB  ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
					title: 'ค่าธรรมเนียมการศึกษา สร้าง Execl นำเข้าสู่ระบบ SCB  ชั้น <?php echo $txt_level->level_Sort_name;?> / <?php echo $txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?>',
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



<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading">ค่าธรรมเนียมการศึกษา สร้าง Execl นำเข้าสู่ระบบ SCB  ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></div>
			<div class="panel-body">

				<div class="table-responsive">				
					<table class="table datatable-button-html5-columns table-bordered">
						<thead>   
							<tr>
								<th colspan="9"><center>ค่าธรรมเนียมการศึกษา สร้าง Execl นำเข้าสู่ระบบ SCB  ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></center></th>
							</tr>
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
						</thead>
						<tbody>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		switch($txt_t){
		case 1:	?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php
					if($txt_class==3){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}elseif($txt_class==11){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}elseif($txt_class==31){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}elseif($txt_class==41){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--===================================================================================================-->	
			<?php			
				$data_sturcroom=new data_sturoom($txt_t,$txt_y,$txt_class,$txt_room);	
				foreach($data_sturcroom->printdata_sturoom as $rc_key=>$sturcroom_rom){ 
					$rsc_num=$sturcroom_rom["rsc_num"];
					$rsd_studentid=$sturcroom_rom["rsd_studentid"];
					$rsd_Identification=$sturcroom_rom["rsd_Identification"];
					$nickTh=$sturcroom_rom["nickTh"];
					$nickEn=$sturcroom_rom["nickEn"];
					$rsc_txt=$sturcroom_rom["rsc_txt"];
					$data_prefix=new print_prefix($rsd_prefix=$sturcroom_rom["rsd_prefix"]);
					$data_plan=new print_plan($rsc_plan=$sturcroom_rom["rsc_plan"]);
					
					$name_th=$data_prefix->prefix_prefix_SName." ".$sturcroom_rom["rsd_name"]." ".$sturcroom_rom["rsd_surname"];
					$name_en="Miss ".$sturcroom_rom["rsd_nameEn"]." ".$sturcroom_rom["rsd_surnameEn"];
					
					if($sturcroom_rom["rse_home"]==1){
						$print_home="ฟ";
					}elseif($sturcroom_rom["rse_home"]==2){
						$print_home="ด";
					}elseif($sturcroom_rom["rse_home"]==3){
						$print_home="ล";
					}elseif($sturcroom_rom["rse_home"]==4){
						$print_home="ข";
					}else{
						$print_home="";
					}
					
					$data_prefix=new print_prefix($rsd_prefix=$sturcroom_rom["rsd_prefix"]);
					
					
					$data_student=new data_student($rsd_studentid);
					
					if($sturcroom_rom["rsc_class"]>=23){
						$pay_Islamic=0;								
					}else{
						$pay_Islamic=3000;						
					}
					

					
				?>


		<?php
				if($sturcroom_rom["rsc_status"]>=2){ ?>
					<!--	<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>	-->					
		<?php	}elseif($rsc_txt=="n"){ ?>
					<!--	<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>	-->		
		<?php   }else{ ?>
<!--****************************************************************************-->	
		<?php 
			$set_pay=new print_stu_grouppay($rsd_studentid,$txt_y,$sturcroom_rom["rsc_plan"],$sturcroom_rom["rsc_class"]);
			if($set_pay->pp_pay!=Null){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
							<tr>
								<td></td>
								<td><?php echo $rsd_studentid." - ".$data_prefix->prefix_prefix_SName." ".$sturcroom_rom["rsd_name"]." ".$sturcroom_rom["rsd_surname"];?></td>
								<td><?php echo $rsd_studentid;?></td>
								<td>TUITIONFEES<?php echo $txt_t."0".$txt_y;?></td>
								
								<?php
										if($data_student->IDReligion=="3"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td><?php echo $set_pay->pp_pay-$pay_Islamic;?></td>									
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
								<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td><?php echo $set_pay->pp_pay;?></td>									
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
								<?php	}      ?>
								

								<td><?php echo $Payment_Date;?></td>
								<td></td>
								<td>ค่าธรรมเนียมการศึกษา ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></td>
								<td></td>
							</tr>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
		<?php	}else{  
				$set_datafee=new print_pay_datafee($sturcroom_rom["rsc_plan"],$sturcroom_rom["rsc_class"]);
					if($set_datafee->printpdf_pay()!=Null){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
							<tr>
								<td></td>
								<td><?php echo $rsd_studentid." - ".$data_prefix->prefix_prefix_SName." ".$sturcroom_rom["rsd_name"]." ".$sturcroom_rom["rsd_surname"];?></td>
								<td><?php echo $rsd_studentid;?></td>
								<td>TUITIONFEES<?php echo $txt_t."0".$txt_y;?></td>
								
								<?php
										if($data_student->IDReligion=="3"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td><?php echo $set_datafee->printpdf_pay()-$pay_Islamic;?></td>									
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
								<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td><?php echo $set_datafee->printpdf_pay();?></td>									
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
								<?php	}      ?>								
									
								<td><?php echo $Payment_Date;?></td>
								<td></td>
								<td>ค่าธรรมเนียมการศึกษา ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></td>
								<td></td>
							</tr>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php		}else{  ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
		<?php		}
			}	?>					
<!--****************************************************************************-->	
		<?php	}      ?>			
<!--------------------------------------------------------------------------------->				
			<?php	} ?>			
<!--===================================================================================================-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
			<?php	}      ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php	break;		
		case 2: ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--===================================================================================================-->	
			<?php			
				$data_sturcroom=new data_sturoom($txt_t,$txt_y,$txt_class,$txt_room);	
				foreach($data_sturcroom->printdata_sturoom as $rc_key=>$sturcroom_rom){ 
					$rsc_num=$sturcroom_rom["rsc_num"];
					$rsd_studentid=$sturcroom_rom["rsd_studentid"];
					$rsd_Identification=$sturcroom_rom["rsd_Identification"];
					$nickTh=$sturcroom_rom["nickTh"];
					$nickEn=$sturcroom_rom["nickEn"];
					$rsc_txt=$sturcroom_rom["rsc_txt"];
					$data_prefix=new print_prefix($rsd_prefix=$sturcroom_rom["rsd_prefix"]);
					$data_plan=new print_plan($rsc_plan=$sturcroom_rom["rsc_plan"]);
					
					$name_th=$data_prefix->prefix_prefix_SName." ".$sturcroom_rom["rsd_name"]." ".$sturcroom_rom["rsd_surname"];
					$name_en="Miss ".$sturcroom_rom["rsd_nameEn"]." ".$sturcroom_rom["rsd_surnameEn"];
					
					if($sturcroom_rom["rse_home"]==1){
						$print_home="ฟ";
					}elseif($sturcroom_rom["rse_home"]==2){
						$print_home="ด";
					}elseif($sturcroom_rom["rse_home"]==3){
						$print_home="ล";
					}elseif($sturcroom_rom["rse_home"]==4){
						$print_home="ข";
					}else{
						$print_home="";
					}
					
					$data_prefix=new print_prefix($rsd_prefix=$sturcroom_rom["rsd_prefix"]);
					
					
					$data_student=new data_student($rsd_studentid);
					
					if($sturcroom_rom["rsc_class"]>=23){
						$pay_Islamic=0;								
					}else{
						$pay_Islamic=3000;						
					}
					

					
				?>


		<?php
				if($sturcroom_rom["rsc_status"]>=2){ ?>
					<!--	<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>	-->					
		<?php	}elseif($rsc_txt=="n"){ ?>
					<!--	<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>	-->			
		<?php   }else{ ?>
<!--****************************************************************************-->	
		<?php 
			$set_pay=new print_stu_grouppay($rsd_studentid,$txt_y,$sturcroom_rom["rsc_plan"],$sturcroom_rom["rsc_class"]);
			if($set_pay->pp_pay!=Null){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
							<tr>
								<td></td>
								<td><?php echo $rsd_studentid." - ".$data_prefix->prefix_prefix_SName." ".$sturcroom_rom["rsd_name"]." ".$sturcroom_rom["rsd_surname"];?></td>
								<td><?php echo $rsd_studentid;?></td>
								<td>TUITIONFEES<?php echo $txt_t."0".$txt_y;?></td>
								
								<?php
										if($data_student->IDReligion=="3"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td><?php echo $set_pay->pp_pay-$pay_Islamic;?></td>									
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
								<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td><?php echo $set_pay->pp_pay;?></td>									
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
								<?php	}      ?>
								

								<td><?php echo $Payment_Date;?></td>
								<td></td>
								<td>ค่าธรรมเนียมการศึกษา ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></td>
								<td></td>
							</tr>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
		<?php	}else{  
				$set_datafee=new print_pay_datafee($sturcroom_rom["rsc_plan"],$sturcroom_rom["rsc_class"]);
					if($set_datafee->printpdf_pay()!=Null){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
							<tr>
								<td></td>
								<td><?php echo $rsd_studentid." - ".$data_prefix->prefix_prefix_SName." ".$sturcroom_rom["rsd_name"]." ".$sturcroom_rom["rsd_surname"];?></td>
								<td><?php echo $rsd_studentid;?></td>
								<td>TUITIONFEES<?php echo $txt_t."0".$txt_y;?></td>
								
								<?php
										if($data_student->IDReligion=="3"){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td><?php echo $set_datafee->printpdf_pay()-$pay_Islamic;?></td>									
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->										
								<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
								<td><?php echo $set_datafee->printpdf_pay();?></td>									
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->											
								<?php	}      ?>								
									
								<td><?php echo $Payment_Date;?></td>
								<td></td>
								<td>ค่าธรรมเนียมการศึกษา ชั้น <?php echo $txt_level->level_Sort_name."/".$txt_room;?> ภาคเรียนที่ <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y;?></td>
								<td></td>
							</tr>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
		<?php		}else{  ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->									
		<?php		}
			}	?>					
<!--****************************************************************************-->	
		<?php	}      ?>			
<!--------------------------------------------------------------------------------->				
			<?php	} ?>			
<!--===================================================================================================-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<?php	break;
		default:
			//---------------------------------------------------
		}
	?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
</div>