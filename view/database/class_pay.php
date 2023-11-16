<?php
	class TestPayGroup{
		public $TPG_Key,$TPG_Year;
		function __construct($TPG_Key,$TPG_Year){
			$this->TPG_Key=$TPG_Key;
			$this->TPG_Year=$TPG_Year;
//-----------------------------------------------------------
			$db_payid=$_SERVER['REMOTE_ADDR'];
			$connpdo_payment=new conntopdo_payment($db_payid);
			$pdo_payment=$connpdo_payment->getconnto_payment_evaluationect();
//-----------------------------------------------------------			
			try{
				$TestPayGroupSql="SELECT `pg_stu`,`pg_year` 
								  FROM `pay_group` 
								  WHERE `pg_stu`='{$this->TPG_Key}' 
								  AND `pg_year`='{$this->TPG_Year}'";
					if($TestPayGroupRs=$pdo_payment->query($TestPayGroupSql)){
						$TestPayGroupRow=$TestPayGroupRs->Fetch(PDO::FETCH_ASSOC);
							if(is_array($TestPayGroupRow) && count($TestPayGroupRow)){
								$pg_stu=$TestPayGroupRow["pg_stu"];
								$pg_year=$TestPayGroupRow["pg_year"];
							}else{
								$pg_stu="-";
								$pg_year="-";
							}
					}else{
						$pg_stu="-";
						$pg_year="-";						
					}
			}catch(PDOException $e){
				$pg_stu="-";
				$pg_year="-";				
			}
			
			if(isset($pg_stu,$pg_year)){
				$this->pg_stu=$pg_stu;
				$this->pg_year=$pg_year;
				$pdo_payment=null;
			}else{
				$pdo_payment=null;
			}
			
		}function RunTestPayGroupStu(){
			if(isset($this->pg_stu)){
				return $this->pg_stu;
			}else{}
		}function RunTestPayGroupYear(){
			if(isset($this->pg_year)){
				return $this->pg_year;
			}else{}			
		}
	}

?>






<?php
//insert_evaluation
	class into_pay{
		public $pay_sql;
		function __construct($pay_sql){
			$this->pay_sql=$pay_sql;
	
			$db_payid=$_SERVER['REMOTE_ADDR'];
			$connpdo_payment=new conntopdo_payment($db_payid);
			$pdo_payment=$connpdo_payment->getconnto_payment_evaluationect();
			
			$sql=$this->pay_sql;
			if($pdo_payment->exec($sql)>0){
				$system_pay="yes";
			}else{
				$system_pay="no";
			}
			unset($pdo_payment);
			$this->system_pay=$system_pay;
		}
		function __destruct(){
			$this->system_pay;
		}		
		
	}
?>

<?php

	class pdo_notpay{
		public $not_pay;
		function __construct($not_pay){
			$this->not_pay=$not_pay;
			
			$db_payid=$_SERVER['REMOTE_ADDR'];
			$connpdo_payment=new conntopdo_payment($db_payid);
			$pdo_payment=$connpdo_payment->getconnto_payment_evaluationect();
			
			$print_pdonotpay=array();
			
			$pod_sql=$this->not_pay;
			if($pod_rs=$pdo_payment->query($pod_sql)){
				$pod_row=$pod_rs->Fetch(PDO::FETCH_ASSOC);
				$print_pdonotpay[]=$pod_row;
			}else{
				
			}
			$pdo_payment=Null;
			$this->print_pdonotpay=$print_pdonotpay;
		}
		function call_pdonotpay(){
			return $this->print_pdonotpay;
		}
	}


?>

