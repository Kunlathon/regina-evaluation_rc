<?php 	include("view/database/class_admin.php"); ?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">นักเรียน</span> ค้างจ่าย</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>นักเรียนค้างจ่าย</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-default">
			<div class="panel-body">
						<div class="row">
							<div class="col-<?php echo $grid;?>-4">
								<div class="form-group">
									<label>ปีการศึกษา</label>
										<select name="txt_year" id="txt_year" data-placeholder="ปีการศึกษา..." class="select">
											<option></option>
											<optgroup>
									<?php
										$yaer02=date("Y");
										$yaer02=$yaer02+543;
										$count02=1;
											while($count02<=5){  ?>
												<option value="<?php echo $yaer02;?>">ปีการศึกษา <?php echo $yaer02;?></option>
									<?php		
												$yaer02=$yaer02-1;
												$count02=$count02+1; } ?>
											</optgroup>
									</select>
								</div>
							</div>
							<div class="col-<?php echo $grid;?>-4">
							<div class="form-group">
								<label>เทอม/ภาคเรียน</label>
								<select name="txt_term" id="txt_term" data-placeholder="เทอม/ภาคเรียน..." class="select">
									<option></option>
									<optgroup>
										<option value="1">ภาคเรียนที่ 1</option>
										<option value="2">ภาคเรียนที่ 2</option>
									</optgroup>
								</select>
							</div>
							</div>
							
							<div class="col-<?php echo $grid;?>-4">
							<div class="form-group">
								<label>ประเภทการชำระ</label>
								<select name="txt_oc" id="txt_oc" data-placeholder="ประเภทการชำระ..." class="select">
									<option></option>
									<optgroup>
								<?php
									$overdue_categorySql="SELECT `oc_id` , `oc_text` FROM `overdue_category`";
									$overdue_categoryRs=new print_arrayrow($overdue_categorySql);
								
									foreach($overdue_categoryRs->print_array as $key_rc=>$overdue_categoryRow){ ?>
										
										<option value="<?php echo $overdue_categoryRow["oc_id"];?>"><?php echo $overdue_categoryRow["oc_text"];?></option>										
										
							<?php	} ?>

									</optgroup>
								</select>
							</div>							
							</div>
							
							
							
						</div>			
			</div>
		</div>
	</div>
</div>
<div id="print_class"></div>