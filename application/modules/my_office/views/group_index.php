<div class="page-content">
   <div class="content">
      <div class="row">  
         <div class="col-md-12">
            <?php if($info->id){ ?>

            <?php if($this->session->flashdata('success')):?>
               <div class="alert alert-success">
                  <?php echo $this->session->flashdata('success');;?>
               </div>
            <?php endif; ?>

            <div class="pull-left">  
               <h3 class="headingicon" style="text-align: left; font-weight: bold; "> <i class="fa fa-briefcase" ></i> Scouts Group Office Details  </h3> 
            </div>
            <div class="pull-right" style="margin-top: 15px;">  
               <a href="<?=base_url('my_office/scout_group_update')?>" class="btn btn-blueviolet btn-mini"> Scouts Group Information Update</a> 
               <a href="<?=base_url('my_office/change_password/')?>" class="btn btn-blueviolet btn-mini"> Change Password</a>  
            </div>
            <div class="clearfix"></div>

            <div class="row">
               <div class="col-md-12">                        
                  <ul class="nav nav-tabs" id="tab-01">
                     <li class="active"><a href="#tab_basic">Scouts Group Information</a></li>
                     <li><a href="#tab_scout_unit">Scouts Unit</a></li>
                     <?php /* ?>
                     <!-- <li><a href="#tab_gorup_committee">Group Committee</a></li> -->
                     <!-- <li><a href="#tab_events">Scout Events</a></li> -->
                     <?php */ ?>
                  </ul>

                  <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                  <div class="tab-content">

                     <div class="tab-pane active" id="tab_basic">
                        <div class="row column-seperation">
                           <div class="col-md-12" style="margin-bottom: 20px;">
                              <h3><span class="semi-bold pull-left">Basic Information</span> </h3>
                           </div>
                           <?php
                           if($info->grp_type == 1) {
                              $type = '<button class="btn btn-mini btn-info">নিয়ন্ত্রিত স্কাউট গ্রুপ</button>';
                           }else{
                              $type = '<button class="btn btn-mini btn-info">মুক্ত স্কাউট গ্রুপ</button>';
                           }
                           ?>
                           <div class="col-md-7">
                                    <div class="dt_row"> 
                                       <span class="dt_label">Group Type:</span>
                                       <span class="dt_data"><?=$type?></span> </div>
                                    <div class="dt_row"> 
                                       <span class="dt_label">Institute Name:</span>
                                       <span class="dt_data"><?=$info->institute_name?></span> </div>
                                    <div class="dt_row"> 
                                       <span class="dt_label">Group Name (English):</span>
                                       <span class="dt_data"><?=$info->grp_name?></span> </div>
                                    <div class="dt_row"> 
                                       <span class="dt_label">Group Name (বাংলা):</span>
                                       <span class="dt_data"><?=$info->grp_name_bn?></span> </div>
                                    <div class="dt_row"> 
                                       <span class="dt_label"> Charter Number:</span>
                                       <span class="dt_data"><?=$info->grp_charter?></span> </div>
                                    
                                    <div class="dt_row">
                                       <span class="dt_label">Scouts Upazila:</span>
                                       <span class="dt_data"><?=$info->upa_name?></span> </div>
                                    <div class="dt_row"> 
                                       <span class="dt_label">Registration No:</span>
                                       <span class="dt_data"><?=$info->grp_reg_num_upa?></span> </div>
                                    <div class="dt_row">
                                       <span class="dt_label">Registration Date:</span>
                                       <span class="dt_data"><?=date_bangla_format($info->grp_reg_upa_date)?></span> </div>

                                    <div class="dt_row"> 
                                       <span class="dt_label">Scouts District:</span>
                                       <span class="dt_data"><?=$info->dis_name?></span> </div>
                                    <div class="dt_row"> 
                                       <span class="dt_label">Registration No:</span>
                                       <span class="dt_data"><?=$info->grp_reg_num_dis?></span> </div>
                                    <div class="dt_row"> 
                                       <span class="dt_label">Registration Date:</span>
                                       <span class="dt_data"><?=date_bangla_format($info->grp_reg_dis_date)?></span> </div>
                                    <div class="dt_row"> 
                                       <span class="dt_label">Scouts Region:</span>
                                       <span class="dt_data"><?=$info->region_name?></span> </div>

                                    <div class="dt_row"> 
                                       <span class="dt_label">Address:</span>
                                       <span class="dt_data"><?=$info->grp_address?></span> </div>
                                    <div class="dt_row">
                                       <span class="dt_label">Email:</span>
                                       <span class="dt_data"><?=$info->grp_email?></span> </div>
                                    <div class="dt_row">
                                       <span class="dt_label">Mobile No.:</span>
                                       <span class="dt_data"><?=$info->grp_mobile?></span> </div>
                                 </div>

                                 <div class="col-md-5">
                                    <h5> <span class="dt_label"><b>Group Leader</b></span><span class="dt_data"></span></h5> 

                                    <div class="dt_row"> 
                                       <span class="dt_label">Scout Leader ID:</span>
                                       <span class="dt_data"><?=$info->scout_id?></span></div>
                                    <div class="dt_row"> 
                                       <span class="dt_label">Scout Leader Name:</span>
                                       <span class="dt_data"><?=$info->first_name?></span></div>

                                    <br><br>
                                    <h5> <span class="dt_label"><b>Scouts Group Login</b></span><span class="dt_data"></span></h5> 

                                    <div class="dt_row">
                                       <span class="dt_label">Username:</span>
                                       <span class="dt_data"><?=$info->username?></span></div>                                    
                                    <?php 
                                       //if(!empty($committee_members)){
                                          //foreach ($committee_members as $member_row) { 
                                             //$designation = $member_row->committee_designation_name !=NULL ? $member_row->committee_designation_name:'-';
                                                                                                ?>
                                             <!-- <p> <span class="dt_label"><?php //$designation?> </span>
                                             <span class="dt_data"><?php //$member_row->first_name?></span></p> -->
                                    <?php //} 
                                 //} ?>
                           </div>

                        </div>
                     </div>                     

                     <div class="tab-pane" id="tab_scout_unit">
                        <div class="row column-seperation">
                           <div class="col-md-12" style="margin-bottom: 20px;">
                              <h3><span class="semi-bold pull-left">Scouts Unit</span> </h3>
                              <div class="pull-right">
                                 <a href="<?=base_url('my_office/scout_group_update#scoutsUnit')?>" class="btn btn-blueviolet btn-xs btn-mini">Update Scouts Unit </a>
                              </div>
                           </div>

                           <table class="table table-hover table-condensed">
                              <thead>
                                 <tr>
                                       <th style="width:5%; color: black;"> SL </th>
                                       <th style="color: black;">Unit Name (English)</th>
                                       <th style="color: black;">Unit Name (Bangla)</th>
                                       <th style="width:15%; color: black;">Type</th>
                                       <th style="width:10%;color: black;">Action</th>
                                    </tr>
                              </thead>
                              <tbody>
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
                           </tbody>
                        </table>
                        <br><br>
                     </div>
                  </div>

                  <?php /* ?>

                  <div class="tab-pane" id="tab_gorup_committee">
                     <div class="row column-seperation">
                        <div class="col-md-12" style="margin-bottom: 20px;">
                           <h3><span class="semi-bold pull-left">Scout Group Committee</span> </h3>
                           <div class="pull-right">
                              <a href="<?=base_url('committee/scout_group_create')?>" target="_blank" class="btn btn-blueviolet btn-xs btn-mini">Create Committee </a>
                              <!-- <a href="<?=base_url('offices/scout_unit_create')?>" class="btn btn-blueviolet btn-xs btn-mini">Committee List</a> -->
                           </div>
                        </div>

                        <table class="table table-hover table-condensed">
                           <thead>
                              <tr>
                                 <th style="width:2%"> SL </th>
                                 <th style="width:18%">Committee Name</th>
                                 <th style="width:12%">Start Date</th>
                                 <th style="width:10%">End Date</th>
                                 <th style="width:12%">Group Name</th>
                                 <th style="width:12%">District Office</th>
                                 <th style="width:12%">Region Office</th>
                                 <th style="width:5%">Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php 
                              $sl=0;
                              foreach ($committees as $row):
                                 $sl++;
                              if($row->is_current == 1) {
                                 $status = '<button class="btn btn-mini btn-info">Current</button>';
                              }else{
                                 $status = '<button class="btn btn-mini btn-danger">Expired</button>';
                              }                     
                              ?>
                              <tr>
                                 <td class="v-align-middle"><?=$sl.'.'?></td>
                                 <td> <strong><?=$row->committee_name?> </strong> </td>
                                 <td class="v-align-middle"><?=date_bangla_format($row->session_start_date); ?></td>
                                 <td class="v-align-middle"><?=date_bangla_format($row->session_end_date); ?></td>
                                 <td class="v-align-middle"><?=$row->grp_name; ?></td>
                                 <td class="v-align-middle"><?=$row->dis_name; ?></td>
                                 <td class="v-align-middle"><?=$row->region_name; ?></td>
                                 <td> <?=$status?></td>
                                 <td><a href="<?=base_url('committee/scout_group_update/'.$row->id)?>" target="_blank" class="btn btn-mini btn-primary">Edit</a>
                                    <a href="<?=base_url('committee/scout_group_details/'.$row->id)?>" target="_blank" class="btn btn-mini btn-primary">Details</a></td>
                                 </tr>
                              <?php endforeach;?>                      
                           </tbody>
                        </table>
                     </div>
                  </div>

                  <?php */ ?>

               </div>
            </div>
         </div>

         <?php }else{ ?>
         <div class="alert alert-block alert-error fade in">
            <h4 class="alert-heading"><i class="icon-warning-sign"></i> No Access!</h4>
            <p> <h4>Currently you have no group access.</h4> </p>
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
      <div class="col-md-12" style="padding-bottom: 10px;"></div>
   </div>

</div>
</div>