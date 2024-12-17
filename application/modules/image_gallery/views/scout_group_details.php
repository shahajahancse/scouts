<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('offices/scout_group')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>
      <style type="text/css">
         /*.tg  {border-collapse:collapse;border-spacing:0;}
         .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black; }
         .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top; width: 150px;}
         .tg .tg-d8ej{background-color:#b9c9fe}*/
      </style>

      <style type="text/css">
        .info{margin-left: 25px; color: black;}
        .dt_label{margin-left: 10px; width: 150px; display: block; float: left; color: #796b6b;}
        .dt_data{margin-left: 20px; color: black;}
      </style>
      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?> #
                     <?php if($info->grp_type == 1) {?>
                              <?=$info->grp_reg_num_dis?>
                     <?php } ?>
                     <?php if($info->grp_type == 2) {?>
                              <?=$info->grp_reg_num_upa?>
                     <?php } ?>
                  </span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('offices/scout_group')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scout Group List</a>                       
                  </div>
               </div>
               <div class="grid-body">
                  <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
                  <div><?php //echo validation_errors(); ?></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <a class="close" data-dismiss="alert">&times;</a>
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <div class="row">
                     <div class="col-md-12">                        
                        <ul class="nav nav-tabs" id="tab-01">
                           <li class="active"><a href="#tab_basic">Basic</a></li>
                           <li><a href="#tab_gorup_committee">Group Committee</a></li>
                           <li><a href="#tab_scout_unit">Scout Unit</a></li>
                           <li><a href="#tab_events">Scout Events</a></li>
                        </ul>

                        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                        <div class="tab-content">

                           <div class="tab-pane active" id="tab_basic">
                              <div class="row column-seperation">
                                 <div class="col-md-12" style="margin-bottom: 20px;">
                                    <h3><span class="semi-bold pull-left">Basic Information</span> </h3>
                                    <div class="pull-right">                                       
                                       <a href="<?=base_url('offices/scout_group_update/'.$info->id)?>" class="btn btn-blueviolet btn-xs btn-mini"> Update</a>  
                                    </div>
                                 </div>

                                 <?php
                                    if($info->grp_type == 1) {
                                       $type = '<button class="btn btn-mini btn-info">নিয়ন্ত্রিত স্কাউট গ্রুপ</button> ';
                                       $type .= $info->name;
                                    }else{
                                       $type = '<button class="btn btn-mini btn-info">মুক্ত স্কাউট গ্রুপ</button>';
                                    }
                                 ?>

                                 <div class="col-md-7">
                                    <p> <span class="dt_label">Scout Group Name</span>
                                       <span class="dt_data"><?=$info->grp_name?></span> </p>
                                    <p> <span class="dt_label">Group Type</span>
                                       <span class="dt_data"><?=$type?></span> </p>
                                    <p> <span class="dt_label"> Charter Number</span>
                                       <span class="dt_data"><?=$info->grp_charter?></span> </p>
                                    <p> <span class="dt_label"> Created Date</span>
                                       <span class="dt_data"><?=date_bangla_format($info->grp_created)?></span> </p>

                                    <p> <span class="dt_label">Address</span>
                                       <span class="dt_data"><?=$info->grp_address?></span> </p>
                                    <p> <span class="dt_label">Email</span>
                                       <span class="dt_data"><?=$info->grp_email?></span> </p>
                                    <p> <span class="dt_label">Mobile No.</span>
                                       <span class="dt_data"><?=$info->grp_mobile?></span> </p>

                                    <p> <span class="dt_label">Scout Upazila Name</span>
                                       <span class="dt_data"><?=$info->upa_name?></span> </p>
                                       <?php if($info->grp_type == 1) {?>
                                       <p> <span class="dt_label">Registration No</span>
                                          <span class="dt_data"><?=$info->grp_reg_num_upa?></span> </p>
                                       <p> <span class="dt_label">Registration Date</span>
                                          <span class="dt_data"><?=date_bangla_format($info->grp_reg_upa_date)?></span> </p>
                                       <?php } ?>

                                    <p> <span class="dt_label">Scout District Name</span>
                                       <span class="dt_data"><?=$info->dis_name?></span> </p>
                                       <?php if($info->grp_type == 2) {?>
                                       <p> <span class="dt_label">Registration No</span>
                                          <span class="dt_data"><?=$info->grp_reg_num_dis?></span> </p>
                                       <p> <span class="dt_label">Registration Date</span>
                                          <span class="dt_data"><?=date_bangla_format($info->grp_reg_dis_date)?></span> </p>
                                       <?php } ?>

                                    <p> <span class="dt_label">Scout Region Name</span>
                                       <span class="dt_data"><?=$info->region_name?></span> </p>
                                 </div>

                                 <div class="col-md-5">
                                    <h5> <span class="dt_label"><b>Group Committee</b></span>
                                       <span class="dt_data"></span></h5> 
                                    <?php 
                                    if(!empty($committee_members)){
                                       foreach ($committee_members as $member_row) { 
                                          $designation = $member_row->committee_designation_name !=NULL ? $member_row->committee_designation_name:'-';
                                    ?>
                                    <p> <span class="dt_label"><?=$designation?> </span>
                                       <span class="dt_data"><?=$member_row->first_name?></span></p>
                                 <?php } } ?>
                                 </div>
                                 
                              </div>
                           </div>

                           <div class="tab-pane" id="tab_gorup_committee">
                              <div class="row column-seperation">
                                 <div class="col-md-12" style="margin-bottom: 20px;">
                                    <h3><span class="semi-bold pull-left">Scout Group Committee</span> </h3>
                                    <div class="pull-right">
                                       <a href="<?=base_url('offices/scout_group_create')?>" target="_blank" class="btn btn-blueviolet btn-xs btn-mini">Create Committee </a>
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
                                 <!-- <div class="col-md-6">
                                    <p> <span class="dt_label">Scout ID</span> 
                                    <span class="dt_data">sdsadas</span> </p>
                                 </div>
                                 <div class="col-md-6">
                                    <p> <span class="dt_label">Cub Scouts Experience </span>
                                    <span class="dt_data">dfgfd</span> </p>                      
                                 </div> -->
                              </div>
                           </div>

                           <div class="tab-pane" id="tab_scout_unit">
                              <div class="row column-seperation">
                                 <div class="col-md-12" style="margin-bottom: 20px;">
                                    <h3><span class="semi-bold pull-left">Scout Unit</span> </h3>
                                    <div class="pull-right">
                                       <a href="<?=base_url('offices/scout_unit_create')?>" target="_blank" class="btn btn-blueviolet btn-xs btn-mini">Create Scout Unit </a>
                                    </div>
                                 </div>

                                 <table class="table table-hover table-condensed">
                                    <thead>
                                       <tr>
                                          <th style="width:5%"> SL </th>
                                          <th style="width:20%">Scout Unit Name</th>
                                          <th style="width:20%">Scout Group Name</th>
                                          <th style="width:8%;">Type</th>
                                          <th style="width:10%;">Charter No</th>
                                          <th style="width:10%;">Unit Number</th>
                                          <th style="width:20%;">Action</th>
                                          <!-- <th style="width:5%">Status</th> -->
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
                                          <td><?=$row->grp_name?></td>                           
                                          <td class="v-align-middle"><?=get_scout_unit_type($row->unit_type); ?></td>
                                          <td class="v-align-middle"><?=$row->grp_charter; ?></td>
                                          <td class="v-align-middle"><?=$row->unit_number; ?></td>
                                          <td><a href="<?=base_url('offices/scout_unit_update/'.$row->id)?>" target="_blank" class="btn btn-mini btn-primary"> <i class="fa fa-pencil-square-o"> </i> Edit</a>
                                          <a href="<?=base_url('offices/scout_unit_details/'.$row->id)?>" target="_blank" class="btn btn-mini btn-primary"> <i class="fa fa-info-circle"> </i> Details</a></td>
                                          </tr>
                                       <?php endforeach;?>                      
                                    </tbody>
                                 </table>

                              </div>
                           </div>

                           <div class="tab-pane" id="tab_events">
                              <div class="row column-seperation">
                                 <div class="col-md-12" style="margin-bottom: 20px;">
                                   <h3><span class="semi-bold pull-left">Scout Events</span> </h3>
                                </div>

                                <!-- <div class="col-md-6">
                                    <p> <span class="dt_label">Scout ID</span> 
                                    <span class="dt_data">sdsadas</span> </p>
                                 </div>
                                 <div class="col-md-6">
                                    <p> <span class="dt_label">Cub Scouts Experience </span>
                                    <span class="dt_data">dfgfd</span> </p>                      
                                 </div> -->
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>

               </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>

