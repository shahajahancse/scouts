<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('scouts_member')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
     <div class="col-md-12">
      <div class="grid simple horizontal red">
       <div class="grid-title">
        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>              
              <div class="pull-right">
                <a href="<?=base_url('events/event_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> All Events List</a> 
                <!-- <a href="<?=base_url('events/create_event')?>" class="btn btn-primary btn-xs btn-mini"> Create Events </a>
                <a href="<?=base_url('events/upcomming_event_list')?>" class="btn btn-success btn-xs btn-mini"> Upcomming Events List</a>  -->
              </div> 
            </div>
            <div class="grid-body">
              <div><?php //echo validation_errors(); ?></div>
              <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">                      
                  <?php echo $this->session->flashdata('success');;?>
                </div>
              <?php endif; ?>
              <?php if($this->session->flashdata('warning')):?>
                <div class="alert alert-warning">                      
                  <?php echo $this->session->flashdata('warning');;?>
                </div>
              <?php endif; ?>
              <?php 
              $attributes = array('id' => 'event_validate');
              echo form_open_multipart("events/edit/".$event->id, $attributes);
              ?>

              <div class="row">
                <div class="col-md-8">

                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label">Event Title<span class="required">*</span></label>
                      <?php echo form_error('event_title'); ?>
                      <input name="event_title" id="event_title" type="text" class="form-control input-sm" value="<?=set_value('event_title',$event->event_title)?>">
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label">Event Venue<span class="required">*</span></label>
                      <?php echo form_error('event_venu'); ?>
                      <input name="event_venu" id="event_venu" type="text"  class="form-control input-sm" value="<?=set_value('event_venu',$event->event_venu)?>">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">From Date<span class="required">*</span></label>
                      <?php echo form_error('event_start_date'); ?>
                      <input name="event_start_date" type="text" class="form-control input-sm datetime" value="<?=set_value('event_start_date', date_bangla_format($event->event_start_date))?>">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">To Date<span class="required">*</span></label>
                      <?php echo form_error('event_end_date'); ?>
                      <input name="event_end_date" type="text" class="form-control input-sm datetime" value="<?=set_value('event_end_date', date_bangla_format($event->event_end_date))?>">
                    </div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-10">
                      <label class="form-label">Event Details<span class="required">*</span></label>
                      <?php echo form_error('event_details'); ?>
                      <textarea name="event_details" rows="10" cols="70"><?=set_value('event_details', $event->event_details)?></textarea>
                    </div>                    
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label">Registration Start<span class="required">*</span></label>
                      <?php echo form_error('event_reg_start'); ?>
                      <input name="event_reg_start" type="text" class="form-control input-sm datetime" value="<?=set_value('event_reg_start', date_bangla_format($event->event_reg_start))?>">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Registration End<span class="required">*</span></label>
                      <?php echo form_error('event_reg_end'); ?>
                      <input name="event_reg_end" type="text" class="form-control input-sm datetime" value="<?=set_value('event_reg_end', date_bangla_format($event->event_reg_end))?>">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <label class="form-label">Published <span class="required">*</span></label>
                    <?php echo form_error('published'); ?>
                    <input type="radio" name="published" class="group_control" value="Yes" <?=set_value('published', $event->published)=='Yes'?'checked':'';?>> Yes &nbsp;&nbsp;
                    <input type="radio" name="published" class="group_control" value="No" <?=set_value('published', $event->published)=='No'?'checked':'';?>> No
                  </div>

                  <!-- <div class="row">
                    <div class="col-md-12">
                      <h5 style="font-weight: bold;">Notify Scout's Section <span class="required">*</span></h5>
                      <?php //echo form_error('event_notify[]'); ?>
                      <?php
                      //$event_notify_data = explode(',', $event->event_notify);
                      //$event_notify=$this->Common_model->set_scout_section_checkbox(); 
                      //foreach ($event_notify as $key => $value) {
                        ?>
                        <div class="">
                          <label>
                            <input type="checkbox" value="<?php //echo $key?>" name="event_notify[]" <?php //if(search_key($key, $event_notify_data)==$key){ echo 'checked';} ?> > <?php //$value?>
                          </label>
                        </div>
                        <?php
                      //}
                      ?>
                    </div>
                  </div> -->

                </div>

              </div>

              <div class="form-actions">  
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                  <!-- <button type="button" class="btn btn-white btn-cons">Cancel</button> -->
                </div>
              </div>
              <?php //echo form_close();?>
              <?php
           //  function search_key($id, $event_notify_data){

           //    foreach ($event_notify_data as $key => $value) {
           //     if($value==$id)
           //       return $value;
           //   }
           //   return 0;
           // }
              ?>

            </div>  <!-- END GRID BODY -->              
          </div> <!-- END GRID -->
        </div>

      </div> <!-- END ROW -->

    </div>
  </div>
  <script type="text/javascript">
   $(document).ready(function() {
    $('#event_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        event_title: {
          required: true
        },
        event_venu: {
          required: true
        },
        event_details: {
          required: true,
          minlength: 10
        },
        event_start_date: {
          required: true
        },
        event_end_date: {
          required: true
        },
        event_reg_start: {
          required: true
        },
        event_reg_end: {
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
     }
   });
  });   
</script>