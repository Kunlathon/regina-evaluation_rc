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
				<h4> <span class="text-semibold">ค่าธรรมเนียมการศึกษา </span>จดบันทึก</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ค่าธรรมเนียมการศึกษา จดบันทึก</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>


<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<form name="save_scbpay" action="view/mod/admin/code/save_scbpay/save_scbpay_code.php" method="post">

					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
								<div class="form-group">
									<textarea cols="20" rows="20"  name="p_mysavetxt" class="wysihtml5 wysihtml5-min form-control" placeholder="พิมพ์บันทึกข้อมูล...">
									
										<?php
											$Call_p_mysavetxt=new show_pay_mysave202001('202001');
											echo $Call_p_mysavetxt->print_mysavetxt202001();
										?>
									
									</textarea>
								</div>						
						</div>
					</div>
						<input type="hidden" name="p_mysaveid" value="202001">
						<input type="hidden" name="p_mysaveAdmin" value="<?php echo $user_login;?>">					
					<hr>
					

					
					<div class="row">
						<div class="col-<?php echo $grid;?>12">
							<center>
								<button type="submit" class="btn btn-success">บันทึกข้อความ...</button>
							</center>
						</div>
					</div>





				</form>
			</div>
		</div>
	</div>
</div>