                            if((isset($Student_Row["วันที่สาย"]))){
                                $DateLate=date($Student_Row["วันที่สาย"]);
                                $DateLate=str_replace("/","-",$DateLate);
                                $DateLate=date("Y-m-d",strtotime("-543 year",strtotime($DateLate)));
                            }else{
                                $DateLate="-";
                            }
                          
                            if((isset($Student_Row["เลขประจำตัว"]))){
                                $Student_Key=$Student_Row["เลขประจำตัว"];
                            }else{
                                $Student_Key="-";
                            }

                            if(($Student_Key!="-" and $DateLate!="-")){
                                $copy_Student_Key=$Student_Key;
                            }elseif(($Student_Key=="-" and $DateLate!="-")){
                                $Student_Key=$copy_Student_Key;
                            }else{}


                            
                           /* if(($Student_Key=="-" and $DateLate=="-")){
                                $copy_Student_Key=$Student_Key;
                                $null_count=$null_count+1;
                            }else{
                                $null_count=$null_count+0;                               
                            }*/
                                
                            /*if(($Student_Key=="-" and $DateLate!="-")){
                                $Student_Key=$copy_Student_Key;
                            }else{}*/



                            
                                $AddFile_Student=new ManageDataSudentLate("add_time",$DateLate,$Student_Key,$user_login,$ssy_id,$ssy_date_start,$ssy_date_end);

                                    if(($AddFile_Student->Call_MDSL_Error()=="NoError")){
                                        $save_count=$save_count+1;
                                    }elseif(($AddFile_Student->Call_MDSL_Error()=="Error")){
                                        $duplicate_count=$duplicate_count+1;
                                    }else{
                                        $error_count=$error_count+1;
                                    }

                            $student_count=$student_count+1;