<?php
	//show_pay_datafee
	class show_pay_datafee{
		function __construct()
		{
			$db_payid=$_SERVER['REMOTE_ADDR'];
			$connpdo_payment=new conntopdo_payment($db_payid);
			$pdo_payment=$connpdo_payment->getconnto_payment_evaluationect();	
			
			$pay_datafeeArray=array();

			$pay_datafeeSql="SELECT `pdf_plan`, `pdf_pay`, `pdf_level` FROM `pay_datafee` ORDER BY `pay_datafee`.`pdf_level` ASC";
			if($pay_datafeeRs=$pdo_payment->query($pay_datafeeSql)){
			    while($pay_datafeeRow=$pay_datafeeRs->Fetch(PDO::FETCH_ASSOC)){
					$pay_datafeeArray[]=$pay_datafeeRow;
				} 
			}else{
				$pay_datafeeArray[]=Null;
			}
				$pdo_payment=Null;
				$this->pay_datafeeArray=$pay_datafeeArray;
		}	
		function printpay_datafee(){
			return $this->pay_datafeeArray;
		}	
	}
?>

<?php

	class show_pay_mysave202001{
		public $spms202001;
		
		function __construct($spms202001){
			
			$this->spms202001=$spms202001;
			
			$db_payid=$_SERVER['REMOTE_ADDR'];
			$connpdo_payment=new conntopdo_payment($db_payid);
			$pdo_payment=$connpdo_payment->getconnto_payment_evaluationect();
			
			$show_pay_mysave202001SQL="SELECT `p_mysavetxt` FROM `pay_mysave` WHERE `p_mysaveid` = '{$this->spms202001}'";
			
			if($show_pay_mysave202001Rs=$pdo_payment->query($show_pay_mysave202001SQL)){
				$show_pay_mysave202001Row=$show_pay_mysave202001Rs->Fetch(PDO::FETCH_ASSOC);	
				
				$p_mysavetxt=$show_pay_mysave202001Row["p_mysavetxt"];
				
			}else{
				$p_mysavetxt=Null;
			}
			$pdo_payment=Null;
			$this->p_mysavetxt=$p_mysavetxt;
			
		}function print_mysavetxt202001(){
			return $this->p_mysavetxt;		
		}
	}

?>





<?php
//pay_set
	class print_payset{
		function __construct(){
			
			$db_payid=$_SERVER['REMOTE_ADDR'];
			$connpdo_payment=new conntopdo_payment($db_payid);
			$pdo_payment=$connpdo_payment->getconnto_payment_evaluationect();
			
			$paysetSql="SELECT `pset_y`, `pet_t`, `pset_date`, `pset_date` FROM `pay_set`  ORDER BY `pset_y` DESC";
			if($paysetRs=$pdo_payment->query($paysetSql)){
				$paysetRow=$paysetRs->Fetch(PDO::FETCH_ASSOC);
				$pset_y=$paysetRow["pset_y"];
				$pet_t=$paysetRow["pet_t"];
				$pset_date=$paysetRow["pset_date"];
				$pset_save=$paysetRow["pset_date"];
			}else{
				$pset_y=Null;
				$pet_t=Null;
				$pset_date=Null;
				$pset_save=Null;				
				
			}
			$pdo_payment=Null;
			$this->pset_y=$pset_y;
			$this->pet_t=$pet_t;
			$this->pset_date=$pset_date;
			$this->pset_save=$pset_save;
		}
		function __destruct(){
			$this->pset_y;
			$this->pet_t;
			$this->pset_date;
			$this->pset_save;
		}
	}




?>










<?php
//pay_datafee
	class print_pay_datafee{
		public $txt_plan;
		public $txt_level;
		
		function __construct($txt_plan,$txt_level){
			$this->txt_plan=$txt_plan;
			$this->txt_level=$txt_level;
			
			$db_payid=$_SERVER['REMOTE_ADDR'];
			$connpdo_payment=new conntopdo_payment($db_payid);
			$pdo_payment=$connpdo_payment->getconnto_payment_evaluationect();
			
			$print_pay_datafeeSql="SELECT `pdf_pay` 
								   FROM `pay_datafee` 
								   WHERE `pdf_plan` = '{$this->txt_plan}'
								   AND `pdf_level` = '{$this->txt_level}'";
			if($print_pay_datafeeRs=$pdo_payment->query($print_pay_datafeeSql)){
				$print_pay_datafeeRow=$print_pay_datafeeRs->Fetch(PDO::FETCH_ASSOC);	
				$pdf_pay=$print_pay_datafeeRow["pdf_pay"];
			}else{
				$pdf_pay=Null;
			}
			$pdo_payment=Null;
			$this->pdf_pay=$pdf_pay;
		}
		function printpdf_pay(){
			return $this->pdf_pay;
		}
		/*function __destruct(){
			
		}*/
	}
		
	
