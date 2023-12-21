<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('offices/region')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('offices/region')?>" class="btn btn-blueviolet btn-xs btn-mini"> Region List</a>  
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
                  echo form_open_multipart(uri_string(),$attributes);
                  ?>

                  <div class="row form-row">
                     <h5 class="semi-bold margin_left_15">Create username, password and mobile number for retrieve password</h5>
                     <h4 class="semi-bold margin_left_15"> <?=$info->region_name;?> </h4>
                     <div class="col-md-4">
                        <label class="form-label">Username <span class="required">*</span> <span style="margin-left: 20px; color: black; font-weight: bold;"><span id="mask_username"></span></span></label> 
                        <?php echo form_error('identity'); ?>                      
                        <input name="identity" id="identity" type="text" value="<?=set_value('identity', 'ra_'.$this->input->post('identity'))?>" class="form-control input-sm" placeholder="Example: ra_dhaka" style="text-transform: lowercase;">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Password <span class="required">*</span></label>
                        <?php echo form_error('password'); ?>
                        <input name="password" id="password" type="text" class="form-control input-sm" placeholder="Mininum 8 character">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Mobile Number (for password retrieve)</label>
                        <?php echo form_error('phone'); ?>
                        <input name="phone" id="phone" type="text" class="form-control input-sm" placeholder="Mobile Number (11 Digit)">
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
      $.validator.addMethod("noSpace", function(value, element) { 
         return value.indexOf(" ") < 0 && value != ""; 
      }, "No space allowed use underscore symbol like ' _ '");

      $('#office_region_validate').validate({
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
            phone:{
               required: false,
               number: true,
               minlength: 11,
               maxlength: 11
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

      // onChange Method
      $('#identity').keyup(function(){
         // $('#mask_username').html($('#identity').val());
         $('#mask_username').html($(this).val().toLowerCase());
      });

   });   
</script>
