<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=$module_title; ?> </a></li>
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
              <div><?php echo validation_errors(); ?></div>
              <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">                      
                  <?php echo $this->session->flashdata('success');;?>
                </div>
              <?php endif; ?>
              <?php 
              $attributes = array('id' => 'event_validate');
              echo form_open_multipart(uri_string(), $attributes);
              ?>

              <div class="row">
                <div class="col-md-12">              
                  <div class="row form-row">
                    <div class="col-md-4">              
                      <label class="form-label">Event Name <span class="required">*</span></label>
                      <input type="text" name="event_title" value="<?=set_value('event_title', $info->event_title)?>" class="form-control input-sm">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Event Venue <span class="required">*</span></label>
                      <input type="text" name="event_venue" value="<?=set_value('event_venue', $info->event_venue)?>" class="form-control input-sm">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Event Organizer <span class="required">*</span></label>
                      <input type="text" name="event_organizer" value="<?=set_value('event_organizer', $info->event_organizer)?>" class="form-control input-sm">
                    </div>
                  </div>
                </div>

                <div class="col-md-12">              
                  <div class="row form-row">
                    <div class="col-md-12">
                      <h5 class="semi-bold" style="text-decoration: underline;">Event Type </h5>
                      <?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('event')){ ?> 
                      <div class="row form-row">
                        <div class="col-md-4">
                          <h5 class="semi-bold"><input type="checkbox" name="et_national" value="1" <?=set_value('et_national',$info->et_national)=='1'?'checked':'';?>> National</h5>
                        </div>
                        <div class="col-md-4">
                          <h5 class="semi-bold"><input type="checkbox" name="et_international" value="1" <?=set_value('et_international', $info->et_international)=='1'?'checked':'';?>> International</h5>
                        </div>
                      </div>
                      <?php } ?>


                      <div class="row form-row">
                        <?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('event')){ ?> 
                        <div class="col-md-4">
                          <h5 class="semi-bold">
                            <input type="checkbox" name="et_region" id="checkRegion" class="eventCheck" value="1" <?=set_value('et_region',$info->et_region)=='1'?'checked':'';?> onClick="toggleSelectRegion()"/> Regional 
                            <input type="button" id="regionAll" value="Select All" style="font-size: 11px; padding:2;">
                          </h5>
                          <div class="row col-md-12">
                            <?php $more_attr = 'class="form-control input-sm" id="region_multi"';
                            $regionIds = explode(',', $info->et_region_ids);
                            echo form_multiselect('et_region_ids[]', $regions, $regionIds, $more_attr);
                            ?>
                          </div>
                        </div>
                        <?php }elseif($this->ion_auth->is_region_admin()){ ?> 
                        <div class="col-md-4">
                          <h5 class="semi-bold">
                            <input type="checkbox" name="et_region" id="checkRegion" class="eventCheck" value="1" <?=set_value('et_region',$info->et_region)=='1'?'checked':'';?> onClick="toggleSelectRegion()"/> Regional
                          </h5>
                          <h4><?=$region_info->region_name_en;?></h4>
                        </div>
                        <?php } ?>

                        <?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('event')){ ?>
                        <div class="col-md-4">
                          <h5 class="semi-bold">
                            <input type="checkbox" name="et_district" id="checkDistrict" class="eventCheck" value="1" <?=set_value('et_district',$info->et_district)=='1'?'checked':'';?> onClick="toggleSelectDistrict()"/> District 
                            <input type="button" id="districtAll" value="Select All" style="font-size: 11px; padding:2;"> 
                          </h5>
                          <?php $more_attr = 'class="sc_district_multi_val form-control input-sm" id="sc_district_multi"';
                          $districtIds = explode(',', $info->et_district_ids);
                          echo form_multiselect('et_district_ids[]', $sc_districts, $districtIds, $more_attr);
                          ?>
                        </div>
                        <?php }elseif($this->ion_auth->is_region_admin()){ ?> 
                        <div class="col-md-4">
                          <h5 class="semi-bold">
                            <input type="checkbox" name="et_district" id="checkDistrict" class="eventCheck" value="1" <?=set_value('et_district',$info->et_district)=='1'?'checked':'';?> onClick="toggleSelectDistrict()"/> District 
                            <input type="button" id="districtAll" value="Select All" style="font-size: 11px; padding:2;"> 
                          </h5>
                          <?php $more_attr = 'class="sc_district_multi_val form-control input-sm" id="sc_district_multi"';
                          $districtIds = explode(',', $info->et_district_ids);
                          echo form_multiselect('et_district_ids[]', $sc_districts, $districtIds, $more_attr);
                          ?>
                        </div>
                        <?php }elseif($this->ion_auth->is_district_admin()){ ?> 
                        <div class="col-md-4">
                          <h5 class="semi-bold">
                            <input type="checkbox" name="et_district" id="checkDistrict" class="eventCheck" value="1" onClick="toggleSelectDistrict()"/> District 
                          </h5>
                          <h4 class="semi-bold"><?=$district_info->dis_name_en;?></h4>
                        </div>
                        <?php } ?>

                        <?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('event')){ ?>
                        <div class="col-md-4">
                          <h5 class="semi-bold">
                            <input type="checkbox" name="et_upazila" id="checkUpazila" class="eventCheck" value="1" <?=set_value('et_upazila',$info->et_upazila)=='1'?'checked':'';?> onClick="toggleSelectUpazila()"/> Upazila 
                            <input type="button" id="upazilaAll" value="Select All" style="font-size: 11px; padding:2;">
                          </h5>
                          <?php $more_attr = 'class="sc_upazila_multi_val form-control input-sm" id="sc_upazila_thana"';
                          $upazilaIds = explode(',', $info->et_upazila_ids);
                          echo form_multiselect('et_upazila_ids[]', $sc_upazilas, $upazilaIds, $more_attr);
                          ?>
                        </div>
                        <?php }elseif($this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin()){ ?> 
                        <div class="col-md-4">
                          <h5 class="semi-bold">
                            <input type="checkbox" name="et_upazila" id="checkUpazila" class="eventCheck" value="1" <?=set_value('et_upazila',$info->et_upazila)=='1'?'checked':'';?> onClick="toggleSelectUpazila()"/> Upazila 
                            <input type="button" id="upazilaAll" value="Select All" style="font-size: 11px; padding:2;">
                          </h5>
                          <?php $more_attr = 'class="sc_upazila_multi_val form-control input-sm" id="sc_upazila_thana"';
                          $upazilaIds = explode(',', $info->et_upazila_ids);
                          echo form_multiselect('et_upazila_ids[]', $sc_upazilas, $upazilaIds, $more_attr);
                          ?>
                        </div>
                      <?php }elseif($this->ion_auth->is_upazila_admin()){ ?> 

                        <div class="col-md-12">
                          <h5 class="semi-bold">
                            <input type="checkbox" name="et_upazila" id="checkUpazila" class="eventCheck" value="1" <?=set_value('et_upazila',$info->et_upazila)=='1'?'checked':'';?> onClick="toggleSelectUpazila()"/> Upazila 
                          </h5>
                          <h4 class="semi-bold"><?=$upazila_info->upa_name;?></h4>
                        </div>

                      <?php } ?>

                      </div>
                    </div>
                  </div>
                </div> <!-- /col-md-12 -->

                <div class="col-md-7">
                  <div class="row form-row">
                    <div class="col-md-12">                    
                      <h5 class="semi-bold" style="text-decoration: underline;">Event Participants Type </h5>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <h5 class="semi-bold"><input type="checkbox" name="ept_cub" id="cub" value="1" <?=set_value('ept_cub',$info->ept_cub)=='1'?'checked':'';?> onClick="toggleSelectCub()"/>Cub Scout</h5>
                          <label class="form-label">Stage/Badge </label>
                          <?php $more_attr = 'class="form-control input-sm" id="selectCubStage"';
                          echo form_dropdown('cub_stage_id', $cub_stage, set_value('cub_stage_id', $info->cub_stage_id), $more_attr);
                          ?>
                        </div>    
                        <div class="col-md-3"> 
                          <h5 class="semi-bold"><input type="checkbox" name="ept_scout" id="scout" value="1" <?=set_value('ept_scout',$info->ept_scout)=='1'?'checked':'';?> onClick="toggleSelectScout()"/>Scout</h5>
                          <label class="form-label">Stage/Badge </label>
                          <?php $more_attr = 'class="form-control input-sm" id="selectScoutStage"';
                          echo form_dropdown('scout_stage_id', $scout_stage, set_value('scout_stage_id', $info->scout_stage_id), $more_attr);
                          ?>
                        </div>
                        <div class="col-md-3">
                          <h5 class="semi-bold"><input type="checkbox" name="ept_rover" id="rover" value="1" <?=set_value('ept_rover',$info->ept_rover)=='1'?'checked':'';?>onClick="toggleSelectRover()"/> Rover Scout</h5>
                          <label class="form-label">Stage/Badge </label>
                          <?php $more_attr = 'class="form-control input-sm" id="selectRoverStage"';
                          echo form_dropdown('rover_stage_id', $rover_stage, set_value('rover_stage_id', $info->rover_stage_id), $more_attr);
                          ?>
                        </div>
                        <div class="col-md-3">
                          <h5 class="semi-bold"><input type="checkbox" name="ept_leader" id="adult_leader" value="1" <?=set_value('ept_leader',$info->ept_leader)=='1'?'checked':'';?> onClick="toggleSelectAdultLeader()"/> Adult Leader</h5>
                          <label class="form-label">Stage/Badge </label>
                          <?php 
                          $groups = array();
                          $i = 0;
                          foreach ($adult_leader_stage as $item) {
                            $groups[$item['section_name_en']][$item['section_id']][$i]['id'] = $item['id'];
                            $groups[$item['section_name_en']][$item['section_id']][$i]['badge_type_name_bn'] = $item['badge_type_name_bn'];
                            $i++;
                          }
                          //print_r($groups); die();
                          ?>
                          <select name="leader_stage_id" class="form-control input-sm" id="selectAdultLeaderStage">
                            <option value="">-Select-</option>
                            <?php foreach($groups as $label => $opt): ?>
                              <optgroup label="<?php echo $label; ?>">
                                <?php foreach ($opt as $id => $name): ?>
                                  <?php foreach ($name as  $val): ?>
                                    <option value="<?php echo $val['id'];?>" <?=$val['id']==$info->leader_stage_id?'selected':'';?>><?php echo $val['badge_type_name_bn']; ?></option>
                                  <?php endforeach; ?>    
                                <?php endforeach; ?>
                              </optgroup>
                            <?php endforeach; ?>
                          </select>
           
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label"> Need Official </label>
                          <input type="radio" name="need_office" class="needOffice" value="Yes" <?=set_value('need_office',$info->need_office)=='Yes'?'checked':'';?>> Yes
                          <input type="radio" name="need_office" class="needOffice" value="No" <?=set_value('need_office',$info->need_office)=='No'?'checked':'';?>> No
                        </div>
                        <div id="displayNeedOffice" style="display: none;">
                          <div class="col-md-4">
                            <label class="form-label">Quantities </label>
                            <input type="text" name="need_office_qty" value="<?=set_value('need_office_qty', $info->need_office_qty)?>" class="form-control input-sm" id="" title="Total Number of Official Quantities">
                          </div>
                          <div class="col-md-4">  
                            <label class="form-label">Adult Leader Stage</label>
                            <select name="need_office_stage" class="form-control input-sm">
                              <option value="">-Select-</option>
                              <?php foreach($groups as $label => $opt): ?>
                                <optgroup label="<?php echo $label; ?>">
                                  <?php foreach ($opt as $id => $name): ?>
                                    <?php foreach ($name as  $val): ?>
                                      <option value="<?php echo $val['id']; ?>" <?=$val['id']==$info->need_office_stage?'selected':'';?>><?php echo $val['badge_type_name_bn']; ?></option>
                                    <?php endforeach; ?>    
                                  <?php endforeach; ?>
                                </optgroup>
                              <?php endforeach; ?>
                            </select>
                            
                          </div>
                        </div>
                      </div>

                      <div class="row form-row">                  
                        <div class="col-md-4">
                          <label class="form-label"> Need Rover Volunteer </label>
                          <input type="radio" name="need_rover" class="needRover" value="Yes" <?=set_value('need_rover',$info->need_rover)=='Yes'?'checked':'';?>> Yes
                          <input type="radio" name="need_rover" class="needRover" value="No" <?=set_value('need_rover',$info->need_rover)=='No'?'checked':'';?>> No
                        </div>
                        <div id="displayNeedRover" style="display: none;"> 
                          <div class="col-md-4" >
                            <label class="form-label">Quantities </label>
                            <input type="text" name="need_rover_qty" value="<?=set_value('need_rover_qty', $info->need_rover_qty)?>" class="form-control input-sm" id=""  title="Total Number of Official Quantities">
                          </div>
                          <div class="col-md-4">  
                            <label class="form-label">Rover Stage </label> 
                            <?php $more_attr = 'class="form-control input-sm"';
                            echo form_dropdown('need_rover_stage', $rover_stage, set_value('need_rover_stage', $info->need_rover_stage), $more_attr);
                            ?>
                          </div>
                        </div>
                      </div>
                      
                    </div>


                    <div class="col-md-12">
                      <label class="form-label">Event Description <span class="required">*</span></label>
                      <textarea name="event_details" rows="7" style="width: 100%" id=""><?=$info->event_details?></textarea>
                    </div>

                  </div>
                </div> <!-- /col-md-7 -->

                <div class="col-md-5">

                  <div class="row form-row">
                    <div class="col-md-6">  
                      <label class="form-label">Event Participant Category <span class="required">*</span></label> 
                      <?php $more_attr = 'class="form-control input-sm"';
                      echo form_dropdown('ept_category', $event_participant_type, set_value('ept_category', $info->ept_category), $more_attr);
                      ?> 
                    </div>
                    <div class="col-md-6">  
                      <label class="form-label">Event Category <span class="required">*</span></label> 
                      <?php $more_attr = 'class="form-control input-sm"';
                      echo form_dropdown('event_category', $event_category, set_value('event_category', $info->event_category), $more_attr);
                      ?>              
                    </div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label">Event Date of Start <span class="required">*</span></label>
                      <input type="text" name="event_start_date" value="<?=set_value('event_start_date', date_bangla_format($info->event_start_date))?>" class="form-control input-sm datetime" id="" placeholder="DD-MM-YYYY">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Event Date of Closing <span class="required">*</span></label>
                      <input type="text" name="event_end_date" value="<?=set_value('event_end_date', date_bangla_format($info->event_end_date))?>" class="form-control input-sm datetime" id="" placeholder="DD-MM-YYYY">
                    </div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label">Registration Start Date <span class="required">*</span></label>
                      <input type="text" name="event_reg_start" value="<?=set_value('event_reg_start', date_bangla_format($info->event_reg_start))?>" class="form-control input-sm datetime"placeholder="DD-MM-YYYY">
                    </div>

                    <div class="col-md-6">
                      <label class="form-label">Registration Last Date <span class="required">*</span></label>
                      <input type="text" name="event_reg_end" value="<?=set_value('event_reg_end', date_bangla_format($info->event_reg_end))?>" class="form-control input-sm datetime"placeholder="DD-MM-YYYY">
                    </div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label">Number of Participants <span class="required">*</span></label>
                      <input type="text" name="ep_qty" value="<?=set_value('ep_qty', $info->ep_qty)?>" class="form-control input-sm" id="">
                    </div>
                    <div class="col-md-6">  
                      <label class="form-label">Approval Role <span class="required">*</span></label> 
                      <?php $more_attr = 'class="form-control input-sm"';
                      echo form_dropdown('approve_role', $event_appr_role, set_value('approve_role', $info->approve_role), $more_attr);
                      ?>   
                    </div>
                    <div class="col-md-12">
                      <label class="form-label">Published <span class="required">*</span></label>
                      <?php echo form_error('published'); ?>
                      <input type="radio" name="published" class="group_control" value="Yes" <?=set_value('published', $info->published)=='Yes'?'checked':'';?>> Yes &nbsp;&nbsp;
                      <input type="radio" name="published" class="group_control" value="No" <?=set_value('published', $info->published)=='No'?'checked':'';?>> No
                    </div>
                  </div>                

                  <div class="row form-row">
                    <div class="col-md-12">  
                      <label class="form-label">File Attachment (Allow file format pdf, jpg,png,doc,docx,xls,xlsx)</label>
                      <input type="file" name="userfile[]" multiple/>
                    </div>
                    <div class="col-md-12">  
                    <?php
                      if($attachments){
                        $sl=0;
                        foreach ($attachments as $value) {
                          $sl++;
                          //echo $value->file_name .'<button class="btn"><i class="fa fa-download"></i> Download</button>';

                          echo '<a href="'.base_url('event_docs/'.$value->file_name).'" download="'.$value->file_name.'" class="btn btn-mini btn-xs btn-success" style="margin-bottom:2px;">Download - '.$value->file_name.'</a>';
                          echo '<a href="'.base_url('events/attachment_del/'.$value->id.'/'.$info->id).'" onclick="return confirm(\'Are you sure you want to delete this file?\');" class="btn btn-mini btn-xs btn-denger"><i class="fa fa-times-circle"></i></a>';
                          echo '<br>';
                        }
                      }
                    ?>
                    </div>
                  </div>

                </div> <!-- /col-md-5 -->
              </div> <!-- /row -->

              <div class="form-actions">  
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                  <!-- <button type="button" class="btn btn-white btn-cons">Cancel</button> -->
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
      needOfficeFunc();
      needRoverFunc();


      $('#event_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        event_title: { required: true },
        event_venue: { required: true },
        event_organizer: { required: true },
        event_details: { required: true },
        ept_category: { required: true },
        event_category: { required: true },
        event_start_date: { required: true },
        event_end_date: { required: true },
        event_reg_start: { required: true },
        event_reg_end: { required: true },
        ep_qty: { required: true },
        approve_role: { required: true }
        

        // check_region: {
        //   require_from_group: [1, ".eventCheck"]
        // },

        // check_district: {
        //   require_from_group: [1, ".eventCheck"]
        // },

        // check_upazila: {
        //   require_from_group: [1, ".eventCheck"]
        // }   
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

  //Select scout office enable / disable by checkbox
  <?php if($this->ion_auth->is_admin()){ ?> 
  window.onload = toggleSelectRegion(); // to disable select on load if needed
  function toggleSelectRegion()
  {
    var isChecked = document.getElementById("checkRegion").checked;
    document.getElementById("region_multi").disabled = !isChecked;    
    document.getElementById("regionAll").disabled = !isChecked;
  }
  <?php } ?>

  window.onload = toggleSelectDistrict(); // to disable select on load if needed  
  function toggleSelectDistrict()
  {
    var isChecked = document.getElementById("checkDistrict").checked;
    document.getElementById("sc_district_multi").disabled = !isChecked;
    document.getElementById("districtAll").disabled = !isChecked;
  }

  window.onload = toggleSelectUpazila(); // to disable select on load if needed
  function toggleSelectUpazila()
  {
    var isChecked = document.getElementById("checkUpazila").checked;
    document.getElementById("sc_upazila_thana").disabled = !isChecked;
    document.getElementById("upazilaAll").disabled = !isChecked;
  }
  
  //Select scout stage enable / disable by checkbox
  window.onload = toggleSelectCub(); // to disable select on load if needed
  function toggleSelectCub()
  {
    var isChecked = document.getElementById("cub").checked;
    document.getElementById("selectCubStage").disabled = !isChecked;
  }

  window.onload = toggleSelectScout(); // to disable select on load if needed
  function toggleSelectScout()
  {
    var isChecked = document.getElementById("scout").checked;
    document.getElementById("selectScoutStage").disabled = !isChecked;
  }

  window.onload = toggleSelectRover(); // to disable select on load if needed
  function toggleSelectRover()
  {
    var isChecked = document.getElementById("rover").checked;
    document.getElementById("selectRoverStage").disabled = !isChecked;
  }

  window.onload = toggleSelectAdultLeader(); // to disable select on load if needed
  function toggleSelectAdultLeader()
  {
    var isChecked = document.getElementById("adult_leader").checked;
    document.getElementById("selectAdultLeaderStage").disabled = !isChecked;
  }

  function needOfficeFunc(){
    var selectedValue = $("input[name=need_office]:checked").val();
    if(selectedValue == "Yes"){
      $("div#displayNeedOffice").show();
    }else{
      $("div#displayNeedOffice").hide();
    }
  }

  function needRoverFunc(){
    var selectedValue = $("input[name=need_rover]:checked").val();
    if(selectedValue == "Yes"){
      $("div#displayNeedRover").show();
    }else{
      $("div#displayNeedRover").hide();
    }
  }

  // 'event_notify[]': { required: true }  

  // function onCountrySelected(){
  //   var country =document.getElementById("ddlCountry").value;
  //   if (country=="USA") {
  //     document.getElementById("trCanada").style.display='none';
  //     document.getElementById("trUSA").style.display='';
  //   }
  //   else{
  //     document.getElementById("trUSA").style.display='none';
  //     document.getElementById("trCanada").style.display='';
  //   }
  // }

  // function disableRegion() {
  //   document.getElementById("myCheck").disabled = true;
  // }

  // $(document).ready(function(){
  //   $(".regionStatus").prop('disabled', true);
  //   $("#regional").on("click", function(){
  //     // alert('ok');
  //     // var selectedValue = $("input[name=needOffice]:checked").val();
  //     var regionEvent = document.getElementById("regional").value;
  //      // alert(regionEvent);
  //      if(regionEvent == "Yes"){
  //       $(".regionStatus").prop('disabled', false);
  //     }else{
  //       $(".regionStatus").prop('disabled', true);
  //     }
  //   });
  // });


  $(document).ready(function(){
    //Select All option value when check region, district, upazila
    $('#regionAll').click(function() {
      $('#region_multi option').prop('selected', true);
    });

    $('#districtAll').click(function() {
      $('#sc_district_multi option').prop('selected', true);
    });

    $('#upazilaAll').click(function() {
      $('#sc_upazila_thana option').prop('selected', true);
    });

    //Need office.    
    $(".needOffice").on("click",function(){
      needOfficeFunc();
    });

    //Need Rover
    $(".needRover").on("click",function(){
      needRoverFunc();
    });

  });

</script>