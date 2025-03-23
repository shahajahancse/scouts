<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('my_office')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('my_profile/cbox')?>" class="btn btn-blueviolet btn-xs btn-mini"> List </a>
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php
                  $attributes = array('id' => 'scout_unit_validate');
                  echo form_open_multipart("my_profile/add_cbox/", $attributes);?>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label"> Write Command <span class="required">*</span></label>
                              <?php echo form_error('complain');?>
                              <textarea name="complain" class="form-control input-sm"><?=set_value('complain')?></textarea>
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
      $('#scout_unit_validate').validate({
      // focusInvalid: false,
      ignore: "",
      rules: {
         unit_type: {
            required: true
         },
         unit_name: {
            required: true,
            maxlength: 255,
            minlength: 10
         },
         unit_number: {
            number:true
         },
         unit_mobile: {
            number:true
         },
         unit_email:{
            email: true
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
