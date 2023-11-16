<?php
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");
	include("../../../../database/pdo_summer.php");
	include("../../../../database/class_summer.php");		
?>
	<script>
		$(document).ready(function () {
			$('.select').select2({
				minimumResultsForSearch: Infinity,
				containerCssClass: 'bg-violet-400'
			});				
		})
	</script>
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

<?php
	$data_year=filter_input(INPUT_POST,'txtyear');
	$data_class=filter_input(INPUT_POST,'txtclass');
		if(isset($data_year,$data_class)){	
//---------------------------------------------------------------------------------
			$DataClass=new print_level($data_class);
//---------------------------------------------------------------------------------		
		?>
<!--****************************************************************************-->		
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<h6 class="content-group text-semibold">
			ข้อมูลคะแนนวัดและประเมินผลระดับชั้น&nbsp;<?php echo $DataClass->level_Lname;?>&nbsp;ปีการศึกษา&nbsp;<?php echo $data_year;?>&nbsp;
			<small class="display-block">ข้อมูลจะแสดงตามระดับชั้นเรียน</small>
		</h6>
	</div>
</div>
<div class="row">
	<div class="col-<?php echo $grid; ?>-12">
		<div class="panel panel-body border-top-violet">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr class="info">
							<th><div>รหัสนักเรียน</div></th>
							<th><div>ชื่อนักเรียน</div></th>
							<th><div>ชื่อวิชา</div></th>
							<th><div>คะแนนเต็ม</div></th>
							<th><div>คะแนนสอบ(Pre)</div></th>
							<th><div>คะแนนสอบ(Post)</div></th>
							<th><div>การจัดการข้อมูล</div></th>
						</tr>
					</thead>
					<tbody>
<form name="DelectRunSummerScore" >					
		<?php
			$PrintSudSummer=new SudSummer($data_class,$data_year);
			foreach($PrintSudSummer->RunSudSummer() as $rc=>$PrintSudSummerRow){ ?>
				
			<?php
				$PrintSummerSetUpScore=new PrintSummerSetUpScore($data_class,$data_year);
					foreach($PrintSummerSetUpScore->RunPrintSummerSetUpScore() as $rc=>$SummerSetUpScoreRow){ ?>
				
				<?php
					$PrintScoreSud=new DataTestSaveScoreA($PrintSudSummerRow["rs_key"],$data_year,$SummerSetUpScoreRow["RSD_no"]);
						if($PrintScoreSud->DTSS_KeyStu!=""){ ?>
					
					<?php
						$PrintScorePre=new DataTestSaveScoreB($PrintScoreSud->DTSS_KeyStu,$PrintScoreSud->DTSS_Year,"Pre",$SummerSetUpScoreRow["RSD_no"]);
						$PrintScorePost=new DataTestSaveScoreB($PrintScoreSud->DTSS_KeyStu,$PrintScoreSud->DTSS_Year,"Post",$SummerSetUpScoreRow["RSD_no"]);
						
						$ReginaStuData=new regina_stu_data2($PrintScoreSud->DTSS_KeyStu,$PrintScoreSud->DTSS_Year,"1",$data_class);
							
							if($ReginaStuData->rsd_studentid!=null){
								if($ReginaStuData->sd_prefix=="2"){
									$myname="เด็กหญิง ".$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
								}elseif($ReginaStuData->sd_prefix=="4"){
									$myname="นางสาว ".$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
								}else{
									$myname=$ReginaStuData->rsd_name."&nbsp;".$ReginaStuData->rsd_surname;
								}	
							}else{
								$DataRsStudentData=new DataRsStudentData($PrintSudSummerRow["rs_key"],$data_year,$data_class);
								if(isset($DataRsStudentData->mynameTh)){
									$myname=$DataRsStudentData->mynameTh;
								}else{
									if(isset($myname)){
										$myname;
									}else{
										$StudentEvaluation=new Prove_A_PersonRc($PrintSudSummerRow["rs_key"]);
										$myname=$StudentEvaluation->NameTh;
									}			
								}
							}	
							


					?>
					
			
					
						<tr class="success">
							<td><div><?php echo $PrintScoreSud->DTSS_KeyStu;?></div></td>
							<td><div><?php echo $myname;?></div></td>
							<td><div><?php echo $SummerSetUpScoreRow["RSD_txtTh"];?></div></td>
							<td><div><?php echo number_format($SummerSetUpScoreRow["SSUS_Score_full"],0,"","");?></div></td>
						
							<td><div><?php echo number_format($PrintScorePre->DTSS_Score,0,"","") ;?></div></td>
							<td><div><?php echo number_format($PrintScorePost->DTSS_Score,0,"","") ;?></div></td>
							
							<td><div><button type="button" class="btn btn-danger">ลบ</button></div></td>
						</tr>
					
				<?php	}else{}?>

			<?php	} ?>
								
		<?php	} ?>			

</form>
					</tbody>
				</table>
			</div>		
		</div>
	</div>
</div>			
<!--****************************************************************************-->			
<?php	}else{}?>

