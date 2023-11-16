<?php
    include("../../../../database/database_evaluation.php");
	include("../../../../database/pdo_data.php");
	include("../../../../database/pdo_conndatastu.php");
	include("../../../../database/pdo_admission.php");
//==================================================================================    
    include("../../../../database/class_pdodatastu.php");
	include("../../../../database/class_admin.php");
//==================================================================================			
    include("../../../../database/regina_student.php");
			
?>
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
    $txt_year=filter_input(INPUT_POST,'txt_year');
	$txt_class=filter_input(INPUT_POST,'txt_class');
        if(isset($txt_year,$txt_class)){ 
            $txt_level=new print_level($txt_class);
        ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->            
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
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
					filename: 'ข้อมูล นักเรียนใหม่ รายงานส่งห้องวัดผล ชั้น <?php echo $txt_level->level_Sort_name;?> ปีการศึกษา <?php echo $txt_year;?>',
					title: 'ข้อมูล นักเรียนใหม่ รายงานส่งห้องวัดผล ชั้น <?php echo $txt_level->level_Sort_name;?> ปีการศึกษา <?php echo $txt_year;?>',
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
				"searching"    : false,
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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->            
<div class="row">
    <div class="col-<?php echo $grid;?>-12">
        <div class="panel panel-success">
            <div class="panel-heading">ข้อมูล นักเรียนใหม่ รายงานส่งห้องวัดผล ชั้น  <?php echo $txt_level->level_Sort_name;?>  ปีการศึกษา <?php echo $txt_year;?></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-<?php echo $grid;?>-12">
                        <div class="table-responsive">
                            <table class="table datatable-button-html5-columns table-bordered">
                                <thead>   
                                    <tr>
                                        <th><div>เลขประจำตัว</div></th>
                                        <th><div>เลขประจำตัวประชาชน</div></th>
                                        <th><div>ชื่อ - นามสกุล</div></th>
                                        <th><div>วัน/เดือน/ปี เกิด</div></th>
                                        <th><div>ตำบลที่เกิด</div></th>
                                        <th><div>อำเภอที่เกิด</div></th>
                                        <th><div>จังหวัดที่เกิด</div></th>
                                        <th><div>ชื่อบิดา</div></th>
                                        <th><div>อาชีพบิดา</div></th>
                                        <th><div>ชื่อมารดา</div></th>
                                        <th><div>อาชีพมารดา</div></th>
                                        <th><div>สถานศึกษาเดิม</div></th>
                                        <th><div>จังหวัดสถานศึกษาเดิม</div></th>
                                        <th><div>เหตุที่ย้าย</div></th>
                                        <th><div>วันที่เข้าเรียน</div></th>
                                        <th><div>ที่อยู่ปัจจุบัน</div></th>
                                        <th><div>ความรู้เดิม ( จบชั้น )</div></th>
                                        <th><div>วันที่จำหน่าย</div></th>
                                        <th><div>เหตุที่จำหน่าย</div></th>
                                        <th><div>ความรู้และความประพฤติ</div></th>
                                        <th><div>หมายเหตุ</div></th>
                                    </tr>
                                </thead> 
                                <tbody>
<?php
    $call_std_new=new NewRcClass($txt_class,$txt_year);
        foreach($call_std_new->RunNewRcClass() as $rc=>$std_new){ 
            $data_std=new PrintReginaStuData($std_new["rsn_id"]);
		//data_student
			$call_data_student=new data_student($std_new["rsn_id"]);	
		//breed_district
                if(isset($call_data_student->breed_district)){
                    $breed_district=new	data_Subdistrict($call_data_student->breed_district); //$stu_physical->DISTRICT_NAME    
                }else{}
		//breed_city
                if(isset($call_data_student->breed_city)){
                    $breed_city=new data_District($call_data_student->breed_city); //$breed_city->AMPHUR_NAME
                }else{}
		//breed_province
                if(isset($call_data_student->breed_province)){
                    $breed_province=new data_Province($call_data_student->breed_province); //$breed_province->PROVINCE_NAME	
                }else{}
		//stu_address_home
                $call_stu_address=new stu_address($std_new["rsn_id"]);
            
                if(isset($call_stu_address->stu_tumbon)){
                    $stu_tumbon=new data_Subdistrict($call_stu_address->stu_tumbon); //$stu_tumbon->DISTRICT_NAME                    
                }else{}
                
                if(isset($call_stu_address->stu_amphur)){
                    $stu_amphur=new data_District($call_stu_address->stu_amphur); //$stu_amphur->AMPHUR_NAME                    
                }else{}
                
                if(isset($call_stu_address->stu_province)){
                    $stu_province=new data_Province($call_stu_address->stu_province); //$stu_province->PROVINCE_NAME
                }else{}                
            



        //stu_guardian_address
            $call_stu_guardian_address=new stu_guardian_address($std_new["rsn_id"]);
				
                if(isset($call_stu_guardian_address->parent_tumbon)){
                    $parent_tumbon=new data_Subdistrict($call_stu_guardian_address->parent_tumbon);//$parent_tumbon->DISTRICT_NAME
                }else{}
                if(isset($call_stu_guardian_address->parent_amphur)){
                    $parent_amphur=new data_District($call_stu_guardian_address->parent_amphur);//$parent_amphur->AMPHUR_NAME
                }else{}            
                if(isset($call_stu_guardian_address->parent_province)){
                    $parent_province=new data_Province($call_stu_guardian_address->parent_province);//$parent_province->PROVINCE_NAME
                }else{} 				
					
			//depend_stu
				$call_depend_stu=new depend_stu($std_new["rsn_id"]);					
			//ds_FMstatus
                if(isset($call_depend_stu->ds_FMstatus)){
                    $ds_FMstatus=new data_family($call_depend_stu->ds_FMstatus);
                }else{}
				
				$print_student=new data_student($std_new["rsn_id"]);
                    if(isset($print_student->ds_OriginalClass)){
                        $call_ds_OriginalClass=new print_level($print_student->ds_OriginalClass);                        
                    }else{}
                    if(isset($print_student->ds_ProvinceSchool)){
                        $call_province=new data_Province($print_student->ds_ProvinceSchool);    
                    }else{}
		//stu_father
			$call_stu_father=new stu_father($std_new["rsn_id"]);	
		//father_prefix
                if(isset($call_stu_father->father_prefix)){
                    $father_prefix=new stu_prefix($call_stu_father->father_prefix);                    
                }else{}

		//father_career
                if(isset($call_stu_father->father_career)){
                   $call_father_career=new data_career($call_stu_father->father_career); 
                }else{}
			
		//stu_mother
			$call_stu_mother=new stu_mother($std_new["rsn_id"]);
        //mother_prefix
                if(isset($call_stu_mother->mother_prefix)){
                    $mother_prefix=new stu_prefix($call_stu_mother->mother_prefix);                   
                }else{}
                
		//mother_career
                if(isset($call_stu_mother->mother_career)){
                    $mother_career=new data_career($call_stu_mother->mother_career);
                }else{}
            		                   
        ?>
            
                                    <tr>
                                        <td><div><?php echo $data_std->PRS_studentid;?></div></td>
                                        <td><div><?php echo $data_std->PRS_Identification;?></div></td>
                                        <td><div><?php echo $data_std->PRS_nameTH;?></div></td>
                                        
                            <?php
                                     if(isset($data_std->birth)){ ?>
                                        <td><div><?php echo date("d/m/Y",strtotime($data_std->birth));?></div></td>
                            <?php    }else{ ?>
                                        <td><div>&nbsp;</div></td>
                            <?php    } ?>            
                                        
                                        
                            <?php
                                     if(isset($breed_district->DISTRICT_NAME)){ ?>
                                        <td><div><?php echo $breed_district->DISTRICT_NAME;?></div></td>
                            <?php    }else{ ?>
                                        <td><div>&nbsp;</div></td>
                            <?php    } ?>            

                            <?php
                                     if(isset($breed_city->AMPHUR_NAME)){ ?>
                                        <td><div><?php echo $breed_city->AMPHUR_NAME;?></div></td>
                            <?php    }else{ ?>
                                        <td><div>&nbsp;</div></td>
                            <?php    } ?>  

                            <?php
                                     if(isset($breed_province->PROVINCE_NAME)){ ?>
                                        <td><div><?php echo $breed_province->PROVINCE_NAME;?></div></td>
                            <?php    }else{ ?>
                                        <td><div>&nbsp;</div></td>
                            <?php    } ?>                              
                      
                                        <td><div><?php echo $father_prefix->prefix_prefix_SName."&nbsp;".$call_stu_father->father_fname."&nbsp;".$call_stu_father->father_sname;?></div></td>


                            
							<?php
                                    if(isset($call_father_career->dc_txt2)){ ?>
                                        <td><div><?php echo $call_father_career->dc_txt2;?></div></td>
                            <?php   }else{ ?>
                                        <td><div>&nbsp;</div></td>
                            <?php   } ?>                            
                            
                                        <td><div>
                            <?php
                                    if($mother_prefix->prefix_prefix_SName!=null){
                                        echo $mother_prefix->prefix_prefix_SName."&nbsp;";
                                    }else{}
                                    
                                    if($call_stu_mother->mother_fname!=null){
                                        echo $call_stu_mother->mother_fname."&nbsp;";
                                    }else{}

                                    if($call_stu_mother->mother_sname!=null){
                                        echo $call_stu_mother->mother_sname;
                                    }else{}                                    
                            ?>
                                        </div></td>

                         
                            <?php
                                    if(isset($mother_career->dc_txt2)){ ?>
                                        <td><div><?php echo $mother_career->dc_txt2;?></div></td>
                            <?php   }else{ ?>
                                        <td><div>&nbsp;</div></td>
                            <?php   } ?>    
                                
                            <?php
                                    if(isset($print_student->ds_SameSchool)){ ?>
                                        <td><div><?php echo $print_student->ds_SameSchool;?></div></td>
                            <?php   }else{ ?>
                                        <td><div>&nbsp;</div></td>
                            <?php   }?>    
								
                                
                            <?php   if(isset($call_province->PROVINCE_NAME)){ ?>
                                        <td><div><?php echo $call_province->PROVINCE_NAME;?></div></td>
                            <?php   }else{ ?>
                                        <td><div>&nbsp;</div></td>
                            <?php   }?>
								
                                
								
                                
								
                                



                      
                                                
                               
                                       
                                        
                                        
                                        
                                        
                                        
                                        
                                        

                                        <td></td>
                                        <td></td>
                                        
                                        <td><div>
                                        
                                        <?php
                                                if($call_stu_address->stu_hno!=null){
                                                    echo $call_stu_address->stu_hno;
                                                }else{}
                                               
                                                if($call_stu_address->stu_moo!=null){
                                                    echo "&nbsp;หมู่ที่&nbsp;".$call_stu_address->stu_moo;
                                                }else{}
                                               
                                                if($call_stu_address->stu_soi!=null){
                                                    echo "&nbsp;ตรอก/ซอย&nbsp;".$call_stu_address->stu_soi;
                                                }else{}
                                            
                                                if($call_stu_address->stu_road!=null){
                                                    echo "&nbsp;ถนน&nbsp;".$call_stu_address->stu_road;
                                                }else{}
                                                
                                                if($stu_amphur->AMPHUR_NAME!=null){
                                                    echo "&nbsp;ตำบล&nbsp;".$stu_amphur->AMPHUR_NAME;
                                                }else{}
                                                
                                                if($stu_tumbon->DISTRICT_NAME!=null){
                                                    echo "&nbsp;อำเภอ&nbsp;".$stu_tumbon->DISTRICT_NAME;
                                                }else{}

                                                if($stu_province->PROVINCE_NAME!=null){
                                                    echo "&nbsp;จังหวัด&nbsp;".$stu_province->PROVINCE_NAME;
                                                }else{}

                                                if($call_stu_address->stu_zipcode!=null){
                                                    echo "&nbsp;รหัสไปรษณีย์&nbsp;".$call_stu_address->stu_zipcode;
                                                }else{}                                                
                                        
                                        ?>
                              
                                        </div></td>                                         
                                        
                                        
                    <?php
                            if($txt_class==3){ ?>
                                        <td><div>จบ อ.2 เข้าเรียน อ.3</div></td>						
                    <?php	}elseif($txt_class==11){ ?>
                                        <td><div>จบ อ.3 เข้าเรียน ป.1</div></td>					
                    <?php	}elseif($txt_class==12){ ?>
                                        <td><div>จบ ป.1 เข้าเรียน ป.2</div></td>					
                    <?php	}elseif($txt_class==13){ ?>
                                        <td><div>จบ ป.2 เข้าเรียน ป.3</div></td>					
                    <?php	}elseif($txt_class==21){ ?>
                                        <td><div>จบ ป.3 เข้าเรียน ป.4</div></td>					
                    <?php	}elseif($txt_class==22){ ?>
                                        <td><div>จบ ป.4 เข้าเรียน ป.5</div></td>					
                    <?php	}elseif($txt_class==23){ ?>
                                        <td><div>จบ ป.5 เข้าเรียน ป.6</div></td>					
                    <?php	}elseif($txt_class==31){ ?>
                                        <td><div>จบ ป.6 เข้าเรียน ม.1</div></td>					
                    <?php	}elseif($txt_class==32){ ?>
                                        <td><div>จบ ม.1 เข้าเรียน ม.2</div></td>					
                    <?php	}elseif($txt_class==33){ ?>
                                        <td><div>จบ ม.2 เข้าเรียน ม.3</div></td>					
                    <?php	}elseif($txt_class==41){ ?>
                                        <td><div>จบ ม.3 เข้าเรียน ม.4</div></td>					
                    <?php	}else{ ?>
                                        <td><div>&nbsp;</div></td>					
                    <?php	}	?>                                        
                                  
                                        
                                        <td></td>
                                        <td></td>
                                        
               
                                        
                                        <td></td>
                                        <td></td>
                                    </tr>            
            
<?php        }  ?>                                
  
                                
                                

                                </tbody>                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>            
            
            
            
            
            
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->            
<?php   }else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-danger">
				<div class="panel-heading">พบข้อผิดพลาด</div>
				<div class="panel-body">กรุณา เลือกปีการศึกษา และ ระดับชั้น</div>
			</div>		
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->           
<?php   } ?>







