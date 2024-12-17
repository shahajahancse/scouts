<link rel="stylesheet" href="<?php print HTTP_CROP_PATH;?>css/cropper.css">
<style type="text/css">
   .edit-pen{ position: absolute; color: #01579B; background: #fff; padding: 5px; box-shadow: 1px 1px 1px 1px #eee; border-radius: 17px; right: 65px; bottom: 10px; border: 1px solid #f1f1f1;
   }
</style>

<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
               </div>
               <div class="grid-body">

                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <?php 
                  $attributes = array('id' => 'scout_request_validation');
                  echo form_open_multipart("scout-application-request", $attributes);
                  echo validation_errors();
                  ?>

                  <div class="row">
                     <div class="col-md-12">   
                        <div class="alert alert-info alert-block fade in">        
                           <h4 class="alert-heading semi-bold"><i class="icon-warning-sign"></i> Thank you for registration.</h4>
                           <p class="semi-bold"> To be an online scout member please provide your personal and scout information below.</p>
                        </div>                        
                     </div>          
                  </div>

                  <div class="row">
                     <h4 class="margin_left_15 semi-bold">Personal Information</h4>

                     <div class="col-md-12">
                        <div class="row form-row">
                           <div class="col-md-3">
                              <label class="form-label">Full Name (English) <span class='required'>*</span></label>
                              <?php echo form_error('first_name'); ?>
                              <input type="text" name="first_name" class="form-control input-sm" value="<?=set_value('first_name', $info->first_name)?>">
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Full Name (Bangla) <span class='required'>*</span></label>
                              <?php echo form_error('full_name_bn'); ?>
                              <input type="text" name="full_name_bn" class="bangla form-control input-sm" value="<?=set_value('full_name_bn')?>" contenteditable="TRUE">
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Date of Birth <span class='required'>*</span></label>
                              <?php echo form_error('day'); echo form_error('month'); echo form_error('year'); ?>
                              <div class="row form-row">
                                 <?php 
                                 $dob=explode('-', $info->dob);
                                 $day  =$dob[2];
                                 $month=$dob[1]; 
                                 $year =$dob[0];  
                                 ?>
                                 <div class="col-md-4" style="">
                                    <?php echo form_dropdown('day', $days, set_value('day',$day), 'class="form-control input-sm"'); ?>
                                 </div>
                                 <div class="col-md-4" style="padding-left:0;">
                                    <?php echo form_dropdown('month', $months, set_value('month',$month), 'class="form-control input-sm"'); ?>
                                 </div>
                                 <div class="col-md-4" style="padding-left:0;">
                                    <?php echo form_dropdown('year', $years, set_value('year',$year), 'class="form-control input-sm"'); ?>
                                 </div>
                              </div>
                           </div> 
                           <div class="col-md-3">
                              <label class="form-label">Gender <span class='required'>*</span></label>
                              <?php echo form_error('gender'); ?>
                              <input type="radio" name="gender" value="Male" <?=set_value('gender',$info->gender)=='Male'?'checked':'';?>> <span style="color: black; font-size: 14px;">Male</span> 
                              <input type="radio" name="gender" value="Female" <?=set_value('gender',$info->gender)=='Female'?'checked':'';?>> <span style="color: black; font-size: 14px;">Female</span>
                              <input type="radio" name="gender" value="Others" <?=set_value('gender',$info->gender)=='Others'?'checked':'';?>> <span style="color: black; font-size: 14px;">Others</span>
                           </div>                          
                        </div>    
                                            
                        <div class="row form-row">
                           <div class="col-md-3">
                              <label class="form-label">Father's Name (English) <span class='required'>*</span></label>
                              <?php echo form_error('father_name'); ?>
                              <input type="text" name="father_name" class="form-control input-sm" value="<?=set_value('father_name')?>">
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Father's Name (Bangla) </label>
                              <?php echo form_error('father_name_bn'); ?>
                              <input type="text" name="father_name_bn" class="bangla form-control input-sm" value="<?=set_value('father_name_bn')?>" contenteditable="TRUE">
                           </div>                           
                           <div class="col-md-3">
                              <label class="form-label">Mobile No. (Self/Parents)<span class='required'>*</span></label>
                              <?php echo form_error('phone'); ?>
                              <input name="phone" value="<?=set_value('phone', $info->phone)?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Religion <span class='required'>*</span></label>
                              <?php echo form_error('religion_id');
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('religion_id', $religions, set_value('religion_id'), $more_attr);
                              ?>
                           </div>
                        </div>
                        
                        <div class="row form-row">
                           <div class="col-md-3">
                              <label class="form-label">Mother's Name (English) <span class='required'>*</span></label>
                              <?php echo form_error('mother_name'); ?>
                              <input type="text" name="mother_name"  class="form-control input-sm" value="<?=set_value('mother_name')?>">
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Mother's Name (Bangla) </label>
                              <?php echo form_error('mother_name_bn'); ?>
                              <input type="text" name="mother_name_bn"  class="bangla form-control input-sm" value="<?=set_value('mother_name_bn')?>" contenteditable="TRUE">
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Email Address</label>
                              <?php echo form_error('email'); ?>
                              <input name="email" value="<?=set_value('email')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Blood Group</label>
                              <?php echo form_error('blood_group');
                              $more_attr = 'class="form-control input-sm" ';
                              echo form_dropdown('blood_group', $blood_group, set_value('blood_group'), $more_attr);
                              ?>
                           </div>
                        </div>
                     </div> <!-- col-md-12 -->

                     <div class="col-md-12">
                        <div class="row">
                           <div class="col-md-7">      
                              <h5 class="semi-bold" style="font-style: italic;text-decoration: underline;">Present Address</h5>
                              <div class="row form-row">
                                 <div class="col-md-6">
                                    <label class="form-label">Village/House No or Name (English) <span class='required'>*</span></label>
                                    <?php echo form_error('pre_village_house'); ?>
                                    <input type="text" name="pre_village_house" class="form-control input-sm" value="<?=set_value('pre_village_house')?>">
                                 </div>
                                 <div class="col-md-6">
                                    <label class="form-label">Road/Block/Sector (English) <span class='required'>*</span></label>
                                    <?php echo form_error('pre_road_block'); ?>
                                    <input type="text" name="pre_road_block" class="form-control input-sm" value="<?=set_value('pre_road_block')?>">
                                 </div>
                                 <div class="col-md-6">
                                    <label class="form-label">Village/House No or Name (Bangla) </label>
                                    <?php echo form_error('pre_village_house_bn'); ?>
                                    <input type="text" name="pre_village_house_bn" class="bangla form-control input-sm" value="<?=set_value('pre_village_house_bn')?>" contenteditable="TRUE">
                                 </div>
                                 <div class="col-md-6">
                                    <label class="form-label">Road/Block/Sector (Bangla) </label>
                                    <?php echo form_error('pre_road_block_bn'); ?>
                                    <input type="text" name="pre_road_block_bn" class="bangla form-control input-sm" value="<?=set_value('pre_road_block_bn')?>" contenteditable="TRUE">
                                 </div>
                                 <div class="col-md-6">
                                    <label class="form-label">Division <span class='required'>*</span></label>
                                    <?php echo form_error('pre_division_id');
                                    $more_attr = 'class="form-control input-sm" id="division"';
                                    echo form_dropdown('pre_division_id', $divisions, set_value('pre_division_id'), $more_attr);
                                    ?>
                                 </div>
                                 <div class="col-md-6">
                                    <label class="form-label">District <span class='required'>*</span></label>
                                    <?php echo form_error('pre_district_id'); ?>
                                    <select name="pre_district_id" class="distirict_val form-control input-sm" id="district">
                                       <option value="">-- Select One --</option>
                                    </select>
                                 </div>
                                 <div class="col-md-6">
                                    <label class="form-label">Upazila/Thana <span class='required'>*</span></label>
                                    <?php echo form_error('pre_upa_tha_id'); ?>
                                    <select name="pre_upa_tha_id" class="upazila_thana_val form-control input-sm">
                                       <option value="">-- Select One --</option>
                                    </select>
                                 </div>
                                 <div class="col-md-6">
                                    <label class="form-label">Post Code</label>
                                    <?php echo form_error('pre_post_office'); ?>
                                    <input type="text" name="pre_post_office" class="form-control input-sm" value="<?=set_value('pre_post_office', $info->pre_post_office)?>">
                                 </div>
                              </div>
                           </div> 

                           <div class="col-md-5">
                              <div class="row">
                                 <div class="col-md-12" style="margin-top: 25px;">  
                                    <?php /*
                                    <img width="50" height="50" data-src-retina="<?php //$img_url?>" data-src="<?php //$img_url?>" src="<?php //$img_url?>" alt="">
                                    <input type="file" name="userfile"><br> */ ?>
                                    <div class="form-group">
                                       <label>Profile Image</label>
                                       <div><?php echo form_error('userfile'); ?></div>

                                       <div class="avatar" style="top: 11px;">
                                          <input type="hidden" name="hide_img" id="profile-avatar-url" value="">
                                          <?php
                                          // $path = base_url();
                                          // if(!empty($  ['url'])) {
                                          // $url = HTTP_USER_PROFILE_THUMB_PATH.$userInfo['url'];
                                          // } else {
                                          $url = HTTP_IMAGES_PATH . 'no-img.png';
                                          // }
                                          ?>
                                          <img src="<?php print $url;?>" alt="image" title="avatar" data-toggle="modal" data-target="#avatar-modal" id="render-avatar" class="circular-fix has-shadow border marg-top10" data-ussuid="<?php print base64_encode(0);?>" data-backdrop="static" data-keyboard="false" data-upltype="avatar" style="width:80px; height:80px; max-width: 80px; max-height: 80px; border: 2px solid black; padding: 3px;"><br>
                                          <!-- <a href="javascript:void();" data-toggle="modal" data-target="#avatar-modal"><i class="fa fa-pencil edit-pen"></i> </a> -->
                                       </div>
                                       
                                       <label>Note:</label>                          
                                       <ul>
                                          <li>Image should be passport size <strong>(Display your ID Card)</strong></li>        
                                          <li>Image should be scouts uniform </li>             
                                          <li>Allowed file type <strong>jpg</strong>, <strong>png</strong>, <strong>jpeg</strong></li>
                                          <li>Maximun file size <strong>200 KB</strong></li>           
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div> <!-- //col-md-12 -->


                     <h4 class="margin_left_15 semi-bold">Scouts & Other's Information</h4>
                     <div class="col-md-12">
                        <input type="radio" class="is_interested" name="is_interested" value="0" checked> <span style="color: black; font-size: 14px;">For Scouts member</span>  &nbsp; &nbsp;  
                        <input type="radio" class="is_interested" name="is_interested" value="1"> <span style="color: black; font-size: 14px;">For interested to be scouts member</span>
                     </div>


                     <div class="col-md-8">
                        <h5 class="semi-bold" style="font-style: italic;text-decoration: underline;">Scout Information</h5>
                        <div class="row form-row" id="expreance">
                           <div class="col-md-4">
                              <h5 class="semi-bold"><input type="checkbox" <?=set_value('sc_cub',$info->sc_cub)=='Yes'?'checked':'';?> id="sc_cub" name="sc_cub" value="Yes"> Cub Scouts Experience</h5>
                           </div>
                           <div class="col-md-4">
                              <h5 class="semi-bold"><input type="checkbox" <?=set_value('sc_scout',$info->sc_scout)=='Yes'?'checked':'';?> id="sc_scout" name="sc_scout" value="Yes"> Scouts Experience</h5>
                           </div>
                           <div class="col-md-4">
                              <h5 class="semi-bold"><input type="checkbox" <?=set_value('sc_rover',$info->sc_rover)=='Yes'?'checked':'';?> id="sc_rover" name="sc_rover" value="Yes"> Rover Scouts Experience</h5>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-4">
                              <label class="form-label">Scout Join Date <span class='required'>*</span></label>
                              <?php echo form_error('join_date'); ?>
                              <input name="join_date" value="<?=set_value('join_date')?>" type="text" class="form-control input-sm datetime pull-left" placeholder="DD-MM-YYYY">
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">Member Type <span class='required'>*</span> </label>
                              <?php echo form_error('member_id'); ?>
                              <?php echo form_dropdown('member_id',$member_type, set_value('member_id'), 'id="member_id" class="form-control input-sm"');?>
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">Scout Section Type <span class='required'>*</span></label>
                              <?php echo form_error('sc_section_id');
                              $more_attr = 'class="form-control input-sm" id="sc_section"';
                              echo form_dropdown('sc_section_id', $scout_section, set_value('sc_section_id'), $more_attr);
                              ?>
                           </div> 
                        </div>

                        <div class="row form-row">
                           <div class="col-md-6" id="sc_badge_hidden">
                              <label class="form-label">Scout Badge</label>
                              <?php echo form_error('sc_badge_id'); ?>
                              <select name="sc_badge_id" class="sc_badge_val form-control input-sm" id="sc_badge">
                                 <option value="">-- Select One --</option>
                              </select>
                           </div>
                           <div class="col-md-6" id="sc_role_hidden">
                              <label class="form-label">Scout Role</label>
                              <?php echo form_error('sc_role_id');?>
                              <select name="sc_role_id" class="sc_role_val form-control input-sm" id="sc_role">
                                 <option value="">-- Select One --</option>
                              </select>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Select Scout Region <span class='required'>*</span></label>
                              <?php 
                              echo form_error('sc_region_id');
                              $more_attr = 'class="form-control input-sm" id="region"';
                              echo form_dropdown('sc_region_id', $regions, set_value('sc_region_id'), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Select Scout District <span class='required'>*</span></label>
                              <?php echo form_error('sc_district_id'); ?>
                              <select name="sc_district_id" class="sc_district_val form-control input-sm" id="sc_district">
                                 <option value="">-- Select One --</option>
                              </select>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Select Scout Upazila</label>
                              <?php echo form_error('sc_upa_tha_id'); ?>
                              <select name="sc_upa_tha_id" class="sc_upazila_thana_val form-control input-sm"  id="sc_upazila_thana">
                                 <option value="">-- Select One --</option>
                              </select>
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Select Scout Group <span class='required'>*</span></label>    
                              <?php echo form_error('sc_group_id'); ?>
                              <select name="sc_group_id" class="sc_group_val form-control input-sm basic-select2" id="sc_unit">
                                 <option value="">-- Select One --</option>
                              </select>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <input type="hidden" name="unit_id_name" id="unit_id_name" value="">
                              <?php echo form_error('sc_unit_id'); ?>
                              <div class="unit_list" style=""></div>  
                           </div>
                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="row form-row"> 
                           <h5 class="semi-bold margin_left_15" style="font-style: italic;text-decoration: underline;">Other's Information</h5>
                           <div id="eduDiv" style="display: none;">
                              <div class="col-md-12">
                                 <label class="form-label">Present Institute</label>
                                 <?php echo form_error('curr_institute_id');?>
                                 <select class="instituteSelect2 form-control" name="curr_institute_id" style="width:100%;"></select>
                              </div> 
                              <div class="col-md-12">
                                 <label class="form-label">Present Class</label>
                                 <?php echo form_error('curr_class'); ?>
                                 <input name="curr_class" value="<?=set_value('curr_class', $info->curr_class)?>" type="text" class="form-control input-sm" placeholder="">
                              </div> 
                              <div class="col-md-12">
                                 <label class="form-label">Present Roll No</label>
                                 <?php echo form_error('curr_role_no'); ?>
                                 <input name="curr_role_no" value="<?=set_value('curr_role_no', $info->curr_role_no)?>" type="text" class="form-control input-sm" placeholder="">
                              </div> 
                           </div>

                           <div id="orgDiv" style="display: none;">
                              <div class="col-md-12">
                                 <label class="form-label">Present Organization / Office / Business Name</label>
                                 <input name="curr_org" value="<?=set_value('curr_org')?>" type="text" class="form-control input-sm" placeholder="">
                              </div>
                              <div class="col-md-12">
                                 <label class="form-label">Present Designation</label>
                                 <input name="curr_desig" value="<?=set_value('curr_desig')?>" type="text" class="form-control input-sm" placeholder="">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div> <!-- //Institute and scout info -->


                  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons" onclick="return confirm('Are you sure all information is correct?')"><i class="icon-ok"></i> Save and Send Request </button>
                     </div>
                  </div>
                  <?php echo form_close();?>

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
      // Select2 dropdown value is gater then 0 validate
      $.validator.addMethod("scouts_group_rule", function(value, element) {
         var sg_val = $("#sc_unit").val();
         if(sg_val>0){
            return sg_val>0;
         } 
      }, "Select scout group");

      $('#scout_request_validation').validate({
   // focusInvalid: false, 
   ignore: "",
   rules: {
      first_name: {
         required: true
      },
      full_name_bn: {
         required: true
      },
      day: {
         required: true
      },
      month: {
         required: true
      },
      year: {
         required: true
      },
      gender: {
         required: true
      },
      blood_group: {
         required: false
      },
      religion_id: {
         required: true
      },         
      father_name: {
         required: true
      },
      father_name_bn: {
         required: false
      },
      mother_name: {
         required: true
      }, 
      mother_name_bn: {
         required: false
      },          
      phone:{
         required: true,
         number: true,
         minlength: 11,
         maxlength: 11
      },         
      email: {
         email: true
      },
      pre_village_house:{
         required: true
      },
      pre_village_house_bn:{
         required: false
      },
      pre_road_block:{
         required: true
      },  
      pre_road_block_bn:{
         required: false
      },      
      pre_division_id: {
         required: true
      },
      pre_district_id: {
         required: true
      },
      pre_upa_tha_id: {
         required: true
      },
      pre_post_office: {
         required: false,
         number: true,
      },  

      join_date: {
         required: true
      },
      member_id: {
         required: true
      },
      sc_section_id: {
         required: true
      },
      sc_badge_id: {
         required: false
      },
      sc_role_id: {
         required: false
      },
      sc_region_id: {
         required: true
      },
      sc_district_id: {
         required: true
      },
      sc_upa_tha_id: {
         required: false
      },
      sc_group_id: {
         required: true, scouts_group_rule: true
      },
      sc_unit_id: {
         required: false
      },
      userfile: {
         required: false,
         extension: "jpg|jpeg|png"
      }
   },
   messages: {
      userfile: {
         required: "Image file is required",
         extension: "Allowed file extension jpg, png, jpeg"
      }
   }
});



   }); 

   $('.is_interested').change(function(){
      var value=document.querySelector("input[name=is_interested]:checked").value;
      if(value==0){
         $('#sc_badge_hidden').show();
         $('#sc_role_hidden').show();
         $('#expreance').show();
      }else{
        $('#sc_badge_hidden').hide();
        $('#sc_role_hidden').hide();
        $('#expreance').hide();
     }
  });

   $('#member_id').change(function(){
      $('#eduDiv').hide(); 
      $("#orgDiv").hide();
      var id = $('#member_id').val();
      // alert(id);

      if(id == 1 || id == 2){
         $("#eduDiv").show();
      }else if(id == 8 || id == 12 || id == 10 || id == 9 || id == 13){
         $("#orgDiv").show();        
      }
   });
</script>