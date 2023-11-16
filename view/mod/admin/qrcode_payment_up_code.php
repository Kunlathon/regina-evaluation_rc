<?php include("view/database/db_connect.php"); 

		include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
?>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ค่าธรรมเนียมการศึกษา </span>สร้าง Execl นำเข้าสู่ระบบ SCB</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>รายงานจากระบบ</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
	<div class="row">
		<div class="content col-<?php echo $grid;?>-12">
			<div class="panel panel-success">
				<div class="panel-heading">รายงานจากระบบ</div>
				<div class="panel-body">


			
<?php
	error_reporting(error_reporting() & ~E_NOTICE);
	$pd_term=$objCon->real_escape_string(htmlspecialchars($_POST["pd_term"])) ;
	$pd_year=$objCon->real_escape_string(htmlspecialchars($_POST["pd_year"])) ;
	$pq_saveadmin=$user_login;
	$pd_timedate=date("Y-m-d H:i:s");


	if(count($_FILES["imgqrcode"]["name"])>=1){
		$txt_count=count($_FILES["imgqrcode"]["name"]);		
	}else{
		$txt_count="";
	}	
			
	if($pd_term=="" and $pd_year=="" and $txt_count=="0"){ ?>
	<div class="row">
		<div class="content col-<?php echo $grid;?>-12">
			<div class="panel panel-success">
				<div class="panel-heading">พบข้อผิดพลาด</div>
				<div class="panel-body">
						<div class="col-<?php echo $grid;?>-12">
							<center><a href="./?evaluation_mod=qrcode_payment_up"><button type="button" class="btn btn-info">กลับไปที่ หน้า นำเข้า QR code</button></a></center>
						</div>	
				</div>
			</div>
		</div>	
	</div>			
<?php	}elseif($pd_term=="" or $pd_year=="" or $txt_count=="0"){ ?>
	<div class="row">
		<div class="content col-<?php echo $grid;?>-12">
			<div class="panel panel-success">
				<div class="panel-heading">พบข้อผิดพลาด</div>
				<div class="panel-body">
						<div class="col-<?php echo $grid;?>-12">
							<center><a href="./?evaluation_mod=qrcode_payment_up"><button type="button" class="btn btn-info">กลับไปที่ หน้า นำเข้า QR code</button></a></center>
						</div>	
				</div>
			</div>
		</div>	
	</div>		
<?php	}elseif($txt_count==""){ ?>
	<div class="row">
		<div class="content col-<?php echo $grid;?>-12">
			<div class="panel panel-success">
				<div class="panel-heading">พบข้อผิดพลาด</div>
				<div class="panel-body">
						<div class="col-<?php echo $grid;?>-12">
							<center><a href="./?evaluation_mod=qrcode_payment_up"><button type="button" class="btn btn-info">กลับไปที่ หน้า นำเข้า QR code</button></a></center>
						</div>	
				</div>
			</div>
		</div>	
	</div>				
<?php	}else{ 
//----------------------------------------------------------------------
		$qrcode=0;
		$save_qrT=0;//   ไม่สำเร็จเข้าฐาน
		$save_qrF=0;//   สำเร็จเข้าฐาน
		while($qrcode<$txt_count){	
			$copy_qrcodename=$_FILES["imgqrcode"]["name"][$qrcode];
			
			$img_name=$_FILES['imgqrcode']['name'][$qrcode];
			$img_tmp=$_FILES['imgqrcode']['tmp_name'][$qrcode];

			$copy_id=substr($img_name,8,6);
			//into 
				$intodata_qrcode="INSERT INTO `payment_qrcode` 
								 (`IDStudent`, `Name`, `pq_saveadmin`, `pq_time_save`, `pd_term`, `pd_ year`) 
								 VALUES ('{$copy_id}', '{$img_name}', '{$pq_saveadmin}', '{$pd_timedate}', '{$pd_term}', '{$pd_year}');";
				if($objCon->query($intodata_qrcode) === TRUE){
					
					$cr_mkdir="view/QR/".$pd_term."_".$pd_year;
					
					@mkdir($cr_mkdir); 
					
					$save_qrF=$save_qrF+1;
					move_uploaded_file($img_tmp,'view/QR/'.$pd_term.'_'.$pd_year.'/'.$img_name);
//**********************************************************************************************					
						$class_stuA=new class_stuA($copy_id,$pd_term,$pd_year);		
//**********************************************************************************************						
						$stu_overdueSql="INSERT INTO `overdue_data` (`od_student`, `od_term`, `od_year`, `od_class`, `od_timesave`, `od_timemodify`, `od_save`, `os_id`, `oc_id`) 
										 VALUES ('{$class_stuA->rsd_studentid}', '{$class_stuA->rsc_term}', '{$class_stuA->rsc_year}', '{$class_stuA->rsc_class}', '{$pd_timedate}', '{$pd_timedate}', '{$user_login}', 'os01', 'oc01');";
						$stu_overdueInto=new insert_datastupdo($stu_overdueSql);
//**********************************************************************************************						
						if($stu_overdueInto->system_insert=="yes"){
							//***********************************************
						}else{
							//***********************************************
						}
//**********************************************************************************************


//**********************************************************************************************




				}else{
					$save_qrT=$save_qrT+1;   
				}
			$qrcode=$qrcode+1;
		} ?>
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
		
					<div class="row">
						<div class="col-sm-3 col-md-3 col-lg-3">
							<div class="content-group">
								<h5 class="text-semibold no-margin"><i class="icon-calendar5 position-left text-slate"></i> <?=$txt_count; ?></h5>
								<span class="text-muted text-size-small">จำนวนข้อมูลนำเข้า</span>
							</div>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<div class="content-group">
								<h5 class="text-semibold no-margin"><i class="icon-calendar5 position-left text-slate"></i> <?=$qrcode; ?></h5>
								<span class="text-muted text-size-small">นำเข้าสำเร็จ</span>
							</div>						
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<div class="content-group">
								<h5 class="text-semibold no-margin"><i class="icon-calendar5 position-left text-slate"></i> <?=$save_qrF; ?></h5>
								<span class="text-muted text-size-small">จำนวนข้อมูลบันทึกสำเร็จ</span>
							</div>						
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<div class="content-group">
								<h5 class="text-semibold no-margin"><i class="icon-calendar5 position-left text-slate"></i> <?=$save_qrT; ?></h5>
								<span class="text-muted text-size-small">จำนวนข้อมูลบันทึกไม่สำเร็จ</span>
							</div>						
						</div>
					</div>
					<div class="row">
						<div class="col-<?php echo $grid;?>-12">
							<center><a href="./?evaluation_mod=qrcode_payment_up"><button type="button" class="btn btn-info">กลับไปที่ หน้า นำเข้า QR code</button></a></center>
						</div>
					</div>

			
<?php //----------------------------------------------------------------------	
			 }
?>				
			
		
				</div>
			</div>
		</div>
	</div>
	</div>	
	

	
<br>




