<?php
	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");	
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">กิจกรรมเรียนเสริมภาคฤดูร้อน&nbsp;>&nbsp;</span>รายงานผู้ชำระค่า&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>&nbsp;รายงานผู้ชำระค่า&nbsp;</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-orange">
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<fieldset class="content-group">
						<div class="form-group">
							<select name="SER_Year" id="SER_Year" class="select">
								<optgroup label="ปีการศึกษา">
		<?php
				$CallYear=new SystemYear("read","-","-");
				foreach($CallYear->RunST_Array() as $rc=>$PrintYear){ ?>
									<option value="<?php echo $PrintYear["sy_year"];?>"><?php echo $PrintYear["sy_year"];?></option>				
		<?php	} ?>
								</optgroup>
							</select>
						</div>
					</fieldset>
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<fieldset class="content-group">
						<div class="form-group">
							<button type="button" name="SER_But" id="SER_But" class="btn bg-teal btn-ladda btn-ladda-progress" data-style="expand-right" data-spinner-size="20"><span class="ladda-label">โหลดข้อมูลผู้ชำระค่าการเรียนการสอน กิจกรรมเรียนเสริมภาคฤดูร้อน</span></button>
						</div>
					</fieldset>
				</div>			
			</div>
		</div>
	</div>
</div>


<div id="Run_SER"></div>