<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dahsboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('award/circular_list')?>" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                     <a href="<?=base_url('award/circular_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Award Circular</a>
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
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:30%">Award Circular Title</th>
                           <th style="width:18%">Attachment</th>
                           <th style="width:18%">Award Type</th>
                           <th style="width:18%">Group End Date</th>
                           <th style="width:18%">Upazila End Date</th>
                           <th style="width:18%">District End Date</th>
                           <th style="width:18%">Region End Date</th>                           
                           <th style="width:7%">Status</th>
                           <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                           <th style="width:7%; text-align: right;">Action</th>
                           <?php } ?>
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
                           <td> <?=$row->at_name_en?> </td>
                           <td class="v-align-middle"><?=date_sort_form($row->group_end_date); ?></td>
                           <td class="v-align-middle"><?=date_sort_form($row->upazila_end_date); ?></td>
                           <td class="v-align-middle"><?=date_sort_form($row->district_end_date); ?></td>
                           <td class="v-align-middle"><?=date_sort_form($row->region_end_date); ?></td>
                           <td> <?=$status?></td>
                           <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                           <td align="right">
                              <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                 <ul class="dropdown-menu pull-right">
                                    <li><?=anchor("award/recommendation_list/".encrypt_url($row->id), 'Recommendation List')?></li>
                                    <li><?=anchor("award/circular_update/".encrypt_url($row->id), 'Update')?></li>
                                    <?php if($this->ion_auth->is_admin()){ ?> 
                                    <li><?=anchor("award/national_delete/".encrypt_url($row->id), 'Delete', 'onclick="return confirm(\'Be careful! Are you sure you want to delete this data?\');"')?></li>
                                    <?php } ?>
                                 </ul>
                              </div>
                           </td>
                           <?php } ?>
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