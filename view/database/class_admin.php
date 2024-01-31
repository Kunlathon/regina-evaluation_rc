

<?php

	class print_teacher_rc{
		public $key_rc;
		public $mynameTh,$mynameEn,$rc_key;
		function __construct($key_rc){
			$this->key_rc=$key_rc;
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_evaluation->call_pdodata();
					$teacher_sql="SELECT `IDTeacher`,`IDPrefix`,`FName`,`SName`,`IDPrefix_en`,`FName_en`,`SName_en` FROM `rc_person` WHERE `IDTeacher`='{$this->key_rc}'";
					if($teacher_rs=$pdo_eveluation->query($teacher_sql)){
						 $teacher_row=$teacher_rs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($teacher_row) && count($teacher_row)){
	//------------------------------------------------------------------------------
								$npTh_sql="SELECT `prefixname` FROM `rc_prefix` WHERE `IDPrefix`='{$teacher_row["IDPrefix"]}'";
									if($npTh_rs=$pdo_eveluation->query($npTh_sql)){
										 $npTh_row=$npTh_rs->Fetch(PDO::FETCH_ASSOC);
											if(is_array($npTh_row) && count($npTh_row)){
												$prefixTh=$npTh_row["prefixname"];
											}else{
												$prefixTh=null;
											}
									}else{
											$prefixTh=null;
									}
	//------------------------------------------------------------------------------
								$npEn_sql="SELECT `prefixname` FROM `rc_prefix` WHERE `IDPrefix`='{$teacher_row["IDPrefix_en"]}'";
									if($npEn_rs=$pdo_eveluation->query($npEn_sql)){
										 $npEn_row=$npEn_rs->Fetch(PDO::FETCH_ASSOC);
											if(is_array($npEn_row) && count($npEn_row)){
												$prefixEh=$npEn_row["prefixname"];
											}else{
												$prefixEh=null;
											}
									}else{
											$prefixEh=null;
									}
	//------------------------------------------------------------------------------

								$mynameTh=$prefixTh."&nbsp;".$teacher_row["FName"]."&nbsp;".$teacher_row["SName"];
								
								$mynameEn=strtolower($prefixEh."&nbsp;".$teacher_row["FName_en"]."&nbsp;".$teacher_row["SName_en"]);
								$mynameEn=ucfirst($mynameEn);
								
								$rc_key=$teacher_row["IDTeacher"];
								
							}else{
								$mynameTh=null;
								$mynameEn=null;
								$rc_key=null;
							}
					}else{
						$mynameTh=null;
						$mynameEn=null;
						$rc_key=null;
					}
					if(isset($mynameTh)){
						$this->mynameTh=$mynameTh;
						$this->mynameEn=$mynameEn;
						$this->rc_key=$rc_key;
					}else{
						//--------------------------------------------------------------------
					}
			$pdo_eveluation=null;
		}public function teacherRC_nameTh(){
			if(isset($this->mynameTh)){
				return $this->mynameTh;
			}else{
				//------------------------------------------------------------------------
			}
		}public function teacherRC_nameEn(){
			if(isset($this->mynameEn)){
				return $this->mynameEn;
			}else{
				//------------------------------------------------------------------------
			}
		}public function teacherRC_key(){
			if(isset($this->rc_key)){
				return $this->rc_key;
			}else{
				//------------------------------------------------------------------------
			}
		}
	}


	class LavaLClassAdmin{
		public $PL_key;
		public $LavaTh;
		function __construct($PL_key){
//-------------------------------------------------------------------------
			$this->PL_key=$PL_key;
//-------------------------------------------------------------------------		
			switch($this->PL_key){
				case 3:
					$LavaTh="อ.3";
				break;
				case 11:
					$LavaTh="ป.1";
				break;			
				case 12:
					$LavaTh="ป.2";
				break;				
				case 13:
					$LavaTh="ป.3";
				break;				
				case 21:
					$LavaTh="ป.4";
				break;				
				case 22:
					$LavaTh="ป.5";
				break;				
				case 23:
					$LavaTh="ป.6";
				break;				
				case 31:
					$LavaTh="ม.1";
				break;				
				case 32:
					$LavaTh="ม.2";
				break;				
				case 33:
					$LavaTh="ม.3";
				break;				
				case 41:
					$LavaTh="ม.4";
				break;				
				case 42:
					$LavaTh="ม.5";
				break;				
				case 43:
					$LavaTh="ม.6";
				break;
				default:
					$LavaTh=null;
			}
			if(isset($LavaTh)){
				$this->LavaTh=$LavaTh;
			}else{
				//--------------------
			}
		}function RunPrintLavaL(){
			if(isset($this->LavaTh)){
				return $this->LavaTh;
			}else{}
		}
	}

?>

<?php
class print_teacher{
	public $key_rc;
	public $mynameTh,$mynameEn;
	function __construct($key_rc){
		$this->key_rc=$key_rc;
		$db_evaluationID=$_SERVER['REMOTE_ADDR'];
		$connpdo_evaluation=new count_pdodata($db_evaluationID);
		$pdo_eveluation=$connpdo_evaluation->call_pdodata();
				try{
					$teacher_sql="SELECT `IDPrefix`,`FName`,`SName`,`IDPrefix_en`,`FName_en`,`SName_en` FROM `rc_person` WHERE `IDTeacher`='{$this->key_rc}'";
					if($teacher_rs=$pdo_eveluation->query($teacher_sql)){
						 $teacher_row=$teacher_rs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($teacher_row) && count($teacher_row)){
	//------------------------------------------------------------------------------
								$npTh_sql="SELECT `prefixname` FROM `rc_prefix` WHERE `IDPrefix`='{$teacher_row["IDPrefix"]}'";
									if($npTh_rs=$pdo_eveluation->query($npTh_sql)){
										 $npTh_row=$npTh_rs->Fetch(PDO::FETCH_ASSOC);
											if(is_array($npTh_row) && count($npTh_row)){
												$prefixTh=$npTh_row["prefixname"];
											}else{
												$prefixTh=null;
											}
									}else{
											$prefixTh=null;
									}
	//------------------------------------------------------------------------------
								$npEn_sql="SELECT `prefixname` FROM `rc_prefix` WHERE `IDPrefix`='{$teacher_row["IDPrefix_en"]}'";
									if($npEn_rs=$pdo_eveluation->query($npEn_sql)){
										 $npEn_row=$npEn_rs->Fetch(PDO::FETCH_ASSOC);
											if(is_array($npEn_row) && count($npEn_row)){
												$prefixEh=$npEn_row["prefixname"];
											}else{
												$prefixEh=null;
											}
									}else{
											$prefixEh=null;
									}
	//------------------------------------------------------------------------------

								$mynameTh=$prefixTh."&nbsp;".$teacher_row["FName"]."&nbsp;".$teacher_row["SName"];
								$mynameEn=strtolower($prefixEh."&nbsp;".$teacher_row["FName_en"]."&nbsp;".$teacher_row["SName_en"]);
								$mynameEn=ucwords($mynameEn);
							}else{
								$mynameTh=null;
								$mynameEn=null;
							}
					}else{
						$mynameTh=null;
						$mynameEn=null;
					}					
				}catch(PDOException $ca_rc){
					$mynameTh=null;
					$mynameEn=null;					
				}
					if(isset($mynameTh)){
						$this->mynameTh=$mynameTh;
						$this->mynameEn=$mynameEn;
					}else{
						//--------------------------------------------------------------------
					}
		$pdo_eveluation=null;
	}public function teacher_nameTh(){
		if(isset($this->mynameTh)){
			return $this->mynameTh;
		}else{
			//------------------------------------------------------------------------
		}
	}public function teacher_nameEn(){
		if(isset($this->mynameEn)){
			return $this->mynameEn;
		}else{
			//------------------------------------------------------------------------
		}
	}
}
?>

<?php
	class link_img{
		public $imglink;
		function __construct($imglink){
			$this->imglink=$imglink;

				if(file_exists("../all/$this->imglink.JPG")){
					$user_img="view/all/$this->imglink.JPG";
				}else{
					if(file_exists("../all/$this->imglink.jpg")){
						$user_img="view/all/$this->imglink.jpg";
					}else{
						$user_img="view/all/newimg_rc.jpg";
					}
				}
			$this->user_img=$user_img;

		}
	}




?>

<?php
	class price_datapay{
		public $pd_sud,$pd_class,$pd_year;
		public $pap_nopay,$datapay;
		function __construct($pd_sud,$pd_class,$pd_year){
			$this->pd_sud=$pd_sud;
			$this->pd_class=$pd_class;
			$this->pd_year=$pd_year;
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();
			$datapaySql="SELECT `pap_nopay`
						 FROM `price_datapay`
						 WHERE `pap_stu`='{$this->pd_sud}'
						 and `pap_l`='{$this->pd_class}'
						 and `pap_y`='{$this->pd_year}'";
				if($datapayRs=$pdo_evaluation->query($datapaySql)){
					$datapayRow=$datapayRs->Fetch(PDO::FETCH_ASSOC);
					$pap_nopay=$datapayRow["pap_nopay"];
					$datapay="H";
				}else{
					$pap_nopay=Null;
					$datapay="NH";
				}
					if(isset($pap_nopay,$datapay)){
						$this->pap_nopay=$pap_nopay;
						$this->datapay=$datapay;
					}else{
						//--------------------------
					}
			$pdo_evaluation=Null;
		}public function print_pap_nopay(){
			if(isset($this->pap_nopay)){
				return $this->pap_nopay;
			}else{
				//--------------------------
			}
		}public function print_datapay(){
			if(isset($this->datapay)){
				return $this->datapay;
			}else{
				//--------------------------
			}
		}
	}
