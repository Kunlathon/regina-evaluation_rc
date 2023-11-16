<?php
	include("view/database/pdo_concert_rc.php");
	include("view/database/class_concert_rc.php")	
?>

	<?php
		$Tx_Year=filter_input(INPUT_POST,'Tx_Year');
		$Tx_Admin=filter_input(INPUT_POST,'Tx_Admin');
		$Tx_Pay=filter_input(INPUT_POST,'PC_pay');
			if(isset($Tx_Year,$Tx_Admin,$Tx_Pay)){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
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

			<?php
				$ConcertNo=new CreatePayConcertNo($Tx_Year);	
				$Tx_PC_no=$ConcertNo->RunCreatePayConcertNo();

				$AddPay_Concert=new ManagementPayingKeyConcert("AddUpPayConcert",$Tx_PC_no,$Tx_Year,$Tx_Pay,"-","-","-",$Tx_Admin);
					if($AddPay_Concert->RunMPKC_Error()=="NoERROR"){
						$PrintConcertCopy=new ManagementPayKeyConcert("READ_LCC_ALL",$Tx_Year,"-","-",$Tx_Admin);
							if($PrintConcertCopy->RunMPKC_Error()=="NoERROR"){
								foreach($PrintConcertCopy->RunMPKC_Array() as $rc=>$PrintConcertCopyRow){
									$Tx_NC_no=$PrintConcertCopyRow["LCC_NC_no"];
									$Tx_KC_price=$PrintConcertCopyRow["LCC_KC_price"];
									$Tx_KC_Id=$PrintConcertCopyRow["LCC_KC_Id"];
									$AddList_Concert=new ManagementPayingKeyConcert("AddListConcert",$Tx_PC_no,$Tx_Year,$Tx_Pay,$Tx_NC_no,$Tx_KC_Id,$Tx_KC_price,$Tx_Admin);
								}
								$DeleteListConcertCopy=new ManagementPayingKeyConcert("DeleteLCCAll","-","-","-","-","-","-",$Tx_Admin); ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-success">
			  <strong>ยืนยันการชำระเงินสำเร็จ เลขที่ใบเสร็จ <?php echo $Tx_PC_no;?></strong>
			</div>		
		</div>
	</div><br>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<button type="button" id="butgo" name="butgo" class="btn btn-default">ชำระค่าบัตรคอนเสิร์ต</button>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
			<?php			}else{
				$DeleteListConcertCopy=new ManagementPayingKeyConcert("DeleteLCCAll","-","-","-","-","-","-",$Tx_Admin);
				$DeletePayConcert=new ManagementPayingKeyConcert("DeleteAll",$Tx_PC_no,$Tx_Year,$Tx_Pay,"-","-","-",$Tx_Admin);
				?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
			  <strong>ยืนยันการชำระเงินไม่สำเร็จ กรุณาทำรายการใหม่อีกครั้ง</strong>
			</div>		
		</div>
	</div><br>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<button type="button" id="butgo" name="butgo" class="btn btn-default">ชำระค่าบัตรคอนเสิร์ต</button>
		</div>
	</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
			<?php		    }
					}elseif($AddPay_Concert->RunMPKC_Error()=="ERROR"){ 
				$DeleteListConcertCopy=new ManagementPayingKeyConcert("DeleteLCCAll","-","-","-","-","-","-",$Tx_Admin);	
					?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="alert alert-danger">
			  <strong>ยืนยันการชำระเงินไม่สำเร็จ กรุณาทำรายการใหม่อีกครั้ง</strong>
			</div>		
		</div>
	</div><br>	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<button type="button" id="butgo" name="butgo" class="btn btn-default">ชำระค่าบัตรคอนเสิร์ต</button>
		</div>
	</div>	
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
		<?php		}else{ 
				$DeleteListConcertCopy=new ManagementPayingKeyConcert("DeleteLCCAll","-","-","-","-","-","-",$Tx_Admin);
		?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="">
			<div class="alert alert-warning">
			  <strong>ข้อมูลไม่ถูกต้อง ไม่สามารถดำเนินการยืนยันการชำระเงินได้</strong>
			</div>		
		</div>
	</div><br>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<button type="button" id="butgo" name="butgo" class="btn btn-default">ชำระค่าบัตรคอนเสิร์ต</button>
		</div>
	</div>							
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
		<?php       }?>		
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{ 
				$DeleteListConcertCopy=new ManagementPayingKeyConcert("DeleteLCCAll","-","-","-","-","-","-",$Tx_Admin);
	?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="">
			<div class="alert alert-warning">
			  <strong>ข้อมูลไม่ถูกต้อง ไม่สามารถดำเนินการยืนยันการชำระเงินได้</strong>
			</div>		
		</div>
	</div><br>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<button type="button" id="butgo" name="butgo" class="btn btn-default">ชำระค่าบัตรคอนเสิร์ต</button>
		</div>
	</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<?php   }?>




	