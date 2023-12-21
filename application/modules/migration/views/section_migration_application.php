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
      </div>
      <div class="grid-body">              
        <div><?php echo validation_errors(); ?></div>
        <?php if($this->session->flashdata('success')):?>
          <div class="alert alert-success">                      
            <?php echo $this->session->flashdata('success');?>
          </div>
        <?php endif; ?>              
        <?php 
        $attributes = array('id' => 'section_migration_validation');
        echo form_open("migration/section_migration_application", $attributes);?>

        <div class="row">

          <div class="col-md-5">
            <a href="<?=base_url('Migration/section_migration_application_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>
            <!-- <h4 style="font-weight: bold;">Current Scout Information</h4> -->
            <div class="scout-verify-box">
              <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;"> Current Scout Information</h4>
              <table class="tg">
                <tr>
                  <th class="tg-9vst" width="180" style="font-size: 20px;">BS ID</th>
                  <td class="tg-031e" style="font-size: 20px;"><strong><?=$info->scout_id?></strong></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Scout Join Date:</th>
                  <td class="tg-031e"><?=date_detail_format($info->join_date)?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Member Type:</th>
                  <td class="tg-031e"><?php echo $info->member_type_name;?></td>
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
            </div>
          </div>

          <div class="col-md-7">
            <?php
            $flag_can_apply = true;

            if(!$info->sc_group_id){
              $flag_can_apply = false;
              ?>
              <div class="alert alert-block alert-warning fade in">
                <h4 class="alert-heading"><i class="icon-warning-sign"></i> Warning!</h4>
                <p>Scout Region, District, Upazila, and Group are required to apply for section migration.</p>
              </div>
              <?php
            }
            ?>

            <div class="alert alert-block alert-warning fade in">
              <ol>
                <strong>Section Migration Process:</strong>
                <li>Fill up all information for section migration</li>
                <li>You can view your migration application form "My Section Migration List"</li>
                <li>Now your application is verifying from your current group admin</li>
                <li>Finally group admin is accepting this application and the section transfer process is complete</li>
              </ol>
            </div>

            <h4 style="font-weight: bold;">Migration To Section</h4>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label">Reasons of migration</label>
                <?php echo form_error('mig_reasons'); ?>
                <textarea name="mig_reasons" class="form-control"><?=set_value('mig_reasons')?></textarea>
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-6">
                <label class="form-label">Member Type</label>
                <?php echo form_error('mig_member_id'); ?>
                <?php echo form_dropdown('mig_member_id',$member_type, set_value('mig_member_id'), 'id="member_id" class="form-control input-sm"');?>
              </div>
              <div class="col-md-6">
                <label class="form-label">Scout Section Type </label>
                <?php echo form_error('mig_section_id');
                $more_attr = 'class="form-control input-sm" id="sc_section"';
                echo form_dropdown('mig_section_id', $scout_section, set_value('mig_section_id'), $more_attr);
                ?>
              </div>
              <div class="col-md-6">
                <label class="form-label">Scout Badge</label>
                <?php echo form_error('mig_badge_id'); ?>
                <select name="mig_badge_id" class="sc_badge_val form-control input-sm" id="sc_badge">
                  <option value="">-- Select One --</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Scout Role</label>
                <?php echo form_error('mig_role_id'); ?>
                <select name="mig_role_id" class="sc_role_val form-control input-sm" id="sc_role">
                  <option value="">-- Select One --</option>
                </select>
              </div>
            </div>

            <?php /*
            <div class="row form-row">
              <div class="col-md-6">
                <label class="form-label">Select Scout Region</label>
                <?php 
                echo form_error('mig_region_id');
                $more_attr = 'class="form-control input-sm" id="region"';
                echo form_dropdown('mig_region_id', $regions, set_value('mig_region_id'), $more_attr);
                ?>
              </div>
              <div class="col-md-6">
                <label class="form-label">Select Scout District</label>
                <?php echo form_error('mig_district_id'); ?>
                <select name="mig_district_id" class="sc_district_val form-control input-sm" id="sc_district">
                  <option value="">-- Select One --</option>
                </select>
              </div>
            </div>

            <div class="row form-row">
             <div class="col-md-6">
               <label class="form-label">Select Scout Upazila</label>
               <?php echo form_error('mig_upazila_id'); ?>
               <select name="mig_upazila_id" class="sc_upazila_thana_val form-control input-sm"  id="sc_upazila_thana">
                 <option value="">-- Select One --</option>
               </select>
             </div>

             <div class="col-md-6">
              <label class="form-label">Select Scout Group</label>
              <?php echo form_error('mig_group_id'); ?>
              <select name="mig_group_id" class="sc_group_val form-control input-sm" id="sc_unit">
                <option value="">-- Select One --</option>
              </select>
            </div>
          </div>

          <div class="col-md-12">
            <?php echo form_error('sc_unit_id'); ?>
            <div class="unit_list" style="display: none;"></div>  
          </div>
        */ ?>
      </div>
    </div>

    <?php if($flag_can_apply) { ?>
    <div class="form-actions">  
      <div class="pull-right">
        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
        <!-- <button type="button" class="btn btn-white btn-cons">Cancel</button> -->
      </div>
    </div>
    <?php } ?>
    <?php echo form_close();?>
  </div>  <!-- END GRID BODY -->              
</div> <!-- END GRID -->
</div>

</div> <!-- END ROW -->

</div>
</div>

<script type="text/javascript">
 $(document).ready(function() {
  $('#section_migration_validation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
       mig_reasons: {
        required: true,
        minlength: 10
      },
      mig_member_id: {
        required: true
      },
      mig_section_id: {
        required: true
      },
      mig_region_id: {
        required: true
      },
      mig_district_id: {
        required: true
      },
      mig_group_id: {
        required: true
      },
      sc_unit_id: {
        required: true
      }
    },

    invalidHandler: function (event, validator) {
         //display error alert on form submit    
       },

      errorPlacement: function (label, element) { // render error placement for each input type   
       $('<span class="error"></span>').insertAfter(element).append(label)
       var parent = $(element).parent('.input-with-icon');
       parent.removeClass('success-control').addClass('error-control');  
     },

      highlight: function (element) { // hightlight error inputs
       var parent = $(element).parent();
       parent.removeClass('success-control').addClass('error-control'); 
     },

      unhighlight: function (element) { // revert the change done by hightlight

      },

      success: function (label, element) {
       var parent = $(element).parent('.input-with-icon');
       parent.removeClass('error-control').addClass('success-control'); 
     },

     submitHandler: function (form) {
       form.submit(); 
     }
   });
});   
</script>