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
                  $attributes = array('id' => 'office_upazila_validate');
                  echo form_open_multipart(uri_string(),$attributes);
                  ?>
                  
                  <div class="row">
                     <div class="col-md-7">
                        <div class="row form-row">
                           <div class="col-md-4">
                              <label class="form-label">Division</label>
                              <h5 class="semi-bold-black"><?=$info->div_name?></h5>
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">District</label>
                              <h5 class="semi-bold-black"><?=$info->district_name?></h5>
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">Upazila/Thana</label>
                              <h5 class="semi-bold-black"><?=$info->up_th_name?></h5>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Scouts Upazila (Bangla) <span class="required">*</span></label>
                              <?php echo form_error('upa_name');?>
                              <input name="upa_name" id="upa_name" value="<?=set_value('upa_name', $info->upa_name)?>" type="text" class="form-control input-sm bangla" placeholder="" contenteditable="TRUE">
                           </div>
                           <div class="col-md-12">
                              <label class="form-label">Scouts Upazila (English) <span class="required">*</span></label>
                              <?php echo form_error('upa_name_en');?>
                              <input name="upa_name_en" id="upa_name_en" value="<?=set_value('upa_name_en', $info->upa_name_en)?>" type="text" class="form-control input-sm" placeholder="Example: Bangladesh Scouts, Raozan Upazila">
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Description (Bangla)</label>
                              <?php echo form_error('upa_description'); ?>
                              <textarea name="upa_description" class="form-control" rows="7"><?=set_value('upa_description', $info->upa_description)?></textarea>
                           </div>

                           <div class="col-md-12">
                              <label class="form-label">Description (English)</label>
                              <?php echo form_error('upa_description_en'); ?>
                              <textarea name="upa_description_en" class="form-control" rows="7"><?=set_value('upa_description_en', $info->upa_description_en)?></textarea>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-5">
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Scouts Region</label>
                              <h5 class="semi-bold-black"><?=$info->region_name?></h5>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Scouts District </label>
                              <h5 class="semi-bold-black"><?=$info->dis_name?></h5>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Phone</label>
                              <?php echo form_error('upa_phone'); ?>
                              <input name="upa_phone" id="upa_phone" value="<?=set_value('upa_phone', $info->upa_phone)?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Fax</label>
                              <?php echo form_error('upa_fax'); ?>
                              <input name="upa_fax" id="upa_fax" value="<?=set_value('upa_fax', $info->upa_fax)?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Email</label>
                              <?php echo form_error('upa_email'); ?>
                              <input name="upa_email" id="upa_email" value="<?=set_value('upa_email', $info->upa_email)?>" type="text"  class="form-control input-sm" placeholder="">
                           </div>  
                           <div class="col-md-12">
                              <label class="form-label">Office Address (Bangla)</label>
                              <?php echo form_error('upa_address'); ?>
                              <textarea name="upa_address" class="form-control"><?=set_value('upa_address', $info->upa_address)?></textarea>
                           </div>
                           <div class="col-md-12">
                              <label class="form-label">Office Address (English)</label>
                              <?php echo form_error('upa_address_en'); ?>
                              <textarea name="upa_address_en" class="form-control"><?=set_value('upa_address_en', $info->upa_address_en)?></textarea>
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
   $('#office_upazila_validate').validate({
          // focusInvalid: false, 
          ignore: "",
          rules: {
             upa_name: {
                required: true
             },
             upa_name_en: {
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