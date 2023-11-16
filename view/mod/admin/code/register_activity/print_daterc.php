	<?php
		include("../../../../database/pdo_data.php");
		include("../../../../database/pdo_conndatastu.php");
		include("../../../../database/pdo_admission.php");
		include("../../../../database/regina_student.php");
	?>	
		<?php
			$txt_year=filter_input(INPUT_POST,'txt_year');
			$txt_term=filter_input(INPUT_POST,'txt_term');
				if(isset($txt_year,$txt_term)){ ?>

		<select class="select-menu-color" name="ra_sudkey" id="ra_sudkey" data-placeholder="รายชื่อนักเรียน..." required="required">
				<option></option>
			<optgroup label="รายชื่อนักเรียน...">
		
			<?php
					$Print_DataSud=new PrintReginaYear($txt_year,$txt_term);
					foreach($Print_DataSud->RunReginaStuClass() as $rc_key=>$Print_DataSudRow){ 
						$PrintSudRc=new Prove_A_PersonRc($Print_DataSudRow["rsd_studentid"]);
					?>
					
				<?php
						if(isset($PrintSudRc->SudKeyId)){ ?>
						
			<option value="<?php echo $PrintSudRc->SudKeyId;?>"><?php echo $PrintSudRc->SudKeyId."&nbsp;-&nbsp;".$PrintSudRc->NameTh."&nbsp;(".$PrintSudRc->NameNicTh.")";?></option>						
				
				<?php	}else{} ?>
					
										
			<?php	} ?>
	
				
			</optgroup>			
		</select>
										
		<?php	}else{}?>

	
		
