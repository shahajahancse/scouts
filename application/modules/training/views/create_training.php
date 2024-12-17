<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=$module_title;?> </a> </li>
      <li> <?=$meta_title;?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('training/training_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> All Training List</a>
              <!-- <a href="<?=base_url('events/upcomming_event_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> Upcomming Events List </a> -->
            </div> 
          </div>

          <div class="grid-body"> 
            <?php echo validation_errors();?>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">                      
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>
            <?php 
            $attributes = array('id' => 'validate');
            echo form_open_multipart("training/create_training", $attributes);?>

            <div class="row">
              <div class="col-md-12">              
                <div class="row form-row">
                  <div class="col-md-3">
                    <label class="form-label">Member Type <span class="required">*</span></label>
                    <?php echo form_error('progress_type');
                    $more_attr = 'class="form-control input-sm" id="porgress_section_id"';
                    echo form_dropdown('progress_type', $progress, set_value('progress_type'), $more_attr);
                    ?>
                 </div>
                  <div class="col-md-3">
                    <label class="form-label">Section <span class="required">*</span></label>
                    <?php echo form_error('section_id');
                    $more_attr = 'class="form-control input-sm" id="section_progress"';
                    echo form_dropdown('section_id', $section, set_value('section_id'), $more_attr);
                    ?>
                 </div>
                 <div class="col-md-4">
                    <label class="form-label">Course Name <span class="required">*</span></label>
                    <?php echo form_error('course_id');?>
                    <select name="course_id" class="prog_course_val form-control input-sm" id="otherCourse">
                       <option value="">-- Select One --</option>
                    </select>
                 </div>
                 <div class="col-md-2">
                    <label class="form-label">Course Number </label>
                    <?php echo form_error('course_number');?>
                    <input type="text" name="course_number" class="form-control input-sm" value="<?=set_value('course_number')?>" placeholder="">
                 </div>
                 <div class="col-md-12" id='others_course'>
                    <label class="form-label">Other Course</label>
                    <?php echo form_error('other_course_name'); ?>
                    <input name="other_course_name" value="<?=set_value('other_course_name')?>" type="text" class="form-control input-sm" placeholder="">
                 </div>
                </div>
              </div>

              <div class="col-md-12">
                  <div class="row form-row">
                     <div class="col-md-7">
                        <label class="form-label">Course/Training Name <span class="required">*</span></label>
                        <?php echo form_error('training_title'); ?>
                        <input name="training_title" value="<?=set_value('training_title')?>"  type="text"  class="form-control input-sm">
                     </div>
                     <div class="col-md-5">
                        <label class="form-label">Place <span class="required">*</span></label>
                        <?php echo form_error('place'); ?>
                        <input name="place" value="<?=set_value('place')?>" type="text" class="form-control input-sm">
                     </div>
                  </div>
               </div>

              <div class="col-md-12">              
                <div class="row form-row">
                  <div class="col-md-12">
                    <h5 class="semi-bold" style="text-decoration: underline;">Training Type </h5>
                    <?php if($this->ion_auth->is_admin()){ ?> 
                    <div class="row form-row">
                      <div class="col-md-4">
                        <h5 class="semi-bold"><input type="checkbox" name="tt_national" value="1"> National</h5>
                      </div>
                      <div class="col-md-4">
                        <h5 class="semi-bold"><input type="checkbox" name="tt_international" value="1"> International</h5>
                      </div>
                    </div>
                    <?php } ?>

                    <div class="row form-row">
                      <?php if($this->ion_auth->is_admin()){ ?> 
                      <div class="col-md-4">
                        <h5 class="semi-bold">
                          <input type="checkbox" name="tt_region" id="checkRegion" class="eventCheck" value="1" onClick="toggleSelectRegion()"/> Regional 
                          <input type="button" id="regionAll" value="Select All" style="font-size: 11px; padding:2;">
                        </h5>
                        <div class="row col-md-12">
                          <?php $more_attr = 'class="form-control input-sm" id="region_multi"';
                          echo form_multiselect('tt_region_ids[]', $regions, '', $more_attr);
                          ?>
                        </div>
                      </div>
                      <?php }elseif($this->ion_auth->is_region_admin()){ ?> 
                      <div class="col-md-4">
                        <h5 class="semi-bold">
                          <input type="checkbox" name="tt_region" id="checkRegion" class="eventCheck" value="1" onClick="toggleSelectRegion()"/> Regional
                        </h5>
                        <h4 class="semi-bold"><?=$region_info->region_name_en;?></h4>
                      </div>
                      <?php } ?>


                      <?php if($this->ion_auth->is_admin()){ ?>
                      <div class="col-md-4">                        
                        <h5 class="semi-bold">
                          <input type="checkbox" name="tt_district" id="checkDistrict" class="eventCheck" value="1" onClick="toggleSelectDistrict()"/> District 
                          <input type="button" id="districtAll" value="Select All" style="font-size: 11px; padding:2;"> 
                        </h5>
                        <select multiple name="tt_district_ids[]" class="sc_district_multi_val form-control input-sm" id="sc_district_multi">
                          <option value="">-- Scouts District --</option>
                        </select>
                      </div>
                      <?php }elseif($this->ion_auth->is_region_admin()){ ?> 
                      <div class="col-md-4">
                        <h5 class="semi-bold">
                          <input type="checkbox" name="tt_district" id="checkDistrict" class="eventCheck" value="1" onClick="toggleSelectDistrict()"/> District 
                        </h5>
                        <?php $more_attr = 'class="sc_district_multi_val form-control input-sm" id="sc_district_multi"';
                        echo form_multiselect('tt_district_ids[]', $sc_districts, '', $more_attr);
                        ?>
                      </div>
                      <?php }elseif($this->ion_auth->is_district_admin()){ ?> 
                      <div class="col-md-4">
                        <h5 class="semi-bold">
                          <input type="checkbox" name="tt_district" id="checkDistrict" class="eventCheck" value="1" onClick="toggleSelectDistrict()"/> District 
                        </h5>
                        <h4 class="semi-bold"><?=$district_info->dis_name_en;?></h4>
                      </div>
                      <?php } ?>

                      <?php if($this->ion_auth->is_admin()){ ?>
                      <div class="col-md-4">
                        <h5 class="semi-bold">
                          <input type="checkbox" name="tt_upazila" id="checkUpazila" class="eventCheck" value="1" onClick="toggleSelectUpazila()"/> Upazila 
                          <input type="button" id="upazilaAll" value="Select All" style="font-size: 11px; padding:2;">
                        </h5>
                        <select multiple name="tt_upazila_ids[]" class="sc_upazila_multi_val form-control input-sm" id="sc_upazila_thana">
                          <option value="">-- Scouts Upazila --</option>
                        </select>
                      </div>
                      <?php }elseif($this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin()){ ?> 
                      <div class="col-md-4">
                        <h5 class="semi-bold">
                          <input type="checkbox" name="tt_upazila" id="checkUpazila" class="eventCheck" value="1" <?=set_value('tt_upazila',$info->tt_upazila)=='1'?'checked':'';?> onClick="toggleSelectUpazila()"/> Upazila 
                          <input type="button" id="upazilaAll" value="Select All" style="font-size: 11px; padding:2;">
                        </h5>
                        <?php $more_attr = 'class="sc_upazila_multi_val form-control input-sm" id="sc_upazila_thana"';
                        $upazilaIds = explode(',', $info->tt_upazila_ids);
                        echo form_multiselect('tt_upazila_ids[]', $sc_upazilas, $upazilaIds, $more_attr);
                        ?>
                      </div>
                      <?php }elseif($this->ion_auth->is_upazila_admin()){ ?> 

                      <div class="col-md-12">
                        <h5 class="semi-bold">
                          <input type="checkbox" name="tt_upazila" id="checkUpazila" class="eventCheck" value="1" checked="checked" onClick="toggleSelectUpazila()"/> Upazila 
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
                    <label class="form-label">Training Description <span class="required">*</span></label>
                    <textarea name="details" rows="8" style="width: 100%" id=""></textarea>
                  </div>
                </div>
              </div> <!-- /col-md-7 -->

              <div class="col-md-5">

                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label">Training Date of Start <span class="required">*</span></label>
                    <input type="text" name="start_date" class="form-control input-sm datetime" id="" placeholder="DD-MM-YYYY">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Training Date of Closing <span class="required">*</span></label>
                    <input type="text" name="end_date" class="form-control input-sm datetime" id="" placeholder="DD-MM-YYYY">
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label">Registration Start Date <span class="required">*</span></label>
                    <input type="text" name="reg_start" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Registration Last Date <span class="required">*</span></label>
                    <input type="text" name="reg_end" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label">Number of Participants <span class="required">*</span></label>
                    <input type="text" name="participant_no" class="form-control input-sm" id="">
                  </div>
                  <div class="col-md-6">  
                    <label class="form-label">Approval Role <span class="required">*</span></label> 
                    <?php $more_attr = 'class="form-control input-sm"';
                    echo form_dropdown('approve_role', $appr_role, set_value('approve_role'), $more_attr);
                    ?>   
                  </div>
                </div>                

                <div class="row form-row">
                  <div class="col-md-6">  
                    <label class="form-label">File Attachment </label>
                    <input type="file" name="userfile[]" multiple/>
                  </div>
                </div>

              </div> <!-- /col-md-5 -->
            </div> <!-- /row -->

            <div class="form-actions">  
              <div class="pull-right">
                <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
              </div>
            </div>

            <?php echo form_close();?>

          </div> <!-- END GRID BODY -->
        </div> <!-- END GRID -->
      </div> <!-- /col-md-12 -->
    </div> <!-- END ROW -->

  </div> <!-- /content -->
</div> <!-- /page-content -->

<script type="text/javascript">  

  $(document).ready(function() {

    $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        progress_type: { required: true },
        section_id: { required: true },
        course_id: { required: true },
        training_title: { required: true },
        place: { required: true },
        details: { required: true },        
        start_date: { required: true },
        end_date: { required: true },
        reg_start: { required: true },
        reg_end: { required: true },        
        participant_no: { required: true },
        approve_role: { required: true }
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

  window.onload = toggleSelectDistrict(); // to disable select on load if needed  
  function toggleSelectDistrict()
  {
    var isChecked = document.getElementById("checkDistrict").checked;
    document.getElementById("sc_district_multi").disabled = !isChecked;
    document.getElementById("districtAll").disabled = !isChecked;
  }
  <?php } ?>

  <?php if($this->ion_auth->is_region_admin()){ ?> 
  window.onload = toggleSelectDistrict(); // to disable select on load if needed  
  function toggleSelectDistrict()
  {
    var isChecked = document.getElementById("checkDistrict").checked;
    document.getElementById("sc_district_multi").disabled = !isChecked;
    document.getElementById("districtAll").disabled = !isChecked;
  }
  <?php } ?>

  window.onload = toggleSelectUpazila(); // to disable select on load if needed
  function toggleSelectUpazila()
  {
    var isChecked = document.getElementById("checkUpazila").checked;
    document.getElementById("sc_upazila_thana").disabled = !isChecked;
    document.getElementById("upazilaAll").disabled = !isChecked;
  }
  
  //Select scout stage enable / disable by checkbox
  // window.onload = toggleSelectCub(); // to disable select on load if needed
  // function toggleSelectCub()
  // {
  //   var isChecked = document.getElementById("cub").checked;
  //   document.getElementById("selectCubStage").disabled = !isChecked;
  // }

  // window.onload = toggleSelectScout(); // to disable select on load if needed
  // function toggleSelectScout()
  // {
  //   var isChecked = document.getElementById("scout").checked;
  //   document.getElementById("selectScoutStage").disabled = !isChecked;
  // }

  // window.onload = toggleSelectRover(); // to disable select on load if needed
  // function toggleSelectRover()
  // {
  //   var isChecked = document.getElementById("rover").checked;
  //   document.getElementById("selectRoverStage").disabled = !isChecked;
  // }

  // window.onload = toggleSelectAdultLeader(); // to disable select on load if needed
  // function toggleSelectAdultLeader()
  // {
  //   var isChecked = document.getElementById("adult_leader").checked;
  //   document.getElementById("selectAdultLeaderStage").disabled = !isChecked;
  // }

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
    // $(".needOffice").on("click",function(){
    //   var selectedValue = $("input[name=need_office]:checked").val();
    //   if(selectedValue == "Yes"){
    //     $("div#displayNeedOffice").show();
    //   }else{
    //     $("div#displayNeedOffice").hide();
    //   }
    // });

    //Need Rover
    // $(".needRover").on("click",function(){
    //   var selectedValue = $("input[name=need_rover]:checked").val();
    //   if(selectedValue == "Yes"){
    //     $("div#displayNeedRover").show();
    //   }else{
    //     $("div#displayNeedRover").hide();
    //   }
    // });
  });

  // Other's Course
   $('#others_course').hide();
   $('#otherCourse').change(function(){
      var id = $('#otherCourse').val();
      // alert(id);
      if(id=='100'){
         $('#others_course').show();
      }else{
         $('#others_course').hide();
      }
   });

</script>