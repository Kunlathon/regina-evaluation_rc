<?php
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");	
?>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">กิจกรรมเรียนเสริมภาคฤดูร้อน&nbsp;>&nbsp;</span>ตั้งค่าระบบ&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>&nbsp;ตั้งค่าระบบ&nbsp;</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>



<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-success">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home">ตั้งค่าการลงทะเบียน</a></li>
				<li><a data-toggle="tab" href="#menu1">ตั้งค่ารายการปีการศึกษา</a></li>
			</ul>						
		</div>	  
	</div>
</div>


<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-info">
			<div class="tab-content">
				<div id="home" class="tab-pane fade in active">
<form name="summer_set_home"> 
	<?php 
		$PrintSystem=new SystemSummer("read","-","-","-","-","-","-","-","-","-","-");
			if(($PrintSystem->RunSS_Error()=="No")){
				foreach($PrintSystem->RunSS_Array() as $rc=>$PrintSystemRow){
					$data_yaer=$PrintSystemRow["data_yaer"];
					$data_term=$PrintSystemRow["data_term"];
					$data_summer=$PrintSystemRow["data_summer"];
					$OFFONDateTime=date("Y-m-d H:i:s",strtotime($PrintSystemRow["OFFONDateTime"]));
					$EndDateTime=date("Y-m-d H:i:s",strtotime($PrintSystemRow["EndDateTime"]));
					$test_system=$PrintSystemRow["test_system"];
					$time_add=date("Y-m-d H:i:s",strtotime($PrintSystemRow["time_add"]));
					$DeletePay_Sud=$PrintSystemRow["DeletePay_Sud"];
					$DeletePay_Admin=$PrintSystemRow["DeletePay_Admin"];
					$End4143_notrun=$PrintSystemRow["End4143_notrun"];
				}
			}else{
				$data_yaer="-";
				$data_term="-";
				$data_summer="-";
				$time_start="-";
				$time_end="-";
				$test_ict="-";	
				$DeletePay_Sud="-";
				$DeletePay_Admin="-";
				$End4143_notrun="-";
			}
	?>

	<div class="row">
		<div class="col-<?php echo $grid;?>-6">
			<fieldset class="content-group">
				<div class="form-group">
					<label class="control-label col-<?php echo $grid;?>-5">เปิด/ปิด ยกเลิกลงทะเบียน นักเรียน</label>
					<div class="col-<?php echo $grid;?>-7">
						<select class="select bg-danger-400" name="DeletePay_Sud" id="DeletePay_Sud" data-placeholder="เปิด/ปิด ยกเลิกลงทะเบียน นักเรียน">	
	<?php
			if(($DeletePay_Sud=="Yes")){ ?>
							<option></option>
							<option value="No">ปิด</option>
							<option value="Yes" selected="selected">เปิด</option>
	<?php	}elseif(($DeletePay_Sud=="No")){ ?>
							<option></option>
							<option value="No" selected="selected">ปิด</option>
							<option value="Yes">เปิด</option>	
	<?php   }else{ ?>
							<option></option>
							<option value="No">ปิด</option>
							<option value="Yes">เปิด</option>
	<?php 	} ?>
						</select>
					</div>
				</div>			
			</fieldset>		
		</div>
		<div class="col-<?php echo $grid;?>-6">
			<fieldset class="content-group">
				<div class="form-group">
					<label class="control-label col-<?php echo $grid;?>-5">เปิด/ปิด ยกเลิกลงทะเบียน เจ้าหน้าที่</label>
					<div class="col-<?php echo $grid;?>-7">
						<select class="select bg-danger-400" name="DeletePay_Admin" id="DeletePay_Admin" data-placeholder="เปิด/ปิด ยกเลิกลงทะเบียน เจ้าหน้าที่">	
	<?php
			if(($DeletePay_Admin=="Yes")){ ?>
							<option></option>
							<option value="No">ปิด</option>
							<option value="Yes" selected="selected">เปิด</option>
	<?php	}elseif(($DeletePay_Admin=="No")){ ?>
							<option></option>
							<option value="No" selected="selected">ปิด</option>
							<option value="Yes">เปิด</option>	
	<?php   }else{ ?>
							<option></option>
							<option value="No">ปิด</option>
							<option value="Yes">เปิด</option>
	<?php 	} ?>
						</select>					
					</div>					
				</div>			
			</fieldset>			
		</div>
	</div>

	<div class="row">
		<div class="col-<?php echo $grid;?>-6">
			<fieldset class="content-group">
				<div class="form-group">
					<label class="control-label col-<?php echo $grid;?>-5">ทดสอบระบบ</label>
					<div class="col-<?php echo $grid;?>-7">
						
						<select class="select bg-danger-400" name="test_system" id="test_system" data-placeholder="เปิด-ปิด ทดสอบระบบ">						
	<?php
			if(($test_system=="ON")){ ?>
							<option></option>
							<option value="OFF">ปิด</option>
							<option value="ON" selected="selected">เปิด</option>
	<?php	}elseif(($test_system=="OFF")){ ?>
							<option></option>
							<option value="OFF" selected="selected">ปิด</option>
							<option value="ON">เปิด</option>	
	<?php   }else{ ?>
							<option></option>
							<option value="OFF">ปิด</option>
							<option value="ON">เปิด</option>
	<?php 	} ?>								
						</select>
				
					
					</div>
				</div>			
			</fieldset>
		</div>
		<div class="col-<?php echo $grid;?>-6">
			<fieldset class="content-group">
				<div class="form-group">
					<label class="control-label col-<?php echo $grid;?>-5">เวลาเริ่มต้นลงทะเบียน</label>
					<div class="col-<?php echo $grid;?>-7">
						<span class="input-group-btn">
							<button type="button" class="btn btn-default btn-icon" id="OFFONDateTime_button"><i class="icon-calendar3"></i></button>
						</span>
						<input type="text" name="OFFONDateTime" id="OFFONDateTime" class="form-control" data-popup="tooltip" data-trigger="focus" title="เวลาเปิด-ปิดการยกเลิกลงทะเบียน" placeholder="เวลาเปิด-ปิดการยกเลิกลงทะเบียน" required="required" value="<?php echo $OFFONDateTime;?>">
					</div>
					<span class="help-block">Format must be YYYY-MM-DD HH:MM:SS</span>
				</div>			
			</fieldset>
		</div>		
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-6">
			<fieldset class="content-group">
				<div class="form-group">
					<label class="control-label col-<?php echo $grid;?>-5">เวลาสิ้นสุดลงทะเบียน</label>
					<div class="col-<?php echo $grid;?>-7">
						<span class="input-group-btn">
							<button type="button" class="btn btn-default btn-icon" id="EndDateTime_button"><i class="icon-calendar3"></i></button>
						</span>
						<input type="text" name="EndDateTime" id="EndDateTime" class="form-control" data-popup="tooltip" data-trigger="focus" title="เวลาเปิด-ปิดการยกเลิกลงทะเบียน" placeholder="เวลาเปิด-ปิดการยกเลิกลงทะเบียน" required="required" value="<?php echo $EndDateTime;?>">
					</div>
					<span class="help-block">Format must be YYYY-MM-DD HH:MM:SS</span>
				</div>			
			</fieldset>		
		</div>
		<div class="col-<?php echo $grid;?>-6">
			<fieldset class="content-group">
				<div class="form-group">
					<label class="control-label col-<?php echo $grid;?>-5">ปีการศึกษานักเรียน</label>
					<div class="col-<?php echo $grid;?>-7">
						<input type="text" name="data_yaer" id="data_yaer" minlength="1" maxlength="4" class="form-control" data-popup="tooltip" data-trigger="focus" title="ปีการศึกษานักเรียน" placeholder="ปีการศึกษานักเรียน" required="required" value="<?php echo $data_yaer;?>">
					</div>
				</div>			
			</fieldset>			
		</div>		
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-6">
			<fieldset class="content-group">
				<div class="form-group">
					<label class="control-label col-<?php echo $grid;?>-5">เทอมนักเรียน</label>
					<div class="col-<?php echo $grid;?>-7">
						<input type="text" name="data_term" id="data_term" class="form-control" minlength="0" maxlength="1" data-popup="tooltip" data-trigger="focus" title="เทอมนักเรียน" placeholder="เทอมนักเรียน" required="required" value="<?php echo $data_term;?>">
					</div>
				</div>			
			</fieldset>			
		</div>
		<div class="col-<?php echo $grid;?>-6">
			<fieldset class="content-group">
				<div class="form-group">
					<label class="control-label col-<?php echo $grid;?>-5">ปีการศึกษาเรียนเสริมภาคฤดูร้อน</label>
					<div class="col-<?php echo $grid;?>-7">
						<input type="text" name="data_summer" id="data_summer" class="form-control" minlength="1" maxlength="4"  data-popup="tooltip" data-trigger="focus" title="ปีการศึกษาเรียนเสริมภาคฤดูร้อน" placeholder="ปีการศึกษาเรียนเสริมภาคฤดูร้อน" required="required" value="<?php echo $data_summer;?>">
					</div>
				</div>			
			</fieldset>			
		</div>		
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-6">
			<fieldset class="content-group">
				<div class="form-group">
					<label class="control-label col-<?php echo $grid;?>-5">เวลาเปิด-ปิดการยกเลิกลงทะเบียน</label>
					<div class="col-<?php echo $grid;?>-7">
						<span class="input-group-btn">
							<button type="button" class="btn btn-default btn-icon" id="time_add_button"><i class="icon-calendar3"></i></button>
						</span>
						<input type="text" name="time_add" id="time_add" class="form-control" data-popup="tooltip" data-trigger="focus" title="เวลาเปิด-ปิดการยกเลิกลงทะเบียน" placeholder="เวลาเปิด-ปิดการยกเลิกลงทะเบียน" required="required" value="<?php echo $time_add;?>">
					</div>
					<span class="help-block">Format must be YYYY-MM-DD HH:MM:SS</span>
				</div>			
			</fieldset>			
		</div>
		<div class="col-<?php echo $grid;?>-6">
			<fieldset class="content-group">
				<div class="form-group">
					<label class="control-label col-<?php echo $grid;?>-5">เวลาสิ้นสุดการลงทะเบียนนักเรียนระดับชั้นมัธยมศึกษาตอนปลาย</label>
					<div class="col-<?php echo $grid;?>-7">
						<span class="input-group-btn">
							<button type="button" class="btn btn-default btn-icon" id="time_add_button4143"><i class="icon-calendar3"></i></button>
						</span>
						<input type="text" name="End4143_notrun" id="End4143_notrun" class="form-control" data-popup="tooltip" data-trigger="focus" title="เวลาเปิด-ปิดการยกเลิกลงทะเบียน" placeholder="เวลาเปิด-ปิดการยกเลิกลงทะเบียน" required="required" value="<?php echo $End4143_notrun;?>">
					</div>
					<span class="help-block">Format must be YYYY-MM-DD HH:MM:SS</span>
				</div>			
			</fieldset>		
		</div>		
	</div>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<fieldset class="content-group">
				<div class="form-group">
					<div class="row">
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" name="Save_Summer_Set_Home" id="Save_Summer_Set_Home" class="btn btn-success">บันทึก</button>
						</div>
						<div class="col-<?php echo $grid;?>-6">
							<button type="button" name="" id="" class="btn btn-info">ล้างรายการ</button>
						</div>
					</div>
				</div>			
			</fieldset>			
		</div>
	</div>
	
	<div id="show_summer_home"></div>
	
