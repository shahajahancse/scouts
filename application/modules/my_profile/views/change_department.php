<?php
$scout_id = $info->scout_id; 
$profile_img = $info->profile_img;
$path = base_url().'profile_img/';
if($profile_img != NULL){
  $img_url = $path.$profile_img;
}else{
  $img_url = $path.'no-img.png';
}
?>
<div class="page-content"> 
   <div class="content">  
      <div class="row">
         <div class="col-md-12">
            <div class="tiles white">
               <div class="row">
                  <div class="col-md-2 col-sm-2" style="margin:0 20px;">
                     <div class="user-profile-pic" style="margin-top: 20px;"> 
                        <img width="100" height="100" data-src-retina="<?=$img_url?>" data-src="<?=$img_url?>" src="<?=$img_url?>" alt="" style="border: 5px solid #ccc;">
                     </div>
                     <div class="user-mini-description"  style="font-size: 150%;"><h2 class="text-success semi-bold"> <?=$this->ion_auth->is_employee()?'':'BS ID'?></h2></div>
                     <div class="user-mini-description" style="font-size: 150%;"><h2 class="text-success semi-bold" ><?=$scout_id;?> </h2></div>
                  </div>

                  <div class="col-md-9 col-sm-9" style="margin-top: 20px;">
                     <div class="grid simple horizontal red">
                        <div class="grid-title">
                           <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                           <div class="pull-right">                
                              <a href="<?=base_url('my_profile')?>" class="btn btn-blueviolet btn-xs btn-mini"> <?=$this->ion_auth->is_employee()?'প্রোফাইল':'My Profile'?></a> 
                           </div>
                        </div>
                        <div class="grid-body">
                           <div><?php //echo $message;?></div>
                           <?php if($this->session->flashdata('success')):?>
                              <div class="alert alert-success">                                 
                                 <?php echo $this->session->flashdata('success');;?>
                              </div>
                           <?php endif; ?>
                           <?php 
                           $attributes = array();
                           echo form_open('my_profile/change_department', $attributes);?>

                           <div class="row">
                              <div class="col-md-6">
                                 <div class="row form-row">
                                    <div class="col-md-12">
                                        <label class="form-label"><?=$this->ion_auth->is_employee()?'বিভাগ নির্বাচন করুন':'Division'?> <span class="required"> * </span></label>
                                       <?php echo form_error('id'); ?>
                                       <?php echo form_dropdown('id', $department, set_value('id',$cur_department->id), 'style="width:100%"'); ?>
                                    </div>    
                                 </div>
                              </div>
                           </div> <!-- /row -->

                           <div class="form-actions">  
                              <div class="pull-right">
                                 
                                 <?php echo form_submit('submit', $this->ion_auth->is_employee()?'সংরক্ষণ':'Save', "class='btn btn-primary btn-small btn-cons'"); ?>
                                 <a href="<?=base_url('my_profile')?>" class="btn btn-white btn-small btn-cons"><?=$this->ion_auth->is_employee()?'বাতিল':'Cancel'?></a>
                              </div>
                           </div>
                           <?php echo form_close();?>
                        </div>  <!-- END GRID BODY -->              
                     </div> <!-- END GRID -->
                  </div> <!-- </end col 9> -->
               </div>
            </div>
         </div>  
      </div>  <!-- </end row -->
   </div>
</div>
