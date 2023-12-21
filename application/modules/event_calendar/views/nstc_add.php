<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
         <li><a href="<?=base_url('event_calendar/nstc')?>" class="active"><?=$module_name?></a></li>
         <li><?=$meta_title; ?></li>
      </ul>
      <style type="text/css">
         #memberDiv td{padding: 5px;}
         #memberDiv th{padding: 5px; font-weight: bold; color: black;}
      </style>
      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('event_calendar/nstc')?>" class="btn btn-blueviolet btn-xs btn-mini"> NSTC Event List</a>  
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
                  echo form_open_multipart("event_calendar/nstc_add", $attributes);
                  ?>
                  <div class="row form-row">
                     <div class="col-md-12">
                        <label class="form-label">NSTC Event Title</label>
                        <?php echo form_error('nstc_event_title');?>
                        <input name="nstc_event_title" value="<?=set_value('nstc_event_title')?>" type="text" class="form-control input-sm" placeholder="NSTC Event 2019">
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-2">
                        <label class="form-label">Event Start Date</label>
                        <?php echo form_error('nstc_event_start');?>
                        <input name="nstc_event_start" value="<?=set_value('nstc_event_start')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Event End Date</label>
                        <?php echo form_error('nstc_event_end');?>
                        <input name="nstc_event_end" value="<?=set_value('nstc_event_end')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
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
            nstc_event_title: { required: true },
            nstc_event_start: { required: true },
            nstc_event_end: { required: true }
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
         }
      });
   });   
</script>  