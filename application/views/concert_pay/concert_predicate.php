<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<meta charset="utf-8">
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
	<style>
			@font-face {
				font-family: 'surafont_sanukchang';
				src: url('view/font/surafont_sanukchang.eot');
				src: url('view/font/surafont_sanukchang.eot?#iefix') format('embedded-opentype'),
				url('view/font/surafont_sanukchang.woff') format('woff'),
				url('view/font/surafont_sanukchang.ttf') format('truetype');
			}
			body{
					font-family: "surafont_sanukchang";
					font-size: 15px;
			}
	</style>	
<!--****************************************************************************-->			
    <script type="text/javascript">
        function setScreenHWCookie() {
            $.cookie('sw',screen.width);
                //$.cookie('sh',screen.height);
            return true;
        }
            setScreenHWCookie();
    </script>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
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
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php
	$this->load->library('session');
//--------------------------------------------------------------------        
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
	include("view/database/pdo_concert_rc.php");	
	include("view/database/class_concert_rc.php");	
//--------------------------------------------------------------------
//--------------------------------------------------------------------	
		if($this->session->userdata("rc_user")==null){
			$this->session->unset_userdata("rc_user");
			exit("<script>window.location='$golink/print_imgstu/error';</script>");
		}else{	?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$LoginKey=$this->session->userdata("rc_user");
			$uesr_log=$this->load->database("default",TRUE);
			$uesr_log=$this->db->query("SELECT COUNT(`rsl_user`) AS `int_uesr` 
										FROM `regina_stu_login` 
										WHERE `rsl_user`='{$LoginKey}'");
			foreach($uesr_log->result_array() as $log_row){
				if($log_row["int_uesr"]>=1){
					$UesrRc=$this->load->database("default",TRUE);
					$UesrRc=$this->db->select("rsd_studentid");
					$UesrRc=$this->db->where("rsl_user",$LoginKey);
					$UesrRcRow=$this->db->get("regina_stu_login");
					foreach($UesrRcRow->result() as $URR){
						$usercopy=($URR->rsd_studentid);
							if($usercopy==$pw_key){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
					<?php	}else{
								$this->session->unset_userdata("rc_user");
								exit("<script>window.location='$golink/print_imgstu/error';</script>");
							}
					}
				}else{
					$admin_log=$this->load->database("default",TRUE);		
					$admin_log=$this->db->query("SELECT COUNT(`login_id`) AS `int_uesr` 
												 FROM `login` 
												 WHERE `use_status`='1' 
												 AND `login_id`='{$LoginKey}'");
					foreach($admin_log->result_array() as $log_row){
						if($log_row["int_uesr"]>=1){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<?php
		$CP_Year=filter_input(INPUT_POST,'CP_Year');
			if(isset($CP_Year)){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
	<?php
		$PrintKeyConcert=new ManagementRowKeyConcert('READRow','-',$CP_Year,'-','-','-','-');
			if($PrintKeyConcert->RunPRKC_Error()=="NoERROR"){
				foreach($PrintKeyConcert->RunPRKC_Array() as $rc=>$PrintKeyConcertRow){	
					$KC_Id=$PrintKeyConcertRow["KC_Id"];
					$KC_price=$PrintKeyConcertRow["KC_price"];
				?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-success">
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
						<div class="text-center">
							<h6 class="no-margin text-semibold">รหัสบัตร&nbsp;:&nbsp;<?php echo $KC_Id;?>&nbsp;ราคา&nbsp;:&nbsp;<?php echo $KC_price;?>&nbsp;บาท&nbsp;ปี&nbsp;<?php echo $CP_Year;?></h6>		
						</div>
					</div>
				</div><hr>
			
					<?php
						$PrintPayConcert=new StatisticsPayConcert("DatapayPrice",$CP_Year,"-",$KC_Id);
							
							if($PrintPayConcert->RunSPC_Error()=="NoError"){
								$SumPriceALL=0;
								$SumPriceC=0;
								$SumPriceM=0;
								$CountPriceALL=0;
								$CountPriceC=0;
								$CountPriceM=0;
								foreach($PrintPayConcert->RunSPC_Array() as $rc=>$PrintPayConcertRow){
									$PC_pay=$PrintPayConcertRow["PC_pay"];
									$SumPriceALL=$SumPriceALL+$PrintPayConcertRow["KC_price"];
									$CountPriceALL=$CountPriceALL+1;
				//------------------------------------------------------------------------------------
									if($PC_pay=="C"){//ชำระเงินสด
										$SumPriceC=$SumPriceC+$PrintPayConcertRow["KC_price"];
										$SumPriceM=$SumPriceM+0;
										$CountPriceC=$CountPriceC+1;
										$CountPriceM=$CountPriceM+0;										
									}elseif($PC_pay=="M"){//ชำระเงินโอนผ่านธนาคาร
										$SumPriceC=$SumPriceC+0;
										$SumPriceM=$SumPriceM+$PrintPayConcertRow["KC_price"];
										$CountPriceC=$CountPriceC+0;
										$CountPriceM=$CountPriceM+1;										
									}else{
										$SumPriceC=$SumPriceC+0;
										$SumPriceM=$SumPriceM+0;
										$CountPriceC=$CountPriceC+0;
										$CountPriceM=$CountPriceM+0;
									}
				//------------------------------------------------------------------------------------					
								} ?>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->								
	<div class="row">
		<div class="col-<?php echo $grid;?>-4">
			<div class="panel panel-body bg-blue-400 has-bg-image">
				<div class="media no-margin">
					<div class="media-body">
						<h4 class="no-margin">จำนวน&nbsp;<?php echo $CountPriceALL;?>&nbsp;ใบ</h4>
						<h4 class="no-margin">รวม&nbsp;<?php echo number_format($SumPriceALL, 2, '.', ',');?>&nbsp;บาท</h4>
						<span class="text-uppercase text-size-mini">รวมทั้งหมด</span>
					</div>

					<div class="media-right media-middle">
						<i class="icon-store icon-3x opacity-75"></i>
					</div>
				</div>
			</div>		
		</div>
		<div class="col-<?php echo $grid;?>-4">
			<div class="panel panel-body bg-danger-400 has-bg-image">
				<div class="media no-margin">
					<div class="media-body">
						<h4 class="no-margin">จำนวน&nbsp;<?php echo $CountPriceC;?>&nbsp;ใบ</h4>
						<h4 class="no-margin">รวม&nbsp;<?php echo number_format($SumPriceC, 2, '.', ',');?>&nbsp;บาท</h4>
						<span class="text-uppercase text-size-mini">ชำระเงินสด</span>
					</div>

					<div class="media-right media-middle">
						<i class="icon-cash icon-3x opacity-75"></i>
					</div>
				</div>
			</div>		
		</div>
		<div class="col-<?php echo $grid;?>-4">
			<div class="panel panel-body bg-success-400 has-bg-image">
				<div class="media no-margin">
					<div class="media-left media-middle">
						<i class="icon-credit-card2 icon-3x opacity-75"></i>
					</div>

					<div class="media-body text-right">
						<h4 class="no-margin">จำนวน&nbsp;<?php echo $CountPriceM;?>&nbsp;ใบ</h4>
						<h4 class="no-margin">รวม&nbsp;<?php echo number_format($SumPriceM, 2, '.', ',');?>&nbsp;บาท</h4>
						<span class="text-uppercase text-size-mini">ชำระเงินโอนผ่านธนาคาร</span>
					</div>
				</div>
			</div>		
		</div>
	</div><br>

	<div class="row">
		<div class="col-<?php echo $grid;?>-6">
			<div class="panel panel-success">
				<div class="panel-heading">รายการเลขบัตร&nbsp;ชำระเงินสด&nbsp;</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th><div>เลขที่ใบเสร็จ</div></th>
									<th><div>เลขที่บัตร</div></th>
									<th><div>วัน / เวลา</div></th>
								</tr>
							</thead>
							<tbody>
	<?php
		$PPCA=new StatisticsPayConcert("DatapayPrice",$CP_Year,"-",$KC_Id);
			if($PPCA->RunSPC_Error()=="NoError"){
				foreach($PPCA->RunSPC_Array() as $rc=>$PPCARow){ 
					if($PPCARow["PC_pay"]=="C"){ ?>
								<tr>
									<td><div><?php echo $PPCARow["PC_no"];?></div></td>
									<td><div><?php echo $PPCARow["NC_no"];?></div></td>
									<td><div><?php echo date("d-m-Y H:i:s",strtotime($PPCARow["PC_savetime"]));?></div></td>
								</tr>
			<?php	}else{}
				} 
			}else{}?>								

							</tbody>
						</table>						
					</div>				
				</div>
			</div>
		</div>
		<div class="col-<?php echo $grid;?>-6">
			<div class="panel panel-info">
				<div class="panel-heading">รายการเลขบัตร&nbsp;ชำระเงินโอนผ่านธนาคาร&nbsp;</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th><div>เลขที่ใบเสร็จ</div></th>
									<th><div>เลขที่บัตร</div></th>
									<th><div>วัน / เวลา</div></th>
								</tr>
							</thead>
							<tbody>
	<?php
		$PPCB=new StatisticsPayConcert("DatapayPrice",$CP_Year,"-",$KC_Id);
			if($PPCB->RunSPC_Error()=="NoError"){
				foreach($PPCB->RunSPC_Array() as $rc=>$PPCBRow){ 
					if($PPCBRow["PC_pay"]=="M"){ ?>
								<tr>
									<td><div><?php echo $PPCBRow["PC_no"];?></div></td>
									<td><div><?php echo $PPCBRow["NC_no"];?></div></td>
									<td><div><?php echo date("d-m-Y H:i:s",strtotime($PPCBRow["PC_savetime"]));?></div></td>
								</tr>					
			<?php	}else{}			
				}				
			}else{}?>							
							</tbody>
						</table>						
					</div>				
					
				</div>
			</div>	
		</div>
	</div>
	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<?php			}else{
								
								
							} ?>
			</div>
		</div>
	</div>				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
	<?php		}
			}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}?>
	
	
	

		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}?>	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
				<?php	}else{
							$this->session->unset_userdata("rc_user");
							exit("<script>window.location='$golink/print_imgstu/error';</script>");						
						}
					}							 
				}
			}
		?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	} ?>
