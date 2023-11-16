	
<?php
	include("../../../../database/database_evaluation.php");
	
	include("../../../../database/pdo_conndatastu.php");
	include("../../../../database/class_pdodatastu.php");
	
	include("../../../../database/pdo_data.php");
	include("../../../../database/class_admin.php");

	

	
	include("../../../../database/database_paynew.php");
	include("../../../../database/class_pay.php");
	
	include("../../../../database/pdo_activity.php");
	include("../../../../database/class_activity.php");
	
	$txt_year=post_data(filter_input(INPUT_POST,'txt_year'));

	//$txt_room=post_data(filter_input(INPUT_POST,'txt_room'));
	
	$txt_t=substr($txt_year,0,1);
	$txt_y=substr($txt_year,2,4);


	//$txt_level=new print_level($txt_class);
	

	
?>
	

		


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
					$count21T=0;
					$count21F=0;			
				$data_sturc=new data_stuclass($txt_t,$txt_y,'21');	
				foreach($data_sturc->printdata_stuclass as $rc_key=>$sturcroom_rom){ 
					$rsd_studentid=$sturcroom_rom["rsd_studentid"];
					$count_SturcActivity=new sturc_activity($rsd_studentid,$txt_t,$txt_y);
					$count_SA=0;

						foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
							$count_SA=$count_SA+1;
						}
							if($count_SA>=1){
								$count21T=$count21T+1;
							}else{ 
								$count21F=$count21F+1;
							}
				} 
			?>
<!--****************************************************************************-->
			<?php		
					$count22T=0;
					$count22F=0;			
				$data_sturc=new data_stuclass($txt_t,$txt_y,'22');	
				foreach($data_sturc->printdata_stuclass as $rc_key=>$sturcroom_rom){ 
					$rsd_studentid=$sturcroom_rom["rsd_studentid"];
					$count_SturcActivity=new sturc_activity($rsd_studentid,$txt_t,$txt_y);
					$count_SA=0;

						foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
							$count_SA=$count_SA+1;
						}
							if($count_SA>=1){
								$count22T=$count22T+1;
							}else{ 
								$count22F=$count22F+1;
							}
				} 
			?>
<!--****************************************************************************-->
			<?php			
					$count23T=0;
					$count23F=0;			
				$data_sturc=new data_stuclass($txt_t,$txt_y,'23');	
				foreach($data_sturc->printdata_stuclass as $rc_key=>$sturcroom_rom){ 
					$rsd_studentid=$sturcroom_rom["rsd_studentid"];
					$count_SturcActivity=new sturc_activity($rsd_studentid,$txt_t,$txt_y);
					$count_SA=0;

						foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
							$count_SA=$count_SA+1;
						}
							if($count_SA>=1){
								$count23T=$count23T+1;
							}else{ 
								$count23F=$count23F+1;
							}
				} 
			?>
<!--****************************************************************************-->
<!--****************************************************************************-->
			<?php			
					$count31T=0;
					$count31F=0;			
				$data_sturc=new data_stuclass($txt_t,$txt_y,'31');	
				foreach($data_sturc->printdata_stuclass as $rc_key=>$sturcroom_rom){ 
					$rsd_studentid=$sturcroom_rom["rsd_studentid"];
					$count_SturcActivity=new sturc_activity($rsd_studentid,$txt_t,$txt_y);
					$count_SA=0;

						foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
							$count_SA=$count_SA+1;
						}
							if($count_SA>=1){
								$count31T=$count31T+1;
							}else{ 
								$count31F=$count31F+1;
							}
				} 
			?>
<!--****************************************************************************-->
<!--****************************************************************************-->
			<?php		
					$count32T=0;
					$count32F=0;			
				$data_sturc=new data_stuclass($txt_t,$txt_y,'32');	
				foreach($data_sturc->printdata_stuclass as $rc_key=>$sturcroom_rom){ 
					$rsd_studentid=$sturcroom_rom["rsd_studentid"];
					$count_SturcActivity=new sturc_activity($rsd_studentid,$txt_t,$txt_y);
					$count_SA=0;

						foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
							$count_SA=$count_SA+1;
						}
							if($count_SA>=1){
								$count32T=$count32T+1;
							}else{ 
								$count32F=$count32F+1;
							}
				} 
			?>
