<form name="account_settings" method="post" action="view/mod/admin/code/account_settings/account_settings_code.php" >
<div class="row">
	<div class="col-sm-6 col-md-6 col-lg-6">
		<div class="panel panel-info">
			<div class="panel-heading">ตั้งค่า แท็บรูปแบบ</div>
			<div class="panel-body">
			
	<?php
		$model1="SELECT `model1` FROM `login` WHERE `login_rc`='{$user_login}';";
		$model1Rs=rc_data($model1);
		
		foreach($model1Rs as $rc_key=>$model1Row){
			$txt_model1=$model1Row["model1"];
			if($txt_model1=="navbar navbar-default header-highlight"){ ?>
				<div class="radio icheck-info">
                    <input type="radio" id="info1" checked name="model1" value="navbar navbar-default header-highlight">
                    <label for="info1">Default</label>
                </div>
                <div class="radio icheck-info">
                    <input type="radio" id="info2" name="model1" value="navbar navbar-inverse header-highlight">
                    <label for="info2">Inverse</label>
                </div>				
	<?php	}elseif($txt_model1=="navbar navbar-inverse header-highlight"){ ?>
				<div class="radio icheck-info">
                    <input type="radio" id="info1" name="model1" value="navbar navbar-default header-highlight">
                    <label for="info1">Default</label>
                </div>
                <div class="radio icheck-info">
                    <input type="radio" id="info2" checked name="model1" value="navbar navbar-inverse header-highlight">
                    <label for="info2">Inverse</label>
                </div>				
	<?php	}else{ ?>
				<div class="radio icheck-info">
                    <input type="radio" id="info1" name="model1" value="navbar navbar-default header-highlight">
                    <label for="info1">Default</label>
                </div>
                <div class="radio icheck-info">
                    <input type="radio" id="info2" name="model1" value="navbar navbar-inverse header-highlight">
                    <label for="info2">Inverse</label>
                </div>				
	<?php	}
		}    ?>	
		
	
			
                
			</div>
		</div>	
	</div>
	<div class="col-sm-6 col-md-6 col-lg-6">
		<div class="panel panel-warning">
			<div class="panel-heading">ตั้งค่า รูปแบบระบบ</div>
			<div class="panel-body">
			
	<?php
		$model2="SELECT `model2` FROM `login` WHERE `login_rc`='{$user_login}';";
		$model2Rs=rc_data($model2);
		
		foreach($model2Rs as $rc_key=>$model2Row){
			$txt_model2=$model2Row["model2"];
			if($txt_model2==""){ ?>
                <div class="icheck-default">
					<!--checked-->
                    <input type="radio" checked id="default1" name="model2" value="">
                    <label for="default1">รูปแบบเต็ม</label>
                </div>
                <div class="icheck-default">
					<!--checked-->
                    <input type="radio"  id="default2" name="model2" value="layout-boxed">
                    <label for="default2">รูปแบบมีขอบ</label>
                </div>				
	<?php	}else{ ?>
                <div class="icheck-default">
					<!--checked-->
                    <input type="radio" id="default1" name="model2" value="">
                    <label for="default1">รูปแบบเต็ม</label>
                </div>
                <div class="icheck-default">
					<!--checked-->
                    <input type="radio" checked id="default2" name="model2" value="layout-boxed">
                    <label for="default2">รูปแบบมีขอบ</label>
                </div>				
	<?php	}
		}

	?>	
			

			</div>
		</div>	
	</div>
</div><br>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<center>
			<button type="submit" class="btn btn-success">ตั้งค่า</button>
		</center>
	</div>
</div>
<input type="hidden" name="user_login" value="<?php echo $user_login;?>">
</form>
					