<div class="page-content">
	<div class="content">
		<div class="page-title"> <i class="fa fa-dashboard"></i>
			<h3>Dashboard</h3>
		</div>

		<div class="row">
			<div class="col-md-12">
	
				<h2>Welcome, <strong><?=$info->dis_name_en?></strong></h2>
				<div class="clearfix"></div>

				<div class="row">
					<div class="col-md-6 col-vlg-3 col-sm-6">
						<div class="tiles green added-margin  m-b-20">
							<div class="tiles-body">
								<div class="tiles-title text_white_14">District Registration Overview</div>
								<div class="widget-stats">
									<div class="wrapper transparent">
										<span class="item-title">Total Verified</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$row->verify?>" data-animation-duration="700">0</span>
									</div>
								</div>
								<div class="widget-stats ">
									<div class="wrapper transparent">
										<span class="item-title">Total Request Pending</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$row->request?>" data-animation-duration="700">0</span>
									</div>
								</div>
								<div class="widget-stats ">
									<div class="wrapper last">
										<span class="item-title">Total Archived</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$row->archive?>" data-animation-duration="700">0</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6 col-vlg-3 col-sm-6">
						<div class="tiles red added-margin  m-b-20">
							<div class="tiles-body">
								<div class="tiles-title text_white_14"><?=$info->dis_name_en?></div>
								<?php if($info->dis_type == 1 ){ ?>
								<div class="widget-stats">
									<div class="wrapper transparent">
										<span class="item-title">Total Scout Upazila</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_upazila?>" data-animation-duration="700">0</span>
									</div>
								</div>
								<?php } ?>
								<div class="widget-stats">
									<div class="wrapper last">
										<span class="item-title">Total Scout Group</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_group?>" data-animation-duration="700">0</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- /row -->

			</div>
			<div style="margin-top: 20px;"></div>

		</div>
	</div>
