<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('image_gallery/index')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <!-- <div class="pull-right">                
                     <a href="<?=base_url('image_gallery/index')?>" class="btn btn-blueviolet btn-xs btn-mini"> Back to Image Gallery</a>  
                  </div> -->
               </div>
               <div class="grid-body">
                  <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
                  <div><?php //echo validation_errors(); ?></div>
                  <?php if($this->session->flashdata('message')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('message');;?>
                     </div>
                  <?php endif; ?>
                  <?php 
                    $attributes = array('id' => 'office_region_validate');
                    echo form_open_multipart("image_gallery/index",$attributes);
                  ?>
                  
                  <div class="row">
                     <div class="col-md-12">                        
                        <label class="form-label">Official Image <span style="font-size: 12px;">(File type jpg, png, jpeg, gif)</span></label>
                        <div><?php echo form_error('userfile'); ?></div>
                        <input type="file" name="userfile" class="pull-left">    
                        <button type="submit" class="btn btn-primary btn-mini btn-cons pull-left"><i class="icon-ok"></i> Upload </button>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-12">
                        <h3> Image Gallery</h3>
                        <div class="superbox">
                        <?php
                        $ima_path = base_url().'image_gallery/';
                        foreach ($images as $row) { 
                           $src= $ima_path.$row->ig_file_name;
                        ?>
                           <div class="superbox-list"> <img src="<?=$src;?>" data-img="<?=$src?>" alt="" class="superbox-img"> 
                           <a href="<?=base_url('image_gallery/delete_img/'.$row->id)?>" class="btn btn-blueviolet btn-xs btn-mini" onclick="return confirm('Are you sure you want to delete this image?');">Delete</a></div>
                        <?php } ?>
                           <!-- <div class="superbox-list"> <img src="<?=base_url();?>awedget/assets/plugins/jquery-superbox/img/superbox/superbox-thumb-1.jpg" data-img="<?=base_url();?>awedget/assets/plugins/jquery-superbox/img/superbox/superbox-full-1.jpg" alt="" class="superbox-img"> </div>

                           <div class="superbox-list"> <img src="<?=base_url();?>awedget/assets/plugins/jquery-superbox/img/superbox/superbox-thumb-2.jpg" data-img="<?=base_url();?>awedget/assets/plugins/jquery-superbox/img/superbox/superbox-full-2.jpg" alt="" class="superbox-img"> </div>

                           <div class="superbox-list"> <img src="<?=base_url();?>awedget/assets/plugins/jquery-superbox/img/superbox/superbox-thumb-3.jpg" data-img="<?=base_url();?>awedget/assets/plugins/jquery-superbox/img/superbox/superbox-full-3.jpg" alt="" class="superbox-img"> </div> -->

                           <div class="superbox-float"></div>
                           </div>
                           <!-- /SuperBox -->
                     </div>
                  </div>
                  <?php echo form_close();?>

               </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>