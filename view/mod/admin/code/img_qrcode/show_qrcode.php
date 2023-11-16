<?php
include("../../../../database/db_connect.php");
	$data_id=$objCon->real_escape_string(htmlspecialchars($_POST["data_id"])) ;
	$data_term=$objCon->real_escape_string(htmlspecialchars($_POST["data_term"])) ;
	$data_year=$objCon->real_escape_string(htmlspecialchars($_POST["data_year"])) ;
	
?>


<div class="row">
<?php
		$imgqrcode="SELECT IDStudent,Name 
									    FROM `payment_qrcode` 
										WHERE `pd_term`='{$data_term}' 
										and `pd_ year`='{$data_year}'
										and `IDStudent`='{$data_id}'";
		$imgqrcode_rs=$objCon->query($imgqrcode);					
			if($imgqrcode_rs->num_rows > 0){
				$imgqrcode_row=$imgqrcode_rs->fetch_assoc(); ?>
					<div class="col-sm-12 col-md-12 col-lg-12">
						<div class="thumbnail">
							<div class="thumb">
								<img style="width: 240px; height: 304px;" src="view/QR/<?=$data_term; ?>_<?=$data_year; ?>/<?=$imgqrcode_row["Name"]; ?>">
							<div class="caption-overflow">
								<!--<span>
									<a href="assets/images/demo/flat/3.png" data-popup="lightbox" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
									<a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i class="icon-link2"></i></a>
								</span>-->
							</div>
							</div>
							<div class="caption">
								<font style="font-size: 14px;"><?=$imgqrcode_row["Name"]; ?></font>
							</div>
						</div>
					</div>				
<?php			}else{
				
			}		
?>					
</div>				
					
					
			