<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('offices/region')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('offices/region')?>" class="btn btn-success btn-xs btn-mini"> Region List</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
                  <div><?php //echo validation_errors(); ?></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php 
                    $attributes = array('id' => 'office_region_validate');
                    echo form_open_multipart("offices/region_create",$attributes);
                  ?>
                  
                  <div class="row">
                     <div class="col-md-7">
                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Division</label>
                              <?php echo form_error('region_div_id');
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('region_div_id', $divisions, set_value('region_div_id'), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Region Type <span class="required">*</span></label>
                              <?php echo form_error('region_type');                         
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('region_type', $region_type, set_value('region_type'), $more_attr);
                              ?>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Region Name <span class="required">*</span></label>
                              <?php echo form_error('region_name');?>
                              <input name="region_name" id="region_name" value="<?=set_value('region_name')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Region Description</label>
                              <?php echo form_error('region_description'); ?>
                              <textarea name="region_description" class="form-control" rows="7"><?=set_value('region_description')?></textarea>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-5">
                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Region Phone</label>
                              <?php echo form_error('region_phone'); ?>
                              <input name="region_phone" id="region_phone" value="<?=set_value('region_phone')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Region Fax</label>
                              <?php echo form_error('region_fax'); ?>
                              <input name="region_fax" id="region_fax" value="<?=set_value('region_fax')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Region Email</label>
                              <?php echo form_error('region_email'); ?>
                              <input name="region_email" id="region_email" value="<?=set_value('region_email')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>  
                           <div class="col-md-12">
                              <label class="form-label">Region Office Address</label>
                              <?php echo form_error('region_address'); ?>
                              <textarea name="region_address" class="form-control"><?=set_value('region_address')?></textarea>
                           </div>
                           <div class="col-md-12">      
                              <label class="form-label">Region Logo</label>
                              <div><?php echo form_error('userfile'); ?></div>
                              <input type="file" name="userfile">                  
                              <p class="help-block">File type jpg, png, jpeg, gif and maximun file size 1 MB.</p>
                           </div>                   
                        </div>
                     </div>
                  </div>

                  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
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
      $('#office_region_validate').validate({
          // focusInvalid: false, 
          ignore: "",
          rules: {
             region_type: {
                required: true
             },
             region_name: {
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
         },

       });
    });   
</script>