<!--****************************************************************************-->
<!--****************************************************************************-->
			<?php		
					$count33T=0;
					$count33F=0;			
				$data_sturc=new data_stuclass($txt_t,$txt_y,'33');	
				foreach($data_sturc->printdata_stuclass as $rc_key=>$sturcroom_rom){ 
					$rsd_studentid=$sturcroom_rom["rsd_studentid"];
					$count_SturcActivity=new sturc_activity($rsd_studentid,$txt_t,$txt_y);
					$count_SA=0;

						foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
							$count_SA=$count_SA+1;
						}
							if($count_SA>=1){
								$count33T=$count33T+1;
							}else{ 
								$count33F=$count33F+1;
							}
				} 
			?>
<!--****************************************************************************-->
<!--****************************************************************************-->
			<?php			
					$count41T=0;
					$count41F=0;			
				$data_sturc=new data_stuclass($txt_t,$txt_y,'41');	
				foreach($data_sturc->printdata_stuclass as $rc_key=>$sturcroom_rom){ 
					$rsd_studentid=$sturcroom_rom["rsd_studentid"];
					$count_SturcActivity=new sturc_activity($rsd_studentid,$txt_t,$txt_y);
					$count_SA=0;

						foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
							$count_SA=$count_SA+1;
						}
							if($count_SA>=1){
								$count41T=$count41T+1;
							}else{ 
								$count41F=$count41F+1;
							}
				} 
			?>
<!--****************************************************************************-->
<!--****************************************************************************-->
			<?php		
					$count42T=0;
					$count42F=0;			
				$data_sturc=new data_stuclass($txt_t,$txt_y,'42');	
				foreach($data_sturc->printdata_stuclass as $rc_key=>$sturcroom_rom){ 
					$rsd_studentid=$sturcroom_rom["rsd_studentid"];
					$count_SturcActivity=new sturc_activity($rsd_studentid,$txt_t,$txt_y);
					$count_SA=0;

						foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
							$count_SA=$count_SA+1;
						}
							if($count_SA>=1){
								$count42T=$count42T+1;
							}else{ 
								$count42F=$count42F+1;
							}
				} 
			?>
<!--****************************************************************************-->
<!--****************************************************************************-->
			<?php			
					$count43T=0;
					$count43F=0;			
				$data_sturc=new data_stuclass($txt_t,$txt_y,'43');	
				foreach($data_sturc->printdata_stuclass as $rc_key=>$sturcroom_rom){ 
					$rsd_studentid=$sturcroom_rom["rsd_studentid"];
					$count_SturcActivity=new sturc_activity($rsd_studentid,$txt_t,$txt_y);
					$count_SA=0;

						foreach($count_SturcActivity->print_sturcto() as $rc_key=>$count_SturcActivityRow){
							$count_SA=$count_SA+1;
						}
							if($count_SA>=1){
								$count43T=$count43T+1;
							}else{ 
								$count43F=$count43F+1;
							}
				} 
			?>
