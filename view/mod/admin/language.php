<?php
//database:
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
//	
	include("view/database/pdo_misrc.php");
	include("view/database/class_mis.php");
//	
$LA_Pcount=0;
$LA_Pclass=array('11','12','13','21','22','23');
$LA_PclassTxt=array('ป.1','ป.2','ป.3','ป.4','ป.5','ป.6');
$Pcl11=array('ญ11801','จ11801','ฝ11801');
$Pcl12=array('ญ12801','จ12801','ฝ12801');
$Pcl13=array('ญ13801','จ13801','ฝ13801');
$Pcl21=array('ญ14801','จ14801','ฝ14801');
$Pcl22=array('ญ15801','จ15801','ฝ15801');
$Pcl23=array('ญ16801','จ16801','ฝ16801');
$LA_Y=2563;
$LA_Land=1;

$angJT1=array();
$angJT2=array();

$angCT1=array();
$angCT2=array();

$angFT1=array();
$angFT2=array();

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
<form name="language_activities" >
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="form-group">
			<label class="control-label col-<?php echo $grid;?>-2">
				<div>ปีการศึกษา</div>
			</label>
			<div class="col-<?php echo $grid;?>-8">
				<select class="select" name="">
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
				<div><button type="button" class="btn btn-success">ดำเนินการเรียกดูข้อมูล</button></div>
			</label>
		</div>
	</div>
</div>
</form>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->