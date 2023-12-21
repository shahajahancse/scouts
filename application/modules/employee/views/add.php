<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
         <li><a href="<?=base_url('award')?>" class="active"><?=$module_name?></a></li>
         <li><?=$meta_title; ?></li>
      </ul>
      <style type="text/css">
         #memberDiv td{padding: 5px;}
         #memberDiv th{padding: 5px; font-weight: bold; color: black;}
         #workStationDiv td{padding: 5px;}

         /*.form-row input {
             height:35px
         }*/
      </style>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('employee/all')?>" class="btn btn-blueviolet btn-xs btn-mini"> Employee / PDS List</a>  
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
                  $attributes = array('id' => 'validate');
                  echo form_open_multipart("employee/create", $attributes);
                  ?>
                  
                  <div class="row">
                     <h4 class="margin_left_15 semi-bold">Employee / PDS Information</h4>
                     <div class="col-md-12">
                        <div class="row form-row">
                           <div class="col-md-3">
                              <label class="form-label">Full Name (English) <span class='required'>*</span></label>
                              <?php echo form_error('full_name'); ?>
                              <input type="text" name="full_name" class="form-control input-sm" value="<?=set_value('full_name')?>">
                           </div>

                           <div class="col-md-3">
                              <label class="form-label">Full Name (Bangla) <span class='required'>*</span></label>
                              <?php echo form_error('full_name_bn'); ?>
                              <input type="text" name="full_name_bn" class="form-control input-sm" value="<?=set_value('full_name_bn')?>">
                           </div>
                           <!-- <div class="col-md-4">
                              <label class="form-label">Identification Card No<span class='required'>*</span></label>
                              <?php echo form_error('emp_identity'); ?>
                              <input type="text" name="emp_identity" class="bangla form-control input-sm" value="<?=set_value('emp_identity')?>" contenteditable="TRUE">
                           </div> -->
                        
                           <div class="col-md-3">
                              <label class="form-label">Mobile No. <span class='required'>*</span></label>
                              <?php echo form_error('phone'); ?>
                              <input name="phone" value="<?=set_value('phone')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>

                           <div class="col-md-3">
                              <label class="form-label">Email Address<span class='required'>*</span></label>
                              <?php echo form_error('email'); ?>
                              <input name="email" value="<?=set_value('email')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>

                        </div>
                        <div class="row form-row">

                           <div class="col-md-3">
                              <label class="form-label">Date of Birth <span class='required'>*</span></label>
                              <?php echo form_error('dob');?>
                              <input type="date" name="dob" class="form-control input-sm" value="<?=set_value('dob')?>">
                           </div>

                           <div class="col-md-3">
                              <label class="form-label">Gender <span class='required'>*</span></label>
                              <?php echo form_error('gender'); ?>
                              <input type="radio" name="gender" value="Male" <?=set_value('gender')=='Male'?'checked':'checked';?>> <span style="color: black; font-size: 14px;">Male</span> 
                              <input type="radio" name="gender" value="Female" <?=set_value('gender')=='Female'?'checked':'';?>> <span style="color: black; font-size: 14px;">Female</span>
                           </div>

                           <div class="col-md-3">
                              <label class="form-label">Service Area<span class='required'>*</span></label>
                              <?php echo form_dropdown('service_area_id', $service_area, set_value('service_area_id'), 'id="service"', 'style="width:100%"'); ?>
                           </div>

                            <div class="col-md-3">
                              <label class="form-label">Designation<span class='required'>*</span></label>
                              <?php echo form_dropdown('designation', $designation, set_value('designation'), 'id="designation" class="designation_val"', 'style="width:100%"'); ?>
                           </div>
                          </div>
                          <div class="row form-row">

                           <div class="col-md-3">
                              <label class="form-label">Department<span class='required'>*</span></label>
                              <?php echo form_dropdown('department', $department, set_value('department'),  'style="width:100%"'); ?>
                           </div>

                         
                           <div class="col-md-3">
                              <label class="form-label">Official ID Type <span class='required'>*</span></label>
                              <?php echo form_error('office_id_type'); ?>
                              <input type="radio" name="office_id_type" value="1" <?=set_value('office_id_type')==1?'checked':'checked';?>> <span style="color: black; font-size: 14px;">Professional</span> 
                              <input type="radio" name="office_id_type" value="2" <?=set_value('office_id_type')==2?'checked':'';?>> <span style="color: black; font-size: 14px;">Volunteer</span>
                           </div>
 
                           
                           <div class="col-md-3">
                              <label class="form-label">Status <span class='required'>*</span></label>
                              <?php echo form_error('status'); ?>
                              <input type="radio" name="status" value="1" <?=set_value('status',$info->status)==1?'checked':'checked';?>> <span style="color: black; font-size: 14px;">Active</span> 
                              <input type="radio" name="status" value="0" <?=set_value('status',$info->status)==0?'checked':'';?>> <span style="color: black; font-size: 14px;">Deactivate</span>
                           </div>

                       </div>
                       <div class="row form-row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Profile Image</label>
                                 <div><?php echo form_error('userfile'); ?></div>
                                 <input type="file" name="userfile">
                              </div>
                           </div>

                           <div class="col-md-4">  
                              
                              <div class="form-group">
                                 <label>Signature</label>
                                 <div><?php echo form_error('userfile1'); ?></div>
                                 <input type="file" name="userfile1">
                              </div>
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Desk Officer <span class='required'>*</span></label>
                              <?php echo form_error('desk_officer'); ?>
                              <input type="radio" name="desk_officer" value="1" <?=set_value('desk_officer',$info->desk_officer)==1?'checked':'checked';?>> <span style="color: black; font-size: 14px;">Yes</span> 
                              <input type="radio" name="desk_officer" value="0" <?=set_value('desk_officer',$info->desk_officer)==0?'checked':'';?>> <span style="color: black; font-size: 14px;">No</span>
                           </div>
 
                           <div class="col-md-12" style="color: red; font-weight: 600"><strong>Note:</strong> Maximum file size 400 KB</div>
                        </div>
                     </div>
                     <div class="col-md-12">
                        
                        <!-- <div class="row">
                           <div class="col-md-4">
                              <label class="form-label">Username <span class='required'>*</span></label>
                              <?php echo form_error('identity'); ?>
                              <input name="identity" value="<?=set_value('identity')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                           
                        </div>  -->


                        <div class="form-actions">  
                           <div class="pull-right">
                              <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> সংরক্ষণ</button>
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

      $('#validate').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            full_name: { required: true },
            emp_identity: { required: true },
            phone: { required: true },
            email: { required: true },
            department: { required: true },
            designation: { required: true },
            identity: { required: true },
            password: { required: true },

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