<!--****************************************************************************-->
<!--****************************************************************************-->
<script type="text/javascript">			
	$(document).ready(function (){
		
		    // Define elements



   
    var line_values_element = document.getElementById('line_values');
    var line_zoom_element = document.getElementById('line_zoom');


    //
    // Charts configuration
    //

    // Display point values
    if (line_values_element) {

        // Initialize chart
        var line_values = echarts.init(line_values_element);


        //
        // Chart config
        //

        // Options
        line_values.setOption({

            // Define colors
            color: ['#49C1B6', '#EA007B'],

            // Global text styles
            textStyle: {
                fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                fontSize: 13
            },

            // Chart animation duration
            animationDuration: 750,

            // Setup grid
            grid: {
                left: 0,
                right: 40,
                top: 35,
                bottom: 0,
                containLabel: true
            },

            // Add legend
            legend: {
                data: ['ลงทะเบียน', 'ไม่ลงทะเบียน'],
                itemHeight: 8,
                itemGap: 20
            },

            // Add tooltip
            tooltip: {
                trigger: 'axis',
                backgroundColor: 'rgba(0,0,0,0.75)',
                padding: [10, 15],
                textStyle: {
                    fontSize: 13,
                    fontFamily: 'Roboto, sans-serif'
                }
            },

            // Horizontal axis
            xAxis: [{
                type: 'category',
                boundaryGap: false,
                data: ['ป4', 'ป5', 'ป6', 'ม1', 'ม2', 'ม3', 'ม4','ม5'],
                axisLabel: {
                    color: '#333'
                },
                axisLine: {
                    lineStyle: {
                        color: '#999'
                    }
                },
                splitLine: {
                    lineStyle: {
                        color: ['#eee']
                    }
                }
            }],

            // Vertical axis
            yAxis: [{
                type: 'value',
                axisLabel: {
                    formatter: '{value} คน',
                    color: '#333'
                },
                axisLine: {
                    lineStyle: {
                        color: '#999'
                    }
                },
                splitLine: {
                    lineStyle: {
                        color: ['#eee']
                    }
                },
                splitArea: {
                    show: true,
                    areaStyle: {
                        color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                    }
                }
            }],

            // Add series
            series: [
                {
                    name: 'ลงทะเบียน',
                    type: 'line',
                    data: [<?php echo $count21T;?>, <?php echo $count22T;?>,<?php echo $count23T;?>,<?php echo $count31T;?>,<?php echo $count32T;?>,<?php echo $count33T;?>,<?php echo $count41T;?>,<?php echo $count42T;?>,<?php echo $count43T;?>],
                    smooth: true,
                    symbolSize: 7,
                    label: {
                        normal: {
                            show: true
                        } 
                    },
                    itemStyle: {
                        normal: {
                            borderWidth: 2
                        }
                    }
                },
                {
                    name: 'ไม่ลงทะเบียน',
                    type: 'line',
                    data: [<?php echo $count21F;?>, <?php echo $count22F;?>,<?php echo $count23F;?>,<?php echo $count31F;?>,<?php echo $count32F;?>,<?php echo $count33F;?>,<?php echo $count41F;?>,<?php echo $count42F;?>,<?php echo $count43F;?>],
                    smooth: true,
                    symbolSize: 7,
                    label: {
                        normal: {
                            show: true
                        } 
                    },
                    itemStyle: {
                        normal: {
                            borderWidth: 2
                        }
                    }
                }
            ]
        });
    }




    //
    // Resize charts
    //

    // Resize function
    var triggerChartResize = function() {
        //line_basic_element && line_basic.resize();
        //line_stacked_element && line_stacked.resize();
        //line_inverted_axes_element && line_inverted_axes.resize();
        //line_multiple_element && line_multiple.resize();
          line_values_element && line_values.resize();
        //line_zoom_element && line_zoom.resize();
    };

    // On sidebar width change
    $(document).on('click', '.sidebar-control', function() {
        setTimeout(function () {
            triggerChartResize();
        }, 0);
    });

    // On window resize
    var resizeCharts;
    window.onresize = function () {
        clearTimeout(resizeCharts);
        resizeCharts = setTimeout(function () {
            triggerChartResize();
        }, 200);
    };
		
	})	
</script>







     
	<div class="row">
		<div class="col-<?php echo $grid;?>-12">
			<div class="panel panel-success">
				<div class="panel-heading">ข้อมูลทางสถิติ ลงกิจกรรมชุมนุม ปีการศึกษา <?php echo $txt_year;?></div>
				<div class="panel-body">
					<div class="chart-container">
						<div class="chart has-fixed-height" id="line_values"></div>
					</div>
				</div>
			</div>
		</div>
	</div> 

	

    

   



