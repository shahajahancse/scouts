<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('offices/scout_unit')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>  
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;width: 100%; margin-bottom: 20px;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg .tg-n7df{font-weight:bold;background-color:#ffffff;border-color:inherit;text-align:right;vertical-align:top;width: 90px;}
.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top; color: black; font-weight: bold;}
</style>
      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold">Scouts Unit: <em><?=$info->unit_name; ?></em></span></h4>
                  <div class="pull-right">        
                     <a href="<?=base_url('my_office')?>" class="btn btn-blueviolet btn-xs btn-mini"> My Office</a>
                     <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                     <a href="<?=base_url('offices/scout_group')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scout Group List</a>                  
                     <?php } ?>
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <div class="row">
                     <div class="col-md-12">                        
                        <ul class="nav nav-tabs" id="tab-01">
                           <li class="active"><a href="#tab_scout_members">Scouts Member</a></li>
                        </ul>

                        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                        <div class="tab-content">

                           <div class="tab-pane active" id="tab_scout_members">
                           <table class="tg">
                             <tr>                               
                               <th class="tg-n7df">Group </th>
                               <th class="tg-0pky"><?=$info->grp_name?></th>
                               <td class="tg-n7df">District</td>
                               <td class="tg-0pky"><?=$info->dis_name_en?></td>
                               <th class="tg-n7df" colspan="2">
                               <?php if($this->ion_auth->is_admin()){ ?>
                               <a href="<?=base_url('offices/scout_unit_idcard_pdf'.'/'.encrypt_url($info->id))?>" class="btn btn-primary btn-xs btn-mini pull-right" target="_blank">PDF ZIP Download</a>
                               <?php } ?>
                               </th>
                             </tr>
                             <tr>
                               <td class="tg-n7df">Upazila</td>
                               <td class="tg-0pky"><?=$info->upa_name_en?></td>
                               <td class="tg-n7df">Region</td>
                               <td class="tg-0pky"><?=$info->region_name_en?></td>
                               <th class="tg-n7df">Unit Type</th>
                               <th class="tg-0pky"><?=get_scout_unit_type($info->unit_type)?></th>
                             </tr>
                           </table>

                              <?php if($results) { ?>
                              <table class="table table-hover table-condensed" style="background-color: white;">
                                 <thead>
                                    <tr>
                                       <th> SL </th>
                                       <th width="65">Image</th>
                                       <th>Full Name</th>
                                       <th width="85">Scout ID</th>
                                       <th width="110">Member Type</th>
                                       <th width="80">Section</th>
                                       <th>Missing Info</th>
                                       <th width="100" style="text-align: right;">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                    $sl=0;
                                    foreach ($results as $row):
                                       $sl++;

                                       // Profile Image
                                       $path = base_url().'profile_img/';
                                       if($row->profile_img != NULL){
                                          $img_url = '<img src="'.$path.$row->profile_img.'" height="20">';
                                       }else{
                                          $img_url = '<img src="'.$path.'no-img.png" height="20">';
                                       }
                                       $cont = 'Some content <br> <strong>inside</strong> the popover';
                                    ?>
                                    <tr>
                                       <td class="v-align-middle"><?=$sl.'.'?></td>
                                       <td class="v-align-middle"><?=$img_url?></td>
                                       <td class="v-align-middle"><?php echo $row->first_name;?></td>
                                       <td class="v-align-middle"><strong><span><?=$row->scout_id?> </span></strong>
                                       <td class="v-align-middle"><?php echo $row->member_type_name;?></td>
                                       <td class="v-align-middle"><span class="label label-green"><?=get_scout_section($row->sc_section_id);?></span></td>
                                       <td class="v-align-middle"><?php 
                                       $missing = '';
                                       if($row->scout_id==NULL){
                                          $missing .= '<span style="color:red">Scouts ID missing</span><br>';
                                       }
                                       if($row->first_name==NULL){
                                          $missing .= '<span style="color:red">Name missing</span><br>';
                                       }
                                       if($row->father_name==NULL){
                                          $missing .= '<span style="color:red">Father name missing</span><br>';
                                       }
                                       if($row->mother_name==NULL){
                                          $missing .= '<span style="color:red">Mother name missing</span><br>';
                                       }
                                       // if($row->bg_name_en==NULL){
                                       //    $missing .= '<span style="color:red">Blood group missing</span><br>';
                                       // }
                                       if($row->phone==NULL){
                                          $missing .= '<span style="color:red">Phone number missing</span><br>';
                                       }
                                       if($row->sc_section_id==NULL){
                                          $missing .= '<span style="color:red">Section missing</span><br>';
                                       }
                                       if($row->profile_img==NULL){
                                          $missing .= '<span style="color:red">Profile image missing</span><br>';
                                       }
                                       if($row->dis_name_en==NULL){
                                          $missing .= '<span style="color:red">District name missing</span><br>';
                                       }
                                       if($row->grp_name==NULL){
                                          $missing .= '<span style="color:red">Scouts group missing</span>';
                                       }

                                       echo $missing;

                                       ?></td>
                                       </td>
                                       <td align="right">
                                        <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                         <ul class="dropdown-menu pull-right">
                                          <li><a href="<?=base_url("scouts_member/details/".encrypt_url($row->id))?>" target="_blank">Details</a></li>
                                          <li><a href="<?=base_url("scouts_member/edit/".encrypt_url($row->id))?>" target="_blank">Update</a></li>
                                        </ul>
                                      </div>
                                    </td>
                                    </tr>
                                    <?php endforeach;?>                      
                                 </tbody>
                              </table>
                              <?php }else{ ?>
                              <div class="alert alert-block alert-error fade in">
                                 <h4 class="alert-heading"><i class="icon-warning-sign"></i>No data found!</h4>
                              </div>
                           <?php } ?>
                           </div>

                           <div class="tab-pane" id="tab_activities">
                              <div class="row column-seperation">
                                 <div class="col-md-12" style="margin-bottom: 20px;">
                                    <h3><span class="semi-bold pull-left">Scout Activities</span> </h3>
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