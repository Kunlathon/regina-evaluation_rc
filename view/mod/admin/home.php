<?php
	include("view/database/pdo_data.php");
	include("view/database/class_admin.php");
	//include("view/database/class_pdo.php");	
?>

<?php
	$txt_t=1;
	$txt_y=2566;
	$static03C=new static_stuRC($txt_t,$txt_y,3,1);
	$static11C=new static_stuRC($txt_t,$txt_y,11,1);
	$static12C=new static_stuRC($txt_t,$txt_y,12,1);
	$static13C=new static_stuRC($txt_t,$txt_y,13,1);
	$static21C=new static_stuRC($txt_t,$txt_y,21,1);
	$static22C=new static_stuRC($txt_t,$txt_y,22,1);
	$static23C=new static_stuRC($txt_t,$txt_y,23,1);
	$static31C=new static_stuRC($txt_t,$txt_y,31,1);
	$static32C=new static_stuRC($txt_t,$txt_y,32,1);
	$static33C=new static_stuRC($txt_t,$txt_y,33,1);
	$static41C=new static_stuRC($txt_t,$txt_y,41,1);
	$static42C=new static_stuRC($txt_t,$txt_y,42,1);
	$static43C=new static_stuRC($txt_t,$txt_y,43,1);
	
	$static03o=new static_stuRC($txt_t,$txt_y,3,3);
	$static11o=new static_stuRC($txt_t,$txt_y,11,3);
	$static12o=new static_stuRC($txt_t,$txt_y,12,3);
	$static13o=new static_stuRC($txt_t,$txt_y,13,3);
	$static21o=new static_stuRC($txt_t,$txt_y,21,3);
	$static22o=new static_stuRC($txt_t,$txt_y,22,3);
	$static23o=new static_stuRC($txt_t,$txt_y,23,3);
	$static31o=new static_stuRC($txt_t,$txt_y,31,3);
	$static32o=new static_stuRC($txt_t,$txt_y,32,3);
	$static33o=new static_stuRC($txt_t,$txt_y,33,3);
	$static41o=new static_stuRC($txt_t,$txt_y,41,3);
	$static42o=new static_stuRC($txt_t,$txt_y,42,3);
	$static43o=new static_stuRC($txt_t,$txt_y,43,3);
	
	$static03P=new static_stuRC($txt_t,$txt_y,3,4);
	$static11P=new static_stuRC($txt_t,$txt_y,11,4);
	$static12P=new static_stuRC($txt_t,$txt_y,12,4);
	$static13P=new static_stuRC($txt_t,$txt_y,13,4);
	$static21P=new static_stuRC($txt_t,$txt_y,21,4);
	$static22P=new static_stuRC($txt_t,$txt_y,22,4);
	$static23P=new static_stuRC($txt_t,$txt_y,23,4);
	$static31P=new static_stuRC($txt_t,$txt_y,31,4);
	$static32P=new static_stuRC($txt_t,$txt_y,32,4);
	$static33P=new static_stuRC($txt_t,$txt_y,33,4);
	$static41P=new static_stuRC($txt_t,$txt_y,41,4);
	$static42P=new static_stuRC($txt_t,$txt_y,42,4);
	$static43P=new static_stuRC($txt_t,$txt_y,43,4);
	
	$static03n=new static_stuRC($txt_t,$txt_y,3,11);
	$static11n=new static_stuRC($txt_t,$txt_y,11,11);
	$static12n=new static_stuRC($txt_t,$txt_y,12,11);
	$static13n=new static_stuRC($txt_t,$txt_y,13,11);
	$static21n=new static_stuRC($txt_t,$txt_y,21,11);
	$static22n=new static_stuRC($txt_t,$txt_y,22,11);
	$static23n=new static_stuRC($txt_t,$txt_y,23,11);
	$static31n=new static_stuRC($txt_t,$txt_y,31,11);
	$static32n=new static_stuRC($txt_t,$txt_y,32,11);
	$static33n=new static_stuRC($txt_t,$txt_y,33,11);
	$static41n=new static_stuRC($txt_t,$txt_y,41,11);
	$static42n=new static_stuRC($txt_t,$txt_y,42,11);
	$static43n=new static_stuRC($txt_t,$txt_y,43,11);
	
