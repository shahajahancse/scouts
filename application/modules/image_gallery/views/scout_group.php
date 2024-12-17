<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="javascript:void()" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                  <div class="pull-right">
                     <a href="<?=base_url('offices/scout_group_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scout Group Create </a>
                  </div>
                  <?php } ?>
               </div>

               <div class="grid-body ">
                <?php if($this->ion_auth->is_admin()){ ?>
                    <form method="get" action="<?=$_SERVER['PHP_SELF'];?>">
                      <div class="col-md-12">
                        <div class="row form-row">
                          <div class="col-md-6">
                            <label class="form-label">Select Scout Region</label>
                            <?php 
                            echo form_error('region');
                            $more_attr = 'class="form-control input-sm" id="region"';
                            echo form_dropdown('region', $regions, set_value('region'), $more_attr);
                            ?>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">Select Scout District</label>
                            <?php echo form_error('sc_district_id'); ?>
                            <select name="district" class="sc_district_val form-control input-sm" id="sc_district">
                              <option value="">-- Select One --</option>
                            </select>
                          </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-6">
                           <label class="form-label">Select Scout Upazila</label>
                           <?php //echo form_error('upazila'); ?>
                           <select name="upazila" class="sc_upazila_thana_val form-control input-sm" >
                             <option value="">-- Select One --</option>
                           </select>
                         </div>
                         </div>

                      <div class="pull-right">
                          <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Search</button>
                       </div>
                                     </div>
                    
                  </form>
                   <?php } ?>
                  <div id="infoMessage"><?php //echo $message;?></div>            
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <table class="table table-hover table-condensed">
                     <thead>
                        <tr>
                           <th style="width:5%"> SL </th>
                           <th style="width:10%">Type</th>
                           <th style="width:30%">Scout Group Name</th>
                           <th style="width:15%">Scout District</th>
                           <th style="width:10%">Charter No</th>
                           <th style="width:10%">Created</th>
                           <th style="width:15%;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        if($row->grp_type == 1) {
                           $type = '<button class="btn btn-mini btn-info">নিয়ন্ত্রিত স্কাউট গ্রুপ</button>';
                        }else{
                           $type = '<button class="btn btn-mini btn-primary">মুক্ত স্কাউট গ্রুপ</button>';
                        }

                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td><?=$type?></td>
                           <td> <strong><?=$row->grp_name?> </strong></td>
                           <td><?=$row->dis_name?></td>
                           <td class="v-align-middle"><?=$row->grp_charter; ?></td>
                           <td class="v-align-middle"><?=date_bangla_format($row->grp_created); ?></td>
                           <td><a href="<?=base_url('offices/scout_group_update/'.$row->id)?>" class="btn btn-mini btn-primary"> <i class="fa fa-pencil-square-o"> </i> Edit</a>
                           <a href="<?=base_url('offices/scout_group_details/'.$row->id)?>" class="btn btn-mini btn-primary"> <i class="fa fa-info-circle"> </i> Details</a></td>
                           </tr>
                        <?php endforeach;?>                      
                     </tbody>
                  </table>
               </div>

            </div>
         </div>
      </div>

   </div> <!-- END Content -->

</div>