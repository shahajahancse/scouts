<body class="error-body no-top" style="background: url(<?=base_url();?>awedget/assets/img/loginBG.png) center;">
<style type="text/css">
  .input-group{margin-bottom: 15px; width: 100%}
  label{font-weight: bold; color: #252627;}
  .addonExtra{border: 1px solid #5fbb78; background-color:#5fbb78; width: 40px;}
  .addonExtra i {color:white;}
</style>
<div class="container">
  <div class="row login-container column-seperation">  
      <!-- <form action="<?=base_url('registration')?>" method="post" autocomplete="on"> -->
      <?php echo form_open("registration");?>
         <div class="col-md-7 col-sm-7 col-sm-offset-2 col-md-offset-2" style="background-color: rgba(255,255,255,0.8); padding: 30px; "> 
            <img src="<?=base_url();?>awedget/assets/img/scouts-logo.gif" height="90" style="display: block; width: 90px; margin-left: auto;margin-right: auto; float: left; ">
            <h1 style="font-weight: bold; text-align: center; float: left; margin: 25px 0 0 10px;">Bangladesh Scouts</h1>
            <div class="clearfix"></div>
            <h4 style="text-align: center; font-weight: bold;">Register your account</h4>

            <div class="row">
               <div class="col-md-6">
                  <label>First Name</label>
                  <?php echo form_error('first_name')?>
                  <div class="input-group" >
                     <span class="input-group-addon addonExtra"> <i class="fa fa-user"></i> </span>
                     <input type="text" class="form-control" name="first_name" value="<?=set_value('first_name')?>" placeholder="First Name">   
                  </div>
               </div>
               
               <div class="col-md-6">
                  <label>Last Name</label>
                  <?php echo form_error('last_name')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"><i class="fa fa-user"></i></span>
                     <input type="text" class="form-control" name="last_name" value="<?=set_value('last_name')?>" placeholder="Last Name">
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-6">
                  <label>Date of Birth</label>
                  <?php echo form_error('dob')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"> <i class="fa fa-calendar"></i> </span>
                     <input type="text" class="form-control datetime" name="dob" value="<?=set_value('dob')?>" placeholder="Date of Birth" autocomplete="off">   
                  </div>
               </div>
               
               <div class="col-md-6">
                  <label>Mobile Number</label>
                  <?php echo form_error('phone')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"> <i class="fa fa-mobile"></i> </span>
                     <input type="text" class="form-control" name="phone" value="<?=set_value('phone')?>" placeholder="Mobile Number">   
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-6">
                  <label>Email Address</label>
                  <?php echo form_error('email')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"><i class="fa fa-envelope"></i></span>
                     <input type="text" class="form-control" name="email" value="<?=set_value('email')?>" placeholder="Email Address">
                  </div>
               </div>
               
               <div class="col-md-6">
                  <label>Request Scout's Section</label>
                  <?php echo form_error('req_group')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"><i class="fa fa-user"></i></span>
                     <?php echo form_dropdown('req_group', $scout_group, set_value('req_group'), 'style="width:100%;"'); ?>
                  </div>
               </div>
            </div>            

            <div class="row">
               <div class="col-md-6">
                  <label>Password</label>
                  <?php echo form_error('password')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"> <i class="fa fa-lock"></i> </span>
                     <input type="password" class="form-control" name="password" placeholder="Password">   
                  </div>
               </div>
               
               <div class="col-md-6">
                  <label>Repeat Password</label>
                  <?php echo form_error('password_confirm')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"><i class="fa fa-lock"></i></span>
                     <input type="password" class="form-control" name="password_confirm" placeholder="Confirm Password">
                  </div>
               </div>
            </div>
            
            <div style="margin-top:10px; margin-bottom: 30px;" class="form-group">
               <div class="controls">
                  <a href="<?=base_url('login')?>" class="pull-left" style="color: blue;">I have already an account</a>
                  <?php echo form_submit('submit', 'Submit', "class='btn btn-primary btn-cons pull-right'"); ?>
               </div>
            </div>

            <div class="clearfix"></div>

            <div style="text-align: center;">
                <span style="vertical-align: bottom;">কারিগরি সহায়তায়:</span> <img src="<?php echo base_url('awedget/assets/img/a2i-logo.png')?>">
            </div>

         </div>
      </form>
  </div>
</div>