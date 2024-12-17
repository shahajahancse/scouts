<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('offices/scout_group')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                  <div class="pull-right">                
                     <a href="<?=base_url('offices/scout_group')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scout Group List</a>  
                  </div>
                  <?php } ?>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php 
                  $attributes = array('id' => 'scout_group_validate');
                  echo form_open_multipart("offices/scout_group_create", $attributes);?>

                  <div class="row form-row">
                  <h4 class="semi-bold margin_left_15">Create scout group username and password <em style="color: #f73838; font-size: 15px;">(Username should be short, Ex- ga_shortname)</em></h4>
                  <hr>
                     <div class="col-md-4">
                        <label class="form-label">Username <span class="required">*</span> <span style="margin-left: 20px; color: black; font-weight: bold;"><span id="mask_username"></span></span></label> 
                        <?php echo form_error('identity'); ?>                      
                        <?php echo form_input($identity)?> 
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Password <span class="required">*</span></label>
                        <?php echo form_error('password'); ?>
                        <?php echo form_input($password)?> 
                     </div>
                     <!-- <div class="col-md-4">
                        <label class="form-label">Mobile Number (for password retrieve)</label>
                        <?php //echo form_error('phone'); ?>
                        <input name="phone" id="phone" type="text" class="form-control input-sm" placeholder="Mobile Number (11 Digit)">
                     </div> -->
                  </div>

                  <div class="row">
                     <h4 class="semi-bold margin_left_15">Scout Group Office Information</h4>
                     <hr>
                     <div class="col-md-7">
                        <div class="row form-row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="form-label">স্কাউট গ্রুপের ধরণ <span class="required">*</span></label><br>
                                 <?php echo form_error('grp_type'); ?>
                                 <input type="radio" class="controlled" name="grp_type" id="grpTypeCtrl" value="1" <?=set_value('grp_type')==1?'checked':'';?>> নিয়ন্ত্রিত স্কাউট গ্রুপ
                                 <input type="radio" class="open" name="grp_type" id="grpTypeClose" value="2" <?=set_value('grp_type')==2?'checked':'';?>> মুক্ত স্কাউট গ্রুপ
                                 <div id="typeerror"></div>
                              </div>
                           </div>
                           <!-- <div class="col-md-6">
                              <label class="form-label"> Search and Select Member </label>
                              <?php echo form_error('grp_leader');?>
                              <select class="scoutIDselect2 form-control" name="grp_leader"></select>
                           </div> -->
                        </div>

                        <div class="row form-row" id="groupWrap">
                           <div class="col-md-12">
                              <label class="form-label">Select Institute (Search Name or EIIN Number)  </label>
                              <?php echo form_error('grp_institute_id');?>
                              <select class="instituteSelect2 form-control" name="grp_institute_id"></select>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label"> Scout Group Name (English) <span class="required">*</span></label>
                              <?php echo form_error('grp_name');?>
                              <input name="grp_name" id="grp_name" value="<?=set_value('grp_name')?>" type="text" class="form-control input-sm" placeholder="Ex. Mohammadpur Govt. Primary School Cub Scout Group">
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label"> Scout Group Name (বাংলা) <span class="required">*</span></label>
                              <?php echo form_error('grp_name_bn');?>
                              <input name="grp_name_bn" id="grp_name_bn" value="<?=set_value('grp_name_bn')?>" type="text" class="bangla form-control input-sm" placeholder="উদাঃ মোহাম্মদপুর সরকারি প্রাথমিক বিদ্যালয় কাব স্কাউট গ্রুপ" contenteditable="TRUE">
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
                              <label class="form-label">Remarks / Note</label>
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
                           <div class="col-md-7">
                              <label class="form-label"> Charter Number <span class="required">*</span></label>
                              <?php echo form_error('grp_charter');?>
                              <input name="grp_charter" id="grp_charter" value="<?=set_value('grp_charter')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>                           
                           <div class="col-md-5">
                              <label class="form-label"> Created Date </label>
                              <?php echo form_error('grp_created');?>
                              <input name="grp_created" id="grp_created" value="<?=set_value('grp_created')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                           </div>                           
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <?php if($this->ion_auth->is_region_admin()){ ?>
                              <label class="form-label">Select Scout District <span class="required">*</span></label>
                              <?php echo form_error('grp_scout_dis_id'); ?>
                              <?php
                              $more_attr = 'class="form-control input-sm" id="sc_district"';
                              echo form_dropdown('grp_scout_dis_id', $district_dd, set_value('grp_scout_dis_id'), $more_attr);
                              ?>

                              <?php }elseif($this->ion_auth->is_district_admin()){ ?>
                              <label class="form-label">Scout District</label>
                              <h4><?=$district_info->dis_name?></h4>
                              <input type="hidden" name="grp_scout_dis_id" value="<?=$district_info->id?>">

                              <?php }elseif($this->ion_auth->is_upazila_admin()){ ?>
                              <label class="form-label">Scout District</label>
                              <h4><?=$district_info->dis_name?></h4>
                              <input type="hidden" name="grp_scout_dis_id" value="<?=$district_info->id?>">

                              <?php }else{ ?>
                              <label class="form-label">Select Scout District <span class="required">*</span></label>
                              <select name="grp_scout_dis_id" class="sc_district_val form-control input-sm" id="sc_district">
                                 <option value="">-- Select One --</option>
                              </select>
                              <?php } ?>
                           </div>
                        </div>
                        <?php if($this->ion_auth->is_district_admin()){ ?>

                        <?php if($district_info->dis_type!=1){ ?>
                        <!-- <div class="row form-row" id="district_reg_no" style="">
                           <div class="col-md-7">
                              <?php //echo form_error('grp_reg_num_dis');?>
                              <input name="grp_reg_num_dis" value="<?php //set_value('grp_reg_num_dis')?>" type="text" class="form-control input-sm" placeholder="District Registration Number">
                           </div>
                           <div class="col-md-5">
                              <input name="grp_reg_dis_date" value="<?php //set_value('grp_reg_dis_date')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                           </div> 
                        </div> -->
                        <?php } ?>
                        <?php } ?>
                        <div class="row form-row">
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
                        //if($this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                        <div class="row form-row" style="">
                           <div class="col-md-7">
                              <input name="grp_reg_num_upa" value="<?=set_value('grp_reg_num_upa')?>" type="text" class="form-control input-sm" placeholder="Upazila Registration Number">
                           </div>
                           <div class="col-md-5">
                              <input name="grp_reg_upa_date" value="<?=set_value('grp_reg_upa_date')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                           </div>                         
                        </div>                        
                        <?php //} ?>

                        <!-- <div class="row form-row" id="upazila_reg_no" style="display: none;">
                           <div class="col-md-7">
                              <input name="grp_reg_num_upa" value="<?=set_value('grp_reg_num_upa')?>" type="text" class="form-control input-sm" placeholder="Upazila Registration Number">
                           </div>
                           <div class="col-md-5">
                              <input name="grp_reg_upa_date" value="<?=set_value('grp_reg_upa_date')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                           </div>                         
                        </div>    -->                     
                     </div>
                  </div>

                  <div class="row" style="margin-bottom: 30px;">
                     <h4 class="semi-bold margin_left_15">Scout Unit Create <em style="color: #f73838; font-size: 15px;">Minimum 1 unit must be created. Click Add More button for creating multiple units. </em></h4>
                     <hr>
                     <style type="text/css">
                        #unitRowDiv td{padding: 5px; border-color: #ccc;}
                        #unitRowDiv th{padding: 5px;text-align:center;border-color: #ccc; color: black;}                        
                     </style>
                     <?php
                        $unit_type = '';
                        foreach ($sc_unit_types as $key => $value) {      
                           $unit_type .= '<option value="'.$key.'">'.$value.'</option>';   
                        }
                     ?>
                     <div class="col-md-12" >
                        <table width="100%" border="1" id="unitRowDiv" style="border:1px solid #a09e9e;">
                           <tr>
                              <!-- <td>Member Name</td> -->
                              <th width="40%">Unit Name (English) <span class="required">*</span></th>
                              <th width="40%">Unit Name (Bangla) <span class="required">*</span></th>
                              <th width="12%">Unit Type <span class="required">*</span></th>
                              <th width="8%"> <a href="javascript:void();" id="addRow"  class="label label-success"> <i  class="fa fa-plus-circle"></i> Add More</a> </th>
                           </tr>
                           <tr></tr>
                        </table>
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


            <!-- <div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border">
                  <h4>Drag n Drop <span class="semi-bold">Uploader</span></h4>
                  <div class="tools">  </div>
                </div>
                <div class="grid-body no-border">
                  <div class="row-fluid">
                    <form action="<?php //echo base_url('offices/imageUploadPost');?>" enctype="multipart/form-data" class="dropzone no-margin">
                       <div class="fallback"> -->
                        <!-- <input name="file" type="file" multiple /> -->
                        <!-- <div>
                           <h3>Upload Multiple Image By Click On Box</h3>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
           </div> -->

            <!-- <script type="text/javascript">
               Dropzone.options.imageUpload = {
                    maxFilesize:1,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif"
                };
             </script> -->

          </div>
       </div> <!-- END ROW -->
   <br><br><br>
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

      //Load Ro

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

      //Load First row
      addNewRow();

      // Jquery custome validate
      $.validator.addMethod("noSpace", function(value, element) { 
         return value.indexOf(" ") < 0 && value != ""; 
      }, "No space allowed use underscore symbol like ' _ '");
      
      // Jquery validation
      $('#scout_group_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         identity: {
            required: true, 
            noSpace: true,
            minlength: 3,
            remote: {
               url: hostname +"offices/ajax_exists_identity/",
               type: "post",
               data: {
                  inputData: function() {
                     return $( "#identity" ).val();
                  }
               }
            }         
         }, 
         password: {
            required: true,
            minlength: 8,
         },
         phone:{
            required: false,
            number: true,
            minlength: 11,
            maxlength: 11
         },
         grp_type: {
            required: true
         },
         grp_institute_id: {
            required: function(element) { 
               // var selValue = $('input[name=grp_type]:checked').val();
               // if(selValue == 1){
               //    return true;   
               // }else{
                  return false;
               // }
            } 
         },
         grp_name: {
            required: true,
            minlength: 10
         },
         grp_name_bn: {
            required: true,
            minlength: 10
         },
         grp_charter: {
            required: true,
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
         },
         'unit_name[]': {
            required: true
         },
         'unit_name_bn[]': {
            required: true
         },
         'unit_type[]': {
            required: true
         }    
      },

      messages: {
         identity: {
            required: "Username required.",
            minlength: jQuery.format("Enter at least {0} characters"),
            remote: jQuery.format("Already in use! Please try another.")
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

   // onChange Method
   $('#identity').keyup(function(){
      // $('#mask_username').html($('#identity').val());
      $('#mask_username').html($(this).val().toLowerCase());
   });
});   



   // Add multiple unit
   $("#addRow").click(function(e) {
      addNewRow();
   }); 
   //remove row
   function removeRow(id){ 
      $(id).closest("tr").remove();
   }
   //add row function
   function addNewRow(){
      var items = '';
         items+= '<tr>';
         items+= '<td><input name="unit_name[]" value="<?=set_value('unit_name')?>" type="text" class="form-control input-sm" placeholder="Ex: Mohammadpur Govt. Primary School Cub Scout Unit - 1"></td>';
         items+= '<td><input name="unit_name_bn[]" value="<?=set_value('unit_name_bn')?>" type="text" class="form-control input-sm bangla" placeholder="উদাঃ- মোহাম্মদপুর উচ্চ বিদ্যালয় কাব স্কাউট ইউনিট - ১" contenteditable="TRUE"></td>';
         items+= '<td><select style="width:35mm; min-height: 25px;" name="unit_type[]"><?php echo $unit_type;?></select></td>';
         items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
         items+= '</tr>';

      $('#unitRowDiv tr:last').after(items);
      //scout_id_select2_dd();
    } 


</script>