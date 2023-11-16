<?php
	include("../../../../database/database_evaluation.php");
	$rcdata_connect=connect();
	error_reporting(error_reporting() & ~E_NOTICE);
	$txt_student=post_data($_POST["txt_student"]);
	$copy_datetime=date("Y-m-d H:i:s");
	
		if($txt_student==""){ ?>
		
		<div class="form-group has-warning has-feedback">
			<label class="control-label col-sm-2 col-md-2 col-lg-2 text-semibold">ชื่อ - สกุล</label>
			<div class="col-sm-9 col-md-9 col-lg-9">
				<input type="text" name="stu_name" class="form-control" placeholder="ชื่อ - สกุล" readonly required value="">
				<div class="form-control-feedback">
					<i class="icon-notification2"></i>
				</div>
				<span class="help-block">กรุณา กรอกรหัสนักเรียน</span>
			</div>
		</div>	

<?php	}else{
			$data_stu="SELECT `rsd_studentid`,`rsd_name`,`rsd_surname` 
					   FROM `regina_stu_data` 
					   WHERE `rsd_studentid`='{$txt_student}' 
					   and `rse_student_status`='1'";
			$data_stuRs=$rcdata_connect->query($data_stu);
			
			if($data_stuRs->num_rows > 0){
				$data_stuRow=$data_stuRs->fetch_assoc();
					$my_name=$data_stuRow["rsd_name"]." ".$data_stuRow["rsd_surname"];
				?>
				
			<div class="form-group has-success has-feedback">
				<label class="control-label col-sm-2 col-md-2 col-lg-2 text-semibold">ชื่อ - สกุล</label>
				<div class="col-sm-9 col-md-9 col-lg-9">
					<input type="text" name="stu_name" class="form-control" placeholder="ชื่อ - สกุล" readonly required value="<?php echo $my_name;?>">
					<div class="form-control-feedback">
						<i class="icon-checkmark-circle"></i>
					</div>
						<span class="help-block">ข้อมูล ถูกต้อง</span>
				</div>
			</div>				
				
				<?php
			}else{ ?>
			
			<div class="form-group has-error has-feedback">
				<label class="control-label col-sm-2 col-md-2 col-lg-2 text-semibold">ชื่อ - สกุล</label>
				<div class="col-sm-9 col-md-9 col-lg-9">
					<input type="text" name="stu_name" class="form-control" placeholder="ชื่อ - สกุล" readonly required value="<?php echo $my_name;?>">
					<div class="form-control-feedback">
						<i class="icon-cancel-circle2"></i>
					</div>
						<span class="help-block">ไม่พบข้อมูล</span>
				</div>
			</div>			
				
				<?php
			}
		
		}

?>