?>
<?php
	class pay_bookall{
		public $txt_year,$txt_status;
		public $pay_bookarray;
		function __construct($txt_year,$txt_status){
			$this->txt_year=$txt_year;
			$this->txt_status=$txt_status;
			$pay_bookarray=array();
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();

			$pay_bookallSql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`rc_prefix`.`prefix_SName`
						   ,`regina_stu_data`.`rsd_name`,`regina_stu_data`.`rsd_surname`
							 from `price_stu` join `regina_stu_data` on(`price_stu`.`ps_key`=`regina_stu_data`.`rsd_studentid`)
							 join `rc_prefix` on (`regina_stu_data`.`rsd_prefix`=`rc_prefix`.`IDPrefix`)
						     WHERE `price_stu`.`ps_year`='{$this->txt_year}'
							 and `price_stu`.`ps_status`='{$this->txt_status}'";
				if($pay_bookallRs=$pdo_evaluation->query($pay_bookallSql)){
					while($pay_bookallRow=$pay_bookallRs->Fetch(PDO::FETCH_ASSOC)){
						$pay_bookarray[]=$pay_bookallRow;
					}
				}else{
					$pay_bookarray[]=Null;
				}
					if(isset($pay_bookarray)){
						$this->pay_bookarray=$pay_bookarray;
					}else{
						//---------------------------------
					}
			$pdo_evaluation=Null;
		}public function print_paysud_bookall(){
			if(isset($this->pay_bookarray)){
				return $this->pay_bookarray;
			}else{
				//--------------------------
			}
		}
	}

?>

<?php
	class offonbook{
		public $txt_year;
		public $po_status;
		function __construct($txt_year){
			$this->txt_year=$txt_year;
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();

			$offonbookSql="SELECT `po_status` FROM `price_offon` WHERE `po_year`='{$this->txt_year}'";
			 if($offonbookRs=$pdo_evaluation->query($offonbookSql)){
				$offonbookRow=$offonbookRs->Fetch(PDO::FETCH_ASSOC);
				$po_status=$offonbookRow["po_status"];
			 }else{
				$po_status=Null;
			 }
				if(isset($po_status)){
					$this->po_status=$po_status;
				}else{
					//-------------------------
				}
			$pdo_evaluation=Null;
		}public function bookoffon(){
			if(isset($this->po_status)){
				return $this->po_status;
			}else{
				//----------------------
			}
		}
	}
?>

<?php
	class payrc_book{
		public $txt_year,$txt_sud;
		public $ps_id,$ps_txt;
		function __construct($txt_year,$txt_sud){
			$this->txt_year=$txt_year;
			$this->txt_sud=$txt_sud;
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();

			$payrc_sql="select `price_status`.`ps_id`,`price_status`.`ps_txt`
					    from `price_stu`
						join `price_status`
						on (`price_stu`.`ps_status`=`price_status`.`ps_id`)
						where `price_stu`.`ps_key`='{$this->txt_sud}'
						and `price_stu`.`ps_year`='{$this->txt_year}';";
				if($payrc_Rs=$pdo_evaluation->query($payrc_sql)){
					$payrc_Row=$payrc_Rs->Fetch(PDO::FETCH_ASSOC);
					$ps_id=$payrc_Row["ps_id"];
					$ps_txt=$payrc_Row["ps_txt"];
				}else{
					$ps_id=null;
					$ps_txt=null;
				}
					if(isset($ps_id,$ps_txt)){
						$this->ps_id=$ps_id;
						$this->ps_txt=$ps_txt;
					}else{
						//--------------------
					}
			$pdo_evaluation=Null;
		}function __destruct(){
			if(isset($this->ps_id,$this->ps_txt)){
				$this->ps_id;
				$this->ps_txt;
			}else{
				//-----------
			}
		}
	}
?>

<?php
	class int_idcount{
		public $txt_intid;
		public $count_key;
		function __construct($txt_intid){
			$this->txt_intid=$txt_intid;
				if($this->txt_intid<=9){
					$count_key="000".$this->txt_intid;
				}elseif($this->txt_intid<=99){
					$count_key="00".$this->txt_intid;
				}elseif($this->txt_intid<=999){
					$count_key="0".$this->txt_intid;
				}else{
					$count_key=$this->txt_intid;
				}
					if(isset($count_key)){
						$this->count_key=$count_key;
					}else{
						//-------------------------
					}
		}public function print_count_key(){
			if(isset($this->count_key)){
				return $this->count_key;
			}else{
				//---------------------------------
			}
		}
	}
?>

<?php
	class set_age{
		public $use_dateuse;
		function __construct($use_dateuse){
			$this->use_dateuse=$use_dateuse;
			$txt_dateuse=date($this->use_dateuse);
			$txt_datesystem=date("Y-m-d");
				if(isset($txt_dateuse)){
				//txt_dateuse
					$txt_dateuseY=date("Y",strtotime($txt_dateuse));
					$txt_dateuseM=date("m",strtotime($txt_dateuse));
					$txt_dateuseD=date("d",strtotime($txt_dateuse));
				//txt_dateuse
				//txt_datesystem
					$txt_datesystemY=date("Y",strtotime($txt_datesystem));
					$txt_datesystemM=date("m",strtotime($txt_datesystem));
					$txt_datasystemD=date("d",strtotime($txt_datesystem));
				//txt_datesystem
						if($txt_dateuseM==$txt_datesystemM){
							if($txt_dateuseM>=$txt_datesystemM){
								if($txt_datasystemD>=$txt_dateuseD){
									$age=$txt_datesystemY-$txt_dateuseY;
								}else{
									$age=($txt_datesystemY-$txt_dateuseY)-1;
								}
							}else{
								$age=($txt_datesystemY-$txt_dateuseY)-1;
							}
						}else{
							if($txt_datesystemM>=$txt_dateuseM){
								$age=$txt_datesystemY-$txt_dateuseY;
							}else{
								$age=($txt_datesystemY-$txt_dateuseY)-1;
							}
						}
				}else{
					$age=0;
				}
					if(isset($age)){
						$this->age=$age;
					}else{
						//--------------
					}
		}public function print_set_age(){
			if(isset($this->age)){
				return $this->age;
			}else{
				//----------------------
			}
		}
	}
?>
<?php
	//books_stu
	class books_stu{
		public $book_levelnew;
		public $book_plan;
		function __construct($book_levelnew,$book_plan){
			$this->book_levelnew=$book_levelnew;
			$this->book_plan=$book_plan;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();

			$booksSql="SELECT `pob_price` FROM `price_of_books` WHERE `pob_levelnew`='{$this->book_levelnew}' and `pob_plan`='{$this->book_plan}'";
				if($booksRs=$pdo_evaluation->query($booksSql)){
					$booksRow=$booksRs->Fetch(PDO::FETCH_ASSOC);
					$pob_price=$booksRow["pob_price"];
				}else{
					$pob_price=null;
				}
					if(isset($pob_price)){
						$this->pob_price=$pob_price;
					}else{
						//-------------------------
					}
			$pdo_evaluation=Null;
		}public function print_bookprice(){
			if(isset($this->pob_price)){
				return $this->pob_price;
			}else{
				//---------------------
			}
		}
	}

?>
<?php
	//static_stuRc
		class  static_stuRC{
			public $ssrc_t;
			public $ssrc_y;
			public $ssrc_c;
			public $ssrc_s;

			function __construct($ssrc_t,$ssrc_y,$ssrc_c,$ssrc_s){
				$this->ssrc_t=$ssrc_t;
				$this->ssrc_y=$ssrc_y;
				$this->ssrc_c=$ssrc_c;
				$this->ssrc_s=$ssrc_s;

				$db_evaluationID=$_SERVER['REMOTE_ADDR'];
				$connpdo_evaluation=new count_pdodata($db_evaluationID);
				$pdo_evaluation=$connpdo_evaluation->call_pdodata();

				$staticRcSql="SELECT count(`rsd_studentid`) as `count_stu`
							  FROM `regina_stu_class`
							  WHERE `rsc_year`='{$this->ssrc_y}'
							  and `rsc_term`='{$this->ssrc_t}'
							  and `rsc_class`='{$this->ssrc_c}'
							  and `rsc_status`='{$this->ssrc_s}'";
				if($staticRcRs=$pdo_evaluation->query($staticRcSql)){
					$staticRcRow=$staticRcRs->Fetch(PDO::FETCH_ASSOC);
					$count_stu=$staticRcRow["count_stu"];
				}else{
					$count_stu=0;
				}
				$this->count_stu=$count_stu;
				$pdo_evaluation=Null;
			}
			public function print_static(){
				return $this->count_stu;
			}
		}

?>

<?php
	class sturc_statustxt{
		public $status_txt;
		function __construct($status_txt){
			$this->status_txt=$status_txt;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();

			$sturc_statusSql="SELECT `IDStatus`
						      FROM `rc_student_status`
							  WHERE `Name`='{$this->status_txt}'";
			if($sturc_statusRs=$pdo_evaluation->query($sturc_statusSql)){
				$sturc_statusRow=$sturc_statusRs->Fetch(PDO::FETCH_ASSOC);
				$IDStatus=$sturc_statusRow["IDStatus"];
			}else{
				$IDStatus=null;
			}if(isset($IDStatus)){
				$this->IDStatus=$IDStatus;
			}else{
				//---------------------------
			}
			$pdo_evaluation=Null;
		}public function print_statustxt(){
			if(isset($this->IDStatus)){
				return $this->IDStatus;
			}else{
				//---------------------
			}
		}
	}
?>


<?php
	class sturc_statusid{
		public $status_id;
		function __construct($status_id){
			$this->status_id=$status_id;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();

			$sturc_statusSql="SELECT `Name`
						      FROM `rc_student_status`
							  WHERE `IDStatus`='{$this->status_id}'";
			if($sturc_statusRs=$pdo_evaluation->query($sturc_statusSql)){
				$sturc_statusRow=$sturc_statusRs->Fetch(PDO::FETCH_ASSOC);
				$NameStatus=$sturc_statusRow["Name"];
			}else{
				$NameStatus=null;
			}if(isset($NameStatus)){
				$this->NameStatus=$NameStatus;
			}else{
				//---------------------------
			}
			$pdo_evaluation=Null;
		}public function print_statusName(){
			if(isset($this->NameStatus)){
				return $this->NameStatus;
			}else{
				//---------------------
			}
		}
	}
?>






