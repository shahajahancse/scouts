<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dahsboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('award/circular_list')?>" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; border: 0px solid red;}
         .tg td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
         .tg th{font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
         .tg .tg-ywa9{background-color:#ffffff;vertical-align:top; color: black;}
         .tg .tg-khup{background-color:#efefef;vertical-align:top; color: black; text-align: right;}
         .tg .tg-akf0{background-color:#ffffff;vertical-align:top;color: black;}
         .tg .tg-mtwr{background-color:#efefef;vertical-align:top; font-weight: bold; text-align: center; font-size: 16px;text-decoration: underline;}
      </style>   

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                     <!-- <a href="<?=base_url('award/circular_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Award Circular</a> -->
                     <?php } ?>
                     
                  </div>            
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <!-- <a href="<?=base_url('Committee/national_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a> -->

                  <table class="tg" width="100%">
                  <tr>
                     <th class="tg-khup" width="150"> Circular Name</th>
                     <td class="tg-ywa9" colspan="3"><?=$info->circular_title;?></td>
                     <th class="tg-khup"> Status</th>
                     <td class="tg-ywa9">
                        <?php 
                           if($info->status == 1) {
                              echo $status = '<button class="btn btn-mini btn-info">Enable</button>';
                           }else{
                              echo $status = '<button class="btn btn-mini btn-danger">Disable</button>';
                           }
                        ?>
                     </td>
                  </tr> 
               </table>
               <br>

               <?php $this->load->view('award_search')?>
               <br>

                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:15%">Name </th>                           
                           <th style="width:20%">Recommend Award</th>
                           <th style="width:20%">Region</th>
                           <th style="width:20%">District</th>
                           <th style="width:20%">Scout Group</th>
                           <th>NHQ Verify</th>
                           <th>Region Verify</th>
                           <th>District Verify</th>
                           <th>Upazila Verify</th>
                           <th style="width:7%; text-align: right;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        // $sl=$pagination['current_page'];
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;

                           $exp_region = explode(',', $row->sc_region_name);
                           $exp_disrict = explode(',', $row->sc_district_name);

                           // Status
                           $nhq_verify = event_verify_status($row->verify_nhq);
                           $region_verify = event_verify_status($row->verify_region);
                           $district_verify = event_verify_status($row->verify_district);
                           $upazila_verify = event_verify_status($row->verify_upazila);
                        ?>
                        <tr>
                           <td class="v-align-left"><?=$sl.'.'?></td>
                           <td><strong><?=$row->name_bn?></strong></td>
                           <td><?=$row->award_name_bn?></td>
                           <td><?=$exp_region[1]?></td>
                           <td><?=$exp_disrict[1]?></td>
                           <td><?=$row->sc_group_name?></td>
                           <td><?=$nhq_verify?></td>
                           <td><?=$region_verify?></td>
                           <td><?=$district_verify?></td>
                           <td><?=$upazila_verify?></td>
                           <td align="right">
                              <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                 <ul class="dropdown-menu pull-right">
                                    <li><?=anchor("award/recommendation_details_pdf/".encrypt_url($row->id), 'Details', array('target' => '_blank'))?></li>
                                    <?php 
                                    if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){
                                    ?>
                                    <li><a href="<?=base_url('award/recommendation_status/'.encrypt_url($row->id))?>">Evaluation Status</a></li>
                                    <!-- <li><a href="<?=base_url('award/reject_status/'.encrypt_url($row->id))?>">Reject Status</a></li> -->
                                    <?php } ?>
                                    <!-- <li><a href="#">Update</a></li> -->
                                    <!-- <li><a href="<?=base_url('award/recommendation_status/'.encrypt_url($row->id))?>">Status</a></li> -->
                                    <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                                    <li><?=anchor("award/recommendation_delete/".encrypt_url($row->id)."/".encrypt_url($row->circular_id), 'Delete', 'onclick="return confirm(\'Be careful! Are you sure you want to delete this data?\');"')?></li>
                                    <?php } ?>
                                 </ul>
                              </div>
                           </td>
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>

<?php /*
               <div class="row">
                  <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo count($results); ?> Application </span></div>
                  <div class="col-sm-8 col-md-8 text-right">
                     <?php echo $pagination['links']; ?>
                  </div>
               </div>
*/ ?>
            </div>

         </div>
      </div>
   </div>

</div> <!-- END Content -->

</div>