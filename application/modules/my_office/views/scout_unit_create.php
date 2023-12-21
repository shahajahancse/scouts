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
                  $attributes = array('id' => 'scout_unit_validate');
                  echo form_open_multipart("my_office/scout_unit_create/", $attributes);?>
                  
                  <div class="row">
                     <div class="col-md-12">
                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Scout Region </label>
                              <h5 class="semi-bold"><?=$region_info->region_name?></h5>
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Scout District </label>
                              <h5 class="semi-bold"><?=$district_info->dis_name?></h5>  
                           </div>
                        </div>
                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Scout Upazila</label>
                              <h5 class="semi-bold"><?=$upazila_info->upa_name?></h5>
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Scout Group </label>
                              <h5 class="semi-bold"><?=$group_info->grp_name?></h5>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-12">                        
                        <div class="row form-row">
                           <div class="col-md-7">
                              <label class="form-label"> Scout Unit Name <span class="required">*</span></label>
                              <?php echo form_error('unit_name');?>
                              <input name="unit_name" value="<?=set_value('unit_name')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                           <div class="col-md-5">
                              <label class="form-label"> Search and Select Member </label>
                              <?php echo form_error('unit_leader');?>
                              <select class="scoutIDselect2 form-control" name="unit_leader"></select>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-4">
                              <label class="form-label">Unit Type <span class="required">*</span></label>
                              <?php 
                              echo form_error('unit_type');
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('unit_type', $sc_unit_types, set_value('unit_type'), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-4">
                              <label class="form-label"> Created Date</label>
                              <?php echo form_error('unit_created');?>
                              <input name="unit_created" value="<?=set_value('unit_created')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                           </div>
                           <div class="col-md-4">
                              <label class="form-label"> Unit Number</label>
                              <?php echo form_error('grp_number');?>
                              <input name="unit_number" value="<?=set_value('unit_number')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>                        

                        <div class="row form-row">
                           <div class="col-md-4">
                              <label class="form-label">Mobile No. </label>
                              <?php echo form_error('unit_mobile'); ?>
                              <input name="unit_mobile" value="<?=set_value('unit_mobile')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>                          
                           <div class="col-md-4">
                              <label class="form-label">Email</label>
                              <?php echo form_error('unit_email'); ?>
                              <input name="unit_email" value="<?=set_value('unit_email')?>" type="text" class="form-control input-sm" placeholder="">
                           </div> 
                           <div class="col-md-4">
                              <label class="form-label">Address</label>
                              <?php echo form_error('unit_address'); ?>
                              <input name="unit_address" value="<?=set_value('unit_address')?>" type="text" class="form-control input-sm" placeholder="">
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