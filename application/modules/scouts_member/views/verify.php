<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0;}
      .tg td{font-family:Arial, sans-serif;font-size:14px;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc;}
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
          <a href="<?=base_url('scouts_member/request')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts Member Request</a>
        </div>
      </div>
      <div class="grid-body">
        <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
        <div><?php echo validation_errors(); ?></div>
        <?php if($this->session->flashdata('success')):?>
          <div class="alert alert-success">
            <?php echo $this->session->flashdata('success');;?>
          </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('error')):?>
          <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error');;?>
          </div>
        <?php endif; ?>
        <?php echo form_open_multipart(uri_string());?>
        <div class="row form-row">
          <div class="col-md-6">
            <div class="scout-verify-box">
              <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;"> Basic Information</h4>
              <table class="tg" width="100%">
                <tr>
                  <th colspan="2" class="tg-9vst2"><em>Basic Information</em></th>
                </tr>
                <tr>
                  <th class="tg-9vst" width="200">Full Name:</th>
                  <td class="tg-031e"><?php echo $info->first_name;?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Profile Image:</th>
                  <td class="tg-031e" colspan="2">
                    <?php
                    $path = base_url().'profile_img/';
                    if($info->profile_img != NULL){
                      $img_url = '<img src="'.$path.$info->profile_img.'" width="70" style="border:1px solid #ccc; padding:3px;">';
                    }else{
                      $img_url = '<img src="'.$path.'no-img.png" width="70" style="border:1px solid #ccc; padding:3px;">';
                    }
                    echo $img_url;
                    ?>
                  </td>
                </tr>
                <tr>
                  <th class="tg-9vst">Father's Name:</th>
                  <td class="tg-031e"><?=$info->father_name?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Mother's Name:</th>
                  <td class="tg-031e"><?=$info->mother_name?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Gender:</th>
                  <td class="tg-031e"><?=$info->gender?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Date of Birth:</th>
                  <td class="tg-031e"><?=$info->dob?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Religion:</th>
                  <td class="tg-031e"><?=get_religion($info->religion_id)?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Blood Group:</th>
                  <td class="tg-031e"><?=$info->bg_name_en?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Mobile No:</th>
                  <td class="tg-031e"><?=$info->phone?></td>
                </tr>
                <tr>
                  <th colspan="2" class="tg-9vst2"><em>Present Address</em></th>
                </tr>
                <tr>
                  <th class="tg-9vst">Village/House No or Name:</th>
                  <td class="tg-031e"><?=$info->pre_village_house?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Road/Block:</th>
                  <td class="tg-031e"><?=$info->pre_road_block?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Division:</th>
                  <td class="tg-031e"><?=$info->pre_div_name?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">District:</th>
                  <td class="tg-031e"><?=$info->pre_district_name?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Upazilla / Thana:</th>
                  <td class="tg-031e"><?=$info->pre_up_th_name?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Post Code:</th>
                  <td class="tg-031e"><?=$info->pre_post_office?></td>
                </tr>
              </table>
            </div>
          </div>

          <div class="col-md-6">
            <div class="scout-verify-box">
              <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;"> Scouts & Other's Information</h4>
              <table class="tg">
                <tr>
                  <th colspan="2" class="tg-9vst2"><em>Other's Information</em></th>
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
                  <th class="tg-9vst">Present Organization / Office / Business Name:</th>
                  <td class="tg-031e"><?=$info->curr_org?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Present Designation:</th>
                  <td class="tg-031e"><?=$info->curr_desig?></td>
                </tr>
                <?php } ?>
                <tr>
                  <th colspan="2" class="tg-9vst2"><em>Scouts Information</em></th>
                </tr>
                <tr>
                  <th class="tg-9vst" width="140">Application Type:</th>
                  <td class="tg-031e"><?php
                      if(!$info->is_interested){
                        echo 'For Scouts member';
                      }else{
                        echo 'For interested to be scouts member';
                      }
                  ?></td>
                </tr>
                  <tr>
                    <th class="tg-9vst" width="140">Cub Scout Experience:</th>
                    <td class="tg-031e"><?=$sc_cub?></td>
                  </tr>
                  <tr>
                    <th class="tg-9vst">Scout Experience:</th>
                    <td class="tg-031e"><?php echo $sc_scout;  ?></td>
                  </tr>
                  <tr>
                    <th class="tg-9vst">Rover Scout Experience:</th>
                    <td class="tg-031e"><?=$sc_rover?></td>
                  </tr>
                  <tr>
                    <th class="tg-9vst" width="140">Scout Join Date:</th>
                    <td class="tg-031e"><?=$info->join_date?></td>
                  </tr>
                  <tr>
                    <th class="tg-9vst">Member Type:</th>
                    <td class="tg-031e"><?php echo $info->member_type_name;?></td>
                  </tr>
                  <tr>
                    <th class="tg-9vst">Section:</th>
                    <td class="tg-031e"><?php echo get_scout_section($info->sc_section_id);?></td>
                  </tr>
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
                    <th class="tg-9vst">Scout Upazila:</th>
                    <td class="tg-031e"><?=$info->upa_name?></td>
                  </tr>
                  <tr>
                    <th class="tg-9vst">Scout District:</th>
                    <td class="tg-031e"><?=$info->dis_name?></td>
                  </tr>
                  <tr>
                    <th class="tg-9vst">Scout Region:</th>
                    <td class="tg-031e"><?=$info->region_name?></td>
                  </tr>
                </table>
                <br><br>

              </div>
            </div>
          </div>

          <div class="form-actions">
            <div class="pull-left">
              <div class="checkbox checkbox check-success pull-left" style="margin-top: 13px;">
                <?php echo form_checkbox('generateID', '1', TRUE, 'id="generateID"');?>
                <label for="generateID" style="color: black; font-weight: bold;">Generate Scout ID</label>
              </div>
            </div>
            <div class="pull-right">
              <a href="<?=base_url('scouts_member/cancel/'.encrypt_url($info->id))?>" class="btn btn-danger btn-cons" onclick="return confirm('are you sure?')">Cancel Request</a>
              <?php echo form_hidden('dataID', encrypt_url($info->id)); ?>
              <button type="submit" class="btn btn-primary btn-cons" onclick="return confirm('Are you sure all information is valid? If you want to generate Scout ID, please tik the checkbox.')"><i class="icon-ok"></i> Approved Request</button>
            </div>
          </div>
          <?php echo form_close();?>

        </div>  <!-- END GRID BODY -->
      </div> <!-- END GRID -->
    </div>

  </div> <!-- END ROW -->


</div>
</div>