</form>

	<script>
		$(document).ready(function(){
			// Alert combination
			$('#Save_Summer_Set_Home').on('click', function() {
				var test_system=$("#test_system").val();
				var	OFFONDateTime=$("#OFFONDateTime").val();
				var	EndDateTime=$("#EndDateTime").val();
				var	data_yaer=$("#data_yaer").val();
				var	data_term=$("#data_term").val();
				var	data_summer=$("#data_summer").val();
				var	time_add=$("#time_add").val();	
				var DeletePay_Sud=$("#DeletePay_Sud").val();
				var DeletePay_Admin=$("#DeletePay_Admin").val();
				var End4143_notrun=$("#End4143_notrun").val();
				swal({
					title: "ต้องการบันทึกใช้หรือไม่",
					text: "บันทึกการเปลียนแปลงการตั้งค่าระบบ",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#EF5350",
					confirmButtonText: "ใช้, ต้องการบันทึก",
					cancelButtonText: "ไม่ใช้, ไม่ต้องการบันทึก",
					closeOnConfirm: false,
					closeOnCancel: false
				},function(isConfirm){
					if(isConfirm) {
						if(test_system!="" &&  OFFONDateTime!="" && EndDateTime!="" && data_yaer!="" && data_term!="" && data_summer!="" && time_add!="" && End4143_notrun!=""){
							swal({
								title: "ดำเนินการบันทึก",
								confirmButtonColor: "#66BB6A",
								type: "success"
							},function(){
								$.post("<?php echo $golink;?>/Summer/Save_Summer_Set_Home",{
									test_system:test_system,
									OFFONDateTime:OFFONDateTime,
									EndDateTime:EndDateTime,
									data_yaer:data_yaer,
									data_term:data_term,
									data_summer:data_summer,
									time_add:time_add,
									DeletePay_Sud:DeletePay_Sud,
									DeletePay_Admin:DeletePay_Admin,
									End4143_notrun:End4143_notrun
								},function(home_summer){
									if(home_summer!=""){
										$("#show_summer_home").html(home_summer)
									}else{}
								})								
							});
							
						}else{
							swal({
								title: "พบข้อผิดพลาดไม่สามารถดำเนินการได้",
								confirmButtonColor: "#2196F3",
								type: "error"
							});							
						}
						
					}else{
						swal({
							title: "ไม่ดำเนินการบันทึก",
							confirmButtonColor: "#2196F3",
							type: "error"
						});
					}
				});
			});
		})
	</script>		
				
				</div>
				<div id="menu1" class="tab-pane fade">
