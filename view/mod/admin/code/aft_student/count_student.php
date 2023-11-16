<?php
	include("../../../../database/database_evaluation.php");
	$rcdata_connect=connect();
	$copy_class=post_data($_POST["copy_class"]);
	$copy_year=post_data($_POST["copy_year"]);
	
   //echo "$copy_class<br>$copy_year";
?>


	<?php
		$data_class="SELECT `IDLevel`,`Sort_name`,`Lname` FROM `rc_level` 
		             WHERE `IDLevel` >=21 and `IDLevel` <= 43";
		$data_classRs=$rcdata_connect->query($data_class) or die ($rcdata_connect->error);			 
		if($data_classRs->num_rows>0){
			$count_class=1;
			while($data_classRow=$data_classRs->fetch_assoc()){ 
			$IDLevel=$data_classRow["IDLevel"];
			$Lname=$data_classRow["Lname"];
	?>
			
	<?php
		$data_course_teacher="SELECT DISTINCT ct_courseid 
							  FROM `course_teacher` 
							  where rc_course_level='{$IDLevel}' 
							  and ct_courseyear='{$copy_year}' 
							  and ct_courseterm='{$copy_class}';";
		$data_course_teacherRs=rc_array($data_course_teacher);
		$count_arrayA=0;
		$count_arrayB=0;
		foreach($data_course_teacherRs as $rc_key=>$data_course_teacherRow){ 
			$ct_courseid=$data_course_teacherRow["ct_courseid"];
			
			$count_stu="select count(distinct evaluation_id) as int_stu from evaluation where evaluation_year='{$copy_year}' and evaluation_term='{$copy_class}' 
						and evaluation_subjects='{$ct_courseid}' and evaluation_s='1' and evaluation_st='1';";
			$count_stuRs=rc_data($count_stu);
			foreach($count_stuRs as $rc_key=>$count_stuRow){
				$int_stu=$count_stuRow["int_stu"];
			}
				$array_ct_courseid[$count_arrayA]=$ct_courseid;
				$array_int_stu[$count_arrayB]=$int_stu;
			$count_arrayA=$count_arrayA+1;
			$count_arrayB=$count_arrayB+1;
			} 
	?>
			
			
			
<script>

var GoogleColumnBasic = function() {


    //
    // Setup module components
    //

    // Column chart
    var _googleColumnBasic = function() {
        if (typeof google == 'undefined') {
            console.warn('Warning - Google Charts library is not loaded.');
            return;
        }

        // Initialize chart
        google.charts.load('current', {
            callback: function () {

                // Draw chart
                drawColumn();

                // Resize on sidebar width change
                $(document).on('click', '.sidebar-control', drawColumn);

                // Resize on window resize
                var resizeColumn;
                $(window).on('resize', function() {
                    clearTimeout(resizeColumn);
                    resizeColumn = setTimeout(function () {
                        drawColumn();
                    }, 200);
                });
            },
            packages: ['corechart']
        });

        // Chart settings
        function drawColumn() {

            // Define charts element
            var line_chart_element = document.getElementById('google-column<?php echo $count_class;?>');

            // Data
            var data = google.visualization.arrayToDataTable([
                ['รายวิชา', 'จำนวนนักเรียน ประเมิน'],
				<?php
					$num_count=0;
					while($num_count<$count_arrayA){?>
				
				['<?php echo $array_ct_courseid[$num_count];?>',<?php echo $array_int_stu[$num_count];?>],
				
				<?php	$num_count=$num_count+1;}?>				
				
            ]);


            // Options
            var options_column = {
                fontName: 'Roboto',
                height: 400,
                fontSize: 12,
                chartArea: {
                    left: '5%',
                    width: '94%',
                    height: 350
                },
                tooltip: {
                    textStyle: {
                        fontName: 'Roboto',
                        fontSize: 13
                    }
                },
                vAxis: {
                    title: 'Sales and Expenses',
                    titleTextStyle: {
                        fontSize: 13,
                        italic: false
                    },
                    gridlines:{
                        color: '#e5e5e5',
                        count: 10
                    },
                    minValue: 0
                },
                legend: {
                    position: 'top',
                    alignment: 'center',
                    textStyle: {
                        fontSize: 12
                    }
                }
            };

            // Draw chart
            var column = new google.visualization.ColumnChart(line_chart_element);
            column.draw(data, options_column);
        }
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _googleColumnBasic();
        }
    }
}();


// Initialize module
// ------------------------------

GoogleColumnBasic.init();

</script>			
			
			
			
			
			
			
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
<!-- Bar chart -->
		<div class="panel panel-flat">
			<div class="panel-body">
				<div class="chart-container">
					<h4>ยอดนักเรียน ประเมินความพึงพอใจการจัดการเรียนการสอน ระดับชั้น <?php echo $Lname." (".$copy_class."/".$copy_year.")";?> </h4>
				</div>
			</div>		
			<div class="panel-body">
				<div class="chart-container">
					<div class="chart" id="google-column<?php echo $count_class;?>"></div>
				</div>
			</div>

		</div>
<!-- /bar chart -->	
	</div>
</div>			

<?php		$count_class=$count_class+1;}
		}else{ ?>
			
			
<?php	}  ?>










