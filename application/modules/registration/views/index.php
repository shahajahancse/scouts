<body class="error-body no-top" style="background: url(<?=base_url();?>awedget/assets/img/bg.jpg) no-repeat center center fixed; -webkit-background-size: cover;
 -moz-background-size: cover;
 -o-background-size: cover;
 background-size: cover;">
 <div class="container">
   <div class="row login-container login_register column-seperation">
      <?php
      $attributes = array('id' => 'registration_validate');
      echo form_open("registration", $attributes);
      ?>
      <style>
         .login_register .box_reg {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px !important;
         }
         .login_register .a2i {
            text-align: center;
            margin-top: 0px;
         }
         .login-container {
            margin: 10px auto 10px auto !important;
         }
         .require{
            color:red;
         }
      </style>
      <div class="col-md-7 col-sm-7 col-sm-offset-2 col-md-offset-2 box_reg">
         <img src="<?=base_url('fwedget/assets/images/scout_logo_small.png');?>" class="box_img img-responsive">
         <h4 class="box_title">Register new account</h4>

         <div class="row">
            <div class="col-md-6">
               <label>Full Name <span class="require">*</span></label>
               <div class="input-group">
                  <?php echo form_error('full_name')?>
                  <span class="input-group-addon addonExtra"> <i class="fa fa-user"></i> </span>
                  <?=form_input($full_name)?>
               </div>
            </div>

            <div class="col-md-6">
               <label> <span class="require">*</span></label>
               <?php echo form_error('day'); echo form_error('month'); echo form_error('year'); ?>
               <div class="input-group">
                  <?php echo form_dropdown('day', $days, set_value('day'), 'style="width:25%;"'); ?>
                  <?php echo form_dropdown('month', $months, set_value('month'), 'style="width:30%;"'); ?>
                  <?php echo form_dropdown('year', $years, set_value('year'), 'style="width:38%;"'); ?>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-6">
               <label class="form-label">Type <span class="require">*</span></label>
               <?php echo form_error('nid_dob_type'); ?>
               <input type="radio" class="type" name="nid_dob_type" value="1" <?=set_radio('nid_dob_type', '1', TRUE); ?>><span style="color: black; font-size: 15px;"> NID </span>
               <input type="radio" class="type" name="nid_dob_type" value="2" <?=set_radio('nid_dob_type', '2'); ?>><span style="color: black; font-size: 15px;"> Birth Registration No </span>
            </div>
            <div class="col-md-6">
               <label>NID/Birth Registration No <span class="require">*</span></label>
               <?php echo form_error('nid')?>
               <div class="input-group">
                  <span class="input-group-addon addonExtra"> <i class="fa fa-mobile"></i> </span>
                  <?=form_input($nid)?>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-6">
               <label>Login Email or Username <span class="require">*</span></label>
               <?php echo form_error('identity')?>
               <div class="input-group" >
                  <span class="input-group-addon addonExtra"> <i class="fa fa-user"></i> </span>
                  <?=form_input($identity)?>
               </div>
            </div>
            <div class="col-md-6">
               <label>Mobile Number <span class="require">*</span></label>
               <?php echo form_error('phone')?>
               <div class="input-group">
                  <span class="input-group-addon addonExtra"> <i class="fa fa-mobile"></i> </span>
                  <?=form_input($phone)?>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-6">
               <label>Login Password <span class="require">*</span></label>
               <?php echo form_error('password')?>
               <div class="input-group">
                  <span class="input-group-addon addonExtra"> <i class="fa fa-lock"></i> </span>
                  <?=form_password($password)?>
                  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon-eye toggle-password"></span>
               </div>
            </div>
            <div class="col-md-6">
               <label>Login Confirm Password <span class="require">*</span></label>
               <?php echo form_error('password_confirm')?>
               <div class="input-group">
                  <span class="input-group-addon addonExtra"> <i class="fa fa-lock"></i> </span>
                  <?=form_input($password_confirm)?>
                  <span toggle="#password-field-conf" class="fa fa-fw fa-eye field-icon-eye toggle-password-confirm"></span>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-8">
               <label>Gender <span class="require">*</span></label>
               <?php echo form_error('gender'); ?>
               <input type="radio" name="gender" value="Male" <?=set_radio('gender', 'Male', TRUE); ?> />
               <span style="color: black; font-size: 20px;">Male </span>
               <input type="radio" name="gender" value="Female" <?=set_radio('gender', 'Female'); ?> />
               <span style="color: black; font-size: 20px;">Female</span>
               <input type="radio" name="gender" value="Others" <?=set_radio('gender', 'Others'); ?> />
               <span style="color: black; font-size: 20px;">Others</span>
            </div>
            <div class="col-md-4">
               <label style="color:transparent">.</label>
               <?php echo form_submit('btn_submit', 'Submit', "class='btn btn-primary btn-cons pull-right'"); ?>
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="row">
            <div class="col-md-6" style="top: -10px;">
               <a href="<?=base_url('login')?>" class="label label-green" style="font-weight: bold; padding: 7px;">I have already an account</a>
            </div>
            <div class="col-md-6"></div>
         </div>

         <div class="clearfix"></div>
         <div class="a2i">
          <span style="text-decoration: underline;">সহযোগীতায়</span>

          <div class="row">
            <div class="col-md-6 text-left" style="font-size: 10px;">

              <a href="https://a2i.gov.bd/" target="_blank">
              <img src="<?php echo base_url('fwedget/assets/images/a2i_logo.png')?>" height="20" style="margin-top: 05px;"></a>
              <a href="https://ictd.gov.bd/" target="_blank">
              <img src="<?php echo base_url('fwedget/assets/images/logo_ict.png')?>" width="55" style="margin-top: 05px;"></a><br>
              <strong>এটুআই প্রোগ্রাম <br>তথ্য ও যোগাযোগ প্রযুক্তি বিভাগ</strong>
            </div>

            <div class="col-md-6 text-right" style="font-size: 10px;">
              <a href="http://www.scouts.gov.bd/" target="_blank">
              <img src="<?php echo base_url('fwedget/assets/images/bd_scout_logo.png')?>" height="20" style="margin-top: 05px;"></a><br>
              <strong>আইসিটি বিভাগ <br>বাংলাদেশ স্কাউটস</strong>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 text-center" style="font-size: 10px; margin-top: 10px;">
              <strong>Developed By |  <a href="http://mysoftheaven.com/" target="_blank">Mysoftheaven (BD) Ltd.</a></strong>
              <a href="http://mysoftheaven.com/" target="_blank"><img src="<?php echo base_url('fwedget/assets/images/mysoft-logo.png')?>" height="15"></a>
            </div>
          </div>
        </div>


     </div>
     <?php echo form_close();?>
  </div>
