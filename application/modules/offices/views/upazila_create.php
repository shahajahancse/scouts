<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('offices/upazila')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('offices/upazila')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts Upazila List</a>  
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
                    $attributes = array('id' => 'office_upazila_validate');
                    echo form_open_multipart("offices/upazila_create",$attributes);
                  ?>

                  <div class="row form-row">
                    <h5 class="semi-bold margin_left_15">Create username, password for scouts upazila admin</h5>
                    <div class="col-md-4">
                      <label class="form-label">Username <span class="required">*</span> <span style="margin-left: 20px; color: black; font-weight: bold;"><span id="mask_username"></span></span></label> 
                      <?php echo form_error('identity'); ?>                      
                      <input name="identity" id="identity" type="text" value="<?=set_value('identity', 'ua_'.$this->input->post('identity'))?>" class="form-control input-sm" placeholder="Example: ua_upazila_name" style="text-transform: lowercase;">
                   </div>
                   <div class="col-md-4">
                      <label class="form-label">Password <span class="required">*</span></label>
                      <?php echo form_error('password'); ?>
                      <input name="password" id="password" type="text" class="form-control input-sm" placeholder="Mininum 8 character">
                   </div>
                  </div> 
                  
                  <div class="row">
                    <h5 class="semi-bold margin_left_15">Upazila Office Information</h5>
                     <div class="col-md-7">
                        <div class="row form-row">
                           <div class="col-md-4">
                              <label class="form-label">Division</label>
                              <?php echo form_error('upa_div_id');
                              $more_attr = 'class="form-control input-sm" id="division"';
                              echo form_dropdown('upa_div_id', $divisions, set_value('upa_div_id'), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">District</label>
                              <?php echo form_error('upa_dis_id'); ?>
                              <select name="upa_dis_id" class="distirict_val form-control input-sm"  id="district">
                                 <option value="">-- Select District --</option>
                              </select>
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">Upazila/Thana</label>
                              <?php echo form_error('upa_upa_id'); ?>
                              <select name="upa_upa_id" class="upazila_thana_val form-control input-sm" >
                                 <option value="">-- Select One --</option>
                              </select>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Scouts Upazila Name (Bangla) <span class="required">*</span></label>
                              <?php echo form_error('upa_name');?>
                              <input name="upa_name" id="upa_name" value="<?=set_value('upa_name')?>" type="text" class="form-control input-sm bangla" placeholder="" contenteditable="TRUE">
                           </div>
                           <div class="col-md-12">
                              <label class="form-label">Scouts Upazila Name (English) <span class="required">*</span></label>
                              <?php echo form_error('upa_name_en');?>
                              <input name="upa_name_en" id="upa_name_en" value="<?=set_value('upa_name_en')?>" type="text" class="form-control input-sm" placeholder="Example: Bangladesh Scouts, Raozan Upazila">
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Description</label>
                              <?php echo form_error('upa_description'); ?>
                              <textarea name="upa_description" class="form-control" rows="7"><?=set_value('upa_description')?></textarea>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-5">
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Select Scouts Region <span class="required">*</span></label>
                              <?php 
                              echo form_error('upa_region_id');
                              $more_attr = 'class="form-control input-sm" id="region"';
                              echo form_dropdown('upa_region_id', $regions, set_value('upa_region_id'), $more_attr);
                              ?>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Select Scouts District <span class="required">*</span></label>
                              <?php echo form_error('upa_scout_dis_id'); ?>
                              <select name="upa_scout_dis_id" class="sc_district_val form-control input-sm"  id="distirict">
                                 <option value="">-- Select One --</option>
                              </select>
                           </div>
                        </div>


                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Phone</label>
                              <?php echo form_error('upa_phone'); ?>
                              <input name="upa_phone" id="upa_phone" value="<?=set_value('upa_phone')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Fax</label>
                              <?php echo form_error('upa_fax'); ?>
                              <input name="upa_fax" id="upa_fax" value="<?=set_value('upa_fax')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Email</label>
                              <?php echo form_error('upa_email'); ?>
                              <input name="upa_email" id="upa_email" value="<?=set_value('upa_email')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>  
                           <div class="col-md-12">
                              <label class="form-label">Office Address</label>
                              <?php echo form_error('upa_address'); ?>
                              <textarea name="upa_address" class="form-control"><?=set_value('upa_address')?></textarea>
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

      //JS Validation
      $('#office_upazila_validate').validate({
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
             upa_name: {
                required: true
             },
             upa_name_en: {
                required: true
             },
             upa_region_id: {
                required: true
             },
             upa_scout_dis_id: {
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