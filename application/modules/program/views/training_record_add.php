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
                    <?php if($info->member_id == 2){ ?>
                       <?php if($info->sc_section_id == '1'){ ?>
                       <a href="<?=base_url('program/cub_program/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Cub Program</a>
                       <?php }elseif($info->sc_section_id == '2'){ ?>
                       <a href="<?=base_url('program/scout_program/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts Program</a>
                       <?php }elseif($info->sc_section_id == '3'){ ?>
                       <a href="<?=base_url('program/rover_program/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Rover Scouts Program</a>
                       <?php }
                        }else{ 
                           if($this->ion_auth->is_scout_member()){
                        ?>
                           <a href="<?=base_url('program/leader_progress')?>" class="btn btn-blueviolet btn-xs btn-mini"> Leader Progress</a>
                        <?php }else{ ?>
                           <a href="<?=base_url('program/leader_progress/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Leader Progress</a>
                        <?php 
                              }
                           }
                         ?>
                 </div>           
              </div>
              <div class="grid-body">              
               <div><?php //echo validation_errors(); ?></div>
               <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">                      
                     <?php echo $this->session->flashdata('success');?>
                  </div>
               <?php endif; ?>              
               <?php 
               $attributes = array('id' => 'jqvalidation');
               echo form_open("program/training_record_add/".encrypt_url($info->id), $attributes);?>

               <div class="row">
                  <div class="col-md-12">
                     <div class="row form-row">
                       <?php if($info->sc_section_id == 3 || $info->member_id == 8 || $info->member_id == 9 || $info->member_id == 10 || $info->member_id == 12 ){ ?>
                       <div class="col-md-3">
                        <label class="form-label">Section <span class="required">*</span></label>
                        <input type="hidden" name="porgress_section_id" id="porgress_section_id" value="<?=$progressType?>">
                        <?php echo form_error('course_section_id');
                        $more_attr = 'class="form-control input-sm" id="section_progress"';
                        echo form_dropdown('course_section_id', $section, set_value('course_section_id'), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-3">
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
                     <?php }else{ ?>
                     <div class="col-md-6">
                        <label class="form-label">Course Name <span class="required">*</span></label>
                        <?php echo form_error('course_id');
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('course_id', $courses, set_value('course_id'), $more_attr);
                        ?>
                     </div>
                     <?php } ?>

                     <div class="col-md-2">  
                        <label class="form-label">Start Date <span class="required">*</span></label>
                        <?php echo form_error('start_date'); ?>
                        <input type="text" name="start_date" class="form-control input-sm datetime" value="<?=set_value('start_date')?>" placeholder="DD-MM-YYYY">
                     </div>
                     <div class="col-md-2">  
                        <label class="form-label">End Date <span class="required">*</span></label>
                        <?php echo form_error('end_date'); ?>
                        <input type="text" name="end_date" class="form-control input-sm datetime" value="<?=set_value('end_date')?>" placeholder="DD-MM-YYYY">
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
                        <?php echo form_error('training_name'); ?>
                        <input name="training_name" value="<?=set_value('training_name')?>"  type="text"  class="form-control input-sm">
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
                     <div class="col-md-4">
                        <label class="form-label">Certificate No.</label>
                        <?php echo form_error('certificate_no'); ?>
                        <input name="certificate_no" value="<?=set_value('certificate_no')?>" type="text"  class="form-control input-sm">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Issue Date </label>
                        <?php echo form_error('issue_date'); ?>
                        <input type="text" name="issue_date" id="achiev_achive_date" class="form-control input-sm datetime" value="<?=set_value('issue_date')?>" placeholder="DD-MM-YYYY">
                     </div>
                     <div class="col-md-5">
                        <label class="form-label">Course Leader/Director</label>
                        <?php echo form_error('course_leader'); ?>
                        <input name="course_leader" value="<?=set_value('course_leader')?>"  type="text"  class="form-control input-sm">
                     </div>
                  </div>
               </div>

               <div class="col-md-6">
                  <h5 class="semi-bold">Organized By</h5>
                  <div class="row form-row" style="border-right: 1px solid #ccc;">
                     <div class="col-md-6">
                        <label class="form-label">Scouts Office<span class="required">*</span></label>
                        <?php echo form_error('org_office_type');?>
                        <input type="radio" name="org_office_type" class="sc_office" id="nhqOffice" value="1" <?=set_value('org_office_type')=='1'?'checked':'';?> checked> NHQ Office  
                        <input type="radio" name="org_office_type" class="sc_office" id="otherOffice" value="2" <?=set_value('org_office_type')=='2'?'checked':'';?>> Other Office
                     </div> 
                     <div class="col-md-6 otherOffice" >
                        <label class="form-label">Scouts Region <span class="required">*</span></label>
                        <?php echo form_error('org_region_id');
                        $more_attr = 'class="form-control input-sm" id="region"';
                        echo form_dropdown('org_region_id', $regions, set_value('org_region_id'), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-6 otherOffice">
                        <label class="form-label">Scouts District </label>
                        <?php echo form_error('org_district_id');?>
                        <select name="org_district_id" class="sc_district_val form-control input-sm" id="sc_district">
                           <option value="">-- Select One --</option>
                        </select>
                     </div>
                     <div class="col-md-6 otherOffice">
                        <label class="form-label">Scouts Upazila </label>
                        <?php echo form_error('org_upazila_id');?>
                        <select name="org_upazila_id" class="sc_upazila_thana_val form-control input-sm"  id="sc_upazila_thana">
                           <option value="">-- Select One --</option>
                        </select>
                     </div>
                  </div>
               </div>


               <div class="col-md-6">
                  <h5 class="semi-bold">Managed By</h5>
                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Scouts Office<span class="required">*</span></label>
                        <?php echo form_error('mng_office_type');?>
                        <input type="radio" name="mng_office_type" class="sc_office1" id="nhqOffice1" value="1" <?=set_value('mng_office_type')=='1'?'checked':'';?> checked> NHQ Office 
                        <input type="radio" name="mng_office_type" class="sc_office1" id="otherOffice1" value="2" <?=set_value('mng_office_type')=='2'?'checked':'';?>> Other Office
                     </div> 

                     <div class="col-md-6 otherOffice1" >
                        <label class="form-label">Scouts Region <span class="required">*</span></label>
                        <?php echo form_error('mng_region_id');
                        $more_attr = 'class="form-control input-sm" id="region2"';
                        echo form_dropdown('mng_region_id', $regions, set_value('mng_region_id'), $more_attr);
                        ?>
                     </div>

                     <div class="col-md-6 otherOffice1">
                        <label class="form-label">Scouts District </label>
                        <?php echo form_error('mng_district_id');?>
                        <select name="mng_district_id" class="sc_district_val2 form-control input-sm" id="sc_district2">
                           <option value="">-- Select One --</option>
                        </select>
                     </div>
                     <div class="col-md-6 otherOffice1">
                        <label class="form-label">Scouts Upazila </label>
                        <?php echo form_error('mng_upazila_id');?>
                        <select name="mng_upazila_id" class="sc_upazila_thana_val2 form-control input-sm"  id="sc_upazila_thana">
                           <option value="">-- Select One --</option>
                        </select>
                     </div>
                  </div>
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


      officeFunc();
      //Scout Office
      $(".sc_office").on("click",function(){
         officeFunc();
      });

      officeFunc1();
      //Scout Office
      $(".sc_office1").on("click",function(){
         officeFunc1();
      });


      $('#jqvalidation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         course_id: { required: true },
         start_date: { required: true },
         end_date: { required: true },
         training_name: { required: true },
         place: { required: true },
         certificate_no: { required: false },
         issue_date: { required: false }
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



   function officeFunc(){
      $(".otherOffice").hide();
      var selectedValue = $("input[name=org_office_type]:checked").val();
      if(selectedValue == "1"){
         $(".otherOffice").hide();
      }else{
         $(".otherOffice").show();
      }
   }

   function officeFunc1(){
      $(".otherOffice1").hide();
      var selectedValue = $("input[name=mng_office_type]:checked").val();
      if(selectedValue == "1"){
         $(".otherOffice1").hide();
      }else{
         $(".otherOffice1").show();
      }
   }


   // Scouts Region Dropdown
   $('#region2').change(function(){
      $('.sc_district_val2').addClass('form-control input-sm');
      $(".sc_district_val2 > option").remove();
      var id = $('#region2').val();
      // alert(id);

      $.ajax({
         type: "POST",
         url: hostname +"general_setting/ajax_get_scout_dis_by_region/" + id,
         success: function(func_data)
         {
            $.each(func_data,function(id,name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(name);
               $('.sc_district_val2').append(opt);
            });
         }
      });
   });

   // Scouts Upazila / Thana dropdown
   $('#sc_district2').change(function(){
      $('.sc_upazila_thana_val2').addClass('form-control input-sm');
      $(".sc_upazila_thana_val2 > option").remove();
      var id = $('#sc_district2').val();
      $.ajax({
         type: "POST",
         url: hostname +"general_setting/ajax_get_scout_upazila_thana_by_district/" + id,
         success: function(func_data)
         {
            $.each(func_data,function(id,name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(name);
               $('.sc_upazila_thana_val2').append(opt);
            });
         }
      });

      // group
      $('.sc_group_val2').addClass('form-control input-sm');
      $(".sc_group_val2 > option").remove();
      var id = $('#sc_district2').val();
      $.ajax({
         type: "POST",
         url: hostname +"general_setting/ajax_get_scout_group_by_district/" + id,
         success: function(func_data)
         {
            $.each(func_data,function(id,name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(name);
               $('.sc_group_val2').append(opt);
            });
         }
      });
   });   

   // Scouts Group dropdown
   $('#sc_upazila_thana2').change(function(){
      $('.sc_group_val2').addClass('form-control input-sm');
      $(".sc_group_val2 > option").remove();
      var id = $('#sc_upazila_thana2').val();
      $.ajax({
         type: "POST",
         url: hostname +"general_setting/ajax_get_scout_group_by_upazila_thana/" + id,
         success: function(func_data)
         {
            $.each(func_data,function(id,name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(name);
               $('.sc_group_val2').append(opt);
            });
         }
      });
   });

   // Scouts unit dropdown
   $('#sc_unit_list2').change(function(){
      $('.sc_unit_list_val2').addClass('form-control input-sm');
      $(".sc_unit_list_val2 > option").remove();
      var id = $('#sc_unit_list2').val();
      $.ajax({
         type: "POST",
         url: hostname +"general_setting/ajax_get_scout_unit_list_by_scout_group/" + id,
         success: function(func_data)
         {
            $.each(func_data,function(id,name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(name);
               $('.sc_unit_list_val2').append(opt);
            });
         }
      });
   });

</script>