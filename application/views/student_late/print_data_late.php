<?php 
    defined('BASEPATH') OR exit('No direct script access allowed'); 

    $this->load->library('session');

    include("view/img_user/document/gotolink.php");
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);
    $golink=$goingtolink->Rungotolink();

    if(($this->session->userdata("rc_user")==null)){
        $this->session->unset_userdata("rc_user");
        exit("<script>window.location='$golink';</script>");
    }else{

        $count_error=0;

            if((isset($_POST["key"]))){

                $count_error=$count_error+0;
            }else{
                $count_error=$count_error+1;
            }

            if((isset($_POST["term"]))){

                $count_error=$count_error+0;
            }else{
                $count_error=$count_error+1;
            }

            if((isset($_POST["year"]))){

                $count_error=$count_error+0;
            }else{
                $count_error=$count_error+1;
            }

            if(($count_error>=1)){
              
            }else{

                include("view/function_class/run_date_time.php");  
                
                include("view/database/pdo_student_late.php");
                include("view/database/class_student_late.php");
                
                include("view/database/pdo_data.php");
                include("view/database/pdo_conndatastu.php");
                include("view/database/pdo_admission.php");
                include("view/database/regina_student.php"); ?>

    <style>
        .psrA{
            margin: auto;
            border: 3px solid #73AD21;
        }
    </style>

    <html lang="en" dir="ltr">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="stats-in-th" content="b062" />
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="shortcut icon" type="image/png">
            <link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon">
            <link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="72x72">
            <link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="114x114">
            <link href="<?php echo base_url();?>/Template/global_assets/images/logoserviam.png" rel="apple-touch-icon" sizes="144x144">
            <title>พิมพ์&nbsp;หนังสือเตือนการมาสายนักเรียน</title>
            <link rel="shortcut icon" href="<?php echo base_url();?>/Template/global_assets/images/logo_rc_wbe.ico"/>
<!-- Global stylesheets -->
            <link href="<?php echo base_url();?>/Template/layout_2/LTR/material/full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->		
<!--Code Print css-->
            <link rel="stylesheet" href="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/css/normalize.css">
            <link rel="stylesheet" href="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/css/paper.css"> 	
<!--Code Print css End-->

            <style>
                @font-face {
                    font-family: 'THSarabunNew';
                    src: url('<?php echo base_url();?>/view/font/thsarabunnew-webfont.eot');
                    src: url('<?php echo base_url();?>/view/font/thsarabunnew-webfont.eot?#iefix') format('embedded-opentype'),
                url('<?php echo base_url();?>/view/font/thsarabunnew-webfont.woff') format('woff'),
                url('<?php echo base_url();?>/view/font/THSarabunNew.ttf') format('truetype');
                }
                body{
                    font-family: "THSarabunNew";
                    font-size: 20px;
                    color: #032E3B;
                }
		    </style>

            <style>
                @media print {
                    @page{
                        size: A4;
                        margin: 1 cm;
                    }
                    
                    button {
                        display:none;
                    }
                    
                    #p_echo{
                        display:none;
                    }
                    
                    body{
                        font-family: "THSarabunNew";
                        font-size: 16pt; 
                                
                    }
                }
			
                body{
                    width: 210mm; height: 296mm;
                }
                .imgA{
                    width: 210mm; height: 296mm;
                }
		    </style>

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

<!-- Core JS files -->
        <script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/jquery.min.js"></script>
	    <script src="<?php echo base_url();?>/Template/global_assets/js/core/libraries/bootstrap.min.js"></script>
<!-- /core JS files -->	
<!--Code Print js-->
	    <script src="<?php echo base_url();?>/public_regina/script_css_js/print_css_js/js/html2canvas.js"></script>	
<!--Code Print js End-->

        </head>

        <body>

            <div id="p_echo">
                <div class="container psrA">
                    <div class="row">
                        <div class="col-<?php echo $grid;?>-12">
                            <div class="table-responsive">
                                <table class="table" align="center" >
                                    <thead>
                                        <tr>
                                            <th style="width: 20%">
                                                <div><button type="button"  style="font-size: 18px;" class="btn btn-default" onclick="window.print()"><b>พิมพ์&nbsp;หนังสือเตือนการมาสายนักเรียน</b></button></div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%">
                                                <div><font color="#F70105" style="font-size: 18px;"><b>ระบบการพิมพ์  รองรับ เว็บเบราว์เซอร์  Google Chrome และ  Microsoft Edge เท่านั้น<b></font></div>
                                            </th>								
                                        </tr>
                                    </thead>						
                                </table>
                                <table class="table" align="center">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%" style="font-size: 18px;"><div>ขนาดกระดาษ</div></th>
                                            <th style="width: 20%" style="font-size: 18px;"><div>แนวกระดาษ</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><div style="font-size: 18px;">A4&nbsp;:&nbsp;210mm&nbsp;X&nbsp;147mm</div></td>
                                            <td><div style="font-size: 18px;">แนวตั้ง</div></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>		
                    </div>		
                </div>
            </div>

            <section class="sheet padding-10mm imgA">

            </section>

        </body>

    </html>	
<?php       }

    }

?>