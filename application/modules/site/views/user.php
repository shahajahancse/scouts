<style type="text/css">
  .tg-ronw{
    text-align: left !important;
  }
</style>
<div class="container w-75">
  <div class="secondary_sc_content">
    <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=lang('site_user_verify')?></p>

    <?php 
    $attributes = array('id' => 'infovalidation');
    echo form_open("user-verify", $attributes);
    ?>
    <div class="container">
     <?php if($this->session->flashdata('success')):?>
       <div class="alert alert-success">
        <?=$this->session->flashdata('success');;?>
      </div>
    <?php endif; ?>


    <?php if(!empty($result)){ ?>

    <div class="row">      
    <div class="col-md-12">
      <?php 
       if($this->session->userdata('site_lang')=='bangla'){
          $name='full_name_bn';
          $father_name='father_name_bn';
          $mother_name='mother_name_bn';
          $bg_name='bg_name_bn';
          $grp_name='grp_name_bn';
          $member_type_name='member_type_name_bn';
          $dis_name='dis_name';
       }else{
          $name='first_name';
          $father_name='father_name';
          $mother_name='mother_name';
          $bg_name='bg_name_en';
          $grp_name='grp_name';
          $member_type_name='member_type_name';
          $dis_name='dis_name_en';
       }
    ?>
        
      <?php if(count($result) != 0){ 
      $pre_village  = $result->pre_village_house;
			$pre_rode     = $result->pre_road_block;
			$pre_division = $result->pre_div_name;
			$pre_district = $result->pre_district_name;
			$pre_up_th    = $result->pre_up_th_name;
			$pre_po       = $result->pre_post_office;

			$full_pre_add = '';
			if($pre_village != '')
			  $full_pre_add .= $pre_village . ', ';

			if($pre_rode != '')
			  $full_pre_add .= $pre_rode . ', ';

			if($pre_up_th != '')
			  $full_pre_add .= $pre_up_th . ', ';

			if($pre_district != '' && $pre_division != '' && $pre_division != $pre_district)
			  $full_pre_add .= $pre_district . ', ';
			else if($pre_district != '')
			  $full_pre_add .= $pre_district;

			if($pre_division != '' && $pre_division != $pre_district)
			  $full_pre_add .= $pre_division;

      $profile_img = $result->profile_img;
      $path = base_url().'profile_img/';
      if($profile_img != NULL){
        $img_url = $path.$profile_img;
      }else{
        $img_url = $path.'no-img.png';
      }
        	?>
        

        <style type="text/css">
          .tg  {border-collapse:collapse;border-spacing:0; width: 100%}
          .tg td{font-family:Arial, sans-serif;font-size:14px;padding:4px 0px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
          .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
          .tg .tg-t4bo{font-size:14px;background-color:#cbcefb;color:#000000;border-color:#9698ed;text-align:left; padding: 5px;}
  .tg .tg-ronw{font-weight:bold;background-color:#9698ed;color:#000000;border-color:#6665cd;text-align:center;padding: 5px;}
        </style>
        <table class="tg">

          <tr>
            <th class="tg-ronw"><?=lang('site_user_name')?></th>
            <td class="tg-t4bo"><?=$result->$name?></td>
            <td rowspan="5" style="" valign="top"><img class = "img-responsive" src="<?=$img_url ?>" style="width: 100%;margin: 10pxpx;padding: 2px;"></td>
          </tr>
          <tr>
            <th class="tg-ronw"><?=lang('site_member_type')?></th>
            <td class="tg-t4bo"><?=$result->$member_type_name;?></td>
          </tr>
          <tr>
            <th class="tg-ronw"><?=lang('site_group_name')?></th>
            <td class="tg-t4bo" ><?=$result->$grp_name?></td>
          </tr>
          <tr>
            <th class="tg-ronw"><?=lang('site_dis_name')?></th>
            <td class="tg-t4bo" ><?=$result->$dis_name?></td>
          </tr>
          <tr>
            <th class="tg-ronw"><?=lang('site_father_name')?></th>
            <td class="tg-t4bo" ><?=$result->$father_name?></td>
             
          </tr>
           <tr>
            <th class="tg-ronw"><?=lang('site_mother_name')?></th>
            <td class="tg-t4bo"><?=$result->$mother_name?></td>
            <td class="tg-t4bo" style="text-align: center; font-weight: bold;"><?=lang('site_scout_id')?> : <?=$result->scout_id?></td>
           
          </tr>
          <tr>
            <th class="tg-ronw"><?=lang('site_user_phone')?></th>
            <td class="tg-t4bo" colspan="2"><?=$this->session->userdata('site_lang')=='bangla'?BanglaConverter::en2bn($result->phone):BanglaConverter::bn2en($result->phone);?></td>
          </tr>
          <tr>
            <th class="tg-ronw"><?=lang('site_user_email')?></th>
            <td class="tg-t4bo" colspan="2"><?=$result->email?></td>
          </tr>
          <tr>
            <th class="tg-ronw"><?=lang('site_blood_group')?></th>
            <td class="tg-t4bo" colspan="2"><?=$result->$bg_name?></td>
          </tr>
          </tr>
          <tr>
            <th class="tg-ronw"><?=lang('site_issue_date')?></th>
            <td class="tg-t4bo" colspan="2"><?=$this->session->userdata('site_lang')=='bangla'?BanglaConverter::en2bn(date('d - m - Y', $result->created_on)):BanglaConverter::bn2en(date('d - m - Y', $result->created_on));?></td>
          </tr>
          <tr>
            <th class="tg-ronw"><?=lang('site_user_address')?></th>
            <td class="tg-t4bo" colspan="2"><?=$full_pre_add ?></td>
          </tr>
          <?php ///* ?>
          <tr>
            <th class="tg-ronw"><?=lang('site_expair_date')?></th>
            <td class="tg-t4bo" colspan="2">
            <?php
              if($result->expire_date != NULL){
                echo $expire_date = date('d M, Y', strtotime($result->expire_date));  
              }else{
                echo $expire_date = date('d M, Y', strtotime("31-12-2021"));  
              }
            ?>
              
            </td>
          </tr>
          <?php //*/ ?>

          </table>

          <?php }else{ ?>
          <p><?=lang('site_user_not_found')?></p>
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
        user_id: {
          required: true,
          number: false,
          minlength: 6,
          maxlength: 6
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