<?php
	//static_stuRc
		class  static_stuRCcolor{
			public $ssrc_t,$ssrc_y,$ssrc_c,$ssrc_s,$ssrc_h;
			public $count_stu;

			function __construct($ssrc_t,$ssrc_y,$ssrc_c,$ssrc_s,$ssrc_h){
				$this->ssrc_t=$ssrc_t;
				$this->ssrc_y=$ssrc_y;
				$this->ssrc_c=$ssrc_c;
				$this->ssrc_s=$ssrc_s;
				$this->ssrc_h=$ssrc_h;

				$db_evaluationID=$_SERVER['REMOTE_ADDR'];
				$connpdo_evaluation=new count_pdodata($db_evaluationID);
				$pdo_evaluation=$connpdo_evaluation->call_pdodata();

				$staticRcSql="select count(`regina_stu_data`.`rsd_studentid`) as `count_stu`
							  from  `regina_stu_data` join `regina_stu_class` on(`regina_stu_data`.`rsd_studentid`=`regina_stu_class`.`rsd_studentid`)
							  Where  `regina_stu_data`.`rse_student_status`='{$this->ssrc_s}'
							  and `regina_stu_data`.`rse_home`='{$this->ssrc_h}'
							  and `regina_stu_class`.`rsc_year`='{$this->ssrc_y}'
							  and `regina_stu_class`.`rsc_term`='{$this->ssrc_t}'
							  and `regina_stu_class`.`rsc_class`='{$this->ssrc_c}'";
				if($staticRcRs=$pdo_evaluation->query($staticRcSql)){
					$staticRcRow=$staticRcRs->Fetch(PDO::FETCH_ASSOC);
					$count_stu=$staticRcRow["count_stu"];
				}else{
					$count_stu=0;
				}
				$this->count_stu=$count_stu;
				$pdo_evaluation=Null;
			}
			public function print_static_color(){
				return $this->count_stu;
			}
		}

?>

<?php

//regina_stu_data
	class regina_stu_data2{
		public $stu_id;
		public $stu_year;
		public $stu_term;
		public $stu_class;

		function __construct($stu_id,$stu_year,$stu_term,$stu_class){
			$this->stu_id=$stu_id;
			$this->stu_year=$stu_year;
			$this->stu_term=$stu_term;
			$this->stu_class=$stu_class;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();


			$regina_stu_dataSql="SELECT  `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`regina_stu_data`.`rsd_prefix`,`regina_stu_data`.`rsd_name`,`regina_stu_data`.`rsd_surname`
						       ,LOWER(`regina_stu_data`.`rsd_nameEn`) AS `rsd_nameEn`, LOWER(`regina_stu_data`.`rsd_surnameEn`) AS `red_surnameEn`,LOWER(`regina_stu_data`.`nickTh`) AS `nickTh`,LOWER(`regina_stu_data`.`nickEn`) AS `nickEn`, `regina_stu_data`.`rse_student_status`
                               ,`regina_stu_data`.`rse_studentimg`,`regina_stu_data`.`rse_home`,`regina_stu_class`.`rsc_year`,`regina_stu_class`.`rsc_term`,`regina_stu_class`.`rsc_plan`
                               ,`regina_stu_class`.`rsc_class`,`regina_stu_class`.`rsc_room`,`regina_stu_class`.`rsc_num`,`rc_prefix`.`prefixname`,`rc_prefix`.`prefix_SName`,`rc_level`.`Sort_name`,`rc_level`.`Lname`
                                 FROM `regina_stu_data` join `regina_stu_class` on(`regina_stu_data`.`rsd_studentid`=`regina_stu_class`.`rsd_studentid`)
                                 join `rc_prefix` on(`regina_stu_data`.`rsd_prefix`=`rc_prefix`.`IDPrefix`)
                                 join `rc_level`  on(`regina_stu_class`.`rsc_class`=`rc_level`.`IDLevel`)
                                 WHERE `regina_stu_data`.`rsd_studentid`='{$this->stu_id}'
                                 and `regina_stu_class`.`rsc_year`='{$this->stu_year}'
                                 and `regina_stu_class`.`rsc_term`='{$this->stu_term}'
                                 and `regina_stu_class`.`rsc_class`='{$this->stu_class}';";
			if($regina_stu_dataRs=$pdo_evaluation->query($regina_stu_dataSql)){
				$regina_stu_dataRow=$regina_stu_dataRs->Fetch(PDO::FETCH_ASSOC);
					if(is_array($regina_stu_dataRow) && count($regina_stu_dataRow)){
						$rsd_studentid=$regina_stu_dataRow["rsd_studentid"];
						$rsd_Identification=$regina_stu_dataRow["rsd_Identification"];
						$sd_prefix=$regina_stu_dataRow["rsd_prefix"];
						$rsd_name=$regina_stu_dataRow["rsd_name"];
						$rsd_surname=$regina_stu_dataRow["rsd_surname"];
						$Sort_name=$regina_stu_dataRow["Sort_name"];
						$rsc_num=$regina_stu_dataRow["rsc_num"];
						$rsc_room=$regina_stu_dataRow["rsc_room"];
						$rsc_class=$regina_stu_dataRow["rsc_class"];
					}else{
						$rsd_studentid=null;
						$rsd_Identification=null;
						$sd_prefix=null;
						$rsd_name=null;
						$rsd_surname=null;
						$rsc_num=null;
						$rsc_room=null;
						$Sort_name=null;
						$rsc_class=null;						
					}				
			}else{
				$rsd_studentid=null;
				$rsd_Identification=null;
				$sd_prefix=null;
				$rsd_name=null;
				$rsd_surname=null;
				$rsc_num=null;
				$rsc_room=null;
				$Sort_name=null;
				$rsc_class=null;
			}
			$this->rsd_studentid=$rsd_studentid;
			$this->rsd_Identification=$rsd_Identification;
			$this->sd_prefix=$sd_prefix;
			$this->rsd_name=$rsd_name;
			$this->rsd_surname=$rsd_surname;
			$this->rsc_num=$rsc_num;
			$this->rsc_room=$rsc_room;
			$this->Sort_name=$Sort_name;
			$this->rsc_class=$rsc_class;
			$pdo_evaluation=Null;
		}function __destruct(){
			$this->rsd_studentid;
			$this->rsd_Identification;
			$this->sd_prefix;
			$this->rsd_name;
			$this->rsd_surname;
			$this->rsc_num;
			$this->rsc_room;
			$this->Sort_name;
			$this->rsc_class;
		}
	}

//regina_stu_data
	class regina_stu_data3{
		public $stu_id;
		public $stu_year;
		public $stu_term;
		public $stu_class;

		function __construct($stu_id,$stu_year,$stu_term,$stu_class){
			$this->stu_id=$stu_id;
			$this->stu_year=$stu_year;
			$this->stu_term=$stu_term;
			$this->stu_class=$stu_class;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();


			$regina_stu_dataSql="SELECT  `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`regina_stu_data`.`rsd_prefix`,`regina_stu_data`.`rsd_name`,`regina_stu_data`.`rsd_surname`
						       ,LOWER(`regina_stu_data`.`rsd_nameEn`) AS `rsd_nameEn`,LOWER(`regina_stu_data`.`rsd_surnameEn`) AS `rsd_surnameEn`,LOWER(`regina_stu_data`.`nickTh`) AS `nickTh`,LOWER(`regina_stu_data`.`nickEn`) AS `nickEn`, `regina_stu_data`.`rse_student_status`
                               ,`regina_stu_data`.`rse_studentimg`,`regina_stu_data`.`rse_home`,`regina_stu_class`.`rsc_year`,`regina_stu_class`.`rsc_term`,`regina_stu_class`.`rsc_plan`
                               ,`regina_stu_class`.`rsc_class`,`regina_stu_class`.`rsc_room`,`regina_stu_class`.`rsc_num`,`rc_prefix`.`prefixname`,`rc_prefix`.`prefix_SName`,`rc_level`.`Sort_name`,`rc_level`.`Lname`
                                 FROM `regina_stu_data` join `regina_stu_class` on(`regina_stu_data`.`rsd_studentid`=`regina_stu_class`.`rsd_studentid`)
                                 join `rc_prefix` on(`regina_stu_data`.`rsd_prefix`=`rc_prefix`.`IDPrefix`)
                                 join `rc_level`  on(`regina_stu_class`.`rsc_class`=`rc_level`.`IDLevel`)
                                 WHERE `regina_stu_data`.`rsd_studentid`='{$this->stu_id}'
                                 and `regina_stu_class`.`rsc_year`='{$this->stu_year}'
                                 and `regina_stu_class`.`rsc_term`='{$this->stu_term}'
                                 and `regina_stu_class`.`rsc_class`='{$this->stu_class}'
								 and `regina_stu_class`.`rsc_status`='1';";
			if($regina_stu_dataRs=$pdo_evaluation->query($regina_stu_dataSql)){
				$regina_stu_dataRow=$regina_stu_dataRs->Fetch(PDO::FETCH_ASSOC);
				$rsd_studentid=$regina_stu_dataRow["rsd_studentid"];
				$rsd_Identification=$regina_stu_dataRow["rsd_Identification"];
				$sd_prefix=$regina_stu_dataRow["rsd_prefix"];
				$rsd_name=$regina_stu_dataRow["rsd_name"];
				$rsd_surname=$regina_stu_dataRow["rsd_surname"];
				$Sort_name=$regina_stu_dataRow["Sort_name"];
				$rsc_num=$regina_stu_dataRow["rsc_num"];
				$rsc_room=$regina_stu_dataRow["rsc_room"];
			}else{
				$rsd_studentid="";
				$rsd_Identification="";
				$sd_prefix="";
				$rsd_name="";
				$rsd_surname="";
				$rsc_num="";
				$rsc_room="";
				$Sort_name="";
			}
			$this->rsd_studentid=$rsd_studentid;
			$this->rsd_Identification=$rsd_Identification;
			$this->sd_prefix=$sd_prefix;
			$this->rsd_name=$rsd_name;
			$this->rsd_surname=$rsd_surname;
			$this->rsc_num=$rsc_num;
			$this->rsc_room=$rsc_room;
			$this->Sort_name=$Sort_name;
			$pdo_evaluation=Null;
		}function __destruct(){
			$this->rsd_studentid;
			$this->rsd_Identification;
			$this->sd_prefix;
			$this->rsd_name;
			$this->rsd_surname;
			$this->rsc_num;
			$this->rsc_room;
			$this->Sort_name;
		}
	}


	class regina_stu_data4{
		public $stu_id;
		public $stu_year;
		public $stu_term;
		//public $stu_class;

		function __construct($stu_id,$stu_year,$stu_term){
			$this->stu_id=$stu_id;
			$this->stu_year=$stu_year;
			$this->stu_term=$stu_term;
			//$this->stu_class=$stu_class;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();


			$regina_stu_dataSql="SELECT  `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`regina_stu_data`.`rsd_prefix`,`regina_stu_data`.`rsd_name`,`regina_stu_data`.`rsd_surname`
						       ,LOWER(`regina_stu_data`.`rsd_nameEn`) AS `rsd_nameEn`,LOWER(`regina_stu_data`.`rsd_surnameEn`) AS `rsd_surnameEn`,LOWER(`regina_stu_data`.`nickTh`) AS `nickTh`,LOWER(`regina_stu_data`.`nickEn`) AS `nickEn`, `regina_stu_data`.`rse_student_status`
                               ,`regina_stu_data`.`rse_studentimg`,`regina_stu_data`.`rse_home`,`regina_stu_class`.`rsc_year`,`regina_stu_class`.`rsc_term`,`regina_stu_class`.`rsc_plan`
                               ,`regina_stu_class`.`rsc_class`,`regina_stu_class`.`rsc_room`,`regina_stu_class`.`rsc_num`,`rc_prefix`.`prefixname`,`rc_prefix`.`prefix_SName`,`rc_level`.`Sort_name`,`rc_level`.`Lname`
                                 FROM `regina_stu_data` join `regina_stu_class` on(`regina_stu_data`.`rsd_studentid`=`regina_stu_class`.`rsd_studentid`)
                                 join `rc_prefix` on(`regina_stu_data`.`rsd_prefix`=`rc_prefix`.`IDPrefix`)
                                 join `rc_level`  on(`regina_stu_class`.`rsc_class`=`rc_level`.`IDLevel`)
                                 WHERE `regina_stu_data`.`rsd_studentid`='{$this->stu_id}'
                                 and `regina_stu_class`.`rsc_year`='{$this->stu_year}'
                                 and `regina_stu_class`.`rsc_term`='{$this->stu_term}'
								 and `regina_stu_class`.`rsc_status`='1';";
			if($regina_stu_dataRs=$pdo_evaluation->query($regina_stu_dataSql)){
				$regina_stu_dataRow=$regina_stu_dataRs->Fetch(PDO::FETCH_ASSOC);
				$rsd_studentid=$regina_stu_dataRow["rsd_studentid"];
				$rsd_Identification=$regina_stu_dataRow["rsd_Identification"];
				$sd_prefix=$regina_stu_dataRow["rsd_prefix"];
				$rsd_name=$regina_stu_dataRow["rsd_name"];
				$rsd_surname=$regina_stu_dataRow["rsd_surname"];
				$Sort_name=$regina_stu_dataRow["Sort_name"];
				$rsc_num=$regina_stu_dataRow["rsc_num"];
				$rsc_room=$regina_stu_dataRow["rsc_room"];
				$rsc_class=$regina_stu_dataRow["rsc_class"];
			}else{
				$rsd_studentid="";
				$rsd_Identification="";
				$sd_prefix="";
				$rsd_name="";
				$rsd_surname="";
				$rsc_num="";
				$rsc_room="";
				$Sort_name="";
				$rsc_class="";
			}
			$this->rsd_studentid=$rsd_studentid;
			$this->rsd_Identification=$rsd_Identification;
			$this->sd_prefix=$sd_prefix;
			$this->rsd_name=$rsd_name;
			$this->rsd_surname=$rsd_surname;
			$this->rsc_num=$rsc_num;
			$this->rsc_room=$rsc_room;
			$this->Sort_name=$Sort_name;
			$this->rsc_class=$rsc_class;
			$pdo_evaluation=Null;
		}function __destruct(){
			$this->rsd_studentid;
			$this->rsd_Identification;
			$this->sd_prefix;
			$this->rsd_name;
			$this->rsd_surname;
			$this->rsc_num;
			$this->rsc_room;
			$this->Sort_name;
			$this->rsc_class;
		}
	}

