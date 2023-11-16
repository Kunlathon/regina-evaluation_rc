<?php
	//include("view/database/pdo_data.php");
	//include("view/database/class_admin.php");
	//include("view/database/class_pdo.php");	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">รายชื่อนักเรียน </span>ค้นหาข้อมูลนักเรียนรายบุคคล</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>รายชื่อนักเรียน ค้นหาข้อมูลนักเรียนรายบุคคล</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel">
			<div class="panel-heading bg-primary">
				<h6 class="panel-title">ค้นหาข้อมูล</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="reload"></a></li>
					</ul>
				</div>
			</div>
			<div class="panel-body">
<form name="student_data" class="form-horizontal">
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-<?php echo $grid;?>-4">ระบุข้อมูลที่ต้องการค้นหา</label>
								<div class="col-<?php echo $grid;?>-8">
									<div class="row">
										<input type="text" class="form-control" name="rc_data" id="rc_data" maxlength="100">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">
								<label class="radio-inline"><!--checked="checked"-->
									<input type="radio" class="styled" name="run_sd"  value="rc_key">
									ค้นหาจาก : รหัสนักเรียน
								</label>						
							</div>
							<div class="col-<?php echo $grid;?>-6">
								<label class="radio-inline">
									<input type="radio" class="styled"  name="run_sd"  value="rc_in">
									ค้นหาจาก : รหัสเลขประจำตัวประชาชน
								</label>						
							</div>
						</div>
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">
								<label class="radio-inline">
									<input type="radio" class="styled"  name="run_sd"  value="rc_name">
									ค้นหาจาก : ชื่อ
								</label>						
							</div>
							<div class="col-<?php echo $grid;?>-6">
								<label class="radio-inline">
									<input type="radio" class="styled"  name="run_sd"  value="rc_surname">
									ค้นหาจาก : นามสกุล
								</label>						
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<fieldset class="content-group">
							<div class="form-group">
								<button type="button" class="btn btn-danger btn-<?php echo $grid;?>" name="but_student_data" id="but_student_data">ค้นหา <i class="icon-play3 position-right"></i></button>
							</div>
						</fieldset>
					</div>
				</div>
</form>						
			</div>
		</div>
	</div>
</div>

<div id="student_data"></div>

<script>
	$(document).ready(function(){
		$("#but_student_data").on('click',function(){
			var rc_data=$("#rc_data").val();
			var rc_click="";
				if(rc_data==""){
					swal({
						title: "กรุณาระบุข้อมูลที่ต้องการค้นหา",
						confirmButtonColor: "#66BB6A",
						type: "warning"
                	});
				}else{
//----------------------------------------------------------------------------------------------------
					var run_sd=document.forms[0];
					var count_sd=0;
					while(count_sd < run_sd.length){
						if (run_sd[count_sd].checked) {
							rc_click = rc_click + run_sd[count_sd].value + " ";
   						}else{}
						count_sd=count_sd+1;
					}
//----------------------------------------------------------------------------------------------------
						if(rc_click=="" || rc_data==""){
							swal({
								title: "พบข้อผิดพลาด",
								confirmButtonColor: "#66BB6A",
								type: "error"
                			});
						}else{
							$.post("<?php echo $golink;?>/Student_data",{
								rc_data:rc_data,
								rc_click:rc_click
							},function(run_sd){
								if(run_sd!=""){
									$("#student_data").html(run_sd)
								}else{}
							})
						}
//----------------------------------------------------------------------------------------------------
				}
		})
	})
</script>