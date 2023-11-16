<?php
	//include("../../../../database/pdo_data.php");
	//include("../../../../database/class_admin.php");
	include("../../../../database/pdo_summer.php");
	include("../../../../database/class_summer.php");		
	
//--------------------------------------------------------------------    
    include("../../../../img_user/document/gotolink.php");//----------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------	
	
?>

	<?php
		$data_year=filter_input(INPUT_POST,'txtyear');
		$data_class=filter_input(INPUT_POST,'txtclass');
		$data_uesr=filter_input(INPUT_POST,'txtuesr');
			if(isset($data_year,$data_class,$data_uesr)){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<script>
		$(document).ready(function () {
			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-violet-400'
			});	
			$('.select-menu-color').select2({
				containerCssClass: 'bg-violet-400',
				dropdownCssClass: 'bg-violet-400'
			});				
		})
	</script>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
    <script type="text/javascript">
        function setScreenHWCookie() {
            $.cookie('sw',screen.width);
                //$.cookie('sh',screen.height);
            return true;
        }
            setScreenHWCookie();
    </script>

    <?php
		$width_system=filter_input(INPUT_COOKIE,'sw');
		if($width_system>=1200){
			$grid="lg";
		}elseif($width_system<=992){
			$grid="md";
		}elseif($width_system<=768){
			$grid="sm";
		}else{
			$grid="xs";
		}
    ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-6">
			<div class="panel panel-body border-top-violet">
				<select class="select-menu-color" name="sc_rssubject" id="sc_rssubject" data-placeholder="รายการกิจกรรม / วิชา...">
						<option></option>
					<optgroup label="รายการกิจกรรม / วิชา">
					
		<?php
			$ShowRsSubjectData=new ShowRsSubjectData($data_year,$data_class);
			foreach($ShowRsSubjectData->RunShowRsSubjectData() as $rc=>$ShowRsSubjectDataRow){?>
						
						<option value="<?php echo $ShowRsSubjectDataRow["RSD_no"];?>"><?php echo $ShowRsSubjectDataRow["RSD_txtTh"];?></option>
						
		<?php	    } ?>				
					
					</optgroup>			
				</select>
			</div>
		</div>
		<div class="col-<?php echo $grid;?>-6">
			<div class="panel panel-body border-top-violet">
				<input type="number" name="up_score" id="up_score" min="10" max="100" required="required" class="form-control" placeholder="คะแนนเต็ม">
			</div>
		</div>	
	</div>
	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-violet">
				<button type="button" name="but_save" id="but_save" class="btn btn-success">ลงทะเบียน</button>
			</div>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	

	<script>
		$(document).ready(function (){
			$('#but_save').on('click', function() {
				var rd_year="<?php echo $data_year;?>";
				var rd_class="<?php echo $data_class;?>";
				var rd_rssubject=$("#sc_rssubject").val();
   				var rd_score=$("#up_score").val();
				var rd_uesr="<?php echo $data_uesr;?>";
				var rd_type="Into";
				swal({
					title: "การดำเนินการ",
					text: "คุณต้องการดำเนินการต่อหรือไม่",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#EF5350",
					confirmButtonText: "ใช้, ดำเนินการต่อ!",
					cancelButtonText: "ไม่, ดำเนินการต่อ!",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if(isConfirm) {
						if(rd_year=="" && rd_class=="" && rd_rssubject=="" && rd_score=="" && rd_type==""){
							swal({
								title: "คำเตือน!",
								text: "กรุณาระบุข้อมูลให้ครบ",
								confirmButtonColor: "#66BB6A",
								type: "warning"
							});
						}else if(rd_year=="" || rd_class=="" || rd_rssubject=="" || rd_score=="" || rd_type==""){
							swal({
								title: "คำเตือน!",
								text: "กรุณาระบุข้อมูลให้ครบ",
								confirmButtonColor: "#66BB6A",
								type: "warning"
							});							
						}else if(rd_score>=10 && rd_score<=100){
							swal({
								title: "สำเร็จ!",
								text: "ดำเนินการสำเร็จ ",
								confirmButtonColor: "#66BB6A",
								type: "success"
							},function(RunButSave){
								$.post("<?php echo $golink;?>/view/mod/admin/code/summer_score_set_up/summer_print.php",{
									txtyear:rd_year,
									txtclass:rd_class,
									txtrssubject:rd_rssubject,
									txtscore:rd_score,
									txtuesr:rd_uesr,
									txttype:rd_type
								},function(rd){
									if(rd!=""){
										document.location="<?php echo $golink;?>/?evaluation_mod=summer_score_set_up"
									}else{}
								})
							});								
						}else{
							swal({
								title: "พบข้อผิดพลาด",
								text: "กรุณาระบุข้อมูลให้ครบ และ ถูกต้อง",
								confirmButtonColor: "#2196F3",
								type: "error"
							});							
						}
					}else{
						swal({
							title: "ไม่ดำเนินการ",
							text: "กลับไปตรวจสอบ และดำเนินการใหม่อีกครั้ง",
							confirmButtonColor: "#2196F3",
							type: "info"
						});
					}
				});
			});			
		})
	</script>	
	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	
	
	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-violet">
				
				<div class="table-responsive">
				  
					<table class="table table-striped">
						<thead>
							<tr>
								<th><div>รหัสวิชา/กิจกรรม</div></th>
								<th><div>ชื่อวิชา/กิจกรรม ภาษาไทย</div></th>
								<th><div>ชื่อวิชา/กิจกรรม ภาษาอังกฤษ</div></th>
								<th><div>คะแนนเต็ม</div></th>
								<th><div>การจัดการข้อมูล</div></th>
							</tr>
						</thead>
						<tbody>
			<?php
					$PrintSummerSetUpScore=new PrintSummerSetUpScore($data_class,$data_year);
					foreach($PrintSummerSetUpScore->RunPrintSummerSetUpScore() as $sssu=>$PrintSummerSetUpScoreRow){	?>
					
							<tr>
								<td><div><?php echo $PrintSummerSetUpScoreRow["RSD_no"];?></div><input type="hidden" id="RNO<?php echo $PrintSummerSetUpScoreRow['RSD_no'];?>" name="RNO<?php echo $PrintSummerSetUpScoreRow['RSD_no'];?>" value="<?php echo $PrintSummerSetUpScoreRow["RSD_no"];?>"></td>
								<td><div><?php echo $PrintSummerSetUpScoreRow["RSD_txtTh"];?></div></td>
								<td><div><?php echo $PrintSummerSetUpScoreRow["RSD_txtEn"];?></div></td>
								<td><div><?php echo $PrintSummerSetUpScoreRow["SSUS_Score_full"];?><input type="hidden" id="RSF<?php echo $PrintSummerSetUpScoreRow['RSD_no'];?>" name="RSF<?php echo $PrintSummerSetUpScoreRow['RSD_no'];?>" value="<?php echo $PrintSummerSetUpScoreRow["SSUS_Score_full"];?>"></div></td>
								<td><div><button type="button" id="RdDelete<?php echo $PrintSummerSetUpScoreRow['RSD_no'];?>" name="RdDelete<?php echo $PrintSummerSetUpScoreRow['RSD_no'];?>" class="btn btn-danger">ลบ</button></div></td>
							</tr>		

	<script>
		$(document).ready(function (){
			$('#RdDelete<?php echo $PrintSummerSetUpScoreRow['RSD_no'];?>').on('click', function() {
				var rd_year="<?php echo $data_year;?>";
				var rd_class="<?php echo $data_class;?>";
				var rd_rssubject=$("#RNO<?php echo $PrintSummerSetUpScoreRow['RSD_no'];?>").val();
   				var rd_score=$("#RSF<?php echo $PrintSummerSetUpScoreRow['RSD_no'];?>").val();
				var rd_uesr="<?php echo $data_uesr;?>";
				var rd_type="Delete";
				swal({
					title: "การดำเนินการ",
					text: "คุณต้องการดำเนินการต่อหรือไม่",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#EF5350",
					confirmButtonText: "ใช้, ดำเนินการต่อ!",
					cancelButtonText: "ไม่, ดำเนินการต่อ!",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if(isConfirm) {
						if(rd_year=="" && rd_class=="" && rd_rssubject=="" && rd_score=="" && rd_type==""){
							swal({
								title: "คำเตือน!",
								text: "กรุณาระบุข้อมูลให้ครบ",
								confirmButtonColor: "#66BB6A",
								type: "warning"
							});
						}else if(rd_year=="" || rd_class=="" || rd_rssubject=="" || rd_score=="" || rd_type==""){
							swal({
								title: "คำเตือน!",
								text: "กรุณาระบุข้อมูลให้ครบ",
								confirmButtonColor: "#66BB6A",
								type: "warning"
							});							
						}else if(rd_score>=10 && rd_score<=100){
							swal({
								title: "สำเร็จ!",
								text: "ดำเนินการสำเร็จ ",
								confirmButtonColor: "#66BB6A",
								type: "success"
							},function(RunButSave){
								$.post("<?php echo $golink;?>/view/mod/admin/code/summer_score_set_up/summer_print.php",{
									txtyear:rd_year,
									txtclass:rd_class,
									txtrssubject:rd_rssubject,
									txtscore:rd_score,
									txtuesr:rd_uesr,
									txttype:rd_type
								},function(rd){
									if(rd!=""){
										document.location="<?php echo $golink;?>/?evaluation_mod=summer_score_set_up"
									}else{}
								})
							});								
						}else{
							swal({
								title: "พบข้อผิดพลาด",
								text: "กรุณาระบุข้อมูลให้ครบ และ ถูกต้อง",
								confirmButtonColor: "#2196F3",
								type: "error"
							});							
						}
					}else{
						swal({
							title: "ไม่ดำเนินการ",
							text: "กลับไปตรวจสอบ และดำเนินการใหม่อีกครั้ง",
							confirmButtonColor: "#2196F3",
							type: "info"
						});
					}
				});
			});			
		})
	</script>							
					
			<?php	} ?>


						</tbody>
					</table>
				  
				</div>				
				
				
				
			</div>
		</div>
	</div>	
	
	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php   } ?>



