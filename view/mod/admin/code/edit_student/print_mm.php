<?php
include("../../../../database/pdo_conndatastu.php");
include("../../../../database/class_pdodatastu.php");
error_reporting(error_reporting() & ~E_NOTICE); ?>
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
	
<?php
	$call_onclikM=filter_input(INPUT_POST,'call_onclikM');

	switch ($call_onclikM){
		case "5": ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++-->		


<!--++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	break;
				
		default: ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++-->		


<!--++++++++++++++++++++++++++++++++++++++++++++++++-->				
<?php	} ?>	
	