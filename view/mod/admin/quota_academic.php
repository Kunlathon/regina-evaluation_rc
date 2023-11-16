<?php
	include("view/database/pdo_quota.php");
	include("view/database/pdo_data.php");
	include("view/database/class_quota.php");
?>

<?php
	$txt_call=filter_input(INPUT_GET,'txt_call');
	$txt_call=base64_decode($txt_call);
		if($txt_call=="qac01"){  ?>
	<script>
	$(document).ready(function () {		
		show_stack_bottom_right('error').show();
	})
	</script>			
<?php	}elseif($txt_call=="qac02"){  ?>
	<script>
	$(document).ready(function () {		
		show_stack_bottom_right('danger').show();
	})
	</script>		
<?php	}elseif($txt_call=="qac03"){  ?>
	<script>
	$(document).ready(function () {		
		show_stack_bottom_right('info').show();
	})
	</script>				
<?php	}else{
		//***********************
		}
?>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">นักเรียนโควต้าภายใน </span>นักเรียนติดปัญหาวิชาการ</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>นักเรียนติดปัญหาวิชาการ</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-info">
<form name="quota_academic" method="post" action="view/mod/admin/code/quota_academic/quota_academic_code.php">		
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<p class="text-semibold">เพิ่มข้อมูลนักเรียน ติดปัญหาห้องวิชาการ</p>
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<div class="form-group">	
							<select name="txt_year" id="txt_year"  data-placeholder="ปีการศึกษา..." class="select" required>
								<option></option>
									<!--		<optgroup label="ปีการศึกษา ล่วงหน้า 5 ปี">
									<?php
									/*	$yaer01=date("Y");
										$yaer01=$yaer01+543;
										$count01=1;
											while($count01<=5){  ?>
												<option value="<?php echo $yaer01;?>">ปีการศึกษา <?php echo $yaer01;?></option>
									<?php		$yaer01=$yaer01+1; 
												$count01=$count01+1; } */?>	
											</optgroup> -->
											<optgroup>
									<?php
										$yaer02=date("Y");
										$yaer02=$yaer02+543;
										$count02=1;
											while($count02<=5){ 
												if($txt_year==$yaer02){
													$selected="selected";
												}else{
													$selected="";
												}
											?>
												<option value="<?php echo $yaer02;?>" <?php echo $selected;?>>ปีการศึกษา <?php echo $yaer02;?></option>
									<?php		
												$yaer02=$yaer02-1;
												$count02=$count02+1; } ?>
								</optgroup>
							</select>
					</div>
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<div class="form-group">	
						<select name="txt_level" id="txt_level"  data-placeholder="ระดับชั้น..." class="select" required>
							<option></option>
							<optgroup label="ประถมศึกษา">
								<option value="23">ประถมศึกษาปีที่ 6</option>
							</optgroup>
							<optgroup label="มัธยมศึกษาตอนต้น">
								<option value="33">มัธยมศึกษาปีที่ 3</option>
							</optgroup>											
						</select>
					</div>				
				</div>
			</div>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
						<div id="data_stu">
						<select class="multiselect-full-featured" name="data_stu[]"  multiple="multiple">
							<optgroup label="รายชื่อนักเรียน"></optgroup>
						</select>		
						</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<center>
						<button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
						<a href="./?evaluation_mod=quota_academic"><button type="button" class="btn btn-danger">ล้างรายการ</button></a>
					</center>
				</div>
			</div>
			<input type="hidden"  name="myname" value="<?php echo $myname;?>">
			<input type="hidden"  name="group" value="<?php echo $group;?>">			
</form>			
		</div>
	</div>
</div><br>

