<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('acl')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-8">
          <div class="grid simple horizontal red">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">
                <a href="<?=base_url('acl')?>" class="btn btn-primary btn-xs btn-mini"> User List</a>  
              </div>
             </div>
             <div class="grid-body">
              <?php echo form_open("acl/create_user");?>
              <!-- <form id="form_traditional_validation" action="#"> -->
              <div id="infoMessage"><?php echo $message;?></div>
              <div><?php echo validation_errors(); ?></div>
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">                      
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Full Name</label>
                  <?php echo form_error('full_name'); ?>
                  <?php echo form_input($full_name);?>
                </div>
                <div class="col-md-6">
                <?php if($identity_column!=='email') { ?>
                  <label class="form-label">Username or Email</label>
                  <?php echo form_error('identity'); ?>
                  <?php echo form_input($identity);?>
                <?php } ?>
                </div>
              </div>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_phone_label', 'phone');?></label>
                  <?php echo form_error('phone'); ?>
                  <?php echo form_input($phone);?>
                </div>
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_email_label', 'email');?></label>
                  <?php echo form_error('email'); ?>
                  <?php echo form_input($email);?>
                </div>
              </div>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_password_label', 'password');?></label>
                  <?php echo form_error('password'); ?>
                  <?php echo form_input($password);?>
                </div>
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label>
                  <?php echo form_error('password_confirm'); ?>
                  <?php echo form_input($password_confirm);?>
                </div>
              </div>

            <div class="form-actions">  
              <div class="pull-right">
                <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-cons'"); ?>
              </div>
            </div>
          <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>