<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; width: 100%; color: black;}
         .tg td{font-family:Arial, sans-serif;font-size:14px;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
         .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
         .tg .tg-71hr{background-color:#a7afaf; font-weight: bold;}
      </style>
<?php 
   $id = $info->id;
   $section_id = 1;
   $user_id = $this->session->userdata('user_id');
?>
      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('scouts_member/details/'.$id)?>" class="btn btn-success btn-xs btn-mini"> Scouts Member Details</a>  
                  </div>
               </div>

               <div class="grid-body">

                  <div class="row">
                     <div class="col-md-12">
                        <div class="tabbable tabs-left">
                           <ul class="nav nav-tabs" id="tab-2">
                              <li class="active"><a href="#tab_badge">কাব স্কাউটস ব্যাজ বিবরণ</a></li>
                              <li><a href="#tab_expartness">পারদর্শিতা ব্যাজ অর্জন</a></li>
                              <li><a href="#tab_achievement">দীক্ষা গ্রহণের তারিখ</a></li>
                              <li><a href="#tab_camp">ক্যাম্প রেকর্ড</a></li>
                              <li><a href="#tab_training">প্রশিক্ষণ রেকর্ড</a></li>
                              <li><a href="#tab_physical_health">দৈহিক ও স্বাস্থ্যগত রেকর্ড</a></li>
                              <li><a href="#tab_institute_promotion">বিদ্যালয়ের ক্রমোন্নতি তথ্য</a></li>
                              <li><a href="#tab_section_promotion">কাব স্কাউট পদোন্নতি</a></li>
                              <li><a href="#tab_resign">গ্রুপ ত্যাগ </a></li>
                           </ul>
                           <div class="tab-content">
                              <?php if($this->session->flashdata('success')):?>
                                 <div class="alert alert-success">
                                    <?=$this->session->flashdata('success');;?>
                                 </div>
                              <?php endif; ?>

                                 <div class="tab-pane active" id="tab_badge">                                 
                                    <div class="row ">
                                       <div class="col-md-12">
                                       <h5><span class="semi-bold">কাব স্কাউটস ব্যাজ বিবরণ</span></h5>
                                          <?php 
                                          $attributes = array('id' => 'cub_program_badge');
                                          echo form_open("", $attributes);?>
                                          <div class="row form-row">
                                             <div class="col-md-3">
                                                <label class="form-label">ব্যাজ</label>
                                                <?php echo form_error('badge_id');
                                                $more_attr = 'class="form-control input-sm" id="scout_badge"';
                                                echo form_dropdown('badge_id', $badges, set_value('badge_id'), $more_attr);
                                                ?>
                                             </div>
                                             <div class="col-md-4">
                                                <label class="form-label">বিবরণ</label>
                                                <?php echo form_error('question_id'); ?>
                                                <select name="question_id" id="question_id" class="badge_question_val form-control input-sm">
                                                   <option value="">-- Select One --</option>
                                                </select>
                                             </div>
                                             <div class="col-md-3">  
                                                <label class="form-label">মান অর্জনের তারিখ</label>
                                                <?php echo form_error('achive_date'); ?>
                                                <input type="text" name="achive_date" id="achive_date" class="form-control input-sm datetime" value="<?=set_value('achive_date')?>" placeholder="YYYY-MM-DD">
                                             </div>
                                             <div class="col-md-2">  
                                                <label class="form-label">&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-mini mini-btn-padding">Save</button>
                                             </div>
                                          </div>
                                          <input type="hidden" name="hide_id" id="hide_id">
                                          <input type="hidden" name="hide_section_id" id="hide_section_id" value="<?=$section_id?>">
                                          <input type="hidden" name="hide_user_id" id="hide_user_id" value="<?=$user_id?>">
                                          <?php echo form_close();?>

                                          <div class="row">
                                             <div class="col-md-12">
                                               
                                                   <h5><span class="semi-bold">কাব স্কাউট ব্যাজ অর্জনের বিবরণ</span></h5>
                                             
                                                	<span id="printbadgh"></span>
												
                                             </div>   
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="tab-pane" id="tab_expartness">
                                    <div class="row ">
                                       <div class="col-md-12">
                                       <h5><span class="semi-bold">পারদর্শিতা ব্যাজ অর্জন</span></h5>
                                          <?php 
                                          $attributes = array('id' => 'cub_program_badge_expertness');
                                          echo form_open("", $attributes);?>
                                          <div class="row form-row">
                                             <div class="col-md-3">
                                                <label class="form-label">ব্যাজ</label>
                                                <?php echo form_error('badge_id');
                                                $more_attr = 'class="form-control input-sm" id="ex_scout_badge"';
                                                echo form_dropdown('badge_id', $badges, set_value('badge_id'), $more_attr);
                                                ?>
                                             </div>
                                             <div class="col-md-3">
                                                <label class="form-label">গ্রুপ</label>
                                                <?php echo form_error('expert_group_id'); ?>
                                                <select name="expert_group_id" id="expert_group_id" class="expert_group_val form-control input-sm">
                                                   <option value="">-- Select One --</option>
                                                </select>
                                             </div>
                                             <div class="col-md-2">  
                                                <label class="form-label">তারিখ</label>
                                                <?php echo form_error('achive_date'); ?>
                                                <input type="text" name="achive_date" id="ex_achive_date" class="form-control input-sm datetime" value="<?=set_value('achive_date')?>" placeholder="YYYY-MM-DD">
                                             </div>
                                             <div class="col-md-2">
                                               <label class="form-label">অতিরিক্ত ব্যাজ</label>
                                               <?php echo form_error('extra_badge'); ?>
                                               <select name="extra_badge" id="extra_badge" class="form-control input-sm">
                                                   <option value="No">No</option>
                                                   <option value="Yes">Yes</option>
                                                </select>
                                            </div>
                                             <div class="col-md-2">  
                                                <label class="form-label">&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-mini mini-btn-padding">Save</button>
                                             </div>
                                          </div>
                                          <input type="hidden" name="hide_id" id="ex_hide_id">
                                          <input type="hidden" name="hide_section_id" id="ex_hide_section_id" value="<?=$section_id?>">
                                          <input type="hidden" name="hide_user_id" id="ex_hide_user_id" value="<?=$user_id?>">
                                          <?php echo form_close();?>

                                          <div class="row">
                                             <div class="col-md-12">
                                                
                                                   <h5><span class="semi-bold">পারদর্শিতা ব্যাজ অর্জনের বিবরণ</span></h5>

                                                   <span id="printbadge_expertness"></span>
                                       
                                                </div>   
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="tab-pane" id="tab_achievement">
                                    
                                    <div class="row ">
                                       <div class="col-md-12">
                                       <h5><span class="semi-bold">দীক্ষা গ্রহণের তারিখ </span></h5>
                                          <?php 
                                          $attributes = array('id' => 'cub_program_badge_achievemen');
                                          echo form_open("", $attributes);?>
                                          <div class="row form-row">
                                             <div class="col-md-6">
                                                <label class="form-label">ব্যাজ</label>
                                                <?php echo form_error('badge_id');
                                                $more_attr = 'class="form-control input-sm" id="achiev_scout_badge"';
                                                echo form_dropdown('badge_id', $badges, set_value('badge_id'), $more_attr);
                                                ?>
                                             </div>
                                             
                                             <div class="col-md-4">  
                                                <label class="form-label">গ্রহণের তারিখ</label>
                                                <?php echo form_error('achive_date'); ?>
                                                <input type="text" name="achive_date" id="achiev_achive_date" class="form-control input-sm datetime" value="<?=set_value('achive_date')?>" placeholder="YYYY-MM-DD">
                                             </div>
                                             
                                             <div class="col-md-2">  
                                                <label class="form-label">&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-mini mini-btn-padding">Save</button>
                                             </div>
                                          </div>
                                          <input type="hidden" name="hide_id" id="achiev_hide_id">
                                          <input type="hidden" name="hide_section_id" id="achiev_hide_section_id" value="<?=$section_id?>">
                                          <input type="hidden" name="hide_user_id" id="achiev_hide_user_id" value="<?=$user_id?>">
                                          <?php echo form_close();?>

                                          <div class="row">
                                             <div class="col-md-12">
                                                
                                                   <h5><span class="semi-bold">দীক্ষা গ্রহণের তারিখ ও
                                                    বিবরণ</span></h5>

                                                   <span id="printbadge_achievemen"></span>
                                       
                                                </div>   
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="tab-pane" id="tab_camp">
                                    <div class="row ">
                                       <div class="col-md-12">
                                       <h5><span class="semi-bold">ক্যাম্প রেকর্ড </span></h5>
                                          <?php 
                                          $attributes = array('id' => 'cub_program_badge_camping');
                                          echo form_open("", $attributes);?>
                                          <div class="row form-row">
                                             <div class="col-md-3">
                                                <label class="form-label">ব্যাজ</label>
                                                <?php echo form_error('badge_id');
                                                $more_attr = 'class="form-control input-sm" id="camp_scout_badge"';
                                                echo form_dropdown('badge_id', $badges, set_value('badge_id'), $more_attr);
                                                ?>
                                             </div>
                                             
                                             <div class="col-md-3">  
                                                <label class="form-label">ক্যাম্প তারিখ</label>
                                                <?php echo form_error('camp_date'); ?>
                                                <input type="text" name="camp_date" id="camp_achive_date" class="form-control input-sm datetime" value="<?=set_value('achive_date')?>" placeholder="YYYY-MM-DD">
                                             </div>

                                             <div class="col-md-3">  
                                                
                                             </div>
                                          </div>
                                          <div class="row form-row">
                                            
                                             <div class="col-md-6">
                                                <label class="form-label">ক্যাম্পের নাম</label>
                                                <?php echo form_error('camp_name'); ?>
                                                <input type="text" name="camp_name" id="camp_name" class="form-control input-sm" value="<?=set_value('camp_name')?>" placeholder="">
                                             </div>
                                             
                                             <div class="col-md-3">  
                                                <label class="form-label">সনদ নং</label>
                                                <?php echo form_error('camp_certificate_no'); ?>
                                                <input type="text" name="camp_certificate_no" id="camp_certificate_no" class="form-control input-sm " value="<?=set_value('camp_certificate_no')?>" placeholder="">
                                             </div>
                                             
                                             <div class="col-md-2">  
                                                <label class="form-label">&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-mini mini-btn-padding">Save</button>
                                             </div>
                                          </div>
                                          <input type="hidden" name="hide_id" id="camp_hide_id">
                                          <input type="hidden" name="hide_section_id" id="camp_hide_section_id" value="<?=$section_id?>">
                                          <input type="hidden" name="hide_user_id" id="camp_hide_user_id" value="<?=$user_id?>">
                                          <?php echo form_close();?>

                                          <div class="row">
                                             <div class="col-md-12">
                                                
                                                   <h5><span class="semi-bold">ক্যাম্প রেকর্ডের
                                                    বিবরণ</span></h5>

                                                   <span id="printbadge_camping"></span>
                                       
                                                </div>   
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="tab-pane" id="tab_training">
                                    
                                    <div class="row ">
                                       <div class="col-md-12">
                                       <h5><span class="semi-bold">প্রশিক্ষণ রেকর্ড </span></h5>
                                          <?php 
                                          $attributes = array('id' => 'cub_program_badge_training');
                                          echo form_open("", $attributes);?>
                                          <div class="row form-row">
                                             <div class="col-md-3">
                                                <label class="form-label">ব্যাজ</label>
                                                <?php echo form_error('badge_id');
                                                $more_attr = 'class="form-control input-sm" id="train_scout_badge"';
                                                echo form_dropdown('badge_id', $badges, set_value('badge_id'), $more_attr);
                                                ?>
                                             </div>
                                             
                                             <div class="col-md-3">  
                                                <label class="form-label">প্রশিক্ষণের তারিখ</label>
                                                <?php echo form_error('train_date'); ?>
                                                <input type="text" name="train_date" id="train_achive_date" class="form-control input-sm datetime" value="<?=set_value('achive_date')?>" placeholder="YYYY-MM-DD">
                                             </div>
                                          </div>
                                          <div class="row form-row">
                                            
                                             <div class="col-md-6">
                                                <label class="form-label">প্রশিক্ষণের  নাম</label>
                                                <?php echo form_error('train_name'); ?>
                                                <input type="text" name="train_name" id="train_name" class="form-control input-sm" value="<?=set_value('train_name')?>" placeholder="">
                                             </div>
                                             
                                             <div class="col-md-3">  
                                                <label class="form-label">সনদ নং</label>
                                                <?php echo form_error('train_certificate_no'); ?>
                                                <input type="text" name="train_certificate_no" id="train_certificate_no" class="form-control input-sm " value="<?=set_value('train_certificate_no')?>" placeholder="">
                                             </div>
                                             
                                             <div class="col-md-2">  
                                                <label class="form-label">&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-mini mini-btn-padding">Save</button>
                                             </div>
                                          </div>
                                          <input type="hidden" name="hide_id" id="train_hide_id">
                                          <input type="hidden" name="hide_section_id" id="train_hide_section_id" value="<?=$section_id?>">
                                          <input type="hidden" name="hide_user_id" id="train_hide_user_id" value="<?=$user_id?>">
                                          <?php echo form_close();?>

                                          <div class="row">
                                             <div class="col-md-12">
                                                
                                                   <h5><span class="semi-bold">প্রশিক্ষণ  রেকর্ডের
                                                    বিবরণ</span></h5>

                                                   <span id="printbadge_training"></span>
                                       
                                                </div>   
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="tab-pane" id="tab_physical_health">
                                    <div class="row ">
                                       <div class="col-md-12">
                                       <h5><span class="semi-bold">দৈহিক ও স্বাস্থ্যগত রেকর্ড</span></h5>
                                          <?php 
                                          $attributes = array('id' => 'cub_program_badge_health');
                                          echo form_open("", $attributes);?>
                                          <div class="row form-row">
                                             <div class="col-md-3">
                                                <label class="form-label">বর্ষ</label>
                                                <?php echo form_error('health_years');
                                                $more_attr = 'class="form-control input-sm" id="health_years"';
                                                echo form_dropdown('health_years', $years, set_value('health_years'), $more_attr);
                                                ?>
                                             </div>
                                             
                                             <div class="col-md-3">  
                                                <label class="form-label">উচ্চতা</label>
                                                <?php echo form_error('health_height'); ?>
                                                <input type="text" name="health_height" id="health_height" class="form-control input-sm" value="<?=set_value('health_height')?>" placeholder="">
                                             </div>

                                             <div class="col-md-3">  
                                                <label class="form-label">ওজন</label>
                                                <?php echo form_error('health_weight'); ?>
                                                <input type="text" name="health_weight" id="health_weight" class="form-control input-sm" value="<?=set_value('health_weight')?>" placeholder="">
                                             </div>

                                             <div class="col-md-3">  
                                                <label class="form-label">বুকের মাপ</label>
                                                <?php echo form_error('health_chest_size'); ?>
                                                <input type="text" name="health_chest_size" id="health_chest_size" class="form-control input-sm" value="<?=set_value('health_chest_size')?>" placeholder="">
                                             </div>

                                          </div>
                                          <div class="row form-row">
                                            
                                             <div class="col-md-3">
                                                <label class="form-label">বিঘত</label>
                                                <?php echo form_error('health_span'); ?>
                                                <input type="text" name="health_span" id="health_span" class="form-control input-sm" value="<?=set_value('health_span')?>" placeholder="">
                                             </div>
                                             
                                             <div class="col-md-3">  
                                                <label class="form-label">হাতের মাপ</label>
                                                <?php echo form_error('health_hand_size'); ?>
                                                <input type="text" name="health_hand_size" id="health_hand_size" class="form-control input-sm " value="<?=set_value('health_hand_size')?>" placeholder="">
                                             </div>

                                             <div class="col-md-3">  
                                                <label class="form-label">হৃদ স্পন্দন</label>
                                                <?php echo form_error('health_heartbeat'); ?>
                                                <input type="text" name="health_heartbeat" id="health_heartbeat" class="form-control input-sm " value="<?=set_value('health_heartbeat')?>" placeholder="">
                                             </div>

                                             <div class="col-md-2">  
                                                <label class="form-label">তাপমাত্রা</label>
                                                <?php echo form_error('health_temperature'); ?>
                                                <input type="text" name="health_temperature" id="health_temperature" class="form-control input-sm " value="<?=set_value('health_temperature')?>" placeholder="">
                                             </div>
                                             
                                             <div class="col-md-1">  
                                                <label class="form-label">&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-mini mini-btn-padding">Save</button>
                                             </div>
                                          </div>
                                          <input type="hidden" name="hide_id" id="health_hide_id">
                                          <input type="hidden" name="hide_section_id" id="health_hide_section_id" value="<?=$section_id?>">
                                          <input type="hidden" name="hide_user_id" id="health_hide_user_id" value="<?=$user_id?>">
                                          <?php echo form_close();?>

                                          <div class="row">
                                             <div class="col-md-12">
                                                
                                                   <h5><span class="semi-bold">দৈহিক ও স্বাস্থ্যগত রেকর্ডের
                                                    বিবরণ</span></h5>

                                                   <span id="printbadge_health"></span>
                                       
                                                </div>   
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="tab-pane" id="tab_institute_promotion">
                                    <div class="row ">
                                       <div class="col-md-12">
                                       <h5><span class="semi-bold">বিদ্যালয়ের ক্রমোন্নতি তথ্য</span></h5>
                                          <?php 
                                          $attributes = array('id' => 'cub_program_badge_institute');
                                          echo form_open("", $attributes);?>
                                          <div class="row form-row">
                                             <div class="col-md-3">
                                                <label class="form-label">বর্ষ</label>
                                                <?php echo form_error('institute_years');
                                                $more_attr = 'class="form-control input-sm" id="institute_years"';
                                                echo form_dropdown('institute_years', $years, set_value('institute_years'), $more_attr);
                                                ?>
                                             </div>
                                             
                                             <div class="col-md-3">  
                                                <label class="form-label">শ্রেণী</label>
                                                <?php echo form_error('institute_class_name'); ?>
                                                <input type="text" name="institute_class_name" id="institute_class_name" class="form-control input-sm" value="<?=set_value('institute_class_name')?>" placeholder="">
                                             </div>

                                             <div class="col-md-3">  
                                                <label class="form-label">রোল নং</label>
                                                <?php echo form_error('institute_roll_no'); ?>
                                                <input type="text" name="institute_roll_no" id="institute_roll_no" class="form-control input-sm" value="<?=set_value('institute_roll_no')?>" placeholder="">
                                             </div>

                                             <div class="col-md-2">  
                                                <label class="form-label">প্রাপ্ত নম্বর</label>
                                                <?php echo form_error('institute_total_unmber'); ?>
                                                <input type="text" name="institute_total_unmber" id="institute_total_unmber" class="form-control input-sm" value="<?=set_value('institute_total_unmber')?>" placeholder="">
                                             </div>

                                             <div class="col-md-1">  
                                                <label class="form-label">&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-mini mini-btn-padding">Save</button>
                                             </div>

                                          </div>
                                          
                                          <input type="hidden" name="hide_id" id="institute_hide_id">
                                          <input type="hidden" name="hide_section_id" id="institute_hide_section_id" value="<?=$section_id?>">
                                          <input type="hidden" name="hide_user_id" id="institute_hide_user_id" value="<?=$user_id?>">
                                          <?php echo form_close();?>

                                          <div class="row">
                                             <div class="col-md-12">
                                                
                                                   <h5><span class="semi-bold">বিদ্যালয়ের ক্রমোন্নতি তথ্য বিবরণ</span></h5>

                                                   <span id="printbadge_institute"></span>
                                       
                                                </div>   
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="tab-pane" id="tab_section_promotion">
                                    <div class="row ">
                                       <div class="col-md-12">
                                       <h5><span class="semi-bold">কাব স্কাউট পদোন্নতি </span></h5>
                                          <?php 
                                          $attributes = array('id' => 'cub_program_badge_promotion');
                                          echo form_open("", $attributes);?>
                                          <div class="row form-row">
                                             <div class="col-md-4">
                                                <label class="form-label">ব্যাজ</label>
                                                <?php echo form_error('badge_id');
                                                $more_attr = 'class="form-control input-sm" id="promotion_scout_badge"';
                                                echo form_dropdown('badge_id', $badges, set_value('badge_id'), $more_attr);
                                                ?>
                                             </div>

                                             <div class="col-md-4">
                                                <label class="form-label">রোল</label>
                                                <?php echo form_error('role_id');
                                                $more_attr = 'class="form-control input-sm" id="promotion_scout_role"';
                                                echo form_dropdown('role_id', $roles, set_value('role_id'), $more_attr);
                                                ?>
                                             </div>
                                             
                                          </div>
                                          <div class="row form-row">
                                            
                                             <div class="col-md-4">  
                                                <label class="form-label">পদোন্নতির শুরুর তারিখ</label>
                                                <?php echo form_error('promotion_form_date'); ?>
                                                <input type="text" name="promotion_from_date" id="promotion_from_date" class="form-control input-sm datetime" value="<?=set_value('promotion_from_date')?>" placeholder="YYYY-MM-DD">
                                             </div>
                                             
                                             <div class="col-md-4">  
                                                <label class="form-label">পদোন্নতির শেষ তারিখ</label>
                                                <?php echo form_error('promotion_to_date'); ?>
                                                <input type="text" name="promotion_to_date" id="promotion_to_date" class="form-control input-sm datetime" value="<?=set_value('promotion_to_date')?>" placeholder="YYYY-MM-DD">
                                             </div>
                                             
                                             <div class="col-md-2">  
                                                <label class="form-label">&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-mini mini-btn-padding">Save</button>
                                             </div>
                                          </div>
                                          <input type="hidden" name="hide_id" id="promotion_hide_id">
                                          <input type="hidden" name="hide_section_id" id="promotion_hide_section_id" value="<?=$section_id?>">
                                          <input type="hidden" name="hide_user_id" id="promotion_hide_user_id" value="<?=$user_id?>">
                                          <?php echo form_close();?>

                                          <div class="row">
                                             <div class="col-md-12">
                                                
                                                   <h5><span class="semi-bold">কাব স্কাউট পদোন্নতির
                                                    বিবরণ</span></h5>

                                                   <span id="printbadge_promotion"></span>
                                       
                                                </div>   
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="tab-pane" id="tab_resign">
                                    
                                    <div class="row ">
                                       <div class="col-md-12">
                                       <h5><span class="semi-bold">গ্রুপ ত্যাগ </span></h5>
                                          <?php 
                                          $attributes = array('id' => 'cub_program_badge_resign');
                                          echo form_open("", $attributes);?>
                                          
                                          <div class="row form-row">
                                             <div class="col-md-5">  
                                                <label class="form-label">গ্রুপ ত্যাগের তারিখ</label>
                                                <?php echo form_error('resign_date'); ?>
                                                <input type="text" name="resign_date" id="resign_date" class="form-control input-sm datetime" value="<?=set_value('resign_date')?>" placeholder="YYYY-MM-DD">
                                             </div>
                                            
                                             <div class="col-md-5">
                                                <label class="form-label">গ্রুপ ত্যাগের কারণ</label>
                                                <?php echo form_error('resign_reason'); ?>
                                                <input type="text" name="resign_reason" id="resign_reason" class="form-control input-sm" value="<?=set_value('resign_reason')?>" placeholder="">
                                             </div>
                                             
                                             <div class="col-md-2">  
                                                <label class="form-label">&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-mini mini-btn-padding">Save</button>
                                             </div>
                                          </div>
                                          <input type="hidden" name="hide_id" id="resign_hide_id">
                                          <input type="hidden" name="hide_section_id" id="resign_hide_section_id" value="<?=$section_id?>">
                                          <input type="hidden" name="hide_user_id" id="resign_hide_user_id" value="<?=$user_id?>">
                                          <?php echo form_close();?>

                                          <div class="row">
                                             <div class="col-md-12">
                                                
                                                   <h5><span class="semi-bold">গ্রুপ ত্যাগের
                                                    বিবরণ</span></h5>

                                                   <span id="printbadge_resign"></span>
                                       
                                                </div>   
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                              </div>
                           </div>
                        </div>
                     </div>

                  </div>  <!-- END GRID BODY -->              
               </div> <!-- END GRID -->
            </div>

         </div> <!-- END ROW -->
      </div>
   </div>

<script type="text/javascript">
   $(document).ready(function() {
	   	
	  get_scout_badge_det();
     get_scout_badge_expertness();
     get_scout_badge_achievemen();
     get_scout_badge_camping();
     get_scout_badge_training();
     get_scout_badge_resign();
     get_scout_badge_promotion();
     get_scout_badge_health();
     get_scout_badge_institute();
	  
   $('#cub_program_badge').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         badge_id: {
            required: true
         },
         question_id: {
            required: true
         },
         achive_date: {
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
         //form.submit();
		 get_scout_badge_det();
      }
   });

   $('#cub_program_badge_expertness').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         badge_id: {
            required: true
         },
         expert_group_id: {
            required: true
         },
         achive_date: {
            required: true
         },
          extra_badge:{
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
         //form.submit();
       get_scout_badge_expertness();
      }
   });

   $('#cub_program_badge_achievemen').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         badge_id: {
            required: true
         },
         achive_date: {
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
         //form.submit();
       get_scout_badge_achievemen();
      }
   });

   $('#cub_program_badge_camping').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         badge_id: {
            required: true
         },
         camp_date: {
            required: true
         },
         camp_name: {
            required: true
         },
         camp_certificate_no: {
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
         //form.submit();
       get_scout_badge_camping();
      }
   });

   $('#cub_program_badge_training').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            badge_id: {
               required: true
            },
            train_date: {
               required: true
            },
            train_name: {
               required: true
            },
            train_certificate_no: {
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
            //form.submit();
          get_scout_badge_training();
         }
   });

   $('#cub_program_badge_health').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            health_years: {
               required: true
            },
            health_height: {
               required: true
            },
            health_weight: {
               required: true
            },
            health_span: {
               required: true
            },
            health_hand_size: {
               required: true
            },
            health_temperature: {
               required: true
            },
            health_heartbeat: {
               required: true
            },
            health_chest_size: {
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
            //form.submit();
          get_scout_badge_health();
         }
   });

   $('#cub_program_badge_institute').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            institute_years: {
               required: true
            },
            institute_class_name: {
               required: true
            },
            institute_roll_no: {
               required: true
            },
            institute_total_unmber: {
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
            //form.submit();
          get_scout_badge_institute();
         }
   });

   $('#cub_program_badge_promotion').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            badge_id: {
               required: true
            },
            role_id: {
               required: true
            },
            promotion_from_date: {
               required: true
            },
            promotion_to_date: {
               required: false
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
            //form.submit();
          get_scout_badge_promotion();
         }
   });

   $('#cub_program_badge_resign').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            
            resign_date: {
               required: true
            },
            resign_reason: {
               required: true
            },
            
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
            //form.submit();
          get_scout_badge_resign();
         }
   });

   
   });  

   // scout badge 
   function get_scout_badge_det(){
	   $.ajax({			 
			  method: "GET",
			  url: "<?=base_url('scouts_member/cub_program_badge/'.$id)?>",
			  data: { scout_badge: $("#scout_badge").val(), question_id: $("#question_id").val(), achive_date: $("#achive_date").val(), section_id: $("#hide_section_id").val(), hide_id: $("#hide_id").val(), hide_user_id: $("#hide_user_id").val() }
			  
			})
			  .done(function( msg ) {
				detailsarr=msg.split('23432sdfg324');
				if(detailsarr[0]=='duplicate')
				{
					alert('Duplicate')
				}
				if(detailsarr[1]!='')
				{
					$('#printbadgh').html(detailsarr[1]);
				}
				
				if($("#hide_id").val()>0)
				{
					$("#scout_badge").prop("disabled", false);
					$("#question_id").prop("disabled", false);
					
					$("#achive_date").val('');
					$("#hide_id").val('');
					$("#scout_badge").val('');
					$("#question_id").val('');
				}
				
		  }); 
   }

   function delete_scoutprogram(delid){
	   if(confirm('Are you sure you want to delete this data?'))
	   {
			$.ajax({			 
				  method: "GET",
				  url: "<?=base_url('scouts_member/cub_program_badge/'.$id)?>",
				  data: { delete_id: delid, scout_badge: $("#scout_badge").val(), question_id: $("#question_id").val(), achive_date: $("#achive_date").val(), section_id: $("#hide_section_id").val(), hide_id: $("#hide_id").val(), hide_user_id: $("#hide_user_id").val() }
				})
				  .done(function( msg ) {
					detailsarr=msg.split('23432sdfg324');
					if(detailsarr[0]=='duplicate')
					{
						alert('Duplicate')
					}
					if(detailsarr[1]!='')
					{
						$('#printbadgh').html(detailsarr[1]);
					}
					
			  }); 
	   }
   }

   function edit_scoutprogram(delid, datefield,badgeid,qid){
	   $("#achive_date").val(datefield);
	   $("#hide_id").val(delid);
	   $("#scout_badge").val(badgeid);
	   
	   scout_badge_details_select(qid);
	   
	   $("#scout_badge").prop("disabled", false);
	   $("#question_id").prop("disabled", false);
   }

   // expertness 

   function get_scout_badge_expertness()
   {
      $.ajax({        
           method: "GET",
           url: "<?=base_url('scouts_member/cub_program_badge_expertness/'.$id)?>",
           data: { scout_badge: $("#ex_scout_badge").val(), expert_group_id: $("#expert_group_id").val(), achive_date: $("#ex_achive_date").val(), extra_badge: $("#extra_badge").val(), section_id: $("#ex_hide_section_id").val(), hide_id: $("#ex_hide_id").val(), hide_user_id: $("#ex_hide_user_id").val() }
           
         })
           .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_expertness').html(detailsarr[1]);
            }
            
            if($("#ex_hide_id").val()>0)
            {
               $("#ex_scout_badge").prop("disabled", false);
               $("#expert_group_id").prop("disabled", false);
               
               $("#ex_achive_date").val('');
               $("#ex_hide_id").val('');
               $("#ex_scout_badge").val('');
               $("#extra_badge").val('');
               $("#expert_group_id").val('');
            }
            
           }); 
   }
   function delete_scoutprogram_expertness(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
              method: "GET",
              url: "<?=base_url('scouts_member/cub_program_badge_expertness/'.$id)?>",
              data: { delete_id: delid, scout_badge: $("#ex_scout_badge").val(), expert_group_id: $("#expert_group_id").val(), achive_date: $("#ex_achive_date").val(), extra_badge: $("#extra_badge").val(), section_id: $("#ex_hide_section_id").val(), hide_id: $("#ex_hide_id").val(), hide_user_id: $("#ex_hide_user_id").val() }
            })
              .done(function( msg ) {
               detailsarr=msg.split('23432sdfg324');
               if(detailsarr[0]=='duplicate')
               {
                  alert('Duplicate')
               }
               if(detailsarr[1]!='')
               {
                  $('#printbadge_expertness').html(detailsarr[1]);
               }
               
              }); 
      }
   }
   function edit_scoutprogram__expertness(delid, datefield,badgeid,qid, ex_badge)
   {
      $("#ex_achive_date").val(datefield);
      $("#ex_hide_id").val(delid);
      $("#ex_scout_badge").val(badgeid);
      $("#extra_badge").val(ex_badge);
     // $("#question_id").val(qid)
      
      scout_badge_expert_group_select(qid);
      
      $("#ex_scout_badge").prop("disabled", false);
      $("#expert_group_id").prop("disabled", false);
   }

   // achievemen 

   function get_scout_badge_achievemen()
   {
      $.ajax({        
           method: "GET",
           url: "<?=base_url('scouts_member/cub_program_badge_achievemen/'.$id)?>",
           data: { scout_badge: $("#achiev_scout_badge").val(),  achive_date: $("#achiev_achive_date").val(), section_id: $("#achiev_hide_section_id").val(), hide_id: $("#achiev_hide_id").val(), hide_user_id: $("#achiev_hide_user_id").val() }
           
         })
           .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_achievemen').html(detailsarr[1]);
            }
            
            if($("#achiev_hide_id").val()>0)
            {
               $("#achiev_scout_badge").prop("disabled", false);
               
               $("#achiev_achive_date").val('');
               $("#achiev_hide_id").val('');
               $("#achiev_scout_badge").val('');
            }
            
           }); 
   }
   function delete_scoutprogram_achievemen(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
              method: "GET",
              url: "<?=base_url('scouts_member/cub_program_badge_achievemen/'.$id)?>",
              data: { delete_id: delid, scout_badge: $("#achiev_scout_badge").val(), achive_date: $("#achiev_achive_date").val(), section_id: $("#achiev_hide_section_id").val(), hide_id: $("#achiev_hide_id").val(), hide_user_id: $("#achiev_hide_user_id").val() }
            })
              .done(function( msg ) {
               detailsarr=msg.split('23432sdfg324');
               if(detailsarr[0]=='duplicate')
               {
                  alert('Duplicate')
               }
               if(detailsarr[1]!='')
               {
                  $('#printbadge_achievemen').html(detailsarr[1]);
               }
               
              }); 
      }
   }
   function edit_scoutprogram_achievemen(delid, datefield,badgeid)
   {
      $("#achiev_achive_date").val(datefield);
      $("#achiev_hide_id").val(delid);
      $("#achiev_scout_badge").val(badgeid);
      
      $("#achiev_scout_badge").prop("disabled", false);
   }

   // Camping 

   function get_scout_badge_camping()
   {
      $.ajax({        
           method: "GET",
           url: "<?=base_url('scouts_member/cub_program_badge_camping/'.$id)?>",
           data: { scout_badge: $("#camp_scout_badge").val(),  achive_date: $("#camp_achive_date").val(),camp_name: $("#camp_name").val(), camp_certificate_no: $("#camp_certificate_no").val(), section_id: $("#camp_hide_section_id").val(), hide_id: $("#camp_hide_id").val(), hide_user_id: $("#camp_hide_user_id").val() }
           
         })
           .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_camping').html(detailsarr[1]);
            }
            
            if($("#camp_hide_id").val()>0)
            {
               $("#camp_scout_badge").prop("disabled", false);
               
               $("#camp_achive_date").val('');
               $("#camp_hide_id").val('');
               $("#camp_scout_badge").val('');
               $("#camp_name").val('');
               $("#camp_certificate_no").val('');
            }
            
           }); 
   }
   function delete_scoutprogram_camping(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
              method: "GET",
              url: "<?=base_url('scouts_member/cub_program_badge_camping/'.$id)?>",
              data: { delete_id: delid, scout_badge: $("#camp_scout_badge").val(), achive_date: $("#camp_achive_date").val(), section_id: $("#camp_hide_section_id").val(), camp_name: $("#camp_name").val(), camp_certificate_no: $("#camp_certificate_no").val(), hide_id: $("#camp_hide_id").val(), hide_user_id: $("#camp_hide_user_id").val() }
            })
              .done(function( msg ) {
               detailsarr=msg.split('23432sdfg324');
               if(detailsarr[0]=='duplicate')
               {
                  alert('Duplicate')
               }
               if(detailsarr[1]!='')
               {
                  $('#printbadge_camping').html(detailsarr[1]);
               }
               
              }); 
      }
   }
   function edit_scoutprogram_camping(delid, datefield,badgeid, camp_name, camp_certificate_no)
   {
      $("#camp_achive_date").val(datefield);
      $("#camp_hide_id").val(delid);
      $("#camp_scout_badge").val(badgeid);
      $("#camp_name").val(camp_name);
      $("#camp_certificate_no").val(camp_certificate_no);
      
      $("#camp_scout_badge").prop("disabled", false);
   }

   // Training 

   function get_scout_badge_training()
   {
      $.ajax({        
           method: "GET",
           url: "<?=base_url('scouts_member/cub_program_badge_training/'.$id)?>",
           data: { scout_badge: $("#train_scout_badge").val(),  achive_date: $("#train_achive_date").val(),train_name: $("#train_name").val(), train_certificate_no: $("#train_certificate_no").val(), section_id: $("#train_hide_section_id").val(), hide_id: $("#train_hide_id").val(), hide_user_id: $("#train_hide_user_id").val() }
           
         })
           .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_training').html(detailsarr[1]);
            }
            
            if($("#train_hide_id").val()>0)
            {
               $("#train_scout_badge").prop("disabled", false);
               
               $("#train_achive_date").val('');
               $("#train_hide_id").val('');
               $("#train_scout_badge").val('');
               $("#train_name").val('');
               $("#train_certificate_no").val('');
            }
            
           }); 
   }
   function delete_scoutprogram_training(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
              method: "GET",
              url: "<?=base_url('scouts_member/cub_program_badge_training/'.$id)?>",
              data: { delete_id: delid, scout_badge: $("#camp_scout_badge").val(), achive_date: $("#train_achive_date").val(), section_id: $("#train_hide_section_id").val(), train_name: $("#train_name").val(), train_certificate_no: $("#train_certificate_no").val(), hide_id: $("#train_hide_id").val(), hide_user_id: $("#train_hide_user_id").val() }
            })
              .done(function( msg ) {
               detailsarr=msg.split('23432sdfg324');
               if(detailsarr[0]=='duplicate')
               {
                  alert('Duplicate')
               }
               if(detailsarr[1]!='')
               {
                  $('#printbadge_training').html(detailsarr[1]);
               }
               
              }); 
      }
   }
   function edit_scoutprogram_training(delid, datefield,badgeid, camp_name, camp_certificate_no)
   {
      $("#train_achive_date").val(datefield);
      $("#train_hide_id").val(delid);
      $("#train_scout_badge").val(badgeid);
      $("#train_name").val(camp_name);
      $("#train_certificate_no").val(camp_certificate_no);
      
      $("#train_scout_badge").prop("disabled", false);
   }

   // health

   function get_scout_badge_health()
   {
      $.ajax({        
           method: "GET",
           url: "<?=base_url('scouts_member/cub_program_badge_health/'.$id)?>",
           data: { health_years: $("#health_years").val(),  health_height: $("#health_height").val(),health_weight: $("#health_weight").val(), health_hand_size: $("#health_hand_size").val(), health_span: $("#health_span").val(),  health_heartbeat: $("#health_heartbeat").val(),health_temperature: $("#health_temperature").val(), health_chest_size: $("#health_chest_size").val(), section_id: $("#health_hide_section_id").val(), hide_id: $("#health_hide_id").val(), hide_user_id: $("#health_hide_user_id").val() }
           
         })
           .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_health').html(detailsarr[1]);
            }
            
            
               
            $("#health_years").val('');
            $("#health_height").val('');
            $("#health_weight").val('');
            $("#health_chest_size").val('');
            $("#health_span").val('');
            $("#health_hand_size").val('');
            $("#health_heartbeat").val('');
            $("#health_temperature").val('');
            
           }); 
   }
   function delete_scoutprogram_health(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
              method: "GET",
              url: "<?=base_url('scouts_member/cub_program_badge_health/'.$id)?>",
              data: { delete_id: delid, health_years: $("#health_years").val(),  health_height: $("#health_height").val(),health_weight: $("#health_weight").val(), health_hand_size: $("#health_hand_size").val(), health_span: $("#health_span").val(),  health_heartbeat: $("#health_heartbeat").val(),health_temperature: $("#health_temperature").val(), health_chest_size: $("#health_chest_size").val(), section_id: $("#health_hide_section_id").val(), hide_id: $("#health_hide_id").val(), hide_user_id: $("#health_hide_user_id").val() }
            })
              .done(function( msg ) {
               detailsarr=msg.split('23432sdfg324');
               if(detailsarr[0]=='duplicate')
               {
                  alert('Duplicate')
               }
               if(detailsarr[1]!='')
               {
                  $('#printbadge_health').html(detailsarr[1]);
               }
               
              }); 
      }
   }
   function edit_scoutprogram_health(delid, health_years,health_height, health_weight, health_chest_size,health_span,health_hand_size,health_heartbeat,health_temperature)
   {
      
      $("#health_hide_id").val(delid);
      $("#health_years").val(health_years);
      $("#health_height").val(health_height);
      $("#health_weight").val(health_weight);
      $("#health_chest_size").val(health_chest_size);
      $("#health_span").val(health_span);
      $("#health_hand_size").val(health_hand_size);
      $("#health_heartbeat").val(health_heartbeat);
      $("#health_temperature").val(health_temperature);
      
   }

   // institute

   function get_scout_badge_institute()
   {
      $.ajax({        
           method: "GET",
           url: "<?=base_url('scouts_member/cub_program_badge_institute/'.$id)?>",
           data: { institute_years: $("#institute_years").val(),  institute_class_name: $("#institute_class_name").val(),institute_roll_no: $("#institute_roll_no").val(), institute_total_unmber: $("#institute_total_unmber").val(), section_id: $("#institute_hide_section_id").val(), hide_id: $("#institute_hide_id").val(), hide_user_id: $("#institute_hide_user_id").val() }
           
         })
           .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_institute').html(detailsarr[1]);
            }
            
            
               
            $("#institute_years").val('');
            $("#institute_class_name").val('');
            $("#institute_roll_no").val('');
            $("#institute_total_unmber").val('');
            
           }); 
   }
   function delete_scoutprogram_institute(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
              method: "GET",
              url: "<?=base_url('scouts_member/cub_program_badge_institute/'.$id)?>",
              data: { delete_id: delid, institute_years: $("#institute_years").val(),  institute_class_name: $("#institute_class_name").val(),institute_roll_no: $("#institute_roll_no").val(), institute_total_unmber: $("#institute_total_unmber").val(), section_id: $("#institute_hide_section_id").val(), hide_id: $("#institute_hide_id").val(), hide_user_id: $("#institute_hide_user_id").val() }
            })
              .done(function( msg ) {
               detailsarr=msg.split('23432sdfg324');
               if(detailsarr[0]=='duplicate')
               {
                  alert('Duplicate')
               }
               if(detailsarr[1]!='')
               {
                  $('#printbadge_institute').html(detailsarr[1]);
               }
               
              }); 
      }
   }
   function edit_scoutprogram_institute(delid, institute_years,institute_class_name, institute_roll_no, institute_total_unmber)
   {
      
      $("#institute_hide_id").val(delid);
      $("#institute_years").val(institute_years);
      $("#institute_class_name").val(institute_class_name);
      $("#institute_roll_no").val(institute_roll_no);
      $("#institute_total_unmber").val(institute_total_unmber);
      
   }institute



   // promotion 

   function get_scout_badge_promotion()
   {
      $.ajax({        
           method: "GET",
           url: "<?=base_url('scouts_member/cub_program_badge_promotion/'.$id)?>",
           data: { scout_badge: $("#promotion_scout_badge").val(),  scout_role: $("#promotion_scout_role").val(), from_date: $("#promotion_from_date").val(),to_date: $("#promotion_to_date").val(), section_id: $("#promotion_hide_section_id").val(), hide_id: $("#promotion_hide_id").val(), hide_user_id: $("#promotion_hide_user_id").val() }
           
         })
           .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_promotion').html(detailsarr[1]);
            }
            
            if($("#promotion_hide_id").val()>0)
            {
               $("#promotion_scout_badge").prop("disabled", false);
               $("#promotion_scout_role").prop("disabled", false);
               
               $("#promotion_from_date").val('');
               $("#promotion_to_date").val('');
               $("#promotion_scout_badge").val('');
               $("#promotion_scout_role").val('');
               $("#promotion_hide_id").val('');
            }
            
           }); 
   }
   function delete_scoutprogram_promotion(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
              method: "GET",
              url: "<?=base_url('scouts_member/cub_program_badge_promotion/'.$id)?>",
              data: { delete_id: delid, scout_badge: $("#promotion_scout_badge").val(),  scout_role: $("#promotion_scout_role").val(), from_date: $("#promotion_from_date").val(),to_date: $("#promotion_to_date").val(), section_id: $("#promotion_hide_section_id").val(), hide_id: $("#promotion_hide_id").val(), hide_user_id: $("#promotion_hide_user_id").val() }
            })
              .done(function( msg ) {
               detailsarr=msg.split('23432sdfg324');
               if(detailsarr[0]=='duplicate')
               {
                  alert('Duplicate')
               }
               if(detailsarr[1]!='')
               {
                  $('#printbadge_promotion').html(detailsarr[1]);
               }
               
              }); 
      }
   }
   function edit_scoutprogram_promotion(delid, dateformfield,datetofield,badgeid, roleid)
   {
      $("#promotion_from_date").val(dateformfield);
      $("#promotion_to_date").val(datetofield);
      $("#promotion_scout_badge").val(badgeid);
      $("#promotion_scout_role").val(roleid);
      $("#promotion_hide_id").val(delid);
      
      $("#promotion_scout_badge").prop("disabled", false);
      $("#promotion_scout_role").prop("disabled", false);
   }


    // resign 

   function get_scout_badge_resign()
   {
      $.ajax({        
           method: "GET",
           url: "<?=base_url('scouts_member/cub_program_badge_resign/'.$id)?>",
           data: { resign_date: $("#resign_date").val(), resign_reason: $("#resign_reason").val(), section_id: $("#resign_hide_section_id").val(), hide_id: $("#resign_hide_id").val(), hide_user_id: $("#resign_hide_user_id").val() }
           
         })
           .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_resign').html(detailsarr[1]);
            }
            
            if($("#train_hide_id").val()>0)
            {
               $("#train_scout_badge").prop("disabled", false);
               
               $("#resign_date").val('');
               $("#resign_hide_id").val('');
               $("#resign_reason").val('');
            }
            
           }); 
   }
   function delete_scoutprogram_resign(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
              method: "GET",
              url: "<?=base_url('scouts_member/cub_program_badge_resign/'.$id)?>",
              data: { delete_id: delid, resign_date: $("#resign_date").val(), resign_reason: $("#resign_reason").val(), section_id: $("#resign_hide_section_id").val(), hide_id: $("#resign_hide_id").val(), hide_user_id: $("#resign_hide_user_id").val() }
            })
              .done(function( msg ) {
               detailsarr=msg.split('23432sdfg324');
               if(detailsarr[0]=='duplicate')
               {
                  alert('Duplicate')
               }
               if(detailsarr[1]!='')
               {
                  $('#printbadge_resign').html(detailsarr[1]);
               }
               
              }); 
      }
   }
   function edit_scoutprogram_resign(delid, datefield, reason)
   {
      $("#resign_date").val(datefield);
      $("#resign_hide_id").val(delid);
      $("#resign_reason").val(reason);
   }
</script>