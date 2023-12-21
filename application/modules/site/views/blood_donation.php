<?php 
$name=$this->session->userdata('site_lang')=='bangla'?'first_name_bn':'first_name';
$upazila_name=$this->session->userdata('site_lang')=='bangla'?'up_th_name_bn':'up_th_name';
$district_name=$this->session->userdata('site_lang')=='bangla'?'district_name_bn':'district_name';
$bg_name_data=$this->session->userdata('site_lang')=='bangla'?'bg_name_bn':'bg_name_en';
?>
      <div class="container w-75">
        <div class="secondary_sc_content">
            <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=$this->session->userdata('site_lang')=='bangla'?'অনুসন্ধান রক্তদান':'Search Blood Donation';?></p>

              <?php 
                 $attributes = array('id' => 'blood_donation_validation', 'method' => 'get');
                 echo form_open("blood-donation/".$info->id, $attributes);

                 $division_data=isset($_GET['bDivision'])?$_GET['bDivision']:'';
                 $district_data=isset($_GET['bDistrict'])?$_GET['bDistrict']:'';
                 $upazila_data=isset($_GET['bUpaThana'])?$_GET['bUpaThana']:'';
                 $bg_data=isset($_GET['bg'])?$_GET['bg']:'';
              ?>
              <div class="container">
                 <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  
                      <div class="row result">
                          <div class="col-md-6">
                            <div class="form-group">
                              <!-- <label class="form-label">Division</label> -->
                              <?php echo form_error('bDivision');
                              $more_attr = 'class="form-control input-sm" id="division"';
                              echo form_dropdown('bDivision', $divisions, $division_data, $more_attr);
                              ?>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <!-- <label class="form-label">District</label> -->
                              <?php echo form_error('bDistrict'); ?>
                              <?php
                              $more_attr = 'class="distirict_val form-control input-sm" id="district"';
                              echo form_dropdown('bDistrict', $districts, $district_data, $more_attr);
                              ?>
                           </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <!-- <label class="form-label">Upazila/Thana</label> -->
                              <?php echo form_error('bUpaThana'); ?>
                              <?php
                              $more_attr = 'class="upazila_thana_val form-control input-sm"';
                              echo form_dropdown('bUpaThana', $upazilas, $upazila_data, $more_attr);
                              ?>
                            </div>
                          </div> 
                          <div class="col-md-4">
                            <div class="form-group">
                              <?php echo form_error('bg');
                              $more_attr = 'class="form-control input-sm" id="blood"';
                              echo form_dropdown('bg', $blood, $bg_data, $more_attr);
                              ?>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <button type="submit" class="btn text-white btn-block" style="background-color: #1aa326; font-size: 13px"><?=$this->session->userdata('site_lang')=='bangla'?'অনুসন্ধান':'Search';?></button>   
                            </div>
                          </div> 
                          
                      </div>
                      
                      <?php if(!empty($result)){
                        $text=$this->session->userdata('site_lang')=='bangla'?'রক্ত দান করতে আগ্রহী':'Interested to donate blood for';
                          echo '<h5>'.$text.' ('.$bg_name->$bg_name_data.') </h5><hr>';
                          echo '<div class="row">';
                              foreach ($result as $item) { 
                                $path = base_url().'profile_img/';
                                if($item->profile_img != NULL){
                                  $img_url = $path.$item->profile_img;
                                }else{
                                  $img_url = $path.'no-img.png';
                                }
                              ?>
                                <div class="col-md-6">
                                  <div class="row single_search" >
                                      <div class="col-md-4"><img src="<?=$img_url?>" class="" style="width: 80px; height: 80px;">
                                        <h6 style="margin-left: 15px;"><?=$item->scout_id?></h6>
                                      </div>
                                      <div class="col-md-8">
                                          <h6><b><?=$item->first_name?></b></h6>
                                          <?=lang('site_user_phone')?>: <?=$this->session->userdata('site_lang')=='bangla'?BanglaConverter::en2bn($item->phone):BanglaConverter::bn2en($item->phone);?> <br>
                                          <?=lang('site_body_service_request_address')?>: <?=$item->$upazila_name?>, <?=$item->$district_name?></br> 
                                      </div>
                                  </div>
                                </div>
                              <?php 
                              }
                        echo '</div>';      
                      }
                    ?>

            </div>
          <?php echo form_close();?>
        <div class="py-3"></div>
      </div>
    </div>

    <script type="text/javascript">
$(document).ready(function() {
  $('#blood_donation_validation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         bDivision: {
            required: true
         },
         bg: {
            required: true
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