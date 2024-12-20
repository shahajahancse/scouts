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
                     <a href="<?=base_url('offices/nhq')?>" class="btn btn-success btn-xs btn-mini"> NHQ User List</a>  
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
                    $attributes = array('id' => 'office_nhq_validate');
                    echo form_open_multipart("offices/nhq_create", $attributes);
                  ?>

                  <div class="row">
                    <div class="col-md-7">
                      <div class="row form-row">
                       <div class="col-md-12">
                          <label class="form-label">Office Name <span class="required">*</span></label>
                          <?php echo form_error('nhq_office_name');?>
                          <?php echo form_input($nhq_office_name); ?>
                       </div> 
                     </div>
                     <div class="row form-row">
                    <div class="col-md-7">
                        <label class="form-label">Email/Username <span class="required">*</span> <span style="margin-left: 20px; color: black; font-weight: bold;"><span id="mask_username"></span></span></label> 
                        <?php echo form_error('identity'); ?>                      
                        <?php echo form_input($identity)?> 
                      </div>
                      <div class="col-md-5">
                        <label class="form-label">Password <span class="required">*</span></label>
                        <?php echo form_error('password'); ?>
                        <?php echo form_password($password)?> 
                     </div>
                    </div>
                    </div>
                    <div class="col-md-5">
                      <h5 class="semi-bold margin_left_15">User Group Role <span class="required">*</span></h5>  
                      <?php foreach ($groups as $group):?>
                        <?php
                        $gID=$group['id'];
                        $checked = null;
                        $item = null;
                        ?>
                        <div style="color: black; font-weight: bold; margin-left: 20px;">
                          <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                          <?php echo htmlspecialchars($group['description'],ENT_QUOTES,'UTF-8');?>
                        </div>
                      <?php endforeach?>
                      <label for="groups[]" class="error" style="display: none;">Please select at least two types of spam.</labe>
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
      }, "No space please and don't leave it empty");

      $('#office_nhq_validate').validate({
          // focusInvalid: false, 
          ignore: "",
          rules: {
              nhq_office_name:{
                required: true
             },
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
             'groups[]': {
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

      // onChange Method
      $('#identity').keyup(function(){
        // $('#mask_username').html($('#identity').val());
        $('#mask_username').html($(this).val().toLowerCase());
      });

    });   
</script>