//regina_stu_data
	class regina_stu_data{
		public $stu_id;
		public $rsd_studentid,$rsd_Identification,$sd_prefix,$rsd_name,$rsd_surname;
		function __construct($stu_id){
			$this->stu_id=$stu_id;
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();
			$regina_stu_dataSql="SELECT `rsd_studentid`, `rsd_Identification`, `rsd_prefix`, `rsd_name`, `rsd_surname`, LOWER(`rsd_nameEn`) AS `rsd_nameEn`, LOWER(`rsd_surnameEn`) AS `rsd_surnameEn`,`rse_student_status`, `rse_studentimg`, `rse_home`
								 FROM `regina_stu_data` WHERE`rsd_studentid`='{$this->stu_id}'";
			if($regina_stu_dataRs=$pdo_evaluation->query($regina_stu_dataSql)){
				$regina_stu_dataRow=$regina_stu_dataRs->Fetch(PDO::FETCH_ASSOC);
					if(isset($regina_stu_dataRow["rsd_studentid"])){
						$rsd_studentid=$regina_stu_dataRow["rsd_studentid"];
						$rsd_Identification=$regina_stu_dataRow["rsd_Identification"];
						$sd_prefix=$regina_stu_dataRow["rsd_prefix"];
						$rsd_name=$regina_stu_dataRow["rsd_name"];
						$rsd_surname=$regina_stu_dataRow["rsd_surname"];
					}else{
						$rsd_studentid=null;
						$rsd_Identification=null;
						$sd_prefix=null;
						$rsd_name=null;
						$rsd_surname=null;
					}
			}else{
				$rsd_studentid=null;
				$rsd_Identification=null;
				$sd_prefix=null;
				$rsd_name=null;
				$rsd_surname=null;
			}
				if(isset($rsd_studentid)){
					$this->rsd_studentid=$rsd_studentid;
					$this->rsd_Identification=$rsd_Identification;
					$this->sd_prefix=$sd_prefix;
					$this->rsd_name=$rsd_name;
					$this->rsd_surname=$rsd_surname;
				}else{
					//--------------------------------------------
				}
			$pdo_evaluation=Null;
		}function __destruct(){
			if(isset($this->rsd_studentid)){
				$this->rsd_studentid;
				$this->rsd_Identification;
				$this->sd_prefix;
				$this->rsd_name;
				$this->rsd_surname;
			}else{ 
				//-----------------------------------------------
			}
		}
	}


//stu_level
	class stu_levelpdo{
		public $stu_id,$stu_year,$stu_term;
		public $rsd_studentid,$IDLevel,$Sort_name,$Lname,$planname,$rsc_room,$rsc_num,$rc_plan;

		function __construct($stu_id,$stu_year,$stu_term){
			$this->stu_id=$stu_id;
			$this->stu_year=$stu_year;
			$this->stu_term=$stu_term;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_evaluation=$connpdo_evaluation->call_pdodata();


			$stu_levelsql="select `regina_stu_class`.`rsd_studentid`,`rc_level`.`IDLevel`,`rc_level`.`Sort_name`,`rc_level`.`Lname`
						 ,`rc_plan`.`Name`as `planname`,`regina_stu_class`.`rsc_room`,`regina_stu_class`.`rsc_num`,`regina_stu_class`.`rsc_plan`
						   from `regina_stu_class` join `rc_level` on(`rc_level`.`IDLevel`=`regina_stu_class`.`rsc_class`)
						   join `rc_plan` on(`regina_stu_class`.`rsc_plan`=`rc_plan`.`IDPlan`)
						   where `regina_stu_class`.`rsc_year`='{$this->stu_year}'
						   and `regina_stu_class`.`rsc_term`='{$this->stu_term}'
						   and `regina_stu_class`.`rsd_studentid`='{$this->stu_id}'";
			if($stu_levelRs=$pdo_evaluation->query($stu_levelsql)){
				$stu_levelRow=$stu_levelRs->Fetch(PDO::FETCH_ASSOC);
				$this->rsd_studentid=$stu_levelRow["rsd_studentid"];
				$this->IDLevel=$stu_levelRow["IDLevel"];
				$this->Sort_name=$stu_levelRow["Sort_name"];
				$this->Lname=$stu_levelRow["Lname"];
				$this->planname=$stu_levelRow["planname"];
				$this->rsc_room=$stu_levelRow["rsc_room"];
				$this->rsc_num=$stu_levelRow["rsc_num"];
				$this->rc_plan=$stu_levelRow["rsc_plan"];
			}else{
				$this->rsd_studentid=null;
				$this->IDLevel=null;
				$this->Sort_name=null;
				$this->Lname=null;
				$this->planname=null;
				$this->rsc_room=null;
				$this->rsc_num=null;
				$this->rc_plan=null;
			}
			$pdo_evaluation=Null;
		}	function __destruct(){
			$this->rsd_studentid;
			$this->IDLevel;
			$this->Sort_name;
			$this->Lname;
			$this->planname;
			$this->rsc_room;
			$this->rsc_num;
			$this->rc_plan;
		} 

	}

//stu_level End

	class insert_datastupdo{
		public $evaluation_sql;
		public $system_insert;
		function __construct($evaluation_sql){
			$this->evaluation_sql=$evaluation_sql;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();

			$sql=$this->evaluation_sql;
			if($pdo_eveluation->exec($sql)>0){
				$system_insert="yes";
			}else{
				$system_insert="no";
			}
			unset($pdo_eveluation);
			$this->system_insert=$system_insert;
		}
		function __destruct(){
			$this->system_insert;
		}

	}


//print_prefix->pdo
	class print_prefix{
		public $prefix;
		public $prefix_prefixname,$prefix_prefix_SName,$prefix_prefix_EName;
		function __construct($prefix){
			$this->prefix=$prefix;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();


			$prefix_sql="SELECT `prefixname`,`prefix_SName`,`prefix_EName` FROM `rc_prefix` WHERE `IDPrefix`='{$this->prefix}'";
			if($prefix_rs=$pdo_eveluation->query($prefix_sql)){
				$prefix_row=$prefix_rs->Fetch(PDO::FETCH_ASSOC);
				if(is_array($prefix_row) && count($prefix_row)){
					$prefix_prefixname=$prefix_row["prefixname"];
					$prefix_prefix_SName=$prefix_row["prefix_SName"];
					$prefix_prefix_EName=strtolower($prefix_row["prefix_EName"]);
					$prefix_prefix_EName=ucwords($prefix_prefix_EName);					
				}else{
					$prefix_prefixname=null;
					$prefix_prefix_SName=null;
					$prefix_prefix_EName=null;					
				}
			}else{
				$prefix_prefixname=null;
				$prefix_prefix_SName=null;
				$prefix_prefix_EName=null;
			}
			
			if(isset($prefix_prefixname)){
				$this->prefix_prefixname=$prefix_prefixname;
				$this->prefix_prefix_SName=$prefix_prefix_SName;
				$this->prefix_prefix_EName=$prefix_prefix_EName;
				$pdo_eveluation=Null;				
			}else{
				$pdo_eveluation=Null;
			}
		}
		function __destruct(){
			if(isset($this->prefix_prefixname)){
				$this->prefix_prefixname;
				$this->prefix_prefix_SName;
				$this->prefix_prefix_EName;				
			}else{
//----------------------------------------------------------------------------				
			} 
		}
	}



