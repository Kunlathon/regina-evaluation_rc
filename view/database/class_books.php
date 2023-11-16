



<?php
	class StoreSetYear{
		public $SsyYear;
		function __construct(){
//---------------------------------------------------------------	
		$db_booksID=$_SERVER['REMOTE_ADDR'];
		$connected_books=new connected_books($db_booksID);
		$RcbooksPDO=$connected_books->run_connto_books();		
//---------------------------------------------------------------
			try{
				$StoreSetYearSql="SELECT `ssy_year` FROM `store_set_year` WHERE 1";
				$StoreSetYearRs=$RcbooksPDO->query($StoreSetYearSql);
				$StoreSetYearRow=$StoreSetYearRs->Fetch(PDO::FETCH_ASSOC);
					if(is_array($StoreSetYearRow) && count($StoreSetYearRow)){
						$SsyYear=$StoreSetYearRow["ssy_year"];
					}else{
						$SsyYear=null;
					}				
			}catch(PDOException $RcBooks){
				$SsyYear=null;
			}
				if(isset($SsyYear)){
					$this->SsyYear=$SsyYear;
					$RcbooksPDO=null;
				}else{
					$RcbooksPDO=null;
				}
		}function RunStoreSetYear(){
			if(isset($this->SsyYear)){
				return $this->SsyYear;
			}else{}
		}
	}
	
?>

<?php
	class PrintStoreBooksAll{
		public $PRSD_year;
		function __construct($PRSD_year){
//---------------------------------------------------------------
		$this->PRSD_year=$PRSD_year;
//---------------------------------------------------------------	
		$db_booksID=$_SERVER['REMOTE_ADDR'];
		$connected_books=new connected_books($db_booksID);
		$RcbooksPDO=$connected_books->run_connto_books();		
//---------------------------------------------------------------
		$PrintRcStoreDataArray=array();
//---------------------------------------------------------------	
			try{
				$PrintRcStoreDataSql="SELECT * 
								      FROM `rcstore_data` 
									  WHERE `RSD_Year`='{$this->PRSD_year}'";
				$PrintRcStoreDataRs=$RcbooksPDO->query($PrintRcStoreDataSql);
				while($PrintRcStoreDataRow=$PrintRcStoreDataRs->Fetch(PDO::FETCH_ASSOC)){
					if(is_array($PrintRcStoreDataRow) && count($PrintRcStoreDataRow)){
						$PrintRcStoreDataArray[]=$PrintRcStoreDataRow;
					}else{
						$PrintRcStoreDataArray=null;
					}
				}
			}catch(PDOException $RcBooks){
				$PrintRcStoreDataArray=null;
			}
			if(isset($PrintRcStoreDataArray)){
				$this->PrintRcStoreDataArray=$PrintRcStoreDataArray;
				$RcbooksPDO=null;
			}else{
				$RcbooksPDO=null;
			}
		}function PrintStoreBooksRun(){
			if(isset($this->PrintRcStoreDataArray)){
				return $this->PrintRcStoreDataArray;
			}else{}
		}
	}

?>

<?php
	class PrintStoreBooks{
		public $PRSD_year,$PRSD_Class,$PRSD_Plan;
		function __construct($PRSD_year,$PRSD_Class,$PRSD_Plan){
//---------------------------------------------------------------
		$this->PRSD_year=$PRSD_year;
		$this->PRSD_Class=$PRSD_Class;
		$this->PRSD_Plan=$PRSD_Plan;
//---------------------------------------------------------------	
		$db_booksID=$_SERVER['REMOTE_ADDR'];
		$connected_books=new connected_books($db_booksID);
		$RcbooksPDO=$connected_books->run_connto_books();		
//---------------------------------------------------------------
		$PrintRcStoreDataArray=array();
//---------------------------------------------------------------	
			try{
				$PrintRcStoreDataSql="SELECT * 
								      FROM `rcstore_data` 
									  WHERE `RSD_Year`='{$this->PRSD_year}' 
									  AND `RSD_Class`='{$this->PRSD_Class}' 
									  AND `RSD_plan`='{$this->PRSD_Plan}'";
				$PrintRcStoreDataRs=$RcbooksPDO->query($PrintRcStoreDataSql);
				while($PrintRcStoreDataRow=$PrintRcStoreDataRs->Fetch(PDO::FETCH_ASSOC)){
					if(is_array($PrintRcStoreDataRow) && count($PrintRcStoreDataRow)){
						$PrintRcStoreDataArray[]=$PrintRcStoreDataRow;
					}else{
						$PrintRcStoreDataArray=null;
					}
				}
			}catch(PDOException $RcBooks){
				$PrintRcStoreDataArray=null;
			}
			if(isset($PrintRcStoreDataArray)){
				$this->PrintRcStoreDataArray=$PrintRcStoreDataArray;
				$RcbooksPDO=null;
			}else{
				$RcbooksPDO=null;
			}
		}function PrintStoreBooksRun(){
			if(isset($this->PrintRcStoreDataArray)){
				return $this->PrintRcStoreDataArray;
			}else{}
		}
	}

