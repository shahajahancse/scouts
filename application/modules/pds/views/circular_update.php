<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashbaord')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('award')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('award/circular_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> Award Circular List</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php 
                  $attributes = array('id' => 'validate');
                  echo form_open_multipart(uri_string(), $attributes);
                  ?>
                  <div class="row form-row">
                     <div class="col-md-12">
                        <label class="form-label">Award Circular Title</label>
                        <?php echo form_error('circular_title');?>
                        <input name="circular_title" value="<?=set_value('circular_title', $info->circular_title)?>" type="text" class="form-control input-sm" placeholder="National Headquarter Award 2019">
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-2">
                        <label class="form-label">Group End Date</label>
                        <?php echo form_error('group_end_date');?>
                        <input name="group_end_date" value="<?=set_value('group_end_date', date_browse_format($info->group_end_date))?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Upazila End Date</label>
                        <?php echo form_error('upazila_end_date');?>
                        <input name="upazila_end_date" value="<?=set_value('upazila_end_date', date_browse_format($info->upazila_end_date))?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">District End Date</label>
                        <?php echo form_error('district_end_date');?>
                        <input name="district_end_date" value="<?=set_value('district_end_date', date_browse_format($info->district_end_date))?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Region End Date</label>
                        <?php echo form_error('region_end_date');?>
                        <input name="region_end_date" value="<?=set_value('region_end_date', date_browse_format($info->region_end_date))?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Circular Status</label>
                        <?php echo form_error('status'); ?>
                        <input type="radio" name="status" id="" class="group_control" value="1" <?=set_value('status', $info->status)==1?'checked':'';?>> Enable &nbsp;&nbsp;
                        <input type="radio" name="status" id="" class="group_control" value="0" <?=set_value('status', $info->status)==0?'checked':'';?>> Disable
                     </div>
                  </div>

                  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                     </div>
                  </div>
                  <?php echo form_close();?>

               </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>

<script type="text/javascript">
 $(document).ready(function() {
   $('#validate').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            circular_title: { required: true },
            group_end_date: { required: true },
            upazila_end_date: { required: true },
            district_end_date: { required: true },
            region_end_date: { required: true }
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
            form.submit();
         },

      });
});   
</script>  