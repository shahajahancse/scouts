<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
         <li><a href="<?=base_url('award')?>" class="active"><?=$module_name?></a></li>
         <li><?=$meta_title; ?></li>
      </ul>
      <style type="text/css">
         #memberDiv td{padding: 5px;}
         #memberDiv th{padding: 5px; font-weight: bold; color: black;}
         #workStationDiv td{padding: 5px;}

         /*.form-row input {
             height:35px
         }*/
      </style>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                      
                  </div>
               </div>
               <div class="grid-body">
                  <?php echo validation_errors(); ?>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  
                  <?php 
                  $attributes = array('id' => 'validate');
                  echo form_open_multipart("employee/emp_id_card_expiry");
                  ?>
                  
                  <div class="row">
                     
                     <div class="col-md-12">
                        <div class="row form-row">

                           <div class="col-md-6">
                              <label class="form-label">Professional ID Card Expiry Date<span class='required'>*</span></label>
                              <?php echo form_error('professional');?>
                              <input type="date" name="professional" class="form-control input-sm" value="<?=set_value('professional',$info->professional)?>">
                           </div>

                           <div class="col-md-6">
                              <label class="form-label">Volunteer ID Card Expiry Date<span class='required'>*</span></label>
                              <?php echo form_error('volunteer');?>
                              <input type="date" name="volunteer" class="form-control input-sm" value="<?=set_value('volunteer',$info->volunteer)?>">
                           </div>
 
                        </div>
                        
                     </div>
                     <div class="col-md-12">

                        <div class="form-actions">  
                           <div class="pull-right">
                              <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Update </button>
                           </div>
                        </div>
                     <?php echo form_close();?>

                     </div>  <!-- END GRID BODY -->              
               </div> <!-- END GRID -->
            </div>
      </div> <!-- END ROW -->

   </div>
</div>