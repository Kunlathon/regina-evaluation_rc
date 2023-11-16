<?php
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
	//include("view/database/class_pdo.php");	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ข้อมูลการเงิน</span> อัพโหลดข้อมูลการชำระเงิน</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>ข้อมูลการเงิน ค่าหนังสือสร้าง QRCode</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
			<form name="books_dataup">
				<div class="panel panel-warning">
					<div class="panel-heading">อัพโหลดข้อมูลการชำระเงิน </div>
					<div class="panel-body">
						<div class="row">
							<div class="col-<?php echo $grid;?>-6">
								<div class="form-group">
									<label class="control-label col-<?php echo $grid;?>-2">ปีการศึกษา</label>
									<div class="col-<?php echo $grid;?>-10">
										<select class="select">
											<optgroup label="ปีการศึกษา...">
										<?php
											$price_offonSql="SELECT `po_year` FROM `price_offon` WHERE 1 ORDER BY `price_offon`.`po_year` DESC";
											$price_offon=new pdo_array($price_offonSql);
											foreach($price_offon->print_pdonotarray as $book=>$price_offonRow){ ?>
												<option value="<?php echo $price_offonRow["po_year"];?>"><?php echo $price_offonRow["po_year"];?></option>
										<?php	} ?>
																							
											</optgroup>
										</select>
									</div>
								</div>
							</div>
							<div class="col-<?php echo $grid;?>-6">
								<input type="file" name="" class="file-input-extensions">
							</div>
						</div>
					</div>
				</div>			
				
			</form>
	</div>
</div><hr>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
			<form>
				<div class="panel panel-info">
					<div class="panel-heading">เรียกดูข้อมูลการชำระเงิน </div>
					<div class="panel-body">
					
					</div>
				</div>			
			</form>
	</div>
</div>