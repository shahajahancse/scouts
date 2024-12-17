<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('offices/district')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('offices/district')?>" class="btn btn-success btn-xs btn-mini"> Scouts District List</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <div><?php //echo validation_errors(); ?></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php 
                    $attributes = array('id' => 'office_district_validate');
                    echo form_open_multipart("offices/district_create",$attributes);
                  ?>

                  <div class="row form-row">
                    <h5 class="semi-bold margin_left_15">Create username, password for scouts district admin</h5>
                    <div class="col-md-4">
                      <label class="form-label">Username <span class="required">*</span> <span style="margin-left: 20px; color: black; font-weight: bold;"><span id="mask_username"></span></span></label> 
                      <?php echo form_error('identity'); ?>                      
                      <input name="identity" id="identity" type="text" value="<?=set_value('identity', 'da_'.$this->input->post('identity'))?>" class="form-control input-sm" placeholder="Example: da_dhaka" style="text-transform: lowercase;">
                   </div>
                   <div class="col-md-4">
                      <label class="form-label">Password <span class="required">*</span></label>
                      <?php echo form_error('password'); ?>
                      <input name="password" id="password" type="text" class="form-control input-sm" placeholder="Mininum 8 character">
                   </div>
                  </div>
                  
                  <div class="row">
                    <h5 class="semi-bold margin_left_15">Scouts District Office Information</h5>
                     <div class="col-md-7">
                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Division</label>
                              <?php echo form_error('dis_div_id');
                              $more_attr = 'class="form-control input-sm" id="division"';
                              echo form_dropdown('dis_div_id', $divisions, set_value('dis_div_id'), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">District</label>
                              <?php echo form_error('dis_dis_id');?>
                              <select name="dis_dis_id" class="distirict_val form-control input-sm">
                                 <option value="">-- Select District --</option>
                              </select>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Select Scouts Region <span class="required">*</span></label>
                              <?php echo form_error('dis_scout_region_id');
                              $more_attr = 'class="form-control input-sm" ';
                              echo form_dropdown('dis_scout_region_id', $regions, set_value('dis_scout_region_id'), $more_attr);
                              ?>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Scouts District Name (Bangla) <span class="required">*</span></label>
                              <?php echo form_error('dis_name');?>
                              <input name="dis_name" id="dis_name" value="<?=set_value('dis_name')?>" type="text" class="form-control input-sm bangla" placeholder="" ontenteditable="TRUE">
                           </div>
                           <div class="col-md-12">
                              <label class="form-label">Scouts District Name (English) <span class="required">*</span></label>
                              <?php echo form_error('dis_name_en');?>
                              <input name="dis_name_en" id="dis_name_en" value="<?=set_value('dis_name_en')?>" type="text" class="form-control input-sm" placeholder="Example: Bangladesh Scouts, Chittagong District">
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Description</label>
                              <?php echo form_error('dis_description'); ?>
                              <textarea name="dis_description" class="form-control" rows="7"><?=set_value('dis_description')?></textarea>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-5">
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">District Type <span class="required">*</span></label>
                              <?php echo form_error('dis_type');                         
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('dis_type', $dis_type, set_value('dis_type'), $more_attr);
                              ?>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Phone</label>
                              <?php echo form_error('dis_phone'); ?>
                              <input name="dis_phone" id="dis_phone" value="<?=set_value('dis_phone')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Fax</label>
                              <?php echo form_error('dis_fax'); ?>
                              <input name="dis_fax" id="dis_fax" value="<?=set_value('dis_fax')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Email</label>
                              <?php echo form_error('dis_email'); ?>
                              <input name="dis_email" id="dis_email" value="<?=set_value('dis_email')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>  
                           <div class="col-md-12">
                              <label class="form-label">Office Address</label>
                              <?php echo form_error('dis_address'); ?>
                              <textarea name="dis_address" class="form-control"><?=set_value('dis_address')?></textarea>
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
      // Jquery custome validate
      $.validator.addMethod("noSpace", function(value, element) { 
         return value.indexOf(" ") < 0 && value != ""; 
      }, "No space allowed use underscore symbol like ' _ '");

      //Validation
      $('#office_district_validate').validate({
          // focusInvalid: false, 
          ignore: "",
          rules: {
              identity: {
                required: true, 
                noSpace: true,
                minlength: 3,
                remote: {
                   url: hostname +"offices/ajax_exists_identity/",
                   type: "post",
                   data: {
                      inputData: function() {
                         return $( "#identity" ).val();
                      }
                   }
                }         
             }, 
             password: {
                required: true,
                minlength: 8,
             },
             dis_scout_region_id: {
                required: true
             },
             dis_name: {
                required: true
             },
             dis_name_en: {
                required: true
             },
             dis_type: {
                required: true
             }
          },

          messages: {
             identity: {
                required: "Username required.",
                minlength: jQuery.format("Enter at least {0} characters"),
                remote: jQuery.format("Already in use! Please try another.")
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