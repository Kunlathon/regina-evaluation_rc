<?php
    header('Content-Type: text/html; charset=UTF-8');
    class RunDateTime{
        public $DateTimeType,$DateTimeStart,$DateTimeEnd;
        public $print_rundatetime_Start,$print_rundatetime_End;
        function __construct($DateTimeType,$DateTimeStart,$DateTimeEnd){
            $this->DateTimeType=$DateTimeType;            
            $this->DateTimeStart=$DateTimeStart;
            $this->DateTimeEnd=$DateTimeEnd;
            $DateTime=date("Y-m-d H:i:s");
                if(($this->DateTimeType=="date_start")){
//test datetime Start
                    $DateTimeStart=date("Y-m-d H:i:s",strtotime($this->DateTimeStart));
                    $code_int_dt_Start_key=strtotime($DateTimeStart);
                    $code_int_dt_Start_system=strtotime($DateTime);
                        if(($code_int_dt_Start_system>=$code_int_dt_Start_key)){
                            $print_rundatetime_Start="ON";
                        }else{
                            $print_rundatetime_Start="OFF";
                        }
//test datetime start end
                }elseif(($this->DateTimeType=="date_end")){
//test datetime end
                        $DateTimeEnd=date("Y-m-d H:i:s",strtotime($this->DateTimeEnd));
                        $code_int_dt_End_key=strtotime($DateTimeEnd);
                        $code_int_dt_End_system=strtotime($DateTime);
                            if(($code_int_dt_End_system>=$code_int_dt_End_key)){
                                $print_rundatetime_End="OFF";
                            }else{
                                $print_rundatetime_End="ON";
                            }
//test datetime end end
                }elseif(($this->DateTimeType=="date_all")){
//test datetime Start
                        $DateTimeStart=date("Y-m-d H:i:s",strtotime($this->DateTimeStart));
                        $code_int_dt_Start_key=strtotime($DateTimeStart);
                        $code_int_dt_Start_system=strtotime($DateTime);

                                if(($code_int_dt_Start_system>=$code_int_dt_Start_key)){
                                    $rundatetime_start="ON";
                                }else{
                                    $rundatetime_start="OFF";
                                }
//test datetime start end
//test datetime end
                        $DateTimeEnd=date("Y-m-d H:i:s",strtotime($this->DateTimeEnd));
                        $code_int_dt_End_key=strtotime($DateTimeEnd);
                        $code_int_dt_End_system=strtotime($DateTime);

                            if(($code_int_dt_End_system>=$code_int_dt_End_key)){
                                $print_rundatetime_End="OFF";
                            }else{
                                $print_rundatetime_End="ON";
                            }
//test datetime end end
                            if(($rundatetime_start=="ON")){
                                if(($print_rundatetime_End=="ON")){
                                    $print_rundatetime_Start="ON";
                                }else{
                                    $print_rundatetime_Start="OFF";
                                }
                            }else{
                                $print_rundatetime_Start="OFF";
                            }
                }else{
                    $print_rundatetime_Start="-";
                    $print_rundatetime_End="-";
                }
                $this->print_rundatetime_Start=$print_rundatetime_Start;
                $this->print_rundatetime_End=$print_rundatetime_End;
        }function Call_DateTime_Start(){
            return $this->print_rundatetime_Start;
        }function Call_Datetime_End(){
            return $this->print_rundatetime_End;
        }
    }
?>