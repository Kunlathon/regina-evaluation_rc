<?php
	
	include("view/database/pdo_conndatastu.php");
	include("view/database/class_pdodatastu.php");
	
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
	
	include("view/database/database_paynew.php");
	include("view/database/class_pay.php");
	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ค่าธรรมเนียมการศึกษา </span>ตั้งค่ายอดค่าเทอม</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ค่าธรรมเนียมการศึกษา ตั้งค่ายอดค่าเทอม</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-default">
			<div class="panel-body">
	<form name="fee_pay_set" method="post" action="view/mod/admin/code/fee_pay_set/fee_pay_set_code.php">			
			<?php
				$call_datafee=new show_pay_datafee();
				
				foreach($call_datafee->printpay_datafee() as $pay_rc=>$call_datafeeRow){ 
				
				
					$call_plan=new print_plan($call_datafeeRow["pdf_plan"]);
				
					$call_level=new print_level($call_datafeeRow["pdf_level"]);
				
							
				?>
				
				
				<div class="row">
					
					<fieldset class="content-group">
						<div class="form-group">
							<div class="col-md-4">
								ระดับชั้น <?php echo $call_level->level_Lname." (".$call_level->level_Sort_name.")";?>
							</div>
						</div>						
						<div class="form-group">
							<label class="control-label col-md-2">จำนวน</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-roundless" name="fee_set[]" placeholder="จำนวน บาท" value="<?php echo $call_datafeeRow["pdf_pay"];?>">
							</div>
							<label class="control-label col-md-2">บาท</label>
						</div>						
						<div class="form-group">
							<div class="col-md-2">
								แผนการเรียน <?php echo $call_plan->plan_Name;?>
							</div>
						</div>
					</fieldset>
				
				</div>
				<input type="hidden" name="txt_plan[]"  value="<?php echo $call_datafeeRow["pdf_plan"];?>">
				<input type="hidden" name="txt_level[]" value="<?php echo $call_datafeeRow["pdf_level"];?>">
					
		<?php	} ?>	
		
				<div class="row">
					<fieldset class="content-group">
						<div class="form-group">
							<div class="col-<?php echo $grid;?>-12">
								<center><button type="submit" class="btn btn-danger">บันทึก การตั้งค่า</button></center>
							</div>
						</div>						
					</fieldset>	
				</div>
	</form>
		
			</div>
		</div>
	</div>
</div>