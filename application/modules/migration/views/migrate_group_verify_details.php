<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('scouts_member')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>
    <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0;}
      .tg td{font-family:Arial, sans-serif;font-size:14px;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc;}
      .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc; font-weight: bold; vertical-align: top}
      .tg .tg-9vst{background-color:#efefef;text-align:right;}
    </style>
    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">                
                <!-- <a href="<?=base_url('scouts_member/request')?>" class="btn btn-success btn-xs btn-mini"> Approved</a>
                <a href="<?=base_url('scouts_member/request')?>" class="btn btn-success btn-xs btn-mini"> Reject</a> -->  
              </div>
          </div>
          <div class="grid-body">              
            <div class="row">
              <div class="col-md-6">
                <div class="scout-verify-box">
                  <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;"> Current Scout Information</h4>
                  <table class="tg">
                    <tr>
                      <th class="tg-9vst" width="180" style="font-size: 20px;">BS ID</th>
                      <td class="tg-031e" style="font-size: 20px;"><strong><?=$info->scout_id?></strong></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Scout Join Date:</th>
                      <td class="tg-031e"><?=$info->join_date?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Section:</th>
                      <td class="tg-031e"><span class="label label-inverse"><?php echo get_scout_section($info->sc_section_id);?></span></td>
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
                      <td class="tg-031e"><?=$info->current_unit_name?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Scout Group:</th>
                      <td class="tg-031e"><?=$info->current_grp_name?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">S. Upazila/Thana:</th>
                      <td class="tg-031e"><?=$info->current_upa_name?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">S. District:</th>
                      <td class="tg-031e"><?=$info->current_dis_name?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Scout Region:</th>
                      <td class="tg-031e"><?=$info->current_region_name?></td>
                    </tr>
                  </table>
                </div>
              </div>

              <div class="col-md-6">
                <h4 style="font-weight: bold;">Migration To Area</h4>
                <table class="tg">
                    <tr>
                      <th class="tg-9vst" width="180">Resons:</th>
                      <td class="tg-031e"><strong><?=$info->mig_reasons?></strong></td>
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
                  </table>

                  <br><br>

                  <table class="tg">
                    <tr>
                      <th class="tg-9vst">Application Date:</th>
                      <td class="tg-031e"><?=$info->created?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Group Verify Status:</th>
                      <td class="tg-031e"><?=migrate_verify_status($info->curr_group_verify)?></td>
                    </tr>
                    <?php if($info->curr_group_admin_id) { ?>
                    <tr>
                      <th class="tg-9vst">Group Verify Comment:</th>
                      <td class="tg-031e"><?= $info->curr_group_admin_cmnts ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <th class="tg-9vst">Migration Verify Status:</th>
                      <td class="tg-031e"><?=migrate_verify_status($info->mig_group_verify)?></td>
                    </tr>
                    <?php if($info->mig_group_verify_id) { ?>
                    <tr>
                      <th class="tg-9vst">Migration Group Verify Comment:</th>
                      <td class="tg-031e"><?= $info->mig_group_cmnts ?></td>
                    </tr>
                    <?php } ?>
                  </table>

                  <br>
                  <?php 
                    if(!$info->mig_group_verify_id && $this->ion_auth->is_group_admin())
                    { 
                  ?>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Migration Group Admin Comment</label>
                        <input type="text" class="form-control" name="mig_group_cmnts" id="mig_group_cmnts">
                        <input type="hidden" name="migration_id" id="migration_id" value="<?= $info->migration_id ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-2">
                          <button class="btn btn-success" onclick="migration_group_verify('Approved')">Accept</button>
                        </div>
                        <div class="col-md-2">
                          <button class="btn btn-danger" onclick="migration_group_verify('Reject')">Deny</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php 
                    }
                  ?>
              </div>
            </div>
          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>

<script type="text/javascript">
  
  function migration_group_verify(action)
  {
    var cmnt = $('#mig_group_cmnts').val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url('migration/migration_group_verify'); ?>",
      data: 
      {
        id : $('#migration_id').val(),
        cmnt : cmnt,
        action : action
      },
      success: function(data)
      {
        if(data == 1)
        {
          location.reload();
        }
        else alert(data);
      }
    });
  }
</script>