?>

	<script>
		$(document).ready(function () {
			    var area_basic_element = document.getElementById('area_basic');
				
				        // Initialize chart
        var area_basic = echarts.init(area_basic_element);


        //
        // Chart config
        //

        // Options
        area_basic.setOption({

            // Define colors
            color: ['#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80'],

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
                data: ['นักเรียนปัจจุบัน', 'ลาออก','นักเรียนแลกเปลี่ยน','ฝากเรียน'],
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
                data: ['อนุบาล 3','ป.1','ป.2','ป.3','ป.4','ป.5','ป.6','ม.1','ม.2','ม.3','ม.4','ม.5','ม.6'],
                axisLabel: {
                    color: '#333'
                },
                axisLine: {
                    lineStyle: {
                        color: '#999'
                    }
                },
                splitLine: {
                    show: true,
                    lineStyle: {
                        color: '#eee',
                        type: 'dashed'
                    }
                }
            }],

            // Vertical axis
            yAxis: [{
                type: 'value',
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
                        color: '#eee'
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
                    name: 'ลาออก',
                    type: 'line',
                    data: [<?php echo $static03o->print_static();?>, <?php echo $static11o->print_static();?>, <?php echo $static12o->print_static();?>, <?php echo $static13o->print_static();?>, <?php echo $static21o->print_static();?>, <?php echo $static22o->print_static();?>, <?php echo $static23o->print_static();?>,<?php echo $static31o->print_static();?>, <?php echo $static32o->print_static();?>, <?php echo $static33o->print_static();?>, <?php echo $static41o->print_static();?>, <?php echo $static42o->print_static();?>,<?php echo $static43o->print_static();?> ],
                    areaStyle: {
                        normal: {
                            opacity: 0.25
                        }
                    },
                    smooth: true,
                    symbolSize: 7,
                    itemStyle: {
                        normal: {
                            borderWidth: 2
                        }
                    }
                },
                {
                    name: 'นักเรียนปัจจุบัน',
                    type: 'line',
                    smooth: true,
                    symbolSize: 7,
                    itemStyle: {
                        normal: {
                            borderWidth: 2
                        }
                    },
                    areaStyle: {
                        normal: {
                            opacity: 0.25
                        }
                    },
                    data: [<?php echo $static03C->print_static();?>, <?php echo $static11C->print_static();?>, <?php echo $static12C->print_static();?>, <?php echo $static13C->print_static();?>, <?php echo $static21C->print_static();?>, <?php echo $static22C->print_static();?>, <?php echo $static23C->print_static();?>,<?php echo $static31C->print_static();?>, <?php echo $static32C->print_static();?>, <?php echo $static33C->print_static();?>, <?php echo $static41C->print_static();?>, <?php echo $static42C->print_static();?>,<?php echo $static43C->print_static();?> ]
                },
				{
                    name: 'นักเรียนแลกเปลี่ยน',
                    type: 'line',
                    smooth: true,
                    symbolSize: 7,
                    itemStyle: {
                        normal: {
                            borderWidth: 2
                        }
                    },
                    areaStyle: {
                        normal: {
                            opacity: 0.25
                        }
                    },
                    data: [<?php echo $static03P->print_static();?>, <?php echo $static11P->print_static();?>, <?php echo $static12P->print_static();?>, <?php echo $static13P->print_static();?>, <?php echo $static21P->print_static();?>, <?php echo $static22P->print_static();?>, <?php echo $static23P->print_static();?>,<?php echo $static31P->print_static();?>, <?php echo $static32P->print_static();?>, <?php echo $static33P->print_static();?>, <?php echo $static41P->print_static();?>, <?php echo $static42P->print_static();?>,<?php echo $static43P->print_static();?> ]
                },
				{
                    name: 'ฝากเรียน',
                    type: 'line',
                    smooth: true,
                    symbolSize: 7,
                    itemStyle: {
                        normal: {
                            borderWidth: 2
                        }
                    },
                    areaStyle: {
                        normal: {
                            opacity: 0.25
                        }
                    },
                    data: [<?php echo $static03n->print_static();?>, <?php echo $static11n->print_static();?>, <?php echo $static12n->print_static();?>, <?php echo $static13n->print_static();?>, <?php echo $static21n->print_static();?>, <?php echo $static22n->print_static();?>, <?php echo $static23n->print_static();?>,<?php echo $static31n->print_static();?>, <?php echo $static32n->print_static();?>, <?php echo $static33n->print_static();?>, <?php echo $static41n->print_static();?>, <?php echo $static42n->print_static();?>,<?php echo $static43n->print_static();?> ]
                }				

            ]
        });

		})
	</script>	