?>



<?php
	class IntoUpDatRcStoreData{
		public $IDRSD_RSD_No,$IDRSD_RSD_Txt,$IDRSD_RSD_Year,$IDRSD_RSD_Class,$IDRSD_RSD_plan,$IDRSD_RSD_Price,$IDRSD_key;
		function __construct($IDRSD_RSD_No,$IDRSD_RSD_Txt,$IDRSD_RSD_Year,$IDRSD_RSD_Class,$IDRSD_RSD_plan,$IDRSD_RSD_Price,$IDRSD_key){
//---------------------------------------------------------------
		$this->IDRSD_RSD_No=$IDRSD_RSD_No;
		$this->IDRSD_RSD_Txt=$IDRSD_RSD_Txt;
		$this->IDRSD_RSD_Year=$IDRSD_RSD_Year;
		$this->IDRSD_RSD_Class=$IDRSD_RSD_Class;
		$this->IDRSD_RSD_plan=$IDRSD_RSD_plan;
		$this->IDRSD_RSD_Price=$IDRSD_RSD_Price;
		$this->IDRSD_key=$IDRSD_key;
//---------------------------------------------------------------
		$db_booksID=$_SERVER['REMOTE_ADDR'];
		$connected_books=new connected_books($db_booksID);
		$RcbooksPDO=$connected_books->run_connto_books();
//---------------------------------------------------------------
		$IDRSD_Date=date("Y-m-d H:i:s");
//---------------------------------------------------------------
			switch($this->IDRSD_key){
				case "I":
					try{
						$Irc_booksSql="INSERT INTO `rcstore_data` (`RSD_No`, `RSD_Txt`, `RSD_Year`, `RSD_Class`, `RSD_plan`, `RSD_Price`, `RSD_DateTime`) 
									   VALUES ('{$this->IDRSD_RSD_No}', '{$this->IDRSD_RSD_Txt}', '{$this->IDRSD_RSD_Year}', '{$this->IDRSD_RSD_Class}', '{$this->IDRSD_RSD_plan}', '{$this->IDRSD_RSD_Price}', '{$IDRSD_Date}');";
						$RcbooksPDO->exec($Irc_booksSql);
						$IDRSD_Error="Y";
					}catch(PDOException $RcBooks){
						$IDRSD_Error="N";
					}
				break;
				case "D":
					try{
						$Urc_booksSql="DELETE FROM `rcstore_data` WHERE `RSD_No`='{$this->IDRSD_RSD_No}' AND `RSD_Year`='{$this->IDRSD_RSD_Year}'";
						$RcbooksPDO->exec($Urc_booksSql);
						$IDRSD_Error="Y";
					}catch(PDOException $RcBooks){
						$IDRSD_Error="N";
					}				
				break;				
				case "U":
					try{
						$Urc_booksSql="UPDATE `rcstore_data` SET `RSD_Txt`='{$this->IDRSD_RSD_Txt}',`RSD_Class`='{$this->IDRSD_RSD_Class}',`RSD_plan`='{$this->IDRSD_RSD_plan}',`RSD_Price`='{$this->IDRSD_RSD_Price}',`RSD_DateTime`='{$IDRSD_Date}' 
									   WHERE `RSD_No`='{$this->IDRSD_RSD_No}' AND `RSD_Year`='{$this->IDRSD_RSD_Year}'";
						$RcbooksPDO->exec($Urc_booksSql);
						$IDRSD_Error="Y";
					}catch(PDOException $RcBooks){
						$IDRSD_Error="N";
					}				
				break;
				default:
					$IDRSD_Error="N";
			}
			if(isset($IDRSD_Error)){
				$this->IDRSD_Error=$IDRSD_Error;
				$RcbooksPDO=null;
			}else{
				$RcbooksPDO=null;
			}	
		}function RunIntoUpDatRcStoreData(){
			if(isset($this->IDRSD_Error)){
				return $this->IDRSD_Error;
			}else{}
		}
	}
?>