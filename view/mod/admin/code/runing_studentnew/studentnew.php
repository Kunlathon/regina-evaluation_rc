<style>
.RuningLoad {
	display:none;
}
</style>   

<script>
	$(function() {
		$(".RunLoad").fadeOut(5000, function() {
			$(".RuningLoad").fadeIn(4000);
		});
	});
</script>  

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
<?php
//database.........................................................................
//---------------------------------------------------------------------------------
	include("../../../../database/class_admission.php");//-------------------------
//database end.....................................................................
	$TxtYear=filter_input(INPUT_POST,'TxtYear');//---------------------------------
		if(isset($TxtYear)){ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<div class="col-<?php echo $grid;?>-12">
	<center>
		<div class="RunLoad">
			<img class="img-thumbnail" src="Template/global_assets/images/Cube-1s-200px.gif" />
		</div>	
	</center>
</div>

<div class="RuningLoad">


	<?php

		$DeleteLogIn=new delete_login($TxtYear);
		$count_ReginaStuLogin=0;
		$count_ReginaStuData=0;
		$sud_admission=new SudRcAdmission($TxtYear);
		foreach($sud_admission->RunDataAdmission() as $rc=>$sud_admissionRow){

			$rc_IDReg=$sud_admissionRow["rc_IDReg"];
			$rc_IDCard=$sud_admissionRow["rc_IDCard"];
			$rc_IDstu=$sud_admissionRow["rc_IDstu"];
			
			$UpInt_DataLogin=new UpInt_DataLogin($rc_IDReg,$rc_IDCard,$rc_IDstu,$TxtYear);
			
			
			
			$count_ReginaStuData=$count_ReginaStuData+$UpInt_DataLogin->Run_ReginaStuData();
			$count_ReginaStuLogin=$count_ReginaStuLogin+$UpInt_DataLogin->Run_ReginaStuLogin();		
			
		}
		
		

	?>
		
	
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-body border-top-primary">
				<div class="row">
					<div class="col-<?php echo $grid;?>-6" style="background-color: #FF3366; text-align: center; font-weight: bold;"><?php echo $count_ReginaStuData;?></div>
					<div class="col-<?php echo $grid;?>-6" style="background-color: #FF0099; text-align: center; font-weight: bold;"><?php echo $count_ReginaStuLogin;?></div>
				</div><br>		
				
				<div class="row">
					<div class="col-<?php echo $grid;?>-12" style="text-align: center;">
						<button type="button" class="btn btn-info">หน้าหลัก</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
<br>	
	
	
		
</div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php }else{}?>

		
  

	
	



