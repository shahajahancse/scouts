<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('offices/scout_group')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('offices/scout_group')?>" class="btn btn-success btn-xs btn-mini"> Scout Group List</a>  
                     <a href="<?=base_url('offices/scout_group_details/'.$info->id)?>" class="btn btn-success btn-xs btn-mini"> Details</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
                  <div><?php //echo validation_errors(); ?></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <a class="close" data-dismiss="alert">&times;</a>
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php 
                  $attributes = array('id' => 'scout_group_update_validate');
                  echo form_open_multipart(uri_string(), $attributes);?>
                  
                  <div class="row">
                     <div class="col-md-7">

                        <div class="row form-row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label class="form-label">স্কাউট গ্রুপের ধরণ</label><br>
                                 <?php echo form_error('grp_type'); ?>
                                 <input type="radio" class="controlled" name="grp_type" id="grpTypeCtrl" value="1" <?=set_value('grp_type', $info->grp_type)==1?'checked':'';?>> নিয়ন্ত্রিত স্কাউট গ্রুপ
                                 <input type="radio" class="open" name="grp_type" id="grpTypeClose" value="2" <?=set_value('grp_type', $info->grp_type)==2?'checked':'';?>> মুক্ত স্কাউট গ্রুপ
                                 <div id="typeerror"></div>
                              </div>
                           </div>
                        </div>

                        <div class="row form-row" id="groupWrap">
                           <div class="col-md-12">
                              <label class="form-label"> Select Institute  <span class="required">*</span></label>
                               <?php echo form_error('grp_institute_id');
                                 $more_attr = 'class=" form-control select2-ajax-institute" ';
                               ?>
                              <input <?=$more_attr?> type='text' name="grp_institute_id" placeholder='Search and Select Institute' style="padding:0; margin:0;" />
                              <input type="hidden" name="grp_hide_institute_id" value="<?=$info->grp_institute_id?>">
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-4">
                              <label class="form-label">Division <span class="required">*</span></label>
                              <?php echo form_error('grp_div_id');
                              $more_attr = 'class="form-control input-sm" id="division"';
                              echo form_dropdown('grp_div_id', $divisions, set_value('grp_div_id', $info->grp_div_id), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">District <span class="required">*</span></label>
                              <?php echo form_error('grp_dis_id');
                              $more_attr = 'class="form-control input-sm distirict_val" id="district"';
                              echo form_dropdown('grp_dis_id', $districts, set_value('grp_dis_id', $info->grp_dis_id), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">Upazila/Thana</label>
                              <?php echo form_error('grp_upa_id');
                              $more_attr = 'class="form-control input-sm upazila_thana_val"';
                              echo form_dropdown('grp_upa_id', $upazilas, set_value('grp_upa_id', $info->grp_upa_id), $more_attr);
                              ?>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label"> Scout Group Name <span class="required">*</span></label>
                              <?php echo form_error('grp_name');?>
                              <input name="grp_name" id="grp_name" value="<?=set_value('grp_name', $info->grp_name)?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-4">
                              <label class="form-label">Mobile No.</label>
                              <?php echo form_error('grp_mobile'); ?>
                              <input name="grp_mobile" id="grp_mobile" value="<?=set_value('grp_mobile', $info->grp_mobile)?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">Email</label>
                              <?php echo form_error('grp_email'); ?>
                              <input name="grp_email" id="grp_email" value="<?=set_value('grp_email', $info->grp_email)?>" type="text" class="form-control input-sm" placeholder="">
                           </div> 
                           <div class="col-md-4">
                              <label class="form-label">Office Address</label>
                              <?php echo form_error('grp_address'); ?>
                              <input name="grp_address" value="<?=set_value('grp_address', $info->grp_address)?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>

                        <div class="row form-row">                
                           <div class="col-md-12">
                              <label class="form-label">Remarks</label>
                              <?php echo form_error('grp_remarks'); ?>
                              <textarea name="grp_remarks" class="form-control"><?=set_value('grp_remarks', $info->grp_remarks)?></textarea>
                           </div> 
                        </div>

                     </div>

                     <div class="col-md-5">
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Select Scout Region <span class="required">*</span></label>
                              <?php 
                              echo form_error('grp_region_id');
                              $more_attr = 'class="form-control input-sm" id="region"';
                              echo form_dropdown('grp_region_id', $regions, set_value('grp_region_id',  $info->grp_region_id), $more_attr);
                              ?>
                           </div>
                        </div>
                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label"> Charter Number </label>
                              <?php echo form_error('grp_charter');?>
                              <input name="grp_charter" id="grp_charter" value="<?=set_value('grp_charter', $info->grp_charter)?>" type="text" class="form-control input-sm" placeholder="">
                           </div>                           
                           <div class="col-md-6">
                              <label class="form-label"> Created Date </label>
                              <?php echo form_error('grp_created');?>
                              <input name="grp_created" id="grp_created" value="<?=set_value('grp_created', date_bangla_format($info->grp_created))?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                           </div>                           
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Select Scout District <span class="required">*</span></label>
                              <?php echo form_error('grp_scout_dis_id');
                              $more_attr = 'class="form-control input-sm sc_district_val" id="sc_district"';
                              echo form_dropdown('grp_scout_dis_id', $scout_districts, set_value('grp_scout_dis_id', $info->grp_scout_dis_id), $more_attr);
                              ?>
                           </div>
                        </div>
                        <div class="row form-row" id="district_reg_no" style="display: none;">
                           <div class="col-md-7">
                              <?php echo form_error('grp_reg_num_dis');?>
                              <input name="grp_reg_num_dis" value="<?=set_value('grp_reg_num_dis', $info->grp_reg_num_dis)?>" type="text" class="form-control input-sm" placeholder="District Registration Number">
                           </div>
                           <div class="col-md-5">
                              <input name="grp_reg_dis_date" value="<?=set_value('grp_reg_dis_date', date_bangla_format($info->grp_reg_dis_date))?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                           </div> 
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Select Scout Upazila/Thana</label>
                              <?php echo form_error('grp_scout_upa_id');
                              $more_attr = 'class="form-control input-sm sc_upazila_thana_val"';
                              echo form_dropdown('grp_scout_upa_id', $scout_upazila_thana, set_value('grp_scout_upa_id', $info->grp_scout_upa_id), $more_attr);
                              ?>
                           </div>
                        </div>

                        <div class="row form-row" id="upazila_reg_no" style="display: none;">
                           <div class="col-md-7">
                              <input name="grp_reg_num_upa" value="<?=set_value('grp_reg_num_upa', $info->grp_reg_num_upa)?>" type="text" class="form-control input-sm" placeholder="Upazila Registration Number">
                           </div>
                           <div class="col-md-5">
                              <input name="grp_reg_upa_date" value="<?=set_value('grp_reg_upa_date', date_bangla_format($info->grp_reg_upa_date))?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
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

   //Radio button selected
   // $(function() {
   //    var $radios = $('input:radio[name=grp_type]');
   //    if($radios.is(':checked') === false) {
   //       $radios.filter('[value=1]').prop('checked', true);
   //    }
   // });
   
   // Group Type Hide/Show
   $(".controlled").click(function(){
      group_controlled();
   });   
   function group_controlled(){
      $("#groupWrap").show();
   }
   
   $(".open").click(function(){
      group_open();
   });
   function group_open(){
      $("#groupWrap").hide();
   }

   $("#region").change(function(){
      sc_registration_no();
   });
   function sc_registration_no(){
      var selected_option = $('#region').val();
      if((selected_option == '10') || (selected_option == '11') || (selected_option == '12') || (selected_option == '13')){
         // alert(selected_option);
         // $("#district_reg_no").after("<input id='fnivel2' pk='1'/>")
         $("#district_reg_no").show();
         $("#upazila_reg_no").hide();
      }else{
         $("#district_reg_no").hide();
         $("#upazila_reg_no").show();
      }
   }   


 

   $(document).ready(function() {
      // Body load 
      group_controlled();
      group_open();
      sc_registration_no();

      //Validation
      $('#scout_group_update_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         grp_type: {
            required: true
         },         
         grp_name: {
            required: true,
            minlength: 10
         },
         grp_div_id: {
            required: true
         },
         grp_dis_id: {
            required: true
         },         
         grp_created: {
            required: false
         },
         grp_email: {
            email: true
         },
         grp_region_id: {
            required: true
         },
         grp_scout_dis_id: {
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