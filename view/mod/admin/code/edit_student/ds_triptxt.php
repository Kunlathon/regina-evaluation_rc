<?php
	include("../../../../database/pdo_conndatastu.php");
	include("../../../../database/class_pdodatastu.php");
	$txt_trip=filter_input(INPUT_POST,'txt_trip');
	if($txt_trip==7){ ?>
		<input type="text" name="ds_triptxt" id="ds_triptxtcopy" required="required" class="form-control"  placeholder="อื่น ๆ" size="100" maxlength="100" value="">
<?php	}else{ ?>
		<input type="text" name="ds_triptxt" id="ds_triptxtcopy" readonly="readonly" required="required" class="form-control"  placeholder="อื่น ๆ" size="100" maxlength="100" value="">
<?php	}      ?>