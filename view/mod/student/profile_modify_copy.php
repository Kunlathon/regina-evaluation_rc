<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4><span class="text-semibold">แก้ไขข้อมูลส่วนตัว</span></h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=final_term" class="btn btn-link  text-size-small"><span>แก้ไขข้อมูลส่วนตัว</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>
<form class="form-horizontal">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading">ข้อมูลนักเรียน</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ชื่อ ไทย</label>							
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="ชื่อ ไทย" size="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">นามสกุล ไทย</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="นามสกุล ไทย" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ชื่อเล่น ไทย</label>							
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">ชื่อเล่น อังกฤษ</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>			
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ชื่อ อังกฤษ</label>							
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">นามสกุล อังกฤษ</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-5">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-5">รหัสประจำตัวประชาชน / G Code</label>							
								<div class="col-lg-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-5">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">วัน/เดือน/ปี เกิด</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="date" class="form-control"  size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-2">
									<div class="form-group">
										<label>กรุ๊ปเลือด</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>					
				</div>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>เชื้อชาติ</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>สัญชาติ</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>ศาสนา</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>				
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">เบอร์โทรศัทพ์</label>							
								<div class="col-lg-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">จำนวนพี่น้องรวม</label>
								<div class="col-lg-6">
									<div class="input-group">
										<input type="number"  min="0" class="form-control"  size="100">
									</div>
								</div>
								<label class="control-label col-lg-2">คน</label>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-5">มีพี่น้องเรียนสถานศึกษานี้</label>
								<div class="col-lg-5">
									<div class="input-group">
										<input type="number"  min="0" class="form-control"  size="100">
									</div>
								</div>
								<label class="control-label col-lg-2">คน</label>
							</div>
                        </fieldset>					
					
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">เป็นบุตรคนที่</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="number"  min="0" class="form-control"  size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					
					</div>
				</div>
				
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
									<div class="form-group">
										<label>ความบกพร่องทางร่างกาย</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>				
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">สถานที่เกิด</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
									<div class="form-group">
										<label>ที่เกิดจังหวัด</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-4">
									<div class="form-group">
										<label>ที่เกิดอำเภอ</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-4">
									<div class="form-group">
										<label>ที่เกิดตำบล</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
				</div>
				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">บ้านเลขที่</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">หมู่ที่</label>
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ซอย</label>
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ถนน</label>
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
				</div>

				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>จังหวัด</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>อำเภอ</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>ตำบล</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">รหัสไปรษณีย์</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
				</div>
				
			</div>
		</div>	
	</div>
</div>
</form>

<form class="form-horizontal">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading">ข้อมูลบิดา</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ชื่อ ไทย</label>							
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">นามสกุล ไทย</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ชื่อเล่น ไทย</label>							
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">ชื่อเล่น อังกฤษ</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>			
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ชื่อ อังกฤษ</label>							
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">นามสกุล อังกฤษ</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-5">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-5">รหัสประจำตัวประชาชน / G Code</label>							
								<div class="col-lg-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-5">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">วัน/เดือน/ปี เกิด</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="date" class="form-control"  size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-2">
									<div class="form-group">
										<label>กรุ๊ปเลือด</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>					
				</div>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>เชื้อชาติ</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>สัญชาติ</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>ศาสนา</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>				
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">เบอร์โทรศัทพ์</label>							
								<div class="col-lg-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				

				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>อาชีพ</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>ช่วงรายได้</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">รายได้/เดือน</label>							
								<div class="col-lg-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>วุฒิการศึกษา</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
				</div>

				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">หน่วยงาน /องค์กร</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">ตำแหน่ง/ภาวะงาน</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-4">
									<div class="form-group">
										<label>จังหวัด ที่ทำงาน</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
				</div>

				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">บ้านเลขที่</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">หมู่ที่</label>
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ซอย</label>
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ถนน</label>
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
				</div>

				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>จังหวัด</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>อำเภอ</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>ตำบล</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">รหัสไปรษณีย์</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
				</div>
				
			</div>
		</div>	
	</div>
</div>
</form>

<form class="form-horizontal">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading">ข้อมูลมารดา</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ชื่อ ไทย</label>							
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">นามสกุล ไทย</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ชื่อเล่น ไทย</label>							
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">ชื่อเล่น อังกฤษ</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>			
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ชื่อ อังกฤษ</label>							
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">นามสกุล อังกฤษ</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-5">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-5">รหัสประจำตัวประชาชน / G Code</label>							
								<div class="col-lg-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-5">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">วัน/เดือน/ปี เกิด</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="date" class="form-control"  size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-2">
									<div class="form-group">
										<label>กรุ๊ปเลือด</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>					
				</div>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>เชื้อชาติ</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>สัญชาติ</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>ศาสนา</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>				
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">เบอร์โทรศัทพ์</label>							
								<div class="col-lg-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				

				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>อาชีพ</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>ช่วงรายได้</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">รายได้/เดือน</label>							
								<div class="col-lg-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>วุฒิการศึกษา</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
				</div>

				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">หน่วยงาน /องค์กร</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">ตำแหน่ง/ภาวะงาน</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-4">
									<div class="form-group">
										<label>จังหวัด ที่ทำงาน</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
				</div>
				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">บ้านเลขที่</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">หมู่ที่</label>
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ซอย</label>
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ถนน</label>
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
				</div>

				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>จังหวัด</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>อำเภอ</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>ตำบล</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">รหัสไปรษณีย์</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
				</div>
				
			</div>
		</div>	
	</div>
