ok<div class="page-content">     
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
                  <!-- <div class="pull-right">                
                     <a href="<?=base_url('employee/all')?>" class="btn btn-blueviolet btn-xs btn-mini"> Employee / PDS List</a>  
                  </div> -->
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
                  echo form_open_multipart("my_profile/emp_update/".$info->id, $attributes);
                  ?>
                  
                  <div class="row">
                     <!-- <h4 class="margin_left_15 semi-bold">Employee / PDS Information</h4> -->
                     <div class="col-md-12">
                        <div class="row form-row">
                           <div class="col-md-3">
                              <label class="form-label">পুরো নাম (ইংরেজি) <span class='required'>*</span></label>
                              <?php echo form_error('full_name'); ?>
                              <input type="text" name="full_name" class="form-control input-sm" value="<?=set_value('full_name',$info->first_name)?>">
                           </div>

                           <div class="col-md-3">
                              <label class="form-label">পুরো নাম (বাংলা) <span class='required'>*</span></label>
                              <?php echo form_error('full_name_bn'); ?>
                              <input type="text" name="full_name_bn" class="form-control input-sm" value="<?=set_value('full_name_bn',$info->full_name_bn)?>">
                           </div>
                           <!-- <div class="col-md-4">
                              <label class="form-label">Identification Card No<span class='required'>*</span></label>
                              <?php echo form_error('emp_identity'); ?>
                              <input type="text" name="emp_identity" class="bangla form-control input-sm" value="<?=set_value('emp_identity')?>" contenteditable="TRUE">
                           </div> -->
                        
                           <div class="col-md-3">
                              <label class="form-label">মোবাইল নাম্বার <span class='required'>*</span></label>
                              <?php echo form_error('phone'); ?>
                              <input name="phone" value="<?=set_value('phone',$info->phone)?>" type="text" class="form-control input-sm" placeholder="">
                           </div>

                           <div class="col-md-3">
                              <label class="form-label">ইমেল<span class='required'>*</span></label>
                              <?php echo form_error('email'); ?>
                              <input name="email" value="<?=set_value('email',$info->email)?>" type="text" class="form-control input-sm" placeholder="">
                           </div>

                        </div>
                        <div class="row form-row">

                           <div class="col-md-3">
                              <label class="form-label">জন্ম তারিখ<span class='required'>*</span></label>
                              <?php echo form_error('dob');?>
                              <input type="date" name="dob" class="datetime form-control input-sm" value="<?=set_value('dob',$info->dob)?>">
                           </div>

                           <div class="col-md-2">
                              <label class="form-label">লিঙ্গ <span class='required'>*</span></label>
                              <?php echo form_error('gender'); ?>
                              <input type="radio" name="gender" value="Male" <?=set_value('gender')=='Male'?'checked':'checked';?>> <span style="color: black; font-size: 14px;">Male</span> 
                              <input type="radio" name="gender" value="Female" <?=set_value('gender')=='Female'?'checked':'';?>> <span style="color: black; font-size: 14px;">Female</span>
                           </div>

                           <div class="col-md-2">
                              <label class="form-label">রক্তের গ্রুপ</label>
                              <?php echo form_error('blood_group');
                              $more_attr = 'class="form-control input-sm" ';
                              echo form_dropdown('blood_group', $blood_group, set_value('blood_group', $info->blood_group), $more_attr);
                              ?>
                           </div>

                           <div class="col-md-2">
                              <label class="form-label">ধর্ম <span class='required'>*</span></label>
                              <?php echo form_error('religion_id');
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('religion_id', $religions, set_value('religion_id', $info->religion_id), $more_attr);
                              ?>
                           </div>

                           <div class="col-md-3">
                              <label class="form-label">জাতীয় পরিচয়পত্র নম্বর <span class='required'>*</span></label>
                              <?php echo form_error('nid'); ?>
                              <input name="nid" value="<?=set_value('nid',$info->nid)?>" type="text" class="form-control input-sm" placeholder="">
                              
                           </div>

                            <!-- <div class="col-md-3">
                              <label class="form-label">Designation<span class='required'>*</span></label>
                              <?php echo form_dropdown('designation', $designation, set_value('designation',$info->emp_designation), 'id="designation" class="designation_val"', 'style="width:100%"'); ?>
                           </div>

                            <div class="col-md-3">
                              <label class="form-label">Department<span class='required'>*</span></label>
                              <?php echo form_dropdown('department', $department, set_value('department',$info->emp_department),  'style="width:100%"'); ?>
                           </div> -->
                          </div>
                          <div class="row form-row">

                            <div class="col-md-4">  
                              <?php
                              $path = base_url().'profile_img/';
                              if($info->profile_img != NULL){
                                 $p_img_url = '<img src="'.$path.$info->profile_img.'" width="90" style="border:1px solid #ccc; padding:3px;">';
                              }else{
                                 $p_img_url = '';
                              }
                              echo $p_img_url;
                              ?>
                              <div class="form-group">
                                 <label>প্রোফাইল ছবি</label>
                                 <div><?php echo form_error('userfile'); ?></div>
                                 <input type="file" name="userfile">
                              </div>
                           </div>

                           <div class="col-md-4">  
                              <?php
                              $path = base_url().'employee_img/';
                              if($info->emp_singature != NULL){
                                 $s_img_url = '<img src="'.$path.$info->emp_singature.'" width="90" style="border:1px solid #ccc; padding:3px;">';
                              }else{
                                 $s_img_url = '';
                              }
                              echo $s_img_url;
                              ?>
                              <div class="form-group">
                                 <label>স্বাক্ষর</label>
                                 <div><?php echo form_error('userfile1'); ?></div>
                                 <input type="file" name="userfile1">
                              </div>
                           </div>
                           
                           <div class="col-md-12" style="color: red; font-weight: 600">
                              <strong>Note:</strong> Maximum file size 400 KB</div>
                           </div>
                           
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
                              <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> সংশোধন </button>
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