<form name="summer_set_menu1"> 
	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel-body">
				<code>ข้อมูลรายปี</code><strong>เรียนเสริมภาคฤดูร้อน</strong>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12" style="text-align: center;">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModa2">เพิ่มข้อมูล</button>
		</div>
	</div>
	
	<div class="modal fade" id="myModa2" role="dialog">
		<?php
			$CallSYNotRow=new SystemYear("notrow","-","-");
				if(($CallSYNotRow->RunST_Error()=="No")){
					foreach($CallSYNotRow->RunST_Array() as $rc =>$ReadSYNotRow){
						$CSYNR_Year=$ReadSYNotRow["sy_id"];
						$CSYNR_Year=$CSYNR_Year+1;
					}
				}else{
					$CSYNR_Year=date("y");
				}
		?>
		<div class="modal-dialog">
<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">เพิ่มข้อมูลรายปี เรียนเสริมภาคฤดูร้อน</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<fieldset class="content-group">
								<div class="form-group">
									<label class="control-label col-<?php echo $grid;?>-5">ข้อมูลรายปี  เรียนเสริมภาคฤดูร้อน</label>
									<div class="col-<?php echo $grid;?>-7">
										<input type="text" name="sy_id" id="sy_id" class="form-control" minlength="1" maxlength="4"  data-popup="tooltip" data-trigger="focus" title="ข้อมูลรายปี เรียนเสริมภาคฤดูร้อน" placeholder="ข้อมูลรายปี เรียนเสริมภาคฤดูร้อน" required="required" value="<?php echo $CSYNR_Year;?>">
									</div>									
								</div>
							</fieldset>						
						</div>
					</div>
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<fieldset class="content-group">
								<div class="form-group">								
								
								</div>
							</fieldset>						
						</div>
					</div>					

				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
				</div>
			</div>
