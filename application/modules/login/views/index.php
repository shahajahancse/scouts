<body class="error-body no-top" style="background: url(<?=base_url('awedget/assets/img/bg.jpg');?>) no-repeat center center fixed; -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
  <div class="container">
    <div class="row login-container login_register column-seperation">  
      <?php 
      $attributes = array('id' => 'login_validate');
      echo form_open("login/index", $attributes);
      ?>
      <div class="col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-4 box_reg"> 
        <img src="<?=base_url('fwedget/assets/images/scout_logo_small.png');?>" class="box_img img-responsive">
        <h4 class="box_title">Login to you account</h4>
        <div id="infoMessage"><?php echo $message;?></div>
        
        <div class="row">
          <div class="col-md-12" style="margin-top: 15px; margin-bottom: 10px;">
            <label>Email or Username or Scout ID</label>
            <?php echo form_error('identity')?>
            <div class="input-group">
              <span class="input-group-addon addonExtra"> <i class="fa fa-user" style="color:white;"></i> </span>
              <?=form_input($identity)?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12" style=" margin-bottom: 15px;">
            <label>Login Password</label>
            <?php echo form_error('password')?>
            <div class="input-group">
              <span class="input-group-addon addonExtra"><i class="fa fa-key" style="color:white;"></i></span>
              <?=form_password($password)?>
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon-eye toggle-password"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 hidden-sm hidden-xs">
            <div class="input-group">
              <div class="checkbox checkbox check-success pull-left">
                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                <label for="remember" style="color: black; font-weight: bold;">Remember Me</label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group">
              <?php echo form_submit('submitBtn', 'Login', "class='btn btn-primary btn-cons pull-right'"); ?>
            </div>
          </div>
        </div>

        <div class="row" style="margin-bottom: 0px;">
          <div class="col-md-6">
            <a href="<?=base_url('registration')?>" class="register">Register new account  </a>
          </div>
          <div class="col-md-6">
            <a href="<?=base_url('forgot-password')?>" class="forget"><?php echo lang('login_forgot_password');?></a>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12" style="margin-bottom: 0px;">
            <a href="<?=base_url()?>" class="public_service">Scout Portal (Public Corner)</a>
          </div>
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

    </form>
  </div>
</div>