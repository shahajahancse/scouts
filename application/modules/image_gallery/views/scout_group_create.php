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
                     <a href="<?=base_url('offices/scout_group')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scout Group List</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
                  <div><?php //echo validation_errors(); ?></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php 
                  $attributes = array('id' => 'scout_group_validate');
                  echo form_open_multipart("offices/scout_group_create", $attributes);?>
                  
                  <div class="row">
                     <div class="col-md-7">

                        <div class="row form-row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label class="form-label">স্কাউট গ্রুপের ধরণ</label><br>
                                 <?php echo form_error('grp_type'); ?>
                                 <input type="radio" class="controlled" name="grp_type" id="grpTypeCtrl" value="1" <?=set_value('grp_type')==1?'checked':'';?>> নিয়ন্ত্রিত স্কাউট গ্রুপ
                                 <input type="radio" class="open" name="grp_type" id="grpTypeClose" value="2" <?=set_value('grp_type')==2?'checked':'';?>> মুক্ত স্কাউট গ্রুপ
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
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label"> Scout Group Name <span class="required">*</span></label>
                              <?php echo form_error('grp_name');?>
                              <input name="grp_name" id="grp_name" value="<?=set_value('grp_name')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-4">
                              <label class="form-label">Division <span class="required">*</span></label>
                              <?php echo form_error('grp_div_id');
                              $more_attr = 'class="form-control input-sm" id="division"';
                              echo form_dropdown('grp_div_id', $divisions, set_value('grp_div_id'), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">District <span class="required">*</span></label>
                              <?php echo form_error('grp_dis_id'); ?>
                              <select name="grp_dis_id" class="distirict_val form-control input-sm"  id="district">
                                 <option value="">-- Select District --</option>
                              </select>
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">Upazila/Thana</label>
                              <?php echo form_error('grp_upa_id'); ?>
                              <select name="grp_upa_id" class="upazila_thana_val form-control input-sm" >
                                 <option value="">-- Select One --</option>
                              </select>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-4">
                              <label class="form-label">Mobile No. </label>
                              <?php echo form_error('grp_mobile'); ?>
                              <input name="grp_mobile" id="grp_mobile" value="<?=set_value('grp_mobile')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>                          
                           <div class="col-md-4">
                              <label class="form-label">Email</label>
                              <?php echo form_error('grp_email'); ?>
                              <input name="grp_email" id="grp_email" value="<?=set_value('grp_email')?>" type="text" class="form-control input-sm" placeholder="">
                           </div> 
                           <div class="col-md-4">
                              <label class="form-label">Office Address</label>
                              <?php echo form_error('grp_address'); ?>
                              <input name="grp_address" value="<?=set_value('grp_address')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>

                        <div class="row form-row">                
                           <div class="col-md-12">
                              <label class="form-label">Remarks</label>
                              <?php echo form_error('grp_remarks'); ?>
                              <textarea name="grp_remarks" class="form-control"><?=set_value('grp_remarks')?></textarea>
                           </div> 
                        </div>
                     </div>

<?php
// echo $district_info->dis_type;
// $district_display = 'display: none;';
// if($district_info->dis_type == 1){
//    $district_display = '';
// }elseif($district_info->dis_type == 2){
//    $district_display = '';
// }
?>

                     <div class="col-md-5">
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Select Scout Region <span class="required">*</span></label>
                              <?php if($this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>

                                 <h4><?=$region_info->region_name?></h4>
                                 <input type="hidden" name="grp_region_id" value="<?=$region_info->id?>">
                              <?php }else{ ?>
                              <?php 
                              echo form_error('grp_region_id');
                              $more_attr = 'class="form-control input-sm" id="region"';
                              echo form_dropdown('grp_region_id', $regions, set_value('grp_region_id'), $more_attr);
                              ?>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label"> Charter Number </label>
                              <?php echo form_error('grp_charter');?>
                              <input name="grp_charter" id="grp_charter" value="<?=set_value('grp_charter')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>                           
                           <div class="col-md-6">
                              <label class="form-label"> Created Date </label>
                              <?php echo form_error('grp_created');?>
                              <input name="grp_created" id="grp_created" value="<?=set_value('grp_created')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                           </div>                           
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Select Scout District <span class="required">*</span></label>
                              <?php echo form_error('grp_scout_dis_id'); ?>
                              <?php if($this->ion_auth->is_region_admin()){ ?>
                              <?php
                                 $more_attr = 'class="form-control input-sm" id="sc_district"';
                                 echo form_dropdown('grp_scout_dis_id', $district_dd, set_value('grp_scout_dis_id'), $more_attr);
                              ?>

                              <?php }elseif($this->ion_auth->is_district_admin()){ ?>
                              <h4><?=$district_info->dis_name?></h4>
                              <input type="hidden" name="grp_scout_dis_id" value="<?=$district_info->id?>">

                              <?php }elseif($this->ion_auth->is_upazila_admin()){ ?>
                              <h4><?=$district_info->dis_name?></h4>
                              <input type="hidden" name="grp_scout_dis_id" value="<?=$district_info->id?>">

                              <?php }else{ ?>
                              <select name="grp_scout_dis_id" class="sc_district_val form-control input-sm" id="sc_district">
                                 <option value="">-- Select One --</option>
                              </select>
                              <?php } ?>
                           </div>
                        </div>
                        <?php if($this->ion_auth->is_district_admin()){ ?>

                           <?php if($district_info->dis_type!=1){ ?>
                              <div class="row form-row" id="district_reg_no" style="">
                                 <div class="col-md-7">
                                    <?php echo form_error('grp_reg_num_dis');?>
                                    <input name="grp_reg_num_dis" value="<?=set_value('grp_reg_num_dis')?>" type="text" class="form-control input-sm" placeholder="District Registration Number">
                                 </div>
                                 <div class="col-md-5">
                                    <input name="grp_reg_dis_date" value="<?=set_value('grp_reg_dis_date')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                                 </div> 
                              </div>
                           <?php } ?>
                        <?php } ?>
                        <div class="row form-row" id="district_reg_no" style="display: none;">
                           <div class="col-md-7">
                              <?php echo form_error('grp_reg_num_dis');?>
                              <input name="grp_reg_num_dis" value="<?=set_value('grp_reg_num_dis')?>" type="text" class="form-control input-sm" placeholder="District Registration Number">
                           </div>
                           <div class="col-md-5">
                              <input name="grp_reg_dis_date" value="<?=set_value('grp_reg_dis_date')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                           </div> 
                        </div>


                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Select Scout Upazila</label>
                              <?php echo form_error('grp_scout_upa_id'); ?>
                              <?php if($this->ion_auth->is_district_admin()){ ?>                           
                              <?php 
                                 $more_attr = 'class="form-control input-sm" id="sc_upazila_thana"';
                                 echo form_dropdown('grp_scout_upa_id', $upazila_dd, set_value('grp_scout_upa_id'), $more_attr);?>

                              <?php }elseif($this->ion_auth->is_upazila_admin()){ ?>
                                 <h4><?=$upazila_info->upa_name?></h4>
                                 <input type="hidden" name="grp_scout_upa_id" value="<?=$upazila_info->id?>">

                              <?php }else{ ?>
                                 <select name="grp_scout_upa_id" class="sc_upazila_thana_val form-control input-sm"  id="distirict">
                                    <option value="">-- Select One --</option>
                              </select>
                              <?php } ?>
                           </div>
                        </div>
                        <?php 
                        if($this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                        <div class="row form-row" id="upazila_reg_no" style="">
                           <div class="col-md-7">
                              <input name="grp_reg_num_upa" value="<?=set_value('grp_reg_num_upa')?>" type="text" class="form-control input-sm" placeholder="Upazila Registration Number">
                           </div>
                           <div class="col-md-5">
                              <input name="grp_reg_upa_date" value="<?=set_value('grp_reg_upa_date')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                           </div>                         
                        </div>                        
                        <?php } ?>

                        <div class="row form-row" id="upazila_reg_no" style="display: none;">
                           <div class="col-md-7">
                              <input name="grp_reg_num_upa" value="<?=set_value('grp_reg_num_upa')?>" type="text" class="form-control input-sm" placeholder="Upazila Registration Number">
                           </div>
                           <div class="col-md-5">
                              <input name="grp_reg_upa_date" value="<?=set_value('grp_reg_upa_date')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
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


            <div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border">
                  <h4>Drag n Drop <span class="semi-bold">Uploader</span></h4>
                  <div class="tools">  </div>
                </div>
                <div class="grid-body no-border">
                  <div class="row-fluid">
                    <form action="<?php echo base_url('offices/imageUploadPost');?>" enctype="multipart/form-data" class="dropzone no-margin">
                      <div class="fallback">
                        <!-- <input name="file" type="file" multiple /> -->
                        <div>
                           <h3>Upload Multiple Image By Click On Box</h3>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <script type="text/javascript">
               Dropzone.options.imageUpload = {
                    maxFilesize:1,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif"
                };
            </script>

         </div>
      </div> <!-- END ROW -->

   </div>
</div>


<script type="text/javascript">

   $("#region").change(function(){
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
   })

   //Radio button selected
   $(function() {
      var $radios = $('input:radio[name=grp_type]');
      if($radios.is(':checked') === false) {
         $radios.filter('[value=1]').prop('checked', true);
      }
   });

   
   // Group Type Hide/Show
   $(".controlled").click(function(){
      $("#groupWrap").show();
      // $("#repDiv").hide();
      // $("#promotion").show();
   });

   $(".open").click(function(){
      $("#groupWrap").hide();
      // $("#repDiv").show();
      // $("#promotion").hide();
   });



   $(document).ready(function() {
      $('#scout_group_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         grp_type: {
            required: true
         },
         grp_institute_id: {
            required: function(element) { 
               var selValue = $('input[name=grp_type]:checked').val();
               if(selValue == 1){
                   return true;   
               }else{
                  return false;
               }
            } 
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
         if (element.attr("name") == "grp_type") {
            label.insertAfter("#typeerror");
         } else {
            $('<span class="error"></span>').insertAfter(element).append(label)
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('success-control').addClass('error-control');  
         }
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


   // grp_charter: {
   //    required: true,
   //    number: true,   
   //    remote: {
   //       url: hostname +"offices/ajax_exists_scout_group_charter_number/",
   //       type: "post",
   //       data: {
   //          charterNo: function() {
   //             return $( "#grp_charter" ).val();
   //          }
   //       }
   //    }         
   // }
</script>