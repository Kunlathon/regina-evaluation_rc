<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="breadcrumb-line breadcrumb-line-component">
			<ul class="breadcrumb">
				<h4> <span class="text-semibold">คอนเสิร์ต&nbsp;เรยีนาเชลีวิทยาลัย&nbsp;>&nbsp;</span>สรุปยอดขาย&nbsp;</h4>
			</ul>
			<ul class="breadcrumb-elements">
				<div class="heading-btn-group">
					<a href="./?evaluation_mod=home" class="btn btn-link  text-size-small"><span>หน้าแรก</span></a>
					<a class="btn btn-link  text-size-small"><span>/</span></a>
					<a class="btn btn-link  text-size-small"><span>&nbsp;สรุปยอดขาย&nbsp;</span></a>
				</div>
			</ul>
		</div>
	</div>
</div><br>

<div class="row">
	<div class="col-<?php echo $grid;?>-12">
		<div class="panel panel-body border-top-grey">
			<div class="row">
				<div class="col-<?php echo $grid;?>-6">
					<fieldset class="content-group">
						<div class="form-group">
							<label class="control-label col-<?php echo $grid;?>-2">เลือกปี</label>
							<div class="col-<?php echo $grid;?>-10">
								<select class="select-menu-color" name="CP_Year" id="CP_Year" data-style="bg-grey-600" data-placeholder="เลือกปี...">
									<option value="2022">2022</option>
								</select>
							</div>
						</div>
					</fieldset>
				</div>
				<div class="col-<?php echo $grid;?>-6">
					<fieldset class="content-group">
						<div class="form-group">
							<button type="button" name="CP_See" id="CP_See" class="btn btn-default">เรียกดู</button>
						</div>
					</fieldset>
				</div>
			</div>					
		</div>
	</div>
</div>


<div id="CPData"></div>