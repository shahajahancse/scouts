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
                     <a href="<?=base_url('offices/district_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts District Create </a>
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
                     <?php } ?>

                     <div class="col-md-3">
                     <input type="text" name="disName" value="<?=$_GET['disName']?>" class="form-control input-sm" placeholder="District Name">                    
                     </div>
                     <div class="col-md-2">
                        <input type="text" name="uName" value="<?=$_GET['uName']?>" class="form-control input-sm" placeholder="Username">
                     </div>
                     <div class="col-md-2">
                        <div class="pull-right">
                           <button type="submit" class="btn btn-blueviolet btn-mini btn-cons"><i class="icon-ok"></i> Search</button>
                        </div>
                     </div>
                  </form>

                  <div class="clearfix"></div>
                  <hr >
                  <a href="<?=base_url('Offices/district_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>
                  <table class="table table-hover table-condensed">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:25%">Scout District Name</th>
                           <th style="width:20%">Scout Region</th>
                           <th style="width:15%">Username</th>
                           <th style="width:10%">District Type</th>
                           <th style="width:5%; text-align: right;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        if($row->dis_status == 1) {
                           $status = '<button class="btn btn-mini btn-info">Enable</button>';
                        }else{
                           $status = '<button class="btn btn-mini btn-primary">Disable</button>';
                        }

                        if($row->dis_type == '1') {
                           $district = '<button class="btn btn-mini btn-primary">Administrative District</button>';
                        }else if($row->dis_type == '2') {
                           $district = '<button class="btn btn-mini btn-primary">Metropolitan District</button>';
                        }else if($row->dis_type == '3') {
                           $district = '<button class="btn btn-mini btn-primary">Rover District</button>';
                        }else if($row->dis_type == '4') {
                           $district = '<button class="btn btn-mini btn-primary">Railway District</button>';
                        }else if($row->dis_type == '5') {
                           $district = '<button class="btn btn-mini btn-primary">Sea District</button>';
                        }else if($row->dis_type == '6') {
                           $district = '<button class="btn btn-mini btn-primary">Air District</button>';
                        }
                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td> <strong> <?=$row->dis_name?> </strong></td>
                           <td class="v-align-middle"><?=$row->region_name; ?></td>
                           <td class="v-align-left"><?=$row->username; ?></td>                           
                           <td> <?=$district?> </td>
                           <td align="right">
                              <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                 <ul class="dropdown-menu pull-right">
                                    <li><a href="<?=base_url("offices/district_details/".encrypt_url($row->id))?>" target="_blank">Details District</a></li>
                                    <li><a href="<?=base_url("offices/district_user/".encrypt_url($row->id))?>">District Admin User</a></li>
                                    <li><a href="<?=base_url("offices/district_update/".encrypt_url($row->id))?>" target="_blank">Update District</a></li>
                                    <li><a href="<?=base_url("offices/district_change_password/".encrypt_url($row->id))?>">Change Password</a></li>

                                    <?php if($this->ion_auth->is_admin()){?>
                                    <li class="divider"></li>
                                    <li><a href="<?=base_url("offices/district_delete/".encrypt_url($row->id))?>" onclick="return confirm('Be careful! Are you sure you want to delete this scouts district?');">Delete District</a></li>
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