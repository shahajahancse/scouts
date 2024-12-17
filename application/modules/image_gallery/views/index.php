<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('offices/region')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?php echo base_url('image_gallery/upload_image')?>" class="btn btn-blueviolet btn-xs btn-mini"> Upload Image</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
                  <div><?php //echo validation_errors(); ?></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <a class="close" data-dismiss="alert">&times;</a>
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                 

             </div>  <!-- END GRID BODY -->              
          </div> <!-- END GRID -->
       </div>

    </div> <!-- END ROW -->

 </div>
</div>