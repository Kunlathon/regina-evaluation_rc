<?php
	include("view/database/pdo_concert_rc.php");
	include("view/database/class_concert_rc.php");
	
	$CP_Year="2022";
	
	//echo $user_login;
	
?>


	<script>
		$(document).ready(function(){
			$("#ButCP").click(function(){
				var KeyConcert=$("#KeyConcert").val();
				var AdminId="<?php echo $user_login;?>";
				var ConcertYear="<?php echo $CP_Year;?>";
					if(KeyConcert!=""){
						$.post("<?php echo $golink;?>/Concert_pay",{
							KeyConcert:KeyConcert,
							ConcertYear:ConcertYear,
							AdminId:AdminId
						},function(CPData){
							if(CPData!=""){
								$("#RunCP_Data").html(CPData)
							}else{}
						})
					}else{}
			})
		})
	</script>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">คอนเสิร์ต&nbsp;เรยีนาเชลีวิทยาลัย&nbsp;>&nbsp;</span>ชำระค่าบัตรคอนเสิร์ต&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>&nbsp;ชำระค่าบัตรคอนเสิร์ต&nbsp;</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-violet">
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th><div>ลำดับ</div></th>
									<th><div>เลขบัตร</div></th>
									<th><div>ราคา</div></th>
									<th><div>การจัดการข้อมูล</div></th>
								</tr>
							</thead>
							<tbody>
			<?php
				$SumKCprice=0;
				$PCC_Count=0;
				$PrintConcertCopy=new ManagementPayKeyConcert("READ_LCC_ALL",$CP_Year,"-","-",$user_login);
					if($PrintConcertCopy->RunMPKC_Error()=="NoERROR"){
						foreach($PrintConcertCopy->RunMPKC_Array() as $rc=>$PrintConcertCopyRow){
							$PCC_Count=$PCC_Count+1;
							$SumKCprice=$SumKCprice+$PrintConcertCopyRow["LCC_KC_price"];
							?>
								<tr>
									<td><div><?php echo $PCC_Count;?></div></td>
									<td><div><?php echo $PrintConcertCopyRow["LCC_NC_no"];?></div></td>
									<td><div><?php echo $PrintConcertCopyRow["LCC_KC_price"];?></div></td>
									<td><div><button type="button" class="btn btn-danger btn-xs">ลบ</button></div></td>
								</tr>					
			<?php		
						}
					}else{ ?>
						
			<?php	}?>				
							</tbody>
						</table>
					</div>				
				</div>
			</div><br>

			<?php
					if($PrintConcertCopy->RunMPKC_Error()=="NoERROR"){ ?>
			<div class="row">
				<div class="col-<?php echo $grid;?>-12">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">ยืนยันการชำระเงิน</button>
					<button type="button" name="DeleLccAll" id="DeleLccAll" class="btn btn-danger">ล้างค่ารายการเก็บบัตรทั้งหมด</button>
				</div>
			</div>					
			<?php	}else{} ?>
			
	
		</div>	
	</div>
</div>

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog modal-lg">
<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">การชำระเงิน</h4>
			</div>
			<div class="modal-body">
<form name="SaverConcert" id="SaverConcert" action="<?php echo base_url();?>/?evaluation_mod=concert_paying" method="post" enctype="multipart/form-data" accept-charset="utf-8">
				<div class="row" style="color:#372fd9; font-size: 18px; font-weight: bold;">
					<div class="col-<?php echo $grid;?>-3">&nbsp;</div>
					<div class="col-<?php echo $grid;?>-3">ยอดชำระทั้งหมด</div>
					<div class="col-<?php echo $grid;?>-3"><?php echo number_format($SumKCprice, 2, '.', ',');?></div>
					<div class="col-<?php echo $grid;?>-3">บาท</div>
				</div><hr>
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">&nbsp;</div>
					<div class="col-<?php echo $grid;?>-3">
						<div>
							<label class="radio-inline">
								<input type="radio" class="styled" name="PC_pay" id="PC_payA" value="C">
								ชำระเงินสด
							</label>						
						</div>
						<div>
							<label class="radio-inline">
								<input type="radio" class="styled" name="PC_pay" id="PC_payB" value="M">
								ชำระเงินโอนผ่านธนาคาร
							</label>						
						</div>
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<button type="submit" class="btn btn-success">ชำระเงิน</button>
						<button type="reset" class="btn btn-info">ล้างรายการ</button>
					</div>
				</div>
<input type="hidden" name="Tx_Year" value="<?php echo $CP_Year;?>">
<input type="hidden" name="Tx_Admin" value="<?php echo $user_login;?>">			
</from>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
			</div>
		</div>
<!-- Modal content-->      
		</div>
	</div>
<!-- Modal -->  
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-violet">
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<fieldset class="content-group">
						<div class="form-group">
						<label class="control-label col-<?php echo $grid;?>-5">รายการบัตรคอนเสิร์ต</label>
							<div class="col-<?php echo $grid;?>-7">
								<select class="select-menu-color" name="KeyConcert" id="KeyConcert" data-placeholder="บัตรคอนเสิร์ต...">
										<option value=""></option>
									<optgroup label="ราคา บัตรคอนเสิร์ต">
	<?php 
		$PrintKeyConcert=new ManagementRowKeyConcert('READRow','-',$CP_Year,'-','-','-','-');
			if($PrintKeyConcert->RunPRKC_Error()=="NoERROR"){ 
				foreach($PrintKeyConcert->RunPRKC_Array() as $rc=>$PrintKeyConcertRow){ ?>
										<option value="<?php echo $PrintKeyConcertRow["KC_Id"];?>"><?php echo $PrintKeyConcertRow["KC_price"];?></option>
	<?php		}
			
			?>
										
	<?php	}else{}?>
				
															

	
									</optgroup>
								</select>											
							</div>
						</div>
					</fieldset>				
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<fieldset class="content-group">
						<div class="form-group">
							<button type="button" name="ButCP" id="ButCP" class="btn btn-success">เรียกดู</button>
						</div>
					</fieldset>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="RunCP_Data"></div>
