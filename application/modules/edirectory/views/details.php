<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dahsboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('edirectory/listing')?>" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>
      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0;}
         .tg td{font-family:Arial, sans-serif;font-size:14px;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc;}
         .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc; font-weight: bold; vertical-align: top}
         .tg .tg-9vst{background-color:#efefef;text-align:right; width: 250px;}
      </style>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">    
                     <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                     <a href="<?=base_url('edirectory/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Contact</a> 
                     <a href="<?=base_url('edirectory/listing')?>" class="btn btn-blueviolet btn-xs btn-mini"> E-Directory Contact List</a>
                     <!-- <a href="<?=base_url('edirectory/edit/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Edit Contact</a> -->

                     <?php } elseif($this->ion_auth->is_region_admin()) { ?> 
                     <a href="<?=base_url('edirectory/create_contact_region')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Contact</a> 
                     <a href="<?=base_url('edirectory/listing_region')?>" class="btn btn-blueviolet btn-xs btn-mini"> E-Directory Contact List</a>

                     <?php } elseif($this->ion_auth->is_district_admin()) { ?> 
                     <a href="<?=base_url('edirectory/create_contact_district')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Contact</a> 
                     <a href="<?=base_url('edirectory/listing_district')?>" class="btn btn-blueviolet btn-xs btn-mini"> E-Directory Contact List</a>

                     <?php } elseif($this->ion_auth->is_upazila_admin()) { ?> 
                     <a href="<?=base_url('edirectory/create_contact_upazila')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Contact</a> 
                     <a href="<?=base_url('edirectory/listing_upazila')?>" class="btn btn-blueviolet btn-xs btn-mini"> E-Directory Contact List</a>

                     <?php } elseif($this->ion_auth->is_group_admin()) { ?> 
                     <a href="<?=base_url('edirectory/create_contact_scout_group')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Contact</a> 
                     <a href="<?=base_url('edirectory/listing_scout_group')?>" class="btn btn-blueviolet btn-xs btn-mini"> E-Directory Contact List</a>

                     <?php } ?>
                  </div>
               </div>
               <div class="grid-body">              
                  <div class="row">
                     <div class="col-md-12">
                        <div class="scout-verify-box">
                           <table class="tg">
                              <tr>
                                 <th class="tg-9vst">Member Type:</th>
                                 <td class="tg-031e"><?=$info->scout_id != NULL ? 'Scout Member':'No Scout ID'?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">Office Level:</th>
                                 <td class="tg-031e"><?=$info->office_type_name?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">Scouts Designation:</th>
                                 <td class="tg-031e"><?=$info->committee_designation_name_en?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">Image:</th>
                                 <td class="tg-031e"><?php
                                    // Profile Image
                                    if($info->scout_id != NULL){
                                       echo $img_url = '<img src="'.base_url('profile_img/'.$info->profile_img).'" height="50">';
                                    }elseif($info->image_file != NULL){
                                       echo $img_url = '<img src="'.base_url('uploads/edirectory_img/'.$info->image_file).'" height="50">';
                                    }else{
                                       echo $img_url = '<img src="'.base_url('uploads/edirectory_img/no-image.jpg').'" height="50">';
                                    }                               
                                    ?>
                                 </td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">Name (English):</th>
                                 <td class="tg-031e"><?=$info->name?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">Name (Bangla):</th>
                                 <td class="tg-031e"><?=$info->name_bn?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">Gender:</th>
                                 <td class="tg-031e"><?=$info->gender?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">Blood Group:</th>
                                 <td class="tg-031e"><?=$info->bg_name_en?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">Phone/Mobile (Personal):</th>
                                 <td class="tg-031e"><?=$info->phone?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">Phone/Mobile (Official):</th>
                                 <td class="tg-031e"><?=$info->phone_official?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">Email Address (Personal):</th>
                                 <td class="tg-031e"><?=$info->email?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">Email Address (Official):</th>
                                 <td class="tg-031e"><?=$info->email_official?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">Present Address:</th>
                                 <td class="tg-031e"><?=$info->address?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">Professional Designation:</th>
                                 <td class="tg-031e"><?=$info->profe_desig?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">Other's Info:</th>
                                 <td class="tg-031e"><?=$info->others_info?></td>
                              </tr>                              
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>  <!-- END GRID BODY -->              
         </div> <!-- END GRID -->
      </div> <!-- /END ROW -->

   </div> <!-- /content -->
</div> <!-- /page-content -->