//stu_grouppay
	class print_stu_grouppay{
		public $txt_stu;
		public $txt_year;
		public $txt_plan;
		public $txt_level;
		function __construct($txt_stu,$txt_year,$txt_plan,$txt_level){
			$this->txt_stu=$txt_stu;
			$this->txt_year=$txt_year;
			$this->txt_plan=$txt_plan;
			$this->txt_level=$txt_level;
			
			$db_payid=$_SERVER['REMOTE_ADDR'];
			$connpdo_payment=new conntopdo_payment($db_payid);
			$pdo_payment=$connpdo_payment->getconnto_payment_evaluationect();
			
			$stu_grouppaySql="select `pay_portion`.`pp_pay`,`pay_status`.`ps_txt`,`pay_status`.`ps_id` 
							  from `pay_group` 
							  join `pay_portion` on(`pay_group`.`pg_group`=`pay_portion`.`pp_portion`)
							  join `pay_status` on (`pay_portion`.`pp_portion`=`pay_status`.`ps_id`)
						      where `pay_group`.`pg_stu`='{$this->txt_stu}' 
							  and `pay_group`.`pg_year`='{$this->txt_year}' 
							  and `pay_portion`.`pp_plan`='{$this->txt_plan}' 
							  and `pay_portion`.`pp_level`='{$this->txt_level}'";
			if($stu_grouppayRs=$pdo_payment->query($stu_grouppaySql)){
				$stu_grouppayRow=$stu_grouppayRs->Fetch(PDO::FETCH_ASSOC);
					if(isset($stu_grouppayRow["pp_pay"])){
						$pp_pay=$stu_grouppayRow["pp_pay"];
						$ps_txt=$stu_grouppayRow["ps_txt"];
						$ps_id=$stu_grouppayRow["ps_id"];						
					}else{
						$pp_pay=Null;
						$ps_txt=Null;
						$ps_id=Null;						
					}
			}else{
				$pp_pay=Null;
				$ps_txt=Null;
			}
			$pdo_payment=Null;
			$this->pp_pay=$pp_pay;
			$this->ps_txt=$ps_txt;
			$this->ps_id=$ps_id;
		}
		function __destruct(){
			$this->pp_pay;
			$this->ps_txt;
			$this->ps_id;			
		}
	}
?>

<?php

//print_dataqrcode

	class print_qrcodepay{
		public $IDStudent;
		public $pd_term;
		public $pd_year;
		
		function __construct($IDStudent,$pd_term,$pd_year){
			$this->IDStudent=$IDStudent;
			$this->pd_term=$pd_term;
			$this->pd_year=$pd_year;






			$print_pay=$pay_ment_sql->prepare("SELECT `Name` FROM `payment_qrcode` WHERE `IDStudent` = '{$this->IDStudent}' AND `pd_term` = '{$this->pd_term}' AND `pd_ year` = '{$this->pd_year}'");
			$print_pay->execute();
				
			if($print_pay->fetchColumn()>0){
				
				$print_txt="yes";
				
				$print_row=$print_pay->fetch(PDO::FETCH_ASSOC);
				$img_pay=$print_row["Name"];
				
			}else{

				$print_txt="no";
				
				$img_pay="";				
				
			}	
			$this->print_txt=$print_txt;
			$this->img_pay=$img_pay;
		}
		function __destruct(){
			$this->print_txt;
			$this->img_pay;
		}	
		
	}
 
?>
