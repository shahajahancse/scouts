<div class="container w-75">
  <div class="secondary_sc_content">
    <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=lang('site_service_traking')?></p>

    <?php 
    $attributes = array('id' => 'infovalidation', 'method' => 'get');
    echo form_open("service-traking", $attributes);
    ?>
    <div class="container">
     <?php if($this->session->flashdata('success')):?>
       <div class="alert alert-success">
        <?=$this->session->flashdata('success');;?>
      </div>
    <?php endif; ?>

    <div class="row result">
      <p style="margin-left: 15px;"> <?=lang('site_service_traking_note')?></p>
      <div class="col-md-6">
        <div class="form-group">
          <label style="font-weight:bold;"><?=lang('site_body_service_request_mobile')?>*</label>
          <?php echo form_error('mobile'); ?>
          <input type="number" name="mobile" class="form-control" value="<?=set_value('mobile')?>"" id="" placeholder="">
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group" style="margin-top: 30px;">
          <button type="submit" class="btn text-white btn-block" style="background-color: #1aa326;"><?=lang('site_service_traking_search')?></button>   
        </div>
      </div> 

    </div>

    <?php if($this->input->get('mobile')){ ?>
    <div class="row">      
    <div class="col-md-12">
        <p><?=lang('site_service_traking_search_number')?> <?=$this->session->userdata('site_lang')=='bangla'?BanglaConverter::en2bn($_GET['mobile']):BanglaConverter::bn2en($_GET['mobile']);?></p>
        <?php if(count($result) != 0){ ?>
        <h5><?=lang('site_service_traking_search_status')?> </h5><hr>

        <style type="text/css">
          .tg  {border-collapse:collapse;border-spacing:0; width: 100%}
          .tg td{font-family:Arial, sans-serif;font-size:14px;padding:4px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
          .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
          .tg .tg-t4bo{font-size:14px;background-color:#cbcefb;color:#000000;border-color:#9698ed;text-align:left}
          .tg .tg-ronw{font-weight:bold;background-color:#9698ed;color:#000000;border-color:#6665cd;text-align:center}
        </style>
        <table class="tg">
          <tr>
            <th class="tg-ronw"><?=lang('site_service_traking_service_name')?></th>
            <th class="tg-ronw"><?=lang('site_service_traking_service_request')?></th>
            <th class="tg-ronw"><?=lang('site_service_traking_service_status')?></th>
          </tr>
          <?php foreach ($result as $item) { 
            if($item->request_to == 1){
              $requestTo = $this->session->userdata('site_lang')=='bangla'?'জাতীয় সদর দপ্তর':'National Headquarter';              
            }else{
              $requestTo = $this->session->userdata('site_lang')=='bangla'?$item->region_name:$item->region_name_en;              
            }

            if($item->status == 'Complete'){
              $status = $this->session->userdata('site_lang')=='bangla'?'সম্পূর্ণ':'Complete';              
            }elseif($item->status == 'Pending'){
              $status = $this->session->userdata('site_lang')=='bangla'?'বিচারাধীন':'Pending';              
            }elseif($item->status == 'Reject'){
              $status = $this->session->userdata('site_lang')=='bangla'?'প্রত্যাখ্যান':'Reject';              
            }else{
              $status = $this->session->userdata('site_lang')=='bangla'?'প্রক্রিয়াকরণ':'Processing';              
            }

            ?>
            <tr>
              <td class="tg-t4bo"><?=($this->session->userdata('site_lang')=='bangla')?$item->service_name_bn:$item->service_name?></td>
              <td class="tg-t4bo"><?=$requestTo?></td>
              <td class="tg-t4bo"><?=$status?></td>
            </tr>
            <?php } ?>
          </table>

          <?php }else{ ?>
          <p><?=lang('site_service_traking_no_request_yet')?></p>
          <?php } ?>
        </div>
      </div>      
      <?php } ?>

    </div>
    <?php echo form_close();?>
    <div class="py-3"></div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#infovalidation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        mobile: {
          required: true,
          number: true,
          minlength: 11,
          maxlength: 11
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