<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('committee/upazila')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                  <a href="<?=base_url('committee/upazila')?>" class="btn btn-blueviolet btn-xs btn-mini"> Upazila Committee List</a>  
                     <a href="<?=base_url('committee/upazila_details/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini">Committee Details</a>    
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php 
                  $attributes = array('id' => 'committee_validate');
                  echo form_open_multipart(uri_string(), $attributes);
                  ?>
                  <div class="row form-row">
                     <div class="col-md-12">
                        <label class="form-label">Upazila Committee Name</label>
                        <?php echo form_error('committee_name');?>
                        <input name="committee_name" id="committee_name" value="<?=set_value('committee_name', $info->committee_name)?>" type="text" class="form-control input-sm" placeholder="Scouts Upazila (Executive or Program or etc.) Committee Name (2019-2021)">
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-5">
                        <label class="form-label">Select Committee Type</label>
                        <?php echo form_error('comm_type_id');
                        $more_attr = 'class="form-control input-sm" id="region"';
                        echo form_dropdown('comm_type_id', $committee_type_dd, set_value('comm_type_id', $info->comm_type_id), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Session Start Date</label>
                        <?php echo form_error('session_start_date');?>
                        <input name="session_start_date" value="<?=set_value('session_start_date', date_browse_format($info->session_start_date))?>" type="text" class="form-control input-sm datetime" placeholder="">
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Session End Date</label>
                        <?php echo form_error('session_end_date');?>
                        <input name="session_end_date" value="<?=set_value('session_end_date', date_browse_format($info->session_end_date))?>" type="text" class="form-control input-sm datetime" placeholder="">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Committee Status</label>
                        <?php echo form_error('status'); ?>
                        <input type="radio" name="status" id="" class="group_control" value="1" <?=set_value('is_current', $info->is_current)==1?'checked':'';?>> Current &nbsp;&nbsp;
                        <input type="radio" name="status" id="" class="group_control" value="0" <?=set_value('is_current', $info->is_current)==0?'checked':'';?>> Expired
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
   $('#committee_validate').validate({
          // focusInvalid: false, 
          ignore: "",
          rules: {
            comm_type_id: {
               required: true
            },
            committee_name: {
              required: true
           },
           session_start_date: {
              required: true
           },
           session_end_date: {
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
            form.submit();
         },

      });
});   
</script>  