<?php
	$txt_error=$data_year=filter_input(INPUT_GET,'txt_error');
		if(isset($txt_error)){
			if($txt_error==0){	?>
				<script>
					$(document).ready(function (){
						new PNotify({
							title: 'สำเร็จ',
							text: 'ดำเนินการสำเร็จ',
							addclass: 'bg-success'
						});						
					})
				</script>
	<?php	}elseif($txt_error==1){	?>
				<script>
					$(document).ready(function (){
						new PNotify({
							title: 'ไม่สำเร็จ',
							text: 'ดำเนินการไม่สำเร็จ',
							addclass: 'bg-warning'
						});					
					})
				</script>				
	<?php	}else{}
		}else{}
?>

<?php
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
	include("view/database/pdo_summer.php");
	include("view/database/class_summer.php");
	
	$PrintSystem=new SystemSummer("read","-","-","-","-","-","-","-","-","-","-","-");
		if(($PrintSystem->RunSS_Error()=="No")){
			foreach($PrintSystem->RunSS_Array() as $rc=>$PrintSystemRow){
				$summer_t=$PrintSystemRow["data_term"];
				$summer_year=$PrintSystemRow["data_summer"];
			}
		}else{
			$summer_t="-";
			$summer_year="-";			
		}
	
?>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">กิจกรรมเรียนเสริมภาคฤดูร้อน&nbsp;>&nbsp;</span>ชำระค่าธรรมเนียม&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>&nbsp;ชำระค่าธรรมเนียม&nbsp;</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<span style="color:#ff0000;">เพิ่มข้อมูลผู้ชำระเงิน&nbsp;สามารถเพิ่มข้อมูลได้&nbsp;<b><u>ก่อน</u></b>&nbsp;และ&nbsp;<b><u>หลัง</u></b>&nbsp;การลงทะเบียนกิจกรรมเรียนเสริมฤดูร้อน</span>
	</div>
</div><hr>


<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-orange">	
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div><h6 class="no-margin text-semibold">เพิ่มผู้ชำระค่าธรรมเนียมเรียนเสริมภาคฤดูร้อน&nbsp;(หลายรายการ)</h6></div>
					<div><span class="text-orange">ข้อมูลอาจจะมีการรวบรวมข้อมูลจากนักเรียนนอกสถาบันการศึกษา</span></div>
				</div>
			</div>
			<hr>
<form class="form-horizontal" name="summer_pay_up" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>?evaluation_mod=summer_pay_up" >

			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-body">
						<a href="view/excel/up_summer_pay.xlsx"><div class="media no-margin">
							<div class="media-body">
								<h3 class="no-margin text-semibold">ดาวโหลด Excel เพื่มอัพโหลดเข้าสู่ระบบ</h3>
							</div>

							<div class="media-right media-middle">
								<i class="icon-file-presentation icon-3x text-blue-400"></i>
							</div>		
						</div></a>
					</div>				
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<div class="panel panel-body">
						<ul class="list-feed">
							<li>คลิกที่ icon <div class="icon-file-presentation"></div> เพื่อโหลดไฟส์สำหรับอัพโหลด</li>
							<li>จากนั้นนำไฟสที่ดาวน์โหลด มาแก้ไขเพิ่มรายการข้อมูลที่ต้องการอัพโหลด</li>
							<li>นำไฟสที่แก้ไขแล้ว มานำเข้าที่ปุ่มอัพโหลด</li>
							<li>ระบบอ่านข้อมูลที่อัพโหลดแล้ว กดปุ่ม Upload</li>
						</ul>
					</div>					
				</div>
			</div>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="panel panel-body">
						<input type="file" name="SummerPayFileUp" class="file-input-advanced">
						<span class="help-block">ไฟส์โปรแกรม&nbsp;Microsoft&nbsp;Excel&nbsp;รองรับนามสกุลไฟส์&nbsp;<code>xlsx</code>&nbsp;<code>xls</code></span>					
					</div>
				</div>
			</div>

</form>			
		</div>
	</div>
</div>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-orange">
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div><h6 class="no-margin text-semibold">เพิ่มผู้ชำระค่าธรรมเนียมเรียนเสริมภาคฤดูร้อน</h6></div>
					<div><span class="text-orange">ข้อมูลอาจจะมีการรวบรวมข้อมูลจากนักเรียนนอกสถาบันการศึกษา</span></div>
				</div>
			</div>
			<hr>
<form class="form-horizontal" name="summer_pay_key">
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<fieldset class="content-group">
						<div class="form-group">
							<label class="control-label col-<?php echo $grid;?>-6">เลขประจำตัวนักเรียน / เลขลงทะเบียน</label>
							<div class="col-<?php echo $grid;?>-6">
								<input type="text" style="font-weight: bold;" maxlength="9" minlength="3" name="sp_key" id="sp_key" class="form-control text-warning">
							</div>
						</div>
					</fieldset>
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<fieldset class="content-group">
						<div class="form-group">
							<select class="select" name="sp_class" id="sp_class" data-placeholder="ระดับชั้น...">
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
					</fieldset>						
				</div>
			</div>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<button type="button" id="but_sp"  name="but_sp" class="btn btn-success">บันทึกข้อมูล / Save</button>
				</div>
			</div>
