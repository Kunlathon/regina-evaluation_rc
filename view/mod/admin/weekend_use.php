
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">RC&nbsp;Happy&nbsp;Weekend&nbsp;>&nbsp;</span>ข้อมูลวิชา&nbsp;/&nbsp;กิจกรรม&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=weekend_use" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>&nbsp;ข้อมูลวิชา&nbsp;/&nbsp;กิจกรรม&nbsp;&nbsp;</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>


<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-slate">
			<div class="row">
				<div class="col-<?php echo $grid;?>-4">
					<select class="select-menu-color" name="wu_t" id="wu_t" data-placeholder="เลือก ภาคเรียน">
							<option></option>
						<optgroup label="ภาคเรียน">
							<option value="1">ภาคเรียนที่ 1</option>
							<option value="2">ภาคเรียนที่ 2</option>
						</optgroup>
					</select>				
				</div>
				<div class="col-<?php echo $grid;?>-4">
					<select class="select-menu-color" name="wu_y" id="wu_y" data-placeholder="เลือก ปีการศึกษา">
							<option></option>
						<optgroup label="ปีการศึกษา">
							<option value="2566">2566</option>
							<option value="2565">2565</option>
							<option value="2564">2564</option>
						</optgroup>
					</select>				
				</div>				
				<div class="col-<?php echo $grid;?>-4">
					<select class="select-menu-color" name="wu_c" id="wu_c" data-placeholder="เลือก ระดับชั้น">
							<option></option>	
						<optgroup label="ระดับชั้น">
							<option value="11">ประถมศึกษาปีที่ 1</option>
							<option value="12">ประถมศึกษาปีที่ 2</option>
							<option value="13">ประถมศึกษาปีที่ 3</option>
							<option value="21">ประถมศึกษาปีที่ 4</option>
							<option value="22">ประถมศึกษาปีที่ 5</option>
							<option value="23">ประถมศึกษาปีที่ 6</option>
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
		</div>
	</div>
</div>

<div id="RunWu"></div>
