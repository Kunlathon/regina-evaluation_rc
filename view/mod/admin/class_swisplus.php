<?php
	//include("view/database/pdo_data.php");
	//include("view/database/class_admin.php");
	//include("view/database/class_pdo.php");	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">Into&nbsp;Data&nbsp;to&nbsp;SWIS&nbsp;System</span>&nbsp;นักเรียน&nbsp;เข้าห้องเรียน</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>Into&nbsp;Data&nbsp;to&nbsp;SWIS&nbsp;System&nbsp;นักเรียน&nbsp;เข้าห้องเรียน</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
<div class="row">
	<div class="col-<?php echo $grid;?>-4">
		<div class="panel panel-body border-top-violet">
			<select class="select"  name="cs_year" id="cs_year" data-placeholder="ปีการศึกษา...">
					<option></option>
				<optgroup label="ปีการศึกษา">
					<option value="2566">2566</option>
					<option value="2565">2565</option>
					<option value="2564">2564</option>
					<option value="2563">2563</option>
				</optgroup>
			</select>
		</div>				
	</div>
	<div class="col-<?php echo $grid;?>-4">
		<div class="panel panel-body border-top-violet">
			<select class="select" name="cs_class" id="cs_class" data-placeholder="ระดับชั้น...">
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
	<div class="col-<?php echo $grid;?>-4">
		<div class="panel panel-body border-top-violet">
			<input type="text" name="cs_date" id="cs_date" class="form-control pickadate-limits" placeholder="วันที่เข้าห้องเรียน">
		</div>
	</div>
</div>

<div id="swisplus"></div>