<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">พิมพ์ฉบับร่างใบแทนค่า</span>&nbsp;จำหน่ายหนังสือเรียนประจำปีการศึกษา</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=rcbooks_up_price" class="btn btn-link  text-size-small"><span>พิมพ์ฉบับร่างใบแทนค่า&nbsp;จำหน่ายหนังสือเรียนประจำปีการศึกษา</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-indigo" style="background-color:#CCFF99;">
<form class="form-horizontal" action="<?php echo base_url();?>rcprint/print_receipt_ex" method="post" target="_blank">  	
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<fieldset class="content-group">
						<div class="form-group">
							<label class="control-label col-<?php echo $grid;?>-2">ปีการศึกษา</label>
							<div class="col-<?php echo $grid;?>-10">
								<select name="rra_year" id="rra_year" class="select" data-placeholder="เลือก ปีการศึกษา" required="required">
										<option></option>
									<optgroup label="ปีการศึกษา">
										<option value="2566">ปีการศึกษา 2566</option>
										<option value="2565">ปีการศึกษา 2565</option>
									</optgroup>
								</select>							
							</div>
						</div>
					</fieldset>
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<fieldset class="content-group">
						<div class="form-group">
							<label class="control-label col-<?php echo $grid;?>-2">ระดับเรียน</label>
							<div class="col-<?php echo $grid;?>-10">
								<select name="rra_class" id="rra_class" class="select" data-placeholder="เลือก ระดับ" required="required">
										<option></option>
									<optgroup label="ระดับอนุบาล">
										<option value="3">อนุบาล 3</option>
									</optgroup>
									<optgroup label="ระดับประถม">
										<option value="11">ประถมศึกษาปีที่ 1</option>
										<option value="12">ประถมศึกษาปีที่ 2</option>
										<option value="13">ประถมศึกษาปีที่ 3</option>
										<option value="21">ประถมศึกษาปีที่ 4</option>
										<option value="22">ประถมศึกษาปีที่ 5</option>
										<option value="23">ประถมศึกษาปีที่ 6</option>
									</optgroup>	
									<optgroup label="ระดับมัธยม">
										<option value="31">มัธยมศึกษาปีที่ 1</option>
										<option value="32">มัธยมศึกษาปีที่ 2</option>
										<option value="33">มัธยมศึกษาปีที่ 3</option>
										<option value="41">มัธยมศึกษาปีที่ 4</option>
										<option value="42">มัธยมศึกษาปีที่ 5</option>
										<option value="43">มัธยมศึกษาปีที่ 6</option>
									</optgroup>									
								</select>							
							</div>		
						</div>
					</fieldset>				
				</div>
			</div>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<fieldset class="content-group">
						<div class="form-group">
							<button type="submit" class="btn btn-success">พิมพ์ใบแทนใบเสร็จรับเงินค่าหนังสือ</button>
						</div>
					</fieldset>
				</div>
			</div>
</form>			
		</div>
	</div>
</div>





