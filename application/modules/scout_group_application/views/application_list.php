<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
               </div>

               <div class="grid-body ">
                  <div id="infoMessage"><?php //echo $message;?></div>            
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <a class="close" data-dismiss="alert">&times;</a>
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <!-- <a href="<?=base_url('Complain/complain_list_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a> -->
                  <table class="table table-hover table-condensed" id="example">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:10%">Group Type</th>
                           <th style="width:10%">Open Date</th>
                           <th style="width:30%">Group Name</th>
                           <th style="width:20%">Address</th>
                           <th style="width:10%">Region Status</th>
                           <th style="width:10%">District Status</th>
                           <th style="width:10%">Upazila Status</th>
                           <th style="width:24%" class="text-right">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        if(!empty($results)){
                           $i=0;
                           foreach ($results as $row) {
                              // Group Type
                              if($row->grp_type == 1){
                                 $type = 'Academic';
                              }else{
                                 $type = 'Open';
                              }

                              // Secretary status
                              if($row->verify_region == 'Approved') {
                                 $region_verify = '<span class="label label-success">Approved</span>';
                              }elseif($row->verify_region == 'Reject') {
                                 $region_verify = '<span class="label">Reject</span>';
                              }else{
                                 $region_verify = '<span class="label label-important">Pending</span>';
                              }

                              // PS status
                              if($row->verify_district == 'Approved') {
                                 $district_verify = '<span class="label label-success">Approved</span>';
                              }elseif($row->verify_district == 'Reject') {
                                 $district_verify = '<span class="label">Reject</span>';
                              }else{
                                 $district_verify = '<span class="label label-important">Pending</span>';
                              }

                              // PO status
                              if($row->verify_upazila == 'Approved') {
                                 $upazila_verify = '<span class="label label-success">Approved</span>';
                              }elseif($row->verify_upazila == 'Reject') {
                                 $upazila_verify = '<span class="label">Reject</span>';
                              }else{
                                 $upazila_verify = '<span class="label label-important">Pending</span>';
                              }

                              ?>
                              <tr>
                                 <td class="v-align-middle"><?=++$i?>.</td>
                                 <td class="v-align-middle"><?php

                                    echo $type;
                                    ?>
                                 </td>
                                 <td class="v-align-middle"><?=$row->grp_open_date?></td>
                                 <td class="v-align-middle"><?=$row->grp_name_en?></td>
                                 <td class="v-align-middle"><?=$row->grp_address?></td>
                                 <td align="right"> <?=$region_verify?> </td>
                                 <td align="right"> <?=$district_verify?> </td>
                                 <td align="right"> <?=$upazila_verify?> </td>
                                 <td align="right">
                                    <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                       <ul class="dropdown-menu pull-right">
                                          <li><a href="<?=base_url("scout_group_application/details/".encrypt_url($row->id))?>" target="_blank">Application Details</a></li>
                                          
                                          <?php if($row->reg_region_charter_number != NULL AND $row->create_group == 0 AND $this->ion_auth->is_region_admin()){ ?>
                                          <li><a href="<?=base_url("scout_group_application/scout_group_create/".encrypt_url($row->id))?>">Scout Group Create</a></li>
                                          <?php } ?>

                                          <?php if(!$row->create_group){ ?>
                                          <li><a href="<?=base_url("scout_group_application/verify/".encrypt_url($row->id))?>">Verify Status</a></li>
                                          <?php } ?>

                                          <li><a href="<?=base_url("scout_group_application/scout_application_pdf/".encrypt_url($row->id))?>" target="_blank">PDF Download</a></li>
                                       </ul>
                                    </div>
                                    <?php //if($this->ion_auth->is_admin()){ ?> 
                                    <!-- <a href="<?=base_url('complain/delete/'.$row->id);?>" class="btn btn-info btn-xs btn-mini">Delete</a> -->
                                    <?php //} ?>
                                 </td>
                              </tr>
                              <?php
                           }
                        }
                        ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>

   </div> <!-- END ROW -->

</div>
</div>