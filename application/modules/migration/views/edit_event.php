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
                <a href="<?=base_url('events/create_event')?>" class="btn btn-primary btn-xs btn-mini"> Create Events </a>
                <a href="<?=base_url('events/event_list')?>" class="btn btn-success btn-xs btn-mini"> All Events List</a> 
                <a href="<?=base_url('events/upcomming_event_list')?>" class="btn btn-success btn-xs btn-mini"> Upcomming Events List</a> 
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
              <?php echo form_open_multipart("events/edit/".$event->id);?>

              <div class="row">
                <div class="col-md-8">

                  <div class="row form-row">
                    <div class="col-md-10">
                      <label class="form-label">Event Title</label>
                      <?php echo form_error('event_title'); ?>
                      <input name="event_title" id="event_title" type="text" class="form-control input-sm" value="<?=set_value('event_title',$event->event_title)?>">
                    </div>
                    <div class="col-md-10">
                      <label class="form-label">Event Venu</label>
                      <?php echo form_error('event_venu'); ?>
                      <input name="event_venu" id="event_venu" type="text"  class="form-control input-sm" value="<?=set_value('event_venu',$event->event_venu)?>">
                    </div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-10">
                      <label class="form-label">Event Details</label>
                      <?php echo form_error('event_details'); ?>
                      <textarea name="event_details" rows="10" cols="70"><?=set_value('event_details', $event->event_details)?></textarea>
                    </div>                    
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label">From Date</label>
                      <?php echo form_error('event_start_date'); ?>
                      <input name="event_start_date" id="datetime" type="text" class="form-control input-sm datetime" value="<?=set_value('event_start_date',$event->event_start_date)?>">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">To Date</label>
                      <?php echo form_error('event_end_date'); ?>
                      <input name="event_end_date" id="datetime" type="text" class="form-control input-sm datetime" value="<?=set_value('event_end_date',$event->event_end_date)?>">
                    </div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label">Event Type</label>
                      <?php echo form_error('event_type'); ?>
                      <input type="radio" name="event_type" value="National" <?=$event->event_type=='National'?'checked':'';?>> National
                      <input type="radio" name="event_type" value="International" <?=$event->event_type=='International'?'checked':'';?>> International
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                    <h5 style="font-weight: bold;">Notify Scout's Section </h5>
                    <?php echo form_error('event_notify[]'); ?>
                      <?php
                        $event_notify_data = explode(',', $event->event_notify);
                        $event_notify=$this->Common_model->set_scout_section_checkbox(); 
                        foreach ($event_notify as $key => $value) {
                          ?>
                            <div class="">
                                <label>
                                  <input type="checkbox" value="<?=$key?>" name="event_notify[]" <?php if(search_key($key, $event_notify_data)==$key){ echo 'checked';} ?> > <?=$value?>
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
                    echo form_dropdown('sc_region_id', $regions, set_value('sc_region_id', $event->sc_region_id), $more_attr);
                    ?>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Select Scout District</label>
                    <?php echo form_error('sc_district_id'); 
                      $more_attr = 'class="form-control input-sm sc_district_val" id="sc_district"';
                      echo form_dropdown('sc_district_id', $scout_districts, set_value('sc_district_id', $event->sc_district_id), $more_attr);
                    ?>
                  </div>
                </div>

                <div class="row form-row">
                 <div class="col-md-6">
                   <label class="form-label">Select Scout Upazila/Thana</label>
                   <?php echo form_error('sc_upa_tha_id');
                    $more_attr = 'class="form-control input-sm sc_upazila_thana_val" id="sc_upazila_thana"';
                      echo form_dropdown('sc_upa_tha_id', $scout_upazila_thana, set_value('sc_upa_tha_id', $event->sc_upa_tha_id), $more_attr);
                   ?>
                 </div>

                 <div class="col-md-6">
                  <label class="form-label">Select Scout Group</label>
                  <?php echo form_error('sc_group_id'); 
                  $more_attr = 'class="form-control input-sm sc_group_val" id="sc_unit"';
                      echo form_dropdown('sc_group_id', $scout_group, set_value('sc_group_id', $event->sc_group_id), $more_attr);
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
          	function search_key($id, $event_notify_data){

          		foreach ($event_notify_data as $key => $value) {
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