//data_sturoom->pdo
	class data_stuall{
		public $sr_t,$sr_y,$sr_lA,$sr_lB;
		public $printdata_stuall;
		//public $sr_r;
		function __construct($sr_t,$sr_y,$sr_lA,$sr_lB){
			$this->sr_t=$sr_t;
			$this->sr_y=$sr_y;
			$this->sr_lA=$sr_lA;
			$this->sr_lB=$sr_lB;
			//$this->sr_r=$sr_r;
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();

			$printdata_stuall=array();
			$sturoom_sql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`regina_stu_data`.`rsd_prefix` ,`regina_stu_data`.`rsd_name`
						,`regina_stu_data`.`rsd_surname`,LOWER(`regina_stu_data`.`rsd_nameEn`) AS `rsd_nameEn`,LOWER(`regina_stu_data`.`rsd_surnameEn`) AS `rsd_surnameEn` ,LOWER(`regina_stu_data`.`nickTh`) AS `nickTh` ,LOWER(`regina_stu_data`.`nickEn`) AS `nickEn` ,`regina_stu_class`.`rsc_year`
						,`regina_stu_class`.`rsc_term`,`regina_stu_class`.`rsc_plan`,`regina_stu_class`.`rsc_class` ,`regina_stu_class`.`rsc_room`,`regina_stu_class`.`rsc_txt`
						,`regina_stu_class`.`rsc_num`,`regina_stu_data`.`rse_home` from `regina_stu_class` join `regina_stu_data` on(`regina_stu_class`.`rsd_studentid`=`regina_stu_data`.`rsd_studentid`)
						where `regina_stu_class`.`rsc_term`='{$this->sr_t}'
						and `regina_stu_class`.`rsc_year`='{$this->sr_y}'
						and `regina_stu_class`.`rsc_class`>='{$this->sr_lA}'  and  `regina_stu_class`.`rsc_class`<='{$this->sr_lB}'
						ORDER BY `regina_stu_class`.`rsc_num` ASC";
			if($sturoom_rs=$pdo_eveluation->query($sturoom_sql)){
				while($sturoom_row=$sturoom_rs->Fetch(PDO::FETCH_ASSOC)){
					$printdata_stuall[]=$sturoom_row;
				}
			}else{

			}
			$pdo_eveluation=Null;
			$this->printdata_stuall=$printdata_stuall;
		}
		function __destruct(){
			$this->printdata_stuall;
		}
	}






//data_regina_stu_class
	class regina_stu_class{
		public $rsc_stuId,$rsc_t,$rsc_y,$rsc_l;
		public $student_statusTxt;
		function __construct($rsc_stuId,$rsc_t,$rsc_y,$rsc_l){
			$this->rsc_stuId=$rsc_stuId;
			$this->rsc_t=$rsc_t;
			$this->rsc_y=$rsc_y;
			$this->rsc_l=$rsc_l;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();

			$regina_stu_classSql="select `rc_student_status`.`Name` as `student_statusTxt`
								  from `regina_stu_class`
								  join  `rc_student_status` on (`regina_stu_class`.`rsc_status`=`rc_student_status`.`IDStatus`)
								  where `regina_stu_class`.`rsc_year`='{$this->rsc_y}'
								  and  `regina_stu_class`.`rsc_term`='{$this->rsc_t}'
								  and `regina_stu_class`.`rsc_class`='{$this->rsc_l}'
								  and `regina_stu_class`.`rsd_studentid`='{$this->rsc_stuId}';";
			if($regina_stu_classRs=$pdo_eveluation->query($regina_stu_classSql)){
				$regina_stu_classRow=$regina_stu_classRs->Fetch(PDO::FETCH_ASSOC);
				$student_statusTxt=$regina_stu_classRow["student_statusTxt"];
			}else{
				$student_statusTxt=Null;
			}
			$pdo_eveluation=Null;
			$this->student_statusTxt=$student_statusTxt;
		}
		function student_status(){
			return $this->student_statusTxt;
		}

	}

	class data_stunew{
		public $sr_t,$sr_y,$sr_l,$sr_key;
		public $printdata_stuallnew;
		function __construct($sr_t,$sr_y,$sr_l,$sr_key){
			$this->sr_t=$sr_t;
			$this->sr_y=$sr_y;
			$this->sr_l=$sr_l;
			$this->sr_key=$sr_key;


			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();


			$printdata_stuallnew=array();
			$sturoom_sql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`regina_stu_data`.`rsd_prefix`
						,`regina_stu_data`.`rsd_name` ,`regina_stu_data`.`rsd_surname`,LOWER(`regina_stu_data`.`rsd_nameEn`) AS `rsd_nameEn` ,LOWER(`regina_stu_data`.`rsd_surnameEn`) AS `rsd_surnameEn`
						,LOWER(`regina_stu_data`.`nickTh`) AS `nickTh`,LOWER(`regina_stu_data`.`nickEn`) AS `nickEn`,`regina_stu_class`.`rsc_year` ,`regina_stu_class`.`rsc_term`
						,`regina_stu_class`.`rsc_plan`,`regina_stu_class`.`rsc_class` ,`regina_stu_class`.`rsc_room` ,`regina_stu_class`.`rsc_num`
						,`regina_stu_data`.`rse_home`,`regina_stu_class`.`rsc_status`,`regina_stu_class`.`rsc_txt`
						from `regina_stu_class` join `regina_stu_data` on(`regina_stu_class`.`rsd_studentid`=`regina_stu_data`.`rsd_studentid`)
						where `regina_stu_class`.`rsc_term`='{$this->sr_t}'
						and `regina_stu_class`.`rsc_year`='{$this->sr_y}'
						and `regina_stu_class`.`rsc_class`='{$this->sr_l}'
						and `regina_stu_class`.`rsd_studentid` ='{$this->sr_key}'
						ORDER BY `regina_stu_class`.`rsc_room` ASC , `regina_stu_class`.`rsc_num` ASC";
			if($sturoom_rs=$pdo_eveluation->query($sturoom_sql)){
				while($sturoom_row=$sturoom_rs->Fetch(PDO::FETCH_ASSOC)){
					$printdata_stuallnew[]=$sturoom_row;
				}
			}else{

			}
			$pdo_eveluation=Null;
			$this->printdata_stuallnew=$printdata_stuallnew;
		}
		function __destruct(){
			$this->printdata_stuallnew;
		}
	}

	class data_stuallnew{
		public $sr_t,$sr_y,$sr_l;
		public $printdata_stuallnew;
		function __construct($sr_t,$sr_y,$sr_l){
			$this->sr_t=$sr_t;
			$this->sr_y=$sr_y;
			$this->sr_l=$sr_l;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();


			$printdata_stuallnew=array();
			$sturoom_sql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`regina_stu_data`.`rsd_prefix`
						,`regina_stu_data`.`rsd_name` ,`regina_stu_data`.`rsd_surname`,LOWER(`regina_stu_data`.`rsd_nameEn`) AS `rsd_nameEn` ,LOWER(`regina_stu_data`.`rsd_surnameEn`) AS `rsd_surnameEn`
						,LOWER(`regina_stu_data`.`nickTh`) AS `nickTh`,LOWER(`regina_stu_data`.`nickEn`) AS `nickEn`,`regina_stu_class`.`rsc_year` ,`regina_stu_class`.`rsc_term`
						,`regina_stu_class`.`rsc_plan`,`regina_stu_class`.`rsc_class` ,`regina_stu_class`.`rsc_room` ,`regina_stu_class`.`rsc_num`
						,`regina_stu_data`.`rse_home`,`regina_stu_class`.`rsc_status`,`regina_stu_class`.`rsc_txt`
						from `regina_stu_class` join `regina_stu_data` on(`regina_stu_class`.`rsd_studentid`=`regina_stu_data`.`rsd_studentid`)
						where `regina_stu_class`.`rsc_term`='{$this->sr_t}'
						and `regina_stu_class`.`rsc_year`='{$this->sr_y}'
						and `regina_stu_class`.`rsc_class`='{$this->sr_l}'
						ORDER BY `regina_stu_class`.`rsc_room` ASC , `regina_stu_class`.`rsc_num` ASC";
			if($sturoom_rs=$pdo_eveluation->query($sturoom_sql)){
				while($sturoom_row=$sturoom_rs->Fetch(PDO::FETCH_ASSOC)){
					$printdata_stuallnew[]=$sturoom_row;
				}
			}else{

			}
			$pdo_eveluation=Null;
			$this->printdata_stuallnew=$printdata_stuallnew;
		}
		function __destruct(){
			$this->printdata_stuallnew;
		}
	}




