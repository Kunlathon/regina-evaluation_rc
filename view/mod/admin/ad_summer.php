<?php
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");	
?>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">กิจกรรมเรียนเสริมภาคฤดูร้อน&nbsp;>&nbsp;</span>ลงทะเบียนเรียน&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=ad_summer" class="btn btn-link  text-size-small"><span>&nbsp;ลงทะเบียนเรียน&nbsp;</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<form name="form_ad_summer" action="<?php echo base_url();?>?evaluation_mod=ad_summer_code" method="post"  accept-charset="UTF-8" >
<div class="row">
	<div class="col-<?php echo $grid;?>-4">
		<div class="panel panel-body border-top-violet">
			<select class="select"  name="ad_year" id="ad_year" data-placeholder="ปีการศึกษา..." required="required">
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
	<div class="col-<?php echo $grid;?>-8">
		<div class="panel panel-body border-top-violet">
			<select class="select-menu-color" name="ad_sudkey" id="ad_sudkey" data-placeholder="รายชื่อนักเรียน..." required="required">
					<option></option>
				<optgroup label="รายชื่อนักเรียน...">
						
				</optgroup>			
			</select>
		</div>
	</div>
</div>  
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<button type="submit" class="btn btn-success">ดำเนินการต่อไป</button>		
		<button type="button" id="asj_go" class="btn btn-warning">เคลียร์ค่าระบบ</button>
	</div>
</div>

</form>