</div>
</form>

<form class="form-horizontal">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading">ข้อมูลผู้ปกครอง</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-<?php echo $grid;?>-12">
									<div class="form-group">
										<label>ความสัมพันธ์ (ผู้ปกครอง)</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
				</div>
			
			
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ชื่อ ไทย</label>							
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">นามสกุล ไทย</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ชื่อเล่น ไทย</label>							
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">ชื่อเล่น อังกฤษ</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>			
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ชื่อ อังกฤษ</label>							
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-6">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">นามสกุล อังกฤษ</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				<div class="row">
					<div class="col-<?php echo $grid;?>-5">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-5">รหัสประจำตัวประชาชน / G Code</label>							
								<div class="col-lg-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>
					</div>
					<div class="col-<?php echo $grid;?>-5">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-3">วัน/เดือน/ปี เกิด</label>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="date" class="form-control"  size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-2">
									<div class="form-group">
										<label>กรุ๊ปเลือด</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>					
				</div>				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>เชื้อชาติ</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>สัญชาติ</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>ศาสนา</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>				
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">เบอร์โทรศัทพ์</label>							
								<div class="col-lg-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
				</div>
				

				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>อาชีพ</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>ช่วงรายได้</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">รายได้/เดือน</label>							
								<div class="col-lg-7">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>วุฒิการศึกษา</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
				</div>

				<div class="row">
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">หน่วยงาน /องค์กร</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-4">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">ตำแหน่ง/ภาวะงาน</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>					
					</div>
					<div class="col-<?php echo $grid;?>-4">
									<div class="form-group">
										<label>จังหวัด ที่ทำงาน</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
				</div>				
				
				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">บ้านเลขที่</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">หมู่ที่</label>
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ซอย</label>
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-2">ถนน</label>
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
				</div>

				<div class="row">
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>จังหวัด</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>อำเภอ</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-3">
									<div class="form-group">
										<label>ตำบล</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>						
					</div>
					<div class="col-<?php echo $grid;?>-3">
						<fieldset class="content-group">
							<div class="form-group">
								<label class="control-label col-lg-4">รหัสไปรษณีย์</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
									</div>
								</div>
							</div>
                        </fieldset>						
					</div>
				</div>
				
			</div>
		</div>	
	</div>
</div>
</form>

<form class="form-horizontal">
<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-success">
			<div class="panel-heading">ข้อมูลเพิ่มเติม</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-<?php echo $grid;?>-6">
									<div class="form-group">
										<label>ความสัมพันธ์ ครอบครัว</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-6">
									<div class="form-group">
										<label>ผู้รับผิดชอบ ค่าธรรมทางการศึกษา</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
				</div>
				
				<div class="row">
					<div class="col-<?php echo $grid;?>-5">
									<div class="form-group">
										<label>การเดินทาง ไปและกลับ โรงเรียน</label>
										<select data-placeholder="Select a State..." class="select-size-lg">
											<option></option>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="WY">Wyoming</option>
											</optgroup>
											<optgroup label="Central Time Zone">
												<option value="AL">Alabama</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
											</optgroup>
											<optgroup label="Eastern Time Zone">
												<option value="CT">Connecticut</option>
												<option value="FL">Florida</option>
												<option value="MA">Massachusetts</option>
												<option value="WV">West Virginia</option>
											</optgroup>
										</select>
									</div>					
					</div>
					<div class="col-<?php echo $grid;?>-7">
						<div class="col-<?php echo $grid;?>-6">
							<fieldset class="content-group">
								<div class="form-group">
									<label class="control-label col-lg-4">ชื่อ คนขับรถ</label>
									<div class="col-lg-8">
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
										</div>
									</div>
								</div>
							</fieldset>							
						</div>
						<div class="col-<?php echo $grid;?>-6">
							<fieldset class="content-group">
								<div class="form-group">
									<label class="control-label col-lg-4">หมายเลขติดต่อ คนขับรถ</label>
									<div class="col-lg-8">
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Left addon" size="100" maxlength="100">
										</div>
									</div>
								</div>
							</fieldset>						
						</div>
					
					</div>
				</div>
				
				
				
				
			</div>
		</div>	
	</div>
</div>
</form>

