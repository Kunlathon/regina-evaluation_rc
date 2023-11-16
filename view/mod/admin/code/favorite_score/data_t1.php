<?php
	include("../../../../database/database_evaluation.php");
	$rcdata_connect= connect();
	$copy_year=2562;
	
?>
<!doctype html>
<html>
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="../../../../../Template/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="../../../../../Template/layout_2/LTR/material/full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="../../../../../Template/layout_2/LTR/material/full/assets/css/core.min.css" rel="stylesheet" type="text/css">
	<link href="../../../../../Template/layout_2/LTR/material/full/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="../../../../../Template/layout_2/LTR/material/full/assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
<head>
<meta charset="utf-8">
	<script src="../../../../../Template/global_assets/js/plugins/loaders/pace.min.js"></script>
	<script src="../../../../../Template/global_assets/js/core/libraries/jquery.min.js"></script>
	<script src="../../../../../Template/global_assets/js/core/libraries/bootstrap.min.js"></script>
	<script src="../../../../../Template/global_assets/js/plugins/loaders/blockui.min.js"></script>

</head>

		<script type="text/javascript">
			function DLtoExcel(){
				
		        $("#tableData").excelexportjs({
					containerid: "tableData"
					,datatype: 'table'
				});		
			  
			}
		</script>

<body onload="DLtoExcel()">

<table width="40%" id="tableData" class="table table-bordered"  border="1" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td colspan="5"><center>โหวตคุณครูในดวงใจของหนู ปีการศึกษา <?php echo $copy_year;?></center></td>
    </tr>
    <tr>
      <td colspan="5"><center>ครู อนุบาล-ประถม</center></td>
    </tr>
    <tr>
      <th>ลำดับ</th>
      <th colspan="3">ชื่อ - สกุล</th>
      <th>คะแนน</th>
    </tr>
<?php
	$print_data="select `rc_person`.`IDTeacher`,`rc_prefix`.`prefixname`,`rc_person`.`FName`,`rc_person`.`SName`,`favorite_score`.`fc_score`,`team_teacher_group`.`ttg_txt` 
			     from `rc_person` join `rc_prefix` on(`rc_person`.`IDPrefix`=`rc_prefix`.`IDPrefix`) 
			     join `team_teacher` on(`rc_person`.`IDTeacher`=`team_teacher`.`tt_rc`) 
				 join `team_teacher_group` on(`team_teacher`.`ttg_key`=`team_teacher_group`.`ttg_key`) 
				 join `favorite_score` on(`team_teacher`.`tt_rc`=`favorite_score`.`fc_teacher`) 
				 where `favorite_score`.`fc_yaer`='{$copy_year}' 
				 and `team_teacher`.`ttg_key`='1' 
				 ORDER BY `favorite_score`.`fc_score` DESC";
	$print_dataRs=rc_array($print_data);

	foreach($print_dataRs as $rc_key =>$print_dataRow){
		$IDTeacher=$print_dataRow["IDTeacher"];
		$myname=$print_dataRow["prefixname"]." ".$print_dataRow["FName"]." ".$print_dataRow["SName"];
		$fc_score=$print_dataRow["fc_score"]; ?>
		
    <tr>
      <td><?php echo $IDTeacher;?></td>
      <td colspan="3"><?php echo $myname;?></td>
      <td><?php echo $fc_score ;?></td>
    </tr>		
		
<?php	} ?>	

  </tbody>
</table>

</body>
</html>
		
