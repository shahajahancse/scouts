<div class="page-content">
	<div class="content">
		<div class="page-title"> <i class="fa fa-dashboard"></i>
			<h3>Dashboard</h3>
		</div>

		<div class="row">  
			<div class="col-md-12">
				<?php if($info->id){ ?>
				<h2>Welcome, <strong><?=$info->grp_name?></strong></h2> <br><br>


				<div class="row">  
					<div class="col-md-12 col-lg-12 col-sm-12">
						<div class="tiles green added-margin  m-b-20">
							<div class="tiles-body">
								<div class="tiles-title text_white_14">Group Registration Overview</div>
								<?php /*
								<div class="widget-stats">
									<div class="wrapper transparent"> 
										<span class="item-title">Total Registration</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_online_register?>" data-animation-duration="700">0</span>
									</div>
								</div>
								*/ ?>
								<div class="widget-stats">
									<div class="wrapper transparent"> 
										<span class="item-title">Total Verified</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_online_member?>" data-animation-duration="700">0</span>
									</div>
								</div>
								<div class="widget-stats ">
									<div class="wrapper transparent"> 
										<span class="item-title">Total Request Pending</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_request_member?>" data-animation-duration="700">0</span> 
									</div>
								</div> 
								<div class="widget-stats ">
									<div class="wrapper last"> 
										<span class="item-title">Total Archived</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_archive_member?>" data-animation-duration="700">0</span> 
									</div>
								</div> 
							</div>      
						</div>  
					</div> 
				</div> <!-- /row -->

				<div class="row">					
					<div class="col-md-12">
						<h3 style="text-align: center; font-weight: bold; "> <?=$info->grp_name?> (Online Member Statistics)</h3>
						<style type="text/css">
							.tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb; width: 100%}
							.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB; text-align: center;}
							.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
							.tg .tg-rmb8{background-color:#C2FFD6;vertical-align:top; text-align: center;}
							.tg .tg-yw4l{vertical-align:middle; text-align: center; font-weight: bold;}
						</style>
						<table class="tg">
							<tr>
								<th class="tg-yw4l" rowspan="2" width="300">Section</th>
								<th class="tg-yw4l">Male</th>
								<th class="tg-yw4l">Female</th>
								<th class="tg-yw4l">Total</th>
							</tr>
							<tr>
							</tr>
							<tr>
								<th class="tg-yw4l">Cub Scout (6 to 10+)</th>
								<th class="tg-rmb8"><?php echo $count_cub_scout_m;?></th>
								<th class="tg-rmb8"><?php echo $count_cub_scout_f?></th>
								<th class="tg-rmb8"><?php echo $count_cub_scout_m+$count_cub_scout_f;?></th>
							</tr>
							<tr>
								<th class="tg-yw4l">Scout (11 to 16)</th>
								<th class="tg-rmb8"><?php echo $count_scout_m;?></th>
								<th class="tg-rmb8"><?php echo $count_scout_f;?></th>
								<th class="tg-rmb8"><?php echo $count_scout_m+$count_scout_f;?></th>
							</tr>
							<tr>
								<th class="tg-yw4l">Rover Scout (17 to 25)</th>
								<th class="tg-rmb8"><?php echo $count_rober_scout_m;?></th>
								<th class="tg-rmb8"><?php echo $count_rober_scout_f;?></th>
								<th class="tg-rmb8"><?php echo $count_rober_scout_m+$count_rober_scout_f;?></th>
							</tr>
							<tr>
								<th class="tg-yw4l"> A. Total </th>
								<th class="tg-rmb8" style="font-weight: bold;">
									<?php echo $A = $count_cub_scout_m + $count_scout_m + $count_rober_scout_m;?>
								</th>
								<th class="tg-rmb8" style="font-weight: bold;">
									<?php echo $A_f = $count_cub_scout_f + $count_scout_f + $count_rober_scout_f;?>
								</th>
								<th class="tg-rmb8" style="font-weight: bold;">
									<?php echo $A+$A_f;?>
								</th>
							</tr>
							<tr>
								<th class="tg-yw4l">Volunteer Leader & Commissioner</th>
								<th class="tg-rmb8"><?php echo $scouter_s_m;?></th>
								<th class="tg-rmb8"><?php echo $scouter_s_f;?></th>
								<th class="tg-rmb8"><?php echo $scouter_s_m+$scouter_s_f;?></th>
							</tr>
							<tr>
								<th class="tg-yw4l">Non Warranted Members</th>
								<th class="tg-rmb8"><?php echo $non_warrant_m;?></th>
								<th class="tg-rmb8"><?php echo $non_warrant_f;?></th>
								<th class="tg-rmb8"><?php echo $non_warrant_m+$non_warrant_f;?></th>
							</tr>
							<tr>
								<th class="tg-yw4l">Warranted Members</th>
								<th class="tg-rmb8"><?php echo $warrant_m;?></th>
								<th class="tg-rmb8"><?php echo $warrant_f;?></th>
								<th class="tg-rmb8"><?php echo $warrant_m+$warrant_f;?></th>
							</tr>
							<tr>
								<th class="tg-yw4l">Professional Executive</th>
								<th class="tg-rmb8"><?php echo $professional_scouts_m;?></th>
								<th class="tg-rmb8"><?php echo $professional_scouts_f;?></th>
								<th class="tg-rmb8"><?php echo $professional_scouts_m+$professional_scouts_f;?></th>
							</tr>
							<tr>
								<th class="tg-yw4l">Support Staff</th>
								<th class="tg-rmb8"><?php echo $support_staff_m;?></th>
								<th class="tg-rmb8"><?php echo $support_staff_f;?></th>
								<th class="tg-rmb8"><?php echo $support_staff_m+$support_staff_f;?></th>
							</tr>
							<tr>
								<th class="tg-yw4l">B. Total</th>
								<th class="tg-rmb8" style="font-weight: bold;">
									<?php echo $B = $non_warrant_m + $scouter_s_m + $professional_scouts_m + $support_staff_m + $warrant_m; ?>
								</th>
								<th class="tg-rmb8" style="font-weight: bold;">
									<?php echo $B_f = $non_warrant_f + $scouter_s_f + $professional_scouts_f + $support_staff_f + $warrant_f; ?>
								</th>
								<th class="tg-rmb8" style="font-weight: bold;">
									<?php echo $B + $B_f;?>
								</th>
							</tr>

							<tr>
								<?php
								$na_male_total = $count_na_cub_scout_m+$count_na_scout_m+$count_na_rober_scout_m;
								$na_female_total = $count_na_cub_scout_f+$count_na_scout_f+$count_na_rober_scout_f;
								$na_grand_total = $na_male_total + $na_female_total;
								?>
								<th class="tg-yw4l">New Applicant</th>
								<th class="tg-rmb8"><?php echo $na_male_total?></th>
								<th class="tg-rmb8"><?php echo $na_female_total?></th>
								<th class="tg-rmb8"><?php echo $na_grand_total;?></th>
							</tr>

							<tr>
								<th class="tg-yw4l" style="text-align: center;font-weight: bold; font-style: italic;">Grand Total(A+B)</th>
								<th class="tg-rmb8" style="text-align: center;font-weight: bold; font-style: italic;">
									<?php echo $c = $A + $B + $na_male_total; ?>
								</th>
								<th class="tg-rmb8" style="text-align: center;font-weight: bold; font-style: italic;">
									<?php echo $c_f = $A_f + $B_f + $na_female_total; ?>
								</th>
								<th class="tg-rmb8" style="text-align: center;font-weight: bold; font-style: italic;">		<?php echo $c + $c_f; ?></th>
							</tr>
						</table>  
					</div> <!-- /col-md-12 -->

				</div>


				<div class="row">
					<div class="col-md-12">
						<style type="text/css">
							.tg2  {border-collapse:collapse;border-spacing:0; width: 100%; margin-top: 20px;}
							.tg2 caption{font-size: 20px; font-weight: bold;color: black; text-align: center;}
							.tg2 td{font-family:Arial, sans-serif;font-size:14px;padding:4px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black; color: black;}
							.tg2 th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;font-weight: bold;color:black;}
							.tg2 .tg-wxkd{background-color:#9698ed;color:#000000;border-color:#6665cd;text-align:center}
							.tg2 .tg-idlo{font-weight:bold;font-size:14px;background-color:#cbcefb;color:#000000;border-color:#9698ed;text-align:right}
							.tg2 .tg-m7qj{font-weight:bold;font-size:14px;background-color:#cbcefb;color:#000000;border-color:#9698ed;text-align:left}
						</style>
						<table class="tg2">
							<caption>Scout Unit List</caption>
							<tr>
								<th style="width:5%;"> SL </th>
								<th style="">Unit Name (English)</th>
								<th style="">Unit Name (Bangla)</th>
								<th style="width:15%; ">Type</th>
								<th style="width:10%;">Action</th>
							</tr>

							<?php 
							$sl=0;
							foreach ($scout_units as $row):
								$sl++;
							if($row->unit_status == 1) {
								$status = '<button class="btn btn-mini btn-info">Enable</button>';
							}else{
								$status = '<button class="btn btn-mini btn-primary">Disable</button>';
							}

							?>
							<tr>
								<td class="v-align-middle"><?=$sl.'.'?></td>
								<td> <strong><?=$row->unit_name?> </strong></td>
								<td><?=$row->unit_name_bn?></td>                           
								<td class="v-align-middle"><?=get_scout_unit_type($row->unit_type); ?></td>
								<td>
									<a href="<?=base_url('offices/scout_unit_details/'.encrypt_url($row->id))?>" target="_blank" class="btn btn-mini btn-primary"> <i class="fa fa-info-circle"> </i> Details</a>
                              <?php /* ?>
                                 <!-- <a href="<?=base_url('offices/scout_unit_update/'.$row->id)?>" target="_blank" class="btn btn-mini btn-primary"> <i class="fa fa-pencil-square-o"> </i> Edit</a> -->
                                 
                                 <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin()){?>
                                 <!-- <a href="<?=base_url("offices/scout_unit_delete/$row->group_id/".$row->id)?>" onclick="return confirm('Be careful! Are you sure you want to delete this scout unit?');" class="btn btn-mini btn-danger"> <i class="fa fa-info-circle"> </i> Delete</a> -->
                                 <?php //} ?> 
                                 <?php */ ?>
                              </td>
                           </tr>
                        <?php endforeach;?>                      
                     </table>
                  </div>
               </div>


               <?php }else{ ?>
               <div class="alert alert-block alert-error fade in">
               	<h4 class="alert-heading"><i class="icon-warning-sign"></i> No Access!</h4>
               	<p> <h4>Currently you have no scout group access.</h4> </p>
						<!-- <div class="button-set">
							<button class="btn btn-danger btn-cons" type="button">Do this</button>
							<button class="btn btn-white btn-cons" type="button">Or this</button>
						</div> -->
					</div>
					<?php } ?>	
				</div>

				
			</div>
		</div>
		<div style="margin-top: 20px;"></div>

	</div>
</div>