<!-- Modal content-->		  
		</div>
	</div>
	
		<script>
			$(document).ready(function(){
				$('#sweet_combine').on('click', function() {
					swal({
						title: "Are you sure?",
						text: "You will not be able to recover this imaginary file!",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#EF5350",
						confirmButtonText: "Yes, delete it!",
						cancelButtonText: "No, cancel pls!",
						closeOnConfirm: false,
						closeOnCancel: false
					},
					function(isConfirm){
						if (isConfirm) {
							swal({
								title: "Deleted!",
								text: "Your imaginary file has been deleted.",
								confirmButtonColor: "#66BB6A",
								type: "success"
							});
						}
						else {
							swal({
								title: "Cancelled",
								text: "Your imaginary file is safe :)",
								confirmButtonColor: "#2196F3",
								type: "error"
							});
						}
					});
				});				
				
			})	
		</script>	
	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
					<div class="table-responsive">
						<table class="table datatable-basic">
							<thead>
								<tr>
									<th><div>ID</div></th>
									<th><div>ปีการศึกษา (Year)</div></th>
								</tr>
							</thead>
							<tbody>
	<?php
		$CallSYRow=new SystemYear("read","-","-");
			if(($CallSYRow->RunST_Error()=="No")){
				foreach($CallSYRow->RunST_Array() as $rc =>$ReadSY){  ?>
								
								<tr>
									<td><div><?php echo $ReadSY["sy_id"];?></div></td>
									<td><div><?php echo $ReadSY["sy_year"];?></div></td>
								</tr>					
	<?php		}
			}else{}?>
							</tbody>
						</table>
					</div>
		</div>
	</div>

</form>

				</div>
			</div>		
		</div>
	</div>
</div>










