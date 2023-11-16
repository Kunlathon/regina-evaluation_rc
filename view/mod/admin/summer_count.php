<?php
	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");	
?>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">กิจกรรมเรียนเสริมภาคฤดูร้อน&nbsp;>&nbsp;</span>ข้อมูลยอดผู้ลงทะเบียน&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>&nbsp;ข้อมูลยอดผู้ลงทะเบียน&nbsp;/&nbsp;กิจกรรมเรียนเสริมภาคฤดูร้อน&nbsp;</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-6">
		<div class="panel panel-body border-top-violet">
			<select class="select"  name="sc_year" id="sc_year" data-placeholder="ปีการศึกษา...">
					<option></option>
				<optgroup label="ปีการศึกษา">
		<?php
				$CallYear=new SystemYear("read","-","-");
				foreach($CallYear->RunST_Array() as $rc=>$PrintYear){ ?>
					<option value="<?php echo $PrintYear["sy_year"];?>"><?php echo $PrintYear["sy_year"];?></option>				
		<?php	} ?>
		
				</optgroup>
			</select>
		</div>				
	</div>
	<div class="col-<?php echo $grid;?>-6">
		<div class="panel panel-body border-top-violet">
			<select class="select" name="sc_class" id="sc_class" data-placeholder="ระดับชั้น...">
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
</div>



<div id="RunSummerCount"></div>
