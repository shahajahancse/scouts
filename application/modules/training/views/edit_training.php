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
                <a href="<?=base_url('training/create_training')?>" class="btn btn-primary btn-xs btn-mini"> Create Training </a>
                <a href="<?=base_url('training/training_list')?>" class="btn btn-success btn-xs btn-mini"> All Training List</a> 
                <a href="<?=base_url('training/upcomming_training_list')?>" class="btn btn-success btn-xs btn-mini"> Upcomming Training List</a> 
              </div> 
             </div>
             <div class="grid-body">
              <!-- <form id="form_traditional_validation" action="#"> -->
              <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
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
                  $attributes = array('id' => 'training_validate');
                  echo form_open_multipart("training/edit/".$training->id, $attributes);
              ?>

              <div class="row">
                <div class="col-md-8">

                  <div class="row form-row">
                    <div class="col-md-10">
                      <label class="form-label">Training Name<span class="required">*</span></label>
                      <?php echo form_error('training_name'); ?>
                      
                      <?php 
                        $css = array(
                            'class'         => 'form-control input-sm',
                        );

                        echo form_dropdown('training_name', $training_list, set_value('training_name',$training->training_name),$css ); 
                      ?>
                      
                    </div>
                    <div class="col-md-10">
                      <label class="form-label">Training Venu<span class="required">*</span></label>
                      <?php echo form_error('training_center'); ?>
                      <input name="training_center" id="training_center" type="text"  class="form-control input-sm" value="<?=set_value('training_center',$training->training_center)?>">
                    </div>

                    <div class="col-md-10">
                      <label class="form-label">Trainers/Trainee<span class="required">*</span></label>
                      <?php echo form_error('trainer_id'); ?>
                      <?php 
                        $css = array(
                            'class'         => 'form-control input-sm',
                        );
                        
                        echo form_dropdown('trainer_id', $teacher, set_value('trainer_id',$training->trainer_id),$css ); 
                      ?>
                    </div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-10">
                      <label class="form-label">Training Details<span class="required">*</span></label>
                      <?php echo form_error('training_details'); ?>
                      <textarea name="training_details" rows="10" cols="70"><?=set_value('training_details', $training->training_details)?></textarea>
                    </div>                    
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label">From Date<span class="required">*</span></label>
                      <?php echo form_error('training_start_date'); ?>
                      <input name="training_start_date" id="datetime" type="text" class="form-control input-sm datetime" value="<?=set_value('training_start_date',date_browse_format($training->training_start_date))?>">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">To Date<span class="required">*</span></label>
                      <?php echo form_error('training_end_date'); ?>
                      <input name="training_end_date" id="datetime" type="text" class="form-control input-sm datetime" value="<?=set_value('training_end_date',date_browse_format($training->training_end_date))?>">
                    </div>

                    <div class="col-md-6">
                      <label class="form-label">Duration<span class="required">*</span></label>
                      <?php echo form_error('training_duration'); ?>
                      <input name="training_duration" id="" type="text" class="form-control input-sm " value="<?=set_value('training_duration',$training->training_duration)?>">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Minimum Attendance<span class="required">*</span></label>
                      <?php echo form_error('min_attendance'); ?>
                      <input name="min_attendance" id="" type="text" class="form-control input-sm " value="<?=set_value('min_attendance',$training->min_attendance)?>">
                    </div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label">Training Type<span class="required">*</span></label>
                      <?php echo form_error('training_type'); ?>
                      <input type="radio" name="training_type" value="National" <?=$training->training_type=='National'?'checked':'';?>> National
                      <input type="radio" name="training_type" value="International" <?=$training->training_type=='International'?'checked':'';?>> International
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                    <h5 style="font-weight: bold;">Notify Scout's Section <span class="required">*</span></h5>
                    <?php echo form_error('training_notify[]'); ?>
                      <?php
                        $training_notify_data = explode(',', $training->training_notify);
                        $training_notify=$this->Common_model->set_scout_section_checkbox(); 
                        foreach ($training_notify as $key => $value) {
                          ?>
                            <div class="">
                                <label>
                                  <input type="checkbox" value="<?=$key?>" name="training_notify[]" <?php if(search_key($key, $training_notify_data)==$key){ echo 'checked';} ?> > <?=$value?>
                                </label>
                            </div>
                          <?php
                        }
                      ?>
                      
                    </div>
                  </div>

                </div>

              </div>
                <div class="col-md-12">
                  <h3 style="font-weight: bold;">Scout Information</h3>
              </div>

              <div class="col-md-12">
                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label">Select Scout Region</label>
                    <?php 
                    echo form_error('sc_region_id');
                    $more_attr = 'class="form-control input-sm" id="region"';
                    echo form_dropdown('sc_region_id', $regions, set_value('sc_region_id', $training->sc_region_id), $more_attr);
                    ?>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Select Scout District</label>
                    <?php echo form_error('sc_district_id'); 
                      $more_attr = 'class="form-control input-sm sc_district_val" id="sc_district"';
                      echo form_dropdown('sc_district_id', $scout_districts, set_value('sc_district_id', $training->sc_district_id), $more_attr);
                    ?>
                  </div>
                </div>

                <div class="row form-row">
                 <div class="col-md-6">
                   <label class="form-label">Select Scout Upazila/Thana</label>
                   <?php echo form_error('sc_upa_tha_id');
                    $more_attr = 'class="form-control input-sm sc_upazila_thana_val" id="sc_upazila_thana"';
                      echo form_dropdown('sc_upa_tha_id', $scout_upazila_thana, set_value('sc_upa_tha_id', $training->sc_upa_tha_id), $more_attr);
                   ?>
                 </div>

                 <div class="col-md-6">
                  <label class="form-label">Select Scout Group</label>
                  <?php echo form_error('sc_group_id'); 
                  $more_attr = 'class="form-control input-sm sc_group_val" id="sc_unit"';
                      echo form_dropdown('sc_group_id', $scout_group, set_value('sc_group_id', $training->sc_group_id), $more_attr);
                  ?>
                </div>
              </div>
            </div>

            <div class="form-actions">  
              <div class="pull-right">
                <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                <!-- <button type="button" class="btn btn-white btn-cons">Cancel</button> -->
              </div>
            </div>
          <?php echo form_close();?>
          <?php
          	function search_key($id, $training_notify_data){

          		foreach ($training_notify_data as $key => $value) {
          			if($value==$id)
          			 	return $value;
          		}
          		return 0;
          	}
          ?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>
<script type="text/javascript">
   $(document).ready(function() {
      $('#training_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         training_name: {
            required: true
         },
         training_center: {
            required: true
         },
          trainer_id: {
            required: true
         },
         training_details: {
            required: true,
            minlength: 10
         },
         training_start_date: {
            required: true
         },
         training_end_date: {
            required: true
         },
         training_duration: {
            required: true
         },
         min_attendance: {
            required: true
         },  
         training_type: {
            required: true
         },
         training_notify: {
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