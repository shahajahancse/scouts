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
                <a href="<?=base_url('acl')?>" class="btn btn-blueviolet btn-xs btn-mini"> All User List</a>  
              </div>
             </div>
             <div class="grid-body">
            <?php echo form_open(uri_string());?>
            <!-- <div><?php echo validation_errors(); ?></div> -->
              <div class="row form-row">
                <div class="col-md-12">
                  <label class="form-label">Full Name</label>
                  <?php echo form_error('full_name'); ?>
                  <input name="full_name" id="full_name" type="text" value="<?=set_value('full_name', $user->first_name)?>" class="form-control input-sm" placeholder="Full Name">
                </div>
              </div>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_phone_label', 'phone');?></label>
                  <?php echo form_error('phone'); ?>
                  <input name="phone" id="phone" type="text" value="<?=set_value('phone', $user->phone)?>" class="form-control input-sm" placeholder="Phone Number">
                </div>
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_email_label', 'email');?></label>
                  <?php echo form_error('email'); ?>
                  <input name="email" id="email" type="text" value="<?=set_value('email', $user->email)?>" class="form-control input-sm" placeholder="Email Address">
                </div>
              </div>


              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_password_label', 'password');?></label>
                  <?php echo form_error('password'); ?>
                  <input name="password" id="password" type="text" class="form-control input-sm" placeholder="Password">
                </div>
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label>
                  <?php echo form_error('password_confirm'); ?>
                  <input name="password_confirm" id="password_confirm" type="text" class="form-control input-sm" placeholder="Confirm Password">
                </div>
              </div>
            
            <?php if ($this->ion_auth->is_admin()): ?>
              <div class="row form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                    <h3><?php echo lang('edit_user_groups_heading');?></h3>
                    <?php foreach ($groups as $group):?>
                        <div style="color: black;">
                          <?php
                              $gID=$group['id'];
                              $checked = null;
                              $item = null;
                              foreach($currentGroups as $grp) {
                                  if ($gID == $grp->id) {
                                      $checked= ' checked="checked"';
                                  break;
                                  }
                              }
                          ?>
                         <label style="color: black;">
                            <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                            <!-- <input type="radio" name="groups[]" value="<?php echo $group['id'];?>" <?=$checked;?> >  -->
                             <?php echo htmlspecialchars($group['description'],ENT_QUOTES,'UTF-8');?> <br>
                          </label>
                        </div>
                    <?php endforeach?>
                    </div>
                  <?php endif; ?>

                  <?php echo form_hidden('id', $user->id);?>
                  <?php //echo form_hidden($csrf); ?>
                  </div>

                  <div class="col-md-6" style="color: black;">
                    <h3>Status</h3>
                    <?php echo form_error('active'); ?>
                    <input type="radio"  name="active" value="0" <?=set_value('active', $user->active)==0?'checked':'';?>> Inactive <br>
                    <input type="radio" name="active" value="1" <?=set_value('active', $user->active)==1?'checked':'';?>> Active/Verified <br>
                    <input type="radio" name="active" value="2" <?=set_value('active', $user->active)==2?'checked':'';?>> Disable <br>
                    <input type="radio" name="active" value="3" <?=set_value('active', $user->active)==3?'checked':'';?>> Postpond <br>
                    <input type="radio" name="active" value="4" <?=set_value('active', $user->active)==4?'checked':'';?>> Reject
                  </div>
                </div>

              <div class="form-actions">  
                <div class="pull-right">
                  <?php echo form_submit('submit', lang('edit_user_submit_btn'), "class='btn btn-primary btn-cons'"); ?>
                </div>
              </div>
            <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>
