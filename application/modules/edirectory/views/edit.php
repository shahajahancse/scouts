<link rel="stylesheet" href="<?php print HTTP_CROP_PATH;?>css/cropper.css">
<style type="text/css">
   .edit-pen{ position: absolute; color: #01579B; background: #fff; padding: 5px; box-shadow: 1px 1px 1px 1px #eee; border-radius: 17px; right: 65px; bottom: 10px; border: 1px solid #f1f1f1;
   }
</style>

<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('edirectory/listing')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">     
                     <!-- <a href="<?=base_url('edirectory/listing')?>" class="btn btn-blueviolet btn-xs btn-mini"> E-Directory Contact</a>  &nbsp; -->
                  </div>
               </div>

               <div class="grid-body">
                  <?php echo validation_errors(); ?>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <div class="row">
                     <div class="col-md-12">
                        <?php 
                        $attributes = array('id' => 'validate');
                        echo form_open_multipart(uri_string(), $attributes);
                        ?>

                        <div class="row">
                           <div class="col-md-9">
                              <div class="row form-row">                           
                                 <div class="col-md-4">
                                    <label class="form-label">Name (English)<span class="required">*</span></label>   
                                    <input name="name" id="name" value="<?=set_value('name', $info->name)?>" type="text" class="form-control input-sm" placeholder="Full Name (English)">
                                 </div>
                                 <div class="col-md-4">
                                    <label class="form-label">Name (Bangla)</label>   
                                    <input name="name_bn" id="name_bn" value="<?=set_value('name_bn', $info->name_bn)?>" type="text" class="form-control input-sm" placeholder="Full Name (Bangla)">
                                 </div>
                                 <div class="col-md-4">
                                    <label class="form-label">Select Designations <span class="required">*</span></label>
                                    <?php echo form_error('scout_desig_id');
                                    $more_attr = 'class="form-control input-sm" id="others"';
                                    echo form_dropdown('scout_desig_id', $designations, set_value('scout_desig_id', $info->scout_desig_id), $more_attr);
                                    ?>
                                 </div>
                                 <div class="col-md-4 col-md-offset-8">
                                    <label class="form-label">Responsibility</label>   
                                    <input name="responsibility" value="<?=set_value('responsibility', $info->responsibility)?>" type="text" class="form-control input-sm" placeholder="Responsibility">
                                 </div>
                                 <div class="col-md-12" id='others_designation'>
                                    <label class="form-label">Other Designation <span class="required">*</span></label>
                                    <?php echo form_error('other_desig_name'); ?>
                                    <input name="other_desig_name" value="<?=set_value('other_desig_name', $info->other_desig_name)?>" type="text" class="form-control input-sm" placeholder="Designation Name">
                                 </div> 
                              </div>
                              <div class="row form-row">                                 
                                 <div class="col-md-6">
                                    <label class="form-label">Phone/Mobile (Personal) </label>   
                                    <input name="phone" id="phone" value="<?=set_value('phone', $info->phone)?>" type="text" class="form-control input-sm" placeholder="Personal Phone or Mobile Number">
                                 </div> 
                                 <div class="col-md-6">
                                    <label class="form-label">Email Address (Personal) </label>   
                                    <input name="email" id="email" value="<?=set_value('email', $info->email)?>" type="text" class="form-control input-sm" placeholder="example@domain.com">
                                 </div> 
                                 <div class="col-md-6">
                                    <label class="form-label">Phone/Mobile (Official) </label>   
                                    <input name="phone_official" id="phone_official" value="<?=set_value('phone_official', $info->phone_official)?>" type="text" class="form-control input-sm" placeholder="Official Phone or Mobile Number">
                                 </div>                                  
                                 <div class="col-md-6">
                                    <label class="form-label">Email Address (Official) </label>   
                                    <input name="email_official" id="email_official" value="<?=set_value('email_official', $info->email_official)?>" type="text" class="form-control input-sm" placeholder="example@domain.com">
                                 </div> 
                                 <div class="col-md-6">
                                    <label class="form-label">Mailing Address</label>   
                                    <input name="present_address" id="present_address" value="<?=set_value('present_address', $info->address)?>" type="text" class="form-control input-sm" placeholder="Mailing Address">
                                 </div> 
                                 <div class="col-md-6">
                                    <label class="form-label">Professional Designation</label>   
                                    <input name="profe_desig" id="profe_desig" value="<?=set_value('profe_desig', $info->profe_desig)?>" type="text" class="form-control input-sm" placeholder="Professional Designation">
                                 </div> 
                                 <div class="col-md-6">
                                    <label class="form-label">Blood Group</label>
                                    <?php echo form_error('bg_id');
                                    $more_attr = 'class="form-control input-sm" id="blood_group"';
                                    echo form_dropdown('bg_id', $blood_group, set_value('bg_id', $info->bg_id), $more_attr);
                                    ?>
                                 </div>                                 
                                 <div class="col-md-6">
                                    <label class="form-label">Gender <span class='required'>*</span></label>
                                    <?php echo form_error('gender'); ?>
                                    <input type="radio" name="gender" value="Male" <?=set_value('gender',$info->gender)=='Male'?'checked':'';?>> <span style="color: black; font-size: 14px;">Male</span> 
                                    <input type="radio" name="gender" value="Female" <?=set_value('gender',$info->gender)=='Female'?'checked':'';?>> <span style="color: black; font-size: 14px;">Female</span>
                                    <input type="radio" name="gender" value="Others" <?=set_value('gender',$info->gender)=='Others'?'checked':'';?>> <span style="color: black; font-size: 14px;">Others</span>
                                    <div id="typeerror"></div>
                                 </div>
                                 <div class="clearfix"></div>
                                 <div class="col-md-6">
                                    <label class="form-label">Other Info</label>   
                                    <textarea name="others_info" id="others_info" class="form-control input-sm"><?=set_value('others_info',$info->others_info)?></textarea>
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="avatar"  style="top: 11px;">
                                 <input type="hidden" name="hide_img" id="profile-avatar-url" value="">
                                 <?php
                                    if($info->scout_id != NULL){
                                     $url = base_url('profile_img/').$info->profile_img;
                                  }elseif($info->image_file != NULL){
                                    $url = base_url('uploads/edirectory_img/').$info->image_file;
                                  }else{
                                     $url = HTTP_IMAGES_PATH . 'no-image.jpg'; 
                                  }
                                  ?>

                                 <img src="<?php print $url;?>" alt="image" title="avatar" data-toggle="modal" data-target="#avatar-modal" id="render-avatar" class="circular-fix has-shadow border marg-top10" data-ussuid="<?php print base64_encode(0);?>" data-backdrop="static" data-keyboard="false" data-upltype="avatar" style="width:150px; height:150px; max-width: 150px; max-height: 150px; border: 2px solid black; padding: 3px;"><br>
                              </div>

                              <!-- <div id="imgcontainer"></div>                                  -->
                              <div class="col-md-12"> 
                                 <label>Note:</label>                          
                                 <ul>                
                                    <li>Click on this image frame </li>             
                                    <li>Allowed file type <strong>jpg</strong>, <strong>png</strong>, <strong>jpeg</strong></li>
                                    <li>Maximun file size <strong>200 KB</strong></li>         
                                 </ul>
                              </div>
                           </div>
                        </div>

                        <div class="form-actions">  
                           <div class="pull-right">
                              <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save </button>
                           </div>
                        </div>
                        <!-- <input type="hidden" name="hide_id" id="participant_hide_id"> -->
                        <?php echo form_close();?>
                     </div>
                  </div>

               </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->
         </div>
      </div> <!-- END ROW -->

   </div>