<?php

	$static03B=new static_stuRCcolor($txt_t,$txt_y,3,1,1);
	$static11B=new static_stuRCcolor($txt_t,$txt_y,11,1,1);
	$static12B=new static_stuRCcolor($txt_t,$txt_y,12,1,1);
	$static13B=new static_stuRCcolor($txt_t,$txt_y,13,1,1);
	$static21B=new static_stuRCcolor($txt_t,$txt_y,21,1,1);
	$static22B=new static_stuRCcolor($txt_t,$txt_y,22,1,1);
	$static23B=new static_stuRCcolor($txt_t,$txt_y,23,1,1);
	$static31B=new static_stuRCcolor($txt_t,$txt_y,31,1,1);
	$static32B=new static_stuRCcolor($txt_t,$txt_y,32,1,1);
	$static33B=new static_stuRCcolor($txt_t,$txt_y,33,1,1);
	$static41B=new static_stuRCcolor($txt_t,$txt_y,41,1,1);
	$static42B=new static_stuRCcolor($txt_t,$txt_y,42,1,1);
	$static43B=new static_stuRCcolor($txt_t,$txt_y,43,1,1);
	
	$static03R=new static_stuRCcolor($txt_t,$txt_y,3,1,2);
	$static11R=new static_stuRCcolor($txt_t,$txt_y,11,1,2);
	$static12R=new static_stuRCcolor($txt_t,$txt_y,12,1,2);
	$static13R=new static_stuRCcolor($txt_t,$txt_y,13,1,2);
	$static21R=new static_stuRCcolor($txt_t,$txt_y,21,1,2);
	$static22R=new static_stuRCcolor($txt_t,$txt_y,22,1,2);
	$static23R=new static_stuRCcolor($txt_t,$txt_y,23,1,2);
	$static31R=new static_stuRCcolor($txt_t,$txt_y,31,1,2);
	$static32R=new static_stuRCcolor($txt_t,$txt_y,32,1,2);
	$static33R=new static_stuRCcolor($txt_t,$txt_y,33,1,2);
	$static41R=new static_stuRCcolor($txt_t,$txt_y,41,1,2);
	$static42R=new static_stuRCcolor($txt_t,$txt_y,42,1,2);
	$static43R=new static_stuRCcolor($txt_t,$txt_y,43,1,2);
	
	$static03Y=new static_stuRCcolor($txt_t,$txt_y,3,1,3);
	$static11Y=new static_stuRCcolor($txt_t,$txt_y,11,1,3);
	$static12Y=new static_stuRCcolor($txt_t,$txt_y,12,1,3);
	$static13Y=new static_stuRCcolor($txt_t,$txt_y,13,1,3);
	$static21Y=new static_stuRCcolor($txt_t,$txt_y,21,1,3);
	$static22Y=new static_stuRCcolor($txt_t,$txt_y,22,1,3);
	$static23Y=new static_stuRCcolor($txt_t,$txt_y,23,1,3);
	$static31Y=new static_stuRCcolor($txt_t,$txt_y,31,1,3);
	$static32Y=new static_stuRCcolor($txt_t,$txt_y,32,1,3);
	$static33Y=new static_stuRCcolor($txt_t,$txt_y,33,1,3);
	$static41Y=new static_stuRCcolor($txt_t,$txt_y,41,1,3);
	$static42Y=new static_stuRCcolor($txt_t,$txt_y,42,1,3);
	$static43Y=new static_stuRCcolor($txt_t,$txt_y,43,1,3);

	$static03G=new static_stuRCcolor($txt_t,$txt_y,3,1,4);
	$static11G=new static_stuRCcolor($txt_t,$txt_y,11,1,4);
	$static12G=new static_stuRCcolor($txt_t,$txt_y,12,1,4);
	$static13G=new static_stuRCcolor($txt_t,$txt_y,13,1,4);
	$static21G=new static_stuRCcolor($txt_t,$txt_y,21,1,4);
	$static22G=new static_stuRCcolor($txt_t,$txt_y,22,1,4);
	$static23G=new static_stuRCcolor($txt_t,$txt_y,23,1,4);
	$static31G=new static_stuRCcolor($txt_t,$txt_y,31,1,4);
	$static32G=new static_stuRCcolor($txt_t,$txt_y,32,1,4);
	$static33G=new static_stuRCcolor($txt_t,$txt_y,33,1,4);
	$static41G=new static_stuRCcolor($txt_t,$txt_y,41,1,4);
	$static42G=new static_stuRCcolor($txt_t,$txt_y,42,1,4);
	$static43G=new static_stuRCcolor($txt_t,$txt_y,43,1,4);