//data_sturoom->pdo
	class data_sturoom{
		public $sr_t,$sr_y,$sr_l,$sr_r;
		public $printdata_sturoom;
		function __construct($sr_t,$sr_y,$sr_l,$sr_r){
			$this->sr_t=$sr_t;
			$this->sr_y=$sr_y;
			$this->sr_l=$sr_l;
			$this->sr_r=$sr_r;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();


			$printdata_sturoom=array();
			$sturoom_sql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`regina_stu_data`.`rsd_prefix` ,`regina_stu_data`.`rsd_name`
						,`regina_stu_data`.`rsd_surname`,LOWER(`regina_stu_data`.`rsd_nameEn`) AS `rsd_nameEn` ,LOWER(`regina_stu_data`.`rsd_surnameEn`) AS `rsd_surnameEn` ,LOWER(`regina_stu_data`.`nickTh`) AS `nickTh` ,LOWER(`regina_stu_data`.`nickEn`) AS `nickEn`,`regina_stu_class`.`rsc_year`
						,`regina_stu_class`.`rsc_term`,`regina_stu_class`.`rsc_plan`,`regina_stu_class`.`rsc_class` ,`regina_stu_class`.`rsc_room`
						,`regina_stu_class`.`rsc_num`,`regina_stu_data`.`rse_home`,`regina_stu_class`.`rsc_status` AS `IDStatus`, `rc_student_status`.`Name` AS`StatusName`,`regina_stu_class`.`rsc_txt` from `regina_stu_class` join `regina_stu_data` on(`regina_stu_class`.`rsd_studentid`=`regina_stu_data`.`rsd_studentid`)
                        join `rc_student_status` on(`regina_stu_class`.`rsc_status`=`rc_student_status`.`IDStatus`)                       
						where `regina_stu_class`.`rsc_term`='{$this->sr_t}'
						and `regina_stu_class`.`rsc_year`='{$this->sr_y}'
						and `regina_stu_class`.`rsc_class`='{$this->sr_l}'
						and `regina_stu_class`.`rsc_room`='{$this->sr_r}'
						ORDER BY `regina_stu_class`.`rsc_room` ASC , `regina_stu_class`.`rsc_num` ASC;";
			if($sturoom_rs=$pdo_eveluation->query($sturoom_sql)){
				while($sturoom_row=$sturoom_rs->Fetch(PDO::FETCH_ASSOC)){
					$printdata_sturoom[]=$sturoom_row;
				}
			}else{
				$printdata_sturoom[]=null;
			}
			$pdo_eveluation=Null;
			$this->printdata_sturoom=$printdata_sturoom;
		}
		function __destruct(){
			$this->printdata_sturoom;
		}
	}



	class data_sturoom2{
		public $sr_t,$sr_y,$sr_l,$sr_r;
		public $printdata_sturoom;
		function __construct($sr_t,$sr_y,$sr_l,$sr_r){
			$this->sr_t=$sr_t;
			$this->sr_y=$sr_y;
			$this->sr_l=$sr_l;
			$this->sr_r=$sr_r;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();


			$printdata_sturoom=array();
			$sturoom_sql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`regina_stu_data`.`rsd_prefix` ,`regina_stu_data`.`rsd_name`
						,`regina_stu_data`.`rsd_surname`,LOWER(`regina_stu_data`.`rsd_nameEn`) AS `rsd_nameEn` ,LOWER(`regina_stu_data`.`rsd_surnameEn`) AS `rsd_surnameEn` ,LOWER(`regina_stu_data`.`nickTh`) AS `nickTh` ,LOWER(`regina_stu_data`.`nickEn`) AS `nickEn`,`regina_stu_class`.`rsc_year`
						,`regina_stu_class`.`rsc_term`,`regina_stu_class`.`rsc_plan`,`regina_stu_class`.`rsc_class` ,`regina_stu_class`.`rsc_room`
						,`regina_stu_class`.`rsc_num`,`regina_stu_data`.`rse_home`,`regina_stu_class`.`rsc_status`,`regina_stu_class`.`rsc_txt` from `regina_stu_class` join `regina_stu_data` on(`regina_stu_class`.`rsd_studentid`=`regina_stu_data`.`rsd_studentid`)
						where `regina_stu_class`.`rsc_term`='{$this->sr_t}'
						and `regina_stu_class`.`rsc_year`='{$this->sr_y}'
						and `regina_stu_class`.`rsc_class`='{$this->sr_l}'
						and `regina_stu_class`.`rsc_room`='{$this->sr_r}'
						and `regina_stu_class`.`rsc_status`='1'
						ORDER BY `regina_stu_class`.`rsc_room` ASC , `regina_stu_class`.`rsc_num` ASC";
			if($sturoom_rs=$pdo_eveluation->query($sturoom_sql)){
				while($sturoom_row=$sturoom_rs->Fetch(PDO::FETCH_ASSOC)){
					$printdata_sturoom[]=$sturoom_row;
				}
			}else{

			}
			$pdo_eveluation=Null;
			$this->printdata_sturoom=$printdata_sturoom;
		}
		function __destruct(){
			$this->printdata_sturoom;
		}
	}

//data_sturoom->pdo
	class data_stuclass{
		public $sr_t;
		public $sr_y;
		public $sr_l;
		//public $sr_r;
		function __construct($sr_t,$sr_y,$sr_l){
			$this->sr_t=$sr_t;
			$this->sr_y=$sr_y;
			$this->sr_l=$sr_l;
			//$this->sr_r=$sr_r;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();


			$printdata_stuclass=array();
			$sturoom_sql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`regina_stu_data`.`rsd_prefix` ,`regina_stu_data`.`rsd_name`
						,`regina_stu_data`.`rsd_surname`,LOWER(`regina_stu_data`.`rsd_nameEn`) AS `rsd_nameEn` ,LOWER(`regina_stu_data`.`rsd_surnameEn`) AS `rsd_surnameEn`,LOWER(`regina_stu_data`.`nickTh`) AS `nickTh`,LOWER(`regina_stu_data`.`nickEn`) AS `nickEn`,`regina_stu_class`.`rsc_year`
						,`regina_stu_class`.`rsc_term`,`regina_stu_class`.`rsc_plan`,`regina_stu_class`.`rsc_class` ,`regina_stu_class`.`rsc_room`
						,`regina_stu_class`.`rsc_num`,`regina_stu_data`.`rse_home`,`regina_stu_class`.`rsc_status`,`regina_stu_class`.`rsc_txt` from `regina_stu_class` join `regina_stu_data` on(`regina_stu_class`.`rsd_studentid`=`regina_stu_data`.`rsd_studentid`)
						where `regina_stu_class`.`rsc_term`='{$this->sr_t}'
						and `regina_stu_class`.`rsc_year`='{$this->sr_y}'
						and `regina_stu_class`.`rsc_class`='{$this->sr_l}'
						ORDER BY `regina_stu_class`.`rsc_room` ASC , `regina_stu_class`.`rsc_num` ASC";
			if($sturoom_rs=$pdo_eveluation->query($sturoom_sql)){
				while($sturoom_row=$sturoom_rs->Fetch(PDO::FETCH_ASSOC)){
					$printdata_stuclass[]=$sturoom_row;
				}
			}else{

			}
			$pdo_eveluation=Null;
			$this->printdata_stuclass=$printdata_stuclass;
		}
		function __destruct(){
			$this->printdata_stuclass;
		}
	}


//print_plan->pdo
	class print_plan{
		public $plan;
		function __construct($plan){
			$this->plan=$plan;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();

			$plan_sql="SELECT `Name`,`LName`,`IDPlan`,`swip_key` FROM `rc_plan` WHERE `IDPlan`='{$this->plan}'";
			if($plan_rs=$pdo_eveluation->query($plan_sql)){
				$plan_row=$plan_rs->Fetch(PDO::FETCH_ASSOC);
				$plan_id=$plan_row["IDPlan"];
				$plan_Name=$plan_row["Name"];
				$plan_LName=$plan_row["LName"];
				$plan_SwipKey=$plan_row["swip_key"];
			}else{
				$plan_id=null;
				$plan_Name=null;
				$plan_LName=null;
				$plan_SwipKey=null;
			}
			$pdo_eveluation=Null;
			$this->plan_id=$plan_id;
			$this->plan_Name=$plan_Name;
			$this->plan_LName=$plan_LName;
			$this->plan_SwipKey=$plan_SwipKey;
		}
		function __destruct(){
			$this->plan_id;
			$this->plan_Name;
			$this->plan_LName;
			$this->plan_SwipKey;
		}
	}

	//print_plan->pdo
	class print_plantxt{
		public $plan;
		function __construct($plan){
			$this->plan=$plan;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();


			$plan_sql="SELECT `Name`,`LName`,`IDPlan` FROM `rc_plan` WHERE `Name`='{$this->plan}'";
			if($plan_rs=$pdo_eveluation->query($plan_sql)){
				$plan_row=$plan_rs->Fetch(PDO::FETCH_ASSOC);
				$plan_id=$plan_row["IDPlan"];
				$plan_Name=$plan_row["Name"];
				$plan_LName=$plan_row["LName"];
			}else{
			  $plan_id="";
				$plan_Name="";
				$plan_LName="";
			}
			$pdo_eveluation=Null;
			$this->plan_id=$plan_id;
			$this->plan_Name=$plan_Name;
			$this->plan_LName=$plan_LName;
		}
		function __destruct(){
		  $this->plan_id;
			$this->plan_Name;
			$this->plan_LName;
		}
	}


//print_level->pdo
	class print_leveltxt{
		public $levelname;
		function __construct($levelname){
			$this->levelname=$levelname;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();

			if($this->levelname=="อ.2"){
				$level_IDLevel=3;
			}else{
    			try{
					$level_sql="SELECT `IDLevel` FROM `rc_level` WHERE `Sort_name` = '{$this->levelname}'";
						if($level_rs=$pdo_eveluation->query($level_sql)){
							$level_row=$level_rs->Fetch(PDO::FETCH_ASSOC);
							$level_IDLevel=$level_row["IDLevel"];
						}else{
							$level_IDLevel=null;
						}					
				}catch(PDOException $ca){
					$level_IDLevel=null;
				} 
			}
			$pdo_eveluation=Null;
			$this->level_IDLevel=$level_IDLevel;
		}function __destruct(){
			$this->level_IDLevel;
		}
	}


//print_level->pdo
	class print_level{
		public $level;
		function __construct($level){
			$this->level=$level;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();

			if($this->level==2){
			    $level_PLevel="";
  				$level_Sort_name="";
  				$level_Sort_name_E="";
  				$level_Lname="อนุบาล 2";
			}else{
    			$level_sql="SELECT `PLevel`,`Sort_name`,`Sort_name_E`,`Lname` FROM `rc_level` WHERE `IDLevel`='{$this->level}';";
    			if($level_rs=$pdo_eveluation->query($level_sql)){
    				$level_row=$level_rs->Fetch(PDO::FETCH_ASSOC);
                        if(is_array($level_row) && count($level_row)){
                            $level_PLevel=$level_row["PLevel"];
                            $level_Sort_name=$level_row["Sort_name"];
                            $level_Sort_name_E=$level_row["Sort_name_E"];
                            $level_Lname=$level_row["Lname"];                            
                        }else{
                            $level_PLevel=Null;
                            $level_Sort_name=Null;
                            $level_Sort_name_E=Null;
                            $level_Lname=Null;                            
                        }
    			}else{
                    $level_PLevel=Null;
                    $level_Sort_name=Null;
                    $level_Sort_name_E=Null;
                    $level_Lname=Null; 
    			}
			}
            
            if(isset($level_PLevel)){
                $this->level_PLevel=$level_PLevel;
                $this->level_Sort_name=$level_Sort_name;
                $this->level_Sort_name_E=$level_Sort_name_E;
                $this->level_Lname=$level_Lname; 
                $pdo_eveluation=Null;                
            }else{
                $pdo_eveluation=Null;
            }
		}
		function __destruct(){
            if(isset($this->level_PLevel)){
                $this->level_PLevel;
                $this->level_Sort_name;
                $this->level_Sort_name_E;
                $this->level_Lname;                
            }else{
                //--------------------------
            }
		}
	}


