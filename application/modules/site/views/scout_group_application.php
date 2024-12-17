<div class="container w-75">
   <div class="secondary_sc_content">
      <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px">স্কাউটস গ্রুপের আবেদন</p>

      <?php 
      $attributes = array('id' => 'compalien_validation');
      echo form_open("scout-group-application", $attributes);
      ?>
      <div class="container">
         <?php if($this->session->flashdata('success')):?>
            <div class="alert alert-success">
               <?=$this->session->flashdata('success');;?>
            </div>
         <?php endif; ?>

         <div class="row">
            <div class="col-md-12">
               <div class="row form-row">
                  <div class="col-md-7">
                     <div class="form-group">
                        <label class="form-label">স্কাউট গ্রুপের ধরণ <span class="required">*</span></label><br>
                        <?php echo form_error('grp_type'); ?>
                        <input type="radio" class="controlled" name="grp_type" id="grpTypeCtrl" value="1" <?=set_value('grp_type')==1?'checked':'checked';?>> নিয়ন্ত্রিত স্কাউট গ্রুপ
                        <input type="radio" class="open" name="grp_type" id="grpTypeClose" value="2" <?=set_value('grp_type')==2?'checked':'';?>> মুক্ত স্কাউট গ্রুপ
                        <div id="typeerror"></div>
                     </div>
                  </div>
                  <div class="col-md-5">
                     <div class="form-group">
                        <label class="form-label">দল/গ্রুপ সংগঠনের তারিখ <span class="required">*</span></label><br>
                        <?php echo form_error('grp_open_date'); ?>
                        <input name="grp_open_date" value="<?=set_value('grp_open_date')?>" type="date" class="form-control input-sm" placeholder="">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-label">স্কাউটস অঞ্চল  <span class="required">*</span></label>
                        <?php 
                        $css=array( 'class' =>'form-control', 'id' =>'region' );
                        echo form_dropdown('region_id', $regions, $region_data, $css) 
                        ?>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-label">স্কাউটস জেলা <span class="required">*</span></label>
                        <select name="district_id" class="sc_district_val form-control input-sm" id="sc_district2">
                           <option value="">-- নির্বাচন করুন --</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-label">স্কাউটস উপজেলা </label>
                        <select name="upazila_id" class="sc_upazila_val2 form-control input-sm">
                           <option value="">-- নির্বাচন করুন --</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label class="form-label">স্কাউট গ্রুপ অফিসের ঠিকানা</label>
                     <?php echo form_error('grp_address'); ?>
                     <input name="grp_address" value="<?=set_value('grp_address')?>" type="text" class="form-control input-sm" placeholder="">
                  </div>
               </div>
            </div>

            <div class="col-md-7">
               <div class="row form-row" id="groupWrap">
                  <div class="col-md-9">
                     <label class="form-label">শিক্ষা প্রতিষ্টানের নাম </label>
                     <?php echo form_error('institute_name');?>
                     <input name="institute_name" value="<?=set_value('institute_name')?>" type="text" class="form-control input-sm" placeholder="">
                  </div>
                  <div class="col-md-3">
                     <label class="form-label">কোড নং </label>
                     <?php echo form_error('instituete_code');?>
                     <input name="instituete_code" value="<?=set_value('instituete_code')?>" type="text" class="form-control input-sm" placeholder="">
                  </div>
               </div>

               <div class="row form-row">
                  <div class="col-md-12">
                     <label class="form-label"> স্কাউট গ্রুপের নাম (English) <span class="required">*</span></label>
                     <?php echo form_error('grp_name_en');?>
                     <input name="grp_name_en" value="<?=set_value('grp_name_en')?>" type="text" class="form-control input-sm" placeholder="">
                  </div>
               </div>

               <div class="row form-row">
                  <div class="col-md-12">
                     <label class="form-label"> স্কাউট গ্রুপের নাম (বাংলা) <span class="required">*</span></label>
                     <?php echo form_error('grp_name_bn');?>
                     <input name="grp_name_bn" value="<?=set_value('grp_name_bn')?>" type="text" class="bangla form-control input-sm" placeholder="" contenteditable="TRUE">
                  </div>
               </div>

               <div class="row form-row">
                  <div class="col-md-6">
                     <label class="form-label">মোবাইল নম্বর <span class="required">*</span></label>
                     <?php echo form_error('contact_mobile'); ?>
                     <input name="contact_mobile" value="<?=set_value('contact_mobile')?>" type="text" class="form-control input-sm" placeholder="">
                  </div>                          
                  <div class="col-md-6">
                     <label class="form-label">ইমেইল এড্রেস</label>
                     <?php echo form_error('contact_email'); ?>
                     <input name="contact_email" value="<?=set_value('contact_email')?>" type="text" class="form-control input-sm" placeholder="">
                  </div> 
               </div>
            </div>

            <div class="col-md-5">
               <div class="row form-row">
                  <h5 class="semi-bold">গ্রুপ কমিটি</h5>
                  <div class="col-md-12">
                     <label class="form-label">সভাপতির নাম <span class="required">*</span></label>
                     <input name="grp_president" value="<?=set_value('grp_president')?>" type="text" class="form-control input-sm" placeholder="">
                  </div>

                  <div class="col-md-12">
                     <label class="form-label">সভাপতির ঠিকানা </label>
                     <input name="grp_president_add" value="<?=set_value('grp_president_add')?>" type="text" class="form-control input-sm" placeholder="">
                  </div>

                  <div class="col-md-12">
                     <label class="form-label">সম্পাদকের নাম <span class="required">*</span></label>
                     <input name="grp_secretary" value="<?=set_value('grp_secretary')?>" type="text" class="form-control input-sm" placeholder="">
                  </div>

                  <div class="col-md-12">
                     <label class="form-label">সম্পাদকের ঠিকানা</label>
                     <input name="grp_secretary_add" value="<?=set_value('grp_secretary_add')?>" type="text" class="form-control input-sm" placeholder="">
                  </div>
               </div>
            </div>    
         </div>

         <div class="row">
            <div class="col-md-12">
               <style type="text/css">td{padding:2px;}</style>
               <table width="100%" border="1" style="border:1px solid #a09e9e;">
               <h5 class="semi-bold" style="text-align: center;">গ্রুপ স্কাউটারস কাউন্সিল</h5>
                  <tr>
                     <!-- <td>Member Name</td> -->
                     <th style="text-align: center;">লিডারের নাম <span class="required">*</span></th>
                     <th style="text-align: center;">প্রশিক্ষণ গ্রহনের তারিখ </th>
                     <th style="text-align: center;">সার্টিফিকেট নম্বর  </th>
                     <th style="text-align: center;">প্রশিক্ষণ স্থান </th>
                     <th style="text-align: center;">দলের দায়িত্ব </th>
                  </tr>
                  <tr>
                     <td><input name="leader_name1" value="<?=set_value('leader_name1')?>" type="text" size="15"></td>
                     <td><input name="training_date1" value="<?=set_value('training_date1')?>" type="date" size="8"></td>
                     <td><input name="certificate_no1" value="<?=set_value('certificate_no1')?>" type="text" size="8"></td>
                     <td><input name="training_place1" value="<?=set_value('training_place1')?>" type="text" size="10"></td>
                     <td><input name="group_res1" value="<?=set_value('group_res1')?>" type="text" size="10"></td>
                  </tr>
                  <tr>
                     <td><input name="leader_name2" value="<?=set_value('leader_name2')?>" type="text" size="15"></td>
                     <td><input name="training_date2" value="<?=set_value('training_date2')?>" type="date" size="8"></td>
                     <td><input name="certificate_no2" value="<?=set_value('certificate_no2')?>" type="text" size="8"></td>
                     <td><input name="training_place2" value="<?=set_value('training_place2')?>" type="text" size="10"></td>
                     <td><input name="group_res2" value="<?=set_value('group_res2')?>" type="text" size="10"></td>
                  </tr>
                  <tr>
                     <td><input name="leader_name3" value="<?=set_value('leader_name3')?>" type="text" size="15"></td>
                     <td><input name="training_date3" value="<?=set_value('training_date3')?>" type="date" size="8"></td>
                     <td><input name="certificate_no3" value="<?=set_value('certificate_no3')?>" type="text" size="8"></td>
                     <td><input name="training_place3" value="<?=set_value('training_place3')?>" type="text" size="10"></td>
                     <td><input name="group_res3" value="<?=set_value('group_res3')?>" type="text" size="10"></td>
                  </tr>
                  <tr>
                     <td><input name="leader_name4" value="<?=set_value('leader_name4')?>" type="text" size="15"></td>
                     <td><input name="training_date4" value="<?=set_value('training_date4')?>" type="date" size="8"></td>
                     <td><input name="certificate_no4" value="<?=set_value('certificate_no4')?>" type="text" size="8"></td>
                     <td><input name="training_place4" value="<?=set_value('training_place4')?>" type="text" size="10"></td>
                     <td><input name="group_res4" value="<?=set_value('group_res4')?>" type="text" size="10"></td>
                  </tr>
               </table>
            </div>
         </div>

         <br>

         <div class="row">
            <div class="col-md-12">
               <style type="text/css">td{padding:2px;}</style>
               <table width="100%" border="1" style="border:1px solid #a09e9e;">
               <h5 class="semi-bold" style="text-align: center;">পরিসংখ্যান</h5>
                  <tr>
                     <th style="text-align: center;">বিভাগ/শ্রেণী</th>
                     <th style="text-align: center;">কাব স্কাউট</th>
                     <th style="text-align: center;">বয় স্কাউট</th>
                  </tr>
                  <tr>
                     <th style="text-align: right;">মেম্বারশীপ ব্যাজ</th>
                     <td><input name="member_badge_cub" value="<?=set_value('member_badge_cub')?>" type="number" size="10"></td>
                     <td><input name="member_badge_boy" value="<?=set_value('member_badge_boy')?>" type="number" size="10"></td>                     
                  </tr>
                  <tr>
                     <th style="text-align: right;">তাঁরা ব্যাজ /স্ট্যান্ডার্ড ব্যাজ</th>
                     <td><input name="moon_standard_cub" value="<?=set_value('badge_standard_cub')?>" type="number" size="10"></td>
                     <td><input name="moon_standard_boy" value="<?=set_value('moon_standard_boy')?>" type="number" size="10"></td>
                  </tr>
                  <tr>
                     <th style="text-align: right;">চাঁদ ব্যাজ/প্রোগ্রেস ব্যাজ </th>
                     <td><input name="moon_progress_cub" value="<?=set_value('moon_progress_cub')?>" type="number" size="10"></td>
                     <td><input name="moon_progress_boy" value="<?=set_value('moon_progress_boy')?>" type="number" size="10"></td>
                  </tr>
                  <tr>
                     <th style="text-align: right;">চাঁদ তাঁরা ব্যাজ/সার্ভিস ব্যাজ </th>
                     <td><input name="moon_service_cub" value="<?=set_value('moon_service_cub')?>" type="number" size="10"></td>
                     <td><input name="moon_service_boy" value="<?=set_value('moon_service_boy')?>" type="number" size="10"></td>
                  </tr>
                  <tr>
                     <th style="text-align: right;">প্রেসিডেন্ট স্কাউট/শাপলা কাব</th>
                     <td><input name="president_shapla_cub" value="<?=set_value('president_shapla_cub')?>" type="number" size="10"></td>
                     <td><input name="president_shapla_boy" value="<?=set_value('president_shapla_boy')?>" type="number" size="10"></td>
                  </tr>
               </table>
            </div>
         </div>

         <br>
         <div class="row">
            <div class="col-md-12">
               <div class="form-actions">  
                  <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Send Application</button>
               </div>
            </div>
         </div>

      </div>

      <?php echo form_close();?>
      <div class="py-3"></div>
   </div>
</div>

<script type="text/javascript">

   $(document).ready(function() {
      $('#compalien_validation').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            grp_open_date: {required: true},
            region_id: {required: true},
            district_id: {required: true},
            grp_name_en: {required: true},
            grp_name_bn: {required: true},
            contact_mobile: {required: true,number: true,minlength: 11,maxlength: 11},
            grp_president: {required: true},
            grp_secretary: {required: true},
            grp_president: {required: true},
            grp_president: {required: true},
            grp_president: {required: true},
            grp_president: {required: true}
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


   // Group Type Hide/Show
   $(".controlled").click(function(){
      $("#groupWrap").show();
   });

   $(".open").click(function(){
    $("#groupWrap").hide();
 });

</script>