</div>

<?php $this->load->view('profileAvatar'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/2.1.0/bootstrap-filestyle.js"></script>
<script src="<?php print HTTP_CROP_PATH; ?>js/cropper.js"></script>
<script src="<?php print HTTP_CROP_PATH; ?>js/main.js"></script>

<script type="text/javascript">  
   $(document).ready(function() {
      officeFunc();

      // Jquery Validation
      $('#validate').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            scout_desig_id: { required: true },            
            name: { required: true },          
            gender: { required: true },  
            phone: { required: '#phone_official:blank'},
            phone_official: { required: '#phone:blank'},
            email: { required: '#email_official:blank'},
            email_official: { required: '#email:blank'},         
            profe_desig: { required: false },
            present_address: { required: false }
         },

         invalidHandler: function (event, validator) {
         //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type   
         // if (element.attr("name") == "scout_id") {
         //    label.insertAfter("#typeerror");
         // } else {
            $('<span class="error"></span>').insertAfter(element).append(label)
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('success-control').addClass('error-control');  
         // }
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
         // form.submit();
         func_committee_member_list();
      }
   });


   //Radio button selected
   $(function() {
      var $radios = $('input:radio[name=memberType]');
      if($radios.is(':checked') === false) {
         $radios.filter('[value=1]').prop('checked', true);
      }
   });

   // Hide/Show
   $(".nonScoutMemberDiv").hide();
   $(".scoutMember").click(function(){
      $(".scoutMemberDiv").show();
      $(".nonScoutMemberDiv").hide();
   });

   $(".nonScoutMember").click(function(){
      $(".scoutMemberDiv").hide();
      $(".nonScoutMemberDiv").show();
      $('#name').val('');
      $('#name_bn').val('');
      $('#phone').val('');
      $('#phone_official').val('');
      $('#email').val('');
      $('#email_official').val('');
      $('#present_address').val('');
      $('#profe_desig').val('');
      $('#others_info').val('');
      $('#render-avatar').attr('src', '');
   });

 //   $(".scoutIDSingleSelect2").select2({
 //    allowClear: true
 // });

   // Other's Course
   $('#others_designation').hide();
   $('#others').change(function(){
      var id = $('#others').val();
      // alert(id);
      if(id=='100'){
         $('#others_designation').show();
      }else{
         $('#others_designation').hide();
      }
   });

});   





function officeFunc(){
   $(".otherOffice").hide();
   var selectedValue = $("input[name=memberType]:checked").val();
   if(selectedValue == "1"){
      $(".otherOffice").hide();
   }else{
      $(".otherOffice").show();
   }
}

</script>