<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('scout_group_application/application_list')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>
      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; width: 98%; margin: 10px;}
         .tg td{font-family:Arial, sans-serif;font-size:14px;padding:7px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color:black;}
         .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:7px 3px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color:black;}
         .tg .tg-68ib{font-weight:bold;background-color:#efefef;border-color:#9b9b9b;text-align:right;vertical-align:top; width: 190px;}
         .tg .tg-2fdn{border-color:#9b9b9b;text-align:left;vertical-align:top;padding:7px 5px;}
         .tg .tg-yuct{font-weight:bold;background-color:#efefef;border-color:#9b9b9b;text-align:right;vertical-align:middle; width: 180px;}
         .tg .tg-m6jf{border-color:#9b9b9b;text-align:left;vertical-align:middle}
      </style>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">           
                     <a href="<?=base_url('scout_group_application/application_list')?>" class="btn btn-success btn-xs btn-mini"> Application List</a> 
                     <a href="<?=base_url('scout_group_application/details/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini" target="_blank">Details</a>
                  </div>
               </div>

               <div class="grid-body">
                  <div class="row">  

                     <div class="col-md-8">
                        <table class="tg">  
                           <tr>
                              <td class="tg-68ib">বাংলাদেশ স্কাউটস</td>
                              <td class="tg-2fdn"><strong><?=$info->upa_name?></strong></td>
                           </tr> 
                           <tr>
                              <td class="tg-68ib">দলের / গ্রুপের  নাম</td>
                              <td class="tg-2fdn"><strong><?=$info->grp_name_bn?></strong></td>
                           </tr>   
                           <tr>
                              <td class="tg-68ib">ঠিকানা</td>
                              <td class="tg-2fdn"><?=$info->grp_address?></td>
                           </tr> 
                           <?php if($info->grp_type == 1){ ?>
                           <tr>
                              <td class="tg-68ib">নিয়ন্ত্রক প্রতিষ্ঠানের নাম</td>
                              <td class="tg-2fdn"><?=$info->institute_name?></td>
                           </tr> 
                           <?php } ?>
                           <tr>
                              <td class="tg-68ib">দল/গ্রুপ সংগঠনের তারিখ</td>
                              <td class="tg-2fdn"><?=date_bangla_calender_format($info->grp_open_date)?></td>
                           </tr> 
                           <tr>
                              <td class="tg-68ib">
                                 স্কাউটস অঞ্চল<br>
                                 রেজিস্ট্রেশন নম্বর <br>
                                 রেজিস্ট্রেশনের তারিখ <br>
                                 স্কাউটস অঞ্চলের মন্তব্য
                              </td>
                              <td class="tg-2fdn"><br>
                                 <?php 
                                 echo $info->reg_region_charter_number.'<br>'; 
                                 echo date_bangla_calender_format($info->reg_region_date).'<br>'; 
                                 echo $info->comment_region;
                                 ?>
                              </td>
                           </tr> 
                           <tr>
                              <td class="tg-68ib">
                                 স্কাউটস জেলা<br>
                                 রেজিস্ট্রেশন নম্বর <br>
                                 রেজিস্ট্রেশনের তারিখ <br>
                                 স্কাউটস জেলার মন্তব্য
                              </td>
                              <td class="tg-2fdn"><br>
                                 <?php 
                                 echo $info->reg_dis_num.'<br>'; 
                                 echo date_bangla_calender_format($info->reg_dis_date).'<br>'; 
                                 echo $info->comment_district;
                                 ?>
                              </td>
                           </tr> 
                           <tr>
                              <td class="tg-68ib">
                                 স্কাউটস উপজেলা<br>
                                 রেজিস্ট্রেশন নম্বর <br>
                                 রেজিস্ট্রেশনের তারিখ <br>
                                 স্কাউটস উপজেলার মন্তব্য
                              </td>
                              <td class="tg-2fdn"> <br>
                                 <?php 
                                 echo $info->reg_upa_num.'<br>'; 
                                 echo date_bangla_calender_format($info->reg_upa_date).'<br>'; 
                                 echo $info->comment_upazila;
                                 ?>                                 
                              </td>
                           </tr> 
                        </table>
                     </div>    

                     <div class="col-md-4">
                        <?php 
                        $attributes = array('id' => 'validate');
                        echo form_open(uri_string(), $attributes);
                        ?>
                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Reg./Charter Number </label>
                              <?php echo form_error('reg_num'); ?>
                              <input type="text" name="reg_num" class="form-control input-sm" value="<?=set_value('reg_num')?>">
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Status <span class="required">*</span></label>
                              <?php 
                              echo form_error('status');
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('status', $status, set_value('status'), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-12">
                              <label class="form-label">Comments </label>
                              <?php echo form_error('comments'); ?>
                              <textarea name="comments" class="form-control input-sm"><?=set_value('comments')?></textarea>
                           </div>
                           <div class="col-md-12">
                              <button type="submit" class="btn btn-mini btn-xs btn-blueviolet" onclick="return confirm('Are you sure verify status is correct?')"><i class="icon-ok"></i> Save</button>
                           </div>
                        </div>
                        <?php echo form_close();?>
                     </div>

                  </div>
               </div> <!-- grid-body -->
            </div> <!-- /grid -->
         </div>
      </div> <!-- row -->
   </div> <!-- /content -->
</div> <!-- /page-content -->

<script type="text/javascript">
  // 'event_notify[]': { required: true }  
  
  $(document).ready(function() {
     $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         reg_num: {required},
         status: { required: true}
      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type   
       if (element.attr("name") == "event_notify[]") {
        label.insertAfter("#typeerror");
     } else {
        $('<span class="error"></span>').insertAfter(element).append(label)
        var parent = $(element).parent('.input-with-icon');
        parent.removeClass('success-control').addClass('error-control');  
     }
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

