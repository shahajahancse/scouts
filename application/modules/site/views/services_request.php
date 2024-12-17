<div class="container w-75">
  <div class="secondary_sc_content">
    <?php
    if($this->session->userdata('site_lang') == 'english' ){
      $service_name = $info->service_name;
    }else{
      $service_name = $info->service_name_bn;
    }
    ?>
    <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=$service_name?> <?=lang('request-form')?></p>

    <?php 
    $attributes = array('id' => 'services_validation');
    echo form_open("site/services_request/".$info->id, $attributes);
    ?>
    <div class="container">
     <?php if($this->session->flashdata('success')):?>
       <div class="alert alert-success">
        <?=$this->session->flashdata('success');;?>
      </div>
    <?php endif; ?>

    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-2">

        <div class="row">
          <div class="col-md-7">
            <div class="form-group">
              <label class="form-label" style="font-weight:bold;"> <?=lang('site_body_service_request')?></label>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="request_to" value="1" id="nhq" onclick="show1();" checked><?=lang('site_body_service_request_option1')?>
                  </label>
                </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="request_to" value="2" id="region" onclick="show2();"><?=lang('site_body_service_request_option2')?>
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-5" id="div_result" style="display: none;">
            <div class="form-group">
              <label class="form-label" style="font-weight:bold;"><?=lang('site_body_scout_region')?></label>
              <?php echo form_error('region_id');
              $more_attr = 'class="form-control input-sm" id="region"';
              echo form_dropdown('region_id', $regions, set_value('region_id'), $more_attr);
              ?>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12 pt-2">
        <div class="form-group">
          <label for="exampleTextarea" lass="form-label" style="font-weight:bold;"><?=lang('site_body_service_request_details')?> *</label>
          <?php echo form_error('problem_details'); ?>
          <textarea class="form-control" rows="14" name="problem_details" id="exampleTextarea" rows="10"><?=set_value('problem_details')?></textarea>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 pt-2">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="formGroupExampleInput" style="font-weight:bold;"><?=lang('site_body_service_request_name')?>*</label>
              <?php echo form_error('name'); ?>
              <input type="text" name="name" class="form-control" <?=set_value('name')?> id="" placeholder="">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="formGroupExampleInput" style="font-weight:bold;"><?=lang('site_body_service_request_mobile')?>*</label>
              <?php echo form_error('mobile'); ?>
              <input type="text" name="mobile" class="form-control" <?=set_value('mobile')?> id="" placeholder="">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="formGroupExampleInput" style="font-weight:bold;"><?=lang('site_body_service_request_email')?></label>
              <?php echo form_error('email'); ?>
              <input type="text" name="email" class="form-control" <?=set_value('email')?> id="" placeholder="">
            </div> 
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="formGroupExampleInput" style="font-weight:bold;"><?=lang('site_body_service_request_address')?>*</label>
              <?php echo form_error('address'); ?>
              <input type="text" name="address" class="form-control" <?=set_value('address')?> id="" placeholder="">
            </div> 
          </div>
        </div>  
      </div>

    </div>
    <button type="submit" class="btn text-white" style="background-color: #1aa326;"><div class="lead"><?=lang('site_body_service_request_send_request')?></div></button>  
  </div>
  <?php echo form_close();?>
  <div class="py-3"></div>
</div>
</div> 

<script type="text/javascript">
  $(document).ready(function() {
    $('#services_validation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
       division_id: {
        required: "#region:checked"
      },
      name: {
        required: true
      },
      mobile: {
        required: true,
        number: true,
        minlength: 11,
        maxlength: 11
      },
      email: {
        required: false,
        email:true
      },
      address: {
        required: true
      },
      details: {
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




  function show1(){
    document.getElementById('div_result').style.display ='none';
  }
  function show2(){
    document.getElementById('div_result').style.display = 'block';
  }  

</script>