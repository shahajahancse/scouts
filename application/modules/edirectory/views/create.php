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
                     <a href="<?=base_url('edirectory/listing')?>" class="btn btn-blueviolet btn-xs btn-mini"> E-Directory Contact</a>  &nbsp;
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
                        echo form_open_multipart('edirectory/create', $attributes);
                        ?>

                        <div class="row form-row">

                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="form-label">Member Type <span class="required">*</span></label><br>
                                 <input type="radio" class="scoutMember" name="memberType" id="selectedSM" value="1" <?=set_value('memberType')==1?'checked':'checked';?>> Scout Member
                                 <input type="radio" class="nonScoutMember" name="memberType" value="2" <?=set_value('memberType')==2?'checked':'';?>> No Scout ID
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="scoutMemberDiv">
                                 <label class="form-label">Select Scouts Member </label>
                                 <?php echo form_error('scout_member_id'); ?>
                                 <?php 
                                 if($scouts_member != ''){
                                    $more_attr = 'class="form-control input-sm" id="scout_member_id"';
                                    echo form_dropdown('scout_member_id', $scouts_member, set_value('scout_member_id'), $more_attr);   
                                 }else{ 
                                    ?>
                                    <select class="scoutIDSingleSelect2 form-control input-sm" name="scout_member_id" id="scout_member_id" style="width: 100%;"></select>
                                    <?php } ?>

                                 </div>
                              <!-- <div id="nonScoutMemberDiv" style="display: none;">
                                 <label class="form-label">Non Scout Member Name</label>   
                                 <input name="member_name" id="member_name" value="<?=set_value('committee_name')?>" type="text" class="form-control input-sm" placeholder="">
                              </div> -->
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-9">
                              <div class="row form-row">                           
                                 <div class="col-md-4">
                                    <label class="form-label">Name (English)<span class="required">*</span></label>   
                                    <input name="name" id="name" value="<?=set_value('name')?>" type="text" class="form-control input-sm" placeholder="Full Name (English)">
                                 </div>
                                 <div class="col-md-4">
                                    <label class="form-label">Name (Bangla)</label>   
                                    <input name="name_bn" id="name_bn" value="<?=set_value('name_bn')?>" type="text" class="form-control input-sm" placeholder="Full Name (Bangla)">
                                 </div>
                                 <div class="col-md-4">
                                    <label class="form-label">Select Designations <span class="required">*</span></label>
                                    <?php echo form_error('scout_desig_id');
                                    $more_attr = 'class="form-control input-sm" id="others"';
                                    echo form_dropdown('scout_desig_id', $designations, set_value('scout_desig_id'), $more_attr);
                                    ?>
                                 </div>
                                 <div class="col-md-4 col-md-offset-8">
                                    <label class="form-label">Responsibility</label>   
                                    <input name="responsibility" value="<?=set_value('responsibility')?>" type="text" class="form-control input-sm" placeholder="Responsibility">
                                 </div>
                                 <div class="col-md-12" id='others_designation'>
                                    <label class="form-label">Other Designation <span class="required">*</span></label>
                                    <?php echo form_error('other_desig_name'); ?>
                                    <input name="other_desig_name" value="<?=set_value('other_desig_name')?>" type="text" class="form-control input-sm" placeholder="Designation Name">
                                 </div> 
                              </div>
                              <div class="row form-row">                                 
                                 <div class="col-md-6">
                                    <label class="form-label">Phone/Mobile (Personal) </label>   
                                    <input name="phone" id="phone" value="<?=set_value('phone_personal')?>" type="text" class="form-control input-sm" placeholder="Personal Phone or Mobile Number">
                                 </div> 
                                 <div class="col-md-6">
                                    <label class="form-label">Email Address (Personal) </label>   
                                    <input name="email" id="email" value="<?=set_value('email_personal')?>" type="text" class="form-control input-sm" placeholder="example@domain.com">
                                 </div> 
                                 <div class="col-md-6">
                                    <label class="form-label">Phone/Mobile (Official) </label>   
                                    <input name="phone_official" id="phone_official" value="<?=set_value('phone')?>" type="text" class="form-control input-sm" placeholder="Official Phone or Mobile Number">
                                 </div>                                  
                                 <div class="col-md-6">
                                    <label class="form-label">Email Address (Official) </label>   
                                    <input name="email_official" id="email_official" value="<?=set_value('email')?>" type="text" class="form-control input-sm" placeholder="example@domain.com">
                                 </div> 
                                 <div class="col-md-6">
                                    <label class="form-label">Mailing Address</label>   
                                    <input name="present_address" id="present_address" value="<?=set_value('present_address')?>" type="text" class="form-control input-sm" placeholder="Mailing Address">
                                 </div> 
                                 <div class="col-md-6">
                                    <label class="form-label">Professional Designation</label>   
                                    <input name="profe_desig" id="profe_desig" value="<?=set_value('profe_desig')?>" type="text" class="form-control input-sm" placeholder="Professional Designation">
                                 </div> 
                                 <div class="col-md-6">
                                    <label class="form-label">Blood Group</label>
                                    <?php echo form_error('bg_id');
                                    $more_attr = 'class="form-control input-sm" id="blood_group"';
                                    echo form_dropdown('bg_id', $blood_group, set_value('bg_id'), $more_attr);
                                    ?>
                                 </div>                                 
                                 <div class="col-md-6">
                                    <label class="form-label">Gender <span class='required'>*</span></label>
                                    <?php echo form_error('gender'); ?>
                                    <input type="radio" name="gender" class="genderSC" id="male" value="Male" <?=set_value('gender')=='Male'?'checked':'';?>> <span style="color: black; font-size: 14px;">Male</span> 
                                    <input type="radio" name="gender" class="genderSC" id="female" value="Female" <?=set_value('gender')=='Female'?'checked':'';?>> <span style="color: black; font-size: 14px;">Female</span>
                                    <input type="radio" name="gender" class="genderSC" id="others" value="Others" <?=set_value('gender')=='Others'?'checked':'';?>> <span style="color: black; font-size: 14px;">Others</span>
                                    <div id="typeerror"></div>
                                 </div>
                                 <div class="clearfix"></div>
                                 <div class="col-md-6">
                                    <label class="form-label">Other Info</label>   
                                    <textarea name="others_info" id="others_info" class="form-control input-sm"><?=set_value('others_info')?></textarea>
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="avatar"  style="top: 11px;">
                                 <input type="hidden" name="hide_img" id="profile-avatar-url" value="">

                                 <?php $url = HTTP_IMAGES_PATH . 'no-image.jpg'; ?>

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
            memberType: { required: true },
            scout_member_id: {required: "#selectedSM:checked"},
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

   // Get Scouts Info
   $('#scout_member_id').change(function(){
      var id = $('#scout_member_id').val();
      // alert(id);

      $.ajax({
         type: "GET",
         url: hostname +"edirectory/ajax_get_scouts_member_info/" + id,
         success: function(response)
         {   
            var presentAddress = response.pre_village_house + ', ' + response.pre_road_block + ', ' + response.pre_up_th_name + ', ' + response.pre_district_name + ', ' + response.pre_div_name;
            var image_url = response.profile_img;
            
            // console.log(response.blood_group);
            $('#name').val(response.first_name);
            $('#name_bn').val(response.full_name_bn);
            $('#phone').val(response.phone);
            $('#email').val(response.email);
            // $('#phone_official').val(response.phone);
            // $('#email_official').val(response.email);
            $('#present_address').val(presentAddress);
            $('#blood_group option:selected').val(response.blood_group);

            // $("input[name='gender']:checked").val(response.gender);
            if(response.gender == 'Male'){
               document.getElementById("male").checked = true;
            }else if(response.gender == 'Female'){
               document.getElementById("female").checked = true;
            }else if(response.gender == 'Others'){
               document.getElementById("others").checked = true;  
            }

            if(image_url != ''){
               var imageurl = '<?=base_url('profile_img/')?>'+image_url;
               // alert(imageurl);
               $('#render-avatar').attr('src', imageurl);
               // $('#imgcontainer').html('<img src="<?=base_url('profile_img/')?>' + image + '" style="border: 3px solid #ccc;" height=150 />');    
               // $('#imgcontainer').show();
            }else{
               //$(".nonScoutMemberDiv").show();
               var imageurl = '<?=HTTP_IMAGES_PATH?>'+'no-image.jpg';
               // alert(imageurl);
               $('#render-avatar').attr('src', imageurl);
            }
         }
      });
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