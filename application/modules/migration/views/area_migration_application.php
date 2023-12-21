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
      <div><?php //echo validation_errors(); ?></div>
        <?php if($this->session->flashdata('success')):?>
          <div class="alert alert-success">                      
            <?php echo $this->session->flashdata('success');?>
          </div>
        <?php endif; ?>              
        <?php 
        $attributes = array('id' => 'area_migration_validation');
        echo form_open("migration/area_migration_application", $attributes);?>

        <div class="row">
          <div class="col-md-5">
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
                  <td class="tg-031e"><?=$info->join_date?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Section:</th>
                  <td class="tg-031e"><span class="label label-inverse"><?php echo get_scout_section($info->sc_section_id);?></span></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Scout Badge:</th>
                  <td class="tg-031e"><?=$info->badge_name_bn?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Scout Role:</th>
                  <td class="tg-031e"><?=$info->role_name?></td>
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
            <h4 style="font-weight: bold;">Migration To Area</h4>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label">Reasons for migration</label>
                <?php echo form_error('mig_reasons'); ?>
                <textarea name="mig_reasons" class="form-control"><?=set_value('mig_reasons')?></textarea>
              </div>
            </div>

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
               <label class="form-label">Select Scout Upazila/Thana</label>
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
        </div>
      </div>

      <div class="form-actions">  
        <div class="pull-right">
          <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
          <!-- <button type="button" class="btn btn-white btn-cons">Cancel</button> -->
        </div>
      </div>
      <?php echo form_close();?>
    </div>  <!-- END GRID BODY -->              
  </div> <!-- END GRID -->
</div>

</div> <!-- END ROW -->

</div>
</div>

<script type="text/javascript">
   $(document).ready(function() {
      $('#area_migration_validation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         mig_reasons: {
            required: true,
            minlength: 10
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