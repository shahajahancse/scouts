<div class="page-content">
	<div class="content">
		<div class="page-title"> <i class="fa fa-dashboard"></i>
			<h3>Dashboard</h3>
		</div>

		<div class="row">  
			<div class="col-md-12">
				<?php if($office_info->id){ ?>

				<style type="text/css">
					.tg  {border-collapse:collapse;border-spacing:0;}
					.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black;}
					.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top; width: 150px;}
					.tg .tg-d8ej{background-color:#b9c9fe}
					#memberDiv td{padding: 5px; color: black;}
					#memberDiv th{padding: 5px; font-weight: bold; color: black;}
				</style>
				<?php
				$img_path = base_url().'offices_img/';
				if($office_info->region_logo != NULL){
					$src= $img_path.$office_info->region_logo;
					$img = "<img src='$src' height='40'>";
				}
				?>

				<h2 class="pull-left">স্বাগতম, <strong><?=$office_info->region_name?></strong>  <?=$img?></h2> 
				<div class="clearfix"></div>

				<br>
				<h3 style="text-align: center; font-weight: bold; "> <?=$office_info->region_name?> পরিসংখ্যান</h3> 
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
						foreach ($region_deshboard_data as $ke => $val) { 
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
							<h3 style="text-align: center; font-weight: bold; "> অফিসের বিস্তারিত তথ্য </h3> 
						</div>

						<div class="clearfix"></div>
						<style type="text/css">
							.tgg  {border-collapse:collapse;border-spacing:0;}
							.tgg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black;}
							.tgg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top; width: 150px;}
							.tgg .tgg-d8ej{background-color:#b9c9fe}
						</style>
						<?php
						if($office_info->region_status == 1) {
							$status = '<button class="btn btn-mini btn-info">Enable</button>';
						}else{
							$status = '<button class="btn btn-mini btn-primary">Disable</button>';
						}

						if($office_info->region_type == 'divisional') {
							$region = '<button class="btn btn-mini btn-primary">Divitional Region</button>';
						}else{
							$region = '<button class="btn btn-mini btn-primary">Special Region</button>';
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
								<th class="tgg-d8ej">Region Logo</th>
								<td class="tgg-031e">
									<?php 
									$img_path = base_url().'offices_img/';
									if($office_info->region_logo != NULL){
										$src= $img_path.$office_info->region_logo;
										echo "<img src='$src' height='100'>";
									}
									?></td>
								</tr>
								<tr>
									<th class="tgg-d8ej"> Region Type</th>
									<td class="tgg-031e"><?=$region?></td>
								</tr>                   
								<tr>
									<th class="tgg-d8ej"> Region Phone</th>
									<td class="tgg-031e"><?=$office_info->region_phone?></td>
								</tr>
								<tr>
									<th class="tgg-d8ej"> Region Fax</th>
									<td class="tgg-031e"><?=$office_info->region_fax?></td>
								</tr>
								<tr>
									<th class="tgg-d8ej"> Region Email</th>
									<td class="tgg-031e"><?=$office_info->region_email?></td>
								</tr>
								<tr>
									<th class="tgg-d8ej"> Region Address</th>
									<td class="tgg-031e"><?=$office_info->region_address?></td>
								</tr>
								<tr>
									<th class="tgg-d8ej"> Region Status</th>
									<td class="tgg-031e"><?=$status?></td>
								</tr>
								<tr>
									<th class="tgg-d8ej"> Region Status</th>
									<td class="tgg-031e"><?=nl2br($office_info->region_description)?></td>
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