</form>			
			<div id="run_intosp"></div>		
		</div>
	</div>
</div>
<!--js--->
	<script>
		$(document).ready(function (){
			$("#but_sp").click(function (){
				var summer_t="<?php echo $summer_t;?>";
				var summer_year="<?php echo $summer_year;?>";
				var sp_key=$("#sp_key").val();
				var sp_class=$("#sp_class").val();
				var sp_system="Into";
					if(summer_t!="" && summer_year!="" && sp_key!="" && sp_class!="" && sp_system!=""){
						$.post("<?php echo $golink;?>/view/mod/admin/code/summer_pay/into.php",{
							summer_t:summer_t,
							summer_year:summer_year,
							sp_key:sp_key,
							sp_class:sp_class,
							sp_system:sp_system
						}, function(run_sp){
							if(run_sp !=""){
								$("#run_intosp").html(run_sp)
							}else{}
						})
					}else{}
			})
		})
	</script>
<!--js--->
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-orange">
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div><h6 class="no-margin text-semibold">ข้อมูลรายชื่อผู้ชำระค่าธรรมเนียมเรียนเสริมภาคฤดูร้อน</h6></div>
					<div><span class="text-orange">ข้อมูลอาจจะมีการรวบรวมข้อมูลจากนักเรียนนอกสถาบันการศึกษา</span></div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="table-responsive">
						<table class="table datatable-basic">
							<thead>
								<tr class="active">
									<th><div>รหัสนักเรียน</div></th>
									<th><div>ชื่อ - สกุล</div></th>
									<th><div>ระดับชั้น</div></th>
									<th><div>เวลา</div></th>
									<th class="text-center"><div><li class="icon-eraser3"></li></div></th>
								</tr>
							</thead>
							<tbody>

	<?php
			//$sp_count=0;
			$RcSummerFirst=new PrintRcSummerFirst($summer_year);
			foreach($RcSummerFirst->RunPrintRcSummerFirst() as $rc=>$RcSummerFirstRow){	
			
//call regina_stu_data2			
				$ReginaStuData=new regina_stu_data2($RcSummerFirstRow["rsf_key"],$summer_year,$summer_t,$RcSummerFirstRow["rsf_class"]);
					if($ReginaStuData->rsd_studentid!=null){
						if($ReginaStuData->sd_prefix=="2"){
							$myname="เด็กหญิง ".$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
						}elseif($ReginaStuData->sd_prefix=="4"){
							$myname="นางสาว ".$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
						}else{
							$myname=$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
						}	?>						
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
								<tr class="info">
									<td><div><?php echo $RcSummerFirstRow["rsf_key"];?></div></td>
									<td><div><?php echo $myname;?></div></td>
									<td><div><?php echo $ReginaStuData->Sort_name;?></div></td>
									<td><div><?php echo date("d-m-Y H:i:s",strtotime($RcSummerFirstRow["rsf_datatime"]));?></div></td>
									<td class="text-center">
										<div><button type="button" id="sweet_loader<?php echo $RcSummerFirstRow["rsf_key"];?>" class="btn btn-danger"><li class="icon-eraser3"></li></button></div>
									</td>
								</tr>						
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
    <script>
		$(document).ready(function (){
    
			$('#sweet_loader<?php echo $RcSummerFirstRow["rsf_key"];?>').on('click', function() {
				var summer_t="<?php echo $summer_t;?>";
				var summer_year="<?php echo $summer_year;?>";
				var sp_key="<?php echo $ReginaStuData->rsd_studentid;?>";
				var sp_class="<?php echo $ReginaStuData->rsc_class;?>";
				var sp_system="Delete";				
				swal({
					title: "ลบข้อมูล รหัส "+sp_key,
					text: "ข้อมูลการชำระค่าธรรมเนียมเรียนเสริมภาคฤดูร้อน ปีการศึกษา "+summer_year,
					type: "warning",
					showCancelButton: true,
					closeOnConfirm: false,
					confirmButtonColor: "#2196F3",
					showLoaderOnConfirm: true
				},
				function() {
					setTimeout(function() {
						swal({
							title: "ดำเนินการลบ",
							confirmButtonColor: "#2196F3"
						},function(){
							if(summer_t!="" && summer_year!="" && sp_key!="" && sp_class!="" && sp_system!=""){
								$.post("<?php echo $golink;?>/view/mod/admin/code/summer_pay/into.php",{
									summer_t:summer_t,
									summer_year:summer_year,
									sp_key:sp_key,
									sp_class:sp_class,
									sp_system:sp_system
								}, function(run_sp){
									if(run_sp !=""){
										$("#run_intosp").html(run_sp)
									}else{}
								})
							}else{}							
						});
					}, 2000);
				});
			});		
		})
		
	</script>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
		<?php				
					}else{}		
			?>
				
	<?php	//$sp_count=$sp_count+1;
			} ?>								
						
							



							</tbody>
						</table>					
					</div>
				</div>
			</div>
			
			

		</div>
	</div>
</div>