//not_array->PDO
	class pdo_notarray{
		public $not_array;
		function __construct($not_array){
			$this->not_array=$not_array;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();


			$print_pdonotarray=array();

			$pod_sql=$this->not_array;
			if($pod_rs=$pdo_eveluation->query($pod_sql)){
				$pod_row=$pod_rs->Fetch(PDO::FETCH_ASSOC);
				$print_pdonotarray[]=$pod_row;
			}else{

			}
			$pdo_eveluation=Null;
			$this->print_pdonotarray=$print_pdonotarray;
		}
		function __destruct(){
			$this->print_pdonotarray;
		}
	}

	class pdo_array{
		public $not_array;
		function __construct($not_array){
			$this->not_array=$not_array;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();


			$print_pdonotarray=array();

			$pod_sql=$this->not_array;
			if($pod_rs=$pdo_eveluation->query($pod_sql)){
				while($pod_row=$pod_rs->Fetch(PDO::FETCH_ASSOC)){
					$print_pdonotarray[]=$pod_row;
				}
			}else{

			}
			$pdo_eveluation=Null;
			$this->print_pdonotarray=$print_pdonotarray;
		}
		function __destruct(){
			$this->print_pdonotarray;
		}
	}

//data_level->pdo
	class level{
		public $data_levelA;
		public $data_levelB;
		function __construct($data_levelA,$data_levelB){
			$this->data_levelA=$data_levelA;
			$this->data_levelB=$data_levelB;

			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_eveluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_eveluation->call_pdodata();

			$print_level=array();

			$txt_levelSql="SELECT `IDLevel`,`PLevel`,`Sort_name`,`Lname` FROM `rc_level` WHERE `IDLevel` >='{$this->data_levelA}' and `IDLevel` <='{$this->data_levelB}';";
			if($txt_levelRs=$pdo_eveluation->query($txt_levelSql)){
				while($txt_levelRow=$txt_levelRs->Fetch(PDO::FETCH_ASSOC)){
					$print_level[]=$txt_levelRow;
				}
			}else{

			}
			$pdo_eveluation=Null;

			$this->print_level=$print_level;
			//$this->data_level=$data_level;
		}
		function __destruct(){
			$this->print_level;
			//$this->data_level;
		}
	}


//rc_level
	class rc_level{
		public $txt_level;
		function __construct($txt_level){
			$this->txt_level=$txt_level;
			$rcdata_connect= connect();
			$txt_levelSql="SELECT * FROM `rc_level` WHERE `IDLevel`='{$this->txt_level}';";
			$txt_levelRs=$rcdata_connect->query($txt_levelSql);
			if($txt_levelRs->num_rows>0){
				$txt_levelRow=$txt_levelRs->fetch_assoc();
					$IDLevel=$txt_levelRow["IDLevel"];
					$PLevel=$txt_levelRow["PLevel"];
					$Sort_name=$txt_levelRow["Sort_name"];
					$Sort_name_E=$txt_levelRow["Sort_name_E"];
					$Sort_name_E2=$txt_levelRow["Sort_name_E2"];
					$Lname=$txt_levelRow["Lname"];
			}else{
					$IDLevel="";
					$PLevel="";
					$Sort_name="";
					$Sort_name_E="";
					$Lname="";
			}
			$this->IDLevel=$IDLevel;
			$this->PLevel=$PLevel;
			$this->Sort_name=$Sort_name;
			$this->Sort_name_E=$Sort_name_E;
			$this->Sort_name_E2=$Sort_name_E2;
			$this->Lname=$Lname;
		}
		function __destruct(){
			$this->IDLevel;
			$this->PLevel;
			$this->Sort_name;
			$this->Sort_name_E;
			$this->Sort_name_E2;
			$this->Lname;
		}
	}


//rc_prefix
	class rc_prefix{
		public $txt_prefix;
		function __construct($txt_prefix){
			$this->txt_prefix=$txt_prefix;
			$rcdata_connect= connect();
			$txt_prefixSql="SELECT `IDPrefix`, `prefixname`, `prefix_SName`, `prefix_EName` FROM `rc_prefix` WHERE `IDPrefix`='{$this->txt_prefix}'";
			$txt_prefixRs=$rcdata_connect->query($txt_prefixSql);
			if($txt_prefixRs->num_rows>0){
				$txt_prefixRow=$txt_prefixRs->fetch_assoc();
				$IDPrefix=$txt_prefixRow["IDPrefix"];
				$prefixname=$txt_prefixRow["prefixname"];
				$prefix_SName=$txt_prefixRow["prefix_SName"];
				
				$prefix_EName=strtolower($txt_prefixRow["prefix_EName"]);
				$prefix_EName=ucwords($prefix_EName);
				
			}else{
				$IDPrefix=null;
				$prefixname=null;
				$prefix_SName=null;
				$prefix_EName=null;
			}
				$this->IDPrefix=$IDPrefix;
				$this->prefixname=$prefixname;
				$this->prefix_SName=$prefix_SName;
				$this->prefix_EName=$prefix_EName;
		}
		function __destruct(){
			$this->IDPrefix;
			$this->prefixname;
			$this->prefix_SName;
			$this->prefix_EName;
		}
	}

//print_notarray
	class print_notarray{
		public $print_sql;
		function __construct($print_sql){
			$this->print_sql=$print_sql;
			$print_array=array();
			$rcdata_connect= connect();
			$data_result=$rcdata_connect->query($this->print_sql);

			if($data_result->num_rows>0){
				$txt_notarray="have";
				$data_row=$data_result->fetch_assoc();
				$print_array[]=$data_row;
			}else{
				$txt_notarray="not_have";
			}
			$this->txt_notarray=$txt_notarray;
			$this->print_array=$print_array;
		}
		function __destruct(){
			$this->txt_notarray;
			$this->print_array;
		}

	}

//print_notarray
	class print_arrayrow{
		public $print_sql;
		public $txt_array,$print_array;
		function __construct($print_sql){
			$this->print_sql=$print_sql;
			$print_array=array();
			$rcdata_connect= connect();
			$data_result=$rcdata_connect->query($this->print_sql);

			if($data_result->num_rows>0){
				$txt_array="have";
				while($data_row=$data_result->fetch_assoc()){
					$print_array[]=$data_row;
				}
			}else{
				$txt_array="not_have";
			}
			$this->txt_array=$txt_array;
			$this->print_array=$print_array;
		}
		function __destruct(){
			$this->txt_array;
			$this->print_array;
		}

	}


//rc_advisor

//stu_level
	class stu_level{
		public $stu_id,$stu_year,$stu_term;
		public $rsd_studentid,$IDLevel,$Sort_name,$Lname,$planname,$rsc_room,$rsc_num,$rc_plan;

		function __construct($stu_id,$stu_year,$stu_term){
			$this->stu_id=$stu_id;
			$this->stu_year=$stu_year;
			$this->stu_term=$stu_term;

			$stu_levelsql="select `regina_stu_class`.`rsd_studentid`,`rc_level`.`IDLevel`,`rc_level`.`Sort_name`,`rc_level`.`Lname`
						 ,`rc_plan`.`Name`as `planname`,`regina_stu_class`.`rsc_room`,`regina_stu_class`.`rsc_num`,`regina_stu_class`.`rsc_plan`
						   from `regina_stu_class` join `rc_level` on(`rc_level`.`IDLevel`=`regina_stu_class`.`rsc_class`)
						   join `rc_plan` on(`regina_stu_class`.`rsc_plan`=`rc_plan`.`IDPlan`)
						   where `regina_stu_class`.`rsc_year`='{$this->stu_year}'
						   and `regina_stu_class`.`rsc_term`='{$this->stu_term}'
						   and `regina_stu_class`.`rsd_studentid`='{$this->stu_id}'";
			$rcdata_connect= connect();
			$stu_levelRs=$rcdata_connect->query($stu_levelsql);
				if($stu_levelRs->num_rows>0){
					$stu_levelRow=$stu_levelRs->fetch_assoc();
					$this->rsd_studentid=$stu_levelRow["rsd_studentid"];
					$this->IDLevel=$stu_levelRow["IDLevel"];
					$this->Sort_name=$stu_levelRow["Sort_name"];
					$this->Lname=$stu_levelRow["Lname"];
					$this->planname=$stu_levelRow["planname"];
					$this->rsc_room=$stu_levelRow["rsc_room"];
					$this->rsc_num=$stu_levelRow["rsc_num"];
					$this->rc_plan=$stu_levelRow["rsc_plan"];
				}else{
					$this->rsd_studentid=null;
					$this->IDLevel=null;
					$this->Sort_name=null;
					$this->Lname=null;
					$this->planname=null;
					$this->rsc_room=null;
					$this->rsc_num=null;
					$this->rc_plan=null;
				}

		}
		function __destruct(){
			$this->rsd_studentid;
			$this->IDLevel;
			$this->Sort_name;
			$this->Lname;
			$this->planname;
			$this->rsc_room;
			$this->rsc_num;
			$this->rc_plan;
		}
	}  
//stu_level End







