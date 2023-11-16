<?php
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
//	
	include("view/database/pdo_misrc.php");
	include("view/database/class_mis.php");
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">กิจกรรมภาษา </span>  ประเมินผลภาษาที่ 3 </h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>กิจกรรมภาษา ประเมินผลภาษาที่ 3</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=language_activities" class="btn btn-link  text-size-small"><span>รายงาน ประเมินผลกิจกรรมภาษาที่ 3</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><hr>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<form name="language_activities" action="<?php echo $golink;?>/?evaluation_mod=language_activities_run" method="post" accept-charset="UTF-8">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="form-group">
			<label class="control-label col-<?php echo $grid;?>-2">
				<div>ปีการศึกษา</div>
			</label>
			<div class="col-<?php echo $grid;?>-8">
				<select class="select" name="txt_year" id="txt_year">
					<optgroup label="ปีการศึกษา">
				<?php
					$call_eduyeardata=new year_eduyeardata();
					foreach($call_eduyeardata->Print_DataeDuyeardata() as $rc_key=>$eduyeardataRow){ ?>
						<option value="<?php echo $eduyeardataRow["IDDataEdu"];?>"><?php echo $eduyeardataRow["IDDataEdu"];?></option>						
				<?php	} ?>
					</optgroup>
				</select>
			</div>
			<label class="control-label col-<?php echo $grid;?>-2">
				<div><button type="submit" name="goback" id="goback" class="btn btn-success">ดำเนินการเรียกดูข้อมูล</button></div>
			</label>
		</div>
	</div>
</div>
</form>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->


