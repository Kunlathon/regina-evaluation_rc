<?php
	class SupplementaryClass{
		public $SC_T,$SC_LA,$SC_LB,$SC_Y;
		function __construct($SC_T,$SC_LA,$SC_LB,$SC_Y){
			$this->SC_T=$SC_T;
			$this->SC_LA=$SC_LA;
			$this->SC_LB=$SC_LB;
			$this->SC_Y=$SC_Y;
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_evaluation->call_pdodata();
			$SupplementClassPrint=array();
				try{
					$SupplementaryClassSql="select DISTINCT `ss_txtth` 
										    from `supplementary_subject` 
										    where `ss_t`='{$this->SC_T}' 
										    and `ss_l`>='{$this->SC_LA}' 
										    and `ss_l`<='{$this->SC_LB}' 
										    and `ss_year`='{$this->SC_Y}'";
						if($SupplementaryClassRs=$pdo_eveluation->query($SupplementaryClassSql)){
							while($SupplementaryClassRow=$SupplementaryClassRs->Fetch(PDO::FETCH_ASSOC)){
								if(is_array($SupplementaryClassRow) && count($SupplementaryClassRow)){
									$SupplementClassPrint[]=$SupplementaryClassRow;
								}else{
									$SupplementClassPrint="-";
								}								
							}
						}else{
							$SupplementClassPrint="-";
						}
				}catch(PDOException $e){
					$SupplementClassPrint="-";
				}
				if(isset($SupplementClassPrint)){
					$this->SupplementClassPrint=$SupplementClassPrint;
					$pdo_eveluation=null;
				}else{
					$pdo_eveluation=null;
				}
		}function RunSupplementaryClass(){
			if(isset($this->SupplementClassPrint)){
				return $this->SupplementClassPrint;
			}else{}
		}
	}

?>

<?php
	class CountSudSupplement{
		public $CSS_TXTTh,$CSS_T,$CSS_LA,$CSS_LB,$CSS_Y;
		function __construct($CSS_TXTTh,$CSS_T,$CSS_LA,$CSS_LB,$CSS_Y){
//---------------------------------------------------------------------			
			$this->CSS_TXTTh=$CSS_TXTTh;
			$this->CSS_T=$CSS_T;
			$this->CSS_LA=$CSS_LA;
			$this->CSS_LB=$CSS_LB;
			$this->CSS_Y=$CSS_Y;
//---------------------------------------------------------------------			
			$db_evaluationID=$_SERVER['REMOTE_ADDR'];
			$connpdo_evaluation=new count_pdodata($db_evaluationID);
			$pdo_eveluation=$connpdo_evaluation->call_pdodata();
//---------------------------------------------------------------------			
			$CountSudSupplementPrint=array();
			$CountSudSupplementInt=0;
//---------------------------------------------------------------------			
			try{
				$CountSudSupplementSql="select DISTINCT `supplementary_sturs`.`sup_stuid` 
									    from `supplementary_subject`
									    join `supplementary_sturs` on (`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
									    where `supplementary_subject`.`ss_txtth` LIKE '%{$this->CSS_TXTTh}%' 
									    and `supplementary_subject`.`ss_t`='{$this->CSS_T}' 
									    and `supplementary_subject`.`ss_l`>='{$this->CSS_LA}' 
									    and `supplementary_subject`.`ss_l`<='{$this->CSS_LB}' 
									    and `supplementary_subject`.`ss_year`='{$this->CSS_Y}';";
					if($CountSudSupplementRs=$pdo_eveluation->query($CountSudSupplementSql)){
						while($CountSudSupplementRow=$CountSudSupplementRs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($CountSudSupplementRow) && count($CountSudSupplementRow)){
								$CountSudSupplementPrint[]=$CountSudSupplementRow;
								$CountSudSupplementInt=$CountSudSupplementInt+1;							
							}else{
								$CountSudSupplementPrint="-";
								$CountSudSupplementInt="0";
							}
						}
					}else{
						$CountSudSupplementPrint="-";
						$CountSudSupplementInt="0";
					}
			}catch(PDOException $e){
				$CountSudSupplementPrint="-";
				$CountSudSupplementInt="0";				
			}
			
			/*try{
				$CountSudSupplementSql="select DISTINCT `supplementary_sturs`.`sup_stuid` 
									    from `supplementary_subject`
									    join `supplementary_sturs` on (`supplementary_subject`.`ss_id`=`supplementary_sturs`.`ss_id`)
									    where `supplementary_subject`.`ss_txtth` LIKE '%{$this->CSS_TXTTh}%' 
									    and `supplementary_subject`.`ss_t`='{$this->CSS_T}' 
									    and `supplementary_subject`.`ss_l`>='{$this->CSS_LA}' 
									    and `supplementary_subject`.`ss_l`<='{$this->CSS_LB}' 
									    and `supplementary_subject`.`ss_year`='{$this->CSS_Y}';";
					if($CountSudSupplementRs=$pdo_eveluation->query($CountSudSupplementSql)){
						while($CountSudSupplementRow=$CountSudSupplementRs->Fetch(PDO::FETCH_ASSOC)){
							if(is_array($CountSudSupplementRow) && count($CountSudSupplementRow)){
								$CountSudSupplementPrint[]=$CountSudSupplementRow;
								$CountSudSupplementInt=$CountSudSupplementInt+1;							
							}else{
								$CountSudSupplementPrint="-";
								$CountSudSupplementInt="0";
							}
						}
					}else{
						$CountSudSupplementPrint="-";
						$CountSudSupplementInt="0";
					}
			}catch(PDOException $e){
				$CountSudSupplementPrint="-";
				$CountSudSupplementInt="0";				
			}*/
			
			if(isset($CountSudSupplementPrint,$CountSudSupplementInt)){
				$this->CountSudSupplementPrint=$CountSudSupplementPrint;
				$this->CountSudSupplementInt=$CountSudSupplementInt;
				$pdo_eveluation=null;
			}else{
				$pdo_eveluation=null;
			}
		}function RunCountSudSupplementPrint(){
			if(isset($this->CountSudSupplementPrint)){
				return $this->CountSudSupplementPrint;
			}else{}
		}function RunCountSudSupplementInt(){
			if(isset($this->CountSudSupplementInt)){
				return $this->CountSudSupplementInt;
			}else{}
		}
	}
?>