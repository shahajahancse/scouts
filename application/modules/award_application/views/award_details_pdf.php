<style type="text/css">

table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  color: black;

}

</style>
<div class="page-content">     
   <div class="content">  
     <div style="text-align: center;">
         <div  style="font-size: 20px;">BANGLADESH SCOUTS</div>
         <span>www.scouts.gov.bd</span>
      </div>
      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
             <div class="grid-title">
              <h4 align="center"><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div style="text-align: right;margin-bottom: 5px;">Date: <?= date('d F, Y') ?></div>       
            </div>
          <div class="grid-body">              
            <div class="row">
        
            
			<div class="col-md-6">
                <h4 style="font-weight: bold;">Basic Information</h4>
                <table class="tg">
	                <tr>
	                    <th class="tg-9vst">Full Name:</th>
	                    <td class="tg-031e"><?php echo $info->first_name;?></td>
	                  </tr>
	                  <tr>
	                    <th class="tg-9vst">Gender:</th>
	                    <td class="tg-031e"><?=$info->gender?></td>
	                  </tr>
	                  <tr>
	                    <th class="tg-9vst">Date of Birth:</th>
	                    <td class="tg-031e"><?=date_detail_format($info->dob)?></td>
	                  </tr>
	                  <tr>
	                    <th class="tg-9vst">Blood Group:</th>
	                    <td class="tg-031e"><?=$info->bg_name_en?></td>
	                  </tr>
	                  <tr>
	                    <th class="tg-9vst">Religion:</th>
	                    <td class="tg-031e"><?=get_religion($info->religion_id)?></td>
	                  </tr>
	                  
	                  <tr>
	                    <th class="tg-9vst">Mobile No:</th>
	                    <td class="tg-031e"><?=$info->phone?></td>
	                  </tr>
	                  <tr>
	                    <th class="tg-9vst">Village/House :</th>
	                    <td class="tg-031e"><?=$info->pre_village_house?></td>
	                  </tr>
	                  <tr>
	                    <th class="tg-9vst">Road/Block:</th>
	                    <td class="tg-031e"><?=$info->pre_road_block?></td>
	                  </tr>
	                  <tr>
	                    <th class="tg-9vst">Division:</th>
	                    <td class="tg-031e"><?=$info->pre_div_name?></td>
	                  </tr>
	                  <tr>
	                    <th class="tg-9vst">District:</th>
	                    <td class="tg-031e"><?=$info->pre_district_name?></td>
	                  </tr>
	                  <tr>
	                    <th class="tg-9vst">Upazilla / Thana:</th>
	                    <td class="tg-031e"><?=$info->pre_up_th_name?></td>
	                  </tr>
	                  <tr>
	                    <th class="tg-9vst">Post Office:</th>
	                    <td class="tg-031e"><?=$info->pre_post_office?></td>
	                  </tr>
	                  
	              </table>
          	</div>	
          	<div class="col-md-6">
                <div class="scout-verify-box">
                  <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;">Scout Information</h4>
                  <table class="tg">
                    <tr>
                      <th class="tg-9vst" width="180" style="font-size: 20px;">BS ID</th>
                      <td class="tg-031e" style="font-size: 20px;"><strong><?=$info->scout_id?></strong></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Scout Join Date:</th>
                      <td class="tg-031e"><?=$info->join_date?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Section:</th>
                      <td class="tg-031e"><span class="label label-inverse"><?php echo get_scout_section($info->sc_section_id);?></span></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Scout Badge:</th>
                      <td class="tg-031e"><?=$info->badge_type_name_bn?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Scout Role:</th>
                      <td class="tg-031e"><?=$info->role_type_name_bn?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Scout Unit:</th>
                      <td class="tg-031e"><?=$info->current_unit_name?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Scout Group:</th>
                      <td class="tg-031e"><?=$info->current_grp_name?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">S. Upazila/Thana:</th>
                      <td class="tg-031e"><?=$info->current_upa_name?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">S. District:</th>
                      <td class="tg-031e"><?=$info->current_dis_name?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Scout Region:</th>
                      <td class="tg-031e"><?=$info->current_region_name?></td>
                    </tr>
                  </table>
                </div>
              </div>

              
              <div class="col-md-12">
              	<h4 style="font-weight: bold;">দক্ষতা ব্যাজ ভিত্তিক যোগ্যতা অর্জনের বিবরণ</h4>
                  <table class="table table-bordered">
                       <tr class="bg-success">
                          <th>ক্রম</th>
                          <th>ব্যাজ</th>
                          <th>বিবরণ</th>
                          <th>অর্জনের তারিখ</th>
                          <th>মূল্যায়নকারী</th>
                          <th>যাচাইকারী</th>
                       </tr>
                       <?php for($i=0;$i<sizeof($badge_details);$i++){ ?>
                    
                        <tr>
                          <td><?=$i+1?></td>
                          <td><?=$badge_details[$i]->badge_type_name_bn; ?></td>
                          <td><?=$badge_details[$i]->questions; ?></td>
                          <td><?=date_bangla_format($badge_details[$i]->achive_date); ?></td>
                          <td><?=$badge_details[$i]->examiner_id; ?></td>
                          <td><?=$badge_details[$i]->scout_id; ?></td>
                          
                        </tr>
                        <?php } ?>  
                  </table>

                  <h4><span class="semi-bold">দক্ষতা ও পারদশির্তা ব্যাজ অর্জনের বিবরণ</span></h4>
                  <table class="table table-bordered">
                       <tr class="bg-success">
                          <th>ক্রম</th>
                          <th>ব্যাজ</th>
                          <th>গ্রউপ</th>
                          <th>অর্জনের তারিখ</th>
                          <th>অতিরিক্ত ব্যাজ </th>
                          <th>মূল্যায়নকারী</th>
                          <th>যাচাইকারী</th>
                       </tr>
                       <?php for($i=0;$i<sizeof($expertness);$i++){ ?>
                    
                        <tr>
                          <td><?=$i+1?></td>
                          <td><?=$expertness[$i]->badge_type_name_bn; ?></td>
                          <td><?=$expertness[$i]->expert_group_name; ?></td>
                          <td><?=date_bangla_format($expertness[$i]->achive_date); ?></td>
                          <td><?=$expertness[$i]->extra_badge; ?></td>
                          <td><?=$expertness[$i]->examiner_id; ?></td>
                          <td><?=$expertness[$i]->scout_id; ?></td>
                          
                        </tr>
                        <?php } ?>  
                  </table>

                  <h4><span class="semi-bold">দক্ষতা ও পারদশির্তা ব্যাজ অর্জনের বিবরণ</span></h4>
                  <table class="table table-bordered">
                       <tr class="bg-success">
                          <th>ক্রম</th>
                          <th>ব্যাজ</th>
                          <th>গ্রহণের তারিখ</th>
                          <th>মূল্যায়নকারী</th>
                          <th>যাচাইকারী</th>
                       </tr>
                       <?php for($i=0;$i<sizeof($achievement);$i++){ ?>
                    
                        <tr>
                          <td><?=$i+1?></td>
                          <td><?=$achievement[$i]->badge_type_name_bn; ?></td>
                          <td><?=date_bangla_format($achievement[$i]->achive_date); ?></td>
                          <td><?=$achievement[$i]->examiner_id; ?></td>
                          <td><?=$achievement[$i]->scout_id; ?></td>
                          
                        </tr>
                        <?php } ?>  
                  </table>

				  <h4><span class="semi-bold">অ্যাওয়ার্ড যাচাই বিবরণ</span></h4>
                  <table class="table table-hover table-condensed" id="example">
		              <thead>
		                <tr>
		                  <th style="width:25%">Group Verify</th>
		                  <th style="width:25%">Upazila Verify</th>
		                  <th style="width:25%">District Verify</th>
		                  <th style="width:25%">Region Verify</th>
		                </tr>
		              </thead>
		              <tbody>

		                <tr>
		                  <td class="v-align-middle">
		                  	Status : <?php echo award_status($info->app_grp_approve);?><br>
		                  	Group Admin : <?=$info->group_scout_id?><br>
		                  	Date : <?=date_bangla_format($info->app_grp_approve_date)?><br>
		                  	Comments : <?=$info->app_grp_cmnt?>
		                  </td>
		                  <td class="v-align-middle">
		                  	Status : <?php echo award_status($info->app_upa_approve);?><br>
		                  	Upazila Admin : <?=$info->upazila_scout_id?><br>
		                  	Date : <?=date_bangla_format($info->app_upa_approve_date)?><br>
		                  	Comments : <?=$info->app_upa_cmnt?>
		                  </td>
		                  <td class="v-align-middle">
		                  	Status : <?php echo award_status($info->app_dis_approve);?><br>
		                  	District Admin : <?=$info->district_scout_id?><br>
		                  	Date : <?=date_bangla_format($info->app_dis_approve_date)?><br>
		                  	Comments : <?=$info->app_dis_cmnt?>
		                  </td>
		                  <td class="v-align-middle">
		                  	Status : <?php echo award_status($info->app_rgn_approve);?><br>
		                  	Region Admin : <?=$info->region_scout_id?><br>
		                  	Date : <?=date_bangla_format($info->app_rgn_approve_date)?><br>
		                  	Comments : <?=$info->app_rgn_cmnt?>
		                  </td>
		                  <td class="v-align-middle">
		                </tr>
		                 
		              </tbody>
		            </table>

		            <?php 
                    if(empty($info->app_grp_approve) && $this->ion_auth->is_group_admin())
                    { 
	                  ?>
	                  <div class="row">
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Admin Comment</label>
	                        <input type="text" class="form-control" name="award_cmnts" id="award_cmnts">
	                        <input type="hidden" name="award_id" id="award_id" value="<?= $info->award_app_id ?>">
	                      </div>
	                    </div>
	                  </div>

	                  <div class="row">
	                    <div class="col-md-6">
	                      <div class="row">
	                        <div class="col-md-2">
	                          <button class="btn btn-success" onclick="award_verify('Approved')">Accept</button>
	                        </div>
	                        <div class="col-md-2">
	                          <button class="btn btn-danger" onclick="award_verify('Reject')">Deny</button>
	                        </div>
	                      </div>
	                    </div>
	                  </div>
	                  <?php 
	                    }
	                  ?>


	                  <?php 
                    if(empty($info->app_upa_approve) && $this->ion_auth->is_upazila_admin())
                    { 
	                  ?>
	                  <div class="row">
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Admin Comment</label>
	                        <input type="text" class="form-control" name="award_cmnts" id="award_cmnts">
	                        <input type="hidden" name="award_id" id="award_id" value="<?= $info->award_app_id ?>">
	                      </div>
	                    </div>
	                  </div>

	                  <div class="row">
	                    <div class="col-md-6">
	                      <div class="row">
	                        <div class="col-md-2">
	                          <button class="btn btn-success" onclick="award_verify('Approved')">Accept</button>
	                        </div>
	                        <div class="col-md-2">
	                          <button class="btn btn-danger" onclick="award_verify('Reject')">Deny</button>
	                        </div>
	                      </div>
	                    </div>
	                  </div>
	                  <?php 
	                    }
	                  ?>

	                  <?php 
                    if(empty($info->app_dis_approve) && $this->ion_auth->is_district_admin())
                    { 
	                  ?>
	                  <div class="row">
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Admin Comment</label>
	                        <input type="text" class="form-control" name="award_cmnts" id="award_cmnts">
	                        <input type="hidden" name="award_id" id="award_id" value="<?= $info->award_app_id ?>">
	                      </div>
	                    </div>
	                  </div>

	                  <div class="row">
	                    <div class="col-md-6">
	                      <div class="row">
	                        <div class="col-md-2">
	                          <button class="btn btn-success" onclick="award_verify('Approved')">Accept</button>
	                        </div>
	                        <div class="col-md-2">
	                          <button class="btn btn-danger" onclick="award_verify('Reject')">Deny</button>
	                        </div>
	                      </div>
	                    </div>
	                  </div>
	                  <?php 
	                    }
	                  ?>

	                  <?php 
                    if(empty($info->app_rgn_approve) && $this->ion_auth->is_region_admin())
                    { 
	                  ?>
	                  <div class="row">
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Admin Comment</label>
	                        <input type="text" class="form-control" name="award_cmnts" id="award_cmnts">
	                        <input type="hidden" name="award_id" id="award_id" value="<?= $info->award_app_id ?>">
	                      </div>
	                    </div>
	                  </div>

	                  <div class="row">
	                    <div class="col-md-6">
	                      <div class="row">
	                        <div class="col-md-2">
	                          <button class="btn btn-success" onclick="award_verify('Approved')">Accept</button>
	                        </div>
	                        <div class="col-md-2">
	                          <button class="btn btn-danger" onclick="award_verify('Reject')">Deny</button>
	                        </div>
	                      </div>
	                    </div>
	                  </div>
	                  <?php 
	                    }
	                  ?>
              </div>
            </div>
          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>

