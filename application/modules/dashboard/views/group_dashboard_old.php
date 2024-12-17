<div class="page-content">
	<div class="content">
		<div class="page-title"> <i class="fa fa-dashboard"></i>
			<h3>Dashboard</h3>
		</div>

		<div class="row">  
			<div class="col-md-12">
				<?php if($office_info->id){ ?>

				<h2>স্বাগতম, <strong><?=$office_info->grp_name?></strong></h2> <br><br>
				<h3 style="text-align: center; font-weight: bold; "> <?=$office_info->grp_name?> পরিসংখ্যান</h3>
				<div class="clearfix"></div>
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
						foreach ($group_deshboard_data as $ke => $val) { 
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
							<?php }else{ ?>
							<div class="alert alert-block alert-error fade in">
								<h4 class="alert-heading"><i class="icon-warning-sign"></i> No Access!</h4>
								<p> <h4>Currently you have no group access.</h4> </p>
					<!-- <div class="button-set">
						<button class="btn btn-danger btn-cons" type="button">Do this</button>
						<button class="btn btn-white btn-cons" type="button">Or this</button>
					</div> -->
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