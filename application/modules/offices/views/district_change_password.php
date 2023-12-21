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
                  <?php if($this->ion_auth->is_admin()){ ?>
                  <div class="pull-right">                
                     <a href="<?=base_url('offices/district')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts District List</a>  
                  </div>
                  <?php } ?>
               </div>
               <div class="grid-body">                  
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php 
                  $attributes = array('id' => 'password_validate');                    
                  echo form_open_multipart(uri_string(), $attributes);
                  ?>

                  <div class="row form-row">
                     <h4 class="semi-bold margin_left_15">স্কাউট জেলা অফিসঃ- <?=$info->dis_name;?> </h4>
                     <div class="col-md-4">
                        <label class="form-label">Username</label>
                        <h4  class="semi-bold"> <?=$info->username;?></h4>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">New Password (Minimum 8 characters long) <span class="required">*</span></label>
                        <?php echo form_error('new'); ?>
                        <?php echo form_input($new_password);?>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Confirm New Password <span class="required">*</span></label>
                        <?php echo form_error('new_confirm'); ?>
                        <?php echo form_input($new_password_confirm);?>
                     </div>
                  </div>                  

                  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                     </div>
                  </div>
                  <?php echo form_input($user_id);?>
                  <?php echo form_close();?>

               </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>
<script type="text/javascript">
   $(document).ready(function() {
      $('#password_validate').validate({
          // focusInvalid: false, 
          ignore: "",
          rules: {
             new: {
                required: true,
                minlength: 8,
             },
             new_confirm: {
                required: true,                
                equalTo: "#new"
             },
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
