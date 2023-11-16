<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
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
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->							
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
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$KeyConcert=filter_input(INPUT_POST,'KeyConcert');
			$ConcertYear=filter_input(INPUT_POST,'ConcertYear');
			$AdminId=filter_input(INPUT_POST,'AdminId');
		?>
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="stats-in-th" content="b062" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="shortcut icon" type="image/png">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="72x72">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="114x114">
		<link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="144x144">
		
	    <link href="<?php echo base_url();?>/Template/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	    <link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	    <link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/core.min.css" rel="stylesheet" type="text/css">
	    <link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/components.min.css" rel="stylesheet" type="text/css">
	    <link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/colors.min.css" rel="stylesheet" type="text/css">
		
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
		
		<title></title>
		<link rel="shortcut icon" href="<?php echo base_url();?>/Template/global_assets/images/logo_rc_wbe.ico"/>
	<!-- Core JS files -->
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/loaders/pace.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->
	<!-- Theme JS files -->
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
		<script src="<?php echo base_url();?>/Template/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
	<!-- /theme JS files -->	
	
<!--****************************************************************************-->			
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
<!--****************************************************************************-->		
	</head>
	<body>
		
		<div class="row">
			<div class="col-<?php echo $grid;?>-12">
				<div class="panel panel-body border-top-purple">
				
	<?php
		$countLCP=0;
		$PrintMPKC=new ManagementPayKeyConcert("READKeyConPayA",$ConcertYear,"-",$KeyConcert,"-");
			if($PrintMPKC->RunMPKC_Error()=="NoERROR"){
				foreach($PrintMPKC->RunMPKC_Array() as $rc=>$PrintMPKCRow){
				$NC_no=$PrintMPKCRow["NC_no"];
					?>
				

		<?php
			$TestKeyConcert=new ManagementPayKeyConcert("DataTest",$ConcertYear,"-",$NC_no,$LoginKey);
			$TKC_LCC=$TestKeyConcert->RunMPKC_CountLCC();
			$TKC_LC=$TestKeyConcert->RunMPKC_CountLC();//**
		?>

		<?php
				if($TKC_LC>=1){ ?>
					<div class="col-<?php echo $grid;?>-3">
						<div class="panel panel-body bg-blue-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-left media-middle">
										<i class="icon-pointer icon-3x text-warning-400"></i>
									</div>

									<div class="media-body text-right">
										<h3 class="no-margin text-semibold">No: <?php echo $NC_no;?></h3>
										<span>แถวที่&nbsp;:&nbsp;<?php echo $PrintMPKCRow["NC_row"];?>&nbsp;ลำดับที่&nbsp;:&nbsp;<?php echo $PrintMPKCRow["NC_page"];?></span>
										<span class="text-uppercase text-size-mini text-muted"><button type="button" class="btn btn-warning disabled">ชำระเงินแล้ว</button></span>
									</div>
								</div>
						</div>
					</div>				
		<?php	}elseif($TKC_LCC>=1){ ?>
					<div class="col-<?php echo $grid;?>-3">
						<div class="panel panel-body bg-blue-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-left media-middle">
										<i class="icon-pointer icon-3x text-danger-400"></i>
									</div>

									<div class="media-body text-right">
										<h3 class="no-margin text-semibold">No: <?php echo $NC_no;?></h3>
										<span>แถวที่&nbsp;:&nbsp;<?php echo $PrintMPKCRow["NC_row"];?>&nbsp;ลำดับที่&nbsp;:&nbsp;<?php echo $PrintMPKCRow["NC_page"];?></span>
										<span class="text-uppercase text-size-mini text-muted"><button type="button" class="btn btn-danger disabled">ถูกจัดเก็บแล้ว</button></span>
									</div>
								</div>
						</div>
					</div>			
		<?php   }else{ ?>
					<div class="col-<?php echo $grid;?>-3">
						<div class="panel panel-body bg-blue-400 has-bg-image">
								<div class="media no-margin">
									<div class="media-left media-middle">
										<i class="icon-pointer icon-3x text-success-400"></i>
									</div>

									<div class="media-body text-right">
										<h3 class="no-margin text-semibold">No: <?php echo $NC_no;?></h3>
										<span>แถวที่&nbsp;:&nbsp;<?php echo $PrintMPKCRow["NC_row"];?>&nbsp;ลำดับที่&nbsp;:&nbsp;<?php echo $PrintMPKCRow["NC_page"];?></span>
										<span class="text-uppercase text-size-mini text-muted"><button type="button" name="KeepKey<?php echo $countLCP;?>" id="KeepKey<?php echo $countLCP;?>" class="btn btn-success">เก็บบัตร</button></span>
									</div>
								</div>
						</div>
					</div>
				
				
	<script>
		$(document).ready(function(){
			
			$('#KeepKey<?php echo $countLCP;?>').on('click', function() {
				var Txt_KC_Id="<?php echo $PrintMPKCRow["KC_Id"];?>";
				var Txt_KC_year="<?php echo $PrintMPKCRow["KC_year"];?>";
				var TXt_KC_price="<?php echo $PrintMPKCRow["KC_price"];?>";
				var Txt_NC_no="<?php echo $PrintMPKCRow["NC_no"];?>";
				var Txt_NC_row="<?php echo $PrintMPKCRow["NC_row"];?>";
				var Txt_NC_page="<?php echo $PrintMPKCRow["NC_page"];?>";
				var AdminId="<?php echo $AdminId;?>";
				swal({
					title: "ต้องการเก็บบัตรใช้หรือไม่?",
					text: "บัตร No "+Txt_NC_no,
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#EF5350",
					confirmButtonText: "เก็บ",
					cancelButtonText: "ไม่เก็บ",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						swal({
							title: "ดำเนินการจัดเก็บบัตร No "+Txt_NC_no,
							//text: "Your imaginary file has been deleted.",
							confirmButtonColor: "#66BB6A",
							type: "success"
						},function(){
							$.post("<?php echo $golink;?>/Concert_pay/add_keep_concert",{
								Txt_KC_Id:Txt_KC_Id,
								Txt_KC_year:Txt_KC_year,
								TXt_KC_price:TXt_KC_price,
								Txt_NC_no:Txt_NC_no,
								Txt_NC_row:Txt_NC_row,
								Txt_NC_page:Txt_NC_page,
								AdminId:AdminId
							},function(LCPTx){
								if(LCPTx!=""){
									$("#RunLCPTx").html(LCPTx)
								}else{}
							})
						});
					}
					else {
						swal({
							title: "ยกเลิกการเก็บบัตร No "+Txt_NC_no,
							text: "Your imaginary file is safe :)",
							confirmButtonColor: "#2196F3",
							type: "error"
						});
					}
				});
			});
			
		})
	</script>			
		<?php   }?>
		
				
	<?php		$countLCP=$countLCP+1;
				}
			}else{};
	?>			
				
				
				
				</div>
			</div>
		</div>

		<div id="RunLCPTx"></div>
		
	</body>
</html>	
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->					
	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->						
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
