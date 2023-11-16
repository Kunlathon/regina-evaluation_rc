<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------
	include("view/database/pdo_weekend.php");
	include("view/database/class_weekend.php");
	
	include("view/database/pdo_data.php");
	include("view/database/pdo_conndatastu.php");
	include("view/database/pdo_admission.php");
	include("view/database/regina_student.php");
//--------------------------------------------------------------------
		if($this->session->userdata("rc_user")==null){
			$this->session->unset_userdata("rc_user");
			exit("<script>window.location='$golink/print_imgstu/error';</script>");
		}else{ ?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
		<?php
			$ws_y=$this->input->post('ws_y');
			$ws_t=$this->input->post('ws_t');   
		?>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
						<select class="select-results-color" data-placeholder="ค้นหารายชื่อผู้ลงทะเบียน" name="ws_stu" id="ws_stu">
							<option></option>
								
		<?php
				$CallDataWeekRc=new PrintWeekendClassRc('ALL',$ws_t,$ws_y,'Array3');
				foreach($CallDataWeekRc->RunPrintWeekendClassRc() as $rc=>$RowDataWeekRc){
//----------------------------------------------------------------------------------------
					$DataSudWeek=new PrintReginaStuData($RowDataWeekRc["wcr_key"]);
//----------------------------------------------------------------------------------------
					?>
					
							<option value="<?php echo @$DataSudWeek->PRS_studentid;?>"><?php echo @$DataSudWeek->PRS_studentid."&nbsp;-&nbsp;".@$DataSudWeek->PRS_nameTH."&nbsp;(".@$DataSudWeek->PRS_nickTh.")";?></option>
			
		<?php	} ?>					
							
				
							


						</select>			
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->			
<?php	} ?>

		
	
