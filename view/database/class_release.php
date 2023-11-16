<?php error_reporting(error_reporting() & ~E_NOTICE); ?>

<?php
	class release_user{
		public $r_user;
		function __construct($r_user){
			$this->r_user=$r_user;
			$db_releaseID=$_SERVER["REMOTE_ADDR"];
			$connpdo_release=new conntopdo_release($db_releaseID);
			$pdo_release=$connpdo_release->getconnto_connto_release();
			$system_release="Error";
			$release_sudsql="select `news_subject`.`SubjectHeading`,`news_subject`.`SubjectStory`,`news_subject`.`SubjectDateDown`,`news_subject`.`SubjectEndDate`
							,`news_subject`.`SubjectNo`,`news_receiver`.`ReceiverUser`,`news_receiver`.`ReceiverTxt` 
							from `news_receiver` 
							join `news_subject` on(`news_receiver`.`SubjectNo`=`news_subject`.`SubjectNo`) 
							where `news_receiver`.`ReceiverUser`='{$this->r_user}';";
				if($release_sudrs=$pdo_release->query($release_sudsql)){
					$release_sudRow=$release_sudrs->Fetch(PDO::FETCH_ASSOC);
					if(is_array($release_sudRow) && count($release_sudRow)){
						$SubjectHeading=$release_sudRow["SubjectHeading"];
						$SubjectStory=$release_sudRow["SubjectStory"];
						$SubjectDateDown=$release_sudRow["SubjectDateDown"];
						$SubjectEndDate=$release_sudRow["SubjectEndDate"];
						$SubjectNo=$release_sudRow["SubjectNo"];
						$ReceiverUser=$release_sudRow["ReceiverUser"];
						$ReceiverTxt=$release_sudRow["ReceiverTxt"];
						$system_release="Not_Error";
//run date time
						$datetime_cr=date("Y-m-d H:i:s");
						$datatime_notrun=strtotime($SubjectEndDate);
						$datatime_run=strtotime($datetime_cr);
						
						if($datatime_run>=$datatime_notrun){
							$print_runtime="OFF";
						}else{
							$print_runtime="ON";
						}
//run date time end 						
					}else{
						$SubjectHeading=null;
						$SubjectStory=null;
						$SubjectDateDown=null;
						$SubjectEndDate=null;
						$SubjectNo=null;
						$ReceiverUser=null;
						$ReceiverTxt=null;
						$print_runtime=null;				
						$system_release="Error";
					}
				}else{
					$system_release="Error";
				}
				if(isset($system_release)){
					$this->SubjectHeading=$SubjectHeading;
					$this->SubjectStory=$SubjectStory;
					$this->SubjectDateDown=$SubjectDateDown;
					$this->SubjectEndDate=$SubjectEndDate;
					$this->SubjectNo=$SubjectNo;
					$this->ReceiverUser=$ReceiverUser;
					$this->ReceiverTxt=$ReceiverTxt;					
					$this->system_release=$system_release;
					$this->print_runtime=$print_runtime;
					$pdo_release=null;
				}else{
					$this->system_release=$system_release;
					$pdo_release=null;
				}	
		}function __destruct(){
			if(isset($system_release)){
				$this->SubjectHeading;
				$this->SubjectStory;
				$this->SubjectDateDown;
				$this->SubjectEndDate;
				$this->SubjectNo;
				$this->ReceiverUser;
				$this->ReceiverTxt;					
				$this->system_release;
				$this->print_runtime;
			}else{
				//-----------------------------------------------------
			}
		}
	}
?>

