<div class="page-content">
	<div class="content">
		<ul class="breadcrumb">
			<li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
			<li> <a href="<?=base_url('group')?>" class="active"><?=$module_name?></a> </li>
			<li><?=$meta_title; ?></li>
		</ul>

		<div class="row">
       	<div class="col-md-12">
          	<div class="grid simple horizontal red">
             	<div class="grid-title">
	             	<h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
	            </div>
            	<div class="grid-body">
            		<div class="row">  
							<div class="col-md-12">
								<div class="row form-row">
									<div class="col-md-4">
										<label class="form-label">Select Region</label>
										<select name="division" id="division" class="select2 form-control">
											<option value="">Select One</option>
											<?php foreach ($division as $row) { ?>
											<option value="<?=$row->id?>"><?=$row->div_name?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-4">
										<label class="form-label">Select District </label>
										<select name="district" id="district" class="select2 form-control">
											<option value="">Select One</option>
											<?php foreach ($district as $row) { ?>
											<option value="<?=$row->id?>"><?=$row->district_name?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-4">
										<label class="form-label">Select Upazila/Thana </label>
										<select name="upazila" class="select2 form-control">
											<option value="">Select One</option>
											<option value="">Upazila 1</option>
											<option value="">Upazila 2</option>
											<option value="">Upazila 3</option>
											<option value="">Upazila 4</option>
											<option value="">Upazila 5</option>
										</select>
									</div>
								</div>
							</div>
						</div> <!-- /row -->   

						<div class="row" style="margin-top: 30px;">  
							<div class="col-md-6 col-md-offset-3">
								<label class="form-label">Select Scout Group </label>
								<select name="upazila" class="select2 form-control">
									<option value="">Select One</option>
									<option value="">Group Name (Close)</option>
									<option value="">Group Name 2 (Open)</option>
								</select>
							</div>
						</div> <!-- /row -->   

						<div class="row" style="margin-top: 50px;">
							<div class="col-md-12">
							<h3 style="text-align: center; margin-bottom: 20px;"> Choose your scout group or unit </h3>
								<table class="table table-hover table-striped">
									<tbody>
										<tr>
											<td> <a href="#"><i class="-alt fa fa-2x fa-eye fa-fw"></i></a> </td>
											<td>
												<h4 style="margin:0"> <b>Motijheel Primary School Unit</b> </h4>
											</td>
											<td>
												<img src="http://pingendo.github.io/pingendo-bootstrap/assets/user_placeholder.png" class="img-circle" width="45">
											</td>
											<td>
												<h4 style="margin:0"> <b>Member Name</b> </h4>
												<span>Designation</span>
											</td>
											<td>Total 6 Member</td>
											<td>
												<div class="btn-group">
														<a class="btn btn-default" href="#" value="right" type="button">
														<i class="fa fa-fw fa-link"></i>Select for join group</a>
												</div>
											</td>
										</tr>

										<tr>
											<td> <a href="#"><i class="-alt fa fa-2x fa-eye fa-fw"></i></a> </td>
											<td>
												<h4 style="margin:0"> <b>MOTIJHEEL MODEL HIGH SCHOOL AND COLLEGE Unit</b> </h4>
											</td>
											<td>
												<img src="http://pingendo.github.io/pingendo-bootstrap/assets/user_placeholder.png" class="img-circle" width="45">
											</td>
											<td>
												<h4 style="margin:0"> <b>Member Name</b> </h4>
												<span>Designation</span>
											</td>
											<td>Total 6 Member</td>
											<td>
												<div class="btn-group">
														<a class="btn btn-default" href="#" value="right" type="button">
														<i class="fa fa-fw fa-link"></i>Select for join group</a>
												</div>
											</td>
										</tr>

										<tr>
											<td> <a href="#"><i class="-alt fa fa-2x fa-eye fa-fw"></i></a> </td>
											<td>
												<h4 style="margin:0"> <b>Vikarunnesa School Unit</b> </h4>
											</td>
											<td>
												<img src="http://pingendo.github.io/pingendo-bootstrap/assets/user_placeholder.png" class="img-circle" width="45">
											</td>
											<td>
												<h4 style="margin:0"> <b>Member Name</b> </h4>
												<span>Designation</span>
											</td>
											<td>Total 6 Member</td>
											<td>
												<div class="btn-group">
														<a class="btn btn-default" href="#" value="right" type="button">
														<i class="fa fa-fw fa-link"></i>Select for join group</a>
												</div>
											</td>
										</tr>

										<tr>
											<td> <a href="#"><i class="-alt fa fa-2x fa-eye fa-fw"></i></a> </td>
											<td>
												<h4 style="margin:0"> <b>Noterdem Collage Unit</b> </h4>
											</td>
											<td>
												<img src="http://pingendo.github.io/pingendo-bootstrap/assets/user_placeholder.png" class="img-circle" width="45">
											</td>
											<td>
												<h4 style="margin:0"> <b>Member Name</b> </h4>
												<span>Designation</span>
											</td>
											<td>Total 6 Member</td>
											<td>
												<div class="btn-group">
														<a class="btn btn-default" href="#" value="right" type="button">
														<i class="fa fa-fw fa-link"></i>Select for join group</a>
												</div>
											</td>
										</tr>

										<tr>
											<td> <a href="#"><i class="-alt fa fa-2x fa-eye fa-fw"></i></a> </td>
											<td>
												<h4 style="margin:0"> <b> MOTIJHEEL GOVT. BOY'S HIGH SCHOOL AND COLLEGE
</b> </h4>
											</td>
											<td>
												<img src="http://pingendo.github.io/pingendo-bootstrap/assets/user_placeholder.png" class="img-circle" width="45">
											</td>
											<td>
												<h4 style="margin:0"> <b>Member Name</b> </h4>
												<span>Designation</span>
											</td>
											<td>Total 6 Member</td>
											<td>
												<div class="btn-group">
														<a class="btn btn-default" href="#" value="right" type="button">
														<i class="fa fa-fw fa-link"></i>Select for join group</a>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div> <!-- /row --> 

            	</div>  <!-- END GRID BODY -->              
        		</div> <!-- END GRID -->
      	</div>
      </div>


		

		

	</div>
</div>