//stu_all
	class stu_all{
		public $stu_status;
		public $data_stuarray;
		function __construct($stu_status){
			$this->stu_status=$stu_status;
			$data_stuSql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_Identification`,`rc_prefix`.`prefixname`
					    ,`regina_stu_data`.`rsd_name`,`regina_stu_data`.`rsd_surname`,LOWER(`regina_stu_data`.`rsd_nameEn`) AS `rsd_nameEn`
						,LOWER(`regina_stu_data`.`rsd_surnameEn`) AS `rsd_surnameEn`,`rc_student_status`.`Name` as `status_name`
						  from `regina_stu_data` join `rc_student_status` on(`regina_stu_data`.`rse_student_status`=`rc_student_status`.`IDStatus`)
						  join `rc_prefix` on(`regina_stu_data`.`rsd_prefix`=`rc_prefix`.`IDPrefix`)
						  where `regina_stu_data`.`rse_student_status`='{$this->stu_status}';";
			$data_stuarray=array();
			$rcdata_connect= connect();
			$data_stuRs=$rcdata_connect->query($data_stuSql) or die($rcdata_connect->error);
			if($data_stuRs->num_rows>0){
				while($data_stuRow=$data_stuRs->fetch_assoc()){
					$data_stuarray[]=$data_stuRow;
				}

			}else{
			
			}
				$this->data_stuarray=$data_stuarray;
		}

		function __destruct(){
			$this->data_stuarray;
		}
	}



	class class_stuA{
		public $stu_key;
		public $stu_term;
		public $stu_year;
		function __construct($stu_key,$stu_term,$stu_year){
			$this->stu_key=$stu_key;
			$this->stu_term=$stu_term;
			$this->stu_year=$stu_year;
			$class_stuSql="SELECT `regina_stu_data`.`rsd_studentid` , `regina_stu_data`.`rsd_name` , `regina_stu_data`.`rsd_surname` , `regina_stu_class`.`rsc_year` , `regina_stu_class`.`rsc_term` , `regina_stu_class`.`rsc_plan` , `regina_stu_class`.`rsc_class` , `regina_stu_class`.`rsc_room` , `regina_stu_class`.`rsc_num`
						   FROM `regina_stu_data`
						   JOIN `regina_stu_class` ON ( `regina_stu_data`.`rsd_studentid` = `regina_stu_class`.`rsd_studentid` )
						   WHERE `regina_stu_class`.`rsc_status` = '1'
						   AND `regina_stu_data`.`rsd_studentid` = '{$this->stu_key}'
						   AND `regina_stu_class`.`rsc_term` = '{$this->stu_term}'
						   AND `regina_stu_class`.`rsc_year` = '{$this->stu_year}'";
			$rcdata_connect= connect();
			$class_stuRs=$rcdata_connect->query($class_stuSql) or die($rcdata_connect->error);
			if($class_stuRs->num_rows>0){
				$class_stuRow=$class_stuRs->fetch_assoc();
				$txt_system="yes";
				$rsd_studentid=$class_stuRow["rsd_studentid"];
				$rsd_name=$class_stuRow["rsd_name"];
				$rsd_surname=$class_stuRow["rsd_surname"];
				$rsc_year=$class_stuRow["rsc_year"];
				$rsc_term=$class_stuRow["rsc_term"];
				$rsc_plan=$class_stuRow["rsc_plan"];
				$rsc_class=$class_stuRow["rsc_class"];
			}else{
				$txt_system="no";
				$rsd_studentid="Null";
				$rsd_name="Null";
				$rsd_surname="Null";
				$rsc_year="Null";
				$rsc_term="Null";
				$rsc_plan="Null";
				$rsc_class="Null";

			}
				$this->txt_system=$txt_system;
				$this->rsd_studentid=$rsd_studentid;
				$this->rsd_name=$rsd_name;
				$this->rsd_surname=$rsd_surname;
				$this->rsc_year=$rsc_year;
				$this->rsc_term=$rsc_term;
				$this->rsc_plan=$rsc_plan;
				$this->rsc_class=$rsc_class;
		}
		function __destruct(){
			$this->txt_system;
			$this->rsd_studentid;
			$this->rsd_name;
			$this->rsd_surname;
			$this->rsc_year;
			$this->rsc_term;
			$this->rsc_plan;
			$this->rsc_class;
		}
	}



// class_stu

	class class_stu{
		public $stu_key;
		public $stu_term;
		public $stu_year;
		function __construct($stu_key,$stu_term,$stu_year){
			$this->stu_key=$stu_key;
			$this->stu_term=$stu_term;
			$this->stu_year=$stu_year;
			$class_stuSql="select `regina_stu_data`.`rsd_studentid`,`regina_stu_data`.`rsd_name`,`regina_stu_data`.`rsd_surname`,
						  `regina_stu_class`.`rsc_year`,`regina_stu_class`.`rsc_term`,`regina_stu_class`.`rsc_plan`,`regina_stu_class`.`rsc_class`,
						  `regina_stu_class`.`rsc_room`,`regina_stu_class`.`rsc_num`
						   from  `regina_stu_data` join `regina_stu_class` on (`regina_stu_data`.`rsd_studentid`=`regina_stu_class`.`rsd_studentid`)
				           join `regina_stu_login` on (`regina_stu_data`.`rsd_studentid`=`regina_stu_login`.`rsd_studentid`)
						   Where `regina_stu_data`.`rse_student_status`='1'
						   and `regina_stu_data`.`rsd_studentid`='{$this->stu_key}'
						   and `regina_stu_class`.`rsc_term`='{$this->stu_term}'
						   and `regina_stu_class`.`rsc_year`='{$this->stu_year}'";
			$rcdata_connect= connect();
			$class_stuRs=$rcdata_connect->query($class_stuSql) or die($rcdata_connect->error);
			if($class_stuRs->num_rows>0){
				$class_stuRow=$class_stuRs->fetch_assoc();
				$txt_system="yes";
				$rsd_studentid=$class_stuRow["rsd_studentid"];
				$rsd_name=$class_stuRow["rsd_name"];
				$rsd_surname=$class_stuRow["rsd_surname"];
				$rsc_year=$class_stuRow["rsc_year"];
				$rsc_term=$class_stuRow["rsc_term"];
				$rsc_plan=$class_stuRow["rsc_plan"];
				$rsc_class=$class_stuRow["rsc_class"];
			}else{
				$txt_system="no";
				$rsd_studentid="Null";
				$rsd_name="Null";
				$rsd_surname="Null";
				$rsc_year="Null";
				$rsc_term="Null";
				$rsc_plan="Null";
				$rsc_class="Null";

			}
				$this->txt_system=$txt_system;
				$this->rsd_studentid=$rsd_studentid;
				$this->rsd_name=$rsd_name;
				$this->rsd_surname=$rsd_surname;
				$this->rsc_year=$rsc_year;
				$this->rsc_term=$rsc_term;
				$this->rsc_plan=$rsc_plan;
				$this->rsc_class=$rsc_class;
		}
		function __destruct(){
			$this->txt_system;
			$this->rsd_studentid;
			$this->rsd_name;
			$this->rsd_surname;
			$this->rsc_year;
			$this->rsc_term;
			$this->rsc_plan;
			$this->rsc_class;
		}
	}

//stu_room
	class stu_room{
		public $stu_year,$stu_term,$stu_class;
		public $stu_array;
	    function __construct($stu_year,$stu_term,$stu_class){
			$this->stu_year=$stu_year;
			$this->stu_term=$stu_term;
			$this->stu_class=$stu_class;
			$stu_array=array();
			$stu_dataSql="select `regina_stu_class`.`rsd_studentid`,`rc_prefix`.`prefixname`,`regina_stu_data`.`rsd_name`,`regina_stu_data`.`rsd_surname`,`rc_level`.`Lname`,`rc_level`.`IDLevel`,`rc_plan`.`Name` as `plan_name`,`regina_stu_class`.`rsc_room`, `regina_stu_class`.`rsc_num`
						  from  `regina_stu_data` join `rc_prefix` on(`regina_stu_data`.`rsd_prefix`=`rc_prefix`.`IDPrefix`)
                          join `regina_stu_class` on(`regina_stu_data`.`rsd_studentid`=`regina_stu_class`.`rsd_studentid`)
                          join `rc_level`on(`regina_stu_class`.`rsc_class`=`rc_level`.`IDLevel`)
                          join `rc_plan`on(`regina_stu_class`.`rsc_plan`=`rc_plan`.`IDPlan`)
                          where `regina_stu_data`.`rse_student_status`='1'
                          and `regina_stu_class`.`rsc_year`='{$this->stu_year}'
                          and `regina_stu_class`.`rsc_term`='{$this->stu_term}'
                          and `regina_stu_class`.`rsc_class`='{$this->stu_class}'";
			$rcdata_connect= connect();
			$stu_dataRs=$rcdata_connect->query($stu_dataSql) or die($rcdata_connect->error);
			if($stu_dataRs->num_rows>0){
				while($stu_dataRow=$stu_dataRs->fetch_assoc()){
					$stu_array[]=$stu_dataRow;
				}
			}else{
				//Null********************
			}
			$this->stu_array=$stu_array;
		}
		function __destruct(){
			$this->stu_array;
		}
	}


	class stu_grade{
		public $data_grade;
		public $txt_gradeint,$txt_gradeen;
		function __construct($data_grade){
			$this->data_grade=$data_grade;
			if($this->data_grade==4.00){
				$txt_gradeint=4;
				$txt_gradeen="A";
			}elseif($this->data_grade==3.50){
				$txt_gradeint=3.5;
				$txt_gradeen="B+";
			}elseif($this->data_grade==3.00){
				$txt_gradeint=3;
				$txt_gradeen="B";
			}elseif($this->data_grade==2.50){
				$txt_gradeint=2.5;
				$txt_gradeen="C+";
			}elseif($this->data_grade==2.00){
				$txt_gradeint=2;
				$txt_gradeen="C";
			}elseif($this->data_grade==1.50){
				$txt_gradeint=1.5;
				$txt_gradeen="D+";
			}elseif($this->data_grade==1.00){
				$txt_gradeint=1;
				$txt_gradeen="D";
			}elseif($this->data_grade==0.00){
				$txt_gradeint=0;
				$txt_gradeen="F";
			}else{
				$txt_gradeint=0;
				$txt_gradeen="F";
			}
			
			if(isset($txt_gradeint,$txt_gradeen)){
				$this->txt_gradeint=$txt_gradeint;
				$this->txt_gradeen=$txt_gradeen;				
			}else{}

		}
		function __destruct(){
			if(isset($this->txt_gradeint,$this->txt_gradeen)){
				$this->txt_gradeint;
				$this->txt_gradeen;				
			}else{}

		}
	}

?>
