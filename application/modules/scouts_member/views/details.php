<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('scouts_member/all')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0;}
      /*.tg caption{font-weight: bold; text-decoration: underline; font-size: 20px; color: black;}*/
      .tg td{font-family:Arial, sans-serif;font-size:14px;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc; color: black;}
      .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc; font-weight: bold; vertical-align: top}
      .tg .tg-9vst{background-color:#efefef;text-align:right;}
      .tg .tg-9vst2{background-color:#efefef;text-align:center;}
    </style>

    <?php
    $sc_cub   = $info->sc_cub =='Yes'? $info->sc_cub:'No';
    $sc_scout = $info->sc_scout =='Yes'? $info->sc_scout:'No';
    $sc_rover = $info->sc_rover =='Yes'? $info->sc_rover:'No';
    ?>

    <div class="row">
     <div class="col-md-12">
      <div class="grid simple horizontal red">
       <div class="grid-title">
        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
        <div class="pull-right"> 
          <?php if($info->member_id == 2){ ?>
            <?php if($info->sc_section_id == '1'){ ?>
              <a href="<?=base_url('program/cub_program/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Cub Program</a>
            <?php }elseif($info->sc_section_id == '2'){ ?>
              <a href="<?=base_url('program/scout_program/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts Program</a>
            <?php }elseif($info->sc_section_id == '3'){ ?>
              <a href="<?=base_url('program/rover_program/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Rover Scouts Program</a>
            <?php } ?>
          <?php }elseif($info->member_id == 8 || $info->member_id == 9 || $info->member_id == 10 || $info->member_id == 12){ ?> 
              <a href="<?=base_url('program/leader_progress/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Leader Progress</a>
          <?php } ?>

          <a href="<?=base_url('scouts_member/all')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts Member List</a>  
      </div>
    </div>
    
    <div class="grid-body">
      <a href="<?=base_url('scouts_member/scout_member_details_pdf'.'/'.encrypt_url($id))?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>
      <div class="row">
        <div class="col-md-12">

          <div class="scout-verify-box">

            <table>
              <tr>
                <td width="45%" valign="top">
                  <table class="tg">
                    <h4 style="font-weight: bold; border-bottom: 1px solid #ccc; margin-right: 20px;">Personal Information</h4>
                    <!-- <caption>Personal Information</caption> -->                    
                    <tr>
                      <th class="tg-9vst">Profile Image:</th>
                      <td class="tg-031e">
                        <?php
                        $path = base_url().'profile_img/';
                        if($info->profile_img != NULL){
                          $img_url = '<img src="'.$path.$info->profile_img.'" width="90" style="border:1px solid #ccc; padding:3px;">';
                        }else{
                          $img_url = '<img src="'.$path.'no-img.png" width="90" style="border:1px solid #ccc; padding:3px;">';
                        }
                        echo $img_url;
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Full Name:</th>
                      <td class="tg-031e"><?php echo $info->first_name;?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Full Name (Bangla):</th>
                      <td class="tg-031e"><?php echo $info->full_name_bn;?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Father's Name:</th>
                      <td class="tg-031e"><?=$info->father_name?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Father's Name (bn):</th>
                      <td class="tg-031e"><?=$info->father_name_bn?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Mother's Name:</th>
                      <td class="tg-031e"><?=$info->mother_name?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Mother's Name (bn):</th>
                      <td class="tg-031e"><?=$info->mother_name_bn?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Gender:</th>
                      <td class="tg-031e"><?=$info->gender?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Date of Birth:</th>
                      <td class="tg-031e"><?=date_detail_format($info->dob)?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Blood Group:</th>
                      <td class="tg-031e"><?=$info->bg_name_en?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Religion:</th>
                      <td class="tg-031e"><?=get_religion($info->religion_id)?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">National ID:</th>
                      <td class="tg-031e"><?=$info->nid?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Birth ID:</th>
                      <td class="tg-031e"><?=$info->birth_id?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Occupation:</th>
                      <td class="tg-031e"><?= empty($info->occp_others)?$info->occupation_name:$info->occp_others?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Mobile No:</th>
                      <td class="tg-031e"><?=$info->phone?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Telephone No:</th>
                      <td class="tg-031e"><?=$info->phone2?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Emergency Contact:</th>
                      <td class="tg-031e"><?=$info->phone_emergency?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Email:</th>
                      <td class="tg-031e"><?=$info->email?></td>
                    </tr>
                    <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                    <tr>
                      <th class="tg-9vst">User Group:</th>
                      <td class="tg-031e">
                        <?php  
                        foreach($currentGroups as $group) {
                          // echo $group->description;
                          echo '<span class="btn btn-primary btn-xs btn-mini" style="background-color:#6b64d0;margin-bottom:1px;cursor: auto;">'.htmlspecialchars($group->description,ENT_QUOTES,'UTF-8').'</span>';
                          echo '&nbsp;';
                        }  
                        ?>
                      </td>
                    </tr>  
                    <?php } ?>
                    <tr>
                      <th colspan="2" class="tg-9vst2" style="color: black; font-size: 16px;">Present Address</th>
                    </tr>                  
                    <tr>
                      <th class="tg-9vst">Village/House No or Name (EN):</th>
                      <td class="tg-031e"><?=$info->pre_village_house?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Village/House No or Name (BN):</th>
                      <td class="tg-031e"><?=$info->pre_village_house_bn?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Road/Block/Sector (EN):</th>
                      <td class="tg-031e"><?=$info->pre_road_block?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Road/Block/Sector (BN):</th>
                      <td class="tg-031e"><?=$info->pre_road_block_bn?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Post Office:</th>
                      <td class="tg-031e"><?=$info->pre_post_office==0?'':$info->pre_post_office?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Upazilla / Thana:</th>
                      <td class="tg-031e"><?=$info->pre_up_th_name?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">District:</th>
                      <td class="tg-031e"><?=$info->pre_district_name?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Division:</th>
                      <td class="tg-031e"><?=$info->pre_div_name?></td>
                    </tr>
                    <tr>
                      <th colspan="2" class="tg-9vst2" style="color: black; font-size: 16px;">Permanent Address</th>
                    </tr>                  
                    <tr>
                      <th class="tg-9vst">Village/House No or Name:</th>
                      <td class="tg-031e"><?=$info->per_village_house?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Road/Block/Sector:</th>
                      <td class="tg-031e"><?=$info->per_road_block?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Post Office:</th>
                      <td class="tg-031e"><?=$info->per_post_office==0?'':$info->per_post_office?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Upazilla / Thana:</th>
                      <td class="tg-031e"><?=$info->per_up_th_name?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">District:</th>
                      <td class="tg-031e"><?=$info->per_district_name?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Division:</th>
                      <td class="tg-031e"><?=$info->per_div_name?></td>
                    </tr>
                  </table>    
                </td>

                <td width="45%"  valign="top">
                  <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;">Present Scout Information</h4>
                  <table class="tg">
                    <tr>
                      <th class="tg-9vst" width="170" style="font-size: 20px;">BS ID</th>
                      <td class="tg-031e" style="font-size: 20px;"><strong><?=$info->scout_id?></strong></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Username:</th>
                      <td class="tg-031e"><?=$info->username?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Member Type:</th>
                      <td class="tg-031e"><?php echo $info->member_type_name;?></td>
                    </tr>

                    <?php if($info->member_id == 8 || $info->member_id == 12 || $info->member_id == 10 || $info->member_id == 9){ ?>
                    <tr>
                      <th class="tg-9vst">Certificate No:</th>
                      <td class="tg-031e"><?php echo $info->certificate_no;?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Certificate Date:</th>
                      <td class="tg-031e"><?php echo date_detail_format($info->certificate_date);?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">ID Card Expire Date:</th>
                      <td class="tg-031e" valign="top"><?php echo date_detail_format($info->expire_date);?></td>
                    </tr>
                    <?php } ?>

                    <tr>
                      <th class="tg-9vst">Scout Join Date:</th>
                      <td class="tg-031e"><?=date_detail_format($info->join_date)?></td>
                    </tr>

                    <tr>
                      <th class="tg-9vst">Section:</th>
                      <td class="tg-031e"><span class="label label-inverse"><?php echo get_scout_section($info->sc_section_id);?></span></td>
                    </tr>
                <!-- <tr>
                  <th class="tg-9vst" width="140">Cub Scouts Experience:</th>
                  <td class="tg-031e"><?=$sc_cub?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Scouts Experience:</th>
                  <td class="tg-031e"><?=$sc_scout?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Rover Scouts Experience:</th>
                  <td class="tg-031e"><?=$sc_rover?></td>
                </tr> -->
                <tr>
                  <th class="tg-9vst">Scout Badge:</th>
                  <td class="tg-031e"><?=$info->badge_type_name_bn?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Scout Role:</th>
                  <td class="tg-031e"><?=$info->role_type_name_bn?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Scout Unit:</th>
                  <td class="tg-031e"><?=$info->unit_name?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Scout Group:</th>
                  <td class="tg-031e"><?=$info->grp_name?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">S. Upazila/Thana:</th>
                  <td class="tg-031e"><?=$info->upa_name?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">S. District:</th>
                  <td class="tg-031e"><?=$info->dis_name?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Scout Region:</th>
                  <td class="tg-031e"><?=$info->region_name?></td>
                </tr>
                <tr>
                <th colspan="2" class="tg-9vst2" style="color: black; font-size: 16px;">Other's Information</th>
                </tr>        
                <?php if($info->member_id == 1 || $info->member_id == 2){ ?>          
                <tr>
                  <th class="tg-9vst">Current Institute:</th>
                  <td class="tg-031e"><?=$info->institute_name?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Current Calss:</th>
                  <td class="tg-031e"><?=$info->curr_class?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Current Roll No:</th>
                  <td class="tg-031e"><?=$info->curr_role_no?></td>
                </tr>
                <?php }else{ ?> 
                <tr>
                  <th class="tg-9vst">Scout Designation (For Adult Leader):</th>
                  <td class="tg-031e" valign="top"><?=$info->scout_designation?></td>                
                </tr>
                <tr>
                  <th class="tg-9vst">Present Organization / Office / Business Name:</th>
                  <td class="tg-031e" valign="top"><?=$info->curr_org?></td>                
                </tr>
                <tr>
                  <th class="tg-9vst">Present Designation:</th>
                  <td class="tg-031e" valign="top"><?=$info->curr_desig?></td>
                </tr>
                <?php } ?>                
              </table>
            </td>

          </tr>
        </table>

      </div>
    </div>
  </div>

  <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>

  <style type="text/css">
    .tg2  {border-collapse:collapse;border-spacing:0; width: 100%}
    .tg2 td{font-family:Arial, sans-serif;font-size:14px;padding:8px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;color: black;}
    .tg2 th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:8px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; text-align: center; color: black; font-weight: bold;}
    .tg2 .tg2-hy62{background-color:#c0c0c0}
    .tg2 .tg2-le8v{background-color:#c0c0c0;vertical-align:top}
    .tg2 .tg2-yw4l{vertical-align:top}
  </style>
  <?php if($info->sc_cub == 'Yes'){ ?>
  <div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
      <div class="scout-verify-box">
        <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;"> Cub Scout Expreience</h4>
        <table class="tg"style="width:100%">
          <tr>
            <th class="tg-9vst" width="250">Cub Scouts Experience:</th>
            <td class="tg-031e">
              <?=$sc_cub?>
              <!-- <a href="<?=base_url('scouts_member/cub_experience/'.$info->id)?>" class="btn btn-primary btn-xs btn-mini pull-right"> Update</a>  -->
            </td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Section:</th>
            <td class="tg-031e"><span class="label label-inverse">Cub Scout</span></td>
          </tr>
          <?php if(!empty($cub_info)){ ?>
          <tr>
            <th class="tg-9vst">Scout Join Date:</th>
            <td class="tg-031e"><?=date_detail_format($cub_info->join_date)?></td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Badge:</th>
            <td class="tg-031e"><?=$cub_info->badge_type_name_bn?></td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Role:</th>
            <td class="tg-031e"><?=$cub_info->role_type_name_bn?></td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Unit:</th>
            <td class="tg-031e"><?=$cub_info->unit_name?></td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Group:</th>
            <td class="tg-031e"><?=$cub_info->grp_name?></td>
          </tr>
          <tr>
            <th class="tg-9vst">S. Upazila/Thana:</th>
            <td class="tg-031e"><?=$cub_info->upa_name?></td>
          </tr>
          <tr>
            <th class="tg-9vst">S. District:</th>
            <td class="tg-031e"><?=$cub_info->dis_name?></td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Region:</th>
            <td class="tg-031e"><?=$cub_info->region_name?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
  <?php } ?>
  <?php if($info->sc_scout == 'Yes'){ ?>
  <div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
      <div class="scout-verify-box">
        <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;"> Scout Expreience</h4>
        <table class="tg"style="width:100%">
          <tr>
            <th class="tg-9vst" width="250">Scouts Experience:</th>
            <td class="tg-031e">
              <?=$sc_scout?>
              <!-- <a href="<?=base_url('scouts_member/scout_experience/'.$info->id)?>" class="btn btn-primary btn-xs btn-mini pull-right"> Update</a>  -->
            </td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Section:</th>
            <td class="tg-031e"><span class="label label-inverse">Scout</span></td>
          </tr>
          <?php if(!empty($scout_info)){ ?>
          <tr>
            <th class="tg-9vst">Scout Join Date:</th>
            <td class="tg-031e"><?=date_detail_format($scout_info->join_date)?></td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Badge:</th>
            <td class="tg-031e"><?=$scout_info->badge_type_name_bn?></td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Role:</th>
            <td class="tg-031e"><?=$scout_info->role_type_name_bn?></td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Unit:</th>
            <td class="tg-031e"><?=$scout_info->unit_name?></td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Group:</th>
            <td class="tg-031e"><?=$scout_info->grp_name?></td>
          </tr>
          <tr>
            <th class="tg-9vst">S. Upazila/Thana:</th>
            <td class="tg-031e"><?=$scout_info->upa_name?></td>
          </tr>
          <tr>
            <th class="tg-9vst">S. District:</th>
            <td class="tg-031e"><?=$cub_info->dis_name?></td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Region:</th>
            <td class="tg-031e"><?=$scout_info->region_name?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
  <?php } ?>
  <?php if($info->sc_rover == 'Yes'){ ?>
  <div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
      <div class="scout-verify-box">
        <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;"> Scout Expreience</h4>
        <table class="tg"style="width:100%">
          <tr>
            <th class="tg-9vst" width="250">Scouts Experience:</th>
            <td class="tg-031e">
              <?=$sc_rover?>
              <!-- <a href="<?=base_url('scouts_member/rover_experience/'.$info->id)?>" class="btn btn-primary btn-xs btn-mini pull-right"> Update</a>  -->
            </td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Section:</th>
            <td class="tg-031e"><span class="label label-inverse">Rover Scout</span></td>
          </tr>
          <?php if(!empty($rover_info)){ ?>
          <tr>
            <th class="tg-9vst">Scout Join Date:</th>
            <td class="tg-031e"><?=date_detail_format($rover_info->join_date)?></td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Badge:</th>
            <td class="tg-031e"><?=$rover_info->badge_type_name_bn?></td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Role:</th>
            <td class="tg-031e"><?=$rover_info->role_type_name_bn?></td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Unit:</th>
            <td class="tg-031e"><?=$rover_info->unit_name?></td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Group:</th>
            <td class="tg-031e"><?=$rover_info->grp_name?></td>
          </tr>
          <tr>
            <th class="tg-9vst">S. Upazila/Thana:</th>
            <td class="tg-031e"><?=$rover_info->upa_name?></td>
          </tr>
          <tr>
            <th class="tg-9vst">S. District:</th>
            <td class="tg-031e"><?=$rover_info->dis_name?></td>
          </tr>
          <tr>
            <th class="tg-9vst">Scout Region:</th>
            <td class="tg-031e"><?=$rover_info->region_name?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
  <?php } ?>




  <div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
      <div class="scout-verify-box">
        <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;"> My Progress</h4>

        <table class="profile_table" width="100%">
          <caption>দীক্ষা / ব্যাজ অর্জনের তারিখ ও বিবরণ</caption>
          <tr class="bg-success">
            <th>ক্রম</th>
            <th>সেকসন</th>
            <th>ব্যাজ</th>
            <th>গ্রহণের তারিখ</th>
            <th>মূল্যায়নকারী</th>
            <th>যাচাইকারী</th>
          </tr>
          <?php for($i=0;$i<sizeof($achievement);$i++){ ?>

          <tr>
            <td><?=$i+1?></td>
            <td><?=get_scout_section($achievement[$i]->section_id); ?></td>
            <td><?=$achievement[$i]->badge_type_name_bn; ?></td>
            <td><?=date_bangla_format($achievement[$i]->achive_date); ?></td>
            <td><?=$achievement[$i]->examiner_id; ?></td>
            <td><?=$achievement[$i]->scout_id; ?></td>

          </tr>
          <?php } ?>  
        </table>
      </br></br>

      <table class="profile_table" width="100%">
        <caption>পারদর্শিতা ব্যাজ অর্জনের বিবরণ</caption>
        <tr class="bg-success">
          <th>ক্রম</th>
          <th>সেকসন</th>
          <th>ব্যাজ</th>
          <th>গ্রউপ</th>
          <th>অর্জনের তারিখ</th>
          <th>অতিরিক্ত ব্যাজ </th>
          <th>মূল্যায়নকারী</th>
          <th>যাচাইকারী</th>
        </tr>
        <?php for($i=0;$i<sizeof($expertness);$i++){ ?>

        <tr>
          <td><?=$i+1?></td>
          <td><?=get_scout_section($expertness[$i]->section_id); ?></td>
          <td><?=$expertness[$i]->badge_type_name_bn; ?></td>
          <td><?=$expertness[$i]->expert_group_name; ?></td>
          <td><?=date_bangla_format($expertness[$i]->achive_date); ?></td>
          <td><?=$expertness[$i]->extra_badge; ?></td>
          <td><?=$expertness[$i]->examiner_id; ?></td>
          <td><?=$expertness[$i]->scout_id; ?></td>

        </tr>
        <?php } ?>  
      </table>
    </br></br>

    <table class="profile_table" width="100%">
      <caption>ক্যাম্প রেকর্ডের বিবরণ</caption>
      <tr class="bg-success">
        <th>ক্রম</th>
        <th>সেকসন</th>
        <th>ক্যাম্পের নাম</th>
        <th>স্থান</th>
        <th>সনদ নং</th>
        <th>ক্যাম্প তারিখ</th>
        <th>মূল্যায়নকারী</th>
        <th>যাচাইকারী</th>
      </tr>
      <?php for($i=0;$i<sizeof($camping);$i++){ ?>

      <tr>
        <td><?=$i+1?></td>
        <td><?=get_scout_section($camping[$i]->section_id); ?></td>
        <td><?=$camping[$i]->camp_name; ?></td>
        <td><?=$camping[$i]->area; ?></td>
        <td><?=$camping[$i]->certificate_no; ?></td>
        <td><?=date_bangla_format($camping[$i]->camp_date); ?></td>
        <td><?=$camping[$i]->examiner_id; ?></td>
        <td><?=$camping[$i]->scout_id; ?></td>

      </tr>
      <?php } ?>  
    </table>
  </br></br>

  <table class="profile_table" width="100%">
    <caption>প্রশিক্ষণ রেকর্ডের বিবরণ</caption>
    <tr class="bg-success">
      <th>ক্রম</th>
      <th>সেকসন</th>
      <th>ব্যাজ</th>
      <th>প্রশিক্ষণের নাম</th>
      <th>সনদ নং</th>
      <th>প্রশিক্ষণের তারিখ</th>
      <th>মূল্যায়নকারী</th>
      <th>যাচাইকারী</th>
    </tr>
    <?php for($i=0;$i<sizeof($badge_training);$i++){ ?>

    <tr>
      <td><?=$i+1?></td>
      <td><?=get_scout_section($badge_training[$i]->section_id); ?></td>
      <td><?=$badge_training[$i]->badge_type_name_bn; ?></td>
      <td><?=$badge_training[$i]->training_name; ?></td>
      <td><?=$badge_training[$i]->certificate_no; ?></td>
      <td><?=date_bangla_format($badge_training[$i]->training_date); ?></td>
      <td><?=$badge_training[$i]->examiner_id; ?></td>
      <td><?=$badge_training[$i]->scout_id; ?></td>

    </tr>
    <?php } ?>  
  </table>
</br></br>

<table class="profile_table" width="100%">
  <caption>পদোন্নতির বিবরণ</caption>
  <tr class="bg-success">
    <th>ক্রম</th>
    <th>সেকসন</th>
    <th>রোল</th>
    <th>পদোন্নতির শুরুর তারিখ</th>
    <th>পদোন্নতির শেষ তারিখ</th>
    <th>ব্যাজ</th>
    <th>মূল্যায়নকারী</th>
    <th>যাচাইকারী</th>
  </tr>
  <?php for($i=0;$i<sizeof($promotion);$i++){ ?>

  <tr>
    <td><?=$i+1?></td>
    <td><?=get_scout_section($promotion[$i]->section_id); ?></td>
    <td><?=$promotion[$i]->role_type_name_bn; ?></td>
    <td><?=date_bangla_format($promotion[$i]->from_date); ?></td>
    <td><?=date_bangla_format($promotion[$i]->to_date); ?></td>
    <td><?=$promotion[$i]->badge_type_name_bn; ?></td>
    <td><?=$promotion[$i]->examiner_id; ?></td>
    <td><?=$promotion[$i]->scout_id; ?></td>

  </tr>
  <?php } ?>  
</table>
</br></br>

<table class="profile_table" width="100%">
  <caption>গ্রুপ ত্যাগের বিবরণ</caption>
  <tr class="bg-success">
    <th>ক্রম</th>
    <th>সেকসন</th>
    <th>গ্রুপ ত্যাগের তারিখ</th>
    <th>গ্রুপ ত্যাগের কারণ</th>
    <th>মূল্যায়নকারী</th>
    <th>যাচাইকারী</th>
  </tr>
  <?php for($i=0;$i<sizeof($resign);$i++){ ?>

  <tr>
    <td><?=$i+1?></td>
    <td><?=get_scout_section($resign[$i]->section_id); ?></td>
    <td><?=$resign[$i]->resign_date; ?></td>
    <td><?=$resign[$i]->resign_reason; ?></td>
    <td><?=$resign[$i]->examiner_id; ?></td>
    <td><?=$resign[$i]->scout_id; ?></td>

  </tr>
  <?php } ?>  
</table>
<?php } ?>

                    <!-- <table class="profile_table" width="100%">
                      <caption>ব্যাজ অর্জনের বিবরণ</caption>
                         <tr class="bg-success">
                            <th>ক্রম</th>
                            <th>সেকসন</th>
                            <th>ব্যাজ</th>
                            <th>বিবরণ</th>
                            <th>অর্জনের তারিখ</th>
                            <th>মূল্যায়নকারী</th>
                            <th>যাচাইকারী</th>
                         </tr>
                         <?php for($i=0;$i<sizeof($badge_details);$i++){ ?>
                      
                          <tr>
                            <td><?=$i+1?></td>
                            <td><?=get_scout_section($badge_details[$i]->section_id); ?></td>
                            <td><?=$badge_details[$i]->badge_type_name_bn; ?></td>
                            <td><?=$badge_details[$i]->questions; ?></td>
                            <td><?=date_bangla_format($badge_details[$i]->achive_date); ?></td>
                            <td><?=$badge_details[$i]->examiner_id; ?></td>
                            <td><?=$badge_details[$i]->scout_id; ?></td>
                            
                          </tr>
                          <?php } ?>  
                        </table> -->
                        <!-- </br></br> -->

                    <!-- <table class="profile_table" width="100%">
                      <caption>দৈহিক ও স্বাস্থ্যগত রেকর্ডের বিবরণ</caption>
                         <tr class="bg-success">
                            <th>ক্রম</th>
                            <th>সেকসন</th>
                            <th>বর্ষ</th>
                            <th>উচ্চতা</th>
                            <th>ওজন</th>
                            <th>বুকের মাপ</th>
                            <th>বিঘত</th>
                            <th>হাতের মাপ</th>
                            <th>হৃদ স্পন্দন</th>
                            <th>তাপমাত্রা</th>
                            <th>মূল্যায়নকারী</th>
                            <th>যাচাইকারী</th>
                         </tr>
                         <?php for($i=0;$i<sizeof($health);$i++){ ?>
                      
                          <tr>
                            <td><?=$i+1?></td>
                            <td><?=get_scout_section($health[$i]->section_id); ?></td>
                            <td><?=$health[$i]->years; ?></td>
                            <td><?=$health[$i]->height; ?></td>
                            <td><?=$health[$i]->weight; ?></td>
                            <td><?=$health[$i]->chest_size; ?></td>
                            <td><?=$health[$i]->span; ?></td>
                            <td><?=$health[$i]->hand_size; ?></td>
                            <td><?=$health[$i]->heartbeat; ?></td>
                            <td><?=$health[$i]->temperature; ?></td>
                            <td><?=$health[$i]->examiner_id; ?></td>
                            <td><?=$health[$i]->scout_id; ?></td>
                            
                          </tr>
                          <?php } ?>  
                    </table>
                  </br></br> -->

                    <!-- <table class="profile_table" width="100%">
                      <caption>বিদ্যালয়ের ক্রমোন্নতি তথ্য বিবরণ</caption>
                         <tr class="bg-success">
                            <th>ক্রম</th>
                            <th>সেকসন</th>
                            <th>বর্ষ</th>
                            <th>শ্রেণী</th>
                            <th>রোল নং</th>
                            <th>প্রাপ্ত নম্বর</th>
                            <th>মূল্যায়নকারী</th>
                            <th>যাচাইকারী</th>
                         </tr>
                         <?php for($i=0;$i<sizeof($institute);$i++){ ?>
                      
                          <tr>
                            <td><?=$i+1?></td>
                            <td><?=get_scout_section($institute[$i]->section_id); ?></td>
                            <td><?=$institute[$i]->years; ?></td>
                            <td><?=$institute[$i]->class_name; ?></td>
                            <td><?=$institute[$i]->roll_no; ?></td>
                            <td><?=$institute[$i]->total_unmber; ?></td>
                            <td><?=$institute[$i]->examiner_id; ?></td>
                            <td><?=$institute[$i]->scout_id; ?></td>
                            
                          </tr>
                          <?php } ?>  
                    </table>
                  </br></br> -->

                </div>
              </div>
            </div>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->


  </div>
</div>