?>


	<script>
		$(document).ready(function () {
			    var area_basic_element = document.getElementById('area_basicA');
				
				        // Initialize chart
        var area_basic = echarts.init(area_basic_element);


        //
        // Chart config
        //

        // Options
        area_basic.setOption({

            // Define colors
            color: ['#00FFFF','#FF0000','#FFFF00','#00FF00'],

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
                data: ['บ้านฟ้า', 'บ้านแดง','บ้านเหลือง','บ้านเขียว'],
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
                data: ['อนุบาล 3','ป.1','ป.2','ป.3','ป.4','ป.5','ป.6','ม.1','ม.2','ม.3','ม.4','ม.5','ม.6'],
                axisLabel: {
                    color: '#333'
                },
                axisLine: {
                    lineStyle: {
                        color: '#999'
                    }
                },
                splitLine: {
                    show: true,
                    lineStyle: {
                        color: '#eee',
                        type: 'dashed'
                    }
                }
            }],

            // Vertical axis
            yAxis: [{
                type: 'value',
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
                        color: '#eee'
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
                    name: 'บ้านฟ้า',
                    type: 'line',
                    data: [<?php echo $static03B->print_static_color();?>, <?php echo $static11B->print_static_color();?>, <?php echo $static12B->print_static_color();?>, <?php echo $static13B->print_static_color();?>, <?php echo $static21B->print_static_color();?>, <?php echo $static22B->print_static_color();?>, <?php echo $static23B->print_static_color();?>,<?php echo $static31B->print_static_color();?>, <?php echo $static32B->print_static_color();?>, <?php echo $static33B->print_static_color();?>, <?php echo $static41B->print_static_color();?>, <?php echo $static42B->print_static_color();?>,<?php echo $static43B->print_static_color();?> ],
                    areaStyle: {
                        normal: {
                            opacity: 0.25
                        }
                    },
                    smooth: true,
                    symbolSize: 7,
                    itemStyle: {
                        normal: {
                            borderWidth: 2
                        }
                    }
                },
                {
                    name: 'บ้านแดง',
                    type: 'line',
                    smooth: true,
                    symbolSize: 7,
                    itemStyle: {
                        normal: {
                            borderWidth: 2
                        }
                    },
                    areaStyle: {
                        normal: {
                            opacity: 0.25
                        }
                    },
                    data: [<?php echo $static03R->print_static_color();?>, <?php echo $static11R->print_static_color();?>, <?php echo $static12R->print_static_color();?>, <?php echo $static13R->print_static_color();?>, <?php echo $static21R->print_static_color();?>, <?php echo $static22R->print_static_color();?>, <?php echo $static23R->print_static_color();?>,<?php echo $static31R->print_static_color();?>, <?php echo $static32R->print_static_color();?>, <?php echo $static33R->print_static_color();?>, <?php echo $static41R->print_static_color();?>, <?php echo $static42R->print_static_color();?>,<?php echo $static43R->print_static_color();?> ]
                },
				{
                    name: 'บ้านเหลือง',
                    type: 'line',
                    smooth: true,
                    symbolSize: 7,
                    itemStyle: {
                        normal: {
                            borderWidth: 2
                        }
                    },
                    areaStyle: {
                        normal: {
                            opacity: 0.25
                        }
                    },
                    data: [<?php echo $static03Y->print_static_color();?>, <?php echo $static11Y->print_static_color();?>, <?php echo $static12Y->print_static_color();?>, <?php echo $static13Y->print_static_color();?>, <?php echo $static21Y->print_static_color();?>, <?php echo $static22Y->print_static_color();?>, <?php echo $static23Y->print_static_color();?>,<?php echo $static31Y->print_static_color();?>, <?php echo $static32Y->print_static_color();?>, <?php echo $static33Y->print_static_color();?>, <?php echo $static41Y->print_static_color();?>, <?php echo $static42Y->print_static_color();?>,<?php echo $static43Y->print_static_color();?> ]
                },
				{
                    name: 'บ้านเขียว',
                    type: 'line',
                    smooth: true,
                    symbolSize: 7,
                    itemStyle: {
                        normal: {
                            borderWidth: 2
                        }
                    },
                    areaStyle: {
                        normal: {
                            opacity: 0.25
                        }
                    },
                    data: [<?php echo $static03G->print_static_color();?>, <?php echo $static11G->print_static_color();?>, <?php echo $static12G->print_static_color();?>, <?php echo $static13G->print_static_color();?>, <?php echo $static21G->print_static_color();?>, <?php echo $static22G->print_static_color();?>, <?php echo $static23G->print_static_color();?>,<?php echo $static31G->print_static_color();?>, <?php echo $static32G->print_static_color();?>, <?php echo $static33G->print_static_color();?>, <?php echo $static41G->print_static_color();?>, <?php echo $static42G->print_static_color();?>,<?php echo $static43G->print_static_color();?> ]
                }				

            ]
        });

		})
	</script>


<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-warning">
			<div class="page-header">สถิติจำนวนนักเรียนทั้งหมด</div>
			<div class="chart-container">
				<div class="chart has-fixed-height" id="area_basic"></div>				
			</div>
		</div>
	</div>
	<div class="col-<?php echo $grid;?>-12">
		<div style="font color: #F7060A">* ข้อมูล เทอม <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y; ?> (สถิติจำนวนนักเรียนทั้งหมด)</div>
	</div>
</div>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="alert alert-info">
			<div class="page-header">สถิติจำนวนสีบ้านทุกระดับชั้น</div>
			<div class="char_container">
				<div class="chart has-fixed-height" id="area_basicA"></div>
			</div>
		</div>
	</div>
	<div class="col-<?php echo $grid;?>-12">
		<div style="font color: #F7060A">* ข้อมูล เทอม <?php echo $txt_t;?> ปีการศึกษา <?php echo $txt_y; ?> (สถิติจำนวนสีบ้านทุกระดับชั้น)</div>
	</div>	
</div>
					

