<?php	
	include("view/database/pdo_books.php");
	include("view/database/class_books.php");
	$StoreSetYear=new StoreSetYear();
?>
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">ลงทะเบียนข้อมูลราคา</span>&nbsp;จำหน่ายหนังสือเรียนประจำปีการศึกษา</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a href="./?evaluation_mod=rcbooks_up_price" class="btn btn-link  text-size-small"><span>ลงทะเบียนข้อมูลราคา&nbsp;จำหน่ายหนังสือเรียนประจำปีการศึกษา</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-primary">
			<div class="panel-heading" style="background-color:#66CC66; font-weight: bold; color:#0000FF;">อัพโหลดข้อมูลราคาหนังสือเรียน</div>
			<div class="panel-body" style="background-color:#CCFF99;">
<form class="form-horizontal" name="up_books_up_price">
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">

					</div>
					<div class="col-<?php echo $grid;?>-6">
						<div class="form-group">
							<input type="file" name="" id="" class="InputRcBooksUpPrice">
							<span class="help-block" style="color:#0000FF;">ไฟล์โปรแกรม&nbsp;Microsoft&nbsp;Excel<code>.xlsx</code>&nbsp;<code>.xls</code></span>
						</div>					
					</div>
				</div>
</form>			
			</div>
		</div>	
	</div>
</div>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-green">
			<div class="text-center">
				<h6 class="no-margin text-semibold">ข้อมูลราคา&nbsp;จำหน่ายหนังสือเรียนประจำปีการศึกษา&nbsp;<?php echo $StoreSetYear->RunStoreSetYear();?></h6>
			</div>
		
		</div>
	</div>
</div>
