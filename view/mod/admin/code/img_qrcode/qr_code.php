	<!-- Core JS files -->
	<script src="../../../global_assets/js/core/libraries/jquery.min.js"></script>
	<!-- /theme JS files -->
<?php
	include("../../../../database/db_connect.php");
	$term=$objCon->real_escape_string(htmlspecialchars($_POST["term"])) ;
	$year=$objCon->real_escape_string(htmlspecialchars($_POST["year"])) ;
?>	
	<div class="panel panel-success">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6">
							QR Code ชำระค่าบำรุงการศึกษา ภาคเรียนที่ <?=$term; ?>  ปีการศึกษา <?=$year; ?>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="form-group">
								<label>ค้นหา</label>
								<select class="select-search" id="IDStudent">
									<option value="">เลือกรายการ</option>
										<?php
											$imgqrcode_select="SELECT IDStudent,Name 
															   FROM `payment_qrcode` 
															   WHERE `pd_term`='{$term}' 
															   and `pd_ year`='{$year}'";
											$imgqrcode_selectRS=$objCon->query($imgqrcode_select) or die ($objCon->error);
											if($imgqrcode_selectRS->num_rows > 0){
												while($imgqrcode_selectRow=$imgqrcode_selectRS->fetch_assoc()){ ?>
													<option value="<?=$imgqrcode_selectRow["IDStudent"]; ?>"><?=$imgqrcode_selectRow["Name"]; ?></option>
												<?php } 
											}else{ ?>
												    <option value="">ไม่พบข้อมูล</option>
										<?php	}
										?>
								</select>
								<input type="hidden" value="<?=$term; ?>" id="txt_term" name="txt_term">
								<input type="hidden" value="<?=$year; ?>" id="txt_year" name="txt_year">
							</div>
							</div>
						</div>
					</div>
				
				
				 
				<div class="panel-body">
				
				<div id="show_qrcode">
					<div class="row">
						<?php
							$imgqrcode="SELECT IDStudent,Name 
									    FROM `payment_qrcode` 
										WHERE `pd_term`='{$term}' 
										and `pd_ year`='{$year}'";
							$imgqrcode_rs=$objCon->query($imgqrcode);
							if($imgqrcode_rs->num_rows > 0){
								$count_img=1;
								while($imgqrcode_row=$imgqrcode_rs->fetch_assoc()){ ?>
								
						<?php
								if($count_img%4!=0){ ?>
									<div class="col-sm-3 col-md-3 col-lg-3">
										<div class="thumbnail" style="width: 240px; height: 304px;">
											<div class="thumb">
												<img  src="view/QR/<?=$term; ?>_<?=$year; ?>/<?=$imgqrcode_row["Name"]; ?>">
											<div class="caption-overflow">
												<!--<span>
													<a href="assets/images/demo/flat/3.png" data-popup="lightbox" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
													<a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i class="icon-link2"></i></a>
												</span>-->
											</div>
											</div>
										<div class="caption">
											<h6 class="no-margin"><?=$imgqrcode_row["Name"]; ?></h6>
										</div>
										</div>
									</div>							
						<?php	}else{ ?>
									<div class="col-sm-3 col-md-3 col-lg-3">
										<div class="thumbnail" style="width: 240px; height: 304px;">
											<div class="thumb">
												<img  src="view/QR/<?=$term; ?>_<?=$year; ?>/<?=$imgqrcode_row["Name"]; ?>">
											<div class="caption-overflow">
												<!--<span>
													<a href="assets/images/demo/flat/3.png" data-popup="lightbox" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
													<a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i class="icon-link2"></i></a>
												</span>-->
											</div>
											</div>
										<div class="caption">
											<h6 class="no-margin"><?=$imgqrcode_row["Name"]; ?></h6>
										</div>
										</div>
									</div><hr>							
						<?php	}?>		
								

						<?php		$count_img=$count_img+1;}
							}else{
								
							}
						
						?>
			
					</div>
				</div>
				
				</div>


				
	</div>

	<script type="text/javascript">
			$(document).ready(function (){
			$("#IDStudent").change(function (){
				var txt_id=$("#IDStudent").val();				
				var txt_term=$("#txt_term").val();
				var txt_year=$("#txt_year").val();
				if(txt_id !="" && txt_term !="" && txt_year !=""){
			$.post("view/mod/admin/code/img_qrcode/show_qrcode.php",{
				data_id: txt_id,
				data_term: txt_term,				
				data_year: txt_year
			    },function(data){
				if(data !=""){
					$("#show_qrcode").html(data)
				}
			})
		}
	})
})
	</script>	
	
<script>
	$('.select-search').select2();
</script>