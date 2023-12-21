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
                  <?php if($this->ion_auth->is_admin()){ ?>
                  <div class="pull-right">
                     <a href="<?=base_url('offices/upazila_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts Upazila Create </a>
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


                  <form method="get" action="">
                     <?php if($this->ion_auth->is_admin()){ ?>                     
                     <div class="col-md-3">
                        <?php $more_attr = 'class="input-sm" id="region"';
                        echo form_dropdown('region', $regions, $_GET['region'], $more_attr);
                        ?>
                     </div> 
                     <?php if(isset($_GET['region'])){ ?>    
                           <div class="col-md-3">
                              <?php $more_attr = 'class="input-sm" id="sc_district"';
                              echo form_dropdown('district', $scout_district, $_GET['district'], $more_attr);
                              ?>
                           </div>
                        <?php }else{ ?>
                           <div class="col-md-3">
                              <select name="district" class="sc_district_val input-sm" id="sc_district">
                                 <option value="">-- Select One --</option>
                              </select>
                           </div>  
                        <?php } ?>
                     <?php } ?>
                     <?php if($this->ion_auth->is_region_admin()){ ?>
                     <div class="col-md-3">
                        <?php $more_attr = 'class="input-sm" id="sc_district"';
                        echo form_dropdown('district', $scout_district, $_GET['district'], $more_attr);
                        ?>
                     </div>  
                     <?php } ?>

                     <div class="col-md-3">
                        <input type="text" name="upaName" value="<?=$_GET['upaName']?>" class="form-control input-sm" placeholder="Upazila Name">
                     </div>
                     <div class="col-md-2">
                        <input type="text" name="uName" value="<?=$_GET['uName']?>" class="form-control input-sm" placeholder="Username">
                     </div>
                     <div class="col-md-1">
                        <div class="pull-right">
                           <button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
                        </div>
                     </div>
                  </form>

                  <div class="clearfix"></div>
                  <hr >

                  <a href="<?=base_url('Offices/upazila_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>
                  <table class="table table-hover table-condensed">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:35%">Scout Upazila Name</th>
                           <th style="width:10%">Username</th>
                           <th style="width:25%">Scout District</th>
                           <th style="width:5%">Status</th>
                           <th style="text-align: right;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        if($row->upa_status == 1) {
                           $status = '<button class="btn btn-mini btn-info">Enable</button>';
                        }else{
                           $status = '<button class="btn btn-mini btn-primary">Disable</button>';
                        }

                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td> <strong><?=$row->upa_name?> </strong></td>
                           <td> <strong><?=$row->username?> </strong></td>
                           <td class="v-align-middle"><?=$row->dis_name; ?></td>
                           <!-- <td class="v-align-middle"><?=$row->region_name; ?></td> -->
                           <td> <?=$status?></td>
                           <td align="right">
                              <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                 <ul class="dropdown-menu pull-right">
                                    <li><a href="<?=base_url("offices/upazila_details/".encrypt_url($row->id))?>" target="_blank">Details Upazila</a></li>
                                    <li><a href="<?=base_url("offices/upazila_user/".encrypt_url($row->id))?>">Upazila Admin User</a></li>
                                    <li><a href="<?=base_url("offices/upazila_update/".encrypt_url($row->id))?>" target="_blank">Update Upazila</a></li>
                                    <li><a href="<?=base_url("offices/upazila_change_password/".encrypt_url($row->id))?>">Change Password</a></li>
                                    <?php if($row->user_id == 0){?>
                                    <li><a href="<?=base_url("offices/upazila_set_username/".encrypt_url($row->id))?>">Set Username</a></li>
                                    <?php } ?>
                                    <?php if($this->ion_auth->is_admin()){?>
                                    <li class="divider"></li>
                                    <li><a href="<?=base_url("offices/upazila_delete/".encrypt_url($row->id))?>" onclick="return confirm('Be careful! Are you sure you want to delete this scouts upazila?');">Delete Upazila</a></li>
                                    <?php } ?>     
                                 </ul>
                              </div>
                           </td>
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