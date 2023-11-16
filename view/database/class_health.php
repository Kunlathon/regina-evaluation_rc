<?php
	class print_health_sud{
		public $PHSrow_t,$PHSrow_y;
		function __construct($PHSrow_t,$PHSrow_y){
//-----------------------------------------------------------------------------------------	
			$this->PHSrow_t=$PHSrow_t;
			$this->PHSrow_y=$PHSrow_y;
			//$this->PHNrow_c=$PHNrow_c;
			$health_sudarray=array();
			$db_healthID=$_SERVER['REMOTE_ADDR'];
			$connpdo_health=new Connection_Health($db_healthID);
			$pdo_health=$connpdo_health->Call_Connection_Health();	
//-----------------------------------------------------------------------------------------	
			$health_sudSql="SELECT * 
							FROM `health_sud` 
							WHERE `hs_t`='{$this->PHSrow_t}' 
							and `hs_year`='{$this->PHSrow_y}'";
				if($health_sudRs=$pdo_health->query($health_sudSql)){
					while($health_sudRow=$health_sudRs->Fetch(PDO::FETCH_ASSOC)){
						if(is_array($health_sudRow) && count($health_sudRow)){
							$health_sudarray[]=$health_sudRow;
						}else{
							$health_sudarray[]=null;
						}
					}
				}else{
					$health_sudarray[]=null;					
				}
			if(isset($health_sudarray)){
				$this->health_sudarray=$health_sudarray;
			}else{
//----------------------------------------------------------------------------------------
			}
		}public function call_health_sudarray(){
			if(isset($this->health_sudarray)){
				return $this->health_sudarray;
			}else{
//----------------------------------------------------------------------------------------
			}
		}
	}
?>

<?php
	class print_health_notrow{
		public $PHNrow_t,$PHNrow_y,$PHNrow_c,$PHNrow_healthid,$PHNrow_rckey; 
		function __construct($PHNrow_t,$PHNrow_y,$PHNrow_c,$PHNrow_healthid,$PHNrow_rckey){
//-----------------------------------------------------------------------------------------
			$this->PHNrow_t=$PHNrow_t;
			$this->PHNrow_y=$PHNrow_y;
			$this->PHNrow_c=$PHNrow_c;
			$this->PHNrow_healthid=$PHNrow_healthid;
			$this->PHNrow_rckey=$PHNrow_rckey;
//-----------------------------------------------------------------------------------------
			$db_healthID=$_SERVER['REMOTE_ADDR'];
			$connpdo_health=new Connection_Health($db_healthID);
			$pdo_health=$connpdo_health->Call_Connection_Health();			
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
			$health_sql="select `health_list`.`hl_id`,`health_list`.`hl_txtTh`,`health_list`.`hl_txtEn`,`health_list_has_health_sud`.`hlhhs_txt` 
						 from `health_list_has_health_sud` 
						 join `health_list` on (`health_list_has_health_sud`.`health_list_hl_id`=`health_list`.`hl_id`) 
						 join `health_sud` on(`health_list_has_health_sud`.`health_sud_hs_key`=`health_sud`.`hs_key`)
						 where `health_list_has_health_sud`.`health_sud_hs_t`='{$this->PHNrow_t}' 
						 and `health_list_has_health_sud`.`health_sud_hs_year`='{$this->PHNrow_y}' 
						 and `health_list_has_health_sud`.`health_sud_hs_class`='{$this->PHNrow_c}' 
						 and `health_list_has_health_sud`.`health_list_hl_id`='{$this->PHNrow_healthid}' 
						 and `health_list_has_health_sud`.`health_sud_hs_key`='{$this->PHNrow_rckey}'";
				if($header_rs=$pdo_health->query($health_sql)){
					$header_row=$header_rs->Fetch(PDO::FETCH_ASSOC);
						if(is_array($header_row) && count($header_row)){
							$print_hl_id=$header_row["hl_id"];
							$print_hl_txtTh=$header_row["hl_txtTh"];
							$print_hl_txtEn=$header_row["hl_txtEn"];
							$print_hlhhs_txt=$header_row["hlhhs_txt"];
						}else{
							$print_hl_id=null;
							$print_hl_txtTh=null;
							$print_hl_txtEn=null;
							$print_hlhhs_txt=null;
						}
				}else{
					$print_hl_id=null;
					$print_hl_txtTh=null;
					$print_hl_txtEn=null;
					$print_hlhhs_txt=null;					
				}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++			
				if(isset($print_hl_id,$print_hl_txtTh,$print_hlhhs_txt)){
					$this->print_hl_id=$print_hl_id;
					$this->print_hl_txtTh=$print_hl_txtTh;
					$this->print_hl_txtEn=$print_hl_txtEn;
					$this->print_hlhhs_txt=$print_hlhhs_txt;
				}else{
//-----------------------------------------------------------------------------------------
				}
			$pdo_health=null;
		}function __destruct(){
			if(isset($this->print_hl_id,$this->print_hl_txtTh,$this->print_hlhhs_txt)){
				$this->print_hl_id;
				$this->print_hl_txtTh;
				$this->print_hl_txtEn;
				$this->print_hlhhs_txt;				
			}else{
//------------------------------------------------------------------------------------------
			}
		} 
	}
?>

<?php
	class insert_healthpdo{
		public $health_sql;
		public $system_insert;
		function __construct($health_sql){
			$this->health_sql=$health_sql;
			$db_healthID=$_SERVER['REMOTE_ADDR'];
			$connpdo_health=new Connection_Health($db_healthID);
			$pdo_health=$connpdo_health->Call_Connection_Health();
						
			$sql=$this->health_sql;
			if($pdo_health->exec($sql)>0){
				$system_insert="yes";
			}else{
				$system_insert="no";
			}
			unset($pdo_health);
			$this->system_insert=$system_insert;
		}
		public function into_health(){
			return $this->system_insert;
		}		
	}
?>





