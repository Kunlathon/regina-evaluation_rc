<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------	
		include("view/database/pdo_data.php");
		include("view/database/pdo_conndatastu.php");
		include("view/database/pdo_admission.php");
		include("view/database/regina_student.php");	
//--------------------------------------------------------------------
//--------------------------------------------------------------------
	if($this->session->userdata("rc_user")==null){
		$this->session->unset_userdata("rc_user");
		exit("<script>window.location='$golink/print_imgstu/error';</script>");		
	}else{
		$LoginKey=$this->session->userdata("rc_user");
		$admin_log=$this->load->database("default",TRUE);		
		$admin_log=$this->db->query("SELECT COUNT(`login_id`) AS `int_uesr` 
									 FROM `login` 
									 WHERE `use_status`='1' 
									 AND `login_id`='{$LoginKey}'");
		foreach($admin_log->result_array() as $log_row){
			if($log_row["int_uesr"]>=1){ ?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->	
		<?php
			$ad_year=filter_input(INPUT_POST,'ad_year');
			$ad_term=filter_input(INPUT_POST,'ad_term');
				if((isset($ad_year,$ad_term))){ ?>
				
			<select class="select-menu-color" name="ad_sudkey" id="ad_sudkey" data-placeholder="รายชื่อนักเรียน..." required="required">
					<option></option>
				<optgroup label="รายชื่อนักเรียน...">

			<?php
				$Print_DataSud=new PrintReginaYear($ad_year,$ad_term);
					foreach($Print_DataSud->RunReginaStuClass() as $rc_key=>$Print_DataSudRow){ 
						$PrintSudRc=new PrintReginaStuDataClass($Print_DataSudRow["rsd_studentid"]);
					?>
					
				<?php
						if(isset($PrintSudRc->PRS_SudId)){ ?>
						
			<option value="<?php echo $PrintSudRc->PRS_SudId;?>"><?php echo $PrintSudRc->PRS_SudId."&nbsp;-&nbsp;".$PrintSudRc->PRS_nameTH."&nbsp;(".$PrintSudRc->PRS_nickTh.")";?></option>						
				
				<?php	}else{} ?>
					
										
			<?php	} ?>
						
				</optgroup>			
			</select>
				
		<?php	}else{
					$this->session->unset_userdata('rc_user');
					exit("<script>window.location='$golink/print_imgstu/error';</script>");					
				}
		?>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->				
	<?php	}else{
				$this->session->unset_userdata('rc_user');
				exit("<script>window.location='$golink/print_imgstu/error';</script>");				
			}
		}							 
	}
?>	
	
	