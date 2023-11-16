<?php
	//Develop By Kunlathon Saowakhon
	//พัฒนาเว็บไซต์โดย นายกุลธร เสาวคนธ์
	//Tel 0932670639
	//โทร 0932670639
	//Email: mpamese.pc2001@gmail.com , missing_yrc2014@hotmail.com
	//ห้ามใช้ /**/ จะส่งผลให้ค่า return js ทำงานผิดปกติ !!
?>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
	$this->load->library('session');
//--------------------------------------------------------------------    
    include("view/img_user/document/gotolink.php");//-----------------
    $goingtolink=new goingtolink($_SERVER['REMOTE_ADDR']);//----------
    $golink=$goingtolink->Rungotolink();//----------------------------
//--------------------------------------------------------------------	        
        include("view/database/pdo_data.php");
        include("view/database/class_admin.php");
        include("view/database/pdo_summer.php");
        include("view/database/class_summer.php");       
//--------------------------------------------------------------------
//--------------------------------------------------------------------
	if($this->session->userdata("rc_user")==null){
		$this->session->unset_userdata("rc_user");
		exit("<script>window.location='$golink/print_imgstu/error';</script>");		
	}else{
		$LoginKey=$this->session->userdata("rc_user");
		$admin_log=$this->load->database("default",TRUE);		
		$admin_log=$this->db->query("SELECT COUNT(`login_id`) AS `int_uesr` FROM `login` WHERE `use_status`='1' AND `login_id`='{$LoginKey}'");
		foreach($admin_log->result_array() as $log_row){
			if(($log_row["int_uesr"]>=1)){ ?>

	<?php
		$load_year=filter_input(INPUT_POST,'load_year');
		$load_class=filter_input(INPUT_POST,'load_class');
	?>

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<select class="select" name="load_subject" id="load_subject" data-placeholder="วิชา...">
    <option></option>
    <optgroup label="วิชาวัดและประเมินผล">
        <?php
		$RssubjectData=new Print_Rssubject_Data($load_year,$load_class,'0','2');
			if(($RssubjectData->Run_Rssubject_Error()=="NoError")){
				foreach($RssubjectData->Run_Print_Rssubject() as $summer=>$RssubjectDataRow){ ?>
        <option value="<?php echo $RssubjectDataRow["RSD_no"];?>"><?php echo $RssubjectDataRow["RSD_txtTh"];?></option>
        <?php		}
			}else{}
	?>
    </optgroup>
</select>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php	}else{
				$this->session->unset_userdata('rc_user');
				exit("<script>window.location='$golink/print_imgstu/error';</script>");				
			}
		}							 
	}
?>