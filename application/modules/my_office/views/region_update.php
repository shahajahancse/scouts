<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('my_office')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('my_office')?>" class="btn btn-blueviolet btn-xs btn-mini"> My Office</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">                        
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php 
                    $attributes = array('id' => 'office_region_validate');
                    echo form_open_multipart(uri_string(), $attributes);
                  ?>
                  
                  <div class="row">
                     <div class="col-md-7">
                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Division</label>
                              <?php if($info->region_type == 'divisional'){ ?> 
                                <h5 class="semi-bold-black"> <?=$info->div_name?> </h5>
                              <?php }else{ ?>
                                <h5 class="semi-bold-black"> Not Applicable </h5>
                              <?php } ?>
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Region Type </label>
                              <?php if($info->region_type == 'divisional'){ ?> 
                                <h5 class="semi-bold-black"> <?=func_region_type($info->region_type)?> </h5>
                              <?php }else{ ?>
                                <h5 class="semi-bold-black"> <?=func_region_type($info->region_type)?> </h5>
                              <?php } ?>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Region Name (Bangla) <span class="required">*</span></label>
                              <?php echo form_error('region_name');?>
                              <input name="region_name" id="region_name" value="<?=set_value('region_name', $info->region_name)?>" type="text" class="form-control input-sm bangla" placeholder=""  contenteditable="TRUE">
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Region Name (English) <span class="required">*</span></label>
                              <?php echo form_error('region_name_en');?>
                              <input name="region_name_en" id="region_name_en" value="<?=set_value('region_name_en', $info->region_name_en)?>" type="text" class="form-control input-sm" placeholder="Example: Bangladesh Scouts, Chittagong Region">
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Region Description (Bangla)</label>
                              <?php echo form_error('region_description_bn'); ?>
                              <textarea name="region_description_bn" class="form-control" rows="15"><?=set_value('region_description_bn', $info->region_description_bn)?></textarea>
                           </div>
                        </div>
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Region Description (English)</label>
                              <?php echo form_error('region_description'); ?>
                              <textarea name="region_description" class="form-control" rows="15"><?=set_value('region_description', $info->region_description)?></textarea>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-5">
                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Region Phone</label>
                              <?php echo form_error('region_phone'); ?>
                              <input name="region_phone" id="region_phone" value="<?=set_value('region_phone', $info->region_phone)?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                           
                           <div class="col-md-6">
                              <label class="form-label">Region Fax</label>
                              <?php echo form_error('region_fax_bn'); ?>
                              <input name="region_fax_bn" id="region_fax_bn" value="<?=set_value('region_fax_bn', $info->region_fax_bn)?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>
                        
                        <div class="row form-row">
                          <div class="col-md-12">
                              <label class="form-label">Region Email</label>
                              <?php echo form_error('region_email'); ?>
                              <input name="region_email" id="region_email" value="<?=set_value('region_email', $info->region_email)?>" type="text"  class="form-control input-sm" placeholder="">
                           </div>

                           <div class="col-md-12">
                              <label class="form-label">Region Office Address (Bangla)</label>
                              <?php echo form_error('region_address_bn'); ?>
                              <textarea name="region_address_bn" class="form-control"><?=set_value('region_address_bn', $info->region_address_bn)?></textarea>
                           </div>
                           <div class="col-md-12">
                              <label class="form-label">Region Office Address (English)</label>
                              <?php echo form_error('region_address'); ?>
                              <textarea name="region_address" class="form-control"><?=set_value('region_address', $info->region_address)?></textarea>
                           </div>
                           <div class="col-md-12">      
                              <label class="form-label">Region Logo</label>
                              <div><?php echo form_error('userfile'); ?></div>
                              <input type="file" name="userfile">                  
                              <p class="help-block">File type jpg, png, jpeg, gif and maximun file size 1 MB.</p>
                              <?php 
                              $img_path = base_url().'offices_img/';
                              if($info->region_logo != NULL){
                                $src= $img_path.$info->region_logo;
                                echo "<img src='$src' height='100'>";
                             }
                             ?>
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
             region_name: {
                required: true
             },
             region_name_en: {
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