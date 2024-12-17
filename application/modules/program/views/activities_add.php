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
                     <?php } ?>
                     <?php }else{ ?>
                     <a href="<?=base_url('program/leader_progress')?>" class="btn btn-blueviolet btn-xs btn-mini"> Leader Progress</a>
                     <?php } ?>
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
                  echo form_open("program/activities_add/".encrypt_url($info->id), $attributes);?>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Activities Name <span class="required">*</span></label>
                              <?php echo form_error('activity_name'); ?>
                              <input name="activity_name" value="<?=set_value('activity_name')?>"  type="text"  class="form-control input-sm">
                           </div>
                           <div class="col-md-2">  
                              <label class="form-label">Activity Type <span class="required">*</span></label> 
                              <?php $more_attr = 'class="form-control input-sm" id="activity"';
                              echo form_dropdown('activity_type_id', $activities_dd, set_value('activity_type_id'), $more_attr);
                              ?>              
                           </div>
                           <div class="col-md-4" id='others_activities'>
                              <label class="form-label">Other Activity</label>
                              <?php echo form_error('activity_other'); ?>
                              <input name="activity_other" value="<?=set_value('activity_other')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>
                     </div>

                     <div class="col-md-12">
                        <div class="row form-row">
                           <div class="col-md-4">
                              <label class="form-label">Activity Venue 1 [Start Point For Hiking] <span class="required">*</span></label>
                              <?php echo form_error('venue1'); ?>
                              <input name="venue1" value="<?=set_value('venue1')?>"  type="text"  class="form-control input-sm">
                           </div>

                           <div class="col-md-4">
                              <label class="form-label">Activity Venue 2 [Start Point For Hiking] <span class="required">*</span></label>
                              <?php echo form_error('venue2'); ?>
                              <input name="venue2" value="<?=set_value('venue2')?>"  type="text"  class="form-control input-sm">
                           </div>

                           <div class="col-md-4">
                              <label class="form-label">Scout Role <span class="required">*</span></label>
                              <?php echo form_error('role_id'); 
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('role_id', $scout_roles, set_value('role_id'), $more_attr);
                              ?>                         
                           </div>
                        </div>
                     </div>

                     <div class="col-md-12">
                        <div class="row form-row">
                           <div class="col-md-3">
                              <label class="form-label">Start Date <span class="required">*</span></label>
                              <?php echo form_error('start_date'); ?>
                              <input type="text" name="start_date" class="form-control input-sm datetime" value="<?=set_value('start_date')?>" placeholder="DD-MM-YYYY">
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">End Date <span class="required">*</span></label>
                              <?php echo form_error('end_date'); ?>
                              <input type="text" name="end_date" class="form-control input-sm datetime" value="<?=set_value('end_date')?>" placeholder="DD-MM-YYYY">
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Certificate No.</label>
                              <?php echo form_error('certificate_no'); ?>
                              <input name="certificate_no" value="<?=set_value('certificate_no')?>"  type="text"  class="form-control input-sm">
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Issue Date </label>
                              <?php echo form_error('issue_date'); ?>
                              <input type="text" name="issue_date" class="form-control input-sm datetime" value="<?=set_value('issue_date')?>" placeholder="DD-MM-YYYY">
                           </div>
                        </div>
                     </div>

                     <div class="col-md-12">
                        <div class="row form-row">
                           <div class="col-md-12">
                              <h5 class="semi-bold">Organized By</h5>
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">International Office / National Scout Organization(NSO)</label>
                              <?php echo form_error('org_nhq_office'); ?>
                              <input name="org_nhq_office" value="<?=set_value('org_nhq_office')?>" type="text"  class="form-control input-sm">
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Other Organization </label>
                              <?php echo form_error('org_other_office'); ?>
                              <input name="org_other_office" value="<?=set_value('org_other_office')?>"  type="text"  class="form-control input-sm">
                           </div>  
                        </div>
                        <div class="row form-row">
                           <div class="col-md-3">
                              <label class="form-label">Scouts Office <span class="required">*</span></label>
                              <?php echo form_error('org_office_type');?>
                              <input type="radio" name="org_office_type" class="sc_office" value="1" <?=set_value('org_office_type')=='1'?'checked':'';?> checked> NHQ Office
                              <input type="radio" name="org_office_type" class="sc_office" value="2" <?=set_value('org_office_type')=='2'?'checked':'';?>> Other Office
                           </div>      

                           <div class="col-md-3 otherOffice" >
                              <label class="form-label">Scouts Region <span class="required">*</span></label>
                              <?php echo form_error('org_region_id');
                              $more_attr = 'class="form-control input-sm" id="region"';
                              echo form_dropdown('org_region_id', $regions, set_value('org_region_id'), $more_attr);
                              ?>
                           </div>

                           <div class="col-md-3 otherOffice">
                              <label class="form-label">Scouts District </label>
                              <?php echo form_error('org_district_id');?>
                              <select name="org_district_id" class="sc_district_val form-control input-sm" id="sc_district">
                                 <option value="">-- Select One --</option>
                              </select>
                           </div>
                           <div class="col-md-3 otherOffice">
                              <label class="form-label">Scouts Upazila </label>
                              <?php echo form_error('org_upazila_id');?>
                              <select name="org_upazila_id" class="sc_upazila_thana_val form-control input-sm"  id="sc_upazila_thana">
                                 <option value="">-- Select One --</option>
                              </select>
                           </div>
                           <div class="col-md-6 otherOffice">
                              <label class="form-label">Scouts Group </label>
                              <?php echo form_error('org_group_id');?>
                              <select name="org_group_id" class="sc_group_val form-control input-sm" id="sc_unit_list">
                                 <option value="">-- Select One --</option>
                              </select>
                           </div>
                           <div class="col-md-6 otherOffice">
                              <label class="form-label">Scouts Unit </label>
                              <?php echo form_error('org_unit_id');?>
                              <select name="org_unit_id" class="sc_unit_list_val form-control input-sm">
                                 <option value="">-- Select One --</option>
                              </select>
                           </div> 
                        </div>
                     </div>
                  </div>

                  <?php //if($flag_can_apply) { ?>
                  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                     </div>
                  </div>
                  <?php //} ?>
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


      $('#jqvalidation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         activity_name: {required: true},
         activity_type_id: {required: true},
         venue1: {required: true},
         venue2: {required: true},
         start_date: {required: true},
         end_date: {required: true},
         role_id: {required: true},
         certificate_no: {required: false},
         issue_date: {required: false}
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


   function officeFunc(){
      $(".otherOffice").hide();
      var selectedValue = $("input[name=org_office_type]:checked").val();
      if(selectedValue == "1"){
         $(".otherOffice").hide();
      }else{
         $(".otherOffice").show();
      }
   }

</script>

<script type="text/javascript">
   $('#others_activities').hide();
   $('#activity').change(function(){
      var id = $('#activity').val();
      // alert(id);
      if(id=='16'){
         $('#others_activities').show();
      }else{
         $('#others_activities').hide();
      }
   });
</script>

<!-- <?php //if(!empty($info->occp_others)){?>
<script type="text/javascript">
  $('#others_activities').show();
</script>
<?php //} ?> -->