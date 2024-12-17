<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('offices/nhq')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('offices/nhq')?>" class="btn btn-blueviolet btn-xs btn-mini"> NHQ User List</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <?php echo validation_errors(); ?>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php 
                  $attributes = array('id' => 'username_validate');
                  echo form_open_multipart(uri_string(),$attributes);
                  ?>

                  <div class="row form-row">
                     <h4 class="semi-bold margin_left_15"> <?=$info->grp_name;?> </h4>
                     <h5 class="semi-bold margin_left_15">Current Username: <strong><?=$info->username?></strong></h5>
                     
                     <div class="col-md-4">
                        <label class="form-label">Username <span class="required">*</span> <span style="margin-left: 20px; color: black; font-weight: bold;"><span id="mask_username"></span></span></label> 
                        <?php echo form_error('identity'); ?>                      
                        <input name="identity" id="identity" type="text" value="<?=set_value('identity', $info->username)?>" class="form-control input-sm" placeholder="" style="text-transform: lowercase; width: 300px;"> 
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

      $('#username_validate').validate({
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
            }
         },

         messages: {
            identity: {
               required: "Username required.",
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
