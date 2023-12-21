<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dahsboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('award/nhq_list')?>" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                     <!-- <a href="<?=base_url('award/circular_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Award Circular</a> -->
                     <?php //} ?>
                  </div>            
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:30%">Award Circular Title</th>
                           <th style="width:18%">Attachment</th>
                           <th style="width:18%">Region End Date</th>                           
                           <th style="width:18%">District End Date</th>
                           <th style="width:18%">Upazila End Date</th>
                           <th style="width:18%">Group End Date</th>
                           <th style="width:7%">Status</th>
                           <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                           <th style="width:7%; text-align: right;">Action</th>
                           <?php //} ?>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=$pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;
                           if($row->status == 1) {
                              $status = '<button class="btn btn-mini btn-info">Enable</button>';
                           }else{
                              $status = '<button class="btn btn-mini btn-danger">Disable</button>';
                           }

                           // if($row->is_current == 1) {
                           //    $expire_status = '<button class="btn btn-mini btn-info">Current</button>';
                           // }else{
                           //    $expire_status = '<button class="btn btn-mini btn-danger">Expired</button>';
                           // }

                           $file='';
                           if($row->attachment_file){
                             $file = '<a href="'.base_url('uploads/award_file/'.$row->attachment_file).'" download="'.$row->attachment_file.'" class="btn btn-mini btn-xs btn-success" style="margin-bottom:2px;">Download</a>';
                          }
                        ?>
                        <tr>
                           <td class="v-align-left"><?=$sl.'.'?></td>
                           <td> <strong><?=$row->circular_title?></strong> </td>
                           <td> <?=$file?> </td>
                           <td class="v-align-middle"><?=date_sort_form($row->region_end_date); ?></td>
                           <td class="v-align-middle"><?=date_sort_form($row->district_end_date); ?></td>
                           <td class="v-align-middle"><?=date_sort_form($row->upazila_end_date); ?></td>
                           <td class="v-align-middle"><?=date_sort_form($row->group_end_date); ?></td>
                           <td> <?=$status?></td>
                           <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                           <td align="right">
                              <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                 <ul class="dropdown-menu pull-right">
                                    <?php 
                                    if($this->ion_auth->is_scout_member()){ 
                                       $res = $this->Award_model->is_apply_nhq_award($row->id);
                                       if(count($res)){
                                       ?> 
                                       <li><a href="<?=base_url("award/recommendation_details_pdf/".encrypt_url($res->id));?>" class="btn btn-blueviolet" target="_blank">Already Applied (My Application)</a> </li>
                                       <?php } else { ?> 
                                       <li><?=anchor("award/apply_nhq/".encrypt_url($row->id), 'Apply for Award')?></li>
                                       <?php } ?>

                                    <?php }elseif($this->ion_auth->is_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_scout_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin()){ ?>
                                    <li><?=anchor("award/recommendation_form/".encrypt_url($row->id), 'Recommendation Form')?></li>
                                    <li><?=anchor("award/recommendation_list/".encrypt_url($row->id), 'Recommendation List')?></li>
                                    <?php } ?>

                                    <!-- <li><?=anchor("award/shapla_cub_approve_list/".encrypt_url($row->id), 'Approve List')?></li> -->
                                 </ul>
                              </div>
                           </td>
                           <?php //} ?>
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>

               <div class="row">
                  <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Award Circular </span></div>
                  <div class="col-sm-8 col-md-8 text-right">
                     <?php echo $pagination['links']; ?>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>

</div> <!-- END Content -->

</div>