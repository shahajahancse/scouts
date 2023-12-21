<div class="page-content">
	<div class="content">
		<div class="page-title"> <i class="fa fa-dashboard"></i>
			<h3>Dashboard</h3>
		</div>

		<div class="row">  
			<div class="col-md-12">
				<?php if($office_info->id){ ?>

				<h2>স্বাগতম, <strong><?=$office_info->upa_name?></strong></h2> <br><br>
				<h3 style="text-align: center; font-weight: bold; "> <?=$office_info->upa_name?> পরিসংখ্যান</h3>
				
				<br>		
				<table class="tg">
					<tr>
						<th class="tg-yw4l" rowspan="2" width="300" style="text-align: center;">শাখা</th>
						<th class="tg-yw4l"  style="text-align: center;">পুরুষ</th>
						<th class="tg-yw4l"  style="text-align: center;">মহিলা</th>
						<th class="tg-yw4l"  style="text-align: center;">অন্যান্য</th>
						<th class="tg-yw4l" style="text-align: center;">সর্বমোট</th>
					</tr>
					<tr>
					</tr>
					<?php foreach ($unit_type as $key => $value) { 
						foreach ($upa_deshboard_data as $ke => $val) { 
							if($val->sc_section_id==$key){
								?>
								<tr>
									<th class="tg-yw4l"  style="text-align: center;"><?php echo $value;?></th>
									<th class="tg-rmb8"  style="text-align: center;"> <?php  echo $val->count_male;?></th>
									<th class="tg-rmb8"  style="text-align: center;"> <?php  echo $val->count_female;?></th>
									<th class="tg-rmb8"  style="text-align: center;"> <?php  echo $val->count_other;?></th>
									<th class="tg-rmb8"  style="text-align: center;"> <?php  echo $val->count_total;?></th>
								</tr>
								<?php } } } ?>
							</table>

							
							<br><br>
							<div class="pull-left">  
								<h3 style="text-align: center; font-weight: bold; "> উপজেলা অফিসের বিস্তারিত তথ্য </h3> 
							</div>
						<!-- <div class="pull-right" style="margin-top: 15px;">  
							<a href="<?=base_url('offices/upazila')?>" class="btn btn-blueviolet btn-mini"> Office Information Update</a>  
						</div> -->
						<div class="clearfix"></div>
						<style type="text/css">
							.tgg  {border-collapse:collapse;border-spacing:0;border: 0}
							.tgg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black;border-color:#898c85;}
							.tgg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top; width: 150px;border-color:#898c85;}
							.tgg .tgg-d8ej{background-color:#b9c9fe}
						</style>

						<?php
						if($office_info->upa_status == 1) {
							$status = '<button class="btn btn-mini btn-info">Enable</button>';
						}else{
							$status = '<button class="btn btn-mini btn-primary">Disable</button>';
						}
						?>
						<table class="tgg">
							<tr>
								<th class="tgg-d8ej"> Username</th>
								<td class="tgg-031e"><strong><?=$office_info->username?></strong></td>
							</tr>
							<tr>
								<th class="tgg-d8ej"> Region Name</th>
								<td class="tgg-031e"><?=$office_info->region_name?></td>
							</tr>
							<tr>
								<th class="tgg-d8ej"> Scout District Name</th>
								<td class="tgg-031e"><?=$office_info->dis_name?></td>
							</tr>
							<tr>
								<th class="tgg-d8ej"> Upazila Name</th>
								<td class="tgg-031e"><?=$office_info->upa_name?></td>
							</tr>
							<tr>
								<th class="tgg-d8ej"> Username</th>
								<td class="tgg-031e"><?=$office_info->username?></td>
							</tr>                
							<tr>
								<th class="tgg-d8ej"> Upazila Phone</th>
								<td class="tgg-031e"><?=$office_info->upa_phone?></td>
							</tr>
							<tr>
								<th class="tgg-d8ej"> Upazila Fax</th>
								<td class="tgg-031e"><?=$office_info->upa_fax?></td>
							</tr>
							<tr>
								<th class="tgg-d8ej"> Upazila Email</th>
								<td class="tgg-031e"><?=$office_info->upa_email?></td>
							</tr>
							<tr>
								<th class="tgg-d8ej"> Upazila Address</th>
								<td class="tgg-031e"><?=$office_info->upa_address?></td>
							</tr>
							<tr>
								<th class="tgg-d8ej"> Upazila Status</th>
								<td class="tgg-031e"><?=$status?></td>
							</tr>
							<tr>
								<th class="tgg-d8ej"> Upazila Description</th>
								<td class="tgg-031e"><?=$office_info->upa_description?></td>
							</tr>
						</table>


						<?php }else{ ?>
						<div class="alert alert-block alert-error fade in">
							<h4 class="alert-heading"><i class="icon-warning-sign"></i> No Access!</h4>
							<p> <h4>Currently you have no region access.</h4> </p>
							<div class="button-set">
								<button class="btn btn-danger btn-cons" type="button">Do this</button>
								<button class="btn btn-white btn-cons" type="button">Or this</button>
							</div>
						</div>
						<?php } ?>			
					</div>
				</div>
				<style type="text/css">
					.tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb; width: 100%}
					.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB; text-align: center;}
					.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
					.tg .tg-rmb8{background-color:#C2FFD6;vertical-align:top}
					.tg .tg-yw4l{vertical-align:middle; text-align: right; font-weight: bold;}
				</style>
				<div class="row">
					<div class="col-md-12" style="padding-bottom: 10px;">
					</div>
				</div>

			</div>
		</div>