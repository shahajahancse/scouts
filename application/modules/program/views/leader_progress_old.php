<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; width: 100%; color: black;}
         .tg td{font-family:Arial, sans-serif;font-size:14px;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
         .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
         .tg .tg-71hr{background-color:#a7afaf; font-weight: bold;}
      </style>
<?php   
   $section_id = 3;
   if($this->ion_auth->is_admin()){
      @$id = $info->id;
      $user_id = $this->session->userdata('user_id');
   }elseif($this->ion_auth->is_region_admin()){  
      $id = $info->id;
      $user_id = $this->session->userdata('user_id');
   }elseif($this->ion_auth->is_district_admin()){
      $id = $info->id;
      $user_id = $this->session->userdata('user_id');
   }elseif($this->ion_auth->is_upazila_admin()){
      $id = $info->id;
      $user_id = $this->session->userdata('user_id');
   }elseif($this->ion_auth->is_group_admin()){
      $id = $info->id;
      $user_id = $this->session->userdata('user_id');
   }else{
      $id = $this->session->userdata('user_id');
      $user_id = 0;
   }
?>
      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('scouts_member/details/'.encrypt_url($id))?>" class="btn btn-success btn-xs btn-mini"> Scouts Member Details</a>  
                  </div>
               </div>

               <div class="grid-body">

                  <div class="row">
                     <div class="col-md-12">
                        <div class="tabbable tabs-left">
                           <ul class="nav nav-tabs" id="tab-2">
                              <!-- <li class="active"><a href="#tab_achievement">দীক্ষা / ব্যাজ অর্জনের তারিখ</a></li> -->
                              <!-- <li><a href="#tab_expartness">পারদর্শিতা ব্যাজ অর্জন</a></li> -->
                              <li class="active"><a href="#tab_training">প্রশিক্ষণ রেকর্ড</a></li>
                              <li><a href="#tab_section_promotion">পদোন্নতি</a></li>
                              <li><a href="#tab_camp">ক্যাম্প রেকর্ড</a></li>
                              <li><a href="#tab_resign">গ্রুপ ত্যাগ </a></li>
                              <!-- <li class="active"><a href="#tab_badge">রোভার স্কাউটস ব্যাজ বিবরণ</a></li> 
                              <li><a href="#tab_physical_health">দৈহিক ও স্বাস্থ্যগত রেকর্ড</a></li>
                              <li><a href="#tab_institute_promotion">বিদ্যালয়ের ক্রমোন্নতি তথ্য</a></li> -->
                           </ul>
                           <div class="tab-content">
                              <?php if($this->session->flashdata('success')):?>
                                 <div class="alert alert-success">
                                    <?=$this->session->flashdata('success');;?>
                                 </div>
                              <?php endif; ?>

                                 <div class="tab-pane active" id="tab_training">
                                    <div class="row ">
                                       <div class="col-md-12">
                                       <h5><span class="semi-bold">প্রশিক্ষণ রেকর্ড </span></h5>
                                          <?php 
                                          $attributes = array('id' => 'program_badge_training');
                                          echo form_open("", $attributes);?>
                                          <div class="row form-row">
                                             <div class="col-md-3">
                                                <label class="form-label">ব্যাজ</label>
                                                <?php echo form_error('badge_id');
                                                $more_attr = 'class="form-control input-sm" id="train_scout_badge"';
                                                echo form_dropdown('badge_id', $badges, set_value('badge_id'), $more_attr);
                                                ?>
                                             </div>
                                             
                                             <div class="col-md-3">  
                                                <label class="form-label">প্রশিক্ষণের তারিখ</label>
                                                <?php echo form_error('train_date'); ?>
                                                <input type="text" name="train_date" id="train_achive_date" class="form-control input-sm datetime" value="<?=set_value('achive_date')?>" placeholder="DD-MM-YYYY">
                                             </div>

                                             <div class="col-md-3">  
                                                <label class="form-label">সনদ নং</label>
                                                <?php echo form_error('train_certificate_no'); ?>
                                                <input type="text" name="train_certificate_no" id="train_certificate_no" class="form-control input-sm " value="<?=set_value('train_certificate_no')?>" placeholder="">
                                             </div>
                                          </div>
                                          <div class="row form-row">
                                            
                                             <div class="col-md-6">
                                                <label class="form-label">প্রশিক্ষণের  নাম</label>
                                                <?php echo form_error('train_name'); ?>
                                                <input type="text" name="train_name" id="train_name" class="form-control input-sm" value="<?=set_value('train_name')?>" placeholder="">
                                             </div>
                                             <div class="col-md-4">
                                                <label class="form-label">মূল্যায়নকারী</label>
                                                <?php echo form_error('examiner_id');
                                                //$more_attr = 'class="form-control input-sm" id="train_examiner_id"';
                                                //echo form_dropdown('examiner_id', $scout_members, set_value('examiner_id'), $more_attr);
                                                ?>
                                                <select class="scoutIDSingleSelect2 form-control" name="examiner_id" id="train_examiner_id" style="width:100%"></select>
                                             </div> 
                                             
                                             <div class="col-md-1">  
                                                <label class="form-label">&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-mini mini-btn-padding">Save</button>
                                             </div>
                                          </div>
                                          <input type="hidden" name="hide_id" id="train_hide_id">
                                          <input type="hidden" name="hide_section_id" id="train_hide_section_id" value="<?=$section_id?>">
                                          <input type="hidden" name="hide_user_id" id="train_hide_user_id" value="<?=$user_id?>">
                                          <?php echo form_close();?>

                                          <div class="row">
                                             <div class="col-md-12">
                                                
                                                   <h5><span class="semi-bold">প্রশিক্ষণ  রেকর্ডের
                                                    বিবরণ</span></h5>

                                                   <span id="printbadge_training"></span>
                                       
                                                </div>   
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="tab-pane" id="tab_section_promotion">
                                    <div class="row ">
                                       <div class="col-md-12">
                                       <h5><span class="semi-bold">রোভার স্কাউট পদোন্নতি </span></h5>
                                          <?php 
                                          $attributes = array('id' => 'program_badge_promotion');
                                          echo form_open("", $attributes);?>
                                          <div class="row form-row">
                                             <div class="col-md-4">
                                                <label class="form-label">ব্যাজ</label>
                                                <?php echo form_error('badge_id');
                                                $more_attr = 'class="form-control input-sm" id="promotion_scout_badge"';
                                                echo form_dropdown('badge_id', $badges, set_value('badge_id'), $more_attr);
                                                ?>
                                             </div>

                                             <div class="col-md-4">
                                                <label class="form-label">রোল</label>
                                                <?php echo form_error('role_id');
                                                $more_attr = 'class="form-control input-sm" id="promotion_scout_role"';
                                                echo form_dropdown('role_id', $roles, set_value('role_id'), $more_attr);
                                                ?>
                                             </div>
                                              <div class="col-md-4">  
                                                <label class="form-label">পদোন্নতির শুরুর তারিখ</label>
                                                <?php echo form_error('promotion_form_date'); ?>
                                                <input type="text" name="promotion_from_date" id="promotion_from_date" class="form-control input-sm datetime" value="<?=set_value('promotion_from_date')?>" placeholder="DD-MM-YYYY">
                                             </div>
                                             
                                          </div>
                                          <div class="row form-row">

                                             <div class="col-md-4">  
                                                <label class="form-label">পদোন্নতির শেষ তারিখ</label>
                                                <?php echo form_error('promotion_to_date'); ?>
                                                <input type="text" name="promotion_to_date" id="promotion_to_date" class="form-control input-sm datetime" value="<?=set_value('promotion_to_date')?>" placeholder="DD-MM-YYYY">
                                             </div>

                                             <div class="col-md-6">
                                                <label class="form-label">মূল্যায়নকারী</label>
                                                <?php echo form_error('examiner_id');
                                                //$more_attr = 'class="form-control input-sm" id="promotion_examiner_id"';
                                                //echo form_dropdown('examiner_id', $scout_members, set_value('examiner_id'), $more_attr);
                                                ?>
                                                <select class="scoutIDSingleSelect2 form-control" name="examiner_id" id="promotion_examiner_id" style="width:100%"></select>
                                             </div> 
                                             
                                             <div class="col-md-1">  
                                                <label class="form-label">&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-mini mini-btn-padding">Save</button>
                                             </div>
                                          </div>
                                          <input type="hidden" name="hide_id" id="promotion_hide_id">
                                          <input type="hidden" name="hide_section_id" id="promotion_hide_section_id" value="<?=$section_id?>">
                                          <input type="hidden" name="hide_user_id" id="promotion_hide_user_id" value="<?=$user_id?>">
                                          <?php echo form_close();?>

                                          <div class="row">
                                             <div class="col-md-12">
                                                
                                                   <h5><span class="semi-bold">রোভার স্কাউট পদোন্নতির
                                                    বিবরণ</span></h5>

                                                   <span id="printbadge_promotion"></span>
                                       
                                                </div>   
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="tab-pane" id="tab_camp">
                                    <div class="row ">
                                       <div class="col-md-12">
                                       <h5><span class="semi-bold">ক্যাম্প রেকর্ড </span></h5>
                                          <?php 
                                          $attributes = array('id' => 'program_badge_camping');
                                          echo form_open("", $attributes);?>
                                          <div class="row form-row">
                                            
                                             <div class="col-md-6">
                                                <label class="form-label">ক্যাম্পের নাম</label>
                                                <?php echo form_error('camp_name'); ?>
                                                <input type="text" name="camp_name" id="camp_name" class="form-control input-sm" value="<?=set_value('camp_name')?>" placeholder="">
                                             </div>

                                             <div class="col-md-6">
                                                <label class="form-label">ক্যাম্পের স্থান</label>
                                                <?php echo form_error('area'); ?>
                                                <input type="text" name="area" id="area" class="form-control input-sm" value="<?=set_value('area')?>" placeholder="">
                                             </div>
                                             
                                          </div>
                                          <div class="row form-row">
                                             <div class="col-md-3">  
                                                <label class="form-label">ক্যাম্প তারিখ</label>
                                                <?php echo form_error('camp_date'); ?>
                                                <input type="text" name="camp_date" id="camp_achive_date" class="form-control input-sm datetime" value="<?=set_value('achive_date')?>" placeholder="DD-MM-YYYY">
                                             </div>

                                             <div class="col-md-3">  
                                                <label class="form-label">সনদ নং</label>
                                                <?php echo form_error('camp_certificate_no'); ?>
                                                <input type="text" name="camp_certificate_no" id="camp_certificate_no" class="form-control input-sm " value="<?=set_value('camp_certificate_no')?>" placeholder="">
                                             </div>
                                             <div class="col-md-5">
                                                <label class="form-label">মূল্যায়নকারী</label>
                                                <?php echo form_error('examiner_id');
                                                //$more_attr = 'class="form-control input-sm" id="camp_examiner_id"';
                                                //echo form_dropdown('examiner_id', $scout_members, set_value('examiner_id'), $more_attr);
                                                ?>
                                                <select class="scoutIDSingleSelect2 form-control" name="examiner_id" id="camp_examiner_id" style="width:100%"></select>
                                             </div>
                                             
                                             <div class="col-md-1">  
                                                <label class="form-label">&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-mini mini-btn-padding">Save</button>
                                             </div>
                                          </div> 
                                          <input type="hidden" name="hide_id" id="camp_hide_id">
                                          <input type="hidden" name="hide_section_id" id="camp_hide_section_id" value="<?=$section_id?>">
                                          <input type="hidden" name="hide_user_id" id="camp_hide_user_id" value="<?=$user_id?>">
                                          <?php echo form_close();?>

                                          <div class="row">
                                             <div class="col-md-12">
                                                
                                                   <h5><span class="semi-bold">ক্যাম্প রেকর্ডের
                                                    বিবরণ</span></h5>

                                                   <span id="printbadge_camping"></span>
                                       
                                                </div>   
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="tab-pane" id="tab_resign">
                                    <div class="row ">
                                       <div class="col-md-12">
                                       <h5><span class="semi-bold">গ্রুপ ত্যাগ </span></h5>
                                          <?php 
                                          $attributes = array('id' => 'program_badge_resign');
                                          echo form_open("", $attributes);?>
                                          
                                          <div class="row form-row">
                                             <div class="col-md-3">  
                                                <label class="form-label">গ্রুপ ত্যাগের তারিখ</label>
                                                <?php echo form_error('resign_date'); ?>
                                                <input type="text" name="resign_date" id="resign_date" class="form-control input-sm datetime" value="<?=set_value('resign_date')?>" placeholder="DD-MM-YYYY">
                                             </div>
                                            
                                             <div class="col-md-3">
                                                <label class="form-label">গ্রুপ ত্যাগের কারণ</label>
                                                <?php echo form_error('resign_reason'); ?>
                                                <input type="text" name="resign_reason" id="resign_reason" class="form-control input-sm" value="<?=set_value('resign_reason')?>" placeholder="">
                                             </div>

                                             <div class="col-md-5">
                                                <label class="form-label">মূল্যায়নকারী</label>
                                                <?php echo form_error('examiner_id');
                                                //$more_attr = 'class="form-control input-sm" id="resign_examiner_id"';
                                                //echo form_dropdown('examiner_id', $scout_members, set_value('examiner_id'), $more_attr);
                                                ?>
                                                <select class="scoutIDSingleSelect2 form-control" name="examiner_id" id="resign_examiner_id" style="width:100%"></select>
                                             </div>
                                             
                                             <div class="col-md-1">  
                                                <label class="form-label">&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-mini mini-btn-padding">Save</button>
                                             </div>
                                          </div>
                                          <input type="hidden" name="hide_id" id="resign_hide_id">
                                          <input type="hidden" name="hide_section_id" id="resign_hide_section_id" value="<?=$section_id?>">
                                          <input type="hidden" name="hide_user_id" id="resign_hide_user_id" value="<?=$user_id?>">
                                          <?php echo form_close();?>

                                          <div class="row">
                                             <div class="col-md-12">
                                                
                                                   <h5><span class="semi-bold">গ্রুপ ত্যাগের
                                                    বিবরণ</span></h5>

                                                   <span id="printbadge_resign"></span>
                                       
                                                </div>   
                                          </div>
                                       </div>
                                    </div>
                                 </div>                           

                              </div>
                           </div>
                        </div>
                     </div>

                  </div>  <!-- END GRID BODY -->              
               </div> <!-- END GRID -->
            </div>

         </div> <!-- END ROW -->
      </div>
   </div>

<script type="text/javascript">
   $(document).ready(function() {
	   	
   get_scout_badge_training();
   get_scout_badge_promotion();
   get_scout_badge_camping();
   get_scout_badge_resign();     
	  
   $('#program_badge').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         badge_id: {
            required: true
         },
         question_id: {
            required: true
         },
         achive_date: {
            required: true
         },
          examiner_id: {
            required: false
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
         //form.submit();
		 get_scout_badge_det();
      }
   });

   $('#program_badge_camping').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         area: {
            required: true
         },
         camp_date: {
            required: true
         },
         camp_name: {
            required: true
         },
         camp_certificate_no: {
            required: true
         },
         examiner_id: {
            required: false
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
         //form.submit();
       get_scout_badge_camping();
      }
   });

   $('#program_badge_training').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            badge_id: {
               required: true
            },
            train_date: {
               required: true
            },
            train_name: {
               required: true
            },
            train_certificate_no: {
               required: true
            },
            examiner_id: {
               required: false
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
            //form.submit();
          get_scout_badge_training();
         }
   });

   $('#program_badge_health').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            health_years: {
               required: true
            },
            health_height: {
               required: true
            },
            health_weight: {
               required: true
            },
            health_span: {
               required: true
            },
            health_hand_size: {
               required: true
            },
            health_temperature: {
               required: true
            },
            health_heartbeat: {
               required: true
            },
            health_chest_size: {
               required: true
            },
            examiner_id: {
               required: false
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
            //form.submit();
          get_scout_badge_health();
         }
   });

   $('#program_badge_institute').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            institute_years: {
               required: true
            },
            institute_class_name: {
               required: true
            },
            institute_roll_no: {
               required: true
            },
            institute_total_unmber: {
               required: true
            },
            examiner_id: {
               required: false
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
            //form.submit();
          get_scout_badge_institute();
         }
   });

   $('#program_badge_promotion').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            badge_id: {
               required: true
            },
            role_id: {
               required: true
            },
            promotion_from_date: {
               required: true
            },
            promotion_to_date: {
               required: false
            },
            examiner_id: {
               required: false
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
            //form.submit();
          get_scout_badge_promotion();
         }
   });

   $('#program_badge_resign').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            
            resign_date: {
               required: true
            },
            resign_reason: {
               required: true
            },
            examiner_id: {
               required: false
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
            //form.submit();
          get_scout_badge_resign();
         }
   });

   
   });  

   // scout badge 
   function get_scout_badge_det(){
	   $.ajax({			 
			  method: "GET",
			  url: "<?=base_url('program/program_badge/'.$id)?>",
			  data: { scout_badge: $("#scout_badge").val(), examiner_id: $("#examiner_id").val(), question_id: $("#question_id").val(), achive_date: $("#achive_date").val(), section_id: $("#hide_section_id").val(), hide_id: $("#hide_id").val(), hide_user_id: $("#hide_user_id").val() }
			  
			})
			  .done(function( msg ) {
				detailsarr=msg.split('23432sdfg324');
				if(detailsarr[0]=='duplicate')
				{
					alert('Duplicate')
				}
				if(detailsarr[1]!='')
				{
					$('#printbadgh').html(detailsarr[1]);
				}
				
				
				$("#scout_badge").prop("disabled", false);
				$("#question_id").prop("disabled", false);
				
				$("#achive_date").val('');
				$("#hide_id").val('');
				$("#scout_badge").val('');
				$("#question_id").val('');
            $("#examiner_id").val('');
				
				
		  }); 
   }

   function delete_scoutprogram(delid){
	   if(confirm('Are you sure you want to delete this data?'))
	   {
			$.ajax({			 
				  method: "GET",
				  url: "<?=base_url('program/program_badge/'.$id)?>",
				  data: { delete_id: delid, scout_badge: $("#scout_badge").val(), examiner_id: $("#examiner_id").val(), question_id: $("#question_id").val(), achive_date: $("#achive_date").val(), section_id: $("#hide_section_id").val(), hide_id: $("#hide_id").val(), hide_user_id: $("#hide_user_id").val() }
				})
				  .done(function( msg ) {
					detailsarr=msg.split('23432sdfg324');
					if(detailsarr[0]=='duplicate')
					{
						alert('Duplicate')
					}
					if(detailsarr[1]!='')
					{
						$('#printbadgh').html(detailsarr[1]);
					}
					
			  }); 
	   }
   }

   function edit_scoutprogram(delid, datefield,badgeid,qid,mid){
	   $("#achive_date").val(datefield);
	   $("#hide_id").val(delid);
	   $("#scout_badge").val(badgeid);
      $("#examiner_id").val(mid);
	   
	   scout_badge_details_select(qid);
	   
	   $("#scout_badge").prop("disabled", false);
	   $("#question_id").prop("disabled", false);
   }

   // expertness 

   
   function edit_scoutprogram__expertness(delid, datefield,badgeid,qid, ex_badge,mid)
   {
      $("#ex_achive_date").val(datefield);
      $("#ex_hide_id").val(delid);
      $("#ex_scout_badge").val(badgeid);
      $("#extra_badge").val(ex_badge);
     // $("#question_id").val(qid)
     $("#ex_examiner_id").val(mid);
      
      scout_badge_expert_group_select(qid);
      
      $("#ex_scout_badge").prop("disabled", false);
      $("#expert_group_id").prop("disabled", false);
   }

   function edit_scoutprogram_achievemen(delid, datefield,badgeid,mid)
   {
      $("#achiev_achive_date").val(datefield);
      $("#achiev_hide_id").val(delid);
      $("#achiev_scout_badge").val(badgeid);
      $("#achiev_examiner_id").val(mid);
      
      $("#achiev_scout_badge").prop("disabled", false);
   }

   // Camping 

   function get_scout_badge_camping()
   {
      $.ajax({        
           method: "GET",
           url: "<?=base_url('program/program_badge_camping/'.$id)?>",
           data: { examiner_id: $("#camp_examiner_id").val(), area: $("#area").val(),  achive_date: $("#camp_achive_date").val(),camp_name: $("#camp_name").val(), camp_certificate_no: $("#camp_certificate_no").val(), section_id: $("#camp_hide_section_id").val(), hide_id: $("#camp_hide_id").val(), hide_user_id: $("#camp_hide_user_id").val() }
           
         })
           .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_camping').html(detailsarr[1]);
            }
            
           
            $("#camp_scout_badge").prop("disabled", false);
            
            $("#camp_achive_date").val('');
            $("#camp_hide_id").val('');
            $("#area").val('');
            $("#camp_name").val('');
            $("#camp_certificate_no").val('');
            $("#camp_examiner_id").val('');
            
           }); 
   }
   function delete_scoutprogram_camping(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
              method: "GET",
              url: "<?=base_url('program/program_badge_camping/'.$id)?>",
              data: { delete_id: delid, examiner_id: $("#camp_examiner_id").val(), area: $("#area").val(), achive_date: $("#camp_achive_date").val(), section_id: $("#camp_hide_section_id").val(), camp_name: $("#camp_name").val(), camp_certificate_no: $("#camp_certificate_no").val(), hide_id: $("#camp_hide_id").val(), hide_user_id: $("#camp_hide_user_id").val() }
            })
              .done(function( msg ) {
               detailsarr=msg.split('23432sdfg324');
               if(detailsarr[0]=='duplicate')
               {
                  alert('Duplicate')
               }
               if(detailsarr[1]!='')
               {
                  $('#printbadge_camping').html(detailsarr[1]);
               }
               
              }); 
      }
   }
   function edit_scoutprogram_camping(delid, datefield, area, camp_name, camp_certificate_no,mid)
   {
      $("#camp_achive_date").val(datefield);
      $("#camp_hide_id").val(delid);
      $("#area").val(area);
      $("#camp_name").val(camp_name);
      $("#camp_certificate_no").val(camp_certificate_no);
      $("#camp_examiner_id").val(mid);
      
      $("#camp_scout_badge").prop("disabled", false);
   }

   // Training 

   function get_scout_badge_training()
   {
      $.ajax({        
           method: "GET",
           url: "<?=base_url('program/program_badge_training/'.$id)?>",
           data: { scout_badge: $("#train_scout_badge").val(), examiner_id: $("#train_examiner_id").val(),  achive_date: $("#train_achive_date").val(),train_name: $("#train_name").val(), train_certificate_no: $("#train_certificate_no").val(), section_id: $("#train_hide_section_id").val(), hide_id: $("#train_hide_id").val(), hide_user_id: $("#train_hide_user_id").val() }
           
         })
           .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_training').html(detailsarr[1]);
            }
            
            
            $("#train_scout_badge").prop("disabled", false);
            
            $("#train_achive_date").val('');
            $("#train_hide_id").val('');
            $("#train_scout_badge").val('');
            $("#train_name").val('');
            $("#train_certificate_no").val('');
            $("#train_examiner_id").val('');
            
           }); 
   }
   function delete_scoutprogram_training(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
              method: "GET",
              url: "<?=base_url('program/program_badge_training/'.$id)?>",
              data: { delete_id: delid, scout_badge: $("#train_scout_badge").val(), examiner_id: $("#train_examiner_id").val(), achive_date: $("#train_achive_date").val(), section_id: $("#train_hide_section_id").val(), train_name: $("#train_name").val(), train_certificate_no: $("#train_certificate_no").val(), hide_id: $("#train_hide_id").val(), hide_user_id: $("#train_hide_user_id").val() }
            })
              .done(function( msg ) {
               detailsarr=msg.split('23432sdfg324');
               if(detailsarr[0]=='duplicate')
               {
                  alert('Duplicate')
               }
               if(detailsarr[1]!='')
               {
                  $('#printbadge_training').html(detailsarr[1]);
               }
               
              }); 
      }
   }
   function edit_scoutprogram_training(delid, datefield,badgeid, camp_name, camp_certificate_no, mid)
   {
      $("#train_achive_date").val(datefield);
      $("#train_hide_id").val(delid);
      $("#train_scout_badge").val(badgeid);
      $("#train_name").val(camp_name);
      $("#train_certificate_no").val(camp_certificate_no);
      $("#train_examiner_id").val(mid);
      
      $("#train_scout_badge").prop("disabled", false);
   }

   // health

   function get_scout_badge_health()
   {
      $.ajax({        
           method: "GET",
           url: "<?=base_url('program/program_badge_health/'.$id)?>",
           data: { examiner_id: $("#health_examiner_id").val(), health_years: $("#health_years").val(),  health_height: $("#health_height").val(),health_weight: $("#health_weight").val(), health_hand_size: $("#health_hand_size").val(), health_span: $("#health_span").val(),  health_heartbeat: $("#health_heartbeat").val(),health_temperature: $("#health_temperature").val(), health_chest_size: $("#health_chest_size").val(), section_id: $("#health_hide_section_id").val(), hide_id: $("#health_hide_id").val(), hide_user_id: $("#health_hide_user_id").val() }
           
         })
           .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_health').html(detailsarr[1]);
            }
            
            
               
            $("#health_years").val('');
            $("#health_height").val('');
            $("#health_weight").val('');
            $("#health_chest_size").val('');
            $("#health_span").val('');
            $("#health_hand_size").val('');
            $("#health_heartbeat").val('');
            $("#health_temperature").val('');
            $("#health_examiner_id").val('');
            
           }); 
   }
   function delete_scoutprogram_health(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
              method: "GET",
              url: "<?=base_url('program/program_badge_health/'.$id)?>",
              data: { delete_id: delid, examiner_id: $("#health_examiner_id").val(), health_years: $("#health_years").val(),  health_height: $("#health_height").val(),health_weight: $("#health_weight").val(), health_hand_size: $("#health_hand_size").val(), health_span: $("#health_span").val(),  health_heartbeat: $("#health_heartbeat").val(),health_temperature: $("#health_temperature").val(), health_chest_size: $("#health_chest_size").val(), section_id: $("#health_hide_section_id").val(), hide_id: $("#health_hide_id").val(), hide_user_id: $("#health_hide_user_id").val() }
            })
              .done(function( msg ) {
               detailsarr=msg.split('23432sdfg324');
               if(detailsarr[0]=='duplicate')
               {
                  alert('Duplicate')
               }
               if(detailsarr[1]!='')
               {
                  $('#printbadge_health').html(detailsarr[1]);
               }
               
              }); 
      }
   }
   function edit_scoutprogram_health(delid, health_years,health_height, health_weight, health_chest_size,health_span,health_hand_size,health_heartbeat,health_temperature, mid)
   {
      
      $("#health_hide_id").val(delid);
      $("#health_years").val(health_years);
      $("#health_height").val(health_height);
      $("#health_weight").val(health_weight);
      $("#health_chest_size").val(health_chest_size);
      $("#health_span").val(health_span);
      $("#health_hand_size").val(health_hand_size);
      $("#health_heartbeat").val(health_heartbeat);
      $("#health_temperature").val(health_temperature);
      $("#health_examiner_id").val(mid);
      
   }

   // institute

   function get_scout_badge_institute()
   {
      $.ajax({        
           method: "GET",
           url: "<?=base_url('program/program_badge_institute/'.$id)?>",
           data: { institute_years: $("#institute_years").val(),  examiner_id: $("#institute_examiner_id").val(), institute_class_name: $("#institute_class_name").val(),institute_roll_no: $("#institute_roll_no").val(), institute_total_unmber: $("#institute_total_unmber").val(), section_id: $("#institute_hide_section_id").val(), hide_id: $("#institute_hide_id").val(), hide_user_id: $("#institute_hide_user_id").val() }
           
         })
           .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_institute').html(detailsarr[1]);
            }
            
            
               
            $("#institute_years").val('');
            $("#institute_class_name").val('');
            $("#institute_roll_no").val('');
            $("#institute_total_unmber").val('');
            $("#institute_examiner_id").val('');
            
           }); 
   }
   function delete_scoutprogram_institute(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
              method: "GET",
              url: "<?=base_url('program/program_badge_institute/'.$id)?>",
              data: { delete_id: delid, institute_years: $("#institute_years").val(), examiner_id: $("#institute_examiner_id").val(),  institute_class_name: $("#institute_class_name").val(),institute_roll_no: $("#institute_roll_no").val(), institute_total_unmber: $("#institute_total_unmber").val(), section_id: $("#institute_hide_section_id").val(), hide_id: $("#institute_hide_id").val(), hide_user_id: $("#institute_hide_user_id").val() }
            })
              .done(function( msg ) {
               detailsarr=msg.split('23432sdfg324');
               if(detailsarr[0]=='duplicate')
               {
                  alert('Duplicate')
               }
               if(detailsarr[1]!='')
               {
                  $('#printbadge_institute').html(detailsarr[1]);
               }
               
              }); 
      }
   }
   function edit_scoutprogram_institute(delid, institute_years,institute_class_name, institute_roll_no, institute_total_unmber, mid)
   {
      
      $("#institute_hide_id").val(delid);
      $("#institute_years").val(institute_years);
      $("#institute_class_name").val(institute_class_name);
      $("#institute_roll_no").val(institute_roll_no);
      $("#institute_total_unmber").val(institute_total_unmber);
      $("#institute_examiner_id").val(mid);
      
   }institute



   // promotion 

   function get_scout_badge_promotion()
   {
      $.ajax({        
           method: "GET",
           url: "<?=base_url('program/program_badge_promotion/'.$id)?>",
           data: { scout_badge: $("#promotion_scout_badge").val(), examiner_id: $("#promotion_examiner_id").val(),  scout_role: $("#promotion_scout_role").val(), from_date: $("#promotion_from_date").val(),to_date: $("#promotion_to_date").val(), section_id: $("#promotion_hide_section_id").val(), hide_id: $("#promotion_hide_id").val(), hide_user_id: $("#promotion_hide_user_id").val() }
           
         })
           .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_promotion').html(detailsarr[1]);
            }
            
            
               $("#promotion_scout_badge").prop("disabled", false);
               $("#promotion_scout_role").prop("disabled", false);
               
               $("#promotion_from_date").val('');
               $("#promotion_to_date").val('');
               $("#promotion_scout_badge").val('');
               $("#promotion_scout_role").val('');
               $("#promotion_hide_id").val('');
               $("#promotion_examiner_id").val('');
            
           }); 
   }
   function delete_scoutprogram_promotion(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
              method: "GET",
              url: "<?=base_url('program/program_badge_promotion/'.$id)?>",
              data: { delete_id: delid, scout_badge: $("#promotion_scout_badge").val(), examiner_id: $("#promotion_examiner_id").val(), scout_role: $("#promotion_scout_role").val(), from_date: $("#promotion_from_date").val(),to_date: $("#promotion_to_date").val(), section_id: $("#promotion_hide_section_id").val(), hide_id: $("#promotion_hide_id").val(), hide_user_id: $("#promotion_hide_user_id").val() }
            })
              .done(function( msg ) {
               detailsarr=msg.split('23432sdfg324');
               if(detailsarr[0]=='duplicate')
               {
                  alert('Duplicate')
               }
               if(detailsarr[1]!='')
               {
                  $('#printbadge_promotion').html(detailsarr[1]);
               }
               
              }); 
      }
   }
   function edit_scoutprogram_promotion(delid, dateformfield,datetofield,badgeid, roleid,mid)
   {
      $("#promotion_from_date").val(dateformfield);
      $("#promotion_to_date").val(datetofield);
      $("#promotion_scout_badge").val(badgeid);
      $("#promotion_scout_role").val(roleid);
      $("#promotion_hide_id").val(delid);
      $("#promotion_examiner_id").val(mid);
      
      $("#promotion_scout_badge").prop("disabled", false);
      $("#promotion_scout_role").prop("disabled", false);
   }


    // resign 

   function get_scout_badge_resign()
   {
      $.ajax({        
           method: "GET",
           url: "<?=base_url('program/program_badge_resign/'.$id)?>",
           data: { resign_date: $("#resign_date").val(), examiner_id: $("#resign_examiner_id").val(), resign_reason: $("#resign_reason").val(), section_id: $("#resign_hide_section_id").val(), hide_id: $("#resign_hide_id").val(), hide_user_id: $("#resign_hide_user_id").val() }
           
         })
           .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_resign').html(detailsarr[1]);
            }
            
           
            $("#train_scout_badge").prop("disabled", false);
            
            $("#resign_date").val('');
            $("#resign_hide_id").val('');
            $("#resign_reason").val('');
            $("#resign_examiner_id").val('');
            
            
           }); 
   }
   function delete_scoutprogram_resign(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
              method: "GET",
              url: "<?=base_url('program/program_badge_resign/'.$id)?>",
              data: { delete_id: delid, resign_date: $("#resign_date").val(), examiner_id: $("#resign_examiner_id").val(), resign_reason: $("#resign_reason").val(), section_id: $("#resign_hide_section_id").val(), hide_id: $("#resign_hide_id").val(), hide_user_id: $("#resign_hide_user_id").val() }
            })
              .done(function( msg ) {
               detailsarr=msg.split('23432sdfg324');
               if(detailsarr[0]=='duplicate')
               {
                  alert('Duplicate')
               }
               if(detailsarr[1]!='')
               {
                  $('#printbadge_resign').html(detailsarr[1]);
               }
               
              }); 
      }
   }
   function edit_scoutprogram_resign(delid, datefield, reason,mid)
   {
      $("#resign_date").val(datefield);
      $("#resign_hide_id").val(delid);
      $("#resign_reason").val(reason);
      $("#resign_examiner_id").val(mid);
   }

   // All verify

   function verify_scoutprogram(verifyid,table,sl)
   {
      if(confirm('Are you sure you want to accept this data?'))
      {
         $.ajax({        
              method: "GET",
              url: "<?=base_url('program/verify_program/'.$id)?>",
              data: { verifyid: verifyid, verifytable:table, section_id: $("#resign_hide_section_id").val(), hide_id: $("#resign_hide_id").val(), hide_user_id: $("#resign_hide_user_id").val() }
            })
              .done(function( msg ) {
                  if(sl==1){
                     get_scout_badge_det();
                  }
                  if(sl==2){
                     get_scout_badge_expertness();
                  }
                  if(sl==3){
                     get_scout_badge_achievemen();
                  }
                  if(sl==4){
                      get_scout_badge_camping();
                  }
                  if(sl==5){
                     get_scout_badge_training();
                  }
                  if(sl==6){
                     get_scout_badge_health();;
                  }
                  if(sl==7){
                     get_scout_badge_institute();
                  }
                  if(sl==8){
                     get_scout_badge_promotion();
                  }
                  if(sl==9){
                     get_scout_badge_resign();
                  }
              }); 
      }
   }
</script>