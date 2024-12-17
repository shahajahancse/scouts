
<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
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
                  <?php /*
                  <a href="<?=base_url('offices/scout_bulk_group_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Bulk Scout Group Create </a>
                  */ ?>
                  <a href="<?=base_url('offices/scout_group_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scout Group Create </a>
               </div>
               <?php } ?>
            </div>

            <div class="grid-body ">

               <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                     <?=$this->session->flashdata('success');?>
                  </div>
               <?php endif; ?>

               <?php if($this->session->flashdata('warning')):?>
                  <div class="alert alert-warning">
                     <?=$this->session->flashdata('warning');?>
                  </div>
               <?php endif; ?>

               <?php $this->load->view('search_view')?> 

               <?php 
               if($results) { 
                  if(!$this->ion_auth->is_vendor()){ ?>        
                  <a href="<?=base_url('offices/scout_group_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>
                  <?php } ?>

               <table class="table table-hover table-condensed">
                  <thead>
                     <tr>
                        <th style="width:5%"> SL </th>
                        <th style="width:30%">Scout Group Name</th>
                        <th style="width:10%">Username</th>
                        <th style="width:25%">Scout Upazila <br> or District</th>
                        <th style="width:15%"></th>
                        <th style="width:12%">Charter No</th>
                        <th style="width:10%">Group Type</th>
                        <th style="text-align: right;">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                     $sl=$pagination['current_page'];
                     foreach ($results as $row):
                        $sl++;
                     if($row->grp_type == 1) {
                        $type = '<button class="btn btn-mini btn-info">নিয়ন্ত্রিত স্কাউট গ্রুপ</button>';
                     }else{
                        $type = '<button class="btn btn-mini btn-primary">মুক্ত স্কাউট গ্রুপ</button>';
                     }

                     $upazila = '';
                     if($row->upa_name){
                        $upazila = explode(',', $row->upa_name);
                        $upazila = $upazila[1];
                     }

                     $district = '';
                     if($row->dis_name){
                        $district = explode(',', $row->dis_name);
                        @$district = $district[1];
                     }
                     ?>
                     <tr>
                        <td class="v-align-middle"><?=$sl.'.'?></td>
                        <td> <strong><?=$row->grp_name?> </strong></td>
                        <td> <strong><?=word_wrap($row->username, 25)?> </strong></td>
                        <td><?=$upazila?> <br> <?=$district?></td>
                        <td></td>
                        <td class="v-align-middle"><?=$row->grp_charter; ?></td>
                        <td><?=$type?></td>
                        <td align="right">
                           <?php if(!$this->ion_auth->is_vendor()){ ?> 

                           <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                              <ul class="dropdown-menu pull-right">
                                 <li><a href="<?=base_url("offices/scout_group_details/".encrypt_url($row->id))?>" target="_blank">Details Scout Group</a></li>
                                 <li><a href="<?=base_url("offices/scout_group_user/".encrypt_url($row->id))?>">Scout Group Admin User</a></li>
                                 <li><a href="<?=base_url("offices/scout_group_update/".encrypt_url($row->id))?>" target="_blank">Edit Scout Group</a></li>

                                 <?php if($row->user_id==0){?>
                                 <li><a href="<?=base_url("offices/scout_group_set_username/".encrypt_url($row->id))?>" target="_blank">Set Username</a></li>
                                 <?php } else { ?>
                                 <li><a href="<?=base_url("offices/scout_group_change_username/".encrypt_url($row->id))?>" target="_blank">Change Username</a></li>
                                 <li><a href="<?=base_url("offices/scout_group_change_password/".encrypt_url($row->id))?>" target="_blank">Change Password</a></li>
                                 <?php } ?>

                                 <?php if($this->ion_auth->is_admin()){?>
                                 <li class="divider"></li>
                                 <li><a href="<?=base_url("offices/scout_group_delete/".encrypt_url($row->id))?>" onclick="return confirm('Be careful! Are you sure you want to delete all information related to this scout group?');">Delete Scout Group</a></li>
                                 <?php } ?>     
                              </ul>
                           </div>

                           <?php }else{ ?>

                           <a href="<?=base_url("offices/scout_group_details/".encrypt_url($row->id))?>" class="btn btn-primary btn-mini" target="_blank">Details</a>

                           <?php } ?>
                           
                        </td>                  
                     </tr>
                  <?php endforeach;?>                      
               </tbody>
            </table>

            <div class="row">
               <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Scout Group </span></div>
               <div class="col-sm-8 col-md-8 text-right">
                  <?php echo $pagination['links']; ?>
               </div>
            </div>

            <?php }else{ ?>

            <div class="clearfix"></div>
            <div class="alert alert-block alert-error fade in">
               <h4 class="alert-heading"><i class="icon-warning-sign"></i>No data found!</h4>
            </div>
            <?php } ?>

         </div>

      </div>
   </div>
</div>
</div> <!-- END Content -->
</div>